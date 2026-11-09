@extends('admin.layouts.app')

@section('title', 'Image Manager')
@section('heading', 'Image Manager: '.$page)

@section('content')
<div class="admin-card p-4 mb-3">
    <form class="row g-3" method="GET" action="{{ route('admin.images.index', ['page' => $page]) }}">
        <div class="col-md-4">
            <label class="form-label">Select Page</label>
            <select class="form-select" onchange="window.location.href=this.value">
                @foreach($pages as $item)
                    <option value="{{ route('admin.images.index', ['page' => $item]) }}" @selected($item === $page)>{{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-8 d-flex align-items-end">
            <small class="text-muted">Image directory: <code>/public/assets/images/{{ $directory }}</code></small>
        </div>
    </form>
</div>

<div class="admin-card p-4 mb-3">
    <h2 class="h6">Upload New Image</h2>
    <form method="POST" action="{{ route('admin.images.upload', ['page' => $page]) }}" enctype="multipart/form-data" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label class="form-label">Image File</label>
            <input class="form-control" type="file" name="image" accept="image/*" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Optional Filename (without extension)</label>
            <input class="form-control" type="text" name="filename" placeholder="about-banner">
        </div>
        <div class="col-md-2">
            <label class="form-label">Max Width</label>
            <input class="form-control" type="number" name="max_width" value="1920" min="200" max="4000">
        </div>
        <div class="col-md-2">
            <label class="form-label">Max Height</label>
            <input class="form-control" type="number" name="max_height" value="1920" min="200" max="4000">
        </div>
        <div class="col-md-2 d-grid align-items-end">
            <button class="btn btn-primary" type="submit">Upload</button>
        </div>
    </form>
    <small class="text-muted d-block mt-2">Uploads are auto-resized to fit inside Max Width x Max Height.</small>
</div>

<div class="admin-card p-4">
    <h2 class="h6">Existing Images</h2>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>Preview</th>
                <th>Filename</th>
                <th>Dimensions</th>
                <th>Size</th>
                <th>Replace</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @forelse($files as $file)
                <tr>
                    <td><img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" style="width: 80px; height: 50px; object-fit: cover;"></td>
                    <td><code>{{ $file['name'] }}</code></td>
                    <td>{{ $file['width'] ?? '-' }} x {{ $file['height'] ?? '-' }}</td>
                    <td>{{ $file['size_kb'] }} KB</td>
                    <td>
                        <form method="POST" action="{{ route('admin.images.replace', ['page' => $page, 'filename' => $file['name']]) }}" enctype="multipart/form-data" class="row row-cols-lg-auto g-2 align-items-end">
                            @csrf
                            <div class="col-12">
                                <label class="form-label small">New File</label>
                                <input class="form-control form-control-sm" type="file" name="image" accept="image/*" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small">W</label>
                                <input class="form-control form-control-sm" type="number" name="max_width" value="1920" min="200" max="4000" style="width:90px;">
                            </div>
                            <div class="col-12">
                                <label class="form-label small">H</label>
                                <input class="form-control form-control-sm" type="number" name="max_height" value="1920" min="200" max="4000" style="width:90px;">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-outline-primary btn-sm" type="submit">Replace</button>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.images.destroy', ['page' => $page, 'filename' => $file['name']]) }}" onsubmit="return confirm('Delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-muted">No images in this directory yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
