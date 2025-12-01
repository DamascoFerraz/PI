<?php
// pull article by id

    require_once $pathToRoot."PHP/db.php";

    $query = 
        "SELECT *
        FROM articles
        WHERE id = ? ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['id']]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    // closing connection
    $pdo = null;    