<?php

			//Set the Content Type
      header('Content-type: image/jpeg');
	  
			// Create Image From Existing File
			$jpg_image = imagecreatefromstring(file_get_contents('https://api.telegram.org/file/bot462931904:AAGTGt-fy9sXv7fD7o03RsmQ1X5j9FS7QMs/'.$_GET['p']));
			
			// Allocate A Color For The Text
			$white = imagecolorallocate($jpg_image, 0, 0, 0);
			
			// Set Path to Font File
			$font_path = 'font/BadlyStamped.ttf';
			
			// Set Text to Be Printed On Image
			$text = $_GET['text'];
			$class = $_GET['class'];
			
			 // Print Text On Image
			imagettftext($jpg_image, 15, 0, 0, 130, $white, $font_path, $text);
			imagettftext($jpg_image, 15, 0, 0, 150, $white, $font_path, ucfirst($class));
			
			// Send Image to Browser
      imagejpeg($jpg_image);

      // Clear Memory
     imagedestroy($jpg_image);