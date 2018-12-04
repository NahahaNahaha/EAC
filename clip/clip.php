<!DOCTYPE html>
<html lang="en">

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

    <a class="navbar-brand mr-1" href="live-auction.html"><img src="img/logo.png"/></a>

    <!-- 기능은 없고 그냥 아이콘 오른쪽 정렬용 -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="live-auction.html">
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
        <a class="nav-link" href="sell-demand-post.html">
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


		  	  
          <div class="new-item" style="float:right">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#new-item-modal">
              <button class="btn btn-large btn-primary" type="button">
                <i class="fas fa-plus"></i>
              </button>
            </a>
          </div>

          <!-- Page Content -->



					
          <div class="row">
		  <?php
		  error_reporting(E_ALL);
		  ini_set("display_errors", 1);
		  
		  include_once "clip-db.php";			
			
			$sql = "SELECT * FROM video ORDER BY End_date DESC;";
			$result = mysqli_query($db, $sql);
			$resultCheck = mysqli_num_rows($result);
			
			if($resultCheck>0){
				while($row = mysqli_fetch_assoc($result)){
					echo'<div class="col-md-3">
						<div class="card mb-3 box-shadow">
							<img class="card-img-top" src="http://placehold.it/320x200"  alt="card image cap">
							<div class="card-body">
							  <div class="caption">
								<h4>'.$row["Title"].'</h4>

								  <p style="font-size:14px">seller: skku1492<br>current price: 17000원</p>
								  <p align="center" >
									<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#item-info-modal" style="font-size:14px" data-whatever="">view more information</a>
								  </p>
								</div>
								<div class="d-flex justify-content-between align-items-center">
								  <small class="text-muted">left: 9 mins</small>
								</div>
							  </div>
						</div>
					</div>';
				}
			}
			
			// $stmt = mysqli_stmt_init($db);
			// if(!mysqli_stmt_prepare($stmt, $sql)){
				// echo "SQL STATEMENT FAILED!";
			// } else {
				// mysqli_stmt_execute($stmt);
				// $result = mysqli_stmt_get_result($stmt);
				
				// while($row = mysqli_fetch_assoc($result)){
					// echo'<div class="col-md-3">
						// <div class="card mb-3 box-shadow">
							// <img class="card-img-top" src="http://placehold.it/320x200"  alt="Card image cap">
							// <div class="card-body">
							  // <div class="caption">
								// <h4>'.$row["Title"].'</h4>

								  // <p style="font-size:14px">Seller: skku1492<br>Current Price: 17000원</p>
								  // <p align="center" >
									// <a href="#myModal" class="btn btn-primary btn-block" data-toggle="modal" style="font-size:14px">View More information</a>
								  // </p>
								// </div>
								// <div class="d-flex justify-content-between align-items-center">
								  // <small class="text-muted">Left: 9 mins</small>
								// </div>
							  // </div>
						// </div>
					// </div>'
				// }
			// }
			
			// <div class="col-md-3">
				// <div class="card mb-3 box-shadow">
					// <img class="card-img-top" src="http://placehold.it/320x200"  alt="Card image cap">
					// <div class="card-body">
					  // <div class="caption">
						// <h4>테스트테스트</h4>

						  // <p style="font-size:14px">Seller: skku1492<br>Current Price: 17000원</p>
						  // <p align="center" >
							// <a href="#myModal" class="btn btn-primary btn-block" data-toggle="modal" style="font-size:14px">View More information</a>
						  // </p>
						// </div>
						// <div class="d-flex justify-content-between align-items-center">
						  // <small class="text-muted">Left: 9 mins</small>
						// </div>
					  // </div>
				// </div>
			?>
			</div>

            <!--/. div class="row" -->
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

              <!-- Logout Modal-->
              <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                      <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                  </div>
                </div>
              </div>
			
			<!-- Clip upload modal! -->
            <div class="modal fade" id="new-item-modal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
			   	<?php	
				echo'
					<div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title" id="uploadModalLabel">Upload Clip</h5>
						  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						</div>
					<form action ="clip-upload.php" method="post" enctype ="multipart/form-data">
						<div class="modal-body">
							<div class="clip-upload">
								<input type="text" name="clipname" placeholder="파일 이름...">
								<input type="text" name="cliptitle" placeholder="클립 제목...">
								<input type="text" name="clipdesc" placeholder="클립 설명...">
								<input type="file" name="clip">
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
			   	<?php	
				echo'
					<div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title" id="uploadModalLabel">Upload Clip</h5>
						  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						</div>
					<form action ="clip-upload.php" method="post" enctype ="multipart/form-data">
						<div class="modal-body">
							<div class="c-video">
								<video class="video" src='.$row["File"].'></video>
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
			 
              <!-- Bootstrap core JavaScript-->
              <script src="vendor/jquery/jquery.min.js"></script>
              <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

              <!-- Core plugin JavaScript-->
              <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

              <!-- Custom scripts for all pages-->
              <script src="js/sb-admin.min.js"></script>
              
			  <!-- SJ's Custom scripts for all pages-->
			  <script src="js/sj.js"></script>

            </body>

</html>
