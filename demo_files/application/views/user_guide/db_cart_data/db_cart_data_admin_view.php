<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Admin Cart Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for admin cart data functions in flexi cart."/> 
	<meta name="keywords" content="admin cart data functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h2>User Guide | Admin Cart Data Functions</h2>
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

			<h2>Admin Cart Data Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/database_cart_data_index">Cart Data Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/database_cart_data_config">Cart Data Config</a>

			<div class="anchor_nav">
				<h6>Cart Data Functions</h6>
				<p>
					<a href="#unserialize_cart_data">unserialize_cart_data()</a> | <a href="#save_cart_data">save_cart_data()</a> | <a href="#load_cart_data">load_cart_data()</a>
				</p>
				<h6>Cart Data CRUD Functions</h6>
				<p>
					<a href="#get_db_cart_data">get_db_cart_data()</a> | <a href="#delete_db_cart_data">delete_db_cart_data()</a>
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

			<a name="get_db_cart_data"></a>
			<div class="w100 frame">
				<h3 class="heading">get_db_cart_data()</h3>
				
				<p>Gets records from the cart data table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires the cart data database table to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>get_db_cart_data(sql_select, sql_where)</code>
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
					<p>The function runs an SQL SELECT statement on the 'Cart Data' table.</p>
					<p>The query can be customised by submitting 'sql_select' and 'sql_where' data to the functions parameters.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>Note: The cart data will be returned as a serialized string, to convert the string back to an array, use the standard PHP function 'unserialize()'.</p>
					<hr/>
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
$this->flexi_cart_admin->get_db_cart_data($sql_select, $sql_where)->result();
</pre>
			</div>

			<a name="unserialize_cart_data"></a>
			<div class="w100 frame">
				<h3 class="heading">unserialize_cart_data()</h3>
				
				<p>Returns an unserialized cart data array from the cart data table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires the cart data database table to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>unserialize_cart_data(sql_where)</code>
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
							<td class="align_ctr">Yes</td>
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
					<p>The function runs an SQL SELECT statement on the 'Cart Data' table.</p>
					<p>The function then uses PHP's standard 'unserialize()' function to convert the cart data from a string, back into an array.</p>
					<p>The query can be customised by submitting 'sql_where' data to the functions parameters.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						If an int value is submitted to the 'sql_where' parameter, the function will automatically match the value against the tables primary key.<br/>
						Example: If 'sql_where' is submitted as an int of '101', the SQL WHERE statement will be "<code>WHERE 'primary_key_column' = 101</code>".
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_where = array(...);

$this->flexi_cart_admin->unserialize_cart_data($sql_where);
</pre>
			</div>

			<a name="save_cart_data"></a>
			<div class="w100 frame">
				<h3 class="heading">save_cart_data()</h3>
				
				<p>Saves a carbon copy of the users current cart data array to the database.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires the cart data database table to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>save_cart_data(user, set_readonly_status, sql_update, force_overwrite)</code>
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
							<td>user</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">0</td>
							<td>
								Defines the id of the user that is saving the cart.<br/>
								Relating the cart data to a user means that the data can be filtered by user for other SQL SELECT queries.
							</td>
						</tr>
						<tr>
							<td>set_readonly_status</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Sets whether the cart data is from a completed order.<br/>
								If set as TRUE, the cart data cannot be later overwritten unless the 'force_overwrite' parameter is set.
							</td>
						</tr>
						<tr>
							<td>sql_update</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL UPDATE statement used to set additional data to the database.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>force_overwrite</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Sets whether the cart data can be resaved over the existing cart data of a completed order.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function first checks whether the current cart session data was originally loaded from the 'Cart Data' table.</p>
					<p>If the cart data has not already been saved, it inserts a new row to the table, and updates the current cart session data with the id.</p>
					<p>The function then serializes the carts session data and runs an SQL UPDATE statement to update the existing/newly inserted table record.</p>
					<p>If the 'set_readonly_status' value has been set, the function will set the cart data as being related to a completed order. As a precaution to prevent order data being overwritten, it is then only possible to re-update the record if 'force_overwrite' is set.</p>
					<p>The SQL UPDATE query can be customised by submitting 'sql_update' data to the functions parameters.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>int | id of the inserted record.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$user_id = 201;
$set_readonly_status = FALSE;
$sql_update = array(...);
$force_overwrite = FALSE

$this->flexi_cart_admin->save_cart_data($user_id, $set_readonly_status, $sql_update, $force_overwrite);
</pre>
			</div>

			<a name="load_cart_data"></a>
			<div class="w100 frame">
				<h3 class="heading">load_cart_data()</h3>
				
				<p>
					Loads a saved cart data array from the database.<br/>
					The data is then used to update the users current cart data array with the saved/submitted data.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires the cart data database table to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>load_cart_data(sql_where, set_admin_data, reset_locations, reset_discounts, reset_surcharges)</code>
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
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database record to return.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>set_admin_data</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define whether to load the cart data and store specific data in the current cart session data as 'admin data'.<br/>
								Read the '<a href="<?php echo $base_url; ?>user_guide/misc_info">admin data</a>' documentation for further information.
							</td>
						</tr>
						<tr>
							<td>reset_locations</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether the cart should reset the loaded cart data back to the default location.</td>
						</tr>
						<tr>
							<td>reset_discounts</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether the cart should remove any discount or reward voucher codes from the loaded cart data.</td>
						</tr>
						<tr>
							<td>reset_surcharges</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether the cart should remove any surcharges from the loaded cart data.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL query on the 'Cart Data' table, filtered via the 'sql_where' parameter. The returned cart data is then unserialized from a string, into an array.</p>
					<p>If the 'set_admin_data' parameter has been set, then the function will set specific item and discount data as '<a href="<?php echo $base_url; ?>user_guide/misc_info">admin data</a>', that can then be used internally by the cart when re-saving a previously saved order.</p> 
					<p>The function then checks through the rest of the saved data for cart items, locations, discounts, reward vouchers and surcharges. If the 'reset_locations', 'reset_discounts' and 'reset_surcharges' parameters permit, the data is then copied to the current cart data.</p>
					<p>Lastly, the function then runs the '<a href="<?php echo $base_url; ?>user_guide/shipping_set_data#update_shipping">update_shipping()</a>' and '<a href="<?php echo $base_url; ?>user_guide/tax_set_data#update_tax">update_tax()</a>' functions to ensure current shipping and tax rates are used.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						If an int value is submitted to the 'sql_where' parameter, the function will automatically match the value against the tables primary key.<br/>
						Example: If 'sql_where' is submitted as an int of '101', the SQL WHERE statement will be "<code>WHERE 'primary_key_column' = 101</code>".
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>TRUE</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_where = array(...);

$this->flexi_cart_admin->load_cart_data($sql_where);
</pre>
			</div>

			<a name="delete_db_cart_data"></a>
			<div class="w100 frame">
				<h3 class="heading">delete_db_cart_data()</h3>
				
				<p>Deletes cart data from the database.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires the cart data database table to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>delete_db_cart_data(sql_where, force_delete)</code>
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
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database records to delete.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>force_delete</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to delete cart data that is related to a completed order.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL SELECT query on the 'Cart Data' table, filtered via the 'sql_where' parameter to get the id's of all records that are to be deleted.</p>
					<p>If the current cart session data has a matching cart data id, then the sessions cart data id is reset, to ensure if it is later resaved, that it is issued a new row id.</p>
					<p>The function runs an SQL DELETE statement on the 'Cart Data' table filtered via the 'sql_where' parameter.</p>
					<p>As a precaution, unless the 'force_delete' parameter is set, no records related to saved orders can be deleted.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						If an int value is submitted to the 'sql_where' parameter, the function will automatically match the value against the tables primary key.<br/>
						Example: If 'sql_where' is submitted as an int of '101', the SQL WHERE statement will be "<code>WHERE 'primary_key_column' = 101</code>".
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_where = array(...);

$this->flexi_cart_admin->delete_db_cart_data($sql_where);
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