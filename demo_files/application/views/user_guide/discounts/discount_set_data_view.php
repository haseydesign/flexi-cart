<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Set Discount Data Functions | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for setting discount data in flexi cart."/> 
	<meta name="keywords" content="setting discount data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Setting Discount Session Data</h1>
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
			
			<h2>Set Discount Session Data</h2>
			<a href="<?php echo $base_url; ?>user_guide/discount_index">Discount Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_config">Discount Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_session_data">Get Discount Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_helper_data">Get Discount Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/discount_admin">Discount Admin Data</a>

			<div class="anchor_nav">
				<h6>Set Discount Data to Session</h6>
				<p>
					<a href="#set_discount">set_discount()</a> | <a href="#set_discount_codes">set_discount_codes()</a> | <a href="#update_discount_codes">update_discount_codes()</a>
				</p>
				<h6>Unset Session Discount Data</h6>
				<p>
					<a href="#unset_discount">unset_discount()</a> | <a href="#unset_excluded_discounts">unset_excluded_discounts()</a>
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

			<a name="set_discount"></a>
			<div class="w100 frame">
				<h3 class="heading">set_discount()</h3>
				
				<p>
					Manually set or update a discount against a summary column total, discounting either a fixed rate or percentage off of the summary value.<br/>
					Setting discounts manually does not require the use of any database tables.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>set_discount(discount_data, recalculate_cart)</code>
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
							<td>discount_data</td>
							<td class="align_ctr">array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>
								The array contains the discount data that is to update the carts discount data.<br/>
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
					<p>The function loops through the 'discount_data' array and sets any data from the following array keys to the cart discount data.</p>
					<p>The valid array keys are <em>'id'</em>, <em>'description'</em>, <em>'value'</em>, <em>'column'</em>, <em>'calculation'</em>, <em>'tax_method'</em> and <em>'void_reward_points'</em>.</p>
					<ul>
						<li><strong>'id'</strong> - The id to reference the discount by if updating or deleting it.</li>
						<li><strong>'description'</strong> - The description of the discount.</li>
						<li><strong>'value'</strong> - The value of the discount. Submitted values must be numeric.</li>
						<li>
							<strong>'column'</strong> - Defines the cart summary column to apply the discount to.<br/>
							Valid column names are <em>'item_summary_total'</em> - the carts item summary total, <em>'shipping_total'</em> - the carts shipping total, <em>'total'</em> - the carts summary total.<br/>
							If no value or an invalid value is set, it will default to the carts total summary column.
						</li>
						<li>
							<strong>'calculation'</strong> - Defines the type of discount that should be applied.<br/>
							Valid calculation method values are <em>'1'</em> - percentage rate discount, <em>'2'</em> - flat rate discount, <em>'3'</em> - new value discount.<br/>
							If no value or an invalid value is set, it will default to a percentage rate discount.<br/>
							'New value' discounts can only be applied to the carts shipping total.
						</li>
						<li>
							<strong>'tax_method'</strong> - Defines how tax should be calculated on the discount value.<br/>
							Valid tax method values are <em>'1'</em> - apply tax before discount, <em>'2'</em> - apply discount before tax, <em>'3'</em> - apply discount before tax, then add original tax value.<br/>
							If no value or an invalid value is set, it will default to a the carts default tax method.
						</li>
						<li>
							<strong>'void_reward_points'</strong> - A boolean value defining whether applying the discount should void the customer from earning any reward points from the purchase.<br/>
							If no value is set, reward points will not be voided.
						</li>
					</ul>
				</div>

				<h6>Notes</h6>
				<div class="frame_note">
					<p>As well as setting new discounts, this function can be used to update an existing discount too. When updating a discount, simply include the id of the to-be-updated discount in the 'discount_data' array. The other data in the array will then be used to update the discount.</p>
					<hr/>
					<p>
						Only one discount can be applied to each cart summary column.<br/>
						No item discounts can be manually set as this is managed by the database discount tables.
					</p>
					<hr/>
					<p>This function can also be set via the '<a href="<?php echo $base_url; ?>user_guide/cart_set_data#update_cart">update_cart()</a>' function.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$discount_data = array(
'id' => 'example_id',
'description' => 'Example Description',
'value' => 10,
'column' => 'total',
'calculation' => '1', <span class="comment">// Percentage rate discount</span>
'tax_method' => FALSE, <span class="comment">// Carts default tax method</span>
'void_reward_points' => TRUE <span class="comment">// Void any reward points being earnt</span>
);

$this->flexi_cart->set_discount($discount_data);
</pre>
			</div>

			<a name="set_discount_codes"></a>
			<div class="w100 frame">
				<h3 class="heading">set_discount_codes()</h3>
				
				<p>Applies discount codes to the cart discount data, whether they can be activated or not.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Requires the discount database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>set_discount_codes(discount_codes, recalculate_cart)</code>
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
							<td>discount_codes</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Can be either a string, int, or an array of values, that the function will attempt to match against discount codes within the discount table.</td>
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
					<p>
						The function validates that the codes in the 'discount_codes' data are valid discounts. <br/>
						All codes that are active are then applied to the cart session data.
					</p>
				</div>
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						This function differs from <a href="#update_discount_codes">'update_discount_codes()'</a> as it only sets new codes, it does not remove any codes from the cart that do not exist in the submitted data.
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Update the discount codes using a <strong class="uline">string</strong> or <strong class="uline">int</strong>.</span>

$discount_code = 'EXAMPLE-CODE';

$this->flexi_cart->set_discount_codes($discount_code);
</pre>
<pre>
<span class="comment bold">// Example #2 : Update the discount codes using an <strong class="uline">array</strong>.</span>

$discount_codes = array(
'EXAMPLE-CODE-1',
'EXAMPLE-CODE-2'
);

$this->flexi_cart->set_discount_codes($discount_codes);
</pre>
			</div>

			<a name="update_discount_codes"></a>
			<div class="w100 frame">
				<h3 class="heading">update_discount_codes()</h3>
				
				<p>Updates discounts in the cart, removing any existing discounts that are not in the submitted data, and adding any valid new ones.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Requires the discount database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>update_discount_codes(discount_codes, recalculate_cart)</code>
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
							<td>discount_codes</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Can be either a string, int, or an array of values, that the function will attempt to match against discount codes within the discount table.</td>
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
					<p>The function loops through all existing discount codes that are applied to the cart, if the discount code is not in the submitted 'discount_codes' data, then it is unset from the cart session data.</p>
					<p>
						The function then validates that the codes in the 'discount_codes' data are valid discounts. <br/>
						All codes that are active are then applied to the cart session data.
					</p>
				</div>
						
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						This function differs from <a href="#set_discount_codes">'set_discount_codes()'</a> as it sets new codes AND also removes any codes from the cart that do not exist in the submitted data. 
					</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE | An error message will be set..</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Update the discount codes using a <strong class="uline">string</strong> or <strong class="uline">int</strong>.</span>

$discount_code = 'EXAMPLE-CODE';

$this->flexi_cart->update_discount_codes($discount_code);
</pre>
<pre>
<span class="comment bold">// Example #2 : Update the discount codes using an <strong class="uline">array</strong>.</span>

$discount_codes = array(
'EXAMPLE-CODE-1',
'EXAMPLE-CODE-2'
);

$this->flexi_cart->update_discount_codes($discount_codes);
</pre>
			</div>

			<a name="unset_discount"></a>
			<div class="w100 frame">
				<h3 class="heading">unset_discount()</h3>
				
				<p>Remove any discounts or reward vouchers by their id or code.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>unset_discount(discount_data, recalculate_cart)</code>
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
							<td>discount_data</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Can be either a string, int, or an array of values, that the function will attempt to match against discount ids or codes within the cart data.</td>
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
					<p>The function loops through all the submitted 'discount_data' and attempts to match it against the id or discount code of discounts applied to the cart. If a discount matches the data, then it is removed from the cart session data.</p>
					<p>If the discount that is being unset is a conditional discount that is auto applied by the cart when a defined quantity and value is reached, then the discount will be added to an excluded discount array. Discounts in this array are prevented from being automatically reapplied. See the '<a href="excluded_discounts">excluded_discounts</a>' and '<a href="unset_excluded_discounts">unset_excluded_discounts</a>' functions for further information.</p>
					<p>If no 'discount_data' is submitted, all manually set discounts and discount/voucher codes are removed.</p>
				</div>
			
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_75">Failure:</strong>FALSE | An error message will be set.</p>
					<p><strong class="spacer_75">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Unset a discount code using a <strong class="uline">string</strong> or <strong class="uline">int</strong>.</span>

$discount_data = 'EXAMPLE-CODE';

$this->flexi_cart->unset_discount($discount_data);
</pre>
<pre>
<span class="comment bold">// Example #2 : Unset multiple discount codes using an <strong class="uline">array</strong>.</span>

$discount_data = array(
'EXAMPLE-CODE-1',
'EXAMPLE-CODE-2',
'example_id'
);

$this->flexi_cart->unset_discount($discount_data);
</pre>
			</div>

			<a name="unset_excluded_discounts"></a>
			<div class="w100 frame">
				<h3 class="heading">unset_excluded_discounts()</h3>
				
				<p>Re-enables all discounts and reward vouchers that have be excluded from being applied to the cart.</p>
				<p>Typically, these are discounts that are automatically applied by the cart when the discounts required quantity and value of items has been added to the cart.</p>					
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the standard library only.</p>
					<p>Does not require any database tables to be enabled.</p>
				</div>
				
				<h6>Function Parameters</h6>
				<code>unset_excluded_discounts(recalculate_cart)</code>
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
					<p>The function unsets all excluded discount data from the carts session data.</p>
				</div>

				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>TRUE | A status message will be set.</p>
				</div>
				
				<h6>Example</h6>
<pre>
$this->flexi_cart->unset_excluded_discounts();
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