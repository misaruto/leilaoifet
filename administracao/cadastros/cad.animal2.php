<?php
if (!isset($_COOKIE['admid'])) {
	header('location:./././?pg=2');
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
if ((isset($_REQUEST['nome']))&&(isset($_REQUEST['raca']))&&(isset($_REQUEST['peso']))&&(isset($_REQUEST['datap']))&&(isset($_REQUEST['datan']))&&(isset($_REQUEST['brinco']))&&(isset($_REQUEST['desc']))) {
	$n = $_REQUEST['nome'];
	$p =  $_REQUEST['peso'];
	$r = $_REQUEST['raca'];
	$b = $_REQUEST['brinco'];
	$dp = $_REQUEST['datap'];
	$dn = $_REQUEST['datan'];
	$d = $_REQUEST['desc']; 
	if (($n != "")&&($p != "")&&($r != "")&&($b != "")&&($dp != "")&&($dn != "")&&($d != "")) {
		include '../../configs.php';
		$a = date('y');
		$q = "SELECT MAX(id_animal_leilao) FROM tbl_animal WHERE id_leilao = '$lid'";
		$res = mysqli_query($con, $q);
		$r = mysqli_fetch_array($res);
		if (empty($r)) {
			$id = 1;
		}
		else{
			$id = $r[0] + 1;
		}

		$query = "INSERT INTO `tbl_animais`(`id_animal`,`id_leilao`,`id_animal_leilao`, `nome_animal`, `brinco`, `peso`, `data_pesagem`, `nascimento`, `raca`, `descricao`, `ano`, `avaliado`) VALUES ('','$lid','$id','$n','$b','$p','$dp','$dn','$r','$d','$a','0')";
		if (mysqli_query($con, $query)) {
			?>
			<div class="alert alert-success" role="alert">
				Cadastro Realizado com sucesso!!! <br>
				<a href="./?pg=2" class="alert-link">Cadastrar outro</a>
				Ou ver o animal cadastrado <a class="alert-link" href="../listas?pg=2&id=<?=$id?>">Clique aqui</a>
			</div>
			<?php
		}
		else{
			echo '
			<div class=alert alert-danger role=alert>
			Animal não cadastrado. 
			<a href=pg=2&n='.$n.'&p='.$p.'&r='.$r.'&b='.$b.'&dp='.$dp.'&dn='.$dn.'&d='.$d.' class=alert-link>Voltar e tentar novamente
			</a>
			</div>';
		}
	}
	else{
		header('location:./?pg=2&n='.$n.'&p='.$p.'&r='.$r.'&b='.$b.'&dp='.$dp.'&dn='.$dn.'&d='.$d);
	}
}
else{
	header('location:./?pg=2');	
}
?>	