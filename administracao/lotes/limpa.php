<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
	setcookie($id,'');
	header('location:./?pg=2');
}

 ?>