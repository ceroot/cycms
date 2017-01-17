-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-06-16 10:06:26
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
-- 表的结构 `cy_user`
--

CREATE TABLE `cy_user` (
  `id` mediumint(11) NOT NULL COMMENT '用户表自增id',
  `username` varchar(30) NOT NULL COMMENT '用户名称',
  `password` char(32) NOT NULL COMMENT '用户密码',
  `nickname` char(30) NOT NULL COMMENT '用户昵称',
  `realname` char(30) NOT NULL COMMENT '真实姓名',
  `email` varchar(60) NOT NULL COMMENT '邮箱',
  `role` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '角色',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `times` int(6) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录次数',
  `create_uid` mediumint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` mediumint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `login_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录时间',
  `login_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录ip',
  `delete_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '删除状态，1为正常，0为删除',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作人id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除时间',
  `delete_ip` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cy_user`
--
ALTER TABLE `cy_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cy_user`
--
ALTER TABLE `cy_user`
  MODIFY `id` mediumint(11) NOT NULL AUTO_INCREMENT COMMENT '用户表自增id';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
