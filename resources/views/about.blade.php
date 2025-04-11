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
    <title>BeautyFly - Thương hiệu mỹ phẩm</title>
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

<body>
    
    <div class="container">
        <h1>BeautyFly - Thương hiệu mỹ phẩm hàng đầu</h1>
        <p>BeautyFly là một thương hiệu mỹ phẩm nổi tiếng với nhiều năm kinh nghiệm trong ngành. Chúng tôi cam kết mang đến sự hoàn hảo cho khách hàng và làm đẹp cho mọi phụ nữ.</p>
        
        <h2>Các năm hoạt động</h2>
        <p>BeautyFly đã hoạt động từ năm 20XX và không ngừng phát triển hơn từng ngày.</p>
        
        <h2>Thành tựu</h2>
        <p>BeautyFly đã đạt được nhiều thành tựu lớn trong ngành mỹ phẩm, được công nhận bởi cộng đồng và các chuyên gia.</p>
        
        <h2>Cơ sở và Doanh thu</h2>
        <p>Hiện tại, BeautyFly có cơ sở sản xuất hiện đại với doanh thu ấn tượng hàng năm.</p>
        
        <h2>Giá trị của BeautyFly</h2>
        <p>BeautyFly cam kết mang đến sản phẩm chất lượng cao, an toàn và hiệu quả. Chúng tôi tin rằng mọi phụ nữ đều xứng đáng sở hữu vẻ đẹp tự nhiên và rạng ngời.</p>
    </div>
    
</body>
</html>

<style>
    /* Reset default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Custom CSS for BeautyFly website */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f8f9fa;
    color: #333;
    margin: 0;
    padding: 0;
    font-size: 1.3rem;
    font-weight: 300;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1, h2, p {
    color: #333;
}

h1 {
    font-size: 2.5em;
    text-align: center;
    margin-bottom: 20px;
}

h2 {
    color: #007bff;
    font-size: 1.5em;
    margin-top: 20px;
}

p {
    font-size: 1.1em;
    line-height: 1.6;
}

.navbar {
    background-color: #007bff;
}

.navbar-brand {
    color: #fff;
    font-size: 2em;
    font-weight: bold;
}

.navbar-brand:hover {
    color: #e9ecef;
}

</style>
@endsection
