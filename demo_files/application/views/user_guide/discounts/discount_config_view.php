<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Discount Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for configuring discount in flexi cart."/> 
	<meta name="keywords" content="discount configuration, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Discount Configuration</h1>
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

			<h2>Discount Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/discount_index">Discount Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_session_data">Get Discount Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_helper_data">Get Discount Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_set_data">Set Discount Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_admin">Discount Admin Data</a>

			<div class="anchor_nav">
				<h6>Config Setup Information</h6>
				<p>
					<a href="#db_schema_diagram">Table Schema Diagram</a> | <a href="#discount_setup_notes">Setup Notes</a>
				</p>
				<h6>Table Settings</h6>
				<p>
					<a href="#discounts_table">Discounts Table</a> | <a href="#discount_groups_table">Discount Groups Table</a> | <a href="#discount_group_items_table">Discount Group Items Table</a><br/>
					<a href="#discount_method_table">Discount Method Table</a> | <a href="#discount_type_table">Discount Types Table</a> | <a href="#discount_calculations_table">Discount Calculations Table</a> | <a href="#discount_columns_table">Discount Columns Table</a> | <a href="#discount_tax_methods_table">Discount Tax Methods Table</a>
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
				<h3 class="heading">Discount Table Schema Diagram</h3>
				<div class="frame_note">
					<p>
						A database table schema diagram, showing how the discount tables are related to each other and the location, custom item and user tables.<br/>
						Note: The custom item and user tables must be created by you. The diagram highlights how they can be related to the discount tables.<br/>
						Table and columns names are defined using their internal names.
					</p>
				</div>
				<img src="<?php echo $includes_dir; ?>images/db_diagrams/discount_tables.jpg" class="db_schema_diagram"/>
			</div>			
			
			<a name="discount_setup_notes"></a>
			<div class="w100 frame">
				<h3 class="heading">General Discount Setup Notes</h3>
				<p>Below are some general notes to consider when setting up and managing the discount tables.</p>
				<ul>
					<li>
						All discount currency values must always be based on the carts internal currency, regardless of whether the customer is viewing prices in a different currency.
					</li>
					<li>
						Only one discount can be applied per item or summary column, however, if applicable, the same discount can be applied to the same item multiple times.
					</li>
					<li>
						If multiple discounts are eligible to be applied to an item or summary column, the discount with the lowest 'order by' value will be given priority.
					</li>
					<li>
						In the event that a discount can by applied directly to an item, or to the same item within an item discount group; then the discount is applied directly to the item rather than the item group.<br/>
						If a discount is then applied to the same item discount group via other items in the cart, the value and quantity of the item that has a discount directly applied to it will not be added to the item discount groups total value and quantity.
					</li>
					<li>
						Discounts that are applied to items within an item discount group are applied to the cheapest items first.
					</li>
					<li>
						The 'New Value' discount method cannot be applied to the summary item total (Total of all items), or summary total (Cart total) columns. If this was allowed, then a cart of unlimited items could be purchased for the 'New Value' price.
					</li>
				</ul>
			</div>
		
			<a name="discounts_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Discounts Table</h3>
				
				<p>Contains item and summary discounts, based on either entered discount codes or item quantities and values added to the cart.</p>
				<p>The discount table is also used to convert customer reward points to vouchers.</p>
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
							<td>discounts</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>disc_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>type</td>
							<td>disc_type_fk</td>
							<td class="align_ctr">int</td>
							<td>
								The value acts as a foreign key relating the table to the primary key of the discount type table.
							</td>
						</tr>
						<tr>
							<td>method</td>
							<td>disc_method_fk</td>
							<td class="align_ctr">int</td>
							<td>
								The value acts as a foreign key relating the table to the primary key of the discount method table.
							</td>
						</tr>
						<tr>
							<td>tax_method</td>
							<td>disc_tax_method_fk</td>
							<td class="align_ctr">int</td>
							<td>
								The value acts as a foreign key relating the table to the primary key of the discount tax method table.
							</td>
						</tr>
						<tr>
							<td>user</td>
							<td>disc_user_acc_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates a reward voucher saved in the discount table to a user.<br/>
								The column has no affect on the functioning of discounts.<br/>
								The value acts as a foreign key relating the table to the primary key of a converted reward point table. It could also be used to relate the table to a custom user table, although this is not joined by default.
							</td>
						</tr>
						<tr>
							<td>item</td>
							<td>disc_item_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the discount to an item (product) in the cart.<br/>
								The value CAN be used to act as a foreign key relating the table to the primary key of a custom item (product) table, although this is not joined by default.
							</td>
						</tr>
						<tr>
							<td>group</td>
							<td>disc_group_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the discount to a discount group of items (products).<br/>
								The value acts as a foreign key relating the table to the primary key of a discount group table.
							</td>
						</tr>
						<tr>
							<td>location</td>
							<td>disc_location_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the discount to a location, so it will only be displayed if that location is set.<br/>
								The value acts as a foreign key relating the table to the primary key of the location table.
							</td>
						</tr>
						<tr>
							<td>zone</td>
							<td>disc_zone_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the discount to a location zone, so it will only be displayed if a location from that zone is set.<br/>
								The value acts as a foreign key relating the table to the primary key of the location zones table.
							</td>
						</tr>
						<tr>
							<td>code</td>
							<td>disc_code</td>
							<td class="align_ctr">string</td>
							<td>The discount code that can be set to activate the discount.</td>
						</tr>
						<tr>
							<td>description</td>
							<td>disc_description</td>
							<td class="align_ctr">string</td>
							<td>The description of the discount.</td>
						</tr>
						<tr>
							<td>quantity_required</td>
							<td>disc_quantity_required</td>
							<td class="align_ctr">int</td>
							<td>The minimum quantity of related items that must be added to the cart before the discount can be activated.</td>
						</tr>
						<tr>
							<td>quantity_discounted</td>
							<td>disc_quantity_discounted</td>
							<td class="align_ctr">int</td>
							<td>The quantity of related items that the discount will be applied to.</td>
						</tr>
						<tr>
							<td>value_required</td>
							<td>disc_value_required</td>
							<td class="align_ctr">int</td>
							<td>The minimum value (price) of related items that must be added to the cart before the discount can be activated.</td>
						</tr>
						<tr>
							<td>value_discounted</td>
							<td>disc_value_discounted</td>
							<td class="align_ctr">string</td>
							<td>The discount value will be applied to the applicable discounted items.</td>
						</tr>
						<tr>
							<td>recursive</td>
							<td>disc_recursive</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines whether the discount should be reapplied recursively to items in the cart.<br/>
								Example: If 'recursive' is enabled, a 'Buy 1, get 1 free' discount can be reapplied if 2, 4, 6 (etc) items are added to the cart.<br/>
								If disabled, the discount is only applied for the first 2 items.
							</td>
						</tr>
						<tr>
							<td>non_combinable</td>
							<td>disc_non_combinable_discount</td>
							<td class="align_ctr">bool</td>
							<td>Defines whether other discounts can be applied if this discount is applied to the cart.</td>
						</tr>
						<tr>
							<td>void_reward_points</td>
							<td>disc_void_reward_points</td>
							<td class="align_ctr">bool</td>
							<td>Defines whether reward points should be voided for the entire cart if the discount is applied.</td>
						</tr>
						<tr>
							<td>force_shipping_discount</td>
							<td>disc_force_ship_discount</td>
							<td class="align_ctr">bool</td>
							<td>Defines whether the discount should be applied to the shipping option, regardless of whether the shipping option is defined as being excluded from discounts.</td>
						</tr>
						<tr>
							<td>custom_status_1</td>
							<td>disc_custom_status_1</td>
							<td class="align_ctr">string | int</td>
							<td>Defines a value that the cart session custom status #1 must match for the discount to be applied.</td>
						</tr>
						<tr>
							<td>custom_status_2</td>
							<td>disc_custom_status_2</td>
							<td class="align_ctr">string | int</td>
							<td>Defines a value that the cart session custom status #2 must match for the discount to be applied.</td>
						</tr>
						<tr>
							<td>custom_status_3</td>
							<td>disc_custom_status_3</td>
							<td class="align_ctr">string | int</td>
							<td>Defines a value that the cart session custom status #3 must match for the discount to be applied.</td>
						</tr>
						<tr>
							<td>usage_limit</td>
							<td>disc_usage_limit</td>
							<td class="align_ctr">int</td>
							<td>The limit to the number of times the discount can be used.</td>
						</tr>
						<tr>
							<td>valid_date</td>
							<td>disc_valid_date</td>
							<td class="align_ctr">string | int</td>
							<td>
								The date and time that the discount valid from.<br/>
								The data type of this column can either be mysql datetime or a unix timestamp.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/cart_config_internal#date_time">internal config</a> documentation regarding setting the carts date and time settings.
							</td>
						</tr>
						<tr>
							<td>expire_date</td>
							<td>disc_expire_date</td>
							<td class="align_ctr">string | int</td>
							<td>
								The date and time that the discount expires by.<br/>
								The data type of this column can either be mysql datetime or a unix timestamp.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/cart_config_internal#date_time">internal config</a> documentation regarding setting the carts date and time settings.
							</td>
						</tr>
						<tr>
							<td>status</td>
							<td>disc_status</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines the status of whether the discount is active or disabled.<br/>
								Disabled records will not be used by flexi cart functions.
							</td>
						</tr>
						<tr>
							<td>order_by</td>
							<td>disc_order_by</td>
							<td class="align_ctr">int</td>
							<td>
								Defines the order priority of how a discount is applied to the cart.<br/>
								Only one discount can be applied per item or per summary column.<br/>
								Therefore, if two or more discounts could be applied, the discount with the lowest 'order_by' value will be applied first.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and all other discount tables must be enabled too.</p>
					<p>The related location, custom item or user tables do not need to be enabled to use discount tables.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['discounts']['table'] = 'discounts';
$config['database']['discounts']['columns']['id'] = 'disc_id'; 
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['discounts']['table'] = FALSE;
</pre>
			</div>
						
			<a name="discount_groups_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Discount Groups Table</h3>
				
				<p>To maintain flexibility with different database structures, rather than being able to apply discounts to item categories, manufacturers etc., that will be different per database setup, discount groups can be used instead. A discount can then be applied to the group that will affect all items in the group.</p>
				<p>The discount group setup consists of two tables, a table containing the group name, and a table containing the foreign key of the group id and item ids.</p>
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
							<td>discount_groups</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>disc_group_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>name</td>
							<td>disc_group</td>
							<td class="align_ctr">string</td>
							<td>The name of the discount group.</td>
						</tr>
						<tr>
							<td>status</td>
							<td>disc_group_status</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines the status of whether the discount group is active or disabled.<br/>
								Disabled records will not be used by flexi cart functions.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and all other discount tables must be enabled too.</p>
					<p>The related location, custom item or user tables do not need to be enabled to use discount tables.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['discount_groups']['table'] = 'discount_groups';
$config['database']['discount_groups']['columns']['id'] = 'disc_group_id'; 
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['discount_groups']['table'] = FALSE;
</pre>
			</div>
						
			<a name="discount_group_items_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Discount Group Items Table</h3>
				
				<p>Contains the id of items that are in a specific discount group.</p>
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
							<td>discount_group_items</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>disc_group_item_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>group</td>
							<td>disc_group_item_group_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the discount group item to a discount group.<br/>
								The value acts as a foreign key relating the table to the primary key of discount group table.
							</td>
						</tr>
						<tr>
							<td>item</td>
							<td>disc_group_item_item_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the discount group item to an item (product) in the cart.<br/>
								The value CAN be used to act as a foreign key relating the table to the primary key of a custom item (product) table, although this is not joined by default.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and all other discount tables must be enabled too.</p>
					<p>The related location, custom item or user tables do not need to be enabled to use discount tables.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['discount_group_items']['table'] = 'discount_group_items';
$config['database']['discount_group_items']['columns']['id'] = 'disc_group_item_id'; 
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['discount_group_items']['table'] = FALSE;
</pre>
			</div>
					
			<a name="discount_method_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Discount Method Table</h3>
				
				<p>
					Contains the data for the different discount application methods.<br/>
					Example: A summary discount, that targets the shipping total column with a percentage based discount.
				</p>
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
							<td>discount_methods</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>disc_method_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>type</td>
							<td>disc_method_type_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the discount method to the type of discount (Item, summary, voucher discount).<br/>
								The value acts as a foreign key relating the table to the primary key of the discount type table.
							</td>
						</tr>
						<tr>
							<td>target_column</td>
							<td>disc_method_column_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the discount method to the item or summary column that is to be discounted.<br/>
								The value acts as a foreign key relating the table to the primary key of the discount columns table.
							</td>
						</tr>
						<tr>
							<td>calculation</td>
							<td>disc_method_calculation_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the discount method to the type of discount calculation that is to be applied (Percentage based, flat fee, new value discount).<br/>
								The value acts as a foreign key relating the table to the primary key of the discount calculation table.
							</td>
						</tr>
						<tr>
							<td>method</td>
							<td>disc_method</td>
							<td class="align_ctr">string</td>
							<td>The name of the discount method.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and all other discount tables must be enabled too.</p>
					<p>The related location, custom item or user tables do not need to be enabled to use discount tables.</p>
					<hr/>
					<p class="highlight_red">IMPORTANT NOTE: The discount 'method' text may be changed, but no rows or columns should be deleted or added.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['discount_methods']['table'] = 'discount_methods';
$config['database']['discount_methods']['columns']['id'] = 'disc_method_id'; 
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['discount_methods']['table'] = FALSE;
</pre>
			</div>
						
			<a name="discount_type_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Discount Types Table</h3>
				
				<p>
					Contains the id and text label for the different types of discounts available.<br/>
					Types Available: 'Item Discount', 'Summary Discount' and 'Reward Voucher' discounts.
				</p>
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
							<td>discount_types</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>disc_type_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>type</td>
							<td>disc_type</td>
							<td class="align_ctr">string</td>
							<td>The name of the discount type.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and all other discount tables must be enabled too.</p>
					<p>The related location, custom item or user tables do not need to be enabled to use discount tables.</p>
					<hr/>
					<p class="highlight_red">IMPORTANT NOTE: The discount 'type' text may be changed, but no rows or columns should be deleted or added.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['discount_types']['table'] = 'discount_types';
$config['database']['discount_types']['columns']['id'] = 'disc_type_id'; 
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['discount_types']['table'] = FALSE;
</pre>
			</div>
					
			<a name="discount_calculations_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Discount Calculations Table</h3>
				
				<p>
					Contains the id and text label for the different types of discount calculation methods.<br/>
					Types Available: 'Percentage based', 'Flat Fee' and 'New Value' discounts.
				</p>
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
							<td>discount_calculation</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>disc_calculation_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>calculation</td>
							<td>disc_calculation</td>
							<td class="align_ctr">string</td>
							<td>The name of the discount calculation method.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and all other discount tables must be enabled too.</p>
					<p>The related location, custom item or user tables do not need to be enabled to use discount tables.</p>
					<hr/>
					<p class="highlight_red">IMPORTANT NOTE: The discount 'calculation' text may be changed, but no rows or columns should be deleted or added.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['discount_calculation']['table'] = 'discount_calculation';
$config['database']['discount_calculation']['columns']['id'] = 'disc_calculation_id'; 
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['discount_calculation']['table'] = FALSE;
</pre>
			</div>
					
			<a name="discount_columns_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Discount Columns Table</h3>
				
				<p>
					Contains the id and text label for the different cart columns that discounts can be applied to.<br/>
					Types Available: 'Item price', 'Item Shipping', 'Summary Item Total', 'Summary Shipping Total', 'Summary Total' and 'Summary Total (Voucher)'.
				</p>
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
							<td>discount_columns</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>disc_column_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>target_column</td>
							<td>disc_column</td>
							<td class="align_ctr">string</td>
							<td>The name of the column the discount is to be applied to.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and all other discount tables must be enabled too.</p>
					<p>The related location, custom item or user tables do not need to be enabled to use discount tables.</p>
					<hr/>
					<p class="highlight_red">IMPORTANT NOTE: The discount 'target_column' text may be changed, but no rows or columns should be deleted or added.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['discount_columns']['table'] = 'discount_columns';
$config['database']['discount_columns']['columns']['id'] = 'disc_column_id'; 
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['discount_columns']['table'] = FALSE;
</pre>
			</div>
					
			<a name="discount_tax_methods_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Discount Tax Methods Table</h3>
				
				<p>Contains the id and text label for the different methods of applying tax to discounts.</p>
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
							<td>discount_tax_methods</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>disc_tax_method_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>method</td>
							<td>disc_tax_method</td>
							<td class="align_ctr">string</td>
							<td>The name of the discount tax method.</td>
						</tr>
					</tbody>
				</table>

				<h6>Types of Discount Tax Methods</h6>
				<div class="frame_note">
					<p>Tax laws vary between countries and states, so to comply with these laws, discounts and tax can be applied using three different methods.</p>
					<hr/>
					<p>
						<strong>Method #1</strong> : Calculate non-discounted value including tax, then apply discount to value.<br/>
						This method is typically used for carts setup with item prices including tax.<br/>
						This is by default defined in the database discount tax method table as '<em>Apply Tax Before Discount</em>'.
					</p>
					<hr/>
					<p>
						<strong>Method #2</strong> : Calculate non-discounted value excluding tax, then apply discount to value, then apply tax rate to discounted value.<br/>
						This method is typically used for carts setup with item prices excluding tax.<br/>
						This is by default defined in the database discount tax method table as '<em>Apply Discount Before Tax</em>'.
					</p>
					<hr/>
					<p>
						<strong>Method #3</strong> : Calculate tax of non-discounted value, then apply discount to value excluding tax, then add the original tax value to discounted value.<br/>
						This method is typically used for 'Manufacturer Coupon' discounts, when the items full non-discounted tax value must still be paid by the customer.<br/>
						This is by default defined in the database discount tax method table as '<em>Apply Discount Before Tax, Add Original Tax</em>'.
					</p>
					<hr/>
					<p>
						Examples of these tax methods are available via the demos '<a href="<?php echo $base_url; ?>lite_library/item_discount_examples">Item Discount Examples</a>'.<br/>
						Remember that the values returned will vary depending on whether cart prices are set to include taxes, so try toggling tax settings to see how the values are affected.
					</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and all other discount tables must be enabled too.</p>
					<p>The related location, custom item or user tables do not need to be enabled to use discount tables.</p>
					<hr/>
					<p class="highlight_red">IMPORTANT NOTE: The discount 'method' text may be changed, but no rows or columns should be deleted or added.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['discount_tax_methods']['table'] = 'discount_tax_methods';
$config['database']['discount_tax_methods']['columns']['id'] = 'disc_tax_method_id'; 
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['discount_tax_methods']['table'] = FALSE;
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