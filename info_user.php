<?php
// Tắt hiển thị lỗi
ini_set('display_errors', 0);
error_reporting(0);  // Tắt tất cả các loại lỗi

// Hoặc chỉ tắt các loại lỗi cảnh báo (warnings)
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_PARSE);  // Chỉ hiển thị lỗi nghiêm trọng
include "./admin/database.php";
include "./admin/class/user_class.php";
$user = new User();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Tài Khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .info {
            margin: 20px 0;
            font-size: 16px;
        }

        .info div {
            margin: 10px 0;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        .value {
            color: #000;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Thông Tin Tài Khoản</h1>
        <div class="info">

            <?php
            $get_info = $user->get_info($_GET['email_user']);
            if ($get_info) {
                while ($result = $get_info->fetch_assoc()) {
            ?>
                    <div>
                        <div>
                            <span class="label">Tên người dùng:</span>
                            <span class="value" id="username"><?php if ($result['user_full_name']) {
                                                                    echo $result['user_full_name'];
                                                                } else {
                                                                    echo "Chưa xác định";
                                                                } ?></span>
                        </div>
                        <span class="label">Email:</span>
                        <span class="value" id="email"><?php if ($_GET['email_user']) {
                                                            echo $_GET['email_user'];
                                                        } else {
                                                            echo "Chưa xác định";
                                                        } ?></span>
                    </div>
                    <div>
                        <span class="label">Quyền hạn:</span>
                        <span class="value" id="role"><?php
                                                        if ($result['user_role']) {
                                                            if ($result['user_role'] == 'admin') {
                                                                echo "Quản trị viên";
                                                            } else {
                                                                echo "Người dùng";
                                                            }
                                                        } else {
                                                            echo "Chưa xác định";
                                                        }
                                                        ?></span>
                    </div>
            <?php
                }
            }
            ?>
            <a href="index.php" style="color: inherit; text-decoration: none;">
                <div style="width: 100%; text-align: center; font-size:3rem;">Quay lại trang chủ</div>
            </a>
        </div>
        <div class="footer">
            &copy; 2024 - Trang Thông Tin Tài Khoản
        </div>
    </div>
</body>

</html>