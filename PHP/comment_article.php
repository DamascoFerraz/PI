<?php
session_start();
$depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
$pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

if (!isset($_SESSION['user'])) {
    header("Location: ".$pathToRoot."../verify.php");
    exit();
}
require_once $pathToRoot."PHP/db.php";
$user_id = $_SESSION['user']['id'];
$article_id = $_POST['article_id'];
$comment_text = trim($_POST['comment']);
if (empty($article_id) || empty($comment_text)) {
    header("Location: ".$pathToRoot."PAGES/ARTICLE/read.php?id=".$article_id."&r=Erro_campos_faltantes");
    exit();
}
$stmt = $pdo->prepare("INSERT INTO comments (author_id, article_id, content, creation) VALUES (?, ?, ?, NOW())");
$stmt->execute([$user_id, $article_id, $comment_text]);
$pdo = null;

header("Location: ".$pathToRoot."PAGES/ARTICLE/read.php?id=".$article_id."&r=Comentário adicionado com sucesso!");
exit();