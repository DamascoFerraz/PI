<!DOCTYPE html>
<html lang="pt-br" id="htmltag">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../ASSETS/NEABI_LOGO_WHITE.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.amber.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/mainpage.css">
    <title>ARTIGOS • CNEABI</title>
    <?php
        session_start();
        // (r) return message for modal
        if (!isset($_GET['r'])){
            $_GET['r'] = '';
        };
        echo "<script>var r = '".$_GET['r']."';</script>";
    ?>
</head>
<body>
    <!------------------------------------------- HEADER ------------------------------------------->
    <header>
        <div class="container">
            <div class="title">
                <div><img id="logo" width=50rem src="../ASSETS/NEABI_LOGO_DARK.png" alt="NEABI_logo"></div>
                <hgroup>
                    <h3>CNEABI</h3>
                    <p>Central do Nucleo de Estudos Afro-Brasileiros e Indigenas</p>
                </hgroup>
            </div>

            <nav>
                <button class="outline contrast theme-togle" onclick="darkMode()"><i id="theme-icon" class="fa-regular fa-moon"></i></button>
                <?php
                    if (isset($_SESSION['user'])) {
                        echo '<button class="outline contrast" onclick="window.location.replace('."'".'../log_off.php'."'".')">Sair <i class="fa-solid fa-arrow-right-from-bracket"></i></button>';
                    } else {
                        echo '<button class="outline contrast" onclick="window.location.replace('."'".'../verify.php?f=log'."'".')">Sou membro</button>';
                    }
                ?>
            </nav>
        </div>
    </header>

    <!------------------------------------------- MAIN ------------------------------------------->
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
                    <a href=""adm.php><li><i class="fa-solid fa-house"></i> ADM hub</li></a>
                </ul>
                ';
            };
            ?>
        </aside>
        <!-- CONTENT -->
        <section class="content">
            <br>
            <!-- ARTIGOS RECENTES CLUBE DO LIVRO -->
            <!-- cards rows -->
            <div class="container-fluid">
                <!-- header for cards container -->
                <div class="container-fluid cards-container-header">
                    <hgroup>
                        <h4><i class="fa-solid fa-clock"></i> Artigos recentes</h4>
                        <p>ultimos artigos escritos até agora</p>
                    </hgroup>
                </div>
                <!-- cards -->
                <div class="container-fluid cards-row">
                    <article>
                        <header><a href="#"><h6>Titulo</h6></a></header>
                        <p>descrição</p>
                        <footer>por: <b>autor</b></footer>
                    </article>
                    <article>
                        <header><a href="#"><h6>Titulo</h6></a></header>
                        <p>descrição</p>
                        <footer>por: <b>autor</b></footer>
                    </article>
                    <article>
                        <header><a href="#"><h6>Titulo</h6></a></header>
                        <p>descrição</p>
                        <footer>por: <b>autor</b></footer>
                    </article>
                    <article>
                        <header><a href="#"><h6>Titulo</h6></a></header>
                        <p>descrição</p>
                        <footer>por: <b>autor</b></footer>
                    </article>
                </div>
            </div>
            <hr>
            <!-- ARTIGOS MAIS LIDOS CLUBE DO LIVRO -->
            <!-- cards rows -->
            <div class="container-fluid">
                <!-- header for cards container -->
                <div class="container-fluid cards-container-header">
                    <hgroup>
                        <h4><i class="fa-solid fa-fire"></i> Artigos mais lidos</h4>
                        <p>Os artigos mais populares do site</p>
                    </hgroup>
                </div>
                <!-- cards -->
                <div class="container-fluid cards-row">
                    <article>
                        <header><a href="#"><h6>Titulo</h6></a></header>
                        <p>descrição</p>
                        <footer>por: <b>autor</b></footer>
                    </article>
                    <article>
                        <header><a href="#"><h6>Titulo</h6></a></header>
                        <p>descrição</p>
                        <footer>por: <b>autor</b></footer>
                    </article>
                    <article>
                        <header><a href="#"><h6>Titulo</h6></a></header>
                        <p>descrição</p>
                        <footer>por: <b>autor</b></footer>
                    </article>
                </div>
            </div>
            <hr>
            <div class="container-fluid">
                <div class="container-fluid cards-container-header">
                    <hgroup>
                        <h4><i class="fa-solid fa-file"></i> Todos os artigos</h4>
                        <p>todos artigos escritos pelos participantes do clube do livro NEABI</p>
                    </hgroup>
                </div>
                <div class="container-fluid cards-column">
                    <article>
                        <header><a href="#"><h6>Titulo</h6></a></header>
                        <p>descrição</p>
                        <footer>por: <b>autor</b></footer>
                    </article>
                    <article>
                        <header><a href="#"><h6>Titulo</h6></a></header>
                        <p>descrição</p>
                        <footer>por: <b>autor</b></footer>
                    </article>
                    <article>
                        <header><a href="#"><h6>Titulo</h6></a></header>
                        <p>descrição</p>
                        <footer>por: <b>autor</b></footer>
                    </article>
                    <article>
                        <header><a href="#"><h6>Titulo</h6></a></header>
                        <p>descrição</p>
                        <footer>por: <b>autor</b></footer>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <!------------------------------------------- FOOTER ------------------------------------------->
    <footer>
        <div class="container-fluid">
            <hgroup>
                <h6><i class="fa-solid fa-flask"></i> Criado e dirigido por alunos do IFSULDEMINAS-MUZAMBINHO</h6>
            </hgroup>
        </div>
    </footer>

        <!------------------------------------------- MODAL ------------------------------------------->
        <dialog id='modal' class="container-fluid centered-col">
        <article>
            <header>
                <button aria-label="Close" rel="prev" onclick="modal.style.display='none'"></button>
                <p>
                    <strong>Aviso!</strong>
                </p>
            </header>
            <p>
            <?php
            echo "".$_GET['r']."";
            ?>
            </p>
        </article>
    </dialog>

    <!-- JS FOR THEME CHANGE -->
    <script>
        const icon = document.getElementById("theme-icon");
        const logo = document.getElementById("logo");
        const html = document.getElementById('htmltag');

        (function(){
            if (localStorage.getItem('theme') == null){
                localStorage.setItem('theme', 'light');
            }
            html.setAttribute('data-theme', localStorage.getItem('theme'));
            if (localStorage.getItem('theme') === 'dark'){
                icon.setAttribute('class','fa-regular fa-moon');
                logo.setAttribute('src','../ASSETS/NEABI_LOGO_WHITE.png');
            }
            else {
                icon.setAttribute('class','fa-regular fa-sun');
                logo.setAttribute('src','../ASSETS/NEABI_LOGO_DARK.png');
            }
        })();

        function darkMode () {
            var targetTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';

            if (targetTheme === 'dark'){
                html.setAttribute('data-theme', targetTheme);
                localStorage.setItem('theme', targetTheme);
                icon.setAttribute('class','fa-regular fa-moon');
                logo.setAttribute('src','../ASSETS/NEABI_LOGO_WHITE.png');
            }
            else {
                html.setAttribute('data-theme', targetTheme);
                localStorage.setItem('theme', targetTheme);
                icon.setAttribute('class','fa-regular fa-sun');
                logo.setAttribute('src','../ASSETS/NEABI_LOGO_DARK.png');
            }
            }

                        // modal opening when return message is set
            modal = document.getElementById('modal');

            if (r != ''){
            modal.style.display='flex'
            }
    </script>
</body>
</html>