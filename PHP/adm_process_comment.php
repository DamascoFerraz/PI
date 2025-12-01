<?php
$depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
$pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";
// process user data from edit user page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once $pathToRoot."PHP/db.php";
    // get and sanitize input data
// process comment edit form submission

    require_once $pathToRoot."PHP/db.php";

    $query = 
        "UPDATE comments
        SET content = ?, author_id = ?, article_id = ?, is_active = ?
        WHERE id = ? ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        $_POST['content'],
        $_POST['author_id'],
        $_POST['article_id'],
        $_POST['is_active'],
        $_POST['id']
    ]);

    // closing connection
    $pdo = null;

    // redirecting to comments admin index
    header("Location: ".$pathToRoot."PAGES/ADM/COMMENTS/index.php");
    exit();
} else {
    // if not a POST request, redirect to comments admin index
    header("Location: ".$pathToRoot."PAGES/ADM/COMMENTS/index.php");
    exit();
}
?>