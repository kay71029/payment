 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>簡易的銀行系統</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  
<nav class="navbar navbar-inverse" align=right>
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="AccountDetail.php">首頁</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="Addmoney.php">存款<span class="sr-only">(current)</span></a></li>
        <li class="active"><a href="Paymoney.php">付款<span class="sr-only">(current)</span></a></li>
        <li class="active"><a href="AccountDetail.php">查詢明細<span class="sr-only">(current)</span></a></li>
      </ul>
       <form action="Logout.php">
       <button class="btn btn-default navbar-btn">登出</button>
       </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<form method = "post" action ="paypost.php"> 
    <div class="form-group input-group">
        <span class="input-group-addon"><?php echo $datetime = date("Y/m/d" ,strtotime('+8HOUR'));?></span>
    </div>
    
    <input type="hidden" name="time" value="<?php echo $datetime = date("Y/m/d" ,strtotime('+8HOUR'));?>">
    <!--<div class="form-group input-group">-->
    <!--    <span class="input-group-addon">帳戶</span>-->
    <!--    <input type="text" class="form-control"  aria-describedby="basic-addon1" name="ac_id">-->
    <!--</div>-->
     <div class="form-group input-group">
        <span class="input-group-addon">金額</span>
        <input type="number" class="form-control"  aria-describedby="basic-addon1" name="ac_acount">
    </div>
        <br>
        <button type="submit" class="btn btn-default navbar-btn" name="ok">確認</button>
</form>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>