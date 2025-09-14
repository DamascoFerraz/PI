<?php

$depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
$pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['username'] == NULL or 
        $_POST['pwd'] == NULL){

        header('Location: '.$pathToRoot.'verify.php?f=log&r=Informações%20de%20login%20faltando');
        die;
    };
    if (empty(str_replace(' ','',$_POST['username'])) or 
        empty(str_replace(' ','',$_POST['pwd']))) {

        header('Location: '.$pathToRoot.'verify.php?f=log&r=Informações%20de%20login%20faltando');
        die;
    };

    $username = htmlspecialchars($_POST['username']);
    $pwd = htmlspecialchars($_POST['pwd']);

    require_once $pathToRoot."PHP/db.php"; //POR ALGUM MOTIVO SÓ FUNCIONA SE SAIR E ENTRAR NA PASTA (NAO ME PERGUNTE POR QUE)

    $query = "SELECT * from users where username=(?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);

    if($stmt->rowCount()<1){
        header('Location: '.$pathToRoot.'verify.php?f=log&r=Usuario%20nao%20Cadastrado');
        die;
    };

    $row = $stmt->fetch();

    $query = NULL;
    $stmt = NULL;

    if(sha1($_POST['pwd']."batata")!=$row['pwd']){
        header('Location: '.$pathToRoot.'verify.php?f=log&r=senha%20incorreta');
        die;
    };

    session_start();

    // getting the users data;
    $_SESSION['user']['id'] = $row['id'];
    $_SESSION['user']['username'] = $row['username'];
    $_SESSION['user']['position'] = $row['position'];

    header('Location: '.$pathToRoot.'PAGES/home.php?r=Logado%20com%20sucesso!');
    die;
};