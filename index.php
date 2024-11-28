<?php
if (basename(__FILE__) === "index.php") {
    session_start();
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
    include "./admin/class/user_class.php";
    include "./admin/class/cart_class.php";
    $category = new Category();
    $brand = new Brand();
    $product = new Product();
    $user = new User();
    $cart = new Cart();
}


if (!isset($_SESSION['myAccount'])) {
    header("Location: login.php");
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
    <!-- Nhúng Font Awesome từ CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/dropdown.css">

</head>

<body>
    <!-- Header -->
    <?php include "header.php" ?>

    <!-- Slider -->
    <section id="slider">
        <div class="container">
            <div class="slider__inner">
                <!-- Sử dsng aspect ratio để căn ảnh cho dễ responsive -->
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
    <?php include "footer.php" ?>
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