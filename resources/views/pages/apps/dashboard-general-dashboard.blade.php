@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Laboratorium</h4>
                            </div>
                            <div class="card-body">
                                10
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Lab Tersedia</h4>
                            </div>
                            <div class="card-body">
                                42
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Lab Tidak Tersedia</h4>
                            </div>
                            <div class="card-body">
                                22
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total User</h4>
                            </div>
                            <div class="card-body">
                                47
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Laboratorium</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>Nama Lab</th>
                                            <th>Kapasitas</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            // Simulasi data labs. Dalam aplikasi nyata, ini dari database.
                                            $current_user_role_id = Auth::user()->role_id ?? 1; // Ubah ke 1 untuk menguji sebagai admin

                                            // Contoh data lab dengan ID (penting untuk tindakan nyata)
                                            $labs = [
                                                [
                                                    'id' => 1,
                                                    'name' => 'Lab Komputer Dasar 1',
                                                    'capacity' => '30 Orang',
                                                    'status' => 'Tersedia',
                                                ],
                                                [
                                                    'id' => 2,
                                                    'name' => 'Lab Jaringan Komputer',
                                                    'capacity' => '25 Orang',
                                                    'status' => 'Sedang Digunakan',
                                                ],
                                                [
                                                    'id' => 3,
                                                    'name' => 'Lab Multimedia Kreatif',
                                                    'capacity' => '20 Orang',
                                                    'status' => 'Tidak Tersedia',
                                                ],
                                                [
                                                    'id' => 4,
                                                    'name' => 'Lab Riset Data',
                                                    'capacity' => '15 Orang',
                                                    'status' => 'Tersedia',
                                                ],
                                                [
                                                    'id' => 5,
                                                    'name' => 'Lab Robotika dan AI',
                                                    'capacity' => '10 Orang',
                                                    'status' => 'Sedang Pemeliharaan',
                                                ],
                                                [
                                                    'id' => 6,
                                                    'name' => 'Lab Bahasa Komputer',
                                                    'capacity' => '30 Orang',
                                                    'status' => 'Tersedia',
                                                ],
                                            ];
                                        @endphp

                                        @foreach ($labs as $lab)
                                            <tr>
                                                <td>{{ $lab['name'] }}</td>
                                                <td>{{ $lab['capacity'] }}</td>
                                                <td>
                                                    @if ($lab['status'] == 'Tersedia')
                                                        <div class="badge badge-success">{{ $lab['status'] }}</div>
                                                    @elseif ($lab['status'] == 'Sedang Digunakan' || $lab['status'] == 'Sedang Pemeliharaan')
                                                        <div class="badge badge-warning">{{ $lab['status'] }}</div>
                                                    @else
                                                        <div class="badge badge-danger">{{ $lab['status'] }}</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($current_user_role_id == 1)
                                                        {{-- Jika pengguna adalah Admin --}}
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                                id="dropdownMenuButton-{{ $lab['id'] }}"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Aksi
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton-{{ $lab['id'] }}">
                                                                <h6 class="dropdown-header">Ganti Status</h6>
                                                                {{-- Link ini perlu diarahkan ke route yang mengupdate status di backend Anda --}}
                                                                <a class="dropdown-item"
                                                                    href="{{ url('/labs/update-status/' . $lab['id'] . '/Tersedia') }}">Tersedia</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('/labs/update-status/' . $lab['id'] . '/Sedang Digunakan') }}">Sedang
                                                                    Digunakan</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('/labs/update-status/' . $lab['id'] . '/Tidak Tersedia') }}">Tidak
                                                                    Tersedia</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('/labs/update-status/' . $lab['id'] . '/Sedang Pemeliharaan') }}">Sedang
                                                                    Pemeliharaan</a>
                                                                <div class="dropdown-divider"></div>
                                                                {{-- Tombol Delete --}}
                                                                <a class="dropdown-item text-danger" href="#"
                                                                    data-confirm="Apakah Anda Yakin?|Tindakan ini tidak dapat dibatalkan. Lanjutkan?"
                                                                    data-confirm-yes="alert('Lab ID {{ $lab['id'] }} Dihapus')"
                                                                    {{-- Dalam aplikasi nyata, ini akan memicu penghapusan melalui form atau AJAX --}}>Hapus Lab</a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        {{-- Jika pengguna bukan Admin --}}
                                                        @if ($lab['status'] == 'Tersedia')
                                                            <a href="{{ url('/labs/pinjam/' . $lab['id']) }}"
                                                                class="btn btn-info btn-action" data-toggle="tooltip"
                                                                title="Pinjam">
                                                                Pinjam
                                                            </a>
                                                        @else
                                                            <button class="btn btn-secondary btn-action" disabled
                                                                data-toggle="tooltip" title="Tidak dapat dipinjam">
                                                                Tidak Tersedia
                                                            </button>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
