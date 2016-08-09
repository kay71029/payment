<?php
    
    session_start();
    require("mysql.php");
    header('Content-Type: text/html; charset=utf-8');

    if (isset($_POST["ok"])&& $_POST["ac_acount"]!=null ) {
    
     
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
                
                //餘額
                $orgMoney2 = $orgMoney - $acAcount;
                //echo  $orgMoney2 ;
                
                if ($orgMoney2>=0) {
              
                    $sql_Up = "UPDATE `admin` SET `ac_acount`= ? WHERE `ac_id` =  ? "  ;
                    $result_up_studnet_str = $db-> prepare($sql_Up);
                    $result_up_studnet_str->bindParam(1, $orgMoney2);
                    $result_up_studnet_str->bindParam(2, $_SESSION['ac_id']);
                    $result_up_studnet_str->execute();
                    $result_se = $result_up_studnet_str->fetchAll();
                  
                    sleep(3);
                  
                    $sql_In="INSERT INTO `banker_detail`(`ac_id`,`type`, `money`, `date`) VALUES (?,2,?,?)";
                    $result_In = $db-> prepare( $sql_In);
                    $result_In->bindParam(1,$_SESSION['ac_id']);
                    $result_In->bindParam(2,$acAcount);
                    $result_In->bindParam(3,$_POST["time"]);
                    $result_In->execute();
                    $result_se = $result_In->fetchAll();
                    $db->commit();
                      
                } else {
                    
                    echo "餘額不足";
                    echo '<meta http-equiv = REFRESH CONTENT=1;url=Paymoney.php>';
                }
          
            } catch (Exception $e) {
                
                echo $e->getMessage();
                $db->rollBack();
        }
        
        echo "新增成功";
        echo '<meta http-equiv = REFRESH CONTENT=1;url=Paymoney.php>';
    }  
           
    
     

