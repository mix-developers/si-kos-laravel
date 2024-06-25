<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <a href="index.html" class="logo m-0 float-start">{{ env('APP_NAME') }}</a>

                <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                    <li class="{{ request()->is('/') ? 'active' : '' }}">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="{{ request()->is('cari-kos') ? 'active' : '' }}">
                        <a href="{{ url('/cari-kos') }}">Cari
                            KOS</a>
                    </li>
                    <li class="{{ request()->is('semua-kos') ? 'active' : '' }}">
                        <a href="{{ url('/semua-kos') }}">Semua KOS</a>
                    </li>
                    @guest
                        <li><a href="{{ route('login') }}">Masuk</a></li>
                        <li><a href="{{ route('register') }}">Daftar</a></li>
                    @else
                        @if (Auth::user()->role == 'User')
                            <li><a href="{{ route('home') }}">Akun</a></li>
                        @else
                            <li><a href="{{ route('home') }}">Dashboard</a></li>
                        @endif
                    @endguest
                </ul>
                <a href="#"
                    class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
                    data-toggle="collapse" data-target="#main-navbar">
                    <span></span>
                </a>
            </div>
        </div>
    </div>
</nav>
