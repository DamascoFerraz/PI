<!-- process tag -->
<?php
    $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
$pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";
// process user data from edit user page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once $pathToRoot."PHP/db.php";
    // get and sanitize input data
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $is_active = filter_input(INPUT_POST, 'is_active', FILTER_VALIDATE_INT);
    // update user in database
    $query = 
        "UPDATE tags 
        SET name = ?, is_active = ? 
        WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$name, $is_active, $id]);
    // redirect back to user list with success message
    header("Location: ".$pathToRoot."PAGES/ADM/TAGS/index.php?r=Tag%20atualizada%20com%20sucesso");
    exit();
} else {
    // if not a POST request, redirect to user list
    header("Location: ".$pathToRoot."PAGES/ADM/TAGS/index.php?r=Requisição%20inválida");
    exit();
}
?>