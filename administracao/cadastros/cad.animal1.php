<?php 
if (!isset($_COOKIE['admid'])) {
	header('location:../../?pg=2');
}
?>
<br>
<center>
	<div class="container">
		<form action="cad.animal2.php">
			<table border="0" class="table table-hover">
				<tr>
					<td>
						<label for="nome">Nome:</label>
					</td>
					<td>
						<input autofocus type="text" name="nome" class="form-control" id="nome">
					</td>
				</tr>
				<tr>
					<td>
						<label for="brinco">Brinco:</label>
					</td>
					<td>
						<input type="text" name="brinco" class="form-control" id="brinco">
					</td>
				</tr>
				<tr>
					<td>
						<label for="peso">Peso KG:</label>
					</td>
					<td>
						<input type="number" name="peso" min="1" max="500" class="form-control" id="peso" step="0.1">
					</td>
				</tr>
				<tr>
					<td>
						<label for="datap">Data Pesagem:</label>
					</td>
					<td>
						<input type="date" name="datap" id="datap">
					</td>
				</tr>
				<tr>
					<td>
						<label for="datan">Data Nascimento:</label>
					</td>
					<td>
						<input type="date" name="datan" id="datan">
					</td>
				</tr>
				<tr>
					<td>
						<label for="raca">Raça:</label>
					</td>
					<td>
						<input type="text" name="raca" class="form-control" id="raca">
					</td>
				</tr>
				<tr>
					<td colspan="">
						<label for="desc">Descrição</label> <br>
					</td>
					<td colspan=""> 
						<textarea class="form-control" cols="120" rows="2" name="desc" placeholder="Descreva o animal em questão" id="desc" value="">
						</textarea>
					</td>
				</tr>
				<tfoot>
					<td colspan="2">
						<center>
							<button type="submit" class="btn btn-primary">Cadastrar	</button>
						</center>
					</td>
				</tfoot>
			</table>
		</form>
	</div>
</center>
<br><br>
