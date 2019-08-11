<?php 
if (isset($_FILES['logo'])) {
	include '../../configs.php';
	$id = $_POST['id'];
	$query = "SELECT * FROM tbl_logo WHERE id = '$id'";
	$sql = mysqli_query($con, $query);
	$row = mysqli_fetch_object($sql);
	if (!empty($row->nome)) {
		if (unlink("../../imagens/".$row->nome)) {
			mysqli_query($con,"DELETE FROM tbl_logo WHERE id = '$id'");
			$desc = $_POST['desc']; 
			$foto = $_FILES['logo'];
			$dir = "../../imagens/";
			$name = $foto['name'];
			if (move_uploaded_file($foto['tmp_name'], $dir.$foto['name'])) {
				$query = "INSERT INTO `tbl_logo`(`nome`, `descricao`) VALUES  ('$name','$desc')";
				if (mysqli_query($con, $query)) {
					header('location:./?pg=2');
				}
				else{
					echo "Erro no sql";
				}
			}
			else{
				echo "Erro no up da imagem";
			}
		}
		else{
			echo "imagem nao apagada";
		}
	}
}
?>