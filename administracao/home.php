<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
if (!isset($_COOKIE['leilaoid'])) {
	$lid = "";
	$t =0;
}
else{
	$lid = $_COOKIE['leilaoid'];
	$t = 1;
}
include '../configs.php';

//verifica se o leilão já foi finalizado.
$q = "SELECT finalizado,data_finalizado		 FROM tbl_leiloes WHERE id = '$lid'";
$r = mysqli_query($con, $q);
$f = mysqli_fetch_object($r);

$ano = date('y')+2000;
$soma = 0;
$tarefa = 0;
$pctg = 0; 
$query = "SELECT * FROM tbl_tarefas,tbl_tipos WHERE id_leilao = '$lid' AND tbl_tarefas.id_tipo = tbl_tipos.id";
$sql = mysqli_query($con, $query);
if (!empty($sql)) {
	while ($row = mysqli_fetch_object($sql)) {
		$soma = $soma + $row->status;
		if (($row->ano = $ano)) {
			$tarefa = $tarefa + 1;
		}
		$pctg = ($soma * 100)/$tarefa;
		$pctg = number_format($pctg,'2');
	}
}
else {
	$pctg = 0;
	?>
	<center>
		<div class='alert alert-warning' role='alert'>
			Nenhuma tarefa pendente, <a href='./tarefas' class='alert-link'>Clique Aqui</a>
			para adcionar novas tarefas.
		</div>
		<?php
	}
	if ($t == 1) {
		
		?>
		<div class="alert alert-dark" role="alert">
			<center>
				<?php 	
				if ($f->finalizado == 1) {
					$pctg = 100;
					?>
					Leilão Finalizado
					<br>
					<?php
				}
				else{
					echo "Progresso";
				}
			?>

		</center>
		<div class="progress">
			<div class="progress-bar" role="progressbar" style="width: <?=$pctg?>%; color: #000;" aria-valuenow="<?=$pctg?>" aria-valuemin="0" aria-valuemax="100"><?=$pctg?>%</div>
		</div>
	</div>
	<table class="table table-striped table-light">
		<thead class="thead-dark">
			<tr>
				<th colspan="6">
					<center>
						Lista de Tarefas
					</center>
				</th>
			</tr>
			<tr>
				<th>
					Nome
				</th>
				<th>
					Responsável
				</th>
				<th>
					Tipo
				</th>
				<th>
					Data
				</th>
				<th>
					Status
				</th>
				<th>
					Data-cumprida
				</th>
			</tr>
		</thead>
		<?php 
		$sql = mysqli_query($con,$query);
		while ($row = mysqli_fetch_object($sql)) {
			$dr = date('d/m/Y', strtotime($row->data_realizada));
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
						$dr="";
					}
					?>
				</td>

				<td>
					<?=$dr?>
				</td>
			</tr>
			<?php
		}
	}
	else{
		?>
		<center>
			<div class="alert alert-warning">
				Nenhum leilão selecionado
			</div>
		</center>
		<?php
	}
	?>
</table>
<table class="table table-striped table-light">
	<thead class="thead-dark">
		<tr>
			<th colspan="2">
				<center>
					FeedBacks
				</center>
			</th>
		</tr>
		<tr>
			<th>
				<center>
					Nome
				</center>
			</th>
			<th>
				<center>
					Mensagem
				</center>
			</th>
		</tr>
	</thead>
	<?php
	$sql = "SELECT * FROM tbl_feedback";
	$query = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_object($query)) {
		?>
		<tr>
			<td>
				<center>
					<?=$row->nome?>
				</center>
			</td>
			<td>
				<center>
					<?=$row->msg?>
				</center>
			</td>
		</tr>
		<?php
	}
	?>
</table>
<table class="table table-hover table-light">
	<thead class="thead-dark">
		<tr>
			<th  colspan="5">
				<center>
					Possíveis administradores
				</center>
			</th>
		</tr>
		<tr>
			<th>
				<CENTER>
					Nome
				</CENTER>
			</th>
			<th>
				<center>
					Nome
				</center>
			</th>
			<th>
				<center>
					E-mail
				</center>
			</th>
			<th>
				<center>
					E-mail Confirmado
				</center>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php 

		$query="SELECT * FROM tbl_administradores WHERE autorizado = 0 ";
		$result = mysqli_query($con,$query);
		while ($row = mysqli_fetch_object($result)) {
			if ($row->confirmado == 1) {
				$c = 'SIM';
				$d = '';
			}
			else{
				$c = 'NÃO';
				$d = 'disabled';
			}
			?>
			<div alt="CLique para ver a requisição">
				<tr style="cursor: pointer;" onclick="seleciona(<?=$row->id_adm?>)">
					<td>
						<center>
							<?=$row->nome_adm?>
						</center>
					</td>
					<td>
						<center>
							<?=$row->cpf?>
						</center>
					</td>
					<td>
						<center>
							<?=$row->email?>
						</center>
					</td>
					<td>
						<center>
							<?=$c?>
						</center>
					</td>

				</tr>
			</div>
			<?php
		}

		?>
	</tbody>
</table>
<br>
<br>
<br>
<script type="text/javascript">
	function seleciona(id) {
		var id = id;
		window.location.assign('./?pg=1&id='+id);
	}
</script>