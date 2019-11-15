<?php
$ci = curl_init();

curl_setopt( $ci, CURLOPT_URL, "http://localhost/crm/webservice/check.php" ); 
curl_setopt( $ci, CURLOPT_POST, true);
curl_setopt( $ci, CURLOPT_POSTFIELDS, array(
    'login' => 'david',
    'senha' => 'david'
));
curl_setopt( $ci, CURLOPT_HEADER, false );
curl_setopt( $ci, CURLOPT_RETURNTRANSFER, 1 );

$result = curl_exec( $ci );

$_retorno = json_decode( $result, true );

#var_dump($result);
echo $result;

?>