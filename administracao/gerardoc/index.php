 <?php
 if (!isset($_COOKIE['admid'])) {
 	header('location:./././?pg=2');
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
 if (!isset($_REQUEST['pg'])) {
 	$pg = 0;
 }
 else{
 	$pg = $_REQUEST['pg'];
 }
 $paginas = array('comp.php','avaliador.php','comp-lote.php');
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
 		<div class="menu" >
 			<?php 
 			include './menu.php';
 			?>
 		</div>
 		<div>
 			<?php 
 			include $paginas[$pg];
 			?>
 		</div>
 	</div>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<script src="../../titulo.js" ></script>
 	
 </body>
 </html>
