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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['name'];
    $user_phone = $_POST['phone'];
    $user_province = $_POST['province'];
    $user_district = $_POST['district'];
    $user_address = $_POST['address'];

    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_phone'] = $user_phone;
    $_SESSION['user_province'] = $user_province;
    $_SESSION['user_district'] = $user_district;
    $_SESSION['user_address'] = $user_address;
?>
    <script>
        sessionStorage.setItem('user_name', <?php echo $_SESSION['user_name'] ?>);
        sessionStorage.setItem('user_phone', <?php echo $_SESSION['user_phone'] ?>);
        sessionStorage.setItem('user_province', <?php echo $_SESSION['user_province'] ?>);
        sessionStorage.setItem('user_district', <?php echo $_SESSION['user_district'] ?>);
        sessionStorage.setItem('user_address', <?php echo $_SESSION['user_address'] ?>);
    </script>
<?php
    header("location: payment.php?user_name=    " . $_SESSION['user_name']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/reset.css" />
    <link rel="stylesheet" href="./assets/css/styles.css" />
    <link rel="stylesheet" href="./assets/css/cart.css" />
    <link rel="stylesheet" href="./assets/css/dropdown.css">
    <link rel="stylesheet" href="./assets/css/delivery.css" />
    <title>Ivy-Project | Delivery</title>
</head>

<body>
    <!-- Header -->
    <?php include "header.php" ?>

    <!-- Delivery -->
    <section class="delivery">
        <div class="container">
            <div class="delivery-top-wrap">
                <div class="delivery-top">
                    <div class="delivery-top-cart">
                        <img src="./assets/icons/cart-shopping.svg" aslt="" class="cart-icon" />
                    </div>
                    <div class="delivery-top-cart">
                        <img src="./assets/icons/location.svg" aslt="" class="location-icon" />
                    </div>
                    <div class="delivery-top-cart">
                        <img src="./assets/icons/credit-card.svg" aslt="" class="credit-icon" />
                    </div>
                </div>
            </div>

            <div class="delivery-content row">
                <div class="delivery-content-left">
                    <p>Vui lòng chọn địa chỉ giao hàng</p>
                    <!-- <div class="delivery-content-left-sign-in">
                        <img src="./assets/icons/sign-in.svg" class="sign-in-icon" alt="" />
                        <p>Đăng nhập (Nếu bạn đã có tài khoản IVY)</p>
                    </div>
                    <div class="delivery-content-left-khachle row">
                        <input type="radio" name="loaiKhach" id="" checked />
                        <p>
                            <span style="font-weight: bold">Khách lẻ</span>
                            (Nếu bạn không muốn lưu lại thông tin)
                        </p>
                    </div>
                    <div class="delivery-content-left-sign-up row">
                        <input type="radio" name="loaiKhach" id="" />
                        <p>
                            <span style="font-weight: bold">Đăng ký</span>
                            (Tạo tài khoản với thông tin bên dưới)
                        </p>
                    </div> -->
                    <form method="post">
                        <div class="delivery-content-left-input-top row">
                            <div class="delivery-content-left-input-top-item">
                                <label for="name">Họ tên
                                    <span style="color: red">*</span></label>
                                <input type="text" name="name" id="" />
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for="phoneNumber">Điện thoại
                                    <span style="color: red">*</span></label>
                                <input type="text" name="phoneNumber" id="" />
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Tỉnh/TP
                                    <span style="color: red">*</span></label>
                                <input type="text" name="province" id="" />
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Quận/Huyện
                                    <span style="color: red">*</span></label>
                                <input type="text" name="district" id="" />
                            </div>
                        </div>
                        <div class="delivery-content-left-input-bottom">
                            <label for="">Địa chỉ
                                <span style="color: red">*</span></label>
                            <input type="text" name="address" id="" />
                        </div>
                        <div class="delivery-content-left-button row">
                            <a href="cart.php"> &#10586; Quay lại trang giỏ hàng</a>
                            <button type="submit">
                                <a href="payment.php">
                                    <p style="font-weight: bold">
                                        Thanh toán và giao hàng
                                    </p>
                                </a>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="delivery-content-right">
                    <table>
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sum_price = 0;
                            $show_cart = $cart->show_cart();
                            if ($show_cart) {
                                while ($result = $show_cart->fetch_assoc()) {
                                    $sum = 0;
                                    $get_string_price = (int)(str_replace(['.', 'đ'], "", $result['product_price']));
                                    $sum += $get_string_price * $result['cart_quantity'];
                                    $sum_price += $sum;
                            ?>
                                    <tr>
                                        <td><?php echo $result['cart_name'] ?></td>
                                        <td><?php echo $result['cart_quantity'] ?></td>
                                        <td><?php $number = str_replace('đ', '',  $result['cart_price']);

                                            // Sử dụng hàm number_format để thêm dấu chấm
                                            $formattedPrice = number_format($number, 0, ',', '.') . 'đ';
                                            echo $formattedPrice; ?></td>
                                        <td><?php
                                            $number = str_replace('đ', '',  $sum);

                                            // Sử dụng hàm number_format để thêm dấu chấm
                                            $formattedPrice = number_format($number, 0, ',', '.') . 'đ';
                                            echo $formattedPrice; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                            <!-- <tr>
                                <td>Áo sơ mi</td>
                                <td>1</td>
                                <td>1.700.000 <sup>đ</sup></td>
                            </tr> -->
                            <tr>
                                <td style="font-weight: bold" colspan="3">
                                    Tổng
                                </td>
                                <td><?php $number = str_replace('đ', '', $sum_price);

                                    // Sử dụng hàm number_format để thêm dấu chấm
                                    $formattedPrice = number_format($number, 0, ',', '.') . 'đ';
                                    echo $formattedPrice; ?><sup>đ</sup></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold" colspan="3">
                                    Thuế VAT
                                </td>
                                <td><?php
                                    $number = str_replace('đ', '', $sum_price * 1.05);

                                    // Sử dụng hàm number_format để thêm dấu chấm
                                    $formattedPrice = number_format($number, 0, ',', '.') . 'đ';
                                    echo $formattedPrice; ?><sup>đ</sup></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold" colspan="3    ">
                                    Tổng tiền hàng
                                </td>
                                <td><?php $number = str_replace('đ', '', $sum_price * 1.05);

                                    // Sử dụng hàm number_format để thêm dấu chấm
                                    $formattedPrice = number_format($number, 0, ',', '.') . 'đ';
                                    $_SESSION['total_money'] = $formattedPrice;
                                    echo $formattedPrice; ?><sup>đ</sup></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <?php include "footer.php" ?>
</body>
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