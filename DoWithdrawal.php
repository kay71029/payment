<?php
session_start();
require("MySqlCconnect.php");
header('Content-Type: text/html; charset=utf-8');

if ($_POST["ac_acount"] != null) {
    try {
        $db->beginTransaction();
        $sql = "SELECT * FROM `admin` WHERE `ac_id` = :ac_id";
        $result = $db->prepare($sql);
        $result->bindParam('ac_id', $_SESSION['ac_id']);
        $result->execute();
        $data = $result->fetch();

        $originalMoney = $data['ac_acount'];
        $acVersion = $data['ac_version'];
        $payMoney = $_POST["ac_acount"];
        $totalMoney = $originalMoney - $payMoney;

        if ($originalMoney < $payMoney) {
            throw new Exception("餘額不足");
        }

        $sql = "UPDATE `admin` SET `ac_acount` = `ac_acount` - :ac_acount,`ac_v"
        . "ersion` = :ac_version +1 WHERE `ac_id` = :ac_id AND `ac_version` = :"
        . "ac_version";
        $result = $db->prepare($sql);
        $result->bindParam(':ac_acount', $payMoney);
        $result->bindParam(':ac_id', $_SESSION['ac_id']);
        $result->bindParam(':ac_version', $acVersion);
        $result->execute();
        $count = $result->rowCount();

        if ($count != 1) {
            throw new Exception("失敗");
         }

        $sql = "INSERT INTO `banker_detail`(`ac_id`, `type`, `money`, `date`, `"
        . "blance`, `newBlance`) VALUES (:ac_id, 2, :money, :date, :blance, :ne"
        . "wBlance)";
        $result = $db->prepare($sql);
        $result->bindParam(':ac_id', $_SESSION['ac_id']);
        $result->bindParam(':money', $payMoney);
        $result->bindParam(':date', $_POST["time"]);
        $result->bindParam(':blance', $originalMoney);
        $result->bindParam(':newBlance', $totalMoney);
        $result->execute();
        $db->commit();
        echo "新增成功";
    } catch (Exception $e) {
        $db->rollBack();
        echo $e->getMessage();
    }
    header("Refresh:0.5; url = ShowAccountDetailPage.php");
}