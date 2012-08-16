<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Currency Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for configuring currency in flexi cart."/> 
	<meta name="keywords" content="currency configuration, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Currency Configuration</h1>
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

			<h2>Currency Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/currency_index">Currency Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_session_data">Get Currency Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_helper_data">Get Currency Helper Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_set_data">Set Currency Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/currency_admin">Currency Admin Data</a>

			<div class="anchor_nav">
				<h6>Table and Config File Settings</h6>
				<p>
					<a href="#currency_table">Currency Table</a> | <a href="#config_defaults">Setting Defaults via Config File</a>
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
		
			<a name="currency_table"></a>
			<div class="w100 frame">
				<h3 class="heading">Currency Table</h3>
				
				<p>Contains currency data and an exchange rate that can be used to convert internal site prices to other currencies.</p>
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
							<td>currency</td>
							<td class="align_ctr">-</td>
							<td>The tables name.</td>
						</tr>
						<tr>
							<td>id</td>
							<td>curr_id</td>
							<td class="align_ctr">int</td>
							<td>The tables primary key.</td>
						</tr>
						<tr>
							<td>name</td>
							<td>curr_name</td>
							<td class="align_ctr">string</td>
							<td>The name of the currency.</td>
						</tr>
						<tr>
							<td>exchange_rate</td>
							<td>curr_exchange_rate</td>
							<td class="align_ctr">int</td>
							<td>The exchange rate between this currency and the carts internal currency.</td>
						</tr>
						<tr>
							<td>symbol</td>
							<td>curr_symbol</td>
							<td class="align_ctr">string</td>
							<td>The currency symbol that is either prefixed or suffixed to the currency when formatted.</td>
						</tr>
						<tr>
							<td>symbol_suffix</td>
							<td>curr_symbol_suffix</td>
							<td class="align_ctr">bool</td>
							<td>Defines whether to suffix the currency symbol to the currency when formatted.</td>
						</tr>
						<tr>
							<td>thousand_separator</td>
							<td>curr_thousand_separator</td>
							<td class="align_ctr">string</td>
							<td>
								The character used as the 'thousand' separator when formatting values over 1000.<br/>
								For example the character ',' would format numbers as '1,000'.
							</td>
						</tr>
						<tr>
							<td>decimal_separator</td>
							<td>curr_decimal_separator</td>
							<td class="align_ctr">string</td>
							<td>
								The character used as the 'decimal' separator when formatting values.<br/>
								For example the character '.' would format numbers as '1.00'.
							</td>
						</tr>
						<tr>
							<td>status</td>
							<td>curr_status</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines the status of whether the currency is active or disabled.<br/>
								Disabled records will not be used by flexi cart functions.
							</td>
						</tr>
						<tr>
							<td>default</td>
							<td>curr_default</td>
							<td class="align_ctr">int</td>
							<td>
								Defines the default currency to be applied to the cart when first loaded.<br/>
								A table row defined as the default currency should be indicated with a value of 1.<br/>
								This table column can be disabled.
							</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Requirements</h6>
				<div class="frame_note">
					<p>If the table is enabled, then with the exception of 'default', all other columns are required.</p>
					<p>If the 'default' column is disabled, the cart will use the default currency settings defined via the config file.</p>
					<p>The currency table is not related to any other tables.</p>
				</div>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the table and column names.</span>

$config['database']['currency']['table'] = 'currency';
$config['database']['currency']['columns']['id'] = 'curr_id';

<span class="comment">// Defining the 'default' column.</span>
$config['database']['currency']['default'] = 'curr_default';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling the table.</span>

$config['database']['currency']['table'] = FALSE;
</pre>
			</div>

			<a name="config_defaults"></a>
			<div class="w100 frame">
				<h3 class="heading">Defining Currency Defaults via the Config File.</h3>
				
				<p>A default currency settings can be set to correctly configure the cart when it is first loaded.</p>
				<p>
					Setting default values via the config file is only necessary if the currency database table is not enabled.<br/>
					If the currency table is enabled, the default currency settings can be defined by entering the value '1' into the row of the tables 'default' column.
				</p>
				<p class="uline">Default currency settings set via the config file are only used if no default value has been set in the currency database table.</p>
				<hr/>
				
				<h6>Default Settings</h6>
				<table>
					<thead>
						<tr>
							<th class="spacer_125">Parameter Name</th>
							<th class="spacer_100 align_ctr">Data Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>name</td>
							<td class="align_ctr">string</td>
							<td>Sets the name of the default currency.</td>
						</tr>
						<tr>
							<td>symbol</td>
							<td class="align_ctr">string</td>
							<td>Sets the currency symbol to be either prefixed or suffixed to formatted currency values.</td>
						</tr>
						<tr>
							<td>symbol_suffix</td>
							<td class="align_ctr">bool</td>
							<td>
								Defines whether to suffix the currency symbol to the end of the currency value.<br/>
								This is typically used for Euro currency values.
							</td>
						</tr>
						<tr>
							<td>thousand_separator</td>
							<td class="align_ctr">string</td>
							<td>
								Sets the character used as the 'thousand' separator of numbers over 1000.<br/>
								For example the character ',' would format numbers as '1,000'.
							</td>
						</tr>
						<tr>
							<td>decimal_separator</td>
							<td class="align_ctr">string</td>
							<td>
								Sets the character used as the 'decimal' separator for numbers.<br/>
								For example the character '.' would format numbers as '1.00'.
							</td>
						</tr>
					</tbody>
				</table>

				<h6>Notes</h6>
				<div class="frame_note">
					<p>It is a best practice to use HTML encoding for currency characters like the Pound and Euro. Example: &pound; = '<?php echo htmlentities('&pound;');?>' /  &euro; = '<?php echo htmlentities('&euro;');?>'.</p>
					<p>To automatically include a space between the symbol and the value (e.g. '&pound; 9.99'), add '<?php echo htmlentities('&nbsp;');?>' after the symbol code (e.g. '<?php echo htmlentities('&pound;&nbsp;');?>')</p>
				</div>

				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining default currency values set via the config file.</span>

$config['defaults']['currency']['name'] = 'GBP';
$config['defaults']['currency']['symbol'] = '<?php echo htmlentities('&pound;');?>';
$config['defaults']['currency']['symbol_suffix'] = FALSE;
$config['defaults']['currency']['thousand_separator'] = ',';
$config['defaults']['currency']['decimal_separator'] = '.';
</pre>
<pre>
<span class="comment bold">// Example #2 : Disabling default currency values set via the config file.</span>

$config['defaults']['currency']['name'] = FALSE;
$config['defaults']['currency']['symbol'] = FALSE;
$config['defaults']['currency']['symbol_suffix'] = FALSE;
$config['defaults']['currency']['thousand_separator'] = FALSE;
$config['defaults']['currency']['decimal_separator'] = FALSE;
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