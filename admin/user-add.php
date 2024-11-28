<?php
include "header.php";
include "slider.php";
include "database.php";
include "class/user_class.php";
?>

<?php
$user = new User();
$_SESSION['IsInfinite'] = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_full_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_pass = $_POST['user_pass'];
    $user_role = $_POST['user_role'];
    $_SESSION['user_full_name'] = $user_full_name;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['user_password'] = $user_pass;
    $_SESSION['user_phone'] = $user_phone;
    $_SESSION['user_role'] = $user_role;
    // var_dump(strlen($_SESSION['user_phone']));
    if ($_POST['user_pass'] === $_POST['user_repeat_pass']) {
        $check_email = $user->check_email_is_exist($user_email)->num_rows > 0;
        if ($check_email) {
            $_SESSION['IsInfinite'] = true;
            $_SESSION['user_email'] = "";
            echo "<script>alert('Email mà bạn đăng ký đã có người sử dụng rồi!!')</script>";
        }
        if ($_SESSION['IsInfinite'] === false) {
            // Xóa hết các session storage
            session_destroy();
        }
        // echo "<script>
        //     alert('Chúc mừng mày đã nhập đúng nhé!');
        // </script>";
        if (strlen($_SESSION['user_phone']) < 10 || strlen($_SESSION['user_role']) > 10) {
            $_SESSION['IsInfinite'] = true;
            echo "<script>alert('Số điện thoại bạn nhập không đủ kí tự')</script>";
        } else {
            $insert_user = $user->insert_user($user_full_name, $user_email, $user_phone, $user_pass, $user_role);
            header("Location: user-list.php");
        }
    } else {
        $_SESSION['IsInfinite'] = true;
        echo "<script>alert('Mật khẩu bạn nhập không trùng với mật khẩu bạn khởi tạo!! Vui lòng nhập lại!!!')</script>";
    }
}
?>

<style>
    .btn-submit {
        outline: none;
        border: none;
        height: 50px;
        width: 100px;
        border-radius: 5px;
        background: #3cd;
        color: #000;
        cursor: pointer;
        transition: .5s linear;
    }

    .btn-submit:hover {
        background: #000;
        color: #3cd;
    }
</style>

<div class="admin-content-right">
    <div class="admin-content-right-admin__add">
        <h1 style="text-align: center">Thêm Người Dùng</h1>
        <form action="" method="POST">
            <label for="">Nhập tên người dùng<span style="color: red;">*</span></label>
            <br>
            <input required type="text" name="user_name" id="" placeholder="Nhập tên người dùng" value="<?php if (isset($_SESSION['user_full_name']) && $_SESSION['IsInfinite'] === true) {
                                                                                                            echo $_SESSION['user_full_name'];
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>" />
            <br>
            <br>
            <label for="">Nhập email người dùng<span style="color: red;">*</span></label>
            <br>
            <input required type="email" name="user_email" id="" placeholder="Nhập email người dùng" value="<?php if (isset($_SESSION['user_email']) && $_SESSION['IsInfinite'] === true) {
                                                                                                                echo $_SESSION['user_email'];
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>" />
            <br>
            <br>
            <label for="">Nhập số điện thoại của người dùng<span style="color: red;">*</span></label>
            <br>
            <input required maxlength="10" type="text" name="user_phone" id=""
                placeholder="Nhập số điện thoại của người dùng" value="<?php if (isset($_SESSION['user_phone']) && $_SESSION['IsInfinite'] === true) {
                                                                            echo $_SESSION['user_phone'];
                                                                        } else {
                                                                            echo "";
                                                                        } ?>" />
            <br>
            <br>
            <lable>Mời nhập mật khẩu</lable>
            <br>
            <input required type="password" name="user_pass" placeholder="Mời nhập mật khẩu...">
            <br>
            <br>
            <lable>Mời nhập lại mật khẩu</lable>
            <br>
            <input required type="password" name="user_repeat_pass" placeholder="Mời nhập lại mật khẩu...">
            <br><br>
            <label for="">Hãy chọn vai trò</label>
            <br>
            <select name="user_role" id="">
                <option value="<?php if (isset($_SESSION['user_role']) && $_SESSION['IsInfinite'] === true) {
                                    echo $_SESSION['user_role'];
                                } else {
                                    echo '#';
                                } ?>">
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['IsInfinite'] === true) {
                        if ($_SESSION['user_role'] == 'admin') {
                            echo "Quản trị viên";
                        } else if ($_SESSION['user_role'] == 'user') {
                            echo "Người dùng";
                        } else {
                            echo "--Mời chọn vai trò--";
                        }
                    } else {
                        echo "--Mời chọn vai trò--";
                    } ?></option>
                <?php if (isset($_SESSION['user_role'])) {
                    if ($_SESSION['user_role'] === 'admin') {
                        echo `
                    <option value="user">Người dùng</option>
                    `;
                    } else {
                        echo `
                    <option value="admin">Quản trị viên</option>
                    `;
                    }
                } else {
                    echo `
                    <option value="admin">Quản trị viên</option>
                    <option value="user">Người dùng</option>
                    `;
                } ?>
                <!-- <option value="#">--Mời chọn vai trò--</option> -->
                <option value="admin">Quản trị viên</option>
                <option value="user">Người dùng</option>
            </select>
            <br>
            <button class="btn-submit" type="submit">Thêm</button>
        </form>
    </div>
</div>
</section>
</body>

</html>