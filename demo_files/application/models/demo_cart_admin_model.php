<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo_cart_admin_model extends CI_Model {
	
	// The following method prevents an error occurring when $this->data is modified.
	// Error Message: 'Indirect modification of overloaded property Demo_cart_admin_model::$data has no effect'
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// UPDATE ORDER DETAILS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * demo_resave_order
	 * Update the cart data from a reloaded order.
	 */
	function demo_resave_order($order_number)
	{
		$this->load->library('flexi_cart');

		// Set 'update_order' post data to variable to allow easier checking of array values in the POST data.
		$this->post_data = $this->input->post('update_order');
				
		// Insert any submitted discount codes.
		if (isset($this->post_data['discount_code']))
		{	
			$discount_data = $this->input->post('discount_code');					
			$this->flexi_cart->update_discount_codes($discount_data);
		}
		
		// Remove any specifically submitted manual discounts.
		if (isset($this->post_data['remove_discount']))
		{
			$remove_discount = key($this->post_data['remove_discount']);					
			$this->flexi_cart->unset_discount($remove_discount);
		}
		
		// Remove any specifically submitted surcharges.
		if (isset($this->post_data['remove_surcharge']))
		{
			$remove_surcharge = key($this->post_data['remove_surcharge']);					
			$this->flexi_cart->unset_surcharge($remove_surcharge);
		}
		
		if (isset($this->post_data['order']))
		{	
			$this->demo_insert_manual_discount();	
			$this->demo_insert_surcharge();
		}
		
		$order_item_data = $this->input->post('items');
		$settings['update_shipping'] = $this->input->post('shipping');
		
		$this->flexi_cart->update_cart($order_item_data, $settings, TRUE);		
	
		// Insert any items with a quantity over 0 to the cart. 
		if (isset($this->post_data['insert_items']))
		{	
			$this->demo_insert_item_to_cart();
		}

		// If 'Re-Save Cart as Order' button was clicked, resave the order data to the database.
		if (isset($this->post_data['save']))
		{
			$this->flexi_cart_admin->resave_order();
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			
			$this->flexi_cart->destroy_cart();
			
			redirect('admin_library/order_details/'.$order_number);
		}
		else
		{
			redirect('admin_library/update_order_details/'.$order_number);
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	function demo_insert_item_to_cart()
	{
		$insert_item_data = array();
		foreach($this->input->post('insert_item') as $item_id => $item_post_data)
		{
			if ($item_post_data['item_quantity'] > 0)
			{
				$query = $this->db->select('item_name, item_weight')
					->from('demo_items')
					->where('item_id', $item_id)
					->get();
					
				if ($query->num_rows() == 1)
				{
					$item_db_data = $query->row_array();
					
					// Note: It is not necessary to insert any item shipping, tax or discount data that is present in the defined flexi cart tables.
					// This data will automatically be retrieved by the cart library.
					$insert_item_data[] = array(
						'id' => $item_id, 
						'name' => 'Example Database '.$item_db_data['item_name'],
						'quantity' => $item_post_data['item_quantity'],
						'price' => $item_post_data['item_price'],
						'weight' => $item_db_data['item_weight']
					);
				}
			}
		}
		
		if (! empty($insert_item_data))
		{
			$this->load->library('flexi_cart');
			$this->flexi_cart->insert_items($insert_item_data);
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	function demo_insert_manual_discount()
	{
		$this->load->library('flexi_cart');

		foreach($this->input->post('discount') as $discount_data)
		{
			if (! empty($discount_data['description']) && $discount_data['value'] > 0)
			{
				// Set the manual discount POST data to the insert array.
				// Note: 'tax_method' and 'void_reward_points' could also be set if required.				
				$insert_discount_data = array(
					'description' => $discount_data['description'],
					'column' => $discount_data['column'],
					'value' => $discount_data['value'],
					'calculation' => $discount_data['calculation']
				);
				
				$this->flexi_cart->set_discount($insert_discount_data);
			}
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	function demo_insert_surcharge()
	{
		$this->load->library('flexi_cart');

		foreach($this->input->post('surcharge') as $surcharge_data)
		{
			if (! empty($surcharge_data['description']) && $surcharge_data['value'] > 0)
			{
				// Set the surcharge POST data to the insert array.
				$insert_surcharge_data = array(
					'description' => $surcharge_data['description'],
					'tax_rate' => $surcharge_data['tax_rate'],
					'value' => $surcharge_data['value'],
					'column' => $surcharge_data['column']
				);
				
				$this->flexi_cart->set_surcharge($insert_surcharge_data);
			}
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CUSTOM ITEM TABLE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * demo_get_item_data
	 * Get data from a custom item table that is not a part of flexi cart.
	 */
	function demo_get_item_data()
	{	
		return $this->db->from('demo_items')
			->join($this->flexi_cart_admin->db_table('item_stock'), 'item_id = '.$this->flexi_cart_admin->db_column('item_stock', 'item'))
			->join('demo_categories', 'item_cat_fk = cat_id')
			->order_by('item_id')
			->get()
			->result_array();
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOCATIONS AND ZONES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function demo_update_location_types()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		foreach($this->input->post('update') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$this->form_validation->set_rules('update['.$id.'][name]', 'Row #'.$i.' Location Type', 'required');
			$this->form_validation->set_rules('update['.$id.'][parent_location_type]', 'Row #'.$i.' Parent Location Type', 'requried|integer');
		}
		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('update') as $row)
			{
				if ($row['delete'] == 1)
				{
					$this->flexi_cart_admin->delete_db_location_type($row['id'], TRUE);
				}
				else
				{
					$sql_update = array(
						$this->flexi_cart_admin->db_column('location_type', 'name') => $row['name'],
						$this->flexi_cart_admin->db_column('location_type', 'parent') => $row['parent_location_type']
					);
				
					$this->flexi_cart_admin->update_db_location_type($sql_update, $row['id']);
				}
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect(current_url());	
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_location_type()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		$row_ids = array();
		foreach($this->input->post('insert') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
			$this->form_validation->set_rules('insert['.$id.'][name]', 'Row #'.$i.' Location Type', 'required');
			$this->form_validation->set_rules('insert['.$id.'][parent_location_type]', 'Row #'.$i.' Parent Location Type', 'requried|integer');
		}
		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('insert') as $row)
			{
				$sql_insert = array(
					$this->flexi_cart_admin->db_column('location_type', 'name') => $row['name'],
					$this->flexi_cart_admin->db_column('location_type', 'parent') => $row['parent_location_type']
				);
			
				$this->flexi_cart_admin->insert_db_location_type($sql_insert);
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect('admin_library/location_types');
		}
		else
		{
			// Set validation errors and field name ids so that data can be repopulated for all rows.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			$this->data['validation_row_ids'] = $row_ids;
			
			return FALSE;
		}
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function demo_update_locations()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		foreach($this->input->post('update') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$this->form_validation->set_rules('update['.$id.'][name]', 'Row #'.$i.' Name', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('update['.$id.'][parent_location]');
			$this->form_validation->set_rules('update['.$id.'][shipping_zone]');
			$this->form_validation->set_rules('update['.$id.'][tax_zone]');
			$this->form_validation->set_rules('update['.$id.'][status]');
		}

		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('update') as $row)
			{
				if ($row['delete'] == 1)
				{
					$this->flexi_cart_admin->delete_db_location($row['id']);
				}
				else
				{
					$sql_update = array(
						$this->flexi_cart_admin->db_column('locations', 'name') => $row['name'],
						$this->flexi_cart_admin->db_column('locations', 'parent') => $row['parent_location'],
						$this->flexi_cart_admin->db_column('locations', 'shipping_zone') => $row['shipping_zone'],
						$this->flexi_cart_admin->db_column('locations', 'tax_zone') => $row['tax_zone'],
						$this->flexi_cart_admin->db_column('locations', 'status') => $row['status']
					);
				
					$this->flexi_cart_admin->update_db_location($sql_update, $row['id']);
				}
			}
		
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect(current_url());	
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_location($location_type_id)
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		$row_ids = array();
		foreach($this->input->post('insert') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
			$this->form_validation->set_rules('insert['.$id.'][name]', 'Row #'.$i.' Name', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('insert['.$id.'][parent_location]');
			$this->form_validation->set_rules('insert['.$id.'][shipping_zone]');
			$this->form_validation->set_rules('insert['.$id.'][tax_zone]');
			$this->form_validation->set_rules('insert['.$id.'][status]');
		}
		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('insert') as $row)
			{
				$sql_insert = array(
					$this->flexi_cart_admin->db_column('locations', 'type') => $location_type_id,
					$this->flexi_cart_admin->db_column('locations', 'name') => $row['name'],
					$this->flexi_cart_admin->db_column('locations', 'parent') => $row['parent_location'],
					$this->flexi_cart_admin->db_column('locations', 'shipping_zone') => $row['shipping_zone'],
					$this->flexi_cart_admin->db_column('locations', 'tax_zone') => $row['tax_zone'],
					$this->flexi_cart_admin->db_column('locations', 'status') => $row['status']
				);
			
				$this->flexi_cart_admin->insert_db_location($sql_insert);
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect('admin_library/locations/'.$location_type_id);
		}
		else
		{
			// Set validation errors and field name ids so that data can be repopulated for all rows.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			$this->data['validation_row_ids'] = $row_ids;
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	function demo_update_zones()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		foreach($this->input->post('update') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$this->form_validation->set_rules('update['.$id.'][name]', 'Row #'.$i.' Name', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('update['.$id.'][description]');
			$this->form_validation->set_rules('update['.$id.'][status]');
		}
		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('update') as $row)
			{
				if ($row['delete'] == 1)
				{
					$this->flexi_cart_admin->delete_db_location_zone($row['id']);
				}
				else
				{
					$sql_update = array(
						$this->flexi_cart_admin->db_column('location_zones', 'name') => $row['name'],
						$this->flexi_cart_admin->db_column('location_zones', 'description') => $row['description'],
						$this->flexi_cart_admin->db_column('location_zones', 'status') => $row['status']
					);
				
					$this->flexi_cart_admin->update_db_location_zone($sql_update, $row['id']);
				}
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect(current_url());
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_zones()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		$row_ids = array();
		foreach($this->input->post('insert') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
			$this->form_validation->set_rules('insert['.$id.'][name]', 'Row #'.$i.' Name', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('insert['.$id.'][description]');
			$this->form_validation->set_rules('insert['.$id.'][status]');
		}
		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('insert') as $row)
			{		
				$sql_insert = array(
					$this->flexi_cart_admin->db_column('location_zones', 'name') => $row['name'],
					$this->flexi_cart_admin->db_column('location_zones', 'description') => $row['description'],
					$this->flexi_cart_admin->db_column('location_zones', 'status') => $row['status']
				);
			
				$this->flexi_cart_admin->insert_db_location_zone($sql_insert);
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect('admin_library/zones');
		}
		else
		{
			// Set validation errors and field name ids so that data can be repopulated for all rows.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			$this->data['validation_row_ids'] = $row_ids;
			
			return FALSE;
		}
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SHIPPING OPTIONS AND RATES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	function demo_update_shipping()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		foreach($this->input->post('update') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$this->form_validation->set_rules('update['.$id.'][name]', 'Row #'.$i.' Shipping Option Name', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('update['.$id.'][description]');
			$this->form_validation->set_rules('update['.$id.'][location]');
			$this->form_validation->set_rules('update['.$id.'][zone]');
			$this->form_validation->set_rules('update['.$id.'][inc_sub_locations]');
			$this->form_validation->set_rules('update['.$id.'][tax_rate]');
			$this->form_validation->set_rules('update['.$id.'][discount_inclusion]');
			$this->form_validation->set_rules('update['.$id.'][status]');
		}

		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('update') as $row)
			{
				if ($row['delete'] == 1)
				{
					// Submit TRUE to the second argument to ensure all related shipping rates are deleted.
					$this->flexi_cart_admin->delete_db_shipping($row['id'], TRUE);
				}
				else
				{
					// The forms locations field is submitted as an array to ensure each location id is returned,
					// We can then reverse the order of the array and get the most specific location that was selected. i.e. 'Post Code' > 'State' > 'Country'
					$location_id = 0;
					foreach(array_reverse($row['location']) as $id)
					{
						if ($id > 0)
						{
							$location_id = $id;
							break;
						}
					}
				
					$sql_update = array(
						$this->flexi_cart_admin->db_column('shipping_options', 'name') => $row['name'],
						$this->flexi_cart_admin->db_column('shipping_options', 'description') => $row['description'],
						$this->flexi_cart_admin->db_column('shipping_options', 'location') => $location_id,
						$this->flexi_cart_admin->db_column('shipping_options', 'zone') => $row['zone'],
						$this->flexi_cart_admin->db_column('shipping_options', 'inc_sub_locations') => $row['inc_sub_locations'],
						$this->flexi_cart_admin->db_column('shipping_options', 'tax_rate') => $row['tax_rate'],
						$this->flexi_cart_admin->db_column('shipping_options', 'discount_inclusion') => $row['discount_inclusion'],
						$this->flexi_cart_admin->db_column('shipping_options', 'status') => $row['status']
					);
				
					$this->flexi_cart_admin->update_db_shipping($sql_update, $row['id']);
				}
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect(current_url());
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_shipping()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$this->form_validation->set_rules('insert_option[name]', 'Shipping Option Name', 'required');
		
		// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
		$this->form_validation->set_rules('insert_option[description]');
		$this->form_validation->set_rules('insert_option[location]');
		$this->form_validation->set_rules('insert_option[zone]');
		$this->form_validation->set_rules('insert_option[inc_sub_locations]');
		$this->form_validation->set_rules('insert_option[tax_rate]');
		$this->form_validation->set_rules('insert_option[discount_inclusion]');
		$this->form_validation->set_rules('insert_option[status]');
		
		$i = 0;
		$row_ids = array();
		foreach($this->input->post('insert_rate') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
			$this->form_validation->set_rules('insert_rate['.$id.'][value]', 'Row #'.$i.' Rate', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('insert_rate['.$id.'][tare_weight]');
			$this->form_validation->set_rules('insert_rate['.$id.'][min_weight]');
			$this->form_validation->set_rules('insert_rate['.$id.'][max_weight]');
			$this->form_validation->set_rules('insert_rate['.$id.'][min_value]');
			$this->form_validation->set_rules('insert_rate['.$id.'][max_value]');
			$this->form_validation->set_rules('insert_rate['.$id.'][status]');
		}
		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			$option_data = $this->input->post('insert_option');
			$rate_data = $this->input->post('insert_rate');
			
			// The forms locations field is submitted as an array to ensure each location id is returned,
			// We can then reverse the order of the array and get the most specific location that was selected. i.e. 'Post Code' > 'State' > 'Country'
			$location_id = 0;
			foreach(array_reverse($option_data['location']) as $id)
			{
				if ($id > 0)
				{
					$location_id = $id;
					break;
				}
			}
			
			$sql_insert = array(
				$this->flexi_cart_admin->db_column('shipping_options', 'name') => $option_data['name'],
				$this->flexi_cart_admin->db_column('shipping_options', 'description') => $option_data['description'],
				$this->flexi_cart_admin->db_column('shipping_options', 'location') => $location_id,
				$this->flexi_cart_admin->db_column('shipping_options', 'zone') => $option_data['zone'],
				$this->flexi_cart_admin->db_column('shipping_options', 'inc_sub_locations') => $option_data['inc_sub_locations'],
				$this->flexi_cart_admin->db_column('shipping_options', 'tax_rate') => $option_data['tax_rate'],
				$this->flexi_cart_admin->db_column('shipping_options', 'discount_inclusion') => $option_data['discount_inclusion'],
				$this->flexi_cart_admin->db_column('shipping_options', 'status') => $option_data['status']
			);
			
			$shipping_id = $this->flexi_cart_admin->insert_db_shipping($sql_insert);
			
			###+++++++++++++++###
			
			foreach($rate_data as $row)
			{
				$sql_insert = array(
					$this->flexi_cart_admin->db_column('shipping_rates', 'parent') => $shipping_id,
					$this->flexi_cart_admin->db_column('shipping_rates', 'value') => $row['value'],
					$this->flexi_cart_admin->db_column('shipping_rates', 'tare_weight') => $row['tare_weight'],
					$this->flexi_cart_admin->db_column('shipping_rates', 'min_weight') => $row['min_weight'],
					$this->flexi_cart_admin->db_column('shipping_rates', 'max_weight') => $row['max_weight'],
					$this->flexi_cart_admin->db_column('shipping_rates', 'min_value') => $row['min_value'],
					$this->flexi_cart_admin->db_column('shipping_rates', 'max_value') => $row['max_value'],
					$this->flexi_cart_admin->db_column('shipping_rates', 'status') => $row['status']
				);
				
				$this->flexi_cart_admin->insert_db_shipping_rate($sql_insert);
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect('admin_library/shipping');
		}
		else
		{
			// Set validation errors and field name ids so that data can be repopulated for all rows.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			$this->data['validation_row_ids'] = $row_ids;
			
			return FALSE;
		}			
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	function demo_update_shipping_rate()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		foreach($this->input->post('update') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$this->form_validation->set_rules('update['.$id.'][value]', 'Row #'.$i.' Rate', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('update['.$id.'][tare_weight]');
			$this->form_validation->set_rules('update['.$id.'][min_weight]');
			$this->form_validation->set_rules('update['.$id.'][max_weight]');
			$this->form_validation->set_rules('update['.$id.'][min_value]');
			$this->form_validation->set_rules('update['.$id.'][max_value]');
			$this->form_validation->set_rules('update['.$id.'][status]');
		}

		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('update') as $row)
			{
				if ($row['delete'] == 1)
				{
					$this->flexi_cart_admin->delete_db_shipping_rate($row['id']);
				}
				else
				{
					$sql_update = array(
						$this->flexi_cart_admin->db_column('shipping_rates', 'value') => $row['value'],
						$this->flexi_cart_admin->db_column('shipping_rates', 'tare_weight') => $row['tare_weight'],
						$this->flexi_cart_admin->db_column('shipping_rates', 'min_weight') => $row['min_weight'],
						$this->flexi_cart_admin->db_column('shipping_rates', 'max_weight') => $row['max_weight'],
						$this->flexi_cart_admin->db_column('shipping_rates', 'min_value') => $row['min_value'],
						$this->flexi_cart_admin->db_column('shipping_rates', 'max_value') => $row['max_value'],
						$this->flexi_cart_admin->db_column('shipping_rates', 'status') => $row['status']
					);
				
					$this->flexi_cart_admin->update_db_shipping_rate($sql_update, $row['id']);
				}
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect(current_url());	
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_shipping_rate($shipping_id)
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		$row_ids = array();
		foreach($this->input->post('insert') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
			$this->form_validation->set_rules('insert['.$id.'][value]', 'Row #'.$i.' Rate', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('insert['.$id.'][tare_weight]');
			$this->form_validation->set_rules('insert['.$id.'][min_weight]');
			$this->form_validation->set_rules('insert['.$id.'][max_weight]');
			$this->form_validation->set_rules('insert['.$id.'][min_value]');
			$this->form_validation->set_rules('insert['.$id.'][max_value]');
			$this->form_validation->set_rules('insert['.$id.'][status]');
		}
		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('insert') as $row)
			{
				$sql_insert = array(
					$this->flexi_cart_admin->db_column('shipping_rates', 'parent') => $shipping_id,
					$this->flexi_cart_admin->db_column('shipping_rates', 'value') => $row['value'],
					$this->flexi_cart_admin->db_column('shipping_rates', 'tare_weight') => $row['tare_weight'],
					$this->flexi_cart_admin->db_column('shipping_rates', 'min_weight') => $row['min_weight'],
					$this->flexi_cart_admin->db_column('shipping_rates', 'max_weight') => $row['max_weight'],
					$this->flexi_cart_admin->db_column('shipping_rates', 'min_value') => $row['min_value'],
					$this->flexi_cart_admin->db_column('shipping_rates', 'max_value') => $row['max_value'],
					$this->flexi_cart_admin->db_column('shipping_rates', 'status') => $row['status']
				);

				$this->flexi_cart_admin->insert_db_shipping_rate($sql_insert);
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect('admin_library/shipping_rates/'.$shipping_id);
		}
		else
		{
			// Set validation errors and field name ids so that data can be repopulated for all rows.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			$this->data['validation_row_ids'] = $row_ids;
			
			return FALSE;
		}
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	function demo_update_item_shipping()
	{
		foreach($this->input->post('update') as $row)
		{
			if ($row['delete'] == 1)
			{
				$this->flexi_cart_admin->delete_db_item_shipping($row['id']);
			}
			else
			{
				$sql_update = array(
					$this->flexi_cart_admin->db_column('item_shipping', 'location') => $row['location'],
					$this->flexi_cart_admin->db_column('item_shipping', 'zone') => $row['zone'],
					$this->flexi_cart_admin->db_column('item_shipping', 'value') => $row['value'],
					$this->flexi_cart_admin->db_column('item_shipping', 'separate') => $row['separate'],
					$this->flexi_cart_admin->db_column('item_shipping', 'banned') => $row['banned'],
					$this->flexi_cart_admin->db_column('item_shipping', 'status') => $row['status']
				);
			
				$this->flexi_cart_admin->update_db_item_shipping($sql_update, $row['id']);
			}
		}
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
		redirect(current_url());
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_item_shipping($item_id)
	{
		foreach($this->input->post('insert') as $row)
		{
			$sql_insert = array(
				$this->flexi_cart_admin->db_column('item_shipping', 'item') => $item_id,
				$this->flexi_cart_admin->db_column('item_shipping', 'location') => $row['location'],
				$this->flexi_cart_admin->db_column('item_shipping', 'zone') => $row['zone'],
				$this->flexi_cart_admin->db_column('item_shipping', 'value') => $row['value'],
				$this->flexi_cart_admin->db_column('item_shipping', 'separate') => $row['separate'],
				$this->flexi_cart_admin->db_column('item_shipping', 'banned') => $row['banned'],
				$this->flexi_cart_admin->db_column('item_shipping', 'status') => $row['status']
			);
		
			$this->flexi_cart_admin->insert_db_item_shipping($sql_insert);
		}
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
		redirect('admin_library/item_shipping/'.$item_id);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TAXES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	function demo_update_tax()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		foreach($this->input->post('update') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$this->form_validation->set_rules('update['.$id.'][name]', 'Row #'.$i.' Name', 'required');
			$this->form_validation->set_rules('update['.$id.'][rate]', 'Row #'.$i.' Tax Rate', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('update['.$id.'][location]');
			$this->form_validation->set_rules('update['.$id.'][zone]');
			$this->form_validation->set_rules('update['.$id.'][status]');
		}

		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('update') as $row)
			{
				if ($row['delete'] == 1)
				{
					$this->flexi_cart_admin->delete_db_tax($row['id']);
				}
				else
				{
					// The forms locations field is submitted as an array to ensure each location id is returned,
					// We can then reverse the order of the array and get the most specific location that was selected. i.e. 'Post Code' > 'State' > 'Country'
					$location_id = 0;
					foreach(array_reverse($row['location']) as $id)
					{
						if ($id > 0)
						{
							$location_id = $id;
							break;
						}
					}
				
					$sql_update = array(
						$this->flexi_cart_admin->db_column('tax', 'name') => $row['name'],
						$this->flexi_cart_admin->db_column('tax', 'location') => $location_id,
						$this->flexi_cart_admin->db_column('tax', 'zone') => $row['zone'],
						$this->flexi_cart_admin->db_column('tax', 'rate') => $row['rate'],
						$this->flexi_cart_admin->db_column('tax', 'status') => $row['status']
					);
				
					$this->flexi_cart_admin->update_db_tax($sql_update, $row['id']);
				}
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect(current_url());
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_tax()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		$row_ids = array();
		foreach($this->input->post('insert') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
			$this->form_validation->set_rules('insert['.$id.'][name]', 'Row #'.$i.' Name', 'required');
			$this->form_validation->set_rules('insert['.$id.'][rate]', 'Row #'.$i.' Tax Rate', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('insert['.$id.'][location]');
			$this->form_validation->set_rules('insert['.$id.'][zone]');
			$this->form_validation->set_rules('insert['.$id.'][status]');
		}
		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('insert') as $row)
			{			
				// The forms locations field is submitted as an array to ensure each location id is returned,
				// We can then reverse the order of the array and get the most specific location that was selected. i.e. 'Post Code' > 'State' > 'Country'
				$location_id = 0;
				foreach(array_reverse($row['location']) as $id)
				{
					if ($id > 0)
					{
						$location_id = $id;
						break;
					}
				}
				
				$sql_insert = array(
					$this->flexi_cart_admin->db_column('tax', 'name') => $row['name'],
					$this->flexi_cart_admin->db_column('tax', 'location') => $location_id,
					$this->flexi_cart_admin->db_column('tax', 'zone') => $row['zone'],
					$this->flexi_cart_admin->db_column('tax', 'rate') => $row['rate'],
					$this->flexi_cart_admin->db_column('tax', 'status') => $row['status']
				);

				$this->flexi_cart_admin->insert_db_tax($sql_insert);
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect('admin_library/tax/');
		}
		else
		{
			// Set validation errors and field name ids so that data can be repopulated for all rows.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			$this->data['validation_row_ids'] = $row_ids;
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function demo_update_item_tax()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		foreach($this->input->post('update') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$this->form_validation->set_rules('update['.$id.'][rate]', 'Row #'.$i.' Rate', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated.
			$this->form_validation->set_rules('update['.$id.'][location]');
			$this->form_validation->set_rules('update['.$id.'][zone]');
			$this->form_validation->set_rules('update['.$id.'][status]');
		}

		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('update') as $row)
			{
				if ($row['delete'] == 1)
				{
					$this->flexi_cart_admin->delete_db_item_tax($row['id']);
				}
				else
				{
					$sql_update = array(
						$this->flexi_cart_admin->db_column('item_tax', 'location') => $row['location'],
						$this->flexi_cart_admin->db_column('item_tax', 'zone') => $row['zone'],
						$this->flexi_cart_admin->db_column('item_tax', 'rate') => $row['rate'],
						$this->flexi_cart_admin->db_column('item_tax', 'status') => $row['status']
					);
				
					$this->flexi_cart_admin->update_db_item_tax($sql_update, $row['id']);
				}
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect(current_url());
		}
		else
		{
			// Set validation errors and field name ids so that data can be repopulated for all rows.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_item_tax($item_id)
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		$row_ids = array();
		foreach($this->input->post('insert') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
			$this->form_validation->set_rules('insert['.$id.'][rate]', 'Row #'.$i.' Rate', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated.
			$this->form_validation->set_rules('insert['.$id.'][location]');
			$this->form_validation->set_rules('insert['.$id.'][zone]');
			$this->form_validation->set_rules('insert['.$id.'][status]');
		}
		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('insert') as $row)
			{
				$sql_insert = array(
					$this->flexi_cart_admin->db_column('item_tax', 'item') => $item_id,
					$this->flexi_cart_admin->db_column('item_tax', 'location') => $row['location'],
					$this->flexi_cart_admin->db_column('item_tax', 'zone') => $row['zone'],
					$this->flexi_cart_admin->db_column('item_tax', 'rate') => $row['rate'],
					$this->flexi_cart_admin->db_column('item_tax', 'status') => $row['status']
				);
			
				$this->flexi_cart_admin->insert_db_item_tax($sql_insert);
			}
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect('admin_library/item_tax/'.$item_id);
		}
		else
		{
			// Set validation errors and field name ids so that data can be repopulated for all rows.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			$this->data['validation_row_ids'] = $row_ids;
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM STOCK
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function demo_update_item_stock()
	{
		foreach($this->input->post('update') as $row)
		{
			// Update item stock levels.
			$sql_update_stock = array(
				$this->flexi_cart_admin->db_column('item_stock', 'quantity') => $row['stock_quantity'],
				$this->flexi_cart_admin->db_column('item_stock', 'auto_allocate_status') => $row['auto_allocate_status']
			);
			
			$sql_where_stock = array($this->flexi_cart_admin->db_column('item_stock', 'item') => $row['id']);
		
			$this->flexi_cart_admin->update_db_item_stock($sql_update_stock, $sql_where_stock);
			
			###+++++++++++++++++++++++++++++++++###
			
			// Update the weight and price of items from the custom item database table.
			$sql_update_price = array(
				'item_weight' => $row['weight'],
				'item_price' => $row['price']
			);
			
			$sql_where_price = array('item_id' => $row['id']);
			
			$this->db->update('demo_items', $sql_update_price, $sql_where_price);
			
			// Set a custom status message stating that data has been successfully updated.
			$this->flexi_cart_admin->set_status_message('Data successfully updated.', 'public', TRUE);
		}
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
		redirect(current_url());
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART ORDERS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function demo_update_order_details($order_number)
	{
		// Update order status.
		$sql_update = array($this->flexi_cart_admin->db_column('order_summary', 'status') => $this->input->post('update_status'));
	
		$this->flexi_cart_admin->update_db_order_summary($sql_update, $order_number);
	
		### ++++++++++ ###
	
		// Update shipped and cancelled item quantities.
		foreach($this->input->post('update_details') as $id => $row)
		{
			$sql_update = array();
		
			// Check that the 'Quantity Shipped' input field was submitted (Incase the field was disabled).
			if (isset($row['quantity_shipped']))
			{
				$sql_update[$this->flexi_cart_admin->db_column('order_details', 'item_quantity_shipped')] = $row['quantity_shipped'];
			}
			
			// Check that the 'Quantity Cancelled' input field was submitted (Incase the field was disabled).
			if (isset($row['quantity_cancelled']))
			{
				$sql_update[$this->flexi_cart_admin->db_column('order_details', 'item_quantity_cancelled')] = $row['quantity_cancelled'];
			}
		
			if (! empty($sql_update))
			{
				$this->flexi_cart_admin->update_db_order_details($sql_update, $row['id']);
			}
		}
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
		redirect(current_url());
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ORDER STATUS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function demo_update_order_status()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		foreach($this->input->post('update') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$this->form_validation->set_rules('update['.$id.'][status]', 'Row #'.$i.' Status Description', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('update['.$id.'][cancelled]');
			$this->form_validation->set_rules('update['.$id.'][default]');
		}

		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('update') as $row)
			{
				if ($row['delete'] == 1)
				{
					$this->flexi_cart_admin->delete_db_order_status($row['id']);
				}
				else
				{
					$sql_update = array(
						$this->flexi_cart_admin->db_column('order_status', 'status') => $row['status'],
						$this->flexi_cart_admin->db_column('order_status', 'cancelled') => $row['cancelled'],
						$this->flexi_cart_admin->db_column('order_status', 'save_default') => $row['save_default'],
						$this->flexi_cart_admin->db_column('order_status', 'resave_default') => $row['resave_default']
					);
				
					$this->flexi_cart_admin->update_db_order_status($sql_update, $row['id']);
				}
			}
			
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect(current_url());
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_order_status()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		$row_ids = array();
		foreach($this->input->post('insert') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
			$this->form_validation->set_rules('insert['.$id.'][status]', 'Row #'.$i.' Status Description', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('insert['.$id.'][cancelled]');
			$this->form_validation->set_rules('insert['.$id.'][save_default]');
			$this->form_validation->set_rules('insert['.$id.'][resave_default]');
		}
		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('insert') as $row)
			{			
				$sql_insert = array(
					$this->flexi_cart_admin->db_column('order_status', 'status') => $row['status'],
					$this->flexi_cart_admin->db_column('order_status', 'cancelled') => $row['cancelled'],
					$this->flexi_cart_admin->db_column('order_status', 'save_default') => $row['save_default'],
					$this->flexi_cart_admin->db_column('order_status', 'resave_default') => $row['resave_default']
				);

				$this->flexi_cart_admin->insert_db_order_status($sql_insert);
			}
			
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect('admin_library/order_status');
		}
		else
		{
			// Set validation errors and field name ids so that data can be repopulated for all rows.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			$this->data['validation_row_ids'] = $row_ids;
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CURRENCY
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function demo_update_currency()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		foreach($this->input->post('update') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$this->form_validation->set_rules('update['.$id.'][name]', 'Row #'.$i.' Name', 'required');
			$this->form_validation->set_rules('update['.$id.'][exchange_rate]', 'Row #'.$i.' Exchange Rate', 'required');
			$this->form_validation->set_rules('update['.$id.'][symbol]', 'Row #'.$i.' Symbol', 'required');
			$this->form_validation->set_rules('update['.$id.'][thousand]', 'Row #'.$i.' Thousand Separator', 'required');
			$this->form_validation->set_rules('update['.$id.'][decimal]', 'Row #'.$i.' Decimal Separator', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('update['.$id.'][symbol_suffix]');
			$this->form_validation->set_rules('update['.$id.'][status]');
		}

		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('update') as $row)
			{
				if ($row['delete'] == 1)
				{
					$this->flexi_cart_admin->delete_db_currency($row['id']);
				}
				else
				{
					$sql_update = array(
						$this->flexi_cart_admin->db_column('currency', 'name') => $row['name'],
						$this->flexi_cart_admin->db_column('currency', 'exchange_rate') => $row['exchange_rate'],
						$this->flexi_cart_admin->db_column('currency', 'symbol') => $row['symbol'],
						$this->flexi_cart_admin->db_column('currency', 'symbol_suffix') => $row['symbol_suffix'],
						$this->flexi_cart_admin->db_column('currency', 'thousand_separator') => $row['thousand'],
						$this->flexi_cart_admin->db_column('currency', 'decimal_separator') => $row['decimal'],
						$this->flexi_cart_admin->db_column('currency', 'status') => $row['status']
					);
				
					$this->flexi_cart_admin->update_db_currency($sql_update, $row['id']);
				}
			}
			
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect(current_url());
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_currency()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		$row_ids = array();
		foreach($this->input->post('insert') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
			$this->form_validation->set_rules('insert['.$id.'][name]', 'Row #'.$i.' Name', 'required');
			$this->form_validation->set_rules('insert['.$id.'][exchange_rate]', 'Row #'.$i.' Exchange Rate', 'required');
			$this->form_validation->set_rules('insert['.$id.'][symbol]', 'Row #'.$i.' Symbol', 'required');
			$this->form_validation->set_rules('insert['.$id.'][thousand]', 'Row #'.$i.' Thousand Separator', 'required');
			$this->form_validation->set_rules('insert['.$id.'][decimal]', 'Row #'.$i.' Decimal Separator', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
			$this->form_validation->set_rules('insert['.$id.'][symbol_suffix]');
			$this->form_validation->set_rules('insert['.$id.'][status]');
		}
		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('insert') as $row)
			{			
				$sql_insert = array(
					$this->flexi_cart_admin->db_column('currency', 'name') => $row['name'],
					$this->flexi_cart_admin->db_column('currency', 'exchange_rate') => $row['exchange_rate'],
					$this->flexi_cart_admin->db_column('currency', 'symbol') => $row['symbol'],
					$this->flexi_cart_admin->db_column('currency', 'symbol_suffix') => $row['symbol_suffix'],
					$this->flexi_cart_admin->db_column('currency', 'thousand_separator') => $row['thousand'],
					$this->flexi_cart_admin->db_column('currency', 'decimal_separator') => $row['decimal'],
					$this->flexi_cart_admin->db_column('currency', 'status') => $row['status']
				);

				$this->flexi_cart_admin->insert_db_currency($sql_insert);
			}
			
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect('admin_library/currency');
		}
		else
		{
			// Set validation errors and field name ids so that data can be repopulated for all rows.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			$this->data['validation_row_ids'] = $row_ids;
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function demo_update_discounts()
	{
		foreach($this->input->post('update') as $row)
		{
			if ($row['delete'] == 1)
			{
				$this->flexi_cart_admin->delete_db_discount($row['id']);
			}
			else
			{
				$sql_update = array($this->flexi_cart_admin->db_column('discounts', 'status') => $row['status']);
			
				$this->flexi_cart_admin->update_db_discount($sql_update, $row['id']);
			}
		}
		
		$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
		redirect(current_url());
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_update_discount($discount_id)
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$this->form_validation->set_rules('update[type]', 'Discount Type', 'greater_than[0]');
		$this->form_validation->set_rules('update[method]', 'Discount Method', 'greater_than[0]');
		$this->form_validation->set_rules('update[usage_limit]', 'Usage Limit', 'required');
		$this->form_validation->set_rules('update[valid_date]', 'Valid Date', 'required');
		$this->form_validation->set_rules('update[expire_date]', 'Expire Date', 'required');
		
		// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
		$this->form_validation->set_rules('update[tax_method]');
		$this->form_validation->set_rules('update[location]');
		$this->form_validation->set_rules('update[zone]');
		$this->form_validation->set_rules('update[group]');
		$this->form_validation->set_rules('update[item]');
		$this->form_validation->set_rules('update[code]');
		$this->form_validation->set_rules('update[description]');
		$this->form_validation->set_rules('update[quantity_required]');
		$this->form_validation->set_rules('update[quantity_discounted]');
		$this->form_validation->set_rules('update[value_required]');
		$this->form_validation->set_rules('update[value_discounted]');
		$this->form_validation->set_rules('update[recursive]');
		$this->form_validation->set_rules('update[unique]');
		$this->form_validation->set_rules('update[void_reward]');
		$this->form_validation->set_rules('update[force_shipping]');
		$this->form_validation->set_rules('update[custom_status_1]');
		$this->form_validation->set_rules('update[custom_status_2]');
		$this->form_validation->set_rules('update[custom_status_3]');
		$this->form_validation->set_rules('update[order_by]');

		// Validate fields.
		if ($this->form_validation->run()) 
		{
			$row = $this->input->post('update');
		
			$sql_update = array(
				$this->flexi_cart_admin->db_column('discounts', 'type') => $row['type'],
				$this->flexi_cart_admin->db_column('discounts', 'method') => $row['method'],
				$this->flexi_cart_admin->db_column('discounts', 'tax_method') => $row['tax_method'],
				$this->flexi_cart_admin->db_column('discounts', 'location') => $row['location'],
				$this->flexi_cart_admin->db_column('discounts', 'zone') => $row['zone'],
				$this->flexi_cart_admin->db_column('discounts', 'group') => $row['group'],
				$this->flexi_cart_admin->db_column('discounts', 'item') => $row['item'],
				$this->flexi_cart_admin->db_column('discounts', 'code') => $row['code'],
				$this->flexi_cart_admin->db_column('discounts', 'description') => $row['description'],
				$this->flexi_cart_admin->db_column('discounts', 'quantity_required') => $row['quantity_required'],
				$this->flexi_cart_admin->db_column('discounts', 'quantity_discounted') => $row['quantity_discounted'],
				$this->flexi_cart_admin->db_column('discounts', 'value_required') => $row['value_required'],
				$this->flexi_cart_admin->db_column('discounts', 'value_discounted') => $row['value_discounted'],
				$this->flexi_cart_admin->db_column('discounts', 'recursive') => $row['recursive'],
				$this->flexi_cart_admin->db_column('discounts', 'non_combinable') => $row['non_combinable'],
				$this->flexi_cart_admin->db_column('discounts', 'void_reward_points') => $row['void_reward'],
				$this->flexi_cart_admin->db_column('discounts', 'force_shipping_discount') => $row['force_shipping'],
				$this->flexi_cart_admin->db_column('discounts', 'custom_status_1') => $row['custom_status_1'],
				$this->flexi_cart_admin->db_column('discounts', 'custom_status_2') => $row['custom_status_2'],
				$this->flexi_cart_admin->db_column('discounts', 'custom_status_3') => $row['custom_status_3'],
				$this->flexi_cart_admin->db_column('discounts', 'usage_limit') => $row['usage_limit'],
				$this->flexi_cart_admin->db_column('discounts', 'valid_date') => $row['valid_date'],
				$this->flexi_cart_admin->db_column('discounts', 'expire_date') => $row['expire_date'],
				$this->flexi_cart_admin->db_column('discounts', 'status') => $row['status'],
				$this->flexi_cart_admin->db_column('discounts', 'order_by') => $row['order_by']
			);

			if ($this->flexi_cart_admin->update_db_discount($sql_update, $discount_id))
			{
				// Update was successful, redirect.
				$redirect_page = ($row['type'] == 1) ? 'item_discounts' : 'summary_discounts';
				
				$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
				redirect('admin_library/'.$redirect_page);
			}
			else
			{
				// Set errors.
				$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
				redirect(current_url());
			}
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_discount()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$this->form_validation->set_rules('insert[type]', 'Discount Type', 'greater_than[0]');
		$this->form_validation->set_rules('insert[method]', 'Discount Method', 'required|greater_than[0]');
		$this->form_validation->set_rules('insert[usage_limit]', 'Usage Limit', 'required');
		$this->form_validation->set_rules('insert[valid_date]', 'Valid Date', 'required');
		$this->form_validation->set_rules('insert[expire_date]', 'Expire Date', 'required');
		
		// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
		$this->form_validation->set_rules('insert[tax_method]');
		$this->form_validation->set_rules('insert[location]');
		$this->form_validation->set_rules('insert[zone]');
		$this->form_validation->set_rules('insert[group]');
		$this->form_validation->set_rules('insert[item]');
		$this->form_validation->set_rules('insert[code]');
		$this->form_validation->set_rules('insert[description]');
		$this->form_validation->set_rules('insert[quantity_required]');
		$this->form_validation->set_rules('insert[quantity_discounted]');
		$this->form_validation->set_rules('insert[value_required]');
		$this->form_validation->set_rules('insert[value_discounted]');
		$this->form_validation->set_rules('insert[recursive]');
		$this->form_validation->set_rules('insert[unique]');
		$this->form_validation->set_rules('insert[void_reward]');
		$this->form_validation->set_rules('insert[force_shipping]');
		$this->form_validation->set_rules('insert[custom_status_1]');
		$this->form_validation->set_rules('insert[custom_status_2]');
		$this->form_validation->set_rules('insert[custom_status_3]');
		$this->form_validation->set_rules('insert[order_by]');

		// Validate fields.
		if ($this->form_validation->run()) 
		{
			$row = $this->input->post('insert');

			$sql_insert = array(
				$this->flexi_cart_admin->db_column('discounts', 'type') => $row['type'],
				$this->flexi_cart_admin->db_column('discounts', 'method') => $row['method'],
				$this->flexi_cart_admin->db_column('discounts', 'tax_method') => $row['tax_method'],
				$this->flexi_cart_admin->db_column('discounts', 'location') => $row['location'],
				$this->flexi_cart_admin->db_column('discounts', 'zone') => $row['zone'],
				$this->flexi_cart_admin->db_column('discounts', 'group') => $row['group'],
				$this->flexi_cart_admin->db_column('discounts', 'item') => $row['item'],
				$this->flexi_cart_admin->db_column('discounts', 'code') => $row['code'],
				$this->flexi_cart_admin->db_column('discounts', 'description') => $row['description'],
				$this->flexi_cart_admin->db_column('discounts', 'quantity_required') => $row['quantity_required'],
				$this->flexi_cart_admin->db_column('discounts', 'quantity_discounted') => $row['quantity_discounted'],
				$this->flexi_cart_admin->db_column('discounts', 'value_required') => $row['value_required'],
				$this->flexi_cart_admin->db_column('discounts', 'value_discounted') => $row['value_discounted'],
				$this->flexi_cart_admin->db_column('discounts', 'recursive') => $row['recursive'],
				$this->flexi_cart_admin->db_column('discounts', 'non_combinable') => $row['non_combinable'],
				$this->flexi_cart_admin->db_column('discounts', 'void_reward_points') => $row['void_reward'],
				$this->flexi_cart_admin->db_column('discounts', 'force_shipping_discount') => $row['force_shipping'],
				$this->flexi_cart_admin->db_column('discounts', 'custom_status_1') => $row['custom_status_1'],
				$this->flexi_cart_admin->db_column('discounts', 'custom_status_2') => $row['custom_status_2'],
				$this->flexi_cart_admin->db_column('discounts', 'custom_status_3') => $row['custom_status_3'],
				$this->flexi_cart_admin->db_column('discounts', 'usage_limit') => $row['usage_limit'],
				$this->flexi_cart_admin->db_column('discounts', 'valid_date') => $row['valid_date'],
				$this->flexi_cart_admin->db_column('discounts', 'expire_date') => $row['expire_date'],
				$this->flexi_cart_admin->db_column('discounts', 'status') => $row['status'],
				$this->flexi_cart_admin->db_column('discounts', 'order_by') => $row['order_by']
			);

			$this->flexi_cart_admin->insert_db_discount($sql_insert);
			
			$redirect_page = ($row['type'] == 1) ? 'item_discounts' : 'summary_discounts';
			
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect('admin_library/'.$redirect_page);
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function demo_update_discount_groups()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		foreach($this->input->post('update') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$this->form_validation->set_rules('update['.$id.'][name]', 'Row #'.$i.' Name', 'required');
			
			// The following fields are not validated, however must be included as done below or their data will not be repopulated.
			$this->form_validation->set_rules('update['.$id.'][status]');
		}

		// Validate fields.
		if ($this->form_validation->run()) 
		{
			foreach($this->input->post('update') as $row)
			{
				if ($row['delete'] == 1)
				{
					$this->flexi_cart_admin->delete_db_discount_group($row['id']);
				}
				else
				{
					$sql_update = array(
						$this->flexi_cart_admin->db_column('discount_groups', 'name') => $row['name'],
						$this->flexi_cart_admin->db_column('discount_groups', 'status') => $row['status'],
					);
				
					$this->flexi_cart_admin->update_db_discount_group($sql_update, $row['id']);
				}
			}
			
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect(current_url());
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_update_discount_group($group_id)
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$this->form_validation->set_rules('update_group[name]', 'Name', 'required');

		// Validate fields.
		if ($this->form_validation->run()) 
		{
			$group_data = $this->input->post('update_group');
			
			$sql_update = array(
				$this->flexi_cart_admin->db_column('discount_groups', 'name') => $group_data['name'],
				$this->flexi_cart_admin->db_column('discount_groups', 'status') => $group_data['status']
			);
		
			$this->flexi_cart_admin->update_db_discount_group($sql_update, $group_id);
			
			###+++++++++++++++++++++++++++++++++###
			
			if ($this->input->post('delete_item'))
			{
				foreach($this->input->post('delete_item') as $row)
				{
					if ($row['delete'] == 1)
					{
						$sql_where = array($this->flexi_cart_admin->db_column('discount_group_items', 'id') => $row['id']);
						
						$this->flexi_cart_admin->delete_db_discount_group_item($sql_where);
					}
				}
			}
			
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect(current_url());
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_discount_group()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$this->form_validation->set_rules('insert_group[name]', 'Name', 'required');
		
		// The following fields are not validated, however must be included as done below or their data will not be repopulated.
		$this->form_validation->set_rules('insert_group[status]');

		$i = 0;
		$row_ids = array();
		foreach($this->input->post('insert_item') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
			$this->form_validation->set_rules('insert_item['.$id.'][logic_operator]', 'Row #'.$i.' Operator', 'required');
			$this->form_validation->set_rules('insert_item['.$id.'][column_name]', 'Row #'.$i.' Filter Column', 'required');
			$this->form_validation->set_rules('insert_item['.$id.'][comparison_operator]', 'Row #'.$i.' Filter Match Method', 'required');
			
			// The filter field is not validated, however must be included as done below or its data will not be repopulated.			
			$this->form_validation->set_rules('insert_item['.$id.'][value]');
		}
		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			// Create SQL WHERE statement from form filters.
			foreach($this->input->post('insert_item') as $data)
			{
				$column_name = $this->demo_get_discount_group_column($data['column_name']);
				
				if ($column_name)
				{
					// The 'create_sql_where()' function will use CI's active record to generate an SQL WHERE statement to filter items that match the query.
					$this->flexi_cart_admin->create_sql_where($column_name, $data['comparison_operator'], $data['value'], $data['logic_operator']);
				}
			}
			
			// Custom query getting item and category data.
			$query = $this->db->select('item_id')
				->from('demo_items')
				->join('demo_categories', 'cat_id = item_cat_fk', 'left')
				->get();
				
			if ($query->num_rows() > 0)
			{
				$group_data = $this->input->post('insert_group');
				
				$sql_insert = array(
					$this->flexi_cart_admin->db_column('discount_groups', 'name') => $group_data['name'],
					$this->flexi_cart_admin->db_column('discount_groups', 'status') => $group_data['status']
				);
			
				$group_id = $this->flexi_cart_admin->insert_db_discount_group($sql_insert);
			
				if ($group_id)
				{
					foreach($query->result_array() as $item)
					{
						$sql_insert = array(
							$this->flexi_cart_admin->db_column('discount_group_items', 'group') => $group_id,
							$this->flexi_cart_admin->db_column('discount_group_items', 'item') => $item['item_id']
						);
						
						$this->flexi_cart_admin->insert_db_discount_group_item($sql_insert);
					}
				}
				
				$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
				redirect('admin_library/update_discount_group/'.$group_id);
			}
			else
			{
				$this->data['message'] = '<p class="error_msg">There are no items matching the submitted SQL WHERE statement.</p>';
				$this->data['validation_row_ids'] = $row_ids;
				
				return FALSE;
			}
		}
		else
		{
			// Set validation errors and field name ids so that data can be repopulated for all rows.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			$this->data['validation_row_ids'] = $row_ids;
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	function demo_insert_discount_group_items($group_id)
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$i = 0;
		$row_ids = array();
		foreach($this->input->post('insert_item') as $id => $row)
		{
			$i++; // Identify rows using standard counting starting from 1 rather than 0.
			$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
			$this->form_validation->set_rules('insert_item['.$id.'][logic_operator]', 'Row #'.$i.' Operator', 'required');
			$this->form_validation->set_rules('insert_item['.$id.'][column_name]', 'Row #'.$i.' Filter Column', 'required');
			$this->form_validation->set_rules('insert_item['.$id.'][comparison_operator]', 'Row #'.$i.' Filter Match Method', 'required');

			// The filter field is not validated, however must be included as done below or its data will not be repopulated.			
			$this->form_validation->set_rules('insert_item['.$id.'][value]');
		}

		// The following fields are not validated, however must be included as done below or their data will not be repopulated.
		$this->form_validation->set_rules('insert_method');

		
		// Validate fields.
		if ($this->form_validation->run()) 
		{
			// Create SQL WHERE statement from form filters.
			foreach($this->input->post('insert_item') as $data)
			{
				$column_name = $this->demo_get_discount_group_column($data['column_name']);
				
				if ($column_name)
				{
					$this->flexi_cart_admin->create_sql_where($column_name, $data['comparison_operator'], $data['value'], $data['logic_operator']);
				}
			}
			
			// Custom Item query.
			$query = $this->db->select('item_id')
				->from('demo_items')
				->join('demo_categories', 'cat_id = item_cat_fk', 'left')
				->get();
			
			if ($query->num_rows() > 0)
			{
				if ($this->input->post('insert_method') == 'replace')
				{
					$sql_where = array($this->flexi_cart_admin->db_column('discount_group_items', 'group') => $group_id);
					$this->flexi_cart_admin->delete_db_discount_group_item($sql_where);
				}
			
				foreach($query->result_array() as $item_data)
				{
					$sql_insert = array(
						$this->flexi_cart_admin->db_column('discount_group_items', 'group') => $group_id,
						$this->flexi_cart_admin->db_column('discount_group_items', 'item') => $item_data['item_id']
					);
					
					$this->flexi_cart_admin->insert_db_discount_group_item($sql_insert);
				}
			}
			
			$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
			redirect('admin_library/update_discount_group/'.$group_id);
		}
		else
		{
			// Set validation errors and field name ids so that data can be repopulated for all rows.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			$this->data['validation_row_ids'] = $row_ids;
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
		
	function demo_get_discount_group_column($value)
	{
		$table_columns = array(
			'item_id' => 'item_id',
			'item_name' => 'item_name',
			'item_price' => 'item_price',
			'item_weight' => 'item_weight',
			'cat_id' => 'item_cat_fk',
			'cat_name' => 'cat_name'
		);
		
		return (isset($table_columns[$value])) ? $table_columns[$value] : FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// REWARD POINTS AND VOUCHERS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
			
	function demo_reward_point_summary($user_id = FALSE)
	{
		$sql_select = array(
			'user_id', 
			'user_name'
		);
	
		if ($user_id)
		{
			$this->db->where('user_id', $user_id);
		}
	
		$query = $this->db->select($sql_select)
			->get('demo_users');
			
		if ($query->num_rows() > 0)
		{
			$user_data = array();
			foreach($query->result_array() as $column)
			{
				$summary_data = $this->flexi_cart_admin->get_db_reward_point_summary($column['user_id']);
				
				$user_data[] = array(
					'user_id' => $column['user_id'],
					'user_name' => $column['user_name'],
					'total_points' => $summary_data[$this->flexi_cart_admin->db_column('reward_points', 'total_points')],
					'total_points_pending' => $summary_data[$this->flexi_cart_admin->db_column('reward_points', 'total_points_pending')],
					'total_points_active' => $summary_data[$this->flexi_cart_admin->db_column('reward_points', 'total_points_active')],
					'total_points_active' => $summary_data[$this->flexi_cart_admin->db_column('reward_points', 'total_points_active')],
					'total_points_expired' => $summary_data[$this->flexi_cart_admin->db_column('reward_points', 'total_points_expired')],
					'total_points_converted' => $summary_data[$this->flexi_cart_admin->db_column('reward_points', 'total_points_converted')],
					'total_points_cancelled' => $summary_data[$this->flexi_cart_admin->db_column('reward_points', 'total_points_cancelled')]
				);
			}
			
			return $user_data;
		}
		
		return FALSE;
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * demo_get_converted_reward_point_history
	 * Get data of all reward vouchers for a specific user.
	 * The returned array then nests another array of reward point data that was used to create the voucher.
	 */
	function demo_converted_reward_point_history($user_id)
	{
		$sql_select = array(
			$this->flexi_cart_admin->db_column('discounts', 'id'),
			$this->flexi_cart_admin->db_column('discounts', 'code')
		);
		
		$sql_where = array($this->flexi_cart_admin->db_column('discounts', 'user') => $user_id);
		
		$points_converted_data = $this->flexi_cart_admin->get_db_voucher_array($sql_select, $sql_where);
		
		// Loop through voucher data and get reward point data used to create voucher.
		foreach($points_converted_data as $row => $data)
		{
			$sql_select = array(
				$this->flexi_cart_admin->db_column('reward_points', 'order_number'),
				$this->flexi_cart_admin->db_column('reward_points', 'description'),
				$this->flexi_cart_admin->db_column('reward_points_converted', 'points'),
				$this->flexi_cart_admin->db_column('reward_points_converted', 'date')
			);
			
			$sql_where = array(
				$this->flexi->cart_database['reward_points_converted']['columns']['discount'] => $data[$this->flexi->cart_database['discounts']['columns']['id']]
			);
			
			$points_converted_data[$row]['reward_points'] = $this->flexi_cart_admin->get_db_converted_reward_points_array($sql_select, $sql_where);
		}

		return $points_converted_data;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/*
	 * demo_update_voucher
	 */
	function demo_update_voucher()
	{
		foreach($this->input->post('update') as $row)
		{
			$sql_update = array(
				$this->flexi_cart_admin->db_column('discounts', 'status') => $row['status'],
			);
		
			$this->flexi_cart_admin->update_db_voucher($sql_update, $row['id']);
		}
		
		$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
		redirect(current_url());
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * demo_convert_reward_points
	 */
	function demo_convert_reward_points($user_id)
	{
		$points_to_convert = $this->input->post('reward_points');
	
		$this->flexi_cart_admin->insert_db_voucher($user_id, $points_to_convert);
		
		$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
		redirect('admin_library/user_vouchers/'.$user_id);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART CONFIGURATION AND DEFAULTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function demo_update_config()
	{
		$data = $this->input->post('update');
	
		$sql_update = array(
			$this->flexi_cart_admin->db_column('configuration', 'order_number_prefix') => $data['order_number_prefix'],
			$this->flexi_cart_admin->db_column('configuration', 'order_number_suffix') => $data['order_number_suffix'],
			$this->flexi_cart_admin->db_column('configuration', 'increment_order_number') => $data['increment_order_number'],
			$this->flexi_cart_admin->db_column('configuration', 'minimum_order') => $data['minimum_order'],
			$this->flexi_cart_admin->db_column('configuration', 'quantity_decimals') => $data['quantity_decimals'],
			$this->flexi_cart_admin->db_column('configuration', 'increment_duplicate_item_quantity') => $data['increment_duplicate_item_quantity'],
			$this->flexi_cart_admin->db_column('configuration', 'quantity_limited_by_stock') => $data['quantity_limited_by_stock'],
			$this->flexi_cart_admin->db_column('configuration', 'remove_no_stock_items') => $data['remove_no_stock_items'],
			$this->flexi_cart_admin->db_column('configuration', 'auto_allocate_stock') => $data['auto_allocate_stock'],
			$this->flexi_cart_admin->db_column('configuration', 'weight_type') => $data['weight_type'],
			$this->flexi_cart_admin->db_column('configuration', 'weight_decimals') => $data['weight_decimals'],
			$this->flexi_cart_admin->db_column('configuration', 'display_tax_prices') => $data['display_tax_prices'],
			$this->flexi_cart_admin->db_column('configuration', 'price_inc_tax') => $data['price_inc_tax'],
			$this->flexi_cart_admin->db_column('configuration', 'multi_row_duplicate_items') => $data['multi_row_duplicate_items'],
			$this->flexi_cart_admin->db_column('configuration', 'dynamic_reward_points') => $data['dynamic_reward_points'],
			$this->flexi_cart_admin->db_column('configuration', 'reward_point_multiplier') => $data['reward_point_multiplier'],
			$this->flexi_cart_admin->db_column('configuration', 'reward_voucher_multiplier') => $data['reward_voucher_multiplier'],
			$this->flexi_cart_admin->db_column('configuration', 'reward_point_to_voucher_ratio') => $data['reward_point_to_voucher_ratio'],
			$this->flexi_cart_admin->db_column('configuration', 'reward_point_days_pending') => $data['reward_point_days_pending'],
			$this->flexi_cart_admin->db_column('configuration', 'reward_point_days_valid') => $data['reward_point_days_valid'],
			$this->flexi_cart_admin->db_column('configuration', 'reward_voucher_days_valid') => $data['reward_voucher_days_valid'],
			$this->flexi_cart_admin->db_column('configuration', 'save_banned_shipping_items') => $data['save_banned_shipping_items'],
			$this->flexi_cart_admin->db_column('configuration', 'custom_status_1') => $data['custom_status_1'],
			$this->flexi_cart_admin->db_column('configuration', 'custom_status_2') => $data['custom_status_2'],
			$this->flexi_cart_admin->db_column('configuration', 'custom_status_3') => $data['custom_status_3']
		);
	
		$this->flexi_cart_admin->update_db_config($sql_update);
		
		// Destroy the current cart and all settings so that new config settings can be set.
		// Note: The 'destroy_cart()' function is apart of the standard library.
		$this->load->library('flexi_cart');
		$this->flexi_cart->destroy_cart();
		
		$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
		redirect(current_url());
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	function demo_update_defaults()
	{
		$data = $this->input->post('update');

		###+++++++++++++++++++++++++++++++++###
		
		// Reset all cart defaults.
		$sql_update = array('curr_default' => 0);
		$this->flexi_cart_admin->update_db_currency($sql_update);
	
		$sql_update = array('loc_ship_default' => 0, 'loc_tax_default' => 0);
		$this->flexi_cart_admin->update_db_location($sql_update);
	
		$sql_update = array('ship_default' => 0);
		$this->flexi_cart_admin->update_db_shipping($sql_update);
	
		$sql_update = array('tax_default' => 0);
		$this->flexi_cart_admin->update_db_tax($sql_update);
					
		###+++++++++++++++++++++++++++++++++###

		// Set new cart defaults.			
		$sql_update = array('curr_default' => 1);
		$this->flexi_cart_admin->update_db_currency($sql_update, $data['currency']);

		$sql_update = array('loc_ship_default' => 1);
		$this->flexi_cart_admin->update_db_location($sql_update, $data['shipping_location']);
		
		$sql_update = array('loc_tax_default' => 1);
		$this->flexi_cart_admin->update_db_location($sql_update, $data['tax_location']);
		
		$sql_update = array('ship_default' => 1);
		$this->flexi_cart_admin->update_db_shipping($sql_update, $data['shipping_option']);
		
		$sql_update = array('tax_default' => 1);
		$this->flexi_cart_admin->update_db_tax($sql_update, $data['tax_rate']);
		
		###+++++++++++++++++++++++++++++++++###
		
		$this->session->set_flashdata('message', $this->flexi_cart_admin->get_messages('admin'));
		redirect(current_url());
	}
}
/* End of file demo_cart_admin_model.php */
/* Location: ./application/models/demo_cart_admin_model.php */


