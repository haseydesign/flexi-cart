<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Shipping Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for configuring shipping in flexi cart."/> 
	<meta name="keywords" content="shipping configuration, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Shipping Configuration</h1>
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
					
			<h2>Shipping Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/shipping_index">Shipping Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_session_data">Get Shipping Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_helper_data">Get Shipping Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_set_data">Set Shipping Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_admin">Shipping Admin Data</a>

			<div class="anchor_nav">
				<h6>Config Setup Information</h6>
				<p>
					<a href="#db_schema_diagram">Table Schema Diagram</a> | <a href="#shipping_setup_notes">Setup Notes</a>
				</p>
				<h6>Table and Config File Settings</h6>
				<p>
					<a href="#shipping_table">Shipping Table</a> | <a href="#shipping_rate_table">Shipping Rate Table</a> | <a href="#config_defaults">Setting Defaults via Config File</a>
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
				<h3 class="heading">Shipping Tables Schema Diagram</h3>
				<div class="frame_note">
					<p>
						A database table schema diagram, showing how the shipping tables are related to each other and the location tables.<br/>
						Table and columns names are defined using their internal names.
					</p>
				</div>
				<img src="<?php echo $includes_dir; ?>images/db_diagrams/shipping_tables.jpg" class="db_schema_diagram"/>
			</div>			

			<a name="shipping_setup_notes"></a>
			<div class="w100 frame">
				<h3 class="heading">General Shipping Setup Notes</h3>
				<p>Below are some general notes to consider when setting up and managing the shipping tables.</p>
				<ul>
					<li>
						All shipping rates must always be based on the carts internal currency, regardless of whether the customer is viewing prices in a different currency.
					</li>
					<li>
						When defining the minimum and maximum cart value and weights for shipping option rates, ensure the minimum and maximum values are not the same, otherwise the shipping rate will not be selected.<br/>
						Example: If the minimum and maximum weight both equal '100' the only way that rate would be selected is if the cart weighs exactly '100'. 
					</li>
					<li>
						The minimum and maximum cart values are based on the non discounted total of items in the cart.
					</li>
					<li>
						If no shipping options match the customers current shipping location, then the carts default shipping option will be selected.
					</li>
				</ul>
			</div>

			<a name="shipping_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Shipping Options Table</h3>
				
				<p>
					Contains data on the available shipping options.<br/>
					The table contains names and descriptions, shipping locations, tax rates and discount inclusion settings for each shipping option.<br/>
					It does not include the shipping rates (prices) of each option, this data is held in the shipping rates table.
				</p>
				<hr/>

				<h6>Table and Column Setup</h6>
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
							<td>shipping_options</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>ship_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>name</td>
							<td>ship_name</td>
							<td class="align_ctr">string</td>
							<td>The name of the shipping option.</td>
						</tr>
						<tr>
							<td>description</td>
							<td>ship_description</td>
							<td class="align_ctr">string</td>
							<td>A description of the shipping option.</td>
						</tr>
						<tr>
							<td>location</td>
							<td>ship_location_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the shipping option to a location, so it will only be displayed if that location is set.<br/>
								The value acts as a foreign key relating the table to the primary key of the location table.
							</td>
						</tr>
						<tr>
							<td>zone</td>
							<td>ship_zone_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the shipping option to a location zone, so it will only be displayed if a location from that zone is set.<br/>
								The value acts as a foreign key relating the table to the primary key of the location zones table.
							</td>
						</tr>
						<tr>
							<td>inc_sub_locations</td>
							<td>ship_inc_sub_locations</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines whether the shipping option should allow other shipping options related to less specific locations to be displayed.<br/>
								Example: A users location is 'New York' and shipping options exist for 'United States' and 'New York'.<br/>
								If sub locations are included, the shipping options for both locations would be available, otherwise, only the 'New York' options would be available.
							</td>
						</tr>
						<tr>
							<td>tax_rate</td>
							<td>ship_tax_rate</td>
							<td class="align_ctr">int</td>
							<td>
								The tax rate to be applied to the shipping option.<br/>
								Shipping options with no tax rate set use the carts current tax rate.
							</td>
						</tr>
						<tr>
							<td>discount_inclusion</td>
							<td>ship_discount_inclusion</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines whether discounts can be applied to the current shipping option.<br/>
								Example: A 10% discount is applied to the cart, if the shipping option is excluded from discounts, the shipping price would not be discounted.
							</td>
						</tr>
						<tr>
							<td>status</td>
							<td>ship_status</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines the status of whether the shipping option is active or disabled.<br/>
								Disabled records will not be used by flexi cart functions.
							</td>
						</tr>
						<tr>
							<td>default</td>
							<td>ship_default</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines the default shipping option to be applied to the cart when first loaded.<br/>
								A table row defined as the default shipping option should be indicated with a value of 1.<br/>
								This table column can be disabled.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then with the exception of 'default', all other columns are required and the '<a href="#shipping_rate_table">Shipping Rates</a>' table must be enabled too.</p>
					<p>If the 'default' column is disabled, the cart will use the default shopping options defined via the config file.</p>
					<p>The related location tables do not need to be enabled to use shipping tables.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['shipping_options']['table'] = 'shipping_options';
$config['database']['shipping_options']['columns']['id'] = 'ship_id';

<span class="comment">// Defining the 'default' column.</span>
$config['database']['shipping_options']['default'] = 'ship_default';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['shipping_options']['table'] = FALSE;
</pre>
			</div>
			
			<a name="shipping_rate_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Shipping Rates Table</h3>
				
				<div class="frame_note">
					<p>
						Contains the shipping rates (prices) for each shipping option.<br/>
						The rates can be set into tiers, that alter the rate of the shipping option depending on the total weight and value of the order.
					</p>
				</div>

				<h6>Table and Column Setup</h6>
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
							<td>shipping_rates</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>ship_rate_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>parent</td>
							<td>ship_rate_ship_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the shipping rate to a shipping option, so it will only be used by flexi cart functions if that shipping option is set.<br/>
								The value acts as a foreign key relating the table to the primary key of the shipping options table.
							</td>
						</tr>
						<tr>
							<td>value</td>
							<td>ship_rate_value</td>
							<td class="align_ctr">int</td>
							<td>Sets the monetary value of the shipping rate tier.</td>
						</tr>
						<tr>
							<td>tare_weight</td>
							<td>ship_rate_tare_wgt</td>
							<td class="align_ctr">int</td>
							<td>
								The weight of the packaging required for the shipping rate tier.<br/>
								The tare weight is then added to the cart weight when comparing the minimum and maximum weights of shipping rate tiers.
							</td>
						</tr>
						<tr>
							<td>min_weight</td>
							<td>ship_rate_min_wgt</td>
							<td class="align_ctr">int</td>
							<td>The minimum cart weight required to activate the shipping rate tier.</td>
						</tr>
						<tr>
							<td>max_weight</td>
							<td>ship_rate_max_wgt</td>
							<td class="align_ctr">int</td>
							<td>The maximum cart weight permitted to activate the shipping rate tier.</td>
						</tr>
						<tr>
							<td>min_value</td>
							<td>ship_rate_min_value</td>
							<td class="align_ctr">int</td>
							<td>The minimum cart value (price) required to activate the shipping rate tier.</td>
						</tr>
						<tr>
							<td>max_value</td>
							<td>ship_rate_max_value</td>
							<td class="align_ctr">int</td>
							<td>The maximum cart value (price) permitted to activate the shipping rate tier.</td>
						</tr>
						<tr>
							<td>status</td>
							<td>ship_rate_status</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines the status of whether the shipping rate tier is active or disabled.<br/>
								Disabled records will not be used by flexi cart functions.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and the '<a href="#shipping_table">Shipping Options</a>' table must be enabled too.</p>
					<p>The related location tables do not need to be enabled to use shipping tables.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['shipping_rates']['table'] = 'shipping_rates';
$config['database']['shipping_rates']['columns']['id'] = 'ship_rate_id';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['shipping_rates']['table'] = FALSE;
</pre>
			</div>
			
			<a name="config_defaults"></a>
			<div class="w100 frame">
				<h3 class="heading">Defining Shipping Defaults via the Config File.</h3>
				
				<p>Default shipping options can be set to correctly configure the cart when it is first loaded.</p>
				<p>
					Setting default values via the config file is only necessary if the shipping database tables are not enabled.<br/>
					If shipping tables are enabled, the default shipping option can be defined by entering the value '1' into the row of the tables 'default' column.
				</p>
				<p class="uline">Default shipping settings set via the config file are only used if no default value has been set in the shipping option database table.</p>
				<hr/>

				<h6>Default Settings</h6>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Parameter Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>id</td>
							<td class="align_ctr">string | int</td>
							<td>Sets the id of the default shipping option.</td>
						</tr>
						<tr>
							<td>name</td>
							<td class="align_ctr">string</td>
							<td>Sets the name of the default shipping option.</td>
						</tr>
						<tr>
							<td>description</td>
							<td class="align_ctr">string</td>
							<td>Sets the description of the default shipping option.</td>
						</tr>
						<tr>
							<td>value</td>
							<td class="align_ctr">int</td>
							<td>Sets the value (price) of the default shipping option.</td>
						</tr>
						<tr>
							<td>tax_rate</td>
							<td class="align_ctr">int</td>
							<td>
								Sets the tax rate percentage of the default shipping option.<br/>
								Set FALSE to use the carts tax rate.
							</td>
						</tr>
					</tbody>
				</table>

				<h6>Notes</h6>
				<div class="frame_note">
					<p>The default shipping location can be set via the '<a href="<?php echo $base_url; ?>user_guide/location_config">Location Config Setup</a>' page.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining default shipping values set via the config file.</span>

$config['defaults']['shipping']['id'] = 1;
$config['defaults']['shipping']['name'] = 'Example Default Shipping Option';
$config['defaults']['shipping']['description'] = 'Example Description';
$config['defaults']['shipping']['value'] = 4.95; <span class="comment">// &pound;4.95</span>
$config['defaults']['shipping']['tax_rate'] = 10; <span class="comment">// 10%</span>
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling default shipping values set via the config file.</span>

$config['defaults']['shipping']['id'] = 0;
$config['defaults']['shipping']['name'] = FALSE;
$config['defaults']['shipping']['description'] = FALSE;
$config['defaults']['shipping']['value'] = 0;
$config['defaults']['shipping']['tax_rate'] = FALSE;
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