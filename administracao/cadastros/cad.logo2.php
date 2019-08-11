<?php 
if (!isset($_REQUEST['id'])) {
	header('./?pg=2');
}
else{
	$input = "<input type=hidden name=id value=".$_REQUEST['id'].">";
}
?>
<form action="cad.logo3.php" method="post" enctype="multipart/form-data" accept="jpg/jpeg/png">

	<table class="table table-striped">
		<tbody>
			<tr>
				<td>
					<center>
						<input type="file" name="logo" class="form-control" accept="image/png, image/jpeg">
					</center>
				</td>
			</tr>
			<tr>
				<td>
					Descrição
					<textarea name="desc" class="form-control" required></textarea>
				</td>
				<tr>
					<td>
						<center>
							<?=$input?>
							<input type="submit" class="btn btn-primary" value="Cadastrar">
						</center>
					</td>
				</tr>
			</tr>
		</tbody>
	</table>
</form>