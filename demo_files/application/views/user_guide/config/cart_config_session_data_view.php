<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Cart Config Session Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for cart config session data functions in flexi cart."/> 
	<meta name="keywords" content="cart config session data functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Getting Cart Config Session Data</h1>
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

			<h2>Get Cart Config Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/cart_config_columns">Cart Column Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_settings">Cart Settings Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_internal">Cart Internal Settings Config</a><br/>
			<a href="<?php echo $base_url; ?>user_guide/cart_config_index">Cart Config Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data">Set Cart Config Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_admin">Cart Config Admin Data</a>

			<div class="anchor_nav">
				<h6>Get Order Config Settings from Session</h6>
				<p>
					<a href="#order_number">order_number()</a> | <a href="#minimum_order">minimum_order()</a> | <a href="#minimum_order_status">minimum_order_status()</a>
				</p>
				<h6>Get Tax Config Settings from Session</h6>
				<p>
					<a href="#display_prices_inc_tax">display_prices_inc_tax()</a> | <a href="#cart_prices_inc_tax">cart_prices_inc_tax()</a>
				</p>
				<h6>Get Custom Statuses from Session</h6>
				<p>
					<a href="#custom_status_1">custom_status_1()</a> | <a href="#custom_status_2">custom_status_2()</a> | <a href="#custom_status_3">custom_status_3()</a>
				</p>
				<h6>Get Misc. Config Settings from Session</h6>
				<p>
					<a href="#cart_data_id">cart_data_id()</a> | <a href="#reward_point_multiplier">reward_point_multiplier()</a><br/>
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
						
			<a name="cart_data_id"></a>
			<div class="w100 frame">
				<h3 class="heading">cart_data_id()</h3>
				
				<p>Returns the id of the current cart data array.</p>
				<p>The cart id is used to identify cart data that is saved to the database.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Value Not Set:</strong>FALSE</p>
					<p><strong class="spacer_125">Value Set:</strong>int</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>cart_data_id()</code>
							<small>What is the current cart data id (if set)?</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($cart_data_id = $this->flexi_cart->cart_data_id())
							{
								echo $cart_data_id;
							}
							else
							{
								var_dump($cart_data_id);
							}
						?>
						</td>
					</tr>
				</table>
			</div>

			<a name="order_number"></a>
			<div class="w100 frame">
				<h3 class="heading">order_number()</h3>
				
				<p>Returns the current order number.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Value Not Set:</strong>FALSE</p>
					<p><strong class="spacer_125">Value Set:</strong>string</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>order_number()</code>
							<small>What is the current order number (if set)?</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($order_number = $this->flexi_cart->order_number())
							{
								echo $order_number;
							}
							else
							{
								var_dump($order_number);
							}
						?>
						</td>
					</tr>
				</table>
			</div>

			<a name="minimum_order"></a>
			<div class="w100 frame">
				<h3 class="heading">minimum_order()</h3>
				
				<p>Returns the minimum order value required for the cart to checkout.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>minimum_order(format, internal_value)</code>
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
							<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Value Set:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>minimum_order(TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> currencies minimum order value?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->minimum_order(TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>minimum_order(TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> currencies minimum order value?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->minimum_order(TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="minimum_order_status"></a>
			<div class="w100 frame">
				<h3 class="heading">minimum_order_status()</h3>
				
				<p>Returns whether a defined cart summary column is equal or more than the minimum required value to checkout.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>minimum_order_status(summary_column, inc_discount)</code>
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
							<td>summary_column</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">item_summary_total</td>
							<td>
								Defines the summary column to return discount data for.<br/>
								Valid values are 'item_summary_total', 'shipping_total' and 'total'.<br/>
								If no value is set, discount data will be returned for all summary columns.
							</td>
						</tr>
						<tr>
							<td>inc_discount</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether the returned value should include any active discounts.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Invalid:</strong>FALSE</p>
					<p><strong class="spacer_125">Valid:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>minimum_order_status('item_summary_total', TRUE)</code>
							<small>Is the 'Item Summary Total' >= <?php echo $this->flexi_cart->minimum_order(TRUE, FALSE);?>, <span class="uline">including</span> any set discounts?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->minimum_order_status('item_summary_total', TRUE));?></td>
					</tr>
					<tr>
						<td>
							<code>minimum_order_status('item_summary_total', FALSE)</code>
							<small>Is the 'Item Summary Total' >= <?php echo $this->flexi_cart->minimum_order(TRUE, FALSE);?>, <span class="uline">excluding</span> any set discounts?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->minimum_order_status('item_summary_total', FALSE));?></td>
					</tr>
				</table>
			</div>

			<a name="display_prices_inc_tax"></a>
			<div class="w100 frame">
				<h3 class="heading">display_prices_inc_tax()</h3>
				
				<p>Returns whether the user is currently viewing prices including tax.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Excluding Tax:</strong>FALSE</p>
					<p><strong class="spacer_125">Including Tax:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>display_prices_inc_tax()</code>
							<small>Are prices currently displayed including tax?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->display_prices_inc_tax());?></td>
					</tr>
				</table>
			</div>

			<a name="cart_prices_inc_tax"></a>
			<div class="w100 frame">
				<h3 class="heading">cart_prices_inc_tax()</h3>
				
				<p>Returns whether the cart is setup by default to handle and display all prices as including tax.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Excluding Tax:</strong>FALSE</p>
					<p><strong class="spacer_125">Including Tax:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>cart_prices_inc_tax()</code>
							<small>Do prices submitted to the cart include tax?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->cart_prices_inc_tax());?></td>
					</tr>
				</table>
			</div>

			<a name="reward_point_multiplier"></a>
			<div class="w100 frame">
				<h3 class="heading">reward_point_multiplier()</h3>
				
				<p>Returns the reward point multiplier that is used to calculate the number of reward points earnt per 1 unit of currency (i.e &pound;1.00).</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
									
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Value Set:</strong>int</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>reward_point_multiplier()</code>
							<small>How many reward points are earnt per <?php echo $this->flexi_cart->currency_symbol(TRUE);?>1.00?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->reward_point_multiplier();?></td>
					</tr>
				</table>
			</div>

			<a name="custom_status_1"></a>
			<div class="w100 frame">
				<h3 class="heading">custom_status_1()</h3>
				
				<p>Returns the value of the carts custom status #1.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
									
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Value Not Set:</strong>FALSE</p>
					<p><strong class="spacer_125">Value Set:</strong>string | int</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>custom_status_1()</code>
							<small>What is the value of the carts custom status #1?</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($custom_status_1 = $this->flexi_cart->custom_status_1()) {
								echo $custom_status_1;
							} else {
								var_dump($custom_status_1);
							}
						?>
						</td>
					</tr>
				</table>
			</div>

			<a name="custom_status_2"></a>
			<div class="w100 frame">
				<h3 class="heading">custom_status_2()</h3>
				
				<p>Returns the value of the carts custom status #2.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
									
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Value Not Set:</strong>FALSE</p>
					<p><strong class="spacer_125">Value Set:</strong>string | int</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>custom_status_2()</code>
							<small>What is the value of the carts custom status #2?</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($custom_status_2 = $this->flexi_cart->custom_status_2()) {
								echo $custom_status_2;
							} else {
								var_dump($custom_status_2);
							}
						?>
						</td>
					</tr>
				</table>
			</div>

			<a name="custom_status_3"></a>
			<div class="w100 frame">
				<h3 class="heading">custom_status_3()</h3>
				
				<p>Returns the value of the carts custom status #3.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
									
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Value Not Set:</strong>FALSE</p>
					<p><strong class="spacer_125">Value Set:</strong>string | int</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>custom_status_3()</code>
							<small>What is the value of the carts custom status #3?</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($custom_status_3 = $this->flexi_cart->custom_status_3()) {
								echo $custom_status_3;
							} else {
								var_dump($custom_status_3);
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