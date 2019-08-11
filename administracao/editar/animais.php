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
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table class="table table-hover">
		<thead class="thead-dark">
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
					Brinco
				</center>
			</th>
			<th>
				<center>
					Raça
				</center>
			</th>
			<th>
				<center>
					Data de <br>
					nascimento
				</center>
			</th>
		</thead>
		<?php
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

		$query = "SELECT * FROM tbl_animais  WHERE id_leilao = '$lid' LIMIT ".$inicio.", ".$registros."";

		$produtos = mysqli_query($con,$query); 	
		
		$total = mysqli_num_rows($produtos);
		
		$sql = mysqli_query($con, $query);
		
		while ($row = mysqli_fetch_object($sql)) {
			?>
			
			<tr  style="cursor: pointer;" onclick="seleciona(<?=$row->id_animal?>)">
				<td>
					<center>
						<?=$row->id_animal_leilao?>
					</center>
				</td>
				<td>
					<center>
						<?=$row->nome_animal?>
					</center>
				</td>
				<td>
					<center>
						<?=$row->brinco?>
					</center>
				</td>
				<td>
					<center>
						<?=$row->raca?>
					</center>
				</td>
				<td>
					<center>
						<?=$row->nascimento?>
					</center>
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
			window.location.assign('./?pg=2&id='+id);
		}
	</script>
</body>
</html>