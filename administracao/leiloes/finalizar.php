<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
if (!(isset($_REQUEST['id']))&&(!isset($_REQUEST['data']))) {
	?>
	<script type="text/javascript">
		alert('Data ou leilão não identificados');
		window.location.assign('./');
	</script>
	<?php
}
include '../../configs.php';
$id = $_REQUEST['id'];
$data = $_REQUEST['data'];
$query = "UPDATE `tbl_leiloes` SET `finalizado`= '1',`data_finalizado`= '$data' WHERE id = '$id'";
//echo "$query";
if (mysqli_query($con, $query)) {
	?>
	<script type="text/javascript">
		alert('leilão finalizado com sucesso.');
		window.location.assign('./');
	</script>
	<?php
}
else{
	?>
	<script type="text/javascript">
		alert('Não foi possivel finalizar o leilão.');
		window.location.assign('./');
	</script>
	<?php
}
?>