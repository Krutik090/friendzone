<?php require "../libs/mysqliconn.php"; ?>
<?php
$obj = new App();
if(isset($_POST['login'])){
    $obj->login();
}


