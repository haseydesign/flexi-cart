<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Currency Helper Data | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for currency helper functions in flexi cart."/> 
	<meta name="keywords" content="currency helper data, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Currency Helper Data</h1>
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

			<h2>Currency Helper Functions</h2>
			<a href="<?php echo $base_url; ?>user_guide/currency_index">Currency Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_config">Currency Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_session_data">Get Currency Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_set_data">Set Currency Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_admin">Currency Admin Data</a>
			
			<div class="anchor_nav">
				<h6>Format Currency Values</h6>
				<p>
					 <a href="#format_currency">format_currency()</a>
				</p>
				<h6>Calculate Currency Values</h6>
				<p>
					<a href="#get_currency_value">get_currency_value()</a> | <a href="#get_taxed_currency_value">get_taxed_currency_value()</a>
				</p>
				<h6>Get Currency Data from Database</h6>
				<p>
					 <a href="#get_currency_data">get_currency_data()</a> | <a href="#get_currency_symbol">get_currency_symbol()</a> | <a href="#get_exchange_rate">get_exchange_rate()</a>
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

			<a name="format_currency"></a>
			<div class="w100 frame">
				<h3 class="heading">format_currency()</h3>
				
				<p>Returns the submitted value formatted to a specified number of decimals using the specified currencies decimal and thousand separators.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
					<p>Note: The currency database table must be enabled, if the 'currency_name' parameter is set.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>format_currency(value, format, decimals, internal_value, currency_name)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>value</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Sets the value to be formatted.</td>
						</tr>
						<tr>
							<td>format</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether to format the returned value as a currency.</td>
						</tr>
						<tr>
							<td>decimals</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">2</td>
							<td>Defines the number of decimals to return the value with.</td>
						</tr>
						<tr>
							<td>internal_value</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to return the value using the carts internal currency instead of the users current currency.</td>
						</tr>
						<tr>
							<td>currency_name</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a specific currency to obtain the format settings from.<br/>
								If a currency name is not set, the users current currency is used.<br/>
								Note: Use of this parameter requires the currency database table to be enabled.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If a 'currency_name' is submitted that is not found in the database, the current cart session currency settings will be used to format the value.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">					<tr>
						<td>
							<code>format_currency(10, TRUE, 2, FALSE, FALSE)</code>
							<small>Format the number '10' to 2 decimals, using the format settings for the <span class="uline">current</span> currency.</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->format_currency(10, TRUE, 2, FALSE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>format_currency(10, TRUE, 2, TRUE, FALSE)</code>
							<small>Format the number '10' to 2 decimals, using the format settings for the carts <span class="uline">Internal</span> currency.</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->format_currency(10, TRUE, 2, TRUE, FALSE);?></td>
					</tr>
					<tr>
						<td>
							<code>format_currency(10, TRUE, 2, FALSE, 'AUD')</code>
							<small>Format the number '10' to 2 decimals, using the format settings for <span class="uline">Australian Dollars</span>.</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->format_currency(10, TRUE, 2, FALSE, 'AUD');?></td>
					</tr>
				</table>
			</div>
			
			<a name="get_currency_value"></a>
			<div class="w100 frame">
				<h3 class="heading">get_currency_value()</h3>
				
				<p>Converts a value from a specified currency to the carts internal currency or vice versa.</p>
				<p>
					This function is similar to '<a href="#get_taxed_currency_value">get_taxed_currency_value()</a>', with the exception it does NOT check whether cart prices include tax, therefore, values are directly converted from one value to another without adding or removing taxes during the conversion.
				</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
					<p>Note: The currency database table must be enabled, if the 'currency_name' parameter is set.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_currency_value(value, format, decimals, inverse, currency_name)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>value</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">0</td>
							<td>Sets the value to be converted.</td>
						</tr>
						<tr>
							<td>format</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether to format the returned value as a currency.</td>
						</tr>
						<tr>
							<td>decimals</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">2</td>
							<td>Defines the number of decimals to return the value with.</td>
						</tr>
						<tr>
							<td>inverse</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define whether to inverse the exchange rate conversion.<br/>
								If 'TRUE', the conversion is from the internal currency to 'x' currency.<br/>
								If 'FALSE', the conversion is from the 'x' currency to the internal currency.<br/>
							</td>
						</tr>
						<tr>
							<td>currency_name</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a specific currency to obtain the exchange rate from.<br/>
								If a currency name is not set, the users current currency is used.<br/>
								Note: Use of this parameter requires the currency database table to be enabled.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>int | (string if value is formatted)</p>
				</div>
				
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">					<tr>
						<td>
							<code>get_currency_value(10, TRUE, 2, FALSE, FALSE)</code>
							<small>What is <?php echo $this->flexi_cart->currency_symbol(TRUE);?>10, converted to the <span class="uline">current</span> currency (<?php echo $this->flexi_cart->currency_name();?>)?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->get_currency_value(10, TRUE, 2, FALSE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>get_currency_value(10, TRUE, 2, TRUE, FALSE)</code>
							<small>What is <?php echo $this->flexi_cart->currency_symbol();?>10, converted to the carts <span class="uline">internal</span> currency (<?php echo $this->flexi_cart->currency_name(TRUE);?>)?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_currency_value(10, TRUE, 2, TRUE, FALSE);?></td>
					</tr>
					<tr>
						<td>
							<code>get_currency_value(10, TRUE, 2, FALSE, 'AUD')</code>
							<small>What is <?php echo $this->flexi_cart->currency_symbol(TRUE);?>10, converted to <span class="uline">Australian Dollars</span>?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_currency_value(10, TRUE, 2, FALSE, 'AUD');?></td>
					</tr>
					<tr>
						<td>
							<code>get_currency_value(10, TRUE, 2, TRUE, 'AUD')</code>
							<small>What is <?php echo $this->flexi_cart->get_currency_symbol(FALSE, 'AUD');?>10, converted to the carts <span class="uline">internal</span> currency (<?php echo $this->flexi_cart->currency_name(TRUE);?>)?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_currency_value(10, TRUE, 2, TRUE, 'AUD');?></td>
					</tr>
				</table>
			</div>

			<a name="get_taxed_currency_value"></a>
			<div class="w100 frame">
				<h3 class="heading">get_taxed_currency_value()</h3>
				
				<p>Converts a value from a specified currency to the carts internal currency or vice versa.</p>
				<p>This function is similar to '<a href="#get_currency_value">get_currency_value()</a>', with the exception of its handling of taxes, read the notes below for further information.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Does not require any database tables to be enabled.</p>
					<p>Note: The currency database table must be enabled, if the 'currency_name' parameter is set.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_taxed_currency_value(value, tax_rate, format, decimals, inverse, currency_name)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>value</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">Yes</td>
							<td class="align_ctr">FALSE</td>
							<td>Sets the value to be converted.</td>
						</tr>
						<tr>
							<td>tax_rate</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Defines a specific tax rate to use with the conversion.<br/>
								If a tax rate is not set, the carts default tax rate is used.
							</td>
						</tr>
						<tr>
							<td>format</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">TRUE</td>
							<td>Define whether to format the returned value as a currency.</td>
						</tr>
						<tr>
							<td>decimals</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">2</td>
							<td>Defines the number of decimals to return the value with.</td>
						</tr>
						<tr>
							<td>inverse</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define whether to inverse the exchange rate conversion.<br/>
								If 'TRUE', the conversion is from the internal currency to 'x' currency.<br/>
								If 'FALSE', the conversion is from the 'x' currency to the internal currency.<br/>
							</td>
						</tr>
						<tr>
							<td>currency_name</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a specific currency to obtain the exchange rate from.<br/>
								If a currency name is not set, the users current currency is used.<br/>
								Note: Use of this parameter requires the currency database table to be enabled.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>
						This function is similar to '<a href="#get_currency_value">get_currency_value()</a>', with the exception that the returned value varies depending on whether the cart is configured to include tax on internal pricing and whether the user if viewing pricing including tax.
					</p>
					<p>
						Example: If cart prices include tax and the user is viewing prices excluding tax. The function will remove the tax from the to-be-converted value.<br/>
						If the cart and user tax settings are reversed, the function will add the tax. If both the cart and user tax settings match each other, the tax is neither added or removed.
					</p>
					<p>
						This function would typically be used when displaying a value based on the carts internal pricing, like an items price. The function would then automatically convert the price accordingly to whether the user is view prices including or excluding prices.
					</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>int | (string if value is formatted)</p>
				</div>

					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">					<tr>
						<td>
							<code>get_taxed_currency_value(10, FALSE, TRUE, 2, FALSE, FALSE)</code>
							<small>What is <?php echo $this->flexi_cart->currency_symbol(TRUE);?>10, converted to the <span class="uline">current</span> currency (<?php echo $this->flexi_cart->currency_name();?>), using the carts <span class="uline">default tax rate</span>?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->get_taxed_currency_value(10, FALSE, TRUE, 2, FALSE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>get_taxed_currency_value(10, FALSE, TRUE, 2, TRUE, FALSE)</code>
							<small>What is <?php echo $this->flexi_cart->currency_symbol();?>10, converted to the carts <span class="uline">internal</span> currency (<?php echo $this->flexi_cart->currency_name(TRUE);?>), using the carts <span class="uline">default tax rate</span>?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_taxed_currency_value(10, FALSE, TRUE, 2, TRUE, FALSE);?></td>
					</tr>
					<tr>
						<td>
							<code>get_taxed_currency_value(10, FALSE, TRUE, 2, FALSE, 'AUD')</code>
							<small>What is <?php echo $this->flexi_cart->currency_symbol(TRUE);?>10, converted to <span class="uline">Australia Dollars</span>, using the carts <span class="uline">default tax rate</span>?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_taxed_currency_value(10, FALSE, TRUE, 2, FALSE, 'AUD');?></td>
					</tr>
					<tr>
						<td>
							<code>get_taxed_currency_value(10, FALSE, TRUE, 2, TRUE, 'AUD')</code>
							<small>What is <?php echo $this->flexi_cart->get_currency_symbol(FALSE, 'AUD');?>10, converted to the carts <span class="uline">internal</span> currency (<?php echo $this->flexi_cart->currency_name(TRUE);?>), using the carts <span class="uline">default tax rate</span>?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_taxed_currency_value(10, FALSE, TRUE, 2, TRUE, 'AUD');?></td>
					</tr>
					<tr>
						<td>
							<code>get_taxed_currency_value(10, 5, TRUE, 2, FALSE, FALSE)</code>
							<small>What is <?php echo $this->flexi_cart->currency_symbol(FALSE);?>10, converted to the <span class="uline">current</span> currency (<?php echo $this->flexi_cart->currency_name();?>), with a defined <span class="uline">tax rate of 5%</span>?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The price difference between 'internal' pricing and this example is only apparent if the user is viewing prices in a currency different from the default cart setting. This can be changed via the demos navigation menus 'Feature Examples'.">
								<?php echo $this->flexi_cart->get_taxed_currency_value(10, 5, TRUE, 2, FALSE, FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>get_taxed_currency_value(10, 5, TRUE, 2, TRUE, FALSE)</code>
							<small>What is <?php echo $this->flexi_cart->currency_symbol();?>10, converted to the carts <span class="uline">internal</span> currency (<?php echo $this->flexi_cart->currency_name(TRUE);?>), with a defined <span class="uline">tax rate of 5%</span>?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_taxed_currency_value(10, 5, TRUE, 2, TRUE, FALSE);?></td>
					</tr>
					<tr>
						<td>
							<code>get_taxed_currency_value(10, 5, TRUE, 2, FALSE, 'AUD')</code>
							<small>What is <?php echo $this->flexi_cart->currency_symbol(TRUE);?>10, converted to <span class="uline">Australian Dollars</span>, with a defined <span class="uline">tax rate of 5%</span>?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_taxed_currency_value(10, 5, TRUE, 2, FALSE, 'AUD');?></td>
					</tr>
					<tr>
						<td>
							<code>get_taxed_currency_value(10, 5, TRUE, 2, TRUE, 'AUD')</code>
							<small>What is <?php echo $this->flexi_cart->get_currency_symbol(FALSE, 'AUD');?>10, converted to the carts <span class="uline">internal</span> currency (<?php echo $this->flexi_cart->currency_name(TRUE);?>), with a defined <span class="uline">tax rate of 5%</span>?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_taxed_currency_value(10, 5, TRUE, 2, TRUE, 'AUD');?></td>
					</tr>
				</table>
			</div>

			<a name="get_currency_data"></a>
			<div class="w100 frame">
				<h3 class="heading">get_currency_data()</h3>
				
				<p>Looks-up the database and returns an array of currency data.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Requires currency database table to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_currency_data(sql_select, sql_where)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>sql_select</td>
							<td class="align_ctr">string | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define the database fields returned via an SQL SELECT statement.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
						<tr>
							<td>sql_where</td>
							<td class="align_ctr">string | int | array</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Set the SQL WHERE statement used to filter the database records to return.<br/>
								Read the <a href="<?php echo $base_url; ?>user_guide/defining_custom_sql">defining SQL documentation</a> for further information.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>FALSE</p>
					<p><strong class="spacer_100">Success:</strong>array</p>
				</div>
				
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">					<tr>
						<td>
							<code>get_currency_data(FALSE, FALSE)</code>
							<small>Show all database currency data.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->get_currency_data(FALSE, FALSE));?></pre>
						</td>
					</tr>
					<tr>
						<td>
							<code>get_currency_data('<?php echo $this->flexi_cart->db_column('currency','name').', '.$this->flexi_cart->db_column('currency','exchange_rate');?>', array('curr_id' => 2))</code>
							<small>Show the name and exchange rate of the database currency with an id of '2'.</small>
							<span class="toggle">Show / Hide Array</span>
							<pre class="hide_toggle"><?php print_r($this->flexi_cart->get_currency_data($this->flexi_cart->db_column('currency','name').', '.$this->flexi_cart->db_column('currency','exchange_rate'), array('curr_id' => 2)));?></pre>
						</td>
					</tr>
				</table>
			</div>

			<a name="get_currency_symbol"></a>
			<div class="w100 frame">
				<h3 class="heading">get_currency_symbol()</h3>
				
				<p>Looks-up the database and returns the currency symbol (Example $, &euro;, &pound;) of a specified currency.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Requires currency database table to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_currency_symbol(internal_value, currency_name)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>internal_value</td>
							<td class="align_ctr">bool</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>Defines whether to return the value of the carts internal currency instead of the users current currency.</td>
						</tr>
						<tr>
							<td>currency_name</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a specific currency to obtain the format settings from.<br/>
								If a currency name is not set, the users current currency is used.<br/>
								Note: Use of this parameter requires the currency database table to be enabled.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If a 'currency_name' is submitted that is not found in the database, the current cart session currency settings will be used to format the value.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>string</p>
				</div>
				
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">					<tr>
						<td>
							<code>get_currency_symbol(FALSE)</code>
							<small>What is the <span class="uline">current</span> currency symbol used to display monetary values?</small>
						</td>
						<td class="spacer_200 align_ctr">
							<span class="tooltip_trigger" title="Note: The difference between 'internal' and this example is only apparent if the user is viewing prices in a currency different from the default cart setting.">
								<?php echo $this->flexi_cart->get_currency_symbol(FALSE);?>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<code>get_currency_symbol(TRUE)</code>
							<small>What is the <span class="uline">internal</span> currency symbol used to display monetary values?</small>
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_currency_symbol(TRUE);?></td>
					</tr>
				</table>
			</div>				
			
			<a name="get_exchange_rate"></a>
			<div class="w100 frame">
				<h3 class="heading">get_exchange_rate()</h3>
				
				<p>Looks-up the database and returns the exchange rate of a submitted currency in comparison to the sites internal currency.</p>
				<hr/>
				
				<h6>Library and Requirements</h6>
				<div class="frame_note">
					<p>Available via the lite, standard and admin libraries.</p>
					<p>Requires currency database table to be enabled.</p>
				</div>				
				
				<h6>Function Parameters</h6>
				<code>get_exchange_rate(currency_name, decimals)</code>
				<a href="#help" class="help_link">Help</a>
				<table>
					<thead>
						<tr>
							<th class="spacer_150">Name</th>
							<th class="spacer_75 align_ctr">Data Type</th>
							<th class="spacer_75 align_ctr">Required</th>
							<th class="spacer_75 align_ctr">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>currency_name</td>
							<td class="align_ctr">string</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">FALSE</td>
							<td>
								Define a specific currency to obtain the format settings from.<br/>
								If a currency name is not set, the users current currency is used.<br/>
								Note: Use of this parameter requires the currency database table to be enabled.
							</td>
						</tr>
						<tr>
							<td>decimals</td>
							<td class="align_ctr">int</td>
							<td class="align_ctr">No</td>
							<td class="align_ctr">4</td>
							<td>Defines the number of decimals to return the value with.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>If a 'currency_name' is submitted that is not found in the database, the current cart session exchange rate will be returned.</p>
				</div>
				
				<h6>Return Values</h6>
				<div class="frame_note">
					<p><strong class="spacer_100">Failure:</strong>n/a</p>
					<p><strong class="spacer_100">Success:</strong>int</p>
				</div>
				
					<h6>Examples</h6>					<small>Note: The returned example values below are displaying live data from the current cart session data.</small>					<table class="example">					<tr>
						<td>
							<code>get_exchange_rate('AUD', 2)</code>
							<small>What is the exchange rate conversion between <span class="uline">Australian Dollars</span> and the carts internal currency, to two decimals?</small>						
						</td>
						<td class="spacer_200 align_ctr"><?php echo $this->flexi_cart->get_exchange_rate('AUD', 2);?></td>
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