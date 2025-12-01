<?php

// pull tag by id
    require_once $pathToRoot."PHP/db.php";


    $query = 
        "SELECT *
        FROM tags
        WHERE id = ? ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['id']]);
    $tag = $stmt->fetch(PDO::FETCH_ASSOC);

    // closing connection
    $pdo = null;