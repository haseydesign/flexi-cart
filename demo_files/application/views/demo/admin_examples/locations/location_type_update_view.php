<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Update Location Type | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update location type function."/> 
	<meta name="keywords" content="update, location type, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="location_type_update">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Location Types</h1>
				<p>Location Types are intended to group locations into tiers, i.e. Country > State > Post/Zip Code.</p>
				<p>These tiers can then be targeted by shipping, tax and discount rules so that customers within those locations will be displayed prices and options that are available specifically to that location.</p>
				<p>For example, tax rates are different per country, state and even post/zip code, when a customer indicates to the cart their location, cart prices can then be adjusted to their local tax rate. 
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
				<h1>Manage Location Types</h1>
				<p><a href="<?php echo $base_url; ?>admin_library/insert_location_type">Insert New Location Type</a></p>
					
				<table>
					<thead>
						<tr>
							<th class="spacer_250 info_req tooltip_trigger"
								title="<strong>Field Required</strong><br/>The name for the type of locations that will be related. <br/>For example, 'Country', 'State' etc.">
								Location Type
							</th>
							<th class="tooltip_trigger"
								title="Sets the location types 'Parent'. <br/>For Example, 'State' would have 'Country' as its parent.">
								Parent Location Type 
							</th>
							<th class="spacer_175 align_ctr tooltip_trigger"
								title="Manage and Insert locations related to the location type.">
								Related Locations
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger" 
								title="If checked, the row will be deleted upon the form being updated.">
								Delete
							</th>
						</tr>
					</thead>
				<?php if (! empty($location_type_data)) { ?>	
					<tbody>
					<?php 						
						foreach ($location_type_data as $row) {
							$location_type_id = $row[$this->flexi_cart_admin->db_column('location_type', 'id')];
					?>
						<tr>
							<td>
								<input type="hidden" name="update[<?php echo $location_type_id; ?>][id]" value="<?php echo $location_type_id; ?>"/>
								<input type="text" name="update[<?php echo $location_type_id; ?>][name]" value="<?php echo set_value('update['.$location_type_id.'][name]', $row[$this->flexi_cart_admin->db_column('location_type', 'name')]); ?>" class="width_200 validate_alpha"/>
							</td>
							<td>
								<?php $parent_location_type = $row[$this->flexi_cart_admin->db_column('location_type', 'parent')];?>
								<select name="update[<?php echo $location_type_id; ?>][parent_location_type]" class="width_200">
									<option value="0">No Parent Location Type</option>
								<?php 
									foreach($location_type_data as $location_type) { 
										$id = $location_type[$this->flexi_cart_admin->db_column('location_type', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('update['.$location_type_id.'][parent_location_type]', $id, ($parent_location_type == $id)); ?>>
										<?php echo $location_type[$this->flexi_cart_admin->db_column('location_type', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td class="align_ctr">
								<a href="<?php echo $base_url; ?>admin_library/locations/<?php echo $location_type_id;?>">Manage</a> | 
								<a href="<?php echo $base_url; ?>admin_library/insert_location/<?php echo $location_type_id;?>">Insert New</a> 
							</td>
							<td class="align_ctr">
								<input type="hidden" name="update[<?php echo $location_type_id; ?>][delete]" value="0"/>
								<input type="checkbox" name="update[<?php echo $location_type_id; ?>][delete]" value="1"/>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4">
								<input type="submit" name="update_location_types" value="Update Location Types" class="link_button large"/>
							</td>
						</tr>
					</tfoot>
				<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="4">
								There are no location types setup to view.<br/>
								<a href="<?php echo $base_url; ?>admin_library/insert_location_type">Insert New Location Type</a>
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