<?php
function checkToken($token){
    $ci = curl_init();
    curl_setopt( $ci, CURLOPT_URL, "https://miniapp-ifnmg.herokuapp.com/usuario/". $token);
    curl_setopt( $ci, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec( $ci );
    curl_close($ci);
    $resp = json_decode($result, true);
    return $resp["login"];
}
?>