<?php
include "./admin/database.php";
include "./admin/class/cart_class.php";

// Tắt hiển thị lỗi
ini_set('display_errors', 0);
error_reporting(0);  // Tắt tất cả các loại lỗi

// Hoặc chỉ tắt các loại lỗi cảnh báo (warnings)
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_PARSE);  // Chỉ hiển thị lỗi nghiêm trọng

if ($_GET['action'] == 'add') {
    $cart = new Cart();
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
    $product_price = (int)$_GET['product_price'];
    // var_dump($product_price);
    $insert_cart = $cart->insert_cart($product_name, 1, $product_price, $product_id);
    header("location: category.php");
} else if ($_GET['action'] == 'delete') {
    $product_id = $_GET['product_id'];
    $cart = new Cart();
    $delete_cart = $cart->delete_cart_item($product_id);
    header("location: category.php");
} else if ($_GET['action'] == 'detail') {
    $product_id = $_GET['product_id'];
    header("location: product.php?product_id=" . $product_id);
}
