<div id="top-menu" style="height:35px;padding-left:15px;">
	<table id="common-tbl2" style="width: 40%;" >
		<tr>
			<th>
				<a href="/admin/patients/viewlogdetails/<?php echo $id?>">Log-In Details</a>
			</th>
			<th>
				<a href="/admin/patients/viewlogorders/<?php echo $id?>">Load Orders</a>
			</th>
			<th>
				<a href="/admin/patients/viewlogresults/<?php echo $id?>">Result View</a>
			</th>
		</tr>
	</table>
		
</div>
<style>
#top-menu table a{ background: url("/img/heartcenter/navbar2.png") repeat scroll 0 0 transparent; border-radius: 3px;
	color: #fff;display: block;position: relative;width:100px;height:20px;margin:0 0 5px 0;line-height:31px;padding:3px 0 0 10px;text-decoration: none;
	font: 14px Verdana, Arial, Helvetica, sans-serif;
}
div#view{
	padding-left: 15px;
	padding-right: 15px;
}
div#view h1{
	font: bold 14px Verdana, Arial, Helvetica, sans-serif !important;
}
table.visits_tbl td{
	font: 11px Verdana, Arial, Helvetica, sans-serif !important;
}
table.visits_tbl th{
	font: bold 11px Verdana, Arial, Helvetica, sans-serif !important;
}
</style>
<script>
	jQuery(document).ready(function(){
		count = jQuery('ul.menu > li').length;
		//jQuery('ul.menu li').css('width',(100 / count) +"%");
	});
</script>