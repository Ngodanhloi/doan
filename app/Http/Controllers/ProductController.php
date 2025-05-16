<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use App\Models\SanPham;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SanPhamExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $sanphams = SanPham::paginate(5);
        $categories = Category::all();
        return view('admin', compact('sanphams', 'categories'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
            'mota' => 'required',
            'gia' => 'required|numeric',
            'sale' => 'nullable|numeric',
            'soluongtrongkho' => 'required|numeric',
            'soluongdaban' => 'required|numeric',
            'danhmucsp_id' => 'required|exists:category,danhmucsp_id', // Kiểm tra ID danh mục tồn tại
            'hinh' => 'nullable|image'
        ]);

        $sanpham = new Sanpham();
        $sanpham->ten = $request->input('ten');
        $sanpham->mota = $request->input('mota');
        $sanpham->gia = $request->input('gia');
        $sanpham->sale = $request->input('sale');
        $sanpham->soluongtrongkho = $request->input('soluongtrongkho');
        $sanpham->soluongdaban = $request->input('soluongdaban');
        $sanpham->danhmucsp_id = $request->input('danhmucsp_id'); // Nhận ID danh mục trực tiếp từ form

        if ($request->hasFile('hinh')) {
            $file = $request->file('hinh');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Thêm thời gian để tránh trùng lặp
            $file->move(public_path('img/product'), $fileName); // Di chuyển file vào thư mục lưu trữ
            $sanpham->hinh = $fileName; // Lưu tên tệp hình ảnh vào cơ sở dữ liệu
        }

        $sanpham->save();
        return redirect('admin')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    public function update(Request $request, $id)
    {
        $sanpham = SanPham::findOrFail($id);

        // Validate the input data
        $validatedData = $request->validate([
            'ten' => 'required',
            'mota' => 'required',
            'gia' => 'required|numeric',
            'sale' => 'nullable|numeric',
            'soluongtrongkho' => 'required|numeric',
            'soluongdaban' => 'required|numeric',
            'danhmucsp_id' => 'required|exists:category,danhmucsp_id',
            'hinh' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the product data
        $sanpham->ten = $validatedData['ten'];
        $sanpham->mota = $validatedData['mota'];
        $sanpham->gia = $validatedData['gia'];
        $sanpham->sale = $validatedData['sale'] ?? 0;
        $sanpham->soluongtrongkho = $validatedData['soluongtrongkho'];
        $sanpham->soluongdaban = $validatedData['soluongdaban'];
        $sanpham->danhmucsp_id = $validatedData['danhmucsp_id'];

        // Xử lý hình ảnh
        if ($request->hasFile('hinh')) {
            $image = $request->file('hinh');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/product'), $imageName);
            $sanpham->hinh = $imageName;
        }

        $sanpham->save();

        return redirect('admin')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    public function delete($id)
    {
        // Delete related records in the danhgia table
        BinhLuan::where('sanpham_id', $id)->delete();

        // Delete the SanPham record
        SanPham::destroy($id);

        return redirect('admin')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
    /*Hien thi binh luan*/
    public function showProduct($sanphamId)
    {
        $sanpham = SanPham::find($sanphamId);
        $binhluans = BinhLuan::where('sanpham_id', $sanphamId)->get(); // Lấy tất cả bình luận của sản phẩm
        return view('product', compact('sanpham', 'binhluans'));
    }

    public function purchaseProduct(Request $request)
    {
        // Lấy thông tin sản phẩm từ request
        $sanPhamId = $request->input('sanpham_id');
        $soLuongDatHang = $request->input('so_luong');

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $sanPham = SanPham::find($sanPhamId);

        if ($sanPham) {
            // Cập nhật số lượng bán và số lượng trong kho
            $sanPham->so_luong_ban += $soLuongDatHang;
            $sanPham->so_luong_trong_kho -= $soLuongDatHang;

            // Lưu lại thông tin cập nhật vào cơ sở dữ liệu
            $sanPham->save();

            // Điều hướng hoặc trả về thông báo thành công
        } else {
            // Trả về thông báo lỗi nếu sản phẩm không tồn tại
        }
    }
    public function exportExcel()
    {
        return Excel::download(new SanPhamExport, 'sanpham.xlsx');
    }


    public function increaseLike(Request $request, $sanphamId)
    {
        $sanpham = SanPham::find($sanphamId);
        if (!$sanpham) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }

        DB::table('sanpham')
            ->where('sanpham_id', $sanphamId)
            ->increment('like');

        return response()->json(['message' => 'Cảm ơn bạn đã thích sản phẩm', 'likes' => $sanpham->like]);
    }
    public function index()
{
    $pros = SanPham::paginate(3);
    $cates = Category::paginate(10);
    return view('roleadmin.pro', compact('pros', 'cates'));
}

}
