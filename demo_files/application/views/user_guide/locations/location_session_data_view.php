<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Location Session Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for location session data functions in flexi cart."/> 
	<meta name="keywords" content="location session data functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Getting Location Session Data</h1>
				<p>
					When the flexi cart library is first loaded, an array is automatically created that is setup to match the carts default settings, this data is then stored in the browsers session. All items and settings that are then later added and altered within the cart are updated to the carts session data.
				</p>
				<p>
					The data within the carts session can then be accessed and in many cases, formatted and customised using the large range of functions that are available from the lite and standard libraries.
				</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			
			<h2>Get Location Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/location_index">Location Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_config">Location Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_helper_data">Get Location Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_set_data">Set Location Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/location_admin">Location Admin Data</a>

			<div class="anchor_nav">
				<h6>Get Shipping Location Data from Session</h6>
				<p>
					<a href="#shipping_location_data">shipping_location_data()</a> | <a href="#match_shipping_location_id">match_shipping_location_id()</a> | <a href="#shipping_location_id">shipping_location_id()</a> | <a href="#shipping_location_name">shipping_location_name()</a> | <a href="#location_shipping_status">location_shipping_status()</a>
				</p>
				<h6>Get Tax Location Data from Session</h6>
				<p>
					<a href="#tax_location_data">tax_location_data()</a> | <a href="#match_tax_location_id">match_tax_location_id()</a> | <a href="#tax_location_id">tax_location_id()</a> | <a href="#tax_location_name">tax_location_name()</a>
				</p>
			</div>
				
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with Session Data Functions</h3>
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

			<a name="shipping_location_data"></a>
			<div class="w100 frame">
				<h3 class="heading">shipping_location_data()</h3>
				
				<p>Returns an array of the carts current shipping locations as table ids.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
									
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>shipping_location_data()</code>
							<small>What is the current shipping location, returned as an array?</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->shipping_location_data());?></pre>
						</td>
					</tr>
				</table>
			</div>
			
			<a name="match_shipping_location_id"></a>
			<div class="w100 frame">
				<h3 class="heading">match_shipping_location_id()</h3>
				
				<p>Returns whether a submitted location id is set within the cart shipping location array.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>match_shipping_location_id(location_id)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>location_id</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the id of the to-be-checked location.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						Typically, the function is used to match whether the location id of a html select menu option is present, if so, the option can be selected.<br/>
						Example: A html select menu lists countries, when the page loads, the menu auto selects the current country the carts shipping location is set as.								
					</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>match_shipping_location_id(1)</code>
							<small>Does the current shipping location match a location id of 1? (United Kingdom location id = 1)</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->match_shipping_location_id(1));?></td>
					</tr>
					<tr>
						<td>
							<code>match_shipping_location_id(10)</code>
							<small>Does the current shipping location match a location id of 10? (United States location id = 10)</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->match_shipping_location_id(10));?></td>
					</tr>
				</table>
			</div>
			
			<a name="shipping_location_id"></a>
			<div class="w100 frame">
				<h3 class="heading">shipping_location_id()</h3>
				
				<p>Returns the location id of the current shipping location, for a defined location type.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>shipping_location_id(location_type_id)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>location_type_id</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">1</td>
							<td>
								Defines the location type that the location id should be returned for.<br/>
								Example: Using the demos default setup, if 'location_type_id' = 2, then the location id of a 'State' would be returned.  
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>int</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>shipping_location_id(1)</code>
							<small>What is the id of the current shipping <span class="uline">country</span>? (Location type 1 = Country)</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($shipping_location_id = $this->flexi_cart->shipping_location_id(1))
							{
								echo $shipping_location_id;
							}
							else
							{
								var_dump($shipping_location_id);
							}
						?>
						</td>
					</tr>
					<tr>
						<td>
							<code>shipping_location_id(2)</code>
							<small>What is the id of the current shipping <span class="uline">state</span>? (Location type 2 = State)</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($shipping_location_id = $this->flexi_cart->shipping_location_id(2))
							{
								echo $shipping_location_id;
							}
							else
							{
								var_dump($shipping_location_id);
							}
						?>
						</td>
					</tr>
				</table>
			</div>
				
			<a name="shipping_location_name"></a>
			<div class="w100 frame">
				<h3 class="heading">shipping_location_name()</h3>
				
				<p>Returns the location name of the current shipping location, for a defined location type.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>shipping_location_name(location_type_id)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>location_type_id</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">1</td>
							<td>
								Defines the location type that the location name should be returned for.<br/>
								Example: Using the demos default setup, if 'location_type_id' = 2, then the location name of a 'State' would be returned.  
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>shipping_location_name(1)</code>
							<small>What is the name of the current shipping <span class="uline">country</span>? (Location type 1 = Country)</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($shipping_location_name = $this->flexi_cart->shipping_location_name(1))
							{
								echo $shipping_location_name;
							}
							else
							{
								var_dump($shipping_location_name);
							}
						?>
						</td>
					</tr>
					<tr>
						<td>
							<code>shipping_location_name(2)</code>
							<small>What is the name of the current shipping <span class="uline">state</span>? (Location type 2 = State)</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($shipping_location_name = $this->flexi_cart->shipping_location_name(2))
							{
								echo $shipping_location_name;
							}
							else
							{
								var_dump($shipping_location_name);
							}
						?>
						</td>
					</tr>
				</table>
			</div>
			
			<a name="location_shipping_status"></a>
			<div class="w100 frame">
				<h3 class="heading">location_shipping_status()</h3>
				
				<p>Returns whether items in the cart are permitted to be shipped to the current shipping location.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>location_shipping_status(check_all_items_permitted)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>check_all_items_permitted</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>
								Defines whether to check if all items in the cart are permitted to be shipped.<br/>
								If 'FALSE', it will check that at least 1 item in the cart is permitted.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Not Permitted:</strong>FALSE</p>
					<p><strong class="spacer_125">Permitted:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>location_shipping_status(TRUE)</code>
							<small>Are <span class="uline">all</span> items in the cart permitted to be shipped to the current location?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->location_shipping_status(TRUE));?></td>
					</tr>
					<tr>
						<td>
							<code>location_shipping_status(FALSE)</code>
							<small>Are <span class="uline">any</span> items in the cart permitted to be shipped to the current location?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->location_shipping_status(FALSE));?></td>
					</tr>
				</table>
			</div>
			
			<a name="tax_location_data"></a>
			<div class="w100 frame">
				<h3 class="heading">tax_location_data()</h3>
				
				<p>Returns an array of the carts current tax locations as table ids.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
									
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>tax_location_data()</code>
							<small>What is the current tax location, returned as an array?</small>						
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->tax_location_data());?></pre>
						</td>
					</tr>
				</table>
			</div>

			<a name="match_tax_location_id"></a>
			<div class="w100 frame">
				<h3 class="heading">match_tax_location_id()</h3>
				
				<p>Returns whether a submitted location id is set within the cart tax location array.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>match_tax_location_id(location_id)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>location_id</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the id of the to-be-checked location.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						Typically, the function is used to match whether the location id of a html select menu option is present, if so, the option can be selected.<br/>
						Example: A html select menu lists countries, when the page loads, the menu auto selects the current country the carts tax location is set as.								
					</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>match_tax_location_id(1)</code>
							<small>Does the current tax location match a location id of 1? (United Kingdom location id = 1)</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->match_tax_location_id(1));?></td>
					</tr>
					<tr>
						<td>
							<code>match_tax_location_id(10)</code>
							<small>Does the current tax location match a location id of 10? (United States location id = 10)</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->match_tax_location_id(10));?></td>
					</tr>
				</table>
			</div>

			<a name="tax_location_id"></a>
			<div class="w100 frame">
				<h3 class="heading">tax_location_id()</h3>
				
				<p>Returns the location id of the current tax location, for a defined location type.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>tax_location_id(location_type_id)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>location_type_id</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">1</td>
							<td>
								Defines the location type that the location id should be returned for.<br/>
								Example: Using the demos default setup, if 'location_type_id' = 2, then the location id of a 'State' would be returned.  
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>int</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>tax_location_id(1)</code>
							<small>What is the id of the current tax <span class="uline">country</span>? (Location type 1 = Country)</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($tax_location_id = $this->flexi_cart->tax_location_id(1))
							{
								echo $tax_location_id;
							}
							else
							{
								var_dump($tax_location_id);
							}
						?>
						</td>
					</tr>
					<tr>
						<td>
							<code>tax_location_id(2)</code>
							<small>What is the id of the current tax <span class="uline">state</span>? (Location type 2 = State)</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($tax_location_id = $this->flexi_cart->tax_location_id(2))
							{
								echo $tax_location_id;
							}
							else
							{
								var_dump($tax_location_id);
							}
						?>
						</td>
					</tr>
				</table>
			</div>

			<a name="tax_location_name"></a>
			<div class="w100 frame">
				<h3 class="heading">tax_location_name()</h3>
				
				<p>Returns the location name of the current tax location, for a defined location type.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>tax_location_name(location_type_id)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>location_type_id</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">1</td>
							<td>
								Defines the location type that the location name should be returned for.<br/>
								Example: Using the demos default setup, if 'location_type_id' = 2, then the location name of a 'State' would be returned.  
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>tax_location_name(1)</code>
							<small>What is the name of the current tax <span class="uline">country</span>? (Location type 1 = Country)</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($tax_location_id = $this->flexi_cart->tax_location_name(1))
							{
								echo $tax_location_id;
							}
							else
							{
								var_dump($tax_location_id);
							}
						?>
						</td>
					</tr>
					<tr>
						<td>
							<code>tax_location_name(2)</code>
							<small>What is the name of the current tax <span class="uline">state</span>? (Location type 2 = State)</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($tax_location_id = $this->flexi_cart->tax_location_name(2))
							{
								echo $tax_location_id;
							}
							else
							{
								var_dump($tax_location_id);
							}
						?>
						</td>
					</tr>
				</table>
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