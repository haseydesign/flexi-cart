<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Location Helper Data | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for location helper functions in flexi cart."/> 
	<meta name="keywords" content="location helper data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Location Helper Data</h1>
				<p>Helper functions are used to provide value formatting and calculation functionality, or to return data from the carts database tables.</p>
				<p>
					The functions can act independently of data within the cart session, using database table ids or custom data directly submitted to the function to return values, rather than for example requiring the row id of an item in the cart.
				</p>
				<p>
					This independence from data within the cart session means the functions can be used on pages across a site that do not display cart data, or even on items that have not been added to the cart.
				</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			
			<h2>Location Helper Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/location_index">Location Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_config">Location Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_session_data">Get Location Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_set_data">Set Location Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_admin">Location Admin Data</a>
			
			<div class="anchor_nav">
				<h6>Get Location Data from Database</h6>
				<p>
					<a href="#get_shipping_location">get_shipping_location()</a> | <a href="#get_tax_location">get_tax_location()</a>
				</p>
				<h6>Display Location Data Functions</h6>
				<p>
					<a href="#locations_tiered">locations_tiered()</a> | <a href="#locations_inline">locations_inline()</a> | <a href="#location_zones">location_zones()</a>
				</p>
			</div>
				
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with Helper Functions</h3>
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
			
			<a name="get_shipping_location"></a>
			<div class="w100 frame">
				<h3 class="heading">get_shipping_location()</h3>
				
				<p>
					Looks-up the database and returns all active shipping locations that are of a specific location type and are the child locations of any higher tier shipping location that may be set.<br/>
					Typically, the returned location data can be used to populate HTML inputs fields.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Requires location database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>get_shipping_location(sql_select, location_type_id)</code>
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
							<td>location_type_id</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">0</td>
							<td>
								Define the location type id that all returned shipping locations should be a direct child of.<br/>
								See the documentation and examples below for further information.				
							</td>
						</tr>
					</tbody>
				</table>

				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function looks-up the current shipping location and gets the location id that matches the location type that was submitted.</p>
					<p>The function then uses the retrieved location id to query the location table for any child locations with a matching parent location id.</p>
					<p>For example, using the default configuration of the flexi cart demo, if the carts current shipping location has been set as a country, and a 'location_type_id' of 1 was submitted, it would return all available states of that specific country.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function can be chained with CodeIgniters query functions 'result()', 'row()' etc.</p>
					<p>
						Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on all the combined flexi cart and CodeIgniter functions that are available.
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_75">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_75">Success:</strong>object or array</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_select = array(
'loc_id', 
'loc_name'
);

<span class="comment">// The second parameter is an example of a location type id of '1'.</span>
$this->flexi_cart->get_shipping_location($sql_select, 1);

<span class="comment">// Produces: 
// SELECT `loc_id`, `loc_name`
// FROM (`locations`)
// WHERE `loc_parent_fk` =  '10'
// 	AND `loc_status` =  1</span>
</pre>
			</div>

			<a name="get_tax_location"></a>
			<div class="w100 frame">
				<h3 class="heading">get_tax_location()</h3>
				
				<p>
					Looks-up the database and returns all active tax locations that are of a specific location type and are the child locations of any higher tier tax location that may be set.<br/>
					Typically, the returned location data can be used to populate HTML inputs fields.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Requires location database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>get_tax_location(sql_select, location_type_id)</code>
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
							<td>location_type_id</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">0</td>
							<td>
								Define the location type id that all returned tax locations should be a direct child of.<br/>
								See the documentation and examples below for further information.				
							</td>
						</tr>
					</tbody>
				</table>

				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function looks-up the current tax location and gets the location id that matches the location type that was submitted.</p>
					<p>The function then uses the retrieved location id to query the location table for any child locations with a matching parent location id.</p>
					<p>For example, using the default configuration of the flexi cart demo, if the carts current tax location has been set as a country, and a 'location_type_id' of 1 was submitted, it would return all available states of that specific country.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function can be chained with CodeIgniters query functions 'result()', 'row()' etc.</p>
					<p>
						Read the <a href="<?php echo $base_url; ?>user_guide/query_sql_results">Query Result documentation</a> for further information on all the combined flexi cart and CodeIgniter functions that are available.
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_75">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_75">Success:</strong>object or array</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information on setting SQL statements.</span>
$sql_select = array(
'loc_id', 
'loc_name'
);

<span class="comment">// The second parameter is an example of a location type id of '1'.</span>
$this->flexi_cart->get_tax_location($sql_select, 1);

<span class="comment">// Produces: 
// SELECT `loc_id`, `loc_name`
// FROM (`locations`)
// WHERE `loc_parent_fk` =  '10'
// 	AND `loc_status` =  1</span>
</pre>
			</div>

			<a name="locations_tiered"></a>
			<div class="w100 frame">
				<h3 class="heading">locations_tiered()</h3>
				
				<p>
					Gets all current active locations and formats them into an array, grouped into each locations respective location type.<br/>
					This data can then be used to create a tiered group of HTML select menus listing all available locations group by each location type.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Requires all location database tables to be enabled.</p>
				</div>				
				
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs a SQL SELECT query to get all location types. The location types are then looped through and another SQL SELECT query is run to get all locations that are related to the location type.</p>
					<p>If locations exist for each location type, then they are added to a multi-dimensional array of each location type and its related locations.</p>
					<p>The returned array data can then be used to create a tiered group of HTML select menus.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>The intended purpose of this function is use the returned data to create a series of HTML select menus that are dependent of each other.</p>
					<p>Using the default demo data as an example, this means that there would be three select menus, Countries, States and Post/Zip Codes. When a Country is selected, the State select menu would then list States from that Country rather than all States from all Countries.</p>
					<p>To improve the user experience of updating the data displayed via the select menus when an option has been selected, an example JavaScript function and snippet has been included in the <a href="<?php echo $base_url; ?>admin_library/demo_location_menus">demo</a>. This is not a part of the flexi cart library, so needs to be included in your own JavaScript include files. It is free for you to use and customise however you wish.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>array (Empty) | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->locations_tiered();

<span class="comment toggle">// Click to show an example array produced.</span>
<span class="comment hide_toggle">Array
(
[Country] => Array
(
	[0] => Array
	(
		[loc_id] => 1
		[loc_parent_fk] => 0
		[loc_name] => United Kingdom (EU)
	)
		[1] => Array
	(
		[loc_id] => 10
		[loc_parent_fk] => 0
		[loc_name] => United States
	)
)
[State] => Array
(
	[0] => Array
	(
		[loc_id] => 14
		[loc_parent_fk] => 10
		[loc_name] => California
	)
	[1] => Array
	(
		[loc_id] => 15
		[loc_parent_fk] => 10
		[loc_name] => Florida
	)
	[2] => Array
	(
		[loc_id] => 16
		[loc_parent_fk] => 10
		[loc_name] => New York
	)
	[3] => Array
	(
		[loc_id] => 17
		[loc_parent_fk] => 10
		[loc_name] => Pennsylvania
	)
)
[Post / Zip Code] => Array
(
	[0] => Array
	(
		[loc_id] => 18
		[loc_parent_fk] => 16
		[loc_name] => 10101
	)
	[1] => Array
	(
		[loc_id] => 19
		[loc_parent_fk] => 16
		[loc_name] => 10102
	)
)
)</span></pre>
			</div>
			
			<a name="locations_inline"></a>
			<div class="w100 frame">
				<h3 class="heading">locations_inline()</h3>
				
				<p>
					Gets all current active locations and formats them into an array.<br/>
					This data can then be used to create a single HTML select menu listing all available locations.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Requires all location database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>locations_inline(separator)</code>
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
							<td>separator</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">' > '</td>
							<td>Sets a characters(s) to separate each location from each other.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs a SQL SELECT query to get all locations. The location data is then looped through and a string is built up grouping each child location with its parent location, and then with its grandparent location etc.</p>
					<p>The finalised string is then added to a single dimensional array.</p>
					<p>The returned array data can then be used to create a single HTML select menu listing all available locations.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>array (Empty) | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>array</p> 
				</div>
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->locations_inline();

<span class="comment toggle">// Click to show an example array produced.</span>
<span class="comment hide_toggle">Array
(
[0] => Array
(
	[loc_id] => 8
	[loc_name] => Australia
)
[1] => Array
(
	[loc_id] => 11
	[loc_name] => Australia > NSW
)
[2] => Array
(
	[loc_id] => 12
	[loc_name] => Australia > Queensland
)
[3] => Array
(
	[loc_id] => 13
	[loc_name] => Australia > Victoria
)
)</span></pre>
			</div>

			<a name="location_zones"></a>
			<div class="w100 frame">
				<h3 class="heading">location_zones()</h3>
				
				<p>Gets all current active location zones and formats them into an array.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Requires all location database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>location_zones(zone_type)</code>
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
							<td>zone_type</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to return zones that have either shipping locations, tax locations or both types related to them.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>Locations can each be added to one shipping zone and one tax zone.</p>
					<p>
						The function checks the 'zone_type' parameter whether to filter zones by either shipping zones, tax zones or both.<br/>
						Valid 'zone_type' values are:
						<ul>
							<li><strong>'shipping'</strong> - returns only shipping zones.</li>
							<li><strong>'tax'</strong> - returns only tax zones.</li>
							<li><strong>FALSE</strong> - returns all zones.</li>
						</ul>
					</p>
					<p>When the function applies the filter, it returns only zones that have locations in the defined 'zone_type' parameter.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>array (Empty) | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>array</p> 
				</div>
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->location_zones();

<span class="comment toggle">// Click to show an example array produced.</span>
<span class="comment hide_toggle">Array
(
[0] => Array
(
	[lzone_id] => 4
	[lzone_name] => Tax EU Zone
	[lzone_description] => Example Tax Zone for EU countries
)
[1] => Array
(
	[lzone_id] => 5
	[lzone_name] => Tax Non EU Zone
	[lzone_description] => Example Tax Zone for Non EU European countries
)
)</span></pre>
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