<?php
include "./admin/database.php";
include "./admin/class/cart_class.php";
session_start();
if (isset($_SESSION['myAccount'])) {
    unset($_SESSION['myAccount']);
    unset($_SESSION['first-visit']);
    unset($_SESSION['user_role']);
}
$cart = new Cart();
$delete_all_cart_item = $cart->delete_all_cart();
if ($delete_all_cart_item) {
    header('location: index.php');
}
