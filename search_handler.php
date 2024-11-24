<?php
if (basename(__FILE__) === "search_handler.php") {
    // Tắt hiển thị lỗi
    ini_set('display_errors', 0);
    error_reporting(0);  // Tắt tất cả các loại lỗi

    // Hoặc chỉ tắt các loại lỗi cảnh báo (warnings)
    ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_PARSE);  // Chỉ hiển thị lỗi nghiêm trọng

    include './admin/database.php';
    include "./admin/class/category_class.php";
    include "./admin/class/brand_class.php";
    include "./admin/class/product_class.php";
    $product = new Product();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['query'])) {
    $content = $_POST['query'];
    $output = '';
    $isTrue = true;

    // Gọi hàm lấy sản phẩm từ cơ sở dữ liệu
    $show_product_by_content = $product->get_product_by_content($content);

    if ($show_product_by_content) {
        $output .= '<table style="font-size: 1.1rem; background: #fff; text-align: center;">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá sản phẩm</th>
                    <th>Giá sau khi giảm</th>
                </tr>
            </thead>
            <tbody>';
        while ($result = $show_product_by_content->fetch_assoc()) {
            $output .= '
                <tr>
                    <td><a href="product.php?product_id=' . $result['product_id'] . '">' . $result['product_name'] . '</a></td>
                    <td style="display: flex; align-items:center; justify-content: center;"><a href="product.php?product_id=' . $result['product_id'] . '"><img style="width: 50px; object-fit:contain;" src="./admin/uploads/' . $result['product_img'] . '" alt=""></a></td>
                    <td><a href="product.php?product_id=' . $result['product_id'] . '">' . $result['product_price'] . '</a></td>
                    <td><a href="product.php?product_id=' . $result['product_id'] . '">' . $result['product_price_sale'] . '</a></td>
                </tr>';
        }
        $output .= '</tbody></table>';
    } else {
        $output = '<p>Không tìm thấy sản phẩm nào.</p>';
    }

    echo $output;
}
