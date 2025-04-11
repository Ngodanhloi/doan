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
    <title>Tin Tức</title>
    <!-- Font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Icon fontanwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Reset css & grid sytem -->
    <link rel="stylesheet" href="css/library.css">
    <!-- Owl Slider css -->
    <link rel="stylesheet" href="{{ asset('owlCarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('owlCarousel/assets/owl.theme.default.min.css')}}">
    <!-- Layout -->
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    <!-- index -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/new.css')}}">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl caroucel Js-->
    <script src="{{ asset('owlCarousel/owl.carousel.min.js')}}"></script>
</head>

<body>
    <div class="main">
        <div class="grid wide">
            <div class="main__taskbar">
                <div class="main__breadcrumb">
                    <div class="breadcrumb__item">
                        <a href="#" class="breadcrumb__link">Trang chủ</a>
                    </div>
                    <div class="breadcrumb__item">
                        <a href="#" class="breadcrumb__link">Danh sách tin tức</a>
                    </div>
                </div>
            </div>

            <div class="list-new">
                @foreach($news as $new)
                <div href="#" class="new-item">
                    <a href="#" class="new-item__img">
                        <img src="{{ asset('img/' . $new->image_url)}}" alt="">
                    </a>
                    <div class="new-item__body">
                        <a href="#" class="new-item__title">
                            {{$new->title}}
                        </a>
                        <p class="new-item__time"> Ngày đăng: {{$new->posted_date }}</p>
                        <p class="new-item__description">
                            {{$new->description}}
                        </p>
                        <p class="new-item__content">{{$new->content}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
</body>

</html>
@endsection