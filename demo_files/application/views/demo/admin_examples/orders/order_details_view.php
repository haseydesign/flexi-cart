<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Manage Order Details | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update order detail functions."/> 
	<meta name="keywords" content="update, order details, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="order_details">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Orders Details</h1>
				<p>This page is an example of how data from the order tables can be combined onto one page to form a compiled list of all the orders details.</p>
				<p>The tools and functionality required by this page will vary from site to site, with the most basic requiring simply a compiled order the user can print, up to a <a href="<?php echo $base_url; ?>admin_library/update_order_details/<?php echo $summary_data[$this->flexi_cart_admin->db_column('order_summary', 'order_number')]; ?>">fully featured editing tool</a> that would allow the user to completely change the content and data of the order.</p>
				<p>This example is a middle ground example allowing the user to indicate which items have been shipped or cancelled from the order. </p>
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
										
			<h1>Order Details</h1>
			<p><a href="<?php echo $base_url; ?>admin_library/orders">Manage Orders</a></p>
										
			<?php echo form_open(current_url());?>						
				<fieldset>
					<legend>Order</legend>
					
					<ul class="position_left">
						<li>
							<strong class="spacer_125">Order Number: </strong>
							<?php echo $summary_data[$this->flexi_cart_admin->db_column('order_summary', 'order_number')];?>
						</li>
						<li>
							<span class="spacer_125">Order Date: </span>
							<?php echo date('jS M Y', strtotime($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'date')]));?>
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<strong class="spacer_125">Order Status:</strong>
							<?php
								if ($summary_data[$this->flexi_cart_admin->db_column('order_status', 'cancelled')] == 1)
								{
									echo '<strong class="highlight_red">'.$summary_data[$this->flexi_cart_admin->db_column('order_status', 'status')].'</strong>';
								}
								else
								{
									echo $summary_data[$this->flexi_cart_admin->db_column('order_status', 'status')];									
								}
							?>
						</li>
					</ul>
				</fieldset>
					
				<fieldset class="w50">
					<legend>Billing Details</legend>
					<ul>
						<li><span class="spacer_125">Name: </span><?php echo $summary_data['ord_demo_bill_name'];?></li>
						<li><span class="spacer_125">Address 01: </span><?php echo $summary_data['ord_demo_bill_address_01'];?></li>
						<li><span class="spacer_125">Address 02: </span><?php echo $summary_data['ord_demo_bill_address_02'];?></li>
						<li><span class="spacer_125">City / Town: </span><?php echo $summary_data['ord_demo_bill_city'];?></li>
						<li><span class="spacer_125">State / County: </span><?php echo $summary_data['ord_demo_bill_state'];?></li>
						<li><span class="spacer_125">Post / Zip Code: </span><?php echo $summary_data['ord_demo_bill_post_code'];?></li>
						<li><span class="spacer_125">Country: </span><?php echo $summary_data['ord_demo_bill_country'];?></li>
					</ul>
				</fieldset>
				<fieldset class="w50 r_margin">
					<legend>Shipping Details</legend>
					<ul>
						<li><span class="spacer_125">Name: </span><?php echo $summary_data['ord_demo_ship_name'];?></li>
						<li><span class="spacer_125">Address 01: </span><?php echo $summary_data['ord_demo_ship_address_01'];?></li>
						<li><span class="spacer_125">Address 02: </span><?php echo $summary_data['ord_demo_ship_address_02'];?></li>
						<li><span class="spacer_125">City / Town: </span><?php echo $summary_data['ord_demo_ship_city'];?></li>
						<li><span class="spacer_125">State / County: </span><?php echo $summary_data['ord_demo_ship_state'];?></li>
						<li><span class="spacer_125">Post / Zip Code: </span><?php echo $summary_data['ord_demo_ship_post_code'];?></li>
						<li><span class="spacer_125">Country: </span><?php echo $summary_data['ord_demo_ship_country'];?></li>
					</ul>
				</fieldset>
				
				<div class="parallel">
					<fieldset class="w50 parallel_target">
						<legend>Contact Details</legend>
						<ul>
							<li><span class="spacer_125">Email: </span><?php echo $summary_data['ord_demo_email'];?></li>
							<li><span class="spacer_125">Phone: </span><?php echo $summary_data['ord_demo_phone'];?></li>
						<?php if (! empty($summary_data['ord_demo_comments'])) { ?>
							<li><span class="spacer_125">Comments: </span><?php echo $summary_data['ord_demo_comments'];?></li>
						<?php } ?>
						</ul>				
					</fieldset>
					<fieldset class="w50 r_margin parallel_target">
						<legend>Payment Details</legend>
						<ul>
							<li><span class="spacer_125">Currency: </span><?php echo $summary_data[$this->flexi_cart_admin->db_column('order_summary', 'currency_name')];?></li>
							<li><span class="spacer_125">Exchange Rate: </span><?php echo $summary_data[$this->flexi_cart_admin->db_column('order_summary', 'exchange_rate')];?></li>
						</ul>
					</fieldset>
				</div>

				<fieldset>
					<legend>Order Details</legend>
					<small>
						The functionality of this example is entirely optional to the setup of the cart.<br/>
						This example allows an admin to update the quantity of items that have been 'shipped' or 'cancelled' since the order was placed.
						When the cart is setup to manage 'shipped' quantites, earnt reward points are set to only activate 'x' number of days after an item has been marked as 'shipped'.
						Additionally, this example demonstrates how cancelling items or the entire order automatically returns item stock.
					</small>
					
					<table id="cart_items">
						<thead>
							<tr>
								<th>Item</th>
								<th class="spacer_100 align_ctr">Price</th>
								<th class="spacer_100 align_ctr tooltip_trigger"
									title="Indicates the total quantity of items that were ordered.">
									Quantity Ordered
								</th>
								<th class="spacer_100 align_ctr tooltip_trigger"
									title="Indicates the quantity of items that have been marked as 'shipped'. Shipped items activate their associated reward points.">
									Quantity Shipped
								</th>
								<th class="spacer_100 align_ctr tooltip_trigger"
									title="Indicates the quantity of items that have been marked as 'cancelled'. Cancelled items are returned to stock.">
									Quantity Cancelled
								</th>
								<th class="spacer_100 align_ctr">Total</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							if (! empty($item_data)) {
								foreach($item_data as $row) {
									$order_detail_id = $row[$this->flexi_cart_admin->db_column('order_details', 'id')];
						?>
							<tr>
								<td>
									<input type="hidden" name="update_details[<?php echo $order_detail_id;?>][id]" value="<?php echo $order_detail_id;?>"/>
									
									<!-- Item Name -->
									<?php echo $row[$this->flexi_cart_admin->db_column('order_details', 'item_name')];?>

									<!-- Display an item status message if it exists -->
									<?php 
										echo (! empty($row[$this->flexi_cart_admin->db_column('order_details', 'item_status_message')])) ? 
											'<br/><span class="highlight_red">'.$row[$this->flexi_cart_admin->db_column('order_details', 'item_status_message')].'</span>' : NULL; 
									?>
									
									<!-- Display an items options if they exist -->
									<?php 
										echo (! empty($row[$this->flexi_cart_admin->db_column('order_details', 'item_options')])) ? 
											'<br/>'.$row[$this->flexi_cart_admin->db_column('order_details', 'item_options')] : NULL; 
									?>
									
									<!-- 
										Display an items user note if it exists
										Note: This is a optional custom field added to this cart demo and is not defined via the cart config file.
									-->										
									<?php echo (! empty($row['ord_det_demo_user_note'])) ? '<br/>Note: '.$row['ord_det_demo_user_note'] : NULL; ?>
								</td>
								<td class="align_ctr">
								<?php 
									// If an item discount exists.
									if ($row[$this->flexi_cart_admin->db_column('order_details', 'item_discount_quantity')] > 0) 
									{
										// If the quantity of non discounted items is zero, strike out the standard price.
										if ($row[$this->flexi_cart_admin->db_column('order_details', 'item_non_discount_quantity')] == 0)
										{
											echo '<span class="strike">'.$this->flexi_cart_admin->format_currency($row[$this->flexi_cart_admin->db_column('order_details', 'item_price')], TRUE, 2, TRUE).'</span><br/>';
										}
										// Else, display the quantity of items that are at the standard price.
										else
										{
											echo number_format($row[$this->flexi_cart_admin->db_column('order_details', 'item_non_discount_quantity')]).' @ '.
												$this->flexi_cart_admin->format_currency($row[$this->flexi_cart_admin->db_column('order_details', 'item_price')], TRUE, 2, TRUE).'<br/>';
										}
										
										// If there are discounted items, display the quantity of items that are at the discount price.
										if ($row[$this->flexi_cart_admin->db_column('order_details', 'item_discount_quantity')] > 0)
										{
											echo number_format($row[$this->flexi_cart_admin->db_column('order_details', 'item_discount_quantity')]).' @ '.
												$this->flexi_cart_admin->format_currency($row[$this->flexi_cart_admin->db_column('order_details', 'item_discount_price')], TRUE, 2, TRUE);
										}
									}
									// Else, display price as normal.
									else
									{
										echo $this->flexi_cart_admin->format_currency($row[$this->flexi_cart_admin->db_column('order_details', 'item_price')], TRUE, 2, TRUE);
									}
								?>
								</td>
								<td class="align_ctr">
									<?php echo round($row[$this->flexi_cart_admin->db_column('order_details', 'item_quantity')], 2); ?>
								</td>
								<td class="align_ctr">
									<!-- 
										If the status of the order is 'Cancelled', flexi cart functions will not update any submitted 'shipped' and 'cancelled' quantities, until the order is un-cancelled. 
										This demo includes a user interface tweak to disable the select input fields if they cannot be updated.
									-->
									<select name="update_details[<?php echo $order_detail_id;?>][quantity_shipped]" class="width_50" <?php echo ($summary_data[$this->flexi_cart_admin->db_column('order_status', 'cancelled')] == 1) ? 'disabled="disabled"' : NULL; ?>>
										<option value="0">0</option>
									<?php $i=0; do { $i++; ?>
										<option value="<?php echo $i; ?>" <?php echo set_select('update_details['.$order_detail_id.'][quantity_shipped]', $i, ($row[$this->flexi_cart_admin->db_column('order_details', 'item_quantity_shipped')] == $i)); ?>>
											<?php echo $i; ?>
										</option>
									<?php } while($i < $row[$this->flexi_cart_admin->db_column('order_details', 'item_quantity')]); ?>
									</select>
								</td>
								<td class="align_ctr">
									<!-- 
										If the status of the order is 'Cancelled', flexi cart functions will not update any submitted 'shipped' and 'cancelled' quantities, until the order is un-cancelled. 
										This demo includes a user interface tweak to disable the select input fields if they cannot be updated.
									-->
									<select name="update_details[<?php echo $order_detail_id;?>][quantity_cancelled]" class="width_50" <?php echo ($summary_data[$this->flexi_cart_admin->db_column('order_status', 'cancelled')] == 1) ? 'disabled="disabled"' : NULL; ?>>
										<option value="0">0</option>
									<?php $i=0; do { $i++;?>
										<option value="<?php echo $i; ?>" <?php echo set_select('update_details['.$order_detail_id.'][quantity_cancelled]', $i, ($row[$this->flexi_cart_admin->db_column('order_details', 'item_quantity_cancelled')] == $i)); ?>>
											<?php echo $i; ?>
										</option>
									<?php } while($i < $row[$this->flexi_cart_admin->db_column('order_details', 'item_quantity')]); ?>
									</select>
								</td>
								<td class="align_ctr">
								<?php 
									// If an item discount exists, strike out the standard item total and display the discounted item total.
									if ($row[$this->flexi_cart_admin->db_column('order_details', 'item_discount_quantity')] > 0)
									{
										echo '<span class="strike">'.$this->flexi_cart_admin->format_currency($row[$this->flexi_cart_admin->db_column('order_details', 'item_price_total')], TRUE, 2, TRUE).'</span><br/>';
										echo $this->flexi_cart_admin->format_currency($row[$this->flexi_cart_admin->db_column('order_details', 'item_discount_price_total')], TRUE, 2, TRUE);
									}
									// Else, display item total as normal.
									else
									{
										echo $this->flexi_cart_admin->format_currency($row[$this->flexi_cart_admin->db_column('order_details', 'item_price_total')], TRUE, 2, TRUE);
									}
								?>
								</td>
							</tr>
						<?php 
							// If an item discount exists.
							if (! empty($row[$this->flexi_cart_admin->db_column('order_details', 'item_discount_description')])) { 
						?>
							<tr class="discount">
								<td colspan="6">
									Discount: <?php echo $row[$this->flexi_cart_admin->db_column('order_details', 'item_discount_description')];?>
								</td>
							</tr>
						<?php } } } else { ?>
							<tr>
								<td colspan="6" class="empty">
									<h4>! There are no items associated with this order !</h4>
								</td>
							</tr>
						<?php } ?>
						</tbody>
						<tfoot>
						<?php if ($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'item_summary_savings_total')] > 0) { ?>
							<tr class="discount">
								<th colspan="5">Item Summary Discount Total</th> 
								<td class="align_ctr">
								<?php echo $this->flexi_cart_admin->format_currency($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'item_summary_savings_total')], TRUE, 2, TRUE);?></td>
							</tr>
						<?php } ?>
							<tr>
								<th colspan="5">Item Summary Total</th>
								<td class="align_ctr"><?php echo $this->flexi_cart_admin->format_currency($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'item_summary_total')], TRUE, 2, TRUE);?></td>
							</tr>
						</tfoot>
					</table>
					
					<ul class="<?php echo ($summary_data[$this->flexi_cart_admin->db_column('order_status', 'cancelled')] == 1) ? 'order_status_cancelled' : 'order_status_active'; ?>">
						<li>
							<strong class="spacer_125">Update Status:</strong>
							<select name="update_status" class="width_175">
							<?php 
								foreach($status_data as $status) { 
									$id = $status[$this->flexi_cart_admin->db_column('order_status', 'id')];
							?>
								<option value="<?php echo $id; ?>" <?php echo set_select('update_status', $id, ($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'status')] == $id)); ?>>
									<?php echo $status[$this->flexi_cart_admin->db_column('order_status', 'status')]; ?>
								</option>
							<?php } ?>
							</select>
						</li>
					</ul>
					
					<input type="submit" name="update_order" value="Update Order Details" class="link_button large"/>
					<a href="<?php echo $base_url; ?>admin_library/update_order_details/<?php echo $summary_data[$this->flexi_cart_admin->db_column('order_summary', 'order_number')]; ?>" class="link_button grey large">Edit Order</a>
				</fieldset>

				<fieldset>
					<legend>Order Summary</legend>
					<table id="cart_summary">
						<tbody>
							<tr>
								<td>Reward Points Earned</td>
								<td class="spacer_100"><?php echo number_format($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'total_reward_points')]);?> points</td>
							</tr>
							<tr>
								<td>Total Weight</td>
								<td><?php echo number_format($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'total_weight')]);?> grams</td>
							</tr>
							<tr>
								<td>Shipping: <?php echo $summary_data[$this->flexi_cart_admin->db_column('order_summary', 'shipping_name')];?></td>
								<td><?php echo $this->flexi_cart_admin->format_currency($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'shipping_total')], TRUE, 2, TRUE);?></td>
							</tr>

						<!-- Display discounts -->
						<?php if ($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'savings_total')] > 0) { ?>
							<tr class="discount">
								<th>Discount Summary</th>
								<td>&nbsp;</td>
							</tr>
							
							<!-- Item discounts -->
							<?php if ($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'item_summary_savings_total')] > 0) { ?>
							<tr class="discount">
								<td>
									<span class="pad_l_20">
										Item discount savings : <?php echo $this->flexi_cart_admin->format_currency($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'item_summary_savings_total')], TRUE, 2, TRUE);?>
									</span>
								</td>
								<td>&nbsp;</td>
							</tr>
							<?php } ?>	
						
							<!-- Summary discounts -->
							<?php if ($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'summary_savings_total')] > 0) { ?>
							<tr class="discount">
								<td class="pad_l_20">
									<?php echo $summary_data[$this->flexi_cart_admin->db_column('order_summary', 'summary_discount_description')];?>
								</td>
								<td>&nbsp;</td>
							</tr>
							<?php } ?>
						
							<!-- Total of all discounts -->
							<tr class="discount">
								<td>Discount Savings Total</td>
								<td><?php echo $this->flexi_cart_admin->format_currency($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'savings_total')], TRUE, 2, TRUE);?></td>
							</tr>
						<?php } ?>

						<!-- Display summary of all surcharges -->
						<?php if ($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'surcharge_total')] > 0) { ?>
							<tr class="surcharge">
								<th>Surcharge Summary</th>
								<td>&nbsp;</td>
							</tr>
							<tr class="surcharge">
								<td class="pad_l_20">
									<?php echo $summary_data[$this->flexi_cart_admin->db_column('order_summary', 'surcharge_description')];?>
								</td>
								<td>&nbsp;</td>
							</tr>
							<tr class="surcharge">
								<td>Surcharge Total</td>
								<td><?php echo $this->flexi_cart_admin->format_currency($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'surcharge_total')], TRUE, 2, TRUE);?></td>
							</tr>
						<?php } ?>
							
						<!-- Display summary of all reward vouchers -->
						<?php if ($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'reward_voucher_total')] > 0) { ?>
							<tr class="voucher">
								<th>Reward Voucher Summary</th>
								<td>&nbsp;</td>
							</tr>
							<tr class="voucher">
								<td class="pad_l_20">
									<?php echo $summary_data[$this->flexi_cart_admin->db_column('order_summary', 'reward_voucher_description')];?>
								</td>
								<td>&nbsp;</td>
							</tr>
							<tr class="voucher">
								<td>Reward Voucher Total</td>
								<td><?php echo $this->flexi_cart_admin->format_currency($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'reward_voucher_total')], TRUE, 2, TRUE);?></td>
							</tr>
						<?php } ?>								
							
						<!-- Display refund summary -->
						<?php if ($refund_data[$this->flexi_cart_admin->db_column('order_details', 'item_price')] > 0) { ?>
							<tr class="refund">
								<td>
									Refund Cancelled Items 
									<small>
										This value is an  <em class="uline">estimate</em> of the orders total refund value, however, it does not include any percentage based surcharges or discounts that may have been applied to the orders summary values. The grand total below does not include this refund.
									</small>
								</td>
								<td>
								<?php
									if ($refund_data[$this->flexi_cart_admin->db_column('order_details', 'item_discount_price')] > 0)
									{
										echo $this->flexi_cart_admin->format_currency($refund_data[$this->flexi_cart_admin->db_column('order_details', 'item_discount_price')], TRUE, 2, TRUE);
									}
									else
									{
										echo $this->flexi_cart_admin->format_currency($refund_data[$this->flexi_cart_admin->db_column('order_details', 'item_price')], TRUE, 2, TRUE);
									}
								?>
								</td>
							</tr>
						<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<th>Sub Total (ex. tax)</th>
								<td><?php echo $this->flexi_cart_admin->format_currency($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'sub_total')], TRUE, 2, TRUE);?></td>
							</tr>
							<tr>
								<th>
									<?php echo 'Tax @ '.$summary_data[$this->flexi_cart_admin->db_column('order_summary', 'tax_rate')].'%';?>
								</th>
								<td><?php echo $this->flexi_cart_admin->format_currency($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'tax_total')], TRUE, 2, TRUE);?></td>
							</tr>
							<tr class="grand_total">
								<th>Grand Total</th>
								<td><?php echo $this->flexi_cart_admin->format_currency($summary_data[$this->flexi_cart_admin->db_column('order_summary', 'total')], TRUE, 2, TRUE);?></td>
							</tr>
						</tfoot>
					</table>
				</fieldset>
			<?php echo form_close(); ?>

		</div>
	</div>
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>