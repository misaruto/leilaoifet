<?php 
if (!isset($_COOKIE['cpf'])) {
	?>
	<script type="text/javascript">
		alert('Nenhum usuário detectado, tente fazer login novamente.');
		window.location.assign('./?opt=2');
	</script>
	<?php
}
include './configs.php';
$cpf = $_COOKIE['cpf'];
$query = "SELECT codigo,email FROM tbl_administradores WHERE cpf = '$cpf'";
$result = $mysqli->prepare($query);
if ($result->execute()) {

	$result->bind_result($codigo,$email);
	$result->fetch();

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
	'.$codigo.'	
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
	//$mail->SMTPDebug = 1; /* Debugar: 1 = erros e mensagens, 2 = mensagens apenas*/
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
			alert('Codigo reenviado com sucesso');
			window.location.assign('codigo.php?cpf=<?=$cpf?>');
		</script>
		<?php
	} 
	else { 
		echo "Houve um erro enviando o email: ".$mail->ErrorInfo; 
	} 
}

?>