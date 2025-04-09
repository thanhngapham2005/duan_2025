-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2025 at 03:03 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.18

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

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `name_cat`, `created_at`, `updated_at`) VALUES
(7, 'Điện thoại', NULL, NULL),
(8, 'Tai nghe', NULL, NULL),
(9, 'Laptop', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_comment` int NOT NULL COMMENT 'Mã bình luận',
  `id_product` int NOT NULL COMMENT '	Mã sản phẩm	',
  `id_user` int NOT NULL COMMENT 'Mã user',
  `rating` int NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '	Nội dung bình luận	',
  `censorship` tinyint NOT NULL COMMENT '0 là hiện, 1 là đã ẩn	',
  `day_post` datetime DEFAULT NULL COMMENT 'Ngày tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comment`, `id_product`, `id_user`, `rating`, `content`, `censorship`, `day_post`) VALUES
(1, 1, 1, 0, 'sản phẩm xấu vl', 0, NULL),
(2, 11, 1, 5, 'aaaa', 0, NULL),
(3, 12, 1, 5, 'a', 0, NULL),
(9, 10, 1, 3, 'aa', 0, '2025-04-04 09:02:33'),
(10, 10, 1, 4, 'aaaaaaaaaa', 0, '2025-04-04 10:44:32'),
(11, 10, 1, 1, 'như lonnn', 0, '2025-04-04 10:45:23'),
(12, 10, 1, 4, 'a', 0, '2025-04-04 10:46:35'),
(13, 10, 1, 3, 'a', 0, '2025-04-04 10:48:23'),
(14, 10, 1, 2, 'a', 0, '2025-04-04 10:49:49'),
(15, 10, 1, 3, 'a', 0, '2025-04-04 10:51:13'),
(16, 10, 1, 4, 'ccc', 0, '2025-04-04 10:56:39'),
(17, 10, 1, 4, 'ccc', 0, '2025-04-04 10:56:40'),
(18, 10, 1, 4, 'ccc', 0, '2025-04-04 10:56:40'),
(19, 10, 1, 4, 'ccc', 0, '2025-04-04 10:56:40'),
(20, 10, 1, 4, 'ccc', 0, '2025-04-04 10:56:41'),
(21, 10, 1, 4, 'ccc', 0, '2025-04-04 10:56:51'),
(22, 10, 1, 4, 'ccc', 0, '2025-04-04 10:56:55'),
(23, 10, 1, 4, 'ccc', 0, '2025-04-04 10:56:56'),
(24, 10, 1, 3, 'c', 0, '2025-04-04 10:57:04'),
(25, 12, 1, 3, 'hahah', 0, '2025-04-04 11:02:49'),
(26, 12, 1, 4, 'q', 0, '2025-04-04 11:03:42'),
(27, 11, 3, 1, 'nhu cut', 0, '2025-04-04 19:43:36');

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

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id_customer`, `id_user`, `full_name`, `phone`, `address`, `note`) VALUES
(1, 1, 'đỗ tuấn thiện', '0329714023', 'nghệ an', NULL),
(2, 2, 'đỗ tuấn thiện', '', '', NULL),
(3, 3, 'tthien', '', '', NULL);

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
  `id_product` int NOT NULL COMMENT 'Mã sản phẩm	',
  `id_category` int NOT NULL COMMENT 'Mã loại hàng	',
  `firms` varchar(255) NOT NULL COMMENT 'Hãng của sản phẩm	',
  `name` varchar(255) NOT NULL COMMENT 'Tên của sản phẩm	',
  `price` int NOT NULL COMMENT 'Giá của sản phẩm	',
  `amount` int NOT NULL COMMENT 'Số lượng	',
  `discount` int NOT NULL COMMENT 'Giảm giá của sản phẩm. Mặc định là 0% và giảm tối đa 20%	',
  `description` text COMMENT 'Mô tả của sản phẩm	',
  `img_product` varchar(255) DEFAULT NULL COMMENT 'Hình ảnh của sản phẩm	',
  `censorship` tinyint NOT NULL DEFAULT '0' COMMENT '0 là hiện, 1 là đã ẩn	',
  `view` int NOT NULL DEFAULT '0' COMMENT 'Số lượt xem của sản phẩm	',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo	',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày cập nhật	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `id_category`, `firms`, `name`, `price`, `amount`, `discount`, `description`, `img_product`, `censorship`, `view`, `created_at`, `updated_at`) VALUES
(1, 8, 'Soundcore ', 'Tai nghe Bluetooth A3949', 360000, 39, 20, 'Tai nghe không dây Anker Soundcore R50I-A3949 - Chất âm tốt, thiết kế sang trọng', 'tải xuống.jpg', 0, 0, '2025-03-28 09:08:56', '2025-03-30 02:12:40'),
(2, 7, 'Samsung', 'Samsung Galaxy S23', 13690000, 41, 0, 'Galaxy AI tiện ích - Khoanh vùng search đa năng, là trợ lý chỉnh ảnh, chat thông minh, phiên dịch trực tiếp', 'tải xuống (1).jpg', 0, 0, '2025-03-29 23:17:34', '2025-03-29 23:17:34'),
(3, 7, 'Apple', 'iPhone 16 Pro Max ', 3409000, 56, 0, 'Màn hình Super Retina XDR 6,9 inch lớn hơn có viền mỏng hơn, đem đến cảm giác tuyệt vời khi cầm trên tay.', 'tải xuống (3).jpg', 0, 0, '2025-03-29 23:31:01', '2025-03-29 23:31:52'),
(4, 7, 'Apple', 'iPhone 13 128GB', 1339000, 58, 0, 'Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng 5G tốc độ cao', 'tải xuống (4).jpg', 0, 0, '2025-03-29 23:38:52', '2025-03-29 23:38:52'),
(5, 7, 'Apple', 'iPhone 14 Pro Max 256GB', 15390000, 117, 0, 'iPhone 14 có màn hình 6.1 inch, chip A15 Bionic, camera 12MP cải tiến, hỗ trợ SOS vệ tinh và phát hiện va chạm. Pin tốt hơn, thiết kế như iPhone 13.', 'tải xuống (12).jpg', 0, 0, '2025-03-29 23:43:19', '2025-03-30 00:17:47'),
(6, 8, 'Apple', 'Tai nghe Bluetooth AirPods 4', 3450000, 104, 0, 'Chip H2 nổi bật, mạnh mẽ được tích hợp trong Airpod 4 giúp trải nghiệm âm thanh của bạn mượt mà hơn.', 'tải xuống (6).jpg', 0, 0, '2025-03-29 23:47:54', '2025-03-29 23:47:54'),
(7, 8, 'Tai nghe Bluetooth chụp tai Sony WH-1000XM5', 'Tai nghe Bluetooth 1000XM5', 360000, 101, 0, '360000', 'tải xuống (13).jpg', 0, 0, '2025-03-29 23:50:55', '2025-03-30 02:12:19'),
(8, 8, 'Choetech Vietnam', 'Tai nghe Bluetooth BH-T16', 659000, 67, 0, 'Tai nghe Bluetooth BH-T16 là sự lựa chọn hoàn hỏa giúp bạn giải tỏa áp lực, căng thẳng sau giờ làm việc hay cho bạn đắm chìm vào những bản nhạc mà mình yêu thích.', 'images.jpg', 0, 0, '2025-03-29 23:58:42', '2025-03-29 23:58:42'),
(9, 9, 'Laptop Lenovo', 'Laptop Lenovo 5 14Q8X9 ', 22990000, 135, 0, 'Laptop có màu xám thanh lịch, kiểu dáng mỏng nhẹ, dễ dàng mang theo khi di chuyển.', 'tải xuống (8).jpg', 0, 0, '2025-03-30 00:01:02', '2025-03-30 00:08:45'),
(10, 9, 'ASUS', 'Laptop ASUS 15 X1504ZA', 13990000, 70, 0, '13990000', 'images (1).jpg', 0, 0, '2025-03-30 00:05:49', '2025-03-30 00:08:39'),
(11, 9, 'Acer ', 'Laptop Acer Gaming', 13990000, 70, 0, 'Màn hình FHD 15.6 inch với độ sáng 250 nits và độ phủ màu 45% NTSC, mang lại hình ảnh sắc nét và sống động', 'tải xuống (9).jpg', 0, 0, '2025-03-30 00:08:33', '2025-03-30 00:08:33'),
(12, 9, 'FPT Shop', 'Laptop MSI Katana', 25990000, 60, 0, 'Nguyên hộp, đầy đủ phụ kiện từ nhà sản xuất\r\nBảo hành pin và bộ sạc 12 tháng\r\nBộ nguồn, máy, balo, sách hdsd\r\nBảo hành 24 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất\r\nGiá sản phẩm đã bao gồm VAT', 'tải xuống (11).jpg', 0, 0, '2025-03-30 00:13:23', '2025-03-30 02:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE `product_variant` (
  `id_product` int NOT NULL,
  `id_variant` int NOT NULL,
  `quantity` int NOT NULL COMMENT 'Số lượng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_variant`
--

INSERT INTO `product_variant` (`id_product`, `id_variant`, `quantity`) VALUES
(1, 4, 39),
(2, 4, 21),
(2, 5, 20),
(3, 4, 26),
(3, 5, 30),
(4, 4, 28),
(4, 5, 30),
(5, 4, 26),
(5, 5, 34),
(5, 6, 40),
(5, 7, 17),
(6, 4, 50),
(6, 5, 54),
(7, 5, 56),
(7, 4, 45),
(8, 4, 67),
(9, 4, 70),
(9, 5, 65),
(10, 4, 30),
(10, 5, 40),
(11, 4, 30),
(11, 5, 40),
(12, 4, 60);

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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `role`, `day_registered`) VALUES
(1, 'admin@gmail.com', '$2y$10$9xE3hWy9qgUnnJwY8gCM3.dZdS899Rpwtdv4F2pIvhSQBk1PkuCY.', 2, NULL),
(2, 'dotuanthiendz112@gmail.com', '$2y$10$RDzrLLjYPHrcUtyfWXFX5u7yyHAraWLDK9wcGC.eSjvCM45bKVftq', 0, NULL),
(3, 't@t.t', '$2y$10$ijLV2UXQNsaGvTg36XLjquTXaWCU6QUA3biLGWFkEuZ4MtklYPWXK', 0, NULL);

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
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`id_variant`, `name_color`, `created_at`, `updated_at`) VALUES
(4, 'Đen', NULL, NULL),
(5, 'Trắng', NULL, NULL),
(6, 'Vàng', NULL, NULL),
(7, 'Tím', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id_bill`),
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
  ADD KEY `id_variant` (`id_variant`),
  ADD KEY `id_bill` (`id_bill`);

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
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id_bill` int NOT NULL AUTO_INCREMENT COMMENT '	Mã đơn hàng';

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT COMMENT '	Mã loại hàng', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int NOT NULL AUTO_INCREMENT COMMENT 'Mã bình luận', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int NOT NULL AUTO_INCREMENT COMMENT 'Mã customer', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_bills`
--
ALTER TABLE `detail_bills`
  MODIFY `id_detailbill` int NOT NULL AUTO_INCREMENT COMMENT '	Mã chi tiết đơn hàng';

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT COMMENT 'Mã sản phẩm	', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT COMMENT '	Mã user', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `id_variant` int NOT NULL AUTO_INCREMENT COMMENT 'Mã biến thể', AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `detail_bills`
--
ALTER TABLE `detail_bills`
  ADD CONSTRAINT `detail_bills_ibfk_2` FOREIGN KEY (`id_variant`) REFERENCES `variant` (`id_variant`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `detail_bills_ibfk_3` FOREIGN KEY (`id_bill`) REFERENCES `bills` (`id_bill`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `detail_bills_ibfk_4` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
