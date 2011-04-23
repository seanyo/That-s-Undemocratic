<?php

require("lib/config.php");
require("lib/main.php");

$_URL = $_SERVER['REQUEST_URI'];
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

$output = "json";
if( strpos($_URL[count($_URL)-1],".") !== false ) {
        list($base,$ext) = explode(".",$_URL[count($_URL)-1]);
        $type = "";
        switch( $ext ) {
                case "json":
                case "xml":
                        $type = $ext;
                        break;
        }

        if( !empty($type) )
                $output = $type;

        $_URL[count($_URL)-1] = $base;

}

$data = false;
if( file_exists("php/".$_URL[0].".php") ) {
        $error = false;
        require("php/".$_URL[0].".php");
}
