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



if (!isset($_COOKIE['id_lote'])) {
	?>
	<script type="text/javascript">
		alert('Nenhum lote detectado');
		window.location.assign('./');
	</script>
	<?php
}
$id = $_COOKIE['id_lote'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="../../imagens/favicon.ico" type="image/x-icon" />
</head>

<body>
	<div class="container">
		<div class="menu">
			<?php 
			include './menu.php';
			?>
		</div>
		<center>
			<div class="conteudo">
				<?php 
				include '../../configs.php';
				$a = date('y');
				$query = "SELECT id_animal FROM tbl_animais";
				$result = mysqli_query($con,$query);
				while ($row = mysqli_fetch_object($result)) {
					if (isset($_COOKIE['ida_'.$row->id_animal])) {
						$ida = $_COOKIE['ida_'.$row->id_animal];	
						$query = "INSERT INTO `tbl_item_lotes`(`id_animal`, `id_lote`, `ano`) VALUES (".$ida.",'$id','$a')";
						if (mysqli_query($con, $query)) {
							setcookie('ida'.$ida,'');
							?>
							<script type="text/javascript">
								alert('Animai(s) adcionado(s) com sucesso!!!');
								window.location.assign('./enche.lote.php?opt=1');
							</script>
							<?php
						}
						else{
							?>
							Erro ao add o animal <?=$row->id_animal?>ao lote
							<a href="./">Voltar aos lotes</a>
							<br>
							<a href="./?pg=4&id=<?=$id?>">Voltar ao lote</a>
							<?php
						}
					}
				}
				?>	
			</div>
		</center>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	</body>
	</html>