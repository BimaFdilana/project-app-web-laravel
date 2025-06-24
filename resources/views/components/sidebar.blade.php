<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        @if (Auth::user()->role_id == 1)
            <div class="sidebar-brand">
                <a href="">Admin Page</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="">AP</a>
            </div>
        @else
            <div class="sidebar-brand">
                <a href="">User Page</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="">UP</a>
            </div>
        @endif
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-house">
                    </i> <span>Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->role_id == 1)
                <li class="{{ Request::is('list-mahasiswa') ? 'active' : '' }}"> {{-- Ganti 'home' jika route List Mahasiswa punya nama lain --}}
                    <a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-user-graduate">
                        </i> <span>List Mahasiswa</span>
                    </a>
                </li>
            @endif
            <li class="menu-header">Laboratorium</li>
            {{-- PERUBAHAN DI SINI --}}
            <li class="{{ Request::is('labors*') ? 'active' : '' }}"> {{-- Menggunakan 'labors*' agar aktif untuk semua route di bawah /labors --}}
                <a class="nav-link" href="{{ route('labors.index') }}"><i class="fa-solid fa-school">
                    </i> <span>List Laboratorium</span>
                </a>
            </li>
            <li class="{{ Request::is('list-peminjaman') ? 'active' : '' }}"> {{-- Ganti 'home' jika route List Peminjaman punya nama lain --}}
                <a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-calendar">
                    </i> <span>List Peminjaman</span>
                </a>
            </li>
            @if (Auth::user()->role_id == 1)
                <li class="{{ Request::is('verifikasi-peminjaman') ? 'active' : '' }}"> {{-- Ganti 'home' jika route Verifikasi Peminjaman punya nama lain --}}
                    <a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-circle-check">
                        </i> <span>Verifikasi Peminjaman</span>
                    </a>
                </li>
            @endif
        </ul>
    </aside>
</div>
