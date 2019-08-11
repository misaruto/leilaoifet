<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
include '../../configs.php';
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
//verifica se o leilão foi finalizado.
$q = "SELECT finalizado FROM tbl_leiloes WHERE id = '$lid'";
$r = mysqli_query($con, $q);
$f = mysqli_fetch_object($r);

if (!isset($_REQUEST['id'])) {
	header('location:./');
}
$id = $_REQUEST['id'];
$total_corrigido = 0;
$total_media = 0;
?>
<center>
	<table class="table table-striped" style="font-size: 20px;">
		<thead class="thead-dark">
			<tr>
				<td colspan="6">
					<form action="enche.lote2.php">
						<div>
							<?php 
							$s = "SELECT nome, desmembrado FROM tbl_lotes WHERE id_lote = '$id'";
							$q = mysqli_query($con, $s);
							$nome = mysqli_fetch_object($q);
							if ($nome->desmembrado == '0') {
								?>
								<div class="row">
									<div class="col">
										<input type="hidden" name="id_lote" value="<?=$id?>">
										<input placeholder="Nome" type="text" name="n" class="form-control" value="<?=$nome->nome?>">
									</div>
									<div class="col">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
								<?php
							}
							else{
								?>
								<div>
									<center>
										<?=$nome->nome?>
									</center>
								</div>
								<?php
							}
							?>
							
						</div>
					</form>
				</td>
			</tr>
			<tr>
				<td>
					<center>
						N° Animal
					</center>
				</td>
				<td>
					<center>
						Nome
					</center>
				</td>
				<td>
					<center>
						Brinco
					</center>
				</td>
				<td>
					Preço (R$)
				</td>
				<td>
					Preço Corrigido (R$)
				</td>
				<?php 
				if ($nome->desmembrado == '0') {
					?>
					<td>
						<center>
							Remover
						</center>
					</td>
					<?php 
				}
				?>
			</tr>
		</thead>
		<?php
		$a = date('y');
		$query = "SELECT * FROM tbl_item_lotes,tbl_animais, tbl_avaliacoes WHERE tbl_animais.id_animal = tbl_avaliacoes.id_animal AND tbl_item_lotes.id_animal = tbl_animais.id_animal and tbl_item_lotes.id_lote = '$id' and tbl_animais.id_leilao = '$lid'";
		$sql = mysqli_query($con, $query);
		$lote = 1;
		$l=0;
		while ($row = mysqli_fetch_object($sql)) {
			if ($row->id_lote = $lote) {
				$l = $l + 1;
			}
			else{
				$lote = $row->id_lote;
				$l=0;
			}
			$total_corrigido = $total_corrigido + $row->avaliacao_corrigida;
			$total_media = $total_media + $row->media_avaliacao;
			?>
			<tr>
				<td>
					<center>
						<?=$row->id_animal_leilao?>
					</center>
				</td>
				<td>
					<center>
						<?=$row->nome_animal?>
					</center>
				</td>
				<td>
					<center>
						<?=$row->brinco?>
					</center>
				</td>
				<td>
					<?=$row->media_avaliacao?>
				</td>
				<td>
					<?=$row->avaliacao_corrigida?>,00
				</td>
				<?php 
				if ($nome->desmembrado == '0' && $f->finalizado == 0) {
					?>
					<td>
						<center>
							<a href="remover.php?id=<?=$row->id_animal?>&lote=<?=$id?>">
								<img src="../imagens/apagar.png" width="30" height="30">
							</a>
						</center>
					</td>
					<?php
				}
				?>
			</tr>
			<?php
		}
		?>
		<tfoot>
			<tr>
				<td class="p-3 mb-2 bg-info text-white">
					Media Total:
				</td>
				<td class="p-3 mb-2 bg-info text-white">
					R$<?=$total_media?>
				</td>
				<td class="p-3 mb-2 bg-success text-white">
					Total Corrigido
				</td>
				<td class="p-3 mb-2 bg-success text-white">
					R$<?=$total_corrigido?>,00
				</td>
				<?php 
				if ($nome->desmembrado == '0' && $f->finalizado == 0) {
					?>
					<td colspan="2" >
						<a href="./cria.lotes.php?id=<?=$id?>" class="text-primary">
							<center>
								Adcionar novo animal
							</center>
						</a>
					</td>
					<?php 
				}
				else{
					?>
					<td>
						<a href="./" class="text-primary">
							<center>
								Voltar
							</center>
						</a>
					</td>
					<?php
				}
				?>
			</tr>
		</tfoot>
	</table>
</center>