<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Set Order Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for setting order data in flexi cart."/> 
	<meta name="keywords" content="setting order data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Saving Order Data</h1>
				<p>xxx</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
						
			<h2>Saving Order Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/order_index">Order Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_config">Order Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_helper_data">Get Order Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_admin">Order Admin Data</a>

			<div class="anchor_nav">
				<h6>Save Order Data to Database</h6>
				<p>
					<a href="#save_order">save_order()</a> | <a href="#resave_order">resave_order()</a>
				</p>
			</div>
			
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with Saving Order Data Functions</h3>
				<span class="toggle">Show / Hide Help</span>
				<div id="help_guide" class="hide_toggle">
					<hr/>
					<p><strong>Name</strong>: The name of the function (method).</p>
					<p>
						<strong>Data Type</strong>: The data type that is expected by the function.
						<ul>
							<li><em>bool</em> : Requires a boolean value of 'TRUE' or 'FALSE'.</li>
							<li><em>string</em> : Requires a textual value.</li>
							<li><em>int</em> : Requires a numeric value. It does not matter whether the value is an integer, float, decimal etc.</li>
							<li><em>array</em> : Requires an array.</li>
						</ul>
					</p>
					<p><strong>Required</strong>: Defines whether the parameter requires a value to be submitted.</p>
					<p><strong>Default</strong>: Defines the default parameter value that is used if no other value is submitted.</p>
				</div>
			</div>

			<a name="save_order"></a>
			<div class="w100 frame">
				<h3 class="heading">save_order()</h3>
				
				<p>Saves the content of the cart as an order.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>save_order(custom_summary_data, custom_item_data, order_number)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_175">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>custom_summary_data</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Sets any additional summary data to be saved to the order summary table, that is not automatically saved by the function.<br/>
								The data must be a single-dimensional array, with each array key matching the order summary table column name.
							</td>
						</tr>
						<tr>
							<td>custom_item_data</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Sets any additional item data to be saved to the order details table, that is not automatically saved by the function.<br/>
								The data must be a multi-dimensional array. The root array key values must be the cart row id of the data being saved.<br/>
								The sub-array keys must then match the order details table column name.
							</td>
						</tr>
						<tr>
							<td>order_number</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Sets a specific order number for the new order, by default, a random number is generated.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function first checks whether there are any items in the cart that are banned from being shipped to the shipping location. If the carts config settings do not permit banned items to be saved in an order, the function immediately stops.</p>
					<p>A database transaction is then started that can rollback any saved order details if an error occurs whilst saving the cart data.</p>
					<p>The function then proceeds to check whether a custom order number was submitted and validates that no other orders exist with this number, if the number exists, the function stops returning an error message. If no custom order number is submitted, then an order number is automatically generated.</p>
					<p>The active order summary table columns defined via the config file are then looped through and are matched with any data from the 'custom_summary_data' array, and with the carts session summary data. The matched data is then added to an array that is used to save the cart summary data to the order summary table.</p>
					<p>Once the summary data is saved, the function prepares the cart item data to be saved to the order details table.</p>
					<p>If defined via the cart config settings, any items banned from being shipped are removed from the cart data so they are not saved. The cart then loops through the order detail table columns and matches any data from the 'custom_item_data' array, and from the carts sessions item data. The matched data is then added to an array that is used to save the cart item data to the order details table.</p>
					<p>Then if defined to do so, the cart will auto allocate item stock quantities and discount usages from the database tables.</p>
				</div>
			
				<h6>Notes</h6>
				<div class="frame_note">
					<p>When an order is saved, unless specified otherwise via the 'custom_summary_data' array, the status of the order will be set to the status defined by the 'save_default' column (Defined by a value of 1) in the order status table.</p>
					<hr/>
					<p>Currency and tax rate values are saved as a number without and symbols prefixed or suffixed to them.</p>
					<p>This function should not be used to resave an existing saved order that has been reloaded into the carts session. Instead, use the '<a href="#resave_order">resave_order()</a>' function.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Saving data only available from the cart session.</span>

$this->flexi_cart_admin->save_order();
</pre>
<pre>
<span class="comment bold">// Example #2 : Saving cart session data and custom data, whilst defining a specific order number.</span>

<span class="comment">// Setting custom summary data using a single-dimensional array.</span>
$custom_summary_data = array(
'order_summary_tbl_column_1' => 'example_summary_value_1',
'order_summary_tbl_column_2' => 'example_summary_value_2'
);

<span class="comment">// Setting custom item data using a multi-dimensional array.
// Note: The cart row id of each item must be used to identify each items data.</span>
$custom_item_data = array(
'38b3eff8baf56627478ec76a704e9b52' => array(
	'order_detail_tbl_column_1' => 'item_#1_data_1',
	'order_detail_tbl_column_2' => 'item_#1_data_2'
),
'c45147dee729311ef5b5c3003946c48f' => array(
	'order_detail_tbl_column_1' => 'item_#2_data_1',
	'order_detail_tbl_column_2' => 'item_#2_data_2'
)
);

<span class="comment">// Setting a specific order number.</span>
$order_number = 'example_order_number';

$this->flexi_cart_admin->save_order($custom_summary_data, $custom_item_data, $order_number);
</pre>
			</div>

			<a name="resave_order"></a>
			<div class="w100 frame">
				<h3 class="heading">resave_order()</h3>
				
				<p>Resaves the content of the cart over an existing order in the database.</p>
				<p>The difference between the 'resave_order()' and the '<a href="<?php echo $base_url; ?>user_guide/order_admin#update_db_order_summary">update_db_order_summary()</a>' and '<a href="<?php echo $base_url; ?>user_guide/order_admin#update_db_order_details">update_db_order_details()</a>' functions is that 'resave_order()' automatically saves a cart using data from a users current session, whereas the other functions are updated via submitting data.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>resave_order(custom_summary_data, custom_item_data)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_175">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>custom_summary_data</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Sets any additional summary data to be saved to the order summary table, that is not automatically saved by the function.<br/>
								The data must be a single-dimensional array, with each array key matching the order summary table column name.
							</td>
						</tr>
						<tr>
							<td>custom_item_data</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Sets any additional item data to be saved to the order details table, that is not automatically saved by the function.<br/>
								The data must be a multi-dimensional array. The root array key values must be the cart row id of the data being saved.<br/>
								The sub-array keys must then match the order details table column name.
							</td>
						</tr>
					</tbody>
				</table>
			
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The functions works in a very similar way to the '<a href="#save_order">save_order()</a>' function, but with a key difference.</p>
					<p>The function can only be used to save data from a previously saved order, if the original order does not exist in the order tables, the order cannot be resaved. The function checks whether the original order exists by matching the cart sessions current order number with existing records in the order summary table.</p>
					<p>
						For data from a previously saved order to be in the carts current session data, it must be loaded from the saved orders cart data, that if enabled is available from the 'cart data' table. This data is loaded using the '<a href="<?php echo $base_url; ?>user_guide/database_cart_data_admin#load_cart_data">load_cart_data()</a>' function.
					</p>
				</div>
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>When an order is resaved, unless specified otherwise via the 'custom_summary_data' array, the status of the order will be set to the status defined by the 'resave_default' column (Defined by a value of 1) in the order status table.</p>
					<hr/>
					<p>If the item stock table and the 'item_stock_quantity' column in the order details table are enabled, the cart will save the stock quantity of an item at the time that the order was placed. The item quantity that has been ordered is not deducted from the saved stock quantity.</p>
					<hr/>
					<p>Currency and tax rate values are saved as a number without and symbols prefixed or suffixed to them.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Saving data only available from the cart session.</span>

$this->flexi_cart_admin->resave_order();
</pre>
<pre>
<span class="comment bold">// Example #2 : Saving cart session data and custom data, whilst defining a specific order number.</span>

<span class="comment">// Setting custom summary data using a single-dimensional array.</span>
$custom_summary_data = array(
'order_summary_column_1' => 'example_summary_value_1',
'order_summary_column_2' => 'example_summary_value_2'
);

<span class="comment">// Setting custom item data using a multi-dimensional array.
// Note: The cart row id of each item must be used to identify each items data.</span>
$custom_item_data = array(
'38b3eff8baf56627478ec76a704e9b52' => array(
	'order_detail_column_1' => 'item_#1_data_1',
	'order_detail_column_2' => 'item_#1_data_2'
),
'c45147dee729311ef5b5c3003946c48f' => array(
	'order_detail_column_1' => 'item_#2_data_1',
	'order_detail_column_2' => 'item_#2_data_2'
)
);

$this->flexi_cart_admin->resave_order($custom_summary_data, $custom_item_data);
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