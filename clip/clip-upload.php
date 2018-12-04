<?php
ini_set('display_errors', true);

if(isset($_POST['submit']))
{
	$newClipName = $_POST['clipname'];
	if($_POST['clipname'])
	{
		$newClipName = "clips";
	} else
	{
		$newClipName = strtolower(str_replace(" ", "-", $newClipName));
	}
	$clipTitle = $_POST['cliptitle'];
	$clipDesc = $_POST['clipdesc'];
	
	$tempUserNumber = 1; /////////////////////////////////////// 임시 유저 번호....
	
	$clip = $_FILES['clip']; 
	
	$clipName = $clip["name"];
	$clipType = $clip["type"];
	$clipTempName = $clip["tmp_name"];
	$clipError = $clip["error"];
	$clipSize = $clip["size"];
	
	$clipExt = explode(".", $clipName);
	$clipActualExt = strtolower(end($clipExt));
	
	$allowed = array("jpg", "png", "mp3", "avi", "mp4");
	if(in_array($clipActualExt, $allowed))
	{
		if($clipError===0)
		{
			$clipFullName = uniqid("", true) . "." . $clipActualExt;
			//$clipFullName = $newClipName . "." . uniqid("", true) . "." . $clipActualExt;
			$clipDestination = "/var/www/html/clip/clips/" . $clipFullName;
			
			include_once "clip-db.php";
			
			if(empty($clipTitle) || empty($clipDesc)){
				header("Location: ../clip/clip.php?upload=empty"); // ## 나중에 링크 수정 요망
				exit();
			} else {
				$sql = "SELECT * FROM video;";
				$stmt = mysqli_stmt_init($db);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					echo "SQL STATEMENT FAILED!";
				} else {
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					$rowCount = mysqli_num_rows($result);
					$setClipOrder = $rowCount+1;
					$sql = "INSERT INTO video (File, Type, Host, Title, Description, Category, Product, Start_date, End_date, View, Current_bid, Low_bid, Instant_bid) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";		
					
					// if(!mysqli_stmt_prepare($stmt, $sql)){
						// echo "SQL STATEMENT FAILED!";
					// } else {
						// mysqli_stmt_bind_param($stmt, "ssissssssiiii", 
						// "test.mp4", "clip", $tempUserNumber, "temp_title","It is nothing but the test case.", "temp_category", "temp_product", NOW(), DATE_ADD(NOW(), INTERVAL 4 HOUR), 0, 1000, 500, 10000);
						// mysqli_stmt_execute($stmt);
						
						$sql = "INSERT INTO video (File, Type, Host, Title, Description, Category, Product, Start_date, End_date, View, Current_bid, Low_bid, Instant_bid) VALUES ('$clipFullName', 'clip', $tempUserNumber, '$clipTitle','It is nothing but the test case.', 'temp_category', 'temp_product', NOW(), DATE_ADD(NOW(), INTERVAL 4 HOUR), 0, 1000, 500, 10000);";
						mysqli_query($db, $sql);
						
						// 클립 업로드
						if (move_uploaded_file($clipTempName, $clipDestination)) {
							header("Location: ../clip/clip.php?upload=success"); // ## 나중에 링크 수정 요망
							echo "File is valid, and was successfully uploaded.\n";
						} else {
							echo $clipSize;
							echo "Upload failed";
						}		
					//}
				}
			}			
		} else {
			echo "UPLOAD ERROR!";
			exit();
		}
	} else {
			echo $clipActualExt;
			echo "NOT ALLOWED FILE TYPE!";
			exit();	
	}
	
}

?>
