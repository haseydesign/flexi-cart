<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Cart Summary Session Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for cart summary session data functions in flexi cart."/> 
	<meta name="keywords" content="cart summary session data functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Getting Cart Summary Session Data</h1>
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

			<h2>Get Cart Summary Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/cart_index">List all Cart Functions</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data">Get Cart Item Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_session_data">Get Cart Session Data</a> | 
			<a href="<?php echo $base_url; ?>user_guide/cart_helper_data">Get Cart Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_set_data">Set Cart Session Data</a>

			<div class="anchor_nav">
				<h6>Get Cart Summary Data from Session</h6>
				<p>
					<a href="#cart_summary">cart_summary()</a> | <a href="#cart_summary_array">cart_summary_array()</a>
				</p>
				<h6>Get Cart Summary Totals from Session</h6>
				<p>
					<a href="#item_summary_total">item_summary_total()</a> | <a href="#shipping_total">shipping_total()</a> | <a href="#item_shipping_total">item_shipping_total()</a> | <a href="#tax_total">tax_total()</a> | <a href="#sub_total">sub_total()</a> | <a href="#total">total()</a>
				</p>
				<h6>Get Cart Discount / Surcharge Summary Totals from Session</h6>
				<p>
					<a href="#item_summary_savings_total">item_summary_savings_total()</a> | <a href="#summary_savings_total">summary_savings_total()</a> | <a href="#reward_voucher_total">reward_voucher_total()</a> | <a href="#cart_savings_total">cart_savings_total()</a> | <a href="#surcharge_total">surcharge_total()</a>
				</p>
				<h6>Get Miscellaneous Cart Summary Totals from Session</h6>
				<p>
					<a href="#total_rows">total_rows()</a> | <a href="#total_items">total_items()</a> | <a href="#total_weight">total_weight()</a> | <a href="#total_reward_points">total_reward_points()</a> | <a href="#cart_taxable_value">cart_taxable_value()</a> | <a href="#cart_non_taxable_value">cart_non_taxable_value()</a>
				</p>
			</div>
				
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with Cart Functions</h3>
				
				<span class="toggle">Show / Hide Help</span>
				<div id="help_guide" class="hide_toggle">
					<hr/>
					<p>
						Cart functions are used to alter data within the carts session data.<br/>
						The functions can retrieve and format the session data for display on the website, as well as manage items and settings within the cart.
					</p>
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

			<a name="cart_summary"></a>
			<div class="w100 frame">
				<h3 class="heading">cart_summary()</h3>
				
				<p>Returns cart summary data, formatted by function parameters.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>cart_summary(inc_discount, format, internal_value)</code>
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
							<td>inc_discount</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Define whether the returned value should include any active discount.</td>
						</tr>
						<tr>
							<td>format</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether to format the returned value.</td>
						</tr>
						<tr>
							<td>internal_value</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function calls many of the summary data functions that are available via the lite library related to the carts tax, shipping, discount, reward point and other summary data. The data is then grouped together and returned as an array.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>array.</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>cart_summary(TRUE, TRUE, FALSE)</code>
							<small>Return the <span class="uline">current</span> summary cart data array, including any set discounts.</small>
							<span class="toggle tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->cart_summary(TRUE, TRUE, FALSE));?></pre>
						</td>
					</tr>
					<tr>
						<td>
							<code>cart_summary(TRUE, TRUE, TRUE)</code>
							<small>Return the <span class="uline">internal</span> summary cart data array, including any set discounts.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->cart_summary(TRUE, TRUE, TRUE));?></pre>
						</td>
					</tr>
				</table>					
			</div>

			<a name="cart_summary_array"></a>
			<div class="w100 frame">
				<h3 class="heading">cart_summary_array()</h3>
				
				<p>Returns the carts summary data as an array.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
			
				<h6>Notes</h6>
				<div class="frame_note">
					<p>The data returned by this function is the carts actual summary session data. It is not formatted and no values include any applied discounts.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>array (Empty).</p>
					<p><strong class="spacer_125">Success:</strong>array.</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>cart_summary_array()</code>
							<small>Return the unformatted internal data for the cart summary data array.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->cart_summary_array());?></pre>
						</td>
					</tr>
				</table>
			</div>

			<a name="item_summary_total"></a>
			<div class="w100 frame">
				<h3 class="heading">item_summary_total()</h3>
				
				<p>Returns the total value of all items within the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>item_summary_total(inc_discount, format, internal_value)</code>
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
							<td>inc_discount</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether the returned value should include any active discount.</td>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted).</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>item_summary_total(TRUE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> item summary total, <span class="uline">including</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->item_summary_total(TRUE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>item_summary_total(FALSE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> item summary total, <span class="uline">excluding</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->item_summary_total(FALSE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>item_summary_total(TRUE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> item summary total, <span class="uline">including</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_summary_total(TRUE, TRUE, TRUE);?></td>
					</tr>
					<tr>
						<td>
							<code>item_summary_total(FALSE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> item summary total, <span class="uline">excluding</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_summary_total(FALSE, TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="shipping_total"></a>
			<div class="w100 frame">
				<h3 class="heading">shipping_total()</h3>
				
				<p>Returns the shipping total of the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>shipping_total(inc_discount, format, internal_value)</code>
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
							<td>inc_discount</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether the returned value should include any active discount.</td>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted).</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>shipping_total(TRUE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> shipping total, <span class="uline">including</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->shipping_total(TRUE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>shipping_total(FALSE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> shipping total, <span class="uline">excluding</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->shipping_total(FALSE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>shipping_total(TRUE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> shipping total, <span class="uline">including</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->shipping_total(TRUE, TRUE, TRUE);?></td>
					</tr>
					<tr>
						<td>
							<code>shipping_total(FALSE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> shipping total, <span class="uline">excluding</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->shipping_total(FALSE, TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="item_shipping_total"></a>
			<div class="w100 frame">
				<h3 class="heading">item_shipping_total()</h3>
				
				<p>Returns the combined item price total and the cart shipping total.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>item_shipping_total(inc_discount, format, internal_value)</code>
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
							<td>inc_discount</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether the returned value should include any active discount.</td>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted).</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>item_shipping_total(TRUE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> item summary total and shipping total, <span class="uline">including</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->item_shipping_total(TRUE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>item_shipping_total(FALSE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> item summary total and shipping total, <span class="uline">excluding</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->item_shipping_total(FALSE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>item_shipping_total(TRUE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> item summary total and shipping total, <span class="uline">including</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_shipping_total(TRUE, TRUE, TRUE);?></td>
					</tr>
					<tr>
						<td>
							<code>item_shipping_total(FALSE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> item summary total and shipping total, <span class="uline">excluding</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_shipping_total(FALSE, TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="tax_total"></a>
			<div class="w100 frame">
				<h3 class="heading">tax_total()</h3>
				
				<p>Returns the tax total of the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>tax_total(inc_discount, format, internal_value)</code>
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
							<td>inc_discount</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether the returned value should include any active discount.</td>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted).</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>tax_total(TRUE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> tax total, <span class="uline">including</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->tax_total(TRUE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>tax_total(FALSE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> tax total, <span class="uline">excluding</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->tax_total(FALSE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>tax_total(TRUE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> tax total, <span class="uline">including</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->tax_total(TRUE, TRUE, TRUE);?></td>
					</tr>
					<tr>
						<td>
							<code>tax_total(FALSE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> tax total, <span class="uline">excluding</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->tax_total(FALSE, TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="sub_total"></a>
			<div class="w100 frame">
				<h3 class="heading">sub_total()</h3>
				
				<p>Returns the sub-total value of the cart (e.g. grand total excluding tax).</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>total(inc_discount, format, internal_value)</code>
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
							<td>inc_discount</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether the returned value should include any active discount.</td>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted).</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>sub_total(TRUE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> sub_total, <span class="uline">including</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->sub_total(TRUE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>sub_total(FALSE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> sub_total, <span class="uline">excluding</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->sub_total(FALSE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>sub_total(TRUE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> sub_total, <span class="uline">including</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->sub_total(TRUE, TRUE, TRUE);?></td>
					</tr>
					<tr>
						<td>
							<code>sub_total(FALSE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> sub_total, <span class="uline">excluding</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->sub_total(FALSE, TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="total"></a>
			<div class="w100 frame">
				<h3 class="heading">total()</h3>
				
				<p>Returns the grand total value of the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>total(inc_discount, format, internal_value)</code>
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
							<td>inc_discount</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether the returned value should include any active discount.</td>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted).</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>total(TRUE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> total, <span class="uline">including</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->total(TRUE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>total(FALSE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> total, <span class="uline">excluding</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->total(FALSE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>total(TRUE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> total, <span class="uline">including</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->total(TRUE, TRUE, TRUE);?></td>
					</tr>
					<tr>
						<td>
							<code>total(FALSE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> total, <span class="uline">excluding</span> any set discount?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->total(FALSE, TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>
			<a name="item_summary_savings_total"></a>
			<div class="w100 frame">
				<h3 class="heading">item_summary_savings_total()</h3>
				
				<p>Returns the savings total of all item discounts.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>item_summary_savings_total(format, internal_value)</code>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>item_summary_savings_total(TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> savings total of all items?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->item_summary_savings_total(TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>item_summary_savings_total(TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> savings total of all items?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->item_summary_savings_total(TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="summary_savings_total"></a>
			<div class="w100 frame">
				<h3 class="heading">summary_savings_total()</h3>
				
				<p>Returns the savings total of all summary discounts.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>summary_savings_total(format, internal_value)</code>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>summary_savings_total(TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> savings total of the cart summary?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->summary_savings_total(TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>summary_savings_total(TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> savings total of the cart summary?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->summary_savings_total(TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="cart_savings_total"></a>
			<div class="w100 frame">
				<h3 class="heading">cart_savings_total()</h3>
				
				<p>Returns the savings total of all item and summary discounts and reward vouchers applied to the cart.</p>
				<hr/> 
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>cart_savings_total(include_vouchers, format, internal_value)</code>
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
							<td>include_vouchers</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether to include the savings of any reward vouchers that are applied to the cart.</td>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>cart_savings_total(TRUE, TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> savings total of the entire cart?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->cart_savings_total(TRUE, TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>cart_savings_total(TRUE, TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> savings total of the entire cart?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->cart_savings_total(TRUE, TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="reward_voucher_total"></a>
			<div class="w100 frame">
				<h3 class="heading">reward_voucher_total()</h3>
				
				<p>Returns the total of all reward vouchers applied to the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Reward vouchers cannot be set unless the reward point, discount and order tables are enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>reward_voucher_total(format, internal_value)</code>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>reward_voucher_total(TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> reward voucher total (savings total) of the cart summary?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->reward_voucher_total(TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>reward_voucher_total(TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> reward voucher total (savings total) of the cart summary?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->reward_voucher_total(TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>		
			
			<a name="surcharge_total"></a>
			<div class="w100 frame">
				<h3 class="heading">surcharge_total()</h3>
				
				<p>Returns the total of all surcharges applied to the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>surcharge_total(format, internal_value)</code>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>surcharge_total(TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> surcharge total?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->surcharge_total(TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>surcharge_total(TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> surcharge total?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->surcharge_total(TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="total_rows"></a>
			<div class="w100 frame">
				<h3 class="heading">total_rows()</h3>
				
				<p>Returns the total number of individual rows within the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>total_rows(format)</code>
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
							<td>Define whether to format the returned value.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>total_rows(TRUE)</code>
							<small>How many different rows of items are there in the cart?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->total_rows(TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="total_items"></a>
			<div class="w100 frame">
				<h3 class="heading">total_items()</h3>
				
				<p>Returns the total number of items within the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>total_items(format)</code>
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
							<td>Define whether to format the returned value.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>total_items(TRUE)</code>
							<small>What is the total quantity of items in the cart?</small>						
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->total_items(TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="total_weight"></a>
			<div class="w100 frame">
				<h3 class="heading">total_weight()</h3>
				
				<p>
					Returns the total weight of items within the cart.<br/>
					The weight value can be converted into different weight unit types by submitting a value to '$weight_type'.<br/>
					Available weight types are 'gram', 'kilogram', 'avoir_ounce', 'avoir_pound', 'troy_ounce', 'troy_pound' and 'carat'.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>total_weight(weight_type, format, decimals)</code>
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
							<td>weight_type</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Defines the weight type that the total weight should be returned as.<br/>
								Available weight types are '<em>gram</em>', '<em>kilogram</em>', '<em>avoir_ounce</em>', '<em>avoir_pound</em>', '<em>troy_ounce</em>', '<em>troy_pound</em>' and '<em>carat</em>'.								
							</td>
						</tr>
						<tr>
							<td>format</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether to format the returned value as a weight.</td>
						</tr>
						<tr>
							<td>decimals</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the number of decimals to return the value with.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>total_weight(FALSE, TRUE, FALSE)</code>
							<small>What is the total weight of the items in the cart, displayed using the <span class="uline">cart default weight settings</span>?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->total_weight(FALSE, TRUE, FALSE);?></td>
					</tr>
					<tr>
						<td>
							<code>total_weight('kilogram', TRUE, 2)</code>
							<small>What is the total weight of the items in the cart, displayed in <span class="uline">Kilograms to 2 decimal points</span>?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->total_weight('kilogram', TRUE, 2);?></td>
					</tr>
				</table>
			</div>

			<a name="total_reward_points"></a>
			<div class="w100 frame">
				<h3 class="heading">total_reward_points()</h3>
				
				<p>Return the total reward points earnt from items within the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>total_reward_points(format)</code>
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
							<td>Define whether to format the returned value.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>total_reward_points(TRUE)</code>
							<small>What is the total number of reward points currently earnt from items in the cart?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->total_reward_points(TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="cart_taxable_value"></a>
			<div class="w100 frame">
				<h3 class="heading">cart_taxable_value()</h3>
				
				<p>Returns the total value of taxable items (excluding tax) within the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>cart_taxable_value(format, internal_value)</code>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>cart_taxable_value(TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> total taxable value of items and shipping in the cart?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->cart_taxable_value(TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>cart_taxable_value(TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> total taxable value of items and shipping in the cart?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->cart_taxable_value(TRUE, TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="cart_non_taxable_value"></a>
			<div class="w100 frame">
				<h3 class="heading">cart_non_taxable_value()</h3>
				
				<p>Returns the total value of non-taxable items within the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>cart_non_taxable_value(format, internal_value)</code>
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
							<td>Define whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_125">Failure:</strong>n/a</p>
					<p><strong class="spacer_125">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>cart_non_taxable_value(TRUE, FALSE)</code>
							<small>What is the <span class="uline">current</span> total non-taxable value of items and shipping in the cart?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->cart_non_taxable_value(TRUE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>cart_non_taxable_value(TRUE, TRUE)</code>
							<small>What is the <span class="uline">internal</span> total non-taxable value of items and shipping in the cart?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->cart_non_taxable_value(TRUE, TRUE);?></td>
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