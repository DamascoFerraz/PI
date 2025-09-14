<?php

$dsn = "mysql:host=localhost;dbname=postit";
$dbusername = "root";
$dbpassword = "123456";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage(); // Exibe uma mensagem de erro com a descrição da exceção
}