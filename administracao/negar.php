<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
if ((!isset($_REQUEST['id']))&&(isset($_REQUEST['motivo']))&&(isset($_REQUEST['email']))&&(isset($_REQUEST['nome']))) {
	?>
	<script type="text/javascript">
		alert('Nenhuma requisição selecionada');
		window.location.assign('./');
	</script>
	<?php
}
$id = $_REQUEST['id'];
$n = $_REQUEST['nome'];
$email = $_REQUEST['email'];
$motivo = $_REQUEST['motivo'];

include '../configs.php';

//incluia a classe de enviar email
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
Motivo: '.$motivo.'
Seus dados serão apagados. Caso ache que foi uma má decisão,<br>
envie responda esse e-mail dizendo seus motivos. E refaça o seu cadastro.
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
	$query = "DELETE FROM tbl_administradores WHERE id_adm = '$id'";
	if (mysqli_query($query)) {
		?>
		<script type="text/javascript">
			alert('E-mail e usuario apagados com sucesso');
			window.location.assign('./');
		</script>
		<?php
	}
} 
else{ 

	echo "Houve um erro enviando o email: ".$mail->ErrorInfo; 
} 


?>