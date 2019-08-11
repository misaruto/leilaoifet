<?php  
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}

include '../../configs.php';

$sql = "SELECT * FROM tbl_tipos";
$query = mysqli_query($con, $sql);
?>
<form action="cad.leiloes2.php">
	<table class="table">
		<thead>
			<th colspan="2">
				<center>
					Cadastro de leilões
				</center>
			</th>
		</thead>
		<tbody>
			<tr>
				<td>
					<center>
						<label for="nome">
							Nome
						</label>
					</center>
				</td>
				<td colspan="3">
					<input type="text" name="nome" id="nome" class="form-control" required>
				</td>
			</tr>
			<tr>
				<td>
					<center>
						<label for="numero">
							Número
						</label>
					</center>
				</td>
				<td>
					<input type="number" name="numero" id="numero" min="1" class="form-control" onkeypress='return SomenteNumero(event)'>
				</td>
				<td>
					<center>
						<label for="ano">
							Ano
						</label>
					</center>
				</td>
				<td>
					<select required name="ano" id="ano" class="form-control">
						<option disabled selected>Ano</option>
						<?php 
						for ($i= (2002 + date('y')); $i >= 2010 ; $i--) { 
							?>
							<option value="<?=$i?>"><?=$i?></option>
							<?php
						}

						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<center>
						<label for="tipo">
							Tipo
						</label>
					</center>
				</td>
				<td colspan="3">
					<select name="tipo" id="tipo" class="form-control" required>
						<option disabled selected hidden>Selecione</option>			
						<?php 
						while ($row = mysqli_fetch_object($query)) {
							?>
							<option value="<?=$row->id?>"><?=$row->tipo?></option>
							<?php
						}

						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<center>
						<label for="data">				
							Data
						</label>
					</center>
				</td>
				<td colspan="3">
					<input type="date" name="data" id="data" required>
					<br>
					Data prevista para o dia do leilão.
				</td>
			</tr>
			<tr>
				<td>
					<center>
						<label for="desc">
							Descrição
						</label>
					</center>
				</td>
				<td colspan="3">
					<textarea name="desc" id="desc" class="form-control"></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<center>
						<button type="submit" class="btn btn-primary">Cadastrar</button>
					</center>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<script type="text/javascript">
	function SomenteNumero(e){
		var tecla=(window.event)?event.keyCode:e.which;   
		if((tecla>47 && tecla<58)) return true;
		else{
			if (tecla==8 || tecla==0) return true;
			else  return false;
		}
	}
</script>