<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: flexi cart Config
*
* Author: 
* Rob Hussey
* flexicart@haseydesign.com
* haseydesign.com/flexicart
*
* Copyright 2012 Rob Hussey
* 
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
* 
* http://www.apache.org/licenses/LICENSE-2.0
* 
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*
* Description: A full shopping cart library
* Created: 01/01/2012
* Requirements: PHP5 or above and Codeigniter 2.0+
*/

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART COLUMNS AND SUMMARY NAMES / ALIASES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * If required, it is possible to set your own name for each database table and column.
	 * Note: Only change the name in the apostrophes (after the '=' sign), and not the $config array names.
	 * Example: Change $config['cart']['items']['columns']['row_id'] = 'row_id' to $config['cart']['items']['columns']['row_id'] = 'new_column_name'.
	 * 
	 * For reference, the array key is referred to as the 'internal name' and the array value is the 'alias name'.
	 * Example: $config['cart']['items']['columns']['INTERNAL_NAME'] = 'ALIAS_NAME'.
	 */ 
	
	### Cart name alias
	
	// This is the cart session name saved as an array in the CI session, this array then contains all the other cart settings.
	$config['cart']['name'] = 'flexi_cart';

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	### Cart columns
	
	/**
	 * Required columns
	 * The following columns are required for the cart to function.
	*/
	// Items cart row identifier - set automatically.
	$config['cart']['items']['columns']['row_id'] = 'row_id';
	// Items unique ID, usually a database table row ID.
	$config['cart']['items']['columns']['item_id'] = 'id';
	// Items name and/or description.
	$config['cart']['items']['columns']['item_name'] = 'name';
	// Quantity of items selected by user.
	$config['cart']['items']['columns']['item_quantity'] = 'quantity';
	// Item selling price.
	$config['cart']['items']['columns']['item_price'] = 'price';
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * Optional columns
	 * The following columns can optionally be set to submit additional item data to the cart.
	 * This data will then overwrite any defaults set by the cart or that is available via a related database table.
	*/
	
	// Item unit weight that can be used to calculate shipping rates.
	$config['cart']['items']['columns']['item_weight'] = 'weight';
	// Manually set a tax rate for the item.
	$config['cart']['items']['columns']['item_tax_rate'] = 'tax_rate';
	// Manually set a shipping rate for the item.
	$config['cart']['items']['columns']['item_shipping_rate'] = 'shipping_rate';
	// Manually set items shipping rate to be calculated separately from other cart items.
	$config['cart']['items']['columns']['item_separate_shipping'] = 'separate_shipping'; 
	// Item option descriptions.
	$config['cart']['items']['columns']['item_options'] = 'options';
	// Manually set reward points for the item.
	$config['cart']['items']['columns']['item_reward_points'] = 'reward_points';
	// Force item to have its own cart row, regardless of whether an identical item already exists in the cart.
	$config['cart']['items']['columns']['item_unique_status'] = 'unique'; 

	###+++++++++++++++++++++++++++++++++###
	
	/**
	 * Updatable cart columns
	 * As a security measure, it is possible to define which cart columns can be updated using the 'update_cart()' function for existing items in the cart.
	 * The purpose of this is prevent a potential html field being injected by a malicious user to an update cart form, with the aim of updating a cart column like
	 * the price, item shipping and tax rate columns with their own value.
	 * 
	 * For example, if a html input field named 'price' (Default alias of 'item_price') was injected, and the cart was then updated by matching any identically 
	 * named POST data, the data array would contain a key named 'price' that would then update the carts 'price' column
	 * 
	 * If the ability to update sensitive columns is required, ensure all data submitted is validated.
	 * 
	 * By default, only the 'item_quantity' and 'item_options' columns are updatable.
	 * !IMPORTANT NOTE: Column names in the array must be the columns alias. For example, the default alias for 'item_quantity' is 'quantity'.
	 */
	$config['cart']['items']['updatable_columns'] = array(
		'quantity', 'options'
	);

	###+++++++++++++++++++++++++++++++++###
	
	/**
	 * Reserved / Auto-calculated columns
	 * The following columns are automatically generated and calculated by the cart.
	 * These cart column names are reserved, so do not add any data to the cart using these array key names as the data will be removed.
	 * Note: These columns must each be set with a unique name. Do not set them as 'FALSE' even if they are not directly used.
	 */
	 
	// Item selling price as carts default currency and tax settings.
	$config['cart']['items']['reserved_columns']['item_internal_price'] = 'internal_price';
	// Item sub-total price.
	$config['cart']['items']['reserved_columns']['item_price_total'] = 'price_total'; 
	// Tax value per item.
	$config['cart']['items']['reserved_columns']['item_tax'] = 'tax'; 
	// Item sub-total tax value.
	$config['cart']['items']['reserved_columns']['item_tax_total'] = 'tax_total'; 
	// Quantity of items in stock.
	$config['cart']['items']['reserved_columns']['item_stock_quantity'] = 'stock_quantity'; 
	// Quantity of items not included in discount.
	$config['cart']['items']['reserved_columns']['item_non_discount_quantity'] = 'non_discount_quantity';
	// Quantity of items included in discount.
	$config['cart']['items']['reserved_columns']['item_discount_quantity'] = 'discount_quantity';
	// Item discount description.
	$config['cart']['items']['reserved_columns']['item_discount_description'] = 'discount_description'; 
	// Discount value per item.
	$config['cart']['items']['reserved_columns']['item_discount_price'] = 'discount_price'; 
	// Item sub-total price of discounted and non discounted items.
	$config['cart']['items']['reserved_columns']['item_discount_price_total'] = 'discount_price_total'; 
	// Item sub-total weight.
	$config['cart']['items']['reserved_columns']['item_weight_total'] = 'weight_total'; 
	// Item sub-total reward points.
	$config['cart']['items']['reserved_columns']['item_reward_points_total'] = 'reward_points_total'; 
	// Item status message.
	$config['cart']['items']['reserved_columns']['item_status_message'] = 'status_message'; 

	// Note: The following 2 columns are only available when updating/editing a confirmed order after using the 'load_cart_data()' function.
	// Quantity of items from a confirmed order that have been shipped. 
	$config['cart']['items']['reserved_columns']['item_quantity_shipped'] = 'quantity_shipped'; 
	// Quantity of items from a confirmed order that have been cancelled.
	$config['cart']['items']['reserved_columns']['item_quantity_cancelled'] = 'quantity_cancelled'; 
	
	###+++++++++++++++++++++++++++++++++###
	
	/**
	 * User defined custom cart columns
	 * Additional user defined columns can be added to an items data array by including additional array keys (column names) and values when adding item data.
	 * However, unless the custom column is defined via the 'custom_columns' array, the column will only be present if data is submitted.
	 * By pre-defining custom columns, you can format numbers, set default values and specify if a column is required when an item is added.
	 * 
	 * Parameters: 'name' = custom column name, 'required' = whether data is required, 'regex' = validate value with a regular expression, 
	 * 'decimals' = number of decimal places (Numeric data only), 'default' = value used if empty, 'updatable' = whether data can be changed after item is added.
	 * To disable use of the custom columns feature, set ['custom_columns'] = FALSE. 
	 */ 
	$config['cart']['items']['custom_columns'] = array(
		### Example: array('name' => 'item_rrp', 'required' => FALSE, 'regex' => FALSE, 'decimals' => 2, 'default' => 0, 'updatable'=> TRUE)
		array('name' => 'user_note', 'required' => FALSE, 'regex' => FALSE, 'decimals' => FALSE, 'default' => NULL, 'updatable'=> TRUE) // This is a removable example.
	);	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// HARD-CODED CART DEFAULTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * Hard-coded values can be set to define default values for certain functions and calculations within the cart.
	 * Alternatively, database lookup tables (See further below) can be used to get default values from a database that will then override hard-coded values.
	 * If a database lookup table is used, the hard-coded defaults are not used.
	 */ 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * Shipping default values
	 * Depending on the implementation of your HTML cart page, the default shipping values could be used to match a specific shipping option
	 * (Typically using either the id or name), allowing you to select a default option before the user has had the chance themselves. 
	 * If the shipping rate is taxed, and the tax rate is different from the default cart tax rate, a shipping tax rate can be specified. 
	 */ 
	$config['defaults']['shipping']['id'] = 0;
	$config['defaults']['shipping']['name'] = FALSE;
	$config['defaults']['shipping']['description'] = FALSE;
	$config['defaults']['shipping']['value'] = 0;
	$config['defaults']['shipping']['tax_rate'] = FALSE;
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Tax default values
	 * Tax name examples are 'VAT', 'GST', 'HST'.
	 */ 
	$config['defaults']['tax']['name'] = 'VAT';
	$config['defaults']['tax']['rate'] = 20; // 20%

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * Default Shipping and Tax Locations.
	 * Shipping and tax calculations can be based on locations and zones.
	 * The default location can be defined via either the config setting below or via the location database table.
	 * However, since the location based functionality of flexi cart is only active if the location table is defined, it is likely to be more practical 
	 * to define the defaults via a column in the location table.
	 *
	 * To define the default location via the config setting below, the location value can either be a string (i.e. location name), 
	 * integer (i.e. location id in database) or an array of multiple strings and/or integers.
	 * The config values will then be matched against the database table, matching ids with table ids and string names with location names (Names are matched identically).
	 *
	 * Examples: Multiple tiered locations as an array('United States', 'New York') or one location simply as a string 'United States'. 
	 * To set no default location, set as either FALSE or array().
	 *
	 * Note: The config table name for '$config['database']['locations']['table']' and the corresponding '$config['database']['shipping_options']['table']' or
	 * '$config['database']['tax']['table']' config must be set for this default to work.
	 */
	$config['defaults']['shipping']['location'] = array('United Kingdom (EU)');
	$config['defaults']['tax']['location'] = array('United Kingdom (EU)');
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Currency default values
	 * Currency names can be either abbreviations or full names of currencies. Examples: 'GBP' or 'Pound Sterling'.
	 * It is a best practice to use HTML encoding for currency characters like the Pound and Euro. Example: £ = '&pound;' /  € = '&euro;'.
	 * Note: To automatically include a space between the symbol and the value (i.e. '£ 9.99'), add &nbsp; after the symbol code (i.e. '&pound;&nbsp;').
	 */ 
	$config['defaults']['currency']['name'] = 'GBP';
	$config['defaults']['currency']['symbol'] = '&pound;';
	$config['defaults']['currency']['symbol_suffix'] = FALSE;
	$config['defaults']['currency']['thousand_separator'] = ',';
	$config['defaults']['currency']['decimal_separator'] = '.';

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	// Default General Site Settings
	
	/**
	 * Set a prefix and suffix value to the cart order number.
	 */ 
	$config['defaults']['configuration']['order_number_prefix'] = FALSE;
	$config['defaults']['configuration']['order_number_suffix'] = FALSE;
	
	/**
	 * Should the cart order number be incremented from the last order number, or should it be a randomly generated number?
	 * Note: Order number prefixes and suffixes can still be applied to either format.
	 */ 
	$config['defaults']['configuration']['increment_order_number'] = TRUE;

	/**
	 * What is the minimum order value?
	 * This value can then be checked against the value of a particular summary column.
	 */
	$config['defaults']['configuration']['minimum_order'] = 25;

	/**
	 * How many decimals are acceptable for items quantities?
	 * Typically, this should be zero, however, some situations may require half quantities that would be entered into the cart as '0.5', this would require 1 decimal.
	 */ 
	$config['defaults']['configuration']['quantity_decimals'] = 0;

	/**
	 * Should an items quantity be incremented when an identical duplicate is added to the cart? If not, the new quantity will be used.
	 */ 
	$config['defaults']['configuration']['increment_duplicate_item_quantity'] = TRUE;

	/**
	 * If the item stock table is enabled (See 'item_stock' table below), should the maximum quantity of cart items be limited to the databases stock quantity?
	 * Example: Database item stock quantity equals 3, user adds an item quantity of 5, the cart will then alter the item cart quantity back to 3.
	 */ 
	$config['defaults']['configuration']['quantity_limited_by_stock'] = TRUE;

	/**
	 * If item stock table is enabled (See 'item_stock' table below), should out-of-stock items be automatically removed from the cart?
	 * Note: If TRUE is set, and an out-of-stock item is added to the cart, the item will be immediately removed.
	 */ 
	$config['defaults']['configuration']['remove_no_stock_items'] = FALSE; 

	/**
	 * If item stock table is enabled (See 'item_stock' table below), should stock quantities be automatically updated and managed by flexi cart?
	 * When an order is confirmed, items within the cart that are also in the 'item_stock' table will have their stock deducted.
	 * Likewise, if items within an order are cancelled, they will be auto restocked into the 'item_stock' table.
	 */ 
	$config['defaults']['configuration']['auto_allocate_stock'] = TRUE; 
	
	/**
	 * If an item is not permitted to be shipped to the current shipping location, yet the user still completes the order, 
	 * should the item details be saved to the database?
	 */ 
	$config['defaults']['configuration']['save_banned_shipping_items'] = FALSE;

	/**
	 * Set the default weight type and number of decimals to display weights by.
	 * The available weight types are 'gram', 'kilogram', 'avoir_ounce', 'avoir_pound', 'troy_ounce', 'troy_pound' and 'carat'. 
	 * Note: A weights decimal and thousand separator characters are controlled by the current currency separators.
	 */
	$config['defaults']['configuration']['weight_type'] = 'gram';
	$config['defaults']['configuration']['weight_decimals'] = 0;

	/**
	 * Should item prices be displayed including tax by default? 
	 * Note: This can be toggled by the user.
	 */ 
	$config['defaults']['configuration']['display_tax_prices'] = TRUE;

	/**
	 * Do item prices typically include tax when added to the cart?
	 * Note: Specific tax rates can be set for individual items.
	 */ 
	$config['defaults']['configuration']['price_inc_tax'] = TRUE;

	/**
	 * Should all duplicate cart items be added as a new separate row in the cart? If not the existing item will be updated.
	 */ 
	$config['defaults']['configuration']['multi_row_duplicate_items'] = FALSE;

	/**
	 * Should reward points be based on the internal value of an item, or should be based on the items current tax rate based price?
	 * Example: An item is added to the cart costing £20 including 20% tax, the user then ships to a 10% tax zone, so the item now costs £18.33.
	 * i.e. Remove 20% tax: £20 / 20% = £16.67, then add 10% tax: £16.67 * 10% = £18.33.
	 * Should the reward points be based on the dynamic tax variable price, or the initial internal £20 price? 'TRUE' = dynamic, 'FALSE' = internal.
	 */
	$config['defaults']['configuration']['dynamic_reward_points'] = TRUE;

	/**
	 * How many reward points are awarded per 1.00 currency unit of an items price?
	 * Example: A multiplier of 10 is (10 x £1.00) = 10 reward points. Therefore, an item priced at £100 would be worth 1000 reward points.
	 * Reward points are always rounded to the nearest whole number.
	 * Reward points can be manually defined when adding items to the cart.
	 */
	$config['defaults']['configuration']['reward_point_multiplier'] = 10;
	
	/**
	 * How much is each reward point worth as a currency value when converted to a reward voucher?
	 * Example: If 250 reward points were converted using a multiplier of £0.01 per point, the reward voucher would be worth £2.50 (250 x 0.01).
	 */
	$config['defaults']['configuration']['reward_voucher_multiplier'] = 0.01;
	
	/**
	 * How many reward points are required to create 1 reward voucher?
	 * Examples: 
	 * A ratio of 250 means for every 250 reward points, 1 voucher worth 250 points can be created, this voucher is then worth a defined currency value. 
	 * A customer with 500 reward points could create either 1 voucher of 500 points, or 2 vouchers with 250 points each.
	 * A customer creating a voucher with 525 reward points, would only be able to convert and use 500 points, the remaining 25 remain as active reward points.
	 */
	$config['defaults']['configuration']['reward_point_to_voucher_ratio'] = 250;
	
	/**
	 * Once an item order has been set as having been shipped to the customer, after how many days should reward points earnt from the item become active?
	 * The idea of this option is to prevent a customer from placing an order soley to earn reward points, then purchasing a second order using a reward voucher 
	 * earnt from the first order. The customer could then return the first order for a refund, but the reward points earnt from it have already been used to 
	 * purchase the second order at a cheaper price.
	 * 
	 * The number of days set should typically reflect the stores return policy, for example, if items cannot be returned after 14 days, the reward points should only become
	 * active after 14 days.
	 *
	 * Note: If flexi carts 'item_quantity_shipped' feature has been disabled, the points become active x days after the order was first received rather than the date they were shipped.
	 */
	$config['defaults']['configuration']['reward_point_days_pending'] = 14;
	
	/**
	 * How many days are reward points and vouchers valid for?
	 * Example: 365 = 365 days (1 year).
	 * Note: If soon to expire reward points are converted to a voucher, the voucher will then be valid for the number of set voucher days.
	 */
	$config['defaults']['configuration']['reward_point_days_valid'] = 365;
	$config['defaults']['configuration']['reward_voucher_days_valid'] = 365;
	
	/**
	 * Three individual custom cart statuses can be defined that can be set to affect whether discounts become active.
	 * For example, a custom status could check whether a user is logged in, by default it is set to false (0), when a user then logs in, 
	 * the status could be set to true (1) which would then enable the discount.
	 * The purpose of each status is up to the developer.
	 */ 
	$config['defaults']['configuration']['custom_status_1'] = NULL;
	$config['defaults']['configuration']['custom_status_2'] = NULL;
	$config['defaults']['configuration']['custom_status_3'] = NULL;
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DATABASE LOOKUP TABLES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * flexi cart contains many features to aid the custom development of an e-commerce site.
	 * In some instances, some of the features may be considered overkill, or may not require a database table to handle a feature.
	 * In these cases, specific database tables can be disabled, or with some tables, specific columns can be disabled if not required.
	 * In addition to this, the database tables and columns can be renamed to match the custom naming conventions.
	 *
	 * Database lookup tables can be used for numerous different features.
	 * #1: To set default cart settings from a database.
	 * #2: To enable dynamic tax and shipping rates based on the users location.
	 * #3: Lookup currency rates and discount data on items.
	 * #4: Enable the cart to save data to database order tables.
	 *
	 * If a default column is set, the returned database value will be used rather than the default hard-coded value in this file.
	 * This offers greater flexibility for users developing a CMS as they no longer have to manually edit files.
	 *
	 * Quick Reference Guide on array structuring:
	 * ['table'] = table name, 
	 * ['columns']['xxx'] = specific column name,
	 * ['default'] = column used to lookup tables default value.
	 * 
	 * Note: Only change the name in the apostrophes (after the '=' sign), and not the $config array names.
	 * Example: Change $config['database']['shipping_options']['columns']['id'] = 'ship_id' to $config['database']['shipping_options']['columns']['id'] = 'new_column_name'.
	 */ 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * Location Type Table 
	 * Contains data on the type of locations and zones available, i.e. countries, states, counties, cities and even zip/post codes.
	 *
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 * Note: If the 'Location Type' lookup table is enabled, the 'Locations' table must be too.
	 */ 
	$config['database']['location_type']['table'] = 'location_type';
	$config['database']['location_type']['columns']['id'] = 'loc_type_id';
	$config['database']['location_type']['columns']['parent'] = 'loc_type_parent_fk';
	$config['database']['location_type']['columns']['name'] = 'loc_type_name';
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Location Table (Joined to Location Type Table)
	 * Contains location and zone data used to calculate shipping and tax rates.
	 *
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 * Note: If the 'Locations' lookup table is enabled, the 'Location Type' table must be too.
	 */
	$config['database']['locations']['table'] = 'locations';
	$config['database']['locations']['columns']['id'] = 'loc_id';
	$config['database']['locations']['columns']['type'] = 'loc_type_fk';
	$config['database']['locations']['columns']['parent'] = 'loc_parent_fk';
	$config['database']['locations']['columns']['shipping_zone'] = 'loc_ship_zone_fk';
	$config['database']['locations']['columns']['tax_zone'] = 'loc_tax_zone_fk';
	$config['database']['locations']['columns']['name'] = 'loc_name';
	$config['database']['locations']['columns']['status'] = 'loc_status';

	// Default database lookup column for shipping and tax locations.
	// If set, this returned data is used instead of any defaults set via $config['defaults']['shipping']['location'] or $config['defaults']['tax']['location']. 
	// To disable the shipping default, set ['shipping_default'] = FALSE.
	// To disable the tax default, set ['tax_default'] = FALSE.
	$config['database']['locations']['shipping_default'] = 'loc_ship_default'; 
	$config['database']['locations']['tax_default'] = 'loc_tax_default';
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * Location Zones Table (Joined to Location Table)
	 * Contains data on the type of zones available. The purpose of zones is to allow the grouping of locations that would otherwise be impractical
	 * using the parent-to-child relationship offered by the Location Type tiers. 
	 * For example, to create an 'EU' tax rule, you would not be able to apply it to a location of 'Europe' as not all European countries are in the 'EU'. 
	 * So instead, create a zone called 'Tax EU Zone', independent countries can then be assigned to this zone that will now inherit a defined 'EU' tax rate.
	 * 
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 * Note: If the 'Location Zones' lookup table is enabled, the 'Locations' and 'Locations Type' tables must be enabled too.
	 */ 
	$config['database']['location_zones']['table'] = 'location_zones';
	$config['database']['location_zones']['columns']['id'] = 'lzone_id';
	$config['database']['location_zones']['columns']['name'] = 'lzone_name';
	$config['database']['location_zones']['columns']['description'] = 'lzone_description';
	$config['database']['location_zones']['columns']['status'] = 'lzone_status';
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * Shipping Options Table
	 * Contains data on the shipping options name, description and locations the option applies to.
	 *
	 * All columns are required, to disable lookup of the table (And Shipping Rate table), set ['table'] = FALSE.
	 * Note: If the 'Shipping' lookup table is enabled, the 'Shipping Rates' table must be too.
	 */ 
	$config['database']['shipping_options']['table'] = 'shipping_options';
	$config['database']['shipping_options']['columns']['id'] = 'ship_id';
	$config['database']['shipping_options']['columns']['name'] = 'ship_name';
	$config['database']['shipping_options']['columns']['description'] = 'ship_description';
	$config['database']['shipping_options']['columns']['location'] = 'ship_location_fk';
	$config['database']['shipping_options']['columns']['zone'] = 'ship_zone_fk';
	$config['database']['shipping_options']['columns']['inc_sub_locations'] = 'ship_inc_sub_locations';
	$config['database']['shipping_options']['columns']['tax_rate'] = 'ship_tax_rate';
	$config['database']['shipping_options']['columns']['discount_inclusion'] = 'ship_discount_inclusion';
	$config['database']['shipping_options']['columns']['status'] = 'ship_status';

	// Default database lookup column, if set, this returned data is used instead of any hard-coded default settings in this file. 
	// To disable, set ['default'] = FALSE.
	$config['database']['shipping_options']['default'] = 'ship_default'; 
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Shipping Rates Table (Joined to Shipping Table)
	 * Contains the shipping rates (prices) for each shipping option.
	 * The rates can be set into tiers, that alter the rate of the shipping option depending on the total weight and value of the order.
	 *
	 * All columns are required. 
	 * Note: If the 'Shipping Rate' lookup table is enabled, the 'Shipping' table must be too.
	 */ 
	$config['database']['shipping_rates']['table'] = 'shipping_rates';
	$config['database']['shipping_rates']['columns']['id'] = 'ship_rate_id';
	$config['database']['shipping_rates']['columns']['parent'] = 'ship_rate_ship_fk';
	$config['database']['shipping_rates']['columns']['value'] = 'ship_rate_value';
	$config['database']['shipping_rates']['columns']['tare_weight'] = 'ship_rate_tare_wgt';
	$config['database']['shipping_rates']['columns']['min_weight'] = 'ship_rate_min_wgt';
	$config['database']['shipping_rates']['columns']['max_weight'] = 'ship_rate_max_wgt';
	$config['database']['shipping_rates']['columns']['min_value'] = 'ship_rate_min_value';
	$config['database']['shipping_rates']['columns']['max_value'] = 'ship_rate_max_value';
	$config['database']['shipping_rates']['columns']['status'] = 'ship_rate_status';

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Item Shipping Rule Table 
	 * Contains shipping settings for specific cart items.
	 * An items individual shipping rate can either be set as free shipping or as a shipping surcharge that is added to the cart shipping total. 
	 * Items can be shipped separately from other cart items, where the shipping cost of the item is calculated and then added to the shipping total.
	 * Items can be banned from being shipped to specific locations.
	 *
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE.
	 *
	 * Note: The item shipping rule table has a one-to-many relationship with an item, i.e. one item can have many shipping rules setup for different locations.
	 * Therefore, the item shipping data must be setup as a table seperate from the custom user defined item table.
	 */ 
	$config['database']['item_shipping']['table'] = 'shipping_item_rules';
	$config['database']['item_shipping']['columns']['id'] = 'ship_item_id';
	$config['database']['item_shipping']['columns']['item'] = 'ship_item_item_fk';
	$config['database']['item_shipping']['columns']['location'] = 'ship_item_location_fk';
	$config['database']['item_shipping']['columns']['zone'] = 'ship_item_zone_fk';
	$config['database']['item_shipping']['columns']['value'] = 'ship_item_value';
	$config['database']['item_shipping']['columns']['separate'] = 'ship_item_separate';
	$config['database']['item_shipping']['columns']['banned'] = 'ship_item_banned';
	$config['database']['item_shipping']['columns']['status'] = 'ship_item_status';
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * Tax Table 
	 * Contains tax rates for specific locations and zones.
	 *
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE.
	 */ 
	$config['database']['tax']['table'] = 'tax';
	$config['database']['tax']['columns']['id'] = 'tax_id';
	$config['database']['tax']['columns']['location'] = 'tax_location_fk';
	$config['database']['tax']['columns']['zone'] = 'tax_zone_fk';
	$config['database']['tax']['columns']['name'] = 'tax_name';
	$config['database']['tax']['columns']['rate'] = 'tax_rate';
	$config['database']['tax']['columns']['status'] = 'tax_status';
	
	// Default database lookup column, if set, this returned data is used instead of any hard-coded default settings in this file. 
	// To disable, set ['default'] = FALSE.
	$config['database']['tax']['default'] = 'tax_default';

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Item Tax Table 
	 * Contains tax rates for specific cart items.
	 * Example: An item could be set for a zero tax rate to 'State A' but have a tax rate of 10% to 'State B'.
	 * Item based tax rates ignore the global cart tax rate, whilst all tax duties are still calculated correctly by the tax-total summary.
	 *
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 *
	 * Note: The item tax table has a one-to-many relationship with an item, i.e. one item can have many tax rates setup for different locations.
	 * Therefore, the item tax data must be setup as a table seperate from the custom user defined item table.
	 */ 
	$config['database']['item_tax']['table'] = 'tax_item_rates';
	$config['database']['item_tax']['columns']['id'] = 'tax_item_id';
	$config['database']['item_tax']['columns']['item'] = 'tax_item_item_fk';
	$config['database']['item_tax']['columns']['location'] = 'tax_item_location_fk';
	$config['database']['item_tax']['columns']['zone'] = 'tax_item_zone_fk';
	$config['database']['item_tax']['columns']['rate'] = 'tax_item_rate';
	$config['database']['item_tax']['columns']['status'] = 'tax_item_status';

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * Item Stock Table 
	 * Contains stock data on cart items that can be used to indicated whether an item is in stock.
	 *
	 * The 'item' and 'quantity' columns are required, to disable lookup of the table, set ['table'] = FALSE.
	 * The 'auto_allocate_status' indicates whether to check stock on a specific item. If the column is disabled, all item stock quantities will be checked.
	 *
	 * Note: The table containing the item stock data does not need to be a table dedicated to just item stock data.
	 * As the stock data has a one-to-one relationship with an item, the stock data columns could be included in a custom user defined item table.
	 * !IMPORTANT NOTE: If the stock data columns are included in a user defined item table, the 'id' column below should be set to FALSE as the 
	 * 'item' column will become the primary key column.
	 */
	$config['database']['item_stock']['table'] = 'item_stock';
	$config['database']['item_stock']['columns']['id'] = 'stock_id'; // !IMPORTANT NOTE: See above warning when setting this column.
	$config['database']['item_stock']['columns']['item'] = 'stock_item_fk';
	$config['database']['item_stock']['columns']['quantity'] = 'stock_quantity';
	$config['database']['item_stock']['columns']['auto_allocate_status'] = 'stock_auto_allocate_status';

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * Currency Table 
	 * Contains currency data and an exchange rate that can be used to convert internal site prices to other currencies.
	 *
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE.
	 */ 
	$config['database']['currency']['table'] = 'currency';
	$config['database']['currency']['columns']['id'] = 'curr_id';
	$config['database']['currency']['columns']['name'] = 'curr_name';
	$config['database']['currency']['columns']['exchange_rate'] = 'curr_exchange_rate';
	$config['database']['currency']['columns']['symbol'] = 'curr_symbol';
	$config['database']['currency']['columns']['symbol_suffix'] = 'curr_symbol_suffix';
	$config['database']['currency']['columns']['thousand_separator'] = 'curr_thousand_separator';
	$config['database']['currency']['columns']['decimal_separator'] = 'curr_decimal_separator';
	$config['database']['currency']['columns']['status'] = 'curr_status';
	
	// Default database lookup column, if set, this returned data is used instead of any hard-coded default settings in this file. 
	// To disable, set ['default'] = FALSE.
	$config['database']['currency']['default'] = 'curr_default';

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * Discounts Table 
	 * Contains item and summary discounts, based on either entered discount codes or item quantities and values added to the cart.
	 * Example: "Buy 1 get 1 free", "Enter code '12345' for free shipping".
	 *
	 * The discount table is also used to convert customer reward points to vouchers.
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 * Note: If this table is enabled, all 'Discount' tables must be enabled too.
	 */ 
	$config['database']['discounts']['table'] = 'discounts';
	$config['database']['discounts']['columns']['id'] = 'disc_id'; 
	$config['database']['discounts']['columns']['type'] = 'disc_type_fk';
	$config['database']['discounts']['columns']['method'] = 'disc_method_fk';
	$config['database']['discounts']['columns']['tax_method'] = 'disc_tax_method_fk';
	$config['database']['discounts']['columns']['user'] = 'disc_user_acc_fk'; 
	$config['database']['discounts']['columns']['item'] = 'disc_item_fk'; 
	$config['database']['discounts']['columns']['group'] = 'disc_group_fk';
	$config['database']['discounts']['columns']['location'] = 'disc_location_fk';
	$config['database']['discounts']['columns']['zone'] = 'disc_zone_fk';
	$config['database']['discounts']['columns']['code'] = 'disc_code'; 
	$config['database']['discounts']['columns']['description'] = 'disc_description'; 
	$config['database']['discounts']['columns']['quantity_required'] = 'disc_quantity_required'; 
	$config['database']['discounts']['columns']['quantity_discounted'] = 'disc_quantity_discounted'; 
	$config['database']['discounts']['columns']['value_required'] = 'disc_value_required'; 
	$config['database']['discounts']['columns']['value_discounted'] = 'disc_value_discounted'; 
	$config['database']['discounts']['columns']['recursive'] = 'disc_recursive'; 
	$config['database']['discounts']['columns']['non_combinable'] = 'disc_non_combinable_discount';
	$config['database']['discounts']['columns']['void_reward_points'] = 'disc_void_reward_points';
	$config['database']['discounts']['columns']['force_shipping_discount'] = 'disc_force_ship_discount';
	$config['database']['discounts']['columns']['custom_status_1'] = 'disc_custom_status_1';
	$config['database']['discounts']['columns']['custom_status_2'] = 'disc_custom_status_2';
	$config['database']['discounts']['columns']['custom_status_3'] = 'disc_custom_status_3';
	$config['database']['discounts']['columns']['usage_limit'] = 'disc_usage_limit';   
	$config['database']['discounts']['columns']['valid_date'] = 'disc_valid_date'; 
	$config['database']['discounts']['columns']['expire_date'] = 'disc_expire_date'; 
	$config['database']['discounts']['columns']['status'] = 'disc_status'; 
	$config['database']['discounts']['columns']['order_by'] = 'disc_order_by'; 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Discount Groups Table 
	 * To maintain flexibility with different database structures, rather than being able to apply discounts to item categories, manufacturers etc., that will 
	 * be different per database setup, discount groups can be used instead. A discount can then be applied to the group that will affect all items in the group.
	 * 
	 * The discount group setup consists of two tables, a table containing the group name, and a table containing the foreign key of the group id and item ids.
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 * Note: If this table is enabled, all 'Discount' tables must be enabled too.
	 */ 
	$config['database']['discount_groups']['table'] = 'discount_groups';
	$config['database']['discount_groups']['columns']['id'] = 'disc_group_id'; 
	$config['database']['discount_groups']['columns']['name'] = 'disc_group'; 
	$config['database']['discount_groups']['columns']['status'] = 'disc_group_status'; 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Discount Group Items Table 
	 * Contains the id of items that are in a specific discount group.
	 *
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 * Note: If this table is enabled, all 'Discount' tables must be enabled too.
	 */
	$config['database']['discount_group_items']['table'] = 'discount_group_items';
	$config['database']['discount_group_items']['columns']['id'] = 'disc_group_item_id'; 
	$config['database']['discount_group_items']['columns']['group'] = 'disc_group_item_group_fk'; 
	$config['database']['discount_group_items']['columns']['item'] = 'disc_group_item_item_fk'; 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Discount Method Table 
	 * Contains the data for the different discounts application methods.
	 * Example: A summary discount, that targets the shipping total column with a percentage based discount.
	 * 
	 * The discount method text may be changed, but no rows or columns should be deleted, added or reindexed. 
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 * Note: If this table is enabled, all 'Discount' tables must be enabled too.
	 */
	$config['database']['discount_methods']['table'] = 'discount_methods';
	$config['database']['discount_methods']['columns']['id'] = 'disc_method_id'; 
	$config['database']['discount_methods']['columns']['type'] = 'disc_method_type_fk'; 
	$config['database']['discount_methods']['columns']['target_column'] = 'disc_method_column_fk'; 
	$config['database']['discount_methods']['columns']['calculation'] = 'disc_method_calculation_fk'; 
	$config['database']['discount_methods']['columns']['method'] = 'disc_method'; 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Discount Types Table 
	 * Contains the id and text label for the different types of discounts available.
	 * Types Available: 'Item Discount', 'Summary Discount' and 'Reward Voucher' discounts.
	 * 
	 * The discount type text may be changed, but no rows or columns should be deleted, added or reindexed. 
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 * Note: If this table is enabled, all 'Discount' tables must be enabled too.
	 */
	$config['database']['discount_types']['table'] = 'discount_types';
	$config['database']['discount_types']['columns']['id'] = 'disc_type_id'; 
	$config['database']['discount_types']['columns']['type'] = 'disc_type'; 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * Discount Calculations Table 
	 * Contains the id and text label for the different types of discount calculation methods.
	 * Types Available: 'Percentage based', 'Flat Fee' and 'New Value' discounts.
	 * 
	 * This table is used internally by flexi cart and should not need to be used directly.
	 *
	 * The discount calculation text may be changed, but no rows or columns should be deleted, added or reindexed. 
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 * Note: If this table is enabled, all 'Discount' tables must be enabled too.
	 */
	$config['database']['discount_calculation']['table'] = 'discount_calculation';
	$config['database']['discount_calculation']['columns']['id'] = 'disc_calculation_id'; 
	$config['database']['discount_calculation']['columns']['calculation'] = 'disc_calculation'; 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Discount Columns Table 
	 * Contains the id and text label for the different cart columns that discounts can be applied to. 
	 * Types Available: 'Item price', 'Item Shipping', 'Summary Item Total', 'Summary Shipping Total', 'Summary Total' and 'Summary Total (Voucher)'.
	 * 
	 * This table is used internally by flexi cart and should not need to be used directly.
	 *
	 * The discount column text may be changed, but no rows or columns should be deleted, added or reindexed. 
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 * Note: If this table is enabled, all 'Discount' tables must be enabled too.
	 */
	$config['database']['discount_columns']['table'] = 'discount_columns';
	$config['database']['discount_columns']['columns']['id'] = 'disc_column_id'; 
	$config['database']['discount_columns']['columns']['target_column'] = 'disc_column'; 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Discount Tax Methods Table 
	 * Contains the id and text label for the different methods of applying tax to discounts.
	 * 
	 * The discount tax method text may be changed, but no rows or columns should be deleted, added or reindexed. 
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 * Note: If this table is enabled, all 'Discount' tables must be enabled too.
	 */
	$config['database']['discount_tax_methods']['table'] = 'discount_tax_methods';
	$config['database']['discount_tax_methods']['columns']['id'] = 'disc_tax_method_id'; 
	$config['database']['discount_tax_methods']['columns']['method'] = 'disc_tax_method'; 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * Order Summary Table 
	 * The order tables are designed to relate any data available from the cart session to a database column.
	 * When saving the cart to the database, any table columns that are related to item and summary data in the cart will be automatically saved to the database.
	 * 
	 * To prevent a column from the cart session being saved, set the column name to 'FALSE', and it will be ignored.
	 * Example: $config['database']['order_summary']['columns']['total_weight'] = FALSE;
	 * The 'order_number', 'status' and 'date' columns are the only required fields.
	 * The 'cart_data' column must be enabled if saved cart data is to be reloaded from a saved order.
	 *
	 * The table must be enabled if any cart data is to be saved as an order using flexi cart. However, to disable the table, set ['table'] = FALSE. 
	 */ 
	$config['database']['order_summary']['table'] = 'order_summary';
	$config['database']['order_summary']['columns']['order_number'] = 'ord_order_number';
	$config['database']['order_summary']['columns']['cart_data'] = 'ord_cart_data_fk';
	$config['database']['order_summary']['columns']['user'] = 'ord_user_fk';
	$config['database']['order_summary']['columns']['item_summary_total'] = 'ord_item_summary_total';
	$config['database']['order_summary']['columns']['item_summary_savings_total'] = 'ord_item_summary_savings_total';
	$config['database']['order_summary']['columns']['shipping_name'] = 'ord_shipping';
	$config['database']['order_summary']['columns']['shipping_total'] = 'ord_shipping_total';
	$config['database']['order_summary']['columns']['item_shipping_total'] = 'ord_item_shipping_total'; // Item total + shipping total
	$config['database']['order_summary']['columns']['summary_discount_description'] = 'ord_summary_discount_desc';
	$config['database']['order_summary']['columns']['summary_savings_total'] = 'ord_summary_savings_total';
	$config['database']['order_summary']['columns']['savings_total'] = 'ord_savings_total';
	$config['database']['order_summary']['columns']['surcharge_description'] = 'ord_surcharge_desc';
	$config['database']['order_summary']['columns']['surcharge_total'] = 'ord_surcharge_total';
	$config['database']['order_summary']['columns']['reward_voucher_description'] = 'ord_reward_voucher_desc';
	$config['database']['order_summary']['columns']['reward_voucher_total'] = 'ord_reward_voucher_total';
	$config['database']['order_summary']['columns']['tax_rate'] = 'ord_tax_rate';
	$config['database']['order_summary']['columns']['tax_total'] = 'ord_tax_total';
	$config['database']['order_summary']['columns']['sub_total'] = 'ord_sub_total'; // Grand total excluding tax
	$config['database']['order_summary']['columns']['total'] = 'ord_total';
	$config['database']['order_summary']['columns']['total_rows'] = 'ord_total_rows';
	$config['database']['order_summary']['columns']['total_items'] = 'ord_total_items';
	$config['database']['order_summary']['columns']['total_weight'] = 'ord_total_weight';
	$config['database']['order_summary']['columns']['total_reward_points'] = 'ord_total_reward_points';
	$config['database']['order_summary']['columns']['currency_name'] = 'ord_currency';
	$config['database']['order_summary']['columns']['exchange_rate'] = 'ord_exchange_rate';
	$config['database']['order_summary']['columns']['status'] = 'ord_status';
	$config['database']['order_summary']['columns']['date'] = 'ord_date';

	/**
	 * Order Summary Searchable Columns
	 * Searchable order summary columns, used in conjunction with the search_orders() function.
	 */
	$config['database']['order_summary']['search_order_cols'] = array(
		'ord_demo_bill_name', 'ord_demo_bill_company', 'ord_demo_bill_post_code',
		'ord_demo_ship_name', 'ord_ship_bill_company', 'ord_demo_ship_post_code', 'ord_demo_email'
	);

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * Order Details Table 
	 * Contains the saved order details of each cart item row as an individual row in the database.
	 * 
	 * To prevent a column from the cart session being saved, set the column name to 'FALSE', and it will be ignored.
	 * Example: $config['database']['order_details']['columns']['item_stock_quantity'] = FALSE;
	 * The 'id' and 'order_number' column are the only required fields.
	 * The 'cart_row_id' column must be enabled if original order data is to be preserved when using the 'resave_order()' function.
	 * The 'item_id' column must be enabled if the config setting 'auto_allocate_stock' is also enabled.
	 * The 'item_quantity', 'item_quantity_shipped', 'item_quantity_cancelled', and 'item_shipped_date' columns must be enabled if the 'shipped' and 'cancelled'
	 * quantity of ordered items is to be validated by flexi cart. These quantities are also required for reward point calculations.
	 *
	 * The table must be enabled if any cart data is to be saved as an order using flexi cart. However, to disable the table, set ['table'] = FALSE. 
	 */ 
	$config['database']['order_details']['table'] = 'order_details';
	$config['database']['order_details']['columns']['id'] = 'ord_det_id';
	$config['database']['order_details']['columns']['order_number'] = 'ord_det_order_number_fk';
	$config['database']['order_details']['columns']['cart_row_id'] = 'ord_det_cart_row_id';
	$config['database']['order_details']['columns']['item_id'] = 'ord_det_item_fk';
	$config['database']['order_details']['columns']['item_name'] = 'ord_det_item_name';
	$config['database']['order_details']['columns']['item_options'] = 'ord_det_item_option';
	$config['database']['order_details']['columns']['item_quantity'] = 'ord_det_quantity';
	$config['database']['order_details']['columns']['item_non_discount_quantity'] = 'ord_det_non_discount_quantity';
	$config['database']['order_details']['columns']['item_discount_quantity'] = 'ord_det_discount_quantity';
	$config['database']['order_details']['columns']['item_stock_quantity'] = 'ord_det_stock_quantity';
	$config['database']['order_details']['columns']['item_price'] = 'ord_det_price';
	$config['database']['order_details']['columns']['item_price_total'] = 'ord_det_price_total';
	$config['database']['order_details']['columns']['item_discount_price'] = 'ord_det_discount_price';
	$config['database']['order_details']['columns']['item_discount_price_total'] = 'ord_det_discount_price_total';
	$config['database']['order_details']['columns']['item_discount_description'] = 'ord_det_discount_description';
	$config['database']['order_details']['columns']['item_tax_rate'] = 'ord_det_tax_rate';
	$config['database']['order_details']['columns']['item_tax'] = 'ord_det_tax';
	$config['database']['order_details']['columns']['item_tax_total'] = 'ord_det_tax_total';
	$config['database']['order_details']['columns']['item_shipping_rate'] = 'ord_det_shipping_rate';
	$config['database']['order_details']['columns']['item_weight'] = 'ord_det_weight';
	$config['database']['order_details']['columns']['item_weight_total'] = 'ord_det_weight_total'; 
	$config['database']['order_details']['columns']['item_reward_points'] = 'ord_det_reward_points';
	$config['database']['order_details']['columns']['item_reward_points_total'] = 'ord_det_reward_points_total';
	$config['database']['order_details']['columns']['item_status_message'] = 'ord_det_status_message';
	$config['database']['order_details']['columns']['item_quantity_shipped'] = 'ord_det_quantity_shipped';
	$config['database']['order_details']['columns']['item_quantity_cancelled'] = 'ord_det_quantity_cancelled';
	$config['database']['order_details']['columns']['item_shipped_date'] = 'ord_det_shipped_date';
	
	/**
	 * Order Detail Custom Columns
	 * The order detail custom columns are designed to link any columns that may have been added to the carts item custom column array.
	 * This array can be located at the top of this file as $config['cart']['items']['custom_columns'].
	 * To disable use of the custom columns feature, set ['custom_columns'] = array(). 
	 * !IMPORTANT NOTE: The custom column array MUST be setup with the cart alias name set as the key, and the table column name as the value.
	 */ 
	$config['database']['order_details']['custom_columns'] = array(
		### Example: 'item_custom_column_name' => 'database_column_name'
		'user_note' => 'ord_det_demo_user_note' // This is a removable example linked to the 'user_note' in the $config['cart']['items']['custom_columns'] array at the top.
	);
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * Order Status Table 
	 * Contains the order statuses that are used to indicate the progress of an order.
	 *
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 * Note: If this table is enabled, all 'Order' tables must be enabled too.
	 */
	$config['database']['order_status']['table'] = 'order_status';
	$config['database']['order_status']['columns']['id'] = 'ord_status_id';
	$config['database']['order_status']['columns']['status'] = 'ord_status_description';
	$config['database']['order_status']['columns']['cancelled'] = 'ord_status_cancelled';
	$config['database']['order_status']['columns']['save_default'] = 'ord_status_save_default';
	$config['database']['order_status']['columns']['resave_default'] = 'ord_status_resave_default';
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * Database Cart Data Table 
	 * Contains cart data that has been saved to the database so that the cart session can be reloaded at a later time.
	 *
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE. 
	 */
	$config['database']['db_cart_data']['table'] = 'cart_data';
	$config['database']['db_cart_data']['columns']['id'] = 'cart_data_id';
	$config['database']['db_cart_data']['columns']['user'] = 'cart_data_user_fk';
	$config['database']['db_cart_data']['columns']['cart_data'] = 'cart_data_array';
	$config['database']['db_cart_data']['columns']['date'] = 'cart_data_date';
	$config['database']['db_cart_data']['columns']['readonly_status'] = 'cart_data_readonly_status';
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * Reward Points Pseudo Table 
	 * Contains data on reward points that have been earnt by registered users when completing an order.
	 *
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE.
	 * Note: If this table is enabled, the 'Reward Points Converted' and all 'Discount' and 'Order' tables must be enabled too.
	 */ 
	 
	/* !IMPORTANT NOTE: DO NOT CHANGE ANY VALUES BETWEEN THE 'START' AND THE 'END' COMMENTS - UNLESS DISABLING THE TABLE | START */
	$config['database']['reward_points']['table'] = $config['database']['order_summary']['table'];
	$config['database']['reward_points']['join_table'] = $config['database']['order_details']['table'];
	$config['database']['reward_points']['join'] = $config['database']['order_summary']['columns']['order_number'].' = '.$config['database']['order_details']['columns']['order_number'];
	$config['database']['reward_points']['columns']['id'] = $config['database']['order_details']['columns']['id'];
	$config['database']['reward_points']['columns']['user'] = $config['database']['order_summary']['columns']['user'];
	$config['database']['reward_points']['columns']['order_number'] = $config['database']['order_summary']['columns']['order_number'];
	$config['database']['reward_points']['columns']['description'] = $config['database']['order_details']['columns']['item_name'];
	$config['database']['reward_points']['columns']['points'] = $config['database']['order_details']['columns']['item_reward_points'];
	$config['database']['reward_points']['columns']['item_quantity'] = $config['database']['order_details']['columns']['item_quantity'];
	$config['database']['reward_points']['columns']['item_quantity_shipped'] = $config['database']['order_details']['columns']['item_quantity_shipped'];
	$config['database']['reward_points']['columns']['item_quantity_cancelled'] = $config['database']['order_details']['columns']['item_quantity_cancelled'];
	$config['database']['reward_points']['columns']['item_shipped_date'] = $config['database']['order_details']['columns']['item_shipped_date'];
	$config['database']['reward_points']['columns']['order_date'] = $config['database']['order_summary']['columns']['date'];
	$config['database']['reward_points']['columns']['status'] = $config['database']['order_summary']['columns']['status'];
	/* END */

	/**
	 * Pseudo Reward Point Columns
	 * Contains itemised (row) and summarised (total) data on the status of reward points earnt from each item row within the database orders table.
	 *
	 * The columns below are not part of any table, but are generated and returned by reward point functions.
	 * All columns are required.
	 */
	 
	// Itemised values.
	$config['database']['reward_points']['columns']['row_points_total'] = 'row_points_total';
	$config['database']['reward_points']['columns']['row_points_pending'] = 'row_points_pending'; 
	$config['database']['reward_points']['columns']['row_points_active'] = 'row_points_active'; 
	$config['database']['reward_points']['columns']['row_points_expired'] = 'row_points_expired'; 
	$config['database']['reward_points']['columns']['row_points_converted'] = 'row_points_converted'; 
	$config['database']['reward_points']['columns']['row_points_cancelled'] = 'row_points_cancelled'; 
	$config['database']['reward_points']['columns']['activate_date'] = 'points_activate_date'; 
	$config['database']['reward_points']['columns']['expire_date'] = 'points_expire_date'; 

	// Summary values.
	$config['database']['reward_points']['columns']['total_points'] = 'total_points'; 
	$config['database']['reward_points']['columns']['total_points_pending'] = 'total_points_pending'; 
	$config['database']['reward_points']['columns']['total_points_active'] = 'total_points_active'; 
	$config['database']['reward_points']['columns']['total_points_expired'] = 'total_points_expired'; 
	$config['database']['reward_points']['columns']['total_points_converted'] = 'total_points_converted'; 
	$config['database']['reward_points']['columns']['total_points_cancelled'] = 'total_points_cancelled'; 
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		
	/**
	 * Converted Reward Points Table
	 * Contains data on reward points that have been converted to discount codes.
	 * 
	 * All columns are required, to disable lookup of the table, set ['table'] = FALSE.
	 * Note: If this table is enabled, the 'Reward Points' and all 'Discount' and 'Order' tables must be enabled too.
	 */ 
	$config['database']['reward_points_converted']['table'] = 'reward_points_converted';
	$config['database']['reward_points_converted']['columns']['id'] = 'rew_convert_id';
	$config['database']['reward_points_converted']['columns']['reward'] = 'rew_convert_ord_detail_fk';
	$config['database']['reward_points_converted']['columns']['discount'] = 'rew_convert_discount_fk';
	$config['database']['reward_points_converted']['columns']['points'] = 'rew_convert_points';
	$config['database']['reward_points_converted']['columns']['date'] = 'rew_convert_date';	
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * Site Configuration Table
	 * Contains general site configurations that control specific functions and calculations of the shopping cart.
	 * 
	 * To disable any specific column in this settings table, define the column as FALSE, example ['columns']['order_number_prefix'] = FALSE.
	 * If a column is disabled, the hard coded default value in this config file will be used, example $config['defaults']['configuration']['order_number_prefix'].
	 * To disable use of the entire table, set ['table'] = FALSE.
	 * Note: See $config['defaults'] above for explanations on the function of each of these settings.
	 */ 
	$config['database']['configuration']['table'] = 'cart_config';
	$config['database']['configuration']['columns']['id'] = 'config_id';
	$config['database']['configuration']['columns']['order_number_prefix'] = 'config_order_number_prefix';
	$config['database']['configuration']['columns']['order_number_suffix'] = 'config_order_number_suffix'; 
	$config['database']['configuration']['columns']['increment_order_number'] = 'config_increment_order_number';
	$config['database']['configuration']['columns']['minimum_order'] = 'config_min_order';
	$config['database']['configuration']['columns']['quantity_decimals'] = 'config_quantity_decimals';
	$config['database']['configuration']['columns']['increment_duplicate_item_quantity'] = 'config_increment_duplicate_items';
	$config['database']['configuration']['columns']['quantity_limited_by_stock'] = 'config_quantity_limited_by_stock';
	$config['database']['configuration']['columns']['remove_no_stock_items'] = 'config_remove_no_stock_items';
	$config['database']['configuration']['columns']['auto_allocate_stock'] = 'config_auto_allocate_stock';
	$config['database']['configuration']['columns']['save_banned_shipping_items'] = 'config_save_ban_shipping_items';
	$config['database']['configuration']['columns']['weight_type'] = 'config_weight_type';
	$config['database']['configuration']['columns']['weight_decimals'] = 'config_weight_decimals';
	$config['database']['configuration']['columns']['display_tax_prices'] = 'config_display_tax_prices';
	$config['database']['configuration']['columns']['price_inc_tax'] = 'config_price_inc_tax';
	$config['database']['configuration']['columns']['multi_row_duplicate_items'] = 'config_multi_row_duplicate_items';
	$config['database']['configuration']['columns']['dynamic_reward_points'] = 'config_dynamic_reward_points';
	$config['database']['configuration']['columns']['reward_point_multiplier'] = 'config_reward_point_multiplier';
	$config['database']['configuration']['columns']['reward_voucher_multiplier'] = 'config_reward_voucher_multiplier';
	$config['database']['configuration']['columns']['reward_point_to_voucher_ratio'] = 'config_reward_voucher_ratio';
	$config['database']['configuration']['columns']['reward_point_days_pending'] = 'config_reward_point_days_pending';
	$config['database']['configuration']['columns']['reward_point_days_valid'] = 'config_reward_point_days_valid';
	$config['database']['configuration']['columns']['reward_voucher_days_valid'] = 'config_reward_voucher_days_valid';
	$config['database']['configuration']['columns']['custom_status_1'] = 'config_custom_status_1';
	$config['database']['configuration']['columns']['custom_status_2'] = 'config_custom_status_2';
	$config['database']['configuration']['columns']['custom_status_3'] = 'config_custom_status_3';
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM VALIDATION RULES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * Regex cart item id rule
	 * By default, item id rules are disabled (Set to FALSE), but can be added by adding a regular expression like the example below.
	 * Example: '0-9' allows alpha-numeric, dashes, underscores and periods.
	 */ 
	$config['settings']['item_id_rules'] = '0-9';
	
	/**
	 * Regex cart item name rule
	 * By default, item name rules are disabled (Set to FALSE), but can be added by adding a regular expression like the example below.
	 * Example: '\.\,\:\-_ a-z0-9\#' allows alpha-numeric, dashes, underscores, colons, periods and commas.
	 */ 
	$config['settings']['item_name_rules'] = FALSE;
	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DATE AND TIME SETTINGS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * Database date/time format
	 * Define the date and time data format used within flexi cart functions.
	 * Note: The 'date_time' is used by the discount and order detail tables, therefore, both tables must use the same data type.
	 *
	 * MySQL DATETIME = date('Y-m-d H:i:s');
	 * UNIX Timestamp = time();
	 */ 
	$config['settings']['date_time'] = date('Y-m-d H:i:s');

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// EMAIL SETTINGS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * Email settings
	 * Defines the email template and settings that are used to email users a copy of their order.
	 */ 

	// Site title shown as 'from' header on emails.
	$config['email']['site_title'] = 'flexi cart';
	
	// Reply email shown as 'from' header on emails.
	$config['email']['reply_email'] = 'info@website.com';
	
	// Type of email to send, options: 'html', 'text'.
	$config['email']['email_type'] = 'html';
	
	// Path to order confirmation email template.
	$config['email']['email_template'] = 'includes/email/order_email.tpl.php';

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MESSAGE SETTINGS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * Message Delimiter Settings
	 * Define status and error message delimiters to style cart messages.
	 * Example: Start Delimiter '<p class="status_msg">', End Delimiter '</p>'
	 */ 
	
	// Status Message Start Delimiter
	$config['messages']['delimiters']['status_prefix'] = '<p class="status_msg">';
	
	// Status Message End Delimiter
	$config['messages']['delimiters']['status_suffix'] = '</p>';
	
	// Error Message Start Delimiter
	$config['messages']['delimiters']['error_prefix'] = '<p class="error_msg">';
	
	// Error Message End Delimiter
	$config['messages']['delimiters']['error_suffix'] = '</p>';

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * Public and Admin Messages
	 * Define which status and error messages are returned as public or admin messages, or which messages are not returned at all.
	 * Public messages are intended to be displayed to public and admin users, whilst admin messages are intended for admin users only.
	 *
	 * Example:
	 * Public and admin message = $config['messages']['target_user']['items_added_successfully'] = 'public';
	 * Admin only message = $config['messages']['target_user']['items_added_successfully'] = 'admin';
	 * Do NOT set public or admin message = $config['messages']['target_user']['items_added_successfully'] = FALSE;
	 */ 
	 
	// Cart Item functions
	$config['messages']['target_user']['items_added_successfully'] = 'public';
	$config['messages']['target_user']['no_items_added'] = 'public';
	$config['messages']['target_user']['items_updated_successfully'] = 'public';
	$config['messages']['target_user']['no_items_updated'] = 'public';
	$config['messages']['target_user']['items_deleted_successfully'] = 'public';
	
	// Validate Item data 
	$config['messages']['target_user']['invalid_data'] = 'admin';
	$config['messages']['target_user']['invalid_item_id'] = 'admin';
	$config['messages']['target_user']['invalid_item_name'] = 'admin';
	$config['messages']['target_user']['invalid_item_quantity'] = 'admin';
	$config['messages']['target_user']['invalid_item_price'] = 'admin';
	$config['messages']['target_user']['invalid_custom_data'] = 'admin';
	
	// Item Statuses
	// Note: The language file values 'item_stock_insufficient', 'item_stock_insufficient_adjusted', 'item_out_of_stock' and 'item_shipping_location_ban' are not
	// sitewide status or error messages, and so cannot be set as public or admin. They are instead set to the related cart item data.
	$config['messages']['target_user']['item_out_of_stock_removed'] = 'public';
	$config['messages']['target_user']['item_shipping_banned'] = 'admin';
	
	// Shipping
	$config['messages']['target_user']['shipping_location_updated_successfully'] = 'admin';
	$config['messages']['target_user']['shipping_location_update_unsuccessful'] = 'admin';
	$config['messages']['target_user']['shipping_updated_successfully'] = 'admin';
	$config['messages']['target_user']['shipping_update_unsuccessful'] = 'admin';
	
	// Tax
	$config['messages']['target_user']['tax_location_updated_successfully'] = 'admin';
	$config['messages']['target_user']['tax_location_update_unsuccessful'] = 'admin';
	$config['messages']['target_user']['tax_updated_successfully'] = 'admin';
	$config['messages']['target_user']['tax_update_unsuccessful'] = 'admin';
	
	// Discounts
	$config['messages']['target_user']['discounts_updated_successfully'] = 'public';
	$config['messages']['target_user']['discount_update_unsuccessful'] = 'public';
	$config['messages']['target_user']['discount_codes_valid'] = 'public';
	$config['messages']['target_user']['discount_codes_invalid'] = 'public';
	$config['messages']['target_user']['discount_unset_successfully'] = 'public';
	$config['messages']['target_user']['discount_unset_unsuccessful'] = 'public';
	$config['messages']['target_user']['excluded_discount_reenabled'] = 'public';
	$config['messages']['target_user']['duplicate_discount_code'] = 'admin'; // Set if duplicate discount code is inserted/updated to the db.

	// Surcharges
	$config['messages']['target_user']['surcharge_updated_successfully'] = 'admin';
	$config['messages']['target_user']['surcharge_update_unsuccessful'] = 'admin';
	$config['messages']['target_user']['surcharge_unset_successful'] = 'admin';
	$config['messages']['target_user']['surcharge_unset_unsuccessful'] = 'admin';

	// Currency
	$config['messages']['target_user']['currency_updated_successfully'] = 'public';
	$config['messages']['target_user']['currency_update_unsuccessful'] = 'public';

	// Save Order
	$config['messages']['target_user']['cart_order_save_successful'] = 'public';
	$config['messages']['target_user']['cart_order_save_unsuccessful'] = 'public';
	$config['messages']['target_user']['resave_order_does_not_exist'] = 'admin';
	$config['messages']['target_user']['order_number_exists'] = 'admin';

	// Database Cart Data
	$config['messages']['target_user']['cart_data_save_successful'] = 'public';
	$config['messages']['target_user']['cart_data_save_unsuccessful'] = 'public';
	$config['messages']['target_user']['cart_data_load_successful'] = 'public';
	$config['messages']['target_user']['cart_data_load_unsuccessful'] = 'public';
	$config['messages']['target_user']['cart_data_delete_successful'] = 'public';
	$config['messages']['target_user']['cart_data_delete_unsuccessful'] = 'public';

	// Misc Settings
	$config['messages']['target_user']['send_email_successful'] = 'public';
	$config['messages']['target_user']['send_email_unsuccessful'] = 'public';
	$config['messages']['target_user']['database_table_column_disabled'] = 'admin';
	$config['messages']['target_user']['cart_emptied'] = 'public';
	$config['messages']['target_user']['cart_destroyed'] = 'public';

	// Data Updated
	$config['messages']['target_user']['session_config_data_updated'] = 'admin';
	$config['messages']['target_user']['database_data_inserted'] = 'admin';
	$config['messages']['target_user']['database_data_updated'] = 'admin';
	$config['messages']['target_user']['database_data_deleted'] = 'admin';	
		
/* End of file flexi_cart.php */
/* Location: ./system/application/config/flexi_cart.php */