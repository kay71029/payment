<?php

    require("mysql.php");
    session_start();
   

    if(isset($_POST["ok"])&& $_POST["ac_acount"]!=null ) {
    
     
      $db->beginTransaction();
      try {
          
            $sql= "SELECT * FROM  `admin` WHERE  `ac_id` =  ? FOR UPDATE";
            $result =  $db->prepare($sql);
            $result->bindParam(1, $_SESSION['ac_id']);
            $result ->execute();
            $result_se = $result->fetch();
            
            //原帳戶金額
            $orgMoney=$result_se['ac_acount'];
        
            //付款的金額
            $acAcount=$_POST["ac_acount"];
            
            $orgMoney2 = $orgMoney - $acAcount;
            
          if($orgMoney2<=$orgMoney) {
              
              $sql_Up = "UPDATE `admin` SET `ac_acount`= ? 
                                   WHERE `ac_id` =  ? "  ;
              $result_up_studnet_str = $db-> prepare($sql_Up);
              $result_up_studnet_str->bindParam(1, $orgMoney2);
              $result_up_studnet_str->bindParam(2, $_SESSION['ac_id']);
              $result_up_studnet_str->execute();
              $result_se = $result_up_studnet_str->fetchAll();
              
              sleep(5);
              
              $sql_Up="INSERT INTO `banker_detail`(`ac_id`,`type`, `money`, `date`) VALUES (?,2,?,?)";
              $result_Up = $db-> prepare($sql_Up);
              $result_Up->bindParam(1,$_SESSION['ac_id']);
              $result_Up->bindParam(2,$acAcount);
              //$result_Up->bindParam(3,$orgMoney2);
              $result_Up->bindParam(3,$_POST["time"]);
              $result_Up->execute();
              $result_se = $result_Up->fetchAll();
              $db->commit();
              //echo "123";
           }
          
           } catch(Exception $e) {
                echo $e->getMessage();
                $db->rollBack();
           }
      
       }
    
   header("Location:Paymoney.php");
      
    
    
     

?> 
