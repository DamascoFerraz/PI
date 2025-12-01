<?php

require_once $pathToRoot."PHP/db.php";

$query = 
    "SELECT id, username, position, creation, is_active
    FROM users
    WHERE id = ? ";

$stmt = $pdo->prepare($query);
$stmt->execute([$_GET['id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

