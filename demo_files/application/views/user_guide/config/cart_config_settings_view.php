<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Cart Functionality Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for configuring the cart functionality in flexi cart."/> 
	<meta name="keywords" content="cart functionality configuration, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Cart Functionality Configuration</h1>
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

			<h2>Cart Functionality Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/cart_config_columns">Cart Column Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_internal">Cart Internal Settings Config</a><br/>
			<a href="<?php echo $base_url; ?>user_guide/cart_config_index">Cart Config Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data">Get Cart Config Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data">Set Cart Config Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_admin">Cart Config Admin Data</a>

			<div class="anchor_nav">
				<h6>Config Setup Information</h6>
				<p>
					<a href="#config_descriptions">Configuration Descriptions</a>
				</p>
				<h6>Table and Config File Settings</h6>
				<p>
					<a href="#config_database">Define via the Database Table</a> | <a href="#config_defaults">Define via the Config File</a>
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

			<a name="config_descriptions"></a>
			<div class="w100 frame">
				<h3 class="heading">Configuration Descriptions</h3>
				
				<p>Below is a compiled list of all the cart configuration settings that can be set either via the configuration database table, or via the config file itself.</p>
				<hr/>
				<div class="frame_note">
					<a name="order_number_prefix"></a>					<h6>order_number_prefix</h6>
					<p>Default: <em>FALSE</em> | Data Type: <em>string</em></p>
					<hr/>
					<p>Defines a value prefixed to the cart order number.</p>
					<p>Note: Do not set a number as a prefix value if using incremental order numbers.</p>
				</div>				<div class="frame_note">					<a name="order_number_suffix"></a>					<h6>order_number_suffix</h6>
					<p>Default: <em>FALSE</em> | Data Type: <em>string</em></p>
					<hr/>
					<p>Defines a value suffixed to the cart order number.</p>
					<p>Note: Do not set a number as a suffix value if using incremental order numbers.</p>
				</div>				<div class="frame_note">					<a name="increment_order_number"></a>					<h6>increment_order_number</h6>
					<p>Default: <em>TRUE</em> | Data Type: <em>bool</em></p>
					<hr/>
					<p>Defines whether the order number should be incremented from the last order number.</p>
					<p>
						If 'FALSE' is set, a randomly generated number will be used.<br/>
						Order number prefixes and suffixes can still be applied to either format.
					</p>				</div>				<div class="frame_note">					<a name="minimum_order"></a>					<h6>minimum_order</h6>
					<p>Default: <em>0</em> | Data Type: <em>int</em></p>
					<hr/>
					<p>Defines the minimum order value.</p>
					<p>This value can then be checked against the value of a particular summary column.</p>				</div>				<div class="frame_note">					<a name="quantity_decimals"></a>					<h6>quantity_decimals</h6>
					<p>Default: <em>0</em> | Data Type: <em>int</em></p>
					<hr/>
					<p>Defines how many decimals are acceptable for item quantities.</p>
					<p>Typically, this should be zero, however, some situations may require half quantities that would be entered into the cart as '0.5', this would require 1 decimal.</p>				</div>				<div class="frame_note">					<a name="increment_duplicate_item_quantity"></a>					<h6>increment_duplicate_item_quantity</h6>
					<p>Default: <em>TRUE</em> | Data Type: <em>bool</em></p>
					<hr/>
					<p>Defines whether a cart items quantity should be incremented when an identical duplicate is added to the cart.</p>
					<p>If 'FALSE' is set, the new quantity will be used.</p>				</div>				<div class="frame_note">					<a name="quantity_limited_by_stock"></a>					<h6>quantity_limited_by_stock</h6>
					<p>Default: <em>TRUE</em> | Data Type: <em>bool</em></p>
					<hr/><p>If the <a href="<?php echo $base_url; ?>user_guide/item_stock_config_guide">item stock table</a> is enabled, defines whether the maximum quantity of cart items should be limited to the databases stock quantity.</p>
					<p>Example: Database item stock quantity equals 3, user adds an item quantity of 5, the cart will then alter the item cart quantity back to 3.</p>				</div>				<div class="frame_note">					<a name="remove_no_stock_items"></a>					<h6>remove_no_stock_items</h6>
					<p>Default: <em>FALSE</em> | Data Type: <em>bool</em></p>
					<hr/>
					<p>
						If the <a href="<?php echo $base_url; ?>user_guide/item_stock_config_guide">item stock table</a> is enabled, defines whether out-of-stock items should be automatically removed from the cart.<br/>
						If 'TRUE' is set, and an out-of-stock item is added to the cart, the item will be immediately removed.
					</p>				</div>				<div class="frame_note">					<a name="auto_allocate_stock"></a>					<h6>auto_allocate_stock</h6>
					<p>Default: <em>TRUE</em> | Data Type: <em>bool</em></p>
					<hr/>
					<p>If the <a href="<?php echo $base_url; ?>user_guide/item_stock_config_guide">item stock table</a> is enabled, defines whether stock quantities should be automatically updated and managed by flexi cart.</p>
					<p>
						If 'TRUE' is set, when an order is confirmed, items within the cart that are also in the item stock table will have their stock deducted.<br/>
						Likewise, if items within an order are cancelled, they will be auto restocked into the item stock table.
					</p>				</div>				<div class="frame_note">					<a name="save_banned_shipping_items"></a>					<h6>save_banned_shipping_items</h6>
					<p>Default: <em>FALSE</em> | Data Type: <em>bool</em></p>
					<hr/>
					<p>Defines whether an item that is not permitted to be shipped to the current shipping location, should be saved to the database if the user still completes the order.</p>				</div>				<div class="frame_note">					<a name="weight_type"></a>					<h6>weight_type</h6>
					<p>Default: <em>gram</em> | Data Type: <em>string</em></p>
					<hr/>
					<p>Sets the default weight type to display weights by.</p>
					<p>The available weight types are 'gram', 'kilogram', 'avoir_ounce', 'avoir_pound', 'troy_ounce', 'troy_pound' and 'carat'.</p>				</div>				<div class="frame_note">					<a name="weight_decimals"></a>					<h6>weight_decimals</h6>
					<p>Default: <em>0</em> | Data Type: <em>int</em></p>
					<hr/>
					<p>Sets the default number of decimals to display weights by.</p>
					<p>Note: A weights decimal and thousand separator characters are controlled by the current currency separators.</p>				</div>				<div class="frame_note">					<a name="display_tax_prices"></a>					<h6>display_tax_prices</h6>
					<p>Default: <em>TRUE</em> | Data Type: <em>bool</em></p>
					<hr/>
					<p>Defines whether item prices should be displayed including tax by default.</p>				</div>				<div class="frame_note">					<a name="price_inc_tax"></a>					<h6>price_inc_tax</h6>
					<p>Default: <em>TRUE</em> | Data Type: <em>bool</em></p>
					<hr/>
					<p>Defines whether item prices typically include tax when added to the cart.</p>
					<p>Note: Specific tax rates can be set for individual items.</p>				</div>				<div class="frame_note">					<a name="multi_row_duplicate_items"></a>					<h6>multi_row_duplicate_items</h6>
					<p>Default: <em>FALSE</em> | Data Type: <em>bool</em></p>
					<hr/>
					<p>Defines whether all duplicate cart items should be added as a new separate row in the cart.</p>
					<p>If 'FALSE' is set, the existing item will be updated.</p>				</div>				<div class="frame_note">					<a name="dynamic_reward_points"></a>					<h6>dynamic_reward_points</h6>
					<p>Default: <em>TRUE</em> | Data Type: <em>bool</em></p>
					<hr/>
					<p>Defines whether reward points should be based on the internal value of an item, or should be based on the items current tax rate based price.</p>
					<p>
						Example: An item is added to the cart costing &pound;20 including 20% tax, the user then ships to a 10% tax zone, so the item now costs &pound;18.33.<br/>
						i.e. Remove 20% tax: &pound;20 / 20% = &pound;16.67, then add 10% tax: &pound;16.67 * 10% = &pound;18.33.
					</p>
					<p>If 'FALSE' is set, the reward points will be based on the internal value of an item.</p>				</div>				<div class="frame_note">					<a name="reward_point_multiplier"></a>					<h6>reward_point_multiplier</h6>
					<p>Default: <em>10</em> | Data Type: <em>int</em></p>
					<hr/>
					<p>Defines how many reward points are awarded per 1.00 currency unit of an items price.</p>
					<p>Example: A multiplier of 10 is (10 x &pound;1.00) = 10 reward points. Therefore, an item priced at &pound;100 would be worth 1000 reward points.</p>
					<p>
						Reward points are always rounded to the nearest whole number.<br/>
						Reward points can be manually defined when adding items to the cart.
					</p>				</div>				<div class="frame_note">					<a name="reward_voucher_multiplier"></a>					<h6>reward_voucher_multiplier</h6>
					<p>Default: <em>0.01</em> | Data Type: <em>int</em></p>
					<hr/>
					<p>Define how much each reward point is worth as a currency value when converted to a reward voucher.</p>
					<p>Example: If 250 reward points were converted using a multiplier of &pound;0.01 per point, the reward voucher would be worth &pound;2.50 (250 x 0.01).</p>				</div>				<div class="frame_note">					<a name="reward_point_to_voucher_ratio"></a>					<h6>reward_point_to_voucher_ratio</h6>
					<p>Default: <em>250</em> | Data Type: <em>int</em></p>
					<hr/>
					<p>Defines how many reward points are required to create 1 reward voucher.</p>
					<p>
						Examples:<br/>
						A ratio of 250 means for every 250 reward points, 1 voucher worth 250 points can be created, this voucher is then worth a defined currency value.<br/>
						A customer with 500 reward points could create either 1 voucher of 500 points, or 2 vouchers with 250 points each.<br/>
						A customer creating a voucher with 525 reward points, would only be able to convert and use 500 points, the remaining 25 remain as active reward points.
					</p>				</div>				<div class="frame_note">					<a name="reward_point_days_pending"></a>					<h6>reward_point_days_pending</h6>
					<p>Default: <em>14</em> | Data Type: <em>int</em></p>
					<hr/>
					<p>Defines after how many days that reward points earnt from an ordered item that has been 'shipped' become active.</p>
					<p>
						The idea of this option is to prevent a customer from placing an order soley to earn reward points, then purchasing a second order using a reward voucher earnt from the first order. The customer could then return the first order for a refund, but the reward points earnt from it have already been used to purchase the second order at a cheaper price.
					</p>
					<p>
						The number of days set should typically reflect the stores return policy, for example, if items cannot be returned after 14 days, the reward points should only become active after 14 days.
					</p>
					<p>Note: If flexi carts '<a href="<?php echo $base_url; ?>user_guide/misc_info#shipped_cancelled_quantities">shipped item</a>' feature has been disabled, the points become active 'x' days after the order was first received rather than the date they were shipped.</p>				</div>
				<div class="frame_note">
					<a name="reward_point_days_valid"></a>
					<h6>reward_point_days_valid</h6>
					<p>Default: <em>365</em> | Data Type: <em>int</em></p>
					<hr/>
					<p>Defines how many days that reward points are valid for.</p>
					<p>Example: 365 = 365 days (1 year).</p>
					<p>Note: If soon to expire reward points are converted to a voucher, the voucher will then be valid for the number of set voucher days.</p>				</div>
				<div class="frame_note">
					<a name="reward_voucher_days_valid"></a>
					<h6>reward_voucher_days_valid</h6>
					<p>Default: <em>365</em> | Data Type: <em>int</em></p>
					<hr/>
					<p>Defines how many days that reward vouchers are valid for.</p>
					<p>Example: 365 = 365 days (1 year).</p>				</div>
				<div class="frame_note">
					<a name="custom_status_1"></a>
					<h6>custom_status_1</h6>
					<p>Default: <em>NULL</em> | Data Type: <em>string</em></p>
					<hr/>
					<p>Defines the default value of custom status #1.</p>
					<p>The status can be set to match the custom status requirements of a discount, if the statuses do not match, then the discount does not get activated.</p>
				</div>
				<div class="frame_note">
					<a name="custom_status_2"></a>
					<h6>custom_status_2</h6>
					<p>Default: <em>NULL</em> | Data Type: <em>string</em></p>
					<hr/>
					<p>Defines the default value of custom status #2.</p>
					<p>The status can be set to match the custom status requirements of a discount, if the statuses do not match, then the discount does not get activated.</p>
				</div>
				<div class="frame_note">
					<a name="custom_status_3"></a>
					<h6>custom_status_3</h6>
					<p>Default: <em>NULL</em> | Data Type: <em>string</em></p>
					<hr/>
					<p>Defines the default value of custom status #3.</p>
					<p>The status can be set to match the custom status requirements of a discount, if the statuses do not match, then the discount does not get activated.</p>
				</div>
			</div>	

			<a name="config_database"></a>
			<div class="w100 frame">
				<h3 class="heading">Defining Cart Configuration via the Database Table</h3>
				
				<div class="frame_note">
					<p>Contains general site settings that control specific functions and calculations of the shopping cart.</p>
				</div>

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
							<td>cart_config</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>order_number_prefix</td>
							<td>config_order_number_prefix</td>
							<td class="align_ctr">string</td>
							<td><a href="#order_number_prefix">See description</a></td>
						</tr>
						<tr>
							<td>order_number_suffix</td>
							<td>config_order_number_suffix</td>
							<td class="align_ctr">string</td>
							<td><a href="#order_number_suffix">See description</a></td>
						</tr>
						<tr>
							<td>increment_order_number</td>
							<td>config_increment_order_number</td>
							<td class="align_ctr">bool</td>
							<td><a href="#increment_order_number">See description</a></td>
						</tr>
						<tr>
							<td>minimum_order</td>
							<td>config_min_order</td>
							<td class="align_ctr">int</td>
							<td><a href="#minimum_order">See description</a></td>
						</tr>
						<tr>
							<td>quantity_decimals</td>
							<td>config_quantity_decimals</td>
							<td class="align_ctr">int</td>
							<td><a href="#quantity_decimals">See description</a></td>
						</tr>
						<tr>
							<td>increment_duplicate_item_quantity</td>
							<td>config_increment_duplicate_items</td>
							<td class="align_ctr">bool</td>
							<td><a href="#increment_duplicate_item_quantity">See description</a></td>
						</tr>
						<tr>
							<td>quantity_limited_by_stock</td>
							<td>config_quantity_limited_by_stock</td>
							<td class="align_ctr">bool</td>
							<td><a href="#quantity_limited_by_stock">See description</a></td>
						</tr>
						<tr>
							<td>remove_no_stock_items</td>
							<td>config_remove_no_stock_items</td>
							<td class="align_ctr">bool</td>
							<td><a href="#remove_no_stock_items">See description</a></td>
						</tr>
						<tr>
							<td>auto_allocate_stock</td>
							<td>config_auto_allocate_stock</td>
							<td class="align_ctr">bool</td>
							<td><a href="#auto_allocate_stock">See description</a></td>
						</tr>
						<tr>
							<td>save_banned_shipping_items</td>
							<td>config_save_ban_shipping_items</td>
							<td class="align_ctr">bool</td>
							<td><a href="#save_banned_shipping_items">See description</a></td>
						</tr>
						<tr>
							<td>weight_type</td>
							<td>config_weight_type</td>
							<td class="align_ctr">string</td>
							<td><a href="#weight_type">See description</a></td>
						</tr>
						<tr>
							<td>weight_decimals</td>
							<td>config_weight_decimals</td>
							<td class="align_ctr">int</td>
							<td><a href="#weight_decimals">See description</a></td>
						</tr>
						<tr>
							<td>display_tax_prices</td>
							<td>config_display_tax_prices</td>
							<td class="align_ctr">bool</td>
							<td><a href="#display_tax_prices">See description</a></td>
						</tr>
						<tr>
							<td>price_inc_tax</td>
							<td>config_price_inc_tax</td>
							<td class="align_ctr">bool</td>
							<td><a href="#price_inc_tax">See description</a></td>
						</tr>
						<tr>
							<td>multi_row_duplicate_items</td>
							<td>config_multi_row_duplicate_items</td>
							<td class="align_ctr">bool</td>
							<td><a href="#multi_row_duplicate_items">See description</a></td>
						</tr>
						<tr>
							<td>dynamic_reward_points</td>
							<td>config_dynamic_reward_points</td>
							<td class="align_ctr">bool</td>
							<td><a href="#dynamic_reward_points">See description</a></td>
						</tr>
						<tr>
							<td>reward_point_multiplier</td>
							<td>config_reward_point_multiplier</td>
							<td class="align_ctr">int</td>
							<td><a href="#reward_point_multiplier">See description</a></td>
						</tr>
						<tr>
							<td>reward_voucher_multiplier</td>
							<td>config_reward_voucher_multiplier</td>
							<td class="align_ctr">int</td>
							<td><a href="#reward_voucher_multiplier">See description</a></td>
						</tr>
						<tr>
							<td>reward_point_to_voucher_ratio</td>
							<td>config_reward_voucher_ratio</td>
							<td class="align_ctr">int</td>
							<td><a href="#reward_point_to_voucher_ratio">See description</a></td>
						</tr>
						<tr>
							<td>reward_point_days_pending</td>
							<td>config_reward_point_days_pending</td>
							<td class="align_ctr">int</td>
							<td><a href="#reward_point_days_pending">See description</a></td>
						</tr>
						<tr>
							<td>reward_point_days_valid</td>
							<td>config_reward_point_days_valid</td>
							<td class="align_ctr">int</td>
							<td><a href="#reward_point_days_valid">See description</a></td>
						</tr>
						<tr>
							<td>reward_voucher_days_valid</td>
							<td>config_reward_voucher_days_valid</td>
							<td class="align_ctr">int</td>
							<td><a href="#reward_voucher_days_valid">See description</a></td>
						</tr>
						<tr>
							<td>custom_status_1</td>
							<td>config_custom_status_1</td>
							<td class="align_ctr">bool</td>
							<td><a href="#custom_status_1">See description</a></td>
						</tr>
						<tr>
							<td>custom_status_2</td>
							<td>config_custom_status_2</td>
							<td class="align_ctr">bool</td>
							<td><a href="#custom_status_2">See description</a></td>
						</tr>
						<tr>
							<td>custom_status_3</td>
							<td>config_custom_status_3</td>
							<td class="align_ctr">bool</td>
							<td><a href="#custom_status_3">See description</a></td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>No columns are required, all disabled columns must be set as 'FALSE'.</p>
					<p>If a column is disabled, the hard coded default value defined via the <a href="#config_defaults">config file</a> will be used.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['configuration']['table'] = 'cart_config';
$config['database']['configuration']['columns']['id'] = 'config_id';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling a column.</span>

$config['database']['configuration']['columns']['order_number_prefix'] = FALSE;
</pre>
<pre>
<span class="comment bold">// Example #3 : Disabling the table.</span>

$config['database']['configuration']['table'] = FALSE;
</pre>
			</div>
			
			<a name="config_defaults"></a>
			<div class="w100 frame">
				<h3 class="heading">Defining Cart Configuration via the Config File.</h3>
				
				<div class="frame_note">
					<p>Default cart configuration settings can be set to configure the cart when it is first loaded.</p>
					<p>Setting default values via the config file is only necessary if the configuration database table is not enabled.</p>
					<p>Defaults set via the config file are only used if no default value has been set by the configuration database table.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example of defining an order number prefix set via the config file.</span>

$config['defaults']['configuration']['order_number_prefix'] = 'example_prefix';
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