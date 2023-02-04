<?php

if (empty($_POST["first_name"])) {
    die("firstName is required");
}

if (empty($_POST["last_name"])) {
    die("lastName is required");
}

if (empty($_POST["gender"])) {
    die("gender is required");
}

if (empty($_POST["birth_date"])) {
    die("birth date is required");
}

if (empty($_POST["home_address"])) {
    die("address is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (empty($_POST["course"])) {
    die("course is required");
}

if (empty($_POST["registration_number"])) {
    die("registration number is required");
}


$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO studentdata (first_name,last_name,gender,birth_date,home_address,email,course,registration_number)
        VALUES (?,?,?,?,?,?,?,?)";
       
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssssssss",
                  $_POST["first_name"],
                  $_POST["last_name"],
                  $_POST["gender"],
                  $_POST["birth_date"],
                  $_POST["home_address"],
                  $_POST["email"],
                  $_POST["course"],
                  $_POST["registration_number"]);
                  
                 
if ($stmt->execute()) {

    header("Location:index.php ");
    exit;
   
} else {
   
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
?>