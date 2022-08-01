<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="{{ asset('frontend') }}/img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href="{{ url('/') }}">home</a></li>
                                        <li><a class="" href="{{ url('/paket-travel') }}">Paket Travel</a></li>
                                        @auth
                                            <li><a href="#">Halo, {{ Auth::user()->name }}<i
                                                        class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('profile.index') }}">Profil</a></li>
                                                    <li><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
                                                    <li><a href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                      document.getElementById('logout-form').submit();">Logout</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        @endauth
                                        {{-- <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="single-blog.html">single-blog</a></li>
                                            </ul>
                                        </li> --}}

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 d-none d-lg-block">
                            <div class="social_wrap d-flex align-items-center justify-content-end">
                                {{-- <div class="number">
                                    <p> <i class="fa fa-phone"></i> 10(256)-928 256</p>
                                </div> --}}
                                @guest
                                    <div class="social_links d-none d-xl-block">
                                        <ul>
                                            <li><a href="{{ route('login') }}" class="btn btn-primary text-white">Masuk</a>
                                            </li>
                                            <li><a href="{{ route('register') }}" class="btn btn-info text-white">Daftar
                                                    Akun</a></li>

                                        </ul>
                                    </div>
                                @endguest
                            </div>
                        </div>
                        {{-- <div class="seach_icon">
                            <a data-toggle="modal" data-target="#exampleModalCenter" href="#">
                                <i class="fa fa-search"></i>
                            </a>
                        </div> --}}
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
