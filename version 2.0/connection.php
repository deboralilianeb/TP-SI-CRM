<?php
$con_string = "host=localhost port=5432 dbname=crm user=postgres password=admin";
$conn = pg_connect($con_string);
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>