<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Tax Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for configuring tax in flexi cart."/> 
	<meta name="keywords" content="tax configuration, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Tax Configuration</h1>
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

			<h2>Tax Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/tax_index">Tax Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/tax_session_data">Get Tax Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/tax_set_data">Set Tax Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/tax_admin">Tax Admin Data</a>

			<div class="anchor_nav">
				<h6>Config Setup Information</h6>
				<p>
					<a href="#db_schema_diagram">Table Schema Diagram</a> | <a href="#tax_setup_notes">Setup Notes</a>
				</p>
				<h6>Table and Config File Settings</h6>
				<p>
					<a href="#tax_table">Tax Table</a> | <a href="#config_defaults">Setting Defaults via Config File</a>
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
				<h3 class="heading">Tax Table Schema Diagram</h3>
				<div class="frame_note">
					<p>
						A database table schema diagram, showing how the tax table is related to the location tables.<br/>
						Table and columns names are defined using their internal names.
					</p>
				</div>
				<img src="<?php echo $includes_dir; ?>images/db_diagrams/tax_tables.jpg" class="db_schema_diagram"/>
			</div>			
			
			<a name="tax_setup_notes"></a>
			<div class="w100 frame">
				<h3 class="heading">General Tax Setup Notes</h3>
				<p>Below are some general notes to consider when setting up and managing the tax table.</p>
				<ul>
					<li>
						When the cart data is first set to the browsers session, the default tax location is set as the carts tax location.<br/>
						If there are multiple tax rates available to the tax location, the tax rate defined as the default is selected.<br/>
						If the default rate is not within the default tax location, it will only be selected if there are no other tax rates available in the default tax location.
					</li>
				</ul>
			</div>

			<a name="tax_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Tax Table</h3>
				
				<p>Contains tax rates for specific locations and zones.</p>
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
							<td>tax</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>tax_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>location</td>
							<td>tax_location_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the tax rate to a location, so it will only be displayed if that location is set.<br/>
								The value acts as a foreign key relating the table to the primary key of the location table.
							</td>
						</tr>
						<tr>
							<td>zone</td>
							<td>tax_zone_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the tax rate to a location zone, so it will only be displayed if a location from that zone is set.<br/>
								The value acts as a foreign key relating the table to the primary key of the location zone table.
							</td>
						</tr>
						<tr>
							<td>name</td>
							<td>tax_name</td>
							<td class="align_ctr">string</td>
							<td>The name of the tax rate.</td>
						</tr>
						<tr>
							<td>rate</td>
							<td>tax_rate</td>
							<td class="align_ctr">int</td>
							<td>The percentage value of the tax rate.</td>
						</tr>
						<tr>
							<td>status</td>
							<td>tax_status</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines the status of whether the tax rate is active or disabled.<br/>
								Disabled records will not be used by flexi cart functions.
							</td>
						</tr>
						<tr>
							<td>default</td>
							<td>tax_default</td>
							<td class="align_ctr">int</td>
							<td>
								Defines the default tax rate to be applied to the cart when first loaded.<br/>
								A table row defined as the default tax rate should be indicated with a value of 1.<br/>
								This table column can be disabled.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then with the exception of 'default', all other columns are required.</p>
					<p>If the 'default' column is disabled, the cart will use the default tax rate defined via the config file.</p>
					<p>The related location tables do not need to be enabled to use the tax table.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['tax']['table'] = 'tax';
$config['database']['tax']['columns']['id'] = 'tax_id';

<span class="comment">// Defining the 'default' column.</span>
$config['database']['tax']['default'] = 'tax_default';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['tax']['table'] = FALSE;
</pre>
			</div>					

			<a name="config_defaults"></a>
			<div class="w100 frame">
					<h3 class="heading">Defining Tax Defaults via the Config File.</h3>
					
					<p>A default tax rate can be set to correctly configure the cart when it is first loaded.</p>
					<p>
						Setting default values via the config file is only necessary if the tax database table is not enabled.<br/>
						If the tax table is enabled, the default tax rate can be defined by entering the value '1' into the row of the tables 'default' column.
					</p>
					<p class="uline">Default tax settings set via the config file are only used if no default value has been set in the tax database table.</p>
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
								<td>name</td>
								<td class="align_ctr">string</td>
								<td>Sets the name of the default tax rate.</td>
							</tr>
							<tr>
								<td>rate</td>
								<td class="align_ctr">int</td>
								<td>Sets the percentage of the default tax rate.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Notes</h6>
					<div class="frame_note">
						<p>The default tax location can be set via the '<a href="<?php echo $base_url; ?>user_guide/location_config">Location Config Setup</a>' page.</p>
					</div>
					
					<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining default tax values set via the config file.</span>

$config['defaults']['tax']['name'] = 'VAT';
$config['defaults']['tax']['rate'] = 20;  <span class="comment">// 20%</span>
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling default tax values set via the config file.</span>

$config['defaults']['tax']['name'] = FALSE;
$config['defaults']['tax']['rate'] = FALSE;
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