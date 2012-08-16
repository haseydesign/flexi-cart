<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Set Tax Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for setting tax data in flexi cart."/> 
	<meta name="keywords" content="setting tax data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Setting Tax Session Data</h1>
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
						
			<h2>Set Tax Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/tax_index">Tax Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/tax_config">Tax Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/tax_session_data">Get Tax Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/tax_admin">Tax Admin Data</a>

			<div class="anchor_nav">
				<h6>Set Tax Data to Session</h6>
				<p>
					<a href="#update_tax">update_tax()</a> | <a href="#set_tax">set_tax()</a>
				</p>
				<h6>Set Tax Location Data to Session</h6>
				<p>
					<a href="<?php echo $base_url; ?>user_guide/location_set_data#update_tax_location">update_tax_location()</a>
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

			<a name="update_tax"></a>
			<div class="w100 frame">
				<h3 class="heading">update_tax()</h3>
				
				<p>Updates the carts tax rate to match the current tax location.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Requires the tax database table to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>update_tax(recalculate_cart)</code>
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
				
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function will filter all tax rates that match the current tax location, ordering them by the most specific location first, the first tax rate is then applied to the cart session data.</p>
					<p>If no tax rate can still be matched, the function will fall back to the default tax rate defined via the database and then the default tax rate values set via the config file.</p>
				</div>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function would not typically need to be called as the tax rate can be set when updating the tax location via the '<a href="<?php echo $base_url; ?>user_guide/location_set_data#update_tax_location">update_tax_location()</a>' function.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->update_tax();
</pre>
			</div>

			<a name="set_tax"></a>
			<div class="w100 frame">
				<h3 class="heading">set_tax()</h3>
				
				<p>
					Manually sets tax data without querying a database table.<br/>
					The data that can be set is the tax rate and name.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>set_tax(tax_data, recalculate_cart)</code>
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
							<td>tax_data</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								The array contains the tax data that is to update the carts tax data.<br/>
								See the notes and examples below for further information.									
							</td>
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
				
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function loops through the 'tax_data' array and sets any data from the following array keys to the cart tax data.</p>
					<p>The valid array keys are <em>'rate'</em> and <em>'name'</em>.</p>
					<ul>
						<li><strong>'rate'</strong> - The tax rate to apply to the cart. Submitted values must be numeric.</li>
						<li><strong>'name'</strong> - The name of the tax rate.</li>
					</ul>
				</div>
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>This function can also be set via the '<a href="<?php echo $base_url; ?>user_guide/cart_set_data#update_cart">update_cart()</a>' function.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$tax_data = array(
'rate' => 20, <span class="comment">// 20% tax</span>
'name' => 'Example Tax Rate'
);

$this->flexi_cart->set_tax($tax_data);
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