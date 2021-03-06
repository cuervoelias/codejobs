<?php 
if (!defined("ACCESS")) {
	die("Error: You don't have permission to access here..."); 
}

$URL = path("bookmarks/". $bookmark["ID_Bookmark"] ."/". $bookmark["Slug"], false, $bookmark["Language"]);
?>

<div class="bookmarks">
	<h2>
		<?php echo getLanguage($bookmark["Language"], true); ?> <a href="<?php echo path("bookmarks/visit/". $bookmark["ID_Bookmark"], false, $bookmark["Language"]); ?>" target="_blank" title="<?php echo quotes($bookmark["Title"]); ?>"><?php echo quotes($bookmark["Title"]); ?></a>
	</h2>

	<span class="small italic grey">
		<?php 
			echo __("Published") ." ". howLong($bookmark["Start_Date"]) ." ". __("by") .' <a title="'. $bookmark["Author"] .'" href="'. path("user/". $bookmark["Author"]) .'">'. $bookmark["Author"] .'</a> '; 
			 
			if ($bookmark["Tags"] !== "") {
				echo __("in") ." ". exploding($bookmark["Tags"], "bookmarks/tag/");
			}
		?>			
		<br />

		<?php 
			echo '<span class="bold">'. __("Likes") .":</span> ". (int) $bookmark["Likes"]; 
			echo ' <span class="bold">'. __("Dislikes") .":</span> ". (int) $bookmark["Dislikes"];
			echo ' <span class="bold">'. __("Views") .":</span> ". (int) $views;
		?>
	</span>

	<?php echo display(social($URL, $bookmark["Title"], false), 4); ?>


	<p class="justify">				
		<?php 
			echo stripslashes($bookmark["Description"]); 
		?> 
	</p>

	<br />

	<h3>
		<a href="<?php echo path("bookmarks/visit/". $bookmark["ID_Bookmark"]); ?>" target="_blank" title="<?php echo $bookmark["Title"]; ?>"><?php echo __("Visit Bookmark"); ?></a>
	</h3>

	<?php
		if (SESSION("ZanUser")) {
	?>
			<p class="small italic">
				<?php  echo like($bookmark["ID_Bookmark"], "bookmarks", $bookmark["Likes"]) ." ". dislike($bookmark["ID_Bookmark"], "bookmarks", $bookmark["Dislikes"]) ." ". report($bookmark["ID_Bookmark"], "bookmarks"); ?>
			</p>
	<?php
		}
	?>

	<br />

	<?php
		echo display('<p>'. getAd("728px") .'</p>', 4);
	?>
	<p>
		<?php echo fbComments($URL); ?>
	</p>
	
	<p>
		<a href="<?php echo path("bookmarks"); ?>">&lt;&lt; <?php echo __("Go back"); ?></a>
	</p>
</div>