<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Form Examples | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of inserting items to the cart via a form."/> 
	<meta name="keywords" content="insert items, form, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="item_forms">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h2>Add Item to Cart via a Form Examples</h2>
				<p>Items can be added to the cart using either data <a href="<?php echo $base_url; ?>lite_library/item_link_examples">hard coded</a> into a model file or data retrieved from a html form or a <a href="<?php echo $base_url; ?>lite_library/item_database_examples">database query</a>.</p>
				<p>This demo page shows how the data of items added to the cart can be set via data obtained from a html form submission, allowing a customer to select item quantities and options before they have added the item to the cart.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">

			<h2>Item Form Examples</h2>
			<a href="<?php echo $base_url; ?>lite_library/item_link_examples">Item Link Examples</a> |
			<a href="<?php echo $base_url; ?>lite_library/item_ajax_examples">Item Ajax Examples </a> |
			<a href="<?php echo $base_url; ?>lite_library/item_discount_examples">Item Discount Examples</a> |
			<a href="<?php echo $base_url; ?>lite_library/item_database_examples">Item Database Examples</a>

			<fieldset>
				<legend>Add an item via a form</legend>

				<?php echo form_open($base_url.'standard_library/insert_form_item_to_cart');?>
					<h6>Example #201</h6>
					
					<div class="frame_note">
						<small>This example allows a user to select the quantity of items that they wish to add to the cart.</small>
						<hr/>
						
						<ul>
							<li>
								<label>Price:</label>
								<?php echo $this->flexi_cart->get_taxed_currency_value(59.95);?>
							</li>
							<li>
								<label for="ex201_qty">Quantity:</label>
								<input type="text" id="ex201_qty" name="quantity" value="1" class="width_50 validate_integer"/>
							</li>
							<li>
								<hr/>
								<label>Add to cart:</label>
								<input type="submit" name="add_one_item" value="Submit" class="link_button"/>
								
								<input type="hidden" name="item_id" value="201"/>
								<input type="hidden" name="name" value="Item #201: added via form"/>
								<input type="hidden" name="price" value="59.95"/>
							</li>
						</ul>
					</div>
				<?php echo form_close();?>
			</fieldset>

			<fieldset>
				<legend>Add an item with options via a form</legend>
				
				<?php echo form_open($base_url.'standard_library/insert_form_item_to_cart', array('class'=>'position_left'));?>
					<h6>Example #202</h6>

					<div class="frame_note">
						<small>
							This example allows for multiple options per item to be selected.<br/>
							An array of all the option data is then also added to the item data, which can enable the user to change options after the item has been added to the cart.
						</small>
						<hr/>
						
						<ul>
							<li>
								<label>Price:</label>
								<?php echo $this->flexi_cart->get_taxed_currency_value(27.5);?>
							</li>
							<li>
								<label for="ex202_qty">Quantity:</label>
								<input id="ex202_qty" type="text" name="quantity" value="1" class="width_50 validate_integer"/>
							</li>
							<li>
								<label for="ex202_option_1">Option #1:</label>
								<select id="ex202_option_1" name="option_1" class="width_100">
									<option value="Red">Red</option>
									<option value="Green">Green</option>
									<option value="Blue">Blue</option>
								</select> 
							</li>
							<li>
								<label for="ex202_option_2">Option #2:</label>
								<select id="ex202_option_2" name="option_2" class="width_100">
									<option value="Small">Small</option>
									<option value="Medium">Medium</option>
									<option value="Large">Large</option>
								</select>
							</li>
							<li>
								<hr/>
								<label>Add to cart:</label>
								<input type="submit" name="add_one_item_options" value="Submit" class="link_button"/>
								
								<input type="hidden" name="item_id" value="202"/>
								<input type="hidden" name="name" value="Item #202, added via form with options"/>
								<input type="hidden" name="price" value="27.5"/>
							</li>
						</ul>
					</div>
				<?php echo form_close();?>

				<?php echo form_open($base_url.'standard_library/insert_form_item_to_cart', array('class'=>'position_right'));?>
					<h6>Example #203</h6>
				
					<div class="frame_note">
						<small>
							This example updates the items price depending on the option selected.<br/>
							The example does not submit an array of the items options, so the user cannot change the selected option once added to the cart.
						</small>
						<hr/>
						
						<ul>
							<li>
								<label for="ex203_qty">Quantity:</label>
								<input type="text" id="ex203_qty" name="quantity" value="1" class="width_50 validate_integer"/>
							</li>
							<li>
								<label for="ex203_option">Option with Price:</label>
								<select id="ex203_option" name="option_with_price" class="width_175">
									<option value="1">Option #1 @ <?php echo $this->flexi_cart->get_taxed_currency_value(16.95);?></option>
									<option value="2">Option #2 @ <?php echo $this->flexi_cart->get_taxed_currency_value(19.45);?></option>
									<option value="3">Option #3 @ <?php echo $this->flexi_cart->get_taxed_currency_value(22.99);?></option>
								</select> 
							</li>
							<li>
								<hr/>
								<label>Add to cart:</label>							
								<input type="submit" name="add_one_item_price_options" value="Submit" class="link_button"/>
								
								<input type="hidden" name="item_id" value="203"/>
								<input type="hidden" name="name" value="Item #203, added via form with priced options"/>
							</li>
						</ul>
					</div>
				<?php echo form_close();?>					
			</fieldset>

			<fieldset>
				<legend>Add multiple items via a form</legend>
				<?php echo form_open($base_url.'standard_library/insert_form_item_to_cart');?>

					<div class="frame_note">
						<small>This example allows a user to add multiple items to the cart at the same time just by checking each items checkbox.</small>
						<hr/>
						
						<ul class="inl_list">
							<li>
								<strong>Example #204</strong>
							</li>
							<li>
								Price: <?php echo $this->flexi_cart->get_taxed_currency_value(18.25);?>
							</li>
							<li>
								<label for="ex204_qty">Quantity:</label>
								<input type="text" id="ex204_qty" name="item[204][quantity]" value="1" class="width_50 validate_integer"/>
							</li>
							<li>
								<label for="ex204_check">Check to add:</label>
								<input type="checkbox" id="ex204_check" name="item[204][checked]" value="1"/>
								
								<input type="hidden" name="item[204][item_id]" value="204"/>
								<input type="hidden" name="item[204][name]" value="Item #204, added multiple items via form"/>
								<input type="hidden" name="item[204][price]" value="18.25"/>
							</li>
						</ul>

						<ul class="inl_list">
							<li>
								<strong>Example #205</strong>
							</li>
							<li>
								Price: <?php echo $this->flexi_cart->get_taxed_currency_value(39.95);?>
							</li>
							<li>
								<label for="ex205_qty">Quantity:</label>
								<input type="text" id="ex205_qty" name="item[205][quantity]" value="1" class="width_50 validate_integer"/>
							</li>
							<li>
								<label for="ex205_check">Check to add:</label>
								<input type="checkbox" id="ex205_check" name="item[205][checked]" value="1"/>
								
								<input type="hidden" name="item[205][item_id]" value="205"/>
								<input type="hidden" name="item[205][name]" value="Item #205, added multiple items via form"/>
								<input type="hidden" name="item[205][price]" value="39.95"/>
							</li>
						</ul>
						
						<ul class="inl_list">
							<li>
								<strong>Example #206</strong>
							</li>
							<li>
								Price: <?php echo $this->flexi_cart->get_taxed_currency_value(30);?>
							</li>
							<li>
								<label for="ex206_qty">Quantity:</label>
								<input type="text" id="ex206_qty" name="item[206][quantity]" value="1" class="width_50 validate_integer"/>
							</li>
							<li>
								<label for="ex206_check">Check to add:</label>
								<input type="checkbox" id="ex206_check" name="item[206][checked]" value="1"/>
								
								<input type="hidden" name="item[206][item_id]" value="206"/>
								<input type="hidden" name="item[206][name]" value="Item #206, added multiple items via form"/>
								<input type="hidden" name="item[206][price]" value="30"/>
							</li>
						</ul>
						<hr/>
						
						<p>
							<strong>Add checked items to cart</strong> : 
							<input type="submit" name="add_multiple_items" value="Submit" class="link_button"/>
						</p>
					</div>
					
				<?php echo form_close();?>
			</fieldset>

		</div>
	</div>
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>