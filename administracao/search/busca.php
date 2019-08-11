<?php
// inclui a pagina de conexão com o banco de dados
include '../../configs.php';
?>
<?php 
	//de acordo com o valor e a existencia de algumas variáveis o resultado da busca será diferente, por exemplo, se existir a variável "$ordema" significa que o pesquisador quer os resultados exibidos em ordem alfabetica
	if(isset($table) && isset($ano) && isset($ordema) && $ano!='')
	{
		if($table=='tbl_animais')
		{
			$query=mysqli_query($con,"SELECT * FROM tbl_animais WHERE nome_animal like '%$search%' and ano='$ano'  or raca like '%$search%' and ano='$ano' order by nome_animal asc");	
			$row= mysqli_num_rows($query);
			if($row=='')
			{
				echo "Nenhum resultado encontrado!";
			}
			else
			{
				echo "<table class='table table-striped' border=0>";
				echo "<tr><td>#</td><td>Nome</td><td>Brinco</td><td>Peso</td><td>Data da pesagem</td><td>Data de Nascimento</td><td>Raça</td><td>Descrição</td><td>Ano</td></tr>";
				while($array=mysqli_fetch_array($query))					
				{
					echo "<tr><td>$array[id_animal]</td><td>$array[nome_animal]</td><td>$array[brinco]</td><td>$array[peso]</td><td>$array[data_pesagem]</td><td>$array[nascimento]</td><td>$array[raca]</td><td>$array[descricao]</td><td>$array[ano]</td></tr>";
				}
			}
		}
		if($table=='lote')
		{
			$query=mysqli_query($con,"SELECT * FROM tbl_lotes WHERE nome like '%$search%' and ano='$ano' order by nome asc");
			$row= mysqli_num_rows($query);
			if($row=='')
			{
				echo "Nenhum resultado encontrado!";
			}
			else
			{
				echo "<table class='table table-striped' border=0>";
				echo "<tr><td>#</td><td>Nome</td><td>Ano</td><td>Valor</td></tr>";
				while($array=mysqli_fetch_array($query))					
				{
					echo "<tr><td>$array[id_lote]</td><td>$array[nome]</td><td>$array[ano]</td><td></td></tr>";
				}	
			}
		}
		if($table=='compradores')
		{
			$query=mysqli_query($con,"SELECT * FROM tbl_compradores where nome_comprador like '%$search%' and ano='$ano' order by nome_comprador asc");
			$row=mysqli_num_rows($query);
			if($row=='')
			{
				echo "Nenhum reseultado encontrado!";
			}
			else
			{
				echo "<table class='table table-striped' border=0>";
				echo "<tr><td>#</td><td>Nome</td><td>Data de nascimento</td><td>Telefone</td><td>Endereço</td><td>CPF</td><td>RG</td><td>Estado</td><td>Cidade</td><td>P_R_fiscal</td><td>P_R_fgts</td><td>P_I_Debitos</td><td>Ano</td></tr>";
				while($array=mysqli_fetch_array($query))					
				{
					echo "<tr><td>$array[id_comprador]</td><td>$array[nome_comprador]</td><td>$array[nascimento]</td><td>$array[telefone]</td><td>$array[endereco]</td><td>$array[cpf]</td><td>$array[rg]</td><td>$array[estado]</td><td>$array[cidade]</td><td>$array[p_r_fiscal]</td><td>$array[p_r_fgts]</td><td>$array[p_i_debitos]</td><td>$array[ano]</td></tr>";
				}	
				echo "</table>";
			}
		}
	}
	else if(isset($table) && isset($ano) && $ano!='')
	{
		if($ano!='')
		{
			if($table=='tbl_animais')
			{
				$query=mysqli_query($con,"SELECT * FROM tbl_animais WHERE nome_animal like '%$search%' and ano='$ano' or raca like '%$search%' and ano='$ano'");	
				$row= mysqli_num_rows($query);
				if($row=='')
				{
					echo "Nenhum resultado encontrado!";
				}
				else
				{
					echo "<table class='table table-striped' border=0>";
					echo "<tr><td>#</td><td>Nome</td><td>Brinco</td><td>Peso</td><td>Data da pesagem</td><td>Data de Nascimento</td><td>Raça</td><td>Descrição</td><td>Ano</td></tr>";
					while($array=mysqli_fetch_array($query))					
					{
						echo "<tr><td>$array[id_animal]</td><td>$array[nome_animal]</td><td>$array[brinco]</td><td>$array[peso]</td><td>$array[data_pesagem]</td><td>$array[nascimento]</td><td>$array[raca]</td><td>$array[descricao]</td><td>$array[ano]</td></tr>";
					}
				}
			}
			if($table=='lote')
			{
				$query=mysqli_query($con,"SELECT * FROM tbl_lotes WHERE nome like '%$search%' and ano='$ano'");
				$row= mysqli_num_rows($query);
				if($row=='')
				{
					echo "Nenhum resultado encontrado!";
				}
				else
				{
					echo "<table class='table table-striped' border=0>";
					echo "<tr><td>#</td><td>Nome</td><td>Ano</td><td>Valor</td></tr>";
					while($array=mysqli_fetch_array($query))					
					{
						echo "<tr><td>$array[id_lote]</td><td>$array[nome]</td><td>$array[ano]</td><td></td></tr>";
					}
				}
			}
			
			if($table=='compradores')
			{
				$query=mysqli_query($con,"SELECT * FROM tbl_compradores where nome_comprador like '%$search%' and ano='$ano'");
				$row=mysqli_num_rows($query);
				if($row=='')
				{
					echo "Nenhum reseultado encontrado!";
				}
				else
				{
					echo "<table class='table table-striped' border=0>";
					echo "<tr><td>#</td><td>Nome</td><td>Data de nascimento</td><td>Telefone</td><td>Endereço</td><td>CPF</td><td>RG</td><td>Estado</td><td>Cidade</td><td>P_R_fiscal</td><td>P_R_fgts</td><td>P_I_Debitos</td><td>Ano</td></tr>";
					while($array=mysqli_fetch_array($query))					
					{
						echo "<tr><td>$array[id_comprador]</td><td>$array[nome_comprador]</td><td>$array[nascimento]</td><td>$array[telefone]</td><td>$array[endereco]</td><td>$array[cpf]</td><td>$array[rg]</td><td>$array[estado]</td><td>$array[cidade]</td><td>$array[p_r_fiscal]</td><td>$array[p_r_fgts]</td><td>$array[p_i_debitos]</td><td>$array[ano]</td></tr>";
					}	
					echo "</table>";
				}
			}
		}
	}
	else if(isset($table) &&  isset($ordema))
	{
		if($table=='tbl_animais')
		{
			$query=mysqli_query($con,"SELECT * FROM tbl_animais WHERE nome_animal like '%$search%'  or raca like '%$search%' order by nome_animal asc");	
			$row= mysqli_num_rows($query);
			if($row=='')
			{
				echo "Nenhum resultado encontrado!";
			}
			else
			{
				echo "<table class='table table-striped' border=0>";
				echo "<tr><td>#</td><td>Nome</td><td>Brinco</td><td>Peso</td><td>Data da pesagem</td><td>Data de Nascimento</td><td>Raça</td><td>Descrição</td><td>Ano</td></tr>";
				while($array=mysqli_fetch_array($query))					
				{
					echo "<tr><td>$array[id_animal]</td><td>$array[nome_animal]</td><td>$array[brinco]</td><td>$array[peso]</td><td>$array[data_pesagem]</td><td>$array[nascimento]</td><td>$array[raca]</td><td>$array[descricao]</td><td>$array[ano]</td></tr>";
				}
			}
		}
		if($table=='lote')
		{
			$query=mysqli_query($con,"SELECT * FROM tbl_lotes WHERE nome like '%$search%' order by nome asc");
			$row= mysqli_num_rows($query);
			if($row=='')
			{
				echo "Nenhum resultado encontrado!";
			}
			else
			{
				echo "<table class='table table-striped' border=0>";
				echo "<tr><td>#</td><td>Nome</td><td>Ano</td><td>Valor</td></tr>";
				while($array=mysqli_fetch_array($query))					
				{
					echo "<tr><td>$array[id_lote]</td><td>$array[nome]</td><td>$array[ano]</td><td></td></tr>";
				}
			}			
		}
		if($table=='compradores')
		{
			$query=mysqli_query($con,"SELECT * FROM tbl_compradores where nome_comprador like '%$search%' order by nome_comprador asc");
			$row=mysqli_num_rows($query);
			if($row=='')
			{
				echo "Nenhum reseultado encontrado!";
			}
			else
			{
				echo "<table class='table table-striped' border=0>";
				echo "<tr><td>#</td><td>Nome</td><td>Data de nascimento</td><td>Telefone</td><td>Endereço</td><td>CPF</td><td>RG</td><td>Estado</td><td>Cidade</td><td>P_R_fiscal</td><td>P_R_fgts</td><td>P_I_Debitos</td><td>Ano</td></tr>";
				while($array=mysqli_fetch_array($query))					
				{
					echo "<tr><td>$array[id_comprador]</td><td>$array[nome_comprador]</td><td>$array[nascimento]</td><td>$array[telefone]</td><td>$array[endereco]</td><td>$array[cpf]</td><td>$array[rg]</td><td>$array[estado]</td><td>$array[cidade]</td><td>$array[p_r_fiscal]</td><td>$array[p_r_fgts]</td><td>$array[p_i_debitos]</td><td>$array[ano]</td></tr>";
				}	
				echo "</table>";
			}
		}
	}	
	else if(isset($table))
	{
		if($table=='tbl_animais')
		{
			$query=mysqli_query($con,"SELECT * FROM tbl_animais WHERE nome_animal like '%$search%'  or raca like '%$search%'");	
			$row= mysqli_num_rows($query);
			if($row=='')
			{
				echo "Nenhum resultado encontrado!";
			}
			else
			{
				echo "<table class='table table-striped' border=0>";
				echo "<tr><td>#</td><td>Nome</td><td>Brinco</td><td>Peso</td><td>Data da pesagem</td><td>Data de Nascimento</td><td>Raça</td><td>Descrição</td><td>Ano</td></tr>";
				while($array=mysqli_fetch_array($query))					
				{
					echo "<tr><td>$array[id_animal]</td><td>$array[nome_animal]</td><td>$array[brinco]</td><td>$array[peso]</td><td>$array[data_pesagem]</td><td>$array[nascimento]</td><td>$array[raca]</td><td>$array[descricao]</td><td>$array[ano]</td></tr>";
				}
			}
		}
		if($table=='lote')
		{
			$query=mysqli_query($con,"SELECT * FROM tbl_lotes WHERE nome like '%$search%'");
			$row= mysqli_num_rows($query);
			if($row=='')
			{
				echo "Nenhum resultado encontrado!";
			}
			else
			{
				echo "<table class='table table-striped' border=0>";
				echo "<tr><td>#</td><td>Nome</td><td>Ano</td><td>Valor</td></tr>";
				while($array=mysqli_fetch_array($query))					
				{
					echo "<tr><td>$array[id_lote]</td><td>$array[nome]</td><td>$array[ano]</td><td></td></tr>";
				}
			}
		}
		
		if($table=='compradores')
		{
			$query=mysqli_query($con,"SELECT * FROM tbl_compradores where nome_comprador like '%$search%'");
			$row=mysqli_num_rows($query);
			if($row=='')
			{
				echo "Nenhum reseultado encontrado!";
			}
			else
			{
				echo "<table class='table table-striped' border=0>";
				echo "<tr><td>#</td><td>Nome</td><td>Data de nascimento</td><td>Telefone</td><td>Endereço</td><td>CPF</td><td>RG</td><td>Estado</td><td>Cidade</td><td>P_R_fiscal</td><td>P_R_fgts</td><td>P_I_Debitos</td><td>Ano</td></tr>";
				while($array=mysqli_fetch_array($query))					
				{
					echo "<tr><td>$array[id_comprador]</td><td>$array[nome_comprador]</td><td>$array[nascimento]</td><td>$array[telefone]</td><td>$array[endereco]</td><td>$array[cpf]</td><td>$array[rg]</td><td>$array[estado]</td><td>$array[cidade]</td><td>$array[p_r_fiscal]</td><td>$array[p_r_fgts]</td><td>$array[p_i_debitos]</td><td>$array[ano]</td></tr>";
				}	
				echo "</table>";
			}
		}
	}
?>