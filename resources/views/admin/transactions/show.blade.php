@extends('admin.layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10">
        
        {{-- HEADER --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-dark btn-sm rounded-circle p-2 shadow-sm" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="arrow-left" style="width: 20px;"></i>
                </a>
                <div>
                    <h3 class="fw-bold mb-0">Invoice #{{ $transaction->invoice_number }}</h3>
                    <p class="text-muted small mb-0">Status Pembayaran: 
                        <span class="fw-bold {{ $transaction->status == 'paid' ? 'text-success' : 'text-warning' }}">
                            {{ strtoupper($transaction->status) }}
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <button class="btn btn-light shadow-sm d-flex align-items-center gap-2" style="border-radius: 10px;">
                    <i data-lucide="download" style="width: 18px;"></i> PDF
                </button>
                @if($transaction->status == 'pending')
                <form action="#" method="POST">
                    @csrf
                    <button class="btn btn-dark px-4 shadow-sm" style="background: #1a1a1a; border-radius: 10px; border: 1px solid var(--accent-color);">
                        Konfirmasi Pembayaran
                    </button>
                </form>
                @endif
            </div>
        </div>

        <div class="row g-4">
            {{-- LEFT COLUMN: TRANSACTION INFO --}}
            <div class="col-md-7">
                {{-- DETAIL TRANSAKSI --}}
                <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Detail Transaksi</h5>
                        <i data-lucide="receipt" class="text-warning"></i>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="text-muted small text-uppercase fw-bold d-block">ID Transaksi</label>
                            <span class="text-dark fw-medium">TRX-{{ $transaction->id }}</span>
                        </div>
                        <div class="col-6 text-end">
                            <label class="text-muted small text-uppercase fw-bold d-block">Metode</label>
                            <span class="text-dark fw-medium">Bank Transfer</span>
                        </div>
                        <div class="col-6">
                            <label class="text-muted small text-uppercase fw-bold d-block">Tanggal Transaksi</label>
                            <span class="text-dark fw-medium">{{ $transaction->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="col-6 text-end">
                            <label class="text-muted small text-uppercase fw-bold d-block">ID Booking</label>
                            <a href="{{ route('admin.bookings.show', $transaction->booking_id) }}" class="text-decoration-none text-warning fw-bold">
                                #BKG-{{ $transaction->booking_id }}
                            </a>
                        </div>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Total Pembayaran</span>
                        <h3 class="fw-bold text-dark mb-0">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</h3>
                    </div>
                </div>

                {{-- RINCIAN LAYANAN --}}
                <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                    <h6 class="fw-bold mb-3">Item Layanan</h6>
                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-white p-2 rounded-3 shadow-sm">
                                <i data-lucide="camera" class="text-warning" style="width: 20px;"></i>
                            </div>
                            <div>
                                <span class="d-block fw-bold small">{{ $transaction->booking->package->name }}</span>
                                <span class="text-muted style="font-size: 11px;">Sesi Foto {{ $transaction->booking->package->duration_hours }} Jam</span>
                            </div>
                        </div>
                        <span class="fw-bold">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: CLIENT & PROOF --}}
            <div class="col-md-5">
                {{-- INFO KLIEN --}}
                <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                    <h6 class="fw-bold mb-3 d-flex align-items-center gap-2">
                        <i data-lucide="user-check" style="width: 18px;"></i> Data Klien
                    </h6>
                    <p class="mb-1 fw-bold text-dark">{{ $transaction->booking->user->name }}</p>
                    <p class="text-muted small mb-0">{{ $transaction->booking->user->email }}</p>
                </div>

                {{-- BUKTI PEMBAYARAN --}}
                <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                    <h6 class="fw-bold mb-3 d-flex align-items-center justify-content-between">
                        Bukti Transfer
                        <i data-lucide="shield-check" class="text-success" style="width: 18px;"></i>
                    </h6>
                    
                    {{-- Preview Gambar Bukti Bayar --}}
                    <div class="position-relative group">
                        @if($transaction->payment_proof)
                            <img src="{{ asset('storage/' . $transaction->payment_proof) }}" class="img-fluid rounded-4 shadow-sm w-100" style="max-height: 400px; object-fit: contain; cursor: zoom-in;">
                        @else
                            <div class="bg-light rounded-4 d-flex flex-column align-items-center justify-content-center py-5 border">
                                <i data-lucide="image-off" class="text-muted mb-2 opacity-50"></i>
                                <span class="text-muted small">Belum ada bukti upload</span>
                            </div>
                        @endif
                    </div>
                    
                    <p class="text-muted mt-3 mb-0" style="font-size: 11px; text-align: justify;">
                        *Pastikan nominal yang tertera pada bukti transfer sesuai dengan Grand Total sebelum melakukan konfirmasi.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection