<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Reward Point and Voucher Function List | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="A user guide list of reward point and voucher functions in flexi cart."/> 
	<meta name="keywords" content="reward point and voucher functions, user guide, flexi cart, shopping cart, codeigniter"/>

	<?php $this->load->view('includes/head'); ?> 
</head>

<body id="user_guide_index">

<div id="body_wrap">
	<!-- Header -->  
	<?php $this->load->view('includes/header'); ?> 

	<!-- User Guide Navigation -->
	<?php $this->load->view('includes/user_guide_header'); ?> 
	
	<!-- Intro Content -->
	<div class="content_wrap intro_bg">
		<div class="content clearfix">
			<div class="intro_text">
				<h1>User Guide | Reward Points and Vouchers</h1>
				<p>Customers can earn reward points when they purchase items. When they earn enough points, they can be converted to a voucher worth a monetary value that can be deducted from a future purchase.</p>
				<p>Below is a compiled list of functions related to reward points and vouchers.</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix parallel">

			<h2>Reward Point and Voucher User Guide Index</h2>				
			<a href="<?php echo $base_url; ?>user_guide/reward_config">Reward Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_session_data">Get Reward Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_helper_data">Get Reward Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_admin">Reward Admin Data</a>
			
			<div class="w100 frame">
				<h3>Reward Point and Voucher Configuration</h3>
				<p>Customise the configuration of the reward point and voucher database tables via the config file.</p>
				<p><a href="<?php echo $base_url; ?>user_guide/reward_config">Reward Config. File Settings</a></p>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Getting Data</h3>
				<small>Get data from the carts session or database.</small>
				<hr/>
				
				<h6>Reward Point Item Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_reward_points">item_reward_points()</a><br/>
						<small>Return reward points of a specific cart row.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_item_session_data#item_reward_points_total">item_reward_points_total()</a><br/>
						<small>Return total reward points of a specific cart row.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Reward Point Summary Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#total_reward_points">total_reward_points()</a><br/>
						<small>Return total reward points of items in the cart.</small>
					</li>
				</ul>
				<hr/>

				<h6>Reward Voucher Summary Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_session_data#reward_voucher_status">reward_voucher_status()</a><br/>
						<small>Return whether a reward voucher has been applied to the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_session_data#reward_voucher_data">reward_voucher_data()</a><br/>
						<small>Returns reward voucher values and descriptions formatted as an array.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_session_data#reward_voucher_description">reward_voucher_description()</a><br/>
						<small>Returns reward voucher values and descriptions formatted as a string.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#reward_voucher_total">reward_voucher_total()</a><br/>
						<small>Return total value of reward vouchers applied to the cart.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_summary_session_data#cart_savings_total">cart_savings_total()</a><br/>
						<small>Return savings total of all discounts and reward vouchers applied to the cart.</small>
					</li>
				</ul>
				
				<h6>Reward Point Config. Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data#reward_point_multiplier">reward_point_multiplier()</a><br/>
						<small>Returns the multiplier value used to calculate the reward points earnt from an items price.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Database / Helper Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_helper_data#calculate_reward_points">calculate_reward_points()</a><br/>
						<small>Returns the number of reward points that would be earnt from a submitted currency value.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 frame parallel_target">
				<h3>Setting Data</h3>
				<small>Set data to the carts session data.</small>
				<hr/>
				
				<h6>Reward Point Config Data</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data#set_reward_point_multiplier">set_reward_point_multiplier()</a><br/>
						<small>Set the reward point to item price multiplier.</small>
					</li>
				</ul>
				<hr/>
			</div>
			
			<div class="w33 r_margin frame parallel_target">
				<h3>Admin Data</h3>
				<small>Run database management functions.</small>
				<hr/>
				
				<h6>Reward Point Management Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_admin#get_reward_point_conversion_tiers">get_reward_point_conversion_tiers()</a><br/>
						<small>Returns an array of reward point tiers required to convert points to a voucher.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_admin#calculate_conversion_reward_points">calculate_conversion_reward_points()</a><br/>
						<small>Returns a rounded value of reward points that can be converted into a voucher.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_admin#calculate_reward_point_value">calculate_reward_point_value()</a><br/>
						<small>Returns the monetary value of a submitted amount of reward points.</small>
					</li>
				</ul>
				<hr/>

				<h6>Reward Point CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_admin#get_db_reward_points">get_db_reward_points()</a><br/>
						<small>Itemised SQL SELECT query on reward point (order) tables.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_admin#get_db_reward_point_summary">get_db_reward_point_summary()</a><br/>
						<small>Summarised SQL SELECT query on reward point (order) tables.</small>
					</li>
				</ul>
				<hr/>

				<h6>Converted Reward Point CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_admin#get_db_converted_reward_points">get_db_converted_reward_points()</a><br/>
						<small>SQL SELECT query on converted reward points table.</small>
					</li>
				</ul>
				<hr/>
				
				<h6>Reward Voucher CRUD Functions</h6>
				<ul>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_admin#get_db_voucher">get_db_voucher()</a><br/>
						<small>SQL SELECT query on reward voucher (discount) table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_admin#insert_db_voucher">insert_db_voucher()</a><br/>
						<small>SQL INSERT statement on reward voucher (discount) table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_admin#update_db_voucher">update_db_voucher()</a><br/>
						<small>SQL UPDATE statement on reward voucher (discount) table.</small>
					</li>
					<li>
						<a href="<?php echo $base_url; ?>user_guide/reward_admin#delete_db_voucher">delete_db_voucher()</a><br/>
						<small>SQL DELETE statement on reward voucher (discount) table.</small>
					</li>
				</ul>
				<hr/>
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