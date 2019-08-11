<?php 
if (isset($_COOKIE['i'])) {
	$i = $_COOKIE['i'];
}
else{
	?>
	<script type="text/javascript">
		alert('Contador não encontrado. VOlte e tente novamente');
		window.location.assign('./?pg=0');
	</script>
	<?php
}
if (isset($_COOKIE['doc'.$i])) {
	$doc = $_COOKIE['doc'.$i];
}
else{
	for ($i=0; $i < 5; $i++) { 
		setcookie('doc'.$i,'');
	}
	setcookie('i','');
	?>
	<script type="text/javascript">
		alert('Todos os documentos foram salvos.');
		window.location.assign('./?pg=0');
	</script>
	<?php
}
$prf='Prova de regularidade fiscal <br> perante a Fazenda Nacional';
$prfgts='Prova de regularidade com o <br>Fundo de Garantia do Tempo de Serviço';
$pid= 'Prova de inexistência de débitos <br>inadimplidos perante a justiça do trabalho';
$procuracao='Procuração';

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="../../imagens/favicon.ico" type="image/x-icon" />
	<meta charset="utf-8">
</head>
<body>
	<div class="container">
		<br><br>
		<center>
			<form action="documentos2.php" method="post" enctype="multipart/form-data">
				<table class="table table-striped">
					<tr>
						<td>
							<center>
								<?php 
								if ($doc == 'pid') {
									echo $pid;
								}
								if ($doc == 'prfgts') {
									echo $prfgts;
								}
								if ($doc == 'prf') {
									echo $prf;
								}
								if ($doc == 'procuracao') {
									echo $procuracao;
								}
								?>
							</center>
						</td>

						<td>
							<center>
								<input type="file" name="doc">	
							</center>					
						</td>
					</tr>
					<?php
					?>
					<tr>
						<td colspan="2">
							<center>
								<input type="submit" value="Enviar" class="btn btn-primary">
							</center>
						</td>
					</tr>
				</table>
			</form>
		</center>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<script src="../../titulo.js" ></script>

</body>
</html>