<?php

$login = "paulo"; //usuario pre cadastrado
$senha = "paulo"; //senha pre cadastrada
$token = "1111111"; //Insira seu token aqui

// teste da função. (Pode excluir a linha abaixo depois de testar)
crmService($login, $senha, $token);


//input: nome_usuario, senha_usaruio, token
function crmService($login, $senha, $token)
{
    $ci = curl_init();
    $parameters = "?login=".$login ."&senha=".$senha ."&token=".$token;
    curl_setopt( $ci, CURLOPT_URL, "http://crm-si.herokuapp.com/service/checkget.php/". $parameters);
    curl_setopt( $ci, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec( $ci );
    curl_close($ci);
    $resp = json_decode($result, true);

    //Se executou corretamente
    if ($resp["success"]){
        //Se é um Administrador
        if (!strcmp($resp["message"], 'ADMIN')){
            // Faça algo com $resp["dados"]
            echo "Entrou como admin";
        }
        else { //Então é cliente
            // Faça algo com $resp["dados"]
            echo "Entrou como cliente";
        }
    }
    //Se não executou corretamente pode tratar os diferentes erros
    else {
          switch ($resp["message"]) {
            case "Metodo de request nao aceito.":
              // code...
              echo $resp["message"];
              break;

            case "ERROR: Requer formato login=''&senha=''&token=''":
              // code...
              echo $resp["message"];
              break;

            case "Token Invalido":
              // code...
              echo $resp["message"];
              break;

            case "Login ou senha nao fornecido":
              // code...
              echo $resp["message"];
              break;

            case "invalid password":
              // code...
              echo $resp["message"];
              break;

            case "invalid login":
              // code...
              echo $resp["message"];
              break;

            default:
              // code...
              echo "default";
              break;
          }
    }
}
?>
