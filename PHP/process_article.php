<?php

$depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
$pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    session_start();

    $content = $_POST['content'];
    $title = $_POST['title'];
    $author_id = $_SESSION['user']['id'];
    $descr = $_POST['description'];
    $author = $_SESSION['user']['username'];
    $tags = $_POST['tags']; // array de tags selecionadas
    $creation = date('Y-m-d H:i:s'); // data e hora atual

    if (empty($content) || empty($title) || empty($descr) || empty($tags)) {
        header("Location: ".$pathToRoot."PAGES/ARTICLE/write.php?r=Erro_campos_faltantes");
    }

    require_once $pathToRoot."PHP/db.php";

    
    $stmt = $pdo->prepare("INSERT INTO articles (title, content, author_id, descr, creation) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $content, $author_id, $descr, $creation]);
    $article_id = $pdo->lastInsertId();
    if (!$article_id) {
        header("Location: ".$pathToRoot."PAGES/ARTICLE/write.php?r=Erro_inserir_artigo");
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO article_tags (article_id, tag_id) VALUES (?, ?)");
    foreach ($tags as $tag_id) {
        $stmt->execute([$article_id, $tag_id]);
    }
    

    $pdo = null;
    header("Location: ".$pathToRoot."PAGES/ARTICLE/read.php?id=".$article_id);
    exit();
} else {
    header("Location: ".$pathToRoot."PAGES/home.php");
    exit();
}
?>