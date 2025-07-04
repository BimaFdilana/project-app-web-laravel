@extends('layouts.app')

@section('title', 'Daftar Pengajuan Cuti')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Cuti</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Cuti</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Data Cuti Karyawan</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('cuti.index') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nama Karyawan</label>
                                                <input type="text" class="form-control" name="nama"
                                                    value="{{ request('nama') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Bulan</label>
                                                <select name="bulan" class="form-control">
                                                    <option value="">Semua Bulan</option>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ request('bulan') == $i ? 'selected' : '' }}>
                                                            {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tahun</label>
                                                <select name="tahun" class="form-control">
                                                    <option value="">Semua Tahun</option>
                                                    @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                                                        <option value="{{ $i }}"
                                                            {{ request('tahun') == $i ? 'selected' : '' }}>
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                                <a href="{{ route('cuti.index') }}" class="btn btn-secondary">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <a href="{{ route('cuti.create') }}" class="btn btn-primary">Tambah Data Cuti</a>
                                <a href="{{ route('cuti.export', request()->query()) }}" class="btn btn-success ml-2">
                                    <i class="fa fa-file-excel"></i> Export ke Excel
                                </a>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama & Ruangan</th>
                                                <th>Tanggal & Progres</th>
                                                <th>Jumlah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($cutis as $cuti)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div><b>{{ $cuti->nama }}</b></div>
                                                        <div class="text-muted">{{ $cuti->ruangan }}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{ $cuti->tanggal_cuti->format('d M Y') }} -
                                                            {{ $cuti->tanggal_akhir_cuti->format('d M Y') }}</div>
                                                        @php
                                                            $persentase = $cuti->progres_persentase;
                                                            $colorClass = 'bg-secondary';
                                                            if ($persentase > 0) {
                                                                $colorClass = 'bg-danger';
                                                                if ($persentase >= 34 && $persentase < 67) {
                                                                    $colorClass = 'bg-warning';
                                                                } elseif ($persentase >= 67) {
                                                                    $colorClass = 'bg-success';
                                                                }
                                                            }
                                                        @endphp
                                                        <div class="progress mt-1" data-height="6" data-toggle="tooltip"
                                                            title="{{ $persentase > 0 ? $persentase . '% Selesai' : 'Belum Dimulai' }}">
                                                            <div class="progress-bar {{ $colorClass }}"
                                                                role="progressbar" style="width: {{ $persentase }}%;"
                                                                aria-valuenow="{{ $persentase }}" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $cuti->jumlah_cuti }} hari</td>
                                                    <td>
                                                        <a href="{{ route('cuti.edit', $cuti->id) }}"
                                                            class="btn btn-sm btn-warning">Edit</a>
                                                        <form action="{{ route('cuti.destroy', $cuti->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
