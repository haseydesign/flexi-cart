<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Manage User Reward Point History | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts user reward point management functions."/> 
	<meta name="keywords" content="reward points, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="user_reward_history">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | User Reward Points and Vouchers</h1>
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
										
			<h1><?php echo $user_data['user_name'];?> : Earnt Reward Point History</h1>
			<p>
				<a href="<?php echo $base_url; ?>admin_library/user_reward_points">Manage Reward Points</a> |
				<a href="<?php echo $base_url; ?>admin_library/convert_reward_points/<?php echo $user_data['user_id'];?>">Convert Reward Points</a>
			</p>

			<table>
				<thead>
					<tr>
						<th class="spacer_100 tooltip_trigger"
							title="The order number that the reward points were earnt from.">
							Order Number
						</th>
						<th class="spacer_100 align_ctr tooltip_trigger"
							title="The date that the order was placed.">
							Date Ordered
						</th>
						<th class="tooltip_trigger"
							title="The specific item that the reward points were earnt from.">
							Item Ordered
						</th>
						<th class="spacer_100 align_ctr tooltip_trigger"
							title="The total reward points earnt from the item ordered.">
							Total Points
						</th>
						<th class="spacer_125 align_ctr tooltip_trigger"
							title="The number of reward points that are 'pending' and 'active'.">
							Pending / Active Points
						</th>
						<th class="spacer_125 align_ctr tooltip_trigger"
							title="The number of reward points that have been converted to vouchers and the number that have expired before being converted.">
							Converted / Expired Points
						</th>
					</tr>
				</thead>
			<?php if (! empty($points_awarded_data)) { ?>
				<tbody>
				<?php foreach ($points_awarded_data as $row) { ?>
					<tr>
						<td>
							<?php $order_number = $row[$this->flexi_cart_admin->db_column('reward_points', 'order_number')]; ?>
							<a href="<?php echo $base_url; ?>admin_library/order_details/<?php echo $order_number; ?>">
								<?php echo $order_number; ?>
							</a>
						</td>
						<td class="align_ctr">
							<?php echo date('jS M Y' ,strtotime($row[$this->flexi_cart_admin->db_column('reward_points', 'order_date')]));?>
						</td>
						<td>
							<?php echo $row[$this->flexi_cart_admin->db_column('reward_points', 'description')]; ?>
						</td>
						<td class="align_ctr">
						<?php if ($row[$this->flexi_cart_admin->db_column('reward_points', 'row_points_cancelled')] > 0) { ?>
							<span class="tooltip_trigger" title="Points cancelled due to returned items : <?php echo $row[$this->flexi_cart_admin->db_column('reward_points', 'row_points_cancelled')]; ?>">
								<?php echo $row[$this->flexi_cart_admin->db_column('reward_points', 'row_points_total')]; ?> total
							</span>
						<?php 
							} else { 
								echo $row[$this->flexi_cart_admin->db_column('reward_points', 'row_points_total')].' total';
							} 
						?>
						</td>
						<td class="align_ctr">
							<?php echo $row[$this->flexi_cart_admin->db_column('reward_points', 'row_points_pending')]; ?> pending,<br/>								
						<?php if ($row[$this->flexi_cart_admin->db_column('reward_points', 'activate_date')]) { ?>
							<span class="tooltip_trigger" title="Active Since : <?php echo date('jS M Y' ,strtotime($row[$this->flexi_cart_admin->db_column('reward_points', 'activate_date')])); ?>">
								<?php echo $row[$this->flexi_cart_admin->db_column('reward_points', 'row_points_active')]; ?> active
							</span>
						<?php 
							} else { 
								echo $row[$this->flexi_cart_admin->db_column('reward_points', 'row_points_active')].' active';
							} 
						?>
						</td>
						<td class="align_ctr">
							<?php echo $row[$this->flexi_cart_admin->db_column('reward_points', 'row_points_converted')]; ?> converted,<br/>
						<?php if ($row[$this->flexi_cart_admin->db_column('reward_points', 'activate_date')]) { ?>
							<span class="tooltip_trigger" title="Expire Date : <?php echo date('jS M Y' ,strtotime($row[$this->flexi_cart_admin->db_column('reward_points', 'expire_date')])); ?>">
								<?php echo $row[$this->flexi_cart_admin->db_column('reward_points', 'row_points_expired')]; ?> expired
							</span>
						<?php 
							} else { 
								echo $row[$this->flexi_cart_admin->db_column('reward_points', 'row_points_active')].' active';
							} 
						?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			<?php } else { ?>
				<tbody>
					<tr>
						<td colspan="6">
							There are no reward points available for this user to view.
						</td>
					</tr>
				</tbody>
			<?php } ?>
			</table>	
			
			<br/>
			<h1><?php echo $user_data['user_name'];?> : Converted Reward Point History</h1>
			<p>
				<a href="<?php echo $base_url; ?>admin_library/user_reward_points">Manage Reward Points</a> |
				<a href="<?php echo $base_url; ?>admin_library/convert_reward_points/<?php echo $user_data['user_id'];?>">Convert Reward Points</a>
			</p>

			<table>
				<thead>
					<tr>
						<th class="spacer_150 tooltip_trigger"
							title="The reward voucher code.">
							Voucher Code
						</th>
						<th class="spacer_100 tooltip_trigger"
							title="The order number that the reward points were earnt and converted from.">
							Order Number
						</th>
						<th class="tooltip_trigger"
							title="The specific item that the reward points were earnt and converted from.">
							Item Ordered
						</th>
						<th class="spacer_125 align_ctr tooltip_trigger"
							title="The number of reward points that were converted.">
							Points Converted
						</th>
						<th class="spacer_125 align_ctr tooltip_trigger"
							title="The date the reward points were converted.">
							Date Converted
						</th>
					</tr>
				</thead>
			<?php if (! empty($points_converted_data)) { ?>
				<tbody>
				<?php foreach ($points_converted_data as $voucher_data) { ?>
					<?php foreach ($voucher_data['reward_points'] as $points_row => $points_data) { ?>
					<tr <?php echo ($points_row == 0) ? 'style="border-top:3px double #666;"' : NULL;?>>
						<td>
						<?php if ($points_row == 0) { ?>
							<?php echo $voucher_data[$this->flexi_cart_admin->db_column('discounts', 'code')]; ?>
						<?php } else { ?>
							&nbsp;
						<?php } ?>
						</td>
						<td>
							<?php $order_number = $points_data[$this->flexi_cart_admin->db_column('reward_points', 'order_number')]; ?>
							<a href="<?php echo $base_url; ?>admin_library/order_details/<?php echo $order_number; ?>">
								<?php echo $order_number; ?>
							</a>
						</td>
						<td>
							<?php echo $points_data[$this->flexi_cart_admin->db_column('reward_points', 'description')]; ?>
						</td>
						<td class="align_ctr">
							<?php echo $points_data[$this->flexi_cart_admin->db_column('reward_points_converted', 'points')]; ?>
						</td>
						<td class="align_ctr">
							<?php echo date('jS M Y' ,strtotime($points_data[$this->flexi_cart_admin->db_column('reward_points_converted', 'date')])); ?>
						</td>
					</tr>
					<?php } ?>
				<?php } ?>
				</tbody>
			<?php } else { ?>
				<tbody>
					<tr>
						<td colspan="5">
							There are no reward point conversions available for this user to view.
						</td>
					</tr>
				</tbody>
			<?php } ?>
			</table>				

		</div>
	</div>
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>