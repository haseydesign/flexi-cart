<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Item Management | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A live working demo of flexi carts functions to manage items (Products)."/> 
	<meta name="keywords" content="item management functions, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="items">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- Demo Navigation -->
	<?php $this->load->view('includes/demo_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>Admin Library | Item Data</h1>
				<p>When designing an e-commerce store, the database structure regarding item (Product) tables and their related category tables are best custom made to the websites required specification.</p>
				<p>Due to this, flexi cart does not come with a defined structure and set of tables to implement these elements, it is left up to you the developer.</p>
				<p>However, some features of flexi cart require an item table to relate to, for example, item shipping rates, item tax rates, stock levels and item discounts.</p>
				<p>Therefore, this demo includes a demo item table as an example of how you can build and relate the features of flexi cart with a real world application.</p>
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
				<h1>Manage Item Data</h1>
				<a href="<?php echo $base_url; ?>admin_library/item_discounts">Manage Item Discounts</a> |
				<a href="<?php echo $base_url; ?>admin_library/discount_groups">Manage Discount Groups</a>

				<table>
					<thead>
						<tr>
							<th class="tooltip_trigger" 
								title="The name of the item that can then be viewed via the 'Add Database Items to Cart' examples page. <br/>Access this page via the 'Item Examples' on the nav menu.">
								Item Name
							</th>
							<th class="spacer_100 tooltip_trigger" 
								title="To emulate a real-world setup, an example 'Category' table is included to relate items to categories. <br/>The categories can be used when filtering items in discount groups.">
								Category
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger" 
								title="The weight of the item when added to the cart.">
								Weight
								(<?php echo $this->flexi_cart_admin->weight_symbol(); ?>)
							</th>
							<th class="spacer_75 align_ctr tooltip_trigger" 
								title="The price of the item when added to the cart.">
								Price
								(<?php echo $this->flexi_cart_admin->currency_symbol(TRUE); ?>)
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger" 
								title="The current stock level of an item.">
								Stock Level
							</th>
							<th class="spacer_100 align_ctr tooltip_trigger" 
								title="If checked, the cart will auto allocate item stock when items are ordered or cancelled.">
								Auto Allocate Stock
							</th>
							<th class="spacer_125 align_ctr tooltip_trigger" 
								title="Manage specific shipping rules for the item.">
								Item Shipping Rules
							</th>
							<th class="spacer_125 align_ctr tooltip_trigger" 
								title="Manage specific tax rates for the item.">
								Item Taxes
							</th>
						</tr>
					</thead>
				<?php if (! empty($item_data)) { ?>	
					<tbody>
					<?php 
						foreach ($item_data as $row) { 
							$item_id = $row['item_id'];						
					?>
						<tr>
							<td>
								<input type="hidden" name="update[<?php echo $item_id; ?>][id]" value="<?php echo $item_id;?>"/>
								<?php echo $row['item_name']; ?>
							</td>
							<td>
								<small><?php echo $row['cat_name']; ?></small>
							</td>
							<td class="align_ctr">
								<input type="text" name="update[<?php echo $item_id; ?>][weight]" value="<?php echo $row['item_weight']; ?>" class="width_50 align_ctr validate_decimal"/>
							</td>
							<td class="align_ctr">
								<input type="text" name="update[<?php echo $item_id; ?>][price]" value="<?php echo $row['item_price']; ?>" class="width_50 align_ctr validate_decimal"/>
							</td>
							<td class="align_ctr">
								<!-- 
									The item stock table setup is a little different from other tables.
									The table has a one-to-one relationship with the user defined item table (i.e. There can only be 1 stock record related per item record)
									This means that the stock data columns could in fact be included in the user defined item table.
								-->
								<input type="text" name="update[<?php echo $item_id; ?>][stock_quantity]" value="<?php echo $row[$this->flexi_cart_admin->db_column('item_stock', 'quantity')]; ?>" class="width_50 align_ctr validate_integer"/>
							</td>
							<td class="align_ctr">
								<?php $auto_allocate_status = (bool)$row[$this->flexi_cart_admin->db_column('item_stock', 'auto_allocate_status')]; ?>
								<input type="hidden" name="update[<?php echo $item_id; ?>][auto_allocate_status]" value="0"/>
								<input type="checkbox" name="update[<?php echo $item_id; ?>][auto_allocate_status]" value="1" <?php echo set_checkbox('update[auto_allocate_status]','1', $auto_allocate_status); ?>/>
							</td>
							<td class="align_ctr">
								<a href="<?php echo $base_url; ?>admin_library/item_shipping/<?php echo $row['item_id']; ?>">Manage</a>
							</td>
							<td class="align_ctr">
								<a href="<?php echo $base_url; ?>admin_library/item_tax/<?php echo $row['item_id']; ?>">Manage</a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="8">
								<input type="submit" name="update_items" value="Update Items" class="link_button large"/>
							</td>
						</tr>
					</tfoot>
				<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="8">
								There are no items setup to view.
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