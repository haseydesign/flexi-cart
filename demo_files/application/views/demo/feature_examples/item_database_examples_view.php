<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Database Examples | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of inserting items from a database to the cart."/> 
	<meta name="keywords" content="insert items, database, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
	<link rel="stylesheet" href="<?php echo $includes_dir;?>css/jquery.countdown.css"/>
</head>

<body id="item_database">

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
				<p>Items can be added to the cart using either data <a href="<?php echo $base_url; ?>lite_library/item_link_examples">hard coded</a> into a model file or data retrieved from a <a href="<?php echo $base_url; ?>lite_library/item_form_examples">html form</a> or a database query.</p>
				<p>This demo page uses a custom item table that is then linked to flexi cart, features like item shipping and tax rates, discounts and item stock can then be setup to interact with the custom item table and the shopping cart.</p>
				<p>As the custom item table is setup in this demo, flexi carts features can be applied 'live' to these 5 demo items using functions in the <a href="<?php echo $base_url; ?>admin_library/">Admin Library</a>.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">

			<h2>Item Database Examples</h2>
			<a href="<?php echo $base_url; ?>lite_library/item_link_examples">Item Link Examples</a> |
			<a href="<?php echo $base_url; ?>lite_library/item_form_examples">Item Form Examples</a> |
			<a href="<?php echo $base_url; ?>lite_library/item_ajax_examples">Item Ajax Examples </a> |
			<a href="<?php echo $base_url; ?>lite_library/item_discount_examples">Item Discount Examples</a>
			
			<div class="anchor_nav">
				<h6>Jump to Item</h6>
				<p>
					<a href="<?php echo $base_url; ?>lite_library/item_database_examples#item1">Item #1</a> | 
					<a href="<?php echo $base_url; ?>lite_library/item_database_examples#item2">Item #2</a> |
					<a href="<?php echo $base_url; ?>lite_library/item_database_examples#item3">Item #3</a> |
					<a href="<?php echo $base_url; ?>lite_library/item_database_examples#item4">Item #4</a> |
					<a href="<?php echo $base_url; ?>lite_library/item_database_examples#item5">Item #5</a>
					<small>The values displayed for shipping, tax and discount content are based on the current cart status, this includes the current shipping location set via the 'View Cart' page.<br/>You can view the status of settings within the cart via the 'Cart Status' tab on the navigation menu.</small>
				</p>
			</div>
		
			<?php 
				$i = 0;
				foreach($item_data as $item) {
					$item_tax_rate = $this->flexi_cart->get_item_tax_rate($item['item_id']);
					$item_discount_data = $this->flexi_cart->get_item_discounts($item['item_id']);
					$item_shipping_rate = $this->flexi_cart->get_item_shipping_rate($item['item_id']);
					$item_ship_separate = $this->flexi_cart->get_item_shipping_separate_status($item['item_id']);
					$item_ship_status = $this->flexi_cart->get_item_shipping_status($item['item_id']);
			?>
			<a name="item<?php echo $item['item_id']; ?>"></a>
			<div class="w100 frame">
				<h3 class="heading">Example <?php echo $item['item_name']; ?></h3>
				<table>
					<thead>
						<tr>
							<th class="spacer_25 tooltip_trigger" 
								title="Edit the item details via the 'Admin Library'.">
								Edit
							</th>
							<th class="spacer_75 tooltip_trigger" 
								title="Indicates the non-discounted price of the item.">
								Price
							</th>
							<th class="spacer_75 tooltip_trigger" 
								title="Indicates whether the item has a specific tax rate set that differs from the cart default rate.">
								Tax Rate and Value
							</th>
							<th class="spacer_75 tooltip_trigger" 
								title="Indicates whether the item has a specific shipping rate set. This rate could be 'Free Shipping' or a surcharge that is added to the cart total. A 'Default' rate indicates the items shipping is calculated normally.">
								Shipping Rate
							</th>
							<th class="spacer_100 tooltip_trigger" 
								title="Indicates whether the item is shipped bundled with other items or shipped separately. <br/>Items shipped separately have a shipping charge calculated per item which is added to the cart total.">
								Shipping Packaging
							</th>
							<th class="spacer_100 tooltip_trigger" 
								title="Indicates whether the item is permitted to be shipped to the current shipping location.">
								Shipping to Location
							</th>
							<th class="spacer_75 tooltip_trigger" 
								title="Indicates the number of reward points that would be earnt from purchasing the item.">
								Reward Points
							</th>
							<th class="spacer_75 tooltip_trigger" 
								title="Indicates the weight of the item. The total weight of items in the cart can be used to calculate shipping.">
								Weight
							</th>
							<th class="spacer_50 tooltip_trigger" 
								title="Indicates the number of items available in stock.">
								Stock
							</th>
							<th class="tooltip_trigger" 
								title="Add the item to the cart.">
								Add to Cart
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<a href="<?php echo $base_url; ?>admin_library/items">
									<img src="<?php echo $includes_dir; ?>images/edit_data.png"/>
								</a>
							</td>
							<td>
								<?php echo $this->flexi_cart->get_taxed_currency_value($item['item_price'], $item_tax_rate);?>
							</td>
							<td>
								<?php echo $item_tax_rate.'<br/>'.$this->flexi_cart->get_item_tax_value($item['item_id'], $item['item_price']); ?>
							</td>
							<td>
								<?php echo ($item_shipping_rate) ? $item_shipping_rate : 'Default'; ?>
							</td>
							<td>
								<?php echo ($item_ship_separate) ? 'Separate' : 'Bundled'; ?>
							</td>
							<td>
								<?php echo ($item_ship_status) ? 'Permitted' : 'Prohibited'; ?>
							</td>
							<td>
								<?php echo $this->flexi_cart->calculate_reward_points($item['item_price']); ?>
							</td>
							<td>
								<?php echo $this->flexi_cart->format_weight($item['item_weight']); ?>
							</td>
							<td>
								<?php echo $this->flexi_cart->get_item_stock_quantity($item['item_id']); ?>
							</td>
							<td>
								<a href="<?php echo $base_url; ?>standard_library/insert_database_item_to_cart/<?php echo $item['item_id']; ?>" class="link_button">Add Item</a>
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Discounts Available for <?php echo $item['item_name']; ?></h6>
				<p><a href="<?php echo $base_url; ?>admin_library/item_discounts">Insert a new item discount</a></p>
				<small>Note: If applying a discount to a category, <?php echo $item['item_name'].' is linked to '.$item['cat_name']; ?></small>
				<table>
					<thead>
						<tr>
							<th class="spacer_25 tooltip_trigger" 
								title="Edit the item discounts via the 'Admin Library'.">
								Edit
							</th>
							<th class="tooltip_trigger" 
								title="A description of the discount and requirements.">
								Description
							</th>
							<th class="spacer_75 tooltip_trigger" 
								title="Indicates the quantity of items that must be added to the cart for the discount to become active.">
								Quantity Required
							</th>
							<th class="spacer_75 tooltip_trigger" 
								title="Indicates the value of items that must be added to the cart for the discount to become active.">
								Value Required
							</th>
							<th class="spacer_75 tooltip_trigger" 
								title="Indicates whether the discount is applicable to a custom cart status.">
								Custom Status #1
							</th>
							<th class="spacer_75 tooltip_trigger" 
								title="Indicates whether the discount can be combined with other discounts within the cart.">
								Combine
							</th>
							<th class="spacer_175 tooltip_trigger" 
								title="Indicates the time left until a discount expires.">
								Expire Timer
							</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						if (! empty($item_discount_data)) { 
							foreach($item_discount_data as $discount_data) {
					?>
						<tr>
							<td>
								<a href="<?php echo $base_url; ?>admin_library/update_discount/<?php echo $discount_data[$this->flexi_cart->db_column('discounts', 'id')];?>">
									<img src="<?php echo $includes_dir; ?>images/edit_data.png"/>
								</a>
							</td>
							<td>
								<?php echo $discount_data[$this->flexi_cart->db_column('discounts', 'description')]; ?>
							</td>
							<td>
								<?php echo $discount_data[$this->flexi_cart->db_column('discounts', 'quantity_required')]; ?>
							</td>
							<td>
								<?php echo $this->flexi_cart->get_taxed_currency_value($discount_data[$this->flexi_cart->db_column('discounts', 'value_required')]); ?>
							</td>
							<td>
								<?php echo ($discount_data[$this->flexi_cart->db_column('discounts', 'custom_status_1')]) ? 'Yes' : 'No'; ?>
							</td>
							<td>
								<?php echo ($discount_data[$this->flexi_cart->db_column('discounts', 'non_combinable')]) ? 'No' : 'Yes'; ?>
							</td>
							<td>
								<input type="hidden" id="countdown_value_<?php echo $i; ?>" value="<?php echo $this->flexi_cart->get_expire_time($discount_data[$this->flexi_cart->db_column('discounts', 'expire_date')]);?>"/>
								<div id="countdown_<?php echo $i; ?>" class="countdown_wrap">
									<?php echo $discount_data[$this->flexi_cart->db_column('discounts', 'expire_date')]; ?>
								</div>
							</td>
						</tr>
					<?php $i++; } } else { // Increment discount timer index. ?>
						<tr>
							<td colspan="7">
								There are currently no discounts setup for this item.
							</td>
						</tr>						
					<?php } ?>
					</tbody>
				</table>
			</div>
			<?php } ?>	

		</div>
	</div>
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?>

<!-- Discount countdown demo created using the jQuery Countdown plugin found @ http://keith-wood.name/countdown.html -->
<script src="<?php echo $includes_dir;?>js/jquery.countdown.min.js?v=1.5.9"></script>
<script>
$(function () {
	// Loop through the rows of available discounts.
	// Obtain the expiry time from the hidden fields and then create the timer.
	$('input[id^="countdown_value"]').each(function(i)
	{
		var countdown_time = $(this).val();
		$('#countdown_'+i).countdown({until:countdown_time, alwaysExpire:true, expiryText:'<span class="countdown_expired">Discount has Expired</span>'});
	});
});
</script>

</body>
</html>