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
<table class="table table-light table-striped table-bordered">
	<tr>
		<td>
			N°
		</td>
		<td>
			Nome
		</td>
		<td>
			Nascimeto
		</td>
		<td>
			CPF
		</td>
		<td>
			RG
		</td>
		<td>
			Telefone
		</td>
		<td>
			Estado
		</td>
		<td>
			Cidade
		</td>
		<td>
			Endereço
		</td>
	</tr>
	<?php 
	include '../../configs.php';
	$a = date('y');
	if (isset($_REQUEST['id'])) {
		$id = $_REQUEST['id'];
		$query = "SELECT * FROM tbl_compradores WHERE id_comprador = '$id' and id_leilao = '$lid'";
		$lnk = "
		<center>
		<div class='alert alert-info' role=alert>
		Para ver os outros compradores
		<a href=./?pg=0 class=alert-link>clique aqui</a>
		</div>
		</center>";
	}
	else{
		$query = "SELECT * FROM tbl_compradores WHERE id_leilao = '$lid'";
		$lnk="";
	}
	$sql  = mysqli_query($con, $query);
	while ($row = mysqli_fetch_object($sql)) {
		$number = $row->telefone;
		$number="(".substr($number,0,2).") ".substr($number,2,-4)." - ".substr($number,-4);
		?>
		<tr>
			<td>
				<?=$row->id_comprador_leilao?>
			</td>
			<td>
				<?=$row->nome_comprador?>
			</td>
			<td width="114">
				<?=$row->nascimento?>
			</td>
			<td>
				<?=$row->cpf?>
			</td>
			<td>
				<?=$row->rg?>
			</td>
			<td>
				<?=$number?>
			</td>
			<td>
				<?=$row->estado?>
			</td>
			<td>
				<?=$row->cidade?>
			</td>
			<td>
				<?=$row->endereco?>
			</td>
		</tr>
		<?php
	}
	?></table>