<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;

class NewsController extends Controller
{
    public function news()
    {
        $news = News::all();
        return view('role', compact('news'));
    }
    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        News::create($request->all());
        return redirect()->route('news.role')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    public function edit($id)
    {
        $news = News::find($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::find($id);
        $news->update($request->all());
        return redirect()->route('news.role')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    public function delete($id)
    {
        $news = News::find($id);
        $news->delete();
        return redirect()->route('admin.news.index');
    }
}
