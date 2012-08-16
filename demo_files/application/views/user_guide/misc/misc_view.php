<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="xxx"/> 
	<meta name="keywords" content="xxx"/>
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
				<h2>User Guide | Information</h2>
				<p>A list of miscellaneous information for understanding the inner workings of flexi cart.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
		
			<div class="anchor_nav">
				<p>
					<a href="#admin_data">What is 'Admin Data'?</a> | <a href="#shipped_cancelled_quantities">What are 'Shipped' and 'Cancelled' Item Quantities?</a>
				</p>
			</div>

			<a name="admin_data"></a>
			<div class="w100 frame">
				<h3 class="heading">What is 'Admin Data'?</h3>
				<p>'Admin data' is only active in the carts session array if a cart is loaded into the current session using '<a href="<?php echo $base_url; ?>user_guide/database_cart_data_admin#load_cart_data">load_cart_data()</a>' to retrieve cart data saved to the database; and even then, the functions 'set_admin_data' parameter must be set as 'TRUE'.</p>
				<p>Typically, the 'set_admin_data' parameter would only be set to 'TRUE' if the cart data being loaded is from a saved order, that is to be updated and resaved, e.g. if a customer wishes to change an item quantity from an order they have placed.</p>
				<hr/>
				<p>The purpose of the admin data, is to store the item quantity and discounts of the saved cart data in its original state; this then allows flexi cart to easily refer to the original data once a customer continues adding and removing items to the loaded cart.</p>
				<p>By storing this loaded cart data, flexi cart can keep track of item stock allocation and discount usages, ensuring that if data from a saved order is resaved, that the resaved cart item quantities and discounts usages will not be deducted again from the database, and likewise, if they are removed from the cart before saving the order, their quantities will be returned to stock.</p>
				<p>If the order detail table is setup to track the quantity of items that have been 'shipped' and 'cancelled', then flexi cart will also account for these quantities when allocating stock quantities when the order is resaved.</p>
				<hr/>
				<p>If your e-commerce application does not allow the loading, updating of cart content and then the resaving of a previously saved order, then admin data will not be active in your application.</p>
			</div>

			<a name="shipped_cancelled_quantities"></a>
			<div class="w100 frame">
				<h3 class="heading">What are 'Shipped' and 'Cancelled' Item Quantities?</h3>
				<p>'Shipped' and 'Cancelled' item quantities can be saved and tracked via the order details table. Their purpose is to allow admin users to track how many items from a saved order have been shipped or cancelled/returned by the customer.</p>
				<p>These columns are not required for the cart to function and can be disabled if not required. However, if they are used, then they play an active role in the management of user reward points and stock allocation.</p>
				<hr/>
				
				<h6>Shipped Item Quantities</h6>
				<p>If a saved order item is marked as having 'x' items shipped, then the cart will save the date the item was shipped, this then internally sets a countdown (defined via a config setting) until the associated reward points will become active to the customer.</p>
				<p>The purpose of the countdown is to only activate the reward points once the items return policy date has passed. This prevents customers from purchasing items soley to earn reward points that they can then spend on other items. Once they have bought the other items, they can then return the initially purchased item for a refund.</p>
				<hr/>
				
				<h6>Cancelled Item Quantities</h6>
				<p>If a saved order item is marked as having 'x' items cancelled, then depending on the carts config settings, the cart will automatically return the defined quantity of items to stock. In addition to this, the cart will also remove any reward points that were earnt in association with the cancelled items.</p>
				<p>Note that if a customer converts reward points to a reward voucher, and then the item that earnt those points is cancelled, the cart cannot remove the related reward points as they have already been converted. This is why customer reward points should only be activated outside of the return policy date.</p>
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