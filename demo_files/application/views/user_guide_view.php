<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The flexi cart user guide."/> 
	<meta name="keywords" content="user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | flexi cart</h1>
				<p>flexi cart is the developers toolkit for building highly customised shopping carts.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>User Guide Sections</h2>				

			<div class="w100 frame">
				<h3>Getting Started</h3>
				<hr/>
				<ul>
					<li><a href="https://github.com/haseydesign/flexi-cart">Download</a> the latest version of the flexi cart library.</li>
					<li>Read through the <a href="<?php echo $base_url; ?>user_guide/installation">installation guide</a>.</li>
					<li>Read the <a href="<?php echo $base_url; ?>user_guide/concept">flexi cart concept</a> to understand the principle ideas of how flexi cart works.</li>
					<li>Read the <a href="<?php echo $base_url; ?>user_guide/library_info">library documentation</a> to get an understanding of the purpose of each library.</li>
					<li>Then start building your shopping cart, using the demo and user guide for reference on how to implement each of flexi carts features.</li>
				</ul>
			</div>	
				
			<div class="w50 frame parallel_target">
				<h3>Configuration</h3>
				<hr/>
				
				<h6>Internal Cart Data</h6>
				<ul class="inl_block">
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_columns">Cart Columns</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_internal#data_validation">Data Validation Rules</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_internal#date_time">Date / Time Setup</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_internal#email_settings">Email Settings</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_internal#messages">Status / Error Messages</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_internal#language">Define Language</a>
					</li>
				</ul>
				<hr/>
				
				<h6>Database Tables and Columns</h6>
				<ul class="inl_block">
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_config">Locations</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_config">Shipping</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_shipping_config">Item Shipping</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/tax_config">Tax</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_tax_config">Item Tax</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_stock_config">Item Stock</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_config">Currency</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_config">Discounts</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_config">Reward Points / Vouchers</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_config">Orders</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/database_cart_data_config">Database Cart Data</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_settings">Cart Functionality Config</a>
					</li>
				</ul>
				<hr/>
				
				<h6>Default Values</h6>
				<ul class="inl_block">
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_config#config_defaults">Location Defaults</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_config#config_defaults">Shipping Defaults</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/tax_config#config_defaults">Tax Defaults</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_config#config_defaults">Currency Defaults</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_settings#config_defaults">Cart Configuration Defaults</a>
					</li>
				</ul>
			</div>
				
			<div class="w50 r_margin frame parallel_target">
				<h3>Function List</h3>
				<hr/>

				<h6>Cart Session Data Functions</h6>
				<ul class="inl_block">
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_index">Cart Config. Functions</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_index">Cart Item / Summary Functions</a>
					</li>
				</ul>
				<hr/>
				
				<h6>Localisation Functions</h6>
				<ul class="inl_block">
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_index">Location Functions</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/shipping_index">Shipping Functions</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/tax_index">Tax Functions</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_index">Currency Functions</a>
					</li>
				</ul>
				<hr/>
				
				<h6>Item Functions</h6>
				<ul class="inl_block">
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_shipping_index">Item Shipping Functions</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_tax_index">Item Tax Functions</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_stock_index">Item Stock Functions</a>
					</li>
				</ul>
				<hr/>
				
				<h6>Discount / Reward / Surcharge Functions</h6>
				<ul class="inl_block">
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_index">Discount Functions</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_index">Reward Functions</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/surcharge_index">Surcharge Functions</a>
					</li>
				</ul>
				<hr/>
				
				<h6>Order / Database Cart Data Functions</h6>
				<ul class="inl_block">
					<li>
						<a href="<?php echo $base_url; ?>user_guide/order_index">Orders Functions</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/database_cart_data_index">Database Cart Data Functions</a>
					</li>
				</ul>
				<hr/>
				
				<h6>Miscellaneous Functions</h6>
				<ul class="inl_block">
					<li>
						<a href="<?php echo $base_url; ?>user_guide/custom_sql_index">Customising SQL Statements</a>
					</li>
				</ul>
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