<?php 
if (isset($_REQUEST['codigo'])&& isset($_COOKIE['cpf'])) {
	include './configs.php';
	$codigo = $_REQUEST['codigo'];
	$cpf = $_COOKIE['cpf'];
	$query = "SELECT codigo,id_adm FROM tbl_administradores WHERE cpf = '$cpf' ";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_object($result);
	if ($row->codigo == $codigo) {
		$query = "UPDATE tbl_administradores SET confirmado = 1 WHERE id_adm = '$row->id_adm'";
		if (mysqli_query($con, $query)) {
			setcookie('cpf','');
			?>
			<script type="text/javascript">
				alert('E-mail verificado com sucesso. Aguarde até uma administrador aprovar seu login, você receberá um e-mail avisando a aprovação.');
				window.location.assign('./');
			</script>
			<?php
		}
		else{
			?>
			<script type="text/javascript">
				alert('O codigo informado não confere, tente novamente.');
				window.location.assign('./codigo.php?cpf=<?=$cpf?>');
			</script>
			<?php
		}
	}
	else{
		?>
		<script type="text/javascript">
			alert('O codigo informado não confere, tente novamente.');
			window.location.assign('./codigo.php?cpf=<?=$cpf?>');
		</script>
		<?php
	}
}
?>
<script type="text/javascript">
	alert('Usuário ou código não enviados tente novamente.');
	window.location.assign('./codigo.php');
</script>
<?php

?>