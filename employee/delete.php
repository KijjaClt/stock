<?php
require_once '../db.php';

$db = new DB();
$db->connect();
$result = $db->query("DELETE FROM employee WHERE employee_id = ".$_GET["id"]."");
header("location: /stock/employee");
$db->close();

?>