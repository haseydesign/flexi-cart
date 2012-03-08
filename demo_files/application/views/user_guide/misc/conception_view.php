<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Libraries | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for flexi carts libraries."/> 
	<meta name="keywords" content="library, libraries, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | flexi cart conception</h1>
				<p>The principle ideas of how flexi cart works and how to use its 'flexible' features.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			
			<div class="anchor_nav">
				<h6>Conception</h6>
				<p>
					<a href="#conception">The flexi cart Conception</a> | <a href="#structure">Library File Structure</a>
				</p>
			</div>

			<a name="conception"></a>
			<div class="w100 frame">
				<h3 class="heading">The flexi cart Conception</h3>
				<p>The purpose of the flexi cart library is to offer modularised shopping cart features, that allow a developer to pick and choose which features they require, without having to include features that are surplus to the clients requirements.</p>
				<p>flexi cart is flexible enough to be used to create simple 10 item ecommerce stores, up to huge online stores rivalling the functionality of ecommerce giants like Magento, Opencart and X-cart. The tools are provided, you just have to put them together.</p>
				<p>What flexi cart is not, is an all-in-one out-of-the-box e-commerce solution, you still need to build the structure of the site, flexi cart just adds the ecommerce functionality to that structure. If you build the house, it will do the wiring.</p>
			</div>

			<a name="structure"></a>
			<div class="w100 frame">
				<h3 class="heading">Library File Structure</h3>

				<p>The complete flexi cart library is controlled via several files, a config file, 3 library files, 3 model files and language files.</p>
				<ul>
					<li>The config file as you would expect controls the entire configuration of flexi cart, defining cart column names, database tables and cart behaviour settings.</li>
					<li>
						The library and model files are separated into 3 operational tasks, offering a 'lite', 'standard' and 'admin' set of tools.
						<ul>
							<li>The 'lite' library typically reads data from the cart session or database. It is not used to save data.</li>
							<li>The 'standard' library is primarily used to manage the items and settings of the cart, adding/removing items and updating cart localisation settings based on a users location.</li>
							<li>The 'admin' library contains a variety of helper and SQL CRUD functions to manage data within the cart database tables.</li>
						</ul>
						Read the <a href="<?php echo $base_url; ?>user_guide/library_info">library documentation</a> for further information on flexi carts library files.
					</li>
					<li>The language files (Only English at launch) are used to translate cart status and error messages based on a users location.</li>
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