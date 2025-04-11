@extends('layout')

@section('main')
<!--Slide -->
<div class="slider-area pos-rltv carosule-pagi cp-line">
    @include('slide')
</div>
<!DOCTYPE html>
<html lang="en">
<!-- https://cocoshop.vn/ -->
<!-- http://mauweb.monamedia.net/vanihome/ -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <!-- Font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Icon fontanwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Reset css & grid sytem -->
    <link rel="stylesheet" href="css/library.css">
    <!-- Owl Slider css -->
    <link rel="stylesheet" href="{{asset('owlCarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('owlCarousel/assets/owl.theme.default.min.css')}}">
    <!-- Layout -->
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <!-- index -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/contact.css')}}">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl caroucel Js-->
    <script src="{{ asset('owlCarousel/owl.carousel.min.js') }}"></script>
    <style>
        /* CSS cho nút View */
        .product__actions {
            padding-top: 10px;
        }

        .badge {
            margin-top: 60px;
            font-size: 20px;
            border-radius: 20%;
            color: #000;
            color: #f2fbf7;
            background: black;
        }
    </style>
</head>

@if(!empty($results))
<div class="grid wide">
    <h1 style="padding: 20px;font-size: 20px;">Kết quả tìm kiếm cho "{{ $query }}"</h1>
    <div class="row">
        @foreach($results as $product)
        <div class="col l-2 m-4 s-6 custom-padding">
            <div class="product">
                <div class="product__avt">
                    <img src="{{asset('img/product/' . $product->hinh)}}" alt="" class="product__image">
                </div>
                <div class="product__info">
                    <h3 class="product__name"><a href="{{url('product/' . $product->sanpham_id)}}" style="color:#0daf74">{{$product->ten}}</a></h3>
                    @php
                    $giaMoi = $product->gia - $product->sale;
                    @endphp
                    <div class="product__price">
                        <div class="price__original" style="color: #999; text-decoration: line-through;">{{ $product->gia}} <span class="price__unit">đ</span></div>
                        <div class="price__new" style="color: red; padding-left: 28px;">{{ $giaMoi}} <span class="price__unit">đ</span></div>
                    </div>
                    <div class="product__sale">
                        <span class="product__sale-percent">{{$product->sale}}</span>
                        <span class="product__sale-text">Giảm</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<!-- Danh sách sản phẩm mặc định -->
<div class="grid wide">
    <!-- Tab items -->
    <div class="tabs">
        <div class="tab-item active" style="color: green;">
            Bán Chạy
        </div>

        <div class="line" style="background-color: green;"></div>
    </div>
    <!-- Tab content -->
    <div class="tab-content">
        <div class="tab-pane active">
            <div class="row">
                @foreach($sanPhamBanChay as $product)
                <div class="col l-2 m-4 s-6 custom-padding">
                    <div class="product">
                        <div class="product__avt">
                            <img src="{{asset('img/product/' . $product->hinh)}}" alt="" class="product__image">
                        </div>
                        <div class="product__info">
                            <h3 class="product__name"><a href="{{url('product/' . $product->sanpham_id)}}" style="color:#0daf74">{{$product->ten}}</a></h3>
                            @php
                            $giaMoi = $product->gia - $product->sale;
                            @endphp
                            <div class="product__price">
                                <div class="price__original" style="color: #999; text-decoration: line-through;">{{ $product->gia}} <span class="price__unit">đ</span></div>
                                <div class="price__new" style="color: red; padding-left: 28px;">{{ $giaMoi}} <span class="price__unit">đ</span></div>
                            </div>
                            <div class="product__sale">
                                <span class="product__sale-percent">{{$product->sale}}</span>
                                <span class="product__sale-text">Giảm</span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- HightLight  -->
<div class="main__frame" style="background: #f2fbf7;">
    <div class="grid wide">
        <h3 class="category__title">Nhóm 2 Cometics</h3>
        <h3 class="category__heading">SẢN PHẨM NỔI BẬT</h3>
        <div class="owl-carousel hight owl-theme" id="productCarousel">
            @foreach($sanPham as $row)
            <div class="product">
                <div class="product__avt">
                    <img src="{{asset('img/product/' . $row->hinh)}}" alt="" class="product__image">
                </div>
                @php
                $giaMoi = $row->gia - $row->sale;
                @endphp
                <div class="product__info">
                    <h3 class="product__name"><a href="{{url('listProduct')}}" style="color:#0daf74">{{$row->ten}}</a></h3>
                    <div class="product__price">
                        <div class="price__original" style="color: #999; text-decoration: line-through; margin-left: -20px;">{{ $row->gia}} <span class="price__unit">đ</span></div>
                        <div class="price__new" style="color: red; padding-left: 70px;">{{ $giaMoi}} <span class="price__unit">đ</span></div>
                    </div>
                    <div class="product__sale">
                        <span class="product__sale-percent">{{ $row->sale}}</span>
                        <span class="product__sale-text">Giảm</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Sales Policy -->
<div class="main__policy">
    <div class="row">
        <div class="col l-3 m-6">
            <div class="policy bg-1">
                <img src="{{asset('img/policy/policy1.png')}}" class="policy__img"></img>
                <div class="policy__info">
                    <h3 class="policy__title">GIAO HÀNG MIỄN PHÍ</h3>
                    <p class="policy__description">Cho đơn hàng từ 300K</p>
                </div>
            </div>
        </div>
        <div class="col l-3 m-6">
            <div class="policy bg-2" style="background: #0daf74;">
                <img src="{{asset('img/policy/policy2.png')}}" class="policy__img"></img>
                <div class="policy__info">
                    <h3 class="policy__title">ĐỔI TRẢ HÀNG</h3>
                    <p class="policy__description">Trong 3 ngày đầu tiên</p>
                </div>
            </div>
        </div>
        <div class="col l-3 m-6">
            <div class="policy bg-1">
                <img src="{{asset('img/policy/policy3.png')}}" class="policy__img"></img>
                <div class="policy__info">
                    <h3 class="policy__title">HÀNG CHÍNH HÃNG</h3>
                    <p class="policy__description">Cam kết chất lượng</p>
                </div>
            </div>
        </div>
        <div class="col l-3 m-6">
            <div class="policy bg-2" style="background: #0daf74;">
                <img src="{{asset('img/policy/policy4.png')}}" class="policy__img"></img>
                <div class="policy__info">
                    <h3 class="policy__title">TƯ VẤN 24/24</h3>
                    <p class="policy__description">Giải đáp mọi thắc mắc</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- News -->
<div class="main__frame bg-3">
    <div class="grid wide">
        <h3 class="category__title">Nhóm 2 Cometics</h3>
        <h3 class="category__heading">Tin Tức</h3>
        <div class="owl-carousel news owl-theme">
            @foreach($news as $new)
            <a href="{{url('news')}}" class="news">
                <div class="news__img">
                    <img src="{{ asset('img/' . $new->image_url)}}" alt="">
                </div>
                <div class="news__body">
                    <h3 class="news__body-title">{{$new->title}}</h3>
                    <div class="new__body-date">{{$new->posted_date}}</div>
                    <p class="news__description">
                        {{$new->description}}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
<script>

</script>
@endsection