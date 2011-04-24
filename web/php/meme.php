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

	// This is safe, returns FALSE on failure otherwise # of rows
	if( !db_query($sql) ) {
		$template = "notfound";
	} else {
		$meme = db_fetch_array();
		$template = "single";
	}
} else {
	$template = "search";
}
