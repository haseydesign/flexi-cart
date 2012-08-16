<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Save and Load Cart Data Examples | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts save and load cart data functions."/> 
	<meta name="keywords" content="save cart data, load cart data, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="feature_examples">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h2>Save / Load Cart Data Examples</h2>
				<p>When a customer adds an item to their cart, flexi cart stores the data of the item and all cart settings in a session on the customers browser.<br/>
				If the customer leaves the site and later returns, depending on the life of sessions set in CodeIgniter, the customers shopping cart data may have expired and have been erased.</p>
				<p>One of flexi carts features is that a customers cart session data can be saved to the sites database, and can then be loaded at a later date, restoring the contents of their original cart.</p>
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

			<div class="w100 frame">
				<h3>Save Current Cart Data</h3>
				<div class="frame_note">
					<p>
						By clicking the button below, the current carts session data will be saved to the sites database. <br/>
						This cart data will then be listed in the 'Load Saved Cart Data' table below and can be reloaded into the users browser to continue shopping.
					</p>
					<a href="<?php echo $base_url; ?>standard_library/save_cart_data" class="link_button">Save Cart Data</a>
					<small>Note: Any cart data saved will be viewable by other users to this site until either deleted, or until the sites database is restored to default settings (Every few hours).</small>
				</div>
				
				<h3>Load Saved Cart Data</h3>
				<div class="frame_note">
					<p>
						The table below lists all carts sessions that have been saved to the database.<br/>
						To reload a cart session, click on the date and time that the cart was saved. Cart sessions can be permanently deleted by clicking 'Delete'.
					</p>
					<table>
						<thead>
							<tr>
								<th>
									Date Cart Saved
								</th>
								<th class="spacer_125 align_ctr">
									Delete
								</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							if ($saved_cart_data) { 
								foreach($saved_cart_data as $row) { 
						?>
							<tr>
								<td>
									Load cart session data saved on : 
									<a href="<?php echo $base_url; ?>standard_library/load_cart_data/<?php echo $row[$this->flexi_cart->db_column('db_cart_data','id')];?>">
										<?php echo date('jS M Y @ H:i', strtotime($row[$this->flexi_cart->db_column('db_cart_data','date')]));?>
									</a>
								</td>
								<td class="align_ctr">
									<a href="<?php echo $base_url; ?>standard_library/delete_cart_data/<?php echo $row[$this->flexi_cart->db_column('db_cart_data','id')];?>">
										Delete
									</a>
								</td>
							</tr>
						<?php } } else { ?>
							<tr>
								<td colspan="2">
									There are currently no saved carts to load.
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
					<small>Note: Only saved cart session data for orders that have not been completed are listed.</small>
				</div>
			</div>

		</div>
	</div>
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>