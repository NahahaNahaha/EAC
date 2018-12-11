<?php  
 if(isset($_POST["vssn"]))  
 {  
      $output = '';  
      $connect = mysqli_connect( "eacinstance.cmqbzqnyewvh.us-east-2.rds.amazonaws.com", "root", "11111111", "eac");  
      $query = "SELECT * FROM video WHERE VSSN = '".$_POST["vssn"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>카테고리</label></td>  
                     <td width="70%">'.$row["Category"].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>설명</label></td>  
                     <td width="70%">'.$row["Description"].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>종료일</label></td>  
                     <td width="70%">'.$row["End_date"].'</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>현재가</label></td>  
                     <td width="70%">'.number_format($row["Current_bid"]).'원</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>최저 입찰가</label></td>  
                     <td width="70%">'.number_format($row["Low_bid"]).'원</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>즉시 구매가</label></td>  
                     <td width="70%">'.number_format($row["Instant_bid"]).'원</td>  
                </tr>
				<tr>
				     <td width="30%"><label>클립 보기</label></td>  
                     <td width="70%"><video width="400" controls>
				  <source src="../clip/clips/'.$row["File"].'" type="video/mp4">
				</video></td>  
				</tr>
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>