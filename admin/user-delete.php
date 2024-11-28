<?php
include "database.php";
include "class/user_class.php";
$user = new User();
if (!isset($_GET['user_id']) || $_GET['user_id'] == null) {
    echo "<script>window.location = 'user-list.php'</script>";
} else {
    $user_id = $_GET['user_id'];
}
$delete_user = $user->delete_user($user_id);
