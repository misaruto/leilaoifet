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
$i = 0;
$l1 = 0;
include '../../configs.php';
include("mpdf60/mpdf.php");
$sql_lotes = "SELECT * FROM tbl_lotes where id_leilao = '$lid'";
$query_lotes = mysqli_query($con,$sql_lotes);
//escolhe o lote
while ($row_lotes = mysqli_fetch_object($query_lotes)) {
	//query para descobrir o valor do lote

	$sql_v_l = "SELECT * FROM tbl_lotes, tbl_item_lotes, tbl_avaliacoes WHERE tbl_item_lotes.id_animal = tbl_avaliacoes.id_animal AND tbl_lotes.id_lote = '$row_lotes->id_lote' AND tbl_item_lotes.id_lote = '$row_lotes->id_lote'";
	$query_v_l = mysqli_query($con, $sql_v_l);
	$valor_lote = 0;

	while ($row_v_l = mysqli_fetch_object($query_v_l)) {
		$valor_lote = $valor_lote + $row_v_l->avaliacao_corrigida;

	}


	//descobre a quantidae de animais no lote
	$sql_n_l = "SELECT * FROM tbl_item_lotes WHERE id_lote = '$row_lotes->id_lote'";
	$query_n_l = mysqli_query($con,$sql_n_l);
	$n_l = mysqli_num_rows($query_n_l);

	//query para dados do animal que pertence ao lote
	$sql = "SELECT * FROM tbl_item_lotes, tbl_animais, tbl_avaliacoes WHERE tbl_animais.id_animal = tbl_item_lotes.id_animal AND tbl_item_lotes.id_lote = '$row_lotes->id_lote' AND tbl_item_lotes.id_animal = tbl_avaliacoes.id_animal";
	$td1="<td rowspan=".$n_l."><center>".$row_lotes->id_lote_leilao."</td>";
	$tdf="<td rowspan=".$n_l."><center>".$valor_lote.",00</td>";
	$query = mysqli_query($con, $sql);
	$x = 0;
	//cria a parte dos td da tablea
	if ($row_lotes->desmembrado == 1) {
		$tdf= '<td rowspan='.$n_l.' bgcolor="#ff8d8d"><center><div class="desm">DESMEMBRADO</div></center></td>';
	}
	while ($row = mysqli_fetch_object($query)) {
		$i = $i+1;
		if ($l1 != $row_lotes->id_lote) {
			$l1 = $row_lotes->id_lote;
			if ($row_lotes->nome == "") {
				$nome = '<tr class="nome"><td colspan=10> <center>Lote sem nome</center></td></tr>';
			}
			else{
				$nome = '<tr class="nome"><td colspan=2>Nome</td><td colspan=8> <center>'.$row_lotes->nome.'</center></td></tr>';
			}
		}
		else{
			$nome = "";
		}
		$l = $row_lotes->id_lote_leilao %2;
		$tr = "<tr>";
		if ($l !=0) {
			$tr = "<tr bgcolor='#ededed'>";
		}
		if ($x < $n_l && $x==0) {
			$tdln = $td1;
			$tdlf = $tdf;

		}
		else{
			$tdln = "";
			$tdlf = "";
		}
		
		$nascimento = date('d/m/Y', strtotime($row->nascimento));
		$x = $x+1;
		$td[$i]="".$nome.$tr.$tdln."
		<td>
		<center>
		".$row->id_animal_leilao."
		</td>
		<td><center>
		".$row->brinco."
		</td>
		<td><center>
		".$row->nome_animal."
		</td>
		<td><center>
		".$row->raca."
		</td>
		<td><center>
		".$nascimento."
		</td>
		<td><center>
		".$row->peso."
		</td>
		<td><center>
		".$row->data_pesagem."
		</td>
		<td><center>
		".$row->avaliacao_corrigida.",00
		</td>
		".$tdlf.
		"</tr>"
		;
	}
}

$thead = "
<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' type='text/css' href='style.css'>
<title></title>
</head>
<body>
<center>
<table class='table' border=1>
<tr>
<th>
<center>
Lote <br>
N°
</center>
</th>
<th>
<center>
Animal <br>
N°
</center>
</th>
<th>
<center>
Brinco
</center>
</th>
<th>
<center>
Nome do animal
</center>
</th>
<th>
<center>
Raça
</center>
</th>
<th>
<center>
Data de
nascimento
</center>
</th>
<th>
<center>
Peso
<br> Kg
</center>
</th>
<th>
<center>
Data Pesagem
</center>
</th>
<th>
<center>
Valor minimo
Individual <br>	
<br>	R$
</center>
</th>
<th>
<center>
Valor Minimo <br>
do Lote
<br> R$
</center>
</th>
</tr>
";
$tfoot='
</table>
</center>
</body>
</html>
';
$tbody='';

for ($x=0; $x <= $i ; $x++) { 
	$tbody = $tbody.$td[$x];
}

$html = $thead.$tbody.$tfoot;
$mpdf=new mPDF('utf-8','A4-L'); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);
$mpdf->Output();
//	echo "$html";
exit;
?>