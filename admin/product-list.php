<?php
include "header.php";
include "slider.php";
include "class/product_class.php";
?>

<?php
$product = new Product();
$show_product = $product->show_product();
// var_dump($show_img_desc);
?>

<div class="admin-content-right">
    <div class="admin-content-right-category__list">
        <h1>Danh sách sản phẩm</h1>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Danh mục</th>
                    <th>Loại sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Ảnh chính</th>
                    <th>Ảnh đi kèm</th>
                    <th>Tùy biến</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($show_product) {
                    $i = 0;
                    while ($result  = $show_product->fetch_assoc()) {
                        $i++;
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['product_name']; ?></td>
                            <td><?php echo $result['category_name'] ?></td>
                            <td><?php echo $result['brand_name'] ?></td>
                            <td><?php echo $result['product_price'] ?></td>
                            <td>
                                <img style="height: 30px; object-fit:contain"
                                    src="./uploads/<?php echo $result['product_img'] ?>" alt="">
                            </td>
                            <td>

                                <div style="display:flex;">
                                    <?php
                                    $show_img_desc = $product->show_img_desc();
                                    if ($show_img_desc) {
                                        while ($resultA = $show_img_desc->fetch_assoc()) {
                                            // var_dump($resultA);
                                            if ($resultA['product_id'] == $result['product_id']) {
                                    ?>
                                                <img style="height: 50px; object-fit: contain; display:block; padding: 5px;"
                                                    src="./uploads/<?php echo  $resultA['product_img_desc'] ?>" alt="">
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </td>
                            <td>
                                <a href="category-edit.php?category_id=<?php echo $result['category_id']; ?>">Sửa</a>|<a
                                    href="category-delete.php?category_id=<?php echo $result['category_id']; ?>">Xóa</a>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>
</section>
</body>

</html>