<?php 
if ((isset($_POST['login']))&&(isset($_POST['pass']))) {
	$login = $_POST['login'];
	$pass = $_POST['pass'];
	if (($login!="")&&($pass!="")) {
		if (($login != "-")&&($pass != "-")) {
			include 'configs.php';
			$stop = 0;
			$query = "SELECT * FROM tbl_administradores";
			$sql = mysqli_query($con, $query);
			while ($row = mysqli_fetch_object($sql)) {
				$senha = md5($pass);
				if (($row->login == $login)&&($senha==$row->senha)) {
					if ($row->confirmado == 1) {
						if ($row->autorizado == 1) {
							setcookie('admid',$row->id_adm);
							header('location:./administracao/');
							$stop=1;
						}
						else{
							?>
							<script type="text/javascript">
								alert('Seu login ainda não foi confirmado pelos administradores. Verifique seu E-mail frequentemente, pois você será informado por lá');
								window.location.assign('./');
							</script>
							<?php
						}
					}
					else{
						?>
						<script type="text/javascript">
							alert('Seu email ainda não foi verificado, você será redirecionado para a página de verificação');
							window.location.assign('codigo.php?cpf=<?=$row->cpf?>');
						</script>
						<?php
					}
				}
			}
			if ($stop == 0) {
				?>
				<script type="text/javascript">
					alert('Usuário ou senha incorretos, tente novamente.');
					window.location.assign('./?pg=2&l=<?=$login?>');
				</script>
				<?php
			}

		}
		else{
			header("location:./?pg=2&l=".$login);

		}
	}
	else{
		header('location:./?pg=2');
	}
}
?>
