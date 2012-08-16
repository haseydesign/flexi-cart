<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Update Shipping Option Rates | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update shipping option rates function."/> 
	<meta name="keywords" content="update, shipping option rates, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="shipping_rate_update">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Shipping Rates</h1>
				<p>Shipping options can be setup with a tier of rates that will calculate the appropriate price to charge depending on the carts total value and weight.</p>
				<p>The tier functionality is designed to work by defining weight and value brackets that the cart must fit into, for example, a rate could be set for all carts weighing between 0-500g and costing between &pound;0-100, whilst another rate for all carts between 500-1000g and &pound;100-500.
				<p>To account for the additional weight of packaging, a 'Tare' weight can also be defined that will be added to the carts total weight.</p>
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
				<h1>Shipping Rates for <?php echo $shipping_data[$this->flexi_cart_admin->db_column('shipping_options', 'name')];?></h1>
				<p>
					<a href="<?php echo $base_url; ?>admin_library/shipping">Manage Shipping options</a> | 
					<a href="<?php echo $base_url; ?>admin_library/insert_shipping_rate/<?php echo $shipping_data[$this->flexi_cart_admin->db_column('shipping_options', 'id')];?>">Insert New Shipping Rate</a>
				</p>

				<table>
					<thead>
						<tr>
							<th class="spacer_100 info_req tooltip_trigger"
								title="<strong>Field Required</strong><br/>The shipping rate of the shipping option tier.">
								Rate (&pound;)
							</th>
							<th class="tooltip_trigger"
								title="The tare weight represents the weight of the packaging material required for shipping. The weight is included when matching shipping options with the weight of the cart items.">
								Tare Weight (g)
							</th>
							<th class="tooltip_trigger"
								title="Sets the minimum weight required to activate the shipping option tier. <br/>Note: The 'tare weight' will be included when weighing the cart items.">
								Min Weight (g)
							</th>
							<th class="tooltip_trigger"
								title="Sets the maximum weight permitted to activate the shipping option tier. <br/>Note: The 'tare weight' will be included when weighing the cart items.">
								Max Weight (g)
							</th>
							<th class="tooltip_trigger"
								title="Sets the minimum value of the cart that is required to activate the shipping option tier.">
								Min Value (&pound;)
							</th>
							<th class="tooltip_trigger"
								title="Sets the maximum value of the cart that is permitted to activate the shipping option tier.">
								Max Value (&pound;)
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger" 
								title="If checked, the shipping rate tier will be set as 'active'.">
								Status
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger" 
								title="If checked, the row will be deleted upon the form being updated.">
								Delete
							</th>
						</tr>
					</thead>
				<?php if (! empty($shipping_rate_data)) { ?>	
					<tbody>
					<?php 
						foreach ($shipping_rate_data as $row) {
							$shipping_rate_id = $row[$this->flexi_cart_admin->db_column('shipping_rates', 'id')];
					?>
						<tr>
							<td>
								<input type="hidden" name="update[<?php echo $shipping_rate_id; ?>][id]" value="<?php echo $shipping_rate_id; ?>"/>
								<input type="hidden" name="update[<?php echo $shipping_rate_id; ?>][parent_id]" value="<?php echo $row[$this->flexi_cart_admin->db_column('shipping_rates', 'parent')]; ?>"/>
								<input type="text" name="update[<?php echo $shipping_rate_id; ?>][value]" value="<?php echo set_value('update['.$shipping_rate_id.'][value]',$row[$this->flexi_cart_admin->db_column('shipping_rates', 'value')]); ?>" class="width_50 validate_decimal"/>
							</td>
							<td>
								<input type="text" name="update[<?php echo $shipping_rate_id; ?>][tare_weight]" value="<?php echo set_value('update['.$shipping_rate_id.'][tare_weight]',$row[$this->flexi_cart_admin->db_column('shipping_rates', 'tare_weight')]); ?>" class="width_50 validate_decimal"/>
							</td>
							<td>
								<input type="text" name="update[<?php echo $shipping_rate_id; ?>][min_weight]" value="<?php echo set_value('update['.$shipping_rate_id.'][min_weight]',$row[$this->flexi_cart_admin->db_column('shipping_rates', 'min_weight')]); ?>" class="width_50 validate_decimal"/>
							</td>
							<td>
								<input type="text" name="update[<?php echo $shipping_rate_id; ?>][max_weight]" value="<?php echo set_value('update['.$shipping_rate_id.'][max_weight]',$row[$this->flexi_cart_admin->db_column('shipping_rates', 'max_weight')]); ?>" class="width_50 validate_decimal"/>
							</td>
							<td>
								<input type="text" name="update[<?php echo $shipping_rate_id; ?>][min_value]" value="<?php echo set_value('update['.$shipping_rate_id.'][min_value]',$row[$this->flexi_cart_admin->db_column('shipping_rates', 'min_value')]); ?>" class="width_50 validate_decimal"/>
							</td>
							<td>
								<input type="text" name="update[<?php echo $shipping_rate_id; ?>][max_value]" value="<?php echo set_value('update['.$shipping_rate_id.'][max_value]',$row[$this->flexi_cart_admin->db_column('shipping_rates', 'max_value')]); ?>" class="width_50 validate_decimal"/>
							</td>
							<td class="align_ctr">
								<?php $status = (bool)$row[$this->flexi_cart_admin->db_column('shipping_rates', 'status')]; ?>
								<input type="hidden" name="update[<?php echo $shipping_rate_id; ?>][status]" value="0"/>
								<input type="checkbox" name="update[<?php echo $shipping_rate_id; ?>][status]" value="1" <?php echo set_checkbox('update['.$shipping_rate_id.'][status]','1', $status); ?>/>
							</td>
							<td class="align_ctr">
								<input type="hidden" name="update[<?php echo $shipping_rate_id; ?>][delete]" value="0"/>
								<input type="checkbox" name="update[<?php echo $shipping_rate_id; ?>][delete]" value="1"/>
							</td>
						</tr>
					<?php } ?>	
					</tbody>
					<tfoot>
						<tr>
							<td colspan="8">
								<input type="submit" name="update_shipping_rates" value="Update Shipping Rates" class="link_button large"/>
							</td>
						</tr>
					</tfoot>
				<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="8">
								There are no rates for this shipping option setup to view.<br/>
								<a href="<?php echo $base_url; ?>admin_library/insert_shipping_rate/<?php echo $shipping_data[$this->flexi_cart_admin->db_column('shipping_options', 'id')];?>">Insert New Shipping Rate</a>
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