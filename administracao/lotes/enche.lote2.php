<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
	setcookie('ida_'.$id,$id);
	header('location:./?pg=2');
	
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

//alterar o nome do lote,
if (isset($_REQUEST['n'])&&isset($_REQUEST['id_lote'])) {
	$n = $_REQUEST['n'];
	$id = $_REQUEST['id_lote'];
	$query = "UPDATE `tbl_lotes` SET `nome`= '$n' WHERE id_lote = '$id'";
	$sql = $mysqli->prepare($query);
	if ($sql->execute()) {
		?>
		<script type="text/javascript">
			alert('Nome do lote alterado com sucesso');
			window.location.assign('./?pg=4&id=<?=$id?>');
		</script>
		<?php
	}
}

?>