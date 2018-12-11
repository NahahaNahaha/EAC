<?php

include 'db.php';
session_start();
$ssn = $_SESSION[SSN];

 mysql_query("set session character_set_connection=utf8;");
  mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");


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
  <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link href="css/sj.css?afte" rel="stylesheet">
  
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

	  <!-- Page Content-->
			<div class="container-fluid">
			  <div class="mypage">
				  <p>
					<h2>My Page</h2>
					<br><br><br>
				  </p>
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
?>
				  <h2>Order List</h2>
					  <div class="table-responsive-sm">
						<table class="table table-hover">
						  <thead>
							<tr>
							  <th scope="col">Seller</th>
							  <th scope="col">Product</th>
							  <th scope="col">Date</th>
							  <th scope="col">Price</th>
							</tr>
						  </thead>
						  <tbody>
							<?php
							while($row2)
							{
								echo'
								<tr>
								  <th scope="row">$row2[Seller]</th>
								  <td>$row4[Product]</td>
								  <td>$row2[Date]</td>
								  <td>$row2[Price]</td>
								</tr>';
							}
							?>
						  </tbody>
						</table>
					  </div>

			  </div>
			</div>

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
			

			 
              <!-- Bootstrap core JavaScript-->
              <script src="vendor/jquery/jquery.min.js"></script>
              <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

              <!-- Core plugin JavaScript-->
              <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

              <!-- Custom scripts for all pages-->
              <script src="js/sb-admin.min.js"></script>
             

            </body>

</html>
