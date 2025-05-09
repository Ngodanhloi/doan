<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    use HasFactory;
    protected $primaryKey = 'danhmucsp_id';
    protected $fillable = [ 'ten', 'mota'];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            // Xóa tất cả các sản phẩm liên quan
            $category->products()->delete();

            // Hoặc cập nhật sản phẩm sang NULL hoặc ID danh mục khác
            // $category->products()->update(['danhmucsp_id' => null]);
        });
    }

    public function products()
    {
        return $this->hasMany(SanPham::class, 'danhmucsp_id');
    }
}