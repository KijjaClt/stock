<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/stock/db.php';

if (isset($_POST["action"])) {
    $db = new DB();
    $db->connect();

    $no = $_POST["no"];
    $name = $_POST["name"];
    $normalPrice = ($_POST["normal_price"] != "") ? $_POST["normal_price"] : "NULL";
    $vipPrice = ($_POST["vip_price"] != "") ? $_POST["vip_price"] : "NULL";
    $category = $_POST["category"];
    $sql = "INSERT INTO product (
                product_id, 
                product_no, 
                product_name, 
                product_cost, 
                product_normal_price, 
                product_vip_price, 
                product_amount, 
                category_id
            ) VALUES (
                NULL, 
                '" . $no . "', 
                '" . $name . "', 
                NULL, 
                " . $normalPrice . ", 
                " . $vipPrice . ", 
                0, 
                " . $category . "
            );";
    
    $result = $db->query($sql);
    header("location: /stock/product");

    $db->close();
} else {
    $db = new DB();
    $db->connect();
    $categories = $db->query("SELECT * FROM category");
    $lastProductNO = mysqli_fetch_assoc($db->query("SELECT product_no FROM product ORDER BY product_no DESC LIMIT 1"))["product_no"];
    $newProductNO = sprintf("P%04d", intval(substr($lastProductNO,1))+1);
    $db->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>เพิ่มสินค้า</title>
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
                            <form method="post" action="add.php" data-validate="parsley">
                                <section class="panel">
                                    <header class="panel-heading">
                                        <span class="h4">เพิ่มสินค้า</span>
                                    </header>
                                    <div class="panel-body">
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-12">
                                                <label>รหัสสินค้า</label>
                                                <input type="text" value="<?= $newProductNO ?>" name="no" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-12">
                                                <label>ชื่อสินค้า</label>
                                                <input type="text" name="name" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-6">
                                                <label>ราคาขายส่ง</label>
                                                <input type="text" name="vip_price" class="form-control rounded parsley-validated"
                                                    data-min="1" data-type="number" autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>ราคาขายปลีก</label>
                                                <input type="text" name="normal_price" class="form-control rounded parsley-validated"
                                                    data-min="1" data-type="number" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-12">
                                                <br>
                                                <label>หมวดหมู่</label>
                                                <select name="category" class="form-control rounded m-b">
                                                    <?php while ($row = mysqli_fetch_assoc($categories)) {
                                                        echo "<option value='". $row['category_id'] ."'>". $row['category_name'] ."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <footer class="panel-footer text-right bg-light lter">
                                        <button type="submit" name="action" value="add" class="btn btn-success btn-s-xs">บันทึก</button>
                                        <a href="/stock/product/" class="btn bg-danger btn-s-xs">กลับ</a>
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