<?php
include "header.php";
include "slider.php";
include "database.php";
include "class/user_class.php";
?>

<?php
$user = new User();
$show_user = $user->show_user();
?>

<style>
    /* Tổng thể bảng */
    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        /* Loại bỏ khoảng cách giữa các ô */
        font-family: Arial, sans-serif;
        font-size: 16px;
        text-align: left;
    }

    /* Đầu bảng */
    thead {
        background-color: #8aefe9;
        /* Màu nền đầu bảng */
        color: white;
        /* Chữ màu trắng */
    }

    /* Các hàng và cột */
    th,
    td {
        padding: 12px;
        /* Khoảng cách bên trong ô */
        border: 1px solid #000;
        /* Đường viền xung quanh */
    }

    /* Hàng xen kẽ */
    tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
        /* Màu nền nhạt */
    }

    tbody tr:nth-child(even) {
        background-color: #fff;
        /* Màu nền trắng */
    }

    /* Hover - hiệu ứng khi di chuột vào */
    tbody tr:hover {
        background-color: #f1f1f1;
        /* Màu nền khi hover */
        cursor: pointer;
    }

    /* Viền ngoài cho bảng */
    table {
        border: 2px solid #8aefe9;
        border-radius: 5px;
        /* Bo góc */
        overflow: hidden;
        /* Đảm bảo bo góc không bị lệch */
    }

    /* Căn giữa tiêu đề bảng */
    h1 {
        text-align: center;
        font-family: Arial, sans-serif;
        color: #333;
    }
</style>

<div class="admin-content-right">
    <div class="admin-content-right-add-list">
        <h1>Danh sách người dùng</h1>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>User ID</th>
                    <th>Tên người dùng</th>
                    <th>Email người dùng</th>
                    <th>Số điện thoại</th>
                    <th>Mật khẩu</th>
                    <th>Vai trò</th>
                    <th>Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($show_user) {
                    $i = 0;
                    while ($result = $show_user->fetch_assoc()) {
                        $i++;
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['user_id'] ?></td>
                            <td><?php echo $result['user_full_name'] ?></td>
                            <td><?php echo $result['user_email'] ?></td>
                            <td><?php echo $result['user_phone'] ?></td>
                            <td><?php echo $result['user_pass'] ?></td>
                            <td><?php echo $result['user_role'] ?></td>
                            <td>
                                <a href="user-edit.php?user_id=<?php echo $result['user_id']; ?>">Sửa</a>|<a
                                    href="user-delete.php?user_id=<?php echo $result['user_id']; ?>">Xóa</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>