<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Shipping Helper Data | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for item shipping helper functions in flexi cart."/> 
	<meta name="keywords" content="item shipping helper data, user guide, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="user_guide">

<div id="body_wrap" class="fixed_footer">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- User Guide Navigation -->
	<?php $this->load->view('includes/user_guide_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>User Guide | Item Shipping Helper Data</h1>
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
			
			<h2>Item Shipping Helper Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/item_shipping_index">Item Shipping Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_shipping_config">Item Shipping Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_shipping_admin">Item Shipping Admin Data</a>
			
			<div class="anchor_nav">
				<h6>Get Item Shipping Data from Database</h6>
				<p>
					<a href="#get_item_shipping_rate">get_item_shipping_rate()</a> | <a href="#get_item_shipping_status">get_item_shipping_status()</a> | <a href="#get_item_shipping_separate_status">get_item_shipping_separate_status()</a>
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

			<div id="ajax_content">

				<a name="get_item_shipping_rate"></a>
				<div class="w100 frame">
					<h3 class="heading">get_item_shipping_rate()</h3>
					
					<p>Looks-up the database and returns a value for a specific items shipping rate to the current shipping location.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>get_item_shipping_rate(item_id, format, internal_value)</code>
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
								<td>item_id</td>
								<td class="align_ctr">int</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines the id of the item to return data for.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
							<tr>
								<td>internal_value</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to return the  value using the carts internal currency instead of the users current currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Notes</h6>
					<div class="frame_note">
						<p>
							A rate of '0' means the item ships for free.<br/>
							A rate of more than '0' means the item has a shipping surcharge that is added to the carts shipping rate.
						</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">No Rate Defined:</strong>FALSE</p>
						<p><strong class="spacer_125">Rate Defined:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>get_item_shipping_rate($item_id, TRUE, FALSE)</code>
								<small>Using a database lookup, what is the <span class="uline">current</span> rate for shipping this item to the current shipping location?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
							<?php 
								$item_shipping_rate = $this->flexi_cart->get_item_shipping_rate($item_id, TRUE, FALSE);
								if ($item_shipping_rate !== FALSE)
								{
									echo $item_shipping_rate;
								}
								else
								{
									var_dump($item_shipping_rate);
								}
							?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>get_item_shipping_rate($item_id, TRUE, TRUE)</code>
								<small>Using a database lookup, what is the <span class="uline">internal</span> rate for shipping this item to the current shipping location?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								$item_shipping_rate = $this->flexi_cart->get_item_shipping_rate($item_id, TRUE, TRUE);
								if ($item_shipping_rate !== FALSE)
								{
									echo $item_shipping_rate;
								}
								else
								{
									var_dump($item_shipping_rate);
								}
							?>
							</td>
						</tr>
					</table>
				</div>

				<a name="get_item_shipping_status"></a>
				<div class="w100 frame">
					<h3 class="heading">get_item_shipping_status()</h3>
					
					<p>Looks-up the database and returns whether a specific item is permitted to be shipped to the current shipping location.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Requires the item shipping database table to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>get_item_shipping_status(item_id)</code>
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
								<td>item_id</td>
								<td class="align_ctr">int</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines the id of the item to return data for.</td>
							</tr>
						</tbody>
					</table>
				
					<h6>Notes</h6>
					<div class="frame_note">
						<p>
							Items in the 'item_shipping' table can be grouped into 'whitelist' and 'blacklist' locations.
							<ul>
								<li>If an item has a whitelist of locations, and the current location is not matched, then the item cannot be shipped.</li>
								<li>If an item has a blacklist of locations, and the current location is matched, then the item cannot be shipped.</li>
								<li>If an item is on neither list, it is permitted.</li>
							</ul>
						</p>
					</div>
				
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Not Permitted:</strong>FALSE</p>
						<p><strong class="spacer_125">Permitted:</strong>TRUE</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>get_item_shipping_status($item_id)</code>
								<small>Using a database lookup, can this item be shipped to the current shipping location?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->get_item_shipping_status($item_id));?></td>
						</tr>
					</table>
				</div>

				<a name="get_item_shipping_separate_status"></a>
				<div class="w100 frame">
					<h3 class="heading">get_item_shipping_separate_status()</h3>
					
					<p>Looks-up the database and returns whether an item needs to be shipped separately from other items in the cart.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Requires the item shipping database tables to be enabled.</p>
					</div>				

					<h6>Function Parameters</h6>
					<code>get_item_shipping_separate_status(item_id)</code>
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
								<td>item_id</td>
								<td class="align_ctr">int</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines the id of the item to return data for.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Notes</h6>
					<div class="frame_note">
						<p>Note: If the item shipping table is not enabled, or the item is not listed in the table, the function will return 'FALSE' (Item is not shipped separately).</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_125">Not Separate:</strong>FALSE</p>
						<p><strong class="spacer_125">Separate:</strong>TRUE</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>get_item_shipping_separate_status($item_id)</code>
								<small>Using a database lookup, does this item need to be shipped separately to the current shipping location?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->get_item_shipping_separate_status($item_id));?></td>
						</tr>
					</table>
				</div>
			
			</div>

		</div>
	</div>	
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
	
	<!-- User Guide Item Selector -->  
	<?php $this->load->view('includes/user_guide_item_selector'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>