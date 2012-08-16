<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Set Surcharge Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for setting surcharge data in flexi cart."/> 
	<meta name="keywords" content="setting surcharge data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Setting Surcharge Session Data</h1>
				<p>Data is set to the cart session by using functions primarily from flexi carts standard library.</p>
				<p>The data that can be set in the cart session includes data of items added to the cart, user localisation data and cart configuration settings.</p>
				<p>
					Since many of flexi carts features can be set using either manually submitted data, or data retrieved from the database; there are often two versions of a function to set session data. Functions that update session data using the database are prefixed with the function name 'update_xxx', whilst functions that use manually set data are prefixed with the name 'set_xxx'.
				</p>
			</div>		
		</div>
	</div>
	
	<!-- Main Content -->
	<div class="content_wrap main_content_bg">
		<div class="content clearfix">
			
				<h2>Set Surcharge Session Data</h2>
				<a href="<?php echo $base_url; ?>user_guide/surcharge_index">Surcharge Function Index</a> |
				<a href="<?php echo $base_url; ?>user_guide/surcharge_session_data">Get Surcharge Session Data</a>

				<div class="anchor_nav">
					<h6>Set Surcharge Data to Session</h6>
					<p>
						<a href="#set_surcharge">set_surcharge()</a>
					</p>
					<h6>Unset Session Surcharge Data</h6>
					<p>
						<a href="#unset_surcharge">unset_surcharge()</a>
					</p>
				</div>
					
				<a name="help"></a>
				<div class="w100 frame">
					<h3 class="heading">Help with Setting Session Data Functions</h3>
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

				<a name="set_surcharge"></a>
				<div class="w100 frame">
					<h3 class="heading">set_surcharge()</h3>
					
					<p>Manually set or update a cart summary surcharge as either a fixed value or a percentage based on a cart summary column value.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the standard library only.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>set_surcharge(surcharge_data, recalculate_cart)</code>
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
								<td>surcharge_data</td>
								<td class="align_ctr">array</td>
								<td class="align_ctr">Yes</td>
								<td class="align_ctr">FALSE</td>
								<td>
									The array contains the surcharge data that is to update the carts surcharge data.<br/>
									See the notes and examples below for further information.									
								</td>
							</tr>
							<tr>
								<td>recalculate_cart</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>
									Define if all cart totals must be recalculated on success, regardless of whether the function has determined to do so or not.<br/>
									The purpose of this is prevent multiple unnecessary recalculations of the cart if this function is used with other cart updating functions. 
								</td>
							</tr>
						</tbody>
					</table>
					
					<h6>How it Works</h6>
					<div class="frame_note">
						<p>The function loops through the 'surcharge_data' array and sets any data from the following array keys to the cart surcharge data.</p>
						<p>The valid array keys are <em>'id'</em>, <em>'description'</em>, <em>'value'</em>, <em>'column'</em> and <em>'tax_rate'</em>.</p>
						<ul>
							<li><strong>'id'</strong> - The id to reference the surcharge by if updating or deleting it.</li>
							<li><strong>'description'</strong> - The description of the surcharge.</li>
							<li><strong>'value'</strong> - The value of the surcharge. If a 'column' value is not set, the surcharge is applied as a fixed rate surcharge, otherwise it's applied as a percentage based surcharge calculated against the 'column' value. Submitted values must be numeric.</li>
							<li><strong>'column'</strong> - If applying a percentage based surcharge, the summary column to apply the surcharge against must be submitted.<br/>
								Valid column names are <em>'item_summary_total'</em>, <em>'shipping_total'</em> and <em>'total'</em>.</li>
							<li><strong>'tax_rate'</strong> - Tax rate applied to surcharge value, the carts tax value is used if no value is submitted. Submitted values must be numeric.</li>
						</ul>
					</div>
					
					<h6>Notes</h6>
					<div class="frame_note">
						<p>As well as setting new surcharges, this function can be used to update an existing surcharge too. When updating a surcharge, simply include the id of the to-be-updated surcharge in the 'surcharge_data' array. The other data in the array will then be used to update the surcharge.</p>
						<hr/>
						<p>Multiple surcharges can be applied to the same summary column.</p>
						<p>If multiple percentage based surcharges are applied to the same column, the surcharge is based on the columns original non-surcharged value. This prevents the cart from surcharging a surcharge.</p>
						<hr/>
						<p>This function can also be set via the '<a href="<?php echo $base_url; ?>user_guide/cart_set_data#update_cart">update_cart()</a>' function.</p>
					</div>
					
					<h6>Return Values</h6>
					<div class="frame_note">
						<strong class="spacer_75">Failure:</strong>FALSE | An error message will be set.<br/>
						<strong class="spacer_75">Success:</strong>TRUE | A status message will be set.
					</div>
					
					<h6>Example</h6>
<pre>
$surcharge_data = array(
	'id' => 'example_id',
	'description' => 'Example Description',
	'value' => 10,
	'column' => 'total', <span class="comment">// Percentage based surcharge on cart total column</span>
	'tax_rate' => 20 <span class="comment">// 20% tax</span>
);

$this->flexi_cart->set_surcharge($surcharge_data);
</pre>
				</div>

				<a name="unset_surcharge"></a>
				<div class="w100 frame">
					<h3 class="heading">unset_surcharge()</h3>
					
					<p>Remove surcharges from the cart session data.</p>
					<hr/>
					
					<h6>Library and Requirements</h6>
					<div class="frame_note">
						<p>Available via the standard library only.</p>
						<p>Does not require any database tables to be enabled.</p>
					</div>				
					
					<h6>Function Parameters</h6>
					<code>unset_surcharge(surcharge_data, recalculate_cart)</code>
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
								<td>surcharge_data</td>
								<td class="align_ctr">string | int | array</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">FALSE</td>
								<td>Can be either a string, int, or an array of values, that the function will attempt to match against surcharge ids within the cart data.</td>
							</tr>
							<tr>
								<td>recalculate_cart</td>
								<td class="align_ctr">bool</td>
								<td class="align_ctr">No</td>
								<td class="align_ctr">TRUE</td>
								<td>
									Define if all cart totals must be recalculated on success, regardless of whether the function has determined to do so or not.<br/>
									The purpose of this is prevent multiple unnecessary recalculations of the cart if this function is used with other cart updating functions. 
								</td>
							</tr>
						</tbody>
					</table>

					<h6>How it Works</h6>
					<div class="frame_note">
						<p>The function loops through the 'surcharge_data' and attempts to match the data against any surcharge ids that are in the cart surcharge data. If a match is found, the surcharge is unset from the cart session data.</p>
						<p>If no 'surcharge_data' is submitted, then all surcharges are removed.</p>
					</div>
				
					<h6>Return Values</h6>
					<div class="frame_note">
						<p><strong class="spacer_75">Failure:</strong>FALSE | An error message will be set.</p>
						<p><strong class="spacer_75">Success:</strong>TRUE | A status message will be set.</p>
					</div>
					
					<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Unsetting a surcharge via either a string or int value.</span>
$surcharge_id = 'example_id';

$this->flexi_cart->unset_surcharge($surcharge_id);
</pre>
<pre>
<span class="comment bold">// Example #2 : Unsetting a surcharge via an array of either string or int values.</span>
$surcharge_ids = array(
	'example_id_1',
	'example_id_2'
);

$this->flexi_cart->unset_surcharge($surcharge_ids);
</pre>
<pre>
<span class="comment bold">// Example #3 : Unsetting all surcharges.</span>
$this->flexi_cart->unset_surcharge();
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