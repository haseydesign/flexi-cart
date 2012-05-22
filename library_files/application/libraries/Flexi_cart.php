<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: flexi cart standard library
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

// Load the flexi cart Lite library to allow it to be extended.
load_class('Flexi_cart_lite', 'libraries', FALSE);

class Flexi_cart extends Flexi_cart_lite
{
	public function __construct()
	{
		parent::__construct();
		
		$this->CI->load->model('flexi_cart_model');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART CRUD FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * insert_items
	 * Inserts an item or multiple items to the cart.
	 * If the inserted item already exists in the cart, the submitted data can be set to overwrite existing item data by submitting '$update_existing_items = TRUE'.
	 */
	public function insert_items($item_data = FALSE, $update_existing_items = FALSE)
	{
		if (! is_array($item_data) || empty($item_data))
		{
			$this->CI->flexi_cart_model->set_error_message('invalid_data', 'config');
			return FALSE;
		}
		
		$recalculate_cart = FALSE;
		
		// If the item id is found, only one item has been submitted.
		if (isset($item_data[$this->CI->flexi->cart_columns['item_id']]))
		{
			$recalculate_cart = ($this->CI->flexi_cart_model->insert_item($item_data, $update_existing_items)) ? TRUE : $recalculate_cart;
		}
		// Else, multiple items have been submitted.
		else
		{
			// Loop through cart and update each item.
			foreach($item_data as $column => $value)
			{
				if (is_array($value) && isset($value[$this->CI->flexi->cart_columns['item_id']]))
				{
					$recalculate_cart = ($this->CI->flexi_cart_model->insert_item($value, $update_existing_items)) ? TRUE : $recalculate_cart;

					// If an error message has been set, stop any further loops.
					if ($this->CI->flexi_cart_model->error_messages())
					{
						break;
					}
				}
			}
		}
		
		###++++++++++++++++++++++++++++###

		// Recalculate cart totals if the insert was successful.
		if ($this->update_cart_session('items_added_successfully', $recalculate_cart, TRUE))
		{
			return TRUE;
		}

		$this->CI->flexi_cart_model->set_error_message('no_items_added', 'config');
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * update_cart
	 * Updates cart with submitted item and settings data.
	 * By submitting summary data it is possible to update the shipping, tax, discount, surcharge and currency rates as well as location details.
	 * '$force_column_update = TRUE' will update all submitted data regardless of whether it is defined as an updatable column.
	 * '$force_recalculate = TRUE' will force all cart totals to be recalculated once the function is finished, regardless of whether it has determined to do so or not. 
	 */
	public function update_cart($item_data = FALSE, $settings_data = FALSE, $force_column_update = FALSE, $force_recalculate = FALSE)
	{
		if (! $force_recalculate && empty($item_data))
		{
			$this->CI->flexi_cart_model->set_error_message('invalid_data', 'config');
			return FALSE;
		}

		$recalculate_cart = $force_recalculate;

		if (is_array($item_data) && ! empty($item_data))
		{
			// If the item id is found, only one item is being updated.
			if (isset($item_data[$this->CI->flexi->cart_columns['row_id']]))
			{
				$recalculate_cart = ($this->CI->flexi_cart_model->update_item($item_data, $force_column_update)) ? TRUE : $recalculate_cart;
			}
			// Else, multiple items are being updated.
			else
			{
				// Loop through cart and update each item.
				foreach($item_data as $key => $value)
				{
					if (is_array($value) && isset($value[$this->CI->flexi->cart_columns['row_id']]))
					{
						$recalculate_cart = ($this->CI->flexi_cart_model->update_item($value, $force_column_update)) ? TRUE : $recalculate_cart;

						// If an error message has been set, stop any further loops.
						if ($this->CI->flexi_cart_model->error_messages())
						{
							break;
						}
					}			
				}
			}
		}

		###++++++++++++++++++++++++++++###
	
		if (! empty($settings_data) && is_array($settings_data))
		{
			// Update shipping location.
			// If the shipping location is updated, and database shipping rate table is enabled, the current shipping option will automatically be
			// set to an option available to that location, if the existing option is still available to that location, it will be used by default. 
			if (isset($settings_data['update_shipping_location']) && ! isset($settings_data['update_shipping']))
			{
				$recalculate_cart = ($this->update_shipping_location($settings_data['update_shipping_location'], FALSE)) ? TRUE : $recalculate_cart;
			}
			
			// Update shipping data.
			// By submitting just a shipping id, a database lookup will query the shipping rate table for rates that match the carts total value and weight. 
			if (isset($settings_data['update_shipping']))
			{
				// If shipping location has also been submitted, update it via the 'update_shipping()' function rather than 'update_shipping_location()' function above.
				// This saves the available shipping options being queried twice.
				$shipping_location_data = (isset($settings_data['update_shipping_location'])) ? $settings_data['update_shipping_location'] : FALSE;
				
				$recalculate_cart = ($this->update_shipping($settings_data['update_shipping'], $shipping_location_data, FALSE)) ? TRUE : $recalculate_cart;
			}
	
			// Sets / updates a manually set shipping option.
			// The shipping id, value, tax rate, name and description can all be manually set, this is not typically required the database shipping rate table is enabled.
			// The valid shipping array keys are 'id', 'value', 'tax_rate', 'name' and 'description'. 
			// Note: All submitted shipping rates must be based on the sites default currency and NOT the currency the user has specified to view pricing.
			if (isset($settings_data['set_shipping']))
			{
				$recalculate_cart = ($this->set_shipping($settings_data['set_shipping'], FALSE)) ? TRUE : $recalculate_cart;
			}
			
			// Update tax location.
			// If the tax location is updated, the tax rate and name will automatically be updated provided that the database tax rate table is enabled.
			if (isset($settings_data['update_tax_location']))
			{
				$recalculate_cart = ($this->update_tax_location($settings_data['update_tax_location'], TRUE, FALSE)) ? TRUE : $recalculate_cart;
			}
			
			// Sets / updates a manually set tax rate.
			// The tax rate and name can all be manually updated, this is not typically required if the database tax rate table is enabled.
			// The valid tax array keys are 'rate', and 'name'. 
			if (isset($settings_data['set_tax']))
			{
				$recalculate_cart = ($this->set_tax($settings_data['set_tax'], FALSE)) ? TRUE : $recalculate_cart;
			}

			// Update discount codes.
			// Submitted codes that are not in the current cart session will be added to the session.
			// Codes in the cart session that are not in the submitted data will be removed from the session. All discount totals will be recalculated.
			if (isset($settings_data['update_discount_codes']))
			{
				$recalculate_cart = ($this->update_discount_codes($settings_data['update_discount_codes'], FALSE)) ? TRUE : $recalculate_cart;
			}
			
			// Sets / updates a manually set discount.
			// If an existing discounts array index is submitted with the array key 'id', that specific discount will be updated, else, a new discount will be added.
			// The discount description, value, discount column, calculation method, tax method and void reward point settings can all be manually updated.
			// The valid discount array keys are 'id', 'description', 'value', 'column', 'calculation', 'tax_method' and 'void_reward_points'.
			if (isset($settings_data['set_discount']))
			{
				$recalculate_cart = ($this->set_discount($settings_data['set_discount'], FALSE)) ? TRUE : $recalculate_cart; 
			}

			// Sets / updates a manually set surcharge.
			// If an existing surcharge array index is submitted with the array key 'id', that specific surcharge will be updated, else, a new surcharge will be added.
			// The surcharge description, value, surchargable column and tax rate can all be manually updated.
			// The valid surcharge array keys are 'id', 'description', 'value', 'tax_rate' and 'column'.
			if (isset($settings_data['set_surcharge']))
			{
				$recalculate_cart = ($this->set_surcharge($settings_data['set_surcharge'], FALSE)) ? TRUE : $recalculate_cart;				
			}

			// Update currency data.
			// Updates the carts currency by submitting just a currency id or name. 
			if (isset($settings_data['update_currency']))
			{
				$this->set_currency($settings_data['update_currency']);				
			}

			// Sets / updates manually set currency data.
			// The currency name (i.e. USD, GBP), symbol (i.e. £) and the exchange rate can all be manually updated.
			// This is not typically required if the database currency table is enabled.
			// The valid currency array keys are 'name', 'exchange_rate', 'symbol', 'symbol_suffix', 'thousand_separator' and 'decimal_separator'. 
			if (isset($settings_data['set_currency']))
			{
				$this->set_currency($settings_data['set_currency']);				
			}
		}
			
		###++++++++++++++++++++++++++++###

		// Recalculate cart totals if the update was successful
		if ($this->update_cart_session('items_updated_successfully', $recalculate_cart, TRUE))
		{
			return TRUE;
		}
		
		$this->CI->flexi_cart_model->set_error_message('no_items_updated', 'config');
		return FALSE;
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * delete_items
	 * deletes items from cart using an array of item row ids.
	 */	
	public function delete_items($row_ids = FALSE)
	{
		if (empty($row_ids))
		{
			$this->CI->flexi_cart_model->set_error_message('invalid_data', 'config');
			return FALSE;
		}
		
		if (!is_array($row_ids))
		{
			unset($this->CI->flexi->cart_contents['items'][$row_ids]);
		}
		else
		{
			foreach($row_ids as $row_id)
			{
				unset($this->CI->flexi->cart_contents['items'][$row_id]);
			}
		}
		
		return $this->update_cart_session('items_deleted_successfully', TRUE, FALSE);
	}
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOCATIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_shipping_location_query
	 * Returns all active shipping locations that are of a specific location type and are the child locations of any higher tier set locations.
	 * For example, if a specific country has been set as the current shipping location, and this function was called to return all states, 
	 * ('$location_type_id = 1' using default demo values) only the states of that country would be returned.
	 */
	public function get_shipping_location_query($sql_select = FALSE, $location_type_id = 0)
	{
		return $this->CI->flexi_cart_model->get_location_query($sql_select, $location_type_id, 'shipping_location_id');
	}
	
	/**
	 * get_tax_location_query
	 * Returns all active tax locations that are of a specific location type and are the child locations of any higher tier set locations.
	 * For example, if a specific country has been set as the current tax location, and this function was called to return all states, 
	 * ('$location_type_id = 1' using default demo values) only the states of that country would be returned.
	 */
	public function get_tax_location_query($sql_select = FALSE, $location_type_id = 0)
	{
		return $this->CI->flexi_cart_model->get_location_query($sql_select, $location_type_id, 'tax_location_id');
	}
	
	/**
	 * update_shipping_location
	 * Updates the carts shipping location.
	 * The location can then be used to calculate shipping rates for specific locations and zones.
	 *
	 * Locations can be posted as either location ids or names from the location database table.
	 * Note: If submitting location names, the name must be indentical to the table name, 
	 * using pre-defined html form elements (i.e. select, radio etc) will help enforce this.
	 */
	public function update_shipping_location($locations = FALSE, $update_shipping = TRUE, $recalculate_cart = TRUE)
	{
		// Check the location tables exist in the config file and are enabled.
		if (! $this->CI->flexi_cart_model->get_enabled_status('location', TRUE))
		{
			return FALSE;
		}

		// Compares submitted locations with database and then returns a cart formatted array of database location data.
		if ($shipping_location = $this->CI->flexi_cart_model->get_database_location_data($locations, 'shipping'))
		{
			// If returned shipping location is different from cart session.
			if ($shipping_location != $this->shipping_location_data())
			{
				// Update cart session data.
				$this->CI->flexi->cart_contents['settings']['shipping']['location'] = $shipping_location;
				
				// Check whether the carts shipping option should be updated.
				if ($update_shipping)
				{
					$this->update_shipping($this->shipping_id(), FALSE, $recalculate_cart);
				}
				
				if ($this->update_cart_session('shipping_location_updated_successfully', FALSE, FALSE))
				{
					return TRUE;
				}
			}
		}
		
		$this->CI->flexi_cart_model->set_status_message('shipping_location_update_unsuccessful', 'config');
		return FALSE;
	}
	
	/**
	 * update_tax_location
	 * Updates the carts tax location.
	 * The location can then be used to calculate tax rates for specific locations and zones.
	 *
	 * Locations can be posted as either location ids or names from the location database table.
	 * Note: If submitting location names, the name must be indentical to the table name, 
	 * using pre-defined html form elements (i.e. select, radio etc) will help enforce this.
	 */
	public function update_tax_location($locations = FALSE, $update_tax = TRUE, $recalculate_cart = TRUE)
	{
		// Check the location tables exist in the config file and are enabled.
		if (! $this->CI->flexi_cart_model->get_enabled_status('location', TRUE))
		{
			return FALSE;
		}
		
		// Compares submitted locations with database and then returns a cart formatted array of database location data.
		if ($tax_location = $this->CI->flexi_cart_model->get_database_location_data($locations, 'tax'))
		{
			// If returned tax location is different from cart session.
			if ($tax_location != $this->tax_location_data())
			{
				// Update cart session data.
				$this->CI->flexi->cart_contents['settings']['tax']['location'] = $tax_location;
			
				// Check whether the carts tax rate should be updated.
				if ($update_tax)
				{
					$this->update_tax($recalculate_cart);
				}
				
				if ($this->update_cart_session('tax_location_updated_successfully', FALSE, FALSE))
				{
					return TRUE;
				}
			}
		}

		$this->CI->flexi_cart_model->set_status_message('tax_location_update_unsuccessful', 'config');
		return FALSE;
	}
	
	/**
	 * update_location
	 * Updates the carts shipping and tax data to the same location.
	 */
	public function update_location($locations = FALSE, $update_dependents = TRUE, $recalculate_cart = TRUE)
	{
		// Check the location tables exist in the config file and are enabled.
		if (! $this->CI->flexi_cart_model->get_enabled_status('location', TRUE))
		{
			return FALSE;
		}

		// Update shipping location.
		$shipping_result = $this->update_shipping_location($locations, $update_dependents, $recalculate_cart);
		
		// Update tax location.
		$tax_result = $this->update_tax_location($locations, $update_dependents, $recalculate_cart);
		
		return ($shipping_result || $tax_location);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SHIPPING
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * update_shipping
	 * Looks-up the shipping database table and tries to match shipping rate options with the current shipping id and shipping location.
	 * This function is intended to receive a shipping rate table id, which may be posted by a html form element (i.e. select, radio etc.)
	 * The shipping value and weight are checked to match the shipping rates available for the posted shipping id.
	 * Additionally, the shipping location can also be updated by submitting the location data.
	 */
	public function update_shipping($shipping_id = FALSE, $location = FALSE, $recalculate_cart = TRUE)
	{
		// Check the shipping tables exist in the config file and are enabled.
		if (! $this->CI->flexi_cart_model->get_enabled_status('shipping', TRUE))
		{
			return FALSE;
		}
		
		// Update shipping id if submitted to function, else get the current shipping id.
		$shipping_id = ($this->CI->flexi_cart_model->non_negative($shipping_id)) ? $shipping_id : $this->shipping_id();
		
		// If location data has been submitted, update it before updating the shipping option.
		if (! empty($location))
		{
			$this->update_shipping_location($location, FALSE, FALSE);
		}
		
		// Get the location data as a correctly formatted array.
		$location = $this->shipping_location_data();
		
		// Update shipping, if successful, recalculate cart totals
		if ($this->CI->flexi_cart_model->update_shipping($shipping_id, $location))
		{
			if ($this->update_cart_session('shipping_updated_successfully', $recalculate_cart, FALSE))
			{
				return TRUE;
			}
		}

		$this->CI->flexi_cart_model->set_error_message('shipping_update_unsuccessful', 'config');
		return FALSE;
	}

	/**
	 * set_shipping
	 * Manually set shipping data without querying a database table.
	 * The data that can be set includes the shipping id, value, tax rate, name and description.
	 * The valid shipping array keys are 'id', 'value', 'tax_rate' 'name' and 'description'. 
	 */
	public function set_shipping($shipping_data = FALSE, $recalculate_cart = TRUE)
	{
		if ($this->CI->flexi_cart_model->set_manual_shipping($shipping_data))
		{
			if ($this->update_cart_session('shipping_updated_successfully', $recalculate_cart, FALSE))
			{
				return TRUE;
			}
		}
		
		$this->CI->flexi_cart_model->set_error_message('shipping_update_unsuccessful', 'config');		
		return FALSE;
	}
	
	/**
	 * get_shipping_options
	 * Looks-up the shipping option and shipping rate tables and returns a list of available shipping options.
	 * The data is filtered so that only options available to the current shipping location, and that match the current cart value and weight are returned.
	 * The returned options can then typically be used to populate a html form element (i.e. select, radio etc).
	 */
	public function get_shipping_options()
	{
		// Check the shipping tables exist in the config file and are enabled.
		if (! $this->CI->flexi_cart_model->get_enabled_status('shipping', TRUE))
		{
			return FALSE;
		}

		// Get shipping option data and rename database columns.
		$shipping_options = $this->CI->flexi_cart_model->shipping_options($this->shipping_location_data());
		
		$shipping_options = $this->CI->flexi_cart_model->rename_shipping_columns($shipping_options);
		
		return $shipping_options;
	}
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TAX
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * update_tax
	 * Updates the carts tax rate to match the current tax location. 
	 * This function would not typically need to be called as the tax rate can be set when updating the tax location via the 'update_tax_location()' function.
	 */
	public function update_tax($recalculate_cart = TRUE)
	{
		// Check the tax table exists in the config file and is enabled.
		if (! $this->CI->flexi_cart_model->get_enabled_status('tax', TRUE))
		{
			return FALSE;
		}

		// Get the location data as a correctly formatted array.
		$location = $this->tax_location_data();
	
		// Update tax, if successful, recalculate cart totals.
		if ($this->CI->flexi_cart_model->update_tax($location))
		{
			if ($this->update_cart_session('tax_updated_successfully', $recalculate_cart, FALSE))
			{
				return TRUE;
			}
		}
		
		$this->CI->flexi_cart_model->set_error_message('tax_update_unsuccessful', 'config');
		return FALSE;
	}

	/**
	 * set_tax
	 * Manually sets tax data without querying a database table.
	 * The data that can be set is the tax rate and name.
	 * The valid tax array keys are 'rate', and 'name'. 
	 */
	public function set_tax($tax_data = FALSE, $recalculate_cart = TRUE)
	{
		if ($this->CI->flexi_cart_model->set_manual_tax($tax_data))
		{
			if ($this->update_cart_session('tax_updated_successfully', $recalculate_cart, FALSE))
			{
				return TRUE;
			}
		}

		$this->CI->flexi_cart_model->set_error_message('tax_update_unsuccessful', 'config');
		return FALSE;
	}

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * set_discount
	 * Manually set a discount against a summary column total, discounting either a fixed rate or percentage off of the summary value.
	 *
	 * Valid discount array keys are 'id', 'description', 'value', 'column', 'calculation', 'tax_method' and 'void_reward_points'. 
	 * Valid discountable summary 'column' names are 'item_summary_total', 'shipping_total' and 'total'.
	 * Valid 'calculation' array keys are '1' = Percentage rate discount, method '2' = Flat rate discount, method '3' = New value discount.
	 * Valid 'tax_method' array keys are 
	 *		'0' or FALSE = Carts Default Tax Method, '1' = Apply Tax Before Discount, '2' = Apply Discount Before Tax, '3' = Apply Discount Before Tax, Add Original Tax.
	 * Reward points can also be disabled when a discount rate is set, if the discount is then removed, it is reactivated. 
	 *
	 * By default a '0%' discount is applied to the 'total' column, and is taxed accordingly to the carts current tax settings, with reward points not voided.
	 * Therefore, it is only necessary to submit array keys for the values that need to be changed from the default settings.
	 */
	public function set_discount($discount_data = FALSE, $recalculate_cart = TRUE)
	{
		if ($this->CI->flexi_cart_model->set_manual_discount($discount_data))
		{
			if ($this->update_cart_session('discounts_updated_successfully', $recalculate_cart, FALSE))
			{
				return TRUE;
			}
		}

		$this->CI->flexi_cart_model->set_error_message('discount_update_unsuccessful', 'config');
		return FALSE;
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * set_discount_codes
	 * Applies discount codes to the cart discount data, whether they can be activated or not.
	 * The discount codes can be submitted as either a string, integer or an array with codes set as array values (not array keys).
	 * This function differs from 'update_discount_codes()' as it only sets new codes, it does not remove any codes from the cart that do not exist in the submitted data. 
	 */
	public function set_discount_codes($discount_codes = FALSE, $recalculate_cart = TRUE)
	{
		if ($this->CI->flexi_cart_model->set_discount_codes($discount_codes))
		{
			return $this->update_cart_session('discount_codes_valid', $recalculate_cart, FALSE);
		}
		
		return FALSE;
	}

	/**
	 * update_discount_codes
	 * Updates discounts in the cart, removing any existing discounts that are not in the submitted data, and adding any valid new ones.
	 * The discount codes can be submitted as either a string, integer or an array with codes set as array values (not array keys).
	 * This function differs from 'set_discount_codes()' as it sets new codes AND also removes any codes from the cart that do not exist in the submitted data. 
	 */
	public function update_discount_codes($discount_codes = FALSE, $recalculate_cart = TRUE)
	{
		if ($response = $this->CI->flexi_cart_model->update_discount_codes($discount_codes))
		{
			// Discount codes set.
			if ($response == 'discount_codes_set')
			{
				return $this->update_cart_session('discount_codes_valid', $recalculate_cart, FALSE);
			}
			// Discount codes unset.
			else
			{
				return $this->update_cart_session('discount_unset_successfully', $recalculate_cart, FALSE);
			}
		}
		
		// Discounts not updated.
		$this->CI->flexi_cart_model->set_error_message('discount_update_unsuccessful', 'config');
		return FALSE;
	}

	/**
	 * unset_discount
	 * Remove any discounts or reward vouchers by their id or code. 
	 * If no discount data is submitted, all manually set discounts and discount codes are removed.
	 */
	public function unset_discount($discount_data = FALSE, $recalculate_cart = TRUE)
	{
		if ($this->CI->flexi_cart_model->unset_session_discount($discount_data))
		{
			if ($this->update_cart_session('discount_unset_successfully', $recalculate_cart, FALSE))
			{
				return TRUE;
			}
		}
		
		$this->CI->flexi_cart_model->set_error_message('discount_unset_unsuccessful', 'config');
		return FALSE;
	}
	
	/**
	 * unset_excluded_discounts
	 * Re-enables discounts and reward vouchers that have be excluded from being applied to the cart.
	 * Typically this includes discounts that are auto applied when a required quantity or value of items are added to the cart.
	 */
	public function unset_excluded_discounts($recalculate_cart = TRUE)
	{
		$this->CI->flexi->cart_contents['settings']['discounts']['data']['excluded_discounts'] = array();
		
		return $this->update_cart_session('excluded_discount_reenabled', $recalculate_cart, FALSE);
	}

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SURCHARGES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * set_surcharge
	 * Manually set or update a cart summary surcharge as either a fixed value or a percentage based on a cart summary column value.
	 *
	 * Valid surcharge array keys are 'id', 'description', 'value', 'column' and 'tax_rate'. 
	 * Valid surcharge 'column' names are 'item_summary_total', 'shipping_total' and 'total'. 
	 * If applying a percentage based surcharge, a valid cart summary column name must be set. 
	 *
	 * By default a fixed rate '0.00' surcharge is applied to the 'total' column and taxed accordingly to the carts current tax settings.
	 * Therefore, it is only necessary to submit array keys for the values that need to be changed from the default settings.
	 */
	public function set_surcharge($surcharge_data = FALSE, $recalculate_cart = TRUE)
	{
		if ($this->CI->flexi_cart_model->set_surcharge($surcharge_data))
		{
			if ($this->update_cart_session('surcharge_updated_successfully', $recalculate_cart, FALSE))
			{
				return TRUE;
			}
		}
		
		$this->CI->flexi_cart_model->set_error_message('surcharge_update_unsuccessful', 'config');
		return FALSE;
	}

	/**
	 * unset_surcharge
	 * Remove surcharges from the cart session data. 
	 * If no surcharge data is submitted, all surcharges are removed.
	 */
	public function unset_surcharge($surcharge_data = FALSE, $recalculate_cart = TRUE)
	{
		if ($this->CI->flexi_cart_model->unset_session_surcharge($surcharge_data))
		{
			if ($this->update_cart_session('surcharge_unset_successful', $recalculate_cart, FALSE))
			{
				return TRUE;
			}
		}
		
		$this->CI->flexi_cart_model->set_error_message('surcharge_unset_unsuccessful', 'config');
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CURRENCY
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * update_currency
	 * Looks-up the currency database table and tries to match a currency with the submitted currency id or name.
	 * If no currency can be found, the defaults set via the config file will be used.
	 */
	public function update_currency($currency_identifier = FALSE)
	{	
		// Check the currency table exists in the config file and is enabled.
		if (! $this->CI->flexi_cart_model->get_enabled_status('currency', TRUE))
		{
			return FALSE;
		}
		
		if ($this->CI->flexi_cart_model->update_currency($currency_identifier))
		{
			if ($this->update_cart_session('currency_updated_successfully', FALSE, FALSE))
			{
				return TRUE;
			}
		}
		
		$this->CI->flexi_cart_model->set_error_message('currency_update_unsuccessful', 'config');
		return FALSE;
	}
	
	/**
	 * set_currency
	 * Manually set the cart currency.
	 * Valid currency array keys are 'name', 'exchange_rate', 'symbol', 'symbol_suffix', 'thousand_separator' and 'decimal_separator'. 
	 */
	public function set_currency($currency_data = FALSE)
	{
		if ($this->CI->flexi_cart_model->set_manual_currency($currency_data))
		{			
			if ($this->update_cart_session('currency_updated_successfully', FALSE, FALSE))
			{
				return TRUE;
			}
		}
		
		$this->CI->flexi_cart_model->set_error_message('currency_update_unsuccessful', 'config');
		return FALSE;
	}
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MISC CONFIG FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * set_order_number
	 * Sets an order number to the cart session data.
	 */
	public function set_order_number($order_number = NULL)
	{
		$this->CI->flexi->cart_contents['settings']['configuration']['order_number'] = $order_number;

		return $this->update_cart_session('session_config_data_updated', FALSE, FALSE);		
	}

	/**
	 * set_minimum_order
	 * Sets the carts minimum order value.
	 */
	public function set_minimum_order($value = FALSE)
	{
		$this->CI->flexi_cart_model->set_minimum_order($value);		
		
		return $this->update_cart_session('session_config_data_updated', FALSE, FALSE);
	}

	/**
	 * set_prices_inc_tax
	 * Sets cart pricing to be displayed excluding/including tax.
	 */
	public function set_prices_inc_tax($tax_status = NULL)
	{
		$this->CI->flexi_cart_model->set_manual_config_setting('display_tax_prices', $tax_status, FALSE);

		return $this->update_cart_session('session_config_data_updated', FALSE, FALSE);		
	}
	
	/**
	 * set_allocate_stock_status
	 * Sets whether item stock should be automatically allocated by cart functions.
	 */
	public function set_allocate_stock_status($allocate_stock_status = NULL)
	{
		$this->CI->flexi_cart_model->set_manual_config_setting('auto_allocate_stock', $allocate_stock_status, FALSE);

		return $this->update_cart_session('session_config_data_updated', FALSE, FALSE);		
	}

	/**
	 * set_stock_limit_quantity_status
	 * Sets whether the maximum quantity of cart items should be limited to the databases stock quantity.
	 */
	public function set_stock_limit_quantity_status($stock_limit_quantity_status = NULL)
	{
		$this->CI->flexi_cart_model->set_manual_config_setting('quantity_limited_by_stock', $stock_limit_quantity_status, FALSE);

		return $this->update_cart_session('session_config_data_updated', FALSE, FALSE);		
	}

	/**
	 * set_remove_no_stock_status
	 * Sets whether out-of-stock items should be automatically removed from the cart.
	 */
	public function set_remove_no_stock_status($remove_no_stock_status = NULL)
	{
		$this->CI->flexi_cart_model->set_manual_config_setting('remove_no_stock_items', $remove_no_stock_status, FALSE);

		return $this->update_cart_session('session_config_data_updated', FALSE, FALSE);		
	}

	/**
	 * set_item_shipping_ban_status
	 * Sets whether to save items to an order that are banned from being shipped to the defined shipping location.
	 */
	public function set_item_shipping_ban_status($item_shipping_ban_status = NULL)
	{
		$this->CI->flexi_cart_model->set_manual_config_setting('save_banned_shipping_items', $item_shipping_ban_status, FALSE);

		return $this->update_cart_session('session_config_data_updated', FALSE, FALSE);		
	}

	/**
	 * set_reward_point_multiplier
	 * Sets the carts reward point multiplier.
	 * Example: A multiplier of 10 is (10 x $1.00) = 10 reward points, so every $1.00 is worth 10 reward points.
	 */
	public function set_reward_point_multiplier($value = FALSE)
	{		
		$this->CI->flexi_cart_model->set_reward_point_multiplier($value);
		
		return $this->update_cart_session('session_config_data_updated', FALSE, FALSE);
	}
	
	/**
	 * set_custom_status_1
	 * Sets whether custom cart status 1 is active.
	 */
	public function set_custom_status_1($custom_status = NULL, $recalculate_cart = TRUE)
	{
		$this->CI->flexi->cart_contents['settings']['configuration']['custom_status_1'] = $custom_status;

		return $this->update_cart_session('session_config_data_updated', $recalculate_cart, FALSE);		
	}
	
	/**
	 * set_custom_status_2
	 * Sets whether custom cart status 2 is active.
	 */
	public function set_custom_status_2($custom_status = NULL, $recalculate_cart = TRUE)
	{
		$this->CI->flexi->cart_contents['settings']['configuration']['custom_status_2'] = $custom_status;

		return $this->update_cart_session('session_config_data_updated', $recalculate_cart, FALSE);		
	}
	
	/**
	 * set_custom_status_3
	 * Sets whether custom cart status 3 is active.
	 */
	public function set_custom_status_3($custom_status = NULL, $recalculate_cart = TRUE)
	{
		$this->CI->flexi->cart_contents['settings']['configuration']['custom_status_3'] = $custom_status;

		return $this->update_cart_session('session_config_data_updated', $recalculate_cart, FALSE);		
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MANAGE CART DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * recalculate_cart
	 * Recalculates all values within the cart.
	 */
	public function recalculate_cart()
	{
		$this->CI->flexi_cart_model->calculate_cart();

		$this->CI->session->set_userdata(array($this->CI->flexi->cart['name'] => $this->CI->flexi->cart_contents));
		
		return TRUE;
	}
	
	/**
	 * update_cart_session
	 * Depending on the submitted variables, the function sets a status message, recalculates the cart and saves the data to the carts session.
	 */
	private function update_cart_session($status_message, $recalculate_cart = TRUE, $nest_recalc = FALSE, $append_message = TRUE)
	{
		// Check if any error messages exist.
		if (! $this->CI->flexi_cart_model->error_messages())
		{
			// If '$append_message = FALSE', remove existing status messages.
			if (! $append_message)
			{
				$this->CI->flexi->status_messages = array('public' => array(), 'admin' => array());
			}

			// Check whether to recalculate cart.
			$response = ($recalculate_cart) ? $this->CI->flexi_cart_model->calculate_cart() : FALSE;
			
			// Check no errors occured during the cart calculation and check whether the '$status_message' should be set.
			if (! $this->CI->flexi_cart_model->error_messages() && (! $nest_recalc || $recalculate_cart))
			{
				$this->CI->flexi_cart_model->set_status_message($status_message, 'config');
			}

			// If the functions return result IS NOT dependent on the response of the 'calculate_cart()' function.
			if (! $nest_recalc)
			{				
				$this->CI->session->set_userdata(array($this->CI->flexi->cart['name'] => $this->CI->flexi->cart_contents));
					
				return TRUE;
			}
			// If the function return result IS dependent on the response of the 'calculate_cart()' function, nest the status message inside the functions return.
			else if ($response)
			{
				$this->CI->session->set_userdata(array($this->CI->flexi->cart['name'] => $this->CI->flexi->cart_contents));
				
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	/**
	 * unset_admin_data
	 * Unsets any 'admin data' that is present in the cart session.
	 */
	public function unset_admin_data()
	{
		unset($this->CI->flexi->cart_contents['settings']['admin_data']);
		
		return ($this->update_cart_session('session_config_data_updated', FALSE, FALSE));
	}
	
	/**
	 * empty_cart
	 * Empties the cart of all items.
	 */
	public function empty_cart($reset_shipping = TRUE)
	{
		// Remove items from cart.
		$this->CI->flexi->cart_contents['items'] = array();
		
		// Check whether to reset shipping data.
		if ($reset_shipping)
		{
			$this->CI->flexi_cart_model->update_shipping(FALSE, $this->shipping_location_data());
		}
		
		// Reset summary and discount values.
		$this->CI->flexi_cart_model->set_summary_defaults();
		$this->CI->flexi_cart_model->set_discount_defaults();
			
		$this->CI->session->set_userdata(array($this->CI->flexi->cart['name'] => $this->CI->flexi->cart_contents));
		
		$this->CI->flexi_cart_model->set_status_message('cart_emptied', 'config');
		return TRUE;
	}
	
	/**
	 * destroy_cart
	 * Destroys the entire cart data session.
	 */
	public function destroy_cart()
	{
		$this->CI->flexi->cart_contents = array();
		
		// Unset browser cart session data.
		$this->CI->session->unset_userdata($this->CI->flexi->cart['name']);

		// Reset defaults.
		$this->CI->flexi->cart_contents = $this->CI->flexi_cart_model->set_cart_defaults();

		$this->CI->flexi_cart_model->set_status_message('cart_destroyed', 'config');
		return TRUE;
	}
}

/* End of file Flexi_cart.php */
/* Location: ./application/libraries/Flexi_cart.php */