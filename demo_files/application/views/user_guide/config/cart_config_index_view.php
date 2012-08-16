<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Cart Config Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of cart config functions in flexi cart."/> 
	<meta name="keywords" content="cart config functions, user guide, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="user_guide_index">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- User Guide Navigation -->
	<?php $this->load->view('includes/user_guide_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>User Guide | Cart Configuration</h1>
				<p>flexi cart is highly configurable in many ways, allowing for the customisation of database tables, the carts structure and the functionality of features within the cart.</p>
				<p>Below is a compiled list of functions related to the carts config settings.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Cart Config User Guide Index</h2>				
			<a href="<?php echo $base_url; ?>user_guide/cart_config_columns">Cart Column Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_internal">Cart Functionality Settings Config</a> | 
			<a href="<?php echo $base_url; ?>user_guide/cart_config_internal">Cart Internal Settings Config</a><br/>
			<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data">Get Cart Config Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data">Set Cart Config Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_admin">Cart Config Admin Data</a>
			
			<div class="w100 frame">
				<h3>Cart Configuration</h3>
				<p>Customise the configuration of the carts default settings and configuration database table via the config file.</p>
				<p>Config. File Settings : 
					<a href="<?php echo $base_url; ?>user_guide/cart_config_columns">Cart Columns</a> | 
					<a href="<?php echo $base_url; ?>user_guide/cart_config_settings">Cart Session Settings</a> | 
					<a href="<?php echo $base_url; ?>user_guide/cart_config_internal">Cart Internal Settings</a>
				</p>
			</div>
							
			<div class="w33 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the carts session.</small>
				<hr/>
				
				<h6>Cart Session Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#cart_data_id">cart_data_id()</a><br/>
						<small>Returns the id of the current cart data array.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#order_number">order_number()</a><br/>
						<small>Returns the current order number.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#minimum_order">minimum_order()</a><br/>
						<small>Returns the minimum order value required for cart to checkout.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#minimum_order_status">minimum_order_status()</a><br/>
						<small>Returns whether a specific summary column value has surpassed the minimum required value to checkout.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#display_prices_inc_tax">display_prices_inc_tax()</a><br/>
						<small>Returns whether the user is currently viewing prices including tax.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#cart_prices_inc_tax">cart_prices_inc_tax()</a><br/>
						<small>Returns whether the carts internal prices include tax.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#reward_point_multiplier">reward_point_multiplier()</a><br/>
						<small>Returns the multiplier value used to calculate the reward points earnt from an items price.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#custom_status_1">custom_status_1()</a><br/>
						<small>Returns the value of custom status #1.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#custom_status_2">custom_status_2()</a><br/>
						<small>Returns the value of custom status #2.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#custom_status_3">custom_status_3()</a><br/>
						<small>Returns the value of custom status #3.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Setting Data</h3>
				<small>Set data to the carts session data.</small>
				<hr/>
				
				<h6>Cart Session Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_order_number">set_order_number()</a><br/>
						<small>Set an order number.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_minimum_order">set_minimum_order()</a><br/>
						<small>Set the minimum order value.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_prices_inc_tax">set_prices_inc_tax()</a><br/>
						<small>Set whether displayed prices included tax.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_allocate_stock_status">set_allocate_stock_status()</a><br/>
						<small>Set whether stock should be auto allocated by the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_stock_limit_quantity_status">set_stock_limit_quantity_status()</a><br/>
						<small>Set whether cart item quantities should be limited by stock.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_remove_no_stock_status">set_remove_no_stock_status()</a><br/>
						<small>Set whether to auto remove items from the cart that are out of stock.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_item_shipping_ban_status">set_item_shipping_ban_status()</a><br/>
						<small>Set whether banned shipping items, should be saved when an order is placed.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_reward_point_multiplier">set_reward_point_multiplier()</a><br/>
						<small>Set the reward point to item price multiplier.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_custom_status_1">set_custom_status_1()</a><br/>
						<small>Set the value of custom status #1.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_custom_status_2">set_custom_status_2()</a><br/>
						<small>Set the value of custom status #2.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_custom_status_3">set_custom_status_3()</a><br/>
						<small>Set the value of custom status #3.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 r_margin frame parallel_target">
				<h3>Admin Data</h3>
				<small>Run database management functions.</small>
				<hr/>
				
				<h6>Cart Config. Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_admin#get_db_config">get_db_config()</a><br/>
						<small>SQL SELECT query on configuration table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_admin#update_db_config">update_db_config()</a><br/>
						<small>SQL UPDATE statement on configuration table.</small>
					</li>
				</ul>
				<hr/>
			</div>

		</div>
	</div>	
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>