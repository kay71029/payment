# FOR UPDATE 壓力測試
# 測試頁面- ShowDepositPage.php
# 將 ShowDepositPage.php 中的 POST值 存在 Post.txt ,SESSION值設定同一個帳戶
# 輸入 ab -n 200 -c 3  -T 'application/x-www-form-urlencoded' -p
#    Post.txt https://payment-kay-yu.c9users.io/payment/DoDeposit.php
# 結果 0筆數失敗，資料庫金額正確

# 輸入 ab -n 400 -c 3  -T 'application/x-www-form-urlencoded' -p
#    Post.txt https://payment-kay-yu.c9users.io/payment/DoDeposit.php
# 結果 0筆數失敗，資料庫金額正確

# 輸入 ab -n 600 -c 3  -T 'application/x-www-form-urlencoded' -p
#    Post.txt https://payment-kay-yu.c9users.io/payment/DoDeposit.php
# 結果 0筆數失敗，資料庫金額正確