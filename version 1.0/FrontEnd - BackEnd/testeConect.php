<?php
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'crm';
$con = new mysqli($servidor, $usuario, $senha, $banco);
if ($con->connect_error) {
die("Connection failed: " . $con->connect_error);
}else{
echo "Conectou !!";
} 
?>