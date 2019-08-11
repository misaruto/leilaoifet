<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
	setcookie('leilaoid',$id);
	?>
	<script type="text/javascript">
		alert('Leilão selecionado com sucesso.');
		window.location.assign('./');
	</script>
	<?php
}
else{
	?>
	<script type="text/javascript">
		alert('Não foi possivel selecionar o Leilão.');
		window.location.assign('../leiloes');
	</script>
	<?php
}
?>