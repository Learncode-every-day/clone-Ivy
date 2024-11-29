<header class="header">
    <div class="container">
        <div class="header__inner">
            <div class="menu">
                <ul class="menu__list">
                    <?php
                    $show_category = $category->show_category();
                    if ($show_category) {
                        while ($result = $show_category->fetch_assoc()) {
                    ?>
                            <li class="menu__item">
                                <a href="http://localhost/clone-Ivy/category.php?category_id=<?php echo $result['category_id'] ?>"
                                    class="menu__link"><?php echo $result['category_name']; ?></a>
                                <ul class="sub-menu">
                                    <?php
                                    $show_brand = $brand->show_brand();
                                    if ($show_brand) {
                                        while ($resultA = $show_brand->fetch_assoc()) {
                                    ?>
                                            <?php if ($result['category_id'] === $resultA['category_id']) { ?>
                                                <li class="sub-menu__item">
                                                    <a href="http://localhost/clone-Ivy/category.php?brand_id=<?php echo $resultA['brand_id'] ?>&category_id=<?php echo $resultA['category_id'] ?>"
                                                        class="sub-menu__link"><?php echo $resultA['brand_name']; ?></a>
                                                    <ul class="sub-menu-clone">
                                                        <?php $show_product = $product->show_product();
                                                        if ($show_product) {
                                                            while ($resultB = $show_product->fetch_assoc()) {
                                                                if ($resultA['brand_id'] === $resultB['brand_id']) {
                                                        ?>
                                                                    <li class="sub-menu-clone__item">
                                                                        <a href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $resultB['product_id'] ?>&brand_id=<?php echo $resultB['brand_id'] ?>&category_id=<?php echo $resultB['category_id'] ?>"
                                                                            class="sub-menu-clone__link">
                                                                            <?php echo $resultB['product_name']; ?>
                                                                        </a>
                                                                    </li>
                                                        <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                            <?php } ?>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="logo">
                <a href="#">
                    <img src="./assets/img/logo.png" alt="" class="logo__icon" />
                </a>
            </div>

            <div class="other">
                <ul class="other__list">
                    <li class="other__item" style="position: relative;">
                        <form method="post" id="form-search">
                            <input type="text" name="content" id="search-input" class="search-box"
                                placeholder="Tìm kiếm" />
                            <button type="submit" name="btn-search" id="btn-search">
                                <img src="./assets/icons/search.svg" alt="" class="search-icon" />
                            </button>
                        </form>
                        <br>
                        <!-- Lấy nội dung phần tìm kiếm -->
                        <?php
                        if (isset($_POST['btn-search'])) {
                            $content = $_POST['content'];
                            // echo $content;
                        } else {
                            $content = false;
                        }
                        ?>
                        <div hidden id="search-table"
                            style="display: none; position: absolute; top:35px;max-height: 250px; overflow-y:auto;">
                            <table class="item-search__list"
                                style="font-size: 1.1rem; background: #fff; text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá sản phẩm</th>
                                        <th>Giá sau khi giảm</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    // Bắt đầu sử dụng truy vấn để lấy sản phẩm
                                    $show_product_by_content = $product->get_product_by_content($content);
                                    if ($show_product_by_content) {
                                        while ($result = $show_product_by_content->fetch_assoc()) {
                                    ?>
                                            <tr class="item-search__item">

                                                <td class="item-search__name"><a
                                                        href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id'] ?>"><?php echo $result['product_name'] ?></a>
                                                </td>
                                                <td style="display: flex; align-items:center; justify-content: center;">
                                                    <a
                                                        href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id'] ?>">
                                                        <img style="width: 50px; object-fit:contain; "
                                                            src="./admin/uploads/<?php echo $result['product_img'] ?>" alt="">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a
                                                        href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id'] ?>">
                                                        <?php echo $result['product_price'] ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a
                                                        href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id'] ?>">
                                                        <?php echo $result['product_price_sale'] ?>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </li>
                    <li class="other__item">
                        <a href="#!" class="other__link">
                            <img src="./assets/icons/bell.svg" alt="" class="bell-icon" />
                        </a>
                    </li>
                    <li class="other__item">
                        <div class="dropdown">
                            <div class="dropdown__select">
                                <!-- <span class="dropdown_selected">Call to action</span>
                                    <i class="fa fa-caret-down dropdown__caret"></i> -->
                                <a href="#!" class="other__link">
                                    <img src="./assets/icons/user.svg" alt="" class="user-icon" />
                                </a>
                            </div>
                            <ul class="dropdown__list">
                                <li class="dropdown__item">
                                    <a href="http://localhost/clone-Ivy/index.php">
                                        <span class="dropdown__text">Trang chủ</span>
                                        <i class="fa fa-plus-circle dropdown__icon"></i>
                                    </a>
                                </li>
                                <li class="dropdown__item">
                                    <a href="info_user.php?email_user=<?php echo $_SESSION['myAccount']; ?>">
                                        <span class="dropdown__text">Thông tin tài khoản</span>
                                        <i class="fa fa-plus-circle dropdown__icon"></i>
                                    </a>
                                </li>
                                <li class="dropdown__item">
                                    <a href="http://localhost/clone-Ivy/logout.php">
                                        <span class="dropdown__text">Đăng xuất</span>
                                        <i class="fa fa-plus-circle dropdown__icon"></i>
                                    </a>
                                </li>
                                <li class="dropdown__item">
                                    <a href="http://localhost/clone-Ivy/admin/category-add.php">
                                        <span class="dropdown__text">Vào trang quản lý</span>
                                        <i class="fa fa-plus-circle dropdown__icon"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="other__item other__item-cart">
                        <div class="dropdown">
                            <div class="dropdown__select">
                                <a href="http://localhost/clone-Ivy/cart.php" class="other__link"><img
                                        src="./assets/icons/cart-shopping.svg" alt="" class="cart-icon" />
                                </a>
                            </div>
                            <?php
                            $cart = new Cart();
                            $count_cart = $cart->count_product_in_cart();
                            if ($count_cart) {
                                $result = $count_cart->fetch_assoc();
                                // var_dump($result);
                            }

                            ?>
                            <span class="header-cart__notice"><?php echo $result['total']; ?></span>
                            <ul class="dropdown__list dropdown__list-cart">
                                <?php
                                $cart = new Cart();
                                $show_cart = $cart->show_cart();
                                if ($show_cart) {
                                    // var_dump($show_cart);
                                    while ($result = $show_cart->fetch_assoc()) {
                                        // var_dump($result);

                                ?>
                                        <li class="dropdown__item">
                                            <a style="display: flex; position: relative; width: 100%; justify-content: space-around; flex-direction: column"
                                                href="http://localhost/clone-Ivy/product.php?product_id=<?php echo $result['product_id']; ?>&brand_id=<?php echo $result['brand_id'] ?>&category_id=<?php echo $result['category_id'] ?>">
                                                <img style="height: 50px; width: 30px; object-fit:contain; display:block;"
                                                    src="./admin/uploads/<?php echo $result['product_img']; ?>" alt="">
                                                <div style="display: flex; position: relative; width: 100%; justify-content: space-around; flex-direction: column"
                                                    class="cart-info">
                                                    <h3
                                                        style="font-size: 1.5rem; white-space: nowrap; overflow:hidden; text-overflow: ellipsis; width: 130px;">
                                                        <?php echo $result['cart_name'] ?></h3>
                                                    <div
                                                        style="display: flex; align-items:center; justify-content:space-between;  margin-top: 10px; width: 100%;">
                                                        <span style="font-size: 0.8rem">Giá:
                                                            <?php
                                                            $number = str_replace('đ', '', $result['cart_price']);
                                                            // Sử dụng hàm number_format để thêm dấu chấm
                                                            $formattedPrice = number_format($number, 0, ',', '.') . 'đ';
                                                            echo $formattedPrice; ?></span>
                                                        <span style="font-size: 0.8rem">Số lượng:
                                                            <?php echo $result['cart_quantity'] ?></span>
                                                    </div>
                                                    <div style="font-size: 0.8rem; margin-top: 20px; ">
                                                        <a
                                                            href="handle-click.php?action=delete&product_id=<?php echo $result['product_id'] ?>"><span>Xóa</span></a>
                                                        <a style="margin-left: 30px"
                                                            href="handle-click.php?action=detail&product_id=<?php echo $result['product_id'] ?>"><span>Xem
                                                                chi tiết</span></a>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>