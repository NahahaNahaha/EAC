<?php

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
  <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link href="css/sj.css" rel="stylesheet">
  
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
          <!-- Page Content -->

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
						  <button class="btn btn-light" type="submit">Login</button>
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
                      <a class="btn btn-light" href="signout.php">로그아웃</a>
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
						  <h4 class="modal-title" id="uploadModalLabel">클립 올리기</h4>
						  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						</div>
					<form action ="clip-upload.php" method="post" enctype ="multipart/form-data">
						<div class="modal-body">
							<div class="clip-upload">
							  <div class="form-group">
								<input type="hidden" name = "user_id" class="form-control" id="user_id" value="'.$_SESSION[SSN].'" readonly >
							  </div>
							  <div class="form-group">
								<input type="title" name = "title" class="form-control" id="title" placeholder="제목 입력...">
							  </div>
							  <div class="form-group">
								  <select class="custom-select mr-sm-2" id="category">
									<option selected>카테고리 선택...</option>
									<option value="1">의류</option>
									<option value="2">뷰티 잡화</option>
									<option value="3">식품 마트 유아</option>
									<option value="4">가구 생활 건강 렌탈</option>
									<option value="5">디지털 가전 컴퓨터</option>
									<option value="6">스포츠 레저 자동차</option>
									<option value="7">도서 티켓 여행</option>
								  </select>
							  </div>
							  <div class="form-group">
								<input type="title" name = "current_bid" class="form-control" id="current_bid" placeholder="시작가">
							  </div>
							  <div class="form-group">
								<input type="title" name = "instant_bid" class="form-control" id="instant_bid" placeholder="즉시 구매가">
							  </div>
							  <div class="form-group">
								<input type="title" name = "low_bid" class="form-control" id="low_bid" placeholder="최소 입찰 단위(원)">
							  </div>
							  <div class="form-group">
								<textarea class="form-control" id="desc" name="desc" rows="3" placeholder="상품 설명..."></textarea>
							  </div>
							 <div class="form-group">
								<input type="file" name="clip" class="file">
								<div class="input-group col-xs-12">
								  <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
								  <input type="text" class="form-control input-lg" name="clipname" disabled placeholder="16MB 이하 동영상 파일(mp4 등)">
								  <span class="input-group-btn">
									<button class="browse btn btn-light input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
								  </span>
								</div>
							  </div>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-light" type="submit" name="submit">Upload</button>
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
						    <div class="col-auto my-1">
							<input type="text" class="form-control" id="bid" placeholder="입찰가">
							</div>
							<button class="btn btn-primary" type="submit" name="submit">입찰하기</button>
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
           var vssn = $(this).attr("id");  // id tag
           $.ajax({  
                url:"clip-select.php",  
                method:"post",  
                data:{vssn:vssn},  
                success:function(data){  
                     $('#item-detail').html(data);  // id of modal-body
                     $('#item-info-modal').modal("show");  // id of modal
                }  
           });  
      });  
 });  
 
 // 파일 첨부 스크립트
 $(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});
 </script>
 
