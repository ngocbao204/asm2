{{-- @extends('user.layout.master')
@section('content')

    <h1 class="mt-3">Giỏ hàng của bạn</h1>
    <form action="{{ route('order.index') }}" method="POST">
        @csrf
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Số thứ tự</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                @php
                    $total = 0;
                @endphp
                @if (session('cart'))
                    @foreach (session('cart') as $id => $sanpham)
                        <tr data-product-id="{{ $id }}">
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
                            <td>
                                <input type="number" name="cart[{{ $id }}][soluong]"
                                    value="{{ $sanpham['soluong'] }}" class="form-control quantity" min="1">
                                <input type="hidden" name="cart[{{ $id }}][name]"
                                    value="{{ $sanpham['name'] }}">
                                <input type="hidden" name="cart[{{ $id }}][gia]" value="{{ $sanpham['gia'] }}">
                                <input type="hidden" name="cart[{{ $id }}][image]"
                                    value="{{ $sanpham['image'] }}">
                            </td>
                            <td class="total-price">{{ number_format($sanpham['gia'] * $sanpham['soluong']) }} <sup>đ</sup>
                            </td>
                            <td>
                                <button class="btn btn-danger xoa-san-pham">Xóa</button>
                            </td>
                        </tr>
                        @php
                            $total += $sanpham['gia'] * $sanpham['soluong'];
                        @endphp
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-end">Tổng cộng:</td>
                    <td id="total-amount">{{ number_format($total) }} <sup>đ</sup></td>
                </tr>
            </tfoot>
        </table>
        <a href="{{ route('order.index') }}"> <button type="submit" class="btn btn-primary">Tiến hành thanh toán
                ngay</button></a>
    </form>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.xoa-san-pham').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault(); // Bỏ sự kiện mặc định của nút

                const productId = e.target.closest('tr').dataset.productId;

                // Gửi yêu cầu xóa sản phẩm
                axios.post("{{ route('xoaSanPham') }}", {
                        sanpham_id: productId
                    })
                    .then(response => {
                        // Xóa hàng trong bảng
                        const row = document.querySelector(`tr[data-product-id="${productId}"]`);
                        row.remove();

                        // Cập nhật tổng tiền và tổng số lượng
                        document.getElementById('total-amount').innerText =
                            `${response.data.tongtien.toLocaleString()} đ`;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });

        document.querySelectorAll('.quantity').forEach(input => {
            input.addEventListener('change', (e) => {
                const productId = e.target.closest('tr').dataset.productId;
                const newQuantity = e.target.value;

                // Gửi yêu cầu cập nhật số lượng
                axios.post("{{ route('capNhatSoLuong') }}", {
                        sanpham_id: productId,
                        soluong: newQuantity
                    })
                    .then(response => {
                        // Cập nhật số lượng và thành tiền trong bảng
                        const row = document.querySelector(`tr[data-product-id="${productId}"]`);
                        const price = row.querySelector('td:nth-child(4)').innerText.replace(/[^0-9]/g,
                            '');
                        const totalPriceCell = row.querySelector('.total-price');
                        const newTotalPrice = newQuantity * price;

                        totalPriceCell.innerText = `${newTotalPrice.toLocaleString()} đ`;

                        // Cập nhật tổng cộng
                        document.getElementById('total-amount').innerText =
                            `${response.data.tongtien.toLocaleString()} đ`;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
    </script>
@endpush --}}
@extends('user.layout.master')
@section('content')

    <h1 class="mt-3">Giỏ hàng của bạn</h1>
    <form action="{{ route('order.showForm') }}" method="GET">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Số thứ tự</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                @php
                    $total = 0;
                @endphp
                @if (session('cart'))
                    @foreach (session('cart') as $id => $sanpham)
                        <tr data-product-id="{{ $id }}">
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
                            <td>
                                <input type="number" name="cart[{{ $id }}][soluong]"
                                    value="{{ $sanpham['soluong'] }}" class="form-control quantity" min="1">
                                <input type="hidden" name="cart[{{ $id }}][name]" value="{{ $sanpham['name'] }}">
                                <input type="hidden" name="cart[{{ $id }}][gia]" value="{{ $sanpham['gia'] }}">
                                <input type="hidden" name="cart[{{ $id }}][image]" value="{{ $sanpham['image'] }}">
                            </td>
                            <td class="total-price">{{ number_format($sanpham['gia'] * $sanpham['soluong']) }} <sup>đ</sup></td>
                            <td>
                                <button class="btn btn-danger xoa-san-pham">Xóa</button>
                            </td>
                        </tr>
                        @php
                            $total += $sanpham['gia'] * $sanpham['soluong'];
                        @endphp
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-end">Tổng cộng:</td>
                    <td id="total-amount">{{ number_format($total) }} <sup>đ</sup></td>
                </tr>
            </tfoot>
        </table>
        <button type="submit" class="btn btn-danger">Tiến hành thanh toán ngay</button>
    </form>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.xoa-san-pham').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();

                const productId = e.target.closest('tr').dataset.productId;

                axios.post("{{ route('xoaSanPham') }}", {
                        sanpham_id: productId
                    })
                    .then(response => {
                        const row = document.querySelector(`tr[data-product-id="${productId}"]`);
                        row.remove();

                        document.getElementById('total-amount').innerText =
                            `${response.data.tongtien.toLocaleString()} đ`;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });

        document.querySelectorAll('.quantity').forEach(input => {
            input.addEventListener('change', (e) => {
                const productId = e.target.closest('tr').dataset.productId;
                const newQuantity = e.target.value;

                axios.post("{{ route('capNhatSoLuong') }}", {
                        sanpham_id: productId,
                        soluong: newQuantity
                    })
                    .then(response => {
                        const row = document.querySelector(`tr[data-product-id="${productId}"]`);
                        const price = row.querySelector('td:nth-child(4)').innerText.replace(/[^0-9]/g, '');
                        const totalPriceCell = row.querySelector('.total-price');
                        const newTotalPrice = newQuantity * price;

                        totalPriceCell.innerText = `${newTotalPrice.toLocaleString()} đ`;

                        document.getElementById('total-amount').innerText =
                            `${response.data.tongtien.toLocaleString()} đ`;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
    </script>
@endpush

