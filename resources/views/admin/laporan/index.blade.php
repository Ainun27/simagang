@extends('layouts.app')

@section('title', 'Laporan Mahasiswa')

@section('content')
<div class="container">
    <!-- STATISTIK CARD -->
    <div class="statistics-card">
        <div class="statistics-header">
            <h3><i class="fas fa-chart-bar"></i> Statistik Mahasiswa Magang</h3>
            <div class="statistics-subtitle">Data Terkini Sistem Magang</div>
        </div>
        
        <div class="statistics-grid">
            <div class="stat-card stat-primary">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-content">
                    <div class="stat-value">{{ $total }}</div>
                    <div class="stat-label">Total Mahasiswa</div>
                </div>
            </div>
            
            <div class="stat-card stat-secondary">
                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="stat-content">
                    <div class="stat-value">{{ $bulan_ini }}</div>
                    <div class="stat-label">Terdaftar Bulan Ini</div>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CARD -->
    <div class="dashboard-card">
        <!-- HEADER -->
        <div class="dashboard-header">
            <div class="title-wrapper">
                <div class="title-icon"><i class="fas fa-chart-bar"></i></div>
                <div class="title-text">
                    <h1 class="main-title">Data Mahasiswa Magang</h1>
                    <p class="subtitle">Laporan data mahasiswa magang</p>
                </div>
            </div>
            
            <a href="{{ route('admin.laporan.export.page') }}" class="btn-add">
                <i class="fas fa-file-export"></i><span>Download Laporan</span>
            </a>
        </div>

        <!-- FILTER SECTION -->
        <div class="toolbar-section">
            <div class="toolbar-content">
                <form method="GET" action="{{ route('admin.laporan.index') }}" class="filter-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="filter-label">
                                <i class="fas fa-filter"></i> Filter Divisi:
                            </label>
                            <select name="divisi_id" class="form-select">
                                <option value="">Semua Divisi</option>
                                @foreach($divisi as $d)
                                    <option value="{{ $d->id }}" {{ request('divisi_id') == $d->id ? 'selected' : '' }}>
                                        {{ $d->nama_divisi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- TOMBOL AKSI -->
                        <div class="form-actions">
                            <button type="submit" class="btn-filter">
                                <i class="fas fa-eye"></i> Tampilkan Data
                            </button>
                            <a href="{{ route('admin.laporan.index') }}" class="btn-reset">
                                <i class="fas fa-redo"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- TABLE -->
        @if($mahasiswas->count() > 0)
        <div class="table-container">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="text-center" width="60">No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Divisi</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswas as $index => $mhs)
                        <tr>
                            <td class="text-center">
                                <span class="row-number">{{ $mahasiswas->firstItem() + $index }}</span>
                            </td>
                            <td>
                                <span class="nim-badge">{{ $mhs->nim }}</span>
                            </td>
                            <td>
                                <div class="student-info">
                                    <div class="student-details">
                                        <strong class="student-name">{{ $mhs->nama }}</strong>
                                        <small class="student-university">{{ $mhs->universitas }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="divisi-badge">
                                    {{ $mhs->divisi->nama_divisi ?? 'Tanpa Divisi' }}
                                </span>
                            </td>
                            <td>
                                @if($mhs->is_active)
                                    <span class="status-badge active">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                @else
                                    <span class="status-badge inactive">
                                        <i class="fas fa-times-circle"></i> Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="date-badge">
                                    <i class="fas fa-calendar"></i>
                                    {{ $mhs->created_at->format('d M Y') }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PAGINATION -->
        <div class="pagination-wrapper">
            {{ $mahasiswas->appends(request()->query())->links() }}
        </div>
        @else
        <!-- EMPTY STATE -->
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-users"></i></div>
            <h3>Belum Ada Data Mahasiswa</h3>
            <p>Tidak ada data mahasiswa yang ditemukan</p>
        </div>
        @endif
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

    /* STATISTIK CARD */
    .statistics-card {
        background: linear-gradient(135deg, var(--dark), #374151);
        color: white;
        padding: 1.5rem;
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-lg);
    }
    
    .statistics-header {
        margin-bottom: 1.5rem;
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
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        border-color: rgba(255,255,255,0.2);
    }
    
    .stat-primary { border-top: 4px solid var(--primary); }
    .stat-secondary { border-top: 4px solid var(--info); }
    
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
    .stat-secondary .stat-icon { background: rgba(14,165,233,0.2); color: var(--info); }
    
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
        font-size: 0.875rem;
        color: rgba(255,255,255,0.7);
        font-weight: 500;
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
        background: white;
        color: var(--dark);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        border-bottom: 1px solid var(--border);
    }
    
    .title-wrapper {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .title-icon {
        width: 48px;
        height: 48px;
        background: var(--primary-light);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--primary);
    }
    
    .main-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0 0 0.25rem 0;
        color: var(--dark);
    }
    
    .subtitle {
        font-size: 0.875rem;
        color: var(--gray);
        margin: 0;
    }
    
    .btn-add {
        background: var(--primary);
        border: 1px solid var(--primary);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
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
        background: var(--secondary);
        transform: translateY(-2px);
        color: white;
    }

    /* TOOLBAR */
    .toolbar-section {
        background: var(--light);
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
    }
    
    .toolbar-content {
        width: 100%;
    }
    
    .filter-form {
        width: 100%;
    }
    
    .form-row {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .form-group {
        flex: 1;
        min-width: 250px;
    }
    
    .filter-label {
        display: block;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-select {
        width: 100%;
        padding: 0.625rem 1rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        background: white;
        font-size: 0.875rem;
        transition: var(--transition);
        color: var(--dark);
        height: 42px;
    }
    
    .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
    }
    
    /* TOMBOL AKSI - DITURUNKAN SEDIKIT */
    .form-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        margin-top: 1.8rem; /* DITURUNKAN SEDIKIT DARI 1.5rem */
        height: 42px;
    }
    
    .btn-filter {
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: var(--transition);
        font-size: 0.875rem;
        height: 42px;
        white-space: nowrap;
    }
    
    .btn-filter:hover {
        background: var(--secondary);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }
    
    .btn-reset {
        background: white;
        color: var(--gray);
        border: 1px solid var(--border);
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        transition: var(--transition);
        font-size: 0.875rem;
        height: 42px;
        white-space: nowrap;
    }
    
    .btn-reset:hover {
        background: var(--light);
        border-color: var(--gray);
        color: var(--dark);
        transform: translateY(-1px);
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
    
    .data-table tbody td {
        padding: 1rem;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
        transition: var(--transition);
    }
    
    .data-table tbody tr:hover {
        background: var(--primary-light);
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
    }
    
    .student-details {
        display: flex;
        flex-direction: column;
    }
    
    .student-name {
        color: var(--dark);
        font-size: 0.875rem;
        font-weight: 600;
        line-height: 1.4;
        display: block;
    }
    
    .student-university {
        color: var(--gray);
        font-size: 0.75rem;
        display: block;
        margin-top: 0.125rem;
    }

    /* BADGES */
    .nim-badge {
        background: var(--light);
        color: var(--dark);
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-family: 'Courier New', monospace;
        font-size: 0.875rem;
        font-weight: 500;
        border: 1px solid var(--border);
    }
    
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
    
    .date-badge {
        background: var(--light);
        color: var(--gray);
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        border: 1px solid var(--border);
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

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .form-row {
            flex-direction: column;
            align-items: stretch;
        }
        
        .form-group {
            width: 100%;
            min-width: auto;
        }
        
        .form-actions {
            width: 100%;
            justify-content: stretch;
            margin-top: 1rem;
        }
        
        .btn-filter, .btn-reset {
            flex: 1;
            justify-content: center;
            height: 42px;
        }
        
        .data-table thead th,
        .data-table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .statistics-card {
            padding: 1.25rem 1rem;
        }
    }
    
    @media (max-width: 576px) {
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
    }
</style>
@endsection