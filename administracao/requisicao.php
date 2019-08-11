<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
if (!isset($_REQUEST['id'])) {
	?>
	<script type="text/javascript">
		alert('Nenhuma requisição selecionada');
		window.location.assign('./');
	</script>
	<?php
}
$id = $_REQUEST['id'];

include '../configs.php';

$query = "SELECT * FROM tbl_administradores WHERE id_adm = '$id' AND autorizado = 0";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_object($result); 
if ($row->confirmado == 0) {
	$disabled ="disabled";
	$alert = "";
}
else{
	$disabled = "";
	$alert = "hidden";
}
?>
<table class="table table-striped table-light">
	<tbody id="body">
		<tr>
			<td>
				<center>
					Nome
				</center>
			</td>
			<td>
				<center>
					<?=$row->nome_adm?>
				</center>
			</td>
		</tr>
		<tr>
			<td>
				<center>
					E-email
				</center>
			</td>
			<td>
				<center>
					<?=$row->email?>
				</center>
			</td>
		</tr>
		<tr>
			<td>
				<center>
					CPF
				</center>
			</td>
			<td>
				<center>
					<?=$row->cpf?>
				</center>
			</td>
		</tr>
		<tr>
			<td>
				<center>
					Motivo
				</center>
			</td>
			<td>
				<center>
					<?=$row->motivo?>
				</center>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<center>
					<div>
						<button <?=$disabled?> class="btn btn-success" onclick="aprovar(<?=$id?>)">
							Aprovar
						</button>
						<button <?=$disabled?> class="btn btn-danger" onclick="negar()">
							Negar
						</button>
					</div>
					<br>
					<div class="alert alert-info" <?=$alert?>>
						O usuário ainda não confirmou o E-mail. <br>
						 <a href="./" class="alert-link">Voltar</a>
					</div>
				</center>
			</td>
		</tr>
	</tbody>
	<tfoot id="motivo" hidden>
		<form action="negar.php">
			<input type="hidden" name="email" value="<?=$row->email?>">
			<input type="hidden" name="nome" value="<?=$row->nome_adm?>">
			<input type="hidden" name="id" value="<?=$id?>">
			<tr>
				<td>
					<center>
						Motivo por ter negado. <br>
						<font size="1">(obs: será enviado para o E-mail de quem fez a requisição).</font>	
					</center>
				</td>
				<td>
					<textarea name="motivo" placeholder="Digite o motivo por não ter aceito essa requisição. Ele será enviado via E-email para quem fez a requisição" rows="4" cols="80"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<input type="submit" value="Enviar" class="btn btn-primary">
						<a href="#" class="btn btn-danger" onclick="negar()">Cancelar</a>
					</center>
				</td>
			</tr>
		</form>
	</tfoot>
</table>
<script type="text/javascript">
	var body = document.getElementById('body');
	var motivo = document.getElementById('motivo');
	function negar() {
		if (motivo.hidden == true) {
			body.hidden = true;
			motivo.hidden = false;
		}
		else{
			body.hidden = false;
			motivo.hidden = true;

		}
	}
	function aprovar(id){
		var a = confirm('Tem certeza que deseja aprovar essa solitação?');
		if (a) {
			window.location.assign('aprovar.php?id='+id);
		}
		else{
			
		}
	}
</script>