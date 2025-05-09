<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinThanhToan extends Model
{
    protected $table = 'thong_tin_thanh_toan';
    use HasFactory;

    protected $fillable = [
        'id',
        'ten',
        'diachigiaohang',
        'sdt',
        'ghichudonhang',
        'user_id'
    ];

}
