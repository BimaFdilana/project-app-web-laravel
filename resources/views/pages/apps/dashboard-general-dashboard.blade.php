@extends('layouts.app')

@section('title', 'Dashboard Utama')

@push('style')
    <style>
        .card-full-height {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-full-height .card-body {
            flex-grow: 1;
            overflow-y: auto;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
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
                                {{ $sedangCutiCount }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-calendar-check"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Cuti Terdaftar</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCutiCount }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Karyawan</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalKaryawanCount }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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
                                            <th>Tanggal</th>
                                            <th>Progres</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cutiTerbaru as $cuti)
                                            <tr>
                                                <td>{{ $cuti->nama }}</td>
                                                <td>{{ $cuti->tanggal_cuti->format('d M') }} -
                                                    {{ $cuti->tanggal_akhir_cuti->format('d M Y') }}</td>

                                                {{-- ============================================= --}}
                                                {{-- KODE PROGRESS BAR DITAMBAHKAN DI SINI --}}
                                                {{-- ============================================= --}}
                                                <td>
                                                    @php
                                                        $persentase = $cuti->progres_persentase;
                                                        $colorClass = 'bg-secondary'; // Warna default Abu-abu

                                                        if ($persentase > 0) {
                                                            // Hanya ubah warna jika progres sudah berjalan
                                                            $colorClass = 'bg-danger'; // Merah
                                                            if ($persentase >= 34 && $persentase < 67) {
                                                                $colorClass = 'bg-warning'; // Kuning
                                                            } elseif ($persentase >= 67) {
                                                                $colorClass = 'bg-success'; // Hijau
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="progress" data-height="8" data-toggle="tooltip"
                                                        title="{{ $persentase > 0 ? $persentase . '% Selesai' : 'Belum Dimulai' }}">
                                                        <div class="progress-bar {{ $colorClass }}" role="progressbar"
                                                            style="width: {{ $persentase }}%;"
                                                            aria-valuenow="{{ $persentase }}" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada pengajuan cuti terbaru.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('cuti.index') }}" class="btn btn-primary">Lihat Semua Pengajuan</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card card-full-height">
                        <div class="card-header">
                            <h4>Notifikasi Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @forelse ($notifikasiTerbaru as $notification)
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="float-right text-primary">
                                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                            <div class="media-title">{{ $notification->data['title'] }}</div>
                                            <span class="text-small text-muted">Oleh:
                                                <b>{{ $notification->data['user'] }}</b></span>
                                        </div>
                                    </li>
                                @empty
                                    <li class="media">
                                        <p class="text-center w-100">Tidak ada notifikasi terbaru.</p>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="card-footer text-center pt-1 pb-1">
                            <a href="{{ route('notifications.index') }}" class="btn btn-primary btn-lg btn-round">
                                Lihat Semua Notifikasi
                            </a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    {{-- (Script Anda yang sudah ada tidak perlu diubah) --}}
@endpush
