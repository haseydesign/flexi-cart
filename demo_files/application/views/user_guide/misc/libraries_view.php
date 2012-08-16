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
				<h1>User Guide | Libraries</h1>
				<p>flexi cart is split into three different libraries each with their own individual purpose.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			
			<div class="anchor_nav">
				<h6>Libraries</h6>
				<p>
					<a href="#lite_library">Lite Library</a> | <a href="#standard_library">Standard Library</a> | <a href="#admin_library">Admin Library</a>
				</p>
			</div>

			<a name="lite_library"></a>
			<div class="w100 frame">
				<h3 class="heading">Lite Library</h3>

				<p>The lite library contains functions that typically read data from the cart session or database, and barring status and error messages, it does not set any data to the cart session or database.</p>
				<p>It is called the 'lite' library as it used by both the standard and admin libraries, but to save memory usage, can be instantiated by itself for pages that do not need the functionality of the standard or admin libraries.</p>
				<p>When loaded by itself, it typically uses approximately 800kb of memory which is around 60% lighter than when loaded together with the standard and admin libraries.</p>
				<p>The typical functions available from the lite library can return any data that is set in the cart session data, this includes cart item data, cart summary data, localisation and configuration data.</p>
				<hr/>
				
				<h6>Examples</h6>
<pre>
<span class="comment bold">// Loading the lite library.</span>

$this->load->library('flexi_cart_lite');
</pre>
<pre>
<span class="comment bold">// Loading the lite library using a different object name.</span>

<span class="comment">// When loading the lite library, it may be more convenient to rename the library object, 
// for example to 'flexi_cart' or 'flexi_cart_admin'.</span>

$this->load->library('flexi_cart_lite', FALSE, 'flexi_cart');
</pre>
			</div>

			<a name="standard_library"></a>
			<div class="w100 frame">
				<h3 class="heading">Standard Library</h3>
				
				<p>The standard library contains the core functionality of the cart, with functions to insert and update items to the cart, and update the localisation and configuration settings.</p>
				<p>The standard library automatically loads the lite library when instantiated, so all functions that are available in the lite library, are also available when the standard library has been loaded.</p>
				<p>When loaded, the standard library typically uses approximately 1800kb of memory. To minimize the memory usage on the server, it is recommended that the standard library should only be loaded on pages that are actively setting data to the cart, like the actual cart management page. For all other pages that do not need to set data, either use the lite library to still access cart data, or do not load a library at all; the cart session data is not lost if a library is not loaded.</p>
				<p>Note: Unlike with the lite library, do NOT rename the library object to any other name when loading this library as it will cause conflicts in some internal functions.</p>
				<hr/>
				
				<h6>Examples</h6>
<pre>
<span class="comment bold">// Loading the standard library.</span>

$this->load->library('flexi_cart');
</pre>
			</div>

			<a name="admin_library"></a>
			<div class="w100 frame">
				<h3 class="heading">Admin Library</h3>

				<p>The admin library contains a variation of SQL CRUD style functions and helper functions to manage data within the cart database tables.</p>
				<p>Like the standard library, the admin library automatically loads the lite library when instantiated, meaning that all the functions in the lite library are also available when the admin library has been loaded.</p>
				<p>The admin library uses approximately 1800kb of memory when loaded, and other than the save order and database cart data functions, the library would typically only need to be used in the back-end of the e-commerce site, to help admins manage the functionality of the cart.</p>
				<p>Note: Unlike with the lite library, do NOT rename the library object to any other name when loading this library as it will cause conflicts in some internal functions.</p>
				<hr/>
				
				<h6>Examples</h6>
<pre>
<span class="comment bold">// Loading the admin library.</span>

$this->load->library('flexi_cart_admin');
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