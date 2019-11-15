<?php
# definicчѕes bсsicas sobre base de dados
$_config['app_name'] = 'Webservice CRM';
$_config['url']      = 'http://localhost/crm/webservice/';
$_config['dbhost']   = 'localhost';
$_config['dbname']   = 'crm';
$_config['dbuser']   = 'root';
$_config['dbpass']   = '';
 
# apresentar o debug completo ?
$_config['show_error_log'] = false; 
# -------------------------------------------------------
/**
 * Retorna uma resposta JSON para o Solicitante.
 * 
 * @param  boolean $__success - indica se houve sucesso na operaчуo
 * @param  string  $__message - uma mensagem opcional
 * @param  array   $_dados    - dados a serem retornados
 * @return JSON REST
 */
function __output_header__( $__success = true, $__message = null, $_dados = array() )
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(
        array(
            'success' => $__success,
            'message' => $__message,
            'dados'   => $_dados
        )
    );
    # por ser a ultima funcao, podemos matar o processo aqui.
    exit;
}
?>