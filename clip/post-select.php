<?php

 if(isset($_POST["pssn"]))  
 {  
      $output = '';  
      $connect = mysqli_connect( "eacinstance.cmqbzqnyewvh.us-east-2.rds.amazonaws.com", "root", "11111111", "eac");  
mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");


      $query = "SELECT * FROM post WHERE PSSN = '".$_POST["pssn"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>내용</label></td>  
                     <td width="70%">'.$row["Description"].'</td>  
                </tr>
                '; 
      }  
      $output .= "</table></div>";  
      echo $output;  
 }  
 ?>
