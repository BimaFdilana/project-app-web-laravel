@extends('layouts.app')
@section('title', 'Data Ruangan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Ruangan/Bagian</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <a href="{{ route('ruangan.create') }}" class="btn btn-primary">Tambah Ruangan Baru</a>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Ruangan/Bagian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ruangans as $key => $ruangan)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $ruangan->nama_ruangan }}</td>
                                                <td>
                                                    <a href="{{ route('ruangan.edit', $ruangan->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('ruangan.destroy', $ruangan->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin?');">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
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
