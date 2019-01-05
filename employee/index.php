<?php
require_once '../db.php';

$db = new DB();
$db->connect();
$result = $db->query("SELECT * FROM employee");
$db->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Stock</title>
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
    <!-- .aside -->
    <aside class="bg-primary aside-sm" id="nav">
      <section class="vbox">
        <header class="dker nav-bar">
          <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="body">
            <i class="icon-reorder"></i>
          </a>
          <a href="#" class="nav-brand">Stock</a>
        </header>
        <section>
          <!-- nav -->
          <nav class="nav-primary hidden-xs">
            <ul class="nav">
              <li>
                <a href="/stock/dashboard">
                  <i class="icon-dashboard"></i>
                  <span>รายงาน</span>
                </a>
              </li>
              <li class="dropdown-submenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-copy"></i>
                  <span>รายการขาย</span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="#">สร้างรายการขาย</a>
                  </li>
                  <li>
                    <a href="#">ดูรายการขาย</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="/stock/refund">
                  <i class="icon-retweet"></i>
                  <span>รับคืนสินค้า</span>
                </a>
              </li>
              <li class="dropdown-submenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-shopping-cart"></i>
                  <span>รายการซื้อ</span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="#">สร้างรายการซื้อ</a>
                  </li>
                  <li>
                    <a href="#">ดูรายการซื้อ</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-inbox"></i>
                  <span>จัดการสินค้า</span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="/stock/product">สินค้า</a>
                  </li>
                  <li>
                    <a href="/stock/category">หมวดหมู่</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="/stock/customer">
                  <i class="icon-user"></i>
                  <span>ลูกค้า</span>
                </a>
              </li>
              <li class="active">
                <a href="/stock/employee">
                  <i class="icon-group"></i>
                  <span>พนักงาน</span>
                </a>
              </li>
              <li>
                <a href="/stock/setting">
                  <i class="icon-wrench"></i>
                  <span>ตั้งค่า</span>
                </a>
              </li>
              <li>
                <a href="/stock/">
                  <i class="icon-off"></i>
                  <span>ออกจากระบบ</span>
                </a>
              </li>
            </ul>
          </nav>
          <!-- / nav -->
        </section>
      </section>
    </aside>
    <!-- /.aside -->
    <!-- .vbox -->
    <section id="content">
      <section class="vbox">
        <header class="header bg-white b-b">
          <p>ยินดีต้อนรับสู่ระบบคลังสินค้า</p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-sm-12">
              <section class="panel">
                <header class="panel-heading">
                  <a href="add.php" class="btn bg-success pull-right"><i class="icon-plus"></i>เพิ่มพนักงาน</a>
                  <h4>รายชื่อพนักงาน</h4>
                </header>
                <div class="table-responsive">
                  <table class="table table-striped b-t text-sm">
                    <thead>
                      <tr>
                        <th width="20">#</th>
                        <th>ชื่อผู้ใช้งาน</th>
                        <th>ชื่อพนักงาน</th>
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
                          <p><?= $row["username"]; ?></p>
                        </td>
                        <td>
                          <p><?= $row["employee_name"]; ?></p>
                        </td>
                        <td>
                          <a href="edit.php?id=<?= $row["employee_id"]; ?>" class="btn btn-sm bg-warning"><i class="icon-pencil"></i></a>
                          <a href="#" onclick='confirmDelete(<?= $row["employee_id"]; ?>)' class="btn btn-sm bg-danger"><i class="icon-trash"></i></a>
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
    <!-- parsley -->
    <script src="/stock/asset/js/parsley/parsley.min.js" cache="false"></script>
    <script src="/stock/asset/js/parsley/parsley.extend.js" cache="false"></script>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>
    function confirmDelete(id) {
      swal({
          title: "ยืนยันการลบรายชื่อพนักงาน",
          text: "คุณแน่ใจที่จะลบพนักงานคนนี้ออกจากระบบใช่หรือไม่ ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((ok) => {
          if (ok) {
            $.ajax({
              url: "delete.php?id=" + id,
              success: function (result) {
                swal("ยินดีด้วย! การลบพนักงานสำเร็จ", {
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