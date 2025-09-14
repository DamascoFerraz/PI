<?php

$depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
$pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (
        $_POST['username'] == NULL or 
        $_POST['pwd'] == NULL
        ){

        header('Location: '.$pathToRoot.'verify.php?f=sign&r=Informações%20de%20registro%20faltando,%20NULL%20fields');
        die;
    };
    if (
        empty(str_replace(' ','',$_POST['username'])) or 
        empty(str_replace(' ','',$_POST['pwd']))
        ) {

        header('Location: '.$pathToRoot.'verify.php?f=sign&r=Informações%20de%20registro%20faltando%20space%20fields');
        die;
    };

    $username = htmlspecialchars($_POST['username']);
    $pwd = htmlspecialchars($_POST['pwd']);

    require_once $pathToRoot."PHP/db.php";

    $query = 'SELECT * from users where username=(?);';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);

    if($stmt->rowCount()>0){
        header('Location: '.$pathToRoot.'verify.php?f=sign&r=Usuario%20já%20Cadastrado,%20registre%20com%20outro%20username');
        die;
    };

    $query = NULL;
    $stmt = NULL;
    

    $query = 'INSERT INTO users (username, pwd, position, creation, is_active) VALUES (?,?,?,?,?);';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, sha1($_POST['pwd']."batata"),  "user", date('Y-m-d H:i:s'), 1]);

    $query = NULL;
    $stmt = NULL;

    $query = 'SELECT * from users where username=(?);';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    session_start();

    $_SESSION['user']['id'] = $row['id'];
    $_SESSION['user']['username'] = $username;
    $_SESSION['user']['position'] = $position;

    header('Location: '.$pathToRoot.'PAGES/home.php?r=Registrado%20com%20sucesso!');
    die;
};