<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
if ((isset($_REQUEST['nome']))&&(isset($_REQUEST['desc']))&&(isset($_REQUEST['data']))&&(isset($_REQUEST['tipo']))&&(isset($_REQUEST['numero']))&&(isset($_REQUEST['ano']))){
	include '../../configs.php';
	$t = $_REQUEST['tipo'];
	$desc = $_REQUEST['desc'];
	$data = $_REQUEST['data'];
	$n = $_REQUEST['nome'];
	$a = $_REQUEST['ano'];
	$numero = $_REQUEST['numero'];	
	if (($t != "")&&($n != "")&&($data != "")) {
		$sql = "INSERT INTO `tbl_leiloes`(`id`, `nome`, `id_tipo`, `data`, `descricao`,`numero`,`ano`) VALUES ('','$n','$t','$data','$desc','$numero','$a')";
		if (mysqli_query($con,$sql)) {
			?>
			<script type="text/javascript">
				alert('Leilão cadastrado com sucesso. Vocẽ será redirecionado à pagina inicial');
				window.location.assign('../');
			</script>
			<?php
		}
	}
}
?>