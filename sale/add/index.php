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

    session_start();

    $sqlSale = "INSERT INTO sale (sale_id, sale_date, net_price, contact_id, employee_id) 
            VALUES ('" . $id . "', 
                    '" . $date . "', 
                    " . $total . ",
                    '" . $contact . "', 
                    '" . $_SESSION["userID"] . "');";
    $result = $db->query($sqlSale);

    for ($i=0; $i < sizeof($product); $i++) { 
        $sqlDetail = "INSERT INTO sale_detail (sale_id, product_id, amount, price) 
            VALUES ('" . $id . "', 
                    " . $product[$i] . ", 
                    " . $amount[$i] . ", 
                    '" . $price[$i] . "');";
        $result = $db->query($sqlDetail);
        
        $sqlUpdate = "UPDATE product SET product_amount = product_amount-" . $amount[$i] . " WHERE product_id = " . $product[$i] . ";";
        $result = $db->query($sqlUpdate);
    }

    header("location: /stock/sale/list");

    $db->close();
} else {
    $db = new DB();
    $db->connect();
    $contacts = $db->query("SELECT * FROM contact WHERE contact_type='1'");
    $products = $db->query("SELECT * FROM product WHERE 1");

    $lastSOID = mysqli_fetch_assoc($db->query("SELECT sale_id FROM sale WHERE sale_id LIKE '%". date('Ymd') ."%' ORDER BY sale_id DESC LIMIT 1"))["sale_id"];
    $newSOID = sprintf("SO-%s-%03d", date('Ymd'), intval(substr($lastSOID,12))+1);

    $db->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>สร้างรายการขาย</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="shortcut icon" href="/stock/asset/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/stock/asset/images/favicon.ico" type="image/x-icon">
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
                                        <span class="h4">สร้างรายการขาย</span>
                                    </header>
                                    <div class="panel-body">
                                        <div class="form-group pull-in clearfix">
                                            <div class="col-sm-6">
                                                <label>รายการ</label>
                                                <input type="text" value="<?= $newSOID; ?>" name="id" class="form-control rounded parsley-validated"
                                                    data-required="true" autocomplete="off" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>ลูกค้า</label>
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
                                        <a href="#" onclick="addProductSection()" class="btn bg-primary pull-right"><i class="icon-plus"></i>เพิ่มสินค้า</a>
                                        <h4>สินค้า</h4>
                                    </header>
                                    <div class="panel-body" id="product-list">
                                        <div id="product-row">
                                            <div class="form-group pull-in clearfix">
                                                <div class="col-sm-12">
                                                    <label>เลือกสินค้า</label>
                                                    <select name="product[]" class="form-control rounded m-b parsley-validated" data-required="true">
                                                        <option data-price='0.00' data-amount='0' value>--- กรุณาเลือกสินค้า ---</option>
                                                        <?php while ($row = mysqli_fetch_assoc($products)) {
                                                            echo "<option data-price='". $row['product_price'] ."' data-amount='". $row['product_amount'] ."' value='". $row['product_id'] ."'>". $row['product_name'] ."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group pull-in clearfix">
                                                <div class="col-sm-6">
                                                    <label>จำนวน</label>
                                                    <input type="text" name="amount[]" class="form-control rounded parsley-validated"
                                                        data-min="1" data-type="number" data-required="true" autocomplete="off">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>ราคาต่อหน่วย</label>
                                                    <input type="text" name="price[]" class="form-control rounded parsley-validated"
                                                        data-type="number" autocomplete="off" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <footer class="panel-footer text-right bg-light lter">
                                        <input type="hidden" class="total" name="total">
                                        <b style="margin-right: 30px;">มูลค่ารวม: <u class="total">-</u> บาท</b>
                                        <button type="submit" name="action" value="add" class="btn btn-success btn-s-xs">บันทึก</button>
                                        <a href="/stock/sale/list" class="btn bg-danger btn-s-xs">กลับ</a>
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
            var sum = 0;

            $(document).ready(function () {
                $("select[name*='product']").each(function (i) {
                    let price = $(this).children("option:selected").attr("data-price");
                    $("input[name*='price']")[i].value = price;
                    return true;
                });
                
                $('#product-list').delegate("input[name*='amount']", 'keyup', function () {
                    sum = 0;
                    $("input[name*='amount']").each(function (i) {
                        let amount = $(this).val();
                        let price = $("input[name*='price']")[i].value;

                        let productAmount = $("select[name*='product']").children("option:selected").attr("data-amount");
                        
                        if (parseInt(amount) > parseInt(productAmount)) {
                            alert("จำนวนสินค้าไม่พอขาย");
                            $(this).val(productAmount);
                        } else {
                            calcTotal(amount, price);   
                        }
                    });
                });

                $('#product-list').delegate("select[name*='product']", 'change', function () {
                    $("select[name*='product']").each(function (i) {
                        let price = $(this).children("option:selected").attr("data-price");
                        $("input[name*='price']")[i].value = price;
                        return true;
                    });
                });
            });

            function calcTotal(amount, price) {
                if($.trim(amount).lenght == 0 && $.trim(price).lenght == 0) return false;

                sum += amount * price;
                
                if (sum != 0) {
                    $('.total').html(sum)
                    $('.total').val(sum)
                } else {
                    $('.total').val(0)
                    $('.total').html("-")
                }
            }

            function addProductSection() {
                $("#product-list").append(
                    '<hr>' +
                    $('#product-row').html()
                );
            }
        </script>
</body>

</html>