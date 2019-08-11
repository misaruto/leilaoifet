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
include '../../configs.php';

$query = "SELECT `id_tarefa`,`id_tipo`, `id_tarefa_leilao`, `nome`, `responsavel`, `tipo`,`quantidade`, `dia`, `mes`, `status`, `data_realizada`, `ano` FROM tbl_tarefas,tbl_tipos WHERE id_leilao = '$lid' AND tbl_tarefas.id_tipo = tbl_tipos.id";
$result = $mysqli->prepare($query);

if ($result->execute()) {
	$result->bind_result($id,$idt,$idtl,$n,$resp,$t,$q,$d,$m,$s,$dr,$a);
	?>
	<table class="table table-hover">
		<thead class="thead-dark">
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
					Responsável
				</center>
			</th>
			<th>
				<center>
					Data Limite
				</center>
			</th>
			<th>
				<center>
					Data Realizada
				</center>
			</th>
		</thead>
		<tbody>
			<?php
			while ($result->fetch()) {
				?>
				<tr style="cursor: pointer;" onclick="seleciona(<?=$id?>)">
					<td>
						<center>
							<?=$idtl?>
						</center>
					</td>
					<td>
						<center>
							<?=$n?>
						</center>
					</td>
					<td>
						<center>
							<?=$t?>
						</center>
					</td>
					<td>
						<center>
							<?=$q?>
						</center>
					</td>
					<td>
						<center>
							<?=$resp?>
						</center>
					</td>
					<td>
						<?=$d.'/'.$m.'/'.$a?>
					</td>
					<td>
						<?=$dr?>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	<?php
}
?>
<script type="text/javascript">
	function seleciona(id) {
		window.location.assign('./?pg=4&id='+id);
	}
</script>