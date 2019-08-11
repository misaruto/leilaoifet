<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
?>
<table class="table table-hover">
	<thead>
		<tr>
			<th colspan="4">
				<center>
					Escolha um dos leilões para começar
				</center>
			</th>
		</tr>
		<tr>
			<th>
				<center>
					N°/Ano
				</center>
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
				Data-Finalizado
			</th>
			<th>
				<center>
					Finalizar
				</center>
			</th>
			<th>
				<center>
					Relatório - final
				</center>
			</th>
		</tr>
	</thead>
	<?php 
	include '../../configs.php';
	$query = "SELECT tbl_leiloes.id, nome, tipo, numero, ano, finalizado FROM tbl_leiloes, tbl_tipos WHERE tbl_leiloes.id_tipo = tbl_tipos.id";
	$result = mysqli_query($con, $query);
	while ($row = mysqli_fetch_object($result)) {
		?>
		<tr>
			<td style="cursor: pointer;" onclick="seleciona(<?=$row->id?>)">
				<center>
					<?=$row->numero?>/<?=$row->ano?>
				</center>
			</td>
			<td style="cursor: pointer;" onclick="seleciona(<?=$row->id?>)">
				<center>
					<?=$row->nome?>
				</center>
			</td>
			<td style="cursor: pointer;" onclick="seleciona(<?=$row->id?>)">
				<center>
					<?=$row->tipo?>
				</center>
			</td>
			<?php 
						//verifica se o leilão já foi finalizado.
			if ($row->finalizado == 0) {
				?>
				<td>
					<center>
						<div>
							<label>
								<input type="date" onchange="data(<?=$row->id?>)" id="data<?=$row->id?>">
							</label>
						</div>
					</center>
				</td>
				<td>
					<center>
						<button disabled id="btn<?=$row->id?>" class="btn btn-danger" onclick="finalizar(<?=$row->id?>)">Finalizar</button>
					</center>		
				</td>
				<td>
					<center>
						Leilão não finalizado
					</center>
				</td>
				<?php
			}
			else{
				?>
				<td colspan="2">
					<div>
						<center>
							---- Leilão finalizado ----
						</center>
					</div>
				</td>
				<td>
					<center>
						<button class="btn btn-success" onclick="relatorio(<?=$row->id?>)">Gerar</button>
					</center>
				</td>
				<?php
			}
			?>
		</tr>
		<?php
	} 
	?>
</table>
<script type="text/javascript">
	function seleciona(id){
		window.location.assign('../seleciona.php?id='+id);
	}
	function data(id) {
		var data = document.getElementById('data'+id).value;
		if (data.length == 10) {
			now = new Date;
			var m = now.getMonth()+1;
			if(m<10 && now.getDate() < 10){
				var a = now.getFullYear() +'-'+0+ m +'-'+0+ now.getDate();
			}
			if(m<10 && now.getDate() > 10){
				var a = now.getFullYear() +'-'+0+ m +'-'+ now.getDate();
			}
			if(m>10 && now.getDate() < 10){
				var a = now.getFullYear() +'-'+ m +'-'+0+ now.getDate();
			}
			if(m>10 && now.getDate() > 10){
				var a = now.getFullYear() +'-'+ m +'-'+ now.getDate();
			}
			if (data > a)  {
				alert('A data não pode ser depois do dia de hoje');
				document.getElementById('data'+id).value = '';
			}
			else{
				document.getElementById('btn'+id).disabled = false;
			}
		}
		else{
			alert(data.length);
		}
	}
	function finalizar(id){
		var d = confirm('Tem certeza que deseja finalizar esse leilão?\n Obs.: Essa operação é irreversível.');
		if (d) {
			var data = document.getElementById('data'+id).value;
			window.location.assign('./finalizar.php?id='+id+ '&data='+data);
		}
	}
	function relatorio(id){
		window.location.assign('./relatorio.php?id='+id);
	}
</script>