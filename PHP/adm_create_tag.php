<?php
// create tag 
$depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
$pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";
// process user data from edit user page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once $pathToRoot."PHP/db.php";
    // get and sanitize input data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $is_active = filter_input(INPUT_POST, 'is_active', FILTER_VALIDATE_INT);
    // insert tag in database
    $query =
        "INSERT INTO tags (name, is_active) 
        VALUES (?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$name, $is_active]);
    // redirect back to tag list with success message
    header("Location: ".$pathToRoot."PAGES/ADM/TAGS/index.php?r=Tag%20criada%20com%20sucesso");
    exit();
} else {
    // if not a POST request, redirect to tag list
    header("Location: ".$pathToRoot."PAGES/ADM/TAGS/index.php?r=Requisição%20inválida");
    exit();
}