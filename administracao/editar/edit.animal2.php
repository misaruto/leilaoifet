<?php
if ((isset($_REQUEST['nome']))&&(isset($_REQUEST['raca']))&&(isset($_REQUEST['peso']))&&(isset($_REQUEST['datap']))&&(isset($_REQUEST['datan']))&&(isset($_REQUEST['brinco']))&&(isset($_REQUEST['desc']))&&(isset($_REQUEST['id']))) {
	$n = $_REQUEST['nome'];
	$p =  $_REQUEST['peso'];
	$r = $_REQUEST['raca'];
	$b = $_REQUEST['brinco'];
	$dp = $_REQUEST['datap'];
	$dn = $_REQUEST['datan'];
	$d = $_REQUEST['desc']; 
	$id = $_REQUEST['id'];
	if (($n != "")&&($p != "")&&($r != "")&&($b != "")&&($dp != "")&&($dn != "")&&($d != "")&&($id !="")) {
		include '../../configs.php';
		$query = "UPDATE `tbl_animais` SET `nome_animal`='$n',`brinco`='$b',`peso`='$p',`data_pesagem`='$dp',`nascimento`='$dn',`raca`='$r',`descricao`='$d' WHERE id_animal = '$id'";
		if (mysqli_query($con, $query)) {
			?>
			<?php 
			if (!isset($_COOKIE['admid'])) {
				header('location:../../?pg=2');
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">	
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			</head>

			<body>
				<div class="container">
					<div class="menu">
						<?php 
						include './menu.php';
						?>
					</div>
					<div class="alert alert-success" role="alert">
						Animal editado com sucesso <br>
						<a href="./?pg=0" class="alert-link">Editar outro</a>
						Ou ver o animal editado <a class="alert-link" href="../listas?pg=1&id=<?=$id?>">Clique aqui</a>
					</div>
					<div>
					</div>
					<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
				</div>
			</body>
			</html>
			<?php
		}
		else{
			?>
			<?php 
			if (!isset($_COOKIE['admid'])) {
				header('location:../../?pg=2');
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">	
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			</head>

			<body>
				<div class="container">
					<div class="menu">
						<?php 
						include '../menu.php';
						?>
					</div>
					<div class=alert alert-danger role=alert>
						Animal não cadastrado. 
						<?php 
						echo '	<a href=pg=2&n='.$n.'&p='.$p.'&r='.$r.'&b='.$b.'&dp='.$dp.'&dn='.$dn.'&d='.$d.' class=alert-link>Voltar e tentar novamente
						</a>';

						?>
					</div>
					<div>
					</div>
					<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
				</div>
			</body>
			</html>
			<?php
		}
	}
	else{
		header('location:./?pg=2&n='.$n.'&p='.$p.'&r='.$r.'&b='.$b.'&dp='.$dp.'&dn='.$dn.'&d='.$d);
	}
}
else{
	header('location:./?pg=2');	
}
?>	