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
                    <a href="adm.php"><li><i class="fa-solid fa-house"></i> ADM hub</li></a>
                </ul>
            <?php endif; ?>
        </aside>
        <section class="content">
