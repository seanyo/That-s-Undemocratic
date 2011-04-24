<?php
/**
 * Very very very simple, stupid and easy to game ratings
 */

$ret = array();
if( !isset( $_URL[1] ) )
	$ret['error'] = "What are you trying to rate?";
else if( !isset($_REQUEST['rate']) || !is_numeric($_REQUEST['rate']) || ($_REQUEST['rate'] < 0) || ($_REQUEST['rate'] > 5)  )
	$ret['error'] = "We need a rating between 0 and 5 please.";
else {
	need_database();
	$rate = round($_REQUEST['rate']);

	$sql = "UPDATE meme SET "
		."meme_rated_by = meme_rated_by + 1, "
		."meme_rating = meme_rating + $rate "
		."WHERE meme_hash = '".db_escape($_URL[1])."'";
	if( db_query($sql) === false ) {
		error_log( "Error recording rating: $sql, ".db_error() );
		$ret['error'] = "Your rating was not recorded. Sorry.";
	} else {
		$ret['success'] = "Thank you for rating this meme.";
	}
}

header( "Content-type: text/plain" );
echo json_encode(array('result'=>$ret));
