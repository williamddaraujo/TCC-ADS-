<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'w1w2w3';
$dbName = 'fomularioalunos';

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Verifica a conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}
?>
