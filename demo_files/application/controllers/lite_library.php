<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lite_library extends CI_Controller {
	
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

		// Load 'lite' flexi cart library by default.
		// If preferable, functions from this library can be referenced by another name like 'flexi_cart' or 'flexi_cart_admin', as done below.
		// Note: Renaming the library should not be done when loading the 'flexi_cart' or 'flexi_cart_admin' libraries.
		$this->load->library('flexi_cart_lite', FALSE, 'flexi_cart');	
		
		// Note: This is only included to create base urls for purposes of this demo only and are not necessarily considered as 'Best practice'.
		$this->load->vars('base_url', 'http://localhost/flexi_cart/');
		$this->load->vars('includes_dir', 'http://localhost/flexi_cart/includes/');
		$this->load->vars('current_url', $this->uri->uri_to_assoc(1));
		
		// Load cart data to be displayed via 'Mini Cart' menu.
		$this->mini_cart_data();
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// FLEXI CART LITE LIBRARY
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * index
	 * Home page of the site.
	 */ 
	function index() 
	{
		$this->load->view('index_view', $this->data);
	}
	 
	/**
	 * features
	 * List of features within flexi cart.
	 */ 
	function features() 
	{
		$this->load->view('features_view', $this->data);
	} 
	 
	/**
	 * demo
	 * Home page of flexi cart demo.
	 */ 
	function demo() 
	{
		$this->load->view('demo_view', $this->data);
	} 
	 
	/**
	 * support
	 * Support contact information.
	 */ 
	function support() 
	{
		$this->load->view('support_view', $this->data);
	} 

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LITE LIBRARY EXAMPLE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * lite_library_example
	 * An example of displaying cart data using only the flexi cart 'lite' library.
	 * The lite library can return formatted data from the carts session data array, whilst using a smaller memory footprint than what the full flexi cart library requires.
	 * The library only includes functions that return data, and does not set any data to the database or cart session (With an exception to status/error messages which can be set).
	 * The smaller requirements on server memory mean cart data can be displayed across all pages of a site without hogging resources (See 'Mini Cart' example in the nav bar).
	 */ 
	function lite_library_example() 
	{
		// Get required data on cart items, discounts and surcharges to display in the cart.
		$this->data['cart_items'] = $this->flexi_cart->cart_items();
		$this->data['reward_vouchers'] = $this->flexi_cart->reward_voucher_data();
		$this->data['discounts'] = $this->flexi_cart->summary_discount_data();
		$this->data['surcharges'] = $this->flexi_cart->surcharge_data();
		
		$this->load->view('demo/lite_library_view', $this->data);
	}
	 
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// INSERT ITEM EXAMPLES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * item_link_examples
	 * A list of examples showing some of the features and options that can be set when adding an item to the cart.
	 * This page is accessed from the 'Add Items to Cart via a Link' page listed in the navigation menu 'Item Examples'.
	 */ 
	function item_link_examples()
	{
		$this->load->view('demo/feature_examples/item_link_examples_view', $this->data);
	}
	 
	/**
	 * item_form_examples
	 * A list of examples showing how to add items to the cart using a form, rather than via a link like the examples above.
	 * This page is accessed from the 'Add Items to Cart via a Form' page listed in the navigation menu 'Item Examples'.
	 */ 
	function item_form_examples()
	{
		$this->load->view('demo/feature_examples/item_form_examples_view', $this->data);
	}
	 
	/**
	 * item_discount_examples
	 * A list of examples showing the types of discounts that can be applied to items within the cart.
	 * This page is accessed from the 'Add Discount Items to Cart' page listed in the navigation menu 'Item Examples'.
	 */ 
	function item_discount_examples()
	{
		$this->load->view('demo/feature_examples/item_discount_examples_view', $this->data);
	}
	 
	/**
	 * item_database_examples
	 * A list of example items that are updated from a database table, rather than being hard coded into a file as with the examples above.
	 * This page is accessed from the 'Add Database Items to Cart' page listed in the navigation menu 'Item Examples'.
	 */ 
	function item_database_examples() 
	{
		$this->load->model('demo_cart_model');
		
		// Load data from a custom demo table containing example item data.
		$this->data['item_data'] = $this->demo_cart_model->demo_get_item_data();
	
		$this->load->view('demo/feature_examples/item_database_examples_view', $this->data);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MISC CART FEATURES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * discount_surcharge_features
	 * A list of discount and surcharge examples that can be manually set, rather than requiring a database.
	 * This page is accessed from the 'Discount / Surcharges' page listed in the navigation menu 'Feature Examples'.
	 */ 
	function discount_surcharge_features() 
	{
		$this->load->view('demo/feature_examples/features_discount_surcharge_view', $this->data);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// AJAX FUNCTION CALLS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * ajax_convert_currency
	 * An example from the 'Miscellaneous Feature' page that uses an AJAX call to convert a currency.
	 * This function is accessed from the 'Miscellaneous' page.
	 */ 
	function ajax_convert_currency() 
	{
		// Get POST data submitted via AJAX.
		$currency_value = $this->input->post('currency_value');
		$convert_to_currency = $this->input->post('convert_to_currency');

		echo $this->flexi_cart->get_taxed_currency_value($currency_value, FALSE, TRUE, 2, FALSE, $convert_to_currency);
		exit;
	}
	
	/**
	 * ajax_convert_weight
	 * An example from the 'Miscellaneous Feature' page that uses an AJAX call to convert a weight.
	 * This function is accessed from the 'Miscellaneous' page.
	 */ 
	function ajax_convert_weight() 
	{
		// Get POST data submitted via AJAX.
		$convert_weight = $this->input->post('convert_weight');
		$convert_weight_from = $this->input->post('convert_weight_from');
		$convert_weight_to = $this->input->post('convert_weight_to');

		echo $this->flexi_cart->convert_weight($convert_weight, $convert_weight_from, $convert_weight_to, TRUE, 2);
		exit;
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
/* End of file lite_library.php */
/* Location: ./application/controllers/lite_library.php */