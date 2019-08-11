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
include '../../configs.php';

$query = "SELECT * FROM tbl_tarefas,tbl_tipos WHERE id_leilao = '$lid'  AND tbl_tarefas.id_tipo = tbl_tipos.id";
$result = mysqli_query($con, $query);
?>
<table class="table">
	<thead>
		<tr>
			<th colspan="8">
				<center>
					Progresso com as tarefas
				</center>
			</th>
		</tr>
		<tr>
			<th colspan="8">
				<div class="progress">
					<div class="progress-bar progress-bar-striped" id="progressbar" role="progressbar" style="width: 0%;" aria-valuemin="0" aria-valuemax="100">
						a
					</div>
				</div>
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
					Responsável
				</center>
			</th>
			<th>
				<center>
					Tipo
				</center>
			</th>
			<th>
				<center>
					Quantidade
				</center>
			</th>
			<th>
				<center>
					Data
				</center>
			</th>
			<th>
				<center>
					Status
				</center>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$cor="";
		$realizadas = 0;
		$texto = "";
		$total = mysqli_num_rows($result);
		while ($row = mysqli_fetch_object($result)) {
			$data = $row->dia."/".$row->mes."/".$row->ano;
			$dr = date('d/m/Y', strtotime($row->data_realizada));
			if ($row->status == 0) {
				$cor = "#ffd0cebd";
				$texto = "Não realizada";
			}
			else{
				$realizadas = $realizadas +1;
				$cor = "#0f0";
				$texto = "Realizada no dia:<br>".$dr;
			}
			?>
			<tr style="background-color: <?=$cor?>">
				<td>
					<center>
						<?=$row->id_tarefa_leilao?>
					</center>
				</td>
				<td>
					<center>
						<?=$row->nome?>
					</center>
				</td>
				<td>
					<center>
						<?=$row->responsavel?>
					</center>
				</td>
				<td>
					<center>
					<?=$row->tipo?>
					</center>
				</td>
				<td>
					<center>
						<?=$row->quantidade?>
					</center>
				</td>
				<td>
					<center>
						<?=$data?>
					</center>
				</td>
				<td>
					<center>
						<?=$texto?>
					</center>
				</td>
			</tr>
			<?php
		}
		$porcentagem = ($realizadas * 100)/ $total;
		?>
	</tbody>
</table>
<script type="text/javascript">
	var p = document.getElementById('progressbar');
	p.style="width:<?=$porcentagem?>%;";
	p.textContent = "<?=$porcentagem?>%"
</script>
