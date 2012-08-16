<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Insert Item Tax Rate | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts insert item tax rate function."/> 
	<meta name="keywords" content="insert, item tax rate, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="item_tax_insert">

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
				<h1>Insert New Item Tax Rate</h1>
				<p>
					<a href="<?php echo $base_url; ?>admin_library/items">Manage Items</a> | 
					<a href="<?php echo $base_url; ?>admin_library/item_Tax/<?php echo $item_data['item_id']; ?>">Manage <?php echo $item_data['item_name']; ?> Tax Rates</a>
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
								<select name="insert[<?php echo $row_id; ?>][location]" class="width_175">
									<option value="0">No Tax Location</option>
								<?php 
									foreach($locations_inline as $location) { 
										$id = $location[$this->flexi_cart_admin->db_column('locations', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('insert['.$row_id.'][location]', $id); ?>>
										<?php echo $location[$this->flexi_cart_admin->db_column('locations', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td>
								<select name="insert[<?php echo $row_id; ?>][zone]" class="width_175">
									<option value="0">No Tax Zone</option>
								<?php 
									foreach($tax_zones as $zone) {
										$id = $zone[$this->flexi_cart_admin->db_column('location_zones', 'id')];
								?>
									<option value="<?php echo $id;?>" <?php echo set_select('insert['.$row_id.'][zone]', $id); ?>>
										<?php echo $zone[$this->flexi_cart_admin->db_column('location_zones', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
							</td>
							<td>
								<input type="text" name="insert[<?php echo $row_id; ?>][rate]" value="<?php echo set_value('insert['.$row_id.'][rate]');?>" class="width_75 validate_decimal"/>
							</td>
							<td class="align_ctr">
								<input type="hidden" name="insert[<?php echo $row_id; ?>][status]" value="0"/>
								<input type="checkbox" name="insert[<?php echo $row_id; ?>][status]" value="1" <?php echo set_checkbox('insert['.$row_id.'][status]', '1', TRUE); ?>/>
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
							<td colspan="5">
								<input type="submit" name="insert_item_tax" value="Insert New Item Tax Rates" class="link_button large"/>
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