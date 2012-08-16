<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Discount Helper Data | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for discount helper functions in flexi cart."/> 
	<meta name="keywords" content="discount helper data, user guide, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
	<link rel="stylesheet" href="<?php echo $includes_dir;?>css/jquery.countdown.css"/>
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
				<h1>User Guide | Discount Helper Data</h1>
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
			
			<h2>Discount Helper Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/discount_index">Discount Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_config">Discount Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_session_data">Get Discount Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_set_data">Set Discount Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_admin">Discount Admin Data</a>
			
			<div class="anchor_nav">
				<h6>Get Discount Data from Database</h6>
				<p>
					<a href="#get_discount_requirements">get_discount_requirements()</a> | <a href="#get_item_discounts">get_item_discounts()</a>
				</p>
				<h6>Calculate Savings Values</h6>
				<p>
					<a href="#get_saving_value">get_saving_value()</a> | <a href="#get_saving_percentage">get_saving_percentage()</a>
				</p>
				<h6>Calculate Expire Time</h6>
				<p>
					<a href="#get_expire_time">get_expire_time()</a>
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

			<a name="get_discount_requirements"></a>
			<div class="w100 frame">
				<h3 class="heading">get_discount_requirements()</h3>
				
				<p>Looks-up the database and returns an array containing the quantity and value required to activate a specific discount.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Requires the discount database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_discount_requirements(discount_id, format, internal_value)</code>
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
							<td>discount_id</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the id of the discount to return requirement data for.</td>
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
							<td>Defines whether to return the monetary value using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>get_discount_requirements(4, TRUE, FALSE)</code>
							<small>Show the requirements to activate a specific discount (disc_id = 4), and the outstanding <span class="uline">internal</span> values until the discount is active.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->get_discount_requirements(4, TRUE, FALSE));?></pre>
						</td>
					</tr>
					<tr>
						<td>
							<code>get_discount_requirements(4, TRUE, TRUE)</code>
							<small>Show the requirements to activate a specific discount (disc_id = 4), and the outstanding <span class="uline">current</span> values until the discount is active.</small>
							<span class="toggle tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->get_discount_requirements(4, TRUE, TRUE));?></pre>
						</td>
					</tr>
				</table>
			</div>

			<a name="get_item_discounts"></a>
			<div class="w100 frame">
				<h3 class="heading">get_item_discounts()</h3>
				
				<p>Looks-up the database and returns an array of discounts that can be applied to a specific item.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Requires the discount database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_item_discounts(item_id, sql_select, sql_where)</code>
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
							<td>sql_select</td>
							<td class="align_ctr">string | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define the database fields returned via an SQL SELECT statement.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>sql_where</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database records to return.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
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
							<code>get_item_discounts($item_id, FALSE, FALSE)</code>
							<small>Using a database lookup, get all discounts that could be applied to this item and return them as an array.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->get_item_discounts($item_id, FALSE, FALSE));?></pre>
						</td>
					</tr>
					<tr>
						<td>
							<code>get_item_discounts($item_id, 'disc_id, disc_description', array('disc_item_fk' => 101))</code>
							<small>Using a database lookup, get all discounts that could be applied to this item, but return only the id and description.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->get_item_discounts($item_id, 'disc_id, disc_description', array('disc_item_fk' => 101)));?></pre>
						</td>
					</tr>
				</table>
			</div>

			<a name="get_saving_value"></a>
			<div class="w100 frame">
				<h3 class="heading">get_saving_value()</h3>
				
				<p>Calculates the difference between two monetary values.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_saving_value(new_value, original_value, format)</code>
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
							<td>new_value</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">0</td>
							<td>Defines the discounted/cheaper value.</td>
						</tr>
						<tr>
							<td>original_value</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">0</td>
							<td>Defines the original value.</td>
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
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>get_saving_value(10, 25.50, TRUE)</code>
							<small>What is the monetary saving from a discount of "Was <?php echo $this->flexi_cart->currency_symbol();?>25.50, now <?php echo $this->flexi_cart->currency_symbol();?>10"?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_saving_value(10, 25.50, TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="get_saving_percentage"></a>
			<div class="w100 frame">
				<h3 class="heading">get_saving_percentage()</h3>
				
				<p>Calculates the percentage difference between two monetary values.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_saving_percentage(new_value, original_value, suffix_delimiter, decimals)</code>
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
							<td>new_value</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">0</td>
							<td>Defines the discounted/cheaper value.</td>
						</tr>
						<tr>
							<td>original_value</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">0</td>
							<td>Defines the original value.</td>
						</tr>
						<tr>
							<td>suffix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">%</td>
							<td>Defines a value that is suffixed to the end of the returned value.</td>
						</tr>
						<tr>
							<td>decimals</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">0</td>
							<td>Defines the number of decimals to return the value with.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>get_saving_percentage(33.33, 100, '%', 1)</code>
							<small>What is the percentage saving from a discount of "Was <?php echo $this->flexi_cart->currency_symbol();?>100, now <?php echo $this->flexi_cart->currency_symbol();?>33.33"?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_saving_percentage(33.33, 100, '%', 1);?></td>
					</tr>
				</table>
			</div>

			<a name="get_expire_time"></a>
			<div class="w100 frame">
				<h3 class="heading">get_expire_time()</h3>
				
				<p>
					Returns the number of seconds until a submitted date.<br/>
					The returned value can then be used to generate a countdown timer.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>get_expire_time(expire_date)</code>
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
							<td>expire_date</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								The expiry date to return a timestamp for.<br/>
								The submitted date can be formatted as either a UNIX timestamp, or a MySQL DATE or DATETIME string.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						Example 'expire_date' values:
						<ul>
							<li>UNIX timestamp : '1234567890'</li>
							<li>MySQL DATE string : '2015-01-01'</li>
							<li>MySQL DATETIME string : '2015-01-01 12:30:00'</li>
						</ul>
					</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>int</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>get_expire_time('2015-01-01 00:00:00')</code>
							<small>How many seconds from now until January 1st 2015?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_expire_time('2015-01-01 00:00:00');?></td>
					</tr>
					<tr>
						<td>
							<code>get_expire_time(date('Y-m-d H:i:s', strtotime('2 hours')))</code>
							<small>How many seconds for a 2 hour countdown from now?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_expire_time(date('Y-m-d H:i:s', strtotime('2 hours')));?></td>
					</tr>
					<tr>
						<td>A demo of using 'get_expire_time()' with the <a href="http://keith-wood.name/countdown.html" target="_blank">jQuery Countdown plugin</a>, using the 2 hour countdown example.</td>
						<td class="spacer_200 align_ctr">
							<input type="hidden" id="countdown_time" value="<?php echo $this->flexi_cart->get_expire_time(date('Y-m-d H:i:s', strtotime('2 hours')));?>"/>
							<div id="countdown_timer" class="countdown_wrap">
								<?php echo date('Y-m-d H:i:s', strtotime('2 hours'));?>
							</div>
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

<!-- Discount countdown demo created using the jQuery Countdown plugin found @ http://keith-wood.name/countdown.html -->
<script src="<?php echo $includes_dir;?>js/jquery.countdown.min.js?v=1.5.9"></script>
<script>
$(function () {
	// Countdown timer example.
	var countdown_time = $('#countdown_time').val();
	$('#countdown_timer').countdown({until:countdown_time, alwaysExpire:true, expiryText:'<span class="countdown_expired">Timer has Expired</span>'});
});
</script>

</body>
</html>