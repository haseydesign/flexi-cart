<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Discount and Surcharge Examples | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts manual discount and manual surcharge functions."/> 
	<meta name="keywords" content="discounts, surcharges, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="feature_examples">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h2>Manual Discount / Surcharge Examples</h2>
				<p>Many of flexi carts most powerful features require data to be retrieved from database tables, however, for some smaller sites, this may seem as overkill, and so flexi cart allows many of the features requiring a database to be disabled so that a custom method can be used instead.</p>
				<p>If the <a href="<?php echo $base_url; ?>lite_library/item_discount_examples">discount tables</a> are disabled (and even if they are not), flexi cart allows discounts and surcharges to be manually applied to the cart by using just a few hard coded values submitted to a function.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">

			<div class="w100 frame">
				<h3>Discounts</h3>
				<div class="frame_note">
					<small>
						Manual discounts can be applied to the carts item summary total (Total of items only), the carts shipping rate and the carts grand total.<br/>
						The discounts can be either percentage based (10% off), fixed value (&pound;5 off) or for shipping rates only, a new value (Was &pound;10, now &pound;7.50). 
					</small>
					<hr/>
					<ul class="bullet">
						<li>
							<a href="<?php echo $base_url; ?>standard_library/set_discount/1">&pound;5 Discount to Cart Total</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/set_discount/2">10% Discount to Item Total</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/set_discount/3">Free Shipping (UK Only)</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/unset_discount">Remove Manual Discounts</a>
						</li>
					</ul>
				</div>
				
				<h3>Surcharges</h3>
				<div class="frame_note">
					<small>
						Surcharges can be applied as either percentage based (add 10%) or fixed value (add &pound;5) surcharges.<br/>
						Fixed rate surcharges are only applied to the carts total, whilst percentage based surcharges can be applied to either the item summary total (Total of items only), the carts shipping rate or the carts grand total.<br/>
						Surcharges can only be set manually as there is no database version of the feature.				
					</small>
					<hr/>
					<ul class="bullet">
						<li>
							<a href="<?php echo $base_url; ?>standard_library/set_surcharge/1">&pound;5 Surcharge to Cart Total</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/set_surcharge/2">2% Surcharge to Item Total</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/set_surcharge/3">Gift Wrap for &pound;10</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/set_surcharge/4">3.5% Credit Card Surcharge</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/unset_surcharge">Remove All Surcharges</a>
						</li>
					</ul>		
				</div>
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