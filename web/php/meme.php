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

	$total = db_query("SELECT count(*) AS total FROM meme");
	$total = db_next_row();
	$total = $total['total'];

	$pages = ceil($total / SEARCH_RESULTS);

	if( isset($_REQUEST['page']) )
		$page = $_REQUEST['page'] - 1;
	else
		$page = 0;

	$ppage = $page+1;
	$offs = $page * SEARCH_RESULTS; 

	// Get some of the latest memes
	$sql = "SELECT * FROM meme ORDER BY meme_id DESC LIMIT $offs,".SEARCH_RESULTS;

	if( !db_query($sql) )
		$memes = false;
	else {
		$memes = array();
		foreach( db_get_array() as $row ) {
			if( $row['meme_rated_by'] > 0 )
				$row['rating'] = round($row['meme_rating'] / $row['meme_rated_by']);
			$memes[] = $row;
		}
	}
}
