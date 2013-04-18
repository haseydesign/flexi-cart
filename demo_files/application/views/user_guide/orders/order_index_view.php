<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Order Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of order functions in flexi cart."/> 
	<meta name="keywords" content="order functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Orders</h1>
				<p>When saving a customers cart data as an order, there can be a lot of data that needs to be saved.</p>
				<p>The flexi cart save functions simplify this process by automating the cart data that is saved to the order database table, by using configurable settings via the config file.</p>
				<p>Below is a compiled list of functions related to the carts order data.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Order User Guide Index</h2>				
			<a href="<?php echo $base_url; ?>user_guide/order_config">Order Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_helper_data">Get Order Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_set_data">Set Order Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_admin">Order Admin Data</a>
			
			<div class="w100 frame">
				<h3>Order Configuration</h3>
				<p>Customise the configuration of the order database tables via the config file.</p>
				<p><a href="<?php echo $base_url; ?>user_guide/order_config">Order Config. File Settings</a></p>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the carts session or database.</small>
				<hr/>
				
				<h6>Cart Session Data</h6>
				<ul>
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
				</ul>
				<hr/>
				
				<h6>Database / Helper Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_helper_data#generate_order_number">generate_order_number()</a><br/>
						<small>Generates a new order number.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_helper_data#check_order_number_available">check_order_number_available()</a><br/>
						<small>Returns whether a specific order number is unique (Has not been used before).</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_helper_data#email_order">email_order()</a><br/>
						<small>Emails the data from a saved order to a defined recipient.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Setting Data</h3>
				<small>Set data to the carts session or database.</small>
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
				</ul>
				<hr/>
					
				<h6>Order Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_set_data#save_order">save_order()</a><br/>
						<small>Saves cart data and manually submitted data to the order tables.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_set_data#resave_order">resave_order()</a><br/>
						<small>Re-saves cart data and manually submitted data from a reloaded order, to the order tables.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 r_margin frame parallel_target">
				<h3>Admin Data</h3>
				<small>Run database management functions.</small>
				<hr/>
				
				<h6>Order Management Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#get_refund_itemised">get_refund_itemised()</a><br/>
						<small>Returns an itemised query of refund totals for all items that have been cancelled within an order.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#get_refund_summary">get_refund_summary()</a><br/>
						<small>Returns a summary of refund totals for all items that have been cancelled within an order.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Order Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#search_orders">search_orders()</a><br/>
						<small>SQL SELECT query via a keyword search on order summary table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#get_db_order">get_db_order()</a><br/>
						<small>SQL SELECT query on order tables.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#get_db_order_summary">get_db_order_summary()</a><br/>
						<small>SQL SELECT query on order summary table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#get_db_order_detail">get_db_order_detail()</a><br/>
						<small>SQL SELECT query on order detail table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#update_db_order_summary">update_db_order_summary()</a><br/>
						<small>SQL UPDATE statement on order summary table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#update_db_order_details">update_db_order_details()</a><br/>
						<small>SQL UPDATE statement on order details table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#delete_db_order">delete_db_order()</a><br/>
						<small>SQL DELETE statement on order tables.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Order Status CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#get_db_order_status">get_db_order_status()</a><br/>
						<small>SQL SELECT query on order status table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#insert_db_order_status">insert_db_order_status()</a><br/>
						<small>SQL INSERT statement on order status table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#update_db_order_status">update_db_order_status()</a><br/>
						<small>SQL UPDATE statement on order status table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_admin#delete_db_order_status">delete_db_order_status()</a><br/>
						<small>SQL DELETE statement on order status table.</small>
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