ALTER TABLE `cy_developer` 
ADD `status` TINYINT(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态，1为正常，0为禁用' AFTER `content`, 
ADD `create_uid` INT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建者id' AFTER `status`, 
ADD `create_time` INT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间' AFTER `create_uid`, 
ADD `create_ip` BIGINT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建ip' AFTER `create_time`, 
ADD `update_uid` INT(11) UNSIGNED NULL DEFAULT '0' COMMENT '更新者id' AFTER `create_ip`, 
ADD `update_time` INT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间' AFTER `update_uid`, 
ADD `update_ip` BIGINT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新ip' AFTER `update_time`, 
ADD `delete_status` TINYINT(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '删除状态' AFTER `update_ip`, 
ADD `delete_uid` INT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作者id' AFTER `delete_status`, 
ADD `delete_time` INT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作时间' AFTER `delete_uid`, 
ADD `delete_ip` BIGINT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '删除操作ip' AFTER `delete_time`;