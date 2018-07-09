<?php
session_start();
    if (isset($_SESSION["user_id"],$_SESSION["firstName"])) {
        #set sssion to an empty array
        $_SESSION=array();
        header("location:../../index.php");
    } 
   
?>