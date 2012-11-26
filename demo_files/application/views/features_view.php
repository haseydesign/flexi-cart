<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Features | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A summary of the features flexi cart has to offer."/> 
	<meta name="keywords" content="features, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="home">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<div class="content_wrap nav_bg">
		<div id="sub_nav_wrap" class="content">
			<ul id="sub_nav">
				<li>
					<a href="<?php echo $base_url; ?>lite_library/features/#feature_list">The Feature List</a>
				</li>
				<li>
					<a href="<?php echo $base_url; ?>lite_library/features/#whats_not_included">What's Not Included</a>
				</li>
			</ul>
		</div>
	</div>
	
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Features of flexi cart</h1>
				<p>flexi cart is a free shopping cart library for use with the <a href="http://ellislab.com" target="_blank">CodeIgniter</a> 2.0+ framework.</p>
				<p>CodeIgniter already includes a basic shopping cart library that allows you to add items to a cart and display it - but sadly, thats about it.</p>
				<p>For anyone trying to build a complete shopping cart store, the native library is just not going to cut it. This is where flexi cart comes to the rescue, offering a plethora of flexible features that can be customised to behave and function the way you need them to.</p>
			</div>		
		</div>
	</div>

	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">

			<a name="feature_list"></a>
			<h3>The Feature List</h3>
			<div class="w100 frame">		
				<h6>Flexibility</h6>
				<div class="frame_note">
					<p>The features in flexi cart are designed to be modularised, so that you can use bits and pieces of different features without needing to setup other features that are not required.</p>
					<p>If you want a cart that can calculate shipping, but don't need a discount system, simply delete the table and disable the feature via the cart config.</p>
					<p>If you want to use the item stock feature, but wish to add and remove the stock yourself, simply change a setting via the cart config.</p>
					<p>The idea of flexi cart is to let you build the site, the way you want it built, rather than being confined to a one path design flow.</p>
				</div>
				
				<h6>Localisation</h6>
				<div class="frame_note">
					<ul class="bullet">
						<li>Locations and zones can be setup to interact with other functions within the cart, and then return data that is relevant to a customers location.</li>
						<li>Unlimited tiers of location types can be set.<br/>
							It could be as basic as just 'Countries', or as specific as 'Countries > States > Cities > Post/Zip Codes > Streets > Door Numbers'.</li>
						<li>Multiple locations can be grouped into zones.</li>
						<li>Individual shipping and tax locations can be set to apply different rules on the customers billing and shipping locations.</li>
					</ul>
				</div>
				
				<h6>Shipping</h6>
				<div class="frame_note">
					<ul class="bullet">
						<li>The availability of shipping options can be set to be dependent on the location the customer is shipping the order to.</li>
						<li>Shipping rate tiers can be set that check the weight and value of the order and adjust the shipping rate accordingly.</li>
						<li>Shipping options can be set with their own tax rate that is independent of the carts global tax rate.</li>
						<li>Specific shipping options can be excluded from any discounts that may be applied to the cart.</li>
					</ul>
				</div>
				
				<h6>Item Shipping Rules</h6>
				<div class="frame_note">
					<ul class="bullet">
						<li>Set shipping rates per item, that can act as free shipping, or as a surcharge that is applied on top of the entire carts shipping rate.</li>
						<li>Define that an item must be shipped separately from other items in the order. The cart will then separately calculate the shipping rate for the item and apply it to the shipping rate of the rest of the items in the cart.</li>
						<li>Items can be banned from being shipped to specific locations.</li>
						<li>Each shipping rule can be set to only activate if the order is being shipped to a specific location.</li>
					</ul>
				</div>
				
				<h6>Tax</h6>
				<div class="frame_note">
					<ul class="bullet">
						<li>Tax rates can be set to be dependent on the location the order is being billed or shipped to.</li>
						<li>Customers can toggle to display prices in the cart between including and excluding tax.</li>
						<li>Items can be set with their own location dependent tax rates.</li>
					</ul>
				</div>
				
				<h6>Discounts</h6>
				<div class="frame_note">
					<ul class="bullet">
						<li>Apply discounts to specific items in the cart or to specific summary columns in the cart.</li>
						<li>Create item groups and apply discounts to all items within the group.</li>
						<li>Define how tax should be applied to individual discounts.</li>
						<li>Create discounts that apply either a percentage, fixed rate or new value discount.</li>
						<li>Activate discounts via either a code or automatically when the discounts minimum quantity and value requirements are reached.</li>
						<li>Create discounts that are only applied if the order is being shipping to a specific location.</li>
						<li>Prevent specific discounts being applied if other discounts are already applied to the cart.</li>
						<li>Prevent customers from earning reward points if they use a specific discount.</li>
						<li>Set start and expiry dates for discounts to be active between.</li>
						<li>Set usage limits per discount.</li>
					</ul>
				</div>
				
				<h6>Reward Points and Vouchers</h6>
				<div class="frame_note">
					<ul class="bullet">
						<li>Reward points can be earnt by customers for purchasing items. The points can then be converted to vouchers which they can use to discount their next order.</li>
						<li>The number of reward points earnt from each item can either be specifically set, or automatically calculated by the cart.</li>
						<li>The monetary worth of earnt reward points are completely configurable.</li>
						<li>Reward points can be set to only become active a preset number of days after an order has been shipped.</li>
						<li>Expiry dates can be set on how long points and vouchers are valid for.</li>
					</ul>
				</div>
				
				<h6>Surcharges</h6>
				<div class="frame_note">
					<ul class="bullet">
						<li>Surcharges can be manually applied to the cart.</li>
						<li>The surcharge value can either be percentage based (add 10%) or a fixed value (add &pound;5)</li>
						<li>Percentage based surcharges can be applied to the value of specific summary columns, rather than just the cart total.</li>
					</ul>
				</div>
				
				<h6>Item Stock Control</h6>
				<div class="frame_note">
					<ul class="bullet">
						<li>Item stock levels can controlled by automatically deducting and returning stock when items are ordered or returned.</li>
						<li>The stock level of specific items can be displayed to customers.</li>
						<li>Low stock and out-of-stock items can automatically have their quantities adjusted or removed from the cart.</li>
					</ul>
				</div>
				
				<h6>Currencies</h6>
				<div class="frame_note">
					<ul class="bullet">
						<li>Unlimited currencies can be set for customers to view site pricing in.</li>
						<li>The display format of each currency can be customised to define the currency symbol, the position of the symbol and the characters used as the 'thousand' and 'decimal' separators.</li>
						<li>The exchange rate of each currency to the carts default currency can be set.</li>
					</ul>
				</div>
				
				<h6>Save Cart Session Data</h6>
				<div class="frame_note">
					<ul class="bullet">
						<li>Customers can save their shopping cart so they can continue shopping at a later time or date, even via a different computer.</li>
					</ul>
				</div>
				
				<h6>Order Management</h6>
				<div class="frame_note">
					<ul class="bullet">
						<li>Easily customise the shopping cart data that is saved as an order.</li>
						<li>Manage the number of items that have been shipped, cancelled or returned on an order.</li>
						<li>Edit saved customer orders as if you are using their shopping cart.</li>
					</ul>
				</div>
				
				<h6>Miscellaneous</h6>
				<div class="frame_note">
					<ul class="bullet">
						<li>Set a required minimum order value.</li>
						<li>Currency conversion tools.</li>
						<li>Weight conversion tools.</li>
						<li>Multilingual custom status and error messages.</li>
					</ul>
				</div>
				
				<h6>Three Different Purpose Libraries</h6>
				<div class="frame_note">
					<p>It's likely that 90% of the pages on your site will not require the complete functionality of flexi cart, which would result in wasting memory resources loading parts of the library that would not be used.</p>
					<p>To solve this, the functionality of flexi cart is split into three different libraries all with a different intended purpose.</p>
					<hr/>
					<ul class="bullet">
						<li>
							The 'lite library' is primarily used to return data from the cart session data, but cannot set data.<br/>
							On its own, it is light enough to include on all pages within your site.
						</li>
						<li>The 'standard library' is used to manage data within the cart session data, inserting items and updating settings.</li>
						<li>The 'admin library' manages the content of flexi carts database and is typically used in the admin 'backend' of a site.</li>
					</ul>
				</div>
			</div>
			
			<h3>What's Not Included</h3>
			<a name="whats_not_included"></a>
			<div class="w100 frame">
				<div class="frame_note">
					<p>Whilst flexi cart offers a huge number of features, it is not intended to be an all-in-one out-of-the-box cart, therefore there are elements that are required by an e-commerce site that are not included in the library.</p>
					<p>To some degree, it can be looked at as a limitation, but it was purposely designed this way to actually maintain its key feature - flexibility.</p>
				</div>
				
				<h6>Item (Product) and Category Tables</h6>
				<div class="frame_note">
					<p>The most obvious missing element is that there are no tables in flexi cart for inserting an items main data into. There are tables for item stock, item shipping and item taxes, but they are all designed to have a many-to-one relationship with a custom item table, i.e. many tax rates can be set to one item.</p>
					<p>The reason there is no item table is that every site tends to be quite specific with the type of data that needs to be stored, this then becomes even more varied depending on how item category and attribute tables are related to the item table.</p>
					<p>Therefore, the design of these elements was kept out of the library and up to the developer.</p>
				</div>
				
				<h6>Connection Settings to Online Payment Gateways</h6>
				<div class="frame_note">
					<p>Whilst flexi cart is perfectly capable of connecting to payment gateways (Paypal etc.), there are no inbuilt functions to do this for you.</p>
					<p>I'll leave this one open for the community to provide.</p>
				</div>
				
				<h6>Connection Settings to Online Shipping Calculators</h6>
				<div class="frame_note">
					<p>Once again, flexi cart is capable of having its shipping values updated via a third party provider (FedEx etc.), however there are no inbuilt functions for this.</p>
					<p>Again, I'll leave this one open for the community to provide.</p>
				</div>
				
				<h6>Location Data</h6>
				<div class="frame_note">
					<p>Whilst flexi cart provides the functionality to set locations to control data within the cart, this data is not provided for you.</p>
				</div>
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