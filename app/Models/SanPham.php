<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    protected $primaryKey = 'sanpham_id';
    protected $fillable = [ 'ten', 'mota', 'gia', 'sale', 'soluongtrongkho', 'soluongdaban', 'danhmucsp_id','hinh'];
    
    public function incrementViews()
    {
        $this->views++;
        $this->save();
    }
}

