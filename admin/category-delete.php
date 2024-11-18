<?php
include "class/category_class.php";
$category = new Category();
if (!isset($_GET['category_id']) || $_GET['category_id'] == null) {
    echo "<script>window.location = 'category-list.php'</script>";
} else {
    $category_id = $_GET['category_id'];
}
$delete_category = $category->delete_category($category_id);
