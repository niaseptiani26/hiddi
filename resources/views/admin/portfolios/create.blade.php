@extends('layouts.app')

@section('content')

<style>
    :root {
        --accent: #c9a96e;
        --dark: #1a1a1a;
    }

    .create-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .btn-back {
        width: 40px;
        height: 40px;
        background: #fff;
        border: 1.5px solid #e0e0e0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: var(--dark);
        flex-shrink: 0;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .btn-back:hover {
        border-color: var(--accent);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .create-title {
        font-size: 1.5rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: var(--dark);
        margin: 0;
    }

    /* Card Form */
    .form-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 2rem;
    }

    @media (min-width: 576px) {
        .form-card {
            padding: 2.5rem 3rem;
        }
    }

    /* Section Divider */
    .section-label {
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #aaa;
        margin-bottom: 0.6rem;
        margin-top: 0;
    }

    /* Form Controls */
    .form-control-custom,
    .form-select-custom {
        background: #f7f7f7;
        border: 1.5px solid transparent;
        border-radius: 12px;
        padding: 0.65rem 1rem;
        font-size: 0.9rem;
        color: var(--dark);
        width: 100%;
        transition: border-color 0.2s, background 0.2s;
        outline: none;
        appearance: none;
        -webkit-appearance: none;
    }

    .form-control-custom:focus,
    .form-select-custom:focus {
        background: #fff;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(201,169,110,0.12);
    }

    textarea.form-control-custom {
        resize: vertical;
        min-height: 90px;
    }

    /* Type Toggle */
    .type-toggle {
        display: flex;
        gap: 0.5rem;
        background: #f4f4f4;
        padding: 4px;
        border-radius: 12px;
    }

    .type-toggle-btn {
        flex: 1;
        padding: 0.55rem;
        border: none;
        background: transparent;
        border-radius: 10px;
        font-size: 0.82rem;
        font-weight: 600;
        color: #999;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
    }

    .type-toggle-btn.selected {
        background: var(--dark);
        color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    /* Dropzone */
    .dropzone-wrapper {
        position: relative;
        border: 2px dashed #ddd;
        border-radius: 16px;
        cursor: pointer;
        overflow: hidden;
        min-height: 220px;
        background: #f9f9f9;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: border-color 0.2s, background 0.2s;
    }

    .dropzone-wrapper:hover,
    .dropzone-wrapper.drag-over {
        border-color: var(--accent);
        background: #fdf7ee;
    }

    .dropzone-wrapper.has-preview {
        border-style: solid;
        border-color: #e0e0e0;
    }

    .dropzone-icon {
        color: #ccc;
        transition: color 0.2s;
    }

    .dropzone-wrapper:hover .dropzone-icon {
        color: var(--accent);
    }

    .dropzone-text {
        font-size: 0.8rem;
        color: #bbb;
        text-align: center;
        line-height: 1.4;
    }

    .dropzone-text strong {
        color: #888;
        display: block;
    }

    /* Preview */
    #image-preview-container {
        position: absolute;
        inset: 0;
        display: none;
    }

    #image-preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .preview-remove-btn {
        position: absolute;
        top: 0.6rem;
        right: 0.6rem;
        background: rgba(0,0,0,0.6);
        border: none;
        color: #fff;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        font-size: 0.75rem;
        transition: background 0.2s;
    }

    .preview-remove-btn:hover {
        background: rgba(200,0,0,0.75);
    }

    /* Video upload area */
    #video-upload-area {
        border: 2px dashed #ddd;
        border-radius: 16px;
        background: #f9f9f9;
        padding: 2rem;
        text-align: center;
        position: relative;
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
    }

    #video-upload-area:hover {
        border-color: var(--accent);
        background: #fdf7ee;
    }

    #video-upload-area.has-file {
        border-color: #c3e6cb;
        background: #f0fff4;
    }

    .video-file-info {
        display: none;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        font-size: 0.83rem;
        color: #2d6a4f;
        font-weight: 600;
    }

    /* Featured Toggle */
    .featured-card {
        background: #f7f7f7;
        border-radius: 14px;
        padding: 1rem 1.1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .featured-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--dark);
    }

    /* Custom Switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 24px;
        flex-shrink: 0;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        background-color: #ddd;
        transition: 0.3s;
        border-radius: 24px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.3s;
        border-radius: 50%;
        box-shadow: 0 1px 4px rgba(0,0,0,0.2);
    }

    input:checked + .slider {
        background-color: var(--accent);
    }

    input:checked + .slider:before {
        transform: translateX(20px);
    }

    /* Submit Button */
    .btn-submit {
        background: var(--dark);
        color: #fff;
        border: 1px solid var(--accent);
        border-radius: 14px;
        padding: 0.9rem 2rem;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        width: 100%;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-submit:hover {
        background: #333;
        transform: translateY(-1px);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* Validation */
    .form-error {
        font-size: 0.78rem;
        color: #dc3545;
        margin-top: 0.3rem;
    }

    /* Divider */
    .divider {
        border: none;
        border-top: 1px solid #f0f0f0;
        margin: 1.5rem 0;
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

        {{-- Header --}}
        <div class="create-header">
            <a href="{{ route('admin.portfolios.index') }}" class="btn-back">
                <i data-lucide="arrow-left" style="width:18px;"></i>
            </a>
            <h3 class="create-title">Tambah Karya</h3>
        </div>

        {{-- Error Bag --}}
        @if($errors->any())
        <div style="background:#fff5f5; border:1px solid #fecaca; border-radius:12px; padding:1rem 1.2rem; margin-bottom:1.5rem;">
            <ul style="margin:0; padding-left:1.2rem; font-size:0.85rem; color:#b91c1c;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form Card --}}
        <div class="form-card">
            <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" id="portfolioForm">
                @csrf

                {{-- TIPE KONTEN --}}
                <div style="margin-bottom:1.4rem;">
                    <p class="section-label">Tipe Konten</p>
                    <div class="type-toggle">
                        <button type="button" class="type-toggle-btn selected" id="btn-image" onclick="switchType('image')">
                            <i data-lucide="image" style="width:15px;"></i> Foto
                        </button>
                        <button type="button" class="type-toggle-btn" id="btn-video" onclick="switchType('video')">
                            <i data-lucide="film" style="width:15px;"></i> Video
                        </button>
                    </div>
                    <input type="hidden" name="type" id="type-input" value="image">
                </div>

                {{-- UPLOAD FOTO --}}
                <div id="image-area" style="margin-bottom:1.4rem;">
                    <p class="section-label">Upload Foto</p>
                    <label for="imageInput">
                        <div class="dropzone-wrapper" id="imageDropzone">
                            <div id="image-preview-container">
                                <img id="image-preview" src="" alt="Preview">
                                <button type="button" class="preview-remove-btn" onclick="removeImage(event)" title="Hapus">
                                    <i data-lucide="x" style="width:13px;"></i>
                                </button>
                            </div>
                            <div id="dropzone-placeholder">
                                <i data-lucide="upload-cloud" class="dropzone-icon" style="width:44px; height:44px;"></i>
                                <div class="dropzone-text">
                                    <strong>Klik atau seret foto ke sini</strong>
                                    JPG, PNG, WEBP — maks 5MB
                                </div>
                            </div>
                        </div>
                    </label>
                    <input type="file" name="image_path" id="imageInput" class="d-none" accept="image/*"
                           onchange="previewImage(event)">
                    @error('image_path')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- UPLOAD VIDEO --}}
                <div id="video-area" style="margin-bottom:1.4rem; display:none;">
                    <p class="section-label">Upload Video</p>
                    <label for="videoInput">
                        <div id="video-upload-area">
                            <div id="video-placeholder">
                                <i data-lucide="video" style="width:36px; color:#ccc; margin-bottom:0.5rem;"></i>
                                <p style="font-size:0.8rem; color:#bbb; margin:0;">
                                    <strong style="color:#888; display:block;">Klik untuk upload video</strong>
                                    MP4, MOV, AVI — maks 50MB
                                </p>
                            </div>
                            <div class="video-file-info" id="video-file-info">
                                <i data-lucide="check-circle-2" style="width:18px;"></i>
                                <span id="video-file-name"></span>
                            </div>
                        </div>
                    </label>
                    <input type="file" name="video_path" id="videoInput" class="d-none" accept="video/*"
                           onchange="previewVideo(event)">
                    @error('video_path')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="divider">

                {{-- JUDUL --}}
                <div style="margin-bottom:1.2rem;">
                    <p class="section-label">Judul Karya</p>
                    <input type="text" name="title" class="form-control-custom"
                           placeholder="Contoh: Intimate Wedding at Villa Puncak"
                           value="{{ old('title') }}" required>
                    @error('title')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DESKRIPSI --}}
                <div style="margin-bottom:1.2rem;">
                    <p class="section-label">Deskripsi Singkat</p>
                    <textarea name="description" class="form-control-custom"
                              placeholder="Ceritakan sedikit tentang karya ini...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KATEGORI --}}
                <div style="margin-bottom:1.4rem;">
                    <p class="section-label">Kategori</p>
                    <div style="position:relative;">
                        <select name="category_id" class="form-select-custom" required>
                            <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Pilih kategori karya</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <i data-lucide="chevron-down" style="position:absolute; right:1rem; top:50%; transform:translateY(-50%); width:16px; pointer-events:none; color:#999;"></i>
                    </div>
                    @error('category_id')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="divider">

                {{-- UNGGULAN --}}
                <div style="margin-bottom:1.75rem;">
                    <div class="featured-card">
                        <div class="featured-label">
                            <i data-lucide="star" style="width:17px; color:var(--accent);"></i>
                            Jadikan Unggulan
                            <span style="font-size:0.75rem; color:#aaa; font-weight:400; margin-left:0.25rem;">— tampil di halaman utama</span>
                        </div>
                        <label class="switch">
                            <input type="checkbox" name="is_featured" value="1"
                                   {{ old('is_featured') ? 'checked' : '' }} id="is_featured">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                {{-- SUBMIT --}}
                <button type="submit" class="btn-submit" id="submitBtn">
                    <i data-lucide="save" style="width:16px;"></i>
                    Simpan Portofolio
                </button>

            </form>
        </div>

    </div>
</div>

<script>
function switchType(type) {
    document.getElementById('type-input').value = type;

    const imgArea = document.getElementById('image-area');
    const vidArea = document.getElementById('video-area');
    const btnImg  = document.getElementById('btn-image');
    const btnVid  = document.getElementById('btn-video');

    const imgInput = document.getElementById('imageInput');
    const vidInput = document.getElementById('videoInput');

    // 🔥 RESET BIAR GA NYAMPUR
    imgInput.value = '';
    vidInput.value = '';

    // reset preview image
    document.getElementById('image-preview').src = '';
    document.getElementById('image-preview-container').style.display = 'none';
    document.getElementById('dropzone-placeholder').style.display = '';
    document.getElementById('imageDropzone').classList.remove('has-preview');

    // reset preview video
    document.getElementById('video-file-info').style.display = 'none';
    document.getElementById('video-placeholder').style.display = '';
    document.getElementById('video-upload-area').classList.remove('has-file');

    if (type === 'image') {
        imgArea.style.display = '';
        vidArea.style.display = 'none';
        btnImg.classList.add('selected');
        btnVid.classList.remove('selected');
    } else {
        imgArea.style.display = 'none';
        vidArea.style.display = '';
        btnImg.classList.remove('selected');
        btnVid.classList.add('selected');
    }
}

function previewVideo(event) {
    const file = event.target.files[0];
    if (!file) return;

    // 🔥 VALIDASI SIZE (SAMA KAYA CONTROLLER 200MB)
    if (file.size > 200 * 1024 * 1024) {
        alert('Video max 200MB');
        event.target.value = '';
        return;
    }

    const area = document.getElementById('video-upload-area');
    const placeholder = document.getElementById('video-placeholder');
    const fileInfo = document.getElementById('video-file-info');
    const fileName = document.getElementById('video-file-name');

    let name = file.name;
    if (name.length > 35) name = name.substring(0, 32) + '...';

    fileName.textContent = name;
    placeholder.style.display = 'none';
    fileInfo.style.display = 'flex';
    area.classList.add('has-file');
}

// 🔥 VALIDASI FINAL SEBELUM SUBMIT
document.getElementById('portfolioForm').addEventListener('submit', function (e) {
    const type = document.getElementById('type-input').value;
    const image = document.getElementById('imageInput').files.length;
    const video = document.getElementById('videoInput').files.length;

    if (type === 'image' && image === 0) {
        e.preventDefault();
        alert('Upload gambar dulu');
        return;
    }

    if (type === 'video' && video === 0) {
        e.preventDefault();
        alert('Upload video dulu');
        return;
    }

    // loading state
    const btn = document.getElementById('submitBtn');
    btn.innerHTML = 'Menyimpan...';
    btn.disabled = true;
});
</script>
<style>
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

@endsection