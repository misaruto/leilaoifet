<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}

if (!isset($_COOKIE['leilaoid'])) {
	?>
	<script type="text/javascript">
		alert('Nenhum leilão selecionado, por favor selecione um e volte');
		window.location.assign('../leiloes');
	</script>
	<?php
}
else{
	$lid = $_COOKIE['leilaoid'];
}

//verifica se o leilão já foi finalizado.
$q = "SELECT finalizado FROM tbl_leiloes WHERE id = '$lid'";
$r = mysqli_query($con, $q);
$f = mysqli_fetch_object($r);
if ($f->finalizado == 1) {
	?>
	<script type="text/javascript">
		alert('leilão finalizado. Não é possivel modificar os lotes.');
		window.location.assign('./');
	</script>
	<?php
}

//Id_lote é o id do lote do leilão e nao o id do sistena.
if ((isset($_REQUEST['id_lote']))&&(isset($_REQUEST['n']))) {
	$a = date('y');
	$n = $_REQUEST['n'];
	include '../../configs.php';
	$id = $_REQUEST['id_lote'];
	$sql = "INSERT INTO `tbl_lotes`(`id_leilao`,`id_lote_leilao`, `nome`, `ano`,`desmembrado`) VALUES ('$lid','$id','$n','$a','0')";
	if (mysqli_query($con, $sql)) {
		setcookie('id_lote',$id);
		header('location:./?pg=2');
	}
}
if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id']; 
	setcookie('id_lote',$id);
	header('location:./?pg=2');
}
else{
	header('location:./?pg=0');
}
?>