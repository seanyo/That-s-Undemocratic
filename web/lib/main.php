<?php

function need_database() {
	if( !db_connect() ) {
		error_log("Meme: Unable to connect to database");
		error_log(db_error());
		return false;
	}

	return true;
}
