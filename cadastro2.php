<?php   
include './configs.php';

if ((isset($_POST['nome']))&&(isset($_POST['email']))&&(isset($_POST['cpf']))&&(isset($_POST['login']))&&(isset($_POST['pass']))&&(isset($_POST['pass2']))&&(isset($_POST['motivo']))) {	
	$m = $_POST['motivo'];
	$n = $_POST['nome'];
	$cpf = $_POST['cpf'];
	//Validando CPF
	include('valida-cpf/valida-cpf.php');

	// Verifica o CPF

	if (valida_cpf($cpf) ) {
		$vCPF = 1;
	} else {
		$vCPF = 0;
	}


	$l = $_POST['login'];
	$pass1 = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	$email = $_POST['email'];

	if ($vCPF == 0) {
		header('location:./?pg=3&n='.$n.'&cpf='.$cpf.'&email='.$email.'&e=cpf');
	}
	if ($pass2 == $pass1) {
		$pass = md5($pass2);
	}
	else{
		$vCPF = 0;
		header('location:./?pg=3&n='.$n.'&cpf='.$cpf.'&email='.$email.'&e=senhas');
	}
	if (($n!="")&&($cpf!="")&&($l!="")&&($email != "")&&($pass1!="")&&($pass2 !="")&& ($vCPF == 1)) {
	//verifica se ja existe email, cpf e nome de usuarios iguais ja cadastrados.
		$query = "SELECT * FROM tbl_administradores";
		$result = mysqli_query($con,$query);
		$e = 0;
		while ($row = mysqli_fetch_object($result)) {
			if ($row->email == $email) {
				$e = 1;
				?>
				<script type="text/javascript">
					alert('O E-mail já existe, tente. Esqueceu seu login ou senha? acesse a página de recuperção');
					window.location.assign('./?pg=5');
				</script>
				<?php
				echo"email";
				die();
			}
			if ($row->login == $l) {
				$e = 1;
				?>
				<script type="text/javascript">
					alert('O Login já existe em nosso banco de dados, volte e tente novamente.');
					window.location.assign('./?pg=3&n=<?=$n?>&cpf=<?=$cpf?>&email=<?=$email?>');
				</script>
				<?php
				echo"login";
			}
			if ($row->cpf == $cpf) {
				$e = 1;
				?>
				<script type="text/javascript">
					alert('O CPF informado já existe em nosso banco de dados, envie um feedback para os administradores averiguar o seu caso.');
					window.location.assign('./?pg=4');
				</script>
				<?php
				echo"cpf";
				die();
			}
		}
		if ($e == 0) {
			$m = str_replace("'","\"",$m);
			$numero = rand(100000,999999);
			$query = "INSERT INTO `tbl_administradores`(`nome_adm`, `login`, `senha`, `email`, `cpf`, `codigo`, `autorizado`,`motivo`,`confirmado`,`quem_aprovou`) VALUES ('$n','$l','$pass','$email','$cpf','$numero','0','$m','0','0')";
			if (mysqli_query($con, $query)) {


				include './PHPMailer-master/PHPMailerAutoload.php';


		// Inicia a classe PHPMailer 
				$mail = new PHPMailer(); 

				define('GUSER', 'leilaoifet@gmail.com');
				define('GPWD', '@leilao123');

// Corpo do email 
				$body = '<!DOCTYPE html>
				<html>
				<head>
				<meta charset="utf-8">
				<title></title>
				</head>
				<body>
				<center>
				<div>
				<h2>Verrificação de E-Mail Leilão IF Sudeste de MG Campus Rio Pomba</h2>
				<div style="font-size: 26px">
				seu codigo de verificação: 
				</div>
				<div style="width: 130px;height: 34px;font-size: 30px;background-color: #9cf18de6;border-style: solid;">
				'.$numero.'	
				</div>
				<div style="font-size: 20px">
				Por favor não responda esse E-mail.
				</div>
				</div>
				</center>
				</body>
				</html>'; 



				$mail = new PHPMailer();
				/* Montando o Email*/
				$mail->IsSMTP(); /* Ativar SMTP*/
				$mail->SMTPDebug = 2; /* Debugar: 1 = erros e mensagens, 2 = mensagens apenas*/
				$mail->SMTPAuth = true; /* Autenticação ativada */
				$mail->SMTPSecure = 'tls'; /* TLS REQUERIDO pelo GMail*/
				$mail->Host = 'smtp.gmail.com'; /* SMTP utilizado*/
				$mail->Port = 587; /* A porta 465 deverá estar aberta em seu servidor*/
				$mail->Username = 'leilaoifet@gmail.com';
				$mail->Password = '@leilao123';
				$mail->CharSet = 'UTF-8'; 
				$mail->SetFrom(GUSER,'Leilão IF Sudeste - MG Campus Rio Pomba');
				$mail->Subject = "Codigo de segurança para cadastro.";
				$mail->Body = $body;
				$mail->AddAddress($email);
				$mail->IsHTML(true);




// Opcional: Anexos 
// $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 

// Envia o e-mail 
				$enviado = $mail->Send(); 

// Exibe uma mensagem de resultado 
				if ($enviado){
					?>
					<script type="text/javascript">
						window.location.assign('codigo.php?cpf=<?=$cpf?>')
					</script>
					<?php
				} 
				else { 
					echo "Houve um erro enviando o email: ".$mail->ErrorInfo; 
				} 

			}
			else{
				echo "Erro na clausula";
			}
		}
	}
	else{
		
	}
}
else{
	header('location:./?pg=3');
}



?>