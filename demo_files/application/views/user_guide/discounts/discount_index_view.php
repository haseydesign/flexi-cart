<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Discount Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of discount functions in flexi cart."/> 
	<meta name="keywords" content="discount functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Discounts</h1>
				<p>Discounts can be setup on items and summary columns that are only activated when a set of highly configurable conditions are met.</p>
				<p>Below is a compiled list of functions related to the cart discounts.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Discount User Guide Index</h2>
			<a href="<?php echo $base_url; ?>user_guide/discount_config">Discount Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_session_data">Get Discount Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_helper_data">Get Discount Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_set_data">Set Discount Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_admin">Discount Admin Data</a>
			
			<div class="w100 frame">
				<h3>Discount Configuration</h3>
				<p>Customise the configuration of the discount database tables via the config file.</p>
				<p><a href="<?php echo $base_url; ?>user_guide/discount_config">Discount Config. File Settings</a></p>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the carts session or database.</small>
				<hr/>
				
				<h6>Discount Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_session_data#discount_codes">discount_codes()</a><br/>
						<small>Returns an array of discount codes applied to the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_session_data#excluded_discounts">excluded_discounts()</a><br/>
						<small>Returns an array of discounts that have been excluded from being applied to the cart.</small>
					</li>
				</ul>
				<hr/>

				<h6>Discount Item Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_status">item_discount_status()</a><br/>
						<small>Return whether a discount is applied to a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_data">item_discount_data()</a><br/>
						<small>Returns an array of discount values and descriptions for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_id">item_discount_id()</a><br/>
						<small>Return discount id of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_description">item_discount_description()</a><br/>
						<small>Return discount description of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_non_discount_quantity">item_non_discount_quantity()</a><br/>
						<small>Return quantity of non-discounted items for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_quantity">item_discount_quantity()</a><br/>
						<small>Return quantity of discounted items for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_price">item_discount_price()</a><br/>
						<small>Return discounted price for one item from a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_price_total">item_discount_price_total()</a><br/>
						<small>Return total price of discounted and non-discounted items for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_non_discount_price_total">item_non_discount_price_total()</a><br/>
						<small>Return total price of non-discounted items for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_total">item_discount_total()</a><br/>
						<small>Return total price of discounted items for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_savings">item_savings()</a><br/>
						<small>Return discount savings value of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_savings_total">item_savings_total()</a><br/>
						<small>Return total discount savings value of a specific cart row.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Discount Summary Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_session_data#discount_status">discount_status()</a><br/>
						<small>Returns whether a discount has been applied to the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_session_data#item_summary_discount_status">item_summary_discount_status()</a><br/>
						<small>Returns whether a discount has been applied to any item in the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_session_data#summary_discount_status">summary_discount_status()</a><br/>
						<small>Returns whether a discount has been applied to a summary column in the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_session_data#item_summary_discount_data">item_summary_discount_data()</a><br/>
						<small>Returns values and descriptions of all item discounts, formatted as an array.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_session_data#summary_discount_data">summary_discount_data()</a><br/>
						<small>Returns values and descriptions of all summary discounts, formatted as an array.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_session_data#item_summary_discount_description">item_summary_discount_description()</a><br/>
						<small>Returns values and descriptions of all item discounts, formatted as a string.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_session_data#summary_discount_description">summary_discount_description()</a><br/>
						<small>Returns values and descriptions of all summary discounts, formatted as a string.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#item_summary_savings_total">item_summary_savings_total()</a><br/>
						<small>Return savings total of all discounted items.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#summary_savings_total">summary_savings_total()</a><br/>
						<small>Return savings total of all discounts applied to a cart summary column.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#cart_savings_total">cart_savings_total()</a><br/>
						<small>Return savings total of all discounts and reward vouchers applied to the cart.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Database / Helper Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_helper_data#get_discount_requirements">get_discount_requirements()</a><br/>
						<small>Returns an array containing the quantity and value required to activate a specific discount.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_helper_data#get_item_discounts">get_item_discounts()</a><br/>
						<small>Returns an array of discounts that can be applied to an item.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_helper_data#get_saving_value">get_saving_value()</a><br/>
						<small>Returns the savings value from one value to another.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_helper_data#get_saving_percentage">get_saving_percentage()</a><br/>
						<small>Returns the savings percentage from one value to another.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_helper_data#get_expire_time">get_expire_time()</a><br/>
						<small>Returns a timestamp of when a submitted date will expire.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Setting Data</h3>
				<small>Set data to the carts session data.</small>
				<hr/>
				
				<h6>Discount Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_set_data#set_discount">set_discount()</a><br/>
						<small>Set discount data to the cart, using manually submitted values.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_set_data#set_discount_codes">set_discount_codes()</a><br/>
						<small>Set discount codes to the cart, using manually submitted values.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_set_data#update_discount_codes">update_discount_codes()</a><br/>
						<small>Set discount codes to the cart, using manually submitted values, and remove any applied discount codes that are not submitted.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_set_data#unset_discount">unset_discount()</a><br/>
						<small>Remove any discounts or reward vouchers by their id or code.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_set_data#unset_excluded_discounts">unset_excluded_discounts()</a><br/>
						<small>Re-enables all discounts and reward vouchers that have be excluded from being applied to the cart.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 r_margin frame parallel_target">
				<h3>Admin Data</h3>
				<small>Run database management functions.</small>
				<hr/>
									
				<h6>Discount Management Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#check_code_available">check_code_available()</a><br/>
						<small>Returns whether a discount code is available in the discount table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#add_discount_usage">add_discount_usage()</a><br/>
						<small>Increases the discount usage limit by a submitted value.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#remove_discount_usage">remove_discount_usage()</a><br/>
						<small>Decreases the discount usage limit by a submitted value.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#check_item_in_discount_group">check_item_in_discount_group()</a><br/>
						<small>Returns whether an item exists within a discount group.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Discount Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#get_db_discount">get_db_discount()</a><br/>
						<small>SQL SELECT query on discount table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#insert_db_discount">insert_db_discount()</a><br/>
						<small>SQL INSERT statement on discount table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#update_db_discount">update_db_discount()</a><br/>
						<small>SQL UPDATE statement on discount table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#delete_db_discount">delete_db_discount()</a><br/>
						<small>SQL DELETE statement on discount table.</small>
					</li>
				</ul>
				<hr/>

				<h6>Discount Group Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#get_db_discount_group">get_db_discount_group()</a><br/>
						<small>SQL SELECT query on discount group table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#insert_db_discount_group">insert_db_discount_group()</a><br/>
						<small>SQL INSERT statement on discount group table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#update_db_discount_group">update_db_discount_group()</a><br/>
						<small>SQL UPDATE statement on discount group table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#delete_db_discount_group">delete_db_discount_group()</a><br/>
						<small>SQL DELETE statement on discount group table.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Discount Group Item Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#get_db_discount_group_item">get_db_discount_group_item()</a><br/>
						<small>SQL SELECT query on discount group item table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#insert_db_discount_group_item">insert_db_discount_group_item()</a><br/>
						<small>SQL INSERT statement on discount group item table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#update_db_discount_group_item">update_db_discount_group_item()</a><br/>
						<small>SQL UPDATE statement on discount group item table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#delete_db_discount_group_item">delete_db_discount_group_item()</a><br/>
						<small>SQL DELETE statement on discount group item table.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Discount Meta Table CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#get_db_discount_type">get_db_discount_type()</a><br/>
						<small>SQL SELECT query on discount type table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#get_db_discount_method">get_db_discount_method()</a><br/>
						<small>SQL SELECT query on discount method table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_admin#get_db_discount_tax_method">get_db_discount_tax_method()</a><br/>
						<small>SQL SELECT query on discount tax method table.</small>
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