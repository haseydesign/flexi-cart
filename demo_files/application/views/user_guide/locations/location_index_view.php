<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Location Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of location functions in flexi cart."/> 
	<meta name="keywords" content="location functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Locations</h1>
				<p>Locations can be setup to offer specific shipping options, tax rates and discounts accordingly to a customers location.</p>
				<p>Below is a compiled list of functions related to the carts location data.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Location User Guide Index</h2>				
			<a href="<?php echo $base_url; ?>user_guide/location_config">Location Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_session_data">Get Location Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_helper_data">Get Location Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_set_data">Set Location Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_admin">Location Admin Data</a>
			
			<div class="w100 frame">
				<h3>Location Configuration</h3>
				<p>Customise the configuration of the carts default location settings and location database tables via the config file.</p>
				<p><a href="<?php echo $base_url; ?>user_guide/location_config">Location Config. File Settings</a></p>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the carts session or database.</small>
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
				
				<h6>Database / Helper Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_helper_data#get_shipping_location">get_shipping_location()</a><br/>
						<small>Returns a filtered list of shipping locations.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_helper_data#get_tax_location">get_tax_location()</a><br/>
						<small>Returns a filtered list of tax locations.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_helper_data#locations_tiered">locations_tiered()</a><br/>
						<small>Returns a multi-dimensional array of locations, tier grouped by location type.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_helper_data#locations_inline">locations_inline()</a><br/>
						<small>Returns a single-dimensional array of locations, with location types formatted inline.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_helper_data#location_zones">location_zones()</a><br/>
						<small>Returns an array of location zones.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Setting Data</h3>
				<small>Set data to the carts session data.</small>
				<hr/>
				
				<h6>Location Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_set_data#update_shipping_location">update_shipping_location()</a><br/>
						<small>Sets the shipping location to the cart session data.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_set_data#update_tax_location">update_tax_location()</a><br/>
						<small>Sets the tax location to the cart session data.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_set_data#update_location">update_location()</a><br/>
						<small>Sets the same shipping and tax location to the cart session data.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 r_margin frame parallel_target">
				<h3>Admin Data</h3>
				<small>Run database management functions.</small>
				<hr/>
				
				<h6>Location Type Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_admin#get_db_location_type">get_db_location_type()</a><br/>
						<small>SQL SELECT query on location type table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_admin#insert_db_location_type">insert_db_location_type()</a><br/>
						<small>SQL INSERT statement on location type table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_admin#update_db_location_type">update_db_location_type()</a><br/>
						<small>SQL UPDATE statement on location type table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_admin#delete_db_location_type">delete_db_location_type()</a><br/>
						<small>SQL DELETE statement on location type table.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Location Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_admin#get_db_location">get_db_location()</a><br/>
						<small>SQL SELECT query on location table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_admin#insert_db_location">insert_db_location()</a><br/>
						<small>SQL INSERT statement on location table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_admin#update_db_location">update_db_location()</a><br/>
						<small>SQL UPDATE statement on location table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_admin#delete_db_location">delete_db_location()</a><br/>
						<small>SQL DELETE statement on location table.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Location Zone Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_admin#get_db_location_zone">get_db_location_zone()</a><br/>
						<small>SQL SELECT query on location zone table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_admin#insert_db_location_zone">insert_db_location_zone()</a><br/>
						<small>SQL INSERT statement on location zone table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_admin#update_db_location_zone">update_db_location_zone()</a><br/>
						<small>SQL UPDATE statement on location zone table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/location_admin#delete_db_location_zone">delete_db_location_zone()</a><br/>
						<small>SQL DELETE statement on location zone table.</small>
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