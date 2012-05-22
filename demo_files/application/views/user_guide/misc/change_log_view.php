<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Change Log | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="Change log of all versions of flexi cart."/> 
	<meta name="keywords" content="change log, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Change Log</h1>
				<p>All changes that have been made between each new version of flexi cart.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			
			<div class="w100 frame">
				<h3 class="heading">Version Beta 1.0.1</h3>
				<h6>Release Date 22nd May 2012</h6>
				<hr/>
				<ul>
					<li>
						<h6>Added 'Italian', 'French', 'German', and 'Spanish' language files.</h6>
						<p>The new language files can be located at 'application/language/[LANGUAGE]/flexi_cart_lang.php'.</p>
						<p>
							The Italian language file has been kindly translated by koichirose.<br/>
							The other language files are currently translations using Google Translate, so beware they may contain misinterpretations.
						</p>
						<p>See <a href="<?php echo $base_url; ?>user_guide/cart_config_internal#language">this updated help guide page</a> for details on defining a specific language file.</p>
					</li>
					<li>
						<h6>Updated the functionality of the libraries message functions.</h6>
						<p>The libraries message functions have been improved so that messages set internally via the library (e.g. When adding an item to the cart), can be defined to be shown to either 'Public' or 'Admin' users, <span class="uline">or to not be shown at all</span>.</p>
						<p>This functionality has been defined via the libraries config. file and can be found via the <code>$config['messages']['target_user']</code> settings.</p>
						<hr/>
						<p>For further clarity, when using the libraries functions to set and return status and error messages, each message function now requires that either 'public' or 'admin' is defined as the 'target_user'.</p>
						<p>The functions affected by this update are: <code>status_messages()</code>, <code>set_status_message()</code>, <code>error_messages()</code>, <code>set_error_message()</code>, <code>get_messages_array()</code> and <code>get_messages()</code></p>
						<p>The <a href="<?php echo $base_url; ?>user_guide/cart_set_data">user guide</a> has been updated to reflect these changes.</p>
					</li>
				</ul>
			</div>
			
			<div class="w100 frame">
				<h3 class="heading">Version Beta 1.0</h3>
				<h6>Release Date 1st January 2012</h6>
				<hr/>
				<ul>
					<li>First publicly released version.</li>
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