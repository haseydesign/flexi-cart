<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: flexi cart admin model
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

class Flexi_cart_admin_model extends Flexi_cart_lite_model
{
	public function __construct() 
	{
		// Set flexi cart SQL clauses.
		$this->flexi->select = $this->flexi->join = $this->flexi->order_by = $this->flexi->group_by = $this->flexi->limit = array();
		$this->flexi->where = $this->flexi->or_where = $this->flexi->where_in = $this->flexi->or_where_in = $this->flexi->where_not_in = $this->flexi->or_where_not_in = array();
		$this->flexi->like = $this->flexi->or_like = $this->flexi->not_like = $this->flexi->or_not_like = array();
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// GENERIC CRUD FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_table_data
	 * Gets records from a submitted table using a user defined SQL SELECT query.
	 */
	public function get_table_data($table_name = FALSE, $sql_select = FALSE, $sql_where = FALSE, $default_primary_key = FALSE, $status_check = FALSE)
	{
		// Check the table exists in the config file and is enabled.
		if (empty($table_name) || ! $this->get_enabled_status($status_check))
		{
			return FALSE;
		}

		// If '$sql_where' is set, and is numeric, we assume it is the tables primary key.
		if (! empty($sql_where) && is_numeric($sql_where) && $default_primary_key)
		{
			$sql_where = array($default_primary_key => $sql_where);
		}		
	
		// Check '$sql_where' value isn't 'FALSE'.
		$sql_where = ($sql_where) ? $sql_where : array();
	
		// Set any custom defined SQL statements.
		$this->set_custom_sql_to_db($sql_select, $sql_where);
		
		return $this->db->get($table_name);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * insert_table_data
	 * Inserts a record into a submitted table using a user defined SQL INSERT statement.
	 */
	public function insert_table_data($table_name = FALSE, $sql_insert = FALSE, $status_check = FALSE)
	{
		// Check submitted data is valid and that the table exists in the config file and is enabled.
		if (empty($table_name) || empty($sql_insert) || ! is_array($sql_insert) || ! $this->get_enabled_status($status_check))
		{
			return FALSE;
		}
		
		$this->db->insert($table_name, $sql_insert);
		
		if ($this->db->affected_rows() > 0) 
		{
			$this->set_status_message('database_data_inserted', 'config');
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * update_table_data
	 * Updates records in a submitted table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_table_data($table_name = FALSE, $sql_update = FALSE, $sql_where = FALSE, $default_primary_key = FALSE, $status_check = FALSE)
	{
		// Check submitted data is valid and that the table exists in the config file and is enabled.
		if (empty($table_name) || empty($sql_update) || ! is_array($sql_update) || ! $this->get_enabled_status($status_check))
		{
			return FALSE;
		}

		// If '$sql_where' is set, and is numeric, we assume it is the tables primary key.
		if (! empty($sql_where) && is_numeric($sql_where) && $default_primary_key)
		{
			$sql_where = array($default_primary_key => $sql_where);
		}		
		
		// Check '$sql_where' value isn't 'FALSE'.
		$sql_where = ($sql_where) ? $sql_where : array();
		
		// Set any custom defined SQL statements.
		$this->set_custom_sql_to_db();

		$this->db->update($table_name, $sql_update, $sql_where);
		
		if ($this->db->affected_rows() > 0) 
		{
			$this->set_status_message('database_data_updated', 'config');
			return $this->db->affected_rows();
		}
		else
		{
			return FALSE;
		}
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * delete_table_data
	 * Deletes records from a submitted table using a user defined SQL WHERE statement.
	 */
	public function delete_table_data($table_name = FALSE, $sql_where = FALSE, $default_primary_key = FALSE, $status_check = FALSE)
	{
		// Check submitted data is valid and that the table exists in the config file and is enabled.
		if (empty($table_name) || empty($sql_where) || ! $this->get_enabled_status($status_check))
		{
			return FALSE;
		}

		// If '$sql_where' is set, and is numeric, we assume it is the tables primary key.
		if (! empty($sql_where) && is_numeric($sql_where) && $default_primary_key)
		{
			$sql_where = array($default_primary_key => $sql_where);
		}		

		// Check '$sql_where' value isn't 'FALSE'.
		$sql_where = ($sql_where) ? $sql_where : array();
		
		// Set any custom defined SQL statements.
		$this->set_custom_sql_to_db();

		$this->db->delete($table_name, $sql_where);
		
		if ($this->db->affected_rows() > 0) 
		{
			$this->set_status_message('database_data_deleted', 'config');
			return $this->db->affected_rows();
		}
		else
		{
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CREATE SQL LIKE QUERY AGAINST MULTIPLE DEFINED COLUMNS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * create_sql_like
	 * Create an sql like query against multiple defined columns.
	 */
	public function create_sql_like($order_summary_cols = FALSE, $search_query = FALSE, $exact_match = FALSE)
	{
		if (! empty($order_summary_cols) && is_array($order_summary_cols) && ! empty($search_query))
		{
			// Create a concatenated string of columns to search against.
			$concat_cols = "(CONCAT_WS(' '";
			foreach ($order_summary_cols as $column)
			{
				$concat_cols .= ', '.$column;
			}

			// Convert search query to array if it isn't already.
			$query_terms = (is_array($search_query)) ? $search_query : explode(' ', $search_query);	
			
			// Define whether to use 'AND' or 'OR' condition.
			$sql_condition = ($exact_match) ? ' AND ' : ' OR ';
			
			// Create array of user column data and each search query term.
			$i = 0;
			$sql_like = "(";
			foreach ($query_terms as $term)
			{
				$sql_like .= $concat_cols.", ".$i++.") LIKE '%".$this->db->escape_like_str($term)."%')".$sql_condition;
			}
			$sql_like = rtrim($sql_like, $sql_condition).")";
			
			// Set SQL WHERE LIKE statement to be passed to get_table_data() function.
			$this->db->where($sql_like, NULL, FALSE);
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CREATE SQL WHERE VIA SELECT MENUS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * create_sql_where
	 * Adds a SQL WHERE statement to CI's active record function.
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
		// Check submitted data is valid.
		if (empty($column_name) || empty($comparison_operator))
		{
			return FALSE;
		}
		
		// Ensure the case of the comparison operators are correct.
		$comparison_operator = strtolower($comparison_operator);
		$logic_operator = strtoupper($logic_operator);
	
		// Explode string into an array on ',' character for SQL BETWEEN and IN statements.
		if (in_array($comparison_operator, array(17, 'between', 18, 'not_between', 19, 'in', 20, 'not_in')))
		{
			foreach(explode(',', $value) as $explode_value)
			{
				$value_array[] = trim($explode_value);
			}
		}
		
		// Generate the SQL WHERE statement.
		if ($comparison_operator == 1 || $comparison_operator == '=') // Is equal to ( = )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where($column_name, $value);
			}
			else 
			{
				$this->db->where($column_name, $value);
			}
		}
		else if ($comparison_operator == 2 || $comparison_operator == '!=') // Is not equal to ( != )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where($column_name.' != ', $value);
			}
			else 
			{
				$this->db->where($column_name.' != ', $value);
			}
		}
		else if ($comparison_operator == 3 || $comparison_operator == '<') // Is less than ( < )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where($column_name.' < ', $value);
			}
			else 
			{
				$this->db->where($column_name.' < ', $value);
			}
		}
		else if ($comparison_operator == 4 || $comparison_operator == '<=') // Is less than or equal to ( <= )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where($column_name.' <= ', $value);
			}
			else 
			{
				$this->db->where($column_name.' <= ', $value);
			}
		}
		else if ($comparison_operator == 5 || $comparison_operator == '>') // Is more than ( > )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where($column_name.' > ', $value);
			}
			else 
			{
				$this->db->where($column_name.' > ', $value);
			}
		}
		else if ($comparison_operator == 6 || $comparison_operator == '>=') // Is more than or equal to ( >= )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where($column_name.' >= ', $value);
			}
			else 
			{
				$this->db->where($column_name.' >= ', $value);
			}
		}
		else if ($comparison_operator == 7 || $comparison_operator == 'like') // Contains ( LIKE '%xxx%' )
		{
			if ($logic_operator == 'OR')
			{
				#$this->db->or_like($column_name, $value); // CI bug generates 'AND LIKE'
				$this->db->or_where($column_name.' LIKE', '%'.$value.'%');
			}
			else 
			{
				$this->db->like($column_name, $value);
			}
		}
		else if ($comparison_operator == 8 || $comparison_operator == 'not_like') // Does not contain ( NOT LIKE '%xxx%' )
		{
			if ($logic_operator == 'OR')
			{
				#$this->db->or_not_like($column_name, $value); // CI bug generates 'AND NOT LIKE'
				$this->db->or_where($column_name.' NOT LIKE', '%'.$value.'%');
			}
			else 
			{
				$this->db->not_like($column_name, $value);
			}
		}
		else if ($comparison_operator == 9 || $comparison_operator == 'begin_like') // Begins with ( LIKE 'xxx%' )
		{
			if ($logic_operator == 'OR')
			{
				#$this->db->or_like($column_name, $value, 'after'); // CI bug generates 'AND LIKE'
				$this->db->or_where($column_name.' LIKE', $value.'%');
			}
			else 
			{
				$this->db->like($column_name, $value, 'after');
			}
		}
		else if ($comparison_operator == 10 || $comparison_operator == 'not_begin_like') // Does not begin with ( NOT LIKE 'xxx%' )
		{
			if ($logic_operator == 'OR')
			{
				#$this->db->or_not_like($column_name, $value, 'after'); // CI bug generates 'AND NOT LIKE'
				$this->db->or_where($column_name.' NOT LIKE', $value.'%');
			}
			else 
			{
				$this->db->not_like($column_name, $value, 'after');
			}
		}
		else if ($comparison_operator == 11 || $comparison_operator == 'end_like') // Ends with ( LIKE '%xxx' )
		{
			if ($logic_operator == 'OR')
			{
				#$this->db->or_like($column_name, $value, 'before'); // CI bug generates 'AND LIKE'
				$this->db->or_where($column_name.' LIKE', '%'.$value);
			}
			else 
			{
				$this->db->like($column_name, $value, 'before');
			}
		}
		else if ($comparison_operator == 12 || $comparison_operator == 'not_end_like') // Does not end with ( NOT LIKE '%xxx' )
		{
			if ($logic_operator == 'OR')
			{
				#$this->db->or_not_like($column_name, $value, 'before'); // CI bug generates 'AND NOT LIKE'
				$this->db->or_where($column_name.' NOT LIKE', '%'.$value);
			}
			else 
			{
				$this->db->not_like($column_name, $value, 'before');
			}
		}
		else if ($comparison_operator == 13 || $comparison_operator == 'null') // Is null ( IS NULL )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where($column_name.' IS NULL');
			}
			else 
			{
				$this->db->where($column_name.' IS NULL');
			}
		}
		else if ($comparison_operator == 14 || $comparison_operator == 'not_null') // Is not null ( IS NOT NULL )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where($column_name.' IS NOT NULL');
			}
			else 
			{
				$this->db->where($column_name.' IS NOT NULL');
			}
		}
		else if ($comparison_operator == 15 || $comparison_operator == 'empty') // Is empty ( = '' )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where($column_name.' = ""');
			}
			else 
			{
				$this->db->where($column_name.' = ""');
			}
		}
		else if ($comparison_operator == 16 || $comparison_operator == 'not_empty') // Is not empty ( != '' )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where($column_name.' != ""');
			}
			else 
			{
				$this->db->where($column_name.' != ""');
			}
		}
		else if ($comparison_operator == 17 || $comparison_operator == 'between') // Is between ( BETWEEN X AND X )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where($column_name.' BETWEEN '.$this->db->escape($value_array[0]).' AND '.$this->db->escape($value_array[1]));
			}
			else 
			{
				$this->db->where($column_name.' BETWEEN '.$this->db->escape($value_array[0]).' AND '.$this->db->escape($value_array[1]));
			}
		}
		else if ($comparison_operator == 18 || $comparison_operator == 'not_between') // Is not between ( NOT BETWEEN X AND X )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where($column_name.' NOT BETWEEN '.$this->db->escape($value_array[0]).' AND '.$this->db->escape($value_array[1]));
			}
			else 
			{
				$this->db->where($column_name.' NOT BETWEEN '.$this->db->escape($value_array[0]).' AND '.$this->db->escape($value_array[1]));
			}
		}
		else if ($comparison_operator == 19 || $comparison_operator == 'in') // Is in list ( IN ('x', 'xx', 'xxx') )
		{		
			if ($logic_operator == 'OR')
			{
				$this->db->or_where_in($column_name, $value_array);
			}
			else 
			{
				$this->db->where_in($column_name, $value_array);
			}
		}
		else if ($comparison_operator == 20 || $comparison_operator == 'not_in') // Is not in list ( NOT IN ('x', 'xx', 'xxx') )
		{
			if ($logic_operator == 'OR')
			{
				$this->db->or_where_not_in($column_name, $value_array);
			}
			else 
			{
				$this->db->where_not_in($column_name, $value_array);
			}
		}
		
		return TRUE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM STOCK / DISCOUNT USAGE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * update_db_row_quantity
	 * Adds or removes a quantity from either the item stock or discount database table.
	 */
	public function update_db_row_quantity($table = FALSE, $identifier = FALSE, $quantity = 0, $add_quantity = TRUE)
	{
		if ($table == 'discount')
		{
			$status_check = 'discounts';
			$table = $this->flexi->cart_database['discounts']['table'];
			$row_id_column = $this->flexi->cart_database['discounts']['columns']['id'];
			$target_column = $this->flexi->cart_database['discounts']['columns']['usage_limit'];
		}
		else
		{
			$status_check = 'item_stock';
			$table = $this->flexi->cart_database['item_stock']['table'];
			$row_id_column = $this->flexi->cart_database['item_stock']['columns']['item'];
			$target_column = $this->flexi->cart_database['item_stock']['columns']['quantity'];
		}

		// Check data is valid and that the table exists in the config file and is enabled.
		if (! $this->get_enabled_status($status_check) || ! $this->is_positive($identifier) || ! $this->is_positive($quantity))
		{
			return FALSE;
		}
		
		$operator = ($add_quantity) ? '+' : '-';
		
		$this->db->set($target_column, $target_column.$operator.$quantity, FALSE)
			->where($row_id_column, $identifier)
			->update($table);

		return ($this->db->affected_rows() > 0);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ORDER MANAGEMENT
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * update_order_summary
	 * Updates records in the order summary table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_order_summary($sql_update = FALSE, $sql_where = FALSE)
	{
		// Create table aliases.
		$tbl_col_order_summary = $this->flexi->cart_database['order_summary']['columns'];
		$tbl_col_order_details = $this->flexi->cart_database['order_details']['columns'];
		$tbl_col_order_status = $this->flexi->cart_database['order_status']['columns'];
		$tbl_col_item_stock = $this->flexi->cart_database['item_stock']['columns'];
		
		// If '$sql_where' is set, and is not an array, we assume it is the tables order number (primary key).
		if (! empty($sql_where) && ! is_array($sql_where))
		{
			$sql_where = array($this->flexi->cart_database['order_summary']['columns']['order_number'] => $sql_where);
		}

		// If item stock is auto allocated, check whether the status of the order has changed.
		if ($this->get_enabled_status('item_stock') && $this->get_enabled_status('auto_stock_status') && isset($sql_update[$tbl_col_order_summary['status']]))
		{
			$sql_select = array(
				$tbl_col_order_summary['order_number'],
				$tbl_col_order_summary['cart_data'],
				$tbl_col_order_status['cancelled']
			);
			
			// Get current order status, before update.
			$current_status_query = $this->db->select($sql_select)
				->from($this->flexi->cart_database['order_summary']['table'])
				->join($this->flexi->cart_database['order_status']['table'], $tbl_col_order_summary['status'].' = '.$tbl_col_order_status['id'])
				->where($sql_where)
				->get();

			// Get order status of submitted update data.
			$status_sql_where = array($tbl_col_order_status['id'] => $sql_update[$tbl_col_order_summary['status']]);			
			$updated_status_query = $this->get_table_data($this->flexi->cart_database['order_status']['table'], $tbl_col_order_status['cancelled'], $status_sql_where);
				
			// Check if the original order and submitted data contain a valid order status.
			if ($current_status_query->num_rows() == 1 && $updated_status_query->num_rows() == 1)
			{
				$current_status_data = $current_status_query->row_array();
				$updated_status_data = $updated_status_query->row_array();
				
				// If the order status has changed, the stock needs to be reallocated for each item in the order.
				if ($current_status_data[$tbl_col_order_status['cancelled']] != $updated_status_data[$tbl_col_order_status['cancelled']])
				{
					$sql_select = array(
						$tbl_col_order_details['item_id'],
						$tbl_col_order_details['item_quantity'],
						$tbl_col_order_details['item_quantity_cancelled']
					);
					
					$order_detail_sql_where = array($tbl_col_order_details['order_number'] => $current_status_data[$tbl_col_order_summary['order_number']]);

					$query = $this->db->select($sql_select)
						->from($this->flexi->cart_database['order_details']['table'])
						->where($order_detail_sql_where)
						->get();
					
					if ($query->num_rows() > 0)
					{
						$order_detail_data = $query->result_array();
						
						foreach($order_detail_data as $order_detail)
						{
							// Get current quantities.
							$saved_quantity = $order_detail[$tbl_col_order_details['item_quantity']];
							$saved_quantity_cancelled = $order_detail[$tbl_col_order_details['item_quantity_cancelled']];
							
							// Calculate stock allocation.
							$allocate_stock_quantity = ($updated_status_data[$tbl_col_order_status['cancelled']] == 1) ?
								($saved_quantity - $saved_quantity_cancelled) : ($saved_quantity_cancelled - $saved_quantity);
							
							$this->update_stock_quantity(FALSE, $order_detail[$tbl_col_order_details['item_id']], $allocate_stock_quantity, 0);
						}
					}
					
					// Update discount and reward voucher usage.
					if ($tbl_col_order_summary['cart_data'] && $cart_data = $this->unserialize_cart_data($current_status_data[$tbl_col_order_summary['cart_data']]))
					{
						$current_order_status = (bool)$current_status_data[$tbl_col_order_status['cancelled']];
						$operator = ($current_order_status) ? '-' : '+';
						
						$this->update_discount_usage($cart_data, $current_order_status, $operator);
					}
				}				
			}
		}
		
		return $this->update_table_data($this->flexi->cart_database['order_summary']['table'], $sql_update, $sql_where, FALSE, 'orders');
	}
	
	/**
	 * update_order_details
	 * Updates records in the order detail table using a user defined SQL WHERE and UPDATE statement.
	 */
	public function update_order_details($sql_update = FALSE, $sql_where = FALSE)
	{
		// Create table aliases.
		$tbl_col_order_summary = $this->flexi->cart_database['order_summary']['columns'];
		$tbl_col_order_details = $this->flexi->cart_database['order_details']['columns'];
		$tbl_col_order_status = $this->flexi->cart_database['order_status']['columns'];
		$tbl_col_item_stock = $this->flexi->cart_database['item_stock']['columns'];

		// If '$sql_where' is set, and is numeric, we assume it is the tables primary key.
		if (! empty($sql_where) && is_numeric($sql_where))
		{
			$sql_where = array($this->flexi->cart_database['order_details']['columns']['id'] => $sql_where);
		}
		
		// Check if any data for the quantity ordered, shipped or cancelled has been set.
		if ($this->get_enabled_status('ship_cancel_quantities') && (isset($sql_update[$tbl_col_order_details['item_quantity']]) || 
			isset($sql_update[$tbl_col_order_details['item_quantity_shipped']]) || isset($sql_update[$tbl_col_order_details['item_quantity_cancelled']])))
		{
			$sql_select = array(
				$tbl_col_order_details['id'],
				$tbl_col_order_details['item_id'],
				$tbl_col_order_details['item_quantity'],
				$tbl_col_order_details['item_quantity_shipped'],
				$tbl_col_order_details['item_quantity_cancelled'],
				$tbl_col_order_details['item_shipped_date'],
				$tbl_col_order_status['cancelled']
			);
			
			// Set defined SQL statements.
			$this->set_custom_sql_to_db($sql_select, $sql_where);

			$query = $this->db->from($this->flexi->cart_database['order_details']['table'])
				->join($this->flexi->cart_database['order_summary']['table'], $tbl_col_order_summary['order_number'].' = '.$tbl_col_order_details['order_number'])
				->join($this->flexi->cart_database['order_status']['table'], $tbl_col_order_summary['status'].' = '.$tbl_col_order_status['id'])
				->get();
			
			if ($query->num_rows() > 0)
			{
				$order_detail_data = $query->result_array();
				$affected_rows = 0;
				
				foreach($order_detail_data as $order_detail)
				{
					// Get current saved quantities.
					$saved_quantity = $order_detail[$tbl_col_order_details['item_quantity']];
					$saved_quantity_shipped = $order_detail[$tbl_col_order_details['item_quantity_shipped']];
					$saved_quantity_cancelled = $order_detail[$tbl_col_order_details['item_quantity_cancelled']];
				
					// If the existing order status is not cancelled.
					if ($order_detail[$tbl_col_order_status['cancelled']] != 1)
					{
						// If a new quantity has not been submitted for update, use the current quantities.
						$new_quantity = (isset($sql_update[$tbl_col_order_details['item_quantity']])) ? 
							$sql_update[$tbl_col_order_details['item_quantity']] : $saved_quantity;
						$new_shipped_quantity = (isset($sql_update[$tbl_col_order_details['item_quantity_shipped']])) ? 
							$sql_update[$tbl_col_order_details['item_quantity_shipped']] : $saved_quantity_shipped;
						$new_cancelled_quantity = (isset($sql_update[$tbl_col_order_details['item_quantity_cancelled']])) ? 
							$sql_update[$tbl_col_order_details['item_quantity_cancelled']] : $saved_quantity_cancelled;
							
						// Check the shipped and cancelled quantities are not larger than the ordered quantity.
						$new_shipped_quantity = $sql_update[$tbl_col_order_details['item_quantity_shipped']] = ($new_shipped_quantity > $new_quantity) ? 
							$new_quantity : $new_shipped_quantity;
						$new_cancelled_quantity = $sql_update[$tbl_col_order_details['item_quantity_cancelled']] = ($new_cancelled_quantity > $new_quantity) ? 
							$new_quantity : $new_cancelled_quantity;
						
						// Check whether the 'shipped date' needs to be updated.
						// The shipped date is required as a reference point that reward points are activated from.
						if ($new_shipped_quantity == 0)
						{
							$sql_update[$tbl_col_order_details['item_shipped_date']] = 0;
						}
						else if ($saved_quantity_shipped == 0 && $new_shipped_quantity > 0)
						{
							$sql_update[$tbl_col_order_details['item_shipped_date']] = $this->database_date_time();
						}
						
						// Calculate the amount or stock that needs to be re-allocated.
						$allocate_stock_quantity = (($saved_quantity - ($saved_quantity_cancelled - $new_cancelled_quantity)) - $new_quantity);
					}
					// Else, order is cancelled, prevent any updates to the item quantity columns and calculate stock that needs to be reallocated.
					else
					{
						unset($sql_update[$tbl_col_order_details['item_quantity']]);
						unset($sql_update[$tbl_col_order_details['item_quantity_shipped']]);
						unset($sql_update[$tbl_col_order_details['item_quantity_cancelled']]);
						unset($sql_update[$tbl_col_order_details['item_shipped_date']]);
						
						// Ensure no stock is allocated.
						$allocate_stock_quantity = 0;						
					}
					
					$sql_where = array($tbl_col_order_details['id'] => $order_detail[$tbl_col_order_details['id']]);
					
					$this->update_table_data($this->flexi->cart_database['order_details']['table'], $sql_update, $sql_where, FALSE, 'orders');
					
					$affected_rows += $this->db->affected_rows();

					if ($this->db->affected_rows() == 1 && $allocate_stock_quantity != 0)
					{
						$this->update_stock_quantity(FALSE, $order_detail[$tbl_col_order_details['item_id']], $allocate_stock_quantity, 0);
					}
				}
			}
			
			return $affected_rows;
		}
		// Else, no item or stock quantity data needs to be calculated, so just update table with submitted data.
		else
		{
			return $this->update_table_data($this->flexi->cart_database['order_details']['table'], $sql_update, $sql_where, FALSE, 'orders');
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * get_refund_itemised
	 * Returns an itemised query of refund totals for all items that have been cancelled within an order.
	 */
	public function get_refund_itemised($order_number = FALSE)
	{
		// Check the table exists in the config file and is enabled.
		if (! $this->get_enabled_status('orders') || ! $this->get_enabled_status('ship_cancel_quantities'))
		{
			return FALSE;
		}

		$tbl_order_details = $this->flexi->cart_database['order_details'];
		$tbl_col_order_details = $this->flexi->cart_database['order_details']['columns'];

		// Select all enabled columns that are to be totalled. 
		$sql_select = array($tbl_col_order_details['id']);
		if ($tbl_col_order_details['item_price'])
		{
			$sql_select[] = '('.$tbl_col_order_details['item_quantity_cancelled'].' * '.$tbl_col_order_details['item_price'].') AS '.$tbl_col_order_details['item_price'];
		}
		if ($tbl_col_order_details['item_discount_price'])
		{
			$sql_select[] = '('.$tbl_col_order_details['item_quantity_cancelled'].' * '.$tbl_col_order_details['item_discount_price'].') AS '.$tbl_col_order_details['item_discount_price'];
		}
		if ($tbl_col_order_details['item_tax'])
		{
			$sql_select[] = '('.$tbl_col_order_details['item_quantity_cancelled'].' * '.$tbl_col_order_details['item_tax'].') AS '.$tbl_col_order_details['item_tax'];
		}
		if ($tbl_col_order_details['item_shipping_rate'])
		{
			$sql_select[] = '('.$tbl_col_order_details['item_quantity_cancelled'].' * '.$tbl_col_order_details['item_shipping_rate'].') AS '.$tbl_col_order_details['item_shipping_rate'];
		}
		if ($tbl_col_order_details['item_weight'])
		{
			$sql_select[] = '('.$tbl_col_order_details['item_quantity_cancelled'].' * '.$tbl_col_order_details['item_weight'].') AS '.$tbl_col_order_details['item_weight'];
		}
		if ($tbl_col_order_details['item_reward_points'])
		{
			$sql_select[] = '('.$tbl_col_order_details['item_quantity_cancelled'].' * '.$tbl_col_order_details['item_reward_points'].') AS '.$tbl_col_order_details['item_reward_points'];
		}
		
		$sql_where = array($tbl_col_order_details['order_number'] => $order_number);

		// Set any custom defined SQL statements.
		$this->set_custom_sql_to_db($sql_select, $sql_where);
		
		return $this->db->get($tbl_order_details['table']);
	}

	/**
	 * get_refund_summary
	 * Returns a summary of refund totals for all items that have been cancelled within an order.
	 */
	public function get_refund_summary($order_number = FALSE)
	{
		// Check the table exists in the config file and is enabled.
		if (! $this->get_enabled_status('orders') || ! $this->get_enabled_status('ship_cancel_quantities'))
		{
			return FALSE;
		}

		$tbl_order_details = $this->flexi->cart_database['order_details'];
		$tbl_col_order_details = $this->flexi->cart_database['order_details']['columns'];

		// Select all enabled columns that are to be summarised. 
		$sql_select = array();
		if ($tbl_col_order_details['item_price'])
		{
			$sql_select[] = 'SUM('.$tbl_col_order_details['item_quantity_cancelled'].' * '.$tbl_col_order_details['item_price'].') AS '.$tbl_col_order_details['item_price'];
		}
		if ($tbl_col_order_details['item_discount_price'])
		{
			$sql_select[] = 'SUM('.$tbl_col_order_details['item_quantity_cancelled'].' * '.$tbl_col_order_details['item_discount_price'].') AS '.$tbl_col_order_details['item_discount_price'];
		}
		if ($tbl_col_order_details['item_tax'])
		{
			$sql_select[] = 'SUM('.$tbl_col_order_details['item_quantity_cancelled'].' * '.$tbl_col_order_details['item_tax'].') AS '.$tbl_col_order_details['item_tax'];
		}
		if ($tbl_col_order_details['item_shipping_rate'])
		{
			$sql_select[] = 'SUM('.$tbl_col_order_details['item_quantity_cancelled'].' * '.$tbl_col_order_details['item_shipping_rate'].') AS '.$tbl_col_order_details['item_shipping_rate'];
		}
		if ($tbl_col_order_details['item_weight'])
		{
			$sql_select[] = 'SUM('.$tbl_col_order_details['item_quantity_cancelled'].' * '.$tbl_col_order_details['item_weight'].') AS '.$tbl_col_order_details['item_weight'];
		}
		if ($tbl_col_order_details['item_reward_points'])
		{
			$sql_select[] = 'SUM('.$tbl_col_order_details['item_quantity_cancelled'].' * '.$tbl_col_order_details['item_reward_points'].') AS '.$tbl_col_order_details['item_reward_points'];
		}
		
		$sql_where = array($tbl_col_order_details['order_number'] => $order_number);
		
		// Set any custom defined SQL statements.
		$this->set_custom_sql_to_db($sql_select, $sql_where);
		
		return $this->db->get($tbl_order_details['table']);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// REWARD POINTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_user_reward_points
	 * Gets records from the reward points table using a user defined SQL SELECT query.
	 */
	public function get_user_reward_points($sql_select = FALSE, $sql_where = FALSE)
	{
		// Check the table exists in the config file and is enabled.
		if (! $this->get_enabled_status('rewards'))
		{
			return FALSE;
		}

		$tbl_reward_points = $this->flexi->cart_database['reward_points'];
		$tbl_col_reward_points = $this->flexi->cart_database['reward_points']['columns'];
		$tbl_convert_points = $this->flexi->cart_database['reward_points_converted'];
		$tbl_col_convert_points = $this->flexi->cart_database['reward_points_converted']['columns'];
		
		###+++++++++++++++++++++++++###
		
		// Set any custom defined SQL statements.
		$this->set_custom_sql_to_db($sql_select, $sql_where);
		
		$query = $this->db->select($tbl_col_reward_points['id'])
			->from($tbl_reward_points['table'])
			->join($tbl_reward_points['join_table'], $tbl_reward_points['join'])
			->join($tbl_convert_points['table'], $tbl_col_convert_points['reward'].' = '.$tbl_col_reward_points['id'], 'left')
			->get();
		
		if ($query->num_rows() > 0)
		{
			$reward_query_array = $query->result_array();

			foreach($reward_query_array as $row_id => $user_data)
			{
				// Filter itemised reward point data per user.
				$this->db->where($tbl_col_reward_points['id'], $user_data[$tbl_col_reward_points['id']]);
				
				// Calculate users reward points.
				$reward_calculation_data = $this->calculate_reward_points();
				
				foreach($reward_calculation_data as $reward_data)
				{
					$reward_query_array[$row_id][$tbl_col_reward_points['id']] = $reward_data['id'];
					$reward_query_array[$row_id][$tbl_col_reward_points['activate_date']] = $reward_data['activate_date'];
					$reward_query_array[$row_id][$tbl_col_reward_points['expire_date']] = $reward_data['expire_date'];
					
					$reward_query_array[$row_id][$tbl_col_reward_points['row_points_total']] = $reward_data['total_points'];
					$reward_query_array[$row_id][$tbl_col_reward_points['row_points_pending']] = $reward_data['points_pending'];
					$reward_query_array[$row_id][$tbl_col_reward_points['row_points_active']] = $reward_data['points_active'];
					$reward_query_array[$row_id][$tbl_col_reward_points['row_points_expired']] = $reward_data['points_expired'];
					$reward_query_array[$row_id][$tbl_col_reward_points['row_points_converted']] = $reward_data['points_converted'];
					$reward_query_array[$row_id][$tbl_col_reward_points['row_points_cancelled']] = $reward_data['points_cancelled'];
				}
			}
			
			// Add the pseudo columns to CI's active record data.
			foreach($reward_query_array as $column => $data)
			{
				$reward_query_object[$column] = (object)$data;
			}
			
			$query->result_array = $reward_query_array;
			$query->result_object = $reward_query_object;
		}
		
		return $query;
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * get_user_reward_point_summary
	 * Gets a summary of a users reward points stating the number of points that are pending, active, expired, cancelled and that have been converted to vouchers.
	 */	
	public function get_user_reward_point_summary($sql_where)
	{
		// Check the table exists in the config file and is enabled.
		if (! $this->get_enabled_status('rewards'))
		{
			return FALSE;
		}

		$tbl_col_reward_points = $this->flexi->cart_database['reward_points']['columns'];
		
		###+++++++++++++++++++++++++###
				
		// Set any custom defined SQL statements.
		$this->set_custom_sql_to_db(FALSE, $sql_where);

		// Get itemised reward point data.
		$reward_calculation_data = $this->calculate_reward_points();
		
		// Set defaults.
		$reward_point_summary = array(
			$tbl_col_reward_points['total_points'] => 0,
			$tbl_col_reward_points['total_points_pending'] => 0,
			$tbl_col_reward_points['total_points_active'] => 0,
			$tbl_col_reward_points['total_points_expired'] => 0,
			$tbl_col_reward_points['total_points_converted'] => 0,
			$tbl_col_reward_points['total_points_cancelled'] => 0
		);
		
		if ($reward_calculation_data)
		{
			// Group all itemised data together as a summary.
			foreach($reward_calculation_data as $data)
			{
				$reward_point_summary[$tbl_col_reward_points['total_points']] += $data['total_points'];
				$reward_point_summary[$tbl_col_reward_points['total_points_pending']] += $data['points_pending'];
				$reward_point_summary[$tbl_col_reward_points['total_points_active']] += $data['points_active'];
				$reward_point_summary[$tbl_col_reward_points['total_points_expired']] += $data['points_expired'];
				$reward_point_summary[$tbl_col_reward_points['total_points_converted']] += $data['points_converted'];
				$reward_point_summary[$tbl_col_reward_points['total_points_cancelled']] += $data['points_cancelled'];
			}
		}
		
		return $reward_point_summary;
	}
	
	###+++++++++++++++++++++++++###

	private function calculate_reward_points()
	{
		// Check the table exists in the config file and is enabled.
		if (! $this->get_enabled_status('rewards'))
		{
			return FALSE;
		}

		// Set column alias.
		$tbl_reward_points = $this->flexi->cart_database['reward_points'];
		$tbl_col_reward_points = $this->flexi->cart_database['reward_points']['columns'];
		$tbl_convert_points = $this->flexi->cart_database['reward_points_converted'];
		$tbl_col_convert_points = $this->flexi->cart_database['reward_points_converted']['columns'];
		$tbl_order_status = $this->flexi->cart_database['order_status'];
		$tbl_col_order_status = $this->flexi->cart_database['order_status']['columns'];

		###+++++++++++++++++++++++++###
		
		$sql_select_required = array(
			$tbl_col_reward_points['id'],
			$tbl_col_reward_points['points'],
			$tbl_col_reward_points['item_quantity'],
			$tbl_col_reward_points['item_quantity_shipped'],
			$tbl_col_reward_points['item_quantity_cancelled'],
			$tbl_col_reward_points['order_date'],
			$tbl_col_reward_points['item_shipped_date'],
			$tbl_col_order_status['cancelled'],
			'SUM('.$tbl_col_convert_points['points'].') AS '.$tbl_col_convert_points['points']
		);
		
		$query = $this->db->select($sql_select_required)
			->from($tbl_reward_points['table'])
			->join($tbl_reward_points['join_table'], $tbl_reward_points['join'])
			->join($tbl_convert_points['table'], $tbl_col_convert_points['reward'].' = '.$tbl_col_reward_points['id'], 'left')
			->join($tbl_order_status['table'], $tbl_col_reward_points['status'].' = '.$tbl_col_order_status['id'])
			->group_by($tbl_col_reward_points['id'])
			->order_by($tbl_col_reward_points['order_date'])
			->get();
			
		###+++++++++++++++++++++++++###
		
		// Get expire date of reward points.
		$now_timestamp = strtotime('now');
		$pending_timestamp = ($this->flexi_cart_lite_model->get_config_setting('reward_point_days_pending') * 24 * 60 * 60);
		$valid_timestamp = (($this->flexi_cart_lite_model->get_config_setting('reward_point_days_valid') * 24 * 60 * 60) + $pending_timestamp);
		$expire_date_timestamp = ($now_timestamp - $valid_timestamp);

		###+++++++++++++++++++++++++###

		if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $row_id => $reward_data)
			{
				$data[$row_id]['id'] = $reward_data[$tbl_col_reward_points['id']];

				// Get the timestamp for when the item was shipped (If it has been shipped), if the column is not enabled, use the order date.
				$item_shipping_date = ($this->get_enabled_status('ship_cancel_quantities') && isset($reward_data[$tbl_col_reward_points['item_shipped_date']])) ? 
					strtotime($reward_data[$tbl_col_reward_points['item_shipped_date']]) : strtotime($reward_data[$tbl_col_reward_points['order_date']]);

				// If the item has been shipped, set reward point activation and expiration data.
				$data[$row_id]['activate_date'] = $this->database_date_time($pending_timestamp, $item_shipping_date);
				$data[$row_id]['expire_date'] = $this->database_date_time($valid_timestamp, $item_shipping_date);
				
				// Set defaults.
				$data[$row_id]['total_points'] = $data[$row_id]['points_pending'] = $data[$row_id]['points_active'] = 
					$data[$row_id]['points_expired'] = $data[$row_id]['points_converted'] = $data[$row_id]['points_cancelled'] = 0;
				
				###+++++++++++++++++++++++++###
				
				// Set aliases for database column values, including a check on whether shipping and cancelled quantity columns are enabled.
				$row_quantity = $reward_data[$tbl_col_reward_points['item_quantity']];
				$row_quantity_shipped = (isset($reward_data[$tbl_col_reward_points['item_quantity_shipped']])) ? 
					$reward_data[$tbl_col_reward_points['item_quantity_shipped']] : $row_quantity;
				$row_points = $reward_data[$tbl_col_reward_points['points']];
				$row_converted_points = $reward_data[$tbl_col_convert_points['points']];
				
				// Check if the order has been cancelled, if so, then all reward points are cancelled.
				if ($reward_data[$tbl_col_order_status['cancelled']] == 1)
				{
					$row_quantity_cancelled = $row_quantity;
				}
				else
				{
					$row_quantity_cancelled = (isset($reward_data[$tbl_col_reward_points['item_quantity_cancelled']])) ? 
						$reward_data[$tbl_col_reward_points['item_quantity_cancelled']] : 0;			
				}

				###+++++++++++++++++++++++++###

				// Calculate total points.
				$data[$row_id]['total_points'] += ($row_points * $row_quantity);
				
				// Calculate used points (Converted to vouchers).
				$data[$row_id]['points_converted'] += $row_converted_points;

				// Calculate the number of items that have been cancelled.
				$quantity_cancelled = ($row_quantity_cancelled > $row_quantity) ? $row_quantity : $row_quantity_cancelled;

				// Calculate cancelled points.
				$cancelled_points = ($row_points * $quantity_cancelled);
				$data[$row_id]['points_cancelled'] += $cancelled_points;
														
				// Remove the cancelled points from the points total.
				$data[$row_id]['total_points'] -= $cancelled_points;
				
				// Check if any shipped items are still within the valid time limit for reward points.
				if ($item_shipping_date > $expire_date_timestamp || ! $item_shipping_date)
				{
					// Calculate the number of items that have neither been shipped, or cancelled.
					$quantity_pending = ($row_quantity - $row_quantity_shipped - $row_quantity_cancelled);
					$quantity_pending = ($quantity_pending > 0) ? $quantity_pending : 0;

					// Calculate the number of items that have been shipped.
					$quantity_active = (($row_quantity - $row_quantity_cancelled) >= $row_quantity_shipped) ? $row_quantity_shipped : ($row_quantity - $row_quantity_cancelled);
					$quantity_active = ($quantity_active > 0) ? $quantity_active : 0;
					
					###+++++++++++++++++++++++++###
					
					// Calculate pending points.
					$data[$row_id]['points_pending'] += ($row_points * $quantity_pending);
						
					// Check if shipped items have surpassed the 'reward point pending' time limit set via the config file.
					if (($item_shipping_date + $pending_timestamp) <= $now_timestamp)
					{
						// The shipped items have surpassed the 'pending' time limit, therefore the reward points are now active.
						
						// Note: Converted reward points are removed from the active points. If a user converts points, that are then later cancelled,
						// the points can not be reclaimed from the reward voucher created from the now cancelled points. However, the cancelled points will be 
						// removed from future earnt points until the outstanding points have been reclaimed, this means negative active points can be returned.
						// Think of it as a reward point overdraft debt, that must be repaid before new points can be earnt and used.
						$data[$row_id]['points_active'] += (($row_points * $quantity_active) - $row_converted_points);
						
						// If active points are negative, remove the negative points from the total too.
						if ($data[$row_id]['points_active'] < 0)
						{
							$data[$row_id]['total_points'] += $data[$row_id]['points_active'];
						}
					}
					else
					{
						// The shipped items are still within the 'pending' time limit, therefore the shipped reward points must remain pending.
						$data[$row_id]['points_pending'] += ($row_points * $quantity_active);
					}
				}
				else
				{
					// Calculate expired points.
					$data[$row_id]['points_expired'] += (($row_points * $row_quantity) - $cancelled_points);
				}
			}
			
			return $data;
		}
		
		return FALSE;
	}
	
	###+++++++++++++++++++++++++###
	
	/**
	 * calculate_conversion_reward_points
	 * Rounds a submitted amount of reward points to the maximum number of reward points that can be converted into a voucher.
	 */
	public function calculate_conversion_reward_points($reward_points = FALSE, $points_limit = FALSE)
	{
		if ($this->is_positive($reward_points))
		{
			if ($this->is_positive($points_limit) && $reward_points > $points_limit)
			{
				$reward_points = $points_limit;
			}
			
			$conversion_ratio = $this->flexi_cart_lite_model->get_config_setting('reward_point_to_voucher_ratio');
			
			// Reward points total to be converted.
			return floor($reward_points / $conversion_ratio) * $conversion_ratio;
		}
		
		return 0;
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * get_reward_point_conversion_tiers
	 * Returns an array of reward point tiers required to convert points to a voucher.
	 * For example, with 825 points and a conversion ratio of 250 points per voucher, the array would return 250, 500 and 750.
	 * The remaining 75 points would not be able to be converted until another 175 points were earnt.
	 */
	public function get_reward_point_conversion_tiers($reward_points = FALSE, $points_limit = FALSE)
	{
		// Get reward point to voucher conversion ratio.
		$conversion_ratio = $this->flexi_cart_lite_model->get_config_setting('reward_point_to_voucher_ratio');
		
		// Calculate how many vouchers can be created at the minimum value of reward points.
		$ratio_multiples = floor($reward_points / $conversion_ratio);
			
		if ($ratio_multiples > 0)
		{
			$conversion_tiers = array();
			for($i = 1; $ratio_multiples >= $i; $i++)
			{
				// If the conversion tier value is lower than the points limit, add it to the array.
				if (! $points_limit || ($points_limit >= ($conversion_ratio * $i)))
				{
					$conversion_tiers[] = ($conversion_ratio * $i);
				}
			}
			
			return $conversion_tiers;
		}

		return FALSE;
	}
	
	###+++++++++++++++++++++++++###
	
	/**
	 * calculate_reward_point_value
	 * Returns the monetary value of a submitted amount of reward points.
	 */
	public function calculate_reward_point_value($reward_points = FALSE)
	{
		if ($this->is_positive($reward_points))
		{
			$reward_voucher_multiplier = $this->flexi_cart_lite_model->get_config_setting('reward_voucher_multiplier');

			// Points value.
			return number_format($reward_points * $reward_voucher_multiplier, 2, '.', '');
		}
		
		return 0;
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * check_code_available
	 * Validates whether a discount/voucher code already exists.
	 */
	public function check_code_available($code = FALSE, $omit_discount_id = FALSE)
	{
		// Check the table exists in the config file and is enabled.
		// If a code is not set, then the discount is not activated via a code and so it does not/cannot be checked.
		if (empty($code) || ! $this->get_enabled_status('discounts'))
		{
			return FALSE;
		}
	
		if ($this->is_positive($omit_discount_id))
		{
			$this->db->where($this->flexi->cart_database['discounts']['columns']['id'].' != '.$omit_discount_id);
		}

		$this->db->where($this->flexi->cart_database['discounts']['columns']['code'], $code);

		$query = $this->get_table_data($this->flexi->cart_database['discounts']['table']);
		
		return $query->num_rows() == 0;
	}	
	
	###+++++++++++++++++++++++++###
	
	/**
	 * insert_voucher
	 * Inserts a new reward voucher to the database.
	 */
	public function insert_voucher($user_id = FALSE, $points_to_convert = FALSE, $code = FALSE, $description = FALSE, $expire_days = FALSE)
	{
		// Check submitted data is valid and that the table exists in the config file and is enabled.
		if (empty($user_id) || empty($points_to_convert) || ! $this->get_enabled_status('rewards'))
		{
			return FALSE;
		}
	
		$tbl_reward_points = $this->flexi->cart_database['reward_points'];
		$tbl_col_reward_points = $this->flexi->cart_database['reward_points']['columns'];
		$tbl_convert_points = $this->flexi->cart_database['reward_points_converted'];
		$tbl_col_convert_points = $this->flexi->cart_database['reward_points_converted']['columns'];
		$tbl_discounts = $this->flexi->cart_database['discounts'];
		$tbl_col_discounts = $this->flexi->cart_database['discounts']['columns'];
	
		###+++++++++++++++++++++++++###

		// Start SQL transaction.
		$this->db->trans_start();

		// Calculate the expiry date of the voucher.
		$expire_days = (! $this->is_positive($expire_days)) ? $this->flexi_cart_lite_model->get_config_setting('reward_voucher_days_valid') : $expire_day; 
		$expire_timestamp = ($expire_days * 24 * 60 * 60); // Convert to seconds.
		
		// Create a unique reference code for the voucher.
		do
		{
			$code = (! isset($code) || empty($code)) ? strtoupper(substr(md5(uniqid(rand(), true)), 0, 15)) : $code;
			
			// Check if the code already exists.
			$sql_where = array($tbl_col_discounts['code'] => $code);
			$query = $this->db->get_where($tbl_discounts['table'], $sql_where);
			
			// If code exists, unset it, and try again.
			if ($query->num_rows() > 0)
			{
				unset($code);
			}
		} while (! isset($code));
		
		$description = (empty($description)) ? 'Reward Voucher: '.$code : $description;
		
		$points_value = $this->calculate_reward_point_value($points_to_convert);
		
		$sql_insert = array(
			$tbl_col_discounts['type'] => 3, // Reward voucher.
			$tbl_col_discounts['method'] => 14, // Flat fee summary discount.
			$tbl_col_discounts['tax_method'] => 0, // Auto apply tax according to whether cart prices inc/exclude tax.
			$tbl_col_discounts['user'] => $user_id,
			$tbl_col_discounts['code'] => $code,
			$tbl_col_discounts['description'] => $description,
			$tbl_col_discounts['value_discounted'] => $points_value,
			$tbl_col_discounts['void_reward_points'] => 1, // Prevent any reward points being earnt when using voucher.
			$tbl_col_discounts['usage_limit'] => 1,
			$tbl_col_discounts['valid_date'] => $this->database_date_time(),
			$tbl_col_discounts['expire_date'] => $this->database_date_time($expire_timestamp),
			$tbl_col_discounts['status'] => 1
		);
		
		$this->db->insert($tbl_discounts['table'], $sql_insert);		
		$discount_id = $this->db->insert_id();
		
		###+++++++++++++++++++++++++###
		
		// Get a recordset of all active reward points for user.
		$sql_where = array($tbl_col_reward_points['user'] => $user_id);		
		$reward_query = $this->get_user_reward_points(FALSE, $sql_where);
		
		if ($reward_query->num_rows() > 0)
		{		
			// Loop through active reward points and insert conversion records for the reward points that have been converted to a voucher. 
			foreach($reward_query->result_array() as $reward_data)
			{
				if ($reward_data[$tbl_col_reward_points['row_points_active']] > 0)
				{
					if ($points_to_convert > $reward_data[$tbl_col_reward_points['row_points_active']])
					{
						$points_to_insert_to_row = $reward_data[$tbl_col_reward_points['row_points_active']];
						$points_to_convert -= $reward_data[$tbl_col_reward_points['row_points_active']];
					}
					else
					{
						$points_to_insert_to_row = $points_to_convert;
						$points_to_convert = 0;
					}
						
					$sql_insert = array(
						$tbl_col_convert_points['reward'] => $reward_data[$tbl_col_reward_points['id']],
						$tbl_col_convert_points['discount'] => $discount_id,
						$tbl_col_convert_points['points'] => $points_to_insert_to_row,					
						$tbl_col_convert_points['date'] => $this->database_date_time()					
					);
					
					$this->db->insert($tbl_convert_points['table'], $sql_insert);
					
					// Stop loop if done.
					if ($points_to_convert == 0)
					{
						break;
					}
				}
			}
		}
		
		// Complete SQL transaction.
		$this->db->trans_complete();
		
		return $discount_id;
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * check_item_in_discount_group
	 * Looks-up the discount group item table to check if an item id already exists within a specific discount group.
	 */
	public function check_item_in_discount_group($group_id = FALSE, $item_id = FALSE)
	{
		// Check submitted data is valid and that the table exists in the config file and is enabled.
		if (! is_numeric($group_id) || ! is_numeric($item_id) || ! $this->get_enabled_status('discounts'))
		{
			return FALSE;
		}
	
		// If an array does not already exist of items in the discount group, run a query to find all related items and save as a global array.
		if (empty($this->flexi->discount_group_items[$group_id]))
		{
			$this->flexi->discount_group_items[$group_id] = array();

			$query = $this->db->select($this->flexi->cart_database['discount_group_items']['columns']['item'])
				->from($this->flexi->cart_database['discount_group_items']['table'])
				->where($this->flexi->cart_database['discount_group_items']['columns']['group'], $group_id)
				->get();
			
			if ($query->num_rows() > 0)
			{
				$group_items = array();
				
				foreach($query->result_array() as $row)
				{
					$group_items[] = $row[$this->flexi->cart_database['discount_group_items']['columns']['item']];
				}
				
				$this->flexi->discount_group_items[$group_id] = $group_items;
			}
		}
		
		return (in_array($item_id, $this->flexi->discount_group_items[$group_id]));	
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ACTIVE RECORD FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * set_sql_to_var
	 * Used internally by flexi cart to set an SQL statement to CI's Active Record.
	 */
	public function set_sql_to_var($sql_clause, $key = FALSE, $value = FALSE, $param = FALSE, $overwrite_existing = FALSE)
	{
		// Validate submitted data.
		if ($key === FALSE || (! is_array($key) && in_array($key, array('select', 'order_by', 'group_by', 'limit')) && $value === FALSE))
		{
			return FALSE;
		}
	
		// Check whether to overwrite any existing clause data.
		if ($overwrite_existing)
		{
			// If '$key' is an SQL WHERE clause of some kind, then remove all SQL WHERE statements.
			if (! in_array($key, array('select', 'join', 'order_by', 'group_by', 'limit')))
			{
				$this->flexi->where = $this->flexi->or_where = $this->flexi->where_in = array();
				$this->flexi->or_where_in = $this->flexi->where_not_in = $this->flexi->or_where_not_in = array();
				$this->flexi->like = $this->flexi->or_like = $this->flexi->not_like = $this->flexi->or_not_like = array();
			}
			// Else, just remove the specific '$key' SQL statement.
			else
			{
				$this->flexi->$key = array();
			}
		}
		
		// Key, value and parameter method, used for LIKE and JOIN clauses.
		if (! is_array($key) && $value && $param) 
		{
			array_push($this->flexi->$sql_clause, array('key_value_param_method' => array('key' => $key, 'value' => $value, 'param' => $param)));
		}
		// Key and value method.
		else if (! is_array($key) && $value) 
		{
			array_push($this->flexi->$sql_clause, array('key_value_method' => array('key' => $key, 'value' => $value)));
		}
		// String or associative array method.
		else 
		{
			array_push($this->flexi->$sql_clause, $key);
		}
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * set_custom_sql_to_db
	 * Used internally by flexi cart to call any custom user defined SQL Active Record functions at the correct point during a function.
	 */
	public function set_custom_sql_to_db($sql_select = FALSE, $sql_where = FALSE) 
	{
		// Set directly submitted SELECT and WHERE clauses.
		if (! empty($sql_select))
		{
			$this->db->select($sql_select);
		}

		if (! empty($sql_where))
		{
			$this->db->where($sql_where);
		}
	
		###+++++++++++++++++++++++++###
	
		// Set SQL clauses defined via flexi cart SQL Active Record functions.
	
		// Set array of all SQL clause types.
		$clause_types = array(
			'select', 'where', 'or_where', 'where_in', 'or_where_in', 'where_not_in', 'or_where_not_in', 
			'like', 'or_like', 'not_like', 'or_not_like', 'join', 'order_by', 'group_by', 'limit'
		);
		
		// Loop through clause types.
		foreach($clause_types as $sql_clause)
		{
			// If a clause is set.
			if (! empty($this->flexi->$sql_clause))
			{
				// Loop through the clause array setting values using active record.
				foreach($this->flexi->$sql_clause as $value)
				{
					// Key, value and parameter method.
					if (is_array($value) && key($value) === 'key_value_param_method') 
					{
						$data = current($value);					
						$this->db->$sql_clause($data['key'], $data['value'], $data['param']);
					}
					// Key and value method.
					else if (is_array($value) && key($value) === 'key_value_method') 
					{
						$data = current($value);
						$this->db->$sql_clause($data['key'], $data['value']);
					}
					// String or Associative array method.
					else 
					{
						$this->db->$sql_clause($value);
					}
				}
			}
		}
	}

	###+++++++++++++++++++++++++###
	
	/**
	 * clear_arg_sql
	 * Clears any custom user defined SQL Active Record functions.
	 */
	public function clear_arg_sql()
	{
		$this->flexi->select = $this->flexi->join = $this->flexi->order_by = $this->flexi->group_by = $this->flexi->limit = array();
		$this->flexi->where = $this->flexi->or_where = $this->flexi->where_in = $this->flexi->or_where_in = $this->flexi->where_not_in = $this->flexi->or_where_not_in = array();
		$this->flexi->like = $this->flexi->or_like = $this->flexi->not_like = $this->flexi->or_not_like = array();
	}
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ORDER MANAGEMENT
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * generate_order_number
	 * Generates a new random order number.
	 */
	public function generate_order_number($prefix = FALSE, $suffix = FALSE)
	{
		// Check the order tables exist in the config file and are enabled.
		if ($this->get_enabled_status('orders'))
		{
			// Set order number prefix and suffix defined via the config file.
			$prefix = (! $prefix) ? $this->flexi_cart_lite_model->get_config_setting('order_number_prefix') : $prefix;
			$suffix = (! $suffix) ? $this->flexi_cart_lite_model->get_config_setting('order_number_suffix') : $suffix;
			$incremental_status = $this->flexi_cart_lite_model->get_config_setting('increment_order_number');
		 
			// Set alias of order table data.
			$tbl_col_order_summary = $this->flexi->cart_database['order_summary']['columns'];
		 
			// Lookup last order number and increment it by one.
			if ($incremental_status)
			{
				$query = $this->db->select($tbl_col_order_summary['order_number'])
					->from($this->flexi->cart_database['order_summary']['table'])
					->order_by($tbl_col_order_summary['order_number'], 'desc')
					->limit(1)
					->get();
				
				if ($query->num_rows() == 1)
				{
					$last_order_number = $query->row_array();
					
					// Remove non-numeral characters.
					$order_number = preg_replace('/[^0-9]/', '', $last_order_number[$tbl_col_order_summary['order_number']]); 
					$order_number = $prefix.sprintf('%08d', $order_number+1).$suffix;
				}
				// Else, set initial order number.
				else
				{
					$order_number = $prefix.'00000001'.$suffix;
				}
			}
			// Generate a random order number.
			else
			{	 
				// Run a loop generating random order numbers.
				$order_number_available = FALSE;
				do 
				{
					// Generate random order number.
					$random_number = mt_rand(1,99999999);
					$order_number = $prefix.sprintf('%08d', $random_number).$suffix;
				}
				while(! isset($order_number) || ! $this->check_order_number_available($order_number));
			}
			
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
		// Check the order tables exist in the config file and are enabled.
		if ($this->flexi_cart_admin_model->get_enabled_status('orders'))
		{
			// Lookup database to check that the order number is unique.
			$sql_where = array($this->flexi->cart_database['order_summary']['columns']['order_number'] => $order_number);
			
			$query = $this->db->get_where($this->flexi->cart_database['order_summary']['table'], $sql_where);
			
			return ($query->num_rows() == 0);
		}
		
		return FALSE;
	}
	 
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * set_order_summary
	 * Updates the order summary table with summary values from the cart data array.
	 */	
	private function set_order_summary($custom_summary_data)
	{
		// Get current summary data, converted to either include/exclude discount values.
		$cart_summary_data = $this->flexi_cart_admin->cart_summary(TRUE, FALSE, TRUE);

		$sql_update = array();
		foreach($this->flexi->cart_database['order_summary']['columns'] as $table_col_alias => $table_col_name)
		{
			if ($table_col_name)
			{
				// Ensure the order status is set from the default database status, and not a user submitted value, which could conflict with auto stock allocation.
				if ($table_col_alias == 'status')
				{
					if ($order_status = $this->get_default_order_status())
					{
						$sql_update[$table_col_name] = $order_status;
					}
				}
				// Check if any user defined data matches a column to ensure it is used instead of values within the cart.
				// This enables extra flexibility where you may not want the cart value inserted into the database.
				else if (isset($custom_summary_data[$table_col_name]))
				{
					$sql_update[$table_col_name] = $custom_summary_data[$table_col_name];
					unset($custom_summary_data[$table_col_name]);
				}
				// The cart data id.
				else if ($table_col_alias == 'cart_data')
				{
					$column_value = $this->flexi_cart_admin->cart_data_id();
					
					$sql_update[$table_col_name] = ($column_value !== FALSE) ? $column_value : 0; 
				}
				// The cart tax rate.
				else if ($table_col_alias == 'tax_rate')
				{
					$sql_update[$table_col_name] = $this->flexi_cart_admin->tax_rate(FALSE, FALSE);
				}
				// All currency and quantity data.
				else if (array_key_exists($table_col_alias, $cart_summary_data))
				{
					$sql_update[$table_col_name] = $cart_summary_data[$table_col_alias]; 
				}
				// All other order summary columns defined via config file, that have a flexi cart function with the same name.
				// These columns are 'order_number, 'shipping_name', 'summary_discount_description', 'surcharge_description', 
				// 'reward_voucher_description', and 'currency_name'.
				else if (method_exists('flexi_cart_admin', $table_col_alias))
				{
					$column_value = $this->flexi_cart_admin->$table_col_alias();
				
					// Check returned value isn't FALSE, else '0' will be inserted to database record.
					if ($column_value !== FALSE)
					{
						$sql_update[$table_col_name] = $column_value; 
					}
				}
			}
		}
		
		// Add any remaining submitted summary data to the SQL array.
		if (! empty($custom_summary_data))
		{
			foreach($custom_summary_data as $table_col_name => $data)
			{
				$sql_update[$table_col_name] = $data;
			}
		}
		
		$sql_where = array($this->flexi->cart_database['order_summary']['columns']['order_number'] => $this->flexi_cart_lite_model->get_config_setting('order_number'));

		$this->db->update($this->flexi->cart_database['order_summary']['table'], $sql_update, $sql_where);
		
		return TRUE;
	}
	
	/**
	 * set_order_details
	 * Updates the order detail table with items from the cart data array.
	 */	
	private function set_order_details($custom_item_data = array(), $existing_order_data = array())
	{
		// Set alias for tables.
		$tbl_col_order_details = $order_detail_columns = $this->flexi->cart_database['order_details']['columns'];
		$tbl_col_order_status = $this->flexi->cart_database['order_status']['columns'];
		
		// Loop through order detail table and add any user defined custom columns.
		foreach($this->flexi->cart_database['order_details']['custom_columns'] as $table_col_name => $session_col_name)
		{
			$order_detail_columns[$table_col_name] = $session_col_name;
		}

		// Create array of cart item alias names including any user defined custom columns.
		$cart_item_columns = $this->flexi->cart_columns;
		foreach($this->flexi->cart['items']['custom_columns'] as $column)
		{
			$cart_item_columns[$column['name']] = $column['name'];
		}
		
		###+++++++++++++++++++++++++++++++++###
		
		// Banned Shipping Items
		// If there are items in the cart that are not permitted to be shipped to the current shipping location, check whether they should be removed prior to save.
		if (! $this->flexi_cart_admin->location_shipping_status() && ! $this->flexi_cart_lite_model->get_config_setting('save_banned_shipping_items'))
		{
			foreach($this->flexi->cart_contents['items'] as $row_id => $item)
			{
				// If item is banned from current shipping location, remove it from the cart.
				if (in_array($item[$this->flexi->cart_columns['item_id']], $this->flexi->cart_contents['settings']['shipping']['data']['banned_shipping_items']))
				{
					unset($this->flexi->cart_contents['items'][$row_id]);
				}
			}
		}
		
		###+++++++++++++++++++++++++++++++++###

		// Get current item data, converted to either include/exclude discount values.
		$cart_item_data = $this->flexi_cart_admin->cart_items(FALSE, FALSE, TRUE);
				
		###+++++++++++++++++++++++++++++++++###

		// Loop through cart items.
		foreach($cart_item_data as $row_id => $item)
		{
			// Loop through order detail columns.
			$sql_set = array();
			foreach($order_detail_columns as $table_col_alias => $table_col_name)
			{
				// Check column is enabled.
				if ($table_col_name)
				{
					// First check if any user defined data matches a column to ensure it is used instead of values within the cart.
					// This enables extra flexibility where you may not want the cart array value inserted into the database.
					if (isset($custom_item_data[$row_id][$table_col_name]))
					{
						$sql_set[$table_col_name] = $custom_item_data[$row_id][$table_col_name];
						unset($custom_item_data[$row_id][$table_col_name]);
					}
					// Set the order number.
					else if ($table_col_alias == 'order_number')
					{
						$sql_set[$table_col_name] = $this->flexi_cart_lite_model->get_config_setting('order_number');
					}
					// Set the items cart row id.
					else if ($table_col_alias == 'cart_row_id')
					{
						$sql_set[$table_col_name] = $row_id;
					}
					// Item options.
					else if ($table_col_alias == 'item_options' && isset($item[$cart_item_columns[$table_col_alias]]))
					{
						$item_options = $this->flexi_cart_admin->item_options($row_id, TRUE, TRUE);
						
						if ($item_options !== FALSE)
						{
							$sql_set[$table_col_name] = $item_options;
						}
					}
					// Item status message.
					else if ($table_col_alias == 'item_status_message')
					{
						$item_status_message = $this->flexi_cart_admin->item_status_message($row_id);
						
						if ($item_status_message !== FALSE)
						{
							$sql_set[$table_col_name] = $item_status_message;
						}
					}
					// Quantity shipped.
					else if ($table_col_alias == 'item_quantity_shipped' && isset($this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]))
					{
						$sql_set[$table_col_name] = $this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['item_quantity_shipped'];
						
						// If the quantity shipped is '0', ensure the shipped date is reset.
						if ($sql_set[$table_col_name] == 0)
						{
							$sql_set[$tbl_col_order_details['item_shipped_date']] = 0;
						}
						// Else, if no items were shipped from the original saved cart data, and items have now been shipped, set the 'shipped date'.
						else if ($this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['saved_quantity_shipped'] == 0 && $sql_set[$table_col_name] > 0)
						{
							$sql_set[$tbl_col_order_details['item_shipped_date']] = $this->database_date_time();
						}
					}
					// Quantity cancelled.
					else if ($table_col_alias == 'item_quantity_cancelled' && isset($this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]))
					{
						$sql_set[$table_col_name] = $this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['item_quantity_cancelled'];
					}
					// All other order details columns defined via config file.
					else if (isset($cart_item_columns[$table_col_alias]) && isset($item[$cart_item_columns[$table_col_alias]]))
					{
						// Check returned value isn't FALSE, else '0' will be inserted to database record.
						if ($item[$cart_item_columns[$table_col_alias]] !== FALSE)
						{
							$sql_set[$table_col_name] = $item[$cart_item_columns[$table_col_alias]];
						}
					}
				}
			}
			
			// Add any remaining user submitted item data to the SQL INSERT.
			if (! empty($custom_item_data))
			{
				foreach($custom_item_data as $item_data_row_id => $item_custom_data)
				{
					if (! empty($custom_item_data[$item_data_row_id]) && $row_id == $item_data_row_id)
					{
						foreach($item_custom_data as $custom_column_name => $custom_data)
						{
							$sql_set[$custom_column_name] = $custom_data;
						}
					}
				}
			}
			
			// Check if item row already exists in table.
			if (isset($existing_order_data[$row_id]))
			{
				$sql_where = array(
					$tbl_col_order_details['order_number'] => $this->flexi_cart_lite_model->get_config_setting('order_number'),
					$tbl_col_order_details['cart_row_id'] => $row_id
				);
				
				$this->db->update($this->flexi->cart_database['order_details']['table'], $sql_set, $sql_where);
				
				// If order was originally 'Cancelled', reallocate stock of originally ordered quantities.
				if ($existing_order_data[$row_id][$tbl_col_order_status['cancelled']] == 1)
				{
					// Update stock quantity.
					$reallocate_quantity = ($existing_order_data[$row_id][$tbl_col_order_details['item_quantity_cancelled']] - 
						$existing_order_data[$row_id][$tbl_col_order_details['item_quantity']]);

					$this->update_stock_quantity($row_id, $item[$cart_item_columns['item_id']], $reallocate_quantity, 0);
				}
				
				// Unset the row from the '$existing_order_data' array so that the row is not determined to no longer exist in the cart, 
				// and then be deleted from the order detail table.
				unset($existing_order_data[$row_id]);
			}
			else
			{
				$this->db->insert($this->flexi->cart_database['order_details']['table'], $sql_set);
			}
			
			// Update stock quantity.
			$this->update_stock_quantity($row_id, $item[$cart_item_columns['item_id']], FALSE, $item[$cart_item_columns['item_quantity']]);
		}
		
		// Delete any existing order detail rows from the database that were NOT in the resaved cart data.
		if ($tbl_col_order_details['cart_row_id'])
		{
			foreach($existing_order_data as $row_id => $row_data)
			{
				$sql_where = array(
					$tbl_col_order_details['order_number'] => $this->flexi_cart_lite_model->get_config_setting('order_number'),
					$tbl_col_order_details['cart_row_id'] => $row_id
				);
			
				$this->db->delete($this->flexi->cart_database['order_details']['table'], $sql_where);
				
				// Update stock quantity.
				$reallocate_quantity = ($row_data[$tbl_col_order_status['cancelled']] == 1) ?
					($row_data[$tbl_col_order_details['item_quantity_cancelled']] - $row_data[$tbl_col_order_details['item_quantity']]) :
						($row_data[$tbl_col_order_details['item_quantity']] - $row_data[$tbl_col_order_details['item_quantity_cancelled']]);
				
				$this->update_stock_quantity($row_id, $row_data[$tbl_col_order_details['item_id']], $reallocate_quantity, 0);
			}
		}

		return TRUE;
	}
	
	/**
	 * get_existing_order_details
	 * Returns data on any existing order details related to the current 'resave_order()' function.
	 */
	private function get_existing_order_details()
	{
		if ($this->get_enabled_status('admin_data'))
		{
			// Set alias for tables.
			$tbl_col_order_summary = $this->flexi->cart_database['order_summary']['columns'];
			$tbl_col_order_details = $order_detail_columns = $this->flexi->cart_database['order_details']['columns'];
			$tbl_col_order_status = $this->flexi->cart_database['order_status']['columns'];
			
			// Check if there are any existing order details saved matching the same order number.
			$sql_select = array(
				$tbl_col_order_details['cart_row_id'],
				$tbl_col_order_details['item_id'],
				$tbl_col_order_details['item_quantity'],
				$tbl_col_order_details['item_quantity_cancelled'],
				$tbl_col_order_status['cancelled']
			);
			
			$sql_where = array($tbl_col_order_details['order_number'] => $this->flexi_cart_lite_model->get_config_setting('order_number'));
			
			$query = $this->db->select($sql_select)
				->from($this->flexi->cart_database['order_details']['table'])
				->join($this->flexi->cart_database['order_summary']['table'], $tbl_col_order_summary['order_number'].' = '.$tbl_col_order_details['order_number'])
				->join($this->flexi->cart_database['order_status']['table'], $tbl_col_order_summary['status'].' = '.$tbl_col_order_status['id'])
				->where($sql_where)
				->get();
			
			// Compile all 'cart_row_id' columns into an array that can be checked to determine whether the current item data needs to update the existing row, or insert a new row. 
			$existing_order_data = array();
			foreach($query->result_array() as $row_data)
			{	
				$existing_order_data['order_status'] = $row_data[$tbl_col_order_status['cancelled']];
				$existing_order_data[$row_data[$tbl_col_order_details['cart_row_id']]] = $row_data;
			}
			
			return $existing_order_data;
		}
		
		return array();
	}

	/**
	 * get_default_order_status
	 * Returns the default order status for either the 'save_order()' or 'resave_save()' function.
	 */	
	private function get_default_order_status()
	{
		// If a cart data id is set in the current session, the order data already exists in the database, therefore the 'resave default' status should be set.
		$sql_where = ($this->flexi->cart_contents['settings']['configuration']['cart_data_id'] !== FALSE) ? 
			array($this->flexi->cart_database['order_status']['columns']['resave_default'] => 1) : array($this->flexi->cart_database['order_status']['columns']['save_default'] => 1);
	
		$query = $this->db->get_where($this->flexi->cart_database['order_status']['table'], $sql_where);
		
		if ($query->num_rows() > 0)
		{
			$status_data = $query->row_array();
			
			return $status_data[$this->flexi->cart_database['order_status']['columns']['id']];
		}
		
		return FALSE;
	}
	
	/**
	 * update_stock_quantity
	 * Updates the database item stock quantity for items that have been added to an order.
	 */	
	private function update_stock_quantity($row_id = FALSE, $item_id = FALSE, $allocate_stock_quantity = FALSE, $item_quantity = 0)
	{
		// Check if item is present in item stock table and that stock is to be auto allocated.
		if ($this->get_enabled_status('item_stock') && $this->get_enabled_status('auto_stock_status') && 
			$this->flexi_cart_lite_model->get_item_stock_quantity($item_id, TRUE) !== FALSE)
		{
			// Item stock table alias.
			$tbl_col_item_stock = $this->flexi->cart_database['item_stock']['columns'];

			// If 'admin data' is set, get the 'stock allocation' value to include any previous stock transactions, else remove the current cart item quantity.
			if ($allocate_stock_quantity === FALSE)
			{
				$allocate_stock_quantity = (isset($this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['stock_allocation'])) ?
					$this->flexi->cart_contents['settings']['admin_data']['items'][$row_id]['stock_allocation'] : -$item_quantity;
			}
			
			if ($allocate_stock_quantity != 0)
			{
				$this->db->set($tbl_col_item_stock['quantity'], $tbl_col_item_stock['quantity'].'+'.$allocate_stock_quantity, FALSE)
					->where($tbl_col_item_stock['item'], $item_id)
					->update($this->flexi->cart_database['item_stock']['table']);
			}
					
			return TRUE;
		}
		
		return FALSE;
	}

	/**
	 * update_discount_usage
	 * Updates the database discount usage value for discounts that have been used on an order.
	 */	
	private function update_discount_usage($discount_data = FALSE, $order_cancelled = FALSE, $operator = '-')
	{
		// Check the discount tables exist in the config file and are enabled.
		if ($this->get_enabled_status('discounts'))
		{
			// Set discount table alias.
			$tbl_cols_discount = $this->flexi->cart_database['discounts']['columns'];
			
			$active_discount_data = array_merge(
				$discount_data['settings']['discounts']['active_items'], 
				$discount_data['settings']['discounts']['active_summary'],
				$discount_data['settings']['discounts']['reward_vouchers']
			);
			
			$existing_discount_data = (isset($discount_data['settings']['admin_data']['discounts']['saved']) && ! $order_cancelled) ? 
				$discount_data['settings']['admin_data']['discounts']['saved'] : array();
			
			// Loop through active discounts and return or deduct 1 usage depending on the submitted operator.
			foreach($active_discount_data as $active_discount)
			{
				if (! in_array($active_discount['id'], $existing_discount_data))
				{
					$this->db->set($tbl_cols_discount['usage_limit'], $tbl_cols_discount['usage_limit'].$operator.'1', FALSE)
						->where($tbl_cols_discount['id'], $active_discount['id'])
						->update($this->flexi->cart_database['discounts']['table']);					
				}
				
				unset($existing_discount_data[$active_discount['id']]);
			}
			
			// Check if order status is active and there are unused discounts from a resaved order.
			if (! empty($existing_discount_data))
			{
				// Loop through any remaining 'admin data' discounts that are now unused and return 1 usage.
				foreach($existing_discount_data as $discount_id)
				{
					$this->db->set($tbl_cols_discount['usage_limit'], $tbl_cols_discount['usage_limit'].'+1', FALSE)
						->where($tbl_cols_discount['id'], $discount_id)
						->update($this->flexi->cart_database['discounts']['table']);
				}
			}
			
			return TRUE;
		}
		
		return FALSE;
	}
	
	/**
	 * save_order
	 * Saves the content of the cart to the database.
	 * Additional user defined data can be inserted at the same time using the functions item and summary data parameters.
	 * A custom order number can also be submitted to reference the order by, by default, a random number is generated.
	 */
	public function save_order($custom_summary_data = FALSE, $custom_item_data = FALSE, $order_number = FALSE)
	{
		// Check the order tables exist in the config file and are enabled. Check cart has content.
		if (! $this->get_enabled_status('orders') || ! isset($this->flexi->cart_contents['items']) || empty($this->flexi->cart_contents['items']))
		{
			return FALSE;
		}

		// Reset any status or error messages before saving data.
		$this->flexi_cart_admin->clear_messages();

		###+++++++++++++++++++++++++++++++++###
	
		// Banned Shipping Items
		// Check if there are no items in the cart that are permitted to be shipped.
		if (! $this->flexi_cart_lite_model->get_config_setting('save_banned_shipping_items') && ! $this->flexi_cart_admin->location_shipping_status(FALSE))
		{
			$this->set_error_message('item_shipping_banned', 'config');
			return FALSE;
		}

		###+++++++++++++++++++++++++++++++++###

		// Start SQL transaction.
		$this->db->trans_start();
		
		###+++++++++++++++++++++++++++++++++###
		
		// Order Number
		// Check whether the carts current order number, or a submitted order number already exists.
		if (! empty($order_number) || $this->flexi_cart_lite_model->get_config_setting('order_number'))
		{
			$order_number = (empty($order_number)) ? $this->flexi_cart_lite_model->get_config_setting('order_number') : $order_number;
		
			// If the order number does exist, the order cannot be saved.
			if (! $this->check_order_number_available($order_number))
			{	
				$this->db->trans_complete();
				$this->set_error_message('order_number_exists', 'config');
				return FALSE;				
			}
		}
		// Else, generate a new order number.
		else
		{
			$order_number = $this->generate_order_number();
		}
		
		// Insert a new row as soon as possible to prevent 2 orders from possibly using the same unique order number.
		$sql_insert = array(
			$this->flexi->cart_database['order_summary']['columns']['order_number'] => $order_number,
			$this->flexi->cart_database['order_summary']['columns']['date'] => $this->database_date_time()
		);

		$this->db->insert($this->flexi->cart_database['order_summary']['table'], $sql_insert);

		// Set order number to cart array.
		$this->flexi->cart_contents['settings']['configuration']['order_number'] = $order_number;
		
		###+++++++++++++++++++++++++++++++++###

		// Save the cart data array as a serialized string.
		$user_id = (isset($custom_summary_data[$this->flexi->cart_database['order_summary']['columns']['user']])) ? 
			$custom_summary_data[$this->flexi->cart_database['order_summary']['columns']['user']] : 0;

		$this->flexi->cart_contents['settings']['configuration']['cart_data_id'] = $this->save_cart_data($user_id, TRUE, FALSE, FALSE);
		
		###+++++++++++++++++++++++++++++++++###
		
		// Order summary.
		$this->set_order_summary($custom_summary_data);
			
		// Order details.
		$this->set_order_details($custom_item_data);
		
		// Discount usage.
		$this->update_discount_usage($this->flexi->cart_contents);
		
		###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

		// Update cart session.
		$this->session->set_userdata(array($this->flexi->cart['name'] => $this->flexi->cart_contents));
		
		// Complete SQL transaction.
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
	
	/**
	 * resave_order
	 * Resaves the content of the cart over an existing order in the database.
	 * Cart items from the original order that no longer exist in the current cart are removed, new items are added, and existing items are updated.
	 * Additional user defined data can be inserted at the same time using the functions item and summary data parameters as well as a user defined order number.
	 */
	public function resave_order($custom_summary_data = FALSE, $custom_item_data = FALSE)
	{
		// Check the order tables exist in the config file and are enabled. Check cart has content.
		if (! $this->get_enabled_status('orders') || ! isset($this->flexi->cart_contents['items']) || empty($this->flexi->cart_contents['items']))
		{
			return FALSE;
		}
		
		// Reset any status or error messages before saving data.
		$this->flexi_cart_admin->clear_messages();

		###+++++++++++++++++++++++++++++++++###
	
		// Banned Shipping Items
		// Check if there are no items in the cart that are permitted to be shipped.
		if (! $this->flexi_cart_lite_model->get_config_setting('save_banned_shipping_items') && ! $this->flexi_cart_admin->location_shipping_status(FALSE))
		{
			$this->set_error_message('item_shipping_banned', 'config');
			return FALSE;
		}

		###+++++++++++++++++++++++++++++++++###
		
		// Get save details of the existing order.
		if (! $existing_order_data = $this->get_existing_order_details())
		{
			$this->set_error_message('resave_order_does_not_exist', 'config');
			return FALSE;
		}
		
		// Check whether the existing order status was cancelled.
		$existing_order_status = (isset($existing_order_data['order_status'])) ? (bool)$existing_order_data['order_status'] : FALSE;
		unset($existing_order_data['order_status']);

		###+++++++++++++++++++++++++++++++++###
		
		// Start SQL transaction
		$this->db->trans_start();
			
		###+++++++++++++++++++++++++++++++++###
		
		// Order summary.
		$this->set_order_summary($custom_summary_data);
			
		// Order details.
		$this->set_order_details($custom_item_data, $existing_order_data);
		
		// Discount usage.
		$this->update_discount_usage($this->flexi->cart_contents, $existing_order_status);

		###+++++++++++++++++++++++++++++++++###

		// Cart data array.
		// Remove 'admin_data' from cart data array and then resave the array to the database.
		unset($this->flexi->cart_contents['settings']['admin_data']);
		
		$this->save_cart_data(FALSE, TRUE, FALSE, TRUE);
		
		###+++++++++++++++++++++++++++++++++###

		// Update cart session.
		$this->session->set_userdata(array($this->flexi->cart['name'] => $this->flexi->cart_contents));
		
		// Complete SQL transaction.
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}	
	
	/**
	 * email_order
	 * Sends an email of a saved cart order.
	 */
	public function email_order($order_number = FALSE, $email_to = FALSE, $email_subject = FALSE, $custom_data = FALSE)
	{
		// Check the order tables exist in the config file and are enabled.
		if ($this->get_enabled_status('orders'))
		{
			if (empty($order_number) || empty($email_to))
			{
				return FALSE;
			}

			$sql_where = array($this->flexi->cart_database['order_summary']['columns']['order_number'] => $order_number);
			
			$order_query = $this->db->get_where($this->flexi->cart_database['order_summary']['table'], $sql_where);

			if ($order_query->num_rows == 1)
			{
				$sql_where = array($this->flexi->cart_database['order_details']['columns']['order_number'] => $order_number);
				
				$order_details_query = $this->db->get_where($this->flexi->cart_database['order_details']['table'], $sql_where);

				if ($order_details_query->num_rows > 0)
				{
					$order_data['summary_data'] = $order_query->row_array();
					$order_data['item_data'] = $order_details_query->result_array();
					
					if (! empty($custom_data))
					{
						$order_data['custom_data'] = $custom_data;
					}

					$this->load->library('email');
					$email_settings = $this->config->item('email', 'flexi_cart');
					
					$email_subject = (empty($email_subject)) ? $email_settings['site_title'].' : Order Details' : $email_subject;
					$message = $this->load->view($email_settings['email_template'], $order_data, TRUE);
					
					$this->email->clear();
					$this->email->initialize(array('mailtype' => $email_settings['email_type']));
					$this->email->set_newline("\r\n");
					$this->email->from($email_settings['reply_email'], $email_settings['site_title']);
					$this->email->to($email_to);
					$this->email->subject($email_subject);
					$this->email->message($message);
						
					return $this->email->send();
				}
			}
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SAVE / LOAD CART DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * unserialize_cart_data
	 * Returns an unserialized cart data array from the database cart data table using a user defined SQL statement.
	 */
	public function unserialize_cart_data($sql_where = FALSE)
	{
		// Check submitted data is valid and that the database cart data table exists in the config file and is enabled.
		if (! empty($sql_where) && $this->get_enabled_status('db_cart_data'))
		{
			// If '$sql_where' is set, and is not an array, we assume it is the tables primary key.
			if (! is_array($sql_where))
			{
				$this->db->where($this->flexi->cart_database['db_cart_data']['columns']['id'], $sql_where);
			}
			else
			{
				$this->db->where($sql_where);
			}
		
			$query = $this->db->get($this->flexi->cart_database['db_cart_data']['table']);
				
			if ($query->num_rows() == 1)
			{
				$cart_data = $query->row_array();
				
				return unserialize($cart_data[$this->flexi->cart_database['db_cart_data']['columns']['cart_data']]);
			}
		}
		
		return FALSE;
	}
	
	/**
	 * save_cart_data
	 * Saves a carbon copy of the users current cart data array to the database.
	 */
	public function save_cart_data($user_id = 0, $set_readonly_status = FALSE, $sql_set = FALSE, $force_overwrite = FALSE)
	{
		// Check the database cart data table exists in the config file and is enabled.
		if ($this->get_enabled_status('db_cart_data'))
		{
			$tbl_save_cart = $this->flexi->cart_database['db_cart_data'];
			$tbl_col_save_cart = $this->flexi->cart_database['db_cart_data']['columns'];

			// If not cart id is currently set, insert a dummy row into the database cart data table to obtain an id.
			if (! $cart_data_id = $this->flexi_cart_lite_model->get_config_setting('cart_data_id'))
			{
				$this->db->insert($tbl_save_cart['table'], array($tbl_col_save_cart['user'] => $user_id));

				// Set the new row id to the cart array to act as a 'cart id'.
				// If the cart is later resaved, the cart id will be used to update the existing database row, rather than insert a new row.
				$cart_data_id = $this->flexi->cart_contents['settings']['configuration']['cart_data_id'] = $this->db->insert_id();
				
				$this->session->set_userdata(array($this->flexi->cart['name'] => $this->flexi->cart_contents));
			}
			
			// Serialize the cart array so it can be saved to the database.
			$serialized_cart_data = serialize($this->flexi->cart_contents);
			
			$sql_set = array(
				$tbl_col_save_cart['cart_data'] => $serialized_cart_data,
				$tbl_col_save_cart['date'] => $this->database_date_time(),
				$tbl_col_save_cart['readonly_status'] => (int)$set_readonly_status
			);

			if ($user_id !== FALSE)
			{
				$sql_set[$tbl_col_save_cart['user']] = $user_id;
			}
			
			// Merge any submitted SQL INSERT data if set.
			if (! empty($sql_insert) && is_array($sql_insert))
			{
				$sql_set = array_merge($sql_set, $sql_insert);
			}
		
			// Unless defined via '$force_overwrite = TRUE', ensure that cart data for confirmed orders cannot be overwritten.
			if (! $force_overwrite)
			{
				$sql_where[$tbl_col_save_cart['readonly_status']] = 0;
			}

			$sql_where[$tbl_col_save_cart['id']] = $cart_data_id;

			$this->db->update($tbl_save_cart['table'], $sql_set, $sql_where);
			
			return $cart_data_id;
		}
		
		return FALSE;
	}

	/**
	 * set_cart_admin_data
	 * Sets item 'shipped' and 'cancelled' quantities, item stock and discount data to the 'admin data' array within the cart session.  
	 */
	public function set_cart_admin_data($cart_data = FALSE)
	{
		$admin_data = array(
			'items' => array(),
			'discounts' => array('active' => array(), 'saved' => array())
		);
		
		// Check the admin data is enabled.
		if ($this->get_enabled_status('admin_data'))
		{
			// Check the 'shipped' and 'cancelled' order details columns exist in the config file and are enabled.
			if ($this->get_enabled_status('ship_cancel_quantities'))
			{
				// Set alias for order details table.
				$tbl_col_order_details = $this->flexi->cart_database['order_details']['columns'];
				
				$sql_select = array(
					$tbl_col_order_details['item_quantity'],
					$tbl_col_order_details['item_quantity_shipped'],
					$tbl_col_order_details['item_quantity_cancelled']
				);
			
				// Get the quantity of items ordered, shipped and cancelled.
				foreach($cart_data['items'] as $row_id => $item_data)
				{		
					$sql_where = array(
						$tbl_col_order_details['order_number'] => $cart_data['settings']['configuration']['order_number'],
						$tbl_col_order_details['cart_row_id'] => $row_id
					);

					$query = $this->db->select($sql_select)
						->from($this->flexi->cart_database['order_details']['table'])
						->where($sql_where)
						->get();

					if ($query->num_rows() == 1)
					{
						$item_data = $query->row_array();
						
						$admin_data['items'][$row_id] = array(
							'item_quantity_shipped' => $item_data[$tbl_col_order_details['item_quantity_shipped']],
							'item_quantity_cancelled' => $item_data[$tbl_col_order_details['item_quantity_cancelled']],
							'saved_item_quantity' => $item_data[$tbl_col_order_details['item_quantity']],
							'saved_quantity_shipped' => $item_data[$tbl_col_order_details['item_quantity_shipped']],
							'saved_quantity_cancelled' => $item_data[$tbl_col_order_details['item_quantity_cancelled']],
							'stock_allocation' => 0
						);
					}
				}
			}
			
			###+++++++++++++++++++++++++++++++++###
			
			// Get the id of all discounts and reward vouchers that were active when the cart data was saved.
			$active_item_discounts = (isset($cart_data['settings']['discounts']['active_items'])) ? $cart_data['settings']['discounts']['active_items'] : array();
			$active_summary_discounts = (isset($cart_data['settings']['discounts']['active_summary'])) ? $cart_data['settings']['discounts']['active_summary'] : array();
			$active_reward_vouchers = (isset($cart_data['settings']['discounts']['reward_vouchers'])) ? $cart_data['settings']['discounts']['reward_vouchers'] : array();
			$active_discounts = array_merge($active_item_discounts, $active_summary_discounts, $active_reward_vouchers);
			
			foreach($active_discounts as $discount_data)
			{
				if (isset($discount_data['id']))
				{
					$admin_data['discounts']['active'][$discount_data['id']] = $discount_data['id'];
					$admin_data['discounts']['saved'][$discount_data['id']] = $discount_data['id'];
				}
			}
		}
				
		return $admin_data;
	}

	/**
	 * delete_cart_data
	 * Deletes saved cart data from the database.
	 * To prevent the accidental deletion of cart data from confirmed orders, unless '$force_delete = TRUE', only data from non-orders are deleted.
	 */
	public function delete_cart_data($sql_where = FALSE, $force_delete = FALSE)
	{		
		// If '$sql_where' is set, and is numeric, we assume it is the tables primary key.
		if (! empty($sql_where) && is_numeric($sql_where))
		{
			$sql_where = array($this->flexi->cart_database['db_cart_data']['columns']['id'] => $sql_where);
		}		

		// Unless specifically set via '$force_delete', prevent cart data for confirmed orders being deleted.
		if (! $force_delete)
		{
			$sql_where[$this->flexi->cart_database['db_cart_data']['columns']['readonly_status']] = 0;
		}
		
		###+++++++++++++++++++++++++++++++++###
		
		// Get a recordset of which cart data ids are to be deleted.
		$sql_select = array($this->flexi->cart_database['db_cart_data']['columns']['id']);

		$query = $this->get_table_data($this->flexi->cart_database['db_cart_data']['table'], $sql_select, $sql_where, FALSE, 'db_cart_data');
		
		// Loop through results and unset the 'saved data id' from the carts current session array if it matches a returned id.
		if ($query->num_rows() > 0)
		{
			foreach($query->result_array() as $saved_cart_data)
			{
				if ($this->flexi->cart_contents['settings']['configuration']['cart_data_id'] == $saved_cart_data[$this->flexi->cart_database['db_cart_data']['columns']['id']])
				{
					$this->flexi->cart_contents['settings']['configuration']['cart_data_id'] = FALSE;
					
					// Update cart session.
					$this->session->set_userdata(array($this->flexi->cart['name'] => $this->flexi->cart_contents));
					
					break;
				}
			}
		}

		###+++++++++++++++++++++++++++++++++###
		
		$this->db->delete($this->flexi->cart_database['db_cart_data']['table'], $sql_where);

		return ($this->db->affected_rows() > 0);
	}	
}

/* End of file flexi_cart_admin_model.php */
/* Location: ./application/models/flexi_cart_admin_model.php */
