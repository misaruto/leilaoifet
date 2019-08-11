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
		?>
	<script type="text/javascript">
		window.location.assign('./');
	</script>
	<?php
}

include '../../configs.php';

$query = "SELECT * FROM tbl_lotes WHERE id_leilao = '$lid' AND leiloado = '0'";
$result = mysqli_query($con, $query);
?>
<table class="table table-hover table-bordered">
	<thead class="thead-dark">
		<tr>
			<th>
				<center>
					N°
				</center>
			</th>
			<th>
				<center>
					N° Animais
				</center>
			</th>
			<th>
				<center>
					Nome
				</center>
			</th>
		</tr>
		<tr>
			<td colspan="5">
				<center>
					<button onclick="confirmar()" class="btn btn-primary">
						Salvar
					</button>
				</center>
			</td>
		</tr>
		<tr>
			<td colspan="5">
				<center>
					<?php 
					for ($i=0; $i <=20 ; $i++) { 
						if (isset($_COOKIE['lote'.$i])) {
							$id = $_COOKIE['lote'.$i];
							$q = "SELECT * from tbl_lotes WHERE id_lote = '$id'";
							$rr = mysqli_query($con,$q);
							while ($r = mysqli_fetch_object($rr)) {
								?>
								<a href="confirma.php?apagar=<?=$r->id_lote?>" class="btn btn-primary">
									<?=$r->id_lote_leilao?>
									<span aria-hidden="true">&times;</span>
								</a>
								<?php
							}
						}
					}
					?>
				</center>
			</td>
		</tr>
	</thead>
	<?php
	while ($row = mysqli_fetch_object($result)) {
		$q = "SELECT * FROM tbl_item_lotes WHERE id_lote = '$row->id_lote'";
		$s = mysqli_query($con, $q);
		$animal = mysqli_num_rows($s);
		if ($animal != 0) {
			$cor = 'style="color:#0f0; font-weight:bold;"';
			$opt = "style='cursor: pointer;' onclick='seleciona(".$row->id_lote.")'";
		}
		else{
			$opt = "disabled";
			$cor = 'style="color:#f00"';
			$animal = "Vazio";
		}
		?>
		<tr <?=$opt?> id="<?=$row->id_lote?>">
			<td>
				<center>
					<?=$row->id_lote_leilao?>
				</center>
			</td>
			<td>
				<div <?=$cor?>>
					<center>
						<?=$animal?>
					</center>
				</div>
			</td>
			<td>
				<center>
					<?=$row->nome?>
				</center>
			</td>
		</tr>
		<?php
	}
	?>
</table>
<script type="text/javascript">
	var x = 0;
	function seleciona(id_lote) {
		id = id_lote;
		window.location.assign('./confirma.php?id='+id);
	}

	<?php 
	for ($i=0; $i <=20 ; $i++) { 
		if (isset($_COOKIE['lote'.$i])) {
			$id = $_COOKIE['lote'.$i];
			?>
			x= 1;
			document.getElementById('<?=$id?>').hidden = true;
			<?php
		}
	}
	?>
	function confirmar(){
		if (x == 1) {
			confirma = confirm('Tem certeza que deseja salvar estes para este comprador');
			if (confirma == true) {
				window.location.assign('./?pg=2');
			}
		}
		else{
			alert('Selecione um lote para poder salvar');
		}
	}
</script>