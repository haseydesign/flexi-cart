<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Manage Discounts | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update discount function."/> 
	<meta name="keywords" content="update, discounts, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="discounts">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Discounts</h1>
				<p>Discounts can be setup with a wide range of rule conditions that can then be applied to specific items, groups of items or across the entire cart.</p>
				<p>Discount activation rules can be set to check the value and quantity of items in the cart, a customers location and up to three custom statuses within the cart. For example whether a customer has logged in, or is regarded as a new customer.</p>
				<p>Other options include activation and expiry dates, usage limits, voiding of reward points and whether discounts can be combined with other discounts.</p>
				<p>To comply with tax laws in different countries and states, the method of calculating tax on discounted items can be set using one of three methods.</p>
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
				<h1><?php echo ($discount_type == 'item') ? 'Item' : 'Summary';?> Discounts</h1>
				<p>
				<?php if ($discount_type == 'summary') { ?>
					<a href="<?php echo $base_url; ?>admin_library/item_discounts">Manage Item Discounts</a> | 
				<?php } else { ?>
					<a href="<?php echo $base_url; ?>admin_library/summary_discounts">Manage Summary Discounts</a> | 
				<?php } ?>
					<a href="<?php echo $base_url; ?>admin_library/discount_groups">Manage Item Discount Groups</a> | 
					<a href="<?php echo $base_url; ?>admin_library/insert_discount">Insert New Discount</a>
				</p>

				<table>
					<thead>
						<tr>
							<th class="spacer_50 align_ctr tooltip_trigger"
								title="Edit the discount settings.">
								Manage
							</th>
							<th class="tooltip_trigger"
								title="A short description of the discount.">
								Description
							</th>
							<th class="spacer_50 align_ctr tooltip_trigger"
								title="The number of times remaining that the discount can be used.">
								Usage Limit
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger"
								title="The start date of the discount.">
								Valid Date
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger"
								title="The expiry date of the discount.">
								Expire Date
							</th>
							<th class="spacer_50 align_ctr tooltip_trigger" 
								title="If checked, the discount will be set as 'active'.">
								Status
							</th>
							<th class="spacer_50 align_ctr tooltip_trigger" 
								title="If checked, the row will be deleted upon the form being updated.">
								Delete
							</th>
						</tr>
					</thead>
				<?php if (! empty($discount_data)) { ?>	
					<tbody>
					<?php 
						foreach ($discount_data as $row) {
							$discount_id = $row[$this->flexi_cart_admin->db_column('discounts', 'id')];
					?>
						<tr>
							<td class="align_ctr">
								<input type="hidden" name="update[<?php echo $discount_id; ?>][id]" value="<?php echo $discount_id; ?>"/>
								<a href="<?php echo $base_url; ?>admin_library/update_discount/<?php echo $discount_id; ?>">Edit</a>
							</td>
							<td>
								<?php echo $row[$this->flexi_cart_admin->db_column('discounts', 'description')]; ?>
							</td>
							<td class="align_ctr">
								<?php echo $row[$this->flexi_cart_admin->db_column('discounts', 'usage_limit')]; ?>
							</td>
							<td class="align_ctr">
								<?php echo date('d-m-Y', strtotime($row[$this->flexi_cart_admin->db_column('discounts', 'valid_date')])); ?>
							</td>
							<td class="align_ctr">
								<?php echo date('d-m-Y', strtotime($row[$this->flexi_cart_admin->db_column('discounts', 'expire_date')])); ?>
							</td>
							<td class="align_ctr">
								<?php $status = (bool)$row[$this->flexi_cart_admin->db_column('discounts', 'status')]; ?>
								<input type="hidden" name="update[<?php echo $discount_id; ?>][status]" value="0"/>
								<input type="checkbox" name="update[<?php echo $discount_id; ?>][status]" value="1" <?php echo set_checkbox('update['.$discount_id.'][status]','1', $status); ?>/>
							</td>
							<td class="align_ctr">
								<input type="hidden" name="update[<?php echo $discount_id; ?>][delete]" value="0"/>
								<input type="checkbox" name="update[<?php echo $discount_id; ?>][delete]" value="1"/>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="7">
								<input type="submit" name="update_discounts" value="Update Discounts" class="link_button large"/>
							</td>
						</tr>
					</tfoot>
				<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="7">
								There are no discounts setup to view.<br/>
								<a href="<?php echo $base_url; ?>admin_library/insert_discount">Insert New Discount</a>
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