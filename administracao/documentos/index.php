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
//verifica se o leilão já foi finalizado.
$q = "SELECT finalizado FROM tbl_leiloes WHERE id = '$lid'";
$r = mysqli_query($con, $q);
$f = mysqli_fetch_object($r);
if ($f->finalizado == 1) {
	?>
	<script type="text/javascript">
		alert('leilão finalizado. Por favor selecione outro.');
		window.location.assign('../leiloes');
	</script>
	<?php
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">	<link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.css">
	<link rel="shortcut icon" href="../../imagens/favicon.ico" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="utf-8">
</head>

<body>
	<div class="container" style="font-size: 20px;">
		<div class="menu" style="position: sticky; top: 0;">
			<?php 
			include './menu.php';
			?>
		</div>
		<div>
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th colspan="4">
							<center>
								Clique no documento para velo.
							</center>
						</th>
					</tr>
					<tr>
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
								Tipo
							</center>
						</th>
						<th>
							<center>
								Dono
							</center>
						</th>
					</tr>
				</thead>
				<?php 
				include '../../configs.php';
				$query = "SELECT * FROM tbl_documentos,tbl_compradores WHERE tbl_documentos.id_comprador = tbl_compradores.id_comprador AND tbl_compradores.id_leilao = '$lid'";
				$sql = mysqli_query($con, $query);
				while ($doc = mysqli_fetch_object($sql)) {
					$nome_doc = substr($doc->nome_doc, 0, 40);
					$nomec = explode(" ", $doc->nome_comprador);
					if (isset($nomec[1])) {
						$nome = $nomec[0].' '.$nomec[1];
					}
					else{
						$nome = $nomec[0];
					}
					?>
					<tr style="cursor: pointer;" onclick="seleciona('<?=$doc->nome?>')">
						<td>
							<center>
								<?=$doc->id_documento_leilao?>
							</center>
						</td>
						<td>
							<center>
								<?=$nome_doc?>
							</center>
						</td>
						<td>
							<center>
								<?=$doc->tipo?>
							</center>
						</td>
						<td>
							<center>
								<a class="btn btn-primary" href="../listas?pg=0&id=<?=$doc->id_comprador?>">
									<div style="width: 150px">
										<?=$nome?>
									</div>
								</a>
							</center>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<link rel="shortcut icon" href="../../imagens/favicon.ico" type="image/x-icon" />
	<script src="../../titulo.js" ></script>

	<script type="text/javascript">
		function seleciona(id) {
			window.location.assign('./'+id);
		}
	</script>
</body>
</html>