<?php
if (basename(__FILE__) === "category.php") {
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
    include "./admin/class/cart_class.php";
    $category = new Category();
    $brand = new Brand();
    $product = new Product();
    $cart = new Cart();
    $get_product_id = $_GET['product_id'] ?? "";
    $get_brand_id = $_GET['brand_id'] ?? "";
    $get_category_id = $_GET['category_id'] ?? "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/reset.css" />
    <link rel="stylesheet" href="./assets/css/styles.css" />
    <link rel="stylesheet" href="./assets/css/category.css" />
    <title>Ivy-Project | Category</title>
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
                        <li class="other__item other__item-cart">
                            <div class="dropdown">
                                <div class="dropdown__select">
                                    <a href="http://localhost/clone-Ivy/cart.php" class="other__link"><img
                                            src="./assets/icons/cart-shopping.svg" alt="" class="cart-icon" />
                                    </a>
                                </div>
                                <?php
                                $cart = new Cart();
                                $count_cart = $cart->count_product_in_cart();
                                if ($count_cart) {
                                    $result = $count_cart->fetch_assoc();
                                    // var_dump($result);
                                }

                                ?>
                                <span class="header-cart__notice"><?php echo $result['total']; ?></span>
                                <ul class="dropdown__list dropdown__list-cart">
                                    <?php
                                    $cart = new Cart();
                                    $show_cart = $cart->show_cart();
                                    if ($show_cart) {
                                        // var_dump($show_cart);
                                        while ($result = $show_cart->fetch_assoc()) {
                                            // var_dump($result);

                                    ?>
                                            <li class="dropdown__item">
                                                <a style="display: flex; position: relative; width: 100%; justify-content: space-around; flex-direction: column"
                                                    href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id']; ?>">
                                                    <img style="height: 50px; width: 30px; object-fit:contain; display:block;"
                                                        src="./admin/uploads/<?php echo $result['product_img']; ?>" alt="">
                                                    <div style="display: flex; position: relative; width: 100%; justify-content: space-around; flex-direction: column"
                                                        class="cart-info">
                                                        <h3
                                                            style="font-size: 1.5rem; white-space: nowrap; overflow:hidden; text-overflow: ellipsis; width: 130px;">
                                                            <?php echo $result['cart_name'] ?></h3>
                                                        <div
                                                            style="display: flex; align-items:center; justify-content:space-between;  margin-top: 10px; width: 100%;">
                                                            <span style="font-size: 1rem">Giá:
                                                                <?php echo $result['cart_price'] . ".000 đ" ?></span>
                                                            <span style="font-size: 1rem">Số lượng:
                                                                <?php echo $result['cart_quantity'] ?></span>
                                                        </div>
                                                        <div class="" style="font-size: 0.8rem">
                                                            <a
                                                                href="handle-click.php?action=delete&product_id=<?php echo $result['product_id'] ?>"><span>Xóa</span></a>
                                                            <a
                                                                href="handle-click.php?action=detail&product_id=<?php echo $result['product_id'] ?>"><span>Xem
                                                                    chi tiết</span></a>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Category -->
    <section class="category">
        <div class="container">
            <div class="category-top">
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
                </p>
            </div>
        </div>
        <div class="container row">
            <div class="category-left">
                <ul class="category-left__list">
                    <?php
                    $show_category = $category->show_category();

                    if ($show_category) {
                        while ($result = $show_category->fetch_assoc()) {
                            // var_dump($result);
                    ?>
                            <li class="category-left__item">
                                <a href="#!" class="category-left__link"><?php echo $result['category_name'] ?></a>
                                <ul>
                                    <?php
                                    $show_brand = $brand->show_brand();
                                    if ($show_brand) {
                                        while ($resultA = $show_brand->fetch_assoc()) {
                                    ?>

                                            <?php
                                            if ($resultA['category_id'] === $result['category_id']) {
                                                echo "<li><a href='" . "http://localhost/clone-Ivy/category.php?brand_id=" . $resultA['brand_id'] . "&category_id=" . $resultA['category_id'] . "'>" . $resultA['brand_name'] . "</a></li>";
                                            }

                                            ?>

                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                    <?php
                        }
                    } ?>
                </ul>
            </div>
            <div class="category-right">
                <div class="category-right-top">
                    <div class="category-right-top__item">
                        <p>Hàng nữ mời về</p>
                    </div>
                    <div class="category-right-top__select">
                        <div style="width: 200px;" class="category-right-top__item">
                            <select style="width:inherit;" name="sort" id="sort">
                                <option value="">Sắp xếp</option>
                                <option value="HigherToLower">Giá cao đến thấp</option>
                                <option value="LowerToHigher">Giá thấp đến cao</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div style="flex-wrap: wrap;" class="category-right-content row">
                    <?php
                    $show_product = $product->show_product();
                    if ($show_product) {
                        while ($result = $show_product->fetch_assoc()) {
                            if ($get_category_id) {
                                if ($result['category_id'] == $get_category_id) {
                    ?>

                                    <div class="category-right-content__item">
                                        <a href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id'] ?>">
                                            <div class="visible-part">
                                                <img src="./admin/uploads/<?php echo $result['product_img'] ?>" alt="" />
                                                <div class="overlay"></div>
                                            </div>
                                            <div class="category-right-content__item-details">
                                                <h1><?php echo $result['product_name'] ?></h1>
                                                <p><?php
                                                    $get_string_price = $result['product_price'];
                                                    echo strtok($get_string_price, "đ");
                                                    ?><sup>đ</sup></p>
                                            </div>
                                            <div class="actions-button">
                                                <a
                                                    href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id'] ?>&action=detail"><button
                                                        class="detail-btn">Chi tiết</button></a>
                                                <a
                                                    href="http://localhost/clone-Ivy/handle-click.php?product_id=<?php echo $result['product_id'] ?>&product_name=<?php echo $result['product_name'] ?>&product_price=<?php echo $result['product_price'] ?>&action=add"><button
                                                        class="add-to-buy-btn" id="add-to-buy-btn">Thêm giỏ hàng</button></a>
                                            </div>
                                        </a>
                                    </div>
                    <?php
                                }
                            }
                        }
                    }
                    ?>
                    <!-- <script>
                        const clickToAdd = document.getElementById('add-to-buy-btn');
                        clickToAdd.addEventListener('click', (e) => {
                            e.preventDefault();
                            <?php
                            // $cart = new Cart();
                            // $insert_cart = $cart->insert_cart($result['product_name'], 1, $result['product_price'], $result['product_id']);
                            ?>
                        });
                    </script> -->
                    <!-- <div class="category-right-content__item">
                        <img src="./assets/img/category-img/pic2_1.jpg" alt="" />
                        <h1>Áo khoác Tweed cổ V Flare</h1>
                        <p>2.190.000<sup>đ</sup></p>
                    </div>
                    <div class="category-right-content__item">
                        <img src="./assets/img/category-img/pic3_1.jpg" alt="" />
                        <h1>Áo khoác Tweed cổ V Flare</h1>
                        <p>2.190.000<sup>đ</sup></p>
                    </div>
                    <div class="category-right-content__item">
                        <img src="./assets/img/category-img/pic4_1.jpg" alt="" />
                        <h1>Áo khoác Tweed cổ V Flare</h1>
                        <p>2.190.000<sup>đ</sup></p>
                    </div> -->
                </div>
                <div class="category-right-bottom row">
                    <div class="category-right-bottom__item">
                        <p>Hiển thị 2 <span>|</span> 4 sản phẩm</p>
                    </div>
                    <div class="category-right-bottom__item">
                        <p>
                            <span>&#171;</span> 1 2 3 4
                            <span>&#187;</span> Trang Cuối
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
<script src="./assets/js/category.js"></script>
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