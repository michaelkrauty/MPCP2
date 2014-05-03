<?php

namespace Lazy;

/**
 * Module for handling image size manipulation
 */
class Image extends Module{
	protected $systemImageDir = null;
	protected $webImageDir = null;
	
	/*
	 * Lazily prepare module when it's being used.
	 */
	protected function prepareOnce(){
		if(null !== $this->systemImageDir)
			return;
		
		$this->systemImageDir = \Lazy\Modules::getInstance()->enviroment->getSystemPath(IMAGE_CACHE_FOLDER);
		\Lazy\Modules::getInstance()->enviroment->createFolder($this->systemImageDir);
		$this->webImageDir = \Lazy\Modules::getInstance()->enviroment->convertSystemToWebPath($this->systemImageDir);
	}
	
	/**
	 * Remove meta data from an image
	 * 
	 * @param type $filename
	 *        	filename of the image
	 * @param type $returnSystemPath
	 *        	if true returns a system path, otherwise a web url
	 * @return string system path or a web path
	 * @todo make it actually remove meta data!
	 */
	public function sanitize($filename, $returnSystemPath = false){
		$this->prepareOnce();
		
		global $modules;
		$filePath = $modules->enviroment->getUploadSystemPath($filename);
		
		$path = pathinfo($filePath);
		$originalFilename = strtolower($path['filename']);
		$originalExtension = strtolower($path['extension']);
		
		$newFilename = "{$originalFilename}_sanitized.{$originalExtension}";
		$newLocalPath = $this->systemImageDir . $newFilename;
		$newWebUrl = $this->webImageDir . $newFilename;
		
		copy($filePath, $newLocalPath);
		
		// Output
		return ($returnSystemPath) ? $newLocalPath : $newWebUrl;
	}
	
	/**
	 * Stretch an image to fill a size (will cause distortion if ratio changes)
	 * 
	 * @param type $filename
	 *        	filename of the image
	 * @param type $width
	 *        	desired width
	 * @param type $height
	 *        	desired height
	 * @param type $overwrite
	 *        	overwrite any existing cached version of this image
	 * @param type $returnSystemPath
	 *        	if true returns a system path, otherwise a web url
	 * @return string system path or a web path
	 */
	public function stretch($filename, $width, $height, $overwrite = false, $returnSystemPath = false){
		$this->prepareOnce();
		
		$filePath = \Lazy\Modules::getInstance()->enviroment->getUploadSystemPath($filename);
		
		$path = pathinfo($filePath);
		$originalFilename = strtolower($path['filename']);
		$originalExtension = strtolower($path['extension']);
		
		$newFilename = "{$originalFilename}_stretch_{$width}_{$height}.{$originalExtension}";
		$newLocalPath = $this->systemImageDir . $newFilename;
		$newWebUrl = $this->webImageDir . $newFilename;
		
		// If it's already done!.
		if($overwrite || ! file_exists($newLocalPath)){
			
			// Get the dimensions of the original image.
			list($originalWidth, $originalHeight) = getimagesize($filePath);
			
			switch($originalExtension){
				case 'jpg' :
					$original = imagecreatefromjpeg($filePath);
					break;
				case 'png' :
					$original = imagecreatefrompng($filePath);
					break;
				default :
					new \Lazy\Message("Image type {$originalExtension} unsupported", MESSAGE_TYPE_USER_WARNING);
					return false;
					break;
			}
			
			$resized = imagecreatetruecolor($width, $height);
			imagecopyresampled($resized, $original, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);
			switch($originalExtension){
				case 'jpg' :
					imagejpeg($resized, $newLocalPath, 100);
					break;
				case 'png' :
					imagepng($resized, $newLocalPath);
					break;
			}
		}
		
		// Output
		return ($returnSystemPath) ? $newLocalPath : $newWebUrl;
	}
	
	/**
	 * Resize and crop an image to take up the full dimensions
	 * 
	 * @param type $filename
	 *        	filename of the image
	 * @param type $width
	 *        	desired width
	 * @param type $height
	 *        	desired height
	 * @param type $overwrite
	 *        	overwrite any existing cached version of this image
	 * @param type $returnSystemPath
	 *        	if true returns a system path, otherwise a web url
	 * @return string system path or a web path
	 */
	public function fill($filename, $width, $height, $overwrite = false, $returnSystemPath = false){
		$this->prepareOnce();
		
		$filePath = \Lazy\Modules::getInstance()->enviroment->getUploadSystemPath($filename);
		
		$path = pathinfo($filePath);
		$originalFilename = strtolower($path['filename']);
		$originalExtension = strtolower($path['extension']);
		
		$newFilename = "{$originalFilename}_fill_{$width}_{$height}.{$originalExtension}";
		$newLocalPath = $this->systemImageDir . $newFilename;
		$newWebUrl = $this->webImageDir . $newFilename;
		
		// If it's already done!.
		if($overwrite || ! file_exists($newLocalPath)){
			
			// Get the dimensions of the original image.
			list($originalWidth, $originalHeight) = getimagesize($filePath);
			
			switch($originalExtension){
				case 'jpg' :
					$original = imagecreatefromjpeg($filePath);
					break;
				case 'png' :
					$original = imagecreatefrompng($filePath);
					break;
				default :
					new \Lazy\Message("Image type {$originalExtension} unsupported", MESSAGE_TYPE_USER_WARNING);
					return false;
					break;
			}
			
			$resized = imagecreatetruecolor($width, $height);
			
			// Work out the scale it needs to be to fit within the box.
			$sourceX = $sourceY = 0;
			
			$scaleX = ($width / $originalWidth);
			$scaleY = ($height / $originalHeight);
			if($scaleX > $scaleY){ // if the height needs to be scaled.
			                         // need to stretch y
				$newHeight = ($height / $scaleX);
				$sourceY = (($originalHeight - $newHeight) / 2);
				$originalHeight = $newHeight;
			}else{
				
				// need to stretch x
				$newWidth = ($width / $scaleY);
				$sourceX = (($originalWidth - $newWidth) / 2);
				$originalWidth = $newWidth;
			}
			
			imagecopyresampled($resized, $original, 0, 0, $sourceX, $sourceY, $width, $height, $originalWidth, $originalHeight);
			
			switch($originalExtension){
				case 'jpg' :
					imagejpeg($resized, $newLocalPath, 100);
					break;
				case 'png' :
					imagepng($resized, $newLocalPath);
					break;
			}
		}
		
		// Output
		return ($returnSystemPath) ? $newLocalPath : $newWebUrl;
	}
	
	/**
	 * Resize an image to a specific width or height
	 * If both width and height are given it'll create the biggest possible image
	 * within those dimensions while maintianing aspect ratio
	 * 
	 * @param type $filename
	 *        	filename of the image
	 * @param type $width
	 *        	desired width
	 * @param type $height
	 *        	desired height
	 * @param type $overwrite
	 *        	overwrite any existing cached version of this image
	 * @param type $returnSystemPath
	 *        	if true returns a system path, otherwise a web url
	 * @return string system path or a web path
	 */
	public function resize($filename, $width = 0, $height = 0, $overwrite = false, $returnSystemPath = false){
		$this->prepareOnce();
		
		$filePath = \Lazy\Modules::getInstance()->enviroment->getUploadSystemPath($filename);
		
		$path = pathinfo($filePath);
		$originalFilename = strtolower($path['filename']);
		$originalExtension = strtolower($path['extension']);
		$exportExtension = $originalExtension;
		
		$newFilename = "{$originalFilename}_fit_{$width}_{$height}.{$exportExtension}";
		$newLocalPath = $this->systemImageDir . $newFilename;
		$newWebUrl = $this->webImageDir . $newFilename;
		
		// If it's already done!.
		if($overwrite || ! file_exists($newLocalPath)){
			
			// Get the dimensions of the original image.
			list($originalWidth, $originalHeight) = getimagesize($filePath);
			
			switch($originalExtension){
				case 'jpg' :
					$original = imagecreatefromjpeg($filePath);
					break;
				case 'png' :
					$original = imagecreatefrompng($filePath);
					break;
				default :
					new \Lazy\Message("Image type {$originalExtension} unsupported", MESSAGE_TYPE_USER_WARNING);
					return false;
					break;
			}
			
			// Work out the scale it needs to be to fit within the box.
			$dstX = $dstY = 0;
			
			if($width == 0)
				$width = $originalWidth;
			if($height == 0)
				$height = $originalHeight;
			
			$scaleX = ($width / $originalWidth);
			$scaleY = ($height / $originalHeight);
			if($scaleX < $scaleY){ // if the height needs to be scaled.
			                         // shrink y to match x scale
				$height = ($originalHeight * $scaleX);
				$width = ($originalWidth * $scaleX);
			}else{
				// shrink y to match x scale
				$height = ($originalHeight * $scaleY);
				$width = ($originalWidth * $scaleY);
			}
			
			$resized = imagecreatetruecolor($width, $height);
			imagecopyresampled($resized, $original, $dstX, $dstY, 0, 0, $width, $height, $originalWidth, $originalHeight);
			
			switch($exportExtension){
				case 'jpg' :
					imagejpeg($resized, $newLocalPath, 100);
					break;
				case 'png' :
					imagepng($resized, $newLocalPath, 0);
					break;
			}
		}
		
		// Output
		return ($returnSystemPath) ? $newLocalPath : $newWebUrl;
	}
	
	/**
	 * Resize an image to fit within bounds, creates transparent spacing if ratio doesn't match
	 * 
	 * @param type $filename
	 *        	filename of the image
	 * @param type $width
	 *        	desired width
	 * @param type $height
	 *        	desired height
	 * @param type $bgRed
	 *        	red value to fill blank space with
	 * @param type $bgGreen
	 *        	green value to fill blank space with
	 * @param type $bgBlue
	 *        	blue value to fill blank space with
	 * @param type $bgAlpha
	 *        	alpha value to fill blank space with
	 * @param type $overwrite
	 *        	overwrite any existing cached version of this image
	 * @param type $returnSystemPath
	 *        	if true returns a system path, otherwise a web url
	 * @return string system path or a web path
	 */
	public function fit($filename, $width, $height, $bgRed = 0, $bgGreen = 0, $bgBlue = 0, $bgAlpha = 127, $overwrite = false, $returnSystemPath = false){
		$this->prepareOnce();
		
		$filePath = \Lazy\Modules::getInstance()->enviroment->getUploadSystemPath($filename);
		
		$path = pathinfo($filePath);
		$originalFilename = strtolower($path['filename']);
		$originalExtension = strtolower($path['extension']);
		
		// If they are using transparency, always export as a png.
		$exportExtension = ($bgAlpha == 0) ? $originalExtension : 'png';
		
		$newFilename = "{$originalFilename}_fit_{$width}_{$height}.{$exportExtension}";
		$newLocalPath = $this->systemImageDir . $newFilename;
		$newWebUrl = $this->webImageDir . $newFilename;
		
		// If it's already done!.
		if($overwrite || ! file_exists($newLocalPath)){
			
			// Get the dimensions of the original image.
			list($originalWidth, $originalHeight) = getimagesize($filePath);
			
			switch($originalExtension){
				case 'jpg' :
					$original = imagecreatefromjpeg($filePath);
					break;
				case 'png' :
					$original = imagecreatefrompng($filePath);
					break;
				default :
					new \Lazy\Message("Image type {$originalExtension} unsupported", MESSAGE_TYPE_USER_WARNING);
					return false;
					break;
			}
			
			$resized = imagecreatetruecolor($width, $height);
			$color = imagecolorallocatealpha($resized, $bgRed, $bgGreen, $bgBlue, $bgAlpha);
			imagefill($resized, 0, 0, $color);
			imagesavealpha($resized, true);
			
			// Work out the scale it needs to be to fit within the box.
			$dstX = $dstY = 0;
			$scaleX = ($width / $originalWidth);
			$scaleY = ($height / $originalHeight);
			if($scaleX < $scaleY){ // if the height needs to be scaled.
			                         // shrink y to match x scale
				$newHeight = ($originalHeight * $scaleX);
				$dstY = (($height - $newHeight) / 2);
				$height = $newHeight;
			}else{
				
				// shrink x to match y scale
				$newWidth = ($originalWidth * $scaleY);
				$dstX = (($width - $newWidth) / 2);
				$width = $newWidth;
			}
			
			imagecopyresampled($resized, $original, $dstX, $dstY, 0, 0, $width, $height, $originalWidth, $originalHeight);
			
			switch($exportExtension){
				case 'jpg' :
					imagejpeg($resized, $newLocalPath, 100);
					break;
				case 'png' :
					imagepng($resized, $newLocalPath, 0);
					break;
			}
		}
		
		return ($returnSystemPath) ? $newLocalPath : $newWebUrl;
	}
}