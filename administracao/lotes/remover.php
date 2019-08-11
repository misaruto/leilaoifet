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
include '../../configs.php';

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



if ((isset($_REQUEST['id']))&&(isset($_REQUEST['lote']))) {
	include '../../configs.php';
	$id = $_REQUEST['id'];
	$l = $_REQUEST['lote'];
	$sql = "DELETE FROM `tbl_item_lotes` WHERE `id_animal` = '$id' AND `id_lote` = '$l'";
	if (mysqli_query($con, $sql)) {
		header('location:./?pg=4&id='.$l);
	}	
}

?>	