<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Update Item Shipping Rules | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update item shipping rules function."/> 
	<meta name="keywords" content="update, item shipping rules, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="item_shipping_update">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Item Shipping Rules</h1>
				<p>Shipping rates and rules for individual items can be set that can either omit the item from being included in the cart shipping calculations, or add a shipping surcharge that will be applied on top of the standard shipping charge.</p>
				<p>This allows specific items to have free shipping, whilst items with a higher insurance value could have a surcharge applied. These shipping rules can also be applied accordingly to a customers location</p>
				<p>Items can also be set to be shipped separately from the rest of the cart items, this will then calculate the shipping charge for that specific item, and then recalculate the shipping charge for the rest of the cart items.</p>
				<p>Additionally, items can be banned from being shipped to specific locations, by either 'whitelisting' or 'blacklisting' a location. <br/>Whitelisting means the item can ONLY be shipped to that location, whilst blacklisting means it CANNOT be shipped to that location.<br/> All sub-locations of a listed location will also be affected.</p>
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
						
			<?php echo form_open(current_url());?>						
				<h1>Manage Item Shipping Rules</h1>
				<p>
					<a href="<?php echo $base_url; ?>admin_library/items">Manage Items</a> | 
					<a href="<?php echo $base_url; ?>admin_library/insert_item_shipping/<?php echo $item_data['item_id']; ?>">Insert New Item Shipping Rules</a>
				</p>
				
				<table>
					<caption><?php echo $item_data['item_name']; ?></caption>
					<thead>
						<tr>
							<th class="tooltip_trigger" 
								title="Set the location that the shipping rule is applied to.">
								Location
							</th>
							<th class="tooltip_trigger" 
								title="Set the zone that the shipping rule is applied to. <br/>Note: If a location is set, it has priority over a zone.">
								Zone
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger" 
								title="The rate the item costs to ship to the selected location/zone. <br/>Note:Leave blank (Not '0') if not setting a rate.">
								Shipping Rate (&pound;)
							</th>
							<th class="spacer_150 align_ctr tooltip_trigger" 
								title="Set whether an item is 'Whitelisted' (Only permitted) or 'Blacklisted' (Not permitted) to being shipped to a location. <br/>If set as 'Location Not Banned', the item can be shipped to all locations.">
								Shipping Ban Status
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger" 
								title="If checked, the cart will calculate the items shipping separate from the rest of the cart, and then add the cost to the final shipping charge.">
								Ship Seperate
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger" 
								title="If checked, the shipping rule will be set as 'active'.">
								Status
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger" 
								title="If checked, the row will be deleted upon the form being updated.">
								Delete
							</th>
						</tr>
					</thead>
				<?php if (! empty($item_shipping_data)) { ?>	
					<tbody>
					<?php 
						foreach ($item_shipping_data as $row) {
							$item_shipping_id = $row[$this->flexi_cart_admin->db_column('item_shipping', 'id')];								
					?>
						<tr>
							<td>
								<input type="hidden" name="update[<?php echo $item_shipping_id; ?>][id]" value="<?php echo $row[$this->flexi_cart_admin->db_column('item_shipping', 'id')]?>"/>
								
								<?php $shipping_location = $row[$this->flexi_cart_admin->db_column('item_shipping', 'location')];?>
								<select name="update[<?php echo $item_shipping_id; ?>][location]" class="width_175">
									<option value="0">No Shipping Location</option>
								<?php 
									foreach($locations_inline as $location) { 
										$id = $location[$this->flexi_cart_admin->db_column('locations', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('update['.$item_shipping_id.'][location]', $id, ($shipping_location == $id)); ?>>
										<?php echo $location[$this->flexi_cart_admin->db_column('locations', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td>
								<?php $shipping_zone = $row[$this->flexi_cart_admin->db_column('item_shipping', 'zone')];?>
								<select name="update[<?php echo $item_shipping_id; ?>][zone]" class="width_175">
									<option value="0">No Shipping Zone</option>
								<?php 
									foreach($shipping_zones as $zone) { 
										$id = $zone[$this->flexi_cart_admin->db_column('location_zones', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('update['.$item_shipping_id.'][zone]', $id, ($shipping_zone == $id));?>>
										<?php echo $zone[$this->flexi_cart_admin->db_column('location_zones', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td>
								<input type="text" name="update[<?php echo $item_shipping_id; ?>][value]" value="<?php echo $row[$this->flexi_cart_admin->db_column('item_shipping', 'value')]?>" placeholder="NULL" class="width_75"/>
							</td>
							<td class="align_ctr">
								<?php $ship_banned = $row[$this->flexi_cart_admin->db_column('item_shipping', 'banned')]; ?>
								<select name="update[<?php echo $item_shipping_id; ?>][banned]" class="width_150">
									<option value="0" <?php echo set_select('update['.$item_shipping_id.'][banned]', 0, ($ship_banned == 0));?>>Location Not Banned</option>
									<option value="1" <?php echo set_select('update['.$item_shipping_id.'][banned]', 1, ($ship_banned == 1));?>>Whitelist Location</option>
									<option value="2" <?php echo set_select('update['.$item_shipping_id.'][banned]', 2, ($ship_banned == 2));?>>Blacklist Location</option>
								</select>
							</td>
							<td class="align_ctr">
								<?php $ship_separate = (bool)$row[$this->flexi_cart_admin->db_column('item_shipping', 'separate')]; ?>
								<input type="hidden" name="update[<?php echo $item_shipping_id; ?>][separate]" value="0"/>
								<input type="checkbox" name="update[<?php echo $item_shipping_id; ?>][separate]" value="1" <?php echo set_checkbox('update['.$item_shipping_id.'][ship_separate]','1', $ship_separate); ?>/>
							</td>
							<td class="align_ctr">
								<?php $status = (bool)$row[$this->flexi_cart_admin->db_column('item_shipping', 'status')]; ?>
								<input type="hidden" name="update[<?php echo $item_shipping_id; ?>][status]" value="0"/>
								<input type="checkbox" name="update[<?php echo $item_shipping_id; ?>][status]" value="1" <?php echo set_checkbox('update['.$item_shipping_id.'][status]','1', $status); ?>/>
							</td>
							<td class="align_ctr">
								<input type="hidden" name="update[<?php echo $item_shipping_id; ?>][delete]" value="0"/>
								<input type="checkbox" name="update[<?php echo $item_shipping_id; ?>][delete]" value="1"/>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="7">
								<input type="submit" name="update_item_shipping" value="Update Item Shipping Rules" class="link_button large"/>
							</td>
						</tr>
					</tfoot>
				<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="7">
								There are no shipping rules setup to view for this item.<br/>
								<a href="<?php echo $base_url; ?>admin_library/insert_item_shipping/<?php echo $item_data['item_id']; ?>">Insert New Item Shipping Rules</a>
							</td>
						</tr>
					</tbody>
				<?php } ?>
				</table>					
			<?php echo form_close();?>

		</div>
	</div>
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>