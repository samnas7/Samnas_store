<?php
session_start();

    if (isset($_SESSION["admin_id"],$_SESSION["admin_name"])) {
        #set sssion to an empty array
        $_SESSION=array();
        header("location:../admin_pages/login.php");
    }
?>