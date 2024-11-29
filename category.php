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
    <?php include "header.php" ?>

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
                                        <a
                                            href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id'] ?>&brand_id=<?php echo $result['brand_id'] ?>&category_id=<?php echo $result['category_id'] ?>">
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
                                                    href="http://localhost/clone-Ivy/handle-click.php?product_id=<?php echo $result['product_id'] ?>&action=detail"><button
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
    <?php include "footer.php" ?>
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