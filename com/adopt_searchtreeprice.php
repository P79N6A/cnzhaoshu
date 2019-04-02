<?php 

require 'db.php';
$db = new db();

$projectid = $_GET['projectid'];
$sql = 'select * from adopt_treeprice where project_id=?';
$treeprice = $db->prepare_query($sql,array($projectid));

echo json_encode($treeprice);
unset($db);