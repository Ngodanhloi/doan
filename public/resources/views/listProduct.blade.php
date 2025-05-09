@extends('layout')

@section('main')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <!-- Font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Icon fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Reset css & grid system -->
    <link rel="stylesheet" href="{{asset('css/library.css')}}">
    <!-- Owl Slider css -->
    <link rel="stylesheet" href="{{ asset('owlCarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('owlCarousel/assets/owl.theme.default.min.css')}}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Layout -->
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <!-- index -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/product.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/productSale.css')}}">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl carousel Js-->
    <script src="{{asset('owlCarousel/owl.carousel.min.js')}}"></script>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">

    <style>
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
        }

        .comparison-table th,
        .comparison-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .comparison-table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .comparison-table-container {
            display: none;
            /* Ẩn bảng so sánh ban đầu */
        }

        .comparison-table-container.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            z-index: 1000;
            overflow: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .comparison-table-container .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 2rem;
            cursor: pointer;
        }

        /* Style for compare button */
        button.add-to-compare {
            background-color: #0daf74;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button.add-to-compare:hover {
            background-color: #098f5e;
        }

        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .comparison-table th,
        .comparison-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .comparison-table th {
            background-color: #f8f8f8;
            color: #333;
        }

        .comparison-table td img {
            max-width: 50px;
            height: auto;
        }

        .comparison-table-container {
            display: none;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .comparison-table-container.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            z-index: 1000;
            overflow: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .comparison-table-container .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 2rem;
            color: #333;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <div class="main">
        <div class="grid wide">
            <div class="main__taskbar">
                <div class="main__breadcrumb">
                    <div class="breadcrumb__item">
                        <a href="{{asset('/')}}" class="breadcrumb__link">Trang chủ</a>
                    </div>
                    <div class="breadcrumb__item">
                        <a href="{{ route('listProduct.filter') }}" class="breadcrumb__link">Cửa hàng</a>
                    </div>
                    <!-- Dropdown để chọn danh mục -->
                    <select onchange="location = this.value;" style="width: 150px;height: 36px;font-size: 1.6rem;">
                        <option value="{{ route('listProduct.filter') }}">Danh Mục</option>
                        @foreach ($cates as $cate)
                        <option value="{{ route('listProduct.filter', ['danhmuc_id' => $cate->danhmucsp_id]) }}" {{ request('danhmuc_id') == $cate->danhmucsp_id ? 'selected' : '' }}>{{ $cate->ten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="main__sort">
                    <h3 class="sort__title">
                        Hiển thị kết quả theo
                    </h3>
                    <select class="sort__select" onchange="sortProducts(this.value)">
                        <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Thứ tự mặc định</option>
                        <option value="2" {{ request('sort') == '2' ? 'selected' : '' }}>Giá : Thấp đến cao</option>
                        <option value="3" {{ request('sort') == '3' ? 'selected' : '' }}>Giá : Cao đến thấp</option>
                    </select>
                </div>
            </div>

            <div class="productList">
                <div class="listProduct">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="row">
                                @foreach($phanTrang as $row)
                                <div class="col l-2 m-4 s-6 custom-padding">
                                    <div class="product">
                                        <div class="product__avt">
                                            <img src="{{asset('img/product/' . $row->hinh)}}" alt="" class="product__image">
                                        </div>
                                        <div class="product__info">
                                            <h3 class="product__name"><a href="{{url('product/' . $row->sanpham_id)}}" style="color:#0daf74">{{$row->ten}}</a></h3>
                                            @php
                                            $giaMoi = $row->gia - $row->sale;
                                            @endphp
                                            <div class="product__price">
                                                <div class="price__original" style="color: #999; text-decoration: line-through;">{{ $row->gia}} <span class="price__unit">đ</span></div>
                                                <div class="price__new" style="color: red; padding-left: 32px;">{{ $giaMoi}} <span class="price__unit">đ</span></div>
                                            </div>
                                            <div class="product__sale">
                                                <span class="product__sale-percent">{{$row->sale}}</span>
                                                <span class="product__sale-text">Giảm</span>
                                            </div>
                                            <button class="add-to-compare" data-id="{{ $row->sanpham_id }}" data-name="{{ $row->ten }}" data-price="{{ $giaMoi }}" data-image="{{ asset('img/product/' . $row->hinh) }}" data-mota="{{ $row->mota }}">Thêm so sánh</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="pagination">
                        @if ($phanTrang->previousPageUrl())
                        <a href="{{ $phanTrang->previousPageUrl() }}" class="page-link">&laquo; Previous | </a>
                        @endif
                        Trang {{ $phanTrang->currentPage() }}/{{ $phanTrang->lastPage() }}
                        @if ($phanTrang->nextPageUrl())
                        <a href="{{ $phanTrang->nextPageUrl() }}" class="page-link"> | Next &raquo</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="comparison-table-container">
                <h2>So sánh sản phẩm</h2>
                <table class="comparison-table" id="comparison-table">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Mô tả</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be added dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function sortProducts(sortValue) {
            var currentUrl = window.location.href;
            var newUrl = new URL(currentUrl);
            newUrl.searchParams.set('sort', sortValue);
            window.location.href = newUrl.toString();
        }

        const comparisonTableContainer = document.querySelector('.comparison-table-container');
        const comparisonTable = document.getElementById('comparison-table').getElementsByTagName('tbody')[0];
        const compareList = [];
        let firstComparison = true;

        document.querySelectorAll('.add-to-compare').forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-id');
                const productName = button.getAttribute('data-name');
                const productPrice = button.getAttribute('data-price');
                const productImage = button.getAttribute('data-image');
                const productDescription = button.getAttribute('data-mota'); // Thay đổi tại đây

                if (compareList.length < 3 && !compareList.some(item => item.id === productId)) {
                    compareList.push({
                        id: productId,
                        name: productName,
                        price: productPrice,
                        image: productImage,
                        description: productDescription
                    });
                    updateComparisonTable();
                    if (firstComparison) {
                        comparisonTableContainer.style.display = 'block';
                        $('#compareModal').modal('show');
                        firstComparison = false;
                    }
                } else {
                    alert('Chỉ có thể so sánh tối đa 3 sản phẩm.');
                }
            });
        });

        function updateComparisonTable() {
            comparisonTable.innerHTML = '';
            compareList.forEach(product => {
                const row = comparisonTable.insertRow();
                row.innerHTML = `
                <td>${product.name}</td>
                <td><img src="${product.image}" alt="${product.name}" style="width: 50px;"></td>
                <td>${product.price}</td>
                <td>${product.description}</td>
                <td><button class="remove-from-compare" data-id="${product.id}">Xóa</button></td>
            `;
            });

            document.querySelectorAll('.remove-from-compare').forEach(button => {
                button.addEventListener('click', () => {
                    const productId = button.getAttribute('data-id');
                    const index = compareList.findIndex(item => item.id === productId);
                    if (index > -1) {
                        compareList.splice(index, 1);
                        updateComparisonTable();
                        if (compareList.length === 0) {
                            comparisonTableContainer.style.display = 'none';
                        }
                    }
                });
            });
        }
    </script>

</body>

@endsection