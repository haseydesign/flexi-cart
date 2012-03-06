<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Shipping Session Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for shipping session data functions in flexi cart."/> 
	<meta name="keywords" content="shipping session data functions, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Getting Shipping Session Data</h1>
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
						
			<h2>Get Shipping Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/shipping_index">Shipping Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_config">Shipping Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_helper_data">Get Shipping Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_set_data">Set Shipping Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/shipping_admin">Shipping Admin Data</a>

			<div class="anchor_nav">
				<h6>Get Shipping Data from Session</h6>
				<p>
					<a href="#shipping_id">shipping_id()</a> | <a href="#shipping_name">shipping_name()</a> | <a href="#shipping_description">shipping_description()</a>
				</p>
				<h6>Get Shipping Location Data from Session</h6>
				<p>
					<a href="<?php echo $base_url; ?>user_guide/location_session_data#shipping_location_data">shipping_location_data()</a> | 
					<a href="<?php echo $base_url; ?>user_guide/location_session_data#match_shipping_location_id">match_shipping_location_id()</a> | 
					<a href="<?php echo $base_url; ?>user_guide/location_session_data#shipping_location_id">shipping_location_id()</a> | 
					<a href="<?php echo $base_url; ?>user_guide/location_session_data#shipping_location_name">shipping_location_name()</a> | 
					<a href="<?php echo $base_url; ?>user_guide/location_session_data#location_shipping_status">location_shipping_status()</a>
				</p>
			</div>
				
			<a name="shipping_id"></a>
			<div class="w100 frame">
				<h3 class="heading">shipping_id()</h3>
				
				<p>Returns the current shipping option id.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>int</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>shipping_id()</code>
							<small>What is the id of the current shipping option?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->shipping_id();?></td>
					</tr>
				</table>
			</div>
			
			<a name="shipping_name"></a>
			<div class="w100 frame">
				<h3 class="heading">shipping_name()</h3>
				
				<p>Returns the current shipping option name.</p>
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
							<code>shipping_name()</code>
							<small>What is the name of the current shipping option?</small>						
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->shipping_name();?></td>
					</tr>
				</table>
			</div>
			
			<a name="shipping_description"></a>
			<div class="w100 frame">
				<h3 class="heading">shipping_description()</h3>
				
				<p>Returns the current shipping option description.</p>
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
							<code>shipping_description()</code>
							<small>What is the description of the current shipping option?</small>						
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->shipping_description();?></td>
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