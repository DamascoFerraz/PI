<?php
    require_once $pathToRoot."PHP/db.php";

    $query = 
        "SELECT *
        FROM comments
        WHERE id = ? ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['id']]);
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);

    // closing connection
    $pdo = null;