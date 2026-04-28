@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10">
        
        {{-- HEADER --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-dark btn-sm rounded-circle p-2 shadow-sm" style="width: 40px; height: 40px;">
                    <i data-lucide="arrow-left" style="width: 20px;"></i>
                </a>
                <div>
                    <h3 class="fw-bold mb-0">Create New Package</h3>
                    <p class="text-muted small mb-0">Tambahkan paket jasa foto baru ke dalam katalog layanan Anda.</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.packages.store') }}" method="POST">
            @csrf
            
            <div class="row g-4">
                {{-- LEFT SIDE: BASIC INFO & INCLUDES --}}
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                        <h5 class="fw-semibold mb-4 d-flex align-items-center gap-2">
                            <i data-lucide="info" class="text-warning" style="width: 20px;"></i>
                            General Information
                        </h5>

                        <div class="mb-3">
                            <label class="form-label fw-medium small text-uppercase">Nama Paket</label>
                            <input type="text" name="name" class="form-control form-control-lg border-0 bg-light" 
                                   placeholder="Contoh: Wedding Premium Gold" required style="font-size: 1rem; border-radius: 12px;">
                        </div>

                        {{-- FIELD NOTES (TAMBAHAN) --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium small text-uppercase">Catatan Tambahan (Notes)</label>
                            <textarea name="notes" class="form-control border-0 bg-light" rows="3" 
                                      placeholder="Contoh: Belum termasuk biaya transportasi atau sewa studio..." style="border-radius: 12px;"></textarea>
                            <small class="text-muted" style="font-size: 11px;">Gunakan tanda * untuk setiap poinnya.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label fw-medium small text-uppercase">Kategori</label>
                                <select name="category_id" class="form-select border-0 bg-light py-2" style="border-radius: 12px;" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium small text-uppercase">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" checked>
                                    <label class="form-check-label" for="isActive">Tampilkan di Website</label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-semibold mb-3 d-flex align-items-center gap-2">
                            <i data-lucide="layers" class="text-warning" style="width: 20px;"></i>
                            Include Package
                        </h5>

                        {{-- PREWEDDING --}}
                        <div class="mb-4">
                            <label class="fw-bold small text-uppercase mb-2 text-muted">Prewedding Items</label>
                            <div id="prewedding-wrapper">
                                <input type="text" name="prewedding[]" class="form-control mb-2 bg-light border-0" placeholder="contoh: Video Cinematic" style="border-radius: 10px;">
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-dark px-3" onclick="addField('prewedding')" style="border-radius: 8px;">
                                <i data-lucide="plus" class="me-1" style="width: 14px;"></i> Tambah Item Prewed
                            </button>
                        </div>

                        {{-- WEDDING --}}
                        <div class="mb-4">
                            <label class="fw-bold small text-uppercase mb-2 text-muted">Wedding Items</label>
                            <div id="wedding-wrapper">
                                <input type="text" name="wedding[]" class="form-control mb-2 bg-light border-0" placeholder="contoh: 2 Fotografer" style="border-radius: 10px;">
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-dark px-3" onclick="addField('wedding')" style="border-radius: 8px;">
                                <i data-lucide="plus" class="me-1" style="width: 14px;"></i> Tambah Item Wedding
                            </button>
                        </div>

                        {{-- INTIMATE --}}
                        <div class="mb-4">
                            <label class="fw-bold small text-uppercase mb-2 text-muted">Intimate Items</label>
                            <div id="intimate-wrapper">
                                <input type="text" name="intimate[]" class="form-control mb-2 bg-light border-0" placeholder="contoh: Intimate Session" style="border-radius: 10px;">
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-dark px-3" onclick="addField('intimate')" style="border-radius: 8px;">
                                <i data-lucide="plus" class="me-1" style="width: 14px;"></i> Tambah Item Intimate
                            </button>
                        </div>

                        {{-- GENERAL --}}
                        <div class="mb-2">
                            <label class="fw-bold small text-uppercase mb-2 text-muted">General / Output</label>
                            <div id="general-wrapper">
                                <input type="text" name="general[]" class="form-control mb-2 bg-light border-0" placeholder="contoh: Link Google Drive" style="border-radius: 10px;">
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-dark px-3" onclick="addField('general')" style="border-radius: 8px;">
                                <i data-lucide="plus" class="me-1" style="width: 14px;"></i> Tambah Item General
                            </button>
                        </div>
                    </div>
                </div>

                {{-- RIGHT SIDE: PRICING & LIMITS --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                        <h5 class="fw-semibold mb-4 d-flex align-items-center gap-2">
                            <i data-lucide="tag" class="text-warning" style="width: 20px;"></i>
                            Pricing
                        </h5>
                        
                        <div class="mb-0">
                            <label class="form-label fw-medium small text-uppercase">Harga (IDR)</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0 bg-light fw-bold" style="border-radius: 12px 0 0 12px;">Rp</span>
                                <input type="number" name="price" class="form-control border-0 bg-light py-2" placeholder="0" required style="border-radius: 0 12px 12px 0;">
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm p-4 sticky-top" style="border-radius: 20px; top: 20px;">
                        <h5 class="fw-semibold mb-4 d-flex align-items-center gap-2">
                            <i data-lucide="settings-2" class="text-warning" style="width: 20px;"></i>
                            Duration Config
                        </h5>
                        
                        <div class="mb-3 p-3 bg-light" style="border-radius: 12px;">
                            <label class="form-label fw-bold small text-uppercase mb-1">Durasi Prewedding</label>
                            <div class="input-group">
                                <input type="number" name="prewedding_duration" class="form-control border-0 bg-white" placeholder="0">
                                <span class="input-group-text border-0 bg-white small text-muted">Jam</span>
                            </div>
                        </div>

                        <div class="mb-3 p-3 bg-light" style="border-radius: 12px;">
                            <label class="form-label fw-bold small text-uppercase mb-1">Durasi Wedding</label>
                            <div class="input-group">
                                <input type="number" name="wedding_duration" class="form-control border-0 bg-white" placeholder="0">
                                <span class="input-group-text border-0 bg-white small text-muted">Jam</span>
                            </div>
                        </div>

                        <div class="mb-3 p-3 bg-light" style="border-radius: 12px;">
                            <label class="form-label fw-bold small text-uppercase mb-1">Durasi Intimate</label>
                            <div class="input-group">
                                <input type="number" name="intimate_duration" class="form-control border-0 bg-white" placeholder="0">
                                <span class="input-group-text border-0 bg-white small text-muted">Jam</span>
                            </div>
                        </div>

                        <div class="mb-4 pt-2">
                            <label class="form-label fw-medium small text-uppercase d-flex justify-content-between">
                                Max Booking <span class="text-muted">(Per Hari)</span>
                            </label>
                            <input type="number" name="max_per_day" class="form-control border-0 bg-light py-2" value="1" style="border-radius: 10px;">
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-3 d-flex align-items-center justify-content-center gap-2" 
                                style="background: #1a1a1a; border-radius: 15px; border: 1px solid var(--accent-color);">
                            <i data-lucide="save" style="width: 20px; color: var(--accent-color);"></i>
                            <span class="fw-bold text-uppercase" style="letter-spacing: 1px;">Simpan Paket</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
function addField(type) {
    const wrapper = document.getElementById(`${type}-wrapper`);
    const inputGroup = document.createElement('div');
    inputGroup.className = 'd-flex gap-2 mb-2';
    
    inputGroup.innerHTML = `
        <input type="text" name="${type}[]" class="form-control bg-light border-0" style="border-radius: 10px;">
        <button type="button" class="btn btn-danger btn-sm px-2" onclick="this.parentElement.remove()" style="border-radius: 8px;">
            <i data-lucide="x" style="width: 16px;"></i>
        </button>
    `;
    
    wrapper.appendChild(inputGroup);
    
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}
</script>

@endsection