<?php

include 'db.php';



session_start();


// $id = mysqli_real_escape_string($db, $_POST["ID"]);
$id = $_POST[ID];
// $pw = mysqli_real_escape_string($db, $_POST["PW"]);

$pw = $_POST[PW];


$sql = "SELECT * FROM member WHERE ID = '{$id}' and PW = '{$pw}'";

$resource = mysql_query( $sql );

$num = mysql_num_rows( $resource );



$row = mysql_fetch_assoc( $resource );



if( $num > 0 ) {

  // 인증에 성공한 경우

  // 중복 체크

  $sql = "SELECT * FROM session WHERE SSN = '{$row[SSN]}'";

  $resource = mysql_query( $sql );

  $num = mysql_num_rows( $resource );

  if( $num > 0 ) {

    // 이미 로그인한 사용자인 경우

    echo "<script> alert('해당 아이디는 이미 로그인한 상태입니다'); </script>";



  } else {

    // 아직 로그인하지 않은 경우

    // 1. 세션 테이블에 사용자 정보를 입력(insert)

    $sess_id = session_id();

    $sql = "INSERT INTO session VALUE( $row[SSN], '$sess_id' )";

    $ret = mysql_query( $sql );



    // 2. 세션 변수에 아이디 추가

    $_SESSION[ID] = $id;

    $_SESSION[SSN] = $row[SSN];

    $_SESSION[is_login] = 1;



    // 3. 로그인 환영 메시지 출력

    echo "<script> alert('로그인 되었습니다'); </script>";



  }



} else {

  // 인증에 실패한 경우
  echo "<script> alert('아이디 또는 패스워드가 올바르지 않습니다.'); </script>";



}



?>



<meta http-equiv='refresh' content="0;url='http://ec2-3-16-154-62.us-east-2.compute.amazonaws.com/jin/'">
