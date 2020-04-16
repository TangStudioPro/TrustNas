-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2020-04-16 14:59:55
-- 服务器版本： 5.6.44-log
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pan_trustocean_c`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_user`
--

CREATE TABLE `admin_user` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(55) NOT NULL,
  `admin_pass` varchar(50) NOT NULL,
  `quanxian` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_user`
--

INSERT INTO `admin_user` (`admin_id`, `admin_name`, `admin_pass`, `quanxian`) VALUES
(1, 'qiaokr', 'd0dcbf0d12a6b1e7fbfa2ce5848f3eff', 0);

-- --------------------------------------------------------

--
-- 表的结构 `uploadfile`
--

CREATE TABLE `uploadfile` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `filesrc` varchar(200) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `uploadname` varchar(55) NOT NULL,
  `filesize` int(50) NOT NULL,
  `filetype` varchar(50) NOT NULL,
  `uptime` int(55) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `recoverytime` int(50) DEFAULT NULL,
  `shared` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `uploadfile`
--

INSERT INTO `uploadfile` (`id`, `uid`, `filesrc`, `filename`, `uploadname`, `filesize`, `filetype`, `uptime`, `state`, `recoverytime`, `shared`) VALUES
(171, 16, './upload/ceshi/image/5e941c3815ae6.png', 'qq截图20200413125811', '5e941c3815ae6.png', 393636, 'png', 1586764856, 0, NULL, 0),
(172, 1, './upload/admin/application/5e941c9bae3d3.pdf', '业绩管理系统功能需求', '5e941c9bae3d3.pdf', 50638, 'pdf', 1586764955, 0, NULL, 0),
(173, 1, './upload/admin/image/5e941cb633957.png', 'qq浏览器截图20191010183219', '5e941cb633957.png', 399597, 'png', 1586764982, 0, NULL, 1),
(175, 16, './upload/ceshi/application/5e9422c80ea93.doc', 'php基础(2018)-v2', '5e9422c80ea93.doc', 5118457, 'doc', 1586766536, 0, NULL, 0),
(176, 16, './upload/ceshi/application/5e9423fc2d0d9.doc', 'php基础(2018)-v2', '5e9423fc2d0d9.doc', 5118457, 'doc', 1586766844, 0, NULL, 0),
(177, 16, './upload/ceshi/application/5e9423fc31157.chm', 'php中文手册20190130带注释', '5e9423fc31157.chm', 35840234, 'chm', 1586766844, 0, NULL, 0),
(178, 16, './upload/ceshi/application/5e9423fc3530c.chw', 'php中文手册20190130带注释', '5e9423fc3530c.chw', 1094006, 'chw', 1586766844, 0, NULL, 0),
(179, 16, './upload/ceshi/application/5e9423fc3f590.xls', '常用函数总结表', '5e9423fc3f590.xls', 97280, 'xls', 1586766844, 0, NULL, 0),
(180, 16, './upload/ceshi/text/5e942438156af.txt', '测试', '5e942438156af.txt', 21, 'txt', 1586766904, 0, NULL, 0),
(181, 16, './upload/ceshi/text/5e94250c5fbcd.txt', '新建文本文档', '5e94250c5fbcd.txt', 0, 'txt', 1586767116, 0, NULL, 0),
(182, 16, './upload/ceshi/video/5e942722148ee.avi', '27课后总结', '5e942722148ee.avi', 112717034, 'avi', 1586767650, 0, NULL, 0),
(183, 1, './upload/admin/application/5e95102fc4d21.xls', 'php', '5e95102fc4d21.xls', 19456, 'xls', 1586827311, 0, NULL, 0),
(184, 1, './upload/admin/image/5e95102fd34c5.png', 'q', '5e95102fd34c5.png', 15743, 'png', 1586827311, 0, NULL, 0),
(185, 1, './upload/admin/image/5e95102fd7542.png', 'qq浏览器截图20191010183219', '5e95102fd7542.png', 399597, 'png', 1586827311, 0, NULL, 0),
(186, 1, './upload/admin/image/5e9518cfa1f1c.jpg', '121 (2019_04_29 17_13_23 utc)', '5e9518cfa1f1c.jpg', 32166, 'jpg', 1586829519, 0, NULL, 0),
(187, 1, './upload/admin/image/5e9518cfb5af7.jpg', '123 (2019_04_29 17_13_23 utc)', '5e9518cfb5af7.jpg', 164242, 'jpg', 1586829519, 0, NULL, 0),
(188, 1, './upload/admin/image/5e9518cfb9805.jpg', '1231 (2019_04_29 17_13_23 utc)', '5e9518cfb9805.jpg', 35356, 'jpg', 1586829519, 0, NULL, 0),
(190, 1, './upload/admin/image/5e9518decb323.ico', 'ooopic_1558454147 (2019_05_23 00_36_29 utc)', '5e9518decb323.ico', 67646, 'ico', 1586829534, 0, NULL, 0),
(191, 1, './upload/admin/image/5e9518decf473.jpg', 'fdg d (2019_04_29 17_13_23 utc)', '5e9518decf473.jpg', 29529, 'jpg', 1586829534, 0, NULL, 0),
(192, 1, './upload/admin/application/5e9518fd185b7.pdf', '业绩管理系统功能需求', '5e9518fd185b7.pdf', 50638, 'pdf', 1586829565, 0, 1587017849, 0),
(193, 1, './upload/admin/application/5e9520f037218.chm', 'php中文手册20190130带注释', '5e9520f037218.chm', 35840234, 'chm', 1586831600, 1, 1587019762, 0),
(194, 1, './upload/admin/application/5e952142e064d.xls', '常用函数总结表', '5e952142e064d.xls', 97280, 'xls', 1586831682, 0, NULL, 1),
(195, 1, './upload/admin/application/5e97f825ebc61.docx', '日工作总结模板', '5e97f825ebc61.docx', 13824, 'docx', 1587017765, 0, NULL, 0),
(196, 1, './upload/admin/application/5e97f82af04f0.docx', '周工作计划模板', '5e97f82af04f0.docx', 12201, 'docx', 1587017770, 0, NULL, 1),
(197, 1, './upload/admin/image/5e97f88590b58.jpg', 'timg (2)', '5e97f88590b58.jpg', 73935, 'jpg', 1587017861, 0, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `user_add_time` int(55) NOT NULL,
  `note` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `user_add_time`, `note`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1577611111, '备注名测试一号'),
(16, 'ceshi', 'e10adc3949ba59abbe56e057f20f883e', 1586764800, '测试1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `uploadfile`
--
ALTER TABLE `uploadfile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `uploadfile`
--
ALTER TABLE `uploadfile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
