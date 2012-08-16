<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: flexi cart lite model
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

class Flexi_cart_lite_model extends CI_Model
{	
	public function __construct()
	{
		$this->load->database();
		$this->load->library('session');
		$this->load->config('flexi_cart', TRUE);
		$this->lang->load('flexi_cart');

		###+++++++++++++++++++++++++++++++++###

		// Cart session contains items, row-summaries, summaries and settings.
		$this->flexi->cart = $this->config->item('cart','flexi_cart');
		$this->flexi->cart_columns = array_merge($this->flexi->cart['items']['columns'], $this->flexi->cart['items']['reserved_columns']);
		
		// Cart default values and lookup tables.
		$this->flexi->cart_defaults = $this->config->item('defaults', 'flexi_cart');
		$this->flexi->cart_database = $this->config->item('database', 'flexi_cart');

		// Status and error messages.
		$this->flexi->message_settings = $this->config->item('messages', 'flexi_cart');
		$this->flexi->status_messages = array('public' => array(), 'admin' => array());
		$this->flexi->error_messages = array('public' => array(), 'admin' => array());
		
		// Get current cart content from session.
		if ($this->session->userdata($this->flexi->cart['name']) !== FALSE)
		{
			$this->flexi->cart_contents = $this->session->userdata($this->flexi->cart['name']);
		}
		// Else, load the 'Complete' flexi cart model to set cart defaults.
		else
		{
			$this->load->model('flexi_cart_model');
			$this->flexi_cart_model->set_cart_defaults();
		}
	}
	
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOCATIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * locations_tiered
	 * Gets all current active locations and formats them into an array, grouped into each locations respective location type.
	 * This data can then be used to create a tiered group of HTML select menus listing all available locations group by each location type.
	 */
	public function locations_tiered()
	{
		// Check the table exists in the config file and is enabled.
		if (! $this->get_enabled_status('location'))
		{
			return array();
		}
	
		$sql_select = array(
			$this->flexi->cart_database['location_type']['columns']['id'],
			$this->flexi->cart_database['location_type']['columns']['name']
		);
	
		// Get all location types.
		$query = $this->db->select($sql_select)
			->from($this->flexi->cart_database['location_type']['table'])
			->order_by($this->flexi->cart_database['location_type']['columns']['parent'], 'ASC') 
			->get();

		if ($query->num_rows() > 0)
		{
			$location_types = $query->result_array();
		
			// Loop through each location type and run a query to return all related locations.
			$location_data = array();
			foreach($location_types as $row)
			{
				$sql_select = array(
					$this->flexi->cart_database['locations']['columns']['id'],
					$this->flexi->cart_database['locations']['columns']['parent'],
					$this->flexi->cart_database['locations']['columns']['name']
				);
				
				$sql_where = array(
					$this->flexi->cart_database['locations']['columns']['type'] => $row[$this->flexi->cart_database['location_type']['columns']['id']],
					$this->flexi->cart_database['locations']['columns']['status'] => 1
				);

				$query = $this->db->select($sql_select)
					->from($this->flexi->cart_database['locations']['table'])
					->where($sql_where)
					->get();
				
				if ($query->num_rows() > 0)
				{
					// Group location types and then associate related 'child' locations.
					$location_data[$row[$this->flexi->cart_database['location_type']['columns']['name']]] = $query->result_array();
				}
			}
		}

		return (isset($location_data)) ? $location_data : array();
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * locations_inline
	 * Gets all current active locations and formats them into an array.
	 * Each row in the array contains an ID of the location and a concatenated string of the location and any higher tiered locations.
	 * Example: array('18' => 'United States > New York > 10101')
	 * This data can then be used to create a single HTML select menu listing all available locations.
	 */
	public function locations_inline($separator)
	{
		// Check the table exists in the config file and is enabled.
		if (! $this->get_enabled_status('location'))
		{
			return array();
		}

		$sql_select = array(
			$this->flexi->cart_database['locations']['columns']['id'],
			$this->flexi->cart_database['locations']['columns']['type'],
			$this->flexi->cart_database['locations']['columns']['parent'],
			$this->flexi->cart_database['locations']['columns']['name']
		);
	
		// Get all locations.
		$query = $this->db->select($sql_select)
			->from($this->flexi->cart_database['locations']['table'])
			->where($this->flexi->cart_database['locations']['columns']['status'], 1)
			->order_by($this->flexi->cart_database['locations']['columns']['type'], 'DESC')
			->get();
			
		if ($query->num_rows() > 0)
		{
			$location_data = $query->result_array();
			
			// Loop through each location and append all sub locations to the name.
			$locations = array();
			foreach($location_data as $key => $location)
			{
				$locations[] = array(
					$this->flexi->cart_database['locations']['columns']['id'] => $location[$this->flexi->cart_database['locations']['columns']['id']],
					$this->flexi->cart_database['locations']['columns']['name'] => $this->nest_related_locations(
						$location_data, 
						$location[$this->flexi->cart_database['locations']['columns']['parent']], 
						$location[$this->flexi->cart_database['locations']['columns']['name']],
						$separator
					)
				);
				unset($location_data[$key]);
			}
			
			// Sort locations alphabetically.
			$sorted_locations = array();
			foreach($locations as $key => $data) 
			{
				$sorted_locations[] = $data[$this->flexi->cart_database['locations']['columns']['name']];
			}
			array_multisort($sorted_locations, SORT_ASC, $locations);
		}
		
		return (isset($locations)) ? $locations : array();
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * nest_related_locations
	 * A self calling loop function that builds a string of each location and its higher tiered locations.
	 */
	private function nest_related_locations($location_data, $location_fk, $name, $separator)
	{
		// Loop through each location and append all sub locations to the name.
		foreach($location_data as $key => $data)
		{
			if ($data[$this->flexi->cart_database['locations']['columns']['id']] == $location_fk)
			{
				unset($location_data[$key]);
				
				// Self call this function again to check for related locations.
				$name = $this->nest_related_locations(
					$location_data, $data[$this->flexi->cart_database['locations']['columns']['parent']], 
					$data[$this->flexi->cart_database['locations']['columns']['name']].$separator.$name,
					$separator
				);
				
				break;
			}
		}
		
		return $name;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * location_zones
	 * Gets all current active location zones and formats them into an array.
	 * By submitting either 'shipping' or 'tax' as the zone type, the function will return only zones that have shipping or tax locations related to them.
	 */
	public function location_zones($zone_type = FALSE)
	{
		// Check the table exists in the config file and is enabled.
		if (! $this->get_enabled_status('location'))
		{
			return array();
		}

		// Check whether to return zones only with shipping or tax locations set.
		if ($zone_type == 'shipping')
		{
			$this->db->join($this->flexi->cart_database['locations']['table'], 
				$this->flexi->cart_database['locations']['columns']['shipping_zone'].' = '.$this->flexi->cart_database['location_zones']['columns']['id']);
		}
		else if ($zone_type == 'tax')
		{
			$this->db->join($this->flexi->cart_database['locations']['table'], 
				$this->flexi->cart_database['locations']['columns']['tax_zone'].' = '.$this->flexi->cart_database['location_zones']['columns']['id']);
		}
	
		$sql_select = array(
			$this->flexi->cart_database['location_zones']['columns']['id'],
			$this->flexi->cart_database['location_zones']['columns']['name'],
			$this->flexi->cart_database['location_zones']['columns']['description']
		);
	
		// Return only active zones.
		$sql_where = array($this->flexi->cart_database['location_zones']['columns']['status'] => 1);
	
		// Run a query to get all zones that match the zone type, if a type has not been set, return all.
		return $this->db->select($sql_select)
			->from($this->flexi->cart_database['location_zones']['table'])
			->where($sql_where)
			->group_by($this->flexi->cart_database['location_zones']['columns']['id'])
			->get()
			->result_array();
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SHIPPING
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_database_item_shipping_rate
	 * Looks-up a database table and returns an items shipping rate based on a location.
	 */
	public function get_database_item_shipping_rate($item_id = FALSE, $location = FALSE)
	{
		// Check the item shipping table exists in the config file and is enabled.
		if ($this->get_enabled_status('item_shipping'))
		{
			// Get current shipping location if not submitted.
			if (empty($location) || ! is_array($location))
			{
				$location = $this->flexi->cart_contents['settings']['shipping']['location'];
			}			

			// Set aliases of item shipping table data.
			$tbl_item_ship_rates = $this->flexi->cart_database['item_shipping'];
			$tbl_cols_item_ship_rates = $this->flexi->cart_database['item_shipping']['columns'];
			
			$sql_select = array(
				$tbl_cols_item_ship_rates['value'],
				$tbl_cols_item_ship_rates['separate']
			);
			
			// Loop through each location and try to match a shipping rate with an item id.
			for($i = 0; (isset($location[$i])); $i++)
			{
				if ($location[$i]['location_id'] > 0 || $location[$i]['zone_id'] > 0)
				{
					$sql_where = $tbl_cols_item_ship_rates['status']." = '1' AND ".$tbl_cols_item_ship_rates['item']." = ".$this->db->escape($item_id)." AND (";
					$sql_where .= "(".$tbl_cols_item_ship_rates['location']." = '0' AND ".$tbl_cols_item_ship_rates['zone']." = '0') OR ";
					$sql_where .= ($location[$i]['location_id'] > 0) ? $tbl_cols_item_ship_rates['location']." = ".$this->db->escape($location[$i]['location_id'])." OR " : NULL; 
					$sql_where .= ($location[$i]['zone_id'] > 0) ? $tbl_cols_item_ship_rates['zone']." = ".$this->db->escape($location[$i]['zone_id']) : NULL;
					$sql_where = rtrim($sql_where, ' OR ').")";
					
					$query = $this->db->select($sql_select)
						->from($tbl_item_ship_rates['table'])
						->where($sql_where)
						->order_by($tbl_cols_item_ship_rates['id'], 'ASC')
						->limit(1)
						->get();
									
					// If a match is found, return shipping rate.
					if ($query->num_rows() > 0)
					{
						return $query->row_array();					
					}
				}
			}
		}
		
		return FALSE;
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_database_item_shipping_status
	 * Looks-up a database table of 'whitelist' and 'blacklist' locations that a specific item is permitted to be shipped to.
	 * If an item has a whitelist of locations, and the current location is not matched, then the item cannot be shipped.
	 * If an item has a blacklist of locations, and the current location is matched, then the item cannot be shipped.
	 * If an item is on neither list, it is permitted.
	 */
	public function get_database_item_shipping_status($item_id = FALSE, $location = FALSE)
	{
		// Check the 'item_shipping' table exists in the config file and is enabled.
		// Note: If the table is disabled, it will indicate that any submitted item can be shipped to all locations.
		if (! $this->get_enabled_status('item_shipping'))
		{
			return TRUE;
		}

		// Set aliases of item shipping location table data.
		$tbl_item_ship_location = $this->flexi->cart_database['item_shipping'];
		$tbl_cols_item_ship_location = $this->flexi->cart_database['item_shipping']['columns'];

		// Get current shipping location if not submitted.
		if (empty($location) || ! is_array($location))
		{
			$location = $this->flexi->cart_contents['settings']['shipping']['location'];
		}
		
		// Get item location data.
		$sql_select = array(
			$tbl_cols_item_ship_location['location'],
			$tbl_cols_item_ship_location['zone']
		);	
	
		###+++++++++++++++++++++++++++++++++###
		
		### Whitelist Locations.

		// Check if there are any active whitelist item shipping locations.
		$sql_where = $tbl_cols_item_ship_location['status']." = '1' AND ".$tbl_cols_item_ship_location['item']." = ".$this->db->escape($item_id)." 
			AND ".$tbl_cols_item_ship_location['banned']." = '1'";
		
		$query = $this->db->select($sql_select)
			->where($sql_where)
			->get($tbl_item_ship_location['table']);

		if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $whitelist)
			{
				// Loop through current location array and try to match with permitted whitelist locations.
				for($i = 0; (isset($location[$i])); $i++)
				{
					if (($location[$i]['location_id'] > 0 && $whitelist[$tbl_cols_item_ship_location['location']] == $location[$i]['location_id'])
						|| ($location[$i]['zone_id'] > 0 && $whitelist[$tbl_cols_item_ship_location['zone']] == $location[$i]['zone_id']))
					{
						// Item is permitted to be shipped to current location.
						return TRUE;
					}
				}
			}
			
			// No location was matched to the whitelist of locations, therefore item is banned from being shipped to the current location.
			return FALSE;
		}
	
		###+++++++++++++++++++++++++++++++++###
		
		### Blacklist Locations
		
		// Check if there are any active blacklist item shipping locations.
		$sql_where = $tbl_cols_item_ship_location['status']." = '1' AND ".$tbl_cols_item_ship_location['item']." = ".$this->db->escape($item_id)."
			AND ".$tbl_cols_item_ship_location['banned']." = 2";
		
		$query = $this->db->select($sql_select)
			->where($sql_where)
			->get($tbl_item_ship_location['table']);

		if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $blacklist)
			{
				// Loop through current location array and try to match with banned blacklist locations.
				for($i = 0; (isset($location[$i])); $i++)
				{
					if (($location[$i]['location_id'] > 0 && $blacklist[$tbl_cols_item_ship_location['location']] == $location[$i]['location_id']) 
						|| ($location[$i]['zone_id'] > 0 && $blacklist[$tbl_cols_item_ship_location['zone']] == $location[$i]['zone_id']))
					{
						// Item is banned from being shipped to current location.
						return FALSE;
					}
				}
			}
		}
		
		// Item is permitted to be shipped to current location.
		return TRUE;
	}	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TAX
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_database_item_tax_rate
	 * Looks-up the database and returns the tax rate for a specific item.
	 */
	public function get_database_item_tax_rate($item_id = FALSE)
	{
		// Check the item tax table exists in the config file and is enabled.
		if ($this->get_enabled_status('item_tax'))
		{
			// Set aliases of item tax table data.
			$tbl_item_tax = $this->flexi->cart_database['item_tax'];
			$tbl_cols_item_tax = $this->flexi->cart_database['item_tax']['columns'];
			
			// Get current tax location.
			$location = $this->flexi->cart_contents['settings']['tax']['location'];
			
			// Loop through each location and try to match a tax rate with an item id.
			for($i = 0; isset($location[$i]); $i++)
			{
				if ($location[$i]['location_id'] > 0 || $location[$i]['zone_id'] > 0)
				{
					$sql_where = $tbl_cols_item_tax['status']." = '1' AND ".$tbl_cols_item_tax['item']." = ".$this->db->escape($item_id)." AND (";
					$sql_where .= "(".$tbl_cols_item_tax['location']." = '0' AND ".$tbl_cols_item_tax['zone']." = '0') OR ";
					$sql_where .= ($location[$i]['location_id'] > 0) ? $tbl_cols_item_tax['location']." = ".$this->db->escape($location[$i]['location_id'])." OR " : NULL;
					$sql_where .= ($location[$i]['zone_id'] > 0) ? $tbl_cols_item_tax['zone']." = ".$this->db->escape($location[$i]['zone_id']) : NULL;
					$sql_where = rtrim($sql_where, ' OR ').")";
					
					$query = $this->db->select($tbl_cols_item_tax['rate'])
						->from($tbl_item_tax['table'])
						->where($sql_where)
						->order_by($tbl_cols_item_tax['id'], 'ASC')
						->limit(1)
						->get();
				
					// If a match is found.
					if ($query->num_rows() > 0)
					{
						$tax_data = $query->row_array();
						return $tax_rate = (float)$tax_data[$tbl_cols_item_tax['rate']];
					}
				}
			}
		}
		
		return FALSE;
	}

	/**
	 * calculate_tax
	 * Calculates the tax of a submitted value.
	 */
	public function calculate_tax($value = 0, $tax_rate = FALSE, $internal_calculation = TRUE, $calc_ex_tax = FALSE)
	{
		// Set default values.
		$tax_data = array(
			'value_ex_tax' => 0,
			'value_inc_tax' => 0,
			'tax_value' => 0,
			'taxable_value' => 0,
			'non_taxable_value' => 0
		);
		
		if ($this->is_positive($value))
		{
			// If internal calculation, use either submitted tax rate or the carts internal tax rate.
			if ($internal_calculation)
			{
				$tax_rate = ($this->non_negative($tax_rate)) ? $tax_rate : $this->flexi->cart_contents['settings']['tax']['internal_rate'];
			}
			// Else, use either submitted tax rate or the current locations tax rate.
			else
			{
				$tax_rate = ($this->non_negative($tax_rate)) ? $tax_rate : $this->flexi->cart_contents['settings']['tax']['rate'];
			}

			// Tax included on cart pricing.
			if ($this->flexi->cart_contents['settings']['configuration']['price_inc_tax'] && ! $calc_ex_tax)
			{
				$tax_data['value_ex_tax'] = $this->format_calculation($this->add_remove_tax($value, $tax_rate, FALSE), 4);
				$tax_data['value_inc_tax'] = $value;
				$tax_data['tax_value'] = $this->format_calculation($value - $tax_data['value_ex_tax'], 4);
			}
			// Tax not included on cart pricing.
			else
			{
				$tax_data['value_ex_tax'] = $value;
				$tax_data['value_inc_tax'] = $this->format_calculation($this->add_remove_tax($value, $tax_rate, TRUE), 4);
				$tax_data['tax_value'] = $this->format_calculation($tax_data['value_inc_tax'] - $value, 4);
			}
			
			// Set variables indicating whether the calculated value was tax applicable.
			// The returned values are then returned to calculate summary totals for the total value of items with and without tax.
			// These summary totals can then be used for specific discount types that target taxed and non taxed values.
			if ($tax_rate > 0)
			{
				$tax_data['taxable_value'] = $tax_data['value_ex_tax'];
				$tax_data['non_taxable_value'] = 0;
			}
			else
			{
				$tax_data['taxable_value'] = 0;
				$tax_data['non_taxable_value'] = $tax_data['value_ex_tax'];
			}
		}

		return $tax_data;
	}

	/**
	 * add_remove_tax
	 * Returns a value with tax added or removed.
	 */
	public function add_remove_tax($value, $tax_rate, $add_tax = FALSE)
	{
		// Convert tax rate to decimal.
		$tax_rate = (($tax_rate / 100) + 1);
		
		// Set correct calculation operator to either add or remove tax to value.
		$tax_calc_operator = ($add_tax) ? '*' : '/'; 

		// If value is specifically set as tax free.
		if ((float)$tax_rate == 0)
		{
			$tax_calculation = $value; 
		}
		else
		{
			$tax_calculation = $value . $tax_calc_operator . $tax_rate;		
		}
		
		// Calculate new value with tax either added or removed.
		return $this->calculate_string($tax_calculation);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_discount_requirements
	 * Returns an array containing the quantity and value required to activate a specific discount.
	 */
	public function get_discount_requirements($discount_id = FALSE)
	{
		// Check the discount tables exists in the config file and is enabled.
		if ($this->get_enabled_status('discounts'))
		{
			if (empty($discount_id))
			{
				return FALSE;
			}
			
			// Set aliases of discount table data.
			$tbl_cols_discounts = $this->flexi->cart_database['discounts']['columns'];
			$tbl_cols_group_discounts = $this->flexi->cart_database['discount_groups']['columns'];
			$tbl_cols_group_item_discounts = $this->flexi->cart_database['discount_group_items']['columns'];

			$sql_select = array(
				$tbl_cols_discounts['type'],
				$tbl_cols_discounts['item'],
				$tbl_cols_discounts['group'],
				$tbl_cols_discounts['quantity_required'],
				$tbl_cols_discounts['value_required']
			);
			
			$sql_where = array(
				$tbl_cols_discounts['id'] => $discount_id,
				$tbl_cols_discounts['valid_date'].' <= ' => $this->database_date_time(),
				$tbl_cols_discounts['expire_date'].' >= ' => $this->database_date_time(),
				$tbl_cols_discounts['status'] => 1,
				$tbl_cols_discounts['usage_limit'].' > ' => 0
			);
			
			$query = $this->db->select($sql_select)
				->from($this->flexi->cart_database['discounts']['table'])
				->where($sql_where)
				->get();

			if ($query->num_rows() == 1)
			{
				$discount_data = $query->row_array();
				$quantity = $value = 0;
				$item_ids = array();
				
				// Item based discounts.
				if ($discount_data[$tbl_cols_discounts['type']] == 1)
				{
					// Item id is set.
					if ($discount_data[$tbl_cols_discounts['item']] != 0)
					{
						$item_ids[] = $discount_data[$tbl_cols_discounts['item']];
					}
					// Item discount group id is set, need to run another query to get the item ids.
					else if ($discount_data[$tbl_cols_discounts['group']] != 0)
					{
						$sql_where = array($tbl_cols_group_discounts['status'] => 1);
					
						$query = $this->db->select($tbl_cols_group_item_discounts['item'])
							->from($this->flexi->cart_database['discount_groups']['table'])
							->join($this->flexi->cart_database['discount_group_items']['table'], $tbl_cols_group_discounts['id'].' = '.$tbl_cols_group_item_discounts['group'])
							->where($sql_where)
							->get();
						
						if ($query->num_rows() > 0)
						{
							foreach($query->result_array() as $data)
							{
								$item_ids[] = $data[$tbl_cols_group_item_discounts['item']];
							}
						}
					}
					
					// Loop through item ids and get their corresponding values from the cart contents array.
					if (! empty($item_ids))
					{
						foreach($this->flexi->cart_contents['items'] as $row)
						{
							if (in_array($row[$this->flexi->cart_columns['item_id']], $item_ids))
							{
								// Get the items non-discounted price.
								$item_price = $this->flexi->cart_contents['items'][$row['row_id']][$this->flexi->cart_columns['item_price']];
								
								// Get the items non-discounted quantity.
								$item_quantity = (isset($this->flexi->cart_contents['settings']['discounts']['active_items'][$row['row_id']]['non_discount_quantity'])) ?
									$this->flexi->cart_contents['settings']['discounts']['active_items'][$row['row_id']]['non_discount_quantity'] :
									$this->flexi->cart_contents['items'][$row['row_id']][$this->flexi->cart_columns['item_quantity']];

								// Get the items discounted price.
								$discount_price = $this->flexi->cart_contents['items'][$row['row_id']][$this->flexi->cart_columns['item_price']];
								if (isset($this->flexi->cart_contents['settings']['discounts']['active_items'][$row['row_id']]['value']))
								{
									$discount_price -= $this->flexi->cart_contents['settings']['discounts']['active_items'][$row['row_id']]['value'];
								}
								
								// Get the items discounted quantity.
								$discount_quantity = (isset($this->flexi->cart_contents['settings']['discounts']['active_items'][$row['row_id']]['discount_quantity'])) ? 
									$this->flexi->cart_contents['settings']['discounts']['active_items'][$row['row_id']]['discount_quantity'] : 0;
								
								// Add the non-discounted and discounted totals together.
								$value += (($item_price * $item_quantity) + ($discount_price * $discount_quantity));
								$quantity += $row[$this->flexi->cart_columns['item_quantity']];
							}
						}
					}
				}
				// Summary based discounts.
				// Use the total cart quantity of items and total cart value to compare against the discount requirements.
				else if ($discount_data[$tbl_cols_discounts['type']] == 2)
				{
					$value = ($this->flexi->cart_contents['summary']['item_summary_total'] - $this->flexi->cart_contents['settings']['discounts']['data']['item_discount_savings']);
					$quantity = $this->flexi->cart_contents['summary']['total_items'];
				}
				
				// Calculate discount requirements.
				if ($quantity > 0 || $value > 0)
				{
					$quantity_required = $discount_data[$tbl_cols_discounts['quantity_required']];
					$quantity_outstanding = (($quantity_required - $quantity) > 0) ? ($quantity_required - $quantity) : 0;
					$value_required = $discount_data[$tbl_cols_discounts['value_required']];
					$value_outstanding = (($value_required - $value) > 0) ? ($value_required - $value) : 0;
					
					return array(
						'quantity_required' => $quantity_required,
						'quantity' => $quantity_outstanding,
						'value_required' => $value_required,
						'value' => $value_outstanding
					);
				}
			}
		}
		
		return FALSE;
	}

	/**
	 * get_item_discounts
	 * Looks-up discounts that are available for a specific item.
	 */
	public function get_item_discounts($item_id = FALSE, $sql_select = FALSE, $sql_where = FALSE)
	{
		// Check the discount tables exists in the config file and is enabled.
		if ($this->get_enabled_status('discounts'))
		{
			if (empty($item_id) || !is_numeric($item_id))
			{
				return FALSE;
			}
		
			// Set aliases of discount table data.
			$tbl_cols_discounts = $this->flexi->cart_database['discounts']['columns'];
			$tbl_cols_group_discounts = $this->flexi->cart_database['discount_groups']['columns'];
			$tbl_cols_group_item_discounts = $this->flexi->cart_database['discount_group_items']['columns'];

			if (empty($sql_select))
			{
				$sql_select = array(
					$tbl_cols_discounts['id'],
					$tbl_cols_discounts['description'],
					$tbl_cols_discounts['quantity_required'],
					$tbl_cols_discounts['quantity_discounted'],
					$tbl_cols_discounts['value_required'],
					$tbl_cols_discounts['value_discounted'],
					$tbl_cols_discounts['custom_status_1'],
					$tbl_cols_discounts['custom_status_2'],
					$tbl_cols_discounts['custom_status_3'],
					$tbl_cols_discounts['non_combinable'],
					$tbl_cols_discounts['expire_date']
				);
			}
			
			if (empty($sql_where))
			{
				$this->db->where('('.$tbl_cols_discounts['item'].' = '.$item_id.' OR '.$tbl_cols_group_item_discounts['item'].' = '.$item_id.')');

				$sql_where = array(
					$tbl_cols_discounts['valid_date'].' <= ' => $this->database_date_time(),
					$tbl_cols_discounts['expire_date'].' >= ' => $this->database_date_time(),
					$tbl_cols_discounts['status'] => 1,
					$tbl_cols_discounts['usage_limit'].' > ' => 0,
				);
			}

			$query = $this->db->select($sql_select)
				->from($this->flexi->cart_database['discounts']['table'])
				->join($this->flexi->cart_database['discount_groups']['table'], $tbl_cols_discounts['group'].' = '.$tbl_cols_group_discounts['id'], 'left')
				->join($this->flexi->cart_database['discount_group_items']['table'], $tbl_cols_group_discounts['id'].' = '.$tbl_cols_group_item_discounts['group'], 'left')
				->where($sql_where)
				->order_by($tbl_cols_discounts['order_by'])
				->group_by($tbl_cols_discounts['id'])
				->get();
				
			return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CURRENCY
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_currencies
	 * Returns an array of currency data.
	 * Custom SQL SELECT and WHERE statements can be submitted.
	 */
	public function get_currency_data($sql_select = FALSE, $sql_where = FALSE, $return_row = TRUE)
	{
		// Check the currency tables exists in the config file and is enabled.
		if ($this->get_enabled_status('currency'))
		{
			if (! empty($sql_select))
			{
				$this->db->select($sql_select);
			}
			
			if (! empty($sql_where))
			{
				$this->db->where($sql_where);
			}
			else
			{
				$this->db->where($this->flexi->cart_database['currency']['columns']['status'], 1);
			}
		
			$query = $this->db->get($this->flexi->cart_database['currency']['table']);
			
			if ($query->num_rows() > 0) 
			{
				return ($return_row) ? $query->row_array() : $query->result_array();
			}
		}
		
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM STOCK QUANTITY
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_item_stock_quantity
	 * Get the current stock quantity for a specific item.
	 */
	public function get_item_stock_quantity($item_id = FALSE, $check_auto_allocate = FALSE)
	{
		// Check the item stock tables exists in the config file and is enabled.
		if ($this->get_enabled_status('item_stock'))
		{
			if (! $this->is_positive($item_id))
			{
				return FALSE;
			}

			// Set aliases of item stock table data.
			$tbl_cols_item_stock = $this->flexi->cart_database['item_stock']['columns'];
			
			$sql_where[$tbl_cols_item_stock['item']] = $item_id;
			
			// If the database table has a 'auto_allocate_status' column, and '$check_auto_allocate' is set, 
			// then check whether the items stock should be auto allocated.
			if ($tbl_cols_item_stock['auto_allocate_status'] && $check_auto_allocate)
			{
				$sql_where[$tbl_cols_item_stock['auto_allocate_status']] = 1;
			}
			
			$query = $this->db->select($tbl_cols_item_stock['quantity'])
				->from($this->flexi->cart_database['item_stock']['table'])
				->where($sql_where)
				->get();
				
			if ($query->num_rows() == 1)
			{
				$stock_data = $query->row_array();
				
				return $stock_data[$tbl_cols_item_stock['quantity']];
			}
		}
		
		return FALSE;
	}
	
	/**
	 * get_item_allocated_stock
	 * Looks-up the database and returns the quantity of in-stock items for a specific item.
	 */
	public function get_item_allocated_stock($item_id = FALSE)
	{
		$stock_allocation = 0;
		foreach($this->flexi->cart_contents['items'] as $row_id => $item_data)
		{
			if ($item_data[$this->flexi->cart_columns['item_id']] == $item_id)
			{
				$stock_allocation += (isset($this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['stock_allocation'])) ?
					$this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['stock_allocation'] : 0;
			}
		}
		
		return $stock_allocation;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MESSAGES AND ERRORS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * set_message
	 * Set a status or error message to be displayed.
	 */
	private function set_message($message_type = FALSE, $message = FALSE, $target_user = 'public', $overwrite_existing = FALSE)
	{
		if (in_array($message_type, array('status', 'error')) && $message)
		{
			// Convert the target user to lowercase to ensure whether comparison values are matched. 
			$target_user = strtolower($target_user);

			// Check whether to use the target user set via the config file.
			if ($target_user === 'config' && isset($this->flexi->message_settings['target_user'][$message]))
			{
				$target_user = $this->flexi->message_settings['target_user'][$message];
			}

			// If $target_user exactly equals TRUE, set the target user as public.
			$target_user = ($target_user === TRUE) ? 'public' : $target_user;

			// Check whether a message should be set, if FALSE is defined, do not set the message.
			if (in_array($target_user, array('public', 'admin')))
			{
				$message_alias = ($message_type == 'status') ? 'status_messages' : 'error_messages';
				
				// Check whether to overwrite existing messages.
				if ($overwrite_existing)
				{
					$this->flexi->{$message_alias} = array('public' => array(), 'admin' => array());
				}

				// Check message is not already in array to avoid displaying duplicates.
				if (! in_array($message, $this->flexi->{$message_alias}[$target_user]))
				{
					$this->flexi->{$message_alias}[$target_user][] = $message;
				}
			}
		}
			
		return $message;
	}
	
	/**
	 * set_status_message
	 * Set a status message to be displayed.
	 */
	public function set_status_message($status_message = FALSE, $target_user = 'public', $overwrite_existing = FALSE)
	{
		return $this->set_message('status', $status_message, $target_user, $overwrite_existing);
	}

	/**
	 * set_error_message
	 * Set an error message to be displayed.
	 */
	public function set_error_message($error_message = FALSE, $target_user = 'public', $overwrite_existing = FALSE)
	{
		return $this->set_message('error', $error_message, $target_user, $overwrite_existing);
	}

	###+++++++++++++++++++++++++++++++++###
		
	/**
	 * get_messages
	 * Get any status or error message(s) that may have been set by recently run functions. 
	 */
	private function get_messages($message_type = FALSE, $target_user = 'public', $prefix_delimiter = FALSE, $suffix_delimiter = FALSE)
	{	
		if (in_array($message_type, array('status', 'error')))
		{
			// If $target_user exactly equals TRUE, set the target user as public.
			$target_user = ($target_user === TRUE) ? 'public' : $target_user;

			// Convert the target user to lowercase to ensure whether comparison values are matched. 
			$target_user = strtolower($target_user);

			// Set message delimiters, by checking they do not exactly equal FALSE, we can allow NULL or empty '' delimiter values. 
			$status_prefix_delimiter = ($prefix_delimiter !== FALSE) ? $prefix_delimiter : $this->flexi->message_settings['delimiters']['status_prefix'];
			$status_suffix_delimiter = ($suffix_delimiter !== FALSE) ? $suffix_delimiter : $this->flexi->message_settings['delimiters']['status_suffix'];
			
			$message_alias = ($message_type == 'status') ? 'status_messages' : 'error_messages';

			// Get all messages for public users, or both public AND admin users.
			if ($target_user === 'public')
			{
				$messages = $this->flexi->{$message_alias}['public'];
			}
			else
			{
				$messages = array_merge($this->flexi->{$message_alias}['public'], $this->flexi->{$message_alias}['admin']);
			}
			
			$statuses = FALSE;
			foreach ($messages as $message)
			{
				$message = ($this->lang->line($message)) ? $this->lang->line($message) : $message;
				$statuses .= $status_prefix_delimiter . $message . $status_suffix_delimiter;
			}
			
			return $statuses;
		}

		return FALSE;
	}

	/**
	 * status_messages
	 * Get any status message(s) that may have been set by recently run functions.
	 */
	public function status_messages($target_user = 'public', $prefix_delimiter = FALSE, $suffix_delimiter = FALSE)
	{
		return $this->get_messages('status', $target_user, $prefix_delimiter, $suffix_delimiter);
	}

	/**
	 * error_messages
	 * Get any error message(s) that may have been set by recently run functions.
	 */
	public function error_messages($target_user = 'public', $prefix_delimiter = FALSE, $suffix_delimiter = FALSE)
	{
		return $this->get_messages('error', $target_user, $prefix_delimiter, $suffix_delimiter);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MISC FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_config_setting
	 * Internal function to return status of a config setting.
	 * Note: When using with IF statements, beware, a wrongly spelt or non-existent config name will return NULL, which will return FALSE if not checked using '==='.
	 */
	public function get_config_setting($setting = FALSE)
	{
		return (isset($this->flexi->cart_contents['settings']['configuration'][$setting])) ? 
			$this->flexi->cart_contents['settings']['configuration'][$setting] : NULL;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * get_enabled_status
	 * Returns a boolean value indicating whether a set of tables or columns are enabled or disabled.
	 */
	public function get_enabled_status($feature = FALSE, $set_error_message = FALSE)
	{
		$statuses = array(
			'location' => (bool)($this->flexi->cart_database['location_type']['table'] && 
				$this->flexi->cart_database['locations']['table'] && $this->flexi->cart_database['location_zones']['table']),
			'shipping' => (bool)($this->flexi->cart_database['shipping_options']['table'] && $this->flexi->cart_database['shipping_rates']['table']),
			'item_shipping' => (bool)($this->flexi->cart_database['item_shipping']['table']),
			'tax' => (bool)($this->flexi->cart_database['tax']['table']),
			'item_tax' => (bool)($this->flexi->cart_database['item_tax']['table']),
			'item_stock' => (bool)($this->flexi->cart_database['item_stock']['table']),
			'currency' => (bool)($this->flexi->cart_database['currency']['table']),
			'discounts' => (bool)($this->flexi->cart_database['discounts']['table'] && $this->flexi->cart_database['discount_groups']['table'] && 
				$this->flexi->cart_database['discount_group_items']['table'] && $this->flexi->cart_database['discount_types']['table'] && 
				$this->flexi->cart_database['discount_methods']['table'] && $this->flexi->cart_database['discount_calculation']['table'] && 
				$this->flexi->cart_database['discount_columns']['table'] && $this->flexi->cart_database['discount_tax_methods']['table']),
			'rewards' => (bool)($this->flexi->cart_database['reward_points']['table'] && 
				$this->flexi->cart_database['reward_points_converted']['table'] && $this->flexi->cart_database['order_summary']['table'] && 
				$this->flexi->cart_database['order_details']['table'] && $this->flexi->cart_database['discounts']['table'] && 
				$this->flexi->cart_database['discount_groups']['table'] && $this->flexi->cart_database['discount_group_items']['table'] && 
				$this->flexi->cart_database['discount_types']['table'] && $this->flexi->cart_database['discount_methods']['table'] && 
				$this->flexi->cart_database['discount_calculation']['table'] && $this->flexi->cart_database['discount_columns']['table'] && 
				$this->flexi->cart_database['discount_tax_methods']['table']),
			'orders' => (bool)($this->flexi->cart_database['order_summary']['table'] && $this->flexi->cart_database['order_details']['table']
				&& $this->flexi->cart_database['order_status']['table']),
			'ship_cancel_quantities' => (bool)($this->flexi->cart_database['order_details']['columns']['item_quantity'] && 
				$this->flexi->cart_database['order_details']['columns']['item_quantity_shipped'] && 
				$this->flexi->cart_database['order_details']['columns']['item_quantity_cancelled'] && 
				$this->flexi->cart_database['order_details']['columns']['item_shipped_date']),
			'db_cart_data' => (bool)($this->flexi->cart_database['db_cart_data']['table']),
			'admin_data' => (bool)($this->flexi->cart_database['order_details']['columns']['cart_row_id']),
			'auto_stock_status' => (bool)($this->flexi->cart_database['order_details']['columns']['item_id'] && $this->get_config_setting('auto_allocate_stock')),
			'config' => (bool)($this->flexi->cart_database['configuration']['table'])
		);
		
		if (isset($statuses[$feature]))
		{
			// Set error message if tables or columns are disabled.
			if (! $statuses[$feature] && $set_error_message)
			{
				$this->set_error_message('database_table_column_disabled', 'config');
			}
			
			return $statuses[$feature];
		}
		
		return TRUE;
	}
	
	/**
	 * format_calculation
	 * Returns the supplied number with a submitted number of decimal points and no thousand separator, so the value can be used for calculations.
	 */
	public function format_calculation($number = 0, $decimals = 2, $sanitize = FALSE)
	{
		if ($sanitize)
		{
			// Remove any non numeric or decimal point characters.
			$number = trim(preg_replace('/([^0-9\.])/i','',$number));
		}
	
		return round($number, $decimals);
	}

	/** 
	 * format_value
	 * Returns a value formatted to a specified number of decimals using the set decimal and thousand separators.
	 */
	public function format_value($type = 'currency', $value = FALSE, $format = TRUE, $decimals = 2, $internal_format = FALSE, $currency_name = FALSE, $weight_type = FALSE) 
	{
		// Set decimals and remove any characters that are not number or decimal point (i.e. thousand comma separators).
		$decimals = (! $format && $decimals === FALSE) ? 4 : $decimals;
		$value = $this->format_calculation($value, $decimals);
		
		if ($format)
		{
			// Get data source for formatting.
			if ($currency_name && ! $internal_format && $this->get_enabled_status('currency'))
			{
				$sql_where = array(
					$this->flexi->cart_database['currency']['columns']['name'] => $currency_name,
					$this->flexi->cart_database['currency']['columns']['status'] => 1
				);
				
				$currency_data = $this->get_currency_data(FALSE, $sql_where, TRUE);
			}
			else
			{
				$path_alias = ($internal_format) ? 
					$this->flexi->cart_contents['settings']['currency']['default'] : $this->flexi->cart_contents['settings']['currency'];			
			}

			// Set separators.
			$decimal_separator = (! empty($currency_data)) ? 
				$currency_data[$this->flexi->cart_database['currency']['columns']['decimal_separator']] : $path_alias['decimal_separator'];
			$thousand_separator = (! empty($currency_data)) ? 
				$currency_data[$this->flexi->cart_database['currency']['columns']['thousand_separator']] : $path_alias['thousand_separator'];
			
			// Apply the current currencies decimal and thousand separator
			$value = number_format($value, $decimals, $decimal_separator, $thousand_separator);
				
			// If a currency, set symbol and return value.
			if ($type == 'currency')
			{
				$currency_symbol = (! empty($currency_data)) ? 
					$currency_data[$this->flexi->cart_database['currency']['columns']['symbol']] : $path_alias['symbol'];
				$currency_symbol_suffix = (! empty($currency_data)) ? 
					$currency_data[$this->flexi->cart_database['currency']['columns']['symbol_suffix']] : $path_alias['symbol_suffix'];
					
				$value = (! $currency_symbol_suffix) ? $currency_symbol.$value : $value.$currency_symbol;
			}
			// Else, if a weight, set symbol and return value.
			else if ($type == 'weight')
			{
				// Get the weight type symbol.
				$weight_type = (! $weight_type) ? $this->flexi->cart_contents['settings']['configuration']['weight_type'] : $weight_type;
				$weight_data = $this->get_weight_types($weight_type);
				$weight_symbol = (isset($weight_data['symbol'])) ? $weight_data['symbol'] : FALSE;

				$value .= $weight_symbol;
			}
			return $value;
		}
		else
		{
			return ($type == 'weight') ? round($value, $decimals) : number_format($value, $decimals, '.', FALSE);
		}
	}	
	
	/**
	 * calculate_string
	 * Calculate string as an equation, without using eval()
	 */
	public function calculate_string($string) 
	{
		$string = trim($string);
		$string = preg_replace('[^0-9\+\-\*\/\(\) ]', '', $string); // Remove non-numbers chars, except for math operators

		$calculate = create_function('', 'return ('.$string.');');
		
		return (float)$calculate();
	}
	
	/**
	 * is_positive
	 * Validates if a value is a number and is positive (> 0).
	 */
	public function is_positive($value) 
	{
		return (isset($value) && is_numeric($value) && ($value > 0));
	}
	
	/**
	 * non_negative
	 * Validates if a value is a number and is not negative (0 or higher).
	 */
	public function non_negative($value) 
	{
		return (isset($value) && is_numeric($value) && ($value >= 0));
	}

	/**
	 * get_weight_types
	 * Returns either an array of data for a specific weight type or a multi-dimensional array all weight types and their data.
	 */
	public function get_weight_types($name = FALSE)
	{
		$weight_types = array(
			'gram' => array('name' => 'Gram', 'conversion' => 1, 'symbol' => 'g'),
			'kilogram' => array('name' => 'Kilogram', 'conversion' => 1000, 'symbol' => 'kg'),
			'avoir_ounce' => array('name' => 'Avoir Ounce', 'conversion' => 28.3495, 'symbol' => 'oz'),
			'avoir_pound' => array('name' => 'Avoir Pound', 'conversion' => 453.5924, 'symbol' => 'lb'),
			'troy_ounce' => array('name' => 'Troy Ounce', 'conversion' => 31.1035, 'symbol' => 't oz'),
			'troy_pound' => array('name' => 'Troy Pound', 'conversion' => 373.2417, 'symbol' => 't lb'),
			'carat' => array('name' => 'Carat', 'conversion' => 0.2, 'symbol' => 'ct')
		);
		
		return (isset($weight_types[$name])) ? $weight_types[$name] : $weight_types;
	}
	
	/**
	 * database_date_time
	 * Format the current or submitted date and time (in seconds). 
	 * Additional time can be added / subtracted.
	 */
	public function database_date_time($apply_time = 0, $date_time = FALSE, $force_unix = FALSE)
	{
		// Get cart config settings.
		$cart_settings = $this->config->item('settings', 'flexi_cart');
	
		// Get timestamp of either submitted date or current date.
		if ($date_time)
		{
			$date_time = (is_numeric($date_time) && strlen($date_time) == 10) ? $date_time : strtotime($date_time);
		}
		else
		{
			$date_time = time();
		}
		
		// Add or subtract any submitted apply time.
		$date_time += $apply_time;
	
		// If database date/time is set as UNIX via config file, or if a unix timestamp has been requested.
		if ((is_numeric($cart_settings['date_time']) && strlen($cart_settings['date_time']) == 10) || $force_unix)
		{
			return $date_time; 
		}
		else if (is_string($cart_settings['date_time']) && strtotime($cart_settings['date_time'])) // MySQL datetime.
		{
			return date('Y-m-d H:i:s', $date_time);
		}
		else // Return date/time set via config file.
		{
			return $cart_settings['date_time'];
		}
	}
}

/* End of file flexi_cart_lite_model.php */
/* Location: ./application/models/flexi_cart_lite_model.php */
