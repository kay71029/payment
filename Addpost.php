<?php

    require("mysql.php");
    session_start();
  //require("defense.php");
  //
  
   
    $sql= "SELECT * FROM  `admin` WHERE  `ac_id` =  ? ";
    $result_se_admin_str =  $db->prepare($sql);
    $result_se_admin_str->bindParam(1, $_SESSION['ac_id']);
    $result_se_admin_str ->execute();
    $result_se = $result_se_admin_str->fetch();
    
    $orgmoney=$result_se['ac_acount'];

    //
    //echo $orgmoney;
    $ac_acount=$_POST["ac_acount"];
    echo $_POST["time"];
   
    if(isset($_POST["ok"])&& $_POST["ac_acount"]!=null ){
    
      
      $orgmoney2 =$orgmoney+$ac_acount;
      echo $orgmoney2;
      
      //UPdata 到admin表
      $sql_Up = "UPDATE `admin` SET `ac_acount`= ? 
                           WHERE `ac_id` =  ? " ;
      $result_up_studnet_str = $db-> prepare($sql_Up);
      $result_up_studnet_str->bindParam(1, $orgmoney2);
      $result_up_studnet_str->bindParam(2, $_SESSION['ac_id']);
      $result_up_studnet_str->execute();
      $result_se = $result_up_studnet_str->fetchAll();
      
      // //Inster
      $sql_Up="INSERT INTO `banker_detail`(`ac_id`,`type`, `money`,`balance`, `date`) VALUES (?,1,?,?,?)";
      
      $result_Up = $db-> prepare($sql_Up);
      $result_Up->bindParam(1,$_SESSION['ac_id']);
      $result_Up->bindParam(2,$ac_acount);
      $result_Up->bindParam(3,$orgmoney2);
      $result_Up->bindParam(4,$_POST["time"]);
      $result_Up->execute();
      $result_se = $result_Up->fetchAll();
     
     
     header("Location:Addmoney.php");
      
    }
    
    
    
    
    
    
    
    
     

?> 
