<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Cart Checkout | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of a cart checkout page."/> 
	<meta name="keywords" content="checkout, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="checkout">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h2>Checkout</h2>
				<p>The checkout process on e-commerce sites can vary from site to site. Some sites incorporate 1-page-checkouts, others collect user data over different pages and then redirect the user to a third party online payment processor.</p>
				<p>Rather than flexi cart being an 'all-in-one' rigid store, that dictates how the flow of the site must run, it provides the tools that can be used to build whatever layout and flow that the client requests.</p>
				<p>This page acts as a simple example of collecting the customers details and then saving them to the database along with their cart details.</p>
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
				<fieldset class="w100">
					<legend>Billing Details</legend>
					<ul class="position_left">
						<li class="info_req">
							<label for="checkout_billing_name">Name:</label>
							<input type="text" name="checkout[billing][name]" id="checkout_billing_name" value="<?php echo set_value('checkout[billing][name]');?>" placeholder="Name" class="width_200"/>
						</li>
						<li>
							<label for="checkout_billing_company">Company:</label>
							<input type="text" name="checkout[billing][company]" id="checkout_billing_company" value="<?php echo set_value('checkout[billing][company]');?>" placeholder="Company" class="width_200"/>
						</li>
						<li class="info_req">
							<label for="checkout_billing_add_01">Address Line 1:</label>
							<input type="text" name="checkout[billing][add_01]" id="checkout_billing_add_01" value="<?php echo set_value('checkout[billing][add_01]');?>" placeholder="Address Line 1" class="width_200"/>
						</li>
						<li>
							<label for="checkout_billing_add_02">Address Line 2:</label>
							<input type="text" name="checkout[billing][add_02]" id="checkout_billing_add_02" value="<?php echo set_value('checkout[billing][add_02]');?>" placeholder="Address Line 2" class="width_200"/>
						</li>
					</ul>
					<ul class="position_right">
						<li class="info_req">
							<label for="checkout_billing_city">City / Town:</label>
							<input type="text" name="checkout[billing][city]" id="checkout_billing_city" value="<?php echo set_value('checkout[billing][city]');?>" placeholder="City / Town" class="width_200"/>
						</li>
						<li class="info_req">
							<label for="checkout_billing_state">State / County:</label>
							<input type="text" name="checkout[billing][state]" id="checkout_billing_state" value="<?php echo set_value('checkout[billing][state]', $this->flexi_cart->shipping_location_name(2));?>" placeholder="State" class="width_200"/>
						</li>
						<li class="info_req">
							<label for="checkout_billing_post_code">Post / Zip Code:</label>
							<input type="text" name="checkout[billing][post_code]" id="checkout_billing_post_code" value="<?php echo set_value('checkout[billing][post_code]', $this->flexi_cart->shipping_location_name(3));?>" placeholder="Post / Zip Code" class="width_200"/>
						</li>
						<li class="info_req">
							<label for="checkout_billing_country">Country:</label>
							<select id="checkout_billing_country" name="checkout[billing][country]" class="width_200">
								<option value="0"> - Country - </option>
							<?php 
								foreach($countries as $country) { 
									$id = $country[$this->flexi_cart->db_column('locations', 'id')];
									$name = $country[$this->flexi_cart->db_column('locations', 'name')];
							?>
								<option value="<?php echo $name;?>" <?php echo set_select('checkout[billing][country]', $name, $this->flexi_cart->match_shipping_location_id($id)); ?>>
									<?php echo $name;?>
								</option>
							<?php } ?>
							</select>
						</li>
					</ul>
				</fieldset>
								
				<fieldset class="w100">
					<legend>Shipping Details</legend>

					<div>
						<label>
							<strong>Copy Billing Details</strong>
							<input type="checkbox" id="copy_billing_details" value="1"/>
						</label>
					</div>
					
					<ul class="position_left">
						<li class="info_req">
							<label for="checkout_shipping_name">Name:</label>
							<input type="text" name="checkout[shipping][name]" id="checkout_shipping_name" value="<?php echo set_value('checkout[shipping][name]');?>" placeholder="Name" class="width_200"/>
						</li>
						<li>
							<label for="checkout_shipping_company">Company:</label>
							<input type="text" name="checkout[shipping][company]" id="checkout_shipping_company" value="<?php echo set_value('checkout[shipping][company]');?>" placeholder="Company" class="width_200"/>
						</li>
						<li class="info_req">
							<label for="checkout_shipping_add_01">Address Line 1:</label>
							<input type="text" name="checkout[shipping][add_01]" id="checkout_shipping_add_01" value="<?php echo set_value('checkout[shipping][add_01]');?>" placeholder="Address Line 1" class="width_200"/>
						</li>
						<li>
							<label for="checkout_shipping_add_02">Address Line 2:</label>
							<input type="text" name="checkout[shipping][add_02]" id="checkout_shipping_add_02" value="<?php echo set_value('checkout[shipping][add_02]');?>" placeholder="Address Line 2" class="width_200"/>
						</li>
					</ul>
					<ul class="position_right">
						<li class="info_req">
							<label for="checkout_shipping_city">City / Town:</label>
							<input type="text" name="checkout[shipping][city]" id="checkout_shipping_city" value="<?php echo set_value('checkout[shipping][city]');?>" placeholder="City / Town" class="width_200"/>
						</li>
						<li class="info_req">
							<label for="checkout_shipping_state">State / County:</label>
						<?php if (!($this->flexi_cart->shipping_location_name(2))) { ?>
							<input type="text" name="checkout[shipping][state]" id="checkout_shipping_state" value="<?php echo set_value('checkout[shipping][state]');?>" placeholder="State" class="width_200"/>
						<?php } else { ?>
							<?php echo $this->flexi_cart->shipping_location_name(2);?>
							<input type="hidden" name="checkout[shipping][state]" value="<?php echo set_value('checkout[shipping][state]', $this->flexi_cart->shipping_location_name(2));?>"/>
						<?php } ?>
						</li>
						<li class="info_req">
							<label for="checkout_shipping_post_code">Post / Zip Code:</label>
						<?php if (!($this->flexi_cart->shipping_location_name(3))) { ?>
							<input type="text" name="checkout[shipping][post_code]" id="checkout_shipping_post_code" value="<?php echo set_value('checkout[shipping][post_code]');?>" placeholder="Post / Zip Code" class="width_200"/>
						<?php } else { ?>
							<?php echo $this->flexi_cart->shipping_location_name(3);?>
							<input type="hidden" name="checkout[shipping][post_code]" value="<?php echo set_value('checkout[shipping][post_code]', $this->flexi_cart->shipping_location_name(3));?>"/>
						<?php } ?>
						</li>
						<li>
							<label for="checkout_shipping_country">Country:</label>
							<?php echo $this->flexi_cart->shipping_location_name(1);?>
							<input type="hidden" name="checkout[shipping][country]" value="<?php echo $this->flexi_cart->shipping_location_name(1);?>"/>
					</li>
					</ul>
				</fieldset>
								
				<fieldset class="w100">
					<legend>Contact Details</legend>
					<ul>
						<li class="info_req">
							<label for="checkout_email">Email:</label>
							<input type="text" name="checkout[email]" id="checkout_email" value="<?php echo set_value('checkout[email]');?>" placeholder="Email" class="width_200"/>
						</li>
						<li class="info_req">
							<label for="checkout_phone">Phone Number:</label>
							<input type="text" name="checkout[phone]" id="checkout_phone" value="<?php echo set_value('checkout[phone]');?>" placeholder="Phone Number" class="width_200"/>
						</li>
						<li>
							<label for="checkout_comments">Comments:</label>
							<textarea name="checkout[comments]" id="checkout_comments" placeholder="Comments" rows="2" class="width_400"><?php echo set_value('checkout[comments]');?></textarea>
						</li>
					</ul>
				</fieldset>
								
				<fieldset class="w100">
					<legend>Complete Checkout</legend>
					<a href="<?php echo $base_url; ?>standard_library/view_cart" class="link_button large"/>Edit Cart</a>
					<input type="submit" name="save_order" value="Save Order to Database" class="link_button large red"/>
					<small>Note: Any cart data saved will be viewable by other users to this site until the sites database is restored to default settings (Every few hours).</small>
				</fieldset>
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
$(function() 
{
	// Toggle show/hide cart session array
	$('#copy_billing_details').click(function()
	{
		$('input[name^="checkout[billing]"]').each(function()
		{
			// Target textboxes only, no hidden fields
			if ($(this).attr('type') == 'text')
			{
				var name = $(this).attr('name').replace('billing', 'shipping');
				var value = ($('#copy_billing_details').is(':checked')) ? $(this).val() : '';
				
				$('input[name="'+name+'"]').val(value);
			}
		});
	
	});
});
</script>

</body>
</html>