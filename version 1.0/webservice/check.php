<?php
# obtendo nosso arquivo de configuracѕes
require_once 'webservice_init.php';

# verificando se o mщtodo de envio щ mesmo  POST.
if( $_SERVER['REQUEST_METHOD'] !== "POST" )
    __output_header__( false, "Mщtodo de requisiчуo nуo aceito.", null );

# Lembre-se que os dados sуo recebidos via POST
# obtenha e processe aqui os dados atravщs do $_POST

# obtendo os dados $_POST com o vita
$login =  isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE;
$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;

$conn = mysqli_connect($_config['dbhost'], $_config['dbuser'], $_config['dbpass'], $_config['dbname']);

if(!$login || !$senha) 
{ 
    __output_header__( FALSE, "Login ou senha nуo fornecido", null ); 
    exit; 
}

$SQL = "SELECT * 
FROM usuarios
WHERE login = '{$login}'"; 

$result_id = mysqli_query($conn, $SQL) or die("Erro no banco de dados!"); 
$total = mysqli_num_rows($result_id);
 
// Caso o usuсrio tenha digitado um login vсlido o nњmero de linhas serс 1.. 
if($total) 
{ 
    // Obtщm os dados do usuсrio, para poder verificar a senha e passar os demais dados para a sessуo 
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
        // TUDO OK! Agora, passa os dados para a sessуo e redireciona o usuсrio 
        if (strcmp($dados['tipo'], "ADMIN")){
            __output_header__( TRUE, "ADMIN", $dados ); 
        }
        else{
            __output_header__( TRUE, "CLIENT", $dados );
        }
        exit; 
    } 
    // Senha invсlida 
    else
    { 
        __output_header__( FALSE, "Senha Invсlida", $dados ); 
    exit; 
    } 
} 
    // Login invсlido 
else
{ 
    __output_header__( FALSE, "Login Invсlido", $dados );
    exit; 
} 

?>