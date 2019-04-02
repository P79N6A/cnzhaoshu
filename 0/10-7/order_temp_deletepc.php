<?php 
require 'checkhost.php';
require 'db2.php';

$id = $_GET['id'];
$userid = $_GET['userid'];	
!$userid && exit;

$db = new db();
if (isset($id)) {
	$sql = 'delete from tree_order_temp where id=? and userid=?';
	$db->prepare_exec( $sql, array( $id , $userid ) );
	
}else{
	$order = $_GET['order'];
	if($order == '-1'){
		$sql = 'delete from tree_order_temp where userid=?';
		$db->prepare_exec( $sql, array( $userid ) );
		
	}
}
unset($db);

?>