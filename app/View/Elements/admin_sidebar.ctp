<div class="sidebar" style="width:17%;float:left;">
  	<div id="Left">
  	    <div class="sidebarmenu">
  	    		<?php echo $this->Html->link('Patients',array('controller'=>'patients','action'=>'admin_index'),array('class'=>'menuitem'));?>
  	    		<?php echo $this->Html->link('Physician',array('controller'=>'physicians','action'=>'admin_index'),array('class'=>'menuitem'));?>
  	    		<?php echo $this->Html->link('Reports',array('controller'=>'reports','action'=>'admin_index'),array('class'=>'menuitem'));?>
		</div>
     </div>
</div>
      
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
.sidebarmenu a.menuitem{ background: url("/img/heartcenter/navbar2.png") repeat scroll 0 0 transparent; border-radius: 3px;
color: #fff;display: block;position: relative;width:140px;height:31px;margin:0 0 5px 0;line-height:31px;padding:0px 0 0 10px;text-decoration: none;
font: bold 18px 'Trebuchet MS', Arial, Helvetica, sans-serif;
}
.sidebarmenu a.menuitem_green{background:url(/img/images/green_bt.gif) no-repeat center top;
color: #fff;display: block;position: relative;width:185px;height:31px;margin:0 0 5px 0;line-height:31px;padding:0px 0 0 10px;text-decoration: none;
}
.sidebarmenu a.menuitem_red{background:url(/img/images/red_bt.gif) no-repeat center top;
color: #fff;display: block;position: relative;width:185px;height:31px;margin:0 0 5px 0;line-height:31px;padding:0px 0 0 10px;text-decoration: none;
}
.sidebarmenu a.menuitem:hover{ background: url("/img/heartcenter/navbar2.png") repeat scroll 0 0 transparent;    font: bold 18px 'Trebuchet MS', Arial, Helvetica, sans-serif;}
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
font: bold 18px 'Trebuchet MS', Arial, Helvetica, sans-serif;
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
font: bold 18px 'Trebuchet MS', Arial, Helvetica, sans-serif;
}
.sidebarmenu div.submenu ul li a:hover{
background: #e2f0ff;
color: #0e4354;
}
</style>