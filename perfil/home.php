<?php 
include '../configs.php';
if (isset($_COOKIE['compid'])) {
	$id = $_COOKIE['compid'];
	$query = "SELECT * FROM tbl_compradores WHERE id_comprador = '$id' ";
	$sql = mysqli_query($con, $query);
	$row = mysqli_fetch_object($sql);
	?>
	<style type="text/css">
	#legenda{
		width: 176px;
		position: absolute;
		left: 136px;
		margin-top: 100px;
		background-color: #fff;
		color: #000;
		height: 80px;
	}

	#input{
		position: absolute;
		left: 25%;
		background-color: #c8d8d8;
		width: 50%;
		border-style: groove;
		height: 250px;	
		border-radius: 10px;
	}
</style>
<div class="zindex-fixed" style="z-index: 1;" >
	<div style="z-index: 1;" class=" d-flex flex-row">
		<div class="p-2">
			<a href="#" onclick="input()" onmouseover="show()" onmouseout="show()">
				<div hidden  id="legenda" style="width: 15%" class="img-fluid" align="center">
					<center>
						Clique para mudar a foto
						<img src="./imagens/cam.png" width="25" height="25">
					</center>
				</div>
				<img width="175" height="175" class="rounded-circle" src="./imagens/<?=$row->id_comprador?>.jpg">
			</a>
		</div>
		<br>
		<div style="z-index: 3; visibility: initial;" hidden id="input">
			<center>
				<form action="foto.php" method="post" enctype="multipart/form-data">
					Escolha uma foto. <br>
					<input type="file" name="foto" class="btn btn-success"  accept="image/png, image/jpeg">
					<br> <br><br>
					<button type="submit" class="btn btn-primary">Enviar</button>
					<br><br>
					<a href="#" onclick="input()">Fechar</a> 
				</form>
			</center>
		</div>
		<div class="text-dark" class="p-2">
			<br><br><br>
			<font size="6">
				&emsp;<?=$row->nome_comprador?>
			</font>
		</div>
	</div>
	<div>
		<table class="table table-hover">
			<tr>
				<td>
					Cpf
				</td>
				<td>
					<?=$row->cpf?>
				</td>
			</tr>
			<tr>
				<td>
					RG
				</td>
				<td>
					<?=$row->rg?>
				</td>
			</tr>
			<tr>
				<td>
					Telefone
				</td>
				<td>
					<?=$row->telefone?>				
				</td>
			</tr>
			<tr>
				<td rowspan="5">
					<br><br><br>
					Endereço
				</td>
			</tr>
			<tr>
				<td>
					Rua
				</td>
				<td>
					<?=$row->endereco?>
				</td>
			</tr>
			<tr>
				<td>
					Bairro
				</td>
				<td>
					<?=$row->bairro?>
				</td>
			</tr>
			<tr>
				<td>
					Cidade
				</td>
				<td>
					<?=$row->cidade?>
				</td>
			</tr>
			<tr>
				<td>
					Estado
				</td>
				<td>
					<?=$row->estado?>
				</td>
			</tr>
		</table>
	</div>
</div>
<script type="text/javascript">
	var b = document.getElementById('input');
	function show(argument) {
		var a = document.getElementById('legenda');
		if (a.hidden == true) {
			a.hidden = false;
		}
		else{
			a.hidden = true;
		}
	}
	function input(){
		var body = document.getElementById('body');
		if (b.hidden == true) {
			b.hidden = false;
			body.style = "background-color:  rgba(134, 142, 150,100);visibility: collapse;";
		}
		else{
			b.hidden = true;
			body.style = "";
		}
	}
	function Checkfiles(){
		var fup = document.getElementById('filename');
		var fileName = fup.value;
		var ext = fileName.substring(fileName.lastIndexOf('.') + 1);

		if(ext =="jpeg" || ext=="png"){
			return true;
		}
		else{
			return false;
		}
	}
</script>
<?php
}
?>