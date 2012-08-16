<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Miscellaneous Examples | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of some of flexi carts miscellaneous functions."/> 
	<meta name="keywords" content="miscellaneous, flexi cart, shopping cart, codeigniter"/>
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
				<h2>Miscellaneous Cart Feature Examples</h2>
				<p>Aside from core power features of flexi cart, there are also a collection of other 'helper' functions that be used to customise the functionality of the cart.</p>
				<p>Many of these helper functions are available from the <a href="<?php echo $base_url; ?>lite_library/lite_library_example">Lite Library</a> and so by using a smaller memory footprint than the full standard library, can be used across the entire site with minimal effect to site performance.</p>
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
				<a name="minimum_order"></a>
				<h3>Minimum Order Value</h3>
				<div class="frame_note">
					<small>A minimum order value can be set that the cart total must equal or surpass before the customer can checkout.</small>
					<hr/>
					<ul>
						<li><strong>Set Minimum Order</strong></li>
						<li><a href="<?php echo $base_url; ?>standard_library/minimum_order/0">Set @ <?php echo $this->flexi_cart->get_currency_value(0);?></a></li>
						<li><a href="<?php echo $base_url; ?>standard_library/minimum_order/100">Set @ <?php echo $this->flexi_cart->get_currency_value(100);?></a></li>
						<li><a href="<?php echo $base_url; ?>standard_library/minimum_order/200">Set @ <?php echo $this->flexi_cart->get_currency_value(200);?></a></li>
					</ul>
					<hr/>
					<ul>
						<li>Minimum Order: <?php echo $this->flexi_cart->minimum_order();?></li>
						<li>Current Order Total: <?php echo $this->flexi_cart->total();?></li>
						<li>Current Status: <strong><?php echo ($this->flexi_cart->minimum_order_status()) ? "Eligible" : "Ineligible" ;?></strong> to Checkout.</li>
					</ul>
				</div>
				
				<a name="custom_status"></a>
				<h3>Custom Cart Status (User Status Example)</h3>
				<div class="frame_note">
					<small>
						Three individual custom cart statuses can be set to affect whether discounts become active.<br/>
						The custom statuses can contain any string or integer values, if the value then matches the the custom status of a discount, then provided all other discount conditions are also matched, the discount is activated.
					<small>
					</small>
						This example, uses a custom status to check whether a user is logged in, by default it is set as false (0), when the status is changed (Simulating a user logging in), the status is set to true (1) which would then enable the discount.<br/>
						For this demo, if the user logs in, a 5% discount is applied to the cart total, if the user logs back out, it is removed.
					</small>
					<hr/>
					<ul>
						<li><strong>Set Login Status</strong></li>
						<li><a href="<?php echo $base_url; ?>standard_library/user_status/login">Log user in</a></li>
						<li><a href="<?php echo $base_url; ?>standard_library/user_status/logout">Log user out</a></li>
					</ul>
					<hr/>
					Current Status: <strong><?php echo ($this->flexi_cart->custom_status_1()) ? 'User <span class="uline">IS</span> logged in' : 'User <span class="uline">IS NOT</span> logged in' ;?></strong>
				</div>

				<h3>Convert Currency</h3>
				<div class="frame_note">
					<small>
						Values can be converted and formatted from the carts default currency to another using data saved in the currency database table.
					</small>
					<hr/>
					<ul>
						<li>
							<label for="currency_value" class="spacer_150">Value to Convert</label>
							<input type="text" id="currency_value" class="width_50 validate_decimal"/>
						</li>
						<li>
							<label for="convert_to_currency" class="spacer_150">Convert From > To</label>
							<?php $currency = $this->flexi_cart->currency_name(TRUE); ?>
							<select id="convert_to_currency" class="width_125">
							<?php if ($currency != 'AUD') { ?>
								<option value="AUD">
									<?php echo $currency.' to AUD'; ?>
								</option>
							<?php } if ($currency != 'EUR') { ?>
								<option value="EUR">
									<?php echo $currency.' to EUR'; ?>
								</option>
							<?php } if ($currency != 'GBP') { ?>
								<option value="GBP">
									<?php echo $currency.' to GBP'; ?>
								</option>
							<?php } if ($currency != 'USD') { ?>
								<option value="USD">
									<?php echo $currency.' to USD'; ?>
								</option>
							<?php } ?>
							</select>
						</li>
						<li>
							<label for="converted_currency" class="spacer_150">Converted Value</label>
							<span id="converted_currency"><?php echo $this->flexi_cart->currency_symbol(TRUE);?>0.00</span>
						</li>
					</ul>
				</div>
				
				<h3>Convert Value to a Weight</h3>
				<div class="frame_note">
					<small>
						Weights can be converted and formatted from one weight to another.
					</small>
					<hr/>
					<ul>
						<li>
							<label for="convert_weight" class="spacer_150">Weight to Convert:</label>
							<input type="text" id="convert_weight" class="width_50 validate_decimal"/>
						</li>
						<li>
							<label for="convert_weight_from" class="spacer_150">Convert From:</label>
							<select id="convert_weight_from" class="width_125">
							<?php foreach($this->flexi_cart->get_weight_types() as $id => $data) { ?>
								<option value="<?php echo $id;?>">
									<?php echo $data['name'];?>
								</option>
							<?php } ?>
							</select>
						</li>
						<li>
							<label for="convert_weight_to" class="spacer_150">Convert To:</label>
							<select id="convert_weight_to" class="width_125">
							<?php foreach($this->flexi_cart->get_weight_types() as $id => $data) { ?>
								<option value="<?php echo $id;?>">
									<?php echo $data['name'];?>
								</option>
							<?php } ?>
							</select>
						</li>
						<li>
							<label for="converted_weight" class="spacer_150">Converted Weight:</label>
							<span id="converted_weight">0.00g</span>
						</li>
					</ul>
				</div>
				
				<?php echo form_open(current_url());?>						
					<h3>Change Tax Rate</h3>
					<div class="frame_note">
						<small>
							On this demo site, for simplicity, the tax location is set at the same time as the shipping location via the 'Shipping' options on the 'View Cart' page.<br/>
							However, it is possible to set the shipping location and tax location independently of each other, the example below sets the tax location only.
						</small>
						<hr/>
						<label class="spacer_150">Tax Location:</label>
						<select name="tax_location">
							<option value="0"> - Country - </option>
						<?php foreach($countries as $country) { ?>
							<option value="<?php echo $country['loc_id'];?>" <?php echo ($this->flexi_cart->match_tax_location_id($country['loc_id'])) ? 'selected="selected"' : NULL;?>>
								<?php echo $country['loc_name'];?>
							</option>
						<?php } ?>
						</select>
						<input type="submit" name="update_tax" value="Update" class="link_button grey"/>				
					</div>
				<?php echo form_close();?>
			</div>

		</div>
	</div>
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 
<script>
$(function() {
	// Ajax example of how to use the 'get_taxed_currency_value()' function to convert a value into the current.
	$('#currency_value, #convert_to_currency').change(function()
	{
		var currency_value = ($('#currency_value').val() > 0) ? $('#currency_value').val() : 0;
		var convert_to_currency = $('#convert_to_currency').val();
	
		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>lite_library/ajax_convert_currency',
			data: 'currency_value='+currency_value+'&convert_to_currency='+convert_to_currency,
			success: function(response){
				// Convert html euro and pound sign characters to unicode characters.
				response = response.replace('&euro;', '\u20AC'); 
				response = response.replace('&pound;', '\u00A3');
				$('#converted_currency').text(response);
			}
		});
	});
	
	// Ajax example of how to use the 'convert_weight()' function to convert a weight value into anoth weight type.
	$('#convert_weight, #convert_weight_from, #convert_weight_to').change(function()
	{
		var convert_weight = $('#convert_weight').val();
		var convert_weight_from = $('#convert_weight_from').val();
		var convert_weight_to = $('#convert_weight_to').val();
	
		$.ajax({
			type: 'POST',
			url: '<?php echo $base_url; ?>lite_library/ajax_convert_weight',
			data: 'convert_weight='+convert_weight+'&convert_weight_from='+convert_weight_from+'&convert_weight_to='+convert_weight_to,
			success: function(response){
				$('#converted_weight').text(response);
			}
		});
	});
});
</script>

</body>
</html>