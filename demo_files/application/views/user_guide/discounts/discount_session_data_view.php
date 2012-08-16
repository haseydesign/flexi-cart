<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Discount Session Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for discount session data functions in flexi cart."/> 
	<meta name="keywords" content="discount session data functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h2>User Guide | Getting Discount Session Data</h2>
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
			
			<h2>Get Discount Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/discount_index">Discount Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_config">Discount Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_helper_data">Get Discount Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_set_data">Set Discount Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_admin">Discount Admin Data</a>

			<div class="anchor_nav">
				<h6>Get Discount Data from Session</h6>
				<p>
					<a href="#discount_codes">discount_codes()</a> | <a href="#excluded_discounts">excluded_discounts()</a>
				</p>
				<h6>Get Discount Summary Data from Session</h6>
				<p>
					<a href="#discount_status">discount_status()</a><br/>
					<a href="#item_summary_discount_status">item_summary_discount_status()</a> | <a href="#item_summary_discount_data">item_summary_discount_data()</a> | <a href="#item_summary_discount_description">item_summary_discount_description()</a><br/>
					<a href="#summary_discount_status">summary_discount_status()</a> | <a href="#summary_discount_data">summary_discount_data()</a> | <a href="#summary_discount_description">summary_discount_description()</a>
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

			<a name="discount_codes"></a>
			<div class="w100 frame">
				<h3 class="heading">discount_codes()</h3>
				
				<p>Returns an array of discount codes that have been applied to the cart, regardless of whether they are currently active or not.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>discount_codes()</code>
							<small>Display any set discount codes as an array.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->discount_codes());?></pre>
						</td>
					</tr>
				</table>
			</div>

			<a name="excluded_discounts"></a>
			<div class="w100 frame">
				<h3 class="heading">excluded_discounts()</h3>
				
				<p>Returns the ids on all discounts that have been manually excluded from being auto applied by the cart.</p>
				<p>Typically, auto applied discounts are discounts that are automatically applied by the cart when the discounts required quantity and value of items has been added to the cart.</p>
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
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->excluded_discounts();
</pre>
			</div>

			<a name="discount_status"></a>
			<div class="w100 frame">
				<h3 class="heading">discount_status()</h3>
				
				<p>Returns whether a discount has been applied to the cart.</p> 
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Not Applied:</strong>FALSE</p>
					<p><strong class="spacer_100">Applied:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>discount_status()</code>
							<small>Are any item or summary discounts applied to the cart?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->discount_status());?></td>
					</tr>
				</table>
			</div>

			<a name="item_summary_discount_status"></a>
			<div class="w100 frame">
				<h3 class="heading">item_summary_discount_status()</h3>
				
				<p>Returns whether any item discounts have been applied to the cart.</p> 
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Not Applied:</strong>FALSE</p>
					<p><strong class="spacer_100">Applied:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>item_summary_discount_status()</code>
							<small>Are any item discounts applied to the cart?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->item_summary_discount_status());?></td>
					</tr>
				</table>
			</div>

			<a name="item_summary_discount_data"></a>
			<div class="w100 frame">
				<h3 class="heading">item_summary_discount_data()</h3>
				
				<p>Returns an array of discount values and descriptions for all item rows.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>item_summary_discount_data(format, internal_value)</code>
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
							<td>Define whether to format the returned monetary values as currencies.</td>
						</tr>
						<tr>
							<td>internal_value</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to return the monetary values using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>array (Empty)</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>item_summary_discount_data(TRUE, FALSE)</code>
							<small>Display the <span class="uline">current</span> discount value and description for any discounts set on any cart items.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->item_summary_discount_data(TRUE, FALSE));?></pre>
						</td>
					</tr>
					<tr>
						<td>
							<code>item_summary_discount_data(TRUE, TRUE)</code>
							<small>Display the <span class="uline">internal</span> discount value and description for any discounts set on any cart items.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->item_summary_discount_data(TRUE, TRUE));?></pre>
						</td>
					</tr>
				</table>
			</div>

			<a name="item_summary_discount_description"></a>
			<div class="w100 frame">
				<h3 class="heading">item_summary_discount_description()</h3>
				
				<p>Returns item summary discount values and descriptions formatted as a string.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>item_summary_discount_description(value_prefix, prefix_delimiter, suffix_delimiter, internal_value)</code>
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
							<td>value_prefix</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Defines a string of characters to separate the discount description and value.<br/>
								If no 'value_prefix' is set, the discount value will be omitted from the returned description.
							</td>
						</tr>
						<tr>
							<td>prefix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines a string of characters to prefix to the start of each discount description.</td>
						</tr>
						<tr>
							<td>suffix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr"><?php echo htmlentities('<br/>');?></td>
							<td>Defines a string of characters to suffix to the end of each discount description.</td>
						</tr>
						<tr>
							<td>internal_value</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to return the monetary values using the carts internal currency instead of the users current currency.</td>
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
							<code>item_summary_discount_description(FALSE, FALSE, '<?php echo htmlentities('<br/>');?>', FALSE)</code>
							<small>Format the discount description on the item summary total with a line break after each row and the discount value omitted.</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($item_summary_discount_desc = $this->flexi_cart->item_summary_discount_description(FALSE, FALSE, '<br/>', FALSE))
							{
								echo $item_summary_discount_desc;
							}
							else
							{
								var_dump($item_summary_discount_desc);
							}
						?>
						</td>
					</tr>
					<tr>
						<td>
							<code>item_summary_discount_description('@<?php echo htmlentities('&nbsp;');?>', '<?php echo htmlentities('<p>');?>', '<?php echo htmlentities('</p>');?>', FALSE)</code>
							<small>Format the discount description on the item summary total with a prefixed space and '@' sign between the description and <span class="uline">current</span>value, and with each row wrapped in a html <?php echo htmlentities('<p>');?> tag.</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
						<?php 
							if ($item_summary_discount_desc = $this->flexi_cart->item_summary_discount_description('&nbsp;@&nbsp;', '<p>', '</p>', FALSE))
							{
								echo $item_summary_discount_desc;
							}
							else
							{
								var_dump($item_summary_discount_desc);
							}
						?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>item_summary_discount_description('@<?php echo htmlentities('&nbsp;');?>', '<?php echo htmlentities('<p>');?>', '<?php echo htmlentities('</p>');?>', TRUE)</code>
							<small>Format the discount description on the item summary total with a prefixed space and '@' sign between the description and <span class="uline">internal</span>value, and with each row wrapped in a html <?php echo htmlentities('<p>');?> tag.</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($item_summary_discount_desc = $this->flexi_cart->item_summary_discount_description('&nbsp;@&nbsp;', '<p>', '</p>', TRUE))
							{
								echo $item_summary_discount_desc;
							}
							else
							{
								var_dump($item_summary_discount_desc);
							}
						?>
						</td>
					</tr>
				</table>
			</div>

			<a name="summary_discount_status"></a>
			<div class="w100 frame">
				<h3 class="heading">summary_discount_status()</h3>
				
				<p>Returns whether any summary discounts have been applied to the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Not Applied:</strong>FALSE</p>
					<p><strong class="spacer_100">Applied:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>summary_discount_status()</code>
							<small>Are any summary discounts applied to the cart?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->summary_discount_status());?></td>
					</tr>
				</table>
			</div>

			<a name="summary_discount_data"></a>
			<div class="w100 frame">
				<h3 class="heading">summary_discount_data()</h3>
				
				<p>Returns an array of discount values and descriptions for either a particular summary column ('$summary_column' must be set), or all summary columns.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>summary_discount_data(summary_column, format, internal_value)</code>
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
							<td class="align_ctr">FALSE</td>
							<td>
								Defines the summary column to return discount data for.<br/>
								Valid values are 'item_summary_total', 'shipping_total' and 'total'.<br/>
								If no value is set, discount data will be returned for all summary columns.
							</td>
						</tr>
						<tr>
							<td>format</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether to format the returned monetary values as currencies.</td>
						</tr>
						<tr>
							<td>internal_value</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to return the monetary values using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>array (Empty)</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>summary_discount_data(FALSE, TRUE, FALSE)</code>
							<small>Display the <span class="uline">current</span> discount value and description for any discounts set on <span class="uline">any summary column</span>.</small>
							<span class="toggle tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->summary_discount_data(FALSE, TRUE, FALSE));?></pre>
						</td>
					</tr>
					<tr>
						<td>
							<code>summary_discount_data(FALSE, TRUE, TRUE)</code>
							<small>Display the <span class="uline">internal</span> discount value and description for any discounts set on <span class="uline">any summary column</span>.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->summary_discount_data(FALSE, TRUE, TRUE));?></pre>
						</td>
					</tr>
					<tr>
						<td>
							<code>summary_discount_data('total', TRUE, FALSE)</code>
							<small>Display the <span class="uline">current</span> discount value and description for any discount set on the <span class="uline">'total' summary column</span>.</small>
							<span class="toggle tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->summary_discount_data('total', TRUE, TRUE));?></pre>
						</td>
					</tr>
				</table>
			</div>

			<a name="summary_discount_description"></a>
			<div class="w100 frame">
				<h3 class="heading">summary_discount_description()</h3>
				
				<p>Returns summary discount values and descriptions formatted as a string.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>summary_discount_description(value_prefix, prefix_delimiter, suffix_delimiter, internal_value)</code>
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
							<td>value_prefix</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Defines a string of characters to separate the discount description and value.<br/>
								If no 'value_prefix' is set, the discount value will be omitted from the returned description.
							</td>
						</tr>
						<tr>
							<td>prefix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines a string of characters to prefix to the start of each discount description.</td>
						</tr>
						<tr>
							<td>suffix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr"><?php echo htmlentities('<br/>');?></td>
							<td>Defines a string of characters to suffix to the end of each discount description.</td>
						</tr>
						<tr>
							<td>internal_value</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to return the monetary values using the carts internal currency instead of the users current currency.</td>
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
							<code>summary_discount_description(FALSE, FALSE, '<?php echo htmlentities('<br/>');?>', FALSE)</code>
							<small>Format the discount description on the summary total with a line break after each row and the discount value omitted.</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($summary_discount_desc = $this->flexi_cart->summary_discount_description(FALSE, FALSE, '<br/>', FALSE))
							{
								echo $summary_discount_desc;
							}
							else
							{
								var_dump($summary_discount_desc);
							}
						?>
						</td>
					</tr>
					<tr>
						<td>
							<code>summary_discount_description('@<?php echo htmlentities('&nbsp;');?>', '<?php echo htmlentities('<p>');?>', '<?php echo htmlentities('</p>');?>', FALSE)</code>
							<small>Format the discount description on the summary total with a prefixed space and '@' sign between the description and <span class="uline">current</span> value, and with each row wrapped in a html <?php echo htmlentities('<p>');?> tag.</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
						<?php 
							if ($summary_discount_desc = $this->flexi_cart->summary_discount_description('&nbsp;@&nbsp;', '<p>', '</p>', FALSE))
							{
								echo $summary_discount_desc;
							}
							else
							{
								var_dump($summary_discount_desc);
							}
						?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>summary_discount_description('@<?php echo htmlentities('&nbsp;');?>', '<?php echo htmlentities('<p>');?>', '<?php echo htmlentities('</p>');?>', TRUE)</code>
							<small>Format the discount description on the summary total with a prefixed space and '@' sign between the description and <span class="uline">internal</span> value, and with each row wrapped in a html <?php echo htmlentities('<p>');?> tag.</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($summary_discount_desc = $this->flexi_cart->summary_discount_description('&nbsp;@&nbsp;', '<p>', '</p>', TRUE))
							{
								echo $summary_discount_desc;
							}
							else
							{
								var_dump($summary_discount_desc);
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