@extends('layouts.app')

@section('title', 'Formulir Pengajuan Cuti')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Formulir Pengajuan Cuti</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('cuti.index') }}">Data Cuti</a></div>
                    <div class="breadcrumb-item">Ajukan Cuti</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="{{ route('cuti.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Formulir Pengajuan</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label>Ruangan / Departemen</label>
                                <select name="ruangan" class="form-control" required>
                                    <option value="">-- Pilih Ruangan --</option>
                                    @foreach ($ruangans as $ruangan)
                                        <option value="{{ $ruangan->nama_ruangan }}">{{ $ruangan->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mulai Cuti</label>
                                <input type="date" class="form-control" name="tanggal_cuti" required>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Hari Cuti</label>
                                <input type="number" class="form-control" name="jumlah_cuti" min="1" required>
                            </div>
                            <div class="form-group">
                                <label>Keperluan Cuti</label>
                                <textarea class="form-control" name="keperluan_cuti" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('cuti.index') }}" class="btn btn-secondary">Batal</a>
                            <button class="btn btn-primary">Ajukan</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
