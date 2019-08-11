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

if (!isset($_COOKIE['compid'])) {
	header('location:./');
}
$compid = $_COOKIE['compid'];
include '../../configs.php';


$query = "SELECT * FROM tbl_compradores WHERE tbl_compradores.id_comprador = '$compid'";
$sql = mysqli_query($con,$query);
$row = mysqli_fetch_object($sql);

$query = "SELECT * FROM `tbl_comprador-lote` WHERE `tbl_comprador-lote`.id_comprador = '$compid'";
$sql = mysqli_query($con,$query);
$row_nota = mysqli_fetch_object($sql);
$s = 0;

?>
<form action="./confirma.php">
	<input type="hidden" name="salvar">
	<table class="table table-striped">
		<thead class="thead-dark">
			<tr>
				<th colspan="4">
					<center>
						Inserir valor de venda do(s) lote(s).
					</center>
				</th>
			</tr>
			<tr>
				<th>
					<center>
						Lote N°
					</center>
				</th>
				<th>
					<center>
						Nome
					</center>
				</th>
				<th>
					<center>
						Valor
					</center>
				</th>
				<th>
					<center>
						Valor por extenso
					</center>
				</th>
			</tr>
		</thead>
		<?php
		for ($i=0; $i <=20 ; $i++) { 
			if (isset($_COOKIE['lote'.$i])) {
				$s = $s+1;
				$id = $_COOKIE['lote'.$i];
				$q = "SELECT * from tbl_lotes WHERE id_lote = '$id'";
				$rr = mysqli_query($con,$q);
				while ($r = mysqli_fetch_object($rr)) {
					?>
					<tr>
						<td>
							<center>
								<?=$r->id_lote_leilao?>
							</center>
						</td>
						<td>
							<center>
								<?=$r->nome?>
							</center>
						</td>
						<td>
							<center> 
								<input type="text" class="form-control" style="width:220px;" placeholder="Digite o valor numérico" name="valor<?=$i?>" required onkeypress='return SomenteNumero(event)'>
							</center> 
						</td>
						<td>
							<center>
								<input class="form-control" type="text" style="width:280px;" placeholder="Digite o valor por extenso" name="valor-extenso<?=$i?>" required>
							</center>
						</td>
					</tr>
					<?php
				}
			}
		}
		if ($s == 0) {
			?>
			<script type="text/javascript">
				alert('Nenhum lote selecionado');
				window.location.assign('./?pg=1');
			</script>
			<?php
		}
		?>
		<tr>
			<td colspan="4">
				<center>
					<input type="submit" class="btn btn-primary" value="Salvar">
				</center>
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">
	function SomenteNumero(e){
		var tecla=(window.event)?event.keyCode:e.which;   
		if((tecla>47 && tecla<58)) return true;
		else{
			if (tecla==8 || tecla==0) return true;
			else  return false;
		}
	}
</script>
