<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cate Dashboard</title>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <style>
        .search-container {
            margin-bottom: 20px;
        }

        #searchInput {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #searchButton {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #searchButton:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <header>
        <h1>Trang chủ ADMIN</h1>
        <a href="{{url('/')}}"><i class="fa fa-home" style="color:#fff; font-size: 25px;"></i></a>
        <nav>
            <ul>
                <li><a href="{{asset('admin')}}" class="nav-link">Quản lý sản phẩm</a></li>
                <li><a href="{{asset('roleadmin/cate')}}" class="nav-link">Danh Mục</a></li>
                <li><a href="{{asset('roleadmin/user')}}" class="nav-link">Quản lý tài khoản</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @if (session('success'))
        <div id="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <section id="categories-section" class="admin-section">
            <h2>Quản lý danh mục</h2>
            <!-- Button to trigger the popup -->
            <button id="openPopupButton" class="btn btn-primary">Thêm danh mục</button>
            <!-- Popup form -->
            <div id="popupForm" style="display: none;">
                <form id="addCategoryForm" action="{{ route('roleadmin.cate.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="ten">Tên danh mục:</label>
                        <input type="text" id="ten" name="ten" class="form-control">
                    </div>
                    <div class="form-group">
                            <label for="mota">Mô tả:</label>
                            <input id="mota" type="hidden" name="mota">
                            <trix-editor input="mota"></trix-editor>
                        </div>
                    <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                </form>
                <button id="closePopupButton" class="btn btn-danger">Đóng</button>
            </div>

            @isset($cates)
            @if ($cates->count())
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Tìm kiếm theo tên danh mục...">
                <button type="button" id="searchButton">Tìm kiếm</button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Mô Tả</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cates as $cate)
                    <tr>
                        <td>{{ $cate->danhmucsp_id }}</td>
                        <td>{{ $cate->ten }}</td>
                        <td>{!! $cate->mota !!}</td>
                        <td>{{ $cate->created_at }}</td>
                        <td>{{ $cate->updated_at }}</td>
                        <td>
                            <button class="edit-button" data-product-id="{{ $cate->danhmucsp_id }}">Edit</button>

                            <form action="{{ route('roleadmin.cate.delete', ['danhmucsp_id' => $cate->danhmucsp_id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</button>
                            </form>
                        </td>
                        <!-- Edit form container -->
                        <div id="editFormContainer-{{ $cate->danhmucsp_id }}" class="edit-form-container" style="display: none;">
                            <form action="{{ route('roleadmin.cate.update', $cate->danhmucsp_id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="ten">Tên Danh Mục:</label>
                                    <input type="text" id="ten" name="ten" class="form-control" value="{{ $cate->ten }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="mota">Mô Tả:</label>
                                    <textarea id="mota" name="mota" class="form-control" required>{{ $cate->mota }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập Nhật Danh Mục</button>
                                <button type="button" class="btn btn-danger" onclick="closeEditForm()">Đóng</button>
                            </form>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Không có danh mục nào.</p>
            @endif
            @endisset
            {{$cates->links()}}
        </section>
    </main>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const searchButton = document.getElementById("searchButton");

        searchButton.addEventListener("click", function() {
            const searchTerm = searchInput.value.trim().toLowerCase();
            const rows = document.querySelectorAll("#categories-section table tbody tr");
            let found = false;

            rows.forEach(function(row) {
                const categoryName = row.querySelector("td:nth-child(2)").textContent.trim().toLowerCase();
                if (categoryName.includes(searchTerm)) {
                    row.style.display = "";
                    found = true;
                } else {
                    row.style.display = "none";
                }
            });

            if (!found) {
                alert("Không tìm thấy tên danh mục nào phù hợp.");
            }
        });

        // Add this part to handle empty search result
        const categoryRows = document.querySelectorAll("#categories-section table tbody tr");
        if (categoryRows.length === 0) {
            alert("Không có danh mục nào.");
        }
    });
</script>

</html>
<script src="{{asset('js/admin.js')}}"></script>