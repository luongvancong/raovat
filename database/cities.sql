-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2016 at 08:55 PM
-- Server version: 5.6.28-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rv_tour`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `cit_id` int(11) NOT NULL,
  `cit_name` varchar(255) DEFAULT NULL,
  `cit_parent` int(11) DEFAULT '0',
  `cit_active` tinyint(4) DEFAULT '1',
  `cit_hot` tinyint(1) NOT NULL DEFAULT '0',
  `cit_image` varchar(255) NOT NULL,
  `cit_country_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=769 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cit_id`, `cit_name`, `cit_parent`, `cit_active`, `cit_hot`, `cit_image`, `cit_country_id`) VALUES
(2, 'Hà Nội', 0, 1, 0, '', 0),
(3, 'Hồ Chí Minh', 0, 1, 0, '', 0),
(4, 'An Giang', 0, 1, 0, '', 0),
(5, 'Bà Rịa - Vũng Tàu', 0, 1, 0, '', 0),
(6, 'Bắc Ninh', 0, 1, 0, '', 0),
(7, 'Bắc Giang', 0, 1, 0, '', 0),
(8, 'Bình Dương', 0, 1, 0, '', 0),
(9, 'Bình Định', 0, 1, 0, '', 0),
(10, 'Bình Phước', 0, 1, 0, '', 0),
(11, 'Bình Thuận', 0, 1, 0, '', 0),
(13, 'Bến Tre', 0, 1, 0, '', 0),
(14, 'Bắc Cạn', 0, 1, 0, '', 0),
(15, 'Cần Thơ', 0, 1, 0, '', 0),
(17, 'Khánh Hòa', 0, 1, 0, '', 0),
(19, 'Thừa Thiên Huế', 0, 1, 0, '', 0),
(20, 'Lào Cai', 0, 1, 0, '', 0),
(21, 'Quảng Ninh', 0, 1, 0, '', 0),
(22, 'Đồng Nai', 0, 1, 0, '', 0),
(23, 'Nam Định', 0, 1, 0, '', 0),
(24, 'Cà Mau', 0, 1, 0, '', 0),
(25, 'Cao Bằng', 0, 1, 0, '', 0),
(26, 'Gia Lai', 0, 1, 0, '', 0),
(27, 'Hà Giang', 0, 1, 0, '', 0),
(28, 'Hà Nam', 0, 1, 0, '', 0),
(30, 'Hà Tĩnh', 0, 1, 0, '', 0),
(31, 'Hải Dương', 0, 1, 0, '', 0),
(32, 'Hải Phòng', 0, 1, 0, '', 0),
(33, 'Hoà Bình', 0, 1, 0, '', 0),
(34, 'Hưng Yên', 0, 1, 0, '', 0),
(35, 'Kiên Giang', 0, 1, 0, '', 0),
(36, 'Kon Tum', 0, 1, 0, '', 0),
(37, 'Lai Châu', 0, 1, 0, '', 0),
(38, 'Lâm Đồng', 0, 1, 0, '', 0),
(39, 'Lạng Sơn', 0, 1, 0, '', 0),
(40, 'Long An', 0, 1, 0, '', 0),
(41, 'Nghệ An', 0, 1, 0, '', 0),
(42, 'Ninh Bình', 0, 1, 0, '', 0),
(43, 'Ninh Thuận', 0, 1, 0, '', 0),
(44, 'Phú Thọ', 0, 1, 0, '', 0),
(45, 'Phú Yên', 0, 1, 0, '', 0),
(46, 'Quảng Bình', 0, 1, 0, '', 0),
(47, 'Quảng Nam', 0, 1, 0, '', 0),
(48, 'Quảng Ngãi', 0, 1, 0, '', 0),
(49, 'Quảng Trị', 0, 1, 0, '', 0),
(50, 'Sóc Trăng', 0, 1, 0, '', 0),
(51, 'Sơn La', 0, 1, 0, '', 0),
(52, 'Tây Ninh', 0, 1, 0, '', 0),
(53, 'Thái Bình', 0, 1, 0, '', 0),
(54, 'Thái Nguyên', 0, 1, 0, '', 0),
(55, 'Thanh Hoá', 0, 1, 0, '', 0),
(56, 'Tiền Giang', 0, 1, 0, '', 0),
(57, 'Trà Vinh', 0, 1, 0, '', 0),
(58, 'Tuyên Quang', 0, 1, 0, '', 0),
(59, 'Vĩnh Long', 0, 1, 0, '', 0),
(60, 'Vĩnh Phúc', 0, 1, 0, '', 0),
(61, 'Yên Bái', 0, 1, 0, '', 0),
(62, 'Đắc Lắc', 0, 1, 0, '', 0),
(64, 'Đồng Tháp', 0, 1, 0, '', 0),
(65, 'Đà Nẵng', 0, 1, 0, '', 0),
(66, 'Buôn Mê Thuột', 0, 1, 0, '', 0),
(67, 'Đắc Nông', 0, 1, 0, '', 0),
(68, 'Hậu Giang', 0, 1, 0, '', 0),
(70, 'Bạc Liêu', 0, 1, 0, '', 0),
(71, 'Điện Biên', 0, 1, 0, '', 0),
(72, 'Quận Hoàng Mai', 2, 1, 0, '', 0),
(73, 'Quận Ba Đình', 2, 1, 0, '', 0),
(74, 'Quận Long Biên', 2, 1, 0, '', 0),
(75, 'Quận Cầu Giấy', 2, 1, 0, '', 0),
(76, 'Quận Đống Đa', 2, 1, 0, '', 0),
(77, 'Quận Hai Bà Trưng', 2, 1, 0, '', 0),
(78, 'Quận Hoàn Kiếm', 2, 1, 0, '', 0),
(79, 'Quận Tây Hồ', 2, 1, 0, '', 0),
(80, 'Quận Thanh Xuân', 2, 1, 0, '', 0),
(81, 'Huyện Ba Vì', 2, 1, 0, '', 0),
(82, 'Huyện Chương Mỹ', 2, 1, 0, '', 0),
(83, 'Huyện Đan Phượng', 2, 1, 0, '', 0),
(84, 'Quận 1', 3, 1, 0, '', 0),
(85, 'Quận 2', 3, 1, 0, '', 0),
(86, 'Huyện Gia Lâm', 2, 1, 0, '', 0),
(87, 'Huyện Hoài Đức', 2, 1, 0, '', 0),
(88, 'Huyện Mê Linh', 2, 1, 0, '', 0),
(89, 'Huyện Mỹ Đức', 2, 1, 0, '', 0),
(90, 'Huyện Phú Xuyên', 2, 1, 0, '', 0),
(91, 'Huyện Phúc Thọ', 2, 1, 0, '', 0),
(92, 'Huyện Quốc Oai', 2, 1, 0, '', 0),
(93, 'Huyện Sóc Sơn', 2, 1, 0, '', 0),
(94, 'Huyện Thạch Thất', 2, 1, 0, '', 0),
(95, 'Huyện Thanh Oai', 2, 1, 0, '', 0),
(96, 'Huyện Thanh Trì', 2, 1, 0, '', 0),
(97, 'Huyện Thường Tín', 2, 1, 0, '', 0),
(98, 'Huyện Từ Liêm', 2, 1, 0, '', 0),
(99, 'Huyện Ứng Hòa', 2, 1, 0, '', 0),
(100, 'Quận 3', 3, 1, 0, '', 0),
(101, 'Quận 4', 3, 1, 0, '', 0),
(102, 'Quận 5', 3, 1, 0, '', 0),
(103, 'Quận 6', 3, 1, 0, '', 0),
(104, 'Quận 7', 3, 1, 0, '', 0),
(105, 'Quận 8', 3, 1, 0, '', 0),
(106, 'Quận 9', 3, 1, 0, '', 0),
(107, 'Quận 10', 3, 1, 0, '', 0),
(108, 'Quận 11', 3, 1, 0, '', 0),
(109, 'Quận 12', 3, 1, 0, '', 0),
(110, 'Quận Tân Bình', 3, 1, 0, '', 0),
(111, 'Quận Tân Phú', 3, 1, 0, '', 0),
(112, 'Quận Bình Tân', 3, 1, 0, '', 0),
(113, 'Quận Phú Nhuận', 3, 1, 0, '', 0),
(114, 'Quận Gò Vấp', 3, 1, 0, '', 0),
(115, 'Quận Bình Thạnh', 3, 1, 0, '', 0),
(116, 'Quận Thủ Đức', 3, 1, 0, '', 0),
(117, 'Quận Hồng Bàng', 32, 1, 0, '', 0),
(118, 'Quận Ngô Quyền', 32, 1, 0, '', 0),
(119, 'Quận Lê Chân', 32, 1, 0, '', 0),
(120, 'Quận Kiến An', 32, 1, 0, '', 0),
(121, 'Quận Hải An', 32, 1, 0, '', 0),
(122, 'Quận Dương Kinh', 32, 1, 0, '', 0),
(123, 'Quận Đồ Sơn', 32, 1, 0, '', 0),
(124, 'Huyện Sơn Trà', 65, 1, 0, '', 0),
(125, 'Quận Hải Châu', 65, 1, 0, '', 0),
(126, 'Quận Thanh Khê', 65, 1, 0, '', 0),
(127, 'Quận Ngũ Hành Sơn', 65, 1, 0, '', 0),
(128, 'Quận Liên Chiểu', 65, 1, 0, '', 0),
(129, 'Quận Cẩm Lệ', 65, 1, 0, '', 0),
(130, 'Quận Ninh Kiều', 15, 1, 0, '', 0),
(131, 'Quận Bình Thủy', 15, 1, 0, '', 0),
(132, 'Quận Cái Răng', 15, 1, 0, '', 0),
(133, 'Quận Thốt Nốt', 15, 1, 0, '', 0),
(134, 'Quận Hà Đông', 2, 1, 0, '', 0),
(135, 'Quận Ô môn', 15, 1, 0, '', 0),
(136, 'Huyện A Lưới', 19, 1, 0, '', 0),
(137, 'Huyện Đông Hải ', 70, 1, 0, '', 0),
(138, 'Huyện Nam Đông ', 19, 1, 0, '', 0),
(139, 'Huyện Phong Điền', 19, 1, 0, '', 0),
(140, 'Huyện Phú Lộc', 19, 1, 0, '', 0),
(141, 'Huyện Phú Vang', 19, 1, 0, '', 0),
(142, 'Huyện Quảng Điền', 19, 1, 0, '', 0),
(143, 'Thị xã Hương Thủy', 19, 1, 0, '', 0),
(144, 'Huyện Châu Đức', 5, 1, 0, '', 0),
(145, 'Huyện Côn Đảo', 5, 1, 0, '', 0),
(146, 'Huyện Đất Đỏ', 5, 1, 0, '', 0),
(147, 'Huyện Long Điền', 5, 1, 0, '', 0),
(148, 'Huyện Tân Thành', 5, 1, 0, '', 0),
(149, 'Thị xã Bà Rịa', 5, 1, 0, '', 0),
(150, 'Thành phố Vũng Tàu', 5, 1, 0, '', 0),
(151, 'Huyện Xuyên Mộc', 5, 1, 0, '', 0),
(152, 'Huyện An Phú', 4, 1, 0, '', 0),
(153, 'Huyện Châu Phú', 4, 1, 0, '', 0),
(154, 'Thị xã Châu Đốc', 4, 1, 0, '', 0),
(155, 'Huyện Châu Thành', 4, 1, 0, '', 0),
(156, 'Huyện Chợ Mới', 4, 1, 0, '', 0),
(157, 'Thành phố Long Xuyên ', 4, 1, 0, '', 0),
(158, 'Thị xã Tân Châu', 4, 1, 0, '', 0),
(159, 'Huyện Thoại Sơn', 4, 1, 0, '', 0),
(160, 'Huyện Tịnh Biên', 4, 1, 0, '', 0),
(161, 'Huyện Tri Tôn ', 4, 1, 0, '', 0),
(162, 'Thành phố Bạc Liêu', 70, 1, 0, '', 0),
(163, 'Huyện Giá Rai ', 70, 1, 0, '', 0),
(164, 'Huyện Hoà Bình ', 70, 1, 0, '', 0),
(165, 'Huyện Hồng Dân ', 70, 1, 0, '', 0),
(166, 'Huyện Phước Long ', 70, 1, 0, '', 0),
(167, 'Huyện Vĩnh Lợi ', 70, 1, 0, '', 0),
(168, 'Thành phố Bắc Giang ', 7, 1, 0, '', 0),
(169, 'Huyện Lục Nam', 7, 1, 0, '', 0),
(170, 'Huyện Lục Ngạn ', 7, 1, 0, '', 0),
(171, 'Huyện Sơn Động ', 7, 1, 0, '', 0),
(172, 'Huyện Tân Yên ', 7, 1, 0, '', 0),
(173, 'Huyện Yên Dũng ', 7, 1, 0, '', 0),
(174, 'Huyện Yên Thế ', 7, 1, 0, '', 0),
(175, 'Thị xã Bắc Kạn ', 14, 1, 0, '', 0),
(176, 'Huyện Chợ Mới ', 14, 1, 0, '', 0),
(177, 'Huyện Na Rì ', 14, 1, 0, '', 0),
(178, 'Huyện Ngân Sơn ', 14, 1, 0, '', 0),
(179, 'Thành phố Bắc Ninh ', 6, 1, 0, '', 0),
(180, 'Huyện Gia Bình ', 6, 1, 0, '', 0),
(181, 'Huyện Quế Võ ', 6, 1, 0, '', 0),
(182, 'Huyện Thuận Thành ', 6, 1, 0, '', 0),
(183, 'Huyện Tiên Du ', 6, 1, 0, '', 0),
(184, 'Thị xã Từ Sơn', 6, 1, 0, '', 0),
(185, 'Huyện Yên Phong ', 6, 1, 0, '', 0),
(186, 'Huyện Ba Tri ', 13, 1, 0, '', 0),
(187, 'Thành phố Bến Tre', 13, 1, 0, '', 0),
(188, 'Huyện Bình Đại ', 13, 1, 0, '', 0),
(189, 'Huyện Châu Thành ', 13, 1, 0, '', 0),
(190, 'Huyện Chợ Lách ', 13, 1, 0, '', 0),
(191, 'Huyện Giồng Trôm ', 13, 1, 0, '', 0),
(192, 'Huyện Mỏ Cày Nam ', 13, 1, 0, '', 0),
(193, 'Huyện Thạnh Phú ', 13, 1, 0, '', 0),
(194, 'Huyện Bến Cát ', 8, 1, 0, '', 0),
(195, 'Huyện Dầu Tiếng ', 8, 1, 0, '', 0),
(196, 'Thị xã Dĩ An ', 8, 1, 0, '', 0),
(197, 'Huyện Phú Giáo ', 8, 1, 0, '', 0),
(198, 'Huyện Tân Uyên ', 8, 1, 0, '', 0),
(199, 'Thị xã Thủ Dầu Một ', 8, 1, 0, '', 0),
(200, 'Thị xã Thuận An ', 8, 1, 0, '', 0),
(201, 'Huyện An Lão ', 9, 1, 0, '', 0),
(202, 'Huyện An Nhơn ', 9, 1, 0, '', 0),
(203, 'Huyện Hoài Nhơn ', 9, 1, 0, '', 0),
(204, 'Huyện Phù Cát ', 9, 1, 0, '', 0),
(205, 'Huyện Phù Mỹ ', 9, 1, 0, '', 0),
(206, 'Thành phố Qui Nhơn', 9, 1, 0, '', 0),
(207, 'Huyện Tây Sơn ', 9, 1, 0, '', 0),
(208, 'Huyện Tuy Phước ', 9, 1, 0, '', 0),
(209, 'Huyện Vân Canh ', 9, 1, 0, '', 0),
(210, 'Huyện Vĩnh Thạnh ', 9, 1, 0, '', 0),
(211, 'Thị xã Bình Long ', 10, 1, 0, '', 0),
(212, 'Huyện Bù Đăng ', 10, 1, 0, '', 0),
(213, 'Thị xã Đồng Xoài ', 10, 1, 0, '', 0),
(214, 'Huyện Lộc Ninh ', 10, 1, 0, '', 0),
(215, 'Thị xã Phước Long ', 10, 1, 0, '', 0),
(216, 'Huyện Bù Gia Mập ', 10, 1, 0, '', 0),
(217, 'Huyện Hàm Tân ', 11, 1, 0, '', 0),
(218, 'Thị xã La Gi', 11, 1, 0, '', 0),
(219, 'Thành phố Phan Thiết ', 11, 1, 0, '', 0),
(220, 'Huyện Tuy Phong ', 11, 1, 0, '', 0),
(221, 'Thành phố Cà Mau ', 24, 1, 0, '', 0),
(222, 'Huyện Cái Nước ', 24, 1, 0, '', 0),
(223, 'Huyện Đầm Dơi ', 24, 1, 0, '', 0),
(224, 'Huyện Năm Căn ', 24, 1, 0, '', 0),
(225, 'Huyện Ngọc Hiển ', 24, 1, 0, '', 0),
(226, 'Huyện Phú Tân ', 24, 1, 0, '', 0),
(227, 'Huyện Thới Bình ', 24, 1, 0, '', 0),
(228, 'Huyện Trần Văn Thời ', 24, 1, 0, '', 0),
(229, 'Huyện U Minh ', 24, 1, 0, '', 0),
(230, 'Huyện Bảo Lạc ', 25, 1, 0, '', 0),
(231, 'Huyện Bảo Lâm ', 25, 1, 0, '', 0),
(232, 'Thị xã Cao Bằng ', 25, 1, 0, '', 0),
(233, 'Huyện Nguyên Bình ', 25, 1, 0, '', 0),
(234, 'Huyện Quảng Uyên ', 25, 1, 0, '', 0),
(235, 'Huyện Thông Nông ', 25, 1, 0, '', 0),
(236, 'Huyện Trà Lĩnh ', 25, 1, 0, '', 0),
(237, 'Huyện Trùng Khánh ', 25, 1, 0, '', 0),
(238, 'Huyện Cờ Đỏ ', 15, 1, 0, '', 0),
(239, 'Huyện Phong Điền ', 15, 1, 0, '', 0),
(240, 'Huyện Vĩnh Thạnh ', 15, 1, 0, '', 0),
(241, 'Huyện Buôn Đôn ', 62, 1, 0, '', 0),
(242, 'Huyện đảo Hoàng Sa ', 65, 1, 0, '', 0),
(243, 'Thành phố Buôn Ma Thuột ', 62, 1, 0, '', 0),
(244, 'Huyện Cư Kuin ', 62, 1, 0, '', 0),
(245, 'Huyện Ea Hleo ', 62, 1, 0, '', 0),
(246, 'Huyện Ea Kar ', 62, 1, 0, '', 0),
(247, 'Huyện Ea Súp ', 62, 1, 0, '', 0),
(248, 'Huyện Krông Ana ', 62, 1, 0, '', 0),
(249, 'Huyện Krông Bông ', 62, 1, 0, '', 0),
(250, 'Huyện Krông Búk ', 62, 1, 0, '', 0),
(251, 'Huyện Krông Năng ', 62, 1, 0, '', 0),
(252, 'Huyện Krông Pắk ', 62, 1, 0, '', 0),
(253, 'Huyện MĐrăk ', 62, 1, 0, '', 0),
(254, 'Thị xã Buôn Hồ ', 62, 1, 0, '', 0),
(255, 'Huyện Đăk Glong ', 67, 1, 0, '', 0),
(256, 'Huyện Đăk Mil ', 67, 1, 0, '', 0),
(257, 'Huyện Đăk RLấp ', 67, 1, 0, '', 0),
(258, 'Huyện Đăk Song ', 67, 1, 0, '', 0),
(259, 'Thị xã Gia Nghĩa ', 67, 1, 0, '', 0),
(260, 'Huyện Tuy Đức ', 67, 1, 0, '', 0),
(261, 'Thành phố Biên Hòa ', 22, 1, 0, '', 0),
(262, 'Huyện Cẩm Mỹ ', 22, 1, 0, '', 0),
(263, 'Huyện Định Quán ', 22, 1, 0, '', 0),
(264, 'Thị xã Long Khánh ', 22, 1, 0, '', 0),
(265, 'Huyện Long Thành ', 22, 1, 0, '', 0),
(266, 'Huyện Nhơn Trạch ', 22, 1, 0, '', 0),
(267, 'Huyện Thống Nhất ', 22, 1, 0, '', 0),
(268, 'Huyện Trảng Bom ', 22, 1, 0, '', 0),
(269, 'Huyện Vĩnh Cửu ', 22, 1, 0, '', 0),
(270, 'Huyện Xuân Lộc ', 22, 1, 0, '', 0),
(271, 'Huyện Tân Phú ', 22, 1, 0, '', 0),
(272, 'Thành phố Cao Lãnh ', 64, 1, 0, '', 0),
(273, 'Huyện Cao Lãnh ', 64, 1, 0, '', 0),
(274, 'Huyện Châu Thành ', 64, 1, 0, '', 0),
(275, 'Thị xã Hồng Ngự ', 64, 1, 0, '', 0),
(276, 'Huyện Lai Vung ', 64, 1, 0, '', 0),
(277, 'Huyện Hồng Ngự ', 64, 1, 0, '', 0),
(278, 'Huyện Lấp Vò ', 64, 1, 0, '', 0),
(279, 'Thị xã Sa Đéc ', 64, 1, 0, '', 0),
(280, 'Huyện Tam Nông ', 64, 1, 0, '', 0),
(281, 'Huyện Tân Hồng ', 64, 1, 0, '', 0),
(282, 'Huyện Thanh Bình ', 64, 1, 0, '', 0),
(283, 'Huyện Tháp Mười ', 64, 1, 0, '', 0),
(284, 'Thị xã An Khê ', 26, 1, 0, '', 0),
(285, 'Thị xã Ayun Pa ', 26, 1, 0, '', 0),
(286, 'Huyện Chư Prông ', 26, 1, 0, '', 0),
(287, 'Huyện Chư Sê ', 26, 1, 0, '', 0),
(288, 'Huyện Đăk Đoa ', 26, 1, 0, '', 0),
(289, 'Huyện Đức Cơ ', 26, 1, 0, '', 0),
(290, 'Huyện KBang ', 26, 1, 0, '', 0),
(291, 'Huyện Kông Chro ', 26, 1, 0, '', 0),
(292, 'Huyện Krông Pa ', 26, 1, 0, '', 0),
(293, 'Huyện Mang Yang ', 26, 1, 0, '', 0),
(294, 'Huyện Phú Thiện ', 26, 1, 0, '', 0),
(295, 'Thành phố Pleiku ', 26, 1, 0, '', 0),
(296, 'Huyện Chư Pưh ', 26, 1, 0, '', 0),
(297, 'Huyện Đồng Văn ', 27, 1, 0, '', 0),
(298, 'Thành phố Hà Giang ', 27, 1, 0, '', 0),
(299, 'Huyện Mèo Vạc ', 27, 1, 0, '', 0),
(300, 'Huyện Quản Bạ ', 27, 1, 0, '', 0),
(301, 'Huyện Vị Xuyên', 27, 1, 0, '', 0),
(302, 'Huyện Xín Mần ', 27, 1, 0, '', 0),
(303, 'Huyện Yên Minh ', 27, 1, 0, '', 0),
(304, 'Huyện Bình Lục', 28, 1, 0, '', 0),
(305, 'Huyện Duy Tiên ', 28, 1, 0, '', 0),
(306, 'Huyện Kim Bảng ', 28, 1, 0, '', 0),
(307, 'Huyện Lý Nhân ', 28, 1, 0, '', 0),
(308, 'Thành phố Phủ Lý ', 28, 1, 0, '', 0),
(309, 'Huyện Can Lộc ', 30, 1, 0, '', 0),
(310, 'Huyện Cẩm Xuyên ', 30, 1, 0, '', 0),
(311, 'Huyện Đức Thọ ', 30, 1, 0, '', 0),
(312, 'Thành phố Hà Tĩnh ', 30, 1, 0, '', 0),
(313, 'Thị xã Hồng Lĩnh ', 30, 1, 0, '', 0),
(314, 'Huyện Hương Khê ', 30, 1, 0, '', 0),
(315, 'Huyện Hương Sơn ', 30, 1, 0, '', 0),
(316, 'Huyện Kỳ Anh ', 30, 1, 0, '', 0),
(317, 'Huyện Vũ Quang ', 30, 1, 0, '', 0),
(318, 'Huyện Thạch Hà ', 30, 1, 0, '', 0),
(319, 'Huyện Nghi Xuân ', 30, 1, 0, '', 0),
(320, 'Huyện Bình Giang ', 31, 1, 0, '', 0),
(321, 'Huyện Cẩm Giàng ', 31, 1, 0, '', 0),
(322, 'Thị xã Chí Linh ', 31, 1, 0, '', 0),
(323, 'Huyện Gia Lộc ', 31, 1, 0, '', 0),
(324, 'Thành phố Hải Dương ', 31, 1, 0, '', 0),
(325, 'Huyện Kim Thành ', 31, 1, 0, '', 0),
(326, 'Huyện Kinh Môn ', 31, 1, 0, '', 0),
(327, 'Huyện Nam Sách ', 31, 1, 0, '', 0),
(328, 'Huyện Ninh Giang ', 31, 1, 0, '', 0),
(329, 'Huyện Thanh Hà ', 31, 1, 0, '', 0),
(330, 'Huyện Thanh Miện ', 31, 1, 0, '', 0),
(331, 'Huyện Tứ Kỳ ', 31, 1, 0, '', 0),
(332, 'Huyện An Dương ', 32, 1, 0, '', 0),
(333, 'Huyện đảo Cát Hải ', 32, 1, 0, '', 0),
(334, 'Huyện Kiến Thụy ', 32, 1, 0, '', 0),
(335, 'Huyện Tiên Lãng ', 32, 1, 0, '', 0),
(336, 'Huyện Vĩnh Bảo ', 32, 1, 0, '', 0),
(337, 'Huyện Châu Thành', 68, 1, 0, '', 0),
(338, 'Huyện Châu Thành A ', 68, 1, 0, '', 0),
(339, 'Huyện Long Mỹ ', 68, 1, 0, '', 0),
(340, 'Huyện Phụng Hiệp ', 68, 1, 0, '', 0),
(341, 'Thị xã Ngã Bảy (Tân Hiệp cũ) ', 68, 1, 0, '', 0),
(342, 'Thành phố Vị Thanh ', 68, 1, 0, '', 0),
(343, 'Huyện Vị Thủy ', 68, 1, 0, '', 0),
(344, 'Huyện Cao Phong ', 33, 1, 0, '', 0),
(345, 'Huyện Đà Bắc ', 33, 1, 0, '', 0),
(346, 'Thành phố Hoà Bình ', 33, 1, 0, '', 0),
(347, 'Huyện Kim Bôi ', 33, 1, 0, '', 0),
(348, 'Huyện Lạc Sơn ', 33, 1, 0, '', 0),
(349, 'Huyện Lạc Thủy ', 33, 1, 0, '', 0),
(350, 'Huyện Lương Sơn ', 33, 1, 0, '', 0),
(351, 'Huyện Mai Châu ', 33, 1, 0, '', 0),
(352, 'Huyện Yên Thủy ', 33, 1, 0, '', 0),
(353, 'Huyện Ân Thi ', 34, 1, 0, '', 0),
(354, 'Thành phố Hưng Yên ', 34, 1, 0, '', 0),
(355, 'Huyện Khoái Châu ', 34, 1, 0, '', 0),
(356, 'Huyện Mỹ Hào ', 34, 1, 0, '', 0),
(357, 'Huyện Văn Giang ', 34, 1, 0, '', 0),
(358, 'Huyện Văn Lâm ', 34, 1, 0, '', 0),
(359, 'Huyện Yên Mỹ ', 34, 1, 0, '', 0),
(360, 'Huyện An Biên ', 35, 1, 0, '', 0),
(361, 'Huyện An Minh ', 35, 1, 0, '', 0),
(362, 'Huyện Châu Thành ', 35, 1, 0, '', 0),
(363, 'Huyện Giồng Riềng ', 35, 1, 0, '', 0),
(364, 'Huyện Gò Quao ', 35, 1, 0, '', 0),
(365, 'Thị xã Hà Tiên ', 35, 1, 0, '', 0),
(366, 'Huyện Hòn Đất', 35, 1, 0, '', 0),
(367, 'Huyện Kiên Lương ', 35, 1, 0, '', 0),
(368, 'Huyện đảo Phú Quốc ', 35, 1, 0, '', 0),
(369, 'Thành phố Rạch Giá ', 35, 1, 0, '', 0),
(370, 'Huyện Tân Hiệp ', 35, 1, 0, '', 0),
(371, 'Huyện U Minh Thượng ', 35, 1, 0, '', 0),
(372, 'Huyện Vĩnh Thuận ', 35, 1, 0, '', 0),
(373, 'Huyện Đắk Glei ', 36, 1, 0, '', 0),
(374, 'Huyện Đắk Hà ', 36, 1, 0, '', 0),
(375, 'Huyện Đăk Tô ', 36, 1, 0, '', 0),
(376, 'Huyện Kon Plông ', 36, 1, 0, '', 0),
(377, 'Huyện Kon Rẫy ', 36, 1, 0, '', 0),
(378, 'Huyện Sa Thầy ', 36, 1, 0, '', 0),
(379, 'Huyện Tu Mơ Rông ', 36, 1, 0, '', 0),
(380, 'Thành phố Cam Ranh ', 17, 1, 0, '', 0),
(381, 'Huyện Diên Khánh ', 17, 1, 0, '', 0),
(382, 'Huyện Khánh Sơn ', 17, 1, 0, '', 0),
(383, 'Huyện Khánh Vĩnh ', 17, 1, 0, '', 0),
(384, 'Thành phố Nha Trang ', 17, 1, 0, '', 0),
(385, 'Thị xã Ninh Hòa ', 17, 1, 0, '', 0),
(386, 'Huyện Vạn Ninh ', 17, 1, 0, '', 0),
(387, 'Thị xã Lai Châu ', 37, 1, 0, '', 0),
(388, 'Huyện Phong Thổ ', 37, 1, 0, '', 0),
(389, 'Huyện Sìn Hồ ', 37, 1, 0, '', 0),
(390, 'Huyện Tam Đường ', 37, 1, 0, '', 0),
(391, 'Huyện Than Uyên ', 37, 1, 0, '', 0),
(392, 'Huyện Mường Tè ', 37, 1, 0, '', 0),
(393, 'Huyện Bắc Sơn ', 39, 1, 0, '', 0),
(394, 'Huyện Bình Gia ', 39, 1, 0, '', 0),
(395, 'Huyện Chi Lăng ', 39, 1, 0, '', 0),
(396, 'Huyện Đình Lập ', 39, 1, 0, '', 0),
(397, 'Huyện Hữu Lũng', 39, 1, 0, '', 0),
(398, 'Thành phố Lạng Sơn ', 39, 1, 0, '', 0),
(399, 'Huyện Lộc Bình ', 39, 1, 0, '', 0),
(400, 'Huyện Văn Quan ', 39, 1, 0, '', 0),
(401, 'Huyện Bát Xát ', 20, 1, 0, '', 0),
(402, 'Huyện Bắc Hà ', 20, 1, 0, '', 0),
(403, 'Thành phố Lào Cai ', 20, 1, 0, '', 0),
(404, 'Huyện Mường Khương ', 20, 1, 0, '', 0),
(405, 'Huyện Sa Pa ', 20, 1, 0, '', 0),
(406, 'Huyện Si Ma Cai ', 20, 1, 0, '', 0),
(407, 'Huyện Văn Bàn ', 20, 1, 0, '', 0),
(408, 'Huyện Bảo Lâm ', 38, 1, 0, '', 0),
(409, 'Thành phố Bảo Lộc ', 38, 1, 0, '', 0),
(410, 'Huyện Di Linh ', 38, 1, 0, '', 0),
(411, 'Thành phố Đà Lạt ', 38, 1, 0, '', 0),
(412, 'Huyện Đạ Tẻh ', 38, 1, 0, '', 0),
(413, 'Huyện Lạc Dương ', 38, 1, 0, '', 0),
(414, 'Huyện Lâm Hà ', 38, 1, 0, '', 0),
(415, 'Huyện Bến Lức ', 40, 1, 0, '', 0),
(416, 'Huyện Cần Đước ', 40, 1, 0, '', 0),
(417, 'Huyện Cần Giuộc ', 40, 1, 0, '', 0),
(418, 'Huyện Châu Thành ', 40, 1, 0, '', 0),
(419, 'Huyện Đức Hòa ', 40, 1, 0, '', 0),
(420, 'Huyện Đức Huệ ', 40, 1, 0, '', 0),
(421, 'Huyện Mộc Hóa ', 40, 1, 0, '', 0),
(422, 'Thành phố Tân An ', 40, 1, 0, '', 0),
(423, 'Huyện Tân Hưng ', 40, 1, 0, '', 0),
(424, 'Huyện Tân Thạnh ', 40, 1, 0, '', 0),
(425, 'Huyện Tân Trụ ', 40, 1, 0, '', 0),
(426, 'Huyện Thạnh Hóa ', 40, 1, 0, '', 0),
(427, 'Huyện Thủ Thừa ', 40, 1, 0, '', 0),
(428, 'Huyện Vĩnh Hưng ', 40, 1, 0, '', 0),
(429, 'Huyện Giao Thủy ', 23, 1, 0, '', 0),
(430, 'Huyện Hải Hậu ', 23, 1, 0, '', 0),
(431, 'Huyện Mỹ Lộc ', 23, 1, 0, '', 0),
(432, 'Thành phố Nam Định ', 23, 1, 0, '', 0),
(433, 'Huyện Nam Trực ', 23, 1, 0, '', 0),
(434, 'Huyện Nghĩa Hưng ', 23, 1, 0, '', 0),
(435, 'Huyện Trực Ninh ', 23, 1, 0, '', 0),
(436, 'Huyện Vụ Bản ', 23, 1, 0, '', 0),
(437, 'Huyện Xuân Trường ', 23, 1, 0, '', 0),
(438, 'Huyện Ý Yên ', 23, 1, 0, '', 0),
(439, 'Huyện Gia Viễn ', 42, 1, 0, '', 0),
(440, 'Huyện Kim Sơn ', 42, 1, 0, '', 0),
(441, 'Huyện Nho Quan', 42, 1, 0, '', 0),
(442, 'Thành phố Ninh Bình ', 42, 1, 0, '', 0),
(443, 'Thị xã Tam Điệp ', 42, 1, 0, '', 0),
(444, 'Huyện Ninh Sơn ', 43, 1, 0, '', 0),
(445, 'Thành phố Phan Rang-Tháp Chàm ', 43, 1, 0, '', 0),
(446, 'Huyện Anh Sơn ', 41, 1, 0, '', 0),
(447, 'Huyện Con Cuông ', 41, 1, 0, '', 0),
(448, 'Thị xã Cửa Lò ', 41, 1, 0, '', 0),
(449, 'Huyện Diễn Châu ', 41, 1, 0, '', 0),
(450, 'Huyện Đô Lương ', 41, 1, 0, '', 0),
(451, 'Huyện Hưng Nguyên ', 41, 1, 0, '', 0),
(452, 'Huyện Kỳ Sơn ', 41, 1, 0, '', 0),
(453, 'Huyện Nam Đàn ', 41, 1, 0, '', 0),
(454, 'Huyện Nghi Lộc ', 41, 1, 0, '', 0),
(455, 'Huyện Quỳ Hợp ', 41, 1, 0, '', 0),
(456, 'Huyện Quỳnh Lưu ', 41, 1, 0, '', 0),
(457, 'Huyện Tân Kỳ ', 41, 1, 0, '', 0),
(458, 'Thị xã Thái Hòa ', 41, 1, 0, '', 0),
(459, 'Huyện Thanh Chương ', 41, 1, 0, '', 0),
(460, 'Thành phố Vinh ', 41, 1, 0, '', 0),
(461, 'Huyện Yên Thành ', 41, 1, 0, '', 0),
(462, 'Huyện Đoan Hùng ', 44, 1, 0, '', 0),
(463, 'Huyện Hạ Hòa ', 44, 1, 0, '', 0),
(464, 'Huyện Lâm Thao ', 44, 1, 0, '', 0),
(465, 'Thị xã Phú Thọ', 44, 1, 0, '', 0),
(466, 'Huyện Thanh Ba ', 44, 1, 0, '', 0),
(467, 'Huyện Thanh Sơn ', 44, 1, 0, '', 0),
(468, 'Huyện Thanh Thủy ', 44, 1, 0, '', 0),
(469, 'Thành phố Việt Trì ', 44, 1, 0, '', 0),
(470, 'Huyện Yên Lập ', 44, 1, 0, '', 0),
(471, 'Thị xã Sông Cầu ', 45, 1, 0, '', 0),
(472, 'Huyện Tuy An ', 45, 1, 0, '', 0),
(473, 'Thành phố Tuy Hòa ', 45, 1, 0, '', 0),
(474, 'Huyện Bố Trạch ', 46, 1, 0, '', 0),
(475, 'Thành phố Đồng Hới ', 46, 1, 0, '', 0),
(476, 'Huyện Lệ Thủy ', 46, 1, 0, '', 0),
(477, 'Huyện Điện Bàn ', 47, 1, 0, '', 0),
(478, 'Thành phố Hội An ', 47, 1, 0, '', 0),
(479, 'Huyện Núi Thành ', 47, 1, 0, '', 0),
(480, 'Huyện Phú Ninh ', 47, 1, 0, '', 0),
(481, 'Thành phố Tam Kỳ ', 47, 1, 0, '', 0),
(482, 'Huyện Thăng Bình ', 47, 1, 0, '', 0),
(483, 'Huyện Tiên Phước ', 47, 1, 0, '', 0),
(484, 'Huyện Ba Chẽ ', 21, 1, 0, '', 0),
(485, 'Huyện Bình Liêu ', 21, 1, 0, '', 0),
(486, 'Thị xã Cẩm Phả ', 21, 1, 0, '', 0),
(487, 'Huyện đảo Cô Tô ', 21, 1, 0, '', 0),
(488, 'Huyện Đầm Hà ', 21, 1, 0, '', 0),
(489, 'Huyện Đông Triều ', 21, 1, 0, '', 0),
(490, 'Thành phố Hạ Long ', 21, 1, 0, '', 0),
(491, 'Huyện Hoành Bồ ', 21, 1, 0, '', 0),
(492, 'Thành phố Móng Cái ', 21, 1, 0, '', 0),
(493, 'Huyện Tiên Yên ', 21, 1, 0, '', 0),
(494, 'Thành phố Uông Bí ', 21, 1, 0, '', 0),
(495, 'Huyện Yên Hưng ', 21, 1, 0, '', 0),
(496, 'Huyện Ba Tơ ', 48, 1, 0, '', 0),
(497, 'Huyện Đức Phổ ', 48, 1, 0, '', 0),
(498, 'Huyện đảo Lý Sơn ', 48, 1, 0, '', 0),
(499, 'Huyện Minh Long ', 48, 1, 0, '', 0),
(500, 'Huyện Mộ Đức ', 48, 1, 0, '', 0),
(501, 'Thành phố Quảng Ngãi ', 48, 1, 0, '', 0),
(502, 'Huyện Sơn Hà ', 48, 1, 0, '', 0),
(503, 'Huyện Sơn Tịnh ', 48, 1, 0, '', 0),
(504, 'Huyện Trà Bồng ', 48, 1, 0, '', 0),
(505, 'Huyện Cam Lộ ', 49, 1, 0, '', 0),
(506, 'Huyện đảo Cồn Cỏ ', 49, 1, 0, '', 0),
(507, 'Huyện Đa Krông ', 49, 1, 0, '', 0),
(508, 'Thành phố Đông Hà ', 49, 1, 0, '', 0),
(509, 'Huyện Gio Linh ', 49, 1, 0, '', 0),
(510, 'Huyện Hải Lăng ', 49, 1, 0, '', 0),
(511, 'Thị xã Quảng Trị ', 49, 1, 0, '', 0),
(512, 'Huyện Vĩnh Linh ', 49, 1, 0, '', 0),
(513, 'Huyện Cù Lao Dung ', 50, 1, 0, '', 0),
(514, 'Huyện Kế Sách ', 50, 1, 0, '', 0),
(515, 'Huyện Long Phú ', 50, 1, 0, '', 0),
(516, 'Huyện Mỹ Tú ', 50, 1, 0, '', 0),
(517, 'Huyện Mỹ Xuyên ', 50, 1, 0, '', 0),
(518, 'Huyện Ngã Năm ', 50, 1, 0, '', 0),
(519, 'Thành phố Sóc Trăng ', 50, 1, 0, '', 0),
(520, 'Huyện Thạnh Trị ', 50, 1, 0, '', 0),
(521, 'Huyện Vĩnh Châu ', 50, 1, 0, '', 0),
(522, 'Huyện Châu Thành ', 50, 1, 0, '', 0),
(523, 'Huyện Bắc Yên ', 51, 1, 0, '', 0),
(524, 'Huyện Mộc Châu ', 51, 1, 0, '', 0),
(525, 'Huyện Phù Yên ', 51, 1, 0, '', 0),
(526, 'Huyện Quỳnh Nhai ', 51, 1, 0, '', 0),
(527, 'Huyện Sông Mã ', 51, 1, 0, '', 0),
(528, 'Huyện Sốp Cộp ', 51, 1, 0, '', 0),
(529, 'Thành phố Sơn La ', 51, 1, 0, '', 0),
(530, 'Huyện Thuận Châu ', 51, 1, 0, '', 0),
(531, 'Huyện Yên Châu ', 51, 1, 0, '', 0),
(532, 'Huyện Bến Cầu ', 52, 1, 0, '', 0),
(533, 'Huyện Châu Thành ', 52, 1, 0, '', 0),
(534, 'Huyện Dương Minh Châu ', 52, 1, 0, '', 0),
(535, 'Huyện Gò Dầu ', 52, 1, 0, '', 0),
(536, 'Huyện Hòa Thành ', 52, 1, 0, '', 0),
(537, 'Huyện Tân Biên ', 52, 1, 0, '', 0),
(538, 'Huyện Tân Châu ', 52, 1, 0, '', 0),
(539, 'Thị xã Tây Ninh ', 52, 1, 0, '', 0),
(540, 'Huyện Trảng Bàng ', 52, 1, 0, '', 0),
(541, 'Huyện Cai Lậy ', 56, 1, 0, '', 0),
(542, 'Huyện Cái Bè ', 56, 1, 0, '', 0),
(543, 'Huyện Chợ Gạo ', 56, 1, 0, '', 0),
(544, 'Thị xã Gò Công ', 56, 1, 0, '', 0),
(545, 'Thành phố Mỹ Tho ', 56, 1, 0, '', 0),
(546, 'Huyện Tân Phước ', 56, 1, 0, '', 0),
(547, 'Huyện Chiêm Hóa ', 58, 1, 0, '', 0),
(548, 'Huyện Hàm Yên ', 58, 1, 0, '', 0),
(549, 'Huyện Na Hang ', 58, 1, 0, '', 0),
(550, 'Huyện Sơn Dương ', 58, 1, 0, '', 0),
(551, 'Thành phố Tuyên Quang ', 58, 1, 0, '', 0),
(552, 'Huyện Yên Sơn ', 58, 1, 0, '', 0),
(553, 'Huyện Đông Hưng ', 53, 1, 0, '', 0),
(554, 'Huyện Hưng Hà ', 53, 1, 0, '', 0),
(555, 'Huyện Kiến Xương ', 53, 1, 0, '', 0),
(556, 'Huyện Quỳnh Phụ ', 53, 1, 0, '', 0),
(557, 'Thành phố Thái Bình ', 53, 1, 0, '', 0),
(558, 'Huyện Thái Thụy ', 53, 1, 0, '', 0),
(559, 'Huyện Tiền Hải ', 53, 1, 0, '', 0),
(560, 'Huyện Vũ Thư ', 53, 1, 0, '', 0),
(561, 'Huyện Đại Từ ', 54, 1, 0, '', 0),
(562, 'Huyện Đồng Hỷ ', 54, 1, 0, '', 0),
(563, 'Thị xã Sông Công ', 54, 1, 0, '', 0),
(564, 'Thành phố Thái Nguyên ', 54, 1, 0, '', 0),
(565, 'Huyện Bá Thước ', 55, 1, 0, '', 0),
(566, 'Thị xã Bỉm Sơn', 55, 1, 0, '', 0),
(567, 'Huyện Cẩm Thủy ', 55, 1, 0, '', 0),
(568, 'Huyện Hà Trung ', 55, 1, 0, '', 0),
(569, 'Huyện Hậu Lộc ', 55, 1, 0, '', 0),
(570, 'Huyện Hoằng Hóa ', 55, 1, 0, '', 0),
(571, 'Huyện Lang Chánh ', 55, 1, 0, '', 0),
(572, 'Huyện Mường Lát ', 55, 1, 0, '', 0),
(573, 'Huyện Nga Sơn ', 55, 1, 0, '', 0),
(574, 'Huyện Ngọc Lặc ', 55, 1, 0, '', 0),
(575, 'Huyện Nông Cống ', 55, 1, 0, '', 0),
(576, 'Huyện Quan Hóa ', 55, 1, 0, '', 0),
(577, 'Huyện Quan Sơn ', 55, 1, 0, '', 0),
(578, 'Huyện Quảng Xương ', 55, 1, 0, '', 0),
(579, 'Thị xã Sầm Sơn ', 55, 1, 0, '', 0),
(580, 'Huyện Thạch Thành ', 55, 1, 0, '', 0),
(581, 'Thành phố Thanh Hóa ', 55, 1, 0, '', 0),
(582, 'Huyện Thiệu Hóa ', 55, 1, 0, '', 0),
(583, 'Huyện Thọ Xuân ', 55, 1, 0, '', 0),
(584, 'Huyện Thường Xuân ', 55, 1, 0, '', 0),
(585, 'Huyện Tĩnh Gia ', 55, 1, 0, '', 0),
(586, 'Huyện Triệu Sơn ', 55, 1, 0, '', 0),
(587, 'Huyện Vĩnh Lộc ', 55, 1, 0, '', 0),
(588, 'Huyện Yên Định ', 55, 1, 0, '', 0),
(589, 'Huyện Càng Long ', 57, 1, 0, '', 0),
(590, 'Huyện Cầu Kè ', 57, 1, 0, '', 0),
(591, 'Huyện Cầu Ngang ', 57, 1, 0, '', 0),
(592, 'Huyện Châu Thành ', 57, 1, 0, '', 0),
(593, 'Huyện Duyên Hải ', 57, 1, 0, '', 0),
(594, 'Huyện Tiểu Cần ', 57, 1, 0, '', 0),
(595, 'Huyện Trà Cú ', 57, 1, 0, '', 0),
(596, 'Thành phố Trà Vinh ', 57, 1, 0, '', 0),
(597, 'Huyện Bình Minh ', 59, 1, 0, '', 0),
(598, 'Huyện Bình Tân ', 59, 1, 0, '', 0),
(599, 'Huyện Long Hồ ', 59, 1, 0, '', 0),
(600, 'Huyện Mang Thít ', 59, 1, 0, '', 0),
(601, 'Huyện Tam Bình ', 59, 1, 0, '', 0),
(602, 'Huyện Trà Ôn ', 59, 1, 0, '', 0),
(603, 'Thành phố Vĩnh Long ', 59, 1, 0, '', 0),
(604, 'Huyện Vũng Liêm ', 59, 1, 0, '', 0),
(605, 'Huyện Bình Xuyên ', 60, 1, 0, '', 0),
(606, 'Huyện Lập Thạch ', 60, 1, 0, '', 0),
(607, 'Thị xã Phúc Yên ', 60, 1, 0, '', 0),
(608, 'Huyện Vĩnh Tường ', 60, 1, 0, '', 0),
(609, 'Thành phố Vĩnh Yên ', 60, 1, 0, '', 0),
(610, 'Huyện Yên Lạc ', 60, 1, 0, '', 0),
(611, 'Huyện Tam Đảo ', 60, 1, 0, '', 0),
(612, 'Huyện Mù Căng Chải ', 61, 1, 0, '', 0),
(613, 'Thị xã Nghĩa Lộ ', 61, 1, 0, '', 0),
(614, 'Huyện Trạm Tấu ', 61, 1, 0, '', 0),
(615, 'Thành phố Yên Bái ', 61, 1, 0, '', 0),
(616, 'Huyện Yên Bình ', 61, 1, 0, '', 0),
(617, 'Huyện Điện Biên ', 71, 1, 0, '', 0),
(618, 'Huyện Điện Biên Đông ', 71, 1, 0, '', 0),
(619, 'Thành phố Điện Biên Phủ ', 71, 1, 0, '', 0),
(620, 'Huyện Mường Ảng ', 71, 1, 0, '', 0),
(621, 'Huyện Mường Chà ', 71, 1, 0, '', 0),
(622, 'Thị xã Mường Lay ', 71, 1, 0, '', 0),
(623, 'Huyện Mường Nhé ', 71, 1, 0, '', 0),
(624, 'Huyện Tủa Chùa ', 71, 1, 0, '', 0),
(625, 'Huyện Tuần Giáo ', 71, 1, 0, '', 0),
(626, 'Huyện Đông Anh', 2, 1, 0, '', 0),
(627, 'Thành phố Huế', 19, 1, 0, '', 0),
(628, 'Huyện Cần Giờ', 3, 1, 0, '', 0),
(629, 'Huyện Củ Chi', 3, 1, 0, '', 0),
(630, 'Huyện Vân Đồn', 21, 1, 0, '', 0),
(631, 'Huyện Hiệp Hòa', 7, 1, 0, '', 0),
(632, 'Huyện Lạng Giang', 7, 1, 0, '', 0),
(633, 'Huyện Việt Yên', 7, 1, 0, '', 0),
(634, 'Huyện Ba Bể', 14, 1, 0, '', 0),
(635, 'Huyện Bạch Thông ', 14, 1, 0, '', 0),
(636, 'Huyện Chợ Đồn', 14, 1, 0, '', 0),
(637, 'Huyện Pác Nặm ', 14, 1, 0, '', 0),
(638, 'Huyện Lương Tài', 6, 1, 0, '', 0),
(639, 'Huyện Mỏ Cày Bắc ', 13, 1, 0, '', 0),
(640, 'Huyện Hoài Ân ', 9, 1, 0, '', 0),
(641, 'Huyện Bù Đốp ', 10, 1, 0, '', 0),
(642, 'Huyện Chơn Thành', 10, 1, 0, '', 0),
(643, 'Huyện Đồng Phú ', 10, 1, 0, '', 0),
(644, 'Huyện Hớn Quản', 10, 1, 0, '', 0),
(645, 'Huyện Bắc Bình ', 11, 1, 0, '', 0),
(646, 'Huyện Đức Linh', 11, 1, 0, '', 0),
(647, 'Huyện Hàm Thuận Bắc', 11, 1, 0, '', 0),
(648, 'Huyện Hàm Thuận Nam', 11, 1, 0, '', 0),
(649, 'Huyện đảo Phú Quý', 11, 1, 0, '', 0),
(650, 'Huyện Tánh Linh', 11, 1, 0, '', 0),
(651, 'Huyện Thới Lai ', 15, 1, 0, '', 0),
(652, 'Huyện Hà Quảng', 25, 1, 0, '', 0),
(653, 'Huyện Hạ Lang ', 25, 1, 0, '', 0),
(654, 'Huyện Hòa An', 25, 1, 0, '', 0),
(655, 'Huyện Phục Hòa', 25, 1, 0, '', 0),
(656, 'Huyện Thạch An', 25, 1, 0, '', 0),
(657, 'Huyện Hòa Vang', 65, 1, 0, '', 0),
(658, 'Huyện Cư Mgar ', 62, 1, 0, '', 0),
(659, 'Huyện Lăk', 62, 1, 0, '', 0),
(660, 'Huyện Cư Jút ', 67, 1, 0, '', 0),
(661, 'Huyện Krông Nô', 67, 1, 0, '', 0),
(662, 'Huyện Chư Păh', 26, 1, 0, '', 0),
(663, 'Huyện Đắk Pơ', 26, 1, 0, '', 0),
(664, 'Huyện Ia Grai ', 26, 1, 0, '', 0),
(665, 'Huyện Ia Pa ', 26, 1, 0, '', 0),
(666, 'Huyện Bắc Mê ', 27, 1, 0, '', 0),
(667, 'Huyện Bắc Quang ', 27, 1, 0, '', 0),
(668, 'Huyện Hoàng Su Phì ', 27, 1, 0, '', 0),
(669, 'Huyện Quang Bình', 27, 1, 0, '', 0),
(670, 'Huyện Thanh Liêm ', 28, 1, 0, '', 0),
(671, 'Huyện Lộc Hà ', 30, 1, 0, '', 0),
(672, 'Huyện An Lão ', 32, 1, 0, '', 0),
(673, 'Huyện đảo Bạch Long Vĩ', 32, 1, 0, '', 0),
(674, 'Huyện Thuỷ Nguyên ', 32, 1, 0, '', 0),
(675, 'Huyện Kỳ Sơn ', 33, 1, 0, '', 0),
(676, 'Huyện Kim Động ', 34, 1, 0, '', 0),
(677, 'Huyện Phù Cừ ', 34, 1, 0, '', 0),
(678, 'Huyện Tiên Lữ ', 34, 1, 0, '', 0),
(679, 'Huyện đảo Trường Sa', 17, 1, 0, '', 0),
(680, 'Huyện Cam Lâm ', 17, 1, 0, '', 0),
(681, 'Huyện đảo Kiên Hải ', 35, 1, 0, '', 0),
(682, 'Huyện Giang Thành', 35, 1, 0, '', 0),
(683, 'Thành phố Kon Tum', 36, 1, 0, '', 0),
(684, 'Huyện Ngọc Hồi', 36, 1, 0, '', 0),
(685, 'Huyện Tân Uyên', 37, 1, 0, '', 0),
(686, 'Huyện Cát Tiên ', 38, 1, 0, '', 0),
(687, 'Huyện Đạ Huoai ', 38, 1, 0, '', 0),
(688, 'Huyện Đam Rông ', 38, 1, 0, '', 0),
(689, 'huyện Đơn Dương ', 38, 1, 0, '', 0),
(690, 'Huyện Đức Trọng ', 38, 1, 0, '', 0),
(691, 'Huyện Cao Lộc', 39, 1, 0, '', 0),
(692, 'huyện Tràng Định ', 39, 1, 0, '', 0),
(693, 'Huyện Văn Lãng', 39, 1, 0, '', 0),
(694, 'Huyện Bảo Thắng ', 20, 1, 0, '', 0),
(695, 'Huyện Bảo Yên', 20, 1, 0, '', 0),
(696, 'Huyện Nghĩa Đàn ', 41, 1, 0, '', 0),
(697, 'Huyện Quế Phong ', 41, 1, 0, '', 0),
(698, 'Huyện Quỳ Châu ', 41, 1, 0, '', 0),
(699, 'Huyện Tương Dương ', 41, 1, 0, '', 0),
(700, 'Huyện Hoa Lư ', 42, 1, 0, '', 0),
(701, 'Huyện Yên Khánh ', 42, 1, 0, '', 0),
(702, 'Huyện Yên Mô ', 42, 1, 0, '', 0),
(703, 'Huyện Bác Ái ', 43, 1, 0, '', 0),
(704, 'Huyện Ninh Hải', 43, 1, 0, '', 0),
(705, 'Huyện Ninh Phước ', 43, 1, 0, '', 0),
(706, 'Huyện Thuận Bắc', 43, 1, 0, '', 0),
(707, 'Huyện Thuận Nam ', 43, 1, 0, '', 0),
(708, 'Huyện Phù Ninh ', 44, 1, 0, '', 0),
(709, 'Huyện Tam Nông', 44, 1, 0, '', 0),
(710, 'Huyện Tân Sơn', 44, 1, 0, '', 0),
(711, 'Huyện Cẩm Khê', 44, 1, 0, '', 0),
(712, 'Huyện Đông Hòa ', 45, 1, 0, '', 0),
(713, 'Huyện Đồng Xuân', 45, 1, 0, '', 0),
(714, 'Huyện Phú Hòa', 45, 1, 0, '', 0),
(715, 'Huyện Sông Hinh', 45, 1, 0, '', 0),
(716, 'Huyện Sơn Hòa', 45, 1, 0, '', 0),
(717, 'Huyện Tây Hòa', 45, 1, 0, '', 0),
(718, 'Huyện Minh Hóa ', 46, 1, 0, '', 0),
(719, 'Huyện Quảng Ninh', 46, 1, 0, '', 0),
(720, 'Huyện Quảng Trạch ', 46, 1, 0, '', 0),
(721, 'Huyện Tuyên Hóa', 46, 1, 0, '', 0),
(722, 'Huyện Nam Trà My ', 47, 1, 0, '', 0),
(723, 'Huyện Bắc Trà My ', 47, 1, 0, '', 0),
(724, 'Huyện Duy Xuyên', 47, 1, 0, '', 0),
(725, 'Huyện Đại Lộc', 47, 1, 0, '', 0),
(726, 'Huyện Đông Giang', 47, 1, 0, '', 0),
(727, 'Huyện Hiệp Đức ', 47, 1, 0, '', 0),
(728, 'Huyện Nam Giang ', 47, 1, 0, '', 0),
(729, 'Huyện Phước Sơn', 47, 1, 0, '', 0),
(730, 'Huyện Quế Sơn', 47, 1, 0, '', 0),
(731, 'Huyện Tây Giang', 47, 1, 0, '', 0),
(732, 'Huyện Nông Sơn', 47, 1, 0, '', 0),
(733, 'Huyện Bình Sơn ', 48, 1, 0, '', 0),
(734, 'Huyện Nghĩa Hành', 48, 1, 0, '', 0),
(735, 'Huyện Sơn Tây ', 48, 1, 0, '', 0),
(736, 'Huyện Tây Trà ', 48, 1, 0, '', 0),
(737, 'Huyện Tư Nghĩa ', 21, 1, 0, '', 0),
(738, 'Huyện Hải Hà ', 21, 1, 0, '', 0),
(739, 'Huyện Hướng Hóa ', 49, 1, 0, '', 0),
(740, 'Huyện Triệu Phong', 49, 1, 0, '', 0),
(741, 'Huyện Trần Đề', 50, 1, 0, '', 0),
(742, 'Huyện Mai Sơn', 51, 1, 0, '', 0),
(743, 'Huyện Mường La', 51, 1, 0, '', 0),
(744, 'Huyện Định Hóa', 54, 1, 0, '', 0),
(745, 'Huyện Phổ Yên ', 54, 1, 0, '', 0),
(746, 'Huyện Phú Bình', 54, 1, 0, '', 0),
(747, 'Huyện Phú Lương ', 54, 1, 0, '', 0),
(748, 'Huyện Võ Nhai', 54, 1, 0, '', 0),
(749, 'Huyện Đông Sơn ', 55, 1, 0, '', 0),
(750, 'Huyện Như Thanh', 55, 1, 0, '', 0),
(751, 'Huyện Như Xuân ', 55, 1, 0, '', 0),
(752, 'Huyện Châu Thành ', 56, 1, 0, '', 0),
(753, 'Huyện Gò Công Đông', 56, 1, 0, '', 0),
(754, 'Huyện Gò Công Tây', 56, 1, 0, '', 0),
(755, 'Huyện Tân Phú Đông', 56, 1, 0, '', 0),
(756, 'Huyện Bình Chánh ', 3, 1, 0, '', 0),
(757, 'Huyện Cần Giờ ', 3, 1, 0, '', 0),
(758, 'Huyện Cụ Chi', 3, 1, 0, '', 0),
(759, 'Huyện Hóc Môn ', 3, 1, 0, '', 0),
(760, 'Huyện Nhà Bè ', 3, 1, 0, '', 0),
(761, 'Huyện Lâm Bình', 58, 1, 0, '', 0),
(762, 'Huyện Sông Lô', 60, 1, 0, '', 0),
(763, 'Huyện Tam Dương', 60, 1, 0, '', 0),
(764, 'Huyện Lục Yên', 61, 1, 0, '', 0),
(765, 'Huyện Trấn Yên', 61, 1, 0, '', 0),
(766, 'Huyện Văn Chấn', 61, 1, 0, '', 0),
(767, 'Huyện Văn Yên ', 61, 1, 0, '', 0),
(768, 'Thị xã Sơn Tây', 2, 1, 0, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=769;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
