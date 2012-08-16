<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Update Item Tax Rate | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update item tax rate function."/> 
	<meta name="keywords" content="update, item tax rate, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="item_tax_update">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Item Tax Rates</h1>
				<p>Tax rates for individual items can be set with a different tax rate than what is currently used be the cart.</p>
				<p>This for example would allow specific items to be tax free, whilst all other items remain at the default cart tax rate.</p>
				<p>The tax rate for each item can also be set accordingly to a customers location.</p>
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
				<h1>Manage Item Tax Rates</h1>
				<p>
					<a href="<?php echo $base_url; ?>admin_library/items">Manage Items</a> | 
					<a href="<?php echo $base_url; ?>admin_library/insert_item_tax/<?php echo $item_data['item_id']; ?>">Insert New Item Tax Rates</a>
				</p>
				
				<table>
					<caption><?php echo $item_data['item_name']; ?></caption>
					<thead>
						<tr>
							<th class="tooltip_trigger" 
								title="Set the location that the tax rate is applied to.">
								Location
							</th>
							<th class="tooltip_trigger" 
								title="Set the zone that the tax rate is applied to. <br/>Note: If a location is set, it has priority over a zone rule.">
								Zone
							</th>
							<th class="spacer_125 info_req tooltip_trigger"
								title="<strong>Field required</strong><br/>The tax rate percentage the item incurs to the selected location/zone.">
								Rate (%)
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger" 
								title="If checked, the tax rate will be set as 'active'.">
								Status
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger" 
								title="If checked, the row will be deleted upon the form being updated.">
								Delete
							</th>
						</tr>
					</thead>
				<?php if (! empty($item_tax_data)) { ?>	
					<tbody>
					<?php 
						foreach ($item_tax_data as $row) {
							$item_tax_id = $row[$this->flexi_cart_admin->db_column('item_tax', 'id')];								
					?>
						<tr>
							<td>
								<input type="hidden" name="update[<?php echo $item_tax_id; ?>][id]" value="<?php echo $row[$this->flexi_cart_admin->db_column('item_tax', 'id')]?>"/>
								
								<?php $tax_location = $row[$this->flexi_cart_admin->db_column('item_tax', 'location')];?>
								<select name="update[<?php echo $item_tax_id; ?>][location]" class="width_175">
									<option value="0">No Tax Location</option>
								<?php 
									foreach($locations_inline as $location) { 
										$id = $location[$this->flexi_cart_admin->db_column('locations', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('update['.$item_tax_id.'][location]', $id, ($tax_location == $id)); ?>>
										<?php echo $location[$this->flexi_cart_admin->db_column('locations', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td>
								<?php $tax_zone = $row[$this->flexi_cart_admin->db_column('item_tax', 'zone')];?>
								<select name="update[<?php echo $item_tax_id; ?>][zone]" class="width_175">
									<option value="0">No Tax Zone</option>
								<?php 
									foreach($tax_zones as $zone) { 
										$id = $zone[$this->flexi_cart_admin->db_column('location_zones', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('update['.$item_tax_id.'][zone]', $id, ($tax_zone == $id)); ?>>
										<?php echo $zone[$this->flexi_cart_admin->db_column('location_zones', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td>
								<input type="text" name="update[<?php echo $item_tax_id; ?>][rate]" value="<?php echo set_value('update['.$item_tax_id.'][rate]', $row[$this->flexi_cart_admin->db_column('item_tax', 'rate')]); ?>" class="width_75 validate_decimal"/>
							</td>
							<td class="align_ctr">
								<?php $status = (bool)$row[$this->flexi_cart_admin->db_column('item_tax', 'status')]; ?>
								<input type="hidden" name="update[<?php echo $item_tax_id; ?>][status]" value="0"/>
								<input type="checkbox" name="update[<?php echo $item_tax_id; ?>][status]" value="1" <?php echo set_checkbox('update['.$item_tax_id.'][status]','1', $status); ?>/>
							</td>
							<td class="align_ctr">
								<input type="hidden" name="update[<?php echo $item_tax_id; ?>][delete]" value="0"/>
								<input type="checkbox" name="update[<?php echo $item_tax_id; ?>][delete]" value="1"/>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5">
								<input type="submit" name="update_item_tax" value="Update Item Tax" class="link_button large"/>
							</td>
						</tr>
					</tfoot>
				<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="5">
								There are no taxes setup to view for this item.<br/>
								<a href="<?php echo $base_url; ?>admin_library/insert_item_tax/<?php echo $item_data['item_id']; ?>">Insert New Item Tax Rates</a>
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