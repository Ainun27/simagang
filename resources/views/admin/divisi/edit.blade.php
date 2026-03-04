@extends('layouts.app')

@section('title', 'Edit Divisi')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center; ">
                <h2 class="card-title">
                    <i class="fas fa-edit"></i>
                    Edit Divisi: {{ $divisi->nama_divisi }}
                </h2>
                <a href="{{ route('admin.divisi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </div>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.divisi.update', $divisi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Divisi -->
                <div class="form-group">
                    <label class="form-label" for="nama_divisi">
                        <i class="fas fa-building"></i> Nama Divisi 
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nama_divisi"
                        name="nama_divisi" 
                        class="form-control @error('nama_divisi') is-invalid @enderror" 
                        value="{{ old('nama_divisi', $divisi->nama_divisi) }}"
                        required
                        autofocus
                    >
                    @error('nama_divisi')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label class="form-label" for="deskripsi">
                        <i class="fas fa-align-left"></i> Deskripsi 
                        <span class="required">*</span>
                    </label>
                    <textarea 
                        id="deskripsi"
                        name="deskripsi" 
                        class="form-control @error('deskripsi') is-invalid @enderror" 
                        rows="4"
                        required
                    >{{ old('deskripsi', $divisi->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Kuota Mahasiswa -->
                <div class="form-group">
                    <label class="form-label" for="kuota">
                        <i class="fas fa-users"></i> Kuota Mahasiswa 
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="kuota"
                        name="kuota" 
                        class="form-control @error('kuota') is-invalid @enderror" 
                        value="{{ old('kuota', $divisi->kuota) }}"
                        min="{{ $divisi->mahasiswa_count ?? 0 }}"
                        max="50"
                        required
                    >
                    @error('kuota')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    @php
                        $terisi = $divisi->mahasiswa_count ?? 0;
                    @endphp
                    @if($terisi > 0)
                        <small class="form-warning">
                            <i class="fas fa-exclamation-triangle"></i> 
                            Sudah ada {{ $terisi }} mahasiswa terdaftar. Kuota minimal: {{ $terisi }}
                        </small>
                    @else
                        <small class="form-hint">
                            <i class="fas fa-info-circle"></i> Belum ada mahasiswa terdaftar
                        </small>
                    @endif
                </div>

                <!-- Status Divisi -->
                <div class="status-box">
                    <h4 class="status-title">
                        <i class="fas fa-info-circle"></i> Status Divisi
                    </h4>
                    <div class="status-grid">
                        <div class="status-item">
                            <div class="status-label">Kuota Total</div>
                            <div class="status-value primary">{{ $divisi->kuota }}</div>
                        </div>
                        <div class="status-item">
                            <div class="status-label">Terisi</div>
                            <div class="status-value success">{{ $terisi }}</div>
                        </div>
                        <div class="status-item">
                            <div class="status-label">Sisa</div>
                            <div class="status-value {{ $divisi->kuota - $terisi > 0 ? 'success' : 'danger' }}">
                                {{ $divisi->kuota - $terisi }}
                            </div>
                        </div>
                        <div class="status-item">
                            <div class="status-label">Dibuat</div>
                            <div class="status-value dark">{{ $divisi->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Kembali dan Update -->
                <div class="form-actions" style="background: #f8f9fa; padding: 10px;">
                <a href="{{ route('admin.divisi.index') }}" class="btn btn-secondary" style="display: inline-block; background-color: #6c757d; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Divisi
                </button>
            </div>
            </form>
        </div>
    </div>

    <!-- Alert jika ada mahasiswa terdaftar -->
    @if($terisi > 0)
    <div class="alert alert-warning mt-3">
        <i class="fas fa-exclamation-triangle alert-icon"></i>
        <div>
            <strong>Perhatian!</strong>
            <ul class="warning-list">
                <li>Divisi ini memiliki {{ $terisi }} mahasiswa yang sedang magang</li>
                <li>Kuota tidak dapat dikurangi di bawah jumlah mahasiswa yang sudah terdaftar</li>
                <li>Perubahan nama dan deskripsi tidak akan mempengaruhi mahasiswa yang sudah terdaftar</li>
            </ul>
        </div>
    </div>
    @endif
</div>

@push('styles')
<style>
    .form-container {
        padding: 2rem;
    }

    .required {
        color: var(--danger);
    }

    .form-hint {
        color: var(--gray);
        display: block;
        margin-top: 0.5rem;
    }

    .form-warning {
        color: var(--warning);
        display: block;
        margin-top: 0.5rem;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .status-box {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        padding: 1.5rem;
        border-radius: 15px;
        border-left: 5px solid var(--info);
        margin-bottom: 2rem;
    }

    .status-title {
        color: var(--primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .status-label {
        font-size: 0.875rem;
        color: var(--gray);
        margin-bottom: 0.25rem;
    }

    .status-value {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .status-value.primary {
        color: var(--primary);
    }

    .status-value.success {
        color: var(--success);
    }

    .status-value.danger {
        color: var(--danger);
    }

    .status-value.dark {
        color: var(--dark);
        font-size: 1rem;
        font-weight: 600;
    }

    .form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eee; /* Tambahkan garis pemisah agar jelas */
    clear: both; /* Memastikan tidak tertabrak float */
}

    .alert-icon {
        font-size: 1.5rem;
    }

    .warning-list {
        margin: 0.5rem 0 0 1.5rem;
        line-height: 1.8;
    }
</style>
@endpush
@endsection