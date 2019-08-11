<?php
//armazena o valor da variável "$search" se a mesma existir, inclui a conexao com o banco de dados
if (isset($_REQUEST['search'])) {
	$search = $_REQUEST['search'];
}
include '../configs.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
	<!-- Lista de scripts on-line de Css do Bootstrap, esse padrão se mantera em todas as index.php-->
	<link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">	<meta charset="utf -8">
	<!-- Lista de scripts of-line de Css do Bootstrap-->
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-grid.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-grid.css.map">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-grid.min.css.map">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-reboot.css.map">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-reboot.min.css.map">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.css.map">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css.map">
	<meta charset="utf-8">
</head>
<body>
	<center>
		<?php 
			//inclui a pagina de menu local
			include 'menu.php';
		?>
	<br>
	<!-- formulário para saber em qual tabela do banco de dados buscar -->
	<div class="d-flex flex-row" >
		<div class="p-2" style="width: 100%">
			<center><form action='resultado.php'>
			<h1>Sobre o que você esta a procura?</h1><br>
				<select name='table'>
				<option value='tbl_animais'>Animais
				<option value='lote'>Lotes
				</select><br><br>
				<input type='hidden' name='search' value='<?php echo "$search";?>'>
				<button type="submit" class="btn btn-primary">Enviar</button>
				</form>
				</center>
			</div>
		</div>
	</center>
	<!-- Lista de scripts on-line de Java Script do Bootstrap-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<!-- Lista de scripts of-line de Java Script do Bootstrap-->
	<script type="text/javascript" src="./js/bootstrap.bundle.js"></script>
	<script type="text/javascript" src="./js/bootstrap.bundle.js.map"></script>
	<script type="text/javascript" src="./js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.bundle.min.js.map"></script>
	<script type="text/javascript" src="./js/bootstrap.js"></script>
	<script type="text/javascript" src="./js/bootstrap.js.map"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js.map"></script>
</body>
</html>