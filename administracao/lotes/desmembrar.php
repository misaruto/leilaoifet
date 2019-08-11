<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
$id = $_COOKIE['admid'];
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
//verifica se o leilão já foi finalizado.
$q = "SELECT finalizado FROM tbl_leiloes WHERE id = '$lid'";
$r = mysqli_query($con, $q);
$f = mysqli_fetch_object($r);
if ($f->finalizado == 1) {
	?>
	<script type="text/javascript">
		alert('leilão finalizado. Não é possivel modificar os lotes.');
		window.location.assign('./');
	</script>
	<?php
}

if (!isset($_REQUEST['id'])) {
	?>
	<script type="text/javascript">
		alert('Nenhum lote selecionado, por favor selecione um e volte');
		window.location.assign('./');
	</script>
	<?php
}
$idl = $_REQUEST['id'];



$a = date('y');
$data = date('d-m-y');
$query = "SELECT * FROM tbl_item_lotes,tbl_animais WHERE id_lote = '$idl' AND tbl_animais.id_animal = tbl_item_lotes.id_animal";
$result = mysqli_query($con, $query);
//varievel que se incrementa a cada erro ocorrido.
$e = 0;
//variavel que incrementa a cada acerto.
$i = 0;
//variavel que representa o total de animais que tem o lote

$total = mysqli_num_rows($result);
echo "$total";
while ($row = mysqli_fetch_object($result)) {

	//insere na tabela de desmembramentos
	$query = "INSERT INTO `tbl_desmembramentos`(`id_lote_anterior`, `id_item`, `data`, `id_adm`,`id_leilao`) VALUES ('$idl','$row->id_item','$data','$id','$lid')";

	if (mysqli_query($con,$query)) {

		//descobre o id do ultimo desmembramento acionado, o que foi realizado no if anterior.
		$q = "SELECT MAX(id_desm) FROM tbl_desmembramentos WHERE id_leilao = '$lid' AND id_lote_anterior = '$idl'";
		$res = mysqli_query($con, $q);
		$rr = mysqli_fetch_array($res);
		if (empty($rr)) {
			$desm = 1;
		}
		else{
			$desm = $rr['MAX(id_desm)'] + 1;
		}

		//atualiza o registro do lote anterior
		$query = "UPDATE `tbl_lotes` SET `desmembrado`='1',`id_desmembramento`='$desm' WHERE id_lote = '$idl'";
		if (mysqli_query($con,$query)) {
			//atualiza o status do animal referente ao lote anterior, declarando que não pertence mais a aquele lote.
			$query = "UPDATE tbl_item_lotes SET desmembrado = '1' WHERE id_item = '$row->id_item'";

			if (mysqli_query($con,$query)) {
				
			//descobre qual o novo id do lote de acordo com o leilao, deve acontecer a cada novo lote criado
				$q = "SELECT MAX(id_lote_leilao) FROM tbl_lotes WHERE id_leilao = '$lid'";
				$res = mysqli_query($con, $q);
				$rr = mysqli_fetch_array($res);
				if (empty($rr)) {
					$lote = 1;
				}
				else{
					$lote = $rr['MAX(id_lote_leilao)'] + 1;
				}
				//pega o nome do antigo lote
				$q = "SELECT nome FROM tbl_lotes WHERE id_lote = '$idl'";
				$res = mysqli_query($con, $q);
				$rr = mysqli_fetch_array($res);
				$nome = $rr['nome'];
			//cria o novo lote que comportará o animal
				$query = "INSERT INTO `tbl_lotes`(`id_leilao`, `id_lote_leilao`, `nome`, `leiloado`, `desmembrado`, `ano`, `id_desmembramento`) VALUES('$lid','$lote','".$nome." - desmembrado','0','0','$a','$desm')";
				if (mysqli_query($con,$query)) {

					//pega o id do lote que acaba de ser criado
					$q = "SELECT MAX(id_lote) FROM tbl_lotes WHERE id_leilao = '$lid' AND id_lote_leilao = '$lote'";
					$res = mysqli_query($con, $q);
					$rr = mysqli_fetch_array($res);
					if (empty($rr)) {
						$idlote = 1;
					}
					else{
						$idlote = $rr['MAX(id_lote)'];
					}
					//adciona o animal a esse novo lote.
					$query = "INSERT INTO `tbl_item_lotes` (`id_animal`, `id_lote`, `desmembrado`, `ano`) VALUES ('".$row->id_animal."','$idlote','0','$a')";
					
					if (mysqli_query($con,$query)) {
						$i = $i +1;
						if (($e == 0) && ($total == $i)) {
							?>
							<script type="text/javascript">
								alert('Lote desmembrado.');
								window.location.assign('./');
							</script>
							<?php
						}
					}
					else{
						$e = $e +1;
						//echo "<br>$query <br>";
						echo "erro 6";
					}
				}
				else{
					$e = $e +1;
					//echo "$query <br>";
					echo "erro 5";
				}
			}
			else{
				$e = $e +1;
				//echo "$query <br>";
				echo "erro 4";
			}

		}
		else{
			$e = $e +1;
			//echo "$query <br>";
			echo "erro 3";
		}

	}
	else{
		$e = $e +1;
		//echo "$query <br>";
		echo "erro 2";
	}

}
if ($e != 0) {
	?>
	<script type="text/javascript">
		alert('Erro ao desmembrar');
		window.location.assign('./');
	</script>
	<?php
}