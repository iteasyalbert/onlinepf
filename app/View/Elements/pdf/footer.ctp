<htmlpagefooter name="myHTMLFooter1">

	<table style='width:100%;' border='0'>
		<tr>
			<td width = "15%"></td>
			<td width = "35%"></td>
			<td width = "15%"></td>
			<td width = "35%"></td>
		</tr>	
		<tr style="margin-bottom:0px;padding-bottom:0px;">
			<td style="margin-bottom:0px;padding-bottom:0px;"></td>
			<td style="margin-bottom:0px;padding-bottom:0px;">
				<?php //if(isset($releasingdata['medtech']['signature'])):?>
				<!-- <img width='70px' src='<?php //echo $releasingdata['medtech']['signature']; ?>' /> -->
				<?php //endif;?>
			</td>
			<td style="margin-bottom:0px;padding-bottom:0px;"></td>
			<td style="margin-bottom:0px;padding-bottom:0px;">
				<?php //if($releasingdata['pathologist']['signature']):?>
				<!-- <img width='70px' src='<?php //echo $releasingdata['medtech']['signature']; ?>' /> -->
				<?php //endif;?>
			</td>
		</tr>
		<tr style="margin-top:0px;padding-top:0px;">
			<td style="margin-top:0px;padding-top:0px;">Technologist</td>
			<td style = 'text-transform:uppercase;'  style="margin-top:0px;padding-top:0px;">:
			<?php 
				if($medtech)
					echo $medtech['firstname']." ".$medtech['middlename']." ".$medtech['lastname'];
			?>
			</td>
			<td style="margin-top:0px;padding-top:0px;">Pathologist</td>
			<td style = 'text-transform:uppercase;text-align: center;' style="margin-top:0px;padding-top:0px;">:
			<?php 
				if($pathology)
					echo $pathology['firstname']." ".$pathology['middlename']." ".$pathology['lastname'];
			?>
			</td>
		</tr>
		<tr>
			<td>Date Printed</td>
			<td>
			
			:<?php 
						if($release_datetime)
							echo $release_datetime; 
					?>
			</td>
			<td></td>
			<td></td>

		</tr>
		<tr>
			<td colspan = "4">&nbsp;</td>
		</tr>
		<tr>
			<td colspan = "4"></td>
		</tr>
	</table>
		

</htmlpagefooter>
