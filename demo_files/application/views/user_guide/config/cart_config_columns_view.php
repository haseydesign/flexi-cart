<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Cart Column Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for configuring cart columns in flexi cart."/> 
	<meta name="keywords" content="cart column configuration, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Cart Column Configuration</h1>
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

			<h2>Cart Column Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/cart_config_settings">Cart Settings Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_internal">Cart Internal Settings Config</a><br/>
			<a href="<?php echo $base_url; ?>user_guide/cart_config_index">Cart Config Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data">Get Cart Config Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data">Set Cart Config Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_admin">Cart Config Admin Data</a>

			<div class="anchor_nav">
				<h6>Standard Cart Column Settings</h6>
				<p>
					<a href="#required_columns">Required Cart Column Names</a> | <a href="#optional_columns">Optional Cart Column Names</a> | <a href="#reserved_columns">Reserved / Auto-calculated columns</a>
				</p>
				<h6>Custom Cart Column Settings</h6>
				<p>
					<a href="#updatable_columns">Updatable Cart Columns</a> | <a href="#custom_columns">User Defined Custom Cart Columns</a>
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
		
			<a name="required_columns"></a>
			<div class="w100 frame">
				<h3 class="heading">Required Cart Column Names</h3>
				
				<p>The following columns are the minimum required columns for the cart to function.</p>
				
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Internal Name</th>
							<th class="spacer_125">Default Alias</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>row_id</td>
							<td>row_id</td>
							<td class="align_ctr">string</td>
							<td>Items cart row identifier - set automatically.</td>
						</tr>
						<tr>
							<td>item</td>
							<td>id</td>
							<td class="align_ctr">int</td>
							<td>Items unique id, usually a database table row id.</td>
						</tr>
						<tr>
							<td>item_name</td>
							<td>name</td>
							<td class="align_ctr">string</td>
							<td>Items name and/or description.</td>
						</tr>
						<tr>
							<td>item_quantity</td>
							<td>quantity</td>
							<td class="align_ctr">int</td>
							<td>Quantity of items selected by user.</td>
						</tr>
						<tr>
							<td>item_price</td>
							<td>price</td>
							<td class="align_ctr">int</td>
							<td>Item selling price.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>These columns must each be set with a unique name.  Do not set them as 'FALSE' even if they are not used.</p>
				</div>
			</div>	

			<a name="optional_columns"></a>
			<div class="w100 frame">
				<h3 class="heading">Optional Cart Column Names</h3>
				
				<p>
					The following columns can optionally be set to define additional item data.<br/>
					Data manually added to these columns will overwrite any defaults set by the cart or that are available via a related database table.
				</p>
				
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Internal Name</th>
							<th class="spacer_125">Default Alias</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>item_weight</td>
							<td>weight</td>
							<td class="align_ctr">int</td>
							<td>Item unit weight that can be used to calculate shipping rates.</td>
						</tr>
						<tr>
							<td>item_tax_rate</td>
							<td>tax_rate</td>
							<td class="align_ctr">int</td>
							<td>Manually set a tax rate for the item.</td>
						</tr>
						<tr>
							<td>item_shipping_rate</td>
							<td>shipping_rate</td>
							<td class="align_ctr">int</td>
							<td>Manually set a shipping rate for the item.</td>
						</tr>
						<tr>
							<td>item_separate_shipping</td>
							<td>separate_shipping</td>
							<td class="align_ctr">int</td>
							<td>Manually set an item to have its shipping calculated separately from other cart items.</td>
						</tr>
						<tr>
							<td>item_options</td>
							<td>options</td>
							<td class="align_ctr">string | array</td>
							<td>Item option descriptions.</td>
						</tr>
						<tr>
							<td>item_reward_points</td>
							<td>reward_points</td>
							<td class="align_ctr">int</td>
							<td>Manually set reward points for the item.</td>
						</tr>
						<tr>
							<td>item_unique_status</td>
							<td>unique</td>
							<td class="align_ctr">bool</td>
							<td>Force item to have its own cart row, regardless of whether an identical item already exists in the cart.</td>
						</tr>
					</tbody>
				</table>
			</div>

			<a name="updatable_columns"></a>
			<div class="w100 frame">
				<h3 class="heading">Updatable Cart Columns</h3>
				
				<p>Define which cart columns can be updated for existing items in the cart.</p>
				<hr/>
				
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>As a security measure, cart columns can be prevented from being updated by the '<a href="<?php echo $base_url; ?>user_guide/cart_set_data#update_cart">update_cart()</a>' function.</p>
					<p>The purpose of this is prevent a potential html field being injected by a malicious user to an update cart form, with the aim of updating a cart column like the price, item shipping and tax rate columns with their own value.</p>
					<p>This is possible if updating cart columns using POST data with matching html input names.</p>
					<p>For example, if a html input field named 'price' (Default alias of 'item_price') was injected, and the cart was then updated by matching any identically named POST data, the data array would contain a key named 'price' that would then update the carts 'price' column.</p>
					<p>By defining which columns are updatable, the cart will ignore any submitted data from non-updatable columns.</p>
					<p>If the ability to update sensitive columns is required, ensure all data submitted is validated.</p>
				</div>

				<h6>Setting Updatable Cart Columns</h6>
				<div class="frame_note">
					<p>To set which cart columns are updatable, the <strong>column alias name</strong> (Not the internal name) must be added to the updatable columns array.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example of setting updatable cart columns by their alias.</span>
<span class="comment">// This examples sets the cart columns 'item_quantity' and 'item_options'.</span>

$config['cart']['items']['updatable_columns'] = array(
	'quantity', 'options'
);
</pre>
			</div>	
			
			<a name="reserved_columns"></a>
			<div class="w100 frame">
				<h3 class="heading">Reserved / Auto-calculated columns</h3>
				
				<p>
					These cart column names are reserved, so do not add any data to the cart using these array key names as the data will be removed.<br/>
					The values of these columns are automatically generated and calculated by the cart.
				</p>
				<hr/>
				
				<small>Note: The data types and default values shown are values that are stored in the carts actual session data, this is not to be confused with the array cart data that can be returned using some of the cart library functions. Many values returned from such functions are formatted for display purposes.</small>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_175">Internal Name</th>
							<th class="spacer_150">Default Alias</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>item_internal_price</td>
							<td>internal_price</td>
							<td class="align_ctr">int</td>
							<td>Item selling price as carts default currency and tax settings.</td>
						</tr>
						<tr>
							<td>item_price_total</td>
							<td>price_total</td>
							<td class="align_ctr">int</td>
							<td>Item sub-total price.</td>
						</tr>
						<tr>
							<td>item_tax</td>
							<td>tax</td>
							<td class="align_ctr">int</td>
							<td>Tax value per item.</td>
						</tr>
						<tr>
							<td>item_tax_total</td>
							<td>tax_total</td>
							<td class="align_ctr">int</td>
							<td>Item sub-total tax value.</td>
						</tr>
						<tr>
							<td>item_stock_quantity</td>
							<td>stock_quantity</td>
							<td class="align_ctr">int</td>
							<td>Quantity of items in stock.</td>
						</tr>
						<tr>
							<td>item_non_discount_quantity</td>
							<td>non_discount_quantity</td>
							<td class="align_ctr">int</td>
							<td>Quantity of items not included in discount.</td>
						</tr>
						<tr>
							<td>item_discount_quantity</td>
							<td>discount_quantity</td>
							<td class="align_ctr">int</td>
							<td>Quantity of items included in discount.</td>
						</tr>
						<tr>
							<td>item_discount_description</td>
							<td>discount_description</td>
							<td class="align_ctr">string</td>
							<td>Item discount description.</td>
						</tr>
						<tr>
							<td>item_discount_price</td>
							<td>discount_price</td>
							<td class="align_ctr">int</td>
							<td>Discount value per item.</td>
						</tr>
						<tr>
							<td>item_discount_price_total</td>
							<td>discount_price_total</td>
							<td class="align_ctr">int</td>
							<td>Item sub-total price of discounted and non discounted items.</td>
						</tr>
						<tr>
							<td>item_weight_total</td>
							<td>weight_total</td>
							<td class="align_ctr">int</td>
							<td>Item sub-total weight.</td>
						</tr>
						<tr>
							<td>item_reward_points_total</td>
							<td>reward_points_total</td>
							<td class="align_ctr">int</td>
							<td>Item sub-total reward points.</td>
						</tr>
						<tr>
							<td>item_status_message</td>
							<td>status_message</td>
							<td class="align_ctr">array</td>
							<td>Item status message.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Admin Data Cart Columns.</h6>
				<p>The following 2 columns are only available when updating/editing a confirmed order after using the '<a href="<?php echo $base_url; ?>user_guide/database_cart_data_admin#load_cart_data">load_cart_data()</a>' function.</p>
				<table>
					<thead>
						<tr>
							<th class="spacer_175">Internal Name</th>
							<th class="spacer_150">Default Alias</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>item_quantity_shipped</td>
							<td>quantity_shipped</td>
							<td class="align_ctr">int</td>
							<td>Quantity of items from a confirmed order that have been shipped.</td>
						</tr>
						<tr>
							<td>item_quantity_cancelled</td>
							<td>quantity_cancelled</td>
							<td class="align_ctr">int</td>
							<td>Quantity of items from a confirmed order that have been cancelled.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>These columns must each be set with a unique name.  Do not set them as 'FALSE' even if they are not used.</p>
				</div>
			</div>

			<a name="custom_columns"></a>
			<div class="w100 frame">
				<h3 class="heading">User Defined Custom Cart Columns</h3>
				
				<p>Define custom columns that can will automatically be added to the carts item session data when an item is added to the cart.</p>
				
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Parameter Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>name</td>
							<td class="align_ctr">string</td>
							<td>Sets the custom column name.</td>
						</tr>
						<tr>
							<td>required</td>
							<td class="align_ctr">bool</td>
							<td>Define whether data must be submitted when the item is inserted to the cart.</td>
						</tr>
						<tr>
							<td>regex</td>
							<td class="align_ctr">string</td>
							<td>
								Sets a regular expression that the columns value must be validated against when the item is inserted or updated.<br/>
								Set FALSE to disable validation.
							</td>
						</tr>
						<tr>
							<td>decimals</td>
							<td class="align_ctr">int</td>
							<td>
								Defines the number of decimal places the column value should be formatted to.<br/>
								Applies to numeric data only. Set FALSE to disable formatting.
							</td>
						</tr>
						<tr>
							<td>default</td>
							<td class="align_ctr">anything</td>
							<td>Defines the default value of the column if no value is added when the item is inserted to the cart.</td>
						</tr>
						<tr>
							<td>updatable</td>
							<td class="align_ctr">bool</td>
							<td>Defines whether data can be updated after item has been inserted to the cart.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>Additional user defined columns can be manually added to an items data array by including additional array keys (column names) and values when adding an item to the cart.</p>
					<p>However, unless the custom column is defined via the config. files 'custom_columns' array, the column will only be present if data is submitted.</p>
					<p>By pre-defining custom columns, you can format numbers, set default values and specify if a column is required when an item is added.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining 1 custom cart column.</span>

$config['cart']['items']['custom_columns'] = array(
array(
	'name' => 'example_custom_column', 
	'required' => FALSE, 
	'regex' => '\.a-z0-9_-', 
	'decimals' => FALSE, 
	'default' => NULL, 
	'updatable'=> TRUE
)
);
</pre>
<pre>
<span class="comment bold">// Example #2 : Defining multiple custom cart columns.</span>

$config['cart']['items']['custom_columns'] = array(
array(
	'name' => 'example_custom_column_1', 
	'required' => FALSE, 
	'regex' => '\.a-z0-9_-', 
	'decimals' => FALSE, 
	'default' => NULL, 
	'updatable'=> TRUE
),
array(
	'name' => 'example_custom_column_2', 
	'required' => TRUE, 
	'regex' => FALSE, 
	'decimals' => 2, 
	'default' => 0, 
	'updatable'=> TRUE
)
);
</pre>
<pre>
<span class="comment bold">// Example #3 : Disabling the custom columns feature.</span>

$config['cart']['items']['custom_columns'] = FALSE;
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