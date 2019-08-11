<?php 
if (!isset($_COOKIE['compid'])) {
	header('location:../?pg=2');
}
include '../configs.php'; 
$id = $_COOKIE['compid'];
$query = "SELECT id_comprador FROM tbl_compradores WHERE id_comprador = '$id'";
$sql = mysqli_query($con, $query);
$row = mysqli_fetch_object($sql);
if (!empty($row->imagem)) {
	unlink("./imagens/".$row->id_comprador);
}
if (isset($_FILES['foto'])) {
	$foto = $_FILES['foto'];
	$dir = "./imagens/";
	if (move_uploaded_file($foto['tmp_name'], $dir.$id.".jpg")) {
	header('location:./');
	}
	else{
		echo "Erro no up da imagem";
	}
}
?>