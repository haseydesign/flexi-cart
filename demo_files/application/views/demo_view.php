<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>About the Demo | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A summary on the purposes of the flexi cart demo."/> 
	<meta name="keywords" content="demo, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="lite_library">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>About the flexi cart Demo</h1>			
				<p>This demo is intended to demonstrate the majority of all the functions that are available in flexi cart.</p>
				<p>All these demo files are available for <a href="https://github.com/haseydesign/flexi-cart">download</a> so that you can see and play with the code behind the working examples.</p>
			</div>		
		</div>
	</div>

	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content main_content_bg parallel clearfix">
				
			<div class="w66 frame parallel_target">				
				<h4>Layout of the demo</h4>
				<div class="frame_note">
					<p>The layout of the demo is broken down into two main sections.</p>
					<p>The first section represents the 'public' area of a site containing a working shopping cart with item and cart feature examples that can be applied to the cart to test the functionality.</p>
					<p>The second section contains an example 'admin backend' of an e-commerce site that can be used to manage all of the carts settings.</p>					
				</div>
			
				<h4>Live data</h4>			
				<div class="frame_note">				
					<p>The data within the demo is 'live' and any changes that are made will directly affect the cart, so bare it in mind that other users may also be using the cart and also changing settings themselves.</p>
					<p>The best way to ensure the intended user experience when using the demo, is to download the demo files and use them via your local setup.</p>
					<p>All data within the website demo example is periodically reset after a few hours.</p>
				</div>
				
				<h4>How to get started</h4>			
				<div class="frame_note">				
					<p>Simply view one of the 'Item Example' pages via the header navigation menu and add one of the items to the cart.</p>
					<p>When you've had a good experimentation with the 'public' section of the site, try completing an order and then head on over to the 'admin library' to manage the backend of the site.</p>
					<p>Go and get playing!</p>
				</div>
			</div>

			<div class="w33 r_margin frame parallel_target">
				<h6>Item Examples</h6>
				<small>Examples of features that can be applied to items added to the cart.</small>
				<ul class="bullet">
					<li>
						<a href="<?php echo $base_url; ?>lite_library/item_link_examples">Add Items to Cart via a Link</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>lite_library/item_form_examples">Add Items to Cart via a Form</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>lite_library/item_ajax_examples">Add Items to Cart via Ajax</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>lite_library/item_discount_examples">Add Discount Items to Cart</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>lite_library/item_database_examples">Add Database Items to Cart</a>
					</li>
				</ul>
				<hr/>
				
				<h6>Feature Examples</h6>
				<small>Examples of some of the features that are available in flexi cart.</small>
				<ul class="bullet">
					<li>
						<a href="<?php echo $base_url; ?>standard_library/load_save_cart_data">Save / Load Cart Data</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>lite_library/discount_surcharge_features">Discounts / Surcharges</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>standard_library/misc_features">Miscellaneous Features</a>
					</li>
				</ul>
				<hr/>

				<h6>Library Examples</h6>
				<small>Examples of some of the features available in each of the three libraries.</small>
				<ul class="bullet">
					<li>
						<a href="<?php echo $base_url; ?>lite_library/lite_library_example">Lite Library</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>standard_library/view_cart">Standard Library</a>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>admin_library">Admin Library</a>
					</li>
				</ul>
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