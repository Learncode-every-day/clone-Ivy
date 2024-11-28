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
    $get_product_id = $_GET['product_id'];
    $show_all_product = $product->show_product();
    if ($show_all_product) {
        while ($result = $show_all_product->fetch_assoc()) {
            // echo $result['product_name'];
            if ($result['product_id'] === $get_product_id) {
                $get_category_id = $result['category_id'];
                $get_brand_id = $result['brand_id'];
            }
        }
    }
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
    <link rel="stylesheet" href="./assets/css/dropdown.css">
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
                                    <a href="http://localhost/clone-Ivy/category.php?category_id=<?php echo $result['category_id'] ?>"
                                        class="menu__link"><?php echo $result['category_name']; ?></a>
                                    <ul class="sub-menu">
                                        <?php
                                        $show_brand = $brand->show_brand();
                                        if ($show_brand) {
                                            while ($resultA = $show_brand->fetch_assoc()) {
                                        ?>
                                                <?php if ($result['category_id'] === $resultA['category_id']) { ?>
                                                    <li class="sub-menu__item">
                                                        <a href="http://localhost/clone-Ivy/category.php?brand_id=<?php echo $resultA['brand_id'] ?>&category_id=<?php echo $resultA['category_id'] ?>"
                                                            class="sub-menu__link"><?php echo $resultA['brand_name']; ?></a>
                                                        <ul class="sub-menu-clone">
                                                            <?php $show_product = $product->show_product();
                                                            if ($show_product) {
                                                                while ($resultB = $show_product->fetch_assoc()) {
                                                                    if ($resultA['brand_id'] === $resultB['brand_id']) {
                                                            ?>
                                                                        <li class="sub-menu-clone__item">
                                                                            <a href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $resultB['product_id'] ?>&brand_id=<?php echo $resultB['brand_id'] ?>&category_id=<?php echo $resultB['category_id'] ?>"
                                                                                class="sub-menu-clone__link">
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
                        <li class="other__item" style="position: relative;">
                            <form method="post" id="form-search">
                                <input type="text" name="content" id="search-input" class="search-box"
                                    placeholder="Tìm kiếm" />
                                <button type="submit" name="btn-search" id="btn-search">
                                    <img src="./assets/icons/search.svg" alt="" class="search-icon" />
                                </button>
                            </form>
                            <br>
                            <!-- Lấy nội dung phần tìm kiếm -->
                            <?php
                            if (isset($_POST['btn-search'])) {
                                $content = $_POST['content'];
                                // echo $content;
                            } else {
                                $content = false;
                            }
                            ?>
                            <div hidden id="search-table"
                                style="display: none; position: absolute; top:35px;max-height: 250px; overflow-y:auto;">
                                <table class="item-search__list"
                                    style="font-size: 1.1rem; background: #fff; text-align: center;">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Hình ảnh</th>
                                            <th>Giá sản phẩm</th>
                                            <th>Giá sau khi giảm</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        // Bắt đầu sử dụng truy vấn để lấy sản phẩm
                                        $show_product_by_content = $product->get_product_by_content($content);
                                        if ($show_product_by_content) {
                                            while ($result = $show_product_by_content->fetch_assoc()) {
                                        ?>
                                                <tr class="item-search__item">

                                                    <td class="item-search__name"><a
                                                            href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id'] ?>"><?php echo $result['product_name'] ?></a>
                                                    </td>
                                                    <td style="display: flex; align-items:center; justify-content: center;">
                                                        <a
                                                            href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id'] ?>">
                                                            <img style="width: 50px; object-fit:contain; "
                                                                src="./admin/uploads/<?php echo $result['product_img'] ?>"
                                                                alt="">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id'] ?>">
                                                            <?php echo $result['product_price'] ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id'] ?>">
                                                            <?php echo $result['product_price_sale'] ?>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </li>
                        <li class="other__item">
                            <a href="#!" class="other__link">
                                <img src="./assets/icons/bell.svg" alt="" class="bell-icon" />
                            </a>
                        </li>
                        <li class="other__item">
                            <div class="dropdown">
                                <div class="dropdown__select">
                                    <!-- <span class="dropdown_selected">Call to action</span>
                                    <i class="fa fa-caret-down dropdown__caret"></i> -->
                                    <a href="#!" class="other__link">
                                        <img src="./assets/icons/user.svg" alt="" class="user-icon" />
                                    </a>
                                </div>
                                <ul class="dropdown__list">
                                    <li class="dropdown__item">
                                        <a href="http://localhost/clone-Ivy/index.php">
                                            <span class="dropdown__text">Trang chủ</span>
                                            <i class="fa fa-plus-circle dropdown__icon"></i>
                                        </a>
                                    </li>
                                    <li class="dropdown__item">
                                        <span class="dropdown__text">Thông tin tài khoản</span>
                                        <i class="fa fa-plus-circle dropdown__icon"></i>
                                    </li>
                                    <li class="dropdown__item">
                                        <a href="http://localhost/clone-Ivy/logout.php">
                                            <span class="dropdown__text">Đăng xuất</span>
                                            <i class="fa fa-plus-circle dropdown__icon"></i>
                                        </a>
                                    </li>
                                    <li class="dropdown__item">
                                        <a href="http://localhost/clone-Ivy/admin/category-add.php">
                                            <span class="dropdown__text">Vào trang quản lý</span>
                                            <i class="fa fa-plus-circle dropdown__icon"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="other__item">
                            <a href="http://localhost/clone-Ivy/cart.php" class="other__link"><img
                                    src="./assets/icons/cart-shopping.svg" alt="" class="cart-icon" />
                            </a>
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
                    Trang chủ <span>&rarr;</span>
                    <?php

                    $show_category = $category->show_category();
                    if ($show_category) {
                        while ($resultA = $show_category->fetch_assoc()) {
                            // var_dump($resultA['category_name']);
                            if ($get_category_id) {
                                if ($resultA['category_id'] === $get_category_id) {
                                    echo $resultA['category_name'];
                                    if ($get_brand_id) {
                                        $show_brand = $brand->show_brand();
                                        if ($show_brand) {
                                            while ($resultB = $show_brand->fetch_assoc()) {
                                                if ($resultB['brand_id'] === $get_brand_id) {
                                                    echo "<span>&rarr;</span>" . $resultB['brand_name'];
                                                    if ($get_product_id) {
                                                        $show_product = $product->show_product();
                                                        while ($resultC = $show_product->fetch_assoc()) {
                                                            if ($resultC['product_id'] === $get_product_id) {
                                                                echo "<span>&rarr;</span>" . $resultC['product_name'];
                                                            }
                                                        }
                                                    }
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    break;
                                }
                            }
                        }
                    }
                    ?>
                    <!-- <span>&rarr;</span> Hàng nữ mới -->
                </p>
            </div>
            <div class="product-content row">
                <div class="product-content-left row">
                    <?php
                    $show_product = $product->show_product();
                    if ($show_product) {
                        while ($result = $show_product->fetch_assoc()) {
                            if ($result['product_id'] === $get_product_id) {
                    ?>
                                <div class="product-content-left__big-img">
                                    <img src="./admin/uploads/<?php echo $result['product_img'] ?>" alt="" />
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>
                    <div class="product-content-left__small-img" style="max-height: 642px; overflow-y: auto;">
                        <?php
                        $get_img = $product->get_img($get_product_id);
                        if ($get_img) {
                            while ($result = $get_img->fetch_assoc()) {
                        ?>
                                <img src="./admin/uploads/<?php echo $result['product_img_desc'] ?>" alt="" />

                        <?php
                            }
                        }
                        ?>
                        <!-- <img src="./assets/img/category-img/pic1_2.jpg" alt="" />
                        <img src="./assets/img/category-img/pic1_3.jpg" alt="" />
                        <img src="./assets/img/category-img/pic1_4.jpg" alt="" /> -->
                    </div>
                </div>
                <div class="product-content-right">
                    <div class="product-content-right__product-name">
                        <?php
                        $show_product = $product->show_product();
                        if ($show_product) {
                            while ($result = $show_product->fetch_assoc()) {
                                if ($result['product_id'] === $get_product_id) {
                        ?>
                                    <h1><?php echo $result['product_name'] ?></h1>

                                    <div class="product-content-right__product-price">
                                        <p>
                                            <?php
                                            $get_string_price = $result['product_price'];
                                            echo strtok($get_string_price, "đ");
                                            ?>
                                            <sup>đ</sup>
                                        </p>
                                    </div>
                                    <div class="quantity">
                                        <p style="font-weight: bold">Số lượng:</p>
                                        <input type="number" name="count" id="" min="0" value="1" />
                                        <p style="
                                        color: red;
                                        width: 100%;
                                        margin-top: 5px;
                                    ">
                                        </p>
                                    </div>
                        <?php
                                }
                            }
                        }
                        ?>
                        <div class="product-content-right__product-button">
                            <a href="http://localhost/clone-Ivy/payment.html">
                                <button>
                                    <img src="./assets/icons/cart-shopping.svg" alt="" class="cart-icon" />
                                    <p>Mua hàng</p>
                                </button>
                            </a>
                            <!-- <button>
                                <p>Tìm tại cửa hàng</p>
                            </button> -->
                        </div>
                        <div class="product-content-right__product-icon">
                            <a href="tel:099999999">
                                <div class="product-content-right__product-icon-item">
                                    <img src="./assets/icons/phone.svg" alt="" class="phone-icon" />
                                    <p>Hotline</p>
                                </div>
                            </a>
                            <a href="#!">
                                <div class="product-content-right__product-icon-item">
                                    <img src="./assets/icons/comment.svg" alt="" class="comment-icon" />
                                    <p>Chat</p>
                                </div>
                            </a>
                            <a href="mailto:a@gmail.com">
                                <div class="product-content-right__product-icon-item">
                                    <img src="./assets/icons/envelop.svg" alt="" class="envelop-icon" />
                                    <p>Mail</p>
                                </div>
                            </a>
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
                                    <div class="product-content-right-bottom-content-title-item thamkhao">
                                        <p>Tham khảo size</p>
                                    </div>
                                </div>
                                <div class="product-content-right-bottom-content">
                                    <div class="product-content-right-bottom-content-info">
                                        <?php
                                        $show_product = $product->show_product();
                                        if ($show_product) {
                                            while ($result = $show_product->fetch_assoc()) {
                                                if ($result['product_id'] === $get_product_id) {
                                                    echo $result['product_desc'];
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="product-content-right-bottom-content-sub">
                                        Bảo quản
                                    </div>
                                    <div class="product-content-right-bottom-content-size">
                                        Tham khảo size
                                    </div>
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
<script>
    // Xử lý phần hiển thị bảng tìm kiếm
    const inputSearch = document.getElementById("search-input");
    const tableSearch = document.getElementById("search-table");

    inputSearch.addEventListener("input", function() {
        // console.log("Đã bắt đầu sự kiện");
        const query = this.value.trim(); // Lấy giá trị người dùng nhập
        if (query === "") {
            tableSearch.style.display = "none";
            return;
        }

        // Gửi yêu cầu AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "search_handler.php", true); // `search_handler.php` là file xử lý kết quả tìm kiếm
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log("a");
                console.log(xhr.responseText); // Kiểm tra dữ liệu trả về
                if (xhr.responseText.trim() !== "") {
                    tableSearch.innerHTML = xhr.responseText;
                    tableSearch.style.display = "block";
                    document.addEventListener("click", function(event) {
                        // Kiểm tra xem click có phải là ngoài input hoặc bảng tìm kiếm không
                        if (!tableSearch.contains(event.target) && event.target !== inputSearch) {
                            tableSearch.style.display = "none"; // Ẩn bảng khi click ra ngoài
                        }
                    });

                } else {
                    tableSearch.style.display = "none"; // Ẩn bảng nếu không có kết quả
                }
            }
        };


        xhr.send(`query=${encodeURIComponent(query)}`);
    });
</script>

</html>