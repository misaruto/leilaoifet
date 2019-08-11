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

//verifica se o leilão já foi finalizado.
$q = "SELECT finalizado FROM tbl_leiloes WHERE id = '$lid'";
$r = mysqli_query($con, $q);
$f = mysqli_fetch_object($r);
if ($f->finalizado == 1) {
	?>
	<script type="text/javascript">
		alert('leilão finalizado. Não é possivel modificar os lotes.');
		window.location.assign('./');
	</script>
	<?php
}

if (isset($_REQUEST['opt'])) {
	$i = 0;
	$x=1;
	$id = $_COOKIE['id_lote'];
	$query = "SELECT id_animal FROM tbl_animais";
	$result = mysqli_query($con,$query);
	while ($row = mysqli_fetch_object($result)) {
		if (isset($_COOKIE['ida_'.$row->id_animal])) {
			setcookie('ida_'.$row->id_animal,'');
		}
	}
	$id = $_COOKIE['id_lote'];
	header('location:./?pg=4&id='.$id);
}
$a = date('y') +2000;
?>

<div class="container">
	<center>
		<div>
			<div style="padding-bottom: 2px">
				<?php 
				$query = "SELECT id_animal FROM tbl_animais";
				$result = mysqli_query($con,$query);
				while ($row = mysqli_fetch_object($result)) {
					$id_a = $row->id_animal;
					if (isset($_COOKIE['ida_'.$id_a])) {
						$ida = $_COOKIE['ida_'.$id_a];
						$query = "SELECT nome_animal FROM tbl_animais WHERE tbl_animais.id_animal = '$ida'";
						$sql = mysqli_query($con,$query);
						$row = mysqli_fetch_object($sql);
						?>
						<span class="badge badge-primary" >
							<div class="d-flex flex-row">
								<div style="font-size: 15px">
									<center>
										<?=$row->nome_animal?>
									</center>
								</div>
								&emsp;
								<div class="close" style="margin-top: -5px;">
									<a href="limpa.php?id=<?=$id?>" class="close" aria-label="Close" >
										x
									</a>
								</div>
							</div>
						</span>
						<?php
					}
				}
				$query = "SELECT *,tbl_animais.id_animal FROM tbl_animais, tbl_avaliacoes WHERE NOT EXISTS(SELECT id_animal FROM tbl_item_lotes WHERE tbl_item_lotes.id_animal = tbl_animais.id_animal AND desmembrado = '0') AND tbl_animais.id_animal = tbl_avaliacoes.id_animal AND tbl_animais.id_leilao = '$lid'";
				$sql = mysqli_query($con, $query);
				$r = mysqli_num_rows($sql);
				if (empty($r)) {
					$show = 0;
				}
				else{
					$show = 1;
				}
				?>
			</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<td>
							N°
						</td>
						<td>
							Nome
						</td>
						<td>
							Brinco
						</td>
						<td>
							Peso/kg
						</td>
						<td>
							Preço
						</td>
						<td>
							Preço Corrigido
						</td>
						<td>
							Add
						</td>
						<?php 
						if ($show == 1) {
							?>
							<td>
								<a href="enche.lote3.php">
									<div class="btn btn-primary">
										Finalizar
									</div>
								</a>
							</td>
							<?php
						}
						?>
					</tr>
				</thead>
				<?php 
				if ($show == 0) {
					?>
					<tbody>
						<tr>
							<td colspan="7">
								<div class="alert alert-warning" role="alert">
									Nenhum animal para mostrar, todos estão em lotes ou não foram avaliado.
									<a href="..//avaliacao/" class="alert-link">Avaliar</a>
									<a href="./" class="alert-link">Lotes</a>
								</div>
							</td>
						</tr>
					</tbody>
					<?php
				}	
				$i = 0;
				while ($row = mysqli_fetch_object($sql)) {
					$hide = "";
					if (isset($_COOKIE['ida_'.$row->id_animal])) {
						$hide = "hidden";
					}
					$i = $i+1;
					?>
					<tr <?=$hide?>>
						<td>
							<?=$row->id_animal_leilao?>
						</td>
						<td>
							<?=$row->nome_animal?>
						</td>
						<td>
							<?=$row->brinco?>
						</td>
						<td>
							<?=$row->peso?>
						</td>
						<td>
							R$ <?=$row->media_avaliacao?>
						</td>
						<td>
							R$ <?=$row->avaliacao_corrigida?>.00
						</td>
						<td>
							<a href="enche.lote2.php?id=<?=$row->id_animal?>">
								<div class="btn btn-secondary">
									Add
								</div>
							</a>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</center>
</div>

