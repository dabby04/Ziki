// initial connection to server and database will be in here


<?php
    $DBHOST= '127.0.0.1';
    $DBNAME = 'Ziki_DB';
    $DBUSER= 'root';
    $DBPASS= "";

$conn = mysqli_connect($DBHOST, $DBUSER , $DBPASS, $DBNAME);


if(!$conn){
    die("Connection failed : " . mysqli_connect_error());
}

?>

