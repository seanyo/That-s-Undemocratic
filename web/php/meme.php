<?php
/*
 * Retrieve everything needed for displaying a 
 * specific meme.
 */

need_database();

// Meme hash == 1th item
if( !empty($_URL[1]) ) {
	// We use the imgur hash in the URL

	$sql = "SELECT * FROM meme ORDER BY RAND() DESC LIMIT ".SEARCH_RESULTS;
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


	$sql = "SELECT * FROM meme WHERE meme_hash = '".db_escape($_URL[1])."'";
	// This is safe, returns FALSE on failure otherwise # of rows
	if( !db_query($sql) ) {
		header( "Location: /",true );
		exit;
	} else {
		$meme = db_next_row();
		$template = "single";
		$title = ucfirst(strtolower(stripslashes($meme['meme_top'])).( !empty($meme['meme_bot'])?" ".ucfirst(strtolower(stripslashes($meme['meme_bot']))):"") );
	}
} else {
	header( "Location: /",true,301 );
	exit;
}
