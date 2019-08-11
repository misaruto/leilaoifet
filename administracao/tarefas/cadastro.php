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
?>
<form action="cadastro.2.php">
	<table class="table table-striped">
		<tr>
			<td>
				<label for="nome">
					Nome:
				</label>
			</td>
			<td>
				<input type="text" required name="nome" class="form-control" size="30" id="nome" placeholder="Nome da tarefa, o qual será mostrado no status">
			</td>
		</tr>
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
					?>
					<option value="<?=$row_tipo->id?>"><?=$row_tipo->tipo?></option>
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
				<input type="number" id="qtd" min="1" max="100" name="qtd" class="form-control" placeholder="Por exemplo, o total de animais que serão cadastrados.">
			</td>
		</tr>
		<tr>
			<td>
				Data-Limite:
			</td>
			<td>
				Dia:
				<select name="dia" required>
					<option selected disabled></option>
					<?php 
					for ($i=1; $i < 32; $i++) { ?>
						<option value="<?=$i?>"><?=$i?></option>	
						<?php

					}
					?>
				</select>
				Mês:
				<select name="mes" required>
					<option selected disabled></option>
					<?php 
					for ($i=1; $i < 13; $i++) { ?>
						<option value="<?=$i?>"><?=$i?></option>	
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
				<input type="text" name="resp" class="form-control" size="25" id="resp"
				placeholder="Quem irá realizar a tarefa.">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<center>
					<button type="submit" class="btn btn-primary">Cadastrar	</button>
				</center>
			</td>
		</tr>
	</table>
</form>