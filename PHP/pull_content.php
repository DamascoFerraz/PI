<?php
// pulling article by id

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once $pathToRoot.'PHP/db.php';

    $stmt = $pdo->prepare("
        SELECT articles.id, articles.title, articles.descr, articles.content, articles.creation, users.username AS author
        FROM articles
        JOIN users ON articles.author_id = users.id
        WHERE articles.id = ?
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