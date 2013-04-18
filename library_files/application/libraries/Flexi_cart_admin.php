<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: flexi cart admin library
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

class Flexi_cart_admin extends Flexi_cart_lite
{
	public function __construct()
	{
		parent::__construct();

		$this->CI->load->model('flexi_cart_admin_model');
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// GENERIC CRUD FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_table_data_query
	 * Gets records from a submitted table using a user defined SQL SELECT query.
	 * The query is returned as an object that CI query helpers can then be manually applied to. i.e. $query->num_rows(), $query->row() etc.
	 */
	public function get_db_table_data_query($table_name = FALSE, $sql_select = FALSE, $sql_where = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->get_table_data($table_name, $sql_select, $sql_where);
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_table_data
	 * Inserts a record into a submitted table using a user defined SQL INSERT statement.
	 */
	public function insert_db_table_data($table_name = FALSE, $sql_insert = FALSE)
	{		
		return $this->CI->flexi_cart_admin_model->insert_table_data($table_name, $sql_insert);
	}

	###+++++++++++++++++++++++++###

	/**
	 * update_db_table_data
	 * Updates records in a submitted table using a user defined SQL WHERE statement.
	 */
	public function update_db_table_data($table_name = FALSE, $sql_update = FALSE, $sql_where = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->update_table_data($table_name, $sql_update, $sql_where);
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_table_data
	 * Deletes records from a submitted table using a user defined SQL WHERE statement.
	 */
	public function delete_db_table_data($table_name = FALSE, $sql_where = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->delete_table_data($table_name, $sql_where);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOCATION TYPE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_location_type_query
	 * Gets records from the location type table using a user defined SQL SELECT query.
	 */
	public function get_db_location_type_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['location_type']['columns']['id'];
	
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['location_type']['table'], $sql_select, $sql_where, $default_pk, 'location');
	}	

	###+++++++++++++++++++++++++###

	/**
	 * insert_db_location_type
	 * Inserts a new location type using a user defined SQL INSERT statement.
	 */
	public function insert_db_location_type($sql_insert = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['location_type']['table'], $sql_insert, 'location');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_location_type
	 * Updates records in the location type table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_location_type($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['location_type']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['location_type']['table'], $sql_update, $sql_where, $default_pk, 'location');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_location_type
	 * Deletes records from the location type table using a user defined SQL WHERE statement.
	 */
	public function delete_db_location_type($sql_where = FALSE, $delete_children = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['location_type']['columns']['id'];

		if ($delete_children === 'delete')
		{
			// Get the ids of location type records that are to be deleted, these ids will then be used to delete related child records. 
			$parent_ids = $this->get_location_type_query($default_pk, $sql_where)->result_array();
		}
		
		if ($this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['location_type']['table'], $sql_where, $default_pk, 'location'))
		{
			if (! empty($parent_ids))
			{
				// Loop through ids of all deleted location type records and delete all related locations.
				foreach($parent_ids as $id_data)
				{
					$sql_where_locations = array($this->CI->flexi->cart_database['locations']['columns']['type'] => $id_data[$default_pk]);			
					
					$this->delete_db_location($sql_where_locations, 'delete');
				}
			}
			
			return TRUE;
		}
		
		return FALSE;
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOCATIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_location_query
	 * Gets records from the location table using a user defined SQL SELECT query.
	 */
	public function get_db_location_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['locations']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['locations']['table'], $sql_select, $sql_where, $default_pk, 'location');
	}

	###+++++++++++++++++++++++++###

	/**
	 * insert_db_location
	 * Inserts a new location using a user defined SQL INSERT statement.
	 */
	public function insert_db_location($sql_insert = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['locations']['table'], $sql_insert, 'location');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_location
	 * Updates records in the location table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_location($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['locations']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['locations']['table'], $sql_update, $sql_where, $default_pk, 'location');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_location
	 * Deletes records from the location table using a user defined SQL WHERE statement.
	 */
	public function delete_db_location($sql_where = FALSE, $delete_children = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['locations']['columns']['id'];

		if ($delete_children === 'delete')
		{
			// Get the ids of location records that are to be deleted, these ids will then be used to delete related child records. 
			$parent_ids = $this->get_location_query($default_pk, $sql_where)->result_array();
		}

		if ($this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['locations']['table'], $sql_where, $default_pk, 'location'))
		{
			if (! empty($parent_ids))
			{			
				// Loop through ids of all deleted location records and delete all related sub locations, discounts, reward vouchers, 
				// shipping, item shipping, tax and item tax records.
				foreach($parent_ids as $id_data)
				{
					$sql_where_locations = array($this->CI->flexi->cart_database['locations']['columns']['parent'] => $id_data[$default_pk]);			
					$this->delete_db_location($sql_where_locations, 'delete');

					$sql_where_discounts = array($this->CI->flexi->cart_database['discounts']['columns']['location'] => $id_data[$default_pk]);			
					$this->delete_db_discount($sql_where_discounts);
					$this->delete_db_voucher($sql_where_discounts);

					$sql_where_shipping = array($this->CI->flexi->cart_database['shipping_options']['columns']['location'] => $id_data[$default_pk]);			
					$this->delete_db_shipping($sql_where_shipping, 'delete');

					$sql_where_item_shipping = array($this->CI->flexi->cart_database['item_shipping']['columns']['location'] => $id_data[$default_pk]);			
					$this->delete_db_item_shipping($sql_where_item_shipping);

					$sql_where_tax = array($this->CI->flexi->cart_database['tax']['columns']['location'] => $id_data[$default_pk]);			
					$this->delete_db_tax($sql_where_tax);

					$sql_where_item_tax = array($this->CI->flexi->cart_database['item_tax']['columns']['location'] => $id_data[$default_pk]);								
					$this->delete_db_item_tax($sql_where_item_tax);
				}
			}
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOCATION ZONES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_location_zone_query
	 * Gets records from the location zone table using a user defined SQL SELECT query.
	 */
	public function get_db_location_zone_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['location_zones']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['location_zones']['table'], $sql_select, $sql_where, $default_pk, 'location');
	}	

	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_location_zone
	 * Inserts a new location zone using a user defined SQL INSERT statement.
	 */
	public function insert_db_location_zone($sql_insert = FALSE)
	{		
		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['location_zones']['table'], $sql_insert, 'location');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_location_zone
	 * Updates records in the location zone table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_location_zone($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['location_zones']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['location_zones']['table'], $sql_update, $sql_where, $default_pk, 'location');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_location_zone
	 * Deletes records from the location zone table using a user defined SQL WHERE statement.
	 */
	public function delete_db_location_zone($sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['location_zones']['columns']['id'];

		return $this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['location_zones']['table'], $sql_where, $default_pk, 'location');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SHIPPING
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_shipping_query
	 * Gets records from the shipping table using a user defined SQL SELECT query.
	 */
	public function get_db_shipping_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['shipping_options']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['shipping_options']['table'], $sql_select, $sql_where, $default_pk, 'shipping');
	}	

	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_shipping
	 * Inserts a new shipping option using a user defined SQL INSERT statement.
	 */
	public function insert_db_shipping($sql_insert = FALSE)
	{
		// Ensure that NULL tax rates are not converted to '0' when inserted.
		if (isset($sql_insert[$this->CI->flexi->cart_database['shipping_options']['columns']['tax_rate']]) && 
			$sql_insert[$this->CI->flexi->cart_database['shipping_options']['columns']['tax_rate']] === '')
		{
			$sql_insert[$this->CI->flexi->cart_database['shipping_options']['columns']['tax_rate']] = NULL;
		}

		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['shipping_options']['table'], $sql_insert, 'shipping');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_shipping
	 * Updates records in the shipping table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_shipping($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['shipping_options']['columns']['id'];
		
		// Ensure that NULL tax rates are not converted to '0' when updated.
		if (isset($sql_update[$this->CI->flexi->cart_database['shipping_options']['columns']['tax_rate']]) && 
			$sql_update[$this->CI->flexi->cart_database['shipping_options']['columns']['tax_rate']] === '')
		{
			$sql_update[$this->CI->flexi->cart_database['shipping_options']['columns']['tax_rate']] = NULL;
		}
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['shipping_options']['table'], $sql_update, $sql_where, $default_pk, 'shipping');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_shipping
	 * Deletes records from the shipping table and any related child shipping rates using a user defined SQL WHERE statement.
	 */
	public function delete_db_shipping($sql_where = FALSE, $delete_children = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['shipping_options']['columns']['id'];

		if ($delete_children === 'delete')
		{
			// Get the ids of shipping records that are to be deleted, these ids will then be used to delete related child records. 
			$parent_ids = $this->get_shipping_query($default_pk, $sql_where)->result_array();
		}

		if ($this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['shipping_options']['table'], $sql_where, $default_pk, 'shipping'))
		{				
			if (! empty($parent_ids))
			{
				// Loop through ids of all deleted shipping records and delete all related shipping rates.
				foreach($parent_ids as $id_data)
				{
					$sql_where_shipping_rates = array($this->CI->flexi->cart_database['shipping_rates']['columns']['parent'] => $id_data[$default_pk]);			
					
					$this->delete_db_shipping_rate($sql_where_shipping_rates);
				}
			}
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SHIPPING RATES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_db_shipping_rate_query
	 * Gets records from the shipping rate table using a user defined SQL SELECT query.
	 */
	public function get_db_shipping_rate_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['shipping_rates']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['shipping_rates']['table'], $sql_select, $sql_where, $default_pk, 'shipping');
	}	

	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_shipping_rate
	 * Inserts a new shipping option rate using a user defined SQL INSERT statement.
	 */
	public function insert_db_shipping_rate($sql_insert = FALSE)
	{		
		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['shipping_rates']['table'], $sql_insert, 'shipping');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_shipping_rate
	 * Updates records in the shipping rate table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_shipping_rate($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['shipping_rates']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['shipping_rates']['table'], $sql_update, $sql_where, $default_pk, 'shipping');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_shipping_rate
	 * Deletes records from the shipping rate table using a user defined SQL WHERE statement.
	 */
	public function delete_db_shipping_rate($sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['shipping_rates']['columns']['id'];

		return $this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['shipping_rates']['table'], $sql_where, $default_pk, 'shipping');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM SHIPPING
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_db_item_shipping_query
	 * Gets records from the item shipping table using a user defined SQL SELECT query.
	 */
	public function get_db_item_shipping_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['item_shipping']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['item_shipping']['table'], $sql_select, $sql_where, $default_pk, 'item_shipping');
	}	

	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_item_shipping
	 * Inserts a new item shipping using a user defined SQL INSERT statement.
	 */
	public function insert_db_item_shipping($sql_insert = FALSE)
	{		
		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['item_shipping']['table'], $sql_insert, 'item_shipping');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_item_shipping
	 * Updates records in the shipping item table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_item_shipping($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['item_shipping']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['item_shipping']['table'], $sql_update, $sql_where, $default_pk, 'item_shipping');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_item_shipping
	 * Deletes records from the shipping item table using a user defined SQL WHERE statement.
	 */
	public function delete_db_item_shipping($sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['item_shipping']['columns']['id'];

		return $this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['item_shipping']['table'], $sql_where, $default_pk, 'item_shipping');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TAX
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_db_tax_query
	 * Gets records from the tax table using a user defined SQL SELECT query.
	 */
	public function get_db_tax_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['tax']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['tax']['table'], $sql_select, $sql_where, $default_pk, 'tax');
	}	

	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_tax
	 * Inserts a new tax using a user defined SQL INSERT statement.
	 */
	public function insert_db_tax($sql_insert = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['tax']['table'], $sql_insert, 'tax');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_tax
	 * Updates records in the tax table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_tax($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['tax']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['tax']['table'], $sql_update, $sql_where, $default_pk, 'tax');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_tax
	 * Deletes records from the tax table using a user defined SQL WHERE statement.
	 */
	public function delete_db_tax($sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['tax']['columns']['id'];

		return $this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['tax']['table'], $sql_where, $default_pk, 'tax');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM TAX
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_db_item_tax_query
	 * Gets records from the item tax table using a user defined SQL SELECT query.
	 */
	public function get_db_item_tax_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['item_tax']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['item_tax']['table'], $sql_select, $sql_where, $default_pk, 'item_tax');
	}	

	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_item_tax
	 * Inserts a new item tax using a user defined SQL INSERT statement.
	 */
	public function insert_db_item_tax($sql_insert = FALSE)
	{		
		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['item_tax']['table'], $sql_insert, 'item_tax');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_item_tax
	 * Updates records in the item tax table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_item_tax($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['item_tax']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['item_tax']['table'], $sql_update, $sql_where, $default_pk, 'item_tax');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_item_tax
	 * Deletes records from the item tax table using a user defined SQL WHERE statement.
	 */
	public function delete_db_item_tax($sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['item_tax']['columns']['id'];

		return $this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['item_tax']['table'], $sql_where, $default_pk, 'item_tax');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM STOCK LEVELS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_db_item_stock_query
	 * Gets records from the item stock table using a user defined SQL SELECT query.
	 */
	public function get_db_item_stock_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = ($this->CI->flexi->cart_database['item_stock']['columns']['id']) ? 
			$this->CI->flexi->cart_database['item_stock']['columns']['id'] : $this->CI->flexi->cart_database['item_stock']['columns']['item'];
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['item_stock']['table'], $sql_select, $sql_where, $default_pk, 'item_stock');
	}

	###+++++++++++++++++++++++++###
	
	/** 
	 * add_item_stock_quantity
	 * Adds the submitted stock quantity to the databases item stock table.
	 */
	public function add_item_stock_quantity($item_id = FALSE, $stock_quantity = 0)
	{
		return $this->CI->flexi_cart_admin_model->update_db_row_quantity('item_stock', $item_id, $stock_quantity, TRUE);
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * remove_item_stock_quantity
	 * Removes the submitted stock quantity from the databases item stock table.
	 */
	public function remove_item_stock_quantity($item_id = FALSE, $stock_quantity = 0)
	{		
		return $this->CI->flexi_cart_admin_model->update_db_row_quantity('item_stock', $item_id, $stock_quantity, FALSE);
	}
	
	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_item_stock
	 * Inserts a new item stock using a user defined SQL INSERT statement.
	 */
	public function insert_db_item_stock($sql_insert = FALSE)
	{		
		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['item_stock']['table'], $sql_insert, 'item_stock');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_item_stock
	 * Updates records in the item stock table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_item_stock($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = ($this->CI->flexi->cart_database['item_stock']['columns']['id']) ? 
			$this->CI->flexi->cart_database['item_stock']['columns']['id'] : $this->CI->flexi->cart_database['item_stock']['columns']['item'];
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['item_stock']['table'], $sql_update, $sql_where, $default_pk, 'item_stock');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_item_stock
	 * Deletes records from the item stock table using a user defined SQL WHERE statement.
	 */
	public function delete_db_item_stock($sql_where = FALSE)
	{
		$default_pk = ($this->CI->flexi->cart_database['item_stock']['columns']['id']) ? 
			$this->CI->flexi->cart_database['item_stock']['columns']['id'] : $this->CI->flexi->cart_database['item_stock']['columns']['item'];

		return $this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['item_stock']['table'], $sql_where, $default_pk, 'item_stock');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CURRENCY
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_currency_query
	 * Gets records from the currency table using a user defined SQL SELECT query.
	 */
	public function get_db_currency_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['currency']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['currency']['table'], $sql_select, $sql_where, $default_pk, 'currency');
	}	

	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_currency
	 * Inserts a new currency using a user defined SQL INSERT statement.
	 */
	public function insert_db_currency($sql_insert = FALSE)
	{		
		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['currency']['table'], $sql_insert, 'currency');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_currency
	 * Updates records in the currency table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_currency($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['currency']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['currency']['table'], $sql_update, $sql_where, $default_pk, 'currency');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_currency
	 * Deletes records from the currency table using a user defined SQL WHERE statement.
	 */
	public function delete_db_currency($sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['currency']['columns']['id'];

		return $this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['currency']['table'], $sql_where, $default_pk, 'currency');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ORDER STATUSES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_order_status_query
	 * Gets records from the order status table using a user defined SQL SELECT query.
	 */
	public function get_db_order_status_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['order_status']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['order_status']['table'], $sql_select, $sql_where, $default_pk, 'orders');
	}
	
	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_order_status
	 * Inserts a new order status using a user defined SQL INSERT statement.
	 */
	public function insert_db_order_status($sql_insert = FALSE)
	{		
		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['order_status']['table'], $sql_insert, 'orders');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_order_status
	 * Updates records in the order status table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_order_status($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['order_status']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['order_status']['table'], $sql_update, $sql_where, $default_pk, 'orders');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_order_status
	 * Deletes records from the order status table using a user defined SQL WHERE statement.
	 */
	public function delete_db_order_status($sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['order_status']['columns']['id'];

		return $this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['order_status']['table'], $sql_where, $default_pk, 'orders');
	}
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ORDERS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * search_orders
	 * Compare a search query against order summary columns defined in the config file.
	 */
	public function search_orders_query($search_query = FALSE, $exact_match = FALSE, $sql_select = FALSE, $sql_where = FALSE)
	{
		if (! empty($search_query))
		{
			// Get order summary table columns to be searched, set via config file.
			$order_summary_cols = $this->CI->flexi->cart_database['order_summary']['search_order_cols'];

			$this->CI->flexi_cart_admin_model->create_sql_like($order_summary_cols, $search_query, $exact_match);
		}
		
		return $this->get_db_order_summary_query($sql_select, $sql_where);
	}	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * get_db_order_query
	 * Gets records from the order summary and order detail table using a user defined SQL SELECT query.
	 */
	public function get_db_order_query($sql_select = FALSE, $sql_where = FALSE)
	{
		if ($this->CI->flexi_cart_admin_model->get_enabled_status('orders'))
		{
			// If '$sql_where' is set, and is not an array, we assume it is the tables order number (primary key).
			// Note: This differs from other functions that only accept a numeric value as a lone '$sql_where' value.
			if (! empty($sql_where) && ! is_array($sql_where))
			{
				$sql_where = array($this->CI->flexi->cart_database['order_summary']['columns']['order_number'] => $sql_where);
			}
			
			$this->CI->db->join($this->CI->flexi->cart_database['order_details']['table'], 
				$this->CI->flexi->cart_database['order_summary']['columns']['order_number'].' = '.$this->CI->flexi->cart_database['order_details']['columns']['order_number']);
			
			$this->CI->db->join($this->CI->flexi->cart_database['order_status']['table'], 
				$this->CI->flexi->cart_database['order_summary']['columns']['status'].' = '.$this->CI->flexi->cart_database['order_status']['columns']['id']);
			
			$this->CI->db->group_by($this->CI->flexi->cart_database['order_summary']['columns']['order_number']);
		
			return $this->CI->flexi_cart_admin_model
				->get_table_data($this->CI->flexi->cart_database['order_summary']['table'], $sql_select, $sql_where, FALSE, 'orders');
		}
		
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * get_db_order_summary_query
	 * Gets records from the order summary table using a user defined SQL SELECT query.
	 */
	public function get_db_order_summary_query($sql_select = FALSE, $sql_where = FALSE)
	{
		if ($this->CI->flexi_cart_admin_model->get_enabled_status('orders'))
		{
			// If '$sql_where' is set, and is not an array, we assume it is the tables order number (primary key).
			// Note: This differs from other functions that only accept a numeric value as a lone '$sql_where' value.
			if (! empty($sql_where) && ! is_array($sql_where))
			{
				$sql_where = array($this->CI->flexi->cart_database['order_summary']['columns']['order_number'] => $sql_where);
			}

			$this->CI->db->join($this->CI->flexi->cart_database['order_status']['table'], 
				$this->CI->flexi->cart_database['order_summary']['columns']['status'].' = '.$this->CI->flexi->cart_database['order_status']['columns']['id']);
					
			return $this->CI->flexi_cart_admin_model
				->get_table_data($this->CI->flexi->cart_database['order_summary']['table'], $sql_select, $sql_where, FALSE, 'orders');
		}
		
		return FALSE;
	}	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * get_db_order_detail_query
	 * Gets records from the order detail table using a user defined SQL SELECT query.
	 */
	public function get_db_order_detail_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['order_details']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['order_details']['table'], $sql_select, $sql_where, $default_pk, 'orders');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * get_refund_itemised_query
	 * Gets an itemised query of refund totals for all items that have been cancelled within an order.
	 *
	 * Note: This function is only intended to be used as an accurate ESTIMATE of the value that should be refunded.
	 * The returned value does not include any percentage based surcharge or discount values that may have been applied to the orders summary value.
	 * A true representation of the orders new value can be achieved by reloading the 'to-be-refunded' order from the 'db_cart_data' table data, and resaving the order.
	 */
	public function get_refund_itemised_query($order_number = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->get_refund_itemised($order_number);
	}

	###+++++++++++++++++++++++++###
		
	/** 
	 * get_refund_summary_query
	 * Gets a summary of refund totals for all items that have been cancelled within an order.
	 *
	 * Note: This function is only intended to be used as an accurate ESTIMATE of the value that should be refunded.
	 * The returned value does not include any percentage based surcharge or discount values that may have been applied to the orders summary value.
	 * A true representation of the orders new value can be achieved by reloading the 'to-be-refunded' order from the 'db_cart_data' table data, and resaving the order.
	 */
	public function get_refund_summary_query($order_number = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->get_refund_summary($order_number);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * update_db_order_summary
	 * Updates records in the order summary table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_order_summary($sql_update = FALSE, $sql_where = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->update_order_summary($sql_update, $sql_where);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * update_db_order_details
	 * Updates records in the order detail table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_order_details($sql_update = FALSE, $sql_where = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->update_order_details($sql_update, $sql_where);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * delete_db_order
	 * Deletes records from the order summary and order detail table using a user defined SQL WHERE statement.
	 * Note: Deleting an order will also delete any user reward points that are associated with it, as reward points are calculated from the order details table.
	 */
	public function delete_db_order($order_number = FALSE)
	{
		// Delete records from Order Summary Table
		$sql_where = array($this->CI->flexi->cart_database['order_summary']['columns']['order_number'] => $order_number);
		
		if ($this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['order_summary']['table'], $sql_where, FALSE, 'orders'))
		{
			// Delete records from Order Details Table
			$sql_where = array($this->CI->flexi->cart_database['order_details']['columns']['order_number'] => $order_number);
			
			return $this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['order_details']['table'], $sql_where, FALSE, 'orders');
		}
		
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SAVE ORDERS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * generate_order_number
	 * Generates an order number. 
	 */
	public function generate_order_number($prefix = FALSE, $suffix = FALSE)
	{
		if ($order_number = $this->CI->flexi_cart_admin_model->generate_order_number($prefix = FALSE, $suffix = FALSE))
		{
			$this->CI->flexi->cart_contents['settings']['configuration']['order_number'] = $order_number;
			
			$this->CI->session->set_userdata(array($this->CI->flexi->cart['name'] => $this->CI->flexi->cart_contents));

			return $order_number;
		}
		
		return FALSE;
	}
	
	/**
	 * check_order_number_available
	 * Checks whether an order has already been saved with the submitted order number.
	 */
	public function check_order_number_available($order_number = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->check_order_number_available($order_number);
	}

	/**
	 * save_order
	 * Saves the content of the cart as an order.
	 * Additional user defined data can be inserted at the same time using the functions item and summary data parameters as well as a user defined order number.
	 */
	public function save_order($custom_summary_data = FALSE, $custom_item_data = FALSE, $order_number = FALSE)
	{
		// Check the order tables exist in the config file and are enabled.
		if (! $this->CI->flexi_cart_admin_model->get_enabled_status('orders', TRUE))
		{
			return FALSE;
		}
		
		if ($this->CI->flexi_cart_admin_model->save_order($custom_summary_data, $custom_item_data, $order_number))
		{
			$this->CI->flexi_cart_admin_model->set_status_message('cart_order_save_successful', 'config');
			return TRUE;
		}
		else 
		{
			$this->CI->flexi_cart_admin_model->set_error_message('cart_order_save_unsuccessful', 'config');
			return FALSE;
		}
	}

	/**
	 * resave_order
	 * Resaves the content of the cart over an existing order in the database.
	 * Cart items from the original order that no longer exist in the current cart are removed, new items are added, and existing items are updated.
	 * Additional user defined data can be inserted at the same time using the functions item and summary data parameters.
	 */
	public function resave_order($summary_data = FALSE, $item_data = FALSE)
	{
		// Check the order tables exist in the config file and are enabled.
		if (! $this->CI->flexi_cart_admin_model->get_enabled_status('orders', TRUE))
		{
			return FALSE;
		}
		
		if ($this->CI->flexi_cart_admin_model->resave_order($summary_data, $item_data))
		{
			$this->CI->flexi_cart_admin_model->set_status_message('cart_order_save_successful', 'config');
			return TRUE;
		}
		else 
		{
			$this->CI->flexi_cart_admin_model->set_error_message('cart_order_save_unsuccessful', 'config');
			return FALSE;
		}
	}
	
	/**
	 * email_order
	 * Sends an email populated with data from a saved cart order using the flexi cart email template.
	 */
	public function email_order($order_number = FALSE, $email_to = FALSE, $email_subject = FALSE, $custom_data = FALSE)
	{
		// Check the order tables exist in the config file and are enabled.
		if (! $this->CI->flexi_cart_admin_model->get_enabled_status('orders', TRUE))
		{
			return FALSE;
		}
		
		if ($this->CI->flexi_cart_admin_model->email_order($order_number, $email_to, $email_subject, $custom_data))
		{
			$this->CI->flexi_cart_admin_model->set_status_message('send_email_successful', 'config');
			return TRUE;
		}
		else 
		{
			$this->CI->flexi_cart_admin_model->set_error_message('send_email_unsuccessful', 'config');
			return FALSE;
		}
	}	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * check_code_available
	 * Validates whether a discount/voucher code already exists in the database.
	 */
	public function check_code_available($code = FALSE, $omit_discount_id = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->check_code_available($code, $omit_discount_id);
	}
	
	###+++++++++++++++++++++++++###

	/**
	 * get_db_discount_query
	 * Gets records from the discount table using a user defined SQL SELECT query.
	 */
	public function get_db_discount_query($sql_select = FALSE, $sql_where = FALSE)
	{
		if ($this->CI->flexi_cart_admin_model->get_enabled_status('discounts'))
		{
			$default_pk = $this->CI->flexi->cart_database['discounts']['columns']['id'];

			$this->CI->db->where($this->CI->flexi->cart_database['discounts']['columns']['type'].' != 3');

			return $this->CI->flexi_cart_admin_model
				->get_table_data($this->CI->flexi->cart_database['discounts']['table'], $sql_select, $sql_where, $default_pk, 'discounts');
		}
		
		return FALSE;
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * add_discount_usage
	 * Adds the submitted usage quantity to the discount tables usage column.
	 */
	public function add_discount_usage($discount_id = FALSE, $usage_quantity = 0)
	{
		return $this->CI->flexi_cart_admin_model->update_db_row_quantity('discount', $discount_id, $usage_quantity, TRUE);
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * remove_discount_usage
	 * Removes the submitted usage quantity from the discount tables usage column.
	 */
	public function remove_discount_usage($discount_id = FALSE, $usage_quantity = 0)
	{		
		return $this->CI->flexi_cart_admin_model->update_db_row_quantity('discount', $discount_id, $usage_quantity, FALSE);
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_discount
	 * Inserts a new discount using a user defined SQL INSERT statement.
	 */
	public function insert_db_discount($sql_insert = FALSE)
	{
		// If a discount code is set, check it is unique.
		if (isset($sql_insert[$this->CI->flexi->cart_database['discounts']['columns']['code']]) && ! empty($sql_insert[$this->CI->flexi->cart_database['discounts']['columns']['code']]))
		{
			if (! $this->CI->flexi_cart_admin_model->check_code_available($sql_insert[$this->CI->flexi->cart_database['discounts']['columns']['code']]))
			{
				$this->CI->flexi_cart_admin_model->set_error_message('duplicate_discount_code', 'config');
				return FALSE;
			}
		}
	
		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['discounts']['table'], $sql_insert, 'discounts');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_discount
	 * Updates records in the discount table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_discount($sql_update = FALSE, $sql_where = FALSE)
	{
		if ($this->CI->flexi_cart_admin_model->get_enabled_status('discounts'))
		{
			// If a discount code is set, check it is unique.
			if (isset($sql_update[$this->CI->flexi->cart_database['discounts']['columns']['code']]) && ! empty($sql_update[$this->CI->flexi->cart_database['discounts']['columns']['code']]))
			{
				$table_row_id = (is_array($sql_where)) ? $sql_where[$this->CI->flexi->cart_database['discounts']['columns']['id']] : $sql_where;
				$code = $sql_update[$this->CI->flexi->cart_database['discounts']['columns']['code']];
			
				if (! $this->CI->flexi_cart_admin_model->check_code_available($code, $table_row_id))
				{
					$this->CI->flexi_cart_admin_model->set_error_message('duplicate_discount_code', 'config');
					return FALSE;
				}
			}

			$default_pk = $this->CI->flexi->cart_database['discounts']['columns']['id'];

			// Prevent reward voucher data being updated.
			$this->CI->db->where($this->CI->flexi->cart_database['discounts']['columns']['type'].' != 3');
			
			return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['discounts']['table'], $sql_update, $sql_where, $default_pk, 'discounts');
		}
		
		return FALSE;
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_discount
	 * Deletes records from the discount table using a user defined SQL WHERE statement.
	 */
	public function delete_db_discount($sql_where = FALSE)
	{
		if ($this->CI->flexi_cart_admin_model->get_enabled_status('discounts'))
		{
			$default_pk = $this->CI->flexi->cart_database['discounts']['columns']['id'];

			$this->CI->db->where($this->CI->flexi->cart_database['discounts']['columns']['type'].' != 3');
			
			return $this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['discounts']['table'], $sql_where, $default_pk, 'discounts');
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNT GROUPS 
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_db_discount_group_query
	 * Gets records from the discount group table using a user defined SQL SELECT query.
	 */
	public function get_db_discount_group_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['discount_groups']['columns']['id'];

		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['discount_groups']['table'], $sql_select, $sql_where, $default_pk, 'discounts');
	}
	
	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_discount_group
	 * Inserts a new discount group using a user defined SQL INSERT statement.
	 */
	public function insert_db_discount_group($sql_insert = FALSE)
	{		
		return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['discount_groups']['table'], $sql_insert, 'discounts');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_discount_group
	 * Updates records in the discount group table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_discount_group($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['discount_groups']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['discount_groups']['table'], $sql_update, $sql_where, $default_pk, 'discounts');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_discount_group
	 * Deletes records from the discount group table using a user defined SQL WHERE statement.
	 */
	public function delete_db_discount_group($sql_where = FALSE, $delete_children = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['discount_groups']['columns']['id'];

		if ($delete_children === 'delete')
		{
			// Get the ids of discounts records that are to be deleted, these ids will then be used to delete related child records. 
			$parent_ids = $this->get_discount_group_query($default_pk, $sql_where)->result_array();
		}

		if ($this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['discount_groups']['table'], $sql_where, $default_pk, 'discounts'))
		{
			if (! empty($parent_ids))
			{
				// Loop through ids of all deleted discount group records and delete all related discount group items.
				foreach($parent_ids as $id_data)
				{
					$sql_where_discount_group_items = array($this->CI->flexi->cart_database['discount_group_items']['columns']['group'] => $id_data[$default_pk]);			
					
					$this->delete_db_discount_group_item($sql_where_discount_group_items);
				}
			}
			
			return TRUE;
		}
		
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNT GROUP ITEMS 
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * check_item_in_discount_group
	 * Looks-up the discount group item table to check if an item id already exists within a specific discount group.
	 */
	public function check_item_in_discount_group($group_id = FALSE, $item_id = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->check_item_in_discount_group($group_id, $item_id);
	}

	###+++++++++++++++++++++++++###
		
	/**
	 * get_db_discount_group_item_query
	 * Gets records from the discount group items table using a user defined SQL SELECT query.
	 */
	public function get_db_discount_group_item_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['discount_group_items']['columns']['id'];

		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['discount_group_items']['table'], $sql_select, $sql_where, $default_pk, 'discounts');
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * insert_db_discount_group_item
	 * Inserts a new discount group item using a user defined SQL INSERT statement.
	 */	
	public function insert_db_discount_group_item($sql_insert = FALSE)
	{
		if (! empty($sql_insert[$this->CI->flexi->cart_database['discount_group_items']['columns']['group']]) && 
			! empty($sql_insert[$this->CI->flexi->cart_database['discount_group_items']['columns']['item']]))
		{
			$group_id = $sql_insert[$this->CI->flexi->cart_database['discount_group_items']['columns']['group']];
			$item_id = $sql_insert[$this->CI->flexi->cart_database['discount_group_items']['columns']['item']];
			
			if (! $this->CI->flexi_cart_admin_model->check_item_in_discount_group($group_id, $item_id))
			{
				return $this->CI->flexi_cart_admin_model->insert_table_data($this->CI->flexi->cart_database['discount_group_items']['table'], $sql_insert, 'discounts');
			}
		}
		
		return FALSE;
	}

	###+++++++++++++++++++++++++###	
	
	/**
	 * update_db_discount_group_item
	 * Updates records in the discount group item table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_discount_group_item($sql_update = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['discount_group_items']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['discount_group_items']['table'], $sql_update, $sql_where, $default_pk, 'discounts');
	}

	###+++++++++++++++++++++++++###

	/**
	 * delete_db_discount_group_item
	 * Deletes records from the discount group item table using a user defined SQL WHERE statement.
	 */
	public function delete_db_discount_group_item($sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['discount_group_items']['columns']['id'];

		return $this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['discount_group_items']['table'], $sql_where, $default_pk, 'discounts');
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNT TYPES 
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_db_discount_type_query
	 * Gets records from the discount type table using a user defined SQL SELECT query.
	 */
	public function get_db_discount_type_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['discount_types']['columns']['id'];

		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['discount_types']['table'], $sql_select, $sql_where, $default_pk, 'discounts');
	}
	
	// Note: There are no insert, update, or delete 'discount_type' functions as the table records are required for flexi cart to function correctly.
	// However, if required, the text labels for rows in the 'type' column can be changed, although this must be done directly via the database.

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNT METHODS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_db_discount_method_query
	 * Gets records from the discount method table using a user defined SQL SELECT query.
	 */
	public function get_db_discount_method_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['discount_methods']['columns']['id'];

		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['discount_methods']['table'], $sql_select, $sql_where, $default_pk, 'discounts');
	}
	
	// Note: There are no insert, update, or delete 'discount_method' functions as the table records are required for flexi cart to function correctly.
	// However, if required, the text labels for rows in the 'method' column can be changed, although this must be done directly via the database.

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNT TAX METHODS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_db_discount_tax_method_query
	 * Gets records from the discount tax method table using a user defined SQL SELECT query.
	 */
	public function get_db_discount_tax_method_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['discount_tax_methods']['columns']['id'];

		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['discount_tax_methods']['table'], $sql_select, $sql_where, $default_pk, 'discounts');
	}
	
	// Note: There are no insert, update, or delete 'discount_tax_method' functions as the table records are required for flexi cart to function correctly.
	// However, if required, the text labels for rows in the 'method' column can be changed, although this must be done directly via the database.

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// REWARD POINTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_db_reward_points_query
	 * Gets records from the reward points table using a user defined SQL SELECT query.
	 */
	public function get_db_reward_points_query($sql_select = FALSE, $sql_where = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->get_user_reward_points($sql_select, $sql_where);
	}

	###+++++++++++++++++++++++++###

	/**
	 * get_db_reward_point_summary
	 * Gets a summary of a users reward points stating the number of points that are pending, active, expired, cancelled and that have been converted to vouchers.
	 */
	public function get_db_reward_point_summary($sql_where = FALSE)
	{
		// If '$sql_where' is set, and is a number, we assume it is the user id (NOT the primary key).
		if (! empty($sql_where) && is_numeric($sql_where))
		{
			$sql_where = array($this->CI->flexi->cart_database['reward_points']['columns']['user'] => $sql_where);
		}

		return $this->CI->flexi_cart_admin_model->get_user_reward_point_summary($sql_where);
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * get_db_converted_reward_points_query
	 * Gets records from the converted reward points table using a user defined SQL SELECT query.
	 */
	public function get_db_converted_reward_points_query($sql_select = FALSE, $sql_where = FALSE)
	{
		if ($this->CI->flexi_cart_admin_model->get_enabled_status('rewards'))
		{
			$default_pk = $this->CI->flexi->cart_database['reward_points_converted']['columns']['id'];

			$this->CI->db->join($this->CI->flexi->cart_database['discounts']['table'], 
				$this->CI->flexi->cart_database['reward_points_converted']['columns']['discount'].' = '.$this->CI->flexi->cart_database['discounts']['columns']['id']);
				
			$this->CI->db->join($this->CI->flexi->cart_database['reward_points']['join_table'], 
				$this->CI->flexi->cart_database['reward_points_converted']['columns']['reward'].' = '.$this->CI->flexi->cart_database['reward_points']['columns']['id']);

			$this->CI->db->join($this->CI->flexi->cart_database['reward_points']['table'], $this->CI->flexi->cart_database['reward_points']['join']);

			$this->CI->db->order_by($this->CI->flexi->cart_database['reward_points_converted']['columns']['date'], 
				$this->CI->flexi->cart_database['reward_points']['columns']['order_date']);
			
			return $this->CI->flexi_cart_admin_model
				->get_table_data($this->CI->flexi->cart_database['reward_points_converted']['table'], $sql_select, $sql_where, $default_pk, 'rewards');
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * get_reward_point_conversion_tiers
	 * Returns an array of reward point tiers required to convert points to a voucher.
	 * For example, with 825 points and a conversion ratio of 250 points per voucher, the array would return 250, 500 and 750.
	 * The remaining 75 points would not be able to be converted until another 175 points were earnt.
	 */
	public function get_reward_point_conversion_tiers($reward_points = FALSE, $points_limit = FALSE)
	{		
		return $this->CI->flexi_cart_admin_model->get_reward_point_conversion_tiers($reward_points, $points_limit);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// REWARD VOUCHERS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * calculate_conversion_reward_points
	 * Rounds a submitted amount of reward points to the maximum number of reward points that can be converted into a voucher.
	 */
	public function calculate_conversion_reward_points($reward_points = FALSE, $points_limit = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->calculate_conversion_reward_points($reward_points, $points_limit);
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * calculate_reward_point_value
	 * Returns the monetary value of a submitted amount of reward points.
	 */
	public function calculate_reward_point_value($reward_points = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->calculate_reward_point_value($reward_points);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		
	/**
	 * get_db_voucher_query
	 * Gets reward voucher records from the discount table using a user defined SQL SELECT query.
	 */
	public function get_db_voucher_query($sql_select = FALSE, $sql_where = FALSE)
	{
		if ($this->CI->flexi_cart_admin_model->get_enabled_status('rewards'))
		{
			$default_pk = $this->CI->flexi->cart_database['discounts']['columns']['id'];

			// Ensure only reward vouchers are returned.
			$this->CI->db->where($this->CI->flexi->cart_database['discounts']['columns']['type'].' = 3');
			
			return $this->CI->flexi_cart_admin_model
				->get_table_data($this->CI->flexi->cart_database['discounts']['table'], $sql_select, $sql_where, $default_pk, 'rewards');
		}
		
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * insert_db_voucher
	 * Inserts a new reward voucher to the database. 
	 */
	public function insert_db_voucher($user_id = FALSE, $points_to_convert = FALSE, $code = FALSE, $description = FALSE, $expire_days = FALSE)
	{
		// If a voucher code is set, check it is unique.
		if ($code)
		{
			if (! $this->CI->flexi_cart_admin_model->check_code_available($code))
			{
				$this->CI->flexi_cart_admin_model->set_error_message('duplicate_voucher_code', 'config');
				return FALSE;
			}
		}
	
		return $this->CI->flexi_cart_admin_model->insert_voucher($user_id, $points_to_convert, $code, $description, $expire_days);
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * update_db_voucher
	 * Updates records in the discounts table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_voucher($sql_update = FALSE, $sql_where = FALSE)
	{
		if ($this->CI->flexi_cart_admin_model->get_enabled_status('rewards'))
		{
			// If a voucher code is set, check it is unique.
			if (isset($sql_update[$this->CI->flexi->cart_database['discounts']['columns']['code']]) && ! empty($sql_update[$this->CI->flexi->cart_database['discounts']['columns']['code']]))
			{
				$table_row_id = $sql_where[$this->CI->flexi->cart_database['discounts']['columns']['id']];
				$code = $sql_update[$this->CI->flexi->cart_database['discounts']['columns']['code']];
			
				if (! $this->CI->flexi_cart_admin_model->check_code_available($code, $table_row_id))
				{
					$this->CI->flexi_cart_admin_model->set_error_message('duplicate_voucher_code', 'config');
					return FALSE;
				}
			}

			$default_pk = $this->CI->flexi->cart_database['discounts']['columns']['id'];

			// Prevent discount data being updated.
			$this->CI->db->where($this->CI->flexi->cart_database['discounts']['columns']['type'].' = 3');
			
			return $this->CI->flexi_cart_admin_model->update_table_data($this->CI->flexi->cart_database['discounts']['table'], $sql_update, $sql_where, $default_pk, 'rewards');
		}
		
		return FALSE;
	}
	
	###+++++++++++++++++++++++++###
	
	/**
	 * delete_db_voucher
	 * Deletes records from the discount table using a user defined SQL WHERE statement.
	 */
	public function delete_db_voucher($sql_where = FALSE)
	{
		if ($this->CI->flexi_cart_admin_model->get_enabled_status('rewards'))
		{
			$default_pk = $this->CI->flexi->cart_database['discounts']['columns']['id'];

			$this->CI->db->where($this->CI->flexi->cart_database['discounts']['columns']['type'].' = 3');
			
			return $this->CI->flexi_cart_admin_model->delete_table_data($this->CI->flexi->cart_database['discounts']['table'], $sql_where, $default_pk, 'rewards');
		}
		
		return FALSE;
	}
	
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART CONFIG 
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_config_query
	 * Gets data from the cart configuration table using a user defined SQL SELECT query.
	 */
	public function get_db_config_query($sql_select = FALSE, $sql_where = FALSE)
	{		
		if ($this->CI->flexi->cart_database['configuration']['columns']['id'])
		{
			$default_pk = $this->CI->flexi->cart_database['configuration']['columns']['id'];

			// If SQL WHERE is not set, we assume the row id is 1.
			$sql_where = (empty($sql_where)) ? 1 : $sql_where;
		}
		else
		{
			$default_pk = FALSE;
		}
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['configuration']['table'], $sql_select, $sql_where, $default_pk, 'config');
	}

	###+++++++++++++++++++++++++###

	/**
	 * update_db_config
	 * Updates the cart configuration table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_db_config($sql_update = FALSE, $sql_where = FALSE)
	{
		if ($this->CI->flexi->cart_database['configuration']['columns']['id'])
		{
			$default_pk = $this->CI->flexi->cart_database['configuration']['columns']['id'];

			// If SQL WHERE is not set, we assume the row id is 1.
			$sql_where = (empty($sql_where)) ? 1 : $sql_where;
		}
		else
		{
			$default_pk = FALSE;
		}
			
		return $this->CI->flexi_cart_admin_model
			->update_table_data($this->CI->flexi->cart_database['configuration']['table'], $sql_update, $sql_where, $default_pk, 'config');
	}

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SAVE / LOAD CART DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_db_cart_data_query
	 * Gets records from the database cart data table using a user defined SQL SELECT query.
	 * Note: The cart data will be returned as a serialized string, to convert the string back to an array, use the standard PHP function 'unserialize()'.
	 */
	public function get_db_cart_data_query($sql_select = FALSE, $sql_where = FALSE)
	{
		$default_pk = $this->CI->flexi->cart_database['db_cart_data']['columns']['id'];
		
		return $this->CI->flexi_cart_admin_model
			->get_table_data($this->CI->flexi->cart_database['db_cart_data']['table'], $sql_select, $sql_where, $default_pk, 'db_cart_data');
	}
	
	/**
	 * unserialize_cart_data
	 * Returns an unserialized cart data array from the database cart data table using a user defined SQL statement.
	 */
	public function unserialize_cart_data($sql_where = FALSE)
	{
		return $this->CI->flexi_cart_admin_model->unserialize_cart_data($sql_where);
	}

	/** 
	 * save_cart_data
	 * Saves a carbon copy of the users current cart data array to the database.
	 */
	public function save_cart_data($user_id = 0, $set_readonly_status = FALSE, $sql_update = FALSE, $force_overwrite = FALSE)
	{
		if ($cart_data_id = $this->CI->flexi_cart_admin_model->save_cart_data($user_id, $set_readonly_status, $sql_update, $force_overwrite))
		{
			$this->CI->flexi_cart_admin_model->set_status_message('cart_data_save_successful', 'config');
			return $cart_data_id;
		}
		else 
		{
			$this->CI->flexi_cart_admin_model->set_error_message('cart_data_save_unsuccessful', 'config');
			return FALSE;
		}
	}
	
	/**
	 * load_cart_data
	 * Loads a saved cart data array from the database.
	 * The data is then used to update the users current cart data array with the saved/submitted data.
	 * When setting the data, locations, discounts and surcharges can be prevented from being updated so that they discount the default cart values.
	 */
	public function load_cart_data($sql_where = FALSE, $set_admin_data = FALSE, $reset_locations = FALSE, $reset_discounts = FALSE, $reset_surcharges = FALSE)
	{
		// Check the database cart data table exists in the config file and is enabled.
		if ($this->CI->flexi_cart_admin_model->get_enabled_status('db_cart_data'))
		{
			$cart_data = $this->CI->flexi_cart_admin_model->unserialize_cart_data($sql_where);
		
			if (! empty($cart_data))
			{		
				// Check if item shipped/cancelled quantities and discount data from the saved data should be loaded to the cart array.
				// If enabled, discounts that were active when the data was saved will be active regardless if they have since expired.
				// Item quantity data will also be loaded to provide an accurate stock level representation.
				if ($set_admin_data)
				{
					$admin_data = $this->CI->flexi_cart_admin_model->set_cart_admin_data($cart_data);		
					
					$this->CI->flexi->cart_contents['settings']['admin_data']['items'] = $admin_data['items'];
					$this->CI->flexi->cart_contents['settings']['admin_data']['discounts'] = $admin_data['discounts'];
				}
				
				// Check if any cart data is available to set to the cart array.
				if (empty($cart_data))
				{
					$this->CI->flexi_cart_admin_model->set_error_message('cart_data_load_unsuccessful', 'config');
					return FALSE;
				}
					
				// Set items to cart array.
				if (isset($cart_data['items']))
				{
					$this->CI->flexi->cart_contents['items'] = $cart_data['items'];
				}
				
				// Set shipping location to cart array.
				if (isset($cart_data['settings']['shipping']['location']) && ! $reset_locations)
				{
					$this->CI->flexi->cart_contents['settings']['shipping']['location'] = $cart_data['settings']['shipping']['location'];
				}
				
				// Set tax location to cart array.
				if (isset($cart_data['settings']['tax']['location']) && ! $reset_locations)
				{
					$this->CI->flexi->cart_contents['settings']['tax']['location'] = $cart_data['settings']['tax']['location'];
				}
				
				// Set discount codes to cart array.
				if (isset($cart_data['settings']['discounts']['codes']) && ! $reset_discounts)
				{
					$this->CI->flexi->cart_contents['settings']['discounts']['codes'] = $cart_data['settings']['discounts']['codes'];
				}
				
				// Set manually set discounts to cart array.
				if (isset($cart_data['settings']['discounts']['manual']) && ! $reset_discounts)
				{
					$this->CI->flexi->cart_contents['settings']['discounts']['manual'] = $cart_data['settings']['discounts']['manual'];
				}
				
				// Set manually set discounts to cart array.
				if (isset($cart_data['settings']['surcharges']) && ! $reset_surcharges)
				{
					$this->CI->flexi->cart_contents['settings']['surcharges'] = $cart_data['settings']['surcharges'];
				}
				
				// Set cart id to cart array.
				if (isset($cart_data['settings']['configuration']['cart_data_id']))
				{
					$this->CI->flexi->cart_contents['settings']['configuration']['cart_data_id'] = $cart_data['settings']['configuration']['cart_data_id'];
				}
				
				// Set order number to cart array.
				if (isset($cart_data['settings']['configuration']['order_number']))
				{
					$this->CI->flexi->cart_contents['settings']['configuration']['order_number'] = $cart_data['settings']['configuration']['order_number'];
				}
				
				// Load standard flexi cart library for the 'calculate_cart()', 'update_shipping()' and 'update_tax()' functions.
				$this->CI->load->library('flexi_cart');
				
				// Update shipping options and the tax rate.
				$this->CI->flexi_cart->update_shipping($cart_data['settings']['shipping']['id'], FALSE, FALSE);
				$this->CI->flexi_cart->update_tax(FALSE);

				// Recalculate cart.
				$this->CI->flexi_cart_model->calculate_cart();
				
				// Unset any existing status messages and set a new message, then save data to cart session array.		
				$this->CI->flexi->status_messages = array('public' => array(), 'admin' => array());
				$this->CI->flexi_cart_admin_model->set_status_message('cart_data_load_successful', 'config');		
				$this->CI->session->set_userdata(array($this->CI->flexi->cart['name'] => $this->CI->flexi->cart_contents));

				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	/**
	 * delete_db_cart_data
	 * Deletes saved cart data from the database.
	 * To prevent the accidental deletion of cart data from confirmed orders, unless '$force_delete = TRUE', only data from non-orders are deleted.
	 */
	public function delete_db_cart_data($sql_where = FALSE, $force_delete = FALSE)
	{
		if ($this->CI->flexi_cart_admin_model->delete_cart_data($sql_where, $force_delete))
		{
			$this->CI->flexi_cart_admin_model->set_status_message('cart_data_delete_successful', 'config');
			return TRUE;
		}
		else 
		{
			$this->CI->flexi_cart_admin_model->set_error_message('cart_data_delete_unsuccessful', 'config');
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MISC FUNCTIONS 
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * create_sql_where
	 * Adds a formatted SQL WHERE statement to CI's active record function.
	 * The primary purpose of this function is to be used to filter records from a user defined item (products) table, the returned items 
	 * are then added to a discount group that discounts can be applied to.
	 *
	 * The function requires the table column name that is being compared, the comparison operator '=', '>' etc, and the value that is being compared.
	 * SQL 'OR' statements can be set via the '$logic_operator',
	 * This function must be called before the final custom SQL query is run. 
	 * All SQL WHERE statements generated with this function will then be applied to the query.
	 */
	public function create_sql_where($column_name = FALSE, $comparison_operator = FALSE, $value = NULL, $logic_operator = 'AND')
	{
		$this->CI->flexi_cart_admin_model->create_sql_where($column_name, $comparison_operator, $value, $logic_operator);
	}

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// QUERY BUILDER FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * The following functions set SQL statements using active record.
	 * The purpose of the functions is allow developers to create custom SELECT, JOIN, WHERE, ORDER BY, GROUP BY and LIMIT statements that are then
	 * applied in addition to the default statements set by functions within flexi cart.
	 *
	 * The SQL functions should be called prior to calling any functions that support query builder functions. Supportive functions are stated in the user guide.
	 * Data can be submitted into each of the functions in the same manner as CI's Active Record functions (That share the same clause type).
	 **/

	public function sql_select($columns = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('select', $columns, FALSE, FALSE, $overwrite_existing);
	}
	
	public function sql_where($column = FALSE, $value = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('where', $column, $value, FALSE, $overwrite_existing);
	}
	
	public function sql_or_where($column = FALSE, $value = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('or_where', $column, $value, FALSE, $overwrite_existing);
	}
	
	public function sql_where_in($column = FALSE, $value = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('where_in', $column, $value, FALSE, $overwrite_existing);
	}
	
	public function sql_or_where_in($column = FALSE, $value = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('or_where_in', $column, $value, FALSE, $overwrite_existing);
	}
	
	public function sql_where_not_in($column = FALSE, $value = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('where_not_in', $column, $value, FALSE, $overwrite_existing);
	}
	
	public function sql_or_where_not_in($column = FALSE, $value = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('or_where_not_in', $column, $value, FALSE, $overwrite_existing);
	}
	
	public function sql_like($column = FALSE, $value = FALSE, $wildcard_position = 'both', $overwrite_existing = FALSE)
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('like', $column, $value, $wildcard_position, $overwrite_existing);
	}
	
	public function sql_or_like($column = FALSE, $value = FALSE, $wildcard_position = 'both', $overwrite_existing = FALSE)
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('or_like', $column, $value, $wildcard_position, $overwrite_existing);
	}
	
	public function sql_not_like($column = FALSE, $value = FALSE, $wildcard_position = 'both', $overwrite_existing = FALSE)
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('not_like', $column, $value, $wildcard_position, $overwrite_existing);
	}
	
	public function sql_or_not_like($column = FALSE, $value = FALSE, $wildcard_position = 'both', $overwrite_existing = FALSE)
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('or_not_like', $column, $value, $wildcard_position, $overwrite_existing);
	}
	
	public function sql_join($column = FALSE, $join_on = FALSE, $join_type = FALSE, $overwrite_existing = FALSE)
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('join', $column, $join_on, $join_type, $overwrite_existing);
	}
	
	public function sql_order_by($column = FALSE, $sort_direction = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('order_by', $column, $sort_direction, FALSE, $overwrite_existing);
	}
	
	public function sql_group_by($columns = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('group_by', $columns, FALSE, FALSE, $overwrite_existing);
	}
	
	public function sql_limit($limit = FALSE, $offset = FALSE, $overwrite_existing = FALSE) 
	{
		$this->CI->flexi_cart_admin_model->set_sql_to_var('limit', $limit, $offset, $overwrite_existing);
	}
	
	/**
	 * sql_clear
	 * Clears any custom user defined SQL Active Record functions.
	 **/	
	public function sql_clear() 
	{
		$this->CI->flexi_cart_admin_model->clear_arg_sql();
	}
}

/* End of file Flexi_cart_admin.php */
/* Location: ./application/libraries/Flexi_cart_admin.php */