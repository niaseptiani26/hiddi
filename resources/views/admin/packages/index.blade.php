@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Service Packages</h3>
        <p class="text-muted small">Kelola penawaran layanan, harga, dan batas booking harian.</p>
    </div>
    <a href="{{ route('admin.packages.create') }}" class="btn btn-dark d-flex align-items-center gap-2 px-4 shadow-sm" style="background: #1a1a1a; border-radius: 10px; border: 1px solid var(--accent-color);">
        <i data-lucide="plus-circle" style="width: 18px; color: var(--accent-color);"></i>
        <span>Tambah Paket Baru</span>
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="vertical-align: middle;">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Paket & Kategori</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Harga</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Limit & Durasi</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted text-center">Status</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $p)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-dark p-2 rounded-3 text-warning">
                                    <i data-lucide="camera" style="width: 20px;"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-dark">{{ $p->name }}</div>
                                    <span class="badge bg-secondary-subtle text-secondary" style="font-size: 10px;">
                                        {{ $p->category->name ?? 'No Category' }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-dark">
                                Rp {{ number_format($p->price, 0, ',', '.') }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-1">
                                @if($p->prewedding_duration)
                                    <div class="small text-muted" style="font-size: 0.75rem;">
                                        <i data-lucide="camera" class="text-warning" style="width: 12px; margin-top: -3px;"></i> 
                                        Prewed: <strong>{{ $p->prewedding_duration }}h</strong>
                                    </div>
                                @endif
                                
                                @if($p->wedding_duration)
                                    <div class="small text-muted" style="font-size: 0.75rem;">
                                        <i data-lucide="heart" class="text-danger" style="width: 12px; margin-top: -3px;"></i> 
                                        Wedding: <strong>{{ $p->wedding_duration }}h</strong>
                                    </div>
                                @endif

                                {{-- TAMBAHAN INTIMATE DURASI --}}
                                @if($p->intimate_duration)
                                    <div class="small text-muted" style="font-size: 0.75rem;">
                                        <i data-lucide="sparkles" class="text-info" style="width: 12px; margin-top: -3px;"></i> 
                                        Intimate: <strong>{{ $p->intimate_duration }}h</strong>
                                    </div>
                                @endif

                                <div class="small text-dark fw-medium mt-1" style="border-top: 1px solid #eee; padding-top: 2px;">
                                    <i data-lucide="users" style="width: 12px; margin-top: -3px;"></i> 
                                    Max {{ $p->max_per_day }} Booking/Hari
                                </div>
                            </div>
                        </td>                        
                        <td class="text-center">
                            @if($p->is_active)
                                <span class="badge rounded-pill bg-success-subtle text-success px-3">Active</span>
                            @else
                                <span class="badge rounded-pill bg-danger-subtle text-danger px-3">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.packages.show', $p->id) }}" 
                                class="btn btn-sm btn-outline-primary border-0 shadow-sm" 
                                style="border-radius: 8px; background: #f0f7ff;">
                                    <i data-lucide="eye" style="width: 16px; color: #0d6efd;"></i>
                                </a>

                                <a href="{{ route('admin.packages.edit', $p->id) }}" 
                                class="btn btn-sm btn-outline-dark border-0 shadow-sm" 
                                style="border-radius: 8px; background: #f8f9fa;">
                                    <i data-lucide="edit-3" style="width: 16px;"></i>
                                </a>

                                <form action="{{ route('admin.packages.destroy', $p->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0 shadow-sm" 
                                            style="border-radius: 8px; background: #fff5f5;" 
                                            onclick="return confirm('Hapus paket {{ $p->name }}?')">
                                        <i data-lucide="trash-2" style="width: 16px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i data-lucide="box" style="width: 40px; height: 40px;" class="mb-2 opacity-25"></i>
                            <p>Belum ada paket layanan tersedia.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection