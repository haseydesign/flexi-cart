<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Cart Session Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for cart session data functions in flexi cart."/> 
	<meta name="keywords" content="cart session data functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Getting Cart Session Data</h1>
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

			<h2>Get Cart Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/cart_index">List all Cart Functions</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data">Get Cart Item Session Data</a> | 
			<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data">Get Cart Summary Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_helper_data">Get Cart Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_set_data">Set Cart Session Data</a>

			<div class="anchor_nav">
				<h6>Get Cart Data from Session</h6>
				<p>
					<a href="#cart_status">cart_status()</a> | <a href="#cart_array">cart_array()</a> | <a href="#cart_contents">cart_contents()</a>
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
		
			<a name="cart_status"></a>
			<div class="w100 frame">
				<h3 class="heading">cart_status()</h3>
				
				<p>Returns whether there are any items in the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Empty:</strong>FALSE</p>
					<p><strong class="spacer_100">Not Empty:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>cart_status()</code>
							<small>Do any items exist in the cart?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->cart_status());?></td>
					</tr>
				</table>
			</div>

			<a name="cart_array"></a>
			<div class="w100 frame">
				<h3 class="heading">cart_array()</h3>
				
				<p>Returns the entire cart session data as an array.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
			
				<h6>Notes</h6>
				<div class="frame_note">
					<p>The data returned by this function is the carts actual session data. It is not formatted and no item or summary values include any applied discounts.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>cart_array()</code>
							<small>Return the unformatted internal data for the entire cart data array.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->cart_array());?></pre>
						</td>
					</tr>
				</table>
			</div>

			<a name="cart_contents"></a>
			<div class="w100 frame">
				<h3 class="heading">cart_contents()</h3>
				
				<p>Returns the cart item and summary array.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>cart_contents(inc_discount, format, internal_value)</code>
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
							<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
			
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function acts as a wrapper calling both the '<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#cart_items">cart_items()</a>' and '<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#cart_summary">cart_summary()</a>' functions, which in turn calls many other item and summary functions that are available via the lite library.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>cart_contents(TRUE, TRUE, FALSE)</code>
							<small>Return the <span class="uline">current</span> item and summary cart data array, including any set discounts.</small>
							<span class="toggle tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->cart_contents(TRUE, TRUE, FALSE));?></pre>
						</td>
					</tr>
					<tr>
						<td>
							<code>cart_contents(TRUE, TRUE, TRUE)</code>
							<small>Return the <span class="uline">internal</span> item and summary cart data array, including any set discounts.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->cart_contents(TRUE, TRUE, TRUE));?></pre>
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