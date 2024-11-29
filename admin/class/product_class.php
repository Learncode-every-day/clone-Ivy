<?php
include "database.php";
?>


<?php
class Product
{
    private $db;
    public function __construct()
    {
        // Gọi class Database
        $this->db = new Database();
    }

    public function insert_product()
    {
        $product_name = $_POST['product_name'];
        $category_id = $_POST['category_id'];
        $brand_id = $_POST['brand_id'];
        $product_price = $_POST['product_price'];
        $product_price_sale = $_POST['product_price_sale'];
        $product_img = $_FILES['product_img']['name'];
        $product_desc = $_POST['product_desc'];
        $fileTarget = basename($_FILES['product_img']['name']);
        $fileType = strtolower(pathinfo($product_img, PATHINFO_EXTENSION));
        $fileSize = $_FILES['product_img']['size'];

        if (file_exists("./uploads/$fileTarget")) {
            $alert = "File đã tồn tại";
            return $alert;
        } else {
            if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "webp") {
                $alert = "Chỉ chọn file jpg, png, jpeg, webp";
                return $alert;
            } else {
                if ($fileSize > 1000000) {
                    $alert = "File không được lớn hơn 1MB";
                    return $alert;
                } else {

                    // Cách lấy ảnh
                    move_uploaded_file($_FILES['product_img']['tmp_name'], "uploads/rename/" . $_FILES['product_img']['name']);

                    // Đổi tên ảnh theo dạng pic_[category_id]_[brand_id]_time()
                    // Đường dẫn đến file chưa ảnh
                    $directory = "uploads/rename/";
                    $targetFile = "uploads/";
                    // Những đuôi được sử dụng
                    $allowedExtensions = ["jpg", "png", "jpeg", "webp"];
                    $files = scandir($directory);

                    if ($files === false) {
                        die("Không thể mở thư mục.");
                    }

                    // Duyệt qua từng file trong thư mục
                    foreach ($files as $file) {
                        // Bỏ qua các file đặc biệt '.' và '..'
                        if ($file === '.' || $file === '..') {
                            continue;
                        }

                        // Lấy đường dẫn đầy đủ của file
                        $filePath = $directory . $file;

                        // Kiểm tra nếu là file (không phải thư mục)
                        if (is_file($filePath)) {
                            // Lấy phần đuôi file
                            $fileInfo = pathinfo($file);
                            $fileExtension = strtolower($fileInfo['extension']); // Định dạng file

                            // Kiểm tra nếu là file ảnh hợp lệ
                            if (in_array($fileExtension, $allowedExtensions)) {
                                // Tạo tên mới cho file
                                $newFileName = "image_" . $category_id . "_" . $brand_id . "_" . time() . "." . $fileExtension;
                                $newFilePath = $targetFile . $newFileName;
                                rename($filePath, $newFilePath);
                                $product_img = $newFileName;
                            }
                        }
                    }

                    $query = "INSERT INTO table_product (product_name, category_id, brand_id, product_price, product_price_sale, product_img, product_desc) VALUES ('$product_name', '$category_id', '$brand_id', '$product_price','$product_price_sale', '$product_img','$product_desc')";

                    $result = $this->db->insert($query);
                    if ($result) {
                        $query = "SELECT * FROM table_product ORDER BY product_id DESC LIMIT 1";
                        $result = $this->db->select($query)->fetch_assoc();
                        $product_id = $result['product_id'];
                        $fileName = $_FILES['product_img_desc']['name'];
                        $fileTMP = $_FILES['product_img_desc']['tmp_name'];
                        foreach ($fileName as $key => $value) {
                            move_uploaded_file($fileTMP[$key], "uploads/rename/" . $value);
                            // Đổi tên ảnh theo dạng pic_[category_id]_[brand_id]_time()
                            // Đường dẫn đến file chưa ảnh
                            $directory = "uploads/rename/";
                            $targetFile = "uploads/";

                            // Những đuôi được sử dụng
                            $allowedExtensions = ["jpg", "png", "jpeg", "webp"];
                            $files = scandir($directory);

                            if ($files === false) {
                                die("Không thể mở thư mục.");
                            }

                            // Duyệt qua từng file trong thư mục
                            foreach ($files as $file) {
                                // Bỏ qua các file đặc biệt '.' và '..'
                                if ($file === '.' || $file === '..') {
                                    continue;
                                }

                                // Lấy đường dẫn đầy đủ của file
                                $filePath = $directory . $file;

                                // Kiểm tra nếu là file (không phải thư mục)
                                if (is_file($filePath)) {
                                    // Lấy phần đuôi file
                                    $fileInfo = pathinfo($file);
                                    $fileExtension = strtolower($fileInfo['extension']); // Định dạng file

                                    // Kiểm tra nếu là file ảnh hợp lệ
                                    if (in_array($fileExtension, $allowedExtensions)) {
                                        // Tạo tên mới cho file
                                        $newFileName = "image_desc_" . $category_id . "_" . $brand_id . "_" . uniqid() . "_" . time() . "." . $fileExtension;
                                        $newFilePath = $targetFile . $newFileName;
                                        rename($filePath, $newFilePath);
                                        $value = $newFileName;
                                    }
                                }
                            }

                            $query = "INSERT INTO table_product_img_desc (product_id, product_img_desc) VALUES ('$product_id', '$value')";
                            $result = $this->db->insert($query);
                        }
                    }

                    header("Location: http://localhost/clone-Ivy/admin/product-list.php");
                }
            }
        }

        return $result;
    }

    public function show_product()
    {
        $query = "SELECT table_product.*, table_brand.brand_name, table_category.category_name, table_brand.brand_id, table_category.category_id FROM table_product INNER JOIN table_brand ON table_product.brand_id = table_brand.brand_id
        INNER JOIN table_category ON table_product.category_id = table_category.category_id ORDER BY table_product.product_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_brand_ajax($category_id)
    {
        $query = "SELECT * FROM table_brand WHERE category_id = '$category_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_img_desc()
    {
        $query = "SELECT table_product.*, table_product_img_desc.product_img_desc FROM table_product INNER JOIN table_product_img_desc ON table_product.product_id = table_product_img_desc.product_id ORDER BY table_product.product_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function delete_product($product_id)
    {
        $new_product = new Product();
        // var_dump(1);
        $show_new_product = $new_product->get_all_img($product_id);
        if ($show_new_product) {
            while ($resultA = $show_new_product->fetch_assoc()) {
                // var_dump($resultA['product_img_desc']);
                if (isset($resultA['product_img'])) {
                    unlink("uploads/" . $resultA['product_img']);
                }
                $link_pictures = "uploads/" . $resultA['product_img_desc'];
                unlink($link_pictures);
                // var_dump($resultA['product_img_desc']);
            }
        }
        $query = "DELETE table_product, table_product_img_desc 
    FROM table_product 
    JOIN table_product_img_desc 
    ON table_product.product_id = table_product_img_desc.product_id 
    WHERE table_product.product_id = '$product_id'";
        $result = $this->db->delete($query);
        header("Location:http://localhost/clone-Ivy/admin/product-list.php");
        // echo "Xóa thành công";
        return $result;
    }

    public function get_product($product_id)
    {
        $query = "SELECT 
    p.product_id,
    p.product_name,
    p.product_price,
    p.product_price_sale,
    p.product_desc,
    p.product_img,
    b.brand_name,
    b.brand_id,
    c.category_name,
    c.category_id
FROM table_product p
LEFT JOIN table_brand b 
    ON p.brand_id = b.brand_id
LEFT JOIN table_category c 
    ON p.category_id = c.category_id
WHERE p.product_id = '$product_id'

UNION

SELECT 
    p.product_id,
    p.product_name,
    p.product_price,
    p.product_price_sale,
    p.product_desc,
    p.product_img,
    b.brand_name,
    b.brand_id,
    c.category_name,
    c.category_id
FROM table_product p
RIGHT JOIN table_brand b 
    ON p.brand_id = b.brand_id
RIGHT JOIN table_category c 
    ON p.category_id = c.category_id
WHERE p.product_id = '$product_id';
";
        $result = $this->db->select($query);
        return $result;
    }

    // Lấy loại sản phẩm từ sản phẩm và danh mục có sẵn của nó
    public function show_brand_by_category($category_id)
    {
        $query = "SELECT DISTINCT b.brand_id
FROM table_brand b
INNER JOIN table_category c 
    ON b.category_id = c.category_id
INNER JOIN table_product p 
    ON p.category_id = c.category_id
WHERE p.product_id = '$category_id';
";
        $result = $this->db->select($query);
        return $result;
    }

    // Lấy ảnh chi tiết của sản phẩm
    public function get_img($product_id)
    {
        $query = "SELECT table_product_img_desc.*, table_product.product_id FROM table_product_img_desc INNER JOIN table_product ON table_product_img_desc.product_id = table_product.product_id WHERE table_product_img_desc.product_id = '$product_id' ORDER BY table_product_img_desc.product_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    // Lấy toàn bộ ảnh trong bảng table_product_img_desc

    public function get_all_img($product_id)
    {
        $query = "SELECT table_product_img_desc.*, table_product.product_id, table_product.product_img FROM table_product_img_desc INNER JOIN table_product ON table_product_img_desc.product_id = table_product.product_id WHERE table_product_img_desc.product_id = '$product_id' ORDER BY table_product_img_desc.product_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $file, $product_id)
    {
        $product_name = $data['product_name'];
        $brand_id = $data['brand_id'];
        $category_id = $data['category_id'];
        $product_price = $data['product_price'];
        $product_price_sale = $data['product_price_sale'];
        $product_desc = $data['product_desc'];
        $file_name = $file['product_img']['name'];
        $file_tmp = $file['product_img']['tmp_name'];
        $file_all_name = $file['product_img_desc']['name'];
        $file_all_tmp = $file['product_img_desc']['tmp_name'];
        $div = explode('.', $file_name);
        //? Kiểm tra xem file đã tồn tại chưa
        $file_ext = strtolower(end($div));
        $product_img = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $upload_image = "./uploads/rename/" . $product_img;
        move_uploaded_file($file_tmp, $upload_image);
        // Đổi tên ảnh theo dạng pic_[category_id]_[brand_id]_time()
        // Đường dẫn đến file chưa ảnh
        $directory = "uploads/rename/";
        $targetFile = "uploads/";
        // Những đuôi được sử dụng
        $allowedExtensions = ["jpg", "png", "jpeg", "webp"];
        $files = scandir($directory);

        if ($files === false) {
            die("Không thể mở thư mục.");
        }

        // Duyệt qua từng file trong thư mục
        foreach ($files as $file) {
            // Bỏ qua các file đặc biệt '.' và '..'
            if ($file === '.' || $file === '..') {
                continue;
            }

            // Lấy đường dẫn đầy đủ của file
            $filePath = $directory . $file;

            // Kiểm tra nếu là file (không phải thư mục)
            if (is_file($filePath)) {
                // Lấy phần đuôi file
                $fileInfo = pathinfo($file);
                $fileExtension = strtolower($fileInfo['extension']); // Định dạng file

                // Kiểm tra nếu là file ảnh hợp lệ
                if (in_array($fileExtension, $allowedExtensions)) {
                    // Tạo tên mới cho file
                    $newFileName = "image_" . $category_id . "_" . $brand_id . "_" . time() . "." . $fileExtension;
                    $newFilePath = $targetFile . $newFileName;
                    rename($filePath, $newFilePath);
                    $new_product = new Product();
                    $get_product = $new_product->get_product($product_id);
                    if ($get_product) {
                        while ($resultPic = $get_product->fetch_assoc()) {
                            // echo $resultPic['product_img'];
                            unlink("uploads/" . $resultPic['product_img']);
                        }
                    }
                    $product_img = $newFileName;
                }
            }
        }
        if (!empty($file_name) && !empty($file_all_name)) {
            $query = "UPDATE table_product SET product_name = '$product_name', brand_id = '$brand_id', category_id = '$category_id',product_price = '$product_price', product_price_sale = '$product_price_sale', product_desc = '$product_desc', product_img = '$product_img' WHERE product_id = '$product_id'";
            $result = $this->db->update($query);
            // Nếu đã tồn tại để sửa thì tiếp tục xóa và cập nhật lại bảng table_product_img_desc
            if ($result) {
                $storage_array = [];
                $new_product = new Product();
                $get_img_desc = $new_product->show_img_desc();
                if ($get_img_desc) {
                    while ($resultPics = $get_img_desc->fetch_assoc()) {
                        // var_dump($resultPics);
                        if ($resultPics['product_id'] == $product_id) {
                            if (!in_array($resultPics['product_img_desc'], $storage_array)) {
                                array_push($storage_array, $resultPics['product_img_desc']);
                                // print_r($storage_array);
                            }
                            // unlink("uploads/" . $resultPics['product_img_desc']);
                        }
                    }
                }
                // echo ("<br> Phần tử trong mảng: <br>");
                // print_r($storage_array);

                foreach ($storage_array as $value) {
                    // unlink("uploads/" . $value);
                    // echo ("<br>" . $value . "<br>");
                    // echo ("Số lượng phần tử trong mảng: " . sizeof($storage_array) . "<br>");
                    unlink("uploads/" . $value);
                    // echo "Đã xóa ảnh: " . $value . "thành công!";
                }

                $query = "DELETE FROM table_product_img_desc WHERE product_id = '$product_id'";
                $result = $this->db->delete($query);


                foreach ($file_all_name as $key => $element) {
                    move_uploaded_file($file_all_tmp[$key], "./uploads/rename/" . $element);
                    // Đổi tên ảnh theo dạng pic_[category_id]_[brand_id]_time()
                    // Đường dẫn đến file chưa ảnh
                    $directory = "uploads/rename/";
                    $targetFile = "uploads/";

                    // Những đuôi được sử dụng
                    $allowedExtensions = ["jpg", "png", "jpeg", "webp"];
                    $files = scandir($directory);

                    if ($files === false) {
                        die("Không thể mở thư mục.");
                    }

                    // Duyệt qua từng file trong thư mục
                    foreach ($files as $file) {

                        // Bỏ qua các file đặc biệt '.' và '..'
                        if ($file === '.' || $file === '..') {
                            continue;
                        }

                        // Lấy đường dẫn đầy đủ của file
                        $filePath = $directory . $file;

                        // Kiểm tra nếu là file (không phải thư mục)
                        if (is_file($filePath)) {
                            // Lấy phần đuôi file
                            $fileInfo = pathinfo($file);
                            $fileExtension = strtolower($fileInfo['extension']); // Định dạng file

                            // Kiểm tra nếu là file ảnh hợp lệ
                            if (in_array($fileExtension, $allowedExtensions)) {
                                // Tạo tên mới cho file
                                $newFileName = "image_desc_" . $category_id . "_" . $brand_id . "_" . uniqid() . "_" . time() . "." . $fileExtension;
                                $newFilePath = $targetFile . $newFileName;
                                rename($filePath, $newFilePath);
                                $element = $newFileName;
                            }
                        }
                    }
                    $query = "INSERT INTO table_product_img_desc(product_id, product_img_desc) VALUES ('$product_id', '$element')";
                    $result = $this->db->insert($query);
                }
            }
            header("Location: http://localhost/clone-Ivy/admin/product-list.php");
            return $result;
        }
    }

    // Lấy sản phẩm bằng nội dung được nhập bởi search box.
    public function get_product_by_content($content)
    {
        $query = "SELECT * FROM table_product WHERE product_name LIKE '%$content%'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_relative($brand_id)
    {
        $query = "SELECT * FROM table_product WHERE brand_id = '$brand_id' ORDER BY RAND() LIMIT 5";
        $result = $this->db->select($query);
        return $result;
    }

    /*======================================= */
    //!  Category: Danh mục
    public function insert_category($category_name)
    {
        $query = "INSERT INTO table_category (category_name) VALUES ('$category_name')";
        $result = $this->db->insert($query);
        header("Location:category-list.php");
        return $result;
    }

    public function show_category()
    {
        $query = "SELECT * FROM table_category ORDER BY category_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_category($category_id)
    {
        $query = "SELECT * FROM table_category WHERE category_id = '$category_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category($category_name, $category_id)
    {
        $query = "UPDATE table_category SET category_name = '$category_name' WHERE category_id = '$category_id'";
        $result = $this->db->update($query);
        header("Location:category-list.php");
        return $result;
    }

    public function delete_category($category_id)
    {
        $query = "DELETE FROM table_category WHERE category_id = '$category_id'";
        $result = $this->db->delete($query);
        header("Location:category-list.php");
        return $result;
    }

    /*======================================= */
    //!  Brand: Loại sản phẩm
    public function insert_brand($category_id, $brand_name)
    {
        $query = "INSERT INTO table_brand (category_id, brand_name) VALUES ('$category_id', '$brand_name')";
        $result = $this->db->insert($query);
        header("Location:brand-list.php");
        return $result;
    }

    public function show_brand()
    {
        $query = "SELECT * FROM table_brand ORDER BY brand_id DESC";
        // $query = "SELECT table_brand.*, table_category.category_name FROM table_brand INNER JOIN table_category ON table_brand.category_id = table_category.category_id ORDER BY  table_brand.brand_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_brand($brand_id)
    {
        $query = "SELECT * FROM table_brand WHERE brand_id = '$brand_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_brand($category_id, $brand_id, $brand_name)
    {
        $query = "UPDATE table_brand SET brand_name = '$brand_name', category_id = '$category_id' WHERE brand_id = '$brand_id'";
        $result = $this->db->update($query);
        header("Location:brand-list.php");
        return $result;
    }

    public function delete_brand($brand_id)
    {
        $query = "DELETE FROM table_brand WHERE brand_id = '$brand_id'";
        $result = $this->db->delete($query);
        header("Location:brand-list.php");
        return $result;
    }
}
?>