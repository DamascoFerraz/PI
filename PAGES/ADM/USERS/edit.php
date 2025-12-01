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
            <p>Bem-vindo à área de administração. Aqui você pode gerenciar usuários</p>
            <hr>
            <p>Você está loggado como:</p>
            <h3><?=htmlspecialchars($_SESSION['user']['username'])?> (<?=htmlspecialchars($_SESSION['user']['position'])?> | ID: <?= $_SESSION['user']['id'] ?>)</h3>
        </hgroup>
        <br>

        
        <div class="container-fluid">
            <h2>Edição de usuario</h2>
            
            </tr>

            <?php
                require_once $pathToRoot."PHP/adm_pull_user_by_id.php";
                if (!$user) {
                    echo "<p>Usuário não encontrado.</p>";
                } else {
                    ?>
                    <form action="<?= $pathToRoot ?>PHP/adm_process_user.php" method="POST">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

                        <label for="username">Username:</label>
                        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

                        <label for="position">Position:</label>
                        <select name="position" required>
                            <option value="administrador" <?= $user['position'] == 'administrador' ? 'selected' : '' ?>>administrador</option>
                            <option value="professor" <?= $user['position'] == 'professor' ? 'selected' : '' ?>>professor</option>
                            <option value="user" <?= $user['position'] == 'user' ? 'selected' : '' ?>>user</option>
                        </select>

                        <label for="is_active">Is Active:</label>
                        <select name="is_active" required>
                            <option value="1" <?= $user['is_active'] ? 'selected' : '' ?>>active</option>
                            <option value="0" <?= !$user['is_active'] ? 'selected' : '' ?>>inactive</option>
                        </select>

                        <button type="submit">Salvar alterações</button>
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