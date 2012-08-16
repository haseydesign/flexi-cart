// Dependent Select Menu 
function dependent_menu(parent, child, grand_children, disable) 
{
	// parent = The id of the select element being changed by the user.
	// child = The id of the select element being changed by javascript.
	// grand_children = An array of id's for all related select elements that are two or more generations below the parent.
	// disable = On load, if no child options are available to the current parent, the select element is disabled.
	
	// If a child element is selected, ensure that the childs parent is also selected.
	if ($('#'+parent).val() == 0 && $('#'+child).val() > 0)
	{
		var child_class = $('#'+child+' option:selected').attr('class');
		var parent_id = child_class.substring(child_class.lastIndexOf('_')+1);

		$('#'+parent+' option[value='+parent_id+']').prop('selected','selected');
	}

	// Get current parent and child option values.
	var parent_value = $('#'+parent).val();	
	var child_value = $('#'+child+' option:selected').val();	

	// Create copy of children to retrive/copy parent matches.
	$('body').append('<select style="display:none;" id="'+parent+child+'"></select>');
	$('#'+parent+child).html($('#'+child+' option'));
	
	// Update child/grandchildren with options related to selected parent.
	$('#'+child).html($('#'+parent+child+' .parent_id_0').clone());
	$('#'+child).append($('#'+parent+child+' .parent_id_'+parent_value).not('#'+parent+child+' .parent_id_0').clone());
	$('#'+child+' option[value='+child_value+']').prop('selected','selected');
	
	// Disable children/granchildren on page load if child has no selectable options.
	if ((disable == true) && ($('#'+child+' .parent_id_'+parent_value).size() <= 1)) 
	{
		$('#'+child).prop('disabled', true);
	}
	
	// Parent change event.
	$('#'+parent).change(function()
	{
		if ($('#'+parent).val() > 0)
		{
			// Copy all cloned child options that match the selected parent.
			var parent_value = $('#'+parent).val();		
			$('#'+child).html($('#'+parent+child+' .parent_id_0').clone());
			$('#'+child).append($('#'+parent+child+' .parent_id_'+parent_value).clone());
			
			// Check whether to enable / disable child.
			var child_value = $('#'+child+' .parent_id_'+parent_value).length;
			if ((child_value == 0) && (disable == true)) 
			{		
				$('#'+child).prop('disabled', true).val('0'); 			
			} 
			else if (child_value > 0) 
			{
				// Re-enable element and style with a fade animation.
				if ($('#'+child).is(':disabled')) 
				{
					$('#'+child).fadeTo(350, 0.25, function()
					{
						$('#'+child).fadeTo(350, 1).prop('disabled', false);
					});
				}
			}

			// Reset / disable grand children.
			$.each(grand_children, function()
			{
				$('#'+this).prop('disabled', true).val('0');
			});
		}
		// Else, no options should be displayed, so reset child and grandchild menus.
		else
		{
			$('#'+child+', #'+grand_children).prop('disabled', true).val('0'); 			
		}
	});
}

// Save the onload unmanipulated html of the dependent select menu options.
// This html is then used to repopulate the options of menus that have been generated via the custom 'copy_row()' function.
// !IMPORTANT NOTE: This must be placed outside of the initial jQuery $(function(){}); call to be accessible by the 'copy_row()' function.
$('.dependent_menu').each(function(i){
	$('body').data('dependent_menu_'+i, $(this).html());
});

$(function() {

	// Copy a table row and its data.
	$('.copy_row').live('click',function()
	{
		// To set a new unique field name for the 'to-be-cloned' row, we need to obtain the current highest index id from the existing field names.
		var input_name = $(this).closest('tr').find('input, select, textarea').not('input:radio').first().attr('name');
		input_name = input_name.substring(input_name.indexOf(']')+1);
		
		// Loop through all field names and check if the index id is higher than the currently set highest.
		var highest_id = 0;
		$('input[name$="'+input_name+'"], select[name$="'+input_name+'"], textarea[name$="'+input_name+'"]').each(function()
		{
			var row_name = $(this).attr('name');
			if (parseInt(row_name.substring(row_name.indexOf('[')+1, row_name.indexOf(']'))) > highest_id)
			{
				highest_id = parseInt(row_name.substring(row_name.indexOf('[')+1, row_name.indexOf(']')));
			}			
		});

		// Get row to be cloned and increment the index id.
		var cloned_row = $(this).closest('tr');
		var new_id = highest_id+1;
		
		// Clone target row.
		var new_row = cloned_row.clone().insertAfter(cloned_row);

		// Set names for new elements by incrementing the current elements index (Example: name="insert[0][xxx]" updates to name="insert[1][xxx]").
		// Note: This example requires the first square bracket value must be the index value. Change the code below if your naming convention differs.
		new_row.find('input, select, textarea').not('input:radio').each(function()
		{
			if (typeof($(this).attr('name')) != 'undefined')
			{
				var cloned_name = $(this).attr('name');
				var new_name = cloned_name.substring(0, cloned_name.indexOf('[')+1) + new_id + cloned_name.substring(cloned_name.indexOf(']'));			
				$(this).attr('name', new_name);
			}
		});
		
		// Copy text from select boxes and textareas that are not otherwise copied.
		cloned_row.find('select, textarea').each(function(i)
		{
			var value = $(this).val();
			new_row.find('select, textarea').eq(i).val(value);
		});
		
		// Check if any dependent select menus are on the page.
		// Note: The user customised 'initialise_dependent_menu()' function must have been called on page load to initialise the new dependent menus. 
		if (typeof(initialise_dependent_menu) == 'function')
		{
			new_row.find('.dependent_menu').each(function(i)
			{
				// Copy the default dependent menu options to the new copied select menus.
				// !IMPORTANT NOTE: This example uses jQuery's $.data function to obtain the html of the dependent menu options that haven't yet been
				// manipulated by the 'dependent_menu()' function.
				var master_options = $('body').data('dependent_menu_'+i);
				var cloned_menu_value = $(this).val();
				$(this).html(master_options).val(cloned_menu_value);
			
				// Set id for new dependent menu by incrementing the current elements index (Example: id="xxx_country_1" updates to id="xxx_country_2").
				// Note: This example requires the index value of the element must be set after the last underscore. Change the code below if your naming convention differs.
				var cloned_menu_id = $(this).attr('id');
				var new_menu_id = cloned_menu_id.substring(0, cloned_menu_id.lastIndexOf('_')+1) + new_id;
				$(this).attr('id', new_menu_id);			
			});
			
			// Initialise the new dependent menus.
			new_menu_id = new_row.find('.dependent_menu:first').attr('id');
			initialise_dependent_menu(new_menu_id);
		}
		
		// Enable remove button.
		new_row.find('.remove_row').attr('disabled', false);
	});

	//+++++++++++++++++++++++++//
	
	// Remove Row
	$('.remove_row').live('click',function(){
		$(this).closest('tr').fadeOut('medium',function(){
			$(this).remove();
		});
	});

	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	// User Guide : Ajax Cart Row Selector
	// Select a row in the cart to update user guide function examples to correspond to that row.
	$('#select_cart_row').live('change', function()
	{
		var data = new Object();
		data['row_id'] = $(this).val();
		
		// !IMPORTANT NOTE: As of CI 2.0, if csrf (cross-site request forgery) protection is enabled via CI's config, this must be included to submit the token.
		data['csrf_test_name'] = $('input[name="csrf_test_name"]').val();
		
		$('#user_guide_content').load(document.URL+' #ajax_content', data, function()
		{
			// Re-enable Tooltip helpers.
			$('.tooltip_trigger[title]').tooltip({effect:'slide', predelay:500});

			$('#item_selector_wrap').clearQueue().animate({bottom:'0'}, 250).delay(3000).animate({bottom:'-40px'}, 500);
		});
	});
});