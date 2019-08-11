<?php
//inclui a conexao com o banco de dados
include '../../configs.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
	<!-- Lista de scripts on-line de Css do Bootstrap, esse padrão se mantera em todas as index.php-->
	<link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">	<meta charset="utf -8">
	<meta charset="utf-8">
</head>
<body>
	<center>
		<div style="position: sticky; top: 0;">
			<?php 
			//inclui a pagina de menu local
			include 'menu2.php';
			?>
		</div>

		<br>
		<!-- formulário para saber em qual tabela do banco de dados buscar -->
		<div class="d-flex flex-row" >
			<div class="p-2" style="width: 100%">
				<center><form action='resultado.php'>
					<h1>Sobre o que você esta à procura?</h1><br>
					<select name='table'>
						<option value='tbl_animais'>Animais
							<option value='lote'>Lotes
								<option value='compradores'>Compradores
								</select><br><br>
								<?php
								if(!isset($_REQUEST['search']))
								{
									echo "<table border=0 width=20%><tr><td><input class='form-control'  type='search' placeholder='Digite aqui sua pesquisa' aria-label='Search' name='search'></td></tr></table><br><br>";
								}
								else
								{
									echo "<input type='hidden' name='search' value='$_REQUEST[search]'>";
								}
								?>
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
			<script src="../../titulo.js" ></script>
			
		</body>
		</html>