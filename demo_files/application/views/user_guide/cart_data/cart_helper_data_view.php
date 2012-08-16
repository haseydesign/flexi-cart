<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>flexi cart - A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="xxx"/> 
	<meta name="keywords" content="xxx"/>
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
				<h1>User Guide | Cart Helper Data</h1>
				<p>Helper functions are used to provide value formatting and calculation functionality, or to return data from the carts database tables.</p>
				<p>
					The functions can act independently of data within the cart session, using database table ids or custom data directly submitted to the function to return values, rather than for example requiring the row id of an item in the cart.
				</p>
				<p>
					This independence from data within the cart session means the functions can be used on pages across a site that do not display cart data, or even on items that have not been added to the cart.
				</p>
					The data within the carts session can then be accessed and in many cases, formatted and customised using the large range of functions that are available from the lite and standard libraries.
				</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">

			<h2>Cart Helper Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/cart_index">List all Cart Functions</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data">Get Cart Item Session Data</a> | 
			<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data">Get Cart Summary Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_session_data">Get Cart Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_set_data">Set Cart Session Data</a>

			<div class="anchor_nav">
				<h6>Date and Time Helper Functions</h6>
				<p>
					<a href="#get_date_time">get_date_time()</a>
				</p>
				<h6>Weight Helper Functions</h6>
				<p>
					<a href="#weight_name">weight_name()</a> | <a href="#weight_symbol">weight_symbol()</a> | <a href="#convert_weight">convert_weight()</a> | <a href="#format_weight">format_weight()</a> | <a href="#get_weight_types">get_weight_types()</a> 
				</p>
				<h6>Get Real Database Names</h6>
				<p>
					<a href="#db_table">db_table()</a> | <a href="#db_column">db_column()</a>
				</p>
			</div>
				
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with Cart Functions</h3>
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
		
			<a name="get_date_time"></a>
			<div class="w100 frame">
				<h3 class="heading">get_date_time()</h3>
				
				<p>Returns either an SQL DATETIME formatted time stamp or a UNIX timestamp.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>get_date_time(apply_time, date_time, force_unix)</code>
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
							<td>apply_time</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">0</td>
							<td>
								Defines the number of seconds to apply to the to-be-returned time.<br/>
								Example: Add 2 hours = 7200 (60 Sec x 60 Min x 2 Hours).
							</td>
						</tr>
						<tr>
							<td>date_time</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Defines the date/time to base the returned time value on.<br/>
								The submitted date can be formatted as either a UNIX timestamp, or a MySQL DATE or DATETIME string.
							</td>
						</tr>
						<tr>
							<td>force_unix</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to force the function to return a UNIX timestamp, regardless of whether the cart is set to use MySQL DATETIME.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>The type of date value returned is based on the value in the config files '<code>$config['settings']['date_time']</code>', which can either be in a MySQL DATETIME, or UNIX timestamp format.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>string (MySQL DATETIME) | int (UNIX Timestamp)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>get_date_time(FALSE, FALSE, FALSE)</code>
							<small>What is the <span class="uline">current</span> date and time?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_date_time(FALSE, FALSE, FALSE);?></td>
					</tr>
					<tr>
						<td>
							<code>get_date_time(3600, FALSE, FALSE)</code>
							<small>What is the current date and time, <span class="uline">plus 1 hour</span>? (60 seconds * 60 minutes = 3600 seconds)</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_date_time(3600, FALSE, FALSE);?></td>
					</tr>
					<tr>
						<td>
							<code>get_date_time(-3600, FALSE, FALSE)</code>
							<small>What is the current date and time, <span class="uline">minus 1 hour</span>? (60 * 60 = 3600 seconds)</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_date_time(-3600, FALSE, FALSE);?></td>
					</tr>
					<tr>
						<td>
							<code>get_date_time(43200, '2010-01-01 09:00:00', FALSE)</code>
							<small>What was the date and time on <span class="uline">1st January 2010 @ 9am, plus 12 hours</span>? (60 * 60 * 12 = 43200 seconds)</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_date_time(43200, '2010-01-01 09:00:00', FALSE);?></td>
					</tr>
					<tr>
						<td>
							<code>get_date_time(43200, '2010-01-01 09:00:00', TRUE)</code>
							<small>What was the date and time on 1st January 2010 @ 9am, plus 12 hours, as a <span class="uline">UNIX timestamp</span>? (60 * 60 * 12 = 43200 seconds)</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_date_time(43200, '2010-01-01 09:00:00', TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="weight_name"></a>
			<div class="w100 frame">
				<h3 class="heading">weight_name()</h3>
				
				<p>Returns the name of the carts default weight type.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>weight_name()</code>
							<small>What is the name for the carts default weight?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->weight_name();?></td>
					</tr>
				</table>
			</div>

			<a name="weight_symbol"></a>
			<div class="w100 frame">
				<h3 class="heading">weight_symbol()</h3>
				
				<p>Returns the symbol of the carts default weight type.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>weight_symbol()</code>
							<small>What is the symbol for the carts default weight?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->weight_symbol();?></td>
					</tr>
				</table>
			</div>

			<a name="convert_weight"></a>
			<div class="w100 frame">
				<h3 class="heading">convert_weight()</h3>
				
				<p>Returns a weight converted from one weight type to another.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>convert_weight(value, convert_from, convert_to, format, decimals)</code>
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
							<td>value</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">0</td>
							<td>The value to be converted.</td>
						</tr>
						<tr>
							<td>convert_from</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Defines the weight type to convert the value 'from'.<br/>
								If no valid weight type is submitted, the carts default is used.
							</td>
						</tr>
						<tr>
							<td>convert_to</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Defines the weight type to convert the value 'to'.<br/>
								If no valid weight type is submitted, the carts default is used.
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
					<p><strong class="spacer_100">Failure:</strong>int (0)</p>
					<p><strong class="spacer_100">Success:</strong>int | (string if value if formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>convert_weight(10, 'gram', 'kilogram', TRUE, 2)</code>
							<small>Convert 10 <span class="uline">grams to kilograms</span>, displayed to <span class="uline">2 decimals</span>.</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->convert_weight(10, 'gram', 'kilogram', TRUE, 2);?></td>
					</tr>
					<tr>
						<td>
							<code>convert_weight(10, 'kilogram', 'gram', TRUE, 0)</code>
							<small>Convert 10 <span class="uline">kilograms to grams</span>, displayed to <span class="uline">0 decimals</span>.</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->convert_weight(10, 'kilogram', 'gram', TRUE, 0);?></td>
					</tr>
				</table>
			</div>

			<a name="format_weight"></a>
			<div class="w100 frame">
				<h3 class="heading">format_weight()</h3>
				
				<p>Returns the submitted value formatted as a weight.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>format_weight(value, weight_type, format, decimals, internal_format)</code>
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
							<td>value</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">0</td>
							<td>The value to be formatted.</td>
						</tr>
						<tr>
							<td>weight_type</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Defines the weight type to format the weight as.<br/>
								If no value is submitted, the carts default is used.
							</td>
						</tr>
						<tr>
							<td>format</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether to format the returned value with a weight symbol and a 'thousand' separator.</td>
						</tr>
						<tr>
							<td>decimals</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the number of decimals to return the value with.</td>
						</tr>
						<tr>
							<td>internal_format</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to format the weight using the carts internal default settings, or the users current session settings.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>int (0)</p>
					<p><strong class="spacer_100">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>format_weight(10, FALSE, TRUE, FALSE, FALSE)</code>
							<small>Format '10' to the <span class="uline">carts default weight type</span>, using the format settings (thousand, decimal separators) for the <span class="uline">current</span> currency.</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The difference between 'internal' and this example is only apparent if the user is viewing prices in a currency that formats the thousand and decimal separator differently from the default cart setting.">
								<?php echo $this->flexi_cart->format_weight(10, FALSE, TRUE, FALSE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>format_weight(10.5, 'kilogram', TRUE, 2, FALSE)</code>
							<small>Format '10.5' to a <span class="uline">2 decimal kilogram weight</span>, using the format settings (thousand, decimal separators) for the <span class="uline">current</span> currency.</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The difference between 'internal' and this example is only apparent if the user is viewing prices in a currency that formats the thousand and decimal separator differently from the default cart setting.">
								<?php echo $this->flexi_cart->format_weight(10.5, 'kilogram', TRUE, 2, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>format_weight(10, FALSE, TRUE, FALSE, TRUE)</code>
							<small>Format '10' to the <span class="uline">carts default weight type</span>, using the format settings (thousand, decimal separators) for the <span class="uline">internal</span> currency.</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->format_weight(10, FALSE, TRUE, FALSE, TRUE);?></td>
					</tr>
				</table>
			</div>
			
			<a name="get_weight_types"></a>
			<div class="w100 frame">
				<h3 class="heading">get_weight_types()</h3>
				
				<p>Returns either an array of data for a specific weight type or a multi-dimensional array all weight types and their data.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>get_weight_types(name)</code>
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
							<td>name</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Defines the weight type to return for.<br/>
								Available weight types are '<em>gram</em>', '<em>kilogram</em>', '<em>avoir_ounce</em>', '<em>avoir_pound</em>', '<em>troy_ounce</em>', '<em>troy_pound</em>' and '<em>carat</em>'.								
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>array | (Single dimensional if 'name' submitted, multi-dimensional otherwise)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>get_weight_types(FALSE)</code>
							<small>Return an array of <span class="uline">all</span> weight types that are available in flexi cart.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->get_weight_types());?></pre>
						</td>
					</tr>
					<tr>
						<td>
							<code>get_weight_types('kilogram')</code>
							<small>Return an array of data for the <span class="uline">kilogram</span> weight type that is available in flexi cart.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->get_weight_types('kilogram'));?></pre>
						</td>
					</tr>
				</table>
			</div>

			<a name="db_table"></a>
			<div class="w100 frame">
				<h3 class="heading">db_table()</h3>
				
				<p>Returns the actual name of a table defined in the config file by referencing the tables internal name.</p>
				<p>By using this function to reference database table names on pages throughout a site, if the table name is ever changed, the new name only has to be updated once via the config file, rather than updating the usage of the original name throughout a site.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>db_table(table)</code>
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
							<td>table</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>The internal name of the table.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>db_table('item_shipping')</code>
							<small>What is the actual table name for the 'item_shipping' table alias?</small>
						</th>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->db_table('item_shipping');?></td>
					</tr>
				</table>
			</div>

			<a name="db_column"></a>
			<div class="w100 frame">
				<h3 class="heading">db_column()</h3>
				
				<p>Returns the actual name of a table column defined in the config file by referencing the table columns internal name.</p>
				<p>By using this function to reference database column names on pages throughout a site, if the column name is ever changed, the new name only has to be updated once via the config file, rather than updating the usage of the original name throughout a site.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>db_column(table, column)</code>
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
							<td>table</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>The internal name of the table.</td>
						</tr>
						<tr>
							<td>column</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>The internal name of the tables column.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>db_column('item_shipping', 'id')</code>
							<small>What is the actual column name for the 'id' column alias in the 'item_shipping' table alias?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->db_column('item_shipping', 'id');?></td>
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