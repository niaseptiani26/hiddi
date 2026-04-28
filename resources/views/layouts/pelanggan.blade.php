<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Wedding Dream | WO & Planner</title>
        
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap" rel="stylesheet">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/confetti.css">

        <script src="https://unpkg.com/lucide@latest"></script>

        <style>
            :root {
                --primary-color: #D4AF37; /* Gold */
                --dark-color: #1a1a1a;
                --soft-bg: #fdfbf8;
            }
            /* Menyesuaikan warna kalender agar senada dengan tema Gold */
            .flatpickr-day.selected { background: var(--primary-color) !important; border-color: var(--primary-color) !important; }
            
            body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--soft-bg); color: var(--dark-color); }
            h1, h2, h3, .navbar-brand { font-family: 'Playfair Display', serif; }
            
                        .navbar { transition: all 0.3s; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); }
            .hero-section { 
                padding: 120px 0; 
                background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1920&q=80');
                background-size: cover;
                background-position: center;
                color: white;
                border-radius: 0 0 50px 50px;
            }
            .card-porto {
                border: none; border-radius: 25px; overflow: hidden; transition: 0.4s;
            }
            .card-porto:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
            .btn-gold { 
                background: var(--primary-color); color: white; border-radius: 50px; 
                padding: 12px 30px; border: none; font-weight: 600;
            }
            .btn-gold:hover { background: #b8962d; color: white; }
            /* Styling untuk Tab Kategori */
.nav-pills .nav-link {
    color: var(--dark-color);
    border: 1px solid #ddd;
    background: white;
    transition: all 0.3s ease;
}

.nav-pills .nav-link.active {
    background-color: var(--primary-color) !important;
    color: white !important;
    border-color: var(--primary-color);
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
}

.bg-gold-soft {
    background-color: rgba(212, 175, 55, 0.1);
    color: #b8962d;
}

.transition-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.transition-hover:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

/* Optimasi Responsif untuk Mobile */
@media (max-width: 768px) {
    .display-2 { font-size: 2.5rem; }
    .hero-section { padding: 80px 0; border-radius: 0 0 30px 30px; }
    .nav-pills { flex-wrap: nowrap; overflow-x: auto; padding-bottom: 10px; justify-content: flex-start !important; }
    .nav-item { white-space: nowrap; }
}

.hero-section {
    position: relative;
    height: 100vh;
    overflow: hidden;
}

/* video background */
.hero-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
}

/* overlay gelap */
.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 1;
}

/* konten di atas video */
.hero-content {
    position: relative;
    z-index: 2;
}

.swal2-styled.swal2-confirm {
    background: linear-gradient(135deg, #D4AF37 0%, #B8962E 100%) !important;
    border-radius: 10px !important;
    padding: 10px 30px !important;
    font-weight: 600 !important;
}
.swal2-popup {
    border-radius: 20px !important;
    font-family: 'Poppins', sans-serif; /* atau font yang Anda gunakan */
}
        </style>
    </head>
    <body>
        @yield('content')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({ duration: 1000, once: true });
            lucide.createIcons();
        </script>
        
        @stack('scripts')
    </body>
    </html>