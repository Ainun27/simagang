@extends('layouts.app')

@section('title', 'Detail Divisi')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header header-gradient">
            <div class="header-content">
                <h2 class="header-title">
                    <i class="fas fa-building"></i>
                    {{ $divisi->nama_divisi }}
                </h2>
                <div class="header-actions">
                    <a href="{{ route('admin.divisi.edit', $divisi->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>
                    <a href="{{ route('admin.divisi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="detail-container">
            @php
                $terisi = $divisi->mahasiswa->count();
                $sisa = $divisi->kuota - $terisi;
                $percentage = $divisi->kuota > 0 ? ($terisi / $divisi->kuota) * 100 : 0;
            @endphp

            <div class="stats-grid">
                <div class="stat-card gradient-primary">
                    <div class="stat-label">
                        <i class="fas fa-users"></i> Kuota Total
                    </div>
                    <div class="stat-value">{{ $divisi->kuota }}</div>
                </div>

                <div class="stat-card gradient-info">
                    <div class="stat-label">
                        <i class="fas fa-user-check"></i> Terisi
                    </div>
                    <div class="stat-value">{{ $terisi }}</div>
                </div>

                <div class="stat-card {{ $sisa > 0 ? 'gradient-success' : 'gradient-danger' }}">
                    <div class="stat-label">
                        <i class="fas fa-{{ $sisa > 0 ? 'check-circle' : 'times-circle' }}"></i> Sisa Kuota
                    </div>
                    <div class="stat-value">{{ $sisa }}</div>
                </div>

                <div class="stat-card gradient-accent">
                    <div class="stat-label">
                        <i class="fas fa-percentage"></i> Pengisian
                    </div>
                    <div class="stat-value">{{ number_format($percentage, 0) }}%</div>
                </div>
            </div>

            <div class="progress-section">
                <div class="progress-bar">
                    <div class="progress-fill" data-width="{{ $percentage }}">
                        @if($percentage > 10)
                            {{ number_format($percentage, 0) }}%
                        @endif
                    </div>
                </div>
            </div>

            <div class="description-box">
                <h3 class="box-title">
                    <i class="fas fa-align-left"></i>
                    Deskripsi Divisi
                </h3>
                <p class="description-text">{{ $divisi->deskripsi }}</p>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-calendar-plus"></i> Dibuat
                    </div>
                    <div class="info-value">{{ $divisi->created_at->format('d F Y') }}</div>
                    <div class="info-subtext">{{ $divisi->created_at->diffForHumans() }}</div>
                </div>

                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-clock"></i> Terakhir Diupdate
                    </div>
                    <div class="info-value">{{ $divisi->updated_at->format('d F Y') }}</div>
                    <div class="info-subtext">{{ $divisi->updated_at->diffForHumans() }}</div>
                </div>

                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-chart-line"></i> Status
                    </div>
                    <div>
                        @if($sisa > 0)
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle"></i> Masih Tersedia
                            </span>
                        @else
                            <span class="badge badge-danger">
                                <i class="fas fa-times-circle"></i> Kuota Penuh
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            @if($divisi->mahasiswa->count() > 0)
            <div class="card mahasiswa-card">
                <div class="card-header mahasiswa-header">
                    <h3 class="card-title">
                        <i class="fas fa-users"></i>
                        Daftar Mahasiswa ({{ $divisi->mahasiswa->count() }})
                    </h3>
                </div>
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Universitas</th>
                                <th>Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($divisi->mahasiswa as $index => $mhs)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $mhs->nama }}</strong>
                                    <br>
                                    <small class="text-muted">NIM: {{ $mhs->nim }}</small>
                                </td>
                                <td>{{ $mhs->universitas }}</td>
                                <td>
                                    <small>{{ $mhs->created_at->format('d M Y') }}</small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="empty-mahasiswa">
                <div class="empty-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h4>Belum Ada Mahasiswa</h4>
                <p>Divisi ini belum memiliki mahasiswa yang terdaftar</p>
            </div>
            @endif

        </div>
    </div>
</div>

@push('styles')
<style>
    .header-gradient {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
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

    .header-title {
        color: white;
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
    }

    .header-actions {
        display: flex;
        gap: 0.75rem;
    }

    .detail-container {
        padding: 2rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        color: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .gradient-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .gradient-info {
        background: linear-gradient(135deg, #4cc9f0, #667eea);
    }

    .gradient-success {
        background: linear-gradient(135deg, #28a745, #4cc9f0);
    }

    .gradient-danger {
        background: linear-gradient(135deg, #dc3545, #f72585);
    }

    .gradient-accent {
        background: linear-gradient(135deg, #f093fb, #f5576c);
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
    }

    .progress-section {
        margin-bottom: 2rem;
    }

    .progress-bar {
        background: #e9ecef;
        height: 30px;
        border-radius: 15px;
        overflow: hidden;
        position: relative;
    }

    .progress-fill {
        background: linear-gradient(135deg, var(--success), var(--primary));
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.875rem;
        transition: width 1s ease;
        width: 0%;
    }

    .description-box {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        padding: 2rem;
        border-radius: 15px;
        border-left: 5px solid var(--primary);
        margin-bottom: 2rem;
    }

    .box-title {
        color: var(--primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .description-text {
        color: var(--dark);
        line-height: 1.8;
        font-size: 1.05rem;
        margin: 0;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        border: 2px solid rgba(102, 126, 234, 0.1);
    }

    .info-label {
        color: var(--gray);
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .info-value {
        color: var(--dark);
        font-weight: 600;
        font-size: 1.1rem;
    }

    .info-subtext {
        color: var(--gray);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .mahasiswa-card {
        margin-top: 2rem;
        border: 2px solid rgba(102, 126, 234, 0.1);
    }

    .mahasiswa-header {
        background: rgba(102, 126, 234, 0.05);
        border-bottom: 2px solid rgba(102, 126, 234, 0.1);
    }

    .table-wrapper {
        padding: 0;
    }

    .empty-mahasiswa {
        background: rgba(108, 117, 125, 0.05);
        padding: 2rem;
        border-radius: 15px;
        text-align: center;
        border: 2px dashed rgba(108, 117, 125, 0.2);
    }

    .empty-icon {
        font-size: 3rem;
        color: var(--gray);
        opacity: 0.3;
        margin-bottom: 1rem;
    }

    .empty-mahasiswa h4 {
        color: var(--gray);
        margin-bottom: 0.5rem;
    }

    .empty-mahasiswa p {
        color: var(--gray);
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const progressFill = document.querySelector('.progress-fill');
        if (progressFill) {
            const width = progressFill.getAttribute('data-width');
            setTimeout(() => {
                progressFill.style.width = width + '%';
            }, 100);
        }
    });
</script>
@endpush
@endsection