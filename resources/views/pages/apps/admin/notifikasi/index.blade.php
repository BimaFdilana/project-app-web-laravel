@extends('layouts.app')

@section('title', 'Semua Notifikasi')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Semua Notifikasi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Notifikasi</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Daftar Notifikasi</h4>
                                <form action="{{ route('notifications.markAsRead') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Tandai Semua Dibaca</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled list-unstyled-border">
                                    @forelse ($notifications as $notification)
                                        <li class="media {{ !$notification->read_at ? 'bg-light p-3 rounded' : 'p-3' }}">
                                            <div class="media-body">
                                                <div class="float-right text-primary">
                                                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                                                </div>
                                                <div
                                                    class="media-title {{ !$notification->read_at ? 'font-weight-bold' : '' }}">
                                                    <i class="fas fa-user-clock text-info"></i>
                                                    {{ $notification->data['title'] }}
                                                </div>
                                                <span class="text-small text-muted">
                                                    Notifikasi untuk pengajuan cuti a.n.
                                                    <strong>{{ $notification->data['user'] }}</strong>.
                                                </span>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="media p-3">
                                            <p class="text-center w-100 my-2">Tidak ada notifikasi.</p>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="card-footer text-right">
                                {{ $notifications->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
