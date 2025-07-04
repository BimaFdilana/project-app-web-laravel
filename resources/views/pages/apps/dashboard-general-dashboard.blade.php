@extends('layouts.app')

@section('title', 'Dashboard Utama')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    {{-- CSS Kustom untuk membuat kartu setinggi kolom --}}
    <style>
        .card-full-height {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-full-height .card-body {
            flex-grow: 1;
            overflow-y: auto;
            /* Tambahkan scroll jika konten terlalu panjang */
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>

            {{-- Baris untuk Kartu Statistik Ringkas --}}
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Karyawan Sedang Cuti</h4>
                            </div>
                            <div class="card-body">
                                {{-- Ganti dengan data dinamis dari controller --}}
                                12
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengajuan Menunggu</h4>
                            </div>
                            <div class="card-body">
                                {{-- Ganti dengan data dinamis dari controller --}}
                                5
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Karyawan</h4>
                            </div>
                            <div class="card-body">
                                {{-- Ganti dengan data dinamis dari controller --}}
                                85
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Baris untuk Konten Utama dan Sidebar Notifikasi --}}
            <div class="row">
                {{-- Kolom Konten Utama: Tabel Pengajuan Cuti --}}
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pengajuan Cuti Terbaru</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                        <tr>
                                            <th>Nama Karyawan</th>
                                            <th>Jenis Cuti</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- DATA CONTOH: Ganti dengan loop data dari controller --}}
                                        <tr>
                                            <td>Budi Santoso</td>
                                            <td>Cuti Tahunan</td>
                                            <td>10 Jul 2025 - 12 Jul 2025</td>
                                            <td>
                                                <div class="badge badge-warning">Menunggu</div>
                                            </td>
                                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                        </tr>
                                        <tr>
                                            <td>Sinta Dewi</td>
                                            <td>Cuti Sakit</td>
                                            <td>01 Jul 2025 - 02 Jul 2025</td>
                                            <td>
                                                <div class="badge badge-success">Disetujui</div>
                                            </td>
                                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                        </tr>
                                        <tr>
                                            <td>Ahmad Fauzi</td>
                                            <td>Cuti Tahunan</td>
                                            <td>20 Jul 2025 - 25 Jul 2025</td>
                                            <td>
                                                <div class="badge badge-success">Disetujui</div>
                                            </td>
                                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                        </tr>
                                        <tr>
                                            <td>Rina Marlina</td>
                                            <td>Cuti Melahirkan</td>
                                            <td>01 Agu 2025 - 31 Okt 2025</td>
                                            <td>
                                                <div class="badge badge-info">Sedang Berlangsung</div>
                                            </td>
                                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                        </tr>
                                        <tr>
                                            <td>Joko Susilo</td>
                                            <td>Cuti Tahunan</td>
                                            <td>15 Jul 2025 - 15 Jul 2025</td>
                                            <td>
                                                <div class="badge badge-danger">Ditolak</div>
                                            </td>
                                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                        </tr>
                                        <tr>
                                            <td>Joko Susilo</td>
                                            <td>Cuti Tahunan</td>
                                            <td>15 Jul 2025 - 15 Jul 2025</td>
                                            <td>
                                                <div class="badge badge-danger">Ditolak</div>
                                            </td>
                                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="#" class="btn btn-primary">Lihat Semua Pengajuan</a>
                        </div>
                    </div>
                </div>

                {{-- Kolom Sidebar: Notifikasi Aktivitas Cuti --}}
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card card-full-height">
                        <div class="card-header">
                            <h4>Notifikasi Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                {{-- DATA CONTOH: Ganti dengan loop notifikasi dari controller --}}
                                <li class="media">
                                    <div class="media-body">
                                        <div class="float-right text-primary">Baru saja</div>
                                        <div class="media-title">Pengajuan Baru</div>
                                        <span class="text-small text-muted"><b>Budi Santoso</b> mengajukan Cuti
                                            Tahunan.</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="float-right">Besok</div>
                                        <div class="media-title text-warning">Cuti Akan Berakhir</div>
                                        <span class="text-small text-muted">Cuti Sakit <b>Sinta Dewi</b> akan berakhir
                                            besok.</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="float-right">1 jam lalu</div>
                                        <div class="media-title">Persetujuan Cuti</div>
                                        <span class="text-small text-muted">Anda menyetujui Cuti Sakit untuk <b>Sinta
                                                Dewi</b>.</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="float-right text-info">3 hari lagi</div>
                                        <div class="media-title">Cuti Akan Dimulai</div>
                                        <span class="text-small text-muted"><b>Ahmad Fauzi</b> akan memulai cuti pada 20
                                            Juli 2025.</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="float-right">2 jam lalu</div>
                                        <div class="media-title">Penolakan Cuti</div>
                                        <span class="text-small text-muted">Anda menolak pengajuan cuti <b>Joko
                                                Susilo</b>.</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer text-center pt-1 pb-1">
                            <a href="#" class="btn btn-primary btn-lg btn-round">
                                Lihat Semua Notifikasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
