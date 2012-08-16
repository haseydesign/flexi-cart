<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Cart Checkout Complete | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of a 'checkout complete' page."/> 
	<meta name="keywords" content="checkout complete, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="checkout">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h2>Cart Checkout Complete</h2>
				<p>Once the customer enters their billing and shipping details, many sites will then redirect the customer to a third party online payment processor to handle payment card details (This demo has skipped this step).</p>
				<p>The payment processor will then store all the sensitive data on their own servers and redirect the customer back to the original website. When redirecting the customer, additional data regarding the payment status is also passed back to the site that can then be saved with the order details.</p>
				<p>This page includes a simple example of updating the status of the order and then sending the customer an email confirmation.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">

			<fieldset>
				<legend>Order Reference Details</legend>
				
				<ul>
					<li>
						<h3>Your shopping cart order has been successfully saved!</h3>
					</li>
					<li>
						<h4>Order Number: <?php echo $order_number; ?></h4>
					</li>
					<li>
						<p>With a real world cart, an email order acknowledgement would now be sent to <?php echo $user_email; ?>.</p>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>standard_library/">Return to flexi cart</a>
					</li>
				</ul>
			</fieldset>

		</div>
	</div>
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>