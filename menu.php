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
<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
	<ul class="navbar-nav mr-auto">
		<li class="nav-item active">
			<a class="nav-link" href="./?pg=1">Home <span class="sr-only">(current)</span></a>
		</li>
		<?php
		if ((!isset($_COOKIE['admid']))&&(!isset($_COOKIE['compid']))) {?>

			<li class="nav-item">
				<a class="nav-link" href="./?pg=2">Login</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="./?pg=3">Cadastre-se</a>
			</li>
			<?php
		}
		?>
		<li class="nav-item">
			<a href="./?pg=4" class="nav-link">Feedback</a>
		</li>
		<?php 
		if (isset($_COOKIE['admid'])) {
			?>
			<li class="nav-item">
				<a class="nav-link" href="./administracao">
					Administração
				</a>
			</li>
			<?php
			if (isset($_COOKIE['admid'])||(isset($_COOKIE['compid']))) {?>
				<li class="nav-item">
					<a href="./perfil/" class="nav-link">
						Perfil
					</a>
				</li>
				<li class="nav-item">
					<a href="sair.php" class="nav-link" id="sair">
						Sair
					</a>
				</li>	
				<?php	
			}
		}
		?>
	</ul>
	<form class="form-inline my-2 my-lg-0" action="./search">
		<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	</form>
</nav>