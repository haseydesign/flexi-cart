<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: flexi cart standard model
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

class Flexi_cart_model extends Flexi_cart_lite_model
{
	public function __construct() {}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART CRUD FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * insert_item
	 * Sets and formats column data for each item.
	 */
	public function insert_item($item_data = FALSE, $update_existing_items = FALSE)
	{
		if (! is_array($item_data) || empty($item_data) || ! $this->flexi_cart_lite_model->is_positive($item_data[$this->flexi->cart_columns['item_quantity']]))
		{
			$this->set_error_message('invalid_data', 'config');
			return FALSE;
		}
		
		// Check array contains all required cart columns
		foreach($item_data as $column => $value)
		{
			if (! isset($column) && in_array($column, $this->required_columns()))
			{
				$this->set_error_message('invalid_data', 'config');
				return FALSE;
			}
		}
		
		// Generate a row id from the submitted item id and option data.
		$row_id = $this->generate_row_id($item_data);
			
		// Check if the generated row id already exists in the cart, if not, its a new addition to the cart, else, the item already exists.
		if (! isset($this->flexi->cart_contents['items'][$row_id]) || $update_existing_items)
		{
			// Prepare and format submitted item data.
			if (! $item = $this->get_item_data($item_data, $item_data, TRUE))
			{
				return FALSE;
			}
			
			// Set user defined custom data.
			// Loops through all user defined columns, validating and formating data.
			if (is_array($this->flexi->cart['items']['custom_columns']) && ! empty($this->flexi->cart['items']['custom_columns']))
			{
				foreach($this->flexi->cart['items']['custom_columns'] as $custom_column)
				{
					if (! $item = $this->get_custom_item_data($item, $item_data, $custom_column))
					{
						return FALSE;
					}
				}
			}
			
			// Set item data to cart array.
			$this->set_item_data($item, FALSE);
		}
		// Else, an item with an identical id and item options already exists in the cart, therefore, check whether to increment the quantity.
		else if ($this->flexi_cart_lite_model->get_config_setting('increment_duplicate_item_quantity'))
		{
			$this->flexi->cart_contents['items'][$row_id][$this->flexi->cart_columns['item_quantity']] += $item_data[$this->flexi->cart_columns['item_quantity']];
		}		
				
		return TRUE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * update_item
	 * Updates column data for each item
	 */	
	public function update_item($item_data = array(), $force_column_update = FALSE)
	{
		if (! isset($item_data[$this->flexi->cart_columns['row_id']]) || 
			! isset($this->flexi->cart_contents['items'][$item_data[$this->flexi->cart_columns['row_id']]]))
		{
			$this->set_error_message('invalid_data', 'config');
			return FALSE;
		}

		$recalculate_cart = FALSE;
		
		// Create short alias names.
		$row_id = $item_data[$this->flexi->cart_columns['row_id']];
		$item = $this->flexi->cart_contents['items'][$row_id];

		// Remove from cart if quantity is not positive.
		if (isset($item_data[$this->flexi->cart_columns['item_quantity']]) &&
			! $this->flexi_cart_lite_model->is_positive($item_data[$this->flexi->cart_columns['item_quantity']]))
		{
			unset($this->flexi->cart_contents['items'][$row_id]);
			unset($this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]);		
			$recalculate_cart = TRUE;
		}
		else
		{
			// Prepare and format submitted item data.
			if (! $item = $this->get_item_data($item, $item_data, FALSE, $force_column_update))
			{
				return FALSE;
			}
			
			// User defined custom columns
			// Loop through user defined cart columns and update any updatable columns.
			if (is_array($this->flexi->cart['items']['custom_columns']) && ! empty($this->flexi->cart['items']['custom_columns']))
			{
				foreach($this->flexi->cart['items']['custom_columns'] as $custom_column)
				{
					if ($custom_column['updatable'])
					{
						if ($item = $this->get_custom_item_data($item, $item_data, $custom_column))
						{
							$recalculate_cart = TRUE;
						}
						else
						{
							return FALSE;
						}
					}
				}
			}

			// Set item data to cart array.
			$this->set_item_data($item, $row_id);
		}
		
		return $recalculate_cart;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_item_data
	 * Prepare and format all submitted data to be set to the cart item array.
	 */	
	private function get_item_data($item = FALSE, $item_data = FALSE, $insert = FALSE, $force_column_update = FALSE)
	{
		// Get cart config settings.
		$cart_settings = $this->config->item('settings', 'flexi_cart');
	
		// Check item data is available to set.
		if (empty($item_data))
		{
			$this->set_error_message('invalid_data', 'config');
			return FALSE;
		}
		
		// If updating cart data, ensure only standard cart columns defined via '$config['cart']['items']['updatable_columns']' in the config file are updated.
		// If '$force_column_update = TRUE', all submitted data will be updated, regardless of whether it is defined as an updatable column.
		if (! $insert && ! $force_column_update)
		{
			foreach($item_data as $column => $data)
			{
				if (in_array($column, $this->flexi->cart['items']['columns']) && ! in_array($column, $this->flexi->cart['items']['updatable_columns']))
				{
					unset($item_data[$column]);
				}
			}
		}
		
		// If an item id regex validation is set via the config file.
		if (($item_id_rule = $cart_settings['item_id_rules']) && isset($item_data[$this->flexi->cart_columns['item_id']]))
		{
			if (!preg_match('/^['.$item_id_rule.']+$/i', $item_data[$this->flexi->cart_columns['item_id']]))
			{
				$this->set_error_message('invalid_item_id', 'config');
				return FALSE;
			}
		}
		
		// If an item name regex validation is set via the config file.
		if (($item_name_rule = $cart_settings['item_name_rules']) && isset($item_data[$this->flexi->cart_columns['item_name']]))
		{
			if (! preg_match('/^['.$item_name_rule.']+$/i', $item_data[$this->flexi->cart_columns['item_name']]))
			{
				$this->set_error_message('invalid_item_name', 'config');
				return FALSE;
			}
		}
		
		###+++++++++++++++++++++++++++++++++###
		
		// Set item name.
		if (isset($item_data[$this->flexi->cart_columns['item_name']]))
		{
			$item[$this->flexi->cart_columns['item_name']] = $item_data[$this->flexi->cart_columns['item_name']];
		}

		// Validate quantity is valid.
		if (isset($item_data[$this->flexi->cart_columns['item_quantity']]) && $item_data[$this->flexi->cart_columns['item_quantity']] <= 0)
		{
			$this->set_error_message('invalid_item_quantity', 'config');
			return FALSE;
		}
		else if (isset($item_data[$this->flexi->cart_columns['item_quantity']]))
		{
			// Remove any non numeric characters from quantity.
			$item[$this->flexi->cart_columns['item_quantity']] = 
				$this->format_calculation($item_data[$this->flexi->cart_columns['item_quantity']], 
					$this->flexi_cart_lite_model->get_config_setting('quantity_decimals'), TRUE);

			// By default, set item stock quantity as FALSE, when the cart is calculated, the stock level will be checked.
			$item[$this->flexi->cart_columns['item_stock_quantity']] = FALSE;
		}
		
		// Validate the item price.
		if (isset($item_data[$this->flexi->cart_columns['item_price']]) && 
			! $this->flexi_cart_lite_model->non_negative($item_data[$this->flexi->cart_columns['item_price']]))
		{
			$this->set_error_message('invalid_item_price', 'config');
			return FALSE;
		}
		else if (isset($item_data[$this->flexi->cart_columns['item_price']]))
		{
			// If updating an existing items price, ensure the inc/excludes the appropriate tax value.
			if (! $insert && (! isset($item_data[$this->flexi->cart_columns['row_id']]) || 
				$this->get_item_tax_rate($item_data[$this->flexi->cart_columns['row_id']], FALSE) === FALSE))
			{			
				$item_internal_tax_data = 
					$this->calculate_tax($item_data[$this->flexi->cart_columns['item_price']], $this->flexi->cart_contents['settings']['tax']['rate']);
				
				$item_tax_data = 
					$this->calculate_tax($item_internal_tax_data['value_ex_tax'], $this->flexi->cart_contents['settings']['tax']['internal_rate'], FALSE, TRUE);
				
				$item_data[$this->flexi->cart_columns['item_price']] = ($this->flexi_cart->cart_prices_inc_tax()) ? 
					$item_tax_data['value_inc_tax'] : $item_tax_data['value_ex_tax'];
			}

			$item_price = $this->format_calculation($item_data[$this->flexi->cart_columns['item_price']], 2, TRUE);
			
			$item[$this->flexi->cart_columns['item_price']] = $item[$this->flexi->cart_columns['item_internal_price']] = $item_price;
		}

		// Validate item weight.
		if (($insert && ! isset($item_data[$this->flexi->cart_columns['item_weight']])) || (isset($item_data[$this->flexi->cart_columns['item_weight']]) && 
				! $this->flexi_cart_lite_model->non_negative($item_data[$this->flexi->cart_columns['item_weight']])))
		{
			$item[$this->flexi->cart_columns['item_weight']] = 0;
		} 
		else if (isset($item_data[$this->flexi->cart_columns['item_weight']]))
		{
			$item[$this->flexi->cart_columns['item_weight']] = $this->format_calculation($item_data[$this->flexi->cart_columns['item_weight']], 2, TRUE);
		}
		
		// Validate item tax rate.
		if (($insert && ! isset($item_data[$this->flexi->cart_columns['item_tax_rate']])) || (isset($item_data[$this->flexi->cart_columns['item_tax_rate']]) && 
			! $this->flexi_cart_lite_model->non_negative($item_data[$this->flexi->cart_columns['item_tax_rate']]))) 
		{
			$item[$this->flexi->cart_columns['item_tax_rate']] = FALSE;
		}
		else if (isset($item_data[$this->flexi->cart_columns['item_tax_rate']]))
		{
			$item[$this->flexi->cart_columns['item_tax_rate']] = $this->format_calculation($item_data[$this->flexi->cart_columns['item_tax_rate']], 4, TRUE);
		}
		
		// Validate item shipping rate.
		if (($insert && ! isset($item_data[$this->flexi->cart_columns['item_shipping_rate']])) || 
			(isset($item_data[$this->flexi->cart_columns['item_shipping_rate']]) && 
				! $this->flexi_cart_lite_model->non_negative($item_data[$this->flexi->cart_columns['item_shipping_rate']]))) 
		{
			$item[$this->flexi->cart_columns['item_shipping_rate']] = FALSE;
		}
		else if (isset($item_data[$this->flexi->cart_columns['item_shipping_rate']]))
		{
			$item[$this->flexi->cart_columns['item_shipping_rate']] = $this->format_calculation($item_data[$this->flexi->cart_columns['item_shipping_rate']], 2, TRUE);
		}
		
		// Validate item separate shipping status.
		if ($insert && ! isset($item_data[$this->flexi->cart_columns['item_separate_shipping']])) 
		{
			$item[$this->flexi->cart_columns['item_separate_shipping']] = FALSE;
		}
		else if (isset($item_data[$this->flexi->cart_columns['item_separate_shipping']]))
		{
			$item[$this->flexi->cart_columns['item_separate_shipping']] = (bool)$item_data[$this->flexi->cart_columns['item_separate_shipping']];
		}
				
		// Set item reward points based on item price.
		if (($insert && ! isset($item_data[$this->flexi->cart_columns['item_reward_points']])) || 
			(isset($item_data[$this->flexi->cart_columns['item_reward_points']]) && ($item_data[$this->flexi->cart_columns['item_reward_points']] === FALSE || 
				! $this->flexi_cart_lite_model->non_negative($item_data[$this->flexi->cart_columns['item_reward_points']]))))
		{
			$item[$this->flexi->cart_columns['item_reward_points']] = FALSE;
		}
		else if (isset($item_data[$this->flexi->cart_columns['item_reward_points']]))
		{
			$item[$this->flexi->cart_columns['item_reward_points']] = $this->format_calculation($item_data[$this->flexi->cart_columns['item_reward_points']], 0, TRUE);
		}
		
		// Set item options.
		if (isset($item_data[$this->flexi->cart_columns['item_options']]))
		{
			$item[$this->flexi->cart_columns['item_options']] = $item_data[$this->flexi->cart_columns['item_options']];
		}
		
		// Set item unique status.
		if (isset($item_data[$this->flexi->cart_columns['item_unique_status']]))
		{
			$item[$this->flexi->cart_columns['item_unique_status']] = $item_data[$this->flexi->cart_columns['item_unique_status']];
		}
		
		###+++++++++++++++++++++++++++++++++###

		### Admin Data ###
		
		// Validate shipped quantity is valid.
		if (isset($item_data[$this->flexi->cart_columns['item_quantity_shipped']]) && 
			$this->flexi_cart_lite_model->non_negative($item_data[$this->flexi->cart_columns['item_quantity_shipped']]))
		{
			$item[$this->flexi->cart_columns['item_quantity_shipped']] = $item_data[$this->flexi->cart_columns['item_quantity_shipped']];
		}
		
		// Validate cancelled quantity is valid.
		if (isset($item_data[$this->flexi->cart_columns['item_quantity_cancelled']]) && 
			$this->flexi_cart_lite_model->non_negative($item_data[$this->flexi->cart_columns['item_quantity_cancelled']]))
		{
			$item[$this->flexi->cart_columns['item_quantity_cancelled']] = $item_data[$this->flexi->cart_columns['item_quantity_cancelled']];
		}

		###+++++++++++++++++++++++++++++++++###
		
		// Create an array of all item 'columns', 'reserved_columns' and 'custom_columns' that are defined via the config file.
		$remove_item_data = array_merge($this->flexi->cart['items']['columns'], $this->flexi->cart['items']['reserved_columns']);
		if (is_array($this->flexi->cart['items']['custom_columns']) && ! empty($this->flexi->cart['items']['custom_columns']))
		{
			foreach($this->flexi->cart['items']['custom_columns'] as $column)
			{
				$remove_item_data[] = $column['name'];
			}
		}

		// Remove any item data using item column names defined in the config files ('columns' and 'reserved_columns').
		foreach($remove_item_data as $column)
		{
			unset($item_data[$column]);
		}
			
		// Set any other submitted data.
		foreach($item_data as $column => $column_data)
		{
			$item[$column] = $column_data;
		}
		
		###+++++++++++++++++++++++++++++++++###
		
		return $item;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_custom_item_data
	 * Prepares and validates submitted custom data that is defined via '$config['cart']['items']['custom_columns']' located in the config file.
	 */	
	private function get_custom_item_data($item, $item_data, $custom_column)
	{
		// Validate '$custom_column' value.
		if ($custom_column['required'] && empty($item_data[$custom_column['name']]))
		{
			$this->set_error_message('invalid_custom_data', 'config');
			return FALSE;
		}
		else if (isset($item_data[$custom_column['name']]) && (! empty($item_data[$custom_column['name']]) || is_numeric($item_data[$custom_column['name']])))
		{
			// Check data matches regex string if set.
			if (! empty($custom_column['regex']) && !preg_match("/^[".$custom_column['regex']."]+$/i", $item_data[$custom_column['name']]))
			{
				$this->set_error_message('invalid_custom_data', 'config');
				return FALSE;
			}
			// Format decimals spaces if numeric.
			else if (is_numeric($item_data[$custom_column['name']]) && $this->flexi_cart_lite_model->non_negative($custom_column['decimals']))
			{
				$item[$custom_column['name']] = $this->format_calculation($item_data[$custom_column['name']], $custom_column['decimals'], TRUE);
			}
			// Else, update with the submitted value.
			else
			{
				$item[$custom_column['name']] = $item_data[$custom_column['name']];
			}
		}
		// Use default value if empty.
		else
		{
			$item[$custom_column['name']] = $custom_column['default'];
		}
		
		return $item;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * set_item_data
	 * Sets submitted item data to the carts session data.
	 */	
	private function set_item_data($item, $existing_row_id = FALSE)
	{
		// Create a unique identity for this item in the cart.
		// By hashing the item id and any options, we can allow identical items in the cart that have slightly different options to each other.
		// Example: The same t-shirt design could be added twice, once in black, once in white, rather than overwriting the first option.

		// To force either a particular duplicate item or all duplicate items to be added as a new unique row in the cart,
		// set the config defined item column 'item_unique_status' to 'TRUE' in the item insert array, or set 'multi_row_duplicate_items = TRUE' in the config file.
		if (isset($item[$this->flexi->cart_columns['item_unique_status']]) || $this->flexi_cart_lite_model->get_config_setting('multi_row_duplicate_items'))
		{
			$force_unique = mt_rand(0,999999);
		}
		else
		{
			$force_unique = FALSE;
		}
		
		// Generate a new row id.
		$new_row_id = $this->generate_row_id($item, $force_unique);
		
		// If the new row id does not match the existing row, delete the existing row.
		if ($existing_row_id != $new_row_id)
		{
			unset($this->flexi->cart_contents['items'][$existing_row_id]);		
		}
		// Else, the new row id matches the existing id, however, the data still needs to be unset so new data can overwrite it.
		else
		{
			unset($this->flexi->cart_contents['items'][$new_row_id]);				
		}

		// Check whether to increment an existing cart items quantity or enter a new quantity.
		if ($this->flexi_cart_lite_model->get_config_setting('increment_duplicate_item_quantity') && 
			isset($this->flexi->cart_contents['items'][$new_row_id][$this->flexi->cart_columns['item_quantity']]))
		{
			$item[$this->flexi->cart_columns['item_quantity']] += $this->flexi->cart_contents['items'][$new_row_id][$this->flexi->cart_columns['item_quantity']];	
		}		

		// Calculate admin data if it exists.
		if (isset($this->flexi->cart_contents['settings']['admin_data']['items']))
		{
			$item = $this->set_item_admin_data($item, $new_row_id);
		}

		// Remove existing row id from '$item' and any set 'admin data'.
		unset($item[$this->flexi->cart_columns['row_id']]);
		unset($item[$this->flexi->cart_columns['item_quantity_shipped']]);
		unset($item[$this->flexi->cart_columns['item_quantity_cancelled']]);
		
		// Add new item row to cart array.
		$this->flexi->cart_contents['items'][$new_row_id][$this->flexi->cart_columns['row_id']] = $new_row_id;
		
		// Add the new item details to the cart array.
		foreach ($item as $column => $value)
		{
			$this->flexi->cart_contents['items'][$new_row_id][$column] = $value;
		}

		return TRUE;		
	}
	
	/**
	 * set_item_admin_data
	 * If the cart has been reloaded from an existing order, the cart contains 'admin data' related to the original order that is used to manage item stock.
	 * When data in the cart is updated, the admin data is recalculated to include the changes.
	 */
	private function set_item_admin_data($item, $row_id)
	{
		// If admin data exists, but is not set for this item, set default admin data values.
		if (! isset($this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]))
		{
			$this->flexi->cart_contents['settings']['admin_data']['items'][$row_id] = array(
				'item_quantity_shipped' => 0,
				'item_quantity_cancelled' => 0,
				'saved_item_quantity' => 0,
				'saved_quantity_shipped' => 0,
				'saved_quantity_cancelled' => 0,
				'stock_allocation' => 0 
			);
		}

		// Ensure the current 'shipped' quantity is not more than the carts current 'ordered' quantity.
		if (isset($item[$this->flexi->cart_columns['item_quantity_shipped']]))
		{
			$this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['item_quantity_shipped'] = 
				($item[$this->flexi->cart_columns['item_quantity']] > $item[$this->flexi->cart_columns['item_quantity_shipped']]) ?
					$item[$this->flexi->cart_columns['item_quantity_shipped']] : $item[$this->flexi->cart_columns['item_quantity']];
		}
		
		// Ensure the current 'cancelled' quantity is not more than the carts current 'ordered' quantity.
		if (isset($item[$this->flexi->cart_columns['item_quantity_cancelled']])) 
		{
			$this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['item_quantity_cancelled'] = 
				($item[$this->flexi->cart_columns['item_quantity']] > $item[$this->flexi->cart_columns['item_quantity_cancelled']]) ?
					$item[$this->flexi->cart_columns['item_quantity_cancelled']] : $item[$this->flexi->cart_columns['item_quantity']];
		}
		
		// Get the quantity of 'ordered' and 'cancelled' items from the original order.
		$saved_quantity = (isset($this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['saved_item_quantity'])) ?
			$this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['saved_item_quantity'] : 0;		
		$saved_quantity_cancelled = (isset($this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['saved_quantity_cancelled'])) ?
			$this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['saved_quantity_cancelled'] : 0;

		// Calculate the amount of items that need to be added or removed to stock. A negative value means stock needs to be removed.
		$this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['stock_allocation'] = 
			($saved_quantity - ($saved_quantity_cancelled - $this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['item_quantity_cancelled']) - 
				$item[$this->flexi->cart_columns['item_quantity']]);
			
		return $item;
	}
	
	/**
	 * generate_row_id
	 * Generates a md5 hash of the submitted items id and option data that is then used as a unique identifier for item rows within the cart.
	 */	
	private function generate_row_id($item, $force_unique = FALSE)
	{
		// Hash the item id, any set options and the random '$force_unique' number if set.
		if (! empty($item[$this->flexi->cart_columns['item_options']]))
		{
			if (is_array($item[$this->flexi->cart_columns['item_options']]))
			{
				return md5($item[$this->flexi->cart_columns['item_id']].implode('', $item[$this->flexi->cart_columns['item_options']]).$force_unique);
			}
			else
			{
				return md5($item[$this->flexi->cart_columns['item_id']].$item[$this->flexi->cart_columns['item_options']].$force_unique);
			}
		}
		else
		{
			return md5($item[$this->flexi->cart_columns['item_id']].$force_unique);
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	//	CART CALCULATIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * calculate_cart
	 * Calculates all cart data and sets the cart session array.
	 */
	public function calculate_cart()
	{
		// Reset the current summary, shipping, tax and discount data.
		$this->set_summary_defaults();
		$this->set_shipping_data(FALSE, TRUE);
		$this->set_tax_data();
		$this->set_discount_defaults();

		###+++++++++++++++++++++++++++++++++###

		// Check if cart is empty.
		if (! isset($this->flexi->cart_contents['items']) || count($this->flexi->cart_contents['items']) == 0)
		{
			// Call 'empty_cart()' to ensure summary totals are reset, however, submit FALSE to ensure any shipping options are not reset.
			$this->flexi_cart->empty_cart(FALSE);

			// Clear empty cart status message.
			$this->flexi_cart->clear_messages();
			
			return FALSE;
		}

		###+++++++++++++++++++++++++++++++++###
		
		// If cart prices include tax, recalculate all item prices incase any tax settings have been changed.
		if ($this->flexi_cart->cart_prices_inc_tax())
		{
			$this->calculate_item_prices();
		}
			
		###+++++++++++++++++++++++++++++++++###

		// Get all applicable discounts.
		$discount_data = $this->get_all_discounts();

		$discount_void_reward_points = FALSE;
		
		###+++++++++++++++++++++++++++++++++###
		
		### Calculate all item data.
		
		$this->calculate_cart_items($discount_data);
		
		###+++++++++++++++++++++++++++++++++###
				
		### Apply item summary total discount if available.
			
		// Check if there is a valid summary 'item total' discount available.
		if ($item_total_discount_data = $this->validate_summary_discount($discount_data['item_summary_total'], $this->flexi_cart->item_summary_total(TRUE, FALSE, TRUE)))
		{
			// Get item total tax including any tax alterations from item discounts.
			$item_total_tax = ($this->flexi_cart->tax_total(TRUE, FALSE, TRUE) - $this->flexi->cart_contents['settings']['tax']['data']['item_discount_tax']);
		
			// Try apply a discount to the item total. If a database discount is not set or valid, the function will check for and apply a manual discount. 
			if ($discount_calculation_data = $this->calculate_summary_discount($item_total_discount_data, $this->flexi_cart->cart_taxable_value(FALSE, TRUE), 
				$this->flexi_cart->cart_non_taxable_value(FALSE, TRUE), $item_total_tax, FALSE, FALSE, 'item_total'
			))
			{
				// Save summary discount data to cart session array.
				$this->save_summary_discount_data('item_summary_total', $item_total_discount_data, $discount_calculation_data);
				
				#!# Removed 22-11-2012 as it was causing problems with item summary totals when a discount was applied and the user was viewing prices either inc/ex tax.
				#!# $this->flexi->cart_contents['settings']['tax']['data']['item_total_tax'] = $discount_calculation_data['tax_value'];
				
				$discount_void_reward_points = ($discount_calculation_data['void_reward_points']) ? TRUE : $discount_void_reward_points;
				
				// If the summary discount is 'Non Combinable', remove all further discount data.
				$discount_data = ($discount_calculation_data['non_combinable']) ? $this->unset_discount_data($discount_data) : $discount_data;
			}
		}
			
		###+++++++++++++++++++++++++++++++++###
		
		### Calculate shipping totals and set data.

		// Update shipping option and totals. 
		// 'calculate_shipping_total()' returns validated discount data if the current shipping option is discountable.
		$shipping_discount_data = $this->calculate_shipping_total($discount_data);
		
		// Calculate Shipping Tax.
		$ship_tax_data = $this->calculate_tax($this->flexi->cart_contents['summary']['shipping_total'], 
			$this->flexi->cart_contents['settings']['shipping']['tax_rate'], FALSE, TRUE);
		
		// Update shipping rate to include tax if cart prices include tax by default.
		if ($this->flexi_cart->cart_prices_inc_tax()) 
		{
			$this->flexi->cart_contents['summary']['shipping_total'] = $this->format_calculation($ship_tax_data['value_inc_tax']);
		}
		
		$this->flexi->cart_contents['summary']['tax_total'] += $ship_tax_data['tax_value'];

		// If the current shipping option is discountable.
		if ($shipping_discount_data)
		{
			// Try apply a discount to the shipping rate. If a database discount is not set or valid, the function will check for and apply a manual discount. 
			if ($discount_calculation_data = $this->calculate_summary_discount($shipping_discount_data, $ship_tax_data['taxable_value'], 
				$ship_tax_data['non_taxable_value'], $ship_tax_data['tax_value'], $this->flexi->cart_contents['settings']['shipping']['tax_rate'], TRUE, 'shipping'
			))
			{
				// Save summary discount data to cart session array.
				$this->save_summary_discount_data('shipping_total', $shipping_discount_data, $discount_calculation_data);
				
				$this->flexi->cart_contents['settings']['tax']['data']['shipping_tax'] = $discount_calculation_data['tax_value'];
				
				$discount_void_reward_points = ($discount_calculation_data['void_reward_points']) ? TRUE : $discount_void_reward_points;

				// If the summary discount is 'Non Combinable', remove all further discount data.
				$discount_data = ($discount_calculation_data['non_combinable']) ? $this->unset_discount_data($discount_data) : $discount_data;
			}
		}
		
		// If no discount has been set, add the non-discounted shipping tax to the cart tax totals.
		if (! $shipping_discount_data || (isset($discount_calculation_data) && ! $discount_calculation_data))
		{
			$this->flexi->cart_contents['settings']['tax']['data']['shipping_tax'] = $ship_tax_data['tax_value'];
			
			$this->flexi->cart_contents['settings']['tax']['data']['cart_tax'] += $ship_tax_data['tax_value'];
			$this->flexi->cart_contents['settings']['tax']['data']['cart_taxable_value'] += $ship_tax_data['taxable_value'];
			$this->flexi->cart_contents['settings']['tax']['data']['cart_non_taxable_value'] += $ship_tax_data['non_taxable_value'];
		}
				
		###+++++++++++++++++++++++++++++++++###
		
		### Calculate Total.
		
		// Calculate the current total value of the cart so that any discounts, vouchers or surcharges applied to the entire cart can use the carts total value.
		$this->calculate_cart_total();
		
		// Check if there is a valid summary 'total' discount available.
		if ($total_discount_data = $this->validate_summary_discount($discount_data['total'], $this->flexi_cart->item_summary_total(TRUE, FALSE, TRUE)))
		{
			// Try apply a discount to the cart total. If a database discount is not set or valid, the function will check for and apply a manual discount. 
			if ($discount_calculation_data = $this->calculate_summary_discount($total_discount_data, $this->flexi_cart->cart_taxable_value(FALSE, TRUE), 
				$this->flexi_cart->cart_non_taxable_value(FALSE, TRUE), $this->flexi_cart->tax_total(TRUE, FALSE, TRUE), FALSE, FALSE, 'total'
			))
			{
				// Save summary discount data to cart session array.
				$this->save_summary_discount_data('total', $total_discount_data, $discount_calculation_data);
				
				$discount_void_reward_points = ($discount_calculation_data['void_reward_points']) ? TRUE : $discount_void_reward_points;
			}
		}

		###+++++++++++++++++++++++++++++++++###
		
		### Reward Points and Vouchers.

		// Apply any set reward vouchers.
		if (! empty($discount_data['reward_vouchers']))
		{
			foreach($discount_data['reward_vouchers'] as $voucher_data)
			{
				// Apply reward voucher value to the cart total. 
				if ($voucher_calculation_data = $this->calculate_summary_discount($voucher_data, $this->flexi_cart->cart_taxable_value(FALSE, TRUE), 
					$this->flexi_cart->cart_non_taxable_value(FALSE, TRUE), $this->flexi_cart->tax_total(TRUE, FALSE, TRUE), FALSE, FALSE, 'reward_vouchers'
				))
				{
					// Save reward vouchers data to cart session array.
					$this->save_summary_discount_data('reward_vouchers', $voucher_data, $voucher_calculation_data);
					
					$discount_void_reward_points = ($voucher_calculation_data['void_reward_points']) ? TRUE : $discount_void_reward_points;
				}
			}
		}
		
		// Zero reward points if they've been voided by a summary discount.
		if ($discount_void_reward_points)
		{
			$this->flexi->cart_contents['summary']['total_reward_points'] = 0;
		}
		
		###+++++++++++++++++++++++++++++++++###

		### Calculate Surcharges and Surcharge Taxes
		
		$this->calculate_surcharges();
						
		###+++++++++++++++++++++++++++++++++###
		
		### Re-Calculate Totals

		// Re-calculate totals to include any discounts, vouchers or surcharges that have since been applied.
		$this->calculate_cart_total();	
		
		return TRUE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * calculate_item_prices
	 * Calculates the prices of all item prices incase any tax settings have been changed.
	 */
	private function calculate_item_prices()
	{
		// Loop through cart items.
		foreach($this->flexi->cart_contents['items'] as $row_id => $row)
		{
			// Check if the item has a specific tax rate set.
			$item_tax_rate = $this->get_item_tax_rate($row_id, FALSE); 

			// Calculate the internal item price.
			$item_internal_tax_data = $this->calculate_tax($row[$this->flexi->cart_columns['item_internal_price']], $item_tax_rate);

			// Calculate the tax on the item price using the carts current location settings.
			$item_tax_data = $this->calculate_tax($item_internal_tax_data['value_ex_tax'], $item_tax_rate, FALSE, TRUE);
						
			// Update the item price.
			$row[$this->flexi->cart_columns['item_price']] = $this->format_calculation($item_tax_data['value_inc_tax']);

			// Save item pricing.
			$this->flexi->cart_contents['items'][$row_id] = $row;
		}
	}
	
	/**
	 * calculate_cart_items
	 * Calculates and sets data for all cart items.
	 */
	private function calculate_cart_items($discount_data)
	{
		// Set some default values.
		$cart_total_items = $cart_total_weight = $cart_reward_points = 0;
		$item_summary_total = $cart_item_total_tax = $cart_item_discount_tax = $cart_item_discount_total = 0;
		$cart_total_tax = $cart_taxable_value = $cart_non_taxable_value = 0;
		$void_reward_point_items = array();

		###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		//	START OF CART ITEM LOOP
		###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		
		// Loop through cart items.
		foreach($this->flexi->cart_contents['items'] as $row_id => $row)
		{
			// Ensure array is structured correctly.
			if (!is_array($row) || ! isset($row[$this->flexi->cart_columns['item_price']]) || ! isset($row[$this->flexi->cart_columns['item_quantity']]))
			{
				unset($this->flexi->cart_contents['items'][$row_id]);
				continue;
			}

			###+++++++++++++++++++++++++++++++++###
			
			// Reset item status message.
			$row[$this->flexi->cart_columns['item_status_message']] = array();
			
			###+++++++++++++++++++++++++++++++++###

			### Get Item Stock Data.

			// If the database stock quantity table is enabled.
			$stock_quantity = $this->flexi_cart_lite_model->get_item_stock_quantity($row[$this->flexi->cart_columns['item_id']]);
			
			// If the cart data is loaded with 'admin data', include the stock allocation to the stock quantity.
			if (isset($this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['stock_allocation']) && $stock_quantity !== FALSE)
			{
				$admin_stock_quantity = ($stock_quantity + $this->flexi_cart_lite_model->get_item_allocated_stock($row[$this->flexi->cart_columns['item_id']]));
			}
			
			// If the stock quantity is not FALSE, then the database holds a record of the items stock level.
			if ($stock_quantity !== FALSE)
			{
				// Update the item stock quantity with the exact database value.
				$row[$this->flexi->cart_columns['item_stock_quantity']] = $stock_quantity;
				
				// If item is completely out of stock.
				if ($stock_quantity <= 0)
				{
					// Check if item should be removed from cart.
					if ($this->flexi_cart_lite_model->get_config_setting('remove_no_stock_items'))
					{
						$this->set_error_message('item_out_of_stock_removed', 'config');
						unset($this->flexi->cart_contents['items'][$row_id]);
						continue;
					}
					// Else, set a item status message stating item is out of stock.
					else
					{
						$row[$this->flexi->cart_columns['item_status_message']]['stock'] = $this->lang->line('item_out_of_stock');
					}
				}
				// Else, check if item may only be partially in stock.
				else if (($row[$this->flexi->cart_columns['item_quantity']] > $stock_quantity) || (isset($admin_stock_quantity) && $admin_stock_quantity < 0))
				{
					// If the maximum quantity of items is limited by the current available stock quantity, alter item quantity if required.
					if ($this->flexi_cart_lite_model->get_config_setting('quantity_limited_by_stock'))
					{
						$row[$this->flexi->cart_columns['item_quantity']] = $stock_quantity;
						
						// Set item status message stating the item quantity has been adjusted due to insufficient stock.
						$row[$this->flexi->cart_columns['item_status_message']]['stock'] = $this->lang->line('item_stock_insufficient_adjusted');
					}
					else
					{
						// Set item status message stating insufficient stock.
						$row[$this->flexi->cart_columns['item_status_message']]['stock'] = $this->lang->line('item_stock_insufficient');
					}
				}
			}

			###+++++++++++++++++++++++++++++++++###

			### Set Item Discount Data.

			// Set item discount data if available.
			$item_discount_data = array();
			
			if (isset($discount_data['item_price'][$row_id]))
			{
				$item_discount_data = $discount_data['item_price'][$row_id];				
			}
			
			###+++++++++++++++++++++++++++++++++###
			
			### Set Item Tax Rate.
						
			$item_tax_rate = $this->get_item_tax_rate($row_id, TRUE);

			$item_tax_data = $this->calculate_tax($row[$this->flexi->cart_columns['item_price']], $item_tax_rate);
						
			$row[$this->flexi->cart_columns['item_tax']] = $item_tax_data['tax_value'];
			
			###+++++++++++++++++++++++++++++++++###

			### Set Item Total Tax Rate.
			
			$item_total = ($row[$this->flexi->cart_columns['item_price']] * $row[$this->flexi->cart_columns['item_quantity']]);
			
			$item_total_tax_data = $this->calculate_tax($item_total, $item_tax_rate);
			
			$item_total = ($this->flexi_cart->cart_prices_inc_tax()) ? $item_total_tax_data['value_inc_tax'] : $item_total_tax_data['value_ex_tax'];
				
			###+++++++++++++++++++++++++++++++++###
			
			### Calculate Items Taxable and Non Taxable Value.
			
			$non_discount_quantity = (! empty($item_discount_data)) ? $item_discount_data['non_discount_quantity'] : $row[$this->flexi->cart_columns['item_quantity']];
			
			$item_taxable_value = ($item_tax_data['taxable_value'] * $non_discount_quantity);
			$item_non_taxable_value = ($item_tax_data['non_taxable_value'] * $non_discount_quantity);
			
			$item_discount_taxable_value = (! empty($item_discount_data)) ? ($item_discount_data['taxable_value'] * $item_discount_data['discount_quantity']) : 0;
			$item_discount_non_taxable_value = (! empty($item_discount_data)) ? ($item_discount_data['non_taxable_value'] * $item_discount_data['discount_quantity']) : 0;
			
			###+++++++++++++++++++++++++++++++++###

			### Calculate Item Reward Points.
			
			// If a discount has not disabled reward points.
			if (! isset($item_discount_data['void_reward_points']) || (! $item_discount_data['void_reward_points']))
			{
				// If reward points have been manually set.
				if ($row[$this->flexi->cart_columns['item_reward_points']] !== FALSE && $row[$this->flexi->cart_columns['item_reward_points']] >= 0)
				{
					$item_reward_points = $this->format_calculation($row[$this->flexi->cart_columns['item_reward_points']], 0);
				}
				// Else, calculate item reward points from the items price.
				else
				{
					// Check whether reward points should be based on the dynamic or internal item price.
					$item_reward_points = ($this->flexi_cart_lite_model->get_config_setting('dynamic_reward_points')) ? 
						$this->format_calculation($row[$this->flexi->cart_columns['item_price']] * $this->flexi_cart->reward_point_multiplier(), 0) :
						$this->format_calculation($row[$this->flexi->cart_columns['item_internal_price']] * $this->flexi_cart->reward_point_multiplier(), 0);
				}
			}
			// Else, ensure reward points are voided.
			else
			{
				$item_reward_points = 0;
				$void_reward_point_items[] = $row_id;
			}
			
			###+++++++++++++++++++++++++++++++++###
			
			### Set Item Discount Data.
			
			// Set item discount data to cart session array.
			if (! empty($item_discount_data))
			{
				$this->save_item_discount_data($row_id, $item_discount_data, FALSE);
			}
			
			###+++++++++++++++++++++++++++++++++###
	
			### Update Item Array.

			$items[$row_id] = $row;
			
			###+++++++++++++++++++++++++++++++++###
		
			### Tally Sub-Total Summaries.
			
			// Update cart quantities and weights.
			$cart_total_items += $row[$this->flexi->cart_columns['item_quantity']];
			$cart_total_weight += ($row[$this->flexi->cart_columns['item_weight']] * $row[$this->flexi->cart_columns['item_quantity']]);
			
			// Update cart sub-totals.
			$item_summary_total += $item_total;
			$cart_item_discount_total += (! empty($item_discount_data)) ? 
				(($row[$this->flexi->cart_columns['item_price']] - $item_discount_data['item_value']) * $item_discount_data['discount_quantity']) : 0;
				
			// Update item and cart tax applicable values.
			$item_total_tax = $item_total_tax_data['tax_value'];
			$item_discount_tax = (! empty($item_discount_data)) ? 
				(($row[$this->flexi->cart_columns['item_tax']] - $item_discount_data['tax_value']) * $item_discount_data['discount_quantity']) : 0;			
			$cart_item_total_tax += $item_total_tax;
			$cart_item_discount_tax += $item_discount_tax;
			$cart_total_tax += ($item_total_tax - $item_discount_tax);
			
			// Update carts taxable and non taxable sub-total.
			$cart_taxable_value += ($item_taxable_value + $item_discount_taxable_value); 
			$cart_non_taxable_value += ($item_non_taxable_value + $item_discount_non_taxable_value);
		
			// Update cart reward points.
			$cart_reward_points += $this->format_calculation(($item_reward_points * $row[$this->flexi->cart_columns['item_quantity']]), 0);
		}
		
		###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		//	END OF CART ITEM LOOP
		###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		
		// Group item data.
		$this->flexi->cart_contents['items'] = (isset($items)) ? $items : array();

		// Format sub-total summaries.
		$this->flexi->cart_contents['summary']['total_rows'] = count($this->flexi->cart_contents['items']);
		$this->flexi->cart_contents['summary']['total_items'] = $this->format_calculation($cart_total_items);
		$this->flexi->cart_contents['summary']['total_weight'] = $this->format_calculation($cart_total_weight);

		$this->flexi->cart_contents['summary']['total_reward_points'] = $this->format_calculation($cart_reward_points, 0);
		$this->flexi->cart_contents['summary']['item_summary_total'] = $this->format_calculation($item_summary_total);
		$this->flexi->cart_contents['summary']['tax_total'] = $this->format_calculation($cart_item_total_tax);

		$this->flexi->cart_contents['settings']['tax']['data']['item_total_tax'] = $this->format_calculation($cart_item_total_tax, 4);
		$this->flexi->cart_contents['settings']['tax']['data']['item_discount_tax'] = $this->format_calculation($cart_item_discount_tax, 4);
		
		$this->flexi->cart_contents['settings']['discounts']['data']['void_reward_point_items'] = $void_reward_point_items;
		
		$this->flexi->cart_contents['settings']['tax']['data']['cart_tax'] = $this->format_calculation($cart_total_tax, 4);
		$this->flexi->cart_contents['settings']['tax']['data']['cart_taxable_value'] = $this->format_calculation($cart_taxable_value, 4);
		$this->flexi->cart_contents['settings']['tax']['data']['cart_non_taxable_value'] = $this->format_calculation($cart_non_taxable_value, 4);
		
		$this->flexi->cart_contents['settings']['discounts']['data']['item_discount_savings'] = $this->format_calculation($cart_item_discount_total);
		
		return TRUE;
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * calculate_shipping_items
	 * Calculates shipping data for items within the cart, the data is then used to calculate the carts shipping total.
	 * The function returns a boolean value indicating whether a shipping discount was applied to an item.
	 */
	public function calculate_shipping_items($discount_data, $void_ship_discount)
	{
		// Set shipping defaults.
		$free_shipping_items = $free_shipping_value = $free_shipping_weight = 0;
		$separate_shipping_items = $separate_shipping_value = $separate_shipping_weight = $shipping_surcharge_total = 0;
		$banned_shipping_row_ids = $separate_shipping_row_ids = $item_shipping_rates = array();
		$item_shipping_discount_applied = FALSE;

		// Loop through cart items.
		foreach($this->flexi->cart_contents['items'] as $row_id => $row)
		{
			### Item Shipping Rates.

			$item_shipping_rate = $row[$this->flexi->cart_columns['item_shipping_rate']];
			
			// If item is eligible for a shipping discount.
			if (isset($discount_data['item_shipping'][$row_id]))
			{
				// If the current shipping option allows discounts, or the discount is 'forced' across all shipping options, update shipping rate accordingly. 
				if ($discount_data['item_shipping'][$row_id]['force_shipping_discount'] || $void_ship_discount == TRUE)
				{
					// Set discount data.
					$item_discount_data = $discount_data['item_shipping'][$row_id];
					
					// Ensure discount shipping rate is zero, else it would act as a shipping rate surcharge.
					if ($item_discount_data['item_value'] == 0)
					{
						$item_shipping_rate = 0;

						// Set item discount data to cart session array.
						$this->save_item_discount_data($row_id, $item_discount_data, TRUE);
						
						$item_shipping_discount_applied = TRUE;
					}
				}
				// Else, the shipping discount cannot be applied to the item using the current shipping option, therefore unset the items discount data.
				else
				{
					unset($this->flexi->cart_contents['settings']['discounts']['active_items'][$row_id]);
				}
			}
			
			// If item does not have a manually set shipping rate, and the cart is setup to lookup item shipping rates from a database table.
			if (! is_numeric($item_shipping_rate) && $this->flexi->cart_database['item_shipping']['table'])
			{
				if ($item_shipping_data = 
					$this->flexi_cart_lite_model->get_database_item_shipping_rate($row[$this->flexi->cart_columns['item_id']], $this->flexi_cart->shipping_location_data()))
				{
					// If an item shipping rate was returned, '0' = free shipping, > '0' = shipping surcharge, 'NULL' = item included in standard cart shipping rate.
					$item_shipping_rate = $item_shipping_data[$this->flexi->cart_database['item_shipping']['columns']['value']];
				}
			}

			// Set items with a defined shipping rate to cart array.
			if (is_numeric($item_shipping_rate))
			{
				$item_shipping_rates[$row_id] = $this->format_calculation($item_shipping_rate);
			}
			
			###+++++++++++++++++++++++++++++++++###
			
			// Update exempt shipping value and weight totals if item has free shipping. 
			// This prevents an items value and weight from being used in the shipping calculation.
			if (is_numeric($item_shipping_rate) && $item_shipping_rate == 0)
			{
				$free_shipping_items += $row[$this->flexi->cart_columns['item_quantity']];
				$free_shipping_value += ($row[$this->flexi->cart_columns['item_price']] * $row[$this->flexi->cart_columns['item_quantity']]);
				$free_shipping_weight += $this->format_calculation($row[$this->flexi->cart_columns['item_weight']] * $row[$this->flexi->cart_columns['item_quantity']]);
			}
			// If item has been set be shipped separately from other items in the cart.
			else if ($row[$this->flexi->cart_columns['item_separate_shipping']] || 
				(isset($item_shipping_data) && $item_shipping_data[$this->flexi->cart_database['item_shipping']['columns']['separate']] == 1))
			{
				$separate_shipping_items += $row[$this->flexi->cart_columns['item_quantity']];
				$separate_shipping_value += ($row[$this->flexi->cart_columns['item_price']] * $row[$this->flexi->cart_columns['item_quantity']]);
				$separate_shipping_weight += $this->format_calculation($row[$this->flexi->cart_columns['item_weight']] * $row[$this->flexi->cart_columns['item_quantity']]);
				$separate_shipping_row_ids[] = $row_id;
			}

			###+++++++++++++++++++++++++++++++++###
			
			// Update shipping surcharge total if item has a shipping value set.
			if ($this->flexi_cart_lite_model->is_positive($item_shipping_rate))
			{
				$shipping_surcharge_total += $this->format_calculation($item_shipping_rate * $row[$this->flexi->cart_columns['item_quantity']]);
			}
			
			###+++++++++++++++++++++++++++++++++###
			
			### Item Shipping Locations
			
			// Check the item shipping table exists in the config file and is enabled.
			if ($this->get_enabled_status('item_shipping'))
			{
				if (! $this->flexi_cart_lite_model->get_database_item_shipping_status($row[$this->flexi->cart_columns['item_id']], $this->flexi_cart->shipping_location_data()))
				{
					$banned_shipping_row_ids[] = $row_id;
					
					// Set item status message.
					$row[$this->flexi->cart_columns['item_status_message']]['shipping_ban'] = $this->lang->line('item_shipping_location_ban');
				}
			}
			
			###+++++++++++++++++++++++++++++++++###

			### Save Item Shipping Data
			
			$this->flexi->cart_contents['items'][$row_id] = $row;
		}
		
		// Set item shipping data.
		$this->flexi->cart_contents['settings']['shipping']['data']['surcharge'] = $this->format_calculation($shipping_surcharge_total);
		$this->flexi->cart_contents['settings']['shipping']['data']['separate_items'] = $separate_shipping_items;
		$this->flexi->cart_contents['settings']['shipping']['data']['separate_value'] = $separate_shipping_value;
		$this->flexi->cart_contents['settings']['shipping']['data']['separate_weight'] = $separate_shipping_weight;
		$this->flexi->cart_contents['settings']['shipping']['data']['free_items'] = $free_shipping_items;
		$this->flexi->cart_contents['settings']['shipping']['data']['free_value'] = $free_shipping_value;
		$this->flexi->cart_contents['settings']['shipping']['data']['free_weight'] = $free_shipping_weight;
		
		$this->flexi->cart_contents['settings']['shipping']['data']['banned_shipping_items'] = $banned_shipping_row_ids;
		$this->flexi->cart_contents['settings']['shipping']['data']['separate_shipping_items'] = $separate_shipping_row_ids;
		$this->flexi->cart_contents['settings']['shipping']['data']['item_shipping_rates'] = $item_shipping_rates;
		
		return $item_shipping_discount_applied;
	}

	###+++++++++++++++++++++++++++++++++###

	/**
	 * calculate_separate_shipping_items
	 * Returns the shipping rate of items set to be shipped separately from the rest of the cart items.
	 */
	public function calculate_separate_shipping_items()
	{
		$separate_item_ids = $this->flexi->cart_contents['settings']['shipping']['data']['separate_shipping_items'];
		$separate_item_shipping_rate = 0;
		
		// Loop through cart items.
		foreach($this->flexi->cart_contents['items'] as $row_id => $row)
		{
			// Only calculate separate shipping rates for items that have been listed as being shipped separate.
			if (! empty($separate_item_ids) && in_array($row_id, $separate_item_ids))
			{
				// Check the shipping tables exist in the config file and are enabled.
				if ($this->get_enabled_status('shipping'))
				{
					$item_shipping_rate = $this->get_database_shipping_data(
						$this->flexi_cart->shipping_id(), $this->flexi_cart->shipping_location_data(), 
						$row[$this->flexi->cart_columns['item_price']], $row[$this->flexi->cart_columns['item_weight']]
					);
				}
				// Else use the current cart shipping rate as the separate shipping rate for this item.
				else
				{
					$item_shipping_rate['value'] = $this->flexi->cart_contents['settings']['shipping']['value'];
				}
				
				$separate_item_shipping_rate += $this->format_calculation($item_shipping_rate['value'] * $row[$this->flexi->cart_columns['item_quantity']]);
				
				// Update cart item array.
				$this->flexi->cart_contents['items'][$row_id] = $row;
			}
		}
		
		return $separate_item_shipping_rate;
	}

	###+++++++++++++++++++++++++++++++++###

	/**
	 * calculate_shipping_total
	 * Calculates the shipping total and validates whether a shipping discount can be applied.
	 */
	public function calculate_shipping_total($discount_data)
	{
		// Calculate item shipping rates.
		$item_shipping_discount_status = $this->calculate_shipping_items($discount_data, TRUE);
		
		// Check if there is a valid summary 'shipping total' discount available.
		$ship_discount_data = $this->validate_summary_discount($discount_data['shipping_total'], $this->flexi_cart->item_summary_total(TRUE, FALSE, TRUE));
				
		// If a discount is set, check whether it is set to 'force' the discount against available shipping options, regardless of if they are set as discountable.
		$force_shipping_discount = (isset($ship_discount_data['force_shipping_discount'])) ? $ship_discount_data['force_shipping_discount'] : FALSE;
		
		// Set a status as whether to lookup only discountable shipping options.
		$shipping_discount_status = (! $force_shipping_discount && ($ship_discount_data || $item_shipping_discount_status));
		
		// Update shipping details in cart session.
		// If a shipping discount is active, try to match a shipping option rate which accepts discounts.
		if (! $this->update_shipping($this->flexi_cart->shipping_id(), $this->flexi_cart->shipping_location_data(), $shipping_discount_status))
		{
			// If no discountable shipping options are returned, then the shipping discount cannot be applied, therefore unset any discount data.
			$ship_discount_data = FALSE;
			
			// If item shipping discounts were applied, recalculate the item shipping costs with only 'forced' item shipping discounts applied.
			if ($item_shipping_discount_status)
			{			
				$this->calculate_shipping_items($discount_data, FALSE);
			}
			
			$this->update_shipping($this->flexi_cart->shipping_id(), $this->flexi_cart->shipping_location_data());
		}
		
		return $ship_discount_data;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * calculate_surcharges
	 * Calculates the carts surcharge total and tax.
	 */
	public function calculate_surcharges()
	{
		$surcharge_total = $surcharge_tax_total = 0;

		// If a cart surcharge exists.
		if (! empty($this->flexi->cart_contents['settings']['surcharges']))
		{
			foreach($this->flexi->cart_contents['settings']['surcharges'] as $surcharge_id => $surcharge_data)
			{
				// If a surcharge column is set, we use the surcharge rate as a percentage based surcharge on that column.
				// Valid columns are 'item_summary_total', 'shipping_total' and 'total'.
				if (! empty($surcharge_data['column']))
				{
					if ($surcharge_data['column'] == 'item_summary_total')
					{
						$column_value = $this->flexi_cart->item_summary_total(TRUE, FALSE, TRUE);
					}
					else if ($surcharge_data['column'] == 'shipping_total')
					{
						$column_value = $this->flexi_cart->shipping_total(TRUE, FALSE, TRUE);
					}
					else // 'total' column.
					{
						$column_value = $this->flexi_cart->total(TRUE, FALSE, TRUE);
					}
				
					// Convert surcharge percentage to decimal.
					$surcharge = $this->format_calculation($column_value * ($surcharge_data['surcharge_value'] / 100));
				}
				else
				{
					$surcharge = $this->format_calculation($surcharge_data['surcharge_value']);
				}
								
				// Calculate the internal surcharge value excluding tax.
				$internal_surcharge_tax_data = $this->calculate_tax($surcharge, $surcharge_data['tax_rate']);
				
				// Calculate the tax on the surcharge value using the carts current location settings.
				$surcharge_tax_data = $this->calculate_tax($internal_surcharge_tax_data['value_ex_tax'], $surcharge_data['tax_rate'], FALSE, TRUE);
				
				// Update the surcharge value accordingly to whether cart prices include tax by default.
				$surcharge_value = ($this->flexi_cart->cart_prices_inc_tax()) ? $surcharge_tax_data['value_inc_tax'] : $surcharge_tax_data['value_ex_tax'];
								
				// Update cart array with surcharge tax value.
				$this->flexi->cart_contents['settings']['surcharges'][$surcharge_id]['value'] = $surcharge_value;
				$this->flexi->cart_contents['settings']['surcharges'][$surcharge_id]['tax_value'] = $surcharge_tax_data['tax_value'];
				
				// Tally surcharge values.
				$surcharge_total += $surcharge_value;
				$surcharge_tax_total += $surcharge_tax_data['tax_value'];
			}
		}
		
		// Update cart array with surcharge value.
		$this->flexi->cart_contents['summary']['surcharge_total'] = $this->format_calculation($surcharge_total);
		$this->flexi->cart_contents['summary']['tax_total'] += $this->format_calculation($surcharge_tax_total);
		
		// Surcharge total is not added to the 'cart_tax', 'cart_taxable_value' and 'cart_non_taxable_value' columns as it must remain excluded from discounts.
		// i.e. You cannot discount a surcharge. Instead when calling the 'total()' function, the surcharge must be added to it.	
		$this->flexi->cart_contents['settings']['tax']['data']['surcharge_tax'] = $surcharge_tax_total;
		
		return TRUE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * calculate_cart_total
	 * Calculates the carts total.
	 */
	public function calculate_cart_total()
	{
		$cart_total = 0;
		$cart_total += $this->flexi->cart_contents['summary']['item_summary_total'];
		$cart_total += $this->flexi->cart_contents['summary']['shipping_total'];
		$cart_total += $this->flexi->cart_contents['summary']['surcharge_total'];
		$cart_total += (! $this->flexi_cart->cart_prices_inc_tax()) ? $this->flexi->cart_contents['summary']['tax_total'] : 0; 
		
		$this->flexi->cart_contents['summary']['total'] = $this->format_calculation($cart_total);
				
		return TRUE; 
	}
	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOCATIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_location_query
	 * Returns all active locations that are of a specific location type and are the child locations of any higher tier set locations.
	 * For example, if a specific country has been set as the current shipping/tax location, and this function was called to return all states, 
	 * ('$location_type_id = 1' using default demo values) only the states of that country would be returned.
	 */
	public function get_location_query($sql_select = FALSE, $location_type_id = 0, $location_type_function = 'shipping_location_id')
	{
		// Check the location tables exist in the config file and are enabled.
		if (! $this->get_enabled_status('location', TRUE))
		{
			return FALSE;
		}
		
		// If the location type id is not the base location type (e.g. 'Country'), check if a parent location has been set.
		if ($location_type_id > 0)
		{
			// Get the current location id for the submitted location type, if it returns 'FALSE', set '-1' to ensure locations for the 
			// base location type are not returned.
			$location_parent_id = ($location_id = $this->flexi_cart->$location_type_function($location_type_id)) ? $location_id : -1;
		}
		else
		{
			$location_parent_id = 0;
		}
		
		if (! empty($sql_select))
		{
			$this->db->select($sql_select);
		}
		
		$sql_where = array(
			$this->flexi->cart_database['locations']['columns']['parent'] => $location_parent_id,
			$this->flexi->cart_database['locations']['columns']['status'] => 1
		);
	
		return $this->db->get_where($this->flexi->cart_database['locations']['table'], $sql_where);
	}
	
	/**
	 * update_location
	 * Updates the cart session data with either shipping or tax location data.
	 */
	public function update_location($locations = FALSE, $location_type = FALSE)
	{
		if ($location_type != 'shipping' && $location_type != 'tax')
		{
			return FALSE;
		}

		// Check the location tables exist in the config file and are enabled.
		if ($this->get_enabled_status('location'))
		{
			$location_data = $this->get_database_location_data($locations, $location_type);
		}
		
		// If no location data has been set by the database lookup, set zero values.
		if (empty($location_data))
		{
			$location_data = array(array('location_id' => 0, 'zone_id' => 0, 'type_id' => 0, 'parent_id' => 0, 'name' => FALSE));
		}

		// Set location data to either the shipping or the tax array.
		if ($location_type == 'shipping')
		{
			$this->flexi->cart_contents['settings']['shipping']['location'] = $location_data;
		}
		else
		{
			$this->flexi->cart_contents['settings']['tax']['location'] = $location_data;
		}
		
		return TRUE;
	}
	
	/**
	 * get_database_location_data
	 * Used for shipping and tax calculations.
	 * Function can match either a locations id, exact name, or an array with a combination of location ids and names (i.e. Country, State, City, Postal Code etc.).
	 * The returned location and zone ids can then be compared against the shipping and tax rules until a match is found.
	 */ 
	public function get_database_location_data($locations = FALSE, $location_type = FALSE)
	{
		if ($location_type != 'shipping' && $location_type != 'tax')
		{
			return FALSE;
		}
		
		// Check the location tables exist in the config file and are enabled.
		if ($this->get_enabled_status('location'))
		{
			// Set alias of location type table data.
			$tbl_location = $this->flexi->cart_database['locations'];
			$tbl_cols_location = $this->flexi->cart_database['locations']['columns'];
			$tbl_location_type = $this->flexi->cart_database['location_type'];
			$tbl_cols_location_type = $this->flexi->cart_database['location_type']['columns'];

			$sql_select = array(
				$tbl_cols_location['id'],
				($location_type == 'shipping') ? $tbl_cols_location['shipping_zone'] : $tbl_cols_location['tax_zone'],
				$tbl_cols_location['type'],
				$tbl_cols_location['parent'],
				$tbl_cols_location['name']
			);
			
			// If no location data is set, lookup default location set via database.
			if (empty($locations))
			{
				// Get the default shipping or tax location type.
				if ($location_type == 'shipping' && $tbl_location['shipping_default'])
				{
					$sql_where = array($tbl_location['shipping_default'] => 1);
				}
				else if ($tbl_location['tax_default'])
				{
					$sql_where = array($tbl_location['tax_default'] => 1);
				}

				if (isset($sql_where))
				{
					// Lookup default location and zones.
					// Results are ordered by the parent ids in the database table, with child location types first, this ensures more specific locations like 
					// states are returned before a country.
					// Note: A parent id of 1 is more specific (i.e. State) than a parent id of 0 (i.e. Country), however, the query is ordered in ascending order.
					// The reason for this is that the function needs to check the parent-to-child relationship of locations are tiered correctly. 
					// For example, this prevents a user from incorrectly setting their country as Canada and then their state as California.
					$query = $this->db->select($sql_select)
						->from($tbl_location['table'])
						->join($tbl_location_type['table'], $tbl_cols_location['type'].' = '.$tbl_cols_location_type['id'])
						->where($sql_where)
						->where($tbl_cols_location['status'], 1)
						->order_by($tbl_cols_location_type['parent'], 'ASC')
						->limit(1)
						->get();

					if ($query->num_rows() == 1)
					{
						$location_data[] = $query->row_array();

						// Check if the location has any parent locations and add them to the array.
						for($i = 0; ($query->num_rows() == 1); $i++)
						{
							$query = $this->db->select($sql_select)
								->get_where($tbl_location['table'], array($tbl_cols_location['id'] => $location_data[$i][$tbl_cols_location['parent']]));

							if ($query->num_rows() == 1)
							{
								$location_data[] = $query->row_array();
							}
						}
						
						// Reverse the order of the array.
						$location_data = array_reverse($location_data);
					}
				}
			}

			// If no default location is defined via the database, match a location with either the submitted '$locations' data, 
			// or using the hard-coded default shipping/tax location set via the config file.
			if (! isset($location_data))
			{
				// If no location data was submitted, get hard-coded default shipping/tax location from config file.
				if (empty($locations))
				{
					if ($location_type == 'shipping' && ! empty($this->flexi->cart_defaults['shipping']['location']))
					{
						$locations = $this->flexi->cart_defaults['shipping']['location'];
					}
					else if ($location_type == 'tax' && ! empty($this->flexi->cart_defaults['tax']['location']))
					{
						$locations = $this->flexi->cart_defaults['tax']['location'];
					}
				}
			
				if (! empty($locations))
				{
					// Loop through location array creating an SQL WHERE statement for locations set as ids and names.
					$sql_where = NULL;
					foreach((array)$locations as $location)
					{
						// Location name.
						if (is_string($location))
						{
							$sql_where .= $tbl_cols_location['name']." = ".$this->db->escape($location)." OR ";
						}
						// Location id.
						else if (is_numeric($location))
						{
							$sql_where .= $tbl_cols_location['id']." = ".$this->db->escape($location)." OR ";
						}
					}
					$sql_where = rtrim($sql_where,' OR ');
					
					// Get location and zones.
					// Results are ordered by the parent ids in the database table, with child location types first, this ensures more specific locations like 
					// states are returned before a country.
					// Note: A parent id of 1 is more specific (i.e. State) than a parent id of 0 (i.e. Country), however, the query is ordered in ascending order.
					// The reason for this is that the function needs to check the parent-to-child relationship of locations are tiered correctly. 
					// For example, this prevents a user from incorrectly setting their country as Canada and then their state as California.
					$query = $this->db->select($sql_select)
						->from($tbl_location['table'])
						->join($tbl_location_type['table'], $tbl_cols_location['type'].' = '.$tbl_cols_location_type['id'])
						->where($sql_where)
						->order_by($tbl_cols_location_type['parent'], 'ASC') 
						->get();
					
					if ($query->num_rows() > 0) 
					{
						$location_data = $query->result_array();
					}
				}
			}
			
			// If location data has been set, add it to a formatted session array.
			if (! empty($location_data))
			{
				// Loop through location data checking the parent-to-child relationships are correct, for example preventing California being set as a state of Canada.
				foreach($location_data as $i => $location)
				{
					// Ensure the least specific location is always added to the location array.
					if ($i == 0)
					{
						$location_parent_id = $location[$tbl_cols_location['id']];
						$location_data_tiered[] = $location;
					}
					// If the sub locations parent-to-child relationship is valid, order the more specific location to the start of the array using 'array_unshift()'.
					else if ($location[$tbl_cols_location['parent']] == $location_parent_id)
					{
						$location_parent_id = $location[$tbl_cols_location['id']];
						array_unshift($location_data_tiered, $location);
					}
				}
				
				// If location data has been set and tiered correctly, return a formatted location array.
				if (! empty($location_data_tiered))
				{
					$locations = array();
					foreach($location_data_tiered as $location)
					{
						$locations[] = array(
							'location_id' => $location[$tbl_cols_location['id']],
							'zone_id' => ($location_type == 'shipping') ? $location[$tbl_cols_location['shipping_zone']] : $location[$tbl_cols_location['tax_zone']],
							'type_id' => $location[$tbl_cols_location['type']],
							'parent_id' => $location[$tbl_cols_location['parent']],
							'name' => $location[$tbl_cols_location['name']]
						);
					}

					return $locations;
				}
			}
		}
		
		// No location data available, so set ids as zero.
		return array(array('location_id' => 0, 'zone_id' => 0, 'type_id' => 0, 'parent_id' => 0, 'name' => FALSE));
	}


	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SHIPPING
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * shipping_options
	 * Looks-up shipping options that match the order sub-total, weight and location.
	 * The returned data can then be used by the user to select their shipping method of choice, typically via a html form element (i.e. select, radio etc).
	 */
	public function shipping_options($locations = FALSE, $cart_value = FALSE, $cart_weight = FALSE)
	{
		// Check the shipping tables exist in the config file and are enabled.
		if ($this->get_enabled_status('shipping'))
		{
			// Set aliases of shipping table data.
			$tbl_shipping = $this->flexi->cart_database['shipping_options'];
			$tbl_cols_shipping = $this->flexi->cart_database['shipping_options']['columns'];
			$tbl_cols_ship_rate = $this->flexi->cart_database['shipping_rates']['columns'];

			// Check the location tables exist in the config file and are enabled.
			if ($this->get_enabled_status('location'))
			{
				// If no location data is set, lookup defaults.
				if (empty($locations) || !is_array($locations))
				{
					// Lookup database default shipping location.
					$locations = $this->get_database_location_data(FALSE, 'shipping');
				}
				
				if (! empty($locations))
				{
					// Count the number of locations to identify what is the most specific location.
					$total_locations = count($locations)-1; 
					$shipping_options = array();
					
					// Loop through locations in order of the most specific location first, matching available shipping options.
					foreach($locations as $location)
					{
						if ($location['location_id'] > 0 || $location['zone_id'] > 0)
						{
							$sql_where = "(".$tbl_cols_shipping['location']." = '0' AND ".$tbl_cols_shipping['zone']." = '0') OR ";
							$sql_where .= ($location['location_id'] > 0) ? $tbl_cols_shipping['location']." = ".$this->db->escape($location['location_id'])." OR " : NULL;
							$sql_where .= ($location['zone_id'] > 0) ? $tbl_cols_shipping['zone']." = ".$this->db->escape($location['zone_id']) : NULL;
							$sql_where = rtrim($sql_where, ' OR ');
							
							// If options have been found in a previous loop, only allow further options that can be included in sub locations.
							if (! empty($shipping_options))
							{
								$sql_where .= ' AND '.$tbl_cols_shipping['inc_sub_locations'].' = 1';
							}
							
							// Query shipping rates for options matching cart summary.
							$query = $this->shipping_rate_details($cart_value, $cart_weight, $sql_where);
							
							// If shipping options are available to the shipping location.
							if ($query->num_rows() > 0)
							{
								foreach($query->result_array() as $data)
								{
									$shipping_options[] = $data;
								}
							}
						}
					}
				}
				
				// If no shipping options are available to the current shipping location, lookup the default database shipping option.
				if (! isset($shipping_options) && $tbl_shipping['default'])
				{
					$sql_where = $tbl_shipping['default']." = 1";

					$query = $this->shipping_rate_details($cart_value, $cart_weight, $sql_where);

					if ($query->num_rows() > 0)
					{
						$shipping_options = $query->result_array();
					}
				}
			
				// If shipping options are now available.
				if (! empty($shipping_options))
				{
					$location_options = $zone_options = array();
					$location_i = $zone_i = 0;
					foreach($shipping_options as $shipping_data)
					{
						if ($shipping_data[$tbl_cols_shipping['location']] > 0)
						{
							$location_options[$location_i] = array(
								$tbl_cols_shipping['id'] => $shipping_data[$tbl_cols_shipping['id']],
								$tbl_cols_shipping['name'] => $shipping_data[$tbl_cols_shipping['name']],
								$tbl_cols_shipping['description'] => $shipping_data[$tbl_cols_shipping['description']],
								$tbl_cols_ship_rate['value'] => $shipping_data[$tbl_cols_ship_rate['value']],
								$tbl_cols_shipping['tax_rate'] => 
									(is_numeric($shipping_data[$tbl_cols_shipping['tax_rate']]) && $shipping_data[$tbl_cols_shipping['tax_rate']] >= 0) ? 
										$shipping_data[$tbl_cols_shipping['tax_rate']] : FALSE
							);
							$location_i++;
						}
						else
						{
							$zone_options[$zone_i] = array(
								$tbl_cols_shipping['id'] => $shipping_data[$tbl_cols_shipping['id']],
								$tbl_cols_shipping['name'] => $shipping_data[$tbl_cols_shipping['name']],
								$tbl_cols_shipping['description'] => $shipping_data[$tbl_cols_shipping['description']],
								$tbl_cols_ship_rate['value'] => $shipping_data[$tbl_cols_ship_rate['value']],
								$tbl_cols_shipping['tax_rate'] => 
									(is_numeric($shipping_data[$tbl_cols_shipping['tax_rate']]) && $shipping_data[$tbl_cols_shipping['tax_rate']] >= 0) ? 
										$shipping_data[$tbl_cols_shipping['tax_rate']] : FALSE
							);
							$zone_i++;
						}
					}
					
					return (! empty($location_options)) ? $location_options : $zone_options;
				}
			}
			// Else, lookup shipping options without checking location.
			else
			{
				$query = $this->shipping_rate_details($cart_value, $cart_weight);

				if ($query->num_rows() > 0)
				{
					$locations = array();
					
					foreach($query->result_array() as $shipping_data)
					{
						$locations[] = array(
							$tbl_cols_shipping['id'] => $shipping_data[$tbl_cols_shipping['id']],
							$tbl_cols_shipping['name'] => $shipping_data[$tbl_cols_shipping['name']],
							$tbl_cols_shipping['description'] => $shipping_data[$tbl_cols_shipping['description']],
							$tbl_cols_ship_rate['value'] => $shipping_data[$tbl_cols_ship_rate['value']],
							$tbl_cols_shipping['tax_rate'] => 
								(is_numeric($shipping_data[$tbl_cols_shipping['tax_rate']]) && $shipping_data[$tbl_cols_shipping['tax_rate']] >= 0) ? 
									$shipping_data[$tbl_cols_shipping['tax_rate']] : FALSE
						);
					}
					
					return $locations;
				}
			}
		}

		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * update_shipping
	 * Updates the cart session data with shipping details either specified by a submitted shipping id or by preset default shipping details. 
	 */
	public function update_shipping($shipping_id = FALSE, $location = FALSE, $discount_applied = FALSE)
	{
		// Check the shipping tables exist in the config file and are enabled.
		if ($this->get_enabled_status('shipping'))
		{
			$shipping_data = $this->get_database_shipping_data($shipping_id, $location, FALSE, FALSE, $discount_applied);			
			
			// If a shipping discount is active, only return shipping options that can be discounted.
			if ($discount_applied && empty($shipping_data))
			{
				return FALSE;
			}
			
			// Set shipping data to cart array.
			$this->set_shipping_data($shipping_data);
		}
		
		###+++++++++++++++++++++++++++++++++###
		
		// If any items in the cart are configured to be shipped separately, calculate the additional rate to be added to the shipping rate.
		if (! empty($this->flexi->cart_contents['settings']['shipping']['data']['separate_shipping_items']))
		{
			$this->flexi->cart_contents['settings']['shipping']['data']['separate_shipping_value'] = $this->calculate_separate_shipping_items();
		}
		
		###+++++++++++++++++++++++++++++++++###

		### Calculate Shipping Rate
	
		// Set aliases of shipping charge values.
		$shipping_value = $this->flexi->cart_contents['settings']['shipping']['value'];
		$shipping_tax_rate = $this->flexi->cart_contents['settings']['shipping']['tax_rate'];
		$shipping_surcharge = $this->flexi->cart_contents['settings']['shipping']['data']['surcharge'];
		$separate_shipping_value = $this->flexi->cart_contents['settings']['shipping']['data']['separate_shipping_value'];

		// Get total number of cart items, free shipping items and items being shipped separately.
		$total_cart_items = $this->flexi->cart_contents['summary']['total_items'];
		$total_free_items = $this->flexi->cart_contents['settings']['shipping']['data']['free_items'];
		$total_separate_items = $this->flexi->cart_contents['settings']['shipping']['data']['separate_items'];
		
		// Add together relevant shipping charges.
		if ($total_cart_items == $total_free_items)
		{
			$shipping_total = 0;
		}
		else if ($total_cart_items == $total_separate_items || $total_cart_items == ($total_separate_items + $total_free_items))
		{
			$shipping_total = $separate_shipping_value;
		}
		else
		{
			$shipping_total = ($shipping_value + $separate_shipping_value);
		}
		
		$shipping_total += $shipping_surcharge;

		// Calculate shipping rate tax data to obtain the shipping rate excluding tax.
		$shipping_tax_data = $this->calculate_tax($shipping_total, $shipping_tax_rate);
		
		// Set the total shipping rate including any set shipping surcharge.
		$this->flexi->cart_contents['summary']['shipping_total'] = $this->format_calculation($shipping_tax_data['value_ex_tax']);
		
		return TRUE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_database_shipping_data
	 * Looks-up the database for shipping details that match the shipping id, location and cart value and weight.
	 */
	private function get_database_shipping_data($shipping_id = FALSE, $locations = FALSE, $cart_value = FALSE, $cart_weight = FALSE, $discount_applied = FALSE)
	{
		// Check the shipping tables exist in the config file and are enabled.
		if ($this->get_enabled_status('shipping'))
		{
			// Set aliases of shipping table data.
			$tbl_shipping = $this->flexi->cart_database['shipping_options'];
			$tbl_cols_shipping = $this->flexi->cart_database['shipping_options']['columns'];
			
			if ($locations && is_numeric($shipping_id) && ($shipping_id > 0))
			{
				// Loop through locations and tries primarily to match the current shipping id with the location.
				// If the shipping id cannot be matched, try to match another shipping option with the current location.
				foreach(array_reverse($locations) as $location)
				{
					$sql_where = $tbl_cols_shipping['status']." = '1'";
					if ($location['location_id'] > 0 || $location['zone_id'] > 0)
					{
						$sql_where .= " AND (";
						$sql_where .= ($location['location_id'] > 0) ? $tbl_cols_shipping['location']." = ".$this->db->escape($location['location_id'])." OR " : NULL;
						$sql_where .= ($location['zone_id'] > 0) ? $tbl_cols_shipping['zone']." = ".$this->db->escape($location['zone_id']) : NULL;
						$sql_where = rtrim($sql_where, ' OR ').")";
					}

					// If a shipping discount is active, only return shipping options that can be discounted.
					if ($discount_applied)
					{
						$sql_where .= " AND ".$tbl_cols_shipping['discount_inclusion']." = 1";
					}
					
					$query = $this->db->select($tbl_cols_shipping['id'])
						->from($tbl_shipping['table'])
						->where($sql_where)
						->get();

					if ($query->num_rows() > 0)
					{
						// Loop through shipping options that match the location and try to match with the current shipping id.
						foreach($query->result_array() as $i => $shipping)
						{
							if ($shipping[$tbl_cols_shipping['id']] == $shipping_id)
							{
								$sql_where = $tbl_cols_shipping['id']." = ".$this->db->escape($shipping_id);
								
								$query = $this->shipping_rate_details($cart_value, $cart_weight, $sql_where);
								
								// A shipping rate matching the current shipping option id has been found.
								if ($query->num_rows() > 0) 
								{
									return $this->rename_shipping_columns($query->row_array());
								}
							}
							
							$fallback_shipping_options[] = $shipping[$tbl_cols_shipping['id']];
						}
					}
				}
				
				// If a shipping discount is active, and no shipping rate was matched, return FALSE.
				if ($discount_applied)
				{
					return FALSE;
				}
				
				// The current shipping id does not have a shipping option that matches the current location.
				// This is likely to happen when the shipping location has been changed, and any existing shipping option will now not match the location.
				// If options were available, loop through the options and try to find one that has a shipping rate tier that matches the current cart value and weight.
				if (isset($fallback_shipping_options))
				{		
					foreach($fallback_shipping_options as $id)
					{
						$sql_where = $tbl_cols_shipping['id'].' = '.$id;
						
						$query = $this->shipping_rate_details($cart_value, $cart_weight, $sql_where);
						
						// A valid shipping rate has been found.
						if ($query->num_rows() > 0) 
						{
							return $this->rename_shipping_columns($query->row_array());
						}
					}
				}
			}

			// If a discount has not been applied, match the first shipping option that matches the shipping location.
			if (! $discount_applied)
			{
				// If shipping not specified (ie Upon 1st item added to cart), lookup database for first available option and set as default.
				$shipping_data = $this->shipping_options($locations, $cart_value, $cart_weight);
				
				// Grab first result to use as default.
				if (isset($shipping_data[0]))
				{
					return $this->rename_shipping_columns($shipping_data[0]);
				}
			}
		}
		
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * rename_shipping_columns
	 * Renames an array of database shipping options to universal (non-table column) names.
	 */
	public function rename_shipping_columns($shipping_data = array())
	{
		if (! empty($shipping_data))
		{
			// Set aliases of shipping table data
			$tbl_cols_shipping = $this->flexi->cart_database['shipping_options']['columns'];
			$tbl_cols_ship_rate = $this->flexi->cart_database['shipping_rates']['columns'];
			
			// Loop through and rename shipping table column names.
			$shipping_options = array();
			
			// Check if data array is multi-dimensional.
			// TRUE = 1 dimensional (returned from 'row_array()'), FALSE = multi-dimensional (returned from 'result_array()').
			if (count($shipping_data) == count($shipping_data, COUNT_RECURSIVE))
			{
				$shipping_options['id'] = $shipping_data[$tbl_cols_shipping['id']];
				$shipping_options['name'] = $shipping_data[$tbl_cols_shipping['name']];
				$shipping_options['description'] = $shipping_data[$tbl_cols_shipping['description']];
				$shipping_options['value'] = $shipping_data[$tbl_cols_ship_rate['value']];
				$shipping_options['tax_rate'] = $shipping_data[$tbl_cols_shipping['tax_rate']];
			}
			else
			{		
				foreach($shipping_data as $row_id => $data)
				{
					$shipping_options[$row_id]['id'] = $data[$tbl_cols_shipping['id']];
					$shipping_options[$row_id]['name'] = $data[$tbl_cols_shipping['name']];
					$shipping_options[$row_id]['description'] = $data[$tbl_cols_shipping['description']];
					$shipping_options[$row_id]['value'] = $data[$tbl_cols_ship_rate['value']];
					$shipping_options[$row_id]['tax_rate'] = $data[$tbl_cols_shipping['tax_rate']];
				}
			}
			
			return $shipping_options;
		}
		
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * shipping_rate_details
	 * Returns shipping rate details for a specific shipping option.
	 */
	private function shipping_rate_details($cart_value = 0, $cart_weight = 0, $sql_where = FALSE)
	{
		// Set aliases of shipping table data
		$tbl_shipping = $this->flexi->cart_database['shipping_options'];
		$tbl_cols_shipping = $this->flexi->cart_database['shipping_options']['columns'];
		$tbl_ship_rate = $this->flexi->cart_database['shipping_rates'];
		$tbl_cols_ship_rate = $this->flexi->cart_database['shipping_rates']['columns'];
		
		// Get item value and weight to be included in shipping calculations.
		if ($cart_value	=== FALSE || $cart_weight === FALSE)
		{
			$shipping_item_data = $this->get_shipping_item_totals();
			
			$cart_value = ($cart_value === FALSE) ? $shipping_item_data['value'] : $cart_value;
			$cart_weight = ($cart_weight === FALSE) ? $shipping_item_data['weight'] : $cart_weight;
		}
		
		// Format submitted SQL WHERE if set.
		$sql_where = ($sql_where) ? "($sql_where) AND " : NULL;
		
		$sql_statement = "
		SELECT  
			(SELECT ".$tbl_cols_ship_rate['id']."
				FROM ".$tbl_ship_rate['table']." 
				WHERE (".$tbl_cols_ship_rate['parent']." = ".$tbl_cols_shipping['id'].") AND 
					(".$tbl_cols_ship_rate['min_value']." <= ".$this->db->escape($cart_value)." AND 
						(".$tbl_cols_ship_rate['max_value']." > ".$this->db->escape($cart_value)." OR ".$tbl_cols_ship_rate['max_value']." = 0)) AND 
					(".$tbl_cols_ship_rate['min_weight']." <= (".$this->db->escape($cart_weight)." + ".$tbl_cols_ship_rate['tare_weight'].") AND 
						(".$tbl_cols_ship_rate['max_weight']." > (".$this->db->escape($cart_weight)." + ".$tbl_cols_ship_rate['tare_weight'].") OR
						".$tbl_cols_ship_rate['max_weight']." = 0)) AND 
					(".$tbl_cols_ship_rate['status']." = '1')
				ORDER BY ".$tbl_cols_ship_rate['max_weight'].", ".$tbl_cols_ship_rate['max_value']."
				LIMIT 1
			) AS alias_ship_rate_id,
			".$tbl_cols_shipping['id'].", ".$tbl_cols_shipping['name'].", ".$tbl_cols_shipping['description'].", 
			".$tbl_cols_shipping['location'].", ".$tbl_cols_shipping['inc_sub_locations'].", ".$tbl_cols_shipping['tax_rate'].",
			(SELECT ".$tbl_cols_ship_rate['value']." 
				FROM ".$tbl_ship_rate['table']." 
				WHERE ".$tbl_cols_ship_rate['id']." = alias_ship_rate_id
			) AS ".$tbl_cols_ship_rate['value']."
		FROM ".$tbl_shipping['table']."
		WHERE ".$sql_where.$tbl_cols_shipping['status']." = '1'
		HAVING alias_ship_rate_id > 0";
		
		// Order the results.
		$sql_statement .= ($tbl_shipping['default']) ? ' ORDER BY '.$tbl_shipping['default'].' DESC, ' : NULL;
		$sql_statement .= $tbl_cols_shipping['location'].' DESC, '.$tbl_cols_shipping['zone'].' DESC';
		
		return $this->db->query($sql_statement);
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_shipping_item_totals
	 * Calculates the total cart value and weight that should be used to calculate the carts shipping total.
	 */
	private function get_shipping_item_totals()
	{
		$separate_value = $this->flexi->cart_contents['settings']['shipping']['data']['separate_value'];
		$separate_weight = $this->flexi->cart_contents['settings']['shipping']['data']['separate_weight'];
		
		$free_value = $this->flexi->cart_contents['settings']['shipping']['data']['free_value'];
		$free_weight = $this->flexi->cart_contents['settings']['shipping']['data']['free_weight'];
	
		$item_summary_total = $this->flexi->cart_contents['summary']['item_summary_total'];
		$total_weight = $this->flexi->cart_contents['summary']['total_weight'];
		
		$shipping_item_data['value'] = $this->format_calculation($item_summary_total - $separate_value - $free_value);
		$shipping_item_data['weight'] = $this->format_calculation($total_weight - $separate_weight - $free_weight);

		return $shipping_item_data;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * set_shipping_data
	 * Updates the cart shipping array with either default shipping data, or with data that has been submitted.
	 */
	private function set_shipping_data($shipping_data = FALSE, $reset_data_only = FALSE)
	{
		// If all data must be set, rather than just the shippings internal 'data' array.
		if (! $reset_data_only)
		{
			// Set default shipping data if no data is submitted.
			if (! $shipping_data)
			{
				$set_default_data = TRUE;
				$shipping_data = (empty($shipping_data)) ? 
					array('id' => 0, 'name' => FALSE, 'description' => FALSE, 'value' => 0, 'tax_rate' => FALSE) : $shipping_data;
			}
			
			foreach($shipping_data as $column => $data)
			{
				// If data was submitted, update cart shipping array.
				if (! isset($set_default_data))
				{
					$this->flexi->cart_contents['settings']['shipping'][$column] = $data;
				}
				// Else, default values need to be set.
				else
				{
					$value = (! empty($this->flexi->cart_defaults['shipping'][$column]) || $this->non_negative($this->flexi->cart_defaults['shipping'][$column])) ? 
						$this->flexi->cart_defaults['shipping'][$column] : $data;
					
					$this->flexi->cart_contents['settings']['shipping'][$column] = $value;
				}
			}
			
			// Set location placeholder if not set.
			if (! isset($this->flexi->cart_contents['settings']['shipping']['location']))
			{
				$this->flexi->cart_contents['settings']['shipping']['location'] = array();
			}
		}
		
		// Set shipping 'data' array.
		if (isset($set_default_data) || $reset_data_only)
		{
			$default_columns = array(
				'surcharge' => 0, 'separate_shipping_value' => 0, 
				'separate_items' => 0, 'separate_value' => 0, 'separate_weight' => 0, 
				'free_items' => 0, 'free_value' => 0, 'free_weight' => 0, 
				'banned_shipping_items' => array(), 'separate_shipping_items' => array(), 'item_shipping_rates' => array()
			);
			
			foreach($default_columns as $column => $default_value)
			{
				$this->flexi->cart_contents['settings']['shipping']['data'][$column] = $default_value;
			}
		}

		return TRUE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * set_manual_shipping
	 * Manually set shipping data without querying a database table.
	 * The data that can be set includes the shipping id, value, tax rate, name and description.
	 * The valid shipping array keys are 'id', 'value', 'tax_rate' 'name' and 'description'. 
	 */
	public function set_manual_shipping($shipping_data = FALSE)
	{
		if (is_array($shipping_data) && ! empty($shipping_data))
		{
			// Loop through data and set to cart session summary.
			foreach($shipping_data as $column => $column_value)
			{
				if ($column == 'value' && $this->non_negative($column_value))
				{
					$this->flexi->cart_contents['settings']['shipping']['value'] = $this->format_calculation($column_value, 2, TRUE);
					
					// Add any existing shipping surcharge to the new value.
					$this->flexi->cart_contents['summary']['shipping_total'] = $this->format_calculation(
						$column_value + $this->flexi->cart_contents['settings']['shipping']['data']['surcharge'], 2, TRUE
					);
				}
				else if ($column == 'tax_rate' && $this->non_negative($column_value))
				{
					$this->flexi->cart_contents['settings']['shipping']['tax_rate'] = $column_value;
				}
				else if (isset($this->flexi->cart_contents['settings']['shipping'][$column]))
				{
					$this->flexi->cart_contents['settings']['shipping'][$column] = $column_value;
				}
			}
			
			return TRUE;
		}
		
		return FALSE;
	}

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TAX
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * update_tax
	 * Looks-up tax rates that match a location.
	 */
	public function update_tax($location = FALSE, $set_default = FALSE)
	{
		// Check the tax table exists in the config file and is enabled.
		if ($this->get_enabled_status('tax'))
		{
			$tax_data = $this->get_database_tax_data($location);
			
			$this->set_tax_data($tax_data, $set_default);
			
			return TRUE;
		}
		
		return FALSE;
	}

	/**
	 * set_manual_tax
	 * Manually sets tax data without querying a database table.
	 * The data that can be set is the tax rate and name.
	 * The valid tax array keys are 'rate', and 'name'. 
	 */
	public function set_manual_tax($tax_data = FALSE)
	{
		if (is_array($tax_data) && ! empty($tax_data))
		{
			// Loop through data and set to cart session summary.
			foreach($tax_data as $column => $column_value)
			{
				// Any submitted rate must be a number with no '%' sign - Example: 12.5% = 12.5.
				if ($column == 'rate' && $this->non_negative($column_value))
				{
					$this->flexi->cart_contents['settings']['tax']['rate'] = $column_value;
				}
				else if ($column == 'name')
				{
					$this->flexi->cart_contents['settings']['tax']['name'] = $column_value;
				}
			}
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_database_tax_data
	 * Looks-up the database for tax details that match the submitted location.
	 */
	public function get_database_tax_data($location = FALSE)
	{
		// Check the tax table exists in the config file and is enabled.
		if ($this->get_enabled_status('tax'))
		{
			// Set aliases of tax table data.
			$tbl_tax = $this->flexi->cart_database['tax'];
			$tbl_cols_tax = $this->flexi->cart_database['tax']['columns'];

			// Check the location tables exist in the config file and are enabled.
			if ($this->get_enabled_status('location'))
			{
				// If no location data is set, lookup defaults.
				if (empty($location) || ! is_array($location))
				{
					$location = $this->get_database_location_data(FALSE, 'tax');
				}
			}

			$sql_order_by = ($tbl_tax['default']) ? $tbl_tax['default'].' DESC, ' : NULL;
			$sql_order_by .= $tbl_cols_tax['location'].' ASC, '.$tbl_cols_tax['zone'].' ASC';

			if (isset($location))
			{
				$sql_select = array($tbl_cols_tax['name'], $tbl_cols_tax['rate']);

				// Loop through locations querying database for any matching tax rates.
				for($i = 0; isset($location[$i]); $i++)
				{
					$sql_where = $tbl_cols_tax['status']." = '1'";
					if ($location[$i]['location_id'] > 0 || $location[$i]['zone_id'] > 0)
					{
						$sql_where .= " AND (";
						$sql_where .= ($location[$i]['location_id'] > 0) ? $tbl_cols_tax['location']." = ".$this->db->escape($location[$i]['location_id'])." OR " : NULL; 
						$sql_where .= ($location[$i]['zone_id'] > 0) ? $tbl_cols_tax['zone']." = ".$this->db->escape($location[$i]['zone_id']) : NULL;
						$sql_where = rtrim($sql_where, ' OR ').")";
					}
				
					$query = $this->db->select($sql_select)
						->from($tbl_tax['table'])
						->where($sql_where)
						->order_by($sql_order_by)
						->limit(1)
						->get();

					if ($query->num_rows() == 1)
					{
						$tax_data = $query->row_array();
						$tax['name'] = $tax_data[$this->flexi->cart_database['tax']['columns']['name']];
						$tax['rate'] = $tax_data[$this->flexi->cart_database['tax']['columns']['rate']];
						
						return $tax;
					}
				}
			}
			
			// If no tax data has been returned by the database lookup, lookup the database default tax columns set via config file.
			if ($tbl_tax['default'])
			{
				$sql_select = array($tbl_cols_tax['name'], $tbl_cols_tax['rate']);
				
				$sql_where = array(
					$tbl_cols_tax['status'] => 1,
					$tbl_tax['default'] => 1
				);
				
				$query = $this->db->select($sql_select)
					->where($sql_where)
					->from($tbl_tax['table'])
					->order_by($sql_order_by)
					->limit(1)
					->get();
					
				if ($query->num_rows() == 1) 
				{
					$tax_data = $query->row_array();
					$tax['name'] = $tax_data[$this->flexi->cart_database['tax']['columns']['name']];
					$tax['rate'] = $tax_data[$this->flexi->cart_database['tax']['columns']['rate']];
					
					return $tax;
				}
			}
		}
		
		return FALSE;
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_item_tax_rate
	 * Looks-up the database for an items tax rate.
	 */
	public function get_item_tax_rate($row_id = FALSE, $fallback_default = FALSE)
	{
		if (isset($this->flexi->cart_contents['items'][$row_id]))
		{
			$item_data = $this->flexi->cart_contents['items'][$row_id];
						
			// If item has a manually set tax rate.
			if ($this->flexi_cart_lite_model->non_negative($item_data[$this->flexi->cart_columns['item_tax_rate']]))
			{
				$tax_rate = $item_data[$this->flexi->cart_columns['item_tax_rate']];
			}
			// If item does not have a manually set tax rate (i.e. set when item added to cart), attempt to lookup item tax rates from a database table.
			else
			{
				$tax_rate = $this->flexi_cart_lite_model->get_database_item_tax_rate($item_data[$this->flexi->cart_columns['item_id']]);
			}
			
			// If a tax rate is set.
			if ($this->flexi_cart_lite_model->non_negative($tax_rate)) 
			{
				return $tax_rate;
			}
			// Else, return either the current cart tax rate or return FALSE.
			else
			{
				return ($fallback_default) ? $this->flexi_cart->tax_rate(FALSE) : FALSE;
			}
		}
		
		return FALSE;
	}
	
	/**
	 * set_tax_data
	 * Updates the cart tax array with either default tax data, or with data that has been submitted.
	 */
	public function set_tax_data($tax_data = FALSE, $set_default_rate = FALSE)
	{
		// If data was submitted, update cart tax array.
		if ($tax_data)
		{
			foreach($tax_data as $column => $data)
			{
				$this->flexi->cart_contents['settings']['tax'][$column] = $data;
			}
		}
		else
		{
			// Set default tax data if no data is submitted.
			$tax_data = array('name' => 'Tax', 'rate' => 0, 'internal_rate' => 0, 'location' => array());
			
			foreach($tax_data as $column => $data)
			{
				// If a default value has not been set.
				if (! isset($this->flexi->cart_contents['settings']['tax'][$column]))
				{
					$value = (! empty($this->flexi->cart_defaults['tax'][$column])) ? $this->flexi->cart_defaults['tax'][$column] : $data;
					
					$this->flexi->cart_contents['settings']['tax'][$column] = $value;
				}
			}
			
			// Set tax 'data' array.
			$default_columns = array(
				'item_total_tax', 'shipping_tax', 'item_discount_tax', 'summary_discount_tax', 'reward_voucher_tax', 'surcharge_tax', 'cart_tax', 
				'cart_taxable_value', 'cart_non_taxable_value'
			);
			
			foreach($default_columns as $column)
			{
				$this->flexi->cart_contents['settings']['tax']['data'][$column] = 0;
			}
		}
		
		// Set internal cart tax rate for taxing internal calculations using the carts default tax rate.
		if ($set_default_rate)
		{
			$this->flexi->cart_contents['settings']['tax']['internal_rate'] = $this->flexi->cart_contents['settings']['tax']['rate'];
		}
		
		return TRUE;
	}

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * validate_discount_codes
	 * Looks-up a database table to check which submitted discount codes are set and valid.
	 */
	public function validate_discount_codes($discount_codes)
	{
		if (empty($discount_codes))
		{
			return FALSE;
		}
	
		// Set alias of discount table data.
		$tbl_discount = $this->flexi->cart_database['discounts']['table'];
		$tbl_cols_discount = $this->flexi->cart_database['discounts']['columns'];
		
		$sql_select = array(
			$tbl_cols_discount['id'], 
			$tbl_cols_discount['code'], 
			$tbl_cols_discount['description']
		);
		
		// Create SQL WHERE statement.
		$sql_where = $tbl_cols_discount['usage_limit']." > 0 AND ".$tbl_cols_discount['valid_date']." <= '".$this->database_date_time()."' AND 
			".$tbl_cols_discount['expire_date']." >= '".$this->database_date_time()."' AND ".$tbl_cols_discount['status']." = 1 AND (1=2 OR ";
		foreach((array)$discount_codes as $discount_code)
		{
			if (! empty($discount_code))
			{
				$sql_where .= $tbl_cols_discount['code']." = ".$this->db->escape($discount_code)." OR ";
			}
		}
		$sql_where = rtrim($sql_where,' OR ').")";
		
		$query = $this->db->select($sql_select)
			->from($tbl_discount)
			->where($sql_where)
			->order_by($tbl_cols_discount['order_by'], 'desc')
			->get();
		
		return ($query->num_rows() > 0) ? $query->result_array() : FALSE; 
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_all_discounts
	 * Groups all discount data together and returns a formatted array of valid discount data to apply to the cart.
	 */
	public function get_all_discounts()
	{
		// Set default discount target column data.
		$discounts = array(
			'item_price' => array(),
			'item_shipping' => array(),
			'item_summary_total' => array(),
			'shipping_total' => array(),
			'total' => array(),
			'reward_vouchers' => array()
		);
		
		// Get all available discounts.
		$unsorted_discount_data['manual_discount'] = $this->get_manual_discounts();
		$unsorted_discount_data['non_group_discount'] = $this->get_non_group_discounts();
		$unsorted_discount_data['group_discounts'] = $this->get_group_discounts();
		
		if (! empty($unsorted_discount_data['manual_discount']) || ! empty($unsorted_discount_data['non_group_discount']) || ! empty($unsorted_discount_data['group_discounts']))
		{
			// Loop through and group discounts.
			foreach($unsorted_discount_data as $discount_type)
			{
				if (! empty($discount_type))
				{
					// Loop through the discount target columns 'item_price', 'item_shipping', 'item_summary_total', 'shipping_total', 'total' and 'reward_vouchers'.
					foreach($discount_type as $target_column => $target_data)
					{
						foreach($target_data as $discount_id => $discount_data)
						{
							$discounts[$target_column][$discount_id] = $discount_data;
						}
					}
				}
			}
			
			###+++++++++++++++++++++++++++++++++###

			### Validate and Sort Item Discounts.

			$item_discount_data = $this->validate_item_discounts($discounts);
			
			// Merge item discount data.
			$discounts['item_price'] = (! empty($item_discount_data['discounts']['item_price'])) ? $item_discount_data['discounts']['item_price'] : array();
			$discounts['item_shipping'] = (! empty($item_discount_data['discounts']['item_shipping'])) ? $item_discount_data['discounts']['item_shipping'] : array();
			
			###+++++++++++++++++++++++++++++++++###
			
			// If a 'Non-combinable' item discount has been set, remove all other summary discount data.
			if ($item_discount_data['non_combinable_discount'])
			{
				$discounts = array(
					'item_price' => $discounts['item_price'],
					'item_shipping' => $discounts['item_shipping'],
					'item_summary_total' => array(),
					'shipping_total' => array(),
					'total' => array()
				);
			}

			###+++++++++++++++++++++++++++++++++###

			// Sort discount data.
			foreach($discounts as $target_column => $discount_data) 
			{
				$sorted_discounts[$target_column] = $target_column;
			}
			array_multisort($sorted_discounts, SORT_ASC, $discounts);
		}

		return $discounts;
	}
	
	/**
	 * get_manual_discounts
	 * Returns a formatted array of all manually set discount data to apply to the cart.
	 */
	public function get_manual_discounts()
	{
		// Set aliases of discount table data.
		$tbl_cols_discounts = $this->flexi->cart_database['discounts']['columns'];
		$tbl_cols_discount_calculations = $this->flexi->cart_database['discount_calculation']['columns'];

		$manual_set_discounts = $this->flexi->cart_contents['settings']['discounts']['manual'];

		$discounts = array();	
		if (! empty($manual_set_discounts))
		{
			foreach($manual_set_discounts as $column)
			{			
				$discounts[$column['column']][] = array(
					'id' =>  $column['id'],
					'calculation_id' => $column['calculation'],
					'code' => FALSE,
					'description' => $column['description'],
					'quantity_required' => 1,
					'quantity_discounted' => 1,
					'value_required' => 0,
					'value_discounted' => $column['value'],
					'recursive' => 0,
					'non_combinable' => FALSE,
					'void_reward_points' => (bool)$column['void_reward_points'],
					'force_shipping_discount' => FALSE,
					'tax_method' => $column['tax_method']
				);
			}
		}
		
		return $discounts;
	}
	
	/**
	 * get_non_group_discounts
	 * Returns an array of all database discounts for non-grouped items, summaries and discount codes.
	 */
	public function get_non_group_discounts()
	{
		// Check the discount tables exist in the config file and are enabled.
		if ($this->get_enabled_status('discounts'))
		{
			// Set aliases of discount table data.
			$tbl_cols_discounts = $this->flexi->cart_database['discounts']['columns'];
			$tbl_cols_discount_columns = $this->flexi->cart_database['discount_columns']['columns'];

			$sql_select = array(
				$tbl_cols_discounts['item'].' AS item_id'
			);
				
			// Get all summary discounts.
			// Lookup item id from item data array and add to SQL WHERE string.
			$sql_where = " AND ".$tbl_cols_discounts['group']." = '0' AND (("
				.$tbl_cols_discount_columns['id']." IN (3,4,5) AND ".$tbl_cols_discounts['code']." = '') OR ("; 
			foreach($this->flexi->cart_contents['items'] as $item)
			{
				$sql_where .= $tbl_cols_discounts['item']." = '".$item[$this->flexi->cart_columns['item_id']]."' OR ";
			}
			$sql_where = rtrim($sql_where,' OR ').")";
			
			// Lookup discounts matching submitted discount codes and add to SQL WHERE string.
			if (! empty($this->flexi->cart_contents['settings']['discounts']['codes']))
			{
				$sql_where .= " OR (";
				foreach($this->flexi->cart_contents['settings']['discounts']['codes'] as $code => $discount_data)
				{
					$sql_where .= $tbl_cols_discounts['code']." = ".$this->db->escape($code)." OR "; 
				}
				$sql_where = rtrim($sql_where,' OR ').")";
			}
			$sql_where .= ")";
			
			if ($item_discount_data = $this->get_database_discount_data($sql_select, $sql_where, 'non_group_discounts'))
			{
				return $this->sort_discount_data($item_discount_data);
			}
		}
		
		return FALSE;
	}
	
	/**
	 * get_group_discounts
	 * Returns an array of all database discounts for grouped items.
	 */
	public function get_group_discounts()
	{
		// Check the discount tables exist in the config file and are enabled.
		if ($this->get_enabled_status('discounts'))
		{
			// Set aliases of discount table data.
			$tbl_cols_discounts = $this->flexi->cart_database['discounts']['columns'];
			$tbl_cols_group_discounts = $this->flexi->cart_database['discount_groups']['columns'];
			$tbl_cols_group_item_discounts = $this->flexi->cart_database['discount_group_items']['columns'];
		
			$sql_select = array(
				$tbl_cols_group_item_discounts['item'].' AS item_id',
				$tbl_cols_discounts['group'].' AS group_id'
			);

			// Lookup item id from item data array and add to SQL WHERE string
			$sql_where = ' AND ('.$tbl_cols_group_item_discounts['item'].' IN (';
			foreach($this->flexi->cart_contents['items'] as $item)
			{
				$sql_where .= $item[$this->flexi->cart_columns['item_id']].',';
			}
			$sql_where = rtrim($sql_where,',').') AND '.$tbl_cols_group_discounts['status'].' = 1)';
			
			if ($group_item_discount_data = $this->get_database_discount_data($sql_select, $sql_where, 'group_discounts'))
			{
				return $this->sort_discount_data($group_item_discount_data);
			}
		}
		
		return FALSE;
	}
	
	/**
	 * get_database_discount_data
	 * Looks-up database and returns all discounts that match any item in the cart, any summary discounts and any submitted discount codes.
	 * The query checks all returned discounts are currently valid and are available to the current location, however, they may not become active until 
	 * a required minimum item sub-total or quantity is reached.
	 */
	private function get_database_discount_data($arg_sql_select = array(), $arg_sql_where = NULL, $target_data = FALSE)
	{
		// Check the discount tables exist in the config file and are enabled.
		if ($this->get_enabled_status('discounts'))
		{
			// Set aliases of discount table data.
			$tbl_discounts = $this->flexi->cart_database['discounts'];
			$tbl_cols_discounts = $this->flexi->cart_database['discounts']['columns'];
			$tbl_discount_methods = $this->flexi->cart_database['discount_methods'];
			$tbl_discount_columns = $this->flexi->cart_database['discount_columns'];
			$tbl_discount_calculations = $this->flexi->cart_database['discount_calculation'];
			$tbl_group_discounts = $this->flexi->cart_database['discount_groups'];
			$tbl_group_item_discounts = $this->flexi->cart_database['discount_group_items'];
			
			$location = $this->flexi_cart->shipping_location_data();

			$sql_select = array(
				$tbl_cols_discounts['id'].' AS id',
				$tbl_discount_columns['columns']['id'].' AS column_id', 
				$tbl_discount_calculations['columns']['id'].' AS calculation_id',
				$tbl_cols_discounts['code'].' AS code',
				$tbl_cols_discounts['description'].' AS description',
				$tbl_cols_discounts['quantity_required'].' AS quantity_required',
				$tbl_cols_discounts['quantity_discounted'].' AS quantity_discounted',
				$tbl_cols_discounts['value_required'].' AS value_required',
				$tbl_cols_discounts['value_discounted'].' AS value_discounted',
				$tbl_cols_discounts['recursive'].' AS recursive',
				$tbl_cols_discounts['custom_status_1'].' AS custom_status_1',
				$tbl_cols_discounts['custom_status_2'].' AS custom_status_2',
				$tbl_cols_discounts['custom_status_3'].' AS custom_status_3',
				$tbl_cols_discounts['non_combinable'].' AS non_combinable',
				$tbl_cols_discounts['void_reward_points'].' AS void_reward_points',
				$tbl_cols_discounts['force_shipping_discount'].' AS force_shipping_discount',
				$tbl_cols_discounts['tax_method'].' AS tax_method'
			);
			
			// Merge submitted SELECT statement to current SELECT statement.
			$sql_select = array_merge($arg_sql_select, $sql_select);
			
			// Create SQL WHERE checking discounts are valid.
			$sql_where = $tbl_cols_discounts['valid_date']." <= '".$this->database_date_time()."' AND ".
				$tbl_cols_discounts['expire_date']." >= '".$this->database_date_time()."' AND ".$tbl_cols_discounts['status']." = 1 AND ".
				$tbl_cols_discounts['usage_limit']." > 0 AND ((".$tbl_cols_discounts['location']." = '0' AND ".$tbl_cols_discounts['zone']." = '0')";
			
			// Loop through shipping locations.
			if (! empty($location))
			{
				for($i = 0; isset($location[$i]); $i++)
				{
					if ($location[$i]['location_id'] > 0 || $location[$i]['zone_id'] > 0)
					{
						$sql_where .= " OR (";
						$sql_where .= ($location[$i]['location_id'] > 0) ? $tbl_cols_discounts['location']." = ".$this->db->escape($location[$i]['location_id'])." AND " : NULL;
						$sql_where .= ($location[$i]['zone_id'] > 0) ? $tbl_cols_discounts['zone']." = ".$this->db->escape($location[$i]['zone_id']) : NULL;
						$sql_where = rtrim($sql_where, ' AND ').")";
					}
				}
				$sql_where .= ")";
			}
			
			// If the cart is being updated by an admin updating a saved order, enable all discounts that were active when the order was saved.
			if (isset($this->flexi->cart_contents['settings']['admin_data']['discounts']['active']))
			{
				// Ensure none of the admin data discounts have since been excluded from being applied.
				$sql_where_admin_data = NULL;
				foreach($this->flexi->cart_contents['settings']['admin_data']['discounts']['active'] as $key => $value)
				{
					if (! in_array($value, $this->flexi->cart_contents['settings']['discounts']['data']['excluded_discounts']))
					{
						$sql_where_admin_data .= $value.',';
					}
				}
				
				if ($sql_where_admin_data)
				{
					$arg_sql_where .= ' OR ('.$tbl_cols_discounts['id'].' IN ('.$sql_where_admin_data;
					$arg_sql_where = rtrim($arg_sql_where,',').')';
					$arg_sql_where .= ($target_data == 'group_discounts') ? ' AND '.$tbl_cols_discounts['group'].' > 0)' : ' AND '.$tbl_cols_discounts['group'].' = 0)';
				}
			}

			// Exclude any discounts that may have been specifically excluded from the cart.
			// Typically these would be 'auto' discounts that are automatically applied when a value in the cart exceeds the required quantity and value 
			// needed to activate a database discount.
			if (! empty($this->flexi->cart_contents['settings']['discounts']['data']['excluded_discounts']))
			{
				$this->db->where_not_in($tbl_cols_discounts['id'], $this->flexi->cart_contents['settings']['discounts']['data']['excluded_discounts']);
			}
			
			// Append submitted SQL WHERE statement to current SQL WHERE statement.
			$this->db->where($sql_where.$arg_sql_where);
			
			$sql_order_by = $tbl_cols_discounts['order_by'].' ASC, '.$tbl_cols_discounts['location'].' ASC, '.$tbl_cols_discounts['zone'].' ASC';
			
			$query = $this->db->select($sql_select)
				->from($tbl_discounts['table'])
				->join($tbl_discount_methods['table'], $tbl_cols_discounts['method'].' = '.$tbl_discount_methods['columns']['id'])
				->join($tbl_discount_columns['table'], $tbl_discount_methods['columns']['target_column'].' = '.$tbl_discount_columns['columns']['id'])
				->join($tbl_discount_calculations['table'], $tbl_discount_methods['columns']['calculation'].' = '.$tbl_discount_calculations['columns']['id'])
				->join($tbl_group_discounts['table'], $tbl_cols_discounts['group'].' = '.$tbl_group_discounts['columns']['id'], 'left')
				->join($tbl_group_item_discounts['table'], $tbl_group_discounts['columns']['id'].' = '.$tbl_group_item_discounts['columns']['group'], 'left')
				->order_by($sql_order_by)
				->get();
			
			return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
		}
		
		return FALSE;
	}

	/**
	 * sort_discount_data
	 * Returns an array of discounts that has been sorted into groups for items and summaries.
	 */
	private function sort_discount_data($discount_data = FALSE)
	{
		// Check the discount tables exist in the config file and are enabled.
		if ($this->get_enabled_status('discounts') && ! empty($discount_data))
		{			
			$sorted_data = FALSE;
			
			// Get miscellaneous status settings.
			$custom_status_1 = $this->flexi_cart->custom_status_1();
			$custom_status_2 = $this->flexi_cart->custom_status_2();
			$custom_status_3 = $this->flexi_cart->custom_status_3();
			
			// Loop through query rows and separate discount data from discounted item ids.			
			foreach($discount_data as $row_data)
			{
				// Check discount is applicable to the current miscellaneous status settings, else do not include the discount.
				/*
				if (($row_data['custom_status_1'] == 1 && ! $custom_status_1) || ($row_data['custom_status_2'] == 1 && ! $custom_status_2) 
					|| ($row_data['custom_status_3'] == 1 && ! $custom_status_3))
				{
					continue;
				}
				*/
				
				if (($row_data['custom_status_1'] != '' && $row_data['custom_status_1'] != $custom_status_1) || 
					($row_data['custom_status_2'] != '' && $row_data['custom_status_2'] != $custom_status_2) ||
					($row_data['custom_status_3'] != '' && $row_data['custom_status_3'] != $custom_status_3))
				{
					continue;
				}

				// Set aliases for discount and item id.
				$discount_id = $row_data['id'];
				$item_id = $row_data['item_id'];
				
				// Get discount target column name.
				$target_column_ids = array(1 => 'item_price', 2 => 'item_shipping', 3 => 'item_summary_total', 4 => 'shipping_total', 5 => 'total', 6 => 'reward_vouchers');
				foreach($target_column_ids as $column_id => $column)
				{
					if ($row_data['column_id'] == $column_id)
					{
						$target_column = $column;
						break;
					}
				}
				
				// Remove non-required discount data.				
				$remove_discount_keys = array('item_id', 'column_id', 'group_id', 'custom_status_1', 'custom_status_2', 'custom_status_3');
				foreach($remove_discount_keys as $column)
				{
					unset($row_data[$column]);
				}
			
				// Set discount data if not already set.
				if (! isset($sorted_data[$target_column][$discount_id]))
				{
					$sorted_data[$target_column][$discount_id] = $row_data;
				}
				
				// Add item id to discount data if applicable.
				if ($item_id > 0)
				{
					$sorted_data[$target_column][$discount_id]['item_ids'][] = $item_id;
				}
			}
			
			return $sorted_data;
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
			
	/**
	 * validate_item_discounts
	 * Validates all item discounts checking minimum required quantities and values of all cart items.
	 */
	private function validate_item_discounts($item_discount_data)
	{
		// Check the discount tables exist in the config file and are enabled.
		if ($this->get_enabled_status('discounts'))
		{
			// Set an array to hold the ids of all items that have had a discount applied.
			$valid_item_discount_data = array('item_price' => array(), 'item_shipping' => array());
			$discounted_items = array();
			$discounted_cart_value = 0;
			$non_combinable_discount = FALSE;
			
			// Loop through submitted discount data and remove all non item discounts.
			foreach($item_discount_data as $target_column => $discount_data)
			{
				if (! in_array($target_column, array('item_price', 'item_shipping')))
				{
					unset($item_discount_data[$target_column]);
				}
			}
			
			// All discounts are applied to the cheapest applicable items first, to enforce this, sort items by price, cheapest to most expensive.
			$items = $this->flexi->cart_contents['items'];
			foreach ($items as $row_id => $column) 
			{	
				$items_sorted[$row_id] = $column[$this->flexi->cart_columns['item_price']];
			}
			array_multisort($items_sorted, SORT_ASC, $items);
			
			// Get array of current user submitted discount codes.
			$discount_codes = $this->flexi->cart_contents['settings']['discounts']['codes'];
			
			// Start looping through each item based discount and calculate the discount value.
			foreach($item_discount_data as $target_column => $discount_data)
			{
				// Loop through all discounts for current target column.
				foreach($discount_data as $discount_id => $discount_cols)
				{
					// If an item discount is activated via a user submitted code, ensure the discount code has been entered.
					// Or if a discount is 'Non-Combinable' (i.e. There can be no other cart discounts), check no other discounts have been set.
					if ((strlen($discount_cols['code']) > 0 && ! array_key_exists($discount_cols['code'], $discount_codes)) ||
						($discount_cols['non_combinable'] == 1 && ! empty($discounted_items)))
					{
						continue;
					}
					
					// Tally discount data to check if discount has a valid minimum quantity and value of items to activate discount.
					$applicable_item_quantity = $applicable_item_value = 0;
					$applicable_items = array();
					
					// Loop through cart items and tally the quantity and value of items applicable to the discount.
					foreach($items as $row_id => $column)
					{
						if (in_array($column[$this->flexi->cart_columns['item_id']], $discount_cols['item_ids']) && 
							! in_array($column[$this->flexi->cart_columns['item_id']], $discounted_items))
						{
							$applicable_item_quantity += $column[$this->flexi->cart_columns['item_quantity']];
							$applicable_item_value += ($column[$this->flexi->cart_columns['item_price']] * $column[$this->flexi->cart_columns['item_quantity']]);
							
							$applicable_items[$row_id] = array(
								'id' => $discount_id,
								'item_id' => $column[$this->flexi->cart_columns['item_id']],
								'description' => $discount_cols['description'],
								'discount_quantity' => 0,
								'non_discount_quantity' => $column[$this->flexi->cart_columns['item_quantity']],
								'item_value' => $column[$this->flexi->cart_columns['item_price']],
								'item_discount' => 0,
								'taxable_value' => 0,
								'non_taxable_value' => 0,
								'tax_value' => 0,
								'void_reward_points' => (bool)$discount_cols['void_reward_points'],
								'force_shipping_discount' => (bool)$discount_cols['force_shipping_discount']
							);
						}
					}

					// Check that the total quantity and value of items has activated the discounted.
					if (! empty($applicable_items) && 
						$applicable_item_quantity >= $discount_cols['quantity_required'] && 
						$applicable_item_value >= $discount_cols['value_required']
					)
					{
						// Calculate the quantity of items that the discount will apply to.
						// Set default quantity values incase they equal zero.
						$quantity_discounted = ($discount_cols['quantity_discounted'] >= 1) ? $discount_cols['quantity_discounted'] : 1;
						$quantity_required = ($discount_cols['quantity_required'] >= 1) ? $discount_cols['quantity_required'] : 1;
					
						// If the discount is recursive, calculate number of times the discount needs to be applied.
						// Example: Buy 2, Get 1 @ 50% off, and 7 items are added to the cart.
						// If 'recursive' = TRUE (1), 2 items will have 50% off, and 5 at normal price, if FALSE (0), 1 item will have 50% off, and 6 at normal price.
						$repeat_discount = ($discount_cols['recursive'] == 1) ? floor($applicable_item_quantity / $quantity_required) : 1;
						
						// Calculate the number of items to be discounted.
						$discounted_quantity = ($repeat_discount * $quantity_discounted);
						
						// Loop through applicable items and apply discount values.
						foreach($applicable_items as $row_id => $item_data)
						{
							if ($discounted_quantity > 0)
							{
								// Calculate the quantity of items that the discount can and cannot be applied to.
								$applicable_items[$row_id]['discount_quantity'] = ($discounted_quantity >= $item_data['non_discount_quantity']) ? 
									$item_data['non_discount_quantity'] : $discounted_quantity;
								$applicable_items[$row_id]['non_discount_quantity'] = ($item_data['non_discount_quantity'] - $applicable_items[$row_id]['discount_quantity']);

								// Calculate the number of items discounted by the loop so far.
								$discounted_quantity = ($discounted_quantity >= $item_data['non_discount_quantity']) ? 
									($discounted_quantity - $item_data['non_discount_quantity']) : 0;
								
								// Calculate item tax data.
								$item_tax_rate = $this->get_item_tax_rate($row_id, TRUE);
								$item_tax_data = $this->calculate_tax($applicable_items[$row_id]['item_value'], $item_tax_rate);
								
								// Calculate item discount data.
								$discount_calculation_data = $this->calculate_discount(
									$discount_cols['value_discounted'], 
									$item_tax_data['taxable_value'], $item_tax_data['non_taxable_value'], $item_tax_data['tax_value'], $item_tax_rate, 
									$discount_cols['calculation_id'], $discount_cols['tax_method']
								);
								
								if (! empty($discount_calculation_data))
								{
									foreach($discount_calculation_data as $column => $discount_data)
									{
										if ($column == 'total')
										{
											// Calculate discount value per quantity.
											$applicable_items[$row_id]['item_discount'] = $this->format_calculation(
												($applicable_items[$row_id]['item_value'] - $discount_data)
											);
											
											$applicable_items[$row_id]['item_value'] = $discount_data;
										}
										else
										{
											$applicable_items[$row_id][$column] = $discount_data;
										}
									}
								}
								else
								{
									unset($applicable_items[$row_id]);
								}
							}
							else
							{
								break;
							}
						}
						
						// Loop through items discount has been applied to.
						foreach($applicable_items as $row_id => $item_data)
						{
							// Save item discount data to an array of valid item discounts.
							$valid_item_discount_data[$target_column][$row_id] = $item_data;
							
							// Add discounted item ids to the discounted item array to prevent it being included in another discount.
							$discounted_items[] = $item_data['item_id'];
							
							// If the discount is 'Non-Combinable' (i.e. There can be no other cart discounts), set var to indicate discount is non-combinable.
							// Stop all further item discount loops. 
							if ($discount_cols['non_combinable'] == 1)
							{
								$non_combinable_discount = TRUE;
								break 3;
							}
						}
					}
				}
			}
			
			return array(
				'discounts' => $valid_item_discount_data,
				'non_combinable_discount' => $non_combinable_discount
			);
		}
		
		return FALSE;
	}
	
	/**
	 * calculate_discount
	 * Discounts a submitted value.
	 */
	private function calculate_discount(
		$discount_value = 0, $taxable_value_ex_tax = 0, $non_taxable_value = 0, $tax_value = 0, $tax_rate = FALSE, $calculation_method = FALSE, $discount_tax_method = FALSE)
	{
		// Check sufficient discount data has been submitted.
		if (($calculation_method != 3 && $discount_value <= 0) || ($taxable_value_ex_tax == 0 && $non_taxable_value == 0) || ($taxable_value_ex_tax > 0 && $tax_value == 0))
		{
			return FALSE;
		}

		// Set default calculation and tax application methods if not set.
		// By default, the discount calculation method is a percentage discount.
		if (! in_array($calculation_method, array(1,2,3)))
		{
			$calculation_method = 1;
		}
		
		// Check if a discount method has been set, else, use the carts default tax setting to apply tax to the discount in the same way it is applied to item pricing.
		if (! in_array($discount_tax_method, array(1,2,3)))
		{
			$discount_tax_method = ($this->flexi_cart->cart_prices_inc_tax()) ? 1 : 2;
		}
		
		// Start discount calculations.
		// Calculate the current 'to-be-discounted' total.
		$current_total = ($discount_tax_method == 1) ? ($taxable_value_ex_tax + $non_taxable_value + $tax_value) : ($taxable_value_ex_tax + $non_taxable_value);			
		
		// Calculate the discounted total in accordance to the specified discount method.
		if ($calculation_method == 1)
		{
			$discounted_total = $this->format_calculation($current_total - ($current_total * ($discount_value / 100)));
		}
		else if ($calculation_method == 2)
		{
			$discounted_total = $this->format_calculation($current_total - $discount_value);
		}
		else
		{
			$discounted_total = $this->format_calculation($discount_value);
		}
		
		// Check if the new discounted total is more the zero.
		if ($discounted_total > 0)
		{
			// Calculate value discount factor that can then be used to calculate the newly discounted taxed and non-taxed applicable values.
			$value_discount_factor = ($current_total / $discounted_total);
			$taxable_value_ex_tax = ($taxable_value_ex_tax / $value_discount_factor);
			$non_taxable_value = ($non_taxable_value / $value_discount_factor);
			
			if ($tax_value > 0 && $discount_tax_method != 3)
			{
				$tax_value = ($tax_value / $value_discount_factor);
			}
		}
		// Else, a 'New Value' discount may be set with the item value as zero (Or free).
		else 
		{
			$taxable_value_ex_tax = $non_taxable_value = 0;
			$tax_value = ($tax_value > 0 && $discount_tax_method == 3) ? ($tax_value) : 0;
		}
				
		// Calculate discounted total and return total value either ex/including tax depending on the carts tax inclusion setting.
		$item_total = ($taxable_value_ex_tax + $non_taxable_value);
		$total = ($this->flexi_cart->cart_prices_inc_tax()) ? ($item_total + $tax_value) : $item_total;

		// Set and format return values.
		$discount['tax_method'] = $discount_tax_method;
		$discount['taxable_value'] = $this->format_calculation($taxable_value_ex_tax, 4);
		$discount['non_taxable_value'] = $this->format_calculation($non_taxable_value, 4);
		$discount['tax_value'] = $this->format_calculation($tax_value, 4);
		$discount['total'] = $this->format_calculation($total);
		
		return $discount;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * validate_summary_discount
	 * Validate a summary discount against the carts item quantity and value.
	 */
	private function validate_summary_discount($discount_data = FALSE, $summary_value = 0)
	{
		if (empty($discount_data) || empty($summary_value))
		{
			return FALSE;
		}
		
		$total_items = $this->flexi->cart_contents['summary']['total_items'];
		
		// Loop through discount data and check whether the discount can be activated.
		foreach($discount_data as $discount)
		{
			if (($total_items >= $discount['quantity_required']) && ($summary_value >= $discount['value_required']))
			{
				return $discount;
			}
		}
		
		return FALSE;
	}

	/**
	 * calculate_summary_discount
	 * Calculate the discount applied to a summary column and sets the related values.
	 */
	private function calculate_summary_discount($discount_data, $taxable_value_ex_tax = 0, $non_taxable_value = 0, $tax_value = 0, $tax_rate = FALSE, 
		$append_values = TRUE, $target_column = FALSE)
	{
		// Only allow 'New Value' discounts to be applied to the shipping rate, otherwise a cart of unlimited items could be sold for the 'New Value'.
		if (empty($discount_data) || (isset($discount_data['calculation_id']) && $discount_data['calculation_id'] == 3 && $target_column != 'shipping')
		)
		{
			return FALSE;
		}
		
		// Calculate the non discounted summary total.
		$non_discounted_total = ($this->flexi_cart->cart_prices_inc_tax()) ? 
			round(($taxable_value_ex_tax + $non_taxable_value + $tax_value), 2) : round(($taxable_value_ex_tax + $non_taxable_value), 2);

		// Calculate discount value.
		$discount = $this->calculate_discount(
			$discount_data['value_discounted'], $taxable_value_ex_tax, $non_taxable_value, $tax_value, $tax_rate,
			$discount_data['calculation_id'], $discount_data['tax_method']
		);
		
		// If a 'new value' shipping discount has been set that costs more than the original value, recalculate the 'new value' to equal the original value.
		if (($target_column == 'shipping' && $discount_data['calculation_id'] == 3) && ($discount['total'] > $non_discounted_total))
		{
			$discount = $this->calculate_discount(
				$non_discounted_total, $taxable_value_ex_tax, $non_taxable_value, $tax_value, $tax_rate,
				$discount_data['calculation_id'], $discount_data['tax_method']
			);
		}
				
		// Check discount value is set and is not more than the target column value, else it would result in a negative value.
		if ($discount && ($non_discounted_total >= $discount['total']))
		{
			$discount['non_combinable'] = (bool)$discount_data['non_combinable'];
			$discount['void_reward_points'] = (bool)$discount_data['void_reward_points'];
				
			// Calculate discount value and discount tax.
			$discount['value'] = ($discount['tax_method'] == 1) ? ($non_discounted_total - $discount['total']) : 
				(($taxable_value_ex_tax + $non_taxable_value) - ($discount['taxable_value'] + $discount['non_taxable_value']));
			$discount['discount_tax'] = ($discount['value'] - ($taxable_value_ex_tax - $discount['taxable_value']) > 0) ?
				($discount['value'] - ($taxable_value_ex_tax - $discount['taxable_value'])) : 0;

			if ($target_column != 'reward_vouchers')
			{
				// Update summary discount data.
				$this->flexi->cart_contents['settings']['discounts']['data']['summary_discount_savings'] += $discount['value'];	
				$this->flexi->cart_contents['settings']['tax']['data']['summary_discount_tax'] += $discount['discount_tax'];
			}
			else
			{
				// Update reward voucher data.
				$this->flexi->cart_contents['settings']['discounts']['data']['reward_vouchers'] += $discount['value'];	
				$this->flexi->cart_contents['settings']['tax']['data']['reward_voucher_tax'] += $discount['discount_tax'];
			}				
			
			// Update tax columns.
			if ($append_values)
			{
				$this->flexi->cart_contents['settings']['tax']['data']['cart_tax'] += $discount['tax_value'];
				$this->flexi->cart_contents['settings']['tax']['data']['cart_taxable_value'] += $discount['taxable_value'];
				$this->flexi->cart_contents['settings']['tax']['data']['cart_non_taxable_value'] += $discount['non_taxable_value'];
			}
			else
			{
				$this->flexi->cart_contents['settings']['tax']['data']['cart_tax'] = $discount['tax_value'];
				$this->flexi->cart_contents['settings']['tax']['data']['cart_taxable_value'] = $discount['taxable_value'];
				$this->flexi->cart_contents['settings']['tax']['data']['cart_non_taxable_value'] = $discount['non_taxable_value'];
			}
			
			return $discount;
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * save_item_discount_data
	 * Saves the calculated item discount data to the cart array.
	 */
	private function save_item_discount_data($row_id, $item_discount_data, $is_shipping_discount = FALSE)
	{
		$this->flexi->cart_contents['settings']['discounts']['active_items'][$row_id] = array(
			'id' => $item_discount_data['id'],
			'description' => $item_discount_data['description'],
			'discount_quantity' => $item_discount_data['discount_quantity'],
			'non_discount_quantity' => $item_discount_data['non_discount_quantity'],
			'tax_value' => $item_discount_data['tax_value'],
			'value' => $item_discount_data['item_discount'],
			'shipping_discount' => (bool)$is_shipping_discount
		);
		
		return TRUE;
	}
	
	/**
	 * save_summary_discount_data
	 * Saves the calculated summary discount data to the cart array.
	 */
	private function save_summary_discount_data($summary_column, $summary_discount_data, $discount_calculation_data)
	{
		$discount_data = array(
			'id' => $summary_discount_data['id'],
			'code' => $summary_discount_data['code'],
			'description' => $summary_discount_data['description'],
			'tax_value' => $discount_calculation_data['discount_tax'],
			'value' => $discount_calculation_data['value']
		);
		
		if ($summary_column != 'reward_vouchers')
		{
			$this->flexi->cart_contents['settings']['discounts']['active_summary'][$summary_column] = $discount_data;
		}
		else
		{
			$this->flexi->cart_contents['settings']['discounts']['reward_vouchers'][$summary_discount_data['id']] = $discount_data;
		}
		
		return TRUE;
	}
	
	/**
	 * unset_discount_data
	 * Unsets an array of all discount data.
	 */
	private function unset_discount_data($discount_data)
	{
		return array(
			'item_price' => array(),
			'item_shipping' => array(),
			'item_summary_total' => array(),
			'shipping_total' => array(),
			'total' => array(),
			'reward_vouchers' => $discount_data['reward_vouchers']
		);
	}
	
	/**
	 * set_manual_discount
	 * Manually set a discount against a summary column total, discounting either a fixed rate or percentage off of the summary value.
	 * The valid discount array keys are 'id', 'description', 'value', 'column', 'calculation', 'tax_method' and 'void_reward_points'. 
	 * The valid discountable summary column names are 'item_summary_total', 'shipping_total' and 'total'.
	 * Reward points can also be disabled when a discount rate is set, if the discount is then removed, it is reactivated. 
	 */
	public function set_manual_discount($discount_data = FALSE)
	{
		if (is_array($discount_data) && ! empty($discount_data))
		{
			// Check that any submitted 'New value' discounts are only applied to the shipping total. 
			if (isset($discount_data['column']) && isset($discount_data['calculation']) && ($discount_data['column'] != 'shipping_total') && ($discount_data['calculation'] == 3))
			{
				return FALSE;
			}
			
			// Merge the code and manual discounts together, then loop through data and compile an array of all discount ids currently in use.
			$existing_discounts = array_merge($this->flexi->cart_contents['settings']['discounts']['manual'], $this->flexi->cart_contents['settings']['discounts']['codes']);
			$existing_ids = array();
				
			foreach($existing_discounts as $existing_discount)
			{
				$existing_ids[] = $existing_discount['id'];
			}
			
			// If an id is not set in the submitted '$discount_data', or if a discount with a matching id already exists, set a new id. 
			if (! isset($discount_data['id']) || in_array($discount_data['id'], $existing_ids))
			{
				$id = 0;
				while (in_array('manual_'.$id, $existing_ids))
				{
					$id++; 
				}
				$id = $discount_data['id'] = 'manual_'.$id;
			}
			else
			{
				$id = $discount_data['id'];
			}
		
			// Set default values if not submitted.
			$discount_data['description'] = (! isset($discount_data['description'])) ? FALSE : $discount_data['description'];
			$discount_data['value'] = (! isset($discount_data['value'])) ? 0 : $discount_data['value'];
			$discount_data['column'] = (! isset($discount_data['column'])) ? 'total' : $discount_data['column'];
			$discount_data['calculation'] = (! isset($discount_data['calculation'])) ? 1 : $discount_data['calculation'];
			$discount_data['tax_method'] = (! isset($discount_data['tax_method'])) ? FALSE : $discount_data['tax_method'];
			$discount_data['void_reward_points'] = (! isset($discount_data['void_reward_points'])) ? FALSE : $discount_data['void_reward_points'];
			
			// Set the cart column the discount is targeting and use the value to act as the discounts array key. 
			// This prevents multiple discounts being applied to the same cart column.
			$target_column = $discount_data['column'];
			
			// Loop through data and set to cart session summary.
			foreach($discount_data as $column => $column_value)
			{
				if ($column == 'value')
				{
					// If a valid discount value is not set, set the default value as zero. 
					$column_value = ($this->non_negative($column_value)) ? $this->format_calculation($column_value, 2, TRUE) : 0;
				}
				else if ($column == 'column')
				{
					// If a valid column is not set, discount the 'total' column by default. 
					$column_value = (in_array($column_value, array('item_summary_total', 'shipping_total', 'total'))) ? $column_value : 'total';
				}
				else if ($column == 'calculation') 
				{
					// If a valid calculation method is not set, a 'percentage' based calculation is set by default.
					// 1 = Percentage Based, 2 = Flat Fee, 3 = New Value.
					$column_value = (in_array($column_value, array(1,2,3))) ? $column_value : 1;
				}
				else if ($column == 'tax_method')
				{
					// If a valid tax method is not set, the tax method is defined by whether cart prices ex/include taxes by default.
					// 0 = Carts Default Tax Method, 1 = Apply Tax Before Discount, 2 = Apply Discount Before Tax, 3 = Apply Discount Before Tax, Add Original Tax.
					$column_value = (in_array($column_value, array(0, 1,2,3))) ? $column_value : 0;
				}
				else if ($column == 'void_reward_points')
				{
					$column_value = (bool)$column_value;
				}
				else if (! in_array($column, array('id', 'description')))
				{
					continue;
				}
				
				$this->flexi->cart_contents['settings']['discounts']['manual'][$target_column][$column] = $column_value;
			}
			
			return TRUE;
		}
		
		return FALSE;
	}

	/**
	 * update_discount_codes
	 * Updates discounts in the cart, removing any existing discounts that are not in the submitted data, and adding any valid new ones.
	 * The discount codes can be submitted as either a string, integer or an array with codes set as array values (not array keys).
	 * This function differs from 'set_discount_codes()' as it sets new codes AND also removes any codes from the cart that do not exist in the submitted data. 
	 */
	public function update_discount_codes($discount_codes = FALSE)
	{
		$unset_status = FALSE;
		
		// If there are existing discount codes, check they are still in the list of submitted discount codes.
		if (! empty($this->flexi->cart_contents['settings']['discounts']['codes']))
		{
			foreach($this->flexi->cart_contents['settings']['discounts']['codes'] as $code => $discount_data)
			{
				if (! in_array($code, $discount_codes))
				{
					unset($this->flexi->cart_contents['settings']['discounts']['codes'][$code]);
					
					$unset_status = TRUE;
				}
			}
		}
		
		// Run 'set_discount_codes()' function to validate submitted discount codes and add them to the cart session.
		if (! empty($discount_codes))
		{
			if ($this->set_discount_codes($discount_codes))
			{
				return 'discount_codes_set';
			}
		}
		// If discount codes were unset.
		else if ($unset_status)
		{
			return 'discount_codes_unset';
		}
		
		return FALSE;
	}
	
	/**
	 * set_discount_codes
	 * Applies discount codes to the cart discount data, whether they can be activated or not.
	 * The discount codes can be submitted as either a string, integer or an array with codes set as array values (not array keys).
	 * This function differs from 'update_discount_codes()' as it only sets new codes, it does not remove any codes from the cart that do not exist in the submitted data. 
	 */
	public function set_discount_codes($discount_codes = FALSE)
	{
		// Check the discount tables exist in the config file and are enabled.
		if (! $this->get_enabled_status('discounts', TRUE))
		{
			return FALSE;
		}
		
		// Validate discount codes are in database and are currently active.
		if (! $discount_data = $this->validate_discount_codes($discount_codes))
		{
			$this->set_error_message('discount_codes_invalid', 'config');
			return FALSE;
		}

		// Set alias of discount table.
		$tbl_cols_discount = $this->flexi->cart_database['discounts']['columns'];

		// Update cart session data with each valid discount.
		foreach($discount_data as $discount)
		{
			$this->flexi->cart_contents['settings']['discounts']['codes'][$discount[$tbl_cols_discount['code']]] = array(
				'id' => $discount[$tbl_cols_discount['id']],
				'code' => $discount[$tbl_cols_discount['code']],
				'description' => $discount[$tbl_cols_discount['description']]
			);
		}

		return TRUE;
	}
	
	/**
	 * unset_session_discount
	 * Remove discounts and reward vouchers by their id or discount code. 
	 * If no discount data is submitted, all manually set discounts and discount codes are removed.
	 */
	public function unset_session_discount($discount_data = FALSE)
	{
		// Loop through submitted discount data and remove each one.
		if ($discount_data !== FALSE)
		{
			foreach((array)$discount_data as $identifier)
			{
				// Ensure the discount is removed from any 'admin data' discounts that are present.
				unset($this->flexi->cart_contents['settings']['admin_data']['discounts']['active'][$identifier]);

				// Loop through all set discount codes and try to match either the code or the id.
				foreach($this->flexi->cart_contents['settings']['discounts']['codes'] as $code => $discount)
				{
					if ($identifier == $code || $identifier == $discount['id'])
					{
						unset($this->flexi->cart_contents['settings']['discounts']['codes'][$code]);
						unset($identifier);
						break;
					}
				}

				// Check if a manual discount exists with the same id.
				if (isset($identifier))
				{
					foreach($this->flexi->cart_contents['settings']['discounts']['manual'] as $column => $discount)
					{
						if ($identifier == $discount['id'])
						{
							unset($this->flexi->cart_contents['settings']['discounts']['manual'][$column]);
							unset($identifier);
							break;
						}
					}
				}

				// Check if a reward voucher exists with the same id.
				if (isset($identifier))
				{
					foreach($this->flexi->cart_contents['settings']['discounts']['reward_vouchers'] as $id => $voucher)
					{
						if ($identifier == $id || $identifier == $voucher['id'])
						{
							unset($this->flexi->cart_contents['settings']['discounts']['reward_vouchers'][$id]);
							unset($identifier);
							break;
						}
					}
				}
				
				// If no discount has been found, its assumed its an 'auto' discount that is automatically applied when a value in the cart exceeds 
				// the required quantity and value needed to activate a database discount.
				if (isset($identifier) && ! in_array($identifier, $this->flexi->cart_contents['settings']['discounts']['data']['excluded_discounts']))
				{
					$this->flexi->cart_contents['settings']['discounts']['data']['excluded_discounts'][$identifier] = $identifier;
				}
			}
		}
		// Remove all discount codes, manual discounts and reward vouchers if nothing is submitted.
		else
		{
			$this->flexi->cart_contents['settings']['discounts']['codes'] = array();
			$this->flexi->cart_contents['settings']['discounts']['manual'] = array();
			$this->flexi->cart_contents['settings']['discounts']['reward_vouchers'] = array();
			
			// Reset 'admin data' discounts if they are set.
			if (isset($this->flexi->cart_contents['settings']['admin_data']['discounts']['active']))
			{
				$this->flexi->cart_contents['settings']['admin_data']['discounts']['active'] = array();
			}
		}

		return TRUE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SURCHARGES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * set_surcharge
	 * Manually set a cart summary surcharge as either a fixed value or a percentage based on a cart summary column value.
	 * The data that can be set includes the surcharge value, surchargable column and a description.
	 * If applying a percentage based surcharge, a valid cart summary column name must be set. 
	 * Valid columns are 'item_summary_total', 'shipping_total' and 'total'. 
	 * The valid surcharge array keys are 'id', 'description', 'value', 'tax_rate' and 'column'. 
	 */
	public function set_surcharge($surcharge_data = FALSE)
	{
		if (is_array($surcharge_data) && ! empty($surcharge_data))
		{
			// If the surcharge data contains an id (array index), update the corresponding surcharge, else, add a new surcharge. 
			if (! isset($surcharge_data['id'])) 
			{
				$id = 0;
				while (array_key_exists('surcharge_'.$id, $this->flexi->cart_contents['settings']['surcharges']))
				{
					$id++; 
				} 
				$surcharge_data['id'] = $id = 'surcharge_'.$id;
			}
			else
			{
				$id = $surcharge_data['id'];
			}
			
			// Set default values if not submitted.
			$surcharge_data['description'] = (! isset($surcharge_data['description'])) ? FALSE : $surcharge_data['description'];
			$surcharge_data['value'] = (! isset($surcharge_data['value'])) ? 0 : $surcharge_data['value'];
			$surcharge_data['tax_rate'] = (! isset($surcharge_data['tax_rate'])) ? FALSE : $surcharge_data['tax_rate'];
			$surcharge_data['column'] = (! isset($surcharge_data['column'])) ? FALSE : $surcharge_data['column'];
			
			// Loop through data and set to cart session summary.
			foreach($surcharge_data as $column => $column_value)
			{
				if ($column == 'value')
				{
					// Change name of column to allow for monetary value to be returned from 'value', rather than a potential surcharge percentage. 
					$column = 'surcharge_value';
					
					$column_value = ($this->non_negative($column_value)) ? $this->format_calculation($column_value, 2, TRUE) : 0;
				}
				else if ($column == 'tax_rate')
				{
					$column_value = ($this->non_negative($column_value)) ? $this->format_calculation($column_value, 2, TRUE) : FALSE;
				}
				else if ($column == 'column')
				{
					$column_value = (in_array($column_value, array('item_summary_total', 'shipping_total', 'total'))) ? $column_value : FALSE;
				}
				else if (! in_array($column, array('id', 'description')))
				{
					continue;
				}
				
				$this->flexi->cart_contents['settings']['surcharges'][$id][$column] = $column_value;
			}

			// Set placeholder vars for surcharge data that is calculated when cart is updated.
			$this->flexi->cart_contents['settings']['surcharges'][$id]['value'] = 0;
			$this->flexi->cart_contents['settings']['surcharges'][$id]['tax_value'] = 0;
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	/**
	 * unset_session_surcharge
	 * Remove surcharges by their id. 
	 * If no surcharge data is submitted, all manually set surcharges are removed.
	 */
	public function unset_session_surcharge($surcharge_data = FALSE)
	{
		$unset_status = FALSE;
	
		// Loop through submitted surcharge data and remove each one.
		if ($surcharge_data !== FALSE)
		{
			foreach((array)$surcharge_data as $id)
			{
				if (isset($this->flexi->cart_contents['settings']['surcharges'][$id]))
				{
					unset($this->flexi->cart_contents['settings']['surcharges'][$id]);
					$unset_status = TRUE;
				}
			}
		}
		// Else, remove all surcharges.
		else if (! empty($this->flexi->cart_contents['settings']['surcharges']))
		{
			$this->flexi->cart_contents['settings']['surcharges'] = array();
			$unset_status = TRUE;
		}
		
		return $unset_status;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CURRENCY
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * update_currency
	 * Sets global cart currency and exchange rates between default currency and newly set currency.
	 * Either the currency ID or exact Name can be passed to filter currency.
	 */
	public function update_currency($currency_identifier = FALSE)
	{
		// Check the currency table exists in the config file and is enabled.
		if ($this->get_enabled_status('currency'))
		{
			$currency_data = $this->get_database_currency_data($currency_identifier);
		}
			
		// If no currency data has been set by the database lookup, get default values set via config file.
		if (empty($currency_data))
		{
			$currency_data = array(
				'name' => (! empty($this->flexi->cart_defaults['currency']['name'])) ? 
					$this->flexi->cart_defaults['currency']['name'] : 'Currency',
				'exchange_rate' => (! empty($this->flexi->cart_defaults['currency']['exchange_rate'])) ? 
					$this->flexi->cart_defaults['currency']['exchange_rate'] : 1,
				'symbol' => (! empty($this->flexi->cart_defaults['currency']['symbol'])) ? 
					$this->flexi->cart_defaults['currency']['symbol'] : '&curren;',
				'symbol_suffix' => (! empty($this->flexi->cart_defaults['currency']['symbol_suffix'])) ? 
					$this->flexi->cart_defaults['currency']['symbol_suffix'] : FALSE,
				'thousand_separator' => (! empty($this->flexi->cart_defaults['currency']['thousand_separator'])) ? 
					$this->flexi->cart_defaults['currency']['thousand_separator'] : ',',
				'decimal_separator' => (! empty($this->flexi->cart_defaults['currency']['decimal_separator'])) ? 
					$this->flexi->cart_defaults['currency']['decimal_separator'] : '.',
			);
		}
		
		### Currency data is now set, even if its a default value.
		
		// Set currency data to cart session settings.
		$this->flexi->cart_contents['settings']['currency']['name'] = $currency_data['name'];
		$this->flexi->cart_contents['settings']['currency']['exchange_rate'] = $currency_data['exchange_rate'];
		$this->flexi->cart_contents['settings']['currency']['symbol'] = $currency_data['symbol'];
		$this->flexi->cart_contents['settings']['currency']['symbol_suffix'] = (bool)$currency_data['symbol_suffix'];
		$this->flexi->cart_contents['settings']['currency']['thousand_separator'] = $currency_data['thousand_separator'];
		$this->flexi->cart_contents['settings']['currency']['decimal_separator'] = $currency_data['decimal_separator'];

		// If the carts internal default currency settings have not been set (On cart session being initially set).
		if (! isset($this->flexi->cart_contents['settings']['currency']['default']))
		{
			$this->flexi->cart_contents['settings']['currency']['default'] = $this->flexi->cart_contents['settings']['currency'];
			unset($this->flexi->cart_contents['settings']['currency']['default']['exchange_rate']);
		}
		
		return TRUE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_database_currency_data
	 * Looks-up the database for currency details that match the submitted currency id or name.
	 */
	public function get_database_currency_data($currency_identifier = FALSE)
	{
		// Check the currency table exists in the config file and is enabled.
		if ($this->get_enabled_status('currency'))
		{
			// Set aliases of item shipping table data.
			$tbl_currency = $this->flexi->cart_database['currency'];
			$tbl_cols_currency = $this->flexi->cart_database['currency']['columns'];

			// Currency by id.
			if (is_numeric($currency_identifier))
			{
				$sql_where = array($tbl_cols_currency['id'] => $currency_identifier);
			}
			// Currency by name.
			else if (is_string($currency_identifier))
			{
				$sql_where = array($tbl_cols_currency['name'] => $currency_identifier);
			}
			// Default database currency.
			else if ($tbl_currency['default'])
			{
				$sql_where = array($tbl_currency['default'] => 1);
			}
			else
			{
				return FALSE;
			}
			
			$sql_select = array(
				$tbl_cols_currency['name'].' AS name',
				$tbl_cols_currency['exchange_rate'].' AS exchange_rate', 
				$tbl_cols_currency['symbol'].' AS symbol',
				$tbl_cols_currency['symbol_suffix'].' AS symbol_suffix',
				$tbl_cols_currency['thousand_separator'].' AS thousand_separator',
				$tbl_cols_currency['decimal_separator'].' AS decimal_separator'
			);
			
			$query = $this->db->select($sql_select)
				->from($tbl_currency['table'])
				->where($sql_where)
				->limit(1)
				->get();
				
			return ($query->num_rows() == 1) ? $query->row_array() : FALSE;
		}
		
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * set_manual_currency
	 * Manually set the cart currency.
	 * Valid currency array keys are 'name', 'exchange_rate', 'symbol', 'symbol_suffix', 'thousand_separator' and 'decimal_separator'. 
	 */
	public function set_manual_currency($currency_data = FALSE)
	{
		if (is_array($currency_data) && ! empty($currency_data))
		{
			// Loop through data and set to cart session summary 
			foreach($currency_data as $column => $column_value)
			{
				if ($column == 'exchange_rate')
				{
					// Check currency is a postive number
					$this->flexi->cart_contents['settings']['currency']['exchange_rate'] = ($column_value >= 0) ? 
						$this->format_calculation($column_value, 2, TRUE) : 0;
				}
				else if (isset($this->flexi->cart_contents['settings']['currency'][$column]))
				{
					$this->flexi->cart_contents['settings']['currency'][$column] = $column_value;
				}
			}
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART SETTINGS / DEFAULTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * set_minimum_order
	 * Sets the carts minimum order value.
	 */
	public function set_minimum_order($value = FALSE)
	{
		// If value is invalid.
		if (! $this->non_negative($value))
		{
			// Look-up database value.
			if ($config_data = $this->get_database_config_data('minimum_order'))
			{
				$value = $config_data[$this->flexi->cart_database['configuration']['columns']['minimum_order']];
			}
			// Look-up config file value.
			else
			{
				$value = $this->flexi->cart_defaults['configuration']['minimum_order'];
			}
		}

		$this->flexi->cart_contents['settings']['configuration']['minimum_order'] = $this->format_calculation($value, 2, TRUE);
		
		return TRUE;
	}

	/**
	 * set_reward_point_multiplier
	 * Sets the carts reward point multiplier.
	 * Example: A multiplier of 10 is (10 x $1.00) = 10 reward points, so every $1.00 is worth 10 reward points.
	 */
	public function set_reward_point_multiplier($value = FALSE)
	{		
		if (empty($value) || $value < 0)
		{
			// Look-up database value.
			if ($config_data = $this->get_database_config_data('reward_point_multiplier'))
			{
				$value = $config_data[$this->flexi->cart_database['configuration']['columns']['reward_point_multiplier']];
			}
			// Look-up config file value.
			else
			{
				$value = $this->flexi->cart_defaults['configuration']['reward_point_multiplier'];
			}
		}

		$this->flexi->cart_contents['settings']['configuration']['reward_point_multiplier'] = $this->format_calculation($value, 4, TRUE);
		
		return TRUE;
	}
	
	/**
	 * set_manual_config_setting
	 * Sets a submitted config setting to the carts session data. If no setting status is submitted, the current cart session value is toggled.
	 */
	public function set_manual_config_setting($setting_name = FALSE, $setting_status = NULL)
	{
		// If no status has been submitted, toggle the current setting.
		if ($setting_status === NULL)
		{
			$setting_status = ($this->flexi->cart_contents['settings']['configuration'][$setting_name]) ? FALSE : TRUE;
		}

		$this->flexi->cart_contents['settings']['configuration'][$setting_name] = (bool)$setting_status;

		return TRUE;		
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * set_config_settings
	 * Sets cart configuration settings into cart session.
	 */
	public function set_config_settings()
	{	
		// Check the config table exists in the config file and is enabled.
		if ($this->get_enabled_status('config'))
		{
			if ($config_data = $this->get_database_config_data())
			{
				// Loop through all the returned defaults and convert the database column names to cart session names.
				foreach($this->flexi->cart_database['configuration']['columns'] as $column_name => $column_alias)
				{
					if (isset($config_data[$column_alias]))
					{
						$config_data[$column_name] = $config_data[$column_alias];
						unset($config_data[$column_alias]);
					}
				}
			}
		}

		// Config file hard-coded settings.
		$config_defaults = $this->flexi->cart_defaults['configuration'];

		// Loop through the config hard-coded default settings and apply them to any config settings without a value from the database lookup.
		foreach($config_defaults as $setting_name => $setting_value)
		{
			if (! isset($config_data[$setting_name]))
			{
				$config_data[$setting_name] = $config_defaults[$setting_name];
			}
		}
		
		// Group non boolean config value types together.
		$non_boolean_columns = array('order_number_prefix', 'order_number_suffix', 'weight_type', 'minimum_order', 'reward_point_multiplier', 'reward_voucher_multiplier', 
			'reward_point_to_voucher_ratio', 'reward_point_days_pending', 'reward_point_days_valid', 'reward_voucher_days_valid', 'quantity_decimals', 'weight_decimals');
		
		// Ensure the data is stored in the correct format type.
		foreach($config_data as $column => $value)
		{
			// Ensure non boolean values are stored as their entered value.
			if (in_array($column, $non_boolean_columns))
			{
				$config_data[$column] = (string)$config_data[$column];
			}
			// All others are saved as boolean.
			else
			{
				$config_data[$column] = (bool)$config_data[$column];
			}
		}
		
		// Set configuration data to cart session settings.
		$this->flexi->cart_contents['settings']['configuration'] = $config_data;

		// Set an empty cart id and order number placeholder.
		$this->flexi->cart_contents['settings']['configuration']['cart_data_id'] = FALSE;
		$this->flexi->cart_contents['settings']['configuration']['order_number'] = FALSE;
		
		return TRUE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_database_config_data
	 * Looks-up the database for site configuration settings.
	 */
	public function get_database_config_data($specific_columns = FALSE)
	{
		// Check the config table exists in the config file and is enabled.
		if ($this->get_enabled_status('config'))
		{
			// Set aliases of item shipping table data.
			$tbl_config = $this->flexi->cart_database['configuration'];
			$config_names = ($specific_columns) ? (array)$specific_columns : $this->flexi->cart_database['configuration']['columns'];

			$sql_select = array();
			foreach($config_names as $column_name)
			{
				if ($specific_columns && isset($this->flexi->cart_database['configuration']['columns'][$column_name]))
				{
					$sql_select[] = $this->flexi->cart_database['configuration']['columns'][$column_name];
				}
				else if ($column_name)
				{
					$sql_select[] = $column_name;
				}
			}
			
			$query = $this->db->select($sql_select)
				->from($tbl_config['table'])
				->limit(1)
				->get();
				
			return ($query->num_rows() == 1) ? $query->row_array() : FALSE;
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * set_cart_defaults
	 * Looks-up the config file and any enabled database lookup tables and sets default cart values.
	 */
	public function set_cart_defaults()
	{
		// Set item data placeholder.
		$this->flexi->cart_contents['items'] = array();

		// Set summary data placeholders.
		$this->set_summary_defaults();
		
		// Set currency data.
		$this->update_currency();

		// Set shipping data.
		$this->set_shipping_data();

		// Set shipping location
		$this->update_location(FALSE, 'shipping');
		
		// Update shipping data using newly set shipping location.
		$this->update_shipping(FALSE, $this->flexi->cart_contents['settings']['shipping']['location']);
		
		// Set cart tax data.
		$this->set_tax_data();

		// Set tax location.
		$this->update_location(FALSE, 'tax');
		
		// Update tax data using newly set tax location.
		$this->update_tax($this->flexi->cart_contents['settings']['tax']['location'], TRUE);
		
		// Set discount data placeholders.
		$this->set_discount_defaults();
		
		// Set surcharge data placeholders.
		$this->flexi->cart_contents['settings']['surcharges'] = array();
		
		// Set cart configuration settings.
		$this->set_config_settings();
		
		// Update cart session.
		$this->session->set_userdata(array($this->flexi->cart['name'] => $this->flexi->cart_contents));
		
		return $this->flexi->cart_contents;
	}
	
	/**
	 * set_summary_defaults
	 * Sets default values for the cart summary columns.
	 */
	public function set_summary_defaults()
	{
		$this->flexi->cart_contents['summary'] = array(			
			// Quantity, weight, reward point totals.
			'total_rows' => 0,
			'total_items' => 0,
			'total_weight' => 0,
			'total_reward_points' => 0,

			// Price totals .
			'item_summary_total' => 0,
			'shipping_total' => 0,
			'tax_total' => 0,
			'surcharge_total' => 0,
			'total' => 0
		);
		
		return TRUE;
	}
	
	/**
	 * set_discount_defaults
	 * Sets default values for the carts discount data.
	 */
	public function set_discount_defaults()
	{
		// Set array placeholders.
		if (! isset($this->flexi->cart_contents['settings']['discounts']['codes']))
		{
			$this->flexi->cart_contents['settings']['discounts']['codes'] = array();
		}
		if (! isset($this->flexi->cart_contents['settings']['discounts']['manual']))
		{
			$this->flexi->cart_contents['settings']['discounts']['manual'] = array();
		}	
	
		// Reset other discount data.
		$this->flexi->cart_contents['settings']['discounts']['active_items'] = array();
		$this->flexi->cart_contents['settings']['discounts']['active_summary'] = array();
		$this->flexi->cart_contents['settings']['discounts']['reward_vouchers'] = array();
		$this->flexi->cart_contents['settings']['discounts']['data']['item_discount_savings'] = 0;
		$this->flexi->cart_contents['settings']['discounts']['data']['summary_discount_savings'] = 0;
		$this->flexi->cart_contents['settings']['discounts']['data']['reward_vouchers'] = 0;
		$this->flexi->cart_contents['settings']['discounts']['data']['void_reward_point_items'] = array();

		if (! isset($this->flexi->cart_contents['settings']['discounts']['data']['excluded_discounts']))
		{
			$this->flexi->cart_contents['settings']['discounts']['data']['excluded_discounts'] = array();
		}	
		
		return TRUE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * required_columns
	 * Returns an array of all the required cart columns, including user defined custom columns.
	 */
	public function required_columns()
	{
		// Set default required cart items columns.
		$required_columns = array(
			$this->flexi->cart_columns['item_id'],
			$this->flexi->cart_columns['item_quantity'],
			$this->flexi->cart_columns['item_price'],
			$this->flexi->cart_columns['item_name']
		);
		
		// Merge additional required user defined cart columns if set via config file.
		if (is_array($this->flexi->cart['items']['custom_columns']) && ! empty($this->flexi->cart['items']['custom_columns']))
		{
			$user_required_columns = array();
			foreach($this->flexi->cart['items']['custom_columns'] as $column)
			{
				if ($column['required'])
				{
					$user_required_columns[] = $column['name'];
				}
			}
			
			if (! empty($user_required_columns))
			{
				$required_columns = array_merge($required_columns, $user_required_columns);
			}
		}
	
		return $required_columns;
	}
}

/* End of file flexi_cart_model.php */
/* Location: ./application/models/flexi_cart_model.php */
