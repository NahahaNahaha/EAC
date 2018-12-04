<?php

include 'db.php';



$user_id = $_POST[user_id];

$user_pw = $_POST[user_pw];

$nickname = $_POST[nickname];

$check = $_POST[check];

$class = 'bronze';

$name = $_POST[name];

$address = $_POST[address];

$phone = $_POST[phone];

if( $user_id != '' && $user_pw != '' && $address != '' ) {



  // duplicate check

  $sql = "SELECT * FROM member WHERE ID='{$user_id}'";

  $resource = mysql_query( $sql );

  $num = mysql_num_rows( $resource );

  mysql_query("set session character_set_connection=utf8;");
  mysql_query("set session character_set_results=utf8;");
  mysql_query("set session character_set_client=utf8;");



  if( $num > 0 ) {

    echo "<script> alert('already use id'); </script>";

    echo "<script> window.history.back(); </script>";

    exit(0);

  }

  // password equal check

  if( $check != $user_pw ) {

    echo "<script> alert('Your password is not match to check password'); </script>";

    echo "<script> window.history.back(); </script>";

    exit(0);

  }

  $sql = "INSERT INTO member( ID, PW, Nickname, Class, Name, Address, Phone) VALUE( '{$user_id}', '{$user_pw}', '{$nickname}', '{$class}','{$name}','{$address}', '{$phone}')";

  $ret = mysql_query( $sql );

  if( $ret ) {

    echo "<script> alert('회원가입이 정상적으로 처리되었습니다'); </script>";

    echo "<meta http-equiv='refresh' content=\"0;url=http://ec2-3-16-154-62.us-east-2.compute.amazonaws.com/jin/index.php\">";

    exit(0);

  }else {

    die( 'MYSQL query ERROR: ' . mysql_error());

  }



}else {

?>



<!DOCTYPE html>

<html lang="en">

  <head>

    <title>게시판</title>
    <meta charset=utf-8">


    <!-- Bootstrap core CSS -->

    <link href="bootstrap-3.3.2/dist/css/bootstrap.min.css" rel="stylesheet">



    <!-- Custom styles for this template -->

    <link href="bootstrap-3.3.2/dist/css/signin.css" rel="stylesheet">

  </head>



  <body>



    <div class="container">

      <form class="form-signin" method=POST>

        <h2 class="form-signin-heading">Please sign up</h2>



        <input type="text" name=user_id class="form-control"

         placeholder="User ID" required autofocus>



        <input type="password" name=user_pw class="form-control"

	 placeholder="Password" required>


        <input type="password" name=check class="form-control"

         placeholder="Check password" required>


	<input type="text" name=nickname class="form-control"

	 placeholder="Your nickname" required>



	<input type="text" name=name class="form-control"

	 placeholder="Your real name" required>



	<input type="text" name=phone class="form-control"

	 placeholder="Your phone number" required>



        <input type="text" name=address class="form-control"

         placeholder="Home address" required>



        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

      </form>

    </div> <!-- /container -->



  </body>

</html>



<?php

}

mysql_query("set session character_set_connection=utf8;");

mysql_query("set session character_set_results=utf8;");

mysql_query("set session character_set_client=utf8;");

?>

