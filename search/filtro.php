<!-- essa página é apenas um formulário para filtrar os resultados, a mesma será incluída na página resultado  -->
<form class="form-group" action="resultado.php">
	<table>
		<tr>
			<td>
				<input type="checkbox" class="form-check-input" id="dropdownCheck4" name="filtro" value="ordema">
				<label class="form-check-label" for="dropdownCheck4">Ordem alfabetica</label>
			</td>
		</tr>
	</table><br>
	<select name="ano">
		<option value="">Ano</option>
		<?php 
		$a = 2000 + date('y');
		for ($i=2016; $i <= $a ; $i++) { 
		?>
		<option value="<?=$i?>"><?=$i?></option>
		<?php        
		}
		?>
	</select>
		<br><br>
	<input type="hidden" name="search" value="<?=$search?>">
	<input type="hidden" name="table" value="<?=$table?>">
	<button type="submit" class="btn btn-primary">Filtrar</button>
</form>