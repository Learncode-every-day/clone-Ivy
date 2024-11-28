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

    public function check_user($user_email, $user_password)
    {
        $query = "SELECT * FROM table_user WHERE user_email = '$user_email' AND user_pass = '$user_password'";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_user()
    {
        $query = "SELECT * FROM table_user ORDER BY user_id";
        $result = $this->db->select($query);
        return $result;
    }

    public function delete_user($user_id)
    {
        $query = "DELETE FROM table_user WHERE user_id = '$user_id'";
        $result = $this->db->delete($query);
        header('location: user-list.php');
        return $result;
    }

    public function update_user($user_full_name, $user_email, $user_phone, $user_pass, $user_role, $user_id)
    {
        $query = "UPDATE table_user SET user_full_name = '$user_full_name', user_email = '$user_email', user_phone = '$user_phone', user_pass = '$user_pass', user_role = '$user_role' WHERE user_id = '$user_id'";
        $result = $this->db->update($query);
        header("Location: user-list.php");
        return $result;
    }

    public function get_user($user_id)
    {
        $query = "SELECT * FROM table_user WHERE user_id = '$user_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_info($user_email)
    {
        $query = "SELECT * FROM table_user WHERE user_email = '$user_email'";
        $result = $this->db->select($query);
        return $result;
    }

    public function check_email_is_exist($user_email)
    {
        $query = "SELECT * FROM table_user WHERE user_email = '$user_email' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}
?>