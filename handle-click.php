<?php
include "./admin/database.php";
include "./admin/class/cart_class.php";
include "./admin/class/product_class.php";

// Tắt hiển thị lỗi
ini_set('display_errors', 0);
error_reporting(0);  // Tắt tất cả các loại lỗi

// Hoặc chỉ tắt các loại lỗi cảnh báo (warnings)
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_PARSE);  // Chỉ hiển thị lỗi nghiêm trọng

if ($_GET['action'] == 'add') {
    $cart = new Cart();
    $product = new Product();
    $product_id = $_GET['product_id'];
    $get_product = $product->get_product($product_id);
    $resultA = $get_product->fetch_assoc();
    $product_name = $resultA['product_name'];
    $product_price = (int)(str_replace(['.', 'đ'], "", $result['product_price']));
    // var_dump($product_price);
    $insert_cart = $cart->insert_cart($product_name, 1, $product_price, $product_id);
    header("location: category.php?category_id=" . 12);
} else if ($_GET['action'] == 'delete') {
    $product_id = $_GET['product_id'];
    $cart = new Cart();
    $delete_cart = $cart->delete_cart_item($product_id);
    header("location: category.php?category_id=" . 12);
} else if ($_GET['action'] == 'detail') {
    $product_id = $_GET['product_id'];
    header("location: product.php?product_id=" . $product_id);
} else if ($_GET['action'] == 'delete_one') {
    $cart = new Cart();
    $product = new Product();
    $product_id = $_GET['product_id'];
    if ($product_id == null) {
        $show_product = $product->show_product();
        if ($show_product) {
            while ($result = $show_product->fetch_assoc()) {
                $product_id = $result['product_id'];
                break;
            }
        }
    }
    $delete_product_in_cart = $cart->delete_cart_item($product_id);
    $get_product = $product->get_product($product_id);
    if ($get_product) {
        while ($result = $get_product->fetch_assoc()) {
            $brand_id = $result['brand_id'];
            $category_id = $result['category_id'];
        }
    }
    header("location: cart.php&brand_id=" . $brand_id . "&category_id=" . $category_id);
}
