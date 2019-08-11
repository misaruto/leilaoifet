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
?>
<table class="table table-hover">
	<thead class="thead-dark">
		<th>
			N°
		</th>
		<th>
			Nome
		</th>
		<th>
			CPF
		</th>
		<th>
			RG
		</th>
	</thead>
	<?php 
	include '../../configs.php';

	$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 0; 

	$cmd = "SELECT * FROM tbl_compradores WHERE id_leilao = '$lid' "; 

	$produtos = mysqli_query($con,$cmd); 

	$total = mysqli_num_rows($produtos); 

	$registros = 20; 

	$numPaginas = ceil($total/$registros); 

	$inicio = ($registros*$pagina)-$registros; 
	$inicio = 0;


	$query = "SELECT * FROM tbl_compradores WHERE id_leilao = '$lid' LIMIT ".$inicio.", ".$registros."";
	$sql = mysqli_query($con, $query);
	while ($row = mysqli_fetch_object($sql)) {
		?>
		<tr style="cursor: pointer;" onclick="seleciona(<?=$row->id_comprador?>)">
			<td>
				<?=$row->id_comprador_leilao?>
			</td>
			<td>
				<?=$row->nome_comprador?>
			</td>
			<td>
				<?=$row->cpf?>
			</td>
			<td>
				<?=$row->rg?>
			</td>
		</tr>
		<?php
	}
	?>
</table>
<div style="width: 100%;">

	<center>
		<?php 
		for($i = 1; $i < $numPaginas + 1; $i++) { 
			?>
			<a href="./?pg=0&pagina=<?=$i?>"><?=$i?></a>
			<?php
		}
		?>
	</center>

</div>
<script type="text/javascript">
	function seleciona(id) {
		var id = id;
		window.location.assign('./?pg=3&id='+id);
	}
</script>