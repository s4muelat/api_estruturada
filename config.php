<?php
//PDO
$dbbanco = "horus";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";

try {
    $pdo = new PDO("mysql:dbname:$dbbanco;host=$dbhost", "$dbuser", "$dbpass");
    // Mostrar erro interno 
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Falhou: ".$e->getMessage();
}

$array = [];
