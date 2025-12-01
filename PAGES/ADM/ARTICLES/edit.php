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
            <p>Bem-vindo à área de administração. Aqui você pode gerenciar artigos</p>
            <hr>
            <p>Você está loggado como:</p>
            <h3><?=htmlspecialchars($_SESSION['user']['username'])?> (<?=htmlspecialchars($_SESSION['user']['position'])?> | ID: <?= $_SESSION['user']['id'] ?>)</h3>
        </hgroup>
        <br>

        
        <div class="container-fluid">
            <h2>Edição de artigos</h2>
            
            </tr>

            <?php
                require_once $pathToRoot."PHP/adm_pull_article_by_id.php";
                if (!$article) {
                    echo "<p>comentario não encontrado.</p>";
                } else {
                    ?>
                    <form action="<?= $pathToRoot ?>PHP/adm_process_article.php" method="POST">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($article['id']) ?>">
                        <label for="title">Title:</label>
                        <input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
                        <label for="descr">Descr:</label>
                        <input type="text" name="descr" value="<?= htmlspecialchars($article['descr']) ?>" required>
                        <label for="content">Content:</label>
                        <textarea name="content" rows="10" required><?= htmlspecialchars($article['content']) ?></textarea>
                        <label for="is_active">Is Active:</label>
                        <select name="is_active" required>
                            <option value="1" <?= $article['is_active'] == 1 ? 'selected' : '' ?>>active</option>
                            <option value="0" <?= $article['is_active'] == 0 ? 'selected' : '' ?>>inactive</option>
                        </select>

                        

                        <button type="submit" class="primary">Salvar alterações</button>
                    </form>

                    <?php
                }
                

                
            ?>
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