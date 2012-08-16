<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A list of live working demos of functions from flexi carts admin library."/> 
	<meta name="keywords" content="admin library, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="admin_dashboard">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Dashboard</h1>
				<p>The 'Admin' library is a complete library of functions to help manage the data within all of flexi carts database tables.</p>
				<p>
					The library primarily consists of a series of CRUD functions that at their most basic act as a simple SQL SELECT query, ranging up to complex functions that can automatically save the entire contents of a shopping cart to the database with the call of just one function.
				</p>
				<p>
					Browse throught the admin demos to view live working examples of the majority of the functions that are available from the admin library.
				</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			
		<?php if (! empty($message)) { ?>
			<div id="message">
				<?php echo $message; ?>
			</div>
		<?php } ?>
				
			<h1>Admin Dashboard</h1>
			<a href="#item">Items</a> | <a href="#orders">Orders</a> | <a href="#locations">Locations</a> | <a href="#locations">Zones</a> | <a href="#shipping">Shipping</a> | <a href="#shipping"> Tax</a> | <a href="#discounts">Discounts</a> | <a href="#reward">Reward Points</a> | <a href="#reward">Reward Vouchers</a> | <a href="#config">Currency</a> | <a href="#config">Order Status</a> | <a href="#config">Configuration</a> | <a href="#config">Defaults</a>

			<div class="w100 frame bullet">			
				<a name="item"></a>
				<h6>Item Management</h6>
				<div class="frame_note">
					<small>
						flexi cart is designed to provide a range of functions that can be used independently of each other to provide essential features to an e-commerce website.<br/>
						Whilst flexi cart takes care of online ordering, shipping rates, tax rates, discounts and currencies, it leaves the database structure for item and category tables completely up to the design of the developer.<br/>
						For the purposes of demonstrating some of flexi carts features, a demo item, and category table have been included that are then linked to some of the cart functions.
					</small>
					<hr/>
					
					<ul>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/items">Manage Items</a>
						</li>
					</ul>
				</div>
					
				<a name="orders"></a>
				<h6>Orders</h6>
				<div class="frame_note">
					<small>View and manage customer orders that have been saved by flexi cart.</small>
					<hr/>
					
					<ul>		
						<li>
							<a href="<?php echo $base_url; ?>admin_library/orders">Manage Orders</a>
						</li>
					</ul>
				</div>
					
				<a name="locations"></a>
				<h6>Locations and Zones</h6>
				<div class="frame_note">
					<small>Locations and zones can be setup that allow custom shipping, tax and discount rules to be created that are then applied depending on the customers location.</small>
					<hr/>
					
					<ul class="spacer_250">
						<li>
							<a href="<?php echo $base_url; ?>admin_library/location_types">Manage Locations</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/insert_location_type">Add New Location Type</a>
						</li>
					</ul>
					<ul class="spacer_250">
						<li>
							<a href="<?php echo $base_url; ?>admin_library/zones">Manage Zones</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/insert_zone">Add New Zone</a>
						</li>
					</ul>
					<ul class="spacer_250">
						<li>
							<a href="<?php echo $base_url; ?>admin_library/demo_location_menus">Location Menu Demos</a>
						</li>
					</ul>
				</div>
					
				<a name="shipping"></a>
				<h6>Shipping and Taxes</h6>
				<div class="frame_note">
					<small>Shipping options and taxes can be setup to return an appropriate shipping and tax rate depending on the customers location.<br/> In addition, individual items can have specific shipping and tax rates applied to them.</small>
					<hr/>
					
					<ul class="spacer_250">
						<li>
							<a href="<?php echo $base_url; ?>admin_library/shipping">Manage Shipping Options</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/insert_shipping">Add New Shipping Option</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/items">Add New Item Shipping Rule</a>
						</li>
					</ul>
					<ul class="spacer_250">
						<li>
							<a href="<?php echo $base_url; ?>admin_library/tax">Manage Taxes</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/insert_tax">Add New Tax</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/items">Add New Item Tax Rate</a>
						</li>
					</ul>
				</div>
					
				<a name="discounts"></a>
				<h6>Discounts</h6>
				<div class="frame_note">
					<small>Discounts can be setup with a wide range of rule conditions.<br/> The discounts can then be applied to specific items, groups of items or can be applied across the entire cart.</small>
					<hr/>
					
					<ul class="spacer_250">
						<li>
							<a href="<?php echo $base_url; ?>admin_library/item_discounts">Manage Item Discounts</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/summary_discounts">Manage Summary Discounts</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/insert_discount">Add New Discount</a>
						</li>
					</ul>
					<ul class="spacer_250">
						<li>
							<a href="<?php echo $base_url; ?>admin_library/discount_groups">Manage Discount Groups</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/insert_discount_group">Add New Discount Group</a>					
						</li>
					</ul>			
				</div>
					
				<a name="reward"></a>
				<h6>Reward Points and Vouchers</h6>
				<div class="frame_note">
					<small>Customers can earn reward points when purchasing cart items. The reward points can then be converted to vouchers that can be used to buy other items.</small>
					<hr/>
					
					<ul class="spacer_250">
						<li>
							<a href="<?php echo $base_url; ?>admin_library/user_reward_points">Manage User Reward Points</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/vouchers">Manage User Reward Vouchers</a>
						</li>
					</ul>
				</div>
					
				<a name="config"></a>
				<h6>Currency, Order Status and Cart Configuration</h6>
				<div class="frame_note">
					<small>Many configuration options within the cart can be set via the database, eliminating the need to update settings via a config file.</small>
					<hr/>
					
					<ul class="spacer_250">
						<li>
							<a href="<?php echo $base_url; ?>admin_library/currency">Manage Currencies</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/insert_currency">Add New Currency</a>
						</li>
					</ul>
					<ul class="spacer_250">
						<li>
							<a href="<?php echo $base_url; ?>admin_library/order_status">Manage Order Statuses</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/insert_order_status">Add New Order Status</a>
						</li>
					</ul>			
					<ul class="spacer_250">
						<li>
							<a href="<?php echo $base_url; ?>admin_library/config">Manage Cart Configuration</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/defaults">Manage Cart Defaults</a>
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