<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
if (isset($_REQUEST['id'])) {
	setcookie('compid',$_REQUEST['id']);
	header('location:./?pg=0');
}
 ?>
