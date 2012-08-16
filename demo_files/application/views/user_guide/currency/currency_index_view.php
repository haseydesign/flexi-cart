<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Currency Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of currency functions in flexi cart."/> 
	<meta name="keywords" content="currency functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Currency</h1>
				<p>Currencies can be setup to display item and cart pricing in a customers currency of choice.</p>
				<p>Below is a compiled list of functions related to the carts currency data.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Currency User Guide Index</h2>			
			<a href="<?php echo $base_url; ?>user_guide/currency_config">Currency Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_session_data">Get Currency Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_helper_data">Get Currency Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_set_data">Set Currency Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_admin">Currency Admin Data</a>
			
			<div class="w100 frame">
				<h3>Currency Configuration</h3>
				<p>Customise the configuration of the carts default currency settings and curreny database table via the config file.</p>
				<p><a href="<?php echo $base_url; ?>user_guide/currency_config">Currency Config. File Settings</a></p>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the carts session or database.</small>
				<hr/>
				
				<h6>Currency Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_session_data#currency_name">currency_name()</a><br/>
						<small>Returns the name of the carts current currency.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_session_data#currency_symbol">currency_symbol()</a><br/>
						<small>Returns the symbol of the carts current currency.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_session_data#exchange_rate">exchange_rate()</a><br/>
						<small>Returns the exchange rate of the carts current currency compared to the carts internal currency.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Database / Helper Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_helper_data#format_currency">format_currency()</a><br/>
						<small>Returns a submitted value as a formatted currency.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_helper_data#get_currency_data">get_currency_data()</a><br/>
						<small>SQL SELECT query on currency table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_helper_data#get_currency_symbol">get_currency_symbol()</a><br/>
						<small>Returns the symbol of the specific currency, using the database.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_helper_data#get_exchange_rate">get_exchange_rate()</a><br/>
						<small>Returns the exchange rate of a specific currency in comparison to the sites internal currency, using the database.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_helper_data#get_currency_value">get_currency_value()</a><br/>
						<small>Returns a value converted from one currency to the carts internal currency or vice versa, ignoring whether values include tax.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_helper_data#get_taxed_currency_value">get_taxed_currency_value()</a><br/>
						<small>Returns a value converted from one currency to the carts internal currency or vice versa, adjusting values for differences in tax.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Setting Data</h3>
				<small>Set data to the carts session data.</small>
				<hr/>
				
				<h6>Currency Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_set_data#update_currency">update_currency()</a><br/>
						<small>Updates the carts currency that prices are displayed in, using the database.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_set_data#set_currency">set_currency()</a><br/>
						<small>Updates the carts currency that prices are displayed in, using manually submitted values.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 r_margin frame parallel_target">
				<h3>Admin Data</h3>
				<small>Run database management functions.</small>
				<hr/>
				
				<h6>Currency Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_admin#get_db_currency">get_db_currency()</a><br/>
						<small>SQL SELECT query on currency table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_admin#insert_db_currency">insert_db_currency()</a><br/>
						<small>SQL INSERT statement on currency table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_admin#update_db_currency">update_db_currency()</a><br/>
						<small>SQL UPDATE statement on currency table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/currency_admin#delete_db_currency">delete_db_currency()</a><br/>
						<small>SQL DELETE statement on currency table.</small>
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