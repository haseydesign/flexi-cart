	<?php $flexi_cart_library = (isset($current_url['admin_library'])) ? 'flexi_cart_admin' : 'flexi_cart'; ?>
	<div class="content_wrap nav_bg">
		<div id="sub_nav_wrap" class="content">
			<ul id="sub_nav">
				<li>
					<a href="<?php echo $base_url; ?>lite_library/demo">About Demo</a>
				</li>
				
				<li>
					<a href="<?php echo $base_url; ?>standard_library/view_cart">View Cart</a>
				</li>
				
				<li class="css_nav_dropmenu">
					<a href="<?php echo $base_url; ?>lite_library/item_link_examples">Item Examples</a>
					<ul>
						<li class="header">Static Item Examples
							<small>These examples are hard coded into the<br/> demo, and cannot be edited.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>lite_library/item_link_examples">Add Items to Cart via a Link</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>lite_library/item_form_examples">Add Items to Cart via a Form</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>lite_library/item_ajax_examples">Add Items to Cart via Ajax</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>lite_library/item_discount_examples">Add Discount Items to Cart</a>
						</li>
						<li class="header">Dynamic Item Examples
							<small>These examples are loaded from a database, <br/>and can be edited via the admin library.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>lite_library/item_database_examples">Add Database Items to Cart</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/items">Edit Database Items</a>
						</li>
					</ul>
				</li>
				
				<li class="css_nav_dropmenu">
					Feature Examples
					<ul>
						<li class="header">Change Currency
							<small>
								Displaying Currency in : <strong><?php echo $this->$flexi_cart_library->currency_name(); ?></strong>
							</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/currency/aud">AUD : Australian Dollars ($ AU)</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/currency/eur">EUR : Euros (&euro;)</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/currency/gbp">GBP : British Pounds (&pound;)</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/currency/usd">USD : US Dollars ($ US)</a>
						</li>
						<li class="header">Change Tax Display
							<small>Displaying Prices : <strong><?php echo ($this->$flexi_cart_library->display_prices_inc_tax()) ? "Including Tax" : "Excluding Tax";?></strong></small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/pricing_tax/inc">Display Pricing Including Tax</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/pricing_tax/ex">Display Pricing Excluding Tax</a>
						</li>
						<li class="header">Other Setting Features</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/load_save_cart_data">Save / Load Cart Data</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>lite_library/discount_surcharge_features">Discounts / Surcharges</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/misc_features">Miscellaneous</a>
						</li>
					</ul>
				</li>
				
				<li class="css_nav_dropmenu">
					Cart Status
					<ul>
						<li class="header">Shipping</li>
						<li class="status">Option: <?php echo $this->$flexi_cart_library->shipping_name();?></li>
						<li class="status">Location : <?php echo $this->$flexi_cart_library->shipping_location_name();?></li>
						<li class="header">Tax</li>
						<li class="status">Type: <?php echo $this->$flexi_cart_library->tax_name();?> @ <?php echo $this->$flexi_cart_library->tax_rate();?></li>
						<li class="status">Location : <?php echo $this->$flexi_cart_library->tax_location_name();?></li>
						<li class="status">Cart Display : Prices <?php echo ($this->$flexi_cart_library->display_prices_inc_tax()) ? "Include Tax" : "Exclude Tax";?></li>
						<li class="status">Cart Internal : Prices <?php echo ($this->$flexi_cart_library->cart_prices_inc_tax()) ? "Include Tax" : "Exclude Tax";?></li>
						<li class="header">Currency Exchange Rate</li>
						<li class="status">Cart Internal : <?php echo $this->$flexi_cart_library->currency_name(TRUE)." to ".$this->$flexi_cart_library->currency_name()." @ ".$this->$flexi_cart_library->exchange_rate(2);?></li>
						<li class="header">Minimum Order Value</li>
						<li class="status">Minimum Order: <?php echo $this->$flexi_cart_library->minimum_order();?></li>
						<li class="status">Status: <?php echo ($this->$flexi_cart_library->minimum_order_status()) ? "Eligible" : "Ineligible" ;?> to Checkout <a href="<?php echo $base_url; ?>standard_library/misc_features#minimum_order">[edit]</a></li>
						<li class="header">Custom Status</li>
						<li class="status">Login Status: <?php echo ($this->$flexi_cart_library->custom_status_1()) ? 'Logged in' : 'Not logged in' ;?> <a href="<?php echo $base_url; ?>standard_library/misc_features#custom_status">[edit]</a></li>
					</ul>
				</li>

				<li id="mini_cart" class="css_nav_dropmenu">
					Mini Cart
					<ul>
						<li class="status">
							<h4>Minature Cart Example</h4>
							<table>
								<thead>
									<tr>
										<th>Item</th>
										<th>Price</th>
										<th>Qty</th>
										<th>Total</th>
									</tr>
								</thead>
							<?php if (! empty($mini_cart_items)) { ?>
								<tbody>
								<?php $i = 0; foreach($mini_cart_items as $row) { $i++; ?>
									<tr>
										<td>
											#<?php echo $i; ?>
										</td>
										<td>
										<?php 
											// If an item discount exists.
											if ($this->$flexi_cart_library->item_discount_status($row['row_id'])) 
											{
												// If the quantity of non discounted items is zero, strike out the standard price.
												if ($row['non_discount_quantity'] == 0)
												{
													echo '<span class="strike">'.$row['price'].'</span><br/>';
												}
												// Else, display the quantity of items that are at the standard price.
												else
												{
													echo $row['non_discount_quantity'].' @ '.$row['price'].'<br/>';
												}
												
												// If there are discounted items, display the quantity of items that are at the discount price.
												if ($row['discount_quantity'] > 0)
												{
													echo $row['discount_quantity'].' @ '. $row['discount_price'];
												}
											}
											// Else, display price as normal.
											else
											{
												echo $row['price'];
											}
										?>
										</td>
										<td>
											<?php echo $row['quantity'];?>
										</td>
										<td>
										<?php 
											// If an item discount exists, strike out the standard item total and display the discounted item total.
											if ($row['discount_quantity'] > 0)
											{
												echo '<span class="strike">'.$row['price_total'].'</span><br/>';
												echo $row['discount_price_total'];
											}
											// Else, display item total as normal.
											else
											{
												echo $row['price_total'];
											}
										?>
										</td>
									</tr>
								<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3">Shipping</th>
										<td>
											<?php echo $this->$flexi_cart_library->shipping_total();?>
										</td>
									</tr>
									<tr>
										<th colspan="3">Tax</th>
										<td>
											<?php echo $this->$flexi_cart_library->tax_total();?>
										</td>
									</tr>
									<tr>
										<th colspan="3">Grand Total</th>
										<td><?php echo $this->$flexi_cart_library->total();?></td>
									</tr>
								</tfoot>
							<?php } else { ?>
								<tbody>
									<tr>
										<td colspan="4" class="empty">
											Shopping cart is empty!
										</td>
									</tr>
								</tbody>
							<?php } ?>
							</table>
							<div id="mini_cart_status">Cart has been updated!</div>
						</li>
					</ul>
				</li>
				
				<li class="css_nav_dropmenu">
					<a href="<?php echo $base_url; ?>admin_library/">Admin Library</a>
					<ul>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/">Admin Dashboard</a>
						</li>
						<li class="header">Item / Order Management</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/items">Items</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/orders">Orders</a>
						</li>
						<li class="header">Locations and Zones</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/location_types">Locations</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/zones">Zones</a>
						</li>
						<li class="header">Shipping and Taxes</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/shipping">Shipping Options</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/tax">Taxes</a>
						</li>
						<li class="header">Discounts</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/item_discounts">Item Discounts</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/summary_discounts">Summary Discounts</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/discount_groups">Discount Groups</a>
						</li>
						<li class="header">Reward Points and Vouchers</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/user_reward_points">Reward Points</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/vouchers">Reward Vouchers</a>
						</li>
						<li class="header">Currency and Cart Config.</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/currency">Currencies</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/order_status">Order Status</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/config">Cart Configuration</a>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>admin_library/defaults">Cart Defaults</a>
						</li>
					</ul>		
				</li>
				
				<li>
					<a href="<?php echo $base_url; ?>lite_library/lite_library_example">Lite Library</a>
				</li>
			</ul>
		</div>
	</div>