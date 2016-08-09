<?php

    session_start();
    header('Content-Type: text/html; charset=utf-8');
    require("mysql.php");
    
    //--------------------------------------------------------
    //                從Login頁面POST來的值
    //---------------------------------------------------------
    $id = $_POST['ac_id'];
    $pw = $_POST['ac_pw'];
    // echo $id;
    //echo $pw; 
    //--------------------------------------------------------
    //     SELECT admin
    //
    //---------------------------------------------------------
    $sql= "SELECT * FROM  `admin` WHERE  `ac_id` =  ? AND  `ac_pw` = ? ";
    $result =  $db->prepare($sql);
    $result->bindParam(1, $id, PDO::PARAM_STR);
    $result->bindParam(2, $pw, PDO::PARAM_STR);
    $result ->execute();
    $result_se = $result->fetchAll();
     
     
    //--------------------------------------------------------
    //        判斷帳號與密碼是否正確，不可有空值
    //         以及MySQL資料庫裡是否有這個會員
    //---------------------------------------------------------
    

    if (count($result_se) ==1 )//筆數
    {
            //將帳號寫入session，方便驗證使用者身份
            $_SESSION['ac_id'] = $id;
            echo '登入成功!';
            echo '<meta http-equiv = REFRESH CONTENT=1;url=AccountDetail.php>';
    }
    else
    {
            echo '登入失敗!';
            echo '<meta http-equiv = REFRESH CONTENT=1;url=Login.php>';
    } 
 
 
 
 

