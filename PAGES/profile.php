<?php
    // setting path to root (used in archive and page links)
    $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
    $pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

    // setting page name (used in header)
    $pageName = "Exemplo de pagina";

    // loading header
    require_once $pathToRoot."ASSETS/TEMPLATES/header.php";

    // loading theme control script
    echo "<script src='".$pathToRoot."JS/theme_control.js'></script>";

    // loading aside
    require_once $pathToRoot."ASSETS/TEMPLATES/aside.php";
?>

    <section class="content container-fluid">
        <h1>Seu perfil</h1>
        <p>
            Bem-vindo ao seu perfil, <?= htmlspecialchars($_SESSION['user']['username']) ?>, aqui voce pode editar as informações de seu perfil e visualizar seus artigos!
        </p>
        <hr>
        <h2>Editar informações do perfil</h2>
        <form action="<?= $pathToRoot ?>PHP/profile_process.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($_SESSION['user']['id']) ?>">

            <label for="username">Username:</label>
            <input type="text" name="username" value="<?= htmlspecialchars($_SESSION['user']['username']) ?>" required>

            <label for="pwd">New Password:</label>
            <input placeholder="deixe vazio para atualizar apenas o username" type="password" name="pwd" id="inpt-pwd-mem" pattern=".{8,}">

            <button type="submit" class="primary">Salvar alterações</button>
        </form>

        <hr>
        <h2>Seus artigos</h2>
        <p>Aqui estão os artigos que você publicou:</p>

        <?php
            require_once $pathToRoot."PHP/pull_articles_by_author.php";
            if (empty($articles)) {
                echo "<p>Você não publicou nenhum artigo ainda.</p>";
            } else {
                echo "<div class='container-fluid cards-row'>";
                
                listArticles($articles);
                
                echo "</div>";
            }
        ?>

    </section>

<?php
    // loading modal (return messages)
    require_once $pathToRoot."ASSETS/TEMPLATES/modal.php";

    // loading modal control script
    echo "<script src='".$pathToRoot."JS/modal_control.js'></script>" ;

    // loading footer
    require_once $pathToRoot."ASSETS/TEMPLATES/footer.php";
?>