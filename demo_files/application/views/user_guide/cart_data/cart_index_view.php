<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Cart Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of cart functions in flexi cart."/> 
	<meta name="keywords" content="cart functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Cart</h1>
				<p>The structure of the cart comprises of three main groups of data, the data of items in the cart, the summary totals of the cart and then the configuration and localisation settings of the cart.</p>
				<p>Below is a compiled list of functions related to cart session data.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>User Guide Sections</h2>				
			<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data">Get Cart Item Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data">Get Cart Summary Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_session_data">Get Cart Session Data</a> | 
			<a href="<?php echo $base_url; ?>user_guide/cart_set_data">Set Cart Session Data</a>

			<div class="w33 frame parallel_target">
				<h3>Getting Cart / Summary Data</h3>
				<small>Get cart and summary data from the cart session.</small>
				<hr/>
				
				<h6>Cart Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_session_data#cart_status">cart_status()</a><br/>
						<small>Returns whether any items exist in the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_session_data#cart_array">cart_array()</a><br/>
						<small>Returns cart session array of the entire cart, unformatted.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_session_data#cart_contents">cart_contents()</a><br/>
						<small>Returns cart item and summary data, formatted by function parameters.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Summary Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#cart_summary">cart_summary()</a><br/>
						<small>Returns cart summary data, formatted by function parameters.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#cart_summary_array">cart_summary_array()</a><br/>
						<small>Returns cart session array of cart summary data, unformatted.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Summary Totals</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#item_summary_total">item_summary_total()</a><br/>
						<small>Returns total value of all items.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#shipping_total">shipping_total()</a><br/>
						<small>Returns carts shipping value.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#item_shipping_total">item_shipping_total()</a><br/>
						<small>Returns total value all items and the carts shipping value.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#tax_total">tax_total()</a><br/>
						<small>Returns total tax value of the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#sub_total">sub_total()</a><br/>
						<small>Returns sub-total value of the cart (e.g. grand total excluding tax).</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#total">total()</a><br/>
						<small>Returns grand total value of the cart.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Discount / Voucher / Surcharge Totals</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#item_summary_savings_total">item_summary_savings_total()</a><br/>
						<small>Returns savings total of all discounted items.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#summary_savings_total">summary_savings_total()</a><br/>
						<small>Returns savings total of all discounts applied to a cart summary column.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#cart_savings_total">cart_savings_total()</a><br/>
						<small>Returns savings total of all discounts and reward vouchers applied to the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#reward_voucher_total">reward_voucher_total()</a><br/>
						<small>Returns total value of reward vouchers applied to the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#surcharge_total">surcharge_total()</a><br/>
						<small>Returns total value of all surcharges applied to the cart.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Misc. Totals</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#total_rows">total_rows()</a><br/>
						<small>Returns total number of item rows in the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#total_items">total_items()</a><br/>
						<small>Returns total quantity of items in the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#total_weight">total_weight()</a><br/>
						<small>Returns total weight of items in the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#total_reward_points">total_reward_points()</a><br/>
						<small>Returns total reward points of items in the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#cart_taxable_value">cart_taxable_value()</a><br/>
						<small>Returns total taxable value of the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#cart_non_taxable_value">cart_non_taxable_value()</a><br/>
						<small>Returns total non-taxable value of the cart.</small>
					</li>
				</ul>
				<hr/>

				<h6>Database / Helper Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/discount_helper_data#get_expire_time">get_expire_time()</a><br/>
						<small>Returns the number of seconds until a submitted date, for the purpose of a generating a countdown timer.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_helper_data#get_date_time">get_date_time()</a><br/>
						<small>Returns either an SQL DATETIME formatted time stamp or a UNIX timestamp.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_helper_data#get_weight_types">get_weight_types()</a><br/>
						<small>Returns either an array of a specific weight types data or a multi-dimensional array all weight types and their data.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_helper_data#weight_name">weight_name()</a><br/>
						<small>Returns the name of the carts default weight type.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_helper_data#weight_symbol">weight_symbol()</a><br/>
						<small>Returns the symbol of the carts default weight type.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_helper_data#convert_weight">convert_weight()</a><br/>
						<small>Returns a weight converted from one weight type to another.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_helper_data#format_weight">format_weight()</a><br/>
						<small>Returns a submitted value as a formatted weight.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_helper_data#db_table">db_table()</a><br/>
						<small>Returns the actual name of a table defined in the config file by referencing the tables internal name.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_session_data#db_column">db_column()</a><br/>
						<small>Returns the actual name of a table column defined in the config file by referencing the table columns internal name.</small>
					</li>
				</ul>
				<hr/>
			</div>

			<div class="w33 frame parallel_target">
				<h3>Getting Cart Item Data</h3>
				<small>Get cart item data from the cart session.</small>
				<hr/>
				
				<h6>Item Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#row_id_exists">row_id_exists()</a><br/>
						<small>Returns whether a specific cart row exists.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#cart_items">cart_items()</a><br/>
						<small>Returns entire cart item data, formatted by function parameters.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#cart_item_row">cart_item_row()</a><br/>
						<small>Returns a specific cart item row, formatted by function parameters.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#cart_item_array">cart_item_array()</a><br/>
						<small>Returns the cart session array of the entire cart item data, unformatted.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Required Item Columns</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_id">item_id()</a><br/>
						<small>Returns item id of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_name">item_name()</a><br/>
						<small>Returns item name of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_quantity">item_quantity()</a><br/>
						<small>Returns item quantity of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_price">item_price()</a><br/>
						<small>Returns price of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_price_total">item_price_total()</a><br/>
						<small>Returns total price of a specific cart row.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Item Tax</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_tax_rate">item_tax_rate()</a><br/>
						<small>Returns tax rate of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_tax">item_tax()</a><br/>
						<small>Returns tax value of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_tax_total">item_tax_total()</a><br/>
						<small>Returns total tax value of a specific cart row.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Item Shipping</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_shipping_status">item_shipping_status()</a><br/>
						<small>Returns whether a specific cart row is permitted to be shipped to current shipping location.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_shipping_rate">item_shipping_rate()</a><br/>
						<small>Returns shipping rate of a specific cart row.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Item Stock</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_stock_status">item_stock_status()</a><br/>
						<small>Returns whether an item is in-stock for a specific row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_stock_quantity">item_stock_quantity()</a><br/>
						<small>Returns stock quantity of a specific cart row.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Item Options</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_option_status">item_option_status()</a><br/>
						<small>Returns whether a specific row has any item options set.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_options">item_options()</a><br/>
						<small>Returns item options of a specific cart row, formatted as a string.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_options_array">item_options_array()</a><br/>
						<small>Returns item options of a specific cart row, formatted as an array.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Item Reward Points</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_reward_points">item_reward_points()</a><br/>
						<small>Returns reward points of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_reward_points_total">item_reward_points_total()</a><br/>
						<small>Returns total reward points of a specific cart row.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Item Weight</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_weight">item_weight()</a><br/>
						<small>Returns weight of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_weight_total">item_weight_total()</a><br/>
						<small>Returns total weight of a specific cart row.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Item Discount Values</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_status">item_discount_status()</a><br/>
						<small>Returns whether a discount is applied to a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_data">item_discount_data()</a><br/>
						<small>Returns an array of discount values and descriptions for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_id">item_discount_id()</a><br/>
						<small>Returns discount id of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_description">item_discount_description()</a><br/>
						<small>Returns discount description of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_non_discount_quantity">item_non_discount_quantity()</a><br/>
						<small>Returns quantity of non-discounted items for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_quantity">item_discount_quantity()</a><br/>
						<small>Returns quantity of discounted items for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_price">item_discount_price()</a><br/>
						<small>Returns discounted price for one item from a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_price_total">item_discount_price_total()</a><br/>
						<small>Returns total price of discounted and non-discounted items for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_non_discount_price_total">item_non_discount_price_total()</a><br/>
						<small>Returns total price of non-discounted items for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_discount_total">item_discount_total()</a><br/>
						<small>Returns total price of discounted items for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_savings">item_savings()</a><br/>
						<small>Returns discount savings value of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_savings_total">item_savings_total()</a><br/>
						<small>Returns total discount savings value of a specific cart row.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Item Status Messages</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_status_message">item_status_message()</a><br/>
						<small>Returns status message for a specific cart row, formatted as a string.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_status_message_array">item_status_message_array()</a><br/>
						<small>Returns status message for a specific cart row, formatted as an array.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Misc.</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#get_item_column">get_item_column()</a><br/>
						<small>Returns any set column name including user defined data for a specific cart row.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Item Admin Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_admin_data_status">item_admin_data_status()</a><br/>
						<small>Returns whether any 'admin data' is set for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_shipped_quantity">item_shipped_quantity()</a><br/>
						<small>Returns the 'shipped quantity' of items in 'admin data' for a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_cancelled_quantity">item_cancelled_quantity()</a><br/>
						<small>Returns the 'cancelled quantity' of items in 'admin data' for a specific cart row.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 r_margin frame parallel_target">
				<h3>Setting Data / Messages</h3>
				<small>Set and alter data within the cart session.</small>
				<hr/>
				
				<h6>Insert Items / Update Cart</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#insert_items">insert_items()</a><br/>
						<small>Insert new items to the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#update_cart">update_cart()</a><br/>
						<small>Update items and settings within the cart.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Misc.</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#recalculate_cart">recalculate_cart()</a><br/>
						<small>Recalculate all cart values.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#unset_admin_data">unset_admin_data()</a><br/>
						<small>Unset any set admin data.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#empty_cart">empty_cart()</a><br/>
						<small>Remove all items from the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#destroy_cart">destroy_cart()</a><br/>
						<small>Destroy all items and settings within the cart.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Messages</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#status_messages">status_messages()</a><br/>
						<small>Returns a formatted string of all status messages.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#set_status_message">set_status_message()</a><br/>
						<small>Set a status message.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#clear_status_messages">clear_status_messages()</a><br/>
						<small>Clear all status messages.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#error_messages">error_messages()</a><br/>
						<small>Returns a formatted string of all error messages.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#set_error_message">set_error_message()</a><br/>
						<small>Set an error message.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#clear_error_messages">clear_error_messages()</a><br/>
						<small>Clear all error messages.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#clear_messages">clear_messages()</a><br/>
						<small>Clear all status and error messages.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#get_messages_array">get_messages_array()</a><br/>
						<small>Returns an array of all status and error messages.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_set_data#get_messages">get_messages()</a><br/>
						<small>Returns a formatted string of all status and error messages.</small>
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