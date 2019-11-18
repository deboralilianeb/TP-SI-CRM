<?php
# obtendo nosso arquivo de configurac�es
require_once 'service-config.php';
# obtendo arquivo de conex�o
include("../connection.php");
include("checkToken.php");

# verificando se o m�todo de envio � mesmo  GET.
if( $_SERVER['REQUEST_METHOD'] !== "GET" )
    __output_header__( false, "M�todo de request nao aceito.", null );

# verificar parametros
if( !isset($_GET["login"]) or !isset($_GET["senha"]) or !isset($_GET["token"]))
    __output_header__( false, "ERROR: Requer formato login=''&senha=''&token=''", null );

#---------------CONSULTAR TOKEN-----------------
#-----------------------------------------------
echo "teste";
if( !checkToken($_GET["token"]) ){
    echo "tese";
    __output_header__( false, "Token Invalido", null );
    exit;
}
#-----------------------------------------------

# obtendo os dados $_GET
$login =  isset($_GET["login"]) ? addslashes(trim($_GET["login"])) : FALSE;
$senha = isset($_GET["senha"]) ? hash('sha384', trim($_GET["senha"])) : FALSE;

if(!$login || !$senha) 
{ 
    __output_header__( FALSE, "Login ou senha nao fornecido", null ); 
    exit; 
}

$SQL = "SELECT * 
FROM usuarios
WHERE login = '{$login}' and estado = TRUE"; 

$result_id = pg_query($conn, $SQL) or die("Erro no banco de dados!"); 
$total = pg_num_rows($result_id);
 
// Caso o usu�rio tenha digitado um login v�lido o n�mero de linhas ser� 1.. 
if($total) 
{ 
    // Obt�m os dados do usu�rio, para poder verificar a senha e passar os demais dados para a sess�o 
    $dados = array();
    while( $row_usuarios = pg_fetch_array($result_id)) {  
        $dados["nome"] = utf8_encode($row_usuarios["nome"]);
        $dados["login"] = utf8_encode($row_usuarios["login"]);
        $dados["email"] = utf8_encode($row_usuarios["email"]);
        $dados["tipo"] = utf8_encode($row_usuarios["tipo"]);
        $dados["senha"] = $row_usuarios["senha"];
    }
 
    // Agora verifica a senha 
    if(!strcmp($senha, $dados["senha"])) 
    { 
        // TUDO OK! Agora, passa os dados para a sess�o e redireciona o usu�rio 
        if (strcmp($dados['tipo'], "ADMIN")){
            __output_header__( TRUE, "ADMIN", $dados ); 
        }
        else{
            __output_header__( TRUE, "CLIENT", $dados );
        }
        exit; 
    } 
    // Senha inv�lida 
    else
    { 
        __output_header__( FALSE, "invalid password", null );
        exit;
    } 
} 
// Login inv�lido 
else
{ 
    __output_header__( FALSE, "invalid login", null );
    exit;
} 
?>