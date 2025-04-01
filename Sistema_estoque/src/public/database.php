<?php
$host = "localhost"; // Endereço do servidor MySQL
$user = "root";      // Usuário do MySQL (padrão no XAMPP/WAMP)
$pass = "";          // Senha do MySQL (vazia por padrão no XAMPP/WAMP)
$database = "sistemaestoque";  // Nome do banco de dados (substitua pelo seu)

$connect=mysqli_connect($host,$user,$pass,$database);

if(mysqli_connect_error()){
    error_log('erro:'.mysqli_connect_error()); 
}
?>