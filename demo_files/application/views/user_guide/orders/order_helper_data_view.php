<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Order Helper Data | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for order helper functions in flexi cart."/> 
	<meta name="keywords" content="order helper data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Order Helper Data</h1>
				<p>Helper functions are used to provide value formatting and calculation functionality, or to return data from the carts database tables.</p>
				<p>
					The functions can act independently of data within the cart session, using database table ids or custom data directly submitted to the function to return values, rather than for example requiring the row id of an item in the cart.
				</p>
				<p>
					This independence from data within the cart session means the functions can be used on pages across a site that do not display cart data, or even on items that have not been added to the cart.
				</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
						
			<h2>Order Helper Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/order_index">Order Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_config">Order Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_set_data">Set Order Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/order_admin">Order Admin Data</a>
			
			<div class="anchor_nav">
				<h6>Order Number Helper Functions</h6>
				<p>
					<a href="#generate_order_number">generate_order_number()</a> | <a href="#check_order_number_available">check_order_number_available()</a>
				</p>
				<h6>Email Order</h6>
				<p>
					<a href="#email_order">email_order()</a>
				</p>
			</div>
			
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with Helper Functions</h3>
				
				<span class="toggle">Show / Hide Help</span>
				<div id="help_guide" class="hide_toggle">
					<hr/>
					<p><strong>Name</strong>: The name of the function (method).</p>
					<p>
						<strong>Data Type</strong>: The data type that is expected by the function.
						<ul>
							<li><em>bool</em> : Requires a boolean value of 'TRUE' or 'FALSE'.</li>
							<li><em>string</em> : Requires a textual value.</li>
							<li><em>int</em> : Requires a numeric value. It does not matter whether the value is an integer, float, decimal etc.</li>
							<li><em>array</em> : Requires an array.</li>
						</ul>
					</p>
					<p><strong>Required</strong>: Defines whether the parameter requires a value to be submitted.</p>
					<p><strong>Default</strong>: Defines the default parameter value that is used if no other value is submitted.</p>
				</div>
			</div>

			<a name="generate_order_number"></a>
			<div class="w100 frame">
				<h3 class="heading">generate_order_number()</h3>
				
				<p>Generates an order number.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>generate_order_number(prefix, suffix)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>prefix</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Sets a value that is prefixed to the start of the generated order number.</td>
						</tr>
						<tr>
							<td>suffix</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Sets a value that is suffixed to the end of the generated order number.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function checks whether to generate a random order number or to increment the order number from the last saved order.</p>
					<p>If the order number is to be incremented, the functions calls a SQL query to retrieve the last saved order number and increments the number by one, including any defined 'prefix' or 'suffix'.</p>
					<p>If a random number is to be generated, the function generates a number between 00000001-99999999, includes any defined 'prefix' or 'suffix', and checks the order number does not already exist in the order table.</p>
					<p>The order number is then saved to the cart session data and returned from the function.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>string | Generated order number.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$prefix = 'XY';
$suffix = 'YZ';

$this->flexi_cart_admin->generate_order_number($prefix, $suffix);

<span class="comment">// Could Produce: 'XY00000001YZ'</span>
</pre>
			</div>
			
			<a name="check_order_number_available"></a>
			<div class="w100 frame">
				<h3 class="heading">check_order_number_available()</h3>
				
				<p>Checks whether an order has already been saved with the submitted order number.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>check_order_number_available(order_number)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>order_number</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the order number to be checked.</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL SELECT statement on the 'Order Summary' table, filtered by the 'order_number' value.</p>
					<p>The function then returns a boolean value on whether the order number already exists.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Unavailable:</strong>FALSE</p>
					<p><strong class="spacer_100">Available:</strong>TRUE</p>
				</div>
				
				<h6>Example</h6>
<pre>
$order_number = '00000001';

$this->flexi_cart_admin->check_order_number_available($order_number);
</pre>
			</div>

			<a name="email_order"></a>
			<div class="w100 frame">
				<h3 class="heading">email_order()</h3>
				
				<p>Sends an email populated with data from a saved cart order using the flexi cart email template.</p>
				<hr/>
			
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the admin library only.</p>
					<p>Requires all order database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>email_order(order_number, email_to, email_subject, custom_data)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>order_number</td>
							<td class="align_ctr">string | int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines the unique order number of the order to get data from.</td>
						</tr>
						<tr>
							<td>email_to</td>
							<td class="align_ctr">string | array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Sets the email address of the email recipient<br/>
								Multiple recipients can be set by setting the email addresses in an array.
							</td>
						</tr>
						<tr>
							<td>email_subject</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Sets the emails subject title. If not set, a default title is set.<br/>
								See the notes below for further information.
							</td>
						</tr>
						<tr>
							<td>custom_data</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Sets additional data that will be accessible from the email template file.<br/>
								See the notes below for further information.
							</td>
						</tr>
					</tbody>
				</table>
						
				<h6>How it Works</h6>
				<div class="frame_note">
					<p>The function runs an SQL SELECT statement on the 'Order Summary' table, filtered by the 'order_number' value.</p>
					<p>If the order is returned, the function then runs another SQL query to return all itemised details of the order and creates an array containing data from the order summary table, the order detail table and from the 'custom_data' data.</p>
					<p>The email is then sent using the <a href="<?php echo $base_url; ?>user_guide/cart_config_internal#email_settings">email template and settings</a> defined via the config file, to all recipients defined via the 'email_to' parameter.</p>
				</div>
			
				<h6>Notes</h6>
				<div class="frame_note">
					<p>The variables that are accessible via the email template file will be set in three different arrays.</p>
					<ul>
						<li><strong>$summary_data</strong> : Contains all columns from the order summary table.</li>
						<li><strong>$item_data</strong> : Contains all columns from the order details table.</li>
						<li><strong>$custom_data</strong> : Contains any data defined via the functions 'custom_data' parameter. Only available if 'custom_data' parameter is set.</li>
					</ul>
					<hr/>
					<p>
						If an email subject is not defined, the email will be titled with the 'site_title' defined via the config file, and append the words ' : Order Details'.<br/>
						Example: If <code>$config['email']['site_title'] = 'flexi cart'</code> (See config file), the email title would be <em>'flexi cart : Order Details'</em>.<br/>							
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Examples</h6>
<pre>
<span class="comment bold">// Example of sending an email of a saved order.</span>

$order_number = 'example_order_number';

<span class="comment">// The email recipient(s) can either be set as a string, or as an array like below.</span>
$email_to = array(
'example_1@recipient_email.com',
'example_2@recipient_email.com'
);

$email_subject = 'Example Email Subject Title';

<span class="comment">// Example of defining custom data to be available in the email.</span>
$custom_data = array(
'example_data_1' => 'example_data_1_value',
'example_data_2' => 'example_data_2_value'
);

$this->flexi_cart_admin->email_order($order_number, $email_to, $email_subject, $custom_data);
</pre>
<pre>
<span class="comment bold">// Example of calling variables available via the email template file (Using default table column names).</span>
<?php echo htmlentities('
<h1> Order Number : <?php echo $summary_data["ord_order_number"];?> </h1>

<ul>
<?php foreach( $item_data as $row ) { ?>
<li>
	<?php echo $row["ord_det_item_name"]." @ ".$row["ord_det_price"]; ?>
</li>
<?php } ?>
</ul>

<p> <?php echo $custom_data["custom_data"]; ?> </p>
');?>
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