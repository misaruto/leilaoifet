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

if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
}
else{
	header('location:./?pg=0');
}
include '../../configs.php';
$query = "SELECT * FROM tbl_animais WHERE id_animal = '$id'";
$sql = mysqli_query($con, $query);
$row = mysqli_fetch_object($sql);

?>

<form action="edit.animal2.php">
	<table class="table">
		<tr>
			<td>
				<label for="nome">Nome:</label>
			</td>
			<td>
				<input autofocus type="text" name="nome" class="form-control" id="nome"
				value="<?=$row->nome_animal?>">
				<input type="hidden" name="id" value="<?=$row->id_animal?>">
			</td>
		</tr>
		<tr>
			<td>
				<label for="brinco">Brinco:</label>
			</td>
			<td>
				<input type="text" name="brinco" class="form-control" id="brinco"
				value="<?=$row->brinco?>">
			</td>
		</tr>
		<tr>
			<td>
				<label for="peso">Peso KG:</label>
			</td>
			<td>
				<input type="number" name="peso" min="1" max="500" class="form-control" id="peso" step="0.1" value="<?=$row->peso?>">
			</td>
		</tr>
		<tr>
			<td>
				<label for="datap">Data Pesagem:</label>
			</td>
			<td>
				<input type="date" name="datap" id="datap" value="<?=$row->data_pesagem?>">
			</td>
		</tr>
		<tr>
			<td>
				<label for="datan">Data Nascimento:</label>
			</td>
			<td>
				<input type="date" name="datan" id="datan" value="<?=$row->nascimento?>">
			</td>
		</tr>
		<tr>
			<td>
				<label for="raca">Raça:</label>
			</td>
			<td>
				<input type="text" name="raca" class="form-control" id="raca" value="<?=$row->raca?>">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label for="desc">Descrição</label> <br>
			</td>
		</tr>
		<tr>
			<td colspan="2"> 
				<textarea cols="50" rows="4" name="desc"  id="desc" dir="ltr"><?=$row->descricao?>
			</textarea>
		</td>
	</tr>
	<tfoot>
		<td colspan="2">
			<center>
				<button type="submit" class="btn btn-primary">Editar</button>
			</center>
		</td>
	</tfoot>
</table>
</form>
