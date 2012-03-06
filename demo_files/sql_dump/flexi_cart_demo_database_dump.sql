/*
Navicat MySQL Data Transfer

Source Server         :  Localhost
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : flexi_cart_demo

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2012-01-05 16:38:33
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cart_config`
-- ----------------------------
DROP TABLE IF EXISTS `cart_config`;
CREATE TABLE `cart_config` (
  `config_id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `config_order_number_prefix` varchar(50) NOT NULL,
  `config_order_number_suffix` varchar(50) NOT NULL,
  `config_increment_order_number` tinyint(1) NOT NULL,
  `config_min_order` smallint(5) NOT NULL,
  `config_quantity_decimals` tinyint(1) NOT NULL,
  `config_increment_duplicate_items` tinyint(1) NOT NULL,
  `config_quantity_limited_by_stock` tinyint(1) NOT NULL,
  `config_remove_no_stock_items` tinyint(1) NOT NULL,
  `config_auto_allocate_stock` tinyint(1) NOT NULL,
  `config_save_ban_shipping_items` tinyint(1) NOT NULL,
  `config_weight_type` varchar(25) NOT NULL,
  `config_weight_decimals` tinyint(1) NOT NULL,
  `config_display_tax_prices` tinyint(1) NOT NULL,
  `config_price_inc_tax` tinyint(1) NOT NULL,
  `config_multi_row_duplicate_items` tinyint(1) NOT NULL,
  `config_dynamic_reward_points` tinyint(1) NOT NULL,
  `config_reward_point_multiplier` double(8,4) NOT NULL,
  `config_reward_voucher_multiplier` double(8,4) NOT NULL,
  `config_reward_voucher_ratio` smallint(5) NOT NULL,
  `config_reward_point_days_pending` smallint(5) NOT NULL,
  `config_reward_point_days_valid` smallint(5) NOT NULL,
  `config_reward_voucher_days_valid` smallint(5) NOT NULL,
  `config_custom_status_1` varchar(50) NOT NULL,
  `config_custom_status_2` varchar(50) NOT NULL,
  `config_custom_status_3` varchar(50) NOT NULL,
  PRIMARY KEY (`config_id`),
  KEY `config_id` (`config_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cart_config
-- ----------------------------
INSERT INTO `cart_config` VALUES ('1', '', '', '1', '0', '0', '1', '1', '0', '1', '0', 'gram', '0', '1', '1', '0', '1', '10.0000', '0.0100', '250', '14', '365', '365', '', '', '');

-- ----------------------------
-- Table structure for `cart_data`
-- ----------------------------
DROP TABLE IF EXISTS `cart_data`;
CREATE TABLE `cart_data` (
  `cart_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_data_user_fk` int(11) NOT NULL,
  `cart_data_array` text NOT NULL,
  `cart_data_date` datetime NOT NULL,
  `cart_data_readonly_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`cart_data_id`),
  UNIQUE KEY `cart_data_id` (`cart_data_id`) USING BTREE,
  KEY `cart_data_user_fk` (`cart_data_user_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cart_data
-- ----------------------------
INSERT INTO `cart_data` VALUES ('1', '1', 'a:3:{s:5:\"items\";a:2:{s:32:\"38b3eff8baf56627478ec76a704e9b52\";a:15:{s:6:\"row_id\";s:32:\"38b3eff8baf56627478ec76a704e9b52\";s:2:\"id\";i:101;s:4:\"name\";s:35:\"Item #101, minimum required fields.\";s:8:\"quantity\";d:3;s:5:\"price\";d:20;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:20;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:3.333299999999999929656269159750081598758697509765625;}s:32:\"ef46c8ba9b7e6f21ef6ec6e3e308d05a\";a:17:{s:6:\"row_id\";s:32:\"ef46c8ba9b7e6f21ef6ec6e3e308d05a\";s:2:\"id\";s:3:\"202\";s:4:\"name\";s:38:\"Item #202, added via form with options\";s:8:\"quantity\";d:1;s:5:\"price\";d:27.5;s:7:\"options\";a:2:{s:6:\"Colour\";s:3:\"Red\";s:4:\"Size\";s:5:\"Small\";}s:11:\"option_data\";a:2:{s:6:\"Colour\";a:3:{i:0;s:3:\"Red\";i:1;s:5:\"Green\";i:2;s:4:\"Blue\";}s:4:\"Size\";a:3:{i:0;s:5:\"Small\";i:1;s:6:\"Medium\";i:2;s:5:\"Large\";}}s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:27.5;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:4.58330000000000037374547900981269776821136474609375;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:2;s:11:\"total_items\";d:4;s:12:\"total_weight\";d:0;s:19:\"total_reward_points\";d:875;s:18:\"item_summary_total\";d:87.5;s:14:\"shipping_total\";d:5.0999999999999996447286321199499070644378662109375;s:9:\"tax_total\";d:15.42999999999999971578290569595992565155029296875;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:92.599999999999994315658113919198513031005859375;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:20:\"UK Recorded Shipping\";s:11:\"description\";s:8:\"2-3 Days\";s:5:\"value\";s:4:\"5.10\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:14.5832999999999994855670593096874654293060302734375;s:12:\"shipping_tax\";d:0.84999999999999997779553950749686919152736663818359375;s:17:\"item_discount_tax\";d:0;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:15.433299999999999130295691429637372493743896484375;s:18:\"cart_taxable_value\";d:77.166799999999994952304405160248279571533203125;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:0:{}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:0;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:2:\"25\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:5;s:12:\"order_number\";s:8:\"00000001\";}}}', '0000-00-00 00:00:00', '1');
INSERT INTO `cart_data` VALUES ('2', '2', 'a:3:{s:5:\"items\";a:1:{s:32:\"7f6ffaa6bb0b408017b62254211691b5\";a:15:{s:6:\"row_id\";s:32:\"7f6ffaa6bb0b408017b62254211691b5\";s:2:\"id\";i:112;s:4:\"name\";s:38:\"Item #112, stock controlled, in-stock.\";s:8:\"quantity\";d:3;s:5:\"price\";d:16.989999999999998436805981327779591083526611328125;s:14:\"stock_quantity\";s:2:\"20\";s:14:\"internal_price\";d:16.989999999999998436805981327779591083526611328125;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:2.831700000000000105870867628254927694797515869140625;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:1;s:11:\"total_items\";d:3;s:12:\"total_weight\";d:0;s:19:\"total_reward_points\";d:510;s:18:\"item_summary_total\";d:50.969999999999998863131622783839702606201171875;s:14:\"shipping_total\";d:3.95000000000000017763568394002504646778106689453125;s:9:\"tax_total\";d:9.1579999999999994741983755375258624553680419921875;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:54.9200000000000017053025658242404460906982421875;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:20:\"UK Standard Shipping\";s:11:\"description\";s:8:\"2-3 Days\";s:5:\"value\";s:4:\"3.95\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:8.4949999999999992184029906638897955417633056640625;s:12:\"shipping_tax\";d:0.65800000000000002930988785010413266718387603759765625;s:17:\"item_discount_tax\";d:0;s:20:\"summary_discount_tax\";d:0.9147999999999996134647517465054988861083984375;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:8.2352000000000007418066161335445940494537353515625;s:18:\"cart_taxable_value\";d:41.18480000000000273985278909094631671905517578125;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:1:{s:10:\"10-PERCENT\";a:3:{s:2:\"id\";s:1:\"2\";s:4:\"code\";s:10:\"10-PERCENT\";s:11:\"description\";s:49:\"Discount Code \"10-PERCENT\" - 10% off grand total.\";}}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:0:{}s:14:\"active_summary\";a:1:{s:5:\"total\";a:5:{s:2:\"id\";s:1:\"2\";s:4:\"code\";s:10:\"10-PERCENT\";s:11:\"description\";s:49:\"Discount Code \"10-PERCENT\" - 10% off grand total.\";s:9:\"tax_value\";d:0.9147999999999996134647517465054988861083984375;s:5:\"value\";d:5.4899999999999948840923025272786617279052734375;}}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:0;s:24:\"summary_discount_savings\";d:5.4899999999999948840923025272786617279052734375;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:2:\"25\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:6;s:12:\"order_number\";s:8:\"00000002\";}}}', '0000-00-00 00:00:00', '1');
INSERT INTO `cart_data` VALUES ('3', '3', 'a:3:{s:5:\"items\";a:2:{s:32:\"34ed066df378efacc9b924ec161e7639\";a:15:{s:6:\"row_id\";s:32:\"34ed066df378efacc9b924ec161e7639\";s:2:\"id\";i:301;s:4:\"name\";s:58:\"Discount Item #301, 10% off original price (&pound;24.99).\";s:8:\"quantity\";d:1;s:5:\"price\";d:22.910000000000000142108547152020037174224853515625;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:24.989999999999998436805981327779591083526611328125;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";s:12:\"Example Note\";s:14:\"status_message\";a:0:{}s:3:\"tax\";d:2.08269999999999999573674358543939888477325439453125;}s:32:\"c81e728d9d4c2f636f067f89cc14862c\";a:15:{s:6:\"row_id\";s:32:\"c81e728d9d4c2f636f067f89cc14862c\";s:2:\"id\";s:1:\"2\";s:4:\"name\";s:24:\"Example Database Item #2\";s:8:\"quantity\";d:1;s:5:\"price\";d:4.54000000000000003552713678800500929355621337890625;s:6:\"weight\";d:15;s:14:\"stock_quantity\";s:2:\"99\";s:14:\"internal_price\";d:4.95000000000000017763568394002504646778106689453125;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:0.412700000000000011279865930191590450704097747802734375;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:2;s:11:\"total_items\";d:2;s:12:\"total_weight\";d:15;s:19:\"total_reward_points\";d:274;s:18:\"item_summary_total\";d:27.449999999999999289457264239899814128875732421875;s:14:\"shipping_total\";d:13.660000000000000142108547152020037174224853515625;s:9:\"tax_total\";d:3.74199999999999999289457264239899814128875732421875;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:41.1099999999999994315658113919198513031005859375;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"AUD\";s:13:\"exchange_rate\";s:6:\"2.0000\";s:6:\"symbol\";s:4:\"AU $\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:2:\"12\";s:4:\"name\";s:22:\"Australia NSW Shipping\";s:11:\"description\";s:7:\"10 Days\";s:5:\"value\";s:5:\"14.90\";s:8:\"tax_rate\";N;s:8:\"location\";a:2:{i:0;a:5:{s:11:\"location_id\";s:2:\"11\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:1:\"8\";s:4:\"name\";s:3:\"NSW\";}i:1;a:5:{s:11:\"location_id\";s:1:\"8\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:9:\"Australia\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"GST\";s:4:\"rate\";s:7:\"10.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:2:{i:0;a:5:{s:11:\"location_id\";s:2:\"11\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:1:\"8\";s:4:\"name\";s:3:\"NSW\";}i:1;a:5:{s:11:\"location_id\";s:1:\"8\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:9:\"Australia\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:2.495400000000000062527760746888816356658935546875;s:12:\"shipping_tax\";d:1.24199999999999999289457264239899814128875732421875;s:17:\"item_discount_tax\";d:0.208199999999999996180832795289461500942707061767578125;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:3.529199999999999892708046900224871933460235595703125;s:18:\"cart_taxable_value\";d:35.29279999999999972715158946812152862548828125;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:1:{s:32:\"34ed066df378efacc9b924ec161e7639\";a:7:{s:2:\"id\";i:7;s:11:\"description\";s:58:\"Discount Item #301, 10% off original price (&pound;24.99).\";s:17:\"discount_quantity\";d:1;s:21:\"non_discount_quantity\";d:0;s:9:\"tax_value\";d:1.8745000000000000550670620214077644050121307373046875;s:5:\"value\";d:2.29000000000000003552713678800500929355621337890625;s:17:\"shipping_discount\";b:0;}}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:2.29000000000000003552713678800500929355621337890625;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:2:\"25\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:7;s:12:\"order_number\";s:8:\"00000003\";}}}', '0000-00-00 00:00:00', '1');
INSERT INTO `cart_data` VALUES ('4', '4', 'a:3:{s:5:\"items\";a:3:{s:32:\"274ad4786c3abca69fa097b85867d9a4\";a:15:{s:6:\"row_id\";s:32:\"274ad4786c3abca69fa097b85867d9a4\";s:2:\"id\";s:3:\"204\";s:4:\"name\";s:40:\"Item #204, added multiple items via form\";s:8:\"quantity\";d:1;s:5:\"price\";d:16.480000000000000426325641456060111522674560546875;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:18.25;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:1.2727999999999999314326259991503320634365081787109375;}s:32:\"7eabe3a1649ffa2b3ff8c02ebfd5659f\";a:15:{s:6:\"row_id\";s:32:\"7eabe3a1649ffa2b3ff8c02ebfd5659f\";s:2:\"id\";s:3:\"206\";s:4:\"name\";s:40:\"Item #206, added multiple items via form\";s:8:\"quantity\";d:4;s:5:\"price\";d:27.089999999999999857891452847979962825775146484375;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:30;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:2.0922999999999998266275724745355546474456787109375;}s:32:\"5fd0b37cd7dbbb00f97ba6ce92bf5add\";a:15:{s:6:\"row_id\";s:32:\"5fd0b37cd7dbbb00f97ba6ce92bf5add\";s:2:\"id\";i:114;s:4:\"name\";s:40:\"Item #114, specified 1000 reward points.\";s:8:\"quantity\";d:1;s:5:\"price\";d:17.14999999999999857891452847979962825775146484375;s:13:\"reward_points\";d:1000;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:18.989999999999998436805981327779591083526611328125;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:1.3245999999999999996447286321199499070644378662109375;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:3;s:11:\"total_items\";d:6;s:12:\"total_weight\";d:0;s:19:\"total_reward_points\";d:2249;s:18:\"item_summary_total\";d:141.990000000000009094947017729282379150390625;s:14:\"shipping_total\";d:9.5299999999999993605115378159098327159881591796875;s:9:\"tax_total\";d:11.70570000000000021600499167107045650482177734375;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:151.520000000000010231815394945442676544189453125;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"USD\";s:13:\"exchange_rate\";s:6:\"1.6000\";s:6:\"symbol\";s:4:\"US $\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:2:\"17\";s:4:\"name\";s:22:\"New York City Shipping\";s:11:\"description\";s:6:\"6 Days\";s:5:\"value\";s:5:\"10.55\";s:8:\"tax_rate\";N;s:8:\"location\";a:3:{i:0;a:5:{s:11:\"location_id\";s:2:\"18\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"3\";s:9:\"parent_id\";s:2:\"16\";s:4:\"name\";s:5:\"10101\";}i:1;a:5:{s:11:\"location_id\";s:2:\"16\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:2:\"10\";s:4:\"name\";s:8:\"New York\";}i:2;a:5:{s:11:\"location_id\";s:2:\"10\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:13:\"United States\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:17:\"Tax New York City\";s:4:\"rate\";s:6:\"8.3700\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:3:{i:0;a:5:{s:11:\"location_id\";s:2:\"18\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"3\";s:9:\"parent_id\";s:2:\"16\";s:4:\"name\";s:5:\"10101\";}i:1;a:5:{s:11:\"location_id\";s:2:\"16\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:2:\"10\";s:4:\"name\";s:8:\"New York\";}i:2;a:5:{s:11:\"location_id\";s:2:\"10\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:13:\"United States\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:10.966599999999999681676854379475116729736328125;s:12:\"shipping_tax\";d:0.735700000000000020605739337042905390262603759765625;s:17:\"item_discount_tax\";d:0;s:20:\"summary_discount_tax\";d:0.7721999999999979991116560995578765869140625;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:10.9277999999999995139887687400914728641510009765625;s:18:\"cart_taxable_value\";d:130.58220000000000027284841053187847137451171875;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:1:{s:13:\"10-FIXED-RATE\";a:3:{s:2:\"id\";s:1:\"3\";s:4:\"code\";s:13:\"10-FIXED-RATE\";s:11:\"description\";s:58:\"Discount Code \"10-FIXED-RATE\" - &pound;10 off grand total.\";}}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:0:{}s:14:\"active_summary\";a:1:{s:5:\"total\";a:5:{s:2:\"id\";s:1:\"3\";s:4:\"code\";s:13:\"10-FIXED-RATE\";s:11:\"description\";s:58:\"Discount Code \"10-FIXED-RATE\" - &pound;10 off grand total.\";s:9:\"tax_value\";d:0.7721999999999979991116560995578765869140625;s:5:\"value\";d:10;}}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:0;s:24:\"summary_discount_savings\";d:10;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:2:\"25\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:8;s:12:\"order_number\";s:8:\"00000004\";}}}', '0000-00-00 00:00:00', '1');
INSERT INTO `cart_data` VALUES ('5', '5', 'a:3:{s:5:\"items\";a:2:{s:32:\"8e98d81f8217304975ccb23337bb5761\";a:15:{s:6:\"row_id\";s:32:\"8e98d81f8217304975ccb23337bb5761\";s:2:\"id\";i:307;s:4:\"name\";s:64:\"Discount Item #307, Buy 5 @ &pound;10.00, get 2 for &pound;7.00.\";s:8:\"quantity\";d:7;s:5:\"price\";d:10;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:10;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:1.666700000000000070343730840249918401241302490234375;}s:32:\"c81e728d9d4c2f636f067f89cc14862c\";a:15:{s:6:\"row_id\";s:32:\"c81e728d9d4c2f636f067f89cc14862c\";s:2:\"id\";i:2;s:4:\"name\";s:24:\"Example Database Item #2\";s:8:\"quantity\";d:2;s:5:\"price\";d:4.95000000000000017763568394002504646778106689453125;s:6:\"weight\";d:15;s:14:\"stock_quantity\";s:2:\"98\";s:14:\"internal_price\";d:4.95000000000000017763568394002504646778106689453125;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:0.8249999999999999555910790149937383830547332763671875;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:2;s:11:\"total_items\";d:9;s:12:\"total_weight\";d:30;s:19:\"total_reward_points\";d:800;s:18:\"item_summary_total\";d:79.900000000000005684341886080801486968994140625;s:14:\"shipping_total\";d:7.25;s:9:\"tax_total\";d:14.5280000000000004689582056016661226749420166015625;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:87.150000000000005684341886080801486968994140625;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"5\";s:4:\"name\";s:28:\"EU Zone 1: Standard Shipping\";s:11:\"description\";s:8:\"3-4 Days\";s:5:\"value\";s:4:\"7.25\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"2\";s:7:\"zone_id\";s:1:\"1\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:11:\"France (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"2\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:11:\"France (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:13.316700000000000869704308570362627506256103515625;s:12:\"shipping_tax\";d:1.2079999999999999626965063725947402417659759521484375;s:17:\"item_discount_tax\";d:1;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:13.5247000000000010544454198679886758327484130859375;s:18:\"cart_taxable_value\";d:67.6231000000000079808160080574452877044677734375;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:1:{s:32:\"8e98d81f8217304975ccb23337bb5761\";a:7:{s:2:\"id\";i:13;s:11:\"description\";s:64:\"Discount Item #307, Buy 5 @ &pound;10.00, get 2 for &pound;7.00.\";s:17:\"discount_quantity\";d:2;s:21:\"non_discount_quantity\";d:5;s:9:\"tax_value\";d:1.166700000000000070343730840249918401241302490234375;s:5:\"value\";d:3;s:17:\"shipping_discount\";b:0;}}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:6;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:2:\"25\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:9;s:12:\"order_number\";s:8:\"00000005\";}}}', '0000-00-00 00:00:00', '1');
INSERT INTO `cart_data` VALUES ('6', '1', 'a:3:{s:5:\"items\";a:2:{s:32:\"4ca5767a4fb196d05c5ac280aa6ab6cc\";a:16:{s:6:\"row_id\";s:32:\"4ca5767a4fb196d05c5ac280aa6ab6cc\";s:2:\"id\";s:3:\"203\";s:4:\"name\";s:45:\"Item #203, added via form with priced options\";s:8:\"quantity\";d:1;s:5:\"price\";d:16.949999999999999289457264239899814128875732421875;s:7:\"options\";s:9:\"Option #1\";s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:16.949999999999999289457264239899814128875732421875;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:2.82500000000000017763568394002504646778106689453125;}s:32:\"34ed066df378efacc9b924ec161e7639\";a:15:{s:6:\"row_id\";s:32:\"34ed066df378efacc9b924ec161e7639\";s:2:\"id\";i:301;s:4:\"name\";s:58:\"Discount Item #301, 10% off original price (&pound;24.99).\";s:8:\"quantity\";d:2;s:5:\"price\";d:24.989999999999998436805981327779591083526611328125;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:24.989999999999998436805981327779591083526611328125;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:4.16500000000000003552713678800500929355621337890625;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:2;s:11:\"total_items\";d:3;s:12:\"total_weight\";d:0;s:19:\"total_reward_points\";d:670;s:18:\"item_summary_total\";d:66.93000000000000682121026329696178436279296875;s:14:\"shipping_total\";d:0;s:9:\"tax_total\";d:11.160000000000000142108547152020037174224853515625;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:66.93000000000000682121026329696178436279296875;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"4\";s:4:\"name\";s:13:\"UK Collection\";s:11:\"description\";s:18:\"Available Next Day\";s:5:\"value\";s:4:\"0.00\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:11.1549999999999993605115378159098327159881591796875;s:12:\"shipping_tax\";i:0;s:17:\"item_discount_tax\";d:0.83340000000000002966515921798418276011943817138671875;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:10.321600000000000108002495835535228252410888671875;s:18:\"cart_taxable_value\";d:51.6084000000000031604940886609256267547607421875;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:1:{s:32:\"34ed066df378efacc9b924ec161e7639\";a:7:{s:2:\"id\";i:7;s:11:\"description\";s:58:\"Discount Item #301, 10% off original price (&pound;24.99).\";s:17:\"discount_quantity\";d:2;s:21:\"non_discount_quantity\";d:0;s:9:\"tax_value\";d:3.748299999999999965183405947755090892314910888671875;s:5:\"value\";d:2.5;s:17:\"shipping_discount\";b:0;}}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:5;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:2:\"25\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:10;s:12:\"order_number\";s:8:\"00000006\";}}}', '0000-00-00 00:00:00', '1');
INSERT INTO `cart_data` VALUES ('7', '3', 'a:3:{s:5:\"items\";a:1:{s:32:\"c4ca4238a0b923820dcc509a6f75849b\";a:15:{s:6:\"row_id\";s:32:\"c4ca4238a0b923820dcc509a6f75849b\";s:2:\"id\";s:1:\"1\";s:4:\"name\";s:24:\"Example Database Item #1\";s:8:\"quantity\";d:3;s:5:\"price\";d:22.9200000000000017053025658242404460906982421875;s:6:\"weight\";d:75;s:14:\"stock_quantity\";s:3:\"100\";s:14:\"internal_price\";d:25;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:2.083600000000000118660636871936731040477752685546875;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:1;s:11:\"total_items\";d:3;s:12:\"total_weight\";d:225;s:19:\"total_reward_points\";d:687;s:18:\"item_summary_total\";d:68.7600000000000051159076974727213382720947265625;s:14:\"shipping_total\";d:13.660000000000000142108547152020037174224853515625;s:9:\"tax_total\";d:7.49199999999999999289457264239899814128875732421875;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:82.4200000000000017053025658242404460906982421875;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:2:\"12\";s:4:\"name\";s:22:\"Australia NSW Shipping\";s:11:\"description\";s:7:\"10 Days\";s:5:\"value\";s:5:\"14.90\";s:8:\"tax_rate\";N;s:8:\"location\";a:2:{i:0;a:5:{s:11:\"location_id\";s:2:\"11\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:1:\"8\";s:4:\"name\";s:3:\"NSW\";}i:1;a:5:{s:11:\"location_id\";s:1:\"8\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:9:\"Australia\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"GST\";s:4:\"rate\";s:7:\"10.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:2:{i:0;a:5:{s:11:\"location_id\";s:2:\"11\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:1:\"8\";s:4:\"name\";s:3:\"NSW\";}i:1;a:5:{s:11:\"location_id\";s:1:\"8\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:9:\"Australia\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:6.2508999999999996788346834364347159862518310546875;s:12:\"shipping_tax\";d:1.24199999999999999289457264239899814128875732421875;s:17:\"item_discount_tax\";d:2.083600000000000118660636871936731040477752685546875;s:20:\"summary_discount_tax\";d:0.54099999999999681676854379475116729736328125;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:4.868999999999999772626324556767940521240234375;s:18:\"cart_taxable_value\";d:48.6809999999999973852027324028313159942626953125;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:1:{s:10:\"10-PERCENT\";a:3:{s:2:\"id\";s:1:\"2\";s:4:\"code\";s:10:\"10-PERCENT\";s:11:\"description\";s:49:\"Discount Code \"10-PERCENT\" - 10% off grand total.\";}}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:1:{s:32:\"c4ca4238a0b923820dcc509a6f75849b\";a:7:{s:2:\"id\";i:32;s:11:\"description\";s:18:\"Buy 2, Get 1 Free.\";s:17:\"discount_quantity\";d:1;s:21:\"non_discount_quantity\";d:2;s:9:\"tax_value\";d:0;s:5:\"value\";d:22.9200000000000017053025658242404460906982421875;s:17:\"shipping_discount\";b:0;}}s:14:\"active_summary\";a:1:{s:5:\"total\";a:5:{s:2:\"id\";s:1:\"2\";s:4:\"code\";s:10:\"10-PERCENT\";s:11:\"description\";s:49:\"Discount Code \"10-PERCENT\" - 10% off grand total.\";s:9:\"tax_value\";d:0.54099999999999681676854379475116729736328125;s:5:\"value\";d:5.9500000000000028421709430404007434844970703125;}}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:22.9200000000000017053025658242404460906982421875;s:24:\"summary_discount_savings\";d:5.9500000000000028421709430404007434844970703125;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:2:\"25\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:11;s:12:\"order_number\";s:8:\"00000007\";}}}', '0000-00-00 00:00:00', '1');
INSERT INTO `cart_data` VALUES ('8', '4', 'a:3:{s:5:\"items\";a:1:{s:32:\"eccbc87e4b5ce2fe28308fd9f2a7baf3\";a:15:{s:6:\"row_id\";s:32:\"eccbc87e4b5ce2fe28308fd9f2a7baf3\";s:2:\"id\";s:1:\"3\";s:4:\"name\";s:24:\"Example Database Item #3\";s:8:\"quantity\";d:5;s:5:\"price\";d:23.019999999999999573674358543939888477325439453125;s:6:\"weight\";d:85;s:14:\"stock_quantity\";s:3:\"100\";s:14:\"internal_price\";d:25.489999999999998436805981327779591083526611328125;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:1.778000000000000024868995751603506505489349365234375;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:1;s:11:\"total_items\";d:5;s:12:\"total_weight\";d:425;s:19:\"total_reward_points\";i:0;s:18:\"item_summary_total\";d:115.099999999999994315658113919198513031005859375;s:14:\"shipping_total\";d:11.96000000000000085265128291212022304534912109375;s:9:\"tax_total\";d:9.81400000000000005684341886080801486968994140625;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:127.06000000000000227373675443232059478759765625;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:2:\"15\";s:4:\"name\";s:23:\"New York State Shipping\";s:11:\"description\";s:6:\"6 Days\";s:5:\"value\";s:5:\"13.25\";s:8:\"tax_rate\";N;s:8:\"location\";a:3:{i:0;a:5:{s:11:\"location_id\";s:2:\"18\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"3\";s:9:\"parent_id\";s:2:\"16\";s:4:\"name\";s:5:\"10101\";}i:1;a:5:{s:11:\"location_id\";s:2:\"16\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:2:\"10\";s:4:\"name\";s:8:\"New York\";}i:2;a:5:{s:11:\"location_id\";s:2:\"10\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:13:\"United States\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:17:\"Tax New York City\";s:4:\"rate\";s:6:\"8.3700\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:3:{i:0;a:5:{s:11:\"location_id\";s:2:\"18\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"3\";s:9:\"parent_id\";s:2:\"16\";s:4:\"name\";s:5:\"10101\";}i:1;a:5:{s:11:\"location_id\";s:2:\"16\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:2:\"10\";s:4:\"name\";s:8:\"New York\";}i:2;a:5:{s:11:\"location_id\";s:2:\"10\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:13:\"United States\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:8.8897999999999992581933838664554059505462646484375;s:12:\"shipping_tax\";d:0.92400000000000004352074256530613638460636138916015625;s:17:\"item_discount_tax\";d:0.88800000000000001154631945610162802040576934814453125;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";d:0.7727000000000003865352482534945011138916015625;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:8.15729999999999932924765744246542453765869140625;s:18:\"cart_taxable_value\";d:97.412700000000000954969436861574649810791015625;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:1:{s:15:\"088F148041B66A9\";a:3:{s:2:\"id\";s:2:\"36\";s:4:\"code\";s:15:\"088F148041B66A9\";s:11:\"description\";s:31:\"Reward Voucher: 088F148041B66A9\";}}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:1:{s:32:\"eccbc87e4b5ce2fe28308fd9f2a7baf3\";a:7:{s:2:\"id\";i:33;s:11:\"description\";s:23:\"10% off original price.\";s:17:\"discount_quantity\";d:5;s:21:\"non_discount_quantity\";d:0;s:9:\"tax_value\";d:1.600400000000000044764192352886311709880828857421875;s:5:\"value\";d:2.29999999999999982236431605997495353221893310546875;s:17:\"shipping_discount\";b:0;}}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:1:{i:36;a:5:{s:2:\"id\";s:2:\"36\";s:4:\"code\";s:15:\"088F148041B66A9\";s:11:\"description\";s:31:\"Reward Voucher: 088F148041B66A9\";s:9:\"tax_value\";d:0.7727000000000003865352482534945011138916015625;s:5:\"value\";d:10;}}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:11.5;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";d:10;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:2:\"25\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:12;s:12:\"order_number\";s:8:\"00000008\";}}}', '0000-00-00 00:00:00', '1');
INSERT INTO `cart_data` VALUES ('9', '1', 'a:3:{s:5:\"items\";a:4:{s:32:\"0768281a05da9f27df178b5c39a51263\";a:15:{s:6:\"row_id\";s:32:\"0768281a05da9f27df178b5c39a51263\";s:2:\"id\";i:1021;s:4:\"name\";s:35:\"Item #1021, multiple items at once.\";s:8:\"quantity\";d:1;s:5:\"price\";d:22.5;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:22.5;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:3.75;}s:32:\"93d65641ff3f1586614cf2c1ad240b6c\";a:15:{s:6:\"row_id\";s:32:\"93d65641ff3f1586614cf2c1ad240b6c\";s:2:\"id\";i:1022;s:4:\"name\";s:35:\"Item #1022, multiple items at once.\";s:8:\"quantity\";d:2;s:5:\"price\";d:35.9500000000000028421709430404007434844970703125;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:35.9500000000000028421709430404007434844970703125;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:5.9916999999999998038902049302123486995697021484375;}s:32:\"ce5140df15d046a66883807d18d0264b\";a:15:{s:6:\"row_id\";s:32:\"ce5140df15d046a66883807d18d0264b\";s:2:\"id\";i:1023;s:4:\"name\";s:35:\"Item #1023, multiple items at once.\";s:8:\"quantity\";d:3;s:5:\"price\";d:16;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:16;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:2.666700000000000070343730840249918401241302490234375;}s:32:\"34ed066df378efacc9b924ec161e7639\";a:15:{s:6:\"row_id\";s:32:\"34ed066df378efacc9b924ec161e7639\";s:2:\"id\";i:301;s:4:\"name\";s:58:\"Discount Item #301, 10% off original price (&pound;24.99).\";s:8:\"quantity\";d:1;s:5:\"price\";d:24.989999999999998436805981327779591083526611328125;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:24.989999999999998436805981327779591083526611328125;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:4.16500000000000003552713678800500929355621337890625;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:4;s:11:\"total_items\";d:7;s:12:\"total_weight\";d:0;s:19:\"total_reward_points\";d:1675;s:18:\"item_summary_total\";d:167.3899999999999863575794734060764312744140625;s:14:\"shipping_total\";d:3.95000000000000017763568394002504646778106689453125;s:9:\"tax_total\";d:28.55799999999999982946974341757595539093017578125;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:171.340000000000003410605131648480892181396484375;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:20:\"UK Standard Shipping\";s:11:\"description\";s:8:\"2-3 Days\";s:5:\"value\";s:4:\"3.95\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:27.89829999999999898818714427761733531951904296875;s:12:\"shipping_tax\";d:0.65800000000000002930988785010413266718387603759765625;s:17:\"item_discount_tax\";d:0.416700000000000014832579608992091380059719085693359375;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:28.139600000000001500666257925331592559814453125;s:18:\"cart_taxable_value\";d:140.69819999999998572093318216502666473388671875;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:1:{s:32:\"34ed066df378efacc9b924ec161e7639\";a:7:{s:2:\"id\";i:7;s:11:\"description\";s:58:\"Discount Item #301, 10% off original price (&pound;24.99).\";s:17:\"discount_quantity\";d:1;s:21:\"non_discount_quantity\";d:0;s:9:\"tax_value\";d:3.748299999999999965183405947755090892314910888671875;s:5:\"value\";d:2.5;s:17:\"shipping_discount\";b:0;}}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:2.5;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:2:\"25\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:13;s:12:\"order_number\";b:0;}}}', '0000-00-00 00:00:00', '0');
INSERT INTO `cart_data` VALUES ('10', '1', 'a:3:{s:5:\"items\";a:2:{s:32:\"2f43101aac761ce5fa8c0d47cd1047e4\";a:17:{s:6:\"row_id\";s:32:\"2f43101aac761ce5fa8c0d47cd1047e4\";s:2:\"id\";s:3:\"202\";s:4:\"name\";s:38:\"Item #202, added via form with options\";s:8:\"quantity\";d:2;s:5:\"price\";d:27.5;s:7:\"options\";a:2:{s:6:\"Colour\";s:4:\"Blue\";s:4:\"Size\";s:5:\"Small\";}s:11:\"option_data\";a:2:{s:6:\"Colour\";a:3:{i:0;s:3:\"Red\";i:1;s:5:\"Green\";i:2;s:4:\"Blue\";}s:4:\"Size\";a:3:{i:0;s:5:\"Small\";i:1;s:6:\"Medium\";i:2;s:5:\"Large\";}}s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:27.5;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:4.58330000000000037374547900981269776821136474609375;}s:32:\"a87ff679a2f3e71d9181a67b7542122c\";a:15:{s:6:\"row_id\";s:32:\"a87ff679a2f3e71d9181a67b7542122c\";s:2:\"id\";s:1:\"4\";s:4:\"name\";s:24:\"Example Database Item #4\";s:8:\"quantity\";d:1;s:5:\"price\";d:199.990000000000009094947017729282379150390625;s:6:\"weight\";d:250;s:14:\"stock_quantity\";s:3:\"100\";s:14:\"internal_price\";d:199.990000000000009094947017729282379150390625;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:33.3316999999999978854248183779418468475341796875;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:2;s:11:\"total_items\";d:3;s:12:\"total_weight\";d:250;s:19:\"total_reward_points\";d:2550;s:18:\"item_summary_total\";d:254.990000000000009094947017729282379150390625;s:14:\"shipping_total\";d:5.2599999999999997868371792719699442386627197265625;s:9:\"tax_total\";d:43.37599999999999766941982670687139034271240234375;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:260.25;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:20:\"UK Standard Shipping\";s:11:\"description\";s:8:\"2-3 Days\";s:5:\"value\";s:4:\"5.25\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:42.49839999999999662350091966800391674041748046875;s:12:\"shipping_tax\";d:0.87600000000000000088817841970012523233890533447265625;s:17:\"item_discount_tax\";d:0;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:43.3743999999999942929207463748753070831298828125;s:18:\"cart_taxable_value\";d:216.871700000000004138200893066823482513427734375;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:0:{}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:0;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:2:\"25\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:14;s:12:\"order_number\";b:0;}}}', '0000-00-00 00:00:00', '0');

-- ----------------------------
-- Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Note: This is the default CodeIgniter session table.';

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------
INSERT INTO `ci_sessions` VALUES ('e57043e32657e40b165f48f7379067ca', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.63 Safari/535.7', '1325741884', 'a:2:{s:9:\"user_data\";s:0:\"\";s:10:\"flexi_cart\";a:3:{s:5:\"items\";a:0:{}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:0;s:11:\"total_items\";i:0;s:12:\"total_weight\";i:0;s:19:\"total_reward_points\";i:0;s:18:\"item_summary_total\";i:0;s:14:\"shipping_total\";d:0;s:9:\"tax_total\";i:0;s:15:\"surcharge_total\";i:0;s:5:\"total\";i:0;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:2:\"£\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:20:\"UK Standard Shipping\";s:11:\"description\";s:8:\"2-3 Days\";s:5:\"value\";s:4:\"3.95\";s:8:\"tax_rate\";b:0;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";i:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";i:0;s:12:\"shipping_tax\";i:0;s:17:\"item_discount_tax\";i:0;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";i:0;s:18:\"cart_taxable_value\";i:0;s:22:\"cart_non_taxable_value\";i:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:0:{}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";i:0;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:2:\"25\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";b:0;s:12:\"order_number\";b:0;}}}}');

-- ----------------------------
-- Table structure for `currency`
-- ----------------------------
DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency` (
  `curr_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `curr_name` varchar(50) NOT NULL,
  `curr_exchange_rate` double(8,4) NOT NULL,
  `curr_symbol` varchar(25) NOT NULL,
  `curr_symbol_suffix` tinyint(1) NOT NULL,
  `curr_thousand_separator` varchar(10) NOT NULL,
  `curr_decimal_separator` varchar(10) NOT NULL,
  `curr_status` tinyint(1) NOT NULL,
  `curr_default` tinyint(1) NOT NULL,
  PRIMARY KEY (`curr_id`),
  KEY `curr_id` (`curr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of currency
-- ----------------------------
INSERT INTO `currency` VALUES ('1', 'AUD', '2.0000', 'AU $', '0', ',', '.', '1', '0');
INSERT INTO `currency` VALUES ('2', 'EUR', '1.1500', '€', '1', '.', ',', '1', '0');
INSERT INTO `currency` VALUES ('3', 'GBP', '1.0000', '£', '0', ',', '.', '1', '1');
INSERT INTO `currency` VALUES ('4', 'USD', '1.6000', 'US $', '0', ',', '.', '1', '0');

-- ----------------------------
-- Table structure for `demo_categories`
-- ----------------------------
DROP TABLE IF EXISTS `demo_categories`;
CREATE TABLE `demo_categories` (
  `cat_id` int(5) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(25) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_id` (`cat_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=sjis COMMENT='Note: This is a custom demo table for item categories.';

-- ----------------------------
-- Records of demo_categories
-- ----------------------------
INSERT INTO `demo_categories` VALUES ('1', 'Category #1');
INSERT INTO `demo_categories` VALUES ('2', 'Category #2');

-- ----------------------------
-- Table structure for `demo_items`
-- ----------------------------
DROP TABLE IF EXISTS `demo_items`;
CREATE TABLE `demo_items` (
  `item_id` int(5) NOT NULL AUTO_INCREMENT,
  `item_cat_fk` smallint(5) NOT NULL,
  `item_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `item_price` double(6,2) NOT NULL,
  `item_weight` double(6,2) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_id` (`item_id`),
  KEY `item_cat_fk` (`item_cat_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=sjis COMMENT='Note: This is a custom demo table for items.';

-- ----------------------------
-- Records of demo_items
-- ----------------------------
INSERT INTO `demo_items` VALUES ('1', '1', 'Item #1', '25.00', '75.00');
INSERT INTO `demo_items` VALUES ('2', '1', 'Item #2', '4.95', '15.00');
INSERT INTO `demo_items` VALUES ('3', '2', 'Item #3', '25.49', '85.00');
INSERT INTO `demo_items` VALUES ('4', '2', 'Item #4', '199.99', '250.00');
INSERT INTO `demo_items` VALUES ('5', '1', 'Item #5', '74.99', '75.00');

-- ----------------------------
-- Table structure for `demo_users`
-- ----------------------------
DROP TABLE IF EXISTS `demo_users`;
CREATE TABLE `demo_users` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `user_group_fk` smallint(5) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`) USING BTREE,
  KEY `user_group_fk` (`user_group_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=sjis COMMENT='Note: This is a custom demo table for users.';

-- ----------------------------
-- Records of demo_users
-- ----------------------------
INSERT INTO `demo_users` VALUES ('1', 'Customer #1', '1');
INSERT INTO `demo_users` VALUES ('2', 'Customer #2', '1');
INSERT INTO `demo_users` VALUES ('3', 'Customer #3', '2');
INSERT INTO `demo_users` VALUES ('4', 'Customer #4', '1');
INSERT INTO `demo_users` VALUES ('5', 'Customer #5', '2');

-- ----------------------------
-- Table structure for `discounts`
-- ----------------------------
DROP TABLE IF EXISTS `discounts`;
CREATE TABLE `discounts` (
  `disc_id` int(11) NOT NULL AUTO_INCREMENT,
  `disc_type_fk` smallint(5) NOT NULL,
  `disc_method_fk` smallint(5) NOT NULL,
  `disc_tax_method_fk` tinyint(1) NOT NULL,
  `disc_user_acc_fk` int(11) NOT NULL,
  `disc_item_fk` int(11) NOT NULL COMMENT 'Item / Product Id',
  `disc_group_fk` int(11) NOT NULL,
  `disc_location_fk` smallint(5) NOT NULL,
  `disc_zone_fk` smallint(5) NOT NULL,
  `disc_code` varchar(50) NOT NULL COMMENT 'Discount Code',
  `disc_description` varchar(255) NOT NULL COMMENT 'Name shown in cart when active',
  `disc_quantity_required` smallint(5) NOT NULL COMMENT 'Quantity required for offer',
  `disc_quantity_discounted` smallint(5) NOT NULL COMMENT 'Quantity affected by offer',
  `disc_value_required` double(8,2) NOT NULL,
  `disc_value_discounted` double(8,2) NOT NULL COMMENT '% discount, flat fee discount, new set price - specified via calculation_fk',
  `disc_recursive` tinyint(1) NOT NULL COMMENT 'Discount is repeatable multiple times on one item',
  `disc_non_combinable_discount` tinyint(1) NOT NULL COMMENT 'Cannot be applied if any other discount is applied',
  `disc_void_reward_points` tinyint(1) NOT NULL COMMENT 'Voids any current reward points',
  `disc_force_ship_discount` tinyint(1) NOT NULL,
  `disc_custom_status_1` varchar(50) NOT NULL,
  `disc_custom_status_2` varchar(50) NOT NULL,
  `disc_custom_status_3` varchar(50) NOT NULL,
  `disc_usage_limit` smallint(5) NOT NULL COMMENT 'Number of offers available',
  `disc_valid_date` datetime NOT NULL,
  `disc_expire_date` datetime NOT NULL,
  `disc_status` tinyint(1) NOT NULL,
  `disc_order_by` smallint(1) NOT NULL DEFAULT '100' COMMENT 'Default value of 100 to ensure non set ''order by'' values of zero are not before 1,2,3 etc.',
  PRIMARY KEY (`disc_id`),
  UNIQUE KEY `disc_id` (`disc_id`) USING BTREE,
  KEY `disc_item_fk` (`disc_item_fk`),
  KEY `disc_location_fk` (`disc_location_fk`),
  KEY `disc_zone_fk` (`disc_zone_fk`),
  KEY `disc_method_fk` (`disc_method_fk`) USING BTREE,
  KEY `disc_type_fk` (`disc_type_fk`),
  KEY `disc_group_fk` (`disc_group_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of discounts
-- ----------------------------
INSERT INTO `discounts` VALUES ('1', '1', '11', '1', '0', '0', '0', '1', '0', 'FREE-UK-SHIPPING', 'Discount Code \"FREE-UK-SHIPPING\" - Free UK shipping.', '0', '0', '0.00', '0.00', '0', '0', '1', '1', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('2', '2', '12', '1', '0', '0', '0', '0', '0', '10-PERCENT', 'Discount Code \"10-PERCENT\" - 10% off grand total.', '0', '0', '0.00', '10.00', '0', '0', '0', '0', '', '', '', '9998', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('3', '2', '13', '1', '0', '0', '0', '0', '0', '10-FIXED-RATE', 'Discount Code \"10-FIXED-RATE\" - &pound;10 off grand total.', '0', '0', '0.00', '10.00', '0', '0', '0', '0', '', '', '', '9998', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('4', '2', '13', '1', '0', '0', '0', '0', '0', '', 'Discount Summary, Spend over &pound;1,000, get &pound;100 off.', '1', '1', '1000.00', '100.00', '0', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('5', '2', '11', '1', '0', '0', '0', '0', '0', '', 'Discount Summary, Spend over &pound;500, get free worldwide shipping.', '0', '0', '500.00', '0.00', '0', '0', '0', '1', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('6', '2', '12', '1', '0', '0', '0', '0', '0', '', 'Discount Summary, Logged in users get 5% off total.', '0', '0', '0.00', '5.00', '0', '0', '0', '0', '1', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('7', '1', '1', '1', '0', '301', '0', '0', '0', '', 'Discount Item #301, 10% off original price (&pound;24.99).', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '', '', '', '9997', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('8', '1', '2', '1', '0', '302', '0', '0', '0', '', 'Discount Item #302, Fixed price of &pound;5.00 off original price of &pound;12.50.', '1', '1', '0.00', '5.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('9', '1', '3', '1', '0', '303', '0', '0', '0', '', 'Discount Item #303, New price of &pound;15.00, item was &pound;25.00.', '1', '1', '0.00', '15.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('10', '1', '3', '1', '0', '304', '0', '0', '0', '', 'Discount Item #304, Buy 2, get 1 free.', '3', '1', '0.00', '0.00', '1', '0', '0', '0', '', '', '', '9998', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('11', '1', '1', '1', '0', '305', '0', '0', '0', '', 'Discount Item #305, Buy 1, get 1 @ 50% off.', '2', '1', '0.00', '50.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('12', '1', '2', '1', '0', '306', '0', '0', '0', '', 'Discount Item #306, Buy 2 @ &pound;15.00, get 1 with &pound;5.00 off.', '3', '1', '0.00', '5.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('13', '1', '3', '1', '0', '307', '0', '0', '0', '', 'Discount Item #307, Buy 5 @ &pound;10.00, get 2 for &pound;7.00.', '7', '2', '0.00', '7.00', '1', '0', '0', '0', '', '', '', '9998', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('14', '1', '6', '1', '0', '308', '0', '1', '0', '', 'Discount Item #308, Buy 3, get free UK shipping on these items (Other items still charged).', '3', '3', '0.00', '0.00', '1', '0', '0', '1', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('15', '1', '1', '1', '0', '309', '0', '0', '0', '', 'Discount Item #309, Spend over &pound;75.00 on this item, get 10% off this items total.', '1', '1', '75.00', '10.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('16', '1', '2', '1', '0', '310', '0', '0', '0', '', 'Discount Item #310, Spend over &pound;100.00 on this item, get &pound;10.00 off this items total.', '1', '1', '100.00', '10.00', '0', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('17', '1', '3', '1', '0', '0', '1', '0', '0', '', 'Discount Group: Items #311, #312, #313 - buy 3, get cheapest item free.', '3', '1', '0.00', '0.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('18', '1', '1', '1', '0', '314', '0', '0', '0', '', 'Discount Item #314, 10% off original price - but for logged in users only.', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '1', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('19', '1', '1', '1', '0', '315', '0', '0', '0', '', 'Discount Item #315, 10% off original price - but removes the items reward points (Normally 200 points).', '1', '1', '0.00', '10.00', '1', '0', '1', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('20', '1', '1', '1', '0', '316', '0', '0', '0', '', 'Discount Item #316, 10% off original price - but applies to first item only (Non recursive quantity discount).', '1', '1', '0.00', '10.00', '0', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('21', '1', '1', '1', '0', '317', '0', '1', '0', '', 'Discount Item #317, 10% off original price - but applies to orders being shipped to the UK only.', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('22', '1', '1', '1', '0', '318', '0', '0', '0', '', 'Discount Item #318, 10% off original price - but cannot be applied if other discounts exist.', '1', '1', '0.00', '10.00', '1', '1', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('23', '1', '1', '1', '0', '401', '0', '0', '0', '', 'Discount Tax #401, get 10% off original price (&pound;10.00) - Method #1.', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('24', '1', '1', '2', '0', '402', '0', '0', '0', '', 'Discount Tax #402, get 10% off original price (&pound;10.00) - Method #2.', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('25', '1', '1', '3', '0', '403', '0', '0', '0', '', 'Discount Tax #403, get 10% off original price (&pound;10.00) - Method #3.', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('26', '1', '2', '1', '0', '404', '0', '0', '0', '', 'Discount Tax #404, get set price of (£5.00) off original price (&pound;10.00) - Method #1.', '1', '1', '0.00', '5.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('27', '1', '2', '2', '0', '405', '0', '0', '0', '', 'Discount Tax #405, get set price of (£5.00) off original price (&pound;10.00) - Method #2.', '1', '1', '0.00', '5.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('28', '1', '2', '3', '0', '406', '0', '0', '0', '', 'Discount Tax #406, get set price of (£5.00) off original price (&pound;10.00) - Method #3.', '1', '1', '0.00', '5.00', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('29', '1', '3', '1', '0', '407', '0', '0', '0', '', 'Discount Tax #407, get for new price of £7.50 (Original price &pound;10.00) - Method #1.', '1', '1', '0.00', '7.50', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('30', '1', '3', '2', '0', '408', '0', '0', '0', '', 'Discount Tax #408, get for new price of £7.50 (Original price &pound;10.00) - Method #2.', '1', '1', '0.00', '7.50', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('31', '1', '3', '3', '0', '409', '0', '0', '0', '', 'Discount Tax #409, get for new price of £7.50 (Original price £10.00) - Method #3.', '1', '1', '0.00', '7.50', '1', '0', '0', '0', '', '', '', '9999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('32', '1', '3', '0', '0', '1', '0', '0', '0', '', 'Buy 2, Get 1 Free.', '2', '1', '0.00', '0.00', '1', '0', '0', '0', '', '', '', '9', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('33', '1', '1', '0', '0', '3', '0', '0', '0', '', '10% off original price.', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '', '', '', '9', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('34', '1', '2', '0', '0', '5', '0', '0', '0', '', 'Get £5.00 off original price.', '1', '1', '0.00', '5.00', '1', '0', '0', '0', '', '', '', '10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('35', '3', '14', '0', '1', '0', '0', '0', '0', '2AC2AE9AEF923F4', 'Reward Voucher: 2AC2AE9AEF923F4', '0', '0', '0.00', '5.00', '0', '0', '1', '0', '', '', '', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '100');
INSERT INTO `discounts` VALUES ('36', '3', '14', '0', '4', '0', '0', '0', '0', '088F148041B66A9', 'Reward Voucher: 088F148041B66A9', '0', '0', '0.00', '10.00', '0', '0', '1', '0', '', '', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '100');

-- ----------------------------
-- Table structure for `discount_calculation`
-- ----------------------------
DROP TABLE IF EXISTS `discount_calculation`;
CREATE TABLE `discount_calculation` (
  `disc_calculation_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `disc_calculation` varchar(255) NOT NULL,
  PRIMARY KEY (`disc_calculation_id`),
  UNIQUE KEY `disc_calculation_id` (`disc_calculation_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Note: Do not alter the order or id''s of records in table.';

-- ----------------------------
-- Records of discount_calculation
-- ----------------------------
INSERT INTO `discount_calculation` VALUES ('1', 'Percentage Based');
INSERT INTO `discount_calculation` VALUES ('2', 'Flat Fee');
INSERT INTO `discount_calculation` VALUES ('3', 'New Value');

-- ----------------------------
-- Table structure for `discount_columns`
-- ----------------------------
DROP TABLE IF EXISTS `discount_columns`;
CREATE TABLE `discount_columns` (
  `disc_column_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `disc_column` varchar(255) NOT NULL,
  PRIMARY KEY (`disc_column_id`),
  UNIQUE KEY `disc_column_id` (`disc_column_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Note: Do not alter the order or id''s of records in table.';

-- ----------------------------
-- Records of discount_columns
-- ----------------------------
INSERT INTO `discount_columns` VALUES ('1', 'Item Price');
INSERT INTO `discount_columns` VALUES ('2', 'Item Shipping');
INSERT INTO `discount_columns` VALUES ('3', 'Summary Item Total');
INSERT INTO `discount_columns` VALUES ('4', 'Summary Shipping Total');
INSERT INTO `discount_columns` VALUES ('5', 'Summary Total');
INSERT INTO `discount_columns` VALUES ('6', 'Summary Total (Voucher)');

-- ----------------------------
-- Table structure for `discount_groups`
-- ----------------------------
DROP TABLE IF EXISTS `discount_groups`;
CREATE TABLE `discount_groups` (
  `disc_group_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `disc_group` varchar(255) NOT NULL,
  `disc_group_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`disc_group_id`),
  UNIQUE KEY `disc_group_id` (`disc_group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of discount_groups
-- ----------------------------
INSERT INTO `discount_groups` VALUES ('1', 'Demo Group : Items #311, #312, #313', '1');

-- ----------------------------
-- Table structure for `discount_group_items`
-- ----------------------------
DROP TABLE IF EXISTS `discount_group_items`;
CREATE TABLE `discount_group_items` (
  `disc_group_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `disc_group_item_group_fk` int(11) NOT NULL,
  `disc_group_item_item_fk` int(11) NOT NULL,
  PRIMARY KEY (`disc_group_item_id`),
  UNIQUE KEY `disc_group_item_id` (`disc_group_item_id`) USING BTREE,
  KEY `disc_group_item_group_fk` (`disc_group_item_group_fk`) USING BTREE,
  KEY `disc_group_item_item_fk` (`disc_group_item_item_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of discount_group_items
-- ----------------------------
INSERT INTO `discount_group_items` VALUES ('1', '1', '311');
INSERT INTO `discount_group_items` VALUES ('2', '1', '312');
INSERT INTO `discount_group_items` VALUES ('3', '1', '313');

-- ----------------------------
-- Table structure for `discount_methods`
-- ----------------------------
DROP TABLE IF EXISTS `discount_methods`;
CREATE TABLE `discount_methods` (
  `disc_method_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `disc_method_type_fk` smallint(5) NOT NULL,
  `disc_method_column_fk` smallint(5) NOT NULL,
  `disc_method_calculation_fk` smallint(5) NOT NULL,
  `disc_method` varchar(50) NOT NULL,
  PRIMARY KEY (`disc_method_id`),
  UNIQUE KEY `disc_method_id` (`disc_method_id`) USING BTREE,
  KEY `disc_method_column_fk` (`disc_method_column_fk`) USING BTREE,
  KEY `disc_method_calculation_fk` (`disc_method_calculation_fk`) USING BTREE,
  KEY `disc_method_type_fk` (`disc_method_type_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COMMENT='Note: Do not alter the order or id''s of records in table.';

-- ----------------------------
-- Records of discount_methods
-- ----------------------------
INSERT INTO `discount_methods` VALUES ('1', '1', '1', '1', 'Item Price - Percentage Based');
INSERT INTO `discount_methods` VALUES ('2', '1', '1', '2', 'Item Price - Flat Fee');
INSERT INTO `discount_methods` VALUES ('3', '1', '1', '3', 'Item Price - New Value');
INSERT INTO `discount_methods` VALUES ('4', '1', '2', '1', 'Item Shipping - Percentage Based');
INSERT INTO `discount_methods` VALUES ('5', '1', '2', '2', 'Item Shipping - Flat Fee');
INSERT INTO `discount_methods` VALUES ('6', '1', '2', '3', 'Item Shipping - New Value');
INSERT INTO `discount_methods` VALUES ('7', '2', '3', '1', 'Summary Item Total - Percentage Based');
INSERT INTO `discount_methods` VALUES ('8', '2', '3', '2', 'Summary Item Total - Flat Fee');
INSERT INTO `discount_methods` VALUES ('9', '2', '4', '1', 'Summary Shipping Total - Percentage Based');
INSERT INTO `discount_methods` VALUES ('10', '2', '4', '2', 'Summary Shipping Total - Flat Fee');
INSERT INTO `discount_methods` VALUES ('11', '2', '4', '3', 'Summary Shipping Total - New Value');
INSERT INTO `discount_methods` VALUES ('12', '2', '5', '1', 'Summary Total - Percentage Based');
INSERT INTO `discount_methods` VALUES ('13', '2', '5', '2', 'Summary Total - Flat Fee');
INSERT INTO `discount_methods` VALUES ('14', '3', '6', '2', 'Summary Total - Flat Fee (Voucher)');

-- ----------------------------
-- Table structure for `discount_tax_methods`
-- ----------------------------
DROP TABLE IF EXISTS `discount_tax_methods`;
CREATE TABLE `discount_tax_methods` (
  `disc_tax_method_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `disc_tax_method` varchar(255) NOT NULL,
  PRIMARY KEY (`disc_tax_method_id`),
  UNIQUE KEY `disc_tax_method_id` (`disc_tax_method_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Note: Do not alter the order or id''s of records in table.';

-- ----------------------------
-- Records of discount_tax_methods
-- ----------------------------
INSERT INTO `discount_tax_methods` VALUES ('1', 'Apply Tax Before Discount ');
INSERT INTO `discount_tax_methods` VALUES ('2', 'Apply Discount Before Tax');
INSERT INTO `discount_tax_methods` VALUES ('3', 'Apply Discount Before Tax, Add Original Tax');

-- ----------------------------
-- Table structure for `discount_types`
-- ----------------------------
DROP TABLE IF EXISTS `discount_types`;
CREATE TABLE `discount_types` (
  `disc_type_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `disc_type` varchar(50) NOT NULL,
  PRIMARY KEY (`disc_type_id`),
  UNIQUE KEY `disc_type_id` (`disc_type_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Note: Do not alter the order or id''s of records in table.';

-- ----------------------------
-- Records of discount_types
-- ----------------------------
INSERT INTO `discount_types` VALUES ('1', 'Item Discount');
INSERT INTO `discount_types` VALUES ('2', 'Summary Discount');
INSERT INTO `discount_types` VALUES ('3', 'Reward Voucher');

-- ----------------------------
-- Table structure for `item_stock`
-- ----------------------------
DROP TABLE IF EXISTS `item_stock`;
CREATE TABLE `item_stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_item_fk` int(11) NOT NULL,
  `stock_quantity` smallint(5) NOT NULL,
  `stock_auto_allocate_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`stock_id`),
  UNIQUE KEY `stock_id` (`stock_id`) USING BTREE,
  KEY `stock_item_fk` (`stock_item_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of item_stock
-- ----------------------------
INSERT INTO `item_stock` VALUES ('1', '112', '20', '1');
INSERT INTO `item_stock` VALUES ('2', '113', '0', '1');
INSERT INTO `item_stock` VALUES ('3', '1', '100', '1');
INSERT INTO `item_stock` VALUES ('4', '2', '100', '1');
INSERT INTO `item_stock` VALUES ('5', '3', '100', '1');
INSERT INTO `item_stock` VALUES ('6', '4', '100', '1');
INSERT INTO `item_stock` VALUES ('7', '5', '100', '1');

-- ----------------------------
-- Table structure for `locations`
-- ----------------------------
DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `loc_id` int(11) NOT NULL AUTO_INCREMENT,
  `loc_type_fk` smallint(5) NOT NULL,
  `loc_parent_fk` int(11) NOT NULL,
  `loc_ship_zone_fk` smallint(5) NOT NULL,
  `loc_tax_zone_fk` smallint(5) NOT NULL,
  `loc_name` varchar(50) NOT NULL,
  `loc_status` tinyint(1) NOT NULL,
  `loc_ship_default` tinyint(1) NOT NULL,
  `loc_tax_default` tinyint(1) NOT NULL,
  PRIMARY KEY (`loc_id`),
  UNIQUE KEY `loc_id` (`loc_id`) USING BTREE,
  KEY `loc_type_fk` (`loc_type_fk`) USING BTREE,
  KEY `loc_tax_zone_fk` (`loc_tax_zone_fk`),
  KEY `loc_ship_zone_fk` (`loc_ship_zone_fk`),
  KEY `loc_parent_fk` (`loc_parent_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of locations
-- ----------------------------
INSERT INTO `locations` VALUES ('1', '1', '0', '0', '4', 'United Kingdom (EU)', '1', '1', '1');
INSERT INTO `locations` VALUES ('2', '1', '0', '1', '4', 'France (EU)', '1', '0', '0');
INSERT INTO `locations` VALUES ('3', '1', '0', '1', '4', 'Germany (EU)', '1', '0', '0');
INSERT INTO `locations` VALUES ('4', '1', '0', '2', '4', 'Portugal (EU)', '1', '0', '0');
INSERT INTO `locations` VALUES ('5', '1', '0', '2', '4', 'Spain (EU)', '1', '0', '0');
INSERT INTO `locations` VALUES ('6', '1', '0', '3', '5', 'Norway (Non EU)', '1', '0', '0');
INSERT INTO `locations` VALUES ('7', '1', '0', '3', '5', 'Switzerland (Non EU)', '1', '0', '0');
INSERT INTO `locations` VALUES ('8', '1', '0', '0', '0', 'Australia', '1', '0', '0');
INSERT INTO `locations` VALUES ('9', '1', '0', '0', '0', 'Canada', '1', '0', '0');
INSERT INTO `locations` VALUES ('10', '1', '0', '0', '0', 'United States', '1', '0', '0');
INSERT INTO `locations` VALUES ('11', '2', '8', '0', '0', 'NSW', '1', '0', '0');
INSERT INTO `locations` VALUES ('12', '2', '8', '0', '0', 'Queensland', '1', '0', '0');
INSERT INTO `locations` VALUES ('13', '2', '8', '0', '0', 'Victoria', '1', '0', '0');
INSERT INTO `locations` VALUES ('14', '2', '10', '0', '0', 'California', '1', '0', '0');
INSERT INTO `locations` VALUES ('15', '2', '10', '0', '0', 'Florida', '1', '0', '0');
INSERT INTO `locations` VALUES ('16', '2', '10', '0', '0', 'New York', '1', '0', '0');
INSERT INTO `locations` VALUES ('17', '2', '10', '0', '0', 'Pennsylvania', '1', '0', '0');
INSERT INTO `locations` VALUES ('18', '3', '16', '0', '0', '10101', '1', '0', '0');
INSERT INTO `locations` VALUES ('19', '3', '16', '0', '0', '10102', '1', '0', '0');

-- ----------------------------
-- Table structure for `location_type`
-- ----------------------------
DROP TABLE IF EXISTS `location_type`;
CREATE TABLE `location_type` (
  `loc_type_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `loc_type_parent_fk` smallint(5) NOT NULL,
  `loc_type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`loc_type_id`),
  UNIQUE KEY `loc_type_id` (`loc_type_id`),
  KEY `loc_type_parent_fk` (`loc_type_parent_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_type
-- ----------------------------
INSERT INTO `location_type` VALUES ('1', '0', 'Country');
INSERT INTO `location_type` VALUES ('2', '1', 'State');
INSERT INTO `location_type` VALUES ('3', '2', 'Post / Zip Code');

-- ----------------------------
-- Table structure for `location_zones`
-- ----------------------------
DROP TABLE IF EXISTS `location_zones`;
CREATE TABLE `location_zones` (
  `lzone_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `lzone_name` varchar(50) NOT NULL,
  `lzone_description` longtext NOT NULL,
  `lzone_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`lzone_id`),
  UNIQUE KEY `lzone_id` (`lzone_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location_zones
-- ----------------------------
INSERT INTO `location_zones` VALUES ('1', 'Shipping Europe Zone 1', 'Example Zone 1 includes France and Germany', '1');
INSERT INTO `location_zones` VALUES ('2', 'Shipping Europe Zone 2', 'Example Zone 2 includes Portugal and Spain', '1');
INSERT INTO `location_zones` VALUES ('3', 'Shipping Europe Zone 3', 'Example Zone 3 includes Norway and Switzerland', '1');
INSERT INTO `location_zones` VALUES ('4', 'Tax EU Zone', 'Example Tax Zone for EU countries', '1');
INSERT INTO `location_zones` VALUES ('5', 'Tax Non EU Zone', 'Example Tax Zone for Non EU European countries', '1');

-- ----------------------------
-- Table structure for `order_details`
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `ord_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_det_order_number_fk` varchar(25) NOT NULL,
  `ord_det_cart_row_id` varchar(32) NOT NULL,
  `ord_det_item_fk` int(11) NOT NULL DEFAULT '0',
  `ord_det_item_name` varchar(255) NOT NULL,
  `ord_det_item_option` varchar(255) NOT NULL,
  `ord_det_quantity` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_non_discount_quantity` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_discount_quantity` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_stock_quantity` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_price` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_price_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_discount_price` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_discount_price_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_discount_description` varchar(255) NOT NULL,
  `ord_det_tax_rate` double(8,4) NOT NULL,
  `ord_det_tax` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_tax_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_shipping_rate` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_weight` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_weight_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_reward_points` int(10) NOT NULL DEFAULT '0',
  `ord_det_reward_points_total` int(10) NOT NULL DEFAULT '0',
  `ord_det_status_message` varchar(255) NOT NULL,
  `ord_det_quantity_shipped` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_quantity_cancelled` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_shipped_date` datetime NOT NULL,
  `ord_det_demo_user_note` varchar(255) NOT NULL,
  `ord_det_demo_sku` varchar(50) NOT NULL,
  PRIMARY KEY (`ord_det_id`),
  UNIQUE KEY `ord_det_id` (`ord_det_id`) USING BTREE,
  KEY `ord_det_order_number_fk` (`ord_det_order_number_fk`) USING BTREE,
  KEY `ord_det_item_fk` (`ord_det_item_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES ('1', '00000001', '38b3eff8baf56627478ec76a704e9b52', '101', 'Item #101, minimum required fields.', '', '3.00', '3.00', '0.00', '0.00', '20.00', '60.00', '20.00', '60.00', '', '20.0000', '3.33', '9.99', '0.00', '0.00', '0.00', '200', '600', '', '2.00', '1.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('2', '00000001', 'ef46c8ba9b7e6f21ef6ec6e3e308d05a', '202', 'Item #202, added via form with options', 'Colour: Red1Size: Small', '1.00', '1.00', '0.00', '0.00', '27.50', '27.50', '27.50', '27.50', '', '20.0000', '4.58', '4.58', '0.00', '0.00', '0.00', '275', '275', '', '1.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('3', '00000002', '7f6ffaa6bb0b408017b62254211691b5', '112', 'Item #112, stock controlled, in-stock.', '', '3.00', '3.00', '0.00', '20.00', '16.99', '50.97', '16.99', '50.97', '', '20.0000', '2.83', '8.49', '0.00', '0.00', '0.00', '170', '510', '', '0.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('4', '00000003', '34ed066df378efacc9b924ec161e7639', '301', 'Discount Item #301, 10% off original price (&pound;24.99).', '', '1.00', '0.00', '1.00', '0.00', '22.91', '22.91', '20.62', '20.62', 'Discount Item #301, 10% off original price (&pound;24.99).', '10.0000', '2.08', '2.08', '0.00', '0.00', '0.00', '229', '229', '', '1.00', '0.00', '0000-00-00 00:00:00', 'Example Note', '');
INSERT INTO `order_details` VALUES ('5', '00000003', 'c81e728d9d4c2f636f067f89cc14862c', '2', 'Example Database Item #2', '', '1.00', '1.00', '0.00', '99.00', '4.54', '4.54', '4.54', '4.54', '', '10.0000', '0.41', '0.41', '0.00', '15.00', '15.00', '45', '45', '', '1.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('6', '00000004', '274ad4786c3abca69fa097b85867d9a4', '204', 'Item #204, added multiple items via form', '', '1.00', '1.00', '0.00', '0.00', '16.48', '16.48', '16.48', '16.48', '', '8.3700', '1.27', '1.27', '0.00', '0.00', '0.00', '165', '165', '', '0.00', '1.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('7', '00000004', '7eabe3a1649ffa2b3ff8c02ebfd5659f', '206', 'Item #206, added multiple items via form', '', '4.00', '4.00', '0.00', '0.00', '27.09', '108.36', '27.09', '108.36', '', '8.3700', '2.09', '8.36', '0.00', '0.00', '0.00', '271', '1084', '', '4.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('8', '00000004', '5fd0b37cd7dbbb00f97ba6ce92bf5add', '114', 'Item #114, specified 1000 reward points.', '', '1.00', '1.00', '0.00', '0.00', '17.15', '17.15', '17.15', '17.15', '', '8.3700', '1.32', '1.32', '0.00', '0.00', '0.00', '1000', '1000', '', '1.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('9', '00000005', '8e98d81f8217304975ccb23337bb5761', '307', 'Discount Item #307, Buy 5 @ &pound;10.00, get 2 for &pound;7.00.', '', '7.00', '5.00', '2.00', '0.00', '10.00', '70.00', '7.00', '64.00', 'Discount Item #307, Buy 5 @ &pound;10.00, get 2 for &pound;7.00.', '20.0000', '1.67', '11.69', '0.00', '0.00', '0.00', '100', '700', '', '7.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('10', '00000006', '4ca5767a4fb196d05c5ac280aa6ab6cc', '203', 'Item #203, added via form with priced options', 'Option #1', '1.00', '1.00', '0.00', '0.00', '16.95', '16.95', '16.95', '16.95', '', '20.0000', '2.83', '2.83', '0.00', '0.00', '0.00', '170', '170', '', '0.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('11', '00000006', '34ed066df378efacc9b924ec161e7639', '301', 'Discount Item #301, 10% off original price (&pound;24.99).', '', '2.00', '0.00', '2.00', '0.00', '24.99', '49.98', '22.49', '44.98', 'Discount Item #301, 10% off original price (&pound;24.99).', '20.0000', '4.17', '8.34', '0.00', '0.00', '0.00', '250', '500', '', '2.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('12', '00000007', 'c4ca4238a0b923820dcc509a6f75849b', '1', 'Example Database Item #1', '', '3.00', '2.00', '1.00', '100.00', '22.92', '68.76', '0.00', '45.84', 'Buy 2, Get 1 Free.', '10.0000', '2.08', '6.24', '0.00', '75.00', '225.00', '229', '687', '', '0.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('13', '00000005', 'c81e728d9d4c2f636f067f89cc14862c', '2', 'Example Database Item #2', '', '2.00', '2.00', '0.00', '98.00', '4.95', '9.90', '4.95', '9.90', '', '20.0000', '0.83', '1.66', '0.00', '15.00', '30.00', '50', '100', '', '2.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('14', '00000008', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '3', 'Example Database Item #3', '', '5.00', '0.00', '5.00', '100.00', '23.02', '115.10', '20.72', '103.60', '10% off original price.', '8.3700', '1.78', '8.90', '0.00', '85.00', '425.00', '0', '0', '', '0.00', '0.00', '0000-00-00 00:00:00', '', '');

-- ----------------------------
-- Table structure for `order_status`
-- ----------------------------
DROP TABLE IF EXISTS `order_status`;
CREATE TABLE `order_status` (
  `ord_status_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `ord_status_description` varchar(50) NOT NULL,
  `ord_status_cancelled` tinyint(1) NOT NULL,
  `ord_status_save_default` tinyint(1) NOT NULL,
  `ord_status_resave_default` tinyint(1) NOT NULL,
  PRIMARY KEY (`ord_status_id`),
  KEY `ord_status_id` (`ord_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_status
-- ----------------------------
INSERT INTO `order_status` VALUES ('1', 'Awaiting Payment', '0', '1', '0');
INSERT INTO `order_status` VALUES ('2', 'New Order', '0', '0', '1');
INSERT INTO `order_status` VALUES ('3', 'Processing Order', '0', '0', '0');
INSERT INTO `order_status` VALUES ('4', 'Order Complete', '0', '0', '0');
INSERT INTO `order_status` VALUES ('5', 'Order Cancelled', '1', '0', '0');

-- ----------------------------
-- Table structure for `order_summary`
-- ----------------------------
DROP TABLE IF EXISTS `order_summary`;
CREATE TABLE `order_summary` (
  `ord_order_number` varchar(25) NOT NULL,
  `ord_cart_data_fk` int(11) NOT NULL DEFAULT '0',
  `ord_user_fk` int(5) NOT NULL DEFAULT '0',
  `ord_item_summary_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_item_summary_savings_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_shipping` varchar(100) NOT NULL,
  `ord_shipping_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_item_shipping_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_summary_discount_desc` varchar(255) NOT NULL,
  `ord_summary_savings_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_savings_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_surcharge_desc` varchar(255) NOT NULL,
  `ord_surcharge_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_reward_voucher_desc` varchar(255) NOT NULL,
  `ord_reward_voucher_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_tax_rate` varchar(25) NOT NULL DEFAULT '',
  `ord_tax_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_total_rows` int(10) NOT NULL DEFAULT '0',
  `ord_total_items` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_total_weight` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_total_reward_points` int(10) NOT NULL DEFAULT '0',
  `ord_currency` varchar(25) NOT NULL,
  `ord_exchange_rate` double(8,4) NOT NULL,
  `ord_status` tinyint(1) NOT NULL,
  `ord_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ord_demo_bill_name` varchar(75) NOT NULL,
  `ord_demo_bill_company` varchar(75) NOT NULL,
  `ord_demo_bill_address_01` varchar(75) NOT NULL,
  `ord_demo_bill_address_02` varchar(75) NOT NULL,
  `ord_demo_bill_city` varchar(50) NOT NULL,
  `ord_demo_bill_state` varchar(50) NOT NULL,
  `ord_demo_bill_post_code` varchar(25) NOT NULL,
  `ord_demo_bill_country` varchar(50) NOT NULL,
  `ord_demo_ship_name` varchar(75) NOT NULL,
  `ord_demo_ship_company` varchar(75) NOT NULL,
  `ord_demo_ship_address_01` varchar(75) NOT NULL,
  `ord_demo_ship_address_02` varchar(75) NOT NULL,
  `ord_demo_ship_city` varchar(50) NOT NULL,
  `ord_demo_ship_state` varchar(50) NOT NULL,
  `ord_demo_ship_post_code` varchar(25) NOT NULL,
  `ord_demo_ship_country` varchar(50) NOT NULL,
  `ord_demo_email` varchar(255) NOT NULL,
  `ord_demo_phone` varchar(25) NOT NULL,
  `ord_demo_comments` longtext NOT NULL,
  PRIMARY KEY (`ord_order_number`),
  UNIQUE KEY `ord_order_number` (`ord_order_number`) USING BTREE,
  KEY `ord_cart_data_fk` (`ord_cart_data_fk`) USING BTREE,
  KEY `ord_user_fk` (`ord_user_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_summary
-- ----------------------------
INSERT INTO `order_summary` VALUES ('00000001', '1', '1', '87.50', '0.00', 'UK Recorded Shipping', '5.10', '92.60', '', '0.00', '0.00', '', '0.00', '', '0.00', '20', '15.43', '92.60', '2', '4.00', '0.00', '875', 'GBP', '1.0000', '4', '0000-00-00 00:00:00', 'Customer #1', '', '404 Oak Tree Road', '', 'Oaktown', 'Norfolk', 'NR1', 'United Kingdom (EU)', 'Customer #1', '', '404 Oak Tree Road', '', 'Oaktown', 'Norfolk', 'NR1', 'United Kingdom (EU)', 'customer1@fake-email-address.com', '0123456789', 'Example customer order comments');
INSERT INTO `order_summary` VALUES ('00000002', '2', '2', '50.97', '0.00', 'UK Standard Shipping', '3.95', '54.92', 'Discount Code \"10-PERCENT\" - 10% off grand total.', '5.49', '5.49', '', '0.00', '', '0.00', '20', '8.24', '49.42', '1', '3.00', '0.00', '510', 'GBP', '1.0000', '5', '0000-00-00 00:00:00', 'Customer #2', '', '301 Kookaburra Close', '', 'Ornington', 'Merseyside', 'L3', 'United Kingdom (EU)', 'Customer #2', '', '55a Lemington Street', '', 'Ornington', 'Merseyside', 'L3', 'United Kingdom (EU)', 'customer2@fake-email-address.com', '0123456789', '');
INSERT INTO `order_summary` VALUES ('00000003', '3', '3', '25.16', '2.29', 'Australia NSW Shipping', '13.66', '38.82', '', '0.00', '2.29', '', '0.00', '', '0.00', '10', '3.53', '38.82', '2', '2.00', '15.00', '274', 'AUD', '2.0000', '4', '0000-00-00 00:00:00', 'Customer #3', '', '42 Wallaby Way', '', 'Sydney', 'NSW', '2000', 'Australia', 'Customer #3', '', '42 Wallaby Way', '', 'Sydney', 'NSW', '2000', 'Australia', 'customer3@fake-email-address.com', '0123456789', '');
INSERT INTO `order_summary` VALUES ('00000004', '4', '4', '141.99', '0.00', 'New York City Shipping', '9.53', '151.52', 'Discount Code \"10-FIXED-RATE\" - &pound;10 off grand total.', '10.00', '10.00', '', '0.00', '', '0.00', '8.37', '10.93', '141.51', '3', '6.00', '0.00', '2249', 'USD', '1.6000', '4', '0000-00-00 00:00:00', 'Customer #4', '', '110 E 59th St ', '', 'New York City', 'New York', '10101', 'United States', 'Customer #4', '', '199 E 59th St ', '', 'New York City', 'New York', '10101', 'United States', 'customer4@fake-email-address.com', '0123465789', 'Example customer order comments');
INSERT INTO `order_summary` VALUES ('00000005', '5', '5', '73.90', '6.00', 'EU Zone 1: Standard Shipping', '7.25', '81.15', '', '0.00', '6.00', '', '0.00', '', '0.00', '20', '13.52', '81.15', '2', '9.00', '30.00', '800', 'GBP', '1.0000', '4', '0000-00-00 00:00:00', 'Customer #5', 'flexi cart', 'Unit 5', '226 Rue Saint-Martin', 'Paris', 'Paris', '75003', 'France (EU)', 'Customer #5', 'flexi cart', 'Unit 5', '226 Rue Saint-Martin', 'Paris', 'Paris', '75003', 'France (EU)', 'customer5@fakeemailaddress.com', '0123456789', '');
INSERT INTO `order_summary` VALUES ('00000006', '6', '1', '61.93', '5.00', 'UK Collection', '0.00', '61.93', '', '0.00', '5.00', '', '0.00', '', '0.00', '20', '10.32', '61.93', '2', '3.00', '0.00', '670', 'GBP', '1.0000', '3', '0000-00-00 00:00:00', 'Customer #1', '', '404 Oak Tree Road', '', 'Oaktown', 'Norfolk', 'NR1', 'United Kingdom (EU)', 'Customer #1', '', '404 Oak Tree Road', '', 'Oaktown', 'Norfolk', 'NR1', 'United Kingdom (EU)', 'customer1@fake-email-address.com', '0123456798', '');
INSERT INTO `order_summary` VALUES ('00000007', '7', '3', '45.84', '22.92', 'Australia NSW Shipping', '13.66', '59.50', 'Discount Code \"10-PERCENT\" - 10% off grand total.', '5.95', '28.87', '', '0.00', '', '0.00', '10', '4.87', '53.55', '1', '3.00', '225.00', '687', 'GBP', '1.0000', '2', '0000-00-00 00:00:00', 'Customer #3', '', '42 Wallaby Way', '', 'Sydney', 'NSW', '2000', 'Australia', 'Customer #3', '', '42 Wallaby Way', '', 'Sydney', 'NSW', '2000', 'Australia', 'customer3@fake-email-address.com', '0123465789', '');
INSERT INTO `order_summary` VALUES ('00000008', '8', '4', '103.60', '11.50', 'New York State Shipping', '11.96', '115.56', '', '0.00', '21.50', '', '0.00', 'Reward Voucher: 088F148041B66A9', '10.00', '8.37', '8.16', '105.57', '1', '5.00', '425.00', '0', 'GBP', '1.0000', '2', '0000-00-00 00:00:00', 'Customer #4', '', '110 E 59th St', '', 'New York City', 'New York', '10101', 'United States', 'Customer #4', '', '110 E 59th St', '', 'New York City', 'New York', '10101', 'United States', 'customer4@fake-email-address.com', '0123456789', '');

-- ----------------------------
-- Table structure for `reward_points_converted`
-- ----------------------------
DROP TABLE IF EXISTS `reward_points_converted`;
CREATE TABLE `reward_points_converted` (
  `rew_convert_id` int(10) NOT NULL AUTO_INCREMENT,
  `rew_convert_ord_detail_fk` int(10) NOT NULL,
  `rew_convert_discount_fk` varchar(50) NOT NULL,
  `rew_convert_points` int(10) NOT NULL,
  `rew_convert_date` datetime NOT NULL,
  PRIMARY KEY (`rew_convert_id`),
  UNIQUE KEY `rew_convert_id` (`rew_convert_id`) USING BTREE,
  KEY `rew_convert_discount_fk` (`rew_convert_discount_fk`),
  KEY `rew_convert_ord_detail_fk` (`rew_convert_ord_detail_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reward_points_converted
-- ----------------------------
INSERT INTO `reward_points_converted` VALUES ('1', '1', '35', '400', '0000-00-00 00:00:00');
INSERT INTO `reward_points_converted` VALUES ('2', '2', '35', '100', '0000-00-00 00:00:00');
INSERT INTO `reward_points_converted` VALUES ('3', '7', '36', '1000', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `shipping_item_rules`
-- ----------------------------
DROP TABLE IF EXISTS `shipping_item_rules`;
CREATE TABLE `shipping_item_rules` (
  `ship_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `ship_item_item_fk` int(11) NOT NULL,
  `ship_item_location_fk` smallint(5) NOT NULL,
  `ship_item_zone_fk` smallint(5) NOT NULL,
  `ship_item_value` double(8,4) DEFAULT NULL,
  `ship_item_separate` tinyint(1) NOT NULL COMMENT 'Indicate if item should have a shipping rate calculated specifically for it.',
  `ship_item_banned` tinyint(1) NOT NULL,
  `ship_item_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ship_item_id`),
  UNIQUE KEY `ship_item_id` (`ship_item_id`) USING BTREE,
  KEY `ship_item_zone_fk` (`ship_item_zone_fk`) USING BTREE,
  KEY `ship_item_location_fk` (`ship_item_location_fk`) USING BTREE,
  KEY `ship_item_item_fk` (`ship_item_item_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of shipping_item_rules
-- ----------------------------
INSERT INTO `shipping_item_rules` VALUES ('1', '104', '1', '0', '0.0000', '0', '0', '1');
INSERT INTO `shipping_item_rules` VALUES ('2', '106', '0', '0', null, '1', '0', '1');
INSERT INTO `shipping_item_rules` VALUES ('3', '107', '1', '0', null, '0', '1', '1');
INSERT INTO `shipping_item_rules` VALUES ('4', '108', '1', '0', null, '0', '2', '1');
INSERT INTO `shipping_item_rules` VALUES ('5', '108', '2', '0', null, '0', '2', '1');

-- ----------------------------
-- Table structure for `shipping_options`
-- ----------------------------
DROP TABLE IF EXISTS `shipping_options`;
CREATE TABLE `shipping_options` (
  `ship_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `ship_name` varchar(50) NOT NULL,
  `ship_description` varchar(50) NOT NULL,
  `ship_location_fk` smallint(5) NOT NULL,
  `ship_zone_fk` smallint(5) NOT NULL,
  `ship_inc_sub_locations` tinyint(1) NOT NULL,
  `ship_tax_rate` double(7,4) DEFAULT NULL,
  `ship_discount_inclusion` tinyint(1) NOT NULL,
  `ship_status` tinyint(1) NOT NULL,
  `ship_default` tinyint(1) NOT NULL,
  PRIMARY KEY (`ship_id`),
  UNIQUE KEY `ship_id` (`ship_id`) USING BTREE,
  KEY `ship_zone_fk` (`ship_zone_fk`) USING BTREE,
  KEY `ship_location_fk` (`ship_location_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of shipping_options
-- ----------------------------
INSERT INTO `shipping_options` VALUES ('1', 'UK Standard Shipping', '2-3 Days', '1', '0', '0', null, '1', '1', '1');
INSERT INTO `shipping_options` VALUES ('2', 'UK Recorded Shipping', '2-3 Days', '1', '0', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('3', 'UK Special Shipping', 'Next Day', '1', '0', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('4', 'UK Collection', 'Available Next Day', '1', '0', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('5', 'EU Zone 1: Standard Shipping', '3-4 Days', '0', '1', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('6', 'EU Zone 1: Special Shipping', '1-2 Days', '0', '1', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('7', 'EU Zone 2: Standard Shipping', '4-6 Days', '0', '2', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('8', 'EU Zone 2: Special Shipping', '2-4 Days', '0', '2', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('9', 'EU Zone 3: Standard Shipping', '5-8 Days', '0', '3', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('10', 'EU Zone 3: Special Shipping', '3-5 Days', '0', '3', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('11', 'Australia (Non NSW) Shipping', '12 Days', '8', '0', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('12', 'Australia NSW Shipping', '10 Days', '11', '0', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('13', 'Canada Shipping', '8 Days', '9', '0', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('14', 'United States (Non CA or NY) Shipping', '8 Days', '10', '0', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('15', 'New York State Shipping', '6 Days', '16', '0', '1', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('16', 'California State Shipping', '8 Days', '14', '0', '0', null, '0', '1', '0');
INSERT INTO `shipping_options` VALUES ('17', 'New York City Shipping', '6 Days', '18', '0', '0', null, '0', '1', '0');

-- ----------------------------
-- Table structure for `shipping_rates`
-- ----------------------------
DROP TABLE IF EXISTS `shipping_rates`;
CREATE TABLE `shipping_rates` (
  `ship_rate_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `ship_rate_ship_fk` smallint(5) NOT NULL,
  `ship_rate_value` double(8,2) NOT NULL,
  `ship_rate_tare_wgt` double(8,2) NOT NULL,
  `ship_rate_min_wgt` double(8,2) NOT NULL DEFAULT '0.00',
  `ship_rate_max_wgt` double(8,2) NOT NULL DEFAULT '9999.00',
  `ship_rate_min_value` double(10,2) NOT NULL DEFAULT '0.00',
  `ship_rate_max_value` double(10,2) NOT NULL DEFAULT '9999.00',
  `ship_rate_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ship_rate_id`),
  UNIQUE KEY `ship_rate_id` (`ship_rate_id`) USING BTREE,
  KEY `ship_rate_ship_fk` (`ship_rate_ship_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of shipping_rates
-- ----------------------------
INSERT INTO `shipping_rates` VALUES ('1', '1', '3.95', '2.00', '0.00', '50.00', '0.00', '500.00', '1');
INSERT INTO `shipping_rates` VALUES ('2', '1', '4.50', '2.00', '50.00', '150.00', '0.00', '500.00', '1');
INSERT INTO `shipping_rates` VALUES ('3', '1', '5.25', '2.00', '150.00', '500.00', '0.00', '500.00', '1');
INSERT INTO `shipping_rates` VALUES ('4', '2', '5.10', '2.00', '0.00', '50.00', '0.00', '500.00', '1');
INSERT INTO `shipping_rates` VALUES ('5', '2', '5.75', '2.00', '50.00', '150.00', '0.00', '500.00', '1');
INSERT INTO `shipping_rates` VALUES ('6', '2', '6.40', '2.00', '150.00', '500.00', '0.00', '500.00', '1');
INSERT INTO `shipping_rates` VALUES ('7', '3', '7.50', '10.00', '0.00', '500.00', '0.00', '1000.00', '1');
INSERT INTO `shipping_rates` VALUES ('8', '3', '10.95', '10.00', '500.00', '0.00', '0.00', '9999.00', '1');
INSERT INTO `shipping_rates` VALUES ('9', '4', '0.00', '10.00', '0.00', '0.00', '0.00', '9999.00', '1');
INSERT INTO `shipping_rates` VALUES ('10', '5', '7.25', '10.00', '0.00', '250.00', '0.00', '500.00', '1');
INSERT INTO `shipping_rates` VALUES ('11', '6', '15.75', '10.00', '0.00', '0.00', '0.00', '0.00', '1');
INSERT INTO `shipping_rates` VALUES ('12', '7', '7.75', '10.00', '0.00', '250.00', '0.00', '500.00', '1');
INSERT INTO `shipping_rates` VALUES ('13', '8', '16.25', '10.00', '0.00', '0.00', '0.00', '0.00', '1');
INSERT INTO `shipping_rates` VALUES ('14', '9', '8.50', '10.00', '0.00', '250.00', '0.00', '500.00', '1');
INSERT INTO `shipping_rates` VALUES ('15', '10', '20.10', '0.00', '0.00', '0.00', '0.00', '0.00', '1');
INSERT INTO `shipping_rates` VALUES ('16', '11', '16.50', '10.00', '0.00', '0.00', '0.00', '0.00', '1');
INSERT INTO `shipping_rates` VALUES ('17', '12', '14.90', '10.00', '0.00', '0.00', '0.00', '0.00', '1');
INSERT INTO `shipping_rates` VALUES ('18', '13', '14.50', '10.00', '0.00', '0.00', '0.00', '0.00', '1');
INSERT INTO `shipping_rates` VALUES ('19', '14', '14.50', '10.00', '0.00', '0.00', '0.00', '0.00', '1');
INSERT INTO `shipping_rates` VALUES ('20', '15', '13.25', '10.00', '0.00', '0.00', '0.00', '0.00', '1');
INSERT INTO `shipping_rates` VALUES ('21', '16', '15.30', '10.00', '0.00', '0.00', '0.00', '0.00', '1');
INSERT INTO `shipping_rates` VALUES ('22', '17', '10.55', '10.00', '0.00', '0.00', '0.00', '0.00', '1');

-- ----------------------------
-- Table structure for `tax`
-- ----------------------------
DROP TABLE IF EXISTS `tax`;
CREATE TABLE `tax` (
  `tax_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `tax_location_fk` smallint(5) NOT NULL,
  `tax_zone_fk` smallint(5) NOT NULL,
  `tax_name` varchar(25) NOT NULL,
  `tax_rate` double(7,4) NOT NULL,
  `tax_status` tinyint(1) NOT NULL,
  `tax_default` tinyint(1) NOT NULL,
  PRIMARY KEY (`tax_id`),
  UNIQUE KEY `tax_id` (`tax_id`),
  KEY `tax_zone_fk` (`tax_zone_fk`),
  KEY `tax_location_fk` (`tax_location_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tax
-- ----------------------------
INSERT INTO `tax` VALUES ('1', '0', '4', 'VAT', '20.0000', '1', '1');
INSERT INTO `tax` VALUES ('2', '0', '5', 'No Tax (Non EU)', '0.0000', '1', '0');
INSERT INTO `tax` VALUES ('3', '16', '0', 'Tax New York', '4.0000', '1', '0');
INSERT INTO `tax` VALUES ('4', '14', '0', 'Tax California', '8.2500', '1', '0');
INSERT INTO `tax` VALUES ('5', '10', '0', 'Tax (Other US)', '6.0000', '1', '0');
INSERT INTO `tax` VALUES ('6', '18', '0', 'Tax New York City', '8.3700', '1', '0');
INSERT INTO `tax` VALUES ('7', '8', '0', 'GST', '10.0000', '1', '0');
INSERT INTO `tax` VALUES ('8', '9', '0', 'HST', '8.0000', '1', '0');

-- ----------------------------
-- Table structure for `tax_item_rates`
-- ----------------------------
DROP TABLE IF EXISTS `tax_item_rates`;
CREATE TABLE `tax_item_rates` (
  `tax_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_item_item_fk` int(11) NOT NULL,
  `tax_item_location_fk` smallint(5) NOT NULL,
  `tax_item_zone_fk` smallint(5) NOT NULL,
  `tax_item_rate` double(7,4) NOT NULL,
  `tax_item_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`tax_item_id`),
  UNIQUE KEY `tax_item_id` (`tax_item_id`) USING BTREE,
  KEY `tax_item_zone_fk` (`tax_item_zone_fk`),
  KEY `tax_item_location_fk` (`tax_item_location_fk`),
  KEY `tax_item_item_fk` (`tax_item_item_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tax_item_rates
-- ----------------------------
INSERT INTO `tax_item_rates` VALUES ('1', '110', '0', '0', '0.0000', '1');

-- ----------------------------
-- Update dates and times
-- ----------------------------

/* Order Summary */
UPDATE order_summary SET ord_date = DATE_SUB(CURDATE(), INTERVAL 3456789 SECOND) WHERE ord_order_number = 00000001;
UPDATE order_summary SET ord_date = DATE_SUB(CURDATE(), INTERVAL 3206547 SECOND) WHERE ord_order_number = 00000002;
UPDATE order_summary SET ord_date = DATE_SUB(CURDATE(), INTERVAL 2806478 SECOND) WHERE ord_order_number = 00000003;
UPDATE order_summary SET ord_date = DATE_SUB(CURDATE(), INTERVAL 2409837 SECOND) WHERE ord_order_number = 00000004;
UPDATE order_summary SET ord_date = DATE_SUB(CURDATE(), INTERVAL 1617987 SECOND) WHERE ord_order_number = 00000005;
UPDATE order_summary SET ord_date = DATE_SUB(CURDATE(), INTERVAL 1013354 SECOND) WHERE ord_order_number = 00000006;
UPDATE order_summary SET ord_date = DATE_SUB(CURDATE(), INTERVAL 513354 SECOND) WHERE ord_order_number = 00000007;
UPDATE order_summary SET ord_date = DATE_SUB(CURDATE(), INTERVAL 95848 SECOND) WHERE ord_order_number = 00000008;

/* Order Details */
UPDATE order_details SET ord_det_shipped_date = DATE_SUB(CURDATE(), INTERVAL 3123456 SECOND) WHERE ord_det_id = 1;
UPDATE order_details SET ord_det_shipped_date = DATE_SUB(CURDATE(), INTERVAL 3123456 SECOND) WHERE ord_det_id = 2;
UPDATE order_details SET ord_det_shipped_date = 0 WHERE ord_det_id = 3;
UPDATE order_details SET ord_det_shipped_date = DATE_SUB(CURDATE(), INTERVAL 2564798 SECOND) WHERE ord_det_id = 4;
UPDATE order_details SET ord_det_shipped_date = DATE_SUB(CURDATE(), INTERVAL 2564798 SECOND) WHERE ord_det_id = 5;
UPDATE order_details SET ord_det_shipped_date = 0 WHERE ord_det_id = 6;
UPDATE order_details SET ord_det_shipped_date = DATE_SUB(CURDATE(), INTERVAL 1997894 SECOND) WHERE ord_det_id = 7;
UPDATE order_details SET ord_det_shipped_date = DATE_SUB(CURDATE(), INTERVAL 1997894 SECOND) WHERE ord_det_id = 8;
UPDATE order_details SET ord_det_shipped_date = DATE_SUB(CURDATE(), INTERVAL 1600148 SECOND) WHERE ord_det_id = 9;
UPDATE order_details SET ord_det_shipped_date = 0 WHERE ord_det_id = 10;
UPDATE order_details SET ord_det_shipped_date = DATE_SUB(CURDATE(), INTERVAL 785437 SECOND) WHERE ord_det_id = 11;
UPDATE order_details SET ord_det_shipped_date = 0 WHERE ord_det_id = 12;
UPDATE order_details SET ord_det_shipped_date = DATE_SUB(CURDATE(), INTERVAL 1600148 SECOND) WHERE ord_det_id = 13;
UPDATE order_details SET ord_det_shipped_date = 0 WHERE ord_det_id = 14;

/* Cart Data */
UPDATE cart_data SET cart_data_date = DATE_SUB(CURDATE(), INTERVAL 3456789 SECOND) WHERE cart_data_id = 1;
UPDATE cart_data SET cart_data_date = DATE_SUB(CURDATE(), INTERVAL 3206547 SECOND) WHERE cart_data_id = 2;
UPDATE cart_data SET cart_data_date = DATE_SUB(CURDATE(), INTERVAL 2806478 SECOND) WHERE cart_data_id = 3;
UPDATE cart_data SET cart_data_date = DATE_SUB(CURDATE(), INTERVAL 2409837 SECOND) WHERE cart_data_id = 4;
UPDATE cart_data SET cart_data_date = DATE_SUB(CURDATE(), INTERVAL 1617987 SECOND) WHERE cart_data_id = 5;
UPDATE cart_data SET cart_data_date = DATE_SUB(CURDATE(), INTERVAL 1013354 SECOND) WHERE cart_data_id = 6;
UPDATE cart_data SET cart_data_date = DATE_SUB(CURDATE(), INTERVAL 513354 SECOND) WHERE cart_data_id = 7;
UPDATE cart_data SET cart_data_date = DATE_SUB(CURDATE(), INTERVAL 95848 SECOND) WHERE cart_data_id = 8;
UPDATE cart_data SET cart_data_date = DATE_SUB(CURDATE(), INTERVAL 76548 SECOND) WHERE cart_data_id = 9;
UPDATE cart_data SET cart_data_date = DATE_SUB(CURDATE(), INTERVAL 50005 SECOND) WHERE cart_data_id = 10;

/* Discounts */
UPDATE discounts SET disc_valid_date = DATE_SUB(CURDATE(), interval 7 day), disc_expire_date = DATE_ADD(CURDATE(), interval 15 day);

/* Reward Points Converted */
UPDATE reward_points_converted SET rew_convert_date = DATE_SUB(CURDATE(), INTERVAL 7 DAY);

/* Reward Vouchers */
UPDATE discounts SET disc_expire_date = DATE_ADD(CURDATE(), interval 1 year) WHERE disc_id IN (35,36);
