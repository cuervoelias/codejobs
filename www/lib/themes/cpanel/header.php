<?php 
if (!defined("ACCESS")) { 
	die("Error: You don't have permission to access here..."); 
} 
?>
<!DOCTYPE html>
<html lang="<?php echo _get("webLang"); ?>"<?php echo defined("ANGULAR_JS") ? " ng-app" : "";?>>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $this->getTitle(); ?></title>
	
	<?php
		$application = segment(0, isLang());

    	$this->CSS("bootstrap", null, false, true);
		$this->CSS("default", null, false, true); 
		$this->CSS("$this->themeRoute/css/style.css", null, false, true);

		if(defined("CODEMIRROR")) {
			$this->CSS("codemirror", NULL, FALSE, TRUE);
		}

	 	echo $this->getCSS();
	?>			
</head>

<body>
	<?php
		if ($isAdmin) {
		?>
			<div id="top-bar">
				<?php
					$li[] = a("&lsaquo;&lsaquo;". __("Go back"), path());
					$li[] = " | ". span("bold", __("Welcome")) .": " . SESSION("ZanUser");
					$li[] = " | ". span("bold", __("Online users")) .": $online";
					$li[] = " | ". span("bold", __("Registered users")) .": $registered";
					$li[] = " | ". span("bold", __("Last user")) .": ". a($lastUser["Username"], path("users/". $lastUser["Username"] .""));
					$li[] = " | ". a(__("Logout") ."&rsaquo;&rsaquo;", path("cpanel/logout/")) ."";			
					
					echo ul($li);				
				?>
			</div>
		<?php
		} else {
		?>
			<div id="top-bar-logout">
				<a href="<?php echo path(); ?>" title="<?php echo __("Go back"); ?>">&lsaquo;&lsaquo; <?php echo __("Go back"); ?></a>
			</div>
		<?php		
		}
	?>
	
	<div id="container">
		<div id="header">
			<div id="logo">
				<a href="<?php echo path("cpanel"); ?>" title="">
					<img src="<?php echo $this->themePath; ?>/images/logo.png" alt="MuuCMS" class="no-border" />
				</a>
			</div>
						
			<?php
				if ($isAdmin) {
				?>
					<div id="background">
						<div id="notifications">
							<?php 								
								if ($feedbackNotifications > 0) {
									echo '	<a href="'. path("feedback/cpanel/results") .'" title="'. __("Messages") .'">
												<img src="'. $this->themePath .'/images/icons/feedback.png" alt="'. __("Feedback") .'" class="no-border" /> 
												<sup>'. $feedbackNotifications .'</sup> 
											</a>';
								}
							?>
						</div>
					</div>
					
					<div id="route">
						<strong><?php echo __("You are in"); ?>:</strong> <?php echo routePath(); ?>
					</div>
				<?php
				} else {
				?>
					<br />
				<?php
				}
			?>
		</div>