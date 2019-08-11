<?php 
if ((isset($_REQUEST['n']))&&(isset($_REQUEST['cpf']))&&(isset($_REQUEST['email']))) {
	$n = $_REQUEST['n'];
	$cpf = $_REQUEST['cpf'];
	$m=$_REQUEST['email'];
}
else{
	$n = "";
	$cpf = "";
	$m="";
}
?>
<center>
	<div class="container">
		<form action="cadastro2.php"  method="post" enctype="multipart/form-data">
			<table class="table table-striped">
				<tr>
					<td>
						<label for="nome">
							Nome:
						</label>
					</td>
					<td>
						<input type="text" name="nome" id="nome" class="form-control" required
						value="<?=$n?>">
					</td>
				</tr>
				<tr>
					<td>
						<label for="email">
							E-Mail
						</label>
					</td>
					<td>
						<input type="mail" name="email" id="email" class="form-control" required
						value="<?=$m?>">
					</td>
				</tr>
				<tr>
					<td>
						Cpf:
					</td>
					<td>
						<input type="text" id="cpf" onkeypress="return mascara(event)" name="cpf" placeholder="000.000.000-00" required maxlength="14" size="14" value="<?=$cpf?>" onkeypress='return SomenteNumero(event)' >
					</td>
				</tr>
				<tr>
					<td>
						Motivo/Descrição
						<div style="font-size: 12px;">
							Escreva o porque você deve ser aceito. <br>Ou simplesmente se descreva, <br>como se fosse um curriculo
						</div>
					</td>
					<td>
						<textarea name="motivo" rows="2" cols="60"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<label for="login">
							Login:
						</label>
					</td>
					<td>
						<input type="text" name="login" id="login" class="form-control" required>
						<?php 
						if (isset($_REQUEST['login'])) {
							?>
							<font color="red" size="5">Esse login já existe</font>
							<?php	
						}
						?>
					</td>
				</tr>			
				<tr>
					<td>
						<label for="pass">
							Senha:
						</label>
						<div style="font-size: 10px;">
							Minimo 8 digitos e maximo 20.
						</div>
					</td>
					<td>
						<input type="password" name="pass" id="pass" class="form-control" required minlength="8" maxlength="20">
						<center>
							<div style="cursor: pointer;" onclick="show('pass')">
								<br>
								<center>
									<img src="./imagens/ver.png" width="28px" height="28px">
								</center>
							</div>
						</center>
					</td>
				</tr>
				<tr>
					<td>
						<label for="pass2">
							Senha:
						</label>
					</td>
					<td>
						<input type="password" name="pass2" id="pass2"  oninput="verificaSenha()" class="form-control" required minlength="8" maxlength="20">
						<center>
							<div style="cursor: pointer;" onclick="show('pass2')">
								<br>
								<center>
									<img src="./imagens/ver.png" width="28px" height="28px">
								</center>
							</div>
						</center>
						<div id="msg-danger" hidden class="alert alert-danger">
							As senhas não coincidem.
						</div>
						<div id="msg-sucess" hidden class="alert alert-success">
							As senhas coincidem
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<center>
							<input type="submit" class="btn btn-primary" value="Cadastrar" id="btn" disabled>
						</center>
					</td>
				</tr>
			</table>
		</form>
	</center>

	<br>
	<br>
	<br>
	<script type="text/javascript">
		function show(id) {
			var id = id;
			var input = document.getElementById(id);
			if (input.type == 'text') {
				input.type = 'password'
			}
			else{
				input.type = 'text';
			}
			
		}
		function verificaSenha(argument) {
			var	p1 = document.getElementById('pass');
			var p2 = document.getElementById('pass2');
			if (p1.value == p2.value) {
				document.getElementById('msg-sucess').hidden = false;
				document.getElementById('msg-danger').hidden = true;
			}
			else{
				document.getElementById('msg-danger').hidden = false;
				document.getElementById('msg-sucess').hidden = true;
				document.getElementById('btn').disabled = true;
			}
			if (p2.size > 7 && p1.size > 7) {
				document.getElementById('btn').disabled = false;
			}
		}

		function mascara(e) {
			var tecla=(window.event)?event.keyCode:e.which;
			if (tecla == '') {

			}
			else{
				var cpf = document.getElementById('cpf');
				if (document.getElementById('cpf').value.length == 3) {
					cpf.value = cpf.value + '.';
				}
				if (document.getElementById('cpf').value.length == 7) {
					cpf.value = cpf.value + '.';
				}
				if (document.getElementById('cpf').value.length == 11) {
					cpf.value = cpf.value + '-';
				}	
			}
		}

		function SomenteNumero(e){

			var tecla=(window.event)?event.keyCode:e.which;   

			if((tecla>47 && tecla<58)){
				return true;
			}
			else{
				if (tecla==8 || tecla==0){ 
					return true;
				}
				else{  return false;
				}
			}
		}
	</script>
