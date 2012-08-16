<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Stock Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of item stock functions in flexi cart."/> 
	<meta name="keywords" content="item stock functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Item Stock</h1>
				<p>The quantity and status of item stock can be integrated into the functionality of the cart, displaying stock quantities to customers and automatically allocating stock when items are purchased and returned.</p>
				<p>Below is a compiled list of functions related to item stock data.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Item Stock User Guide Index</h2>				
			<a href="<?php echo $base_url; ?>user_guide/item_stock_config">Item Stock Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_stock_helper_data">Item Stock Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_stock_admin">Item Stock Admin Data</a>
			
			<div class="w100 frame">
				<h3>Item Stock Configuration</h3>
				<p>Customise the configuration of the item stock database table via the config file.</p>
				<p><a href="<?php echo $base_url; ?>user_guide/item_stock_config">Item Stock Config. File Settings</a></p>
			</div>
			
			<div class="w50 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the carts session or database.</small>
				<hr/>
				
				<h6>Item Stock Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_stock_status">item_stock_status()</a><br/>
						<small>Return whether an item is in-stock for a specific row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_stock_quantity">item_stock_quantity()</a><br/>
						<small>Return stock quantity of a specific cart row.</small>
					</li>
				</ul>
				<hr/>

				<h6>Database / Helper Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_stock_helper_data#get_item_stock_status">get_item_stock_status()</a><br/>
						<small>Checks database for whether a specific item is in-stock.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_stock_helper_data#get_item_stock_quantity">get_item_stock_quantity()</a><br/>
						<small>Returns a specific items stock quantity from the database.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w50 r_margin frame parallel_target">
				<h3>Admin Data</h3>
				<small>Run database management functions.</small>
				<hr/>
				
				<h6>Item Stock Management Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_stock_admin#add_item_stock_quantity">add_item_stock_quantity()</a><br/>
						<small>Increases the item stock quantity by a submitted value.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_stock_admin#remove_item_stock_quantity">remove_item_stock_quantity()</a><br/>
						<small>Decreases the item stock quantity by a submitted value.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Item Stock Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_stock_admin#get_db_item_stock">get_db_item_stock()</a><br/>
						<small>SQL SELECT query on item stock table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_stock_admin#update_db_item_stock">update_db_item_stock()</a><br/>
						<small>SQL INSERT statement on item stock table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_stock_admin#insert_db_item_stock">insert_db_item_stock()</a><br/>
						<small>SQL UPDATE statement on item stock table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/item_stock_admin#delete_db_item_stock">delete_db_item_stock()</a><br/>
						<small>SQL DELETE statement on item stock table.</small>
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