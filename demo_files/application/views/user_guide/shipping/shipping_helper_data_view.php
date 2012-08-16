<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Shipping Helper Data | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for shipping helper functions in flexi cart."/> 
	<meta name="keywords" content="shipping helper data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Shipping Helper Data</h1>
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
						
			<h2>Shipping Helper Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/shipping_index">Shipping Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_config">Shipping Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_session_data">Get Shipping Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_set_data">Set Shipping Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_admin">Shipping Admin Data</a>
			
			<div class="anchor_nav">
				<h6>Get Shipping Data from Database</h6>
				<p>
					<a href="#get_shipping_options">get_shipping_options()</a>
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

			<a name="get_shipping_options"></a>
			<div class="w100 frame">
				<h3 class="heading">get_shipping_options()</h3>
				
				<p>Looks-up the shipping tables and returns an array of available shipping options.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Requires the shipping database tables to be enabled.</p>
				</div>				
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function queries the shipping tables for all shipping options that match the carts current shipping location, and that have a shipping rate tier that matches the current weight and total value of the cart.</p>
					<p>The returned array of shipping options can then typically be used to populate a html form element (i.e. select, radio etc).</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set if a required table/feature is disabled.</p>
					<p><strong class="spacer_100">Success:</strong>multi-dimensional array</p>
				</div>
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->get_shipping_options();

<span class="comment">// Produces a multi-dimensional array like:
Array
(
[0] => Array
	(
		[id] => 1
		[name] => UK Standard Shipping
		[description] => 2-3 Days
		[value] => 3.95
		[tax_rate] => 
	)
[1] => Array
	(
		[id] => 2
		[name] => UK Recorded Shipping
		[description] => 2-3 Days
		[value] => 5.10
		[tax_rate] => 
	)
)</span>
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