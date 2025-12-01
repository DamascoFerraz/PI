<?php
    // setting path to root (used in archive and page links)
    $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
    $pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

    // setting page name (used in header)
    $pageName = "Administração";

    // loading header
    require_once $pathToRoot."ASSETS/TEMPLATES/header.php";

    // loading theme control script
    echo "<script src='".$pathToRoot."JS/theme_control.js'></script>";

    // loading aside
    require_once $pathToRoot."ASSETS/TEMPLATES/aside.php";

    if (!isset($_SESSION['user']) || $_SESSION['user']['position'] !== 'administrador') {
        header("Location: ".$pathToRoot."PAGES/home.php?r=Acesso%20negado");
        exit();
    }
?>

    <section class="content container-fluid">
        <hgroup>
            <h1>Area de Administração</h1>
            <p>Bem-vindo à área de administração. Aqui você pode gerenciar usuários, artigos e configurações do sistema.</p>
            <hr>
            <p>Você está loggado como:</p>
            <h3><?=htmlspecialchars($_SESSION['user']['username'])?> (<?=htmlspecialchars($_SESSION['user']['position'])?> | ID: <?= $_SESSION['user']['id'] ?>)</h3>
        </hgroup>
        <br>

        <style>
            a{
                text-decoration: none;
            }
            .cards-row{
                flex-wrap: nowrap;
            }
        </style>
        <div class="container-fluid cards-row">
            <a href="<?= $pathToRoot ?>PAGES/ADM/USERS">
                <article>
                    <h2>Gerenciar Usuários</h2>
                    <p>Adicione, remova ou modifique usuários do sistema.</p>
                </article>
            </a>
            <a href="<?= $pathToRoot ?>PAGES/ADM/ARTICLES">
                <article>
                    <h2>Gerenciar artigos</h2>
                    <p>Adicione, remova ou modifique artigos do sistema.</p>
                </article>
            </a>
            <a href="<?= $pathToRoot ?>PAGES/ADM/TAGS">
                <article>
                    <h2>Gerenciar tags</h2>
                    <p>Adicione, remova ou modifique tags do sistema.</p>
                </article>
            </a>
            <a href="<?= $pathToRoot ?>PAGES/ADM/COMMENTS">
                <article>
                    <h2>Gerenciar comentarios</h2>
                    <p>Adicione, remova ou modifique comentarios do sistema.</p>
                </article>
            </a>

        </div>


    </section>

<?php
    // loading modal (return messages)
    require_once $pathToRoot."ASSETS/TEMPLATES/modal.php";

    // loading modal control script
    echo "<script src='".$pathToRoot."JS/modal_control.js'></script>" ;

    // loading footer
    require_once $pathToRoot."ASSETS/TEMPLATES/footer.php";
?>