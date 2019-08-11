<style type="text/css">
	#sair{
		padding:1 14px 1 14px;
	}
	#sair:hover{
		background-color: #f00;
		transition-duration: 400ms;	

	}
</style>
<nav class="navbar navbar-expand-xl navbar-dark bg-dark" style="font-size: 20px">
	<ul class="navbar-nav mr-auto">
		<li class="nav-item">
			<a class="nav-link" href="../">Home</a>
		</li>
		<li class="nav-item ">
			<a class="nav-link" href="../leiloes">Leilões</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Listas
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="../listas/?pg=1">Animais</a>
				<a class="dropdown-item" href="../listas/?pg=0">Compradores</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="../documentos/">Documentos</a>
				<a class="dropdown-item" href="../imagens/">Fotos</a>
			</div>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Cadastros
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="../cadastros?pg=1">Animais</a>
				<a class="dropdown-item" href="../cadastros?pg=0">Compradores</a>
				<a class="dropdown-item" href="../cadastros/?pg=3">Leilões</a>
				<a class="dropdown-item" href="../confirmar/">Comp/Lote</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="../cadastros?pg=2">Logo</a>
			</div>
		</li>
		<li class="nav-item dropdown ">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Editar
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="../editar?pg=0">Animais</a>
				<a class="dropdown-item" href="../editar?pg=1">Compradores</a>
			</div>
		</li>
		<li class="nav-item active">
			<a class="nav-link" href="./">Lotes</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Comprovantes
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="../gerardoc?pg=0">Compradores</a>
				<a class="dropdown-item" href="../gerardoc?pg=1">Avaliadores</a>
				<a class="dropdown-item" href="../gerardoc/lotes_pdf.php">Lotes</a>
				<a class="dropdown-item" href="../gerardoc/?pg=2">Comp/Lote</a>
			</div>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Tarefas
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="../tarefas?pg=0">Ver</a>
				<a class="dropdown-item" href="../tarefas?pg=1">Cadastrar</a>
				<a class="dropdown-item" href="../tarefas?pg=2">Editar</a>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="../avaliacao">Avaliação</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="sair" href="../../sair.php">Sair</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="../search" >
				<img src="../imagens/search.png" width="20" height="20">
			</a>
		</li>
	</ul>
</nav>