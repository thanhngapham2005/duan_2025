-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2025 at 12:34 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id_bill` int NOT NULL COMMENT '	Mã đơn hàng',
  `id_customer` int NOT NULL COMMENT '	Mã customer',
  `receiver_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Tên người nhận',
  `receiver_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '	Số điện thoại người nhận',
  `receiver_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Địa chỉ người nhận',
  `status` tinyint NOT NULL COMMENT '	0 => "Chờ xác nhận", 1 => "Đã xác nhận", 2 => "Chờ lấy hàng", 3 => "Đang vận chuyển", 4 => "Đang hoàn trả hàng", 5 => "Giao hàng thành công", 6 => "Đã hủy",',
  `purchase_date` datetime DEFAULT NULL COMMENT 'Ngày mua'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int NOT NULL COMMENT '	Mã loại hàng',
  `name_cat` varchar(255) NOT NULL COMMENT 'Tên của loại hàng	',
  `created_at` datetime DEFAULT NULL COMMENT '	Ngày tạo',
  `updated_at` datetime DEFAULT NULL COMMENT '	Ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_comment` int NOT NULL COMMENT 'Mã bình luận',
  `id_product` int NOT NULL COMMENT '	Mã sản phẩm	',
  `id_user` int NOT NULL COMMENT 'Mã user',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '	Nội dung bình luận	',
  `censorship` tinyint NOT NULL COMMENT '0 là hiện, 1 là đã ẩn	',
  `day_post` datetime DEFAULT NULL COMMENT 'Ngày tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id_customer` int NOT NULL COMMENT 'Mã customer',
  `id_user` int DEFAULT NULL COMMENT 'Mã user',
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Tên',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Số điện thoại',
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '	Địa chỉ',
  `note` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Ghi chú(nếu có)	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_bills`
--

CREATE TABLE `detail_bills` (
  `id_detailbill` int NOT NULL COMMENT '	Mã chi tiết đơn hàng',
  `id_bill` int NOT NULL COMMENT 'Mã đơn hàng',
  `id_product` int NOT NULL COMMENT 'Mã sản phẩm',
  `id_variant` int NOT NULL COMMENT 'Mã biến thể',
  `name_product` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Tên của sản phẩm',
  `price` int NOT NULL COMMENT 'Giá của sản phẩm',
  `quantity` int NOT NULL COMMENT 'Số lượng sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int NOT NULL COMMENT '	Mã sản phẩm',
  `id_category` int NOT NULL COMMENT 'Mã loại hàng',
  `firms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '	Hãng của sản phẩm',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Tên của sản phẩm',
  `price` int NOT NULL COMMENT 'Giá của sản phẩm',
  `amount` int NOT NULL COMMENT 'Số lượng',
  `discount` int NOT NULL COMMENT '	Giảm giá của sản phẩm. Mặc định là 0% và giảm tối đa 20%',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '	Mô tả của sản phẩm',
  `img_product` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '	Hình ảnh của sản phẩm',
  `censorship` tinyint NOT NULL COMMENT '0 là hiện, 1 là đã ẩn',
  `view` int NOT NULL COMMENT 'Số lượt xem của sản phẩm',
  `created_at` datetime DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE `product_variant` (
  `id_product` int NOT NULL,
  `id_variant` int NOT NULL,
  `quantity` int UNSIGNED NOT NULL COMMENT 'Số lượng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id_rate` int NOT NULL COMMENT '	Mã đánh giá',
  `id_product` int NOT NULL COMMENT '	Mã sản phẩm	',
  `id_user` int NOT NULL COMMENT '	Mã user',
  `point` float NOT NULL COMMENT 'Điểm đánh giá	',
  `updated_at` datetime NOT NULL COMMENT 'Ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL COMMENT '	Mã user',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Địa chỉ email của user',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Mật khẩu đăng nhặp của user',
  `role` tinyint NOT NULL COMMENT '0 là khách hàng, 1 là nhân viên, 2 là quản trị',
  `day_registered` timestamp NULL DEFAULT NULL COMMENT '	Ngày đăng kí tài khoản của user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE `variant` (
  `id_variant` int NOT NULL COMMENT 'Mã biến thể',
  `name_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Tên biến thể màu',
  `created_at` datetime DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `detail_bills`
--
ALTER TABLE `detail_bills`
  ADD PRIMARY KEY (`id_detailbill`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_variant` (`id_variant`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_variant` (`id_variant`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id_rate`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`id_variant`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT COMMENT '	Mã loại hàng';

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int NOT NULL AUTO_INCREMENT COMMENT 'Mã bình luận';

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int NOT NULL AUTO_INCREMENT COMMENT 'Mã customer';

--
-- AUTO_INCREMENT for table `detail_bills`
--
ALTER TABLE `detail_bills`
  MODIFY `id_detailbill` int NOT NULL AUTO_INCREMENT COMMENT '	Mã chi tiết đơn hàng';

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT COMMENT '	Mã sản phẩm';

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id_rate` int NOT NULL AUTO_INCREMENT COMMENT '	Mã đánh giá';

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT COMMENT '	Mã user';

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `id_variant` int NOT NULL AUTO_INCREMENT COMMENT 'Mã biến thể';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id_customer`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `detail_bills`
--
ALTER TABLE `detail_bills`
  ADD CONSTRAINT `detail_bills_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `detail_bills_ibfk_2` FOREIGN KEY (`id_variant`) REFERENCES `variant` (`id_variant`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD CONSTRAINT `product_variant_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_variant_ibfk_2` FOREIGN KEY (`id_variant`) REFERENCES `variant` (`id_variant`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `rates_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
