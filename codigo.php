<?php 
if (isset($_REQUEST['cpf'])) {
	$cpf = $_REQUEST['cpf'];
	setcookie('cpf',$cpf);
}
else{
	?>
	<script type="text/javascript">
		alert('houve um erro ao cadastrar. Por favor voltar e refazer cadastro.');
		window.location.assign('./?pg=3');
	</script>
	<?php
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon" />
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<div class="logo" width="600" height="300">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="./imagens/slide1.jpg" 
					width="650" height="362">
				</div>
				<?php 
				include 'configs.php';
						//busca e mostra as fotos cadastradas como logo.
				$query = "SELECT * FROM tbl_logo";
				$sql = mysqli_query($con, $query);
				while ($row = mysqli_fetch_object($sql)) {?>
					<div class="carousel-item ">
						<img class="d-block w-100" src="./imagens/<?=$row->nome?>" 
						width="650" height="362">
					</div>	
					<?php
				}
				?>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	<center>
		<table class="table table-striped">
			<form action="verifica-codigo.php">
				<div style="font-size: 24px;">
					Digite o código de 6 digítos enviado para 0 seu email: <br>
				</div>
				<input type="text" size="6" name="codigo" id="codigo" oninput="VerificaTamanho()" required required onkeypress='return SomenteNumero(event)' maxlength="6">
				<br>
				<br>
				<input type="submit" class="btn btn-primary">
				<br>
				<a href="reenviar.php">
					Reenviar o codigo de confirmação
				</a>
			</form>
		</table>
	</center>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<script type="text/javascript">
		function SomenteNumero(e){
			var tecla=(window.event)?event.keyCode:e.which;   
			if((tecla>47 && tecla<58)) return true;
			else{
				if (tecla==8 || tecla==0) return true;
				else  return false;
			}
		}
	</script>
</body>
</html>