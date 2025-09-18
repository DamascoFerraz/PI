<?php

// require_once $pathToRoot."PHP/db.php";

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    $stmt = $pdo->query("
        SELECT comments.id, comments.content, comments.creation, users.username AS author
        FROM comments
        JOIN users ON comments.author_id = users.id
        WHERE comments.article_id = $article_id
        ORDER BY comments.creation DESC
    ");
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    $comments = [];
}
$pdo = null;