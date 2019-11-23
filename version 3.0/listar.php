<?php
include("connection.php");

$query = "SELECT * FROM usuarios WHERE estado = TRUE  ORDER BY nome;";
$resultado_usuarios = pg_query($conn, $query);
if (!$resultado_usuarios){
	die("Error");
} else {
	$dados = [];
	while( $data = pg_fetch_assoc($resultado_usuarios) ) {
		$dados["data"][] = array_map("utf8_encode", $data);
	}
	echo json_encode($dados); 
}

pg_free_result($resultado_usuarios);
pg_close($conn);