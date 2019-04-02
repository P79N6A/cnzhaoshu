<?php 

require 'db.php';

$userid = $_GET['userid'];

$db = new db();

$sql = 'select * from order_schedule where userid = ?';

$result = $db->prepare_query($sql , array($userid));

echo json_encode($result);