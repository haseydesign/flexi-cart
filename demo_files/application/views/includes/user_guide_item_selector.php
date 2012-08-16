	<div id="item_selector_wrap">
		<div id="item_selector">
			<?php echo form_open(current_url());?>
				<div class="left">
					<h3>User Guide Live Example Item</h3>
					<small>
						The function examples using a '$row_id' or '$item_id' parameter are using real data from the carts current session data.<br/>
						You can select the cart item you wish to display values for by using the select menu. 
						<a href="<?php echo $base_url; ?>lite_library/item_link_examples">[Add New Item to Cart]</a>
					</small>
				</div>
				
				<div class="right">
					<select id="select_cart_row" name="row_id">
					<?php foreach($cart_items as $row => $item) { ?>
						<option value="<?php echo $item['row_id']; ?>" <?php echo set_select('row_id', $item['row_id'], ($row_id == $item['row_id'])); ?>>
							<?php echo $item['name']; ?>
						</option>
					<?php } ?>
					</select>
				</div>
			<?php echo form_close();?>
			<span class="item_selector_status">User guide example item has been updated!</span>
		</div>
	</div>