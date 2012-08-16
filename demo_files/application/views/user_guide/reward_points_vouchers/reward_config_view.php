<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Reward Points and Vouchers Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for configuring reward points and vouchers in flexi cart."/> 
	<meta name="keywords" content="reward points and vouchers configuration, user guide, flexi cart, shopping cart, codeigniter"/>
	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="user_guide">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- User Guide Navigation -->
	<?php $this->load->view('includes/user_guide_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>User Guide | Reward Point and Voucher Configuration</h1>
				<p>
					flexi cart contains many features to aid the custom development of an e-commerce site.<br/>
					In some instances, some of the features may be considered overkill, or may not require a database table to handle a feature.<br/>
					In these cases, specific database tables can be disabled, or with some tables, specific columns can be disabled if not required.
				</p>
				<p>In addition to this, the database tables and columns can be renamed to match the custom naming conventions.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			
			<h2>Reward Point and Voucher Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/reward_index">Reward Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_session_data">Get Reward Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_helper_data">Get Reward Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_admin">Reward Admin Data</a>

			<div class="anchor_nav">
				<h6>Config Setup Information</h6>
				<p>
					<a href="#db_schema_diagram">Table Schema Diagram</a> | <a href="#reward_setup_notes">Setup Notes</a>
				</p>
				<h6>Table and Config File Settings</h6>
				<p>
					<a href="#reward_points">Reward Points Pseudo Table</a> | <a href="#reward_points_converted">Reward Points Converted Table</a>
				</p>
			</div>
		
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with the Table Configuration</h3>
				<span class="toggle">Show / Hide Help</span>
				<div id="help_guide" class="hide_toggle">
					<hr/>
					<p><strong>Internal Name</strong>: The name that flexi cart internally references the table or column by.</p>
					<p><strong>Default Name</strong>: The default table or column name used in the actual table.</p>
					<p>
						<strong>Data Type</strong>: The data type that is expected by the table column.
						<ul>
							<li><em>bool</em> : Requires a boolean value set as either '0' (FALSE) or '1' (TRUE).</li>
							<li><em>string</em> : Requires a textual value.</li>
							<li><em>int</em> : Requires a numeric value. It does not matter whether the value is an integer, float, decimal etc.</li>
						</ul>
					</p>
					<hr/>
					
					<h6>Config File Location</h6>
					<p>The config file is located in CodeIgniters 'config' folder and is named 'flexi_cart.php'.</p>
				</div>
			</div>

			<a name="db_schema_diagram"></a>
			<div class="w100 frame">
				<h3 class="heading">Reward Points Table Schema Diagram</h3>
				<div class="frame_note">
					<p>
						A database table schema diagram, showing how the reward points tables are related to each other and the discount tables.<br/>
						Note: The reward points table does not actually exist, it is a SQL SELECT query joining data from the order summary and order details tables.
						Table and columns names are defined using their internal names.
					</p>
				</div>
				<img src="<?php echo $includes_dir; ?>images/db_diagrams/reward_points_tables.jpg" class="db_schema_diagram"/>
			</div>
			
			<a name="reward_setup_notes"></a>
			<div class="w100 frame">
				<h3 class="heading">General Reward Point and Voucher Setup Notes</h3>
				<p>Below are some general notes to consider when setting up and managing the reward point and voucher tables.</p>
				<ul>
					<li>
						The reward points table does not actually exist as a real table in the database, it is simply an SQL query that uses columns joined from the order tables to track how many reward points a user has earnt.
					</li>
					<li>
						As the reward points are directly related to the order tables, if any records are deleted from these tables, the associated reward points will also be deleted.
					</li>
					<li>
						<p>If the order tables are setup to track the quantity of '<a href="<?php echo $base_url; ?>user_guide/misc_info#shipped_cancelled_quantities">shipped</a>' and '<a href="<?php echo $base_url; ?>user_guide/misc_info#shipped_cancelled_quantities">cancelled</a>' items from customer orders, then the allocation of reward points are directly related to these columns.</p>
						<p>If an item is marked as shipped, the associated reward points are activated for use after a <a href="<?php echo $base_url; ?>user_guide/cart_config_settings#reward_point_days_pending">defined number of days</a>, which is recommended as being the number of days stated on the items return policy.</p>
						<p>The purpose of only activating the items outside of the return policy date, is to prevent customers from purchasing items soley to earn reward points that they can then spend on other items. Once they have bought the other items, they can then return the initially purchased item for a refund.</p>
						<p>If an item is cancelled after a customer has converted the related reward points to a reward voucher, the cart cannot deduct the associated reward points as they have been converted. Instead, the cart deducts the outstanding points from any other points the customer has earnt, if they do not have enough, their reward point total goes into a negative value so that any reward points earnt in future will repay the outstanding amount.</p>
					</li>
					<li>
						If the above mentioned 'shipped' and 'cancelled' columns are not used, the reward points are allocated the same number of defined days after the date the order was placed. To cancel the associated reward points from the order, the whole order would need to be cancelled using the order status column.
					</li>
				</ul>
			</div>

			<a name="reward_points"></a>
			<div class="w100 frame">
				<h3 class="heading">Reward Points Pseudo Table</h3>
				
				<div class="frame_note">
					<p>Contains data on reward points that have been earnt by registered users when completing an order.</p>
					<p>The reward points table does not actually exist, the data returned from reward point functions are a combination of joined data from the order summary and order details tables, with then a set of pseudo columns that are created within the SQL queries and returned as alias columns.</p>
				</div>

				<h6>Itemised Pseudo Column Names</h6>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Internal Name</th>
							<th class="spacer_125">Default Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>row_points_total</td>
							<td>row_points_total</td>
							<td class="align_ctr">int</td>
							<td>The total reward points earnt from one row of the order detail table.</td>
						</tr>
						<tr>
							<td>row_points_pending</td>
							<td>row_points_pending</td>
							<td class="align_ctr">int</td>
							<td>The total reward points from one row of the order detail table that are pending activation.</td>
						</tr>
						<tr>
							<td>row_points_active</td>
							<td>row_points_active</td>
							<td class="align_ctr">int</td>
							<td>The total reward points from one row of the order detail table that are currently active.</td>
						</tr>
						<tr>
							<td>row_points_expired</td>
							<td>row_points_expired</td>
							<td class="align_ctr">int</td>
							<td>The total reward points from one row of the order detail table that have expired.</td>
						</tr>
						<tr>
							<td>row_points_converted</td>
							<td>row_points_converted</td>
							<td class="align_ctr">int</td>
							<td>The total reward points from one row of the order detail table that have been converted to a reward voucher.</td>
						</tr>
						<tr>
							<td>row_points_cancelled</td>
							<td>row_points_cancelled</td>
							<td class="align_ctr">int</td>
							<td>The total reward points from one row of the order detail table that have been cancelled (or returned).</td>
						</tr>
						<tr>
							<td>activate_date</td>
							<td>activate_date</td>
							<td class="align_ctr">string | int</td>
							<td>
								The date and time that the reward points were activated on.<br/>
								The data type of this column can either be mysql datetime or a unix timestamp.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/cart_config_internal#date_time">internal config</a> documentation regarding setting the carts date and time settings.
							</td>
						</tr>
						<tr>
							<td>expire_date</td>
							<td>expire_date</td>
							<td class="align_ctr">string | int</td>
							<td>
								The date and time that the reward points expire.<br/>
								The data type of this column can either be mysql datetime or a unix timestamp.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/cart_config_internal#date_time">internal config</a> documentation regarding setting the carts date and time settings.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>Summary Pseudo Column Names</h6>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Internal Name</th>
							<th class="spacer_125">Default Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>total_points</td>
							<td>total_points</td>
							<td class="align_ctr">int</td>
							<td>The total reward points earnt from all of a users orders.</td>
						</tr>
						<tr>
							<td>total_points_pending</td>
							<td>total_points_pending</td>
							<td class="align_ctr">int</td>
							<td>The total reward points from all of a users orders that are pending activation.</td>
						</tr>
						<tr>
							<td>total_points_active</td>
							<td>total_points_active</td>
							<td class="align_ctr">int</td>
							<td>The total reward points from all of a users orders that are currently active.</td>
						</tr>
						<tr>
							<td>total_points_expired</td>
							<td>total_points_expired</td>
							<td class="align_ctr">int</td>
							<td>The total reward points from all of a users orders that have expired.</td>
						</tr>
						<tr>
							<td>total_points_converted</td>
							<td>total_points_converted</td>
							<td class="align_ctr">int</td>
							<td>The total reward points from all of a users orders that have been converted to reward vouchers.</td>
						</tr>
						<tr>
							<td>total_points_cancelled</td>
							<td>total_points_cancelled</td>
							<td class="align_ctr">int</td>
							<td>The total reward points from all of a users orders that have been cancelled (or returned).</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and the '<a href="#reward_points_converted">Reward Points Converted</a>' table and all of the '<a href="<?php echo $base_url; ?>user_guide/orders_config_guide">Order</a>' and '<a href="<?php echo $base_url; ?>user_guide/discounts_config_guide">Discount</a>' tables must be enabled too.</p>
					<hr/>
					<p>Note: The reward points table does not actually exist. The reward point data is generated from an SQL SELECT query that joins data from the order summary and order detail tables, and then creates the 'Pseudo' columns within the query.</p>
					<p>The config file contains three sets of variables for the 'reward_points' table, unless disabling the table, do not edit ANY of the details from the first set as these are used  to join data from the order summary and order detail tables.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the <strong class="uline">pseudo</strong> column names.</span>

$config['database']['reward_points']['columns']['row_points_total'] = 'row_points_total';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['reward_points']['table'] = FALSE;
</pre>
			</div>
					
			<a name="reward_points_converted"></a>
			<div class="w100 frame">
				<h3 class="heading">Converted Reward Points Table</h3>
				
				<p>Contains data on reward points that have been converted to discount codes.</p>
				<hr/>

				<h6>Table and Column Names</h6>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Internal Name</th>
							<th class="spacer_125">Default Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>table</td>
							<td>reward_points_converted</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>rew_convert_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>reward</td>
							<td>rew_convert_ord_detail_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the reward points converted to the order detail row.<br/>
								The value acts as a foreign key relating the table to the primary key of the order details table.
							</td>
						</tr>
						<tr>
							<td>discount</td>
							<td>rew_convert_discount_fk</td>
							<td class="align_ctr">int</td>
							<td>
								Relates the converted reward points to the created reward voucher.<br/>
								The value acts as a foreign key relating the table to the primary key of the discount table.
							</td>
						</tr>
						<tr>
							<td>points</td>
							<td>rew_convert_points</td>
							<td class="align_ctr">int</td>
							<td>The number of reward points that were converted.</td>
						</tr>
						<tr>
							<td>date</td>
							<td>rew_convert_date</td>
							<td class="align_ctr">string | int</td>
							<td>
								The date and time that the reward points were converted on.<br/>
								The data type of this column can either be mysql datetime or a unix timestamp.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/cart_config_internal#date_time">internal config</a> documentation regarding setting the carts date and time settings.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then all columns are required and the '<a href="#reward_points">Reward Points</a>' table and all of the '<a href="<?php echo $base_url; ?>user_guide/orders_config_guide">Order</a>' and '<a href="<?php echo $base_url; ?>user_guide/discounts_config_guide">Discount</a>' tables must be enabled too.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['reward_points_converted']['table'] = 'reward_points_converted';
$config['database']['reward_points_converted']['columns']['id'] = 'rew_convert_id';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['reward_points_converted']['table'] = FALSE;
</pre>
			</div>					

		</div>
	</div>	
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>