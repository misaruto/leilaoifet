<?php
if (!isset($_COOKIE['admid'])) {
	header('location:./././?pg=2');
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
?>
<table class="table table-hover">
	<thead class="thead-dark">
		<tr>
			<th colspan="4">
				<center>
					Selecione o Comprador para produzir o comprovante.
				</center>
			</th>
		</tr>
		<tr>
			<th>
				<center>
					N°
				</center>
			</th>
			<th>
				<center>
					Nome
				</center>
			</th>
			<th>
				<center>
					CPF
				</center>
			</th>
			<th>
				<center>
					RG
				</center>
			</th>
		</tr>
	</thead>
	<?php 
	include '../../configs.php';
	$a = date('y');
	$query = "SELECT * FROM tbl_compradores WHERE id_leilao = '$lid'";
	$sql = mysqli_query($con, $query);
	while ($row = mysqli_fetch_object($sql)) {?>
		<tr style="cursor: pointer;" onclick="seleciona(<?=$row->id_comprador?>)" >
			<td>
				<center>
					<?=$row->id_comprador_leilao?>
				</center>
			</td>
			<td>
				<center>
					<?=$row->nome_comprador?>
				</center>
			</td>
			<td>
				<center>
					<?=$row->cpf?>
				</center>
			</td>
			<td>
				<center>
					<?=$row->rg?>
				</center>
			</td>
		</tr>
		<?php
	}
	?>
</table>
</center>

<script type="text/javascript">
	function seleciona(id) {
		window.location.assign('gerar.pdfs.php?id='+id);
	}
</script>
