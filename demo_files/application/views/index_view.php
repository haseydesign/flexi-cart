<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="flexi cart, the shopping cart library designed for developers."/> 
	<meta name="keywords" content="flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="home">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Intro Content -->
	<div class="content_wrap nav_bg main_banner">
		<div class="content clearfix">
			<img src="<?php echo $includes_dir;?>images/flexi_cart_traffic_sign.png" class="main_banner_img"/>		
			<div id="banner_wrap" class="w66 float_r align_ctr">
				<h1>flexi cart, the customisable toolkit for building e-commerce shopping carts.</h1>
				<a href="<?php echo $base_url; ?>user_guide">
					<img src="<?php echo $includes_dir; ?>images/user_guide_icon.png"/>
					<p>User Guide</p>
				</a>
				<a href="<?php echo $base_url; ?>lite_library/demo">
					<img src="<?php echo $includes_dir; ?>images/demo_icon.png"/>
					<p>Try the Demo</p>
				</a>
				<a href="https://github.com/haseydesign/flexi-cart">
					<img src="<?php echo $includes_dir; ?>images/download_icon.png"/>
					<p>Download</p>
				</a>
			</div>		
		</div>
	</div>
	
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<h2>The latest news on flexi cart</h2>
			<p>flexi cart 1.1 has been released including new language files, library message functionality and ajax demos.</p>
		</div>
	</div>

	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
		
			<div class="w100 frame">
				<h3>What is flexi cart?</h3>
				<p>flexi cart is a free open source shopping cart library for use with the <a href="http://ellislab.com" target="_blank">CodeIgniter</a> 2.0+ framework.</p>
				<p>It is designed with modularised features that can be mixed and matched, turned on or off, and can be customised to suit your requirements.</p>
				<hr style="margin-top:10px; margin-bottom:10px; border:none; border-top:1px dotted #999;"/>
				<h3>What is flexi cart not?</h3>			
				<p>flexi cart is not an all-in-one out-of-the-box e-commerce solution.</p>
				<p>All-in-one solutions can be good, but unless you are familiar on their inner workings, they can be tricky to customise to specific requirements.</p>
				<p>flexi cart does not provide the store for you, it simply provides you with the tools to wire the site how you require.</p>
			</div>
			
			<div class="w100 frame">
				<h2>Help and Support</h2>
				
				<p>The best place to start for help is by having look through the the in depth <a href="<?php echo $base_url; ?>user_guide">user guide</a>, which contains an installation guide and detailed information on each function that is available from the flexi cart libraries.</p>
				<hr/>
				
				<p>If there is a feature available in flexi cart that you wish to implement on your site, then there is most likely a working demo example of how to implement the feature.</p>
				<p>Have a browse through the <a href="<?php echo $base_url; ?>lite_library/demo">demo</a> and see if there is a example of what you are trying to achieve.</p>
				<p>If you find an example of what you're after, then open up the <a href="https://github.com/haseydesign/flexi-cart">downloadable</a> demo files and have a look at the underlying code.</p>
				<hr/>
				
				<p>Still stuck? Contact me via the CodeIgniter flexi cart forum thread <a href="http://ellislab.com/forums/viewthread/212926">http://ellislab.com/forums/viewthread/212926</a></p>
			</div>
			
		</div>
	</div>
</div>

<!-- Footer -->  
<?php $this->load->view('includes/footer'); ?> 

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>