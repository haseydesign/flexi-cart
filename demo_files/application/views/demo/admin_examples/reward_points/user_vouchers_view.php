<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Manage User Reward Vouchers | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts reward voucher management functions."/> 
	<meta name="keywords" content="reward vouchers, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="user_vouchers">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | User Reward Vouchers</h1>
				<p>Users can earn reward points when they purchase items. When they earn enough points, they can be converted to a voucher worth a monetary value.</p>
				<p>The voucher is stored as a code in the database that when entered on their next purchase, will deduct the vouchers value from their cart total.</p>
				<p>The conversion and monetary value of reward points and vouchers can all be set via the cart configuration.</p>
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
				<h1><?php echo $user_data['user_name'];?> : Reward Vouchers</h1>
				<p>
					<a href="<?php echo $base_url; ?>admin_library/user_reward_points">Manage Reward Points</a> | 
					<a href="<?php echo $base_url; ?>admin_library/user_reward_point_history/<?php echo $user_data['user_id']; ?>">View Reward Point History</a> | 
					<a href="<?php echo $base_url; ?>admin_library/convert_reward_points/<?php echo $user_data['user_id'];?>">Convert Reward Points</a>
				</p>
				
				<table>
					<thead>
						<tr>
							<th class="tooltip_trigger"
								title="The code used to apply the reward voucher.">
								Voucher Code
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger"
								title="Indicates whether the reward voucher has been used or not.">
								Availability
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger"
								title="The currency value of the reward voucher.">
								Value
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger"
								title="The expiry date the voucher must be used by.">
								Expire Date
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger" 
								title="If checked, the reward voucher will be set as 'active'.">
								Status
							</th>
						</tr>
					</thead>
				<?php if (! empty($voucher_data)) { ?>	
					<tbody>
					<?php 
						foreach ($voucher_data as $row) {
							$voucher_id = $row[$this->flexi_cart_admin->db_column('discounts', 'id')];
					?>
						<tr>
							<td>
								<input type="hidden" name="update[<?php echo $voucher_id; ?>][id]" value="<?php echo $row[$this->flexi_cart_admin->db_column('discounts', 'id')]?>"/>
								<?php echo $row[$this->flexi_cart_admin->db_column('discounts', 'code')]; ?>
							</td>
							<td class="align_ctr">
							<?php if ($row[$this->flexi_cart_admin->db_column('discounts', 'usage_limit')] > 0) { ?>
								Available
							<?php } else { ?>
								Used
							<?php } ?>
							</td>
							<td class="align_ctr">
								&pound;<?php echo $row[$this->flexi_cart_admin->db_column('discounts', 'value_discounted')]; ?>
							</td>
							<td class="align_ctr">
								<?php echo date('jS M Y', strtotime($row[$this->flexi_cart_admin->db_column('discounts', 'expire_date')])); ?>
							</td>
							<td class="align_ctr">
								<?php $status = (bool)$row[$this->flexi_cart_admin->db_column('discounts', 'status')]; ?>
								<input type="hidden" name="update[<?php echo $voucher_id; ?>][status]" value="0"/>
								<input type="checkbox" name="update[<?php echo $voucher_id; ?>][status]" value="1" <?php echo set_checkbox('update['.$voucher_id.'][status]','1', $status); ?>/>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5">
								<input type="submit" name="update_vouchers" value="Update Vouchers" class="link_button large"/>
							</td>
						</tr>
					</tfoot>
				<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="5">
								There are no vouchers available to view for this user.
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