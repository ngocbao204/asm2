@extends('user.layout.master')
@section('content')
    <section class="detail">
        <h1 class="mt-3">Chi tiết sản phẩm</h1>
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div>
                    <img src="{{ \Storage::url($detail->image) }}" width="50%" alt="{{ $detail->name_product }}">
                </div>
                <h5>Mô tả sản phẩm</h5>
                <p>{{ $detail->description }}</p>
            </div>
            <div class="col-lg-5">
                <h2 class="mb-2">{{ $detail->name_product }}</h2>
                <hr>
                <div>
                    <i class="fa-solid fa-fire text-danger"></i> Mua ngay với giá
                </div>
                <div class="d-flex gap-3">
                    <span class="text-danger fw-medium">{{ number_format($detail->price_new) }} <sup>đ</sup></span>
                    <span>
                        <del class="text-secondary">{{ number_format($detail->price_old) }}</del><sup>đ</sup>
                        <span class="bg-danger mx-2 px-2 text-white rounded">-6%</span>
                    </span>
                </div>
                <div class="my-4">
                    Quà tặng lên tới 500.000 <sup>đ</sup>
                </div>
                <div>
                    <img src="{{ asset('assets/image/tragop.webp') }}" alt="Trả góp" width="400px" height="70px">
                </div>
                <div class="d-flex gap-4 mt-4">
                    <button class="btn btn-danger">Mua ngay</button>
                    <input type="hidden" class="soluong" value="1">
                    <a class="themvaogio btn btn-dark" data-product-id="{{ $detail->id }}" data-soluong="1">
                        Thêm vào giỏ hàng
                    </a>
                </div>
            </div>
        </div>
        <h3 class="mt-5">Các sản phẩm khác</h3>
        <div class="row">
            @foreach ($show as $item)
                <div class="col-md-3">
                    <div class="p-2 shadow m-3 rounded">
                        <div class="mb-3">
                            <img src="{{ \Storage::url($item->image) }}" class="w-100" alt="{{ $item->name_product }}">
                        </div>
                        <div class="mx-3">
                            <a href="{{ route('show', $item->id) }}" class="text-decoration-none text-black fw-medium">
                                {{ $item->name_product }}
                            </a>
                            <div class="d-flex justify-content-between mt-4">
                                <span class="text-danger fw-bold">{{ number_format($item->price_new) }}đ</span>
                                <span><del>{{ number_format($item->price_old) }}đ</del></span>
                            </div>
                            <div class="text-warning d-flex gap-2 my-3">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </div>
                            <hr>
                            <div class="d-flex gap-2">
                                @foreach (['Zalopay-1693187470025.jpeg', 'Vnapy-1693370130549.jpeg', 'visa.jpg'] as $image)
                                    <div class="border p-1 border-black rounded">
                                        <img src="{{ asset('assets/image/' . $image) }}" width="20"
                                            alt="Payment method">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const allThemVaoGios = document.querySelectorAll('.themvaogio');
            allThemVaoGios.forEach(bt => {
                bt.addEventListener('click', (e) => {
                    e.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a

                    // Gửi dữ liệu sản phẩm đến server
                    axios.post("{{ route('themVaoGiohang') }}", {
                            sanpham_id: bt.dataset.productId,
                            soluong: bt.dataset.soluong
                        })
                        .then(response => {
                            // Kiểm tra dữ liệu trả về
                            if (response.data.tongsoluong !== undefined) {
                                // Cập nhật số lượng trong giỏ hàng
                                document.querySelector('#tongsoluong').innerText = response.data
                                    .tongsoluong;
                            }
                            alert('Sản phẩm đã được thêm vào giỏ hàng!');
                        })
                        .catch(error => {
                            console.error('Có lỗi xảy ra:', error);
                        });
                });
            });
        });
    </script>
@endpush
