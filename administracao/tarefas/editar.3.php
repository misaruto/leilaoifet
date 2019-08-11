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
if ((isset($_REQUEST['nome']))&&(isset($_REQUEST['tipo']))&&(isset($_REQUEST['dia']))&&(isset($_REQUEST['mes']))&&(isset($_REQUEST['resp']))&&(isset($_REQUEST['qtd']))&&(isset($_REQUEST['rea']))&&(isset($_REQUEST['id']))) {

	$id = $_REQUEST['id'];
	$n = $_REQUEST['nome'];
	$t = $_REQUEST['tipo'];
	$d = $_REQUEST['dia'];
	$m = $_REQUEST['mes'];
	$q = $_REQUEST['qtd'];
	$rea = $_REQUEST['rea'];
	$resp = $_REQUEST['resp'];
	
	
	if ($rea == 1) {
		$dr = $_REQUEST['dr'];
	}
	else{
		$dr = "";
	}

	if (($n != "")&&($t != "")&&($d != "")&&($m != "")&&($resp != "")) {

		$query = "UPDATE `tbl_tarefas` SET `id_tipo`='$t',`nome`='$n',`responsavel`='$resp',`quantidade`='$q',`dia`='$d',`mes`='$m',`status`='$rea',`data_realizada`='$dr' WHERE id_tarefa = '$id'";
		$result = $mysqli->prepare($query);
		if ($result->execute()) {
			?>
			<script type="text/javascript">
				alert('Tarefa editada com sucesso');
				window.location.assign('./?pg=2');
			</script>
			<?php
		}
		else{
			?>
			<script type="text/javascript">
				alert('Erro ao editar tarefa. Tente novamente.');
				window.location.assign('./?pg=4&id=<?=$id?>');
			</script>
			<?php
		}
		echo "string";

	} 
	else{
		?>
		<script type="text/javascript">
			alert('Alguns dos campos importantes não foram preenchidos');
			window.location.assign('./?pg=4&id=<?=$id?>');
		</script>
		<?php
	}
}
else{
	?>
	<script type="text/javascript">
		alert('Está faltando valores');
		window.location.assign('./?pg=2');
	</script>
	<?php
}
?>