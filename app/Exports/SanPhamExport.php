<?php

namespace App\Exports;

use App\Models\SanPham;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SanPhamExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return SanPham::select('sanpham_id', 'ten', 'mota', 'gia', 'sale', 'hinh', 'soluongtrongkho', 'soluongdaban', 'danhmucsp_id');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tên',
            'Mô tả',
            'Giá',
            'Sale',
            'Hình',
            'Số lượng trong kho',
            'Số lượng đã bán',
            'Danh mục sản phẩm',
        ];
    }
}
