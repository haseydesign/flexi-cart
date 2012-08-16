<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Manage User Reward Point Summary | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts user reward point management functions."/> 
	<meta name="keywords" content="reward points, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="user_reward_points">

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
										
			<?php echo form_open(current_url());?>
				<h1>Manage User Reward Points</h1>
				<p>
					<a href="<?php echo $base_url; ?>admin_library/vouchers">Manage Reward Vouchers</a>
				</p>

				<table>
					<thead>
						<tr>
							<th>User Name</th>
							<th class="spacer_75 align_ctr tooltip_trigger"
								title="The number of reward points that have been earnt by the user. Any cancelled or refunded items are not included in the total.">
								Total
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger"
								title="The number of reward points that are pending activation. Once an ordered item has been 'Completed' (Shipped), the earnt points will be enabled after a set number of days.">
								Pending
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger"
								title="The number of reward points that have been earnt by the user, which are active and can be converted to vouchers.">
								Active
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger"
								title="The number of reward points that have expired before they were converted to a reward voucher.">
								Expired
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger"
								title="The number of reward points that have been converted to reward vouchers by the user.">
								Converted
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger"
								title="The number of reward points that have been cancelled due to an ordered item being cancelled or refunded.">
								Cancelled
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger"
								title="View the customers history of reward point earnings and conversions.">
								History
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger"
								title="View and manage the customers reward points vouchers.">
								Vouchers
							</th>
						</tr>
					</thead>
				<?php if (! empty($user_data)) { ?>
					<tbody>
					<?php foreach ($user_data as $row) { ?>
						<tr>
							<td>
								<?php echo $row['user_name']; ?>
							</td>
							<td class="align_ctr">
								<?php echo $row['total_points']; ?>
							</td>
							<td class="align_ctr">
								<?php echo $row['total_points_pending']; ?>
							</td>
							<td class="align_ctr">
								<?php echo $row['total_points_active']; ?>
							</td>
							<td class="align_ctr">
								<?php echo $row['total_points_expired']; ?>
							</td>
							<td class="align_ctr">
								<?php echo $row['total_points_converted']; ?>
							</td>
							<td class="align_ctr">
								<?php echo $row['total_points_cancelled']; ?>
							</td>
							<td class="align_ctr">
								<a href="<?php echo $base_url; ?>admin_library/user_reward_point_history/<?php echo $row['user_id']; ?>">View</a>
							</td>
							<td class="align_ctr">
								<a href="<?php echo $base_url; ?>admin_library/user_vouchers/<?php echo $row['user_id']; ?>">View</a> | 
								<a href="<?php echo $base_url; ?>admin_library/convert_reward_points/<?php echo $row['user_id']; ?>">Convert</a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="6">
								There are no users available to view.
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