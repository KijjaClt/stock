<?php
require_once __DIR__.'db.php';

$db = new DB();
$db->connect();
$result = $db->query("DELETE FROM customer WHERE customer_id = ".$_GET["id"]."");
header("location: /stock/customer");
$db->close();

?>