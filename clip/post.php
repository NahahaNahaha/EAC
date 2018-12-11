<?php
include 'db.php';
session_start();
$user_id = $_SESSION[SSN];
$sql = "SELECT * FROM session WHERE SSN = '{$user_id}'";
$ret = mysql_query( $sql );

?>

<!DOCTYPE html>

<html>

  <head>
	<meta charset="utf-8">
    <title> °Ô½ÃÆÇ </title>



    <!-- Bootstrap core CSS -->

    <link href="bootstrap-3.3.2/dist/css/bootstrap.min.css" rel="stylesheet">



    <!-- Custom styles for this template -->

    <link href="bootstrap-3.3.2/dist/css/jumbotron.css" rel="stylesheet">

  </head>



  <body>
<?php
  mysql_query("set session character_set_connection=utf8;");
  mysql_query("set session character_set_results=utf8;");
  mysql_query("set session character_set_client=utf8;");

$pssn = $_GET['idx'];
$sql = "SELECT * FROM post WHERE PSSN = '{$pssn}'";
$resource = mysql_query( $sql );
$row = mysql_fetch_assoc( $resource );
$sql2 = "SELECT * FROM member WHERE SSN='{$row[Author]}'";
$resource2 = mysql_query($sql2);
$row2 = mysql_fetch_assoc($resource2);
$upview = mysql_query("update post set View=View+1 where PSSN='{$pssn}'");
print "$row[Title]<br>";
print "$row2[ID]<br>";
print "$row[View]<br>";
print "$row[Description]";
?>


  </body>

</html>


