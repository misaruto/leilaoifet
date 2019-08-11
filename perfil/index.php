<?php 
if ((!isset($_COOKIE['admid']))&&(!isset($_COOKIE['compid']))) {
	header('location:../?pg=2');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body id="body">
	<div class="container">
		<div class="menu">
			<?php 
			include './menu.php';
			?>
		</div>
		<div>
			<?php 
			$pg = array('home.php','editar.php');
			if ((isset($_REQUEST['pg']))&&($_REQUEST['pg']!="")) {
				$pag=$_REQUEST['pg'];

			}
			else{
				$pag = 0;
			}
			include $pg[$pag];
			?>
		</div>
		<div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnXwWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>