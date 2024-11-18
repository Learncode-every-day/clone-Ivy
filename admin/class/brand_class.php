<?php
include "database.php";
?>


<?php
class Brand
{
    private $db;
    public function __construct()
    {
        // Gọi class Database
        $this->db = new Database();
    }

    // 
    public function insert_brand($category_id, $brand_name)
    {
        $query = "INSERT INTO table_brand (category_id, brand_name) VALUES ('$category_id', '$brand_name')";
        $result = $this->db->insert($query);
        header("Location:brand-list.php");
        return $result;
    }

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