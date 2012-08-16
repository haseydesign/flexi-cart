<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Update Discount Item Groups | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update discount item groups function."/> 
	<meta name="keywords" content="update, discount item groups, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="discount_groups">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Discount Item Groups</h1>
				<p>As flexi cart leaves the design of the sites item and attribute database tables up to the developer, it is not possible to directly relate a discount to specific item categories or other attributes. To have done so would have restricted the flexibility of the sites database design.</p>
				<p>Instead, flexi cart provides a feature that allows items to be grouped together, the discount can then be applied to all items within that group.</p>
				<p>The method of grouping items together is again up to the developer, however, flexi cart provides a function than can create a complex SQL WHERE statement that can be applied to the developers custom SELECT statement, the returned items can then be added to the discount item group.</p>
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
				<h1>Discount Item Groups</h1>
				<p>
					<a href="<?php echo $base_url; ?>admin_library/insert_discount_group">Insert New Group</a><br/>
					<a href="<?php echo $base_url; ?>admin_library/item_discounts">Manage Item Discounts</a> | 
					<a href="<?php echo $base_url; ?>admin_library/summary_discounts">Manage Summary Discounts</a> 
				</p>

				<table>
					<thead>
						<tr>
							<th class="info_req tooltip_trigger"
								title="<strong>Field Required</strong><br/>Set the name of the discount item group.">
								Group Name
							</th>
							<th class="spacer_175 align_ctr tooltip_trigger"
								title="Manage items within the discount item group.">
								Manage
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger" 
								title="If checked, the discount item group will be set as 'active'.">
								Status
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger" 
								title="If checked, the row will be deleted upon the form being updated.">
								Delete
							</th>
						</tr>
					</thead>
				<?php if (! empty($discount_group_data)) { ?>	
					<tbody>
					<?php 
						foreach ($discount_group_data as $row) {
							$disc_group_id = $row[$this->flexi_cart_admin->db_column('discount_groups', 'id')];
					?>
						<tr>
							<td>
								<input type="hidden" name="update[<?php echo $disc_group_id; ?>][id]" value="<?php echo $disc_group_id; ?>"/>
								<input type="text" name="update[<?php echo $disc_group_id; ?>][name]" value="<?php echo set_value('update['.$disc_group_id.'][name]', $row[$this->flexi_cart_admin->db_column('discount_groups', 'name')]); ?>" class="width_250"/>
							</td>
							<td class="align_ctr">
								<a href="<?php echo $base_url; ?>admin_library/update_discount_group/<?php echo $disc_group_id; ?>">Manage Items in Group</a><br/>
								<a href="<?php echo $base_url; ?>admin_library/insert_discount_group_items/<?php echo $disc_group_id; ?>">Insert New Items to Group</a>
							</td>
							<td class="align_ctr">
								<?php $status = (bool)$row[$this->flexi_cart_admin->db_column('discount_groups', 'status')]; ?>
								<input type="hidden" name="update[<?php echo $disc_group_id; ?>][status]" value="0"/>
								<input type="checkbox" name="update[<?php echo $disc_group_id; ?>][status]" value="1" <?php echo set_checkbox('update['.$disc_group_id.'][status]','1', $status); ?>/>
							</td>
							<td class="align_ctr">
								<input type="hidden" name="update[<?php echo $disc_group_id; ?>][delete]" value="0"/>
								<input type="checkbox" name="update[<?php echo $disc_group_id; ?>][delete]" value="1"/>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4">
								<input type="submit" name="update_discount_groups" value="Update Discount Item Groups" class="link_button large"/>
							</td>
						</tr>
					</tfoot>
				<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="4">
								There are no discount item groups setup to view.<br/>
								<a href="<?php echo $base_url; ?>admin_library/insert_discount_group">Insert New Discount Item Group</a>
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