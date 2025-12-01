<?php
$depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
$pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";
// edit user profile
require_once $pathToRoot."PHP/db.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get and sanitize input data
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $unhashed = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
    $pwd = !empty($unhashed) ? sha1($_POST['pwd']."batata") : "";
    // update user in database
    if (!empty($pwd)) {
        // update username and pwd
        $query = 
            "UPDATE users 
            SET username = ?, pwd = ? 
            WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $pwd, $id]);
    } else {
        // update only username
        $query = 
            "UPDATE users 
            SET username = ? 
            WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $id]);
    }
    // update session data
    $_SESSION['user']['username'] = $username;

    // redirect back to profile page with success message
    header("Location: ".$pathToRoot."PAGES/profile.php?r=Perfil%20atualizado%20com%20sucesso");
    exit();
} else {
    // if not a POST request, redirect to profile page
    header("Location: ".$pathToRoot."PAGES/profile.php?r=Requisição%20inválida");
    exit();
}
