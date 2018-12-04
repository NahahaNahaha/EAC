<?php

include 'db.php';

session_start();

?>

<!DOCTYPE html>

<html lang="en">

  <head>

    <title> 게시판 </title>



    <!-- Bootstrap core CSS -->

    <link href="bootstrap-3.3.2/dist/css/bootstrap.min.css" rel="stylesheet">



    <!-- Custom styles for this template -->

    <link href="bootstrap-3.3.2/dist/css/jumbotron.css" rel="stylesheet">

  </head>



  <body>



    <nav class="navbar navbar-inverse navbar-fixed-top">

      <div class="container">

        <div class="navbar-header">

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

            <span class="sr-only">Toggle navigation</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

          </button>

          <a class="navbar-brand" href="#"> 게시판 </a>

        </div>

        <div id="navbar" class="navbar-collapse collapse">

<?php

  if( !isset($_SESSION[is_login]) && $_SESSION[in_login] != 1 ) {

?>

          <form class="navbar-form navbar-right" method=POST action=signin.php>

            <div class="form-group">

              <input type="text" name="ID" placeholder="USER ID" class="form-control">

            </div>

            <div class="form-group">

              <input type="password" name="PW" placeholder="Password" class="form-control">

            </div>

            <button type="submit" class="btn btn-success">Sign in</button>

          </form>

<?php

  } else {

?>



        <form class="navbar-form navbar-right" method=POST action=signout.php>

          <button type="submit" class="btn btn-success">Sign out</button>

        </form>



<?php

  }

?>

      </div>

    </nav>



    <!-- Main jumbotron for a primary marketing message or call to action -->

    <div class="jumbotron">

      <div class="container">

        <table class="table table-striped">

          <thead>

            <tr>

              <th> 번호 </th>

              <th> 게시글 제목 </th>

              <th> 작성자 </th>

	      <th> 작성시간 </th>

	      <th> 조회수 </th>
            </tr>

          </thead>

          <tbody>

<?php


mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");

$resource = mysql_query( " SELECT * FROM post" );

$total_len = mysql_num_rows( $resource );



if( isset($_GET[idx]) ) {

  $start = $_GET[idx] * 10;

  $sql = "SELECT * FROM post ORDER BY PSSN DESC LIMIT $start, 10";

} else {

  $sql = "SELECT * FROM post ORDER BY PSSN DESC LIMIT 10";

}

$resource = mysql_query( $sql );



$num = 1;

while( $row = mysql_fetch_assoc( $resource ) ) {
 $sql2 = "SELECT * FROM member WHERE SSN='{$row[Author]}'";

 $resource2 = mysql_query($sql2);

 $row2 = mysql_fetch_assoc($resource2);
  print "<tr>";

  print "<th scope='row'>$num</th>";

  print "<td><a href = http://ec2-3-16-154-62.us-east-2.compute.amazonaws.com/jin/post.php>$row[Title]</a></td>";

  print "<td>$row2[ID]</td>";

  print "<td>$row[Date]</td>";

  print "<td>$row[View]</td>";

  print "</tr>";



  $num++;

}



$count = (int)($total_len / 10);

if( $total_len % 10 ) { $count++; }



print "<tr>";

print "<td colspan=4 align=center>";



for( $i = 0; $i < $count; $i++ ) {

  print "<a href=http://ec2-3-16-154-62.us-east-2.compute.amazonaws.com/jin/index.php?idx={$i}> [";

  $j = $i+1;

  print $j;

  print "] </a>";

}



print "</td>";

print "</tr>";

?>

          </tbody>

        </table>

      </div>

    </div>



    <div class="container">

      <form class="navbar-form navbar-right" method=POST action=write.php>

        <button type="submit" class="btn btn-success">글쓰기</button>

      </form>

    </div>



    <footer>

      <p>&copy; made 20181202</p>

    </footer>



  </body>

</html>

