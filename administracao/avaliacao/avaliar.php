<?php 
if (!isset($_COOKIE['admid'])) {
	header('../../?pg=2');
}
if (!isset($_REQUEST['id'])) {
	?>
	<script type="text/javascript">
		alert('Nenhum animal selecionado, por favor selecione um e volte');
		window.location.assign('../leiloes');
	</script>
	<?php
}
$id = $_REQUEST['id'];
?>
<form action="avaliar2.php">
	<input type="hidden" name="id" value="<?=$id?>">
	<table class="table">
		<tr>
			<td>
				Avaliador 1
				<br>
				<input type="number" name="av1" class="form-control"class="form-control"  required min="0" step="0.1">	
			</td>
			<td>
				Avaliador 2 
				<br>
				<input type="number" name="av2" class="form-control" required min="0" step="0.1">	
			</td>	
			<td>
				Avaliador 3 
				<br>
				<input type="number" name="av3" class="form-control" required min="0" step="0.1">
			</td>
			<td><br>
				<input type="submit" class="btn btn-primary">
			</td>
		</tr>
	</table>
</form>
