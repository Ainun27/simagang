<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Program Magang - Diskominfosantik</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --success: #4cc9f0;
            --dark: #212529;
            --light: #f8f9fa;
            --gray: #6c757d;
            --warning: #ffc107;
            --danger: #dc3545;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            color: var(--light);
            position: relative;
            overflow-x: hidden;
        }

        /* Background Animation */
        .bg-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.15) 0%, rgba(102, 126, 234, 0) 70%);
            border-radius: 50%;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        /* Navbar */
        .navbar {
            background: rgba(26, 26, 46, 0.85);
            backdrop-filter: blur(20px);
            padding: 1rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .navbar-brand i {
            color: var(--success);
        }

        .navbar-menu {
            display: flex;
            gap: 1rem;
            list-style: none;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: 0.7rem 1.2rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateY(-2px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.3), rgba(118, 75, 162, 0.3));
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        /* Hamburger Menu - HIDDEN di desktop */
        .navbar-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .navbar-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        /* Card */
        .card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            color: var(--dark);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-weight: 700;
        }

        /* Syarat & Ketentuan dengan icon */
        .requirement-list {
            list-style: none;
        }

        .requirement-list li {
            margin-bottom: 1rem;
            padding-left: 2.5rem;
            position: relative;
            font-size: 1.05rem;
            line-height: 1.6;
        }

        .requirement-list li i {
            position: absolute;
            left: 0;
            top: 0.25rem;
            color: var(--success);
            font-size: 1.25rem;
        }

        /* Timeline dengan animasi */
        .timeline {
            position: relative;
            padding-left: 3rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 1rem;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
            padding: 1rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .timeline-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(10px);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -2rem;
            top: 1.5rem;
            width: 20px;
            height: 20px;
            background: var(--success);
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 0 0 4px rgba(76, 201, 240, 0.2);
            z-index: 2;
        }

        .timeline-number {
            position: absolute;
            left: -2.35rem;
            top: 1.25rem;
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            z-index: 3;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* FAQ dengan dropdown effect */
        .faq-item {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            border-left: 4px solid var(--primary);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .faq-item:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.08), rgba(118, 75, 162, 0.08));
            transform: translateX(5px);
        }

        .faq-question {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .faq-question i {
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-question i {
            transform: rotate(90deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            color: var(--gray);
            line-height: 1.6;
        }

        .faq-item.active .faq-answer {
            max-height: 200px;
        }

        /* Benefit Cards */
        .benefit-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .benefit-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
        }

        .benefit-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .benefit-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .benefit-desc {
            color: var(--gray);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Button */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 1.05rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
        }

        /* Kontak Info - FIX untuk email panjang */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .contact-item {
            text-align: center;
            padding: 1.5rem;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contact-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .contact-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--primary);
            flex-shrink: 0;
        }

        .contact-content {
            width: 100%;
            overflow: hidden;
        }

        .contact-title {
            margin-bottom: 0.5rem;
            color: var(--primary);
            font-size: 1.1rem;
            font-weight: 600;
        }

        .contact-text {
            color: var(--gray);
            font-size: 0.95rem;
            line-height: 1.5;
            word-break: break-word;
            overflow-wrap: break-word;
            padding: 0 0.5rem;
        }

        /* RESPONSIVE FIX - BAGIAN PENTING! */
        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                padding: 0 1rem;
            }

            /* Hamburger menu TAMPIL */
            .navbar-toggle {
                display: block;
            }

            /* Menu navbar di HP */
            .navbar-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: rgba(26, 26, 46, 0.95);
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 1rem;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                z-index: 1001;
                border-bottom-left-radius: 15px;
                border-bottom-right-radius: 15px;
            }

            /* Menu aktif saat diklik */
            .navbar-menu.active {
                display: flex;
            }

            .nav-link {
                justify-content: center;
                padding: 1rem;
                border-radius: 8px;
                margin-bottom: 0.5rem;
                font-size: 1rem;
            }

            .navbar-brand {
                font-size: 1.2rem;
                padding: 0.5rem;
            }

            .container {
                padding: 1rem;
            }

            .card {
                padding: 1.5rem;
            }

            .section-title {
                font-size: 1.7rem;
            }

            .btn {
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
                width: 100%;
                justify-content: center;
                margin-bottom: 0.5rem;
            }

            /* Timeline responsive */
            .timeline {
                padding-left: 2rem;
            }
            
            .timeline::before {
                left: 0.5rem;
            }
            
            .timeline-item::before {
                left: -1.5rem;
            }
            
            .timeline-number {
                left: -1.85rem;
                width: 24px;
                height: 24px;
                font-size: 0.75rem;
            }

            /* Benefit grid responsive */
            .benefit-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            /* Email responsive fix */
            .contact-grid {
                grid-template-columns: 1fr;
            }
            
            .contact-text {
                font-size: 0.9rem;
                padding: 0;
            }
        }

        @media (max-width: 480px) {
            .section-title {
                font-size: 1.5rem;
            }
            
            .requirement-list li {
                padding-left: 2rem;
                font-size: 0.95rem;
            }

            /* Email fix untuk mobile */
            .contact-text {
                font-size: 0.85rem;
                word-break: break-all;
            }
            
            .navbar-brand span {
                font-size: 1rem;
            }
            
            .nav-link span {
                font-size: 0.9rem;
            }
        }

        /* Animasi untuk partikel */
        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(20px, 30px) rotate(90deg);
            }
            50% {
                transform: translate(0, 60px) rotate(180deg);
            }
            75% {
                transform: translate(-20px, 30px) rotate(270deg);
            }
            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }
    </style>
</head>
<body>
    <!-- Background Particles -->
    <div class="bg-particles" id="bgParticles"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="navbar-brand">
                <i class="fas fa-city"></i>
                <span>Diskominfosantik</span>
            </a>
            
            <!-- Hamburger Menu Button -->
            <button class="navbar-toggle" id="navbarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <ul class="navbar-menu" id="navbarMenu">
                <li>
                    <a href="/" class="nav-link">
                        <i class="fas fa-th-large"></i>
                        <span>Divisi Magang</span>
                    </a>
                </li>
                <li>
                    <a href="/informasi" class="nav-link active">
                        <i class="fas fa-info-circle"></i>
                        <span>Informasi</span>
                    </a>
                </li>
                <li>
                    <a href="/login" class="nav-link">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login Admin</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Hero Section -->
        <div class="card" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white;">
            <div style="text-align: center; padding: 2rem 1rem;">
                <h1 style="font-size: 2rem; margin-bottom: 1rem; font-weight: 700;">
                    <i class="fas fa-graduation-cap"></i> Program Magang 2026
                </h1>
                <p style="font-size: 1.1rem; opacity: 0.95; max-width: 800px; margin: 0 auto 2rem;">
                    Kesempatan belajar dan berkontribusi di Dinas Komunikasi, Informatika, dan Statistik Kota Bekasi
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="#pendaftaran" class="btn" style="background: white; color: var(--primary);">
                        <i class="fas fa-play-circle"></i> Mulai Daftar
                    </a>
                    <a href="#benefit" class="btn btn-outline" style="color: white; border-color: white;">
                        <i class="fas fa-star"></i> Lihat Benefit
                    </a>
                </div>
            </div>
        </div>

        <!-- Benefit -->
        <div class="card" id="benefit">
            <h2 class="section-title">
                <i class="fas fa-gift"></i>
                Benefit Magang
            </h2>
            <div class="benefit-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="benefit-title">Sertifikat Resmi</h3>
                    <p class="benefit-desc">Dapatkan sertifikat magang resmi yang diakui untuk melengkapi portofolio profesionalmu.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h3 class="benefit-title">Networking</h3>
                    <p class="benefit-desc">Bangun koneksi dengan profesional di bidang teknologi informasi dan pemerintahan.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3 class="benefit-title">Mentor Berpengalaman</h3>
                    <p class="benefit-desc">Dibimbing langsung oleh praktisi IT yang berpengalaman di bidangnya.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="benefit-title">Pengalaman Nyata</h3>
                    <p class="benefit-desc">Kerjakan proyek nyata yang berdampak langsung pada masyarakat Kota Samarinda.</p>
                </div>
            </div>
        </div>

        <!-- Syarat & Ketentuan -->
        <div class="card">
            <h2 class="section-title">
                <i class="fas fa-clipboard-check"></i>
                Syarat & Ketentuan
            </h2>
            <ul class="requirement-list">
                <li><i class="fas fa-user-graduate"></i> Mahasiswa aktif D3/D4/S1 dari universitas terakreditasi</li>
                <li><i class="fas fa-envelope"></i> Surat pengantar resmi dari fakultas/prodi</li>
                <li><i class="fas fa-laptop-code"></i> Menguasai skill dasar sesuai divisi yang dipilih</li>
                <li><i class="fas fa-calendar-alt"></i> Masa magang minimal 1 bulan (Senin - Jum'at; 08.00 - 15.30)</li>
                <li><i class="fas fa-handshake"></i> Komitmen penuh selama periode magang</li>
                <li><i class="fas fa-clipboard-list"></i> Mematuhi peraturan dan tata tertib instansi</li>
                <li><i class="fas fa-laptop"></i> Memiliki laptop/perangkat kerja sendiri</li>
                <li><i class="fas fa-file-pdf"></i> CV dan portofolio (jika ada)</li>
            </ul>
        </div>

            <!-- Alur Pendaftaran -->
            <div class="card" id="pendaftaran">
                <h2 class="section-title">
                    <i class="fas fa-route"></i>
                    Alur Pendaftaran
                </h2>
                <div class="timeline">

        <div class="timeline-item">
            <div class="timeline-number">1</div>
            <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Cek Ketersediaan Kuota</h3>
            <p style="color: var(--gray);">
                Pastikan sisa kuota magang pada website masih tersedia. Jika kuota masih ada, mahasiswa datang langsung ke Diskominfosantik untuk melakukan booking slot magang.
            </p>
        </div>

        <div class="timeline-item">
            <div class="timeline-number">2</div>
            <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Penyerahan Surat Rekomendasi Kampus</h3>
            <p style="color: var(--gray);">
                Setelah mendapatkan jadwal, pada hari berikutnya mahasiswa membawa surat rekomendasi magang dari kampus ke Diskominfosantik.
            </p>
        </div>

        <div class="timeline-item">
            <div class="timeline-number">3</div>
            <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Mendapatkan Surat Terima dari Diskominfosantik</h3>
            <p style="color: var(--gray);">
                Diskominfosantik akan memberikan surat terima magang yang selanjutnya digunakan untuk pengurusan administrasi ke Kesbangpol.
            </p>
        </div>

        <div class="timeline-item">
            <div class="timeline-number">4</div>
            <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Pengajuan ke Kesbangpol</h3>
            <p style="color: var(--gray);">
                Mahasiswa datang ke Kesbangpol dengan membawa surat terima dari Diskominfosantik, fotokopi KTP, fotokopi KTM, serta surat pernyataan yang telah ditandatangani dan bermaterai.
            </p>
        </div>

        <div class="timeline-item">
            <div class="timeline-number">5</div>
            <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Menunggu Surat Keterangan dari Kesbangpol</h3>
            <p style="color: var(--gray);">
                Mahasiswa menunggu proses penerbitan surat keterangan terima magang dari Kesbangpol.
            </p>
        </div>

        <div class="timeline-item">
            <div class="timeline-number">6</div>
            <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Penyerahan Surat & CV ke Diskominfosantik</h3>
            <p style="color: var(--gray);">
                Setelah surat dari Kesbangpol diterbitkan, mahasiswa kembali ke Diskominfosantik dengan membawa surat tersebut beserta CV.
            </p>
        </div>

        <div class="timeline-item">
            <div class="timeline-number">7</div>
            <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Mulai Magang</h3>
            <p style="color: var(--gray);">
                Mahasiswa mulai melaksanakan magang sesuai tanggal yang tercantum pada surat keterangan dari Kesbangpol.
            </p>
        </div>

    </div>

        <!-- FAQ -->
        <div class="card">
            <h2 class="section-title">
                <i class="fas fa-question-circle"></i>
                Frequently Asked Questions (FAQ)
            </h2>
            
            <div class="faq-item" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <i class="fas fa-chevron-right"></i>
                    Berapa lama durasi magang?
                </div>
                <div class="faq-answer">
                    Durasi magang fleksibel antara 1-6 bulan sesuai kebutuhan kampus dan kesepakatan dengan divisi. Minimal 1 bulan (7,5 jam kerja efektif).
                </div>
            </div>

            <div class="faq-item" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <i class="fas fa-chevron-right"></i>
                    Apakah ada biaya pendaftaran?
                </div>
                <div class="faq-answer">
                    Tidak ada biaya pendaftaran sama sekali. Program magang ini gratis untuk seluruh peserta sebagai bagian dari komitmen Diskominfosantik dalam pengembangan SDM.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <i class="fas fa-chevron-right"></i>
                    Apakah mendapat sertifikat?
                </div>
                <div class="faq-answer">
                    Ya, peserta yang menyelesaikan program magang dengan baik akan mendapat sertifikat resmi dari Diskominfosantik Kota Samarinda yang dapat digunakan untuk melengkapi persyaratan akademik dan profesional.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <i class="fas fa-chevron-right"></i>
                    Bagaimana sistem absensi?
                </div>
                <div class="faq-answer">
                    Absensi dilakukan secara ofline. Peserta wajib hadir sesuai jadwal yang ditentukan (Senin-Jumat, 08:00-15:30 WITA) dengan toleransi keterlambatan maksimal 15 menit.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <i class="fas fa-chevron-right"></i>
                    Apakah bisa pindah divisi?
                </div>
                <div class="faq-answer">
                    Perpindahan divisi hanya diperbolehkan dalam kondisi khusus (seperti ketidakcocokan skill atau kebutuhan proyek) dan harus melalui persetujuan admin serta kepala divisi terkait dengan alasan yang jelas.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <i class="fas fa-chevron-right"></i>
                    Kapan pendaftaran dibuka?
                </div>
                <div class="faq-answer">
                    Pendaftaran dibuka sepanjang tahun dengan sistem rolling admission, namun kuota terbatas per divisi. Kami sarankan untuk mendaftar segera ketika kuota masih tersedia untuk divisi yang Anda minati.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <i class="fas fa-chevron-right"></i>
                    Apakah mendapatkan Uang Saku?
                </div>
                <div class="faq-answer">
                    Program magang ini tidak disertai pemberian gaji, uang saku, uang makan, honorarium, maupun bentuk fasilitas atau kompensasi finansial lainnya.         Pendaftaran dibuka sepanjang tahun dengan sistem rolling admission, namun kuota terbatas per divisi. Kami sarankan untuk mendaftar segera ketika kuota masih tersedia untuk divisi yang Anda minati.
                </div>
            </div>

        </div>

        <!-- Kontak - FIXED -->
        <div class="card" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));">
            <h2 class="section-title">
                <i class="fas fa-headset"></i>
                Butuh Bantuan?
            </h2>
            <div class="contact-grid">
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-content">
                        <h4 class="contact-title">Email</h4>
                        <p class="contact-text">magang@diskominfosantik.bekasikota.go.id</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-content">
                        <h4 class="contact-title">Telepon</h4>
                        <p class="contact-text">(0541) 123-456</p>
                        <p class="contact-text" style="font-size: 0.9rem; color: var(--gray); margin-top: 0.25rem;">
                            Senin-Jumat, 08:00-15:30 WITA
                        </p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-content">
                        <h4 class="contact-title">Alamat</h4>
                        <p class="contact-text">Diskominfosantik Bekasi, Komplek Pemkab Bekasi, Cikarang Pusat – 17530</p>
                        <p class="contact-text" style="font-size: 0.9rem; color: var(--gray); margin-top: 0.25rem;">
                            Kalimantan Timur, 75123
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA - Hanya Kembali -->
        <div style="text-align: center; margin-top: 3rem;">
            <a href="/" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar Divisi
            </a>
        </div>
    </div>

    <script>
        // Background Particles
        function createParticles() {
            const container = document.getElementById('bgParticles');
            const particleCount = 15;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Random size and position
                const size = Math.random() * 150 + 50;
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                const duration = Math.random() * 30 + 20;
                const delay = Math.random() * 10;
                
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${posX}%`;
                particle.style.top = `${posY}%`;
                particle.style.animation = `float ${duration}s linear ${delay}s infinite`;
                
                container.appendChild(particle);
            }
        }

        // FAQ Toggle
        function toggleFAQ(item) {
            const isActive = item.classList.contains('active');
            
            // Close all FAQs
            document.querySelectorAll('.faq-item').forEach(faq => {
                faq.classList.remove('active');
            });
            
            // Open clicked FAQ if it wasn't already active
            if (!isActive) {
                item.classList.add('active');
            }
        }

        // Mobile Menu Toggle
        function setupMobileMenu() {
            const navbarToggle = document.getElementById('navbarToggle');
            const navbarMenu = document.getElementById('navbarMenu');
            
            if (navbarToggle && navbarMenu) {
                navbarToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    navbarMenu.classList.toggle('active');
                    
                    // Ubah ikon
                    const icon = this.querySelector('i');
                    if (navbarMenu.classList.contains('active')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
                
                // Tutup menu saat klik di luar
                document.addEventListener('click', function(event) {
                    if (!navbarToggle.contains(event.target) && !navbarMenu.contains(event.target)) {
                        navbarMenu.classList.remove('active');
                        const icon = navbarToggle.querySelector('i');
                        if (icon) {
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        }
                    }
                });
                
                // Tutup menu saat link diklik (untuk mobile)
                navbarMenu.querySelectorAll('.nav-link').forEach(link => {
                    link.addEventListener('click', function() {
                        navbarMenu.classList.remove('active');
                        const icon = navbarToggle.querySelector('i');
                        if (icon) {
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        }
                    });
                });
            }
        }

        // Smooth scroll for anchor links
        function setupSmoothScroll() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    if (targetId !== '#') {
                        e.preventDefault();
                        const targetElement = document.querySelector(targetId);
                        if (targetElement) {
                            targetElement.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            setupMobileMenu();
            setupSmoothScroll();
        });
    </script>
</body>
</html>