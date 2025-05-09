@extends('layout')

@section('main')
<!DOCTYPE html>
<html lang="en">
<!-- https://cocoshop.vn/ -->
<!-- http://mauweb.monamedia.net/vanihome/ -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiêt sản phẩm</title>
    <!-- Font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Icon fontanwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Reset css & grid sytem -->
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <!-- Owl Slider css -->
    <link rel="stylesheet" href="{{ asset('owlCarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('owlCarousel/assets/owl.theme.default.min.css') }}">
    <!-- Layout -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <!-- index -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/product.css') }}">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl caroucel Js-->
    <script src="{{ asset('owlCarousel/owl.carousel.min.js') }}"></script>
    <style>
        .productInfo__addToCart {
            display: flex;
            align-items: center;
        }

        /* Đặt khoảng cách giữa các phần tử con */
        .productInfo__addToCart button {
            margin-right: 5px;
            /* Khoảng cách 5px giữa các nút */
        }

        .likeButton {
            height: 5px;
            /* Thêm các thuộc tính CSS để căn chỉnh icon vào giữa nút */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .likeButton i {
            /* Chỉnh kích thước, màu sắc hoặc bất kỳ thuộc tính CSS nào khác cho icon tại đây */
            font-size: 24px;
            color: #fff;
            /* Màu đỏ, bạn có thể thay đổi theo ý muốn */
        }

        /* Add the following CSS styles for the "Thích" button */
        .likeButton {
            height: 20px;
            /* Remove the height property to allow the button to adjust its height based on the content */
            padding: 5px 10px;
            /* Add padding to give some space around the icon and text */
            background-color: #ff0000;
            /* Change the background color to red */
            border-radius: 5px;
            /* Add border radius to give a rounded look */
            cursor: pointer;
            /* Change the cursor to a pointer to indicate clickability */
        }

        .likeButton i {
            font-size: 24px;
            /* Keep the font-size as 24px */
            color: #fff;
            /* Keep the color as white */
        }
    </style>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
</head>

<body>
    <div class="main">
        <div class="grid wide">
            <div class="productInfo">
                <div class="row">
                    @if (isset($sanpham))
                    <div class="col l-5 m-12 s-12">
                        <div class="owl-carousel owl-theme" id="sync1">
                            <div class="product__avt">
                                <img src="{{ asset('img/product/' . $sanpham->hinh) }}" alt="" class="product__image">
                            </div>
                        </div>
                    </div>
                    <div class="col l-7 m-12s s-12 pl">
                        <h3 class="productInfo__name">
                            {{ $sanpham->ten }}
                        </h3>
                        @php
                        $giaMoi = $sanpham->gia - $sanpham->sale;
                        @endphp
                        <div class="productInfo__price" style="color:red">
                            {{ $giaMoi }} <span class="priceInfo__unit"></span>
                        </div>
                        <div class="productInfo__description">
                            <span>{{ $sanpham->ten }} <br> <br> </span> Mô tả là : {{ $sanpham->mota }}
                        </div>

                        <div class="productInfo__addToCart">
                            <!-- Nút Thích -->
                            <button id="likeButton" class="btn btn--default" data-product-id="{{ $sanpham->sanpham_id }}" style="height: 60px;">
                                <i class="icon-heart"></i>
                                <span id="likeCount" style="font-size: 40px;">{{ $sanpham->like }}</span>
                            </button>
                            <!-- Form thêm vào giỏ hàng -->
                            <form method="post" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" value="{{ $sanpham->sanpham_id }}" name='sanpham_id'>
                                <button type="submit" class="btn btn--default orange" style="height: 60px;">Thêm vào giỏ hàng</button>
                            </form>
                        </div>

                        <div class="productIndfo__policy ">
                            <div class="policy bg-1 ">
                                <img src="{{ asset('img/policy/policy1.png') }}" class="policy__img"></img>
                                <div class="productIndfo__policy-info ">
                                    <h3 class="productIndfo__policy-title ">Giao hàng miễn phí</h3>
                                    <p class="productIndfo__policy-description ">Cho đơn hàng từ 300K</p>
                                </div>
                            </div>
                            <div class="policy bg-2 ">
                                <img src="{{ asset('img/policy/policy1.png') }}" class="policy__img"></img>
                                <div class="productIndfo__policy-info ">
                                    <h3 class="productIndfo__policy-title ">Giao hàng miễn phí</h3>
                                    <p class="productIndfo__policy-description ">Cho đơn hàng từ 300K</p>
                                </div>
                            </div>
                            <div class="policy bg-1 ">
                                <img src="{{ asset('img/policy/policy1.png') }}" class="policy__img"></img>
                                <div class="productIndfo__policy-info ">
                                    <h3 class="productIndfo__policy-title ">Giao hàng miễn phí</h3>
                                    <p class="productIndfo__policy-description ">Cho đơn hàng từ 300K</p>
                                </div>
                            </div>
                            <div class="policy bg-2 ">
                                <img src="{{ asset('img/policy/policy1.png') }}" class="policy__img"></img>
                                <div class="productIndfo__policy-info ">
                                    <h3 class="productIndfo__policy-title ">Giao hàng miễn phí</h3>
                                    <p class="productIndfo__policy-description ">Cho đơn hàng từ 300K</p>
                                </div>
                            </div>
                        </div>
                        <div class="productIndfo__category ">
                            <p class="productIndfo__category-text"> Danh mục : <a href="# " class="productIndfo__category-link ">{{ $sanpham->danhmucsp_id }}</a></p>

                            <p class="productIndfo__category-text"> Số lượng đã bán :
                                <span>{{ $sanpham->soluongdaban }}</span>
                            </p>
                            <p class="productIndfo__category-text"> Số lượng trong kho :
                                <span>{{ $sanpham->soluongtrongkho }}</span>
                            </p>
                        </div>
                    </div>
                    <br>
                </div>
                @else
                <p>Sản phẩm không tồn tại.</p>
                @endif
            </div>

            <div class="productDetail">
                <div class="main__tabnine">
                    <div class="grid wide">
                        <!-- Tab items -->
                        <div class="tabs">
                            <div class="tab-item active">
                                Bình Luận
                            </div>
                            <div class="line"></div>
                        </div>
                        <!-- Tab content -->
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="productDes__ratting">
                                    <div class="productDes__ratting-title">Bình luận của bạn</div>
                                    <div class="productDes__ratting-wrap">
                                        <form action="{{ route('binhluan.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="sanpham_id" value="{{ $sanpham->sanpham_id }}">
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
                                            <div id="rating">
                                                <!-- Các input radio giữ nguyên -->
                                                <input type="radio" id="star5" name="sao" value="5" />
                                                <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                <input type="radio" id="star4" name="sao" value="4" />
                                                <label class="full" for="star4" title="Awesome - 4 stars"></label>
                                                <input type="radio" id="star3" name="sao" value="3" />
                                                <label class="full" for="star3" title="Awesome - 3 stars"></label>
                                                <input type="radio" id="star2" name="sao" value="2" />
                                                <label class="full" for="star2" title="Awesome - 2 stars"></label>
                                                <input type="radio" id="star1" name="sao" value="1" />
                                                <label class="full" for="star1" title="Awesome - 1 stars"></label>
                                            </div>
                                            <textarea class="ratecomment" name="binhluan" id="" cols="30" rows="1" placeholder="Vui lòng viết đánh giá của bạn"></textarea>
                                            <button type="submit" class="btn btn--default">Gửi</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Danh sách bình luận -->
                                <h1 style="text-align: center;font-size: 2.6rem;padding-top: 20px;">Danh sách bình luận
                                </h1>
                                <div class="dsbl">
                                    <div class="binhluan-list">
                                        @foreach ($binhluans as $binhluan)
                                        <div class="binhluan-item">
                                            <div class="binhluan-header">
                                                <div class="user-info">
                                                    <i class="icon-user"></i>
                                                    <div class="user-name" style="padding-left: 10px;font-size: 2rem;">
                                                        {{ $binhluan->user->name ?? 'Người dùng không tồn tại' }}
                                                    </div>
                                                </div>
                                                <!-- Add star rating here -->
                                                <div class="star-rating" style="font-size: 20px; color: #FFD700;padding-left: 70px;">
                                                    @for ($i = 0; $i < $binhluan->sao; $i++)
                                                        &#9733;
                                                        <!-- Unicode star character to display filled star -->
                                                        @endfor
                                                        @for ($i = $binhluan->sao; $i < 5; $i++) &#9734; <!-- Unicode star character to display empty star -->
                                                            @endfor
                                                </div>
                                                <!-- End star rating -->
                                                <p class="created-at" style="padding-left: 70px;">
                                                    {{ $binhluan->created_at }}
                                                </p>
                                            </div>
                                            <p class="binhluan-content" style="padding-left: 70px;font-size: 1.8rem;">
                                                {{ $binhluan->binhluan }}
                                            </p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
        <!-- Messenger Plugin chat Code -->
        <div id="fb-root"></div>

        <!-- Your Plugin chat code -->
        <div id="fb-customer-chat" class="fb-customerchat">
        </div>

        <script>
            function minusProduct() {
                var inputQty = document.querySelector('.input-qty');
                var currentValue = parseInt(inputQty.value);
                if (currentValue > 1) {
                    inputQty.value = currentValue - 1;
                    updateCartQuantity(currentValue - 1);
                }
            }

            function plusProduct() {
                var inputQty = document.querySelector('.input-qty');
                var currentValue = parseInt(inputQty.value);
                var maxValue = parseInt(inputQty.getAttribute('max'));
                if (currentValue < maxValue) {
                    inputQty.value = currentValue + 1;
                    updateCartQuantity(currentValue + 1);
                }
            }
        </script>

        <script>
            var chatbox = document.getElementById('fb-customer-chat');
            chatbox.setAttribute("page_id", "105913298384666");
            chatbox.setAttribute("attribution", "biz_inbox");
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml: true,
                    version: 'v10.0'
                });
            };

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <script>
            $(document).ready(function() {
                var sync1 = $("#sync1 ");
                var sync2 = $("#sync2 ");
                var slidesPerPage = 4;
                var syncedSecondary = true;
                sync1.owlCarousel({
                    items: 1,
                    loop: true,
                    margin: 20,
                    nav: true,
                    dots: false,
                    autoplay: true,
                    autoplayTimeout: 4000,
                    autoplayHoverPause: true
                })
                sync2
                    .on('initialized.owl.carousel', function() {
                        sync2.find(".owl-item ").eq(0).addClass("current ");
                    })
                    .owlCarousel({
                        items: 4,
                        dots: false,
                        nav: false,
                        margin: 30,
                        smartSpeed: 200,
                        slideSpeed: 500,
                        slideBy: 4,
                        responsiveRefreshRate: 100
                    }).on('changed.owl.carousel', syncPosition2);

                function syncPosition(el) {
                    var count = el.item.count - 1;
                    var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }

                    //end block

                    sync2
                        .find(".owl-item ")
                        .removeClass("current ")
                        .eq(current)
                        .addClass("current ");
                    var onscreen = sync2.find('.owl-item.active').length - 1;
                    var start = sync2.find('.owl-item.active').first().index();
                    var end = sync2.find('.owl-item.active').last().index();

                    if (current > end) {
                        sync2.data('owl.carousel').to(current, 100, true);
                    }
                    if (current < start) {
                        sync2.data('owl.carousel').to(current - onscreen, 100, true);
                    }
                }

                function syncPosition2(el) {
                    if (syncedSecondary) {
                        var number = el.item.index;
                        sync1.data('owl.carousel').to(number, 100, true);
                    }
                }

                sync2.on("click ", ".owl-item ", function(e) {
                    e.preventDefault();
                    var number = $(this).index();
                    sync1.data('owl.carousel').to(number, 300, true);
                });
            });

            $('.owl-carousel.hight').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 6
                    }
                }
            })

            function plusProduct() {
                var inputQty = document.querySelector('.input-qty');
                var value = parseInt(inputQty.value, 10);
                if (value < 10) {
                    value++;
                    inputQty.value = value;
                }
                toggleMinusButton(value);
            }

            function minusProduct() {
                var inputQty = document.querySelector('.input-qty');
                var value = parseInt(inputQty.value, 10);
                if (value > 1) {
                    value--;
                    inputQty.value = value;
                }
                toggleMinusButton(value);
            }

            function toggleMinusButton(value) {
                var minusButton = document.querySelector('.minus');
                if (value <= 1) {
                    minusButton.style.visibility = 'none';
                } else {
                    minusButton.style.visibility = 'inline-block';
                }
            }

            // Kích hoạt khi tải trang
            document.addEventListener('DOMContentLoaded', function() {
                toggleMinusButton(document.querySelector('.input-qty').value);
            });



            $(document).ready(function() {
                // Bắt sự kiện khi khách hàng nhấn nút "Thêm vào giỏ hàng"
                $('#addToCartBtn').on('click', function(e) {
                    e.preventDefault();

                    // Lấy ID sản phẩm
                    var productId = $(this).data('product-id');

                    // Gửi AJAX request để mua sản phẩm
                    $.ajax({
                        url: "{{ route('purchase.product') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            product_id: productId
                        },
                        success: function(response) {
                            // Xử lý thành công
                            console.log(response.message);
                        },
                        error: function(xhr, status, error) {
                            // Xử lý lỗi
                            console.error('Lỗi khi mua sản phẩm: ' + error);
                        }
                    });
                });
            });
            $(document).ready(function() {
                $('#likeButton').click(function() {
                    var productId = $(this).data('product-id');
                    $.ajax({
                        url: '/sanpham/' + productId + '/like',
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            // Update the like count UI
                            var likeCount = parseInt($('#likeCount').text());
                            likeCount++;
                            $('#likeCount').text(likeCount);
                            alert('Cảm ơn bạn đã thích sản phẩm!');
                        },
                        error: function(xhr) {
                            // Handle error
                            alert('Có lỗi xảy ra, vui lòng thử lại.');
                        }
                    });
                });
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Script common -->
        <script src="{{ asset('js/commonscript.js') }} "></script>
</body>

</html>
@endsection