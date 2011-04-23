<?php
$_URL = substr($_SERVER['REQUEST_URI'],1);
if( ($x=strpos($_URL,'?')) !== false )
	list($_URL,$_QS) = explode("?",$_URL);
else
	$_QS = false;

if( empty($_URL) )
	$_URL = array('default');
else
	$_URL = explode("/",$_URL);

switch( $_URL[0] ) {
	default:
		$tpl = "default";
}

include( "tpl/head.php" );

include( "tpl/".str_replace(array(".",""),"",$tpl).".php" );

include( "tpl/foot.php" );
