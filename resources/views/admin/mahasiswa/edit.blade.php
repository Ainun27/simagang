@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header" style="background: #4f46e5; color: white; padding: 1.5rem 2rem; border-radius: 10px 10px 0 0;">
            <h2 style="margin: 0; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-user-edit"></i>
                Edit Data Mahasiswa: {{ $mahasiswa->nama }}
            </h2>
        </div>

        <div style="padding: 2rem;">
            @if ($errors->any())
                <div style="background: #fee; padding: 1.25rem; border-radius: 12px; border-left: 5px solid #ef4444; margin-bottom: 2rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 2rem; color: #ef4444;"></i>
                        <div>
                            <strong style="color: #1f2937; display: block; margin-bottom: 0.25rem;">Terjadi Kesalahan!</strong>
                            <ul style="color: #6b7280; margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST" id="mahasiswaForm">
                @csrf
                @method('PUT')

                <!-- Info Enkripsi -->
                <div style="background: #fffbeb; padding: 1.25rem; border-radius: 12px; border-left: 5px solid #f59e0b; margin-bottom: 2rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-shield-alt" style="font-size: 2rem; color: #f59e0b;"></i>
                        <div>
                            <strong style="color: #1f2937; display: block; margin-bottom: 0.25rem;">Data Terenkripsi</strong>
                            <small style="color: #6b7280;">NIM, Email, dan No HP tetap aman terenkripsi setelah update data</small>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="nim" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">
                        <i class="fas fa-id-card"></i> NIM <span style="color: #ef4444;">*</span>
                        <span class="badge" style="background: #f59e0b; color: white; margin-left: 0.5rem; font-size: 0.75rem; padding: 0.2rem 0.6rem; border-radius: 50px;">
                            <i class="fas fa-lock"></i> Terenkripsi
                        </span>
                    </label>
                    <input 
                        type="text" 
                        id="nim"
                        name="nim" 
                        class="form-control @error('nim') is-invalid @enderror" 
                        value="{{ old('nim', $mahasiswa->nim) }}"
                        placeholder="Contoh: 210101001"
                        required
                        autofocus
                        style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; transition: all 0.3s; font-size: 1rem;"
                    >
                    @error('nim')
                        <div class="invalid-feedback" style="display: block; width: 100%; margin-top: 0.25rem; font-size: 0.875rem; color: #ef4444;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="nama" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">
                        <i class="fas fa-user"></i> Nama Lengkap <span style="color: #ef4444;">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nama"
                        name="nama" 
                        class="form-control @error('nama') is-invalid @enderror" 
                        value="{{ old('nama', $mahasiswa->nama) }}"
                        placeholder="Contoh: Ahmad Fauzi"
                        required
                        style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; transition: all 0.3s; font-size: 1rem;"
                    >
                    @error('nama')
                        <div class="invalid-feedback" style="display: block; width: 100%; margin-top: 0.25rem; font-size: 0.875rem; color: #ef4444;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">
                        <i class="fas fa-envelope"></i> Email <span style="color: #ef4444;">*</span>
                        <span class="badge" style="background: #f59e0b; color: white; margin-left: 0.5rem; font-size: 0.75rem; padding: 0.2rem 0.6rem; border-radius: 50px;">
                            <i class="fas fa-lock"></i> Terenkripsi
                        </span>
                    </label>
                    <input 
                        type="email" 
                        id="email"
                        name="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        value="{{ old('email', $mahasiswa->email) }}"
                        placeholder="Contoh: ahmad@example.com"
                        required
                        style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; transition: all 0.3s; font-size: 1rem;"
                    >
                    @error('email')
                        <div class="invalid-feedback" style="display: block; width: 100%; margin-top: 0.25rem; font-size: 0.875rem; color: #ef4444;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="no_hp" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">
                        <i class="fas fa-phone"></i> Nomor HP <span style="color: #ef4444;">*</span>
                        <span class="badge" style="background: #f59e0b; color: white; margin-left: 0.5rem; font-size: 0.75rem; padding: 0.2rem 0.6rem; border-radius: 50px;">
                            <i class="fas fa-lock"></i> Terenkripsi
                        </span>
                    </label>
                    <input 
                        type="text" 
                        id="no_hp"
                        name="no_hp" 
                        class="form-control @error('no_hp') is-invalid @enderror" 
                        value="{{ old('no_hp', $mahasiswa->no_hp) }}"
                        placeholder="Contoh: 081234567890"
                        required
                        style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; transition: all 0.3s; font-size: 1rem;"
                    >
                    @error('no_hp')
                        <div class="invalid-feedback" style="display: block; width: 100%; margin-top: 0.25rem; font-size: 0.875rem; color: #ef4444;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="universitas" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">
                        <i class="fas fa-university"></i> Universitas <span style="color: #ef4444;">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="universitas"
                        name="universitas" 
                        class="form-control @error('universitas') is-invalid @enderror" 
                        value="{{ old('universitas', $mahasiswa->universitas) }}"
                        placeholder="Contoh: Universitas Mulawarman"
                        required
                        style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; transition: all 0.3s; font-size: 1rem;"
                    >
                    @error('universitas')
                        <div class="invalid-feedback" style="display: block; width: 100%; margin-top: 0.25rem; font-size: 0.875rem; color: #ef4444;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="divisi_id" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">
                        <i class="fas fa-briefcase"></i> Divisi Magang <span style="color: #ef4444;">*</span>
                    </label>
                    <!-- Di dalam select option untuk divisi -->
<select name="divisi_id" id="divisi_id" class="form-control @error('divisi_id') is-invalid @enderror" required
        style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; transition: all 0.3s; font-size: 1rem; background: white; appearance: none;">
    <option value="">-- Pilih Divisi --</option>
    @foreach($divisi as $d)
        @php
            // Menggunakan data dari controller yang sudah dihitung
            $terisi = $d->terisi ?? $d->mahasiswa()->where('is_active', true)->count();
            $sisa_kuota = $d->sisa_kuota ?? ($d->kuota - $terisi);
            $is_current = $d->id == $mahasiswa->divisi_id;
        @endphp
        <option value="{{ $d->id }}" 
                {{ old('divisi_id', $mahasiswa->divisi_id) == $d->id ? 'selected' : '' }}
                {{ ($sisa_kuota <= 0 && !$is_current) ? 'disabled' : '' }}
                data-kuota="{{ $d->kuota }}"
                data-terisi="{{ $terisi }}"
                data-sisa="{{ $sisa_kuota }}">
            {{ $d->nama_divisi }} - 
            @if($is_current)
                (Divisi Saat Ini - Kuota: {{ $d->kuota }})
            @elseif($sisa_kuota > 0)
                (Sisa Kuota: {{ $sisa_kuota }}/{{ $d->kuota }})
            @else
                (PENUH)
            @endif
        </option>
    @endforeach
</select>
                    @error('divisi_id')
                        <div class="invalid-feedback" style="display: block; width: 100%; margin-top: 0.25rem; font-size: 0.875rem; color: #ef4444;">
                            {{ $message }}
                        </div>
                    @enderror
                    
                    <!-- Info Divisi yang dipilih -->
                    <div id="divisi-info" style="margin-top: 1rem; display: none;"></div>
                </div>

                <!-- TANGGAL MULAI DAN SELESAI -->
                <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
                    <div class="form-group" style="flex: 1; min-width: 250px; margin-bottom: 1rem;">
                        <label for="tanggal_mulai" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">
                            <i class="fas fa-calendar-plus"></i> Tanggal Mulai Magang <span style="color: #ef4444;">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="tanggal_mulai"
                            name="tanggal_mulai" 
                            class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                            value="{{ old('tanggal_mulai', $mahasiswa->tanggal_mulai ? \Carbon\Carbon::parse($mahasiswa->tanggal_mulai)->format('Y-m-d') : date('Y-m-d')) }}"
                            required
                            style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; transition: all 0.3s; font-size: 1rem;"
                        >
                        @error('tanggal_mulai')
                            <div class="invalid-feedback" style="display: block; width: 100%; margin-top: 0.25rem; font-size: 0.875rem; color: #ef4444;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group" style="flex: 1; min-width: 250px; margin-bottom: 1rem;">
                        <label for="tanggal_selesai" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">
                            <i class="fas fa-calendar-minus"></i> Tanggal Selesai Magang <span style="color: #ef4444;">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="tanggal_selesai"
                            name="tanggal_selesai" 
                            class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                            value="{{ old('tanggal_selesai', $mahasiswa->tanggal_selesai ? \Carbon\Carbon::parse($mahasiswa->tanggal_selesai)->format('Y-m-d') : '') }}"
                            required
                            style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; transition: all 0.3s; font-size: 1rem;"
                        >
                        @error('tanggal_selesai')
                            <div class="invalid-feedback" style="display: block; width: 100%; margin-top: 0.25rem; font-size: 0.875rem; color: #ef4444;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- INFO MASA MAGANG OTOMATIS -->
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">
                        <i class="fas fa-calculator"></i> Masa Magang (Otomatis Terhitung)
                    </label>
                    <div style="background: #eff6ff; padding: 1rem; border-radius: 8px; border-left: 4px solid #3b82f6;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; flex-wrap: wrap; gap: 1rem;">
                            <div>
                                <strong style="color: #3b82f6;">Durasi:</strong>
                                <span id="masa-magang-text" style="font-size: 1.1rem; font-weight: 600; margin-left: 0.5rem;">-</span>
                            </div>
                            <div>
                                <strong style="color: #3b82f6;">Status Saat Ini:</strong>
                                <span class="badge" style="background: {{ $mahasiswa->is_active ? '#10b981' : '#ef4444' }}; margin-left: 0.5rem; color: white; padding: 0.25rem 0.75rem; border-radius: 50px; font-size: 0.875rem;">
                                    <i class="fas {{ $mahasiswa->is_active ? 'fa-check-circle' : 'fa-times-circle' }}"></i> 
                                    {{ $mahasiswa->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </div>
                        <small style="color: #6b7280; display: block;">
                            <i class="fas fa-info-circle"></i> Status akan otomatis diperbarui berdasarkan tanggal selesai
                        </small>
                    </div>
                </div>

                <!-- Status (Opsional untuk manual override) -->
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="is_active" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151;">
                        <i class="fas fa-toggle-on"></i> Status Mahasiswa (Opsional)
                    </label>
                    <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror"
                            style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; transition: all 0.3s; font-size: 1rem; background: white;">
                        <option value="">-- Biarkan Kosong untuk Otomatis --</option>
                        <option value="1" {{ old('is_active', $mahasiswa->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $mahasiswa->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    <small style="color: #6b7280; margin-top: 0.25rem; display: block;">
                        <i class="fas fa-lightbulb"></i> Jika dikosongkan, status akan otomatis berdasarkan tanggal selesai
                    </small>
                    @error('is_active')
                        <div class="invalid-feedback" style="display: block; width: 100%; margin-top: 0.25rem; font-size: 0.875rem; color: #ef4444;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem; padding-bottom: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('admin.mahasiswa.index') }}" 
                    class="btn btn-light" 
                    style="border: 1px solid #d1d5db; color: #374151; display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s; background: white;">
                        <i class="fas fa-times" style="margin-right: 8px;"></i>
                        Batal
                    </a>
                    
                    <button type="submit" class="btn btn-primary" 
                            style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; border-radius: 8px; border: none; background: #4f46e5; color: white; font-weight: 600; cursor: pointer; transition: all 0.3s;">
                        <i class="fas fa-save" style="margin-right: 8px;"></i>
                        Update Data Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Help Card -->
    <div class="card" style="margin-top: 2rem; background: #f9fafb; border: 1px solid #e5e7eb; color: #1f2937; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="padding: 1.5rem;">
            <h4 style="margin-bottom: 1rem; display: flex; align-items: center; gap: 0.75rem; color: #4f46e5;">
                <i class="fas fa-info-circle" style="color: #4f46e5;"></i>
                Informasi Penting - Edit
            </h4>
            <ul style="line-height: 2; margin-left: 1.5rem; padding: 0; color: #374151;">
                <li><strong style="color: #1f2937;">Update Enkripsi:</strong> Jika NIM/Email diubah, data akan dienkripsi ulang secara otomatis</li>
                <li><strong style="color: #1f2937;">Divisi Saat Ini:</strong> Anda tetap bisa berada di divisi saat ini meskipun kuota penuh</li>
                <li><strong style="color: #1f2937;">Status Otomatis:</strong> Jika status dikosongkan, akan otomatis berdasarkan tanggal selesai</li>
                <li><strong style="color: #1f2937;">Validasi Tanggal:</strong> Tanggal selesai harus setelah tanggal mulai</li>
                <li><strong style="color: #1f2937;">Data Historis:</strong> ID dan timestamp dibuat tidak akan berubah</li>
            </ul>
        </div>
    </div>
</div>

@push('styles')
<style>
    .form-control:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    
    .btn-light:hover {
        background: #f9fafb;
        border-color: #9ca3af;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .btn-primary:hover {
        background: #4338ca;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 10px;
        }
        
        .card-header {
            padding: 1.25rem 1rem;
        }
        
        h2 {
            font-size: 1.5rem;
        }
        
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .action-buttons a,
        .action-buttons button {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.getElementById('divisi_id').addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        const infoDiv = document.getElementById('divisi-info');
        
        if (this.value) {
            const kuota = option.dataset.kuota;
            const terisi = option.dataset.terisi;
            const sisa = option.dataset.sisa;
            
            let statusColor = sisa > 2 ? '#10b981' : (sisa > 0 ? '#f59e0b' : '#ef4444');
            
            infoDiv.innerHTML = `
                <div style="background: #eff6ff; padding: 1rem; border-radius: 10px; border-left: 4px solid #3b82f6;">
                    <strong style="color: #3b82f6;">${option.text.split(' - ')[0]}</strong>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-top: 0.75rem;">
                        <div>
                            <small style="color: #6b7280;">Total Kuota</small>
                            <div style="font-weight: 700; color: #1f2937;">${kuota}</div>
                        </div>
                        <div>
                            <small style="color: #6b7280;">Terisi</small>
                            <div style="font-weight: 700; color: #3b82f6;">${terisi}</div>
                        </div>
                        <div>
                            <small style="color: #6b7280;">Sisa</small>
                            <div style="font-weight: 700; color: ${statusColor};">${sisa}</div>
                        </div>
                    </div>
                </div>
            `;
            infoDiv.style.display = 'block';
        } else {
            infoDiv.style.display = 'none';
        }
    });

    function hitungMasaMagang() {
        const tanggalMulai = document.getElementById('tanggal_mulai').value;
        const tanggalSelesai = document.getElementById('tanggal_selesai').value;
        const masaMagangText = document.getElementById('masa-magang-text');
        const statusSelect = document.getElementById('is_active');
        
        if (tanggalMulai && tanggalSelesai) {
            const tglMulai = new Date(tanggalMulai);
            const tglSelesai = new Date(tanggalSelesai);
            
            if (tglSelesai <= tglMulai) {
                masaMagangText.textContent = 'Tanggal tidak valid!';
                masaMagangText.style.color = '#ef4444';
                return;
            }
            
            const selisihMs = tglSelesai - tglMulai;
            const selisihHari = Math.floor(selisihMs / (1000 * 60 * 60 * 24));
            
            let durasiText = '';
            if (selisihHari >= 30) {
                const bulan = Math.floor(selisihHari / 30);
                const hariSisa = selisihHari % 30;
                
                if (hariSisa > 0) {
                    durasiText = `${bulan} bulan ${hariSisa} hari`;
                } else {
                    durasiText = `${bulan} bulan`;
                }
            } else {
                durasiText = `${selisihHari} hari`;
            }
            
            masaMagangText.textContent = durasiText;
            masaMagangText.style.color = '#10b981';
            
            if (statusSelect && statusSelect.value === '') {
                const sekarang = new Date();
                if (tglSelesai < sekarang) {
                    statusSelect.title = 'Akan otomatis menjadi Nonaktif (berdasarkan tanggal selesai)';
                } else if (tglMulai > sekarang) {
                    statusSelect.title = 'Akan otomatis menjadi Aktif saat tanggal mulai tiba';
                } else {
                    statusSelect.title = 'Akan otomatis tetap Aktif hingga tanggal selesai';
                }
            }
        } else {
            masaMagangText.textContent = '-';
            masaMagangText.style.color = '#6b7280';
        }
    }

    document.getElementById('tanggal_mulai').addEventListener('change', hitungMasaMagang);
    document.getElementById('tanggal_selesai').addEventListener('change', hitungMasaMagang);

    document.getElementById('mahasiswaForm').addEventListener('submit', function(e) {
        const tanggalMulai = document.getElementById('tanggal_mulai').value;
        const tanggalSelesai = document.getElementById('tanggal_selesai').value;
        
        if (tanggalMulai && tanggalSelesai) {
            const tglMulai = new Date(tanggalMulai);
            const tglSelesai = new Date(tanggalSelesai);
            
            if (tglSelesai <= tglMulai) {
                e.preventDefault();
                alert('Tanggal selesai harus setelah tanggal mulai!');
                document.getElementById('tanggal_selesai').focus();
                return false;
            }
        }
        
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = '#ef4444';
                field.focus();
            } else {
                field.style.borderColor = '#e5e7eb';
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Harap lengkapi semua field yang wajib diisi!');
            return false;
        }
        
        return true;
    });

    window.addEventListener('DOMContentLoaded', function() {
        hitungMasaMagang();
        
        const divisiSelect = document.getElementById('divisi_id');
        if (divisiSelect.value) {
            setTimeout(() => {
                divisiSelect.dispatchEvent(new Event('change'));
            }, 100);
        }
        
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.style.borderColor = '#10b981';
                } else {
                    this.style.borderColor = '#e5e7eb';
                }
            });
        });
    });
</script>
@endpush
@endsection