<?php
error_log();

if($_SERVER){
error_log("SGBG connect");
};
$host = 'localhost';
$dbname = 'sistemaestoque';
$user = 'root';
$pass = 'Logan';
$conn = new mysqli($host,$user,$pass, $dbname);

if ($conn->connect_error){
    error_log("Conexao falhou");
    die("Conexao falho: " . $conn->connect_error );
};
?>