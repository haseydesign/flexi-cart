	<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Shopping Cart | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of a flexi carts display cart functions."/> 
	<meta name="keywords" content="flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="cart">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h2>Shopping Cart</h2>
				<p>The shopping cart page of any e-commerce site is a very important step in converting a browsing shopper, to a paying customer.</p>
				<p>The design of the cart page generally follows the concept of a list of items within the customers cart and then a summary of the carts value.<br/>
				However, the data listed in some carts can often be lacking in information and clarity, and therefore can potentially cloud a customers decision to buy.</p>
				<p>flexi cart provides well over 100 configurable functions that can be used to get data from either the carts session data, or the sites database.<br/>
				Using this data, the design and layout for the cart can be completely customised to match the clients requirements.</p>
			</div>
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			<div id="cart_content">
				<div id="ajax_content">
					
				<?php if (! empty($message)) { ?>
					<div id="message">
						<?php echo $message; ?>
					</div>
				<?php } ?>
				
					<div class="clearfix">
						<h4 class="float_l">Cart Content</h4>
						<span class="float_r">
							<a href="<?php echo $base_url; ?>standard_library/save_cart_data" class="link_button">Save Cart</a>
							<a href="<?php echo $base_url; ?>standard_library/load_save_cart_data" class="link_button">Load Cart</a>
						</span>
					</div>
				
					<?php echo form_open(current_url());?>
						<table id="cart_items">
							<thead>
								<tr>
									<th class="spacer_75">Remove</th>
									<th>Item</th>
									<th class="spacer_100 align_ctr">Price</th>
									<th class="spacer_100 align_ctr">Quantity</th>
									<th class="spacer_100 align_ctr">Total</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								if (! empty($cart_items)) {
									$i = 0;
									foreach($cart_items as $row) { $i++;
							?>
								<tr>
									<td>									
										<!-- 
											The name of each input field is structured as a multi-dimensional array, using the looped '$i' value to group each rows data together.
											When submitting input data to the 'update_cart()' function, the id of the cart row being updated must also be submitted.
											An example of this is done below by including a hidden field with the carts row id.
										-->
										<input type="hidden" name="items[<?php echo $i;?>][row_id]" value="<?php echo $row['row_id'];?>"/>
										
										<a href="<?php echo $base_url; ?>standard_library/delete_item/<?php echo $row['row_id'];?>" title="Click to remove item from cart">Remove</a>
									</td>
									<td>
										<strong><?php echo $row['name'];?></strong><br/>

									<?php 
										if ($this->flexi_cart->item_option_status($row['row_id']) && isset($row['option_data'])) { 
											foreach($row['option_data'] as $option_column => $option_data) {
									?>
										<!-- 
											Example of displaying an items options if they exist, as an editable field, 
											this example uses a custom field ('option_data') containing an array of option data. 
											To activate this example, add item #202 on the 'Add an item with options via a form' page.
										-->
										<label class="spacer_50"><?php echo $option_column; ?>:</label> 
										<select name="items[<?php echo $i;?>][options][<?php echo $option_column; ?>]" class="width_100">
										<?php foreach($option_data as $data) { ?>
											<option value="<?php echo $data; ?>" <?php echo set_select('items['.$i.'][options]['.$option_column.']', $data, ($data == $row['options'][$option_column]));?>>
												<?php echo $data; ?>
											</option>
										<?php } ?>
										</select><br/>
										
									<?php } } else if ($this->flexi_cart->item_option_status($row['row_id'])) { ?>
									
										<!-- Example of displaying an items options if they exist, but as text, rather than an editable field. -->
										<?php echo $this->flexi_cart->item_options($row['row_id'], TRUE).'<br/>';?>
										
									<?php }?>
										
										<!-- 
											Example of displaying any item status messages.
											Status messages are generated if an item cannot be shipped to the current shipping location, or if there is insufficient stock.
											A css style ('highlight_red') can be submitted to the function to format messages.
										-->
									<?php 
										$item_status_message = $this->flexi_cart->item_status_message($row['row_id'], 'highlight_red');
										echo (! empty($item_status_message)) ? $item_status_message.'<br/>' : NULL;
									?>
											
										<!-- 
											Example of indicating an items stock level - (Example only displays on item example #112) 
											If TRUE is submited to the 2nd parameter of 'item_stock_quantity()', it returns remaining quantity available once current quantity it deducted.
										-->
									<?php 
										if ($row['id'] == 112)
										{
											echo '<span class="highlight_green">There are <strong>'.$this->flexi_cart->item_stock_quantity($row['row_id']).'</strong> items in-stock.</span><br/>';
										}
									?>
										
										<!-- 
											Example of how to update a custom column defined via the config file var $config['cart']['items']['custom_columns'].
											Ensure the input name is the same as the custom column you wish to update.
											Note: Only custom columns that are defined as 'updatable' can be updated once set.											
										-->
										Note: <input type="text" name="items[<?php echo $i;?>][user_note]" value="<?php echo $row['user_note'];?>" maxlength="50" class="width_175"/>
									</td>
									<td class="align_ctr">
									<?php 
										// If an item discount exists.
										if ($this->flexi_cart->item_discount_status($row['row_id'])) 
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
									<td class="align_ctr">
										<!-- 
											The input name 'quantity' must be the same as the item array column that it is updating.
											In this example, it is defined via the config file var $config['cart']['items']['columns']['item_quantity'] = 'quantity'
										-->
										<input type="text" name="items[<?php echo $i;?>][quantity]" value="<?php echo $row['quantity'];?>" maxlength="3" class="width_50 align_ctr validate_decimal"/>
										<input type="submit" name="update" value="&plusmn;" title="Update Quantity" class="link_button grey"/>
									</td>
									<td class="align_ctr">
									<?php 
										// If an item discount exists, strike out the standard item total and display the discounted item total.
										if ($row['discount_quantity'] > 0)
										{
											echo '<span class="strike">'.$row['price_total'].'</span><br/>';
											echo $row['discount_price_total'].'<br/>';
										}
										// Else, display item total as normal.
										else
										{
											echo $row['price_total'];
										}
									?>
									</td>
								</tr>
							<?php 
								// To display a description of the discount, this example submits a 2nd parameter to the item_discount_status() function.
								// This sets the function to show item shipping discounts as well as the standard item price discounts. 
								if ($this->flexi_cart->item_discount_status($row['row_id'], FALSE)) { 
							?>
								<tr class="discount">
									<td colspan="5">
										Discount: <?php echo $this->flexi_cart->item_discount_description($row['row_id']);?>
										: <a href="<?php echo $base_url; ?>standard_library/unset_discount/<?php echo $this->flexi_cart->item_discount_id($row['row_id']);?>">Remove</a>
									</td>
								</tr>
							<?php } ?>
								<tr>
									<td colspan="5" class="hidden_vars">
										<!-- This row is only intended to show some of the internal values of the cart-->
										<span class="toggle">View Hidden Item Data</span>
										<small class="hide_toggle">
											<strong>Hidden item values:</strong> 
											Weight: <em><?php echo $row['weight'];?></em>, 
											Tax Rate: <em><?php echo $row['tax_rate'];?></em>, 
											Tax: <em>
												<?php 
													// If a discount is set, the tax of the discounted items is shown in brackets.
													// Note: The $row data does not include the item tax including the discount, instead use the function $this->flexi_cart->item_tax($row['row_id'], TRUE).
													echo $row['tax'];
													echo ($this->flexi_cart->item_discount_status($row['row_id'])) ? ' ('.$this->flexi_cart->item_tax($row['row_id'], TRUE).')' : NULL; 
												?></em>,
											Reward Points: <em><?php echo $row['reward_points'];?></em>, 
											Shipping: <em><?php echo (is_numeric($row['shipping_rate'])) ? $row['shipping_rate'] : 'Default Rate';?></em><br/>

											<strong>Hidden item totals:</strong> 
											Total Weight: <em><?php echo $row['weight_total'];?></em>, 
											Total Tax: <em><?php 
													// If a discount is set, the discounted tax total is shown in brackets.
													// Note: The $row data does not include the item tax total including the discount, instead use the function $this->flexi_cart->item_tax_total($row['row_id'], TRUE).
													echo $row['tax_total'];
													echo ($this->flexi_cart->item_discount_status($row['row_id'])) ? ' ('.$this->flexi_cart->item_tax_total($row['row_id'], TRUE).')' : NULL; 
												?></em>, 
											Total Reward Points: <em><?php echo $row['reward_points_total'];?></em>
										</small>	
									</td>
								</tr>
							<?php } } else { ?>
								<tr>
									<td colspan="5" class="empty">
										<h4>! You currently have no items in your shopping cart !</h4>
										<a href="<?php echo $base_url; ?>lite_library/item_link_examples">View examples of items that can be added to the cart</a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
							<tfoot>
							<?php 
								// Ensure the 'item_summary_savings_total()' functions format argument is set to 'FALSE' to prevent comparing a formatted STRING against an INT of '0'.
								if ($this->flexi_cart->item_summary_savings_total(FALSE) > 0) { 
							?>
								<tr class="discount">
									<th colspan="4">Item Summary Discount Savings Total</th> 
									<td><?php echo $this->flexi_cart->item_summary_savings_total();?></td>
								</tr>
							<?php } ?>
								<tr>
									<th colspan="4">Item Summary Total</th>
									<td><?php echo $this->flexi_cart->item_summary_total();?></td>
								</tr>
							</tfoot>
						</table>

					<?php 
						// Example on how to display how much more needs to be spent, or how many more items need to be added to activate a discount.
						// The function can work on both item and summary discounts.
						// Note: Ensure '$free_shipping_discount' contains no formatted currency strings by submitting FALSE as the 2nd argument to 'get_discount_requirements'.
						$free_shipping_discount = $this->flexi_cart->get_discount_requirements(5, FALSE);
						if ($free_shipping_discount['value'] > 0) { 
					?>
						<div class="frame align_ctr">
							<h3>Spend another <?php echo $this->flexi_cart->get_currency_value($free_shipping_discount['value']);?> and get free worldwide shipping!</h3>
						</div>
					<?php } ?>
												
						<!--
							This demo includes 2 examples of updating the carts shipping data, via database lookup tables, or by setting manually.
							To toggle shipping between database and manually set options, follow the instructions in the 'cart/view_cart' controller file.
						-->
					<?php if (isset($countries)) { ?>
						<table id="cart_shipping">
							<thead>
								<tr>
									<th>Shipping</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<small>
											Shipping can be based on as many location tiers as required.<br/>
											This example shows how rates can be calculated as per country right down to specific postal codes.<br/>
											To demonstrate, select country 'United States' > select state 'New York' and enter '10101' as the postal code.<br/>
										</small>								
									</td>
								</tr>
								<tr>
									<td>
										<label class="spacer_250">Country:
											<select name="shipping[country]">
												<option value="0"> - Country - </option>
											<?php foreach($countries as $country) { ?>
												<option value="<?php echo $country['loc_id'];?>" <?php echo ($this->flexi_cart->match_shipping_location_id($country['loc_id'])) ? 'selected="selected"' : NULL;?>>
													<?php echo $country['loc_name'];?>
												</option>
											<?php } ?>
											</select>
										</label>
										
										<label class="spacer_200">State:
											<select name="shipping[state]" <?php if (empty($states)) { echo 'disabled="disabled"'; }?>>
												<option value="0"> - State - </option>
											<?php foreach($states as $state) { ?>
												<option value="<?php echo $state['loc_id'];?>" <?php echo ($this->flexi_cart->match_shipping_location_id($state['loc_id'])) ? 'selected="selected"' : NULL;?>>
													<?php echo $state['loc_name'];?>
												</option>
											<?php } ?>
											</select>
										</label>

										<label>Postal Code:
											<!-- The value '3' in the 'shipping_location_name()' function requests the location name for the 3rd location tier - in this example, postal/zip code -->
											<input type="text" name="shipping[postal_code]" value="<?php echo $this->flexi_cart->shipping_location_name(3);?>" <?php if (empty($postal_codes)) { echo 'disabled="disabled"'; }?> placeholder="101010" class="width_75"/>
										</label>
									</td>
								</tr>
								<tr>
									<td>
										<label class="spacer_125">Shipping Options:</label>
										<select name="shipping[db_option]">
											<option value="0"> - Shipping Options - </option>
										<?php 
											if (! empty($shipping_options)) {
												foreach($shipping_options as $shipping) { 
										?>
											<option value="<?php echo $shipping['id'];?>" <?php echo ($shipping['id'] == $this->flexi_cart->shipping_id()) ? 'selected="selected"' : NULL; ?>>
												<?php echo $shipping['name']." : ".$shipping['description'];?>
											</option>
										<?php } } else { ?>
											<option value="0">
												We'll quote you prior to dispatch.
											</option>
										<?php } ?>
										</select>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td>
										<small>Note: This demo also updates tax rates based on the shipping location, this also can be set independently.</small>
									</td>
								</tr>
							</tfoot>
						</table>
					<?php } else { ?>					
						<!-- Manually set shipping option example -->
						<table id="cart_shipping">
							<thead>
								<tr>
									<th>Shipping</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<small>
											This is an example of setting shipping options manually, rather than via a database.<br/>
										</small>
									</td>
								</tr>
								<tr>
									<td>
										<label>Shipping Options:
											<select name="shipping[manual_option]">
												<option value="0"> - Shipping Options - </option>
											<?php 
												if (! empty($shipping_options)) {
													foreach($shipping_options as $shipping) { 
											?>
												<option value="<?php echo $shipping['id'];?>" <?php echo ($shipping['id'] == $this->flexi_cart->shipping_id()) ? 'selected="selected"' : NULL; ?>>
													<?php echo $shipping['name']." : ".$shipping['description'];?>
												</option>
											<?php } } else { ?>
												<option value="0">
													We'll quote you prior to dispatch.
												</option>
											<?php } ?>
											</select>
										</label>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td>&nbsp;</td>
								</tr>
							</tfoot>
						</table>
					<?php } ?>
					
						<table id="cart_summary">
							<thead>
								<tr>
									<th colspan="2">Cart Summary</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										Reward Points Earned
									</td>
									<td>
										<?php echo $this->flexi_cart->total_reward_points();?> points
									</td>
								</tr>
								<tr>
									<td>
										Total Weight
									</td>
									<td>
										<?php echo $this->flexi_cart->total_weight();?>
									</td>
								</tr>
								<tr>
									<td>
										Item Summary Total
									</td>
									<td>
										<?php echo $this->flexi_cart->item_summary_total();?>
									</td>
								</tr>
								<tr>
									<td>
										Shipping Rate
									</td>
									<td>
										<?php echo $this->flexi_cart->shipping_total();?>
									</td>
								</tr>
																
							<?php if ($this->flexi_cart->summary_discount_status()) { ?>
								<tr class="discount">
									<th>Discount Summary</th>
									<td>&nbsp;</td>
								</tr>
								
							<?php if ($this->flexi_cart->item_summary_discount_status()) { ?>
								<!-- 
									Rather than repeating the descriptions of each item discount listed via the cart, 
									this example summarises the discount totals of all items.
								-->
								<tr class="discount">
									<th>
										<span class="pad_l_20">
											&raquo; Item discount discount savings
										</span>
									</th>
									<td>
										<?php echo $this->flexi_cart->item_summary_savings_total();?>
									</td>
								</tr>
							<?php } ?>
								
								<!-- 
									This example uses the 'summary_discount_data()' function to return an array of summary discount values and descriptions.
									An alternative to using a custom loop to return this discount array, is to call the 'summary_discount_description()' function,
									which will return a formatted string of all summary discounts. 
								-->
							<?php foreach($discounts as $discount) { ?>
								<tr class="discount">
									<th>
										<span class="pad_l_20">
											&raquo; <?php echo $discount['description'];?>
										<?php if (! empty($discount['id'])) { ?>
											: <a href="<?php echo $base_url; ?>standard_library/unset_discount/<?php echo $discount['id']; ?>">Remove</a>
										<?php } ?>
										</span>
									</th>
									<td><?php echo $discount['value'];?></td>
								</tr>
							<?php } ?>
								<tr class="discount">
									<th>Discount Savings Total</th>
									<td><?php echo $this->flexi_cart->cart_savings_total();?></td>
								</tr>
							<?php } ?>

								
							<?php if ($this->flexi_cart->surcharge_status()) { ?>
								<tr class="surcharge">
									<th>Surcharge Summary</th>
									<td>&nbsp;</td>
								</tr>
								
								<!-- 
									This example uses the 'surcharge_data()' function to return an array of surcharge values and descriptions.
									An alternative to using a custom loop to return this surcharge array, is to call the 'surcharge_description()' function,
									which will return a formatted string of all surcharges.
								-->
							<?php foreach($surcharges as $surcharge) { ?>
								<tr class="surcharge">
									<th>
										<span class="pad_l_20">
											&raquo; <?php echo $surcharge['description'];?>
											: <a href="<?php echo $base_url; ?>standard_library/unset_surcharge/<?php echo $surcharge['id']; ?>">Remove</a>
										</span>
									</th>
									<td><?php echo $surcharge['value'];?></td>
								</tr>
							<?php } ?>
								<tr class="surcharge">
									<th>Surcharge Total</th>
									<td><?php echo $this->flexi_cart->surcharge_total();?></td>
								</tr>
							<?php } ?>

							<?php if ($this->flexi_cart->reward_voucher_status()) { ?>
								<tr class="voucher">
									<th>Reward Voucher Summary</th>
									<td>&nbsp;</td>
								</tr>
								
								<!-- This example uses the 'reward_voucher_data()' function to return an array of reward voucher values and descriptions. -->
							<?php foreach($reward_vouchers as $voucher) { ?>
								<tr class="voucher">
									<th>
										<span class="pad_l_20">
											&raquo; <?php echo $voucher['description'];?>
											: <a href="<?php echo $base_url; ?>standard_library/unset_discount/<?php echo $voucher['id']; ?>">Remove</a>
										</span>
									</th>
									<td><?php echo $voucher['value'];?></td>
								</tr>
							<?php } ?>
								<tr class="voucher">
									<th>Reward Voucher Total</th>
									<td><?php echo $this->flexi_cart->reward_voucher_total();?></td>
								</tr>
							<?php } ?>

							</tbody>
							<tfoot>
								<tr>
									<td>
										Sub Total (ex. tax)
									</td>
									<td>
										<?php echo $this->flexi_cart->sub_total();?>
									</td>
								</tr>
								<tr>
									<td>
										<?php echo $this->flexi_cart->tax_name()." @ ".$this->flexi_cart->tax_rate(); ?>
									</td>
									<td>
										<?php echo $this->flexi_cart->tax_total();?>
									</td>
								</tr>							
								<tr class="grand_total">
									<th>Grand Total</th>
									<td><?php echo $this->flexi_cart->total();?></td>
								</tr>
							</tfoot>
						</table>
						
						<fieldset>
							<h4>Discount / Reward Voucher Codes</h4>
							<small>Examples: 'FREE-UK-SHIPPING', '10-PERCENT', '10-FIXED-RATE'</small>
							
							<ul>
							<?php 
								// Get an array of all discount codes. The returned array keys are 'id', 'code' and 'description'.
								if ($discount_data = $this->flexi_cart->discount_codes()) {
									foreach($discount_data as $discount_codes) {
							?>
								<li>
									<input type="text" name="discount[<?php echo $discount_codes['code']; ?>]" value="<?php echo $discount_codes['code']; ?>"/> 
									<input type="submit" name="update_discount" value="Update" class="link_button grey"/>
									<input type="submit" name="remove_discount_code[<?php echo $discount_codes['code']; ?>]" value="Remove" class="link_button grey"/>
									<small class="inline">* <?php echo $discount_codes['description'];?></small>
								</li>
							<?php
									}
								}
							?>
								<li>
									<input type="text" name="discount[0]" value=""/> 
									<input type="submit" name="update_discount" value="Add Discount Code" class="link_button"/> 
									<input type="submit" name="remove_all_discounts" value="Remove all Discounts" class="link_button tooltip_trigger" title="Remove all discount codes and all manually set discounts."/>
								</li>
							</ul>
							<a href="<?php echo $base_url; ?>lite_library/item_discount_examples">View item based discount examples</a>
						</fieldset>
					
					<?php if (! $this->flexi_cart->location_shipping_status()) { ?>
						<div class="warning">
							<h3>Item Shipping Warning!</h3>
							<p>There are items in your cart that cannot be shipped to your current shipping location.</p>
						</div>
					<?php } ?>

						<fieldset>
							<h4>Cart Controls</h4>
							<input type="submit" name="update" value="Update Cart" class="link_button large"/>
							<input type="submit" name="clear" value="Clear Cart" class="link_button large"/>
							<input type="submit" name="destroy" value="Destroy Cart" class="link_button large grey tooltip_trigger" title="Destroy Cart will reset the cart to default values."/>
							<input type="submit" name="checkout" value="Checkout" class="link_button large red"/>
						</fieldset>						
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>	
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 
<script>
$(function() {
	// Ajax Cart Update Example
	// Submit the cart form if a shipping option select or input element is changed.
	$('select[name^="shipping"], input[name^="shipping"]').live('change', function()
	{
		// Loop through shipping select and input fields creating object of their names and values that will then be submitted via 'post'
		var data = new Object();
		$('select[name^="shipping"], input[name^="shipping"]').each(function()
		{
			data[$(this).attr('name')] = $(this).val();
		});
		
		// Set 'update' so controller knows to run update method.
		data['update'] = true;

		// !IMPORTANT NOTE: As of CI 2.0, if csrf (cross-site request forgery) protection is enabled via CI's config, this must be included to submit the token.
		data['csrf_test_name'] = $('input[name="csrf_test_name"]').val();

		$('#cart_content').load('<?php echo current_url();?> #ajax_content', data);
	});
});
</script>

</body>
</html>