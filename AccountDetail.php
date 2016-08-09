<?php
  session_start();
  require("defense.php");
  require("mysql.php");
  
    $sql="SELECT * FROM `banker_detail` WHERE `ac_id`=? ";
    $result_se_admin_str =  $db->prepare($sql);
    $result_se_admin_str->bindParam(1, $_SESSION['ac_id']);
    $result_se_admin_str ->execute();
    $result_se = $result_se_admin_str->fetchAll();
   
  
?>
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

 <div class="panel panel-default">
    <div class="panel-heading">
        交易明細
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="dataTable_wrapper">
          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>日期</th>
                        <th>存款/提款</th>
                        <th>金額</th>
                        <th>餘額</th>
                    </tr>
                </thead>
                <tbody>
                     <?php foreach($result_se as $row){?>
                    <tr class="odd gradeX">
                        <td><?PHP echo $row['date']; ?></td>
                        <td><?PHP echo $row['type']; ?></td>
                        <td><?PHP echo $row['money']; ?></td>
                        <td><?PHP echo $row['balance']; ?></td>
                    </tr>
                    <?php }?>
                </tbody>
          </table>

        </div>
    </div>
</div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>