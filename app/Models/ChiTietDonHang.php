<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{

    protected $table = 'chitietdonhang';
    use HasFactory;

    protected $fillable = [
        'chitietdonhang_id',
        'donhang_id', 
        'sanpham_id',
        'soluong',
        'gia_sp'
    ];
}
