<?php 
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
?>
<table class="table table-hover">
	<thead class="thead-dark">
		<tr>
			<th>
				N°
			</th>
			<th>
				Nome
			</th>
			<th>
				Brinco
			</th>
			<th>
				Peso
			</th>
			<th>
				Raça
			</th>
		</tr>
	</thead>
	<?php 
	include '../../configs.php';
	$a = date('y');
	$query = "SELECT * FROM tbl_animais WHERE avaliado = '0' AND id_leilao = '$lid'";
	$sql = mysqli_query($con, $query);
	while ($row = mysqli_fetch_object($sql)) {
		?>
		<tr style="cursor: pointer;" onclick="seleciona(<?=$row->id_animal?>)">
			<td>
				<?=$row->id_animal_leilao?>
			</td>
			<td>
				<?=$row->nome_animal?>
			</td>
			<td>
				<?=$row->brinco?>
			</td>
			<td>
				<?=$row->peso?>
			</td>
			<td>
				<?=$row->raca?>
			</td>
		</tr>
		<?php
	}
	?>
</table>
<script type="text/javascript">
	function seleciona(id) {
		window.location.assign('./?pg=1&id='+id);
	}
</script>