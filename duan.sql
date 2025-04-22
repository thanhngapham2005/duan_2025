-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2025 at 05:46 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

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
  `purchase_date` datetime DEFAULT NULL COMMENT 'Ngày mua',
  `discount_code_id` int DEFAULT NULL COMMENT 'Mã giảm giá',
  `discount_amount` int NOT NULL COMMENT 'Số tiền đã được giảm giá\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id_bill`, `id_customer`, `receiver_name`, `receiver_phone`, `receiver_address`, `status`, `purchase_date`, `discount_code_id`, `discount_amount`) VALUES
(1, 2, 'klasdflksd', '0254504577', 'ssdf', 3, '2025-03-31 07:37:41', 1, 13590000),
(2, 2, 'klasdflksd', '0258963', 'kjhgfd', 1, '2025-04-09 21:02:53', 2, 185909500),
(3, 4, 'Lê Duy Nhất', '0258963', 'kjhgfd', 5, '2025-04-09 23:41:52', 1, 13590000),
(4, 2, 'klasdflksd', '0254504577', 'ssdf', 6, '2025-04-14 08:08:52', 1, 980000),
(5, 6, 'thanh nga', '0367324106', 'Hà đông', 0, '2025-04-19 17:07:45', 3, 103460000),
(6, 5, 'jk', '0367324106', 'kjhgfd', 0, '2025-04-21 00:09:32', 3, 500000),
(7, 6, 'thanh nga', '0367324106', 'Hà đông', 0, '2025-04-21 02:47:18', 3, 39180000),
(8, 6, 'thanh nga', '0367324106', 'jkl;', 0, '2025-04-21 02:58:56', 3, 13190000),
(9, 5, 'jk', '0367324106', 'ssdf', 0, '2025-04-21 04:34:35', 3, 500000),
(10, 5, 'jk', '0367324106', 'ssdf', 0, '2025-04-21 04:34:35', 3, 500000),
(11, 5, 'jk', '0367324106', 'ssdf', 0, '2025-04-21 20:18:33', 3, 500000),
(12, 5, 'jk', '0367324106', 'ssdf', 2, '2025-04-21 20:18:33', 3, 500000);

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
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '	Nội dung bình luận	',
  `censorship` tinyint NOT NULL COMMENT '0 là hiện, 1 là đã ẩn	',
  `day_post` datetime DEFAULT NULL COMMENT 'Ngày tạo',
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comment`, `id_product`, `id_user`, `content`, `censorship`, `day_post`, `rating`) VALUES
(1, 6, 2, 'ok', 1, NULL, 0);

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
(1, 1, 'xđxdxf', '', '', NULL),
(2, 2, 'klasdflksd', '', '', NULL),
(3, 3, 'xđxdxf', '', '', NULL),
(4, 4, 'Lê Duy Nhất', '', '', NULL),
(5, 5, 'jk', '', '', NULL),
(6, 6, 'thanh nga', '', '', NULL);

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

--
-- Dumping data for table `detail_bills`
--

INSERT INTO `detail_bills` (`id_detailbill`, `id_bill`, `id_product`, `id_variant`, `name_product`, `price`, `quantity`) VALUES
(1, 1, 2, 4, 'Samsung Galaxy S23', 13690000, 1),
(2, 2, 12, 4, 'Laptop MSI Katana', 25990000, 5),
(3, 2, 11, 4, 'Laptop Acer Gaming', 13990000, 2),
(4, 2, 10, 4, 'Laptop ASUS 15 X1504ZA', 13990000, 2),
(5, 3, 2, 4, 'Samsung Galaxy S23', 13690000, 1),
(6, 4, 1, 4, 'Tai nghe Bluetooth A3949', 360000, 3),
(7, 5, 12, 4, 'Laptop MSI Katana', 25990000, 4),
(8, 6, 12, 4, 'Laptop MSI Katana', 25990000, 1),
(9, 6, 2, 4, 'Samsung Galaxy S23', 13690000, 1),
(10, 7, 2, 4, 'Samsung Galaxy S23', 13690000, 1),
(11, 7, 12, 4, 'Laptop MSI Katana', 25990000, 1),
(12, 8, 2, 4, 'Samsung Galaxy S23', 13690000, 1),
(13, 10, 2, 4, 'Samsung Galaxy S23', 13690000, 1),
(14, 12, 6, 4, 'Tai nghe Bluetooth AirPods 4', 3450000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int NOT NULL COMMENT 'Mã giảm giá',
  `code` varchar(255) NOT NULL COMMENT 'Mã code giảm giá	',
  `discount_percentage` decimal(5,2) NOT NULL COMMENT 'Phần trăm giảm giá	',
  `max_discount` decimal(10,2) NOT NULL COMMENT 'Giảm giá tối đa	',
  `min_order_value` decimal(10,2) NOT NULL COMMENT 'Giá trị đơn hàng tối thiểu	',
  `start_date` datetime NOT NULL COMMENT 'Ngày bắt đầu áp dụng	',
  `end_date` datetime NOT NULL COMMENT 'Ngày kết thúc	',
  `usage_limit` int NOT NULL COMMENT 'Số lần sử dụng tối đa	',
  `used_count` int NOT NULL COMMENT 'Số lần đã sử dụng	',
  `status` enum('active','expired','disabled') NOT NULL COMMENT 'Trạng thái	',
  `created_at` datetime NOT NULL COMMENT 'Ngày tạo',
  `updated_at` datetime NOT NULL COMMENT 'Ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `discount_codes`
--

INSERT INTO `discount_codes` (`id`, `code`, `discount_percentage`, `max_discount`, `min_order_value`, `start_date`, `end_date`, `usage_limit`, `used_count`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TESTCODE', '10.00', '100000.00', '500000.00', '2025-04-01 00:00:00', '2025-04-19 00:00:00', 100, 0, 'active', '2025-04-04 01:05:16', '2025-04-09 00:10:07'),
(2, 'T5JK', '50.00', '500.00', '350.00', '2025-04-05 00:00:00', '2025-04-19 00:00:00', 10, 0, 'active', '2025-04-08 23:59:55', '2025-04-08 23:59:55'),
(3, 'KL', '50.00', '500000.00', '13690000.00', '2025-04-05 00:00:00', '2025-04-25 00:00:00', 50, 0, 'active', '2025-04-09 17:08:06', '2025-04-09 17:08:06');

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

INSERT INTO `products` (`id_product`, `id_category`, `firms`, `name`, `price`, `amount`, `description`, `img_product`, `censorship`, `view`, `created_at`, `updated_at`) VALUES
(1, 8, 'Soundcore ', 'Tai nghe Bluetooth A3949', 360000, 39, 'Tai nghe không dây Anker Soundcore R50I-A3949 - Chất âm tốt, thiết kế sang trọng', 'tải xuống.jpg', 0, 65, '2025-03-28 09:08:56', '2025-03-30 02:12:40'),
(2, 7, 'Samsung', 'Samsung Galaxy S23', 13690000, 40, 'Galaxy AI tiện ích - Khoanh vùng search đa năng, là trợ lý chỉnh ảnh, chat thông minh, phiên dịch trực tiếp', 'tải xuống (1).jpg', 0, 105, '2025-03-29 23:17:34', '2025-03-29 23:17:34'),
(3, 7, 'Apple', 'iPhone 16 Pro Max ', 3409000, 56, 'Màn hình Super Retina XDR 6,9 inch lớn hơn có viền mỏng hơn, đem đến cảm giác tuyệt vời khi cầm trên tay.', 'tải xuống (3).jpg', 0, 34, '2025-03-29 23:31:01', '2025-03-29 23:31:52'),
(4, 7, 'Apple', 'iPhone 13 128GB', 1339000, 58, 'Hiệu năng vượt trội - Chip Apple A15 Bionic mạnh mẽ, hỗ trợ mạng 5G tốc độ cao', 'tải xuống (4).jpg', 0, 92, '2025-03-29 23:38:52', '2025-03-29 23:38:52'),
(5, 7, 'Apple', 'iPhone 14 Pro Max 256GB', 15390000, 117, 'iPhone 14 có màn hình 6.1 inch, chip A15 Bionic, camera 12MP cải tiến, hỗ trợ SOS vệ tinh và phát hiện va chạm. Pin tốt hơn, thiết kế như iPhone 13.', 'tải xuống (12).jpg', 0, 45, '2025-03-29 23:43:19', '2025-03-30 00:17:47'),
(6, 8, 'Apple', 'Tai nghe Bluetooth AirPods 4', 3450000, 104, 'Chip H2 nổi bật, mạnh mẽ được tích hợp trong Airpod 4 giúp trải nghiệm âm thanh của bạn mượt mà hơn.', 'tải xuống (6).jpg', 0, 76, '2025-03-29 23:47:54', '2025-03-29 23:47:54'),
(7, 8, 'Tai nghe Bluetooth chụp tai Sony WH-1000XM5', 'Tai nghe Bluetooth 1000XM5', 360000, 101, 'Công nghệ Auto NC Optimizer tự động khử tiếng ồn dựa theo môi trường', 'tải xuống (13).jpg', 0, 82, '2025-03-29 23:50:55', '2025-04-15 22:32:02'),
(8, 8, 'Choetech Vietnam', 'Tai nghe Bluetooth BH-T16', 659000, 67, 'Tai nghe Bluetooth BH-T16 là sự lựa chọn hoàn hỏa giúp bạn giải tỏa áp lực, căng thẳng sau giờ làm việc hay cho bạn đắm chìm vào những bản nhạc mà mình yêu thích.', 'images.jpg', 0, 9, '2025-03-29 23:58:42', '2025-03-29 23:58:42'),
(9, 9, 'Laptop Lenovo', 'Laptop Lenovo 5 14Q8X9 ', 22990000, 135, 'Laptop có màu xám thanh lịch, kiểu dáng mỏng nhẹ, dễ dàng mang theo khi di chuyển.', 'tải xuống (8).jpg', 0, 19, '2025-03-30 00:01:02', '2025-03-30 00:08:45'),
(10, 9, 'ASUS', 'Laptop ASUS 15 X1504ZA', 13990000, 70, 'Màn hình FHD 15.6 inch với độ sáng 250 nits và độ phủ màu 45% NTSC, mang lại hình ảnh sắc nét và sống động', 'images (1).jpg', 0, 110, '2025-03-30 00:05:49', '2025-04-15 22:31:34'),
(11, 9, 'Acer ', 'Laptop Acer Gaming', 13990000, 70, 'Màn hình FHD 15.6 inch với độ sáng 250 nits và độ phủ màu 45% NTSC, mang lại hình ảnh sắc nét và sống động', 'tải xuống (9).jpg', 0, 26, '2025-03-30 00:08:33', '2025-03-30 00:08:33'),
(12, 9, 'FPT Shop', 'Laptop MSI Katana', 25990000, 60, 'Nguyên hộp, đầy đủ phụ kiện từ nhà sản xuất\r\nBảo hành pin và bộ sạc 12 tháng\r\nBộ nguồn, máy, balo, sách hdsd\r\nBảo hành 24 tháng tại trung tâm bảo hành Chính hãng. 1 đổi 1 trong 30 ngày nếu có lỗi phần cứng từ nhà sản xuất\r\nGiá sản phẩm đã bao gồm VAT', 'tải xuống (11).jpg', 0, 51, '2025-03-30 00:13:23', '2025-03-30 02:04:08'),
(13, 8, 'AVA+', 'Tai nghe Bluetooth FreeGo ', 230000, 56, 'Tai nghe Bluetooth TWS AVA+ FreeGo Y913 không chỉ đem lại sự tiện lợi tối đa mà còn mang đến trải nghiệm âm nhạc chân thực và sắc nét. Với thiết kế nhỏ gọn, hiện đại cùng công nghệ tiên tiến, Y913 hứa hẹn là người bạn đồng hành hoàn hảo cho mọi hoạt động của bạn.', 'tai-nghe-bluetooth-tws-ava-freego-y913-trang-2-1-750x500.jpg', 0, 13, '2025-04-16 01:51:22', '2025-04-21 22:49:08'),
(14, 7, 'Nubia - ZTE', 'Nubia V70 Design', 2990000, 102, 'Nubia V70 Design là mẫu smartphone mới của ZTE nubia, hướng đến người dùng muốn trải nghiệm điện thoại giá rẻ với phong cách flagship. Máy nổi bật với màn hình lớn tần số quét cao, camera AI sắc nét, pin “trâu” và đặc biệt là mặt lưng vegan leather tùy chọn sang trọng. Dù thuộc phân khúc giá phổ thông, nubia V70 Design vẫn mang đến nhiều tính năng hấp dẫn cho cả nhu cầu giải trí, chơi game và sử dụng hàng ngày.', 'nubia_v70_design_xam_5_1edc0cc884.webp', 0, 52, '2025-04-21 22:39:17', '2025-04-21 22:39:17');

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
(2, 4, 20),
(2, 11, 20),
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
(11, 6, 40),
(12, 4, 60),
(13, 5, 56),
(14, 4, 56),
(14, 6, 46);

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
(2, 'kienntph49023@gmail.com', '$2y$10$NSDIBCc80ttU9KhhxcMHTOUybz5vrfJ7arMv3sIF7luXKRqJMdYZ.', 0, NULL),
(3, 'dotuanthiendz112@gmail.com', '$2y$10$z98EbmbkYskvw5Vb0571O.UoHM5wrpZ3HSkPpAr6/KXw/e0lQMusq', 0, NULL),
(4, 'kiennguyentrung07092005@gmail.com', '$2y$10$k4aQSky/Nve7jt/CSLhGu.W5R8UZSjUm.9mbR4yG1oIZ0kPbM7K0a', 0, NULL),
(5, 'jk@gmail.com', '$2y$10$JXG0WgExCIoDdcSyg8wEMe8wXG/P3hTeHZ8otH1EgfKHIiZnhfezG', 0, NULL),
(6, 'tn@gmail.com', '$2y$10$PwHElr19iJJfBBlbafQAuuiNfpiAqXIfLnDMtWszTzB.9NbpiUCja', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE `variant` (
  `id_variant` int NOT NULL COMMENT 'Mã biến thể',
  `name_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Tên biến thể màu',
  `created_at` datetime DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật',
  `name_capacity` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Dung lượng máy'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`id_variant`, `name_color`, `created_at`, `updated_at`, `name_capacity`) VALUES
(4, 'Đen', NULL, NULL, '128GB'),
(5, 'Trắng', NULL, NULL, '4h'),
(6, 'Vàng', NULL, NULL, '256GB'),
(7, 'Tím', NULL, NULL, '128GB'),
(9, 'Hồng Phấn', NULL, NULL, '64GB'),
(11, 'Trắng', NULL, NULL, '64GB');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id_bill`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `discount_code_id` (`discount_code_id`);

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
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_bill` int NOT NULL AUTO_INCREMENT COMMENT '	Mã đơn hàng', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT COMMENT '	Mã loại hàng', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int NOT NULL AUTO_INCREMENT COMMENT 'Mã bình luận', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int NOT NULL AUTO_INCREMENT COMMENT 'Mã customer', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_bills`
--
ALTER TABLE `detail_bills`
  MODIFY `id_detailbill` int NOT NULL AUTO_INCREMENT COMMENT '	Mã chi tiết đơn hàng', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Mã giảm giá', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT COMMENT 'Mã sản phẩm	', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT COMMENT '	Mã user', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `id_variant` int NOT NULL AUTO_INCREMENT COMMENT 'Mã biến thể', AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id_customer`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`discount_code_id`) REFERENCES `discount_codes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
