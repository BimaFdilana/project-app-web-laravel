@extends('layouts.app')
@section('title', 'Edit Ruangan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Ruangan</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Ruangan</label>
                                <input type="text" name="nama_ruangan" class="form-control"
                                    value="{{ $ruangan->nama_ruangan }}" required>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
