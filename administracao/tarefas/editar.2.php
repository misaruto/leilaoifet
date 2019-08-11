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
if (!isset($_REQUEST['id'])) {
	?>
	<script type="text/javascript">
		alert('Nenhuma tarefa selecionada, por favor selecione uma e volte');
		window.location.assign('./?pg=2');
	</script>
	<?php
}
$id = $_REQUEST['id'];
include '../../configs.php';
$query = "SELECT * FROM tbl_tarefas,tbl_tipos WHERE id_tarefa = '$id' AND tbl_tarefas.id_tipo = tbl_tipos.id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_object($result);
?>
<form action="editar.3.php">
	<table class="table table-striped">
		<input type="hidden" name="id" value="<?=$id?>">
		<tr>
			<td>
				<label for="nome">
					Nome:
				</label>
			</td>
			<td>
				<input type="text" required name="nome" class="form-control" size="30" id="nome" placeholder="Nome da tarefa, o qual será mostrado no status" value="<?=$row->nome?>" >
			</td>
		</tr>
		<tr>
			<td>
				<label for="tipo">
					Tipo:
				</label>
			</td>
			<td>
				<select name="tipo" required>
					<?php 
					$query = "SELECT * FROM tbl_tipos WHERE para = 'Tarefas'";
					$result = mysqli_query($con, $query);
					while ($row_tipo = mysqli_fetch_object($result)) {
						if ($row_tipo->tipo == $row->tipo) {
							$s = 'selected';
						}
						else{
							$s = '';
						}

						?>
						<option <?=$s?> value="<?=$row_tipo->id?>"><?=$row_tipo->tipo?></option>
						<?php
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="qtd">
					Quantidade:
				</label>
			</td>
			<td>
				<input type="number" id="qtd" min="1" max="100" name="qtd" class="form-control" placeholder="Por exemplo, o total de animais que serão cadastrados." value="<?=$row->quantidade?>">
			</td>
		</tr>
		<tr>
			<td>
				Data:
			</td>
			<td>
				Dia:
				<select name="dia" required>
					<option selected disabled></option>
					<?php 
					for ($i=1; $i < 32; $i++) {
						if ($i == $row->dia) {
							$s = 'selected';
						}
						else{
							$s = '';
						}
						?>
						<option <?=$s?> value="<?=$i?>"><?=$i?></option>	
						<?php

					}
					?>
				</select>
				Mês:
				<select name="mes" required>
					<option selected disabled></option>
					<?php 
					for ($i=1; $i < 13; $i++) { 
						if ($i == $row->mes) {
							$s = 'selected';
						}
						else{
							$s = '';
						}
						?>
						<option <?=$s?> value="<?=$i?>"><?=$i?></option>	
						<?php
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="resp">
					Responsável:
				</label>
			</td>
			<td>
				<input required type="text" name="resp" class="form-control" size="25" id="resp"
				placeholder="Quem irá realizar a tarefa." value="<?=$row->responsavel?>">
			</td>
		</tr>
		<tr>
			<td>
				<label for="rea">
					Realizada?
				</label>
			</td>
			<td>
				<select name="rea" id="rea" onchange="seleciona()">
					<?php 
					if (1 == $row->status) {
						$s = 'selected';
					}
					else{
						$s = '';
					}
					?>
					<option value="0">Não</option>
					<option id="op1" <?=$s?> value="1">Sim</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="dr">
					Data-Realizada
				</label>
			</td>
			<td>
				<input type="date" name="dr" id='dr' value="<?=$row->data_realizada?>">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<center>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</center>	
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">
	window.onload = seleciona();

	function seleciona() {
		if (document.getElementById('op1').selected == true) {
			document.getElementById('dr').disabled = false;
		}
		else{
			document.getElementById('dr').disabled = true;
		}
	}
</script>