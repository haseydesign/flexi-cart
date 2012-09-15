<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Internal Cart Configuration | User Guide | flexi cart | A Shopping Cart Library for CodeIgniter</title>
	<meta name="description" content="The user guide for internally configuring the cart in flexi cart."/> 
	<meta name="keywords" content="internal cart configuration, user guide, flexi cart, shopping cart, codeigniter"/>
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
				<h1>User Guide | Cart Internal Configuration</h1>
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

			<h2>Cart Internal Configuration</h2>
			<a href="<?php echo $base_url; ?>user_guide/cart_config_columns">Cart Column Config</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_settings">Cart Settings Config</a><br/>
			<a href="<?php echo $base_url; ?>user_guide/cart_config_index">Cart Config Function Index</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_session_data">Get Cart Config Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_set_data">Set Cart Config Session Data</a> |
			<a href="<?php echo $base_url; ?>user_guide/cart_config_admin">Cart Config Admin Data</a>

			<div class="anchor_nav">
				<h6>Internal Cart Settings</h6>
				<p>
					<a href="#data_validation">Item Validation Rules</a> | <a href="#date_time">Date and Time Settings</a> | <a href="#messages">Message Settings</a> | <a href="#email_settings">Email Settings</a> | <a href="#language">Define Language</a>
				</p>
			</div>			
		
			<a name="data_validation"></a>
			<div class="w100 frame">
				<h3 class="heading">Item Validation Rules</h3>
				
				<p>The values of item ids and names that are inserted and updated within the cart can be validated using custom <a href="http://www.regular-expressions.info" target="_blank">Regular Expressions</a>.</p>
				<hr/>
				
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining item id to allow alpha-numeric, dashes, underscores and periods.</span>

$config['settings']['item_id_rules'] = '\.a-z0-9_-';
</pre>
<pre>
<span class="comment bold">// Example #2 : Defining item name to allow alpha-numeric, dashes, underscores, colons, periods and commas.</span>

$config['settings']['item_name_rules'] = '\.\,\:\-_ a-z0-9\#';
</pre>
<pre>
<span class="comment bold">// Example #3 : Disabling regular expression validations.</span>

$config['settings']['item_id_rules'] = FALSE;
$config['settings']['item_name_rules'] = FALSE;
</pre>
			</div>
						
			<a name="date_time"></a>
			<div class="w100 frame">
				<h3 class="heading">Date and Time Settings</h3>
				
				<p>Define the date and time data format used within flexi cart functions.</p>
				<hr/>
				
				<h6>Notes</h6>
				<div class="frame_note">
					<p>The date and time used within flexi cart functions can be defined as either a MySQL DATETIME data type, or as a UNIX timestamp.</p>
					<p>Note: The 'date_time' value is used by the discount and order tables, therefore, both tables must use the same data type.</p>
				</div>
					
				<h6>Example</h6>
<pre>
<span class="comment bold">// Example #1 : Defining the MySQL DATETIME format.</span>

$config['settings']['date_time'] = date('Y-m-d H:i:s'); 
</pre>
<pre>
<span class="comment bold">// Example #2 : Defining the UNIX timestamp format.</span>

$config['settings']['date_time'] = time(); 
</pre>
			</div>
						
			<a name="email_settings"></a>
			<div class="w100 frame">
				<h3 class="heading">Email Settings</h3>
				
				<p>Defines the email template and settings that are used to email users a copy of their order.</p>
				<hr/>
					
				<h6>Example</h6>
<pre>
<span class="comment">// Site title shown as 'from' header on emails.</span>
$config['email']['site_title'] = 'flexi cart';

<span class="comment">// Reply email shown as 'from' header on emails.</span>
$config['email']['reply_email'] = 'info@website.com';

<span class="comment">// Type of email to send, options: 'html', 'text'.</span>
$config['email']['email_type'] = 'html';

<span class="comment">// Path to order confirmation email template.</span>
$config['email']['email_template'] = 'includes/email/order_email.tpl.php';
</pre>
			</div>
						
			<a name="messages"></a>
			<div class="w100 frame">
				<h3 class="heading">Message Delimiter Settings</h3>
				
				<p>Define status and error message delimiters to style cart messages.</p>
				<hr/>
					
				<h6>Example</h6>
<pre>
<span class="comment">// Status Message Start Delimiter.</span>
$config['messages']['delimiters']['status_prefix'] = <?php echo htmlentities('<p class="status_msg">');?>;

<span class="comment">// Status Message End Delimiter.</span>
$config['messages']['delimiters']['status_suffix'] = <?php echo htmlentities('</p>');?>;

<span class="comment">// Error Message Start Delimiter.</span>
$config['messages']['delimiters']['error_prefix'] = <?php echo htmlentities('<p class="error_msg">');?>;

<span class="comment">// Error Message End Delimiter.</span>
$config['messages']['delimiters']['error_suffix'] =  <?php echo htmlentities('</p>');?>;
</pre>
			</div>
						
			<div class="w100 frame">
				<h3 class="heading">Public and Admin Messages</h3>
				
				<p>
					Define which status and error messages are returned as public or admin messages, or which messages are not returned at all.<br/>
					Public messages are intended to be displayed to public and admin users, whilst admin messages are intended for admin users only.
				</p>

				<table>
					<thead>
						<tr>
							<th class="spacer_250">Internal Message Name</th>
							<th class="spacer_100 align_ctr">Default Value</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>items_added_successfully</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that one or more items have been added to the cart.</td>
						</tr>
						<tr>
							<td>no_items_added</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that no items were added to the cart.</td>
						</tr>
						<tr>
							<td>items_updated_successfully</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that one or more items in the cart have been updated.</td>
						</tr>
						<tr>
							<td>no_items_updated</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that no items in the cart have been updated.</td>
						</tr>
						<tr>
							<td>items_deleted_successfully</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that one or more items in the cart have been deleted.</td>
						</tr>
						
						<tr>
							<td>invalid_data</td>
							<td class="align_ctr">'admin'</td>
							<td>
								Notifies that invalid item data has been submitted to an insert, update or delete cart item function.<br/>
								Typically this means the data has not been structured correctly as an array, or that a valid cart row id has not been set.
							</td>
						</tr>
						<tr>
							<td>invalid_item_id</td>
							<td class="align_ctr">'admin'</td>
							<td>
								Notifies that an invalid item id has been submitted to an insert or update cart item function.<br/>
								Item id validation is defined via the '<a href="#data_validation">item_id_rules</a>' config setting.
							</td>
						</tr>
						<tr>
							<td>invalid_item_name</td>
							<td class="align_ctr">'admin'</td>
							<td>
								Notifies that an invalid item name has been submitted to an insert or update cart item function.<br/>
								Item name validation is defined via the '<a href="#data_validation">item_name_rules</a>' config setting.
							</td>
						</tr>
						<tr>
							<td>invalid_item_quantity</td>
							<td class="align_ctr">'admin'</td>
							<td>
								Notifies that an invalid item quantity has been submitted to an insert or update cart item function.<br/>
								This means that either a negative or non numerical value has been set as the item quantity.
							</td>
						</tr>
						<tr>
							<td>invalid_item_price</td>
							<td class="align_ctr">'admin'</td>
							<td>
								Notifies that an invalid item price has been submitted to an insert or update cart item function.<br/>
								This means that either a negative or non numerical value has been set as the item price.
							</td>
						</tr>
						<tr>
							<td>invalid_custom_data</td>
							<td class="align_ctr">'admin'</td>
							<td>
								Notifies that invalid custom data has been submitted to an insert or update cart item function.<br/>
								Custom data validation is defined via the <a href="<?php echo $base_url; ?>user_guide/cart_config_columns#custom_columns">Custom Column 'Regex'</a> config setting.
							</td>
						</tr>
						
						<tr>
							<td>item_out_of_stock_removed</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that an item that was either added or already present in the the cart has been automatically removed as it is not longer in stock.</td>
						</tr>
						<tr>
							<td>item_shipping_banned</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that the cart contains items that are not permitted to be shipped to the current shipping location.</td>
						</tr>
						
						<tr>
							<td>shipping_location_updated_successfully</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that the carts shipping location has been successfully updated.</td>
						</tr>
						<tr>
							<td>shipping_location_update_unsuccessful</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that the carts shipping location was not updated.</td>
						</tr>
						<tr>
							<td>shipping_updated_successfully</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that the carts shipping option has been successfully updated.</td>
						</tr>
						<tr>
							<td>shipping_update_unsuccessful</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that the carts shipping option was not updated.</td>
						</tr>
						
						<tr>
							<td>tax_location_updated_successfully</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that the carts tax location has been successfully updated.</td>
						</tr>
						<tr>
							<td>tax_location_update_unsuccessful</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that the carts tax location was not updated.</td>
						</tr>
						<tr>
							<td>tax_updated_successfully</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that the carts tax has been successfully updated.</td>
						</tr>
						<tr>
							<td>tax_update_unsuccessful</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that the carts tax was not updated.</td>
						</tr>
						
						<tr>
							<td>discounts_updated_successfully</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that one or more cart discounts have been successfully updated.</td>
						</tr>
						<tr>
							<td>discount_update_unsuccessful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that no cart discounts were updated.</td>
						</tr>
						<tr>
							<td>discount_codes_valid</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that one or more cart discount codes submitted to a cart function are valid and have been successfully applied to the cart.</td>
						</tr>
						<tr>
							<td>discount_codes_invalid</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that one or more cart discount codes submitted to a cart function are invalid.</td>
						</tr>
						<tr>
							<td>discount_unset_successfully</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that one or more cart discounts have been successfully removed from the cart.</td>
						</tr>
						<tr>
							<td>discount_unset_unsuccessful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that no cart discounts were removed from the cart.</td>
						</tr>
						<tr>
							<td>excluded_discount_reenabled</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that all excluded discounts have been successfully re-enabled and can be applied to the cart.</td>
						</tr>
						<tr>
							<td>duplicate_discount_code</td>
							<td class="align_ctr">'admin'</td>
							<td>
								Notifies that a duplicated discount code either inserted or updated to the database already exists.<br/>
								This message is set when the admin library discount CRUD functions insert or update a discount.
							</td>
						</tr>
						
						<tr>
							<td>surcharge_updated_successfully</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that one or more cart surcharges have been successfully updated.</td>
						</tr>
						<tr>
							<td>surcharge_update_unsuccessful</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that no cart surcharges were updated.</td>
						</tr>
						<tr>
							<td>surcharge_unset_successful</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that one or more cart surcharges have been successfully removed from the cart.</td>
						</tr>
						<tr>
							<td>surcharge_unset_unsuccessful</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that no cart surcharges were removed from the cart.</td>
						</tr>
						
						<tr>
							<td>currency_updated_successfully</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that the carts currency has been successfully updated.</td>
						</tr>
						<tr>
							<td>currency_update_unsuccessful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that the carts currency was not updated.</td>
						</tr>
						
						<tr>
							<td>cart_order_save_successful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that the cart has been successfully saved as an order.</td>
						</tr>
						<tr>
							<td>cart_order_save_unsuccessful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that the cart was not saved as an order.</td>
						</tr>
						<tr>
							<td>resave_order_does_not_exist</td>
							<td class="align_ctr">'admin'</td>
							<td>
								Notifies that the cart could not be resaved over an existing order as it does not exist.<br/>
								This message is set if database cart data from an existing order is reloaded into the cart session as saved, but the original order number no longer exists.
							</td>
						</tr>
						<tr>
							<td>order_number_exists</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that the current order number already exists for an order in the database.</td>
						</tr>
						
						<tr>
							<td>cart_data_save_successful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that the cart session data has been successfully saved to the database.</td>
						</tr>
						<tr>
							<td>cart_data_save_unsuccessful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that the cart session data was not saved.</td>
						</tr>
						<tr>
							<td>cart_data_load_successful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that cart data has been successfully loaded from the database to the current cart session data.</td>
						</tr>
						<tr>
							<td>cart_data_load_unsuccessful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that cart data from the database could not be loaded.</td>
						</tr>
						<tr>
							<td>cart_data_delete_successful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that cart data from the database has been successfully deleted.</td>
						</tr>
						<tr>
							<td>cart_data_delete_unsuccessful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that cart data from the database could not be deleted.</td>
						</tr>
						
						<tr>
							<td>send_email_successful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that an email for a saved cart order has been sent successfully.</td>
						</tr>
						<tr>
							<td>send_email_unsuccessful</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that an email for a saved cart order was not sent.</td>
						</tr>
						<tr>
							<td>database_table_column_disabled</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that either a database table or table column that is required for a cart feature to function is not enabled.</td>
						</tr>
						<tr>
							<td>cart_emptied</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that all cart items have been removed from the cart.</td>
						</tr>
						<tr>
							<td>cart_destroyed</td>
							<td class="align_ctr">'public'</td>
							<td>Notifies that all cart items have been removed from the cart, and that all cart session settings have been restored to their default values.</td>
						</tr>
						
						<tr>
							<td>session_config_data_updated</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that a cart session configuration has been successfully updated.</td>
						</tr>
						<tr>
							<td>database_data_inserted</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that data has been successfully inserted to a database table using an admin library insert function.</td>
						</tr>
						<tr>
							<td>database_data_updated</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that data has been successfully updated in a database table using an admin library update function.</td>
						</tr>
						<tr>
							<td>database_data_deleted</td>
							<td class="align_ctr">'admin'</td>
							<td>Notifies that data has been successfully deleted from a database table using an admin library delete function.</td>
						</tr>
					</tbody>
				</table>
				
				<h6>Example</h6>
<pre>
<span class="comment">// Set the message to be displayed to public users.</span>
$config['messages']['target_user']['items_added_successfully'] = 'public';
</pre>
<pre>
<span class="comment">// Set the message to be displayed to admin users only.</span>
$config['messages']['target_user']['items_added_successfully'] = 'admin';
</pre>
<pre>
<span class="comment">// Disable a message from being set.</span>
$config['messages']['target_user']['items_added_successfully'] = FALSE;
</pre>
			</div>

			<a name="language"></a>
			<div class="w100 frame">
				<h3 class="heading">Define Language</h3>
				
				<p>Define the language of status and error messages returned by flexi cart functions.</p>
				<hr/>
				
				<h6>The Language File</h6>
				<div class="frame_note">
					<p>flexi cart uses CodeIgniters language class to allow status and error messages returned by the library to be displayed in a specific language.</p>
					<p>
						To set the library to display messages in a specific language, firstly the translated language file must be added to CodeIgniters 'language' directory.
						If the language you require does not currently exist, you will need to create a copy of the default language file and get it translated.<br/>
					</p>
					<hr/>
					<p>
						To do this, copy the 'English' language file from:<br/>
						<em>'application/language/english/flexi_cart_lang.php'</em> to <em>'application/language/[YOUR LANGUAGE]/flexi_cart_lang.php'</em>.
					</p>
					<hr/>
					<p>
						It is recommended that any translations are made directly from the English language file rather than others, as that contains the originally intended messages of the library, with no lingual misinterpretations.
					</p>
					<p>
						If you are unable to translate the file yourself, you could try one of the many free translators that are available online:
						<ul>
							<li><a href="http://translate.google.com/">Google Translate</a></li>
							<li><a href="http://www.microsofttranslator.com/">Bing Translator</a></li>
							<li><a href="http://translate.reference.com/">Dictionary.com Translator</a></li>
						</ul>
					</p>
				</div>

				<h6>Defining a Language</h6>
				<p>Defining the language used by the library is done using CodeIgniters internal methods, either via the CI config. file, or by using CI's language class.</p>
<pre>
<span class="comment bold">// Example #1 : Set language via CI's config file ('application/config/config.php').</span>

$config['language'] = 'spanish';
</pre>
<pre>
<span class="comment bold">// Example #2 : Set language via CI's language class.
// Note: This must be defined before calling the flexi cart library and would typically be done in either
// a controller or model.</span>

// First load the language file.
$this->lang->load('flexi_cart', 'spanish');

// And then load the flexi cart library.
$this->load->library('flexi_cart');	
</pre>

		</div>
	</div>	
	
	<!-- Footer -->  
	<?php $this->load->view('includes/footer'); ?> 
</div>

<!-- Scripts -->  
<?php $this->load->view('includes/scripts'); ?> 

</body>
</html>