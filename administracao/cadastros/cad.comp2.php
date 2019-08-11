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
 $idp = "";
 if ((isset($_POST['proc']))&&(isset($_POST['nomep']))&&(isset($_POST['pcpf']))&&(isset($_POST['rgp']))) {

 	$a = date('y');
 	$q = "SELECT MAX(id_procurador_leilao) FROM tbl_procuradores WHERE id_leilao = '$lid'";
 	$res = mysqli_query($con, $q);
 	$rr = mysqli_fetch_array($res);
 	if (empty($rr)) {
 		$id = 1;
 	}
 	else{
 		$id = $rr[0] + 1;
 	}
 	$np = $_POST['nomep'];
 	$cp = $_POST['pcpf'];
 	$rgp = $_POST['rgp'];
 	if (($np != "")&&($cp != "")&&($rgp != "")) {

 		$sql = "INSERT INTO `tbl_procuradores`( `id_leilao`, `id_procurador_leilao`, `nome_procurador`, `rg`, `cpf`) VALUES ('$lid','$id', '$np', '$rgp', '$cp')"; 
 		if (mysqli_query($con, $sql)) {
 			$idp = $idp + 1;
 		}
 	}
 }

 if ((isset($_POST['nome']))&&(isset($_POST['tel']))&&(isset($_POST['end']))&&(isset($_POST['cpf']))&&(isset($_POST['rg']))&&(isset($_POST['estado']))&&(isset($_POST['cidade']))&&(isset($_POST['data']))) {	

 	$n = $_POST['nome'];
 	$tel =  $_POST['tel'];
 	$end = $_POST['end'];
 	$cpf = $_POST['cpf'];
 	$rg = $_POST['rg'];
 	$e = $_POST['estado'];
 	$c = $_POST['cidade'];
 	$data = $_POST['data'];

 	if (isset($_POST['cnpj'])&& $_POST['cnpj'] != "") {
 		$cnpj = $_POST['cnpj'];
 	}


 	else{
 		$cnpj = "";
 	}


 	$a = date('y');
 	$q = "SELECT MAX(id_comprador_leilao) FROM tbl_compradores WHERE id_leilao = '$lid'";
 	$res = mysqli_query($con, $q);
 	$rr = mysqli_fetch_array($res);	

 	if (empty($rr)) {
 		$id = 1;
 	}


 	else{
 		$id = $rr[0]  + 1;
 	}
 	$data_nota = date('m-d-y');
 	if (($n!="")&& ($cpf!="") && ($tel != "") &&($rg !="")) {

 		$query = "INSERT INTO `tbl_compradores`(`id_leilao`,`id_comprador_leilao`, `nome_comprador`, `login`, `senha`, `telefone`, `endereco`, `cpf`, `rg`, `cnpj`, `id_procurador`, `estado`, `cidade`, `ano`,`nascimento`,`data`) VALUES ('$lid','$id', '$n', '-', '-', '$tel', '$end', '$cpf', '$rg', '$cnpj', '$idp', '$e', '$c','$a','$data','$data_nota')";
 		if (mysqli_query($con, $query)) {
 			setcookie('id',$id);
 			if (isset($_POST['documentos'])) {
 				$doc = $_POST['documentos'];
 				$i = 0;
 				setcookie('i',$i);
 				foreach ($doc as $key) {
 					setcookie('doc'.$i,$key);
 					$i = $i+1;
 				}
 				header('location:./documentos.php');
 			}
 			else{
 				?>
 				<script type="text/javascript">
 					alert('Comprador salvo com sucesso.');
 					window.location.assign('./?pg=0');
 				</script>
 				<?php
 			}
 			
 		}
 		else{
 			?>
 			<script type="text/javascript">
 				alert('Erro ao cadastrar. Tente novamente, se o erro persistir contate o desenvolvedor');
 				window.location.assign('./?pg=0');
 			</script>
 			<?php
 		}
 	}
 	else{
 		?>
 		<script type="text/javascript">
 			alert('Algum dos campos importante (CPF, RG, telefone, ou nome) estão vazios. Temte novamente');
 			window.location.assign('./?pg=0');
 		</script>
 		<?php
 	}
 }
 else{
 	?>
 	<script type="text/javascript">
 		alert('Alguns dos campos não foram recebidos. Tente novamente, se o erro persistir contate o desenvolvedor.');
 		window.location.assign('./?pg=0');
 	</script>
 	<?php
 }
 ?>