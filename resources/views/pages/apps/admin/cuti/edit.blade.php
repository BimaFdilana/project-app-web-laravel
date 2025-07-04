@extends('layouts.app')

@section('title', 'Edit Data Cuti')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Cuti</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('cuti.index') }}">Data Cuti</a></div>
                    <div class="breadcrumb-item">Edit</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="{{ route('cuti.update', $cuti->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Formulir</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" value="{{ $cuti->nama }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Ruangan / Departemen</label>
                                <input type="text" class="form-control" name="ruangan" value="{{ $cuti->ruangan }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mulai Cuti</label>
                                <input type="date" class="form-control" name="tanggal_cuti"
                                    value="{{ $cuti->tanggal_cuti->format('Y-m-d') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Hari Cuti</label>
                                <input type="number" class="form-control" name="jumlah_cuti" min="1"
                                    value="{{ $cuti->jumlah_cuti }}" required>
                            </div>
                            <div class="form-group">
                                <label>Keperluan Cuti</label>
                                <textarea class="form-control" name="keperluan_cuti" rows="3" required>{{ $cuti->keperluan_cuti }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan" rows="2">{{ $cuti->keterangan }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('cuti.index') }}" class="btn btn-secondary">Batal</a>
                            <button class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
