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
        // Chuyển đổi thành kiểu boolean - Trả về  true khi có bản ghi
        $check_email = $user->check_email_is_exist($user_email)->num_rows > 0;

        if ($check_email) {
            // Email đã tồn tại
            echo "<script>
            const failEmail = confirm('Email bạn đăng ký đã tồn tại');
            if (failEmail) {
                alert('Hãy tạo email mới');
            }
          </script>";
        } else {
            // Email chưa tồn tại, thêm mới
            $insert_user = $user->insert_user($user_full_name, $user_email, $user_phone, $user_password, "user");

            echo "<script>
            const userConfirmed = confirm('Chúc mừng bạn đã đăng ký thành công!!! Vui lòng đăng nhập để vào trang chủ =))');
            if (userConfirmed) {
                window.location.href = 'login.php';
            }
          </script>";
        }
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
                        <a href="login.php" class="text login-link">Đăng nhập</a>
                    </span>
                </div>
            </div>
        </form>
    </div>
</body>

</html>