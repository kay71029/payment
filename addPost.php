<?php

    session_start();
    require("mysql.php");
    header('Content-Type: text/html; charset = utf-8');

    if (isset($_POST["ok"]) && $_POST["ac_acount"] != null) {
        $db->beginTransaction();
        try {
                $sql = "SELECT * FROM `admin` WHERE `ac_id` = ? FOR UPDATE";
                $result = $db->prepare($sql);
                $result->bindParam(1, $_SESSION['ac_id']);
                $result->execute();
                $data = $result->fetch();

                //原帳戶金額
                $orgMoney = $data['ac_acount'];
                //存入的金額
                $acAcount = $_POST["ac_acount"];
                //計算餘額
                $orgMoney2 = $orgMoney + $acAcount;

                $sql = "UPDATE `admin` SET `ac_acount`= ? WHERE `ac_id` = ? ";
                $result = $db->prepare($sql);
                $result->bindParam(1, $orgMoney2);
                $result->bindParam(2, $_SESSION['ac_id']);
                $result->execute();
                $data = $result->fetchAll();

                $sql = "INSERT INTO `banker_detail`(`ac_id`,`type`, `money`, `date`) VALUES (?,1,?,?)";
                $result = $db->prepare($sql);
                $result->bindParam(1, $_SESSION['ac_id']);
                $result->bindParam(2, $acAcount);
                $result->bindParam(3, $_POST["time"]);
                $result->execute();
                $data = $result->fetchAll();
                $db->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            $db->rollBack();
        }
        echo "新增成功";
        echo '<meta http-equiv = REFRESH CONTENT = 1;url = Addmoney.php>';
    }