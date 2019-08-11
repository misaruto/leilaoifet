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



include '../../configs.php'; 
if (!isset($_COOKIE['id_lote'])) {
	$a = date('y');
	$query = "SELECT * FROM tbl_lotes WHERE ano = '$a'";
	$sql = mysqli_query($con, $query);
}
else{
	header('location:./?pg=2');
}
?>
<table class="table">
	<tr>
		<td>
			#
		</td>
		<td>
			Editar
		</td>
	</tr>
	<?php

	while ($row = mysqli_fetch_object($sql)) {
		?>
		<tr>
			<td>
				<?=$row->id_lote_ano?>
			</td>
			<td>
				<a  class="text-primary" href="cria.lotes.php?id=<?=$row->id_lote?>">
					Editar
				</a>
			</td>
		</tr>
		<?php
	}
	?>
</table>