<?php
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/reset.css" />
    <link rel="stylesheet" href="./assets/css/styles.css" />
    <link rel="stylesheet" href="./assets/css/dropdown.css">
    <link rel="stylesheet" href="./assets/css/cart.css" />
    <title>Ivy-Project | Cart</title>
</head>

<body>
    <!-- Header -->
    <?php include "header.php" ?>

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
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            $sum_price = 0;
                            $show_cart = $cart->show_cart();
                            if ($show_cart) {
                                while ($result = $show_cart->fetch_assoc()) {
                                    $count++;
                                    $get_string_price = (int)(str_replace(['.', 'đ'], "", $result['product_price']));
                                    $sum_price += $get_string_price;
                            ?>
                                    <tr>
                                        <td>
                                            <img src="./admin/uploads/<?php echo $result['product_img'] ?>" alt="" />
                                        </td>
                                        <td>
                                            <p>Quần Sock</p>
                                        </td>
                                        <td>
                                            <input type="number" value="1" min="1" />
                                        </td>
                                        <td>
                                            <p><?php
                                                echo strtok($get_string_price, "đ"); ?><sup>đ</sup></p>
                                        </td>
                                        <td>
                                            <a
                                                href="handle-click.php?action=delete_one&product_id=<?php echo $result['product_id'] ?>"><span>X</span></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
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
                                <td><?php echo $count ?></td>
                            </tr>
                            <tr>
                                <td>Tổng tiền hàng</td>
                                <td>
                                    <p><?php

                                        // Loại bỏ ký tự 'đ' trước khi định dạng
                                        $number = str_replace('đ', '', $sum_price);

                                        // Sử dụng hàm number_format để thêm dấu chấm
                                        $formattedPrice = number_format($number, 0, ',', '.') . 'đ';
                                        echo $formattedPrice;
                                        ?><sup>đ</sup></p>
                                </td>
                            </tr>
                            <tr>
                                <td>Thành tiền</td>
                                <td><?php $number = str_replace('đ', '', $sum_price);

                                    // Sử dụng hàm number_format để thêm dấu chấm
                                    $formattedPrice = number_format($number, 0, ',', '.') . 'đ';
                                    echo $formattedPrice; ?><sup>đ</sup></td>
                            </tr>
                            <tr>
                                <td>Tạm tính</td>
                                <td>
                                    <p style="
                                                color: #000;
                                                font-weight: bold;
                                            ">
                                        <?php $number = str_replace('đ', '', $sum_price);

                                        // Sử dụng hàm number_format để thêm dấu chấm
                                        $formattedPrice = number_format($number, 0, ',', '.') . 'đ';
                                        echo $formattedPrice; ?><sup>đ</sup>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <div class="cart-content-right-text">
                        <p>
                            Bạn sẽ được miễn phí ship khi đơn hàng có tổng
                            giá trị trên 2.000.000đ
                        </p>
                        <p style="color: red; font-weight: bold">
                            Mua thêm
                            <span style="font-size: 1.8rem">131.000đ</span>
                            để được miễn phí SHIP
                        </p>
                    </div> -->
                    <div class="cart-content-right-button">
                        <a href="category.php"><button>Tiếp tục mua sắm</button></a>
                        <a href="delivery.php"><button>Thanh toán</button></a>
                    </div>
                    <!-- <div class="cart-content-right-log-in">
                        <p>Tài khoản IVY</p>
                        <p>
                            Hãy <a href="#!"> Đăng nhập</a> tài khoản để
                            tích điểm thành viên
                        </p>
                    </div> -->
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
</script>

</html>