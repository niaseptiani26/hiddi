@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">

            {{-- HEADER SECTION --}}
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-5 gap-3">
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('admin.bookings.index') }}" 
                       class="btn btn-white shadow-sm rounded-circle d-flex align-items-center justify-content-center" 
                       style="width: 45px; height: 45px; transition: all 0.3s;">
                        <i class="bi bi-arrow-left text-dark"></i>
                    </a>
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-1" style="font-size: 0.85rem;">
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Bookings</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Details</li>
                            </ol>
                        </nav>
                        <h2 class="fw-bold m-0 h4">Order #BKG-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</h2>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    {{-- <button onclick="window.print()" class="btn btn-outline-secondary border-0 bg-white shadow-sm px-3">
                        <i class="bi bi-printer me-2"></i>Print
                    </button> --}}
                    <button class="btn btn-dark shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#statusModal">
                        Update Status
                    </button>
                </div>
            </div>

            <div class="row g-4">
                {{-- LEFT COLUMN --}}
                <div class="col-md-8">
                    
                    {{-- CLIENT INFO CARD --}}
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-light p-2 rounded-3 me-3">
                                    <i class="bi bi-person text-primary fs-5"></i>
                                </div>
                                <h5 class="fw-bold m-0">Client Information</h5>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="text-muted small text-uppercase fw-semibold ls-1">Customer Name</label>
                                    <p class="fw-bold text-dark fs-6 mb-0">{{ $booking->user->name ?? $booking->customer_name }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="text-muted small text-uppercase fw-semibold ls-1">Email Address</label>
                                    <p class="fw-bold text-dark fs-6 mb-0">{{ $booking->user->email ?? $booking->customer_email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SERVICE DETAILS --}}
                    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-light p-2 rounded-3 me-3">
                                    <i class="bi bi-camera-reels text-primary fs-5"></i>
                                </div>
                                <h5 class="fw-bold m-0">Service & Schedule</h5>
                            </div>

                            <div class="bg-light rounded-4 p-4 mb-4 border-start border-4 border-dark">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold mb-1 fs-5">{{ $booking->package->name }}</h6>
                                        <p class="text-muted small mb-0">{{ $booking->package->description ?? 'No description available' }}</p>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-white text-dark border shadow-sm px-3 py-2 rounded-pill">
                                            <i class="bi bi-clock me-1"></i> {{ $booking->package->duration_hours }} Jam
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row pt-2">
                                <div class="col-6">
                                    <div class="d-flex flex-column">
                                        <span class="text-muted small">Booking Date</span>
                                        <span class="fw-bold"><i class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <div class="d-flex flex-column">
                                        <span class="text-muted small">Created On</span>
                                        <span class="text-muted">{{ $booking->created_at->format('H:i') }} WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN (PAYMENT SUMMARY) --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-lg sticky-top" style="border-radius: 20px; background: #0f172a; color: #f8fafc; top: 20px; z-index: 10;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Payment Summary</h5>
                            
                            <div class="d-flex justify-content-between mb-3 opacity-75">
                                <span class="small font-monospace">Package Price</span>
                                <span>Rp {{ number_format($booking->package->price, 0, ',', '.') }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="small font-monospace text-success">Total Paid</span>
                                <span class="text-success fw-bold">+ Rp {{ number_format($booking->amount_paid, 0, ',', '.') }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <span class="small font-monospace text-warning">Balance Due</span>
                                <span class="text-warning fw-bold">Rp {{ number_format($booking->remaining, 0, ',', '.') }}</span>
                            </div>

                            <div class="separator mb-4" style="border-top: 1px dashed rgba(255,255,255,0.2);"></div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="h6 mb-0">Total Amount</span>
                                <span class="h5 fw-bold mb-0 text-white">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                            </div>

                            @php
                                $status = $booking->status;
                                $config = match($status){
                                    'pending'   => ['bg' => 'bg-secondary', 'text' => 'Pending'],
                                    'dp_paid'   => ['bg' => 'bg-warning text-dark', 'text' => 'DP Paid'],
                                    'paid'      => ['bg' => 'bg-info text-dark', 'text' => 'Fully Paid'],
                                    'completed' => ['bg' => 'bg-success', 'text' => 'Completed'],
                                    'cancelled' => ['bg' => 'bg-danger', 'text' => 'Cancelled'],
                                    default     => ['bg' => 'bg-light text-dark', 'text' => 'Unknown']
                                };
                            @endphp

                            <div class="rounded-3 p-3 text-center {{ $config['bg'] }} fw-bold text-uppercase ls-1 small shadow-sm">
                                {{ $config['text'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold">Update Order Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Current Status: <span class="text-primary">{{ strtoupper($status) }}</span></label>
                        <select name="status" class="form-select form-select-lg border-light bg-light" style="font-size: 1rem;" required>
                            <option value="">Choose new status...</option>
                            <option value="dp_paid">DP Paid</option>
                            <option value="paid">Paid</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold">Internal Note</label>
                        <textarea name="note" class="form-control border-light bg-light" rows="3" placeholder="Add some notes about this update..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
    .ls-1 { letter-spacing: 0.5px; }
    .card { transition: transform 0.2s ease; }
    .btn-white:hover { background-color: #f8f9fa; transform: translateX(-3px); }
    .font-monospace { font-family: 'SFMono-Regular', Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace !important; }
</style>
@endsection