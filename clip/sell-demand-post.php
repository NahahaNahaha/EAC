<?php

include 'db.php';
session_start();

?>


<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Everybody's Auction</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>
 
 
<body id="page-top">

  <nav class="navbar navbar-expand-sm navbar-custom static-top">

    <a class="navbar-brand mr-1" href="live-auction.php"><img src="img/logo.png"/></a>

    <!-- 기능은 없고 그냥 아이콘 오른쪽 정렬용 -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
		<?php
			if( !isset($_SESSION[is_login]) && $_SESSION[in_login] != 1 ) {
		?>
          <a class="btn btn-light" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
		<?php
			} else {
		?>
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  <?php echo $_SESSION[ID] ?>
			  <i class="fas fa-user-circle fa-2x"></i>

			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
			  <a class="dropdown-item" href="mypage.php">My Page</a>
			  <div class="dropdown-divider"></div>
			  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
			</div>
		</li>
		<?php
			}
		?>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="live-auction.php">
          <i class="fas fa-fw fa-video"></i>
          <span>Live Auction</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="../clip/clip.php">
          <i class="fas fa-fw fa-file-video"></i>
          <span>Clip</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sell-demand-post.php">
          <i class="fas fa-fw fa-pen"></i>
          <span>Sell Demand Post</span></a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Navbar Search -->
          <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group" style="margin-bottom:10px;">
              <div class="input-group-btn search-panel">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span id="search_concept">Filter by</span> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#contains"> Contains</a></li>
                  <li><a href="#its_equal"> It's equal</a></li>
                  <li><a href="#greather_than"> Greather than ></a></li>
                  <li><a href="#less_than"> Less than < </a></li>
                  <li class="divider"></li>
                  <li><a href="#all">Anything</a></li>
                </ul>
              </div>
              <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>

		<?php	
			if( !isset($_SESSION[is_login]) && $_SESSION[in_login] != 1 ) {
			} else {
		?>
		  	  
          <div class="new-item" style="float:right">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#new-item-modal">
              <button class="btn btn-large btn-primary" type="button">
                <i class="fas fa-pen"></i>
              </button>
            </a>
          </div>
		<?php
			}
		?>
		
          <!-- Page Content -->
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
			  //print "<td><a href = ../clip/post-select.php?idx={$row[PSSN]}>$row[Title]</a></td>";
			  print "<td><a data-toggle='modal' href='#item-info-modal' class='view_data' id='$row[PSSN]'>$row[Title]</a></td>";
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

			  print "<a href=../clip/sell-demand-post.php?idx={$i}> [";
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

            <!--/. Page Content -->
            <!-- /.container-fluid -->

                  <!-- Sticky Footer -->
                  <footer class="sticky-footer">
                    <div class="container my-auto">
                      <div class="copyright text-center my-auto">
                        <span>Copyright © Your Website 2018</span>
                      </div>
                    </div>
                  </footer>

                </div>
                <!-- /.content-wrapper -->

              </div>
              <!-- /#wrapper -->

              <!-- Scroll to Top Button-->
              <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
              </a>

              <!-- Login Modal-->
              <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
					<form method="post" action="signin.php">
						<div class="modal-body">
						  <div class="form-group">
							<label for="inputID">ID</label>
							<input type="text" class="form-control" name = "ID" id="ID" placeholder="Enter your ID">
						  </div>
						  <div class="form-group">
							<label for="inputID">Password</label>
							<input type="password" class="form-control" name="PW" id="PW" placeholder="Password">
						  </div>
						</div>
						<div class="modal-footer">
						  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						  <button class="btn btn-primary" type="submit">Login</button>
						</div>
					</form>
                  </div>
                </div>
              </div>
			  
              <!-- Logout Modal-->
              <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">로그아웃</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">정말 로그아웃 하실건가요</div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">취소</button>
                      <a class="btn btn-primary" href="signout.php">로그아웃</a>
                    </div>
                  </div>
                </div>
              </div>
			
			<!-- post upload modal! -->
            <div class="modal fade" id="new-item-modal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
			   	<?php	
				echo'
					<div class="modal-content">
						<div class="modal-header">
						  <h4 class="modal-title" id="uploadModalLabel">판매 요청 올리기</h4>
						  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						</div>
					<form action ="write_ok.php" method="post" enctype ="multipart/form-data">
						<div class="modal-body">
							<div class="clip-upload">
							  <div class="form-group">
								<input type="hidden" name = "user_id" class="form-control" id="user_id" value="'.$_SESSION[SSN].'" readonly >
							  </div>
							  <div class="form-group">
								<input type="title" name = "title" class="form-control" id="title" placeholder="제목 입력...">
							  </div>
							  <div class="form-group">
								<textarea class="form-control" id="desc" name="body" rows="3" placeholder="내용 작성..."></textarea>
							  </div>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-primary" type="submit" name="submit">Upload</button>
							<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						</div>
					</form>
					</div>
				';
				?>
              </div>
			 </div>
			  
			<!-- Item Info modal! -->
            <div class="modal bs-example-modal-lg" id="item-info-modal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-lg" role="document">

					<div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title" id="item-name">상세 내용</h5>
						  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						</div>
						<div class="modal-body" id="item-detail">
						</div>
						<div class="modal-footer">
							<button class="btn btn-secondary" type="button" data-dismiss="modal">닫기</button>
						</div>
					</div>
              </div>
			 </div>
			 
              <!-- Bootstrap core JavaScript-->
              <script src="vendor/jquery/jquery.min.js"></script>
              <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

              <!-- Core plugin JavaScript-->
              <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

              <!-- Custom scripts for all pages-->
              <script src="js/sb-admin.min.js"></script>
              

            </body>

</html>
<script>
 $(document).ready(function(){  
      $('.view_data').click(function(){  // class name
           var pssn = $(this).attr("id");  // id tag
           $.ajax({  
                url:"post-select.php",  
                method:"post",  
		data:{pssn:pssn},
                success:function(data){  
                     $('#item-detail').html(data);  // id of modal-body
                     $('#item-info-modal').modal("show");  // id of modal
                }  
           });  
      });  
 });  
</script>
