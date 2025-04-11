<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart');
        return view('cart', ['cart' => $cart]);
    }
    public function add(Request $request)
    {
        $productId = $request->input('sanpham_id');
        $sanPham = DB::select("select * from `sanpham` where `sanpham_id` = $productId limit 1;")[0];


        if ($sanPham) {
            $cart = session()->get('cart');

            if (isset($cart[$productId])) {
                // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng
                $cart[$productId]['quantity']++;
            } else {
                // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới vào giỏ hàng
                $cart[$productId] = [
                    'id' => $sanPham->sanpham_id,
                    'name' => $sanPham->ten,
                    'price' => $sanPham->gia - $sanPham->sale,
                    'quantity' => 1,
                    'img' => $sanPham->hinh
                ];
            }

            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }
    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $newQuantity = $request->input('quantity');

        $cart = session()->get('cart');

        if (isset($cart[$productId])) {
            // Nếu sản phẩm tồn tại trong giỏ hàng, cập nhật số lượng mới
            $cart[$productId]['quantity'] = $newQuantity;
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        } else {
            // Nếu sản phẩm không tồn tại trong giỏ hàng, trả về lỗi
            return response()->json(['error' => 'Sản phẩm không tồn tại trong giỏ hàng'], 404);
        }
    }

    public function remove(Request $request)
    {
        $productId = $request->input('sanpham_id');
        $cart = session()->get('cart');

        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Xóa sản phẩm khỏi giỏ hàng
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }
    public function applyDiscount(Request $request)
    {
        // Lấy số tiền từ phiếu ưu đãi nhập từ form
        $discountAmount = $request->input('discount_amount');

        // Lấy tổng tiền từ biến đã tính từ trước
        $totalPrice = $request->session()->get('totalPrice');

        // Tính toán số tiền giảm
        $totalPriceAfterDiscount = $totalPrice - $discountAmount;

        // Chuyển hướng trở lại trang giỏ hàng
        return redirect('/cart')->with('discountApplied', true);
    }
    public function addToCart(Request $request)
    {
        $sanpham_id = $request->input('sanpham_id');
        $so_luong = $request->input('so_luong');

        // Thêm sản phẩm vào giỏ hàng với số lượng được truyền từ request
        // Code xử lý thêm sản phẩm vào giỏ hàng ở đây

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }
}
