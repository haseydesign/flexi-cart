<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Tax Helper Data | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for item tax helper functions in flexi cart."/> 
	<meta name="keywords" content="item tax helper data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Item Tax Helper Data</h1>
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
		
			<h2>Item Tax Helper Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/item_tax_index">Item Tax Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_tax_config">Item Tax Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_tax_admin">Item Tax Admin Data</a>
			
			<div class="anchor_nav">
				<h6>Get Item Tax Data from Database</h6>
				<p>
					<a href="#get_item_tax_rate">get_item_tax_rate()</a> | <a href="#get_item_tax_value">get_item_tax_value()</a>
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

				<a name="get_item_tax_rate"></a>
				<div class="w100 frame">
					<h3 class="heading">get_item_tax_rate()</h3>
					
					<p>Looks-up the database and returns the tax rate for a specific item.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Requires the item tax database table to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>get_item_tax_rate(item_id, format, fallback_default)</code>
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
								<td>Define whether to format the returned value as a percentage.</td>
							</tr>
							<tr>
								<td>fallback_default</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Defines whether to return the carts default tax rate if the item does not have a specific tax rate applied to it.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_100">Failure:</strong>FALSE</p>
						<p><strong class="spacer_100">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>get_item_tax_rate($item_id, TRUE, TRUE)</code>
								<small>
									Using a database lookup, what is the current items tax rate?<br/> 
									If nothing is specifically set for this item, return the carts current tax rate.
								</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_tax_rate = $this->flexi_cart->get_item_tax_rate($item_id, TRUE, TRUE)) {
									echo $item_tax_rate;
								} else {
									var_dump($item_tax_rate);
								}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<code>get_item_tax_rate($item_id, TRUE, FALSE)</code>
								<small>
									Using a database lookup, what is the current items tax rate?<br/> 
									If nothing is specifically set for this item, return FALSE.
								</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_tax_rate = $this->flexi_cart->get_item_tax_rate($item_id, TRUE, FALSE)) {
									echo $item_tax_rate;
								} else {
									var_dump($item_tax_rate);
								}
							?>
							</td>
						</tr>
					</table>
				</div>				

				<a name="get_item_tax_value"></a>
				<div class="w100 frame">
					<h3 class="heading">get_item_tax_value()</h3>
					
					<p>Looks-up the database to get an items tax rate, the tax rate is then calculated against a submitted value to return the items tax value.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Requires the item tax database table to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>get_item_tax_value(item_id, value, format, internal_value)</code>
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
								<td>value</td>
								<td class="align_ctr">int</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>The value to calculate the tax value of.</td>
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
						<p>Note: If the item tax table is not enabled, or the item is not listed in the table, the function will return the carts current tax rate.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_100">Failure:</strong>n/a</p>
						<p><strong class="spacer_100">Success:</strong>int | (string if value is formatted)</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>get_item_tax_value($item_id, 100, TRUE, FALSE)</code>
								<small>Using a database lookup, what is the <span class="uline">current</span> tax value of this item if its price is <?php echo $this->flexi_cart->currency_symbol(TRUE);?>100.00?</small>
							</td>
							<td class="spacer_200 align_ctr">
								<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
									<?php echo $this->flexi_cart->get_item_tax_value($item_id, 100, TRUE, FALSE);?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<code>get_item_tax_value($item_id, 100, TRUE, TRUE)</code>
								<small>Using a database lookup, what is the <span class="uline">internal</span> tax value of this item if its price is <?php echo $this->flexi_cart->currency_symbol(TRUE);?>100.00?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_item_tax_value($item_id, 100, TRUE, TRUE);?></td>
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