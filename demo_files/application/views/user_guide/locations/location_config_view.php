<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Location Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for configuring locations in flexi cart."/> 
	<meta name="keywords" content="location configuration, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Location Configuration</h1>
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
			
			<h2>Location Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/location_index">Location Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_session_data">Get Location Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_helper_data">Get Location Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_set_data">Set Location Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_admin">Location Admin Data</a>

			<div class="anchor_nav">
				<h6>Config Setup Information</h6>
				<p>
					<a href="#db_schema_diagram">Table Schema Diagram</a> | <a href="#location_setup_notes">Setup Notes</a> 
				</p>
				<h6>Table and Config File Settings</h6>
				<p>
					<a href="#location_type_table">Location Type Table</a> | <a href="#locations_table">Locations Table</a> | <a href="#location_zones_table">Location Zones Table</a> | <a href="#config_defaults">Setting Defaults via Config File</a>
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
				<h3 class="heading">Location Tables Schema Diagram</h3>
				<div class="frame_note">
					<p>
						A database table schema diagram, showing how the location tables are related to each other.<br/>
						Table and columns names are defined using their internal names.
					</p>
				</div>
				<img src="<?php echo $includes_dir; ?>images/db_diagrams/location_tables.jpg" class="db_schema_diagram"/>
			</div>			

			<a name="location_setup_notes"></a>
			<div class="w100 frame">
				<h3 class="heading">General Location Setup Notes</h3>
				<p>Below are some general notes to consider when setting up and managing the location tables.</p>
				<ul>
					<li>
						When defining locations and zones for shipping options, taxes and discounts; the location has priority over the zone.<br/>
						Example: If multiple tax rates matched the current tax location and zone, then the tax rates that specifically match the location would be returned instead of tax rates matching the zone.
					</li>
					<li>
						When a location is deleted that is related to shipping options, taxes or discounts; if the related 'child' data is not also deleted, then it becomes orphaned. This means that whilst the child data is still valid, it will no longer be accessible by helper functions until the data is updated with a new parent location.
					</li>
				</ul>
			</div>

			<a name="location_type_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Location Type Table</h3>
				
				<p>Contains data on the type of locations and zones available, i.e. countries, states, counties, cities and even zip/post codes.</p>
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
							<td>location_type</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>loc_type_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>parent</td>
							<td>loc_type_parent_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the location type to a parent location type, i.e. 'Country' > 'State'.<br/>
								The value acts as a foreign key relating the table to the primary key of this table.
							</td>
						</tr>
						<tr>
							<td>name</td>
							<td>loc_type_name</td>
							<td class="align_ctr">string</td>
							<td>The name of the location type.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and the '<a href="#locations_table">Locations</a>' and '<a href="#location_zones_table">Location Zones</a>' tables must be enabled too.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['location_type']['table'] = 'location_type';
$config['database']['location_type']['columns']['id'] = 'loc_type_id';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['location_type']['table'] = FALSE;
</pre>
			</div>
						
			<a name="locations_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Locations Table</h3>
				
				<p>Contains location and zone data used to calculate shipping and tax rates.</p>
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
							<td>locations</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>loc_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>type</td>
							<td>loc_type_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the location to a location type.<br/>
								The value acts as a foreign key relating the table to the primary key of the Location Type table.
							</td>
						</tr>
						<tr>
							<td>parent</td>
							<td>loc_parent_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the location to a parent location, i.e. 'United States' > 'New York'.<br/>
								The value acts as a foreign key relating the table to the primary key of this table.
							</td>
						</tr>
						<tr>
							<td>shipping_zone</td>
							<td>loc_ship_zone_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the location to a location zone that is used to group shipping locations together.<br/>
								The value acts as a foreign key relating the table to the primary key of the Location Zone table.
							</td>
						</tr>
						<tr>
							<td>tax_zone</td>
							<td>loc_tax_zone_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the location to a location zone that is used to group tax locations together.<br/>
								The value acts as a foreign key relating the table to the primary key of the Location Zone table.
							</td>
						</tr>
						<tr>
							<td>name</td>
							<td>loc_name</td>
							<td class="align_ctr">string</td>
							<td>The name of the location.</td>
						</tr>
						<tr>
							<td>status</td>
							<td>loc_status</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines the status of whether the location is active or disabled.<br/>
								Disabled records will not be used by flexi cart functions.
							</td>
						</tr>
						<tr>
							<td>shipping_default</td>
							<td>loc_ship_default</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines the default shipping location to be applied to the cart when first loaded.<br/>
								A table row defined as the default shipping location should be indicated with a value of 1.
							</td>
						</tr>
						<tr>
							<td>tax_default</td>
							<td>loc_tax_default</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines the default tax location to be applied to the cart when first loaded.<br/>
								A table row defined as the default tax location should be indicated with a value of 1.<br/>
								This table column can be disabled.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then with the exception of 'shipping_default' and 'tax_default', all other columns are required and the '<a href="#location_type_table">Location Type</a>' and '<a href="#location_zones_table">Location Zones</a>' tables must be enabled too.</p>
					<p>If either of the 'shipping_default' and 'tax_default' columns are disabled, the cart will use the default location settings defined via the config file.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['locations']['table'] = 'locations';
$config['database']['locations']['columns']['id'] = 'loc_id';

<span class="comment">// Defining the 'shipping_default' and 'tax_default' columns.</span>
$config['database']['locations']['shipping_default'] = 'loc_ship_default';
$config['database']['locations']['tax_default'] = 'loc_tax_default';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['locations']['table'] = FALSE;
</pre>
			</div>
						
			<a name="location_zones_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Location Zones Table</h3>
				
				<p>
					Contains data on the type of zones available. <br/>
					The purpose of zones is to allow the grouping of locations that would otherwise be impractical using the parent-to-child relationship offered by the Location Type tiers.
				</p>
				<p>
					For example, to create an 'EU' tax rule, you would not be able to apply it to a location of 'Europe' as not all European countries are in the 'EU'.
					So instead, create a zone called 'Tax EU Zone', independent countries can then be assigned to this zone that will now inherit a defined 'EU' tax rate.
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
							<td>location_zones</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>lzone_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>name</td>
							<td>lzone_name</td>
							<td class="align_ctr">string</td>
							<td>The name of the location zone.</td>
						</tr>
						<tr>
							<td>description</td>
							<td>lzone_description</td>
							<td class="align_ctr">string</td>
							<td>A description of the location zone.</td>
						</tr>
						<tr>
							<td>status</td>
							<td>lzone_status</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines the status of whether the location zone is active or disabled.<br/>
								Disabled records will not be used by flexi cart functions.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and the '<a href="#location_type_table">Locations Type</a>' and '<a href="#locations_table">Locations</a>' tables must be enabled too.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['location_zones']['table'] = 'location_zones';
$config['database']['location_zones']['columns']['id'] = 'lzone_id';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['location_zones']['table'] = FALSE;
</pre>
			</div>

			<a name="config_defaults"></a>
			<div class="w100 frame">
				<h3 class="heading">Defining Location Defaults via the Config File.</h3>
				
				<p>Default shipping and tax locations can be set to correctly configure the cart when it is first loaded.</p>
				<p>
					The default locations can be defined via either the config file or via the location database table.<br/>
					However, since the location based functionality of flexi cart is only active if the location table is defined, it is likely to be more practical to define the defaults via a column in the location table.
				</p>
				<p>To set the default shipping and tax locations via the location table, enter the value '1' into the row of the tables 'shipping_default' and 'tax_default' columns.</p>			
				<p class="uline">Default locations set via the config file are only used if no default value has been set in the location database table.</p>
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
							<td>location</td>
							<td class="align_ctr">string | int | array</td>
							<td>Sets the default shipping and tax locations.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>Default locations can be defined using either be a string (i.e. location name), integer (i.e. location id in database) or an array of multiple strings and/or integers.</p>
					<p>The config values will then be matched against the location table, matching ids with table ids and string names with location names (Names are matched identically).</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the default shipping and tax location using a <strong class="uline">string</strong>.</span>

$config['defaults']['shipping']['location'] = 'United States';
$config['defaults']['tax']['location'] = 'United States';
</pre>
<pre>
<span class="comment bold">// Example #2 : Defining the default shipping and tax location using an <strong class="uline">array</strong>.</span>
<span class="comment">// Note: When defining multiple tier locations, include all parents of the child location.</span>

$config['defaults']['shipping']['location'] = array('United States', 'New York');
$config['defaults']['tax']['location'] = array('United States', 'New York');
</pre>
<pre>
<span class="comment bold">// Example #3 : Disabling default locations set via the config file.</span>

$config['defaults']['shipping']['location'] = FALSE;
$config['defaults']['tax']['location'] = FALSE;
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