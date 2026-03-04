@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="welcome-content">
            <div class="welcome-icon">
                <i class="fas fa-hand-sparkles"></i>
            </div>
            <div>
                <h1 class="welcome-title">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="welcome-subtitle">
                    Sistem Manajemen Magang Diskominfosantik Kota Samarinda
                </p>
            </div>
        </div>
    </div>

    <!-- Alert Section -->
    @if($divisi_hampir_penuh->count() > 0 || $divisi_penuh->count() > 0)
    <div class="alert-section">
        @if($divisi_hampir_penuh->count() > 0)
        <div class="alert alert-warning">
            <div class="alert-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="alert-content">
                <h3 class="alert-title">⚠️ Peringatan Kuota!</h3>
                <p class="alert-text">
                    Ada {{ $divisi_hampir_penuh->count() }} divisi yang kuotanya hampir penuh:
                </p>
                <ul class="alert-list">
                    @foreach($divisi_hampir_penuh as $divisi)
                    <li>
                        <strong>{{ $divisi->nama_divisi }}</strong> - Sisa {{ $divisi->sisa }} kuota
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        @if($divisi_penuh->count() > 0)
        <div class="alert alert-danger">
            <div class="alert-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="alert-content">
                <h3 class="alert-title">🚫 Kuota Penuh!</h3>
                <p class="alert-text">
                    {{ $divisi_penuh->count() }} divisi sudah mencapai kuota maksimal:
                </p>
                <ul class="alert-list">
                    @foreach($divisi_penuh as $divisi)
                    <li>
                        <strong>{{ $divisi->nama_divisi }}</strong> ({{ $divisi->kuota }}/{{ $divisi->kuota }})
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
    @endif

    <!-- Statistics Grid -->
    <div class="statistics-grid">
        <!-- Total Divisi -->
        <div class="stat-card stat-primary">
            <div class="stat-bg-icon">
                <i class="fas fa-th-large"></i>
            </div>
            <div class="stat-content">
                <div class="stat-meta">
                    <span class="stat-label">Total Divisi</span>
                    <div class="stat-status">
                        <i class="fas fa-check-circle"></i>
                        <span>Aktif</span>
                    </div>
                </div>
                <h2 class="counter" data-target="{{ $total_divisi }}">0</h2>
            </div>
            <div class="stat-icon">
                <i class="fas fa-th-large"></i>
            </div>
        </div>

        <!-- Total Kuota -->
        <div class="stat-card stat-secondary">
            <div class="stat-bg-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <div class="stat-meta">
                    <span class="stat-label">Total Kuota</span>
                    <div class="stat-status">
                        <i class="fas fa-users"></i>
                        <span>Mahasiswa</span>
                    </div>
                </div>
                <h2 class="counter" data-target="{{ $total_kuota }}">0</h2>
            </div>
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>

        <!-- Total Mahasiswa -->
        <div class="stat-card stat-info">
            <div class="stat-bg-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="stat-content">
                <div class="stat-meta">
                    <span class="stat-label">Total Mahasiswa</span>
                    <div class="stat-status">
                        <i class="fas fa-check-circle"></i>
                        <span>Terdaftar</span>
                    </div>
                </div>
                <h2 class="counter" data-target="{{ \App\Models\Mahasiswa::where('is_active', 1)->count() }}">0</h2>
            </div>
            <div class="stat-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>

        <!-- Sisa Kuota -->
        <div class="stat-card stat-{{ $sisa_kuota > 5 ? 'success' : ($sisa_kuota > 0 ? 'warning' : 'danger') }}">
            <div class="stat-bg-icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <div class="stat-content">
                <div class="stat-meta">
                    <span class="stat-label">Sisa Kuota</span>
                    <div class="stat-status">
                        <i class="fas fa-{{ $sisa_kuota > 0 ? 'check-circle' : 'times-circle' }}"></i>
                        <span>{{ $sisa_kuota > 0 ? 'Tersedia' : 'Penuh' }}</span>
                    </div>
                </div>
                <h2 class="counter" data-target="{{ $sisa_kuota }}">0</h2>
            </div>
            <div class="stat-icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
        </div>
    </div>

    <!-- Divisi Monitoring -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fas fa-chart-bar"></i>
                Monitoring Kuota per Divisi
            </h2>
        </div>
        <div class="card-body">
            @foreach($divisi_list as $divisi)
            <div class="progress-item">
                <div class="progress-header">
                    <div class="progress-info">
                        <h4 class="progress-title">{{ $divisi->nama_divisi }}</h4>
                        <p class="progress-subtitle">
                            {{ $divisi->mahasiswa_count }}/{{ $divisi->kuota }} Mahasiswa
                        </p>
                    </div>
                    <div class="progress-badge">
                        @if($divisi->sisa == 0)
                        <span class="badge badge-danger">
                            <i class="fas fa-times-circle"></i> PENUH
                        </span>
                        @elseif($divisi->sisa <= 2)
                        <span class="badge badge-warning">
                            <i class="fas fa-exclamation-triangle"></i> Hampir Penuh ({{ $divisi->sisa }} sisa)
                        </span>
                        @else
                        <span class="badge badge-success">
                            <i class="fas fa-check-circle"></i> Tersedia ({{ $divisi->sisa }} sisa)
                        </span>
                        @endif
                    </div>
                </div>
                
                <!-- Progress Bar FIXED -->
                <div class="progress-bar-container">
                    @php
                        $progressClass = $divisi->sisa == 0 ? 'danger' : ($divisi->sisa <= 2 ? 'warning' : 'success');
                    @endphp
                    <div class="progress-bar-fill progress-{{ $progressClass }}" 
                         data-width="{{ $divisi->persentase }}">
                        @if($divisi->persentase > 15)
                        <span class="progress-value">{{ number_format($divisi->persentase, 0) }}%</span>
                        @endif
                    </div>
                    @if($divisi->persentase <= 15 && $divisi->persentase > 0)
                    <span class="progress-value-outside">{{ number_format($divisi->persentase, 0) }}%</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-bolt"></i>
                Quick Actions
            </h3>
        </div>
        <div class="card-body">
            <div class="quick-actions-grid">
                <a href="{{ route('admin.divisi.index') }}" class="quick-action-item">
                    <div class="action-icon action-primary">
                        <i class="fas fa-th-large"></i>
                    </div>
                    <h4 class="action-title">Kelola Divisi</h4>
                    <p class="action-description">CRUD divisi magang</p>
                </a>

                <a href="{{ route('admin.mahasiswa.index') }}" class="quick-action-item">
                    <div class="action-icon action-info">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h4 class="action-title">Data Mahasiswa</h4>
                    <p class="action-description">Kelola data mahasiswa</p>
                </a>

                <a href="{{ route('admin.laporan.index') }}" class="quick-action-item">
                    <div class="action-icon action-warning">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h4 class="action-title">Laporan</h4>
                    <p class="action-description">Filter & export data</p>
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* =============== WELCOME BANNER =============== */
    .welcome-banner {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 20px;
        color: white;
        margin-bottom: 2rem;
        border: none;
        overflow: hidden;
        position: relative;
    }

    .welcome-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 2rem;
        position: relative;
        z-index: 1;
    }

    .welcome-icon {
        font-size: 3.5rem;
        color: var(--success);
        flex-shrink: 0;
    }

    .welcome-title {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
        color: white;
        line-height: 1.2;
    }

    .welcome-subtitle {
        font-size: 1.125rem;
        opacity: 0.95;
        margin: 0;
        font-weight: 400;
    }

    /* =============== ALERTS =============== */
    .alert-section {
        margin-bottom: 2rem;
    }

    .alert-icon {
        font-size: 1.5rem;
        flex-shrink: 0;
        margin-top: 0.25rem;
    }

    .alert-content {
        flex: 1;
    }

    .alert-title {
        font-size: 1rem;
        font-weight: 600;
        margin: 0 0 0.5rem 0;
        color: inherit;
    }

    .alert-text {
        margin: 0 0 0.75rem 0;
        color: inherit;
        opacity: 0.9;
    }

    .alert-list {
        margin: 0;
        padding-left: 1.5rem;
        color: inherit;
    }

    .alert-list li {
        margin-bottom: 0.25rem;
        opacity: 0.9;
    }

    /* =============== STATISTICS =============== */
    .statistics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        border-radius: 20px;
        color: white;
        padding: 1.75rem;
        position: relative;
        overflow: hidden;
        border: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        height: 100%;
        min-height: 160px;
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25) !important;
    }

    .stat-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .stat-secondary {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .stat-info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .stat-success {
        background: linear-gradient(135deg, #28a745 0%, #4cc9f0 100%);
    }

    .stat-warning {
        background: linear-gradient(135deg, #ffc107 0%, #ff9e00 100%);
    }

    .stat-danger {
        background: linear-gradient(135deg, #dc3545 0%, #f72585 100%);
    }

    .stat-bg-icon {
        position: absolute;
        top: -30px;
        right: -30px;
        font-size: 8rem;
        opacity: 0.15;
        z-index: 0;
    }

    .stat-content {
        position: relative;
        z-index: 1;
    }

    .stat-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .stat-label {
        font-size: 0.95rem;
        opacity: 0.9;
        font-weight: 500;
    }

    .stat-status {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        opacity: 0.8;
    }

    .stat-card h2 {
        font-size: 3rem;
        font-weight: 700;
        margin: 0;
        line-height: 1;
    }

    .stat-icon {
        position: absolute;
        bottom: 1.5rem;
        right: 1.5rem;
        font-size: 3rem;
        opacity: 0.4;
        z-index: 1;
    }

    /* =============== CARD BODY =============== */
    .card-body {
        padding: 1.5rem;
    }

    /* =============== PROGRESS BARS =============== */
    .progress-item {
        margin-bottom: 2rem;
    }

    .progress-item:last-child {
        margin-bottom: 0;
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
        gap: 1rem;
    }

    .progress-info {
        flex: 1;
    }

    .progress-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 0.25rem 0;
    }

    .progress-subtitle {
        font-size: 0.9rem;
        color: var(--gray);
        margin: 0;
    }

    .progress-badge {
        flex-shrink: 0;
    }

    .progress-bar-container {
        background: #e9ecef;
        height: 25px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }

    .progress-bar-fill {
        height: 100%;
        width: 0%;
        transition: width 1s ease;
        display: flex;
        align-items: center;
        padding-left: 1rem;
        color: white;
        font-weight: 600;
        font-size: 0.85rem;
        position: relative;
        z-index: 1;
    }

    .progress-bar-fill.progress-success {
        background: linear-gradient(135deg, #28a745, #28a745dd);
    }

    .progress-bar-fill.progress-warning {
        background: linear-gradient(135deg, #ffc107, #ffc107dd);
    }

    .progress-bar-fill.progress-danger {
        background: linear-gradient(135deg, #dc3545, #dc3545dd);
    }

    .progress-value {
        white-space: nowrap;
    }

    .progress-value-outside {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--dark);
        z-index: 0;
    }

    /* =============== QUICK ACTIONS =============== */
    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .quick-action-item {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.08), rgba(118, 75, 162, 0.08));
        border: 2px solid transparent;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        display: block;
        cursor: pointer;
    }

    .quick-action-item:hover {
        transform: translateY(-5px);
        border-color: var(--primary);
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.12), rgba(118, 75, 162, 0.12));
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.15);
    }

    .action-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .action-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .action-info {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .action-warning {
        background: linear-gradient(135deg, #ffc107, #ff9e00);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .action-title {
        color: var(--dark);
        margin: 0 0 0.5rem 0;
        font-weight: 600;
        font-size: 1.125rem;
    }

    .action-description {
        color: var(--gray);
        font-size: 0.95rem;
        margin: 0;
    }

    /* =============== RESPONSIVE =============== */
    @media (max-width: 992px) {
        .welcome-content {
            padding: 1.75rem;
        }

        .welcome-title {
            font-size: 1.75rem;
        }

        .welcome-subtitle {
            font-size: 1rem;
        }

        .stat-card h2 {
            font-size: 2.5rem;
        }

        .statistics-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .welcome-content {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
            padding: 1.5rem;
        }

        .welcome-icon {
            font-size: 3rem;
        }

        .statistics-grid {
            grid-template-columns: 1fr;
        }

        .progress-header {
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-start;
        }

        .progress-badge {
            align-self: flex-start;
        }

        .quick-actions-grid {
            grid-template-columns: 1fr;
        }

        .alert {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .alert-icon {
            margin-top: 0;
        }

        .card-body {
            padding: 1rem;
        }
    }

    @media (max-width: 576px) {
        .welcome-title {
            font-size: 1.5rem;
        }

        .stat-card {
            padding: 1.5rem;
        }

        .stat-card h2 {
            font-size: 2.25rem;
        }

        .progress-bar-container {
            height: 20px;
        }

        .quick-action-item {
            padding: 1.5rem;
        }

        .action-icon {
            font-size: 2.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        
        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 1500;
            const increment = target / (duration / 16);
            let current = 0;
            
            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };
            
            updateCounter();
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });
        
        counters.forEach(counter => {
            observer.observe(counter);
        });
        
        // Progress Bar Animation
        const progressBars = document.querySelectorAll('.progress-bar-fill');
        setTimeout(() => {
            progressBars.forEach(bar => {
                const width = bar.getAttribute('data-width');
                bar.style.width = width + '%';
            });
        }, 300);
    });
</script>
@endpush
@endsection