-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-03-23 16:27:19
-- 服务器版本： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `c_comment`
--

CREATE TABLE IF NOT EXISTS `c_comment` (
`id` int(10) NOT NULL,
  `replyid` int(10) NOT NULL,
  `level` int(4) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `c_comment`
--

INSERT INTO `c_comment` (`id`, `replyid`, `level`, `username`, `time`, `content`) VALUES
(1, 0, 0, 'test', '2015-03-23 07:02:29', 'test1'),
(2, 1, 1, 'test', '2015-03-23 07:02:29', 'test2'),
(3, 2, 2, 'test', '2015-03-23 11:34:22', 'haha'),
(4, 1, 1, 'test', '2015-03-23 11:40:10', 'test3\r\ntest3'),
(5, 3, 3, 'test', '2015-03-23 11:41:55', 'test4\r\ntest4'),
(6, 0, 0, 'test', '2015-03-23 15:22:24', '你好你好'),
(7, 5, 4, 'test', '2015-03-23 15:26:48', 'lalalalalala');

-- --------------------------------------------------------

--
-- 表的结构 `c_user`
--

CREATE TABLE IF NOT EXISTS `c_user` (
`uid` int(11) NOT NULL,
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `c_user`
--

INSERT INTO `c_user` (`uid`, `username`, `email`, `password`, `regdate`) VALUES
(1, 'test', '123@123', 'test', '2015-03-23 06:01:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `c_comment`
--
ALTER TABLE `c_comment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_user`
--
ALTER TABLE `c_user`
 ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `c_comment`
--
ALTER TABLE `c_comment`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `c_user`
--
ALTER TABLE `c_user`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
