<center>
	<table class="table">
		<?php 
		include '../../configs.php';
		$query = "SELECT * FROM tbl_logo";
		$sql = mysqli_query($con, $query);
		while ($row = mysqli_fetch_object($sql)) {?>
		<tr>
			<td width="250">
				<img src="../../imagens/<?=$row->nome?>" 
				width="200" height="100">
			</td>
			<td>
				<a href="./?pg=4&id=<?=$row->id?>">
					<div class="btn btn-primary">
						Trocar
					</div>
				</a>
			</td>
		</tr>
		<?php
	}
	?>
</table>
</center>
