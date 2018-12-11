<?php

$db = mysql_connect( 'eacinstance.cmqbzqnyewvh.us-east-2.rds.amazonaws.com', 'root', '11111111' );

if( !$db ) {

  die( 'MYSQL connect ERROR: ' . mysql_error());

}



$ret = mysql_select_db( 'eac', $db );

if( !$ret ) {

  die( 'MYSQL select ERROR: ' . mysql_error());

}

?>
