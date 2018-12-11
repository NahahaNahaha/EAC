<?php

include 'db.php';

session_start();



$user_id = $_SESSION[SSN];



$sql = "DELETE FROM session WHERE SSN = '{$user_id}'";

$ret = mysql_query( $sql );

setcookie( session_name(), '', time()-99999999 );

session_destroy();

// .5초 후에 원래 페이지로 리다이렉트
echo "<meta http-equiv=\"refresh\" content=\".5;url=".$_SERVER['HTTP_REFERER']."\"/>"; 

?>