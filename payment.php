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
if (isset($_SESSION['total_money'])) {
    $total_money = $_SESSION['total_money'];
} else {
    $total_money = 0;
}
?>

<script>
    alert('Chào mừng:<?php echo $_GET['user_name'] ?> đến với trang thanh toán');
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/reset.css" />
    <link rel="stylesheet" href="./assets/css/dropdown.css">
    <link rel="stylesheet" href="./assets/css/styles.css" />
    <link rel="stylesheet" href="./assets/css/payment.css" />
    <title>Ivy-Project | Payment</title>
</head>

<body>
    <!-- Header -->
    <?php include "header.php" ?>

    <!-- Payment -->
    <section class="payment">
        <div class="container">
            <div class="payment-top-wrap">
                <div class="payment-top">
                    <div class="payment-top-cart">
                        <img src="./assets/icons/cart-shopping.svg" aslt="" class="cart-icon" />
                    </div>
                    <div class="payment-top-cart">
                        <img src="./assets/icons/location.svg" aslt="" class="location-icon" />
                    </div>
                    <div class="payment-top-cart">
                        <img src="./assets/icons/credit-card.svg" aslt="" class="credit-icon" />
                    </div>
                </div>
            </div>
            <div class="payment-content row">
                <div class="payment-content-left">
                    <div class="payment-content-left-method-delivery">
                        <p style="font-weight: bold">
                            Phương thức giao hàng
                        </p>
                        <div class="payment-content-left-method-delivery-item">
                            <input type="radio" name="" id="" checked />
                            <label for="">Giao hàng chuyển phát nhanh</label>
                        </div>
                    </div>
                    <div class="payment-content-left-method-payment">
                        <p style="font-weight: bold">
                            Phương thức thanh toán
                        </p>
                        <p>
                            Mọi giao dịch đều được bảo mật và mã hóa. Thông
                            tin thẻ tín dụng sẽ không bao giờ được lưu lại
                        </p>
                        <div class="payment-content-left-method-payment-item">
                            <input type="radio" name="method-payment" id="" />
                            <label for="">Thanh toán thẻ tín dụng(OnePay)</label>
                        </div>
                        <div class="payment-content-left-method-payment-item-img row">
                            <img style="height: 200px; margin-right: 10px" src="./assets/img/qr-code.png" alt="" />
                        </div>
                        <div style="margin-top: 20px; font-size: 3rem" class="payment-content-left-method-payment-item">
                            <label for="">Giá tiền cho tổng hàng: </label>
                            <input type="text" name="" id="" value="<?php echo $total_money; ?>" />
                        </div>
                        <!--
                        <div class="payment-content-left-method-payment-item-img row">
                            <img style="width: 450px; object-fit: cover" src="./assets/img/picForPayment.png" alt="" />
                        </div>
                        <div class="payment-content-left-method-payment-item">
                            <input type="radio" name="method-payment" id="" />
                            <label for="">Thanh toán Momo</label>
                        </div>
                        <div class="payment-content-left-method-payment-item-img row">
                            <img style="width: 150px" src="./assets/img/momo.png" alt="" />
                        </div>
                        <div class="payment-content-left-method-payment-item">
                            <input type="radio" name="method-payment" id="" />
                            <label for="">Thu tiền tận nơi</label>
                        </div> -->
                    </div>
                </div>
                <div class="payment-content-right">
                    <div class="payment-content-right-button">
                        <input type="text" name="" id="" placeholder="Mã giảm giá/ Quà tặng" />
                        <button>
                            <img src="./assets/icons/check.svg" alt="" class="check-icon" />
                        </button>
                    </div>
                    <div class="payment-content-right-button">
                        <input type="text" name="" id="" placeholder="Mã cộng tác viên" />
                        <button>
                            <img src="./assets/icons/check.svg" alt="" class="check-icon" />
                        </button>
                    </div>
                    <div class="payment-content-right-mnv">
                        <select name="" id="">
                            <option value="">
                                Chọn mã nhân viên thân thiết
                            </option>
                            <option value="">D345</option>
                            <option value="">A345</option>
                            <option value="">E456</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="payment-content-right-payment">
                <button id="payment-completed">Kiểm tra thanh toán</button>
                <script>
                    const submitBtn = document.getElementById('payment-completed');
                    submitBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        alert("Chúc mừng bạn đã thanh toán thành công!!");
                        <?php
                        $cart = new Cart();
                        $delete_all_cart = $cart->delete_all_cart();
                        unset($_SESSION['total_money'])
                        ?>
                        window.location.href = "index.php";
                    });
                </script>
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