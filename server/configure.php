// initial connection to server and database will be in here


<?php
include('conn_info.php');


$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);


if(!$conn){
    die("Connection failed : " . mysqli_connect_error());
}

?>

