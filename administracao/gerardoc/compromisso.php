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
if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
}
else{
	header('location:./?pg=2');
}

$meses = array(
	1 => 'Janeiro',
	'Fevereiro',
	'Março',
	'Abril',
	'Maio',
	'Junho',
	'Julho',
	'Agosto',
	'Setembro',
	'Outubro',
	'Novembro',
	'Dezembro'
);
$m = date('m');
for ($i=0; $i <= $m ; $i++) { 
	if ($m == $i) {
		$m = $i;
	}
}
$mes = $meses[$m];


include '../../configs.php';
include("mpdf60/mpdf.php");

$query = "SELECT * FROM `tbl_comprador-lote`,tbl_compradores,tbl_lotes,tbl_leiloes WHERE `tbl_comprador-lote`.id_lote = `tbl_lotes`.id_lote AND `tbl_comprador-lote`.`id_comprador` = `tbl_compradores`.id_comprador AND `tbl_comprador-lote`.`id` = '$id' AND `tbl_comprador-lote`.id_leilao = tbl_leiloes.id";

$sql = mysqli_query($con, $query);
$row = mysqli_fetch_object($sql);

$id_cl = $row->id; 

$header = "<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>

<title></title>
</head>
<body>
<div>

<h4 align='center'>
ANEXO II
<br>
COMPROMISSO DE COMPRA E VENDA
</h4>
<div><font size='24px'>	O arrematante ".$row->nome_comprador.", devidamente identificado na NOTA DE LEILÃO N° ".$row->id_comprador_leilao." - ".date("d/m/Y", strtotime($row->data)).", tendo em vista sua arrematação no Leilão Administrativo N° ".$row->numero."/".$row->ano.", LOTE N°: ".$row->id_lote_leilao.", composto ";

$query = "SELECT * FROM `tbl_item_lotes`,`tbl_animais` WHERE id_lote ='$row->id_lote' AND tbl_item_lotes.id_animal = tbl_animais.id_animal";
$sql = mysqli_query($con, $query);

$tamanho = mysqli_num_rows($sql);
if ($tamanho == 1) {
	$animais = mysqli_fetch_object($sql);
	$body = "pelo animal de nome <u>".$animais->nome." (brinco ".$animais->brinco.")</u>";
}
else{
	$body = "pelos animais de nomes";
	while ($animais = mysqli_fetch_object($sql)) {
		$body = $body." <u>".$animais->nome_animal." (brinco ".$animais->brinco.")</u>,";
	}
}
$body = $body." pelo valor de R$ ".$row->valor.",00 (".$row->valor_extenso." reais),";
$body = $body." firma com o Campus Rio Pomba do IF Sudeste MG, neste ato representado pelo seu Coordenador Geral de Produção, Tharcísio Alexandrino Caldeira, o presente Compromisso de Compra e Venda, mediante as seguintes cláusulas e condições:
<br><br>
1. O arrematante obriga-se, de forma definitiva e irrecorrível, a acatar as disposições do Edital de Leilão N°".$row->numero."/".$row->ano.", o qual é tido como de seu pleno conhecimento, não cabendo qualquer alegação para o seu não cumprimento, conforme disposto no Artigo 3o da Lei de Introdução ao Código Civil.
<br><br>
2. Os arrematantes dos bens deste Leilão se obrigam a, no prazo de 02 (dois) dias úteis do encerramento do certame, efetuar o pagamento relativo ao total do valor arrematado, previsto no Edital, através de depósito a Conta Única do Tesouro Nacional na Rede Bancária credenciada, mediante Guia de Recolhimento da União – GRU. Os arrematantes ficam sujeitos ao pagamento de multa moratória, correspondente a 1% um (um por cento) por dia de atraso, até o limite de 10 (dez) dias úteis, quando será considerada anulada a alienação, sendo aplicadas as penalidades previstas no Edital.
<br><br>
3. Os animais arrematados ficarão à disposição dos compradores no Campus Rio Pomba do IF Sudeste MG, situado à Avenida Doutor José Sebastião da Paixão, s/no, Bairro Lindo Vale, Rio Pomba-MG, podendo ser retirados mediante a apresentação da Autorização de Retirada de Animais, emitida pela Comissão de Leilão.
<br><br>
4. Após a emissão da Autorização de Retirada de Animais, a retirada dos animais arrematados será feita em até cinco dias úteis (de acordo com o Edital), somente em dias úteis, nos horários compreendidos entre 8:00 e 10:00 horas e entre 13:00 e 16:00 horas, após o arrematante haver cumprido todas as condições mencionadas no Edital de Leilão N° ".$row->numero."/".$row->ano.", inclusive estar de posse dos documentos necessários para o transporte dos animais: Nota Fiscal e GTA (Guia de Transporte de Animal).
<br><br>
5. Em caso de descumprimento dos compromissos assumidos, assim como a não retirada do(s) animal(is) arrematado(s) do Campus Rio Pomba do IF Sudeste MG nos prazos fixados neste Edital, os arrematantes ficam sujeitos ao pagamento de multa moratória, correspondente a 1% um (um por cento) por dia de atraso, até o limite de 10 (dez) dias úteis, quando será considerada anulada a alienação, sem a restituição de valores pagos.
<br><br>
6.Serão de responsabilidade do arrematante quaisquer impostos e taxas incidentes na alienação.
<br><br>
7. As obrigações decorrentes deste compromisso são válidas para os promitentes, seus herdeiros e sucessores.
<br><br><br><br><br><br><br><br>
E, por estarem justas e acordes, as partes assinam o presente instrumento em 03 (três) vias de igual forma e teor, na presença das testemunhas abaixo identificadas.";
$foot = "
<br>
<br>
</div>
<center>
<table border='0' width='100%'>
	<tr>
		<td colspan='2'>
			<center>
				Rio Pomba, ".date('d')." de ".$mes." de ".(2000+date('y'))."
			</center>
		</td>
	</tr>
	<tr>
	<td colspan='2'>
			<br>
		</td>
	</tr>
	<tr>
		<td width='50%'>
			<center>
			_________________________________ 
			<br>
			Tharcísio Alexandrino Caldeira 
			<br>
			Coordenador Geral de Produção
			</center>
		</td>
		<td width='50%'>
			<center>
			_________________________________
			<br>
			".$row->nome_comprador."
			<br>
			Arrematante
			</center>
		</td>
	</tr>
	<tr>
		<td colspan='2'>
		<br>
			Testemunhas:
			<br>
			<br>	
		</td>
	</tr>
	<tr>
		<td>
			<center>
			_________________________________
			<br>
			Testemunha <br>
			<br>
			CPF: ____.____.____-___
			</center>
		</td>
		<td>

			<center>
			_________________________________ 
			<br>
			Testemunha <br>
			<br>
			CPF: ____.____.____-___
			</center>
		</td>
	</tr>
</table>
</center>

</center>
</div>
</body>
</html>";

$title = 'compromisso_'.$id;

$html = $header.$body.$foot;

$mpdf= new mPDF(); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetTitle($title);
$mpdf->WriteHTML($html);
$mpdf->Output();
?>