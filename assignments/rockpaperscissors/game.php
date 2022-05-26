<?php
    session_start();
    if (! isset($_SESSION["userID"])){
        die("Please login");
    }
?>

