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

if (isset($_REQUEST['id'])) {
	include '../../configs.php';
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM `tbl_lotes` WHERE tbl_lotes.id_lote = '$id'";
	if (mysqli_query($con, $sql)) {
		$query = "DELETE FROM `tbl_item_lotes` WHERE tbl_item_lotes.id_lote = '$id'";
		if (mysqli_query($con, $query)) {
			?>
			<script type="text/javascript">
				alert('Lote apagado com suceso');
				window.location.assign('./?pg=0');
			</script>
			<?php
		}
		else{
			echo "erro ao apagar os itens do lote";
		}
	}
	else{
		echo "erro ao apagar lote";
	}
}
?>