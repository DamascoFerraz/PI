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

        
        <div class="container-fluid cards-row">
            <h2>listagem de comentarios</h2>
            <table>
            <tr>
                <form action="" method="get">
                        <th><input type="number" name="id" id="id" placeholder='ID'></th>
                        <th><input type="text" name="content" id="content" placeholder='content'></th>
                        <th><input type="number" name="author_id" id="user_id" placeholder='author ID'></th>
                        <th><input type="number" name="article_id" id="article_id" placeholder='article ID'></th>
                        <th><select name='is_active' id='is_active'>
                                <option value="" disabled selected>is active</option>
                                <option value="1">active</option>
                                <option value="0">inactive</option>
                        </select></th>
                        <button style="" type="submit" class="primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </tr>

            <?php
                require_once $pathToRoot."PHP/adm_pull_comments.php";

                if (empty($comments)) {

                    echo "<tr><td>Nenhum comentario encontrado.</td></tr>";
                } else {
                    foreach ($comments as $comment) {
                        ?>
                            <tr style='cursor:pointer;' onclick='window.location.replace("<?= $pathToRoot ?>PAGES/ADM/COMMENTS/edit.php?id=<?=htmlspecialchars($comment["id"]) ?>")'>
                                <td><?=htmlspecialchars($comment['id'])?></td>
                                <td><?=htmlspecialchars($comment['content'])?></td>
                                <td><?=htmlspecialchars($comment['author_id'])?></td>
                                <td><?=htmlspecialchars($comment['article_id'])?></td>
                                <td><?=htmlspecialchars($comment['is_active'])?></td>
                            </tr>
                        <?php
                    }
                }

                echo "</table>";
                
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