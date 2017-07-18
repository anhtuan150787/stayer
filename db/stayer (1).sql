-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2017 at 09:31 PM
-- Server version: 5.5.55-0ubuntu0.14.04.1
-- PHP Version: 5.6.30-12~ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stayer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `status`, `email`, `group_id`, `deleted`, `phone`) VALUES
(1, 'Anh Tuấn', 'admin', '550e1bafe077ff0b0b67f4e32f29d751', 1, 'anhtuan150787@gmail.com', 1, 0, '0944518855'),
(2, 'sale', 'sale_hotel', '550e1bafe077ff0b0b67f4e32f29d751', 1, 'sale@yahoo.com', 2, 0, '12345678'),
(3, 'Sản phẩm', 'product_hotel', '550e1bafe077ff0b0b67f4e32f29d751', 1, 'product@yahoo.com', 3, 0, '12345678'),
(4, 'Xử lý đơn hàng khách sạn', 'order_process_hotel', '550e1bafe077ff0b0b67f4e32f29d751', 1, 'order_process_hotel@yahoo.com', 6, 0, '123456789'),
(5, 'Quản lý đơn hàng khách sạn', 'order_manager_hotel', '550e1bafe077ff0b0b67f4e32f29d751', 1, 'order_manager_hotel@yahoo.com', 7, 0, '12345678'),
(6, 'Kế toán', 'accountant', '550e1bafe077ff0b0b67f4e32f29d751', 1, 'accountant@yahoo.com', 8, 0, '12345678'),
(7, 'Xử lý đơn hàng khách sạn', 'order_process_hotel_2', '550e1bafe077ff0b0b67f4e32f29d751', 1, 'order_process_hotel_2@yahoo.com', 6, 0, '123123123123'),
(8, 'Xử lý đơn hàng tour', 'order_process_tour', '550e1bafe077ff0b0b67f4e32f29d751', 1, 'order_process_tour@yahoo.com', 9, 0, '12345678'),
(9, 'Quản lý đơn hàng tour', 'order_manager_tour', '550e1bafe077ff0b0b67f4e32f29d751', 1, 'order_manager_tour@yahoo.com', 10, 0, '12345678'),
(10, 'test', 'qlks', '1f32aa4c9a1d2ea010adcf2348166a04', 1, '', 3, 0, '0909277866');

-- --------------------------------------------------------

--
-- Table structure for table `admin_group`
--

CREATE TABLE IF NOT EXISTS `admin_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admin_group`
--

INSERT INTO `admin_group` (`id`, `name`, `description`, `deleted`) VALUES
(1, 'Administrator', 'Toàn quyền hệ thống, không được xóa', 0),
(2, 'Sales khách sạn', 'Bộ phận sale khách sạn', 0),
(3, 'Quản lý khách sạn', 'Bộ phận quản lý sản phẩm khách sạn, duyệt hiển thị khách sạn', 0),
(4, 'Nội dung', 'Bộ phận quản lý nội dung (bài viết)', 0),
(5, 'Quản trị hệ thống', 'Quản trị hệ thống, thấp hơn administrator (không được quản trị user hệ thống)', 0),
(6, 'Xử lý đơn hàng khách sạn', 'Bộ phận xử lý đơn đặt hàng khách sạn', 0),
(7, 'Quản lý đơn hàng khách sạn', 'Bộ phận quản lý đơn hàng khách sạn', 0),
(8, 'Kế toán', 'Bộ phận kế toán', 0),
(9, 'Xử lý đơn hàng tour', 'Xử lý đơn hàng tour', 0),
(10, 'Quản lý đơn hàng tour', 'Quản lý đơn hàng tour', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_permission`
--

CREATE TABLE IF NOT EXISTS `admin_permission` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_admin_id` int(11) DEFAULT NULL,
  `group` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `controller` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `method` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5618 ;

--
-- Dumping data for table `admin_permission`
--

INSERT INTO `admin_permission` (`id`, `group_admin_id`, `group`, `controller`, `method`) VALUES
(3237, 4, 'handbook', 'handbook', 'index'),
(3238, 4, 'handbook', 'handbook', 'add'),
(3239, 4, 'handbook', 'handbook', 'delete'),
(3240, 4, 'handbook', 'handbook', 'edit'),
(3241, 4, 'handbook', 'handbook', 'change_status'),
(3242, 4, 'handbook', 'handbook_category', 'index'),
(3243, 4, 'handbook', 'handbook_category', 'add'),
(3244, 4, 'handbook', 'handbook_category', 'delete'),
(3245, 4, 'handbook', 'handbook_category', 'edit'),
(3246, 4, 'handbook', 'handbook_category', 'change_status'),
(3247, 4, 'post', 'post_category', 'index'),
(3248, 4, 'post', 'post_category', 'add'),
(3249, 4, 'post', 'post_category', 'delete'),
(3250, 4, 'post', 'post_category', 'edit'),
(3251, 4, 'post', 'post_category', 'change_status'),
(3252, 4, 'post', 'post', 'index'),
(3253, 4, 'post', 'post', 'add'),
(3254, 4, 'post', 'post', 'delete'),
(3255, 4, 'post', 'post', 'edit'),
(3256, 4, 'post', 'post', 'change_status'),
(3257, 4, 'post', 'page', 'index'),
(3258, 4, 'post', 'page', 'add'),
(3259, 4, 'post', 'page', 'delete'),
(3260, 4, 'post', 'page', 'edit'),
(3261, 4, 'post', 'page', 'change_status'),
(4235, 2, 'hotel', 'hotel', 'index'),
(4236, 2, 'hotel', 'hotel', 'add'),
(4237, 2, 'hotel', 'hotel', 'edit'),
(4238, 2, 'hotel', 'hotel', 'change_status'),
(4239, 2, 'hotel', 'room_type', 'index'),
(4240, 2, 'hotel', 'room_type', 'add'),
(4241, 2, 'hotel', 'room_type', 'edit'),
(4242, 2, 'hotel', 'room_type', 'change_status'),
(4243, 2, 'hotel', 'partner', 'index'),
(4244, 2, 'hotel', 'partner', 'add'),
(4245, 2, 'hotel', 'partner', 'edit'),
(4246, 2, 'hotel', 'partner', 'change_status'),
(4247, 2, 'hotel', 'promotion', 'index'),
(4248, 2, 'hotel', 'promotion', 'add'),
(4249, 2, 'hotel', 'promotion', 'edit'),
(4250, 2, 'hotel', 'promotion', 'change_status'),
(4558, 5, 'partner_management', 'partner_group', 'index'),
(4559, 5, 'partner_management', 'partner_group', 'add'),
(4560, 5, 'partner_management', 'partner_group', 'delete'),
(4561, 5, 'partner_management', 'partner_group', 'edit'),
(4562, 5, 'partner_management', 'partner_list', 'index'),
(4563, 5, 'partner_management', 'partner_list', 'add'),
(4564, 5, 'partner_management', 'partner_list', 'delete'),
(4565, 5, 'partner_management', 'partner_list', 'edit'),
(4566, 5, 'partner_management', 'partner_list', 'change_status'),
(4567, 5, 'hotel', 'hotel', 'index'),
(4568, 5, 'hotel', 'hotel', 'add'),
(4569, 5, 'hotel', 'hotel', 'delete'),
(4570, 5, 'hotel', 'hotel', 'edit'),
(4571, 5, 'hotel', 'hotel', 'change_status'),
(4572, 5, 'hotel', 'room_type', 'index'),
(4573, 5, 'hotel', 'room_type', 'add'),
(4574, 5, 'hotel', 'room_type', 'delete'),
(4575, 5, 'hotel', 'room_type', 'edit'),
(4576, 5, 'hotel', 'room_type', 'change_status'),
(4577, 5, 'hotel', 'partner', 'index'),
(4578, 5, 'hotel', 'partner', 'add'),
(4579, 5, 'hotel', 'partner', 'delete'),
(4580, 5, 'hotel', 'partner', 'edit'),
(4581, 5, 'hotel', 'partner', 'change_status'),
(4582, 5, 'hotel', 'hotel_info', 'index'),
(4583, 5, 'hotel', 'hotel_info', 'add'),
(4584, 5, 'hotel', 'hotel_info', 'delete'),
(4585, 5, 'hotel', 'hotel_info', 'edit'),
(4586, 5, 'hotel', 'hotel_info', 'change_status'),
(4587, 5, 'hotel', 'promotion', 'index'),
(4588, 5, 'hotel', 'promotion', 'add'),
(4589, 5, 'hotel', 'promotion', 'delete'),
(4590, 5, 'hotel', 'promotion', 'edit'),
(4591, 5, 'hotel', 'promotion', 'change_status'),
(4592, 5, 'hotel', 'hotel_type', 'index'),
(4593, 5, 'hotel', 'hotel_type', 'add'),
(4594, 5, 'hotel', 'hotel_type', 'delete'),
(4595, 5, 'hotel', 'hotel_type', 'edit'),
(4596, 5, 'hotel', 'hotel_type', 'change_status'),
(4597, 5, 'hotel', 'hotel_facilities', 'index'),
(4598, 5, 'hotel', 'hotel_facilities', 'add'),
(4599, 5, 'hotel', 'hotel_facilities', 'delete'),
(4600, 5, 'hotel', 'hotel_facilities', 'edit'),
(4601, 5, 'hotel', 'hotel_facilities', 'change_status'),
(4602, 5, 'hotel', 'room_type_facilities', 'index'),
(4603, 5, 'hotel', 'room_type_facilities', 'add'),
(4604, 5, 'hotel', 'room_type_facilities', 'delete'),
(4605, 5, 'hotel', 'room_type_facilities', 'edit'),
(4606, 5, 'hotel', 'room_type_facilities', 'change_status'),
(4607, 5, 'hotel', 'hotel_comment', 'index'),
(4608, 5, 'hotel', 'hotel_comment', 'delete'),
(4609, 5, 'hotel', 'hotel_comment', 'change_status'),
(4610, 5, 'location', 'national', 'index'),
(4611, 5, 'location', 'national', 'add'),
(4612, 5, 'location', 'national', 'delete'),
(4613, 5, 'location', 'national', 'edit'),
(4614, 5, 'location', 'national', 'change_status'),
(4615, 5, 'location', 'area', 'index'),
(4616, 5, 'location', 'area', 'add'),
(4617, 5, 'location', 'area', 'delete'),
(4618, 5, 'location', 'area', 'edit'),
(4619, 5, 'location', 'area', 'change_status'),
(4620, 5, 'location', 'province', 'index'),
(4621, 5, 'location', 'province', 'add'),
(4622, 5, 'location', 'province', 'delete'),
(4623, 5, 'location', 'province', 'edit'),
(4624, 5, 'location', 'province', 'change_status'),
(4625, 5, 'location', 'district', 'index'),
(4626, 5, 'location', 'district', 'add'),
(4627, 5, 'location', 'district', 'delete'),
(4628, 5, 'location', 'district', 'edit'),
(4629, 5, 'location', 'district', 'change_status'),
(4630, 5, 'location', 'ward', 'index'),
(4631, 5, 'location', 'ward', 'add'),
(4632, 5, 'location', 'ward', 'delete'),
(4633, 5, 'location', 'ward', 'edit'),
(4634, 5, 'location', 'ward', 'change_status'),
(4635, 5, 'location', 'geonear', 'index'),
(4636, 5, 'location', 'geonear', 'add'),
(4637, 5, 'location', 'geonear', 'delete'),
(4638, 5, 'location', 'geonear', 'edit'),
(4639, 5, 'location', 'geonear', 'change_status'),
(4640, 5, 'location', 'sight', 'index'),
(4641, 5, 'location', 'sight', 'add'),
(4642, 5, 'location', 'sight', 'delete'),
(4643, 5, 'location', 'sight', 'edit'),
(4644, 5, 'location', 'sight', 'change_status'),
(4645, 5, 'location', 'beach', 'index'),
(4646, 5, 'location', 'beach', 'add'),
(4647, 5, 'location', 'beach', 'delete'),
(4648, 5, 'location', 'beach', 'edit'),
(4649, 5, 'location', 'beach', 'change_status'),
(4650, 5, 'handbook', 'handbook', 'index'),
(4651, 5, 'handbook', 'handbook', 'add'),
(4652, 5, 'handbook', 'handbook', 'delete'),
(4653, 5, 'handbook', 'handbook', 'edit'),
(4654, 5, 'handbook', 'handbook', 'change_status'),
(4655, 5, 'handbook', 'handbook_category', 'index'),
(4656, 5, 'handbook', 'handbook_category', 'add'),
(4657, 5, 'handbook', 'handbook_category', 'delete'),
(4658, 5, 'handbook', 'handbook_category', 'edit'),
(4659, 5, 'handbook', 'handbook_category', 'change_status'),
(4660, 5, 'post', 'post_category', 'index'),
(4661, 5, 'post', 'post_category', 'add'),
(4662, 5, 'post', 'post_category', 'delete'),
(4663, 5, 'post', 'post_category', 'edit'),
(4664, 5, 'post', 'post_category', 'change_status'),
(4665, 5, 'post', 'post', 'index'),
(4666, 5, 'post', 'post', 'add'),
(4667, 5, 'post', 'post', 'delete'),
(4668, 5, 'post', 'post', 'edit'),
(4669, 5, 'post', 'post', 'change_status'),
(4670, 5, 'post', 'page', 'index'),
(4671, 5, 'post', 'page', 'add'),
(4672, 5, 'post', 'page', 'delete'),
(4673, 5, 'post', 'page', 'edit'),
(4674, 5, 'post', 'page', 'change_status'),
(4675, 5, 'user', 'user', 'index'),
(4676, 5, 'user', 'user', 'add'),
(4677, 5, 'user', 'user', 'delete'),
(4678, 5, 'user', 'user', 'edit'),
(4679, 5, 'user', 'user', 'change_status'),
(4680, 5, 'display', 'display_type', 'index'),
(4681, 5, 'display', 'display_type', 'add'),
(4682, 5, 'display', 'display_type', 'delete'),
(4683, 5, 'display', 'display_type', 'edit'),
(4684, 5, 'display', 'display', 'index'),
(4685, 5, 'display', 'display', 'add'),
(4686, 5, 'display', 'display', 'delete'),
(4687, 5, 'display', 'display', 'edit'),
(4688, 5, 'display', 'display', 'change_status'),
(4689, 5, 'setting', 'foreign_currency', 'index'),
(4690, 5, 'hotel_order', 'hotel_order', 'index'),
(4691, 5, 'hotel_order', 'hotel_order', 'add'),
(4692, 5, 'hotel_order', 'hotel_order', 'edit'),
(4843, 9, 'tour', 'tour_order', 'index'),
(4844, 9, 'tour', 'tour_order', 'add'),
(4845, 9, 'tour', 'tour_order', 'edit'),
(4846, 10, 'tour', 'tour_order', 'index'),
(4847, 10, 'tour', 'tour_order', 'edit'),
(4848, 10, 'tour', 'tour_order', 'change_user_process'),
(5022, 3, 'hotel', 'hotel', 'index'),
(5023, 3, 'hotel', 'hotel', 'add'),
(5024, 3, 'hotel', 'hotel', 'delete'),
(5025, 3, 'hotel', 'hotel', 'edit'),
(5026, 3, 'hotel', 'hotel', 'change_status'),
(5027, 3, 'hotel', 'room_type', 'index'),
(5028, 3, 'hotel', 'room_type', 'add'),
(5029, 3, 'hotel', 'room_type', 'delete'),
(5030, 3, 'hotel', 'room_type', 'edit'),
(5031, 3, 'hotel', 'room_type', 'change_status'),
(5032, 3, 'hotel', 'partner', 'index'),
(5033, 3, 'hotel', 'partner', 'add'),
(5034, 3, 'hotel', 'partner', 'delete'),
(5035, 3, 'hotel', 'partner', 'edit'),
(5036, 3, 'hotel', 'partner', 'change_status'),
(5037, 3, 'hotel', 'hotel_info', 'index'),
(5038, 3, 'hotel', 'hotel_info', 'add'),
(5039, 3, 'hotel', 'hotel_info', 'delete'),
(5040, 3, 'hotel', 'hotel_info', 'edit'),
(5041, 3, 'hotel', 'hotel_info', 'change_status'),
(5042, 3, 'hotel', 'promotion', 'index'),
(5043, 3, 'hotel', 'promotion', 'add'),
(5044, 3, 'hotel', 'promotion', 'delete'),
(5045, 3, 'hotel', 'promotion', 'edit'),
(5046, 3, 'hotel', 'promotion', 'change_status'),
(5047, 3, 'hotel', 'hotel_type', 'index'),
(5048, 3, 'hotel', 'hotel_type', 'add'),
(5049, 3, 'hotel', 'hotel_type', 'delete'),
(5050, 3, 'hotel', 'hotel_type', 'edit'),
(5051, 3, 'hotel', 'hotel_type', 'change_status'),
(5052, 3, 'hotel', 'hotel_facilities', 'index'),
(5053, 3, 'hotel', 'hotel_facilities', 'add'),
(5054, 3, 'hotel', 'hotel_facilities', 'delete'),
(5055, 3, 'hotel', 'hotel_facilities', 'edit'),
(5056, 3, 'hotel', 'hotel_facilities', 'change_status'),
(5057, 3, 'hotel', 'room_type_facilities', 'index'),
(5058, 3, 'hotel', 'room_type_facilities', 'add'),
(5059, 3, 'hotel', 'room_type_facilities', 'delete'),
(5060, 3, 'hotel', 'room_type_facilities', 'edit'),
(5061, 3, 'hotel', 'room_type_facilities', 'change_status'),
(5062, 3, 'hotel', 'hotel_comment', 'index'),
(5063, 3, 'hotel', 'hotel_comment', 'delete'),
(5064, 3, 'hotel', 'hotel_comment', 'change_status'),
(5065, 3, 'user', 'user', 'index'),
(5066, 3, 'user', 'user', 'add'),
(5067, 3, 'user', 'user', 'delete'),
(5068, 3, 'user', 'user', 'edit'),
(5069, 3, 'user', 'user', 'change_status'),
(5070, 6, 'hotel', 'hotel_order', 'index'),
(5071, 6, 'hotel', 'hotel_order', 'add'),
(5072, 6, 'hotel', 'hotel_order', 'edit'),
(5073, 7, 'hotel', 'hotel_order', 'index'),
(5074, 7, 'hotel', 'hotel_order', 'add'),
(5075, 7, 'hotel', 'hotel_order', 'edit'),
(5076, 7, 'hotel', 'hotel_order', 'change_user_process'),
(5077, 8, 'hotel', 'hotel_order', 'index'),
(5078, 8, 'hotel', 'hotel_order', 'edit'),
(5079, 8, 'tour', 'tour_order', 'index'),
(5080, 8, 'tour', 'tour_order', 'edit'),
(5436, 1, 'admin', 'admin_group', 'index'),
(5437, 1, 'admin', 'admin_group', 'add'),
(5438, 1, 'admin', 'admin_group', 'delete'),
(5439, 1, 'admin', 'admin_group', 'edit'),
(5440, 1, 'admin', 'admin', 'index'),
(5441, 1, 'admin', 'admin', 'add'),
(5442, 1, 'admin', 'admin', 'delete'),
(5443, 1, 'admin', 'admin', 'edit'),
(5444, 1, 'admin', 'admin', 'change_status'),
(5445, 1, 'hotel', 'hotel', 'index'),
(5446, 1, 'hotel', 'hotel', 'add'),
(5447, 1, 'hotel', 'hotel', 'delete'),
(5448, 1, 'hotel', 'hotel', 'edit'),
(5449, 1, 'hotel', 'hotel', 'change_status'),
(5450, 1, 'hotel', 'room_type', 'index'),
(5451, 1, 'hotel', 'room_type', 'add'),
(5452, 1, 'hotel', 'room_type', 'delete'),
(5453, 1, 'hotel', 'room_type', 'edit'),
(5454, 1, 'hotel', 'room_type', 'change_status'),
(5455, 1, 'hotel', 'partner', 'index'),
(5456, 1, 'hotel', 'partner', 'add'),
(5457, 1, 'hotel', 'partner', 'delete'),
(5458, 1, 'hotel', 'partner', 'edit'),
(5459, 1, 'hotel', 'partner', 'change_status'),
(5460, 1, 'hotel', 'hotel_info', 'index'),
(5461, 1, 'hotel', 'hotel_info', 'add'),
(5462, 1, 'hotel', 'hotel_info', 'delete'),
(5463, 1, 'hotel', 'hotel_info', 'edit'),
(5464, 1, 'hotel', 'hotel_info', 'change_status'),
(5465, 1, 'hotel', 'promotion', 'index'),
(5466, 1, 'hotel', 'promotion', 'add'),
(5467, 1, 'hotel', 'promotion', 'delete'),
(5468, 1, 'hotel', 'promotion', 'edit'),
(5469, 1, 'hotel', 'promotion', 'change_status'),
(5470, 1, 'hotel', 'hotel_type', 'index'),
(5471, 1, 'hotel', 'hotel_type', 'add'),
(5472, 1, 'hotel', 'hotel_type', 'delete'),
(5473, 1, 'hotel', 'hotel_type', 'edit'),
(5474, 1, 'hotel', 'hotel_type', 'change_status'),
(5475, 1, 'hotel', 'hotel_facilities', 'index'),
(5476, 1, 'hotel', 'hotel_facilities', 'add'),
(5477, 1, 'hotel', 'hotel_facilities', 'delete'),
(5478, 1, 'hotel', 'hotel_facilities', 'edit'),
(5479, 1, 'hotel', 'hotel_facilities', 'change_status'),
(5480, 1, 'hotel', 'room_type_facilities', 'index'),
(5481, 1, 'hotel', 'room_type_facilities', 'add'),
(5482, 1, 'hotel', 'room_type_facilities', 'delete'),
(5483, 1, 'hotel', 'room_type_facilities', 'edit'),
(5484, 1, 'hotel', 'room_type_facilities', 'change_status'),
(5485, 1, 'hotel', 'hotel_comment', 'index'),
(5486, 1, 'hotel', 'hotel_comment', 'delete'),
(5487, 1, 'hotel', 'hotel_comment', 'change_status'),
(5488, 1, 'hotel', 'hotel_order', 'index'),
(5489, 1, 'hotel', 'hotel_order', 'add'),
(5490, 1, 'hotel', 'hotel_order', 'edit'),
(5491, 1, 'hotel', 'hotel_order', 'change_user_process'),
(5492, 1, 'hotel', 'partner_group', 'index'),
(5493, 1, 'hotel', 'partner_group', 'add'),
(5494, 1, 'hotel', 'partner_group', 'delete'),
(5495, 1, 'hotel', 'partner_group', 'edit'),
(5496, 1, 'hotel', 'partner_list', 'index'),
(5497, 1, 'hotel', 'partner_list', 'add'),
(5498, 1, 'hotel', 'partner_list', 'delete'),
(5499, 1, 'hotel', 'partner_list', 'edit'),
(5500, 1, 'hotel', 'partner_list', 'change_status'),
(5501, 1, 'hotel', 'coupon_group', 'index'),
(5502, 1, 'hotel', 'coupon_group', 'add'),
(5503, 1, 'hotel', 'coupon_group', 'delete'),
(5504, 1, 'hotel', 'coupon_group', 'edit'),
(5505, 1, 'hotel', 'coupon_group', 'change_status'),
(5506, 1, 'hotel', 'coupon', 'index'),
(5507, 1, 'hotel', 'coupon', 'add'),
(5508, 1, 'hotel', 'coupon', 'delete'),
(5509, 1, 'hotel', 'coupon', 'change_status'),
(5510, 1, 'tour', 'tour', 'index'),
(5511, 1, 'tour', 'tour', 'add'),
(5512, 1, 'tour', 'tour', 'delete'),
(5513, 1, 'tour', 'tour', 'edit'),
(5514, 1, 'tour', 'tour', 'change_status'),
(5515, 1, 'tour', 'tour_service', 'index'),
(5516, 1, 'tour', 'tour_service', 'add'),
(5517, 1, 'tour', 'tour_service', 'delete'),
(5518, 1, 'tour', 'tour_service', 'edit'),
(5519, 1, 'tour', 'tour_service', 'change_status'),
(5520, 1, 'tour', 'tour_topic', 'index'),
(5521, 1, 'tour', 'tour_topic', 'add'),
(5522, 1, 'tour', 'tour_topic', 'delete'),
(5523, 1, 'tour', 'tour_topic', 'edit'),
(5524, 1, 'tour', 'tour_topic', 'change_status'),
(5525, 1, 'tour', 'tour_comment', 'index'),
(5526, 1, 'tour', 'tour_comment', 'delete'),
(5527, 1, 'tour', 'tour_comment', 'change_status'),
(5528, 1, 'tour', 'partner_tour', 'index'),
(5529, 1, 'tour', 'partner_tour', 'add'),
(5530, 1, 'tour', 'partner_tour', 'delete'),
(5531, 1, 'tour', 'partner_tour', 'edit'),
(5532, 1, 'tour', 'partner_tour', 'change_status'),
(5533, 1, 'tour', 'tour_order', 'index'),
(5534, 1, 'tour', 'tour_order', 'add'),
(5535, 1, 'tour', 'tour_order', 'edit'),
(5536, 1, 'tour', 'tour_order', 'change_user_process'),
(5537, 1, 'location', 'national', 'index'),
(5538, 1, 'location', 'national', 'add'),
(5539, 1, 'location', 'national', 'delete'),
(5540, 1, 'location', 'national', 'edit'),
(5541, 1, 'location', 'national', 'change_status'),
(5542, 1, 'location', 'area', 'index'),
(5543, 1, 'location', 'area', 'add'),
(5544, 1, 'location', 'area', 'delete'),
(5545, 1, 'location', 'area', 'edit'),
(5546, 1, 'location', 'area', 'change_status'),
(5547, 1, 'location', 'province', 'index'),
(5548, 1, 'location', 'province', 'add'),
(5549, 1, 'location', 'province', 'delete'),
(5550, 1, 'location', 'province', 'edit'),
(5551, 1, 'location', 'province', 'change_status'),
(5552, 1, 'location', 'province', 'change_status_common'),
(5553, 1, 'location', 'district', 'index'),
(5554, 1, 'location', 'district', 'add'),
(5555, 1, 'location', 'district', 'delete'),
(5556, 1, 'location', 'district', 'edit'),
(5557, 1, 'location', 'district', 'change_status'),
(5558, 1, 'location', 'ward', 'index'),
(5559, 1, 'location', 'ward', 'add'),
(5560, 1, 'location', 'ward', 'delete'),
(5561, 1, 'location', 'ward', 'edit'),
(5562, 1, 'location', 'ward', 'change_status'),
(5563, 1, 'location', 'geonear', 'index'),
(5564, 1, 'location', 'geonear', 'add'),
(5565, 1, 'location', 'geonear', 'delete'),
(5566, 1, 'location', 'geonear', 'edit'),
(5567, 1, 'location', 'geonear', 'change_status'),
(5568, 1, 'location', 'sight', 'index'),
(5569, 1, 'location', 'sight', 'add'),
(5570, 1, 'location', 'sight', 'delete'),
(5571, 1, 'location', 'sight', 'edit'),
(5572, 1, 'location', 'sight', 'change_status'),
(5573, 1, 'location', 'beach', 'index'),
(5574, 1, 'location', 'beach', 'add'),
(5575, 1, 'location', 'beach', 'delete'),
(5576, 1, 'location', 'beach', 'edit'),
(5577, 1, 'location', 'beach', 'change_status'),
(5578, 1, 'handbook', 'handbook', 'index'),
(5579, 1, 'handbook', 'handbook', 'add'),
(5580, 1, 'handbook', 'handbook', 'delete'),
(5581, 1, 'handbook', 'handbook', 'edit'),
(5582, 1, 'handbook', 'handbook', 'change_status'),
(5583, 1, 'handbook', 'handbook_category', 'index'),
(5584, 1, 'handbook', 'handbook_category', 'add'),
(5585, 1, 'handbook', 'handbook_category', 'delete'),
(5586, 1, 'handbook', 'handbook_category', 'edit'),
(5587, 1, 'handbook', 'handbook_category', 'change_status'),
(5588, 1, 'post', 'post_category', 'index'),
(5589, 1, 'post', 'post_category', 'add'),
(5590, 1, 'post', 'post_category', 'delete'),
(5591, 1, 'post', 'post_category', 'edit'),
(5592, 1, 'post', 'post_category', 'change_status'),
(5593, 1, 'post', 'post', 'index'),
(5594, 1, 'post', 'post', 'add'),
(5595, 1, 'post', 'post', 'delete'),
(5596, 1, 'post', 'post', 'edit'),
(5597, 1, 'post', 'post', 'change_status'),
(5598, 1, 'post', 'page', 'index'),
(5599, 1, 'post', 'page', 'add'),
(5600, 1, 'post', 'page', 'delete'),
(5601, 1, 'post', 'page', 'edit'),
(5602, 1, 'post', 'page', 'change_status'),
(5603, 1, 'user', 'user', 'index'),
(5604, 1, 'user', 'user', 'add'),
(5605, 1, 'user', 'user', 'delete'),
(5606, 1, 'user', 'user', 'edit'),
(5607, 1, 'user', 'user', 'change_status'),
(5608, 1, 'display', 'display_type', 'index'),
(5609, 1, 'display', 'display_type', 'add'),
(5610, 1, 'display', 'display_type', 'delete'),
(5611, 1, 'display', 'display_type', 'edit'),
(5612, 1, 'display', 'display', 'index'),
(5613, 1, 'display', 'display', 'add'),
(5614, 1, 'display', 'display', 'delete'),
(5615, 1, 'display', 'display', 'edit'),
(5616, 1, 'display', 'display', 'change_status'),
(5617, 1, 'setting', 'foreign_currency', 'index');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `national_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`, `status`, `national_id`, `description`, `deleted`) VALUES
(1, 'Miền Bắc', 1, 2, NULL, 0),
(2, 'Miền Trung', 1, 2, NULL, 0),
(3, 'Miền Nam', 1, 2, NULL, 0),
(4, 'Thái Lan', 1, 3, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `beach`
--

CREATE TABLE IF NOT EXISTS `beach` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `national_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `beach`
--

INSERT INTO `beach` (`id`, `name`, `national_id`, `area_id`, `province_id`, `status`, `deleted`) VALUES
(12, 'Dốc Lết', 2, 3, 114, 1, 0),
(13, 'Phú Quốc', 2, 3, 117, 1, 0),
(14, 'Vũng Tàu', 2, 3, 115, 1, 0),
(15, 'Côn Đảo', 2, 3, 115, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `user` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=127 ;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `group`, `status`, `deleted`, `create_time`, `user`) VALUES
(1, 'FM22321', 2, 1, 0, '2016-05-25 20:17:12', 1),
(2, 'MK22322', 2, 1, 0, '2016-05-25 20:17:12', 1),
(3, 'PN22323', 2, 1, 0, '2016-05-25 20:17:12', 1),
(4, 'DB22324', 2, 1, 0, '2016-05-25 20:17:12', 1),
(5, 'VA22325', 2, 1, 0, '2016-05-25 20:17:12', 1),
(6, 'KH22326', 2, 1, 0, '2016-05-25 20:17:12', 1),
(7, 'YX22327', 2, 1, 0, '2016-05-25 20:17:12', 1),
(8, 'RB22328', 2, 1, 0, '2016-05-25 20:17:12', 1),
(9, 'RE22329', 2, 1, 0, '2016-05-25 20:17:12', 1),
(10, 'CS223210', 2, 1, 0, '2016-05-25 20:17:12', 1),
(11, 'GL223211', 2, 1, 0, '2016-05-25 20:17:12', 1),
(12, 'TG223312', 2, 1, 0, '2016-05-25 20:17:12', 1),
(13, 'WD223313', 2, 1, 0, '2016-05-25 20:17:13', 1),
(14, 'ST223314', 2, 1, 0, '2016-05-25 20:17:13', 1),
(15, 'VX223315', 2, 1, 0, '2016-05-25 20:17:13', 1),
(16, 'HT223316', 2, 1, 0, '2016-05-25 20:17:13', 1),
(17, 'LH223317', 2, 1, 0, '2016-05-25 20:17:13', 1),
(18, 'YU223318', 2, 1, 0, '2016-05-25 20:17:13', 1),
(19, 'JH223319', 2, 1, 0, '2016-05-25 20:17:13', 1),
(20, 'LN223420', 2, 1, 0, '2016-05-25 20:17:13', 1),
(21, 'WU223421', 2, 1, 0, '2016-05-25 20:17:14', 1),
(22, 'EY223422', 2, 1, 0, '2016-05-25 20:17:14', 1),
(23, 'FM223423', 2, 1, 0, '2016-05-25 20:17:14', 1),
(24, 'RN223424', 2, 1, 0, '2016-05-25 20:17:14', 1),
(25, 'WS223425', 2, 1, 0, '2016-05-25 20:17:14', 1),
(26, 'KF223426', 2, 1, 0, '2016-05-25 20:17:14', 1),
(27, 'KX223427', 2, 1, 0, '2016-05-25 20:17:14', 1),
(28, 'UW223428', 2, 1, 0, '2016-05-25 20:17:14', 1),
(29, 'EO223429', 2, 1, 0, '2016-05-25 20:17:14', 1),
(30, 'KD223430', 2, 1, 0, '2016-05-25 20:17:14', 1),
(31, 'XF223531', 2, 1, 0, '2016-05-25 20:17:15', 1),
(32, 'SP223532', 2, 1, 0, '2016-05-25 20:17:15', 1),
(33, 'RY223533', 2, 1, 0, '2016-05-25 20:17:15', 1),
(34, 'PS223534', 2, 1, 0, '2016-05-25 20:17:15', 1),
(35, 'IC223535', 2, 1, 0, '2016-05-25 20:17:15', 1),
(36, 'VL223536', 2, 1, 0, '2016-05-25 20:17:15', 1),
(37, 'BY223637', 2, 1, 0, '2016-05-25 20:17:16', 1),
(38, 'LM223638', 2, 1, 0, '2016-05-25 20:17:16', 1),
(39, 'HV223639', 2, 1, 0, '2016-05-25 20:17:16', 1),
(40, 'RP223740', 2, 1, 0, '2016-05-25 20:17:16', 1),
(41, 'EQ223741', 2, 1, 0, '2016-05-25 20:17:17', 1),
(42, 'YN223742', 2, 1, 0, '2016-05-25 20:17:17', 1),
(43, 'UH223743', 2, 1, 0, '2016-05-25 20:17:17', 1),
(44, 'RG223744', 2, 1, 0, '2016-05-25 20:17:17', 1),
(45, 'ZX223745', 2, 1, 0, '2016-05-25 20:17:17', 1),
(46, 'MG223746', 2, 1, 0, '2016-05-25 20:17:17', 1),
(47, 'NC223747', 2, 1, 0, '2016-05-25 20:17:17', 1),
(48, 'VL223748', 2, 1, 0, '2016-05-25 20:17:17', 1),
(49, 'PZ223749', 2, 1, 0, '2016-05-25 20:17:17', 1),
(50, 'BR223750', 2, 1, 0, '2016-05-25 20:17:17', 1),
(51, 'UX223751', 2, 1, 0, '2016-05-25 20:17:17', 1),
(52, 'FZ223752', 2, 1, 0, '2016-05-25 20:17:17', 1),
(53, 'SM223753', 2, 1, 0, '2016-05-25 20:17:17', 1),
(54, 'OM223754', 2, 1, 0, '2016-05-25 20:17:17', 1),
(55, 'KP223755', 2, 1, 0, '2016-05-25 20:17:17', 1),
(56, 'BT223756', 2, 1, 0, '2016-05-25 20:17:17', 1),
(57, 'GM223857', 2, 1, 0, '2016-05-25 20:17:17', 1),
(58, 'FN223858', 2, 1, 0, '2016-05-25 20:17:18', 1),
(59, 'LG223859', 2, 1, 0, '2016-05-25 20:17:18', 1),
(60, 'OZ223860', 2, 1, 0, '2016-05-25 20:17:18', 1),
(61, 'LI223861', 2, 1, 0, '2016-05-25 20:17:18', 1),
(62, 'JX223862', 2, 1, 0, '2016-05-25 20:17:18', 1),
(63, 'TO223863', 2, 1, 0, '2016-05-25 20:17:18', 1),
(64, 'XF223864', 2, 1, 0, '2016-05-25 20:17:18', 1),
(65, 'AH223865', 2, 1, 0, '2016-05-25 20:17:18', 1),
(66, 'WA223866', 2, 1, 0, '2016-05-25 20:17:18', 1),
(67, 'CY223867', 2, 1, 0, '2016-05-25 20:17:18', 1),
(68, 'IF223868', 2, 1, 0, '2016-05-25 20:17:18', 1),
(69, 'GY223869', 2, 1, 0, '2016-05-25 20:17:18', 1),
(70, 'ML223970', 2, 1, 0, '2016-05-25 20:17:18', 1),
(71, 'UW223971', 2, 1, 0, '2016-05-25 20:17:19', 1),
(72, 'KN223972', 2, 1, 0, '2016-05-25 20:17:19', 1),
(73, 'PE223973', 2, 1, 0, '2016-05-25 20:17:19', 1),
(74, 'PW223974', 2, 1, 0, '2016-05-25 20:17:19', 1),
(75, 'YP223975', 2, 1, 0, '2016-05-25 20:17:19', 1),
(76, 'XL223976', 2, 1, 0, '2016-05-25 20:17:19', 1),
(77, 'LU223977', 2, 1, 0, '2016-05-25 20:17:19', 1),
(78, 'XN223978', 2, 1, 0, '2016-05-25 20:17:19', 1),
(79, 'XG223979', 2, 1, 0, '2016-05-25 20:17:19', 1),
(80, 'UH223980', 2, 1, 0, '2016-05-25 20:17:19', 1),
(81, 'BM223981', 2, 1, 0, '2016-05-25 20:17:19', 1),
(82, 'TB223982', 2, 1, 0, '2016-05-25 20:17:19', 1),
(83, 'OK224083', 2, 1, 0, '2016-05-25 20:17:20', 1),
(84, 'BS224084', 2, 1, 0, '2016-05-25 20:17:20', 1),
(85, 'PZ224085', 2, 1, 0, '2016-05-25 20:17:20', 1),
(86, 'CZ224086', 2, 1, 0, '2016-05-25 20:17:20', 1),
(87, 'PO224087', 2, 1, 0, '2016-05-25 20:17:20', 1),
(88, 'QL224088', 2, 1, 0, '2016-05-25 20:17:20', 1),
(89, 'DJ224089', 2, 1, 0, '2016-05-25 20:17:20', 1),
(90, 'KI224090', 2, 1, 0, '2016-05-25 20:17:20', 1),
(91, 'HB224091', 2, 1, 0, '2016-05-25 20:17:20', 1),
(92, 'AP224092', 2, 1, 0, '2016-05-25 20:17:20', 1),
(93, 'BH224193', 2, 1, 0, '2016-05-25 20:17:21', 1),
(94, 'FR224194', 2, 1, 0, '2016-05-25 20:17:21', 1),
(95, 'EV224195', 2, 1, 0, '2016-05-25 20:17:21', 1),
(96, 'BM224196', 2, 1, 0, '2016-05-25 20:17:21', 1),
(97, 'JQ224197', 2, 1, 0, '2016-05-25 20:17:21', 1),
(98, 'YM224198', 2, 1, 0, '2016-05-25 20:17:21', 1),
(99, 'HV224199', 2, 1, 0, '2016-05-25 20:17:21', 1),
(100, 'EG2241100', 2, 1, 0, '2016-05-25 20:17:21', 1),
(101, 'SA2810101', 2, 1, 0, '2016-06-06 14:56:50', 1),
(102, 'SA2810102', 2, 1, 0, '2016-06-06 14:56:50', 1),
(103, 'IN2810103', 2, 1, 0, '2016-06-06 14:56:50', 1),
(104, 'BV2810104', 2, 1, 0, '2016-06-06 14:56:50', 1),
(105, 'FE2810105', 2, 1, 0, '2016-06-06 14:56:50', 1),
(106, 'IU2414106', 2, 1, 0, '2016-06-13 16:16:54', 1),
(107, 'HY2414107', 2, 1, 0, '2016-06-13 16:16:54', 1),
(108, 'KO2414108', 2, 1, 0, '2016-06-13 16:16:54', 1),
(109, 'CO2414109', 2, 1, 0, '2016-06-13 16:16:54', 1),
(110, 'NC2414110', 2, 1, 0, '2016-06-13 16:16:54', 1),
(111, 'DI2924111', 2, 1, 0, '2016-06-13 16:42:04', 1),
(112, 'ZR2924112', 2, 1, 0, '2016-06-13 16:42:04', 1),
(113, 'VL2924113', 2, 1, 0, '2016-06-13 16:42:04', 1),
(114, 'JP2924114', 2, 1, 0, '2016-06-13 16:42:04', 1),
(115, 'BS2924115', 2, 1, 0, '2016-06-13 16:42:04', 1),
(116, 'QC2924116', 2, 1, 0, '2016-06-13 16:42:04', 1),
(117, 'ET3057117', 3, 1, 0, '2016-06-13 16:44:17', 1),
(118, 'DO3057118', 3, 1, 0, '2016-06-13 16:44:17', 1),
(119, 'XN3057119', 3, 1, 0, '2016-06-13 16:44:17', 1),
(120, 'WE3057120', 3, 1, 0, '2016-06-13 16:44:17', 1),
(121, 'QT3057121', 3, 1, 0, '2016-06-13 16:44:17', 1),
(122, 'PR4726122', 4, 1, 0, '2016-06-24 11:48:46', 1),
(123, 'VT4726123', 4, 1, 0, '2016-06-24 11:48:46', 1),
(124, 'RO4726124', 4, 1, 0, '2016-06-24 11:48:46', 1),
(125, 'GC4726125', 4, 1, 0, '2016-06-24 11:48:46', 1),
(126, 'WO4726126', 4, 1, 0, '2016-06-24 11:48:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_group`
--

CREATE TABLE IF NOT EXISTS `coupon_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `use_date_from` date DEFAULT NULL,
  `use_date_to` date DEFAULT NULL,
  `order_date_from` date DEFAULT NULL,
  `order_date_to` date DEFAULT NULL,
  `night` int(11) DEFAULT NULL,
  `use_time` int(11) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `discount_max_price` int(11) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `hotel` text,
  `deleted` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `coupon_group`
--

INSERT INTO `coupon_group` (`id`, `name`, `use_date_from`, `use_date_to`, `order_date_from`, `order_date_to`, `night`, `use_time`, `discount`, `discount_max_price`, `area`, `hotel`, `deleted`, `status`) VALUES
(2, 'Nhóm giảm giá 1', '2016-05-03', '2016-08-31', '2016-05-03', '2016-09-30', 0, 1, 15, 200000, ',1,2,3,', '', 0, 1),
(3, 'KM 2', '2016-06-13', '2016-06-30', '2016-06-13', '2016-06-30', 0, 1, 15, 200000, ',1,2,3,', '', 1, 1),
(4, 'KM 3', '2016-06-24', '2016-06-30', '2016-06-24', '2016-06-30', 1, 5, 20, 200000, ',1,2,3,', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `display`
--

CREATE TABLE IF NOT EXISTS `display` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `display`
--

INSERT INTO `display` (`id`, `name`, `url`, `content`, `picture`, `status`, `type_id`, `deleted`) VALUES
(1, 'Đà Lạt mộng mơ', 'http://azy.vn', '', '1443251559_index_03.jpg', 1, 1, 0),
(2, 'Đà Lạt mộng mơ', 'http://azy.vn', '', '1443251613_index_03.jpg', 1, 1, 0),
(3, 'Banner 1', '', '', '1444640623_banner_slide_1.jpg', 1, 2, 0),
(4, 'Banner 2', '', '', '1444640638_banner_slide_2.jpg', 1, 2, 0),
(5, 'Banner 1', '', '', '1444644222_banner-handbook.jpg', 1, 3, 0),
(6, 'Banner 2', '', '', '1444644376_banner-handbook.jpg', 1, 3, 0),
(7, 'Banner 1', '', '', '1457588179_slide_02.jpg', 1, 4, 0),
(8, 'Banner 2', '', '', '1457588203_slide_03.jpg', 1, 4, 0),
(9, 'Banner 3', '', '', '1457588252_slide_04.jpg', 1, 4, 0),
(10, 'Cẩm Tú, Hồ Chính Minh', '', '<p>Phong cảnh rất đẹp, rộng r&atilde;i, tho&aacute;ng m&aacute;t. Gi&aacute; cả hợp l&yacute; với chất lượng, m&oacute;n ăn ở đ&acirc;y kh&ocirc;ng nhiều lựa chọn nhưng ăn cũng ngon.</p>\r\n<p>Nh&acirc;n vi&ecirc;n phục vụ nhiệt t&igrave;nh, t&ocirc;i rất h&agrave;i l&ograve;ng.</p>', '1463314518_IMG_0798.JPG', 1, 5, 0),
(11, 'Anh Tuấn, Hồ Chính Minh', '', '<p>Phong cảnh rất đẹp, rộng r&atilde;i, tho&aacute;ng m&aacute;t. Gi&aacute; cả hợp l&yacute; với chất lượng, m&oacute;n ăn ở đ&acirc;y kh&ocirc;ng nhiều lựa chọn nhưng ăn cũng ngon.</p>\r\n<p>Nh&acirc;n vi&ecirc;n phục vụ nhiệt t&igrave;nh, t&ocirc;i rất h&agrave;i l&ograve;ng</p>', '1463314688_P3310011.JPG', 1, 5, 0),
(12, 'Title', '', '<p>Đặt Ph&ograve;ng Kh&aacute;ch Sạn, Hotel Trực Tuyến | Idtour.vn</p>', '1492661587_02_khach_san_imperial_vung_tau.jpg', 1, 6, 0),
(13, 'Keyword', NULL, 'idtour', NULL, 1, 6, 0),
(14, 'Description', NULL, 'idtour', NULL, 1, 6, 0),
(15, 'Khách Sạn Palm Hồng Hà', 'http://idtour.vn/tour.html', '<p>Tour du lịch gi&aacute; rẻ tốt nhất thị trường</p>', '1493376417_du-lich-binh-dinh.jpg', 1, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `display_type`
--

CREATE TABLE IF NOT EXISTS `display_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `display_type`
--

INSERT INTO `display_type` (`id`, `name`) VALUES
(1, 'Quảng cáo trang chủ'),
(2, 'Banner trang chủ'),
(3, 'Banner trang cẩm nang'),
(4, 'Banner trang tour'),
(5, 'Cảm nhận khách hàng trang chủ'),
(6, 'Title - Keyword - Description');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `national_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`, `national_id`, `area_id`, `province_id`, `status`, `type`, `description`, `deleted`) VALUES
(2, 'Quận Phú Nhuận', 2, 3, 98, 1, 'Quận', NULL, 0),
(3, 'Quận 1', 2, 3, 98, 1, 'Quận', NULL, 0),
(4, 'Quận 2', 2, 3, 98, 1, 'Quận', NULL, 0),
(5, 'Quận 3', 2, 3, 98, 1, 'Quận', NULL, 0),
(6, 'Quận 4', 2, 3, 98, 1, 'Quận', NULL, 0),
(7, 'Quận 5', 2, 3, 98, 1, 'Quận', NULL, 0),
(8, 'Quận 6', 2, 3, 98, 1, 'Quận', NULL, 0),
(9, 'Quận 7', 2, 3, 98, 1, 'Quận', NULL, 0),
(10, 'Quận Tân Bình', 2, 3, 98, 1, 'Quận', NULL, 0),
(11, 'Quận Bình Thạnh', 2, 3, 98, 1, 'Quận', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_customer`
--

CREATE TABLE IF NOT EXISTS `email_customer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `geonear`
--

CREATE TABLE IF NOT EXISTS `geonear` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `national_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `district_id` bigint(20) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `geonear`
--

INSERT INTO `geonear` (`id`, `name`, `national_id`, `area_id`, `province_id`, `status`, `description`, `district_id`, `deleted`) VALUES
(11, 'Cầu Calmette', 2, 3, 98, 1, '<p><span >Cầu Calmette bắc qua kênh Bến Nghé, hướng đi từ Quận 1 sang Quận 4, thành phố Hồ Chí Minh, góp phần cho giao thông được thông thoáng hơn. Gần cầu Calmette có các địa danh: chợ Bến Thành, cảng Nhà Rồng. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn cầu Calmette ngay bây giờ với giá rẻ nhất.</span></p>', 2, 0),
(12, 'Công Viên 23/9', 2, 3, 98, 1, '<p><span >Công viên 23/9 nằm trên địa bàn Quận 1, thành phố Hồ Chí Minh, là một điểm sinh hạt công cộng có từ lâu của thành phố. Gần công viên 23/9 có các địa danh: chợ Bến Thành, cảng Nhà Rồng, hồ Con Rùa. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn công viên 23/9 ngay bây giờ với giá rẻ nhất.</span></p>', 3, 0),
(13, 'Quận 1 - Phạm Ngũ Lão/Tây Ba Lô', 2, 3, 98, 1, '<p><span >Phường Phạm Ngũ Lão là một phường thuộc quận 1, thành phố Hồ Chí Minh. Quận 1 là quận trung tâm của thành phố Hồ Chí Minh. Phường Phạm Ngũ Lão là nơi sầm uất và thường được biết đến như khu phố Tây. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Quận 1 - Phạm Ngũ Lão ngay bây giờ với giá rẻ nhất.</span></p>', 4, 0),
(14, 'Trung Tâm Thương Mại Saigon Square', 2, 3, 98, 1, '<p><span >Trung tâm Thương mại Saigon Square tọa lạc ở hai địa điểm thuận lợi ngay khu trung tâm Quận 1. Gần Trung tâm Thương mại Saigon Square có các địa danh: chợ Bến Thành, hồ Con Rùa. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng có đưa đón khách sạn/sân bay Trung tâm Thương mại Saigon Square ngay bây giờ với giá rẻ nhất.</span></p>', 5, 0),
(15, 'Công Viên Tao Đàn', 2, 3, 98, 1, '<p><span >Công viên Tao Đàn là một trong những công viên tuyệt nhất Sài thành với không gian mở cùng sân chơi cho trẻ em và những khu vườn tuyệt đẹp. Gần công viên Tao Đàn có các địa danh: chợ Bến Thành, hồ Con Rùa. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn công viên Tao Đàn ngay bây giờ với giá rẻ nhất.</span></p>', 6, 0),
(16, 'Quận 5 - Khu Phố Tàu/Chợ Lớn', 2, 3, 98, 1, '<p><span >Chợ Lớn là cả một khu vực rất rộng tại thành phố Hồ Chí Minh. Khi nghe đến tên Chợ Lớn mọi người sẽ nghĩ tới hình ảnh các xưởng sản xuất thủ công nghiệp, tiệm ăn mang phong vị Trung Hoa. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng có đưa đón khách sạn/sân bay Quận 5 - Khu Phố Tàu/Chợ Lớn ngay bây giờ với giá rẻ nhất.</span></p>', 7, 0),
(17, 'Tòa Nhà Bitexco', 2, 3, 98, 1, '<p><span >Tòa nhà Bitexco là một tòa nhà chọc trời được xây dựng tại trung tâm Quận 1, Thành phố Hồ Chí Minh do Bitexco làm chủ đầu tư. Gần tòa nhà Bitexco có các địa danh: hồ Con Rùa, chợ Bến Thành, công viên Tao Đàn. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn tòa nhà Bitexco ngay bây giờ với giá rẻ nhất.</span></p>', 8, 0),
(18, 'Quận 4 - Bến Nhà Rồng/Cảng Sài Gòn', 2, 3, 98, 1, '<p><span >Bến Nhà Rồng khởi đầu là thương cảng trên sông Sài Gòn khu vực gần cầu Khánh Hội, nay thuộc quận 4. Tại nơi đây, Nguyễn Tất Thành đã xuống con tàu Amiral Latouche Tréville đi tìm đường cứu nước. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng có đưa đón khách sạn/sân bay Quận 4 - Bến Nhà Rồng/Cảng Sài Gòn ngay bây giờ với giá rẻ nhất.</span></p>', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `handbook`
--

CREATE TABLE IF NOT EXISTS `handbook` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `national_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `beach_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `tag_id` text COLLATE utf8_unicode_ci,
  `view` bigint(20) NOT NULL,
  `keyword` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `handbook`
--

INSERT INTO `handbook` (`id`, `category_id`, `name`, `status`, `create_time`, `user_id`, `update_time`, `description`, `content`, `picture`, `national_id`, `area_id`, `province_id`, `beach_id`, `deleted`, `tag_id`, `view`, `keyword`) VALUES
(1, ',41,', 'Lạc lối Côn Đảo những ngày thơ', 1, '2015-09-21 22:05:29', 1, '2017-04-20 22:14:05', 'Có những lúc trong đời, chợt thấy chán ngán cái ồn ã của thị thành. Dường như nơi chốn ấy chẳng còn là vùng đất hứa như ta vẫn hằng mong, chỉ thấy người rã rời sau những bon chen vật lộn với đời. Cần lắm một nơi để thả hồn thư thái, để ngụp lặn trong những', '<p style="text-align: center;">Nh&igrave;n tr&ecirc;n bản đồ địa l&yacute; Việt Nam, C&ocirc;n Đảo l&agrave; một quần đảo nằm ở ph&iacute;a Đ&ocirc;ng Nam, thuộc địa phận tỉnh B&agrave; Rịa &ndash; Vũng T&agrave;u v&agrave; nằm c&aacute;ch th&agrave;nh phố Hồ Ch&iacute; Minh khoảng 230km. C&ocirc;n Đảo c&oacute; diện t&iacute;ch l&ecirc;n tới 76km2 gồm 16 h&ograve;n đảo lớn nhỏ hợp th&agrave;nh.</p>\n<p style="text-align: center;"><img src="/tour_nhan/public/pictures/handbooks/2015_09_21/7-du-lich-bien-con-dao-mytour-1.jpg" alt="" width="700" height="409" /></p>', '1444790475_7-du-lich-bien-con-dao-mytour-1.jpg', 2, 3, 115, 15, 0, ',22,23,', 27, ''),
(2, ',41,', 'Trận địa pháo cổ lớn nhất Đông Dương', 1, '2015-09-21 22:19:39', 1, '2017-04-20 22:16:22', 'Từ những năm cuối thế kỷ 19, người Pháp đã rất quan tâm đến việc phòng thủ bảo vệ Vũng Tàu - vùng đất vừa là pháo đài hướng biển, cửa ngõ chiển lược của khu vực Đông Nam Bộ, vừa là nơi nghỉ mát và dưỡng bệnh hàng đầu của người Pháp tại Đông Dương.', '<p>Từ những năm cuối thế kỷ 19, người Ph&aacute;p đ&atilde; rất quan t&acirc;m đến việc ph&ograve;ng thủ bảo vệ Vũng T&agrave;u - v&ugrave;ng đất vừa l&agrave; ph&aacute;o đ&agrave;i hướng biển, cửa ng&otilde; chiển lược của khu vực Đ&ocirc;ng Nam Bộ, vừa l&agrave; nơi nghỉ m&aacute;t v&agrave; dưỡng bệnh h&agrave;ng đầu của người Ph&aacute;p tại Đ&ocirc;ng Dương. Với vai tr&ograve; chiến lược của Vũng T&agrave;u đối với to&agrave;n khu vực Đ&ocirc;ng Nam Bộ hay n&oacute;i rộng hơn l&agrave; to&agrave;n bộ khu vực miền Nam Đ&ocirc;ng Dương, người Ph&aacute;p đ&atilde; biến nơi đ&acirc;y th&agrave;nh một cứ địa ph&ograve;ng thủ mạnh mẽ v&agrave; ki&ecirc;n cố với h&agrave;ng loạt c&aacute;c c&ocirc;ng tr&igrave;nh qu&acirc;n sự lớn, trong đ&oacute; phải kể đến nhất đ&oacute; ch&iacute;nh l&agrave; trận địa ph&aacute;o hướng biển ở Vũng T&agrave;u &ndash; c&ocirc;ng tr&igrave;nh được xem như l&agrave; điểm mấu chốt của chiến lược biến Vũng T&agrave;u th&agrave;nh một cứ địa bất khả chiến bại của người Ph&aacute;p tại Đ&ocirc;ng Dương.</p>\n<p style="text-align: center;"><img src="/tour_nhan/public/pictures/handbooks/2015_09_21/9-du-lich-vung-tau-tran-phao-co-mytour-1.jpg" alt="" width="700" height="467" /></p>', '1444790494_7-du-lich-bien-con-dao-mytour-1.jpg', 2, 3, 114, 0, 0, ',21,', 20, ''),
(12, ',41,', 'Du lich Nha Trang', 1, '2015-10-13 16:56:14', 1, '2015-10-14 11:10:28', 'Du lịch Nha Trang từ lâu đã nổi tiếng với nhiều điểm tham quan thú vị như các đảo với bãi tắm đẹp, hoang sơ, tháp chàm cổ kính và ẩm thực đặc trưng vùng miền biển', '<p>Toạ lạc tr&ecirc;n đảo H&ograve;n Tre với những b&atilde;i biển trong xanh quanh năm, Vinpearl Land được biết đến như &ldquo;thi&ecirc;n đường của miền nhiệt đới&rdquo;. Ngo&agrave;i những kh&aacute;ch sạn sang trọng, những khu vườn tuyệt đẹp, hồ bơi nước ngọt l&yacute; tưởng, nơi n&agrave;y c&ograve;n thu h&uacute;t du kh&aacute;ch với khu tr&ograve; chơi cảm gi&aacute;c mạnh v&agrave; những rạp chiếu phim 4D ho&agrave;nh tr&aacute;ng. V&eacute; tham quan đảo bao gồm v&eacute; c&aacute;p treo v&agrave; chơi tr&ograve; chơi: 450.000VND/người lớn; 350.000VND/trẻ em (1,0m &ndash; 1,4m).</p>\r\n<p style="text-align: center;"><img src="/tour_nhan/public/pictures/handbooks/2015_10_13/Vinpeal-Land.jpg" alt="" width="540" height="305" /></p>\r\n<p>&nbsp;</p>\r\n<p>H&ograve;n Mun c&oacute; l&agrave;n nước trong veo v&agrave; hệ sinh th&aacute;i san h&ocirc; đẹp lộng lẫy, đ&atilde; được Quỹ &ETH;ộng vật hoang d&atilde; thế giới (WWF) đ&aacute;nh gi&aacute; l&agrave; khu vực đa dạng sinh học biển bậc nhất ở Việt Nam. Đến H&ograve;n Mun, du kh&aacute;ch kh&ocirc;ng thể bỏ qua những hoạt động như: Bar nổi tr&ecirc;n biển, lặn biển kh&aacute;m ph&aacute; san h&ocirc;, thuyền đ&aacute;y k&iacute;nh&hellip;</p>', '1444790487_7-du-lich-bien-con-dao-mytour-1.jpg', 2, 3, 114, 12, 0, ',20,19,', 11, ''),
(13, ',41,', 'Du lịch Đà Nẵng', 1, '2015-10-13 16:58:38', 1, '2017-04-20 21:48:34', 'Du lịch Đà Nẵng với cẩm nang đầy đủ và súc tích nhất từ iVIVU. Cẩm nang du lịch Đà Nẵng giới thiệu các điểm đến thú vị và món ăn ngon khi ở thành phố miền Trung này.', '<p>Đ&agrave; Nẵng l&agrave; một trong 20 th&agrave;nh phố sạch nhất thế giới. Nằm ở v&ugrave;ng Nam Trung Bộ, Đ&agrave; Nẵng c&oacute; cả n&uacute;i, đồng bằng v&agrave; biển. C&aacute;c điểm tham quan du lịch nổi tiếng khi <strong>du lịch Đ&agrave; Nẵng</strong> bao gồm khu du lịch B&agrave; N&agrave;, b&atilde;i biển Mỹ Kh&ecirc;, v&agrave; khu vui chơi giải tr&iacute; trong nh&agrave; Fantasy Park lớn nhất ch&acirc;u &Aacute;. Đ&agrave; Nẵng c&ograve;n c&oacute; nhiều thắng cảnh m&ecirc; hồn như đ&egrave;o Hải V&acirc;n, rừng nguy&ecirc;n sinh ở b&aacute;n đảo Sơn Tr&agrave; v&agrave; Ngũ H&agrave;nh Sơn. Đặc biệt, Đ&agrave; Nẵng được bao quanh bởi 3 di sản văn h&oacute;a thế giới l&agrave; Huế, Hội An v&agrave; Mỹ Sơn, v&agrave; xa hơn ch&uacute;t nữa l&agrave; Vườn Quốc Gia Phong Nha &ndash; Kẻ B&agrave;ng. H&agrave;ng năm Đ&agrave; Nẵng tổ chức Lễ hội ph&aacute;o hoa thu h&uacute;t rất nhiều du kh&aacute;ch mu&ocirc;n phương đến tham dự.</p>\n<p style="text-align: center;"><img src="/public/pictures/handbooks/2017_04_20/H%E1%BB%99i%20Th%E1%BA%A3o%20Du%20L%E1%BB%8Bch%20%C4%90%C3%A0%20N%E1%BA%B5ng.jpg" alt="" width="800" height="600" /></p>', '1444790482_7-du-lich-bien-con-dao-mytour-1.jpg', 2, 3, 114, 12, 0, ',18,19,', 16, '');

-- --------------------------------------------------------

--
-- Table structure for table `handbook_category`
--

CREATE TABLE IF NOT EXISTS `handbook_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `parent` int(11) NOT NULL,
  `description` text,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `handbook_category`
--

INSERT INTO `handbook_category` (`id`, `name`, `status`, `parent`, `description`, `deleted`) VALUES
(41, 'Cẩm Nang Du Lịch', 1, 0, '', 0),
(42, 'Du Lịch Phú Quốc', 1, 41, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `handbook_tag`
--

CREATE TABLE IF NOT EXISTS `handbook_tag` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `handbook_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `handbook_tag`
--

INSERT INTO `handbook_tag` (`id`, `handbook_id`, `name`) VALUES
(18, 13, 'Đà Nẵng'),
(19, 13, 'Du lịch'),
(20, 12, 'Nha Trang'),
(21, 2, 'Vũng Tàu'),
(22, 1, 'Côn Đảo'),
(23, 1, 'Phan Thiết');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE IF NOT EXISTS `holiday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `name`, `date`) VALUES
(1, 'Ngày giải phóng miền Nam', '30/04'),
(2, 'Ngày quốc tế lao động', '01/05');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` float(1,0) DEFAULT NULL,
  `national_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `ward_id` int(11) DEFAULT NULL,
  `geonear_id` int(11) DEFAULT NULL,
  `facilities_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `policy` text COLLATE utf8_unicode_ci,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zoom` int(11) DEFAULT NULL,
  `partner_id` bigint(20) DEFAULT NULL,
  `view` bigint(20) DEFAULT NULL,
  `sight_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `member_promotion` int(11) NOT NULL,
  `member_promotion_discount` float DEFAULT NULL,
  `keyword` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `status`, `national_id`, `area_id`, `province_id`, `district_id`, `ward_id`, `geonear_id`, `facilities_id`, `type_id`, `address`, `description`, `policy`, `picture`, `star`, `user_id`, `create_time`, `update_time`, `update_by`, `lat`, `lng`, `zoom`, `partner_id`, `view`, `sight_id`, `deleted`, `member_promotion`, `member_promotion_discount`, `keyword`) VALUES
(1, 'KHÁCH SẠN EASTIN GRAND SÀI GÒN', 1, 2, 3, 98, 2, 2, 11, ',1,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,', 1, '253 Nguyễn Văn Trỗi, Phú Nhuận, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451113159_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5, 2, '2015-12-26 14:02:20', '2015-12-26 14:41:38', 'product_hotel', '10.805984719874317', '106.65034899592285', 14, 1, NULL, 6, 0, 0, 0, ''),
(2, 'KHÁCH SẠN NIKKO SÀI GÒN', 1, 2, 3, 98, 2, 3, 11, ',1,3,6,7,10,11,14,15,18,19,22,23,', 1, '235 Nguyễn Văn Cừ, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451113819_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3, 2, '2015-12-26 14:11:09', '2015-12-26 14:42:06', 'product_hotel', '10.814078246957406', '106.63695940852051', 14, 2, NULL, 6, 0, 0, 0, ''),
(3, 'KHÁCH SẠN PHỤNG HOÀNG GOLD PALACE', 1, 2, 3, 98, 2, 2, 11, ',1,4,5,6,8,9,10,12,14,16,17,18,19,21,22,23,', 1, '97 Bùi Viện, Phường Phạm Ngũ Lão, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451114035_izp1392178615_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4, 2, '2015-12-26 14:14:41', '2015-12-26 14:42:29', 'product_hotel', '10.826218128075105', '106.66185030817871', 14, 3, NULL, 6, 0, 0, 0, ''),
(4, 'KHÁCH SẠN PHOENIX SÀI GÒN', 1, 2, 3, 98, 2, 3, 11, ',1,4,6,8,10,12,13,14,15,17,19,21,', 1, '74 Bùi Viện, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451114239_msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, 2, '2015-12-26 14:17:58', '2015-12-26 14:43:00', 'product_hotel', '10.811970578636307', '106.68270716547852', 14, 4, NULL, 6, 0, 0, 0, ''),
(5, 'KHÁCH SẠN CITY STAR', 1, 2, 3, 98, 2, 3, 11, ',1,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,', 1, '13 Bùi Thị Xuân, Phường Bến Thành, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451114467_vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3, 2, '2015-12-26 14:21:54', '2015-12-26 14:43:26', 'product_hotel', '10.825880915794508', '106.64416918635254', 14, 5, NULL, 6, 0, 1, 10, '');
INSERT INTO `hotel` (`id`, `name`, `status`, `national_id`, `area_id`, `province_id`, `district_id`, `ward_id`, `geonear_id`, `facilities_id`, `type_id`, `address`, `description`, `policy`, `picture`, `star`, `user_id`, `create_time`, `update_time`, `update_by`, `lat`, `lng`, `zoom`, `partner_id`, `view`, `sight_id`, `deleted`, `member_promotion`, `member_promotion_discount`, `keyword`) VALUES
(6, 'KHÁCH SẠN GOLDEN PALM', 1, 2, 3, 98, 2, 3, 11, ',1,3,4,6,7,8,10,11,12,14,15,18,19,22,23,', 1, '33 Bạch Đằng, Phường 2, Tân Bình, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451114670_kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5, 2, '2015-12-26 14:25:11', '2015-12-26 14:43:40', 'product_hotel', '10.797047863556427', '106.65318140864258', 14, 6, NULL, 6, 0, 0, 0, ''),
(7, 'KHÁCH SẠN NGUYỆT VÂN', 1, 2, 3, 98, 2, 3, 11, ',1,5,6,7,9,11,12,13,14,15,16,20,24,', 1, '59/10 Hồ Hảo Hớn, Phường Cô Giang, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451114883_ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, 2, '2015-12-26 14:28:41', '2015-12-26 14:44:05', 'product_hotel', '10.814162553382223', '106.62803301691895', 14, 7, NULL, 6, 0, 0, 0, ''),
(8, 'KHÁCH SẠN ARIES BẾN THÀNH', 1, 2, 3, 98, 2, 2, 11, ',1,3,4,6,7,8,10,12,14,15,16,18,19,20,23,', 1, '7/9 Nguyễn Trãi, Phường Bến Thành, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451115130_erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, 2, '2015-12-26 14:32:54', '2015-12-26 14:44:23', 'product_hotel', '10.797890974569109', '106.64923319697266', 14, 8, NULL, 6, 0, 1, 15, ''),
(9, 'KHÁCH SẠN PALACE SAIGON', 1, 2, 3, 98, 2, 2, 11, ',3,4,8,10,11,12,13,14,15,16,17,18,20,21,22,23,24,', 1, '56 - 66 Nguyễn Huệ, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451115356_qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1, 2, '2015-12-26 14:36:38', '2015-12-26 14:44:27', 'product_hotel', '10.818462149623674', '106.64597163081055', 14, 9, NULL, 6, 0, 0, 0, ''),
(10, 'KHÁCH SẠN PALM - HỒNG HÀ', 1, 2, 3, 98, 2, 2, 11, ',1,3,4,6,7,8,10,12,13,14,15,16,17,18,19,21,22,23,24,', 1, '45/5 Đường Hồng Hà, Tân Bình, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Palm Hồng H&agrave;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;"> c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\n</dl>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451115523_msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5, 2, '2015-12-26 14:39:22', '2017-05-02 17:09:30', 'admin', '10.800504603670573', '106.62631640314942', 14, 10, NULL, 6, 0, 1, 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_comment`
--

CREATE TABLE IF NOT EXISTS `hotel_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci,
  `user_id` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `hotel_id` bigint(20) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `evaluation` float DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `hotel_comment`
--

INSERT INTO `hotel_comment` (`id`, `content`, `user_id`, `status`, `hotel_id`, `create_time`, `evaluation`, `deleted`) VALUES
(1, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-26 14:51:39', 8, 0),
(2, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-26 14:52:35', 7, 0),
(7, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-26 16:31:06', 8, 0),
(8, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-26 16:36:29', 8, 0),
(9, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-26 16:37:37', 8, 0),
(10, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-26 16:38:37', 8, 0),
(11, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-27 15:10:40', 8, 0),
(12, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-27 15:11:55', 0, 0),
(13, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-27 15:20:37', 5, 0),
(14, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-27 15:20:49', 9, 0),
(15, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-27 15:21:45', 9, 0),
(16, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-27 15:22:44', 6, 0),
(17, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 1, '2015-12-27 15:22:50', 6, 0),
(18, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 2, '2015-12-27 15:26:09', 6, 0),
(19, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 2, '2015-12-27 15:26:09', 6, 0),
(20, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 3, '2015-12-27 15:26:17', 8, 0),
(21, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 4, '2015-12-27 15:26:22', 8, 0),
(22, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 5, '2015-12-27 15:26:29', 7, 0),
(23, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 6, '2015-12-27 15:26:34', 10, 0),
(24, 'Phong cảnh rất đẹp, rộng rãi, thoải mái. Giá cả hợp lý với chất lượng, món ăn ở đây không nhiều lựa chọn nhưng ăn cũng ngon. Nhân viên phục vụ nhiệt tình, tôi rất hài lòng', 1, 1, 7, '2015-12-27 15:26:40', 4, 0),
(25, 'Khách sạn này rất tốt', 1, 1, 4, '2015-12-27 15:37:17', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_facilities`
--

CREATE TABLE IF NOT EXISTS `hotel_facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `hotel_facilities`
--

INSERT INTO `hotel_facilities` (`id`, `name`, `status`, `picture`, `deleted`) VALUES
(1, 'Đưa đón khách sạn/sân bay', 1, '1443499365_xeduaruoc.png', 0),
(3, 'Bể bơi ngoài trời', 1, '1443499339_beboi.png', 0),
(4, 'Wifi miễn phí', 1, '1443499332_wifi.png', 0),
(5, 'Thêm giường phụ', 1, NULL, 0),
(6, 'Spa', 1, '1443499305_spa.png', 0),
(7, 'Thang máy', 1, '1443499299_thangmay.png', 0),
(8, 'Bãi đỗ xe', 1, '1443499293_baidauxe.png', 0),
(9, 'Nhà hàng', 1, '1443499279_nhahang.png', 0),
(10, 'Giặt là', 1, NULL, 0),
(11, 'Phòng họp', 1, '1443499247_phonghop.png', 0),
(12, 'Phòng tập thể thao', 1, '1443499242_taptheduc.png', 0),
(13, 'Cửa hàng lưu niệm', 1, '1443499229_cuahangluuniem.png', 0),
(14, 'Quán café', 1, '1443499222_quancaffe.png', 0),
(15, 'Đổi tiền', 1, NULL, 0),
(16, 'Hỗ trợ đặt tour', 1, '1443499205_hotrodattour.png', 0),
(17, 'Tắm nước nóng', 1, '1443499198_tamnonglanh.png', 0),
(18, 'Truyền hình cáp/vệ tinh', 1, '1443499185_thcap.png', 0),
(19, 'Tiếp tân 24/24', 1, NULL, 0),
(20, 'Vé tàu xe, máy bay', 1, NULL, 0),
(21, 'Trông trẻ', 1, '1443499151_trongtre.png', 0),
(22, 'Karaoke', 1, NULL, 0),
(23, 'Thuê xe, taxi', 1, '1443499123_taxi.png', 0),
(24, 'Bữa sáng miễn phí', 1, '1443499108_buasang.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_image`
--

CREATE TABLE IF NOT EXISTS `hotel_image` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hotel_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=151 ;

--
-- Dumping data for table `hotel_image`
--

INSERT INTO `hotel_image` (`id`, `name`, `hotel_id`) VALUES
(1, '1451113332vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(2, '1451113332xet1392178528_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(3, '1451113332ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(4, '1451113327qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(5, '1451113327rfw1392178481_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(6, '1451113327ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(7, '1451113327ukg1392178502_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(8, '1451113322kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(9, '1451113322lrw1392178578_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(10, '1451113322medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(11, '1451113322msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(12, '1451113318hab1392178597_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(13, '1451113318ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(14, '1451113318izp1392178615_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(15, '1451113315erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1),
(16, '1451113866qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(17, '1451113866rfw1392178481_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(18, '1451113866ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(19, '1451113866ukg1392178502_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(20, '1451113866vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(21, '1451113866xet1392178528_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(22, '1451113866ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(23, '1451113860erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(24, '1451113860hab1392178597_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(25, '1451113860ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(26, '1451113860izp1392178615_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(27, '1451113860kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(28, '1451113860lrw1392178578_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(29, '1451113860medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(30, '1451113860msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2),
(31, '1451114078qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(32, '1451114078rfw1392178481_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(33, '1451114078ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(34, '1451114078ukg1392178502_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(35, '1451114078vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(36, '1451114078xet1392178528_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(37, '1451114079ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(38, '1451114073erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(39, '1451114073hab1392178597_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(40, '1451114073ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(41, '1451114073izp1392178615_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(42, '1451114073kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(43, '1451114073lrw1392178578_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(44, '1451114073medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(45, '1451114073msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3),
(46, '1451114276qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(47, '1451114276rfw1392178481_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(48, '1451114276ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(49, '1451114276ukg1392178502_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(50, '1451114276vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(51, '1451114276xet1392178528_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(52, '1451114276ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(53, '1451114271erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(54, '1451114271hab1392178597_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(55, '1451114271ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(56, '1451114271izp1392178615_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(57, '1451114271kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(58, '1451114271lrw1392178578_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(59, '1451114271medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(60, '1451114271msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4),
(61, '1451114511qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(62, '1451114511rfw1392178481_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(63, '1451114511ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(64, '1451114512ukg1392178502_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(65, '1451114512vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(66, '1451114512xet1392178528_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(67, '1451114512ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(68, '1451114507erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(69, '1451114507hab1392178597_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(70, '1451114507ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(71, '1451114507izp1392178615_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(72, '1451114507kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(73, '1451114507lrw1392178578_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(74, '1451114507medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(75, '1451114507msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5),
(76, '1451114709qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(77, '1451114709rfw1392178481_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(78, '1451114709ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(79, '1451114709ukg1392178502_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(80, '1451114709vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(81, '1451114709xet1392178528_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(82, '1451114709ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(83, '1451114703erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(84, '1451114703hab1392178597_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(85, '1451114703ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(86, '1451114703izp1392178615_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(87, '1451114703kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(88, '1451114704lrw1392178578_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(89, '1451114704medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(90, '1451114704msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 6),
(91, '1451114918qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(92, '1451114919rfw1392178481_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(93, '1451114919ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(94, '1451114919ukg1392178502_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(95, '1451114919vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(96, '1451114919xet1392178528_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(97, '1451114919ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(98, '1451114913erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(99, '1451114914hab1392178597_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(100, '1451114914ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(101, '1451114914izp1392178615_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(102, '1451114914kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(103, '1451114914lrw1392178578_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(104, '1451114914medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(105, '1451114914msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 7),
(106, '1451115171qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(107, '1451115171rfw1392178481_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(108, '1451115171ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(109, '1451115172ukg1392178502_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(110, '1451115172vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(111, '1451115172xet1392178528_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(112, '1451115172ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(113, '1451115166erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(114, '1451115166hab1392178597_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(115, '1451115166ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(116, '1451115166izp1392178615_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(117, '1451115166kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(118, '1451115166lrw1392178578_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(119, '1451115166medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(120, '1451115166msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 8),
(121, '1451115395qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(122, '1451115395rfw1392178481_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(123, '1451115395ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(124, '1451115395ukg1392178502_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(125, '1451115395vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(126, '1451115395xet1392178528_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(127, '1451115395ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(128, '1451115390erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(129, '1451115390hab1392178597_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(130, '1451115390ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(131, '1451115390izp1392178615_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(132, '1451115390kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(133, '1451115390lrw1392178578_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(134, '1451115390medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(135, '1451115390msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 9),
(136, '1451115560qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(137, '1451115560rfw1392178481_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(138, '1451115560ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(139, '1451115560ukg1392178502_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(140, '1451115560vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(141, '1451115560xet1392178528_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(142, '1451115560ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(143, '1451115556erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(144, '1451115556hab1392178597_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(145, '1451115556ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(146, '1451115556izp1392178615_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(147, '1451115556kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(148, '1451115556lrw1392178578_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(149, '1451115556medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10),
(150, '1451115556msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_info`
--

CREATE TABLE IF NOT EXISTS `hotel_info` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hotel_id` bigint(20) DEFAULT NULL,
  `bank_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_branch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mst` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manager_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manager_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manager_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `booking_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `booking_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `booking_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accountant_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accountant_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accountant_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `hotel_info`
--

INSERT INTO `hotel_info` (`id`, `hotel_id`, `bank_account`, `bank_name`, `bank_branch`, `account_number`, `mst`, `phone`, `email`, `website`, `fax`, `manager_name`, `manager_email`, `manager_phone`, `business_name`, `business_email`, `business_phone`, `booking_name`, `booking_email`, `booking_phone`, `accountant_name`, `accountant_email`, `accountant_phone`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_order`
--

CREATE TABLE IF NOT EXISTS `hotel_order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hotel_id` bigint(20) DEFAULT NULL,
  `date_stay_from` date DEFAULT NULL,
  `date_stay_to` date DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_payment` float DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `order_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_origin_payment` float DEFAULT NULL,
  `user_process` bigint(20) DEFAULT NULL,
  `user_verify` bigint(20) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL,
  `process_start_time` datetime DEFAULT NULL,
  `process_finish_time` datetime DEFAULT NULL,
  `paid` int(11) NOT NULL,
  `verify_time` datetime DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `hotel_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hotel_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `member_promotion` int(11) DEFAULT NULL,
  `member_promotion_discount` float DEFAULT NULL,
  `deposit` bigint(20) DEFAULT NULL,
  `order_note` text COLLATE utf8_unicode_ci,
  `deposit_partner_confirm` int(11) DEFAULT NULL,
  `deposit_partner_money` int(11) NOT NULL,
  `time_cancel` datetime DEFAULT NULL,
  `coupon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coupon_discount` float DEFAULT NULL,
  `coupon_discount_max_price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `hotel_order`
--

INSERT INTO `hotel_order` (`id`, `hotel_id`, `date_stay_from`, `date_stay_to`, `create_time`, `user_id`, `status`, `price_payment`, `payment_type`, `order_code`, `ip`, `price_origin_payment`, `user_process`, `user_verify`, `deleted`, `process_start_time`, `process_finish_time`, `paid`, `verify_time`, `note`, `hotel_name`, `hotel_address`, `update_time`, `member_promotion`, `member_promotion_discount`, `deposit`, `order_note`, `deposit_partner_confirm`, `deposit_partner_money`, `time_cancel`, `coupon`, `coupon_discount`, `coupon_discount_max_price`) VALUES
(1, 2, '2015-12-27', '2015-12-28', '2015-12-26 15:37:35', 0, '6', 600000, 1, 'ZE0551', '127.0.0.1', 500000, 4, 6, 0, '2015-12-26 15:38:38', '2015-12-26 15:39:09', 1, '2015-12-26 15:39:55', '', 'KHÁCH SẠN NIKKO SÀI GÒN', '235 Nguyễn Văn Cừ, Quận 1, Hồ Chí Minh', '2015-12-26 15:39:55', 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(2, 1, '2015-12-27', '2015-12-28', '2015-12-26 15:46:39', 0, '6', 300000, 1, 'HT5992', '127.0.0.1', 250000, 4, 6, 0, '2015-12-26 15:46:51', '2015-12-26 15:47:29', 1, '2015-12-26 15:48:01', '', 'KHÁCH SẠN EASTIN GRAND SÀI GÒN', '253 Nguyễn Văn Trỗi, Phú Nhuận, Hồ Chí Minh', '2015-12-26 15:48:01', 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3, 10, '2015-12-28', '2015-12-29', '2015-12-27 15:34:29', 1, '6', 3300000, 1, 'MF2693', '127.0.0.1', 3000000, 4, 6, 0, '2015-12-27 15:35:53', '2015-12-27 15:35:59', 1, '2015-12-27 15:36:37', '', 'KHÁCH SẠN PALM - HỒNG HÀ', '45/5 Đường Hồng Hà, Tân Bình, Hồ Chí Minh', '2015-12-27 15:36:37', 1, 20, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(4, 5, '2016-04-08', '2016-04-10', '2016-04-07 19:33:03', 0, '6', 1320000, 1, 'UW3834', '127.0.0.1', 1100000, 4, 6, 0, '2016-04-07 19:34:03', '2016-04-07 19:47:31', 1, '2016-04-07 19:48:04', '', 'KHÁCH SẠN CITY STAR', '13 Bùi Thị Xuân, Phường Bến Thành, Quận 1, Hồ Chí Minh', '2016-04-07 19:48:04', 1, 10, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(5, 10, '2016-04-08', '2016-04-09', '2016-04-07 19:44:03', 0, '6', 1188000, 1, 'YI0435', '127.0.0.1', 1080000, 4, 6, 0, '2016-04-07 19:55:45', '2016-04-07 19:55:55', 1, '2016-04-07 19:56:22', '', 'KHÁCH SẠN PALM - HỒNG HÀ', '45/5 Đường Hồng Hà, Tân Bình, Hồ Chí Minh', '2016-04-07 19:56:22', 1, 20, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(6, 10, '2016-04-10', '2016-04-11', '2016-04-09 10:50:23', 2, '2', 1680000, 1, 'RE8236', '127.0.0.1', 1610000, NULL, NULL, 0, NULL, NULL, 0, NULL, '', 'KHÁCH SẠN PALM - HỒNG HÀ', '45/5 Đường Hồng Hà, Tân Bình, Hồ Chí Minh', '2016-06-06 13:23:44', 1, 20, 0, NULL, 1, 1680000, NULL, NULL, NULL, NULL),
(7, 10, '2016-04-10', '2016-04-14', '2016-04-09 13:09:50', 0, '2', 8064000, 1, 'BN1907', '127.0.0.1', 7644000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN PALM - HỒNG HÀ', '45/5 Đường Hồng Hà, Tân Bình, Hồ Chí Minh', NULL, 1, 20, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(9, 10, '2016-04-10', '2016-04-11', '2016-04-09 13:32:58', 0, '2', 2100000, 1, 'OE5789', '127.0.0.1', 2016000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN PALM - HỒNG HÀ', '45/5 Đường Hồng Hà, Tân Bình, Hồ Chí Minh', NULL, 1, 20, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(10, 10, '2016-04-10', '2016-04-11', '2016-04-09 13:34:06', 0, '2', 2100000, 1, 'DJ64610', '127.0.0.1', 2016000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN PALM - HỒNG HÀ', '45/5 Đường Hồng Hà, Tân Bình, Hồ Chí Minh', NULL, 1, 20, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(11, 9, '2016-04-22', '2016-04-23', '2016-04-21 19:44:54', 0, '6', 600000, 1, 'UG69411', '127.0.0.1', 500000, NULL, 6, 0, NULL, NULL, 0, '2016-04-25 19:52:30', '', 'KHÁCH SẠN PALACE SAIGON', '56 - 66 Nguyễn Huệ, Quận 1, Hồ Chí Minh', '2016-04-25 19:52:30', 0, 0, 0, '23123123', 1, 3000000, NULL, NULL, NULL, NULL),
(12, 10, '2016-05-05', '2016-05-06', '2016-05-04 20:30:18', 0, '2', 1848000, 1, 'CS61912', '127.0.0.1', 1680000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN PALM - HỒNG HÀ', '45/5 Đường Hồng Hà, Tân Bình, Hồ Chí Minh', NULL, 1, 20, NULL, 'test', NULL, 0, NULL, NULL, NULL, NULL),
(13, 2, '2016-05-17', '2016-05-18', '2016-05-16 19:46:25', 0, '2', 600000, 1, 'CS78513', '127.0.0.1', 500000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN NIKKO SÀI GÒN', '235 Nguyễn Văn Cừ, Quận 1, Hồ Chí Minh', NULL, 0, 0, NULL, 'Thanh toán tại văn phòng', NULL, 0, '2016-05-20 19:46:25', NULL, NULL, NULL),
(14, 7, '2016-05-27', '2016-05-28', '2016-05-26 20:41:17', 0, '2', 600000, 1, 'IM07814', '127.0.0.1', 500000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN NGUYỆT VÂN', '59/10 Hồ Hảo Hớn, Phường Cô Giang, Quận 1, Hồ Chí Minh', NULL, 0, 0, NULL, '123123', NULL, 0, '2016-05-27 20:41:17', NULL, NULL, NULL),
(15, 7, '2016-05-27', '2016-05-28', '2016-05-26 20:42:19', 0, '2', 1200000, 1, 'JH13915', '127.0.0.1', 1000000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN NGUYỆT VÂN', '59/10 Hồ Hảo Hớn, Phường Cô Giang, Quận 1, Hồ Chí Minh', NULL, 0, 0, NULL, '', NULL, 0, '2016-05-27 20:42:19', NULL, NULL, NULL),
(16, 7, '2016-05-27', '2016-05-28', '2016-05-26 21:04:55', 0, '2', 1200000, 1, 'UV49516', '127.0.0.1', 1000000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN NGUYỆT VÂN', '59/10 Hồ Hảo Hớn, Phường Cô Giang, Quận 1, Hồ Chí Minh', NULL, 0, 0, NULL, '123123', NULL, 0, '2016-05-27 21:04:55', NULL, NULL, NULL),
(17, 5, '2016-05-27', '2016-05-28', '2016-05-26 21:08:53', 0, '2', 660000, 1, 'KC73317', '127.0.0.1', 550000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN CITY STAR', '13 Bùi Thị Xuân, Phường Bến Thành, Quận 1, Hồ Chí Minh', NULL, 1, 10, NULL, '', NULL, 0, '2016-05-27 21:08:53', NULL, NULL, NULL),
(18, 5, '2016-05-29', '2016-05-30', '2016-05-28 12:17:33', 0, '2', 594000, 1, 'NM65318', '127.0.0.1', 550000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN CITY STAR', '13 Bùi Thị Xuân, Phường Bến Thành, Quận 1, Hồ Chí Minh', NULL, 1, 10, NULL, '', NULL, 0, '2016-05-29 12:17:33', 'EG2241100', NULL, NULL),
(19, 5, '2016-05-29', '2016-05-30', '2016-05-28 12:30:22', 0, '2', 1188000, 1, 'VF42219', '127.0.0.1', 1100000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN CITY STAR', '13 Bùi Thị Xuân, Phường Bến Thành, Quận 1, Hồ Chí Minh', NULL, 1, 10, NULL, '', NULL, 0, '2016-05-29 12:30:22', 'HV224199', 10, 200000),
(20, 5, '2016-05-29', '2016-05-30', '2016-05-28 12:34:05', 0, '3', 594000, 1, 'YA64520', '127.0.0.1', 550000, 4, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN CITY STAR', '13 Bùi Thị Xuân, Phường Bến Thành, Quận 1, Hồ Chí Minh', NULL, 1, 10, NULL, '', NULL, 0, '2016-05-29 12:34:05', 'YM224198', 10, 200000),
(21, 5, '2016-05-29', '2016-05-30', '2016-05-28 12:48:01', 0, '6', 594000, 1, 'JZ48121', '127.0.0.1', 550000, NULL, NULL, 0, NULL, NULL, 1, NULL, '', 'KHÁCH SẠN CITY STAR', '13 Bùi Thị Xuân, Phường Bến Thành, Quận 1, Hồ Chí Minh', '2016-05-28 12:51:02', 1, 10, 0, '', 1, 550000, '2016-05-29 12:48:01', 'JQ224197', 10, 200000),
(22, 5, '2016-06-02', '2016-06-03', '2016-06-01 19:17:28', 0, '2', 660000, 1, 'LA44822', '127.0.0.1', 550000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN CITY STAR', '13 Bùi Thị Xuân, Phường Bến Thành, Quận 1, Hồ Chí Minh', NULL, 1, 10, NULL, '', NULL, 0, '2016-06-02 19:17:28', '123123', 0, 0),
(23, 5, '2016-06-02', '2016-06-03', '2016-06-01 19:18:36', 0, '2', 660000, 1, 'VD51623', '127.0.0.1', 550000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN CITY STAR', '13 Bùi Thị Xuân, Phường Bến Thành, Quận 1, Hồ Chí Minh', NULL, 1, 10, NULL, '', NULL, 0, '2016-06-02 19:18:36', '657567', 0, 0),
(24, 5, '2016-06-02', '2016-06-03', '2016-06-01 19:40:25', 0, '2', 594000, 1, 'TX82524', '127.0.0.1', 550000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN CITY STAR', '13 Bùi Thị Xuân, Phường Bến Thành, Quận 1, Hồ Chí Minh', NULL, 1, 10, NULL, '', NULL, 0, '2016-06-02 19:40:25', 'FR224194', 10, 200000),
(25, 5, '2016-06-02', '2016-06-03', '2016-06-01 19:44:03', 0, '2', 594000, 1, 'MA04325', '127.0.0.1', 550000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN CITY STAR', '13 Bùi Thị Xuân, Phường Bến Thành, Quận 1, Hồ Chí Minh', NULL, 1, 10, NULL, '', NULL, 0, '2016-06-02 19:44:03', 'HB224091', 10, 200000),
(26, 1, '2016-06-14', '2016-06-17', '2016-06-13 16:22:58', 0, '2', 3400000, 1, 'UQ77826', '42.119.182.23', 3000000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN EASTIN GRAND SÀI GÒN', '253 Nguyễn Văn Trỗi, Phú Nhuận, Hồ Chí Minh', NULL, 0, 0, NULL, '', NULL, 0, '2016-06-14 16:22:58', 'CO2414109', 10, 200000),
(27, 1, '2017-04-20', '2017-04-21', '2017-04-19 21:25:03', 0, '2', 600000, 1, 'NW90327', '123.20.162.176', 500000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN EASTIN GRAND SÀI GÒN', '253 Nguyễn Văn Trỗi, Phú Nhuận, Hồ Chí Minh', NULL, 0, 0, NULL, 'Test', NULL, 0, '2017-04-20 21:25:03', '', 0, 0),
(28, 1, '2017-04-20', '2017-04-21', '2017-04-19 21:27:45', 0, '2', 600000, 1, 'NA06528', '123.20.162.176', 500000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN EASTIN GRAND SÀI GÒN', '253 Nguyễn Văn Trỗi, Phú Nhuận, Hồ Chí Minh', NULL, 0, 0, NULL, '', NULL, 0, '2017-04-20 21:27:45', '', 0, 0),
(29, 9, '2017-04-21', '2017-04-22', '2017-04-20 09:09:04', 0, '3', 600000, 1, 'YF14429', '183.91.31.100', 500000, 4, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN PALACE SAIGON', '56 - 66 Nguyễn Huệ, Quận 1, Hồ Chí Minh', NULL, 0, 0, NULL, '', NULL, 0, '2017-04-21 09:09:04', '', 0, 0),
(30, 6, '2017-04-21', '2017-04-22', '2017-04-20 18:32:27', 0, '3', 600000, 1, 'HR94730', '118.68.212.248', 500000, 7, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN GOLDEN PALM', '33 Bạch Đằng, Phường 2, Tân Bình, Hồ Chí Minh', NULL, 0, 0, NULL, '', NULL, 0, '2017-04-21 18:32:27', '', 0, 0),
(31, 1, '2017-05-04', '2017-05-05', '2017-05-03 14:53:05', 0, '6', 600000, 2, 'RU98531', '115.78.228.81', 500000, NULL, NULL, 0, NULL, NULL, 0, NULL, '', 'KHÁCH SẠN EASTIN GRAND SÀI GÒN', '253 Nguyễn Văn Trỗi, Phú Nhuận, Hồ Chí Minh', '2017-05-03 14:54:51', 0, 0, 0, '', 0, 0, '2017-05-04 14:53:05', '', 0, 0),
(32, 7, '2017-05-28', '2017-05-29', '2017-05-27 19:35:55', 0, '2', 1200000, 1, 'FJ55532', '127.0.0.1', 1000000, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 'KHÁCH SẠN NGUYỆT VÂN', '59/10 Hồ Hảo Hớn, Phường Cô Giang, Quận 1, Hồ Chí Minh', NULL, 0, 0, NULL, 'test', NULL, 0, '2017-05-28 19:35:55', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_order_contact`
--

CREATE TABLE IF NOT EXISTS `hotel_order_contact` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `hotel_order_contact`
--

INSERT INTO `hotel_order_contact` (`id`, `name`, `phone`, `address`, `order_id`, `email`, `province_id`) VALUES
(1, 'Anh Tuấn', '0944518855', '19/9 Cầm Bá Thước', 1, 'anhtuan150787@yahoo.com', 98),
(2, 'Anh Tuấn', '0944518855', '19/9 Cầm Bá Thước', 2, 'anhtuan150787@gmail.com', 98),
(3, 'Anh Tuấn', '0944518855', '19/9 Cầm bá Thước', 3, 'anhtuan150787@yahoo.com', 98),
(4, 'Anh Tuấn', '123123', '123123', 4, 'anhtuan150787@gmail.com', 98),
(5, 'Anh Tuấn', '8978978', 'test', 5, 'anhtuan150787@gmail.com', 98),
(6, 'anhtuan', '5345345345', '19/9', 6, 'anhtuan150787@gmail.com', 98),
(7, 'Anh Tuan', '54645', '123123', 7, 'anhtuan150787@gmail.com', 98),
(9, 'Anh Tuấn', '12323', '123123', 9, 'anhtuan150787@yahoo.com', 98),
(10, 'Anh Tuan', '123', '123', 10, 'anhtuan150787@yahoo.com', 122),
(11, 'Anh Tuấn', '23123', '123123', 11, 'anhtuan150787@gmail.com', 98),
(12, 'Anh Tuấn', '0944518855', '25/1', 12, 'anhtuan150787@gmail.com', 98),
(13, 'Anh Tuấn', '0944518855', '25/1', 13, 'anhtuan150787@gmail.com', 99),
(14, 'a', '123123', '1231', 14, 'anhtuan1507@gmail.com', 98),
(15, 'a', '3123123', '12313', 15, 'anhtuan1507@yahoo.com', 98),
(16, 'tuan', '123213', '123', 16, 'anhtuan1507@yahoo.com', 98),
(17, 'asd', '123123', '13123', 17, 'anhtuan@yahoo.com', 98),
(18, 'Anh Tuan', '12312321', '123123', 18, 'anh@yahoo.com', 98),
(19, 'Anh Tuan', '123123', 'test', 19, 'anhtuan150787@gmail.com', 98),
(20, 'anh tuấn', '13123', '123123', 20, 'anhtuan150787@gmail.com', 98),
(21, 'Anh tuan', '13123', '123123', 21, 'anhtuan150787@gmail.com', 98),
(22, 'Anh Tuan', '123123', '123123', 22, 'anhtuan150787@yahoo.com', 98),
(23, 'Anh tuan', '6979887', '12313', 23, 'anhtuan1507@yahoo.com', 98),
(24, 'Anh Tuan', '123123', '123123', 24, 'anhtuan150787@gmail.com', 98),
(25, 'anhtuan', '123123', '1231', 25, 'anhtuan@yahoo.com', 98),
(26, 'hoàng', '01246666068', 'dsad', 26, 'hoangle2010@gmail.com', 98),
(27, 'Anh Tuan', '0944518811', 'Test dia chi', 27, 'anhtuan150787@gmail.com', 119),
(28, 'Anh Tuan', '0944518822', 'test', 28, 'anhtuan150787@yahoo.com', 123),
(29, 'Anh Tuan', '0944111111', 'test', 29, 'anhtuan150787@gmail.com', 116),
(30, 'hoàng', '0909277866', '725', 30, 'hoangle2010@gmail.com', 98),
(31, 'LE HOANG', '0909277866', '725 Phan Kế Bính', 31, 'hoangle2010@gmail.com', 98),
(32, 'Tets test', '0944112211', 'test ', 32, 'anhtuan150787.2@gmail.com', 121);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_order_contact_stay`
--

CREATE TABLE IF NOT EXISTS `hotel_order_contact_stay` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `hotel_order_contact_stay`
--

INSERT INTO `hotel_order_contact_stay` (`id`, `name`, `phone`, `address`, `order_id`, `email`, `province_id`) VALUES
(1, 'Anh Tuấn', '0944518855', '19/9 Cầm Bá Thước', 1, 'anhtuan150787@yahoo.com', 98),
(2, 'Anh Tuấn', '0944518855', '19/9 Cầm Bá Thước', 2, 'anhtuan150787@gmail.com', 98),
(3, 'Anh Tuấn', '0944518855', '19/9 Cầm bá Thước', 3, 'anhtuan150787@yahoo.com', 98),
(4, 'Anh Tuấn', '123123', '123123', 4, 'anhtuan150787@gmail.com', 98),
(5, 'Anh Tuấn', '8978978', 'test', 5, 'anhtuan150787@gmail.com', 98),
(6, 'anhtuan', '5345345345', '19/9', 6, 'anhtuan150787@gmail.com', 98),
(7, 'Anh Tuan', '54645', '123123', 7, 'anhtuan150787@gmail.com', 98),
(9, 'Anh Tuấn', '12323', '123123', 9, 'anhtuan150787@yahoo.com', 98),
(10, 'Anh Tuan', '123', '123', 10, 'anhtuan150787@yahoo.com', 122),
(11, 'Anh Tuấn', '23123', '123123', 11, 'anhtuan150787@gmail.com', 98),
(12, 'Anh Tuấn', '0944518855', '25/1', 12, 'anhtuan150787@gmail.com', 98),
(13, 'Anh Tuấn', '0944518855', '25/1', 13, 'anhtuan150787@gmail.com', 99),
(14, 'a', '123123', '1231', 14, 'anhtuan1507@gmail.com', 98),
(15, 'a', '3123123', '12313', 15, 'anhtuan1507@yahoo.com', 98),
(16, 'tuan', '123213', '123', 16, 'anhtuan1507@yahoo.com', 98),
(17, 'asd', '123123', '13123', 17, 'anhtuan@yahoo.com', 98),
(18, 'Anh Tuan', '12312321', '123123', 18, 'anh@yahoo.com', 98),
(19, 'Anh Tuan', '123123', 'test', 19, 'anhtuan150787@gmail.com', 98),
(20, 'anh tuấn', '13123', '123123', 20, 'anhtuan150787@gmail.com', 98),
(21, 'Anh tuan', '13123', '123123', 21, 'anhtuan150787@gmail.com', 98),
(22, 'Anh Tuan', '123123', '123123', 22, 'anhtuan150787@yahoo.com', 98),
(23, 'Anh tuan', '6979887', '12313', 23, 'anhtuan1507@yahoo.com', 98),
(24, 'Anh Tuan', '123123', '123123', 24, 'anhtuan150787@gmail.com', 98),
(25, 'anhtuan', '123123', '1231', 25, 'anhtuan@yahoo.com', 98),
(26, 'hoàng', '01246666068', 'dsad', 26, 'hoangle2010@gmail.com', 98),
(27, 'Anh Tuan', '0944518811', 'Test dia chi', 27, 'anhtuan150787@gmail.com', 119),
(28, 'Anh Tuan', '0944518822', 'test', 28, 'anhtuan150787@yahoo.com', 123),
(29, 'Anh Tuan', '0944111111', 'test', 29, 'anhtuan150787@gmail.com', 116),
(30, 'hoàng', '0909277866', '725', 30, 'hoangle2010@gmail.com', 98),
(31, 'LE HOANG', '0909277866', '725 Phan Kế Bính', 31, 'hoangle2010@gmail.com', 98),
(32, 'Tets test', '0944112211', 'test ', 32, 'anhtuan150787.2@gmail.com', 121);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_order_log`
--

CREATE TABLE IF NOT EXISTS `hotel_order_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hotel` longtext COLLATE utf8_unicode_ci,
  `room` longtext COLLATE utf8_unicode_ci,
  `order_id` bigint(20) DEFAULT NULL,
  `room_price` longtext COLLATE utf8_unicode_ci,
  `promotion` longtext COLLATE utf8_unicode_ci,
  `room_price_stage` longtext COLLATE utf8_unicode_ci,
  `coupon` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `hotel_order_log`
--

INSERT INTO `hotel_order_log` (`id`, `hotel`, `room`, `order_id`, `room_price`, `promotion`, `room_price_stage`, `coupon`) VALUES
(1, '{"id":"10","name":"KHu00c1CH Su1ea0N PALM - Hu1ed2NG Hu00c0","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"2","geonear_id":"11","facilities_id":",1,3,4,6,7,8,10,12,13,14,15,16,17,18,19,21,22,23,24,","type_id":"1","address":"45/5 u0110u01b0u1eddng Hu1ed3ng Hu00e0, Tu00e2n Bu00ecnh, Hu1ed3 Chu00ed Minh","picture":"1451115523_msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"5","user_id":"2","create_time":"2015-12-26 14:39:22","update_time":"2015-12-26 14:44:41","update_by":"product_hotel","lat":"10.800504603670573","lng":"106.62631640314942","zoom":"14","partner_id":"10","view":null,"sight_id":"6","deleted":"0","member_promotion":"1","member_promotion_discount":"20"}', '{"id":"10","name":"STANDARD","status":"1","hotel_id":"10","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"20m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451115575_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2016-04-09 12:08:55","create_time":"2015-12-26 14:40:29","update_by":"admin","slot":"2","slot_child":"0","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"20","deleted":"0","room_number":"10","hide_price":"0","price_type":"usd"}', 9, '{"id":"73","room_id":"10","day":"1","price_origin":"100","price":"110","hotel_id":"10","hide_price":"0","status":"1","deleted":"0"}', '{"id":"11","name":"Khuyu1ebfn mu00e3i 30%","status":"1","book_day_from":"2016-04-07","book_day_to":"2016-10-31","stay_day_from":"2016-04-07","stay_day_to":"2016-10-31","night":"1","policy":"","discount":"30","room_id":",10,","hotel_id":"10","user_id":"1","create_time":"2016-04-07 19:35:56","update_time":"2016-04-07 19:35:56","update_by":"admin","date_apply_from":"2016-04-07","date_apply_to":"2016-10-31","deleted":"0"}', '{"id":"23","date_from":"2016-04-10","date_to":"2016-04-11","price_origin":"120","price":"125","hotel_id":"10","room_id":"10"}', NULL),
(2, '{"id":"10","name":"KHu00c1CH Su1ea0N PALM - Hu1ed2NG Hu00c0","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"2","geonear_id":"11","facilities_id":",1,3,4,6,7,8,10,12,13,14,15,16,17,18,19,21,22,23,24,","type_id":"1","address":"45/5 u0110u01b0u1eddng Hu1ed3ng Hu00e0, Tu00e2n Bu00ecnh, Hu1ed3 Chu00ed Minh","picture":"1451115523_msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"5","user_id":"2","create_time":"2015-12-26 14:39:22","update_time":"2015-12-26 14:44:41","update_by":"product_hotel","lat":"10.800504603670573","lng":"106.62631640314942","zoom":"14","partner_id":"10","view":null,"sight_id":"6","deleted":"0","member_promotion":"1","member_promotion_discount":"20"}', '{"id":"10","name":"STANDARD","status":"1","hotel_id":"10","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"20m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451115575_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2016-04-09 12:08:55","create_time":"2015-12-26 14:40:29","update_by":"admin","slot":"2","slot_child":"0","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"20","deleted":"0","room_number":"10","hide_price":"0","price_type":"usd"}', 10, '{"id":"73","room_id":"10","day":"1","price_origin":"100","price":"110","hotel_id":"10","hide_price":"0","status":"1","deleted":"0"}', '{"id":"11","name":"Khuyu1ebfn mu00e3i 30%","status":"1","book_day_from":"2016-04-07","book_day_to":"2016-10-31","stay_day_from":"2016-04-07","stay_day_to":"2016-10-31","night":"1","policy":"","discount":"30","room_id":",10,","hotel_id":"10","user_id":"1","create_time":"2016-04-07 19:35:56","update_time":"2016-04-07 19:35:56","update_by":"admin","date_apply_from":"2016-04-07","date_apply_to":"2016-10-31","deleted":"0"}', '{"id":"23","date_from":"2016-04-10","date_to":"2016-04-11","price_origin":"120","price":"125","hotel_id":"10","room_id":"10"}', NULL),
(3, '{"id":"9","name":"KHu00c1CH Su1ea0N PALACE SAIGON","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"2","geonear_id":"11","facilities_id":",3,4,8,10,11,12,13,14,15,16,17,18,20,21,22,23,24,","type_id":"1","address":"56 - 66 Nguyu1ec5n Huu1ec7, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451115356_qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"1","user_id":"2","create_time":"2015-12-26 14:36:38","update_time":"2015-12-26 14:44:27","update_by":"product_hotel","lat":"10.818462149623674","lng":"106.64597163081055","zoom":"14","partner_id":"9","view":null,"sight_id":"6","deleted":"0","member_promotion":"0","member_promotion_discount":"0"}', '{"id":"9","name":"DELUXE CITY VIEW","status":"1","hotel_id":"9","facilities_id":",1,2,3,4,5,6,7,","type":"Hu01b0u1edbng trung tu00e2m","size":"30m2","bed":"2 giu01b0u1eddng u0111u01a1n","picture":"1451115414_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2016-04-19 16:01:44","create_time":"2015-12-26 14:37:47","update_by":"admin","slot":"3","slot_child":"0","holiday":"30/04,01/05","bed_more":"0","bed_more_price":"0","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 11, '{"id":"65","room_id":"9","day":"1","price_origin":"500000","price":"600000","hotel_id":"9","hide_price":"0","status":"1","deleted":"0"}', 'false', 'false', NULL),
(4, '{"id":"10","name":"KHu00c1CH Su1ea0N PALM - Hu1ed2NG Hu00c0","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"2","geonear_id":"11","facilities_id":",1,3,4,6,7,8,10,12,13,14,15,16,17,18,19,21,22,23,24,","type_id":"1","address":"45/5 u0110u01b0u1eddng Hu1ed3ng Hu00e0, Tu00e2n Bu00ecnh, Hu1ed3 Chu00ed Minh","picture":"1451115523_msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"5","user_id":"2","create_time":"2015-12-26 14:39:22","update_time":"2015-12-26 14:44:41","update_by":"product_hotel","lat":"10.800504603670573","lng":"106.62631640314942","zoom":"14","partner_id":"10","view":null,"sight_id":"6","deleted":"0","member_promotion":"1","member_promotion_discount":"20"}', '{"id":"10","name":"STANDARD","status":"1","hotel_id":"10","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"20m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451115575_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2016-04-12 20:32:30","create_time":"2015-12-26 14:40:29","update_by":"admin","slot":"2","slot_child":"0","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"20","deleted":"0","room_number":"10","hide_price":"0","price_type":"usd"}', 12, '{"id":"73","room_id":"10","day":"1","price_origin":"100","price":"110","hotel_id":"10","hide_price":"0","status":"1","deleted":"0"}', '{"id":"11","name":"Khuyu1ebfn mu00e3i 30%","status":"1","book_day_from":"2016-04-07","book_day_to":"2016-10-31","stay_day_from":"2016-04-07","stay_day_to":"2016-10-31","night":"1","policy":"","discount":"30","room_id":",10,","hotel_id":"10","user_id":"1","create_time":"2016-04-07 19:35:56","update_time":"2016-04-07 19:35:56","update_by":"admin","date_apply_from":"2016-04-07","date_apply_to":"2016-10-31","deleted":"0"}', 'false', NULL),
(5, '{"id":"2","name":"KHu00c1CH Su1ea0N NIKKO Su00c0I Gu00d2N","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,3,6,7,10,11,14,15,18,19,22,23,","type_id":"1","address":"235 Nguyu1ec5n Vu0103n Cu1eeb, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451113819_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"3","user_id":"2","create_time":"2015-12-26 14:11:09","update_time":"2015-12-26 14:42:06","update_by":"product_hotel","lat":"10.814078246957406","lng":"106.63695940852051","zoom":"14","partner_id":"2","view":null,"sight_id":"6","deleted":"0","member_promotion":"0","member_promotion_discount":"0"}', '{"id":"2","name":"DELUXE NO BREAKFAST","status":"1","hotel_id":"2","facilities_id":",1,2,3,4,5,6,7,8,","type":"2 giu01b0u1eddng u0111u01a1n","size":"20m2","bed":"2 giu01b0u1eddng u0111u01a1n","picture":"1451113889_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:42:10","create_time":"2015-12-26 14:12:27","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"0","bed_more_price":"0","deleted":"0","room_number":"5","hide_price":"0","price_type":"vnd"}', 13, '{"id":"9","room_id":"2","day":"1","price_origin":"500000","price":"600000","hotel_id":"2","hide_price":"0","status":"1","deleted":"0"}', 'false', 'false', NULL),
(6, '{"id":"7","name":"KHu00c1CH Su1ea0N NGUYu1ec6T Vu00c2N","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,5,6,7,9,11,12,13,14,15,16,20,24,","type_id":"1","address":"59/10 Hu1ed3 Hu1ea3o Hu1edbn, Phu01b0u1eddng Cu00f4 Giang, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114883_ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"2","user_id":"2","create_time":"2015-12-26 14:28:41","update_time":"2015-12-26 14:44:05","update_by":"product_hotel","lat":"10.814162553382223","lng":"106.62803301691895","zoom":"14","partner_id":"7","view":null,"sight_id":"6","deleted":"0","member_promotion":"0","member_promotion_discount":"0"}', '{"id":"7","name":"STANDARD","status":"1","hotel_id":"7","facilities_id":",1,2,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"20m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114936_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:44:10","create_time":"2015-12-26 14:30:19","update_by":"product_hotel","slot":"2","slot_child":"0","holiday":"30/04,01/05","bed_more":"0","bed_more_price":"0","deleted":"0","room_number":"7","hide_price":"0","price_type":"vnd"}', 14, '{"id":"49","room_id":"7","day":"1","price_origin":"500000","price":"600000","hotel_id":"7","hide_price":"0","status":"1","deleted":"0"}', '{"id":"10","name":"Khuyu1ebfn mu00e3i 30%","status":"1","book_day_from":"2015-12-26","book_day_to":"2016-03-31","stay_day_from":"2015-12-26","stay_day_to":"2016-03-31","night":"1","policy":"<p>Chu00ednh su00e1ch hu1ee7y cu1ee7a khuyu1ebfn mu00e3i</p>","discount":"30","room_id":",7,","hotel_id":"7","user_id":"2","create_time":"2015-12-26 14:31:31","update_time":"2015-12-26 14:44:14","update_by":"product_hotel","date_apply_from":"2015-12-26","date_apply_to":"2016-03-31","deleted":"0"}', 'false', NULL),
(7, '{"id":"7","name":"KHu00c1CH Su1ea0N NGUYu1ec6T Vu00c2N","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,5,6,7,9,11,12,13,14,15,16,20,24,","type_id":"1","address":"59/10 Hu1ed3 Hu1ea3o Hu1edbn, Phu01b0u1eddng Cu00f4 Giang, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114883_ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"2","user_id":"2","create_time":"2015-12-26 14:28:41","update_time":"2015-12-26 14:44:05","update_by":"product_hotel","lat":"10.814162553382223","lng":"106.62803301691895","zoom":"14","partner_id":"7","view":null,"sight_id":"6","deleted":"0","member_promotion":"0","member_promotion_discount":"0"}', '{"id":"7","name":"STANDARD","status":"1","hotel_id":"7","facilities_id":",1,2,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"20m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114936_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:44:10","create_time":"2015-12-26 14:30:19","update_by":"product_hotel","slot":"2","slot_child":"0","holiday":"30/04,01/05","bed_more":"0","bed_more_price":"0","deleted":"0","room_number":"7","hide_price":"0","price_type":"vnd"}', 15, '{"id":"49","room_id":"7","day":"1","price_origin":"500000","price":"600000","hotel_id":"7","hide_price":"0","status":"1","deleted":"0"}', '{"id":"10","name":"Khuyu1ebfn mu00e3i 30%","status":"1","book_day_from":"2015-12-26","book_day_to":"2016-03-31","stay_day_from":"2015-12-26","stay_day_to":"2016-03-31","night":"1","policy":"<p>Chu00ednh su00e1ch hu1ee7y cu1ee7a khuyu1ebfn mu00e3i</p>","discount":"30","room_id":",7,","hotel_id":"7","user_id":"2","create_time":"2015-12-26 14:31:31","update_time":"2015-12-26 14:44:14","update_by":"product_hotel","date_apply_from":"2015-12-26","date_apply_to":"2016-03-31","deleted":"0"}', 'false', NULL),
(8, '{"id":"7","name":"KHu00c1CH Su1ea0N NGUYu1ec6T Vu00c2N","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,5,6,7,9,11,12,13,14,15,16,20,24,","type_id":"1","address":"59/10 Hu1ed3 Hu1ea3o Hu1edbn, Phu01b0u1eddng Cu00f4 Giang, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114883_ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"2","user_id":"2","create_time":"2015-12-26 14:28:41","update_time":"2015-12-26 14:44:05","update_by":"product_hotel","lat":"10.814162553382223","lng":"106.62803301691895","zoom":"14","partner_id":"7","view":null,"sight_id":"6","deleted":"0","member_promotion":"0","member_promotion_discount":"0"}', '{"id":"7","name":"STANDARD","status":"1","hotel_id":"7","facilities_id":",1,2,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"20m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114936_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:44:10","create_time":"2015-12-26 14:30:19","update_by":"product_hotel","slot":"2","slot_child":"0","holiday":"30/04,01/05","bed_more":"0","bed_more_price":"0","deleted":"0","room_number":"7","hide_price":"0","price_type":"vnd"}', 16, '{"id":"49","room_id":"7","day":"1","price_origin":"500000","price":"600000","hotel_id":"7","hide_price":"0","status":"1","deleted":"0"}', '{"id":"10","name":"Khuyu1ebfn mu00e3i 30%","status":"1","book_day_from":"2015-12-26","book_day_to":"2016-03-31","stay_day_from":"2015-12-26","stay_day_to":"2016-03-31","night":"1","policy":"<p>Chu00ednh su00e1ch hu1ee7y cu1ee7a khuyu1ebfn mu00e3i</p>","discount":"30","room_id":",7,","hotel_id":"7","user_id":"2","create_time":"2015-12-26 14:31:31","update_time":"2015-12-26 14:44:14","update_by":"product_hotel","date_apply_from":"2015-12-26","date_apply_to":"2016-03-31","deleted":"0"}', 'false', NULL),
(9, '{"id":"5","name":"KHu00c1CH Su1ea0N CITY STAR","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,","type_id":"1","address":"13 Bu00f9i Thu1ecb Xuu00e2n, Phu01b0u1eddng Bu1ebfn Thu00e0nh, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114467_vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"3","user_id":"2","create_time":"2015-12-26 14:21:54","update_time":"2015-12-26 14:43:26","update_by":"product_hotel","lat":"10.825880915794508","lng":"106.64416918635254","zoom":"14","partner_id":"5","view":null,"sight_id":"6","deleted":"0","member_promotion":"1","member_promotion_discount":"10"}', '{"id":"5","name":"STANDARD DOUBLE","status":"1","hotel_id":"5","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"30m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114530_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:43:31","create_time":"2015-12-26 14:23:11","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 17, '{"id":"33","room_id":"5","day":"1","price_origin":"500000","price":"600000","hotel_id":"5","hide_price":"0","status":"1","deleted":"0"}', 'false', 'false', NULL),
(10, '{"id":"5","name":"KHu00c1CH Su1ea0N CITY STAR","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,","type_id":"1","address":"13 Bu00f9i Thu1ecb Xuu00e2n, Phu01b0u1eddng Bu1ebfn Thu00e0nh, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114467_vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"3","user_id":"2","create_time":"2015-12-26 14:21:54","update_time":"2015-12-26 14:43:26","update_by":"product_hotel","lat":"10.825880915794508","lng":"106.64416918635254","zoom":"14","partner_id":"5","view":null,"sight_id":"6","deleted":"0","member_promotion":"1","member_promotion_discount":"10"}', '{"id":"5","name":"STANDARD DOUBLE","status":"1","hotel_id":"5","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"30m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114530_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:43:31","create_time":"2015-12-26 14:23:11","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 18, '{"id":"33","room_id":"5","day":"1","price_origin":"500000","price":"600000","hotel_id":"5","hide_price":"0","status":"1","deleted":"0"}', 'false', 'false', NULL),
(11, '{"id":"5","name":"KHu00c1CH Su1ea0N CITY STAR","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,","type_id":"1","address":"13 Bu00f9i Thu1ecb Xuu00e2n, Phu01b0u1eddng Bu1ebfn Thu00e0nh, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114467_vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"3","user_id":"2","create_time":"2015-12-26 14:21:54","update_time":"2015-12-26 14:43:26","update_by":"product_hotel","lat":"10.825880915794508","lng":"106.64416918635254","zoom":"14","partner_id":"5","view":null,"sight_id":"6","deleted":"0","member_promotion":"1","member_promotion_discount":"10"}', '{"id":"5","name":"STANDARD DOUBLE","status":"1","hotel_id":"5","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"30m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114530_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:43:31","create_time":"2015-12-26 14:23:11","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 19, '{"id":"33","room_id":"5","day":"1","price_origin":"500000","price":"600000","hotel_id":"5","hide_price":"0","status":"1","deleted":"0"}', 'false', 'false', '{"discount":"10","discount_max_price":"200000","group_id":"2"}'),
(12, '{"id":"5","name":"KHu00c1CH Su1ea0N CITY STAR","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,","type_id":"1","address":"13 Bu00f9i Thu1ecb Xuu00e2n, Phu01b0u1eddng Bu1ebfn Thu00e0nh, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114467_vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"3","user_id":"2","create_time":"2015-12-26 14:21:54","update_time":"2015-12-26 14:43:26","update_by":"product_hotel","lat":"10.825880915794508","lng":"106.64416918635254","zoom":"14","partner_id":"5","view":null,"sight_id":"6","deleted":"0","member_promotion":"1","member_promotion_discount":"10"}', '{"id":"5","name":"STANDARD DOUBLE","status":"1","hotel_id":"5","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"30m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114530_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:43:31","create_time":"2015-12-26 14:23:11","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 20, '{"id":"33","room_id":"5","day":"1","price_origin":"500000","price":"600000","hotel_id":"5","hide_price":"0","status":"1","deleted":"0"}', 'false', 'false', '{"discount":"10","discount_max_price":"200000","group_id":"2"}'),
(13, '{"id":"5","name":"KHu00c1CH Su1ea0N CITY STAR","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,","type_id":"1","address":"13 Bu00f9i Thu1ecb Xuu00e2n, Phu01b0u1eddng Bu1ebfn Thu00e0nh, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114467_vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"3","user_id":"2","create_time":"2015-12-26 14:21:54","update_time":"2015-12-26 14:43:26","update_by":"product_hotel","lat":"10.825880915794508","lng":"106.64416918635254","zoom":"14","partner_id":"5","view":null,"sight_id":"6","deleted":"0","member_promotion":"1","member_promotion_discount":"10"}', '{"id":"5","name":"STANDARD DOUBLE","status":"1","hotel_id":"5","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"30m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114530_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:43:31","create_time":"2015-12-26 14:23:11","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 21, '{"id":"33","room_id":"5","day":"1","price_origin":"500000","price":"600000","hotel_id":"5","hide_price":"0","status":"1","deleted":"0"}', 'false', 'false', '{"discount":"10","discount_max_price":"200000","group_id":"2"}'),
(14, '{"id":"5","name":"KHu00c1CH Su1ea0N CITY STAR","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,","type_id":"1","address":"13 Bu00f9i Thu1ecb Xuu00e2n, Phu01b0u1eddng Bu1ebfn Thu00e0nh, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114467_vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"3","user_id":"2","create_time":"2015-12-26 14:21:54","update_time":"2015-12-26 14:43:26","update_by":"product_hotel","lat":"10.825880915794508","lng":"106.64416918635254","zoom":"14","partner_id":"5","view":null,"sight_id":"6","deleted":"0","member_promotion":"1","member_promotion_discount":"10"}', '{"id":"5","name":"STANDARD DOUBLE","status":"1","hotel_id":"5","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"30m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114530_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:43:31","create_time":"2015-12-26 14:23:11","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 22, '{"id":"33","room_id":"5","day":"1","price_origin":"500000","price":"600000","hotel_id":"5","hide_price":"0","status":"1","deleted":"0"}', 'false', 'false', 'false'),
(15, '{"id":"5","name":"KHu00c1CH Su1ea0N CITY STAR","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,","type_id":"1","address":"13 Bu00f9i Thu1ecb Xuu00e2n, Phu01b0u1eddng Bu1ebfn Thu00e0nh, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114467_vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"3","user_id":"2","create_time":"2015-12-26 14:21:54","update_time":"2015-12-26 14:43:26","update_by":"product_hotel","lat":"10.825880915794508","lng":"106.64416918635254","zoom":"14","partner_id":"5","view":null,"sight_id":"6","deleted":"0","member_promotion":"1","member_promotion_discount":"10"}', '{"id":"5","name":"STANDARD DOUBLE","status":"1","hotel_id":"5","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"30m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114530_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:43:31","create_time":"2015-12-26 14:23:11","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 23, '{"id":"33","room_id":"5","day":"1","price_origin":"500000","price":"600000","hotel_id":"5","hide_price":"0","status":"1","deleted":"0"}', 'false', 'false', 'false'),
(16, '{"id":"5","name":"KHu00c1CH Su1ea0N CITY STAR","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,","type_id":"1","address":"13 Bu00f9i Thu1ecb Xuu00e2n, Phu01b0u1eddng Bu1ebfn Thu00e0nh, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114467_vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"3","user_id":"2","create_time":"2015-12-26 14:21:54","update_time":"2015-12-26 14:43:26","update_by":"product_hotel","lat":"10.825880915794508","lng":"106.64416918635254","zoom":"14","partner_id":"5","view":null,"sight_id":"6","deleted":"0","member_promotion":"1","member_promotion_discount":"10"}', '{"id":"5","name":"STANDARD DOUBLE","status":"1","hotel_id":"5","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"30m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114530_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:43:31","create_time":"2015-12-26 14:23:11","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 24, '{"id":"33","room_id":"5","day":"1","price_origin":"500000","price":"600000","hotel_id":"5","hide_price":"0","status":"1","deleted":"0"}', 'false', 'false', '{"discount":"10","discount_max_price":"200000","group_id":"2"}'),
(17, '{"id":"5","name":"KHu00c1CH Su1ea0N CITY STAR","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,","type_id":"1","address":"13 Bu00f9i Thu1ecb Xuu00e2n, Phu01b0u1eddng Bu1ebfn Thu00e0nh, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114467_vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"3","user_id":"2","create_time":"2015-12-26 14:21:54","update_time":"2015-12-26 14:43:26","update_by":"product_hotel","lat":"10.825880915794508","lng":"106.64416918635254","zoom":"14","partner_id":"5","view":null,"sight_id":"6","deleted":"0","member_promotion":"1","member_promotion_discount":"10"}', '{"id":"5","name":"STANDARD DOUBLE","status":"1","hotel_id":"5","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"30m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114530_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:43:31","create_time":"2015-12-26 14:23:11","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 25, '{"id":"33","room_id":"5","day":"1","price_origin":"500000","price":"600000","hotel_id":"5","hide_price":"0","status":"1","deleted":"0"}', 'false', 'false', '{"discount":"10","discount_max_price":"200000","group_id":"2"}'),
(18, '{"id":"1","name":"KHu00c1CH Su1ea0N EASTIN GRAND Su00c0I Gu00d2N","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"2","geonear_id":"11","facilities_id":",1,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,","type_id":"1","address":"253 Nguyu1ec5n Vu0103n Tru1ed7i, Phu00fa Nhuu1eadn, Hu1ed3 Chu00ed Minh","picture":"1451113159_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"5","user_id":"2","create_time":"2015-12-26 14:02:20","update_time":"2015-12-26 14:41:38","update_by":"product_hotel","lat":"10.805984719874317","lng":"106.65034899592285","zoom":"14","partner_id":"1","view":null,"sight_id":"6","deleted":"0","member_promotion":"0","member_promotion_discount":"0"}', '{"id":"1","name":"DELUXE DOUBLE/TWIN","status":"1","hotel_id":"1","facilities_id":",1,2,3,4,5,6,7,8,","type":"1 giu01b0u1eddng u0111u00f4i / 2 giu01b0u1eddng u0111u01a1n","size":"38m2","bed":"1 giu01b0u1eddng u0111u00f4i / 2 giu01b0u1eddng u0111u01a1n","picture":"1451113477_ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:41:28","create_time":"2015-12-26 14:06:57","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 26, '{"id":"1","room_id":"1","day":"1","price_origin":"500000","price":"600000","hotel_id":"1","hide_price":"0","status":"1","deleted":"0"}', '{"id":"8","name":"Khuyu1ebfn mu00e3i 50%","status":"1","book_day_from":"2015-12-26","book_day_to":"2016-03-31","stay_day_from":"2015-12-26","stay_day_to":"2016-03-31","night":"1","policy":"<p>Chu00ednh su00e1ch hu1ee7y cu1ee7a khuyu1ebfn mu00e3i</p>","discount":"50","room_id":",1,","hotel_id":"1","user_id":"2","create_time":"2015-12-26 14:09:17","update_time":"2015-12-26 14:41:52","update_by":"product_hotel","date_apply_from":"2015-12-26","date_apply_to":"2016-03-31","deleted":"0"}', 'false', '{"discount":"10","discount_max_price":"200000","group_id":"2"}'),
(19, '{"id":"1","name":"KHu00c1CH Su1ea0N EASTIN GRAND Su00c0I Gu00d2N","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"2","geonear_id":"11","facilities_id":",1,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,","type_id":"1","address":"253 Nguyu1ec5n Vu0103n Tru1ed7i, Phu00fa Nhuu1eadn, Hu1ed3 Chu00ed Minh","picture":"1451113159_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"5","user_id":"2","create_time":"2015-12-26 14:02:20","update_time":"2015-12-26 14:41:38","update_by":"product_hotel","lat":"10.805984719874317","lng":"106.65034899592285","zoom":"14","partner_id":"1","view":null,"sight_id":"6","deleted":"0","member_promotion":"0","member_promotion_discount":"0"}', '{"id":"1","name":"DELUXE DOUBLE/TWIN","status":"1","hotel_id":"1","facilities_id":",1,2,3,4,5,6,7,8,","type":"1 giu01b0u1eddng u0111u00f4i / 2 giu01b0u1eddng u0111u01a1n","size":"38m2","bed":"1 giu01b0u1eddng u0111u00f4i / 2 giu01b0u1eddng u0111u01a1n","picture":"1451113477_ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:41:28","create_time":"2015-12-26 14:06:57","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 27, '{"id":"1","room_id":"1","day":"1","price_origin":"500000","price":"600000","hotel_id":"1","hide_price":"0","status":"1","deleted":"0"}', '{"id":"8","name":"Khuyu1ebfn mu00e3i 50%","status":"1","book_day_from":"2015-12-26","book_day_to":"2016-03-31","stay_day_from":"2015-12-26","stay_day_to":"2016-03-31","night":"1","policy":"<p>Chu00ednh su00e1ch hu1ee7y cu1ee7a khuyu1ebfn mu00e3i</p>","discount":"50","room_id":",1,","hotel_id":"1","user_id":"2","create_time":"2015-12-26 14:09:17","update_time":"2015-12-26 14:41:52","update_by":"product_hotel","date_apply_from":"2015-12-26","date_apply_to":"2016-03-31","deleted":"0"}', 'false', 'null'),
(20, '{"id":"1","name":"KHu00c1CH Su1ea0N EASTIN GRAND Su00c0I Gu00d2N","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"2","geonear_id":"11","facilities_id":",1,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,","type_id":"1","address":"253 Nguyu1ec5n Vu0103n Tru1ed7i, Phu00fa Nhuu1eadn, Hu1ed3 Chu00ed Minh","picture":"1451113159_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"5","user_id":"2","create_time":"2015-12-26 14:02:20","update_time":"2015-12-26 14:41:38","update_by":"product_hotel","lat":"10.805984719874317","lng":"106.65034899592285","zoom":"14","partner_id":"1","view":null,"sight_id":"6","deleted":"0","member_promotion":"0","member_promotion_discount":"0"}', '{"id":"1","name":"DELUXE DOUBLE/TWIN","status":"1","hotel_id":"1","facilities_id":",1,2,3,4,5,6,7,8,","type":"1 giu01b0u1eddng u0111u00f4i / 2 giu01b0u1eddng u0111u01a1n","size":"38m2","bed":"1 giu01b0u1eddng u0111u00f4i / 2 giu01b0u1eddng u0111u01a1n","picture":"1451113477_ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:41:28","create_time":"2015-12-26 14:06:57","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 28, '{"id":"1","room_id":"1","day":"1","price_origin":"500000","price":"600000","hotel_id":"1","hide_price":"0","status":"1","deleted":"0"}', '{"id":"8","name":"Khuyu1ebfn mu00e3i 50%","status":"1","book_day_from":"2015-12-26","book_day_to":"2016-03-31","stay_day_from":"2015-12-26","stay_day_to":"2016-03-31","night":"1","policy":"<p>Chu00ednh su00e1ch hu1ee7y cu1ee7a khuyu1ebfn mu00e3i</p>","discount":"50","room_id":",1,","hotel_id":"1","user_id":"2","create_time":"2015-12-26 14:09:17","update_time":"2015-12-26 14:41:52","update_by":"product_hotel","date_apply_from":"2015-12-26","date_apply_to":"2016-03-31","deleted":"0"}', 'false', 'null'),
(21, '{"id":"9","name":"KHu00c1CH Su1ea0N PALACE SAIGON","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"2","geonear_id":"11","facilities_id":",3,4,8,10,11,12,13,14,15,16,17,18,20,21,22,23,24,","type_id":"1","address":"56 - 66 Nguyu1ec5n Huu1ec7, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451115356_qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"1","user_id":"2","create_time":"2015-12-26 14:36:38","update_time":"2015-12-26 14:44:27","update_by":"product_hotel","lat":"10.818462149623674","lng":"106.64597163081055","zoom":"14","partner_id":"9","view":null,"sight_id":"6","deleted":"0","member_promotion":"0","member_promotion_discount":"0"}', '{"id":"9","name":"DELUXE CITY VIEW","status":"1","hotel_id":"9","facilities_id":",1,2,3,4,5,6,7,","type":"Hu01b0u1edbng trung tu00e2m","size":"30m2","bed":"2 giu01b0u1eddng u0111u01a1n","picture":"1451115414_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2016-04-19 16:01:44","create_time":"2015-12-26 14:37:47","update_by":"admin","slot":"3","slot_child":"0","holiday":"30/04,01/05","bed_more":"0","bed_more_price":"0","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 29, '{"id":"65","room_id":"9","day":"1","price_origin":"500000","price":"600000","hotel_id":"9","hide_price":"0","status":"1","deleted":"0"}', '{"id":"12","name":"Khuyu1ebfn mu00e3i 20%","status":"1","book_day_from":"2016-04-21","book_day_to":"2016-04-30","stay_day_from":"2016-04-21","stay_day_to":"2016-04-30","night":"1","policy":"","discount":"20","room_id":",9,","hotel_id":"9","user_id":"1","create_time":"2016-04-21 20:10:59","update_time":"2016-04-21 20:10:59","update_by":"admin","date_apply_from":"2016-04-21","date_apply_to":"2016-04-30","deleted":"0"}', 'false', 'null'),
(22, '{"id":"6","name":"KHu00c1CH Su1ea0N GOLDEN PALM","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,3,4,6,7,8,10,11,12,14,15,18,19,22,23,","type_id":"1","address":"33 Bu1ea1ch u0110u1eb1ng, Phu01b0u1eddng 2, Tu00e2n Bu00ecnh, Hu1ed3 Chu00ed Minh","picture":"1451114670_kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"5","user_id":"2","create_time":"2015-12-26 14:25:11","update_time":"2015-12-26 14:43:40","update_by":"product_hotel","lat":"10.797047863556427","lng":"106.65318140864258","zoom":"14","partner_id":"6","view":null,"sight_id":"6","deleted":"0","member_promotion":"0","member_promotion_discount":"0"}', '{"id":"6","name":"STANDARD DOUBLE","status":"1","hotel_id":"6","facilities_id":",1,2,3,4,5,6,7,8,","type":"Hu01b0u1edbng thu00e0nh phu1ed1","size":"20m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114726_qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:43:37","create_time":"2015-12-26 14:26:53","update_by":"product_hotel","slot":"2","slot_child":"0","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"5","hide_price":"0","price_type":"vnd"}', 30, '{"id":"41","room_id":"6","day":"1","price_origin":"500000","price":"600000","hotel_id":"6","hide_price":"0","status":"1","deleted":"0"}', 'false', 'false', 'null'),
(23, '{"id":"1","name":"KHu00c1CH Su1ea0N EASTIN GRAND Su00c0I Gu00d2N","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"2","geonear_id":"11","facilities_id":",1,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,","type_id":"1","address":"253 Nguyu1ec5n Vu0103n Tru1ed7i, Phu00fa Nhuu1eadn, Hu1ed3 Chu00ed Minh","picture":"1451113159_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"5","user_id":"2","create_time":"2015-12-26 14:02:20","update_time":"2015-12-26 14:41:38","update_by":"product_hotel","lat":"10.805984719874317","lng":"106.65034899592285","zoom":"14","partner_id":"1","view":null,"sight_id":"6","deleted":"0","member_promotion":"0","member_promotion_discount":"0","keyword":""}', '{"id":"1","name":"DELUXE DOUBLE/TWIN","status":"1","hotel_id":"1","facilities_id":",1,2,3,4,5,6,7,8,","type":"1 giu01b0u1eddng u0111u00f4i / 2 giu01b0u1eddng u0111u01a1n","size":"38m2","bed":"1 giu01b0u1eddng u0111u00f4i / 2 giu01b0u1eddng u0111u01a1n","picture":"1451113477_ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:41:28","create_time":"2015-12-26 14:06:57","update_by":"product_hotel","slot":"2","slot_child":"1","holiday":"30/04,01/05","bed_more":"1","bed_more_price":"150000","deleted":"0","room_number":"10","hide_price":"0","price_type":"vnd"}', 31, '{"id":"1","room_id":"1","day":"1","price_origin":"500000","price":"600000","hotel_id":"1","hide_price":"0","status":"1","deleted":"0"}', '{"id":"8","name":"Khuyu1ebfn mu00e3i 50%","status":"1","book_day_from":"2015-12-26","book_day_to":"2016-03-31","stay_day_from":"2015-12-26","stay_day_to":"2016-03-31","night":"1","policy":"<p>Chu00ednh su00e1ch hu1ee7y cu1ee7a khuyu1ebfn mu00e3i</p>","discount":"50","room_id":",1,","hotel_id":"1","user_id":"2","create_time":"2015-12-26 14:09:17","update_time":"2015-12-26 14:41:52","update_by":"product_hotel","date_apply_from":"2015-12-26","date_apply_to":"2016-03-31","deleted":"0"}', 'false', 'null'),
(24, '{"id":"7","name":"KHu00c1CH Su1ea0N NGUYu1ec6T Vu00c2N","status":"1","national_id":"2","area_id":"3","province_id":"98","district_id":"2","ward_id":"3","geonear_id":"11","facilities_id":",1,5,6,7,9,11,12,13,14,15,16,20,24,","type_id":"1","address":"59/10 Hu1ed3 Hu1ea3o Hu1edbn, Phu01b0u1eddng Cu00f4 Giang, Quu1eadn 1, Hu1ed3 Chu00ed Minh","picture":"1451114883_ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","star":"2","user_id":"2","create_time":"2015-12-26 14:28:41","update_time":"2015-12-26 14:44:05","update_by":"product_hotel","lat":"10.814162553382223","lng":"106.62803301691895","zoom":"14","partner_id":"7","view":null,"sight_id":"6","deleted":"0","member_promotion":"0","member_promotion_discount":"0","keyword":""}', '{"id":"7","name":"STANDARD","status":"1","hotel_id":"7","facilities_id":",1,2,4,5,6,7,8,","type":"Hu01b0u1edbng biu1ec3n","size":"20m2","bed":"1 giu01b0u1eddng u0111u00f4i","picture":"1451114936_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg","user_id":"2","update_time":"2015-12-26 14:44:10","create_time":"2015-12-26 14:30:19","update_by":"product_hotel","slot":"2","slot_child":"0","holiday":"30/04,01/05","bed_more":"0","bed_more_price":"0","deleted":"0","room_number":"7","hide_price":"0","price_type":"vnd"}', 32, '{"id":"49","room_id":"7","day":"1","price_origin":"500000","price":"600000","hotel_id":"7","hide_price":"0","status":"1","deleted":"0"}', '{"id":"10","name":"Khuyu1ebfn mu00e3i 30%","status":"1","book_day_from":"2015-12-26","book_day_to":"2016-03-31","stay_day_from":"2015-12-26","stay_day_to":"2016-03-31","night":"1","policy":"<p>Chu00ednh su00e1ch hu1ee7y cu1ee7a khuyu1ebfn mu00e3i</p>","discount":"30","room_id":",7,","hotel_id":"7","user_id":"2","create_time":"2015-12-26 14:31:31","update_time":"2015-12-26 14:44:14","update_by":"product_hotel","date_apply_from":"2015-12-26","date_apply_to":"2016-03-31","deleted":"0"}', 'false', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_order_room`
--

CREATE TABLE IF NOT EXISTS `hotel_order_room` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `room_id` bigint(20) DEFAULT NULL,
  `hotel_id` bigint(20) DEFAULT NULL,
  `price` float(10,0) DEFAULT NULL,
  `night` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `room_number_booking` int(11) DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `price_total` float DEFAULT NULL,
  `promotion_id` bigint(20) DEFAULT NULL,
  `promotion_discount` float DEFAULT NULL,
  `price_final` float DEFAULT NULL,
  `slot` int(11) DEFAULT NULL,
  `price_origin` float DEFAULT NULL,
  `price_origin_total` float DEFAULT NULL,
  `room_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_origin_final` float DEFAULT NULL,
  `price_bedmore` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `hotel_order_room`
--

INSERT INTO `hotel_order_room` (`id`, `room_id`, `hotel_id`, `price`, `night`, `room_number_booking`, `order_id`, `price_total`, `promotion_id`, `promotion_discount`, `price_final`, `slot`, `price_origin`, `price_origin_total`, `room_name`, `price_origin_final`, `price_bedmore`) VALUES
(1, 2, 2, 600000, '1', 1, 1, 600000, 0, 0, 600000, 2, 500000, 500000, 'DELUXE NO BREAKFAST', 500000, 0),
(2, 1, 1, 600000, '1', 1, 2, 300000, 8, 50, 300000, 2, 500000, 250000, 'DELUXE DOUBLE/TWIN', 250000, 0),
(3, 10, 10, 3300000, '1', 1, 3, 3300000, 0, 0, 3300000, 2, 3000000, 3000000, 'STANDARD', 3000000, 0),
(4, 5, 5, 600000, '2', 1, 4, 1320000, 0, 0, 660000, 2, 500000, 1100000, 'STANDARD DOUBLE', 550000, 0),
(5, 10, 10, 3300000, '1', 1, 5, 1188000, 11, 30, 1188000, 2, 3000000, 1080000, 'STANDARD', 1080000, 0),
(6, 10, 10, 2400000, '1', 1, 6, 1680000, 11, 30, 1680000, 2, 2300000, 1610000, 'STANDARD', 1610000, 0),
(7, 10, 10, 2400000, '4', 1, 7, 8064000, 11, 30, 2016000, 2, 2275000, 7644000, 'STANDARD', 1911000, 0),
(9, 10, 10, 2500000, '1', 1, 9, 2100000, 11, 30, 2100000, 2, 2400000, 2016000, 'STANDARD', 2016000, 0),
(10, 10, 10, 2500000, '1', 1, 10, 2100000, 11, 30, 2100000, 2, 2400000, 2016000, 'STANDARD', 2016000, 0),
(11, 9, 9, 600000, '1', 1, 11, 600000, 0, 0, 600000, 3, 500000, 500000, 'DELUXE CITY VIEW', 500000, 0),
(12, 10, 10, 2200000, '1', 1, 12, 1848000, 11, 30, 1848000, 2, 2000000, 1680000, 'STANDARD', 1680000, 0),
(13, 2, 2, 600000, '1', 1, 13, 600000, 0, 0, 600000, 2, 500000, 500000, 'DELUXE NO BREAKFAST', 500000, 0),
(14, 7, 7, 600000, '1', 1, 14, 600000, 0, 0, 600000, 2, 500000, 500000, 'STANDARD', 500000, 0),
(15, 7, 7, 600000, '1', 2, 15, 1200000, 0, 0, 600000, 2, 500000, 1000000, 'STANDARD', 500000, 0),
(16, 7, 7, 600000, '1', 2, 16, 1200000, 0, 0, 600000, 2, 500000, 1000000, 'STANDARD', 500000, 0),
(17, 5, 5, 600000, '1', 1, 17, 660000, 0, 0, 660000, 2, 500000, 550000, 'STANDARD DOUBLE', 550000, 0),
(18, 5, 5, 600000, '1', 1, 18, 660000, 0, 0, 660000, 2, 500000, 550000, 'STANDARD DOUBLE', 550000, 0),
(19, 5, 5, 600000, '1', 2, 19, 1320000, 0, 0, 660000, 2, 500000, 1100000, 'STANDARD DOUBLE', 550000, 0),
(20, 5, 5, 600000, '1', 1, 20, 660000, 0, 0, 660000, 2, 500000, 550000, 'STANDARD DOUBLE', 550000, 0),
(21, 5, 5, 600000, '1', 1, 21, 660000, 0, 0, 660000, 2, 500000, 550000, 'STANDARD DOUBLE', 550000, 0),
(22, 5, 5, 600000, '1', 1, 22, 660000, 0, 0, 660000, 2, 500000, 550000, 'STANDARD DOUBLE', 550000, 0),
(23, 5, 5, 600000, '1', 1, 23, 660000, 0, 0, 660000, 2, 500000, 550000, 'STANDARD DOUBLE', 550000, 0),
(24, 5, 5, 600000, '1', 1, 24, 660000, 0, 0, 660000, 2, 500000, 550000, 'STANDARD DOUBLE', 550000, 0),
(25, 5, 5, 600000, '1', 1, 25, 660000, 0, 0, 660000, 2, 500000, 550000, 'STANDARD DOUBLE', 550000, 0),
(26, 1, 1, 600000, '3', 2, 26, 3600000, 0, 0, 600000, 2, 500000, 3000000, 'DELUXE DOUBLE/TWIN', 500000, 0),
(27, 1, 1, 600000, '1', 1, 27, 600000, 0, 0, 600000, 2, 500000, 500000, 'DELUXE DOUBLE/TWIN', 500000, 0),
(28, 1, 1, 600000, '1', 1, 28, 600000, 0, 0, 600000, 2, 500000, 500000, 'DELUXE DOUBLE/TWIN', 500000, 0),
(29, 9, 9, 600000, '1', 1, 29, 600000, 0, 0, 600000, 3, 500000, 500000, 'DELUXE CITY VIEW', 500000, 0),
(30, 6, 6, 600000, '1', 1, 30, 600000, 0, 0, 600000, 2, 500000, 500000, 'STANDARD DOUBLE', 500000, 0),
(31, 1, 1, 600000, '1', 1, 31, 600000, 0, 0, 600000, 2, 500000, 500000, 'DELUXE DOUBLE/TWIN', 500000, 0),
(32, 7, 7, 600000, '1', 2, 32, 1200000, 0, 0, 600000, 2, 500000, 1000000, 'STANDARD', 500000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_tmp`
--

CREATE TABLE IF NOT EXISTS `hotel_tmp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` float(1,0) DEFAULT NULL,
  `national_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `ward_id` int(11) DEFAULT NULL,
  `geonear_id` int(11) DEFAULT NULL,
  `facilities_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `policy` text COLLATE utf8_unicode_ci,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zoom` int(11) DEFAULT NULL,
  `partner_id` bigint(20) DEFAULT NULL,
  `view` bigint(20) DEFAULT NULL,
  `sight_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `member_promotion` int(11) NOT NULL,
  `member_promotion_discount` float DEFAULT NULL,
  `keyword` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `hotel_tmp`
--

INSERT INTO `hotel_tmp` (`id`, `name`, `status`, `national_id`, `area_id`, `province_id`, `district_id`, `ward_id`, `geonear_id`, `facilities_id`, `type_id`, `address`, `description`, `policy`, `picture`, `star`, `user_id`, `create_time`, `update_time`, `update_by`, `lat`, `lng`, `zoom`, `partner_id`, `view`, `sight_id`, `deleted`, `member_promotion`, `member_promotion_discount`, `keyword`) VALUES
(1, 'KHÁCH SẠN EASTIN GRAND SÀI GÒN', 1, 2, 3, 98, 2, 2, 11, ',1,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,', 1, '253 Nguyễn Văn Trỗi, Phú Nhuận, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451113159_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5, 2, '2015-12-26 14:02:20', '2015-12-26 14:41:38', 'product_hotel', '10.805984719874317', '106.65034899592285', 14, 1, NULL, 6, 0, 0, 0, ''),
(2, 'KHÁCH SẠN NIKKO SÀI GÒN', 1, 2, 3, 98, 2, 3, 11, ',1,3,6,7,10,11,14,15,18,19,22,23,', 1, '235 Nguyễn Văn Cừ, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451113819_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3, 2, '2015-12-26 14:11:09', '2015-12-26 14:42:06', 'product_hotel', '10.814078246957406', '106.63695940852051', 14, 2, NULL, 6, 0, 0, 0, ''),
(3, 'KHÁCH SẠN PHỤNG HOÀNG GOLD PALACE', 1, 2, 3, 98, 2, 2, 11, ',1,4,5,6,8,9,10,12,14,16,17,18,19,21,22,23,', 1, '97 Bùi Viện, Phường Phạm Ngũ Lão, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451114035_izp1392178615_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 4, 2, '2015-12-26 14:14:41', '2015-12-26 14:42:29', 'product_hotel', '10.826218128075105', '106.66185030817871', 14, 3, NULL, 6, 0, 0, 0, ''),
(4, 'KHÁCH SẠN PHOENIX SÀI GÒN', 1, 2, 3, 98, 2, 3, 11, ',1,4,6,8,10,12,13,14,15,17,19,21,', 1, '74 Bùi Viện, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451114239_msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, 2, '2015-12-26 14:17:58', '2015-12-26 14:43:00', 'product_hotel', '10.811970578636307', '106.68270716547852', 14, 4, NULL, 6, 0, 0, 0, ''),
(5, 'KHÁCH SẠN CITY STAR', 1, 2, 3, 98, 2, 3, 11, ',1,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,', 1, '13 Bùi Thị Xuân, Phường Bến Thành, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451114467_vcy1392178488_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 3, 2, '2015-12-26 14:21:54', '2015-12-26 14:43:26', 'product_hotel', '10.825880915794508', '106.64416918635254', 14, 5, NULL, 6, 0, 1, 10, '');
INSERT INTO `hotel_tmp` (`id`, `name`, `status`, `national_id`, `area_id`, `province_id`, `district_id`, `ward_id`, `geonear_id`, `facilities_id`, `type_id`, `address`, `description`, `policy`, `picture`, `star`, `user_id`, `create_time`, `update_time`, `update_by`, `lat`, `lng`, `zoom`, `partner_id`, `view`, `sight_id`, `deleted`, `member_promotion`, `member_promotion_discount`, `keyword`) VALUES
(6, 'KHÁCH SẠN GOLDEN PALM', 1, 2, 3, 98, 2, 3, 11, ',1,3,4,6,7,8,10,11,12,14,15,18,19,22,23,', 1, '33 Bạch Đằng, Phường 2, Tân Bình, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451114670_kqw1392178592_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5, 2, '2015-12-26 14:25:11', '2015-12-26 14:43:40', 'product_hotel', '10.797047863556427', '106.65318140864258', 14, 6, NULL, 6, 0, 0, 0, ''),
(7, 'KHÁCH SẠN NGUYỆT VÂN', 1, 2, 3, 98, 2, 3, 11, ',1,5,6,7,9,11,12,13,14,15,16,20,24,', 1, '59/10 Hồ Hảo Hớn, Phường Cô Giang, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451114883_ujv1392178494_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, 2, '2015-12-26 14:28:41', '2015-12-26 14:44:05', 'product_hotel', '10.814162553382223', '106.62803301691895', 14, 7, NULL, 6, 0, 0, 0, ''),
(8, 'KHÁCH SẠN ARIES BẾN THÀNH', 1, 2, 3, 98, 2, 2, 11, ',1,3,4,6,7,8,10,12,14,15,16,18,19,20,23,', 1, '7/9 Nguyễn Trãi, Phường Bến Thành, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451115130_erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, 2, '2015-12-26 14:32:54', '2015-12-26 14:44:23', 'product_hotel', '10.797890974569109', '106.64923319697266', 14, 8, NULL, 6, 0, 1, 15, ''),
(9, 'KHÁCH SẠN PALACE SAIGON', 1, 2, 3, 98, 2, 2, 11, ',3,4,8,10,11,12,13,14,15,16,17,18,20,21,22,23,24,', 1, '56 - 66 Nguyễn Huệ, Quận 1, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\r\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\r\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\r\n</dl>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451115356_qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 1, 2, '2015-12-26 14:36:38', '2015-12-26 14:44:27', 'product_hotel', '10.818462149623674', '106.64597163081055', 14, 9, NULL, 6, 0, 0, 0, ''),
(10, 'KHÁCH SẠN PALM - HỒNG HÀ', 1, 2, 3, 98, 2, 2, 11, ',1,3,4,6,7,8,10,12,13,14,15,16,17,18,19,21,22,23,24,', 1, '45/5 Đường Hồng Hà, Tân Bình, Hồ Chí Minh', '<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Palm Hồng H&agrave;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;"> c&ograve;n tọa lạc tại quận Ph&uacute; Nhuận, tr&ecirc;n trục đường huyết mạch dẫn v&agrave;o khu trung t&acirc;m th&agrave;nh phố, đi xe khoảng 10 ph&uacute;t tới s&acirc;n bay s&acirc;n bay T&acirc;n Sơn Nhất v&agrave; khu triển l&atilde;m hội chợ quốc tế Ho&agrave;ng Văn Thụ rất thuận tiện cho việc đi lại của kh&aacute;ch h&agrave;ng.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Với lối thiết kế sang trọng&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>c&ograve;n to&aacute;t l&ecirc;n một vẻ đẹp nguy nga tr&aacute;ng lệ thu h&uacute;t rất kh&aacute;ch h&agrave;ng bởi vẻ đẹp sang trọng ấy. Với đội ngũ nh&acirc;n vi&ecirc;n th&acirc;n thiện v&agrave; chuy&ecirc;n nghiệp được đ&agrave;o tạo tốt nhất.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;đạt ti&ecirc;u chuẩn 5 sao với ph&ograve;ng Superior, ph&ograve;ng Deluxe, ph&ograve;ng Premium, ph&ograve;ng Family v&agrave; ph&ograve;ng Executive Club. Tất cả c&aacute;c ph&ograve;ng đều được trang thiết bị hiện đại v&agrave; tiện nghi hiện đại. Với những &aacute;nh đ&egrave;n lung linh chiếu s&aacute;ng tr&ecirc;n con đường Nguyễn Văn Trỗi một trong những con đường đẹp nhất của th&agrave;nh phố.&nbsp;</span>Mytour sẽ hỗ trợ đặt ph&ograve;ng ph&ugrave; hợp nhu cầu chuyến đi của bạn!</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-weight: bold;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span></span><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">&nbsp;th&iacute;ch hợp cho hoạt động MICE với ph&ograve;ng hội nghị lớn, c&oacute; sức chứa đến 400 kh&aacute;ch, với 2 ph&ograve;ng họp nhỏ, 3 ph&ograve;ng họp d&agrave;nh cho c&aacute;c vị l&atilde;nh đạo. Tất cả c&aacute;c ph&ograve;ng họp được trang bị m&aacute;y chiếu, m&agrave;n h&igrave;nh t<a style="box-sizing: border-box; color: #00adef; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important; background-color: transparent;" name="_GoBack"></a>ự động, v&agrave; tường c&aacute;ch &acirc;m c&ugrave;ng đội ngũ phục vụ chu đ&aacute;o, chuy&ecirc;n nghiệp.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ khi th&agrave;nh lập cho đến nay&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;đ&atilde; tổ chức th&agrave;nh c&ocirc;ng rất nhiều sự kiện, đặc biệt gần đ&acirc;y nhất Movenpick l&agrave; sự kiện Triển l&atilde;m cưới Moevenpick 2012, với sự g&oacute;p mặt của nhiều gương mặt nổi tiếng Hoa hậu Diễm Hương, diễn vi&ecirc;n Kim Hiền.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Từ kh&aacute;ch sạn, bạn c&oacute; thể tham quan, kh&aacute;m ph&aacute; c&aacute;c địa danh nổi tiếng tại th&agrave;nh phố như chợ Bến Th&agrave;nh, Dinh Độc Lập, Bến Nh&agrave; Rồng, Địa Đạo Củ Chi&hellip; với dịch vụ đặt tour tại kh&aacute;ch sạn.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px; color: #404040; line-height: 18.2px; text-align: justify;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; line-height: 13.91px;">Đến với&nbsp;<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;c&ograve;n để tận hưởng những dịch vụ cao cấp, tiện nghi với đội ngũ nh&acirc;n vi&ecirc;n chuy&ecirc;n nghiệp, đặt ph&ograve;ng<span style="box-sizing: border-box; font-weight: bold; font-family: ''Open Sans'', sans-serif !important; font-size: 13px !important;">&nbsp;kh&aacute;ch sạn Eastin Grand Saigon&nbsp;</span>&nbsp;ch&iacute;nh l&agrave; lựa chọn đ&uacute;ng đắn cho kỳ nghỉ ngơi v&agrave; thư gi&atilde;n của bạn.</span></p>\n<p style="box-sizing: border-box; margin: 0px 0px 0.0001pt; color: #404040; text-align: justify; line-height: 19.5px;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt;">Với sự hỗ trợ của Mytour, bạn sẽ c&oacute; cơ hội đặt ph&ograve;ng gi&aacute; rẻ nhấtc&ugrave;ng nhiều chương tr&igrave;nh khuyến mại d&agrave;nh ri&ecirc;ng cho kh&aacute;ch h&agrave;ng của Mytour.</span></p>', '<p>Giờ nhận ph&ograve;ng: 14:00Giờ trả ph&ograve;ng: 12:00</p>\n<dl style="box-sizing: border-box; margin-top: 0px; margin-bottom: 20px; line-height: 1.8em;">\n<dt style="box-sizing: border-box; line-height: 1.8em; font-weight: bold;">Ch&iacute;nh s&aacute;ch hủy:</dt>\n</dl>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với c&aacute;c đơn ph&ograve;ng nhỏ hơn 5 ph&ograve;ng:</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 03-07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 03 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">&bull; Đối với đơn ph&ograve;ng từ 5 ph&ograve;ng trở l&ecirc;n</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- Kh&ocirc;ng t&iacute;nh ph&iacute; hủy nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 50% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng b&aacute;o trước 07-15 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>\n<p style="box-sizing: border-box; margin: 0px 0px 10px;">- T&iacute;nh ph&iacute; 100% tổng số tiền đặt ph&ograve;ng nếu kh&aacute;ch h&agrave;ng hủy đặt ph&ograve;ng dưới 07 ng&agrave;y (t&iacute;nh từ ng&agrave;y đến).</p>', '1451115523_msh1392178568_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 5, 2, '2015-12-26 14:39:22', '2017-05-02 17:09:30', 'admin', '10.800504603670573', '106.62631640314942', 14, 10, NULL, 6, 0, 1, 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_type`
--

CREATE TABLE IF NOT EXISTS `hotel_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hotel_type`
--

INSERT INTO `hotel_type` (`id`, `name`, `status`, `deleted`) VALUES
(1, 'Khách sạn', 1, 0),
(2, 'Resort', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `image_tmp`
--

CREATE TABLE IF NOT EXISTS `image_tmp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` bigint(20) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=267 ;

--
-- Dumping data for table `image_tmp`
--

INSERT INTO `image_tmp` (`id`, `name`, `create_time`, `type`) VALUES
(1, '1451113159_medium_lcj1406087003_khach-san-moevenpi', 1451116760, 'hotel'),
(2, '1451113315erd1392178585_khach-san-moevenpick-sai-g', 1451116915, 'hotel'),
(3, '1451113318hab1392178597_khach-san-moevenpick-sai-g', 1451116918, 'hotel'),
(4, '1451113318ihs1392178605_khach-san-moevenpick-sai-g', 1451116918, 'hotel'),
(5, '1451113318izp1392178615_khach-san-moevenpick-sai-g', 1451116918, 'hotel'),
(6, '1451113322kqw1392178592_khach-san-moevenpick-sai-g', 1451116922, 'hotel'),
(7, '1451113322lrw1392178578_khach-san-moevenpick-sai-g', 1451116922, 'hotel'),
(8, '1451113322medium_lcj1406087003_khach-san-moevenpic', 1451116922, 'hotel'),
(9, '1451113322msh1392178568_khach-san-moevenpick-sai-g', 1451116922, 'hotel'),
(10, '1451113327qaz1392178516_khach-san-moevenpick-sai-g', 1451116927, 'hotel'),
(11, '1451113327rfw1392178481_khach-san-moevenpick-sai-g', 1451116927, 'hotel'),
(12, '1451113327ujv1392178494_khach-san-moevenpick-sai-g', 1451116927, 'hotel'),
(13, '1451113327ukg1392178502_khach-san-moevenpick-sai-g', 1451116927, 'hotel'),
(14, '1451113332vcy1392178488_khach-san-moevenpick-sai-g', 1451116932, 'hotel'),
(15, '1451113332xet1392178528_khach-san-moevenpick-sai-g', 1451116932, 'hotel'),
(16, '1451113332ypw1392178510_khach-san-moevenpick-sai-g', 1451116932, 'hotel'),
(17, '1451113477_ypw1392178510_khach-san-moevenpick-sai-', 1451117077, 'hotel'),
(18, '1451113819_ihs1392178605_khach-san-moevenpick-sai-', 1451117419, 'hotel'),
(19, '1451113860erd1392178585_khach-san-moevenpick-sai-g', 1451117460, 'hotel'),
(20, '1451113860hab1392178597_khach-san-moevenpick-sai-g', 1451117460, 'hotel'),
(21, '1451113860ihs1392178605_khach-san-moevenpick-sai-g', 1451117460, 'hotel'),
(22, '1451113860izp1392178615_khach-san-moevenpick-sai-g', 1451117460, 'hotel'),
(23, '1451113860kqw1392178592_khach-san-moevenpick-sai-g', 1451117460, 'hotel'),
(24, '1451113860lrw1392178578_khach-san-moevenpick-sai-g', 1451117460, 'hotel'),
(25, '1451113860medium_lcj1406087003_khach-san-moevenpic', 1451117460, 'hotel'),
(26, '1451113860msh1392178568_khach-san-moevenpick-sai-g', 1451117460, 'hotel'),
(27, '1451113866qaz1392178516_khach-san-moevenpick-sai-g', 1451117466, 'hotel'),
(28, '1451113866rfw1392178481_khach-san-moevenpick-sai-g', 1451117466, 'hotel'),
(29, '1451113866ujv1392178494_khach-san-moevenpick-sai-g', 1451117466, 'hotel'),
(30, '1451113866ukg1392178502_khach-san-moevenpick-sai-g', 1451117466, 'hotel'),
(31, '1451113866vcy1392178488_khach-san-moevenpick-sai-g', 1451117466, 'hotel'),
(32, '1451113866xet1392178528_khach-san-moevenpick-sai-g', 1451117466, 'hotel'),
(33, '1451113866ypw1392178510_khach-san-moevenpick-sai-g', 1451117466, 'hotel'),
(34, '1451113889_medium_lcj1406087003_khach-san-moevenpi', 1451117489, 'hotel'),
(35, '1451114035_izp1392178615_khach-san-moevenpick-sai-', 1451117635, 'hotel'),
(36, '1451114073erd1392178585_khach-san-moevenpick-sai-g', 1451117673, 'hotel'),
(37, '1451114073hab1392178597_khach-san-moevenpick-sai-g', 1451117673, 'hotel'),
(38, '1451114073ihs1392178605_khach-san-moevenpick-sai-g', 1451117673, 'hotel'),
(39, '1451114073izp1392178615_khach-san-moevenpick-sai-g', 1451117673, 'hotel'),
(40, '1451114073kqw1392178592_khach-san-moevenpick-sai-g', 1451117673, 'hotel'),
(41, '1451114073lrw1392178578_khach-san-moevenpick-sai-g', 1451117673, 'hotel'),
(42, '1451114073medium_lcj1406087003_khach-san-moevenpic', 1451117673, 'hotel'),
(43, '1451114073msh1392178568_khach-san-moevenpick-sai-g', 1451117673, 'hotel'),
(44, '1451114078qaz1392178516_khach-san-moevenpick-sai-g', 1451117678, 'hotel'),
(45, '1451114078rfw1392178481_khach-san-moevenpick-sai-g', 1451117678, 'hotel'),
(46, '1451114078ujv1392178494_khach-san-moevenpick-sai-g', 1451117678, 'hotel'),
(47, '1451114078ukg1392178502_khach-san-moevenpick-sai-g', 1451117678, 'hotel'),
(48, '1451114078vcy1392178488_khach-san-moevenpick-sai-g', 1451117678, 'hotel'),
(49, '1451114078xet1392178528_khach-san-moevenpick-sai-g', 1451117678, 'hotel'),
(50, '1451114079ypw1392178510_khach-san-moevenpick-sai-g', 1451117679, 'hotel'),
(51, '1451114098_erd1392178585_khach-san-moevenpick-sai-', 1451117698, 'hotel'),
(52, '1451114239_msh1392178568_khach-san-moevenpick-sai-', 1451117839, 'hotel'),
(53, '1451114271erd1392178585_khach-san-moevenpick-sai-g', 1451117871, 'hotel'),
(54, '1451114271hab1392178597_khach-san-moevenpick-sai-g', 1451117871, 'hotel'),
(55, '1451114271ihs1392178605_khach-san-moevenpick-sai-g', 1451117871, 'hotel'),
(56, '1451114271izp1392178615_khach-san-moevenpick-sai-g', 1451117871, 'hotel'),
(57, '1451114271kqw1392178592_khach-san-moevenpick-sai-g', 1451117871, 'hotel'),
(58, '1451114271lrw1392178578_khach-san-moevenpick-sai-g', 1451117871, 'hotel'),
(59, '1451114271medium_lcj1406087003_khach-san-moevenpic', 1451117871, 'hotel'),
(60, '1451114271msh1392178568_khach-san-moevenpick-sai-g', 1451117871, 'hotel'),
(61, '1451114276qaz1392178516_khach-san-moevenpick-sai-g', 1451117876, 'hotel'),
(62, '1451114276rfw1392178481_khach-san-moevenpick-sai-g', 1451117876, 'hotel'),
(63, '1451114276ujv1392178494_khach-san-moevenpick-sai-g', 1451117876, 'hotel'),
(64, '1451114276ukg1392178502_khach-san-moevenpick-sai-g', 1451117876, 'hotel'),
(65, '1451114276vcy1392178488_khach-san-moevenpick-sai-g', 1451117876, 'hotel'),
(66, '1451114276xet1392178528_khach-san-moevenpick-sai-g', 1451117876, 'hotel'),
(67, '1451114276ypw1392178510_khach-san-moevenpick-sai-g', 1451117876, 'hotel'),
(68, '1451114296_medium_lcj1406087003_khach-san-moevenpi', 1451117896, 'hotel'),
(69, '1451114467_vcy1392178488_khach-san-moevenpick-sai-', 1451118067, 'hotel'),
(70, '1451114507erd1392178585_khach-san-moevenpick-sai-g', 1451118107, 'hotel'),
(71, '1451114507hab1392178597_khach-san-moevenpick-sai-g', 1451118107, 'hotel'),
(72, '1451114507ihs1392178605_khach-san-moevenpick-sai-g', 1451118107, 'hotel'),
(73, '1451114507izp1392178615_khach-san-moevenpick-sai-g', 1451118107, 'hotel'),
(74, '1451114507kqw1392178592_khach-san-moevenpick-sai-g', 1451118107, 'hotel'),
(75, '1451114507lrw1392178578_khach-san-moevenpick-sai-g', 1451118107, 'hotel'),
(76, '1451114507medium_lcj1406087003_khach-san-moevenpic', 1451118107, 'hotel'),
(77, '1451114507msh1392178568_khach-san-moevenpick-sai-g', 1451118107, 'hotel'),
(78, '1451114511qaz1392178516_khach-san-moevenpick-sai-g', 1451118111, 'hotel'),
(79, '1451114511rfw1392178481_khach-san-moevenpick-sai-g', 1451118111, 'hotel'),
(80, '1451114511ujv1392178494_khach-san-moevenpick-sai-g', 1451118111, 'hotel'),
(81, '1451114512ukg1392178502_khach-san-moevenpick-sai-g', 1451118112, 'hotel'),
(82, '1451114512vcy1392178488_khach-san-moevenpick-sai-g', 1451118112, 'hotel'),
(83, '1451114512xet1392178528_khach-san-moevenpick-sai-g', 1451118112, 'hotel'),
(84, '1451114512ypw1392178510_khach-san-moevenpick-sai-g', 1451118112, 'hotel'),
(85, '1451114530_ihs1392178605_khach-san-moevenpick-sai-', 1451118130, 'hotel'),
(86, '1451114670_kqw1392178592_khach-san-moevenpick-sai-', 1451118270, 'hotel'),
(87, '1451114703erd1392178585_khach-san-moevenpick-sai-g', 1451118303, 'hotel'),
(88, '1451114703hab1392178597_khach-san-moevenpick-sai-g', 1451118303, 'hotel'),
(89, '1451114703ihs1392178605_khach-san-moevenpick-sai-g', 1451118303, 'hotel'),
(90, '1451114703izp1392178615_khach-san-moevenpick-sai-g', 1451118303, 'hotel'),
(91, '1451114703kqw1392178592_khach-san-moevenpick-sai-g', 1451118303, 'hotel'),
(92, '1451114704lrw1392178578_khach-san-moevenpick-sai-g', 1451118304, 'hotel'),
(93, '1451114704medium_lcj1406087003_khach-san-moevenpic', 1451118304, 'hotel'),
(94, '1451114704msh1392178568_khach-san-moevenpick-sai-g', 1451118304, 'hotel'),
(95, '1451114709qaz1392178516_khach-san-moevenpick-sai-g', 1451118309, 'hotel'),
(96, '1451114709rfw1392178481_khach-san-moevenpick-sai-g', 1451118309, 'hotel'),
(97, '1451114709ujv1392178494_khach-san-moevenpick-sai-g', 1451118309, 'hotel'),
(98, '1451114709ukg1392178502_khach-san-moevenpick-sai-g', 1451118309, 'hotel'),
(99, '1451114709vcy1392178488_khach-san-moevenpick-sai-g', 1451118309, 'hotel'),
(100, '1451114709xet1392178528_khach-san-moevenpick-sai-g', 1451118309, 'hotel'),
(101, '1451114709ypw1392178510_khach-san-moevenpick-sai-g', 1451118309, 'hotel'),
(102, '1451114726_qaz1392178516_khach-san-moevenpick-sai-', 1451118326, 'hotel'),
(103, '1451114883_ujv1392178494_khach-san-moevenpick-sai-', 1451118483, 'hotel'),
(104, '1451114913erd1392178585_khach-san-moevenpick-sai-g', 1451118513, 'hotel'),
(105, '1451114914hab1392178597_khach-san-moevenpick-sai-g', 1451118514, 'hotel'),
(106, '1451114914ihs1392178605_khach-san-moevenpick-sai-g', 1451118514, 'hotel'),
(107, '1451114914izp1392178615_khach-san-moevenpick-sai-g', 1451118514, 'hotel'),
(108, '1451114914kqw1392178592_khach-san-moevenpick-sai-g', 1451118514, 'hotel'),
(109, '1451114914lrw1392178578_khach-san-moevenpick-sai-g', 1451118514, 'hotel'),
(110, '1451114914medium_lcj1406087003_khach-san-moevenpic', 1451118514, 'hotel'),
(111, '1451114914msh1392178568_khach-san-moevenpick-sai-g', 1451118514, 'hotel'),
(112, '1451114918qaz1392178516_khach-san-moevenpick-sai-g', 1451118518, 'hotel'),
(113, '1451114919rfw1392178481_khach-san-moevenpick-sai-g', 1451118519, 'hotel'),
(114, '1451114919ujv1392178494_khach-san-moevenpick-sai-g', 1451118519, 'hotel'),
(115, '1451114919ukg1392178502_khach-san-moevenpick-sai-g', 1451118519, 'hotel'),
(116, '1451114919vcy1392178488_khach-san-moevenpick-sai-g', 1451118519, 'hotel'),
(117, '1451114919xet1392178528_khach-san-moevenpick-sai-g', 1451118519, 'hotel'),
(118, '1451114919ypw1392178510_khach-san-moevenpick-sai-g', 1451118519, 'hotel'),
(119, '1451114936_medium_lcj1406087003_khach-san-moevenpi', 1451118536, 'hotel'),
(120, '1451115130_erd1392178585_khach-san-moevenpick-sai-', 1451118730, 'hotel'),
(121, '1451115166erd1392178585_khach-san-moevenpick-sai-g', 1451118766, 'hotel'),
(122, '1451115166hab1392178597_khach-san-moevenpick-sai-g', 1451118766, 'hotel'),
(123, '1451115166ihs1392178605_khach-san-moevenpick-sai-g', 1451118766, 'hotel'),
(124, '1451115166izp1392178615_khach-san-moevenpick-sai-g', 1451118766, 'hotel'),
(125, '1451115166kqw1392178592_khach-san-moevenpick-sai-g', 1451118766, 'hotel'),
(126, '1451115166lrw1392178578_khach-san-moevenpick-sai-g', 1451118766, 'hotel'),
(127, '1451115166medium_lcj1406087003_khach-san-moevenpic', 1451118766, 'hotel'),
(128, '1451115166msh1392178568_khach-san-moevenpick-sai-g', 1451118766, 'hotel'),
(129, '1451115171qaz1392178516_khach-san-moevenpick-sai-g', 1451118771, 'hotel'),
(130, '1451115171rfw1392178481_khach-san-moevenpick-sai-g', 1451118771, 'hotel'),
(131, '1451115171ujv1392178494_khach-san-moevenpick-sai-g', 1451118771, 'hotel'),
(132, '1451115172ukg1392178502_khach-san-moevenpick-sai-g', 1451118772, 'hotel'),
(133, '1451115172vcy1392178488_khach-san-moevenpick-sai-g', 1451118772, 'hotel'),
(134, '1451115172xet1392178528_khach-san-moevenpick-sai-g', 1451118772, 'hotel'),
(135, '1451115172ypw1392178510_khach-san-moevenpick-sai-g', 1451118772, 'hotel'),
(136, '1451115217_xet1392178528_khach-san-moevenpick-sai-', 1451118817, 'hotel'),
(137, '1451115356_qaz1392178516_khach-san-moevenpick-sai-', 1451118956, 'hotel'),
(138, '1451115390erd1392178585_khach-san-moevenpick-sai-g', 1451118990, 'hotel'),
(139, '1451115390hab1392178597_khach-san-moevenpick-sai-g', 1451118990, 'hotel'),
(140, '1451115390ihs1392178605_khach-san-moevenpick-sai-g', 1451118990, 'hotel'),
(141, '1451115390izp1392178615_khach-san-moevenpick-sai-g', 1451118990, 'hotel'),
(142, '1451115390kqw1392178592_khach-san-moevenpick-sai-g', 1451118990, 'hotel'),
(143, '1451115390lrw1392178578_khach-san-moevenpick-sai-g', 1451118990, 'hotel'),
(144, '1451115390medium_lcj1406087003_khach-san-moevenpic', 1451118990, 'hotel'),
(145, '1451115390msh1392178568_khach-san-moevenpick-sai-g', 1451118990, 'hotel'),
(146, '1451115395qaz1392178516_khach-san-moevenpick-sai-g', 1451118995, 'hotel'),
(147, '1451115395rfw1392178481_khach-san-moevenpick-sai-g', 1451118995, 'hotel'),
(148, '1451115395ujv1392178494_khach-san-moevenpick-sai-g', 1451118995, 'hotel'),
(149, '1451115395ukg1392178502_khach-san-moevenpick-sai-g', 1451118995, 'hotel'),
(150, '1451115395vcy1392178488_khach-san-moevenpick-sai-g', 1451118995, 'hotel'),
(151, '1451115395xet1392178528_khach-san-moevenpick-sai-g', 1451118995, 'hotel'),
(152, '1451115395ypw1392178510_khach-san-moevenpick-sai-g', 1451118995, 'hotel'),
(153, '1451115414_medium_lcj1406087003_khach-san-moevenpi', 1451119014, 'hotel'),
(154, '1451115523_msh1392178568_khach-san-moevenpick-sai-', 1451119123, 'hotel'),
(155, '1451115556erd1392178585_khach-san-moevenpick-sai-g', 1451119156, 'hotel'),
(156, '1451115556hab1392178597_khach-san-moevenpick-sai-g', 1451119156, 'hotel'),
(157, '1451115556ihs1392178605_khach-san-moevenpick-sai-g', 1451119156, 'hotel'),
(158, '1451115556izp1392178615_khach-san-moevenpick-sai-g', 1451119156, 'hotel'),
(159, '1451115556kqw1392178592_khach-san-moevenpick-sai-g', 1451119156, 'hotel'),
(160, '1451115556lrw1392178578_khach-san-moevenpick-sai-g', 1451119156, 'hotel'),
(161, '1451115556medium_lcj1406087003_khach-san-moevenpic', 1451119156, 'hotel'),
(162, '1451115556msh1392178568_khach-san-moevenpick-sai-g', 1451119156, 'hotel'),
(163, '1451115560qaz1392178516_khach-san-moevenpick-sai-g', 1451119160, 'hotel'),
(164, '1451115560rfw1392178481_khach-san-moevenpick-sai-g', 1451119160, 'hotel'),
(165, '1451115560ujv1392178494_khach-san-moevenpick-sai-g', 1451119160, 'hotel'),
(166, '1451115560ukg1392178502_khach-san-moevenpick-sai-g', 1451119160, 'hotel'),
(167, '1451115560vcy1392178488_khach-san-moevenpick-sai-g', 1451119160, 'hotel'),
(168, '1451115560xet1392178528_khach-san-moevenpick-sai-g', 1451119160, 'hotel'),
(169, '1451115560ypw1392178510_khach-san-moevenpick-sai-g', 1451119160, 'hotel'),
(170, '1451115575_ihs1392178605_khach-san-moevenpick-sai-', 1451119175, 'hotel'),
(171, '1457337643_wkz1448244289_tour-du-li-ch-nha-trang-d', 1457341243, 'tour'),
(172, '1457337958btw1448244289_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(173, '1457337958cih1448244310_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(174, '1457337958cko1448244309_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(175, '1457337958fxn1448244289_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(176, '1457337958hsd1448244290_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(177, '1457337958msh1448244309_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(178, '1457337958mtp1448244290_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(179, '1457337958nhc1448244290_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(180, '1457337958nod1448244290_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(181, '1457337958oda1448244310_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(182, '1457337958vws1448244308_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(183, '1457337958wkz1448244289_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(184, '1457337958wlp1448244289_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(185, '1457337958xih1448244308_tour-du-li-ch-nha-trang-da', 1457341558, 'hotel'),
(186, '1457338962_nhc1448244290_tour-du-li-ch-nha-trang-d', 1457342562, 'tour'),
(187, '1457339026btw1448244289_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(188, '1457339026cih1448244310_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(189, '1457339026cko1448244309_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(190, '1457339026fxn1448244289_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(191, '1457339026hsd1448244290_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(192, '1457339026msh1448244309_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(193, '1457339026mtp1448244290_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(194, '1457339026nhc1448244290_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(195, '1457339026nod1448244290_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(196, '1457339026oda1448244310_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(197, '1457339026vws1448244308_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(198, '1457339026wkz1448244289_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(199, '1457339026wlp1448244289_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(200, '1457339026xih1448244308_tour-du-li-ch-nha-trang-da', 1457342626, 'hotel'),
(201, '1457339042_vws1448244308_tour-du-li-ch-nha-trang-d', 1457342642, 'tour'),
(202, '1457339078hsd1448244290_tour-du-li-ch-nha-trang-da', 1457342678, 'hotel'),
(203, '1457339078msh1448244309_tour-du-li-ch-nha-trang-da', 1457342678, 'hotel'),
(204, '1457339078mtp1448244290_tour-du-li-ch-nha-trang-da', 1457342678, 'hotel'),
(205, '1457339078nhc1448244290_tour-du-li-ch-nha-trang-da', 1457342678, 'hotel'),
(206, '1457339078nod1448244290_tour-du-li-ch-nha-trang-da', 1457342678, 'hotel'),
(207, '1457339078oda1448244310_tour-du-li-ch-nha-trang-da', 1457342678, 'hotel'),
(208, '1457339078vws1448244308_tour-du-li-ch-nha-trang-da', 1457342678, 'hotel'),
(209, '1457339079wkz1448244289_tour-du-li-ch-nha-trang-da', 1457342679, 'hotel'),
(210, '1457339079wlp1448244289_tour-du-li-ch-nha-trang-da', 1457342679, 'hotel'),
(211, '1457339079xih1448244308_tour-du-li-ch-nha-trang-da', 1457342679, 'hotel'),
(212, '1457339082btw1448244289_tour-du-li-ch-nha-trang-da', 1457342682, 'hotel'),
(213, '1457339082cih1448244310_tour-du-li-ch-nha-trang-da', 1457342682, 'hotel'),
(214, '1457339082cko1448244309_tour-du-li-ch-nha-trang-da', 1457342682, 'hotel'),
(215, '1457339082fxn1448244289_tour-du-li-ch-nha-trang-da', 1457342682, 'hotel'),
(216, '1457339137_mtp1448244290_tour-du-li-ch-nha-trang-d', 1457342737, 'tour'),
(217, '1457339185hsd1448244290_tour-du-li-ch-nha-trang-da', 1457342785, 'hotel'),
(218, '1457339185msh1448244309_tour-du-li-ch-nha-trang-da', 1457342785, 'hotel'),
(219, '1457339185mtp1448244290_tour-du-li-ch-nha-trang-da', 1457342785, 'hotel'),
(220, '1457339185nhc1448244290_tour-du-li-ch-nha-trang-da', 1457342785, 'hotel'),
(221, '1457339186nod1448244290_tour-du-li-ch-nha-trang-da', 1457342786, 'hotel'),
(222, '1457339186oda1448244310_tour-du-li-ch-nha-trang-da', 1457342786, 'hotel'),
(223, '1457339186vws1448244308_tour-du-li-ch-nha-trang-da', 1457342786, 'hotel'),
(224, '1457339186wkz1448244289_tour-du-li-ch-nha-trang-da', 1457342786, 'hotel'),
(225, '1457339186wlp1448244289_tour-du-li-ch-nha-trang-da', 1457342786, 'hotel'),
(226, '1457339186xih1448244308_tour-du-li-ch-nha-trang-da', 1457342786, 'hotel'),
(227, '1457339189btw1448244289_tour-du-li-ch-nha-trang-da', 1457342789, 'hotel'),
(228, '1457339189cih1448244310_tour-du-li-ch-nha-trang-da', 1457342789, 'hotel'),
(229, '1457339189cko1448244309_tour-du-li-ch-nha-trang-da', 1457342789, 'hotel'),
(230, '1457339189fxn1448244289_tour-du-li-ch-nha-trang-da', 1457342789, 'hotel'),
(231, '1457339225_xih1448244308_tour-du-li-ch-nha-trang-d', 1457342825, 'tour'),
(232, '1457339263hsd1448244290_tour-du-li-ch-nha-trang-da', 1457342863, 'hotel'),
(233, '1457339263msh1448244309_tour-du-li-ch-nha-trang-da', 1457342863, 'hotel'),
(234, '1457339263mtp1448244290_tour-du-li-ch-nha-trang-da', 1457342863, 'hotel'),
(235, '1457339263nhc1448244290_tour-du-li-ch-nha-trang-da', 1457342863, 'hotel'),
(236, '1457339264nod1448244290_tour-du-li-ch-nha-trang-da', 1457342864, 'hotel'),
(237, '1457339264oda1448244310_tour-du-li-ch-nha-trang-da', 1457342864, 'hotel'),
(238, '1457339264vws1448244308_tour-du-li-ch-nha-trang-da', 1457342864, 'hotel'),
(239, '1457339264wkz1448244289_tour-du-li-ch-nha-trang-da', 1457342864, 'hotel'),
(240, '1457339264wlp1448244289_tour-du-li-ch-nha-trang-da', 1457342864, 'hotel'),
(241, '1457339264xih1448244308_tour-du-li-ch-nha-trang-da', 1457342864, 'hotel'),
(242, '1457339267btw1448244289_tour-du-li-ch-nha-trang-da', 1457342867, 'hotel'),
(243, '1457339267cih1448244310_tour-du-li-ch-nha-trang-da', 1457342867, 'hotel'),
(244, '1457339267cko1448244309_tour-du-li-ch-nha-trang-da', 1457342867, 'hotel'),
(245, '1457339267fxn1448244289_tour-du-li-ch-nha-trang-da', 1457342867, 'hotel'),
(246, '1457339308_fxn1448244289_tour-du-li-ch-nha-trang-d', 1457342908, 'tour'),
(247, '1457339350hsd1448244290_tour-du-li-ch-nha-trang-da', 1457342950, 'hotel'),
(248, '1457339350msh1448244309_tour-du-li-ch-nha-trang-da', 1457342950, 'hotel'),
(249, '1457339350mtp1448244290_tour-du-li-ch-nha-trang-da', 1457342950, 'hotel'),
(250, '1457339350nhc1448244290_tour-du-li-ch-nha-trang-da', 1457342950, 'hotel'),
(251, '1457339350nod1448244290_tour-du-li-ch-nha-trang-da', 1457342950, 'hotel'),
(252, '1457339350oda1448244310_tour-du-li-ch-nha-trang-da', 1457342950, 'hotel'),
(253, '1457339350vws1448244308_tour-du-li-ch-nha-trang-da', 1457342950, 'hotel'),
(254, '1457339350wkz1448244289_tour-du-li-ch-nha-trang-da', 1457342950, 'hotel'),
(255, '1457339350wlp1448244289_tour-du-li-ch-nha-trang-da', 1457342950, 'hotel'),
(256, '1457339350xih1448244308_tour-du-li-ch-nha-trang-da', 1457342950, 'hotel'),
(257, '1457339353btw1448244289_tour-du-li-ch-nha-trang-da', 1457342953, 'hotel'),
(258, '1457339353cih1448244310_tour-du-li-ch-nha-trang-da', 1457342953, 'hotel'),
(259, '1457339353cko1448244309_tour-du-li-ch-nha-trang-da', 1457342953, 'hotel'),
(260, '1457339353fxn1448244289_tour-du-li-ch-nha-trang-da', 1457342953, 'hotel'),
(264, '1492699917_du-lich-kien-giang.jpg', 1492703517, 'news'),
(265, '1495809257_no-image.gif', 1495812857, 'province'),
(266, '1495809347_no-image.gif', 1495812947, 'national');

-- --------------------------------------------------------

--
-- Table structure for table `national`
--

CREATE TABLE IF NOT EXISTS `national` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `deleted` tinyint(1) NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `national`
--

INSERT INTO `national` (`id`, `name`, `status`, `description`, `deleted`, `picture`) VALUES
(2, 'Việt Nam', 1, NULL, 0, ''),
(3, 'Thái Lan', 1, '', 0, '1495809557_timthumb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`, `status`, `create_time`, `user_id`, `update_time`, `content`, `deleted`) VALUES
(8, 'Giới thiệu', 1, '2015-09-22 09:58:03', 1, '2015-09-22 09:58:03', '<p>Nội dung giới thiệu</p>', 0),
(9, 'Tuyển dụng', 1, '2015-09-22 09:58:32', 1, '2015-09-22 09:58:32', '<p>Nội dung tuyển dụng</p>', 0),
(10, 'Điều kiện & điều khoản', 1, '2015-09-22 09:59:24', 1, '2015-09-22 09:59:24', '<p>Nội dung điều kiện v&agrave; điều khoản</p>', 0),
(11, 'Chính sách riêng tư', 1, '2015-09-22 09:59:55', 1, '2015-09-22 09:59:55', '<p>Nội dung ch&iacute;nh s&aacute;ch ri&ecirc;ng tư</p>', 0),
(12, 'Chính sách bảo mật', 1, '2015-09-22 10:00:18', 1, '2015-09-22 10:00:18', '<p>Nội dung ch&iacute;nh s&aacute;ch bảo mật</p>', 0),
(13, 'Hỗ trợ', 1, '2015-09-22 10:00:42', 1, '2015-09-22 10:00:42', '<p>Nội dung Hỗ trợ</p>', 0),
(14, 'Liên hệ', 1, '2015-12-25 16:16:43', 1, '2015-12-25 16:16:43', '<p>Th&ocirc;ng tin li&ecirc;n hệ</p>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE IF NOT EXISTS `partner` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` float DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `deleted` tinyint(1) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`id`, `name`, `email`, `phone`, `username`, `password`, `status`, `create_time`, `update_time`, `update_by`, `user_id`, `description`, `deleted`, `group_id`) VALUES
(1, 'Test 1', 'test1@yahoo.com', '12345678', 'test1', '550e1bafe077ff0b0b67f4e32f29d751', 1, '2015-12-26 14:02:20', '2015-12-26 14:07:51', 'sale_hotel', 2, '<p>', 0, 1),
(2, 'Test 2', 'test2@yahoo.com', '12345678', 'test2', '550e1bafe077ff0b0b67f4e32f29d751', 1, '2015-12-26 14:11:09', '2015-12-26 14:13:01', 'sale_hotel', 2, '', 0, 1),
(3, 'Test 3', 'test3@yahoo.com', '12345678', 'test3', '550e1bafe077ff0b0b67f4e32f29d751', 1, '2015-12-26 14:14:42', '2015-12-26 14:16:50', 'sale_hotel', 2, '', 0, 1),
(4, 'Test 4', 'test4@yahoo.com', '12345678', 'test4', '550e1bafe077ff0b0b67f4e32f29d751', 1, '2015-12-26 14:17:58', '2015-12-26 14:19:52', 'sale_hotel', 2, '', 0, 1),
(5, 'Test 5', 'test5@yahoo.com', '12345678', 'test5', '550e1bafe077ff0b0b67f4e32f29d751', 1, '2015-12-26 14:21:55', '2015-12-26 14:23:44', 'sale_hotel', 2, '', 0, 1),
(6, 'Test 6', 'test6@yahoo.com', '12345678', 'test6', '550e1bafe077ff0b0b67f4e32f29d751', 1, '2015-12-26 14:25:11', '2015-12-26 14:27:18', 'sale_hotel', 2, '', 0, 1),
(7, 'Test 7', 'test7@yahoo.com', '12345678', 'test7', '550e1bafe077ff0b0b67f4e32f29d751', 1, '2015-12-26 14:28:41', '2015-12-26 14:30:45', 'sale_hotel', 2, '', 0, 1),
(8, 'Test 8', 'test8@yahoo.com', '12345678', 'test8', '550e1bafe077ff0b0b67f4e32f29d751', 1, '2015-12-26 14:32:55', '2015-12-26 14:35:03', 'sale_hotel', 2, '', 0, 1),
(9, 'Test 9', 'test9@yahoo.com', '12345678', 'test9', '550e1bafe077ff0b0b67f4e32f29d751', 1, '2015-12-26 14:36:39', '2015-12-26 14:38:19', 'sale_hotel', 2, '', 0, 1),
(10, 'Test 10', 'test10@yahoo.com', '12345678', 'test10', '1f32aa4c9a1d2ea010adcf2348166a04', 1, '2015-12-26 14:39:23', '2017-04-20 22:23:43', 'admin', 2, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `partner_group`
--

CREATE TABLE IF NOT EXISTS `partner_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `partner_group`
--

INSERT INTO `partner_group` (`id`, `name`, `description`, `deleted`) VALUES
(1, 'Level_1', 'Cho phép quản lý đơn hàng', 0);

-- --------------------------------------------------------

--
-- Table structure for table `partner_permission`
--

CREATE TABLE IF NOT EXISTS `partner_permission` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_partner_id` int(11) DEFAULT NULL,
  `group` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `controller` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `method` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `partner_permission`
--

INSERT INTO `partner_permission` (`id`, `group_partner_id`, `group`, `controller`, `method`) VALUES
(31, 1, 'partner_order_management', 'partner_order', 'index'),
(32, 1, 'partner_order_management', 'partner_order', 'edit');

-- --------------------------------------------------------

--
-- Table structure for table `partner_tour`
--

CREATE TABLE IF NOT EXISTS `partner_tour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `deleted` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `partner_tour`
--

INSERT INTO `partner_tour` (`id`, `name`, `phone`, `status`, `address`, `description`, `deleted`, `email`) VALUES
(1, 'CÔNG TY TNHH DU LỊCH SANG HIỀN NHA TRANG', 'HÀ NỘI: (04) 7109 9999 . HỒ CHÍ MINH: (08) 7309 9899', 1, '47 Hòn Lăng, Đắc Lộc, Vĩnh Phương , Nha Trang, Khánh Hòa. ', NULL, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `category_id`, `name`, `status`, `create_time`, `user_id`, `update_time`, `description`, `content`, `picture`, `deleted`) VALUES
(1, 1, 'Du Lịch Phú Quốc', 1, '2017-04-20 21:55:12', 1, '2017-04-20 21:55:12', '', '', '1492700109_du-lich-quang-ngai.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE IF NOT EXISTS `post_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `parent` int(11) NOT NULL,
  `description` text,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`id`, `name`, `status`, `parent`, `description`, `deleted`) VALUES
(1, 'Du Lịch Biển Đảo', 1, 0, '<p>abc</p>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `book_day_from` date DEFAULT NULL,
  `book_day_to` date DEFAULT NULL,
  `stay_day_from` date DEFAULT NULL,
  `stay_day_to` date DEFAULT NULL,
  `night` int(11) DEFAULT NULL,
  `policy` text COLLATE utf8_unicode_ci,
  `discount` float DEFAULT NULL,
  `room_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hotel_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_apply_from` date DEFAULT NULL,
  `date_apply_to` date DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `name`, `status`, `book_day_from`, `book_day_to`, `stay_day_from`, `stay_day_to`, `night`, `policy`, `discount`, `room_id`, `hotel_id`, `user_id`, `create_time`, `update_time`, `update_by`, `date_apply_from`, `date_apply_to`, `deleted`) VALUES
(3, '234', 1, '1900-12-12', '1900-12-13', '1900-12-14', '1900-12-23', 4234, '234234', 234234, ',23,', 30, 1, '2015-09-09 15:19:02', '2015-09-09 17:09:43', 'admin', '2015-09-09', '2015-09-10', 0),
(4, '5454', 1, '2015-09-09', '2015-09-10', '2015-09-17', '2015-09-18', 5, '585', 52, ',23,', 30, 1, '2015-09-09 16:07:40', '2015-09-09 16:42:46', 'admin', NULL, NULL, 0),
(5, 'Giảm 55% đến hết năm', 1, '2015-09-02', '2015-12-01', '2015-09-02', '2015-12-02', 1, '<p><span >Giữ nguyên chính sách hủy phòng của từng phòng.</span></p>', 55, ',30,', 36, 1, '2015-09-22 11:59:33', '2015-09-22 11:59:33', 'admin', '2015-09-02', '2015-12-01', 0),
(6, 'Giảm 55% đến hết năm', 1, '2015-09-02', '2015-12-01', '2015-09-02', '2015-12-01', 1, '<p>Giữ nguyên chính sách hủy phòng của từng phòng.</p>', 55, ',29,', 35, 1, '2015-09-22 12:01:56', '2015-09-23 14:28:05', 'product', '2015-09-01', '2015-12-01', 0),
(7, 'Giảm 55% đến hết năm 2', 1, '2015-09-01', '2016-02-01', '2015-09-01', '2016-02-01', 1, '<p>Giữ nguyên chính sách hủy phòng của từng phòng.</p>\r\n<p>Giữ nguyên chính sách hủy phòng của từng phòng.</p>\r\n<p>Giữ nguyên chính sách hủy phòng của từng phòng.</p>\r\n<p>Giữ nguyên chính sách hủy phòng của từng phòng.2</p>', 50, ',40,', 46, 2, '2015-09-23 14:29:28', '2015-12-23 19:44:13', 'admin', '2015-09-01', '2016-02-01', 0),
(8, 'Khuyến mãi 50%', 1, '2015-12-26', '2016-03-31', '2015-12-26', '2016-03-31', 1, '<p>Chính sách hủy của khuyến mãi</p>', 50, ',1,', 1, 2, '2015-12-26 14:09:17', '2015-12-26 14:41:52', 'product_hotel', '2015-12-26', '2016-03-31', 0),
(9, 'Khuyến mãi 40%', 1, '2015-12-26', '2016-03-31', '2015-12-26', '2016-03-31', 1, '<p>Chính sách hủy của khuyến mãi</p>', 40, ',4,', 4, 2, '2015-12-26 14:20:32', '2015-12-26 14:43:10', 'product_hotel', '2015-12-26', '2016-03-31', 0),
(10, 'Khuyến mãi 30%', 1, '2015-12-26', '2016-03-31', '2015-12-26', '2016-03-31', 1, '<p>Chính sách hủy của khuyến mãi</p>', 30, ',7,', 7, 2, '2015-12-26 14:31:31', '2015-12-26 14:44:14', 'product_hotel', '2015-12-26', '2016-03-31', 0),
(11, 'Khuyến mãi 30%', 1, '2017-04-15', '2017-04-30', '2017-04-15', '2017-04-30', 1, '', 30, ',10,', 10, 1, '2016-04-07 19:35:56', '2017-04-20 22:32:24', 'admin', '2017-04-15', '2017-04-30', 0),
(12, 'Khuyến mãi 20%', 1, '2016-04-21', '2016-04-30', '2016-04-21', '2016-04-30', 1, '', 20, ',9,', 9, 1, '2016-04-21 20:10:59', '2016-04-21 20:10:59', 'admin', '2016-04-21', '2016-04-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `promotion_tmp`
--

CREATE TABLE IF NOT EXISTS `promotion_tmp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `book_day_from` date DEFAULT NULL,
  `book_day_to` date DEFAULT NULL,
  `stay_day_from` date DEFAULT NULL,
  `stay_day_to` date DEFAULT NULL,
  `night` int(11) DEFAULT NULL,
  `policy` text COLLATE utf8_unicode_ci,
  `discount` float DEFAULT NULL,
  `room_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hotel_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_apply_from` date DEFAULT NULL,
  `date_apply_to` date DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `promotion_tmp`
--

INSERT INTO `promotion_tmp` (`id`, `name`, `status`, `book_day_from`, `book_day_to`, `stay_day_from`, `stay_day_to`, `night`, `policy`, `discount`, `room_id`, `hotel_id`, `user_id`, `create_time`, `update_time`, `update_by`, `date_apply_from`, `date_apply_to`, `deleted`) VALUES
(3, '234', 1, '1900-12-12', '1900-12-13', '1900-12-14', '1900-12-23', 4234, '234234', 234234, ',23,', 30, 1, '2015-09-09 15:19:02', '2015-09-09 17:09:43', 'admin', '2015-09-09', '2015-09-10', 0),
(4, '5454', 1, '2015-09-09', '2015-09-10', '2015-09-17', '2015-09-18', 5, '585', 52, ',23,', 30, 1, '2015-09-09 16:07:40', '2015-09-09 16:42:46', 'admin', NULL, NULL, 0),
(5, 'Giảm 55% đến hết năm', 1, '2015-09-02', '2015-12-01', '2015-09-02', '2015-12-02', 1, '<p><span >Giữ nguyên chính sách hủy phòng của từng phòng.</span></p>', 55, ',30,', 36, 1, '2015-09-22 11:59:33', '2015-09-22 11:59:33', 'admin', '2015-09-02', '2015-12-01', 0),
(6, 'Giảm 55% đến hết năm', 1, '2015-09-02', '2015-12-01', '2015-09-02', '2015-12-01', 1, '<p>Giữ nguyên chính sách hủy phòng của từng phòng.</p>', 55, ',29,', 35, 1, '2015-09-22 12:01:56', '2015-09-23 14:28:05', 'product', '2015-09-01', '2015-12-01', 0),
(7, 'Giảm 55% đến hết năm 2', 1, '2015-09-01', '2016-02-01', '2015-09-01', '2016-02-01', 1, '<p>Giữ nguyên chính sách hủy phòng của từng phòng.</p>\r\n<p>Giữ nguyên chính sách hủy phòng của từng phòng.</p>\r\n<p>Giữ nguyên chính sách hủy phòng của từng phòng.</p>\r\n<p>Giữ nguyên chính sách hủy phòng của từng phòng.2</p>', 50, ',40,', 46, 2, '2015-09-23 14:29:28', '2015-12-23 19:44:13', 'admin', '2015-09-01', '2016-02-01', 0),
(8, 'Khuyến mãi 50%', 1, '2015-12-26', '2016-03-31', '2015-12-26', '2016-03-31', 1, '<p>Chính sách hủy của khuyến mãi</p>', 50, ',1,', 1, 2, '2015-12-26 14:09:17', '2015-12-26 14:41:52', 'product_hotel', '2015-12-26', '2016-03-31', 0),
(9, 'Khuyến mãi 40%', 1, '2015-12-26', '2016-03-31', '2015-12-26', '2016-03-31', 1, '<p>Chính sách hủy của khuyến mãi</p>', 40, ',4,', 4, 2, '2015-12-26 14:20:32', '2015-12-26 14:43:10', 'product_hotel', '2015-12-26', '2016-03-31', 0),
(10, 'Khuyến mãi 30%', 1, '2015-12-26', '2016-03-31', '2015-12-26', '2016-03-31', 1, '<p>Chính sách hủy của khuyến mãi</p>', 30, ',7,', 7, 2, '2015-12-26 14:31:31', '2015-12-26 14:44:14', 'product_hotel', '2015-12-26', '2016-03-31', 0),
(11, 'Khuyến mãi 30%', 1, '2017-04-15', '2017-04-30', '2017-04-15', '2017-04-30', 1, '', 30, ',10,', 10, 1, '2016-04-07 19:35:56', '2017-04-20 22:32:24', 'admin', '2017-04-15', '2017-04-30', 0),
(12, 'Khuyến mãi 20%', 1, '2016-04-21', '2016-04-30', '2016-04-21', '2016-04-30', 1, '', 20, ',9,', 9, 1, '2016-04-21 20:10:59', '2016-04-21 20:10:59', 'admin', '2016-04-21', '2016-04-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(30) NOT NULL,
  `national_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `description` text,
  `common` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=126 ;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `name`, `type`, `national_id`, `area_id`, `status`, `picture`, `description`, `common`, `deleted`) VALUES
(98, 'Hồ Chí Minh', 'Thành Phố', 2, 3, 1, '1443257749_undefined-4.jpg', '<p>Hồ Chí Minh là thành phố đông dân nhất, đồng thời là trung tâm kinh tế, văn hóa, giáo dục của Việt Nam. Hồ Chí Minh có nhiều điểm du lịch như chợ Bến Thành, nhà thờ Đức Bà, suối Tiên, địa đạo Củ Chi. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Hồ Chí Minh ngay bây giờ với giá từ 235,000 VND.</p>', 1, 0),
(99, 'Hà Nội', 'Thành Phố', 2, 1, 1, '1440599550_medium_rtm1410926750.JPG', '<p>Hà Nội là trung tâm văn hóa, kinh tế, giáo dục của cả miền Bắc, là nơi có dấu ấn lịch sử lâu đời như phố cổ Hà Nội, chùa Một Cột, Hồ Gươm, thành cổ Thăng Long, lăng chủ tịch Hồ Chí Minh, cầu Long Biên. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Hà Nội ngay bây giờ với giá từ 152,000 VND.</p>', 0, 0),
(100, 'Đà Nẵng', 'Thành Phố', 2, 2, 1, '1443257506_undefined.jpg', '<p><strong>Đà Nẵng</strong> là trung tâm kinh tế, văn hoá, giáo dục, khoa học và công nghệ lớn của miền Trung. Vốn nổi tiếng với các địa điểm du lịch như: Ngũ hành sơn, Chùa Linh Ứng, núi Bà Nà, Bãi Biển Mỹ Khê… Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Đà Nẵng ngay bây giờ với giá từ 224,000 VND.</p>', 1, 0),
(114, 'Nha Trang', 'Thành Phố', 2, 3, 1, '1443257623_undefined-1.jpg', '<p>Khánh Hòa là một trong những trung tâm du lịch lớn của Việt Nam. Nơi đây có nhiều vịnh biển đẹp, biển đảo, du lịch tham quan - vãn cảnh, du lịch văn hóa như Vân Trang, Cam Ranh, Nha Trang. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Khánh Hòa ngay bây giờ với giá từ 189,000 VND</p>', 1, 0),
(115, 'Vũng tàu', 'Thành Phố', 2, 3, 1, '1442845566_medium_bxx1410927330.jpg', '<p><span >Bà Rịa - Vũng Tàu là một tỉnh cửa ngõ ra biển Đông. Nơi đây được biết đến với các địa điểm du lịch nổi tiếng Bạch Dinh, Tượng chúa Kito, suối nước nóng Bình Châu, ngọn Hải Đăng… Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Bà Rịa - Vũng Tàu ngay bây giờ với giá từ 171,000 VND.</span></p>', NULL, 0),
(116, 'Phan thiết', 'Thành Phố', 2, 3, 1, '1442845627_medium_bra1410924494.jpg', '<p><span >Bình Thuận là một trong những trung tâm du lịch trọng điểm của Việt Nam hiện nay. Nơi đây nổi tiếng với nhiều địa điểm du lịch hấp dẫn như: Hải Đăng Kê Gà, Mũi Né, Tháp Chàm Poshanư, núi Tà Cú… Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Bình Thuận ngay bây giờ với giá từ 235,200 VND.</span></p>', NULL, 0),
(117, 'Phú Quốc', 'Thành Phố', 2, 3, 1, '1443257706_phuquoc.jpg', '<p>Nằm tận cùng về phía tây nam của Việt Nam, Kiên Giang nổi tiếng với đảo Phú Quốc - đảo ngọc hoang sơ thơ mộng. Những danh thắng nơi đây như: chùa Hang; khu dự trữ sinh quyển ven biển và biển đảo Kiên Giang. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Kiên Giang ngay bây giờ với giá từ 220,000 VND.</p>', 1, 0),
(118, 'Hạ Long', 'Thành Phố', 2, 3, 1, '1442845802_medium_ddu1410861929.jpg', '<p><span >Quảng Ninh là một địa danh giàu tiềm năng du lịch. Không ai lạ gì với danh thắng Vịnh Hạ Long của nơi đây, ngoài ra còn có những địa danh như quần đảo Vân Đồn, núi Yên Tử không kém phần xinh đẹp. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Quảng Ninh ngay bây giờ với giá từ 300,000 VND.</span></p>', NULL, 0),
(119, 'Hội An', 'Tỉnh', 2, 2, 1, '1443257727_undefined-5.jpg', '<p>Quảng Nam thuộc Duyên Hải Nam Trung Bộ là nơi lưu giữ nhiều dấu tích của nền Văn hóa Chămpa. Quảng Nam nổi tiếng với hai di sản văn hóa thế giới là Hội An và Mỹ Sơn, ngoài ra còn có biển Cửa Đại và Cù lao Chàm. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Quảng Nam ngay bây giờ với giá từ 330,000 VND.</p>', 1, 0),
(120, 'Sapa', 'Tỉnh', 2, 1, 1, '1442846127_medium_ttg1410920786.jpg', '<p><span >Lào Cai là tỉnh vùng cao phía Bắc Việt Nam. Lào Cai là nơi có những di tích lịch sử cũng như thắng cảnh nổi tiếng như di tích trạm khắc đá cổ ở thung lũng Mường Hoa, đền Thượng, khu du lịch SaPa, đỉnh Phanxipang… Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Lào Cai ngay bây giờ với giá từ 280,000 VND.</span></p>', NULL, 0),
(121, 'Ninh Bình', 'Thành Phố', 2, 1, 1, '1442846193_medium_sor1410862076.jpg', '<p><span >Ninh Bình nằm ở cửa ngõ cực nam miền Bắc. Ninh Bình là một trung tâm du lịch của vùng và cả nước với khu du lịch quốc gia và 2 trọng điểm du lịch: vườn quốc gia Cúc Phương, khu bảo tồn thiên nhiên Vân Long. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Ninh Bình ngay bây giờ với giá từ 255,000 VND.</span></p>', NULL, 0),
(122, 'Đà Lạt', 'Thành Phố', 2, 3, 1, '1443257644_undefined-2.jpg', '<p>Thành phố Đà Lạt là trung tâm kinh tế, chính trị của tỉnh Lâm Đồng, nằm trên cao nguyên Lâm Viên và là một điểm du lịch rất nổi tiếng. Các điểm đến như: hồ Xuân Hương, đồi Cù, thung lũng Tình Yêu, hồ Than Thở... Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Đà Lạt ngay bây giờ với giá từ 90,000 VND.</p>', 1, 0),
(123, 'Huế', 'Thành Phố', 2, 2, 1, '1442846310_medium_lnd1410861981.jpg', '<p><span >Thành phố Huế đa dạng về cảnh quan thiên nhiên và là nơi lý tưởng để du lịch tham quan. Nơi đây nổi tiếng với: nhà vườn Ngọc Sơn Công Chúa, Tịnh Gia Viên, phố cổ Gia Hội - Chi Lăng, phố đêm Bạch Đằn, song Hương. Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Thành phố Huế ngay bây giờ với giá từ 115,000 VND.</span></p>', 0, 0),
(124, 'Gia Lai', 'Thành Phố', 2, 3, 1, '1442846359_medium_ddu1410861929.jpg', '<p><span >Gia Lai là tỉnh miền núi Tây Nguyên, hấp dẫn du khách bằng vẻ đẹp thiên nhiên hùng vĩ như Biển Hồ, cổng trời Mang Yang, đỉnh Hàm Rồng,… còn có nền văn hoá lâu đời của các đồng bào dân tộc.Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn Gia Lai ngay bây giờ với giá từ 376,000 VND.</span></p>', 0, 0),
(125, 'Bangkok', 'Thành Phố', 3, 4, 1, '1492664127_du-lich-an-giang.jpg', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_price`
--

CREATE TABLE IF NOT EXISTS `room_price` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `room_id` bigint(20) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `price_origin` bigint(20) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `hotel_id` bigint(20) DEFAULT NULL,
  `hide_price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `room_price`
--

INSERT INTO `room_price` (`id`, `room_id`, `day`, `price_origin`, `price`, `hotel_id`, `hide_price`, `status`, `deleted`) VALUES
(1, 1, '1', 500000, 600000, 1, 0, 1, 0),
(2, 1, '2', 500000, 600000, 1, 0, 1, 0),
(3, 1, '3', 500000, 600000, 1, 0, 1, 0),
(4, 1, '4', 500000, 600000, 1, 0, 1, 0),
(5, 1, '5', 500000, 600000, 1, 0, 1, 0),
(6, 1, '6', 600000, 800000, 1, 0, 1, 0),
(7, 1, '7', 500000, 600000, 1, 0, 1, 0),
(8, 1, '8', 800000, 1000000, 1, 0, 1, 0),
(9, 2, '1', 500000, 600000, 2, 0, 1, 0),
(10, 2, '2', 500000, 600000, 2, 0, 1, 0),
(11, 2, '3', 500000, 600000, 2, 0, 1, 0),
(12, 2, '4', 500000, 600000, 2, 0, 1, 0),
(13, 2, '5', 500000, 600000, 2, 0, 1, 0),
(14, 2, '6', 500000, 600000, 2, 0, 1, 0),
(15, 2, '7', 500000, 600000, 2, 0, 1, 0),
(16, 2, '8', 500000, 600000, 2, 0, 1, 0),
(17, 3, '1', 500000, 600000, 3, 0, 1, 0),
(18, 3, '2', 500000, 600000, 3, 0, 1, 0),
(19, 3, '3', 500000, 600000, 3, 0, 1, 0),
(20, 3, '4', 500000, 600000, 3, 0, 1, 0),
(21, 3, '5', 500000, 600000, 3, 0, 1, 0),
(22, 3, '6', 500000, 600000, 3, 0, 1, 0),
(23, 3, '7', 500000, 600000, 3, 0, 1, 0),
(24, 3, '8', 500000, 600000, 3, 0, 1, 0),
(25, 4, '1', 500000, 600000, 4, 0, 1, 0),
(26, 4, '2', 500000, 600000, 4, 0, 1, 0),
(27, 4, '3', 500000, 600000, 4, 0, 1, 0),
(28, 4, '4', 500000, 600000, 4, 0, 1, 0),
(29, 4, '5', 500000, 600000, 4, 0, 1, 0),
(30, 4, '6', 500000, 600000, 4, 0, 1, 0),
(31, 4, '7', 500000, 600000, 4, 0, 1, 0),
(32, 4, '8', 500000, 600000, 4, 0, 1, 0),
(33, 5, '1', 500000, 600000, 5, 0, 1, 0),
(34, 5, '2', 500000, 600000, 5, 0, 1, 0),
(35, 5, '3', 500000, 600000, 5, 0, 1, 0),
(36, 5, '4', 500000, 600000, 5, 0, 1, 0),
(37, 5, '5', 500000, 600000, 5, 0, 1, 0),
(38, 5, '6', 500000, 600000, 5, 0, 1, 0),
(39, 5, '7', 500000, 600000, 5, 0, 1, 0),
(40, 5, '8', 500000, 600000, 5, 0, 1, 0),
(41, 6, '1', 500000, 600000, 6, 0, 1, 0),
(42, 6, '2', 500000, 600000, 6, 0, 1, 0),
(43, 6, '3', 500000, 600000, 6, 0, 1, 0),
(44, 6, '4', 500000, 600000, 6, 0, 1, 0),
(45, 6, '5', 500000, 600000, 6, 0, 1, 0),
(46, 6, '6', 500000, 600000, 6, 0, 1, 0),
(47, 6, '7', 500000, 600000, 6, 0, 1, 0),
(48, 6, '8', 500000, 600000, 6, 0, 1, 0),
(49, 7, '1', 500000, 600000, 7, 0, 1, 0),
(50, 7, '2', 500000, 600000, 7, 0, 1, 0),
(51, 7, '3', 500000, 600000, 7, 0, 1, 0),
(52, 7, '4', 500000, 600000, 7, 0, 1, 0),
(53, 7, '5', 500000, 600000, 7, 0, 1, 0),
(54, 7, '6', 500000, 600000, 7, 0, 1, 0),
(55, 7, '7', 500000, 600000, 7, 0, 1, 0),
(56, 7, '8', 500000, 600000, 7, 0, 1, 0),
(57, 8, '1', 50, 55, 8, 0, 1, 0),
(58, 8, '2', 50, 55, 8, 0, 1, 0),
(59, 8, '3', 50, 55, 8, 0, 1, 0),
(60, 8, '4', 50, 55, 8, 0, 1, 0),
(61, 8, '5', 50, 55, 8, 0, 1, 0),
(62, 8, '6', 50, 55, 8, 0, 1, 0),
(63, 8, '7', 50, 55, 8, 0, 1, 0),
(64, 8, '8', 50, 55, 8, 0, 1, 0),
(65, 9, '1', 500000, 600000, 9, 0, 1, 0),
(66, 9, '2', 500000, 600000, 9, 0, 1, 0),
(67, 9, '3', 500000, 600000, 9, 0, 1, 0),
(68, 9, '4', 500000, 600000, 9, 0, 1, 0),
(69, 9, '5', 500000, 600000, 9, 0, 1, 0),
(70, 9, '6', 500000, 600000, 9, 0, 1, 0),
(71, 9, '7', 500000, 600000, 9, 0, 1, 0),
(72, 9, '8', 500000, 1200000, 9, 0, 1, 0),
(73, 10, '1', 1100000, 1400000, 10, 0, 1, 1),
(74, 10, '2', 1100000, 1400000, 10, 0, 1, 1),
(75, 10, '3', 1100000, 1400000, 10, 0, 1, 1),
(76, 10, '4', 1100000, 1400000, 10, 0, 1, 1),
(77, 10, '5', 1100000, 1400000, 10, 0, 1, 1),
(78, 10, '6', 1130000, 1600000, 10, 0, 1, 1),
(79, 10, '7', 1100000, 1400000, 10, 0, 1, 1),
(80, 10, '8', 2000000, 2500000, 10, 0, 1, 1),
(81, 11, '1', 1100000, 1400000, 10, 1, 1, 0),
(82, 11, '2', 1100000, 1400000, 10, 1, 1, 0),
(83, 11, '3', 1100000, 1400000, 10, 1, 1, 0),
(84, 11, '4', 1100000, 1400000, 10, 1, 1, 0),
(85, 11, '5', 1100000, 1400000, 10, 1, 1, 0),
(86, 11, '6', 1400000, 1800000, 10, 1, 1, 0),
(87, 11, '7', 1100000, 1400000, 10, 1, 1, 0),
(88, 11, '8', 1800000, 2200000, 10, 1, 1, 0),
(89, 12, '1', 1000000, 1300000, 10, 0, 1, 0),
(90, 12, '2', 1000000, 1300000, 10, 0, 1, 0),
(91, 12, '3', 1000000, 1300000, 10, 0, 1, 0),
(92, 12, '4', 1000000, 1300000, 10, 0, 1, 0),
(93, 12, '5', 1000000, 1300000, 10, 0, 1, 0),
(94, 12, '6', 1200000, 1800000, 10, 0, 1, 0),
(95, 12, '7', 1000000, 1300000, 10, 0, 1, 0),
(96, 12, '8', 1500000, 1900000, 10, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_price_stage`
--

CREATE TABLE IF NOT EXISTS `room_price_stage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `price_origin` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `hotel_id` bigint(20) DEFAULT NULL,
  `room_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `room_price_stage`
--

INSERT INTO `room_price_stage` (`id`, `date_from`, `date_to`, `price_origin`, `price`, `hotel_id`, `room_id`) VALUES
(11, '2017-05-06', '2017-05-07', 700000, 900000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_price_stage_tmp`
--

CREATE TABLE IF NOT EXISTS `room_price_stage_tmp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `price_origin` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `hotel_id` bigint(20) DEFAULT NULL,
  `room_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `room_price_stage_tmp`
--

INSERT INTO `room_price_stage_tmp` (`id`, `date_from`, `date_to`, `price_origin`, `price`, `hotel_id`, `room_id`) VALUES
(11, '2017-05-06', '2017-05-07', 700000, 900000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_price_tmp`
--

CREATE TABLE IF NOT EXISTS `room_price_tmp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `room_id` bigint(20) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `price_origin` bigint(20) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `hotel_id` bigint(20) DEFAULT NULL,
  `hide_price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `room_price_tmp`
--

INSERT INTO `room_price_tmp` (`id`, `room_id`, `day`, `price_origin`, `price`, `hotel_id`, `hide_price`, `status`, `deleted`) VALUES
(1, 1, '1', 500000, 600000, 1, 0, 1, 0),
(2, 1, '2', 500000, 600000, 1, 0, 1, 0),
(3, 1, '3', 500000, 600000, 1, 0, 1, 0),
(4, 1, '4', 500000, 600000, 1, 0, 1, 0),
(5, 1, '5', 500000, 600000, 1, 0, 1, 0),
(6, 1, '6', 600000, 800000, 1, 0, 1, 0),
(7, 1, '7', 500000, 600000, 1, 0, 1, 0),
(8, 1, '8', 800000, 1000000, 1, 0, 1, 0),
(9, 2, '1', 500000, 600000, 2, 0, 1, 0),
(10, 2, '2', 500000, 600000, 2, 0, 1, 0),
(11, 2, '3', 500000, 600000, 2, 0, 1, 0),
(12, 2, '4', 500000, 600000, 2, 0, 1, 0),
(13, 2, '5', 500000, 600000, 2, 0, 1, 0),
(14, 2, '6', 500000, 600000, 2, 0, 1, 0),
(15, 2, '7', 500000, 600000, 2, 0, 1, 0),
(16, 2, '8', 500000, 600000, 2, 0, 1, 0),
(17, 3, '1', 500000, 600000, 3, 0, 1, 0),
(18, 3, '2', 500000, 600000, 3, 0, 1, 0),
(19, 3, '3', 500000, 600000, 3, 0, 1, 0),
(20, 3, '4', 500000, 600000, 3, 0, 1, 0),
(21, 3, '5', 500000, 600000, 3, 0, 1, 0),
(22, 3, '6', 500000, 600000, 3, 0, 1, 0),
(23, 3, '7', 500000, 600000, 3, 0, 1, 0),
(24, 3, '8', 500000, 600000, 3, 0, 1, 0),
(25, 4, '1', 500000, 600000, 4, 0, 1, 0),
(26, 4, '2', 500000, 600000, 4, 0, 1, 0),
(27, 4, '3', 500000, 600000, 4, 0, 1, 0),
(28, 4, '4', 500000, 600000, 4, 0, 1, 0),
(29, 4, '5', 500000, 600000, 4, 0, 1, 0),
(30, 4, '6', 500000, 600000, 4, 0, 1, 0),
(31, 4, '7', 500000, 600000, 4, 0, 1, 0),
(32, 4, '8', 500000, 600000, 4, 0, 1, 0),
(33, 5, '1', 500000, 600000, 5, 0, 1, 0),
(34, 5, '2', 500000, 600000, 5, 0, 1, 0),
(35, 5, '3', 500000, 600000, 5, 0, 1, 0),
(36, 5, '4', 500000, 600000, 5, 0, 1, 0),
(37, 5, '5', 500000, 600000, 5, 0, 1, 0),
(38, 5, '6', 500000, 600000, 5, 0, 1, 0),
(39, 5, '7', 500000, 600000, 5, 0, 1, 0),
(40, 5, '8', 500000, 600000, 5, 0, 1, 0),
(41, 6, '1', 500000, 600000, 6, 0, 1, 0),
(42, 6, '2', 500000, 600000, 6, 0, 1, 0),
(43, 6, '3', 500000, 600000, 6, 0, 1, 0),
(44, 6, '4', 500000, 600000, 6, 0, 1, 0),
(45, 6, '5', 500000, 600000, 6, 0, 1, 0),
(46, 6, '6', 500000, 600000, 6, 0, 1, 0),
(47, 6, '7', 500000, 600000, 6, 0, 1, 0),
(48, 6, '8', 500000, 600000, 6, 0, 1, 0),
(49, 7, '1', 500000, 600000, 7, 0, 1, 0),
(50, 7, '2', 500000, 600000, 7, 0, 1, 0),
(51, 7, '3', 500000, 600000, 7, 0, 1, 0),
(52, 7, '4', 500000, 600000, 7, 0, 1, 0),
(53, 7, '5', 500000, 600000, 7, 0, 1, 0),
(54, 7, '6', 500000, 600000, 7, 0, 1, 0),
(55, 7, '7', 500000, 600000, 7, 0, 1, 0),
(56, 7, '8', 500000, 600000, 7, 0, 1, 0),
(57, 8, '1', 50, 55, 8, 0, 1, 0),
(58, 8, '2', 50, 55, 8, 0, 1, 0),
(59, 8, '3', 50, 55, 8, 0, 1, 0),
(60, 8, '4', 50, 55, 8, 0, 1, 0),
(61, 8, '5', 50, 55, 8, 0, 1, 0),
(62, 8, '6', 50, 55, 8, 0, 1, 0),
(63, 8, '7', 50, 55, 8, 0, 1, 0),
(64, 8, '8', 50, 55, 8, 0, 1, 0),
(65, 9, '1', 500000, 600000, 9, 0, 1, 0),
(66, 9, '2', 500000, 600000, 9, 0, 1, 0),
(67, 9, '3', 500000, 600000, 9, 0, 1, 0),
(68, 9, '4', 500000, 600000, 9, 0, 1, 0),
(69, 9, '5', 500000, 600000, 9, 0, 1, 0),
(70, 9, '6', 500000, 600000, 9, 0, 1, 0),
(71, 9, '7', 500000, 600000, 9, 0, 1, 0),
(72, 9, '8', 500000, 1200000, 9, 0, 1, 0),
(73, 10, '1', 1100000, 1400000, 10, 0, 1, 1),
(74, 10, '2', 1100000, 1400000, 10, 0, 1, 1),
(75, 10, '3', 1100000, 1400000, 10, 0, 1, 1),
(76, 10, '4', 1100000, 1400000, 10, 0, 1, 1),
(77, 10, '5', 1100000, 1400000, 10, 0, 1, 1),
(78, 10, '6', 1130000, 1600000, 10, 0, 1, 1),
(79, 10, '7', 1100000, 1400000, 10, 0, 1, 1),
(80, 10, '8', 2000000, 2500000, 10, 0, 1, 1),
(81, 11, '1', 1100000, 1400000, 10, 1, 1, 0),
(82, 11, '2', 1100000, 1400000, 10, 1, 1, 0),
(83, 11, '3', 1100000, 1400000, 10, 1, 1, 0),
(84, 11, '4', 1100000, 1400000, 10, 1, 1, 0),
(85, 11, '5', 1100000, 1400000, 10, 1, 1, 0),
(86, 11, '6', 1400000, 1800000, 10, 1, 1, 0),
(87, 11, '7', 1100000, 1400000, 10, 1, 1, 0),
(88, 11, '8', 1800000, 2200000, 10, 1, 1, 0),
(89, 12, '1', 1000000, 1300000, 10, 0, 1, 0),
(90, 12, '2', 1000000, 1300000, 10, 0, 1, 0),
(91, 12, '3', 1000000, 1300000, 10, 0, 1, 0),
(92, 12, '4', 1000000, 1300000, 10, 0, 1, 0),
(93, 12, '5', 1000000, 1300000, 10, 0, 1, 0),
(94, 12, '6', 1200000, 1800000, 10, 0, 1, 0),
(95, 12, '7', 1000000, 1300000, 10, 0, 1, 0),
(96, 12, '8', 1500000, 1900000, 10, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE IF NOT EXISTS `room_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `hotel_id` bigint(20) DEFAULT NULL,
  `facilities_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `policy` text COLLATE utf8_unicode_ci,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot` int(11) DEFAULT NULL,
  `slot_child` int(11) DEFAULT NULL,
  `holiday` text COLLATE utf8_unicode_ci,
  `bed_more` int(11) DEFAULT NULL,
  `bed_more_price` float(20,0) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `room_number` int(11) DEFAULT NULL,
  `hide_price` int(11) NOT NULL,
  `price_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `name`, `status`, `hotel_id`, `facilities_id`, `description`, `policy`, `type`, `size`, `bed`, `picture`, `user_id`, `update_time`, `create_time`, `update_by`, `slot`, `slot_child`, `holiday`, `bed_more`, `bed_more_price`, `deleted`, `room_number`, `hide_price`, `price_type`) VALUES
(1, 'DELUXE DOUBLE/TWIN', 1, 1, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', '1 giường đôi / 2 giường đơn', '38m2', '1 giường đôi / 2 giường đơn', '1451113477_ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2017-05-03 17:37:41', '2015-12-26 14:06:57', 'admin', 2, 1, '30/04,01/05', 1, 150000, 0, 10, 0, 'vnd'),
(2, 'DELUXE NO BREAKFAST', 1, 2, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy của ph&ograve;ng</p>', '2 giường đơn', '20m2', '2 giường đơn', '1451113889_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:42:10', '2015-12-26 14:12:27', 'product_hotel', 2, 1, '30/04,01/05', 0, 0, 0, 5, 0, 'vnd'),
(3, 'PHÒNG STANDARD DOUBLE', 1, 3, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng biển', '35m2', '1 giường đôi', '1451114098_erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:42:43', '2015-12-26 14:16:25', 'product_hotel', 2, 0, '30/04,01/05', 1, 150000, 0, 5, 0, 'vnd'),
(4, 'SINGLE ROOM', 1, 4, ',2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng thành phồ', '20m2', '1 giường đơn', '1451114296_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:43:05', '2015-12-26 14:19:29', 'product_hotel', 1, 0, '30/04,01/05', 0, 0, 0, 5, 0, 'vnd'),
(5, 'STANDARD DOUBLE', 1, 5, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng biển', '30m2', '1 giường đôi', '1451114530_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:43:31', '2015-12-26 14:23:11', 'product_hotel', 2, 1, '30/04,01/05', 1, 150000, 0, 10, 0, 'vnd'),
(6, 'STANDARD DOUBLE', 1, 6, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng thành phố', '20m2', '1 giường đôi', '1451114726_qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:43:37', '2015-12-26 14:26:53', 'product_hotel', 2, 0, '30/04,01/05', 1, 150000, 0, 5, 0, 'vnd'),
(7, 'STANDARD', 1, 7, ',1,2,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng biển', '20m2', '1 giường đôi', '1451114936_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:44:10', '2015-12-26 14:30:19', 'product_hotel', 2, 0, '30/04,01/05', 0, 0, 0, 7, 0, 'vnd'),
(8, 'Standard', 1, 8, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng thành phố', '20m2', '1 giường đơn', '1451115217_xet1392178528_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:44:19', '2015-12-26 14:34:30', 'product_hotel', 1, 0, '30/04,01/05', 0, 0, 0, 5, 0, 'usd'),
(9, 'DELUXE CITY VIEW', 1, 9, ',1,2,3,4,5,6,7,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng trung tâm', '30m2', '2 giường đơn', '1451115414_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2016-04-19 16:01:44', '2015-12-26 14:37:47', 'admin', 3, 0, '30/04,01/05', 0, 0, 0, 10, 0, 'vnd'),
(10, 'STANDARD', 1, 10, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng abc</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng biển', '20m2', '1 giường đôi', '1451115575_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2017-05-03 16:37:57', '2015-12-26 14:40:29', 'admin', 2, 0, '30/04,01/05', 1, 200000, 1, 10, 0, 'usd'),
(11, 'STANDARD', 1, 10, ',1,2,3,4,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy</p>', 'Hướng Phố', '35m2', 'Đơn', '1493804496_khach_san_sheraton_nha_trang.jpg', 1, '2017-05-03 21:05:27', '2017-05-03 16:44:13', 'admin', 2, 1, NULL, 1, 200000, 0, 10, 1, 'vnd'),
(12, 'Phòng Hướng Biển', 1, 10, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy</p>', 'Hướng biển', '35m2', 'Giường đơn', '1493820375_08_khach_san_imperial_vung_tau.jpg', 1, '2017-05-03 21:14:34', '2017-05-03 21:09:00', 'admin', 2, 1, NULL, 1, 450000, 0, 10, 0, 'vnd');

-- --------------------------------------------------------

--
-- Table structure for table `room_type_facilities`
--

CREATE TABLE IF NOT EXISTS `room_type_facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `room_type_facilities`
--

INSERT INTO `room_type_facilities` (`id`, `name`, `status`, `deleted`) VALUES
(1, 'Bình nóng lạnh', 1, 0),
(2, 'Tivi', 1, 0),
(3, 'Tủ lạnh', 1, 0),
(4, 'Wifi miễn phí', 1, 0),
(5, 'Dọn phòng hằng ngày', 1, 0),
(6, 'Vòi hoa sen', 1, 0),
(7, 'Ăn sáng miễn phí', 1, 0),
(8, 'Bàn', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_type_tmp`
--

CREATE TABLE IF NOT EXISTS `room_type_tmp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `hotel_id` bigint(20) DEFAULT NULL,
  `facilities_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `policy` text COLLATE utf8_unicode_ci,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot` int(11) DEFAULT NULL,
  `slot_child` int(11) DEFAULT NULL,
  `holiday` text COLLATE utf8_unicode_ci,
  `bed_more` int(11) DEFAULT NULL,
  `bed_more_price` bigint(20) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `room_number` int(11) DEFAULT NULL,
  `hide_price` int(11) NOT NULL,
  `price_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `room_type_tmp`
--

INSERT INTO `room_type_tmp` (`id`, `name`, `status`, `hotel_id`, `facilities_id`, `description`, `policy`, `type`, `size`, `bed`, `picture`, `user_id`, `update_time`, `create_time`, `update_by`, `slot`, `slot_child`, `holiday`, `bed_more`, `bed_more_price`, `deleted`, `room_number`, `hide_price`, `price_type`) VALUES
(1, 'DELUXE DOUBLE/TWIN', 1, 1, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', '1 giường đôi / 2 giường đơn', '38m2', '1 giường đôi / 2 giường đơn', '1451113477_ypw1392178510_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2017-05-03 17:37:41', '2015-12-26 14:06:57', 'admin', 2, 1, '30/04,01/05', 1, 150000, 0, 10, 0, 'vnd'),
(2, 'DELUXE NO BREAKFAST', 1, 2, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy của ph&ograve;ng</p>', '2 giường đơn', '20m2', '2 giường đơn', '1451113889_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:42:10', '2015-12-26 14:12:27', 'product_hotel', 2, 1, '30/04,01/05', 0, 0, 0, 5, 0, 'vnd'),
(3, 'PHÒNG STANDARD DOUBLE', 1, 3, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng biển', '35m2', '1 giường đôi', '1451114098_erd1392178585_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:42:43', '2015-12-26 14:16:25', 'product_hotel', 2, 0, '30/04,01/05', 1, 150000, 0, 5, 0, 'vnd'),
(4, 'SINGLE ROOM', 1, 4, ',2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng thành phồ', '20m2', '1 giường đơn', '1451114296_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:43:05', '2015-12-26 14:19:29', 'product_hotel', 1, 0, '30/04,01/05', 0, 0, 0, 5, 0, 'vnd'),
(5, 'STANDARD DOUBLE', 1, 5, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng biển', '30m2', '1 giường đôi', '1451114530_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:43:31', '2015-12-26 14:23:11', 'product_hotel', 2, 1, '30/04,01/05', 1, 150000, 0, 10, 0, 'vnd'),
(6, 'STANDARD DOUBLE', 1, 6, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng thành phố', '20m2', '1 giường đôi', '1451114726_qaz1392178516_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:43:37', '2015-12-26 14:26:53', 'product_hotel', 2, 0, '30/04,01/05', 1, 150000, 0, 5, 0, 'vnd'),
(7, 'STANDARD', 1, 7, ',1,2,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng biển', '20m2', '1 giường đôi', '1451114936_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:44:10', '2015-12-26 14:30:19', 'product_hotel', 2, 0, '30/04,01/05', 0, 0, 0, 7, 0, 'vnd'),
(8, 'Standard', 1, 8, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng thành phố', '20m2', '1 giường đơn', '1451115217_xet1392178528_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2015-12-26 14:44:19', '2015-12-26 14:34:30', 'product_hotel', 1, 0, '30/04,01/05', 0, 0, 0, 5, 0, 'usd'),
(9, 'DELUXE CITY VIEW', 1, 9, ',1,2,3,4,5,6,7,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng trung tâm', '30m2', '2 giường đơn', '1451115414_medium_lcj1406087003_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2016-04-19 16:01:44', '2015-12-26 14:37:47', 'admin', 3, 0, '30/04,01/05', 0, 0, 0, 10, 0, 'vnd'),
(10, 'STANDARD', 1, 10, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng abc</p>', '<p>Ch&iacute;nh s&aacute;ch hủy ph&ograve;ng</p>', 'Hướng biển', '20m2', '1 giường đôi', '1451115575_ihs1392178605_khach-san-moevenpick-sai-gon-movenpick-sai-gon.jpg', 2, '2017-05-03 16:37:57', '2015-12-26 14:40:29', 'admin', 2, 0, '30/04,01/05', 1, 200000, 1, 10, 0, 'usd'),
(11, 'STANDARD', 1, 10, ',1,2,3,4,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy</p>', 'Hướng Phố', '35m2', 'Đơn', '1493804496_khach_san_sheraton_nha_trang.jpg', 1, '2017-05-03 21:05:27', '2017-05-03 16:44:13', 'admin', 2, 1, NULL, 1, 200000, 0, 10, 1, 'vnd'),
(12, 'Phòng Hướng Biển', 1, 10, ',1,2,3,4,5,6,7,8,', '<p>Th&ocirc;ng tin ph&ograve;ng</p>', '<p>Ch&iacute;nh s&aacute;ch hủy</p>', 'Hướng biển', '35m2', 'Giường đơn', '1493820375_08_khach_san_imperial_vung_tau.jpg', 1, '2017-05-03 21:14:34', '2017-05-03 21:09:00', 'admin', 2, 1, NULL, 1, 450000, 0, 10, 0, 'vnd');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `name`, `value`) VALUES
(1, 'usd', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `sight`
--

CREATE TABLE IF NOT EXISTS `sight` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `national_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `district_id` bigint(20) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `sight`
--

INSERT INTO `sight` (`id`, `name`, `national_id`, `area_id`, `province_id`, `status`, `description`, `district_id`, `picture`, `deleted`) VALUES
(6, 'Chùa Trường Thạnh', 2, 3, 98, 1, '<p>Chùa Trường Thạnh tọa lạc tại quận 1, tp. Hồ Chí Minh. Ngoài ra, du khách có cơ hội đến thăm nhiều địa điểm nổi tiếng như: Nhà hát Lớn, bưu điện Thành phố, Nhà thờ chính tòa, Chợ Bến Thành… Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn có đưa đón khách sạn/sân bay Chùa Trường Thạnh ngay bây giờ với giá từ 235,000 VND.</p>', 2, '1444013223_small_ygh1378978522.JPG', 0),
(7, 'Chùa An Lạc', 2, 3, 98, 1, '', 5, '1444013217_small_ygh1378978522.JPG', 0),
(8, 'Nhà Thờ Huyện Sĩ', 2, 3, 98, 1, '<p>Nhà thờ Huyện Sĩ tọa lạc tại quận 1, Hồ Chí Minh. Ngoài ra, du khách có cơ hội đến thăm nhiều địa điểm nổi tiếng như: Nhà hát Lớn, bưu điện Thành phố, Nhà thờ chính tòa, Chợ Bến Thành… Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn có đưa đón khách sạn/sân bay Nhà thờ Huyện Sĩ ngay bây giờ với giá từ 235,000 VND.</p>', 3, '1444013210_small_ygh1378978522.JPG', 0),
(9, 'Chợ Thái Bình', 2, 3, 98, 1, '<p>Chợ Thái Bình tọa lạc tại quận 1, tp. Hồ Chí Minh. Ngoài ra, du khách có cơ hội đến thăm nhiều địa điểm nổi tiếng như: Nhà hát Lớn, bưu điện Thành phố, Nhà thờ chính tòa, Chợ Bến Thành… Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn có đưa đón khách sạn/sân bay Chợ Thái Bình ngay bây giờ với giá từ 235,000 VND.</p>', 6, '1444013202_small_ygh1378978522.JPG', 0),
(10, 'Thư Viện Khoa Học Tổng Hợp', 2, 3, 98, 1, '<p>Thư viện Khoa học Tổng hợp thuộc quận 1, tp. Hồ Chí Minh. Ngoài ra, du khách có cơ hội đến thăm: Nhà hát Lớn, bưu điện Thành phố, Nhà thờ chính tòa, Chợ Bến Thành… Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn có đưa đón khách sạn/sân bay Thư viện Khoa học Tổng hợp ngay bây giờ với giá từ 235,000 VND.</p>', 7, '1444013197_small_ygh1378978522.JPG', 0),
(11, 'Gần Cảng Nhà Rồng', 2, 3, 98, 1, '<p>Cảng Nhà Rồng tọa lạc tại đường Nguyễn Tất Thành, quận 4, tp. Hồ Chí Minh. Ngoài ra, du khách có cơ hội đến thăm nhiều địa điểm nổi tiếng như: Tịnh xá Linh Quang, Chùa Giác Nguyên, Chùa Kim Liên… Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn khu vực Cảng Nhà Rồng ngay bây giờ với giá rẻ nhất.</p>', 8, '1444013190_small_ygh1378978522.JPG', 0),
(12, 'Đại Học Mở Thành Phố Hồ Chí Minh', 2, 3, 98, 1, '<p>Địa học Mở HCM tọa lạc tại quận 3 Thành Phố Hồ Chí Minh. Đến với Địa học Mở HCM, du khách có cơ hội tham quan các địa điểm nổi tiếng như nhà thờ Đức Bà, Dinh Thống Nhất, địa đạo Củ Chi...Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn tại khu vực Địa học Mở HCM ngay bây giờ với giá rẻ nhất.</p>', 9, '1444013054_small_ygh1378978522.JPG', 0),
(13, 'Ga Sài Gòn', 2, 3, 98, 1, '<p>Ga Sài Gòn tọa lạc tại quận 3 Thành Phố Hồ Chí Minh. Đến với Ga Sài Gòn, du khách có cơ hội tham quan các địa điểm du lịch nổi tiếng như nhà thờ Đức Bà, Dinh Thống Nhất, địa đạo củ Chi...Hãy để Mytour hỗ trợ bạn để có 1 chuyến đi thú vị, tiết kiệm bằng cách đặt phòng khách sạn tại khu vực Ga Sài Gòn ngay bây giờ với giá rẻ nhất.</p>', 10, '1444013183_small_ygh1378978522.JPG', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE IF NOT EXISTS `tour` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `create_time` datetime DEFAULT NULL,
  `deleted` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `from_area_id` int(11) DEFAULT NULL,
  `from_national_id` int(11) DEFAULT NULL,
  `from_province_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `partner_tour_id` int(11) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `policy` text COLLATE utf8_unicode_ci,
  `price` int(11) DEFAULT NULL,
  `price_description` text COLLATE utf8_unicode_ci,
  `service_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` text COLLATE utf8_unicode_ci,
  `status` int(11) DEFAULT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `topic_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_area_id` int(11) DEFAULT NULL,
  `to_national_id` int(11) DEFAULT NULL,
  `to_province_id` int(11) DEFAULT NULL,
  `transportation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hide_provider` int(11) DEFAULT NULL,
  `description_meta` text COLLATE utf8_unicode_ci NOT NULL,
  `keyword` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`id`, `create_time`, `deleted`, `description`, `from_area_id`, `from_national_id`, `from_province_id`, `name`, `partner_tour_id`, `picture`, `policy`, `price`, `price_description`, `service_id`, `start_date`, `status`, `time`, `topic_id`, `to_area_id`, `to_national_id`, `to_province_id`, `transportation`, `update_by`, `update_time`, `user_id`, `hide_provider`, `description_meta`, `keyword`) VALUES
(1, '2016-03-07 15:01:56', 0, '<p><strong>NG&Agrave;Y 1: THAM QUAN NHA TRANG- Đ&Agrave; LẠT</strong> <br /><br /><strong>08h00:</strong> Xe đ&oacute;n đo&agrave;n tại kh&aacute;ch sạn khởi h&agrave;nh chuy&ecirc;́n. Đến <strong>Đ&agrave; Lạt</strong>, đo&agrave;n về kh&aacute;ch sạn nhận ph&ograve;ng nghỉ ngơi, chu&acirc;̉n bị cho chuy&ecirc;́n du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m.<br /><br />Đo&agrave;n về kh&aacute;ch sạn nhận ph&ograve;ng nghỉ ngơi. <br /><br /><strong>Tối:</strong> Đo&agrave;n tự do kh&aacute;m ph&aacute; th&agrave;nh phố về đ&ecirc;m. <br /><br /><strong>NG&Agrave;Y&nbsp; 2: Đ&Agrave; LẠT &ndash; NHA TRANG ( ăn s&aacute;ng)</strong><br /><br />Khách dùng đi&ecirc;̉m t&acirc;m tại kh&aacute;ch sạn. L&agrave;m thủ tục trả ph&ograve;ng. <br /><br /><strong>07h45:</strong> Xe đưa đo&agrave;n chinh phục đỉnh<strong> Đồi Robinson</strong>. Q&uacute;y kh&aacute;ch chi&ecirc;m ngưỡng to&agrave;n cảnh th&agrave;nh phố Đ&agrave; Lạt từ k&iacute;nh viễng vọng. Đo&agrave;n ngồi c&aacute;p treo (chi ph&iacute; tự t&uacute;c) đến với <strong>Thiền Viện Tr&uacute;c L&acirc;m</strong> tham quan Thiền Viện Tr&uacute;c L&acirc;m tọa lạc tr&ecirc;n n&uacute;i Phượng Ho&agrave;ng &ndash; Đ&acirc;y l&agrave; chi nh&aacute;nh đầu ti&ecirc;n tại miền Nam của Thiền Ph&aacute;i Tr&uacute;c L&acirc;m Y&ecirc;n Tử (Quảng Ninh).Tham quan,chi&ecirc;m b&aacute;i Phật Th&iacute;ch Ca.Tham quan <strong>Hồ Tuyền L&acirc;m</strong> &ndash;Một trong những hồ nước đẹp v&agrave; lớn nhất Đ&agrave; Lạt. Chụp h&igrave;nh lưu niệm. <br /><br />Xe đưa đo&agrave;n tham quan <strong>Th&aacute;c Datanla</strong>. Q&uacute;y kh&aacute;ch chinh phục th&aacute;c bằng xe trượt cảm gi&aacute;c mạnh- Hệ thống xe trượt hiện đại đầu ti&ecirc;n tại Việt Nam (Chi ph&iacute; tự t&uacute;c).<br /><br />Đo&agrave;n tham <strong>Thung lũng t&igrave;nh y&ecirc;u</strong>. đo&agrave;n chụp ảnh l&agrave;m kỉ niệm cho gia đ&igrave;nh tại nơi đ&acirc;y.&nbsp; Tham quan Phòng trưng bày hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t&nbsp; :Đ&ecirc;́n với Đà Lạt quý khách kh&ocirc;ng thăm quan phòng trưng bay hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t đó là m&ocirc;̣t sự thi&ecirc;́u xót , b&ecirc;n cạnh những loài hoa tươi khoe sắc&nbsp; thì hoa kh&ocirc; cũng kh&ocirc;ng kém ph&acirc;̀n h&acirc;́p d&acirc;̃n , các ngh&ecirc;̣ nh&acirc;n đã đem lại cho du khách những tác ph&acirc;̉m ghép bằng hoa như tranh hoa , quà lưu ni&ecirc;̣m bằng hoa , những chú g&acirc;́u bằng hoa .v.v....&nbsp; Phòng trưng bày hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t đang là đi&ecirc;̉m lựa chọ của du khách khi đ&ecirc;́n với Đà Lạt <br /><br /><strong>16h00:</strong> Qu&yacute; kh&aacute;ch về kh&aacute;ch sạn nghỉ ngơi. <br /><br /><strong>NG&Agrave;Y3: Đ&Agrave; LẠT_ NHA TRANG (ăn s&aacute;ng)</strong><br /><br /><strong>S&aacute;ng:</strong> Qu&yacute; kh&aacute;ch dậy sớm , d&ugrave;ng điểm t&acirc;m s&aacute;ng tại kh&aacute;ch sạn. Qu&yacute; kh&aacute;ch l&agrave;m thủ tục trả ph&ograve;ng kh&aacute;ch sạn. <br /><br />Sau đ&oacute; tự do dạo <strong>chợ Đ&agrave; Lạt</strong> mua dặc sản của v&ugrave;ng về l&agrave;m qu&agrave; cho người th&acirc;n v&agrave; gia đ&igrave;nh. <br /><br /><strong>8h15-9h00:</strong> xe đ&oacute;n kh&aacute;ch tại kh&aacute;ch sạn. Khởi h&agrave;nh về lại Nha Trang. K&ecirc;́t thúc chuy&ecirc;́n du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m.<br /><br /><strong>Cảm ơn qu&yacute; kh&aacute;ch đ&atilde; sử dụng dịch vụ đặt tour&nbsp;du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m gi&aacute; rẻ của Mytour.vn. Đến với Mytour.vn, qu&yacute; kh&aacute;ch sẽ c&oacute; được những ưu đ&atilde;i lớn nhất khi đặt tour du lịch.</strong></p>', 3, 2, 98, 'Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm', 1, '1457337643_wkz1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', '', 1200000, '<p><span style="box-sizing: border-box; color: #333333; line-height: 18.2px; text-decoration: underline;"><span style="box-sizing: border-box; font-weight: bold;">GI&Aacute; BAO GỒM:</span></span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Xe gh&eacute;p đo&agrave;n đi Nha Trang- Đ&agrave; Lạt- Nha Trang</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Chương tr&igrave;nh tham quan th&agrave;nh phố Đ&agrave; Lạt</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; V&eacute; tham quan theo chương tr&igrave;nh</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Kh&aacute;ch sạn 01-02&nbsp; sao ngay trung t&acirc;m th&agrave;nh phố, 02 kh&aacute;ch/ph&ograve;ng</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; 02 bữa s&aacute;ng&nbsp; theo chương tr&igrave;nh&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="box-sizing: border-box; color: #333333; line-height: 18.2px; text-decoration: underline;"><span style="box-sizing: border-box; font-weight: bold;">GI&Aacute; KH&Ocirc;NG BAO GỒM:</span></span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; C&aacute;c bữa ăn theo chương tr&igrave;nh.&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Chi ph&iacute; c&aacute; nh&acirc;n kh&aacute;c ngo&agrave;i chương tr&igrave;nh&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Thuế VAT</span></p>', ',1,2,3,4,5,', '2016-03-09', 1, '3 ngày 2 đêm', ',1,2,3,4,5,6,7,', 3, 2, 114, 'Ôtô', 'admin', '2016-03-07 15:40:49', 1, NULL, '', ''),
(2, '2016-03-07 15:23:49', 0, '<p><strong>NG&Agrave;Y 1: THAM QUAN NHA TRANG- Đ&Agrave; LẠT</strong> <br /><br /><strong>08h00:</strong> Xe đ&oacute;n đo&agrave;n tại kh&aacute;ch sạn khởi h&agrave;nh chuy&ecirc;́n. Đến <strong>Đ&agrave; Lạt</strong>, đo&agrave;n về kh&aacute;ch sạn nhận ph&ograve;ng nghỉ ngơi, chu&acirc;̉n bị cho chuy&ecirc;́n du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m.<br /><br />Đo&agrave;n về kh&aacute;ch sạn nhận ph&ograve;ng nghỉ ngơi. <br /><br /><strong>Tối:</strong> Đo&agrave;n tự do kh&aacute;m ph&aacute; th&agrave;nh phố về đ&ecirc;m. <br /><br /><strong>NG&Agrave;Y&nbsp; 2: Đ&Agrave; LẠT &ndash; NHA TRANG ( ăn s&aacute;ng)</strong><br /><br />Khách dùng đi&ecirc;̉m t&acirc;m tại kh&aacute;ch sạn. L&agrave;m thủ tục trả ph&ograve;ng. <br /><br /><strong>07h45:</strong> Xe đưa đo&agrave;n chinh phục đỉnh<strong> Đồi Robinson</strong>. Q&uacute;y kh&aacute;ch chi&ecirc;m ngưỡng to&agrave;n cảnh th&agrave;nh phố Đ&agrave; Lạt từ k&iacute;nh viễng vọng. Đo&agrave;n ngồi c&aacute;p treo (chi ph&iacute; tự t&uacute;c) đến với <strong>Thiền Viện Tr&uacute;c L&acirc;m</strong> tham quan Thiền Viện Tr&uacute;c L&acirc;m tọa lạc tr&ecirc;n n&uacute;i Phượng Ho&agrave;ng &ndash; Đ&acirc;y l&agrave; chi nh&aacute;nh đầu ti&ecirc;n tại miền Nam của Thiền Ph&aacute;i Tr&uacute;c L&acirc;m Y&ecirc;n Tử (Quảng Ninh).Tham quan,chi&ecirc;m b&aacute;i Phật Th&iacute;ch Ca.Tham quan <strong>Hồ Tuyền L&acirc;m</strong> &ndash;Một trong những hồ nước đẹp v&agrave; lớn nhất Đ&agrave; Lạt. Chụp h&igrave;nh lưu niệm. <br /><br />Xe đưa đo&agrave;n tham quan <strong>Th&aacute;c Datanla</strong>. Q&uacute;y kh&aacute;ch chinh phục th&aacute;c bằng xe trượt cảm gi&aacute;c mạnh- Hệ thống xe trượt hiện đại đầu ti&ecirc;n tại Việt Nam (Chi ph&iacute; tự t&uacute;c).<br /><br />Đo&agrave;n tham <strong>Thung lũng t&igrave;nh y&ecirc;u</strong>. đo&agrave;n chụp ảnh l&agrave;m kỉ niệm cho gia đ&igrave;nh tại nơi đ&acirc;y.&nbsp; Tham quan Phòng trưng bày hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t&nbsp; :Đ&ecirc;́n với Đà Lạt quý khách kh&ocirc;ng thăm quan phòng trưng bay hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t đó là m&ocirc;̣t sự thi&ecirc;́u xót , b&ecirc;n cạnh những loài hoa tươi khoe sắc&nbsp; thì hoa kh&ocirc; cũng kh&ocirc;ng kém ph&acirc;̀n h&acirc;́p d&acirc;̃n , các ngh&ecirc;̣ nh&acirc;n đã đem lại cho du khách những tác ph&acirc;̉m ghép bằng hoa như tranh hoa , quà lưu ni&ecirc;̣m bằng hoa , những chú g&acirc;́u bằng hoa .v.v....&nbsp; Phòng trưng bày hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t đang là đi&ecirc;̉m lựa chọ của du khách khi đ&ecirc;́n với Đà Lạt <br /><br /><strong>16h00:</strong> Qu&yacute; kh&aacute;ch về kh&aacute;ch sạn nghỉ ngơi. <br /><br /><strong>NG&Agrave;Y3: Đ&Agrave; LẠT_ NHA TRANG (ăn s&aacute;ng)</strong><br /><br /><strong>S&aacute;ng:</strong> Qu&yacute; kh&aacute;ch dậy sớm , d&ugrave;ng điểm t&acirc;m s&aacute;ng tại kh&aacute;ch sạn. Qu&yacute; kh&aacute;ch l&agrave;m thủ tục trả ph&ograve;ng kh&aacute;ch sạn. <br /><br />Sau đ&oacute; tự do dạo <strong>chợ Đ&agrave; Lạt</strong> mua dặc sản của v&ugrave;ng về l&agrave;m qu&agrave; cho người th&acirc;n v&agrave; gia đ&igrave;nh. <br /><br /><strong>8h15-9h00:</strong> xe đ&oacute;n kh&aacute;ch tại kh&aacute;ch sạn. Khởi h&agrave;nh về lại Nha Trang. K&ecirc;́t thúc chuy&ecirc;́n du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m.<br /><br /><strong>Cảm ơn qu&yacute; kh&aacute;ch đ&atilde; sử dụng dịch vụ đặt tour&nbsp;du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m gi&aacute; rẻ của Mytour.vn. Đến với Mytour.vn, qu&yacute; kh&aacute;ch sẽ c&oacute; được những ưu đ&atilde;i lớn nhất khi đặt tour du lịch.</strong></p>', 3, 2, 98, 'Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm', 1, '1457338962_nhc1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', '', 1200000, '<p><span style="box-sizing: border-box; color: #333333; line-height: 18.2px; text-decoration: underline;"><span style="box-sizing: border-box; font-weight: bold;">GI&Aacute; BAO GỒM:</span></span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Xe gh&eacute;p đo&agrave;n đi Nha Trang- Đ&agrave; Lạt- Nha Trang</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Chương tr&igrave;nh tham quan th&agrave;nh phố Đ&agrave; Lạt</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; V&eacute; tham quan theo chương tr&igrave;nh</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Kh&aacute;ch sạn 01-02&nbsp; sao ngay trung t&acirc;m th&agrave;nh phố, 02 kh&aacute;ch/ph&ograve;ng</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; 02 bữa s&aacute;ng&nbsp; theo chương tr&igrave;nh&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="box-sizing: border-box; color: #333333; line-height: 18.2px; text-decoration: underline;"><span style="box-sizing: border-box; font-weight: bold;">GI&Aacute; KH&Ocirc;NG BAO GỒM:</span></span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; C&aacute;c bữa ăn theo chương tr&igrave;nh.&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Chi ph&iacute; c&aacute; nh&acirc;n kh&aacute;c ngo&agrave;i chương tr&igrave;nh&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Thuế VAT</span></p>', ',1,2,3,4,5,', '1', 1, '3 ngày 2 đêm', ',1,2,3,4,5,6,7,', 3, 2, 114, 'Ôtô', 'admin', '2016-03-07 15:26:47', 1, NULL, '', ''),
(3, '2016-03-07 15:26:32', 0, '<p><strong>NG&Agrave;Y 1: THAM QUAN NHA TRANG- Đ&Agrave; LẠT</strong> <br /><br /><strong>08h00:</strong> Xe đ&oacute;n đo&agrave;n tại kh&aacute;ch sạn khởi h&agrave;nh chuy&ecirc;́n. Đến <strong>Đ&agrave; Lạt</strong>, đo&agrave;n về kh&aacute;ch sạn nhận ph&ograve;ng nghỉ ngơi, chu&acirc;̉n bị cho chuy&ecirc;́n du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m.<br /><br />Đo&agrave;n về kh&aacute;ch sạn nhận ph&ograve;ng nghỉ ngơi. <br /><br /><strong>Tối:</strong> Đo&agrave;n tự do kh&aacute;m ph&aacute; th&agrave;nh phố về đ&ecirc;m. <br /><br /><strong>NG&Agrave;Y&nbsp; 2: Đ&Agrave; LẠT &ndash; NHA TRANG ( ăn s&aacute;ng)</strong><br /><br />Khách dùng đi&ecirc;̉m t&acirc;m tại kh&aacute;ch sạn. L&agrave;m thủ tục trả ph&ograve;ng. <br /><br /><strong>07h45:</strong> Xe đưa đo&agrave;n chinh phục đỉnh<strong> Đồi Robinson</strong>. Q&uacute;y kh&aacute;ch chi&ecirc;m ngưỡng to&agrave;n cảnh th&agrave;nh phố Đ&agrave; Lạt từ k&iacute;nh viễng vọng. Đo&agrave;n ngồi c&aacute;p treo (chi ph&iacute; tự t&uacute;c) đến với <strong>Thiền Viện Tr&uacute;c L&acirc;m</strong> tham quan Thiền Viện Tr&uacute;c L&acirc;m tọa lạc tr&ecirc;n n&uacute;i Phượng Ho&agrave;ng &ndash; Đ&acirc;y l&agrave; chi nh&aacute;nh đầu ti&ecirc;n tại miền Nam của Thiền Ph&aacute;i Tr&uacute;c L&acirc;m Y&ecirc;n Tử (Quảng Ninh).Tham quan,chi&ecirc;m b&aacute;i Phật Th&iacute;ch Ca.Tham quan <strong>Hồ Tuyền L&acirc;m</strong> &ndash;Một trong những hồ nước đẹp v&agrave; lớn nhất Đ&agrave; Lạt. Chụp h&igrave;nh lưu niệm. <br /><br />Xe đưa đo&agrave;n tham quan <strong>Th&aacute;c Datanla</strong>. Q&uacute;y kh&aacute;ch chinh phục th&aacute;c bằng xe trượt cảm gi&aacute;c mạnh- Hệ thống xe trượt hiện đại đầu ti&ecirc;n tại Việt Nam (Chi ph&iacute; tự t&uacute;c).<br /><br />Đo&agrave;n tham <strong>Thung lũng t&igrave;nh y&ecirc;u</strong>. đo&agrave;n chụp ảnh l&agrave;m kỉ niệm cho gia đ&igrave;nh tại nơi đ&acirc;y.&nbsp; Tham quan Phòng trưng bày hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t&nbsp; :Đ&ecirc;́n với Đà Lạt quý khách kh&ocirc;ng thăm quan phòng trưng bay hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t đó là m&ocirc;̣t sự thi&ecirc;́u xót , b&ecirc;n cạnh những loài hoa tươi khoe sắc&nbsp; thì hoa kh&ocirc; cũng kh&ocirc;ng kém ph&acirc;̀n h&acirc;́p d&acirc;̃n , các ngh&ecirc;̣ nh&acirc;n đã đem lại cho du khách những tác ph&acirc;̉m ghép bằng hoa như tranh hoa , quà lưu ni&ecirc;̣m bằng hoa , những chú g&acirc;́u bằng hoa .v.v....&nbsp; Phòng trưng bày hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t đang là đi&ecirc;̉m lựa chọ của du khách khi đ&ecirc;́n với Đà Lạt <br /><br /><strong>16h00:</strong> Qu&yacute; kh&aacute;ch về kh&aacute;ch sạn nghỉ ngơi. <br /><br /><strong>NG&Agrave;Y3: Đ&Agrave; LẠT_ NHA TRANG (ăn s&aacute;ng)</strong><br /><br /><strong>S&aacute;ng:</strong> Qu&yacute; kh&aacute;ch dậy sớm , d&ugrave;ng điểm t&acirc;m s&aacute;ng tại kh&aacute;ch sạn. Qu&yacute; kh&aacute;ch l&agrave;m thủ tục trả ph&ograve;ng kh&aacute;ch sạn. <br /><br />Sau đ&oacute; tự do dạo <strong>chợ Đ&agrave; Lạt</strong> mua dặc sản của v&ugrave;ng về l&agrave;m qu&agrave; cho người th&acirc;n v&agrave; gia đ&igrave;nh. <br /><br /><strong>8h15-9h00:</strong> xe đ&oacute;n kh&aacute;ch tại kh&aacute;ch sạn. Khởi h&agrave;nh về lại Nha Trang. K&ecirc;́t thúc chuy&ecirc;́n du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m.<br /><br /><strong>Cảm ơn qu&yacute; kh&aacute;ch đ&atilde; sử dụng dịch vụ đặt tour&nbsp;du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m gi&aacute; rẻ của Mytour.vn. Đến với Mytour.vn, qu&yacute; kh&aacute;ch sẽ c&oacute; được những ưu đ&atilde;i lớn nhất khi đặt tour du lịch.</strong></p>', 3, 2, 98, 'Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm', 1, '1457339137_mtp1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', '', 1200000, '<p><span style="box-sizing: border-box; color: #333333; line-height: 18.2px; text-decoration: underline;"><span style="box-sizing: border-box; font-weight: bold;">GI&Aacute; BAO GỒM:</span></span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Xe gh&eacute;p đo&agrave;n đi Nha Trang- Đ&agrave; Lạt- Nha Trang</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Chương tr&igrave;nh tham quan th&agrave;nh phố Đ&agrave; Lạt</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; V&eacute; tham quan theo chương tr&igrave;nh</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Kh&aacute;ch sạn 01-02&nbsp; sao ngay trung t&acirc;m th&agrave;nh phố, 02 kh&aacute;ch/ph&ograve;ng</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; 02 bữa s&aacute;ng&nbsp; theo chương tr&igrave;nh&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="box-sizing: border-box; color: #333333; line-height: 18.2px; text-decoration: underline;"><span style="box-sizing: border-box; font-weight: bold;">GI&Aacute; KH&Ocirc;NG BAO GỒM:</span></span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; C&aacute;c bữa ăn theo chương tr&igrave;nh.&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Chi ph&iacute; c&aacute; nh&acirc;n kh&aacute;c ngo&agrave;i chương tr&igrave;nh&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Thuế VAT</span></p>', ',1,2,3,4,5,', '1', 1, '3 ngày 2 đêm', ',1,2,3,4,5,6,7,', 3, 2, 114, 'Oto', 'admin', '2016-03-07 15:26:32', 1, NULL, '', ''),
(4, '2016-03-07 15:27:50', 0, '<p><strong>NG&Agrave;Y 1: THAM QUAN NHA TRANG- Đ&Agrave; LẠT</strong> <br /><br /><strong>08h00:</strong> Xe đ&oacute;n đo&agrave;n tại kh&aacute;ch sạn khởi h&agrave;nh chuy&ecirc;́n. Đến <strong>Đ&agrave; Lạt</strong>, đo&agrave;n về kh&aacute;ch sạn nhận ph&ograve;ng nghỉ ngơi, chu&acirc;̉n bị cho chuy&ecirc;́n du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m.<br /><br />Đo&agrave;n về kh&aacute;ch sạn nhận ph&ograve;ng nghỉ ngơi. <br /><br /><strong>Tối:</strong> Đo&agrave;n tự do kh&aacute;m ph&aacute; th&agrave;nh phố về đ&ecirc;m. <br /><br /><strong>NG&Agrave;Y&nbsp; 2: Đ&Agrave; LẠT &ndash; NHA TRANG ( ăn s&aacute;ng)</strong><br /><br />Khách dùng đi&ecirc;̉m t&acirc;m tại kh&aacute;ch sạn. L&agrave;m thủ tục trả ph&ograve;ng. <br /><br /><strong>07h45:</strong> Xe đưa đo&agrave;n chinh phục đỉnh<strong> Đồi Robinson</strong>. Q&uacute;y kh&aacute;ch chi&ecirc;m ngưỡng to&agrave;n cảnh th&agrave;nh phố Đ&agrave; Lạt từ k&iacute;nh viễng vọng. Đo&agrave;n ngồi c&aacute;p treo (chi ph&iacute; tự t&uacute;c) đến với <strong>Thiền Viện Tr&uacute;c L&acirc;m</strong> tham quan Thiền Viện Tr&uacute;c L&acirc;m tọa lạc tr&ecirc;n n&uacute;i Phượng Ho&agrave;ng &ndash; Đ&acirc;y l&agrave; chi nh&aacute;nh đầu ti&ecirc;n tại miền Nam của Thiền Ph&aacute;i Tr&uacute;c L&acirc;m Y&ecirc;n Tử (Quảng Ninh).Tham quan,chi&ecirc;m b&aacute;i Phật Th&iacute;ch Ca.Tham quan <strong>Hồ Tuyền L&acirc;m</strong> &ndash;Một trong những hồ nước đẹp v&agrave; lớn nhất Đ&agrave; Lạt. Chụp h&igrave;nh lưu niệm. <br /><br />Xe đưa đo&agrave;n tham quan <strong>Th&aacute;c Datanla</strong>. Q&uacute;y kh&aacute;ch chinh phục th&aacute;c bằng xe trượt cảm gi&aacute;c mạnh- Hệ thống xe trượt hiện đại đầu ti&ecirc;n tại Việt Nam (Chi ph&iacute; tự t&uacute;c).<br /><br />Đo&agrave;n tham <strong>Thung lũng t&igrave;nh y&ecirc;u</strong>. đo&agrave;n chụp ảnh l&agrave;m kỉ niệm cho gia đ&igrave;nh tại nơi đ&acirc;y.&nbsp; Tham quan Phòng trưng bày hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t&nbsp; :Đ&ecirc;́n với Đà Lạt quý khách kh&ocirc;ng thăm quan phòng trưng bay hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t đó là m&ocirc;̣t sự thi&ecirc;́u xót , b&ecirc;n cạnh những loài hoa tươi khoe sắc&nbsp; thì hoa kh&ocirc; cũng kh&ocirc;ng kém ph&acirc;̀n h&acirc;́p d&acirc;̃n , các ngh&ecirc;̣ nh&acirc;n đã đem lại cho du khách những tác ph&acirc;̉m ghép bằng hoa như tranh hoa , quà lưu ni&ecirc;̣m bằng hoa , những chú g&acirc;́u bằng hoa .v.v....&nbsp; Phòng trưng bày hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t đang là đi&ecirc;̉m lựa chọ của du khách khi đ&ecirc;́n với Đà Lạt <br /><br /><strong>16h00:</strong> Qu&yacute; kh&aacute;ch về kh&aacute;ch sạn nghỉ ngơi. <br /><br /><strong>NG&Agrave;Y3: Đ&Agrave; LẠT_ NHA TRANG (ăn s&aacute;ng)</strong><br /><br /><strong>S&aacute;ng:</strong> Qu&yacute; kh&aacute;ch dậy sớm , d&ugrave;ng điểm t&acirc;m s&aacute;ng tại kh&aacute;ch sạn. Qu&yacute; kh&aacute;ch l&agrave;m thủ tục trả ph&ograve;ng kh&aacute;ch sạn. <br /><br />Sau đ&oacute; tự do dạo <strong>chợ Đ&agrave; Lạt</strong> mua dặc sản của v&ugrave;ng về l&agrave;m qu&agrave; cho người th&acirc;n v&agrave; gia đ&igrave;nh. <br /><br /><strong>8h15-9h00:</strong> xe đ&oacute;n kh&aacute;ch tại kh&aacute;ch sạn. Khởi h&agrave;nh về lại Nha Trang. K&ecirc;́t thúc chuy&ecirc;́n du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m.<br /><br /><strong>Cảm ơn qu&yacute; kh&aacute;ch đ&atilde; sử dụng dịch vụ đặt tour&nbsp;du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m gi&aacute; rẻ của Mytour.vn. Đến với Mytour.vn, qu&yacute; kh&aacute;ch sẽ c&oacute; được những ưu đ&atilde;i lớn nhất khi đặt tour du lịch.</strong></p>', 3, 2, 98, 'Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm', 1, '1457339225_xih1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', '', 1200000, '<p><span style="box-sizing: border-box; color: #333333; line-height: 18.2px; text-decoration: underline;"><span style="box-sizing: border-box; font-weight: bold;">GI&Aacute; BAO GỒM:</span></span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Xe gh&eacute;p đo&agrave;n đi Nha Trang- Đ&agrave; Lạt- Nha Trang</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Chương tr&igrave;nh tham quan th&agrave;nh phố Đ&agrave; Lạt</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; V&eacute; tham quan theo chương tr&igrave;nh</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Kh&aacute;ch sạn 01-02&nbsp; sao ngay trung t&acirc;m th&agrave;nh phố, 02 kh&aacute;ch/ph&ograve;ng</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; 02 bữa s&aacute;ng&nbsp; theo chương tr&igrave;nh&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="box-sizing: border-box; color: #333333; line-height: 18.2px; text-decoration: underline;"><span style="box-sizing: border-box; font-weight: bold;">GI&Aacute; KH&Ocirc;NG BAO GỒM:</span></span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; C&aacute;c bữa ăn theo chương tr&igrave;nh.&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Chi ph&iacute; c&aacute; nh&acirc;n kh&aacute;c ngo&agrave;i chương tr&igrave;nh&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Thuế VAT</span></p>', ',1,2,3,4,5,', '2016-04-21; 2016-04-22; ', 1, '3 ngày 2 đêm', ',1,2,3,4,5,6,7,', 3, 2, 114, 'oto', 'admin', '2016-04-20 20:52:26', 1, 1, '', ''),
(5, '2016-03-07 15:29:16', 0, '<p><strong>NG&Agrave;Y 1: THAM QUAN NHA TRANG- Đ&Agrave; LẠT</strong> <br /><br /><strong>08h00:</strong> Xe đ&oacute;n đo&agrave;n tại kh&aacute;ch sạn khởi h&agrave;nh chuy&ecirc;́n. Đến <strong>Đ&agrave; Lạt</strong>, đo&agrave;n về kh&aacute;ch sạn nhận ph&ograve;ng nghỉ ngơi, chu&acirc;̉n bị cho chuy&ecirc;́n du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m.<br /><br />Đo&agrave;n về kh&aacute;ch sạn nhận ph&ograve;ng nghỉ ngơi. <br /><br /><strong>Tối:</strong> Đo&agrave;n tự do kh&aacute;m ph&aacute; th&agrave;nh phố về đ&ecirc;m. <br /><br /><strong>NG&Agrave;Y&nbsp; 2: Đ&Agrave; LẠT &ndash; NHA TRANG ( ăn s&aacute;ng)</strong><br /><br />Khách dùng đi&ecirc;̉m t&acirc;m tại kh&aacute;ch sạn. L&agrave;m thủ tục trả ph&ograve;ng. <br /><br /><strong>07h45:</strong> Xe đưa đo&agrave;n chinh phục đỉnh<strong> Đồi Robinson</strong>. Q&uacute;y kh&aacute;ch chi&ecirc;m ngưỡng to&agrave;n cảnh th&agrave;nh phố Đ&agrave; Lạt từ k&iacute;nh viễng vọng. Đo&agrave;n ngồi c&aacute;p treo (chi ph&iacute; tự t&uacute;c) đến với <strong>Thiền Viện Tr&uacute;c L&acirc;m</strong> tham quan Thiền Viện Tr&uacute;c L&acirc;m tọa lạc tr&ecirc;n n&uacute;i Phượng Ho&agrave;ng &ndash; Đ&acirc;y l&agrave; chi nh&aacute;nh đầu ti&ecirc;n tại miền Nam của Thiền Ph&aacute;i Tr&uacute;c L&acirc;m Y&ecirc;n Tử (Quảng Ninh).Tham quan,chi&ecirc;m b&aacute;i Phật Th&iacute;ch Ca.Tham quan <strong>Hồ Tuyền L&acirc;m</strong> &ndash;Một trong những hồ nước đẹp v&agrave; lớn nhất Đ&agrave; Lạt. Chụp h&igrave;nh lưu niệm. <br /><br />Xe đưa đo&agrave;n tham quan <strong>Th&aacute;c Datanla</strong>. Q&uacute;y kh&aacute;ch chinh phục th&aacute;c bằng xe trượt cảm gi&aacute;c mạnh- Hệ thống xe trượt hiện đại đầu ti&ecirc;n tại Việt Nam (Chi ph&iacute; tự t&uacute;c).<br /><br />Đo&agrave;n tham <strong>Thung lũng t&igrave;nh y&ecirc;u</strong>. đo&agrave;n chụp ảnh l&agrave;m kỉ niệm cho gia đ&igrave;nh tại nơi đ&acirc;y.&nbsp; Tham quan Phòng trưng bày hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t&nbsp; :Đ&ecirc;́n với Đà Lạt quý khách kh&ocirc;ng thăm quan phòng trưng bay hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t đó là m&ocirc;̣t sự thi&ecirc;́u xót , b&ecirc;n cạnh những loài hoa tươi khoe sắc&nbsp; thì hoa kh&ocirc; cũng kh&ocirc;ng kém ph&acirc;̀n h&acirc;́p d&acirc;̃n , các ngh&ecirc;̣ nh&acirc;n đã đem lại cho du khách những tác ph&acirc;̉m ghép bằng hoa như tranh hoa , quà lưu ni&ecirc;̣m bằng hoa , những chú g&acirc;́u bằng hoa .v.v....&nbsp; Phòng trưng bày hoa kh&ocirc; ngh&ecirc;̣ thu&acirc;̣t đang là đi&ecirc;̉m lựa chọ của du khách khi đ&ecirc;́n với Đà Lạt <br /><br /><strong>16h00:</strong> Qu&yacute; kh&aacute;ch về kh&aacute;ch sạn nghỉ ngơi. <br /><br /><strong>NG&Agrave;Y3: Đ&Agrave; LẠT_ NHA TRANG (ăn s&aacute;ng)</strong><br /><br /><strong>S&aacute;ng:</strong> Qu&yacute; kh&aacute;ch dậy sớm , d&ugrave;ng điểm t&acirc;m s&aacute;ng tại kh&aacute;ch sạn. Qu&yacute; kh&aacute;ch l&agrave;m thủ tục trả ph&ograve;ng kh&aacute;ch sạn. <br /><br />Sau đ&oacute; tự do dạo <strong>chợ Đ&agrave; Lạt</strong> mua dặc sản của v&ugrave;ng về l&agrave;m qu&agrave; cho người th&acirc;n v&agrave; gia đ&igrave;nh. <br /><br /><strong>8h15-9h00:</strong> xe đ&oacute;n kh&aacute;ch tại kh&aacute;ch sạn. Khởi h&agrave;nh về lại Nha Trang. K&ecirc;́t thúc chuy&ecirc;́n du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m.<br /><br /><strong>Cảm ơn qu&yacute; kh&aacute;ch đ&atilde; sử dụng dịch vụ đặt tour&nbsp;du lịch Nha Trang - Đà Lạt trong 3 ngày 2 đ&ecirc;m gi&aacute; rẻ của Mytour.vn. Đến với Mytour.vn, qu&yacute; kh&aacute;ch sẽ c&oacute; được những ưu đ&atilde;i lớn nhất khi đặt tour du lịch.</strong></p>', 3, 2, 98, 'Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm', 1, '1457339308_fxn1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', '', 1200000, '<p><span style="box-sizing: border-box; color: #333333; line-height: 18.2px; text-decoration: underline;"><span style="box-sizing: border-box; font-weight: bold;">GI&Aacute; BAO GỒM:</span></span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Xe gh&eacute;p đo&agrave;n đi Nha Trang- Đ&agrave; Lạt- Nha Trang</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Chương tr&igrave;nh tham quan th&agrave;nh phố Đ&agrave; Lạt</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; V&eacute; tham quan theo chương tr&igrave;nh</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Kh&aacute;ch sạn 01-02&nbsp; sao ngay trung t&acirc;m th&agrave;nh phố, 02 kh&aacute;ch/ph&ograve;ng</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; 02 bữa s&aacute;ng&nbsp; theo chương tr&igrave;nh&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="box-sizing: border-box; color: #333333; line-height: 18.2px; text-decoration: underline;"><span style="box-sizing: border-box; font-weight: bold;">GI&Aacute; KH&Ocirc;NG BAO GỒM:</span></span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; C&aacute;c bữa ăn theo chương tr&igrave;nh.&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Chi ph&iacute; c&aacute; nh&acirc;n kh&aacute;c ngo&agrave;i chương tr&igrave;nh&nbsp;</span><br style="box-sizing: border-box; color: #333333; line-height: 18.2px;" /><span style="color: #333333; line-height: 18.2px;">&bull;&nbsp;&nbsp; Thuế VAT</span></p>', ',1,2,3,4,5,', '2016-04-07; 2016-04-15; 2016-04-16', 1, '3 ngày 2 đêm', ',1,2,3,4,5,6,7,', 4, 3, 125, 'Oto', 'admin', '2017-04-20 11:56:35', 1, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tour_comment`
--

CREATE TABLE IF NOT EXISTS `tour_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci,
  `create_time` datetime DEFAULT NULL,
  `deleted` int(11) NOT NULL,
  `evaluation` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tour_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tour_comment`
--

INSERT INTO `tour_comment` (`id`, `content`, `create_time`, `deleted`, `evaluation`, `status`, `tour_id`, `user_id`) VALUES
(1, 'Tour rất tốt', '2016-03-08 15:55:43', 0, 10, 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tour_image`
--

CREATE TABLE IF NOT EXISTS `tour_image` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tour_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=71 ;

--
-- Dumping data for table `tour_image`
--

INSERT INTO `tour_image` (`id`, `name`, `tour_id`) VALUES
(1, '1457337958btw1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 1),
(2, '1457337958cih1448244310_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 1),
(3, '1457337958cko1448244309_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 1),
(4, '1457337958fxn1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 1),
(5, '1457337958hsd1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 1),
(6, '1457337958msh1448244309_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.JPG', 1),
(7, '1457337958mtp1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 1),
(8, '1457337958nhc1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 1),
(9, '1457337958nod1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 1),
(10, '1457337958oda1448244310_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 1),
(11, '1457337958vws1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 1),
(12, '1457337958wkz1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 1),
(13, '1457337958wlp1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.JPG', 1),
(14, '1457337958xih1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 1),
(15, '1457339026btw1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 2),
(16, '1457339026cih1448244310_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 2),
(17, '1457339026cko1448244309_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 2),
(18, '1457339026fxn1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 2),
(19, '1457339026hsd1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 2),
(20, '1457339026msh1448244309_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.JPG', 2),
(21, '1457339026mtp1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 2),
(22, '1457339026nhc1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 2),
(23, '1457339026nod1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 2),
(24, '1457339026oda1448244310_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 2),
(25, '1457339026vws1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 2),
(26, '1457339026wkz1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 2),
(27, '1457339026wlp1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.JPG', 2),
(28, '1457339026xih1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 2),
(29, '1457339189btw1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 3),
(30, '1457339189cih1448244310_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 3),
(31, '1457339189cko1448244309_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 3),
(32, '1457339189fxn1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 3),
(33, '1457339185hsd1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 3),
(34, '1457339185msh1448244309_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.JPG', 3),
(35, '1457339185mtp1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 3),
(36, '1457339185nhc1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 3),
(37, '1457339186nod1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 3),
(38, '1457339186oda1448244310_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 3),
(39, '1457339186vws1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 3),
(40, '1457339186wkz1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 3),
(41, '1457339186wlp1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.JPG', 3),
(42, '1457339186xih1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 3),
(43, '1457339267btw1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 4),
(44, '1457339267cih1448244310_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 4),
(45, '1457339267cko1448244309_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 4),
(46, '1457339267fxn1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 4),
(47, '1457339263hsd1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 4),
(48, '1457339263msh1448244309_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.JPG', 4),
(49, '1457339263mtp1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 4),
(50, '1457339263nhc1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 4),
(51, '1457339264nod1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 4),
(52, '1457339264oda1448244310_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 4),
(53, '1457339264vws1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 4),
(54, '1457339264wkz1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 4),
(55, '1457339264wlp1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.JPG', 4),
(56, '1457339264xih1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 4),
(57, '1457339353btw1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 5),
(58, '1457339353cih1448244310_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 5),
(59, '1457339353cko1448244309_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 5),
(60, '1457339353fxn1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 5),
(61, '1457339350hsd1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 5),
(62, '1457339350msh1448244309_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.JPG', 5),
(63, '1457339350mtp1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 5),
(64, '1457339350nhc1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 5),
(65, '1457339350nod1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 5),
(66, '1457339350oda1448244310_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 5),
(67, '1457339350vws1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 5),
(68, '1457339350wkz1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 5),
(69, '1457339350wlp1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.JPG', 5),
(70, '1457339350xih1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tour_order`
--

CREATE TABLE IF NOT EXISTS `tour_order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `create_time` datetime DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `deleted` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paid` int(11) NOT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `price_payment` int(11) DEFAULT NULL,
  `process_finish_time` datetime DEFAULT NULL,
  `process_start_time` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tour_id` bigint(20) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `user_process` bigint(20) DEFAULT NULL,
  `user_verify` bigint(20) DEFAULT NULL,
  `verify_time` datetime DEFAULT NULL,
  `content_tour` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slot` int(11) DEFAULT NULL,
  `order_note` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tour_order`
--

INSERT INTO `tour_order` (`id`, `create_time`, `date_start`, `deleted`, `ip`, `note`, `order_code`, `paid`, `payment_type`, `price_payment`, `process_finish_time`, `process_start_time`, `status`, `tour_id`, `update_time`, `user_id`, `user_process`, `user_verify`, `verify_time`, `content_tour`, `slot`, `order_note`) VALUES
(7, '2016-04-06 19:34:50', '2016-04-07', 0, '127.0.0.1', 'Đã confirm vé', 'AR0907', 1, 1, 2400000, '2016-04-06 19:39:08', '2016-04-06 19:38:53', 6, 5, '2016-04-06 20:03:34', 0, 8, 6, '2016-04-06 20:03:34', 'a:22:{s:2:"id";s:1:"5";s:11:"create_time";s:19:"2016-03-07 15:29:16";s:7:"deleted";s:1:"0";s:12:"from_area_id";s:1:"3";s:16:"from_national_id";s:1:"2";s:16:"from_province_id";s:2:"98";s:4:"name";s:61:"Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm";s:15:"partner_tour_id";s:1:"1";s:7:"picture";s:80:"1457339308_fxn1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg";s:5:"price";s:7:"1200000";s:10:"service_id";s:11:",1,2,3,4,5,";s:10:"start_date";s:10:"2016-04-07";s:6:"status";s:1:"1";s:4:"time";s:15:"3 ngày 2 đêm";s:8:"topic_id";s:15:",1,2,3,4,5,6,7,";s:10:"to_area_id";s:1:"3";s:14:"to_national_id";s:1:"2";s:14:"to_province_id";s:3:"114";s:14:"transportation";s:3:"Oto";s:9:"update_by";s:5:"admin";s:11:"update_time";s:19:"2016-04-06 18:39:52";s:7:"user_id";s:1:"1";}', 2, NULL),
(8, '2016-04-20 20:52:49', '2016-04-21', 0, '127.0.0.1', '', 'HI3698', 0, 1, 1200000, '2016-04-22 18:57:15', '2016-04-22 18:57:06', 5, 4, '2016-04-22 18:57:15', 0, 8, NULL, NULL, 'a:23:{s:2:"id";s:1:"4";s:11:"create_time";s:19:"2016-03-07 15:27:50";s:7:"deleted";s:1:"0";s:12:"from_area_id";s:1:"3";s:16:"from_national_id";s:1:"2";s:16:"from_province_id";s:2:"98";s:4:"name";s:61:"Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm";s:15:"partner_tour_id";s:1:"1";s:7:"picture";s:80:"1457339225_xih1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg";s:5:"price";s:7:"1200000";s:10:"service_id";s:11:",1,2,3,4,5,";s:10:"start_date";s:24:"2016-04-21; 2016-04-22; ";s:6:"status";s:1:"1";s:4:"time";s:15:"3 ngày 2 đêm";s:8:"topic_id";s:15:",1,2,3,4,5,6,7,";s:10:"to_area_id";s:1:"3";s:14:"to_national_id";s:1:"2";s:14:"to_province_id";s:3:"114";s:14:"transportation";s:3:"oto";s:9:"update_by";s:5:"admin";s:11:"update_time";s:19:"2016-04-20 20:52:26";s:7:"user_id";s:1:"1";s:13:"hide_provider";s:1:"1";}', 1, NULL),
(9, '2016-04-20 22:20:22', '2016-04-22', 0, '127.0.0.1', '', 'RD6229', 0, 1, 1200000, '2016-04-22 18:57:23', '2016-04-22 18:57:17', 5, 4, '2016-04-22 18:57:23', 0, 8, NULL, NULL, 'a:23:{s:2:"id";s:1:"4";s:11:"create_time";s:19:"2016-03-07 15:27:50";s:7:"deleted";s:1:"0";s:12:"from_area_id";s:1:"3";s:16:"from_national_id";s:1:"2";s:16:"from_province_id";s:2:"98";s:4:"name";s:61:"Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm";s:15:"partner_tour_id";s:1:"1";s:7:"picture";s:80:"1457339225_xih1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg";s:5:"price";s:7:"1200000";s:10:"service_id";s:11:",1,2,3,4,5,";s:10:"start_date";s:24:"2016-04-21; 2016-04-22; ";s:6:"status";s:1:"1";s:4:"time";s:15:"3 ngày 2 đêm";s:8:"topic_id";s:15:",1,2,3,4,5,6,7,";s:10:"to_area_id";s:1:"3";s:14:"to_national_id";s:1:"2";s:14:"to_province_id";s:3:"114";s:14:"transportation";s:3:"oto";s:9:"update_by";s:5:"admin";s:11:"update_time";s:19:"2016-04-20 20:52:26";s:7:"user_id";s:1:"1";s:13:"hide_provider";s:1:"1";}', 1, NULL),
(10, '2016-04-20 22:22:17', '2016-04-22', 0, '127.0.0.1', '', 'JS73710', 0, 1, 1200000, '2016-04-22 18:57:33', '2016-04-22 18:57:27', 5, 4, '2016-04-22 18:57:33', 0, 8, NULL, NULL, 'a:23:{s:2:"id";s:1:"4";s:11:"create_time";s:19:"2016-03-07 15:27:50";s:7:"deleted";s:1:"0";s:12:"from_area_id";s:1:"3";s:16:"from_national_id";s:1:"2";s:16:"from_province_id";s:2:"98";s:4:"name";s:61:"Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm";s:15:"partner_tour_id";s:1:"1";s:7:"picture";s:80:"1457339225_xih1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg";s:5:"price";s:7:"1200000";s:10:"service_id";s:11:",1,2,3,4,5,";s:10:"start_date";s:24:"2016-04-21; 2016-04-22; ";s:6:"status";s:1:"1";s:4:"time";s:15:"3 ngày 2 đêm";s:8:"topic_id";s:15:",1,2,3,4,5,6,7,";s:10:"to_area_id";s:1:"3";s:14:"to_national_id";s:1:"2";s:14:"to_province_id";s:3:"114";s:14:"transportation";s:3:"oto";s:9:"update_by";s:5:"admin";s:11:"update_time";s:19:"2016-04-20 20:52:26";s:7:"user_id";s:1:"1";s:13:"hide_provider";s:1:"1";}', 1, NULL),
(11, '2016-04-20 22:24:43', '2016-04-21', 0, '127.0.0.1', '', 'CI88311', 0, 1, 2400000, '2016-04-22 18:57:41', '2016-04-22 18:57:36', 5, 4, '2016-04-22 18:57:41', 0, 8, NULL, NULL, 'a:23:{s:2:"id";s:1:"4";s:11:"create_time";s:19:"2016-03-07 15:27:50";s:7:"deleted";s:1:"0";s:12:"from_area_id";s:1:"3";s:16:"from_national_id";s:1:"2";s:16:"from_province_id";s:2:"98";s:4:"name";s:61:"Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm";s:15:"partner_tour_id";s:1:"1";s:7:"picture";s:80:"1457339225_xih1448244308_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg";s:5:"price";s:7:"1200000";s:10:"service_id";s:11:",1,2,3,4,5,";s:10:"start_date";s:24:"2016-04-21; 2016-04-22; ";s:6:"status";s:1:"1";s:4:"time";s:15:"3 ngày 2 đêm";s:8:"topic_id";s:15:",1,2,3,4,5,6,7,";s:10:"to_area_id";s:1:"3";s:14:"to_national_id";s:1:"2";s:14:"to_province_id";s:3:"114";s:14:"transportation";s:3:"oto";s:9:"update_by";s:5:"admin";s:11:"update_time";s:19:"2016-04-20 20:52:26";s:7:"user_id";s:1:"1";s:13:"hide_provider";s:1:"1";}', 2, NULL),
(12, '2016-04-21 19:58:31', '2016-04-21', 0, '127.0.0.1', '', 'KP51112', 0, 1, 2400000, '2016-04-22 18:57:49', '2016-04-22 18:57:44', 5, 3, '2016-04-22 18:57:49', 0, 8, NULL, NULL, 'a:23:{s:2:"id";s:1:"3";s:11:"create_time";s:19:"2016-03-07 15:26:32";s:7:"deleted";s:1:"0";s:12:"from_area_id";s:1:"3";s:16:"from_national_id";s:1:"2";s:16:"from_province_id";s:2:"98";s:4:"name";s:61:"Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm";s:15:"partner_tour_id";s:1:"1";s:7:"picture";s:80:"1457339137_mtp1448244290_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg";s:5:"price";s:7:"1200000";s:10:"service_id";s:11:",1,2,3,4,5,";s:10:"start_date";s:1:"1";s:6:"status";s:1:"1";s:4:"time";s:15:"3 ngày 2 đêm";s:8:"topic_id";s:15:",1,2,3,4,5,6,7,";s:10:"to_area_id";s:1:"3";s:14:"to_national_id";s:1:"2";s:14:"to_province_id";s:3:"114";s:14:"transportation";s:3:"Oto";s:9:"update_by";s:5:"admin";s:11:"update_time";s:19:"2016-03-07 15:26:32";s:7:"user_id";s:1:"1";s:13:"hide_provider";N;}', 2, 'Test'),
(13, '2016-04-22 18:55:49', '2016-04-15', 0, '127.0.0.1', '', 'RV14913', 1, 1, 3600000, '2016-04-22 18:57:57', '2016-04-22 18:57:52', 6, 5, '2016-04-22 18:58:17', 0, 8, 6, '2016-04-22 18:58:17', 'a:23:{s:2:"id";s:1:"5";s:11:"create_time";s:19:"2016-03-07 15:29:16";s:7:"deleted";s:1:"0";s:12:"from_area_id";s:1:"3";s:16:"from_national_id";s:1:"2";s:16:"from_province_id";s:2:"98";s:4:"name";s:61:"Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm";s:15:"partner_tour_id";s:1:"1";s:7:"picture";s:80:"1457339308_fxn1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg";s:5:"price";s:7:"1200000";s:10:"service_id";s:11:",1,2,3,4,5,";s:10:"start_date";s:34:"2016-04-07; 2016-04-15; 2016-04-16";s:6:"status";s:1:"1";s:4:"time";s:15:"3 ngày 2 đêm";s:8:"topic_id";s:15:",1,2,3,4,5,6,7,";s:10:"to_area_id";s:1:"3";s:14:"to_national_id";s:1:"2";s:14:"to_province_id";s:3:"114";s:14:"transportation";s:3:"Oto";s:9:"update_by";s:5:"admin";s:11:"update_time";s:19:"2016-04-20 20:29:11";s:7:"user_id";s:1:"1";s:13:"hide_provider";s:1:"1";}', 3, 'Test'),
(14, '2016-04-25 19:12:15', '2016-04-07', 0, '127.0.0.1', '', 'SW33514', 1, 1, 1200000, NULL, NULL, 6, 5, '2016-04-25 19:18:48', 0, NULL, NULL, NULL, 'a:23:{s:2:"id";s:1:"5";s:11:"create_time";s:19:"2016-03-07 15:29:16";s:7:"deleted";s:1:"0";s:12:"from_area_id";s:1:"3";s:16:"from_national_id";s:1:"2";s:16:"from_province_id";s:2:"98";s:4:"name";s:61:"Tour Du Lịch Nha Trang - Đà Lạt Trong 3 Ngày 2 Đêm";s:15:"partner_tour_id";s:1:"1";s:7:"picture";s:80:"1457339308_fxn1448244289_tour-du-li-ch-nha-trang-da-la-t-trong-3-nga-y-2-dem.jpg";s:5:"price";s:7:"1200000";s:10:"service_id";s:11:",1,2,3,4,5,";s:10:"start_date";s:34:"2016-04-07; 2016-04-15; 2016-04-16";s:6:"status";s:1:"1";s:4:"time";s:15:"3 ngày 2 đêm";s:8:"topic_id";s:15:",1,2,3,4,5,6,7,";s:10:"to_area_id";s:1:"3";s:14:"to_national_id";s:1:"2";s:14:"to_province_id";s:3:"114";s:14:"transportation";s:3:"Oto";s:9:"update_by";s:5:"admin";s:11:"update_time";s:19:"2016-04-20 20:29:11";s:7:"user_id";s:1:"1";s:13:"hide_provider";s:1:"1";}', 1, 'Lưu ý');

-- --------------------------------------------------------

--
-- Table structure for table `tour_order_contact`
--

CREATE TABLE IF NOT EXISTS `tour_order_contact` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tour_order_contact`
--

INSERT INTO `tour_order_contact` (`id`, `name`, `phone`, `address`, `order_id`, `email`, `province_id`) VALUES
(11, 'Anh Tuấn', '123123', '12323', 7, 'anhtuan150787@gmail.com', 98),
(12, '223423', '123', '123123', 8, 'anhtuan150787@gmail.com', 122),
(13, 'Anh Tuấn', '123123', '123123', 9, 'anhtuan150787@gmail.com', 98),
(14, 'Anh Tuan', '234234', '12312', 10, 'anhtuan150787@gmail.com', 98),
(15, 'Anh Tuấn', '123123', '123123', 11, 'anhtuan150787@gmail.com', 98),
(16, 'ANh Tuan', '09445111312', '123123', 12, 'anhtuan150787@gmail.com', 98),
(17, 'Anh Tuấn', '0944518855', 'Test', 13, 'anhtuan150787@gmail.com', 98),
(18, 'Anh Tuấn', '0944518855', '12321', 14, 'anhtuan150787@gmail.com', 98);

-- --------------------------------------------------------

--
-- Table structure for table `tour_service`
--

CREATE TABLE IF NOT EXISTS `tour_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tour_service`
--

INSERT INTO `tour_service` (`id`, `name`, `status`, `deleted`) VALUES
(1, 'Bảo hiểm', 1, 0),
(2, 'Hướng dẫn viên', 1, 0),
(3, 'Vé tham quan', 1, 0),
(4, 'Xe đưa đón', 1, 0),
(5, 'Bữa ăn', 1, 0),
(6, 'Hỗ trợ người khuyết tật', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tour_topic`
--

CREATE TABLE IF NOT EXISTS `tour_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tour_topic`
--

INSERT INTO `tour_topic` (`id`, `name`, `status`, `deleted`) VALUES
(1, 'Du lịch khám phá', 1, 0),
(2, 'Du lịch biển đảo', 1, 0),
(3, 'Du lịch lễ hội', 1, 0),
(4, 'Du lịch Tuần trăng mật', 1, 0),
(5, 'Du lịch gia đình', 1, 0),
(6, 'Du lịch nghỉ dưỡng', 1, 0),
(7, 'Du lịch hành hương', 1, 0),
(8, 'Du lịch xuyên Việt', 1, 0),
(9, 'Du lịch hành hương', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `user_app_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`, `status`, `create_time`, `update_time`, `update_by`, `type`, `description`, `user_id`, `deleted`, `user_app_id`, `login_time`) VALUES
(1, 'Anh Tuấn', 'anhtuan150787@yahoo.com', NULL, '550e1bafe077ff0b0b67f4e32f29d751', 1, '2015-12-26 14:51:22', '2015-12-27 15:41:16', 'admin', 'insite', NULL, NULL, 0, NULL, '2017-04-28 13:54:57'),
(2, 'Anh Tuấn', 'anhtuan150787@gmail.com', NULL, '550e1bafe077ff0b0b67f4e32f29d751', 1, '2016-04-09 10:33:04', NULL, NULL, 'insite', NULL, NULL, 0, NULL, '2017-04-28 13:54:57'),
(3, 'Nhí Lê Hoàng', 'hoangle2010@gmail.com', NULL, NULL, 1, '2017-04-20 11:07:24', NULL, NULL, 'google', NULL, NULL, 0, '110901412882294854355', '2017-04-28 13:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE IF NOT EXISTS `ward` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `national_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`id`, `name`, `status`, `national_id`, `area_id`, `province_id`, `district_id`, `type`, `deleted`) VALUES
(2, 'Phường 7', 1, 2, 3, 98, 2, 'Phường', 0),
(3, 'Phường 1', 1, 2, 3, 98, 2, 'Phường', 0),
(4, 'Phường 2', 1, 2, 3, 98, 3, 'Phường', 0),
(5, 'Phường 3', 1, 2, 3, 98, 5, 'Phường', 0),
(6, 'Phường 4', 1, 2, 3, 98, 7, 'Phường', 0),
(7, 'Phường 5', 1, 2, 3, 98, 9, 'Phường', 0),
(8, 'Phường 6', 1, 2, 3, 98, 10, 'Phường', 0),
(9, 'Phường 7', 1, 2, 3, 98, 11, 'Phường', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
