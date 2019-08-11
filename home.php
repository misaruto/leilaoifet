<?php 
include 'configs.php';
$ano = date('y') +2000;
$soma = 0;
$tarefa = 0;
$query = "SELECT * FROM tbl_tarefas, tbl_tipos,tbl_leiloes WHERE tbl_tarefas.id_leilao = tbl_leiloes.id AND tbl_tarefas.id_tipo = tbl_tipos.id AND tbl_leiloes.ano = '$ano'";
$sql = mysqli_query($con, $query);
if (!empty($sql)) {
	while ($row = mysqli_fetch_object($sql)) {

		$soma = $soma + $row->status;
		if (($row->ano == $ano)) {
			$tarefa = $tarefa + 1;
		}
	}
	if ($tarefa != 0) {
		$pctg = ($soma * 100)/$tarefa;
		$pctg = number_format($pctg,'2');
	}
	else{
		$pctg = 0;
	}
}
else {
	$pctg = 0;
	echo "<p class=text-primary>Nenhuma tarefa pendente/realizada</p>";
}
?>
<div  class="alert alert-dark" role="alert">
	<font color="black">Progresso</font>
	<div class="progress">
		<div class="progress-bar  progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?=$pctg?>%;color: #000;" aria-valuenow="<?=$pctg?>" aria-valuemin="0" aria-valuemax="100"><?=$pctg?>%</div>
	</div>
</div>
<table class="table table-light table-striped table-bordered">
	<thead class="thead-dark">
		<tr>
			<td colspan="6">
				<center>
					Lista de Tarefas
				</center>
			</td>
		</tr>
		<tr>
			<td>
				Nome
			</td>
			<td>
				Responsável
			</td>
			<td>
				Tipo
			</td>
			<td>
				Data
			</td>
			<td>
				Status
			</td>
			<td>
				Data-cumprida
			</td>
		</tr>
	</thead>
	<?php 
	$sql = mysqli_query($con,$query);
	while ($row = mysqli_fetch_object($sql)) {
		?>
		<tr>
			<td>
				<?=$row->nome?>
			</td>

			<td>
				<?=$row->responsavel?>
			</td>

			<td>
				<?=$row->tipo?>
			</td>

			<td>
				<?=$row->dia?>/<?=$row->mes?>
			</td>
			<td>
				<?php 
				if ($row->status ==1) {
					echo "Realizada";
				}
				else{
					echo "Pendente";
				}
				?>
			</td>

			<td>
				<?=$row->data_realizada?>
			</td>
		</tr>
		<?php
	}
	?>
</table>
<br><br>