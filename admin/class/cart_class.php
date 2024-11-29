<?php
// include "database.php";
?>

<?php
class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert_cart($cart_name, $cart_quantity, $cart_price, $product_id)
    {
        $query = "INSERT INTO table_cart(cart_name, cart_quantity, cart_price, product_id) VALUES ('$cart_name', '$cart_quantity', '$cart_price', '$product_id')";
        $result = $this->db->insert($query);
        return $result;
    }

    public function show_cart()
    {
        $query = "SELECT table_cart.*, table_product.product_img, table_product.product_name, table_product.product_price, table_product.product_id, table_product.brand_id, table_product.category_id FROM table_cart INNER JOIN table_product ON table_cart.product_id = table_product.product_id ORDER BY cart_id";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_in_cart_by_product_id($product_id)
    {
        $query = "SELECT table_cart.*, table_product.* FROM table_cart INNER JOIN table_product ON table_cart.product_id = table_product.product_id ORDER BY table_cart.table_id";
        $result = $this->db->select($query);
        return $result;
    }

    public function count_product_in_cart()
    {
        $query = "SELECT COUNT(*) as total FROM table_cart";
        $result = $this->db->select($query);
        return $result;
    }

    public function delete_cart_item($product_id)
    {
        $query = "DELETE FROM table_cart WHERE product_id = '$product_id'";
        $result = $this->db->delete($query);
        return $result;
    }

    public function delete_all_cart()
    {
        $query = "DELETE FROM table_cart";
        $result = $this->db->delete($query);
        return $result;
    }

    public function calculate_total()
    {
        $query = "SELECT SUM(cart_quantity * cart_price) AS total FROM table_cart";
        $result = $this->db->select($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function merge_cart($product_id)
    {
        $query = "SELECT * FROM table_cart WHERE product_id = $product_id";
        $result = $this->db->select($query);
        if ($result->num_rows > 1) {
            $resultA = $result->fetch_assoc();
            $cart_id = $resultA['cart_id'];
            // var_dump($cart_id);
            $quantity = $resultA['cart_quantity'] + 1;
            $query = "UPDATE table_cart SET cart_quantity = '$quantity' WHERE product_id = $product_id";
            $result = $this->db->select($query);
            $query = "DELETE FROM table_cart WHERE cart_id = $cart_id";
            $result = $this->db->delete($query);
        }
        return $result;
    }
}
?>