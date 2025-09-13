    <main>
        <!-- ASIDE -->
        <aside id="aside">
            <ul>
                <a href="home.php"><li><i class="fa-solid fa-house"></i> Home</li></a>
                <a href="articles.php"><li><i class="fa-solid fa-book"></i> Artigos</li></a>
                <a href="events.php"><li><i class="fa-solid fa-calendar"></i> Eventos</li></a>
                <a href="contact.php"><li><i class="fa-solid fa-handshake"></i> Seja NEABI</li></a>
            </ul>

            <?php
            if (isset($_SESSION['user']) and ($_SESSION['user']['position'] == "coordenador" or $_SESSION['user']['position'] == "administrador")) {
                echo '
                <hr>
                <ul>
                    <a href="mod.php"><li><i class="fa-solid fa-handshake"></i> Coordenação</li></a>
                </ul>
                ';
            };
            if (isset($_SESSION['user']) and $_SESSION['user']['position'] == "administrador") {
                echo '
                <hr>
                <ul>
                    <a href="adm.php"><li><i class="fa-solid fa-house"></i> ADM hub</li></a>
                </ul>
                ';
            };
            ?>
        </aside>
        <section class="content">
