<?php 
	if (!defined("ACCESS")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID        = isset($data) ? recoverPOST("ID", $data[0]["ID_Post"]) : 0;
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"]) : recoverPOST("title");
	$content   = isset($data) ? recoverPOST("content", $data[0]["Content"]) : recoverPOST("content");
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"]) : recoverPOST("situation");
	$language  = isset($data) ? recoverPOST("language", $data[0]["Language"]) : recoverPOST("language");
	$pwd       = isset($data) ? recoverPOST("pwd", $data[0]["Pwd"]) : recoverPOST("pwd");
	$edit      = isset($data) ? true : false;
	$action    = isset($data) ? "edit" : "save";
	$href      = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") : path(whichApplication() ."/cpanel/add");

	print div("add-form", "class");
		print formOpen($href, "form-add", "multimedia");
			print p(__(ucfirst(whichApplication())), "resalt");
			print isset($alert) ? $alert : null;

			print formInput(array(
				"type" => "file", 
				"id" => "fileselect",
				"name" => "fileselect[]",
				"multiple" => "multiple",
				"field" => __("Upload files"), 
				"p" => true
			));

			print div("filedrag"); 
			print __("Drag & drop your files here");
			print div(false);
			print div("progress") . div(false);
			print div("response") . div(false);
			print '<div class="clear"></div>';
			print formAction($action);
			print formInput(array("name" => "resize_value", "type" => "hidden", "value" => __("Do you want to resize?"), "id" => "resize_value"));
			print formInput(array("name" => "MAX_FILE_SIZE", "type" => "hidden", "value" => "MAX_FILE_SIZE", "id" => "upload"));
			print formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "ID_Post"));
		print formClose();
	print div(false);