<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $mysqli = require __DIR__ . "/database.php";
   
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
   
    $result = $mysqli->query($sql);
   
    $user = $result->fetch_assoc();
   
    if ($user) {
       
        if (password_verify($_POST["password"], $user["password_hash"])) {
           
            session_start();
           
            session_regenerate_id();
           
            $_SESSION["user_id"] = $user["id"];
           
            header("Location: studentform.html");
            exit;
        }
    }
   
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="log.css">
</head>
<body>
   
    <h1>Login</h1>
   
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
   
    <form method="post">
        <fieldset>
            <legend>sign in here!</legend>
            <div>
        <label for="email">email<br>
        <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"></label>
    </div>
    <div>
        <label for="password"> Password<br>
        <input type="password" name="password" id="password"></label>
    </div>
        <button>Log in</button>
        </fieldset>
    </form>
   
</body>
</html>