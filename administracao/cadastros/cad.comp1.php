<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
?>
<center>
	<div class="container">
		<form action="cad.comp2.php"  method="POST" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<td>
						<label for="nome">
							Nome:
						</label>
					</td>
					<td>
						<input type="text" name="nome" id="nome" class="form-control" required>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tel">
							Data de Nascimento
						</label>
					</td>
					<td>
						<input type="date"  name="data" class="" required >
					</td>
				</tr>
				<tr>
					<td>
						<label for="tel">
							Telefone:
						</label>
					</td>
					<td>
						<input type="tel" maxlength="15" name="tel" class="form-control" required  alt="apenas numeros" onkeypress='return SomenteNumero(event)'>
					</td>
				</tr>
				<tr>
					<td>
						Endereço:
					</td>
					<td>
						<input type="text" name="end" class="form-control" placeholder="Bairro Rua complemento N°..." required>
					</td>
				</tr>
				<tr>
					<td>
						Estado:
					</td>
					<td>
						<select name="estado" required class="form-control" id="estado" onchange="buscaCidades(this.value)">
							<option value="">Selecione o Estado</option>
							<option value="AC">Acre</option>
							<option value="AL">Alagoas</option>
							<option value="AP">Amapá</option>
							<option value="AM">Amazonas</option>
							<option value="BA">Bahia</option>
							<option value="CE">Ceará</option>
							<option value="DF">Distrito Federal</option>
							<option value="ES">Espírito Santo</option>
							<option value="GO">Goiás</option>
							<option value="MA">Maranhão</option>
							<option value="MT">Mato Grosso</option>
							<option value="MS">Mato Grosso do Sul</option>
							<option value="MG">Minas Gerais</option>
							<option value="PA">Pará</option>
							<option value="PB">Paraíba</option>
							<option value="PR">Paraná</option>
							<option value="PE">Pernambuco</option>
							<option value="PI">Piauí</option>
							<option value="RJ">Rio de Janeiro</option>
							<option value="RN">Rio Grande do Norte</option>
							<option value="RS">Rio Grande do Sul</option>
							<option value="RO">Rondônia</option>
							<option value="RR">Roraima</option>
							<option value="SC">Santa Catarina</option>
							<option value="SP">São Paulo</option>
							<option value="SE">Sergipe</option>
							<option value="TO">Tocantins</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Cidade
					</td>
					<td>
						<select name="cidade" required class="form-control" id="cidade">
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Cpf:
					</td>
					<td>
						<input type="text" id="cpf" name="cpf" onkeypress="return mascara(event)"  placeholder="000.000.000-00" required maxlength="14" size="14" onkeypress='return SomenteNumero(event)'>
					</td>
				</tr>
				<tr>
					<td>
						Rg:
					</td>
					<td>
						<input type="text" name="rg" required placeholder="UF-00.000.000" id="rg" onkeypress="return mascaraRG(event)" maxlength="13" size="13"	>
					</td>
				</tr>
				<tr>
					<td>
						<label for="proc">
							Procurador:
						</label>
					</td>
					<td>
						<label for="proc">
							<input id="proc" type="checkbox" name="proc" value="1" onchange="show()" >Sim
						</label>
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
						<input type="text" id="cpf" onkeypress="return mascara(event)" name="pcpf" placeholder="000.000.000-00" maxlength="14" size="14" onkeypress='return SomenteNumero(event)' >
					</td>
				</tr>
				<tr hidden class="tr">
					<td>
						Rg:
					</td>
					<td>
						<input type="text" name="rgp" placeholder="UF-00.000.000" id="rg" onkeypress='return mascaraRG(event)' maxlength="13">
					</td>
				</tr>
				<tr hidden class="tr">
					<td colspan="2">
						<div class="alert alert-warning" role="alert">
							Há uma cópia da procuração? <input type="checkbox" value="procuracao" name="documentos[]" id="juridico">Sim
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<label for="juridico">
							Jurídico:
						</label>
					</td>
					<td>
						<label for="juridico">
							<input type="checkbox" value="1" name="juridico" id="juridico" onclick="showJuridico()">Sim
						</label>
					</td>
				</tr>
				<tr class="tipo" hidden>
					<td>
						<label for="cnpj">
							Cnpj:
						</label>
					</td>
					<td>
						<input type="text" name="cnpj" placeholder="00.000.000/0000-00" id="cnpj" onkeypress='return SomenteNumero(event)' onkeypress='return mascaraCnpj(event)' maxlength="17">
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
						Selecione os documentos <br>	que serão anexados agora:
					</td>
					<td>
						<input type="checkbox" name="documentos[]" value="prf">  Prova de regularidade fiscal perante a Fazenda Nacional (prf) <br>
						<input type="checkbox" name="documentos[]" value="prfgts" >Prova de regularidade com o Fundo de Garantia do Tempo de Serviço(prfgts)
						<br>
						<input type="checkbox" name="documentos[]" value="pid"> Prova de inexistência de débitos inadimplidos perante a justiça do trabalho(pid)
						<div class="alert alert-warning" role="alert">
							Será preciso anexar todos os documentos selecionados a seguir.
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
	<script type="text/javascript">
		function mascaraRG(e) {
			var tecla=(window.event)?event.keyCode:e.which;
			if (tecla == '') {

			}
			else{
				var rg = document.getElementById('rg');
				if (document.getElementById('rg').value.length == 2) {
					rg.value = rg.value + '-';
				}
				if (document.getElementById('rg').value.length == 5) {
					rg.value = rg.value + '.';
				}
				if (document.getElementById('rg').value.length == 9) {
					rg.value = rg.value + '-';
				}	
			}
		}

		function show(argument) {
			var x = document.getElementsByClassName("tr");
			for (var i = x.length - 1; i >= 0; i--) {
				if (x[i].hidden == true) {
					x[i].hidden = false;
				}
				else{
					x[i].hidden = true;
				}
			}
		}

		function showJuridico() {
			var j = document.getElementsByClassName("tipo");
			for (var i = j.length - 1; i >= 0; i--) {
				if (j[i].hidden == true) {
					j[i].hidden = false;
				}
				else{
					j[i].hidden = true;
				}
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

		function mascaraCnpj(e) {
			var tecla=(window.event)?event.keyCode:e.which;
	//if (tecla == '') {

	//}
//	else{

	alert('oi');	var cnpj = document.getElementById('cnpj');
	if (document.getElementById('cnpj').value.length == 2) {
		cnpj.value = cnpj.value + '.';

	}
	if (document.getElementById('cnpj').value.length == 7) {
		cnpj.value = cnpj.value + '.';
	}
	if (document.getElementById('cnpj').value.length == 11) {
		cnpj.value = cnpj.value + '/';
	}
	if (document.getElementById('cnpj').value.length == 15) {
		cnpj.value = cnpj.value + '-';
	}	
//	}
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
<script src="estados-cidades.js"></script>
<script type="text/javascript">
	function buscaCidades(e){
		document.querySelector("#cidade").innerHTML = '';
		var cidade_select = document.querySelector("#cidade");

		var num_estados = json_cidades.estados.length;
		var j_index = -1;

   // aqui eu pego o index do Estado dentro do JSON
   for(var x=0;x<num_estados;x++){
   	if(json_cidades.estados[x].sigla == e){
   		j_index = x;
   	}
   }

   if(j_index != -1){

      // aqui eu percorro todas as cidades e crio os OPTIONS
      json_cidades.estados[j_index].cidades.forEach(function(cidade){
      	var cid_opts = document.createElement('option');
      	cid_opts.setAttribute('value',cidade)
      	cid_opts.innerHTML = cidade;
      	cidade_select.appendChild(cid_opts);
      });
  }else{
  	document.querySelector("#cidade").innerHTML = '';
  }
}


</script>
<br>
<br>
<br>
