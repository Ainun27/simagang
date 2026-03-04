@extends('layouts.app')

@section('title', 'Daftar Divisi')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dashboard">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="close-alert">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dashboard">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
            <button type="button" class="close-alert">&times;</button>
        </div>
    @endif

    <!-- STATISTIK GALAKSI -->
    <div class="statistics-card">
        <div class="statistics-header">
            <h3><i class="fas fa-chart-pie"></i> Statistik Divisi Magang</h3>
            <div class="statistics-subtitle">Data Terkini Sistem Magang</div>
        </div>
        
        <div class="statistics-grid">
            <div class="stat-card stat-primary">
                <div class="stat-icon"><i class="fas fa-layer-group"></i></div>
                <div class="stat-content">
                    <div class="stat-value">{{ $divisi->count() }}</div>
                    <div class="stat-label">Total Divisi</div>
                </div>
            </div>
            
            <div class="stat-card stat-success">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-content">
                    <div class="stat-value">{{ $totalKuota }}</div>
                    <div class="stat-label">Total Kuota</div>
                </div>
            </div>
            
            <div class="stat-card stat-danger">
                <div class="stat-icon"><i class="fas fa-user-check"></i></div>
                <div class="stat-content">
                    <div class="stat-value">{{ $totalMahasiswaAktif }}</div>
                    <div class="stat-label">Mahasiswa Aktif</div>
                </div>
            </div>
            
            <div class="stat-card stat-warning">
                <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                <div class="stat-content">
                    <div class="stat-value">{{ $totalSisaKuota }}</div>
                    <div class="stat-label">Sisa Kuota</div>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CARD -->
    <div class="dashboard-card">
        <!-- HEADER -->
        <div class="dashboard-header">
            <div class="header-content">
                <div class="title-wrapper">
                    <div class="title-icon"><i class="fas fa-th-large"></i></div>
                    <div class="title-text">
                        <h1 class="main-title">Data Divisi Magang</h1>
                        <p class="subtitle">Kelola informasi divisi magang dengan mudah</p>
                    </div>
                </div>
            </div>
            
            <a href="{{ route('admin.divisi.create') }}" class="btn-add">
                <i class="fas fa-plus"></i><span>Tambah Divisi</span>
            </a>
        </div>

        <!-- TABLE -->
        @if($divisi->count() > 0)
        <div class="table-container">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="min-width:60px;">No</th>
                            <th style="min-width:200px;">
                                <div class="header-with-lock">
                                    <i class="fas fa-briefcase"></i>
                                    <span>Divisi</span>
                                </div>
                            </th>
                            <th style="min-width:250px;">Deskripsi</th>
                            <th class="text-center" style="min-width:100px;">
                                <div class="header-with-lock">
                                    <i class="fas fa-users"></i>
                                    <span>Kuota</span>
                                </div>
                            </th>
                            <th class="text-center" style="min-width:120px;">
                                <div class="header-with-lock">
                                    <i class="fas fa-user-check"></i>
                                    <span>Terisi</span>
                                </div>
                            </th>
                            <th class="text-center" style="min-width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($divisi as $index => $d)
                        @php
                            $kuotaTerisi = $d->mahasiswa_aktif_count;
                            $persentase = $d->kuota > 0 ? round(($kuotaTerisi / $d->kuota) * 100) : 0;
                            $isFull = $d->sisa_kuota == 0;
                            $rowIsFull = $isFull;
                        @endphp
                        <tr class="{{ $rowIsFull ? 'row-full' : '' }}">
                            <td class="text-center">
                                <span class="row-number">{{ $index + 1 }}</span>
                            </td>
                            <td>
                                <div class="divisi-info">
                                    <div class="divisi-avatar {{ $rowIsFull ? 'full' : 'available' }}">
                                        {{ strtoupper(substr($d->nama_divisi, 0, 1)) }}
                                    </div>
                                    <div class="divisi-details">
                                        <div class="divisi-name-container">
                                            <strong class="divisi-name">{{ $d->nama_divisi }}</strong>
                                            <span class="divisi-date-badge" title="Tanggal dibuat">
                                                <i class="fas fa-calendar"></i>
                                                {{ $d->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                        <small class="divisi-info-text">
                                            <i class="fas fa-clock"></i>
                                            Dibuat {{ $d->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="deskripsi-text">
                                    {{ Str::limit($d->deskripsi, 80) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="kuota-container">
                                    <div class="kuota-wrapper">
                                        <code class="kuota-text">{{ $d->kuota }}</code>
                                        <div class="kuota-tag" title="Total kuota">
                                            <i class="fas fa-user-friends"></i>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($d->kuota > 0)
                                <div class="terisi-info">
                                    <div class="terisi-value {{ $isFull ? 'full' : 'available' }}">
                                        {{ $kuotaTerisi }}
                                    </div>
                                    <div class="progress-container">
                                        <div class="progress-bar" style="--progress: {{ min($persentase, 100) }}%;"></div>
                                    </div>
                                    <small class="sisa-text {{ $isFull ? 'text-danger' : 'text-success' }}">
                                        Sisa: {{ $d->sisa_kuota }}
                                    </small>
                                </div>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.divisi.show', $d->id) }}" 
                                       class="action-btn info-btn" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.divisi.edit', $d->id) }}" 
                                       class="action-btn warning-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.divisi.destroy', $d->id) }}" 
                                          method="POST" class="action-form" 
                                          onsubmit="return confirm('Hapus {{ $d->nama_divisi }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="action-btn danger-btn" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <!-- EMPTY STATE -->
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-th-large"></i></div>
            <h3>Belum Ada Data Divisi</h3>
            <p>Mulai dengan menambahkan data divisi pertama</p>
            <a href="{{ route('admin.divisi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>Tambah Divisi Pertama
            </a>
        </div>
        @endif
    </div>

    <!-- INFO BOX -->
    <div class="info-box">
        <div class="info-content">
            <i class="fas fa-info-circle"></i>
            <div class="info-text">
                <h6>Informasi Sistem Divisi Magang</h6>
                <p>Pastikan deskripsi divisi jelas dan informatif. Divisi dengan mahasiswa tidak dapat dihapus. Kuota tidak dapat dikurangi jika sudah ada mahasiswa terdaftar.</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* VARIABLES - SAMA PERSIS DENGAN HALAMAN MAHASISWA */
    :root {
        --primary: #4f46e5;
        --primary-light: #eef2ff;
        --secondary: #7c3aed;
        --success: #10b981;
        --success-light: #d1fae5;
        --danger: #ef4444;
        --danger-light: #fee2e2;
        --warning: #f59e0b;
        --warning-light: #fef3c7;
        --info: #0ea5e9;
        --dark: #1f2937;
        --gray: #6b7280;
        --light: #f9fafb;
        --border: #e5e7eb;
        --radius: 12px;
        --shadow: 0 1px 3px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
        --transition: all 0.3s ease;
    }

    /* RESET & BASE - SAMA */
    body, html {
        overflow-x: hidden;
        overflow-y: auto;
        height: 100%;
    }
    
    .container {
        max-width: 100%;
        padding: 15px;
        overflow-x: hidden;
    }
    
    .btn {
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: var(--transition);
    }

    /* STATISTIK CARD - SAMA */
    .statistics-card {
        background: linear-gradient(135deg, var(--dark), #374151);
        color: white;
        padding: 1.5rem;
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-lg);
    }
    
    .statistics-header h3 {
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.25rem;
        font-weight: 600;
    }
    
    .statistics-subtitle {
        color: rgba(255,255,255,0.7);
        font-size: 0.875rem;
    }
    
    .statistics-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
    }
    
    .stat-card {
        background: rgba(255,255,255,0.05);
        border-radius: var(--radius);
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: var(--transition);
        border: 1px solid rgba(255,255,255,0.1);
        position: relative;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        border-color: rgba(255,255,255,0.2);
    }
    
    .stat-primary { border-top: 4px solid var(--primary); }
    .stat-success { border-top: 4px solid var(--success); }
    .stat-danger { border-top: 4px solid var(--danger); }
    .stat-warning { border-top: 4px solid var(--warning); }
    
    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    
    .stat-primary .stat-icon { background: rgba(79,70,229,0.2); color: var(--primary); }
    .stat-success .stat-icon { background: rgba(16,185,129,0.2); color: var(--success); }
    .stat-danger .stat-icon { background: rgba(239,68,68,0.2); color: var(--danger); }
    .stat-warning .stat-icon { background: rgba(245,158,11,0.2); color: var(--warning); }
    
    .stat-content { 
        flex: 1; 
        min-width: 0;
    }
    
    .stat-value {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 0.25rem;
        color: white;
    }
    
    .stat-label {
        display: block;
        font-size: 0.75rem;
        color: rgba(255,255,255,0.7);
        font-weight: 500;
    }

    /* DASHBOARD CARD - SAMA */
    .dashboard-card {
        border: none;
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        background: white;
        margin-bottom: 1.5rem;
    }

    /* HEADER - SAMA */
    .dashboard-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .title-wrapper {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .title-icon {
        width: 48px;
        height: 48px;
        background: rgba(255,255,255,0.2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .main-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0 0 0.25rem 0;
        color: white;
    }
    
    .subtitle {
        font-size: 0.875rem;
        opacity: 0.9;
        margin: 0;
        color: rgba(255,255,255,0.9);
    }
    
    .btn-add {
        background: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
        text-decoration: none;
        font-size: 0.875rem;
        white-space: nowrap;
    }
    
    .btn-add:hover {
        background: rgba(255,255,255,0.3);
        transform: translateY(-2px);
        color: white;
    }

    /* TABLE - SAMA DENGAN MODIFIKASI */
    .table-container {
        padding: 0;
        width: 100%;
    }
    
    .table-responsive {
        overflow-x: auto;
        padding: 0 1rem;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    
    .data-table thead th {
        background: var(--light);
        padding: 1rem;
        font-weight: 600;
        color: var(--dark);
        text-align: left;
        border-bottom: 2px solid var(--border);
        font-size: 0.75rem;
        text-transform: uppercase;
        white-space: nowrap;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    
    .header-with-lock {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        color: var(--warning);
        font-weight: 600;
    }
    
    .header-lock-icon {
        font-size: 0.75rem;
        color: var(--warning);
    }
    
    .data-table tbody td {
        padding: 1rem;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
        transition: var(--transition);
    }
    
    .data-table tbody tr:hover {
        background: var(--primary-light);
    }
    
    .row-full {
        background: rgba(239,68,68,0.05);
    }
    
    .row-number {
        display: inline-block;
        width: 24px;
        height: 24px;
        background: var(--primary);
        color: white;
        border-radius: 50%;
        font-size: 0.75rem;
        font-weight: 600;
        line-height: 24px;
        text-align: center;
    }

    /* DIVISI INFO */
    .divisi-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .divisi-avatar {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.875rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    
    .divisi-avatar.available {
        background: linear-gradient(135deg, var(--success), #059669);
    }
    
    .divisi-avatar.full {
        background: linear-gradient(135deg, var(--danger), #dc2626);
    }
    
    .divisi-name {
        color: var(--dark);
        font-size: 0.875rem;
        font-weight: 600;
        line-height: 1.4;
        display: block;
    }
    
    .divisi-date-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        background: var(--light);
        color: var(--gray);
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.625rem;
        margin-left: 0.5rem;
    }
    
    .divisi-info-text {
        color: var(--gray);
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* DESKRIPSI */
    .deskripsi-text {
    /* ... kode lainnya ... */
    display: -webkit-box;
    -webkit-line-clamp: 2; 
    line-clamp: 2; /* Tambahkan ini untuk kompatibilitas standar */
    -webkit-box-orient: vertical;
    overflow: hidden;
    color: #1f2937;
}

    /* KUOTA CONTAINER */
    .kuota-container {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    
    .kuota-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .kuota-text {
        background: var(--primary-light);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-family: monospace;
        font-weight: 600;
        color: var(--primary);
        font-size: 0.875rem;
        border: 1px solid rgba(79,70,229,0.2);
    }
    
    .kuota-tag {
        color: var(--primary);
        font-size: 0.875rem;
    }

    /* TERISI INFO */
    .terisi-info {
        text-align: center;
    }
    
    .terisi-value {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .terisi-value.available {
        color: var(--success);
    }
    
    .terisi-value.full {
        color: var(--danger);
    }
    
    .progress-container {
        height: 6px;
        background: var(--light);
        border-radius: 3px;
        overflow: hidden;
        margin-bottom: 0.25rem;
    }
    
    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--success), #059669);
        border-radius: 3px;
        transition: width 0.5s ease;
    }
    
    .sisa-text {
        font-size: 0.75rem;
        font-weight: 500;
        display: block;
    }
    
    .text-success {
        color: var(--success);
    }
    
    .text-danger {
        color: var(--danger);
    }
    
    .text-muted {
        color: var(--gray);
    }

    /* ACTION BUTTONS - SAMA */
    .action-group {
        display: flex;
        gap: 0.375rem;
        justify-content: center;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        color: white;
        font-size: 0.75rem;
        text-decoration: none;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
    }
    
    .info-btn { background: var(--info); }
    .warning-btn { background: var(--warning); }
    .danger-btn { background: var(--danger); }
    
    .action-form {
        display: inline;
        margin: 0;
    }

    /* EMPTY STATE - SAMA */
    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
    }
    
    .empty-icon {
        font-size: 3rem;
        color: var(--warning);
        margin-bottom: 1.5rem;
        opacity: 0.5;
    }
    
    .empty-state h3 {
        font-size: 1.25rem;
        color: var(--dark);
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    
    .empty-state p {
        color: var(--gray);
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
    }
    
    .empty-state .btn {
        background: var(--primary);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
    }
    
    .empty-state .btn:hover {
        background: var(--secondary);
        transform: translateY(-2px);
    }

    /* INFO BOX - SAMA */
    .info-box {
        background: var(--primary-light);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1rem 1.25rem;
        margin-top: 1.5rem;
    }
    
    .info-content {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .info-content i {
        font-size: 1.25rem;
        color: var(--primary);
        flex-shrink: 0;
    }
    
    .info-text h6 {
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 0.25rem 0;
        font-size: 0.875rem;
    }
    
    .info-text p {
        color: var(--dark);
        font-size: 0.75rem;
        margin: 0;
        line-height: 1.4;
    }

    /* ALERT - SAMA */
    .alert-dashboard {
        background: var(--success);
        color: white;
        border-radius: var(--radius);
        padding: 1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .alert-dashboard i {
        margin-right: 0.5rem;
    }
    
    .alert-danger {
        background: var(--danger);
    }
    
    .close-alert {
        background: none;
        border: none;
        color: white;
        font-size: 1.25rem;
        cursor: pointer;
        padding: 0;
        line-height: 1;
    }

    /* RESPONSIVE - SAMA */
    @media (max-width: 1200px) {
        .statistics-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .data-table thead th,
        .data-table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .divisi-avatar {
            width: 32px;
            height: 32px;
            font-size: 0.75rem;
        }
        
        .divisi-name {
            font-size: 0.75rem;
        }
        
        .action-btn {
            width: 28px;
            height: 28px;
            font-size: 0.75rem;
        }
        
        .statistics-card {
            padding: 1.25rem 1rem;
        }
        
        .kuota-text {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
        }
        
        .terisi-value {
            font-size: 1rem;
        }
    }
    
    @media (max-width: 576px) {
        .statistics-grid {
            grid-template-columns: 1fr;
        }
        
        .main-title {
            font-size: 1.25rem;
        }
        
        .title-icon {
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
        }
        
        .stat-value {
            font-size: 1.25rem;
        }
        
        .btn-add {
            width: 100%;
            justify-content: center;
        }
        
        .table-responsive {
            padding: 0 0.5rem;
        }
        
        .data-table {
            font-size: 0.75rem;
        }
        
        .empty-state {
            padding: 2rem 1rem;
        }
        
        .empty-icon {
            font-size: 2.5rem;
        }
        
        .deskripsi-text {
            -webkit-line-clamp: 3;
            font-size: 0.75rem;
        }
    }
</style>

<script>
    // Auto dismiss alerts
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert-dashboard');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.4s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 400);
        });
    }, 5000);
    
    // Close alert
    document.querySelectorAll('.close-alert').forEach(button => {
        button.addEventListener('click', function() {
            const alert = this.closest('.alert-dashboard');
            alert.style.transition = 'opacity 0.4s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 400);
        });
    });
    
    // Progress bar animation
    document.querySelectorAll('.progress-bar').forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0';
        setTimeout(() => {
            bar.style.width = width;
        }, 300);
    });
    
    // Divisi avatar hover effect
    document.querySelectorAll('.divisi-avatar').forEach(avatar => {
        avatar.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
        });
        
        avatar.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
</script>
@endsection