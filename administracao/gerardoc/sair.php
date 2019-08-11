<?php
if (isset($_REQUEST['apagar'])) {
	setcookie('compid',"");
	header('location:./');
}
  ?>