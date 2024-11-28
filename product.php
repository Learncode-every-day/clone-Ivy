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
    include "./admin/class/cart_class.php";
    $category = new Category();
    $brand = new Brand();
    $product = new Product();
    $cart = new Cart();
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

<!DOCTYPE html>
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
    <?php include "header.php"; ?>

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
                            <a href="handle-click.php?product_id=<?php echo $_GET['product_id'] ?>&action=add">
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
    <?php include "footer.php" ?>
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