<?php
//lista de paginas que podem ser incluidas nessa index.php 
$pg[1] = 'home.php';
$pg[2] = 'login.php';
$pg[3] = 'cadastro.php';
$pg[4] = 'feed.1.php';
$pg[5] = 'alert.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="shortcut icon" href="./imagens/favicon.ico" type="image/x-icon" />
	<!-- Lista de scripts on-line de Css do Bootstrap, esse padrão se mantera em todas as index.php-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<meta charset="utf -8">
	<!-- Lista de scripts of-line de Css do Bootstrap-->
	<meta charset="utf-8">
</head>
<body>
	<center>
		<div class="container">
			<br>
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
						while ($row = mysqli_fetch_object($sql)) {
							?>
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
			<div class="menu">
				<?php 
			//inclui a pagina de menu local
				include 'menu.php';
				?>
			</div>
			<br><br><br>
			<div class="conteudo">
				<?php 
			//verifica se existe um numero página escolhida
				if (isset($_REQUEST['pg'])) {
				//se verdade ela é escolhida do vetor '$pg'
					$x = $_REQUEST['pg'];
					include $pg[$x];	
				}
				else{
				//se nao existir será escolhido como padrão a home.php
					include 'home.php';
				}
				?>
			</div>
		</div>
	</center>
	<!-- Lista de scripts on-line de Java Script do Bootstrap-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<!-- Lista de scripts of-line de Java Script do Bootstrap-->
	<script src="./titulo.js" ></script>
</body>
</html>