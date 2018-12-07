<?php
    $conn=mysqli_connect("eacinstance.cmqbzqnyewvh.us-east-2.rds.amazonaws.com", "root", "11111111", "opentutorials");
    $sql="select * from topic";
    $result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($result);
    $list="id: {$row['id']} <br> description: {$row['description']} <br> created: {$row['created']}";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>DB Query</title>
</head>
<body>
    <?php
        echo $list;
    ?>
</body>
</html>





