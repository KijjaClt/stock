<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/stock/db.php';

$db = new DB();
$db->connect();
$result = $db->query("SELECT * FROM sale_detail NATURAL JOIN product WHERE sale_id='". $_GET['id'] ."'");
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>รายละเอียดรายการขาย</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="/stock/asset/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="/stock/asset/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="/stock/asset/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="/stock/asset/css/font.css" type="text/css" cache="false" />
  <link rel="stylesheet" href="/stock/asset/css/plugin.css" type="text/css" />
  <link rel="stylesheet" href="/stock/asset/css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="/stock/asset/js/ie/respond.min.js" cache="false"></script>
    <script src="/stock/asset/js/ie/html5.js" cache="false"></script>
    <script src="/stock/asset/js/ie/fix.js" cache="false"></script>
  <![endif]-->

  <style>
    a.hover {
      color: #337ab7;
      text-decoration: none;
    }

    a.hover:hover {
        text-decoration: underline;
    }
  </style>
</head>

<body>
  <section class="hbox stretch">
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/stock/views/sidebar.php'; ?>
    <!-- .vbox -->
    <section id="content">
      <section class="vbox">
        <header class="header bg-white b-b">
          <p>ยินดีต้อนรับสู่ระบบคลังสินค้า</p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                  <a href="/stock/sale/list" class="btn bg-info pull-right">กลับ</a>
                  <h4>รายละเอียดรายการ: <?= $_GET["id"] ?></h4>
                </header>
                <div class="table-responsive">
                  <table class="table table-striped b-t text-sm">
                    <thead>
                      <tr>
                        <th width="20">#</th>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>รวม</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1; 
                      if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                      <tr>
                        <td>
                          <p><?= $i ?></p>
                        </td>
                        <td>
                          <p><?= $row["product_no"]?></p>
                        </td>
                        <td>
                          <p><?= $row["product_name"]; ?></p>
                        </td>
                        <td>
                          <p><?= $row["amount"]; ?></p>
                        </td>
                        <td>
                          <p><?= $row["price"]; ?></p>
                        </td>
                        <td>
                          <p><?= $row["price"] * $row["amount"]; ?></p>
                        </td>
                      </tr>
                      <?php $i++; }} ?>
                    </tbody>
                  </table>
                </div>
              </section>
            </div>
          </div>
        </section>
      </section>
    </section>
    <script src="/stock/asset/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/stock/asset/js/bootstrap.js"></script>
    <!-- App -->
    <script src="/stock/asset/js/app.js"></script>
    <script src="/stock/asset/js/app.plugin.js"></script>
    <script src="/stock/asset/js/app.data.js"></script>
</body>

</html>