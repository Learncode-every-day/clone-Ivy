<?php
include "class/brand_class.php";
$brand = new Brand();
$brand_id = $_GET['brand_id'];
$delete_brand = $brand->delete_brand($brand_id);
