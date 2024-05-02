-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3300
-- Generation Time: Apr 30, 2024 at 06:21 PM
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
-- Database: `yody`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Nam'),
(2, 'Nữ'),
(4, 'Trẻ em');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `id_user` int NOT NULL DEFAULT '0',
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_pro` int NOT NULL,
  `star` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `content`, `created_at`, `id_pro`, `star`) VALUES
(1, 1, 'Áo đẹp, dày dặn và rất Ok. áo cho bé để khoác mùa thu hoặc trời se se lạnh rất phù hợp. các bạn chỉ cần chọn size và màu sắc là được lên đơn', '2024-03-22 10:00:37', 8, 5),
(2, 1, 'Chất liệu trượt nước, đúng với mô tả. Áo đẹp, mặc vừa vặn, sản phẩm chất lượng tốt', '2024-03-22 10:01:13', 8, 5),
(13, 0, 'ok nha bé', '2024-03-22 11:08:01', 15, 2),
(15, 0, 'Áo khoác cho bé từ 2-8 tuổi rất đẹp', '2024-03-22 11:34:54', 15, 0),
(16, 0, 'Áo khoác cho bé từ 2-8 tuổi rất đẹp', '2024-03-22 11:35:01', 15, 0),
(17, 0, 'Look good. Feel good.', '2024-03-22 11:36:45', 15, 0),
(18, 0, 'khá đẹp ạ', '2024-03-22 11:48:00', 13, 4),
(19, 0, 'ok nha', '2024-03-22 14:39:42', 11, 0),
(20, 0, '', '2024-03-22 14:39:50', 11, 5),
(21, 1, 'Đặc biệt là có phần ghi tên và thông tin của các bé gắn tại lót áo Sản xuất tại Việt Nam YODY ', '2024-03-22 15:53:36', 15, 4),
(22, 0, 'Sản xuất tại Việt Nam', '2024-03-22 15:55:11', 12, 0),
(23, 1, 'Áo khoác trẻ em 3C PLUS - phiên bản mới nhất BST Thu Đông 2022\' ', '2024-03-22 15:55:53', 12, 5),
(24, 1, ' dễ chăm sóc, dễ bảo quản Sản xuất tại Việt Nam YODY - Look good. Feel good.', '2024-03-24 13:48:10', 16, 5),
(25, 0, 'khá ok', '2024-03-29 15:52:37', 19, 0),
(26, 1, '', '2024-04-22 12:09:54', 14, 4),
(27, 1, '5 sao luôn shop ơi', '2024-04-22 13:59:52', 20, 5),
(30, 1, 'ok nha', '2024-04-25 00:25:06', 21, 5),
(31, 1, 'áo đẹp', '2024-04-25 00:26:28', 10, 5),
(32, 1, 'ok', '2024-04-25 00:48:10', 10, 5),
(33, 1, 'ok', '2024-04-28 01:32:45', 19, 4),
(34, 1, 'ok', '2024-04-28 01:33:22', 18, 0),
(35, 1, 'khá ok', '2024-04-28 20:58:55', 24, 5),
(36, 1, '', '2024-04-29 01:19:24', 22, 5);

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int NOT NULL,
  `id_user_admin` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `id_user_admin`, `id_user`) VALUES
(1, 4, 18),
(2, 4, 1),
(3, 4, 3),
(9, 4, 19),
(10, 4, 20);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `percent` int NOT NULL,
  `start_day` datetime NOT NULL,
  `expiration` datetime NOT NULL,
  `quantity` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `code`, `percent`, `start_day`, `expiration`, `quantity`, `status`) VALUES
(13, '66268ce2034f5', 20, '2024-04-22 00:00:00', '2024-05-03 00:00:00', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `id_comment` int NOT NULL,
  `id_user_admin` int NOT NULL,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `id_comment`, `id_user_admin`, `text`, `date`) VALUES
(1, 1, 4, 'ok bạn nha', '2024-04-24 23:40:52'),
(2, 2, 4, 'thank bạn', '2024-04-25 00:09:58'),
(3, 35, 4, 'ok nhé hi hi', '2024-04-29 01:08:15'),
(4, 35, 4, 'thank nha', '2024-04-29 01:09:41'),
(5, 36, 4, 'thank', '2024-04-29 01:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_phone` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int NOT NULL,
  `total_amount` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` text COLLATE utf8mb4_general_ci NOT NULL,
  `ship` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `payment` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '1 là đang đóng hàng, 2 là đang vận chuyển , 3 là đã giao, 4 là hủy\r\n',
  `percent_discount` int NOT NULL DEFAULT '0',
  `payment_status` tinyint NOT NULL DEFAULT '1' COMMENT '1 là chưa thanh toán, 0 là đã thanh toán\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customer_name`, `customer_phone`, `customer_address`, `id_user`, `total_amount`, `created_at`, `note`, `ship`, `payment`, `status`, `percent_discount`, `payment_status`) VALUES
(54, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '2500000', '2024-04-29 08:42:52', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 3, 0, 0),
(55, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '5083000', '2024-04-29 08:42:52', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 3, 0, 0),
(56, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '1220000', '2024-04-29 08:42:52', 'cc', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 3, 0, 0),
(57, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '1624000', '2024-04-25 17:23:43', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(58, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '614400', '2024-04-25 17:30:47', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(59, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '6280', '2024-04-25 17:39:03', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(60, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '11190', '2024-04-25 17:41:37', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 99, 1),
(64, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '2796000', '2024-04-27 15:55:03', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(65, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '4194000', '2024-04-27 15:56:07', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(66, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '2952000', '2024-04-27 16:30:12', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(67, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '1495000', '2024-04-27 16:31:41', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(68, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '5000000', '2024-04-27 16:34:13', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(69, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '33189000', '2024-04-27 16:39:55', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(70, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '2584000', '2024-04-27 16:41:46', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(71, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '327000', '2024-04-27 16:44:36', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(72, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '3839000', '2024-04-27 16:47:08', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(73, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '6500000', '2024-04-27 16:49:34', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(74, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '8450000', '2024-04-27 16:51:14', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(75, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '7085000', '2024-04-28 06:01:50', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 4, 0, 1),
(76, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '6990000', '2024-04-27 17:14:01', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(77, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '3690000', '2024-04-27 17:17:04', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(78, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '2990000', '2024-04-28 13:40:46', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 2, 0, 1),
(79, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '3500000', '2024-04-30 11:09:28', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 3, 0, 0),
(80, 'Trung Kiên', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '680000', '2024-04-29 09:37:01', '', 'Giao hàng nhanh', 'Thanh toán khi nhận (COD)', 1, 0, 1),
(81, 'Ảo thật đậy', '0366508004', '13 đường P. Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội, Việt Nam', 20, '423200', '2024-04-29 15:26:40', '', 'Giao hàng nhanh', 'Thanh toán COD', 4, 20, 1),
(82, 'Việt Nam', '0987654321', 'Đường An Định - Phường Yên Hòa - Thành Phố Hải Dương', 3, '680000', '2024-04-29 15:05:47', '', 'Giao hàng nhanh', 'Thanh toán COD', 1, 0, 1),
(83, 'Ảo thật đậy', '0366508004', '13 đường P. Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội, Việt Nam', 20, '1693000', '2024-04-29 15:27:48', '', 'Giao hàng nhanh', 'Thanh toán COD', 4, 0, 1),
(84, 'Ảo thật đậy', '0366508004', '13 đường P. Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội, Việt Nam', 20, '101796000', '2024-04-29 16:55:15', '', 'Giao hàng nhanh', 'Thanh toán COD', 3, 0, 0),
(85, 'Ảo ', '0357788559', 'hà nội', 0, '3250000', '2024-04-30 06:52:06', 'khá ok', 'Giao hàng nhanh', 'Thanh toán COD', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int NOT NULL,
  `invoice_id` int DEFAULT NULL,
  `id_product` int NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` int NOT NULL,
  `size` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `id_product`, `product_name`, `quantity`, `price`, `total`, `size`, `color`) VALUES
(54, 54, 21, 'Áo Thun Trẻ Em Phối In Nổi Tai Nghe', 5, '500000.00', 2500000, 'L', 'Xanh'),
(55, 55, 19, ' Áo Sơ Mi Nam Trắng Dài Tay Nano Kháng Khuẩn Chống Nhăn', 4, '299000.00', 1196000, 'L', 'Trắng'),
(56, 55, 19, ' Áo Sơ Mi Nam Trắng Dài Tay Nano Kháng Khuẩn Chống Nhăn', 13, '299000.00', 3887000, 'XL', 'Đen'),
(57, 56, 19, ' Áo Sơ Mi Nam Trắng Dài Tay Nano Kháng Khuẩn Chống Nhăn', 5, '299000.00', 1495000, 'L', 'Trắng'),
(58, 57, 21, 'Áo Thun Trẻ Em Phối In Nổi Tai Nghe', 4, '500000.00', 2000000, 'L', 'Đỏ'),
(59, 58, 18, 'Quần Short Nam Ống Đứng Trẻ Trung', 2, '369000.00', 738000, 'XL', 'Đen'),
(60, 59, 19, ' Áo Sơ Mi Nam Trắng Dài Tay Nano Kháng Khuẩn Chống Nhăn', 2, '299000.00', 598000, 'XL', 'Đen'),
(61, 60, 16, 'Áo Khoác Trẻ Em Nỉ Cào Lông Tai Thỏ', 11, '99000.00', 1089000, 'S', 'Trắng'),
(64, 64, 17, 'Quần Kaki Nam Regular Thêu Cạnh Túi', 4, '699000.00', 2796000, 'L', 'Đen'),
(65, 65, 17, 'Quần Kaki Nam Regular Thêu Cạnh Túi', 6, '699000.00', 4194000, 'L', 'Đen'),
(66, 66, 18, 'Quần Short Nam Ống Đứng Trẻ Trung', 8, '369000.00', 2952000, 'XL', 'Đen'),
(67, 67, 19, ' Áo Sơ Mi Nam Trắng Dài Tay Nano Kháng Khuẩn Chống Nhăn', 5, '299000.00', 1495000, 'XL', 'Đen'),
(68, 68, 21, 'Áo Thun Trẻ Em Phối In Nổi Tai Nghe', 10, '500000.00', 5000000, 'S', 'Hồng'),
(69, 69, 19, ' Áo Sơ Mi Nam Trắng Dài Tay Nano Kháng Khuẩn Chống Nhăn', 111, '299000.00', 33189000, 'L', 'Trắng'),
(70, 70, 15, 'Áo Khoác Trẻ Em Nhỏ 3C Pro', 10, '199000.00', 1990000, 'S', 'Đen'),
(71, 70, 16, 'Áo Khoác Trẻ Em Nỉ Cào Lông Tai Thỏ', 6, '99000.00', 594000, 'S', 'Trắng'),
(72, 71, 16, 'Áo Khoác Trẻ Em Nỉ Cào Lông Tai Thỏ', 3, '99000.00', 297000, 'S', 'Trắng'),
(73, 72, 14, 'Áo phao trẻ em 3s plus Siêu ấm - Siêu nhẹ - Siêu gọn', 11, '349000.00', 3839000, 'L', 'Hồng'),
(74, 73, 9, 'Polo Thể Thao Nữ Airycool Nẹp Khóa', 10, '650000.00', 6500000, 'S', 'Đen'),
(75, 74, 8, 'Áo Polo Thể Thao Nữ Airycool Điều Hoà Phối Màu', 13, '650000.00', 8450000, 'XL', 'Hồng'),
(76, 75, 10, ' Áo Polo Thể Thao Nam Airycool Điều Hoà Lé Sườn Phối Màu', 4, '399000.00', 1596000, 'L', 'Đen'),
(77, 75, 11, 'Áo Polo Thể Thao Nam Airycool Điều Hoà Phối Lé Nổi Bật', 11, '499000.00', 5489000, 'XL', 'Trắng'),
(78, 76, 17, 'Quần Kaki Nam Regular Thêu Cạnh Túi', 10, '699000.00', 6990000, 'L', 'Đen'),
(79, 77, 18, 'Quần Short Nam Ống Đứng Trẻ Trung', 10, '369000.00', 3690000, 'XL', 'Đen'),
(80, 78, 19, ' Áo Sơ Mi Nam Trắng Dài Tay Nano Kháng Khuẩn Chống Nhăn', 10, '299000.00', 2990000, 'L', 'Trắng'),
(81, 79, 21, 'Áo Thun Trẻ Em Phối In Nổi Tai Nghe', 3, '500000.00', 1500000, 'M', 'Đen'),
(82, 79, 21, 'Áo Thun Trẻ Em Phối In Nổi Tai Nghe', 4, '500000.00', 2000000, 'L', 'Xanh'),
(83, 80, 22, ' Áo Chống Nắng Nữ Chống UV Dáng Suông', 1, '650000.00', 650000, 'XL', 'Hồng'),
(84, 81, 21, 'Áo Thun Trẻ Em Phối In Nổi Tai Nghe', 1, '499000.00', 499000, 'L', 'Xanh'),
(85, 82, 22, ' Áo Chống Nắng Nữ Chống UV Dáng Suông', 1, '650000.00', 650000, 'S', 'Đen'),
(86, 83, 15, 'Áo Khoác Trẻ Em Nhỏ 3C Pro', 6, '199000.00', 1194000, 'S', 'Đen'),
(87, 83, 21, 'Áo Thun Trẻ Em Phối In Nổi Tai Nghe', 1, '499000.00', 499000, 'M', 'Đen'),
(88, 84, 21, 'Áo Thun Trẻ Em Phối In Nổi Tai Nghe', 4, '499000.00', 1996000, 'L', 'Xanh'),
(89, 84, 21, 'Áo Thun Trẻ Em Phối In Nổi Tai Nghe', 200, '499000.00', 99800000, 'M', 'Đen'),
(90, 85, 22, ' Áo Chống Nắng Nữ Chống UV Dáng Suông', 5, '650000.00', 3250000, 'XL', 'Hồng');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `conversation_id` int NOT NULL,
  `sender_id` int NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1 là chư xem, 0 là đã xem'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `content`, `date`, `status`) VALUES
(1, 1, 18, 'bạn ổn không', '2024-04-22 15:35:16', 0),
(2, 1, 4, 'tôi ổn', '2024-04-22 15:41:18', 0),
(3, 2, 1, 'muốn gửi phản hồi', '2024-04-22 15:42:21', 0),
(4, 3, 3, 'giúp tôi xem đơi này với', '2024-04-22 16:40:32', 0),
(5, 3, 4, 'đợi tý', '2024-04-22 16:42:00', 0),
(6, 3, 3, 'lâu quá', '2024-04-22 16:47:05', 0),
(7, 3, 3, '????', '2024-04-22 16:47:43', 0),
(8, 3, 4, 'đợi tý mà', '2024-04-22 17:55:21', 0),
(9, 2, 4, 'ok bạn', '2024-04-22 18:29:25', 0),
(10, 2, 1, 'ok', '2024-04-22 18:37:18', 0),
(11, 2, 1, 'khá quá', '2024-04-22 18:46:35', 0),
(12, 2, 4, 'test', '2024-04-22 18:47:18', 0),
(13, 2, 4, 'bạn muốn mình tư vấn gì ah', '2024-04-22 18:49:38', 0),
(14, 2, 4, 'alo', '2024-04-22 18:51:26', 0),
(15, 2, 4, 'alo', '2024-04-22 19:14:15', 0),
(16, 2, 4, 'alo1', '2024-04-22 19:14:21', 0),
(18, 2, 1, 'Hế lô', '2024-04-22 21:17:03', 0),
(19, 2, 1, 'alo', '2024-04-22 21:18:57', 0),
(20, 2, 1, 'ok nha bé', '2024-04-22 21:57:20', 0),
(21, 2, 1, 'lâu quá', '2024-04-22 21:58:26', 0),
(22, 2, 1, 'ok', '2024-04-22 22:00:59', 0),
(23, 2, 1, 'ok kien đay', '2024-04-22 22:07:19', 0),
(24, 2, 1, 'ok', '2024-04-22 22:10:08', 0),
(25, 2, 4, 'nhé', '2024-04-22 22:11:21', 0),
(26, 2, 4, 'khá ok', '2024-04-22 22:15:36', 0),
(27, 2, 4, 'khá ok', '2024-04-22 22:16:09', 0),
(28, 2, 4, 'khá ok', '2024-04-22 22:16:29', 0),
(29, 2, 4, 'khá ok', '2024-04-22 22:18:30', 0),
(30, 2, 4, 'khá ok', '2024-04-22 22:18:40', 0),
(31, 2, 4, 'nhất m', '2024-04-22 22:19:45', 0),
(32, 2, 1, 'ok', '2024-04-22 22:26:19', 0),
(33, 2, 4, 'nhé', '2024-04-22 22:27:13', 0),
(34, 2, 4, 'ẻgregfgvbdfbfb', '2024-04-22 22:30:21', 0),
(35, 2, 4, 'ke', '2024-04-22 22:34:45', 0),
(36, 2, 4, 'giúp tôi xem đơi này với', '2024-04-22 22:39:40', 0),
(37, 3, 4, 'lâu quá', '2024-04-22 22:40:04', 1),
(39, 9, 19, 'xin chào', '2024-04-22 22:55:56', 0),
(40, 9, 4, 'giúp tôi xem đơi này với', '2024-04-22 22:56:58', 0),
(41, 3, 4, 'vdfvdfv', '2024-04-22 23:00:12', 1),
(42, 1, 4, 'fvdfvfdv', '2024-04-22 23:00:19', 1),
(43, 1, 4, 'fvfdvf', '2024-04-22 23:00:28', 1),
(44, 1, 4, 'dfvfv', '2024-04-22 23:00:31', 1),
(45, 9, 19, 'ị', '2024-04-22 23:09:21', 0),
(46, 2, 1, 'đâu', '2024-04-23 12:40:45', 0),
(47, 2, 4, 'đâu j', '2024-04-23 12:44:58', 0),
(48, 2, 1, 'giúp tôi xem đơi này với', '2024-04-23 21:03:24', 0),
(49, 2, 4, 'ok khứa', '2024-04-26 00:01:28', 0),
(50, 10, 20, 'giúp tôi xem đơi này với', '2024-04-29 17:57:17', 0),
(51, 10, 4, 'ok bạn', '2024-04-29 17:57:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int NOT NULL,
  `tilte` text COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `tilte`, `image`, `text`, `author`, `date`) VALUES
(15, ' Ngả mũ trước ứng viên dẫn dắt tuyển Việt Nam Kim Sang Sik\r\n ', 'kim-sang-sik-nga-mu-truoc-ung-vien-dan-dat-tuyen-viet-nam-543.jpg', '<h2><strong>Kim Sang Sik, ứng viên dẫn tuyển Việt Nam, là một huyền thoại từng vô địch bóng đá Hàn Quốc với vai trò cầu thủ lẫn HLV.</strong></h2><p><strong>Chiến binh trên sân cỏ</strong></p><p>Sinh năm 1976, sự nghiệp cầu thủ <a href=\"https://vietnamnet.vn/the-thao/bong-da-viet-nam\"><strong>bóng đá</strong></a> chuyên nghiệp của Kim Sang Sik bắt đầu tương đối muộn: ra mắt Seongnam Ilhwa Chunma khi đã bước qua tuổi 22.</p><p>Kể từ khi ra mắt, Kim Sang Sik hầu như luôn chiếm vị trí xuất phát trong đội hình Seongnam. Ông là nhân tố chính giúp đội bóng giành chức vô địch K-League năm 2001, kết thúc 6 năm trắng tay.</p><p>&nbsp;</p><p>Kim xuất thân ở vị trí trung vệ, nhưng sự nghiệp của ông được biết đến nhiều hơn trong vai trò tiền vệ phòng ngự. Ông chỉ đá ở hàng thủ tùy theo hoàn cảnh nhất định.</p><p>Với lối đá mạnh mẽ, không ngại va chạm, Kim gắn với biệt danh \"Viper\" (rắn lục). Ông cũng có biệt danh khác là \"Sikma\", vì tính cách khá tinh nghịch.</p><p>Theo thời gian, Kim trưởng thành hơn về chiến thuật. Ông mang hình ảnh của một tiền vệ xuất sắc với phong cách cắt các đường chuyền của đối thủ rồi chuyển trạng thái nhờ trí thông minh.</p><p>Kim Sang Sik, với chiều cao 1,86 m, còn nổi bật về khả năng kiểm soát bóng trên không. Điều đó giúp đội nhà hiệu quả trong khâu phòng ngự từ xa.</p><p>Kim Hyeung Bum, cựu tuyển thủ Hàn Quốc có quan hệt tốt với Sang Sik, mô tả: <i>\"Tuy thể hiện sức mạnh như một người bình thường, nhưng anh ấy rất giỏi dự đoán tình huống, chặn đường bóng và ngay lập tức chuyển sang tấn công\"</i>.</p><p>Năm 2003, Kim gia nhập Gwangju Sangmu như quá trình nhập ngũ. Ông trở lại Seongnam sau 2 năm vào giúp đội vô địch Hàn Quốc mùa 2006.</p><figure class=\"image\"><picture><source srcset=\"https://static-images.vnncdn.net/files/publish/2024/4/29/kim-sang-sik-2013-546.jpg?width=0&amp;s=E2sZBc4zzMTYEphw7IC5IQ\" media=\"(max-width: 1023px)\"><img src=\"data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==\" alt=\"kim sang sik 2013.jpg\" srcset=\"https://static-images.vnncdn.net/files/publish/2024/4/29/kim-sang-sik-2013-546.jpg?width=0&amp;s=E2sZBc4zzMTYEphw7IC5IQ\" sizes=\"100vw\" width=\"1\" height=\"1\"></picture><figcaption><i>Kim Sang Sik viết lịch sử ở K-League</i></figcaption></figure><p>Khi nhiều người nghĩ Kim Sang Sik gắn bó với Seongnam đến cuối sự nghiệp, thì bước ngoặt xảy ra năm 2009. CLB thực hiện cuộc cách mạng mạnh mẽ, đưa Shin Tae Yong chưa có kinh nghiệm lên làm HLV.</p><p>Biến động này đẩy Kim sang Jeonbuk Hyundai Motors, dù Shin Tae Yong - HLV trưởng Indonesia hiện nay - không hề muốn.</p><p>Cho đến lúc đó, Jeonbuk Hyundai Motors không sánh được với Seongnam. Tuy vậy, ngay mùa đầu tiên, Kim giúp đội bóng vô địch Hàn Quốc lần đầu tiên trong lịch sử, sau 15 năm thành lập.</p><p>Sau 3 danh hiệu với Seongnam, thêm 2 chiến thắng khác cùng Jeonbuk, ông được công nhận như tiền vệ phòng ngự hay nhất lịch sử K-League.</p><p><strong>Vô duyên với World Cup 2002</strong></p><p>Chỉ sau một năm thi đấu chuyên nghiệp, Kim Sang Sik được gọi vào đội tuyển Hàn Quốc dự Asian Cup 2000. Ông là người ghi bàn ở phút 90, khởi đầu màn ngược dòng thắng Iran 2-1 trong trận tứ kết.</p><p>Trong khoảng thời gian này Kim Sang Sik làm việc trực tiếp với <a href=\"https://vietnamnet.vn/hlv-park-hang-seo-tag13301736263283001811.html\"><strong>Park Hang Seo</strong></a>, trợ lý của HLV trưởng Huh Jung Moo.</p><p>Cùng với nhau, họ đưa Hàn Quốc giành hạng 3 châu Á 2000 sau nhiều năm khó khăn (không dự VCK 1992, thua ở tứ kết 1996).</p><figure class=\"image\"><picture><source srcset=\"https://static-images.vnncdn.net/files/publish/2024/4/29/kim-sang-sik-han-quoc-547.jpg?width=0&amp;s=GShM3_q9Nfvyuoq-2fKw2g\" media=\"(max-width: 1023px)\"><img src=\"data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==\" alt=\"kim sang sik han quoc.jpg\" srcset=\"https://static-images.vnncdn.net/files/publish/2024/4/29/kim-sang-sik-han-quoc-547.jpg?width=0&amp;s=GShM3_q9Nfvyuoq-2fKw2g\" sizes=\"100vw\" width=\"1\" height=\"1\"></picture><figcaption><i>Kim Sang Sik ở Asian Cup 2000</i></figcaption></figure><p>Từ năm 2001, Guus Hiddink được chọn ngồi chiếc ghế HLV trưởng Hàn Quốc và Park Hang Seo được giữ lại trong đội ngũ trợ lý.</p><p>Thời điểm ấy, Kim gặp chấn thương và bỏ lỡ một số trận đấu. Mặc dù hồi phục và dự một số trận đấu tập, ông vẫn bị Hiddink gạt khỏi danh sách dự World Cup 2002.</p><p>Vắng mặt trong đội hình dự World Cup mà Hàn Quốc và Nhật Bản cùng đăng cai là nỗi thất vọng lớn với Kim. Hiddink giải thích rằng ông thấy Sang Sik thiếu động lực.</p><p>Sau triều đại Hiddink, Kim trở thành một trong những nhân tố chính của Hàn Quốc, dự World Cup 2006 cũng như giành hạng 3 Asian Cup 2007 - giải đấu mà <a href=\"https://vietnamnet.vn/tuyen-viet-nam-tag8013680640245068705.html\"><strong>tuyển Việt Nam</strong></a> là chủ nhà duy nhất trong 4 quốc gia đăng cai vượt qua vòng bảng (cùng Thái Lan, Malaysia và Indonesia).</p><p><strong>Dấu ấn huấn luyện</strong></p><p>Sự nghiệp cầu thủ của Kim Sang Sik khép lại năm 2013. Ở thời điểm đó, ông bị truyền thông và người hâm mộ gọi là \"ông vua thẻ\" vì nhiều pha phạm lỗi không đáng có.</p><p>Kim sang Pháp học bằng HLV trong thời gian ngắn. Ông trở lại Jeonbuk để đóng vai trò trợ lý. Trên cương vị mới (chỉ dẫn vài trận khi HLV trưởng bị cấm chỉ đạo), ông có 6 lần khác vô địch K-League.</p><p>Đóng góp của Kim trong mùa 2020 thực sự quan trọng. Ông hỗ trợ về nhiều mặt cho HLV Jose Morais, nhất là khía cạnh tâm lý, giúp Jeonbuk vô địch K-League 4 mùa liên tiếp,</p><p>Chính từ ảnh hưởng đó, khi hợp đồng với Morais hết hạn tháng 12/2020, Kim Sang Sik được chọn làm thuyền trưởng Jeonbuk.</p><p>Trong mùa giải 2021, Kim giúp Jeonbuk vô địch K-League. Ông mang đến sự cân bằng trong lối chơi phòng ngự, đồng thời khi cần sẽ tấn công áp đảo với 71 bàn thắng sau 38 vòng đấu.</p><p>Thành tích này giúp Kim nhận các giải thưởng HLV xuất sắc nhất mùa 2021, của K-League cũng như LĐBĐ Hàn Quốc.</p><figure class=\"image\"><picture><source srcset=\"https://static-images.vnncdn.net/files/publish/2024/4/29/kim-sang-sik-jeonbuk-548.jpg?width=0&amp;s=N2FT9v_9K_ylsVc7-9IbBA\" media=\"(max-width: 1023px)\"><img src=\"data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==\" alt=\"kim sang sik jeonbuk.jpg\" srcset=\"https://static-images.vnncdn.net/files/publish/2024/4/29/kim-sang-sik-jeonbuk-548.jpg?width=0&amp;s=N2FT9v_9K_ylsVc7-9IbBA\" sizes=\"100vw\" width=\"1\" height=\"1\"></picture><figcaption><i>Kim Sang Sik tạo nhiều cột mốc ngay mùa đầu tiên làm HLV ở K-League</i></figcaption></figure><p>Bên cạnh đó, Kim Sang Sik trở thành người đầu tiên trong lịch sử Jeonbuk vô địch K-League với tư cách cầu thủ, trợ lý và HLV. Toàn bộ giải đấu Hàn Quốc cũng chỉ có 3 người nâng cúp với tư cách cầu thủ và HLV.</p><p>Kim là HLV thứ 6 trong lịch sử, và là người Hàn Quốc đầu tiên kể từ 1987 vô địch K-League ngay trong mùa giải đầu tiên huấn luyện.</p><p>Jeonbuk lỡ danh hiệu K-League năm 2022, nhưng giành FA Cup. Năm 2023, ông chủ động từ chức khi CLB khủng hoảng vì nhiều lý do.</p><p>Kim Sang Sik yêu thích lối đá 4-2-3-1. Khi tấn công, Jeonbuk của ông linh hoạt giữa 4-3-3 và 4-1-4-1 thiên về kiểm soát bóng và khống chế trung lộ.</p><p>Dù vậy, ông cũng có thể xây dựng lối chơi 3-4-3 hay 3-5-2 khi cần phòng ngự với 3 trung vệ, theo phong cách mà Park Hang Seo rất thành công cùng bóng đá Việt Nam.</p><p>Từ K-League đến bóng đá Việt Nam là sự khác biệt lớn. Nhưng sự nghiệp của Kim Sang Sik thực sự đáng ngưỡng mộ.</p>', 'admin1', '2024-04-29 18:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `import_price` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image2` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_ct` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '1 là có biến thể , 0 là chưa có'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `import_price`, `image`, `image2`, `description`, `id_ct`, `status`) VALUES
(8, 'Áo Polo Thể Thao Nữ Airycool Điều Hoà Phối Màu', 650000, '300000', 'public/img/ao-polo-the-thao-nu-yody-san7030-tim-cvn5148-tra-4.webp', 'public/img/ao-polo-the-thao-nu-yody-san7030-tim-cvn5148-tra-6.webp', 'Áo polo nữ thể thao vải AIRYCOOL\r\n\r\nThành phần: 88%Nylon, 12%Spandex\r\n\r\nVẢI CHẠM MÁT, HẠ NHIỆT - Công nghệ làm mát Freezing giúp tiêu tán bức xạ nhiệt nhanh chóng. Bề vải chạm mát NGAY TỨC THÌ.\r\n\r\nKHÔNG BAI DÃO, SỢI CO GIÃN TÔN DÁNG - Cấu trúc dệt pique chắc chắn, không bai dão cùng sợi siêu mảnh nên cực MỀM MỊN, NHẸ & BỀN \r\n\r\nHÚT MỒ HÔI TỨC KHẮC - Vải được xử lý bằng công nghệ “HÚT NƯỚC TỰ ĐỘNG”,  giúp thấm hút  nhanh hơn cotton 100% và khô siêu nhanh, không gây bí và nặng khi đổ mồ hôi.\r\n\r\nThiết kế hiện đại, chi tiết phối màu 2 bên sườn tạo sự trẻ trung, khỏe khoắn\r\n\r\nSản xuất tại Việt Nam\r\n\r\nYODY - Look good. Feel good.', 2, 1),
(9, 'Polo Thể Thao Nữ Airycool Nẹp Khóa', 650000, '300000', 'public/img/ao-polo-the-thao-nu-san7038-tra-6.webp', 'public/img/ao-polo-the-thao-nu-san7038-tra-3.webp', 'Thành phần: 85% Nylon, 15% Spandex\r\n\r\nChất liệu Airycool siêu mát, thấm hút tốt\r\n\r\nCông nghệ làm mát FREEZING \"làm mát tức thì\": tăng cường độ ẩm trên bề mặt vải làm giảm bức xạ nhiệt từ môi trường xung quanh\r\n\r\nMềm mịn, thông thoáng, co giãn, hạn chế nhăn nhàu\r\n\r\nÁo polo thể thao YODY SPORT năng động, khoẻ khoắn. Thiết kế nẹp khoá tạo điểm nhấn\r\n\r\nSản xuất tại Việt Nam\r\n\r\nYODY - Look good. Feel good.', 2, 1),
(10, ' Áo Polo Thể Thao Nam Airycool Điều Hoà Lé Sườn Phối Màu', 399000, '200000', 'public/img/sam7043-den-qsm5057-xnh-10.webp', 'public/img/sam7043-den-qsm5057-xnh-2.webp', 'Chất liệu Airycool Điều Hòa\r\n\r\nThành phần: 88%Nylon, 12%Spandex\r\n\r\nVẢI CHẠM MÁT, HẠ NHIỆT - Công nghệ làm mát Freezing giúp tiêu tán bức xạ nhiệt nhanh chóng. Bề vải chạm mát NGAY TỨC THÌ.\r\n\r\nKHÔNG BAI DÃO, SỢI CO GIÃN TÔN DÁNG - Cấu trúc dệt pique chắc chắn, không bai dão cùng sợi siêu mảnh nên cực MỀM MỊN, NHẸ & BỀN \r\n\r\nHÚT MỒ HÔI TỨC KHẮC - Vải được xử lý bằng công nghệ “HÚT NƯỚC TỰ ĐỘNG”,  giúp thấm hút  nhanh hơn cotton 100% và khô siêu nhanh, không gây bí và nặng khi đổ mồ hôi.\r\n\r\nThiết kế hiện đại, chi tiết phối màu 2 bên sườn tạo sự trẻ trung, khỏe khoắn\r\n\r\nSản xuất tại Việt Nam\r\n\r\nYODY - Look good. Feel good.', 1, 1),
(11, 'Áo Polo Thể Thao Nam Airycool Điều Hoà Phối Lé Nổi Bật', 499000, '250000', 'public/img/ao-polo-the-thao-nam-sam7017-xth-1.webp', 'public/img/ao-polo-the-thao-nam-sam7017-xth-6.webp', 'Thành phần: 88% Nylon, 12% Spandex\r\n\r\nSản phẩm mới nhất mùa hè năm nay\r\n\r\nChất liệu Airycool điều hoà chạm mát tức thì trên da\r\n\r\nVải được xử lý bằng công nghệ \"Hút nước tự động\" giúp thấm hút nhanh hơn cotton 100% và khô siêu nhanh, không gây bí và nặng khi đổ mồ hôi\r\n\r\nKhông bai dão, sợi co giãn tôn dáng\r\n\r\nÁo polo cặp đôi form slimfit phù hợp với nhiều đối tượng, mang đến sự trẻ trung khi mặc\r\n\r\nChi tiết thiết kế phối lé viền mảnh trên vai tạo sự khoẻ khoắn\r\n\r\nThích hợp cho các hoạt động ngoài trời, vận động nhiều\r\n\r\nSản xuất tại Việt Nam\r\n\r\nYODY - Look good. Feel good.', 1, 1),
(12, 'Áo Khoác Gió Cho Bé 3C Plus (2 - 9 Tuổi)', 199000, '80000', 'public/img/akk5019-hog-14.webp', 'public/img/akk5019-hog-13.webp', 'Áo khoác trẻ em 3C PLUS - phiên bản mới nhất BST Thu Đông 2022\'\r\n\r\nThành phần:  100% Polyester\r\n\r\nLàm từ vải gió với cấu tạo 2 lớp cơ bản\r\n\r\nCó khả năng: Cản gió - Cản bụi - Chống ngấm nước vượt trội\r\n\r\nPhom áo thoải mái để bé vận động, mặc được trong nhiều hoàn cảnh\r\n\r\nPhần mũ có thể tháo rời linh hoạt, chun tay ôm vừa, gấu áo có chun rút tuỳ chỉnh\r\n\r\nNgực áo in logo YODY phản quang nổi bật và tinh tế\r\n\r\nYODY - Look good. Feel good.\r\n\r\nSản xuất tại Việt Nam', 4, 0),
(13, 'Áo Phao Trẻ Em 3S Siêu Nhẹ Tay Raglan', 299000, '130000', 'public/img/phk6002-cdt-4.webp', 'public/img/phk6002-cdt-7.webp', 'Sản phẩm được các ba mẹ lựa chọn nhờ sở hữu những đặc tính nổi trội:\r\n\r\nSIÊU NHẸ (LIGHTWEIGHT):Trong lượng áo siêu nhẹ, cho bé thoải mái vận động\r\n\r\nSIÊU ẤM (WARM): Các lớp vải và bông đều được chọn lọc và thiết ké để giữ ấm hiệu quả trong thời tiết giá lạnh\r\n\r\nSIÊU GỌN (PACKABLE): Áo có khả năng gấp gọn trong túi đi kèm, vô cùng tiện lợi\r\n\r\nTRƯỢT NƯỚC (WATER REPELLENT): Trong điều kiện mưa nhẹ, sương sớm, ba mẹ hoàn toàn có thể yên tâm vì áo có khả năng trượt nước!', 4, 0),
(14, 'Áo phao trẻ em 3s plus Siêu ấm - Siêu nhẹ - Siêu gọn', 349000, '170000', 'public/img/phk5009-bha-5.webp', 'public/img/phk5009-bha-1.webp', 'Áo phao 3S Plus - phiên bản cải tiến dành cho trẻ em\r\n\r\nThành phần:  100% NYLON\r\n\r\nSở hữu những đặc tính nổi trội đặc trưng:\r\n\r\nSIÊU NHẸ - LIGHTWEIGHT: Trong lượng siêu nhẹ thoải mái khi dùng\r\n\r\nSIÊU ẤM – WARM: giữ ấm hiệu quả trong thời tiết giá lạnh\r\n\r\nSIÊU GỌN – PACKABLE: có khả năng gấp gọn trong túi đi kèm\r\n\r\nTRƯỢT NƯỚC – WATER REPELLENT: trượt nước giúp bảo vệ cơ thể bé khi trời mua nhẹ hoặc sương sớm\r\n\r\nYODY - Look good. Feel good.', 4, 1),
(15, 'Áo Khoác Trẻ Em Nhỏ 3C Pro', 199000, '80000', 'public/img/ao-khoac-tre-em-akk6030-hog-3.webp', 'public/img/ao-khoac-tre-em-akk6030-hog-4.webp', 'Áo khoác cho bé từ 2-8 tuổi, chất liệu 100% Polyester\r\n\r\nThiết kế 2 lớp cơ bản phù hợp sử dụng trong mọi hoàn cảnh\r\n\r\nBấm cổ tay nhằm ôm kín hơn khi di chuyển, không để gió luồn vào cơ thể\r\n\r\nMũ áo có thể tháo rời, chun áo ở gấu điều chỉnh cho phù hợp\r\n\r\nTúi áo có khóa kéo chắc chắc đựng đồ\r\n\r\nĐặc biệt là có phần ghi tên và thông tin của các bé gắn tại lót áo\r\n\r\nSản xuất tại Việt Nam\r\n\r\nYODY - Look good. Feel good.', 4, 1),
(16, 'Áo Khoác Trẻ Em Nỉ Cào Lông Tai Thỏ', 99000, '40000', 'public/img/ao-khoac-tre-em-yody-akk6028-nav-8.webp', 'public/img/ao-khoac-tre-em-yody-akk6028-nav-7.webp', 'Áo khoác cho bé chất liệu nỉ cào lông Fluffy Fleece\r\n\r\nVải chính/ Lót túi: 100% Polyester\r\n\r\nBề mặt vải mềm mại\r\n\r\nGiữ ấm tốt nhờ kiểu dệt cào lông mềm mại, cách nhiệt, giữ ấm hiệu quả\r\n\r\nSử dụng sợi Polyester tăng độ bền và khả năng giữ ấm\r\n\r\nBền, dễ chăm sóc, dễ bảo quản\r\n\r\nSản xuất tại Việt Nam\r\n\r\nYODY - Look good. Feel good.', 4, 1),
(17, 'Quần Kaki Nam Regular Thêu Cạnh Túi', 699000, '370000', 'public/img/qkm6005-den-06.webp', 'public/img/qkm6005-den-08.webp', 'Thành phần: 97% Cotton + 3% Spandex\r\n\r\nQuần kaki nam dáng regular thoải mái, dễ mặc\r\n\r\nChất liệu kaki dày dặn, bền chắc\r\n\r\nThiết kế basic, phù hợp với nhiều dáng người châu Á\r\n\r\nThích hợp mặc đi làm, đi chơi, đi học\r\n\r\nPhối đồ đa dạng cùng sơ mi, áo thun, áo polo, áo khoác…\r\n\r\nYODY - Look good. Feel good.\r\n\r\nSản xuất tại Việt Nam', 1, 1),
(18, 'Quần Short Nam Ống Đứng Trẻ Trung', 369000, '200000', 'public/img/qsm5057-bee-3.webp', 'public/img/qsm5057-bee-2.webp', 'Quần short nam kaki ngang gối\r\n\r\nSản phẩm basic thiết yếu dành cho mọi chàng trai\r\n\r\nChất vải kaki mềm nhẹ, thoải mái, thích hợp với điều kiện thời tiết nhiệt đới \r\n\r\nCạp quần thiết kế bản to có đỉa mang lại sự chỉn chu có thể mặc ra ngoài cafe, hẹn hò\r\n\r\nTúi hậu có cúc tiện lợi\r\n\r\nYODY - Look good. Feel good.\r\n\r\nSản xuất tại Việt Nam', 1, 1),
(19, ' Áo Sơ Mi Nam Trắng Dài Tay Nano Kháng Khuẩn Chống Nhăn', 299000, '150000', 'public/img/smm4073-xdm-4.webp', 'public/img/smm4073-xdm-5.webp', 'Chất liệu vài Nano\r\n\r\nThành phần: 100% Polyester\r\n\r\nKhả năng khử mùi, kháng khuẩn và thấm hút mồ hôi tốt.\r\n\r\nVải không nhăn với form áo đứng và giữ nếp giúp người mặc luôn diện những mẫu áo phẳng phiu.\r\n\r\nThiết kế mới, lá cổ mở rộng hơn về phía cầu vai, có ly gấp sau lưng\r\n\r\nYODY - Look good. Feel good\r\n\r\nSản xuất tại Việt Nam', 1, 1),
(21, 'Áo Thun Trẻ Em Phối In Nổi Tai Nghe', 499000, '300000', 'public/img/tsk7134-twd-4.webp', 'public/img/tsk7134-tvx-4.webp', '<p><strong>Miễn phí vận chuyển:</strong>Đơn hàng từ 498k</p><p>&nbsp;</p><p><strong>Giao hàng:</strong>Từ 3 - 5 ngày trên cả nước</p><p>&nbsp;</p><p><strong>Miễn phí đổi trả:</strong>Tại 267+ cửa hàng trong 15 ngày</p><p>&nbsp;</p><p>Sử dụng mã giảm giá ở bước thanh toán</p><p>&nbsp;</p><p>Thông tin bảo mật và mã hoá</p><p>Chất liệu Cotton Compact</p><p>Thành phần 100% Cotton</p><p>Khả năng thấm hút mồ hôi tốt, giúp bé luôn cảm thấy thoải mái và mát mẻ khi mặc.</p><p>Cotton Compact cũng có độ bền cao, ít bị xù lông và giữ form tốt sau nhiều lần giặt.</p><p>Kiểu dáng basic đơn giản nhưng được phối với họa tiết in nổi tai nghe độc đáo, mang đến phong cách cá tính cho bé.</p><p>Bé có thể mặc áo thun này đi chơi, đi học hoặc tham gia các hoạt động thể thao.</p><p>Sản xuất tại Việt Nam</p><p>YODY - Look good. Feel good.</p><p><strong>Nhà thiết kế</strong></p><p>Nguyễn Thị Hằng</p>', 4, 1),
(22, ' Áo Chống Nắng Nữ Chống UV Dáng Suông', 650000, '400000', 'public/img/acn7004-gnh-4.webp', 'public/img/acn7004-gnh-9.webp', '<p>Chất liệu&nbsp;Double Face UV</p><p>Thành phần&nbsp;89% Polyester, 11% Spandex.</p><p>Thoải mái, thoáng mát&nbsp;chất liệu mềm mại, thấm hút tốt.</p><p>Cảm giác mát mẻ sẽ giúp cơ thể&nbsp;giảm 2-3 độ khi mặc.</p><p>Chỉ số&nbsp;<strong>UPF 50+</strong>&nbsp;làm&nbsp;Tia UV sẽ tốn&nbsp;thời gian gấp&nbsp;<strong>50 lần</strong>&nbsp;để&nbsp;gây bỏng da so với da không có gì bảo vệ.</p><p>Bảo vệ da bạn khỏi cháy nắng, chống lại cả tia UVA và UVB, thích&nbsp;hợp với thời tiết tại Việt Nam.</p><p>Khóa kéo từ hãng khóa tốt nhất thế giới - <strong>YKK</strong></p><p>Co giãn đàn hồi tốt, phù hợp với chuyển động cơ thể.</p><p>Vành mũ có thể tháo rời</p><p>Sản xuất tại Việt Nam.</p><p>YODY - Look good. Feel good.</p>', 2, 1),
(23, 'Áo T-shirt Yoguu Retro Meet Again', 499000, '300000', 'public/img/ao-thun-yoguu-retro-yody-gut7058-ghi-cvn6150-ghd-11.webp', 'public/img/ao-thun-yoguu-retro-yody-gut7058-ghi-cvn6150-ghd-2.webp', '<p><strong>Miễn phí vận chuyển:</strong>Đơn hàng từ 498k</p><p><strong>Giao hàng:</strong>Từ 3 - 5 ngày trên cả nước</p><p><strong>Miễn phí đổi trả:</strong>Tại 267+ cửa hàng trong 15 ngày</p><p>Sử dụng mã giảm giá ở bước thanh toán</p><p>Thông tin bảo mật và mã hoá</p><ul><li>Thành phần Vải chính: 100% Cotton</li><li>Vải rib: 95% Cotton + 5% Spandex</li><li>Sản phẩm sử dụng chất liệu cotton dệt từ sợi bông hữu cơ thân thiện với làn da</li><li>Áo cgo cảm giác mặc thông thoáng và thấm hút mồ hôi tốt</li><li>Mềm mại nhưng vẫn dày dặn, đứng form</li><li>Kiểu dệt kim đơn vừa đơn giản vừa thời trang</li><li>Thiết kế trẻ trung, hiện đại dành cho cả nam và nữ</li><li>Sản xuất tại Việt Nam</li><li>YODY - Look good. Feel good.</li></ul><p><strong>Nhà thiết kế</strong></p><p>Phùng Thị Nguyệt Tây</p>', 2, 1),
(24, ' T-shirt Nữ Croptop In Chữ Nổi', 249000, '120000', 'public/img/ao-thun-nu-tsn6038-tr1-6.webp', 'public/img/ao-thun-nu-tsn6038-tr1-7.webp', '<p><strong>Miễn phí vận chuyển:</strong>Đơn hàng từ 498k</p><p><strong>Giao hàng:</strong>Từ 3 - 5 ngày trên cả nước</p><p><strong>Miễn phí đổi trả:</strong>Tại 267+ cửa hàng trong 15 ngày</p><p>Sử dụng mã giảm giá ở bước thanh toán</p><p>Thông tin bảo mật và mã hoá</p><ul><li>Áo thun nữ dáng croptop cá tính in chữ nổi bật trước ngực. Thiết kế phần nách được cắt cách điệu và thoải mái khi mặc. Chất liệu thun rib co giãn tốt, giữ form sau khi giặt và sử dụng.</li></ul><p><strong>Nhà thiết kế</strong></p><p>Phùng Thị Nguyệt Tây</p><p><strong>Chất liệu</strong></p><p>Rib R004</p><p><strong>Bảo quản</strong></p><p>Tránh kéo giãn sản phẩm khi phơi</p>', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `logo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sayings` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `banner` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `link_fb` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `link_yt` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `link_tiktok` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `banner1` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `banner2` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `banner3` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `link_bn_1` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `link_bn_2` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `link_bn_3` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`logo`, `sayings`, `banner`, `link_fb`, `link_yt`, `link_tiktok`, `company_name`, `phone`, `address`, `banner1`, `banner2`, `banner3`, `link_bn_1`, `link_bn_2`, `link_bn_3`) VALUES
('https://images.glints.com/unsafe/glints-dashboard.s3.amazonaws.com/company-logo/6a827a544887e05743ef701f716adcb6.png', 'Đặt sự hài lòng của khách hàng là ưu tiên số 1 trong mọi suy nghĩ hành động của mình” là sứ mệnh, là triết lý, chiến lược.. luôn cùng TrungKien tiến bước ok', 'https://bizweb.dktcdn.net/100/438/408/themes/946371/assets/slider_1.jpg?1714364005915', 'https://www.facebook.com/trungkien48/', 'https://youtu.be/sbfks7HdRoE?si=bZaBJNaRCqgK68Zk', '#', 'Công ty thời trang và giải trí Trung Kiên', '0366508004', '13 đường P. Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội, Việt Nam', 'https://greenwich.edu.vn/wp-content/uploads/2023/06/YODY-web-1-768x327.png', 'https://storage.googleapis.com/geniusvn/posts/1bdHo1oPFaH8AtVCZnWW1avsy9alP7gz1P7tgAEs.jpg', 'https://lh7-us.googleusercontent.com/ZU7Qi_hKgmrgzFeQpU8Jd6NPTPqbVdYYVCQlctOBGkiMowvg6wg-fLMlxxXpkjbReW4ZKWWszvwUcG1EKTXIC7zcmn-UeOCQRgdQWUkMUJE-qI4gqr0zZxObD9MUNRS27Lrh2ckCPJ2RmPq5422jaj8', '14', '13', '13'),
('https://images.glints.com/unsafe/glints-dashboard.s3.amazonaws.com/company-logo/6a827a544887e05743ef701f716adcb6.png', 'Đặt sự hài lòng của khách hàng là ưu tiên số 1 trong mọi suy nghĩ hành động của mình” là sứ mệnh, là triết lý, chiến lược.. luôn cùng TrungKien tiến bước ok', 'https://bizweb.dktcdn.net/100/438/408/themes/946371/assets/slider_1.jpg?1714364005915', 'https://www.facebook.com/trungkien48/', 'https://youtu.be/sbfks7HdRoE?si=bZaBJNaRCqgK68Zk', '#', 'Công ty thời trang và giải trí Trung Kiên', '0366508004', '13 đường P. Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội, Việt Nam', 'https://greenwich.edu.vn/wp-content/uploads/2023/06/YODY-web-1-768x327.png', 'https://storage.googleapis.com/geniusvn/posts/1bdHo1oPFaH8AtVCZnWW1avsy9alP7gz1P7tgAEs.jpg', 'https://lh7-us.googleusercontent.com/ZU7Qi_hKgmrgzFeQpU8Jd6NPTPqbVdYYVCQlctOBGkiMowvg6wg-fLMlxxXpkjbReW4ZKWWszvwUcG1EKTXIC7zcmn-UeOCQRgdQWUkMUJE-qI4gqr0zZxObD9MUNRS27Lrh2ckCPJ2RmPq5422jaj8', '14', '13', '13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rank` tinyint NOT NULL DEFAULT '0' COMMENT '0 là hạng đồng , 1 là hạng bạc, 2 hạng vàng và 3 hạng kim cương\r\n',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0 là bình thường , 1 là bị khóa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `address`, `role`, `created_at`, `rank`, `status`) VALUES
(1, 'Trung Kiên', 'lkien0408@gmail.com', '1234', '0366508004', 'Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội', 1, '2024-04-28 18:30:55', 0, 0),
(3, 'Việt Nam', 'kienltph35295@fpt.edu.vn', '123456', '0987654321', 'Đường An Định - Phường Yên Hòa - Thành Phố Hải Dương', 1, '2024-03-22 10:13:15', 0, 0),
(4, 'admin1', '', '123456', '', '', 2, '2024-03-27 13:45:19', 0, 0),
(18, 'Kiên Cường', 'lkien610@gmail.com', '12345678', '0987654321', 'Đường An Định - Phường Yên Hòa - Thành Phố Hải Dương', 1, '2024-04-28 16:05:40', 0, 0),
(19, 'Ki', 'admin@gmail.com', '12345', '0987654321', 'Đường An Định - Phường Yên Hòa - Thành Phố Hải Dương', 1, '2024-04-28 16:57:11', 0, 0),
(20, 'Ảo thật đậy', 'kien@fpt.edu.vn', '1234567', '0366508004', '13 đường P. Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội, Việt Nam', 1, '2024-04-29 16:46:11', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE `variant` (
  `id` int NOT NULL,
  `idpro` int NOT NULL,
  `color` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `size` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`id`, `idpro`, `color`, `size`, `quantity`) VALUES
(1, 21, 'Xanh', 'L', 0),
(2, 21, 'Đỏ', 'L', 0),
(3, 21, 'Đen', 'M', 0),
(4, 21, 'Hồng', 'S', 10),
(5, 19, 'Trắng', 'L', 0),
(6, 19, 'Đen', 'XL', 10),
(7, 18, 'Đen', 'XL', 0),
(8, 17, 'Đen', 'L', 0),
(9, 16, 'Trắng', 'S', 10),
(10, 15, 'Đen', 'S', 10),
(11, 14, 'Hồng', 'L', 10),
(12, 8, 'Hồng', 'XL', 10),
(13, 9, 'Đen', 'S', 10),
(14, 11, 'Trắng', 'XL', 11),
(15, 10, 'Đen', 'L', 4),
(16, 22, 'Hồng', 'XL', 4),
(17, 22, 'Đen', 'S', 10),
(18, 22, 'Trắng', 'S', 10),
(19, 24, 'Trắng', 'M', 10),
(20, 24, 'Đỏ', 'M', 11),
(21, 23, 'Vàng', 'M', 11),
(22, 23, 'Xanh', 'M', 12),
(23, 23, 'Hồng', 'M', 11),
(24, 21, 'Đen', 'XL', 10),
(26, 21, 'Đỏ', 'XXL', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_admin` (`id_user_admin`),
  ADD KEY `id_comment` (`id_comment`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation_id` (`conversation_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ct` (`id_ct`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpro` (`idpro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`id_user_admin`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id_comment`) REFERENCES `comments` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_ct`) REFERENCES `categories` (`id`);

--
-- Constraints for table `variant`
--
ALTER TABLE `variant`
  ADD CONSTRAINT `variant_ibfk_1` FOREIGN KEY (`idpro`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
