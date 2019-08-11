<?php 
if (!isset($_COOKIE['admid'])) {
	header('../../?pg=2');
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
if ((isset($_REQUEST['av1']))&&(isset($_REQUEST['av2']))&&(isset($_REQUEST['av3']))&&(isset($_REQUEST['id']))) {
	include '../../configs.php';
	$ida = $_REQUEST['id'];
	$av1 = $_REQUEST['av1'];
	$av2 = $_REQUEST['av2'];
	$av3 = $_REQUEST['av3'];
	$a = date('y');
	$q = "SELECT MAX(id_avaliacao_leilao) FROM tbl_avaliacoes WHERE tbl_avaliacoes.id_leilao = '$lid'";
	$res = mysqli_query($con, $q);
	$res = mysqli_fetch_array($res);
	if (empty($res)) {
		$id = 1;
	}
	else{
		$id = $res['MAX(id_avaliacao_leilao)'] + 1;
	}

	if (($av1 != "")&&($av2 != "")&&($av3 != "")) {
		$media = ($av1 + $av2 +$av3)/3;
		$m = $media/25;
		$m = ceil($m);
		$m = $m * 25;
		$query = "INSERT INTO `tbl_avaliacoes`(`id_leilao`,`id_avaliacao_leilao`, `id_animal`, `avaliacao1`, `avaliacao2`, `avaliacao3`, `media_avaliacao`, `avaliacao_corrigida`, `ano`) VALUES('$lid','$id','$ida','$av1','$av2','$av3','$media','$m','$a')";
		if (mysqli_query($con,$query)) {
			$query = "UPDATE tbl_animais SET avaliado = '1' WHERE id_animal = '$ida'";
			if (mysqli_query($con,$query)) {
				?>
				<script type="text/javascript">
					alert('Valores salvos com suceso');
					window.location.assign('./?pg=0');
				</script>
				<?php
			}
			else{
				?>
				<script type="text/javascript">
					alert('Erro ao atualizar o status do animal');
					window.location.assign('./?pg=1&id='+<?=$ida?>);
				</script>
				<?php
			}
		}
		else{
			?>
			<script type="text/javascript">
				alert('Erro ao salvar os valores do o animal');
				window.location.assign('./?pg=1&id='+<?=$ida?>);
			</script>
			<?php
		}

	}
	else{
		?>
		<script type="text/javascript">
			alert('Valores para o animal nao podem ser vazios');
			window.location.assign('../?pg=1&id='+<?=$ida?>);
		</script>
		<?php
	}
}
else{
	?>
	<script type="text/javascript">
		alert('Alguns dos valores não foram enviados.');
		window.location.assign('./?pg=1&id='+<?=$ida?>);
	</script>
	<?php
}
?>