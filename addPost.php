<?php

    session_start();
    require("mysql.php");
    header('Content-Type: text/html; charset = utf-8');

    if (isset($_POST["ok"]) && $_POST["ac_acount"] != null) {
        $db->beginTransaction();
        try {
                $sql = "SELECT * FROM `admin` WHERE `ac_id` = :ac_id FOR UPDATE";
                $result = $db->prepare($sql);
                $result->bindParam('ac_id', $_SESSION['ac_id']);
                $result->execute();
                $data = $result->fetch();

                $orgMoney = $data['ac_acount'];
                $saveMoney = $_POST["ac_acount"];
                $totalMoney = $orgMoney + $saveMoney;

                $sql = "UPDATE `admin` SET `ac_acount`= :ac_acount WHERE `ac_id` = :ac_id";
                $result = $db->prepare($sql);
                $result->bindParam('ac_acount', $totalMoney);
                $result->bindParam('ac_id', $_SESSION['ac_id']);
                $result->execute();
                $data = $result->fetchAll();

                $sql = "INSERT INTO `banker_detail`(`ac_id`,`type`, `money`, `date`) VALUES (:ac_id, 1, :money, :date)";
                $result = $db->prepare($sql);
                $result->bindParam('ac_id', $_SESSION['ac_id']);
                $result->bindParam('money', $saveMoney);
                $result->bindParam('date', $_POST["time"]);
                $result->execute();
                $data = $result->fetchAll();
                $db->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            $db->rollBack();
        }
        echo "新增成功";
        header("Refresh:0.5; url = accountDetail.php");
    }