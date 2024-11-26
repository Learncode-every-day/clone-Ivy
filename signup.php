<?php
include "./admin/database.php";
include "./admin/class/user_class.php";

// Tắt hiển thị lỗi
ini_set('display_errors', 0);
error_reporting(0);  // Tắt tất cả các loại lỗi

// Hoặc chỉ tắt các loại lỗi cảnh báo (warnings)
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_PARSE);  // Chỉ hiển thị lỗi nghiêm trọng

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_POST['password'] === $_POST['confirm_password']) {
        $user_full_name = $_POST['name'];
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];
        $user_phone =  $_POST['phone'];
        $insert_user = $user->insert_user($user_full_name, $user_email, $user_phone, $user_password, "user"); ?>
        <script>
            const userConfirmed = confirm('Chúc mừng bạn đã đăng ký thành công!!! Vui lòng đăng nhập để vào trang chủ =))');
            if (userConfirmed) {
                window.location.href = 'http://localhost/clone-Ivy/login.php';
            }
        </script>

<?php
        echo "";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/login-signup.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <title>Đăng ký</title>
</head>

<body>
    <div class="container">
        <form action="signup.php" method="POST">
            <div class="form">
                <span class="title">Đăng kí</span>

                <div class="input-field">
                    <input type="text" name="name" placeholder="Họ và tên" required>
                    <i class="uil uil-user icon"></i>
                </div>

                <div class="input-field">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class="uil uil-envelope-alt icon"></i>
                </div>

                <div class="input-field">
                    <input type="text" name="phone" placeholder="Số điện thoại" required>
                    <i class="uil uil-phone icon"></i>
                </div>

                <div class="input-field">
                    <input type="password" name="password" class="password" placeholder="Mật khẩu" required>
                    <i class="uil uil-lock icon"></i>
                </div>

                <div class="input-field">
                    <input type="password" name="confirm_password" class="password" placeholder="Nhập lại mật khẩu"
                        required>
                    <i class="uil uil-lock icon"></i>
                </div>

                <div class="input-field button">
                    <input type="submit" value="Đăng kí">
                </div>

                <div class="login-signup">
                    <span class="text">Bạn đã có tài khoản?
                        <a href="http://localhost/clone-Ivy/login.php" class="text login-link">Đăng nhập</a>
                    </span>
                </div>
            </div>
        </form>
    </div>
</body>

</html>