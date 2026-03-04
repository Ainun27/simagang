@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-header custom-card-header">
            <div class="header-content">
                <h2 class="mahasiswa-title">
                    <i class="fas fa-user-graduate"></i>
                    {{ $mahasiswa->nama }}
                </h2>
                <div class="header-actions">
                    <a href="{{ route('admin.mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-edit">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>
                    <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <!-- Status Mahasiswa -->
            <div class="status-container {{ $mahasiswa->is_active ? 'status-active' : 'status-inactive' }}">
                <div class="status-info">
                    <div class="status-label">Status Mahasiswa</div>
                    <div class="status-value">
                        <i class="fas fa-{{ $mahasiswa->is_active ? 'check-circle' : 'times-circle' }}"></i>
                        {{ $mahasiswa->is_active ? 'AKTIF' : 'NONAKTIF' }}
                    </div>
                </div>
                
                @if($mahasiswa->tanggal_mulai && $mahasiswa->tanggal_selesai)
                <div class="periode-info">
                    <div class="periode-label">
                        <i class="fas fa-calendar-alt"></i> Periode Magang
                    </div>
                    <div class="periode-value">
                        {{ \Carbon\Carbon::parse($mahasiswa->tanggal_mulai)->format('d M Y') }} 
                        - 
                        {{ \Carbon\Carbon::parse($mahasiswa->tanggal_selesai)->format('d M Y') }}
                    </div>
                    @php
                        $today = \Carbon\Carbon::today();
                        $selesai = \Carbon\Carbon::parse($mahasiswa->tanggal_selesai);
                        $selisih_hari = $today->diffInDays($selesai, false);
                    @endphp
                    @if($selisih_hari >= 0)
                        <small class="hari-sisa">
                            {{ $selisih_hari }} hari lagi
                        </small>
                    @else
                        <small class="hari-lewat">
                            Selesai {{ abs($selisih_hari) }} hari lalu
                        </small>
                    @endif
                </div>
                @endif
            </div>

            <div class="uuid-container">
                <div class="uuid-label">
                    <i class="fas fa-fingerprint"></i> UUID (Unique Identifier)
                </div>
                <code class="uuid-code">
                    {{ $mahasiswa->id }}
                </code>
                <small class="uuid-description">
                    ID unik yang digenerate otomatis untuk keamanan
                </small>
            </div>

            <!-- Grid Container untuk Informasi Mahasiswa -->
            <div class="info-grid-container">
                <div class="info-card-detail">
                    <div class="info-header">
                        <i class="fas fa-id-card"></i>
                        <span>NIM</span>
                        <span class="encrypted-badge">
                            <i class="fas fa-lock"></i> Encrypted
                        </span>
                    </div>
                    <div class="info-value">
                        {{ $mahasiswa->nim }}
                    </div>
                </div>

                <div class="info-card-detail">
                    <div class="info-header">
                        <i class="fas fa-user"></i>
                        <span>Nama Lengkap</span>
                    </div>
                    <div class="info-value">
                        {{ $mahasiswa->nama }}
                    </div>
                </div>

                <div class="info-card-detail">
                    <div class="info-header">
                        <i class="fas fa-envelope"></i>
                        <span>Email</span>
                        <span class="encrypted-badge">
                            <i class="fas fa-lock"></i> Encrypted
                        </span>
                    </div>
                    <div class="info-value email-value">
                        {{ $mahasiswa->email }}
                    </div>
                </div>

                <div class="info-card-detail">
                    <div class="info-header">
                        <i class="fas fa-phone"></i>
                        <span>No HP</span>
                        <span class="encrypted-badge">
                            <i class="fas fa-lock"></i> Encrypted
                        </span>
                    </div>
                    <div class="info-value">
                        {{ $mahasiswa->no_hp }}
                    </div>
                </div>

                <div class="info-card-detail">
                    <div class="info-header">
                        <i class="fas fa-university"></i>
                        <span>Universitas</span>
                    </div>
                    <div class="info-value">
                        {{ $mahasiswa->universitas }}
                    </div>
                </div>

                <div class="divisi-card">
                    <div class="info-header">
                        <i class="fas fa-briefcase"></i>
                        <span>Divisi Magang</span>
                    </div>
                    <div class="info-value">
                        <span class="badge-divisi">
                            {{ $mahasiswa->divisi->nama_divisi }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="divisi-detail-container">
                <h3 class="divisi-title">
                    <i class="fas fa-th-large"></i>
                    Detail Divisi
                </h3>
                <div class="divisi-content">
                    <div class="divisi-header">
                        <div class="divisi-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="divisi-text">
                            <h4 class="divisi-nama">
                                {{ $mahasiswa->divisi->nama_divisi }}
                            </h4>
                            <p class="divisi-deskripsi">
                                {{ $mahasiswa->divisi->deskripsi }}
                            </p>
                        </div>
                    </div>
                    
                    @php
                        // HANYA hitung mahasiswa AKTIF untuk kuota
                        $terisi_aktif = $mahasiswa->divisi->mahasiswa()->where('is_active', true)->count();
                        $sisa_kuota = $mahasiswa->divisi->kuota - $terisi_aktif;
                        $total_mahasiswa = $mahasiswa->divisi->mahasiswa()->count();
                    @endphp
                    
                    <div class="stats-grid-container">
                        <div class="stat-card">
                            <div class="stat-label">Kuota Total</div>
                            <div class="stat-value">{{ $mahasiswa->divisi->kuota }}</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Terisi (Aktif)</div>
                            <div class="stat-value">{{ $terisi_aktif }}</div>
                            <small class="stat-note">Total: {{ $total_mahasiswa }}</small>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Sisa Kuota</div>
                            <div class="stat-value {{ $sisa_kuota > 0 ? 'sisa-positif' : 'sisa-negatif' }}">
                                {{ $sisa_kuota }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Keterangan perhitungan -->
                    <div class="info-note">
                        <small>
                            <i class="fas fa-info-circle"></i>
                            <strong>Info perhitungan kuota:</strong> Hanya mahasiswa dengan status <strong>Aktif</strong> yang dihitung dalam kuota terisi. 
                            Total semua mahasiswa yang pernah terdaftar: {{ $total_mahasiswa }} (termasuk yang nonaktif).
                        </small>
                    </div>
                </div>
            </div>

            <!-- Container untuk Tanggal -->
            <div class="date-grid-container">
                <div class="date-card">
                    <div class="date-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="date-info">
                        <div class="date-label">Terdaftar</div>
                        <div class="date-value">
                            {{ $mahasiswa->created_at->format('d F Y, H:i') }}
                        </div>
                        <div class="date-relative">
                            {{ $mahasiswa->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>

                <div class="date-card">
                    <div class="date-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="date-info">
                        <div class="date-label">Terakhir Update</div>
                        <div class="date-value">
                            {{ $mahasiswa->updated_at->format('d F Y, H:i') }}
                        </div>
                        <div class="date-relative">
                            {{ $mahasiswa->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="security-info">
                <h4 class="security-title">
                    <i class="fas fa-shield-alt"></i>
                    Informasi Keamanan Data
                </h4>
                <ul class="security-list">
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <strong>NIM</strong> dienkripsi menggunakan AES-256 encryption
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <strong>Email</strong> dienkripsi untuk melindungi privasi
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <strong>No HP</strong> tersimpan dalam bentuk terenkripsi
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <strong>UUID</strong> sebagai identifier unik menggantikan ID incremental
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS utama */
    .custom-card {
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border-radius: 20px;
    }
    
    .custom-card-header {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        border-radius: 20px 20px 0 0;
        padding: 1.5rem 2rem;
    }
    
    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .mahasiswa-title {
        color: white;
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
    }
    
    .header-actions {
        display: flex;
        gap: 0.75rem;
    }
    
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
    }
    
    .btn-edit {
        background: #fbbf24;
        color: #92400e;
    }
    
    .btn-edit:hover {
        background: #f59e0b;
        transform: translateY(-2px);
    }
    
    .btn-back {
        background: rgba(255,255,255,0.2);
        color: white;
        border: 1px solid rgba(255,255,255,0.4);
    }
    
    .btn-back:hover {
        background: rgba(255,255,255,0.3);
        transform: translateY(-2px);
    }
    
    .card-body {
        padding: 2rem;
    }
    
    /* Status container */
    .status-container {
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .status-active {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
        border-left: 5px solid #10b981;
        border-right: 5px solid #10b981;
    }
    
    .status-inactive {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
        border-left: 5px solid #ef4444;
        border-right: 5px solid #ef4444;
    }
    
    .status-info {
        flex: 1;
    }
    
    .status-label {
        color: #065f46;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .status-inactive .status-label {
        color: #7f1d1d;
    }
    
    .status-value {
        color: #059669;
        font-weight: 700;
        font-size: 1.2rem;
    }
    
    .status-inactive .status-value {
        color: #dc2626;
    }
    
    .periode-info {
        text-align: right;
    }
    
    .periode-label {
        color: #64748b;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }
    
    .periode-value {
        color: #1e293b;
        font-weight: 600;
    }
    
    .hari-sisa {
        color: #10b981;
        font-weight: 500;
    }
    
    .hari-lewat {
        color: #ef4444;
        font-weight: 500;
    }
    
    /* UUID Container */
    .uuid-container {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(79, 70, 229, 0.05));
        padding: 1.5rem;
        border-radius: 12px;
        border-left: 5px solid #6366f1;
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .uuid-label {
        color: #6366f1;
        font-weight: 600;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }
    
    .uuid-code {
        background: rgba(99, 102, 241, 0.1);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-family: 'Courier New', monospace;
        font-size: 1.1rem;
        display: inline-block;
        color: #4f46e5;
        font-weight: 700;
    }
    
    .uuid-description {
        display: block;
        margin-top: 0.5rem;
        color: #64748b;
        font-size: 0.875rem;
    }
    
    /* Grid Container untuk Informasi Mahasiswa */
    .info-grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .info-card-detail, .divisi-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        border: 2px solid rgba(99, 102, 241, 0.1);
        transition: all 0.3s;
    }
    
    .divisi-card {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(79, 70, 229, 0.1));
        border: 2px solid #6366f1;
    }
    
    .info-card-detail:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.1);
        border-color: #6366f1;
    }
    
    .info-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #64748b;
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
    }
    
    .encrypted-badge {
        background: #e0e7ff;
        color: #4338ca;
        padding: 0.2rem 0.6rem;
        border-radius: 50px;
        font-size: 0.7rem;
        margin-left: auto;
        font-weight: 600;
    }
    
    .info-value {
        color: #1e293b;
        font-weight: 600;
        font-size: 1.2rem;
        word-break: break-word;
    }
    
    .email-value {
        font-size: 1rem;
    }
    
    .badge-divisi {
        background: #6366f1;
        color: white;
        padding: 0.5em 1em;
        border-radius: 6px;
        font-size: 0.9rem;
        display: inline-block;
    }
    
    /* Divisi Detail */
    .divisi-detail-container {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(79, 70, 229, 0.05));
        padding: 2rem;
        border-radius: 15px;
        border-left: 5px solid #6366f1;
        margin-bottom: 2rem;
    }
    
    .divisi-title {
        color: #4f46e5;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .divisi-content {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid rgba(99, 102, 241, 0.1);
    }
    
    .divisi-header {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid rgba(99, 102, 241, 0.1);
    }
    
    .divisi-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        flex-shrink: 0;
    }
    
    .divisi-nama {
        color: #1e293b;
        margin-bottom: 0.5rem;
        font-size: 1.3rem;
        font-weight: 700;
    }
    
    .divisi-deskripsi {
        color: #64748b;
        line-height: 1.6;
        margin: 0;
    }
    
    /* Stats Grid */
    .stats-grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .stat-card {
        text-align: center;
        padding: 1rem;
        background: rgba(99, 102, 241, 0.05);
        border-radius: 8px;
    }
    
    .stat-label {
        color: #64748b;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
    
    .stat-value {
        color: #4f46e5;
        font-size: 1.8rem;
        font-weight: 700;
    }
    
    .sisa-positif {
        color: #4f46e5;
    }
    
    .sisa-negatif {
        color: #ef4444;
    }
    
    .stat-note {
        color: #64748b;
        font-size: 0.75rem;
    }
    
    .info-note {
        margin-top: 1rem;
        background: rgba(99, 102, 241, 0.03);
        padding: 0.75rem;
        border-radius: 8px;
        border-left: 3px solid #6366f1;
    }
    
    .info-note small {
        color: #64748b;
        display: block;
        font-size: 0.8rem;
        line-height: 1.4;
    }
    
    .info-note i {
        color: #6366f1;
        margin-right: 0.5rem;
    }
    
    /* Date Grid */
    .date-grid-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .date-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        border: 2px solid rgba(99, 102, 241, 0.1);
        display: flex;
        gap: 1rem;
    }
    
    .date-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    
    .date-label {
        color: #64748b;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }
    
    .date-value {
        color: #1e293b;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .date-relative {
        color: #64748b;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    /* Security Info */
    .security-info {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(79, 70, 229, 0.05));
        padding: 1.5rem;
        border-radius: 12px;
        border-left: 5px solid #4f46e5;
    }
    
    .security-title {
        color: #4f46e5;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .security-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .security-list li {
        padding: 0.75rem 0;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        line-height: 1.6;
    }
    
    .security-list i {
        color: #10b981;
    }
    
    /* Responsive design */
    @media (max-width: 1200px) {
        .info-grid-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .info-grid-container,
        .stats-grid-container,
        .date-grid-container {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .header-content {
            flex-direction: column;
            text-align: center;
        }
        
        .header-actions {
            justify-content: center;
        }
        
        .divisi-header {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }
        
        .divisi-icon {
            margin: 0 auto;
        }
        
        .status-container {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
        
        .periode-info {
            text-align: center;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding-left: 10px;
            padding-right: 10px;
        }
        
        .custom-card-header {
            padding: 1rem !important;
        }
        
        .mahasiswa-title {
            font-size: 1.5rem !important;
        }
        
        .card-body {
            padding: 1rem !important;
        }
    }
</style>
@endsection