<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Update Currency | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update currency function."/> 
	<meta name="keywords" content="update, currency, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="currency_update">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Currencies</h1>
				<p>When setting up the cart, all monetary values are based on a specifically defined currency, this currency value is then used for all internal calculations.</p>
				<p>When these values are displayed by the cart, they can be converted into any other currency that has been setup. This allows for cart setups that would enable a customer to view prices in their own currency, whilst still saving all cart data in the carts default currency.</p>
				<p>The currency conversion simply works by updating the exchange rate of other currencies to the carts currency. <br/>For developers with access to an exchange rate data feed, a custom function could be used to auto update the exchange rates.</p>
				<p>In addition to allowing multiple currencies, the format of these currencies can also be set, with options available to define the currency symbol (&pound, &euro;, $), the position of the symbol (Prefixed of suffixed to the value), and the characters used as the 'Thousand' and 'Decimal' separators (Commas, periods).</p>
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
					<h1>Manage Currencies</h1>
					<p><a href="<?php echo $base_url; ?>admin_library/insert_currency">Insert New Currency</a></p>

					<table>
						<thead>
							<tr>
								<th class="info_req tooltip_trigger"
									title="The name of the currency.">
									Name
								</th>
								<th class="info_req tooltip_trigger"
									title="The exchange rate of the currency compared to the carts default currency.">
									Exchange Rate
								</th>
								<th>Symbol</th>
								<th class="info_req tooltip_trigger"
									title="The currency symbol to display with currency values. For example '$' to display '$9.99'.">
									Symbol HTML
								</th>
								<th class="spacer_75 align_ctr tooltip_trigger"
									title="If checked, the currency symbol will be suffixed to the end of the currency value rather than the front. For example<br/> Checked: '9.99&euro;',<br/> Unchecked: '&pound;9.99'.">
									Suffix
								</th>
								<th class="info_req tooltip_trigger"
									title="The character used to separate currencies in excess of a thousand.<br/> For example, the comma in '1,000'.">
									Thousand
								</th>
								<th class="info_req tooltip_trigger"
									title="The character used to separate a currencies decimal value.<br/> For example, the period in '99.99'.">
									Decimal
								</th>
								<th class="spacer_75 align_ctr tooltip_trigger" 
									title="If checked, the currency will be set as 'active'.">
									Status
								</th>
								<th class="spacer_75 align_ctr tooltip_trigger" 
									title="If checked, the row will be deleted upon the form being updated.">
									Delete
								</th>
							</tr>
						</thead>
					<?php if (! empty($currency_data)) { ?>	
						<tbody>
						<?php 
							foreach ($currency_data as $row) { 
								$currency_id = $row[$this->flexi_cart_admin->db_column('currency', 'id')];
						?>
							<tr>
								<td>
									<input type="hidden" name="update[<?php echo $currency_id; ?>][id]" value="<?php echo $currency_id; ?>"/>
									<input type="text" name="update[<?php echo $currency_id; ?>][name]" value="<?php echo set_value('update['.$currency_id.'][name]', $row[$this->flexi_cart_admin->db_column('currency', 'name')]); ?>" class="width_100"/>
								</td>
								<td>
									<input type="text" name="update[<?php echo $currency_id; ?>][exchange_rate]" value="<?php echo set_value('update['.$currency_id.'][exchange_rate]', round($row[$this->flexi_cart_admin->db_column('currency', 'exchange_rate')],4)); ?>" class="width_100 validate_decimal"/>
								</td>
								<td>
									<?php echo $row[$this->flexi_cart_admin->db_column('currency', 'symbol')]; ?>
								</td>
								<td>
									<input type="text" name="update[<?php echo $currency_id; ?>][symbol]" value="<?php echo set_value('update['.$currency_id.'][symbol]', $row[$this->flexi_cart_admin->db_column('currency', 'symbol')]); ?>" class="width_100 validate_alpha"/>
								</td>
								<td class="align_ctr">
									<?php $symbol_suffix = (bool)$row[$this->flexi_cart_admin->db_column('currency', 'symbol_suffix')]; ?>
									<input type="hidden" name="update[<?php echo $currency_id; ?>][symbol_suffix]" value="0"/>
									<input type="checkbox" name="update[<?php echo $currency_id; ?>][symbol_suffix]" value="1" <?php echo set_checkbox('update['.$currency_id.'][symbol_suffix]','1', $symbol_suffix); ?>/>
								</td>
								<td>
									<input type="text" name="update[<?php echo $currency_id; ?>][thousand]" value="<?php echo set_value('update['.$currency_id.'][thousand]', $row[$this->flexi_cart_admin->db_column('currency', 'thousand_separator')]); ?>" class="width_50 validate_alpha"/>
								</td>
								<td>
									<input type="text" name="update[<?php echo $currency_id; ?>][decimal]" value="<?php echo set_value('update['.$currency_id.'][decimal]', $row[$this->flexi_cart_admin->db_column('currency', 'decimal_separator')]); ?>" class="width_50 validate_alpha"/>
								</td>
								<td class="align_ctr">
									<?php $status = (bool)$row[$this->flexi_cart_admin->db_column('currency', 'status')]; ?>
									<input type="hidden" name="update[<?php echo $currency_id; ?>][status]" value="0"/>
									<input type="checkbox" name="update[<?php echo $currency_id; ?>][status]" value="1" <?php echo set_checkbox('update['.$currency_id.'][status]','1', $status); ?>/>
								</td>
								<td class="align_ctr">
									<input type="hidden" name="update[<?php echo $currency_id; ?>][delete]" value="0"/>
									<input type="checkbox" name="update[<?php echo $currency_id; ?>][delete]" value="1"/>
								</td>
							</tr>
						<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="9">
									<input type="submit" name="update_currency" value="Update Currencies" class="link_button large"/>
								</td>
							</tr>
						</tfoot>
					<?php } else { ?>
						<tbody>
							<tr>
								<td colspan="9">
									There are no currencies setup to view.<br/>
									<a href="<?php echo $base_url; ?>admin_library/insert_currency">Insert New Currency</a>
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