<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Shipping Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of shipping functions in flexi cart."/> 
	<meta name="keywords" content="shipping functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Shipping</h1>
				<p>Shipping Options can be setup to offer specific shipping options accordingly to a customers location.</p>
				<p>Below is a compiled list of functions related to the carts shipping data.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Shipping User Guide Index</h2>				
			<a href="<?php echo $base_url; ?>user_guide/shipping_config">Shipping Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_session_data">Get Shipping Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_helper_data">Get Shipping Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_set_data">Set Shipping Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_admin">Shipping Admin Data</a>
			
			<div class="w100 frame">
				<h3>Shipping Configuration</h3>
				<p>Customise the configuration of the carts default shipping settings and shipping database tables via the config file.</p>
				<p><a href="<?php echo $base_url; ?>user_guide/shipping_config">Shipping Config. File Settings</a></p>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the carts session or database.</small>
				<hr/>
				
				<h6>Shipping Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_session_data#shipping_id">shipping_id()</a><br/>
						<small>Get id of current shipping option.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_session_data#shipping_name">shipping_name()</a><br/>
						<small>Get name of current shipping option.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_session_data#shipping_description">shipping_description()</a><br/>
						<small>Get description of current shipping option.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Shipping Location Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_session_data#shipping_location_data">shipping_location_data()</a><br/>
						<small>Returns an array of the carts current shipping locations as table ids.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_session_data#match_shipping_location_id">match_shipping_location_id()</a><br/>
						<small>Returns whether a submitted location id is set within the cart shipping location array.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_session_data#shipping_location_id">shipping_location_id()</a><br/>
						<small>Returns the location id of the current shipping location.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_session_data#shipping_location_name">shipping_location_name()</a><br/>
						<small>Returns the location name of the current shipping location.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_session_data#location_shipping_status">location_shipping_status()</a><br/>
						<small>Returns whether items in the cart are permitted to be shipped to the current shipping location.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Shipping Summary Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#shipping_total">shipping_total()</a><br/>
						<small>Return carts shipping value.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#item_shipping_total">item_shipping_total()</a><br/>
						<small>Return total value all items and the carts shipping value.</small>
					</li>
				</ul>
				<hr/>

				<h6>Database / Helper Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_helper_data#get_shipping_options">get_shipping_options()</a><br/>
						<small>Get array of available shipping options.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_helper_data#get_shipping_location">get_shipping_location()</a><br/>
						<small>Returns a filtered list of shipping locations.</small>
					</li>
				</ul>					
				<hr/>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Setting Data</h3>
				<small>Set data to the carts session data.</small>
				<hr/>
				
				<h6>Shipping Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_set_data#update_shipping">update_shipping()</a><br/>
						<small>Updates the carts current shipping option, using the database.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_set_data#set_shipping">set_shipping()</a><br/>
						<small>Set current shipping option, using manually submitted values.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Shipping Location Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_set_data#update_shipping_location">update_shipping_location()</a><br/>
						<small>Sets the shipping location to the cart session data.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 r_margin frame parallel_target">
				<h3>Admin Data</h3>
				<small>Run database management functions.</small>
				<hr/>
				
				<h6>Shipping Option Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_admin#get_db_shipping">get_db_shipping()</a><br/>
						<small>SQL SELECT query on shipping option table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_admin#insert_db_shipping">insert_db_shipping()</a><br/>
						<small>SQL INSERT statement on shipping option table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_admin#update_db_shipping">update_db_shipping()</a><br/>
						<small>SQL UPDATE statement on shipping option table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_admin#delete_db_shipping">delete_db_shipping()</a><br/>
						<small>SQL DELETE statement on shipping option table.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Shipping Rate Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_admin#get_db_shipping_rate">get_db_shipping_rate()</a><br/>
						<small>SQL SELECT query on shipping rate table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_admin#insert_db_shipping_rate">insert_db_shipping_rate()</a><br/>
						<small>SQL INSERT statement on shipping rate table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_admin#update_db_shipping_rate">update_db_shipping_rate()</a><br/>
						<small>SQL UPDATE statement on shipping rate table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_admin#delete_db_shipping_rate">delete_db_shipping_rate()</a><br/>
						<small>SQL DELETE statement on shipping rate table.</small>
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