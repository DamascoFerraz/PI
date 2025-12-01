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
            <p>Bem-vindo à área de administração. Aqui você pode gerenciar comentarios</p>
            <hr>
            <p>Você está loggado como:</p>
            <h3><?=htmlspecialchars($_SESSION['user']['username'])?> (<?=htmlspecialchars($_SESSION['user']['position'])?> | ID: <?= $_SESSION['user']['id'] ?>)</h3>
        </hgroup>
        <br>

        
        <div class="container-fluid">
            <h2>Edição de comentarios</h2>
            
            </tr>

            <?php
                require_once $pathToRoot."PHP/adm_pull_comment_by_id.php";
                if (!$comment) {
                    echo "<p>comentario não encontrado.</p>";
                } else {
                    ?>
                    <form action="<?= $pathToRoot ?>PHP/adm_process_comment.php" method="POST">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($comment['id']) ?>">
                        <label for="content">Content:</label>
                        <input type="text" name="content" value="<?= htmlspecialchars($comment['content']) ?>" required>
                        <label for="author_id">Author ID:</label>
                        <input type="number" name="author_id" value="<?= htmlspecialchars($comment['author_id']) ?>" required>
                        <label for="article_id">Article ID:</label>
                        <input type="number" name="article_id" value="<?= htmlspecialchars($comment['article_id']) ?>" required>
                        <label for="is_active">Is Active:</label>
                        <select name="is_active" required>
                            <option value="1" <?= $comment['is_active'] == 1 ? 'selected' : '' ?>>active</option>
                            <option value="0" <?= $comment['is_active'] == 0 ? 'selected' : '' ?>>inactive</option>
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