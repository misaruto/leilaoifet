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

$a = date('y');
$q = "SELECT MAX(id_lote_leilao) FROM tbl_lotes WHERE id_leilao = '$lid'";
$res = mysqli_query($con, $q);
$rr = mysqli_fetch_array($res);
if (empty($rr)) {
	$id = 1;
}
else{
	$id = $rr['MAX(id_lote_leilao)'] + 1;
}
//verifica se o leilão já foi finalizado.
$q = "SELECT finalizado FROM tbl_leiloes WHERE id = '$lid'";
$r = mysqli_query($con, $q);
$f = mysqli_fetch_object($r);
?>
<center>
	<br>
	<?php if ($f->finalizado == 0) {
		?>
		<form action="cria.lotes.php">
			<table>
				<tr>
					<td colspan="5">
						<center>
							<p class="font-weight-normal" style="font-size: 25px">
								Criar novo lote
							</p>
						</center>
					</td>
				</tr>
				<tr>
					<td>
						<center>
							Nome:
						</center>
					</td>
					<td>
						<input style="width: 500px;" type="text" name="n" class="form-control" placeholder="DIGITE O NOME DO NOVO LOTE">
					</td>
					<td>
						<input type="hidden" name="id_lote" value="<?=$id?>">
					</td>
					<td>
						<center>
							<input type="submit" class="btn btn-primary" value="Criar novo lote">
						</center>
					</td>
				</tr>
			</table>
		</form>
		<?php
	} 
	?>
	<br>
	<br>
	<table class="table table-hover" style="font-size: 20px;">
		<thead class="thead-dark">
			<th>
				<center>
					N° Lote
				</center>
			</th>
			<th>
				<center>
					Nome
				</center>
			</th>
			<th>
				<center>
					N° Animais
				</center>
			</th>
			<th>
				<center>
					Editar
				</center>
			</th>
			<th>
				<center>
					Apagar
				</center>
			</th>
			<th>
				<center>
					Desmembrar
				</center>
			</th>
		</thead>
		<?php 
		$query = "SELECT * FROM tbl_lotes WHERE id_leilao = '$lid'";
		$sql = mysqli_query($con, $query);
		$lote = 0;
		$animal = 0;
		while ($row = mysqli_fetch_object($sql)) {
			$q = "SELECT * FROM tbl_item_lotes WHERE id_lote = '$row->id_lote'";
			$s = mysqli_query($con, $q);
			$animal = mysqli_num_rows($s);
			if ($animal != 0) {

				$cor = 'style="color:#0f0; font-weight:bold;"';
			}
			else{
				$cor = 'style="color:#f00"';
				$animal = "Vazio";
			}
			?>
			<tr>
				<td style="cursor: pointer; z-index: 1000;" onclick="seleciona(<?=$row->id_lote?>) ">
					<center>
						<?=$row->id_lote_leilao?>
					</center>
				</td>
				<td style="cursor: pointer; z-index: 1000;" onclick="seleciona(<?=$row->id_lote?>)">
					<center>
						<?=$row->nome?>
					</center>
				</td>
				<td style="cursor: pointer; z-index: 1000;" onclick="seleciona(<?=$row->id_lote?>) ">
					<div <?=$cor?>>
						<center>
							<?=$animal?>
						</center>
					</div>
				</td>
				
				<?php 
				
				if ($row->desmembrado == 0) {
					if ($f->finalizado == 0) {
						?>
						<td>
							<center>
								<a href="./?pg=4&id=<?=$row->id_lote?>" style="z-index: 1001;">
									<img src="../imagens/editar.png" width="30" height="30">
								</a>
							</center>
						</td>
						<td>
							<center>
								<a style="z-index: 1001;" onclick="apagar(<?=$row->id_lote?>,<?=$row->id_lote_leilao?>)">
									<img src="../imagens/apagar.png" width="30" height="30" style="cursor: pointer;">
								</a>
							</center>
						</td>
						<?php 
						if ($animal > 1 ) {
							?>
							<td>
								<center>
									<button style="z-index: 1001;" onclick="dec(<?=$row->id_lote?>,<?=$row->id_lote_leilao?>)" class="btn btn-secondary">Desmembrar</button>
								</center>
							</td>
							<?php
						}
						else{
							?><td>
								<center>
									Poucos animais.
								</center>
							</td>
							<?php
						}
						?>
					</tr>
					<?php
				}
				else{
					?>
					<td colspan="3"  style="cursor: pointer; z-index: 1000;" onclick="seleciona(<?=$row->id_lote?>)" >
						<center>
							Clique para ver o lote
						</center>
					</td>
					<?php
				}
			}
			else {
				?>
				<td colspan="3" style="cursor: pointer; z-index: 1000;" onclick="seleciona(<?=$row->id_lote?>) ">
					<center>
						<div style="padding: 0; margin: 0; height: 30px; font-size: 16px; background-color: #d1ecf1;">
							<center>
								Lote desmembrado - clique para vê - lo
							</center>
						</div>
					</center>
				</td>
				<?php
			}

		}
		?>
	</table>
</center>

<script type="text/javascript">

	function apagar(id_lote,idll) {
		var id = id_lote;
		dec = confirm('Tem certeza que deseja apagar o lote '+idll);

		if (dec) {
			window.location = './?pg=6&id='+id;
		}
		else{
			window.location = './';
		}
	}


	function dec(id,idll) {
		d = confirm('Tem certeza que deseja desmenbrar o lote '+idll+'? \nObs.: Esta ação é irreversível.');
		if (d) {
			window.location.assign('./desmembrar.php?id='+id);
		}
		else{
			window.location = './';
		}
	}

	function seleciona(id) {
		window.location.assign('./?pg=4&id='+id);
	}
</script>