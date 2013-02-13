<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here...");
	}
	
	$ID  	   = isset($data) ? recoverPOST("ID", $data[0]["ID_Ad"]) 				: 0;
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"]) 			: recoverPOST("title");
	$banner    = isset($data) ? recoverPOST("banner", $data[0]["Banner"])			: null;
	$URL       = isset($data) ? recoverPOST("URL", $data[0]["URL"]) 				: "http://";		
	$position  = isset($data) ? recoverPOST("position", $data[0]["Position"]) 		: recoverPOST("position");
	$code      = isset($data) ? recoverPOST("code", $data[0]["Code"]) 				: recoverPOST("code");
	$time 	   = isset($data) ? recoverPOST("time", $data[0]["Time"]) 				: recoverPOST("time");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) 	: recoverPOST("situation");
	$principal = isset($data) ? recoverPOST("principal", $data[0]["Principal"]) 	: recoverPOST("principal");
	$edit      = isset($data) ? true 												: false;	
	$action	   = isset($data) ? "edit" 												: "save";
	$href	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") 	: path(whichApplication() ."/cpanel/add/");

	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add", null, "post", "multipart/form-data");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : null;

			echo formInput(array(
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __("Title"), 
				"p" 	=> true, 
				"value" => $title
			));
			
			if (isset($banner)) {
				$image = img(path($banner, true), array("alt" => "Banner", "class" => "no-border", "style" => "max-width: 780px;"));
			
				echo __("If you change the banner image, this image will be deleted") . "<br />";
				echo $image;
				echo formInput(array("name" => "banner", "type" => "hidden", "value" => $banner));
			} 

			echo formInput(array(
				"type" 	=> "file", 
				"name" 	=> "image", 
				"class" => "required", 
				"field" => __("Image"), 
				"p" 	=> true
			));

			$options = array(
				0 => array(
						"value"    => "Top",
						"option"   => __("Top") ." (960x100px)",
						"selected" => ($position === "Top") ? true : false
					),

				1 => array(
						"value"    => "Left",
						"option"   => __("Left") ." (120x600px, 250x250px)",
						"selected" => ($position === "Left") ? true : false
					),

				2 => array(
						"value"    => "Right",
						"option"   => __("Right") ." (120x600px, 250x250px)",
						"selected" => ($position === "Right") ? true : false
					),

				3 => array(
						"value"    => "Bottom",
						"option"   => __("Bottom") ." (960x100px)",
						"selected" => ($position === "Bottom") ? true : false
					),

				4 => array(
						"value"    => "Center",
						"option"   => __("Center") ." (600x100px)",
						"selected" => ($position === "Center") ? true : false
					),
			);

			echo formSelect(array(
				"name" 	=> "position", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Position")), 
				$options
			);
			
			echo formInput(array(
				"name" 	=> "URL", 
				"class" => "span10 required", 
				"field" => __("URL"), 
				"p" 	=> true, 
				"value" => $URL
			));
			
			echo formTextarea(array(
				"name" 	=> "code", 
				"class" => "required", 
				"style" => "height: 150px;", 
				"field" => __("Code"), 
				"p" 	=> true, 
				"value" => $code
			));

			$options = array(
				0 => array(
						"value"    => 1,
						"option"   => __("Yes"),
						"selected" => ((int) $principal === 1) ? true : false
					),
				
				1 => array(
						"value"    => 0,
						"option"   => __("No"),
						"selected" => ((int) $principal === 0) ? true : false
					)
			);

			echo formSelect(array(
				"name" 	=> "principal", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Principal")), 
				$options
			);			
			
			$options = array(
				0 => array(
						"value"    => "Active",
						"option"   => __("Active"),
						"selected" => ($situation === "Active") ? true : false
					),
				
				1 => array(
						"value"    => "Inactive",
						"option"   => __("Inactive"),
						"selected" => ($situation === "Inactive") ? true : false
					)
			);

			echo formSelect(array(
				"name" 	=> "situation", 
				"class" => "required", 
				"p" 	=> true, 
				"field" => __("Situation")), 
				$options
			);			
			
			echo formSave($action);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID));
		echo formClose();
	echo div(false);