<?php
include "header.php";
include "slider.php";
include "database.php";
include "class/user_class.php";
?>


<?php
$user = new User();
if (!isset($_GET['user_id']) || $_GET['user_id'] == null) {
    echo "<script>window.location = 'user-list.php'</script>";
} else {
    $user_id = $_GET['user_id'];
}
$get_user = $user->get_user($user_id);
if ($get_user) {
    $result = $get_user->fetch_assoc();
}
?>

<?php
$user = new User();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_full_name = $_POST['user_full_name'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_pass = $_POST['user_pass'];
    $user_role = $_POST['user_role'];
    $update_user = $user->update_user($user_full_name, $user_email, $user_phone, $user_pass, $user_role, $user_id);
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
        <h1 style="text-align: center">Sửa Thông Tin Người Dùng</h1>
        <form action="" method="POST">
            <label for="">Nhập tên người dùng<span style="color: red;">*</span></label>
            <br>
            <input required type="text" name="user_full_name" id="" placeholder="Nhập tên người dùng"
                value="<?php echo $result['user_full_name'] ?>" />
            <br>
            <br>
            <label for="">Nhập email người dùng<span style="color: red;">*</span></label>
            <br>
            <input required type="email" name="user_email" id="" placeholder="Nhập email người dùng"
                value="<?php echo $result['user_email'] ?>" />
            <br>
            <br>
            <label for="">Nhập số điện thoại của người dùng<span style="color: red;">*</span></label>
            <br>
            <input required maxlength="10" type="text" name="user_phone" id=""
                placeholder="Nhập số điện thoại của người dùng" value="<?php echo $result['user_phone'] ?>" />
            <br>
            <br>
            <lable>Mời nhập mật khẩu</lable>
            <br>
            <input required type="text" name="user_pass" placeholder="Mời nhập mật khẩu..."
                value="<?php echo $result['user_pass']; ?>">
            <br>
            <br>
            <lable>Mời nhập lại mật khẩu</lable>
            <br>
            <input required type="text" name="user_repeat_pass" placeholder="Mời nhập lại mật khẩu...">
            <br>
            <label for=""></label>
            <select name="user_role" id="">
                <option value="<?php if ($result['user_role'] === "admin") {
                                    echo "admin";
                                } else {
                                    echo "user";
                                } ?>">
                    <?php if ($result['user_role'] === "admin") {
                        echo "Quản trị viên";
                    } else {
                        echo "Người dùng";
                    } ?></option>
                <?php if ($result['user_role'] === "admin") {
                    echo "<option value='user'>Người dùng</option>";
                } else {
                    echo "<option value='admin'>Quản trị viên</option>";
                } ?>
            </select>
            <br>
            <button class="btn-submit" type="submit">Sửa</button>
        </form>
    </div>
</div>
</section>
</body>

</html>