<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: flexi cart lang - English
* 
* Author: 
* Rob Hussey
* flexicart@haseydesign.com
* haseydesign.com/flexicart
*
* Created: 01/01/2012
*
* Description:
* English language file for flexi cart
*
* Requirements: PHP5 or above and Codeigniter 2.0+
*/

// Cart Item functions
$lang['items_added_successfully']					= "Item has been added to the cart.";
$lang['no_items_added']								= "No items have been added to the cart.";
$lang['items_updated_successfully']					= "Cart items have been updated.";
$lang['no_items_updated']							= "No cart items have been updated.";
$lang['items_deleted_successfully']					= "Item(s) has been deleted from the cart.";

// Validate Item data 
$lang['invalid_data']								= "Invalid data has been submitted.";
$lang['invalid_item_id']							= "Invalid item ID has been submitted.";
$lang['invalid_item_name']							= "Invalid item name has been submitted.";
$lang['invalid_item_quantity']						= "Invalid item quantity has been submitted.";
$lang['invalid_item_price']							= "Invalid item price has been submitted.";
$lang['invalid_custom_data']						= "Invalid item custom data has been submitted.";

// Item Statuses
$lang['item_stock_insufficient']					= "There is insufficient stock to fulfill the quantity of items in the cart.";
$lang['item_stock_insufficient_adjusted']			= "There is insufficient stock for this item, its quantity has been adjusted accordingly.";
$lang['item_out_of_stock']							= "Item is out of stock.";
$lang['item_out_of_stock_removed']					= "Item(s) have been removed from the cart as they are no longer in stock.";
$lang['item_shipping_location_ban']					= "This item cannot be shipped to the current shipping location.";
$lang['item_shipping_banned']						= "There are no items in the cart that can be shipped to the current shipping location.";

// Shipping 
$lang['shipping_location_updated_successfully']		= "Shipping location has been updated.";
$lang['shipping_location_update_unsuccessful']		= "Shipping location was not updated.";
$lang['shipping_updated_successfully']				= "Shipping has been updated.";
$lang['shipping_update_unsuccessful']				= "Shipping could not be updated.";

// Tax
$lang['tax_location_updated_successfully']			= "Tax location has been updated.";
$lang['tax_location_update_unsuccessful']			= "Tax location was not updated.";
$lang['tax_updated_successfully']					= "Tax has been updated.";
$lang['tax_update_unsuccessful']					= "Tax could not be updated.";

// Discounts
$lang['discounts_updated_successfully']				= "Discounts have been updated.";
$lang['discount_update_unsuccessful']				= "Discounts were not updated.";
$lang['discount_codes_valid']						= "Discount code(s) has been set.";
$lang['discount_codes_invalid']						= "Discount code(s) is invalid.";
$lang['discount_unset_successfully']				= "Discount(s) has been removed.";
$lang['discount_unset_unsuccessful']				= "Discount(s) could not be removed.";
$lang['excluded_discount_reenabled']				= "Excluded discount(s) have been re-enabled.";
$lang['duplicate_discount_code']					= "A discount/reward voucher with this code already exists.";

// Surcharges
$lang['surcharge_updated_successfully']				= "Surcharge has been updated.";
$lang['surcharge_update_unsuccessful']				= "Surcharge could not be updated.";
$lang['surcharge_unset_successful']					= "Surcharge(s) has been removed.";
$lang['surcharge_unset_unsuccessful']				= "Surcharge(s) could not be removed.";

// Currency
$lang['currency_updated_successfully']				= "Currency has been updated.";
$lang['currency_update_unsuccessful']				= "Currency could not be updated.";

// Save Order
$lang['cart_order_save_successful']					= "Order details have been saved.";
$lang['cart_order_save_unsuccessful']				= "Order details could not be saved.";
$lang['resave_order_does_not_exist']				= "The table data of the original order cannot be found to resave data to.";
$lang['order_number_exists']						= "An order with this order number already exists.";

// Database Cart Data
$lang['cart_data_save_successful']					= "Cart data has been saved.";
$lang['cart_data_save_unsuccessful']				= "Cart data could not be saved.";
$lang['cart_data_load_successful']					= "Cart data has been loaded.";
$lang['cart_data_load_unsuccessful']				= "Cart data could not be loaded.";
$lang['cart_data_delete_successful']				= "Cart data has been deleted.";
$lang['cart_data_delete_unsuccessful']				= "Cart data could not be deleted.";

// Misc Settings
$lang['send_email_successful']						= "Email has been sent.";
$lang['send_email_unsuccessful']					= "The was an error sending the email.";
$lang['database_table_column_disabled']				= "The database lookup table and/or column is disabled.";
$lang['cart_emptied']								= "All items have been removed from the cart.";
$lang['cart_destroyed']								= "All cart items and settings have been destroyed.";

// Data Updated
$lang['session_config_data_updated']				= "Cart configuration has been updated.";
$lang['database_data_inserted']						= "Data has been inserted.";
$lang['database_data_updated']						= "Data has been updated.";
$lang['database_data_deleted']						= "Data has been deleted.";