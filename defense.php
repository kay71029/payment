<?php
    session_start();
 
    header('Content-Type: text/html; charset=utf-8');
    include("mysql.php");
    //echo $_SESSION['user_id'] ;
   if( $_SESSION['ac_id']  != null)
   {
      ;
   }
   else 
   {
     
     header("Refresh:0.5; url=Login.php" );
     exit();
   }
   
?>