<?php
// process article edit form admin
$depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
$pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";
// process user data from edit user page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once $pathToRoot."PHP/db.php";
    // get and sanitize input data
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $descr = filter_input(INPUT_POST, 'descr', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $is_active = filter_input(INPUT_POST, 'is_active', FILTER_VALIDATE_INT);
    // update article in database
    $query = 
        "UPDATE articles 
        SET title = ?, descr = ?, content = ?, is_active = ? 
        WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$title, $descr, $content, $is_active, $id]);
    // redirect back to article list with success message
    header("Location: ".$pathToRoot."PAGES/ADM/ARTICLES/index.php?r=Artigo%20atualizado%20com%20sucesso");
    exit();
} else {
    // if not a POST request, redirect to article list
    header("Location: ".$pathToRoot."PAGES/ADM/ARTICLES/index.php?r=Requisição%20inválida");
    exit();
}
?>