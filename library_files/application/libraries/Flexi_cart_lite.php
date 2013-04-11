<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: flexi cart lite library
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

class Flexi_cart_lite
{
	public function __construct()
	{
		$this->CI =& get_instance();
		
		$this->CI->load->model('flexi_cart_lite_model');
	}

	public function __call($method, $arguments) 
	{
		$extension_types = array('_num_rows', '_row_array', '_array', '_result', '_row');
		$method_substr = str_replace(array_values($extension_types), FALSE, $method);		
		$method_substr_query = $method_substr.'_query';
		$method_substr_extension = str_replace($method_substr, FALSE, $method);
	
		// Get flexi cart class name.
		$libraries = array('flexi_cart', 'flexi_cart_admin');
		foreach($libraries as $library)
		{
			if (class_exists($library) && method_exists($library, $method_substr_query))
			{
				$target_library = $library;
				break;
			}
		}

		if (isset($target_library))
		{
			// Pass the first 3 submitted arguments to the function (Usually the SQL SELECT and WHERE statements).
			$argument_1 = (isset($arguments[0])) ? $arguments[0] : FALSE; // Usually $sql_select
			$argument_2 = (isset($arguments[1])) ? $arguments[1] : FALSE; // Usually $sql_where
			$argument_3 = (isset($arguments[2])) ? $arguments[2] : FALSE; // Other
			$data = $this->CI->$target_library->$method_substr_query($argument_1, $argument_2, $argument_3);
			
			if (! empty($data))
			{
				if ($method_substr_extension == '_result')
				{
					return $data->result();
				}
				else if ($method_substr_extension == '_row')
				{
					return $data->row();
				}
				else if ($method_substr_extension == '_array')
				{
					return $data->result_array();
				}
				else if ($method_substr_extension == '_row_array')
				{
					return $data->row_array();
				}
				else if ($method_substr_extension == '_num_rows')
				{
					return $data->num_rows();
				}
				else // '_query'
				{
					return $data;
				}
			}
		}
		
		echo 'Call to an unknown method : "'.$method.'"';
		return FALSE;
	}
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART CONTENT FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * The carts summary data and item data specific to individual rows within the cart can be called using the following series of functions.
	 * This is a summary of the variables commonly available in many of the functions.
	 * 
	 * $row_id : Used with item functions, it is the items 'row id' and is required to identify the row within the cart array.
	 * 
	 * $inc_discount : Quantity and pricing functions can be called to return values that include any discount values that may have been applied.
	 * By submitting a boolean value to '$inc_discount', the items discounted (TRUE) and non-discounted (FALSE) value can be returned.
	 * Example: With the 'item_price()' function, '$inc_discount = TRUE' returns the discount item price, 'FALSE' returns the non-discounted item price. 
	 * NOTE: Item functions, by default, are set to return values EXCLUDING discount values, summary functions are set to return values INCLUDING discount values.
	 *
	 * $format : Pricing and weight functions can be called to return a formatted or non-formatted value.
	 * Values are formatted with a thousand separator and a decimal separator, pricing functions have a currency symbol and weight functions have a weight unit symbol.
	 *
	 * $internal_value : All pricing values within the cart array are saved using the carts default currency, and tax inclusion/exclusion settings.
	 * If a user changes the carts tax inclusion or currency settings to be displayed differently from the carts default, then '$internal_value' can be used to
	 * either return the carts saved array value (TRUE), or as a value converted to match the users display preferences (FALSE).
	 */ 
	 
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * cart_status
	 * Returns whether there are any items in the cart.
	 */
	public function cart_status()
	{
		return (! empty($this->CI->flexi->cart_contents['items']));
	}
	
	/**
	 * cart_array
	 * Returns the entire cart data array.
	 */
	public function cart_array()
	{
		return $this->CI->flexi->cart_contents;
	}
	
	/**
	 * cart_contents
	 * Returns the cart items and summary array.
	 */
	public function cart_contents($inc_discount = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		return array(
			'items' => $this->cart_items($inc_discount, $format, $internal_value),
			'summary' => $this->cart_summary($inc_discount, $format, $internal_value)
		);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART SUMMARY DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * cart_summary
	 * Returns cart summary data, formatted by function parameters.
	 */
	public function cart_summary($inc_discount = TRUE, $format = TRUE, $internal_value = FALSE)
	{
		$cart_summary['item_summary_total'] = $this->item_summary_total($inc_discount, $format, $internal_value);
		$cart_summary['item_summary_savings_total'] = $this->item_summary_savings_total($format, $internal_value);
		$cart_summary['shipping_total'] = $this->shipping_total($inc_discount, $format, $internal_value); 
		$cart_summary['item_shipping_total'] = $this->item_shipping_total($inc_discount, $format, $internal_value); 
		$cart_summary['summary_savings_total'] = $this->summary_savings_total($format, $internal_value);
		$cart_summary['savings_total'] = $this->cart_savings_total(TRUE, $format, $internal_value);
		$cart_summary['reward_voucher_total'] = $this->reward_voucher_total($format, $internal_value);
		$cart_summary['surcharge_total'] = $this->surcharge_total($format, $internal_value);
		$cart_summary['tax_total'] = $this->tax_total($inc_discount, $format, $internal_value);
		$cart_summary['total'] = $this->total($inc_discount, $format, $internal_value);
		
		$cart_summary['total_rows'] = $this->total_rows($format);
		$cart_summary['total_items'] = $this->total_items($format);
		$cart_summary['total_weight'] = $this->total_weight(FALSE, $format, FALSE);
		$cart_summary['total_reward_points'] = $this->total_reward_points($format);

		return $cart_summary;
	}
	
	/**
	 * cart_summary_array
	 * Returns the carts unformatted summary data as an array.
	 */
	public function cart_summary_array()
	{
		return (isset($this->CI->flexi->cart_contents['summary'])) ? $this->CI->flexi->cart_contents['summary'] : array();
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART SUMMARY TOTALS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * item_summary_total
	 * Returns the total value of all items within the cart.
	 */
	public function item_summary_total($inc_discount = TRUE, $format = TRUE, $internal_value = FALSE)
	{
		$non_discounted_price_summary = $this->CI->flexi->cart_contents['summary']['item_summary_total'];
		$discounted_price_summary = ($inc_discount) ? $this->CI->flexi->cart_contents['settings']['discounts']['data']['item_discount_savings'] : 0;

		if (! $internal_value)
		{
			$non_discounted_tax_summary = $this->CI->flexi->cart_contents['settings']['tax']['data']['item_total_tax'];		
			$non_discounted_price_summary = $this->convert_to_cart_currency($non_discounted_price_summary, $non_discounted_tax_summary);
			
			$discounted_tax_summary = ($inc_discount) ? $this->CI->flexi->cart_contents['settings']['tax']['data']['item_discount_tax'] : 0;		
			$discounted_price_summary = ($inc_discount) ? $this->convert_to_cart_currency($discounted_price_summary, $discounted_tax_summary) : 0;
		}
		
		return $this->format_currency(($non_discounted_price_summary - $discounted_price_summary), $format, 2, $internal_value);
	}

	/** 
	 * shipping_total
	 * Returns the shipping total of the cart.
	 */
	public function shipping_total($inc_discount = TRUE, $format = TRUE, $internal_value = FALSE)
	{		
		// Validate whether a discount can and should be applied.
		$inc_discount = ($inc_discount && isset($this->CI->flexi->cart_contents['settings']['discounts']['active_summary']['shipping_total']));
		
		$non_discounted_shipping_total = $this->CI->flexi->cart_contents['summary']['shipping_total'];
		$discounted_shipping_total = ($inc_discount) ? $this->CI->flexi->cart_contents['settings']['discounts']['active_summary']['shipping_total']['value'] : 0;					
		
		if (! $internal_value)
		{
			$non_discounted_shipping_tax = $this->CI->flexi->cart_contents['settings']['tax']['data']['shipping_tax'];
			$non_discounted_shipping_total = $this->convert_to_cart_currency($non_discounted_shipping_total, $non_discounted_shipping_tax);
			
			$discounted_shipping_tax = ($inc_discount) ? $this->CI->flexi->cart_contents['settings']['discounts']['active_summary']['shipping_total']['tax_value'] : 0;
			$discounted_shipping_total = ($inc_discount) ? $this->convert_to_cart_currency($discounted_shipping_total, $discounted_shipping_tax) : 0;
		}
		
		return $this->format_currency(($non_discounted_shipping_total - $discounted_shipping_total), $format, 2, $internal_value);
	}
	
	/**
	 * item_shipping_total
	 * Returns the combined item price total and the cart shipping total.
	 */
	public function item_shipping_total($inc_discount = TRUE, $format = TRUE, $internal_value = FALSE)
	{		
		$item_summary_total = $this->item_summary_total($inc_discount, FALSE, $internal_value);
		$shipping_total = $this->shipping_total($inc_discount, FALSE, $internal_value); 
		
		return $this->format_currency($item_summary_total + $shipping_total, $format, 2, $internal_value);		
	}
	
	###+++++++++++++++++++++++++++++++++###
	
	/**
	 * tax_total
	 * Returns the tax total of the cart.
	 */
	public function tax_total($inc_discount = TRUE, $format = TRUE, $internal_value = FALSE)
	{
		// If including discount, add the surcharge tax.
		if ($inc_discount)
		{
			$tax_total = $this->CI->flexi->cart_contents['settings']['tax']['data']['cart_tax'] + $this->CI->flexi->cart_contents['settings']['tax']['data']['surcharge_tax'];
		}
		else
		{
			$tax_total = $this->CI->flexi->cart_contents['summary']['tax_total'];
		}
		
		if (! $internal_value)
		{
			$tax_total = $this->convert_to_cart_currency($tax_total);
		}
		
		return $this->format_currency($tax_total, $format, 2, $internal_value);
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * sub_total
	 * Returns the sub-total value of the cart (e.g. grand total excluding tax).
	 */
	public function sub_total($inc_discount = TRUE, $format = TRUE, $internal_value = FALSE)
	{
		if ($inc_discount)
		{
			// Total up all taxable, non-taxable values and the carts total tax value.
			$cart_taxable_value = $this->CI->flexi->cart_contents['settings']['tax']['data']['cart_taxable_value'];
			$cart_non_taxable_value = $this->CI->flexi->cart_contents['settings']['tax']['data']['cart_non_taxable_value'];
		
			// Surcharge total is not included in the taxable value above as it must remain excluded from discounts - i.e. you cannot discount a surcharge.
			// Therefore, the surcharge must be calculated and added to the total.
			$surcharge_total = $this->CI->flexi->cart_contents['summary']['surcharge_total'];
			$sub_total = ($cart_taxable_value + $cart_non_taxable_value);
		}
		else
		{
			// The non-discounted cart summary total is to be used, therefore the total already includes the surcharge value.
			$surcharge_total = 0;
			$sub_total = ($this->CI->flexi->cart_contents['summary']['total'] - $this->CI->flexi->cart_contents['summary']['tax_total']);
		}
			
		if (! $internal_value)
		{
			$surcharge_total = ($inc_discount) ? $this->convert_to_cart_currency($surcharge_total) : 0;
			$sub_total = $this->convert_to_cart_currency($sub_total);
		}

		return $this->format_currency(($sub_total + $surcharge_total), $format, 2, $internal_value);
	}

	###+++++++++++++++++++++++++++++++++###

	/**
	 * total
	 * Returns the grand total value of the cart.
	 */
	public function total($inc_discount = TRUE, $format = TRUE, $internal_value = FALSE)
	{
		if ($inc_discount)
		{
			// Total up all taxable, non-taxable values and the carts total tax value.
			$cart_taxable_value = $this->CI->flexi->cart_contents['settings']['tax']['data']['cart_taxable_value'];
			$cart_non_taxable_value = $this->CI->flexi->cart_contents['settings']['tax']['data']['cart_non_taxable_value'];
			$cart_tax_value = $this->CI->flexi->cart_contents['settings']['tax']['data']['cart_tax'];
		
			// Surcharge total is not included in the taxable value above as it must remain excluded from discounts - i.e. you cannot discount a surcharge.
			// Therefore, the surcharge must be calculated and added to the total.
			$surcharge_total = $this->CI->flexi->cart_contents['summary']['surcharge_total'];
			$total = ($cart_taxable_value + $cart_non_taxable_value + $cart_tax_value);
		}
		else
		{
			// The non-discounted cart summary total is to be used, therefore the total already includes the surcharge value.
			$surcharge_total = 0;
			$total = $this->CI->flexi->cart_contents['summary']['total'];
		}
			
		if (! $internal_value)
		{
			$surcharge_tax = ($inc_discount) ? $this->CI->flexi->cart_contents['settings']['tax']['data']['surcharge_tax'] : 0;
			$surcharge_total = ($inc_discount) ? $this->convert_to_cart_currency($surcharge_total, $surcharge_tax) : 0;
			
			// Note: Tax cannot be removed from the cart total
			$total = $this->convert_to_cart_currency($total);
		}

		return $this->format_currency(($total + $surcharge_total), $format, 2, $internal_value);
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * item_summary_savings_total
	 * Returns the savings total of all item discounts.
	 */
	public function item_summary_savings_total($format = TRUE, $internal_value = FALSE)
	{
		$item_summary_savings_total = $this->CI->flexi->cart_contents['settings']['discounts']['data']['item_discount_savings'];
		
		if (! $internal_value)
		{
			$item_discount_tax_total = $this->CI->flexi->cart_contents['settings']['tax']['data']['item_discount_tax'];
			$item_summary_savings_total = $this->convert_to_cart_currency($item_summary_savings_total, $item_discount_tax_total);
		}
		
		return $this->format_currency($item_summary_savings_total, $format, 2, $internal_value);
	}
	
	/**
	 * summary_savings_total
	 * Returns the savings total of all summary discounts.
	 */
	public function summary_savings_total($format = TRUE, $internal_value = FALSE)
	{
		$summary_savings_total = $this->CI->flexi->cart_contents['settings']['discounts']['data']['summary_discount_savings'];
		
		if (! $internal_value)
		{
			$summary_discount_tax_total = $this->CI->flexi->cart_contents['settings']['tax']['data']['summary_discount_tax'];
			$summary_savings_total = $this->convert_to_cart_currency($summary_savings_total, $summary_discount_tax_total);
		}
		
		return $this->format_currency($summary_savings_total, $format, 2, $internal_value);
	}

	/**
	 * cart_savings_total
	 * Returns the savings total of all item and summary discounts and reward vouchers applied to the cart.
	 */
	public function cart_savings_total($include_vouchers = TRUE, $format = TRUE, $internal_value = FALSE)
	{
		$item_summary_savings_total = $this->item_summary_savings_total(FALSE, $internal_value);
		$summary_savings_total = $this->summary_savings_total(FALSE, $internal_value);
		$reward_voucher_savings_total = ($include_vouchers) ? $this->reward_voucher_total(FALSE, $internal_value) : 0;
		
		return $this->format_currency(($item_summary_savings_total + $summary_savings_total + $reward_voucher_savings_total), $format, 2, $internal_value);
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * reward_voucher_total
	 * Returns the total of all reward vouchers applied to the cart.
	 */
	public function reward_voucher_total($format = TRUE, $internal_value = FALSE)
	{
		$reward_voucher_total = $this->CI->flexi->cart_contents['settings']['discounts']['data']['reward_vouchers'];
		
		if (! $internal_value)
		{
			$reward_voucher_tax_total = $this->CI->flexi->cart_contents['settings']['tax']['data']['reward_voucher_tax'];
			$reward_voucher_total = $this->convert_to_cart_currency($reward_voucher_total, $reward_voucher_tax_total);
		}
					
		return $this->format_currency($reward_voucher_total, $format, 2, $internal_value);
	}
	
	###+++++++++++++++++++++++++++++++++###
	
	/**
	 * surcharge_total
	 * Returns the total of all surcharges applied to the cart.
	 */
	public function surcharge_total($format = TRUE, $internal_value = FALSE)
	{
		$surcharge_total = $this->CI->flexi->cart_contents['summary']['surcharge_total'];
		
		if (! $internal_value)
		{
			$surcharge_tax_total = $this->CI->flexi->cart_contents['settings']['tax']['data']['surcharge_tax'];
			$surcharge_total = $this->convert_to_cart_currency($surcharge_total, $surcharge_tax_total);
		}
		
		return $this->format_currency($surcharge_total, $format, 2, $internal_value);
	}

	###+++++++++++++++++++++++++++++++++###

	/**
	 * total_rows
	 * Returns the total number of individual rows within the cart.
	 */
	public function total_rows($format = TRUE)
	{
		return $this->format_number($this->CI->flexi->cart_contents['summary']['total_rows'], $format, 0);
	}

	/**
	 * total_items
	 * Returns the total number of items within the cart.
	 */
	public function total_items($format = TRUE)
	{
		return $this->format_number($this->CI->flexi->cart_contents['summary']['total_items'], $format, 
			$this->CI->flexi->cart_contents['settings']['configuration']['quantity_decimals']);
	}

	/**
	 * total_weight
	 * Returns the total weight of items within the cart.
	 * The weight value can be converted into different weight unit types by submitting a value to '$weight_type'.
	 * Available weight types are 'gram', 'kilogram', 'avoir_ounce', 'avoir_pound', 'troy_ounce', 'troy_pound' and 'carat'.
	 */
	public function total_weight($weight_type = FALSE, $format = TRUE, $decimals = FALSE)
	{
		return $this->convert_weight($this->CI->flexi->cart_contents['summary']['total_weight'], FALSE, $weight_type, $format, $decimals);
	}
	
	/**
	 * total_reward_points
	 * Return the total reward points earnt from items within the cart.
	 */
	public function total_reward_points($format = TRUE)
	{
		return $this->format_number($this->CI->flexi->cart_contents['summary']['total_reward_points'], $format, 0);
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * cart_taxable_value
	 * Returns the total value of taxable items (excluding tax) within the cart.
	 */
	public function cart_taxable_value($format = TRUE, $internal_value = FALSE)
	{
		$cart_taxable_value = $this->CI->flexi->cart_contents['settings']['tax']['data']['cart_taxable_value'];
		
		if (! $internal_value)
		{
			$cart_taxable_value = $this->convert_to_cart_currency($cart_taxable_value);
		}
		
		return $this->format_currency($cart_taxable_value, $format, 2, $internal_value);
	}	
	
	/**
	 * cart_non_taxable_value
	 * Returns the total value of non-taxable items within the cart.
	 */
	public function cart_non_taxable_value($format = TRUE, $internal_value = FALSE)
	{
		$cart_non_taxable_value = $this->CI->flexi->cart_contents['settings']['tax']['data']['cart_non_taxable_value'];
		
		if (! $internal_value)
		{
			$cart_non_taxable_value = $this->convert_to_cart_currency($cart_non_taxable_value);
		}
		
		return $this->format_currency($cart_non_taxable_value, $format, 2, $internal_value);
	}		
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART ITEM DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * cart_items
	 * Returns the entire cart item data, formatted by function parameters.
	 */
	public function cart_items($inc_discount = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		// Loop cart items formatting and converting all currency based values if specified.
		$cart_items = array();
		foreach($this->CI->flexi->cart_contents['items'] as $row_id => $item)
		{
			$cart_items[$row_id] = $this->cart_item_row($row_id, $inc_discount, $format, $internal_value);
		}

		return $cart_items;
	}

	/**
	 * cart_item_row
	 * Returns a specific cart item row, formatted by function parameters.
	 */
	public function cart_item_row($row_id = FALSE, $inc_discount = FALSE, $format = TRUE, $internal_value = FALSE)
	{	
		$item = array();

		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			// Create shorted column alias.
			$column_alias = $this->CI->flexi->cart_columns;
			
			// Copy existing unformatted item array.
			$item = $this->CI->flexi->cart_contents['items'][$row_id];

			$item[$column_alias['item_quantity']] = $this->item_quantity($row_id, FALSE, $format);
			$item[$column_alias['item_non_discount_quantity']] = $this->item_quantity($row_id, TRUE, $format);
			$item[$column_alias['item_discount_quantity']] = $this->item_discount_quantity($row_id, $format);

			$item[$column_alias['item_price']] = $this->item_price($row_id, $inc_discount, $format, $internal_value);
			$item[$column_alias['item_price_total']] = $this->item_price_total($row_id, $inc_discount, $format, $internal_value);
						
			$item[$column_alias['item_discount_price']] = $this->item_discount_price($row_id, $format, $internal_value);
			$item[$column_alias['item_discount_price_total']] = $this->item_discount_price_total($row_id, $format, $internal_value);
			$item[$column_alias['item_discount_description']] = $this->item_discount_description($row_id);
				
			$item[$column_alias['item_tax_rate']] = $this->item_tax_rate($row_id, $format, TRUE);
			$item[$column_alias['item_tax']] = $this->item_tax($row_id, $inc_discount, $format, $internal_value);
			$item[$column_alias['item_tax_total']] = $this->item_tax_total($row_id, $inc_discount, $format, $internal_value);
		
			$item[$column_alias['item_shipping_rate']] = $this->item_shipping_rate($row_id, $format, $internal_value);

			$item[$column_alias['item_weight']] = $this->item_weight($row_id, FALSE, $format, FALSE);
			$item[$column_alias['item_weight_total']] = $this->item_weight_total($row_id, FALSE, $format, FALSE); 
			
			$item[$column_alias['item_reward_points']] = $this->item_reward_points($row_id, $format);
			$item[$column_alias['item_reward_points_total']] = $this->item_reward_points_total($row_id, $format);
		}
		
		return $item;			
	}
	
	/**
	 * cart_item_array
	 * Returns the cart data array for either a particular item row in the cart, or the entire cart item array.
	 */
	public function cart_item_array($row_id = FALSE)
	{
		return (isset($this->CI->flexi->cart_contents['items'][$row_id])) ? 
			$this->CI->flexi->cart_contents['items'][$row_id] : $this->CI->flexi->cart_contents['items'];
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// REQUIRED ITEM DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
		
	/**
	 * row_id_exists
	 * Returns whether a row id exists in the cart item array.
	 * Note: This is not the same as the 'id' that would be used to identify items within the database.
	 */
	public function row_id_exists($row_id = FALSE)
	{    
		return (isset($this->CI->flexi->cart_contents['items'][$row_id]));
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * item_id
	 * Return an items id for a specific row. 
	 * The id is typically the primary key within the databases item table.
	 * Note: The 'item_id' is not the same as the 'row_id' that would be used to identify a row within the cart
	 */
	public function item_id($row_id = FALSE)
	{
		return (isset($this->CI->flexi->cart_contents['items'][$row_id])) ?
			$this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_id']] : FALSE;
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * item_name
	 * Return an items name for a specific row.
	 */
	public function item_name($row_id = FALSE)
	{
		return (isset($this->CI->flexi->cart_contents['items'][$row_id])) ?
			$this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_name']] : FALSE;
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * item_quantity
	 * Returns the quantity of items for a specific row. 
	 * '$inc_discount = FALSE' returns the total quantity of non-discounted items.
	 * '$inc_discount = TRUE' returns the total of all discounted and non-discounted items.
	 */
	public function item_quantity($row_id = FALSE, $inc_discount = FALSE, $format = TRUE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$item_quantity = ($inc_discount && $this->item_discount_status($row_id)) ? 
				$this->CI->flexi->cart_contents['settings']['discounts']['active_items'][$row_id]['non_discount_quantity'] : 
				$this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_quantity']];
				
			return $this->format_number($item_quantity, $format, $this->CI->flexi->cart_contents['settings']['configuration']['quantity_decimals']);
		}
		
		return FALSE;
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * item_price
	 * Returns the price of an item for a specific row.
	 */
	public function item_price($row_id = FALSE, $inc_discount = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$item_price = $this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_price']];
			
			if ($inc_discount && $this->item_discount_status($row_id))
			{
				$item_price -= $this->CI->flexi->cart_contents['settings']['discounts']['active_items'][$row_id]['value'];
			}
			
			if (! $internal_value)
			{
				$item_tax = $this->item_tax($row_id, $inc_discount, FALSE, TRUE);
				$item_price = $this->convert_to_cart_currency($item_price, $item_tax);
			}
		
			return $this->format_currency($item_price, $format, 2, $internal_value);
		}
		
		return FALSE;
	}
	
	/**
	 * item_price_total
	 * Returns the total price of an item for a specific row.
	 */
	public function item_price_total($row_id = FALSE, $inc_discount = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$non_discounted_price_total = ($this->item_price($row_id, FALSE, FALSE, $internal_value) * $this->item_quantity($row_id, $inc_discount));	
			$discounted_price_total = ($inc_discount) ? ($this->item_price($row_id, TRUE, FALSE, $internal_value) * $this->item_discount_quantity($row_id)) : 0;
			
			return $this->format_currency(($non_discounted_price_total + $discounted_price_total), $format, 2, $internal_value);
		}
		
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM TAX
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * item_tax_rate
	 * Returns an items tax rate for a specific row.
	 * If a specific tax rate has not been set for an item, and '$fallback_default = TRUE', the default cart tax rate will be returned.
	 * Otherwise, the absolute value set in the cart item array will be returned. If a tax rate was not set when the item was added, the returned value will be 'FALSE'.
	 */
	public function item_tax_rate($row_id = FALSE, $format = TRUE, $fallback_default = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$item_tax_rate = $this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_tax_rate']];
					
			if ($fallback_default && $item_tax_rate === FALSE)
			{
				$item_tax_rate = $this->tax_rate(FALSE);
			}
			
			return ($format && $item_tax_rate !== FALSE) ? $this->CI->flexi_cart_lite_model->format_calculation($item_tax_rate, 4).'%' : $item_tax_rate;
		}
		
		return FALSE;
	}
	
	/**
	 * item_tax
	 * Returns an items tax value for a specific row.
	 */
	public function item_tax($row_id = FALSE, $inc_discount = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$item_tax = ($inc_discount && $this->item_discount_status($row_id)) ?
				$this->CI->flexi->cart_contents['settings']['discounts']['active_items'][$row_id]['tax_value'] :
				$this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_tax']];
				
			if (! $internal_value)
			{
				$item_tax = $this->convert_to_cart_currency($item_tax);
			}
			
			return $this->format_currency($item_tax, $format, 2, $internal_value);
		}
		
		return FALSE;
	}

	/**
	 * item_tax_total
	 * Returns an items total tax value for a specific row.
	 */
	public function item_tax_total($row_id = FALSE, $inc_discount = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			if ($inc_discount && $this->item_discount_status($row_id))
			{
				$item_non_discount_quantity = $this->item_quantity($row_id, TRUE);
				$item_discount_quantity = $this->item_discount_quantity($row_id);
				
				$item_non_discount_tax = $this->item_tax($row_id, FALSE, FALSE, TRUE);
				$item_discount_tax = $this->item_tax($row_id, TRUE, FALSE, TRUE);
				
				$item_tax_total = (($item_non_discount_tax * $item_non_discount_quantity) + ($item_discount_tax * $item_discount_quantity));
			}
			else
			{
				$item_quantity = $this->item_quantity($row_id);
				
				$item_tax_total = ($this->item_tax($row_id, FALSE, FALSE, TRUE) * $item_quantity);
			}
			
			if (! $internal_value)
			{
				$item_tax_total = $this->convert_to_cart_currency($item_tax_total);
			}
			
			return $this->format_currency($item_tax_total, $format, 2, $internal_value);
		}
		
		return FALSE;
	}

	/**
	 * get_item_tax_rate
	 * Looks-up the database and returns the tax rate for a specific item.
	 * If a specific tax rate has not been set for an item, and '$fallback_default = TRUE', the default cart tax rate will be returned.
	 * Note: The 'item_tax' table must be enabled via the config file.
	 */
	public function get_item_tax_rate($item_id = FALSE, $format = TRUE, $fallback_default = TRUE)
	{
		$item_tax_rate = $this->CI->flexi_cart_lite_model->get_database_item_tax_rate($item_id);
		
		if ($item_tax_rate === FALSE && $fallback_default)
		{
			$item_tax_rate = $this->tax_rate(FALSE);
		}
	
		return ($format && $item_tax_rate !== FALSE) ? $this->CI->flexi_cart_lite_model->format_calculation($item_tax_rate, 4).'%' : $item_tax_rate;
	}
	
	/** 
	 * get_item_tax_value
	 * Looks-up the database to get an items tax rate, the tax rate is then calculated against a submitted value to return the items tax value.
	 * Note: The 'item_tax' table must be enabled via the config file and the current item must be present in the table, 
	 * else it will return the current cart tax rate.
	 */
	public function get_item_tax_value($item_id = FALSE, $value = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		// Get the items tax rate, if not set, use the carts current tax rate.
		$item_tax_rate = $this->get_item_tax_rate($item_id, FALSE, FALSE);

		// Convert the tax in the submitted value, from the carts internal tax rate, to the users current tax rate.
		$value = $this->convert_tax_value($value, $item_tax_rate);

		// Calculate the tax on the submitted value.
		$item_tax_data = $this->CI->flexi_cart_lite_model->calculate_tax($value, $item_tax_rate);		

		$item_tax = $item_tax_data['tax_value'];
		
		if (! $internal_value)
		{
			$item_tax = $this->convert_to_cart_currency($item_tax);
		}
		
		return $this->format_currency($item_tax, $format, 2, $internal_value);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM SHIPPING
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * item_shipping_status
	 * Returns whether an item in the cart is permitted to be shipped to the current shipping location.
	 */
	public function item_shipping_status($row_id = FALSE)
	{
		return (! in_array($row_id, $this->CI->flexi->cart_contents['settings']['shipping']['data']['banned_shipping_items']));
	}

	/**
	 * item_shipping_rate
	 * Returns an items shipping rate for a specific row.
	 * By default the shipping rate of an item added to the cart is 'FALSE'.
	 * A rate of '0' means the item ships free, and a rate of more than '0' means the item has a shipping surcharge that is added to the carts shipping rate.
	 */
	public function item_shipping_rate($row_id = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['settings']['shipping']['data']['item_shipping_rates'][$row_id]))
		{			
			$item_shipping_rate = $this->CI->flexi->cart_contents['settings']['shipping']['data']['item_shipping_rates'][$row_id];
			
			if (! $internal_value)
			{
				$item_shipping_rate = $this->convert_to_cart_currency($item_shipping_rate);
			} 
		}
		
		return (isset($item_shipping_rate)) ? $this->format_currency($item_shipping_rate, $format, 2, $internal_value) : FALSE;
	}
		
	/**
	 * get_item_shipping_rate
	 * Returns a database value for a specific items shipping rate to the current shipping location.
	 * If required, the shipping rate to a specific location can be checked, else the carts current shipping location is used.
	 * A rate of '0', means the item ships free, > '0' means the item has a shipping surcharge that is added to the carts shipping rate, 
	 * 'FALSE' means it is calculated as normal.
	 * Note: The 'item_shipping' table must be enabled via the config file and the current item must be present in the table, else it will return 'FALSE'.
	 */
	public function get_item_shipping_rate($item_id = FALSE, $format = TRUE, $internal_value = FALSE, $location = FALSE)
	{
		if ($item_shipping_data = $this->CI->flexi_cart_lite_model->get_database_item_shipping_rate($item_id, $location))
		{			
			$item_shipping_rate = $item_shipping_data[$this->CI->flexi->cart_database['item_shipping']['columns']['value']];
			
			if (! $internal_value)
			{
				$item_shipping_rate = $this->convert_to_cart_currency($item_shipping_rate);
			}
		}
		
		return (isset($item_shipping_rate)) ? $this->format_currency($item_shipping_rate, $format, 2, $internal_value) : FALSE;
	}

	/**
	 * get_item_shipping_status
	 * Returns whether a specific item is permitted to be shipped to the current shipping location.
	 * 
	 * Items in the 'item_shipping' table can be grouped into 'whitelist' and 'blacklist' locations.
	 * If an item has a whitelist of locations, and the current location is not matched, then the item cannot be shipped.
	 * If an item has a blacklist of locations, and the current location is matched, then the item cannot be shipped.
	 * If an item is on neither list, it is permitted.
	 * Note: If the 'item_shipping' table is disabled, and this function is run, it will indicate that any submitted item can be shipped to all locations.
	 */
	public function get_item_shipping_status($item_id = FALSE)
	{
		return $this->CI->flexi_cart_lite_model->get_database_item_shipping_status($item_id);
	}
		
	/** 
	 * get_item_shipping_separate_status
	 * Looks-up the database and returns whether an item needs to be shipped separately from other items in the cart.
	 * Note: The 'item_shipping' table must be enabled via the config file and the current item must be present in the table.
	 * If the table is not enabled, or the item is not listed in the table, the function will return 'FALSE' (Item is not shipped separately).
	 */
	public function get_item_shipping_separate_status($item_id = FALSE)
	{
		$item_shipping_data = $this->CI->flexi_cart_lite_model->get_database_item_shipping_rate($item_id);
		
		return ($item_shipping_data) ? (bool)$item_shipping_data[$this->CI->flexi->cart_database['item_shipping']['columns']['separate']] : FALSE;			
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM STOCK
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
		
	/**
	 * item_stock_status
	 * Returns whether an item is in-stock for a specific row.
	 * An additional quantity can be added to or subtracted from the stock quantity by submitting a positive or negative value via '$apply_quantity'
	 * Note: The 'item_stock' table must be enabled via the config file AND the current item must be present in the table, else it will return 'FALSE'.
	 */
	public function item_stock_status($row_id = FALSE, $deduct_cart_quantity = FALSE, $apply_quantity = 0)
	{
		return $this->CI->flexi_cart_lite_model->is_positive($this->item_stock_quantity($row_id, $deduct_cart_quantity, $apply_quantity));
	}
	
	/**
	 * item_stock_quantity
	 * Returns the quantity of in-stock items for a specific row.
	 * An additional quantity can be added to or subtracted from the stock quantity by submitting a positive or negative value via '$apply_quantity'
	 * Note: The 'item_stock' table must be enabled via the config file AND the current item must be present in the table, else it will return 'FALSE'.
	 */
	public function item_stock_quantity($row_id = FALSE, $deduct_cart_quantity = FALSE, $apply_quantity = 0, $format = TRUE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$item_stock_quantity = ($this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_stock_quantity']]);
			
			if ($item_stock_quantity !== FALSE)
			{
				$stock_allocation = (isset($this->CI->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['stock_allocation'])) ?
					$this->CI->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['stock_allocation'] : 0;

				$item_stock_quantity += ($deduct_cart_quantity) ? ($stock_allocation + $apply_quantity) : $apply_quantity; 
				
				return $this->format_number($item_stock_quantity, $format, $this->CI->flexi->cart_contents['settings']['configuration']['quantity_decimals']);
			}
		}
		
		return FALSE;
	}

	/**
	 * get_item_stock_status
	 * Looks-up the database and returns the status of whether a specific item is in-stock.
	 * An additional quantity can be added to or subtracted from the stock quantity by submitting a positive or negative value via '$apply_quantity'
	 * Note: The 'item_stock' table must be enabled via the config file AND the current item must be present in the table, else it will return 'FALSE'.
	 */
	public function get_item_stock_status($item_id = FALSE, $deduct_cart_quantity = FALSE, $apply_quantity = 0)
	{
		return $this->CI->flexi_cart_lite_model->is_positive($this->CI->flexi_cart_lite_model->get_item_stock_quantity($item_id, $deduct_cart_quantity, $apply_quantity));
	}

	/**
	 * get_item_stock_quantity
	 * Looks-up the database and returns the quantity of in-stock items for a specific item.
	 * An additional quantity can be added to or subtracted from the stock quantity by submitting a positive or negative value via '$apply_quantity'
	 * Note: The 'item_stock' table must be enabled via the config file AND the current item must be present in the table, else it will return 'FALSE'.
	 */
	public function get_item_stock_quantity($item_id = FALSE, $deduct_cart_quantity = FALSE, $apply_quantity = 0, $format = TRUE)
	{
		$item_stock_quantity = $this->CI->flexi_cart_lite_model->get_item_stock_quantity($item_id);
		
		if ($item_stock_quantity !== FALSE)
		{
			$item_stock_quantity += ($deduct_cart_quantity) ? ($this->CI->flexi_cart_lite_model->get_item_allocated_stock($item_id) + $apply_quantity) : $apply_quantity; 
			
			return $this->format_number($item_stock_quantity, $format, $this->CI->flexi->cart_contents['settings']['configuration']['quantity_decimals']);
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM OPTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * item_option_status
	 * Returns whether an item has any options, for a specific row.
	 */
	public function item_option_status($row_id = FALSE)
	{
		return (isset($this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_options']]) && 
			count($this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_options']]) > 0);
	}
	
	/**
	 * item_options
	 * Returns an items options as a formatted string, for a specific row.
	 * If the item is an array, each option is separated by a character(s) defined by '$option_separator'.
	 */
	public function item_options($row_id = FALSE, $include_keys = FALSE, $option_separator = ', ')
	{
		if ($this->item_option_status($row_id))
		{
			if (is_array($this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_options']]))
			{
				$item_options = NULL;
				foreach($this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_options']] as $option => $value)
				{
					// Include the array key as a suffix to the value if required.
					$item_options .= ($include_keys) ? $option.': '.$value : $value;
					
					// Set the character(s) to separate options.
					$item_options .= $option_separator;
				}
				$item_options = rtrim($item_options, $option_separator);
			}
			else
			{
				$item_options = $this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_options']];
			}
			
			return $item_options;
		}
		
		return FALSE;
	}
	
	/**
	 * item_options_array
	 * Returns an array of an items options for a specific row.
	 */
	public function item_options_array($row_id = FALSE)
	{
		return ($this->item_option_status($row_id)) ? 
			(array)$this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_options']] : array();
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM REWARD POINTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * item_reward_points
	 * Returns an items reward points for a specific row.
	 */
	public function item_reward_points($row_id = FALSE, $format = TRUE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$array_reward_points = $this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_reward_points']];
		
			// Get items absolute array value.
			if ($array_reward_points !== FALSE && $array_reward_points >= 0)
			{
				$item_reward_points = $array_reward_points;
			}
			// If items reward points have been voided by a discount.
			else if (in_array($row_id, $this->CI->flexi->cart_contents['settings']['discounts']['data']['void_reward_point_items']) || 
				$this->CI->flexi->cart_contents['summary']['total_reward_points'] == 0)
			{
				$item_reward_points = 0;
			}
			else
			{
				$item_reward_points = $this->calculate_reward_points($this->item_price($row_id, FALSE, FALSE, TRUE));;
			}
			
			return $this->format_number($item_reward_points, $format, 0);
		}
		
		return FALSE;
	}

	/**
	 * item_reward_points_total
	 * Returns an items total reward points for a specific row.
	 */
	public function item_reward_points_total($row_id = FALSE, $format = TRUE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$item_reward_points = $this->item_reward_points($row_id, FALSE);
			$item_reward_points_total = round($item_reward_points * $this->item_quantity($row_id, FALSE));

			return $this->format_number($item_reward_points_total, $format, 0);
		}
		
		return FALSE;
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM WEIGHT
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * item_weight
	 * Returns an items weight for a specific row.
	 * The weight value can be converted into different weight unit types by submitting a value to '$weight_type'.
	 * Available weight types are 'gram', 'kilogram', 'avoir_ounce', 'avoir_pound', 'troy_ounce', 'troy_pound' and 'carat'.
	 */
	public function item_weight($row_id = FALSE, $weight_type = FALSE, $format = TRUE, $decimals = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$item_weight = $this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_weight']];
		
			return $this->convert_weight($item_weight, FALSE, $weight_type, $format, $decimals);
		}
		
		return FALSE;
	}
	
	/**
	 * item_weight_total
	 * Returns an items total weight for a specific row.
	 * The weight value can be converted into different weight unit types by submitting a value to '$weight_type'.
	 * Available weight types are 'gram', 'kilogram', 'avoir_ounce', 'avoir_pound', 'troy_ounce', 'troy_pound' and 'carat'.
	 */
	public function item_weight_total($row_id = FALSE, $weight_type = FALSE, $format = TRUE, $decimals = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$item_weight = $this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_weight']];
			
			$item_weight_total = ($item_weight * $this->item_quantity($row_id, FALSE));
		
			return $this->convert_weight($item_weight_total, FALSE, $weight_type, $format, $decimals);
		}
		
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM DISCOUNTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * item_discount_status
	 * Returns whether an item has a discount applied for a specific row.
	 * The '$include_shipping_discount' parameter can be set to inc/exclude item shipping discounts.
	 */
	public function item_discount_status($row_id = FALSE, $include_shipping_discount = FALSE)
	{
		if ($include_shipping_discount)
		{
			return (isset($this->CI->flexi->cart_contents['settings']['discounts']['active_items'][$row_id]) &&
				! $this->CI->flexi->cart_contents['settings']['discounts']['active_items'][$row_id]['shipping_discount']);
		}
		else
		{
			return (isset($this->CI->flexi->cart_contents['settings']['discounts']['active_items'][$row_id]));
		}
	}

	###+++++++++++++++++++++++++++++++++###
	
	/**
	 * item_discount_data
	 * Returns an array of discount values and descriptions for a specific cart row.
	 */
	public function item_discount_data($row_id = FALSE, $format = TRUE, $internal_value = FALSE)
	{	
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			return $this->get_active_discounts('active_items', $row_id, $format, $internal_value);
		}
		
		return FALSE;
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * item_discount_id
	 * Returns the id of any discount that may have been applied to the item of a specific row.
	 */
	public function item_discount_id($row_id = FALSE)
	{
		return ($this->item_discount_status($row_id)) ?
			$this->CI->flexi->cart_contents['settings']['discounts']['active_items'][$row_id]['id'] : FALSE;
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * item_discount_description
	 * Returns a description of a discount that may have been applied to the item of a specific row.
	 */
	public function item_discount_description($row_id = FALSE)
	{
		return ($this->item_discount_status($row_id)) ?
			$this->CI->flexi->cart_contents['settings']['discounts']['active_items'][$row_id]['description'] : FALSE;
	}
	
	###+++++++++++++++++++++++++++++++++###
	
	/**
	 * item_non_discount_quantity
	 * Returns the quantity of non-discounted items for a specific row. 
	 */
	public function item_non_discount_quantity($row_id = FALSE, $format = TRUE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$item_non_discount_quantity = ($this->item_discount_status($row_id)) ? 
				$this->CI->flexi->cart_contents['settings']['discounts']['active_items'][$row_id]['non_discount_quantity'] :
				$this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_quantity']];
			
			return $this->format_number($item_non_discount_quantity, $format, $this->CI->flexi->cart_contents['settings']['configuration']['quantity_decimals']);
		}
		
		return FALSE;
	}
	
	/**
	 * item_discount_quantity
	 * Returns the quantity of discounted items for a specific row. 
	 */
	public function item_discount_quantity($row_id = FALSE, $format = TRUE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$item_discount_quantity = ($this->item_discount_status($row_id)) ? 
				$this->CI->flexi->cart_contents['settings']['discounts']['active_items'][$row_id]['discount_quantity'] : 0;
				
			return $this->format_number($item_discount_quantity, $format, $this->CI->flexi->cart_contents['settings']['configuration']['quantity_decimals']);
		}
		
		return FALSE;
	}

	###+++++++++++++++++++++++++++++++++###

	/**
	 * item_discount_price
	 * Returns the discount price of one item for a specific row.
	 * Acts as an alias of the 'item_price()' function with the include discount argument set as TRUE.
	 */
	public function item_discount_price($row_id = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		return $this->item_price($row_id, TRUE, $format, $internal_value);
	}
	
	/**
	 * item_discount_total
	 * Returns the total value of all discounted items only (non discounted items are excluded) for a specific row.
	 */
	public function item_discount_total($row_id = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$discounted_price_total = ($this->item_price($row_id, TRUE, FALSE, $internal_value) * $this->item_discount_quantity($row_id));
			
			return $this->format_currency($discounted_price_total, $format, 2, $internal_value);
		}
		
		return FALSE;
	}
		
	/**
	 * item_discount_price_total
	 * Returns the total price of a rows non-discounted and discounted items.
	 * Acts as an alias of the 'item_price_total()' function with the include discount argument set as 'TRUE'.
	 */
	public function item_discount_price_total($row_id = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		return $this->item_price_total($row_id, TRUE, $format, $internal_value);
	}
	
	/**
	 * item_non_discount_price_total
	 * Returns the total price of a rows non-discounted items.
	 */
	public function item_non_discount_price_total($row_id = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$non_discounted_price_total = ($this->item_price($row_id, FALSE, FALSE, $internal_value) * $this->item_quantity($row_id, FALSE));
			
			return $this->format_currency($non_discounted_price_total, $format, 2, $internal_value);	
		}
		
		return FALSE;
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * item_savings
	 * Returns the savings value of a discount applied to one item from a specific row.
	 */
	public function item_savings($row_id = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$non_discount_price = $this->item_price($row_id, FALSE, FALSE, $internal_value);
			$discount_price = $this->item_price($row_id, TRUE, FALSE, $internal_value);
			
			return $this->format_currency(($non_discount_price - $discount_price), $format, 2, $internal_value);
		}
		
		return FALSE;
	}

	/**
	 * item_savings_total
	 * Returns the total savings value of a discount applied to a specific row.
	 */
	public function item_savings_total($row_id = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]))
		{
			$non_discount_price_total = $this->item_price_total($row_id, FALSE, FALSE, $internal_value);
			$discount_price_total = $this->item_price_total($row_id, TRUE, FALSE, $internal_value);
			
			return $this->format_currency(($non_discount_price_total - $discount_price_total), $format, 2, $internal_value);
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM STATUS MESSAGES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * item_status_message
	 * Returns an items status message formatted as a string, for a specific row.
	 * '$css_class' will create the message inside a css formatted html <span> element.
	 */
	public function item_status_message($row_id = FALSE, $css_class = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id]) && 
			count($this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_status_message']]) !== 0)
		{
			// Loop through each message adding a html line break after each.
			foreach($this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_status_message']] as $message)
			{
				$item_status_messages = $message.'<br/>';
			}
			
			// Append a html <span> with the submitted css class.
			return ($css_class) ? '<span class="'.$css_class.'">'.rtrim($item_status_messages, '<br/>').'</span>' : rtrim($item_status_messages, '<br/>');
		}
		
		return FALSE;
	}
	
	/**
	 * item_status_message_array
	 * Returns an items status message formatted as an array, for a specific row.
	 * Item status messages are generated for 'stock' and 'shipping_ban' messages.
	 */
	public function item_status_message_array($row_id = FALSE)
	{
		return (isset($this->CI->flexi->cart_contents['items'][$row_id]) && 
			count($this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_status_message']]) > 0) ? 
			$this->CI->flexi->cart_contents['items'][$row_id][$this->CI->flexi->cart_columns['item_status_message']] : array();
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MISC. ITEM FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_item_column
	 * Returns the value of any set column name including user defined data for a specific row.
	 * Optionally, the returned data can be formatted and converted to a currency if it is a price based value.
	 */
	public function get_item_column($row_id = FALSE, $column_name = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if (isset($this->CI->flexi->cart_contents['items'][$row_id][$column_name]))
		{
			$item_column = $this->CI->flexi->cart_contents['items'][$row_id][$column_name];
			
			// If column is a currency value.
			if (is_numeric($item_column) && $format)
			{
				if (! $internal_value)
				{
					$item_column = $this->convert_to_cart_currency($item_column);
				}
				
				return $this->format_currency($item_column, $format, 2, $internal_value);
			}
			else
			{
				return $item_column;
			}
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM ADMIN DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * item_admin_data_status
	 * Returns whether an item contains any 'admin data' in the cart data array, loaded from the 'load_cart_data()' function with the '$set_admin_data' argument set to TRUE.
	 */
	public function item_admin_data_status($row_id = FALSE)
	{
		return (isset($this->CI->flexi->cart_contents['settings']['admin_data']['items'][$row_id]));
	}
	
	/**
	 * item_shipped_quantity
	 * Returns the quantity of items that have been shipped for an item within a confirmed order. 
	 * The 'shipped' quantity refers to the 'item_quantity_shipped' column in the order details table and is only available when the cart data from a saved order 
	 * has been loaded using the 'load_cart_data()' function with the '$set_admin_data' argument set to TRUE.
	 */
	public function item_shipped_quantity($row_id = FALSE, $format = TRUE)
	{
		$item_shipped_quantity = (isset($this->CI->flexi->cart_contents['settings']['admin_data']['items'][$row_id])) ? 
			$this->CI->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['item_quantity_shipped'] : 0;
		
		return $this->format_number($item_shipped_quantity, $format, $this->CI->flexi->cart_contents['settings']['configuration']['quantity_decimals']);
	}
	
	/**
	 * item_cancelled_quantity
	 * Returns the quantity of items that have been cancelled for an item within a confirmed order. 
	 * The 'cancelled' quantity refers to the 'item_quantity_cancelled' column in the order details table and is only available when the cart data from a saved order 
	 * has been loaded using the 'load_cart_data()' function with the '$set_admin_data' argument set to TRUE.
	 */
	public function item_cancelled_quantity($row_id = FALSE, $format = TRUE)
	{
		$item_cancelled_quantity = (isset($this->CI->flexi->cart_contents['settings']['admin_data']['items'][$row_id])) ? 
			$this->CI->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['item_quantity_cancelled'] : 0;
		
		return $this->format_number($item_cancelled_quantity, $format, $this->CI->flexi->cart_contents['settings']['configuration']['quantity_decimals']);
	}	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOCATION
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * locations_tiered
	 * Gets all current active locations and formats them into an array, grouped into each locations respective location type.
	 * This data can then be used to create a tiered group of HTML select menus listing all available locations group by each location type.
	 */
	public function locations_tiered()
	{
		return $this->CI->flexi_cart_lite_model->locations_tiered();
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * locations_inline
	 * Gets all current active locations and formats them into an array.
	 * Each row in the array contains an ID of the location and a concatenated string of the location and any higher tiered locations.
	 * Example: array('18' => 'United States > New York > 10101')
	 * This data can then be used to create a single HTML select menu listing all available locations.
	 */
	public function locations_inline($separator = ' > ')
	{
		return $this->CI->flexi_cart_lite_model->locations_inline($separator);
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * location_zones
	 * Gets all current active location zones and formats them into an array.
	 * By submitting either 'shipping' or 'tax' as the zone type, the function will return only zones that have shipping or tax locations related to them.
	 */
	public function location_zones($zone_type = FALSE)
	{
		return $this->CI->flexi_cart_lite_model->location_zones($zone_type);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SHIPPING
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * shipping_id
	 * Returns the current shipping option id.
	 */
	public function shipping_id()
	{
		return $this->CI->flexi->cart_contents['settings']['shipping']['id'];
	}
	
	/**
	 * shipping_name
	 * Returns the current shipping option name.
	 */
	public function shipping_name()
	{
		return $this->CI->flexi->cart_contents['settings']['shipping']['name'];
	}

	/**
	 * shipping_description
	 * Returns the current shipping option description.
	 */
	public function shipping_description()
	{
		return $this->CI->flexi->cart_contents['settings']['shipping']['description'];
	}

	###+++++++++++++++++++++++++++++++++###

	/**
	 * shipping_location_data
	 * Returns an array of the carts current shipping locations as table ids.
	 */
	public function shipping_location_data()
	{
		return $this->CI->flexi->cart_contents['settings']['shipping']['location'];
	}
	
	/**
	 * match_shipping_location_id
	 * Returns whether a submitted location id is set within the cart shipping location array.
	 * Typically, this can be used to match whether the location id of a html select menu option is present, if so, the option can be selected.
	 * Example: A html select menu lists countries, when the page loads, the menu auto selects the current country the carts shipping location is set as.
	 */
	public function match_shipping_location_id($location_id = FALSE)
	{
		if ($this->CI->flexi_cart_lite_model->is_positive($location_id))
		{
			foreach ($this->shipping_location_data() as $location)
			{
				if ($location_id == $location['location_id'])
				{
					return TRUE;
				}
			}
		}
		
		return FALSE;
	}
	
	/** 
	 * shipping_location_id
	 * Returns the location id of the current shipping location, for a defined location type.
	 * '$location_type_id' is the location types id that is defined in the 'location_type' table.  
	 * The demo database has three types set, 1 => Country, 2 => State and 3 => Post/Zip Code.
	 */
	public function shipping_location_id($location_type_id = 1)
	{
		if ($this->CI->flexi_cart_lite_model->is_positive($location_type_id))
		{
			foreach($this->shipping_location_data() as $location)
			{
				if ($location_type_id == $location['type_id'])
				{
					return $location['location_id'];
				}
			}
		}
		
		return FALSE;		
	}
	
	/**
	 * shipping_location_name
	 * Returns the location name of the current shipping location, for a defined location type.
	 * '$location_type_id' is the location types id that is defined in the 'location_type' table.  
	 * The demo database has three types set, 1 => Country, 2 => State and 3 => Post/Zip Code.
	 */
	public function shipping_location_name($location_type_id = 1)
	{
		if ($this->CI->flexi_cart_lite_model->is_positive($location_type_id))
		{
			foreach ($this->shipping_location_data() as $location)
			{
				if ($location_type_id == $location['type_id'])
				{
					return $location['name'];
				}
			}
		}
		
		return FALSE;
	}

	###+++++++++++++++++++++++++++++++++###
	
	/**
	 * location_shipping_status
	 * Returns whether items in the cart are permitted to be shipped to the current shipping location.
	 * '$check_all_items_permitted' defines whether to check that every item in the cart is permitted, or whether at least 1 item in the cart is permitted.
	 */
	public function location_shipping_status($check_all_items_permitted = TRUE)
	{
		if ($check_all_items_permitted)
		{
			return (empty($this->CI->flexi->cart_contents['settings']['shipping']['data']['banned_shipping_items']));		
		}
		else
		{
			return (count($this->CI->flexi->cart_contents['settings']['shipping']['data']['banned_shipping_items']) != count($this->CI->flexi->cart_contents['items']));
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TAX
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * tax_name
	 * Returns the name of the current tax(Example 'VAT', 'GST' etc.).
	 */
	public function tax_name()
	{
		return $this->CI->flexi->cart_contents['settings']['tax']['name'];
	}

	/**
	 * tax_rate
	 * Returns the rate of the current tax. 
	 * The rate is by default formatted to suffix a '%' symbol on the end, this can be omitted by submitting FALSE.
	 * The carts internal tax rate can be returned submitting $internal_value as TRUE. 
	 */
	public function tax_rate($suffix_delimiter = '%', $internal_value = FALSE)
	{
		$tax_rate = (! $internal_value) ? 
			$this->CI->flexi->cart_contents['settings']['tax']['rate'] : $this->CI->flexi->cart_contents['settings']['tax']['internal_rate'];
		
		return round($tax_rate, 4).$suffix_delimiter;
	}

	###+++++++++++++++++++++++++++++++++###
		
	/**
	 * tax_location_data
	 * Returns an array of the carts current tax locations as table ids.
	 */
	public function tax_location_data()
	{
		return $this->CI->flexi->cart_contents['settings']['tax']['location'];
	}

	/**
	 * match_tax_location_id
	 * Returns whether a submitted location id is set within the cart tax location array.
	 * Typically, this can be used to match whether the location id of a html select menu option is present, if so, the option can be selected.
	 * Example: A html select menu lists countries, when the page loads, the menu auto selects the current country the carts tax location is set as.
	 */
	public function match_tax_location_id($location_id = FALSE)
	{
		if ($location_id)
		{
			foreach ($this->tax_location_data() as $location)
			{
				if ($location_id == $location['location_id'])
				{
					return TRUE;
				}
			}
		}
		
		return FALSE;
	}
	
	/** 
	 * tax_location_id
	 * Returns the location id of the current tax location.
	 * '$location_type_id' is the location types database id that is defined in the 'location_type' table.  
	 * The demo database has three types set, 1 => Country, 2 => State and 3 => Postal Code.
	 */
	public function tax_location_id($location_type_id = FALSE)
	{
		if ($this->CI->flexi_cart_lite_model->is_positive($location_type_id))
		{
			foreach($this->tax_location_data() as $location)
			{
				if ($location_type_id == $location['type_id'])
				{
					return $location['location_id'];
				}
			}
		}
		
		return FALSE;		
	}
	
	/**
	 * tax_location_name
	 * Returns the location name of the current tax location.
	 * '$location_type_id' is the location types database id that is defined in the 'location_type' table.  
	 * The demo database has three types set, 1 => Country, 2 => State and 3 => Postal Code.
	 */
	public function tax_location_name($location_type_id = 1)
	{
		if ($this->CI->flexi_cart_lite_model->is_positive($location_type_id))
		{
			foreach ($this->tax_location_data() as $location)
			{
				if ($location_type_id == $location['type_id'])
				{
					return $location['name'];
				}
			}
		}
		
		return FALSE;
	}
	
	###+++++++++++++++++++++++++++++++++###

	/**
	 * display_prices_inc_tax
	 * Returns whether the user is currently viewing prices including tax.
	 */
	public function display_prices_inc_tax()
	{
		return (bool)$this->CI->flexi->cart_contents['settings']['configuration']['display_tax_prices'];
	}
	
	/**
	 * cart_prices_inc_tax
	 * Returns whether the cart is setup by default to handle and display all prices as including tax.
	 */
	public function cart_prices_inc_tax()
	{
		return (bool)$this->CI->flexi->cart_contents['settings']['configuration']['price_inc_tax'];
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	// DISCOUNTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * item_summary_discount_data
	 * Returns an array of discount values and descriptions for all item rows.
	 */
	public function item_summary_discount_data($format = TRUE, $internal_value = FALSE)
	{	
		return $this->get_active_discounts('active_items', FALSE, $format, $internal_value);
	}
	
	/**
	 * summary_discount_data
	 * Returns an array of discount values and descriptions for either a particular summary column ('$summary_column' must be set), or all summary columns.
	 * Valid columns names are 'item_summary_total', 'shipping_total' and 'total'.
	 */
	public function summary_discount_data($summary_column = FALSE, $format = TRUE, $internal_value = FALSE)
	{	
		return $this->get_active_discounts('active_summary', $summary_column, $format, $internal_value);
	}
	
	/**
	 * get_active_discounts
	 * Returns an array of discount values and descriptions for item and summary columns.
	 * A particular column can be return by submitting a valid '$target' summary name or item row id.
	 */
	private function get_active_discounts($discount_type = FALSE, $target = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if ($target)
		{
			if (isset($this->CI->flexi->cart_contents['settings']['discounts'][$discount_type][$target]))
			{
				$target_discount = $this->CI->flexi->cart_contents['settings']['discounts'][$discount_type][$target];
			
				return array($target => 
					array(
						'id' => $target_discount['id'],
						'code' => $target_discount['code'],
						'description' => $target_discount['description'],
						'value' => $this->format_currency($target_discount['value'], $format, 2, $internal_value),
					)
				);
			}
			
			return array();
		}
		else
		{
			$discount_data = array();
			foreach($this->CI->flexi->cart_contents['settings']['discounts'][$discount_type] as $discount_id => $discount)
			{
				// Check discount data is not a reward voucher.
				if ($discount_id != 'reward_vouchers')
				{
					if (! $internal_value)
					{
						$discount['value'] = $this->convert_to_cart_currency($discount['value'], $discount['tax_value']);
					}

					$discount_data[$discount_id]['id'] = $discount['id'];
					$discount_data[$discount_id]['code'] = $discount['code'];		
					$discount_data[$discount_id]['description'] = $discount['description'];		
					$discount_data[$discount_id]['value'] = $this->format_currency($discount['value'], $format, 2, $internal_value);
				}
			}

			return $discount_data;
		}
	}

	/**
	 * discount_status
	 * Returns whether a discount has been applied to the cart.
	 */
	public function discount_status()
	{
		return (! empty($this->CI->flexi->cart_contents['settings']['discounts']['active_items']) || 
			! empty($this->CI->flexi->cart_contents['settings']['discounts']['active_summary']));
	}

	/**
	 * item_summary_discount_status
	 * Returns whether any item discounts have been applied to the cart.
	 */
	public function item_summary_discount_status()
	{
		return (! empty($this->CI->flexi->cart_contents['settings']['discounts']['active_items']));
	}

	/**
	 * summary_discount_status
	 * Returns whether any summary discounts have been applied to the cart.
	 */
	public function summary_discount_status()
	{
		return (! empty($this->CI->flexi->cart_contents['settings']['discounts']['active_summary']));
	}
	
	/**
	 * discount_codes
	 * Returns an array of discount codes that have been applied to the cart, regardless of whether they are currently active or not.
	 */
	public function discount_codes()
	{
		return (isset($this->CI->flexi->cart_contents['settings']['discounts']['codes'])) ? 
			$this->CI->flexi->cart_contents['settings']['discounts']['codes'] : FALSE;	
	}

	/**
	 * excluded_discounts
	 * Returns the ids on all discounts that have been manually excluded.
	 */
	public function excluded_discounts()
	{
		return $this->CI->flexi->cart_contents['settings']['discounts']['data']['excluded_discounts'];
	}

	/**
	 * get_discount_requirements
	 * Returns an array containing the quantity and value required to activate a specific discount.
	 *	Note: The 'discounts' table must be enabled via the config file.
	 */
	public function get_discount_requirements($discount_id = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if ($discount_data = $this->CI->flexi_cart_lite_model->get_discount_requirements($discount_id))
		{		
			$discount_data['value_required'] = $this->format_currency($discount_data['value_required'], $format, 2, $internal_value);
			$discount_data['value'] = $this->format_currency($discount_data['value'], $format, 2, $internal_value);
			
			return $discount_data;
		}
		
		return FALSE;
	}
	
	/**
	 * get_item_discounts
	 * Looks-up discounts that are available for a specific item.
	 * Custom SQL SELECT and WHERE statements can be submitted, by default, only active discounts are returned.
	 * Note: The 'discounts' table must be enabled via the config file.
	 */
	public function get_item_discounts($item_id = FALSE, $sql_select = FALSE, $sql_where = FALSE)
	{
		if ($item_discount_data = $this->CI->flexi_cart_lite_model->get_item_discounts($item_id, $sql_select, $sql_where))
		{
			// Loop through data and change true/false columns from integers to boolean.
			foreach($item_discount_data as $i => $discount_data)
			{
				if (isset($discount_data[$this->CI->flexi->cart_database['discounts']['columns']['custom_status_1']]))
				{
					$item_discount_data[$i][$this->CI->flexi->cart_database['discounts']['columns']['custom_status_1']] = 
						$discount_data[$this->CI->flexi->cart_database['discounts']['columns']['custom_status_1']];
				}

				if (isset($discount_data[$this->CI->flexi->cart_database['discounts']['columns']['custom_status_2']]))
				{
					$item_discount_data[$i][$this->CI->flexi->cart_database['discounts']['columns']['custom_status_2']] = 
						$discount_data[$this->CI->flexi->cart_database['discounts']['columns']['custom_status_2']];
				}

				if (isset($discount_data[$this->CI->flexi->cart_database['discounts']['columns']['custom_status_3']]))
				{
					$item_discount_data[$i][$this->CI->flexi->cart_database['discounts']['columns']['custom_status_3']] = 
						$discount_data[$this->CI->flexi->cart_database['discounts']['columns']['custom_status_3']];
				}

				if (isset($discount_data[$this->CI->flexi->cart_database['discounts']['columns']['non_combinable']]))
				{
					$item_discount_data[$i][$this->CI->flexi->cart_database['discounts']['columns']['non_combinable']] = 
						(bool)$discount_data[$this->CI->flexi->cart_database['discounts']['columns']['non_combinable']];
				}
			}
		}
		
		return (! empty($item_discount_data)) ? $item_discount_data : array();	
	}
	
	/**
	 * get_saving_value
	 * Calculates the difference between two monetary values.
	 */
	public function get_saving_value($new_value = 0, $original_value = 0, $format = TRUE)
	{
		return $this->format_currency(($original_value - $new_value), $format);
	}
	
	/**
	 * get_saving_percentage
	 * Calculates the percentage difference between two monetary values.
	 */
	public function get_saving_percentage($new_value = 0, $original_value = 0, $suffix_delimiter = '%', $decimals = 0)
	{
		$saving_percentage = number_format(((($original_value - $new_value) / $original_value) * 100), $decimals);
	
		return ($suffix_delimiter) ? $saving_percentage.$suffix_delimiter : $saving_percentage;
	}
	
	/**
	 * get_expire_time
	 * Returns the time until a submitted date will expire.
	 * The returned value is a UNIX timestamp.
	 */
	public function get_expire_time($expire_date = FALSE)
	{
		return $this->CI->flexi_cart_lite_model->database_date_time(-time(), $expire_date, TRUE);
	}
	
	###+++++++++++++++++++++++++++++++++###
	
	/**
	 * item_summary_discount_description
	 * Returns a formatted string of all item discount descriptions.
	 * The value of each discount can be added to the end of each line by submitting a '$value_prefix' character(s),
	 * '$value_prefix = FALSE' will omit the discount value from descriptions.
	 * '$prefix_delimiter' will prefix a character(s) to the start of each line, '$suffix_delimiter' will suffix a character(s) to the end of each line.
	 */
	public function item_summary_discount_description($value_prefix = FALSE, $prefix_delimiter = FALSE, $suffix_delimiter = '<br/>', $internal_value = FALSE)
	{
		$description_data = $this->CI->flexi->cart_contents['settings']['discounts']['active_items'];
	
		return $this->get_data_description($description_data, $value_prefix, $prefix_delimiter, $suffix_delimiter, $internal_value);
	}
	
	/**
	 * summary_discount_description
	 * Returns a formatted string of all summary discount descriptions.
	 * The value of each discount can be added to the end of each line by submitting a '$value_prefix' character(s),
	 * '$value_prefix = FALSE' will omit the discount value from descriptions.
	 * '$prefix_delimiter' will prefix a character(s) to the start of each line, '$suffix_delimiter' will suffix a character(s) to the end of each line.
	 */
	public function summary_discount_description($value_prefix = FALSE, $prefix_delimiter = FALSE, $suffix_delimiter = '<br/>', $internal_value = FALSE)
	{
		$description_data = $this->CI->flexi->cart_contents['settings']['discounts']['active_summary'];
	
		return $this->get_data_description($description_data, $value_prefix, $prefix_delimiter, $suffix_delimiter, $internal_value);
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// REWARD POINTS AND VOUCHERS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * reward_voucher_status
	 * Return whether any reward vouchers have been applied to the cart.
	 */
	public function reward_voucher_status()
	{
		return (! empty($this->CI->flexi->cart_contents['settings']['discounts']['reward_vouchers']));
	}

	/**
	 * reward_voucher_data
	 * Returns an array of all reward voucher values and descriptions.
	 */
	public function reward_voucher_data($format = TRUE, $internal_value = FALSE)
	{	
		$voucher_data = array();
		$i = 0;
		foreach($this->CI->flexi->cart_contents['settings']['discounts']['reward_vouchers'] as $voucher)
		{
			if (! $internal_value)
			{
				$voucher_data[$i]['value'] = $this->convert_to_cart_currency($voucher['value'], $voucher['tax_value']);
			}

			$voucher_data[$i]['id'] = $voucher['id'];
			$voucher_data[$i]['code'] = $voucher['code'];
			$voucher_data[$i]['description'] = $voucher['description'];
			$voucher_data[$i]['value'] = $this->format_currency($voucher['value'], $format, 2, $internal_value);
			$i++;
		}
		
		return $voucher_data;
	}
	
	/**
	 * reward_voucher_description
	 * Returns a formatted string of all reward voucher descriptions.
	 * The value of each reward voucher can be added to the end of each line by submitting a '$value_prefix' character(s), 
	 * '$value_prefix = FALSE' will omit the reward voucher value.
	 * '$prefix_delimiter' will prefix a character(s) to the start of each line, '$suffix_delimiter' will suffix a character(s) to the end of each line.
	 */
	public function reward_voucher_description($value_prefix = FALSE, $prefix_delimiter = FALSE, $suffix_delimiter = '<br/>', $internal_value = FALSE)
	{
		$description_data = $this->CI->flexi->cart_contents['settings']['discounts']['reward_vouchers'];
	
		return $this->get_data_description($description_data, $value_prefix, $prefix_delimiter, $suffix_delimiter, $internal_value);
	}
	
	/**
	 * reward_point_multiplier
	 * Returns the reward point multiplier that is used to calculate the number of reward points earnt per 1 unit of currency (i.e £1.00).
	 */
	public function reward_point_multiplier()
	{
		return $this->CI->flexi->cart_contents['settings']['configuration']['reward_point_multiplier'];
	}
	
	/**
	 * calculate_reward_points
	 * Returns the number of reward points that would be earnt from a submitted currency value.
	 */
	public function calculate_reward_points($value = 0)
	{
		return round($value * $this->CI->flexi->cart_contents['settings']['configuration']['reward_point_multiplier']);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	// SURCHARGE DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * surcharge_status
	 * Returns whether a surcharge has been applied to the cart.
	 */
	public function surcharge_status()
	{
		return (! empty($this->CI->flexi->cart_contents['settings']['surcharges']));
	}
	
	/**
	 * surcharge_data
	 * Returns an array of surcharge values and descriptions for either a particular surcharge ('$surcharge_id' must be set), or all surcharges.
	 */
	public function surcharge_data($surcharge_id = FALSE, $format = TRUE, $internal_value = FALSE)
	{
		if ($surcharge_id)
		{
			if (isset($this->CI->flexi->cart_contents['settings']['surcharges'][$surcharge_id]))
			{
				$target_surcharge = $this->CI->flexi->cart_contents['settings']['surcharges'][$surcharge_id];
			
				return array($surcharge_id => 
					array(
						'id' => $surcharge_id,
						'value' => $this->format_currency($target_surcharge['value'], $format, 2, $internal_value),
						'description' => $target_surcharge['description']
					)
				);
			}
			
			return array();
		}
		else
		{
			$surcharge_data = array();
			foreach($this->CI->flexi->cart_contents['settings']['surcharges'] as $surcharge_id => $surcharge)
			{
				if (! $internal_value)
				{
					$surcharge['value'] = $this->convert_to_cart_currency($surcharge['value'], $surcharge['tax_value']);
				}
				
				$surcharge_data[$surcharge_id]['id'] = $surcharge_id;
				$surcharge_data[$surcharge_id]['value'] = $this->format_currency($surcharge['value'], $format, 2, $internal_value);
				$surcharge_data[$surcharge_id]['description'] = $surcharge['description'];			
			}
			
			return $surcharge_data;
		}
	}
	
	/**
	 * surcharge_description
	 * Returns surcharge values and descriptions formatted as a string.
	 * The value of each surcharge can be added to the end of each line by submitting a '$value_prefix' character(s), 
	 * '$value_prefix = FALSE' will omit the surcharge value.
	 * '$prefix_delimiter' will prefix a character(s) to the start of each line, '$suffix_delimiter' will suffix a character(s) to the end of each line.
	 */
	public function surcharge_description($value_prefix = FALSE, $prefix_delimiter = FALSE, $suffix_delimiter = '<br/>', $internal_value = FALSE)
	{
		$description_data = $this->CI->flexi->cart_contents['settings']['surcharges'];
	
		return $this->get_data_description($description_data, $value_prefix, $prefix_delimiter, $suffix_delimiter, $internal_value);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CURRENCY
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * currency_name
	 * Returns the currency name (Example USD, EURO, GBP, AUD) of either the current or internal currency.
	 */
	public function currency_name($internal_value = FALSE)
	{
		return (! $internal_value) ? $this->CI->flexi->cart_contents['settings']['currency']['name'] : 
			$this->CI->flexi->cart_contents['settings']['currency']['default']['name'];
	}
	
	/**
	 * currency_symbol
	 * Returns the currency symbol (Example $, €, £) for the users current currency.
	 * If '$internal_value = TRUE', the symbol for the internal currency will be returned.
	 */
	public function currency_symbol($internal_value = FALSE)
	{
		return $this->get_currency_symbol($internal_value, FALSE);
	}
	
	/**
	 * get_currency_symbol
	 * Returns the currency symbol (Example $, €, £) of a specified currency.
	 * If '$currency_name' is submitted, the symbol for the submitted currency will be returned.
	 * If '$internal_value = TRUE', the symbol for the internal currency will be returned.
	 * Note: The 'currency' table must be enabled via the config file.
	 */
	public function get_currency_symbol($internal_value = FALSE, $currency_name = FALSE)
	{
		if ($currency_name && ! $internal_value)
		{
			$sql_select = $this->CI->flexi->cart_database['currency']['columns']['symbol'];
			
			$sql_where = array(
				$this->CI->flexi->cart_database['currency']['columns']['name'] => $currency_name,
				$this->CI->flexi->cart_database['currency']['columns']['status'] => 1
			);
			
			$currency_data = $this->CI->flexi_cart_lite_model->get_currency_data($sql_select, $sql_where, TRUE);
			
			if (! empty($currency_data))
			{
				return $currency_data[$this->CI->flexi->cart_database['currency']['columns']['symbol']];
			}
		}
		
		if ($internal_value)
		{
			return $this->CI->flexi->cart_contents['settings']['currency']['default']['symbol'];
		}
		else
		{
			return $this->CI->flexi->cart_contents['settings']['currency']['symbol'];
		}
	}
	
	/**
	 * exchange_rate
	 * Returns the exchange rate of the users current currency in comparison to the sites internal currency.
	 */
	public function exchange_rate($decimals = 4)
	{
		return $this->get_exchange_rate(FALSE, $decimals);
	}
	
	/**
	 * get_exchange_rate
	 * Returns the exchange rate of a submitted currency in comparison to the sites internal currency.
	 * Note: The 'currency' table must be enabled via the config file.
	 */
	public function get_exchange_rate($currency_name = FALSE, $decimals = 4)
	{
		if ($currency_name)
		{
			$sql_select = $this->CI->flexi->cart_database['currency']['columns']['exchange_rate'];
			
			$sql_where = array(
				$this->CI->flexi->cart_database['currency']['columns']['name'] => $currency_name,
				$this->CI->flexi->cart_database['currency']['columns']['status'] => 1
			);
			
			$currency_data = $this->CI->flexi_cart_lite_model->get_currency_data($sql_select, $sql_where, TRUE);
		}

		$exchange_rate = (! empty($currency_data)) ? 
			$currency_data[$this->CI->flexi->cart_database['currency']['columns']['exchange_rate']] :
			$this->CI->flexi->cart_contents['settings']['currency']['exchange_rate'];
		
		return number_format($exchange_rate, $decimals);		
	}
	
	###+++++++++++++++++++++++++++++++++###
		
	/**
	 * get_currency_data
	 * Returns an array of currency data from the currency table.
	 * Custom SQL SELECT and WHERE statements can be submitted, by default, only active currencies are returned.
	 * Note: The 'currency' table must be enabled via the config file.
	 */
	public function get_currency_data($sql_select = FALSE, $sql_where = FALSE)
	{
		return $this->CI->flexi_cart_lite_model->get_currency_data($sql_select, $sql_where, FALSE);
	}

	###+++++++++++++++++++++++++++++++++###
	
	/**
	 * convert_to_cart_currency
	 * Converts any value from the cart default currency to the users current currency. 
	 * For cart item values, the items own tax value (if set) can also be submitted.
	 * This function takes into account whether the user is viewing pricing ex/including tax and converts accordingly.
	 */
	private function convert_to_cart_currency($value = 0, $tax_value = FALSE)
	{
		// If value INCLUDES tax by default, but user is viewing prices WITHOUT tax, then remove tax from value.
		if ($this->cart_prices_inc_tax() && ! $this->display_prices_inc_tax())
		{
			$value -= $tax_value;
		}
		// Else if value EXCLUDES tax by default, but user is viewing prices WITH tax, then add tax to value.
		else if (! $this->cart_prices_inc_tax() && $this->display_prices_inc_tax())
		{
			$value += $tax_value;
		}
		 
		// Calculate value against Exchange Rate.
		return ($value * $this->exchange_rate());
	}
	
	/**
	 * get_currency_value
	 * Converts any value from a a specified currency to the carts internal currency or vice versa.
	 * The exchange rate for the conversion is taken from either the users current currency, or the currency submitted via '$currency_name'.
	 *
	 * This function is similar to 'get_taxed_currency_value()', with the exception it does NOT check whether cart prices include tax, 
	 * therefore, values are directly converted from one value to another without adding or removing taxes during the conversion.
 	 * Returned values can be formatted to include a currency symbol, decimal and thousand separators correctly.
	 */
	public function get_currency_value($value = 0, $format = TRUE, $decimals = 2, $inverse = FALSE, $currency_name = FALSE)
	{
		// Convert value against exchange rate.
		$converted_value = (! $inverse) ? ($value * $this->get_exchange_rate($currency_name)) : ($value / $this->get_exchange_rate($currency_name));

		return $this->format_currency($converted_value, $format, $decimals, $inverse, $currency_name);
	}

	/**
	 * get_taxed_currency_value
	 * Converts a value from a specified currency to the carts internal currency or vice versa.
	 * 
	 * If internal cart prices INCLUDE tax, and user display prices EXCLUDE tax, then tax will be removed from the value.
	 * If internal cart prices EXCLUDE tax, and user display prices INCLUDE tax, then tax will be added to the value.
	 * If tax settings match, no tax is added or removed.
	 * 
	 * The exchange rate for the conversion is taken from either the users current currency, or the currency submitted via '$currency_name'.
	 * For values with a tax rate differring from the carts tax rate, a tax rate can be submitted.
	 * Returned values can be formatted to include a currency symbol, decimal and thousand separators correctly.
	 */
	public function get_taxed_currency_value($value = 0, $tax_rate = FALSE, $format = TRUE, $decimals = 2, $inverse = FALSE, $currency_name = FALSE)
	{
		$value = $this->convert_tax_value($value, $tax_rate, $inverse);

		// Convert value against exchange rate.
		return $this->get_currency_value($value, $format, $decimals, $inverse, $currency_name);
	}
		
	/**
	 * convert_tax_value
	 * Converts the tax value on a submitted value from either the carts internal tax rate to the users current tax rate, or vice versa.
	 */
	private function convert_tax_value($value = 0, $tax_rate = FALSE, $inverse = FALSE)
	{
		// If cart prices include tax, remove the current tax value.
		if ($this->cart_prices_inc_tax())
		{
			// If no tax rate was submitted.
			if (! $this->CI->flexi_cart_lite_model->non_negative($tax_rate))
			{
				// Get the carts current tax rate if '$inverse = FALSE', else get the internal cart tax rate.
				$remove_tax_rate = ($inverse) ? $this->tax_rate(FALSE) : $this->tax_rate(FALSE, TRUE);
			}
			else
			{
				$remove_tax_rate = $tax_rate;
			}
			
			$value = $this->CI->flexi_cart_lite_model->add_remove_tax($value, $remove_tax_rate, FALSE);
		}

		// If user is viewing prices including tax, get either submitted or current tax rate and add it to value.
		if ($this->display_prices_inc_tax())
		{
			// If no tax rate was submitted.
			if (! $this->CI->flexi_cart_lite_model->non_negative($tax_rate))
			{
				// Get the carts internal tax rate if '$inverse = FALSE', else get the current cart tax rate.
				$tax_rate = ($inverse) ? $this->tax_rate(FALSE, TRUE) : $this->tax_rate(FALSE);
			}
			
			$value = $this->CI->flexi_cart_lite_model->add_remove_tax($value, $tax_rate, TRUE);
		}
		
		return $value;
	}
	
	###+++++++++++++++++++++++++++++++++###
 
	/** 
	 * format_currency
	 * Returns the submitted value formatted to a specified number of decimals using the specified currencies decimal and thousand separators.
	 */
	public function format_currency($value = FALSE, $format = TRUE, $decimals = 2, $internal_format = FALSE, $currency_name = FALSE) 
	{
		return $this->CI->flexi_cart_lite_model->format_value('currency', $value, $format, $decimals, $internal_format, $currency_name, FALSE); 
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART CONFIGURATION
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * cart_data_id
	 * Returns the id of the current cart data array.
	 * The cart id is used to identify cart data that is saved to the database.
	 */
	public function cart_data_id()
	{
		return $this->CI->flexi->cart_contents['settings']['configuration']['cart_data_id'];
	}

	/**
	 * order_number
	 * Returns the current order number.
	 */
	public function order_number()
	{
		return $this->CI->flexi->cart_contents['settings']['configuration']['order_number'];
	}
	
	/**
	 * minimum_order
	 * Returns the minimum order value required for the cart to checkout.
	 */
	public function minimum_order($format = TRUE, $internal_value = FALSE)
	{
		$minimum_order_value = $this->CI->flexi->cart_contents['settings']['configuration']['minimum_order'];
		
		if (! $internal_value)
		{
			$minimum_order_value = $this->convert_to_cart_currency($minimum_order_value);
		}
					
		return $this->format_currency($minimum_order_value, $format, 2, $internal_value);
	}
			
	/**
	 * minimum_order_status
	 * Check a defined cart summary column is equal or more than the minimum required value to checkout.
	 * Valid summary columns are 'item_summary_total', 'shipping_total', 'item_shipping_total' and 'total'.
	 * By default, the carts summary item total column is used.
	 */
	public function minimum_order_status($summary_column = 'item_summary_total', $inc_discount = TRUE)
	{		
		// Get summary column value.
		if ($summary_column == 'item_summary_total')
		{
			$summary_column = $this->item_summary_total($inc_discount, FALSE, TRUE);
		}
		else if ($summary_column == 'shipping_total')
		{
			$summary_column = $this->shipping_total($inc_discount, FALSE, TRUE);
		}
		else if ($summary_column == 'item_shipping_total')
		{
			$summary_column = $this->item_shipping_total($inc_discount, FALSE, TRUE);
		}
		else // 'total' column
		{
			$summary_column = $this->total($inc_discount, FALSE, TRUE);
		}

		return ($summary_column >= $this->minimum_order(FALSE, TRUE));
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MISC FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_date_time
	 * Returns either an SQL DATETIME formatted time stamp or a UNIX timestamp. 
	 * The type of date value returned is based on the value in the config files '$config['settings']['date_time']'.
	 * Additional time can be a added or subtracted from the time by submitting a positive or negative number (in seconds) to '$apply_time'.
	 * If specific time is submitted to '$date_time', the '$apply_time' value will be applied to this value, else it will use the current time.
	 * Even if the config files '$config['settings']['date_time']' has been set to return an SQL DATETIME, a unix timestamp can be returned by submitting '$force_unix = TRUE'.
	 */
	public function get_date_time($apply_time = 0, $date_time = FALSE, $force_unix = FALSE)
	{
		return $this->CI->flexi_cart_lite_model->database_date_time($apply_time, $date_time, $force_unix);
	}
	
	/**
	 * get_weight_types
	 * Returns either an array of data for a specific weight type or a multi-dimensional array all weight types and their data.
	 */
	public function get_weight_types($name = FALSE)
	{
		return $this->CI->flexi_cart_lite_model->get_weight_types($name);
	}
	
	/**
	 * weight_name
	 * Returns the name of the carts default weight type.
	 */
	public function weight_name()
	{
		$weight_data = $this->CI->flexi_cart_lite_model->get_weight_types($this->CI->flexi->cart_contents['settings']['configuration']['weight_type']);
		
		return (isset($weight_data['name'])) ? $weight_data['name'] : FALSE;
	}
	
	/**
	 * weight_symbol
	 * Returns the symbol of the carts default weight type.
	 */
	public function weight_symbol()
	{
		$weight_data = $this->CI->flexi_cart_lite_model->get_weight_types($this->CI->flexi->cart_contents['settings']['configuration']['weight_type']);
		
		return (isset($weight_data['symbol'])) ? $weight_data['symbol'] : FALSE;
	}
	
	/**
	 * convert_weight
	 * Returns a weight converted from one weight type to another.
	 */
	public function convert_weight($value = 0, $convert_from = FALSE, $convert_to = FALSE, $format = TRUE, $decimals = FALSE)
	{
		if (! is_numeric($value))
		{
			return 0;
		}

		$weight_data = $this->CI->flexi_cart_lite_model->get_weight_types();
				
		// Get default weight data if not submitted.
		$convert_from = (! $convert_from) ? $this->CI->flexi->cart_contents['settings']['configuration']['weight_type'] : $convert_from;
		$convert_to = (! $convert_to) ? $this->CI->flexi->cart_contents['settings']['configuration']['weight_type'] : $convert_to;
		$decimals = ($decimals === FALSE) ? $this->CI->flexi->cart_contents['settings']['configuration']['weight_decimals'] : $decimals;
		
		// Calculate weight from the base weight type - grams.
		$gram_value = (isset($weight_data[$convert_from])) ? ($value * $weight_data[$convert_from]['conversion']) : $value;
		$converted_value = (isset($weight_data[$convert_to])) ? ($gram_value / $weight_data[$convert_to]['conversion']) : $gram_value;
		
		return $this->format_weight($converted_value, $convert_to, $format, $decimals);
	}

	/** 
	 * format_number
	 * Returns the submitted value formatted to a specified number of decimals using the specified currencies decimal and thousand separators.
	 */
	public function format_number($value = FALSE, $format = TRUE, $decimals = 0, $internal_format = FALSE, $currency_name = FALSE) 
	{
		return $this->CI->flexi_cart_lite_model->format_value('number', $value, $format, $decimals, $internal_format, $currency_name, FALSE); 
	}
	
	/** 
	 * format_weight
	 * Returns a weight formatted to a specified number of decimals using the set decimal and thousand separators.
	 */
	public function format_weight($value = 0, $weight_type = FALSE, $format = TRUE, $decimals = FALSE, $internal_format = FALSE)
	{
		$decimals = ($decimals === FALSE) ? $this->CI->flexi->cart_contents['settings']['configuration']['weight_decimals'] : $decimals;

		return $this->CI->flexi_cart_lite_model->format_value('weight', $value, $format, $decimals, $internal_format, FALSE, $weight_type); 
	}
	
	###+++++++++++++++++++++++++++++++++###
	
	/**
	 * custom_status_1
	 * Returns the value of custom cart status #1.
	 */
	public function custom_status_1()
	{
		return $this->CI->flexi->cart_contents['settings']['configuration']['custom_status_1'];
	}
	
	/**
	 * custom_status_2
	 * Returns the value of custom cart status #2.
	 */
	public function custom_status_2()
	{
		return $this->CI->flexi->cart_contents['settings']['configuration']['custom_status_2'];
	}
	
	/**
	 * custom_status_3
	 * Returns the value of custom cart status #3.
	 */
	public function custom_status_3()
	{
		return $this->CI->flexi->cart_contents['settings']['configuration']['custom_status_3'];
	}

	###+++++++++++++++++++++++++++++++++###

	/**
	 * get_data_description
	 * Returns a formatted string of either discounts, surcharges or reward vouchers that are active in the cart.
	 */
	private function get_data_description($description_data = FALSE, $value_prefix = FALSE, $prefix_delimiter = FALSE, $suffix_delimiter = '<br/>', $internal_value = FALSE)
	{
		if (! empty($description_data))
		{
			$description = FALSE;
			foreach($description_data as $data)
			{
				$description .= $prefix_delimiter.$data['description'];
				
				if ($value_prefix !== FALSE)
				{
					$value = (! $internal_value) ? $this->convert_to_cart_currency($data['value'], $data['tax_value']) : $data['value'];
	
					$value = $this->format_currency($value, TRUE, 2, $internal_value);
					
					$description .= $value_prefix.$value;
				}
				
				$description .= $suffix_delimiter;
			}
			
			return rtrim($description, $suffix_delimiter);
		}
		
		return FALSE;		
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// REFERENCE DATABASE TABLE / COLUMN NAMES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * db_table
	 * Returns the actual name of a table defined in the config file by referencing the tables internal name.
	 */
	public function db_table($table = FALSE)
	{
		// Check the table exists in the config file and that a table name is set.
		if (! isset($this->CI->flexi->cart_database[$table]['table']) || ! $this->CI->flexi->cart_database[$table]['table'])
		{
			return FALSE;
		}
		
		return $this->CI->flexi->cart_database[$table]['table'];
	}
	
	/**
	 * db_column
	 * Returns the actual name of a table column defined in the config file by referencing the table columns internal name.
	 */
	public function db_column($table = FALSE, $column = FALSE)
	{
		// Check the table and column exist in the config file and that a table/column name is set.
		if (! isset($this->CI->flexi->cart_database[$table]['columns'][$column]) || ! $this->CI->flexi->cart_database[$table]['columns'][$column])
		{
			return FALSE;
		}
		
		return $this->CI->flexi->cart_database[$table]['columns'][$column];
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MESSAGES AND ERRORS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * set_status_message
	 * Set a status message to be displayed to the user.
	 */	
	public function set_status_message($status_message = FALSE, $target_user = 'public', $overwrite_existing = FALSE)
	{
		return $this->CI->flexi_cart_lite_model->set_status_message($status_message, $target_user, $overwrite_existing);
	}
	
	/**
	 * clear_status_messages
	 * Clears all status messages.
	 */	
	public function clear_status_messages()
	{
		$this->CI->flexi->status_messages = array('public' => array(), 'admin' => array());
		return TRUE;
	}

	/**
	 * status_messages
	 * Get any status message(s) that may have been set by recently run functions. 
	 */
	public function status_messages($target_user = 'public', $prefix_delimiter = FALSE, $suffix_delimiter = FALSE)
	{
		return $this->CI->flexi_cart_lite_model->status_messages($target_user, $prefix_delimiter, $suffix_delimiter);
	}

	/**
	 * set_error_message
	 * Set an error message to be displayed to the user.
	 */
	public function set_error_message($error_message = FALSE, $target_user = 'public', $overwrite_existing = FALSE)
	{
		return $this->CI->flexi_cart_lite_model->set_error_message($error_message, $target_user, $overwrite_existing);
	}
	
	/**
	 * clear_error_messages
	 * Clears all error messages.
	 */	
	public function clear_error_messages()
	{
		$this->CI->flexi->error_messages = array('public' => array(), 'admin' => array());
		return TRUE;
	}

	/**
	 * error_messages
	 * Get any error message(s) that may have been set by recently run functions. 
	 */
	public function error_messages($target_user = 'public', $prefix_delimiter = FALSE, $suffix_delimiter = FALSE)
	{
		return $this->CI->flexi_cart_lite_model->error_messages($target_user, $prefix_delimiter, $suffix_delimiter);
	}
	
	/**
	 * clear_messages
	 * Clears all status and error messages.
	 */	
	public function clear_messages()
	{
		$this->CI->flexi->status_messages = array('public' => array(), 'admin' => array());
		$this->CI->flexi->error_messages = array('public' => array(), 'admin' => array());
		return TRUE;
	}	
	
	/**
	 * get_messages_array
	 * Get any operational function messages and groups them into a status and error array.
	 * An additional array key named 'type' is also returned to clearly indicate which message types are returned.
	 */
	public function get_messages_array($target_user = 'public', $prefix_delimiter = FALSE, $suffix_delimiter = FALSE)
	{
		$messages['status'] = $this->CI->flexi_cart_lite_model->status_messages($target_user, $prefix_delimiter, $suffix_delimiter);

		$messages['errors'] = $this->CI->flexi_cart_lite_model->error_messages($target_user, $prefix_delimiter, $suffix_delimiter);
		
		// Set a message type identifier to state whether they are either status, error or mixed messages.
		if (! empty($messages['status']) && empty($messages['errors']))
		{
			$messages['type'] = 'status';
		}
		else if (empty($messages['status']) && ! empty($messages['errors']))
		{
			$messages['type'] = 'error';
		}
		else if (! empty($messages['status']) && ! empty($messages['errors']))
		{
			$messages['type'] = 'mixed';
		}
		else
		{
			$messages['type'] = FALSE;
		}
		
		// If message type is FALSE, no messages are set, so return FALSE.
		return ($messages['type']) ? $messages : FALSE;
	}

	/**
	 * get_messages
	 * Get any operational function messages whether of status or error type and format their output with delimiters.
	 */
	public function get_messages($target_user = 'public', $prefix_delimiter = FALSE, $suffix_delimiter = FALSE)
	{
		$messages = $this->get_messages_array($target_user, $prefix_delimiter, $suffix_delimiter);
		
		return ($messages) ? $messages['status'].$messages['errors'] : FALSE;
	}	
}

/* End of file Flexi_cart_lite.php */
/* Location: ./application/libraries/Flexi_cart_lite.php */