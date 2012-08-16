<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Update Discount | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts update discount function."/> 
	<meta name="keywords" content="update, discount, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="discount_update">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Discounts</h1>
				<p>Discounts can be setup with a wide range of rule conditions that can then be applied to specific items, groups of items or across the entire cart.</p>
				<p>Discount activation rules can be set to check the value and quantity of items in the cart, a customers location and up to three custom statuses within the cart. For example whether a customer has logged in, or is regarded as a new customer.</p>
				<p>Other options include activation and expiry dates, usage limits, voiding of reward points and whether discounts can be combined with other discounts.</p>
				<p>To comply with tax laws in different countries and states, the method of calculating tax on discounted items can be set using one of three methods.</p>
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
										
			<h1>Update Discount</h1>
			<p>
				<a href="<?php echo $base_url; ?>admin_library/item_discounts">Manage Item Discounts</a> | 
				<a href="<?php echo $base_url; ?>admin_library/summary_discounts">Manage Summary Discounts</a> | 
				<a href="<?php echo $base_url; ?>admin_library/discount_groups">Manage Discount Groups</a>
			</p>
						
			<?php echo form_open(current_url());?>
				<fieldset>
					<legend>Type / Location</legend>
					<ul class="position_left">
						<li class="info_req">
							<label for="discount_type">Discount Type:</label>
							<select id="discount_type" name="update[type]" class="width_200 tooltip_trigger" 
								title="<strong>Field Required</strong><br/> Sets whether the discount is an item or summary discount, or a reward voucher."
							>
								<option value="0"> - Select Discount Type - </option>
							<?php 
								foreach($discount_types as $type) { 
									$id = $type[$this->flexi_cart_admin->db_column('discount_types', 'id')];
									$select_type = ($discount_data[$this->flexi_cart_admin->db_column('discounts', 'type')] == $id);
							?>
								<option value="<?php echo $id;?>" <?php echo set_select('update[type]', $id, $select_type);?>>
									<?php echo $type[$this->flexi_cart_admin->db_column('discount_types', 'type')];?>
								</option>
							<?php } ?>
							</select>
						</li>
						<li class="info_req">
							<label for="discount_method">Discount Method:</label>
							<select id="discount_method" name="update[method]" class="width_200 tooltip_trigger" 
								title="<strong>Field Required</strong><br/> Set which cart value to apply the discount to."
							>
								<option value="0" class="parent_id_0"> - Select Discount Method - </option>
							<?php 
								foreach($discount_methods as $method) { 
									$id = $method[$this->flexi_cart_admin->db_column('discount_methods', 'id')];
									$select_method = ($discount_data[$this->flexi_cart_admin->db_column('discounts', 'method')] == $id);
							?>
								<option value="<?php echo $id;?>" class="parent_id_<?php echo $method[$this->flexi_cart_admin->db_column('discount_methods', 'type')];?>" <?php echo set_select('update[method]', $id, $select_method);?>>
									<?php echo $method[$this->flexi_cart_admin->db_column('discount_methods', 'method')];?>
								</option>
							<?php } ?>
							</select>
						</li>
						<li>
							<label for="discount_tax_method">Tax Appliance Method:</label>
							<select id="discount_tax_method" name="update[tax_method]" class="width_200 tooltip_trigger" 
								title="Set how tax should be applied to the discount."
							>
								<option value="0"> - Select Tax Method - </option>
								<option value="0">Carts Default Tax Method</option>
							<?php 
								foreach($discount_tax_methods as $tax_method) { 
									$id = $tax_method[$this->flexi_cart_admin->db_column('discount_tax_methods', 'id')];
									$select_tax_method = ($discount_data[$this->flexi_cart_admin->db_column('discounts', 'tax_method')] == $id);
							?>
								<option value="<?php echo $id;?>" <?php echo set_select('update[tax_method]', $id, $select_tax_method);?>>
									<?php echo $tax_method[$this->flexi_cart_admin->db_column('discount_tax_methods', 'method')];?>
								</option>
							<?php } ?>
							</select>
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<label for="discount_location">Location:</label>
							<select id="discount_location" name="update[location]" class="width_200 tooltip_trigger" 
								title="Set the location that the discount is applied to."
							>
								<option value="0"> - All Locations - </option>
							<?php 
								foreach($locations_inline as $location) { 
									$id = $location[$this->flexi_cart_admin->db_column('locations', 'id')];
									$select_location = ($discount_data[$this->flexi_cart_admin->db_column('discounts', 'location')] == $id);
							?>
								<option value="<?php echo $id;?>" <?php echo set_select('update[location]', $id, $select_location);?>>
									<?php echo $location[$this->flexi_cart_admin->db_column('locations', 'name')];?>
								</option>
							<?php } ?>
							</select>
						</li>
						<li>
							<label for="discount_zone">Zone:</label>
							<select id="discount_zone" name="update[zone]" class="width_200 tooltip_trigger" 
								title="Set the zone that the discount is applied to. <br/>Note: If a location is set, it has priority over a zone rule."
							>
								<option value="0"> - All Zones - </option>
							<?php 
								foreach($zones as $zone) { 
									$id = $zone[$this->flexi_cart_admin->db_column('location_zones', 'id')];
									$select_zone = ($discount_data[$this->flexi_cart_admin->db_column('discounts', 'zone')] == $id);
							?>
								<option value="<?php echo $id;?>" <?php echo set_select('update[zone]', $id, $select_zone);?>>
									<?php echo $zone[$this->flexi_cart_admin->db_column('location_zones', 'name')];?>
								</option>
							<?php } ?>
							</select>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Target Group / Item</legend>
					<ul class="position_left">
						<li>
							<label for="discount_group">Apply Discount to Group:</label>
							<select id="discount_group" name="update[group]" class="width_200 tooltip_trigger" 
								title="Set the discount to apply if an item in a particular discount group is added to the cart."
							>
								<option value="0"> - Not applied to a Group - </option>
							<?php 
								foreach($discount_groups as $group) { 
									$id = $group[$this->flexi_cart_admin->db_column('discount_groups', 'id')];
									$select_group = ($discount_data[$this->flexi_cart_admin->db_column('discounts', 'group')] == $id);
							?>
								<option value="<?php echo $id;?>" <?php echo set_select('update[group]', $id, $select_group);?>>
									<?php echo $group[$this->flexi_cart_admin->db_column('discount_groups', 'name')];?>
								</option>
							<?php } ?>
							</select>
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<label for="discount_item">Apply Discount to Item:</label>
							<select id="discount_item" name="update[item]" class="width_200 tooltip_trigger" 
								title="Set the discount to apply if a particular item is added to the cart."
							>
								<option value="0"> - Not applied to an Item - </option>	
							<?php 
								foreach($items as $item) { 
									$id = $item['item_id'];
									$select_item = ($discount_data[$this->flexi_cart_admin->db_column('discounts', 'item')] == $id);
							?>
								<option value="<?php echo $id;?>" <?php echo set_select('update[item]', $id, $select_item);?>>
									<?php echo $item['item_name'];?>
								</option>
							<?php } ?>
							</select>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Code / Description</legend>						
					<ul class="position_left">
						<li>
							<label for="discount_code">Discount Code:</label>
							<input type="text" id="discount_code" name="update[code]" value="<?php echo set_value('update[code]', $discount_data[$this->flexi_cart_admin->db_column('discounts', 'code')]);?>" class="width_200 tooltip_trigger" 
								title="Set the code required to apply the discount. Leave blank if the discount is activated via item quantities or values."
							/>
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<label for="discount_description">Discount Description:</label>
							<textarea id="discount_description" name="update[description]" class="width_200 tooltip_trigger" 
								title="A short description of the discount that is displayed to the customer."
							><?php echo set_value('update[description]', $discount_data[$this->flexi_cart_admin->db_column('discounts', 'description')]);?></textarea>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Requirements / Discount</legend>						
					<ul class="position_left">
						<li>
							<label for="discount_quantity_required">Quantity Required to Activate:</label>
							<input type="text" id="discount_quantity_required" name="update[quantity_required]" value="<?php echo set_value('update[quantity_required]', $discount_data[$this->flexi_cart_admin->db_column('discounts', 'quantity_required')]);?>" class="width_100 validate_integer tooltip_trigger" 
								title="Set the quantity of items required to activate the discount.<br/> For example, for a 'buy 5 get 2 free' discount, the quantity would be 7 (5+2)."
							/>
						</li>
						<li>
							<label for="discount_quantity_discounted">Quantity Discounted:</label>
							<input type="text" id="discount_quantity_discounted" name="update[quantity_discounted]" value="<?php echo set_value('update[quantity_discounted]', $discount_data[$this->flexi_cart_admin->db_column('discounts', 'quantity_discounted')]);?>" class="width_100  validate_integer tooltip_trigger" 
								title="Set the quantity of items that the discount is applied to.<br/> For example, for a 'buy 5 get 2 free' discount, the quantity would be 2."
							/>
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<label for="discount_value_required">Value Required to Activate:</label>
							<input type="text" id="discount_value_required" name="update[value_required]" value="<?php echo set_value('update[value_required]', $discount_data[$this->flexi_cart_admin->db_column('discounts', 'value_required')]);?>" class="width_100 validate_decimal tooltip_trigger" 
								title="Set the value required to active the discount.<br/> For item discounts, the value is the total value of the discountable items.<br/> For summary discounts, the value is the cart total."
							/>
						</li>
						<li>
							<label for="discount_value_discounted">Value Discounted:</label>
							<input type="text" id="discount_value_discounted" name="update[value_discounted]" value="<?php echo set_value('update[value_discounted]', $discount_data[$this->flexi_cart_admin->db_column('discounts', 'value_discounted')]);?>" class="width_100 validate_decimal tooltip_trigger" 
								title="Set the value of the discount that is applied.<br/> For percentage discounts, this value is used as the discount percentage.<br/> For 'flat fee' and 'new value' discounts, this is the discounted currency value."
							/>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Functionality</legend>						
					<ul class="position_left">
						<li>
							<label for="discount_recursive">Discount Recursive:</label>
							<?php $recursive = (bool) $discount_data[$this->flexi_cart_admin->db_column('discounts', 'recursive')]; ?>
							<input type="hidden" name="update[recursive]" value="0"/>
							<input type="checkbox" id="discount_recursive" name="update[recursive]" value="1" <?php echo set_checkbox('update[recursive]','1', $recursive); ?> class="tooltip_trigger" 
								title="If checked, the discount can be repeated multiples times to the same cart.<br/> For example, if checked, a 'Buy 1, get 1 free' discount can be reapplied if 2, 4, 6 (etc) items are added to the cart.<br/> If not checked, the discount is only applied for the first 2 items."
							/>
						</li>
						<li>
							<label for="discount_non_combinable">Non Combinable Discount:</label>
							<?php $non_combinable = (bool) $discount_data[$this->flexi_cart_admin->db_column('discounts', 'non_combinable')]; ?>
							<input type="hidden" name="update[non_combinable]" value="0"/>
							<input type="checkbox" id="discount_non_combinable" name="update[non_combinable]" value="1" <?php echo set_checkbox('update[non_combinable]','1', $non_combinable); ?> class="tooltip_trigger" 
								title="If checked, the discount cannot be and combined and used with any other discounts or reward vouchers."
							/>
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<label for="discount_void_reward">Void Reward Points:</label>
							<?php $void_reward = (bool) $discount_data[$this->flexi_cart_admin->db_column('discounts', 'void_reward_points')]; ?>
							<input type="hidden" name="update[void_reward]" value="0"/>
							<input type="checkbox" id="discount_void_reward" name="update[void_reward]" value="1" <?php echo set_checkbox('update[void_reward]','1', $void_reward); ?> class="tooltip_trigger" 
								title="If checked, any reward points earnt from items within the cart will be reset to zero whilst the discount is used."
							/>
						</li>
						<li>
							<label for="discount_force_shipping">Force Shipping Discount:</label>
							<?php $force_shipping = (bool) $discount_data[$this->flexi_cart_admin->db_column('discounts', 'force_shipping_discount')]; ?>
							<input type="hidden" name="update[force_shipping]" value="0"/>
							<input type="checkbox" id="discount_force_shipping" name="update[force_shipping]" value="1" <?php echo set_checkbox('update[force_shipping]','1', $force_shipping); ?> class="tooltip_trigger" 
								title="If checked, the discount value will be 'forced' on the carts shipping option calculations, even if the selected shipping option has not been set as being discountable."
							/>
						</li>
					</ul>
				</fieldset>

				<fieldset>
					<legend>Custom Cart Statuses</legend>						
					<ul>
						<li>
							<small>
								Three individual custom cart statuses can be set to affect whether discounts become active.<br/>
								The custom statuses can contain any string or integer values, if the value then matches the the custom status of a discount, then provided all other discount conditions are also matched, the discount is activated.
							</small>
							<small>
								For example, a custom status could check whether a user is logged in, by default it is set to false (0), when a user then logs in, the status could be set to true (1) which would then enable the discount.
							</small>
						</li>
						<li>
							<label for="discount_custom_status_1">Custom Status #1:</label>
							<input type="text" id="discount_custom_status_1" name="update[custom_status_1]" value="<?php echo set_value('update[custom_status_1]', $discount_data[$this->flexi_cart_admin->db_column('discounts', 'custom_status_1')]); ?>" class="width_75"/>
						</li>
						<li>
							<label for="discount_custom_status_2">Custom Status #2:</label>
							<input type="text" id="discount_custom_status_2" name="update[custom_status_2]" value="<?php echo set_value('update[custom_status_2]', $discount_data[$this->flexi_cart_admin->db_column('discounts', 'custom_status_2')]); ?>" class="width_75"/>
						</li>
						<li>
							<label for="discount_custom_status_3">Custom Status #3:</label>
							<input type="text" id="discount_custom_status_3" name="update[custom_status_3]" value="<?php echo set_value('update[custom_status_3]', $discount_data[$this->flexi_cart_admin->db_column('discounts', 'custom_status_3')]); ?>" class="width_75"/>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Usage Status / Validity</legend>						
					<ul class="position_left">
						<li class="info_req">
							<label for="discount_usage_limit">Discount Usage Limit:</label>
							<input type="text" id="discount_usage_limit" name="update[usage_limit]" value="<?php echo set_value('update[usage_limit]', $discount_data[$this->flexi_cart_admin->db_column('discounts', 'usage_limit')]);?>" class="width_100 validate_integer tooltip_trigger" 
								title="<strong>Field Required</strong><br/>Set the number of times remaining that the discount can be used."
							/>
						</li>
						<li class="info_req">
							<?php 
								// Crop MYSQL 'datetime' data to just display the date, not the time.
								$valid_date = substr($discount_data[$this->flexi_cart_admin->db_column('discounts', 'valid_date')], 0, 10); 
							?>
							<label for="discount_valid_date">Discount Valid Date:</label>
							<input type="text" id="discount_valid_date" name="update[valid_date]" value="<?php echo set_value('update[valid_date]', $valid_date);?>" maxlength="10" class="width_100 tooltip_trigger" 
								title="<strong>Field Required</strong><br/>Set the start date that the discount is valid from."
							/>
						</li>
						<li class="info_req">
							<?php 
								// Crop MYSQL 'datetime' data to just display the date, not the time.
								$expire_date = substr($discount_data[$this->flexi_cart_admin->db_column('discounts', 'expire_date')], 0, 10); 
							?>
							<label for="discount_expire_date">Discount Expire Date:</label>
							<input type="text" id="discount_expire_date" name="update[expire_date]" value="<?php echo set_value('update[expire_date]', $expire_date);?>" maxlength="10" class="width_100 tooltip_trigger" 
								title="<strong>Field Required</strong><br/>Set the expiry date that the discount is valid until."
							/>
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<label for="discount_status">Active Status:</label>
							<?php $status = (bool) $discount_data[$this->flexi_cart_admin->db_column('discounts', 'status')]; ?>
							<input type="hidden" name="update[status]" value="0"/>
							<input type="checkbox" id="discount_status" name="update[status]" value="1" <?php echo set_checkbox('update[status]','1', $status); ?> class="tooltip_trigger" 
								title="If checked, the discount will be set as 'active'."
							/>
						</li>
						<li>
							<label for="discount_order_by">Order By:</label>
							<input type="text" id="discount_order_by" name="update[order_by]" value="<?php echo set_value('update[order_by]', $discount_data[$this->flexi_cart_admin->db_column('discounts', 'order_by')]);?>" class="width_100 validate_integer tooltip_trigger" 
								title="Set the order that the discount is applied to the cart if other discounts are active. The lower the number, the higher priority."
							/>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Update Discount</legend>
					<input type="submit" name="update_discount" value="Update Discount" class="link_button large"/>
				</fieldset>
			<?php echo form_close();?>						

		</div>
	</div>
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 
<script>
$(function() {
	dependent_menu('discount_type', 'discount_method', false, true);
});
</script>

</body>
</html>