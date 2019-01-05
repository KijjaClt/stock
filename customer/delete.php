<?php
require_once '../db.php';

$db = new DB();
$db->connect();
$result = $db->query("DELETE FROM customer WHERE customer_id = ".$_GET["id"]."");
header("location: /stock/customer");
$db->close();

?>