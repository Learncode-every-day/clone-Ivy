<?php

session_start();

// include "";
// Tắt hiển thị lỗi
ini_set('display_errors', 0);
error_reporting(0);  // Tắt tất cả các loại lỗi

// Hoặc chỉ tắt các loại lỗi cảnh báo (warnings)
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_PARSE);  // Chỉ hiển thị lỗi nghiêm trọng

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/reset.css" />
    <link rel="stylesheet" href="./assets/css/styles.css" />
    <link rel="stylesheet" href="./assets/css/cart.css" />
    <title>Ivy-Project | Cart</title>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <div class="menu">
                    <ul class="menu__list">
                        <li class="menu__item">
                            <a href="#!" class="menu__link">Nữ</a>
                            <ul class="sub-menu">
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Hàng mới về</a>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Collection</a>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Áo</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo sơ mi</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo thun</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo croptop</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo peplum</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo len</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Đầm / Áo dài</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Váy đầm nữ</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Đầm công sở</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Đầm voan hoa / maxi</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Đầm thun</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo dài</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Áo khoác</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo vest / blazer</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo dạ / măng tô</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Set bộ</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Set bộ công sở</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Set bộ co-ords</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Set bộ thun / len</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Quần & Jumpsuit</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Quần dài</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Quần jeans</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Quần lửng / short</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Jumpsuit</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Chân váy</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Chân váy bút chì</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Chân váy chữ A</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Chân váy jeans</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Senora</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Senora - Đầm dạ hội</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Phụ kiện</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Đồ lót</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Phụ kiện</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Giày / dép & Sandals</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Túi / ví</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu__item">
                            <a href="#!" class="menu__link">Nam</a>
                            <ul class="sub-menu">
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Hàng mới về</a>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Collection</a>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Áo</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo sơ mi</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo thun</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo croptop</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo peplum</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo len</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Đầm / Áo dài</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Váy đầm nữ</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Đầm công sở</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Đầm voan hoa / maxi</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Đầm thun</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo dài</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Áo khoác</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo vest / blazer</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Áo dạ / măng tô</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Set bộ</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Set bộ công sở</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Set bộ co-ords</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Set bộ thun / len</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Quần & Jumpsuit</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Quần dài</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Quần jeans</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Quần lửng / short</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Jumpsuit</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Chân váy</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Chân váy bút chì</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Chân váy chữ A</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Chân váy jeans</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Senora</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Senora - Đầm dạ hội</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sub-menu__item">
                                    <a href="#!" class="sub-menu__link">Phụ kiện</a>
                                    <ul class="sub-menu-clone">
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Đồ lót</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Phụ kiện</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Giày / dép & Sandals</a>
                                        </li>
                                        <li class="sub-menu-clone__item">
                                            <a href="#!" class="sub-menu-clone__link">Túi / ví</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu__item">
                            <a href="#!" class="menu__link">Trẻ em</a>
                        </li>
                        <li class="menu__item">
                            <a href="#!" class="menu__link">Sale</a>
                        </li>
                        <li class="menu__item">
                            <a href="#!" class="menu__link">Khẩu Trang</a>
                        </li>
                        <li class="menu__item">
                            <a href="#!" class="menu__link">Bộ sưu tập</a>
                        </li>
                        <li class="menu__item">
                            <a href="#!" class="menu__link">Thông tin</a>
                        </li>
                    </ul>
                </div>

                <div class="logo">
                    <a href="#!">
                        <img src="./assets/img/logo.png" alt="" class="logo__icon" />
                    </a>
                </div>

                <div class="other">
                    <ul class="other__list">
                        <li class="other__item">
                            <input type="text" name="" id="" class="search-box" placeholder="Tìm kiếm" />
                            <a href="#!">
                                <img src="./assets/icons/search.svg" alt="" class="search-icon" />
                            </a>
                        </li>
                        <li class="other__item">
                            <a href="#!" class="other__link">
                                <img src="./assets/icons/bell.svg" alt="" class="bell-icon" />
                            </a>
                        </li>
                        <li class="other__item">
                            <a href="#!" class="other__link"><img src="./assets/icons/user.svg" alt=""
                                    class="user-icon" /></a>
                        </li>
                        <li class="other__item">
                            <a href="#!" class="other__link"><img src="./assets/icons/cart-shopping.svg" alt=""
                                    class="cart-icon" /></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Cart -->
    <section class="cart">
        <div class="container">
            <div class="cart-top-wrap">
                <div class="cart-top">
                    <div class="cart-top-cart">
                        <img src="./assets/icons/cart-shopping.svg" alt="" class="cart-icon" />
                    </div>
                    <div class="cart-top-cart">
                        <img src="./assets/icons/location.svg" alt="" class="location-icon" />
                    </div>
                    <div class="cart-top-cart">
                        <img src="./assets/icons/credit-card.svg" alt="" class="credit-icon" />
                    </div>
                </div>
            </div>
            <div class="cart-content row">
                <div class="cart-content-left">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Màu</th>
                                <th>Size</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="./assets/img/category-img/pic1_1.jpg" alt="" />
                                </td>
                                <td>
                                    <p>Quần Sock</p>
                                </td>
                                <td>
                                    <img style="
                                                display: block;
                                                width: 20px;
                                                height: 20px;
                                                border-radius: 50%;
                                            " src="./assets/img/color.jpg" alt="" />
                                </td>
                                <td>
                                    <p>L</p>
                                </td>
                                <td>
                                    <input type="number" value="1" min="1" />
                                </td>
                                <td>
                                    <p>489.000 <sup>đ</sup></p>
                                </td>
                                <td>
                                    <span>X</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="cart-content-right">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2">Tổng tiền giỏ hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tổng sản phẩm</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Tổng tiền hàng</td>
                                <td>
                                    <p>489.000 <sup>đ</sup></p>
                                </td>
                            </tr>
                            <tr>
                                <td>Thành tiền</td>
                                <td>1.500.000 <sup>đ</sup></td>
                            </tr>
                            <tr>
                                <td>Tạm tính</td>
                                <td>
                                    <p style="
                                                color: #000;
                                                font-weight: bold;
                                            ">
                                        489.000 <sup>đ</sup>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cart-content-right-text">
                        <p>
                            Bạn sẽ được miễn phí ship khi đơn hàng có tổng
                            giá trị trên 2.000.000đ
                        </p>
                        <p style="color: red; font-weight: bold">
                            Mua thêm
                            <span style="font-size: 1.8rem">131.000đ</span>
                            để được miễn phí SHIP
                        </p>
                    </div>
                    <div class="cart-content-right-button">
                        <button>Tiếp tục mua sắm</button>
                        <button>Thanh toán</button>
                    </div>
                    <div class="cart-content-right-log-in">
                        <p>Tài khoản IVY</p>
                        <p>
                            Hãy <a href="#!"> Đăng nhập</a> tài khoản để
                            tích điểm thành viên
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <!-- App -->
        <section class="app-container">
            <p class="app-container__desc">Tải ứng dụng IVY moda</p>
            <div class="app-google">
                <a href="#!"><img src="./assets/img/googleplay.png" alt="" /></a>
                <a href="#!"><img src="./assets/img/appstore.png" alt="" /></a>
            </div>
            <p class="app-container__desc">Nhận bản tin IVY moda</p>
            <input type="text" placeholder="Nhập email của bạn..." />
        </section>

        <div class="footer-top">
            <ul class="footer-top__list">
                <li class="footer-top__item">
                    <a href="#!"><img src="./assets/img/img-congthuong.png" alt="" /></a>
                </li>
                <li class="footer-top__item">
                    <a href="#!">Liên hệ</a>
                </li>
                <li class="footer-top__item">
                    <a href="#!">Tuyển dụng</a>
                </li>
                <li class="footer-top__item">
                    <a href="#!">Giới thiệu</a>
                </li>
                <li class="footer-top__item">
                    <a href="#!">
                        <img src="./assets/icons/facebook.svg" alt="Facebook" class="footer__icon" />
                    </a>
                </li>
                <li class="footer-top__item">
                    <a href="#!">
                        <img src="./assets/icons/twitter.svg" alt="Twitter" class="footer__icon" />
                    </a>
                </li>
                <li class="footer-top__item">
                    <a href="#!">
                        <img src="./assets/icons/youtube.svg" alt="Youtube" class="footer__icon" />
                    </a>
                </li>
            </ul>
        </div>
        <div class="footer-center">
            <p class="footer-address">
                Công ty Cổ phần Dự Kim với số đăng ký kinh doanh:
                <a href="tel: 0105777650">0105777650</a>
                <br />
                Địa chỉ đăng ký: Tổ dân phố Tháp, P.Đại Mỗ, Q.Nam Từ Liêm,
                TP Hà Nội, Việt Nam -
                <a href="tel: 02432052222">0243 205 2222</a> <br />
                Đặt hàng online:
                <a href="tel: 02466623434">0246 662 3434</a>
            </p>
        </div>
        <div class="footer-bottom">@Ivymoda All rights reserved</div>
    </footer>
</body>
<script src="./assets/js/slider.js"></script>
<script>
    const header = document.querySelector("header");
    window.addEventListener("scroll", function() {
        // Bắt được tọa độ khi di chuyển lên xuống theo chiều dọc - y
        x = window.pageYOffset;
        if (x > 0) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    });
</script>

</html>