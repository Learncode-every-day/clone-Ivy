<?php
include "header.php";
include "slider.php";
include "class/category_class.php";
?>

<?php
$category = new Category();
$show_category = $category->show_category();
?>



<div class="admin-content-right">
    <div class="admin-content-right-category__list">
        <h1>Danh sách danh mục</h1>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Danh mục</th>
                    <th>Tùy biến</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($show_category) {
                    $i = 0;
                    while ($result  = $show_category->fetch_assoc()) {
                        $i++;
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['category_id']; ?></td>
                            <td><?php echo $result['category_name']; ?></td>
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