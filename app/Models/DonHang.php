<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'don_hang';
    use HasFactory;

    protected $fillable = [
        'donhang_id', // Thêm trường 'name' vào đây
        'user_id',
        'sanpham_id',
        'tongtien'
    ];
}
