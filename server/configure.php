<?php
require "conn_info.php";
try {
    $connString = "mysql:host=localhost;dbname=ziki";
    $user = DBUSER;
    $pass = DBPASS;
    $pdo = new PDO($connString, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // print_r("connected");

} catch (PDOException $e) {
     die("Connection failed: " . $e->getMessage());
 }
//  ?>

