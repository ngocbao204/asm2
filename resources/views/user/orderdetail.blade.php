@extends('user.layout.master')
@section('content')

    <h1 class="mt-3">Chi tiết đơn hàng</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('order'))
        <div class="order-details">
            <h2>Thông tin khách hàng</h2>
            <p><strong>Tên:</strong> {{ session('order.details.name') }}</p>
            <p><strong>Địa chỉ:</strong> {{ session('order.details.address') }}</p>
            <p><strong>Số điện thoại:</strong> {{ session('order.details.phone') }}</p>

            <h2>Sản phẩm đã đặt</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Số thứ tự</th>
                        <th>Tên</th>
                        <th>Ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach (session('order.cart') as $id => $sanpham)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sanpham['name'] }}</td>
                            <td>
                                @if (!empty($sanpham['image']))
                                    <img src="{{ \Storage::url($sanpham['image']) }}" width="100"
                                        alt="{{ $sanpham['name'] }}">
                                @else
                                    Chưa có
                                @endif
                            </td>
                            <td>{{ number_format($sanpham['gia']) }} <sup>đ</sup></td>
                            <td>{{ $sanpham['soluong'] }}</td>
                            <td>{{ number_format($sanpham['gia'] * $sanpham['soluong']) }} <sup>đ</sup></td>
                        </tr>
                        @php
                            $total += $sanpham['gia'] * $sanpham['soluong'];
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end">Tổng cộng:</td>
                        <td>{{ number_format($total) }} <sup>đ</sup></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @else
        <p>Không có đơn hàng nào.</p>
    @endif

@endsection
