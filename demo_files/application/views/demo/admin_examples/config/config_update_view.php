<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Update Cart Configuration | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update cart configuration function."/> 
	<meta name="keywords" content="update, cart configuration, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="config_update">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Cart Configuration</h1>
				<p>Many of the features of flexi cart can be controlled via a series of configuration settings, that can define how specific internal functions perform automatic operations to data within the cart.</p>
				<p>The configuration of the cart can be set either via the hand coded configuration file located on the server, or via the configuration database table.</p>
				<p>By defining configuration settings via the database, they can be edited without requiring access to the server.</p>
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
										
			<h1>Manage Cart Configuration</h1>
			<p><a href="<?php echo $base_url; ?>admin_library/defaults">Manage Cart Defaults</a></p>

			<?php echo form_open(current_url());?>
				<fieldset>
					<legend>Orders</legend>
					<p class="highlight_red">Note: Click the input labels for further information on each config setting.</p>
					<hr/>
					
					<ul class="info_note">
						<li>
							<label for="order_number_prefix" class="toggle">Order Number Prefix</label>
							<input type="text" id="order_number_prefix" name="update[order_number_prefix]" value="<?php echo set_value('update[order_number_prefix]', $config[$this->flexi_cart_admin->db_column('configuration', 'order_number_prefix')]); ?>" placeholder="NULL" class="width_100"/>
							
							<small class="hide_toggle frame_note">
								<strong>Set a prefix value to the cart order number.</strong><br/>
								Example: Order # = "12345", Preffix = "Flexi", Formatted Order # = "Flexi12345"
							</small>
						</li>
						<li>
							<label for="order_number_suffix" class="toggle">Order Number Suffix</label>
							<input type="text" id="order_number_suffix" name="update[order_number_suffix]" value="<?php echo set_value('update[order_number_suffix]', $config[$this->flexi_cart_admin->db_column('configuration', 'order_number_suffix')]); ?>" placeholder="NULL" class="width_100"/>
							
							<small class="hide_toggle frame_note">
								<strong>Set a suffix value to the cart order number.</strong><br/>
								Example: Order # = "12345", Suffix = "Flexi", Formatted Order # = "12345Flexi"
							</small>
						</li>
						<li>
							<label for="increment_order_number" class="toggle">Increment Order Number</label>
							<?php $increment_order_number = (bool)$config[$this->flexi_cart_admin->db_column('configuration', 'increment_order_number')]; ?>
							<input type="hidden" name="update[increment_order_number]" value="0"/>
							<input type="checkbox" id="increment_order_number" name="update[increment_order_number]" value="1" <?php echo set_checkbox('update[increment_order_number]','1', $increment_order_number); ?>/>
							
							<small class="hide_toggle frame_note">
								<strong>Should the cart order number be incremented from the last order number, or should it be a randomly generated number?</strong>
							</small>
						</li>
						<li>
							<label for="minimum_order" class="toggle">Minimum Order Value (&pound;)</label>
							<input type="text" id="minimum_order" name="update[minimum_order]" value="<?php echo set_value('update[minimum_order]', $config[$this->flexi_cart_admin->db_column('configuration', 'minimum_order')]); ?>" placeholder="0" class="width_50 validate_decimal"/>
							
							<small class="hide_toggle frame_note">
								<strong>What is the minimum order value?</strong><br/>
								This value can then be checked against a particular summary column.
							</small>
						</li>
					</ul>	
				</fieldset>
					
				<fieldset>
					<legend>Quantities / Stock</legend>
					<ul class="info_note">
						<li>
							<label for="quantity_decimals" class="toggle">Quantity Decimals</label>
							<input type="text" id="quantity_decimals" name="update[quantity_decimals]" value="<?php echo set_value('update[quantity_decimals]', $config[$this->flexi_cart_admin->db_column('configuration', 'quantity_decimals')]); ?>" placeholder="0" class="width_50 validate_integer"/>
							
							<small class="hide_toggle frame_note">
								<strong>How many decimals are acceptable for items quantities?</strong><br/>
								Typically, this should be zero, however, some situations may require half quantities that would be entered into the cart as '0.5', this would require 1 decimal.
							</small>
						</li>
						<li>
							<label for="increment_duplicate_item_quantity" class="toggle">Increment Duplicate Quantities</label>
							<?php $increment_duplicate_item_quantity = (bool)$config[$this->flexi_cart_admin->db_column('configuration', 'increment_duplicate_item_quantity')]; ?>
							<input type="hidden" name="update[increment_duplicate_item_quantity]" value="0"/>
							<input type="checkbox" id="increment_duplicate_item_quantity" name="update[increment_duplicate_item_quantity]" value="1" <?php echo set_checkbox('update[increment_duplicate_item_quantity]','1', $increment_duplicate_item_quantity); ?>/>
							
							<small class="hide_toggle frame_note">
								<strong>Should an items quantity be incremented when an identical duplicate is added to the cart?</strong><br/>
								If not, the new quantity will be used.
							</small>
						</li>
						<li>
							<label for="quantity_limited_by_stock" class="toggle">Quantity Limited by Stock</label>
							<?php $quantity_limited_by_stock = (bool)$config[$this->flexi_cart_admin->db_column('configuration', 'quantity_limited_by_stock')]; ?>
							<input type="hidden" name="update[quantity_limited_by_stock]" value="0"/>
							<input type="checkbox" id="quantity_limited_by_stock" name="update[quantity_limited_by_stock]" value="1" <?php echo set_checkbox('update[quantity_limited_by_stock]','1', $quantity_limited_by_stock); ?>/>
							
							<small class="hide_toggle frame_note">
								<strong>Should the maximum quantity of cart items be limited to the databases item stock quantity?</strong>
							</small>
						</li>
						<li>
							<label for="remove_no_stock_items" class="toggle">Remove Out-of-Stock Items</label>
							<?php $remove_no_stock_items = (bool)$config[$this->flexi_cart_admin->db_column('configuration', 'remove_no_stock_items')]; ?>
							<input type="hidden" name="update[remove_no_stock_items]" value="0"/>
							<input type="checkbox" id="remove_no_stock_items" name="update[remove_no_stock_items]" value="1" <?php echo set_checkbox('update[remove_no_stock_items]','1', $remove_no_stock_items); ?>/>
							
							<small class="hide_toggle frame_note">
								<strong>Should out-of-stock items be automatically removed from the cart?</strong>
							</small>
						</li>
						<li>
							<label for="auto_allocate_stock" class="toggle">Auto Allocate Item Stock</label>
							<?php $auto_allocate_stock = (bool)$config[$this->flexi_cart_admin->db_column('configuration', 'auto_allocate_stock')]; ?>
							<input type="hidden" name="update[auto_allocate_stock]" value="0"/>
							<input type="checkbox" id="auto_allocate_stock" name="update[auto_allocate_stock]" value="1" <?php echo set_checkbox('update[auto_allocate_stock]','1', $auto_allocate_stock); ?>/>								

							<small class="hide_toggle frame_note">
								<strong>Should stock quantities be automatically updated and managed by flexi cart?</strong><br/>
								When an order is confirmed, items within the cart that are also in the 'item_stock' table will have their stock deducted.<br/>
								Likewise, if items within an order are cancelled, they will be auto restocked into the 'item_stock' table.
							</small>
						</li>
						<li>
							<label for="save_banned_shipping_items" class="toggle">Save Banned Shipping Items</label>
							<?php $save_banned_shipping_items = (bool)$config[$this->flexi_cart_admin->db_column('configuration', 'save_banned_shipping_items')]; ?>
							<input type="hidden" name="update[save_banned_shipping_items]" value="0"/>
							<input type="checkbox" id="save_banned_shipping_items" name="update[save_banned_shipping_items]" value="1" <?php echo set_checkbox('update[save_banned_shipping_items]','1', $save_banned_shipping_items); ?>/>
							
							<small class="hide_toggle frame_note">
								<strong>If an item is not permitted to be shipped to the current shipping location, yet the user still completes the order, should the item details be saved to the database?</strong>
							</small>
						</li>
						<li>
							<label for="multi_row_duplicate_items" class="toggle">Multi Row Duplicate Items</label>
							<?php $multi_row_duplicate_items = (bool)$config[$this->flexi_cart_admin->db_column('configuration', 'multi_row_duplicate_items')]; ?>
							<input type="hidden" name="update[multi_row_duplicate_items]" value="0"/>
							<input type="checkbox" id="multi_row_duplicate_items" name="update[multi_row_duplicate_items]" value="1" <?php echo set_checkbox('update[multi_row_duplicate_items]','1', $multi_row_duplicate_items); ?>/>
							
							<small class="hide_toggle frame_note">
								<strong>Should all duplicate cart items be added as a new separate row in the cart?</strong><br/>
								If not the existing item will be updated.
							</small>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Weights</legend>
					<ul class="info_note">
						<li>
							<label for="weight_type" class="toggle">Weight Type</label>
							<?php $weight_type = $config[$this->flexi_cart_admin->db_column('configuration', 'weight_type')];?>
							<select id="weight_type" name="update[weight_type]">
								<option value="gram" <?php echo set_select('update[weight_type]', 'gram', ($weight_type == 'gram'));?>>Grams</option>
								<option value="kilogram" <?php echo set_select('update[weight_type]', 'kilogram', ($weight_type == 'kilogram'));?>>Kilograms</option>
								<option value="avoir ounce" <?php echo set_select('update[weight_type]', 'avoir ounce', ($weight_type == 'avoir ounce'));?>>Ounce (Avoir)</option>
								<option value="avoir pound" <?php echo set_select('update[weight_type]', 'avoir pound', ($weight_type == 'avoir pound'));?>>Pounds (Avoir)</option>
								<option value="troy ounce" <?php echo set_select('update[weight_type]', 'troy ounce', ($weight_type == 'troy ounce'));?>>Ounce (Troy)</option>
								<option value="troy pound" <?php echo set_select('update[weight_type]', 'troy pound', ($weight_type == 'troy pound'));?>>Pounds (Troy)</option>
								<option value="carat" <?php echo set_select('update[weight_type]', 'carat', ($weight_type == 'carat'));?>>Carats</option>
							</select>
							
							<small class="hide_toggle frame_note">
								<strong>Set the default weight to display item weights as.</strong>
							</small>
						</li>
						<li>
							<label for="weight_decimals" class="toggle">Weight Decimals</label>
							<input type="text" id="weight_decimals" name="update[weight_decimals]" value="<?php echo set_value('update[weight_decimals]', $config[$this->flexi_cart_admin->db_column('configuration', 'weight_decimals')]); ?>" placeholder="0" class="width_50 validate_decimal"/>
							
							<small class="hide_toggle frame_note">
								<strong>Set the default number of decimals points to display item weights by.</strong>
							</small>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Tax</legend>
					<ul class="info_note">
						<li>
							<label for="display_tax_prices" class="toggle">Display Tax Prices</label>
							<?php $display_tax_prices = (bool)$config[$this->flexi_cart_admin->db_column('configuration', 'display_tax_prices')]; ?>
							<input type="hidden" name="update[display_tax_prices]" value="0"/>
							<input type="checkbox" id="display_tax_prices" name="update[display_tax_prices]" value="1" <?php echo set_checkbox('update[display_tax_prices]','1', $display_tax_prices); ?>/>
							
							<small class="hide_toggle frame_note">
								<strong>Should item prices be displayed including tax by default?</strong>
							</small>
						</li>
						<li>
							<label for="price_inc_tax" class="toggle">Prices Include Tax</label>
							<?php $price_inc_tax = (bool)$config[$this->flexi_cart_admin->db_column('configuration', 'price_inc_tax')]; ?>
							<input type="hidden" name="update[price_inc_tax]" value="0"/>
							<input type="checkbox" id="price_inc_tax" name="update[price_inc_tax]" value="1" <?php echo set_checkbox('update[price_inc_tax]','1', $price_inc_tax); ?>/>
							
							<small class="hide_toggle frame_note">
								<strong>Do item prices typically include tax when added to the cart?</strong>
							</small>
						</li>
					</ul>
				</fieldset>
											
				<fieldset>
					<legend>Reward Points / Vouchers</legend>
					<ul class="info_note">
						<li>
							<label for="dynamic_reward_points" class="toggle">Dynamic Reward Points</label>
							<?php $dynamic_reward_points = (bool)$config[$this->flexi_cart_admin->db_column('configuration', 'dynamic_reward_points')]; ?>
							<input type="hidden" name="update[dynamic_reward_points]" value="0"/>
							<input type="checkbox" id="dynamic_reward_points" name="update[dynamic_reward_points]" value="1" <?php echo set_checkbox('update[dynamic_reward_points]','1', $dynamic_reward_points); ?>/>
							
							<small class="hide_toggle frame_note">
								<strong>Should reward points be based on the internal value of an item, or should it be based on the items current tax rate based price?</strong><br/>
								Example: An item is added to the cart costing &pound;20 including 20% tax, the user then ships to a 10% tax zone, so the item now costs &pound;18.33.<br/>
								i.e. Remove 20% tax: &pound;20 / 20% = &pound;16.67, then add 10% tax: &pound;16.67 * 10% = &pound;18.33,<br/>
								Should the reward points be based on the dynamic tax variable price, or the initial internal &pound;20 price? 'Checked' = dynamic, 'Non Checked' = Internal.
							</small>
						</li>
						<li>
							<label for="reward_point_multiplier" class="toggle">Reward Point Multiplier</label>
							<input type="text" id="reward_point_multiplier" name="update[reward_point_multiplier]" value="<?php echo set_value('update[reward_point_multiplier]', round($config[$this->flexi_cart_admin->db_column('configuration', 'reward_point_multiplier')],4)); ?>" placeholder="0" class="width_50 validate_decimal"/>
							
							<small class="hide_toggle frame_note">
								<strong>How many reward points are awarded per 1.00 currency unit of an items price?</strong><br/>
								Example: A multiplier of 10 is (10 x &pound;1.00) = 10 reward points. Therefore, an item priced at &pound;100 would be worth 1000 reward points.
							</small>
						</li>
						<li>
							<label for="reward_voucher_multiplier" class="toggle">Reward Voucher Multiplier</label>
							<input type="text" id="reward_voucher_multiplier" name="update[reward_voucher_multiplier]" value="<?php echo set_value('update[reward_voucher_multiplier]', round($config[$this->flexi_cart_admin->db_column('configuration', 'reward_voucher_multiplier')],4)); ?>" placeholder="0" class="width_50 validate_decimal"/>
							
							<small class="hide_toggle frame_note">
								<strong>How much is each reward point worth as a currency value when converted to a reward voucher?</strong><br/>
								Example: If 250 reward points were converted using a multiplier of &pound;0.01 per point, the reward voucher would be worth &pound;2.50 (250 x 0.01).
							</small>
						</li>
						<li>
							<label for="reward_point_to_voucher_ratio" class="toggle">Reward Point to Voucher Ratio</label>
							<input type="text" id="reward_point_to_voucher_ratio" name="update[reward_point_to_voucher_ratio]" value="<?php echo set_value('update[reward_point_to_voucher_ratio]', $config[$this->flexi_cart_admin->db_column('configuration', 'reward_point_to_voucher_ratio')]); ?>" placeholder="0" class="width_50 validate_integer"/>
							
							<small class="hide_toggle frame_note">
								<strong>How many reward points are required to create 1 reward voucher?</strong><br/>
								Examples:<br/>
								A ratio of 250 means for every 250 reward points, 1 voucher worth 250 points can be created, this voucher is then worth a defined currency value.<br/>
								A customer with 500 reward points could create either 1 voucher of 500 points, or 2 vouchers with 250 points each.<br/>
								A customer creating a voucher with 525 reward points, would only be able to convert and use 500 points, the remaining 25 remain as active reward points.
							</small>
						</li>
						<li>
							<label for="reward_point_days_pending" class="toggle">Days Reward Point Pending</label>
							<input type="text" id="reward_point_days_pending" name="update[reward_point_days_pending]" value="<?php echo set_value('update[reward_point_days_pending]', $config[$this->flexi_cart_admin->db_column('configuration', 'reward_point_days_pending')]); ?>" placeholder="0" class="width_50 validate_integer"/>
							
							<small class="hide_toggle frame_note">
								<strong>Once an item order has been set as 'Completed' (i.e. shipped to customer), after how many days should reward points earnt from the item become active?</strong><br/>
								The idea of this option is to prevent a customer from placing an order soley to earn reward points, then purchasing a second order using a reward voucher earnt from the first order. The customer could then return the first order for a refund, but the reward points earnt from it have already been used to purchase the second order at a cheaper price.<br/>
								The number of days set should reflect the stores return policy, for example, if items cannot be returned after 14 days, the reward points should only become active after 14 days.<br/>
								Note: Reward points only become active x days after the order has been set by an admin as 'Completed', not x days after the order was first received.
							</small>
						</li>
						<li>
							<label for="reward_point_days_valid" class="toggle">Days Reward Point Valid</label>
							<input type="text" id="reward_point_days_valid" name="update[reward_point_days_valid]" value="<?php echo set_value('update[reward_point_days_valid]', $config[$this->flexi_cart_admin->db_column('configuration', 'reward_point_days_valid')]); ?>" placeholder="0" class="width_50 validate_integer"/>
							
							<small class="hide_toggle frame_note">
								<strong>How many days are reward points valid for?</strong><br/>
								Example: 365 = 365 days (1 year).
							</small>
						</li>
						<li>
							<label for="reward_voucher_days_valid" class="toggle">Days Reward Voucher Valid</label>
							<input type="text" id="reward_voucher_days_valid" name="update[reward_voucher_days_valid]" value="<?php echo set_value('update[reward_voucher_days_valid]', $config[$this->flexi_cart_admin->db_column('configuration', 'reward_voucher_days_valid')]); ?>" placeholder="0" class="width_50 validate_integer"/>
							
							<small class="hide_toggle frame_note">
								<strong>How many days are reward vouchers valid for?</strong><br/>
								Example: 365 = 365 days (1 year).
							</small>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Custom Statuses</legend>
					<small>
						<strong>Three individual custom cart statuses can be set to affect whether discounts become active.</strong><br/>
						The custom statuses can contain any string or integer values, if the value then matches the the custom status of a discount, then provided all other discount conditions are also matched, the discount is activated.
					</small>
					<hr/>
					
					<ul>
						<li>
							<label for="custom_status_1">Custom Status 1</label>
							<input type="text" id="custom_status_1" name="update[custom_status_1]" value="<?php echo set_value('update[custom_status_1]', $config[$this->flexi_cart_admin->db_column('configuration', 'custom_status_1')]); ?>" class="width_50"/>
						</li>
						<li>
							<label for="custom_status_2">Custom Status 2</label>
							<input type="text" id="custom_status_2" name="update[custom_status_2]" value="<?php echo set_value('update[custom_status_2]', $config[$this->flexi_cart_admin->db_column('configuration', 'custom_status_2')]); ?>" class="width_50"/>
						</li>
						<li>
							<label for="custom_status_3">Custom Status 3</label>
							<input type="text" id="custom_status_3" name="update[custom_status_3]" value="<?php echo set_value('update[custom_status_3]', $config[$this->flexi_cart_admin->db_column('configuration', 'custom_status_3')]); ?>" class="width_50"/>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Update Cart Configuration</legend>
					<p>
						<strong class="highlight_red">Note: For the purposes of this demo, when the cart configuration is updated, the cart contents and all settings are destroyed, so that the new config settings can be set.</strong>
					</p>

					<input type="submit" name="update_config" value="Update Cart Configuration" class="link_button large"/>
				</fieldset>
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