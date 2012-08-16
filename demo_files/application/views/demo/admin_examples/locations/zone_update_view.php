<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Update Location Zones | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update location zones function."/> 
	<meta name="keywords" content="update, location zones, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="zone_update">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Location Zones</h1>
				<p>Location Zones have a one-to-many relationship with Locations.</p>
				<p>The purpose of zones is to allow the grouping of locations that would otherwise be impractical using the parent-to-child relationship offered by the location type tiers. For example, if you wanted to create an 'EU' tax rule, you would not be able to apply it to a location of 'Europe' as not all European countries are in the 'EU'. So instead, we can create a zone called 'Tax EU Zone', we can then assign independent countries to this zone that will now inherit a defined 'EU' tax rate.</p>
				<p>Zones can be setup to include any assortment of locations across all location type tiers, for example, a country could be added to the same zone that was related to a specific post/zip code location.</p>
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
				<h1>Location Zones</h1>
				<p><a href="<?php echo $base_url; ?>admin_library/insert_zone">Insert New Zone</a></p>

				<table>
					<thead>
						<tr>
							<th class="info_req tooltip_trigger"
								title="<strong>Field Required</strong><br/>The name of the zone.">
								Name
							</th>
							<th class="tooltip_trigger"
								title="A brief description of the purpose of the zone and the regions covered.">
								Description
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger" 
								title="If checked, the zone will be set as 'active'.">
								Status
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger" 
								title="If checked, the row will be deleted upon the form being updated.">
								Delete
							</th>
						</tr>
					</thead>
				<?php if (! empty($location_zone_data)) { ?>	
					<tbody>
					<?php 						
						foreach ($location_zone_data as $row) {
							$location_zone_id = $row[$this->flexi_cart_admin->db_column('location_zones', 'id')];
					?>
						<tr>
							<td>
								<input type="hidden" name="update[<?php echo $location_zone_id; ?>][id]" value="<?php echo $location_zone_id; ?>"/>
								<input type="text" name="update[<?php echo $location_zone_id; ?>][name]" value="<?php echo set_value('update['.$location_zone_id.'][name]',$row[$this->flexi_cart_admin->db_column('location_zones', 'name')]); ?>" class="width_175"/>
							</td>
							<td>
								<textarea name="update[<?php echo $location_zone_id; ?>][description]" class="width_400"><?php echo set_value('update['.$location_zone_id.'][description]',$row[$this->flexi_cart_admin->db_column('location_zones', 'description')]); ?></textarea>
							</td>
							<td class="align_ctr">
								<?php $status = (bool)$row[$this->flexi_cart_admin->db_column('location_zones', 'status')]; ?>
								<input type="hidden" name="update[<?php echo $location_zone_id; ?>][status]" value="0"/>
								<input type="checkbox" name="update[<?php echo $location_zone_id; ?>][status]" value="1" <?php echo set_checkbox('update['.$location_zone_id.'][status]','1', $status); ?>/>
							</td>
							<td class="align_ctr">
								<input type="hidden" name="update[<?php echo $location_zone_id; ?>][delete]" value="0"/>
								<input type="checkbox" name="update[<?php echo $location_zone_id; ?>][delete]" value="1"/>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4">
								<input type="submit" name="update_zones" value="Update Zones" class="link_button large"/>
							</td>
						</tr>
					</tfoot>
				<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="4">
								There are no zones setup to view.<br/>
								<a href="<?php echo $base_url; ?>admin_library/insert_zone">Insert New Zone</a>
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