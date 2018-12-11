<?php

include 'db.php';
session_start();
$ssn = $_SESSION[SSN];

 mysql_query("set session character_set_connection=utf8;");
  mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");


?>


<!DOCTYPE html>

<html lang="en">


<head>
	<meta charset="utf-8">
    <title> 게시판 </title>





</head>






<body>

<?php
//member data
$sql = "SELECT * FROM member WHERE SSN = '{$ssn}'";
$resource = mysql_query($sql);
$row = mysql_fetch_assoc( $resource );

//for buyer
$sql = "SELECT * FROM ord WHERE Buyer = '{$ssn}'";
$resource = mysql_query( $sql );
$row2 = mysql_fetch_assoc( $resource );


//for seller
$sql = "SELECT * FROM ord WHERE Seller = '{$ssn}'";
$resource = mysql_query( $sql );
$row3 = mysql_fetch_assoc( $resource );


//bring product
$sql = "SELECT * FROM video WHERE VSSN = '{$row2[Video]}'";
$resource = mysql_query( $sql );
$row4 = mysql_fetch_assoc( $resource );



print "lists you buy";
while ($row2){
print "$row2[Seller]";
print "$row4[Product]";
print "$row2[Date]";
print "$row2[Price]";
}
print "lists you sell";
while ($row3){



}


?>


</body>

</html>



