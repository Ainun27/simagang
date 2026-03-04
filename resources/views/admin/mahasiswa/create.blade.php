@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fas fa-user-plus"></i>
                Tambah Mahasiswa Baru
            </h2>
        </div>

        <div style="padding: 2rem;">
            <form action="{{ route('admin.mahasiswa.store') }}" method="POST" id="mahasiswaForm">
                @csrf

                <!-- Info Enkripsi -->
                <div style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(255, 152, 0, 0.1)); 
                            padding: 1.25rem; 
                            border-radius: 12px; 
                            border-left: 5px solid var(--warning);
                            margin-bottom: 2rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-shield-alt" style="font-size: 2rem; color: var(--warning);"></i>
                        <div>
                            <strong style="color: var(--dark); display: block; margin-bottom: 0.25rem;">Data Akan Dienkripsi</strong>
                            <small style="color: var(--gray);">NIM, Email, dan No HP akan dienkripsi otomatis menggunakan AES-256</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="nim">
                        <i class="fas fa-id-card"></i> NIM <span style="color: var(--danger);">*</span>
                        <span class="badge" style="background: var(--warning); color: white; margin-left: 0.5rem; font-size: 0.75rem;">
                            <i class="fas fa-lock"></i> Akan Dienkripsi
                        </span>
                    </label>
                    <input 
                        type="text" 
                        id="nim"
                        name="nim" 
                        class="form-control @error('nim') is-invalid @enderror" 
                        value="{{ old('nim') }}"
                        placeholder="Contoh: 210101001"
                        required
                        autofocus
                    >
                    @error('nim')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="nama">
                        <i class="fas fa-user"></i> Nama Lengkap <span style="color: var(--danger);">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nama"
                        name="nama" 
                        class="form-control @error('nama') is-invalid @enderror" 
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Ahmad Fauzi"
                        required
                    >
                    @error('nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i> Email <span style="color: var(--danger);">*</span>
                        <span class="badge" style="background: var(--warning); color: white; margin-left: 0.5rem; font-size: 0.75rem;">
                            <i class="fas fa-lock"></i> Akan Dienkripsi
                        </span>
                    </label>
                    <input 
                        type="email" 
                        id="email"
                        name="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        value="{{ old('email') }}"
                        placeholder="Contoh: ahmad@example.com"
                        required
                    >
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="no_hp">
                        <i class="fas fa-phone"></i> Nomor HP <span style="color: var(--danger);">*</span>
                        <span class="badge" style="background: var(--warning); color: white; margin-left: 0.5rem; font-size: 0.75rem;">
                            <i class="fas fa-lock"></i> Akan Dienkripsi
                        </span>
                    </label>
                    <input 
                        type="text" 
                        id="no_hp"
                        name="no_hp" 
                        class="form-control @error('no_hp') is-invalid @enderror" 
                        value="{{ old('no_hp') }}"
                        placeholder="Contoh: 081234567890"
                        required
                    >
                    @error('no_hp')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="universitas">
                        <i class="fas fa-university"></i> Universitas <span style="color: var(--danger);">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="universitas"
                        name="universitas" 
                        class="form-control @error('universitas') is-invalid @enderror" 
                        value="{{ old('universitas') }}"
                        placeholder="Contoh: Universitas Mulawarman"
                        required
                    >
                    @error('universitas')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="divisi_id">
                        <i class="fas fa-briefcase"></i> Divisi Magang <span style="color: var(--danger);">*</span>
                    </label>
                    <select name="divisi_id" id="divisi_id" class="form-control @error('divisi_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Divisi --</option>
                        @foreach($divisi as $d)
                            @php
                                $terisi = $d->mahasiswa()->count();
                                $sisa = $d->kuota - $terisi;
                            @endphp
                            <option value="{{ $d->id }}" 
                                    {{ old('divisi_id') == $d->id ? 'selected' : '' }}
                                    {{ $sisa <= 0 ? 'disabled' : '' }}
                                    data-kuota="{{ $d->kuota }}"
                                    data-terisi="{{ $terisi }}"
                                    data-sisa="{{ $sisa }}">
                                {{ $d->nama_divisi }} - 
                                @if($sisa > 0)
                                    (Sisa Kuota: {{ $sisa }}/{{ $d->kuota }})
                                @else
                                    (PENUH)
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('divisi_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    
                    <!-- Info Divisi yang dipilih -->
                    <div id="divisi-info" style="margin-top: 1rem; display: none;"></div>
                </div>

                <!-- TANGGAL MULAI DAN SELESAI -->
                <div class="form-row" style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label" for="tanggal_mulai">
                            <i class="fas fa-calendar-plus"></i> Tanggal Mulai Magang <span style="color: var(--danger);">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="tanggal_mulai"
                            name="tanggal_mulai" 
                            class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                            value="{{ old('tanggal_mulai', date('Y-m-d')) }}"
                            required
                        >
                        @error('tanggal_mulai')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="flex: 1;">
                        <label class="form-label" for="tanggal_selesai">
                            <i class="fas fa-calendar-minus"></i> Tanggal Selesai Magang <span style="color: var(--danger);">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="tanggal_selesai"
                            name="tanggal_selesai" 
                            class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                            value="{{ old('tanggal_selesai') }}"
                            required
                        >
                        @error('tanggal_selesai')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- INFO MASA MAGANG OTOMATIS -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calculator"></i> Masa Magang (Otomatis Terhitung)
                    </label>
                    <div style="background: rgba(13, 110, 253, 0.1); padding: 1rem; border-radius: 8px; border-left: 4px solid var(--primary);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <div>
                                <strong style="color: var(--primary);">Durasi:</strong>
                                <span id="masa-magang-text" style="font-size: 1.1rem; font-weight: 600; margin-left: 0.5rem;">-</span>
                            </div>
                            <div>
                                <strong style="color: var(--primary);">Status:</strong>
                                <span id="status-otomatis" class="badge" style="background: var(--success); margin-left: 0.5rem;">
                                    <i class="fas fa-check-circle"></i> Aktif
                                </span>
                            </div>
                        </div>
                        <small style="color: var(--gray); display: block;">
                            <i class="fas fa-info-circle"></i> Status akan otomatis berubah menjadi Nonaktif setelah tanggal selesai
                        </small>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem; padding-bottom: 1rem;">
                    <a href="{{ route('admin.mahasiswa.index') }}" 
                    class="btn btn-light" 
                    style="border: 1px solid #ccc; color: #333; display: inline-flex; align-items: center; padding: 0.5rem 1.5rem;">
                        <i class="fas fa-times" style="margin-right: 8px;"></i>
                        Batal
                    </a>
                    
                    <button type="submit" class="btn btn-primary" style="display: inline-flex; align-items: center; padding: 0.5rem 1.5rem;">
                        <i class="fas fa-save" style="margin-right: 8px;"></i>
                        Simpan Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Help Card -->
    <div class="card" style="margin-top: 2rem; background: var(--glass-bg); backdrop-filter: blur(10px); border: 1px solid var(--glass-border); color: white;">
        <div style="padding: 1.5rem;">
            <h4 style="margin-bottom: 1rem;">
                <i class="fas fa-info-circle"></i> Informasi Penting
            </h4>
            <ul style="line-height: 2; margin-left: 1.5rem;">
                <li><strong>Masa Magang Otomatis:</strong> Sistem akan menghitung durasi magang dari tanggal mulai dan selesai</li>
                <li><strong>Status Otomatis:</strong> Status akan berubah menjadi Nonaktif otomatis setelah tanggal selesai</li>
                <li><strong>Enkripsi AES-256:</strong> NIM, Email, dan No HP akan dienkripsi</li>
                <li><strong>Validasi Tanggal:</strong> Tanggal selesai harus setelah tanggal mulai</li>
            </ul>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Show divisi info when selected
    document.getElementById('divisi_id').addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        const infoDiv = document.getElementById('divisi-info');
        
        if (this.value) {
            const kuota = option.dataset.kuota;
            const terisi = option.dataset.terisi;
            const sisa = option.dataset.sisa;
            
            let statusColor = sisa > 2 ? 'var(--success)' : (sisa > 0 ? 'var(--warning)' : 'var(--danger)');
            
            infoDiv.innerHTML = `
                <div style="background: rgba(102, 126, 234, 0.1); padding: 1rem; border-radius: 10px; border-left: 4px solid var(--primary);">
                    <strong style="color: var(--primary);">${option.text.split(' - ')[0]}</strong>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-top: 0.75rem;">
                        <div>
                            <small style="color: var(--gray);">Total Kuota</small>
                            <div style="font-weight: 700; color: var(--dark);">${kuota}</div>
                        </div>
                        <div>
                            <small style="color: var(--gray);">Terisi</small>
                            <div style="font-weight: 700; color: var(--primary);">${terisi}</div>
                        </div>
                        <div>
                            <small style="color: var(--gray);">Sisa</small>
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

    // Fungsi untuk menghitung dan menampilkan masa magang otomatis
    function hitungMasaMagang() {
        const tanggalMulai = document.getElementById('tanggal_mulai').value;
        const tanggalSelesai = document.getElementById('tanggal_selesai').value;
        const masaMagangText = document.getElementById('masa-magang-text');
        const statusOtomatis = document.getElementById('status-otomatis');
        
        if (tanggalMulai && tanggalSelesai) {
            const tglMulai = new Date(tanggalMulai);
            const tglSelesai = new Date(tanggalSelesai);
            
            // Validasi: tanggal selesai harus setelah tanggal mulai
            if (tglSelesai <= tglMulai) {
                masaMagangText.textContent = 'Tanggal tidak valid!';
                masaMagangText.style.color = 'var(--danger)';
                statusOtomatis.innerHTML = '<i class="fas fa-times-circle"></i> Error';
                statusOtomatis.style.backgroundColor = 'var(--danger)';
                return;
            }
            
            // Hitung selisih hari
            const selisihMs = tglSelesai - tglMulai;
            const selisihHari = Math.floor(selisihMs / (1000 * 60 * 60 * 24));
            
            // Format durasi
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
            masaMagangText.style.color = 'var(--success)';
            
            // Update status otomatis berdasarkan tanggal selesai
            const sekarang = new Date();
            if (tglSelesai < sekarang) {
                // Jika sudah lewat tanggal selesai
                statusOtomatis.innerHTML = '<i class="fas fa-times-circle"></i> Nonaktif (Otomatis)';
                statusOtomatis.style.backgroundColor = 'var(--danger)';
            } else if (tglSelesai.toDateString() === sekarang.toDateString()) {
                // Jika hari ini adalah tanggal selesai
                statusOtomatis.innerHTML = '<i class="fas fa-clock"></i> Hari Terakhir';
                statusOtomatis.style.backgroundColor = 'var(--warning)';
            } else {
                // Jika masih aktif
                const sisaHari = Math.floor((tglSelesai - sekarang) / (1000 * 60 * 60 * 24));
                if (sisaHari <= 7) {
                    statusOtomatis.innerHTML = `<i class="fas fa-clock"></i> Sisa ${sisaHari} hari`;
                    statusOtomatis.style.backgroundColor = 'var(--warning)';
                } else {
                    statusOtomatis.innerHTML = '<i class="fas fa-check-circle"></i> Aktif';
                    statusOtomatis.style.backgroundColor = 'var(--success)';
                }
            }
        } else {
            masaMagangText.textContent = '-';
            masaMagangText.style.color = 'var(--gray)';
            statusOtomatis.innerHTML = '<i class="fas fa-info-circle"></i> Belum diatur';
            statusOtomatis.style.backgroundColor = 'var(--secondary)';
        }
    }

    // Event listeners untuk tanggal
    document.getElementById('tanggal_mulai').addEventListener('change', hitungMasaMagang);
    document.getElementById('tanggal_selesai').addEventListener('change', hitungMasaMagang);

    // Validasi form sebelum submit
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
            }
        }
    });

    // Hitung masa magang saat halaman load jika ada data
    if (document.getElementById('tanggal_mulai').value && document.getElementById('tanggal_selesai').value) {
        hitungMasaMagang();
    }
</script>
@endpush
@endsection