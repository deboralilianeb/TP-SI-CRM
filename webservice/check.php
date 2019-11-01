<?php
# obtendo nosso arquivo de configurac�es
require_once 'webservice_init.php';

# verificando se o m�todo de envio � mesmo  POST.
if( $_SERVER['REQUEST_METHOD'] !== "POST" )
    __output_header__( false, "M�todo de requisi��o n�o aceito.", null );

# Lembre-se que os dados s�o recebidos via POST
# obtenha e processe aqui os dados atrav�s do $_POST

# obtendo os dados $_POST com o vita
$login =  isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE;
$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;

$conn = mysqli_connect($_config['dbhost'], $_config['dbuser'], $_config['dbpass'], $_config['dbname']);

if(!$login || !$senha) 
{ 
    __output_header__( FALSE, "Login ou senha n�o fornecido", null ); 
    exit; 
}

$SQL = "SELECT * 
FROM usuarios
WHERE login = '{$login}'"; 

$result_id = mysqli_query($conn, $SQL) or die("Erro no banco de dados!"); 
$total = mysqli_num_rows($result_id);
 
// Caso o usu�rio tenha digitado um login v�lido o n�mero de linhas ser� 1.. 
if($total) 
{ 
    // Obt�m os dados do usu�rio, para poder verificar a senha e passar os demais dados para a sess�o 
    $dados = array();
    while( $row_usuarios = mysqli_fetch_array($result_id)) {  
        $dados["nome"] = $row_usuarios["nome"];
        $dados["login"] = $row_usuarios["login"];
        $dados["email"] = $row_usuarios["email"];
        $dados["tipo"] = $row_usuarios["tipo"];
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
        __output_header__( FALSE, "Senha Inv�lida", $dados ); 
    exit; 
    } 
} 
    // Login inv�lido 
else
{ 
    __output_header__( FALSE, "Login Inv�lido", $dados );
    exit; 
} 

?>