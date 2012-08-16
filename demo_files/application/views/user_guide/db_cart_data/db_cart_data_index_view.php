<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Database Cart Data Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of database cart data functions in flexi cart."/> 
	<meta name="keywords" content="database cart data functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Database Cart Data</h1>
				<p>Cart session data can be saved to the database to allow customers to save individual carts that they can return to at a later date.</p>
				<p>In addition to this, when a customer places an order, the cart data can be saved so that the contents of the cart can be reloaded and amended by an admin if details of the order need to be changed.</p>
				<p>Below is a compiled list of functions related to cart data saved to the database.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Database Cart Data User Guide Index</h2>				
			<a href="<?php echo $base_url; ?>user_guide/database_cart_data_config">Database Cart Data Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/database_cart_data_admin">Database Cart Data Admin Data</a>

			<div class="w100 frame">
				<h3>Database Cart Data Configuration</h3>
				<p>Customise the configuration of the cart data database table via the config file.</p>
				<p><a href="<?php echo $base_url; ?>user_guide/database_cart_data_config">Database Cart Data Config. File Settings</a></p>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the database.</small>
				<hr/>
				
				<h6>Database / Helper Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/database_cart_data_admin#unserialize_cart_data">unserialize_cart_data()</a><br/>
						<small>Returns unserialized cart data saved in the database as an array.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/database_cart_data_admin#load_cart_data">load_cart_data()</a><br/>
						<small>Loads a saved cart data array from the database and copies it to the users current cart session data.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Setting Data</h3>
				<small>Set data to the carts session data.</small>
				<hr/>
				
				<h6>Cart Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/database_cart_data_admin#save_cart_data">save_cart_data()</a><br/>
						<small>Serializes the cart session array and saves it to the database.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 r_margin frame parallel_target">
				<h3>Admin Data</h3>
				<small>Run database management functions.</small>
				<hr/>
					
				<h6>Cart Data Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/database_cart_data_admin#get_db_cart_data">get_db_cart_data()</a><br/>
						<small>SQL SELECT query on cart data table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/database_cart_data_admin#delete_db_cart_data">delete_db_cart_data()</a><br/>
						<small>SQL DELETE statement on cart data table.</small>
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