<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/stock/db.php';

if (isset($_POST["action"])) {
    $db = new DB();
    $db->connect();

    $id = $_POST["id"];
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $address = $_POST["address"];
    $tel = $_POST["tel"];
    $type = $_POST["type"];
    $sql = "UPDATE customer SET customer_name = '" . $firstName . "', customer_lastname = '" . $lastName . "', customer_address = '" . $address . "', customer_tel = '" . $tel . "', customer_type = '" . $type . "' WHERE customer_id = " . $id . ";";
    $result = $db->query($sql);
    header("location: /stock/customer");

    $db->close();
} else {
    $db = new DB();
    $db->connect();

    $result = $db->query("SELECT * FROM customer WHERE customer_id='".$_GET["id"]."';");
    $row = mysqli_fetch_assoc($result);
    
    $db->close();
}
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
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/stock/views/sidebar.php'; ?>
        <!-- .vbox -->
        <section id="content">
            <section class="vbox">
                <header class="header bg-white b-b">
                    <p>ยินดีต้อนรับสู่ระบบคลังสินค้า</p>
                </header>
                <section class="scrollable wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <form method="post" action="edit.php" data-validate="parsley">
                                <section class="panel">
                                    <header class="panel-heading">
                                        <span class="h4">แก้ไขลูกค้า</span>
                                    </header>
                                    <div class="panel-body">
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-6">
                                                <label>ชื่อ</label>
                                                <input type="hidden" value="<?= $_GET["id"]; ?>" name="id">
                                                <input type="text" value="<?= $row["customer_name"]; ?>" name="first-name" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>นามสกุล</label>
                                                <input type="text" value="<?= $row["customer_lastname"]; ?>" name="last-name" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-6">
                                                <label>ที่อยู่</label>
                                                <textarea name="address" class="form-control" data-required="true"
                                                    autocomplete="off" cols="30" rows="7"><?= $row["customer_address"]; ?></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <br>
                                                <label>เบอร์โทรศัพท์</label>
                                                <input type="text" value="<?= $row["customer_tel"]; ?>" name="tel" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <br>
                                                <label>สถานะ</label>
                                                <select name="type" class="form-control rounded m-b">
                                                    <option value="0" <?= ($row["customer_type"] == 0) ? "selected" : "" ?>>Normal</option>
                                                    <option value="1" <?= ($row["customer_type"] == 1) ? "selected" : "" ?>>VIP</option>
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