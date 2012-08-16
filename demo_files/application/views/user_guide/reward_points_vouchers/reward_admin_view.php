<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Admin Reward Point and Voucher Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for admin reward point and voucher functions in flexi cart."/> 
	<meta name="keywords" content="admin reward point and voucher functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Admin Reward Point and Voucher Functions</h1>
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
		
			<h2>Admin Reward Point and Voucher Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/reward_index">Reward Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_config">Reward Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_session_data">Get Reward Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_helper_data">Get Reward Helper Data</a>

			<div class="anchor_nav">
				<h6>Reward Points CRUD Functions</h6>
				<p>
					<a href="#get_db_reward_points">get_db_reward_points()</a> | <a href="#get_db_reward_point_summary">get_db_reward_point_summary()</a> | <a href="#get_db_converted_reward_points">get_db_converted_reward_points()</a>
				</p>
				<h6>Reward Voucher CRUD Functions</h6>
				<p>
					<a href="#get_db_voucher">get_db_voucher()</a> | <a href="#insert_db_voucher">insert_db_voucher()</a> | <a href="#update_db_voucher">update_db_voucher()</a> | <a href="#delete_db_voucher">delete_db_voucher()</a>
				</p>
				<h6>Reward Points Management Functions</h6>
				<p>
					<a href="#get_reward_point_conversion_tiers">get_reward_point_conversion_tiers()</a> | <a href="#calculate_conversion_reward_points">calculate_conversion_reward_points()</a> | <a href="#calculate_reward_point_value">calculate_reward_point_value()</a>
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
			
			<a name="get_db_reward_points"></a>
			<div class="w100 frame">
				<h3 class="heading">get_db_reward_points()</h3>
				
				<p>Gets records from the reward points table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all reward point, discount and order database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>get_db_reward_points(sql_select, sql_where)</code>
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
					<p>The function runs a joined SQL SELECT statement on the 'Reward Points' (pseudo table), 'Reward Points Converted' and 'Order Status' tables.</p>
					<p>The function then loops through the results and calculates an itemised summary for the number of reward points that are 'active', 'pending', 'expired', 'converted' and 'cancelled' per row.</p>
					<ul>
						<li><strong>Total</strong> - Points earnt from ordered item.</li>
						<li><strong>Active</strong> - Points earnt from ordered items that are marked as shipped; are within their expiry date and that have not been converted.</li>
						<li><strong>Pending</strong> - Points earnt from ordered items that are yet to be marked as shipped.</li>
						<li><strong>Expired</strong> - Points that were not converted to reward vouchers within their expiry date.</li>
						<li><strong>Converted</strong> - Points that have been converted to reward vouchers.</li>
						<li><strong>Cancelled</strong> - Points earnt from ordered items that have been cancelled or returned.</li>
					</ul>
					<p>The query can be customised by submitting 'sql_select' and 'sql_where' data to the functions parameters.</p>
					<p>Note that the names of these itemised summary columns are defined via the config file are always returned by the function, regardless of the 'sql_select' values. Read the <a href="<?php echo $base_url; ?>user_guide/reward_config#reward_points">Itemised Pseudo Column</a> documentation for further information on setting aliases via the config file.</p>
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
$this->flexi_cart_admin->get_db_reward_points($sql_select, $sql_where)->result();
</pre>
			</div>

			<a name="get_db_reward_point_summary"></a>
			<div class="w100 frame">
				<h3 class="heading">get_db_reward_point_summary()</h3>
				
				<p>Gets a summary of a users reward points stating the number of points that are pending, active, expired, cancelled and that have been converted to vouchers.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all reward point, discount and order database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>get_db_reward_point_summary(sql_where)</code>
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
					<p>The function runs a joined SQL SELECT statement on the 'Reward Points' (pseudo table), 'Reward Points Converted' and 'Order Status' tables.</p>
					<p>The function then loops through the results and calculates an totalised summary for the number of reward points that are 'active', 'pending', 'expired', 'converted' and 'cancelled' per user.</p>
					<ul>
						<li><strong>Total</strong> - Total Points earnt from ordered items.</li>
						<li><strong>Active</strong> - Points earnt from ordered items that are marked as shipped; are within their expiry date and that have not been converted.</li>
						<li><strong>Pending</strong> - Points earnt from ordered items that are yet to be marked as shipped.</li>
						<li><strong>Expired</strong> - Points that were not converted to reward vouchers within their expiry date.</li>
						<li><strong>Converted</strong> - Points that have been converted to reward vouchers.</li>
						<li><strong>Cancelled</strong> - Points earnt from ordered items that have been cancelled or returned.</li>
					</ul>
					<p>The query can be customised by submitting 'sql_where' data to the functions parameters.</p>
					<p>Note that the names of these totalised summary columns are defined via the config file. Read the <a href="<?php echo $base_url; ?>user_guide/reward_config#reward_points">Summary Pseudo Column</a> documentation for further information on setting aliases via the config file.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						If an int value is submitted to the 'sql_where' parameter, the function will automatically match the value against the <strong class="uline">user id</strong> (NOT the usual primary key).<br/>
						Example: If 'sql_where' is submitted as an int of '101', the SQL WHERE statement will be "<code>WHERE 'user' = 101</code>".
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
				<h6>Example</h6>
				
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_where = array(...);

$this->flexi_cart_admin->get_db_reward_point_summary($sql_where);
</pre>
			</div>
			
			<a name="get_db_converted_reward_points"></a>
			<div class="w100 frame">
				<h3 class="heading">get_db_converted_reward_points()</h3>
				
				<p>Gets records from the converted reward points table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all reward point, discount and order database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>get_db_converted_reward_points(sql_select, sql_where)</code>
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
					<p>The function runs a joined SQL SELECT statement on the 'Reward Points' (pseudo table), 'Reward Points Converted' and 'Discount' tables.</p>
					<p>The returned results are ordered by the date the reward points were earnt (From an order).</p>
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
$this->flexi_cart_admin->get_db_converted_reward_points($sql_select, $sql_where)->result();
</pre>
			</div>

			<a name="get_db_voucher"></a>
			<div class="w100 frame">
				<h3 class="heading">get_db_voucher()</h3>
				
				<p>Gets reward voucher records from the discount table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all reward point, discount and order database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>get_db_voucher(sql_select, sql_where)</code>
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
					<p>The function runs an SQL SELECT statement on the 'Discounts' table.</p>
					<p>By default, the SQL statement is NOT joined to any other discount tables, but can be by using flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder#sql_join">Query Builder - SQL JOIN</a>' function.</p>
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
$this->flexi_cart_admin->get_db_voucher($sql_select, $sql_where)->result();
</pre>
			</div>
			
			<a name="insert_db_voucher"></a>
			<div class="w100 frame">
				<h3 class="heading">insert_db_voucher()</h3>
				
				<p>Inserts a new record to the discounts table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all reward point, discount and order database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>insert_db_voucher(user, points_to_convert, code, description, expire_days)</code>
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
							<td>user</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Sets the id of the user that the reward voucher belongs to.<br/>
								The id has no affect on the functioning of the reward voucher, but is required to relate a voucher to the reward points it was converted from.
							</td>
						</tr>
						<tr>
							<td>points_to_convert</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Sets the number of reward points that are being converted into the reward voucher.</td>
						</tr>
						<tr>
							<td>code</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Sets the redeem code of the reward voucher.</td>
						</tr>
						<tr>
							<td>description</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Sets a description of the reward voucher that can be displayed when applied to the cart.</td>
						</tr>
						<tr>
							<td>expire_days</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Set the number of days until the reward voucher expires.</td>
						</tr>
					</tbody>
				</table>
			
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL INSERT statement on the 'Discounts' table, inserting data defined via the functions parameters.</p>
					<p>If the 'code' parameter is not set, a random 15 character code is generated.</p>
					<p>If the 'description' parameter is not set, a default description of 'Reward Voucher: [code]' will be set.</p>
					<p>If the 'expire_days' parameter is not set, the carts default expiry time set via the cart configuration will be set.</p>
				</div>

				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>int | id of the inserted record.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$user_id = 201;
$points_to_convert = 500;
$code = 'EXAMPLE-VOUCHER-CODE';
$description = 'Example Voucher Description';
$expire_days = 60;

$this->flexi_cart_admin->insert_db_voucher($user_id, $points_to_convert, $code, $description, $expire_days);
</pre>
			</div>

			<a name="update_db_voucher"></a>
			<div class="w100 frame">
				<h3 class="heading">update_db_voucher()</h3>
				
				<p>Updates records in the discounts table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all reward point, discount and order database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>update_db_voucher(sql_update, sql_where)</code>
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
					<p>The function runs an SQL UPDATE statement on the 'Discounts' table, updating data defined via the 'sql_update' parameter and filtered via the 'sql_where' parameter.</p>
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

$this->flexi_cart_admin->update_db_voucher($sql_update, $sql_where);
</pre>
			</div>

			<a name="delete_db_voucher"></a>
			<div class="w100 frame">
				<h3 class="heading">delete_db_voucher()</h3>
				
				<p>Deletes records from the discount table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all reward point, discount and order database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>delete_db_voucher(sql_where)</code>
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
					<p>The function runs an SQL DELETE statement on the 'Discounts' table filtered via the 'sql_where' parameter.</p>
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

$this->flexi_cart_admin->delete_db_voucher($sql_where);
</pre>
			</div>

			<a name="get_reward_point_conversion_tiers"></a>
			<div class="w100 frame">
				<h3 class="heading">get_reward_point_conversion_tiers()</h3>
				
				<p>
					Returns an array of reward point tiers required to convert points to a voucher.<br/>					
					For example, with 825 points and a conversion ratio of 250 points per voucher, the array would return 250, 500 and 750.<br/>
					The remaining 75 points would not be able to be converted until another 175 points were earnt.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all reward point, discount and order database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>get_reward_point_conversion_tiers(reward_points, points_limit)</code>
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
							<td>reward_points</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the number of reward points that are active and available to convert.</td>
						</tr>
						<tr>
							<td>points_limit</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines a maximum limit of reward points that can be converted to one voucher.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function uses the <a href="<?php echo $base_url; ?>user_guide/cart_config_settings#reward_point_to_voucher_ratio">reward point to voucher conversion ratio</a> defined via the config settings and calculates the number of tier brackets that could be applied to the submitted 'reward_points' value.</p>
					<p>If a 'points_limit' value is set, the 'reward_points' value is capped to that limit.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>array</p> 
				</div>
				
				<h6>Example</h6>				
<pre>
<span class="comment bold">// Example #1 : Converting 960 points with no limit set, using a points to voucher ratio of 250.</span>

$reward_points = 960;

$this->flexi_cart_admin->get_reward_point_conversion_tiers($reward_points);

<span class="comment">// Produces:
Array
(
 [0] => 250
 [1] => 500
 [2] => 750
)</span>
</pre>
<pre>
<span class="comment bold">// Example #2 : Converting 960 points with a points limit of 500, using a points to voucher ratio of 250.</span>

$reward_points = 960;
$points_limit = 500;

$this->flexi_cart_admin->get_reward_point_conversion_tiers($reward_points, $points_limit);

<span class="comment">// Produces:
Array
(
 [0] => 250
 [1] => 500
)</span>
</pre>
			</div>
			
			<a name="calculate_conversion_reward_points"></a>
			<div class="w100 frame">
				<h3 class="heading">calculate_conversion_reward_points()</h3>
				
				<p>Rounds a submitted amount of reward points to the maximum number of reward points that can be converted into a voucher.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all reward point, discount and order database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>calculate_conversion_reward_points(reward_points, points_limit)</code>
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
							<td>reward_points</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the number of reward points that are active and available to convert.</td>
						</tr>
						<tr>
							<td>points_limit</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines a maximum limit of reward points that can be converted to one voucher.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function uses the <a href="<?php echo $base_url; ?>user_guide/cart_config_settings#reward_point_to_voucher_ratio">reward point to voucher conversion ratio</a> defined via the config settings and the submitted 'reward_points' value, to calculate the total number of reward points that can be converted.</p>
					<p>If a 'points_limit' value is set, the 'reward_points' value is capped to that limit.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>int | '0'</p>
					<p><strong class="spacer_100">Success:</strong>int</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Converting 960 points with no limit set, using a points to voucher ratio of 250.</span>

$reward_points = 960;

$this->flexi_cart_admin->calculate_conversion_reward_points($reward_points);

<span class="comment">// Produces: '750'</span>
</pre>
<pre>
<span class="comment bold">// Example #2 : Converting 960 points with a points limit of 500, using a points to voucher ratio of 250.</span>

$reward_points = 960;
$points_limit = 500;

$this->flexi_cart_admin->calculate_conversion_reward_points($reward_points, $points_limit);

<span class="comment">// Produces: '500'</span>
</pre>
			</div>					

			<a name="calculate_reward_point_value"></a>
			<div class="w100 frame">
				<h3 class="heading">calculate_reward_point_value()</h3>
				
				<p>Returns the monetary value of a submitted amount of reward points.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all reward point, discount and order database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>calculate_reward_point_value(reward_points)</code>
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
							<td>reward_points</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the number of reward points to calculate the monetary value of.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function uses the <a href="<?php echo $base_url; ?>user_guide/cart_config_settings#reward_voucher_multiplier">reward voucher multiplier</a> value defined via the config settings and the submitted 'reward_points' value, to calculate the monetary value of the reward points if they were converted to a voucher.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>int | '0'</p>
					<p><strong class="spacer_100">Success:</strong>int</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Using a reward voucher multipler value of '0.01' per reward point.</span>

$reward_points = 960;

$this->flexi_cart_admin->calculate_reward_point_value($reward_points);

<span class="comment">// Produces: '9.60' (Currency value)</span>
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