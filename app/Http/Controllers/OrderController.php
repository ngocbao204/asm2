<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class OrderController extends Controller
// {
//     public function index()
//     {
//         // Lấy giỏ hàng từ session
//         $cart = session('cart', []);
//         $total = array_reduce($cart, function ($carry, $item) {
//             return $carry + ($item['gia'] * $item['soluong']);
//         }, 0);

//         return view('user.order', compact('cart', 'total'));
//     }

//     public function store(Request $request)
//     {
//         // Xử lý thanh toán ở đây
//         // Ví dụ: Lưu đơn hàng vào s

//         return redirect()->route('order.index')->with('success', 'Đơn hàng của bạn đã được đặt.');
//     }


// }
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['gia'] * $item['soluong']);
        }, 0);

        return view('user.order', compact('cart', 'total'));
    }

    public function showForm()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        return view('user.order', compact('cart'));
    }

    public function store(Request $request)
    {
        // Xử lý thanh toán ở đây
        // Ví dụ: Lưu đơn hàng vào session
        $orderDetails = $request->only('name', 'address', 'phone');
        $cart = session('cart');

        // Save the order details to the session
        session()->put('order', [
            'details' => $orderDetails,
            'cart' => $cart
        ]);

        // Clear the cart after processing the order
        session()->forget('cart');

        return redirect()->route('order.detail')->with('success', 'Đơn hàng của bạn đã được đặt.');
    }
    public function showOrderDetail()
    {
        return view('user.orderdetail');
    }
}
