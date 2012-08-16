<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Manage Orders | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts order management functions."/> 
	<meta name="keywords" content="orders, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="order_view">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Orders</h1>
				<p>
					When saving a customers order, the majority of data that is available from the cart can automatically be saved to the database just by enabling columns within the configuration file and the database.
				</p>
				<p>
					For any of the less commonly used data that is not automatically saved, it can be appended to any custom data that is submitted to the save function.
				</p>
				<p>
					This example lists a small summary of each order that has been completed within this site demo, the full details of each order can be viewed by clicking the the order number.
				</p>
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
										
			<h1>Manage Orders</h1>
			
			<table>
				<thead>
					<tr>
						<th class="spacer_125">Order Number</th>
						<th>Customer Name</th>
						<th class="spacer_100 align_ctr">Total Items</th>
						<th class="spacer_100 align_ctr">Total Value</th>
						<th class="spacer_100 align_ctr">Date</th>
						<th class="spacer_125 align_ctr">Status</th>
					</tr>
				</thead>
				<tbody>
			<?php if (! empty($order_data)) { ?>	
				<?php 
					foreach ($order_data as $row) { 
						$order_number = $row[$this->flexi_cart_admin->db_column('order_summary', 'order_number')];
				?>
					<tr>
						<td>
							<a href="<?php echo $base_url; ?>admin_library/order_details/<?php echo $order_number; ?>"><?php echo $order_number; ?></a>
						</td>
						<td>
							<?php echo $row['ord_demo_bill_name']; ?>
						</td>
						<td class="align_ctr">
							<?php echo number_format($row[$this->flexi_cart_admin->db_column('order_summary', 'total_items')]); ?>
						</td>
						<td class="align_ctr">
							<?php echo '&pound;'.$row[$this->flexi_cart_admin->db_column('order_summary', 'total')]; ?>
						</td>
						<td class="align_ctr">
							<?php echo date('jS M Y', strtotime($row[$this->flexi_cart_admin->db_column('order_summary', 'date')])); ?>
						</td>
						<td class="align_ctr">
							<?php echo $row[$this->flexi_cart_admin->db_column('order_status', 'status')]; ?>
						</td>
					</tr>
				<?php } } else { ?>
					<tr>
						<td colspan="6">
							There are no orders available to view.
						</td>
					</tr>
				<?php } ?>
				</tbody>
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