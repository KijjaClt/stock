<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/stock/db.php';

$db = new DB();
$db->connect();
$result = $db->query("SELECT * FROM customer");
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>รายชื่อลูกค้า</title>
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
                  <a href="add.php" class="btn bg-success pull-right"><i class="icon-plus"></i>เพิ่มลูกค้า</a>
                  <h4>รายชื่อลูกค้า</h4>
                </header>
                <div class="table-responsive">
                  <table class="table table-striped b-t text-sm">
                    <thead>
                      <tr>
                        <th width="20">#</th>
                        <th>ชื่อ-สกุล</th>
                        <th width="20%">ที่อยู่</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>สถานะ</th>
                        <th width="12%">ดำเนินการ</th>
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
                          <p><?= $row["customer_name"]." ". $row["customer_lastname"]; ?></p>
                        </td>
                        <td>
                          <p><?= $row["customer_address"]; ?></p>
                        </td>
                        <td>
                          <p><?= $row["customer_tel"]; ?></p>
                        </td>
                        <td>
                          <p><?= ($row["customer_type"] == 1 ? '<label class="label bg-success m-l-xs">VIP</label>' : '<label class="label bg-primary m-l-xs">Normal</label>'); ?></p>
                        </td>
                        <td>
                          <a href="edit.php?id=<?= $row["customer_id"]; ?>" class="btn btn-sm bg-warning"><i class="icon-pencil"></i></a>
                          <a href="#" onclick='confirmDelete(<?= $row["customer_id"]; ?>)' class="btn btn-sm bg-danger"><i class="icon-trash"></i></a>
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
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>
    function confirmDelete(id) {
      swal({
          title: "ยืนยันการลูกค้า",
          text: "คุณแน่ใจที่จะลบลูกค้าคนนี้ออกจากระบบใช่หรือไม่ ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((ok) => {
          if (ok) {
            $.ajax({
              url: "delete.php?id=" + id,
              success: function (result) {
                swal("ยินดีด้วย! การลบลูกค้าสำเร็จ", {
                  icon: "success",
                }).then((ok) => {
                  location.reload();
                });;
              }
            });
          }
        });
    }
    </script>
</body>

</html>