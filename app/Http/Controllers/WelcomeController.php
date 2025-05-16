<?php
// WelcomeController.php
namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\LienHe;
use App\Models\GioiThieu;
use App\Models\News;
use App\Models\Category;
use App\Models\BinhLuan;
use App\Models\DonHang;
use App\Models\ThongTinThanhToan;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function index(Request $request)
    {
        $sanPham = SanPham::all();
        $lienhe = LienHe::all();
        $cate = Category::all();
        $news = News::all();
        $sanPhamBanChay = Sanpham::orderBy('soluongdaban', 'desc')->take(9)->get();

        // Lấy từ khóa tìm kiếm từ request
        $query = $request->input('query');
        // Nếu có từ khóa tìm kiếm, thực hiện tìm kiếm sản phẩm
        if ($query) {
            $results = SanPham::where('ten', 'LIKE', "%{$query}%")
                ->orWhere('mota', 'LIKE', "%{$query}%")
                ->get();
        } else {
            $results = [];
        }
        return view('index', compact('sanPham', 'cate', 'lienhe', 'results', 'query', 'sanPhamBanChay', 'news'));
    }

    public function showListProduct(Request $request)
    {
        $cates = Category::all();
        $query = SanPham::select('*', DB::raw('gia - sale as giaMoi'));

        if ($request->has('danhmuc_id')) {
            $query->where('danhmucsp_id', $request->danhmuc_id);
        }

        if ($request->sort) {
            if ($request->sort == '2') {
                $query->orderBy('giaMoi', 'asc'); // Giá đã giảm từ thấp đến cao
            } elseif ($request->sort == '3') {
                $query->orderBy('giaMoi', 'desc'); // Giá đã giảm từ cao đến thấp
            }
        }

        $phanTrang = $query->paginate(7);
        return view('listProduct', compact('cates', 'phanTrang'));
    }

    public function contact()
    {
        $sanPham = SanPham::all();
        $cate = Category::all();
        $lienhe = LienHe::all();
        return view('contact', ['contact' => $lienhe, 'cate' => $cate, 'data' => $sanPham]);
    }

    public function about()
    {
        $sanPham = SanPham::all();
        $gioithieu = GioiThieu::all();
        return view('about', ['about' => $gioithieu, 'data' => $sanPham]);
    }


    public function product($page = "product")
    {
        $sanPham = SanPham::all();
        return view($page, ['product' => $sanPham]);
    }


    public function cart($page = "cart")
    {
        $cart = DonHang::all();
        return view($page, ['cart' => $cart]);
    }

    public function pay($page = "pay")
    {
        $pay = ThongTinThanhToan::all();
        return view($page, ['pay' => $pay]);
    }

    public function news($page = "news")
    {
        $news = News::all();
        return view('news', ['news' => $news]);
    }

    public function detail($id)
{
    // Lấy thông tin sản phẩm
    $sanPham = DB::select("select * from `sanpham` where `sanpham_id` = ?", [$id]);

    if (!empty($sanPham)) {
        // Lấy danh sách bình luận của sản phẩm theo ID
        $binhluans = BinhLuan::where('sanpham_id', $id)->with('user')->get();

        return view('product', [
            'sanpham' => $sanPham[0],
            'binhluans' => $binhluans
        ]);
    } else {
        return redirect('/')->with('error', 'Sản phẩm không tồn tại');
    }
}


    /* Binh Luan Store*/
    public function store(Request $request)
    {
        $request->validate([
            'sanpham_id' => 'required|integer',
            'user_id' => 'required|integer',
            'sao' => 'required|numeric',
            'binhluan' => 'required|string|max:255',
        ]);

        BinhLuan::create($request->all());

        return back()->with('success', 'Bình luận đã được thêm!');
    }

    public function add(Request $request)
    {
        $request->validate([
            'hovaten' => 'required|string|max:255',
            'email' => 'required|email',
            'diachi' => 'required|string|max:255',
            'sdt' => 'required|string|max:20',
            'loinhan' => 'required|string',
        ]);

        LienHe::create($request->all());
        return back()->with('success', 'Thông tin liên hệ đã được gửi thành công!');
    }
}
