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
if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
	setcookie('compid',$id);
	header('location:./?pg=1');
}
else{
	?>
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
				<th colspan="7">
					<center>
						Selecione um comprador.
					</center>
				</th>
			</tr>
			<tr>
				<th>
					N°
				</th>
				<th>
					<center>
						Nome
					</center>
				</th>
				<th>
					<center>
						Nascimeto
					</center>
				</th>
				<th>
					<center>
						CPF
					</center>
				</th>
				<th>
					<center>
						RG
					</center>
				</th>
			</tr>
		</thead>
		<?php 
		include '../../configs.php';
		$a = date('y');		
		$query = "SELECT * FROM tbl_compradores WHERE id_leilao = '$lid'";
		$sql  = mysqli_query($con, $query);
		while ($row = mysqli_fetch_object($sql)) {
			$number = $row->telefone;
			$number="(".substr($number,0,2).") ".substr($number,2,-4)." - ".substr($number,-4);
			?>
			<tr style="cursor: pointer;" onclick="selciona(<?=$row->id_comprador?>)">
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
			</tr>
			<?php
		}
		?>
	</table>
	<script type="text/javascript">
		function selciona(id_comprador) {
			id = id_comprador;
			window.location.assign('./compradores.php?id='+id);
		}
	</script>
	<?php
}
?>