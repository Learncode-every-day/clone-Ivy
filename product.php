<?php

if (basename(__FILE__) === "product.php") {
    // Tắt hiển thị lỗi
    ini_set('display_errors', 0);
    error_reporting(0);  // Tắt tất cả các loại lỗi

    // Hoặc chỉ tắt các loại lỗi cảnh báo (warnings)
    ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_PARSE);  // Chỉ hiển thị lỗi nghiêm trọng

    include './admin/database.php';
    include "./admin/class/category_class.php";
    include "./admin/class/brand_class.php";
    include "./admin/class/product_class.php";
    $category = new Category();
    $brand = new Brand();
    $product = new Product();
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/reset.css" />
    <link rel="stylesheet" href="./assets/css/styles.css" />
    <link rel="stylesheet" href="./assets/css/product.css" />
    <title>Ivy-Project | Product</title>
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

    <!-- Product -->
    <section class="product">
        <div class="container">
            <div class="product-top row">
                <p>
                    Trang chủ <span>&rarr;</span> Nữ
                    <span>&rarr;</span> Hàng nữ mới <span>&rarr;</span> Áo
                    thun cổ tròn
                </p>
            </div>
            <div class="product-content row">
                <div class="product-content-left row">
                    <div class="product-content-left__big-img">
                        <img src="./assets/img/category-img/pic1_1.jpg" alt="" />
                    </div>
                    <div class="product-content-left__small-img">
                        <img src="./assets/img/category-img/pic1_1.jpg" alt="" />
                        <img src="./assets/img/category-img/pic1_2.jpg" alt="" />
                        <img src="./assets/img/category-img/pic1_3.jpg" alt="" />
                        <img src="./assets/img/category-img/pic1_4.jpg" alt="" />
                    </div>
                </div>
                <div class="product-content-right">
                    <div class="product-content-right__product-name">
                        <h1>Áo thun cổ tròn MS 57e2969</h1>
                        <p>MSP: 57e2969</p>
                        <div class="product-content-right__product-price">
                            <p>1.500.000 <sup>đ</sup></p>
                        </div>
                        <div class="product-content-right__product-color">
                            <span style="font-weight: bold">Màu sắc</span>:
                            Xanh Cổ Vịt Nhạt
                            <span style="color: red">*</span>
                            <div class="product-content-right__product-color-img">
                                <img src="./assets/img/color.jpg" alt="" />
                            </div>
                        </div>
                        <div class="product-content-right__product-size">
                            <p style="font-weight: bold">Size:</p>
                            <div class="size">
                                <span>S</span>
                                <span>M</span>
                                <span>L</span>
                                <span>XL</span>
                                <span>XXL</span>
                            </div>
                        </div>
                        <div class="quantity">
                            <p style="font-weight: bold">Số lượng:</p>
                            <input type="number" name="" id="" min="0" value="1" />
                            <p style="
                                        color: red;
                                        width: 100%;
                                        margin-top: 5px;
                                    ">
                                Vui lòng chọn size *
                            </p>
                        </div>
                        <div class="product-content-right__product-button">
                            <button>
                                <img src="./assets/icons/cart-shopping.svg" alt="" class="cart-icon" />
                                <p>Mua hàng</p>
                            </button>
                            <button>
                                <p>Tìm tại cửa hàng</p>
                            </button>
                        </div>
                        <div class="product-content-right__product-icon">
                            <div class="product-content-right__product-icon-item">
                                <img src="./assets/icons/phone.svg" alt="" class="phone-icon" />
                                <p>Hotline</p>
                            </div>
                            <div class="product-content-right__product-icon-item">
                                <img src="./assets/icons/comment.svg" alt="" class="comment-icon" />
                                <p>Chat</p>
                            </div>
                            <div class="product-content-right__product-icon-item">
                                <img src="./assets/icons/envelop.svg" alt="" class="envelop-icon" />
                                <p>Mail</p>
                            </div>
                        </div>
                        <div class="product-content-right-product-QR">
                            <img style="
                                        height: 50px;
                                        width: 50px;
                                        object-fit: cover;
                                    " src="./assets/img/qr-code.png" alt="" />
                        </div>
                        <div class="product-content-right-bottom">
                            <div class="product-content-right-bottom-top">
                                <img src="./assets/icons/chevron-down.svg" alt="" class="chevron-down-icon" />
                            </div>
                            <div class="product-content-bottom-content-big">
                                <div class="product-content-right-bottom-content-title row">
                                    <div class="product-content-right-bottom-content-title-item chitiet">
                                        <p>Chi tiết</p>
                                    </div>
                                    <div class="product-content-right-bottom-content-title-item baoquan">
                                        <p>Bảo quản</p>
                                    </div>
                                    <div class="product-content-right-bottom-content-title-item">
                                        <p>Tham khảo size</p>
                                    </div>
                                </div>
                                <div class="product-content-right-bottom-content">
                                    <div class="product-content-right-bottom-content-info">
                                        Lorem ipsum dolor sit amet
                                        consectetur adipisicing elit.
                                        Laboriosam quaerat recusandae beatae
                                        architecto accusamus id aut illo,
                                        eligendi aliquid incidunt?
                                        Praesentium eligendi sunt nostrum
                                        optio minus veritatis aut architecto
                                        earum? Chi tiết
                                    </div>
                                    <div class="product-content-right-bottom-content-sub">
                                        Lorem ipsum dolor sit amet
                                        consectetur adipisicing elit. Eaque
                                        aliquid doloremque quia quam ratione
                                        voluptate? Accusamus, eaque labore?
                                        A soluta quod quae, unde nulla optio
                                        deserunt praesentium quaerat ut
                                        dolorum? Bảo quản
                                    </div>
                                    <div class="product-content-right-bottom-content-size"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product related -->
    <section class="product-related">
        <div class="container">
            <div class="product-related-title">
                <p>Sản phẩm liên quan</p>
            </div>
            <div class="product-content row">
                <div class="product-related-item">
                    <img src="./assets/img/category-img/pic1_2.jpg" alt="" />
                    <h1>Áo thun cổ tròn</h1>
                    <p>1.200.000 <sup>đ</sup></p>
                </div>
                <div class="product-related-item">
                    <img src="./assets/img/category-img/pic1_2.jpg" alt="" />
                    <h1>Áo thun cổ tròn</h1>
                    <p>1.200.000 <sup>đ</sup></p>
                </div>
                <div class="product-related-item">
                    <img src="./assets/img/category-img/pic1_2.jpg" alt="" />
                    <h1>Áo thun cổ tròn</h1>
                    <p>1.200.000 <sup>đ</sup></p>
                </div>
                <div class="product-related-item">
                    <img src="./assets/img/category-img/pic1_2.jpg" alt="" />
                    <h1>Áo thun cổ tròn</h1>
                    <p>1.200.000 <sup>đ</sup></p>
                </div>
                <div class="product-related-item">
                    <img src="./assets/img/category-img/pic1_2.jpg" alt="" />
                    <h1>Áo thun cổ tròn</h1>
                    <p>1.200.000 <sup>đ</sup></p>
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
<script src="./assets/js/product.js"></script>

</html>