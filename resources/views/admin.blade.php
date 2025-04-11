    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
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

            <!-- Trong section "Quản lý sản phẩm" -->
            <section id="products-section" class="admin-section">
                <h2>Quản lý sản phẩm</h2>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Tìm kiếm theo tên sản phẩm...">
                    <button type="button" id="searchButton">Tìm kiếm</button>
                </div>

                <button id="exportExcelButton" class="btn">Export Excel</button>

                <!-- Button to trigger the popup -->
                <button id="openPopupButton" class="btn btn-primary">Thêm sản phẩm</button>
                <!-- Popup form -->
                <div id="popupForm" style="display: none;">
                    <form id="addProductForm" action="{{ route('admin.sanpham.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="ten">Tên sản phẩm:</label>
                            <input type="text" id="ten" name="ten" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mota">Mô tả:</label>
                            <input id="mota" type="hidden" name="mota">
                            <trix-editor input="mota"></trix-editor>
                        </div>
                        <div class="form-group">
                            <label for="gia">Giá:</label>
                            <input type="number" id="gia" name="gia" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sale">Sale:</label>
                            <input type="number" id="sale" name="sale" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="soluongtrongkho">Số lượng trong kho:</label>
                            <input type="number" id="soluongtrongkho" name="soluongtrongkho" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="soluongdaban">Số lượng đã bán:</label>
                            <input type="number" id="soluongdaban" name="soluongdaban" class="form-control">
                        </div>
                        <select id="danhmucsp_id" name="danhmucsp_id" class="form-control" required>
                            <option value="">Chọn danh mục</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->danhmucsp_id }}">{{ $category->ten }}</option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            <label for="hinh">Hình:</label>
                            <input type="file" id="hinh" name="hinh" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                    </form>
                    <button id="closePopupButton" class="btn btn-danger">Đóng</button>
                </div>

                @isset($sanphams)
                @if ($sanphams->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Sale</th>
                            <th>Hình</th>
                            <th>Số lượng trong kho</th>
                            <th>Số lượng đã bán</th>
                            <th>Danh mục sản phẩm</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sanphams as $sanpham)
                        <tr>
                            <td>{{ $sanpham->sanpham_id }}</td>
                            <td>{{ $sanpham->ten }}</td>
                            <td>{!! $sanpham->mota !!}</td>
                            <td>{{ $sanpham->gia }}</td>
                            <td>{{ $sanpham->sale }}</td>
                            <td><img src="{{ asset('img/product/' . $sanpham->hinh)}}" alt="Hình ảnh sản phẩm"></td>
                            <td>{{ $sanpham->soluongtrongkho }}</td>
                            <td>{{ $sanpham->soluongdaban }}</td>
                            <td>{{ $sanpham->danhmucsp_id }}</td>
                            <td>
                                <button class="edit-button" data-product-id="{{ $sanpham->sanpham_id }}">Edit</button>

                                <form action="{{ route('admin.sanpham.delete', $sanpham->sanpham_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Xóa</button>
                                </form>
                            </td>
                            <!-- Edit form container -->
                            <div id="editFormContainer-{{ $sanpham->sanpham_id }}" class="edit-form-container" style="display: none;">
                                <form action="{{ route('admin.sanpham.update', $sanpham->sanpham_id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="ten">Tên Sản phẩm:</label>
                                        <input type="text" id="ten" name="ten" class="form-control" value="{{ $sanpham->ten }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mota">Mô Tả:</label>
                                        <textarea id="mota" name="mota" class="form-control" required>{{ $sanpham->mota }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="gia">Giá:</label>
                                        <input type="number" id="gia" name="gia" class="form-control" value="{{ $sanpham->gia }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sale">Khuyến mãi (%):</label>
                                        <input type="number" id="sale" name="sale" class="form-control" value="{{ $sanpham->sale ?? 0 }}" required>
                                    </div>
                                    <select id="danhmucsp_id" name="danhmucsp_id" class="form-control" required>
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->danhmucsp_id }}">{{ $category->ten }}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <label for="soluongtrongkho">Số lượng trong kho:</label>
                                        <input type="number" id="soluongtrongkho" name="soluongtrongkho" class="form-control" value="{{ $sanpham->soluongtrongkho }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="soluongdaban">Số lượng đã bán:</label>
                                        <input type="number" id="soluongdaban" name="soluongdaban" class="form-control" value="{{ $sanpham->soluongdaban }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="hinh">Hình:</label>
                                        <input type="file" id="hinh" name="hinh" class="form-control">
                                        @if($sanpham->hinh)
                                        <img src="{{ asset('img/product/' . $sanpham->hinh) }}" alt="Product Image" style="max-width: 200px; margin-top: 10px;">
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
                                    <button type="button" class="btn btn-danger" onclick="closeEditForm()">Đóng</button>
                                </form>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>Không có sản phẩm nào.</p>
                @endif
                @endisset
                </div>
                {{$sanphams->links()}}
            </section>
        </main>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const searchInput = document.getElementById("searchInput");
                const searchButton = document.getElementById("searchButton");
                const searchResultMessage = document.getElementById("searchResultMessage");

                searchButton.addEventListener("click", function() {
                    const searchTerm = searchInput.value.trim().toLowerCase();
                    const rows = document.querySelectorAll("#products-section table tbody tr");
                    let found = false;

                    rows.forEach(function(row) {
                        const productName = row.querySelector("td:nth-child(2)").textContent.trim().toLowerCase();
                        if (productName.includes(searchTerm)) {
                            row.style.display = "";
                            found = true;
                        } else {
                            row.style.display = "none";
                        }
                    });

                    if (!found) {
                        alert("Không có tên sản phẩm nào phù hợp với từ khóa tìm kiếm.");
                    } else {
                        searchResultMessage.style.display = "none";
                    }
                });
            });
            document.addEventListener("DOMContentLoaded", function() {
                const exportExcelButton = document.getElementById("exportExcelButton");

                exportExcelButton.addEventListener("click", function() {
                    window.location.href = "{{ route('admin.export_excel') }}";
                });
            });
        </script>
    </body>

    </html>
    <script src="{{asset('js/admin.js')}}"></script>