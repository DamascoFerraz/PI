<?php
    // setting path to root (used in archive and page links)
    $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
    $pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

    // setting page name (used in header)
    $pageName = "Bem vindo!";

    // loading header
    require_once $pathToRoot."ASSETS/TEMPLATES/header.php";

    // loading theme control script
    echo "<script src=".$pathToRoot."'JS/theme_control.js'></script>";

    // loading aside
    // require_once $pathToRoot."ASSETS/TEMPLATES/aside.php";
?>
    <link rel="stylesheet" href="<?= $pathToRoot?>CSS/index.css">
    <!------------------------------------------- MAIN ------------------------------------------->
    <main>
        <hgroup class="info-pannel">
            <h1>PostIt</h1>
            <h3>Artigos de alunos para alunos</h3>
            <p>faça parte!</p>
            <div class="container">
                <button class="primary" onclick="window.location = 'PAGES/home.php'">Vamos lá!</button>
            </div>
        </hgroup>
        <img id="logo-mp" width=300rem src="<?= $pathToRoot?>ASSETS/logo.png" alt="NEABI_logo">
    </main>

<?php
    // loading modal (return messages)
    require_once $pathToRoot."ASSETS/TEMPLATES/modal.php";

    // loading modal control script
    echo "<script src=".$pathToRoot."'JS/modal_control.js'></script>" ;

    // loading footer
    require_once $pathToRoot."ASSETS/TEMPLATES/footer.php";
?>