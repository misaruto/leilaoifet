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
if (!isset($_REQUEST['id'])) {
	?>
	<script type="text/javascript">
		alert('Nenhum comprador selecionado, por favor selecione um e volte');
		window.location.assign('./');
	</script>
	<?php
	die();
}
$id = $_REQUEST['id'];
include("mpdf60/mpdf.php");
include '../../configs.php';
$a = date('y') + 2000;
$query = "SELECT * FROM tbl_compradores WHERE id_comprador = '$id' and tbl_compradores.id_leilao = '$lid'";
$sql = mysqli_query($con, $query);
$comp = mysqli_fetch_object($sql);
if ($comp->id_procurador != 0) {
	$query = "SELECT * FROM tbl_compradores,tbl_procuradores WHERE id_comprador = '$id' and tbl_compradores.id_procurador = tbl_procuradores.id_procurador_ano and tbl_compradores.id_leilao = '$lid'";
	$sql = mysqli_query($con, $query);
	$comp = mysqli_fetch_object($sql);

}
$query = "SELECT dia,mes FROM tbl_tarefas WHERE nome = 'data do leilao'";
$sql = mysqli_query($con, $query);
$row = mysqli_fetch_object($sql);
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
$mes = $meses[$row->mes];
$dia = $row->dia;
if ($comp->cnpj != "") {
	$juridico = "
	<h2>
	Pessoa Jurídica
	</h2>
	<b>
	Contrato Social (ou equivalente)<br>
	</b>
	<table border=1 width=100%>
	<tr>
	<td colspan=2>
	NOME  ".$comp->nome_procurador."
	</td>
	</tr>
	<tr>
	<td colspan=2>
	CNPJ ".$comp->cnpj."
	</td>
	</tr>
	<tr>
	<td colspan=2>
	Cópia do Contrato Social (ou equivalente) anexada (".$comp->cs.") Sim	
	</td>
	</tr>
	<tr>
	<td colspan=2>
	NOME DO REPRESENTANTE LEGAL ".$comp->nome_representante."
	</td>
	</tr>
	<tr>
	<td>
	RG ".$comp->rg."
	</td>
	<td>
	CPF ".$comp->cpf."
	</td>
	</tr>	
	<tr>
	<td colspan=2>
	PROCURADOR (Se houver,anexar cópia da procuração)<br>
	NOME ".$comp->nome_procurador."
	</td>
	</tr>
	<tr>
	<td>
	RG ".$comp->rg_p."
	</td>
	<td>
	CPF ".$comp->cpf_p."
	</td>
	</tr>
	</table>
	";
}
else{ $juridico = "";}

$html = "<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
<font face=times>
<b>
<center>
<b>
&emsp;&emsp;&emsp;Instituto Federal de Educação, Ciências e Tecnologia do Sudeste de Minas Gerais <br>	
&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;	&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;Campus Rio Pomba
</b>
</center>
<br>
&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; LEILÃO ADMINISTRATIVO No. 01/".$a."
<br>
Dados Cadastrais de interessados em apresentar lances de compra durante o Leilão
Administrativo de bovinos descarte do Campus Rio Pomba, em ".$dia." de ".$mes." de ".$a."
<center>
<b>
NÚMERO ATRIBUÍDO AO CANDIDATO ARREMATANTE:
<u>&emsp;".$comp->id_comprador_leilao."&emsp;</u>
</b>
</center>
<h2>PESSOA FÍSICA</h2>
</b>
<table border=1 width=100%>
<tr>
<td colspan=2>
Nome ".$comp->nome_comprador."
</td>
</tr>
<tr>
<td>
RG ".$comp->rg."
</td>
<td>
CPF ".$comp->cpf."
</td>
</tr>
<tr>
<td colspan=2>
PROCURADOR (se houver, anexar cópia da procuração)<br>
NOME ".$comp->nome_procurador."
</td>
</tr>
<tr>
<td>
RG ".$comp->rg_p."
</td>
<td>
CPF ".$comp->cpf_p."
</td>
</tr>
</table>
<b>
<h3>
Endereço: <u>".$comp->endereco."&emsp;</u>
Bairro: <u>".$comp->bairro."</u>
<br>
Cidade: <U>".$comp->cidade."</U>&emsp;
Telefone: <u>".$comp->telefone."</u>
</h3>
</b>
".$juridico."
<br>
<b>Outros documentos anexados</b><br>
( ) Prova de regularidade fiscal perante a Fazenda Nacional <br>
( ) Prova de regularidade com o Fundo de Garantia do Tempo de Serviço <br>
( ) Prova de inexistência de débitos inadimplidos perante a justiça do trabalho <br>
Declaro serem verdadeiras as informações acima, e estar ciente de que: <br>
1. Os animais serão leiloados no estado em que se encontram, não cabendo ao Instituto Federal <br>	
de Educação, Ciências e Tecnologia do Sudeste de Minas Gerais, Campus Rio Pomba<br>
qualquer responsabilidade quanto a retirada, transporte e impostos.<br>
2. Os arrematantes dos bens deste Leilão se obrigam a, no prazo de 02 (dois) dias úteis do<br>
encerramento do certame, efetuar o pagamento relativo ao total do valor arrematado.<br>
3. Os animais arrematados devem ser retirados em até 05 (cinco) dias úteis a contar <br>da data de emissão da Autorização de Retirada de Animais.
<br><br>
Declaro ainda estar ciente de que o arrematante que não cumprir o disposto ficará sujeito a<br>
penalidades estabelecidas no Edital, nos termos da lei.<br>
&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;<b> Rio Pomba, ".$dia." de ".$mes." de ".$a."</b>
</font>
</body>
</html>";

if (isset($_REQUEST['salvar'])) {
	$a = date('y');
	$q = "SELECT MAX(id_documento_leialo) FROM tbl_documentos WHERE id_leilao = '$lid'";
	$res = mysqli_query($con, $q);
	$rr = mysqli_fetch_array($res);
	if (empty($rr)) {
		$id = 1;
	}
	else{
		$id = $rr['MAX(id_documento_leilao)'];
		$id = $id + 1;
	}
	$idc = $_COOKIE['compid'];
	$tipo = "application/pdf";
	$name =	'cad_comprador'.$idc.'.pdf';
	echo $name;
	$dest = "../documentos/";
	$pdf = $dest.$name;
	$query = "INSERT INTO `tbl_documentos`(`id_documento`, `id_documento_ano`, `nome`, `tipo`, `id_comprador`, `ano`) VALUES ('','$id','$name','$tipo','$_COOKIE[compid]','$a')";
	if (mysqli_query($con, $query)) {
		$doc =new mPDF();
		$doc->WriteHTML($html);
		ob_clean();
		$doc->Output('../documentos/cad_comprador'.$idc.'.pdf','F');
		exit;
		
		header('location:./?alert=1');	
	}
}
$mpdf=new mPDF(); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetTitle('comp_'.$row->id_comprador_leilao.'ano'.$row->ano);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
?>