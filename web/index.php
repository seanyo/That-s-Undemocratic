<?php

require("lib/main.php");

$_URL = $_SERVER['REQUEST_URI'];

if( ($_URL != "/") && (substr($_URL,-1)=="/") ) {
	header( "Location: ".substr($_URL,0,-1) );
	exit;
}

$_QS = "";
if( strpos($_URL,'?') !== false ) {
        list($_URL,$_QS) = explode("?",$_URL);
}

$_URL = substr($_URL,1);
if( empty($_URL) ) $_URL = "default";

if( strpos($_URL,'/') === false )
        $_URL = array($_URL);
else
        $_URL = explode("/",$_URL);

if( empty($_URL[count($_URL)-1]) ) unset($_URL[count($_URL)-1]);

$data = false;
$template = ($_URL[0]=='default')?'default':false;
$title = "";
if( file_exists("php/".$_URL[0].".php") ) {
        $error = false;
        require("php/".$_URL[0].".php");
} else if( file_exists("tpl/".$_URL[0].".php") ) {
	$template = $_URL[0];
	require("lib/static.php");
	if( isset($_STATIC_TITLES[$_URL[0]]) )
		$title = $_STATIC_TITLES[$_URL[0]];
} else {
	header( "HTTP/1.0 404 Not Found" );
	require("php/default.php");
	$template = "default";
}

if( $template !== false ) {
	if( $title != "" ) $title .= " | ";
	$title .= "That's Undemocratic!";

	require("tpl/header.php");
	if( file_exists("tpl/".$template.".php") )
		require("tpl/$template.php");
	else
		echo '<p>Invalid template... 404?</p>';
	require("tpl/footer.php");
}
