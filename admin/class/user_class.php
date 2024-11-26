<?php
// include "database.php";
?>

<?php
class User
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert_user($user_full_name, $user_email, $user_phone, $user_pass, $user_role)
    {
        $query = "INSERT INTO table_user(user_full_name, user_email, user_phone, user_pass, user_role) VALUES('$user_full_name', '$user_email', '$user_phone', '$user_pass', '$user_role')";
        $result = $this->db->insert($query);
        if ($user_role === "admin") {
            echo "<script>alert('Chào mừng bạn đến với trang quản lý với tư cách là 1 admin')</script>";
            header("location: http://localhost/clone-Ivy/admin/user-list.php");
        }
        return $result;
    }

    public function check_user($user_email, $userpassword)
    {
        $query = "SELECT * FROM table_user WHERE user_email = '$user_email' AND user_pass = '$userpassword' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}
?>