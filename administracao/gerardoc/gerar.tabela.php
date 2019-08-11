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

include("mpdf60/mpdf.php");
include '../../configs.php';
$a = date('y') + 2000;
$query = "SELECT data_pesagem FROM tbl_animais WHERE id_leilao = '$lid' AND id_animal_leilao= 1";
$sql =mysqli_query($con, $query);
$row = mysqli_fetch_object($sql);
$query_leilao = "SELECT * FROM tbl_leiloes WHERE id = '$lid'";
$sql_leilao = mysqli_query($con,$query_leilao);
$row_leilao = mysqli_fetch_object($sql_leilao);

$html = "
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
	<font size=30>
			<b>
				Avaliação dos Animais <br>
				Leilão Administrativo Nº. ".$row_leilao->numero."/".$row_leilao->ano."
			</b>
		</font>
	</center>
	<table border=1 width=100%>";

		$htmlf = "</table>
	</body>
	</html>";
	$thead="
	<thead>
		<tr>
			<td>
			<center>
				N°
			</center>
			</td>
			<td>
			<center>
				Brinco
			</center>	
			</td>
			<td>
			<center>
			Nome
			</center>
			</td>
			<td>
			<center>
				Raça
			</center>
			</td>
			<td>
			<center>
			Data de <br>
			Nascimento
			</center>
				
			</td>
			<td>
				<center>
				Peso (KG) vivo em <br>
				".$row->data_pesagem."
				
				</center>
			</td>
			<td>
			<center>
			Valor R$ <br>
				Avaliador ".$_REQUEST['av']." R$
			</center>
			</td>
		</tr>
	</thead>
	";
	$query = "SELECT * FROM tbl_animais WHERE id_leilao = '$lid'";
	$sql = mysqli_query($con,$query);
$a = 0;
	while ($row = mysqli_fetch_object($sql)) {
		$a = $a +1;
		$table[] = "
		<tr>
			<td>
			<center>
				".$row->id_animal_leilao."
			</td>
			<td>
			<center>
				".$row->brinco."
			</td>
			<td>
			<center>
				".$row->nome_animal."
			</td>
			<td>
			<center>
				".$row->raca."
			</td>
			<td>
			<center>
				".$row->nascimento."
			</td>
			<td>
			<center>
				".$row->peso."
			</td>
			<td width=120px>
				&emsp;
				<br>
				&emsp;
			</td>
		</tr>";
	}
	$html = $html.$thead;
	for ($i=0; $i <=$a ; $i++) { 
		$body = $body.$table[$i];
	}
	$html = $html.$body.$htmlf;

	$mpdf=new mPDF(); 
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->SetTitle('lotes'.$row_leilao->numero.'/'.$row_leilao->ano);
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	exit;
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<link rel="shortcut icon" href="../../../imagens/favicon.ico" type="image/x-icon" />
	</head>
	<body>
	
	</body>
	</html>