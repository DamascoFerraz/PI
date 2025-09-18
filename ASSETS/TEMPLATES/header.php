<!DOCTYPE html>
<html lang="pt-br" id="htmltag">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= $pathToRoot?>ASSETS/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.amber.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= $pathToRoot?>CSS/mainpage.css">
    <title>PostIt | <?= $pageName ?></title>
    <?php
        // (r) return message for modal
        if (!isset($_GET['r'])){
            $_GET['r'] = '';
        };
        echo "<script>var r = '".$_GET['r']."';</script>";

        session_start();

        if (!isset($_SESSION['user'])) {
            $logged = FALSE;
            echo "<script>var logged = false;</script>";
        } else {
            $logged = TRUE;
            echo "<script>var logged = true;</script>";
        }
    ?>
</head>
<body>
    <!------------------------------------------- HEADER ------------------------------------------->
    <header>
        <div class="container">
            <div class="title">
                <div><img id="logo" width=50rem src="<?= $pathToRoot?>ASSETS/logo.png" alt="PostIt_logo"></div>
                <hgroup>
                    <h3>PostIt</h3>
                    <p>Artigos de alunos Para alunos</p>
                </hgroup>
            </div>

            <nav>
                <button class="outline contrast theme-togle" onclick="darkMode()"><i id="theme-icon" class="fa-regular fa-moon"></i></button>

                <?php if(!isset($_SESSION['user']['id'])): ?>
                    <button class="outline contrast" onclick="window.location.replace('<?= $pathToRoot?>verify.php?f=log')">Sou membro</button>
                <?php else: ?>
                    <button class="outline contrast" onclick="window.location.replace('<?= $pathToRoot?>log_off.php')">Sair <i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                <?php endif; ?>
            </nav>
        </div>
    </header>