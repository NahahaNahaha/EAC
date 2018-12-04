<?php

include 'db.php';

session_start();



$user_id = $_SESSION[SSN];



$sql = "DELETE FROM session WHERE SSN = '{$user_id}'";

$ret = mysql_query( $sql );



setcookie( session_name(), '', time()-99999999 );

session_destroy();



?>

<meta http-equiv='refresh' content="0;url='http://ec2-3-16-154-62.us-east-2.compute.amazonaws.com/jin/index.php'">
