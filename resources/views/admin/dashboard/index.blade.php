@extends('layouts.app')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;1,400&family=Jost:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ============================================
   HIDDI STORY — ADMIN DASHBOARD
   ============================================ */
:root {
    --gold:          #C9A84C;
    --gold-light:    #E8D5A3;
    --gold-soft:     #FAF5E9;
    --gold-border:   rgba(201, 168, 76, 0.22);
    --charcoal:      #16161A;
    --charcoal-2:    #1E1E24;
    --surface:       #F7F6F2;
    --surface-2:     #FFFFFF;
    --slate:         #52525B;
    --muted:         #A1A1AA;
    --text:          #18181B;

    /* Status */
    --paid-bg:    rgba(16, 185, 129, 0.1);
    --paid-color: #059669;
    --pend-bg:    rgba(245, 158, 11, 0.1);
    --pend-color: #D97706;
    --canc-bg:    rgba(239, 68, 68, 0.1);
    --canc-color: #DC2626;
}

/* ---- BASE ---- */
body { font-family: 'Jost', sans-serif; background: var(--surface); color: var(--text); }

/* ============================================
   PAGE HEADER
   ============================================ */
.db-header {
    background: var(--charcoal);
    border-radius: 20px;
    padding: 32px 36px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
}

.db-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 70% 120% at 90% 50%, rgba(201,168,76,0.12), transparent 70%);
    pointer-events: none;
}

.db-header::after {
    content: '"';
    position: absolute;
    right: 36px;
    top: -20px;
    font-family: 'Playfair Display', serif;
    font-size: 160px;
    color: rgba(201,168,76,0.06);
    line-height: 1;
    pointer-events: none;
    user-select: none;
}

.db-header__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(201,168,76,0.12);
    border: 1px solid rgba(201,168,76,0.3);
    color: var(--gold-light);
    font-size: 0.62rem;
    font-weight: 700;
    letter-spacing: 0.28em;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 100px;
    margin-bottom: 14px;
}

.db-header__dot {
    width: 5px; height: 5px;
    border-radius: 50%;
    background: var(--gold);
    animation: pulse 2s ease-in-out infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(0.8); }
}

.db-header__title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.5rem, 3vw, 2.2rem);
    font-weight: 600;
    color: #fff;
    margin: 0 0 6px;
    line-height: 1.2;
}

.db-header__title em {
    font-style: italic;
    color: var(--gold-light);
}

.db-header__sub {
    font-size: 0.82rem;
    color: rgba(255,255,255,0.45);
    font-weight: 300;
    letter-spacing: 0.02em;
    margin: 0;
}

.db-header__meta {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 18px;
    flex-wrap: wrap;
}

.db-header__time {
    font-size: 0.72rem;
    color: rgba(255,255,255,0.35);
    display: flex;
    align-items: center;
    gap: 6px;
}

.db-header__time svg { color: var(--gold); }

/* ============================================
   STAT CARDS
   ============================================ */
.db-stat-card {
    background: var(--surface-2);
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 18px;
    padding: 26px 24px;
    height: 100%;
    position: relative;
    overflow: hidden;
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    cursor: default;
}

.db-stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
    opacity: 0;
    transition: opacity 0.3s;
}

.db-stat-card:hover {
    transform: translateY(-5px);
    border-color: var(--gold-border);
    box-shadow: 0 20px 48px rgba(201,168,76,0.12);
}

.db-stat-card:hover::before { opacity: 1; }

.db-stat-card__label {
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.db-stat-card__label-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--gold);
    flex-shrink: 0;
}

.db-stat-card__value {
    font-family: 'Playfair Display', serif;
    font-size: 2.6rem;
    font-weight: 600;
    color: var(--charcoal);
    line-height: 1;
    margin-bottom: 16px;
    letter-spacing: -0.02em;
}

.db-stat-card__icon {
    position: absolute;
    top: 22px; right: 22px;
    width: 46px; height: 46px;
    border-radius: 12px;
    background: var(--gold-soft);
    border: 1px solid var(--gold-border);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    transition: all 0.3s;
}
.db-stat-card:hover .db-stat-card__icon {
    background: var(--gold);
    color: #fff;
    border-color: var(--gold);
}

.db-stat-card__footer {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.72rem;
    color: var(--muted);
    font-weight: 400;
}

.db-stat-card__badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: rgba(16,185,129,0.1);
    color: #059669;
    font-size: 0.65rem;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 100px;
}

/* Progress bar mini */
.db-stat-bar {
    height: 3px;
    background: rgba(201,168,76,0.12);
    border-radius: 100px;
    margin: 12px 0 14px;
    overflow: hidden;
}
.db-stat-bar__fill {
    height: 100%;
    background: linear-gradient(90deg, var(--gold-light), var(--gold));
    border-radius: 100px;
    animation: barGrow 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) 0.4s both;
}
@keyframes barGrow {
    from { width: 0 !important; }
}

/* ============================================
   SECTION TITLE
   ============================================ */
.db-section-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 10px;
}

.db-section-title__left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.db-section-title__bar {
    width: 4px; height: 22px;
    background: linear-gradient(to bottom, var(--gold-light), var(--gold));
    border-radius: 100px;
}

.db-section-title__text {
    font-family: 'Playfair Display', serif;
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--charcoal);
    margin: 0;
}

.db-section-title__sub {
    font-size: 0.72rem;
    color: var(--muted);
    font-weight: 400;
    margin: 0;
    letter-spacing: 0.03em;
}

/* ============================================
   TABLE CARD
   ============================================ */
.db-table-card {
    background: var(--surface-2);
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 20px;
    overflow: hidden;
}

.db-table-card__head {
    padding: 24px 28px 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    background: var(--surface-2);
}

.db-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin: 0;
}

.db-table thead tr th {
    padding: 14px 18px;
    font-size: 0.62rem;
    font-weight: 700;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--muted);
    background: #FAFAF9;
    border-bottom: 1px solid rgba(0,0,0,0.06);
    white-space: nowrap;
}
.db-table thead tr th:first-child { padding-left: 28px; }
.db-table thead tr th:last-child  { padding-right: 28px; text-align: right; }

.db-table tbody tr {
    transition: background 0.2s;
}
.db-table tbody tr:hover {
    background: var(--gold-soft);
}

.db-table tbody tr td {
    padding: 16px 18px;
    font-size: 0.85rem;
    color: var(--slate);
    border-bottom: 1px solid rgba(0,0,0,0.04);
    vertical-align: middle;
    line-height: 1.5;
}
.db-table tbody tr:last-child td { border-bottom: none; }
.db-table tbody tr td:first-child { padding-left: 28px; }
.db-table tbody tr td:last-child  { padding-right: 28px; text-align: right; }

/* Customer cell */
.db-customer {
    display: flex;
    align-items: center;
    gap: 12px;
}

.db-customer__avatar {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: var(--charcoal);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Playfair Display', serif;
    font-size: 0.85rem;
    color: var(--gold-light);
    font-weight: 600;
    flex-shrink: 0;
    letter-spacing: 0;
}

.db-customer__name {
    font-weight: 600;
    color: var(--charcoal);
    font-size: 0.85rem;
    line-height: 1.3;
}

/* Package cell */
.db-pkg-pill {
    display: inline-block;
    background: var(--gold-soft);
    border: 1px solid var(--gold-border);
    color: #8B6914;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    padding: 4px 12px;
    border-radius: 100px;
    max-width: 180px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Date cell */
.db-date {
    display: flex;
    align-items: center;
    gap: 7px;
    color: var(--slate);
    font-size: 0.82rem;
}
.db-date svg { color: var(--muted); flex-shrink: 0; }

/* Status badges */
.db-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    padding: 5px 12px;
    border-radius: 100px;
    white-space: nowrap;
}

.db-badge--paid   { background: var(--paid-bg); color: var(--paid-color); }
.db-badge--pend   { background: var(--pend-bg); color: var(--pend-color); }
.db-badge--canc   { background: var(--canc-bg); color: var(--canc-color); }

.db-badge__dot {
    width: 5px; height: 5px;
    border-radius: 50%;
    background: currentColor;
}

/* Empty state */
.db-empty {
    text-align: center;
    padding: 56px 24px;
}
.db-empty__icon {
    width: 60px; height: 60px;
    border: 1.5px dashed var(--gold-border);
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    color: var(--muted);
    margin: 0 auto 16px;
}
.db-empty__title {
    font-family: 'Playfair Display', serif;
    font-size: 1rem;
    color: var(--charcoal);
    margin-bottom: 6px;
}
.db-empty__sub {
    font-size: 0.78rem;
    color: var(--muted);
    font-weight: 300;
}

/* ============================================
   FADE-IN ANIMATION
   ============================================ */
.db-fade-in {
    animation: dbFade 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
}
.db-fade-in:nth-child(1) { animation-delay: 0.05s; }
.db-fade-in:nth-child(2) { animation-delay: 0.12s; }
.db-fade-in:nth-child(3) { animation-delay: 0.19s; }
.db-fade-in:nth-child(4) { animation-delay: 0.26s; }
@keyframes dbFade {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 767px) {
    .db-header { padding: 24px 20px; border-radius: 16px; }
    .db-header::after { font-size: 100px; right: 10px; }
    .db-stat-card { padding: 22px 18px; }
    .db-stat-card__value { font-size: 2rem; }
    .db-table-card { border-radius: 16px; }
    .db-table thead tr th:first-child,
    .db-table tbody tr td:first-child { padding-left: 16px; }
    .db-table thead tr th:last-child,
    .db-table tbody tr td:last-child  { padding-right: 16px; }
}

@media (max-width: 575px) {
    .db-customer__avatar { width: 30px; height: 30px; font-size: 0.75rem; }
    .db-table tbody tr td { font-size: 0.8rem; padding: 12px 10px; }
    .db-table thead tr th { font-size: 0.58rem; padding: 12px 10px; }
}
</style>

{{-- ============================================
     PAGE HEADER
     ============================================ --}}
<div class="db-header db-fade-in">
    <div class="db-header__eyebrow">
        <span class="db-header__dot"></span>
        Hiddi Story
    </div>
    <h1 class="db-header__title">
        Dashboard <em>Overview</em>
    </h1>
    <p class="db-header__sub">Ringkasan performa bisnis fotografi Anda hari ini.</p>
    <div class="db-header__meta">
        <span class="db-header__time">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            {{ now()->isoFormat('dddd, D MMMM Y') }}
        </span>
    </div>
</div>

{{-- ============================================
     STAT CARDS
     ============================================ --}}
<div class="row g-3 g-md-4 mb-4">

    {{-- Total Booking --}}
    <div class="col-6 col-md-4 col-lg-3 db-fade-in">
        <div class="db-stat-card">
            <div class="db-stat-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9 16 11 18 15 14"/></svg>
            </div>
            <div class="db-stat-card__label">
                <span class="db-stat-card__label-dot"></span>
                Total Booking
            </div>
            <div class="db-stat-card__value">{{ $totalBooking }}</div>
            <div class="db-stat-bar">
                <div class="db-stat-bar__fill" style="width: 72%;"></div>
            </div>
            <div class="db-stat-card__footer">
                <span class="db-stat-card__badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="18 15 12 9 6 15"/></svg>
                    Aktif
                </span>
                <span>reservasi masuk</span>
            </div>
        </div>
    </div>

    {{-- Total Portfolio --}}
    <div class="col-6 col-md-4 col-lg-3 db-fade-in">
        <div class="db-stat-card">
            <div class="db-stat-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            </div>
            <div class="db-stat-card__label">
                <span class="db-stat-card__label-dot"></span>
                Galleries
            </div>
            <div class="db-stat-card__value">{{ $totalPortfolio }}</div>
            <div class="db-stat-bar">
                <div class="db-stat-bar__fill" style="width: 55%;"></div>
            </div>
            <div class="db-stat-card__footer">
                <span>foto karya dipublikasi</span>
            </div>
        </div>
    </div>

</div>

{{-- ============================================
     TABLE BOOKING TERBARU
     ============================================ --}}
<div class="row">
    <div class="col-12 db-fade-in">
        <div class="db-table-card">

            {{-- Head --}}
            <div class="db-table-card__head pb-0">
                <div class="db-section-title px-0 pb-4" style="padding-bottom: 20px !important;">
                    <div class="db-section-title__left">
                        <div class="db-section-title__bar"></div>
                        <div>
                            <p class="db-section-title__text mb-0">Pesanan Hari Ini</p>
                            <p class="db-section-title__sub">
                                {{ $recentBookings->count() }} transaksi ditemukan
                            </p>
                        </div>
                    </div>
                    <span style="font-size:0.7rem; color: var(--muted); font-weight:500; letter-spacing:0.05em;">
                        {{ now()->format('d M Y') }}
                    </span>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="db-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Package</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBookings as $booking)
                        <tr>
                            {{-- Customer --}}
                            <td>
                                <div class="db-customer">
                                    <div class="db-customer__avatar">
                                        {{ strtoupper(substr($booking->customer_name ?? 'U', 0, 1)) }}
                                    </div>
                                    <span class="db-customer__name">{{ $booking->customer_name ?? '-' }}</span>
                                </div>
                            </td>

                            {{-- Package --}}
                            <td>
                                <span class="db-pkg-pill">{{ $booking->package->name ?? '-' }}</span>
                            </td>

                            {{-- Date --}}
                            <td>
                                <div class="db-date">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}
                                </div>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($booking->status == 'paid')
                                    <span class="db-badge db-badge--paid">
                                        <span class="db-badge__dot"></span> Paid
                                    </span>
                                @elseif($booking->status == 'pending')
                                    <span class="db-badge db-badge--pend">
                                        <span class="db-badge__dot"></span> Pending
                                    </span>
                                @else
                                    <span class="db-badge db-badge--canc">
                                        <span class="db-badge__dot"></span> Cancelled
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-0">
                                <div class="db-empty">
                                    <div class="db-empty__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    </div>
                                    <p class="db-empty__title">Belum ada pesanan hari ini</p>
                                    <p class="db-empty__sub">Pesanan baru akan muncul di sini secara otomatis.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection 