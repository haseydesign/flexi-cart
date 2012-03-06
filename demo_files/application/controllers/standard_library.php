<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Standard_library extends CI_Controller {
	
	function __construct() 
	{
		parent::__construct();
		
		// To load the CI benchmark and memory usage profiler - set 1==1.
		if (1==2) 
		{
			$sections = array(
				'benchmarks' => TRUE, 'memory_usage' => TRUE, 
				'config' => FALSE, 'controller_info' => FALSE, 'get' => FALSE, 'post' => FALSE, 'queries' => FALSE, 
				'uri_string' => FALSE, 'http_headers' => FALSE, 'session_data' => FALSE
			); 
			$this->output->set_profiler_sections($sections);
			$this->output->enable_profiler(TRUE);
		}

		// Load CI libraries and helpers.
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('text');
 		$this->load->helper('url');
 		$this->load->helper('form');

		// Load 'standard' flexi cart library by default.
		$this->load->library('flexi_cart');	

		// Note: This is only included to create base urls for purposes of this demo only and are not necessarily considered as 'Best practice'.
		$this->load->vars('base_url', 'http://localhost/Flexi/flexi_cart/');
		$this->load->vars('includes_dir', 'http://localhost/Flexi/flexi_cart/includes/');
		$this->load->vars('current_url', $this->uri->uri_to_assoc(1));
		
		// Load cart data to be displayed via 'Mini Cart' menu.
		$this->mini_cart_data();
	}

	/**
	 * FLEXI CART DEMO
	 * Many of the functions within this controller load a custom model called 'demo_cart_model' that has been created for the purposes of this demo.
	 * The 'demo_cart_model' file is not part of flexi cart, it is included to demonstrate how some of the functions of flexi cart can be used.
	 */
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// VIEW CART
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * index
	 * Forwards to 'view_cart'.
	 */ 
	function index() 
	{
		$this->view_cart();
	}
	
	/**
	 * view_cart
	 * View and manage the contents of the cart.
	 */ 
	function view_cart() 
	{
		// Update cart contents and settings.
		if ($this->input->post('update'))
		{
			$this->update_cart();
		}
		// Update discount codes.
		else if ($this->input->post('update_discount'))
		{
			$this->update_discount_codes();
		}
		// Remove discount code.
		else if ($this->input->post('remove_discount_code'))
		{
			$this->remove_discount_code();
		}
		// Remove all discount codes.
		else if ($this->input->post('remove_all_discounts'))
		{
			$this->remove_all_discounts();
		}
		// Clear / Empty cart contents.
		else if ($this->input->post('clear'))
		{
			$this->clear_cart();
		}
		// Destroy all cart items and settings and reset to default settings.
		else if ($this->input->post('destroy'))
		{
			$this->destroy_cart();
		}
		// Navigate to checkout page.
		else if ($this->input->post('checkout'))
		{
			// Check if order surpasses the required minimum order value.
			if ($this->flexi_cart->minimum_order_status() && $this->flexi_cart->location_shipping_status(FALSE))
			{
				// Minimum order value has been reached, proceed to the checkout page.
				redirect('standard_library/checkout');
			}

			// Minimum order value has not been reached, set a custom error message notifying the user.			
			if (! $this->flexi_cart->minimum_order_status())
			{
				$this->flexi_cart->set_error_message('The minimum order value of '.$this->flexi_cart->minimum_order().' has not been reached.', TRUE);
			}
			
			// There are no items in the cart that can currently be shipped to the current shipping location, set a custom error message notifying the user.
			if (! $this->flexi_cart->location_shipping_status(FALSE))
			{
				$this->flexi_cart->set_error_message('There are no items in the cart that can currently be shipped to the current shipping location.', TRUE);
			}
				
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart->get_messages(TRUE));
			
			redirect('standard_library/view_cart');
		}

		###+++++++++++++++++++++++++++++++++###
		
		// Get required data on cart items, discounts and surcharges to display in the cart.
		$this->data['cart_items'] = $this->flexi_cart->cart_items(); 
		$this->data['reward_vouchers'] = $this->flexi_cart->reward_voucher_data();
		$this->data['discounts'] = $this->flexi_cart->summary_discount_data();
		$this->data['surcharges'] = $this->flexi_cart->surcharge_data();

		###+++++++++++++++++++++++++++++++++###

		// This example shows how to lookup countries, states and post codes that can be used to calculate shipping rates.
		$sql_select = array($this->flexi_cart->db_column('locations', 'id'), $this->flexi_cart->db_column('locations', 'name')); 	
		$this->data['countries'] = $this->flexi_cart->get_shipping_location_array($sql_select, 0);
		$this->data['states'] = $this->flexi_cart->get_shipping_location_array($sql_select, 1);
		$this->data['postal_codes'] = $this->flexi_cart->get_shipping_location_array($sql_select, 2);
		$this->data['shipping_options'] = $this->flexi_cart->get_shipping_options(); 
		
		// Uncomment the lines below to use the manual shipping example. Read more below.
		# $this->load->model('demo_cart_model');
		# $this->data['shipping_options'] = $this->demo_cart_model->demo_manual_shipping_options(); 
		
		/**
		 * By default, this demo is setup to show how to implement shipping rates with a database.
		 * In the 2 steps below is an example showing how to manually set and define shipping options and rates.
		 *
		 * To use this example follow these steps:
		 * #1: Replace the four "$this->data" arrays set above with "$this->data['shipping_options'] = $this->demo_cart_model->demo_manual_shipping_options();".
		 * #2: Set "$config['database']['shipping_options']['table']" and "$config['database']['shipping_rates']['table']" to FALSE via the config file.
		*/
		
		###+++++++++++++++++++++++++++++++++###
		
		// Get any status message that may have been set.
		$this->data['message'] = $this->session->flashdata('message');	

		$this->load->view('demo/cart_view', $this->data);
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART CONTROLS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * update_cart
	 * Gets the carts item and shipping data from form inputs, and updates the cart.
	 * The view cart page uses AJAX to seamlessly update values in the cart without reloading the page.
	 * This function is accessed from the 'View Cart' page via a form input field named 'update'.
	 */ 
	function update_cart()
	{
		// Load custom demo function to retrieve data from the submitted POST data and update the cart.
		$this->load->model('demo_cart_model');
		$this->demo_cart_model->demo_update_cart();
		
		// If the cart update was posted by an ajax request, do not perform a redirect.
		if (! $this->input->is_ajax_request())
		{
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart->get_messages(TRUE));
					
			redirect('standard_library/view_cart');
		}
	}

	/**
	 * delete_item
	 * Deletes and item from the cart using the '$row_id' supplied via the url link.
	 * This function is accessed from the 'View Cart' page via an items 'Remove' link.
	 */ 
	function delete_item($row_id = FALSE) 
	{
		// The 'delete_items()' function can accept an array of row_ids to delete more than one row at a time.
		// However, this example only uses the 1 row_id that was supplied via the url link.
		$this->flexi_cart->delete_items($row_id);
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages(TRUE));

		redirect('standard_library/view_cart');		
	}
	
	/**
	 * clear_cart
	 * Clears (Empties) all item, discount and surcharge data from the cart.
	 * This function is accessed from the 'View Cart' page via a form input field named 'clear'.
	 */ 
	function clear_cart()
	{
		// The 'empty_cart()' function allows an argument to be submitted that will also reset all shipping data if 'TRUE'.
		$this->flexi_cart->empty_cart(TRUE);

		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages(TRUE));

		redirect('standard_library/view_cart');
	}
	
	/**
	 * destroy_cart
	 * Destroys all cart items and settings and resets cart to its default settings.
	 * This function is accessed from the 'View Cart' page via a form input field named 'destroy'.
	 */ 
	function destroy_cart()
	{
		$this->flexi_cart->destroy_cart();

		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());
		
		redirect('standard_library/view_cart');
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// INSERT ITEMS TO CART
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * insert_link_item_to_cart
	 * Inserts an item to the cart from the 'Add items to cart via a link' page.
	 * The settings for each item are defined via the custom demo function 'demo_insert_link_item_to_cart()'.
	 */ 
	function insert_link_item_to_cart($item_id = 0)
	{
		$this->load->model('demo_cart_model');
		
		$this->demo_cart_model->demo_insert_link_item_to_cart($item_id);

		redirect('standard_library/view_cart');		
	}

	/**
	 * insert_form_item_to_cart
	 * Inserts an item to the cart from the 'Add items to cart via a form' page.
	 * The settings for each item are defined via the custom demo function 'demo_insert_form_item_to_cart()'.
	 */ 
	function insert_form_item_to_cart($item_id = 0)
	{
		$this->load->model('demo_cart_model');
		
		$this->demo_cart_model->demo_insert_form_item_to_cart($item_id);

		redirect('standard_library/view_cart');		
	}

	/**
	 * insert_discount_item_to_cart
	 * Inserts an item to the cart from the 'Add discount items to cart' page.
	 * The settings for each item are defined via the custom demo function 'demo_insert_discount_item_to_cart()'.
	 */ 
	function insert_discount_item_to_cart($item_id = 0) 
	{
		$this->load->model('demo_cart_model');
		
		$this->demo_cart_model->demo_insert_discount_item_to_cart($item_id);
		
		redirect('standard_library/view_cart');		
	}
	
	/**
	 * insert_database_item_to_cart
	 * Inserts an item to the cart from the 'Add database items to cart' page.
	 * The settings for each item are defined via the custom demo function 'demo_insert_database_item_to_cart()'.
	 */ 
	function insert_database_item_to_cart($item_id = 0)
	{
		$this->load->model('demo_cart_model');
		
		$this->demo_cart_model->demo_insert_database_item_to_cart($item_id);
		
		redirect('standard_library/view_cart');		
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNTS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * update_discount_codes
	 * Updates all discount codes that have been submitted to the cart.
	 * This function is accessed from the 'View Cart' page via a form input field named 'update_discount'.
	 */ 
	function update_discount_codes()
	{
		// Get the discount codes from the submitted POST data.
		$discount_data = $this->input->post('discount');
		
		// The 'update_discount_codes()' function will validate each submitted code and apply the discounts that have activated their quantity and value requirements.
		// Any previously set codes that have now been set as blank (i.e. no longer present) will be removed.
		// Note: Only 1 discount can be applied per item and per summary column. 
		// For example, 2 discounts cannot be applied to the summary total, but 1 discount could be applied to the shipping total, and another to the summary total.
		$this->flexi_cart->update_discount_codes($discount_data);
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages(TRUE));

		redirect('standard_library/view_cart');
	}

	/**
	 * set_discount
	 * Set a manually defined discount to the cart, rather than using the discount database table.
	 * This function is accessed from the 'Discounts / Surcharges' page.
	 * The settings for each discount are defined via the custom demo function 'demo_set_discount()'.
	 */ 
	function set_discount($discount_id = FALSE)
	{
		$this->load->model('demo_cart_model');
		
		$this->demo_cart_model->demo_set_discount($discount_id);
		
		redirect('standard_library/view_cart');
	}
	
	/**
	 * remove_discount_code
	 * Removes a specific discount code from the cart.
	 * This function is accessed from the 'View Cart' page via a form input field named 'remove_discount_code'.
	 */ 
	function remove_discount_code()
	{
		// This examples gets the discount code from the array key of the submitted POST data.
		$discount_code = key($this->input->post('remove_discount_code'));

		// The 'unset_discount()' function can accept an array of either discount ids or codes to delete more than one discount at a time.
		// Alternatively, if no data is submitted, the function will delete all discounts that are applied to the cart.
		// This example uses the 1 discount code that was supplied via the POST data.
		$this->flexi_cart->unset_discount($discount_code);
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages(TRUE));

		redirect('standard_library/view_cart');
	}
	
	/**
	 * remove_all_discounts
	 * Removes all discounts from the cart, including discount codes, manually applied discounts and reward vouchers.
	 * This function is accessed from the 'View Cart' page via a form input field named 'remove_all_discounts'.
	 */ 
	function remove_all_discounts()
	{
		// The 'unset_discount()' function can accept an array of either discount ids or codes to delete more than one discount at a time.
		// Alternatively, if no data is submitted, the function will delete all discounts that are applied to the cart.
		// This example removes all discount data.
		$this->flexi_cart->unset_discount();		
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages(TRUE));

		redirect('standard_library/view_cart');
	}

	/**
	 * unset_discount
	 * Removes a specific active item or summary discount from the cart.
	 * This function is accessed from the 'View Cart' page via a 'Remove' link located in the description of an active discount.
	 */ 
	function unset_discount($discount_id = FALSE)
	{
		// The 'unset_discount()' function can accept an array of either discount ids or codes to delete more than one discount at a time.
		// Alternatively, if no data is submitted, the function will delete all discounts that are applied to the cart.
		// This example uses the 1 discount id that was supplied via the url link.
		$this->flexi_cart->unset_discount($discount_id);

		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages(TRUE));
		
		redirect('standard_library/view_cart');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SURCHARGES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * set_surcharge
	 * Set a manually defined surcharge to the cart.
	 * This function is accessed from the 'Discounts / Surcharges' page.
	 * The settings for each surcharge are defined via the custom demo function 'demo_set_surcharge()'.
	 */ 
	function set_surcharge($surcharge_id = FALSE)
	{
		$this->load->model('demo_cart_model');
		
		$this->demo_cart_model->demo_set_surcharge($surcharge_id);
		
		redirect('standard_library/view_cart');
	}

	/**
	 * unset_surcharge
	 * Removes a specific surcharge from the cart.
	 * This function is accessed from the 'View Cart' page via a 'Remove' link located in the description of a surcharge.
	 */ 
	function unset_surcharge($surcharge_id = FALSE)
	{
		// The 'unset_surcharge()' function can accept an array of surcharge ids to delete more than one surcharge at a time.
		// Alternatively, if no data is submitted, the function will delete all surcharges that are applied to the cart.
		// This example uses the 1 surcharge id that was supplied via the url link.
		$this->flexi_cart->unset_surcharge($surcharge_id);
		
		redirect('standard_library/view_cart');
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART CHECKOUT
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * checkout
	 * The example 'Checkout' page collects the users billing, shipping and contact details, before the user confirms their order.
	 * Note: As this is only a demo, the checkout page does not connect to a online payment gateway to process the order transaction.
	 * Therefore, when the user data is submitted, it transfers directly to the 'Checkout Complete' page.
	 */ 
	function checkout() 
	{
		$this->load->model('demo_cart_model');

		// Check whether the cart is empty using the 'cart_status()' function and redirect the user away if necessary.
		if (! $this->flexi_cart->cart_status())
		{
			$this->flexi_cart->set_error_message('You must add an item to the cart before you can checkout.', TRUE);

			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart->get_messages(TRUE));
			
			redirect('standard_library/view_cart');
		}
		
		// Check whether the user has submitted their details and that the information is valid.
		// The custom demo function 'demo_save_order()' validates the data using CI's validation library and then saves the cart to the database using the 'save_order()' function.
		// If the data is saved successfully, the user is redirected to the 'Checkout Complete' page.
		if ($this->input->post('checkout'))
		{
			$response = $this->demo_cart_model->demo_save_order();
			
			// Set a message to the CI flashdata so that it is available after the page redirect.
			$this->session->set_flashdata('message', $this->flexi_cart->get_messages());
			
			// Check that the order saved correctly.
			if ($response)
			{
				// Attach the saved order number to the redirect url.
				redirect('standard_library/checkout_complete/'.$this->flexi_cart->order_number());	
			}
		}

		// Get all countries to list via a select menu as countries the user can be 'Billed to'.
		// In this example, the 'Shipped to' country is fixed by the shipping location and option they selected via the 'View Cart' page.
		$sql_select = array($this->flexi_cart->db_column('locations', 'id'), $this->flexi_cart->db_column('locations', 'name'));		
		$this->data['countries'] = $this->flexi_cart->get_shipping_location_array($sql_select, 0); 

		// Get any status message that may have been set.
		$this->data['message'] = (!isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];

		$this->load->view('demo/checkout_view', $this->data);
	}
	
	/**
	 * checkout_complete
	 * The example 'Checkout Complete' page displays a confirmation of the users order, displaying their order number.
	 * On a real world site, this page is typically accessed after the user has entered their payment details via a online payment gateway.
	 */ 
	function checkout_complete($order_number = FALSE) 
	{
		// Note: This example uses the 'get_db_order_summary_row_array()' and 'update_db_order_summary()' function which are located in the flexi cart ADMIN library.
		$this->load->library('flexi_cart_admin');

		// Get the confrimed order number to display to the user.
		$this->data['order_number'] = $order_number;

		// Get the users email address that was just saved with the order data.
		$sql_where = array($this->flexi_cart_admin->db_column('order_summary', 'order_number') => $this->data['order_number']);
		if ($order_data = $this->flexi_cart_admin->get_db_order_summary_row_array('ord_demo_email', $sql_where))
		{
			$this->data['user_email'] = $order_data['ord_demo_email'];		
			
			// In many real world cases, the cart data may need to be later updated once saved - for example to save the response from an online payment gateway.
			// With such an example, the 'update_order_summary()' admin library function can be used.			
			# $this->flexi_cart_admin->update_db_order_summary(array('update_column' => 'update_value'), $this->data['order_number']);
		
			// A real world site would typically now send the user an order acknowledgement email.
			# $this->flexi_cart_admin->email_order($this->data['order_number'], array('example@company_name.com', $this->data['user_email']), 'Email Subject Title');
		}
		
		// Destroy the cart.
		// Note: once checkout is complete, it is better to use the 'destroy_cart()' function rather than 'empty_cart()' to ensure all session data from the
		// now completed order is removed, rather than just removing the items in the cart.
		$this->flexi_cart->destroy_cart();
		
		$this->load->view('demo/checkout_complete_view', $this->data);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	// SAVE / LOAD CART DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * load_save_cart_data
	 * Either load or save the carts session data from/to the the database.
	 * This function is accessed from the 'Save / Load Cart Data' page.
	 */ 
	function load_save_cart_data() 
	{
		// The load/save/delete cart data functions require the flexi cart ADMIN library.
		$this->load->library('flexi_cart_admin');
		
		// Create an SQL WHERE clause to list all previously saved cart data for a specific user.
		// For this example, the user id will be set as 1. In a real world application, this would be the logged-in users id.
		// This examples also prevents cart session data from confirmed orders being loaded, by checking the readonly status is set at '0'.
		$sql_where = array(
			$this->flexi_cart->db_column('db_cart_data', 'user') => 1,
			$this->flexi_cart->db_column('db_cart_data', 'readonly_status') => 0
		);

		// Get a list of all saved carts that match the SQL WHERE statement.
		$this->data['saved_cart_data'] = $this->flexi_cart_admin->get_db_cart_data_array(FALSE, $sql_where);

		// Get any status message that may have been set.
		$this->data['message'] = $this->session->flashdata('message');
		
		$this->load->view('demo/feature_examples/features_save_load_cart_view', $this->data);
	}

	/**
	 * save_cart_data
	 * Saves the users current cart to the database so that it can be reloaded at a later date.
	 * This function is accessed from either the 'View Cart' or the 'Save / Load Cart Data' page.
	 */ 
	function save_cart_data() 
	{
		// The load/save/delete cart data functions require the flexi cart ADMIN library.
		$this->load->library('flexi_cart_admin');

		// For this example, the user id will be set as 1. 
		// In a real world application, this would be the logged-in users id.
		$user_id = 1;
	
		// Save the cart data to the database.
		$this->flexi_cart_admin->save_cart_data($user_id);

		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());
		
		redirect('standard_library/view_cart');
	}

	/**
	 * load_cart_data
	 * Loads saved cart data into the users current cart, overwriting any existing cart data in their current session.
	 * A custom function 'demo_update_loaded_cart_data()' has been included to ensure that all loaded item data is up-to-date with the current item database table. 
	 * This function is accessed from the 'Save / Load Cart Data' page.
	 */ 
	function load_cart_data($cart_data_id = 0) 
	{
		// The load/save/delete cart data functions require the flexi cart ADMIN library.
		$this->load->library('flexi_cart_admin');
		$this->load->model('demo_cart_model');

		// Load saved cart data array.
		// This data is loaded into the browser session as if you were shopping with the cart as normal.
		$this->flexi_cart_admin->load_cart_data($cart_data_id);
		
		// To ensure that the prices and other data of all loaded items are still correct, a custom demo function has been made to loop through each item in the cart, 
		// query the demo item database table and retrieve the current item data.
		// As flexi cart does not manage item tables, this function has to be custom made to suit each sites requirements, this is an example of how it can be achieved.
		// Note that cart items including selectable options would potentially require a more complex query.	
		$this->demo_cart_model->demo_update_loaded_cart_data();
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());

		redirect('standard_library/view_cart');
	}

	/**
	 * delete_cart_data
	 * Deletes specific saved cart data from the database.
	 * This function is accessed from the 'Save / Load Cart Data' page.
	 */ 
	function delete_cart_data($cart_data_id = 0) 
	{
		// The load/save/delete cart data functions require the flexi cart ADMIN library.
		$this->load->library('flexi_cart_admin');

		// Delete the saved cart data from the database.
		$this->flexi_cart_admin->delete_db_cart_data($cart_data_id);
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());

		redirect('standard_library/load_save_cart_data');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// NAVIGATION MENU FUNCTIONS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * currency
	 * Set which currency to display cart pricing in.
	 * This function is accessed from the navigation menu 'Feature Examples'.
	 */ 
	function currency($currency_identifier)
	{
		// Update cart currency using url parameter.
		$this->flexi_cart->update_currency($currency_identifier);
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());

		redirect('standard_library/view_cart');
	}

	/**
	 * pricing_tax
	 * Set whether to display cart pricing including or excluding tax.
	 * This function is accessed from the navigation menu 'Feature Examples'.
	 */ 
	function pricing_tax($tax_status)
	{
		// Check whether tax is to be included or excluded from pricing.
		$tax_status = ($tax_status == 'inc');
		
		// Update tax pricing status.
		$this->flexi_cart->set_prices_inc_tax($tax_status);
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());

		redirect('standard_library/view_cart');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SET MISC CART SETTINGS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * misc_features
	 * A list of miscellaneous features that are also available in flexi cart.
	 * The features include setting a minimum order value, changing tax location, changing cart statuses and converting weights and currencies.
	 * This page is accessed from the 'Miscellaneous' page listed in the navigation menu 'Feature Examples'.
	 */ 
	function misc_features() 
	{
		$this->load->model('demo_cart_model');

		// Check if the 'Change Tax Rate' form input has been submitted.
		if ($this->input->post('tax_location'))
		{
			$this->demo_cart_model->demo_update_tax();
		}
		
		// Set country location data for use with tax location demo.
		$sql_select = array($this->flexi_cart->db_column('locations', 'id'), $this->flexi_cart->db_column('locations', 'name'));		
		$this->data['countries'] = $this->flexi_cart->get_shipping_location_array($sql_select, 0); 
		
		// Get any status message that may have been set.
		$this->data['message'] = $this->session->flashdata('message');	
	
		$this->load->view('demo/feature_examples/features_misc_view', $this->data);
	}

	/**
	 * minimum_order
	 * Sets the minimum order value required to checkout.
	 * This function is accessed from the 'Miscellaneous' page.
	 */ 
	function minimum_order($value)
	{
		// Set the minimum order value.
		$this->flexi_cart->set_minimum_order($value);
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());

		redirect('standard_library/misc_features');
	}

	/**
	 * user_status
	 * Toggles a custom status that in this demo represents whether a user has logged in.
	 * Discounts can be set to only be applied if a custom status is active, i.e. only logged in users.
	 * This function is accessed from the 'Miscellaneous' page.
	 */ 
	function user_status($status)
	{
		// Check whether the user is logging in or out. 
		$status = ($status == 'login');
	
		// Update the carts custom status.
		$this->flexi_cart->set_custom_status_1($status);
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_cart->get_messages());
		
		redirect('standard_library/misc_features');		
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MINI CART DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * mini_cart_data
	 * This function is called by the '__construct()' to set item data to be displayed on the 'Mini Cart' menu.
	 */ 
	private function mini_cart_data()
	{
		$this->data['mini_cart_items'] = $this->flexi_cart->cart_items();
	}
}

/* End of standard_library.php */
/* Location: ./application/controllers/standard_library.php */