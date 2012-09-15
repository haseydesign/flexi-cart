<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Discount Examples | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of inserting discounted items to the cart."/> 
	<meta name="keywords" content="insert items, item discounts, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="item_discounts">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h2>Item Discount Examples</h2>
				<p>Offering customers discounts is a very strong sales technique for luring customers to a website and making purchases they otherwise wouldn't make.</p>
				<p>The complexities of discount requirements can range from the simple <em>'Buy item x @ 10% off'</em> to the more complex <em>'Buy 3 items from x, y or z for 10% off the cheapest item for only the first 100 new customers from the UK and expires by midnight'</em>.</p>
				<p>The discount options within flexi cart allow for even far more complicated combinations than the second example and can be configured in seconds.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">

			<h2>Item Discount Examples</h2>
			<a href="<?php echo $base_url; ?>lite_library/item_link_examples">Item Link Examples</a> |
			<a href="<?php echo $base_url; ?>lite_library/item_form_examples">Item Form Examples</a> |
			<a href="<?php echo $base_url; ?>lite_library/item_ajax_examples">Item Ajax Examples </a> |
			<a href="<?php echo $base_url; ?>lite_library/item_database_examples">Item Database Examples</a>

			<div class="w100 frame">
				<h5>Basic Discounts</h5>
				<div class="frame_note">
					<ul>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/301">Example #301</a> : 10% off original price.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/302">Example #302</a> : Fixed price of <?php echo $this->flexi_cart->get_taxed_currency_value(5);?> off original price of <?php echo $this->flexi_cart->get_taxed_currency_value(12.5);?>.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/303">Example #303</a> : New price of <?php echo $this->flexi_cart->get_taxed_currency_value(15);?>, item was <?php echo $this->flexi_cart->get_taxed_currency_value(25);?>.</li>
					</ul>
				</div>
				
				<h5>Quantity Based Discounts</h5>
				<div class="frame_note">
					<small>Note: For the purposes of these examples, quantity discounts will be added to the cart with a quantity of 1, once added, increase the quantity to activate the discount.<br/>Example: A 'Buy 1, get 1 free' discount requires a quantity of 2 to be added to the cart.</small>
					<hr/>
					<ul>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/304">Example #304</a> : Buy 2, get 1 free. <small class="inline">(Add 3 to activate discount)</small></li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/305">Example #305</a> : Buy 1, get 1 @ 50% off. <small class="inline">(Add 2 to activate discount)</small></li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/306">Example #306</a> : Buy 2 @ <?php echo $this->flexi_cart->get_taxed_currency_value(15);?>, get 1 with <?php echo $this->flexi_cart->get_taxed_currency_value(5);?> off. <small class="inline">(Add 3 to activate discount)</small></li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/307">Example #307</a> : Buy 5 @ <?php echo $this->flexi_cart->get_taxed_currency_value(10);?>, get 2 for  <?php echo $this->flexi_cart->get_taxed_currency_value(7);?>. <small class="inline">(Add 7 to activate discount)</small></li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/308">Example #308</a> : Buy 3, get free UK shipping on these items. <small class="inline">(Add 3 to activate discount)</small></li>
					</ul>
				</div>
				
				<h5>Value Based Discounts</h5>
				<div class="frame_note">
					<small>Note: For the purposes of these examples, value based discounts will be added to the cart with a total value under the discount value required, once the item is added, increase the quantity to activate the discount.</small>
					<hr/>
					<ul>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/309">Example #309</a> : Spend over <?php echo $this->flexi_cart->get_taxed_currency_value(75);?> on this item, get 10% off this items total.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/310">Example #310</a> : Spend over <?php echo $this->flexi_cart->get_taxed_currency_value(100);?> on this item, get <?php echo $this->flexi_cart->get_taxed_currency_value(10);?> off this items total.</li>						
					</ul>
				</div>
				
				<h5>Grouped Item Discounts</h5>
				<div class="frame_note">
					<small>
						The following items are all grouped together for the same discount, if enough items from the discount group are added, the discount is applied.<br/>
						Note: Discounts are always applied to the cheapest items first.
					</small>
					<hr/>
					<ul>					
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/311">Example #311</a> : Item A, group discount - buy 3, get cheapest item free.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/312">Example #312</a> : Item B, group discount - buy 3, get cheapest item free.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/313">Example #313</a> : Item C, group discount - buy 3, get cheapest item free.</li>
					</ul>
				</div>
				
				<h5>Miscellaneous Discount Rules</h5>
				<div class="frame_note">
					<ul>						
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/314">Example #314</a> : 10% off original price - but for logged in users only (Toggle "User Status" via <a href="<?php echo $base_url; ?>standard_library/misc_features">Misc. Feature Examples Page</a>).</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/315">Example #315</a> : 10% off original price - but removes the items reward points.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/316">Example #316</a> : 10% off original price - but applies to 1 item quantity only (Non recursive quantity discount).</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/317">Example #317</a> : 10% off original price - but applies to orders being shipped to the UK only.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/318">Example #318</a> : 10% off original price - but cannot be applied if other discounts exist.</li>
					</ul>
				</div>
				
				<h5>Summary Discounts</h5>
				<div class="frame_note">
					<small>
						Two example summary discounts have been set in this demo.<br/>
						Further discounts can be added live to this demo via the <a href="<?php echo $base_url; ?>admin_library">Admin Library</a>.<br/>
						Summary discounts can be applied to the carts item summary total (Total of items only), the carts shipping rate and the carts grand total.<br/>
						Go to the <a href="<?php echo $base_url; ?>lite_library/discount_surcharge_features">Discount / Surcharge Features</a> page to see examples of setting discounts and surcharges  without the use of a database.
					</small>
					<hr/>
					<ul>
						<li>
							Summary Discount #1 : Spend over <?php echo $this->flexi_cart->get_taxed_currency_value(1000, FALSE, TRUE, 0);?> and get a summary discount of <?php echo $this->flexi_cart->get_taxed_currency_value(100, FALSE, TRUE, 0);?> off of the cart total.
						</li>
						<li>
							Summary Discount #2 : Spend over <?php echo $this->flexi_cart->get_taxed_currency_value(500, FALSE, TRUE, 0);?> and get free worldwide shipping.
						</li>
					</ul>
				</div>
			</div>
				
			<div class="w100 frame">
				<h3>Tax Application Rules on Discounts</h3>
				<div class="frame_note">
					<p>
						Tax laws vary between countries and states, to comply with these laws, discounts and tax can be applied using 3 different methods.<br/>
						Note that all of the following rules can be applied independently per discount.
					</p>
					<hr/>
					<p>
						<strong>Method #1</strong><br/>
						Calculate non-discounted value including tax, then apply discount to value.<br/>
						<em>This method is typically used for carts setup with item prices including tax.</em>
					</p>
					<hr/>
					<p>
						<strong>Method #2</strong><br/>
						Calculate non-discounted value excluding tax, then apply discount to value, then apply tax rate to discounted value.<br/>
						<em>This method is typically used for carts setup with item prices excluding tax.</em>
					</p>
					<hr/>
					<p>
						<strong>Method #3</strong><br/>
						Calculate tax of non-discounted value, then apply discount to value excluding tax, then add the original tax value to discounted value.<br/>
						<em>This method is typically used for 'Manufacturer Coupon' discounts, when the items full non-discounted tax value must still be paid by the customer.</em>
					</p>
				</div>

				<h3>Tax Application Examples</h3>
				<div class="frame_note">
					<p>By adding an example item to the cart from each discount type and tax method that are listed below, a demonstration can be seen of how the tax value of each discount is affected.</p>
					<small>Note: For further clarity on the taxes applied, only add 1 item to the cart, and set the shipping as 'UK Collection' so that tax from the shipping option is not included.</small>
					<hr/>
					
					<h6>Percentage Discounts</h6>
					<ul>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/401">Example #401</a> : Get 10% off original price (<?php echo $this->flexi_cart->get_taxed_currency_value(10);?>) - Method #1.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/402">Example #402</a> : Get 10% off original price (<?php echo $this->flexi_cart->get_taxed_currency_value(10);?>) - Method #2.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/403">Example #403</a> : Get 10% off original price (<?php echo $this->flexi_cart->get_taxed_currency_value(10);?>) - Method #3.</li>
					</ul>
					<hr/>

					<h6>Flat Fee Discounts</h6>
					<ul>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/404">Example #404</a> : Get set price of <?php echo $this->flexi_cart->get_taxed_currency_value(5);?> off original price (<?php echo $this->flexi_cart->get_taxed_currency_value(10);?>) - Method #1.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/405">Example #405</a> : Get set price of <?php echo $this->flexi_cart->get_taxed_currency_value(5);?> off original price (<?php echo $this->flexi_cart->get_taxed_currency_value(10);?>) - Method #2.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/406">Example #406</a> : Get set price of <?php echo $this->flexi_cart->get_taxed_currency_value(5);?> off original price (<?php echo $this->flexi_cart->get_taxed_currency_value(10);?>) - Method #3.</li>
					</ul>
					<hr/>

					<h6>New Value Discounts</h6>
					<ul>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/407">Example #407</a> : Get for new price of <?php echo $this->flexi_cart->get_taxed_currency_value(7.5);?> (Original price <?php echo $this->flexi_cart->get_taxed_currency_value(10);?>) - Method #1.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/408">Example #408</a>: Get for new price of <?php echo $this->flexi_cart->get_taxed_currency_value(7.5);?> (Original price <?php echo $this->flexi_cart->get_taxed_currency_value(10);?>) - Method #2.</li>
						<li><a href="<?php echo $base_url; ?>standard_library/insert_discount_item_to_cart/409">Example #409</a>: Get for new price of <?php echo $this->flexi_cart->get_taxed_currency_value(7.5);?> (Original price <?php echo $this->flexi_cart->get_taxed_currency_value(10);?>) - Method #3.</li>
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