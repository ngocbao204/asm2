@extends('user.layout.master')
@section('content')

<h1 class="mt-3">Thanh toán</h1>


<form action="{{ route('order.store') }}" method="POST">
    @csrf
    <h2>Thông tin người mua hàng</h2>
    <div class="form-group">
        <label for="name">Họ và tên</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="phone">Số điện thoại</label>
        <input type="text" name="phone" id="phone" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="address">Địa chỉ giao hàng</label>
        <input type="text" name="address" id="address" class="form-control" required>
    </div>

    <h2 class="mt-3">Đơn hàng của bạn</h2>
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
            @foreach ($cart as $id => $sanpham)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sanpham['name'] }}</td>
                    <td>
                        @if (!empty($sanpham['image']))
                            <img src="{{ \Storage::url($sanpham['image']) }}" width="100" alt="{{ $sanpham['name'] }}">
                        @else
                            Chưa có
                        @endif
                    </td>
                    <td>{{ number_format($sanpham['gia']) }} <sup>đ</sup></td>
                    <td>{{ $sanpham['soluong'] }}</td>
                    <td>{{ number_format($sanpham['gia'] * $sanpham['soluong']) }} <sup>đ</sup></td>
                    @php
                        $total += $sanpham['gia'] * $sanpham['soluong'];
                    @endphp
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-end">Tổng cộng:</td>
                <td>{{ number_format($total) }} <sup>đ</sup></td>
            </tr>
        </tfoot>
    </table>

    <button type="submit" class="btn btn-danger">Đặt hàng</button>
</form>

@endsection
