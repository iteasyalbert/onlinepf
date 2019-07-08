<style>
	#shots_thumbnail{
		width:120px;height:240px;max-width:120px;max-height:240px;border:1px #bbb;overflow:auto;
	}
	#shots_thumbnail img{
		width:85px;
		height:70px;
		margin:4px;
		cursor:pointer;
		border:none;
	}
	#shots_thumbnail img:hover{
		border: solid #006600;
	}
	#camera tr td{
		border:solid #ccc 1px;
		text-align:center;
		background:#fff;
	}
	#camera tr:nth-child(2) td{
		text-align:left;
	}
</style>
<div id="webcam-dialog" >	
	<table id="camera" width="750px" cellpadding="2" cellspacing="1">
		<tr>
			<td><b>WebCam</b></td>
			<td><b>Current Picture</b></td>
			<td><b>Previous Shots</b></td>
		</tr>
		<tr>
			<td><select id="cameraselect"></select></td>
			<td><p id="status"></p></td>
			<td></td>
		</tr>
		<tr>
			<td style="width:40%;">
				<div id="webcam" style="width:320px;height:240px;border:solid 1px;"></div>
			</td>
			<td style="width:40%;">
				<div style="width:325px;border:1px #bbb;">
			  		<img id="preview" style="width:100%;height:300px;height:240px;" />
			  	</div>
			</td>
			<td style="width:20%;">
				<div id ="shots_thumbnail" style="height:240px;">
			  	</div>
			</td>
		</tr>
		<tr>
			<td><input type="button" id="capture" value="Capture" style="width:120px;"/></td>
			<td><input type="button" id="save-image" value="Save" style="width:120px;"/></td>
			<td></td>
		</tr>
	</table>
</div>

<?php echo $this->Html->script('jquery.webcam');?>
<?php echo $this->Html->script('webcam');?>
<?php echo $this->Html->script('canvas2image');?>