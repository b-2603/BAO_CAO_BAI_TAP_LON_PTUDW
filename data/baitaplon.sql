-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 31, 2026 at 08:10 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `baitaplon`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `danhmuc`
-- 

CREATE TABLE `danhmuc` (
  `dm_iddanhmuc` int(10) unsigned NOT NULL auto_increment,
  `dm_ten` varchar(100) collate utf8_unicode_ci NOT NULL,
  `dm_mota` text collate utf8_unicode_ci NOT NULL,
  `dm_motachitiet` text collate utf8_unicode_ci NOT NULL,
  `dm_anh1` varchar(255) collate utf8_unicode_ci NOT NULL,
  `dm_anh2` varchar(255) collate utf8_unicode_ci NOT NULL,
  `dm_anh3` varchar(255) collate utf8_unicode_ci NOT NULL,
  `dm_anhsub1` varchar(255) collate utf8_unicode_ci NOT NULL,
  `dm_anhsub2` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`dm_iddanhmuc`),
  UNIQUE KEY `dm_ten` (`dm_ten`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `danhmuc`
-- 

INSERT INTO `danhmuc` (`dm_iddanhmuc`, `dm_ten`, `dm_mota`, `dm_motachitiet`, `dm_anh1`, `dm_anh2`, `dm_anh3`, `dm_anhsub1`, `dm_anhsub2`) VALUES 
(1, 'THE HOLIDAY SHOP', 'Welcome to Holiday Season – Celebrate in Style', '"Welcome to the Holiday Season collection, where you’ll find everything you need to celebrate in style. From festive decorations to cozy home essentials, we have the perfect products to make your holiday season unforgettable."', 'https://i.postimg.cc/Gt1jZx9p/carousel-pic1.jpg', 'https://i.postimg.cc/K8Y5Szct/carousel-pic2.jpg', 'https://i.postimg.cc/RZbLMBqy/carousel-pic3.jpg', 'https://i.postimg.cc/FKdgzBLR/noel.jpg', 'https://i.postimg.cc/B62TcPNf/tet.jpg'),
(2, 'BEDDING', 'Welcome to Bedding – Comfort for Your Bed', '"Welcome to our Bedding collection, where comfort meets style. Explore a wide range of luxurious bed linens, including sheets, blankets, and comforters, all designed to enhance your sleep experience. Fast delivery ensures you receive your perfect bedding in no time!"', 'https://i.postimg.cc/4yZz84F7/carousel-pic1.jpg', 'https://i.postimg.cc/zvjT4m9d/carousel-pic2.jpg', 'https://i.postimg.cc/9XtPDTrG/carousel-pic3.jpg', 'https://i.postimg.cc/X7JFHPYv/1.jpg', 'https://i.postimg.cc/3wMvwJCy/2.jpg'),
(3, 'RUGS', 'Welcome to Rugs – Style and Comfort Underfoot', '"Discover our stunning collection of Rugs, designed to add both style and comfort to any space. Whether you''re looking for luxurious textures or vibrant patterns, our rugs elevate your home’s decor. Fast delivery ensures your perfect rug is at your doorstep in no time!"', 'https://i.postimg.cc/52j8KRp3/carousel-pic1.jpg', 'https://i.postimg.cc/JzgZf52W/carousel-pic2.jpg', 'https://i.postimg.cc/Ssb8sN4T/carousel-pic3.jpg', 'https://i.postimg.cc/L40hX8mH/1.jpg', 'https://i.postimg.cc/vHJBr21k/2.jpg'),
(4, 'MIRRORS & WALL ART', 'Welcome to Mirrors – Enhance Your Space', '"Discover a wide selection of Mirrors to enhance your living space. Whether you’re looking for sleek modern designs or timeless classics, our mirrors bring style and sophistication to any room. Enjoy fast delivery and elevate your decor effortlessly!"', 'https://i.postimg.cc/yYpZRTBS/carousel-pic1.jpg', 'https://i.postimg.cc/cLVt94vx/carousel-piic2.jpg', 'https://i.postimg.cc/zBNbNtw4/carousel-pic3.jpg', 'https://i.postimg.cc/85bFzRtc/1.jpg', 'https://i.postimg.cc/qqMNhN5L/2.jpg'),
(5, 'KITCHEN', 'Welcome to Kitchen – Your Culinary Space', '"Explore our Kitchen collection, where functionality meets style. From cookware to utensils, we offer high-quality products designed to enhance your cooking experience. Fast delivery ensures your kitchen essentials arrive right when you need them!"\r\n', 'https://i.postimg.cc/25Qy0dpG/carousel-pic1.jpg', 'https://i.postimg.cc/Wz34pQdY/carousel-pic2.jpg', 'https://i.postimg.cc/4ySxYBtf/carousel-pic3.jpg', 'https://i.postimg.cc/9fpQjWxH/2.jpg', 'https://i.postimg.cc/5t12GHSm/1.jpg\r\n'),
(6, 'ARCHIVE SALE', 'Welcome to Archive Sale – Unbeatable Discounts\r\n', '"Welcome to our Archive Sale, where you’ll find incredible discounts on a wide variety of home decor and furniture items. Whether you''re looking for rugs, bedding, or furniture, enjoy huge savings on premium products. Limited time offers and fast delivery available!"', 'https://i.postimg.cc/Ssb8sN4T/carousel-pic3.jpg', 'https://i.postimg.cc/sDWrPjC9/carousel-pic2.jpg', 'https://i.postimg.cc/7LK8PbSD/carousel-pic3.jpg', 'https://i.postimg.cc/B6tWjsCF/1.jpg', 'https://i.postimg.cc/1XNLKH25/2.jpg');

-- --------------------------------------------------------

-- 
-- Table structure for table `danhmuccon`
-- 

CREATE TABLE `danhmuccon` (
  `dmc_idcon` int(10) unsigned NOT NULL auto_increment,
  `dmc_tencon` varchar(255) collate utf8_unicode_ci NOT NULL,
  `dm_iddanhmuc` int(10) unsigned NOT NULL,
  `dmc_mota` text collate utf8_unicode_ci NOT NULL,
  `dmc_motachitiet` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`dmc_idcon`),
  UNIQUE KEY `dmc_tencon` (`dmc_tencon`),
  KEY `dm_iddanhmuc` (`dm_iddanhmuc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `danhmuccon`
-- 

INSERT INTO `danhmuccon` (`dmc_idcon`, `dmc_tencon`, `dm_iddanhmuc`, `dmc_mota`, `dmc_motachitiet`) VALUES 
(1, 'Christmas', 1, 'Welcome to Christmas – Celebrate in Style', '"Welcome to Christmas, where you’ll find festive decor to make your space merry and bright. We offer a wide range of high-quality products, from decorations to furniture, to help you celebrate in style. Fast delivery ensures your items arrive just in time for the holiday season!"'),
(2, 'Lunar New Year', 1, 'Welcome to Holiday Tet – Elevate Your Space', '"Welcome to Holiday Tết, where you’ll find unique decor to brighten your space this festive season. We offer high-quality products, from furniture to decorations, for the perfect Tết celebration. Fast delivery ensures your items arrive on time!"'),
(3, 'Duvets & Quilts', 2, 'Welcome to Bedding, Duvets & Quilts – Comfort and Style', '"Welcome to our Bedding, Duvets & Quilts collection, where comfort meets luxury. Find a wide variety of high-quality bedding sets, duvets, and quilts designed to provide the perfect sleep experience. Fast delivery ensures you receive your cozy essentials right on time!"'),
(4, 'Fillows', 2, 'Welcome to Pillows – Sleep in Comfort', '"Welcome to our Pillows collection, where comfort and support go hand in hand. Discover a variety of premium pillows designed to provide you with the best night''s sleep. Fast delivery ensures you can enjoy your perfect pillow without delay!"'),
(5, 'Area Rugs', 3, 'Welcome to Rugs & Area Rugs – Style and Comfort for Your Floor', '"Welcome to our Rugs & Area Rugs collection, where style meets functionality. Discover a wide selection of beautifully designed rugs and area rugs that will add warmth and personality to any room. With fast delivery, your perfect rug is just a few clicks away!"'),
(6, 'Jute Rugs', 3, 'Welcome to Jute Rugs – Natural Beauty for Your Home', '"Explore our collection of Jute Rugs, where natural beauty meets durability. Crafted from eco-friendly materials, these rugs add a warm, rustic touch to your home. Fast delivery ensures your stylish jute rug arrives in no time, perfect for any room."'),
(7, 'Mirrors', 4, 'Welcome to Mirrors – Reflect Your Style', '"Explore our collection of Mirrors, designed to add elegance and depth to your space. From modern designs to classic styles, find the perfect mirror to complement your home decor. With fast delivery, your stylish mirror will reflect your space in no time!"'),
(8, 'Wall Hangings', 4, 'Welcome to Mirrors & Wall Hangings – Reflect Your Style', '"Discover our Mirrors & Wall Hangings collection, where design meets functionality. From elegant mirrors to decorative wall pieces, we offer a variety of styles to suit every room. Fast delivery ensures your new decor arrives promptly!"'),
(9, 'Drinkware & Bar', 5, 'Welcome to Kitchen, Drinkware & Bar – Elevate Your Entertaining', '"Explore our Kitchen, Drinkware & Bar collection, where functionality meets style. From elegant glassware to sophisticated bar tools, find everything you need to entertain with ease. Fast delivery ensures your items arrive on time, so you can start hosting in style!"'),
(10, 'Kitchen Linens', 5, 'Welcome to Kitchen, Kitchen Linens – Style and Functionality', '"Discover our Kitchen and Kitchen Linens collection, where practicality meets elegance. From dish towels to table runners, we offer high-quality linens that enhance your kitchen while keeping it functional. Fast delivery ensures you get your essentials just in time!"'),
(11, 'Rugs', 6, 'Welcome to Archive Sale – Rugs at Unbelievable Prices', 'Discover incredible savings on premium rugs in our Archive Sale. From elegant area rugs to stylish accent pieces, find the perfect rug to complement your space at unbeatable prices. Fast delivery to bring your new rugs home in no time!"'),
(12, 'Beding', 6, 'Welcome to Archive Sale – Bedding at Unbeatable Prices', '"Explore our Archive Sale on Bedding, featuring incredible discounts on high-quality sheets, duvets, and more. Revamp your bedroom with luxurious bedding at prices you’ll love. Don’t miss out—fast delivery available!"');

-- --------------------------------------------------------

-- 
-- Table structure for table `donhang`
-- 

CREATE TABLE `donhang` (
  `dh_id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `dh_ngaytao` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `dh_tongtien` float NOT NULL,
  `dh_trangthai` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`dh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `donhang`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `donhang_chitiet`
-- 

CREATE TABLE `donhang_chitiet` (
  `dhct_id` int(10) unsigned NOT NULL auto_increment,
  `dh_id` int(11) NOT NULL,
  `dhct_soluong` int(11) NOT NULL,
  `dhct_giabansp` float NOT NULL,
  `dhct_thanhtien` float NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `dhct_tensp` varchar(255) collate utf8_unicode_ci NOT NULL,
  `dhct_anhsp` varchar(200) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`dhct_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `donhang_chitiet`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `giohang`
-- 

CREATE TABLE `giohang` (
  `gh_id` int(10) unsigned NOT NULL auto_increment,
  `gh_ngaytao` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `gh_iduser` int(11) NOT NULL,
  `gh_tongtien` int(11) NOT NULL,
  PRIMARY KEY  (`gh_id`),
  UNIQUE KEY `gh_iduser` (`gh_iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `giohang`
-- 

INSERT INTO `giohang` (`gh_id`, `gh_ngaytao`, `gh_iduser`, `gh_tongtien`) VALUES 
(1, '2026-01-08 11:22:23', 2, 1052000);

-- --------------------------------------------------------

-- 
-- Table structure for table `giohang_chitiet`
-- 

CREATE TABLE `giohang_chitiet` (
  `ctgh_id` int(10) unsigned NOT NULL auto_increment,
  `gh_id` int(11) NOT NULL,
  `ctgh_tongtien` float NOT NULL,
  `ctgh_kichthuoc` varchar(100) collate utf8_unicode_ci NOT NULL,
  `ctgh_idsp` int(11) NOT NULL,
  `ctgh_soluong` int(11) NOT NULL,
  `ctgh_ngaythem` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `ctgh_gia` float NOT NULL,
  `ghct_anhsp` varchar(255) collate utf8_unicode_ci NOT NULL,
  `ghct_tensp` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ctgh_id`),
  KEY `gh_id` (`gh_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `giohang_chitiet`
-- 

INSERT INTO `giohang_chitiet` (`ctgh_id`, `gh_id`, `ctgh_tongtien`, `ctgh_kichthuoc`, `ctgh_idsp`, `ctgh_soluong`, `ctgh_ngaythem`, `ctgh_gia`, `ghct_anhsp`, `ghct_tensp`) VALUES 
(4, 1, 537000, 'Medium', 1, 3, '2026-01-08 11:00:00', 179000, 'https://i.postimg.cc/QC3qMytg/1.webp', 'Fresh Olive Wreath'),
(5, 1, 400000, 'Full/Queen', 17, 1, '2026-01-08 11:01:19', 400000, 'https://i.postimg.cc/k5pY8SZM/Stonewashed-Linen-Duvet-Sand-1-4f18c531-336e-448c-9745-f4c2f570cbbd.webp', 'Stonewashed Linen Duvet Cover'),
(6, 1, 50000, '1m', 9, 1, '2026-01-08 11:20:26', 50000, 'https://i.postimg.cc/mDMwxDTb/vn-11134207-7ras8-m45ijt801wi7ae.webp', 'Paper Streamers for Festival '),
(7, 1, 65000, '\r\n10''W x 21''H', 5, 1, '2026-01-08 11:22:23', 65000, 'https://i.postimg.cc/cLK32MJ0/holidaybatch1crop-013.webp', 'Isidora Stocking');

-- --------------------------------------------------------

-- 
-- Table structure for table `login_admin`
-- 

CREATE TABLE `login_admin` (
  `ad_id` varchar(10) collate utf8_unicode_ci NOT NULL,
  `ad_ten` varchar(100) collate utf8_unicode_ci NOT NULL,
  `ad_chucvu` varchar(100) collate utf8_unicode_ci NOT NULL,
  `ad_email` varchar(200) collate utf8_unicode_ci NOT NULL,
  `ad_sdt` varchar(11) collate utf8_unicode_ci NOT NULL,
  `ad_ngaytaotk` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `ad_pass` varchar(256) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ad_id`),
  KEY `ad_pass` (`ad_pass`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `login_admin`
-- 

INSERT INTO `login_admin` (`ad_id`, `ad_ten`, `ad_chucvu`, `ad_email`, `ad_sdt`, `ad_ngaytaotk`, `ad_pass`) VALUES 
('', '', '', '', '', '2026-03-30 10:37:27', ''),
('1', 'Haohaao78', 'không có', 'Haohaao78@gmail.com', '0339601700', '2026-03-30 10:56:12', '3d1c94305387674e163024dca61d2234e5a8cc5f'),
('2', 'baobao26', 'không có', 'baobao@gmail.com', '0328754062', '2026-03-30 10:56:12', '41997d8918bc111ae819eb065e35a51bf7f49347'),
('4', 'Bao', 'admin', 'Bao11@gmail.com', '0939388848', '2026-03-30 10:57:10', '60e1653076bd10c964da27f4068420b48adfc558');

-- --------------------------------------------------------

-- 
-- Table structure for table `login_user`
-- 

CREATE TABLE `login_user` (
  `user_firstname` varchar(50) collate utf8_unicode_ci NOT NULL,
  `user_lastname` varchar(50) collate utf8_unicode_ci NOT NULL,
  `user_pass` varchar(255) collate utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL auto_increment,
  `user_ngaytaotk` date NOT NULL,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_lastname` (`user_lastname`),
  KEY `user_pass` (`user_pass`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `login_user`
-- 

INSERT INTO `login_user` (`user_firstname`, `user_lastname`, `user_pass`, `user_email`, `user_id`, `user_ngaytaotk`) VALUES 
('Hoaa', 'Haoooo', '72bb0417b2a1363f98889c00af854af5e81cda40', 'Haohaao711118@iuh.edu.vn', 1, '2025-10-21'),
('Hoaa', 'Haoooooo', 'a331039b4a5efe30a22e3dcccf0dcf8ddb75d097', 'Haohaao71111888@iuh.edu.vn', 2, '2025-10-21'),
('Khanh', 'Khanh', '0407eeff0b0aeff976844f40a5cca8973c55d5c6', 'Khanh111@gmail.com', 3, '2026-03-30'),
('Quoc', 'Khang', 'fc0ac755f6532f726463c16bcda85503f86f930a', 'Khanh@gmail.com', 4, '2026-03-30');

-- --------------------------------------------------------

-- 
-- Table structure for table `sanpham`
-- 

CREATE TABLE `sanpham` (
  `sp_id` int(10) unsigned NOT NULL auto_increment,
  `dmc_idcon` int(11) NOT NULL,
  `sp_ten` varchar(200) collate utf8_unicode_ci NOT NULL,
  `sp_gia` float NOT NULL,
  `sp_anh1` varchar(200) collate utf8_unicode_ci NOT NULL,
  `sp_anh2` varchar(200) collate utf8_unicode_ci NOT NULL,
  `sp_thuoctinh` varchar(50) collate utf8_unicode_ci NOT NULL,
  `dm_iddanhmuc` int(11) NOT NULL,
  `sp_ngaythemsp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`sp_id`),
  UNIQUE KEY `sp_ten` (`sp_ten`),
  KEY `dmc_idcon` (`dmc_idcon`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

-- 
-- Dumping data for table `sanpham`
-- 

INSERT INTO `sanpham` (`sp_id`, `dmc_idcon`, `sp_ten`, `sp_gia`, `sp_anh1`, `sp_anh2`, `sp_thuoctinh`, `dm_iddanhmuc`, `sp_ngaythemsp`) VALUES 
(1, 1, 'Fresh Olive Wreath', 179000, 'https://i.postimg.cc/QC3qMytg/1.webp', 'https://i.postimg.cc/wTKB1d9Y/2.avif', 'banchay', 1, '2025-04-10 20:51:13'),
(2, 2, 'Wedding & Tet Decoration Set', 79000, 'https://i.postimg.cc/Qtnh8qmk/vn-11134207-7ras8-m2ifquimftf6cb.webp', 'https://i.postimg.cc/mgGRgkYq/vn-11134207-7ras8-m2ihkm9d2d9w81-resize-w450-nl.webp', 'banchay', 1, '2025-04-10 20:52:29'),
(3, 1, 'Fresh Eucalyptus Wreath', 199000, 'https://i.postimg.cc/cCyktN06/Fresh-Eucalyptus-Wreath-1.webp', 'https://i.postimg.cc/jS5c5jPZ/Fresh-Eucalyptus-Wreath-4-1.webp', '', 1, '2025-04-10 20:56:16'),
(4, 1, 'Beeswax Taper Candles - Set of 2', 29000, 'https://i.postimg.cc/W3Qr2dYx/holidaycrop2-028.webp', 'https://i.postimg.cc/kXMM2JrH/holidaycrop2-029.webp', '', 1, '2025-04-10 20:58:11'),
(5, 1, 'Isidora Stocking', 65000, 'https://i.postimg.cc/cLK32MJ0/holidaybatch1crop-013.webp', 'https://i.postimg.cc/bv5pMksc/holidaybatch1crop-005.webp', '', 1, '2025-04-10 21:16:33'),
(6, 1, 'Naveta Velvet Gift Bag', 45000, 'https://i.postimg.cc/JhK5W3Xn/CZ-Holiday2024-0803-Update-Silo01-3600.webp', 'https://i.postimg.cc/25Cgwwm8/holidayalt-008.webp', '', 1, '2025-04-10 21:25:13'),
(7, 2, 'Set of 6 Colorful Tet Hanging ', 58000, 'https://i.postimg.cc/FRzmwBdh/vn-11134207-7ras8-m1qguqqpn68jd9-resize-w900-nl.webp', 'https://i.postimg.cc/FzmtNC1f/vn-11134207-7ras8-m1qgx4fa99w3a4.webp', '', 1, '2025-04-10 21:25:00'),
(8, 2, 'English Product Title (7 words)', 35000, 'https://i.postimg.cc/cL67hVSd/vn-11134207-7ras8-m3wxw4h41y94ea.webp', 'https://i.postimg.cc/gjncQqkL/vn-11134207-7ras8-m3wxw4h40jooa3.webp', '', 1, '2025-04-10 21:43:10'),
(9, 2, 'Paper Streamers for Festival ', 50000, 'https://i.postimg.cc/mDMwxDTb/vn-11134207-7ras8-m45ijt801wi7ae.webp', 'https://i.postimg.cc/RZyKMBsq/vn-11134207-7ras8-m45iib6p8tzj26.webp', '', 1, '2025-04-10 22:59:11'),
(10, 1, 'Fresh Olive Garland - 6 ft', 150000, 'https://i.postimg.cc/k41jgdZ0/fresh-olive-garland-1.webp', 'https://i.postimg.cc/4NtrBmjn/Fresh-Olive-Garland-4.webp', '', 1, '2025-04-10 21:00:34'),
(11, 2, 'Red Satin Ribbon Roll for Festive ', 25000, 'https://i.postimg.cc/y86qjqsQ/vn-11134207-7ras8-m476cymgkqfjd8.webp', 'https://i.postimg.cc/hjWpCxVD/vn-11134207-7ras8-m476cymgnj4w70.webp', '', 1, '2025-04-10 22:08:55'),
(12, 1, 'Ojas Triple Bells', 25000, 'https://i.postimg.cc/tJR4hyc2/holidaycrop2-025.webp', 'https://i.postimg.cc/J0HdYHSn/bells-001.webp', '', 1, '2025-04-10 21:01:18'),
(13, 2, 'Paper Lanterns for Festive', 39000, 'https://i.postimg.cc/CMZTvZdW/vn-11134207-7ras8-m4tuhszhkx8634-1.webp', 'https://i.postimg.cc/sgjTN8wv/vn-11134207-7ras8-m4tuht1zfv3q8c.webp', 'banchay', 1, '2025-04-10 22:49:22'),
(14, 2, 'Ornaments for Tree Decoration', 123000, 'https://i.postimg.cc/CMXkbDpd/ea062c1b58a6da2655a5062ba9b76a01.webp', 'https://i.postimg.cc/8CZZhHSx/d400bf506df53949185d90a80361b94f.webp', '', 1, '2025-04-10 22:49:39'),
(15, 1, 'Naveta Velvet Tree Skirt', 59000, 'https://i.postimg.cc/gkf4t52Y/holidaybatch1crop-004.webp', 'https://i.postimg.cc/T1S849pZ/holidaycrop2-002.webp', '', 1, '2025-04-10 21:07:29'),
(16, 2, 'Honeycomb Paper Lantern Red', 35000, 'https://i.postimg.cc/W44mgYvr/vn-11134207-7ras8-m55mz84ba9dv6a.webp', 'https://i.postimg.cc/q7HQKx7x/vn-11134207-7ras8-m55mz84b8utfc3.webp', '', 1, '2025-04-10 23:00:47'),
(17, 3, 'Stonewashed Linen Duvet Cover', 400000, 'https://i.postimg.cc/k5pY8SZM/Stonewashed-Linen-Duvet-Sand-1-4f18c531-336e-448c-9745-f4c2f570cbbd.webp', 'https://i.postimg.cc/Jz9Bk4xV/Stonewashed-Linen-Duvet-Sand-3-44f6dafd-8da5-44c2-90d8-840de10e1b04.webp', 'banchay', 2, '2025-04-11 10:32:01'),
(18, 4, 'Linen Pillowcases with Ties', 79000, 'https://i.postimg.cc/90R6rhBM/Stonewashed-Linen-Pillowcases-With-Ties-Barley-Stripe-1.webp', 'https://i.postimg.cc/WbM2nGM4/Stonewashed-Linen-Pillowcases-With-Ties-Barley-Stripe-2.webp', '', 2, '2025-04-11 10:36:09'),
(19, 4, 'Stonewashed Linen Sheet Set', 289000, 'https://i.postimg.cc/kXffbZBF/Stonewashed-Linen-Sheet-Set-Ivory-1.webp', 'https://i.postimg.cc/k4mxZF2g/Stonewashed-Linen-Sheet-Set-Ivory-2.webp', '', 2, '2025-04-11 10:43:45'),
(20, 4, 'Stonewashed Linen Shams', 89000, 'https://i.postimg.cc/RZMfcQW7/Stonewashed-Linen-Shams-Espresso-1-8db3ff0f-0577-48c1-83a1-0e8a0dbdb833.webp', 'https://i.postimg.cc/zXdDcndS/Stonewashed-Linen-Shams-Espresso-2.webp', '', 2, '2025-04-11 10:48:42'),
(21, 4, 'Stonewashed Linen Pillowcases', 58000, 'https://i.postimg.cc/Y9rMRRcH/Stonewashed-Linen-Pillowcases-Barley-1.webp', 'https://i.postimg.cc/8cF8Xntq/Stonewashed-Linen-Duvet-Barley-3.webp', '', 2, '2025-04-11 11:16:22'),
(22, 3, 'Stonewashed Linen Duvet Cover\r\n', 350000, 'https://i.postimg.cc/v8JhgHpW/Stonewashed-Linen-Duvet-Charcoal-1-7c5ffdb4-b261-4a9d-a334-ce5038f6b8d3.webp', 'https://i.postimg.cc/c47Rv77S/Stonewashed-Linen-Duvet-Charcoal-3-d90bf682-1d4e-4dc5-a5d4-641b340aa11d.webp', 'banchay', 2, '2025-04-11 12:11:24'),
(23, 3, 'Alegria Organic Cotton Quilted', 300000, 'https://i.postimg.cc/3xW8wcw6/Alegria-Organic-Cotton-Quilted-Bed-Blanket-Oat-2.webp', 'https://i.postimg.cc/gjk9TxX5/Alegria-Organic-Cotton-Quilted-Bed-Blanket-Oat-1.webp', '', 2, '2025-04-11 12:29:18');

-- --------------------------------------------------------

-- 
-- Table structure for table `sanpham_chitiet`
-- 

CREATE TABLE `sanpham_chitiet` (
  `sp_id` int(10) unsigned NOT NULL auto_increment,
  `ct_motachitiet` text collate utf8_unicode_ci NOT NULL,
  `ct_danhgia` text collate utf8_unicode_ci NOT NULL,
  `ct_motangan` text collate utf8_unicode_ci NOT NULL,
  `ct_luotdanhgia` int(11) NOT NULL,
  `ct_kichthuoc` text collate utf8_unicode_ci NOT NULL,
  `ct_album1` varchar(255) collate utf8_unicode_ci NOT NULL,
  `ct_album2` varchar(255) collate utf8_unicode_ci NOT NULL,
  `ct_album3` varchar(255) collate utf8_unicode_ci NOT NULL,
  `ct_xuatxu` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`sp_id`),
  KEY `sp_id` (`sp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

-- 
-- Dumping data for table `sanpham_chitiet`
-- 

INSERT INTO `sanpham_chitiet` (`sp_id`, `ct_motachitiet`, `ct_danhgia`, `ct_motangan`, `ct_luotdanhgia`, `ct_kichthuoc`, `ct_album1`, `ct_album2`, `ct_album3`, `ct_xuatxu`) VALUES 
(1, 'Greenery is always a good choice. Add a natural touch to your holiday decor with this stunning wreath, woven from fresh olive leaves for a festive finish. Gathered from olive trees in the Pacific Northwest, this organic statement piece is the perfect accent for any space.\r\n\r\nThis wreath is made fresh with live olive braches and will dry out over the course of a few weeks. Soak in water to revive its appearance, or enjoy the natural look as it dries.\r\n\r\nCrafted at a small workshop in Northern California, each botanical is sourced from farms with sustainable, low-till methods. Partnering with local micro-family or women-owned farms, this workshop uses traditional techniques to create and preserve natural works of art. All made start to finish in a fair trade environment.\r\n\r\n', '*****', 'A classic look for the holiday season, this stunning wreath is handcrafted from lush olive leaves.', 133, 'Medium,Large', 'https://i.postimg.cc/J4LCZrvm/3.webp', 'https://i.postimg.cc/x8PxK2NT/Fresh-Olive-Wreath-Medium-4.webp', 'https://i.postimg.cc/kGjNJXt8/Fresh-Olive-Wreath-Medium-2.webp', 'Northern California'),
(2, 'Celebrate the festive season in style with our Decorative Fan Set, specially designed for weddings, Lunar New Year (Tet), and various celebratory events. This set brings vibrant energy and traditional charm to any space, making it perfect for home decoration, store displays, or party backdrops.\r\n\r\nThe bold red color symbolizes luck, prosperity, and happiness — essential elements of Tet and other joyous occasions. Combined with elegant floral and bead details, each piece adds a touch of sophistication while preserving cultural meaning.\r\n\r\nThis set includes multiple components as shown in the images. The fans are made from durable thick cardstock, allowing you to fully open them into a 360-degree circle or partially unfold them to match your creative decoration ideas. Whether you hang them on walls, doors, or event stands, they are sure to catch everyone''s attention.\r\n\r\nTo make decorating more convenient, the set comes with pre-attached adhesive, so you can easily install them without needing extra tools or tape.', '*****', 'Bring festive cheer to your space with this vibrant red decorative fan set — perfect for weddings.', 120, 'Default', 'https://i.postimg.cc/dVD6M8mR/vn-11134207-7ras8-m2ifquimimk263.webp', 'https://i.postimg.cc/bvytc8j7/vn-11134207-7ras8-m2ifquimeeusa4.webp', 'https://i.postimg.cc/6QPdN3f8/vn-11134207-7ras8-m2ifqv9sv642d9.webp', 'VietNam'),
(3, 'A simple yet elegant addition to your home in any season. Handcrafted in Northern California using locally found materials, this wreath features a mix of silver dollar, seeded, and baby blue eucalyptus. Adding a touch of natural beauty and bringing a subtle, soothing fragrance to your space, each wreath is thoughtfully crafted to look beautiful when fresh and as it naturally dries over time.\r\n\r\nThis wreath is made fresh with live eucalptus and will dry out over the course of a few weeks. Soak in water to revive its appearance, or enjoy the natural look as it dries.\r\n\r\nCrafted at a small workshop in Northern California, each botanical is sourced from farms with sustainable, low-till methods. Partnering with local micro-family or women-owned farms, this workshop uses traditional techniques to create and preserve natural works of art. All made start to finish in a fair trade environment.', '*****', 'Experience the natural beauty of this fresh and aromatic eucalyptus wreath, handcrafted in Northern California just for you.\r\n\r\nMedium', 350, '\r\nMedium: 18''-20'' ,Large: 22''-24''', 'https://i.postimg.cc/cCyktN06/Fresh-Eucalyptus-Wreath-1.webp', 'https://i.postimg.cc/jS5c5jPZ/Fresh-Eucalyptus-Wreath-4-1.webp', 'https://i.postimg.cc/2SbWML4R/a-HR0c-HM6-Ly9j-ZG4u-ZGFza-Gh1-ZHNvbi5jb20vb-WVka-WEv-Zn-Vsb-C8x-Nz-M0-OTcz-Mz-Q0-Lj-Ey-Mjk1-NTYy-Mj-M5-NC5qc-GVn.webp', ' Northern California'),
(4, 'A bright spot in any space, these handmade taper candles are crafted from pure beeswax. Available in a range of rich, soothing colors, each 12â€ candle has a burn time of about 10 hours. Style as a rich set on your holiday table or over the fireplace.\r\n\r\nCrafted by hand from 100% beeswax for a longer burn time, these candles are made in collaboration with Greentree Home Candle. Made start-to-finish in a fair trade environment.', '', 'Add a touch of natural charm to any space with the gentle glow of these handmade taper candles.', 0, '12''H', 'https://i.postimg.cc/SQ1Qz0yN/holidaycrop2-031.webp', 'https://i.postimg.cc/fyVV0Dpm/holidaycrop2-032.webp', 'https://i.postimg.cc/PrNsGPnd/holidaycrop2-027.webp', ' USA'),
(5, 'Better gifts start with the best stockings. Just in time for the holiday season, these chunky wool stockings are here to add a touch of holiday cheer. A stunning blend of minimal earth tones, each piece is crafted with a slightly irregular, perfectly-imperfect weave, creating a handmade charm that makes it one of a kind.\r\n\r\nHandwoven by a group of 10 master artisans in Montevideo, Uruguay, each pillow takes up to a day to complete. All made start-to-finish in a fair trade working environment.', '', 'Spruce up your mantel with the neutral tones and chunky wool textures of this stylish stocking.\r\n\r\nTan', 0, '\r\n10''W x 21''H', 'https://i.postimg.cc/q7sxDXmg/holidaybatch1crop-014.webp', 'https://i.postimg.cc/8kjZd38z/holidaybatch1crop-015.webp', 'https://i.postimg.cc/Wzwzq87L/holidaybatch1crop-008.webp', ' Uruguay'),
(6, 'Santa knows a thing or two about bags. Inspired by the spirit of the season, this luxe velvet gift bag is a beautiful accent beside your holiday tree. Whether you style solo or as a stunning set, each bag is the gift that keeps on giving.\r\n\r\nLoomed by a collective of 200 weavers in Panipat, known around the world as Indiaâ€™s City of Weavers, every pillow is Oeko-TexÂ® and Global Organic Textile Standard (GOTS) certified. All sustainably made in a fair trade environment.\r\n\r\n', '', 'Luxe velvet. Rich colors. This stunning gift bag mixes understated elegance with cozy textures.', 0, '\r\n33''W x 40''H, \r\n40''W x 60''H', 'https://i.postimg.cc/JhK5W3Xn/CZ-Holiday2024-0803-Update-Silo01-3600.webp', 'https://i.postimg.cc/25Cgwwm8/holidayalt-008.webp', 'https://i.postimg.cc/25Cgwwm8/holidayalt-008.webp', ' India'),
(7, '\r\nWelcome the Lunar New Year 2025 with vibrant energy using our Set of 6 Tet Hanging Ornaments, specially designed to adorn traditional Tet trees such as mai (apricot blossom) or Ä‘Ã o (peach blossom). Each ornament is crafted in a classic rectangular shape, featuring bright multicolored prints that symbolize luck, prosperity, and good fortune.\r\n\r\nThese Tet ornaments are made from high-quality cardboard paper with vivid printing, lightweight and easy to hang. Whether you decorate your home, office, or shop, these ornaments instantly bring a joyful and festive atmosphere to the space.\r\n\r\nTheir compact size makes them ideal for small to medium-sized Tet trees, branches, or even walls and doors. The set comes ready to use, helping you save time while still celebrating in style.\r\n\r\n', '', 'Brighten up your Tet celebration with this set of 6 colorful hanging ornaments, perfect for decorating apricot or peach blossom trees.', 0, '6 x 8 , 8 x 10', 'https://i.postimg.cc/GhHK9JY9/vn-11134207-7ras8-m1qgx4dmabb315.webp', 'https://i.postimg.cc/1tV6sMbZ/vn-11134207-7ras8-m1qgx4h851a7b1.webp', 'https://i.postimg.cc/9X63mMw3/vn-11134207-7ras8-m1qgx4bycqqbbe.webp', 'VietNam'),
(8, 'Celebrate the Lunar New Year in traditional style with this Combo of 100 Red Calligraphy Tags, designed to bring a touch of Vietnamese culture and festive charm to your home. Each tag features meaningful handwritten-style calligraphy, showcasing popular Tet blessings such as "Phúc" (Happiness), "Lộc" (Wealth), "Thọ" (Longevity), and other auspicious phrases.\r\n\r\nThese tags are ideal for decorating Tet trees like mai (apricot) or đào (peach), or for use as wall, door, or gift decorations. The set includes red hanging strings, making them ready to use with minimal setup. Their vibrant red color and gold accents create a joyful, auspicious look that aligns with the spirit of the new year.\r\n\r\nWhether you''re decorating your house, shop, or office, these calligraphy cards will help create a warm, festive atmosphere filled with hope and prosperity.', '', 'Decorate your Tet tree with elegance using this combo of 100 red calligraphy tags, each carrying wishes of luck and prosperity. Comes with red string for easy hanging.', 0, '3 x 6, 5 x 9, 9 x 12', 'https://i.postimg.cc/mrsqtQJx/vn-11134207-7ras8-m3wxw4h3z4j943.webp', 'https://i.postimg.cc/L8T7gqpn/vn-11134207-7ras8-m3wxw4h3z548e1.webp', 'https://i.postimg.cc/TPBcKGpK/vn-11134207-7ras8-m3wxw4h41xo551.webp', 'VietNam'),
(9, 'Bring joy and movement to your festive space with these long wavy paper streamers, designed to enhance the atmosphere of Tet celebrations, weddings, Mid-Autumn Festival, and cultural events. Made from lightweight, flexible paper, each strip forms natural wave-like curves when hung, creating a sense of flow and dynamic beauty.\r\n\r\nYou can easily hang these streamers along ceilings, walls, archways, or entrance areas to transform your space into a vibrant celebration zone. They come in a variety of bright, eye-catching colors, adding energy and cultural charm wherever they are placed.\r\n\r\nIdeal for both indoor and outdoor decorations, these paper streamers are a simple yet elegant way to elevate your party decor while embracing traditional festive aesthetics.', '', 'Add festive flair to any celebration with these colorful wavy paper streamers â€” perfect for Tet, weddings, Mid-Autumn Festival, and more!\r\n\r\n', 0, '1m, 2m, 3m', 'https://i.postimg.cc/3NxdXSSP/vn-11134207-7ras8-m45iib6p4ma794.webp', 'https://i.postimg.cc/SRRx2Xj4/vn-11134207-7ras8-m45iib6p7ezk2b.webp', 'https://i.postimg.cc/nVWHShCs/vn-11134207-7ras8-m45iib6p7ff3e4.webp', 'VietNam'),
(10, 'Ditch the firs. Put a modern spin on a timeless classic with this lush, elegant garland, crafted from fresh olive leaves from the Pacific Northwest. Long enough to liven up any space, each piece is sure to impress your guests all season long.\r\n\r\nThis garland is made fresh with live olive branches and will dry out over the course of a few weeks. Soak in water to revive its appearance, or enjoy the natural look as it dries.\r\n\r\nCrafted at a small workshop in Northern California, each botanical is sourced from farms with sustainable, low-till methods. Partnering with local micro-family or women-owned farms, this workshop uses traditional techniques to create and preserve natural works of art. All made start to finish in a fair trade environment.', '****', 'Fresh olive leaves are locally foraged to create the lavish textures and natural charm of this stunning garland.', 110, '\r\n6 x 5 ', 'https://i.postimg.cc/d15qQLJJ/Fresh-Olive-Garland-2-Dried.webp', 'https://i.postimg.cc/T3xY98NM/Fresh-Greenery-Over-Time-Graphic-ce8818e5-d08b-4c75-8e52-ea81f1be4647.webp', 'https://i.postimg.cc/6qdx2qX7/Fresh-Olive-Garland-3.webp', ' Northern California'),
(11, 'Add a luxurious finishing touch to your festive decorations or gift wrapping with this high-quality red satin ribbon. Smooth, soft, and rich in color, this ribbon is ideal for celebrating Lunar New Year (Tet), weddings, birthdays, or any holiday occasion where a pop of red signifies luck and happiness.\r\n\r\nWith a sleek solid red color, this ribbon offers both elegance and versatility. Use it to tie gift boxes, wrap around trees or lanterns, make bows, or decorate Tet trees and doorways. The satin finish reflects light beautifully, making your decorations look even more eye-catching.\r\n\r\nEach roll provides 22 meters of ribbon, available in two width options — 2cm or 4cm — to fit different decorative needs. Whether you''re crafting at home or decorating a large event space, this ribbon is a must-have for your celebration supplies.', '****', 'Elegant red satin ribbon roll, perfect for Tet, gift wrapping, and holiday decorations. Available in 2cm or 4cm width, 22 meters long.', 134, '2cm , 4cm', 'https://i.postimg.cc/g09Vdpj4/vn-11134207-7ras8-m476cymgkq0021.webp', 'https://i.postimg.cc/rwGm02gf/vn-11134207-7ras8-m476cymgoy4v6b.webp', 'https://i.postimg.cc/fLVS0gVk/vn-11134207-7ras8-m476cymgnjkf19.webp', 'VietNam'),
(12, 'Make a joyful noise this holiday season with these charming bells. Mixing handmade character with a light brass finish, each piece has a vintage charm thatâ€™s truly timeless. Style them as an understated addition to your family tree or attach them to a stocking to create a seasonal statement piece.\r\n\r\nEach bell is meticulously handcrafted by a group of 35 artisans in Pune, India. Bound together with a cotton string, each piece is made start-to-finish in a fair trade environment.', '', 'Add a few heirloom details to your family tree, stockings, or wreath with the help of these vintage-inspired sleigh bells.\r\n\r\n1', 0, '\r\n12'' H x 1'' W', 'https://i.postimg.cc/J0HdYHSn/bells-001.webp', 'https://i.postimg.cc/J0HdYHSn/bells-001.webp', 'https://i.postimg.cc/J0HdYHSn/bells-001.webp', ' India'),
(13, 'Brighten up your space with these Folding Paper Lanterns, the perfect decorative touch for any joyful occasion. Whether you''re celebrating weddings, Tet (Lunar New Year), Mid-Autumn Festival, birthdays, or creating a dreamy photo studio background — these lanterns add a vibrant, festive atmosphere instantly.\r\n\r\nCrafted from durable, lightweight paper, each lantern can be folded flat for easy storage and reused for future events. Once opened, they form a full sphere or honeycomb shape, offering a 3D effect that brings depth and elegance to your décor.\r\n\r\nHang them from ceilings, doorways, trees, or mix different sizes and colors for a stunning party setup.', '*****', 'Elegant folding lanterns perfect for weddings, Tet, Mid-Autumn Festival, birthdays, and photo studio decor.', 12, 'Defaul', 'https://i.postimg.cc/qvF2xZYf/vn-11134207-7ras8-m4tuhswfnzo71a.webp', 'https://i.postimg.cc/KvzKpDtm/vn-11134207-7ras8-m4tuht1zfvbrac.webp', 'https://i.postimg.cc/nVwVrbQt/vn-11134207-7ras8-m4tuht6fas0nf7.webp', 'VietNam'),
(14, 'Add festive charm to your home with these Tet Hanging Ornaments, specially designed for the Lunar New Year 2025 â€“ Year of the Snake (áº¤t Tá»µ). These ornaments are ideal for hanging on peach blossom (hoa Ä‘Ã o) or apricot blossom (hoa mai) trees, which are traditional Tet symbols in Vietnam.\r\n\r\nCrafted from quality paper and printed with traditional Tet motifs and good-luck messages, each piece reflects cultural values of fortune, happiness, and prosperity. The red and gold color scheme brings a joyful, lucky vibe to your space.\r\n\r\nWhether youâ€™re decorating your home, office, or storefront, these ornaments help create a warm and celebratory atmosphere for Tet.', '', 'Decorative hanging ornaments for Tet 2025, perfect for peach or apricot blossom trees. Celebrate the Year of the Snake in style!\r\n\r\n', 0, 'Defaul', 'https://i.postimg.cc/TwmWRdCQ/8722a179b877b4f08f27c00db62196ef.webp', 'https://i.postimg.cc/YCcZ9br3/20455f2751b7a8ef106ebe0be369b6bc.webp', 'https://i.postimg.cc/W4pvNX8y/36f05b614e30bcec6cb78168ea3f0a7f.webp', 'VietNam'),
(15, 'Putting a luxe spin on a holiday classic, this sophisticated tree skirt is crafted from 100% organic cotton velvet. Available in rich shades of almond and mulberry, each piece warms up your space with its quilted textures and subtle sheen. As much as it shines in any room, we recommend placing it beneath a pile of gifts.\r\n\r\nLoomed by a collective of 200 weavers in Panipat, known around the world as Indiaâ€™s City of Weavers, every piece is Oeko-TexÂ® and Global Organic Textile Standard (GOTS) certified. All sustainably made in a fair trade environment.\r\n\r\n', '', 'Mixing oh-so-soft textures and warm, earthy hues, this velvet tree skirt is a luxe statement piece in any space.', 0, '\r\n52.3'' D', 'https://i.postimg.cc/gkf4t52Y/holidaybatch1crop-004.webp', 'https://i.postimg.cc/CK1xXv1K/holidaybatch1crop-003.webp', 'https://i.postimg.cc/T1S849pZ/holidaycrop2-002.webp', 'India'),
(16, 'Brighten up your space with these Folding Paper Lanterns the perfect decorative touch for any joyful occasion. Whether you are celebrating weddings Tet Lunar New Year Mid Autumn Festival birthdays or creating a dreamy photo studio background these lanterns add a vibrant festive atmosphere instantly.\r\n\r\nCrafted from durable lightweight paper each lantern can be folded flat for easy storage and reused for future events. Once opened they form a full sphere or honeycomb shape offering a 3D effect that brings depth and elegance to your decor.\r\n\r\nHang them from ceilings doorways trees or mix different sizes and colors for a stunning party setup.', '', 'Elegant honeycomb paper lantern in red and gold, decorated with tassels. Ideal for Tet, weddings, and festive events.', 0, 'Defaul', 'https://i.postimg.cc/brf2C3Km/vn-11134207-7ras8-m55mz82xawfs0b.webp', 'https://i.postimg.cc/3Nr3xGpK/vn-11134207-7ras8-m55mz83ha37c46.webp', 'https://i.postimg.cc/WzTQ7PbS/vn-11134207-7ras8-m55mz82nbb209a.webp', 'VietNam'),
(17, 'Set the stage for an effortlessly cool bedroom. Breathable yet warm, this duvet cover is the perfect layer from summer to winter. Garment washed to give you an airy, soft, most perfectly worn feel ever (no, really). Available in luxe, earthy hues, this duvet cover is designed to mix and match with our bedding collection to create a look thatâ€™s inherently your own.\r\n\r\nMade using only the finest French flax and woven in the oldest, family-run linen mill in Portugal, each piece is Oeko-TexÂ® certified and made sustainably in a fair trade working environment.\r\n\r\nFull/Queen Duvet + Sham Set includes:\r\n- 1 full/queen duvet cover\r\n- 2 standard shams\r\n\r\nKing/Cal King Duvet + Sham Set includes:\r\n- 1 king/cal king duvet cover\r\n- 2 king shams\r\n\r\nNote: Each duvet cover includes a button closure and interior tie that keeps your comforter in place.', '', 'Casually elegant and perfect to cuddle up with year-round, our linen duvet is as soft as it is luxurious.', 0, 'Full/Queen, King/Cal King', 'https://i.postimg.cc/CKgx0ZJ1/Stonewashed-Linen-Duvet-Sand-2-981d8d21-f342-47cb-adca-5be83d1598ab.webp', 'https://i.postimg.cc/13pyvmPZ/Stonewashed-Linen-Duvet-Sand-4-b3292c7f-8262-4757-80eb-27130b9f4bcd.webp', 'https://i.postimg.cc/59h0gkvL/Stonewashed-Linen-Duvet-Set-Includes-Tile-Sand.webp', ' Portugal'),
(18, 'Designed in a subtly striped neutral palette, these French linen pillowcases offer endless possibilities to mix and match with your favorite bedding layers. Thoughtfully detailed with a tie closure and handwoven for luxurious softness and breathability, these pillowcases will transform your bed into a serene retreat of effortless elegance.\r\n\r\nMade using only the finest French flax and woven in the oldest, family-run linen mill in Portugal, each piece is Oeko-TexÂ® certified and made sustainably in a fair trade working environment.', '', 'Woven from French linen, these timeless striped sheets are easygoing, refined, and effortlessly versatile.', 0, 'Standard,\r\nKing/Cal', 'https://i.postimg.cc/WbM2nGM4/Stonewashed-Linen-Pillowcases-With-Ties-Barley-Stripe-2.webp', 'https://i.postimg.cc/sDJkxwY5/Pillowcase-with-tie-barley-stripe.webp', 'https://i.postimg.cc/NfGNJYXr/Citizenry-Brooklyn-2025-14866-Final-b8c22748-9ef9-4711-8084-eb8f8f556c41.webp', ' Portugal'),
(19, 'Thereâ€™s nothing better than a bed that begs you to crawl in it. And our supremely soft, French linen sheets do just that â€“ theyâ€™re breathable, and have that perfectly imperfect look we love. Designed in a muted, mix-and-match palette and finished with eyelet detailing, each piece is loomed to give you the softest feel youâ€™ll ever touch (no, really).\r\n\r\nSet includes:\r\n- 1 flat sheet\r\n- 1 fitted sheet\r\n- 2 pillowcases\r\n\r\nMade using only the finest French flax and woven in the oldest, family-run linen mill in Portugal, each piece is Oeko-TexÂ® certified and made sustainably in a fair trade working environment.', '', 'Oh-so-soft French linen sheet sets give beauty sleep a whole new meaning.\r\n\r\n', 0, 'Size Guide', 'https://i.postimg.cc/90fq5xCC/Stonewashed-Linen-Sheet-Set-Ivory-4.webp', 'https://i.postimg.cc/qvHM2mSq/Stonewashed-Linen-Sheet-Set-Ivory-5.webp', 'https://i.postimg.cc/kXQDY3xK/Stonewashed-Linen-Sheet-Set-Ivory-3.webp', 'Portugal'),
(20, 'Organic texture. Laid-back vibes. Supremely soft. Our linen shams are what dreams are made of. Designed to mix and match, each piece is garment washed to give you a relaxed look. The best part? They only get softer with time (that is, every single time you wash them).  Made using only the finest French flax and woven in the oldest, family-run linen mill in Portugal, each piece is Oeko-TexÃ‚Â® certified and made sustainably in a fair trade working environment.  Note: Set includes two shams. We recommend styling the standard set on a full- or queen-size bed. The king set works perfectly on a king- or california-king size bed.', '', 'Note: Set includes two shams. We recommend styling the standard set on a full- or queen-size bed.', 0, 'Standard,\r\nKing/Cal King\r\n\r\n', 'https://i.postimg.cc/fW8hzMxM/Stonewashed-Linen-Shams-Ivory-4.webp', 'https://i.postimg.cc/qqPwJtwm/Stonewashed-Linen-Shams-Ivory-1.webp', 'https://i.postimg.cc/fym20jV4/Stonewashed-Linen-Color-Palette-Guide-Ivory-142f40cc-8aaa-49b6-9927-2d3f5c711a56.webp', ' Portugal'),
(21, 'Organic texture. Laid-back vibes. Oh-so-soft. Sweet dreams begin with our linen pillowcases. Loomed to give you a relaxed look, these pillowcases are designed to get better (i.e. softer) with time.\r\n\r\nMade using only the finest French flax and woven in the oldest, family-run linen mill in Portugal, each piece is Oeko-TexÂ® certified and made sustainably in a fair trade working environment.\r\n\r\nNote: Set includes two pillowcases.\r\n\r\nAvailable in two sizes: standard or king. We recommend styling the standard set on a full- or queen-size bed. The king set works perfectly on a king- or california-king size bed.', '', 'Sustainably made from the finest French flax, rest easy with these luxuriously soft linen pillowcases.', 0, 'Standard,\r\nKing/Cal King', 'https://i.postimg.cc/XN2dwDMn/Stonewashed-Linen-Sheet-Set-Barley-1.webp', 'https://i.postimg.cc/63M2fTmM/Stonewashed-Linen-Sheet-Set-Barley-2.webp', 'https://i.postimg.cc/4dxnysxV/Stonewashed-Linen-Pillowcases-Ivory-13.webp', ' Portugal'),
(22, 'Set the stage for an effortlessly cool bedroom. Breathable yet warm, this duvet cover is the perfect layer from summer to winter. Garment washed to give you an airy, soft, most perfectly worn feel ever (no, really). Available in luxe, earthy hues, this duvet cover is designed to mix and match with our bedding collection to create a look that’s inherently your own.\r\n\r\nMade using only the finest French flax and woven in the oldest, family-run linen mill in Portugal, each piece is Oeko-Tex® certified and made sustainably in a fair trade working environment.\r\n\r\nFull/Queen Duvet + Sham Set includes:\r\n- 1 full/queen duvet cover\r\n- 2 standard shams\r\n\r\nKing/Cal King Duvet + Sham Set includes:\r\n- 1 king/cal king duvet cover\r\n- 2 king shams\r\n\r\nNote: Each duvet cover includes a button closure and interior tie that keeps your comforter in place.\r\n', '*****', 'Casually elegant and perfect to cuddle up with year-round, our linen duvet is as soft as it is luxurious.', 133, 'Full/Queen ,\r\nKing/Cal King', 'https://i.postimg.cc/1XQgSTjN/Stonewashed-Linen-Duvet-Charcoal-2-abc868b6-b049-47f6-a2ff-f31fd52e43a6.webp', 'https://i.postimg.cc/fTsXQ3Gg/Stonewashed-Linen-Duvet-Charcoal-5-a8257859-0f39-4868-8199-8eaf18a7550c.webp', 'https://i.postimg.cc/QChMw7FQ/Stonewashed-Linen-Duvet-Set-Includes-Tile-Charcoal.webp', 'Portugal'),
(23, 'Alegria Organic Cotton Quilted Bed Blanket\r\nLoomed in Portugal\r\n$299 $254.15\r\nTime-tested traditions create cloud-like textures in this stunning checkered bed blanket.\r\n\r\noat\r\n \r\nFull/Queen | Blanket Only\r\nKing/Cal King | Blanket Only\r\nFull/Queen | Sham Set\r\nKing/Cal King | Sham Set\r\n1\r\nAdd To Bag\r\nIn stock. Ready to ship.\r\nFree Shipping\r\nFree U.S. Shipping & Free Returns\r\nPutting a fresh spin on time-tested traditions, this beautiful bed blanket is loomed with soft, 100% organic cotton into cloud-like textures that are positively dreamy. Accented with classic blocks and checkering, this bed blanket is easily layered over your bed in a neutral oat color or stone blue.\r\n\r\nCrafted over weeks at one of the oldest textile mills in Portugal, each piece is loomed by multiple generations of local artisans. All made start to finish in a fair trade environment with 100% organic cotton.', '', 'Time-tested traditions create cloud-like textures in this stunning checkered bed blanket.\r\n\r\no', 0, 'Standard,\r\nKing/Cal King', 'https://i.postimg.cc/3Rf93Nfz/Alegria-Organic-Cotton-Quilted-Bed-Blanket-Oat-3.webp', 'https://i.postimg.cc/Gp0W17Tv/Alegria-Organic-Cotton-Quilted-Bed-Blanket-Oat-4.webp', 'https://i.postimg.cc/fWH1bT0z/Alegria-Organic-Cotton-Quilted-Bed-Blanket-Oat-5.webp', 'Portugal');

-- --------------------------------------------------------

-- 
-- Table structure for table `thanhtoan_momo`
-- 

CREATE TABLE `thanhtoan_momo` (
  `id_momo` int(11) NOT NULL auto_increment,
  `partnerCode` varchar(50) collate utf8_unicode_ci NOT NULL,
  `orderId` int(11) NOT NULL,
  `amount` varchar(50) collate utf8_unicode_ci NOT NULL,
  `orderInfo` varchar(100) collate utf8_unicode_ci NOT NULL,
  `orderType` varchar(50) collate utf8_unicode_ci NOT NULL,
  `transId` bigint(20) NOT NULL,
  `payType` varchar(50) collate utf8_unicode_ci NOT NULL,
  `code_cart` int(11) NOT NULL,
  PRIMARY KEY  (`id_momo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `thanhtoan_momo`
-- 

INSERT INTO `thanhtoan_momo` (`id_momo`, `partnerCode`, `orderId`, `amount`, `orderInfo`, `orderType`, `transId`, `payType`, `code_cart`) VALUES 
(1, 'MOMOBKUN20180529', 1767844509, '12345', 'Thanh toán qua ATM MoMo', 'momo_wallet', 1767844515143, '', 251),
(2, 'MOMOBKUN20180529', 1767844748, '158000', 'Thanh toán qua QR MoMo', 'momo_wallet', 1767844755704, '', 254);

-- --------------------------------------------------------

-- 
-- Table structure for table `vanchuyen`
-- 

CREATE TABLE `vanchuyen` (
  `vc_id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `dh_id` int(11) NOT NULL,
  `vc_tenKH` varchar(200) collate utf8_unicode_ci NOT NULL,
  `vc_email` varchar(200) collate utf8_unicode_ci NOT NULL,
  `vc_sdt` int(11) NOT NULL,
  `vc_diachi` varchar(200) collate utf8_unicode_ci NOT NULL,
  `vc_thanhpho` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`vc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `vanchuyen`
-- 

