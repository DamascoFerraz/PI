<!DOCTYPE html>
<html lang="pt-br" id="htmltag">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../ASSETS/NEABI_LOGO_WHITE.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.amber.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../CSS/mainpage.css">
    <style>
        input:invalid ~ footer>button[type='submit']{
                opacity: 0.5;
                pointer-events: none;
            }
        input:invalid ~ footer+footer>button[type='submit']{
                opacity: 0.5;
                pointer-events: none;
            }
            input:user-invalid{
                border: solid red 1px;
            }
            input:user-valid{
                border: solid green 1px;
            }
    </style>
    <title>CNEABI</title>
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
                <div><img id="logo" width=50rem src="../../ASSETS/NEABI_LOGO_DARK.png" alt="NEABI_logo"></div>
                <hgroup>
                    <h3>CNEABI</h3>
                    <p>Central do Nucleo de Estudos Afro-Brasileiros e Indigenas</p>
                </hgroup>
            </div>

            <nav>
                <button class="outline contrast theme-togle" onclick="darkMode()"><i id="theme-icon" class="fa-regular fa-moon"></i></button>
                <?php
                    if (isset($_SESSION['user'])) {
                        echo '<button class="outline contrast" onclick="window.location.replace('."'".'../../log_off.php'."'".')">Sair <i class="fa-solid fa-arrow-right-from-bracket"></i></button>';
                    } else {
                        echo '<button class="outline contrast" onclick="window.location.replace('."'".'../../verify.php?f=log'."'".')">Sou membro</button>';
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
                <a href="../home.php"><li><i class="fa-solid fa-house"></i> Home</li></a>
                <a href="../articles.php"><li><i class="fa-solid fa-book"></i> Artigos</li></a>
                <a href="../events.php"><li><i class="fa-solid fa-calendar"></i> Eventos</li></a>
                <a href="../contact.php"><li><i class="fa-solid fa-handshake"></i> Seja NEABI</li></a>
            </ul>

            <?php
            if (isset($_SESSION['user']) and ($_SESSION['user']['position'] == "coordenador" or $_SESSION['user']['position'] == "administrador")) {
                echo '
                <hr>
                <ul>
                    <a href="../mod.php"><li><i class="fa-solid fa-handshake"></i> Coordenação</li></a>
                </ul>
                ';
            };
            if (isset($_SESSION['user']) and $_SESSION['user']['position'] == "administrador") {
                echo '
                <hr>
                <ul>
                    <a href="../adm.php"><li><i class="fa-solid fa-house"></i> ADM hub</li></a>
                </ul>
                ';
            };
            ?>
        </aside>
        <!-- CONTENT -->
        <section class="content">
            <br>
            <div class="container-fluid">
                <hgroup>
                    <h3>Escrevendo um artigo:</h3>
                    <ol>
                        <li>Dê um nome ao seu artigo:</li>
                            <p>algo simples e dinamico para chamar atenção de outras pessoas. ele deve ser único</p>
                        <li>Dê uma descrição do artigo:</li>
                            <p>descreva brevemente oque é dito no artigo.</p>
                        <li>Escreva seu artigo:</li>
                            <p>artigos são formatados em MarkDown, aprenda sobre a formatação markdown <a href="markdown.php" target="_blank">aqui</a></p>
                        <li>Confirme sua senha e publique!</li>
                            <p>estão todos esperando para ler!</p>
                    </ol>
                </hgroup>
            </div>
            <hr>
            <div class="container-fluid">
                <form action="../../PHP/process_article.php"  method="POST">
                    <label for="title">Titulo:</label>
                    <input type="text" name="title" required placeholder="Titulo do seu artigo">

                    <label for="description">Descrição:</label>
                    <input type="text" name="description" required placeholder="Breve descrição do seu artigo">

                    <hr>

                    <textarea name="content" id="content" rows="10" required placeholder="conteudo do seu artigo">## Meu primeiro artigo
Lorem ipsum dolor sit amet consectetur adipisicing elit.  
Tempora adipisci minima alias rem molestiae, eius cupiditate inventore est veritatis dolor dolorem quae repellendus reiciendis corrupti ut!  
Tenetur ex sapiente dolorum!...  

Lorem ipsum ***dolor*** sit amet:
> "consectetur adipisicing elit."
> - Tempora adipisci minima
</textarea>
                    <br>
                    
                    <input type="hidden" name="author" value="<?php echo $_SESSION['user']['username']; ?>">
                    <input type="hidden" name="author_id" value="<?php echo $_SESSION['user']['id']; ?>">
                    <input type="hidden" name="author_position" value="<?php echo $_SESSION['user']['position']; ?>">
                    <input type="hidden" name="author_team" value="<?php echo $_SESSION['user']['team']; ?>">
                    <hr>
                    <footer>
                        <button class="secondary" type="submit" formaction="preview.php">ver preview</button>
                    </footer>
                    <hr>
                    <footer>
                        <button type="submit">Postar</button>
                    </footer>
                </form>
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
                logo.setAttribute('src','../../ASSETS/NEABI_LOGO_WHITE.png');
            }
            else {
                icon.setAttribute('class','fa-regular fa-sun');
                logo.setAttribute('src','../../ASSETS/NEABI_LOGO_DARK.png');
            }
        })();

        function darkMode () {
            var targetTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';

            if (targetTheme === 'dark'){
                html.setAttribute('data-theme', targetTheme);
                localStorage.setItem('theme', targetTheme);
                icon.setAttribute('class','fa-regular fa-moon');
                logo.setAttribute('src','../../ASSETS/NEABI_LOGO_WHITE.png');
            }
            else {
                html.setAttribute('data-theme', targetTheme);
                localStorage.setItem('theme', targetTheme);
                icon.setAttribute('class','fa-regular fa-sun');
                logo.setAttribute('src','../../ASSETS/NEABI_LOGO_DARK.png');
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