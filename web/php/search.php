<?php
/*
 * We return a specific number of results from a specific offset 
 * as JSON.
 *
 * The default offset is 0 and the default limit is a config constant.
 */
need_database();

if( isset($_REQUEST['limit']) && is_numeric($_REQUEST['limit']) )
	$limit = $_REQUEST['limit'];
else
	$limit = SEARCH_RESULTS; 

if( isset($_REQUEST['offset']) && is_numeric($_REQUEST['offset']) )
	$offset = $_REQUEST['offset'];
else
	$offset = 0;

$where = array();
if( isset( $_REQUEST['text'] ) ) {
	$txt = str_replace(' ','%',db_escape($_REQUEST['text']));
	$where[] = "meme_top LIKE '%$txt%' OR meme_bot LIKE '%$txt%'";
}

$order = "meme_created";
if( isset( $_REQUEST['order'] ) ) {
	switch( $_REQUEST['order'] ) {
		case 'rating':
			$order = "meme_rating";
			break;

		case 'rated':
			$order = "meme_rated_by";
			break;

	}
}

$sort = (isset($_REQUEST['sort'])&&($_REQUEST['sort']=='asc'))?"ASC":"DESC";

$sql = "SELECT * FROM meme "
	.( count($where)?' WHERE '.join(' AND ',$where ):"" )
	." ORDER BY $order $sort"
	." LIMIT $offset, $limit";

$ret = array();
if( db_query($sql) === false ) {
	$ret = array('error'=>'Database error running query.');
	error_log("Error querying database: $sql, ".db_error() );
} else {
	$ret = array();
	foreach( db_get_array() as $row ) {
		unset($row['meme_delete_hash']);
		unset($row['meme_delete']);
		foreach( $row as $k => $v )
			$row[$k] = stripslashes($v);

		$ret[] = $row;
	}
}

header( "Content-type: text/plain" );
echo json_encode(array('results'=>$ret));
