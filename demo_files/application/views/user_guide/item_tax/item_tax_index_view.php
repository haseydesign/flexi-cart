<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Tax Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of item tax functions in flexi cart."/> 
	<meta name="keywords" content="item tax functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Item Tax</h1>
				<p>Items can be setup with specific tax rates accordingly to a customers location.</p>
				<p>Below is a compiled list of functions related to the item tax data.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Item Tax User Guide Index</h2>			
			<a href="<?php echo $base_url; ?>user_guide/item_tax_config">Item Tax Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_tax_helper_data">Item Tax Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_tax_admin">Item Tax Admin Data</a>
			
			<div class="w100 frame">
				<h3>Item Tax Configuration</h3>
				<p>Customise the configuration of the item tax database table via the config file.</p>
				<p><a href="<?php echo $base_url; ?>user_guide/item_tax_config">Item Tax Config. File Settings</a></p>
			</div>
			
			<div class="w50 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the carts session or database.</small>
				<hr/>
				
				<h6>Item Tax Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_tax_rate">item_tax_rate()</a><br/>
						<small>Return tax rate of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_tax">item_tax()</a><br/>
						<small>Return tax value of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_tax_total">item_tax_total()</a><br/>
						<small>Return total tax value of a specific cart row.</small>
					</li>
				</ul>
				<hr/>

				<h6>Database / Helper Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_tax_helper_data#get_item_tax_rate">get_item_tax_rate()</a><br/>
						<small>Returns a specific items tax rate from the database.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_tax_helper_data#get_item_tax_value">get_item_tax_value()</a><br/>
						<small>Returns a specific items tax value using a tax rate defined in the database.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w50 r_margin frame parallel_target">
				<h3>Admin Data</h3>
				<small>Run database management functions.</small>
				<hr/>
				
				<h6>Item Tax Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_tax_admin#get_db_item_tax">get_db_item_tax()</a><br/>
						<small>SQL SELECT query on item tax table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_tax_admin#update_db_item_tax">update_db_item_tax()</a><br/>
						<small>SQL INSERT statement on item tax table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_tax_admin#insert_db_item_tax">insert_db_item_tax()</a><br/>
						<small>SQL UPDATE statement on item tax table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_tax_admin#delete_db_item_tax">delete_db_item_tax()</a><br/>
						<small>SQL DELETE statement on item tax table.</small>
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