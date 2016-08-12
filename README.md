# FOR UPDATE 壓力測試
<br>測試頁面- ShowDepositPage.php
    <br>將 ShowDepositPage.php 中的 POST值 存在 Post.txt ,SESSION值設定同一個帳戶
    <br>輸入 ab -n 200 -c 3  -T 'application/x-www-form-urlencoded' -p
    <br>    Post.txt https://payment-kay-yu.c9users.io/payment/DoDeposit.php
    <br>結果 0筆數失敗，資料庫金額正確
    <br>輸入 ab -n 400 -c 3  -T 'application/x-www-form-urlencoded' -p
    <br>    Post.txt https://payment-kay-yu.c9users.io/payment/DoDeposit.php
    <br>結果 0筆數失敗，資料庫金額正確
    <br>輸入 ab -n 600 -c 3  -T 'application/x-www-form-urlencoded' -p
    <br>    Post.txt https://payment-kay-yu.c9users.io/payment/DoDeposit.php
    <br>結果 0筆數失敗，資料庫金額正確