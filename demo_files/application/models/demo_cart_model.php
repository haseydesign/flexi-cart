<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo_cart_model extends CI_Model {
	
	// The following method prevents an error occurring when $this->data is modified.
	// Error Message: 'Indirect modification of overloaded property Demo_cart_model::$data has no effect'
	public function &__get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// UPDATE CART
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * demo_update_cart
	 * Get item and shipping data from form inputs, and update the cart.
	 * This example uses the shipping location to update both the carts shipping and tax data.
	 */
	function demo_update_cart()
	{
		$this->load->library('flexi_cart');

		// Get item quantity data.
		$cart_data = $this->input->post('items');

		$settings = array();
		if ($this->input->post('shipping'))
		{
			foreach($this->input->post('shipping') as $type => $value)
			{
				// Update selected Country and State for shipping calculations.
				// !Important Note: We are matching countries and states by their database ID. Therefore it is important that the submitted value is an INT datatype 
				// and not a STRING. The reason for this is that the function used to update locations interprets STRING numbers as zip code locations.
				// A number can be converted to an INT using '(int)' before the variable.
				if (in_array($type, array('country', 'state')))
				{
					$settings['update_shipping_location'][] = (int)$value;
					$settings['update_tax_location'][] = (int)$value;
				}
				// Update selected Country and State for shipping calculations.
				// !Important Note: As US postal (Zip) codes are numeric, and we are trying to match the postal code by name (i.e. '10101'), it is important to ensure
				// the value is a STRING datatype, otherwise the function used to update locations interprets an INT number as a locations database ID.
				// A number can be converted to a STRING using '(string)' before the variable.
				else if ($type == 'postal_code')
				{
					$settings['update_shipping_location'][] = (string)$value;
					$settings['update_tax_location'][] = (string)$value;
				}
				
				// Update shipping option/method for shipping options updated via a database.
				// Database shipping data must be updated using the array key 'update_shipping'.
				// Note: This demo includes examples of updating shipping via a database or via setting manually, read the 'Database and Manual Shipping Data'
				//	section above in the 'view_cart' method to toggle which mode the cart uses.
				else if ($type == 'db_option')
				{
					$settings['update_shipping'] = $value;
				}
				// Update shipping option/method for shipping options set manually. 
				// Manually set shipping data must be updated using the array key 'set_shipping'.
				// Note: This demo includes examples of updating shipping via a database or via setting manually, read the 'Database and Manual Shipping Data'
				//	section above in the 'view_cart' method to toggle which mode the cart uses.
				else if ($type == 'manual_option')
				{
					// The manual shipping id has been submitted (as $value), we now need to obtain the remaining shipping option data.
					$settings['set_shipping'] = $this->demo_manual_shipping_options($value);
				}
			}
		}
				
		// Update the cart with the cart item data and the location and shipping data.
		return $this->flexi_cart->update_cart($cart_data, $settings, FALSE, TRUE);
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM DATA AND INSERT EXAMPLES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * demo_get_item_data
	 * Get data from a custom item table that is not a part of flexi cart.
	 */
	function demo_get_item_data()
	{
		return $this->db->from('demo_items')
			->join('demo_categories', 'item_cat_fk = cat_id')
			->order_by('item_id')
			->get()
			->result_array();
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * demo_insert_link_item_to_cart
	 * Insert an item to the cart via the 'Add items to cart via a link' page.
	 */
	function demo_insert_link_item_to_cart($item_id = 0)
	{
		$this->load->library('flexi_cart');

		###+++++++++++++++++++++++++++++++++###

		### Basic Examples ###
		
		if ($item_id == 101)
		{
			// Insert an item with the minimum required set of fields.
			$cart_data = array('id' => 101, 'name' => 'Item #101, minimum required fields.', 'quantity' => 1, 'price' => 20);
		}
		else if ($item_id == 102)
		{
			// Insert multiple items at once.
			$cart_data = array(
				array('id' => 1021, 'name' => 'Item #1021, multiple items at once.', 'quantity' => 1, 'price' => 22.50),
				array('id' => 1022, 'name' => 'Item #1022, multiple items at once.', 'quantity' => 1, 'price' => 35.95),
				array('id' => 1023, 'name' => 'Item #1023, multiple items at once.', 'quantity' => 1, 'price' => 16)
			);
		}
		
		###+++++++++++++++++++++++++++++++++###

		### Shipping Examples ###
		
		else if ($item_id == 103)
		{
			// Insert an item with free shipping.
			$cart_data = array('id' => 103, 'name' => 'Item #103, free shipping.', 'quantity' => 1, 'price' => 19.95, 'shipping_rate' => 0);
		}
		else if ($item_id == 104)
		{
			// Insert an item with free shipping to the UK only. 
			// This example uses the database table 'item_shipping' set via the config file, to define the location, the key 'shipping_rate' should not be set.
			$cart_data = array('id' => 104, 'name' => 'Item #104, free shipping to the UK only.', 'quantity' => 1, 'price' => 19.95);
		}
		else if ($item_id == 105)
		{
			// Insert an item with a shipping surcharge.
			$cart_data = array('id' => 105, 'name' => 'Item #105, shipping surcharge (&pound10.00).', 'quantity' => 1, 'price' => 59.95, 'shipping_rate' => 10);
		}
		else if ($item_id == 106)
		{
			// Insert an item that will be shipped separately from the rest of the cart. 
			// This example uses the database table 'item_shipping' set via the config file.
			$cart_data = array('id' => 106, 'name' => 'Item #106, shipped separately from the rest of the cart.', 'quantity' => 1, 'price' => 19.95);
		}
		else if ($item_id == 107)
		{
			// Item than can only be shipped to the UK.
			// This example uses the database table 'item_shipping' set via the config file.
			$cart_data = array('id' => 107, 'name' => 'Item #107, can only be shipped to specific location (UK).', 'quantity' => 1, 'price' => 21.5);
		}
		else if ($item_id == 108)
		{
			// Item than cannot be shipped to the UK or France.
			// This example uses the database table 'item_shipping' set via the config file.
			$cart_data = array('id' => 108, 'name' => 'Item #108, cannot be shipped to specific location (UK or France).', 'quantity' => 1, 'price' => 24.75);
		}
		else if ($item_id == 109)
		{
			// Insert an item with a defined weight, this can be used to calculate shipping. 
			// The items weight can trigger different shipping rates, add different quantities to test the effect.
			$cart_data = array('id' => 109, 'name' => 'Item #109, defined weight.', 'quantity' => 1, 'price' => 55, 'weight' => 138);
		}
		
		###+++++++++++++++++++++++++++++++++###

		### Tax Examples ###
		
		else if ($item_id == 110)
		{
			// Insert a tax free item.
			// This example uses the database table 'item_tax' set via the config file.
			$cart_data = array('id' => 110, 'name' => 'Item #110, tax free.', 'quantity' => 1, 'price' => 109.5);
		}
		else if ($item_id == 111)
		{
			// Insert an item with a specified tax rate that does not match the default cart tax rate.
			// Note: The tax rate must only be set as a non-formatted number. Example: 12.5 = 12.5% tax.
			$cart_data = array('id' => 111, 'name' => 'Item #111, specified tax of 12.5%.', 'quantity' => 1, 'price' => 45.95, 'tax_rate' => 12.5);
		}
		
		###+++++++++++++++++++++++++++++++++###

		### Stock Examples ###
		
		else if ($item_id == 112)
		{
			// Insert a stock controlled item that is IN-STOCK.
			// This example uses the database table 'item_stock' set via the config file.
			$cart_data = array('id' => 112, 'name' => 'Item #112, stock controlled, in-stock.', 'quantity' => 1, 'price' => 16.99);
		}
		else if ($item_id == 113)
		{
			// Insert a stock controlled item that is OUT-OF-STOCK.
			// This example uses the database table 'item_stock' set via the config file.
			$cart_data = array('id' => 113, 'name' => 'Item #113, stock controlled, out-of-stock.', 'quantity' => 1, 'price' => 16.99);
		}
		
		###+++++++++++++++++++++++++++++++++###

		### Misc. Examples ###
		
		else if ($item_id == 114)
		{
			// Insert an item with a specified number of reward points.
			$cart_data = array('id' => 114, 'name' => 'Item #114, specified 1000 reward points.', 'quantity' => 1, 'price' => 18.99, 'reward_points' => 1000);
		}
		else if ($item_id == 115)
		{
			// Insert an item with preset options.
			// Note: To insert an item with selectable options, see the 'Add Items to Cart via a Form' example.
			$cart_data = array(
				'id' => 115, 'name' => 'Item #115, options.', 'quantity' => 1, 'price' => 79.49, 
				'options' => array(
					'Option Type #1' => 'Option #1', 'Option Type #2' => 'Option #2'
				)
			);
			// Note: The 'options' array could also have been set without array keys, or can even be set as just a string.
		}
		else if ($item_id == 116)
		{
			// Insert an item with misc. data fields, in this example 'user_note' and 'sku'.
			// The 'sku' field is not shown in the cart demo but is saved to the order table during checkout.
			$cart_data = array(
				'id' => 116, 'name' => 'Item #116, misc. "user note" and "sku" fields.', 'quantity' => 1, 'price' => 55, 
				'sku' => 'ITEMSKU116', 'user_note' => 'Customer Note'
			);
		}
		else if ($item_id == 117)
		{
			// Insert an item that is given its own unique row everytime its re-added to the cart.
			$cart_data = array('id' => 117, 'name' => 'Item #117, unique row everytime re-added.', 'quantity' => 1, 'price' => 149.5, 'unique' => TRUE);
		}
		
		###+++++++++++++++++++++++++++++++++###
		
		// Insert collected data to cart.
		if (isset($cart_data))
		{
			$this->flexi_cart->insert_items($cart_data);
		}

		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * demo_insert_form_item_to_cart
	 * Insert an item to the cart from via 'Add items to cart via a form' page.
	 */
	function demo_insert_form_item_to_cart($item_id = 0)
	{
		$this->load->library('flexi_cart');

		###+++++++++++++++++++++++++++++++++###

		// 'Add an item via a form' Example #201.
		if ($this->input->post('add_one_item'))
		{
			$item_id = $this->input->post('item_id');
			$name = $this->input->post('name');
			$price = $this->input->post('price');
			$quantity = $this->input->post('quantity');
			
			$cart_data = array(
				'id' => $item_id, 
				'name' => $name, 
				'quantity' => $quantity, 
				'price' => $price
			);
		}
		
		###+++++++++++++++++++++++++++++++++###

		// 'Add an item with options via a form' Multiple Option Example #202.
		else if ($this->input->post('add_one_item_options'))
		{
			$item_id = $this->input->post('item_id');
			$name = $this->input->post('name');
			$price = $this->input->post('price');
			$quantity = $this->input->post('quantity');
			$option_1 = $this->input->post('option_1');
			$option_2 = $this->input->post('option_2');

			// This is an example of including an array of options that are available for an item.
			// This data could then be used to allow the item option to be changed directly via the cart, once already inserted.
			$example_updatable_option_data = array(
				'Colour' => array('Red', 'Green', 'Blue'),
				'Size' => array('Small', 'Medium', 'Large')
			);
			
			$cart_data = array(
				'id' => $item_id, 
				'name' => $name, 
				'quantity' => $quantity, 
				'price' => $price,
				'options' => array(
					'Colour' => $option_1, 'Size' => $option_2
				),
				'option_data' => $example_updatable_option_data
			);			
			// Note: The 'options' array could also have been set without array keys. If set, the array keys can be displayed by the cart as a suffix.
			// Example #1: 'options' => array('Option Type #1' => $option_1, 'Option Type #2' => $option_2)
			// Example #2: 'options' => array($option_1, $option_2)
		}
		
		###+++++++++++++++++++++++++++++++++###

		// 'Add an item with options via a form' 2 Option Example #203.
		else if ($this->input->post('add_one_item_price_options'))
		{
			// Create array of example data that could be obtained via a database.
			$example_option_lookup_data = array(
				array('id' => 1, 'price' => 16.95, 'option' => 'Option #1'),
				array('id' => 2, 'price' => 19.45, 'option' => 'Option #2'),
				array('id' => 3, 'price' => 22.99, 'option' => 'Option #3')
			);
			
			$item_id = $this->input->post('item_id');
			$name = $this->input->post('name');
			$quantity = $this->input->post('quantity');
			$option_id = $this->input->post('option_with_price'); // Get the selected option id.
			
			// Loop through example database option data and get the price and option name.
			foreach($example_option_lookup_data as $data)
			{
				if ($option_id == $data['id'])
				{
					$price = $data['price'];
					$option = $data['option'];
				}
			}
			
			$cart_data = array(
				'id' => $item_id, 
				'name' => $name, 
				'quantity' => $quantity, 
				'price' => $price, 
				'options' => $option
			);			
			// Note: As there is only 1 option selected, we do not need to add the options as an array like in other examples.
		}

		###+++++++++++++++++++++++++++++++++###

		// 'Add multiple items via a form' Example #204, #205 and #206
		else if ($this->input->post('add_multiple_items') && $this->input->post('item'))
		{
			// Create array to add cart item data to.
			$cart_data = array();
			
			foreach($this->input->post('item') as $item_data)
			{
				// If item has been checked, add it to cart.
				if (isset($item_data['checked']))
				{
					$cart_data[] = array(
						'id' => $item_data['item_id'], 
						'name' => $item_data['name'], 
						'quantity' => $item_data['quantity'], 
						'price' => $item_data['price']
					);
				}
			}
		}
		
		###+++++++++++++++++++++++++++++++++###

		// Insert collected data to cart.
		if (isset($cart_data))
		{
			$this->flexi_cart->insert_items($cart_data);
		}
						
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * demo_insert_discount_item_to_cart
	 * Insert a discounted item to the cart via the 'Add discount items to cart' page.
	 */
	function demo_insert_discount_item_to_cart($item_id = 0)
	{
		$this->load->library('flexi_cart');

		### Basic Discount Examples ###
		
		if ($item_id == 301)
		{
			$cart_data = array('id' => 301, 'name' => 'Discount Item #301, 10% off original price (&pound;24.99).', 'quantity' => 1, 'price' => 24.99);
		}
		else if ($item_id == 302)
		{
			$cart_data = array('id' => 302, 'name' => 'Discount Item #302, Fixed price of &pound;5.00 off original price of &pound;12.50.', 'quantity' => 1, 'price' => 12.5);
		}
		else if ($item_id == 303)
		{
			$cart_data = array('id' => 303, 'name' => 'Discount Item #303, New price of &pound;15.00, item was &pound;25.00.', 'quantity' => 1, 'price' => 25);
		}
		
		###+++++++++++++++++++++++++++++++++###

		### Quantity Based Discount Examples ###
		
		else if ($item_id == 304)
		{
			$cart_data = array('id' => 304, 'name' => 'Discount Item #304, Buy 2, get 1 free.', 'quantity' => 1, 'price' => 10);
		}
		else if ($item_id == 305)
		{
			$cart_data = array('id' => 305, 'name' => 'Discount Item #305, Buy 1, get 1 @ 50% off.', 'quantity' => 1, 'price' => 20);
		}
		else if ($item_id == 306)
		{
			$cart_data = array('id' => 306, 'name' => 'Discount Item #306, Buy 2 @ &pound;15.00, get 1 with &pound;5.00 off.', 'quantity' => 1, 'price' => 15);
		}
		else if ($item_id == 307)
		{
			$cart_data = array('id' => 307, 'name' => 'Discount Item #307, Buy 5 @ &pound;10.00, get 2 for &pound;7.00.', 'quantity' => 1, 'price' => 10);
		}
		else if ($item_id == 308)
		{
			$cart_data = array('id' => 308, 'name' => 'Discount Item #308, Buy 3, get free UK shipping on these items (Other items still charged).', 'quantity' => 1, 'price' => 12.5);
		}
		
		###+++++++++++++++++++++++++++++++++###

		### Value Based Discounts Examples ###
		
		else if ($item_id == 309)
		{
			$cart_data = array('id' => 309, 'name' => 'Discount Item #309, Spend over &pound;75.00 on this item, get 10% off this items total.', 'quantity' => 1, 'price' => 30);
		}
		else if ($item_id == 310)
		{
			$cart_data = array('id' => 310, 'name' => 'Discount Item #310, Spend over &pound;100.00 on this item, get &pound;10.00 off this items total.', 'quantity' => 1, 'price' => 45);
		}
		
		###+++++++++++++++++++++++++++++++++###

		### Grouped Item Discount Examples ###
		
		else if ($item_id == 311)
		{
			$cart_data = array('id' => 311, 'name' => 'Discount Item #311, Item A, group discount - buy 3, get cheapest item free.', 'quantity' => 1, 'price' => 12);
		}
		else if ($item_id == 312)
		{
			$cart_data = array('id' => 312, 'name' => 'Discount Item #312, Item B, group discount - buy 3, get cheapest item free.', 'quantity' => 1, 'price' => 15);
		}
		else if ($item_id == 313)
		{
			$cart_data = array('id' => 313, 'name' => 'Discount Item #313, Item C, group discount - buy 3, get cheapest item free.', 'quantity' => 1, 'price' => 25);
		}
		
		###+++++++++++++++++++++++++++++++++###

		### Grouped Item / Category Based Discount Examples ###
		
		else if ($item_id == 314)
		{
			$cart_data = array('id' => 314, 'name' => 'Discount Item #314, 10% off original price - but for logged in users only (Toggle "User Status" via "Miscellaneous" Feature Examples Page).', 'quantity' => 1, 'price' => 10);
		}
		else if ($item_id == 315)
		{
			$cart_data = array('id' => 315, 'name' => 'Discount Item #315, 10% off original price - but removes the items reward points (Normally 200 points).', 'quantity' => 1, 'price' => 20);
		}
		else if ($item_id == 316)
		{
			$cart_data = array('id' => 316, 'name' => 'Discount Item #316, 10% off original price - but applies to 1 item quantity only (Non recursive quantity discount).', 'quantity' => 1, 'price' => 15);
		}
		else if ($item_id == 317)
		{
			$cart_data = array('id' => 317, 'name' => 'Discount Item #317, 10% off original price - but applies to orders being shipped to the UK only.', 'quantity' => 1, 'price' => 25);
		}
		else if ($item_id == 318)
		{
			$cart_data = array('id' => 318, 'name' => 'Discount Item #318, 10% off original price - but cannot be applied if other discounts exist.', 'quantity' => 1, 'price' => 30);
		}
		
		###+++++++++++++++++++++++++++++++++###

		### Discount Tax Application Rules ###

		else if ($item_id == 401)
		{
			$cart_data = array('id' => 401, 'name' => 'Discount Item #401, Get 10% off original price (&pound;10.00) - Method #1.', 'quantity' => 1, 'price' => 10);
		}
		else if ($item_id == 402)
		{
			$cart_data = array('id' => 402, 'name' => 'Discount Item #402, Get 10% off original price (&pound;10.00) - Method #2.', 'quantity' => 1, 'price' => 10);
		}
		else if ($item_id == 403)
		{
			$cart_data = array('id' => 403, 'name' => 'Discount Item #403, Get 10% off original price (&pound;10.00) - Method #3.', 'quantity' => 1, 'price' => 10);
		}
		else if ($item_id == 404)
		{
			$cart_data = array('id' => 404, 'name' => 'Discount Item #404, Get set price of (&pound;5.00) off original price (&pound;10.00) - Method #1.', 'quantity' => 1, 'price' => 10);
		}
		else if ($item_id == 405)
		{
			$cart_data = array('id' => 405, 'name' => 'Discount Item #405, Get set price of (&pound;5.00) off original price (&pound;10.00) - Method #2.', 'quantity' => 1, 'price' => 10);
		}
		else if ($item_id == 406)
		{
			$cart_data = array('id' => 406, 'name' => 'Discount Item #406, Get set price of (&pound;5.00) off original price (&pound;10.00) - Method #3.', 'quantity' => 1, 'price' => 10);
		}
		else if ($item_id == 407)
		{
			$cart_data = array('id' => 407, 'name' => 'Discount Item #407, Get for new price of &pound;7.50 (Original price &pound;10.00) - Method #1.', 'quantity' => 1, 'price' => 10);
		}
		else if ($item_id == 408)
		{
			$cart_data = array('id' => 408, 'name' => 'Discount Item #408, Get for new price of &pound;7.50 (Original price &pound;10.00) - Method #2.', 'quantity' => 1, 'price' => 10);
		}
		else if ($item_id == 409)
		{
			$cart_data = array('id' => 409, 'name' => 'Discount Item #409, Get for new price of &pound;7.50 (Original price &pound;10.00) - Method #3.', 'quantity' => 1, 'price' => 10);
		}
		
		###+++++++++++++++++++++++++++++++++###
				
		// Insert collected data to cart.
		if (isset($cart_data))
		{
			$this->flexi_cart->insert_items($cart_data);
		}
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * demo_insert_database_item_to_cart
	 * Insert an item from the custom item database table into the cart via the 'Add database items to cart' page.
	 */
	function demo_insert_database_item_to_cart($item_id = 0)
	{
		$this->load->library('flexi_cart');

		$query = $this->db->select('item_name, item_price, item_weight')
			->from('demo_items')
			->where('item_id', $item_id)
			->get();
			
		if ($query->num_rows() == 1)
		{
			$item_data = $query->row_array();
		
			// Note: It is not necessary to insert any item shipping, tax or discount data that is present in the defined flexi cart tables.
			// This data will automatically be retrieved by the cart library.
			$cart_data = array(
				'id' => $item_id, 
				'name' => 'Example Database '.$item_data['item_name'], 
				'quantity' => 1, 
				'price' => $item_data['item_price'], 
				'weight' => $item_data['item_weight']
			);
			
			$this->flexi_cart->insert_items($cart_data);
		}
		
		###+++++++++++++++++++++++++++++++++###
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * demo_set_discount
	 * Manually set a discount to a cart summary column via the 'Discounts / Surcharges' page.
	 */
	function demo_set_discount($discount_id = FALSE)
	{
		$this->load->library('flexi_cart');

		if (is_numeric($discount_id))
		{
			// By default a '0%' discount is applied to the 'total' column, and is taxed accordingly to the carts current tax settings, with reward points not voided.
			// Therefore, it is only necessary to submit array keys for the values that need to be changed from the default settings.
			// 'calculation' key values:  '1' = Percentage rate discount, method '2' = Flat rate discount, method '3' = New value discount.
		
			// £5 discount on grand total.
			if ($discount_id == 1)
			{
				$discount = array('id' => '5_discount', 'value' => 5, 'column' => 'total', 'calculation' => 2, 'tax_method' => 1, 'description' => '&pound;5 Discount');
			}
			// 10% discount on item total.
			else if ($discount_id == 2)
			{
				$discount = array('id' => '10pc_discount', 'value' => 10, 'column' => 'item_summary_total', 'calculation' => 1, 'tax_method' => 1, 'description' => '10% Discount on Item Total');
			}
			// Free shipping, void reward points.
			// Note: This example also sets a specific id of 'free_ship' for the discount. 
			// By defining an id, the discount can be updated/deleted using that specific id rather than a auto incremental numeric id. 
			else if ($discount_id == 3)
			{
				// !Important: To apply a fixed value discount (In this example '0' for free shipping), a 'calculation' method of '3' must be set.
				$discount = array(
					'id' => 'free_ship', 'value' => 0, 'column' => 'shipping_total', 'calculation' => 3, 'tax_method' => 1, 
					'description' => 'Free Shipping (UK only), but void reward points.', 'void_reward_points' => TRUE
				);
			}

			// Set the discount data.
			return $this->flexi_cart->set_discount($discount);
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SURCHARGES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * demo_set_surcharge
	 * Manually set a surcharge to a cart summary column via the 'Discounts / Surcharges' page.
	 */
	function demo_set_surcharge($surcharge_id = FALSE)
	{
		$this->load->library('flexi_cart');

		// Surcharge values can either be percentage based of fixed rate.
		// To set a percentage based surcharge, the column the surcharge is to be applied to must be submitted as either 'item_summary_total', 'shipping_total' or 'total'.
		// By default a fixed rate '0.00' surcharge is applied to the 'total' column and taxed accordingly to the carts current tax settings.
		// Therefore, it is only necessary to submit array keys for the values that need to be changed from the default settings.

		if (is_numeric($surcharge_id))
		{
			// £5 surcharge on grand total.
			if ($surcharge_id == 1)
			{
				// This example specifies a 10% tax rate on the surcharge.
				$surcharge = array('id' => '5_surcharge', 'value' => 5, 'tax_rate' => 10, 'column' => FALSE, 'description' => '&pound;5.00 surcharge, with 10% tax rate');
			}
			// 2% surcharge on sub-total.
			else if ($surcharge_id == 2)
			{
				// This example specifies no tax on the surcharge.
				$surcharge = array('id' => '2pc_surcharge', 'value' => 2, 'tax_rate' => 0, 'column' => 'item_summary_total', 'description' => '2% Surcharge on Item Summary Total, tax free');
			}
			// 2% surcharge on sub-total.
			else if ($surcharge_id == 3)
			{
				// This example specifies the cart default tax rate on the surcharge by submitting FALSE.
				$surcharge = array('id' => 'giftwrap', 'value' => 10, 'tax_rate' => FALSE, 'column' => FALSE, 'description' => '&pound;10.00 Gift wrap option, with default cart tax rate');
			}
			// 2% surcharge on sub-total.
			else if ($surcharge_id == 4)
			{
				// This example specifies no tax on the surcharge.
				$surcharge = array('id' => 'creditcard', 'value' => 3.5, 'tax_rate' => 0, 'column' => 'total', 'description' => '3.5% credit card surcharge on cart total, tax free');
			}

			return $this->flexi_cart->set_surcharge($surcharge);
		}
		
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TAX
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * demo_update_tax
	 * This example updates the carts tax location and therefore tax rate, independently from the shipping location. 
	 */
	function demo_update_tax()
	{
		$this->load->library('flexi_cart');

		// This example is attempting to update the carts tax location using the id of a country.
		// !Important Note: We are matching the submitted country by its database ID. Therefore it is important that the submitted value is an INT datatype 
		// and not a STRING. The reason for this is that the function used to update locations interprets STRING numbers as zip code locations.
		// A number can be converted to an INT using '(int)' before the variable.
		$location_id = (int)$this->input->post('tax_location');
		
		$this->flexi_cart->update_tax_location($location_id);
		
		// Set a custom status message.
		$this->flexi_cart->set_status_message('Tax successfully updated', 'public');

		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());
		
		redirect('standard_library');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOCATIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * demo_manual_shipping_options
	 * This example returns an array of manually defined shipping options, rather than using a database to obtain shipping rate data.
	 * If a '$ship_id' is submitted, only the array of that shipping option will be returned.
	 */
	function demo_manual_shipping_options($ship_id = FALSE)
	{
		$shipping_options =  array(
			1 => array('id' => 1, 'name' => 'Manual Ship Option #1', 'description' => '4-5 days', 'value' => 4.99),
			2 => array('id' => 2, 'name' => 'Manual Ship Option #2', 'description' => '2-3 days', 'value' => 7.99),
			3 => array('id' => 3, 'name' => 'Manual Ship Option #3', 'description' => 'Next day', 'value' => 9.99),
			4 => array('id' => 4, 'name' => 'Manual Ship Option #4 - Free', 'description' => 'Collect', 'value' => 0)
		);
		
		return (isset($shipping_options[$ship_id])) ? $shipping_options[$ship_id] : $shipping_options;
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOAD CART DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * demo_update_loaded_cart_data
	 * When a cart is loaded from saved database cart data, it is possible that item prices may have since changed, the problem this causes is that the cart will
	 * still display the item at the original price, whereas it needs to be updated to the current price.
	 * As flexi cart does not manage item tables, this function has to be custom made to suit each sites requirements. This is an example of how it can be achieved.
	 * Note that cart items including selectable options that affect the price would likely require a more complex query.
	 */
	function demo_update_loaded_cart_data()
	{
		$this->load->library('flexi_cart');

		$update_data = array();
		
		foreach($this->flexi_cart->cart_item_array() as $row_id => $column)
		{
			$sql_where = array('item_id' => $column['id']);
		
			$query = $this->db->get_where('demo_items', $sql_where);
				
			if ($query->num_rows() == 1)
			{
				$item_data = $query->row_array();
			
				// The array 'key' names are the same as those used for items in the cart array.
				// The 'row_id' is required to identify which cart row needs to be updated.
				$update_data[] = array(
					'row_id' => $row_id,
					'price' => $item_data['item_price'],
					'weight' => $item_data['item_weight']
				);
			}
		}
		
		if (! empty($update_data))
		{
			// When calling the 'update_data()' function, setting the 3rd parameter as 'TRUE' will force all submitted data to be updated to the cart,
			// regardless of whether the cart column is defined via the config file as an 'updatable column' or not.
			return $this->flexi_cart->update_cart($update_data, FALSE, TRUE);
		}
		
		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SAVE CART AND CUSTOMER DETAILS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * demo_save_order
	 * This example validates data posted from the checkout page and then saves it along with the current cart data as a confirmed order.
	 */
	function demo_save_order()
	{
		$this->load->library('form_validation');
		$this->load->library('flexi_cart_admin');
		
		// Set validation rules.
		$this->form_validation->set_rules('checkout[billing][name]', 'Billing Name', 'required');
		$this->form_validation->set_rules('checkout[billing][add_01]', 'Billing Address', 'required');
		$this->form_validation->set_rules('checkout[billing][city]', 'Billing ', 'required');
		$this->form_validation->set_rules('checkout[billing][state]', 'Billing State / County', 'required');
		$this->form_validation->set_rules('checkout[billing][post_code]', 'Billing Post / Zip Code', 'required');
		$this->form_validation->set_rules('checkout[billing][country]', 'Billing Country', 'required');
		$this->form_validation->set_rules('checkout[shipping][name]', 'Shipping Name', 'required');
		$this->form_validation->set_rules('checkout[shipping][add_01]', 'Shipping Address', 'required');
		$this->form_validation->set_rules('checkout[shipping][city]', 'Shipping ', 'required');
		$this->form_validation->set_rules('checkout[shipping][state]', 'Shipping State / County', 'required');
		$this->form_validation->set_rules('checkout[shipping][post_code]', 'Shipping Post / Zip Code', 'required');
		$this->form_validation->set_rules('checkout[shipping][country]', 'Shipping Country', 'required');
		$this->form_validation->set_rules('checkout[email]', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('checkout[phone]', 'Phone Number', 'required|min_length[10]');

		// The following fields are not validated, however must be included as done below or their data will not be repopulated by CI.
		$this->form_validation->set_rules('checkout[billing][company]');
		$this->form_validation->set_rules('checkout[billing][add_02]');
		$this->form_validation->set_rules('checkout[shipping][company]');
		$this->form_validation->set_rules('checkout[shipping][add_02]');
		$this->form_validation->set_rules('checkout[comments]');
			
		// Save checkout order data if valid
		if ($this->form_validation->run())
		{
			$order_data = $this->input->post('checkout');

			// There is no user login system in the flexi cart demo to obtain a logged in users id, 
			// therefore for demo purposes, we will manually set it as 1.
			$user_id = 1;
			
			// Assign all billing, shipping and contact details to their corresponding database columns.
			// All summary data within the cart array will automatically be saved when using the 'save_order()' function, 
			// provided the corresponding $config['database']['order_summary']['columns']['xxx'] is set via the config file.
			$custom_summary_data = array(
				'ord_user_fk' => $user_id,
				'ord_demo_bill_name' => $order_data['billing']['name'],
				'ord_demo_bill_company' => $order_data['billing']['company'],
				'ord_demo_bill_address_01' => $order_data['billing']['add_01'],
				'ord_demo_bill_address_02' => $order_data['billing']['add_02'],
				'ord_demo_bill_city' => $order_data['billing']['city'],
				'ord_demo_bill_state' => $order_data['billing']['state'],
				'ord_demo_bill_post_code' => $order_data['billing']['post_code'],
				'ord_demo_bill_country' => $order_data['billing']['country'],
				'ord_demo_ship_name' => $order_data['shipping']['name'],
				'ord_demo_ship_company' => $order_data['shipping']['company'],
				'ord_demo_ship_address_01' => $order_data['shipping']['add_01'],
				'ord_demo_ship_address_02' => $order_data['shipping']['add_02'],
				'ord_demo_ship_city' => $order_data['shipping']['city'],
				'ord_demo_ship_state' => $order_data['shipping']['state'],
				'ord_demo_ship_post_code' => $order_data['shipping']['post_code'],
				'ord_demo_ship_country' => $order_data['shipping']['country'],
				'ord_demo_email' => $order_data['email'],
				'ord_demo_phone' => $order_data['phone'],
				'ord_demo_comments' => $order_data['comments']
			);

			// Create an array of any user defined columns that were added to cart items.
			// This example checks to see if any items have a custom column called 'sku' (Example item #116 has this column).
			// Note: This hand coded method of saving custom item data is only required if the custom column has not been defined in the config file
			// via the '$config['cart']['items']['custom_columns']' and '$config['database']['order_details']['custom_columns']' arrays.
			$custom_item_data = array();
			foreach($this->flexi_cart_admin->cart_items(TRUE, FALSE, TRUE) as $row_id => $item)
			{
				// Check if any items in the item array have an 'sku' column.
				if (isset($item['sku']) && ! empty($item['sku']))
				{
					$custom_item_data[$row_id]['ord_det_demo_sku'] = $item['sku'];
				}
			}
			
			// Save cart and customer details.
			return $this->flexi_cart_admin->save_order($custom_summary_data, $custom_item_data);  
		}
		else
		{
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}

}
/* End of file demo_cart_model.php */
/* Location: ./application/models/demo_cart_model.php */