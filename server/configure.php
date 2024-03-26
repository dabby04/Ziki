<?php
// require "conn_info.php";
// try {
//     $connString = "mysql:host=localhost;dbname=ziki";
//     $user = DBUSER;
//     $pass = DBPASS;
//     $pdo = new PDO($connString, $user, $pass);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     // print_r("connected");

// } catch (PDOException $e) {
//     die ($e->getMessage());
// }
// 

 $DBHOST = '127.0.0.1';
 $DBPORT = '3307'; // Change this to your MySQL port if it's different
 $DBNAME = 'Ziki_DB';
 $DBUSER = 'root';
 $DBPASS = '';

 try {
     $dsn = "mysql:host=$DBHOST;port=$DBPORT;dbname=$DBNAME;charset=utf8mb4";
     $options = [
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,     ];
     $pdo = new PDO($dsn, $DBUSER, $DBPASS, $options);
} catch (PDOException $e) {
     die("Connection failed: " . $e->getMessage());
 }
 ?>

