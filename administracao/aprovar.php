<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../?pg=2');
}
if (isset($_REQUEST['id'])) {
	include '../configs.php';
	$admid = $_COOKIE['admid'];
	$id = $_REQUEST['id'];
	$query = "UPDATE `tbl_administradores` SET `autorizado`= 1, `quem_aprovou` = '$admid'  WHERE id_adm = '$id'";
	if (mysqli_query($con, $query)) {
		include '../PHPMailer-master/PHPMailerAutoload.php';


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
		Parabéns, você foi aceito como administrador sistema de Leilão do IF Sudeste MG Campus Rio Pomba.
		<br>
		<a href="leilaoifet.tk?pg=2">
		Clique aqui para acessar o site.
		</a>
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
		$mail->SetFrom(GUSER,'Leilão IFS-MG RP');
		$mail->Subject = "Requisição para ser administrador negada";
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
				alert('Administrador aprovado com sucesso');
				window.location.assign('./');
			</script>
			<?php
		}
		else{ 

			echo "Houve um erro enviando o email: ".$mail->ErrorInfo; 
		} 

	}
}
else{
	?>
	<script type="text/javascript">
		alert('Nenhuma requisição selecionada');
		window.location.assign('./');
	</script>
	<?php
}

?>