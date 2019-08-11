<script>
	window.scrollTo(0,300);
	
</script>
<div class="container">
	<p class="text-primary">Olá, escreva abaixo tudo o que você acha que deve melhorar ou adicionar ao sistema.</p>
	<form action="feed.2.php">
		<table class="table">
			<tr>
				<td>
					<label for="nome">
						Nome:
					</label>
				</td>
				<td>
					<input type="text" name="nome" id="nome" class="form-control" required autofocus> 
				</td>
			</tr>
			<tr>
				<td>
					<label for="email">
						Email:
					</label>
				</td>
				<td>
					<input type="email" name="email" id="email" class="form-control" required>
				</td>
			</tr>
			<tr>
				<td>
					Mesagem:
				</td>
				<td>
					<textarea name="msg" class="form-control">

					</textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<button type="submit" class="btn btn-primary">Enviar</button>
					</center>
				</td>
			</tr>
		</table>
	</form>
</div>
<br>
<br>
