<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <!-- <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" /> -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="{{route('home')}}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{asset('assets/image/logo.png')}}" width="180px" alt="" height="150px">
                                </a>
                                <p class="text-center fw-bold fs-5">Đăng nhập</p>
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Tài khoản</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" >

                                        @error('email')
                                            <span style="color:red;"> {{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                                        @error('password')
                                        <span style="color:red;"> {{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Lưu tài khoản
                                            </label>
                                        </div>
                                        <a class="text-primary fw-bold" href="./index.html">Quên mật khẩu ?</a>
                                    </div>
                                    <button href="" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Đăng nhập</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Bạn chưa có tài khoản?</p>
                                        <a class="text-primary fw-bold ms-2" href="{{route('register')}}">Đăng kí ngay</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
