

<?php
<<<<<<< HEAD
    $DBHOST= '127.0.0.1';
    $DBNAME = 'Ziki_DB';
    $DBUSER= 'root';
    $DBPASS= "";

$conn = mysqli_connect($DBHOST, $DBUSER , $DBPASS, $DBNAME);


if(!$conn){
    die("Connection failed : " . mysqli_connect_error());
=======
require "conn_info.php";
try {
    $connString = "mysql:host=localhost;dbname=ziki";
    $user = DBUSER;
    $pass = DBPASS;
    $pdo = new PDO($connString, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // print_r("connected");

} catch (PDOException $e) {
    die ($e->getMessage());
>>>>>>> cff660693ada61f7cd1c9d8941f805e2a1022523
}
?>