<?php 
require 'checkhost2.php';
require 'db3.php';
$db = new db();

$user = json_decode($_COOKIE['user'],true);

if(($user['role'] == 6) || ($user['role'] == 8)){

	$userid = $user['userid'];

	$sql = 'select id from adopt_project where userid=?';
	$projectid = $db->prepare_query($sql,array($userid))[0]['id'];

	$sql = 'select * from adopt_treeprice where project_id=?';
	$treeprice = $db->prepare_query($sql,array($projectid));

	echo json_encode($treeprice);
	unset($db);
}