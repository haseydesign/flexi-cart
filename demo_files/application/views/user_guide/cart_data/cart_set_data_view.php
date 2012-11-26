<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Set Cart Session Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for setting cart data in flexi cart."/> 
	<meta name="keywords" content="setting cart data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Setting Cart Session Data</h1>
				<p>Data is set to the cart session by using functions primarily from flexi carts standard library.</p>
				<p>The data that can be set in the cart session includes data of items added to the cart, user localisation data and cart configuration settings.</p>
				<p>
					Since many of flexi carts features can be set using either manually submitted data, or data retrieved from the database; there are often two versions of a function to set session data. Functions that update session data using the database are prefixed with the function name 'update_xxx', whilst functions that use manually set data are prefixed with the name 'set_xxx'.
				</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">

			<h2>Set Cart Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/cart_index">List all Cart Functions</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data">Get Cart Item Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data">Get Cart Summary Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_session_data">Get Cart Session Data</a>

			<div class="anchor_nav">
				<h6>Insert and Update Cart Items</h6>
				<p>
					<a href="#insert_items">insert_items()</a> | <a href="#update_cart">update_cart()</a>
				</p>
				<h6>Manage Cart Contents</h6>
				<p>
					<a href="#recalculate_cart">recalculate_cart()</a> | <a href="#unset_admin_data">unset_admin_data()</a> | <a href="#empty_cart">empty_cart()</a> | <a href="#destroy_cart">destroy_cart()</a>
				</p>
				<h6>Status and Error Messages</h6>
				<p>
					<a href="#status_messages">status_messages()</a> | <a href="#set_status_message">set_status_message()</a> | <a href="#clear_status_messages">clear_status_messages()</a> | <a href="#error_messages">error_messages()</a> | <a href="#set_error_message">set_error_message()</a> | <a href="#clear_error_messages">clear_error_messages()</a> | <a href="#clear_messages">clear_messages()</a> | <a href="#get_messages_array">get_messages_array()</a> | <a href="#get_messages">get_messages()</a>
				</p>
			</div>
				
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with Setting Session Data Functions</h3>
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
		
			<a name="insert_items"></a>
			<div class="w100 frame">
				<h3 class="heading">insert_items()</h3>
				
				<p>Inserts an item or multiple items to the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>insert_items(item_data, update_existing_items)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>item_data</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								The array contains the item data that is to be inserted into the cart.<br/>
								See the documentation below regarding how to set data.
							</td>
						</tr>
						<tr>
							<td>update_existing_items</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Define whether the submitted data should overwrite any matching item data that already exists in the cart.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function loops through the 'item_data' checking that the required columns are present and valid.</p>
					<p>The function then generates a row id from the items id and any item options that have been set. If the row id already exists in the cart, depending on config settings, the existing cart item is updated with the new data, otherwise, the new data is added to the cart as a new item.</p>
					<p>Once all item data has been processed, all cart values are recalculated.</p>
				</div>
				
				<h6>Setting 'item_data' Array</h6>
				<div class="frame_note">
					<p>The 'item_data' array can contain data for multiple items. To add one item use a single dimesional array, to add multiple items, use a multi-dimensional array. See the examples below for further details.</p>
					<hr/>
					<p>All array keys in the 'item_data' array must be the alias column name that has been set via the config. file, not the internal column name.</p>
					<p>
						For example, using the default config. file setup, the cart item quantity column is setup as follows:<br/>
						<code>$config['cart']['items']['columns']['item_quantity'] = 'quantity';</code><br/>
						The array key 'item_quantity' is the internal name, and the array value 'quantity' is the alias name.							
					</p>
					<p>When setting the array keys for the carts item quantity column in the 'item_data' array, it would be set as 'quantity' and NOT 'item_quantity'.</p>
					<p>See below for further examples and read the '<a href="<?php echo $base_url; ?>user_guide/cart_config_columns#required_columns">Cart Column Configuration</a>' for further information on cart columns that can be set.</p>
					<hr/>
					<p>When setting currency values, ensure the values match the carts default currency and tax settings.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Adding 1 item to the cart using a single-dimensional array.</span>

$item_data = array(
'id' => 101,
'name' => 'Example Item Name #1',
'quantity' => 3,
'price' => 10.99
);

$this->flexi_cart->insert_items($item_data);
</pre>
<pre>
<span class="comment bold">// Example #2 : Adding multiple items to the cart using a multi-dimensional array.</span>

$item_data = array(
array(
	'id' => 101,
	'name' => 'Example Item Name #1',
	'quantity' => 3,
	'price' => 10.99
),
array(
	'id' => 102,
	'name' => 'Example Item Name #2',
	'quantity' => 1,
	'price' => 25.49
)
)

$this->flexi_cart->insert_items($item_data);
</pre>
			</div>

			<a name="update_cart"></a>
			<div class="w100 frame">
				<h3 class="heading">update_cart()</h3>
				
				<p>Updates the cart with submitted item and summary data.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>update_cart(item_data, settings_data, force_column_update, force_recalculate)</code>
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
							<td>item_data</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								The array contains the item data that is to be update in the cart.<br/>
								See the documentation below regarding how to set data.
							</td>
						</tr>
						<tr>
							<td>settings_data</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Submitted settings data will update the carts location, shipping, tax, discount, surcharge and currency data.<br/>
								See the documentation below regarding how to set data.
							</td>
						</tr>
						<tr>
							<td>force_column_update</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Define if all submitted data is updated regardless of whether the columns present are defined as '<a href="<?php echo $base_url; ?>user_guide/cart_config_columns#updatable_columns">Updatable Columns</a>'.</td>
						</tr>
						<tr>
							<td>force_recalculate</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Define if all cart totals must be recalculated on success, regardless of whether the function has determined to do so.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function loops through the 'item_data' and sets the data to the cart session array.</p>
					<p>The function then loops through the 'settings_data' and where available, updates the carts location, shipping, tax, discount, surcharge and currency data.</p>
					<p>Once all item data has been processed, all cart values are recalculated.</p>
				</div>
				
				<h6>Setting 'item_data' Array</h6>
				<div class="frame_note">
					<p>The 'item_data' array can contain data for multiple items. To update one item use a single dimesional array, to update multiple items, use a multi-dimensional array. See the examples below for further details.</p>
					<hr/>
					<p>All array keys in the 'item_data' array must be the alias column name that has been set via the config. file, not the internal column name.</p>
					<p>
						For example, using the default config. file setup, the cart item quantity column is setup as follows:<br/>
						<code>$config['cart']['items']['columns']['item_quantity'] = 'quantity';</code><br/>
						The array key 'item_quantity' is the internal name, and the array value 'quantity' is the alias name.							
					</p>
					<p>When setting the array keys for the carts item quantity column in the 'item_data' array, it would be set as 'quantity' and NOT 'item_quantity'.</p>
					<p>See below for further examples and read the '<a href="<?php echo $base_url; ?>user_guide/cart_config_columns#required_columns">Cart Column Configuration</a>' for further information on cart columns that can be set.</p>
					<hr/>
					<p>When setting currency values, ensure the values match the carts default currency and tax settings.</p>
				</div>

				<h6>Setting 'settings_data' Array</h6>
				<div class="frame_note">
					<p>All array keys in the 'settings_data' array must refer to the name of the flexi cart function that the data is intended to be updated by.</p>
					<p>
						The available functions to call using the 'settings_data' are as follows:
						<ul>
							<li>
								'<a href="<?php echo $base_url; ?>user_guide/location_set_data#update_shipping_location">update_shipping_location</a>' - Update the current shipping location, using the database.
							</li>
							<li>
								'<a href="<?php echo $base_url; ?>user_guide/shipping_set_data#update_shipping">update_shipping</a>' - Update the current shipping option, using the database.
							</li>
							<li>
								'<a href="<?php echo $base_url; ?>user_guide/shipping_set_data#set_shipping">set_shipping</a>' - Update the current shipping option, using manually submitted values. 
							</li>
							<li>
								'<a href="<?php echo $base_url; ?>user_guide/location_set_data#update_tax_location">update_tax_location</a>' - Update the current tax location and rate, using the database.
							</li>
							<li>
								'<a href="<?php echo $base_url; ?>user_guide/tax_set_data#set_tax">set_tax</a>' - Update the current tax rate, using the database.
							</li>
							<li>
								'<a href="<?php echo $base_url; ?>user_guide/discount_set_data#update_discount_codes">update_discount_codes</a>' - Update the discount codes applied to the cart.
							</li>
							<li>
								'<a href="<?php echo $base_url; ?>user_guide/discount_set_data#set_discount">set_discount</a>' - Set a discount to the cart, using manually submitted values.  
							</li>
							<li>
								'<a href="<?php echo $base_url; ?>user_guide/surcharge_set_data#set_surcharge">set_surcharge</a>' - Set a surcharge to the cart, using manually submitted values.
							</li>
							<li>
								'<a href="<?php echo $base_url; ?>user_guide/currency_set_data#update_currency">update_currency</a>' - Update the carts currency, using the database.
							</li>
							<li>
								'<a href="<?php echo $base_url; ?>user_guide/currency_set_data#set_currency">set_currency</a>' - Set carts currency, using manually submitted values.
							</li>
						</ul>
					</p>
					<p>
						The data that is then submitted to the defined function must be prepared and structured as the standalone function would normally require.<br/>
						For further details on each function, click the corresponding function name from above.
					</p>
					<hr/>
					<p>When setting currency values, ensure the values match the carts default currency and tax settings.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Updating the item quantity of 1 item in the cart using a single-dimensional array.</span>

$item_data = array(
'row_id' => '38b3eff8baf56627478ec76a704e9b52',
'quantity => 4
);

$this->flexi_cart->update_cart($item_data);
</pre>
<pre>
<span class="comment bold">// Example #2 : Updating the item quantity of multiple items in the cart using a multi-dimensional array.</span>

$item_data = array(
array(
	'row_id' => '38b3eff8baf56627478ec76a704e9b52',
	'quantity => 4
),
array(
	'row_id' => 'c45147dee729311ef5b5c3003946c48f',
	'quantity => 1
)
);

$this->flexi_cart->update_cart($item_data);
</pre>
<pre>
<span class="comment bold">// Example #3 : Updating the items in the cart and cart settings data using a multi-dimensional array.</span>

<span class="comment">// Preparing item data.</span>
$item_data = array(
array(
	'row_id' => '38b3eff8baf56627478ec76a704e9b52',
	'name => 'example_name_1',
	'quantity => 4
),
array(
	'row_id' => 'c45147dee729311ef5b5c3003946c48f',
	'name => 'example_name_2',
	'quantity => 1
)
);

<span class="comment">// Preparing cart settings data.</span>
$settings_data = array(
'update_shipping_location' => 'New York',
'set_tax' => array(
	'name' => 'New York Tax',
	'rate' => 8.37
)
);

$this->flexi_cart->update_cart($item_data, $settings_data);
</pre>
			</div>

			<a name="recalculate_cart"></a>
			<div class="w100 frame">
				<h3 class="heading">recalculate_cart()</h3>
				
				<p>Recalculates all values within the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE</p>
				</div>
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->recalculate_cart();
</pre>
			</div>

			<a name="unset_admin_data"></a>
			<div class="w100 frame">
				<h3 class="heading">unset_admin_data()</h3>
				
				<p>Unsets any 'admin data' that is present in the cart session.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>For further information on '<a href="<?php echo $base_url; ?>user_guide/misc_info#admin_data">admin data</a>', read the documentation.</p>
				</div>
						
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->unset_admin_data();
</pre>
			</div>

			<a name="empty_cart"></a>
			<div class="w100 frame">
				<h3 class="heading">empty_cart()</h3>
				
				<p>Empties the cart of all items.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>empty_cart(reset_shipping)</code>
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
							<td>reset_shipping</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Defines whether to reset the current shipping option when emptying the cart.</td>
						</tr>
					</tbody>
				</table>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE</p>
				</div>
				
				<h6>Example</h6>
<pre>
$reset_shipping = FALSE;

$this->flexi_cart->empty_cart($reset_shipping);
</pre>
			</div>

			<a name="destroy_cart"></a>
			<div class="w100 frame">
				<h3 class="heading">destroy_cart()</h3>
				
				<p>Destroys the entire cart data session.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE</p>
				</div>
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->destroy_cart();
</pre>
			</div>
			
			<a name="status_messages"></a>
			<div class="w100 frame">
				<h3 class="heading">status_messages()</h3>
				
				<p>Get any status message(s) that may have been set by recently run functions.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>status_messages(target_user, prefix_delimiter, suffix_delimiter)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>target_user</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">'public'</td>
							<td>
								Define whether to suppress any 'admin' error messages and only return 'public' messages intended for notifying public users.<br/>
								Defining 'public' will return the message for both public and admin users.<br/> 
								Defining 'admin' will return the message for admin users only.
							</td>
						</tr>
						<tr>
							<td>prefix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a string of characters to prefix to the status message.<br/>
								Typically this is intended to allow elements to be wrapped around messages.<br/>
								If no prefix is set, the 'status_prefix_delimiter' defined via the config. file is used instead.
							</td>
						</tr>
						<tr>
							<td>suffix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a string of characters to suffix to the status message.<br/>
								Typically this is intended to allow elements to be wrapped around messages.<br/>
								If no suffix is set, the 'status_suffix_delimiter' defined via the config. file is used instead.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>The messages returned by flexi cart functions can be returned in other languages by defining the translation in CodeIgniters language directory.</p>
					<p>
						To define your own translations, create a folder within the CI language directory named as the language, e.g. 'french'.<br/>
						Then copy the 'flexi_cart_lang.php' file from the 'english' folder to the new language folder and translate the messages within the file.
					</p>
					<p>For further information, read the <a href="http://ellislab.com/user_guide/libraries/language.html" target="_blank">CodeIgniter documentation</a> on the language library.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
				<h6>Examples</h6>
				<table class="example">
					<tr>
						<td>
							<code>status_messages('admin', FALSE, FALSE)</code>
							<small>This would return all <span class="uline">admin</span> status messages as non formatted text.</small>
						</td>
					</tr>
					<tr>
						<td>
							<code>status_messages('public', FALSE, FALSE)</code>
							<small>This would return all <span class="uline">public and admin</span> status messages as non formatted text.</small>
						</td>
					</tr>
					<tr>
						<td>
							<code>status_messages('admin', '<?php echo htmlentities('<p>');?>', '<?php echo htmlentities('</p>');?>')</code>
							<small>This would return all <span class="uline">admin</span> status messages formatted in a html <?php echo htmlentities('<p>');?> tag.</small>
						</td>
					</tr>
				</table>
			</div>
			
			<a name="set_status_message"></a>
			<div class="w100 frame">
				<h3 class="heading">set_status_message()</h3>
				
				<p>Set a status message to be displayed to the user.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>set_status_message(status_message, target_user, overwrite_existing)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>status_message</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the status message to be set.</td>
						</tr>
						<tr>
							<td>target_user</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">'public'</td>
							<td>Define whether to set the message as a 'public' or 'admin' status message.</td>
						</tr>
						<tr>
							<td>overwrite_existing</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Define whether to overwrite any existing status messages.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>'status_message' parameter value</p>
				</div>
				
				<h6>Examples</h6>
				<table class="example">
					<tr>
						<td>
							<code>set_status_message('This is a custom ADMIN status message', 'admin', FALSE)</code>
							<small>This would set a status message that would NOT be shown in public areas of the site.</small>
						</th>
					</tr>
					<tr>
						<td>
							<code>set_status_message('This is a custom PUBLIC status message', 'public', FALSE)</code>
							<small>This would set a status message that would be shown in public and admin areas of the site.</small>
						</td>
					</tr>
					<tr>
						<td>
							<code>set_status_message('This is a custom PUBLIC status message', 'public', TRUE)</code>
							<small>This would overwrite any existing messages and then set a status message that would be shown in public and admin areas of the site.</small>
						</td>
					</tr>
				</table>
			</div>
			
			<a name="clear_status_messages"></a>
			<div class="w100 frame">
				<h3 class="heading">clear_status_messages()</h3>
				
				<p>Clear all status messages.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>
				<table class="example">
					<tr>
						<td>
							<code>clear_status_messages()</code>
							<small>This would remove all currently set status messages.</small>
						</td>
					</tr>
				</table>
			</div>

			<a name="error_messages"></a>
			<div class="w100 frame">
				<h3 class="heading">error_messages()</h3>
				
				<p>Get any error message(s) that may have been set by recently run functions.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>error_messages(target_user, prefix_delimiter, suffix_delimiter)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>target_user</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">'public'</td>
							<td>
								Define whether to suppress any 'admin' error messages and only return 'public' messages intended for notifying public users.<br/>
								Defining 'public' will return the message for both public and admin users.<br/> 
								Defining 'admin' will return the message for admin users only.
							</td>
						</tr>
						<tr>
							<td>prefix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a string of characters to prefix to the error message.<br/>
								Typically this is intended to allow elements to be wrapped around messages.<br/>
								If no prefix is set, the 'error_prefix_delimiter' defined via the config. file is used instead.
							</td>
						</tr>
						<tr>
							<td>suffix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a string of characters to suffix to the error message.<br/>
								Typically this is intended to allow elements to be wrapped around messages.<br/>
								If no suffix is set, the 'error_suffix_delimiter' defined via the config. file is used instead.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>The messages returned by flexi cart functions can be returned in other languages by defining the translation in CodeIgniters language directory.</p>
					<p>
						To define your own translations, create a folder within the CI language directory named as the language, e.g. 'french'.<br/>
						Then copy the 'flexi_cart_lang.php' file from the 'english' folder to the new language folder and translate the messages within the file.
					</p>
					<p>For further information, read the <a href="http://ellislab.com/user_guide/libraries/language.html" target="_blank">CodeIgniter documentation</a> on the language library.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
				<h6>Examples</h6>
				<table class="example">
					<tr>
						<td>
							<code>error_messages('admin', FALSE, FALSE)</code>
							<small>This would return all <span class="uline">admin</span> error messages as non formatted text.</small>
						</td>
					</tr>
					<tr>
						<td>
							<code>error_messages('public', FALSE, FALSE)</code>
							<small>This would return all <span class="uline">public and admin</span> error messages as non formatted text.</small>
						</td>
					</tr>
					<tr>
						<td>
							<code>error_messages('admin', '<?php echo htmlentities('<p>');?>', '<?php echo htmlentities('</p>');?>')</code>
							<small>This would return all <span class="uline">admin</span> error messages formatted in a html <?php echo htmlentities('<p>');?> tag.</small>
						</td>
					</tr>
				</table>
			</div>

			<a name="set_error_message"></a>
			<div class="w100 frame">
				<h3 class="heading">set_error_message()</h3>
				
				<p>Set an error message to be displayed to the user.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>set_error_message(error_message, target_user, overwrite_existing)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>error_message</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the error message to be set.</td>
						</tr>
						<tr>
							<td>target_user</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">'public'</td>
							<td>Define whether to set the message as a 'public' or 'admin' error message.</td>
						</tr>
						<tr>
							<td>overwrite_existing</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Define whether to overwrite any existing error messages.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>'error_message' parameter value</p>
				</div>
				
				<h6>Examples</h6>
				<table class="example">
					<tr>
						<td>
							<code>set_error_message('This is a custom ADMIN error message', 'admin', FALSE)</code>
							<small>This would set an error message that would NOT be shown in public areas of the site.</small>
						</td>
					</tr>
					<tr>
						<td>
							<code>set_error_message('This is a custom PUBLIC error message', 'public', FALSE)</code>
							<small>This would set an error message that would be shown in public and admin areas of the site.</small>
						</td>
					</tr>
					<tr>
						<td>
							<code>set_error_message('This is a custom PUBLIC error message', 'public', TRUE)</code>
							<small>This would overwrite any existing messages and then set a error message that would be shown in public and admin areas of the site.</small>
						</td>
					</tr>
				</table>
			</div>
			
			<a name="clear_error_messages"></a>
			<div class="w100 frame">
				<h3 class="heading">clear_error_messages()</h3>
				
				<p>Clear all error messages.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>
				<table class="example">
					<tr>
						<td>
							<code>clear_error_messages()</code>
							<small>This would remove all currently set error messages.</small>
						</td>
					</tr>
				</table>
			</div>
			
			<a name="clear_messages"></a>
			<div class="w100 frame">
				<h3 class="heading">clear_messages()</h3>
				
				<p>Clear all status and error messages.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>
				<table class="example">
					<tr>
						<td>
							<code>clear_messages()</code>
							<small>This would remove all currently set status and error messages.</small>
						</td>
					</tr>
				</table>
			</div>
			
			<a name="get_messages_array"></a>
			<div class="w100 frame">
				<h3 class="heading">get_messages_array()</h3>
				
				<p>
					Returns any set messages, grouped into a 'status' and 'error' array.<br/>
					The returned status and error messages are then further grouped into 'public' and 'admin' type messages.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_messages_array(target_user, prefix_delimiter, suffix_delimiter)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>target_user</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">'public'</td>
							<td>
								Define whether to suppress any 'admin' error messages and only return 'public' messages intended for notifying public users.<br/>
								Defining 'public' will return the message for both public and admin users.<br/> 
								Defining 'admin' will return the message for admin users only.
							</td>
						</tr>
						<tr>
							<td>prefix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a string of characters to prefix to the messages.<br/>
								Typically this is intended to allow elements to be wrapped around messages.<br/>
								If no prefix is set, the corresponding 'status_prefix_delimiter' and 'error_prefix_delimiter' defined via the config. file is used instead.
							</td>
						</tr>
						<tr>
							<td>suffix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a string of characters to suffix to the messages.<br/>
								Typically this is intended to allow elements to be wrapped around messages.<br/>
								If no suffix is set, the corresponding 'status_suffix_delimiter' and 'error_suffix_delimiter' defined via the config. file is used instead.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>The messages returned by flexi cart functions can be returned in other languages by defining the translation in CodeIgniters language directory.</p>
					<p>
						To define your own translations, create a folder within the CI language directory named as the language, e.g. 'french'.<br/>
						Then copy the 'flexi_cart_lang.php' file from the 'english' folder to the new language folder and translate the messages within the file.
					</p>
					<p>For further information, read the <a href="http://ellislab.com/user_guide/libraries/language.html" target="_blank">CodeIgniter documentation</a> on the language library.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
				<h6>Examples</h6>
				<table class="example">
					<tr>
						<td>
							<code>get_messages_array('admin', FALSE, FALSE)</code>
							<small>This would return an array of all the <span class="uline">admin</span> status and error messages as non formatted text, with an array key indicating the message type.</small>
						</td>
					</tr>
					<tr>
						<td>
							<code>get_messages_array('public', FALSE, FALSE)</code>
							<small>This would return an array of all the <span class="uline">public and admin</span> status and error messages as non formatted text, with an array key indicating the message type.</small>
						</td>
					</tr>
					<tr>
						<td>
							<code>get_messages_array('admin', '<?php echo htmlentities('<p>');?>', '<?php echo htmlentities('</p>');?>')</code>
							<small>This would return an array of all the <span class="uline">admin</span> status and error messages formatted in a html <?php echo htmlentities('<p>');?> tag, with an array key indicating the message type.</small>
						</td>
					</tr>
				</table>
			</div>

			<a name="get_messages"></a>
			<div class="w100 frame">
				<h3 class="heading">get_messages()</h3>
				
				<p>Get any operational function messages whether of status or error type and format their output with delimiters.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_messages(target_user, prefix_delimiter, suffix_delimiter)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>target_user</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">'public'</td>
							<td>
								Define whether to suppress any 'admin' error messages and only return 'public' messages intended for notifying public users.<br/>
								Defining 'public' will return the message for both public and admin users.<br/> 
								Defining 'admin' will return the message for admin users only.
							</td>
						</tr>
						<tr>
							<td>prefix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a string of characters to prefix to the messages.<br/>
								Typically this is intended to allow elements to be wrapped around messages.<br/>
								If no prefix is set, the corresponding 'status_prefix_delimiter' and 'error_prefix_delimiter' defined via the config. file is used instead.
							</td>
						</tr>
						<tr>
							<td>suffix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a string of characters to suffix to the messages.<br/>
								Typically this is intended to allow elements to be wrapped around messages.<br/>
								If no suffix is set, the corresponding 'status_suffix_delimiter' and 'error_suffix_delimiter' defined via the config. file is used instead.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>The messages returned by flexi cart functions can be returned in other languages by defining the translation in CodeIgniters language directory.</p>
					<p>
						To define your own translations, create a folder within the CI language directory named as the language, e.g. 'french'.<br/>
						Then copy the 'flexi_cart_lang.php' file from the 'english' folder to the new language folder and translate the messages within the file.
					</p>
					<p>For further information, read the <a href="http://ellislab.com/user_guide/libraries/language.html" target="_blank">CodeIgniter documentation</a> on the language library.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
				<h6>Examples</h6>
				<table class="example">
					<tr>
						<td>
							<code>get_messages('admin', FALSE, FALSE)</code>
							<small>This would return all <span class="uline">admin</span> status and error messages as non formatted text.</small>
						</td>
					</tr>
					<tr>
						<td>
							<code>get_messages('public', FALSE, FALSE)</code>
							<small>This would return all <span class="uline">public and admin</span> status and error messages as non formatted text.</small>
						</td>
					</tr>
					<tr>
						<td>
							<code>get_messages('admin', '<?php echo htmlentities('<p>');?>', '<?php echo htmlentities('</p>');?>')</code>
							<small>This would return all <span class="uline">admin</span> status and error messages formatted in a html <?php echo htmlentities('<p>');?> tag.</small>
						</td>
					</tr>
				</table>
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