<?php

session_start();

if (isset($_SESSION["user_id"])) {
   
    $mysqli = require __DIR__ . "/database.php";
   
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
           
    $result = $mysqli->query($sql);
   
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="inde.css">
</head>
<body >
   
    <p>THANK YOU<br>..............your data has been submitted succsessfully.</p>
   

       

       
        <p><a href="logout.php">Logout here!</a></p>
       
    
   
</body>
</html>