<?php
/*
 * Retrieve any data required for the home page
 */
need_database();

// Get some of the latest memes
$sql = "SELECT * FROM meme ORDER BY meme_created DESC LIMIT 15";
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
