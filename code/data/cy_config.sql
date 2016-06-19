-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-06-19 15:02:19
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
-- 表的结构 `cy_config`
--

CREATE TABLE IF NOT EXISTS `cy_config` (
  `id` int(10) unsigned NOT NULL COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '配置说明',
  `value` text COMMENT '配置值',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间'
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cy_config`
--
ALTER TABLE `cy_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_name` (`name`),
  ADD KEY `type` (`type`),
  ADD KEY `group` (`group`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cy_config`
--
ALTER TABLE `cy_config`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
