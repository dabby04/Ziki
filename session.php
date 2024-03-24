<?php
session_start();

if (isset($_POST['username'])) {
        echo "here";
}

function complete() {
    session_destroy();
}
?>
