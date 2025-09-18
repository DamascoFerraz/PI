<?php
// pulling article by id

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once $pathToRoot.'PHP/db.php';

    $stmt = $pdo->prepare("
        SELECT articles.id, articles.title, articles.content, articles.creation, users.username AS author, articles.descr,
        AVG(ratings_article.rating) AS avg_rating
        FROM articles
        JOIN ratings_article ON articles.id = ratings_article.article_id
        JOIN users ON articles.author_id = users.id
        WHERE articles.id = ?
        GROUP BY articles.id, articles.title, articles.content, articles.creation, users.username 
    ");

    $stmt->execute([$_GET['id']]);
    $GET = $stmt->fetch(PDO::FETCH_ASSOC);


    if (!$GET) {
        // artigo não encontrado
        header("Location: ".$pathToRoot."PAGES/home.php?r=Artigo não encontrado.");
        exit();
    }
} else {
    // id invalido
    header("Location: ".$pathToRoot."PAGES/home.php?r=ID inválido.");
    exit();
}