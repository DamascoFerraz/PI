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
            <p>Bem-vindo à área de administração. Aqui você pode gerenciar TAGS</p>
            <hr>
            <p>Você está loggado como:</p>
            <h3><?=htmlspecialchars($_SESSION['user']['username'])?> (<?=htmlspecialchars($_SESSION['user']['position'])?> | ID: <?= $_SESSION['user']['id'] ?>)</h3>
        </hgroup>
        <br>

        
        <div class="container-fluid cards-row">
            <h2>listagem de tags</h2>
            <table>
            <tr>
                <form action="" method="get">
                        <th><input type="number" name="id" id="id" placeholder='ID'></th>
                        <th><input type="text" name="name" id="name" placeholder='name'></th>
                        <th><select name='is_active' id='is_active'>
                                <option value="" disabled selected>is active</option>
                                <option value="1">active</option>
                                <option value="0">inactive</option>
                        </select></th>
                        <th><button style="" type="button" class="secondary" onclick='window.location.replace("<?= $pathToRoot ?>PAGES/ADM/TAGS/create.php")'><i class="fa-solid fa-plus"></i></button></th>
                        <button style="" type="submit" class="primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </tr>

            <?php
                require_once $pathToRoot."PHP/adm_pull_tags.php";

                if (empty($tags)) {

                    echo "<tr><td>Nenhuma tag encontrado.</td></tr>";
                } else {
                    foreach ($tags as $user) {
                        ?>
                            <tr style='cursor:pointer;' onclick='window.location.replace("<?= $pathToRoot ?>PAGES/ADM/TAGS/edit.php?id=<?=htmlspecialchars($user["id"]) ?>")'>
                                <td><?=htmlspecialchars($user['id'])?></td>
                                <td><?=htmlspecialchars($user['name'])?></td>
                                <td><?=htmlspecialchars($user['is_active'])?></td>
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