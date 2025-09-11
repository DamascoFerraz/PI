<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (
        $_POST['username'] == NULL or 
        $_POST['pwd'] == NULL or
        $_POST['creation-key'] == NULL
        ){

        header('Location: ../verify.php?f=sign&r=Informações%20de%20registro%20faltando,%20NULL%20fields');
        die;
    };
    if (
        empty(str_replace(' ','',$_POST['username'])) or 
        empty(str_replace(' ','',$_POST['pwd'])) or
        empty(str_replace(' ','',$_POST['creation-key']))
        ) {

        header('Location: ../verify.php?f=sign&r=Informações%20de%20registro%20faltando%20space%20fields');
        die;
    };

    $username = htmlspecialchars($_POST['username']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $creation_key = htmlspecialchars($_POST['creation-key']);

    require_once 'db.php';

    $query = 'SELECT * from users where username=(?);';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username]);

    if($stmt->rowCount()>0){
        header('Location: ../verify.php?f=sign&r=Usuario%20já%20Cadastrado,%20registre%20com%20outro%20username');
        die;
    };

    $query = NULL;
    $stmt = NULL;
    
    $query = 'SELECT * from creation_keys where creation_key=(?) and is_active=true;';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$creation_key]);
    
    if($stmt->rowCount()<1){
        header('Location: ../verify.php?f=sign&r=chave%20de%criacao%20invalida');
        die;
    };

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo->query('UPDATE creation_keys SET used = true, is_active = false where id ='.$row['id'].';');

    $used_key = $row['id'];
    $team = $row['team_id'];
    $position = $row['position'];
    
    $query = NULL;
    $stmt = NULL;

    $query = 'INSERT INTO users (username, pwd, position, team_id, creation, used_key_id) VALUES (?,?,?,?,?,?);';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, sha1($_POST['pwd']."batata"),  $position, $team, date('Y-m-d H:i:s'), $used_key]);

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
    $_SESSION['user']['team'] = $team;

    header('Location: ../PAGES/home.php?r=Registrado%20com%20sucesso!');
    die;
};