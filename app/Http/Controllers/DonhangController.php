<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DonhangController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        return view('user.cart');
    }

    public function themVaoGiohang(Request $request)
    {
        $sanpham_id = $request->sanpham_id;
        $soluong = $request->soluong;

        // Tìm sản phẩm nếu không thấy thì return lỗi
        $sanpham = Product::find($sanpham_id);

        if ($sanpham == null) {
            return response()->json([
                'error' => "Sản phẩm không tìm thấy"
            ], 404);
        }

        // Tìm trong session có key => 'cart' => nếu không có thì trả về []
        $giohang = session()->get('cart', []);

        if (isset($giohang[$sanpham_id])) {
            // đã tồn tại -> cập nhật số lượng
            $giohang[$sanpham_id]['soluong'] += $soluong;
        } else {
            // nếu chưa có tạo ra mảng(object trong js)
            $giohang[$sanpham_id] =  [
                'id' => $sanpham->id,
                'name' => $sanpham->name_product,
                'gia' => $sanpham->price_new,
                'soluong' => $soluong,
                'image' => $sanpham->image // Thêm đường dẫn ảnh vào session
            ];
        }

        session()->put('cart', $giohang); // Cập nhật session

        // Đếm số lượng có bao nhiêu trong giỏ
        $tongsoluong = 0;
        foreach ($giohang as $item) {
            $tongsoluong += $item['soluong'];
        }

        return response()->json(['message' => 'Cart updated', 'tongsoluong' => $tongsoluong], 200);
    }

    public function capNhatSoLuong(Request $request)
    {
        $sanpham_id = $request->sanpham_id;
        $soluong = $request->soluong;

        // Tìm sản phẩm nếu không thấy thì return lỗi
        $sanpham = Product::find($sanpham_id);

        if ($sanpham == null) {
            return response()->json([
                'error' => "Sản phẩm không tìm thấy"
            ], 404);
        }

        // Tìm trong session có key => 'cart' => nếu không có thì trả về []
        $giohang = session()->get('cart', []);

        if (isset($giohang[$sanpham_id])) {
            // Cập nhật số lượng
            $giohang[$sanpham_id]['soluong'] = $soluong;
            session()->put('cart', $giohang); // Cập nhật session
        } else {
            return response()->json([
                'error' => "Sản phẩm không có trong giỏ hàng"
            ], 404);
        }

        // Tính tổng số lượng và tổng tiền
        $tongsoluong = 0;
        $tongtien = 0;
        foreach ($giohang as $item) {
            $tongsoluong += $item['soluong'];
            $tongtien += $item['gia'] * $item['soluong'];
        }

        return response()->json(['message' => 'Cart updated', 'tongsoluong' => $tongsoluong, 'tongtien' => $tongtien], 200);
    }


    // Xóa sản phẩm khỏi giỏ hàng
    // app/Http/Controllers/DonhangController.php

    public function xoaSanPham(Request $request)
    {
        $sanpham_id = $request->sanpham_id;

        // Lấy giỏ hàng từ session
        $giohang = session()->get('cart', []);

        // Kiểm tra sản phẩm có trong giỏ hàng không
        if (isset($giohang[$sanpham_id])) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($giohang[$sanpham_id]);

            // Cập nhật lại giỏ hàng trong session
            session()->put('cart', $giohang);

            // Tính tổng số lượng và tổng tiền
            $tongsoluong = 0;
            $tongtien = 0;
            foreach ($giohang as $item) {
                $tongsoluong += $item['soluong'];
                $tongtien += $item['gia'] * $item['soluong'];
            }

            return response()->json([
                'message' => 'Sản phẩm đã được xóa',
                'tongsoluong' => $tongsoluong,
                'tongtien' => $tongtien
            ], 200);
        } else {
            return response()->json(['error' => 'Sản phẩm không có trong giỏ hàng'], 404);
        }
    }
}
