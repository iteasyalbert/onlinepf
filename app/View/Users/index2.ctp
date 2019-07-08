<!--<?php echo $this->Form->create('Product');?>
<table>
	<tr><?php echo $this->Form->input('item',array('name'=>'[Product][1][item]'));?></tr>
	
</table>
<?php echo $this->Form->end();?>
<form>

</form>
<script>
jQuery('form submit').click(function(){
	ctr = 0;
	data = jQuery('input').val();
	tr = "<tr><input name=data[Product]["+ ctr +"][item] value="+data+"/></tr>";
	ctr+=1;
	$('table tr').find(':last').append(tr);
	
});

</script>-->
<?php
	
			
			$imagename='50f8f3ad-12a4-432c-9b91-1614a4ec3599.jpg';
			$imagepath=WWW_ROOT.'media'.DS.'galleries'.DS. $imagename;;
			$twidth="600";
			$theight="912";
			$filename=WWW_ROOT.'media'.DS.'galleries'.DS.'new'.DS. $imagename;
			
			$simg = imagecreatefromjpeg($imagepath); // Make A New Temporary Image To Create The Thumbanil From 
			$currwidth = imagesx($simg); // Current Image Width  
			$currheight = imagesy($simg); // Current Image Height  
			if ($currheight > $currwidth) { // If Height Is Greater Than Width  
			$zoom = $twidth / $currheight; // Length Ratio For Width  
			$newheight = $theight; // Height Is Equal To Max Height  
			$newwidth = $currwidth * $zoom; // Creates The New Width  
			} else { // Otherwise, Assume Width Is Greater Than Height (Will Produce Same Result If Width Is Equal To Height) 
			$zoom = $twidth / $currwidth; // Length Ratio For Height  
			$newwidth = $twidth; // Width Is Equal To Max Width  
			$newheight = $currheight * $zoom; // Creates The New Height  
			}  
			$dimg = imagecreate($newwidth, $newheight); // Make New Image For Thumbnail  
			imagetruecolortopalette($simg, false, 256); // Create New Color Pallete  
			$palsize = ImageColorsTotal($simg);  
			for ($i = 0; $i < $palsize; $i++) { // Counting Colors In The Image  
			$colors = ImageColorsForIndex($simg, $i); // Number Of Colors Used  
//			ImageColorAllocate($dimg, $colors['red'], $colors['green'], $colors['blue']); // Tell The Server What Colors This Image Will Use 
			}  
			imagecopyresized($dimg, $simg, 0, 0, 0, 0, $newwidth, $newheight, $currwidth, $currheight); // Copy Resized Image To The New Image (So We Can Save It) 
			imagejpeg($dimg, $filename); // Saving The Image  
			imagedestroy($simg); // Destroying The Temporary Image  
			imagedestroy($dimg); // Destroying The Other Temporary Image  
			
/*			$extension = end(explode(".", stripslashes($imagename)));//getExtension($filename);
			$extension = strtolower($extension);

			if($extension=="jpg" || $extension=="jpeg" ){
				$src = imagecreatefromjpeg($imagepath);
				}
			elseif($extension=="png"){
				$src = imagecreatefrompng($imagepath);
			}
			else{
				$src = imagecreatefromgif($imagepath);
			}
			list($width,$height)=getimagesize($imagepath);
			$image =imagecreatetruecolor($newwidth,$newheight);

			imagealphablending($image, false);
	        $color = imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
	        imagefill($image, 0, 0, $color);
	        imagesavealpha($image, true);
	 		imagecopyresampled($image,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

			switch($extension){
		    	case 'gif': imagegif($image, $filename); break;
		    	case 'jpg': imagejpeg($image, $filename); break;
		   		case 'jpeg': imagejpeg($image, $filename); break;
		   		case 'png': imagepng($image, $filename); break;
		  	}
			imagedestroy($src);
			imagedestroy($image);*/

?>