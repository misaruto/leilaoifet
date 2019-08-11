<?php
// Inclui o arquivo com a função valida_cpf
include('valida-cpf.php');

// Verifica o CPF
if ( valida_cpf( '470.392.165-07' ) ) {
    echo "CPF é válido. <br>";
} else {
    echo "CPF Inválido. <br>";
}

// Verifica o CPF
if ( valida_cpf( '470.392.165-09' ) ) {
	echo "CPF é válido. <br>";
} else {
	echo "CPF Inválido. <br>";
}