<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Stock Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for configuring item stock in flexi cart."/> 
	<meta name="keywords" content="item stock configuration, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Item Stock Configuration</h1>
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

			<h2>Item Stock Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/item_stock_index">Item Stock Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_stock_helper_data">Get Item Stock Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_stock_admin">Item Stock Admin Data</a>

			<div class="anchor_nav">
				<h6>Config Setup Information</h6>
				<p>
					<a href="#db_schema_diagram">Table Schema Diagram</a>
				</p>
				<h6>Table Settings</h6>
				<p>
					<a href="#item_stock_table">Item Stock Table</a>
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
				<h3 class="heading">Item Stock Table Schema Diagram</h3>
				<div class="frame_note">
					<p>
						A database table schema diagram, showing how the item stock table is related to the custom item table.<br/>
						Note: The custom item table must be created by you. The diagram highlights how it can be related to the item stock table.<br/>
						Table and columns names are defined using their internal names.
					</p>
				</div>
				<img src="<?php echo $includes_dir; ?>images/db_diagrams/item_stock_tables.jpg" class="db_schema_diagram"/>
			</div>			
		
			<a name="item_stock_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Item Stock Table</h3>
				
				<p>Contains stock data on cart items that can be used to indicate whether an item is in stock.</p>
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
							<td>item_stock</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>stock_id</td>
							<td class="align_ctr">int</td>
							<td>
								The tables primary key.<br/>
								<span class="highlight_red">Important Note: See the note highlighted below regarding the table id and the item id.</span>
							</td>
						</tr>
						<tr>
							<td>item</td>
							<td>stock_item_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the stock quantity to an item (product).<br/>
								The value acts as a foreign key relating the table to the primary key of a custom item (product) table.
							</td>
						</tr>
						<tr>
							<td>quantity</td>
							<td>stock_quantity</td>
							<td class="align_ctr">int</td>
							<td>The items stock quantity.</td>
						</tr>
						<tr>
							<td>auto_allocate_status</td>
							<td>stock_auto_allocate_status</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines whether the cart should auto allocate the stock quantity on a specific item.<br/>
								The parameter allows the items stock quantity to be checked and displayed, but prevents the value being updated by any cart functions.<br/>
								If the column is disabled, all item stock quantities will be auto allocated.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then the 'item' and 'quantity' columns are required, all disabled columns must be set as 'FALSE'.</p>
					<hr/>
					<p>
						The table containing the item stock data does not need to be a table dedicated to just item stock data.<br/>
						As the stock data has a one-to-one relationship with an item, (i.e. one item can only have one stock quantity) the stock data columns could be included in a custom user defined item table.
					</p>
				</div>
					
				<h6>Notes</h6>
				<div class="frame_note">
					<p class="highlight_red">
						IMPORTANT NOTE: If the stock data columns are included in a user defined item table, the 'id' column must be set to FALSE as the 'item' column will become the primary key column.
					</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['item_stock']['table'] = 'item_stock';
$config['database']['item_stock']['columns']['id'] = 'stock_id';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['item_stock']['table'] = FALSE;
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