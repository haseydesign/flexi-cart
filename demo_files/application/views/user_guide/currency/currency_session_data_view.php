<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Currency Session Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for currency session data functions in flexi cart."/> 
	<meta name="keywords" content="currency session data functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Getting Currency Session Data</h1>
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

			<h2>Get Currency Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/currency_index">Currency Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_config">Currency Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_helper_data">Get Currency Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_set_data">Set Currency Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_admin">Currency Admin Data</a>

			<div class="anchor_nav">
				<h6>Get Currency Data from Session</h6>
				<p>
					 <a href="#currency_name">currency_name()</a> | <a href="#currency_symbol">currency_symbol()</a> | <a href="#exchange_rate">exchange_rate()</a>
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

			<a name="currency_name"></a>
			<div class="w100 frame">
				<h3 class="heading">currency_name()</h3>
				
				<p>Returns the currency name (Example USD, EURO, GBP, AUD) of either the current or internal currency.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
									
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>currency_name(FALSE)</code>
							<small>What is the <span class="uline">current</span> currency used to display monetary values?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The difference between 'internal' and this example is only apparent if the user is viewing prices in a currency different from the default cart setting.">
								<?php echo $this->flexi_cart->currency_name(FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>currency_name(TRUE)</code>
							<small>What is the <span class="uline">internal</span> currency used to display monetary values?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->currency_name(TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="currency_symbol"></a>
			<div class="w100 frame">
				<h3 class="heading">currency_symbol()</h3>
				
				<p>Returns the currency symbol (Example $, &euro;, &pound;) for the users current currency.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>currency_symbol(internal_value)</code>
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
							<td>internal_value</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to return the value of the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>currency_symbol(FALSE)</code>
							<small>What is the <span class="uline">current</span> currency symbol used to display monetary values?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The difference between 'internal' and this example is only apparent if the user is viewing prices in a currency different from the default cart setting.">
								<?php echo $this->flexi_cart->currency_symbol(FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>currency_symbol(TRUE)</code>
							<small>What is the <span class="uline">internal</span> currency symbol used to display monetary values?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->currency_symbol(TRUE);?></td>
					</tr>
				</table>
			</div>

			<a name="exchange_rate"></a>
			<div class="w100 frame">
				<h3 class="heading">exchange_rate()</h3>
				
				<p>Returns the exchange rate of the users current currency in comparison to the sites internal currency.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>exchange_rate(decimals)</code>
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
							<td>decimals</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">4</td>
							<td>Defines the number of decimals to return the value with.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>int</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>exchange_rate(4)</code>
							<small>What is the exchange rate conversion between the <span class="uline">current</span> currency and the carts internal currency, to four decimals?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The difference between 'internal' and this example is only apparent if the user is viewing prices in a currency different from the default cart setting.">
								<?php echo $this->flexi_cart->exchange_rate(4);?>
							</span>
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