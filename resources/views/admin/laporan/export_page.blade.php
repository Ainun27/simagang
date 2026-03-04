@extends('layouts.app')

@section('title', 'Cetak Laporan')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm border-0 report-card">
                <div class="card-header bg-white pt-4 pb-2 border-0 text-center">
                    <div class="icon-circle mb-3">
                        <i class="fas fa-file-invoice text-primary"></i>
                    </div>
                    <h4 class="mb-1 font-weight-bold" style="color: #333;">Pengaturan Cetak Laporan</h4>
                    <p class="text-muted small px-4">Filter data mahasiswa magang sesuai kebutuhan untuk menghasilkan laporan yang akurat.</p>
                </div>

                <div class="card-body px-3 px-md-5 pb-5">
                    <form id="formExport" method="GET">
                        <div class="row">
                            <div class="col-12 form-group mb-4">
                                <label class="form-label-custom"><i class="fas fa-toggle-on mr-2"></i>Status Mahasiswa</label>
                                <select name="status" class="form-control custom-select-box">
                                    <option value="">Semua Status</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>

                            <div class="col-12 form-group mb-4">
                                <label class="form-label-custom"><i class="fas fa-briefcase mr-2"></i>Divisi Magang</label>
                                <select name="divisi_id" class="form-control custom-select-box">
                                    <option value="">Semua Divisi</option>
                                    @foreach($divisi as $d)
                                        <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 form-group mb-5">
                                <label class="form-label-custom"><i class="fas fa-calendar-alt mr-2"></i>Bulan</label>
                                <select name="bulan" class="form-control custom-select-box">
                                    <option value="">Semua</option>
                                    @foreach(range(1,12) as $m)
                                        <option value="{{ $m }}">{{ date('F', mktime(0,0,0,$m,1)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 form-group mb-5">
                                <label class="form-label-custom"><i class="fas fa-calendar-check mr-2"></i>Tahun</label>
                                <select name="tahun" class="form-control custom-select-box">
                                    <option value="">Semua</option>
                                    @foreach($tahun_list as $t)
                                        <option value="{{ $t }}">{{ $t }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-actions mt-2">
                            <button type="submit" onclick="setExportAction('excel')" class="btn btn-export btn-excel mb-3">
                                <i class="fas fa-file-excel mr-2"></i> Simpan Excel
                            </button>
                            <button type="submit" onclick="setExportAction('pdf')" class="btn btn-export btn-pdf mb-3">
                                <i class="fas fa-file-pdf mr-2"></i> Simpan PDF
                            </button>
                        </div>

                        <div class="text-center mt-4 border-top pt-4">
                            <a href="{{ route('admin.laporan.index') }}" class="btn btn-link text-muted btn-sm text-decoration-none">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Card Report Style */
    .report-card {
        border-radius: 20px;
        overflow: hidden;
    }

    /* Circle Icon */
    .icon-circle {
        width: 70px;
        height: 70px;
        background: rgba(78, 115, 223, 0.1);
        color: #4e73df;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 1.8rem;
    }

    /* Label & Selectbox */
    .form-label-custom {
        font-weight: 700;
        color: #4e5e7a;
        font-size: 0.85rem;
        margin-bottom: 0.6rem;
        display: block;
    }

    .custom-select-box {
        border-radius: 12px !important;
        border: 1.5px solid #e3e6f0 !important;
        padding: 0.6rem 1rem !important;
        height: auto !important;
        font-size: 0.95rem;
        color: #6e707e;
        transition: all 0.2s ease-in-out;
    }

    .custom-select-box:focus {
        border-color: #4e73df !important;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1) !important;
        color: #333;
    }

    /* Buttons Style */
    .form-actions {
        display: flex;
        flex-direction: column;
    }

    .btn-export {
        padding: 0.8rem;
        border-radius: 12px;
        font-weight: 700;
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff !important;
    }

    .btn-export:active {
        transform: scale(0.98);
    }

    .btn-excel {
        background: linear-gradient(135deg, #28a745, #1e7e34);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25);
    }

    .btn-pdf {
        background: linear-gradient(135deg, #e74a3b, #be2617);
        box-shadow: 0 4px 12px rgba(231, 74, 59, 0.25);
    }

    /* Responsivitas Desktop */
    @media (min-width: 768px) {
        .form-actions {
            flex-direction: row;
            gap: 15px;
        }
        .btn-export {
            flex: 1;
            margin-bottom: 0 !important;
        }
    }
</style>
@endpush

<script>
    function setExportAction(type) {
        const form = document.getElementById('formExport');
        if (type === 'excel') {
            form.action = "{{ route('admin.laporan.export.excel') }}";
        } else {
            form.action = "{{ route('admin.laporan.export.pdf') }}";
        }
    }
</script>
@endsection