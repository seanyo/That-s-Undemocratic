<?php
/*
 * Retrieve everything needed for displaying a 
 * specific meme.
 */

need_database();

// Meme hash == 1th item
if( !empty($_URL[1]) ) {
	// We use the imgur hash in the URL
	$sql = "SELECT * FROM meme WHERE meme_hash = '".db_escape($_URL[1])."'";
	error_log($sql);

	// This is safe, returns FALSE on failure otherwise # of rows
	if( !db_query($sql) ) {
		$template = "notfound";
		$title = "Meme not found";
	} else {
		$meme = db_next_row();
		$template = "single";
		$title = ucfirst(strtolower(stripslashes($meme['meme_top'])).( !empty($meme['meme_bot'])?" ".ucfirst(strtolower(stripslashes($meme['meme_bot']))):"") );
	}
} else {
	$template = "memes";
	$title = "Latest Memes";

	// Get some of the latest memes
	$sql = "SELECT * FROM meme ORDER BY meme_id DESC LIMIT 15";

	if( !db_query($sql) )
		$memes = false;
	else
		$memes = db_get_array();
}
