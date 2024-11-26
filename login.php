<?php
include "./admin/database.php";
include "./admin/class/user_class.php";
session_start();

// Tắt hiển thị lỗi
ini_set('display_errors', 0);
error_reporting(0);  // Tắt tất cả các loại lỗi

// Hoặc chỉ tắt các loại lỗi cảnh báo (warnings)
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_PARSE);  // Chỉ hiển thị lỗi nghiêm trọng

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_email = $_POST['email'];
    $user_pass = $_POST['password'];
    $check_user = $user->check_user($user_email, $user_pass);
    if ($check_user) {
        $_SESSION['myAccount'] = $user_email;
        header("location: http://localhost/clone-Ivy/index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/login-signup.css" />
    <!-- Nhúng icon bằng link -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <title>Đăng nhập</title>
</head>

<body>
    <div class="container">
        <form action="login.php" method="POST">
            <div class="form">
                <span class="title">Đăng nhập</span>

                <div class="input-field">
                    <input type="email" name="email" placeholder="Email" required />
                    <i class="uil uil-envelope-alt icon"></i>
                </div>

                <div class="input-field">
                    <input type="password" name="password" class="password" placeholder="Mật khẩu" required />
                    <i class="uil uil-lock icon"></i>
                </div>

                <div class="checkbox-text">
                    <div class="checkbox-content">
                        <input type="checkbox" id="logCheck" />
                        <label for="logCheck" class="text">Ghi nhớ tài khoản</label>
                    </div>
                    <a href="http://localhost/clone-Ivy/forgotpass.php" class="text">Quên mật khẩu</a>
                </div>

                <div class="input-field button">
                    <input type="submit" value="Đăng nhập" />
                </div>

                <div class="login-signup">
                    <span class="text">Bạn chưa có tài khoản?
                        <a href="http://localhost/clone-Ivy/signup.php" class="text signup-link">Đăng kí</a>
                    </span>
                </div>
            </div>
        </form>
    </div>
</body>

</html>