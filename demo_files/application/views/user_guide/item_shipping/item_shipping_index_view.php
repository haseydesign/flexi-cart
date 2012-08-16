<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Shipping Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of item shipping functions in flexi cart."/> 
	<meta name="keywords" content="item shipping functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Item Shipping</h1>
				<p>Items can be setup with specific shipping rates and rules accordingly to a customers location.</p>
				<p>Below is a compiled list of functions related to the item shipping data.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Item Shipping User Guide Index</h2>				
			<a href="<?php echo $base_url; ?>user_guide/item_shipping_config">Item Shipping Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_shipping_helper_data">Item Shipping Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_shipping_admin">Item Shipping Admin Data</a>
			
			<div class="w100 frame">
				<h3>Item Shipping Configuration</h3>
				<p>Customise the configuration of the item shipping database table via the config file.</p>
				<p><a href="<?php echo $base_url; ?>user_guide/item_shipping_config">Item Shipping Config. File Settings</a></p>
			</div>
			
			<div class="w50 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the carts session or database.</small>
				<hr/>
				
				<h6>Item Shipping Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_shipping_status">item_shipping_status()</a><br/>
						<small>Return whether a specific cart row is permitted to be shipped to current shipping location.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_shipping_rate">item_shipping_rate()</a><br/>
						<small>Return shipping rate of a specific cart row.</small>
					</li>
				</ul>
				<hr/>

				<h6>Database / Helper Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_shipping_helper_data#get_item_shipping_status">get_item_shipping_status()</a><br/>
						<small>Checks database for whether a specific item can be shipped to current shipping location.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_shipping_helper_data#get_item_shipping_rate">get_item_shipping_rate()</a><br/>
						<small>Returns a specific items shipping rate from the database.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_shipping_helper_data#get_item_shipping_separate_status">get_item_shipping_separate_status()</a><br/>
						<small>Checks database for whether a specific item must be shipped separately from other items.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w50 r_margin frame parallel_target">
				<h3>Admin Data</h3>
				<small>Run database management functions.</small>
				<hr/>
				
				<h6>Item Shipping Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_shipping_admin#get_db_item_shipping">get_db_item_shipping()</a><br/>
						<small>SQL SELECT query on item shipping table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_shipping_admin#update_db_item_shipping">update_db_item_shipping()</a><br/>
						<small>SQL INSERT statement on item shipping table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_shipping_admin#insert_db_item_shipping">insert_db_item_shipping()</a><br/>
						<small>SQL UPDATE statement on item shipping table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_shipping_admin#delete_db_item_shipping">delete_db_item_shipping()</a><br/>
						<small>SQL DELETE statement on item shipping table.</small>
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