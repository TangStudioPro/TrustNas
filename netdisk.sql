-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2020-01-10 10:47:23
-- 服务器版本： 10.4.10-MariaDB
-- PHP 版本： 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `netdisk`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_user`
--

CREATE TABLE `admin_user` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(55) NOT NULL,
  `admin_pass` varchar(50) NOT NULL,
  `quanxian` int(11) NOT NULL DEFAULT 1
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
  `filesrc` varchar(100) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `uploadname` varchar(55) NOT NULL,
  `filesize` int(50) NOT NULL,
  `filetype` varchar(50) NOT NULL,
  `uptime` int(55) NOT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  `recoverytime` int(50) DEFAULT NULL,
  `shared` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `uploadfile`
--

INSERT INTO `uploadfile` (`id`, `uid`, `filesrc`, `filename`, `uploadname`, `filesize`, `filetype`, `uptime`, `state`, `recoverytime`, `shared`) VALUES
(41, 1, './adminupload/img/5b6e9ab8c0f20.jpg', '5b6e9ab8c0f20', '5b6e9ab8c0f20.jpg', 113564, 'jpg', 1578275656, 1, 1578296472, 0),
(42, 1, './adminupload/file/git.txt', 'git', 'git.txt', 72, 'txt', 1578281838, 1, 1578621243, 1),
(43, 1, './adminupload/img/katongme5e12abcc75a2a.png', 'katongme', 'katongme5e12abcc75a2a.png', 86514, 'png', 1578281932, 0, 1578623206, 0),
(44, 1, './adminupload/file/程序员在囧途.txt', '程序员在囧途', '程序员在囧途.txt', 24, 'txt', 1578290482, 0, NULL, 0),
(47, 1, './adminupload/img/user.jpg', 'user', 'user.jpg', 5307, 'jpg', 1578291658, 0, NULL, 0),
(48, 1, './adminupload/img/default.jpg', 'default', 'default.jpg', 9301, 'jpg', 1578291676, 1, 1578627267, 0),
(50, 1, './adminupload/img/35.jpeg', '35', '35.jpeg', 17307, 'jpeg', 1578291799, 1, 1578295113, 0),
(51, 1, './adminupload/img/63.jpeg', '63', '63.jpeg', 3911, 'jpeg', 1578291890, 1, 1578627263, 0),
(52, 1, './adminupload/img/53.jpeg', '53', '53.jpeg', 5307, 'jpeg', 1578295552, 0, NULL, 1),
(53, 1, './adminupload/img/66.jpeg', '66', '66.jpeg', 5936, 'jpeg', 1578295557, 0, NULL, 0),
(54, 1, './adminupload/img/74.jpeg', '74', '74.jpeg', 5244, 'jpeg', 1578295561, 0, NULL, 0),
(55, 1, './adminupload/img/87.jpeg', '87', '87.jpeg', 18522, 'jpeg', 1578295565, 1, 1578634535, 0),
(56, 1, './adminupload/img/98.jpeg', '98', '98.jpeg', 9918, 'jpeg', 1578295570, 1, 1578375785, 0),
(57, 1, './adminupload/img/default5e13fd7000595.jpg', 'default', 'default5e13fd7000595.jpg', 9301, 'jpg', 1578368368, 0, NULL, 0),
(58, 1, './adminupload/img/745e13fd7664859.jpeg', '74', '745e13fd7664859.jpeg', 5244, 'jpeg', 1578368374, 1, 1578368378, 0),
(59, 1, './adminupload/img/1.jpeg', '1', '1.jpeg', 3560, 'jpeg', 1578368383, 1, 1578375794, 0),
(61, 1, './adminupload/file/symfony.xls', 'symfony', 'symfony.xls', 27648, 'xls', 1578368469, 0, 1578465336, 1),
(62, 1, './adminupload/file/2019-10.10(1).txt', '2019-10', '2019-10.10(1).txt', 47, 'txt', 1578368496, 1, 1578465295, 1),
(63, 1, './adminupload/file/2019-105e13fdfbe190f.txt', '2019-10', '2019-105e13fdfbe190f.txt', 47, 'txt', 1578368507, 1, 1578368588, 0),
(64, 1, './adminupload/file/核心编程笔记6.docx', '核心编程笔记6', '核心编程笔记6.docx', 1014229, 'docx', 1578368518, 1, 1578368564, 0),
(69, 4, './qiaokrupload/img/yanzhengma2.png', 'yanzhengma2', 'yanzhengma2.png', 1797, 'png', 1578555366, 0, 1578620638, 1),
(71, 4, './qiaokrupload/img/5b6e9ab8c0f20.jpg', '5b6e9ab8c0f20', '5b6e9ab8c0f20.jpg', 113564, 'jpg', 1578620626, 0, NULL, 0),
(72, 11, './123456upload/img/5b6e9ab8c0f20.jpg', '5b6e9ab8c0f20', '5b6e9ab8c0f20.jpg', 113564, 'jpg', 1578620933, 0, NULL, 1),
(73, 1, './adminupload/img/yanzhengma25e17d97835704.png', 'yanzhengma2', 'yanzhengma25e17d97835704.png', 1797, 'png', 1578621304, 0, NULL, 0),
(74, 1, './adminupload/img/top-bg.gif', 'top-bg', 'top-bg.gif', 315, 'gif', 1578621611, 0, NULL, 0),
(75, 1, './adminupload/file/layui-v2.5.5.zip', 'layui-v2', 'layui-v2.5.5.zip', 651350, 'zip', 1578622556, 0, NULL, 0);

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
(4, 'qiaokr', 'd0dcbf0d12a6b1e7fbfa2ce5848f3eff', 1576611111, '二号'),
(11, '123456', 'e10adc3949ba59abbe56e057f20f883e', 1578638123, '三号'),
(12, '111111', 'e10adc3949ba59abbe56e057f20f883e', 1578638563, 'george');

--
-- 转储表的索引
--

--
-- 表的索引 `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`admin_id`);

--
-- 表的索引 `uploadfile`
--
ALTER TABLE `uploadfile`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `user`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
