-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017-01-17 10:13:32
-- 服务器版本： 5.5.53
-- PHP Version: 7.0.12

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
-- 表的结构 `cy_action`
--

CREATE TABLE `cy_action` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '主键',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` char(140) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text COMMENT '行为规则',
  `log` text COMMENT '日志规则',
  `type` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '添加者的id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '添加时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '添加ip',
  `update_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统行为表' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `cy_action`
--

INSERT INTO `cy_action` (`id`, `name`, `title`, `remark`, `rule`, `log`, `type`, `status`, `create_uid`, `create_time`, `create_ip`, `update_uid`, `update_time`, `update_ip`) VALUES
(1, 'console_login', '用户登录', '记录管理员登录管理系统日志', '', '[user|get_realname]在[time|time_format]登录了管理系统', 1, 1, 0, 0, 0, 1, 1464054349, 2130706433),
(2, 'console_logout', '用户注销', '记录管理员退出管理系统日志', '', '[user|get_realname]在[time|time_format]退出了管理系统', 1, 1, 1, 1463465048, 2130706433, 0, 0, 0),
(3, 'cache_cache', '更新缓存', '记录更新缓存操作日志', '', '[user|get_realname]在[time|time_format]更新了缓存', 1, 1, 0, 0, 0, 1, 1464280463, 2130706433),
(4, 'action_add', '添加行为', '记录添加行为操作日志', '', '[user|get_realname]在[time|time_format]添加了行为', 1, 1, 0, 1462456882, 2130706433, 1, 1464068270, 2130706433),
(5, 'action_edit', '修改行为', '记录修改行为操作日志', '', '[user|get_realname]在[time|time_format]修改了行为', 1, 1, 1, 1462457125, 2130706433, 1, 1464074125, 2130706433),
(6, 'action_del', '删除行为', '记录删除行为操作日志', '', '[user|get_realname]在[time|time_format]删除了行为', 1, 1, 1, 1462457125, 2130706433, 1, 1464074130, 2130706433),
(7, 'action_updatestatus', '设置行为状态', '记录行为状态操作日志', '', '[user|get_realname]在[time|time_format][table_id|status_text]了行为', 1, 1, 1, 1462458377, 2130706433, 1, 1464068562, 2130706433),
(8, 'manager_add', '添加管理员', '记录新增管理员操作日志', '', '[user|get_realname]在[time|time_format]添加了管理用户', 1, 1, 0, 0, 0, 0, 0, 0),
(9, 'manager_edit', '修改管理员', '记录修改管理员操作日志', '', '[user|get_realname]在[time|time_format]修改了管理用户', 1, 1, 0, 0, 0, 0, 0, 0),
(10, 'manager_del', '删除用户', '记录删除管理员操作日志', '', '[user|get_realname]在[time|time_format]删除了用户', 1, 1, 1, 1462811355, 2130706433, 0, 0, 0),
(11, 'manager_updatestatus', '禁用[启用]用户', '记录禁用启用管理员操作日志', '', '[user|get_realname]在[time|time_format][table_id|status_text]了管理用户', 1, 1, 0, 0, 0, 1, 1464067399, 2130706433),
(12, 'auth_rule_add', '添加规则', '记录添加规则操作日志', '', '[user|get_realname]在[time|time_format]添加了规则', 1, 1, 1, 1463722274, 2130706433, 1, 1466251951, 2130706433),
(13, 'auth_rule_edit', '编辑规则', '记录修改规则操作日志', '', '[user|get_realname]在[time|time_format]修改了规则', 1, 1, 1, 1462463721, 2130706433, 1, 1466251944, 2130706433),
(14, 'auth_rule_del', '删除规则', '记录删除规则操作日志', '', '[user|get_realname]在[time|time_format]删除了规则', 1, 1, 1, 1463284593, 2130706433, 1, 1466251935, 2130706433),
(15, 'auth_rule_updatestatus', '禁用[启用]规则', '记录禁用启用规则操作日志', '', '[user|get_realname]在[time|time_format][table_id|status_text]了规则', 1, 1, 1, 1463279149, 2130706433, 1, 1466251926, 2130706433),
(16, 'auth_rule_updateshow', '设置控制台菜单显示', '记录设置控制台菜单项显示操作记录', '', '[user|get_realname]在[time|time_format]设置了控制台菜单显示状态', 1, 1, 1, 1463289050, 2130706433, 1, 1466251917, 2130706433),
(17, 'auth_rule_updateauth', '设置权限认证状态', '记录设置权限认证状态操作日志', '', '[user|get_realname]在[time|time_format]更新了权限认证状态', 1, 1, 1, 1463290047, 2130706433, 1, 1466251908, 2130706433),
(18, 'auth_rule_sort', '规则排序操作', '', '', '[user|get_realname]在[time|time_format]更新了规则排序', 1, 1, 1, 1463290047, 2130706433, 1, 1466251886, 2130706433),
(19, 'auth_group_add', '增加角色', '记录新增角色操作日志', '', '[user|get_realname]在[time|time_format]新增了角色', 1, 1, 1, 1463295059, 2130706433, 1, 1466249594, 2130706433),
(20, 'auth_group_edit', '修改角色', '记录编辑角色操作日志', '', '[user|get_realname]在[time|time_format][type|get_log_session_text]', 1, 1, 1, 1463295110, 2130706433, 1, 1466249760, 2130706433),
(21, 'auth_group_del', '删除角色', '记录删除角色操作日志', '', '[user|get_realname]在[time|time_format]删除了角色', 1, 1, 1, 1463295145, 2130706433, 1, 1466249784, 2130706433),
(22, 'authgroup_updatestatus', '禁用[启用]角色', '记录禁用启用角色操作日志', '', '[user|get_realname]在[time|time_format][table_id|status_text]了角色', 1, 1, 1, 1463294873, 2130706433, 1, 1464067636, 2130706433),
(23, 'category_add', '添加类别', '记录添加类别操作日志', '', '[user|get_realname]在[time|time_format]新增了类别', 1, 1, 1, 1463971338, 2130706433, 0, 1463971338, 0),
(24, 'category_edit', '编辑类别', '记录编辑类别操作日志', '', '[user|get_realname]在[time|time_format]编辑了类别', 1, 1, 1, 1463971377, 2130706433, 0, 1463971377, 0),
(25, 'category_del', '删除类别', '记录删除类别操作日志', '', '[user|get_realname]在[time|time_format]删除了类别', 1, 1, 1, 0, 2130706433, 1, 1463991724, 2130706433),
(26, 'category_updateshow', '更改类别菜单显示状态', '', '', '[user|get_realname]在[time|time_format]设置了类别显示状态', 1, 1, 1, 1463289050, 2130706433, 0, 0, 0),
(27, 'category_updatestatus', '设置类别状态', '记录设置类别状态操作日志', '', '[user|get_realname]在[time|time_format][table_id|status_text]了类别', 1, 1, 1, 1463971458, 2130706433, 1, 1464067682, 2130706433),
(28, 'category_sort', '类别排序操作', '', '', '[user|get_realname]在[time|time_format]更新了类别排序', 1, 1, 1, 1463290047, 2130706433, 1, 1464183572, 2130706433),
(29, 'manager_password', '修改密码', '', '', '[user|get_realname]在[time|time_format]修改了密码', 1, 1, 1, 1464262601, 2130706433, 0, 1464262601, 0),
(30, 'manager_info', '用户信息修改', '记录用户修改自己的信息操作记录', '', '[user|get_realname]在[time|time_format]修改了个人信息', 1, 1, 1, 1464268539, 2130706433, 0, 1464268539, 0),
(31, 'developer_add', '添加开发日志', '记录添加开发日志操作日志', '', '[user|get_realname]在[time|time_format]添加了一篇开发日志', 1, 1, 1, 1464410542, 2130706433, 0, 1464410542, 0),
(32, 'developer_edit', '编辑开发日志', '记录编辑开发日志操作日志', '', '[user|get_realname]在[time|time_format]编辑了开发日志', 1, 1, 1, 1464410581, 2130706433, 1, 1464786410, 2130706433),
(33, 'index_dotMenu', '菜单管理', '', NULL, '[user|get_realname]在[time|time_format]添加了菜单管理', 1, 0, 1, 1464955794, 2130706433, 1, 1464956119, 2130706433),
(34, 'list_dotMenu', '菜单列表', '', NULL, '[user|get_realname]在[time|time_format]添加了菜单列表', 1, 0, 1, 1464955909, 2130706433, 1, 1464956120, 2130706433),
(35, 'dotmenu_add', '添加菜单', '', '', '[user|get_realname]在[time|time_format]添加了添加菜单', 1, 1, 1, 1464955953, 2130706433, 1, 1464956708, 2130706433),
(36, 'dotmenu_edit', '编辑菜单', '', '', '[user|get_realname]在[time|time_format]操作了编辑菜单', 1, 1, 1, 1464956182, 2130706433, 1, 1464956644, 2130706433),
(37, 'dotcategory_add', '添加类别', '', '', '[user|get_realname]在[time|time_format]添加了类别', 1, 1, 1, 1464957300, 2130706433, 0, 1464957300, 0),
(38, 'dotcategory_edit', '编辑类别', '', NULL, '[user|get_realname]在[time|time_format]操作了编辑类别', 1, 1, 1, 1464957306, 2130706433, 0, 1464957306, 0),
(39, 'dotcases_add', '添加成功案例', '', '', '[user|get_realname]在[time|time_format]添加了成功案例', 1, 1, 1, 1464957517, 2130706433, 0, 1464957517, 0),
(40, 'dotcases_edit', '编辑成功案例', '', NULL, '[user|get_realname]在[time|time_format]操作了编辑成功案例', 1, 1, 1, 1464957544, 2130706433, 0, 1464957544, 0),
(41, 'dotwebinfo_edit', '网站信息编辑', '', NULL, '[user|get_realname]在[time|time_format]操作了网站信息编辑', 1, 1, 1, 1465118687, 2130706433, 0, 1465118687, 0),
(42, 'dotwebinfo_link', '联系我们设置', '', '', '[user|get_realname]在[time|time_format]修改了联系我们', 1, 1, 1, 1465143786, 2130706433, 0, 1465143786, 0),
(43, 'dotwebinfo_about', '关于我们', '', NULL, '[user|get_realname]在[time|time_format]操作了关于我们', 1, 1, 1, 1465144287, 2130706433, 0, 1465144287, 0),
(44, 'dot_article_add', '内容添加', '', NULL, '[user|get_realname]在[time|time_format]操作了内容添加', 1, 1, 1, 1465212939, 2130706433, 0, 1465212939, 0),
(45, 'dot_article_edit', '内容编辑', '', NULL, '[user|get_realname]在[time|time_format]操作了内容编辑', 1, 1, 1, 1465212957, 2130706433, 0, 1465212957, 0),
(46, 'dotcategory_updatestatus', '更新类别状态', '', NULL, '[user|get_realname]在[time|time_format]操作了更新类别状态', 1, 1, 1, 1465823733, 2130706433, 0, 1465823733, 0),
(47, 'dotcategory_updatehidden', '更新类别显示状态', '', NULL, '[user|get_realname]在[time|time_format]操作了更新类别显示状态', 1, 1, 1, 1465823764, 2130706433, 0, 1465823764, 0),
(48, 'addons_config', '插件设置', '', NULL, '[user|get_realname]在[time|time_format]操作了插件设置', 1, 1, 1, 1466229201, 2130706433, 0, 1466229201, 0),
(49, 'hooks_add', '钩子添加', '', NULL, '[user|get_realname]在[time|time_format]操作了钩子添加', 1, 1, 1, 1466231186, 2130706433, 0, 1466231186, 0),
(50, '钩子添加', '钩子添加', '', '', '[user|get_realname]在[time|time_format]操作了钩子添加', 1, 0, 1, 1466231194, 2130706433, 1, 1466238955, 2130706433),
(51, 'this is test', '这是测试行为', '', '', '[user|get_realname]在[time|time_format]设置了控制台菜单显示状态', 1, 1, 1, 1466239001, 2130706433, 1, 1466250482, 2130706433),
(52, 'config_add', '添加配置', '', NULL, '[user|get_realname]在[time|time_format]操作了添加配置', 1, 1, 1, 1466311991, 2130706433, 0, 1466311991, 0),
(53, 'config_edit', '编辑配置', '', NULL, '[user|get_realname]在[time|time_format]操作了编辑配置', 1, 1, 1, 1466312050, 2130706433, 0, 1466312050, 0),
(54, 'config_del', '删除配置', '', NULL, '[user|get_realname]在[time|time_format]操作了删除配置', 1, 1, 1, 1466312086, 2130706433, 0, 1466312086, 0),
(55, 'config_sort', '排序配置', '', NULL, '[user|get_realname]在[time|time_format]操作了排序配置', 1, 1, 1, 1466312110, 2130706433, 0, 1466312110, 0),
(56, 'config_base', '基本配置', '', NULL, '[user|get_realname]在[time|time_format]操作了基本配置', 1, 1, 1, 1466312280, 2130706433, 0, 1466312280, 0),
(57, 'model_add', '添加模型', '', NULL, '[user|get_realname]在[time|time_format]操作了添加模型', 1, 1, 1, 1466784186, 2130706433, 0, 1466784186, 0),
(58, 'model_edit', '编辑模型', '', NULL, '[user|get_realname]在[time|time_format]操作了编辑模型', 1, 1, 1, 1466784200, 2130706433, 0, 1466784200, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_action_log`
--

CREATE TABLE `cy_action_log` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键',
  `action_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='行为日志表' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `cy_action_log`
--

INSERT INTO `cy_action_log` (`id`, `action_id`, `user_id`, `model`, `record_id`, `remark`, `status`, `create_time`, `action_ip`) VALUES
(1, 2, 1, 'manager', 1, '超级管理员在2017-01-14 11:08:03退出了管理系统', 1, 1484363283, 2130706433),
(2, 1, 1, 'manager', 1, '超级管理员在2017-01-14 16:44:35登录了管理系统', 1, 1484383475, 2130706433),
(3, 1, 1, 'manager', 1, '超级管理员在2017-01-14 16:46:48登录了管理系统', 1, 1484383608, 2130706433),
(4, 1, 1, 'manager', 1, '超级管理员在2017-01-15 00:01:10登录了管理系统', 1, 1484409670, 2130706433),
(5, 1, 1, 'manager', 1, '超级管理员在2017-01-15 00:07:26登录了管理系统', 1, 1484410046, 2130706433),
(6, 1, 1, 'manager', 1, '超级管理员在2017-01-15 00:14:35登录了管理系统', 1, 1484410475, 2130706433),
(7, 1, 1, 'manager', 1, '超级管理员在2017-01-15 00:16:46登录了管理系统', 1, 1484410606, 2130706433),
(8, 3, 1, 'Cache', 1, '超级管理员在2017-01-15 00:35:14更新了缓存', 1, 1484411714, 2130706433),
(9, 3, 1, 'Cache', 1, '超级管理员在2017-01-15 00:35:22更新了缓存', 1, 1484411722, 2130706433),
(10, 11, 1, 'Manager', 43, '超级管理员在2017-01-15 00:45:45禁用了管理用户', 1, 1484412345, 2130706433),
(11, 11, 1, 'Manager', 43, '超级管理员在2017-01-15 00:45:49启用了管理用户', 1, 1484412349, 2130706433),
(12, 11, 1, 'Manager', 43, '超级管理员在2017-01-15 00:46:10禁用了管理用户', 1, 1484412370, 2130706433),
(13, 11, 1, 'Manager', 43, '超级管理员在2017-01-15 00:46:15启用了管理用户', 1, 1484412375, 2130706433),
(14, 11, 1, 'Manager', 43, '超级管理员在2017-01-15 00:46:17禁用了管理用户', 1, 1484412377, 2130706433),
(15, 10, 1, 'Manager', 41, '超级管理员在2017-01-15 00:49:35删除了用户', 1, 1484412575, 2130706433),
(16, 11, 1, 'Manager', 43, '超级管理员在2017-01-15 01:03:34启用了管理用户', 1, 1484413414, 2130706433),
(17, 11, 1, 'Manager', 43, '超级管理员在2017-01-15 01:03:37禁用了管理用户', 1, 1484413417, 2130706433),
(18, 11, 1, 'Manager', 43, '超级管理员在2017-01-15 01:03:40启用了管理用户', 1, 1484413420, 2130706433),
(19, 11, 1, 'Manager', 43, '超级管理员在2017-01-15 01:03:51禁用了管理用户', 1, 1484413431, 2130706433),
(20, 11, 1, 'Manager', 43, '超级管理员在2017-01-15 01:03:54启用了管理用户', 1, 1484413434, 2130706433),
(21, 1, 1, 'manager', 1, '超级管理员在2017-01-16 16:02:57登录了管理系统', 1, 1484553777, 2130706433),
(22, 1, 1, 'manager', 1, '超级管理员在2017-01-16 17:20:05登录了管理系统', 1, 1484558405, 2130706433),
(23, 2, 1, 'manager', 1, '超级管理员在2017-01-17 10:10:31退出了管理系统', 1, 1484619031, 2130706433),
(24, 1, 1, 'manager', 1, '超级管理员在2017-01-17 10:32:56登录了管理系统', 1, 1484620376, 2130706433),
(25, 1, 1, 'manager', 1, '超级管理员在2017-01-17 10:40:33登录了管理系统', 1, 1484620833, 2130706433),
(26, 1, 1, 'manager', 1, '超级管理员在2017-01-17 11:12:22登录了管理系统', 1, 1484622742, 2130706433),
(27, 1, 1, 'manager', 1, '超级管理员在2017-01-17 11:27:19登录了管理系统', 1, 1484623639, 2130706433),
(28, 2, 1, 'manager', 1, '超级管理员在2017-01-17 11:32:51退出了管理系统', 1, 1484623971, 2130706433),
(29, 1, 1, 'manager', 1, '超级管理员在2017-01-17 11:32:56登录了管理系统', 1, 1484623976, 2130706433),
(30, 11, 1, 'Manager', 42, '超级管理员在2017-01-17 11:48:25禁用了管理用户', 1, 1484624905, 2130706433),
(31, 11, 1, 'Manager', 42, '超级管理员在2017-01-17 14:18:52启用了管理用户', 1, 1484633932, 2130706433),
(32, 1, 1, 'manager', 1, '超级管理员在2017-01-17 14:22:15登录了管理系统', 1, 1484634135, 2130706433),
(33, 2, 1, 'manager', 1, '超级管理员在2017-01-17 14:25:58退出了管理系统', 1, 1484634358, 2130706433),
(34, 2, 1, 'manager', 1, '超级管理员在2017-01-17 15:13:34退出了管理系统', 1, 1484637214, 2130706433),
(35, 1, 1, 'manager', 1, '超级管理员在2017-01-17 15:16:26登录了管理系统', 1, 1484637386, 2130706433),
(36, 2, 1, 'manager', 1, '超级管理员在2017-01-17 15:17:07退出了管理系统', 1, 1484637427, 2130706433),
(37, 1, 1, 'manager', 1, '超级管理员在2017-01-17 15:17:14登录了管理系统', 1, 1484637434, 2130706433),
(38, 2, 1, 'manager', 1, '超级管理员在2017-01-17 15:17:20退出了管理系统', 1, 1484637440, 2130706433),
(39, 1, 1, 'manager', 1, '超级管理员在2017-01-17 15:17:24登录了管理系统', 1, 1484637444, 2130706433),
(40, 2, 1, 'manager', 1, '超级管理员在2017-01-17 15:17:28退出了管理系统', 1, 1484637448, 2130706433),
(41, 1, 1, 'manager', 1, '超级管理员在2017-01-17 15:17:32登录了管理系统', 1, 1484637452, 2130706433),
(42, 2, 1, 'manager', 1, '超级管理员在2017-01-17 15:17:44退出了管理系统', 1, 1484637464, 2130706433),
(43, 1, 1, 'manager', 1, '超级管理员在2017-01-17 15:17:51登录了管理系统', 1, 1484637471, 2130706433),
(44, 2, 1, 'manager', 1, '超级管理员在2017-01-17 15:17:55退出了管理系统', 1, 1484637475, 2130706433),
(45, 1, 1, 'manager', 1, '超级管理员在2017-01-17 15:18:00登录了管理系统', 1, 1484637480, 2130706433),
(46, 2, 1, 'manager', 1, '超级管理员在2017-01-17 15:18:04退出了管理系统', 1, 1484637484, 2130706433),
(47, 1, 1, 'manager', 1, '超级管理员在2017-01-17 15:18:10登录了管理系统', 1, 1484637490, 2130706433),
(48, 2, 1, 'manager', 1, '超级管理员在2017-01-17 15:18:18退出了管理系统', 1, 1484637498, 2130706433),
(49, 1, 1, 'manager', 1, '超级管理员在2017-01-17 15:18:23登录了管理系统', 1, 1484637503, 2130706433),
(50, 2, 1, 'manager', 1, '超级管理员在2017-01-17 15:18:26退出了管理系统', 1, 1484637506, 2130706433),
(51, 1, 1, 'manager', 1, '超级管理员在2017-01-17 15:18:32登录了管理系统', 1, 1484637512, 2130706433),
(52, 2, 1, 'manager', 1, '超级管理员在2017-01-17 15:18:39退出了管理系统', 1, 1484637519, 2130706433),
(53, 1, 1, 'manager', 1, '超级管理员在2017-01-17 15:18:43登录了管理系统', 1, 1484637523, 2130706433),
(54, 2, 1, 'manager', 1, '超级管理员在2017-01-17 15:39:44退出了管理系统', 1, 1484638784, 2130706433),
(55, 1, 1, 'manager', 1, '超级管理员在2017-01-17 15:40:21登录了管理系统', 1, 1484638821, 2130706433),
(56, 3, 1, 'Cache', 1, '超级管理员在2017-01-17 16:36:56更新了缓存', 1, 1484642216, 2130706433),
(57, 2, 1, 'manager', 1, '超级管理员在2017-01-17 18:10:42退出了管理系统', 1, 1484647842, 2130706433);

-- --------------------------------------------------------

--
-- 表的结构 `cy_addons`
--

CREATE TABLE `cy_addons` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '安装时间',
  `has_adminlist` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否有后台列表'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='插件表';

--
-- 转存表中的数据 `cy_addons`
--

INSERT INTO `cy_addons` (`id`, `name`, `title`, `description`, `status`, `config`, `author`, `version`, `create_time`, `has_adminlist`) VALUES
(76, 'EditorForAdmin', '后台编辑器', '用于增强整站长文本的输入和显示', 1, '{"editor_type":"1","editor_wysiwyg":"2","editor_markdownpreview":"1","editor_height":"500px","editor_resize_type":"1"}', 'thinkphp', '0.2', 1466602751, 0),
(4, 'SystemInfo', '系统环境信息', '用于显示一些服务器的信息', 1, '{"title":"\\u7cfb\\u7edf\\u4fe1\\u606f","width":"2","display":"1"}', 'thinkphp', '0.1', 1379512036, 0),
(5, 'Editor', '前台编辑器', '用于增强整站长文本的输入和显示', 1, '{"editor_type":"2","editor_wysiwyg":"1","editor_height":"300px","editor_resize_type":"1"}', 'thinkphp', '0.1', 1379830910, 0),
(64, 'Attachment', '附件', '用于文档模型上传附件', 1, 'null', 'thinkphp', '0.1', 1466100356, 1),
(9, 'SocialComment', '通用社交化评论', '集成了各种社交化评论插件，轻松集成到系统中。', 1, '{"comment_type":"1","comment_uid_youyan":"","comment_short_name_duoshuo":"","comment_data_list_duoshuo":""}', 'thinkphp', '0.1', 1380273962, 0),
(75, 'Oauth', '第三方登录插件', '用于第三方登录设置', 1, '{"oauth_status":"1","think_sdk_qq_app_key":"100251165","think_sdk_qq_app_secret":"114d7761ae3f641f82aded9acce3c5a4","think_sdk_qq_callback":"http:\\/\\/www.benweng.com\\/oauthcallback?type=qq","think_sdk_qq_on":"1","think_sdk_sina_app_key":"4198022214","think_sdk_sina_app_secret":"bfaf29ca1f9586af79060947856b42e9","think_sdk_sina_callback":"http:\\/\\/www.benweng.com\\/oauthcallback?type=sina","think_sdk_sina_on":"1","think_sdk_baidu_app_key":"00VgPgxfGjNPwi2WzBAsVOAy","think_sdk_baidu_app_secret":"VjQ3Dw2l6DGpfoveQQyCms3iIErYqHYz","think_sdk_baidu_callback":"http:\\/\\/www.benweng.com\\/oauthcallback?type=baidu","think_sdk_baidu_on":"1"}', 'SpringYang', '0.1', 1466602553, 0),
(70, 'YcEditor', '测试编辑器', '测试编辑器，这是说明', 0, 'null', 'thinkphp', '0.2', 1466299750, 0),
(61, 'DevTeam', '开发团队信息', '开发团队成员信息', 1, '{"title":"OneThink\\u5f00\\u53d1\\u56e2\\u961f","width":"2","display":"1"}', 'thinkphp', '0.1', 1466099774, 0),
(71, 'SiteStat', '站点统计信息', '统计站点的基础信息', 1, '{"title":"\\u7cfb\\u7edf\\u4fe1\\u606f","width":"2","display":"1"}', 'thinkphp', '0.1', 1466300563, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_article`
--

CREATE TABLE `cy_article` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '类型id',
  `title` char(128) NOT NULL COMMENT '标题',
  `keywords` char(128) NOT NULL COMMENT '关键字',
  `description` char(128) NOT NULL COMMENT '描述',
  `content` text NOT NULL COMMENT '内容',
  `cover` char(128) NOT NULL COMMENT '封面',
  `source` char(56) NOT NULL COMMENT '来源',
  `view` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '访问次数',
  `template` char(56) NOT NULL COMMENT '模板',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) UNSIGNED DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `delete_status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '删除状态',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作者id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作时间',
  `delete_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cy_attribute`
--

CREATE TABLE `cy_attribute` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '字段名',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '字段注释',
  `field` varchar(100) NOT NULL DEFAULT '' COMMENT '字段定义',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '数据类型',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '字段默认值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `is_show` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '表单是否显示',
  `list_show` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '列表默认显示，0为不显示，1为显示',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  `model_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '模型id',
  `is_must` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否必填',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `validate_rule` varchar(255) NOT NULL DEFAULT '',
  `validate_time` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `error_info` varchar(100) NOT NULL DEFAULT '',
  `validate_type` varchar(25) NOT NULL DEFAULT '',
  `auto_rule` varchar(100) NOT NULL DEFAULT '',
  `auto_time` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `auto_type` varchar(25) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='模型属性表';

--
-- 转存表中的数据 `cy_attribute`
--

INSERT INTO `cy_attribute` (`id`, `name`, `title`, `field`, `type`, `value`, `remark`, `is_show`, `list_show`, `extra`, `model_id`, `is_must`, `status`, `update_time`, `create_time`, `validate_rule`, `validate_time`, `error_info`, `validate_type`, `auto_rule`, `auto_time`, `auto_type`) VALUES
(1, 'uid', '用户ID', 'int(10) unsigned NOT NULL ', 'num', '0', '', 0, 0, '', 1, 0, 1, 1384508362, 1383891233, '', 0, '', '', '', 0, ''),
(2, 'name', '标识', 'char(40) NOT NULL ', 'string', '', '同一根节点下标识不重复', 1, 0, '', 1, 0, 1, 1383894743, 1383891233, '', 0, '', '', '', 0, ''),
(3, 'title', '标题', 'char(80) NOT NULL ', 'string', '', '文档标题', 1, 0, '', 1, 0, 1, 1383894778, 1383891233, '', 0, '', '', '', 0, ''),
(4, 'category_id', '所属分类', 'int(10) unsigned NOT NULL ', 'string', '', '', 0, 0, '', 1, 0, 1, 1384508336, 1383891233, '', 0, '', '', '', 0, ''),
(5, 'description', '描述', 'char(140) NOT NULL ', 'textarea', '', '', 1, 0, '', 1, 0, 1, 1383894927, 1383891233, '', 0, '', '', '', 0, ''),
(6, 'root', '根节点', 'int(10) unsigned NOT NULL ', 'num', '0', '该文档的顶级文档编号', 0, 0, '', 1, 0, 1, 1384508323, 1383891233, '', 0, '', '', '', 0, ''),
(7, 'pid', '所属ID', 'int(10) unsigned NOT NULL ', 'num', '0', '父文档编号', 0, 0, '', 1, 0, 1, 1384508543, 1383891233, '', 0, '', '', '', 0, ''),
(8, 'model_id', '内容模型ID', 'tinyint(3) unsigned NOT NULL ', 'num', '0', '该文档所对应的模型', 0, 0, '', 1, 0, 1, 1384508350, 1383891233, '', 0, '', '', '', 0, ''),
(9, 'type', '内容类型', 'tinyint(3) unsigned NOT NULL ', 'select', '2', '', 1, 0, '1:目录\r\n2:主题\r\n3:段落', 1, 0, 1, 1384511157, 1383891233, '', 0, '', '', '', 0, ''),
(10, 'position', '推荐位', 'smallint(5) unsigned NOT NULL ', 'checkbox', '0', '多个推荐则将其推荐值相加', 1, 0, '[DOCUMENT_POSITION]', 1, 0, 1, 1383895640, 1383891233, '', 0, '', '', '', 0, ''),
(11, 'link_id', '外链', 'int(10) unsigned NOT NULL ', 'num', '0', '0-非外链，大于0-外链ID,需要函数进行链接与编号的转换', 1, 0, '', 1, 0, 1, 1383895757, 1383891233, '', 0, '', '', '', 0, ''),
(12, 'cover_id', '封面', 'int(10) unsigned NOT NULL ', 'picture', '0', '0-无封面，大于0-封面图片ID，需要函数处理', 1, 0, '', 1, 0, 1, 1384147827, 1383891233, '', 0, '', '', '', 0, ''),
(13, 'display', '可见性', 'tinyint(3) unsigned NOT NULL ', 'radio', '1', '', 1, 0, '0:不可见\r\n1:所有人可见', 1, 0, 1, 1386662271, 1383891233, '', 0, '', 'regex', '', 0, 'function'),
(14, 'deadline', '截至时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '0-永久有效', 1, 0, '', 1, 0, 1, 1387163248, 1383891233, '', 0, '', 'regex', '', 0, 'function'),
(15, 'attach', '附件数量', 'tinyint(3) unsigned NOT NULL ', 'num', '0', '', 0, 0, '', 1, 0, 1, 1387260355, 1383891233, '', 0, '', 'regex', '', 0, 'function'),
(16, 'view', '浏览量', 'int(10) unsigned NOT NULL ', 'num', '0', '', 1, 0, '', 1, 0, 1, 1383895835, 1383891233, '', 0, '', '', '', 0, ''),
(17, 'comment', '评论数', 'int(10) unsigned NOT NULL ', 'num', '0', '', 1, 0, '', 1, 0, 1, 1383895846, 1383891233, '', 0, '', '', '', 0, ''),
(18, 'extend', '扩展统计字段', 'int(10) unsigned NOT NULL ', 'num', '0', '根据需求自行使用', 0, 0, '', 1, 0, 1, 1384508264, 1383891233, '', 0, '', '', '', 0, ''),
(19, 'level', '优先级', 'int(10) unsigned NOT NULL ', 'num', '0', '越高排序越靠前', 1, 0, '', 1, 0, 1, 1383895894, 1383891233, '', 0, '', '', '', 0, ''),
(20, 'create_time', '创建时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '', 1, 0, '', 1, 0, 1, 1383895903, 1383891233, '', 0, '', '', '', 0, ''),
(21, 'update_time', '更新时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '', 0, 0, '', 1, 0, 1, 1384508277, 1383891233, '', 0, '', '', '', 0, ''),
(22, 'status', '数据状态', 'tinyint(4) NOT NULL ', 'radio', '0', '', 0, 0, '-1:删除\r\n0:禁用\r\n1:正常\r\n2:待审核\r\n3:草稿', 1, 0, 1, 1384508496, 1383891233, '', 0, '', '', '', 0, ''),
(23, 'parse', '内容解析类型', 'tinyint(3) unsigned NOT NULL ', 'select', '0', '', 0, 0, '0:html\r\n1:ubb\r\n2:markdown', 2, 0, 1, 1384511049, 1383891243, '', 0, '', '', '', 0, ''),
(24, 'content', '文章内容', 'text NOT NULL ', 'editor', '', '', 1, 0, '', 2, 0, 1, 1383896225, 1383891243, '', 0, '', '', '', 0, ''),
(25, 'template', '详情页显示模板', 'varchar(100) NOT NULL ', 'string', '', '参照display方法参数的定义', 1, 0, '', 2, 0, 1, 1383896190, 1383891243, '', 0, '', '', '', 0, ''),
(26, 'bookmark', '收藏数', 'int(10) unsigned NOT NULL ', 'num', '0', '', 1, 0, '', 2, 0, 1, 1383896103, 1383891243, '', 0, '', '', '', 0, ''),
(27, 'parse', '内容解析类型', 'tinyint(3) unsigned NOT NULL ', 'select', '0', '', 0, 0, '0:html\r\n1:ubb\r\n2:markdown', 3, 0, 1, 1387260461, 1383891252, '', 0, '', 'regex', '', 0, 'function'),
(28, 'content', '下载详细描述', 'text NOT NULL ', 'editor', '', '', 1, 0, '', 3, 0, 1, 1383896438, 1383891252, '', 0, '', '', '', 0, ''),
(29, 'template', '详情页显示模板', 'varchar(100) NOT NULL ', 'string', '', '', 1, 0, '', 3, 0, 1, 1383896429, 1383891252, '', 0, '', '', '', 0, ''),
(30, 'file_id', '文件ID', 'int(10) unsigned NOT NULL ', 'file', '0', '需要函数处理', 1, 0, '', 3, 0, 1, 1383896415, 1383891252, '', 0, '', '', '', 0, ''),
(31, 'download', '下载次数', 'int(10) unsigned NOT NULL ', 'num', '0', '', 1, 0, '', 3, 0, 1, 1383896380, 1383891252, '', 0, '', '', '', 0, ''),
(32, 'size', '文件大小', 'bigint(20) unsigned NOT NULL ', 'num', '0', '单位bit', 1, 0, '', 3, 0, 1, 1383896371, 1383891252, '', 0, '', '', '', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `cy_attribute_user_list`
--

CREATE TABLE `cy_attribute_user_list` (
  `id` int(11) NOT NULL COMMENT '表自增id',
  `uid` int(11) UNSIGNED DEFAULT '0' COMMENT '用户id',
  `model_id` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '模型id',
  `attribute` varchar(128) NOT NULL COMMENT '属性列表',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) UNSIGNED DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `delete_status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '删除状态，1为正常，0为删除',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作者id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作时间',
  `delete_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户自定义属性列表';

--
-- 转存表中的数据 `cy_attribute_user_list`
--

INSERT INTO `cy_attribute_user_list` (`id`, `uid`, `model_id`, `attribute`, `status`, `create_uid`, `create_time`, `create_ip`, `update_uid`, `update_time`, `update_ip`, `delete_status`, `delete_uid`, `delete_time`, `delete_ip`) VALUES
(1, 1, 1, '2,3,5,4', 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_auth_group`
--

CREATE TABLE `cy_auth_group` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `rules` text NOT NULL,
  `describe` char(50) NOT NULL DEFAULT '',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `cy_auth_group`
--

INSERT INTO `cy_auth_group` (`id`, `title`, `status`, `rules`, `describe`, `create_uid`, `create_time`, `create_ip`, `update_uid`, `update_time`, `update_ip`) VALUES
(1, '超级管理员', 1, '', '拥有全部权限', 0, 0, 0, 0, 0, 0),
(2, '网站管理员', 1, '8,81,84,115,82,109,83,114,85,86,87,106,88,111,221,222,223,224,226,227,228', '拥有相对多的权限', 0, 0, 0, 0, 1466244731, 0),
(3, '发布人员', 1, '1,27,112,113,116,117,119', '拥有发布、修改文章的权限', 0, 0, 0, 0, 1464179291, 0),
(4, '编辑', 1, '1,27,112,113,116,117,119,2,21,23,25,26,22,28,29,30,3,31,32,33,34,35', '拥有文章模块的所有权限', 0, 0, 0, 0, 1466249065, 0),
(8, '默认组', 1, '1,27,112,113,116,117,119', '拥有一些通用的权限', 0, 0, 0, 0, 1466245053, 0),
(9, 'yctest', 1, '1,27,112,113,117,119', '', 0, 0, 0, 0, 1464270298, 0),
(10, 'ddd', 1, '1,27,112,113,116,117,119', '', 0, 0, 0, 0, 1464193499, 0),
(11, 'dddddd', 1, '1,27,112,113,116,117,119', '', 0, 0, 0, 0, 1464179382, 0),
(12, 'd3ddd4fff', 0, '1,27,112,113,116,3,31,32', '', 0, 0, 0, 0, 1466249078, 0),
(18, 'kskks', 1, '2,21,26', '', 0, 1464193346, 0, 0, 1466248917, 0),
(19, 'this is test to1', 1, '2,21,25', '', 0, 1466249531, 0, 1, 1466250054, 2130706433),
(20, 'this is test to2', 1, '', '', 1, 1466250063, 2130706433, 1, 1466250079, 2130706433);

-- --------------------------------------------------------

--
-- 表的结构 `cy_auth_group_access`
--

CREATE TABLE `cy_auth_group_access` (
  `uid` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `cy_auth_group_access`
--

INSERT INTO `cy_auth_group_access` (`uid`, `group_id`) VALUES
(2, 1),
(2, 2),
(3, 2),
(3, 8),
(4, 2),
(5, 2),
(5, 3),
(5, 4),
(5, 8),
(10, 2),
(17, 2),
(18, 2),
(19, 9),
(42, 8),
(43, 4);

-- --------------------------------------------------------

--
-- 表的结构 `cy_auth_rule`
--

CREATE TABLE `cy_auth_rule` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `pid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `url` char(255) DEFAULT NULL COMMENT 'url地址，默认为null，当为null时使用方法调用name',
  `condition` char(100) NOT NULL DEFAULT '',
  `controller` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是控制器，0不是，1是',
  `instantiation` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否需要实例化，0为不需要，1为需要',
  `auth` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否需要权限验证，1为需要，0为不需要',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `isnavshow` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示导航，0为隐藏，1为显示',
  `icon` char(40) NOT NULL COMMENT '图标',
  `sort` smallint(6) NOT NULL DEFAULT '100' COMMENT '排序，越大越往后',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `cy_auth_rule`
--

INSERT INTO `cy_auth_rule` (`id`, `pid`, `name`, `title`, `url`, `condition`, `controller`, `instantiation`, `auth`, `type`, `status`, `isnavshow`, `icon`, `sort`, `create_time`, `update_time`) VALUES
(1, 0, 'index', '控制台', 'index/index', '', 1, 0, 0, 1, 1, 1, 'fa-home', 0, 0, 1466260260),
(2, 0, 'Product', '产品管理', NULL, '', 1, 1, 1, 1, 1, 0, 'fa-product-hunt', 100, 0, 1464090970),
(3, 0, 'order', '订单管理', NULL, '', 1, 0, 1, 1, 1, 0, 'fa-home', 100, 0, 1464090980),
(4, 0, 'Business', '商家管理', NULL, '', 1, 1, 1, 1, 1, 0, 'fa-reorder', 100, 0, 0),
(5, 0, 'article/index', '内容管理', '', '', 0, 0, 1, 1, 1, 1, 'fa-list-alt', 100, 0, 1466842983),
(6, 0, 'user/index', '用户管理', '', '', 0, 0, 1, 1, 1, 1, 'fa-home', 101, 0, 1466682045),
(7, 0, 'auth', '权限管理', 'authRule/index', '', 0, 0, 1, 1, 1, 1, 'fa-random', 100, 0, 1464352426),
(8, 0, 'System', '系统管理', '', '', 0, 0, 1, 1, 1, 1, 'fa-gears', 101, 0, 1464872339),
(21, 2, 'product/list', '产品管理', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1463324726),
(22, 2, 'Examine', '审核管理', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(23, 21, 'Scenery', '旅游线路管理', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1463324763),
(24, 21, 'Hotel', '酒店管理', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1463324772),
(25, 21, 'Travelticket', '景区门票', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1463324777),
(26, 21, 'Group', '休闲美食', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1463324787),
(27, 1, 'index/index', '控制台首页', NULL, '', 0, 0, 0, 1, 1, 1, '', 99, 0, 1463325041),
(28, 22, 'Hotel/hotelListt', '酒店审核', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(29, 22, 'TravelTicket/ticketListt', '景区门票审核', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(30, 22, 'Group/indexx', '美食审核', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(31, 3, 'order/index', '旅游路线订单列表', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(32, 31, 'order/index2', '酒店订单列表', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(33, 3, 'order/index3', '景区门票订单列表', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(34, 33, 'order/index4', '休闲美食订单列表', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(35, 33, 'order/index5', '旅游路线订单列表', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(52, 5, 'article', '内容管理控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 0, 1466843020),
(53, 5, 'article/list', '内容列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1466875860),
(54, 5, 'Ad', '广告管理', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(61, 6, 'user', '用户控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 0, 1466683023),
(62, 6, 'user/list', '本系统用户列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1466682286),
(71, 7, 'manager/index', '管理员管理', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(72, 7, 'authRule/index', '规则管理', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1462501796),
(73, 72, 'authRule/list', '规则列表', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1462499019),
(74, 72, 'authRule/add', '添加规则', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1462501823),
(75, 72, 'authRule/edit', '编辑规则', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 0, 1462703587),
(76, 72, 'authRule/del', '删除规则', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 0, 1463664638),
(77, 71, 'manager/list', '管理员列表', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(78, 71, 'manager/add', '添加管理员', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1463210795),
(79, 71, 'Manager/edit', '编辑管理员', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 0, 0),
(80, 71, 'manager/log', '管理员日志', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1462807107),
(81, 8, 'cache/index', '缓存管理', NULL, '', 1, 0, 1, 1, 1, 1, '', 100, 0, 1448439593),
(82, 8, 'MobileCode', '短信管理', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 0, 1464091058),
(83, 8, 'Backup', '数据库管理', NULL, '', 1, 0, 1, 1, 1, 1, '', 100, 0, 1448439961),
(84, 81, 'cache/cache', '更新缓存', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(85, 8, 'Visitcount', '访问统计', NULL, '', 1, 1, 1, 1, 1, 0, '', 100, 0, 1464091046),
(86, 85, 'Visitcount/index', '访问概况', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(87, 85, 'Visitcount/today', '今日访问排行', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(88, 8, 'Pay', '支付设置', NULL, '', 1, 0, 1, 1, 1, 0, '', 100, 0, 1464091070),
(91, 0, 'Other', '未归类', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 1448010613, 1448021414),
(101, 7, 'authGroup/index', '角色管理', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1463295248),
(102, 101, 'AuthGroup/add', '角色添加', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1462695304),
(103, 101, 'AuthGroup/edit', '角色编辑', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 0, 0),
(104, 101, 'AuthGroup/del', '角色删除', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 0, 0),
(105, 101, 'AuthGroup/rule', '分配权限', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 0, 1463295488),
(106, 85, 'Visitcount/latest', '实时访客', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(107, 7, 'action/index', '行为管理', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(108, 107, 'action/list', '用户行为', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(109, 107, 'action', '行为管理控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 0, 1466349503),
(110, 107, 'actionLog/list', '行为日志', NULL, '', 0, 0, 1, 1, 1, 1, '', 101, 1448348339, 1462807148),
(111, 88, 'Pay/chinabanck', '网银在线设置', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 1448348382, 0),
(112, 1, 'index/index111', '首页控制器', NULL, '', 0, 0, 0, 1, 1, 0, '', 100, 1448369860, 1464618135),
(113, 1, 'index/copyright', '系统信息', NULL, '', 0, 0, 0, 1, 1, 1, '', 100, 1448369952, 1464270431),
(114, 83, 'Backup/index', '数据库', NULL, '', 0, 1, 1, 1, 1, 1, '', 100, 1448437926, 1448437978),
(115, 81, 'cache/update', '更新缓存操作', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 1448439236, 1463209728),
(116, 1, 'manager/info', '修改个人信息', NULL, '', 0, 0, 0, 1, 1, 1, '', 100, 1448593741, 1464270365),
(117, 1, 'manager/password', '修改密码', NULL, '', 0, 0, 0, 1, 1, 1, '', 100, 1448594855, 1464270384),
(118, 71, 'ManagerActionLog', '管理员日志控制器', NULL, '', 1, 1, 1, 1, 1, 0, '', 100, 1450409832, 1450409935),
(119, 1, 'ManagerActionLog/index', '管理员日志121', '', '', 1, 0, 1, 1, 1, 0, '', 100, 1450409970, 1466255842),
(152, 107, 'action/add', '添加行为', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 0, 1462705905),
(153, 107, 'action/edit', '修改行为', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 0, 1462727351),
(204, 101, 'authGroup/list', '角色列表', NULL, '', 0, 0, 1, 1, 1, 1, '', 99, 1462695390, 1462702804),
(218, 71, 'manager/disable', '禁用用户', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 1463234283, 0),
(219, 72, 'authRule/updateshow', '设置是否在控制台菜单显示', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 1463288822, 1463664833),
(220, 72, 'authRule/updateauth', '设置验证状态', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 1463289399, 1463664807),
(221, 8, 'category/index', '类别管理', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 1463657943, 1463664211),
(222, 221, 'category', '类别管理控制器', NULL, '', 1, 1, 1, 1, 1, 0, '', 100, 1463658455, 1463928165),
(223, 221, 'category/list', '类别列表', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 1463659472, 1464015124),
(224, 221, 'category/add', '添加类别', NULL, '', 0, 0, 1, 1, 1, 1, '', 100, 1463662072, 1463928396),
(225, 72, 'authRule/disable', '设置规则状态', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 1463664692, 1463664692),
(226, 221, 'category/edit', '编辑类别', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 1463664960, 1463928439),
(227, 221, 'category/status', '设置类别状态', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 1463666434, 1464015335),
(228, 221, 'category/updateshow', '设置类别显示状态', NULL, '', 0, 0, 1, 1, 1, 0, '', 100, 1463928513, 1464015321),
(229, 8, 'developer/index', '开发管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464406829, 1464406829),
(230, 229, 'developer', '开发管理控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1464406877, 1464406877),
(231, 229, 'developer/list', '开发日志列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464406930, 1464410819),
(232, 229, 'developer/add', '添加开发日志', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464406968, 1464406968),
(233, 229, 'developer/edit', '编辑开发日志', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1464406994, 1464406994),
(234, 229, 'developer/view', '查看开发日志', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1464410488, 1464410488),
(235, 0, 'app/index', '应用管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464871706, 1464871706),
(236, 235, 'app', '应用管理控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1464871925, 1464871925),
(237, 235, 'app/list', '应用列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464872476, 1464872476),
(238, 235, 'app/add', '添加应用', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464872491, 1464872491),
(239, 235, 'app/edit', '编辑应用', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1464872528, 1464872711),
(240, 235, 'app/updatestatus', '更新应用状态', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1464872689, 1464872689),
(241, 0, 'dot/index', '丽堡站点管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464954420, 1465743340),
(242, 241, 'dotMenu/index', '菜单管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464955794, 1464955794),
(243, 242, 'dotMenu', '菜单管理控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1464955842, 1464955842),
(244, 242, 'dotMenu/list', '菜单列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464955909, 1464955909),
(245, 242, 'dotMenu/add', '添加菜单', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464955953, 1464955953),
(246, 242, 'dotMenu/edit', '编辑菜单', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1464956182, 1464956248),
(247, 241, 'dotCategory/index', '类别管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464957069, 1464957069),
(248, 247, 'dotCategory', '类别管理控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1464957129, 1464957129),
(249, 247, 'dotCategory/list', '类别列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464957175, 1464957175),
(250, 247, 'dotCategory/add', '添加类别', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464957208, 1464957208),
(251, 247, 'dotCategory/edit', '编辑类别', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1464957306, 1464957306),
(252, 241, 'dotCases/index', '成功案例管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464957377, 1464957377),
(253, 252, 'dotCases', '成功案例控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1464957416, 1464957416),
(254, 252, 'dotCases/list', '成功案例列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464957447, 1464957447),
(255, 252, 'dotCases/add', '添加成功案例', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1464957469, 1464957469),
(256, 252, 'dotCases/edit', '编辑成功案例', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1464957544, 1464957586),
(257, 241, 'dotWebinfo/index', '网站管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1465118599, 1465143553),
(258, 257, 'dotWebinfo', '网站信息管理控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1465118637, 1465118637),
(259, 257, 'dotWebinfo/edit', '网站设置', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1465118687, 1465143577),
(260, 257, 'dotWebinfo/link', '联系我们设置', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1465143721, 1465143721),
(261, 257, 'dotWebinfo/about', '关于我们', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1465144287, 1465144287),
(262, 241, 'dotArticle/index', '内容管理', '', '', 0, 0, 1, 1, 1, 1, '', 99, 1465212868, 1465212868),
(263, 262, 'dotArticle', '内容管理控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1465212901, 1465212901),
(264, 262, 'dotArticle/list', '内容列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1465212921, 1465212921),
(265, 262, 'dotArticle/add', '内容添加', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1465212939, 1465212939),
(266, 262, 'dotArticle/edit', '内容编辑', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1465212957, 1465212957),
(267, 247, 'dotCategory/updatestatus', '更新类别状态', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1465823733, 1465823733),
(268, 247, 'dotCategory/updatehidden', '更新类别显示状态', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1465823764, 1465823764),
(269, 0, 'extend', '扩展管理', 'addons/index', '', 0, 0, 1, 1, 1, 1, '', 100, 1466228657, 1466228992),
(270, 269, 'addons/index', '插件管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466228888, 1466228888),
(271, 270, 'addons', '插件控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1466229048, 1466229048),
(272, 270, 'addons/list', '插件列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466229201, 1466229463),
(273, 270, 'addons/config', '插件设置', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1466229491, 1466229491),
(274, 269, 'hooks/index', '钩子管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466229568, 1466229568),
(275, 274, 'hooks', '钩子控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1466229607, 1466229607),
(276, 274, 'hooks/list', '钩子列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466230007, 1466230007),
(277, 274, 'hooks/add', '钩子添加', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466231186, 1466231186),
(278, 274, 'hooks/edit', '钩子编辑', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1466231194, 1466231232),
(279, 71, 'manager', '管理员控制器', '', '', 1, 1, 1, 1, 1, 0, '', 0, 1466309256, 1466309256),
(280, 72, 'authRule', '规则管理控制器', '', '', 1, 1, 1, 1, 1, 0, '', 0, 1466309532, 1466309532),
(281, 101, 'authGroup', '角色管理控制器', '', '', 1, 1, 1, 1, 1, 1, '', 0, 1466309578, 1466309578),
(282, 8, 'config/index', '网站设置', 'config/index?id=1', '', 0, 0, 1, 1, 1, 1, '', 100, 1466310323, 1466313201),
(283, 284, 'config', '网站设置控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1466310459, 1466313070),
(284, 8, 'config/list', '配置管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466311812, 1466311812),
(285, 284, 'config/add', '添加配置', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466311991, 1466311991),
(286, 284, 'config/edit', '编辑配置', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1466312050, 1466312064),
(287, 284, 'config/del', '删除配置', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1466312086, 1466312118),
(288, 284, 'config/sort', '排序配置', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1466312110, 1466312110),
(289, 110, 'actionLog', '日志控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1466350259, 1466350259),
(290, 6, 'oauthUser', '第三方用户控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1466682341, 1466683036),
(291, 6, 'oauthUser/list', '第三方用户列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466682386, 1466682386),
(292, 8, 'model/index', '模型管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466783831, 1466783831),
(293, 292, 'model', '模型管理控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1466783851, 1466783898),
(294, 292, 'model/list', '模型列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466783877, 1466784110),
(295, 292, 'model/add', '添加模型', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466784186, 1466784186),
(296, 292, 'model/edit', '编辑模型', '', '', 0, 0, 1, 1, 1, 0, '', 100, 1466784200, 1466784217),
(297, 8, 'attribute/index', '字段属性管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466833500, 1466833500),
(298, 297, 'attribute', '字段属性控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 1466833586, 1466833586),
(299, 297, 'attribute/list', '字段属性列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 1466833616, 1466833616),
(300, 301, 'WebLog', '网站日志控制器', '', '', 1, 1, 1, 1, 1, 0, '', 100, 0, 0),
(301, 8, 'WebLog/index', '网站日志管理', '', '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(302, 301, 'WebLog/list', '网站日志列表', '', '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0),
(303, 301, 'WebLog/set', '网站日志设置', '', '', 0, 0, 1, 1, 1, 1, '', 100, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_category`
--

CREATE TABLE `cy_category` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '分类ID',
  `name` varchar(30) NOT NULL COMMENT '标志',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `list_row` tinyint(3) UNSIGNED NOT NULL DEFAULT '10' COMMENT '列表每页行数',
  `meta_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `template_index` varchar(100) NOT NULL DEFAULT '' COMMENT '频道页模板',
  `template_lists` varchar(100) NOT NULL DEFAULT '' COMMENT '列表页模板',
  `template_detail` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页模板',
  `template_edit` varchar(100) NOT NULL DEFAULT '' COMMENT '编辑页模板',
  `model` varchar(100) NOT NULL DEFAULT '' COMMENT '列表绑定模型',
  `model_sub` varchar(100) NOT NULL DEFAULT '' COMMENT '子文档绑定模型',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '允许发布的内容类型',
  `link_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '外链',
  `allow_publish` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
  `display` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '可见性',
  `reply` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `check` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
  `reply_model` varchar(100) NOT NULL DEFAULT '',
  `extend` text COMMENT '扩展设置',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `icon` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '分类图标',
  `groups` varchar(255) NOT NULL DEFAULT '' COMMENT '分组定义'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='分类表';

--
-- 转存表中的数据 `cy_category`
--

INSERT INTO `cy_category` (`id`, `name`, `title`, `pid`, `sort`, `list_row`, `meta_title`, `keywords`, `description`, `template_index`, `template_lists`, `template_detail`, `template_edit`, `model`, `model_sub`, `type`, `link_id`, `allow_publish`, `display`, `reply`, `check`, `reply_model`, `extend`, `create_time`, `update_time`, `status`, `icon`, `groups`) VALUES
(1, 'blog', '博客', 0, 0, 10, '', '', '', '', '', '', '', '2,3', '2', '2,1', 0, 0, 1, 0, 0, '1', '', 1379474947, 1382701539, 1, 0, ''),
(2, 'default_blog', '默认分类', 1, 1, 10, '', '', '', '', '', '', '', '2,3', '2', '2,1,3', 0, 1, 1, 0, 1, '1', '', 1379475028, 1386839751, 1, 0, ''),
(39, 'test', '测试', 0, 0, 10, '', '', '', '', '', '', '', '2', '', '2', 0, 1, 1, 0, 0, '', NULL, 1466845410, 1466845473, 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `cy_category_back`
--

CREATE TABLE `cy_category_back` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `pid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` varchar(64) NOT NULL COMMENT '唯一标识',
  `title` varchar(64) NOT NULL COMMENT '标题',
  `url` varchar(128) NOT NULL COMMENT 'url地址',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `display` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否显示，1为显示，0为不显示',
  `sort` smallint(100) NOT NULL DEFAULT '100' COMMENT '排序',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `delete_status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否删除，0为删除，1为正常',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除者id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除时间',
  `delete_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除ip',
  `remark` char(128) NOT NULL COMMENT '备注'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='类别表';

--
-- 转存表中的数据 `cy_category_back`
--

INSERT INTO `cy_category_back` (`id`, `pid`, `name`, `title`, `url`, `status`, `display`, `sort`, `create_uid`, `create_time`, `create_ip`, `update_uid`, `update_time`, `update_ip`, `delete_status`, `delete_uid`, `delete_time`, `delete_ip`, `remark`) VALUES
(1, 1, 'news', '新闻', '', 1, 1, 100, 1, 1464014523, 2130706433, 1, 1466260432, 2130706433, 1, 0, 0, 0, ''),
(2, 2, 'add_action', '测试2', '', 1, 1, 0, 1, 1466260491, 2130706433, 1, 1466260516, 2130706433, 1, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `cy_config`
--

CREATE TABLE `cy_config` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '配置说明',
  `value` text COMMENT '配置值',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cy_config`
--

INSERT INTO `cy_config` (`id`, `name`, `type`, `title`, `group`, `extra`, `remark`, `value`, `sort`, `status`, `create_time`, `update_time`) VALUES
(1, 'web_site_title', 1, '网站标题', 1, '', '网站标题前台显示标题', '笨翁网', 0, 1, 1378898976, 1466328618),
(2, 'web_site_description', 2, '网站描述', 1, '', '网站搜索引擎描述', '笨翁网', 1, 1, 1378898976, 1466328701),
(3, 'web_site_keyword', 2, '网站关键字', 1, '', '网站搜索引擎关键字', 'cycms,笨翁网', 8, 1, 1378898976, 1466328737),
(4, 'web_site_close', 4, '关闭站点', 1, '0:关闭,1:开启', '站点关闭后其他用户不能访问，管理员可以正常访问', '1', 1, 1, 1378898976, 1466328652),
(9, 'config_type_list', 3, '配置类型列表', 4, '', '主要用于数据解析和页面表单的生成', '0:数字\n1:字符\n2:文本\n3:数组\n4:枚举', 2, 1, 1378898976, 1466328573),
(10, 'web_site_icp', 1, '网站备案号', 1, '', '设置在网站底部显示的备案号，如“沪ICP备12007941号-2', '贵', 9, 1, 1378900335, 1466328638),
(11, 'document_position', 3, '文档推荐位', 0, '', '文档推荐位，推荐到多个位置KEY值相加即可', '1:列表推荐\n2:频道推荐\n4:首页推荐', 3, 1, 1379053380, 1466330436),
(12, 'cocument_display', 3, '文档可见性', 0, '', '文章可见性仅影响前台显示，后台不收影响', '0:所有人可见\n1:仅注册会员可见\n2:仅管理员可见', 4, 1, 1379056370, 1466330405),
(13, 'color_style', 4, '后台色系', 4, 'default_color:默认\nblue_color:紫罗兰', '后台颜色风格', 'default_color', 10, 1, 1379122533, 1466348008),
(20, 'config_group_list', 3, '配置分组', 4, '', '配置分组', '1:基本\n2:内容\n3:用户\n4:系统\n5:其它', 4, 1, 1379228036, 1466328555),
(21, 'kooks_type', 3, '钩子的类型', 4, '', '类型 1-用于扩展显示内容，2-用于扩展业务处理', '1:视图\n2:控制器', 6, 1, 1379313397, 1466328768),
(22, 'auth_config', 3, 'Auth配置', 4, '', '自定义Auth.class.php类配置', 'AUTH_ON:1\nAUTH_TYPE:2', 8, 1, 1379409310, 1466328784),
(23, 'open_draftbox', 4, '是否开启草稿功能', 2, '0:关闭草稿功能\n1:开启草稿功能\n', '新增文章时的草稿功能配置', '1', 1, 1, 1379484332, 1466339528),
(24, 'draft_aotosave_interval', 0, '自动保存草稿时间', 2, '', '自动保存草稿的时间间隔，单位：秒', '60', 2, 1, 1379484574, 1466339514),
(25, 'list_rows', 0, '后台每页记录数', 2, '', '后台数据每页显示记录数', '10', 10, 1, 1379503896, 1466328802),
(26, 'user_allow_register', 4, '是否允许用户注册', 3, '0:关闭注册\n1:允许注册', '是否开放用户注册', '1', 3, 1, 1379504487, 1466339500),
(27, 'codemirror_theme', 4, '预览插件的CodeMirror主题', 4, '3024-day:3024 day\n3024-night:3024 night\nambiance:ambiance\nbase16-dark:base16 dark\nbase16-light:base16 light\nblackboard:blackboard\ncobalt:cobalt\neclipse:eclipse\nelegant:elegant\nerlang-dark:erlang-dark\nlesser-dark:lesser-dark\nmidnight:midnight', '详情见CodeMirror官网', 'ambiance', 3, 1, 1379814385, 1466339485),
(28, 'data_backup_path', 1, '数据库备份根路径', 4, '', '路径必须以 / 结尾', './Data/', 5, 1, 1381482411, 1466339468),
(29, 'data_backup_part_size', 0, '数据库备份卷大小', 4, '', '该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M', '20971520', 7, 1, 1381482488, 1466339451),
(30, 'data_backup_compress', 4, '数据库备份文件是否启用压缩', 4, '0:不压缩\n1:启用压缩', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', '1', 9, 1, 1381713345, 1466339432),
(31, 'data_backup_compress_level', 4, '数据库备份文件压缩级别', 4, '1:普通\n4:一般\n9:最高', '数据库备份文件的压缩级别，该配置在开启压缩时生效', '9', 10, 1, 1381713408, 1466339417),
(32, 'develop_mode', 4, '开启开发者模式', 4, '0:关闭\n1:开启', '是否开启开发者模式', '1', 11, 1, 1383105995, 1466339397),
(33, 'allow_visit', 3, '不受限控制器方法', 0, '', '', '0:article/draftbox\n1:article/mydocument\n2:Category/tree\n3:Index/verify\n4:file/upload\n5:file/download\n6:user/updatePassword\n7:user/updateNickname\n8:user/submitPassword\n9:user/submitNickname\n10:file/uploadpicture', 0, 1, 1386644047, 1466328530),
(34, 'deny_visit', 3, '超管专限控制器方法', 0, '', '仅超级管理员可访问的控制器方法', '0:Addons/addhook\n1:Addons/edithook\n2:Addons/delhook\n3:Addons/updateHook\n4:Admin/getMenus\n5:Admin/recordList\n6:AuthManager/updateRules\n7:AuthManager/tree', 0, 1, 1386644141, 1466328512),
(35, 'reply_list_rows', 0, '回复列表每页条数', 2, '', '', '10', 0, 1, 1386645376, 1466328438),
(36, 'admin_allow_ip', 2, '后台允许访问IP', 4, '', '多个用逗号分隔，如果不配置表示不限制IP访问', '', 12, 1, 1387165454, 1466328411),
(37, 'show_page_trace', 4, '是否显示页面Trace', 4, '0:关闭\n1:开启', '是否显示页面Trace信息', '1', 1, 1, 1387165685, 1466328334),
(38, 'app_debug', 4, '是否开启调试模式', 4, '0:关闭\n1:开启', '是否开启调试模式状态，true 开启，false 关闭', '1', 1, 1, 1466342586, 1466344446),
(39, 'paginate', 3, '分页配置', 4, '', '用于配置分页选项，type分页样式，var_page分页参数，list_rows，每页显示条数', 'type:bootstrap\nvar_page:page\npath:\nlist_rows:15', 6, 1, 1466346454, 1466346917),
(40, 'url_domain_deploy', 4, '域名部署路由', 4, '0:关闭\n1:开启', '是否启用域名部署配置', '1', 1, 1, 1466347093, 1466347093);

-- --------------------------------------------------------

--
-- 表的结构 `cy_developer`
--

CREATE TABLE `cy_developer` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `title` varchar(128) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) UNSIGNED DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `delete_status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '删除状态',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作者id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作时间',
  `delete_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cy_developer`
--

INSERT INTO `cy_developer` (`id`, `title`, `content`, `status`, `create_uid`, `create_time`, `create_ip`, `update_uid`, `update_time`, `update_ip`, `delete_status`, `delete_uid`, `delete_time`, `delete_ip`) VALUES
(1, '添加开发日志功能-开发日志[20160528]', '<p>&nbsp;&nbsp;&nbsp;&nbsp;想记录着些什么，可不知道从哪里开始记录，一直想把这开发的过程记录起来，所以今天添加了开发日志的功能，用以来记录这一路走来的点点滴滴。<br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;随着 thinkphp 5 的不段完善，想着用新版本的框架来做一个东西，所以一开始就跟着官方在进步，每一次更新框架都是一个考验，当把新版本的框架更新完之后，再到程序里去运行，每一次都希望自己的东西在新版本的框架里运行时不会出现什么问题，当然，这过程也遇到过很多的报错，所以说每一次更新框架都是需要很大的勇气，但是又不得不更新，因为只能跟着官方走，官方的框架也在一步一步的完善。<br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;当然，有时候也傻逼傻逼地向官方反馈些根本不是错误的错误，全是自己不理解开发文档的错，但也不免会有些是bug，只是自己不知道罢了，半路出家，学业不精，只能这样的。<br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;好吧，时间也不早了，废话了一大堆，该记记今天的日志了。<br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;这是第一篇开发日志，因为开发日志记录功能才刚刚完善，此时的版本升级到了0.8<br/></p><p><br/></p><p>[20160528]</p><p>一、新增</p><ol><li><p>开发日志，这就不用说了</p></li><li><p>新增了developer表<br/></p></li><li><p>新增了ueditor编辑器</p></li></ol><p><br/></p><p>二、更新</p><ol><li><p>更新了基本模板</p></li><li><p>更新了缓存操作</p></li><li><p>更新了侧边栏</p></li></ol><p><br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;第一每写开发日志，写着写着就想不起来这一天以来都做了些什么，只知道做了很多的东西，可真正到写的时候全部都忘得一干二净，脑海里什么都没有，好吧，就这样。<br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;晚安。<br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;晚安，宝贝。<br/></p>', 1, 1, 1464453027, 2130706433, 1, 1464504470, 2130706433, 1, 0, 0, 0),
(2, '测试插件编辑器', '<p>测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器测试插件编辑器</p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><img src="/data/images/20160621/c117bae9c082a5e49560add921952554.jpg" title="测试插件编辑器" alt="测试插件编辑器"/></p><p><br/></p><p><br/></p><p><br/></p><p>工载城</p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p><p><br/></p>', 1, 1, 1466441432, 2130706433, 1, 1466441589, 2130706433, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_document`
--

CREATE TABLE `cy_document` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '文档ID',
  `uid` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',
  `name` char(40) NOT NULL DEFAULT '' COMMENT '标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
  `category_id` int(10) UNSIGNED NOT NULL COMMENT '所属分类',
  `group_id` smallint(3) UNSIGNED NOT NULL COMMENT '所属分组',
  `description` char(140) NOT NULL DEFAULT '' COMMENT '描述',
  `root` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '根节点',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '所属ID',
  `model_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '内容模型ID',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT '内容类型',
  `position` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '推荐位',
  `link_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '外链',
  `cover_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '封面',
  `display` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '可见性',
  `deadline` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '截至时间',
  `attach` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '附件数量',
  `view` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '浏览量',
  `comment` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '评论数',
  `extend` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '扩展统计字段',
  `level` int(10) NOT NULL DEFAULT '0' COMMENT '优先级',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档模型基础表';

--
-- 转存表中的数据 `cy_document`
--

INSERT INTO `cy_document` (`id`, `uid`, `name`, `title`, `category_id`, `group_id`, `description`, `root`, `pid`, `model_id`, `type`, `position`, `link_id`, `cover_id`, `display`, `deadline`, `attach`, `view`, `comment`, `extend`, `level`, `create_time`, `update_time`, `status`) VALUES
(1, 1, '', 'OneThink1.1开发版发布', 2, 0, '期待已久的OneThink最新版发布', 0, 0, 2, 2, 0, 0, 0, 1, 0, 0, 37, 0, 0, 0, 1406001413, 1406001413, 1),
(2, 1, '', '成功案例1', 2, 0, '', 0, 0, 2, 2, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1466442682, 1466442682, 2),
(3, 1, '', 'ds sdf', 2, 0, '', 0, 0, 2, 2, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 1466442722, 1466442722, 1);

-- --------------------------------------------------------

--
-- 表的结构 `cy_document_article`
--

CREATE TABLE `cy_document_article` (
  `id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '文档ID',
  `parse` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '内容解析类型',
  `content` text NOT NULL COMMENT '文章内容',
  `template` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页显示模板',
  `bookmark` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '收藏数'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档模型文章表';

--
-- 转存表中的数据 `cy_document_article`
--

INSERT INTO `cy_document_article` (`id`, `parse`, `content`, `template`, `bookmark`) VALUES
(1, 0, '<h1>\r\n	OneThink1.1开发版发布&nbsp;\r\n</h1>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>OneThink是一个开源的内容管理框架，基于最新的ThinkPHP3.2版本开发，提供更方便、更安全的WEB应用开发体验，采用了全新的架构设计和命名空间机制，融合了模块化、驱动化和插件化的设计理念于一体，开启了国内WEB应用傻瓜式开发的新潮流。&nbsp;</strong> \r\n</p>\r\n<h2>\r\n	主要特性：\r\n</h2>\r\n<p>\r\n	1. 基于ThinkPHP最新3.2版本。\r\n</p>\r\n<p>\r\n	2. 模块化：全新的架构和模块化的开发机制，便于灵活扩展和二次开发。&nbsp;\r\n</p>\r\n<p>\r\n	3. 文档模型/分类体系：通过和文档模型绑定，以及不同的文档类型，不同分类可以实现差异化的功能，轻松实现诸如资讯、下载、讨论和图片等功能。\r\n</p>\r\n<p>\r\n	4. 开源免费：OneThink遵循Apache2开源协议,免费提供使用。&nbsp;\r\n</p>\r\n<p>\r\n	5. 用户行为：支持自定义用户行为，可以对单个用户或者群体用户的行为进行记录及分享，为您的运营决策提供有效参考数据。\r\n</p>\r\n<p>\r\n	6. 云端部署：通过驱动的方式可以轻松支持平台的部署，让您的网站无缝迁移，内置已经支持SAE和BAE3.0。\r\n</p>\r\n<p>\r\n	7. 云服务支持：即将启动支持云存储、云安全、云过滤和云统计等服务，更多贴心的服务让您的网站更安心。\r\n</p>\r\n<p>\r\n	8. 安全稳健：提供稳健的安全策略，包括备份恢复、容错、防止恶意攻击登录，网页防篡改等多项安全管理功能，保证系统安全，可靠、稳定的运行。&nbsp;\r\n</p>\r\n<p>\r\n	9. 应用仓库：官方应用仓库拥有大量来自第三方插件和应用模块、模板主题，有众多来自开源社区的贡献，让您的网站“One”美无缺。&nbsp;\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>&nbsp;OneThink集成了一个完善的后台管理体系和前台模板标签系统，让你轻松管理数据和进行前台网站的标签式开发。&nbsp;</strong> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<h2>\r\n	后台主要功能：\r\n</h2>\r\n<p>\r\n	1. 用户Passport系统\r\n</p>\r\n<p>\r\n	2. 配置管理系统&nbsp;\r\n</p>\r\n<p>\r\n	3. 权限控制系统\r\n</p>\r\n<p>\r\n	4. 后台建模系统&nbsp;\r\n</p>\r\n<p>\r\n	5. 多级分类系统&nbsp;\r\n</p>\r\n<p>\r\n	6. 用户行为系统&nbsp;\r\n</p>\r\n<p>\r\n	7. 钩子和插件系统\r\n</p>\r\n<p>\r\n	8. 系统日志系统&nbsp;\r\n</p>\r\n<p>\r\n	9. 数据备份和还原\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	&nbsp;[ 官方下载：&nbsp;<a href="http://www.onethink.cn/download.html" target="_blank">http://www.onethink.cn/download.html</a>&nbsp;&nbsp;开发手册：<a href="http://document.onethink.cn/" target="_blank">http://document.onethink.cn/</a>&nbsp;]&nbsp;\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>OneThink开发团队 2013~2014</strong> \r\n</p>', '', 0),
(2, 2, 'fds afds ads ads dsa \r\nfads \r\ndsf \r\nsadf 1. * > \r\n* * * * *\r\n\r\n* * * * *\r\n\r\n* * * * *\r\n\r\n* * * * *\r\n\r\n* * * * *[]()\r\n\r\n* * * * *\r\n\r\n* * * * *\r\n\r\n* * * * *\r\n\r\n* * * * *\r\n\r\n* * * * *\r\n\r\ndsaf \r\nsad \r\ndsf \r\ndsaf s\r\nadf \r\ndsaf adsf\r\n s\r\nadf sad\r\n \r\nadsf \r\ndsaf \r\ndsf \r\nads \r\nsadf\r\n sadf\r\n ads\r\n \r\nads \r\ndsa \r\ndsa \r\nads \r\nsd\r\n sd\r\n \r\nds \r\nsd \r\nsad\r\n \r\ndsa \r\nas \r\nasdf\r\n fads\r\n d\r\nas \r\nfds asdf\r\n sd\r\n sd\r\n sad\r\n as\r\n as\r\n \r\nsd\r\n s\r\ndf \r\nsdf\r\n sad\r\nf \r\nasfd \r\nsad sad\r\n fsd\r\n fs\r\nd \r\nasdf \r\nadsf \r\nsadf\r\n sadf\r\n \r\nsfd \r\nsdf\r\n s df', '', 0),
(3, 2, 'dsfa fdsa sadf ', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_dot_article`
--

CREATE TABLE `cy_dot_article` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '类型id',
  `title` char(128) NOT NULL COMMENT '标题',
  `keywords` char(128) NOT NULL COMMENT '关键字',
  `description` char(128) NOT NULL COMMENT '描述',
  `content` text NOT NULL COMMENT '内容',
  `cover` char(128) NOT NULL COMMENT '封面',
  `source` char(56) NOT NULL COMMENT '来源',
  `times` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '访问次数',
  `template` char(56) NOT NULL COMMENT '模板',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) UNSIGNED DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `delete_status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '删除状态',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作者id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作时间',
  `delete_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cy_dot_article`
--

INSERT INTO `cy_dot_article` (`id`, `cid`, `title`, `keywords`, `description`, `content`, `cover`, `source`, `times`, `template`, `status`, `create_uid`, `create_time`, `create_ip`, `update_uid`, `update_time`, `update_ip`, `delete_status`, `delete_uid`, `delete_time`, `delete_ip`) VALUES
(1, 1, 'fd adf', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的fda df 初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '', '', 0, '', 1, 1, 1465214318, 2130706433, 0, 1465214318, 0, 1, 0, 0, 0),
(2, 4, '测试一', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '', '', 0, '', 1, 1, 1465214448, 2130706433, 0, 1465214448, 0, 1, 0, 0, 0),
(3, 5, '朝秦暮楚 厅', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '', '', 0, '', 1, 1, 1465219500, 2130706433, 0, 1465219500, 0, 1, 0, 0, 0),
(4, 4, 'fa df', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', './data/test/2016-06-06\\15f3ea31588afc05b81aac44c2d0cedc.jpg', '', 0, '', 1, 1, 1465220509, 2130706433, 0, 1465220509, 0, 1, 0, 0, 0),
(5, 1, 'f fd fad', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', './data/test/2016-06-06\\68c0110717543f1e984a2aacdc2519d0.jpg', '', 0, '', 1, 1, 1465220624, 2130706433, 0, 1465220624, 0, 1, 0, 0, 0),
(6, 4, 'fda fds', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', './data/test/2016-06-06\\d7a0edf1c60236d2186fae4989e703e8.jpg', '', 0, '', 1, 1, 1465220716, 2130706433, 0, 1465220716, 0, 1, 0, 0, 0),
(7, 4, 'gf g', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', './data/test/2016-06-06\\a92b2493f2fd9d88462ac65dff70dbb3.jpg', '', 0, '', 1, 1, 1465220839, 2130706433, 0, 1465220839, 0, 1, 0, 0, 0),
(8, 1, 'fdas asf', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', './data/test/2016-06-06\\e8197aaad2f27393401f1a6a4a276ac4.jpg', '', 0, '', 1, 1, 1465220929, 2130706433, 0, 1465220929, 0, 1, 0, 0, 0),
(9, 4, 'fafd dsf adsf', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', 'a66a6742c6845c366099c911dbe9fa.jpg', '', 0, '', 1, 1, 1465221652, 2130706433, 0, 1465221652, 0, 1, 0, 0, 0),
(15, 1, 'fd df d a d', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p><img src="http://127.0.0.1:89/data/image/20160606/1465223785007684900.jpg" title="1465223785007684900.jpg"/></p><p><img src="http://127.0.0.1:89/data/image/20160606/1465223785043795500.jpg" title="1465223785043795500.jpg"/></p><p><img src="http://127.0.0.1:89/data/image/20160606/1465223785062677000.jpg" title="1465223785062677000.jpg"/></p><p>这里写你的初始化内容 &nbsp; &nbsp; &nbsp; &nbsp;d afd af ads d df df &nbsp; &nbsp; &nbsp;</p>', '93240dff4f408ea513ee4517dcd107b4.jpg', '', 0, '', 1, 1, 1465223789, 2130706433, 0, 1465223789, 0, 1, 0, 0, 0),
(11, 5, 'fadsf dasf', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '7b0ffa5b455b9cb02afd0731b769c929.jpg', '', 0, '', 1, 1, 1465221709, 2130706433, 0, 1465221709, 0, 1, 0, 0, 0),
(12, 5, 'f asfads', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '46d164bc5d520e3a8d2223780049234336409a.jpg', '', 0, '', 1, 1, 1465221767, 2130706433, 0, 1465221767, 0, 1, 0, 0, 0),
(13, 4, 'fgfs', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '51075cb22ecedf9b7a60fecab33b026e.jpg', '', 0, '', 1, 1, 1465223179, 2130706433, 0, 1465223179, 0, 1, 0, 0, 0),
(14, 4, 'dffad af', '初始化,这里,内容', '这里写你的初始化内容\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '0e0c9f1bef1e44bb1c20b12f31002f56.jpg', '', 0, '', 1, 1, 1465223337, 2130706433, 1, 1465306307, 2130706433, 1, 0, 0, 0),
(16, 1, '这是标题', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p><img src="http://127.0.0.1:89/data/image/20160606/1465228611029166600.jpg" title="1465228611029166600.jpg"/></p><p><img src="http://127.0.0.1:89/data/image/20160606/1465228611064560700.jpg" title="1465228611064560700.jpg"/></p><p><img src="http://127.0.0.1:89/data/image/20160606/1465228611091979400.jpg" title="1465228611091979400.jpg"/></p><p><img src="http://127.0.0.1:89/data/image/20160606/1465228612009102500.jpg" title="1465228612009102500.jpg"/></p><p><img src="http://127.0.0.1:89/data/image/20160606/1465228612034569600.jpg" title="1465228612034569600.jpg"/></p><p><img src="http://127.0.0.1:89/data/image/20160606/1465228612060140600.jpg" title="1465228612060140600.jpg"/></p><p><img src="http://127.0.0.1:89/data/image/20160606/1465228612079726000.jpg" title="1465228612079726000.jpg"/></p><p><img src="http://127.0.0.1:89/data/image/20160606/1465228613004255400.jpg" title="1465228613004255400.jpg"/></p><p>&nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br/></p>', 'f248a2711c40e48530174403cd065efc.jpg', '', 0, '', 1, 1, 1465228718, 2130706433, 0, 1465228718, 0, 1, 0, 0, 0),
(17, 4, '城阿萨德是否大芬村', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;地打撒第三方 &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '32c357b37edacbfb6b688c2d6541279a.jpg', '', 0, '', 1, 1, 1465228738, 2130706433, 0, 1465228738, 0, 1, 0, 0, 0),
(18, 1, 'fdsa', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', './data/image/20160607', '', 0, '', 1, 1, 1465228928, 2130706433, 0, 1465228928, 0, 1, 0, 0, 0),
(19, 4, 'fsd sdf', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '0', '', 0, '', 1, 1, 1465228996, 2130706433, 0, 1465228996, 0, 1, 0, 0, 0),
(20, 4, 'fads fdas', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160607\\c763df25ac0adbe12f8f207bec037076.jpg', '', 0, '', 1, 1, 1465229104, 2130706433, 0, 1465229104, 0, 1, 0, 0, 0),
(21, 4, 'fad f ds', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160607/c6d6d3b24af300d1bb231fe5a41ef463.jpg', '', 0, '', 1, 1, 1465229150, 2130706433, 0, 1465229150, 0, 1, 0, 0, 0),
(22, 4, 'g f fd', '初始化,这里,内容', '这里写你的初始化内容\n', '<p>g</p>', '20160607/6d0be7c1c811360e0f29a4e13a344580.jpg', '', 0, '', 1, 1, 1465229460, 2130706433, 1, 1465301186, 2130706433, 1, 0, 0, 0),
(23, 4, 'fafaa', '初始化,这里,内容', '这里写你的初始化内容\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '', '', 0, '', 1, 1, 1465303966, 2130706433, 1, 1465306278, 2130706433, 1, 0, 0, 0),
(24, 1, 'fds fads', '初始化,这里,内容', '这里写你的初始化内容\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '', '', 0, '', 1, 1, 1465303989, 2130706433, 0, 1465303989, 0, 1, 0, 0, 0),
(25, 0, '', '初始化,这里,内容', '这里写你的初始化内容\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '', '', 0, '', 1, 1, 1465305024, 2130706433, 0, 1465305024, 0, 1, 0, 0, 0),
(37, 1, '堪大规模', '京东,华为,销量,小米,电商,手机,仍然,成绩,冠军,苹果', '京东618电商节活动还在如火如荼地进行中，每天公布的战报也彰显了国产手机厂商们竞争的惨烈。单日销量小米首先三连冠，紧接着华为反超连续拿下两次第一。', '<p style="text-indent: 2em; text-align: left;">京东618电商节活动还在如火如荼地进行中，每天公布的战报也彰显了国产手机厂商们竞争的惨烈。单日销量小米首先三连冠，紧接着华为反超连续拿下两次第一。</p><p style="text-indent: 2em; text-align: left;">但是在第六天，黑马杀了出来。</p><p style="text-indent: 2em; text-align: left;">根据京东官方数据，6月6日，京东手机销量的冠军品牌，不是小米也不是华为，而是魅族，成绩为59970台。</p><p style="text-indent: 2em; text-align: left;">有趣的是，魅族昨天称自己在京东618上成为“销量竞速冠军”，1分28秒手机销量就突破1万台，看来所言非虚。</p><p style="text-indent: 2em; text-align: left;">在累计销量榜上，魅族仍然位列第四，不过126362台的成绩已经无限逼近苹果的130212台，超越指日可待。</p><p style="text-indent: 2em; text-align: left;">前两名仍然是小米、华为，争夺很激烈，263369台、245191台的差距也不大，随时可能变天。</p><p style="text-indent: 2em; text-align: left;">而在销售额排行榜上，无敌的苹果天天都是第一，之后是华为、小米、三星、魅族、乐视、OPPO、vivo、360、中兴。</p><p><br/></p><p><img src="/data/images/20160607/1465308959041859800.jpg" style="" title="1465308959041859800.jpg"/></p><p style="text-indent: 2em; text-align: left;"><br/></p>', '', '', 0, '', 1, 1, 1465308970, 2130706433, 1, 1465308989, 2130706433, 1, 0, 0, 0),
(27, 1, 'fda', 'fdasfad', 'fdasfad', '<p>fdasfad<br/></p>', '', '', 0, '', 1, 1, 1465305257, 2130706433, 0, 1465305257, 0, 1, 0, 0, 0),
(28, 2, 'fds', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容 &nbsp; &nbsp; &nbsp; ll &nbsp; &nbsp; &nbsp;</p>', '20160607/601cb0b0724248f7966bb7ce28b79acd.jpg', '', 0, '', 1, 1, 1465305607, 2130706433, 1, 1465307693, 2130706433, 1, 0, 0, 0),
(29, 1, 'fdas', '初始化,这里,内容', '这里写你的初始化内容\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '', '', 0, '', 1, 1, 1465306368, 2130706433, 0, 1465306368, 0, 1, 0, 0, 0),
(31, 4, 'fad', 'fdas', '这里写你的初始化内容\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '', '', 0, '', 1, 1, 1465306616, 2130706433, 1, 1465306622, 2130706433, 1, 0, 0, 0),
(32, 1, 'fa', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160607/a88f991df36de96b828bbb0b7d2e0d11.jpg', '', 0, '', 1, 1, 1465307626, 2130706433, 1, 1465307638, 2130706433, 1, 0, 0, 0),
(33, 1, 'afds', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160607/f2af2e02c0b099798b5bc58ec7b285f5.jpg', '', 0, '', 1, 1, 1465307654, 2130706433, 1, 1465307706, 2130706433, 1, 0, 0, 0),
(34, 1, '完善测试', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160607/685bbf125989e97382a97693541c95ce.jpg', '', 0, '', 1, 1, 1465307792, 2130706433, 1, 1465307803, 2130706433, 1, 0, 0, 0),
(35, 4, '完善没试2', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160607/555891ce95257070e0724ad296cbb68d.jpg', '', 0, '', 1, 1, 1465307943, 2130706433, 1, 1465308197, 2130706433, 1, 0, 0, 0),
(36, 4, '完善测试', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160607/3acbc7a6e8e1de8f420e77d2a3d42041.jpg', '', 0, '', 1, 1, 1465308287, 2130706433, 1, 1465308299, 2130706433, 1, 0, 0, 0),
(38, 4, 'fdas', '通航,舟山,海洋,飞行,中信集团,大青山,飞机,中国民航,中国海,舟山市', '国家海洋局东海分局、舟山市民航局7日晚通报称，中国海监一架飞机在执行飞行任务返航途中失联。', '<p style="text-indent: 2em; text-align: left;">国家海洋局东海分局、舟山市民航局7日晚通报称，中国海监一架飞机在执行飞行任务返航途中失联。</p><p style="text-indent: 2em; text-align: left;">18点51分，搜寻人员在舟山朱家尖大青山山顶发现飞机残骸，四位机组人员不幸全部遇难。</p><p style="text-indent: 2em; text-align: left;">据了解，中信海直通航B7115/H410今天执行海洋监察飞行任务时，13:26最后一次通讯后失联。</p><p style="text-indent: 2em; text-align: left;">该机于11:30从舟山机场起飞，原计划返场到达时间为13:40。</p><p style="text-align:center"><br/></p><p style="text-indent: 2em; text-align: left;">海直通用航空有限责任公司是中国中信集团旗下中信海洋直升机股份有限公司的子公司，中国民航批准成立的甲类通用航空公司，主要发展航空器代管、航空护林、海洋巡查、海洋监测、极地科考、海上救助等飞行服务。</p><p style="text-indent: 2em; text-align: left;">据通航资源网资料库显示，海直通航目前运营32架飞机，其中HafeiH425 14架、Ka-32A 8架、SA365N 3架、AS350B3 2架、H410 2架、A109E 1架、AS350B2 1架、Z11 1架。</p><p style="text-align: center;"><img alt="中国海监一架飞机坠毁：4人不幸遇难" src="/data/images/20160607/1465309047084095900.jpg" twffan="done" style="border: 1px solid black;"/></p>', '', '', 0, '', 1, 1, 1465309145, 2130706433, 1, 1465309156, 2130706433, 1, 0, 0, 0),
(39, 4, '这中', '初始化,这里,内容', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p><img src="/data/images/20160607/1465314303080662800.jpg" style="" title="1465314303080662800.jpg"/></p><p><img src="/data/images/20160607/1465314303099028300.jpg" style="" title="1465314303099028300.jpg"/></p><p><img src="/data/images/20160607/1465314304020065100.jpg" style="" title="1465314304020065100.jpg"/></p><p><img src="/data/images/20160607/1465314304042496800.jpg" style="" title="1465314304042496800.jpg"/></p><p><br/></p>', '', '', 0, '', 1, 1, 1465314391, 2130706433, 0, 1465314391, 0, 1, 0, 0, 0),
(40, 4, '这中国', '初始化,这里,内容', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p><img src="/data/images/20160607/1465314303080662800.jpg" style="" title="1465314303080662800.jpg"/></p><p><img src="/data/images/20160607/1465314303099028300.jpg" style="" title="1465314303099028300.jpg"/></p><p><img src="/data/images/20160607/1465314304020065100.jpg" style="" title="1465314304020065100.jpg"/></p><p><img src="/data/images/20160607/1465314304042496800.jpg" style="" title="1465314304042496800.jpg"/></p><p><br/></p>', '', '', 0, '', 1, 1, 1465314420, 2130706433, 1, 1465314586, 2130706433, 1, 0, 0, 0),
(41, 4, '城硒鼓', '初始化,这里,内容', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp;</p><p><img src="/data/images/20160608/1465315942071298300.jpg" style="" title="1465315942071298300.jpg"/></p><p><img src="/data/images/20160608/1465315943000693100.jpg" style="" title="1465315943000693100.jpg"/></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br/></p>', '', '', 0, '', 1, 1, 1465315944, 2130706433, 1, 1465316178, 2130706433, 1, 0, 0, 0),
(42, 4, '玩耍', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的<img src="/data/images/20160608/1465316049095793800.jpg" title="1465316049095793800.jpg" alt="BingWallpaper-1920x1080-2015-10-01.jpg"/>初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160608/7df7f97acbcb07fc117ce35f89dab6a1.jpg', '', 0, '', 1, 1, 1465316054, 2130706433, 1, 1465316875, 2130706433, 1, 0, 0, 0),
(43, 1, '地工', '初始化,这里,内容', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp; &nbsp;</p><p><img src="/data/images/20160608/1465318063030249200.jpg" style="" title="1465318063030249200.jpg"/></p><p><img src="/data/images/20160608/1465318063052451300.jpg" style="" title="1465318063052451300.jpg"/></p><p><img src="/data/images/20160608/1465318063072642400.jpg" style="" title="1465318063072642400.jpg"/></p><p>&nbsp; &nbsp; &nbsp; &nbsp;<br/></p>', '20160608/03391b32f6421b69063e2b7afb22206e.jpg', '', 0, '', 1, 1, 1465318065, 2130706433, 1, 1465318386, 2130706433, 1, 0, 0, 0),
(44, 4, '城地p', '初始化,这里,内容', '', '<p><img src="/data/images/20160608/1465318705026760800.jpg" title="1465318705026760800.jpg" alt="BingWallpaper-1920x1080-2015-10-05.jpg"/></p>', '20160608/65dddc80b1a307dbbb6aed6286563185.jpg', '', 0, '', 1, 1, 1465318628, 2130706433, 1, 1465319339, 2130706433, 1, 0, 0, 0),
(45, 4, 'f a', '初始化,这里,内容', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初<img src="/data/images/20160608/1465319383005208800.jpg" title="1465319383005208800.jpg" alt="BingWallpaper-1920x1080-2015-10-06.jpg"/>始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p><img src="/data/images/20160608/1465319397053917700.jpg" title="1465319397053917700.jpg" alt="BingWallpaper-1920x1080-2015-10-08.jpg"/></p>', '20160608/e2c52d361c76191473f4b730cbe323ab.jpg', '', 0, '', 1, 1, 1465319400, 2130706433, 0, 1465319400, 0, 1, 0, 0, 0),
(46, 4, 'vvvc', 'f fad', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src="/data/images/20160608/1465319991065951800.jpg" title="1465319991065951800.jpg" alt="BingWallpaper-1920x1080-2015-10-04.jpg"/></p>', '20160608/f1611f4d320a8af4a292ccb9e493b4d4.jpg', '', 0, '', 1, 1, 1465319994, 2130706433, 0, 1465319994, 0, 1, 0, 0, 0),
(47, 1, 'vdf', 'fad', '这里写你的初始化内容\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src="/data/images/20160608/1465320062004938400.jpg" title="1465320062004938400.jpg" alt="BingWallpaper-1920x1080-2015-10-03.jpg"/> &nbsp;这里写你的初始化内容\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '', '', 0, '', 1, 1, 1465320085, 2130706433, 0, 1465320085, 0, 1, 0, 0, 0),
(48, 1, ' fa fds', '初始化,这里,内容', '', '<p><img src="/data/images/20160608/1465320144071749800.jpg" style="" title="1465320144071749800.jpg"/></p><p><img src="/data/images/20160608/1465320145010903900.jpg" style="" title="1465320145010903900.jpg"/></p><p><img src="/data/images/20160608/1465320145028214100.jpg" style="" title="1465320145028214100.jpg"/></p><p><img src="/data/images/20160608/1465320145044439000.jpg" style="" title="1465320145044439000.jpg"/></p><p><img src="/data/images/20160608/1465320145071084200.jpg" style="" title="1465320145071084200.jpg"/></p><p><img src="/data/images/20160608/1465320145092596100.jpg" style="" title="1465320145092596100.jpg"/></p><p><img src="/data/images/20160608/1465320146013368700.jpg" style="" title="1465320146013368700.jpg"/></p><p><img src="/data/images/20160608/1465320146033010900.jpg" style="" title="1465320146033010900.jpg"/></p><p><img src="/data/images/20160608/1465320146053667600.jpg" style="" title="1465320146053667600.jpg"/></p><p><img src="/data/images/20160608/1465320146073857800.jpg" style="" title="1465320146073857800.jpg"/></p><p><img src="/data/images/20160608/1465320147001585300.jpg" style="" title="1465320147001585300.jpg"/></p><p><img src="/data/images/20160608/1465320147018724400.jpg" style="" title="1465320147018724400.jpg"/></p><p><img src="/data/images/20160608/1465320147037282600.jpg" style="" title="1465320147037282600.jpg"/></p><p><img src="/data/images/20160608/1465320147052264400.jpg" style="" title="1465320147052264400.jpg"/></p><p><img src="/data/images/20160608/1465320147068653100.jpg" style="" title="1465320147068653100.jpg"/></p><p><img src="/data/images/20160608/1465320147094264800.jpg" style="" title="1465320147094264800.jpg"/></p><p><img src="/data/images/20160608/1465320148039973100.jpg" style="" title="1465320148039973100.jpg"/></p><p><img src="/data/images/20160608/1465320148067121600.jpg" style="" title="1465320148067121600.jpg"/></p><p><img src="/data/images/20160608/1465320148095663600.jpg" style="" title="1465320148095663600.jpg"/></p><p><img src="/data/images/20160608/1465320149020546600.jpg" style="" title="1465320149020546600.jpg"/></p><p><img src="/data/images/20160608/1465320149043650900.jpg" style="" title="1465320149043650900.jpg"/></p><p><img src="/data/images/20160608/1465320149061540900.jpg" style="" title="1465320149061540900.jpg"/></p><p><img src="/data/images/20160608/1465320149078823100.jpg" style="" title="1465320149078823100.jpg"/></p><p><img src="/data/images/20160608/1465320149096842000.jpg" style="" title="1465320149096842000.jpg"/></p><p><img src="/data/images/20160608/1465320150018115500.jpg" style="" title="1465320150018115500.jpg"/></p><p><img src="/data/images/20160608/1465320150034900900.jpg" style="" title="1465320150034900900.jpg"/></p><p><img src="/data/images/20160608/1465320150059928600.jpg" style="" title="1465320150059928600.jpg"/></p><p><img src="/data/images/20160608/1465320150077538100.jpg" style="" title="1465320150077538100.jpg"/></p><p><img src="/data/images/20160608/1465320150098328000.jpg" style="" title="1465320150098328000.jpg"/></p><p><img src="/data/images/20160608/1465320151016517200.jpg" style="" title="1465320151016517200.jpg"/></p><p><img src="/data/images/20160608/1465320151031533900.jpg" style="" title="1465320151031533900.jpg"/></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br/></p>', '20160608/e33f44d87c853c6d1f14a714a99e0a24.jpg', '', 0, '', 1, 1, 1465320155, 2130706433, 0, 1465320155, 0, 1, 0, 0, 0),
(49, 4, '完善测试', '初始化,20160330175715,这里,内容,xls', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp;</p><p style="line-height: 16px;"><img style="vertical-align: middle; margin-right: 2px;" src="http://127.0.0.1:89/statics/images/fileTypeImages/icon_xls.gif"/><a style="font-size:12px; color:#0066cc;" href="/data/file/20160609/1465405831032933000.xls" title="20160330175715.xls">20160330175715.xls</a></p><p><br/></p>', '20160609/12dd7cecd50fbdd7b6adef4f5c16188d.jpg', '', 0, '', 1, 1, 1465405834, 2130706433, 0, 1465405834, 0, 1, 0, 0, 0),
(50, 4, 'f adf', '初始化,20160408184923,这里,内容,xls', '20160408184923.xls', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p style="line-height: 16px;"><img style="vertical-align: middle; margin-right: 2px;" src="http://127.0.0.1:89/statics/images/fileTypeImages/icon_xls.gif"/><a style="font-size:12px; color:#0066cc;" href="/data/file/20160609/1465432566007528100.xls" title="20160408184923.xls">20160408184923.xls</a></p><p><br/></p><p><img src="/data/images/20160613/93a1702a3bc8a6c741e959478eb82904.jpg"  title="f adf" alt="f adf"/></p><p><img src="/data/images/20160613/d4f0e8311347768af356fa98215b176f.jpg"  title="f adf" alt="f adf"/></p><p><img src="/data/images/20160613/d0887c906481af67a3748e67b893872e.jpg"  title="f adf" alt="f adf"/></p><p><img src="/data/images/20160613/aa40fd056fbd87569423620f2cb29b45.jpg"  title="f adf" alt="f adf"/></p><p><br/></p>', '20160613/33be6d31ff1e2cec0447fe6b3c317d8d.jpg', '', 0, '', 1, 1, 1465432568, 2130706433, 1, 1465754796, 2130706433, 1, 0, 0, 0),
(51, 1, '这是测试', 'sfad', '这里写你的初始化内容', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容&nbsp;</p><p style="line-height: 16px;"><img style="vertical-align: middle; margin-right: 2px;" src="http://127.0.0.1:89/statics/images/fileTypeImages/icon_xls.gif"/><a style="font-size:12px; color:#0066cc;" href="/data/files/20160609/1465432730021546000.xls" title="20160408184923.xls">20160408184923.xls</a></p><p>&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br/></p>', '20160612/d25d8002beafe722f45ab46c5343bac6.jpg', '', 0, '', 1, 1, 1465432732, 2130706433, 1, 1465743514, 2130706433, 1, 0, 0, 0),
(52, 4, '成功案例1', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160613/3fe653706d84e345d989daeeb1b68376.jpg', '', 0, '', 1, 1, 1465752515, 2130706433, 0, 1465752515, 0, 1, 0, 0, 0),
(53, 1, '测试2', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160613/1314123ccbec139517a0e3f8082a25ed.jpg', '', 0, '', 1, 1, 1465752726, 2130706433, 0, 1465752726, 0, 1, 0, 0, 0),
(54, 4, '成功案例1', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160613/8a0d9eb09c2a3a4f1247aacb1c605da7.jpg', '', 0, '', 1, 1, 1465752750, 2130706433, 0, 1465752750, 0, 1, 0, 0, 0),
(55, 1, '成功案例1', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160613/ba2b81247c89932dea49b71d39a26d7f.jpg', '', 0, '', 1, 1, 1465753339, 2130706433, 0, 1465753339, 0, 1, 0, 0, 0),
(56, 1, '成功案例1', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '20160613/6f7eef9dc049bea0c685b3736aca51e0.jpg', '', 0, '', 1, 1, 1465753562, 2130706433, 0, 1465753562, 0, 1, 0, 0, 0),
(57, 4, '成功案例1', '初始化,这里,内容', '这里写你的初始化内容\r\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\r\n &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p><br/></p><p><img src="/data/images/20160613/a92789383801986f9115172da9dad9da.jpg"  title="成功案例1" alt="成功案例1"/></p><p><img src="/data/images/20160613/a282bc833d99f8b7c89f6d9a49e31d4e.jpg"  title="成功案例1" alt="成功案例1"/></p><p><img src="/data/images/20160613/6fe6f3275eee225a896f325cc261525b.jpg"  title="成功案例1" alt="成功案例1"/></p><p><img src="/data/images/20160613/3e45f55b8b26955818256615840a98b6.jpg"  title="成功案例1" alt="成功案例1"/></p><p>&nbsp; &nbsp;<br/></p>', '20160613/b446c351416e51630669b29ed62efac5.jpg', '', 0, '', 1, 1, 1465754399, 2130706433, 0, 1465754399, 0, 1, 0, 0, 0),
(58, 5, '成功案例控制器', '初始化,这里,内容', '这里写你的初始化内容\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p style="text-align:center"><img src="/data/images/20160613/84089d620a243cb1920d1bcdbbee9c4e.jpg" title="成功案例控制器" alt="成功案例控制器" width="800" height="450" border="0" vspace="0" style="width: 800px; height: 450px;"/></p><p><img src="/data/images/20160613/eadf626a55975c874fd734792fc407e5.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/9b363b3c1a1aabe23df43992d76bcf3d.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/36fb9024c7cc0708b918566873c9ab57.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/56bfd8864bdbff8dc2c308fc693fdb9d.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/79fef094b27c9268df71cdb1021754bf.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/13ef289e2f8be89ee0467355b1f4aa77.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/9a23d0bf1171c49f1211c79f3d715fd4.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/41ac7691e791160295c8f50d3ee3944c.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/eeeb391c8c58e1a1c9cfa4dca58713bf.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/a1b32abded7126ddd0786faa696b5c89.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/ebb0a37d2486b780bbe3cfb2987ee3d8.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/4ec77d0e5d039e70d4a7051b7c07bdc7.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/c2d8028fe546b3ad3499faed8d51e99c.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/a456c8208b2de9e36e4ce4c3c0a16652.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/b35fda0068e633561ad62ab082b5871b.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/9e0ac83556483232d0022c3a511eb0be.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/d2ce15a54c39d7ec5948a4f0ccb10c52.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/490f0002b06417266dd435338c4b7f9d.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/4ab527ea002e52eab860fff3e25fcb7f.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/fa71b8ac88504274ef9f0a261e7c50b3.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/27f16e9689de2e698891fe6c9d393ec9.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/517c7243b50e8727826cd883039dd9e2.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/4f866d9277b92073e71c70afe17687fb.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/2ca337ca74ea9e168aa73786a901b374.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/71fcc92c17224dfc1b8560c3242107c6.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/a17346dcad55bb87c211027e5a63e8a6.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/a3867e851828fec635279d1cbfb6ae53.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/1344532beac2e6964c6b9d4bab7998ce.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/6babfab577369b59597b30e442eef439.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><img src="/data/images/20160613/9bb12d706ff44996025534a06d435d07.jpg" title="成功案例控制器" alt="成功案例控制器"/></p><p><br/></p>', '20160613/00392d210e6a627cad7e1b5a4ccdccf1.jpg', '', 0, '', 1, 1, 1465754551, 2130706433, 1, 1465820199, 2130706433, 1, 0, 0, 0),
(59, 6, '成功案例1', '初始化,这里,内容', '这里写你的初始化内容\n', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp; &nbsp; &nbsp;&nbsp;</p><p><img src="/data/images/20160613/362896459a8106ce28234aa9f32bc148.jpg" title="成功案例1" alt="成功案例1"/></p><p><img src="/data/images/20160613/649d54766254996ef2b526764dfd074c.jpg" title="成功案例1" alt="成功案例1"/></p><p><img src="/data/images/20160613/05528050de0a78db306ab83c2225bda1.jpg" title="成功案例1" alt="成功案例1"/></p><p><img src="/data/images/20160613/8157ca22574f2335d6617e3e179b94c2.jpg" title="成功案例1" alt="成功案例1"/></p><p><img src="/data/images/20160613/de2024b50303a4e4d75090de4938e7a1.jpg" title="成功案例1" alt="成功案例1"/></p><p><img src="/data/images/20160613/555f1bd2a46bde5777f9d8f3f3fcc17b.jpg" title="成功案例1" alt="成功案例1"/></p><p><img src="/data/images/20160613/d426f0b9a5e202e65ea2be3e3554ebdf.jpg" title="成功案例1" alt="成功案例1"/></p><p><img src="/data/images/20160613/084b8b570eb3a8941868c3a3fbda0248.jpg" title="成功案例1" alt="成功案例1"/></p><p>&nbsp; &nbsp; &nbsp;<br/></p>', '20160613/cc964f87a8a005b379ecb7511c48d8d1.jpg', '', 0, '', 1, 1, 1465821972, 2130706433, 1, 1466228215, 2130706433, 1, 0, 0, 0),
(60, 4, '成功案例1', '初始化,这里,内容', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;这里写你的初始化内容\n &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp;</p><p><br/></p><p><br/></p><p><br/></p><p>ff</p><p style="line-height: 16px;"><img style="vertical-align: middle; margin-right: 2px;" src="http://127.0.0.1:89/statics/images/fileTypeImages/icon_xls.gif"/><a style="font-size:12px; color:#0066cc;" href="/data/files/20160618/4462d4a988f1ef760067990971659f1d.xls" title="20160330175715.xls">20160330175715.xls</a></p><p><br/></p><p style="line-height: 16px;"><img style="vertical-align: middle; margin-right: 2px;" src="http://127.0.0.1:89/statics/images/fileTypeImages/icon_txt.gif"/><a style="font-size:12px; color:#0066cc;" href="/data/files/20160618/c02db69c5546010a3b84e2312d7c09aa.txt" title="新建文本文档.txt">新建文本文档.txt</a></p><p><img src="/data/images/20160614/185e3b05db16acfbf4bb5897d84d1e98.jpg" title="成功案例1" alt="成功案例1"/></p><p><img src="/data/images/20160614/e88cd9d103d02da0ba441770baf66385.jpg" title="成功案例1" alt="成功案例1"/></p><p><img src="/data/images/20160614/e8e2991621e9f21d9a02becc908b02d0.jpg" title="成功案例1" alt="成功案例1"/></p><p><br/></p>', '20160618/b742bb6849468a7f0ccde6b2dd1a6ebf.jpg', '', 0, '', 1, 1, 1465905260, 2130706433, 1, 1466228366, 2130706433, 1, 0, 0, 0),
(61, 4, '成功案例1', '', '', '<p>ddddssddd</p>', '', '', 0, '', 1, 1, 1466234782, 2130706433, 1, 1466236769, 2130706433, 1, 0, 0, 0),
(62, 1, '测试2', '', '', '<p>fdsafd</p>', '', '', 0, '', 1, 1, 1466236179, 2130706433, 0, 1466236179, 0, 1, 0, 0, 0),
(63, 1, '测试2', '', '', '<p>fdsafd</p>', '', '', 0, '', 1, 1, 1466236216, 2130706433, 0, 1466236216, 0, 1, 0, 0, 0),
(64, 4, '成功案例1', '', '', '<p>fdsfdf</p>', '', '', 0, '', 1, 1, 1466236267, 2130706433, 0, 1466236267, 0, 1, 0, 0, 0),
(65, 4, '成功案例1', '', '', '<p>fdsfdf</p>', '', '', 0, '', 1, 1, 1466236845, 2130706433, 0, 1466236845, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_dot_cases`
--

CREATE TABLE `cy_dot_cases` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `c_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类id',
  `title` char(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '内容',
  `show_img` char(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '展示图片',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) UNSIGNED DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `delete_status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '删除状态',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作者id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作时间',
  `delete_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `cy_dot_cases`
--

INSERT INTO `cy_dot_cases` (`id`, `c_id`, `title`, `content`, `show_img`, `status`, `create_uid`, `create_time`, `create_ip`, `update_uid`, `update_time`, `update_ip`, `delete_status`, `delete_uid`, `delete_time`, `delete_ip`) VALUES
(1, 0, '成功案例1', '<p style="text-align: center;"><br/></p><p style="text-align: left;"><br/></p><p><br/></p><p><br/></p><p style="text-align: left;"><br/></p><p style="text-align: left;">成功案例1成功案例1成功案例1成功案例1</p><ol class=" list-paddingleft-2"><li><p>fad fad&nbsp;</p></li><li><p>fda f&nbsp;</p></li><li><p>dfs fds&nbsp;</p></li><li><p>dsf adsf&nbsp;</p></li><li><p>df ads&nbsp;</p></li><li><p>fd fd fads&nbsp;<br/></p></li></ol>', '', 1, 1, 1464957607, 2130706433, 1, 1464965170, 2130706433, 1, 0, 0, 0),
(2, 0, '成功案例2', '<p><br/></p><p><img src="http://127.0.0.1:89/data/image/20160603/1464966019056681500.png" title="1464966019056681500.png"/></p><p><br/></p>', '', 1, 1, 1464966023, 2130706433, 1, 1464966237, 2130706433, 1, 0, 0, 0),
(3, 0, '添加行为魂牵梦萦f', '<p><img src="http://127.0.0.1:89/data/image/20160603/1464966213017275000.jpg" title="1464966213017275000.jpg"/></p><p><img src="http://127.0.0.1:89/data/image/20160603/1464966213069914400.jpg" title="1464966213069914400.jpg"/></p><p>添加行为魂牵梦萦f添加行为魂牵梦萦f添加行为魂牵梦萦f添加行为魂牵梦萦f添加行为魂牵梦萦f添加行为魂牵梦萦f添加行为魂牵梦萦f添加行为魂牵梦萦f添加行为魂牵梦萦f添加行为魂牵梦萦f添加行为魂牵梦萦f添加行为魂牵梦萦f添加行为魂牵梦萦f添加行为魂牵梦萦f</p>', '', 1, 1, 1464966112, 2130706433, 1, 1464966216, 2130706433, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_dot_category`
--

CREATE TABLE `cy_dot_category` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` char(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '唯一标识',
  `title` char(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `url` char(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'url地址',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `display` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否显示，1为显示，0为不显示',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) UNSIGNED DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `delete_status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '删除状态',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作者id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作时间',
  `delete_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `cy_dot_category`
--

INSERT INTO `cy_dot_category` (`id`, `pid`, `name`, `title`, `url`, `status`, `display`, `create_uid`, `create_time`, `create_ip`, `update_uid`, `update_time`, `update_ip`, `delete_status`, `delete_uid`, `delete_time`, `delete_ip`) VALUES
(1, 0, '', '广告牌', '', 1, 1, 0, 0, 0, 1, 1465114146, 2130706433, 1, 0, 0, 0),
(2, 0, '', '广告灯箱', '', 1, 1, 0, 0, 0, 1, 1465117677, 2130706433, 1, 0, 0, 0),
(3, 0, '', '广告安装', '', 1, 1, 0, 0, 0, 1, 1465117691, 2130706433, 1, 0, 0, 0),
(4, 1, '', '导视牌', '', 1, 1, 1, 1465115196, 2130706433, 0, 1465115196, 0, 1, 0, 0, 0),
(5, 1, '', '标识.标牌', '', 1, 1, 1, 1465117647, 2130706433, 1, 1465824056, 2130706433, 1, 0, 0, 0),
(6, 0, 'case', '成功案例', '', 1, 0, 1, 1465821922, 2130706433, 0, 1465821922, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_dot_menu`
--

CREATE TABLE `cy_dot_menu` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` char(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '唯一标识',
  `title` char(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `url` char(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'url地址',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) UNSIGNED DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `delete_status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '删除状态',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作者id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作时间',
  `delete_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `cy_dot_menu`
--

INSERT INTO `cy_dot_menu` (`id`, `pid`, `name`, `title`, `url`, `sort`, `status`, `create_uid`, `create_time`, `create_ip`, `update_uid`, `update_time`, `update_ip`, `delete_status`, `delete_uid`, `delete_time`, `delete_ip`) VALUES
(1, 0, 'case/index', '成功案例', '', 100, 1, 0, 0, 0, 1, 1464956672, 2130706433, 1, 0, 0, 0),
(2, 0, '', '关于我们', '', 100, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(3, 0, '', '联系我们', '', 100, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_dot_slide`
--

CREATE TABLE `cy_dot_slide` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `title` char(128) NOT NULL COMMENT '名称',
  `url` char(128) NOT NULL,
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) UNSIGNED DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `delete_status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '删除状态',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作者id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作时间',
  `delete_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cy_dot_webinfo`
--

CREATE TABLE `cy_dot_webinfo` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `title` char(128) NOT NULL COMMENT '网站名称',
  `keywords` char(128) NOT NULL COMMENT '关键字',
  `description` varchar(256) NOT NULL COMMENT '描述',
  `record` char(32) NOT NULL COMMENT '备案号',
  `statistical` varchar(256) NOT NULL COMMENT '统计代码',
  `address` varchar(256) NOT NULL COMMENT '地址',
  `telephone` char(64) NOT NULL COMMENT '电话',
  `email` char(64) NOT NULL COMMENT '邮箱',
  `qq` char(64) NOT NULL COMMENT 'QQ',
  `about` text NOT NULL COMMENT '关于我们',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) UNSIGNED DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `delete_status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '删除状态',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作者id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作时间',
  `delete_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cy_dot_webinfo`
--

INSERT INTO `cy_dot_webinfo` (`id`, `title`, `keywords`, `description`, `record`, `statistical`, `address`, `telephone`, `email`, `qq`, `about`, `status`, `create_uid`, `create_time`, `create_ip`, `update_uid`, `update_time`, `update_ip`, `delete_status`, `delete_uid`, `delete_time`, `delete_ip`) VALUES
(1, '贵阳丽堡广告有限公司', '贵州广告,发光字', '联系我们联系我们联系我们联系我们联系我们联系', 'fds', '', '贵州省贵阳市南明区', '123443434', 'dfasdf', 'fdasfadf', '我们是一家集设计、制作、安装、维护于一体的专业化贵阳广告公司,先后引进各种先进生产设备，用专业色彩，顶级工艺打造高质量的产品，追求百分之百的客户满意度，建立了良好的一条龙服务体系，赢得了广大客户的一致信赖和好评。我们是贵州广告平价倡导者，用规模发展降低成本，如果你问过其它家广告公司价格贵，那请来找我们，我们几乎成本价一样的报价如当初小米进入手机行业一样必将给贵州广告界带来深刻的变革，造福于广大市民。公司主营业务有：LED发光字，各类金属字制作，吸塑灯箱工程，水晶字及店铺广告招牌制作,墙体广告，高速广告，校园广告，小区及电梯广告，电视及电台广告。s', 1, 0, 0, 0, 1, 1465743382, 2130706433, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_hooks`
--

CREATE TABLE `cy_hooks` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text COMMENT '描述',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cy_hooks`
--

INSERT INTO `cy_hooks` (`id`, `name`, `description`, `type`, `update_time`, `addons`, `status`) VALUES
(1, 'pageHeader', '页面header钩子，一般用于加载插件CSS文件和代码', 1, 0, '', 1),
(2, 'pageFooter', '页面footer钩子，一般用于加载插件JS文件和JS代码', 1, 0, 'ReturnTop', 1),
(3, 'documentEditForm', '添加编辑表单的 扩展内容钩子', 1, 0, 'Attachment', 1),
(4, 'documentDetailAfter', '文档末尾显示', 1, 0, 'SocialComment,Attachment', 1),
(5, 'documentDetailBefore', '页面内容前显示用钩子', 1, 0, '', 1),
(6, 'documentSaveComplete', '保存文档数据后的扩展钩子', 2, 0, 'Attachment', 1),
(7, 'documentEditFormContent', '添加编辑表单的内容显示钩子', 1, 0, 'Editor', 1),
(8, 'adminArticleEdit', '后台内容编辑页编辑器', 1, 1378982734, 'YcEditor,EditorForAdmin', 1),
(13, 'AdminIndex', '首页小格子个性化显示', 1, 1382596073, 'SystemInfo,DevTeam,SiteStat', 1),
(14, 'topicComment', '评论提交方式扩展钩子。', 1, 1380163518, 'Editor', 1),
(16, 'app_begin', '应用开始', 2, 1384481614, '', 1),
(17, 'oauth', '第三方登录钩子', 2, 1384481614, 'Oauth', 1),
(18, 'testEditor', '这是测试编辑器', 2, 1384481614, 'YcEditor', 1);

-- --------------------------------------------------------

--
-- 表的结构 `cy_joketype`
--

CREATE TABLE `cy_joketype` (
  `typeid` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `cy_joketype`
--

INSERT INTO `cy_joketype` (`typeid`, `type`) VALUES
(1, '儿童篇'),
(2, '夫妻篇'),
(4, '医疗篇'),
(5, '爱情篇'),
(9, '家庭篇'),
(10, '政治篇'),
(11, '电脑篇'),
(12, '军事篇'),
(13, '古代篇'),
(14, '文化篇'),
(15, '艺术篇'),
(16, '经营篇'),
(17, '司法篇'),
(18, '体育篇'),
(19, '交通篇'),
(20, '宗教篇'),
(21, '鬼话篇'),
(22, '名人篇'),
(23, '校园篇'),
(24, '交往篇'),
(25, '愚人篇'),
(26, '民间篇'),
(27, '综合篇'),
(28, '顺口溜'),
(29, '动物篇'),
(30, '成人篇');

-- --------------------------------------------------------

--
-- 表的结构 `cy_manager`
--

CREATE TABLE `cy_manager` (
  `id` mediumint(11) NOT NULL COMMENT '用户id',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '用户密码',
  `hash` char(10) NOT NULL COMMENT 'hash值',
  `nickname` varchar(30) DEFAULT NULL COMMENT '用户昵称',
  `realname` varchar(30) DEFAULT NULL COMMENT '真实姓名',
  `tel` varchar(30) DEFAULT NULL COMMENT '电话号码',
  `email` varchar(60) NOT NULL COMMENT '邮箱',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `create_uid` mediumint(11) DEFAULT '0' COMMENT '创建者ip',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED DEFAULT '0' COMMENT '创建ip',
  `update_uid` mediumint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `login_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录时间',
  `login_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录ip',
  `role` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '角色',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `times` int(6) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录次数',
  `delete_status` tinyint(2) UNSIGNED DEFAULT '1' COMMENT '删除状态',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作人id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除时间',
  `delete_ip` bigint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cy_manager`
--

INSERT INTO `cy_manager` (`id`, `username`, `password`, `hash`, `nickname`, `realname`, `tel`, `email`, `avatar`, `create_uid`, `create_time`, `create_ip`, `update_uid`, `update_time`, `update_ip`, `login_time`, `login_ip`, `role`, `status`, `times`, `delete_status`, `delete_uid`, `delete_time`, `delete_ip`) VALUES
(1, 'ceroot@163.com', '299df17562c8b491896e11e88e80d399', 'yaIDbJHVTh', '超级管理员', '超级管理员', NULL, 'ceroot@163.com', NULL, 0, 0, 0, 1, 0, 2130706433, 1484638821, 2130706433, 1, 1, 97, 1, 0, 0, 0),
(2, 'manager', 'be5357794c51565765d5cdbb069f7e70', '', '', '', NULL, '', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 1, 0, 0, 0),
(3, 'ceroot', '513449a0f4420a7f8fcb3025501c2c54', '', 'ceroot', 'cerootdd', NULL, '', NULL, 0, 1463225790, 2130706433, 1, 1464496841, 2130706433, 1464496814, 2130706433, 1, 1, 10, 1, 0, 0, 0),
(4, 'cer112', 'ec5831d2b3abba02842c2c78b9977f4c', '', '', '', NULL, '', NULL, 0, 1463225829, 2130706433, 1, 1463331425, 0, 0, 0, 1, 1, 0, 1, 0, 0, 0),
(5, 'cer113', '', '', '', '', NULL, '', NULL, 0, 1463225895, 2130706433, 1, 1466264159, 2130706433, 0, 0, 1, 0, 0, 1, 0, 0, 0),
(42, '栽土木工程', '', '', '地adfda', '', NULL, '', NULL, 1, 1463616056, 2130706433, 1, 0, 2130706433, 0, 0, 1, 1, 0, 1, 0, 0, 0),
(43, 'ceroot1', '61d0836df8b65efac30db74cedc66830', '', 'fadsfas', 'fasdfa', NULL, 'ceroot@163.comchun21', NULL, 1, 1464192715, 2130706433, 1, 0, 2130706433, 1464268425, 2130706433, 1, 1, 2, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cy_model`
--

CREATE TABLE `cy_model` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '模型ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '模型标识',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '模型名称',
  `extend` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '继承的模型',
  `relation` varchar(30) NOT NULL DEFAULT '' COMMENT '继承与被继承模型的关联字段',
  `need_pk` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '新建表时是否需要主键字段',
  `field_sort` text COMMENT '表单字段排序',
  `field_group` varchar(255) NOT NULL DEFAULT '1:基础' COMMENT '字段分组',
  `attribute_list` text COMMENT '属性列表（表的字段）',
  `attribute_alias` varchar(255) NOT NULL DEFAULT '' COMMENT '属性别名定义',
  `template_list` varchar(100) NOT NULL DEFAULT '' COMMENT '列表模板',
  `template_add` varchar(100) NOT NULL DEFAULT '' COMMENT '新增模板',
  `template_edit` varchar(100) NOT NULL DEFAULT '' COMMENT '编辑模板',
  `list_grid` text COMMENT '列表定义',
  `list_row` smallint(2) UNSIGNED NOT NULL DEFAULT '10' COMMENT '列表数据长度',
  `search_key` varchar(50) NOT NULL DEFAULT '' COMMENT '默认搜索字段',
  `search_list` varchar(255) NOT NULL DEFAULT '' COMMENT '高级搜索的字段',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '状态',
  `engine_type` varchar(25) NOT NULL DEFAULT 'MyISAM' COMMENT '数据库引擎'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档模型表';

--
-- 转存表中的数据 `cy_model`
--

INSERT INTO `cy_model` (`id`, `name`, `title`, `extend`, `relation`, `need_pk`, `field_sort`, `field_group`, `attribute_list`, `attribute_alias`, `template_list`, `template_add`, `template_edit`, `list_grid`, `list_row`, `search_key`, `search_list`, `create_time`, `update_time`, `status`, `engine_type`) VALUES
(1, 'document', '基础文档', 0, '', 1, '{"1":["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22"]}', '1:基础', '', '', '', '', '', 'id:编号\ntitle:标题:[EDIT]\ntype:类型\nupdate_time:最后更新\nstatus:状态\nview:浏览\nid:操作:[EDIT]|编辑,[DELETE]|删除', 0, '', '', 1383891233, 1384507827, 1, 'MyISAM'),
(2, 'article', '文章', 1, '', 1, '{"1":["3","24","2","5"],"2":["9","13","19","10","12","16","17","26","20","14","11","25"]}', '1:基础,2:扩展', '', '', '', '', '', 'title:标题:[EDIT]\ntype:类型\nupdate_time:最后更新', 0, '', '', 1383891243, 1466851058, 1, 'MyISAM'),
(3, 'download', '下载', 1, '', 1, '{"1":["3","28","30","32","2","5","31"],"2":["13","10","9","12","16","17","19","11","20","14","29"]}', '1:基础,2:扩展', '', '', '', '', '', '', 0, '', '', 1383891252, 1466832628, 1, 'MyISAM');

-- --------------------------------------------------------

--
-- 表的结构 `cy_oauth_user`
--

CREATE TABLE `cy_oauth_user` (
  `id` int(11) NOT NULL COMMENT '表自增id',
  `uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户表id',
  `name` varchar(64) NOT NULL COMMENT '名称',
  `nick` varchar(64) NOT NULL COMMENT '昵称',
  `head_img` varchar(200) NOT NULL COMMENT '头像',
  `access_token` varchar(512) NOT NULL COMMENT '第三方token',
  `openid` varchar(64) NOT NULL COMMENT '第三方openid',
  `expires_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '第三方登录过期时间',
  `refresh_token` varchar(512) NOT NULL COMMENT '在授权自动续期步骤中，获取新的Access_Token时需要提供的参数',
  `type` varchar(20) NOT NULL COMMENT '来自第三方',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
  `times` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录次数',
  `create_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` int(11) UNSIGNED DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip',
  `delete_status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '删除状态',
  `delete_uid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作者id',
  `delete_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作时间',
  `delete_ip` bigint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='第三方登录用户表';

-- --------------------------------------------------------

--
-- 表的结构 `cy_picture`
--

CREATE TABLE `cy_picture` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '主键id自增',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cy_qin`
--

CREATE TABLE `cy_qin` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cy_qin`
--

INSERT INTO `cy_qin` (`id`, `name`) VALUES
(1, '张三'),
(2, '李四'),
(3, '');

-- --------------------------------------------------------

--
-- 表的结构 `cy_user`
--

CREATE TABLE `cy_user` (
  `uid` mediumint(11) NOT NULL COMMENT '用户id',
  `username` varchar(30) NOT NULL COMMENT '用户名称',
  `password` char(32) NOT NULL COMMENT '用户密码',
  `nickname` char(30) NOT NULL COMMENT '用户昵称',
  `realname` char(30) NOT NULL COMMENT '真实姓名',
  `email` varchar(60) NOT NULL COMMENT '邮箱',
  `create_uid` mediumint(11) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` bigint(11) NOT NULL DEFAULT '0' COMMENT '创建ip',
  `update_uid` mediumint(11) NOT NULL DEFAULT '0' COMMENT '更新者id',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_ip` bigint(11) NOT NULL DEFAULT '0' COMMENT '更新ip',
  `login_time` int(11) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `login_ip` bigint(11) NOT NULL DEFAULT '0' COMMENT '登录ip',
  `role` tinyint(2) NOT NULL DEFAULT '1' COMMENT '角色',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态，0为正常，1为禁用',
  `times` int(6) NOT NULL DEFAULT '0' COMMENT '登录次数'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cy_web_log`
--

CREATE TABLE `cy_web_log` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '日志主键',
  `uid` smallint(5) UNSIGNED NOT NULL COMMENT '用户id',
  `os` varchar(255) NOT NULL COMMENT '操作系统',
  `browser` varchar(255) NOT NULL COMMENT '浏览器',
  `url` varchar(255) NOT NULL COMMENT 'url',
  `module` char(6) NOT NULL COMMENT '模块',
  `controller` varchar(255) NOT NULL COMMENT '控制器',
  `action` varchar(255) NOT NULL DEFAULT '' COMMENT '操作方法',
  `method` varchar(10) NOT NULL DEFAULT 'GET' COMMENT '请求类型',
  `data` text NOT NULL COMMENT '请求的param数据，serialize后的',
  `create_ip` bigint(10) NOT NULL DEFAULT '0' COMMENT '操作时间ip',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '操作时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站日志';

--
-- 转存表中的数据 `cy_web_log`
--

INSERT INTO `cy_web_log` (`id`, `uid`, `os`, `browser`, `url`, `module`, `controller`, `action`, `method`, `data`, `create_ip`, `create_time`) VALUES
(1, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/manager/list.html', '', '', '', 'GET', 'a:1:{s:1:"s";s:27:"//console/manager/list.html";}', 0, 1484624949),
(2, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/getcollapsed', '', '', '', 'Ajax', 'a:1:{s:1:"s";s:28:"//console/index/getcollapsed";}', 0, 1484624949),
(3, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/manager/list.html', '', '', '', 'GET', 'a:1:{s:1:"s";s:27:"//console/manager/list.html";}', 0, 1484633850),
(4, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/manager/updatestatus/id/42.html', '', '', '', 'Ajax', 'a:1:{s:1:"s";s:41:"//console/manager/updatestatus/id/42.html";}', 0, 1484633932),
(5, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/manager/list.html', '', '', '', 'GET', 'a:1:{s:1:"s";s:27:"//console/manager/list.html";}', 0, 1484633934),
(6, 0, 'Windows 10', 'Edge(15.15007)', '/console/manager/list.html', '', '', '', 'GET', 'a:1:{s:1:"s";s:27:"//console/manager/list.html";}', 0, 1484634048),
(7, 0, 'Windows 10', 'Edge(15.15007)', '/conlogin.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fconsole%2Fmanager%2Flist.html', '', '', '', 'GET', 'a:2:{s:1:"s";s:15:"//conlogin.html";s:7:"backurl";s:45:"http://127.0.0.1:82/console/manager/list.html";}', 0, 1484634052),
(8, 0, 'Windows 10', 'Edge(15.15007)', '/captcha.html', '', '', '', 'GET', 'a:1:{s:1:"s";s:14:"//captcha.html";}', 0, 1484634053),
(9, 0, 'Windows 10', 'Edge(15.15007)', '/console/login/showverify.html', '', '', '', 'Ajax', 'a:1:{s:1:"s";s:31:"//console/login/showverify.html";}', 0, 1484634132),
(10, 0, 'Windows 10', 'Edge(15.15007)', '/conlogin.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fconsole%2Fmanager%2Flist.html', '', '', '', 'Ajax', 'a:5:{s:1:"s";s:15:"//conlogin.html";s:7:"backurl";s:45:"http://127.0.0.1:82/console/manager/list.html";s:8:"username";s:14:"ceroot@163.com";s:8:"password";s:6:"123456";s:6:"verify";s:0:"";}', 0, 1484634135),
(11, 0, 'Windows 10', 'Edge(15.15007)', '/console/manager/list.html', '', '', '', 'GET', 'a:1:{s:1:"s";s:27:"//console/manager/list.html";}', 0, 1484634135),
(12, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/manager/list.html', '', '', '', 'GET', 'a:1:{s:1:"s";s:27:"//console/manager/list.html";}', 0, 1484634323),
(13, 0, 'Windows 10', 'Edge(15.15007)', '/conlogout/2017011714221694748274750017545557690555159878590750595001525599952648597570597555453558509495169495050854515595742849694051596588554459397555.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fconsole%2Fmanager%2Flist.html', '', '', '', 'GET', 'a:2:{s:1:"s";s:159:"//conlogout/2017011714221694748274750017545557690555159878590750595001525599952648597570597555453558509495169495050854515595742849694051596588554459397555.html";s:7:"backurl";s:45:"http://127.0.0.1:82/console/manager/list.html";}', 0, 1484634358),
(14, 0, 'Windows 10', 'Edge(15.15007)', '/conlogin/1484634358.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fconsole%2Fmanager%2Flist.html', '', '', '', 'GET', 'a:2:{s:1:"s";s:26:"//conlogin/1484634358.html";s:7:"backurl";s:45:"http://127.0.0.1:82/console/manager/list.html";}', 0, 1484634359),
(15, 0, 'Windows 10', 'Edge(15.15007)', '/captcha.html', '', '', '', 'GET', 'a:1:{s:1:"s";s:14:"//captcha.html";}', 0, 1484634359),
(16, 0, 'Windows 10', 'Edge(15.15007)', '/console/login/showverify.html', '', '', '', 'Ajax', 'a:1:{s:1:"s";s:31:"//console/login/showverify.html";}', 0, 1484634364),
(17, 0, 'Windows 10', 'Edge(15.15007)', '/console/login/showverify.html', '', '', '', 'Ajax', 'a:1:{s:1:"s";s:31:"//console/login/showverify.html";}', 0, 1484634511),
(18, 0, 'Windows 10', 'Edge(15.15007)', '/console/login/showverify.html', '', '', '', 'Ajax', 'a:1:{s:1:"s";s:31:"//console/login/showverify.html";}', 0, 1484634512),
(19, 0, 'Windows 10', 'Edge(15.15007)', '/conlogin/1484634358.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fconsole%2Fmanager%2Flist.html', '', '', '', 'Ajax', 'a:5:{s:1:"s";s:26:"//conlogin/1484634358.html";s:7:"backurl";s:45:"http://127.0.0.1:82/console/manager/list.html";s:8:"username";s:14:"ceroot@163.com";s:8:"password";s:7:"fdsdfds";s:6:"verify";s:0:"";}', 0, 1484634513),
(20, 0, 'Windows 10', 'Edge(15.15007)', '/console/login/showverify.html', '', '', '', 'Ajax', 'a:1:{s:1:"s";s:31:"//console/login/showverify.html";}', 0, 1484634545),
(21, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/manager/list.html', '', '', '', 'GET', 'a:1:{s:1:"s";s:27:"//console/manager/list.html";}', 0, 1484634569),
(22, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/yctest', '', '', '', 'GET', 'a:1:{s:1:"s";s:22:"//console/index/yctest";}', 0, 1484634825),
(23, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/yctest', '', '', '', 'GET', 'a:1:{s:1:"s";s:22:"//console/index/yctest";}', 0, 1484634866),
(24, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/yctest', '', '', '', 'GET', 'a:1:{s:1:"s";s:22:"//console/index/yctest";}', 0, 1484635023),
(25, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484635987),
(26, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636004),
(27, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636105),
(28, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636276),
(29, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636276),
(30, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636280),
(31, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636280),
(32, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636293),
(33, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636297),
(34, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636313),
(35, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636701),
(36, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636701),
(37, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636702),
(38, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636702),
(39, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636702),
(40, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636703),
(41, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636704),
(42, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636704),
(43, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636704),
(44, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636704),
(45, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 0, 1484636704),
(46, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 2130706433, 1484636883),
(47, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 2130706433, 1484636984),
(48, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/Console/index/yctest', 'consol', 'Index', 'yctest', 'GET', 'a:0:{}', 2130706433, 1484637194),
(49, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogout/2017011710414390121259505854056955015065300008989055150555950143534999593588990820529251542740598198951568060579386956213584001367891582401594.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075', 'consol', 'Login', 'logout', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:142:"2017011710414390121259505854056955015065300008989055150555950143534999593588990820529251542740598198951568060579386956213584001367891582401594";}', 2130706433, 1484637214),
(50, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637214.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:10:"1484637214";}', 2130706433, 1484637218),
(51, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637214.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:10:"1484637214";}', 2130706433, 1484637257),
(52, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637214.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:10:"1484637214";}', 2130706433, 1484637258),
(53, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637214.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:10:"1484637214";}', 2130706433, 1484637258),
(54, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484637259),
(55, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484637273),
(56, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637214.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:10:"1484637214";}', 2130706433, 1484637274),
(57, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637214.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:10:"1484637214";}', 2130706433, 1484637274),
(58, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484637277),
(59, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484637365),
(60, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637214.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:10:"1484637214";}', 2130706433, 1484637365),
(61, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484637367),
(62, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637214.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:10:"1484637214";}', 2130706433, 1484637369),
(63, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484637371),
(64, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484637386),
(65, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637214.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'Ajax', 'a:5:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:8:"username";s:14:"ceroot@163.com";s:8:"password";s:6:"123456";s:6:"verify";s:0:"";s:4:"time";s:10:"1484637214";}', 2130706433, 1484637386),
(66, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Index', 'index', 'GET', 'a:1:{s:4:"time";s:142:"2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592";}', 2130706433, 1484637386),
(67, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogout/2017011715173244404155954999955505990059555445090615050819999950856595851095890509005455950984944550008404990554008549518848041785054610404614.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075', 'consol', 'Login', 'logout', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:142:"2017011715173244404155954999955505990059555445090615050819999950856595851095890509005455950984944550008404990554008549518848041785054610404614";}', 2130706433, 1484637464),
(68, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637464.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:10:"1484637464";}', 2130706433, 1484637465),
(69, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484637471),
(70, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637464.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'Ajax', 'a:5:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:8:"username";s:14:"ceroot@163.com";s:8:"password";s:6:"123456";s:6:"verify";s:0:"";s:4:"time";s:10:"1484637464";}', 2130706433, 1484637471),
(71, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Index', 'index', 'GET', 'a:1:{s:4:"time";s:142:"2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592";}', 2130706433, 1484637471),
(72, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogout/2017011715175152151505525485322051257500549555559509711205095175950004290025920155105849384092551555100009018252801532919550585103145059901515.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075', 'consol', 'Login', 'logout', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:142:"2017011715175152151505525485322051257500549555559509711205095175950004290025920155105849384092551555100009018252801532919550585103145059901515";}', 2130706433, 1484637475),
(73, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637475.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:10:"1484637475";}', 2130706433, 1484637476),
(74, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637475.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'Ajax', 'a:5:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:8:"username";s:14:"ceroot@163.com";s:8:"password";s:6:"123456";s:6:"verify";s:0:"";s:4:"time";s:10:"1484637475";}', 2130706433, 1484637480),
(75, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Index', 'index', 'GET', 'a:1:{s:4:"time";s:142:"2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592";}', 2130706433, 1484637480),
(76, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogout/2017011715180050552951245995515595575109719599105552558988258707141205015157755019042280585795555774510075501575759157505754775550005441100158.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075', 'consol', 'Login', 'logout', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:142:"2017011715180050552951245995515595575109719599105552558988258707141205015157755019042280585795555774510075501575759157505754775550005441100158";}', 2130706433, 1484637484),
(77, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637484.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:10:"1484637484";}', 2130706433, 1484637486),
(78, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484637489),
(79, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637484.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'Ajax', 'a:5:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:8:"username";s:14:"ceroot@163.com";s:8:"password";s:6:"123456";s:6:"verify";s:0:"";s:4:"time";s:10:"1484637484";}', 2130706433, 1484637490),
(80, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Index', 'index', 'GET', 'a:1:{s:4:"time";s:142:"2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592";}', 2130706433, 1484637490),
(81, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogout/2017011715183261710001526590610010100051561109101955707205025120115102105907015750004050646005505555155555845050059041155071457057505550190106.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075', 'consol', 'Login', 'logout', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:142:"2017011715183261710001526590610010100051561109101955707205025120115102105907015750004050646005505555155555845050059041155071457057505550190106";}', 2130706433, 1484637519),
(82, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637519.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:4:"time";s:10:"1484637519";}', 2130706433, 1484637520),
(83, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484637519.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fcon%2F2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Login', 'index', 'Ajax', 'a:5:{s:7:"backurl";s:171:"http://127.0.0.1:82/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html";s:8:"username";s:14:"ceroot@163.com";s:8:"password";s:6:"123456";s:6:"verify";s:0:"";s:4:"time";s:10:"1484637519";}', 2130706433, 1484637523),
(84, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Index', 'index', 'GET', 'a:1:{s:4:"time";s:142:"2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592";}', 2130706433, 1484637523),
(85, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/con/2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592.html', 'consol', 'Index', 'index', 'GET', 'a:1:{s:4:"time";s:142:"2017011617205117955149917759559594995555925575715075525095954491157011521555842751905159707083715558951897858900879115175575030504009129785592";}', 2130706433, 1484638696),
(86, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/index.html', 'consol', 'Cache', 'index', 'GET', 'a:0:{}', 2130706433, 1484638724),
(87, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/backup.html', 'consol', 'Cache', 'backup', 'GET', 'a:0:{}', 2130706433, 1484638727),
(88, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/index.html', 'consol', 'Cache', 'index', 'GET', 'a:0:{}', 2130706433, 1484638729),
(89, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogout/2017011715384943599525710156515000588901918001885586535905500250119150018950805014596505115155911585804495202225805055882150819550511199994209.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fconsole%2Fcache%2Findex.html', 'consol', 'Login', 'logout', 'GET', 'a:2:{s:7:"backurl";s:44:"http://127.0.0.1:82/console/cache/index.html";s:4:"time";s:142:"2017011715384943599525710156515000588901918001885586535905500250119150018950805014596505115155911585804495202225805055882150819550511199994209";}', 2130706433, 1484638783),
(90, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484638784.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fconsole%2Fcache%2Findex.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:44:"http://127.0.0.1:82/console/cache/index.html";s:4:"time";s:10:"1484638784";}', 2130706433, 1484638785),
(91, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484638788),
(92, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484638784.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fconsole%2Fcache%2Findex.html', 'consol', 'Login', 'index', 'GET', 'a:2:{s:7:"backurl";s:44:"http://127.0.0.1:82/console/cache/index.html";s:4:"time";s:10:"1484638784";}', 2130706433, 1484638797),
(93, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484638799),
(94, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484638821),
(95, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/conlogin/1484638784.html?backurl=http%3A%2F%2F127.0.0.1%3A82%2Fconsole%2Fcache%2Findex.html', 'consol', 'Login', 'index', 'Ajax', 'a:5:{s:7:"backurl";s:44:"http://127.0.0.1:82/console/cache/index.html";s:8:"username";s:14:"ceroot@163.com";s:8:"password";s:6:"123456";s:6:"verify";s:0:"";s:4:"time";s:10:"1484638784";}', 2130706433, 1484638821),
(96, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/index.html', 'consol', 'Cache', 'index', 'GET', 'a:0:{}', 2130706433, 1484638821),
(97, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/manager/index.html', 'consol', 'Manager', 'index', 'GET', 'a:0:{}', 2130706433, 1484638988),
(98, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/index.html', 'consol', 'AuthRule', 'index', 'GET', 'a:0:{}', 2130706433, 1484638990),
(99, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484638992),
(100, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484639192),
(101, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484639213),
(102, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484639366),
(103, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484639431),
(104, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/index.html', 'consol', 'AuthRule', 'index', 'GET', 'a:0:{}', 2130706433, 1484639443),
(105, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484639444),
(106, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484639448),
(107, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484639450),
(108, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484639456),
(109, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484639459),
(110, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484639592),
(111, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484639613),
(112, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484639624),
(113, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/edit/id/2.html', 'consol', 'AuthRule', 'edit', 'GET', 'a:1:{s:2:"id";s:1:"2";}', 2130706433, 1484639627),
(114, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484639629),
(115, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484639654),
(116, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484639684),
(117, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484639717),
(118, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484639719),
(119, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/edit/id/2.html', 'consol', 'AuthRule', 'edit', 'GET', 'a:1:{s:2:"id";s:1:"2";}', 2130706433, 1484639722),
(120, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484639734),
(121, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484639804),
(122, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484639809),
(123, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484639862),
(124, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484639873),
(125, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484639874),
(126, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484639875),
(127, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484639909),
(128, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484639911),
(129, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484639984),
(130, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484640025),
(131, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484640039),
(132, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484640047),
(133, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/4.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"4";}', 2130706433, 1484640093),
(134, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484640104),
(135, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/7.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"7";}', 2130706433, 1484640107),
(136, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484640113),
(137, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640117),
(138, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640157),
(139, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640167),
(140, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640170),
(141, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640171),
(142, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640171),
(143, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640171),
(144, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640172),
(145, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640172),
(146, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640189),
(147, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640190),
(148, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640190),
(149, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640249),
(150, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640257),
(151, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640262),
(152, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640358),
(153, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/1.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"1";}', 2130706433, 1484640364),
(154, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484640377),
(155, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484640407),
(156, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/edit/id/3.html', 'consol', 'AuthRule', 'edit', 'GET', 'a:1:{s:2:"id";s:1:"3";}', 2130706433, 1484640409),
(157, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484640422),
(158, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:1:"8";s:4:"name";s:7:"web_log";s:5:"title";s:12:"网站日志";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"0";s:10:"controller";s:1:"1";s:13:"instantiation";s:1:"1";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:0:"";}', 2130706433, 1484640470),
(159, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484640488),
(160, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/index.html', 'consol', 'AuthRule', 'index', 'GET', 'a:0:{}', 2130706433, 1484640490),
(161, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action/index.html', 'consol', 'Action', 'index', 'GET', 'a:0:{}', 2130706433, 1484640498),
(162, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action/list.html', 'consol', 'Action', 'list', 'GET', 'a:0:{}', 2130706433, 1484640500),
(163, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action/add.html', 'consol', 'Action', 'add', 'GET', 'a:0:{}', 2130706433, 1484640596),
(164, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action_log/list.html', 'consol', 'ActionLog', 'list', 'GET', 'a:0:{}', 2130706433, 1484640597),
(165, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action/add.html', 'consol', 'Action', 'add', 'GET', 'a:0:{}', 2130706433, 1484640597),
(166, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action_log/list.html', 'consol', 'ActionLog', 'list', 'GET', 'a:0:{}', 2130706433, 1484640599),
(167, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action/add.html', 'consol', 'Action', 'add', 'GET', 'a:0:{}', 2130706433, 1484640599),
(168, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action/add.html', 'consol', 'Action', 'add', 'GET', 'a:0:{}', 2130706433, 1484640600),
(169, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action_log/list.html', 'consol', 'ActionLog', 'list', 'GET', 'a:0:{}', 2130706433, 1484640601),
(170, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action/add.html', 'consol', 'Action', 'add', 'GET', 'a:0:{}', 2130706433, 1484640601),
(171, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action/add.html', 'consol', 'Action', 'add', 'GET', 'a:0:{}', 2130706433, 1484640602),
(172, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action/add.html', 'consol', 'Action', 'add', 'GET', 'a:0:{}', 2130706433, 1484640602),
(173, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_group/index.html', 'consol', 'AuthGroup', 'index', 'GET', 'a:0:{}', 2130706433, 1484640605),
(174, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_group/list.html', 'consol', 'AuthGroup', 'list', 'GET', 'a:0:{}', 2130706433, 1484640606),
(175, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/index.html', 'consol', 'AuthRule', 'index', 'GET', 'a:0:{}', 2130706433, 1484640746),
(176, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484640748),
(177, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484640894),
(178, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/edit/id/279.html', 'consol', 'AuthRule', 'edit', 'GET', 'a:1:{s:2:"id";s:3:"279";}', 2130706433, 1484640909),
(179, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484640991),
(180, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484640993),
(181, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/7.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"7";}', 2130706433, 1484641003),
(182, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/7.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"7";}', 2130706433, 1484641107),
(183, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/7.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"7";}', 2130706433, 1484641167),
(184, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/7.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"7";}', 2130706433, 1484641170),
(185, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/iddd/7.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:4:"iddd";s:1:"7";}', 2130706433, 1484641183),
(186, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/7.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"7";}', 2130706433, 1484641243),
(187, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484641246),
(188, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/7.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"7";}', 2130706433, 1484641249),
(189, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484641265),
(190, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641267),
(191, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641411),
(192, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641423),
(193, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641434),
(194, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641443),
(195, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641466),
(196, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641486),
(197, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641526),
(198, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641544),
(199, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641545),
(200, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641546),
(201, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641554),
(202, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/5.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"5";}', 2130706433, 1484641574),
(203, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484641587),
(204, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484641602),
(205, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484641603),
(206, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/8.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"8";}', 2130706433, 1484641613),
(207, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/8.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"8";}', 2130706433, 1484641681),
(208, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:1:"8";s:4:"name";s:7:"web_log";s:5:"title";s:21:"网站日志控制器";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"0";s:10:"controller";s:1:"1";s:13:"instantiation";s:1:"1";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:0:"";}', 2130706433, 1484641712),
(209, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/8.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"8";}', 2130706433, 1484641813),
(210, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:1:"8";s:4:"name";s:0:"";s:5:"title";s:0:"";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"1";s:10:"controller";s:1:"0";s:13:"instantiation";s:1:"0";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:0:"";}', 2130706433, 1484641818),
(211, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/8.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"8";}', 2130706433, 1484641857),
(212, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:1:"8";s:4:"name";s:0:"";s:5:"title";s:0:"";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"1";s:10:"controller";s:1:"0";s:13:"instantiation";s:1:"0";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:0:"";}', 2130706433, 1484641858),
(213, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:1:"8";s:4:"name";s:7:"fdsffds";s:5:"title";s:0:"";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"1";s:10:"controller";s:1:"0";s:13:"instantiation";s:1:"0";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:0:"";}', 2130706433, 1484641867),
(214, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/8.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:1:"8";}', 2130706433, 1484641922),
(215, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:1:"8";s:4:"name";s:7:"web_log";s:5:"title";s:21:"网站日志控制器";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"0";s:10:"controller";s:1:"1";s:13:"instantiation";s:1:"1";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:0:"";}', 2130706433, 1484641943),
(216, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484641944),
(217, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484641991),
(218, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action/index.html', 'consol', 'Action', 'index', 'GET', 'a:0:{}', 2130706433, 1484642066),
(219, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action/list.html', 'consol', 'Action', 'list', 'GET', 'a:0:{}', 2130706433, 1484642068),
(220, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action_log/list.html', 'consol', 'ActionLog', 'list', 'GET', 'a:0:{}', 2130706433, 1484642086),
(221, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action_log/list.html', 'consol', 'ActionLog', 'list', 'GET', 'a:0:{}', 2130706433, 1484642104),
(222, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/action_log/list.html', 'consol', 'ActionLog', 'list', 'GET', 'a:0:{}', 2130706433, 1484642105),
(223, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/index.html', 'consol', 'Cache', 'index', 'GET', 'a:0:{}', 2130706433, 1484642210);
INSERT INTO `cy_web_log` (`id`, `uid`, `os`, `browser`, `url`, `module`, `controller`, `action`, `method`, `data`, `create_ip`, `create_time`) VALUES
(224, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/cache.html', 'consol', 'Cache', 'cache', 'GET', 'a:0:{}', 2130706433, 1484642211),
(225, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/cache.html', 'consol', 'Cache', 'cache', 'Ajax', 'a:1:{s:6:"action";a:7:{i:0;s:6:"Config";i:1;s:8:"Category";i:2;s:5:"Table";i:3;s:4:"rule";i:4;s:10:"sdk_config";i:5;s:5:"other";i:6;s:3:"end";}}', 2130706433, 1484642214),
(226, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/cache.html', 'consol', 'Cache', 'cache', 'Ajax', 'a:1:{s:6:"action";a:7:{i:0;s:6:"Config";i:1;s:8:"Category";i:2;s:5:"Table";i:3;s:4:"rule";i:4;s:10:"sdk_config";i:5;s:5:"other";i:6;s:3:"end";}}', 2130706433, 1484642215),
(227, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/cache.html', 'consol', 'Cache', 'cache', 'Ajax', 'a:1:{s:6:"action";a:7:{i:0;s:6:"Config";i:1;s:8:"Category";i:2;s:5:"Table";i:3;s:4:"rule";i:4;s:10:"sdk_config";i:5;s:5:"other";i:6;s:3:"end";}}', 2130706433, 1484642215),
(228, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/cache.html', 'consol', 'Cache', 'cache', 'Ajax', 'a:1:{s:6:"action";a:7:{i:0;s:6:"Config";i:1;s:8:"Category";i:2;s:5:"Table";i:3;s:4:"rule";i:4;s:10:"sdk_config";i:5;s:5:"other";i:6;s:3:"end";}}', 2130706433, 1484642215),
(229, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/cache.html', 'consol', 'Cache', 'cache', 'Ajax', 'a:1:{s:6:"action";a:7:{i:0;s:6:"Config";i:1;s:8:"Category";i:2;s:5:"Table";i:3;s:4:"rule";i:4;s:10:"sdk_config";i:5;s:5:"other";i:6;s:3:"end";}}', 2130706433, 1484642215),
(230, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/cache.html', 'consol', 'Cache', 'cache', 'Ajax', 'a:1:{s:6:"action";a:7:{i:0;s:6:"Config";i:1;s:8:"Category";i:2;s:5:"Table";i:3;s:4:"rule";i:4;s:10:"sdk_config";i:5;s:5:"other";i:6;s:3:"end";}}', 2130706433, 1484642216),
(231, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/cache/cache.html', 'consol', 'Cache', 'cache', 'Ajax', 'a:1:{s:6:"action";a:7:{i:0;s:6:"Config";i:1;s:8:"Category";i:2;s:5:"Table";i:3;s:4:"rule";i:4;s:10:"sdk_config";i:5;s:5:"other";i:6;s:3:"end";}}', 2130706433, 1484642216),
(232, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/index.html', 'consol', 'AuthRule', 'index', 'GET', 'a:0:{}', 2130706433, 1484642224),
(233, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642225),
(234, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484642376),
(235, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/getcollapsed', 'consol', 'Index', 'getcollapsed', 'Ajax', 'a:0:{}', 2130706433, 1484642377),
(236, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/setcollapsed', 'consol', 'Index', 'setcollapsed', 'Ajax', 'a:1:{s:9:"collapsed";s:1:"1";}', 2130706433, 1484642377),
(237, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484642387),
(238, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484642502),
(239, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642504),
(240, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/300.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:3:"300";}', 2130706433, 1484642509),
(241, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642517),
(242, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/edit/id/300.html', 'consol', 'AuthRule', 'edit', 'GET', 'a:1:{s:2:"id";s:3:"300";}', 2130706433, 1484642540),
(243, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642545),
(244, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642579),
(245, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642581),
(246, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484642582),
(247, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484642595),
(248, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add.html', 'consol', 'AuthRule', 'add', 'GET', 'a:0:{}', 2130706433, 1484642599),
(249, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642601),
(250, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/edit/id/300.html', 'consol', 'AuthRule', 'edit', 'GET', 'a:1:{s:2:"id";s:3:"300";}', 2130706433, 1484642606),
(251, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:1:"8";s:4:"name";s:6:"WebLog";s:5:"title";s:21:"网站日志控制器";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"0";s:10:"controller";s:1:"1";s:13:"instantiation";s:1:"1";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:3:"300";}', 2130706433, 1484642613),
(252, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642614),
(253, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/300.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:3:"300";}', 2130706433, 1484642625),
(254, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:3:"300";s:4:"name";s:12:"WebLog/index";s:5:"title";s:18:"网站日志首页";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"1";s:10:"controller";s:1:"0";s:13:"instantiation";s:1:"0";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:0:"";}', 2130706433, 1484642667),
(255, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642668),
(256, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/edit/id/301.html', 'consol', 'AuthRule', 'edit', 'GET', 'a:1:{s:2:"id";s:3:"301";}', 2130706433, 1484642680),
(257, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:1:"8";s:4:"name";s:12:"WebLog/index";s:5:"title";s:18:"网站日志首页";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"1";s:10:"controller";s:1:"0";s:13:"instantiation";s:1:"0";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:3:"301";}', 2130706433, 1484642688),
(258, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642689),
(259, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/edit/id/300.html', 'consol', 'AuthRule', 'edit', 'GET', 'a:1:{s:2:"id";s:3:"300";}', 2130706433, 1484642696),
(260, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:3:"301";s:4:"name";s:6:"WebLog";s:5:"title";s:21:"网站日志控制器";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"0";s:10:"controller";s:1:"1";s:13:"instantiation";s:1:"1";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:3:"300";}', 2130706433, 1484642702),
(261, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642703),
(262, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/edit/id/301.html', 'consol', 'AuthRule', 'edit', 'GET', 'a:1:{s:2:"id";s:3:"301";}', 2130706433, 1484642710),
(263, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:1:"8";s:4:"name";s:12:"WebLog/index";s:5:"title";s:18:"网站日志管理";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"1";s:10:"controller";s:1:"0";s:13:"instantiation";s:1:"0";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:3:"301";}', 2130706433, 1484642716),
(264, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642717),
(265, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/add/id/301.html', 'consol', 'AuthRule', 'add', 'GET', 'a:1:{s:2:"id";s:3:"301";}', 2130706433, 1484642736),
(266, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:3:"301";s:4:"name";s:11:"WebLog/list";s:5:"title";s:18:"网站日志列表";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"1";s:10:"controller";s:1:"0";s:13:"instantiation";s:1:"0";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:0:"";}', 2130706433, 1484642757),
(267, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642758),
(268, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/system.html', 'consol', 'AuthRule', 'system', 'GET', 'a:0:{}', 2130706433, 1484642763),
(269, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/list.html', 'consol', 'AuthRule', 'list', 'GET', 'a:0:{}', 2130706433, 1484642765),
(270, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:14:{s:3:"pid";s:3:"301";s:4:"name";s:10:"WebLog/set";s:5:"title";s:18:"网站日志设置";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"1";s:10:"controller";s:1:"0";s:13:"instantiation";s:1:"0";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:4:"_log";s:1:"1";s:2:"id";s:0:"";}', 2130706433, 1484643769),
(271, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/auth_rule/update.html', 'consol', 'AuthRule', 'update', 'Ajax', 'a:13:{s:3:"pid";s:3:"301";s:4:"name";s:10:"WebLog/set";s:5:"title";s:18:"网站日志设置";s:4:"icon";s:0:"";s:6:"status";s:1:"1";s:9:"isnavshow";s:1:"1";s:10:"controller";s:1:"0";s:13:"instantiation";s:1:"0";s:4:"auth";s:1:"1";s:4:"sort";s:3:"100";s:3:"url";s:0:"";s:9:"condition";s:0:"";s:2:"id";s:0:"";}', 2130706433, 1484643817),
(272, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/setcollapsed', 'consol', 'Index', 'setcollapsed', 'Ajax', 'a:1:{s:9:"collapsed";s:1:"0";}', 2130706433, 1484647139),
(273, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/setcollapsed', 'consol', 'Index', 'setcollapsed', 'Ajax', 'a:1:{s:9:"collapsed";s:1:"1";}', 2130706433, 1484647139),
(274, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/index/setcollapsed', 'consol', 'Index', 'setcollapsed', 'Ajax', 'a:1:{s:9:"collapsed";s:1:"0";}', 2130706433, 1484647141),
(275, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484647846),
(276, 1, 'Windows 10', 'Chrome(56.0.2918.1)', '/console/login/showverify.html', 'consol', 'Login', 'showverify', 'Ajax', 'a:0:{}', 2130706433, 1484647874);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cy_action`
--
ALTER TABLE `cy_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_action_log`
--
ALTER TABLE `cy_action_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_ip_ix` (`action_ip`),
  ADD KEY `action_id_ix` (`action_id`),
  ADD KEY `user_id_ix` (`user_id`);

--
-- Indexes for table `cy_addons`
--
ALTER TABLE `cy_addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_article`
--
ALTER TABLE `cy_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_attribute`
--
ALTER TABLE `cy_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `model_id` (`model_id`);

--
-- Indexes for table `cy_attribute_user_list`
--
ALTER TABLE `cy_attribute_user_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_auth_group`
--
ALTER TABLE `cy_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_auth_group_access`
--
ALTER TABLE `cy_auth_group_access`
  ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `cy_auth_rule`
--
ALTER TABLE `cy_auth_rule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `cy_category`
--
ALTER TABLE `cy_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_name` (`name`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `cy_category_back`
--
ALTER TABLE `cy_category_back`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_config`
--
ALTER TABLE `cy_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_name` (`name`),
  ADD KEY `type` (`type`),
  ADD KEY `group` (`group`);

--
-- Indexes for table `cy_developer`
--
ALTER TABLE `cy_developer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_document`
--
ALTER TABLE `cy_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category_status` (`category_id`,`status`),
  ADD KEY `idx_status_type_pid` (`status`,`uid`,`pid`);

--
-- Indexes for table `cy_document_article`
--
ALTER TABLE `cy_document_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_dot_article`
--
ALTER TABLE `cy_dot_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_dot_cases`
--
ALTER TABLE `cy_dot_cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_dot_category`
--
ALTER TABLE `cy_dot_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_dot_menu`
--
ALTER TABLE `cy_dot_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_dot_slide`
--
ALTER TABLE `cy_dot_slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_dot_webinfo`
--
ALTER TABLE `cy_dot_webinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_hooks`
--
ALTER TABLE `cy_hooks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `cy_manager`
--
ALTER TABLE `cy_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_model`
--
ALTER TABLE `cy_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_oauth_user`
--
ALTER TABLE `cy_oauth_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_picture`
--
ALTER TABLE `cy_picture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_qin`
--
ALTER TABLE `cy_qin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cy_user`
--
ALTER TABLE `cy_user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `cy_web_log`
--
ALTER TABLE `cy_web_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `otime` (`create_time`),
  ADD KEY `module` (`module`),
  ADD KEY `controller` (`controller`),
  ADD KEY `method` (`method`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cy_action`
--
ALTER TABLE `cy_action`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=59;
--
-- 使用表AUTO_INCREMENT `cy_action_log`
--
ALTER TABLE `cy_action_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=58;
--
-- 使用表AUTO_INCREMENT `cy_addons`
--
ALTER TABLE `cy_addons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=77;
--
-- 使用表AUTO_INCREMENT `cy_article`
--
ALTER TABLE `cy_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id';
--
-- 使用表AUTO_INCREMENT `cy_attribute`
--
ALTER TABLE `cy_attribute`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- 使用表AUTO_INCREMENT `cy_attribute_user_list`
--
ALTER TABLE `cy_attribute_user_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表自增id', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cy_auth_group`
--
ALTER TABLE `cy_auth_group`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- 使用表AUTO_INCREMENT `cy_auth_rule`
--
ALTER TABLE `cy_auth_rule`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;
--
-- 使用表AUTO_INCREMENT `cy_category`
--
ALTER TABLE `cy_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '分类ID', AUTO_INCREMENT=40;
--
-- 使用表AUTO_INCREMENT `cy_category_back`
--
ALTER TABLE `cy_category_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `cy_config`
--
ALTER TABLE `cy_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID', AUTO_INCREMENT=41;
--
-- 使用表AUTO_INCREMENT `cy_developer`
--
ALTER TABLE `cy_developer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `cy_document`
--
ALTER TABLE `cy_document`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '文档ID', AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `cy_dot_article`
--
ALTER TABLE `cy_dot_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=66;
--
-- 使用表AUTO_INCREMENT `cy_dot_cases`
--
ALTER TABLE `cy_dot_cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `cy_dot_category`
--
ALTER TABLE `cy_dot_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `cy_dot_menu`
--
ALTER TABLE `cy_dot_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `cy_dot_slide`
--
ALTER TABLE `cy_dot_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id';
--
-- 使用表AUTO_INCREMENT `cy_dot_webinfo`
--
ALTER TABLE `cy_dot_webinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cy_hooks`
--
ALTER TABLE `cy_hooks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=19;
--
-- 使用表AUTO_INCREMENT `cy_manager`
--
ALTER TABLE `cy_manager`
  MODIFY `id` mediumint(11) NOT NULL AUTO_INCREMENT COMMENT '用户id', AUTO_INCREMENT=44;
--
-- 使用表AUTO_INCREMENT `cy_model`
--
ALTER TABLE `cy_model`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '模型ID', AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `cy_oauth_user`
--
ALTER TABLE `cy_oauth_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表自增id';
--
-- 使用表AUTO_INCREMENT `cy_picture`
--
ALTER TABLE `cy_picture`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id自增';
--
-- 使用表AUTO_INCREMENT `cy_qin`
--
ALTER TABLE `cy_qin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `cy_user`
--
ALTER TABLE `cy_user`
  MODIFY `uid` mediumint(11) NOT NULL AUTO_INCREMENT COMMENT '用户id';
--
-- 使用表AUTO_INCREMENT `cy_web_log`
--
ALTER TABLE `cy_web_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '日志主键', AUTO_INCREMENT=277;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
