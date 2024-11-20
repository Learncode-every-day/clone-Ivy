<?php
include "header.php";
include "slider.php";
include "class/category_class.php";
?>

<?php
$category = new Category();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];
    $insert_category = $category->insert_category($category_name);
}
// var_dump($_POST);
// var_dump($category_name);
?>



<div class="admin-content-right">
    <div class="admin-content-right-category__add">
        <h1 style="text-align: center">Thêm Danh Mục</h1>
        <form action="" method="POST">
            <label for="">Nhập tên danh mục<span style="color: red;">*</span></label>
            <br>
            <input required type="text" name="category_name" id="" placeholder="Nhập tên danh mục" />
            <button type="submit">Thêm</button>
        </form>
    </div>
</div>
</section>
</body>

</html>