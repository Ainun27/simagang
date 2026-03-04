@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dashboard">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="close-alert">&times;</button>
        </div>
    @endif

    <!-- STATISTIK GALAKSI -->
    <div class="statistics-card">
        <div class="statistics-header">
            <h3><i class="fas fa-chart-pie"></i> Statistik Mahasiswa Magang</h3>
            <div class="statistics-subtitle">Data Terkini Sistem Magang</div>
        </div>
        
        <div class="statistics-grid">
            <div class="stat-card stat-primary">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-content">
                    <div class="stat-value">{{ $totalMahasiswa ?? $mahasiswa->total() }}</div>
                    <div class="stat-label">Total Mahasiswa</div>
                </div>
                
            </div>
            
            <div class="stat-card stat-success">
                <div class="stat-icon"><i class="fas fa-user-check"></i></div>
                <div class="stat-content">
                    <div class="stat-value">{{ $mahasiswaAktif ?? 0 }}</div>
                    <div class="stat-label">Mahasiswa Aktif</div>
                </div>
                
            </div>
            
            <div class="stat-card stat-danger">
                <div class="stat-icon"><i class="fas fa-user-times"></i></div>
                <div class="stat-content">
                    <div class="stat-value">{{ $mahasiswaNonaktif ?? 0 }}</div>
                    <div class="stat-label">Mahasiswa Nonaktif</div>
                </div>
                
            </div>
            
            <div class="stat-card stat-warning">
                <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                <div class="stat-content">
                    <div class="stat-value">{{ $mahasiswaNonaktif ?? 0 }}</div>
                    <div class="stat-label">Selesai Magang</div>
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
                    <div class="title-icon"><i class="fas fa-user-graduate"></i></div>
                    <div class="title-text">
                        <h1 class="main-title">Data Mahasiswa Magang</h1>
                        <p class="subtitle">Kelola informasi mahasiswa magang dengan mudah</p>
                    </div>
                </div>
            </div>
            
            <a href="{{ route('admin.mahasiswa.create') }}" class="btn-add">
                <i class="fas fa-plus"></i><span>Tambah Data</span>
            </a>
        </div>

        <!-- FILTER & SEARCH -->
        <div class="toolbar-section">
            <div class="toolbar-content">
                <div class="filter-area">
                    <span class="filter-label"><i class="fas fa-filter"></i> Filter Status:</span>
                    <div class="filter-buttons">
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'semua']) }}" 
                           class="filter-btn {{ (!request('status') || request('status') == 'semua') ? 'active' : '' }}">Semua</a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'aktif']) }}" 
                           class="filter-btn {{ request('status') == 'aktif' ? 'active' : '' }}">Aktif</a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'nonaktif']) }}" 
                           class="filter-btn {{ request('status') == 'nonaktif' ? 'active' : '' }}">Nonaktif</a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'selesai']) }}" 
                           class="filter-btn {{ request('status') == 'selesai' ? 'active' : '' }}">Selesai</a>
                    </div>
                </div>
                
                <div class="search-area">
                    <form method="GET" action="{{ route('admin.mahasiswa.index') }}" class="search-form">
                        <div class="search-wrapper">
                            <input type="text" name="search" class="search-input" 
                                   placeholder="Cari nama, NIM, atau universitas..."
                                   value="{{ request('search') }}">
                            <button type="submit" class="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                            <a href="{{ route('admin.mahasiswa.index') }}" class="search-clear" title="Clear">
                                <i class="fas fa-times"></i>
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- TABLE -->
        @if($mahasiswa->count() > 0)
        <div class="table-container">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="min-width:60px;">No</th>
                            <th style="min-width:180px;">
                                <div class="header-with-lock">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Mahasiswa</span>
                                    <i class="fas fa-lock header-lock-icon"></i>
                                </div>
                            </th>
                            <th style="min-width:140px;">
                                <div class="header-with-lock">
                                    <i class="fas fa-lock"></i>
                                    <span>NIM</span>
                                </div>
                            </th>
                            <th style="min-width:160px;">Universitas</th>
                            <th style="min-width:100px;">Divisi</th>
                            <th style="min-width:120px;">Periode</th>
                            <th class="text-center" style="min-width:90px;">Status</th>
                            <th class="text-center" style="min-width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa as $index => $mhs)
                        @php
                            $tglSelesai = $mhs->tanggal_selesai;
                            $isExpired = false;
                            if ($tglSelesai) {
                                $today = \Carbon\Carbon::today()->format('Y-m-d');
                                $tglSelesaiDate = \Carbon\Carbon::parse($tglSelesai)->format('Y-m-d');
                                $isExpired = $tglSelesaiDate < $today;
                            }
                            $rowIsInactive = !$mhs->is_active || $isExpired;
                        @endphp
                        <tr class="{{ $rowIsInactive ? 'row-inactive' : '' }}">
                            <td class="text-center">
                                <span class="row-number">{{ $mahasiswa->firstItem() + $index }}</span>
                            </td>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar {{ $rowIsInactive ? 'inactive' : '' }}">
                                        {{ strtoupper(substr($mhs->nama, 0, 1)) }}
                                    </div>
                                    <div class="student-details">
                                        <div class="student-name-container">
                                            <strong class="student-name">{{ $mhs->nama }}</strong>
                                            <span class="student-lock-badge" title="Data terlindungi">
                                                <i class="fas fa-user-shield student-lock-icon"></i>
                                            </span>
                                        </div>
                                        <small class="student-email">
                                            <i class="fas fa-envelope"></i>
                                            {{ Str::limit($mhs->email, 20) }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="nim-container">
                                    <div class="nim-wrapper">
                                        <code class="nim-text">{{ $mhs->nim ?? '-' }}</code>
                                        <div class="lock-animation" title="Data terenkripsi">
                                            <i class="fas fa-lock lock-icon"></i>
                                        </div>
                                    </div>
                                    @if($mhs->nim)
                                    <small class="encryption-tag">
                                        <i class="fas fa-shield-alt"></i>AES-256
                                    </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="university-text">
                                    <i class="fas fa-university"></i>
                                    {{ Str::limit($mhs->universitas, 20) }}
                                </span>
                            </td>
                            <td><span class="divisi-badge">{{ $mhs->divisi->nama_divisi }}</span></td>
                            <td>
                                @if($tglSelesai)
                                <div class="periode-info">
                                    <div class="periode-date {{ $isExpired ? 'expired' : 'active' }}">
                                        <i class="fas fa-calendar"></i>
                                        <span>{{ \Carbon\Carbon::parse($tglSelesai)->format('d M Y') }}</span>
                                    </div>
                                    @if($isExpired)
                                    <small class="status-label expired">
                                        <i class="fas fa-clock"></i>Selesai
                                    </small>
                                    @endif
                                </div>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(!$mhs->is_active)
                                <span class="status-badge inactive">
                                    <i class="fas fa-times-circle"></i><span>Nonaktif</span>
                                </span>
                                @elseif($isExpired)
                                <span class="status-badge finished">
                                    <i class="fas fa-history"></i><span>Selesai</span>
                                </span>
                                @else
                                <span class="status-badge active">
                                    <i class="fas fa-check-circle"></i><span>Aktif</span>
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.mahasiswa.show', $mhs->id) }}" 
                                       class="action-btn info-btn" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}" 
                                       class="action-btn warning-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" 
                                          method="POST" class="action-form" 
                                          onsubmit="return confirm('Hapus {{ $mhs->nama }}?')">
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

        <!-- PAGINATION -->
        <div class="pagination-wrapper">{{ $mahasiswa->links() }}</div>
        @else
        <!-- EMPTY STATE -->
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-user-graduate"></i></div>
            <h3>Belum Ada Data Mahasiswa</h3>
            <p>Mulai dengan menambahkan data mahasiswa pertama</p>
            <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>Tambah Data Pertama
            </a>
        </div>
        @endif
    </div>

    <!-- INFO BOX -->
    <div class="info-box">
        <div class="info-content">
            <i class="fas fa-info-circle"></i>
            <div class="info-text">
                <h6>Informasi Sistem Mahasiswa Magang</h6>
                <p>Status mahasiswa dapat diubah melalui menu edit. Data NIM terlindungi dengan enkripsi AES-256 untuk keamanan.</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* VARIABLES */
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

    /* RESET & BASE */
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

    /* STATISTIK CARD */
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
    
    .stat-progress {
        position: absolute;
        bottom: 0;
        left: 1rem;
        right: 1rem;
        height: 4px;
        background: rgba(255,255,255,0.1);
        border-radius: 2px;
        overflow: hidden;
    }
    
    .progress-bar {
        height: 100%;
        background: white;
        border-radius: 2px;
        transition: width 1s ease;
    }

    /* DASHBOARD CARD */
    .dashboard-card {
        border: none;
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        background: white;
        margin-bottom: 1.5rem;
    }

    /* HEADER */
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

    /* TOOLBAR */
    .toolbar-section {
        background: white;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
    }
    
    .toolbar-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .filter-area {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    
    .filter-label {
        font-weight: 600;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 0.25rem;
        white-space: nowrap;
        font-size: 0.875rem;
    }
    
    .filter-buttons {
        display: flex;
        gap: 0.25rem;
        flex-wrap: wrap;
    }
    
    .filter-btn {
        padding: 0.5rem 1rem;
        background: var(--light);
        border: 1px solid var(--border);
        border-radius: 50px;
        color: var(--gray);
        text-decoration: none;
        font-size: 0.75rem;
        font-weight: 500;
        transition: var(--transition);
        display: inline-block;
    }
    
    .filter-btn:hover {
        background: var(--primary-light);
        color: var(--primary);
        border-color: var(--primary);
    }
    
    .filter-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* SEARCH - FIXED */
    .search-area {
        width: 300px;
    }
    
    .search-wrapper {
        position: relative;
        display: flex;
    }
    
    .search-input {
        flex: 1;
        padding: 0.625rem 1rem 0.625rem 2.75rem;
        border: 1px solid var(--border);
        border-radius: 50px;
        font-size: 0.875rem;
        transition: var(--transition);
        background: white;
        width: 100%;
    }
    
    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
    }
    
    .search-form {
        width: 100%;
    }
    
    .search-btn {
        position: absolute;
        left: 0.875rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--gray);
        font-size: 0.875rem;
        padding: 0;
        cursor: pointer;
        z-index: 2;
    }
    
    .search-clear {
        position: absolute;
        right: 0.875rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
        text-decoration: none;
        font-size: 0.875rem;
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        z-index: 2;
    }

    /* TABLE */
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
    
    .row-inactive {
        opacity: 0.7;
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

    /* STUDENT INFO */
    .student-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .student-avatar {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--warning), #d97706);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.875rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    
    .student-avatar.inactive {
        background: linear-gradient(135deg, var(--gray), #4b5563);
    }
    
    .student-name {
        color: var(--dark);
        font-size: 0.875rem;
        font-weight: 600;
        line-height: 1.4;
        display: block;
    }
    
    .student-lock-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 16px;
        height: 16px;
        background: var(--warning-light);
        border-radius: 50%;
        margin-left: 0.375rem;
    }
    
    .student-lock-icon {
        color: var(--warning);
        font-size: 0.625rem;
    }
    
    .student-email {
        color: var(--gray);
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* NIM CONTAINER */
    .nim-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    
    .nim-text {
        background: var(--warning-light);
        padding: 0.5rem 2rem 0.5rem 0.75rem;
        border-radius: 6px;
        font-family: monospace;
        font-weight: 600;
        color: #92400e;
        font-size: 0.75rem;
        border: 1px solid rgba(245,158,11,0.2);
        display: block;
        width: 100%;
    }
    
    .lock-animation {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #92400e;
        font-size: 0.75rem;
    }
    
    .encryption-tag {
        background: var(--warning-light);
        color: #92400e;
        padding: 0.125rem 0.5rem;
        border-radius: 50px;
        font-size: 0.625rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        margin-top: 0.25rem;
        font-weight: 600;
    }

    /* UNIVERSITY */
    .university-text {
        color: var(--dark);
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    /* DIVISI */
    .divisi-badge {
        display: inline-block;
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid rgba(79,70,229,0.2);
    }

    /* PERIODE */
    .periode-date {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    .periode-date.active { color: var(--success); }
    .periode-date.expired { color: var(--danger); }
    
    .status-label {
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-weight: 500;
    }
    
    .status-label.expired { color: var(--danger); }

    /* STATUS BADGES */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-badge.active {
        background: var(--success-light);
        color: var(--success);
    }
    
    .status-badge.inactive {
        background: var(--danger-light);
        color: var(--danger);
    }
    
    .status-badge.finished {
        background: var(--warning-light);
        color: #92400e;
    }

    /* ACTION BUTTONS */
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

    /* PAGINATION */
    .pagination-wrapper {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: center;
        background: var(--light);
    }

    /* EMPTY STATE */
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

    /* INFO BOX */
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

    /* ALERT */
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
    
    .close-alert {
        background: none;
        border: none;
        color: white;
        font-size: 1.25rem;
        cursor: pointer;
        padding: 0;
        line-height: 1;
    }

    /* RESPONSIVE */
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
        
        .toolbar-content {
            flex-direction: column;
            align-items: stretch;
        }
        
        .filter-area {
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }
        
        .filter-buttons {
            width: 100%;
            justify-content: flex-start;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }
        
        .search-area {
            width: 100%;
        }
        
        .data-table thead th,
        .data-table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .student-avatar {
            width: 32px;
            height: 32px;
            font-size: 0.75rem;
        }
        
        .student-name {
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
        
        .search-wrapper {
            flex-direction: column;
        }
        
        .search-btn {
            position: static;
            transform: none;
            margin-top: 0.5rem;
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
    
    // NIM lock animation
    document.querySelectorAll('.nim-wrapper').forEach(wrapper => {
        wrapper.addEventListener('click', function() {
            const lock = this.querySelector('.lock-icon');
            if (lock) {
                lock.style.transition = 'transform 0.5s';
                lock.style.transform = 'rotate(360deg)';
                setTimeout(() => {
                    lock.style.transform = 'rotate(0deg)';
                }, 500);
            }
        });
    });
    
    // Search clear functionality
    document.querySelectorAll('.search-clear').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = this.href;
        });
    });
</script>
@endsection