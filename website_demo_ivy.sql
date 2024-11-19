-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 18, 2024 lúc 06:18 AM
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
(11, 17, 'Địa Chỉ'),
(12, 17, 'Số điện thoại'),
(13, 16, 'Set váy đầm'),
(14, 15, 'Váy ngủ'),
(15, 14, 'Set combo 3 trong 1'),
(16, 13, 'Áo thun'),
(17, 12, 'Váy');

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
(6, 'Sản phẩm test', 16, '54564', '1313', 'adawdwdad', '341848671_1949273305408129_8604018268707300477_n.jpg', 17),
(7, 'a', 16, '54564', '1313', 'dauwgudikaw', '341848671_1949273305408129_8604018268707300477_n.jpg', 17),
(8, 'a', 17, '54564', '1313', 'adwdwa', 'dan-heng-honkai-star-rail.gif', 17),
(9, 'a', 17, '54564', '1313', 'đuawad', '0106_hinh-nen-4k-may-tinh32.jpg', 17),
(10, 'a', 17, '54564', '1313', 'đuawad', '0106_hinh-nen-4k-may-tinh32.jpg', 17),
(11, 'a', 12, '54564', '1313', '<p><img alt=\"\" src=\"/clone-IVY/admin/images/files/0106_hinh-nen-4k-may-tinh4.jpg\" style=\"height:900px; width:1600px\" /></p>\r\n', '0106_hinh-nen-4k-may-tinh4.jpg', 17);

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
(8, 'd660f4eacc3a7f35aff15292afe34f91.png'),
(8, 'dan-heng-honkai-star-rail.gif'),
(8, 'FTqhyhCUsAAyPmI.jpeg'),
(9, '740051.jpg'),
(9, 'anh-dong-luc-cho-ban-than_105243618.jpg'),
(9, 'anh-nen-4k-cho-win-10_105907787.jpg'),
(10, '740051.jpg'),
(10, 'anh-dong-luc-cho-ban-than_105243618.jpg'),
(10, 'anh-nen-4k-cho-win-10_105907787.jpg'),
(11, '0106_hinh-nen-4k-may-tinh4.jpg'),
(11, '0106_hinh-nen-4k-may-tinh32.jpg'),
(11, '999-hinh-nen-may-tinh-pc-laptop-full-hd-2k-4k-8k-cuc-dep-2019-3.jpg');

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
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `table_category`
--
ALTER TABLE `table_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `table_product`
--
ALTER TABLE `table_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
