<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Order Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for configuring orders in flexi cart."/> 
	<meta name="keywords" content="order configuration, user guide, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="user_guide">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- User Guide Navigation -->
	<?php $this->load->view('includes/user_guide_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>User Guide | Order Configuration</h1>
				<p>
					flexi cart contains many features to aid the custom development of an e-commerce site.<br/>
					In some instances, some of the features may be considered overkill, or may not require a database table to handle a feature.<br/>
					In these cases, specific database tables can be disabled, or with some tables, specific columns can be disabled if not required.
				</p>
				<p>In addition to this, the database tables and columns can be renamed to match the custom naming conventions.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
				
			<h2>Order Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/order_index">Order Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_session_data">Get Order Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_helper_data">Get Order Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_admin">Order Admin Data</a>

			<div class="anchor_nav">
				<h6>Config Setup Information</h6>
				<p>
					<a href="#db_schema_diagram">Table Schema Diagram</a>
				</p>
				<h6>Table and Config File Settings</h6>
				<p>
					<a href="#order_summary_table">Order Summary Table</a> | <a href="#order_summary_search_columns">Order Summary Searchable Columns</a> | <a href="#order_details_table">Order Details Table</a> | <a href="#order_details_columns">Order Detail Custom Table Columns</a> | <a href="#order_status_table">Order Status Table</a>
				</p>
			</div>
		
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with the Table Configuration</h3>
				<span class="toggle">Show / Hide Help</span>
				<div id="help_guide" class="hide_toggle">
					<hr/>
					<p><strong>Internal Name</strong>: The name that flexi cart internally references the table or column by.</p>
					<p><strong>Default Name</strong>: The default table or column name used in the actual table.</p>
					<p>
						<strong>Data Type</strong>: The data type that is expected by the table column.
						<ul>
							<li><em>bool</em> : Requires a boolean value set as either '0' (FALSE) or '1' (TRUE).</li>
							<li><em>string</em> : Requires a textual value.</li>
							<li><em>int</em> : Requires a numeric value. It does not matter whether the value is an integer, float, decimal etc.</li>
						</ul>
					</p>
					<hr/>
					
					<h6>Config File Location</h6>
					<p>The config file is located in CodeIgniters 'config' folder and is named 'flexi_cart.php'.</p>
				</div>
			</div>

			<a name="db_schema_diagram"></a>
			<div class="w100 frame">
				<h3 class="heading">Order Tables Schema Diagram</h3>
				<div class="frame_note">
					<p>
						A database table schema diagram, showing how the order tables are related to each other and the cart data, custom item and user tables.<br/>
						Note: The custom item and user tables must be created by you. The diagram highlights how they can be related to the order tables.<br/>
						Table and columns names are defined using their internal names.
					</p>
				</div>
				<img src="<?php echo $includes_dir; ?>images/db_diagrams/orders_tables.jpg" class="db_schema_diagram"/>
			</div>			

			<a name="order_summary_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Order Summary Table</h3>
				
				<p>The order tables are designed to relate any data available from the cart session to a database column.</p>
				<p>When saving the cart to the database, any table columns that are related to item and summary data in the cart will be automatically saved to the database.</p>
				<hr/>

				<h6>Table and Column Names</h6>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Internal Name</th>
							<th class="spacer_125">Default Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>table</td>
							<td>order_summary</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>order_number</td>
							<td>ord_order_number</td>
							<td class="align_ctr">string</td>
							<td>
								The tables primary key.<br/>
								<strong class="highlight_red">Column Required</strong>.
							</td>
						</tr>
						<tr>
							<td>cart_data</td>
							<td>ord_cart_data_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the order to the ordered carts session data that if enabled, is saved to the database when an order is placed.<br/>
								The value acts as a foreign key relating the table to the primary key of the cart data table.<br/>
								See the 'Requirements' below for further information.
							</td>
						</tr>
						<tr>
							<td>user</td>
							<td>ord_user_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the order to a user.<br/>
								The value CAN be used to act as a foreign key relating the table to the primary key of a custom user table, although this is not joined by default.
							</td>
						</tr>
						<tr>
							<td>item_summary_total</td>
							<td>ord_item_summary_total</td>
							<td class="align_ctr">int</td>
							<td>The total value of all items in the order.</td>
						</tr>
						<tr>
							<td>item_summary_savings_total</td>
							<td>ord_item_summary_savings_total</td>
							<td class="align_ctr">int</td>
							<td>The total savings value of all discounts that were applied items in the order.</td>
						</tr>
						<tr>
							<td>shipping_name</td>
							<td>ord_shipping</td>
							<td class="align_ctr">string</td>
							<td>The name of the shipping option selected to ship the order by.</td>
						</tr>
						<tr>
							<td>shipping_total</td>
							<td>ord_shipping_total</td>
							<td class="align_ctr">int</td>
							<td>The total shipping value.</td>
						</tr>
						<tr>
							<td>item_shipping_total</td>
							<td>ord_item_shipping_total</td>
							<td class="align_ctr">int</td>
							<td>The total value of all items in the order plus the shipping total.</td>
						</tr>
						<tr>
							<td>summary_discount_description</td>
							<td>ord_summary_discount_desc</td>
							<td class="align_ctr">string</td>
							<td>A description of any discounts that were applied to the order summary.</td>
						</tr>
						<tr>
							<td>summary_savings_total</td>
							<td>ord_summary_savings_total</td>
							<td class="align_ctr">int</td>
							<td>The total savings value of any discounts that were applied to the order summary columns.</td>
						</tr>
						<tr>
							<td>savings_total</td>
							<td>ord_savings_total</td>
							<td class="align_ctr">int</td>
							<td>The total savings value of any discounts that were applied to the order.</td>
						</tr>
						<tr>
							<td>surcharge_description</td>
							<td>ord_surcharge_desc</td>
							<td class="align_ctr">string</td>
							<td>A description of any surcharges that were applied to the order.</td>
						</tr>
						<tr>
							<td>surcharge_total</td>
							<td>ord_surcharge_total</td>
							<td class="align_ctr">int</td>
							<td>The total value of any surcharges that were applied to the order.</td>
						</tr>
						<tr>
							<td>reward_voucher_description</td>
							<td>ord_reward_voucher_desc</td>
							<td class="align_ctr">string</td>
							<td>A description of any reward vouchers that were applied to the order.</td>
						</tr>
						<tr>
							<td>reward_voucher_total</td>
							<td>ord_reward_voucher_total</td>
							<td class="align_ctr">int</td>
							<td>The total value of any reward vouchers that were applied to the order.</td>
						</tr>
						<tr>
							<td>tax_rate</td>
							<td>ord_tax_rate</td>
							<td class="align_ctr">string</td>
							<td>The carts tax rate formatted to include a percentage sign.</td>
						</tr>
						<tr>
							<td>tax_total</td>
							<td>ord_tax_total</td>
							<td class="align_ctr">int</td>
							<td>The total value of all taxes applied to the order.</td>
						</tr>
						<tr>
							<td>total</td>
							<td>ord_total</td>
							<td class="align_ctr">int</td>
							<td>The total value of the order.</td>
						</tr>
						<tr>
							<td>total_rows</td>
							<td>ord_total_rows</td>
							<td class="align_ctr">int</td>
							<td>The total number of rows that were present in the cart.</td>
						</tr>
						<tr>
							<td>total_items</td>
							<td>ord_total_items</td>
							<td class="align_ctr">int</td>
							<td>The total number of items that were ordered.</td>
						</tr>
						<tr>
							<td>total_weight</td>
							<td>ord_total_weight</td>
							<td class="align_ctr">int</td>
							<td>The total weight of all items in the order.</td>
						</tr>
						<tr>
							<td>total_reward_points</td>
							<td>ord_total_reward_points</td>
							<td class="align_ctr">int</td>
							<td>The total reward points earnt by the order.</td>
						</tr>
						<tr>
							<td>currency_name</td>
							<td>ord_currency</td>
							<td class="align_ctr">string</td>
							<td>The currency that the user was displaying prices as when they placed the order.</td>
						</tr>
						<tr>
							<td>exchange_rate</td>
							<td>ord_exchange_rate</td>
							<td class="align_ctr">int</td>
							<td>The exchange rate of the currency that the user was displaying prices as when they placed the order.</td>
						</tr>
						<tr>
							<td>status</td>
							<td>ord_status</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the order to the order statuses.<br/>
								The value acts as a foreign key relating the table to the primary key of the order status table.<br/>
								<strong class="highlight_red">Column Required</strong>.
							</td>
						</tr>
						<tr>
							<td>date</td>
							<td>ord_date</td>
							<td class="align_ctr">string | int</td>
							<td>
								The date and time that the order was placed.<br/>
								The data type of this column can either be mysql datetime or a unix timestamp.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/cart_config_internal#date_time">internal config</a> documentation regarding setting the carts date and time settings.<br/>
								<strong class="highlight_red">Column Required</strong>.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then the '<a href="#order_details_table">Order Details</a>' and '<a href="#order_status_table">Order Status</a>' table must be enabled too.</p>
					<p>The related cart data table and custom item and user tables do not need to be enabled to use order tables.</p>
					<hr/>
					<p>The 'order_number', 'status' and 'date' columns are the only required columns, all disabled columns must be set as 'FALSE'.</p>
					<p>The 'cart_data' column must be enabled if saved cart data is to be reloaded from a saved order.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['order_summary']['table'] = 'order_summary';
$config['database']['order_summary']['columns']['order_number'] = 'ord_order_number';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling a non required column.</span>

$config['database']['order_summary']['columns']['savings_total'] = FALSE;
</pre>
<pre>
<span class="comment bold">// Example #3 : Disabling the table.</span>

$config['database']['order_summary']['table'] = FALSE;
</pre>
			</div>

			<a name="order_summary_search_columns"></a>
			<div class="w100 frame">
				<h3 class="heading">Order Summary Searchable Columns</h3>
				
				<div class="frame_note">
					<p>The library includes a function to search the order summary table via keywords using the search_orders() function.</p>
					<p>By default, the config file is not defined with any searchable order summary columns as keyword based search terms would typically be associated with custom columns that are added by the developer to the order summary table.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// This example is relating data from the following custom cart column data.</span>
$config['database']['order_summary']['search_order_cols'] = array(
	'custom_column_1',
	'custom_column_2',
	'custom_column_3'
);
</pre>
			</div>
			
			<a name="order_details_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Order Details Table</h3>
				
				<p>Contains the saved order details of each cart item row as an individual row in the database.</p>
				<hr/>

				<h6>Table and Column Names</h6>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Internal Name</th>
							<th class="spacer_125">Default Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>table</td>
							<td>order_details</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>ord_det_id</td>
							<td class="align_ctr">int</td>
							<td>
								The tables primary key.<br/>
								<strong class="highlight_red">Column Required</strong>.
							</td>
						</tr>
						<tr>
							<td>order_number</td>
							<td>ord_det_order_number_fk</td>
							<td class="align_ctr">string</td>
							<td>
								Relates the order detail to the unique reference number of the order summary.<br/>
								The value acts as a foreign key relating the table to the primary key of the order summary table.<br/>
								<strong class="highlight_red">Column Required</strong>.
							</td>
						</tr>
						<tr>
							<td>cart_row_id</td>
							<td>ord_det_cart_row_id</td>
							<td class="align_ctr">int</td>
							<td>
								The unique row id of the item when it was in the cart.<br/>
								See the 'Requirements' below for further information.
							</td>
						</tr>
						<tr>
							<td>item_id</td>
							<td>ord_det_item_fk</td>
							<td class="align_ctr">int</td>
							<td>
								The unique table id of the ordered item.<br/>
								The value CAN be used to act as a foreign key relating the table to the primary key of a custom item (product) table, although this is not joined by default.<br/>
								See the 'Requirements' below for further information.
							</td>
						</tr>
						<tr>
							<td>item_name</td>
							<td>ord_det_item_name</td>
							<td class="align_ctr">string</td>
							<td>The name and description of the ordered item.</td>
						</tr>
						<tr>
							<td>item_options</td>
							<td>ord_det_item_option</td>
							<td class="align_ctr">string</td>
							<td>The selected options (if any) of the ordered item.</td>
						</tr>
						<tr>
							<td>item_quantity</td>
							<td>ord_det_quantity</td>
							<td class="align_ctr">int</td>
							<td>The quantity of items ordered.</td>
						</tr>
						<tr>
							<td>item_non_discount_quantity</td>
							<td>ord_det_non_discount_quantity</td>
							<td class="align_ctr">int</td>
							<td>The quantity of items ordered that were not discounted.</td>
						</tr>
						<tr>
							<td>item_discount_quantity</td>
							<td>ord_det_discount_quantity</td>
							<td class="align_ctr">int</td>
							<td>The quantity of items ordered that were discounted.</td>
						</tr>
						<tr>
							<td>item_stock_quantity</td>
							<td>ord_det_stock_quantity</td>
							<td class="align_ctr">int</td>
							<td>
								The stock quantity level at the time the order was placed.<br/>
								The quantity does not deduct the ordered quantity of items from the stock level.
							</td>
						</tr>
						<tr>
							<td>item_price</td>
							<td>ord_det_price</td>
							<td class="align_ctr">int</td>
							<td>The price of each ordered item.</td>
						</tr>
						<tr>
							<td>item_price_total</td>
							<td>ord_det_price_total</td>
							<td class="align_ctr">int</td>
							<td>The total price of ordered items.</td>
						</tr>
						<tr>
							<td>item_discount_price</td>
							<td>ord_det_discount_price</td>
							<td class="align_ctr">int</td>
							<td>The discount price of each ordered item.</td>
						</tr>
						<tr>
							<td>item_discount_price_total</td>
							<td>ord_det_discount_price_total</td>
							<td class="align_ctr">int</td>
							<td>The total price of ordered items including any applied discounts.</td>
						</tr>
						<tr>
							<td>item_discount_description</td>
							<td>ord_det_discount_description</td>
							<td class="align_ctr">string</td>
							<td>A description of any discount applied to the item.</td>
						</tr>
						<tr>
							<td>item_tax_rate</td>
							<td>ord_det_tax_rate</td>
							<td class="align_ctr">int</td>
							<td>The non formatted tax rate applied to the ordered item.</td>
						</tr>
						<tr>
							<td>item_tax</td>
							<td>ord_det_tax</td>
							<td class="align_ctr">int</td>
							<td>The tax value of each ordered item.</td>
						</tr>
						<tr>
							<td>item_tax_total</td>
							<td>ord_det_tax_total</td>
							<td class="align_ctr">int</td>
							<td>The total tax value of ordered items.</td>
						</tr>
						<tr>
							<td>item_shipping_rate</td>
							<td>ord_det_shipping_rate</td>
							<td class="align_ctr">int</td>
							<td>The shipping rate of each ordered item.</td>
						</tr>
						<tr>
							<td>item_weight</td>
							<td>ord_det_weight</td>
							<td class="align_ctr">int</td>
							<td>The weight of each ordered item.</td>
						</tr>
						<tr>
							<td>item_weight_total</td>
							<td>ord_det_weight_total</td>
							<td class="align_ctr">int</td>
							<td>The total weight of ordered items.</td>
						</tr>
						<tr>
							<td>item_reward_points</td>
							<td>ord_det_reward_points</td>
							<td class="align_ctr">int</td>
							<td>The reward points earnt for each ordered item.</td>
						</tr>
						<tr>
							<td>item_reward_points_total</td>
							<td>ord_det_reward_points_total</td>
							<td class="align_ctr">int</td>
							<td>The total reward points earnt for all ordered items.</td>
						</tr>
						<tr>
							<td>item_status_message</td>
							<td>ord_det_status_message</td>
							<td class="align_ctr">string</td>
							<td>
								The item status message that was present when the order was placed.<br/>
								This typically states an items stock or shipping status.
							</td>
						</tr>
						<tr>
							<td>item_quantity_shipped</td>
							<td>ord_det_quantity_shipped</td>
							<td class="align_ctr">int</td>
							<td>
								The quantity of ordered items that have been shipped since the order was placed.<br/>
								See the 'Requirements' below for further information.
							</td>
						</tr>
						<tr>
							<td>item_quantity_cancelled</td>
							<td>ord_det_quantity_cancelled</td>
							<td class="align_ctr">int</td>
							<td>
								The quantity of ordered items that have been cancelled since the order was placed.<br/>
								See the 'Requirements' below for further information.
							</td>
						</tr>
						<tr>
							<td>item_shipped_date</td>
							<td>ord_det_shipped_date</td>
							<td class="align_ctr">string | int</td>
							<td>
								The date and time that the ordered item was first shipped.<br/>
								The data type of this column can either be mysql datetime or a unix timestamp.<br/>
								See the 'Requirements' below for further information.
								Read the <a href="<?php echo $base_url; ?>user_guide/cart_config_internal#date_time">internal config</a> documentation regarding setting the carts date and time settings.
							</td>
						</tr>
					</tbody>
				</table>

				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then the '<a href="#order_summary_table">Order Summary</a>' and '<a href="#order_status_table">Order Status</a>' table must be enabled too.</p>
					<p>The related cart data table and custom item and user tables do not need to be enabled to use order tables.</p>
					<hr/>
					<p>The 'id' and 'order_number' columns are the only required columns, all disabled columns must be set as 'FALSE'.</p>
					<p>The 'cart_row_id' column must be enabled if original order data is to be preserved when using the <a href="<?php echo $base_url; ?>user_guide/order_set_data#resave_order">resave_order()</a> function.</p>
					<p>The 'item_id' column must be enabled if the config setting <a href="<?php echo $base_url; ?>user_guide/cart_config_settings#auto_allocate_stock">auto_allocate_stock</a> is also enabled.</p>
					<p>The 'item_quantity', 'item_quantity_shipped', 'item_quantity_cancelled', and 'item_shipped_date' columns must be enabled if the <a href="<?php echo $base_url; ?>user_guide/misc_info#shipped_cancelled_quantities">shipped and cancelled</a> quantity of ordered items is to be validated by flexi cart. These quantities are also required for reward point calculations.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['order_details']['table'] = 'order_details';
$config['database']['order_details']['columns']['id'] = 'ord_det_id';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling a non required column.</span>

$config['database']['order_details']['columns']['item_discount_price'] = FALSE;
</pre>
<pre>
<span class="comment bold">// Example #3 : Disabling the table.</span>

$config['database']['order_details']['table'] = FALSE;
</pre>
			</div>
					
			<a name="order_details_columns"></a>
			<div class="w100 frame">
				<h3 class="heading">Order Detail Custom Table Columns</h3>
				
				<div class="frame_note">
					<p>The order detail custom columns are designed to relate custom data that has been added to the cart session data, to custom table columns that have been added to the order details table.</p>
					<p>The purpose being that when an order is saved, the custom data in the carts session will be automatically inserted to the order details table without having to define it to do so.</p>
					<p>To setup the custom table columns, an array is created that relates the name of the custom cart column that is to be saved, to the table column name where the value is saved to.</p>
					<p>Read the <a href="<?php echo $base_url; ?>user_guide/cart_config_columns#custom_columns">cart column documentation</a> for further information on defining custom cart columns.</p> 
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// This example is relating data from the following custom cart column data.</span>
$config['cart']['items']['custom_columns'] = array(
	array(
		'name' => 'user_note', 
		'required' => FALSE, 
		'regex' => FALSE, 
		'decimals' => FALSE, 
		'default' => NULL, 
		'updatable'=> TRUE
	)
);

<span class="comment">// The custom cart column is then related to the custom table columm array by referencing its 'name' 
// as an array key. The tables column name is then the array value.</span>
$config['database']['order_details']['custom_columns'] = array(
	'user_note' => 'ord_det_demo_user_note'
);
</pre>
			</div>
			
			<a name="order_status_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Order Status Table</h3>
				
				<p>Contains the order statuses that are used to indicate the progress of an order.</p>
				<hr/>

				<h6>Table and Column Names</h6>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Internal Name</th>
							<th class="spacer_125">Default Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>table</td>
							<td>order_status</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>ord_status_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>status</td>
							<td>ord_status_description</td>
							<td class="align_ctr">string</td>
							<td>The name and description of the order status.</td>
						</tr>
						<tr>
							<td>cancelled</td>
							<td>ord_status_cancelled</td>
							<td class="align_ctr">bool</td>
							<td>Defines whether the status indicates that the order has been cancelled.</td>
						</tr>
						<tr>
							<td>save_default</td>
							<td>ord_status_save_default</td>
							<td class="align_ctr">bool</td>
							<td>Defines whether the status is the default status that an order should be set with when first placed.</td>
						</tr>
						<tr>
							<td>resave_default</td>
							<td>ord_status_resave_default</td>
							<td class="align_ctr">bool</td>
							<td>Defines whether the status is the default status that an order should be set with when re-saved.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and the '<a href="#order_summary_table">Order Summary</a>' and '<a href="#order_details_table">Order Details</a>' table must be enabled too.</p>
					<p>The related cart data table and custom item and user tables do not need to be enabled to use order tables.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['order_status']['table'] = 'order_status';
$config['database']['order_status']['columns']['id'] = 'ord_status_id';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['order_status']['table'] = FALSE;
</pre>
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