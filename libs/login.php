<?php require "../libs/mysqliconn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX PAGE</title>
</head>
<body>
<form action="welcome.php" method="post">
    ENTER NAME:
    <input type="text" name="txtuname"/><br>
    ENTER PASSWORD:
    <input type="password" name="txtupass"/><br>
    <input type="submit" name="login" value="LOGIN"/>
</form>

</body>
</html>