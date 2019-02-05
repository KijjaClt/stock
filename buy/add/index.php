<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/stock/db.php';

if (isset($_POST["action"])) {
    $db = new DB();
    $db->connect();

    $id = $_POST["id"];
    $contact = $_POST["contact"];
    $date = $_POST["date"];
    $total = $_POST["total"];

    $product = $_POST["product"];
    $amount = $_POST["amount"];
    $price = $_POST["price"];

    $sqlBuy = "INSERT INTO buy (buy_id, buy_date, net_price, contact_id, employee_id) 
            VALUES ('" . $id . "', 
                    '" . $date . "', 
                    " . $total . ", 
                    '" . $contact . "', 
                    '" . 1 . "');";
    $result = $db->query($sqlBuy);

    $sqlDetail = "INSERT INTO buy_detail (buy_id, product_id, amount, price) 
        VALUES ('" . $id . "', 
                " . $product . ", 
                " . $amount . ", 
                '" . $price . "');";
    $result = $db->query($sqlDetail);
        
    $sqlUpdate = "UPDATE product SET product_amount = product_amount+" . $amount . " WHERE product_id = " . $product . ";";
    $result = $db->query($sqlUpdate);
    header("location: /stock/buy/list");

    $db->close();
} else {
    $db = new DB();
    $db->connect();
    $contacts = $db->query("SELECT * FROM contact WHERE contact_type='0'");
    $products = $db->query("SELECT * FROM product WHERE 1");
    $db->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>สร้างรายการซื้อ</title>
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
                            <form method="post" action="index.php" data-validate="parsley">
                                <section class="panel">
                                    <header class="panel-heading">
                                        <span class="h4">สร้างรายการซื้อ</span>
                                    </header>
                                    <div class="panel-body">
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-6">
                                                <label>รายการ</label>
                                                <input type="text" value="<?= 'PO-'.date('Ymd').'-'; ?>" name="id" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>คู่ค้า</label>
                                                <select name="contact" class="form-control rounded m-b">
                                                    <?php while ($row = mysqli_fetch_assoc($contacts)) {
                                                        echo "<option value='". $row['contact_id'] ."'>". $row['contact_name'] ."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-6">
                                                <label>วันที่ทำรายการ</label>
                                                <input type="date" value="<?= date('Y-m-d'); ?>" name="date" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                                    
                                <section class="panel">
                                    <header class="panel-heading">
                                        <a href="#" class="btn bg-primary pull-right"><i class="icon-plus"></i>เพิ่มสินค้า</a>
                                        <h4>สินค้า</h4>
                                    </header>
                                    <div class="panel-body" id="product-list">
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-12">
                                                <label>เลือกสินค้า</label>
                                                <select name="product" class="form-control rounded m-b">
                                                    <?php while ($row = mysqli_fetch_assoc($products)) {
                                                        echo "<option value='". $row['product_id'] ."'>". $row['product_name'] ."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-6">
                                                <label>จำนวน</label>
                                                <input type="text" id="amount" name="amount" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>ราคาต่อหน่วย</label>
                                                <input type="text" id="price" name="price" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <footer class="panel-footer text-right bg-light lter">
                                        <input type="hidden" class="total" name="total">
                                        <b style="margin-right: 30px;">มูลค่ารวม: <u class="total">-</u> บาท</b>
                                        <button type="submit" name="action" value="add" class="btn btn-success btn-s-xs">บันทึก</button>
                                        <a href="/stock/buy/list" class="btn bg-danger btn-s-xs">กลับ</a>
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

        <script>
            $(document).ready(function(){
                $('#amount, #price').change(function(){
                    var amount = $('#amount').val();
                    var price = $('#price').val();

                    if ((amount.length > 0 && price.length > 0) &&  ($.isNumeric(amount) && $.isNumeric(price))) {
                        $('.total').html(amount * price)
                        $('.total').val(amount * price)
                    } else {
                        $('.total').val(0)
                        $('.total').html("-")
                    }
                });
            });
            function addProductSection() {
                $("#product-list").append(
                    '<hr>'+
                    '<div class="form-group pull-in clearfix">'+
                        '<div class="col-sm-12">'+
                            '<label>เลือกสินค้า</label>'+
                            '<select name="product" class="form-control rounded m-b">'+
                                '<option>เลือกสินค้า</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group pull-in clearfix">'+
                        '<div class="col-sm-6">'+
                            '<label>จำนวน</label>'+
                            '<input type="text" name="amount" class="form-control rounded parsley-validated"'+
                                'data-required="true" autocomplete="off">'+
                        '</div>'+
                        '<div class="col-sm-6">'+
                            '<label>ราคาต่อหน่วย</label>'+
                            '<input type="text" name="price" class="form-control rounded parsley-validated"'+
                                'data-required="true" autocomplete="off">'+
                        '</div>'+
                    '</div>'
                );
            }
        </script>
</body>

</html>