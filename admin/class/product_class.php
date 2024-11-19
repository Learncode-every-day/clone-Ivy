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

    /*======================================= */
    public function insert_brand($category_id, $brand_name)
    {
        $query = "INSERT INTO table_brand (category_id, brand_name) VALUES ('$category_id', '$brand_name')";
        $result = $this->db->insert($query);
        header("Location:brand-list.php");
        return $result;
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

        if (file_exists("uploads/$fileTarget")) {
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
                }
            }
        }

        return $result;
    }

    public function show_product()
    {
        $query = "SELECT table_product.*, table_brand.brand_name, table_category.category_name FROM table_product INNER JOIN table_brand ON table_product.brand_id = table_brand.brand_id
        INNER JOIN table_category ON table_product.category_id = table_category.category_id ORDER BY table_product.product_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_img_desc()
    {
        $query = "SELECT table_product.*, table_product_img_desc.product_img_desc FROM table_product INNER JOIN table_product_img_desc ON table_product.product_id = table_product_img_desc.product_id ORDER BY table_product.product_id DESC";
        $result = $this->db->select($query);
        return $result;
    }


    /*======================================= */

    //? Show brand
    public function show_category()
    {
        $query = "SELECT * FROM table_category ORDER BY category_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_brand()
    {
        // $query = "SELECT * FROM table_brand ORDER BY brand_id DESC";
        $query = "SELECT table_brand.*, table_category.category_name FROM table_brand INNER JOIN table_category ON table_brand.category_id = table_category.category_id ORDER BY  table_brand.brand_id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_brand_ajax($category_id)
    {
        $query = "SELECT * FROM table_brand WHERE category_id = '$category_id'";
        $result = $this->db->select($query);
        return $result;
    }

    /*======================================= */
    //? Get brand
    public function get_category($category_id)
    {
        $query = "SELECT * FROM table_category WHERE category_id = '$category_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_brand($brand_id)
    {
        $query = "SELECT * FROM table_brand WHERE brand_id = '$brand_id'";
        $result = $this->db->select($query);
        return $result;
    }


    //? Update brand
    public function update_brand($category_id, $brand_id, $brand_name)
    {
        $query = "UPDATE table_brand SET brand_name = '$brand_name', category_id = '$category_id' WHERE brand_id = '$brand_id'";
        $result = $this->db->update($query);
        header("Location:brand-list.php");
        return $result;
    }

    public function update_category($category_name, $category_id)
    {
        $query = "UPDATE table_category SET category_name = '$category_name' WHERE category_id = '$category_id'";
        $result = $this->db->update($query);
        header("Location:category-list.php");
        return $result;
    }
    /*======================================= */


    //? Delete brand
    public function delete_brand($brand_id)
    {
        $query = "DELETE FROM table_brand WHERE brand_id = '$brand_id'";
        $result = $this->db->delete($query);
        header("Location:brand-list.php");
        return $result;
    }

    public function delete_category($category_id)
    {
        $query = "DELETE FROM table_category WHERE category_id = '$category_id'";
        $result = $this->db->delete($query);
        header("Location:category-list.php");
        return $result;
    }
}
?>