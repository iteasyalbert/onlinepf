<style>
	.tabdiv li{margin:0px;}
	.tabdiv ul{margin:0px !important;}

</style>
<script>
	var actionTitle='<?php echo Inflector::humanize(Inflector::tableize($this->params['controller'])).' Management';?>';
	var classController='<?php echo Inflector::variable($this->params['controller']);?>';
	var classNameIndex='div.'+classController+'.index';
	var classNameContent='div.'+classController+'.form';
	
	jQuery('document').ready(function(){
		var divIndexCopy = jQuery(classNameIndex).html();
		var NewIndexFormat = '<div class="content">'+
								'<div id="main-tab" class="widget-result">'+
	   								 '<ul class="tabnav">'+
	       									'<li><a href="#'+classController.toLowerCase()+'" title="Main Page">'+classController+'</a></li>'+
	   								 '</ul>'+
	   								'<div id="'+classController.toLowerCase()+'" class="tabdiv" style="height:auto;">'+
	   									divIndexCopy+
	   								'<div>'+
	   							'<div>'+
	   						'<div>';
   		jQuery(classNameIndex).replaceWith(NewIndexFormat);
   		
	   	var divContentCopy = jQuery(classNameContent).html();
	   	var NewContentFormat = '<div class="content">'+
							'<div id="main-tab" class="widget-result">'+
   								 '<ul class="tabnav">'+
       									'<li><a href="#'+classController.toLowerCase()+'" title="Main Page">'+classController+'</a></li>'+
   								 '</ul>'+
   								'<div id="'+classController.toLowerCase()+'" class="tabdiv" style="height:auto;">'+
   									divContentCopy+
   								'<div>'+
   							'<div>'+
   						'<div>';
   		jQuery(classNameContent).replaceWith(NewContentFormat);
		jQuery('div#'+classController.toLowerCase()+'.tabdiv table th a').css({
			'color': '#FFFAE4'
		});
		jQuery('div.actions h3').remove();
		var actionDiv = '<div class="divActionClass" style="float:left;width:100%;">'+jQuery('div.actions').html()+'</div>';
//		alert(actionDiv);
		jQuery('div.actions').remove();
//		var addAction='<div id="newAction" style="text-align: right;margin:2px 2px 2px 0;"><a href="/admin/'+classController.toLowerCase()+'/add" title="Add"><img src="/img/admin/icons/add.png" alt="Add" style="width:25px;height:25px;margin-right;10px;" /></a></div>';
//		jQuery(addAction).insertAfter(jQuery('div#'+classController.toLowerCase()+'.tabdiv h2'));
		jQuery(actionDiv).insertAfter(jQuery('div#'+classController.toLowerCase()+'.tabdiv h2'));
		
		jQuery('div.title h5').hide();
		jQuery('div#'+classController.toLowerCase()+'.tabdiv h2').hide();

		
	});
</script>

<style>
.responsive-nav { display:none; }
	.widget .responsive-nav { display:none; }	
	
	/* Responsive Nav */

	#top-menu .responsive-nav { margin:20px 0px 0px; padding:10px 11px 10px 10px; color:#fffae4; font-size:14px; background-color:#322f20; border:1px solid #322f20; border-bottom:5px solid #617b00; background-image:url(../../img/responsive-nav-bg.png); background-position: center right; background-repeat: no-repeat; width:100%; -webkit-appearance:none; -moz-appearance:none; appearance:none; cursor:pointer; }

	.widget-result {
		font: bold 13px "Trebuchet MS", Arial, Helvetica, sans-serif;
		padding: 10px;
	    /* background: #FFFAE4; */
	    border: 1px solid #6FBC8E;
	    margin-bottom: 15px;
	    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #BFB092), color-stop(1, #FFFDF5));
	    /* background-image: -ms-linear-gradient(top, #6FBC8E 0%, #FFFDF5 100%); */
	    background-image: -moz-linear-gradient(top, #6FBC8E 0%, #FFFDF5 100%);
	    /* background-image: -o-linear-gradient(top, #6FBC8E 0%, #FFFDF5 100%); */
	    background-image: -webkit-linear-gradient(top, #6FBC8E 0%, #FFFDF5 100%);
	    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#6FBC8E', endColorstr='#FFFDF5');
	    background-image: linear-gradient(#6FBC8E,#6FBC8E);
	}

	.widget-result ul, .widget-result ol {
	   margin: 1px;
	    padding: 0;
	    line-height: 0%;
	}
	.widget-result a {
	color: #222;
	text-decoration: none;
	}
	
	.widget-result a:hover {
	color: #009;
	text-decoration: underline;
	}

	.tabnav li {
	display: inline;
	list-style: none;
	padding-right: 5px;
	}
	
		.tabnav li a {
		text-decoration: none;
		text-transform: uppercase;
		color: #222;
		font-weight: bold;
		padding: 4px 6px;
		outline: none;
		}
		
		.tabnav li a:hover, .tabnav li a:active, .tabnav li.ui-tabs-selected a {
		background: #dedbd1;
		color: #222;
		text-decoration: none;
		}
		
	.tabdiv {
	margin-top: 2px;
	background: #FFFFFF;
	border: 1px solid #BFB092;
	padding: 30px 10px;
	}
	
		.tabdiv li {
		/*list-style-image: url("star.png");*/
		margin-left: 20px;
		}

.ui-tabs-hide {
	display: none;
	}
</style>