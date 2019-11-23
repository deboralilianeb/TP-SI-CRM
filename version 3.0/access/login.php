<?php
  session_start();
  include("../connection.php");

  $login =  isset($_POST["login"]) ? pg_escape_string(trim($_POST["login"])) : FALSE;
  $senha = isset($_POST["senha"]) ? pg_escape_string(trim($_POST["senha"])) : FALSE;
  $info = [];

  if(!$login || !$senha)
  {
      $info['result'] = "Login ou senha nao fornecido";
      echo json_encode($info);
      exit();
  }

  $SQL = "SELECT *
  FROM usuarios
  WHERE login = '{$login}' and estado = TRUE";

  $result_id = pg_query($conn, $SQL) or die("Erro no banco de dados!");
  $total = pg_num_rows($result_id);

  // Caso o usuário tenha digitado um login válido o número de linhas será 1..
  if($total)
  {
      // Obtém os dados do usuário, para poder verificar a senha e passar os demais dados para a sessão
      $dados = array();
      while( $row_usuarios = pg_fetch_array($result_id)) {
          $dados["nome"] = utf8_encode($row_usuarios["nome"]);
          $dados["login"] = utf8_encode($row_usuarios["login"]);
          $dados["email"] = utf8_encode($row_usuarios["email"]);
          $dados["tipo"] = utf8_encode($row_usuarios["tipo"]);
          $dados["senha"] = $row_usuarios["senha"];
      }
      pg_close($conn);

      // Agora verifica a senha
      $senha = hash('sha384', $senha);
      if(!strcmp($senha, $dados["senha"]))
      {
          // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário
          if (!strcmp($dados['tipo'], "Admin")){
              $_SESSION['usuario'] = $dados["login"];
              $info['result'] = "ADMIN";
          }
          else{
              $info['result'] = "Usuario nao tem permissao";
          }
          echo json_encode($info);
          exit();
      }
      // Senha inválida
      else
      {
          $info['result'] = "Senha Errada";
          echo json_encode($info);
          exit();
      }
  }
  // Login inválido
  else
  {
      pg_close($conn);
      $info['result'] = "Login errado";
      echo json_encode($info);
      exit();
  }
?>
