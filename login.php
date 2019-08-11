<?php 
if ((isset($_REQUEST['l']))) {
	$l=$_REQUEST['l'];
	if (($l=="")) {
		$erro = "Preencha todos os campos.";
	}
	else{
		$erro = "Nome de Usuário ou senha incorretos";
	}
}
else{
	$l = "";
	$erro="";	
}
?>
<form action="verifica.php" method="post">
	<div style="width: 50%">
		<div class="text-danger" id="erro">
			<?=$erro?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Login</label>
			<input autofocus oninput="hide()" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Login" name="login" value="<?=$l?>">
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Senha</label>
			<input oninput="hide()" type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="pass">
		</div>
		<a charset="text-primary" href="#" onclick="show()">
			Mostrar senha
		</a>
		<br>
		<br>
		<button type="submit" class="btn btn-primary">Login</button>
		<div class="text-info" id="Form">
			<a href="./?pg=3">Cadastre-se</a>
		</div>
	</div>
</form>
<br><br><br><br>
<script type="text/javascript">
 	window.scrollTo(0,300);
	function show(argument) {
		if (document.getElementById('exampleInputPassword1').type == "password") {
			document.getElementById('exampleInputPassword1').type = "text";
		}
		else{
			document.getElementById('exampleInputPassword1').type = "password";
		}
	}
	function hide(argument) {
		document.getElementById('erro').hidden = true;
	}
</script>