/*
  flexi_cart_demo_database_dump.sql
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cart_config`
-- ----------------------------
DROP TABLE IF EXISTS `cart_config`;
CREATE TABLE `cart_config` (
  `config_id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `config_order_number_prefix` varchar(50) NOT NULL DEFAULT '',
  `config_order_number_suffix` varchar(50) NOT NULL DEFAULT '',
  `config_increment_order_number` tinyint(1) NOT NULL DEFAULT '0',
  `config_min_order` smallint(5) NOT NULL DEFAULT '0',
  `config_quantity_decimals` tinyint(1) NOT NULL DEFAULT '0',
  `config_quantity_limited_by_stock` tinyint(1) NOT NULL DEFAULT '0',
  `config_increment_duplicate_items` tinyint(1) NOT NULL DEFAULT '0',
  `config_remove_no_stock_items` tinyint(1) NOT NULL DEFAULT '0',
  `config_auto_allocate_stock` tinyint(1) NOT NULL DEFAULT '0',
  `config_save_ban_shipping_items` tinyint(1) NOT NULL DEFAULT '0',
  `config_weight_type` varchar(25) NOT NULL DEFAULT '',
  `config_weight_decimals` tinyint(1) NOT NULL DEFAULT '0',
  `config_display_tax_prices` tinyint(1) NOT NULL DEFAULT '0',
  `config_price_inc_tax` tinyint(1) NOT NULL DEFAULT '0',
  `config_multi_row_duplicate_items` tinyint(1) NOT NULL DEFAULT '0',
  `config_dynamic_reward_points` tinyint(1) NOT NULL DEFAULT '0',
  `config_reward_point_multiplier` double(8,4) NOT NULL DEFAULT '0',
  `config_reward_voucher_multiplier` double(8,4) NOT NULL DEFAULT '0',
  `config_reward_voucher_ratio` smallint(5) NOT NULL DEFAULT '0',
  `config_reward_point_days_pending` smallint(5) NOT NULL DEFAULT '0',
  `config_reward_point_days_valid` smallint(5) NOT NULL DEFAULT '0',
  `config_reward_voucher_days_valid` smallint(5) NOT NULL DEFAULT '0',
  `config_custom_status_1` varchar(50) NOT NULL DEFAULT '',
  `config_custom_status_2` varchar(50) NOT NULL DEFAULT '',
  `config_custom_status_3` varchar(50) NOT NULL DEFAULT '',
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
  `cart_data_user_fk` int(11) NOT NULL DEFAULT '0',
  `cart_data_array` text NOT NULL DEFAULT '',
  `cart_data_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cart_data_readonly_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cart_data_id`),
  UNIQUE KEY `cart_data_id` (`cart_data_id`) USING BTREE,
  KEY `cart_data_user_fk` (`cart_data_user_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cart_data
-- ----------------------------
INSERT INTO `cart_data` VALUES ('1', '1', 'a:3:{s:5:\"items\";a:1:{s:32:\"38b3eff8baf56627478ec76a704e9b52\";a:15:{s:6:\"row_id\";s:32:\"38b3eff8baf56627478ec76a704e9b52\";s:2:\"id\";i:101;s:4:\"name\";s:35:\"Item #101, minimum required fields.\";s:8:\"quantity\";d:1;s:5:\"price\";d:20;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:20;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:3.333299999999999929656269159750081598758697509765625;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:1;s:11:\"total_items\";d:1;s:12:\"total_weight\";d:0;s:19:\"total_reward_points\";d:200;s:18:\"item_summary_total\";d:20;s:14:\"shipping_total\";d:3.95000000000000017763568394002504646778106689453125;s:9:\"tax_total\";d:3.987999999999999989341858963598497211933135986328125;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:23.949999999999999289457264239899814128875732421875;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:20:\"UK Standard Shipping\";s:11:\"description\";s:8:\"2-3 Days\";s:5:\"value\";s:4:\"3.95\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:3.333299999999999929656269159750081598758697509765625;s:12:\"shipping_tax\";d:0.65800000000000002930988785010413266718387603759765625;s:17:\"item_discount_tax\";d:0;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:3.99129999999999984794385454733856022357940673828125;s:18:\"cart_taxable_value\";d:19.9566999999999978854248183779418468475341796875;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:0:{}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:0;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:1:\"0\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:1;s:12:\"order_number\";s:8:\"00000001\";}}}', '2012-04-09 23:46:51', '1');
INSERT INTO `cart_data` VALUES ('2', '1', 'a:3:{s:5:\"items\";a:2:{s:32:\"62b3e8cbab25f7c393a0996f39d4a9f6\";a:17:{s:6:\"row_id\";s:32:\"62b3e8cbab25f7c393a0996f39d4a9f6\";s:2:\"id\";s:3:\"202\";s:4:\"name\";s:38:\"Item #202, added via form with options\";s:8:\"quantity\";d:2;s:5:\"price\";d:27.5;s:7:\"options\";a:2:{s:6:\"Colour\";s:4:\"Blue\";s:4:\"Size\";s:6:\"Medium\";}s:11:\"option_data\";a:2:{s:6:\"Colour\";a:3:{i:0;s:3:\"Red\";i:1;s:5:\"Green\";i:2;s:4:\"Blue\";}s:4:\"Size\";a:3:{i:0;s:5:\"Small\";i:1;s:6:\"Medium\";i:2;s:5:\"Large\";}}s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:27.5;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:4.58330000000000037374547900981269776821136474609375;}s:32:\"6974ce5ac660610b44d9b9fed0ff9548\";a:15:{s:6:\"row_id\";s:32:\"6974ce5ac660610b44d9b9fed0ff9548\";s:2:\"id\";i:103;s:4:\"name\";s:25:\"Item #103, free shipping.\";s:8:\"quantity\";d:1;s:5:\"price\";d:19.949999999999999289457264239899814128875732421875;s:13:\"shipping_rate\";d:0;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:19.949999999999999289457264239899814128875732421875;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:3.32500000000000017763568394002504646778106689453125;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:2;s:11:\"total_items\";d:3;s:12:\"total_weight\";d:0;s:19:\"total_reward_points\";d:750;s:18:\"item_summary_total\";d:74.9500000000000028421709430404007434844970703125;s:14:\"shipping_total\";d:5.0999999999999996447286321199499070644378662109375;s:9:\"tax_total\";d:13.339999999999999857891452847979962825775146484375;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:80.0499999999999971578290569595992565155029296875;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:20:\"UK Recorded Shipping\";s:11:\"description\";s:8:\"2-3 Days\";s:5:\"value\";s:4:\"5.10\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";d:1;s:10:\"free_value\";d:19.949999999999999289457264239899814128875732421875;s:11:\"free_weight\";d:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:1:{s:32:\"6974ce5ac660610b44d9b9fed0ff9548\";d:0;}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:12.4916999999999998038902049302123486995697021484375;s:12:\"shipping_tax\";d:0.84999999999999997779553950749686919152736663818359375;s:17:\"item_discount_tax\";d:0;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:13.341699999999999448618837050162255764007568359375;s:18:\"cart_taxable_value\";d:66.7083999999999974761522025801241397857666015625;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:0:{}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:0;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:1:\"0\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:2;s:12:\"order_number\";s:8:\"00000002\";}}}', '2012-04-12 21:17:33', '1');
INSERT INTO `cart_data` VALUES ('3', '1', 'a:3:{s:5:\"items\";a:4:{s:32:\"0768281a05da9f27df178b5c39a51263\";a:15:{s:6:\"row_id\";s:32:\"0768281a05da9f27df178b5c39a51263\";s:2:\"id\";i:1021;s:4:\"name\";s:35:\"Item #1021, multiple items at once.\";s:8:\"quantity\";d:1;s:5:\"price\";d:20.629999999999999005240169935859739780426025390625;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:22.5;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:1.8754999999999999449329379785922355949878692626953125;}s:32:\"93d65641ff3f1586614cf2c1ad240b6c\";a:15:{s:6:\"row_id\";s:32:\"93d65641ff3f1586614cf2c1ad240b6c\";s:2:\"id\";i:1022;s:4:\"name\";s:35:\"Item #1022, multiple items at once.\";s:8:\"quantity\";d:2;s:5:\"price\";d:32.9500000000000028421709430404007434844970703125;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:35.9500000000000028421709430404007434844970703125;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:2.99549999999999982946974341757595539093017578125;}s:32:\"ce5140df15d046a66883807d18d0264b\";a:15:{s:6:\"row_id\";s:32:\"ce5140df15d046a66883807d18d0264b\";s:2:\"id\";i:1023;s:4:\"name\";s:35:\"Item #1023, multiple items at once.\";s:8:\"quantity\";d:1;s:5:\"price\";d:14.6699999999999999289457264239899814128875732421875;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:16;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:1.3335999999999998966160319469054229557514190673828125;}s:32:\"7f6ffaa6bb0b408017b62254211691b5\";a:15:{s:6:\"row_id\";s:32:\"7f6ffaa6bb0b408017b62254211691b5\";s:2:\"id\";i:112;s:4:\"name\";s:38:\"Item #112, stock controlled, in-stock.\";s:8:\"quantity\";d:1;s:5:\"price\";d:15.57000000000000028421709430404007434844970703125;s:14:\"stock_quantity\";s:2:\"20\";s:14:\"internal_price\";d:16.989999999999998436805981327779591083526611328125;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:1.4154999999999999804600747665972448885440826416015625;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:4;s:11:\"total_items\";d:5;s:12:\"total_weight\";d:0;s:19:\"total_reward_points\";d:1169;s:18:\"item_summary_total\";d:116.7699999999999960209606797434389591217041015625;s:14:\"shipping_total\";d:13.660000000000000142108547152020037174224853515625;s:9:\"tax_total\";d:11.861999999999998323119143606163561344146728515625;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:130.43000000000000682121026329696178436279296875;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:2:\"12\";s:4:\"name\";s:22:\"Australia NSW Shipping\";s:11:\"description\";s:7:\"10 Days\";s:5:\"value\";s:5:\"14.90\";s:8:\"tax_rate\";N;s:8:\"location\";a:2:{i:0;a:5:{s:11:\"location_id\";s:2:\"11\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:1:\"8\";s:4:\"name\";s:3:\"NSW\";}i:1;a:5:{s:11:\"location_id\";s:1:\"8\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:9:\"Australia\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"GST\";s:4:\"rate\";s:7:\"10.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:2:{i:0;a:5:{s:11:\"location_id\";s:2:\"11\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:1:\"8\";s:4:\"name\";s:3:\"NSW\";}i:1;a:5:{s:11:\"location_id\";s:1:\"8\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:9:\"Australia\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:10.615500000000000824229573481716215610504150390625;s:12:\"shipping_tax\";d:1.24199999999999999289457264239899814128875732421875;s:17:\"item_discount_tax\";d:0;s:20:\"summary_discount_tax\";d:1.1857000000000113004716695286333560943603515625;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:10.6743000000000005655920176650397479534149169921875;s:18:\"cart_taxable_value\";d:106.715699999999998226485331542789936065673828125;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:1:{s:10:\"10-PERCENT\";a:3:{s:2:\"id\";s:1:\"2\";s:4:\"code\";s:10:\"10-PERCENT\";s:11:\"description\";s:49:\"Discount Code \"10-PERCENT\" - 10% off grand total.\";}}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:0:{}s:14:\"active_summary\";a:1:{s:5:\"total\";a:5:{s:2:\"id\";s:1:\"2\";s:4:\"code\";s:10:\"10-PERCENT\";s:11:\"description\";s:49:\"Discount Code \"10-PERCENT\" - 10% off grand total.\";s:9:\"tax_value\";d:1.1857000000000113004716695286333560943603515625;s:5:\"value\";d:13.0400000000000062527760746888816356658935546875;}}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:0;s:24:\"summary_discount_savings\";d:13.0400000000000062527760746888816356658935546875;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:1:\"0\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:3;s:12:\"order_number\";s:8:\"00000003\";}}}', '2012-04-17 12:25:22', '1');
INSERT INTO `cart_data` VALUES ('4', '1', 'a:3:{s:5:\"items\";a:2:{s:32:\"37bc2f75bf1bcfe8450a1a41c200364c\";a:15:{s:6:\"row_id\";s:32:\"37bc2f75bf1bcfe8450a1a41c200364c\";s:2:\"id\";i:304;s:4:\"name\";s:38:\"Discount Item #304, Buy 2, get 1 free.\";s:8:\"quantity\";d:3;s:5:\"price\";d:9.0299999999999993605115378159098327159881591796875;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:10;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:0.6974000000000000198951966012828052043914794921875;}s:32:\"c4ca4238a0b923820dcc509a6f75849b\";a:15:{s:6:\"row_id\";s:32:\"c4ca4238a0b923820dcc509a6f75849b\";s:2:\"id\";i:1;s:4:\"name\";s:24:\"Example Database Item #1\";s:8:\"quantity\";d:1;s:5:\"price\";d:22.5799999999999982946974341757595539093017578125;s:6:\"weight\";d:75;s:14:\"stock_quantity\";s:3:\"100\";s:14:\"internal_price\";d:25;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:1.7439999999999999946709294817992486059665679931640625;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:2;s:11:\"total_items\";d:4;s:12:\"total_weight\";d:75;s:19:\"total_reward_points\";d:496;s:18:\"item_summary_total\";d:49.6700000000000017053025658242404460906982421875;s:14:\"shipping_total\";d:11.96000000000000085265128291212022304534912109375;s:9:\"tax_total\";d:4.76400000000000023447910280083306133747100830078125;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:61.63000000000000255795384873636066913604736328125;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:2:\"15\";s:4:\"name\";s:23:\"New York State Shipping\";s:11:\"description\";s:6:\"6 Days\";s:5:\"value\";s:5:\"13.25\";s:8:\"tax_rate\";N;s:8:\"location\";a:3:{i:0;a:5:{s:11:\"location_id\";s:2:\"18\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"3\";s:9:\"parent_id\";s:2:\"16\";s:4:\"name\";s:5:\"10101\";}i:1;a:5:{s:11:\"location_id\";s:2:\"16\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:2:\"10\";s:4:\"name\";s:8:\"New York\";}i:2;a:5:{s:11:\"location_id\";s:2:\"10\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:13:\"United States\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:17:\"Tax New York City\";s:4:\"rate\";s:6:\"8.3700\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:3:{i:0;a:5:{s:11:\"location_id\";s:2:\"18\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"3\";s:9:\"parent_id\";s:2:\"16\";s:4:\"name\";s:5:\"10101\";}i:1;a:5:{s:11:\"location_id\";s:2:\"16\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:2:\"10\";s:4:\"name\";s:8:\"New York\";}i:2;a:5:{s:11:\"location_id\";s:2:\"10\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:13:\"United States\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:3.836300000000000043343106881366111338138580322265625;s:12:\"shipping_tax\";d:0.92400000000000004352074256530613638460636138916015625;s:17:\"item_discount_tax\";d:0.6974000000000000198951966012828052043914794921875;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:4.06289999999999995594635038287378847599029541015625;s:18:\"cart_taxable_value\";d:48.54119999999999635065250913612544536590576171875;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:1:{s:32:\"37bc2f75bf1bcfe8450a1a41c200364c\";a:7:{s:2:\"id\";i:10;s:11:\"description\";s:38:\"Discount Item #304, Buy 2, get 1 free.\";s:17:\"discount_quantity\";d:1;s:21:\"non_discount_quantity\";d:2;s:9:\"tax_value\";d:0;s:5:\"value\";d:9.0299999999999993605115378159098327159881591796875;s:17:\"shipping_discount\";b:0;}}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:9.0299999999999993605115378159098327159881591796875;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:1:\"0\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:4;s:12:\"order_number\";s:8:\"00000004\";}}}', '2012-04-22 02:36:03', '1');
INSERT INTO `cart_data` VALUES ('5', '1', 'a:3:{s:5:\"items\";a:3:{s:32:\"c81e728d9d4c2f636f067f89cc14862c\";a:15:{s:6:\"row_id\";s:32:\"c81e728d9d4c2f636f067f89cc14862c\";s:2:\"id\";s:1:\"2\";s:4:\"name\";s:24:\"Example Database Item #2\";s:8:\"quantity\";d:1;s:5:\"price\";d:4.95000000000000017763568394002504646778106689453125;s:6:\"weight\";d:15;s:14:\"stock_quantity\";s:3:\"100\";s:14:\"internal_price\";d:4.95000000000000017763568394002504646778106689453125;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:0.8249999999999999555910790149937383830547332763671875;}s:32:\"8ba32330170ca729c650f411edf3777e\";a:16:{s:6:\"row_id\";s:32:\"8ba32330170ca729c650f411edf3777e\";s:2:\"id\";i:115;s:4:\"name\";s:19:\"Item #115, options.\";s:8:\"quantity\";d:1;s:5:\"price\";d:79.4899999999999948840923025272786617279052734375;s:7:\"options\";a:2:{s:14:\"Option Type #1\";s:9:\"Option #1\";s:14:\"Option Type #2\";s:9:\"Option #2\";}s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:79.4899999999999948840923025272786617279052734375;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:13.248300000000000409272615797817707061767578125;}s:32:\"2723d092b63885e0d7c260cc007e8b9d\";a:15:{s:6:\"row_id\";s:32:\"2723d092b63885e0d7c260cc007e8b9d\";s:2:\"id\";i:109;s:4:\"name\";s:26:\"Item #109, defined weight.\";s:8:\"quantity\";d:1;s:5:\"price\";d:55;s:6:\"weight\";d:138;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:55;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:9.1667000000000005144329406903125345706939697265625;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:3;s:11:\"total_items\";d:3;s:12:\"total_weight\";d:153;s:19:\"total_reward_points\";d:1395;s:18:\"item_summary_total\";d:139.43999999999999772626324556767940521240234375;s:14:\"shipping_total\";d:7.25;s:9:\"tax_total\";d:24.447999999999996845190253225155174732208251953125;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:146.68999999999999772626324556767940521240234375;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"5\";s:4:\"name\";s:28:\"EU Zone 1: Standard Shipping\";s:11:\"description\";s:8:\"3-4 Days\";s:5:\"value\";s:4:\"7.25\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"2\";s:7:\"zone_id\";s:1:\"1\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:11:\"France (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"2\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:11:\"France (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:23.239999999999998436805981327779591083526611328125;s:12:\"shipping_tax\";d:1.2079999999999999626965063725947402417659759521484375;s:17:\"item_discount_tax\";d:0;s:20:\"summary_discount_tax\";d:1.6668000000000091631591203622519969940185546875;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:22.78320000000000078443918027915060520172119140625;s:18:\"cart_taxable_value\";d:113.906800000000004047251422889530658721923828125;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:1:{s:13:\"10-FIXED-RATE\";a:3:{s:2:\"id\";s:1:\"3\";s:4:\"code\";s:13:\"10-FIXED-RATE\";s:11:\"description\";s:58:\"Discount Code \"10-FIXED-RATE\" - &pound;10 off grand total.\";}}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:0:{}s:14:\"active_summary\";a:1:{s:5:\"total\";a:5:{s:2:\"id\";s:1:\"3\";s:4:\"code\";s:13:\"10-FIXED-RATE\";s:11:\"description\";s:58:\"Discount Code \"10-FIXED-RATE\" - &pound;10 off grand total.\";s:9:\"tax_value\";d:1.6668000000000091631591203622519969940185546875;s:5:\"value\";d:10;}}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:0;s:24:\"summary_discount_savings\";d:10;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:1:\"0\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:5;s:12:\"order_number\";s:8:\"00000005\";}}}', '2012-05-01 06:33:33', '1');
INSERT INTO `cart_data` VALUES ('6', '1', 'a:3:{s:5:\"items\";a:3:{s:32:\"5f93f983524def3dca464469d2cf9f3e\";a:15:{s:6:\"row_id\";s:32:\"5f93f983524def3dca464469d2cf9f3e\";s:2:\"id\";i:110;s:4:\"name\";s:20:\"Item #110, tax free.\";s:8:\"quantity\";d:1;s:5:\"price\";d:109.5;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:109.5;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:0;}s:32:\"c4ca4238a0b923820dcc509a6f75849b\";a:15:{s:6:\"row_id\";s:32:\"c4ca4238a0b923820dcc509a6f75849b\";s:2:\"id\";s:1:\"1\";s:4:\"name\";s:24:\"Example Database Item #1\";s:8:\"quantity\";d:1;s:5:\"price\";d:25;s:6:\"weight\";d:75;s:14:\"stock_quantity\";s:3:\"100\";s:14:\"internal_price\";d:25;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:4.16669999999999962625452099018730223178863525390625;}s:32:\"8e98d81f8217304975ccb23337bb5761\";a:15:{s:6:\"row_id\";s:32:\"8e98d81f8217304975ccb23337bb5761\";s:2:\"id\";i:307;s:4:\"name\";s:64:\"Discount Item #307, Buy 5 @ &pound;10.00, get 2 for &pound;7.00.\";s:8:\"quantity\";d:7;s:5:\"price\";d:10;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:10;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:1.666700000000000070343730840249918401241302490234375;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:3;s:11:\"total_items\";d:9;s:12:\"total_weight\";d:75;s:19:\"total_reward_points\";d:2045;s:18:\"item_summary_total\";d:204.5;s:14:\"shipping_total\";d:0;s:9:\"tax_total\";d:15.8300000000000000710542735760100185871124267578125;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:204.5;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"4\";s:4:\"name\";s:13:\"UK Collection\";s:11:\"description\";s:18:\"Available Next Day\";s:5:\"value\";s:4:\"0.00\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:15.8333999999999992525090419803746044635772705078125;s:12:\"shipping_tax\";i:0;s:17:\"item_discount_tax\";d:1;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:14.8333999999999992525090419803746044635772705078125;s:18:\"cart_taxable_value\";d:74.1663999999999958845364744774997234344482421875;s:22:\"cart_non_taxable_value\";d:109.5;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:1:{s:32:\"8e98d81f8217304975ccb23337bb5761\";a:7:{s:2:\"id\";i:13;s:11:\"description\";s:64:\"Discount Item #307, Buy 5 @ &pound;10.00, get 2 for &pound;7.00.\";s:17:\"discount_quantity\";d:2;s:21:\"non_discount_quantity\";d:5;s:9:\"tax_value\";d:1.166700000000000070343730840249918401241302490234375;s:5:\"value\";d:3;s:17:\"shipping_discount\";b:0;}}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:6;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:1:\"0\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:6;s:12:\"order_number\";s:8:\"00000006\";}}}', '2012-05-08 06:30:46', '1');
INSERT INTO `cart_data` VALUES ('7', '1', 'a:3:{s:5:\"items\";a:2:{s:32:\"f0935e4cd5920aa6c7c996a5ee53a70f\";a:15:{s:6:\"row_id\";s:32:\"f0935e4cd5920aa6c7c996a5ee53a70f\";s:2:\"id\";i:106;s:4:\"name\";s:56:\"Item #106, shipped separately from the rest of the cart.\";s:8:\"quantity\";d:1;s:5:\"price\";d:18.28999999999999914734871708787977695465087890625;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:19.949999999999999289457264239899814128875732421875;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:1.66270000000000006679101716144941747188568115234375;}s:32:\"38b3eff8baf56627478ec76a704e9b52\";a:15:{s:6:\"row_id\";s:32:\"38b3eff8baf56627478ec76a704e9b52\";s:2:\"id\";i:101;s:4:\"name\";s:35:\"Item #101, minimum required fields.\";s:8:\"quantity\";d:1;s:5:\"price\";d:18.3299999999999982946974341757595539093017578125;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:20;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:1.6664000000000001033839680530945770442485809326171875;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:2;s:11:\"total_items\";d:2;s:12:\"total_weight\";d:0;s:19:\"total_reward_points\";d:366;s:18:\"item_summary_total\";d:36.61999999999999744204615126363933086395263671875;s:14:\"shipping_total\";d:27.309999999999998721023075631819665431976318359375;s:9:\"tax_total\";d:5.8130000000000006110667527536861598491668701171875;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:63.92999999999999971578290569595992565155029296875;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:2:\"12\";s:4:\"name\";s:22:\"Australia NSW Shipping\";s:11:\"description\";s:7:\"10 Days\";s:5:\"value\";s:5:\"14.90\";s:8:\"tax_rate\";N;s:8:\"location\";a:2:{i:0;a:5:{s:11:\"location_id\";s:2:\"11\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:1:\"8\";s:4:\"name\";s:3:\"NSW\";}i:1;a:5:{s:11:\"location_id\";s:1:\"8\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:9:\"Australia\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";d:14.9000000000000003552713678800500929355621337890625;s:14:\"separate_items\";d:1;s:14:\"separate_value\";d:18.28999999999999914734871708787977695465087890625;s:15:\"separate_weight\";d:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:1:{i:0;s:32:\"f0935e4cd5920aa6c7c996a5ee53a70f\";}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"GST\";s:4:\"rate\";s:7:\"10.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:2:{i:0;a:5:{s:11:\"location_id\";s:2:\"11\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"2\";s:9:\"parent_id\";s:1:\"8\";s:4:\"name\";s:3:\"NSW\";}i:1;a:5:{s:11:\"location_id\";s:1:\"8\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:9:\"Australia\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:3.329099999999999948130380289512686431407928466796875;s:12:\"shipping_tax\";d:2.483000000000000095923269327613525092601776123046875;s:17:\"item_discount_tax\";d:0;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:5.81210000000000004405364961712621152400970458984375;s:18:\"cart_taxable_value\";d:58.12089999999999889723767410032451152801513671875;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:0:{}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:0;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:1:\"0\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:7;s:12:\"order_number\";s:8:\"00000007\";}}}', '2012-05-14 01:24:06', '1');
INSERT INTO `cart_data` VALUES ('8', '1', 'a:3:{s:5:\"items\";a:3:{s:32:\"274ad4786c3abca69fa097b85867d9a4\";a:15:{s:6:\"row_id\";s:32:\"274ad4786c3abca69fa097b85867d9a4\";s:2:\"id\";s:3:\"204\";s:4:\"name\";s:40:\"Item #204, added multiple items via form\";s:8:\"quantity\";d:3;s:5:\"price\";d:16.120000000000000994759830064140260219573974609375;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:18.25;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:0.91249999999999997779553950749686919152736663818359375;}s:32:\"eae27d77ca20db309e056e3d2dcd7d69\";a:15:{s:6:\"row_id\";s:32:\"eae27d77ca20db309e056e3d2dcd7d69\";s:2:\"id\";s:3:\"205\";s:4:\"name\";s:40:\"Item #205, added multiple items via form\";s:8:\"quantity\";d:1;s:5:\"price\";d:35.28999999999999914734871708787977695465087890625;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:39.9500000000000028421709430404007434844970703125;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:1.997500000000000053290705182007513940334320068359375;}s:32:\"a87ff679a2f3e71d9181a67b7542122c\";a:15:{s:6:\"row_id\";s:32:\"a87ff679a2f3e71d9181a67b7542122c\";s:2:\"id\";s:1:\"4\";s:4:\"name\";s:24:\"Example Database Item #4\";s:8:\"quantity\";d:1;s:5:\"price\";d:176.659999999999996589394868351519107818603515625;s:6:\"weight\";d:250;s:14:\"stock_quantity\";s:3:\"100\";s:14:\"internal_price\";d:199.990000000000009094947017729282379150390625;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:9.9995999999999991558752299170009791851043701171875;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:3;s:11:\"total_items\";d:5;s:12:\"total_weight\";d:250;s:19:\"total_reward_points\";d:2603;s:18:\"item_summary_total\";d:260.31000000000000227373675443232059478759765625;s:14:\"shipping_total\";d:12.800000000000000710542735760100185871124267578125;s:9:\"tax_total\";d:15.4548000000000005371703082346357405185699462890625;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:273.1100000000000136424205265939235687255859375;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:2:\"14\";s:4:\"name\";s:37:\"United States (Non CA or NY) Shipping\";s:11:\"description\";s:6:\"8 Days\";s:5:\"value\";s:5:\"14.50\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:2:\"10\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:13:\"United States\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:14:\"Tax (Other US)\";s:4:\"rate\";s:6:\"6.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:2:\"10\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:13:\"United States\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:14.734500000000000596855898038484156131744384765625;s:12:\"shipping_tax\";d:0.72479999999999999982236431605997495353221893310546875;s:17:\"item_discount_tax\";d:0;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:15.4593000000000007077005648170597851276397705078125;s:18:\"cart_taxable_value\";d:257.6553999999999859937815926969051361083984375;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:0:{}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:0;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:1:\"0\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:8;s:12:\"order_number\";s:8:\"00000008\";}}}', '2012-05-18 21:22:32', '1');
INSERT INTO `cart_data` VALUES ('9', '1', 'a:3:{s:5:\"items\";a:2:{s:32:\"38b3eff8baf56627478ec76a704e9b52\";a:15:{s:6:\"row_id\";s:32:\"38b3eff8baf56627478ec76a704e9b52\";s:2:\"id\";i:101;s:4:\"name\";s:35:\"Item #101, minimum required fields.\";s:8:\"quantity\";d:2;s:5:\"price\";d:20;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:20;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";s:23:\"Example saved cart item\";s:14:\"status_message\";a:0:{}s:3:\"tax\";d:3.333299999999999929656269159750081598758697509765625;}s:32:\"757b505cfd34c64c85ca5b5690ee5293\";a:15:{s:6:\"row_id\";s:32:\"757b505cfd34c64c85ca5b5690ee5293\";s:2:\"id\";s:3:\"201\";s:4:\"name\";s:25:\"Item #201: added via form\";s:8:\"quantity\";d:1;s:5:\"price\";d:59.9500000000000028421709430404007434844970703125;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:59.9500000000000028421709430404007434844970703125;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:9.9916999999999998038902049302123486995697021484375;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:2;s:11:\"total_items\";d:3;s:12:\"total_weight\";d:0;s:19:\"total_reward_points\";d:1000;s:18:\"item_summary_total\";d:99.9500000000000028421709430404007434844970703125;s:14:\"shipping_total\";d:3.95000000000000017763568394002504646778106689453125;s:9:\"tax_total\";d:17.318000000000001392663762089796364307403564453125;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:103.900000000000005684341886080801486968994140625;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:20:\"UK Standard Shipping\";s:11:\"description\";s:8:\"2-3 Days\";s:5:\"value\";s:4:\"3.95\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"0\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";i:0;s:10:\"free_value\";i:0;s:11:\"free_weight\";i:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:0:{}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"1\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:19:\"United Kingdom (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:16.658400000000000318323145620524883270263671875;s:12:\"shipping_tax\";d:0.65800000000000002930988785010413266718387603759765625;s:17:\"item_discount_tax\";d:0;s:20:\"summary_discount_tax\";i:0;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:17.3164000000000015688783605583012104034423828125;s:18:\"cart_taxable_value\";d:86.58170000000001209627953357994556427001953125;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:0:{}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:0:{}s:14:\"active_summary\";a:0:{}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:0;s:24:\"summary_discount_savings\";i:0;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:1:\"0\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:9;s:12:\"order_number\";b:0;}}}', '2012-05-19 02:44:12', '0');
INSERT INTO `cart_data` VALUES ('10', '1', 'a:3:{s:5:\"items\";a:3:{s:32:\"966cc1c5d63213a34789e7064393f2e5\";a:16:{s:6:\"row_id\";s:32:\"966cc1c5d63213a34789e7064393f2e5\";s:2:\"id\";s:3:\"203\";s:4:\"name\";s:45:\"Item #203, added via form with priced options\";s:8:\"quantity\";d:1;s:5:\"price\";d:19.449999999999999289457264239899814128875732421875;s:7:\"options\";s:9:\"Option #2\";s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:19.449999999999999289457264239899814128875732421875;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";s:23:\"Example saved cart item\";s:14:\"status_message\";a:0:{}s:3:\"tax\";d:3.2416999999999998038902049302123486995697021484375;}s:32:\"6974ce5ac660610b44d9b9fed0ff9548\";a:15:{s:6:\"row_id\";s:32:\"6974ce5ac660610b44d9b9fed0ff9548\";s:2:\"id\";i:103;s:4:\"name\";s:25:\"Item #103, free shipping.\";s:8:\"quantity\";d:1;s:5:\"price\";d:19.949999999999999289457264239899814128875732421875;s:13:\"shipping_rate\";d:0;s:14:\"stock_quantity\";b:0;s:14:\"internal_price\";d:19.949999999999999289457264239899814128875732421875;s:6:\"weight\";i:0;s:8:\"tax_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:3.32500000000000017763568394002504646778106689453125;}s:32:\"c4ca4238a0b923820dcc509a6f75849b\";a:15:{s:6:\"row_id\";s:32:\"c4ca4238a0b923820dcc509a6f75849b\";s:2:\"id\";s:1:\"1\";s:4:\"name\";s:24:\"Example Database Item #1\";s:8:\"quantity\";d:2;s:5:\"price\";d:25;s:6:\"weight\";d:75;s:14:\"stock_quantity\";s:2:\"99\";s:14:\"internal_price\";d:25;s:8:\"tax_rate\";b:0;s:13:\"shipping_rate\";b:0;s:17:\"separate_shipping\";b:0;s:13:\"reward_points\";b:0;s:9:\"user_note\";N;s:14:\"status_message\";a:0:{}s:3:\"tax\";d:4.16669999999999962625452099018730223178863525390625;}}s:7:\"summary\";a:9:{s:10:\"total_rows\";i:3;s:11:\"total_items\";d:4;s:12:\"total_weight\";d:150;s:19:\"total_reward_points\";d:895;s:18:\"item_summary_total\";d:89.400000000000005684341886080801486968994140625;s:14:\"shipping_total\";d:7.75;s:9:\"tax_total\";d:16.19200000000000017053025658242404460906982421875;s:15:\"surcharge_total\";d:0;s:5:\"total\";d:97.150000000000005684341886080801486968994140625;}s:8:\"settings\";a:6:{s:8:\"currency\";a:7:{s:4:\"name\";s:3:\"GBP\";s:13:\"exchange_rate\";s:6:\"1.0000\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";s:7:\"default\";a:5:{s:4:\"name\";s:3:\"GBP\";s:6:\"symbol\";s:7:\"&pound;\";s:13:\"symbol_suffix\";b:0;s:18:\"thousand_separator\";s:1:\",\";s:17:\"decimal_separator\";s:1:\".\";}}s:8:\"shipping\";a:7:{s:2:\"id\";s:1:\"7\";s:4:\"name\";s:28:\"EU Zone 2: Standard Shipping\";s:11:\"description\";s:8:\"4-6 Days\";s:5:\"value\";s:4:\"7.75\";s:8:\"tax_rate\";N;s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"4\";s:7:\"zone_id\";s:1:\"2\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:13:\"Portugal (EU)\";}}s:4:\"data\";a:11:{s:9:\"surcharge\";d:0;s:23:\"separate_shipping_value\";i:0;s:14:\"separate_items\";i:0;s:14:\"separate_value\";i:0;s:15:\"separate_weight\";i:0;s:10:\"free_items\";d:1;s:10:\"free_value\";d:19.949999999999999289457264239899814128875732421875;s:11:\"free_weight\";d:0;s:21:\"banned_shipping_items\";a:0:{}s:23:\"separate_shipping_items\";a:0:{}s:19:\"item_shipping_rates\";a:1:{s:32:\"6974ce5ac660610b44d9b9fed0ff9548\";d:0;}}}s:3:\"tax\";a:5:{s:4:\"name\";s:3:\"VAT\";s:4:\"rate\";s:7:\"20.0000\";s:13:\"internal_rate\";s:7:\"20.0000\";s:8:\"location\";a:1:{i:0;a:5:{s:11:\"location_id\";s:1:\"4\";s:7:\"zone_id\";s:1:\"4\";s:7:\"type_id\";s:1:\"1\";s:9:\"parent_id\";s:1:\"0\";s:4:\"name\";s:13:\"Portugal (EU)\";}}s:4:\"data\";a:9:{s:14:\"item_total_tax\";d:14.9000000000000003552713678800500929355621337890625;s:12:\"shipping_tax\";d:1.2920000000000000373034936274052597582340240478515625;s:17:\"item_discount_tax\";d:4.16669999999999962625452099018730223178863525390625;s:20:\"summary_discount_tax\";d:1.203699999999997771737980656325817108154296875;s:18:\"reward_voucher_tax\";i:0;s:13:\"surcharge_tax\";i:0;s:8:\"cart_tax\";d:10.826299999999999812416717759333550930023193359375;s:18:\"cart_taxable_value\";d:54.11370000000000146656020660884678363800048828125;s:22:\"cart_non_taxable_value\";d:0;}}s:9:\"discounts\";a:6:{s:5:\"codes\";a:1:{s:10:\"10-PERCENT\";a:3:{s:2:\"id\";s:1:\"2\";s:4:\"code\";s:10:\"10-PERCENT\";s:11:\"description\";s:49:\"Discount Code \"10-PERCENT\" - 10% off grand total.\";}}s:6:\"manual\";a:0:{}s:12:\"active_items\";a:1:{s:32:\"c4ca4238a0b923820dcc509a6f75849b\";a:7:{s:2:\"id\";i:32;s:11:\"description\";s:18:\"Buy 2, Get 1 Free.\";s:17:\"discount_quantity\";d:1;s:21:\"non_discount_quantity\";d:1;s:9:\"tax_value\";d:0;s:5:\"value\";d:25;s:17:\"shipping_discount\";b:0;}}s:14:\"active_summary\";a:1:{s:5:\"total\";a:5:{s:2:\"id\";s:1:\"2\";s:4:\"code\";s:10:\"10-PERCENT\";s:11:\"description\";s:49:\"Discount Code \"10-PERCENT\" - 10% off grand total.\";s:9:\"tax_value\";d:1.203699999999997771737980656325817108154296875;s:5:\"value\";d:7.219999999999998863131622783839702606201171875;}}s:15:\"reward_vouchers\";a:0:{}s:4:\"data\";a:5:{s:21:\"item_discount_savings\";d:25;s:24:\"summary_discount_savings\";d:7.219999999999998863131622783839702606201171875;s:15:\"reward_vouchers\";i:0;s:23:\"void_reward_point_items\";a:0:{}s:18:\"excluded_discounts\";a:0:{}}}s:10:\"surcharges\";a:0:{}s:13:\"configuration\";a:28:{s:2:\"id\";b:1;s:19:\"order_number_prefix\";s:0:\"\";s:19:\"order_number_suffix\";s:0:\"\";s:22:\"increment_order_number\";b:1;s:13:\"minimum_order\";s:1:\"0\";s:17:\"quantity_decimals\";s:1:\"0\";s:33:\"increment_duplicate_item_quantity\";b:1;s:25:\"quantity_limited_by_stock\";b:1;s:21:\"remove_no_stock_items\";b:0;s:19:\"auto_allocate_stock\";b:1;s:26:\"save_banned_shipping_items\";b:0;s:11:\"weight_type\";s:4:\"gram\";s:15:\"weight_decimals\";s:1:\"0\";s:18:\"display_tax_prices\";b:1;s:13:\"price_inc_tax\";b:1;s:25:\"multi_row_duplicate_items\";b:0;s:21:\"dynamic_reward_points\";b:1;s:23:\"reward_point_multiplier\";s:7:\"10.0000\";s:25:\"reward_voucher_multiplier\";s:6:\"0.0100\";s:29:\"reward_point_to_voucher_ratio\";s:3:\"250\";s:25:\"reward_point_days_pending\";s:2:\"14\";s:23:\"reward_point_days_valid\";s:3:\"365\";s:25:\"reward_voucher_days_valid\";s:3:\"365\";s:15:\"custom_status_1\";b:0;s:15:\"custom_status_2\";b:0;s:15:\"custom_status_3\";b:0;s:12:\"cart_data_id\";i:10;s:12:\"order_number\";b:0;}}}', '2012-05-19 10:06:35', '0');

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

-- ----------------------------
-- Table structure for `currency`
-- ----------------------------
DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency` (
  `curr_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `curr_name` varchar(50) NOT NULL DEFAULT '',
  `curr_exchange_rate` double(8,4) NOT NULL DEFAULT '0',
  `curr_symbol` varchar(25) NOT NULL DEFAULT '',
  `curr_symbol_suffix` tinyint(1) NOT NULL DEFAULT '0',
  `curr_thousand_separator` varchar(10) NOT NULL DEFAULT '',
  `curr_decimal_separator` varchar(10) NOT NULL DEFAULT '',
  `curr_status` tinyint(1) NOT NULL DEFAULT '0',
  `curr_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`curr_id`),
  KEY `curr_id` (`curr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of currency
-- ----------------------------
INSERT INTO `currency` VALUES ('1', 'AUD', '2.0000', 'AU $', '0', ',', '.', '1', '0');
INSERT INTO `currency` VALUES ('2', 'EUR', '1.1500', '&euro;', '1', '.', ',', '1', '0');
INSERT INTO `currency` VALUES ('3', 'GBP', '1.0000', '&pound;', '0', ',', '.', '1', '1');
INSERT INTO `currency` VALUES ('4', 'USD', '1.6000', 'US $', '0', ',', '.', '1', '0');

-- ----------------------------
-- Table structure for `demo_categories`
-- ----------------------------
DROP TABLE IF EXISTS `demo_categories`;
CREATE TABLE `demo_categories` (
  `cat_id` int(5) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(25) NOT NULL DEFAULT '',
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
  `item_name` varchar(50) NOT NULL DEFAULT '',
  `item_price` double(6,2) NOT NULL DEFAULT '0.00',
  `item_weight` double(6,2) NOT NULL DEFAULT '0.00',
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
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `user_group_fk` smallint(5) NOT NULL DEFAULT '0',
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
  `disc_type_fk` smallint(5) NOT NULL DEFAULT '0',
  `disc_method_fk` smallint(5) NOT NULL DEFAULT '0',
  `disc_tax_method_fk` tinyint(1) NOT NULL DEFAULT '0',
  `disc_user_acc_fk` int(11) NOT NULL DEFAULT '0',
  `disc_item_fk` int(11) NOT NULL DEFAULT '0' COMMENT 'Item / Product Id',
  `disc_group_fk` int(11) NOT NULL DEFAULT '0',
  `disc_location_fk` smallint(5) NOT NULL DEFAULT '0',
  `disc_zone_fk` smallint(5) NOT NULL DEFAULT '0',
  `disc_code` varchar(50) NOT NULL DEFAULT '' COMMENT 'Discount Code',
  `disc_description` varchar(255) NOT NULL DEFAULT '' COMMENT 'Name shown in cart when active',
  `disc_quantity_required` smallint(5) NOT NULL DEFAULT '0' COMMENT 'Quantity required for offer',
  `disc_quantity_discounted` smallint(5) NOT NULL DEFAULT '0' COMMENT 'Quantity affected by offer',
  `disc_value_required` double(8,2) NOT NULL DEFAULT '0.00',
  `disc_value_discounted` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '% discount, flat fee discount, new set price - specified via calculation_fk',
  `disc_recursive` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Discount is repeatable multiple times on one item',
  `disc_non_combinable_discount` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Cannot be applied if any other discount is applied',
  `disc_void_reward_points` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Voids any current reward points',
  `disc_force_ship_discount` tinyint(1) NOT NULL DEFAULT '0',
  `disc_custom_status_1` varchar(50) NOT NULL DEFAULT '',
  `disc_custom_status_2` varchar(50) NOT NULL DEFAULT '',
  `disc_custom_status_3` varchar(50) NOT NULL DEFAULT '',
  `disc_usage_limit` smallint(5) NOT NULL DEFAULT '0' COMMENT 'Number of offers available',
  `disc_valid_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `disc_expire_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `disc_status` tinyint(1) NOT NULL DEFAULT '0',
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
INSERT INTO `discounts` VALUES ('1', '1', '11', '1', '0', '0', '0', '1', '0', 'FREE-UK-SHIPPING', 'Discount Code \"FREE-UK-SHIPPING\" - Free UK shipping.', '0', '0', '0.00', '0.00', '0', '0', '1', '1', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('2', '2', '12', '1', '0', '0', '0', '0', '0', '10-PERCENT', 'Discount Code \"10-PERCENT\" - 10% off grand total.', '0', '0', '0.00', '10.00', '0', '0', '0', '0', '', '', '', '9998', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('3', '2', '13', '1', '0', '0', '0', '0', '0', '10-FIXED-RATE', 'Discount Code \"10-FIXED-RATE\" - &pound;10 off grand total.', '0', '0', '0.00', '10.00', '0', '0', '0', '0', '', '', '', '9998', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('4', '2', '13', '1', '0', '0', '0', '0', '0', '', 'Discount Summary, Spend over &pound;1,000, get &pound;100 off.', '1', '1', '1000.00', '100.00', '0', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('5', '2', '11', '1', '0', '0', '0', '0', '0', '', 'Discount Summary, Spend over &pound;500, get free worldwide shipping.', '0', '0', '500.00', '0.00', '0', '0', '0', '1', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('6', '2', '12', '1', '0', '0', '0', '0', '0', '', 'Discount Summary, Logged in users get 5% off total.', '0', '0', '0.00', '5.00', '0', '0', '0', '0', '1', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('7', '1', '1', '1', '0', '301', '0', '0', '0', '', 'Discount Item #301, 10% off original price (&pound;24.99).', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '', '', '', '9997', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('8', '1', '2', '1', '0', '302', '0', '0', '0', '', 'Discount Item #302, Fixed price of &pound;5.00 off original price of &pound;12.50.', '1', '1', '0.00', '5.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('9', '1', '3', '1', '0', '303', '0', '0', '0', '', 'Discount Item #303, New price of &pound;15.00, item was &pound;25.00.', '1', '1', '0.00', '15.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('10', '1', '3', '1', '0', '304', '0', '0', '0', '', 'Discount Item #304, Buy 2, get 1 free.', '3', '1', '0.00', '0.00', '1', '0', '0', '0', '', '', '', '9998', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('11', '1', '1', '1', '0', '305', '0', '0', '0', '', 'Discount Item #305, Buy 1, get 1 @ 50% off.', '2', '1', '0.00', '50.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('12', '1', '2', '1', '0', '306', '0', '0', '0', '', 'Discount Item #306, Buy 2 @ &pound;15.00, get 1 with &pound;5.00 off.', '3', '1', '0.00', '5.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('13', '1', '3', '1', '0', '307', '0', '0', '0', '', 'Discount Item #307, Buy 5 @ &pound;10.00, get 2 for &pound;7.00.', '7', '2', '0.00', '7.00', '1', '0', '0', '0', '', '', '', '9998', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('14', '1', '6', '1', '0', '308', '0', '1', '0', '', 'Discount Item #308, Buy 3, get free UK shipping on these items (Other items still charged).', '3', '3', '0.00', '0.00', '1', '0', '0', '1', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('15', '1', '1', '1', '0', '309', '0', '0', '0', '', 'Discount Item #309, Spend over &pound;75.00 on this item, get 10% off this items total.', '1', '1', '75.00', '10.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('16', '1', '2', '1', '0', '310', '0', '0', '0', '', 'Discount Item #310, Spend over &pound;100.00 on this item, get &pound;10.00 off this items total.', '1', '1', '100.00', '10.00', '0', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('17', '1', '3', '1', '0', '0', '1', '0', '0', '', 'Discount Group: Items #311, #312, #313 - buy 3, get cheapest item free.', '3', '1', '0.00', '0.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('18', '1', '1', '1', '0', '314', '0', '0', '0', '', 'Discount Item #314, 10% off original price - but for logged in users only.', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '1', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('19', '1', '1', '1', '0', '315', '0', '0', '0', '', 'Discount Item #315, 10% off original price - but removes the items reward points (Normally 200 points).', '1', '1', '0.00', '10.00', '1', '0', '1', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('20', '1', '1', '1', '0', '316', '0', '0', '0', '', 'Discount Item #316, 10% off original price - but applies to first item only (Non recursive quantity discount).', '1', '1', '0.00', '10.00', '0', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('21', '1', '1', '1', '0', '317', '0', '1', '0', '', 'Discount Item #317, 10% off original price - but applies to orders being shipped to the UK only.', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('22', '1', '1', '1', '0', '318', '0', '0', '0', '', 'Discount Item #318, 10% off original price - but cannot be applied if other discounts exist.', '1', '1', '0.00', '10.00', '1', '1', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('23', '1', '1', '1', '0', '401', '0', '0', '0', '', 'Discount Tax #401, get 10% off original price (&pound;10.00) - Method #1.', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('24', '1', '1', '2', '0', '402', '0', '0', '0', '', 'Discount Tax #402, get 10% off original price (&pound;10.00) - Method #2.', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('25', '1', '1', '3', '0', '403', '0', '0', '0', '', 'Discount Tax #403, get 10% off original price (&pound;10.00) - Method #3.', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('26', '1', '2', '1', '0', '404', '0', '0', '0', '', 'Discount Tax #404, get set price of (&pound;5.00) off original price (&pound;10.00) - Method #1.', '1', '1', '0.00', '5.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('27', '1', '2', '2', '0', '405', '0', '0', '0', '', 'Discount Tax #405, get set price of (&pound;5.00) off original price (&pound;10.00) - Method #2.', '1', '1', '0.00', '5.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('28', '1', '2', '3', '0', '406', '0', '0', '0', '', 'Discount Tax #406, get set price of (&pound;5.00) off original price (&pound;10.00) - Method #3.', '1', '1', '0.00', '5.00', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('29', '1', '3', '1', '0', '407', '0', '0', '0', '', 'Discount Tax #407, get for new price of &pound;7.50 (Original price &pound;10.00) - Method #1.', '1', '1', '0.00', '7.50', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('30', '1', '3', '2', '0', '408', '0', '0', '0', '', 'Discount Tax #408, get for new price of &pound;7.50 (Original price &pound;10.00) - Method #2.', '1', '1', '0.00', '7.50', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('31', '1', '3', '3', '0', '409', '0', '0', '0', '', 'Discount Tax #409, get for new price of &pound;7.50 (Original price &pound;10.00) - Method #3.', '1', '1', '0.00', '7.50', '1', '0', '0', '0', '', '', '', '9999', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('32', '1', '3', '0', '0', '1', '0', '0', '0', '', 'Buy 2, Get 1 Free.', '2', '1', '0.00', '0.00', '1', '0', '0', '0', '', '', '', '9', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('33', '1', '1', '0', '0', '3', '0', '0', '0', '', '10% off original price.', '1', '1', '0.00', '10.00', '1', '0', '0', '0', '', '', '', '9', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('34', '1', '2', '0', '0', '5', '0', '0', '0', '', 'Get &pound;5.00 off original price.', '1', '1', '0.00', '5.00', '1', '0', '0', '0', '', '', '', '10', '2012-05-13 00:00:00', '2012-06-04 00:00:00', '1', '1');
INSERT INTO `discounts` VALUES ('35', '3', '14', '0', '1', '0', '0', '0', '0', '2AC2AE9AEF923F4', 'Reward Voucher: 2AC2AE9AEF923F4', '0', '0', '0.00', '5.00', '0', '0', '1', '0', '', '', '', '1', '2012-05-13 00:00:00', '2013-05-20 00:00:00', '1', '100');
INSERT INTO `discounts` VALUES ('36', '3', '14', '0', '4', '0', '0', '0', '0', '088F148041B66A9', 'Reward Voucher: 088F148041B66A9', '0', '0', '0.00', '10.00', '0', '0', '1', '0', '', '', '', '0', '2012-05-13 00:00:00', '2013-05-20 00:00:00', '1', '100');

-- ----------------------------
-- Table structure for `discount_calculation`
-- ----------------------------
DROP TABLE IF EXISTS `discount_calculation`;
CREATE TABLE `discount_calculation` (
  `disc_calculation_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `disc_calculation` varchar(255) NOT NULL DEFAULT '',
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
  `disc_column` varchar(255) NOT NULL DEFAULT '',
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
  `disc_group` varchar(255) NOT NULL DEFAULT '',
  `disc_group_status` tinyint(1) NOT NULL DEFAULT '0',
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
  `disc_group_item_group_fk` int(11) NOT NULL DEFAULT '0',
  `disc_group_item_item_fk` int(11) NOT NULL DEFAULT '0',
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
  `disc_method_type_fk` smallint(5) NOT NULL DEFAULT '0',
  `disc_method_column_fk` smallint(5) NOT NULL DEFAULT '0',
  `disc_method_calculation_fk` smallint(5) NOT NULL DEFAULT '0',
  `disc_method` varchar(50) NOT NULL DEFAULT '',
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
  `disc_tax_method` varchar(255) NOT NULL DEFAULT '',
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
  `disc_type` varchar(50) NOT NULL DEFAULT '',
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
  `stock_item_fk` int(11) NOT NULL DEFAULT '0',
  `stock_quantity` smallint(5) NOT NULL DEFAULT '0',
  `stock_auto_allocate_status` tinyint(1) NOT NULL DEFAULT '0',
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
  `loc_type_fk` smallint(5) NOT NULL DEFAULT '0',
  `loc_parent_fk` int(11) NOT NULL DEFAULT '0',
  `loc_ship_zone_fk` smallint(5) NOT NULL DEFAULT '0',
  `loc_tax_zone_fk` smallint(5) NOT NULL DEFAULT '0',
  `loc_name` varchar(50) NOT NULL DEFAULT '',
  `loc_status` tinyint(1) NOT NULL DEFAULT '0',
  `loc_ship_default` tinyint(1) NOT NULL DEFAULT '0',
  `loc_tax_default` tinyint(1) NOT NULL DEFAULT '0',
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
  `loc_type_parent_fk` smallint(5) NOT NULL DEFAULT '0',
  `loc_type_name` varchar(50) NOT NULL DEFAULT '',
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
  `lzone_name` varchar(50) NOT NULL DEFAULT '',
  `lzone_description` longtext NOT NULL DEFAULT '',
  `lzone_status` tinyint(1) NOT NULL DEFAULT '0',
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
  `ord_det_order_number_fk` varchar(25) NOT NULL DEFAULT '',
  `ord_det_cart_row_id` varchar(32) NOT NULL DEFAULT '',
  `ord_det_item_fk` int(11) NOT NULL DEFAULT '0',
  `ord_det_item_name` varchar(255) NOT NULL DEFAULT '',
  `ord_det_item_option` varchar(255) NOT NULL DEFAULT '',
  `ord_det_quantity` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_non_discount_quantity` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_discount_quantity` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_stock_quantity` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_price` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_price_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_discount_price` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_discount_price_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_discount_description` varchar(255) NOT NULL DEFAULT '',
  `ord_det_tax_rate` double(8,4) NOT NULL DEFAULT '0',
  `ord_det_tax` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_tax_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_shipping_rate` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_weight` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_weight_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_reward_points` int(10) NOT NULL DEFAULT '0',
  `ord_det_reward_points_total` int(10) NOT NULL DEFAULT '0',
  `ord_det_status_message` varchar(255) NOT NULL DEFAULT '',
  `ord_det_quantity_shipped` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_quantity_cancelled` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_det_shipped_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ord_det_demo_user_note` varchar(255) NOT NULL DEFAULT '',
  `ord_det_demo_sku` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`ord_det_id`),
  UNIQUE KEY `ord_det_id` (`ord_det_id`) USING BTREE,
  KEY `ord_det_order_number_fk` (`ord_det_order_number_fk`) USING BTREE,
  KEY `ord_det_item_fk` (`ord_det_item_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES ('1', '00000001', '38b3eff8baf56627478ec76a704e9b52', '101', 'Item #101, minimum required fields.', '', '1.00', '1.00', '0.00', '0.00', '20.00', '20.00', '20.00', '20.00', '', '20.0000', '3.33', '3.33', '0.00', '0.00', '0.00', '200', '200', '', '1.00', '0.00', '2012-04-13 20:22:24', '', '');
INSERT INTO `order_details` VALUES ('2', '00000002', '62b3e8cbab25f7c393a0996f39d4a9f6', '202', 'Item #202, added via form with options', 'Colour: Blue1Size: Medium', '2.00', '2.00', '0.00', '0.00', '27.50', '55.00', '27.50', '55.00', '', '20.0000', '4.58', '9.16', '0.00', '0.00', '0.00', '275', '550', '', '2.00', '0.00', '2012-04-13 20:22:24', '', '');
INSERT INTO `order_details` VALUES ('3', '00000002', '6974ce5ac660610b44d9b9fed0ff9548', '103', 'Item #103, free shipping.', '', '1.00', '1.00', '0.00', '0.00', '19.95', '19.95', '19.95', '19.95', '', '20.0000', '3.33', '3.33', '0.00', '0.00', '0.00', '200', '200', '', '1.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('4', '00000003', '0768281a05da9f27df178b5c39a51263', '1021', 'Item #1021, multiple items at once.', '', '1.00', '1.00', '0.00', '0.00', '20.63', '20.63', '20.63', '20.63', '', '10.0000', '1.88', '1.88', '0.00', '0.00', '0.00', '206', '206', '', '1.00', '0.00', '2012-04-20 07:33:22', '', '');
INSERT INTO `order_details` VALUES ('5', '00000003', '93d65641ff3f1586614cf2c1ad240b6c', '1022', 'Item #1022, multiple items at once.', '', '2.00', '2.00', '0.00', '0.00', '32.95', '65.90', '32.95', '65.90', '', '10.0000', '3.00', '6.00', '0.00', '0.00', '0.00', '330', '660', '', '2.00', '0.00', '2012-04-20 07:33:22', '', '');
INSERT INTO `order_details` VALUES ('6', '00000003', 'ce5140df15d046a66883807d18d0264b', '1023', 'Item #1023, multiple items at once.', '', '1.00', '1.00', '0.00', '0.00', '14.67', '14.67', '14.67', '14.67', '', '10.0000', '1.33', '1.33', '0.00', '0.00', '0.00', '147', '147', '', '0.00', '1.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('7', '00000003', '7f6ffaa6bb0b408017b62254211691b5', '112', 'Item #112, stock controlled, in-stock.', '', '1.00', '1.00', '0.00', '20.00', '15.57', '15.57', '15.57', '15.57', '', '10.0000', '1.42', '1.42', '0.00', '0.00', '0.00', '156', '156', '', '1.00', '0.00', '2012-04-26 21:01:46', '', '');
INSERT INTO `order_details` VALUES ('8', '00000004', '37bc2f75bf1bcfe8450a1a41c200364c', '304', 'Discount Item #304, Buy 2, get 1 free.', '', '3.00', '2.00', '1.00', '0.00', '9.03', '27.09', '0.00', '18.06', 'Discount Item #304, Buy 2, get 1 free.', '8.3700', '0.70', '2.10', '0.00', '0.00', '0.00', '90', '270', '', '3.00', '0.00', '2012-04-26 21:01:46', '', '');
INSERT INTO `order_details` VALUES ('9', '00000005', 'c81e728d9d4c2f636f067f89cc14862c', '2', 'Example Database Item #2', '', '1.00', '1.00', '0.00', '100.00', '4.95', '4.95', '4.95', '4.95', '', '20.0000', '0.83', '0.83', '0.00', '15.00', '15.00', '50', '50', '', '1.00', '0.00', '2012-05-01 11:30:52', '', '');
INSERT INTO `order_details` VALUES ('10', '00000005', '8ba32330170ca729c650f411edf3777e', '115', 'Item #115, options.', 'Option Type #1: Option #11Option Type #2: Option #2', '1.00', '1.00', '0.00', '0.00', '79.49', '79.49', '79.49', '79.49', '', '20.0000', '13.25', '13.25', '0.00', '0.00', '0.00', '795', '795', '', '0.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('11', '00000005', '2723d092b63885e0d7c260cc007e8b9d', '109', 'Item #109, defined weight.', '', '1.00', '1.00', '0.00', '0.00', '55.00', '55.00', '55.00', '55.00', '', '20.0000', '9.17', '9.17', '0.00', '138.00', '138.00', '550', '550', '', '1.00', '0.00', '2012-05-10 21:49:23', '', '');
INSERT INTO `order_details` VALUES ('12', '00000006', '5f93f983524def3dca464469d2cf9f3e', '110', 'Item #110, tax free.', '', '1.00', '1.00', '0.00', '0.00', '109.50', '109.50', '109.50', '109.50', '', '20.0000', '0.00', '0.00', '0.00', '0.00', '0.00', '1095', '1095', '', '1.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('13', '00000006', 'c4ca4238a0b923820dcc509a6f75849b', '1', 'Example Database Item #1', '', '1.00', '1.00', '0.00', '100.00', '25.00', '25.00', '25.00', '25.00', '', '20.0000', '4.17', '4.17', '0.00', '75.00', '75.00', '250', '250', '', '0.00', '1.00', '2012-05-01 11:30:52', '', '');
INSERT INTO `order_details` VALUES ('14', '00000006', '8e98d81f8217304975ccb23337bb5761', '307', 'Discount Item #307, Buy 5 @ &pound;10.00, get 2 for &pound;7.00.', '', '7.00', '5.00', '2.00', '0.00', '10.00', '70.00', '7.00', '64.00', 'Discount Item #307, Buy 5 @ &pound;10.00, get 2 for &pound;7.00.', '20.0000', '1.67', '11.69', '0.00', '0.00', '0.00', '100', '700', '', '7.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('15', '00000007', 'f0935e4cd5920aa6c7c996a5ee53a70f', '106', 'Item #106, shipped separately from the rest of the cart.', '', '1.00', '1.00', '0.00', '0.00', '18.29', '18.29', '18.29', '18.29', '', '10.0000', '1.66', '1.66', '0.00', '0.00', '0.00', '183', '183', '', '0.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('16', '00000007', '38b3eff8baf56627478ec76a704e9b52', '101', 'Item #101, minimum required fields.', '', '1.00', '1.00', '0.00', '0.00', '18.33', '18.33', '18.33', '18.33', '', '10.0000', '1.67', '1.67', '0.00', '0.00', '0.00', '183', '183', '', '0.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('17', '00000008', '274ad4786c3abca69fa097b85867d9a4', '204', 'Item #204, added multiple items via form', '', '3.00', '3.00', '0.00', '0.00', '16.12', '48.36', '16.12', '48.36', '', '6.0000', '0.91', '2.73', '0.00', '0.00', '0.00', '161', '483', '', '0.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('18', '00000008', 'eae27d77ca20db309e056e3d2dcd7d69', '205', 'Item #205, added multiple items via form', '', '1.00', '1.00', '0.00', '0.00', '35.29', '35.29', '35.29', '35.29', '', '6.0000', '2.00', '2.00', '0.00', '0.00', '0.00', '353', '353', '', '0.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('19', '00000008', 'a87ff679a2f3e71d9181a67b7542122c', '4', 'Example Database Item #4', '', '1.00', '1.00', '0.00', '100.00', '176.66', '176.66', '176.66', '176.66', '', '6.0000', '10.00', '10.00', '0.00', '250.00', '250.00', '1767', '1767', '', '0.00', '0.00', '0000-00-00 00:00:00', '', '');
INSERT INTO `order_details` VALUES ('20', '00000004', 'c4ca4238a0b923820dcc509a6f75849b', '1', 'Example Database Item #1', '', '1.00', '1.00', '0.00', '100.00', '22.58', '22.58', '22.58', '22.58', '', '8.3700', '1.74', '1.74', '0.00', '75.00', '75.00', '226', '226', '', '1.00', '0.00', '2012-05-20 21:15:04', '', '');

-- ----------------------------
-- Table structure for `order_status`
-- ----------------------------
DROP TABLE IF EXISTS `order_status`;
CREATE TABLE `order_status` (
  `ord_status_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `ord_status_description` varchar(50) NOT NULL DEFAULT '',
  `ord_status_cancelled` tinyint(1) NOT NULL DEFAULT '0',
  `ord_status_save_default` tinyint(1) NOT NULL DEFAULT '0',
  `ord_status_resave_default` tinyint(1) NOT NULL DEFAULT '0',
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
  `ord_order_number` varchar(25) NOT NULL DEFAULT '',
  `ord_cart_data_fk` int(11) NOT NULL DEFAULT '0',
  `ord_user_fk` int(5) NOT NULL DEFAULT '0',
  `ord_item_summary_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_item_summary_savings_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_shipping` varchar(100) NOT NULL DEFAULT '',
  `ord_shipping_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_item_shipping_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_summary_discount_desc` varchar(255) NOT NULL DEFAULT '',
  `ord_summary_savings_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_savings_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_surcharge_desc` varchar(255) NOT NULL DEFAULT '',
  `ord_surcharge_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_reward_voucher_desc` varchar(255) NOT NULL DEFAULT '',
  `ord_reward_voucher_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_tax_rate` varchar(25) NOT NULL DEFAULT '',
  `ord_tax_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_sub_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_total` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_total_rows` int(10) NOT NULL DEFAULT '0',
  `ord_total_items` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_total_weight` double(10,2) NOT NULL DEFAULT '0.00',
  `ord_total_reward_points` int(10) NOT NULL DEFAULT '0',
  `ord_currency` varchar(25) NOT NULL DEFAULT '',
  `ord_exchange_rate` double(8,4) NOT NULL DEFAULT '0',
  `ord_status` tinyint(1) NOT NULL DEFAULT '0',
  `ord_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ord_demo_bill_name` varchar(75) NOT NULL DEFAULT '',
  `ord_demo_bill_company` varchar(75) NOT NULL DEFAULT '',
  `ord_demo_bill_address_01` varchar(75) NOT NULL DEFAULT '',
  `ord_demo_bill_address_02` varchar(75) NOT NULL DEFAULT '',
  `ord_demo_bill_city` varchar(50) NOT NULL DEFAULT '',
  `ord_demo_bill_state` varchar(50) NOT NULL DEFAULT '',
  `ord_demo_bill_post_code` varchar(25) NOT NULL DEFAULT '',
  `ord_demo_bill_country` varchar(50) NOT NULL DEFAULT '',
  `ord_demo_ship_name` varchar(75) NOT NULL DEFAULT '',
  `ord_demo_ship_company` varchar(75) NOT NULL DEFAULT '',
  `ord_demo_ship_address_01` varchar(75) NOT NULL DEFAULT '',
  `ord_demo_ship_address_02` varchar(75) NOT NULL DEFAULT '',
  `ord_demo_ship_city` varchar(50) NOT NULL DEFAULT '',
  `ord_demo_ship_state` varchar(50) NOT NULL DEFAULT '',
  `ord_demo_ship_post_code` varchar(25) NOT NULL DEFAULT '',
  `ord_demo_ship_country` varchar(50) NOT NULL DEFAULT '',
  `ord_demo_email` varchar(255) NOT NULL DEFAULT '',
  `ord_demo_phone` varchar(25) NOT NULL DEFAULT '',
  `ord_demo_comments` longtext NOT NULL DEFAULT '',
  PRIMARY KEY (`ord_order_number`),
  UNIQUE KEY `ord_order_number` (`ord_order_number`) USING BTREE,
  KEY `ord_cart_data_fk` (`ord_cart_data_fk`) USING BTREE,
  KEY `ord_user_fk` (`ord_user_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_summary
-- ----------------------------
INSERT INTO `order_summary` VALUES ('00000001', '1', '1', '20.00', '0.00', 'UK Standard Shipping', '3.95', '23.95', '', '0.00', '0.00', '', '0.00', '', '0.00', '20', '3.99', '19.96', '23.95', '1', '1.00', '0.00', '200', 'GBP', '1.0000', '4', '2012-04-09 23:46:51', 'Customer #1', '', '404 Oak Tree Road', '', 'Oaktown', 'Norfolk', 'NR1', 'United Kingdom (EU)', 'Customer #1', '', '404 Oak Tree Road', '', 'Oaktown', 'Norfolk', 'NR1', 'United Kingdom (EU)', 'customer1@fake-email-address.com', '0123456789', 'Example customer order comments');
INSERT INTO `order_summary` VALUES ('00000002', '2', '1', '74.95', '0.00', 'UK Recorded Shipping', '5.10', '80.05', '', '0.00', '0.00', '', '0.00', '', '0.00', '20', '13.34', '66.71', '80.05', '2', '3.00', '0.00', '750', 'GBP', '1.0000', '4', '2012-04-12 21:17:33', 'Customer #2', '', '301 Kookaburra Close', '', 'Ornington', 'Merseyside', 'L3', 'United Kingdom (EU)', 'Customer #2', '', '55a Lemington Street', '', 'Ornington', 'Merseyside', 'L3', 'United Kingdom (EU)', 'customer2@fake-email-address.com', '0123456789', '');
INSERT INTO `order_summary` VALUES ('00000003', '3', '1', '116.77', '0.00', 'Australia NSW Shipping', '13.66', '130.43', 'Discount Code \"10-PERCENT\" - 10% off grand total.', '13.04', '13.04', '', '0.00', '', '0.00', '10', '10.67', '106.72', '117.39', '4', '5.00', '0.00', '1169', 'GBP', '1.0000', '4', '2012-04-17 12:25:22', 'Customer #3', '', '42 Wallaby Way', '', 'Sydney', 'NSW', '2000', 'Australia', 'Customer #3', '', '42 Wallaby Way', '', 'Sydney', 'NSW', '2000', 'Australia', 'customer3@fake-email-address.com', '0123456789', '');
INSERT INTO `order_summary` VALUES ('00000004', '4', '1', '40.64', '9.03', 'New York State Shipping', '11.96', '52.60', '', '0.00', '9.03', '', '0.00', '', '0.00', '8.37', '4.06', '48.54', '52.60', '2', '4.00', '75.00', '496', 'GBP', '1.0000', '4', '2012-04-22 02:36:03', 'Customer #4', '', '110 E 59th St ', '', 'New York City', 'New York', '10101', 'United States', 'Customer #4', '', '199 E 59th St ', '', 'New York City', 'New York', '10101', 'United States', 'customer4@fake-email-address.com', '0123465789', 'Example customer order comments');
INSERT INTO `order_summary` VALUES ('00000005', '5', '1', '139.44', '0.00', 'EU Zone 1: Standard Shipping', '7.25', '146.69', 'Discount Code \"10-FIXED-RATE\" - &pound;10 off grand total.', '10.00', '10.00', '', '0.00', '', '0.00', '20', '22.78', '113.91', '136.69', '3', '3.00', '153.00', '1395', 'GBP', '1.0000', '3', '2012-05-01 06:33:33', 'Customer #5', 'flexi cart', 'Unit 5', '226 Rue Saint-Martin', 'Paris', 'Paris', '75003', 'France (EU)', 'Customer #5', 'flexi cart', 'Unit 5', '226 Rue Saint-Martin', 'Paris', 'Paris', '75003', 'France (EU)', 'customer5@fakeemailaddress.com', '0123456789', '');
INSERT INTO `order_summary` VALUES ('00000006', '6', '1', '198.50', '6.00', 'UK Collection', '0.00', '198.50', '', '0.00', '6.00', '', '0.00', '', '0.00', '20', '14.83', '183.67', '198.50', '3', '9.00', '75.00', '2045', 'GBP', '1.0000', '4', '2012-05-08 06:30:46', 'Customer #1', '', '404 Oak Tree Road', '', 'Oaktown', 'Norfolk', 'NR1', 'United Kingdom (EU)', 'Customer #1', '', '404 Oak Tree Road', '', 'Oaktown', 'Norfolk', 'NR1', 'United Kingdom (EU)', 'customer1@fake-email-address.com', '0123456798', '');
INSERT INTO `order_summary` VALUES ('00000007', '7', '1', '36.62', '0.00', 'Australia NSW Shipping', '27.31', '63.93', '', '0.00', '0.00', '', '0.00', '', '0.00', '10', '5.81', '58.12', '63.93', '2', '2.00', '0.00', '366', 'GBP', '1.0000', '5', '2012-05-14 01:24:06', 'Customer #3', '', '42 Wallaby Way', '', 'Sydney', 'NSW', '2000', 'Australia', 'Customer #3', '', '42 Wallaby Way', '', 'Sydney', 'NSW', '2000', 'Australia', 'customer3@fake-email-address.com', '0123465789', '');
INSERT INTO `order_summary` VALUES ('00000008', '8', '1', '260.31', '0.00', 'United States (Non CA or NY) Shipping', '12.80', '273.11', '', '0.00', '0.00', '', '0.00', '', '0.00', '6', '15.46', '257.65', '273.11', '3', '5.00', '250.00', '2603', 'GBP', '1.0000', '2', '2012-05-18 21:22:32', 'Customer #4', '', '110 E 59th St', '', 'New York City', 'New York', '10101', 'United States', 'Customer #4', '', '110 E 59th St', '', 'New York City', 'New York', '10101', 'United States', 'customer4@fake-email-address.com', '0123456789', '');

-- ----------------------------
-- Table structure for `reward_points_converted`
-- ----------------------------
DROP TABLE IF EXISTS `reward_points_converted`;
CREATE TABLE `reward_points_converted` (
  `rew_convert_id` int(10) NOT NULL AUTO_INCREMENT,
  `rew_convert_ord_detail_fk` int(10) NOT NULL DEFAULT '10',
  `rew_convert_discount_fk` varchar(50) NOT NULL DEFAULT '',
  `rew_convert_points` int(10) NOT NULL DEFAULT '10',
  `rew_convert_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`rew_convert_id`),
  UNIQUE KEY `rew_convert_id` (`rew_convert_id`) USING BTREE,
  KEY `rew_convert_discount_fk` (`rew_convert_discount_fk`),
  KEY `rew_convert_ord_detail_fk` (`rew_convert_ord_detail_fk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reward_points_converted
-- ----------------------------
INSERT INTO `reward_points_converted` VALUES ('1', '1', '35', '400', '2012-05-13 00:00:00');
INSERT INTO `reward_points_converted` VALUES ('2', '2', '35', '100', '2012-05-13 00:00:00');
INSERT INTO `reward_points_converted` VALUES ('3', '7', '36', '1000', '2012-05-13 00:00:00');

-- ----------------------------
-- Table structure for `shipping_item_rules`
-- ----------------------------
DROP TABLE IF EXISTS `shipping_item_rules`;
CREATE TABLE `shipping_item_rules` (
  `ship_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `ship_item_item_fk` int(11) NOT NULL DEFAULT '0',
  `ship_item_location_fk` smallint(5) NOT NULL DEFAULT '0',
  `ship_item_zone_fk` smallint(5) NOT NULL DEFAULT '0',
  `ship_item_value` double(8,4) DEFAULT NULL,
  `ship_item_separate` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Indicate if item should have a shipping rate calculated specifically for it.',
  `ship_item_banned` tinyint(1) NOT NULL DEFAULT '0',
  `ship_item_status` tinyint(1) NOT NULL DEFAULT '0',
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
  `ship_name` varchar(50) NOT NULL DEFAULT '',
  `ship_description` varchar(50) NOT NULL DEFAULT '',
  `ship_location_fk` smallint(5) NOT NULL DEFAULT '0',
  `ship_zone_fk` smallint(5) NOT NULL DEFAULT '0',
  `ship_inc_sub_locations` tinyint(1) NOT NULL DEFAULT '0',
  `ship_tax_rate` double(7,4) DEFAULT NULL,
  `ship_discount_inclusion` tinyint(1) NOT NULL DEFAULT '0',
  `ship_status` tinyint(1) NOT NULL DEFAULT '0',
  `ship_default` tinyint(1) NOT NULL DEFAULT '0',
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
  `ship_rate_ship_fk` smallint(5) NOT NULL DEFAULT '0',
  `ship_rate_value` double(8,2) NOT NULL DEFAULT '0.00',
  `ship_rate_tare_wgt` double(8,2) NOT NULL DEFAULT '0.00',
  `ship_rate_min_wgt` double(8,2) NOT NULL DEFAULT '0.00',
  `ship_rate_max_wgt` double(8,2) NOT NULL DEFAULT '9999.00',
  `ship_rate_min_value` double(10,2) NOT NULL DEFAULT '0.00',
  `ship_rate_max_value` double(10,2) NOT NULL DEFAULT '9999.00',
  `ship_rate_status` tinyint(1) NOT NULL DEFAULT '0',
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
  `tax_location_fk` smallint(5) NOT NULL DEFAULT '0',
  `tax_zone_fk` smallint(5) NOT NULL DEFAULT '0',
  `tax_name` varchar(25) NOT NULL DEFAULT '',
  `tax_rate` double(7,4) NOT NULL DEFAULT '0.0000',
  `tax_status` tinyint(1) NOT NULL DEFAULT '0',
  `tax_default` tinyint(1) NOT NULL DEFAULT '0',
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
  `tax_item_item_fk` int(11) NOT NULL DEFAULT '0',
  `tax_item_location_fk` smallint(5) NOT NULL DEFAULT '0',
  `tax_item_zone_fk` smallint(5) NOT NULL DEFAULT '0',
  `tax_item_rate` double(7,4) NOT NULL DEFAULT '0.0000',
  `tax_item_status` tinyint(1) NOT NULL DEFAULT '0',
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
