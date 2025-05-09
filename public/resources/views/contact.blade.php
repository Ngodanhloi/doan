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
    <title>Liên Hệ</title>
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
    <script src="{{asset('owlCarousel/owl.carousel.min.js')}}"></script>
</head>
<div class="main">
    <div class="grid wide">
        <div class="main__breadcrumb">
            <div class="breadcrumb__item">
                <a href="#" class="breadcrumb__link">Liên hệ</a>
            </div>
        </div>
        <div class="row">
            <div class="col l-6 m-12 s-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4749789206066!2d106.75548917471203!3d10.851432489301928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752797e321f8e9%3A0xb3ff69197b10ec4f!2zVHLGsOG7nW5nIGNhbyDEkeG6s25nIEPDtG5nIG5naOG7hyBUaOG7pyDEkOG7qWM!5e0!3m2!1svi!2s!4v1711348810647!5m2!1svi!2s" width="600" height="480" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> </iframe>
            </div>
            <div class="col l-6 m-12 s-12">
                <div class="contact__wrap">
                    <div class="contact__img">
                        <img src="http://mauweb.monamedia.net/vanihome/wp-content/uploads/2018/04/logo-mona.png" alt="">
                    </div>
                    <ul class="contact__info">
                        <li class="contact__text">
                            <i class="fas fa-map-marked-alt"></i> 22/3 Võ Văn Ngân,Linh Chiểu,TP Thủ Đức
                        </li>
                        <li>
                            <a href="tel:076 922 0162" class="contact__link">
                                <i class="fas fa-phone"></i> 012 345 6789
                            </a>
                            <a href="tel:076 922 0162" class="contact__link">
                                &#8212; 023 567 8912
                            </a>
                        </li>

                        <li>
                            <a href="#" class="contact__link">
                                <i class="fas fa-envelope"></i> NhomC@mail.com
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="about-us">
                    <div class="about-us__heading">Liên hệ với chúng tôi</div>
                    <form method="POST" action="{{ route('contact.add') }}">
                        @csrf <!-- CSRF Token -->
                        <div class="form__group">
                            <div>
                                <input type="text" name="hovaten" placeholder="Họ Và Tên">
                            </div>
                            <div>
                                <input type="text" name="email" placeholder="Email">
                            </div>
                            <div>
                                <input type="text" name="diachi" placeholder="Địa chỉ">
                            </div>
                            <div>
                                <input type="text" name="sdt" placeholder="Số điện thoại">
                            </div>
                        </div>
                        <textarea name="loinhan" id="" cols="30" rows="5" placeholder="Lời nhắn"></textarea>
                        <button type="submit" class="btn btn--default">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@if(auth()->check() && auth()->user()->role === 'admin')
<div class="container">
    <h2 style="font-size: 34px; text-align: center; color: red;">Thông tin liên hệ</h2>
    <div class="contact-wrapper">
        @foreach ($contact as $row)
        <ul class="contact-list">
            <li class="contact-item">
                <label>Họ và tên:</label>
                <span>{{ $row->hovaten }}</span>
            </li>
            <li class="contact-item">
                <label>Email:</label>
                <span>{{ $row->email }}</span>
            </li>
            <li class="contact-item">
                <label>Địa chỉ:</label>
                <span>{{ $row->diachi }}</span>
            </li>
            <li class="contact-item">
                <label>Số điện thoại:</label>
                <span>{{ $row->sdt }}</span>
            </li>
            <li class="contact-item">
                <label>Lời nhắn:</label>
                <span>{{ $row->loinhan }}</span>
            </li>
            <li class="contact-item">
                <label>Ngày tạo:</label>
                <span>{{ $row->created_at }}</span>
            </li>
        </ul>
        @endforeach
    </div>
</div>
@endif
</div>
@endsection