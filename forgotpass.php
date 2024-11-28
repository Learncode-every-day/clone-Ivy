<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-submit'])) {
    // $user_email = $_POST['user_email'];
    // $to = "luana4k16@gmail.com";
    // $subject = "Thư xin lại mật khẩu";
    // $message = "Yêu cầu lấy lại mật khẩu";
    // $headers = "From: " . $user_email;

    // // var_dump(mail($to, $subject, $message, $headers));
    // if (mail($to, $subject, $message, $headers)) {
    //     echo "Email đã được gửi thành công";
    // } else {
    //     echo "Không thể gửi email";
    // }
?>
    <script>
        const confirmation = confirm('Bạn có chắc bạn quên mật khẩu không?');
        if (confirmation) {
            alert('Vui lòng liên hệ với admin thông qua số điện thoại: 0942575383');
        } else {
            alert('Hành động lấy lại mật khẩu đã bị hủy');
        }
    </script>
<?php
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/forgotpass.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <title>Quên mật khẩu</title>
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
        <form action="forgotpass.php" method="POST">
            <div class="forms">
                <div class="form forgotpassword">
                    <span class="title">Quên mật khẩu</span>
                    <form action="#" method="post">
                        <div class="input-field">
                            <input type="text" name="user_email" placeholder=" Hãy nhập Email hoặc SĐT của bạn"
                                required>
                            <i class="uil uil-envelope-alt icon"></i>
                        </div>
                        <div class="input-field button">
                            <input name="btn-submit" type="submit" value="Khôi phục tài khoản">

                        </div>
                        <div class="login-signup">
                            <span class="text">Bạn vẫn còn nhớ tài khoản của mình?
                                <a href="http://localhost/clone-Ivy/login.php" class="text login-link">Đăng nhập</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </div>
</body>

</html>