<?php
$header_title = "Thêm sản phẩm";
include "header.php";
include "slider.php";
include "class/product_class.php";
?>

<?php
$product = new Product();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_POST, $_FILES);
    // echo '<pre>';
    // print_r($_FILES['product_img_desc']['name']);
    // echo '</pre>';
    $insert_product = $product->insert_product($_POST, $_FILES);
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-product__add">
        <h1 style="text-align: center">Thêm Sản Phẩm</h1>
        <!-- enctype để có thể lấy được file -->
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="">Nhập tên sản phẩm
                <span style="color: red">*</span></label>
            <input required type="text" name="product_name" id="" />
            <label for="">Chọn danh mục
                <span style="color: red">*</span></label>
            <select name="category_id" id="category_id">
                <option value="">--Chọn--</option>
                <?php
                $show_category = $product->show_category();
                if ($show_category) {
                    while ($result = $show_category->fetch_assoc()) {

                ?>
                        <option value="<?php echo $result['category_id']; ?>"><?php echo $result['category_name']; ?></option>

                <?php

                    }
                }
                ?>
            </select>
            <label for="">Chọn loại sản phẩm
                <span style="color: red">*</span></label>
            <select name="brand_id" id="brand_id">
                <option value="">--Chọn--</option>

            </select>
            <label for="">Giá sản phẩm
                <span style="color: red">*</span></label>
            <input type="text" name="product_price" id="" />
            <label for="">Giá khuyến mãi
                <span style="color: red">*</span></label>
            <input required type="text" name="product_price_sale" id="" />
            <label for="">Mô tả sản phẩm</label>
            <textarea cols="
                        30" rows="10" name="product_desc" id="editor"></textarea>
            <label for="">Ảnh sản phẩm
                <span style="color: red">*</span></label>
            <span style="color: red; font-size: 20px;"><?php if (isset($insert_product)) {
                                                            echo $insert_product;
                                                        } ?></span>
            <input required type="file" name="product_img" id="" />
            <label for="">Ảnh Mô tả <span style="color: red">*</span></label>
            <input required multiple type="file" name="product_img_desc[]" id="" />
            <button type="submit">Thêm</button>
        </form>
    </div>
</div>
</section>
</body>
<script>
    CKEDITOR.replace('editor', {
        filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
</script>

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

</html>