<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ThongTinThanhToan;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;

class PayController extends Controller
{
    public function processPayment(Request $request)
    {
        $cartSession = session()->get('cart');
        $currentUser = auth()->user();
        
        $cart = DonHang::create([
            'user_id' => $currentUser->user_id, 
         
        ]);

        $cart->save();

        ThongTinThanhToan::create([
            'id' =>$cart->id,
            'ten' =>$request->input('ten'),
            'diachigiaohang' =>$request->input('diachigiaohang'),
            'sdt' =>$request->input('sdt'),
            'ghichudonhang' =>$request->input('ghichudonhang'),
            'user_id' => $currentUser->user_id,


        ])->save;
        foreach($cartSession as $item) {
            $cartItem = ChiTietDonHang::create([
                
                'donhang_id' =>$cart->id,
                'sanpham_id' =>$item['id'],
                'soluong' =>$item['quantity'],
                'gia_sp' =>$item['price'],
                
                ]); 
            $cartItem->save();
        }
         // Xóa giỏ hàng sau khi đặt hàng thành công
        session()->forget('cart');
        return view('buy-success');
        
        return response()->json(['status' => $request->input('ten')]);
      
    }

}