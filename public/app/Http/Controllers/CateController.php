<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CateController extends Controller
{
    public function index()
    {
        $cates = Category::all(); // Lấy danh sách danh mục
        return view('ten-view-cua-ban', compact('cates')); 
    }

    public function store(Request $request)
    {
        $cate = new Category();
        $cate->ten = $request->input('ten');
        $cate->mota = $request->input('mota');

        $cate->save();
        return redirect()->route('roleadmin.cate.index')->with('success', 'Danh Mục đã được thêm thành công.');
    }

    public function update(Request $request, $id)
    {
        $cate = Category::findOrFail($id);
        // Validate the input data
        $validatedData = $request->validate([
            'ten' => 'required',
            'mota' => 'required',
        ]);

        $cate->ten = $validatedData['ten'];
        $cate->mota = $validatedData['mota'];

        $cate->save();

        return redirect()->route('roleadmin.cate.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }
    public function delete($id)
    {
        // Delete the SanPham record
        Category::destroy($id);

        return redirect()->route('roleadmin.cate.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
