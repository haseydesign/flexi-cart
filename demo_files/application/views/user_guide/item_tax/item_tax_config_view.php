<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Tax Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for configuring item taxes in flexi cart."/> 
	<meta name="keywords" content="item tax configuration, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Item Tax Configuration</h1>
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

			<h2>Item Tax Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/item_tax_index">Item Tax Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_tax_helper_data">Get Item Tax Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_tax_admin">Item Tax Admin Data</a>

			<div class="anchor_nav">
				<h6>Config Setup Information</h6>
				<p>
					<a href="#db_schema_diagram">Table Schema Diagram</a> | <a href="#item_tax_setup_notes">Setup Notes</a>
				</p>
				<h6>Table Settings</h6>
				<p>
					<a href="#item_tax_table">Item Tax Table</a>
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
				<h3 class="heading">Item Tax Table Schema Diagram</h3>
				<div class="frame_note">
					<p>
						A database table schema diagram, showing how the item tax table is related to the location and custom item tables.<br/>
						Note: The custom item table must be created by you. The diagram highlights how it is then related to the item tax table.<br/>
						Table and columns names are defined using their internal names.
					</p>
				</div>
				<img src="<?php echo $includes_dir; ?>images/db_diagrams/item_tax_tables.jpg" class="db_schema_diagram"/>
			</div>			
			
			<a name="item_tax_setup_notes"></a>
			<div class="w100 frame">
				<h3 class="heading">General Item Tax Setup Notes</h3>
				<p>Below are some general notes to consider when setting up and managing the item tax table.</p>
				<ul>
					<li>
						When an item is added to the cart, the priority of setting the items tax rate is done as follows:<br/>
						First the submitted item data is checked for a manually entered tax rate. The cart will then check if there is a value set in the item tax table. Then finally the carts current tax rate is applied to the item.
					</li>
					<li>
						If multiple item tax rates are available to the carts current tax location, then only the first rule ordered by the lowest table row id will be returned.
					</li>
				</ul>
			</div>

			<a name="item_tax_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Item Tax Table</h3>
				
				<p>Contains tax rates for specific cart items.</p>
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
							<td>tax_item_rates</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>tax_item_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>item</td>
							<td>tax_item_item_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the item tax rate to an item (product).<br/>
								The value acts as a foreign key relating the table to the primary key of a custom item (product) table.
							</td>
						</tr>
						<tr>
							<td>location</td>
							<td>tax_item_location_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the item tax rate to a location, so it will only be displayed if that location is set.<br/>
								The value acts as a foreign key relating the table to the primary key of the location table.
							</td>
						</tr>
						<tr>
							<td>zone</td>
							<td>tax_item_zone_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the item tax rate to a location zone, so it will only be displayed if a location from that zone is set.<br/>
								The value acts as a foreign key relating the table to the primary key of the location zones table.
							</td>
						</tr>
						<tr>
							<td>rate</td>
							<td>tax_item_rate</td>
							<td class="align_ctr">int</td>
							<td>The percentage value of the item tax rate.</td>
						</tr>
						<tr>
							<td>status</td>
							<td>tax_item_status</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines the status of whether the item tax rate is active or disabled.<br/>
								Disabled records will not be used by flexi cart functions.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required.</p>
					<p>The related location tables do not need to be enabled to use the item tax table.</p>
					<hr/>
					<p>
						The item tax table has a one-to-many relationship with an item, i.e. one item can have many tax rates setup for different locations.<br/>
						Therefore, the item tax data must be setup as a table seperate from the custom user defined item table.
					</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['item_tax']['table'] = 'tax_item_rates';
$config['database']['item_tax']['columns']['id'] = 'tax_item_id';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['item_tax']['table'] = FALSE;
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