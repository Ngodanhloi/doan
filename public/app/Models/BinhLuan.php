<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;
    protected $table = 'binhluan';
    protected $primaryKey = 'binhluansp_id';
    protected $fillable = ['sanpham_id', 'user_id', 'sao', 'binhluan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
