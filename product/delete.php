<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/stock/db.php';

$db = new DB();
$db->connect();
$result = $db->query("
                    DELETE FROM product 
                    WHERE product_id = ".$_GET["id"]."
                    ");
header("location: /stock/product");
$db->close();

?>