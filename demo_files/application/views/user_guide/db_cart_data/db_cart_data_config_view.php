<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Database Cart Data Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for configuring database cart data in flexi cart."/> 
	<meta name="keywords" content="database cart data configuration, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Database Cart Data Configuration</h1>
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
			
			<h2>Database Cart Data Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/database_cart_data_index">Database Cart Data Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/database_cart_data_admin">Database Cart Data Admin Data</a>

			<div class="anchor_nav">
				<h6>Config Setup Information</h6>
				<p>
					<a href="#db_schema_diagram">Table Schema Diagram</a>
				</p>
				<h6>Table Settings</h6>
				<p>
					<a href="#cart_data_table">Cart Data Table</a>
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
				<h3 class="heading">Cart Data Schema Diagram</h3>
				<div class="frame_note">
					<p>
						A database table schema diagram, showing how the order tables are related to each other and the database cart data, custom item and user tables.<br/>
						Note: The custom user table must be created by you. The diagram highlights how it can be related to the database cart data table.<br/>
						Table and columns names are defined using their internal names.
					</p>
				</div>
				<img src="<?php echo $includes_dir; ?>images/db_diagrams/cart_data_tables.jpg" class="db_schema_diagram"/>
			</div>			

			<a name="cart_data_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Database Cart Data Table</h3>
				
				<div class="frame_note">
					<p>Contains cart data that has been saved to the database so that the cart session can be reloaded at a later time.</p>
				</div>

				<h6>Table and Column Names</h6>
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
							<td>cart_data</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>cart_data_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>user</td>
							<td>cart_data_user_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the database cart data to a user.<br/>
								The value CAN be used to act as a foreign key relating the table to the primary key of a custom user table, although this is not joined by default.
							</td>
						</tr>
						<tr>
							<td>cart_data</td>
							<td>cart_data_array</td>
							<td class="align_ctr">string</td>
							<td>The serialized cart data array.</td>
						</tr>
						<tr>
							<td>date</td>
							<td>cart_data_date</td>
							<td class="align_ctr">string | int</td>
							<td>
								The date and time that the cart data was last saved.<br/>
								The data type of this column can either be mysql datetime or a unix timestamp.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/cart_config_internal#date_time">internal config</a> documentation regarding setting the carts date and time settings.
							</td>
						</tr>
						<tr>
							<td>readonly_status</td>
							<td>cart_data_readonly_status</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines whether the cart data can only be read from and not overwritten.<br/>
								Internally, the cart sets data that is related to a confirmed order to be readonly, preventing the accidental loss an orders internal cart data.<br/>
								The readonly status can still be overridden by specifically defining to do so via flexi cart functions that manage database cart data.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required.</p>
					<p>The related order summary table and custom user tables do not need to be enabled to use the database cart data table.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['db_cart_data']['table'] = 'cart_data';
$config['database']['db_cart_data']['columns']['id'] = 'cart_data_id';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['db_cart_data']['table'] = FALSE;
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