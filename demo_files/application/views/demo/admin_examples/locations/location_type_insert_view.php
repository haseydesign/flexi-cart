<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Insert Location Type | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts insert location type function."/> 
	<meta name="keywords" content="insert, location type, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="location_type_insert">

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
				<h1>Insert New Location Type</h1>
				<a href="<?php echo $base_url; ?>admin_library/location_types">Manage Location Types</a>				
				
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
								<input type="text" name="insert[<?php echo $row_id; ?>][name]" value="<?php echo set_value('insert['.$row_id.'][name]');?>" class="width_200 validate_alpha"/>
							</td>
							<td>
								<select name="insert[<?php echo $row_id; ?>][parent_location_type]" class="width_200">
									<option value="0">No Parent Location Type</option>
								<?php 
									foreach($location_type_data as $location_type) { 
										$id = $location_type[$this->flexi_cart_admin->db_column('location_type', 'id')];
								?>
									<option value="<?php echo $id; ?>" <?php echo set_select('insert['.$row_id.'][parent_location_type]', $id); ?>>
										<?php echo $location_type[$this->flexi_cart_admin->db_column('location_type', 'name')]; ?>
									</option>
								<?php } ?>
								</select>
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
							<td colspan="3">
								<input type="submit" name="insert_location_type" value="Insert New Location Types" class="link_button large"/>
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