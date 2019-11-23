<?php
    include("connection.php");

    $idusuario = $_POST["idusuario"];
    $option = $_POST["option"];
    $info = [];

    switch ($option){
        case 'salvar':
            $nome = $_POST["nome"];
            $login = $_POST["login"];
            $email = $_POST["email"];
            $tipo = $_POST["tipo"];
            edit($idusuario, $nome, $login, $email, $tipo, $conn);
            break;

        case 'excluir':
            delete($idusuario, $conn);
            break;
    }


    function edit($idusuario, $nome, $login, $email, $tipo, $conn){
        $query = "UPDATE usuarios
                SET nome = '$nome',
                    login = '$login',
                    email = '$email',
                    tipo = '$tipo'
                WHERE   id = $idusuario";

        $result_query = pg_query($conn, $query);
        check_result($result_query);
        finish($conn);                     
    }

    function delete($idusuario, $conn){
        $query = "UPDATE usuarios
                SET estado = FALSE
                WHERE   id = $idusuario";

        $result_query = pg_query($conn, $query);
        check_result($result_query);
        finish($conn);                     
    }


    function check_result($result_query){
        if(!$result_query){
            $info['result'] = "ERROR";
            $info['extra'] = pg_last_error();
        }
        else{
            $info['result'] = "SUCCESS";
            $info['extra'] = "";
        }
        echo json_encode($info);
    }

    function finish($conn){
        pg_close($conn);
    }
?>