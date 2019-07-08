<div class="sidebar">
  	<div id="Left">
  	    <div class="sidebarmenu">
          </div>
     </div>
</div>
       
<script type="text/javascript" src="/js/ddaccordion.js"></script>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='/img/images/plus.gif' class='statusicon' />", "<img src='/img/images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
});
jQuery('.big-link').die();
jQuery('.big-link').live('click',function(){
	jQuery('#myModal').empty();
//      	alert(jQuery(this).attr('href'));
    	jQuery.ajax({
			url: jQuery(this).attr('href'),
			dataType : 'html',
			success:function(html){
//			alert(jQuery(this).attr('href'));
    		jQuery("#myModal").append("<p>"+html+"</p>");
    		//jQuery("#myModal").append("<a class='close-reveal-modal' style='z-index:114;'>"+"&#215;"+"</a>");
			}
		});
});
</script>
<style>
	.Menu{
		background: url(/img/images/bullet.png) no-repeat;
		padding:7px;
		padding-bottom:10px;
		padding-left:26px;
		vertical-align:text-top;
		
	}
	
	.showall{
	display: block;
	padding:10px;
	padding-left:36px;
	width: 164px;
	height: 12px;
	text-decoration: none;
	color: white;
	border-bottom: solid #4D475B;
	border-bottom-style: dashed;
	border-width: thin;
	margin: 0px auto;
	font-weight: bold;
	}
	.showallnews{
	display: block;
	padding:4px;
	padding-left:36px;
	width: 164px;
	height: 12px;
	text-decoration: none;
	color: #4B545A;
	margin: 0px auto;
	font-weight: bold;
	}
	
.sidebarmenu{
margin:0px 0;
padding:0;
width:195px;
}
.sidebarmenu a.menuitem{ background: url("/img/tab-bg.jpg") repeat scroll 0 0 transparent; border-radius: 3px;
color: #fff;display: block;position: relative;width:185px;height:31px;margin:0 0 5px 0;line-height:31px;padding:0px 0 0 10px;text-decoration: none;
}
.sidebarmenu a.menuitem_green{background:url(/img/images/green_bt.gif) no-repeat center top;
color: #fff;display: block;position: relative;width:185px;height:31px;margin:0 0 5px 0;line-height:31px;padding:0px 0 0 10px;text-decoration: none;
}
.sidebarmenu a.menuitem_red{background:url(/img/images/red_bt.gif) no-repeat center top;
color: #fff;display: block;position: relative;width:185px;height:31px;margin:0 0 5px 0;line-height:31px;padding:0px 0 0 10px;text-decoration: none;
}
.sidebarmenu a.menuitem:hover{ background: url("/img/tab-bg.jpg") repeat scroll 0 0 transparent;}
.sidebarmenu a.menuitem_green:hover{background:url(/img/images/green_bt_a.gif) no-repeat center top;}
.sidebarmenu a.menuitem_red:hover{background:url(/img/images/red_bt_a.gif) no-repeat center top;}

.sidebarmenu a.menuitem:visited, .sidebarmenu .menuitem:active{
color: white;
}
.sidebarmenu a.menuitem .statusicon{
position: absolute;
top:11px;
right:7px;
border: none;
}

.sidebarmenu div.submenu{
background: white;
}
.sidebarmenu div.submenu ul{
list-style-type: none;
margin: 0;
padding: 0 0 5px 0;
}
.sidebarmenu div.submenu ul li{
border-bottom: 1px dotted #bfd1d9;
}
.sidebarmenu div.submenu ul li a{
display: block;
color: black;
text-decoration: none;
padding:5px 0;
padding-left: 10px;
}
.sidebarmenu div.submenu ul li a:hover{
background: #e2f0ff;
color: #0e4354;
}s
</style>