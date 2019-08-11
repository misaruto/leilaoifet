<?php
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
if (!isset($_COOKIE['leilaoid'])) {
	?>
	<script type="text/javascript">
		alert('Nenhum leilão selecionado, por favor selecione um e volte');
		window.location.assign('../leiloes');
	</script>
	<?php
}
else{
	$lid = $_COOKIE['leilaoid'];
}

include '../../configs.php';
if (isset($_REQUEST['apagar'])) {
	$id = $_REQUEST['apagar'];
	for ($i=0; $i <=20 ; $i++) {
		if (isset($_COOKIE['lote'.$i])) {
			if ($_COOKIE['lote'.$i] == $id) {
				setcookie('lote'.$i, '');
				$i = 21;
				header('location:./?pg=1');
			}
		} 
	}
}
if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
	for ($i=0; $i <= 20; $i++) { 
		if (isset($_COOKIE['lote'.$i])) {
		}
		else{
			setcookie('lote'.$i,$id);
			header('location:./?pg=1');
			$i = 21;
		}
	}
}
if (isset($_REQUEST['salvar'])) {

	if (isset($_COOKIE['compid'])) {
		$compid = $_COOKIE['compid'];
		setcookie('compid','');
		$fim = 0;
		for ($i=0; $i <=20 ; $i++) { 
			if (isset($_COOKIE['lote'.$i])&&(isset($_REQUEST['valor'.$i]))&&(isset($_REQUEST['valor-extenso'.$i]))) {

				$loteid = $_COOKIE['lote'.$i];
				$v = $_REQUEST['valor'.$i];
				$v_e = $_REQUEST['valor-extenso'.$i];
				setcookie('lote'.$i,'');
				$query = "INSERT INTO `tbl_comprador-lote`(`id_comprador`, `id_lote`, `valor`, `valor_extenso`, `id_leilao`) VALUES('$compid','$loteid', '$v', '$v_e', '$lid')";

				if (mysqli_query($con, $query)) {
					$query = "UPDATE `tbl_lotes` SET `leiloado`= '1' WHERE id_lote = '$loteid'";
					if (mysqli_query($con,$query)) {
						$fim = $fim +1;
					}
					else{
						echo "Erro ao alterar o lote ".$loteid." pra leiloado";
					}
				}
				else{
					echo "O lote ".$loteid." não foi salvo";
				}
			}
		}
		?>	
		<script type="text/javascript">
			alert('Comprador e lotes salvos com sucesso');
			window.location.assign('./');
		</script>
		<?php
	}
	else{
		header('location:./');
	}	
}
else{
	header('location:./?pg=1');
}
?>