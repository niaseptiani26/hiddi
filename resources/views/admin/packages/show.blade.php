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
                    <h3 class="fw-bold mb-0">Detail Paket</h3>
                    <p class="text-muted small mb-0">Informasi lengkap mengenai layanan <span class="text-dark fw-bold">"{{ $package->name }}"</span></p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-warning px-4 fw-bold text-white shadow-sm" style="border-radius: 12px;">
                    <i data-lucide="edit-3" class="me-1" style="width: 18px;"></i> EDIT
                </a>
            </div>
        </div>

        <div class="row g-4">
            {{-- LEFT SIDE: DESCRIPTION & INCLUDES --}}
            <div class="col-md-7">
                <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <span class="badge bg-soft-warning text-warning px-3 py-2 mb-2" style="border-radius: 8px; background: #fff4e6;">
                                {{ $package->category->name }}
                            </span>
                            <h2 class="fw-bold">{{ $package->name }}</h2>
                        </div>
                        <div class="text-end">
                            <span class="text-muted small d-block">Harga Paket</span>
                            <h3 class="fw-bold text-dark">Rp {{ number_format($package->price, 0, ',', '.') }}</h3>
                        </div>
                    </div>

{{-- NOTES SECTION --}}
@if($package->notes)
    <div class="p-4 mb-4" style="background-color: #fcfcfc; border-left: 4px solid #ffc107; border-radius: 12px; shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <h6 class="fw-bold small text-uppercase text-muted mb-3" style="letter-spacing: 1px;">
            <i data-lucide="info" class="me-1" style="width: 14px; vertical-align: middle;"></i> Catatan Tambahan:
        </h6>
        
        <div class="row">
            @php
                // Memecah string berdasarkan tanda "-"
                // array_filter digunakan untuk membuang hasil kosong jika ada
                $notesArray = array_filter(explode('*', $package->notes));
            @endphp

            @foreach($notesArray as $note)
                <div class="col-md-12 mb-2">
                    <div class="d-flex align-items-start gap-2">
                        <div class="mt-1">
                            {{-- Dot kecil warna kuning --}}
                            <div style="width: 6px; height: 6px; background-color: #ffc107; border-radius: 50%;"></div>
                        </div>
                        <span class="small text-secondary" style="line-height: 1.4;">{{ trim($note) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
                    <hr class="my-4" style="border-style: dashed;">

                    <h5 class="fw-bold mb-4">Apa saja yang didapat?</h5>

                    <div class="row g-3">
                        {{-- PREWEDDING BOX --}}
                        @if($package->includes->where('type', 'prewedding')->count() > 0)
                            <div class="col-md-6">
                                <div class="p-3 bg-light h-100" style="border-radius: 15px; border: 1px solid #f0f0f0;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="fw-bold d-flex align-items-center gap-2 mb-0">
                                            <i data-lucide="camera" class="text-warning" style="width: 18px;"></i> Prewedding
                                        </h6>
                                        @if($package->prewedding_duration)
                                            <span class="badge bg-white text-dark border shadow-sm px-2 py-1" style="border-radius: 6px; font-size: 10px;">
                                                {{ $package->prewedding_duration }} JAM
                                            </span>
                                        @endif
                                    </div>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($package->includes->where('type', 'prewedding') as $item)
                                            <li class="small mb-2 d-flex align-items-start gap-2">
                                                <i data-lucide="check-circle-2" class="text-success mt-1" style="width: 14px; min-width: 14px;"></i>
                                                <span>{{ $item->title }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        {{-- WEDDING BOX --}}
                        @if($package->includes->where('type', 'wedding')->count() > 0)
                            <div class="col-md-6">
                                <div class="p-3 bg-light h-100" style="border-radius: 15px; border: 1px solid #f0f0f0;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="fw-bold d-flex align-items-center gap-2 mb-0">
                                            <i data-lucide="heart" class="text-danger" style="width: 18px;"></i> Wedding
                                        </h6>
                                        @if($package->wedding_duration)
                                            <span class="badge bg-white text-dark border shadow-sm px-2 py-1" style="border-radius: 6px; font-size: 10px;">
                                                {{ $package->wedding_duration }} JAM
                                            </span>
                                        @endif
                                    </div>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($package->includes->where('type', 'wedding') as $item)
                                            <li class="small mb-2 d-flex align-items-start gap-2">
                                                <i data-lucide="check-circle-2" class="text-success mt-1" style="width: 14px; min-width: 14px;"></i>
                                                <span>{{ $item->title }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        {{-- INTIMATE BOX --}}
                        @if($package->includes->where('type', 'intimate')->count() > 0)
                            <div class="col-md-6">
                                <div class="p-3 bg-light h-100" style="border-radius: 15px; border: 1px solid #f0f0f0;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="fw-bold d-flex align-items-center gap-2 mb-0">
                                            <i data-lucide="sparkles" class="text-info" style="width: 18px;"></i> Intimate
                                        </h6>
                                        @if($package->intimate_duration)
                                            <span class="badge bg-white text-dark border shadow-sm px-2 py-1" style="border-radius: 6px; font-size: 10px;">
                                                {{ $package->intimate_duration }} JAM
                                            </span>
                                        @endif
                                    </div>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($package->includes->where('type', 'intimate') as $item)
                                            <li class="small mb-2 d-flex align-items-start gap-2">
                                                <i data-lucide="check-circle-2" class="text-success mt-1" style="width: 14px; min-width: 14px;"></i>
                                                <span>{{ $item->title }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        {{-- GENERAL BOX --}}
                        @if($package->includes->where('type', 'general')->count() > 0)
                            <div class="col-12 mt-2">
                                <div class="p-3 border" style="border-radius: 15px; border-color: #eee !important;">
                                    <h6 class="fw-bold d-flex align-items-center gap-2 mb-3">
                                        <i data-lucide="package" class="text-primary" style="width: 18px;"></i> General Includes
                                    </h6>
                                    <div class="row">
                                        @foreach($package->includes->where('type', 'general') as $item)
                                            <div class="col-md-6 small mb-2 d-flex align-items-center gap-2">
                                                <i data-lucide="plus" class="text-muted" style="width: 14px;"></i>
                                                {{ $item->title }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE: CONFIG & STATUS --}}
            <div class="col-md-5">
                <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 20px;">
                    <h5 class="fw-bold mb-4">Status & Konfigurasi</h5>
                    
                    <div class="d-flex align-items-center justify-content-between mb-4 p-3 bg-light" style="border-radius: 12px;">
                        <span class="small fw-medium text-muted">Status Publikasi</span>
                        @if($package->is_active)
                            <span class="badge bg-success px-3 py-2" style="border-radius: 8px;">AKTIF</span>
                        @else
                            <span class="badge bg-danger px-3 py-2" style="border-radius: 8px;">NON-AKTIF</span>
                        @endif
                    </div>

{{-- GRID INFO --}}
<div class="row g-3">
    {{-- Box Prewed --}}
    @if($package->prewedding_duration)
    <div class="col-6">
        <div class="p-3 border text-center h-100" style="border-radius: 15px; background: #fafafa;">
            <i data-lucide="clock" class="text-warning mb-2" style="width: 20px;"></i>
            <span class="d-block text-muted" style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Durasi Prewed</span>
            <h6 class="fw-bold mb-0">{{ $package->prewedding_duration }} Jam</h6>
        </div>
    </div>
    @endif

    {{-- Box Wedding --}}
    @if($package->wedding_duration)
    <div class="col-6">
        <div class="p-3 border text-center h-100" style="border-radius: 15px; background: #fafafa;">
            <i data-lucide="clock-4" class="text-danger mb-2" style="width: 20px;"></i>
            <span class="d-block text-muted" style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Durasi Wedding</span>
            <h6 class="fw-bold mb-0">{{ $package->wedding_duration }} Jam</h6>
        </div>
    </div>
    @endif

    {{-- Box Intimate --}}
    @if($package->intimate_duration)
    <div class="col-6">
        <div class="p-3 border text-center h-100" style="border-radius: 15px; background: #fafafa;">
            <i data-lucide="sparkles" class="text-info mb-2" style="width: 20px;"></i>
            <span class="d-block text-muted" style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Durasi Intimate</span>
            <h6 class="fw-bold mb-0">{{ $package->intimate_duration }} Jam</h6>
        </div>
    </div>
    @endif

    {{-- Box Maks Slot (Tetap tampil karena biasanya wajib ada) --}}
    <div class="col-6">
        <div class="p-3 border text-center h-100" style="border-radius: 15px;">
            <i data-lucide="calendar-range" class="text-success mb-2" style="width: 20px;"></i>
            <span class="d-block text-muted" style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Maks Slot</span>
            <h6 class="fw-bold mb-0">{{ $package->max_per_day ?? 0 }} Slot / Hari</h6>
        </div>
    </div>
</div>                    
                    <div class="mt-4 pt-4 border-top">
                         <div class="d-flex justify-content-between text-muted small">
                            <span>Terakhir diperbarui:</span>
                            <span>{{ $package->updated_at->format('d M Y, H:i') }}</span>
                         </div>
                    </div>
                </div>

                {{-- TIP/INFO CARD --}}
                <div class="card border-0 p-4 text-white shadow-sm" style="border-radius: 20px; background: linear-gradient(45deg, #1a1a1a, #333);">
                    <div class="d-flex gap-3 align-items-center">
                        <div class="bg-warning rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; min-width: 45px;">
                            <i data-lucide="lightbulb" class="text-dark"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1" style="color: #ffc107;">Tips Owner</h6>
                            <p class="small mb-0 text-white-50">Gunakan fitur Edit untuk menyesuaikan harga atau menambah item layanan sesuai permintaan pasar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection