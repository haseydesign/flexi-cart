<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Update Location | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update location function."/> 
	<meta name="keywords" content="update, location, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="location_update">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Locations</h1>
				<p>Locations are directly related as children to 'Location Types'. For each location type, an unlimited number of locations can be set.</p>
				<p>For example, a location type of 'Country' would list all countries that the cart is setup to do business with.<br/>
				Specific shipping, tax and discount rules can then be applied to these countries (If they differ from the carts default values).</p>
				<p>Each location can also be related to a higher tiered location, for example, a state location of 'New York' would be related to a country location of 'United States'. This enables a chaining method where all rules applied to the 'United States' are passed on to 'New York', but rules to 'New York' are not passed up to 'United States'.</p>
				<p>Sometimes a location may need to be grouped with other locations, but trying to relate them using the parent-to-child relationship is not practical. <br/>
				For example, if you created an 'EU' tax rule, you would not be able to apply it to a location of 'Europe' as not all European countries are in the 'EU'. So instead, we can create a <a href="<?php echo $base_url; ?>admin_library/zones">Zone</a> called 'Tax EU Zone', we can then assign independent countries to this zone that will now inherit a defined EU tax rate.
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
				<h1>Manage <?php echo $location_type_data[$this->flexi_cart_admin->db_column('location_type', 'name')]; ?> Locations</h1>
				<p>
					<a href="<?php echo $base_url; ?>admin_library/location_types">Manage Location Types</a> | 
					<a href="<?php echo $base_url; ?>admin_library/insert_location/<?php echo $location_type_data[$this->flexi_cart_admin->db_column('location_type', 'id')]; ?>">Insert New <?php echo $location_type_data[$this->flexi_cart_admin->db_column('location_type', 'name')]; ?></a>
				</p>
				
				<table>
					<thead>
						<tr>
							<th class="info_req tooltip_trigger"
								title="<strong>Field Required</strong><br/>Name of the location.">
								Name
							</th>
							<th class="tooltip_trigger"
								title="Sets the locations 'Parent'. <br/>For Example, 'New York' would have 'United States' as its parent.">
								Parent Location
							</th>
							<th class="tooltip_trigger"
								title="Locations can be grouped together with other non-related locations into Shipping Zones. Shipping rates can then be applied to all locations within these zones. <br/>For example, 'Eastern Europe' and 'Western Europe'.">
								Shipping Zone
							</th>
							<th class="tooltip_trigger"
								title="Locations can be grouped together with other non-related locations into Tax Zones. Tax rates can then be applied to all locations within these zones. <br/>For example, 'European EU Countries' and 'European Non-EU Countries'.">
								Tax Zone
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger" 
								title="If checked, the location will be set as 'active'.">
								Status
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger" 
								title="If checked, the row will be deleted upon the form being updated.">
								Delete
							</th>
						</tr>
					</thead>
				<?php if (! empty($location_data)) { ?>	
					<tbody>
					<?php 
						foreach ($location_data as $row) {
							$location_id = $row[$this->flexi_cart_admin->db_column('locations', 'id')];								
					?>
						<tr>
							<td>
								<input type="hidden" name="update[<?php echo $location_id; ?>][id]" value="<?php echo $location_id; ?>"/>
								<input type="text" name="update[<?php echo $location_id; ?>][name]" value="<?php echo set_value('update['.$location_id.'][name]', $row[$this->flexi_cart_admin->db_column('locations', 'name')]); ?>" class="width_150"/>
							</td>
							<td>
								<?php $parent_location = $row[$this->flexi_cart_admin->db_column('locations', 'parent')];?>
								<select name="update[<?php echo $location_id; ?>][parent_location]" class="width_150">
									<option value="0">No Parent Location</option>
								<?php 
									foreach($locations_inline as $location) { 
										$id = $location[$this->flexi_cart_admin->db_column('locations', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('update['.$location_id.'][parent_location]', $id, ($parent_location == $id)); ?>>
										<?php echo $location[$this->flexi_cart_admin->db_column('locations', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td>
								<?php $shipping_zone = $row[$this->flexi_cart_admin->db_column('locations', 'shipping_zone')];?>
								<select name="update[<?php echo $location_id; ?>][shipping_zone]" class="width_150">
									<option value="0">No Shipping Zone</option>
								<?php 
									foreach($shipping_zones as $zone) { 
										$id = $zone[$this->flexi_cart_admin->db_column('location_zones', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('update['.$location_id.'][shipping_zone]', $id, ($shipping_zone == $id)); ?>>
										<?php echo $zone[$this->flexi_cart_admin->db_column('location_zones', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td>
								<?php $tax_zone = $row[$this->flexi_cart_admin->db_column('locations', 'tax_zone')];?>
								<select name="update[<?php echo $location_id; ?>][tax_zone]" class="width_150">
									<option value="0">No Tax Zone</option>
								<?php 
									foreach($tax_zones as $zone) { 
										$id = $zone[$this->flexi_cart_admin->db_column('location_zones', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('update['.$location_id.'][tax_zone]', $id, ($tax_zone == $id)); ?>>
										<?php echo $zone[$this->flexi_cart_admin->db_column('location_zones', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td class="align_ctr">
								<?php $status = (bool)$row[$this->flexi_cart_admin->db_column('locations', 'status')]; ?>
								<input type="hidden" name="update[<?php echo $location_id; ?>][status]" value="0"/>
								<input type="checkbox" name="update[<?php echo $location_id; ?>][status]" value="1" <?php echo set_checkbox('update['.$location_id.'][status]', 0, $status); ?>/>
							</td>
							<td class="align_ctr">
								<input type="hidden" name="update[<?php echo $location_id; ?>][delete]" value="0"/>
								<input type="checkbox" name="update[<?php echo $location_id; ?>][delete]" value="1"/>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6">
								<input type="submit" name="update_locations" value="Update <?php echo $location_type_data['loc_type_name']; ?> Locations" class="link_button large"/>
							</td>
						</tr>
					</tfoot>
				<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="6">
								There are no locations within this location type setup to view.<br/>
								<a href="<?php echo $base_url; ?>admin_library/insert_location/<?php echo $location_type_data[$this->flexi_cart_admin->db_column('location_type', 'id')]; ?>">Insert New <?php echo $location_type_data[$this->flexi_cart_admin->db_column('location_type', 'name')]; ?></a>
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