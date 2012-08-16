<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Admin Shipping Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for admin shipping functions in flexi cart."/> 
	<meta name="keywords" content="admin shipping functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Admin Shipping Functions</h1>
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
						
			<h2>Admin Shipping Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/shipping_index">Shipping Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_config">Shipping Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_session_data">Get Shipping Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_helper_data">Get Shipping Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_set_data">Set Shipping Session Data</a>

			<div class="anchor_nav">
				<h6>Shipping Option CRUD Functions</h6>
				<p>
					<a href="#get_db_shipping">get_db_shipping()</a> | <a href="#insert_db_shipping">insert_db_shipping()</a> | <a href="#update_db_shipping">update_db_shipping()</a> | <a href="#delete_db_shipping">delete_db_shipping()</a>
				</p>
				<h6>Shipping Rate CRUD Functions</h6>
				<p>
					<a href="#get_db_shipping_rate">get_db_shipping_rate()</a> | <a href="#insert_db_shipping_rate">insert_db_shipping_rate()</a> | <a href="#update_db_shipping_rate">update_db_shipping_rate()</a> | <a href="#delete_db_shipping_rate">delete_db_shipping_rate()</a>
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

			<a name="get_db_shipping"></a>
			<div class="w100 frame">
				<h3 class="heading">get_db_shipping()</h3>
				
				<p>Gets records from the shipping options table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all shipping database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_db_shipping(sql_select, sql_where)</code>
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
					<p>The function runs an SQL SELECT statement on the 'Shipping Options' table.</p>
					<p>By default, the SQL statement is NOT joined to the 'Shipping Rates' table, but can be by using flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder#sql_join">Query Builder - SQL JOIN</a>' function.</p>
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
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>object</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_select = array(...);
$sql_where = array(...);

<span class="comment">// Example of chaining CI's query function 'result()'.
// Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on available functions.</span>
$this->flexi_cart_admin->get_db_shipping($sql_select, $sql_where)->result();
</pre>
			</div>

			<a name="insert_db_shipping"></a>
			<div class="w100 frame">
				<h3 class="heading">insert_db_shipping()</h3>
				
				<p>Inserts a new record to the shipping option table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all shipping database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>insert_db_shipping(sql_insert)</code>
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
					<p>The function runs an SQL INSERT statement on the 'Shipping Options' table, inserting data defined via the 'sql_insert' parameter.</p>
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

$this->flexi_cart_admin->insert_db_shipping($sql_insert);
</pre>
			</div>
			
			<a name="update_db_shipping"></a>				
			<div class="w100 frame">
				<h3 class="heading">update_db_shipping()</h3>
				
				<p>Updates records in the shipping options table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all shipping database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>update_db_shipping(sql_update, sql_where)</code>
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
					<p>The function runs an SQL UPDATE statement on the 'Shipping Options' table, updating data defined via the 'sql_update' parameter and filtered via the 'sql_where' parameter.</p>
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

$this->flexi_cart_admin->update_db_shipping($sql_update, $sql_where);
</pre>
			</div>

			<a name="delete_db_shipping"></a>				
			<div class="w100 frame">
				<h3 class="heading">delete_db_shipping()</h3>
				
				<p>Deletes records from the shipping options table, and if defined, any related child shipping rates.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all shipping database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>delete_db_shipping(sql_where, delete_children)</code>
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
						<tr>
							<td>delete_children</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define whether to also delete all related shipping rate records.<br/>
								As a precaution, 'delete' must be submitted to delete child records.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL DELETE statement on the 'Shipping Options' table filtered via the 'sql_where' parameter.</p>
					<p>If the 'delete_children' parameter is set, then all related records from the 'Shipping Rates' table will also be deleted.</p>
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

$this->flexi_cart_admin->delete_db_shipping($sql_where);
</pre>
			</div>
			
			<a name="get_db_shipping_rate"></a>
			<div class="w100 frame">
				<h3 class="heading">get_db_shipping_rate()</h3>
				
				<p>Gets records from the shipping rate table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all shipping database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>get_db_shipping_rate(sql_select, sql_where)</code>
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
					<p>The function runs an SQL SELECT statement on the 'Shipping Rates' table.</p>
					<p>By default, the SQL statement is NOT joined to the 'Shipping Options' table, but can be by using flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder#sql_join">Query Builder - SQL JOIN</a>' function.</p>
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
$this->flexi_cart_admin->get_db_shipping_rate($sql_select, $sql_where)->result();
</pre>
			</div>

			<a name="insert_db_shipping_rate"></a>
			<div class="w100 frame">
				<h3 class="heading">insert_db_shipping_rate()</h3>
				
				<p>Inserts a new record to the shipping rate table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all shipping database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>insert_db_shipping_rate(sql_insert)</code>
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
					<p>The function runs an SQL INSERT statement on the 'Shipping Rates' table, inserting data defined via the 'sql_insert' parameter.</p>
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

$this->flexi_cart_admin->insert_db_shipping_rate($sql_insert);
</pre>
			</div>
			
			<a name="update_db_shipping_rate"></a>
			<div class="w100 frame">
				<h3 class="heading">update_db_shipping_rate()</h3>
				
				<p>Updates records in the shipping rate table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all shipping database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>update_db_shipping_rate(sql_update, sql_where)</code>
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
					<p>The function runs an SQL UPDATE statement on the 'Shipping Rates' table, updating data defined via the 'sql_update' parameter and filtered via the 'sql_where' parameter.</p>
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

$this->flexi_cart_admin->update_db_shipping_rate($sql_update, $sql_where);
</pre>
			</div>

			<a name="delete_db_shipping_rate"></a>
			<div class="w100 frame">
				<h3 class="heading">delete_db_shipping_rate()</h3>
				
				<p>Deletes records from the shipping rate table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all shipping database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>delete_db_shipping_rate(sql_where)</code>
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
					<p>The function runs an SQL DELETE statement on the 'Shipping Rates' table filtered via the 'sql_where' parameter.</p>
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

$this->flexi_cart_admin->delete_db_shipping_rate($sql_where);
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