<header>
    <nav class="navbar navbar-expand-lg bg-body-secondary">
        <div class="container-fluid">
            <div>
                <a href="{{ route('home') }}"><img src="{{ asset('assets/image/logo.png') }}" alt="" width="100px"
                        height="60px"></a>
            </div>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                @php
                    $tongsoluong = 0;
                @endphp
                @if (session('cart'))
                    @foreach (session('cart') as $item)
                        @php
                            $tongsoluong += $item['soluong'];
                        @endphp
                    @endforeach
                @endif
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-5">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Liên hệ</a>
                    </li>

                    <form class="d-flex  " style="margin-left: 150px;" role="search">
                        <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </ul>
            </div>
            <div class="d-flex gap-4 align-items-center">
                <div style="position: relative; display: inline-block;">
                    <a href="{{ route('cart.index') }}" style="position: relative; display: inline-block;">
                        <i class="fa-solid fa-cart-shopping" style="font-size: 22px; color: black;"></i>
                        <div
                            style="position: absolute; top: -10px; right: -10px; background-color: red; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                            <span id="tongsoluong" style="color: white; font-size: 12px;">{{ $tongsoluong }}</span>
                        </div>
                    </a>
                </div>

                @if (Auth::user())
                    <div class="dropdown">
                        <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span>Helo,{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Thông tin tài khoản</a></li>
                            @if (Auth::user()->type == 'admin')
                                <li><a class="dropdown-item" href="{{ url('/admin') }}">Trang quản trị</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>
                        </ul>
                    </div>
                @else
                    <div class="me-5">

                        <a href="{{ route('login') }}"><i class="fa-solid fa-user "
                                style="font-size: 22px; margin-left: 10px;color:black"></i></a>

                    </div>
                @endif
            </div>
        </div>
    </nav>
</header>
