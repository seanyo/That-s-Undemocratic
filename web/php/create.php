<?php

if( isset($_REQUEST['submit']) ) {
	need_database();

	$img = imagecreatefromstring(file_get_contents($_SERVER['DOCUMENT_ROOT']."/lib/base.jpg"));

	putenv("GDFONTPATH=".$_SERVER['DOCUMENT_ROOT']."/lib");
	$color = imagecolorallocate($img,255,255,255);
	$stroke = imagecolorallocate($img,0,0,0);

	$top_text = strtoupper(stripslashes(urldecode($_REQUEST['captionOne'])));
	$top = wordwrap($top_text,PER_LINE,"\n",true);
	$y = FONT_SIZE+round(FONT_SIZE/4);
	foreach( explode("\n",$top) as $line ) {
		$box = imagettfbbox(FONT_SIZE,0,"league-gothic.ttf",$line);
		$x = round((imagesx($img)-($box[4]-$box[6])) / 2);
		$ret = imagettfstroketext($img,FONT_SIZE,0,$x,$y,$color,$stroke,"league-gothic.ttf",$line,4);
		$y += ($ret[3]-$ret[5]) + round(FONT_SIZE/4);
	}

	$bot_text = strtoupper(stripslashes(urldecode($_REQUEST['captionTwo'])));
	$bot = explode("\n",wordwrap($bot_text,PER_LINE,"\n",true));
	if( count($bot) == 1 )
		$y = imagesy($img) - round(FONT_SIZE/4);
	else
		$y = imagesy($img) - ((count($bot)-1) * FONT_SIZE) - FONT_SIZE;

	$y -= BOTTOM_GUTTER;

	foreach( $bot as $line ) {
		$box = imagettfbbox(FONT_SIZE,0,"league-gothic.ttf",$line);
		$x = round((imagesx($img)-($box[4]-$box[6])) / 2);
		$ret = imagettfstroketext($img,FONT_SIZE,0,$x,$y,$color,$stroke,"league-gothic.ttf",$line,4);
		$y+= ($ret[3]-$ret[5]) + round(FONT_SIZE/4);
	}

	ob_start();
	imagejpeg($img,null,80);
	$data = base64_encode(ob_get_clean());
	imagedestroy($img);

	$request = array(
		'name' => 'undemocratic'.time().'.jpg',
		'type' => 'base64',
		'title' => urldecode($_REQUEST['captionOne']),
		'caption' => urldecode($_REQUEST['captionTwo']),
		'key' => IMGUR_KEY,
		'image' => $data
	);

	$curl = curl_init("http://api.imgur.com/2/upload.json");
	curl_setopt($curl,CURLOPT_POST,true);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl,CURLOPT_POSTFIELDS,$request);
	$ret = json_decode(curl_exec($curl),true);
	$ret = $ret['upload'];

	$dat = array(
		'meme_hash' => db_escape($ret['image']['hash']),
	   	'meme_delete_hash' => db_escape($ret['image']['deletehash']),
		'meme_image' => db_escape($ret['links']['original']),
		'meme_page' => db_escape($ret['links']['imgur_page']),	
		'meme_delete' => db_escape($ret['links']['delete_page']),
		'meme_small' => db_escape($ret['links']['small_square']),
		'meme_large' => db_escape($ret['links']['large_thumbnail']),
		'meme_top' => db_escape($top_text),
		'meme_bot' => db_escape($bot_text),
		'meme_rating' => 0,
		'meme_rated_by' => 0,
		'meme_created' => time()
	);

	$sql = "INSERT INTO meme (".join(",",array_keys($dat)).") VALUES ('".join("', '",array_values($dat))."')";
	db_query($sql);
	header( "Location: ".$dat['meme_page'] );
	exit;
} else {
	$template = "create";
	$title = "Create a Meme";
}
