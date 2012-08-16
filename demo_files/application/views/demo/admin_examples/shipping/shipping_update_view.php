<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Update Shipping Options | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update shipping options function."/> 
	<meta name="keywords" content="update, shipping options, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="shipping_update">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Shipping Options</h1>
				<p>Shipping Options can be setup to offer specific shipping options accordingly to a customers location.</p>
				<p>When targeting a specific location, the shipping option can be either applied to a specific location, or a location zone. Shipping Options that are applied to a location, are then inherited by all children of that location.</p>
				<p>Using the default setup of this cart demo as an example, any customer that specifies their location as 'United States' will be shown only options available for shipping to the 'United States'.</p>
				<p>If the customer was then to specify their State as 'California', they will only be shown shipping options to 'California' - because there are options defined for 'California'. However, if they specify 'Florida' they will still be shown the 'United States' shipping as no options are defined for 'Florida'.</p>
				<p>For added flexibility against complex tax rules, a specific tax rate can be applied to the shipping rate that will override the tax rate used by the cart.</p>
				<p>Shipping options can be included/excluded from cart discounts.</p>
				<p>Within each shipping option, a set of rate tiers can be defined to charge a different price depending on the carts total value and weight.</p>
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
				<h1>Manage Shipping Options</h1>
				<p><a href="<?php echo $base_url; ?>admin_library/insert_shipping">Insert New Shipping Option</a></p>
				
				<table>
					<thead>
						<tr>
							<th class="info_req tooltip_trigger"
								title="<strong>Name Field Required</strong><br/>The name and a short description of the shipping option.">
								Option Name / <br/>Description
							</th>
							<th class="tooltip_trigger"
								title="Set the location that the shipping option is applied to.">
								Location
							</th>
							<th class="tooltip_trigger"
								title="Set the zone that the shipping option is applied to. <br/>Note: If a location is set, it has priority over a zone rule.">
								Zone
							</th>
							<th class="align_ctr tooltip_trigger"
								title="If checked, sets whether the shipping option is displayed with options that are available for more specific locations. <br/>For example, if checked for 'United States', the option will also be displayed with 'New York' options.">
								Inc. Sub Locations
							</th>
							<th class="align_ctr tooltip_trigger"
								title="Manage the shipping rate tiers within the shipping option.">
								Shipping Rates
							</th>
							<th class="align_ctr tooltip_trigger"
								title="Sets the tax rate charged on the total value of shipping, but not the tax rate of any other values within the cart. <br/>Note: Leave blank to use the default cart tax rate.">
								Tax Rate (%)
							</th>
							<th class="align_ctr tooltip_trigger"
								title="If checked, sets whether the shipping option can be included in cart discounts. <br/>For example, a 10% discount on the cart value could be excluded from including the shipping value.">
								Discount
							</th>
							<th class="align_ctr tooltip_trigger" 
								title="If checked, the shipping option will be set as 'active'.">
								Status
							</th>
							<th class="align_ctr tooltip_trigger" 
								title="If checked, the row will be deleted upon the form being updated.">
								Delete
							</th>
						</tr>
					</thead>
				<?php if (! empty($shipping_data)) { ?>	
					<tbody>
					<?php 
						foreach ($shipping_data as $row) {
							$shipping_id = $row[$this->flexi_cart_admin->db_column('shipping_options', 'id')];
					?>
						<tr>
							<td>
								<input type="hidden" name="update[<?php echo $shipping_id; ?>][id]" value="<?php echo $shipping_id; ?>"/>
								<input type="text" name="update[<?php echo $shipping_id; ?>][name]" value="<?php echo set_value('update['.$shipping_id.'][name]', $row[$this->flexi_cart_admin->db_column('shipping_options', 'name')]); ?>" class="width_125"/><br/>
								<textarea name="update[<?php echo $shipping_id; ?>][description]" class="width_125"><?php echo set_value('update['.$shipping_id.'][description]', $row[$this->flexi_cart_admin->db_column('shipping_options', 'description')]); ?></textarea>
							</td>
							<td>
							<?php 
								$shipping_location = $row[$this->flexi_cart_admin->db_column('shipping_options', 'location')];
								foreach($locations_tiered as $location_type => $locations) { 
							?>
								<select name="update[<?php echo $shipping_id; ?>][location][]" id="shipping_<?php echo strtolower(url_title($location_type.'_'.$shipping_id, 'underscore'));?>" class="width_150">
									<option value="0" class="parent_id_0">- Select <?php echo $location_type; ?> -</option>
								<?php 
									// Note: CI's set_select() function does not return the empty '[]' from the name 'insert_option[location][]'.
									// Therefore, ensure it is set as "set_select('insert_option[location]', $id)".
									foreach($locations as $location) { 
										$id = $location[$this->flexi_cart_admin->db_column('locations', 'id')];
								?>
									<option value="<?php echo $id; ?>" class="parent_id_<?php echo $location[$this->flexi_cart_admin->db_column('locations', 'parent')]; ?>" <?php echo set_select('update['.$shipping_id.'][location]', $id, ($shipping_location == $id)); ?>>
										<?php echo $location[$this->flexi_cart_admin->db_column('locations', 'name')]; ?>
									</option>
								<?php } ?>
								</select><br/>
							<?php } ?>
							</td>
							<td>
								<?php $shipping_zone = $row[$this->flexi_cart_admin->db_column('shipping_options', 'zone')];?>
								<select name="update[<?php echo $shipping_id; ?>][zone]" class="width_150">
									<option value="0">No Shipping Zone</option>
								<?php 
									foreach($shipping_zones as $zone) { 
										$id = $zone[$this->flexi_cart_admin->db_column('location_zones', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('update['.$shipping_id.'][zone]', $id, ($shipping_zone == $id)); ?>>
										<?php echo $zone[$this->flexi_cart_admin->db_column('location_zones', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td class="align_ctr">
								<?php $inc_sub_locations = (bool)$row[$this->flexi_cart_admin->db_column('shipping_options', 'inc_sub_locations')]; ?>
								<input type="hidden" name="update[<?php echo $shipping_id; ?>][inc_sub_locations]" value="0"/>
								<input type="checkbox" name="update[<?php echo $shipping_id; ?>][inc_sub_locations]" value="1" <?php echo set_checkbox('update['.$shipping_id.'][inc_sub_locations]','1', $inc_sub_locations); ?>/>
							</td>
							<td class="align_ctr">
								<a href="<?php echo $base_url; ?>admin_library/shipping_rates/<?php echo $shipping_id;?>">Manage</a>
								<br/>-<br/>
								<a href="<?php echo $base_url; ?>admin_library/insert_shipping_rate/<?php echo $shipping_id;?>">Insert New Rates</a> 
							</td>
							<td class="align_ctr">
								<input type="text" name="update[<?php echo $shipping_id; ?>][tax_rate]" value="<?php echo set_value('update['.$shipping_id.'][tax_rate]', $row[$this->flexi_cart_admin->db_column('shipping_options', 'tax_rate')]); ?>" placeholder="Default" class="width_50 validate_decimal"/>
							</td>
							<td class="align_ctr">
								<?php $discount_inclusion = (bool)$row[$this->flexi_cart_admin->db_column('shipping_options', 'discount_inclusion')]; ?>
								<input type="hidden" name="update[<?php echo $shipping_id; ?>][discount_inclusion]" value="0"/>
								<input type="checkbox" name="update[<?php echo $shipping_id; ?>][discount_inclusion]" value="1" <?php echo set_checkbox('update['.$shipping_id.'][discount_inclusion]','1', $discount_inclusion); ?>/>
							</td>
							<td class="align_ctr">
								<?php $status = (bool)$row[$this->flexi_cart_admin->db_column('shipping_options', 'status')]; ?>
								<input type="hidden" name="update[<?php echo $shipping_id; ?>][status]" value="0"/>
								<input type="checkbox" name="update[<?php echo $shipping_id; ?>][status]" value="1" <?php echo set_checkbox('update['.$shipping_id.'][status]','1', $status); ?>/>
							</td>
							<td class="align_ctr">
								<input type="hidden" name="update[<?php echo $shipping_id; ?>][delete]" value="0"/>
								<input type="checkbox" name="update[<?php echo $shipping_id; ?>][delete]" value="1"/>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="9">
								<input type="submit" name="update_shipping" value="Update Shipping Options" class="link_button large"/>
							</td>
						</tr>
					</tfoot>
				<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="9">
								There are no shipping options setup to view.<br/>
								<a href="<?php echo $base_url; ?>admin_library/insert_shipping">Insert New Shipping Option</a>
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
<script>
$(function() {
	// As this page is listing multiple tax options all on the same page, and therefore multiple location menus, use the jQuery 'each()' function to call the top level menu of each location type ('Country' in this example). 
	$('select[id^="shipping_country"]').each(function() 
	{
		var elem_id = $(this).attr('id');
		var shipping_id = elem_id.substring(elem_id.lastIndexOf('_')+1);
	
		// !IMPORTANT NOTE: The dependent_menu functions must be called in their reverse order - i.e. the most specific locations first.
		dependent_menu('shipping_state_'+shipping_id, 'shipping_post_zip_code_'+shipping_id, false, true);
		dependent_menu('shipping_country_'+shipping_id, 'shipping_state_'+shipping_id, ['shipping_post_zip_code_'+shipping_id], true);
	});
});
</script>

</body>
</html>