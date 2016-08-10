<?php
    session_start();
    require("mysql.php");
    header('Content-Type: text/html; charset=utf-8');
   if ( $_SESSION['ac_id']  != null) {
   } else {
     header("Refresh:0.5; url=login.php");
     exit();
   }
?>