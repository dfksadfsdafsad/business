@extends('admin.layouts.app')

@section('title', 'Edit Page')
@section('heading', 'Edit Page: '.$page.' ('.strtoupper($locale).')')

@section('content')
<div class="admin-card p-4 mb-4">
    <p class="text-muted">File: <code>{{ $path }}</code></p>

    @if(count($sections) > 0)
        <h2 class="h6 mb-3">Section Builder (Drag & Drop + Delete)</h2>
        <form method="POST" action="{{ route('admin.pages.sections.update', ['locale' => $locale, 'page' => $page]) }}" id="sectionBuilderForm">
            @csrf

            <div id="sectionsBoard" class="d-grid gap-3 mb-3"></div>
            <input type="hidden" name="sections_payload" id="sectionsPayload">

            <div class="admin-card p-3 bg-light mb-3">
                <label class="form-label">Add New Section HTML (optional)</label>
                <textarea class="form-control" id="newSectionHtml" rows="4" placeholder="<section class=&quot;custom-section&quot;>...</section>"></textarea>
                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="addSectionBtn">Add Section</button>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary" type="submit">Save Section Layout</button>
                <a class="btn btn-secondary" href="{{ route('admin.pages.index') }}">Back</a>
            </div>
        </form>
        <hr class="my-4">
    @endif

    <h2 class="h6">Full Source Editor</h2>
    <form method="POST" action="{{ route('admin.pages.update', ['locale' => $locale, 'page' => $page]) }}">
        @csrf
        <div class="mb-3">
            <textarea class="form-control" name="content" rows="22" style="font-family: Consolas, monospace;">{{ old('content', $content) }}</textarea>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-success" type="submit">Save Full Source</button>
            <a class="btn btn-secondary" href="{{ route('admin.pages.index') }}">Back</a>
        </div>
    </form>
</div>
@endsection

@if(count($sections) > 0)
    @push('styles')
        <style>
            .section-card.dragging { opacity: .55; border-color: #0d6efd; }
            .section-card { border: 1px solid #dbe4f0; border-radius: 8px; background: #fff; }
            .section-handle { cursor: move; }
        </style>
    @endpush

    @push('scripts')
        <script>
            (() => {
                const initialSections = @json($sections);
                const board = document.getElementById('sectionsBoard');
                const payload = document.getElementById('sectionsPayload');
                const form = document.getElementById('sectionBuilderForm');
                const addBtn = document.getElementById('addSectionBtn');
                const newSectionInput = document.getElementById('newSectionHtml');
                let dragIndex = null;

                const sections = initialSections.map((item, index) => ({
                    id: item.id || ('section-' + index),
                    title: item.title || ('Section ' + (index + 1)),
                    html: item.html || ''
                }));

                const updatePayload = () => {
                    payload.value = JSON.stringify(sections.map(item => ({ html: item.html })));
                };

                const rerender = () => {
                    board.innerHTML = '';

                    sections.forEach((item, index) => {
                        const card = document.createElement('div');
                        card.className = 'section-card p-3';
                        card.draggable = true;
                        card.dataset.index = String(index);

                        card.innerHTML = `
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="section-handle fw-semibold">:: ${item.title}</div>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-delete-index="${index}">Delete</button>
                            </div>
                            <textarea class="form-control" rows="8" data-textarea-index="${index}" style="font-family: Consolas, monospace;"></textarea>
                        `;

                        const textarea = card.querySelector('textarea');
                        textarea.value = item.html;

                        card.addEventListener('dragstart', () => {
                            dragIndex = index;
                            card.classList.add('dragging');
                        });

                        card.addEventListener('dragend', () => {
                            dragIndex = null;
                            card.classList.remove('dragging');
                        });

                        card.addEventListener('dragover', event => {
                            event.preventDefault();
                        });

                        card.addEventListener('drop', event => {
                            event.preventDefault();
                            const targetIndex = Number(card.dataset.index);
                            if (Number.isNaN(targetIndex) || dragIndex === null || dragIndex === targetIndex) {
                                return;
                            }
                            const moved = sections.splice(dragIndex, 1)[0];
                            sections.splice(targetIndex, 0, moved);
                            rerender();
                        });

                        board.appendChild(card);
                    });

                    board.querySelectorAll('[data-textarea-index]').forEach(el => {
                        el.addEventListener('input', event => {
                            const idx = Number(event.target.getAttribute('data-textarea-index'));
                            if (!Number.isNaN(idx) && sections[idx]) {
                                sections[idx].html = event.target.value;
                                updatePayload();
                            }
                        });
                    });

                    board.querySelectorAll('[data-delete-index]').forEach(el => {
                        el.addEventListener('click', event => {
                            const idx = Number(event.target.getAttribute('data-delete-index'));
                            if (!Number.isNaN(idx)) {
                                sections.splice(idx, 1);
                                rerender();
                            }
                        });
                    });

                    updatePayload();
                };

                addBtn.addEventListener('click', () => {
                    const html = (newSectionInput.value || '').trim();
                    if (!html) {
                        return;
                    }
                    sections.push({
                        id: 'custom-' + Date.now(),
                        title: 'Section: custom',
                        html,
                    });
                    newSectionInput.value = '';
                    rerender();
                });

                form.addEventListener('submit', () => {
                    updatePayload();
                });

                rerender();
            })();
        </script>
    @endpush
@endif
