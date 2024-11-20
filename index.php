<?php
// Liên kết với các  class trong folder admin để dễ làm việc với database trong CSDL
// include './admin/class/category_class.php';

// $category = new Category();

// $show_category = $category->show_category();
// $result_category = $show_category->fetch_assoc();
// echo basename(__FILE__);

if (basename(__FILE__) === "index.php") {
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/reset.css" />
    <link rel="stylesheet" href="./assets/css/styles.css" />
    <title>Ivy-Project</title>
    <link rel="apple-touch-icon" sizes="57x57" href="./assets/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="./assets/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="./assets/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="./assets/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="./assets/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="./assets/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="./assets/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="./assets/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./assets/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="./assets/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="./assets/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <div class="menu">
                    <ul class="menu__list">
                        <?php
                        $show_category = $category->show_category();
                        if ($show_category) {
                            while ($result = $show_category->fetch_assoc()) {
                        ?>
                                <li class="menu__item">
                                    <a href="#!" class="menu__link"><?php echo $result['category_name']; ?></a>
                                    <ul class="sub-menu">
                                        <?php
                                        $show_brand = $brand->show_brand();
                                        if ($show_brand) {
                                            while ($resultA = $show_brand->fetch_assoc()) {
                                        ?>
                                                <?php if ($result['category_id'] === $resultA['category_id']) { ?>
                                                    <li class="sub-menu__item">
                                                        <a href="#!" class="sub-menu__link"><?php echo $resultA['brand_name']; ?></a>
                                                        <ul class="sub-menu-clone">
                                                            <?php $show_product = $product->show_product();
                                                            if ($show_product) {
                                                                while ($resultB = $show_product->fetch_assoc()) {
                                                                    if ($resultA['brand_id'] === $resultB['brand_id']) {
                                                            ?>
                                                                        <li class="sub-menu-clone__item">
                                                                            <a href="#!" class="sub-menu-clone__link">
                                                                                <?php echo $resultB['product_name']; ?>
                                                                            </a>
                                                                        </li>
                                                            <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </li>
                                                <?php } ?>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>

                <div class="logo">
                    <a href="#">
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

    <!-- Slider -->
    <section id="slider">
        <div class="container">
            <div class="slider__inner">
                <!-- Sử dụng aspect ratio để căn ảnh cho dễ responsive -->
                <div class="aspect-ratio-169">
                    <img src="./assets/img/slider-1.webp" alt="" />
                    <img src="./assets/img/slider-2.webp" alt="" />
                    <img src="./assets/img/slider-3.webp" alt="" />
                    <img src="./assets/img/slider-4.webp" alt="" />
                </div>
                <!-- Thẻ dot dưới để di chuyển trong slider -->
                <div class="dot-container">
                    <div class="dot active"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
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