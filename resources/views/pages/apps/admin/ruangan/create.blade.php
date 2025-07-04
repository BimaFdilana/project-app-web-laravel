@extends('layouts.app')
@section('title', 'Tambah Ruangan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Ruangan</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('ruangan.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Ruangan</label>
                                <input type="text" name="nama_ruangan" class="form-control" required>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
