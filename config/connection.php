<?php
    $host = "localhost";
    $db = "the_scentury";
    $user = "root";
    $password = "";

try {
    $conn = new PDO("mysql:host={$host};dbname={$db};charset=utf8;", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}
?>
