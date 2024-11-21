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
        < action="" method="post" enctype="multipart/form-data">
            <label for="">Danh mục <span style="color: red;">*</span></label>
            <select required name="category_id" id="category_id">
                <?php
                $show_category = $product->show_category();
                if ($show_category) {
                    // $i = 0;
                    while ($resultA = $show_category->fetch_assoc()) {
                        // echo $i++ . '<br>';
                        // $keys = array_keys($resultA);
                        // print_r($keys);
                        // print_r($resultA);
                        // echo "<br>";
                        // print_r($result);
                        // echo "<br>";
                ?>
                        <option <?php if ($result['category_id'] == $resultA['category_id']) {
                                    echo "selected";
                                } ?> value="<?php echo $resultA['category_id'];
                                            ?>">
                            <?php echo $resultA['category_name']
                            ?></option>
                <?php
                    }
                }
                ?>
            </select>
            <br>
            <label for="">Loại sản phẩm <span style="color: red;">*</span></label>
            <select required name="brand_id" id="brand_id">
                <?php
                $show_brand = $product->show_brand();
                if ($show_brand) {
                    // $i = 0;
                    while ($resultA = $show_brand->fetch_assoc()) {
                        // echo $i++ . '<br>';
                        // $keys = array_keys($resultA);
                        // print_r($keys);
                        // print_r($resultA);
                        // echo "<br>";
                        // print_r($result);
                        // echo "<br>";
                ?>
                        <option <?php if ($result['brand_id'] == $resultA['brand_id']) {
                                    echo "selected";
                                }
                                ?> value="<?php echo $resultA['brand_id']
                                            ?>">
                            <?php echo $resultA['brand_name'];
                            ?>
                        </option>
                <?php
                    }
                }
                ?>
            </select>
            <label for="">Tên sản phẩm <span style="color: red;">*</span></label>
            <br>
            <input required type="text" name="" id="" value="<?php echo $result['product_name'] ?>">
            <br>
            <br>
            <label for="">Giá ban đầu <span style="color:red;">*</span></label>
            <br>
            <input required type="text" value="<?php echo $result['product_price']; ?>">
            <br>
            <br>
            <label for="">Giá sản phẩm sau khi giảm <span style="color:red;">*</span></label>
            <br>
            <input required type="text" value="<?php echo $result['product_price_sale']; ?>">
            <br>
            <br>
            <label for="">Ảnh chính <span style="color:red;">*</span></label>
            <br>
            <img style="height: 200px; object-fit: contain;" src="./uploads/<?php echo $result['product_img'] ?>"
                alt="">
            <br>
            <label style="color:red; font-weight:bold;" for="">Ấn để thay ảnh chính: </label>
            <input type="file" name="" id="">
            <br>
            <br>
            <label for="">Ảnh sản phẩm</label>
            <div class="product_img">
                <?php
                $get_img = $product->get_img($product_id);
                if ($get_img) {
                    while ($resultA = $get_img->fetch_assoc()) {
                ?>
                        <img style="width: 100px; object-fit:contain;" src="./uploads/<?php echo $resultA['product_img_desc'] ?>"
                            alt="">
                <?php
                    }
                }
                ?>
            </div>
        </>
    </div>
</div>
</section>
<script>
    $(
        document).ready(() => {
        $('#category_id').change(function() {
            // alert($(this).val());
            let x = $(this).val();
            $.get("product-add_ajax.php", {
                category_id: x
            }, function(data) {
                $("#brand_id").html(data);
            });
        })
    })
</script>
</body>


</html>