<?php

include 'db.php';

session_start();



$title = $_POST[title];

$body = $_POST[body];

$user_ssn = $_SESSION[SSN];

$sql = "SELECT * FROM session WHERE SSN ='{$user_ssn}'";

$resource = mysql_query($sql);

$row = mysql_fetch_assoc( $resource );

$user_id = $_SESSION[ID];

$date = date("Y-m-d H:i:s");

$view = 0;

$cate = 'unknown';

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");

$sql = "INSERT INTO post(Author, Title, Description, Category, Date, View) VALUE ( '{$user_ssn}', '{$title}', '{$body}', '{$cate}', '{$date}', '{$view}')";

$ret = mysql_query( $sql );

// .5초 후에 원래 페이지로 리다이렉트
echo "<meta http-equiv=\"refresh\" content=\".5;url=".$_SERVER['HTTP_REFERER']."\"/>"; 

?>
