<?php 

$depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
$pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: ".$pathToRoot."../verify.php");
        exit();
    }
    require_once $pathToRoot."PHP/db.php";
    $user_id = $_SESSION['user']['id'];
    $article_id = $_POST['article_id'];
    $comment_id = $_POST['comment_id'];
    $rating = $_POST['star-input'];
    if (empty($article_id) || empty($rating)) {
        header("Location: ".$pathToRoot."PAGES/ARTICLE/read.php?id=".$article_id."&r=Erro_campos_faltantes");
        exit();
    }
    if (empty($comment_id) || !is_numeric($comment_id)) {
        header("Location: ".$pathToRoot."PAGES/ARTICLE/read.php?id=".$article_id."&r=Erro_comentario_invalido");
        exit();
    }
    if ($rating < 1 || $rating > 5) {
        header("Location: ".$pathToRoot."PAGES/ARTICLE/read.php?id=".$article_id."&r=Erro_avaliação_invalida");
        exit();
    }

    // check if not rated already
    $stmt = $pdo->prepare("SELECT * FROM ratings_comment WHERE user_id = ? AND comment_id = ?");
    $stmt->execute([$user_id, $comment_id]);
    $existing_rating = $stmt->fetch(PDO::FETCH_ASSOC);

    // if exists, update
    if ($existing_rating) {
        $stmt = $pdo->prepare("UPDATE ratings_comment SET rating = ?, creation = NOW() WHERE user_id = ? AND comment_id = ?");
        $stmt->execute([$rating, $user_id, $comment_id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO ratings_comment (user_id, comment_id, rating, creation) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$user_id, $comment_id, $rating]);
    }

    $pdo = null;
    header("Location: ".$pathToRoot."PAGES/ARTICLE/read.php?id=".$article_id."&r=Avaliação registrada com sucesso!");
    exit();
}