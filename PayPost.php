<?php

    session_start();
    require("MySql.php");
    header('Content-Type: text/html; charset=utf-8');

    if ($_POST["ac_acount"] != null ) {
        try {
            $db->beginTransaction();
            $sql = "SELECT * FROM `admin` WHERE `ac_id` = :ac_id FOR UPDATE";
            $result = $db->prepare($sql);
            $result->bindParam('ac_id', $_SESSION['ac_id']);
            $result->execute();
            $data = $result->fetch();

            $orgMoney = $data['ac_acount'];
            $payMoney = $_POST["ac_acount"];
            $totalMoney = $orgMoney - $payMoney;

            if ($totalMoney >= 0) {
                $sql = "UPDATE `admin` SET `ac_acount`= `ac_acount` - :ac_acount WHERE `ac_id` = :ac_id ";
                $result = $db->prepare($sql);
                $result->bindParam(':ac_acount', $payMoney);
                $result->bindParam(':ac_id', $_SESSION['ac_id']);
                $result->execute();

                $sql = "INSERT INTO `banker_detail`(`ac_id`, `type`, `money`, `date`, `blance`, `acountRecord`) VALUES (:ac_id, 2, :money, :date, :blance, :acountRecord)";
                $result = $db->prepare($sql);
                $result->bindParam(':ac_id', $_SESSION['ac_id']);
                $result->bindParam(':money', $payMoney);
                $result->bindParam(':date', $_POST["time"]);
                $result->bindParam(':blance', $orgMoney);
                $result->bindParam(':acountRecord', $totalMoney);
                $result->execute();
                $db->commit();
            } else {
                echo "餘額不足";
                header("Refresh:0.5; url = PayMoney.php");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $db->rollBack();
        }
        echo "新增成功";
        header("Refresh:0.5; url = AccountDetail.php");
    }