@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Financial Reports</h3>
        <p class="text-muted small">Pantau arus kas dan status pembayaran dari setiap transaksi klien.</p>
    </div>
    {{-- Tombol Export (Opsional untuk kesan pro) --}}
    <button class="btn btn-outline-dark d-flex align-items-center gap-2 px-3 shadow-sm" style="border-radius: 10px;">
        <i data-lucide="download" style="width: 18px;"></i>
        <span>Export CSV</span>
    </button>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Invoice</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Client</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted text-end">Amount</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted text-center">Payment Status</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $t)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-dark text-warning p-2 rounded-3" style="--bs-bg-opacity: 0.1;">
                                    <i data-lucide="file-text" style="width: 18px;"></i>
                                </div>
                                <span class="fw-bold text-dark">#{{ $t->invoice_number }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="fw-medium text-dark">{{ $t->booking->user->name }}</div>
                            <div class="small text-muted" style="font-size: 11px;">Ref Booking ID: #{{ $t->booking_id }}</div>
                        </td>
                        <td class="text-end">
                            <span class="fw-bold text-dark fs-6">
                                Rp {{ number_format($t->amount, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="text-center">
                            @php
                                $statusMap = [
                                    'paid' => ['class' => 'bg-success-subtle text-success', 'icon' => 'check-circle'],
                                    'pending' => ['class' => 'bg-warning-subtle text-warning', 'icon' => 'clock'],
                                    'failed' => ['class' => 'bg-danger-subtle text-danger', 'icon' => 'x-circle'],
                                    'refunded' => ['class' => 'bg-info-subtle text-info', 'icon' => 'refresh-ccw'],
                                ];
                                $current = $statusMap[strtolower($t->status)] ?? ['class' => 'bg-secondary-subtle text-secondary', 'icon' => 'help-circle'];
                            @endphp
                            <span class="badge {{ $current['class'] }} rounded-pill px-3 py-2 d-inline-flex align-items-center gap-1 text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">
                                <i data-lucide="{{ $current['icon'] }}" style="width: 12px;"></i>
                                {{ $t->status }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                {{-- Tombol untuk melihat detail transaksi atau invoice --}}
                                <a href="#" class="btn btn-sm btn-light p-2" title="View Invoice" style="border-radius: 8px;">
                                    <i data-lucide="external-link" style="width: 16px;"></i>
                                </a>
                                {{-- Jika butuh verifikasi manual --}}
                                @if(strtolower($t->status) == 'pending')
                                <button class="btn btn-sm btn-dark px-3" style="background: #1a1a1a; border-radius: 8px; font-size: 11px; border: 1px solid var(--accent-color);">
                                    Verify
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i data-lucide="banknote" class="opacity-25 mb-2" style="width: 50px; height: 50px;"></i>
                            <p class="text-muted">Belum ada riwayat transaksi masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- SIMPLE STATS SUMMARY (Bawah Tabel) --}}
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3" style="border-radius: 12px; border-left: 4px solid #28a745 !important;">
            <div class="small text-muted text-uppercase fw-bold">Total Settled</div>
            <div class="fs-4 fw-bold">Rp {{ number_format($transactions->where('status', 'paid')->sum('amount'), 0, ',', '.') }}</div>
        </div>
    </div>
</div>

@endsection