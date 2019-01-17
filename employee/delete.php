<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/stock/db.php';

$db = new DB();
$db->connect();
$result = $db->query("DELETE FROM employee WHERE employee_id = ".$_GET["id"]."");
header("location: /stock/employee");
$db->close();

?>