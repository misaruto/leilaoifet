<?php 
include 'configs.php';
if ((isset($_REQUEST['email']))&&(isset($_REQUEST['msg']))&&(isset($_REQUEST['nome']))) {
	$e = $_REQUEST['email'];
	$m = $_REQUEST['msg'];
	$n = $_REQUEST['nome'];
	if (($e != "")&&($m != "")&&($n != "")) {
		$a = date('y');
		$q = "SELECT MAX(id_feedback_ano) FROM tbl_feedback WHERE ano = '$a'";
		$res = mysqli_query($con, $q);
		if (empty($res)) {
			$id = 1;
		}
		else{
			$id = $res + 1;
		}
		$sql = "INSERT INTO `tbl_feedback`(`id_feedback`, `id_feedback_ano`, `nome`, `email`, `msg`, `ano`) VALUES('','$id','$n','$e','$m','$a')";
		if (mysqli_query($con,$sql)) {
			header('location:./?pg=4&feed=sucess');
		}
		else{
			echo "Erro na clausula";
		}
	}
	header('location:./?pg=4');
}
else{
	header('location:./?pg=4');
}
?>