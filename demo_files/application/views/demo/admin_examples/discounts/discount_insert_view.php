<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Insert Discount | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts insert discount function."/> 
	<meta name="keywords" content="insert, discount, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="discount_insert">

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
										
			<h1>Insert New Discount</h1>
			<p>
				<a href="<?php echo $base_url; ?>admin_library/item_discounts">Manage Item Discounts</a> | 
				<a href="<?php echo $base_url; ?>admin_library/summary_discounts">Manage Summary Discounts</a> | 
				<a href="<?php echo $base_url; ?>admin_library/discount_groups">Manage Item Discount Groups</a>
			</p>
						
			<?php echo form_open(current_url());?>
				<fieldset>
					<legend>Type / Location</legend>
					<ul class="position_left">
						<li class="info_req">
							<label for="discount_type">Discount Type:</label>
							<select id="discount_type" name="insert[type]" class="width_200 tooltip_trigger" 
								title="<strong>Field Required</strong><br/> Sets whether the discount is an item or summary discount, or a reward voucher."
							>
								<option value="0"> - Select Discount Type - </option>
							<?php 
								foreach($discount_types as $type) { 
									$id = $type[$this->flexi_cart_admin->db_column('discount_types', 'id')];
							?>
								<option value="<?php echo $id; ?>" <?php echo set_select('insert[type]', $id); ?>>
									<?php echo $type[$this->flexi_cart_admin->db_column('discount_types', 'type')];?>
								</option>
							<?php } ?>
							</select>
						</li>
						<li class="info_req">
							<label for="discount_method">Discount Method:</label>
							<select id="discount_method" name="insert[method]" class="width_200 tooltip_trigger" 
								title="<strong>Field Required</strong><br/> Set which cart value to apply the discount to."
							>
								<option value="0" class="parent_id_0"> - Select Discount Method - </option>
							<?php 
								foreach($discount_methods as $method) { 
									$id = $method[$this->flexi_cart_admin->db_column('discount_methods', 'id')];
							?>
								<option value="<?php echo $id; ?>" class="parent_id_<?php echo $method[$this->flexi_cart_admin->db_column('discount_methods', 'type')];?>" <?php echo set_select('insert[method]', $id); ?>>
									<?php echo $method[$this->flexi_cart_admin->db_column('discount_methods', 'method')];?>
								</option>
							<?php } ?>
							</select>
						</li>
						<li>
							<label for="discount_tax_method">Tax Appliance Method:</label>
							<select id="discount_tax_method" name="insert[tax_method]" class="width_200 tooltip_trigger" 
								title="Set how tax should be applied to the discount."
							>
								<option value="0"> - Select Tax Method - </option>
								<option value="0">Carts Default Tax Method</option>
							<?php 
								foreach($discount_tax_methods as $tax_method) { 
									$id = $tax_method[$this->flexi_cart_admin->db_column('discount_tax_methods', 'id')];
							?>
								<option value="<?php echo $id; ?>" <?php echo set_select('insert[tax_method]', $id); ?>>
									<?php echo $tax_method[$this->flexi_cart_admin->db_column('discount_tax_methods', 'method')];?>
								</option>
							<?php } ?>
							</select>
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<label for="discount_location">Location:</label>
							<select id="discount_location" name="insert[location]" class="width_200 tooltip_trigger" 
								title="Set the location that the discount is applied to."
							>
								<option value="0"> - All Locations - </option>
							<?php 
								foreach($locations_inline as $location) { 
									$id = $location[$this->flexi_cart_admin->db_column('locations', 'id')];
							?>
								<option value="<?php echo $id; ?>" <?php echo set_select('insert[location]', $id); ?>>
									<?php echo $location[$this->flexi_cart_admin->db_column('locations', 'name')];?>
								</option>
							<?php } ?>
							</select>
						</li>
						<li>
							<label for="discount_zone">Zone:</label>
							<select id="discount_zone" name="insert[zone]" class="width_200 tooltip_trigger" 
								title="Set the zone that the discount is applied to. <br/>Note: If a location is set, it has priority over a zone rule."
							>
								<option value="0"> - All Zones - </option>
							<?php 
								foreach($zones as $zone) { 
									$id = $zone[$this->flexi_cart_admin->db_column('location_zones', 'id')];
							?>
								<option value="<?php echo $id; ?>" <?php echo set_select('insert[zone]', $id); ?>>
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
							<select id="discount_group" name="insert[group]" class="width_200 tooltip_trigger" 
								title="Set the discount to apply if an item in a particular discount group is added to the cart."
							>
								<option value="0"> - Not applied to a Group - </option>
							<?php 
								foreach($discount_groups as $group) { 
									$id = $group[$this->flexi_cart_admin->db_column('discount_groups', 'id')];
							?>
								<option value="<?php echo $id; ?>" <?php echo set_select('insert[group]', $id); ?>>
									<?php echo $group[$this->flexi_cart_admin->db_column('discount_groups', 'name')];?>
								</option>
							<?php } ?>
							</select>
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<label for="discount_item">Apply Discount to Item:</label>
							<select id="discount_item" name="insert[item]" class="width_200 tooltip_trigger" 
								title="Set the discount to apply if a particular item is added to the cart."
							>
								<option value="0"> - Not applied to an Item - </option>	
							<?php foreach($items as $item) {?>
								<option value="<?php echo $item['item_id']; ?>" <?php echo set_select('insert[item]', $item['item_id']); ?>>
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
							<label for="discount_code">Code:</label>
							<input type="text" id="discount_code" name="insert[code]" value="<?php echo set_value('insert[code]');?>" class="width_200 tooltip_trigger" 
								title="Set the code required to apply the discount. Leave blank if the discount is activated via item quantities or values."
							/>
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<label for="discount_desc">Description:</label>
							<textarea id="discount_desc" name="insert[description]" class="width_200 tooltip_trigger" 
								title="A short description of the discount that is displayed to the customer."
							><?php echo set_value('insert[description]');?></textarea>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Requirements / Discount</legend>						
					<ul class="position_left">
						<li>
							<label for="discount_qty_req">Quantity Required to Activate:</label>
							<input type="text" id="discount_qty_req" name="insert[quantity_required]" value="<?php echo set_value('insert[quantity_required]');?>" class="width_100 validate_integer tooltip_trigger" 
								title="Set the quantity of items required to activate the discount.<br/> For example, for a 'buy 5 get 2 free' discount, the quantity would be 7 (5+2)."
							/>
						</li>
						<li>
							<label for="discount_qty_disc">Discount Quantity:</label>
							<input type="text" id="discount_qty_disc" name="insert[quantity_discounted]" value="<?php echo set_value('insert[quantity_discounted]');?>" class="width_100  validate_integer tooltip_trigger" 
								title="Set the quantity of items that the discount is applied to.<br/> For example, for a 'buy 5 get 2 free' discount, the quantity would be 2."
							/>
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<label for="discount_value_req">Value Required to Activate:</label>
							<input type="text" id="discount_value_req" name="insert[value_required]" value="<?php echo set_value('insert[value_required]');?>" class="width_100 validate_decimal tooltip_trigger" 
								title="Set the value required to active the discount.<br/> For item discounts, the value is the total value of the discountable items.<br/> For summary discounts, the value is the cart total."
							/>
						</li>
						<li>
							<label for="discount_value_disc">Discount Value:</label>
							<input type="text" id="discount_value_disc" name="insert[value_discounted]" value="<?php echo set_value('insert[value_discounted]');?>" class="width_100 validate_decimal tooltip_trigger" 
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
							<input type="hidden" name="insert[recursive]" value="0"/>
							<input type="checkbox" id="discount_recursive" name="insert[recursive]" value="1" <?php echo set_checkbox('insert[recursive]', '1'); ?> class="tooltip_trigger" 
								title="If checked, the discount can be repeated multiples times to the same cart.<br/> For example, if checked, a 'Buy 1, get 1 free' discount can be reapplied if 2, 4, 6 (etc) items are added to the cart.<br/> If not checked, the discount is only applied for the first 2 items."
							/>
						</li>
						<li>
							<label for="discount_non_combinable">Non Combinable Discount:</label>
							<input type="hidden" name="insert[non_combinable]" value="0"/>
							<input type="checkbox" id="discount_non_combinable" name="insert[non_combinable]" value="1" <?php echo set_checkbox('insert[non_combinable]', '1'); ?> class="tooltip_trigger" 
								title="If checked, the discount cannot be and combined and used with any other discounts or reward vouchers."
							/>
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<label for="discount_void_reward">Void Reward Points:</label>
							<input type="hidden" name="insert[void_reward]" value="0"/>
							<input type="checkbox" id="discount_void_reward" name="insert[void_reward]" value="1" <?php echo set_checkbox('insert[void_reward]', '1'); ?> class="tooltip_trigger" 
								title="If checked, any reward points earnt from items within the cart will be reset to zero whilst the discount is used."
							/>
						</li>
						<li>
							<label for="discount_force_shipping">Force Shipping Discount:</label>
							<input type="hidden" name="insert[force_shipping]" value="0"/>
							<input type="checkbox" id="discount_force_shipping" name="insert[force_shipping]" value="1" <?php echo set_checkbox('insert[force_shipping]','1'); ?> class="tooltip_trigger" 
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
							<input type="text" id="discount_custom_status_1" name="insert[custom_status_1]" value="<?php echo set_value('insert[custom_status_1]'); ?>" class="width_75"/>
						</li>
						<li>
							<label for="discount_custom_status_2">Custom Status #2:</label>
							<input type="text" id="discount_custom_status_2" name="insert[custom_status_2]" value="<?php echo set_value('insert[custom_status_2]'); ?>" class="width_75"/>
						</li>
						<li>
							<label for="discount_custom_status_3">Custom Status #3:</label>
							<input type="text" id="discount_custom_status_3" name="insert[custom_status_3]" value="<?php echo set_value('insert[custom_status_3]'); ?>" class="width_75"/>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Usage Status / Validity</legend>						
					<ul class="position_left">
						<li class="info_req">
							<label for="discount_usage_limit">Usage Limit:</label>
							<input type="text" id="discount_usage_limit" name="insert[usage_limit]" value="<?php echo set_value('insert[usage_limit]');?>" class="width_100 validate_integer tooltip_trigger" 
								title="<strong>Field Required</strong><br/>Set the number of times remaining that the discount can be used."
							/>
						</li>
						<li class="info_req">
							<label for="discount_valid_date">Valid Date (yyyy-mm-dd):</label>
							<input type="text" id="discount_valid_date" name="insert[valid_date]" value="<?php echo set_value('insert[valid_date]', date('Y-m-d'));?>" maxlength="10" class="width_100 tooltip_trigger" 
								title="<strong>Field Required</strong><br/>Set the start date that the discount is valid from."
							/>
						</li>
						<li class="info_req">
							<label for="discount_expire_date">Expire Date (yyyy-mm-dd):</label>
							<input type="text" id="discount_expire_date" name="insert[expire_date]" value="<?php echo set_value('insert[expire_date]', date('Y-m-d', strtotime('3 Month')));?>" maxlength="10" class="width_100 tooltip_trigger" 
								title="<strong>Field Required</strong><br/>Set the expiry date that the discount is valid until."
							/>
							
						</li>
					</ul>
					<ul class="position_right">
						<li>
							<label for="discount_status">Active Status:</label>
							<input type="hidden" name="insert[status]" value="0"/>
							<input type="checkbox" id="discount_status" name="insert[status]" value="1" <?php echo set_checkbox('insert[status]', '1', TRUE); ?> class="tooltip_trigger" 
								title="If checked, the discount will be set as 'active'."
							/>
						</li>
						<li>
							<label for="discount_order_by">Order By:</label>
							<input type="text" id="discount_order_by" name="insert[order_by]" value="<?php echo set_value('insert[order_by]');?>" class="width_100 validate_integer tooltip_trigger" 
								title="Set the order that the discount is applied to the cart if other discounts are active. The lower the number, the higher priority."
							/>
						</li>
					</ul>
				</fieldset>
					
				<fieldset>
					<legend>Insert Discount</legend>
					<input type="submit" name="insert_discount" value="Insert Discount" class="link_button large"/>
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