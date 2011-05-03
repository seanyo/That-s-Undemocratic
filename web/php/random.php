<?php

need_database();
$sql = "SELECT * FROM meme ORDER BY RAND() LIMIT 1";
if( db_query($sql) && (($row=db_next_row())!==false) ) 
	header( "Location: /meme/".$row['meme_hash'] );
else
	header( "Location: /" );
exit;
