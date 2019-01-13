<?php
require_once __DIR__.'db.php';

// if (isset($_POST["action"])) {
//     $db = new DB();
//     $db->connect();

//     $name = $_POST["name"];
//     $username = $_POST["username"];
//     $password = $_POST["password"];
//     $sql = "INSERT INTO customer (customer_id, customer_name, username, `password`) VALUES (NULL, '" . $name . "', '" . $username . "', '" . $password . "');";

//     var_dump($sql);die;

//     $result = $db->query($sql);
//     if ($result) {
//         echo '<div class="alert alert-success">'.
//             '<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>'.
//             '<i class="icon-ok-sign"></i><strong>ยินดีด้วย!</strong> เพิ่มรายชื่อลูกค้าใหม่สำเร็จ</a>'.
//             '</div>';
//     } else {
//         echo '<div class="alert alert-danger">'.
//             '<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>'.
//             '<i class="icon-ban-circle"></i><strong>เกิดข้อผิดพลาด!!</strong> <a href="#" class="alert-link">กรุณาตรวจสอบแบบฟอร์มใหม่อีกครั้ง.'.
//             '</div>';
//     }

//     $db->close();
// }
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
                                <a href="/stock/customer">
                                    <i class="icon-group"></i>
                                    <span>ลูกค้า</span>
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
                            <form method="post" action="add.php" data-validate="parsley">
                                <section class="panel">
                                    <header class="panel-heading">
                                        <span class="h4">เพิ่มลูกค้า</span>
                                    </header>
                                    <div class="panel-body">
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-6">
                                                <label>ชื่อ</label>
                                                <input type="text" name="first-name" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>นามสกุล</label>
                                                <input type="text" name="last-name" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-6">
                                                <label>ที่อยู่</label>
                                                <textarea name="address" class="form-control" data-required="true" autocomplete="off" cols="30" rows="7"></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <br>
                                                <label>เบอร์โทรศัพท์</label>
                                                <input type="password" name="re-password" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <br>
                                                <label>สถานะ</label>
                                                <select name="account" class="form-control rounded m-b">
                                                <option>Normal</option>
                                                <option>VIP</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <footer class="panel-footer text-right bg-light lter">
                                        <button type="submit" name="action" value="add" class="btn btn-success btn-s-xs">บันทึก</button>
                                        <a href="/stock/customer/" class="btn bg-danger btn-s-xs">กลับ</a>
                                    </footer>
                                </section>
                            </form>
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
</body>

</html>