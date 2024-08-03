@extends('user.layout.master')

@section('content')
    @include('user.layout.banner')

    <div>
        <h1>Sản phẩm sale</h1>
        <div>
            <div class="row">
                @foreach ($show as $item)
                    <div class="col-md-3">
                        <div class="p-2 shadow m-3 rounded">
                            <div class="mb-3">
                                <img src="{{ Storage::url($item->image) }}" class="w-100" alt="">
                            </div>
                            <div class="mx-3">
                                <a href="{{ route('show', $item->id) }}"
                                    class="text-decoration-none text-black fw-medium ">{{ $item->name_product }}</a>
                                <div class="d-flex justify-content-between mt-4">
                                    <span class="text-danger fw-bold">{{ number_format($item->price_new) }}đ</span>
                                    <span><del>{{ number_format($item->price_old) }}đ</del></span>
                                </div>
                                <div class="text-warning d-flex gap-2 my-3">
                                    <li style="  list-style: none;"><i class="fa-solid fa-star"></i></li>
                                    <li style="  list-style: none;"><i class="fa-solid fa-star"></i></li>
                                    <li style="  list-style: none;"><i class="fa-solid fa-star"></i></li>
                                    <li style="  list-style: none;"><i class="fa-solid fa-star"></i></li>
                                    <li style="  list-style: none;"><i class="fa-solid fa-star"></i></li>
                                </div>
                                <hr>
                                <div class="d-flex gap-2">
                                    <div class="border p-1 border-black rounded">
                                        <img src="{{ asset('assets/image/Zalopay-1693187470025.jpeg') }}" width="20"
                                            alt="">
                                    </div>

                                    <div class="border p-1 border-black rounded">
                                        <img src="{{ asset('assets/image/Vnapy-1693370130549.jpeg') }}" width="20"
                                            alt="">
                                    </div>

                                    <div class="border p-1 border-black rounded">
                                        <img src="{{ asset('assets/image/visa.jpg') }}" width="20" alt="">
                                    </div>

                                    <div class="border p-1 border-black rounded">
                                        <img src="{{ asset('assets/image/Zalopay-1693187470025.jpeg') }}" width="20"
                                            alt="">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
