<?php 
if ((isset($_REQUEST['nome']))&&(isset($_REQUEST['email']))&&(isset($_REQUEST['msg']))) {
	$n = $_REQUEST['nome'];
	$e = $_REQUEST['email'];
	$m = $_REQUEST['msg'];
	if (($n != "")&&($e != "")&&($m != "")) {
		include 'configs.php';
		$a = date('y');
		$q = "SELECT MAX(id_feedback_ano) FROM tbl_feedback WHERE ano = '$a'";
		$r1 = mysqli_query($con, $q);
		$res = mysqli_fetch_array($r1);
		if (empty($res)) {
			$id = 1;
		}
		else{
			$id = $res['MAX(id_feedback_ano)'] + 1;
		}
		$m = str_replace("'","\"",$m);
		$sql = "INSERT INTO `tbl_feedback`(`id_feedback_ano`, `nome`, `email`, `msg`, `ano`) VALUES ('$id','$n','$e','$m','$a')";
		if (mysqli_query($con, $sql)) {
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
			Obrigado pelo FeedBack.
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
			$mail->SMTPDebug = 0; /* Debugar: 1 = erros e mensagens, 2 = mensagens apenas*/
			$mail->SMTPAuth = true; /* Autenticação ativada */
			$mail->SMTPSecure = 'tls'; /* TLS REQUERIDO pelo GMail*/
			$mail->Host = 'smtp.gmail.com'; /* SMTP utilizado*/
			$mail->Port = 587; /* A porta 465 deverá estar aberta em seu servidor*/
			$mail->Username = 'leilaoifet@gmail.com';
			$mail->Password = '@leilao123';
			$mail->CharSet = 'UTF-8'; 
			$mail->SetFrom(GUSER,'Leilão IF Sudeste - MG Campus Rio Pomba');
			$mail->Subject = "Confirmação de recebimento de FeedBack";
			$mail->Body = $body;
			$mail->AddAddress($e);
			$mail->IsHTML(true);




// Opcional: Anexos 
// $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf"); 

// Envia o e-mail 
			$enviado = $mail->Send(); 

// Exibe uma mensagem de resultado 
			if ($enviado){

				$body = '<!DOCTYPE html>
				<html>
				<head>
				<meta charset="utf-8">
				<title></title>
				</head>
				<body>
				<center>
				Eniado por: '.$n.'<br>
				Mensagem:<br>
				'.$m.'
				</center>
				</body>
				</html>'; 

				$mail->IsSMTP(); /* Ativar SMTP*/
				$mail->SMTPDebug = 0; /* Debugar: 1 = erros e mensagens, 2 = mensagens apenas*/
				$mail->SMTPAuth = true; /* Autenticação ativada */
				$mail->SMTPSecure = 'tls'; /* TLS REQUERIDO pelo GMail*/
				$mail->Host = 'smtp.gmail.com'; /* SMTP utilizado*/
				$mail->Port = 587; /* A porta 465 deverá estar aberta em seu servidor*/
				$mail->Username = 'leilaoifet@gmail.com';
				$mail->Password = '@leilao123';
				$mail->CharSet = 'UTF-8'; 
				$mail->SetFrom(GUSER,'Leilão IF Sudeste - MG Campus Rio Pomba');
				$mail->Subject = "Recebimento de FeedBack";
				$mail->Body = $body;
				$mail->AddAddress('misaelg.freitas2000@gmail.com');
				$mail->IsHTML(true);

				if ($mail->Send()) {
					?>
					<script type="text/javascript">
						alert('FeedBack enviado com sucesso!!!');
						window.location.assign('./');
					</script>
					<?php
				}
				else{
					?>
					<script type="text/javascript">
						alert('Houve um erro ao enviar o E-mail');
						window.location.assign('./');
					</script>
					<?php
				}
				
			} 
			else { 
				?>
				<script type="text/javascript">
					alert('Houve um erro ao enviar o E-mail');
					window.location.assign('./');
				</script>
				<?php
			} 
		}
		else{
			?>
			<script type="text/javascript">
				alert('Houve um erro ao salvar o FeedBack 3');
				//window.location.assign('./');
			</script>
			<?php
		}
	}
	else{
		?>
		<script type="text/javascript">
			alert('Houve um erro ao salvar o FeedBack 2');
			//window.location.assign('./');
		</script>
		<?php
	}

}
else{
	?>
	<script type="text/javascript">
		alert('Houve um erro ao salvar o FeedBack 1');
		//window.location.assign('./');
	</script>
	<?php
}

?>
