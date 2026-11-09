@extends('admin.layouts.app')

@section('title', __('admin.visual_builder'))
@section('heading', __('admin.visual_builder').': '.$page.' ('.strtoupper($locale).')')

@push('styles')
<style>
    .builder-grid { display: grid; grid-template-columns: 1fr 360px; gap: 12px; }
    .builder-frame-wrap { border: 1px solid #dbe4f0; border-radius: 10px; overflow: hidden; background: #fff; min-height: 75vh; }
    .builder-frame { width: 100%; height: 78vh; border: 0; }
    .panel { border: 1px solid #dbe4f0; border-radius: 10px; background: #fff; }
    .panel-head { border-bottom: 1px solid #e5e7eb; padding: 10px 12px; font-weight: 600; }
    .panel-body { padding: 12px; }
    .media-item { cursor: pointer; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <span class="badge bg-secondary" id="saveState">{{ __('admin.builder_saved_badge') }}</span>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-primary btn-sm" id="saveDraftBtn" type="button">{{ __('admin.builder_save_draft') }}</button>
        <button class="btn btn-success btn-sm" id="publishBtn" type="button">{{ __('admin.builder_publish') }}</button>
        <a class="btn btn-outline-dark btn-sm" href="{{ route('admin.builder.index') }}">Back</a>
    </div>
</div>

<div class="builder-grid">
    <div class="builder-frame-wrap">
        <iframe id="pageFrame" class="builder-frame" src="{{ $iframeUrl }}"></iframe>
    </div>

    <div class="panel">
        <div class="panel-head">Selection Inspector</div>
        <div class="panel-body">
            <div class="mb-2">
                <label class="form-label">CSS Path</label>
                <input id="selPath" class="form-control form-control-sm" type="text" readonly>
            </div>
            <div class="mb-2">
                <label class="form-label">Tag</label>
                <input id="selTag" class="form-control form-control-sm" type="text" readonly>
            </div>
            <div class="mb-2">
                <label class="form-label">Text</label>
                <textarea id="selText" class="form-control form-control-sm" rows="3"></textarea>
            </div>
            <div class="mb-2">
                <label class="form-label">Link URL (href)</label>
                <input id="selHref" class="form-control form-control-sm" type="text" placeholder="https://... or /path">
            </div>
            <div class="mb-2">
                <label class="form-label">Image URL (src)</label>
                <input id="selSrc" class="form-control form-control-sm" type="text" placeholder="/assets/images/... or /storage/...">
            </div>
            <div class="mb-2">
                <label class="form-label">Alt Text</label>
                <input id="selAlt" class="form-control form-control-sm" type="text">
            </div>
            <div class="row g-2 mb-2">
                <div class="col-6">
                    <label class="form-label">Text Color</label>
                    <input id="styleColor" class="form-control form-control-sm" type="color" value="#111827">
                </div>
                <div class="col-6">
                    <label class="form-label">Background</label>
                    <input id="styleBg" class="form-control form-control-sm" type="color" value="#ffffff">
                </div>
                <div class="col-6">
                    <label class="form-label">Font Size</label>
                    <input id="styleFontSize" class="form-control form-control-sm" type="text" placeholder="16px">
                </div>
                <div class="col-6">
                    <label class="form-label">Text Align</label>
                    <select id="styleAlign" class="form-select form-select-sm">
                        <option value="">(no change)</option>
                        <option value="left">left</option>
                        <option value="center">center</option>
                        <option value="right">right</option>
                        <option value="justify">justify</option>
                    </select>
                </div>
            </div>
            <button id="applyBtn" class="btn btn-outline-primary btn-sm" type="button">Apply Changes</button>

            <hr>
            <div class="mb-2">
                <label class="form-label">Page Title</label>
                <input id="pageTitle" class="form-control form-control-sm" type="text" value="{{ old('title', $record->title) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Meta Description</label>
                <textarea id="metaDescription" class="form-control form-control-sm" rows="2">{{ old('meta_description', data_get($record->meta, 'description')) }}</textarea>
            </div>

            <h3 class="h6">Media Library</h3>
            <form id="mediaUploadForm" class="mb-2">
                @csrf
                <input class="form-control form-control-sm mb-2" type="file" name="image" accept="image/*" required>
                <button class="btn btn-outline-primary btn-sm" type="submit">Upload Media</button>
            </form>
            <div id="mediaList" style="max-height:220px;overflow:auto;"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(() => {
    const translations = @json($translations);
    const payloadApi = @json($payloadApi);
    const saveDraftApi = @json($saveDraftApi);
    const publishApi = @json($publishApi);
    const mediaApi = @json($mediaApi);
    const mediaUploadApi = @json($mediaUploadApi);
    const csrf = '{{ csrf_token() }}';

    const frame = document.getElementById('pageFrame');
    const saveState = document.getElementById('saveState');
    const pageTitle = document.getElementById('pageTitle');
    const metaDescription = document.getElementById('metaDescription');

    let selected = null;
    let overrides = [];
    let dirty = false;

    const markDirty = () => {
        dirty = true;
        saveState.classList.remove('bg-secondary');
        saveState.classList.add('bg-warning', 'text-dark');
        saveState.textContent = translations.unsaved_badge || 'Unsaved Changes';
    };

    const markSaved = () => {
        dirty = false;
        saveState.classList.remove('bg-warning', 'text-dark');
        saveState.classList.add('bg-secondary');
        saveState.textContent = translations.saved_badge || 'All Changes Saved';
    };

    const setSelectedForm = (payload) => {
        selected = payload;
        document.getElementById('selPath').value = payload.path || '';
        document.getElementById('selTag').value = payload.tag || '';
        document.getElementById('selText').value = payload.text || '';
        document.getElementById('selHref').value = payload.attrs?.href || '';
        document.getElementById('selSrc').value = payload.attrs?.src || '';
        document.getElementById('selAlt').value = payload.attrs?.alt || '';

        const color = payload.styles?.color || '#111827';
        const bg = payload.styles?.['background-color'] || '#ffffff';
        document.getElementById('styleColor').value = /^#[0-9a-fA-F]{6}$/.test(color.trim()) ? color.trim() : '#111827';
        document.getElementById('styleBg').value = /^#[0-9a-fA-F]{6}$/.test(bg.trim()) ? bg.trim() : '#ffffff';
        document.getElementById('styleFontSize').value = payload.styles?.['font-size'] || '';
        document.getElementById('styleAlign').value = payload.styles?.['text-align'] || '';
    };

    const postToFrame = (message) => {
        if (!frame.contentWindow) return;
        frame.contentWindow.postMessage(message, window.location.origin);
    };

    const requestStateFromFrame = () => {
        return new Promise((resolve) => {
            let done = false;
            const timer = window.setTimeout(() => {
                if (done) return;
                done = true;
                resolve(Array.isArray(overrides) ? overrides : []);
            }, 900);

            const onMessage = (event) => {
                if (event.origin !== window.location.origin) return;
                const msg = event.data || {};
                if (msg.type !== 'builder:state') return;

                window.removeEventListener('message', onMessage);
                window.clearTimeout(timer);
                done = true;
                const items = Array.isArray(msg.payload?.overrides) ? msg.payload.overrides : [];
                overrides = items;
                resolve(items);
            };

            window.addEventListener('message', onMessage);
            postToFrame({ type: 'builder:get-state' });
        });
    };

    const save = async (mode) => {
        const stateOverrides = await requestStateFromFrame();

        const body = {
            title: pageTitle.value,
            meta: { description: metaDescription.value },
            overrides: stateOverrides,
        };

        const target = mode === 'publish' ? publishApi : saveDraftApi;
        const response = await fetch(target, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },
            body: JSON.stringify(body),
        });

        if (!response.ok) {
            let details = translations.validation_failed || 'Validation failed';
            try {
                const err = await response.json();
                if (err && err.errors) {
                    const firstKey = Object.keys(err.errors)[0];
                    if (firstKey && Array.isArray(err.errors[firstKey]) && err.errors[firstKey][0]) {
                        details = err.errors[firstKey][0];
                    }
                }
            } catch (e) {
                // ignore parse failures
            }
            alert(details);
            return;
        }

        const data = await response.json();
        alert(data.message || (mode === 'publish' ? translations.published : translations.saved));
        markSaved();
    };

    document.getElementById('applyBtn').addEventListener('click', () => {
        if (!selected) return;

        const message = {
            type: 'builder:apply',
            payload: {
                text: document.getElementById('selText').value,
                attrs: {
                    href: document.getElementById('selHref').value,
                    src: document.getElementById('selSrc').value,
                    alt: document.getElementById('selAlt').value,
                },
                styles: {
                    color: document.getElementById('styleColor').value,
                    'background-color': document.getElementById('styleBg').value,
                    'font-size': document.getElementById('styleFontSize').value,
                    'text-align': document.getElementById('styleAlign').value,
                },
            },
        };

        postToFrame(message);
        markDirty();
    });

    document.getElementById('saveDraftBtn').addEventListener('click', () => save('draft'));
    document.getElementById('publishBtn').addEventListener('click', () => save('publish'));

    window.addEventListener('message', (event) => {
        if (event.origin !== window.location.origin) return;
        const msg = event.data || {};

        if (msg.type === 'builder:selected' && msg.payload) {
            setSelectedForm(msg.payload);
            return;
        }

        if (msg.type === 'builder:state' && msg.payload) {
            overrides = Array.isArray(msg.payload.overrides) ? msg.payload.overrides : [];
            return;
        }

        if (msg.type === 'builder:changed') {
            markDirty();
            return;
        }

        if (msg.type === 'builder:ready') {
            markSaved();
            return;
        }
    });

    const loadMedia = async () => {
        const res = await fetch(mediaApi, { headers: { 'Accept': 'application/json' } });
        if (!res.ok) return;
        const data = await res.json();
        const items = Array.isArray(data.items) ? data.items : [];
        const list = document.getElementById('mediaList');

        list.innerHTML = items.map((item) => `
            <button type="button" class="btn btn-light btn-sm w-100 text-start mb-1 media-item" data-url="${item.url}">
                <img src="${item.url}" alt="${item.name}" style="width:40px;height:28px;object-fit:cover;border-radius:4px;" class="me-2">
                ${item.name}
            </button>
        `).join('');

        list.querySelectorAll('.media-item').forEach((btn) => {
            btn.addEventListener('click', () => {
                const url = btn.dataset.url;
                document.getElementById('selSrc').value = url;
                postToFrame({ type: 'builder:apply-media', payload: { url } });
                markDirty();
            });
        });
    };

    document.getElementById('mediaUploadForm').addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(event.currentTarget);
        const res = await fetch(mediaUploadApi, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
            body: formData,
        });

        if (!res.ok) {
            alert('Upload failed');
            return;
        }

        event.currentTarget.reset();
        await loadMedia();
    });

    window.addEventListener('beforeunload', (event) => {
        if (!dirty) return;
        event.preventDefault();
        event.returnValue = translations.unsaved || 'Unsaved changes';
    });

    loadMedia();
})();
</script>
@endpush
