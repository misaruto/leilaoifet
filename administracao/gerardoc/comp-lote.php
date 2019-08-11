<?php 
 if (!isset($_COOKIE['admid'])) {
	header('location:./././?pg=2');
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

include '../../configs.php';
$query = "
SELECT id_comprador_leilao, id, nome_comprador ,`tbl_comprador-lote`.id_lote, id_lote_leilao FROM `tbl_comprador-lote`,tbl_compradores,tbl_lotes WHERE `tbl_comprador-lote`.id_lote = `tbl_lotes`.id_lote AND `tbl_comprador-lote`.`id_comprador` = `tbl_compradores`.id_comprador AND `tbl_comprador-lote`.`id_leilao` = '$lid' ";
$sql = mysqli_query($con, $query);
 
 ?>
 <table class="table table-hover">
 	<thead>
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
 				N° lote
 			</center>
 		</th>
 	</thead>
 	<?php 

 	while ($row = mysqli_fetch_object($sql)) {
 	?>
 	<tr style="cursor: pointer;" onclick="seleciona(<?=$row->id?>)">
 		<td>
 			<center>
 				<?=$row->id_comprador_leilao?>
 			</center>
 		</td>
 		<td>
 			<center>
 				<?=$row->nome_comprador?>
 			</center>
 		</td>
 		<td>
 			<center>
 				<?=$row->id_lote_leilao?>
 				<br>
 				<a href="../lotes/?pg=4&id=<?=$row->id_lote?>">Ver</a>
 			</center>
 		</td>
 	</tr>
 	<?php
 	}
 	 ?>
 </table>
 <script type="text/javascript">
 	function seleciona(id) {
 		var id = id;
 		window.location.assign('compromisso.php?id='+id);
 	}
 </script>