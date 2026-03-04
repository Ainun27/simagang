@extends('layouts.app')

@section('title', 'Tambah Divisi')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="card-title">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Divisi Baru
                </h2>
    
            </div>
        </div>

        <div style="padding: 2rem;">
            <form action="{{ route('admin.divisi.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="nama_divisi">
                        <i class="fas fa-building"></i> Nama Divisi <span style="color: var(--danger);">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nama_divisi"
                        name="nama_divisi" 
                        class="form-control @error('nama_divisi') is-invalid @enderror" 
                        value="{{ old('nama_divisi') }}"
                        placeholder="Contoh: IT & Programmer"
                        required
                        autofocus
                    >
                    @error('nama_divisi')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small style="color: var(--gray); display: block; margin-top: 0.5rem;">
                        <i class="fas fa-info-circle"></i> Gunakan nama yang jelas dan mudah dipahami
                    </small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="deskripsi">
                        <i class="fas fa-align-left"></i> Deskripsi <span style="color: var(--danger);">*</span>
                    </label>
                    <textarea 
                        id="deskripsi"
                        name="deskripsi" 
                        class="form-control @error('deskripsi') is-invalid @enderror" 
                        rows="4"
                        placeholder="Jelaskan tugas dan tanggung jawab divisi ini..."
                        required
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small style="color: var(--gray); display: block; margin-top: 0.5rem;">
                        <i class="fas fa-info-circle"></i> Minimal 20 karakter, jelaskan secara detail
                    </small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="kuota">
                        <i class="fas fa-users"></i> Kuota Mahasiswa <span style="color: var(--danger);">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="kuota"
                        name="kuota" 
                        class="form-control @error('kuota') is-invalid @enderror" 
                        value="{{ old('kuota', 5) }}"
                        min="1"
                        max="50"
                        required
                    >
                    @error('kuota')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small style="color: var(--gray); display: block; margin-top: 0.5rem;">
                        <i class="fas fa-info-circle"></i> Jumlah mahasiswa yang dapat diterima (1-50 orang)
                    </small>
                </div>

                <!-- Preview Card - WARNA BACKGROUND DIPERBAIKI -->
                <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1)); 
                            padding: 1.5rem; 
                            border-radius: 15px; 
                            border-left: 5px solid var(--primary);
                            margin-bottom: 2rem;
                            border: 1px solid rgba(102, 126, 234, 0.2);">
                    <h4 style="color: var(--primary); margin-bottom: 1rem;">
                        <i class="fas fa-eye"></i> Preview Divisi
                    </h4>
                    <div id="preview-content">
                        <div style="margin-bottom: 0.75rem;">
                            <strong style="color: #212529;">Nama:</strong> 
                            <span id="preview-nama" style="color: #212529; font-weight: 600;">-</span>
                        </div>
                        <div style="margin-bottom: 0.75rem;">
                            <strong style="color: #212529;">Deskripsi:</strong> 
                            <span id="preview-deskripsi" style="color: #495057;">-</span>
                        </div>
                        <div>
                            <strong style="color: #212529;">Kuota:</strong> 
                            <span id="preview-kuota" style="color: #198754; font-weight: 600;">-</span>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <a href="{{ route('admin.divisi.index') }}" class="btn btn-secondary" style="background: #6c757d; color: white; border: none;">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan Divisi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Help Card -->
    <div class="card" style="margin-top: 2rem; background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05)); border: 1px solid rgba(102, 126, 234, 0.2); border-left: 5px solid var(--primary);">
        <div style="padding: 1.5rem;">
            <h4 style="margin-bottom: 1rem; color: var(--primary);">
                <i class="fas fa-question-circle"></i> Panduan Pengisian
            </h4>
            <ul style="line-height: 2; margin-left: 1.5rem; padding: 0; list-style: none;">
                <li style="color: #ffff; margin-bottom: 0.75rem; position: relative; padding-left: 1.5rem;">
                    <i class="fas fa-check" style="color: #198754; position: absolute; left: 0;"></i>
                    <strong>Nama Divisi:</strong> Harus unik dan belum pernah digunakan
                </li>
                <li style="color: #ffff; margin-bottom: 0.75rem; position: relative; padding-left: 1.5rem;">
                    <i class="fas fa-check" style="color: #198754; position: absolute; left: 0;"></i>
                    <strong>Deskripsi:</strong> Jelaskan tugas, skill yang dibutuhkan, dan output yang diharapkan
                </li>
                <li style="color: #ffff; position: relative; padding-left: 1.5rem;">
                    <i class="fas fa-check" style="color: #198754; position: absolute; left: 0;"></i>
                    <strong>Kuota:</strong> Sesuaikan dengan jumlah mentor dan kapasitas divisi
                </li>
            </ul>
        </div>
    </div>
</div>

@push('styles')
<style>
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        opacity: 1;
    }
    
    /* Tambahan untuk memperjelas preview */
    #preview-content strong {
        min-width: 80px;
        display: inline-block;
    }
    
    #preview-content span {
        margin-left: 0.5rem;
    }

    /* Tombol styling */
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-outline-secondary {
        background: transparent;
        color: var(--dark);
        border: 2px solid var(--border-color);
        padding: 0.5rem 1rem;
    }

    .btn-outline-secondary:hover {
        background: var(--light-gray);
        border-color: var(--gray);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem;
        }
        
        .card-header div {
            width: 100%;
        }
        
        .btn-outline-secondary {
            margin-top: 1rem;
            width: 100%;
            justify-content: center;
        }
        
        div[style*="display: flex; gap: 1rem; justify-content: flex-end;"] {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Live Preview
    document.addEventListener('DOMContentLoaded', function() {
        const namaDivisi = document.getElementById('nama_divisi');
        const deskripsi = document.getElementById('deskripsi');
        const kuota = document.getElementById('kuota');

        const previewNama = document.getElementById('preview-nama');
        const previewDeskripsi = document.getElementById('preview-deskripsi');
        const previewKuota = document.getElementById('preview-kuota');

        function updatePreview() {
            // Update nama dengan warna hitam (212529)
            previewNama.textContent = namaDivisi.value || '-';
            previewNama.style.color = '#212529';
            previewNama.style.fontWeight = '600';
            
            // Update deskripsi dengan warna abu-abu gelap (495057)
            if (deskripsi.value.trim()) {
                // Jika deskripsi terlalu panjang, potong
                let descText = deskripsi.value;
                if (descText.length > 50) {
                    descText = descText.substring(0, 50) + '...';
                }
                previewDeskripsi.textContent = descText;
            } else {
                previewDeskripsi.textContent = '-';
            }
            previewDeskripsi.style.color = '#495057';
            
            // Update kuota dengan warna hijau (198754)
            if (kuota.value) {
                previewKuota.textContent = kuota.value + ' Mahasiswa';
                previewKuota.style.color = '#198754';
                previewKuota.style.fontWeight = '600';
            } else {
                previewKuota.textContent = '-';
                previewKuota.style.color = '#495057';
                previewKuota.style.fontWeight = 'normal';
            }
        }

        namaDivisi.addEventListener('input', updatePreview);
        deskripsi.addEventListener('input', updatePreview);
        kuota.addEventListener('input', updatePreview);

        // Initial update
        updatePreview();
    });
</script>
@endpush
@endsection