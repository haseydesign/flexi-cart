<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Admin Order Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for admin order functions in flexi cart."/> 
	<meta name="keywords" content="admin order functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Admin Order Functions</h1>
				<p>Admin functions are available from the flexi cart admin library and are primarily used to manage data within flexi carts database tables.</p>
				<p>
					Many of the functions perform CRUD functionality returning SELECT queries and running INSERT, UPDATE and DELETE statements.<br/>
					The CRUD functions are automatically joined to other related tables and allow custom statements to be run, with minimal configuration required.
				</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
					
			<h2>Admin Order Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/order_index">Order Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_config">Order Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_helper_data">Get Order Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_set_data">Save Order Data</a>

			<div class="anchor_nav">
				<h6>Order Management Functions</h6>
				<p>
					<a href="#get_refund_itemised">get_refund_itemised()</a> | <a href="#get_refund_summary">get_refund_summary()</a>
				</p>
				<h6>Order SELECT Functions</h6>
				<p>
					<a href="#search_orders">search_orders()</a> | <a href="#get_db_order">get_db_order()</a> | <a href="#get_db_order_summary">get_db_order_summary()</a> | <a href="#get_db_order_detail">get_db_order_detail()</a>
				</p>
				<h6>Order UPDATE / DELETE Functions</h6>
				<p>
					<a href="#update_db_order_summary">update_db_order_summary()</a> | <a href="#update_db_order_details">update_db_order_details()</a> | <a href="#delete_db_order">delete_db_order()</a>
				</p>
				<h6>Order Status CRUD Functions</h6>
				<p>
					<a href="#get_db_order_status">get_db_order_status()</a> | <a href="#insert_db_order_status">insert_db_order_status()</a> | <a href="#update_db_order_status">update_db_order_status()</a> | <a href="#delete_db_order_status">delete_db_order_status()</a>
				</p>
			</div>
			
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with Admin Functions</h3>
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

			<a name="get_refund_itemised"></a>
			<div class="w100 frame">
				<h3 class="heading">get_refund_itemised()</h3>
				
				<p>Gets an itemised query of refund totals for all items that have been cancelled within an order.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables, and the '<a href="<?php echo $base_url; ?>user_guide/misc_info#shipped_cancelled_quantities">shipped</a>' and '<a href="<?php echo $base_url; ?>user_guide/misc_info#shipped_cancelled_quantities">cancelled</a>' order detail columns to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_refund_itemised(order_number)</code>
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
							<td>order_number</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the unique order number of the order to calculate the refund data for.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function checks which order detail columns are enabled via the config file, and then runs an SQL query multiplying each quantity and currency total against the number of items that have been set as 'cancelled'.</p>
					<p>The order detail columns that are queried are 'item_price', 'item_discount_price', 'item_tax', 'item_shipping_rate', 'item_weight' and 'item_reward_points'.</p>
					<p>The function returns an itemised query of the refund totals for each item row.</p>
				</div>
			
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						Note: This function is only intended to be used as an accurate ESTIMATE of the value that should be refunded.<br/>
						The returned value does not include any percentage based surcharge or discount values that may have been applied to the orders summary values.<br/>
						A true representation of the orders new value can be achieved by reloading the 'to-be-refunded' order from the 'db_cart_data' table data, and resaving the order.
					</p>
					<hr/>
					<p>This function can be chained with CodeIgniters query functions 'result()', 'row()' etc.</p>
					<p>
						Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on all the combined flexi cart and CodeIgniter functions that are available.
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>object</p>
				</div>
				
				<h6>Example</h6>
<pre>
$order_number = 'example_order_number';

<span class="comment">// Example of chaining CI's query function 'result()'.</span>
$this->flexi_cart_admin->get_refund_itemised($order_number)->result();
</pre>
			</div>

			<a name="get_refund_summary"></a>
			<div class="w100 frame">
				<h3 class="heading">get_refund_summary()</h3>
				
				<p>Gets a summary of refund totals for all items that have been cancelled within an order.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_refund_itemised(order_number)</code>
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
							<td>order_number</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the unique order number of the order to calculate the refund data for.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function checks which order detail columns are enabled via the config file, and then runs an SQL query multiplying each quantity and currency total against the number of items that have been set as 'cancelled'.</p>
					<p>The order detail columns that are queried are 'item_price', 'item_discount_price', 'item_tax', 'item_shipping_rate', 'item_weight' and 'item_reward_points'.</p>
					<p>The function returns a summarised query of the refund totals for the whole order using SQL's SUM() aggregate function.</p>
				</div>
			
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						Note: This function is only intended to be used as an accurate ESTIMATE of the value that should be refunded.<br/>
						The returned value does not include any percentage based surcharge or discount values that may have been applied to the orders summary value.<br/>
						A true representation of the orders new value can be achieved by reloading the 'to-be-refunded' order from the 'db_cart_data' table data, and resaving the order.
					</p>
					<hr/>
					<p>This function can be chained with CodeIgniters query functions 'result()', 'row()' etc.</p>
					<p>
						Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on all the combined flexi cart and CodeIgniter functions that are available.
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>object</p>
				</div>
				
				<h6>Example</h6>
<pre>
$order_number = 'example_order_number';

<span class="comment">// Example of chaining CI's query function 'row()'.</span>
$this->flexi_cart_admin->get_refund_summary($order_number)->row();
</pre>
			</div>
			
			<a name="search_orders"></a>
			<div class="w100 frame">
				<h3 class="heading">search_orders()</h3>
				
				<p>Gets data from the order summary and order status table via a keyword based search query.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>search_orders(search_query, exact_match, sql_select, sql_where)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>search_query</td>
							<td class="align_ctr">string | array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the search terms used to query the order summary table.</td>
						</tr>
						<tr>
							<td>exact_match</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define whether all keywords within the search query must be in the matched records.<br/>
								Example: For a search query of "John Smith", an exact match would not return a record matching the name "John".
							</td>
						</tr>
						<tr>
							<td>sql_select</td>
							<td class="align_ctr">string | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define the database fields returned via an SQL SELECT statement.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>sql_where</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database records to return.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function works in a similar way to the <a href="#get_db_order_summary">get_db_order_summary()</a> function, with the exception that it allows the returned results to be additionally filtered via search terms.</p>
					<p>The submitted search term is split into individual terms that are then each matched against specific table columns that have been defined via the setting 'search_order_cols' in the libraries config. file.</p>
					<p>If the function has defined the query to only return exact matches, then the SQL function will only return records where every individual term is matched to each record.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function is compatible with flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder">Query Builder</a>' functions.</p>
					<hr/>
					<p>This function can be chained with CodeIgniters query functions 'result()', 'row()' etc.</p>
					<p>
						Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on all the combined flexi cart and CodeIgniter functions that are available.
					</p>
					<hr/>
					<p>
						If a string or int value is submitted to the 'sql_where' parameter, the function will match the value against the order number column.<br/>
						Example: If 'sql_where' is submitted as 'X0123Y', the SQL WHERE statement will be "<code>WHERE 'order_number_column' = 'X0123Y'</code>".
					</p>
					<p>
						Note that this is functionality is different from other functions that only perform this behaviour when an int value is submitted.<br/>
						This does however mean that string based SQL WHERE statements can not be used with this function, an array must be used instead.
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>object</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$search_query = 'John Smith';
$exact_match = false;
$sql_select = array(...);
$sql_where = array(...);

<span class="comment">// Example of chaining CI's query function 'result()'.
// Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on available functions.</span>
$this->flexi_cart_admin->search_orders($search_query, $exact_match, $sql_select, $sql_where)->result();
</pre>
			</div>

			<a name="get_db_order"></a>
			<div class="w100 frame">
				<h3 class="heading">get_db_order()</h3>
				
				<p>Gets records from the order summary and order detail table using a user defined SQL SELECT query.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_db_order(sql_select, sql_where)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>sql_select</td>
							<td class="align_ctr">string | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define the database fields returned via an SQL SELECT statement.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>sql_where</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database records to return.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs a joined SQL SELECT statement on the 'Order Summary', 'Order Details' and 'Order Status' tables.</p>
					<p>The query can be customised by submitting 'sql_select' and 'sql_where' data to the functions parameters.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function is compatible with flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder">Query Builder</a>' functions.</p>
					<hr/>
					<p>This function can be chained with CodeIgniters query functions 'result()', 'row()' etc.</p>
					<p>
						Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on all the combined flexi cart and CodeIgniter functions that are available.
					</p>
					<hr/>
					<p>
						If a string or int value is submitted to the 'sql_where' parameter, the function will match the value against the order number column.<br/>
						Example: If 'sql_where' is submitted as 'X0123Y', the SQL WHERE statement will be "<code>WHERE 'order_number_column' = 'X0123Y'</code>".
					</p>
					<p>
						Note that this is functionality is different from other functions that only perform this behaviour when an int value is submitted.<br/>
						This does however mean that string based SQL WHERE statements can not be used with this function, an array must be used instead.
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>object</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_select = array(...);
$sql_where = array(...);

<span class="comment">// Example of chaining CI's query function 'result()'.
// Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on available functions.</span>
$this->flexi_cart_admin->get_db_order($sql_select, $sql_where)->result();
</pre>
			</div>

			<a name="get_db_order_summary"></a>
			<div class="w100 frame">
				<h3 class="heading">get_db_order_summary()</h3>
				
				<p>Gets records from the order summary table using a user defined SQL SELECT query.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_db_order_summary(sql_select, sql_where)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>sql_select</td>
							<td class="align_ctr">string | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define the database fields returned via an SQL SELECT statement.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>sql_where</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database records to return.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs a joined SQL SELECT statement on the 'Order Summary' and 'Order Status' tables.</p>
					<p>The query can be customised by submitting 'sql_select' and 'sql_where' data to the functions parameters.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function is compatible with flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder">Query Builder</a>' functions.</p>
					<hr/>
					<p>This function can be chained with CodeIgniters query functions 'result()', 'row()' etc.</p>
					<p>
						Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on all the combined flexi cart and CodeIgniter functions that are available.
					</p>
					<hr/>
					<p>
						If a string or int value is submitted to the 'sql_where' parameter, the function will match the value against the order number column.<br/>
						Example: If 'sql_where' is submitted as 'X0123Y', the SQL WHERE statement will be "<code>WHERE 'order_number_column' = 'X0123Y'</code>".
					</p>
					<p>
						Note that this is functionality is different from other functions that only perform this behaviour when an int value is submitted.<br/>
						This does however mean that string based SQL WHERE statements can not be used with this function, an array must be used instead.
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>object</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_select = array(...);
$sql_where = array(...);

<span class="comment">// Example of chaining CI's query function 'result()'.
// Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on available functions.</span>
$this->flexi_cart_admin->get_db_order_summary($sql_select, $sql_where)->result();
</pre>
			</div>

			<a name="get_db_order_detail"></a>
			<div class="w100 frame">
				<h3 class="heading">get_db_order_detail()</h3>
				
				<p>Gets records from the order detail table using a user defined SQL SELECT query.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_db_order_detail(sql_select, sql_where)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>sql_select</td>
							<td class="align_ctr">string | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define the database fields returned via an SQL SELECT statement.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>sql_where</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database records to return.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL SELECT statement on the ''Order Details' table.</p>
					<p>By default, the SQL statement is NOT joined to any other order table, but can be by using flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder#sql_join">Query Builder - SQL JOIN</a>' function. Alternatively use the '<a href="#get_db_order">get_db_order()</a>' function.</p>
					<p>The query can be customised by submitting 'sql_select' and 'sql_where' data to the functions parameters.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function is compatible with flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder">Query Builder</a>' functions.</p>
					<hr/>
					<p>This function can be chained with CodeIgniters query functions 'result()', 'row()' etc.</p>
					<p>
						Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on all the combined flexi cart and CodeIgniter functions that are available.
					</p>
					<hr/>
					<p>
						If an int value is submitted to the 'sql_where' parameter, the function will automatically match the value against the tables primary key.<br/>
						Example: If 'sql_where' is submitted as an int of '101', the SQL WHERE statement will be "<code>WHERE 'primary_key_column' = 101</code>".
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>object</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_select = array(...);
$sql_where = array(...);

<span class="comment">// Example of chaining CI's query function 'result()'.
// Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on available functions.</span>
$this->flexi_cart_admin->get_db_order_detail($sql_select, $sql_where)->result();
</pre>
			</div>
			
			<a name="update_db_order_summary"></a>
			<div class="w100 frame">
				<h3 class="heading">update_db_order_summary()</h3>
				
				<p>Updates records in the order summary table using a user defined SQL WHERE and UPDATE statement.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>update_db_order_summary(sql_update, sql_where)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>sql_update</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL UPDATE statement used to update data into the database.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>sql_where</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database records to update.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL UPDATE statement on the 'Order Summary' table, updating data defined via the 'sql_update' parameter and filtered via the 'sql_where' parameter.</p>
				</div>
			
				<h6>Notes</h6>
				<div class="frame_note">
					<p>It is not recommended to use this function to update data regarding summary totals. The reason being that the data will not be able to be relate to the saved item totals in the order details table. However, updating other non-summary total data is fine to do.</p>
					<p>If the status of an order is changed, the function will automatically manage the stock and discount allocation if defined to do so via the carts config settings. This means if an order is cancelled (Or uncancelled), the stock and discount usage limits will be reallocated accordingly.</p>
					<hr/>
					<p>This function is compatible with flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder">Query Builder</a>' functions.</p>
					<hr/>
					<p>
						If a string or int value is submitted to the 'sql_where' parameter, the function will match the value against the order number column.<br/>
						Example: If 'sql_where' is submitted as 'X0123Y', the SQL WHERE statement will be "<code>WHERE 'order_number_column' = 'X0123Y'</code>".
					</p>
					<p>
						Note that this is functionality is different from other functions that only perform this behaviour when an int value is submitted.<br/>
						This does however mean that string based SQL WHERE statements can not be used with this function, an array must be used instead.
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>int | The number of affected rows.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_update = array(...);
$sql_where = array(...);

$this->flexi_cart_admin->update_db_order_summary($sql_update, $sql_where);
</pre>
			</div>
			
			<a name="update_db_order_details"></a>
			<div class="w100 frame">
				<h3 class="heading">update_db_order_details()</h3>
				
				<p>Updates records in the order detail table using a user defined SQL WHERE and UPDATE statement.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>update_db_order_details(sql_update, sql_where)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>sql_update</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL UPDATE statement used to update data into the database.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>sql_where</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database records to update.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL UPDATE statement on the 'Order Details' table, updating data defined via the 'sql_update' parameter and filtered via the 'sql_where' parameter.</p>
				</div>
			
				<h6>Notes</h6>
				<div class="frame_note">
					<p>It is not recommended to use this function to update data regarding item pricing or ordered item quantities. The reason being that the data will not be updated in the related order summary table.</p>
					<p>However, it is recommended to use this function to update quantities from the 'item_quantity_shipped' and 'item_quantity_cancelled' columns as the function will automatically manage the stock allocation if defined to do so via the carts config settings.</p>
					<p>Whereas the function manages stock allocation, it does not manage the usage limits of discounts and reward vouchers. Discount and reward voucher usage limits are only reallocated if the complete order status is cancelled via the '<a href="#update_db_order_summary">update_db_order_summary()</a>' function.</p>
					<hr/>
					<p>This function is compatible with flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder">Query Builder</a>' functions.</p>
					<hr/>
					<p>
						If an int value is submitted to the 'sql_where' parameter, the function will automatically match the value against the tables primary key.<br/>
						Example: If 'sql_where' is submitted as an int of '101', the SQL WHERE statement will be "<code>WHERE 'primary_key_column' = 101</code>".
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>int | The number of affected rows.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_update = array(...);
$sql_where = array(...);

$this->flexi_cart_admin->update_db_order_details($sql_update, $sql_where);
</pre>
			</div>

			<a name="delete_db_order"></a>
			<div class="w100 frame">
				<h3 class="heading">delete_db_order()</h3>
				
				<p>Deletes records from the order summary and order detail table using a user defined SQL WHERE statement.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>delete_db_order(order_number)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>order_number</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Sets the SQL WHERE statement as the order number of the database record to delete.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL DELETE statement on the 'Order Summary' table filtered via the 'order_number' parameter.</p>
					<p>The function then deletes all related records from the 'Order Details' table.</p>
				</div>
			
				<h6>Notes</h6>
				<div class="frame_note">
					<p>Deleting an order will also delete any user reward points that are associated with it, as reward points are calculated from the order details table.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>int | The number of affected rows.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_where = array(...);

$this->flexi_cart_admin->delete_db_order($sql_where);
</pre>
			</div>
			
			<a name="get_db_order_status"></a>
			<div class="w100 frame">
				<h3 class="heading">get_db_order_status()</h3>
				
				<p>Gets records from the order status table using a user defined SQL SELECT query.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_db_order_status(sql_select, sql_where)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>sql_select</td>
							<td class="align_ctr">string | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define the database fields returned via an SQL SELECT statement.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>sql_where</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database records to return.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs a SQL SELECT statement on the 'Order Status' table.</p>
					<p>The query can be customised by submitting 'sql_select' and 'sql_where' data to the functions parameters.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function is compatible with flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder">Query Builder</a>' functions.</p>
					<hr/>
					<p>This function can be chained with CodeIgniters query functions 'result()', 'row()' etc.</p>
					<p>
						Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on all the combined flexi cart and CodeIgniter functions that are available.
					</p>
					<hr/>
					<p>
						If an int value is submitted to the 'sql_where' parameter, the function will automatically match the value against the tables primary key.<br/>
						Example: If 'sql_where' is submitted as an int of '101', the SQL WHERE statement will be "<code>WHERE 'primary_key_column' = 101</code>".
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>object</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_select = array(...);
$sql_where = array(...);

<span class="comment">// Example of chaining CI's query function 'result()'.
// Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on available functions.</span>
$this->flexi_cart_admin->get_db_order_status($sql_select, $sql_where)->result();
</pre>
			</div>

			<a name="insert_db_order_status"></a>
			<div class="w100 frame">
				<h3 class="heading">insert_db_order_status()</h3>
				
				<p>Inserts a new order status using a user defined SQL INSERT statement.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>insert_db_order_status(sql_insert)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>sql_insert</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL INSERT statement used to insert data into the database.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL INSERT statement on the 'Order Status' table, inserting data defined via the 'sql_insert' parameter.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>int | id of the inserted record.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_insert = array(...);

$this->flexi_cart_admin->insert_db_order_status($sql_insert);
</pre>
			</div>
			
			<a name="update_db_order_status"></a>
			<div class="w100 frame">
				<h3 class="heading">update_db_order_status()</h3>
				
				<p>Updates records in the order status table using a user defined SQL WHERE and UPDATE statement.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>update_db_order_status(sql_update, sql_where)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>sql_update</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL UPDATE statement used to update data into the database.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>sql_where</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database records to update.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL UPDATE statement on the 'Order Status' table, updating data defined via the 'sql_update' parameter and filtered via the 'sql_where' parameter.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function is compatible with flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder">Query Builder</a>' functions.</p>
					<hr/>
					<p>
						If an int value is submitted to the 'sql_where' parameter, the function will automatically match the value against the tables primary key.<br/>
						Example: If 'sql_where' is submitted as an int of '101', the SQL WHERE statement will be "<code>WHERE 'primary_key_column' = 101</code>".
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>int | The number of affected rows.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_update = array(...);
$sql_where = array(...);

$this->flexi_cart_admin->update_db_order_status($sql_update, $sql_where);
</pre>
			</div>

			<a name="delete_db_order_status"></a>
			<div class="w100 frame">
				<h3 class="heading">delete_db_order_status()</h3>
				
				<p>Deletes records from the order status table using a user defined SQL WHERE statement.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>delete_db_order_status(sql_where)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>sql_where</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database records to delete.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL DELETE statement on the 'Order Status' table filtered via the 'sql_where' parameter.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function is compatible with flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder">Query Builder</a>' functions.</p>
					<hr/>
					<p>
						If an int value is submitted to the 'sql_where' parameter, the function will automatically match the value against the tables primary key.<br/>
						Example: If 'sql_where' is submitted as an int of '101', the SQL WHERE statement will be "<code>WHERE 'primary_key_column' = 101</code>".
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>int | The number of affected rows.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_where = array(...);

$this->flexi_cart_admin->delete_db_order_status($sql_where);
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