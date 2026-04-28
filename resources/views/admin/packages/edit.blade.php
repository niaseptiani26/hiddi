@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10">
        
        {{-- HEADER --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-dark btn-sm rounded-circle p-2 shadow-sm" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="arrow-left" style="width: 20px;"></i>
                </a>
                <div>
                    <h3 class="fw-bold mb-0">Edit Package</h3>
                    <p class="text-muted small mb-0">Memperbarui detail layanan <span class="text-dark fw-bold">"{{ $package->name }}"</span></p>
                </div>
            </div>
            
            @if($package->is_active)
                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Currently Active</span>
            @else
                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Inactive</span>
            @endif
        </div>

        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                {{-- LEFT SIDE: MAIN INFO & INCLUDES --}}
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                        <h5 class="fw-semibold mb-4 d-flex align-items-center gap-2">
                            <i data-lucide="edit-3" class="text-warning" style="width: 20px;"></i> Layanan Detail
                        </h5>

                        <div class="mb-3">
                            <label class="form-label fw-medium small text-uppercase text-muted">Nama Paket</label>
                            <input type="text" name="name" class="form-control form-control-lg border-0 bg-light" 
                                   value="{{ old('name', $package->name) }}" required style="font-size: 1rem; border-radius: 12px; font-weight: 500;">
                        </div>

                        {{-- FIELD NOTES (TAMBAHAN) --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium small text-uppercase text-muted">Catatan Tambahan (Notes)</label>
                            <textarea name="notes" class="form-control border-0 bg-light" rows="3" 
                                      placeholder="Contoh: Belum termasuk biaya transportasi..." 
                                      style="border-radius: 12px;">{{ old('notes', $package->notes) }}</textarea>
                            <small class="text-muted" style="font-size: 11px;">Gunakan tanda * untuk setiap poinnya.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label fw-medium small text-uppercase text-muted">Kategori Layanan</label>
                                <select name="category_id" class="form-select border-0 bg-light py-2" style="border-radius: 12px;" required>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $package->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium small text-uppercase text-muted">Status Publikasi</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ $package->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="isActive">Aktifkan di Website</label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4" style="border-style: dashed;">

                        <h5 class="fw-semibold mb-3 d-flex align-items-center gap-2">
                            <i data-lucide="list-checks" class="text-warning" style="width: 20px;"></i> Package Includes
                        </h5>

                        {{-- Loop untuk 4 tipe include --}}
                        @php $types = ['prewedding', 'wedding', 'intimate', 'general']; @endphp
                        @foreach($types as $type)
                        <div class="mb-4">
                            <label class="fw-bold small text-uppercase mb-2 text-muted">{{ ucfirst($type) }} Items</label>
                            <div id="{{ $type }}-wrapper">
                                @php $items = $package->includes->where('type', $type); @endphp
                                
                                @foreach($items as $item)
                                    <div class="d-flex gap-2 mb-2">
                                        <input type="text" name="{{ $type }}[]" class="form-control bg-light border-0" value="{{ $item->title }}" style="border-radius: 10px;">
                                        <button type="button" class="btn btn-danger btn-sm px-2" onclick="this.parentElement.remove()" style="border-radius: 8px;">
                                            <i data-lucide="x" style="width: 16px;"></i>
                                        </button>
                                    </div>
                                @endforeach

                                {{-- Jika kosong, beri satu input kosong agar user bisa langsung isi --}}
                                @if($items->count() == 0)
                                    <input type="text" name="{{ $type }}[]" class="form-control mb-2 bg-light border-0" placeholder="Belum ada item..." style="border-radius: 10px;">
                                @endif
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-dark px-3 mt-1" onclick="addField('{{ $type }}')" style="border-radius: 8px;">
                                <i data-lucide="plus" class="me-1" style="width: 14px;"></i> Tambah {{ ucfirst($type) }}
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- RIGHT SIDE: PRICING & OPERATIONAL --}}
                <div class="col-md-4">
                    {{-- PRICING CARD --}}
                    <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                        <h5 class="fw-semibold mb-4 d-flex align-items-center gap-2">
                            <i data-lucide="banknote" class="text-warning" style="width: 20px;"></i> Pricing
                        </h5>
                        <div class="mb-0">
                            <label class="form-label fw-medium small text-uppercase text-muted">Harga Jual (IDR)</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text border-0 bg-dark text-white fw-bold" style="border-radius: 12px 0 0 12px;">Rp</span>
                                <input type="number" name="price" class="form-control border-0 bg-light py-2 fw-bold" 
                                       value="{{ (int)$package->price }}" required style="border-radius: 0 12px 12px 0;">
                            </div>
                        </div>
                    </div>

                    {{-- DURATION & SLOTS CARD --}}
                    <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                        <h5 class="fw-semibold mb-4 d-flex align-items-center gap-2">
                            <i data-lucide="settings-2" class="text-warning" style="width: 20px;"></i> Operational Detail
                        </h5>
                        
                        <div class="mb-3">
                            <label class="form-label fw-medium small text-muted text-uppercase">Durasi Prewedding (Jam)</label>
                            <input type="number" name="prewedding_duration" class="form-control border-0 bg-light" 
                                   value="{{ $package->prewedding_duration }}" style="border-radius: 10px;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-medium small text-muted text-uppercase">Durasi Wedding (Jam)</label>
                            <input type="number" name="wedding_duration" class="form-control border-0 bg-light" 
                                   value="{{ $package->wedding_duration }}" style="border-radius: 10px;">
                        </div>

                        {{-- DURASI INTIMATE (TAMBAHAN) --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium small text-muted text-uppercase">Durasi Intimate (Jam)</label>
                            <input type="number" name="intimate_duration" class="form-control border-0 bg-light" 
                                   value="{{ $package->intimate_duration }}" style="border-radius: 10px;">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium small text-muted text-uppercase">Max Slot/Hari</label>
                            <input type="number" name="max_per_day" class="form-control border-0 bg-light" 
                                   value="{{ $package->max_per_day }}" style="border-radius: 10px;">
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-3 d-flex align-items-center justify-content-center gap-2 mb-2" 
                                style="background: #1a1a1a; border-radius: 15px; border: 1px solid var(--accent-color);">
                            <i data-lucide="save" style="width: 18px; color: var(--accent-color);"></i>
                            <span class="fw-bold text-uppercase">Simpan Perubahan</span>
                        </button>
                        
                        <p class="text-center text-muted mb-0" style="font-size: 0.65rem;">Last update: {{ $package->updated_at->format('d M Y, H:i') }}</p>
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
    if (typeof lucide !== 'undefined') lucide.createIcons();
}
</script>

@endsection