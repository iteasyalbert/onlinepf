<?php
/**
 * Authentication component
 *
 * Manages user logins and permissions.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Controller.Component
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Authentication control component class
 *
 * Binds access control with user authentication and session management.
 *
 * @package       Cake.Controller.Component
 * @link http://book.cakephp.org/2.0/en/core-libraries/components/authentication.html
 */
App::uses('Core', 'Multibyte');
class ImageComponent extends Component {
	
	public $components = array('Cache');
	
	public $settings = array(
		'width' => 1200,
		'height' => 300,
		'padding' => 10
	);
	public $images;
	
	function mergeImage($imageid,$count,$settings){
		$this->log('get image '.$imageid,'test');
		$images = Cache::read('ad_images');
		extract($settings);
		
		$shadowHeight = $height* (float).20;
		$height *= (float) .80;
		
		$imageWidth = ($width - ($padding*($count + 1)))/$count;
		$imageHeight = $height - ($padding*2);
		
		// create main image
		$image =imagecreatetruecolor($width,$height);
		imagealphablending($image, false);
        $color = imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
        imagefill($image, 0, 0, $color);
        imagesavealpha($image, true);
        
        
        // gets image keys included
        $keys = array();
        $imagekeys = array_keys($this->images);
        $leftCount = 0;
        $rightCount = 0;
        
        if((($count-1) % 2) > 0){
        	$leftCount = floor(($count-1)/2);
        	$rightCount = floor(($count-1)/2) + 1;
        }else{
	        $leftCount = ($count-1)/2;
	        $rightCount = ($count-1)/2;
        }
        $leftKeys = array();
        
        reset($imagekeys);
        while(current($imagekeys) != $imageid)
	        next($imagekeys);
        
        for($i = 0;$i < $leftCount;$i++){
        	$key = prev($imagekeys);
        	if(!$key)
        		$key = end($imagekeys);
        	array_unshift($leftKeys,$key);
        }
        
		$rightKeys = array();
        reset($imagekeys);
        while(current($imagekeys) != $imageid)
	        next($imagekeys);
        
        for($i = 0;$i < $rightCount;$i++){
        	$key = next($imagekeys);
        	if(!$key)
        		$key = reset($imagekeys);
        	$rightKeys[] = $key;
        }
        $imagekeys = $leftKeys;
        $imagekeys[] = $imageid;
        $imagekeys = array_merge($imagekeys, $rightKeys);
        $black = imagecolorallocate($image,255, 255, 255);
        
        foreach($imagekeys as $ctr => $key){
	        $image1 = $this->createImageObj($this->path.$this->images[$key]);
	        $image1 = $this->resizeImage($image1,$imageWidth,$imageHeight);
	        $x = ($imageWidth*$ctr) + (($ctr+1)*$padding);
	        $this->createRectangleBorder($image,$x,$padding,($ctr+1 < $count)?$imageWidth:$imageWidth-1, $imageHeight,$black,2);
	        imagecopymerge ( $image , $image1 , $x , $padding , 0 , 0 , $imageWidth , $imageHeight , 100 );
        }
        $image = $this->createImageReflection($image,$shadowHeight,$padding-5);
		return $image;
	}
	
	function createRectangleBorder($image,$x,$y,$width,$height,$color,$thick){
		
		$x -= $thick;
		$y -= $thick;
		$width += $thick;
		$height += $thick;
		
		$this->createLine($image,$x,$y,$x+$width,$y,$color,$thick);
		$this->createLine($image,$x+$width,$y,$x+$width,$y+$height,$color,$thick);
		$this->createLine($image,$x,$y+$height,$x+$width,$y+$height,$color,$thick);
		$this->createLine($image,$x,$y,$x,$y+$height,$color,$thick);
	}
	
	// copied from php manual
	function createLine($image, $x1, $y1, $x2, $y2, $color,$thick){
		if ($thick == 1) {
	        return imageline($image, $x1, $y1, $x2, $y2, $color);
	    }
	    $t = $thick / 2 - 0.5;
	    if ($x1 == $x2 || $y1 == $y2) {
	        return imagefilledrectangle($image, round(min($x1, $x2) - $t), round(min($y1, $y2) - $t), round(max($x1, $x2) + $t), round(max($y1, $y2) + $t), $color);
	    }
	}
	
	// copied from php manual contributors
	function createImageReflection($src_img,$reflection_height,$y_start){
		
		$src_height = imagesy($src_img);
		$src_width = imagesx($src_img);
		$dest_height = $src_height + $reflection_height;
		$dest_width = $src_width;
		
		$reflection = imagecreatetruecolor($dest_width, $dest_height);
  		
		imagealphablending($reflection, false);
        $color = imagecolortransparent($reflection, imagecolorallocatealpha($reflection, 0, 0, 0, 127));
        imagefill($reflection, 0, 0, $color);
        imagesavealpha($reflection, true);
        
        imagecopy($reflection, $src_img, 0, 0, 0, 0, $src_width, $src_height);
        $alpha = 75;
        $alpha_step = 50/$reflection_height;
        
        $src_height -= $y_start;
        for ($y = 1; $y <= $reflection_height; $y++) {
	  		//$alpha = $y * $alpha_step +20;
	  		$alpha += $alpha_step;
	  		for ($x = 0; $x < $dest_width; $x++) {
		      	$rgba = imagecolorat($src_img, $x, $src_height - $y);
		      	//$rgba = imagecolorsforindex($src_img, $rgba);
		      	$r = ($rgba >> 16) & 0xFF;
				$g = ($rgba >> 8) & 0xFF;
				$b = $rgba & 0xFF;
	      		//$rgba = imagecolorallocatealpha($reflection, $rgba['red'], $rgba['green'], $rgba['blue'], $alpha);
	      		if($r || $g || $b){
		    	  	$rgba = imagecolorallocatealpha($reflection, $r, $g, $b, $alpha );
		    	  	imagesetpixel($reflection, $x, $src_height+$y, $rgba);
	      		}
		    }
  		}
  		return $reflection;
	}
	
	function resizeImage($imageSrc,$newWidth,$newHeight){
		
		$image =imagecreatetruecolor($newWidth,$newHeight);

		imagealphablending($image, false);
        $color = imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
        imagefill($image, 0, 0, $color);
        imagesavealpha($image, true);
 		imagecopyresampled($image,$imageSrc,0,0,0,0,$newWidth,$newHeight,imagesx($imageSrc),imagesy($imageSrc));
 		
 		return $image;
	}
	
	function createImageObj($imagePath){
		$src = null;
		$extension = end(explode(".", stripslashes($imagePath)));//getExtension($filename);
		$extension = strtolower($extension);
		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){
			return false;
		}
		if($extension=="jpg" || $extension=="jpeg" ){
			$src = imagecreatefromjpeg($imagePath);
			}
		elseif($extension=="png"){
			$src = imagecreatefrompng($imagePath);
		}
		else{
			$src = imagecreatefromgif($imagePath);
		}
		return $src;
	}
	public function resizeImageTo($imagename,$imagepath,$newwidth,$newheight,$filename){
			
			$extension = end(explode(".", stripslashes($imagename)));//getExtension($filename);
			$extension = strtolower($extension);

			if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){
				return false;
			}
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
			imagedestroy($image);
			
			return true;
	}
	function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		$source = imagecreatefromjpeg($image);
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		imagejpeg($newImage,$thumb_image_name,90);
		chmod($thumb_image_name, 0777);
		return $thumb_image_name;
	}
	//You do not need to alter these functions
	function getHeight($image) {
		$sizes = getimagesize($image);
		$height = $sizes[1];
		return $height;
	}
	//You do not need to alter these functions
	function getWidth($image) {
		$sizes = getimagesize($image);
		$width = $sizes[0];
		return $width;
	}

}
