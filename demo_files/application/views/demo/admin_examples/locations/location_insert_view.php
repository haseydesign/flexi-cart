<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Insert Location | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts insert location function."/> 
	<meta name="keywords" content="insert, location, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="location_insert">

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
				<h1>Insert New <?php echo $location_type_data[$this->flexi_cart_admin->db_column('location_type', 'name')]; ?> Locations</h1>
				<p>
					<a href="<?php echo $base_url; ?>admin_library/location_types">Manage Location Types</a> | 
					<a href="<?php echo $base_url; ?>admin_library/locations/<?php echo $location_type_data[$this->flexi_cart_admin->db_column('location_type', 'id')]; ?>">Manage <?php echo $location_type_data[$this->flexi_cart_admin->db_column('location_type', 'name')]; ?></a>
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
							<th class="spacer_125 align_ctr tooltip_trigger" 
								title="Copy or remove a specific row and its data.">
								Copy / Remove
							</th>
						</tr>
					</thead>
					<tbody>						
					<?php 
						for($i = 0; ($i == 0 || (isset($validation_row_ids[$i]))); $i++) { 
							$row_id = (isset($validation_row_ids[$i])) ? $validation_row_ids[$i] : $i;
					?>
						<tr>
							<td>
								<input type="text" name="insert[<?php echo $row_id; ?>][name]" value="<?php echo set_value('insert['.$row_id.'][name]');?>" class="width_150"/>
							</td>
							<td>
								<select name="insert[<?php echo $row_id; ?>][parent_location]" class="width_150">
									<option value="0">No Parent Location</option>
								<?php 
									foreach($locations_inline as $location) { 
										$id = $location[$this->flexi_cart_admin->db_column('locations', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('insert['.$row_id.'][parent_location]', $id); ?>>
										<?php echo $location[$this->flexi_cart_admin->db_column('locations', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td>
								<select name="insert[<?php echo $row_id; ?>][shipping_zone]" class="width_150">
									<option value="0">No Shipping Zone</option>
								<?php 
									foreach($shipping_zones as $zone) { 
										$id = $zone[$this->flexi_cart_admin->db_column('location_zones', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('insert['.$row_id.'][shipping_zone]', $id); ?>>
										<?php echo $zone[$this->flexi_cart_admin->db_column('location_zones', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td>
								<select name="insert[<?php echo $row_id; ?>][tax_zone]" class="width_150">
									<option value="0">No Tax Zone</option>
								<?php 
									foreach($tax_zones as $zone) { 
										$id = $zone[$this->flexi_cart_admin->db_column('location_zones', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('insert['.$row_id.'][tax_zone]', $id); ?>>
										<?php echo $zone[$this->flexi_cart_admin->db_column('location_zones', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td class="align_ctr">
								<input type="hidden" name="insert[<?php echo $row_id; ?>][status]" value="0"/>
								<input type="checkbox" name="insert[<?php echo $row_id; ?>][status]" value="1" <?php echo set_checkbox('insert['.$row_id.'][status]', 1, TRUE); ?>/>
							</td>
							<td class="align_ctr">
								<input type="button" value="+" class="copy_row link_button"/>
								<input type="button" value="x" <?php echo ($i == 0) ? 'disabled="disabled"' : NULL;?> class="remove_row link_button"/>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6">
								<input type="submit" name="insert_location" value="Insert New <?php echo $location_type_data[$this->flexi_cart_admin->db_column('location_type', 'name')]; ?> Locations" class="link_button large"/>
							</td>
						</tr>
					</tbody>
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