<?php
include "header.php";
include "slider.php";
include "class/brand_class.php";
?>

<?php
$brand = new Brand();
$show_brand = $brand->show_brand();
?>



<div class="admin-content-right">
    <div class="admin-content-right-category__list">
        <h1>Danh sách loại sản phẩm</h1>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Danh mục</th>
                    <th>Loại sản phẩm</th>
                    <th>Tùy biến</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($show_brand) {
                    $i = 0;
                    while ($result  = $show_brand->fetch_assoc()) {
                        $i++;
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['brand_id']; ?></td>
                            <td><?php echo $result['category_name']; ?></td>
                            <td><?php echo $result['brand_name']; ?></td>
                            <td>
                                <a href="brand-edit.php?brand_id=<?php echo $result['brand_id']; ?>">Sửa</a>|<a
                                    href="brand-delete.php?brand_id=<?php echo $result['brand_id']; ?>">Xóa</a>
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