<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Reward Point and Voucher Helper Data | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for reward point and voucher helper functions in flexi cart."/> 
	<meta name="keywords" content="reward point and voucher helper data, user guide, flexi cart, shopping cart, codeigniter"/>

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
				<h1>User Guide | Reward Point and Voucher Helper Data</h1>
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
			
			<h2>Reward Point and Voucher Helper Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/reward_index">Reward Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_config">Reward Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_set_data">Set Reward Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_admin">Reward Admin Data</a>
			
			<div class="anchor_nav">
				<h6>Calculate Reward Points</h6>
				<p>
					<a href="#calculate_reward_points">calculate_reward_points()</a>
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

			<a name="calculate_reward_points"></a>
			<div class="w100 frame">
				<h3 class="heading">calculate_reward_points()</h3>
				
				<p>Returns the number of reward points that would be earnt from a submitted currency value.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>calculate_reward_points(value)</code>
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
							<td>Sets the monetary value to calculate the number of reward points for.</td>
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
							<code>calculate_reward_points(100)</code>
							<small>How many reward points would be earnt from an item costing <?php echo $this->flexi_cart->currency_symbol(TRUE);?>100.00?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->calculate_reward_points(100);?></td>
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