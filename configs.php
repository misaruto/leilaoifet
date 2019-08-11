<?php 
$host = "localhost";
$user = "root";
$passw = "";
$db = "bd_leilao";
/*
$user = "id7019686_leilaoifet";
$passw = "leilao123";
$db = "id7019686_bd_leilao";
*/
$con = mysqli_connect($host, $user, $passw, $db);
mysqli_set_charset( $con, 'utf8');

$mysqli = new mysqli( $host, $user, $passw, $db);
?>