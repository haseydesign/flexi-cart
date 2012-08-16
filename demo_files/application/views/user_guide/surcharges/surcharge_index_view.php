<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Surcharge Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of surcharge functions in flexi cart."/> 
	<meta name="keywords" content="surcharge functions, user guide, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="user_guide_index">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- User Guide Navigation -->
	<?php $this->load->view('includes/user_guide_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>User Guide | Surcharges</h1>
				<p>Surcharges can be set to apply miscellaneous charges to a cart. The charges can be for anything from creditcard charges to charity donations.</p>
				<p>Below is a compiled list of functions related to cart surcharge data.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Surcharge User Guide Index</h2>				
			<a href="<?php echo $base_url; ?>user_guide/surcharge_session_data">Get Surcharge Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/surcharge_set_data">Set Surcharge Session Data</a><br/>
			
			<div class="w50 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the carts session.</small>
				<hr/>
				
				<h6>Surcharge Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/surcharge_session_data#surcharge_status">surcharge_status()</a><br/>
						<small>Return whether a surcharge has been applied to the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/surcharge_session_data#surcharge_data">surcharge_data()</a><br/>
						<small>Returns surcharge values and descriptions formatted as an array.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/surcharge_session_data#surcharge_description">surcharge_description()</a><br/>
						<small>Returns surcharge values and descriptions formatted as a string.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w50 r_margin frame parallel_target">
				<h3>Setting Data</h3>
				<small>Set data to the carts session data.</small>
				<hr/>
				
				<h6>Surcharge Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/surcharge_set_data#set_surcharge">set_surcharge()</a><br/>
						<small>Set cart summary surcharges, using manually submitted values.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/surcharge_set_data#unset_surcharge">unset_surcharge()</a><br/>
						<small>Remove specific surcharges applied to the cart.</small>
					</li>
				</ul>
				<hr/>
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