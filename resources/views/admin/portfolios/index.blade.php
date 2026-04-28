@extends('layouts.app')

@section('content')

<style>
    :root {
        --accent: #c9a96e;
        --accent-light: #e8d5b0;
        --dark: #1a1a1a;
        --card-radius: 20px;
    }

    .portfolio-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .portfolio-title {
        font-size: 1.75rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: var(--dark);
        margin: 0;
    }

    .portfolio-subtitle {
        color: #888;
        font-size: 0.85rem;
        margin: 0.25rem 0 0;
    }

    .btn-upload {
        background: var(--dark);
        color: #fff;
        border: 1px solid var(--accent);
        border-radius: 12px;
        padding: 0.6rem 1.4rem;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s;
    }

    .btn-upload:hover {
        background: #333;
        color: var(--accent);
        transform: translateY(-1px);
    }

    /* Filter Bar */
    .filter-bar {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
    }

    .filter-btn {
        background: #f4f4f4;
        border: 1.5px solid transparent;
        border-radius: 50px;
        padding: 0.4rem 1.1rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: #555;
        cursor: pointer;
        transition: all 0.2s;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: var(--dark);
        color: #fff;
        border-color: var(--accent);
    }

    /* Portfolio Grid */
    .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1.5rem;
    }

    /* Card */
    .portfolio-card {
        background: #fff;
        border-radius: var(--card-radius);
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        transition: transform 0.25s, box-shadow 0.25s;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .portfolio-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 28px rgba(0,0,0,0.13);
    }

    /* Media Area */
    .card-media {
        position: relative;
        height: 210px;
        overflow: hidden;
        background: #f0f0f0;
    }

    .card-media img,
    .card-media video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .portfolio-card:hover .card-media img {
        transform: scale(1.04);
    }

    /* Overlay on hover */
    .card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.55) 0%, transparent 55%);
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        align-items: flex-end;
        padding: 1rem;
    }

    .portfolio-card:hover .card-overlay {
        opacity: 1;
    }

    .card-overlay-text {
        color: #fff;
        font-size: 0.75rem;
        line-height: 1.4;
        font-style: italic;
        max-width: 100%;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    /* Badge */
    .card-badge {
        position: absolute;
        top: 0.65rem;
        left: 0.65rem;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(6px);
        color: #fff;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding: 0.3rem 0.7rem;
        border-radius: 20px;
        z-index: 5;
    }

    .badge-featured {
        position: absolute;
        top: 0.65rem;
        right: 0.65rem;
        background: var(--accent);
        color: #fff;
        font-size: 0.65rem;
        padding: 0.3rem 0.5rem;
        border-radius: 20px;
        z-index: 5;
        display: flex;
        align-items: center;
        gap: 3px;
    }

    /* Type Tag */
    .type-tag {
        position: absolute;
        bottom: 0.65rem;
        right: 0.65rem;
        background: rgba(255,255,255,0.18);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255,255,255,0.3);
        color: #fff;
        font-size: 0.65rem;
        font-weight: 600;
        padding: 0.25rem 0.6rem;
        border-radius: 6px;
        z-index: 5;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Card Body */
    .card-body-custom {
        padding: 1rem 1rem 0.85rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0 0 0.3rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-desc {
        font-size: 0.78rem;
        color: #aaa;
        margin: 0;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        flex: 1;
    }

    .card-footer-custom {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        border-top: 1px solid #f0f0f0;
        padding: 0.65rem 1rem;
        gap: 0.4rem;
        margin-top: 0.75rem;
    }

    .btn-action {
        background: #f5f5f5;
        border: none;
        border-radius: 8px;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.15s, color 0.15s;
        text-decoration: none;
        color: #555;
    }

    .btn-action:hover {
        background: #e8e8e8;
        color: var(--dark);
    }

    .btn-action.danger:hover {
        background: #ffeaea;
        color: #d9534f;
    }

    /* Empty State */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 5rem 2rem;
        background: #fff;
        border-radius: var(--card-radius);
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 1.25rem;
        opacity: 0.2;
    }

    .empty-state h5 {
        font-weight: 700;
        color: #333;
        margin-bottom: 0.4rem;
    }

    .empty-state p {
        font-size: 0.85rem;
        color: #aaa;
    }

    /* Stats bar */
    .stats-bar {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.82rem;
        color: #666;
    }

    .stat-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    @media (max-width: 576px) {
        .portfolio-grid {
            grid-template-columns: 1fr;
        }

        .portfolio-title {
            font-size: 1.4rem;
        }
    }
    .portfolio-card video {
    transition: transform 0.4s ease;
}

.portfolio-card:hover video {
    transform: scale(1.05);
}
</style>

{{-- HEADER --}}
<div class="portfolio-header">
    <div>
        <h3 class="portfolio-title">Visual Portfolio</h3>
        <p class="portfolio-subtitle">Kelola karya terbaik untuk ditampilkan kepada calon pelanggan.</p>
    </div>
    <a href="{{ route('admin.portfolios.create') }}" class="btn-upload">
        <i data-lucide="image-plus" style="width:16px;"></i>
        Upload Karya
    </a>
</div>

{{-- STATS BAR --}}
@if($portfolios->count() > 0)
<div class="stats-bar">
    <div class="stat-item">
        <span class="stat-dot" style="background:#1a1a1a;"></span>
        <strong>{{ $portfolios->count() }}</strong>&nbsp;total karya
    </div>
    <div class="stat-item">
        <span class="stat-dot" style="background:var(--accent);"></span>
        <strong>{{ $portfolios->where('is_featured', true)->count() }}</strong>&nbsp;unggulan
    </div>
    <div class="stat-item">
        <span class="stat-dot" style="background:#5b9bd5;"></span>
        <strong>{{ $portfolios->where('type','image')->count() }}</strong>&nbsp;foto
    </div>
    <div class="stat-item">
        <span class="stat-dot" style="background:#d97706;"></span>
        <strong>{{ $portfolios->where('type','video')->count() }}</strong>&nbsp;video
    </div>
</div>
@endif

{{-- FILTER --}}
@if($portfolios->count() > 0)
<div class="filter-bar">
    <button class="filter-btn active" data-filter="all">Semua</button>
    @foreach($categories as $cat)
        <button class="filter-btn" data-filter="{{ $cat->id }}">{{ $cat->name }}</button>
    @endforeach
</div>
@endif

{{-- GRID --}}
<div class="portfolio-grid" id="portfolioGrid">

    @forelse($portfolios as $item)
    <div class="portfolio-card" data-category="{{ $item->category_id }}">

        {{-- MEDIA --}}
        <div class="card-media">

            {{-- Category Badge --}}
            <span class="card-badge">{{ $item->category->name ?? 'Uncategorized' }}</span>

            {{-- Featured Badge --}}
            @if($item->is_featured)
            <span class="badge-featured">
                <i data-lucide="star" style="width:11px;fill:#fff;"></i> Unggulan
            </span>
            @endif

            {{-- Type Tag --}}
            <span class="type-tag">
                @if($item->type == 'image')
                    <i data-lucide="image" style="width:10px;display:inline;"></i> Foto
                @else
                    <i data-lucide="film" style="width:10px;display:inline;"></i> Video
                @endif
            </span>

            {{-- Media Content --}}
            @if($item->type == 'image')
                @if($item->image_path)
                    <img src="{{ asset('storage/' . $item->image_path) }}"
                         alt="{{ $item->title }}"
                         loading="lazy"
                         onerror="this.onerror=null;this.src='https://placehold.co/400x300/f0f0f0/aaaaaa?text=No+Image';">
                @else
                    <img src="https://placehold.co/400x300/f0f0f0/aaaaaa?text=No+Image" alt="No Image">
                @endif
            @else
                @if($item->video_path)
<video autoplay muted loop playsinline 
style="width:100%;height:100%;object-fit:cover;">
    <source src="{{ asset('storage/' . $item->video_path) }}" type="video/mp4">
</video>
                    {{-- Fallback placeholder if video fails --}}
                    <div style="display:none; width:100%; height:100%; align-items:center; justify-content:center; background:#1a1a1a; flex-direction:column; gap:0.5rem;">
                        <i data-lucide="video-off" style="width:36px; color:#666;"></i>
                        <span style="font-size:0.75rem; color:#666;">Video tidak tersedia</span>
                    </div>
                @else
                    <div style="display:flex; width:100%; height:100%; align-items:center; justify-content:center; background:#1a1a1a; flex-direction:column; gap:0.5rem;">
                        <i data-lucide="video-off" style="width:36px; color:#555;"></i>
                        <span style="font-size:0.75rem; color:#555;">Belum ada video</span>
                    </div>
                @endif
            @endif

            {{-- Description Overlay --}}
            @if($item->description)
            <div class="card-overlay">
                <span class="card-overlay-text">{{ $item->description }}</span>
            </div>
            @endif
        </div>

        {{-- CARD BODY --}}
        <div class="card-body-custom">
            <h6 class="card-title" title="{{ $item->title }}">{{ $item->title }}</h6>
            <p class="card-desc">{{ $item->description ?? 'Belum ada deskripsi.' }}</p>
        </div>

        {{-- CARD FOOTER --}}
        <div class="card-footer-custom">
            <a href="{{ route('admin.portfolios.edit', $item->id) }}"
               class="btn-action" title="Edit">
                <i data-lucide="edit-2" style="width:14px;"></i>
            </a>

            <form action="{{ route('admin.portfolios.destroy', $item->id) }}"
                  method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin ingin menghapus karya ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action danger" title="Hapus">
                    <i data-lucide="trash-2" style="width:14px;"></i>
                </button>
            </form>
        </div>

    </div>
    @empty

    <div class="empty-state">
        <div class="empty-icon">
            <i data-lucide="camera-off" style="width:64px; height:64px;"></i>
        </div>
        <h5>Belum ada portfolio</h5>
        <p>Mulai upload karya terbaik Anda dan tampilkan kepada dunia.</p>
        <a href="{{ route('admin.portfolios.create') }}" class="btn-upload" style="display:inline-flex; margin-top:1rem;">
            <i data-lucide="plus" style="width:15px;"></i>
            Tambah Karya Pertama
        </a>
    </div>

    @endforelse
</div>

<script>
    // Filter Logic
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            document.querySelectorAll('.portfolio-card').forEach(card => {
                if (filter === 'all' || card.dataset.category == filter) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

function togglePlay(video) {
    if (video.paused) {
        video.muted = false; // penting!
        video.play().catch(err => {
            console.log("Play gagal:", err);
        });
    } else {
        video.pause();
    }

}   
</script>

@endsection