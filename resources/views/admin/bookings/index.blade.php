@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Booking Management</h3>
        <p class="text-muted small">Kelola dan pantau seluruh jadwal pemesanan klien.</p>
    </div>
</div>
<form method="GET" action="{{ route('admin.bookings.index') }}" class="mb-3">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="text" name="name" value="{{ request('name') }}" 
                class="form-control" placeholder="Cari nama pelanggan...">
        </div>

        <div class="col-md-3">
            <input type="date" name="date" value="{{ request('date') }}" 
                class="form-control">
        </div>
        <div class="col-md-3">
            <select name="package_id" class="form-select">
                <option value="">Semua Paket</option>
                @foreach($packages as $p)
                    <option value="{{ $p->id }}" 
                        {{ request('package_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-dark w-100">Filter</button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary w-100">
                Reset
            </a>
        </div>
    </div>
</form>
<div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Klien</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Paket Layanan</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Tanggal</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Status</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $b)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-semibold text-dark">
                                {{ $b->user->name ?? $b->customer_name }}
                            </div>
                            <small class="text-muted">
                                {{ $b->user->email ?? $b->customer_email }}
                            </small>
                        </td>

                        <td>
                            <span class="text-dark fw-medium">
                                {{ $b->package->name ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <i data-lucide="calendar" style="width: 14px;" class="text-muted"></i>
                                {{ \Carbon\Carbon::parse($b->booking_date)->format('d M Y') }}
                            </div>
                        </td>

                        <td>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-warning-subtle text-warning',
                                    'waiting_confirmation' => 'bg-info-subtle text-info',
                                    'paid' => 'bg-success-subtle text-success',
                                    'completed' => 'bg-primary-subtle text-primary',
                                    'cancelled' => 'bg-danger-subtle text-danger'
                                ];
                                $badgeClass = $statusColors[strtolower($b->status)] ?? 'bg-secondary-subtle text-secondary';
                            @endphp

                            <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2 text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">
                                {{ $b->status }}
                            </span>
                        </td>

                        <td class="text-center">
                            <a href="{{ route('admin.bookings.show', $b->id) }}" 
                               class="btn btn-sm btn-dark d-inline-flex align-items-center gap-1 shadow-sm" 
                               style="border-radius: 8px; font-size: 0.8rem; background: #1a1a1a;">
                                <i data-lucide="eye" style="width: 14px;"></i> Detail
                            </a>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i data-lucide="calendar-off" class="mb-2" style="width: 40px; height: 40px; opacity: 0.3;"></i>
                            <p>Belum ada data booking.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection