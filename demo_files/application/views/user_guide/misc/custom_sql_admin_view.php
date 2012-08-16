<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Admin Miscellaneous Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for admin miscellaneous functions in flexi cart."/> 
	<meta name="keywords" content="admin miscellaneous functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Miscellaneous Admin Functions</h1>
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

			<h2>Miscellaneous Admin Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/custom_sql_index">Customising SQL Statements Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/query_sql_results">Querying SQL Results</a> |
			<a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">Defining Custom SQL Statements</a> |
			<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder">Building Custom SQL Queries</a>

			<div class="anchor_nav">
				<h6>Custom Table CRUD Functions</h6>
				<p>
					<a href="#get_db_table_data">get_db_table_data()</a> | <a href="#insert_db_table_data">insert_db_table_data()</a> | <a href="#update_db_table_data">update_db_table_data()</a> | <a href="#delete_db_table_data">delete_db_table_data()</a>
				</p>
				<h6>SQL WHERE Query Generator</h6>
				<p>
					<a href="#create_sql_where">create_sql_where()</a>
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
		
			<a name="get_db_table_data"></a>
			<div class="w100 frame">
				<h3 class="heading">get_db_table_data()</h3>
				
				<p>Gets records from a custom user defined table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_db_table_data(table_name, sql_select, sql_where)</code>
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
							<td>table_name</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Define the database table to apply the SQL SELECT statement to.</td>
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
					<p>The function runs an SQL SELECT statement on the defined 'table_name' table.</p>
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
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>object</p>
				</div>
				
				<h6>Example</h6>
<pre>
$table_name = 'example_name';

<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_select = array(...);
$sql_where = array(...);

<span class="comment">// Example of chaining CI's query function 'result()'.
// Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on available functions.</span>
$this->flexi_cart_admin->get_db_table_data($table_name, $sql_select, $sql_where)->result();
</pre>
			</div>

			<a name="insert_db_table_data"></a>
			<div class="w100 frame">
				<h3 class="heading">insert_db_table_data()</h3>
				
				<p>Inserts a new record into a custom user defined table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>insert_db_table_data(table_name, sql_insert)</code>
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
							<td>table_name</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Define the database table to apply the SQL INSERT statement to.</td>
						</tr>
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
					<p>The function runs an SQL INSERT statement on the defined 'table_name' table, inserting data defined via the 'sql_insert' parameter.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>int | id of the inserted record.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$table_name = 'example_name';

<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_insert = array(...);

$this->flexi_cart_admin->insert_db_table_data($table_name, $sql_insert);
</pre>
			</div>

			<a name="update_db_table_data"></a>
			<div class="w100 frame">
				<h3 class="heading">update_db_table_data()</h3>
				
				<p>Updates records in a custom user defined table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>update_db_table_data(table_name, sql_update, sql_where)</code>
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
							<td>table_name</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Define the database table to apply the SQL UPDATE statement to.</td>
						</tr>
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
					<p>The function runs an SQL UPDATE statement on the defined 'table_name' table, updating data defined via the 'sql_update' parameter and filtered via the 'sql_where' parameter.</p>
				</div>
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function is compatible with flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder">Query Builder</a>' functions.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>int | The number of affected rows.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$table_name = 'example_name';

<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_update = array(...);
$sql_where = array(...);

$this->flexi_cart_admin->update_db_table_data($table_name, $sql_update, $sql_where);
</pre>
			</div>

			<a name="delete_db_table_data"></a>
			<div class="w100 frame">
				<h3 class="heading">delete_db_table_data()</h3>
				
				<p>Deletes records from a custom user defined table.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>delete_db_table_data(table_name, sql_where)</code>
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
							<td>table_name</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Define the database table to apply the SQL DELETE statement to.</td>
						</tr>
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
					<p>The function runs an SQL DELETE statement on the defined 'table_name' table filtered via the 'sql_where' parameter.</p>
				</div>
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function is compatible with flexi carts '<a href="<?php echo $base_url; ?>user_guide/custom_sql_query_builder">Query Builder</a>' functions.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>int | The number of affected rows.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$table_name = 'example_name';

<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_where = array(...);

$this->flexi_cart_admin->delete_db_table_data($table_name, $sql_where);
</pre>
			</div>
			
			<a name="create_sql_where"></a>
			<div class="w100 frame">
				<h3 class="heading">create_sql_where()</h3>
				
				<p>Generates a formatted SQL WHERE statement using CodeIgniters Active Record functions.</p>
				<hr/>
				
				<h6>Function Parameters</h6>
				<code>create_sql_where(column_name, comparison_operator, value, logic_operator)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>column_name</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the name of the column that is be compared against the 'value' parameter.</td>
						</tr>
						<tr>
							<td>comparison_operator</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Defines the operator ('=', '!=' etc.) used to compare the 'column_name' against the 'value' parameters.<br/>
								See the table below for further information on available operators.
							</td>
						</tr>
						<tr>
							<td>value</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">NULL</td>
							<td>Defines the value that is be compared against table column in the 'column_name' parameter.</td>
						</tr>
						<tr>
							<td>logic_operator</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">'AND'</td>
							<td>
								Defines the operator used to relate each SQL WHERE statement to each other.<br/>
								The available values are either 'AND' or 'OR'.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Comparison Operators</h6>
				<p>Comparison operators can either be defined using the numeric id or the string id.</p>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Description</th>
							<th class="spacer_125 align_ctr">Numeric id</th>
							<th class="spacer_125 align_ctr">String id</th>
							<th>SQL Generated</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Is equal to</td>
							<td class="align_ctr">1</td>
							<td class="align_ctr">=</td>
							<td>'column_name' = 'value'</td>
						</tr>
						<tr>
							<td>Is not equal to</td>
							<td class="align_ctr">2</td>
							<td class="align_ctr">!=</td>
							<td>'column_name' != 'value'</td>
						</tr>
						<tr>
							<td>Is less than</td>
							<td class="align_ctr">3</td>
							<td class="align_ctr"><</td>
							<td>'column_name' < 'value'</td>
						</tr>
						<tr>
							<td>Is less than or equal to</td>
							<td class="align_ctr">4</td>
							<td class="align_ctr"><=</td>
							<td>'column_name' <= 'value'</td>
						</tr>
						<tr>
							<td>Is more than</td>
							<td class="align_ctr">5</td>
							<td class="align_ctr">></td>
							<td>'column_name' > 'value'</td>
						</tr>
						<tr>
							<td>Is more than or equal to</td>
							<td class="align_ctr">6</td>
							<td class="align_ctr">>=</td>
							<td>'column_name' >= 'value'</td>
						</tr>
						<tr>
							<td>Contains</td>
							<td class="align_ctr">7</td>
							<td class="align_ctr">like</td>
							<td>'column_name' LIKE '%value%'</td>
						</tr>
						<tr>
							<td>Does not contain</td>
							<td class="align_ctr">8</td>
							<td class="align_ctr">not_like</td>
							<td>'column_name' NOT LIKE '%value%'</td>
						</tr>
						<tr>
							<td>Begins with</td>
							<td class="align_ctr">9</td>
							<td class="align_ctr">begin_like</td>
							<td>'column_name' LIKE 'value%'</td>
						</tr>
						<tr>
							<td>Does not begin with</td>
							<td class="align_ctr">10</td>
							<td class="align_ctr">not_begin_like</td>
							<td>'column_name' NOT LIKE 'value%'</td>
						</tr>
						<tr>
							<td>Ends with</td>
							<td class="align_ctr">11</td>
							<td class="align_ctr">end_like</td>
							<td>'column_name' LIKE '%value'</td>
						</tr>
						<tr>
							<td>Does not end with</td>
							<td class="align_ctr">12</td>
							<td class="align_ctr">not_end_like</td>
							<td>'column_name' NOT LIKE '%value'</td>
						</tr>
						<tr>
							<td>Is null</td>
							<td class="align_ctr">13</td>
							<td class="align_ctr">null</td>
							<td>'column_name' IS NULL</td>
						</tr>
						<tr>
							<td>Is not null</td>
							<td class="align_ctr">14</td>
							<td class="align_ctr">not_null</td>
							<td>'column_name' IS NOT NULL</td>
						</tr>
						<tr>
							<td>Is empty</td>
							<td class="align_ctr">15</td>
							<td class="align_ctr">empty</td>
							<td>'column_name' = ''</td>
						</tr>
						<tr>
							<td>Is not empty</td>
							<td class="align_ctr">16</td>
							<td class="align_ctr">not_empty</td>
							<td>'column_name' != ''</td>
						</tr>
						<tr>
							<td>Is between</td>
							<td class="align_ctr">17</td>
							<td class="align_ctr">between</td>
							<td>'column_name' BETWEEN 'value_1' AND 'value_2'</td>
						</tr>
						<tr>
							<td>Is not between</td>
							<td class="align_ctr">18</td>
							<td class="align_ctr">not_between</td>
							<td>'column_name' NOT BETWEEN 'value_1' AND 'value_2'</td>
						</tr>
						<tr>
							<td>Is in list</td>
							<td class="align_ctr">19</td>
							<td class="align_ctr">in</td>
							<td>'column_name' IN ('value_1', 'value_2', 'value_3')</td>
						</tr>
						<tr>
							<td>Is not in list</td>
							<td class="align_ctr">20</td>
							<td class="align_ctr">not_in</td>
							<td>'column_name' NOT IN ('value_1', 'value_2', 'value_3')</td>
						</tr>
					</tbody>
				</table>
									
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The primary purpose of this function is to be used in a loop, where the function will automatically generate a chain of SQL WHERE statements using the data that is submitted to it.</p>
					<p>This function is used in the discount group demos, where it filters records from a user defined item (products) table, the items returned by the WHERE statement are then added to a discount group that discounts can be applied to.</p>
					<hr/>
					<p>The function works by calling one of CodeIgniters Active Record SQL WHERE functions, defined via the 'comparison_operator' parameter. This operator is then used to compare 'column_name' against the 'value'.</p>
					<p>When multiple SQL WHERE statements are generated via a loop, the 'logic_operator' defines how to relate each statement to each other, e.g. via 'AND', 'OR' etc.</p>
					<p>When CodeIgniter then calls an SQL query, the generated SQL WHERE statements are applied to the query.</p>
				</div>
										
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						To include multiple values for comparison operators as such as 'BETWEEN' and 'IN', separate values with a comma.<br/>
						The 'BETWEEN' operators will only use the first 2 comma separated values, whilst the 'IN' operators will use all comma separated values.
					</p>
					<p>Comparison operators can be defined using either the numeric id or the string id, see the examples below for further information.</p>
				</div>
										
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>TRUE</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the SQL WHERE statement using a loop.</span>

<span class="comment">// Structure example data as a multi-dimensional array.</span>
$example_data = array(
array(
	'column_name' => 'example_column_name_1',
	'comparison_operator' => '2', <span class="comment">// Defining the numeric id for 'Is not equal to'.</span>
	'value' => 'example_value',
	'logic_operator' => 'AND'
),
array(
	'column_name' => 'example_column_name_2',
	'comparison_operator' => 'between', <span class="comment">// Defining the string id for 'Is between'.</span>
	'value' => '10,20', <span class="comment">// Separate 'BETWEEN' values with a comma.</span>
	'logic_operator' => 'AND'
),
array(
	'column_name' => 'example_column_name_3',
	'comparison_operator' => 'not_in', <span class="comment">// Defining the string id for 'Is not in list'.</span>
	'value' => '5,10,15,20', <span class="comment">// Separate 'IN' values with a comma.</span>
	'logic_operator' => 'OR'
)
);

<span class="comment">// Loop through example data.</span>
foreach($example_data as $loop_data)
{
$this->flexi_cart_admin->create_sql_where(
	$loop_data['column_name'], 
	$loop_data['comparison_operator'], 
	$loop_data['value'], 
	$loop_data['logic_operator']
);
}

<span class="comment">// Generate an SQL query using CodeIgniters database class.</span>
$this->db->get('example_table');

<span class="comment">// Produces:
// SELECT *
// FROM (`example_table`)
// WHERE `example_column_1` !=  'example_value'
// 	AND `example_column_2` BETWEEN '10' AND '20'
// 	OR `example_column_3` NOT IN ('5', '10', '15', '20')</span>
</pre>
<pre>
<span class="comment bold">// Example #2 : Defining the SQL WHERE statement without using a loop.</span>

$column_name = 'example_column';
$comparison_operator = 'IN'; <span class="comment">// Defining the string id for 'Is in list'.</span>
$value = '1, 2, 3, 4'; <span class="comment">// Separate 'IN' values with a comma.</span>
$logic_operator = 'AND';

$this->flexi_cart_admin->create_sql_where($column_name, $comparison_operator, $value, $logic_operator);

<span class="comment">// Produces:
// SELECT *
// FROM (`example_table`)
// WHERE `example_column` IN ('1', '2', '3', '4')</span>
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