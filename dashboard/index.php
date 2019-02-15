<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>ระบบคลังสินค้า</title>
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
              <h3>ภาพรวม</h3>
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <section class="panel">
                    <div class="panel-body">
                      <p>
                        <div class="col-lg-3">
                          <p><b>ยอดขายวันนี้</b></p>
                          <p>-</p>
                        </div>
                        <div class="col-lg-3">
                          <p><b>ยอดขายเดือนนี้</b></p>
                          <p>-</p>
                        </div>
                        <div class="col-lg-3">
                          <p><b>ยอดขายรวมทั้งปี</b></p>
                          <p>-</p>
                        </div>
                        <div class="col-lg-3">
                          <p><b>หมวดหมู่ขายดีปีนี้</b></p>
                          <p>-</p>
                        </div>
                      </p>
                    </div>
                  </section>
                </div>
              </div>
              <section class="panel">
                <header class="panel-heading">
                  <h4>สรุปผลประกอบการ</h4>
                </header>
                <div class="panel-body">
                  <p>
                    <div class="col-lg-4">
                      <p><b>ยอดขาย</b></p>
                      <p>-</p>
                    </div>
                    <div class="col-lg-4">
                      <p><b>ต้นทุน</b></p>
                      <p>-</p>
                    </div>
                    <div class="col-lg-4">
                      <p><b>กำไร/ขาดทุน</b></p>
                      <p>-</p>
                    </div>
                  </p>
                </div>
              </section>
              <section class="panel">
                <header class="panel-heading">
                  <h4>สินค้าที่มีการเคลื่อนไหว</h4>
                </header>
                <div class="table-responsive">
                  <table class="table table-striped b-t text-sm">
                    <thead>
                      <tr>
                        <th width="20">#</th>
                        <th>รหัสสินค้า</th>
                        <th width="40%">ชื่อสินค้า</th>
                        <th>เข้า</th>
                        <th>ออก</th>
                        <th>คงเหลือ</th>
                      </tr>
                    </thead>
                    <tbody>
                      
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