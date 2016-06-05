-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-06-05 16:58:16
-- 服务器版本： 5.5.47
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `think5`
--

-- --------------------------------------------------------

--
-- 表的结构 `cy_dot_article`
--

CREATE TABLE IF NOT EXISTS `cy_dot_article` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `cid` int(11) NOT NULL COMMENT '类型id',
  `title` char(128) NOT NULL COMMENT '标题',
  `keywords` char(128) NOT NULL COMMENT '关键字',
  `description` char(128) NOT NULL COMMENT '描述',
  `content` text NOT NULL COMMENT '内容',
  `times` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '访问次数',
  `template` char(56) NOT NULL COMMENT '模板',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `create_uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) unsigned DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新ip',
  `delete_status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '删除状态',
  `delete_uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除操作者id',
  `delete_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除操作时间',
  `delete_ip` bigint(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除操作ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cy_dot_article`
--
ALTER TABLE `cy_dot_article`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cy_dot_article`
--
ALTER TABLE `cy_dot_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
