<?php
include "header.php";
include "slider.php";
include "class/product_class.php";
?>

<?php
$product = new Product();
if (!isset($_GET['product_id']) || $_GET['product_id'] == null) {
    echo "<script>window.location = 'product-list.php'</script>";
} else {
    $product_id = $_GET['product_id'];
}
$get_product = $product->get_product($product_id);
if ($get_product) {
    $result = $get_product->fetch_assoc();
}

?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // $update_product = $product->update_product()
}
?>

<div class="admin-content-right">
    <div class="product-add-content">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="">Danh mục <span style="color: red;">*</span></label>
            <br>
            <input type="tel" name="" id="" value="<?php echo $result['brand_id'] ?>">
            <br>
            <br>
            <label for="">Tên sản phẩm <span style="color: red;">*</span></label>
            <br>
            <input type="text" name="" id="" value="<?php
                                                    echo $result['product_name']
                                                    ?>">
            <br>
            <br>
            <label for="">Loại sản phẩm <span style="color: red;">*</span></label>
            <br>
            <input type="text" name="" id="" value="<?php echo $result['category_id'] ?>">
            <br>
            <br>
            <label for=""></label>
            <select name="" id=""></select>

        </form>
    </div>
</div>
</section>
</body>

</html>