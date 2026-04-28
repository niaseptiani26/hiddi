@extends('layouts.pelanggan')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
/* ================================================
   HIDDI STORY — LUXURY WEDDING CSS
   ================================================ */
:root {
    --gold:        #C9A84C;
    --gold-light:  #E8D5A3;
    --gold-soft:   #FAF5E9;
    --ivory:       #FDFCF8;
    --charcoal:    #1C1C1E;
    --slate:       #4A4A4A;
    --muted:       #8A8A8A;
    --white:       #FFFFFF;
    --border:      rgba(201, 168, 76, 0.25);
    --shadow-gold: 0 20px 60px rgba(201, 168, 76, 0.15);
    --shadow-soft: 0 8px 40px rgba(0, 0, 0, 0.08);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'Jost', sans-serif;
    background-color: var(--ivory);
    color: var(--charcoal);
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
}

.display-font { font-family: 'Playfair Display', serif; }

/* ---- UTILITY ---- */
.text-gold       { color: var(--gold) !important; }
.bg-gold-soft    { background-color: var(--gold-soft); }
.tracking-wide   { letter-spacing: 0.15em; }
.tracking-wider  { letter-spacing: 0.25em; }
.lh-relaxed      { line-height: 1.8; }

/* ---- GOLD DIVIDER ---- */
.gold-line {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0 auto 16px;
    width: fit-content;
}
.gold-line::before,
.gold-line::after {
    content: '';
    width: 40px;
    height: 1px;
    background: var(--gold);
}
.gold-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--gold);
    display: inline-block;
}

/* ================================================
   HERO
   ================================================ */
.hs-hero {
    position: relative;
    min-height: 100vh;
    width: 100%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hs-hero__bg {
    position: absolute; inset: 0;
    width: 100%; height: 100%;
    object-fit: cover;
    transform: scale(1.04);
    animation: heroZoom 14s ease-in-out forwards;
}
@keyframes heroZoom {
    from { transform: scale(1.06); }
    to   { transform: scale(1.00); }
}

.hs-hero__overlay {
    position: absolute; inset: 0;
    background: linear-gradient(
        160deg,
        rgba(15,12,8,0.55) 0%,
        rgba(15,12,8,0.72) 60%,
        rgba(15,12,8,0.85) 100%
    );
    z-index: 1;
}

.hs-hero__grain {
    position: absolute; inset: 0; z-index: 2;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none;
    opacity: 0.5;
}

.hs-hero__content {
    position: relative; z-index: 3;
    text-align: center;
    padding: 120px 20px 80px;
    width: 100%;
    animation: heroFadeUp 1.2s cubic-bezier(0.22, 1, 0.36, 1) 0.3s both;
}
@keyframes heroFadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

.hs-hero__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(201, 168, 76, 0.15);
    border: 1px solid rgba(201, 168, 76, 0.4);
    color: var(--gold-light);
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    padding: 7px 20px;
    border-radius: 100px;
    margin-bottom: 28px;
}

.hs-hero__title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.4rem, 6vw, 5.5rem);
    font-weight: 500;
    color: var(--white);
    line-height: 1.1;
    margin-bottom: 24px;
}

.hs-hero__title em {
    font-style: italic;
    color: var(--gold-light);
}

.hs-hero__subtitle {
    font-size: clamp(0.85rem, 1.5vw, 1rem);
    font-weight: 300;
    color: rgba(255,255,255,0.75);
    max-width: 520px;
    margin: 0 auto 42px;
    line-height: 1.8;
    letter-spacing: 0.02em;
}

.hs-hero__actions {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 14px;
}
@media (min-width: 480px) {
    .hs-hero__actions { flex-direction: row; justify-content: center; }
}

.btn-hs-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--gold);
    color: var(--white);
    font-family: 'Jost', sans-serif;
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 14px 34px;
    border-radius: 100px;
    border: 2px solid var(--gold);
    transition: all 0.3s ease;
    width: 100%;
    max-width: 240px;
    justify-content: center;
}
.btn-hs-primary:hover {
    background: transparent;
    color: var(--gold-light);
    border-color: var(--gold-light);
    transform: translateY(-2px);
}

.btn-hs-ghost {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    color: rgba(255,255,255,0.85);
    font-family: 'Jost', sans-serif;
    font-size: 0.78rem;
    font-weight: 500;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 14px 34px;
    border-radius: 100px;
    border: 2px solid rgba(255,255,255,0.4);
    transition: all 0.3s ease;
    width: 100%;
    max-width: 240px;
    justify-content: center;
}
.btn-hs-ghost:hover {
    border-color: rgba(255,255,255,0.9);
    color: var(--white);
    transform: translateY(-2px);
}

.hs-hero__scroll {
    position: absolute;
    bottom: 32px; left: 50%;
    transform: translateX(-50%);
    z-index: 4;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.4);
    font-size: 0.6rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    animation: scrollPulse 2.5s ease-in-out infinite;
}
@keyframes scrollPulse {
    0%, 100% { opacity: 0.4; transform: translateX(-50%) translateY(0); }
    50%       { opacity: 0.9; transform: translateX(-50%) translateY(4px); }
}
.hs-hero__scroll-line {
    width: 1px; height: 40px;
    background: linear-gradient(to bottom, rgba(201,168,76,0.8), transparent);
}

/* ================================================
   STATS BAR
   ================================================ */
.hs-stats {
    background: var(--charcoal);
    padding: 28px 0;
}
.hs-stats__inner {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 0;
}
.hs-stat-item {
    text-align: center;
    padding: 16px 40px;
    border-right: 1px solid rgba(255,255,255,0.08);
    flex: 1;
    min-width: 140px;
}
.hs-stat-item:last-child { border-right: none; }
.hs-stat-item__num {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--gold);
    font-weight: 600;
    line-height: 1;
    margin-bottom: 4px;
}
.hs-stat-item__label {
    font-size: 0.65rem;
    color: rgba(255,255,255,0.45);
    letter-spacing: 0.15em;
    text-transform: uppercase;
    font-weight: 400;
}

/* ================================================
   ABOUT SECTION
   ================================================ */
.hs-about {
    padding: 100px 0;
    overflow: hidden;
}

.hs-about__tag {
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 16px;
    display: block;
}

.hs-about__heading {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 4vw, 3.2rem);
    font-weight: 500;
    line-height: 1.2;
    color: var(--charcoal);
    margin-bottom: 24px;
}

.hs-about__heading em {
    font-style: italic;
    color: var(--gold);
}

.hs-about__body {
    font-size: 0.95rem;
    color: var(--slate);
    line-height: 1.9;
    margin-bottom: 32px;
    font-weight: 300;
}

.hs-about__social {
    display: flex;
    align-items: center;
    gap: 24px;
    flex-wrap: wrap;
}

.hs-social-link {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: var(--charcoal);
    transition: all 0.3s;
}
.hs-social-link:hover { color: var(--gold); transform: translateY(-2px); }

.hs-social-link__icon {
    width: 42px; height: 42px;
    border: 1px solid var(--border);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: var(--white);
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    transition: all 0.3s;
}
.hs-social-link:hover .hs-social-link__icon {
    background: var(--gold-soft);
    border-color: var(--gold);
}
.hs-social-link__label {
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
}

.hs-about__photo-wrap {
    position: relative;
}
.hs-about__photo-frame {
    position: absolute;
    top: -16px; right: -16px;
    width: calc(100% + 16px);
    height: calc(100% + 16px);
    border: 1px solid var(--gold);
    border-radius: 4px;
    z-index: 0;
    pointer-events: none;
}
.hs-about__photo {
    position: relative; z-index: 1;
    width: 100%; aspect-ratio: 4/5;
    object-fit: cover;
    border-radius: 4px;
    box-shadow: var(--shadow-gold);
}
.hs-about__badge {
    position: absolute;
    bottom: 28px; left: -28px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 16px 22px;
    box-shadow: var(--shadow-soft);
    z-index: 2;
    text-align: center;
    min-width: 130px;
}
.hs-about__badge-num {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    color: var(--gold);
    font-weight: 700;
    line-height: 1;
}
.hs-about__badge-text {
    font-size: 0.65rem;
    color: var(--muted);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-top: 4px;
}

/* ================================================
   WHY US
   ================================================ */
.hs-why {
    padding: 80px 0;
    background: var(--charcoal);
    position: relative;
    overflow: hidden;
}

.hs-why::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background:
        radial-gradient(ellipse 60% 80% at 80% 50%, rgba(201,168,76,0.06) 0%, transparent 70%),
        radial-gradient(ellipse 50% 60% at 10% 50%, rgba(201,168,76,0.04) 0%, transparent 70%);
}

.hs-why__eyebrow {
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 14px;
    display: block;
}

.hs-why__heading {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 3.5vw, 2.8rem);
    font-weight: 500;
    color: var(--white);
    margin-bottom: 60px;
}

.hs-why-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(201,168,76,0.2);
    border-radius: 16px;
    padding: 36px 28px;
    height: 100%;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}
.hs-why-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
    opacity: 0;
    transition: 0.4s;
}
.hs-why-card:hover {
    background: rgba(201,168,76,0.06);
    border-color: rgba(201,168,76,0.5);
    transform: translateY(-6px);
    box-shadow: 0 24px 48px rgba(0,0,0,0.25);
}
.hs-why-card:hover::before { opacity: 1; }

.hs-why-card__icon {
    width: 52px; height: 52px;
    border: 1px solid rgba(201,168,76,0.3);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 20px;
    color: var(--gold);
    background: rgba(201,168,76,0.08);
}

.hs-why-card__title {
    font-family: 'Playfair Display', serif;
    font-size: 1.15rem;
    color: var(--white);
    font-weight: 600;
    margin-bottom: 10px;
}

.hs-why-card__text {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.5);
    line-height: 1.7;
    font-weight: 300;
}

/* ================================================
   PORTFOLIO — FIXED & UPGRADED
   ================================================ */
.hs-portfolio {
    padding: 100px 0;
    background: var(--ivory);
}

.hs-section-tag {
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 14px;
    display: block;
}

.hs-section-heading {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 3.5vw, 3rem);
    font-weight: 500;
    color: var(--charcoal);
    margin-bottom: 10px;
}

.hs-section-heading em {
    font-style: italic;
    color: var(--gold);
}

/* Portfolio Filter */
.hs-porto-filter {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 8px;
    margin-bottom: 48px;
}

.hs-porto-filter-btn {
    font-family: 'Jost', sans-serif;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    padding: 9px 22px;
    border-radius: 100px;
    border: 1.5px solid rgba(201,168,76,0.3);
    background: transparent;
    color: var(--slate);
    cursor: pointer;
    transition: all 0.3s ease;
}
.hs-porto-filter-btn:hover {
    border-color: var(--gold);
    color: var(--gold);
}
.hs-porto-filter-btn.active {
    background: var(--gold);
    border-color: var(--gold);
    color: var(--white);
    box-shadow: 0 6px 20px rgba(201,168,76,0.3);
}

/* Masonry-style grid */
.hs-porto-grid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 16px;
}

/* Card size variants */
.hs-porto-item {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    cursor: pointer;
    background: var(--charcoal);
    transition: opacity 0.4s ease, transform 0.4s ease;
}

.hs-porto-item:nth-child(1)  { grid-column: span 8; grid-row: span 2; height: 520px; }
.hs-porto-item:nth-child(2)  { grid-column: span 4; height: 250px; }
.hs-porto-item:nth-child(3)  { grid-column: span 4; height: 250px; }
.hs-porto-item:nth-child(4)  { grid-column: span 4; height: 300px; }
.hs-porto-item:nth-child(5)  { grid-column: span 4; height: 300px; }
.hs-porto-item:nth-child(6)  { grid-column: span 4; height: 300px; }
.hs-porto-item:nth-child(n+7) { grid-column: span 4; height: 280px; }

@media (max-width: 991px) {
    .hs-porto-grid { grid-template-columns: repeat(6, 1fr); gap: 12px; }
    .hs-porto-item:nth-child(1)  { grid-column: span 6; height: 360px; }
    .hs-porto-item:nth-child(2)  { grid-column: span 3; height: 220px; }
    .hs-porto-item:nth-child(3)  { grid-column: span 3; height: 220px; }
    .hs-porto-item:nth-child(n+4) { grid-column: span 3; height: 220px; }
}

@media (max-width: 575px) {
    .hs-porto-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
    .hs-porto-item:nth-child(1)  { grid-column: span 2; height: 280px; }
    .hs-porto-item:nth-child(n+2) { grid-column: span 1; height: 180px; }
}

.hs-porto-item.hidden {
    display: none;
}

.hs-porto-card__img,
.hs-porto-card__video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.hs-porto-item:hover .hs-porto-card__img,
.hs-porto-item:hover .hs-porto-card__video {
    transform: scale(1.06);
}

/* Video play button overlay */
.hs-porto-play {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    width: 54px; height: 54px;
    background: rgba(201,168,76,0.9);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    z-index: 4;
    transition: all 0.3s;
    backdrop-filter: blur(4px);
}
.hs-porto-item:hover .hs-porto-play {
    background: var(--gold);
    transform: translate(-50%, -50%) scale(1.1);
}
.hs-porto-play svg {
    width: 22px; height: 22px;
    fill: #fff;
    margin-left: 3px;
}

.hs-porto-card__overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(12,10,6,0.88) 0%, rgba(12,10,6,0.2) 45%, transparent 100%);
    transition: opacity 0.4s;
    z-index: 2;
}

.hs-porto-card__body {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 24px 20px;
    z-index: 3;
    transform: translateY(8px);
    transition: transform 0.4s ease;
}
.hs-porto-item:hover .hs-porto-card__body { transform: translateY(0); }

.hs-porto-card__cat {
    display: inline-block;
    background: rgba(201,168,76,0.2);
    border: 1px solid rgba(201,168,76,0.5);
    color: var(--gold-light);
    font-size: 0.6rem;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 100px;
    margin-bottom: 8px;
}

.hs-porto-card__title {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    color: var(--white);
    font-weight: 500;
    margin: 0 0 4px;
    line-height: 1.3;
}

.hs-porto-card__desc {
    font-size: 0.78rem;
    color: rgba(255,255,255,0.55);
    margin: 0;
    font-weight: 300;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Empty state */
.hs-porto-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    color: var(--muted);
}
.hs-porto-empty svg {
    width: 56px; height: 56px;
    opacity: 0.2;
    margin-bottom: 1rem;
}

/* Load More */
.hs-porto-loadmore {
    text-align: center;
    margin-top: 48px;
}

/* ================================================
   LIGHTBOX
   ================================================ */
.hs-lightbox {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(10, 8, 5, 0.95);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
    animation: lbFadeIn 0.3s ease;
}
@keyframes lbFadeIn {
    from { opacity: 0; } to { opacity: 1; }
}
.hs-lightbox.open { display: flex; }

.hs-lightbox__close {
    position: absolute;
    top: 20px; right: 20px;
    width: 44px; height: 44px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    color: #fff;
    font-size: 1.2rem;
    transition: background 0.2s;
    z-index: 10;
    line-height: 1;
}
.hs-lightbox__close:hover { background: rgba(201,168,76,0.4); }

.hs-lightbox__nav {
    position: absolute;
    top: 50%; transform: translateY(-50%);
    width: 44px; height: 44px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    color: #fff;
    font-size: 1.1rem;
    transition: background 0.2s;
    z-index: 10;
    user-select: none;
}
.hs-lightbox__nav:hover { background: rgba(201,168,76,0.4); }
.hs-lightbox__nav.prev { left: 16px; }
.hs-lightbox__nav.next { right: 16px; }

@media (min-width: 768px) {
    .hs-lightbox__nav.prev { left: 28px; }
    .hs-lightbox__nav.next { right: 28px; }
}

.hs-lightbox__content {
    max-width: 90vw;
    max-height: 88vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
}

.hs-lightbox__media-wrap {
    position: relative;
    max-width: 100%;
    max-height: 75vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hs-lightbox__img {
    max-width: 88vw;
    max-height: 72vh;
    object-fit: contain;
    border-radius: 8px;
    display: block;
    animation: lbImgIn 0.35s cubic-bezier(0.22, 1, 0.36, 1);
}
@keyframes lbImgIn {
    from { opacity: 0; transform: scale(0.96); }
    to   { opacity: 1; transform: scale(1); }
}

.hs-lightbox__video {
    max-width: 88vw;
    max-height: 72vh;
    border-radius: 8px;
    display: block;
    background: #000;
}

.hs-lightbox__meta {
    text-align: center;
}
.hs-lightbox__title {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    color: #fff;
    font-weight: 500;
    margin-bottom: 4px;
}
.hs-lightbox__cat {
    font-size: 0.65rem;
    color: var(--gold);
    letter-spacing: 0.2em;
    text-transform: uppercase;
    font-weight: 600;
}
.hs-lightbox__counter {
    font-size: 0.72rem;
    color: rgba(255,255,255,0.35);
    letter-spacing: 0.1em;
    margin-top: 4px;
}

/* ================================================
   PACKAGES
   ================================================ */
.hs-packages {
    padding: 100px 0;
    background: var(--gold-soft);
    position: relative;
}
.hs-packages::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23C9A84C' fill-opacity='0.04'%3E%3Cpath d='M30 0L60 30L30 60L0 30z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}

/* Package Tabs */
.hs-tab-nav {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 50px;
    list-style: none;
    padding: 0;
}

.hs-tab-btn {
    font-family: 'Jost', sans-serif;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    padding: 10px 26px;
    border-radius: 100px;
    border: 1.5px solid rgba(201,168,76,0.4);
    background: transparent;
    color: var(--slate);
    cursor: pointer;
    transition: all 0.3s ease;
}
.hs-tab-btn:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: rgba(201,168,76,0.08);
}
.hs-tab-btn.active {
    background: var(--gold);
    border-color: var(--gold);
    color: var(--white);
    box-shadow: 0 6px 20px rgba(201,168,76,0.35);
}

/* Package Card */
.hs-pkg-card {
    background: var(--white);
    border: 1px solid rgba(201,168,76,0.2);
    border-radius: 20px;
    padding: 0;
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    transition: all 0.4s ease;
    box-shadow: 0 4px 24px rgba(0,0,0,0.05);
}
.hs-pkg-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-gold);
    border-color: var(--gold);
}

.hs-pkg-card__header {
    background: var(--charcoal);
    padding: 28px 28px 20px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.hs-pkg-card__header::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
}

.hs-pkg-card__name {
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    color: var(--white);
    font-weight: 600;
    letter-spacing: 0.05em;
    margin-bottom: 12px;
}

.hs-pkg-card__price {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--gold);
    font-weight: 700;
    line-height: 1;
}
.hs-pkg-card__price small {
    font-family: 'Jost', sans-serif;
    font-size: 0.75rem;
    color: rgba(255,255,255,0.4);
    font-weight: 300;
    display: block;
    margin-top: 4px;
}

.hs-pkg-card__body {
    padding: 28px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.hs-pkg-card__list {
    list-style: none;
    padding: 0;
    margin: 0 0 28px;
    flex-grow: 1;
}
.hs-pkg-card__list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid rgba(201,168,76,0.1);
    font-size: 0.85rem;
    color: var(--slate);
    line-height: 1.5;
}
.hs-pkg-card__list li:last-child { border-bottom: none; }
.hs-pkg-card__list li .check-icon {
    color: var(--gold);
    flex-shrink: 0;
    margin-top: 2px;
}

.btn-hs-book {
    display: block;
    text-align: center;
    background: var(--charcoal);
    color: var(--white);
    font-family: 'Jost', sans-serif;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 14px 24px;
    border-radius: 10px;
    border: 1.5px solid var(--charcoal);
    transition: all 0.3s ease;
    width: 100%;
}
.btn-hs-book:hover {
    background: var(--gold);
    border-color: var(--gold);
    color: var(--white);
    box-shadow: 0 8px 24px rgba(201,168,76,0.4);
}

/* Bootstrap nav override for this page */
#pills-tab .nav-link {
    font-family: 'Jost', sans-serif;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    padding: 10px 26px;
    border-radius: 100px;
    border: 1.5px solid rgba(201,168,76,0.4) !important;
    background: transparent !important;
    color: var(--slate) !important;
    transition: all 0.3s ease;
}
#pills-tab .nav-link:hover {
    border-color: var(--gold) !important;
    color: var(--gold) !important;
}
#pills-tab .nav-link.active {
    background: var(--gold) !important;
    border-color: var(--gold) !important;
    color: var(--white) !important;
    box-shadow: 0 6px 20px rgba(201,168,76,0.35);
}

/* ================================================
   CTA BANNER
   ================================================ */
.hs-cta {
    padding: 100px 0;
    background: var(--charcoal);
    position: relative;
    text-align: center;
    overflow: hidden;
}
.hs-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 70% 80% at 50% 50%, rgba(201,168,76,0.08), transparent 70%);
}
.hs-cta__quote {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.6rem, 3.5vw, 2.8rem);
    font-weight: 400;
    font-style: italic;
    color: var(--white);
    max-width: 700px;
    margin: 0 auto 14px;
    line-height: 1.4;
    position: relative; z-index: 1;
}
.hs-cta__sub {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.45);
    letter-spacing: 0.05em;
    margin-bottom: 42px;
    position: relative; z-index: 1;
}
.hs-cta__actions { position: relative; z-index: 1; }

/* ================================================
   FOOTER MINI
   ================================================ */
.hs-footer-mini {
    background: var(--ivory);
    border-top: 1px solid var(--border);
    padding: 28px 0;
    text-align: center;
}
.hs-footer-mini p {
    font-size: 0.72rem;
    color: var(--muted);
    letter-spacing: 0.06em;
    margin: 0;
}

/* ================================================
   ICON BOX (UTILITY)
   ================================================ */
.icon-box {
    width: 48px; height: 48px;
    border: 1px solid var(--border);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: var(--gold);
    background: var(--gold-soft);
}

/* ================================================
   AOS / ANIMATION
   ================================================ */
[data-aos] { transition-duration: 0.7s !important; }

/* ================================================
   RESPONSIVE ADJUSTMENTS
   ================================================ */
@media (max-width: 767px) {
    .hs-about { padding: 60px 0; }
    .hs-portfolio { padding: 60px 0; }
    .hs-packages { padding: 60px 0; }
    .hs-why { padding: 60px 0; }
    .hs-cta { padding: 60px 0; }
    .hs-stat-item { min-width: 110px; padding: 14px 20px; }
    .hs-about__badge { left: -8px; }
    .hs-about__photo-frame { display: none; }
}
</style>

{{-- ================================================
     HERO
     ================================================ --}}
<section class="hs-hero">
    <img
        src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1600&q=85"
        class="hs-hero__bg"
        alt="Hiddi Story Wedding"
    >
    <div class="hs-hero__overlay"></div>
    <div class="hs-hero__grain"></div>

    <div class="container hs-hero__content">
        <div class="hs-hero__eyebrow">
            <span class="gold-dot"></span>
            Hiddi Story · Est. 2023
            <span class="gold-dot"></span>
        </div>
        <h1 class="hs-hero__title">
            Every Love Story<br>
            Deserves to Be <em>Remembered</em>
        </h1>
        <p class="hs-hero__subtitle">
            Kami mengabadikan setiap momen pernikahanmu menjadi warisan visual yang tak terlupakan — dengan ketelitian, keindahan, dan hati.
        </p>
        <div class="hs-hero__actions">
            <a href="#packages" class="btn-hs-primary">Explore Packages</a>
            <a href="#portfolio" class="btn-hs-ghost">View Our Work</a>
        </div>
    </div>

    <div class="hs-hero__scroll">
        <div class="hs-hero__scroll-line"></div>
        <span>Scroll</span>
    </div>
</section>

{{-- ================================================
     STATS BAR
     ================================================ --}}
<div class="hs-stats">
    <div class="container">
        <div class="hs-stats__inner">
            <div class="hs-stat-item">
                <div class="hs-stat-item__num">200+</div>
                <div class="hs-stat-item__label">Happy Couples</div>
            </div>
            <div class="hs-stat-item">
                <div class="hs-stat-item__num">2+</div>
                <div class="hs-stat-item__label">Years of Experience</div>
            </div>
            <div class="hs-stat-item">
                <div class="hs-stat-item__num">15+</div>
                <div class="hs-stat-item__label">Packages Available</div>
            </div>
            <div class="hs-stat-item">
                <div class="hs-stat-item__num">100%</div>
                <div class="hs-stat-item__label">Client Satisfaction</div>
            </div>
        </div>
    </div>
</div>

{{-- ================================================
     ABOUT
     ================================================ --}}
<section id="about" class="hs-about">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right">
                <span class="hs-about__tag">Our Story</span>
                <h2 class="hs-about__heading">
                    Crafting Beautiful Moments<br>
                    Into <em>Timeless Memories</em>
                </h2>
                <p class="hs-about__body">
                    Didirikan pada 2023, <strong>Hiddi Story</strong> lahir dari keyakinan bahwa setiap pasangan berhak mendapatkan kenangan visual yang mewah dan personal. Kami bukan sekadar fotografer — kami adalah pencerita yang memadukan estetika tinggi dengan emosi terdalam dari hari terspesialmu.
                </p>
                <p class="hs-about__body" style="margin-bottom: 36px;">
                    Dengan pendekatan yang hangat dan profesional, kami hadir dari sesi prewedding hingga detik-detik sacred di altar — memastikan setiap frame menjadi karya seni.
                </p>
                <div class="hs-about__social">
                    <a href="https://www.instagram.com/hiddi.story?igsh=cGE1M3JsejI5cDc=" class="hs-social-link">
                        <div class="hs-social-link__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <circle cx="12" cy="12" r="4"></circle>
                                <circle cx="17.5" cy="6.5" r="1.2" fill="currentColor" stroke="none"></circle>
                            </svg>
                        </div>
                        <span class="hs-social-link__label">Instagram</span>
                    </a>
                    <div style="width: 1px; height: 28px; background: var(--border);"></div>
                    <a href="https://maps.app.goo.gl/kb7HggNeeRZZvRqj6" class="hs-social-link">
                        <div class="hs-social-link__icon">
                            <i data-lucide="map-pin" width="18"></i>
                        </div>
                        <span class="hs-social-link__label">Location</span>
                    </a>
                    <div style="width: 1px; height: 28px; background: var(--border);"></div>
                    <a href="https://wa.me/6282124591059" target="_blank" class="hs-social-link">
                        <div class="hs-social-link__icon">
                            <i data-lucide="message-circle" width="18"></i>
                        </div>
                        <span class="hs-social-link__label">WhatsApp</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
                <div class="hs-about__photo-wrap ps-lg-4 ms-lg-3">
                    <div class="hs-about__photo-frame"></div>
                    <img
                        src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=800&q=80"
                        class="hs-about__photo"
                        alt="Hiddi Story Photography"
                    >
                    <div class="hs-about__badge">
                        <div class="hs-about__badge-num">Est.</div>
                        <div class="hs-about__badge-num" style="font-size: 1.5rem;">2023</div>
                        <div class="hs-about__badge-text">Subang, ID</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================================================
     WHY US
     ================================================ --}}
<section class="hs-why">
    <div class="container">
        <div class="text-center mb-4" data-aos="fade-up">
            <span class="hs-why__eyebrow">Why Hiddi Story</span>
            <h2 class="hs-why__heading">The Standard We Never Compromise</h2>
        </div>
        <div class="row g-4" data-aos="fade-up" data-aos-delay="100">
            <div class="col-md-4">
                <div class="hs-why-card">
                    <div class="hs-why-card__icon">
                        <i data-lucide="sparkles" width="22"></i>
                    </div>
                    <h5 class="hs-why-card__title">Custom Visual Branding</h5>
                    <p class="hs-why-card__text">
                        Setiap identitas visual dirancang eksklusif — mencerminkan kepribadian dan kisah unik Anda berdua.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="hs-why-card">
                    <div class="hs-why-card__icon">
                        <i data-lucide="crown" width="22"></i>
                    </div>
                    <h5 class="hs-why-card__title">Premium Quality Output</h5>
                    <p class="hs-why-card__text">
                        Kami hanya bekerja sama dengan vendor dan peralatan terbaik untuk menghasilkan karya berkualitas gallery.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="hs-why-card">
                    <div class="hs-why-card__icon">
                        <i data-lucide="heart-handshake" width="22"></i>
                    </div>
                    <h5 class="hs-why-card__title">Full-Day Dedication</h5>
                    <p class="hs-why-card__text">
                        Dari persiapan hingga resepsi, tim kami hadir penuh memberikan pendampingan dan ketenangan pikiran.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ================================================
     PORTFOLIO — FIXED
     Taruh section ini menggantikan section portfolio lama
     ================================================ --}}
<section id="portfolio" class="hs-portfolio">
    <div class="container">

        {{-- Section Header --}}
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="hs-section-tag">Our Portfolio</span>
            <h2 class="hs-section-heading">Stories We Have <em>Told</em></h2>
            <div class="gold-line mt-3">
                <span class="gold-dot"></span>
            </div>
            <p class="mt-3" style="font-size: 0.9rem; color: var(--slate); max-width: 420px; margin: 12px auto 0; line-height: 1.7; font-weight: 300;">
                Setiap karya adalah bukti cinta yang kami abadikan dengan sepenuh jiwa.
            </p>
        </div>

        @php
            $portoCategories = $portfolios->map(function($p) {
                return optional($p->category)->name;
            })->filter()->unique()->values();
        @endphp

        {{-- Filter Buttons --}}
        @if($portoCategories->count() > 1)
        <div class="hs-porto-filter" data-aos="fade-up" data-aos-delay="80">
            <button class="hs-porto-filter-btn active" data-cat="all">Semua</button>
            @foreach($portoCategories as $cat)
                <button class="hs-porto-filter-btn" data-cat="{{ $cat }}">{{ $cat }}</button>
            @endforeach
        </div>
        @endif

        {{-- Portfolio Grid --}}
        @if($portfolios->count() > 0)
        <div class="hs-porto-grid" id="portoGrid" data-aos="fade-up" data-aos-delay="100">

            @foreach($portfolios as $index => $porto)
            <div class="hs-porto-item"
                 data-cat="{{ optional($porto->category)->name }}"
                 data-index="{{ $index }}"
                 onclick="openLightbox({{ $index }})">

                @if($porto->type === 'image' && $porto->image_path)
                    {{-- FOTO --}}
                    <img
                        src="{{ asset('storage/' . $porto->image_path) }}"
                        class="hs-porto-card__img"
                        alt="{{ $porto->title }}"
                        loading="lazy"
                        onerror="this.onerror=null; this.parentElement.querySelector('.hs-porto-placeholder') && (this.style.display='none');"
                    >

                @elseif($porto->type === 'video' && $porto->video_path)
                    {{-- VIDEO THUMBNAIL --}}
                    <video
                        class="hs-porto-card__video"
                        autoplay
                        loop
                        muted
                        playsinline
                        preload="auto"
                        style="pointer-events:none;">
                        <source src="{{ asset('storage/' . $porto->video_path) }}" type="video/mp4">
                    </video>
                    {{-- Play Icon --}}
                    <div class="hs-porto-play">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg>
                    </div>

                @else
                    {{-- FALLBACK PLACEHOLDER --}}
                    <div class="hs-porto-placeholder" style="width:100%;height:100%;background:#1a1a1a;display:flex;align-items:center;justify-content:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(201,168,76,0.4)" stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                        </svg>
                    </div>
                @endif

                <div class="hs-porto-card__overlay"></div>
                <div class="hs-porto-card__body">
                    @if(optional($porto->category)->name)
                        <span class="hs-porto-card__cat">{{ $porto->category->name }}</span>
                    @endif
                    <h6 class="hs-porto-card__title">{{ $porto->title }}</h6>
                    @if($porto->description)
                        <p class="hs-porto-card__desc">{{ $porto->description }}</p>
                    @endif
                </div>

            </div>
            @endforeach

        </div>

        @if($portfolios->count() > 9)
        <div class="hs-porto-loadmore" id="loadMoreWrap">
            <button class="btn-hs-ghost" id="loadMoreBtn"
                    style="max-width:220px; margin:0 auto; border-color:rgba(201,168,76,0.4); color:var(--slate);"
                    onclick="loadMore()">
                Lihat Semua Karya
            </button>
        </div>
        @endif

        @else
        <div class="hs-porto-grid">
            <div class="hs-porto-empty">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="width:56px;height:56px;opacity:.2;margin-bottom:1rem;"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                <p style="font-family:'Playfair Display',serif;font-size:1.2rem;color:var(--charcoal);margin-bottom:8px;">Portofolio segera hadir</p>
                <p style="font-size:.85rem;color:var(--muted);">Karya-karya terbaik kami sedang disiapkan untuk Anda.</p>
            </div>
        </div>
        @endif

    </div>
</section>

{{-- ================================================
     LIGHTBOX
     ================================================ --}}
<div class="hs-lightbox" id="hsLightbox">
    <button class="hs-lightbox__close" onclick="closeLightbox()">&#x2715;</button>
    <button class="hs-lightbox__nav prev" onclick="shiftLightbox(-1)">&#8592;</button>
    <button class="hs-lightbox__nav next" onclick="shiftLightbox(1)">&#8594;</button>
    <div class="hs-lightbox__content">
        <div class="hs-lightbox__media-wrap" id="lbMediaWrap"></div>
        <div class="hs-lightbox__meta">
            <div class="hs-lightbox__cat" id="lbCat"></div>
            <div class="hs-lightbox__title" id="lbTitle"></div>
            <div class="hs-lightbox__counter" id="lbCounter"></div>
        </div>
    </div>
</div>

{{-- ================================================
     PACKAGES
     ================================================ --}}
<section id="packages" class="hs-packages">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="hs-section-tag">Our Packages</span>
            <h2 class="hs-section-heading">An Investment in <em>Forever</em></h2>
            <p class="mt-3" style="font-size: 0.9rem; color: var(--slate); max-width: 460px; margin: 12px auto 0; line-height: 1.7;">
                Pilih paket yang paling sesuai dengan hari impianmu. Setiap paket dirancang untuk memberikan nilai terbaik.
            </p>
        </div>

        <div class="d-flex justify-content-center overflow-auto pb-3 mb-2">
            <ul class="nav nav-pills flex-nowrap gap-2" id="pills-tab" role="tablist">
                @foreach($packages as $category => $items)
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link {{ $loop->first ? 'active' : '' }}"
                        data-bs-toggle="pill"
                        data-bs-target="#pills-{{ Str::slug($category) }}"
                        type="button"
                        role="tab"
                    >
                        {{ strtoupper($category) }}
                    </button>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="tab-content mt-4">
            @foreach($packages as $category => $items)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-{{ Str::slug($category) }}" role="tabpanel">
                <div class="row g-4 justify-content-center">
                    @foreach($items as $package)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <div class="hs-pkg-card">
                            <div class="hs-pkg-card__header">
                                <h5 class="hs-pkg-card__name">{{ $package->name }}</h5>
                                <div class="hs-pkg-card__price">
                                    Rp {{ number_format($package->price, 0, ',', '.') }}
                                    <small>Starting price</small>
                                </div>
                            </div>
                            <div class="hs-pkg-card__body">
                                <ul class="hs-pkg-card__list">
                                    @foreach($package->includes->take(6) as $inc)
                                    <li>
                                        <i data-lucide="check" class="check-icon" width="15"></i>
                                        <span>{{ $inc->title }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('package.detail', $package->id) }}" class="btn-hs-book">
                                    Secure Your Date
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================================================
     CTA BANNER
     ================================================ --}}
<section class="hs-cta">
    <div class="container">
        <div class="gold-line mb-4 justify-content-center">
            <span class="gold-dot"></span>
        </div>
        <p class="hs-cta__quote" data-aos="fade-up">
            "The best thing to hold onto in life<br>is each other."
        </p>
        <p class="hs-cta__sub" data-aos="fade-up" data-aos-delay="100">— Audrey Hepburn · Let us tell your story.</p>
        <div class="hs-cta__actions" data-aos="fade-up" data-aos-delay="200">
            <a href="#packages" class="btn-hs-primary" style="max-width: 280px; margin: 0 auto;">
                Start Your Journey
            </a>
        </div>
    </div>
</section>

{{-- ================================================
     FOOTER MINI
     ================================================ --}}
<div class="hs-footer-mini">
    <div class="container">
        <p>© {{ date('Y') }} Hiddi Story · Est. 2023 · Subang, Indonesia · All rights reserved.</p>
    </div>
</div>

{{-- ================================================
     SCRIPTS — PORTFOLIO FILTER & LIGHTBOX
     ================================================ --}}
<script>
(function () {

    // DATA DARI PHP
    var lbData = [
        @foreach($portfolios as $porto)
        {
            type:  '{{ $porto->type }}',
            src:   '{{ $porto->type === "video" && $porto->video_path 
                        ? asset("storage/".$porto->video_path) 
                        : ($porto->image_path ? asset("storage/".$porto->image_path) : "") }}',
            title: '{{ addslashes($porto->title) }}',
            cat:   '{{ addslashes(optional($porto->category)->name ?? "uncategorized") }}',
        },
        @endforeach
    ];

    var currentIdx = 0;

    // ================= FILTER =================
    document.querySelectorAll('.hs-porto-filter-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {

            document.querySelectorAll('.hs-porto-filter-btn').forEach(function (b) {
                b.classList.remove('active');
            });

            this.classList.add('active');
            var cat = this.dataset.cat;

            document.querySelectorAll('.hs-porto-item').forEach(function (item) {
                var match = cat === 'all' || item.dataset.cat === cat;
                item.classList.toggle('hidden', !match);
            });

        });
    });

    // ================= LOAD MORE =================
    var items = document.querySelectorAll('.hs-porto-item');

    if (items.length > 9) {
        items.forEach(function (item, i) {
            if (i >= 9) item.style.display = 'none';
        });
    }

    window.loadMore = function () {
        items.forEach(function (item) {
            item.style.display = '';
        });
        var w = document.getElementById('loadMoreWrap');
        if (w) w.style.display = 'none';
    };

    // ================= LIGHTBOX =================
    window.openLightbox = function (idx) {
        currentIdx = idx;
        render();
        document.getElementById('hsLightbox').classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    window.closeLightbox = function () {
        var lb = document.getElementById('hsLightbox');
        lb.classList.remove('open');
        document.body.style.overflow = '';

        var v = lb.querySelector('video');
        if (v) v.pause();
    };

    window.shiftLightbox = function (dir) {
        var v = document.querySelector('#hsLightbox video');
        if (v) v.pause();

        currentIdx = (currentIdx + dir + lbData.length) % lbData.length;
        render();
    };

    function render() {
        var d = lbData[currentIdx];
        if (!d) return;

        var wrap = document.getElementById('lbMediaWrap');
        wrap.innerHTML = '';

        if (d.type === 'video' && d.src) {
            var v = document.createElement('video');
            v.className = 'hs-lightbox__video';
            v.controls  = true;
            v.autoplay  = true;
            v.innerHTML = '<source src="' + d.src + '" type="video/mp4">';
            wrap.appendChild(v);
        } else if (d.src) {
            var img = document.createElement('img');
            img.src = d.src;
            img.className = 'hs-lightbox__img';
            img.alt = d.title;
            wrap.appendChild(img);
        }

        document.getElementById('lbTitle').textContent   = d.title;
        document.getElementById('lbCat').textContent     = d.cat;
        document.getElementById('lbCounter').textContent = (currentIdx + 1) + ' / ' + lbData.length;
    }

    // CLOSE CLICK OUTSIDE
    document.getElementById('hsLightbox').addEventListener('click', function (e) {
        if (e.target === this) closeLightbox();
    });

    // KEYBOARD
    document.addEventListener('keydown', function (e) {
        if (!document.getElementById('hsLightbox').classList.contains('open')) return;

        if (e.key === 'Escape')     closeLightbox();
        if (e.key === 'ArrowLeft')  shiftLightbox(-1);
        if (e.key === 'ArrowRight') shiftLightbox(1);
    });

})();
</script>
@endsection