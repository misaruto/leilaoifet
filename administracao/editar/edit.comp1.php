<?php 
if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
}
else{
	header('location:./?pg=1');
}
include '../../configs.php';
$query = "SELECT * FROM tbl_compradores WHERE id_comprador = '$id'";
$sql = mysqli_query($con, $query);
$row = mysqli_fetch_object($sql);
?>
<center>
	<div class="container">
		<form action="cad.comp2.php"  method="post" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<td>
						<label for="nome">
							Nome:
						</label>
					</td>
					<td>
						<input type="text" name="nome" id="nome" class="form-control" required value="<?=$row->nome_comprador?>">
					</td>
				</tr>
				<tr>
					<td>
						<label for="tel">
							Telefone:
						</label>
					</td>
					<td>
						<input type="tel" name="tel" class="form-control" required value="<?=$row->telefone?>"> 
					</td>
				</tr>
				<tr>
					<td>
						Endereço:
					</td>
					<td>
						<input type="text" name="end" class="form-control" placeholder="Bairro Rua complemento N°..." required value="<?=$row->endereco?>">
					</td>
				</tr>
				<tr>
					<td>
						Estado:
					</td>
					<td>
						<input type="text" name="estado" required class="form-control" value="<?=$row->estado?>">
					</td>
				</tr>
				<tr>
					<td>
						Cidade
					</td>
					<td>
						<input type="text" name="cidade" required class="form-control" value="<?=$row->cidade?>">
					</td>
				</tr>
				<tr>
					<td>
						Cpf:
					</td>
					<td>
						<input type="number" name="cpf" pattern="/^[0-9]{3}.?[0-9]{3}.?[0-9]{3}-?[0-9]{2}/" placeholder="000.000.000-00" required min="12" max="11" class="form-control" value="<?=$row->cpf?>">
					</td>
				</tr>
				<tr>
					<td>
						Rg:
					</td>
					<td>
						<input type="text" name="rg" required class="form-control" placeholder="UF-00.000.000"
						value="<?=$row->rg?>">
					</td>
				</tr>
				<tr>
					<td>
						Procurador:
					</td>
					<td>
						<input type="checkbox" name="proc" value="1" onchange="show()" >Sim
					</td>
				</tr>
				<tr hidden class="tr">
					<td>
						Nome:
					</td>
					<td>
						<input type="text" name="nomep" id="nome" class="form-control">
					</td>
				</tr>
				<tr hidden class="tr">
					<td>
						Cpf:
					</td>
					<td>
						<input type="number" name="cpfp" pattern="/^[0-9]{3}.?[0-9]{3}.?[0-9]{3}-?[0-9]{2}/" placeholder="000.000.000-00" min="11" max="11">
					</td>
				</tr>
				<tr hidden class="tr">
					<td>
						Rg:
					</td>
					<td>
						<input type="text" name="rgp" placeholder="UF-00.000.000">
					</td>
				</tr>
				<tr hidden class="tr">
					<td colspan="2">
						<div class="alert alert-warning" role="alert">
							Se houver, anexar cópia da procuração
						</div>
					</td>
				</tr>
				<tr>
					<td>
						Jurídico:
					</td>
					<td>
						<input type="checkbox" value="1" name="j" onchange="juridico()">Sim
					</td>
				</tr>
				<tr class="tipo" hidden>
					<td>
						Cnpj:
					</td>
					<td>
						<input type="number" name="cnpj" 
						pattern="\([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})\" placeholder="00.000.000/0000-00">
					</td>
				</tr>
				<tr class="tipo" hidden>
					<td>
						Cópia do Contrato Social <br> (ou equivalente) anexada: 
					</td>
					<td>
						<input type="checkbox" value="1" name="cs">Sim
					</td>
				</tr>
				<tr>
					<td>
						Outros documentos anexados
					</td>
					<td>
						<input type="checkbox" name="documento" name="prf" value="x">  Prova de regularidade fiscal perante a Fazenda Nacional <br>
						<input type="checkbox" name="documento" name="prfgts" value="x">Prova de regularidade com o Fundo de Garantia do Tempo de Serviço
						<br>
						<input type="checkbox" name="documento" name="pid" value="x"> Prova de inexistência de débitos inadimplidos perante a justiça do trabalho
					</td>
				</tr>
				<tr>
					<td>
						Agora insira os doucumentos.
					</td>
					<td>
						<input name="files[]" type=file multiple />
						<div class="alert alert-warning" role="alert">
							Insira somente os <b>citados</b> acima.
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<center>
							<input type="submit" class="btn btn-primary" value="Cadastrar">
						</center>
					</td>
				</tr>
			</table>
		</form>
	</center>