<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Cart Item Session Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for cart item session data functions in flexi cart."/> 
	<meta name="keywords" content="cart item session data functions, user guide, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="user_guide">

<div id="body_wrap" class="fixed_footer">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- User Guide Navigation -->
	<?php $this->load->view('includes/user_guide_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>User Guide | Getting Cart Item Session Data</h1>
				<p>
					When the flexi cart library is first loaded, an array is automatically created that is setup to match the carts default settings, this data is then stored in the browsers session. All items and settings that are then later added and altered within the cart are updated to the carts session data.
				</p>
				<p>
					The data within the carts session can then be accessed and in many cases, formatted and customised using the large range of functions that are available from the lite and standard libraries.
				</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div id="user_guide_content" class="content clearfix">
			
			<h2>Get Cart Item Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/cart_index">List all Cart Functions</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data">Get Cart Summary Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_session_data">Get Cart Session Data</a> | 
			<a href="<?php echo $base_url; ?>user_guide/cart_helper_data">Get Cart Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_set_data">Set Cart Session Data</a>

			<div class="anchor_nav">
				<h6>Get Cart Item Data from Session</h6>
				<p>
					<a href="#row_id_exists">row_id_exists()</a> | <a href="#cart_items">cart_items()</a> | <a href="#cart_item_row">cart_item_row()</a> | <a href="#cart_item_array">cart_item_array()</a>
				</p>
				<h6>Get Basic Item Data from Session</h6>
				<p>
					<a href="#item_id">item_id()</a> | <a href="#item_name">item_name()</a> | <a href="#item_quantity">item_quantity()</a> | <a href="#item_price">item_price()</a> | <a href="#item_price_total">item_price_total()</a> | <a href="#item_option_status">item_option_status()</a> | <a href="#item_options">item_options()</a> | <a href="#xxx">item_options_array()</a>
				</p>
				<h6>Get Item Tax Data from Session</h6>
				<p>
					<a href="#item_tax_rate">item_tax_rate()</a> | <a href="#item_tax">item_tax()</a> | <a href="#item_tax_total">item_tax_total()</a>
				</p>
				<h6>Get Item Shipping Data from Session</h6>
				<p>
					<a href="#item_shipping_status">item_shipping_status()</a> | <a href="#item_shipping_rate">item_shipping_rate()</a>
				</p>
				<h6>Get Item Stock Data from Session</h6>
				<p>
					<a href="#item_stock_status">item_stock_status()</a> | <a href="#item_stock_quantity">item_stock_quantity()</a>
				</p>
				<h6>Get Item Reward Point Data from Session</h6>
				<p>
					<a href="#item_reward_points">item_reward_points()</a> | <a href="#item_reward_points_total">item_reward_points_total()</a>
				</p>
				<h6>Get Item Weight Data from Session</h6>
				<p>
					<a href="#item_weight">item_weight()</a> | <a href="#item_weight_total">item_weight_total()</a>
				</p>
				<h6>Get Item Discount Data from Session</h6>
				<p>
					<a href="#item_discount_status">item_discount_status()</a> | <a href="#item_discount_data">item_discount_data()</a> | <a href="#item_discount_id">item_discount_id()</a> | <a href="#item_discount_description">item_discount_description()</a> | <a href="#item_non_discount_quantity">item_non_discount_quantity()</a> | <a href="#item_discount_quantity">item_discount_quantity()</a> | <a href="#item_discount_price">item_discount_price()</a> | <a href="#item_discount_price_total">item_discount_price_total()</a> | <a href="#item_non_discount_price_total">item_non_discount_price_total()</a> | <a href="#item_discount_total">item_discount_total()</a> | <a href="#item_savings">item_savings()</a> | <a href="#item_savings_total">item_savings_total()</a>
				</p>
				<h6>Get Item Status Messages</h6>
				<p>
					<a href="#item_status_message">item_status_message()</a> | <a href="#item_status_message_array">item_status_message_array()</a>
				</p>
				<h6>Get Custom Item Columns</h6>
				<p>
					<a href="#get_item_column">get_item_column()</a>
				</p>
				<h6>Get Admin Data from Session</h6>
				<p>
					<a href="#item_admin_data_status">item_admin_data_status()</a> | <a href="#item_shipped_quantity">item_shipped_quantity()</a> | <a href="#item_cancelled_quantity">item_cancelled_quantity()</a>
				</p>
			</div>
				
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with Session Data Functions</h3>
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
			
			<div id="ajax_content">
			
				<a name="row_id_exists"></a>
				<div class="w100 frame">
					<h3 class="heading">row_id_exists()</h3>
					
					<p>Returns whether a row id exists in the cart item array.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>
					
					<h6>Function Parameters</h6>
					<code>row_id_exists(row_id)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Notes</h6>
					<div class="frame_note">
						<p>Note: The 'row_id' is not the same as the 'id' that would be used to identify items within the database.</p>
					</div>	
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Does Not Exist:</strong>FALSE</p>
						<p><strong class="spacer_125">Does Exist:</strong>TRUE</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>row_id_exists($row_id)</code>
								<small>Does the row id of '<?php echo $row_id; ?>' exist within the cart?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->row_id_exists($row_id));?></td>
						</tr>
						<tr>
							<td>
								<code>row_id_exists('none_existent_row')</code>
								<small>Does a row id of 'none_existent_row' exist within the cart?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->row_id_exists('none_existent_row'));?></td>
						</tr>
					</table>
				</div>

				<a name="cart_items"></a>
				<div class="w100 frame">
					<h3 class="heading">cart_items()</h3>
					
					<p>Returns the entire cart item data, formatted by function parameters.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>cart_items(inc_discount, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>inc_discount</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Define whether the returned value should include any active discount.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned values as currencies and weights.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
				
					<h6>How it Works</h6>
					<div class="frame_note">
						<p>The function loops through each item in the cart and calls the '<a href="#cart_item_row">cart_item_row()</a>'
						 function, which in turn calls many other functions available via the lite library to return data on item quantities, pricing, shipping, taxes, discounts, reward points and weights for each item.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>array (Empty)</p>
						<p><strong class="spacer_125">Success:</strong>array</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>cart_items(TRUE, TRUE, FALSE)</code>
								<small>Return the <span class="uline">current</span> item cart data array, including any set discounts.</small>
								<span class="toggle tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">Show / Hide Array</span>
								<pre class="hide_toggle"><?php print_r($this->flexi_cart->cart_contents(TRUE, TRUE, FALSE));?></pre>
							</td>
						</tr>
						<tr>
							<td>
								<code>cart_items(TRUE, TRUE, TRUE)</code>
								<small>Return the <span class="uline">internal</span> item cart data array, including any set discounts.</small>
								<span class="toggle">Show / Hide Array</span>
								<pre class="hide_toggle"><?php print_r($this->flexi_cart->cart_contents(TRUE, TRUE, TRUE));?></pre>
							</td>
						</tr>
					</table>
				</div>

				<a name="cart_item_row"></a>
				<div class="w100 frame">
					<h3 class="heading">cart_item_row()</h3>
					
					<p>Returns a specific cart item row, formatted by function parameters.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>cart_item_row(row_id, inc_discount, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>inc_discount</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Define whether the returned value should include any active discount.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned values as currencies and weights.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
				
					<h6>How it Works</h6>
					<div class="frame_note">
						<p>The function calls many of the item data functions that are available via the lite library related to item quantities, pricing, shipping, taxes, discounts, reward points and weights. The data is then grouped together and returned as an array.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>array (Empty)</p>
						<p><strong class="spacer_125">Success:</strong>array</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>cart_item_row($row_id, TRUE, TRUE, FALSE)</code>
								<small>Return the <span class="uline">current</span> cart data array for a specific row, including any set discounts.</small>
								<span class="toggle tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">Show / Hide Array</span>
								<pre class="hide_toggle"><?php print_r($this->flexi_cart->cart_item_row($row_id, TRUE, TRUE, FALSE));?></pre>
							</td>
						</tr>
						<tr>
							<td>
								<code>cart_item_row($row_id, TRUE, TRUE, TRUE)</code>
								<small>Return the <span class="uline">internal</span> cart data array for a specific row, including any set discounts.</small>
								<span class="toggle">Show / Hide Array</span>
								<pre class="hide_toggle"><?php print_r($this->flexi_cart->cart_item_row($row_id, TRUE, TRUE, TRUE));?></pre>
							</td>
						</tr>
					</table>					
				</div>

				<a name="cart_item_array"></a>
				<div class="w100 frame">
					<h3 class="heading">cart_item_array()</h3>
					
					<p>Returns the cart data array for either a particular item row in the cart, or the entire cart item array.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>cart_item_array(row_id)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
						</tbody>
					</table>
			
					<h6>Notes</h6>
					<div class="frame_note">
						<p>The data returned by this function is the carts actual item session data. It is not formatted and no values include any applied discounts.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>array (Empty)</p>
						<p><strong class="spacer_125">Success:</strong>array</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>cart_item_array()</code>
								<small>Return the unformatted internal data for <span class="uline">all item rows</span>.</small>
								<span class="toggle">Show / Hide Array</span>
								<pre class="hide_toggle"><?php print_r($this->flexi_cart->cart_item_array());?></pre>
							</td>
						</tr>
						<tr>
							<td>
								<code>cart_item_array($row_id)</code>
								<small>Return the unformatted internal data for <span class="uline">a specific row</span>.</small>
								<span class="toggle">Show / Hide Array</span>
								<pre class="hide_toggle"><?php print_r($this->flexi_cart->cart_item_array($row_id));?></pre>
							</td>
						</tr>
					</table>					
				</div>

				<a name="item_id"></a>
				<div class="w100 frame">
					<h3 class="heading">item_id()</h3>
					
					<p>Return an items id for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_id(row_id)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Notes</h6>
					<div class="frame_note">
						<p>The id is typically the primary key within the databases item table.</p>
						<p>Note: The 'item_id' is not the same as the 'row_id' that would be used to identify a row within the cart.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_id($row_id)</code>
								<small>What is this items id?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_id($row_id);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_name"></a>
				<div class="w100 frame">
					<h3 class="heading">item_name()</h3>
					
					<p>Return an items name for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_name(row_id)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>string</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_name($row_id)</code>
								<small>What is this items name?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_name($row_id);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_quantity"></a>
				<div class="w100 frame">
					<h3 class="heading">item_quantity()</h3>
					
					<p>Returns the quantity of items for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_quantity(row_id, inc_discount, format)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>inc_discount</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>
									Define whether the returned value should include any active discount.<br/>
									'TRUE' returns the total of all discounted and non-discounted items.<br/>
									'FALSE' returns the total quantity of non-discounted items.
								</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_quantity($row_id, FALSE, TRUE) </code>
								<small>What is the quantity of items, regardless of discounted quantities?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_quantity($row_id, FALSE, TRUE);?></td>
						</tr>
						<tr>
							<td>
								<code>item_quantity($row_id, TRUE, TRUE)</code>
								<small>What quantity of items have not been discounted?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_quantity($row_id, TRUE, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_price"></a>
				<div class="w100 frame">
					<h3 class="heading">item_price()</h3>
					
					<p>Returns the price of an item for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_price(row_id, inc_discount, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>inc_discount</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Define whether the returned value should include any active discount.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Notes</h6>
					<div class="frame_note">
						<p>If the 'inc_discount' parameter is set to 'TRUE', this function returns the same value as the '<a href="#item_discount_price">item_discount_price()</a>' function.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_price($row_id, TRUE, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> price, <span class="uline">including</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_price($row_id, TRUE, TRUE, FALSE);?>
								</span>	
							</td>
						</tr>
						<tr>
							<td>
								<code>item_price($row_id, FALSE, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> price, <span class="uline">excluding</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_price($row_id, FALSE, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_price($row_id, TRUE, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> price, <span class="uline">including</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_price($row_id, TRUE, TRUE, TRUE);?></td>
						</tr>
						<tr>
							<td>
								<code>item_price($row_id, FALSE, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> price, <span class="uline">excluding</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_price($row_id, FALSE, TRUE, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_price_total"></a>
				<div class="w100 frame">
					<h3 class="heading">item_price_total()</h3>
					
					<p>Returns the total price of an item for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_price_total(row_id, inc_discount, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>inc_discount</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Define whether the returned value should include any active discount.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Notes</h6>
					<div class="frame_note">
						<p>If the 'inc_discount' parameter is set to 'TRUE', this function returns the same value as the '<a href="#item_discount_price_total">item_discount_price_total()</a>' function.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_price_total($row_id, TRUE, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> price total, <span class="uline">including</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_price_total($row_id, TRUE, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_price_total($row_id, FALSE, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> price total, <span class="uline">excluding</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_price_total($row_id, FALSE, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_price_total($row_id, TRUE, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> price total, <span class="uline">including</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_price_total($row_id, TRUE, TRUE, TRUE);?></td>
						</tr>
						<tr>
							<td>
								<code>item_price_total($row_id, FALSE, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> price total, <span class="uline">excluding</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_price_total($row_id, FALSE, TRUE, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_tax_rate"></a>
				<div class="w100 frame">
					<h3 class="heading">item_tax_rate()</h3>
					
					<p>Returns an items tax rate for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_tax_rate(row_id, format, fallback_default)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a percentage.</td>
							</tr>
							<tr>
								<td>fallback_default</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Defines whether to return the carts default tax rate if the item does not have a specific tax rate applied to it.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">No Rate Defined:</strong>FALSE</p>
						<p><strong class="spacer_125">Rate Defined:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_tax_rate($row_id, TRUE, TRUE)</code>
								<small>
									Using the cart data array, what is the current items tax rate?<br/> 
									If nothing is specifically set for this item, return the carts current tax rate.
								</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_tax_rate = $this->flexi_cart->item_tax_rate($row_id, TRUE, TRUE)) {
									echo $item_tax_rate;
								} else {
									var_dump($item_tax_rate);
								}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_tax_rate($row_id, TRUE, FALSE)</code>
								<small>
									Using the cart data array, what is the current items tax rate?<br/> 
									If nothing is specifically set for this item, return FALSE.
								</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_tax_rate = $this->flexi_cart->item_tax_rate($row_id, TRUE, FALSE)) {
									echo $item_tax_rate;
								} else {
									var_dump($item_tax_rate);
								}
							?>
							</td>
						</tr>
					</table>
				</div>				

				<a name="item_tax"></a>
				<div class="w100 frame">
					<h3 class="heading">item_tax()</h3>
					
					<p>Returns an items tax value for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_tax(row_id, inc_discount, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>inc_discount</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Define whether the returned value should include any active discount.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_tax($row_id, TRUE, TRUE, FALSE) </code>
								<small>What is this items <span class="uline">current</span> tax value, <span class="uline">including</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_tax($row_id, TRUE, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_tax($row_id, FALSE, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> tax value, <span class="uline">excluding</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_tax($row_id, FALSE, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_tax($row_id, TRUE, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> tax value, <span class="uline">including</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_tax($row_id, TRUE, TRUE, TRUE);?></td>
						</tr>
						<tr>
							<td>
								<code>item_tax($row_id, FALSE, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> tax value, <span class="uline">excluding</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_tax($row_id, FALSE, TRUE, TRUE);?></td>
						</tr>
					</table>
				</div>				

				<a name="item_tax_total"></a>
				<div class="w100 frame">
					<h3 class="heading">item_tax_total()</h3>
					
					<p>Returns an items total tax value for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_tax_total(row_id, inc_discount, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>inc_discount</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Define whether the returned value should include any active discount.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_tax_total($row_id, TRUE, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> tax value total, <span class="uline">including</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_tax_total($row_id, TRUE, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_tax_total($row_id, FALSE, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> tax value total, <span class="uline">excluding</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_tax_total($row_id, FALSE, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_tax_total($row_id, TRUE, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> tax value total, <span class="uline">including</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_tax_total($row_id, TRUE, TRUE, TRUE);?></td>
						</tr>
						<tr>
							<td>
								<code>item_tax_total($row_id, FALSE, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> tax value total, <span class="uline">excluding</span> any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_tax_total($row_id, FALSE, TRUE, TRUE);?></td>
						</tr>
					</table>
				</div>				

				<a name="item_shipping_status"></a>
				<div class="w100 frame">
					<h3 class="heading">item_shipping_status()</h3>
					
					<p>Returns whether an item in the cart is permitted to be shipped to the current shipping location.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_shipping_status(row_id)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">'row_id' Not Found:</strong>FALSE</p>
						<p><strong class="spacer_125">Item Banned:</strong>FALSE</p>
						<p><strong class="spacer_125">Item Permitted:</strong>TRUE</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_shipping_status($row_id)</code>
								<small>Using the cart data array, can this item be shipped to the current location?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->item_shipping_status($row_id));?></td>
						</tr>
					</table>
				</div>

				<a name="item_shipping_rate"></a>
				<div class="w100 frame">
					<h3 class="heading">item_shipping_rate()</h3>
					
					<p>Returns an items shipping rate for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_shipping_rate(row_id, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
				
					<h6>Notes</h6>
					<div class="frame_note">
						<p>
							By default the shipping rate of an item added to the cart is 'FALSE'.<br/>
							A rate of '0' means the item ships for free.<br/>
							A rate of more than '0' means the item has a shipping surcharge that is added to the carts shipping rate.
						</p>
					</div>
				
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_shipping_rate($row_id, TRUE, FALSE)</code>
								<small>Using the cart data array, what is the <span class="uline">current</span> shipping rate for this item?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
							<?php 
								$item_shipping_rate = $this->flexi_cart->item_shipping_rate($row_id, TRUE, FALSE);
								if ($item_shipping_rate !== FALSE)
								{
									echo $item_shipping_rate;
								}
								else
								{
									var_dump($item_shipping_rate);
								}
							?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_shipping_rate($row_id, TRUE, TRUE)</code>
								<small>Using the cart data array, what is the <span class="uline">internal</span> shipping rate for this item?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								$item_shipping_rate = $this->flexi_cart->item_shipping_rate($row_id, TRUE, TRUE);
								if ($item_shipping_rate !== FALSE)
								{
									echo $item_shipping_rate;
								}
								else
								{
									var_dump($item_shipping_rate);
								}
							?>
							</td>
						</tr>
					</table>
				</div>

				<a name="item_stock_status"></a>
				<div class="w100 frame">
					<h3 class="heading">item_stock_status()</h3>
					
					<p>Returns whether an item is in-stock for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Requires the item stock database table to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_stock_status(row_id, deduct_cart_quantity, apply_quantity)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>deduct_cart_quantity</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to deduct the current quantity of matching items in the cart, from the items stock quantity.</td>
							</tr>
							<tr>
								<td>apply_quantity</td>
								<td class="align_ctr">int</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">0</td>
								<td>Defines a positive or negative value that can be added or subtracted from the items stock quantity.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">No Value Set:</strong>FALSE</p>
						<p><strong class="spacer_125">Out-of-stock:</strong>FALSE</p>
						<p><strong class="spacer_125">In Stock:</strong>TRUE</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_stock_status($row_id, FALSE, 0)</code>
								<small>Using the cart data array, and <span class="uline">not deducting</span> any current item quantity present in the cart, is this item in stock?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->item_stock_status($row_id, FALSE, 0));?></td>
						</tr>
						<tr>
							<td>
								<code>item_stock_status($row_id, TRUE, 0)</code>
								<small>Using the cart data array, and <span class="uline">deducting</span> any current item quantity present in the cart, is this item in stock?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->item_stock_status($row_id, TRUE, 0));?></td>
						</tr>
						<tr>
							<td>
								<code>item_stock_status($row_id, FALSE, 50)</code>
								<small>Using the cart data array, and <span class="uline">adding a quantity of 50</span>, is this item in stock?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->item_stock_status($row_id, FALSE, 50));?></td>
						</tr>
						<tr>
							<td>
								<code>item_stock_status($row_id, FALSE, -100)</code>
								<small>Using the cart data array, and <span class="uline">subtracting a quantity of 100</span>, is this item in stock?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->item_stock_status($row_id, FALSE, -100));?></td>
						</tr>
					</table>
				</div>

				<a name="item_stock_quantity"></a>
				<div class="w100 frame">
					<h3 class="heading">item_stock_quantity()</h3>
					
					<p>Returns the quantity of in-stock items for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Requires the item stock database table to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_stock_quantity(row_id, deduct_cart_quantity, apply_quantity, format)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>deduct_cart_quantity</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to deduct the current quantity of matching items in the cart, from the items stock quantity.</td>
							</tr>
							<tr>
								<td>apply_quantity</td>
								<td class="align_ctr">int</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">0</td>
								<td>Defines a positive or negative value that can be added or subtracted from the items stock quantity.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">No Value Set:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_stock_quantity($row_id, FALSE, 0, TRUE)</code>
								<small>Using the cart data array, and <span class="uline">not deducting</span> any current item quantity present in the cart, what is the stock quantity of this item?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_stock_quantity = $this->flexi_cart->item_stock_quantity($row_id, FALSE, 0, TRUE))
								{
									echo $item_stock_quantity;
								}
								else
								{
									var_dump($item_stock_quantity);
								}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_stock_quantity($row_id, TRUE, 0, TRUE)</code>
								<small>Using the cart data array, and <span class="uline">deducting</span> any current item quantity present in the cart, what is the stock quantity of this item?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_stock_quantity = $this->flexi_cart->item_stock_quantity($row_id, TRUE, 0, TRUE))
								{
									echo $item_stock_quantity;
								}
								else
								{
									var_dump($item_stock_quantity);
								}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_stock_quantity($row_id, FALSE, 50, TRUE)</code>
								<small>Using the cart data array, and <span class="uline">adding a quantity of 50</span>, what is the stock quantity of this item?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_stock_quantity = $this->flexi_cart->item_stock_quantity($row_id, FALSE, 50, TRUE))
								{
									echo $item_stock_quantity;
								}
								else
								{
									var_dump($item_stock_quantity);
								}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_stock_quantity($row_id, FALSE, -100, TRUE)</code>
								<small>Using the cart data array, and <span class="uline">subtracting a quantity of 100</span>, what is the stock quantity of this item?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_stock_quantity = $this->flexi_cart->item_stock_quantity($row_id, FALSE, -100, TRUE))
								{
									echo $item_stock_quantity;
								}
								else
								{
									var_dump($item_stock_quantity);
								}
							?>
							</td>
						</tr>
					</table>
				</div>
				
				<a name="item_option_status"></a>
				<div class="w100 frame">
					<h3 class="heading">item_option_status()</h3>
					
					<p>Returns whether an item has any options, for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_option_status(row_id)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Has No Options:</strong>FALSE</p>
						<p><strong class="spacer_125">Has Options:</strong>TRUE</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_option_status($row_id)</code>
								<small>Are there any options set for this item?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->item_option_status($row_id));?></td>
						</tr>
					</table>					
				</div>

				<a name="item_options"></a>
				<div class="w100 frame">
					<h3 class="heading">item_options()</h3>
					
					<p>Returns an items options as a formatted string for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_options(row_id, include_keys, option_separator)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>include_keys</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to include the options array keys as part of the options description.</td>
							</tr>
							<tr>
								<td>option_separator</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">', '</td>
								<td>
									Defines the character(s) to separate each option.<br/>
									The character is only applied to item options saved as an array.
								</td>
							</tr>
						</tbody>
					</table>
										
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>string</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_options($row_id, TRUE, ', ')</code>
								<small>Display the options that are available for this item, using the <span class="uline">array keys for labels</span> and with other options displayed <span class="uline">inline</span>.</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_options = $this->flexi_cart->item_options($row_id, TRUE, ', '))
								{
									echo $item_options;
								}
								else
								{
									var_dump($item_options);
								}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_options($row_id, FALSE, ', ')</code>
								<small>Display the options that are available for this item, with other options displayed <span class="uline">inline</span>, whilst <span class="uline">ignoring the array keys</span>.</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_options = $this->flexi_cart->item_options($row_id, FALSE, ', '))
								{
									echo $item_options;
								}
								else
								{
									var_dump($item_options);
								}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_options($row_id, TRUE, '<?php echo htmlentities('<br/>');?>')</code>
								<small>Display the options that are available for this item, using the <span class="uline">array keys for labels</span> and with other options displayed with <span class="uline">line breaks</span>.</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_options = $this->flexi_cart->item_options($row_id, TRUE, '<br/>'))
								{
									echo $item_options;
								}
								else
								{
									var_dump($item_options);
								}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_options($row_id, FALSE, '<?php echo htmlentities('<br/>');?>')</code>
								<small>Display the options that are available for this item, with other options displayed with <span class="uline">line breaks</span>, whilst <span class="uline">ignoring the array keys</span>.</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_options = $this->flexi_cart->item_options($row_id, FALSE, '<br/>'))
								{
									echo $item_options;
								}
								else
								{
									var_dump($item_options);
								}
							?>
							</td>
						</tr>
					</table>					
				</div>

				<a name="item_options_array"></a>
				<div class="w100 frame">
					<h3 class="heading">item_options_array()</h3>
					
					<p>Returns an array of an items options for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_options_array(row_id)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>array (Empty)</p>
						<p><strong class="spacer_125">Success:</strong>array</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_options_array($row_id)</code>
								<small>Display this items options as an array.</small>
								<span class="toggle">Show / Hide Array</span>
								<pre class="hide_toggle"><?php print_r($this->flexi_cart->item_options_array($row_id));?></pre>
							</td>
						</tr>
					</table>					
				</div>

				<a name="item_reward_points"></a>
				<div class="w100 frame">
					<h3 class="heading">item_reward_points()</h3>
					
					<p>Returns an items reward points for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_reward_points(row_id, format)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value with 'thousand' and 'decimal' characters.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_reward_points($row_id, TRUE)</code>
								<small>How many reward points would be earnt by purchasing this item?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_reward_points($row_id, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_reward_points_total"></a>
				<div class="w100 frame">
					<h3 class="heading">item_reward_points_total()</h3>
					
					<p>Returns an items total reward points for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_reward_points_total(row_id, format)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value with 'thousand' and 'decimal' characters.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_reward_points_total($row_id, TRUE)</code>
								<small>What is the total reward points that would be earnt by purchasing this item?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_reward_points_total($row_id, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_weight"></a>
				<div class="w100 frame">
					<h3 class="heading">item_weight()</h3>
					
					<p>Returns an items weight for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_weight(row_id, weight_type, format, decimals)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>weight_type</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>
									Defines the weight type that the items weight should be returned as.<br/>
									Available weight types are '<em>gram</em>', '<em>kilogram</em>', '<em>avoir_ounce</em>', '<em>avoir_pound</em>', '<em>troy_ounce</em>', '<em>troy_pound</em>' and '<em>carat</em>'.								
								</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a weight.</td>
							</tr>
							<tr>
								<td>decimals</td>
								<td class="align_ctr">int</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines the number of decimals to return the value with.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_weight($row_id, FALSE, TRUE, 0)</code>
								<small>What is this items weight displayed using the carts default weight settings?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_weight($row_id, FALSE, TRUE, 0);?></td>
						</tr>
						<tr>
							<td>
								<code>item_weight($row_id, 'kilogram', TRUE, 2)</code>
								<small>What is this items weight displayed in Kilograms to 2 decimal points?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_weight($row_id, 'kilogram', TRUE, 2);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_weight_total"></a>
				<div class="w100 frame">
					<h3 class="heading">item_weight_total()</h3>
					
					<p>Returns an items total weight for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_weight_total(row_id, weight_type, format, decimals)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>weight_type</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>
									Defines the weight type that the items weight should be returned as.<br/>
									Available weight types are '<em>gram</em>', '<em>kilogram</em>', '<em>avoir_ounce</em>', '<em>avoir_pound</em>', '<em>troy_ounce</em>', '<em>troy_pound</em>' and '<em>carat</em>'.								
								</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a weight.</td>
							</tr>
							<tr>
								<td>decimals</td>
								<td class="align_ctr">int</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines the number of decimals to return the value with.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_weight_total($row_id, FALSE, TRUE, 0)</code>
								<small>What is this items total weight displayed using the carts default weight settings?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_weight_total($row_id, FALSE, TRUE, 0);?></td>
						</tr>
						<tr>
							<td>
								<code>item_weight_total($row_id, 'kilogram', TRUE, 2)</code>
								<small>What is this items total weight displayed in Kilograms to 2 decimal points?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_weight_total($row_id, 'kilogram', TRUE, 2);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_discount_status"></a>
				<div class="w100 frame">
					<h3 class="heading">item_discount_status()</h3>
					
					<p>Returns whether an item has a discount applied for a specific row.</p> 
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Item based discounts cannot be set unless the discount database tables are enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_discount_status(row_id, inc_shipping_discount)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>inc_shipping_discount</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to regard an item shipping discount as a discount.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Not Discounted:</strong>FALSE</p>
						<p><strong class="spacer_125">Discounted:</strong>TRUE</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_discount_status($row_id, FALSE)</code>
								<small>Is this item currently discounted, <span class="uline">excluding</span> shipping discounts?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->item_discount_status($row_id, TRUE));?></td>
						</tr>
						<tr>
							<td>
								<code>item_discount_status($row_id, TRUE)</code>
								<small>Is this item currently discounted, <span class="uline">including</span> shipping discounts?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->item_discount_status($row_id, FALSE));?></td>
						</tr>
					</table>					
				</div>

				<a name="item_discount_data"></a>
				<div class="w100 frame">
					<h3 class="heading">item_discount_data()</h3>
					
					<p>Returns an array of discount values and descriptions for a specific cart row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Item based discounts cannot be set unless the discount database tables are enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_discount_data(row_id, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_100">Failure:</strong>FALSE</p>
						<p><strong class="spacer_100">Success:</strong>array</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_discount_data($row_id, TRUE, FALSE)</code>
								<small>Display the <span class="uline">current</span> discount value and description for any discounts set on this item.</small>
								<span class="toggle tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">Show / Hide Array</span>
								<pre class="hide_toggle"><?php print_r($this->flexi_cart->item_discount_data($row_id, TRUE, FALSE));?></pre>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_discount_data($row_id, TRUE, TRUE)</code>
								<small>Display the <span class="uline">internal</span> discount value and description for any discounts set on this item.</small>
								<span class="toggle tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">Show / Hide Array</span>
								<pre class="hide_toggle"><?php print_r($this->flexi_cart->item_discount_data($row_id, TRUE, TRUE));?></pre>
							</td>
						</tr>
					</table>
				</div>					
				
				<a name="item_discount_id"></a>
				<div class="w100 frame">
					<h3 class="heading">item_discount_id()</h3>
					
					<p>Returns the id of any discount that may have been applied to the item of a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Item based discounts cannot be set unless the discount database tables are enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_discount_id(row_id)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_discount_id($row_id)</code>
								<small>What is the id of this items discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_discount_id = $this->flexi_cart->item_discount_id($row_id))
								{
									echo $item_discount_id;
								}
								else
								{
									var_dump($item_discount_id);
								}						
							?>
							</td>
						</tr>
					</table>					
				</div>

				<a name="item_discount_description"></a>
				<div class="w100 frame">
					<h3 class="heading">item_discount_description()</h3>
					
					<p>Returns a description of a discount that may have been applied to the item of a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Item based discounts cannot be set unless the discount database tables are enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_discount_description(row_id)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>string</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_discount_description($row_id)</code>
								<small>What is the description of this items discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_discount_description = $this->flexi_cart->item_discount_description($row_id))
								{
									echo $item_discount_description;
								}
								else
								{
									var_dump($item_discount_description);
								}						
							?>
							</td>
						</tr>
					</table>					
				</div>

				<a name="item_non_discount_quantity"></a>
				<div class="w100 frame">
					<h3 class="heading">item_non_discount_quantity()</h3>
					
					<p>Returns the quantity of non-discounted items for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Item based discounts cannot be set unless the discount database tables are enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_non_discount_quantity(row_id, format)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_non_discount_quantity($row_id, TRUE)</code>
								<small>What quantity of items have not been discounted?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_non_discount_quantity($row_id, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_discount_quantity"></a>
				<div class="w100 frame">
					<h3 class="heading">item_discount_quantity()</h3>
					
					<p>Returns the quantity of discounted items for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Item based discounts cannot be set unless the discount database tables are enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_discount_quantity(row_id, format)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_discount_quantity($row_id, TRUE)</code>
								<small>What quantity of items have been discounted?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_discount_quantity($row_id, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_discount_price"></a>
				<div class="w100 frame">
					<h3 class="heading">item_discount_price()</h3>
					
					<p>Returns the discount price of one item for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Item based discounts cannot be set unless the discount database tables are enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_discount_price(row_id, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Notes</h6>
					<div class="frame_note">
						<p>This function returns the same value as the '<a href="#item_price">item_price()</a>' function when its 'inc_discount' parameter is set to 'TRUE'.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_discount_price($row_id, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> discounted price?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_discount_price($row_id, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_discount_price($row_id, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> discounted price?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_discount_price($row_id, TRUE, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_discount_total"></a>
				<div class="w100 frame">
					<h3 class="heading">item_discount_total()</h3>
					
					<p>Returns the total value of all discounted items only (non discounted items are excluded) for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Item based discounts cannot be set unless the discount database tables are enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_discount_total(row_id, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_discount_total($row_id, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> price total of discounted items?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_discount_total($row_id, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_discount_total($row_id, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> price total of discounted items?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_discount_total($row_id, TRUE, TRUE);?></td>
						</tr>
					</table>					
				</div>
				
				<a name="item_discount_price_total"></a>
				<div class="w100 frame">
					<h3 class="heading">item_discount_price_total()</h3>
					
					<p>Returns the total price of a rows non-discounted and discounted items.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Item based discounts cannot be set unless the discount database tables are enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_discount_price_total(row_id, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Notes</h6>
					<div class="frame_note">
						<p>This function returns the same value as the '<a href="#item_price_total">item_price_total()</a>' function when its 'inc_discount' parameter is set to 'TRUE'.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_discount_price_total($row_id, TRUE, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> price total, including any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_discount_price_total($row_id, TRUE, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_discount_price_total($row_id, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> price total, including any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_discount_price_total($row_id, TRUE, TRUE, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_non_discount_price_total"></a>
				<div class="w100 frame">
					<h3 class="heading">item_non_discount_price_total()</h3>
					
					<p>Returns the total price of a rows non-discounted items.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Item based discounts cannot be set unless the discount database tables are enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_non_discount_price_total(row_id, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_non_discount_price_total($row_id, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> price total of non-discounted items?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_non_discount_price_total($row_id, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_non_discount_price_total($row_id, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> price total of non-discounted items?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_non_discount_price_total($row_id, TRUE, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_savings"></a>
				<div class="w100 frame">
					<h3 class="heading">item_savings()</h3>
					
					<p>Returns the savings value of a discount applied to one item from a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_savings(row_id, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_savings($row_id, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> savings value on any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_savings($row_id, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_savings($row_id, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> savings value on any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_savings($row_id, TRUE, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_savings_total"></a>
				<div class="w100 frame">
					<h3 class="heading">item_savings_total()</h3>
					
					<p>Returns the total savings value of a discount applied to a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_savings_total(row_id, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_savings_total($row_id, TRUE, FALSE)</code>
								<small>What is this items <span class="uline">current</span> total savings value on any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->item_savings_total($row_id, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>item_savings_total($row_id, TRUE, TRUE)</code>
								<small>What is this items <span class="uline">internal</span> total savings value on any set discount?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_savings_total($row_id, TRUE, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_status_message"></a>
				<div class="w100 frame">
					<h3 class="heading">item_status_message()</h3>
					
					<p>Returns an items status message formatted as a string, for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_status_message(row_id, css_class)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>css_class</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>
									Defines a HTML class that will be wrapped around the status as a <?php echo htmlentities('<span>');?> element.<br/>
									The class can then be used to style the message using CSS.
								</td>
							</tr>
						</tbody>
					</table>

					<h6>Notes</h6>
					<div class="frame_note">
						<p>Item status messages are generated for 'stock' and 'shipping ban' messages.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>string</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_status_message($row_id, FALSE)</code>
								<small>Display any set status message for this item.</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_status_msg = $this->flexi_cart->item_status_message($row_id, FALSE))
								{
									echo $item_status_msg;
								}
								else
								{
									var_dump($item_status_msg);
								}
							?>
							</td>
						</tr>
					</table>					
				</div>

				<a name="item_status_message_array"></a>
				<div class="w100 frame">
					<h3 class="heading">item_status_message_array()</h3>
					
					<p>Returns an items status message formatted as an array, for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_status_message_array(row_id)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
						</tbody>
					</table>

					<h6>Notes</h6>
					<div class="frame_note">
						<p>Item status messages are generated for 'stock' and 'shipping ban' messages.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>array (Empty)</p>
						<p><strong class="spacer_125">Success:</strong>array</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_status_message_array($row_id)</code>
								<small>Display any set status message for this item as an array.</small>						
								<span class="toggle">Show / Hide Array</span>
								<pre class="hide_toggle"><?php print_r($this->flexi_cart->item_status_message_array($row_id));?></pre>
							</td>
						</tr>
					</table>					
				</div>

				<a name="get_item_column"></a>
				<div class="w100 frame">
					<h3 class="heading">get_item_column()</h3>
					
					<p>Returns the value of any set column name including user defined data for a specific row.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>get_item_column(row_id, column_name, format, internal_value)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>column_name</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The name of the item column to return a value from.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>FALSE</p>
						<p><strong class="spacer_125">Success:</strong>anything</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>get_item_column($row_id, 'user_note', TRUE, FALSE)</code>
								<small>What 'user note' has been set for this item?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php
								$custom_item_column = $this->flexi_cart->get_item_column($row_id, 'user_note', TRUE, FALSE);
								if ($custom_item_column)
								{
									echo $custom_item_column;
								}
								else
								{
									var_dump($custom_item_column);
								}
							?>
							</td>
						</tr>
					</table>					
				</div>

				<a name="item_admin_data_status"></a>
				<div class="w100 frame">
					<h3 class="heading">item_admin_data_status()</h3>
					
					<p>
						Returns whether an item contains any 'admin data' in the cart data array.<br/>
						See the <a href="<?php echo $base_url; ?>user_guide/misc_info#admin_data">admin data documentation</a> for further information.
					</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_admin_data_status(row_id)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">No Data:</strong>FALSE</p>
						<p><strong class="spacer_125">Data Exists:</strong>TRUE</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_admin_data_status($row_id) </code>
								<small>
									Has this item been loaded from the cart data of a saved order?
								</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->item_admin_data_status($row_id));?></td>
						</tr>
					</table>					
				</div>

				<a name="item_shipped_quantity"></a>
				<div class="w100 frame">
					<h3 class="heading">item_shipped_quantity()</h3>
					
					<p>
						Returns the quantity of items that have been shipped for an item within a confirmed order.<br/>
						This function requires 'admin data' to have been loaded into the cart.<br/>
						See the <a href="<?php echo $base_url; ?>user_guide/misc_info#admin_data">admin data documentation</a>' for further information.
					</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_shipped_quantity(row_id, format)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>int (0)</p>
						<p><strong class="spacer_125">Success:</strong>int</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_shipped_quantity($row_id, TRUE) </code>
								<small>
									If this item has been loaded from the cart data of a saved order, what is the quantity of items that have been 'Shipped'?
								</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_shipped_quantity($row_id, TRUE);?></td>
						</tr>
					</table>					
				</div>

				<a name="item_cancelled_quantity"></a>
				<div class="w100 frame">
					<h3 class="heading">item_cancelled_quantity()</h3>
					
					<p>
						Returns the quantity of items that have been cancelled for an item within a confirmed order.<br/>
						This function requires 'admin data' to have been loaded into the cart.<br/>
						See the <a href="<?php echo $base_url; ?>user_guide/misc_info#admin_data">admin data documentation</a>' for further information.
					</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>item_cancelled_quantity(row_id, format)</code>
					<a href="#help" class="help_link">Help</a>
					<table>
						<thead>
							<tr>
								<th class="spacer_150">Name</th>
								<th class="spacer_100 align_ctr">Data Type</th>
								<th class="spacer_75 align_ctr">Required</th>
								<th class="spacer_75 align_ctr">Default</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>row_id</td>
								<td class="align_ctr">string</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The unique identifier used to identify an individual row within the cart.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Failure:</strong>int (0)</p>
						<p><strong class="spacer_125">Success:</strong>int</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>item_cancelled_quantity($row_id, TRUE)</code>
								<small>
									If this item has been loaded from the cart data of a saved order, what is the quantity of items that have been 'Cancelled'?
								</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_cancelled_quantity($row_id, TRUE);?></td>
						</tr>
					</table>
				</div>
			
			</div>

		</div>
	</div>	
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
	
	<!-- User Guide Item Selector -->  
	<?php $this->load->view('includes/user_guide_item_selector'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>