<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Link Examples | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of inserting items to the cart via a link."/> 
	<meta name="keywords" content="insert items, link, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="item_links">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h2>Add Item to Cart Examples</h2>
				<p>Items can be added to the cart using either data hard coded into a model file or data retrieved from a <a href="<?php echo $base_url; ?>lite_library/item_form_examples">html form</a> or a <a href="<?php echo $base_url; ?>lite_library/item_database_examples">database query</a>.</p>
				<p>This demo page shows many of the features and options that can be set when adding an item to the cart.<br/>
				For simplicity and clarity, the items in these examples are added to the cart using links related to data that is hard coded into a model file.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">

			<h2>Item Link Examples</h2>
			<a href="<?php echo $base_url; ?>lite_library/item_form_examples">Item Form Examples</a> |
			<a href="<?php echo $base_url; ?>lite_library/item_ajax_examples">Item Ajax Examples </a> |
			<a href="<?php echo $base_url; ?>lite_library/item_discount_examples">Item Discount Examples</a> |
			<a href="<?php echo $base_url; ?>lite_library/item_database_examples">Item Database Examples</a> 
		
			<div class="w100 frame bullet">
				<h5>Basics</h5>
				<div class="frame_note">
					<ul>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/101">Example #101</a> : Add 1 item with minimum required data.
							<small>An example of the minimum data requirements to add an item to the cart.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/102">Example #102</a> : Add multiple items at once with 1 link.
							<small>Multiple items can be added to the cart at the same time.</small>
						</li>
					</ul>
				</div>
				
				<h5>Shipping Examples</h5>
				<div class="frame_note">
					<ul>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/103">Example #103</a> : Add an item with free shipping.
							<small>Items can be added to the cart with free shipping.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/104">Example #104</a> : Add an item with free shipping to the UK only.
							<small>Item shipping rates can be defined to only apply when shipped to specific locations.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/105">Example #105</a> : Add an item with a shipping surcharge.
							<small>Items can be defined to add a surcharge to the carts shipping rate, as above, this can be set by location.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/106">Example #106</a> : Add an item that will be shipped separately from the rest of the cart.
							<small>Items can be shipped separately from the rest of the cart, the items shipping cost is added to the carts shipping rate.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/107">Example #107</a> : Add an item that CAN ONLY be shipping to a specific location(s) (United Kingdom).
							<small>Items can be added to a '<strong>Whitelist</strong>' of locations that the item <strong>is</strong> allowed to be shipped to.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/108">Example #108</a> : Add an item that CANNOT be shipped to a specific location(s) (United Kingdom or France).
							<small>Items can be added to a '<strong>Blacklist</strong>' of locations that the item <strong>is not</strong> allowed to be shipped to.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/109">Example #109</a> : Add an item with a defined weight that can be used to calculate shipping.
							<small>A tier of shipping options can be setup to charge a different shipping rate for different weight orders.</small>
						</li>
					</ul>
				</div>
				
				<h5>Tax Examples</h5>
				<div class="frame_note">
					<ul>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/110">Example #110</a> : Add a tax free item.
							<small>Items can be set with a defined tax rate that differs from the default cart tax rate.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/111">Example #111</a> : Add an item with a specified tax rate.
							<small>Items can be set with a defined tax rate that differs from the default cart tax rate.</small>
						</li>
					</ul>
				</div>
				
				<h5>Stock Examples</h5>
				<div class="frame_note">
					<ul>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/112">Example #112</a> : Add an item that is stock controlled and is in-stock.
							<small>If a quantity of more than the stock quantity is added, the quantity can be set to be automatically adjusted.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/113">Example #113</a> : Add an item that is stock controlled and is out-of-stock.
							<small>Out-of-stock items can be set to be automatically removed from the cart, or display a message stating the item is out-of-stock.</small>
						</li>
					</ul>
				</div>
				
				<h5>Misc. Examples</h5>
				<div class="frame_note">
					<ul>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/114">Example #114</a> : Add an item with a specified number of reward points.
							<small>Customers can earn reward points from buying items, points can either be specifically defined or calculated by the cart.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/115">Example #115</a> : Add an item with preset options.
							<small>Items can be added with options set, with this example, the options are preset.<br/> See the <a href="<?php echo $base_url; ?>lite_library/item_form_examples">Item Form Examples</a> for examples of adding items with selectable options.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/116">Example #116</a> : Add an item with misc. data fields, in this example: a 'User Note' and an 'SKU'.
							<small>Custom user defined data can be added to items, this data can then be displayed and saved with the cart order.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_link_item_to_cart/117">Example #117</a> : Add an item that is given its own unique row everytime its re-added to the cart.
							<small>Duplicate items added to the cart can either increment the items quantity, or be added as a separate row.</small>
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