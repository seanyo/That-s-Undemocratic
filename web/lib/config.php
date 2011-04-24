<?php

/** Database Username */
define( "DB_USER", "" );

/** Database Password */
define( "DB_PASS", "" );

/** Database Name */
define( "DB_DB", "meme" );

/** Database host */
define( "DB_HOST", "localhost" );

/** Font size (points for gd2, px for gd1).
    TODO: This will not automatically update the number of
          characters per line. */
define( "FONT_SIZE", 44 );

/** Characters per line. Adjust after tinkering with FONT_SIZE */
define( "PER_LINE", 26 );

/** Your imgur.com anonymous API key */
define( "IMGUR_KEY", '' );

/** Preserve URL strip on image. This can be 0 if you want */
define( "BOTTOM_GUTTER", 23 );

/** Number of search results to return per page */
define( "SEARCH_RESULTS", 15 );

/** Copy to config.local.php and remove this line: */
die("You really should create a config.local.php based on config.php");
