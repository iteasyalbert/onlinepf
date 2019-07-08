

var headerTemplate = function(){
	
	//relocating div class actions to tops
	var divAction = jQuery('div.actions').clone();
	jQuery('div.actions').remove();
	jQuery(divAction).insertBefore('div.form');
	
	jQuery(divAction).find('a:contains("List")').html("<img src='/img/admin/icons/list.png' alt='List' style='width:25px;height:25px;margin-right;10px;' />");
	jQuery(divAction).find('a:contains("Delete")').html("<img src='/img/admin/icons/delete.png' alt='Delete' style='width:25px;height:25px;margin-right;10px;' />");
	jQuery(divAction).find('a:contains("Reply")').html("<img src='/img/admin/icons/send.png' alt='Reply' style='width:25px;height:25px;margin-right;10px;' />");
	
	//css for header
	divAction.css({'float':'left', 'width':'100%'});
	divAction.find('img.title-image').css({'width':'60px', 'height':'60px','float':'left', 'clear':'left'});
	divAction.find('h3').css({'border':'none','margin':'0px', 'width':'auto', 'float':'left', 'clear':'right','font-size': '1.7em'});
	divAction.find('ul').css({'float':'right', 'margin':'20px'});
	divAction.find('li').css({'display':'inline-block','vertical-align':'middle;'});
	
};





jQuery(document).ready(function(){
	
	headerTemplate();

	var thisFormBody = jQuery('.form');
		
	if (thisFormBody.find('legend').size()>=1)
	{
//		thisFormBody.prepend("<div class='title'><h5>"+thisFormBody.find('legend').html()+"</h5></div>");
		thisFormBody.find('legend').remove();
	}
//	jQuery('form').find('input[type=text],textarea,input[type=radio],input[type=checkbox],input[type=select]').each(function(){
//			jQuery(this).prev('label').remove();
//	});
	thisFormBody.find('div.input').attr('class','field').find('input, textarea, select').css({'border-radius':' 5px','margin-bottom': '10px'});
//	thisFormBody.find('div.field label').wrap('<div class="label" />');
//	thisFormBody.find('div.field input').wrap('<div class="input" />');
	thisFormBody.find('div.field input[type="checkbox"]').parent('div.input').width('auto');
	thisFormBody.find('input[type="radio"]').removeAttr('class');
	thisFormBody.find('div.field textarea').attr('class','ckeditor');
	thisFormBody.find('div.field fieldset').css({'border':'0px solid white','padding':'0px','margin':'0px'});
	
	thisFormBody.find('fieldset').replaceWith('<div class="fields">'+thisFormBody.find('fieldset').html()+'</div>');
	jQuery('div#content div.index, div#content div.form').prepend(function(){
		return jQuery('div#flashMessage');
	});
	
	var thisFormBody = jQuery('.form');
	
	if (thisFormBody.find('legend').size()>=1)
	{
		thisFormBody.prepend("<div class='title'><h5>"+thisFormBody.find('legend').html()+"</h5></div>");
//		thisFormBody.find('legend').remove();
	}
	var actionDiv = '<div class ="divActionClass" style="float:left;width:100%;height: 20px;">'+jQuery('div.actions').html()+'</div>';
	jQuery(actionDiv).insertBefore(jQuery('form'));
	jQuery('div.divActionClass h3').remove();
	jQuery('div.container div.divActionClass').remove();
	
	thisFormBody.find('div.input').attr('class','field');
	thisFormBody.find('div.field label').attr('class','label');
	thisFormBody.find('div.field input[type!="checkbox"]').addClass('input');
	thisFormBody.find('div.field input[type="checkbox"]').parent('div.input').width('auto');
	thisFormBody.find('fieldset').attr('class','fields');
	
	jQuery('.datepickers').datepicker({ changeYear: true, changeMonth:true, yearRange:"1940:"+(new Date()).getFullYear().toString()});
	jQuery('#edit-tabs').tabs();
	
	//thisFormBody.find('fieldset').replaceWith('<div class="fields">'+thisFormBody.find('fieldset').html()+'</div>');
	jQuery('div#content div.index, div#content div.form').prepend(function(){
		return jQuery('div#flashMessage');
	});	
});