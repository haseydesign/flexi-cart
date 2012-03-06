<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Reward Point and Voucher Session Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for reward point and voucher session data functions in flexi cart."/> 
	<meta name="keywords" content="reward point and voucher session data functions, user guide, flexi cart, shopping cart, codeigniter"/>

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
				<h1>User Guide | Getting Reward Point and Voucher Session Data</h1>
				<p>
					When the flexi cart library is first loaded, an array is automatically created that is setup to match the carts default settings, this data is then stored in the browsers session. All items and settings that are then later added and altered within the cart are updated to the carts session data.
				</p>
				<p>
					The data within the carts session can then be accessed and in many cases, formatted and customised using the large range of functions that are available from the lite and standard libraries.
				</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			
			<h2>Get Reward Point and Voucher Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/reward_index">Reward Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_config">Reward Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_helper_data">Get Reward Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/reward_admin">Reward Admin Data</a>

			<div class="anchor_nav">
				<h6>Get Reward Voucher Data from Session</h6>
				<p>
					<a href="#reward_voucher_status">reward_voucher_status()</a> | <a href="#reward_voucher_data">reward_voucher_data()</a> | <a href="#reward_voucher_description">reward_voucher_description()</a>
				</p>
			</div>
				
			<a name="help"></a>
			<div class="w100 frame">
				<h3 class="heading">Help with Session Data Functions</h3>
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

			<a name="reward_voucher_status"></a>
			<div class="w100 frame">
				<h3 class="heading">reward_voucher_status()</h3>
				
				<p>Return whether any reward vouchers have been applied to the cart.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Not Applied:</strong>FALSE</p>
					<p><strong class="spacer_100">Applied:</strong>TRUE</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>reward_voucher_status()</code>
							<small>Are any reward vouchers applied to the cart?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php var_dump($this->flexi_cart->reward_voucher_status());?></td>
					</tr>
				</table>
			</div>

			<a name="reward_voucher_data"></a>
			<div class="w100 frame">
				<h3 class="heading">reward_voucher_data()</h3>
				
				<p>Returns an array of all reward voucher values and descriptions.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>reward_voucher_data(format, internal_value)</code>
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
							<td>format</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether to format the returned monetary values as currencies.</td>
						</tr>
						<tr>
							<td>internal_value</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to return the monetary values using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>array (Empty)</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>reward_voucher_data(TRUE, TRUE)</code>
							<small>Display the <span class="uline">current</span> value and description for all set reward vouchers.</small>						
							<span class="toggle tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->reward_voucher_data(TRUE, TRUE));?></pre>
						</td>
					</tr>
					<tr>
						<td>
							<code>reward_voucher_data(TRUE, FALSE)</code>
							<small>Display the <span class="uline">internal</span> value and description data for all set reward vouchers.</small>						
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->reward_voucher_data(TRUE, FALSE));?></pre>
						</td>
					</tr>
				</table>
			</div>

			<a name="reward_voucher_description"></a>
			<div class="w100 frame">
				<h3 class="heading">reward_voucher_description()</h3>
				
				<p>Returns reward voucher values and descriptions formatted as a string.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>reward_voucher_description(value_prefix, suffix_delimiter, internal_value)</code>
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
							<td>value_prefix</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Defines a string of characters to separate the reward voucher description and value.<br/>
								If no 'value_prefix' is set, the reward voucher value will be omitted from the returned description.
							</td>
						</tr>
						<tr>
							<td>prefix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines a string of characters to prefix to the start of each reward voucher description.</td>
						</tr>
						<tr>
							<td>suffix_delimiter</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr"><?php echo htmlentities('<br/>');?></td>
							<td>Defines a string of characters to suffix to the end of each reward voucher description.</td>
						</tr>
						<tr>
							<td>internal_value</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to return the monetary values using the carts internal currency instead of the users current currency.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
				<h6>Examples</h6>				<small>Note: The returned example values below are displaying live data from the current cart session data.</small>				<table class="example">					<tr>
						<td>
							<code>reward_voucher_description(FALSE, FALSE, '<?php echo htmlentities('<br/>');?>', FALSE)</code>
							<small>Format the reward voucher description with a line break after each row and the value omitted.</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($reward_voucher_description = $this->flexi_cart->reward_voucher_description(FALSE, FALSE, '<br/>', FALSE))
							{
								echo $reward_voucher_description;
							}
							else
							{
								var_dump($reward_voucher_description);
							}
						?>
						</td>
					</tr>
					<tr>
						<td>
							<code>reward_voucher_description('@<?php echo htmlentities('&nbsp;');?>', '<?php echo htmlentities('<p>');?>', '<?php echo htmlentities('</p>');?>', FALSE)</code>
							<small>Format the reward voucher description with a prefixed space and '@' sign between the description and <span class="uline">current</span> value, and with each row wrapped in a html <?php echo htmlentities('<p>');?> tag.</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
						<?php 
							if ($reward_voucher_description = $this->flexi_cart->reward_voucher_description('&nbsp;@&nbsp;', '<p>', '</p>', FALSE))
							{
								echo $reward_voucher_description;
							}
							else
							{
								var_dump($reward_voucher_description);
							}
						?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>reward_voucher_description('@<?php echo htmlentities('&nbsp;');?>', '<?php echo htmlentities('<p>');?>', '<?php echo htmlentities('</p>');?>', TRUE)</code>
							<small>Format the reward voucher description with a prefixed space and '@' sign between the description and <span class="uline">internal</span> value, and with each row wrapped in a html <?php echo htmlentities('<p>');?> tag.</small>
						</td>
						<td class="spacer_200 align_ctr">
						<?php 
							if ($reward_voucher_description = $this->flexi_cart->reward_voucher_description('&nbsp;@&nbsp;', '<p>', '</p>', TRUE))
							{
								echo $reward_voucher_description;
							}
							else
							{
								var_dump($reward_voucher_description);
							}
						?>
						</td>
					</tr>
				</table>
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