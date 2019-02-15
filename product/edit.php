<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/stock/db.php';

if (isset($_POST["action"])) {
    $db = new DB();
    $db->connect();

    $id = $_POST["id"];
    $no = $_POST["no"];
    $name = $_POST["name"];
    $normalPrice = ($_POST["normal_price"] != "") ? $_POST["normal_price"] : "NULL";
    $vipPrice = ($_POST["vip_price"] != "") ? $_POST["vip_price"] : "NULL";
    $category = $_POST["category"];
    $sql = "UPDATE product SET
                product_no = '" . $no . "', 
                product_name = '" . $name . "',
                product_normal_price = " . $normalPrice . ",  
                product_vip_price = " . $vipPrice . ",
                category_id = " . $category . "
            WHERE product_id = " . $id . "
            ;";

    $result = $db->query($sql);
    header("location: /stock/product");

    $db->close();
} else {
    $db = new DB();
    $db->connect();
    $categories = $db->query("SELECT * FROM category");

    $result = $db->query("SELECT * FROM product WHERE product_id='".$_GET["id"]."';");
    $product = mysqli_fetch_assoc($result);

    $db->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>แก้ไขสินค้า</title>
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
                                        <span class="h4">แก้ไขสินค้า</span>
                                    </header>
                                    <div class="panel-body">
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-12">
                                                <label>รหัสสินค้า</label>
                                                <input type="hidden" value="<?= $_GET["id"]; ?>" name="id">
                                                <input type="text" value="<?= $product["product_no"]; ?>" name="no" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-12">
                                                <label>ชื่อสินค้า</label>
                                                <input type="text" value="<?= $product["product_name"]; ?>" name="name" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-6">
                                                <label>ราคาขายส่ง</label>
                                                <input type="text" value="<?= $product["product_vip_price"]; ?>" name="vip_price" class="form-control rounded parsley-validated"
                                                    data-min="1" data-type="number" autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>ราคาขายปลีก</label>
                                                <input type="text"  value="<?= $product["product_normal_price"]; ?>" name="normal_price" class="form-control rounded parsley-validated"
                                                    data-min="1" data-type="number" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-12">
                                                <br>
                                                <label>หมวดหมู่</label>
                                                <select name="category" class="form-control rounded m-b">
                                                    <?php while ($row = mysqli_fetch_assoc($categories)) {
                                                        $select = ($product["category_id"] == $row['category_id']) ? "selected" : "";
                                                        echo "<option value='". $row['category_id'] ."' ". $select .">". $row['category_name'] ."</option>";
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