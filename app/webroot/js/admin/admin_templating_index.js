/*

jQuery admin tempate for index

*/

jQuery(document).ready(function(){
	//relocating div class actions to tops

	var divAction = jQuery('div.actions').clone();

	jQuery('div.actions').remove();
	jQuery(divAction).insertBefore('div.index');
	
//	jQuery(divAction).find('a:contains("New")').html("<img src='/img/admin/icons/add.png' alt='Add' style='width:25px;height:25px;margin-right;10px;' />");
	jQuery(divAction).find('a:contains("New")').addClass("button shape small yellow ").css("color","white").html("ADD<span></span>");	
	jQuery(divAction).find('a:contains("Search")').html("<img src='/img/admin/icons/search.png' alt='Search' style='width:25px;height:25px;margin-right;10px;' class='search_dialog' />");
	jQuery(divAction).find('a:contains("List")').html("<img src='/img/admin/icons/list.png' alt='List' style='width:25px;height:25px;margin-right;10px;' />");
	jQuery(divAction).find('a:contains("View")').html("<img src='/img/admin/icons/search.png' alt='View' style='width:25px;height:25px;margin-right;10px;' />");
	jQuery(divAction).find('a:contains("Reply")').html("<img src='/img/admin/icons/send.png' alt='Reply' style='width:25px;height:25px;margin-right;10px;' />");

	
	//css for header
	divAction.css({'float':'left', 'width':'100%'});
	jQuery('table').addClass('table-index');
	divAction.find('img.title-image').css({'width':'60px', 'height':'60px','float':'left', 'clear':'left'});
	divAction.find('h3').css({'border':'none','margin':'0px', 'width':'auto', 'float':'left', 'clear':'right','font-size': '1.7em'});
	divAction.find('ul').css({'float':'right', 'margin':'20px'});
	divAction.find('li').css({'display':'inline-block','vertical-align':'middle;'});
	
//	jQuery('table').css({'float':'left', 'padding-left':'5px'});
	jQuery('td.actions a:contains("View")').html("<img title='View' src='/img/admin/icons/view.png' />");
	jQuery('td.actions a:contains("Edit")').html("<img title='Edit' src='/img/admin/icons/edit.png' />");
	jQuery('td.actions a:contains("Delete")').html("<img title='Delete' src='/img/admin/icons/delete.png' />");
	jQuery('td.actions a:contains("Send")').html("<img title='Send Newsletter' src='/img/admin/icons/send.png' />");
	jQuery('td.actions a:contains("Reply")').html("<img title='Reply' src='/img/admin/icons/send.png' />");
	
	jQuery('td.actions').css({'text-align':'center'});
	jQuery('td.actions a > img').css({'width':'20px', 'height':'20px', 'margin-right':'3px'});
	jQuery('.altrow').removeAttr('style').css({'background-color':'#DFE8F7'});
	jQuery('div#content div.index h2').remove();
	
	
	
	jQuery('div#content div.index, div#content div.form').prepend(function(){
		return jQuery('div#flashMessage');
	});
	
	jQuery('div.paging').find('span').css({'margin-right':'5px'});
	
});