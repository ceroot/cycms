-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-06-15 14:20:30
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
-- 表的结构 `cy_oauth_user`
--

CREATE TABLE IF NOT EXISTS `cy_oauth_user` (
  `id` int(11) NOT NULL COMMENT '表自增id',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户表id',
  `name` varchar(64) NOT NULL COMMENT '名称',
  `nick` varchar(64) NOT NULL COMMENT '昵称',
  `head_img` varchar(200) NOT NULL COMMENT '头像',
  `access_token` varchar(512) NOT NULL COMMENT '第三方token',
  `openid` varchar(64) NOT NULL COMMENT '第三方openid',
  `expires_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '第三方登录过期时间',
  `refresh_token` varchar(512) NOT NULL COMMENT '在授权自动续期步骤中，获取新的Access_Token时需要提供的参数',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `times` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='第三方登录用户表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cy_oauth_user`
--
ALTER TABLE `cy_oauth_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cy_oauth_user`
--
ALTER TABLE `cy_oauth_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表自增id';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
