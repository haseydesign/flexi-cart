<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Tax Session Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for tax session data functions in flexi cart."/> 
	<meta name="keywords" content="tax session data functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Getting Tax Session Data</h1>
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
						
			<h2>Get Tax Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/tax_index">Tax Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/tax_config">Tax Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/tax_set_data">Set Tax Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/tax_admin">Tax Admin Data</a>

			<div class="anchor_nav">
				<h6>Get Tax Data from Session</h6>
				<p>
					<a href="#tax_name">tax_name()</a> | <a href="#tax_rate">tax_rate()</a>
				</p>
				<h6>Get Tax Location Data from Session</h6>
				<p>
					<a href="<?php echo $base_url; ?>user_guide/location_session_data#tax_location_data">tax_location_data()</a> | 
					<a href="<?php echo $base_url; ?>user_guide/location_session_data#match_tax_location_id">match_tax_location_id()</a> | 
					<a href="<?php echo $base_url; ?>user_guide/location_session_data#tax_location_id">tax_location_id()</a> | 
					<a href="<?php echo $base_url; ?>user_guide/location_session_data#tax_location_name">tax_location_name()</a>
				</p>
				<h6>Get Tax Location Data from Session</h6>
				<p>
					<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#display_prices_inc_tax">display_prices_inc_tax()</a> | 
					<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#cart_prices_inc_tax">cart_prices_inc_tax()</a>
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

			<a name="tax_name"></a>
			<div class="w100 frame">
				<h3 class="heading">tax_name()</h3>
				
				<p>Returns the name of the current tax (Example 'VAT', 'GST' etc.).</p>
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
							<code>tax_name()</code>
							<small>What is the name of the current tax?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->tax_name();?></td>
					</tr>
				</table>
			</div>				

			<a name="tax_rate"></a>
			<div class="w100 frame">
				<h3 class="heading">tax_rate()</h3>
				
				<p>
					Returns the carts current tax rate, the rate is by default formatted to suffix a '%' symbol on the end, this can be omitted by submitting FALSE.<br/>
					The carts internal tax rate can be returned submitting $internal_value as TRUE.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>tax_rate(suffix_delimiter, internal_value)</code>
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
							<td>suffix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">%</td>
							<td>Defines a value that is suffixed to the end of the tax rate.</td>
						</tr>
						<tr>
							<td>internal_value</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to return the carts internal tax rate rather than the users current tax rate.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
				<h6>Examples</h6>
				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>
				<table class="example">
					<tr>
						<td>
							<code>tax_rate('%', FALSE)</code>
							<small>Display the <span class="uline">current</span> tax rate with a percentage sign immediately after it.</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: This example is only apparent if the user has set a location with a tax rate different from the default cart setting.">
								<?php echo $this->flexi_cart->tax_rate('%', FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>tax_rate('<?php echo htmlentities('&nbsp;');?>%', FALSE)</code>
							<small>Display the <span class="uline">current</span> tax rate with a spacer and percentage sign immediately after it.</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: This example is only apparent if the user has set a location with a tax rate different from the default cart setting.">
								<?php echo $this->flexi_cart->tax_rate('&nbsp;%', FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>tax_rate('<?php echo htmlentities('&nbsp;');?>%', TRUE)</code>
							<small>Display the <span class="uline">internal</span> tax rate with a spacer and percentage sign immediately after it.</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->tax_rate('&nbsp;%', TRUE);?></td>
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