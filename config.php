<?php
//PDO
$db_banco = "horus";
$db_host = "localhost";
$db_user = "root";
$db_pass = "";

try {
    $pdo = new PDO("mysql:dbname=$db_banco;host=$db_host", "$db_user", "$db_pass");
    // Mostrar erro interno 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Falhou: ".$e->getMessage();
}

$array = [
    'error' => '',
    'result' => []    
];
