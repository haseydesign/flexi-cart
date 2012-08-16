<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Set Cart Config Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for setting cart config data in flexi cart."/> 
	<meta name="keywords" content="setting cart config data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Setting Cart Config Session Data</h1>
				<p>Data is set to the cart session by using functions primarily from flexi carts standard library.</p>
				<p>The data that can be set in the cart session includes data of items added to the cart, user localisation data and cart configuration settings.</p>
				<p>
					Since many of flexi carts features can be set using either manually submitted data, or data retrieved from the database; there are often two versions of a function to set session data. Functions that update session data using the database are prefixed with the function name 'update_xxx', whilst functions that use manually set data are prefixed with the name 'set_xxx'.
				</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
					
			<h2>Set Cart Config Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/cart_config_columns">Cart Column Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_settings">Cart Settings Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_internal">Cart Internal Settings Config</a><br/>
			<a href="<?php echo $base_url; ?>user_guide/cart_config_index">Cart Config Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data">Get Cart Config Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_admin">Cart Config Admin Data</a>
			
			<div class="anchor_nav">
				<h6>Set Order Settings to Session</h6>
				<p>
					<a href="#set_order_number">set_order_number()</a> | <a href="#set_minimum_order">set_minimum_order()</a>
				</p>
				<h6>Set Stock Config Settings to Session</h6>
				<p>
					<a href="#set_allocate_stock_status">set_allocate_stock_status()</a> | <a href="#set_stock_limit_quantity_status">set_stock_limit_quantity_status()</a> | <a href="#set_remove_no_stock_status">set_remove_no_stock_status()</a>
				</p>
				<h6>Set Custom Status to Session</h6>
				<p>
					<a href="#set_custom_status_1">set_custom_status_1()</a> | <a href="#set_custom_status_2">set_custom_status_2()</a> | <a href="#set_custom_status_3">set_custom_status_3()</a>
				</p>
				<h6>Set Misc. Config Settings to Session</h6>
				<p>
					<a href="#set_prices_inc_tax">set_prices_inc_tax()</a> |  | <a href="#set_item_shipping_ban_status">set_item_shipping_ban_status()</a> | <a href="#set_reward_point_multiplier">set_reward_point_multiplier()</a>
				</p>
			</div>

			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with Setting Session Data Functions</h3>
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
		
			<a name="set_order_number"></a>
			<div class="w100 frame">
				<h3 class="heading">set_order_number()</h3>
				
				<p>Sets an order number to the cart session data.</p>
				<hr/>
				
				<h6>Function Parameters</h6>
				<code>set_order_number(order_number)</code>
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
							<td>order_number</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the order number to be set.</td>
						</tr>
					</tbody>
				</table>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$order_number = 'example_order_number';

$this->flexi_cart->set_order_number($order_number);
</pre>
			</div>
		
			<a name="set_minimum_order"></a>
			<div class="w100 frame">
				<h3 class="heading">set_minimum_order()</h3>
				
				<p>Sets the carts minimum order value.</p>
				<hr/>
				
				<h6>Function Parameters</h6>
				<code>set_minimum_order(value)</code>
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
							<td>value</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the minimum order value to be set.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If no value is submitted, the cart will use the value set in the configuration database table or config file.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$minimum_order_value = 10; <span class="comment">// &pound;10.00</span>

$this->flexi_cart->set_minimum_order($minimum_order_value);
</pre>
			</div>

			<a name="set_prices_inc_tax"></a>
			<div class="w100 frame">
				<h3 class="heading">set_prices_inc_tax()</h3>
				
				<p>Sets cart pricing to be displayed including/excluding tax.</p>
				<hr/>
				
				<h6>Function Parameters</h6>
				<code>set_prices_inc_tax(tax_status)</code>
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
							<td>tax_status</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">NULL</td>
							<td>
								Defines the status.<br/>
								If no status has been submitted, the current status is toggled.
							</td>
						</tr>
					</tbody>
				</table>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Setting a specific status.</span>

$this->flexi_cart->set_prices_inc_tax(TRUE);
</pre>
<pre>
<span class="comment bold">// Example #2 : Toggle current status.</span>

$this->flexi_cart->set_prices_inc_tax();
</pre>
			</div>

			<a name="set_allocate_stock_status"></a>
			<div class="w100 frame">
				<h3 class="heading">set_allocate_stock_status()</h3>
				
				<p>Sets whether item stock should be automatically allocated by cart functions.</p>
				<hr/>
				
				<h6>Function Parameters</h6>
				<code>set_allocate_stock_status(allocate_stock_status)</code>
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
							<td>allocate_stock_status</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">NULL</td>
							<td>
								Defines the status.<br/>
								If no status has been submitted, the current status is toggled.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>The primary purpose of this function is to be able to toggle the stock allocation method within a users session, rather than updating the default cart settings that would affect all users.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Setting a specific status.</span>

$this->flexi_cart->set_allocate_stock_status(TRUE);
</pre>
<pre>
<span class="comment bold">// Example #2 : Toggle current status.</span>

$this->flexi_cart->set_allocate_stock_status();
</pre>
			</div>

			<a name="set_stock_limit_quantity_status"></a>
			<div class="w100 frame">
				<h3 class="heading">set_stock_limit_quantity_status()</h3>
				
				<p>Sets whether the maximum quantity of cart items should be limited to the databases stock quantity.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Requires the item stock database table to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>set_stock_limit_quantity_status(stock_limit_quantity_status)</code>
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
							<td>stock_limit_quantity_status</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">NULL</td>
							<td>
								Defines the status.<br/>
								If no status has been submitted, the current status is toggled.
							</td>
						</tr>
					</tbody>
				</table>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Setting a specific status.</span>

$this->flexi_cart->set_stock_limit_quantity_status(TRUE);
</pre>
<pre>
<span class="comment bold">// Example #2 : Toggle current status.</span>

$this->flexi_cart->set_stock_limit_quantity_status();
</pre>
			</div>

			<a name="set_remove_no_stock_status"></a>
			<div class="w100 frame">
				<h3 class="heading">set_remove_no_stock_status()</h3>
				
				<p>Sets whether out-of-stock items should be automatically removed from the cart.</p>
				<hr/>
				
				<h6>Function Parameters</h6>
				<code>set_remove_no_stock_status(remove_no_stock_status)</code>
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
							<td>remove_no_stock_status</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">NULL</td>
							<td>
								Defines the status.<br/>
								If no status has been submitted, the current status is toggled.
							</td>
						</tr>
					</tbody>
				</table>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Setting a specific status.</span>

$this->flexi_cart->set_remove_no_stock_status(TRUE);
</pre>
<pre>
<span class="comment bold">// Example #2 : Toggle current status.</span>

$this->flexi_cart->set_remove_no_stock_status();
</pre>
			</div>

			<a name="set_item_shipping_ban_status"></a>
			<div class="w100 frame">
				<h3 class="heading">set_item_shipping_ban_status()</h3>
				
				<p>Sets whether to save items to an order that are banned from being shipped to the defined shipping location.</p>
				<hr/>
				
				<h6>Function Parameters</h6>
				<code>set_item_shipping_ban_status(set_item_shipping_ban_status)</code>
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
							<td>set_item_shipping_ban_status</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">NULL</td>
							<td>
								Defines the status.<br/>
								If no status has been submitted, the current status is toggled.
							</td>
						</tr>
					</tbody>
				</table>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Setting a specific status.</span>

$this->flexi_cart->set_item_shipping_ban_status(TRUE);
</pre>
<pre>
<span class="comment bold">// Example #2 : Toggle current status.</span>

$this->flexi_cart->set_item_shipping_ban_status();
</pre>
			</div>

			<a name="set_reward_point_multiplier"></a>
			<div class="w100 frame">
				<h3 class="heading">set_reward_point_multiplier()</h3>
				
				<p>Sets the carts reward point multiplier.</p>
				<hr/>
				
				<h6>Function Parameters</h6>
				<code>set_reward_point_multiplier(value)</code>
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
							<td>value</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the minimum order value to be set.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>Example: A multiplier of 10 is (10 x $1.00) = 10 reward points, so every $1.00 is worth 10 reward points.</p>
					<p>If no value is submitted, the cart will use the value set in the configuration database table or config file.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$multiplier_value = 10; <span class="comment">// 10 points for every &pound;1.00 spent.</span>

$this->flexi_cart->set_reward_point_multiplier($multiplier_value);
</pre>
			</div>
							
			<a name="set_custom_status_1"></a>
			<div class="w100 frame">
				<h3 class="heading">set_custom_status_1()</h3>

				<p>Sets the value of the carts custom status #1.</p>
				<hr/>
				
				<h6>Function Parameters</h6>
				<code>set_custom_status_1(custom_status, recalculate_cart)</code>
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
							<td>custom_status</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">NULL</td>
							<td>Defines the value of the custom status.</td>
						</tr>
						<tr>
							<td>recalculate_cart</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>
								Define if all cart totals must be recalculated on success, regardless of whether the function has determined to do so or not.<br/>
								The purpose of this is prevent multiple unnecessary recalculations of the cart if this function is used with other cart updating functions. 
							</td>
						</tr>
					</tbody>
				</table>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->set_custom_status_1('example_value');
</pre>
			</div>

			<a name="set_custom_status_2"></a>
			<div class="w100 frame">
				<h3 class="heading">set_custom_status_2()</h3>

				<p>Sets the value of the carts custom status #2.</p>
				<hr/>
				
				<h6>Function Parameters</h6>
				<code>set_custom_status_2(custom_status, recalculate_cart)</code>
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
							<td>custom_status</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">NULL</td>
							<td>Defines the value of the custom status.</td>
						</tr>
						<tr>
							<td>recalculate_cart</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>
								Define if all cart totals must be recalculated on success, regardless of whether the function has determined to do so or not.<br/>
								The purpose of this is prevent multiple unnecessary recalculations of the cart if this function is used with other cart updating functions. 
							</td>
						</tr>
					</tbody>
				</table>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->set_custom_status_2('example_value');
</pre>
			</div>

			<a name="set_custom_status_3"></a>
			<div class="w100 frame">
				<h3 class="heading">set_custom_status_3()</h3>

				<p>Sets the value of the carts custom status #3.</p>
				<hr/>
				
				<h6>Function Parameters</h6>
				<code>set_custom_status_3(custom_status, recalculate_cart)</code>
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
							<td>custom_status</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">NULL</td>
							<td>Defines the value of the custom status.</td>
						</tr>
						<tr>
							<td>recalculate_cart</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>
								Define if all cart totals must be recalculated on success, regardless of whether the function has determined to do so or not.<br/>
								The purpose of this is prevent multiple unnecessary recalculations of the cart if this function is used with other cart updating functions. 
							</td>
						</tr>
					</tbody>
				</table>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->set_custom_status_3('example_value');
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