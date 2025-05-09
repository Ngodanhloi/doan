<div class="footer">
    <div class="grid wide">
        <div class="row">
            <div class="col l-3 m-6 s-12">
                <h3 class="footer__title">Menu</h3>
                <ul class="footer__list">
                    <li class="footer__item">
                        <a href="#" class="footer__link">Trang điểm</a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">Chăm sóc da</a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">Chăm sóc tóc</a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">Nước hoa</a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">Chăm sóc toàn thân </a>
                    </li>
                </ul>
            </div>
            <div class="col l-3 m-6 s-12">
                <h3 class="footer__title">Hỗ trợ khách hàng</h3>
                <ul class="footer__list">
                    <li class="footer__item">
                        <a href="#" class="footer__link">Hướng dẫn mua hàng</a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">Giải đáp thắc mắc</a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">Chính sách mua hàng</a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">Chính sách đổi trả</a>
                    </li>
                </ul>
            </div>
            <div class="col l-3 m-6 s-12">
                <h3 class="footer__title">Liên hệ</h3>
                <ul class="footer__list">
                    <li class="footer__item">
                        <span class="footer__text">
                            <i class="fas fa-map-marked-alt"></i> 22/3 Võ Văn Ngân,Linh Chiểu,TP Thủ Đức
                        </span>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">
                            <i class="fas fa-phone"></i> 012 345 6789
                        </a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">
                            <i class="fas fa-envelope"></i> nhomC@mail.com
                        </a>
                    </li>
                    <li class="footer__item">
                        <div class="social-group">
                            <a href="#" class="social-item"><i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-item"><i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-item"><i class="fab fa-pinterest-p"></i>
                            </a>
                            <a href="#" class="social-item"><i class="fab fa-invision"></i>
                            </a>
                            <a href="#" class="social-item"><i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col l-3 m-6 s-12">
                <h3 class="footer__title">Đăng ký</h3>
                <ul class="footer__list">
                    <li class="footer__item">
                        <span class="footer__text">Đăng ký để nhận được thông tin ưu đãi mới nhất từ chúng tôi.</span>
                    </li>
                    <li class="footer__item">
                        <form id="subscribeForm">
                            <div class="send-email" style="background: #000;">
                                <input id="emailInput" class="send-email__input" type="email" placeholder="Nhập Email...">
                                <button id="subscribeBtn" type="button" class="send-email__link">
                                    <i class="fas fa-paper-plane" style="color: white;"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <hr style="margin-bottom: 5px;">
    <div class="copyright">
        <span class="footer__text" style="color: white;"> &copy Bản quyền thuộc về <a class="footer__link1" href="#" style="color:aliceblue">Nhóm C</a></span>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#subscribeBtn').click(function() {
            var email = $('#emailInput').val();
            $.ajax({
                url: "{{ route('subscribe') }}", // Thay thế đường dẫn này bằng đường dẫn thực tế của bạn
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email
                },
                success: function(response) {
                    alert('Đăng ký thành công!'); // Thông báo cho người dùng
                    $('#emailInput').val(''); // Xóa trường nhập email sau khi đăng ký thành công
                },
                error: function(xhr, status, error) {
                    console.log('Lỗi khi đăng ký: ' + xhr.responseText);
                    alert('Đăng ký không thành công! Chi tiết lỗi: ' + xhr.responseText);
                }
            });
        });
    });
</script>