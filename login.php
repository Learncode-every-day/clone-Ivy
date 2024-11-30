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
        while ($result = $check_user->fetch_assoc()) {
            $_SESSION['user_full_name'] = $result['user_full_name'];
            $_SESSION['user_role'] = $result['user_role'];
        }
        $_SESSION['myAccount'] = $user_email;
        // echo "<script>alert('Quyền hạn của bạn: " . $_SESSION['user_role'] . "')</script>";
        header("location: index.php");
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
                    <a href="forgotpass.php" class="text">Quên mật khẩu</a>
                </div>

                <div class="input-field button">
                    <input type="submit" value="Đăng nhập" />
                </div>

                <div class="login-signup">
                    <span class="text">Bạn chưa có tài khoản?
                        <a href="signup.php" class="text signup-link">Đăng kí</a>
                    </span>
                </div>
            </div>
        </form>
    </div>
</body>

</html>