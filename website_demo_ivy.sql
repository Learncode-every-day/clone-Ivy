-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2024 lúc 05:24 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `website_demo_ivy`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_brand`
--

CREATE TABLE `table_brand` (
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `table_brand`
--

INSERT INTO `table_brand` (`brand_id`, `category_id`, `brand_name`) VALUES
(6, 0, 'Set váy đầm 2'),
(19, 12, 'Váy 35'),
(20, 12, 'Váy 1'),
(21, 15, 'Trường'),
(22, 15, 'Giảm sâu'),
(23, 12, 'Áo sơ mi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_category`
--

CREATE TABLE `table_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `table_category`
--

INSERT INTO `table_category` (`category_id`, `category_name`) VALUES
(12, 'Nữ'),
(13, 'Nam'),
(14, 'Trẻ em'),
(15, 'Sale'),
(16, 'Bộ sưu tập'),
(17, 'Thông tin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_product`
--

CREATE TABLE `table_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_price_sale` varchar(255) NOT NULL,
  `product_desc` varchar(5000) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `table_product`
--

INSERT INTO `table_product` (`product_id`, `product_name`, `brand_id`, `product_price`, `product_price_sale`, `product_desc`, `product_img`, `category_id`) VALUES
(13, 'Sản phẩm test', 21, '45', '30', '<p>a</p>\r\n', 'pic14_1.jpg', 15),
(14, 'Trường', 21, '20', '10', '<p>Gi&aacute; trị đi k&egrave;m với chất lượng</p>\r\n', 'pic11_1.jpg', 15),
(15, 'Trường lỏ', 22, '10', '5', '<p>Rất hữu dụng với lo&agrave;i người</p>\r\n', 'pic7_1.jpg', 15),
(16, 'Áo sơ mi lụa cổ điển Lucille', 23, '30', '10', '<p>&Aacute;o sờ rất m&aacute;t tay</p>\r\n', 'pic4_1.jpg', 12),
(17, 'test', 20, '30', '10', '<p>test sản phẩm</p>\r\n', 'pic6_1.jpg', 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_product_img_desc`
--

CREATE TABLE `table_product_img_desc` (
  `product_id` int(11) NOT NULL,
  `product_img_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `table_product_img_desc`
--

INSERT INTO `table_product_img_desc` (`product_id`, `product_img_desc`) VALUES
(13, 'pic14_6.jpg'),
(13, 'pic14_5.jpg'),
(13, 'pic14_4.jpg'),
(13, 'pic14_3.jpg'),
(13, 'pic14_2.jpg'),
(13, 'pic14_1.jpg'),
(14, 'pic11_8.jpg'),
(14, 'pic11_7.jpg'),
(14, 'pic11_6.jpg'),
(14, 'pic11_5.jpg'),
(14, 'pic11_4.jpg'),
(14, 'pic11_3.jpg'),
(14, 'pic11_2.jpg'),
(14, 'pic11_1.jpg'),
(15, 'pic7_6.jpg'),
(15, 'pic7_5.jpg'),
(15, 'pic7_4.jpg'),
(15, 'pic7_3.jpg'),
(15, 'pic7_2.jpg'),
(15, 'pic7_1.jpg'),
(16, 'pic4_6.jpg'),
(16, 'pic4_5.jpg'),
(16, 'pic4_4.jpg'),
(16, 'pic4_3.jpg'),
(16, 'pic4_2.jpg'),
(16, 'pic4_1.jpg'),
(17, 'pic6_6.jpg'),
(17, 'pic6_5.jpg'),
(17, 'pic6_4.jpg'),
(17, 'pic6_3.jpg'),
(17, 'pic6_2.jpg'),
(17, 'pic6_1.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `table_brand`
--
ALTER TABLE `table_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `table_category`
--
ALTER TABLE `table_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `table_product`
--
ALTER TABLE `table_product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `table_brand`
--
ALTER TABLE `table_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `table_category`
--
ALTER TABLE `table_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `table_product`
--
ALTER TABLE `table_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
