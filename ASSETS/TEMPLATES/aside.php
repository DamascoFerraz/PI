    <main>
        <!-- ASIDE -->
        <aside id="aside">
            <ul>
                <a href="<?= $pathToRoot ?>PAGES/home.php"><li><i class="fa-solid fa-house"></i> Home</li></a>
                <a href="<?= $pathToRoot ?>PAGES/articles.php"><li><i class="fa-solid fa-book"></i> Artigos</li></a>
                <a href="<?= $pathToRoot ?>PAGES/contact.php"><li><i class="fa-solid fa-handshake"></i> seja Professor!</li></a>
            </ul>

            <?php
            if (isset($_SESSION['user']) and $_SESSION['user']['position'] == "administrador"):?>
                <hr>
                <ul>
                    <a href="<?= $pathToRoot ?>PAGES/ADM/"><li><i class="fa-solid fa-house"></i> ADM hub</li></a>
                </ul>
            <?php endif; ?>
            <?php
            if (isset($_SESSION['user'])):?>
                <hr>
                <ul>
                    <a href="<?= $pathToRoot ?>PAGES/profile.php"><li><i class="fa-solid fa-user"></i> Perfil</li></a>
                    <a href="<?= $pathToRoot ?>log_off.php"><li><i class="fa-solid fa-right-from-bracket"></i> Sair</li></a>
                </ul>
            <?php else: ?>
                <hr>
                <ul>
                    <a href="<?= $pathToRoot ?>verify.php?f=log"><li><i class="fa-solid fa-right-to-bracket"></i> Entrar</li></a>
                    <a href="<?= $pathToRoot ?>verify.php?f=sign"><li><i class="fa-solid fa-user-plus"></i> Registrar</li></a>
                </ul>
            <?php endif; ?>
        </aside>
        <section class="content">
