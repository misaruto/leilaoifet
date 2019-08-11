<style type="text/css">
	#sair{
		padding:1 14px 1 14px;
		border-radius: 10px;
	}
	#sair:hover{
		background-color: #f00;
		transition-duration: 400ms;	

	}
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="../../?pg=1">Home <span class="sr-only">(current)</span></a>
			</li>
			<?php
			if ((!isset($_COOKIE['admid']))&&(!isset($_COOKIE['compid']))) {
				?>

			<li class="nav-item">
				<a class="nav-link" href="../../?pg=2">Login</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="../../?pg=3">Cadastre-se</a>
			</li>
			<?php
		}
		?>
		<li class="nav-item">
			<a href="../../?pg=4" class="nav-link">Feedback</a>
		</li>
		<?php 
		if (isset($_COOKIE['admid'])) {
			?>
			<li class="nav-item">
				<a class="nav-link" href="../">
					Administração
				</a>
			</li>
			<?php
			if (isset($_COOKIE['admid'])||isset($_COOKIE['compid'])) {?>
			<li class="nav-item">
				<a href="../../perfil/" class="nav-link">
					Perfil
				</a>
			</li>
			<li class="nav-item">
				<a href="../../sair.php" class="nav-link" id="sair">
					Sair
				</a>
			</li>	
			<?php	
		}
		}
		?>
	</ul>
</div>
</nav>