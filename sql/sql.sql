

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wy_account_log
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '42亿',
	`is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示255',
	`cate_id` smallint(5) unsigned NOT NULL COMMENT '商品分类id 6万',
	`log_id` mediumint(8) unsigned NOT NULL COMMENT '日志id 1600万',
	`user_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '用户金额',
	`frozen_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '冻结金额',
	`descrip` varchar(255) NOT NULL COMMENT '描述',
	`mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '联系手机',
	`order_sn` varchar(50) DEFAULT NULL COMMENT '订单编号',
	`create_time` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
	`updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后修改时间',
	PRIMARY KEY (`id`),
	KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT 'test';

INSERT INTO `test` VALUES ('1', '5', '1100000.00', '0.00', '0', '1242140736', '', null, null);
ALTER TABLE `test` ADD COLUMN `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '' AFTER `id`;
