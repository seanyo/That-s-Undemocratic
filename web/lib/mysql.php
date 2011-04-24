<?php
$_db_resource = null;
$_db_connected = false;

function db_connect( $user = DB_USER, $pass = DB_PASS, $db = DB_DB, $host = DB_HOST )
{
	global $_db_connected;
	$ret = false;

	if( @mysql_connect( $host, $user, $pass ) ) {
		$ret = @mysql_select_db( $db );
	}

	$_db_connected = $ret;
	return $ret;
}

function db_close()
{
	global $_db_connected;

	if( $_db_connected != false ) {
		$_db_connected = false;
		mysql_close();
	}
}

function db_connected()
{
	global $_db_connected;

	return $_db_connected;
}

function db_query( $sql )
{
	global $_db_resource;
	$_db_resource = mysql_query( $sql );
	if( is_bool( $_db_resource ) ) {
		if( $_db_resource == false ) {
			return false;
		} else {
			return true;
		}
	}
	return @mysql_num_rows( $_db_resource );
}

function db_next_row()
{
	global $_db_resource;
	return @mysql_fetch_array( $_db_resource, MYSQL_ASSOC );
} 

function db_get_array()
{
	$ret = array();

	while( $dat = db_next_row() )
		$ret[] = $dat;

	return $ret;
}

function db_num_rows() {
	global $_db_resource;
	return @mysql_num_rows( $_db_resource );
}

function db_escape( $str ) {
	return mysql_escape_string( $str );
}

function db_last_id()
{
	global $_db_resource;
	return mysql_insert_id();
}

function db_error() {
	return mysql_error();
}

?>
