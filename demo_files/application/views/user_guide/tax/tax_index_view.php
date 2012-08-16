<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Tax Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of tax functions in flexi cart."/> 
	<meta name="keywords" content="tax functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Tax</h1>
				<p>Taxes can be setup to apply a specific tax rate accordingly to a customers location.</p>
				<p>Below is a compiled list of functions related to the carts tax data.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Tax User Guide Index</h2>				
			<a href="<?php echo $base_url; ?>user_guide/tax_config">Tax Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/tax_session_data">Get Tax Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/tax_set_data">Set Tax Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/tax_admin">Tax Admin Data</a>
			
			<div class="w100 frame">
				<h3>Tax Configuration</h3>
				<p>Customise the configuration of the carts default tax settings and tax database tables via the config file.</p>
				<p><a href="<?php echo $base_url; ?>user_guide/tax_config">Tax Config. File Settings</a></p>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the carts session or database.</small>
				<hr/>
									
				<h6>Tax Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/tax_session_data#tax_name">tax_name()</a><br/>
						<small>Returns the name of the current tax.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/tax_session_data#tax_rate">tax_rate()</a><br/>
						<small>Returns the rate of the current tax.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Tax Location Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_session_data#tax_location_data">tax_location_data()</a><br/>
						<small>Returns an array of the carts current tax locations as table ids.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_session_data#match_tax_location_id">match_tax_location_id()</a><br/>
						<small>Returns whether a submitted location id is set within the cart tax location array.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_session_data#tax_location_id">tax_location_id()</a><br/>
						<small>Returns the location id of the current tax location.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_session_data#tax_location_name">tax_location_name()</a><br/>
						<small>Returns the location name of the current tax location.</small>
					</li>
				</ul>
				<hr/>

				<h6>Tax Summary Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#tax_total">tax_total()</a><br/>
						<small>Return total tax value of the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#cart_taxable_value">cart_taxable_value()</a><br/>
						<small>Return total taxable value of the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#cart_non_taxable_value">cart_non_taxable_value()</a><br/>
						<small>Return total non-taxable value of the cart.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Tax Config. Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#display_prices_inc_tax">display_prices_inc_tax()</a><br/>
						<small>Returns whether the user is currently viewing prices including tax.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#cart_prices_inc_tax">cart_prices_inc_tax()</a><br/>
						<small>Returns whether the carts internal prices include tax.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Set Data to Cart Session</h3>
				<small>Set data to the carts session data.</small>
				<hr/>
				
				<h6>Tax Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/tax_set_data#update_tax">update_tax()</a><br/>
						<small>Updates the carts current tax rate, using the database.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/tax_set_data#set_tax">set_tax()</a><br/>
						<small>Set current cart tax rate, using manually submitted values.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Tax Location Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_set_data#update_tax_location">update_tax_location()</a><br/>
						<small>Sets the tax location to the cart session data.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Tax Config. Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_prices_inc_tax">set_prices_inc_tax()</a><br/>
						<small>Set whether displayed prices included tax.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 r_margin frame parallel_target">
				<h3>Admin Data</h3>
				<small>Run database management functions.</small>
				<hr/>
				
				<h6>Tax Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/tax_admin#get_db_tax">get_db_tax()</a><br/>
						<small>SQL SELECT query on tax table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/tax_admin#insert_db_tax">insert_db_tax()</a><br/>
						<small>SQL INSERT statement on tax table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/tax_admin#update_db_tax">update_db_tax()</a><br/>
						<small>SQL UPDATE statement on tax table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/tax_admin#delete_db_tax">delete_db_tax()</a><br/>
						<small>SQL DELETE statement on tax table.</small>
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