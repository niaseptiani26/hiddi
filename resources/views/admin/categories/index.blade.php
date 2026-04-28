@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Service Categories</h3>
        <p class="text-muted small">Kelola kategori utama untuk pengelompokan paket dan portofolio.</p>
    </div>
    {{-- Jika sedang mode edit, tampilkan tombol untuk kembali ke Tambah Baru --}}
    @if(isset($category))
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark btn-sm px-3" style="border-radius: 10px;">
            <i data-lucide="plus" class="me-1" style="width: 16px;"></i> Tambah Baru
        </a>
    @endif
</div>

<div class="row g-4">
    {{-- LEFT: DAFTAR KATEGORI --}}
    <div class="col-md-7">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Nama Kategori</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Slug / Kode</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $cat)
                        {{-- Tambahkan class 'bg-light' jika kategori ini sedang diedit --}}
                        <tr class="{{ isset($category) && $category->id == $cat->id ? 'bg-light' : '' }}">
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-warning-subtle text-warning p-2 rounded-3">
                                        <i data-lucide="layers" style="width: 18px;"></i>
                                    </div>
                                    <span class="fw-bold text-dark">{{ $cat->name }}</span>
                                </div>
                            </td>
                            <td>
                                <code class="text-muted">{{ Str::slug($cat->name) }}</code>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm {{ isset($category) && $category->id == $cat->id ? 'btn-warning' : 'btn-light' }} p-2" style="border-radius: 8px;">
                                        <i data-lucide="edit-3" style="width: 16px;"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-light p-2 text-danger" style="border-radius: 8px;" onclick="return confirm('Hapus kategori ini juga akan menghapus data terkait?')">
                                            <i data-lucide="trash-2" style="width: 16px;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">Belum ada kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- RIGHT: FORM (Dynamic Store / Update) --}}
    <div class="col-md-5">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px; border-top: 4px solid {{ isset($category) ? '#ffc107' : 'var(--accent-color)' }} !important;">
            <h5 class="fw-bold mb-3">{{ isset($category) ? 'Edit Kategori' : 'Tambah Kategori' }}</h5>
            
            <form action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label class="form-label small fw-bold text-uppercase text-muted">Nama Kategori</label>
                    <input type="text" name="name" class="form-control border-0 bg-light py-2" 
                           placeholder="Misal: Wedding, Graduation, dsb." required 
                           value="{{ old('name', $category->name ?? '') }}"
                           style="border-radius: 10px;">
                    
                    @if(isset($category))
                        <small class="text-warning mt-2 d-block" style="font-size: 11px;">
                            <i data-lucide="info" style="width: 12px; vertical-align: middle;"></i> Mengubah nama kategori mungkin mempengaruhi SEO link galeri.
                        </small>
                    @else
                        <small class="text-muted mt-2 d-block" style="font-size: 11px;">
                            Kategori ini akan muncul di dropdown saat membuat paket/portofolio.
                        </small>
                    @endif
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn {{ isset($category) ? 'btn-warning' : 'btn-dark' }} py-2 shadow-sm d-flex align-items-center justify-content-center gap-2" style="border-radius: 12px;">
                        <i data-lucide="{{ isset($category) ? 'refresh-cw' : 'plus' }}" style="width: 18px;"></i>
                        <span class="fw-bold">{{ isset($category) ? 'Perbarui Kategori' : 'Simpan Kategori' }}</span>
                    </button>
                    
                    @if(isset($category))
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light py-2" style="border-radius: 12px; color: #666;">Batal</a>
                    @endif
                </div>
            </form>
        </div>

        {{-- INFO BOX --}}
        <div class="card border-0 bg-dark text-white p-4 mt-4" style="border-radius: 20px;">
            <div class="d-flex gap-3">
                <i data-lucide="lightbulb" class="text-warning" style="width: 40px; height: 40px;"></i>
                <div>
                    <h6 class="fw-bold mb-1 text-warning">Tips</h6>
                    <p class="small opacity-75 mb-0">Pastikan penamaan kategori konsisten (Contoh: gunakan "Wedding" daripada "Weddings") agar filter galeri tetap rapi.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection