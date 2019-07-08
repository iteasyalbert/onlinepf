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
class NewImageComponent extends Component {
	
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
		
		//Get Extension
//		$extension = end(explode(".", stripslashes($imagename)));//getExtension($filename);
//		$extension = strtolower($extension);
		$extension = pathinfo($image, PATHINFO_EXTENSION);
		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){
			return false;
		}
		if($extension=="jpg" || $extension=="jpeg" ){
			$source = imagecreatefromjpeg($image);
			}
		elseif($extension=="png"){
			$source = imagecreatefrompng($image);
		}
		else{
			$source = imagecreatefromgif($image);
		}
		
		//Set dimensions
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		
		imagealphablending($newImage, false);
        $color = imagecolortransparent($newImage, imagecolorallocatealpha($newImage, 0, 0, 0, 127));
        imagefill($newImage, 0, 0, $color);
        imagesavealpha($newImage, true);
        
//		$source = imagecreatefromjpeg($image);
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		
//		imagejpeg($newImage,$thumb_image_name,90);
		
		switch($extension){
	    	case 'gif': imagegif($newImage,$thumb_image_name,90); break;
	    	case 'jpg': imagejpeg($newImage,$thumb_image_name,90); break;
	   		case 'jpeg': imagejpeg($newImage,$thumb_image_name,90); break;
	   		case 'png': imagepng($newImage,$thumb_image_name); break;
	  	}
	  	
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
