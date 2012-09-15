<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Ajax Examples | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of inserting items to the cart via ajax."/> 
	<meta name="keywords" content="insert items, ajax, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="item_links">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h2>Add Item to Cart via Ajax Examples</h2>
				<p>Items can be added to the cart using either data hard coded into a model file or data retrieved from a <a href="<?php echo $base_url; ?>lite_library/item_form_examples">html form</a> or a <a href="<?php echo $base_url; ?>lite_library/item_database_examples">database query</a>.</p>
				<p>This demo page shows examples of how to add items to the cart using ajax.</p>
			</div>		
		</div>
	</div>

	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">

			<h2>Item Ajax Examples</h2>
			<a href="<?php echo $base_url; ?>lite_library/item_link_examples">Item Link Examples</a> |
			<a href="<?php echo $base_url; ?>lite_library/item_form_examples">Item Form Examples</a> |
			<a href="<?php echo $base_url; ?>lite_library/item_discount_examples">Item Discount Examples</a> |
			<a href="<?php echo $base_url; ?>lite_library/item_database_examples">Item Database Examples</a> 
		
			<div class="w100 frame bullet">
				<h5>Add items via Ajax using a link</h5>
				<div class="frame_note">
					<ul>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_ajax_link_item_to_cart/501" class="add_item_via_ajax_link">Example #501</a> : Add 1 item via an ajax link.
							<small>An example of adding an item to the cart via ajax using a link.</small>
						</li>
						<li>
							<a href="<?php echo $base_url; ?>standard_library/insert_ajax_link_item_to_cart/502" class="add_item_via_ajax_link">Example #502</a> : Add 3 items at once via an ajax link.
							<small>An example of adding 3 items at once to the cart via ajax using a link.</small>
						</li>
					</ul>
				</div>
			</div>

			<fieldset class="parallel">
				<legend>Add items via Ajax using a form</legend>
				
				<?php echo form_open($base_url.'standard_library/insert_ajax_form_item_to_cart', array('class'=>'position_left'));?>
					<h6>Example #503</h6>

					<div class="frame_note parallel_target">
						<small>
							This example allows for multiple options per item to be selected.<br/>
							An array of all the option data is then also added to the item data, which can enable the user to change options after the item has been added to the cart.
						</small>
						<hr/>
						
						<ul>
							<li>
								<label>Price:</label>
								<?php echo $this->flexi_cart->get_taxed_currency_value(45.25);?>
							</li>
							<li>
								<label for="ex503_qty">Quantity:</label>
								<input id="ex503_qty" type="text" name="quantity" value="1" class="width_50 validate_integer"/>
							</li>
							<li>
								<label for="ex503_option_1">Option #1:</label>
								<select id="ex503_option_1" name="option_1" class="width_100">
									<option value="Black">Black</option>
									<option value="Pink">Pink</option>
									<option value="Orange">Orange</option>
								</select> 
							</li>
							<li>
								<label for="ex503_option_2">Option #2:</label>
								<select id="ex503_option_2" name="option_2" class="width_100">
									<option value="Small">Small</option>
									<option value="Medium">Medium</option>
									<option value="Large">Large</option>
								</select>
							</li>
							<li>
								<hr/>
								<label>Add to cart:</label>
								<input type="submit" name="add_item_ajax_form_503" value="Submit" class="link_button add_item_via_ajax_form"/>
								
								<input type="hidden" name="item_id" value="503"/>
								<input type="hidden" name="name" value="Item #503, added via an AJAX form with options"/>
								<input type="hidden" name="price" value="45.25"/>
							</li>
						</ul>
					</div>
				<?php echo form_close();?>

				<?php echo form_open($base_url.'standard_library/insert_ajax_form_item_to_cart', array('class'=>'position_right'));?>
					<h6>Example #504</h6>
				
					<div class="frame_note parallel_target">
						<small>
							This example updates the items price depending on the option selected.<br/>
							The example does not submit an array of the items options, so the user cannot change the selected option once added to the cart.
						</small>
						<hr/>
						
						<ul>
							<li>
								<label for="ex504_qty">Quantity:</label>
								<input type="text" id="ex504_qty" name="quantity" value="1" class="width_50 validate_integer"/>
							</li>
							<li>
								<label for="ex504_option">Option with Price:</label>
								<select id="ex504_option" name="option_with_price" class="width_175">
									<option value="1">Option #1 @ <?php echo $this->flexi_cart->get_taxed_currency_value(24.95);?></option>
									<option value="2">Option #2 @ <?php echo $this->flexi_cart->get_taxed_currency_value(32.95);?></option>
									<option value="3">Option #3 @ <?php echo $this->flexi_cart->get_taxed_currency_value(49.95);?></option>
								</select> 
							</li>
							<li>
								<hr/>
								<label>Add to cart:</label>							
								<input type="submit" name="add_item_ajax_form_504" value="Submit" class="link_button add_item_via_ajax_form"/>
								
								<input type="hidden" name="item_id" value="504"/>
								<input type="hidden" name="name" value="Item #504, added via an AJAX form with priced options"/>
							</li>
						</ul>
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
<script>
$(function() 
{
	// Example of adding a item to the cart via a link.
	$('.add_item_via_ajax_link').click(function(event)
	{
		event.preventDefault();

		$.ajax(
		{
			url:$(this).attr('href'),
			success:function(data)
			{
				ajax_update_mini_cart(data);
			}
		});
	});

	// Example of adding a item to the cart via a link.
	$('.add_item_via_ajax_form').click(function(event)
	{
		event.preventDefault();

		// Get the parent form.
		var parent_form = $(this).closest('form');
		
		// Get the url the ajax form data to be submitted to.
		var submit_url = parent_form.attr('action');

		// Get the form data.
		var $form_inputs = parent_form.find(':input');
		var form_data = {};
		$form_inputs.each(function() 
		{
			form_data[this.name] = $(this).val();
		});

		$.ajax(
		{
			url: submit_url,
			type: 'POST',
			data: form_data,
			success:function(data)
			{
				ajax_update_mini_cart(data);
			}
		});
	});

	// A function to display updated ajax cart data from the mini cart menu.
	function ajax_update_mini_cart(data)
	{
		// Replace the current mini cart with the ajax loaded mini cart data. 
		var ajax_mini_cart = $(data).find('#mini_cart');
		$('#mini_cart').replaceWith(ajax_mini_cart);

		// Display a status within the mini cart stating the cart has been updated.
		$('#mini_cart_status').show();

		// Set the new height of the menu for animation purposes.
		var min_cart_height = $('#mini_cart ul:first').height();
		$('#mini_cart').attr('data-menu-height', min_cart_height);
		$('#mini_cart').attr('class', 'js_nav_dropmenu');

		// Scroll to the top of the page.
		$('body').animate({'scrollTop':0}, 250, function()
		{
			// Notify the user that the cart has been updated by showing the mini cart.
			$('#mini_cart ul:first').stop().animate({'height':min_cart_height}, 400).delay(3000).animate({'height':'0'}, 400, function()
			{
				$('#mini_cart_status').hide();
			});
		});
	}
});
</script>

</body>
</html>