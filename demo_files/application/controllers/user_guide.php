<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_guide extends CI_Controller {
	
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
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	function index() 
	{
		$this->load->view('user_guide_view');
	}

	function conception()
	{
		$this->load->view('user_guide/misc/conception_view');
	}

	function library_info() 
	{
		$this->load->view('user_guide/misc/libraries_view');
	}

	function installation()
	{
		$this->load->view('user_guide/misc/installation_view');
	}
	
	function change_log()
	{
		$this->load->view('user_guide/misc/change_log_view');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART CONFIG USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function cart_config_index()
	{
		$this->load->view('user_guide/config/cart_config_index_view');
	}	
	
	function cart_config_settings()
	{
		$this->load->view('user_guide/config/cart_config_settings_view');
	}	
	
	function cart_config_columns() 
	{
		$this->load->view('user_guide/config/cart_config_columns_view');
	}
	
	function cart_config_internal() 
	{
		$this->load->view('user_guide/config/cart_config_internal_view');
	}
	
	function cart_config_session_data()
	{
		$this->load->view('user_guide/config/cart_config_session_data_view');
	}	
	
	function cart_config_set_data()
	{
		$this->load->view('user_guide/config/cart_config_set_data_view');
	}	
	
	function cart_config_admin()
	{
		$this->load->view('user_guide/config/cart_config_admin_view');
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CART CONFIG USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function cart_index()
	{
		$this->load->view('user_guide/cart_data/cart_index_view');
	}	
	
	function cart_session_data()
	{
		$this->load->view('user_guide/cart_data/cart_session_data_view');
	}	
	
	function cart_item_session_data()
	{
		// Get cart row example.
		$this->update_cart_row();
	
		$this->load->view('user_guide/cart_data/cart_item_session_data_view', $this->data);
	}	
	
	function cart_summary_session_data()
	{
		$this->load->view('user_guide/cart_data/cart_summary_session_data_view');
	}	

	function cart_helper_data()
	{
		$this->load->view('user_guide/cart_data/cart_helper_data_view');
	}	

	function cart_set_data()
	{
		$this->load->view('user_guide/cart_data/cart_set_data_view');
	}	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOCATIONS USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	function location_index()
	{
		$this->load->view('user_guide/locations/location_index_view');
	}	
				
	function location_config()
	{
		$this->load->view('user_guide/locations/location_config_view');
	}	
	
	function location_session_data()
	{
		$this->load->view('user_guide/locations/location_session_data_view');
	}	
				
	function location_helper_data()
	{
		$this->load->view('user_guide/locations/location_helper_data_view');
	}
	
	function location_set_data()
	{
		$this->load->view('user_guide/locations/location_set_data_view');
	}
				
	function location_admin()
	{
		$this->load->view('user_guide/locations/location_admin_view');
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SHIPPING USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
				
	function shipping_index()
	{
		$this->load->view('user_guide/shipping/shipping_index_view');
	}	
				
	function shipping_config()
	{
		$this->load->view('user_guide/shipping/shipping_config_view');
	}	
	
	function shipping_session_data()
	{
		$this->load->view('user_guide/shipping/shipping_session_data_view');
	}	
				
	function shipping_helper_data()
	{
		$this->load->view('user_guide/shipping/shipping_helper_data_view');
	}
	
	function shipping_set_data()
	{
		$this->load->view('user_guide/shipping/shipping_set_data_view');
	}
				
	function shipping_admin()
	{
		$this->load->view('user_guide/shipping/shipping_admin_view');
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM SHIPPING USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	function item_shipping_index()
	{
		$this->load->view('user_guide/item_shipping/item_shipping_index_view');
	}	
				
	function item_shipping_config()
	{
		$this->load->view('user_guide/item_shipping/item_shipping_config_view');
	}	
				
	function item_shipping_helper_data()
	{
		// Get cart row example.
		$this->update_cart_row();
		
		$this->load->view('user_guide/item_shipping/item_shipping_helper_data_view', $this->data);
	}
	
	function item_shipping_set_data()
	{
		$this->load->view('user_guide/item_shipping/item_shipping_set_data_view');
	}	
				
	function item_shipping_admin()
	{
		$this->load->view('user_guide/item_shipping/item_shipping_admin_view');
	}	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TAX USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function tax_index()
	{
		$this->load->view('user_guide/tax/tax_index_view');
	}	
				
	function tax_config()
	{
		$this->load->view('user_guide/tax/tax_config_view');
	}	
	
	function tax_session_data()
	{
		$this->load->view('user_guide/tax/tax_session_data_view');
	}	
				
	function tax_helper_data()
	{		
		$this->load->view('user_guide/tax/tax_helper_data_view');
	}
				
	function tax_set_data()
	{
		$this->load->view('user_guide/tax/tax_set_data_view');
	}
				
	function tax_admin()
	{
		$this->load->view('user_guide/tax/tax_admin_view');
	}	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM TAX USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function item_tax_index()
	{
		$this->load->view('user_guide/item_tax/item_tax_index_view');
	}	
	
	function item_tax_config()
	{
		$this->load->view('user_guide/item_tax/item_tax_config_view');
	}	
	
	function item_tax_helper_data()
	{
		// Get cart row example.
		$this->update_cart_row();
		
		$this->load->view('user_guide/item_tax/item_tax_helper_data_view', $this->data);
	}
	
	function item_tax_admin()
	{
		$this->load->view('user_guide/item_tax/item_tax_admin_view');
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CURRENCY USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	function currency_index()
	{
		$this->load->view('user_guide/currency/currency_index_view');
	}	
				
	function currency_config()
	{
		$this->load->view('user_guide/currency/currency_config_view');
	}	
	
	function currency_session_data()
	{
		$this->load->view('user_guide/currency/currency_session_data_view');
	}	
				
	function currency_helper_data()
	{
		$this->load->view('user_guide/currency/currency_helper_data_view');
	}
	
	function currency_set_data()
	{
		$this->load->view('user_guide/currency/currency_set_data_view');
	}
				
	function currency_admin()
	{
		$this->load->view('user_guide/currency/currency_admin_view');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ITEM STOCK USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	function item_stock_index()
	{
		$this->load->view('user_guide/item_stock/item_stock_index_view');
	}	
	
	function item_stock_config()
	{
		$this->load->view('user_guide/item_stock/item_stock_config_view');
	}	
	
	function item_stock_helper_data()
	{
		// Get cart row example.
		$this->update_cart_row();
		
		$this->load->view('user_guide/item_stock/item_stock_helper_data_view', $this->data);
	}
	
	function item_stock_admin()
	{
		$this->load->view('user_guide/item_stock/item_stock_admin_view');
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DISCOUNTS USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function discount_index()
	{
		$this->load->view('user_guide/discounts/discount_index_view');
	}	
				
	function discount_config()
	{
		$this->load->view('user_guide/discounts/discount_config_view');
	}	
	
	function discount_session_data()
	{
		$this->load->view('user_guide/discounts/discount_session_data_view');
	}	
				
	function discount_helper_data()
	{
		$this->load->view('user_guide/discounts/discount_helper_data_view');
	}
	
	function discount_set_data()
	{
		$this->load->view('user_guide/discounts/discount_set_data_view');
	}
				
	function discount_admin()
	{
		$this->load->view('user_guide/discounts/discount_admin_view');
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// REWARD POINTS / VOUCHERS USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function reward_index()
	{
		$this->load->view('user_guide/reward_points_vouchers/reward_index_view');
	}	
				
	function reward_config()
	{
		$this->load->view('user_guide/reward_points_vouchers/reward_config_view');
	}	
	
	function reward_session_data()
	{
		$this->load->view('user_guide/reward_points_vouchers/reward_session_data_view');
	}	
				
	function reward_helper_data()
	{
		$this->load->view('user_guide/reward_points_vouchers/reward_helper_data_view');
	}
	
	function reward_set_data()
	{
		$this->load->view('user_guide/reward_points_vouchers/reward_set_data_view');
	}
				
	function reward_admin()
	{
		$this->load->view('user_guide/reward_points_vouchers/reward_admin_view');
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// SURCHARGE USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function surcharge_index()
	{
		$this->load->view('user_guide/surcharges/surcharge_index_view');
	}	
		
	function surcharge_session_data()
	{
		$this->load->view('user_guide/surcharges/surcharge_session_data_view');
	}
	
	function surcharge_set_data()
	{
		$this->load->view('user_guide/surcharges/surcharge_set_data_view');
	}
		
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// ORDER USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function order_index()
	{
		$this->load->view('user_guide/orders/order_index_view');
	}	

	function order_config()
	{
		$this->load->view('user_guide/orders/order_config_view');
	}	
		
	function order_helper_data()
	{
		$this->load->view('user_guide/orders/order_helper_data_view');
	}	
		
	function order_set_data()
	{
		$this->load->view('user_guide/orders/order_set_data_view');
	}	
	
	function order_admin()
	{
		$this->load->view('user_guide/orders/order_admin_view');
	}	
			
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// DATABASE CART DATA USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	function database_cart_data_index()
	{
		$this->load->view('user_guide/db_cart_data/db_cart_data_index_view');
	}	

	function database_cart_data_config()
	{
		$this->load->view('user_guide/db_cart_data/db_cart_data_config_view');
	}	

	function database_cart_data_admin()
	{
		$this->load->view('user_guide/db_cart_data/db_cart_data_admin_view');
	}	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CUSTOM SQL USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function custom_sql_index()
	{
		$this->load->view('user_guide/misc/custom_sql_index_view');
	}	

	function query_sql_results() 
	{
		$this->load->view('user_guide/misc/query_sql_results_view');
	}

	function defining_custom_sql() 
	{
		$this->load->view('user_guide/misc/defining_custom_sql_view');
	}
	
	function custom_sql_query_builder()
	{
		$this->load->view('user_guide/misc/custom_sql_query_builder_view');
	}	

	function custom_sql_admin()
	{
		$this->load->view('user_guide/misc/custom_sql_admin_view');
	}	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LIBRARY USER GUIDE
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
			
	function lite_library() 
	{
		// Get cart row example.
		$this->update_cart_row();
		
		// Set status message
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
		
		$this->load->view('user_guide/functions_lite_view', $this->data);
	}
		
	function standard_library() 
	{
		$this->load->view('user_guide/functions_standard_view');
	}
		
	function admin_library() 
	{
		$this->load->view('user_guide/functions_admin_view');
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// MISC INFO
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	function misc_info() 
	{
		$this->load->view('user_guide/misc/misc_view');
	}

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOAD BASIC CART DATA
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	// Get 'row_id' and 'item_id' of the selected or first item in the cart.
	// This data is used to populate data for user guide function examples using live data from the cart session.
	private function update_cart_row()
	{
		$this->load->library('flexi_cart');

		if ($this->input->post('row_id') && $this->flexi_cart->row_id_exists($this->input->post('row_id')))
		{
			$this->data['row_id'] = $this->input->post('row_id');
			$this->data['item_id'] = $this->flexi_cart->item_id($this->data['row_id']);
			
			// Set data to session to remember selected item through all user guide pages.
			$this->session->set_userdata($this->data);
		}
		// Cart row not selected, therefore get the carts first row.
		else
		{
			// If cart is empty, insert item #101 for user guide examples to function on.
			if (! $this->flexi_cart->cart_status())
			{
				$this->load->model('demo_cart_model');
				$this->demo_cart_model->demo_insert_link_item_to_cart(101);
				
				redirect(current_url());		
			}
			// ELse if row id and item id are not available from session data.
			else 
			{
				$this->data['cart_items'] = $this->flexi_cart->cart_items();

				if ($this->session->userdata('row_id') === FALSE || $this->session->userdata('item_id') === FALSE)
				{
					$this->data['row_id'] = key($this->data['cart_items']);
					$this->data['item_id'] = $this->flexi_cart->item_id($this->data['row_id']);
					
					// Set data to session to remember selected item through all user guide pages.
					$this->session->set_userdata($this->data);
				}
				// Else get row id and item id from session data.
				else
				{
					$this->data['row_id'] = $this->session->userdata('row_id');
					$this->data['item_id'] = $this->session->userdata('item_id');
				}
			}
		}
	}
}
/* End of file user_guide.php */
/* Location: ./application/controllers/user_guide.php */