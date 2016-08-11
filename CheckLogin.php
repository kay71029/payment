<?php
session_start();
require("MySqlCconnect.php");
header('Content-Type: text/html; charset=utf-8');

$id = $_POST['ac_id'];
$pw = $_POST['ac_pw'];
$sql = "SELECT * FROM `admin` WHERE `ac_id` = :ac_id AND `ac_pw` = :ac_pw";
$result = $db->prepare($sql);
$result->bindParam('ac_id', $id);
$result->bindParam('ac_pw', $pw);
$result->execute();
$count = $result->rowCount();

if ($count == 1) {
    $_SESSION['ac_id'] = $id;
    echo '登入成功!';
    header("Refresh:0.5; url = ShowAccountDetailPage.php");
} else {
    echo '登入失敗!';
    header("Refresh:0.5; url = ShowLoginPage.php");
}