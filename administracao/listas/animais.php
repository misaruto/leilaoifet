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

//faz a paginação das listas
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 0; 

$cmd = "SELECT * FROM tbl_animais WHERE id_leilao = '$lid'"; 

$produtos = mysqli_query($con,$cmd); 

$total = mysqli_num_rows($produtos); 

$registros = 20; 

$numPaginas = ceil($total/$registros); 

$inicio = ($registros*$pagina)-$registros; 
if ($pagina == 0) {
	$inicio = 0;
}

?>
<table class="table table-light table-striped table-bordered">
	<thead>
		<tr>
			<td>
				N°
			</td>
			<td>
				Nome
			</td>
			<td>
				Brinco
			</td>
			<td>
				Peso
			</td>
			<td>
				Data de Nascimento
			</td>
			<td>
				Raça
			</td>
		</tr>
	</thead>
	<?php 
	$a = date('y');
	$query = "SELECT * FROM tbl_animais WHERE id_leilao = '$lid'  LIMIT ".$inicio.", ".$registros."";
	$sql  = mysqli_query($con, $query);
	while ($row = mysqli_fetch_object($sql)) {
		?>
		<tr>
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
				<?=$row->peso?> Kg
			</td>
			<td>
				<?=$row->nascimento?>
			</td>
			<td>
				<?=$row->raca?>
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
			<a href="./?pg=1&pagina=<?=$i?>"><?=$i?></a>
			<?php
		}
		?>
	</center>

</div>