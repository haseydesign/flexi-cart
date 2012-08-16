<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Stock Helper Data | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for item stock helper functions in flexi cart."/> 
	<meta name="keywords" content="item stock helper data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Item Stock Helper Data</h1>
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
		
			<h2>Item Stock Helper Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/item_stock_index">Item Stock Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_stock_config">Item Stock Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/item_stock_admin">Item Stock Admin Data</a>
			
			<div class="anchor_nav">
				<h6>Get Item Stock Data from Database</h6>
				<p>
					<a href="#get_item_stock_status">get_item_stock_status()</a> | <a href="#get_item_stock_quantity">get_item_stock_quantity()</a>
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

				<a name="get_item_stock_status"></a>
				<div class="w100 frame">
					<h3 class="heading">get_item_stock_status()</h3>
					
					<p>Looks-up the database and returns the status of whether a specific item is in-stock.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the lite, standard and admin libraries.</p>
						<p>Requires the item stock database table to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>get_item_stock_status(item_id, deduct_cart_quantity, apply_quantity)</code>
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
								<td>deduct_cart_quantity</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to deduct the current quantity of matching items in the cart, from the items stock quantity.</td>
							</tr>
							<tr>
								<td>apply_quantity</td>
								<td class="align_ctr">int</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">0</td>
								<td>Defines a positive or negative value that can be added or subtracted from the items stock quantity.</td>
							</tr>
						</tbody>
					</table>

					<h6>Notes</h6>
					<div class="frame_note">
						<p>Note: If the item stock table is not enabled, or the item is not listed in the table, the function will return 'FALSE'.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_100">Not in Stock:</strong>FALSE</p>
						<p><strong class="spacer_100">In Stock:</strong>TRUE</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>get_item_stock_status($item_id, FALSE, 0)</code>
								<small>Using a database lookup, and <span class="uline">not deducting</span> any current item quantity present in the cart, is this item in stock?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->get_item_stock_status($item_id, FALSE, 0));?></td>
						</tr>
						<tr>
							<td>
								<code>get_item_stock_status($item_id, TRUE, 0)</code>
								<small>Using a database lookup, and <span class="uline">deducting</span> any current item quantity present in the cart, is this item in stock?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->get_item_stock_status($item_id, TRUE, 0));?></td>
						</tr>
						<tr>
							<td>
								<code>get_item_stock_status($item_id, FALSE, 50)</code>
								<small>Using a database lookup, and <span class="uline">adding a quantity of 50</span>, is this item in stock?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->get_item_stock_status($item_id, FALSE, 50));?></td>
						</tr>
						<tr>
							<td>
								<code>get_item_stock_status($item_id, FALSE, -100)</code>
								<small>Using a database lookup, and <span class="uline">subtracting a quantity of 100</span>, is this item in stock?</small>
							</td>
							<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->get_item_stock_status($item_id, FALSE, -100));?></td>
						</tr>
					</table>
				</div>

				<a name="get_item_stock_quantity"></a>
				<div class="w100 frame">
					<h3 class="heading">get_item_stock_quantity()</h3>
					
					<p>Looks-up the database and returns the quantity of in-stock items for a specific item.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the standard library only.</p>
						<p>Requires the item stock database tables to be enabled.</p>
					</div>
					
					<h6>Function Parameters</h6>
					<code>get_item_stock_quantity(item_id, deduct_cart_quantity, apply_quantity, format)</code>
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
								<td>deduct_cart_quantity</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Defines whether to deduct the current quantity of matching items in the cart, from the items stock quantity.</td>
							</tr>
							<tr>
								<td>apply_quantity</td>
								<td class="align_ctr">int</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">0</td>
								<td>Defines a positive or negative value that can be added or subtracted from the items stock quantity.</td>
							</tr>
							<tr>
								<td>format</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>Define whether to format the returned value as a currency.</td>
							</tr>
						</tbody>
					</table>
					
					<h6>Notes</h6>
					<div class="frame_note">
						<p>Note: If the item stock table is not enabled, or the item is not listed in the table, the function will return 'FALSE'.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_100">Failure:</strong>FALSE</p>
						<p><strong class="spacer_100">Success:</strong>int</p>
					</div>
					
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">						<tr>
							<td>
								<code>get_item_stock_quantity($item_id, FALSE, 0, TRUE)</code>
								<small>Using a database lookup, and <span class="uline">not deducting</span> any current item quantity present in the cart, what is the stock quantity of this item?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_stock_quantity = $this->flexi_cart->get_item_stock_quantity($item_id, FALSE, 0, TRUE)) {
									echo $item_stock_quantity;
								} else {
									var_dump($item_stock_quantity);
								}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<code>get_item_stock_quantity($item_id, TRUE, 0, TRUE)</code>
								<small>Using a database lookup, and <span class="uline">deducting</span> any current item quantity present in the cart, what is the stock quantity of this item?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_stock_quantity = $this->flexi_cart->get_item_stock_quantity($item_id, TRUE, 0, TRUE)) {
									echo $item_stock_quantity;
								} else {
									var_dump($item_stock_quantity);
								}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<code>get_item_stock_quantity($item_id, FALSE, 50, TRUE)</code>
								<small>Using a database lookup, and <span class="uline">adding a quantity of 50</span>, what is the stock quantity of this item?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_stock_quantity = $this->flexi_cart->get_item_stock_quantity($item_id, FALSE, 50, TRUE)) {
									echo $item_stock_quantity;
								} else {
									var_dump($item_stock_quantity);
								}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<code>get_item_stock_quantity($item_id, FALSE, -100, TRUE)</code>
								<small>Using a database lookup, and <span class="uline">subtracting a quantity of 100</span>, what is the stock quantity of this item?</small>
							</td>
							<td class="spacer_200 align_ctr">
							<?php 
								if ($item_stock_quantity = $this->flexi_cart->get_item_stock_quantity($item_id, FALSE, -100, TRUE)) {
									echo $item_stock_quantity;
								} else {
									var_dump($item_stock_quantity);
								}
							?>
							</td>
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