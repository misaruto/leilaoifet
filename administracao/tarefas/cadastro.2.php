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
if ((isset($_REQUEST['nome']))&&(isset($_REQUEST['tipo']))&&(isset($_REQUEST['dia']))&&(isset($_REQUEST['mes']))&&(isset($_REQUEST['resp']))&&(isset($_REQUEST['qtd']))) {
	$n = $_REQUEST['nome'];
	$t = $_REQUEST['tipo'];
	$d = $_REQUEST['dia'];
	$m = $_REQUEST['mes'];
	$q = $_REQUEST['qtd'];
	$resp = $_REQUEST['resp'];
	if (($n != "")&&($t != "")&&($d != "")&&($m != "")&&($resp != "")) {
		$query = "SELECT MAX(id_tarefa_leilao) FROM tbl_tarefas WHERE id_leilao = '$lid'";
		$res = mysqli_query($con, $query);
		$r = mysqli_fetch_array($res);
		if (empty($r)) {
			$id = 1;
		}
		else{
			$id = $r[0] + 1;
		}
		$a = date('y');
		$query = "INSERT INTO `tbl_tarefas`(`id_leilao`, `id_tipo`, `id_tarefa_leilao`, `nome`, `responsavel`, `quantidade`, `dia`, `mes`, `status`, `data_realizada`, `ano`) VALUES ('$lid','$t','$id','$n','$resp','$q','$d','$m','0','','$a')";
		$result = $mysqli->prepare($query);
		if ($result->execute()) {
			?>
			<script type="text/javascript">
				alert('Tarefa adcionada com sucesso');
				window.location.assign('./?pg=1');
			</script>
			<?php
		}
		else{
			?>
			<script type="text/javascript">
				alert('Erro ao adcionar tarefa. Tente novamente. 1');
				window.location.assign('./?pg=1');
			</script>
			<?php
		}

	} 
	else{
		?>
		<script type="text/javascript">
			alert('Alguns dos campos importantes não foram preenchidos');
			window.location.assign('./?pg=1');
		</script>
		<?php
	}
}
else{
	?>
	<script type="text/javascript">
		alert('Está faltando valores');
		window.location.assign('./?pg=1');
	</script>
	<?php
}
?>