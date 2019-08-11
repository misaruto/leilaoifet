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
//
if (isset($_COOKIE['i'])) {
	$i = $_COOKIE['i'];
}
else{
	?>
	<script type="text/javascript">
		alert('Contador não encontrado. Volte e tente novamente');
		window.location.assign('./?pg=0');
	</script>
	<?php
}
if(isset($_COOKIE['id'])){
	$id = $_COOKIE['id'];
}
else{
	?>
	<script type="text/javascript">
		alert('Comprador não encontrado. Volte e tente novamente');
		window.location.assign('./?pg=0');
	</script>
	<?php
}
if (isset($_COOKIE['doc'.$i])) {
	$doc = $_COOKIE['doc'.$i];
	$i = $i+1;
	setcookie('i',$i);
}
else{
	header('location:documentos.php');
}


if (isset($_FILES['doc'])) {

	$prf='Prova de regularidade fiscal perante a Fazenda Nacional';
	$prfgts='Prova de regularidade com o Fundo de Garantia do Tempo de Serviço';
	$pid= 'Prova de inexistência de débitos inadimplidos perante a justiça do trabalho';
	$procuracao='Procuração';


	include '../../configs.php';
	$file = $_FILES['doc'];
	$query = "SELECT id_comprador FROM tbl_compradores WHERE id_comprador_leilao = '$id' AND id_leilao = '$lid'";
	$result = $mysqli->prepare($query);
	$result->execute();
	$result->bind_result($id);
	$result->fetch();
	$n = $file['name'];
	$ext = pathinfo($n);;
	$data = date('d-m-y');
	$nome = $doc.'-'.$data.'-'.$id;
	$nome = md5($nome);
	$nome_final = $nome.'.'.$ext['extension'];
	$destino = '../documentos/';
	$temp = $file['tmp_name'];	
	$a = date('y');
	if (move_uploaded_file($temp, $destino.$nome_final)) {
		$q = "SELECT MAX(id_documento_leilao) FROM tbl_documentos WHERE id_leilao = '$lid'";
		$res = mysqli_query($con, $q);
		$rr = mysqli_fetch_array($res);	
		if (empty($rr)) {
			$idd = 1;
		}
		else{
			$idd = $rr[0]  + 1;
		}


		if ($doc == 'pid') {
			$doc =  $pid;
		}
		if ($doc == 'prfgts') {
			$doc =  $prfgts;
		}
		if ($doc == 'prf') {
			$doc = $prf;
		}
		if ($doc == 'procuracao') {
			$doc =  $procuracao;
		}

		$query = "INSERT INTO `tbl_documentos`(`id_leilao`, `id_documento_leilao`, `nome`, `tipo`, `id_comprador`, `ano`,`nome_doc`) VALUES('$lid','$idd','$nome_final','$ext[extension]','$id','$a','$doc')";
		if (mysqli_query($con,$query)) {
			?>
			<script type="text/javascript">
				alert('Documento salvo com sucesso');
				window.location.assign('./documentos.php');
			</script>
			<?php
		}
		else{
			?>
			<script type="text/javascript">
				alert('Erro ao salvar no banco de dados');
				window.location.assign('./documentos.php');
			</script>
			<?php
		}
	}
	else{
		?>
		<script type="text/javascript">
			alert('Erro ao enviar o arquivo. Tente novamente');
			window.location.assign('./documentos.php');
		</script>
		<?php
	}

}
?>