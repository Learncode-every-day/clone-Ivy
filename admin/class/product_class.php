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
            if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
                $alert = "Chỉ chọn file jpg, png, jpeg";
                return $alert;
            } else {
                if ($fileSize > 1000000) {
                    $alert = "File không được lớn hơn 1MB";
                    return $alert;
                } else {


                    // Cách lấy ảnh
                    move_uploaded_file($_FILES['product_img']['tmp_name'], "uploads/" . $_FILES['product_img']['name']);


                    $query = "INSERT INTO table_product (product_name, category_id, brand_id, product_price, product_price_sale, product_img, product_desc) VALUES ('$product_name', '$category_id', '$brand_id', '$product_price','$product_price_sale', '$product_img','$product_desc')";

                    $result = $this->db->insert($query);
                    if ($result) {
                        $query = "SELECT * FROM table_product ORDER BY product_id DESC LIMIT 1";
                        $result = $this->db->select($query)->fetch_assoc();
                        $product_id = $result['product_id'];
                        $fileName = $_FILES['product_img_desc']['name'];
                        $fileTMP = $_FILES['product_img_desc']['tmp_name'];

                        foreach ($fileName as $key => $value) {
                            move_uploaded_file($fileTMP[$key], "uploads/" . $value);
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

    public function get_all_img()
    {
        $query = "SELECT table_product_img_desc_*, table_product.product_id FROM table_product ON table_product_img_desc.product_id = table_product.product_id ORDER BY table_product.product_id DESC";
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
        $upload_image = "./uploads/" . $product_img;
        move_uploaded_file($file_tmp, $upload_image);
        if (!empty($file_name) && !empty($file_all_name)) {
            $query = "UPDATE table_product SET product_name = '$product_name', brand_id = '$brand_id', category_id = '$category_id',product_price = '$product_price', product_price_sale = '$product_price_sale', product_desc = '$product_desc', product_img = '$product_img' WHERE product_id = '$product_id'";
            $result = $this->db->update($query);
            // Nếu đã tồn tại để sửa thì tiếp tục xóa và cập nhật lại bảng table_product_img_desc
            if ($result) {
                $query = "DELETE FROM table_product_img_desc WHERE product_id = '$product_id'";
                $result = $this->db->delete($query);
                foreach ($file_all_name as $key => $element) {
                    move_uploaded_file($file_all_tmp[$key], "./uploads/" . $element);
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