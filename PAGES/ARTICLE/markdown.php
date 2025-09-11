<!DOCTYPE html>
<html lang="pt-br" id="htmltag">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../ASSETS/NEABI_LOGO_WHITE.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.amber.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../CSS/mainpage.css">
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
                    <h2>Formatação MarkDown</h2>
                    <p>Deixando seus textos bonitos!</p>
                    <br>
                    <h3>Oque é MarkDown?</h3>
                    <p>Markdown é uma linguagem voltada para formatação de textos baseada em marcadores, deixando a escrita facil sem a necessidade de tirar suas mãos do teclado para deixar o texto mais agradavel aos olhos</p>
                    <br>
                    <h3>Elementos do texto:</h3>
                    <ul>
                        <hr>
                        <li><b>Titulos:</b></li>
                        <p>adicionando "# " (hashtag) antes de qualquer texto irá indicar um titulo, voce pode indicar o nivel do titulo pela quantidade de hashtags (até 6).</p>
                        <p><b>atenção</b> é importante que após os hashtags aja um espaço em branco separando do nome do titulo.</p>
                        <p><b>Escrita:</b></p>
                        <code><mark># </mark>nome do titulo 1<br></code><br>
                        <code><mark>## </mark>nome do titulo 2<br></code><br>
                        <code><mark>### </mark>nome do titulo 3</code><br>
                        <br>
                        <p><b>Resultado:</b></p>
                        <h1>Nome do Titulo 1</h1>
                        <h2>Nome do Titulo 2</h2>
                        <h3>Nome do Titulo 3</h3>
                        <br>
                        
                        <hr>
                        <li><b>Quebra de linha</b></li>
                        <p>para quebrar uma linha a mais, passando para outro paragrafo. ao final da linha adicione dois espaços em branco "  ".</p>
                        <p><b>Escrita:</b></p>
                        <code>
                            texto exemplo<br>
                            com varias linhas.<mark> </mark><mark> </mark><br>
                            outro texto.
                        </code>
                        <br>
                        <p><b>Resultado:</b></p>
                        <p>texto exemplo<br>com varias linhas</p>
                        <p>outro texto.</p>

                        <hr>
                        <li><b>Texto com efeito:</b></li>
                        <p>para adicionar efeito a um texto, adicione "*" (asteriscos) em volta do texto</p>
                        <p><b>importante:</b> dependendo da quantidade de asteriscos, ira fazer um efeito diferente</p>
                        <p><b>Escrita:</b></p>
                        <code>
                            texto com <mark>*</mark>itálico<mark>*</mark><br>
                            texto com <mark>**</mark>negrito<mark>**</mark><br>
                            texto com <mark>***</mark>itálico e negrito<mark>***</mark><br>
                        </code>
                        <p><b>Resultado</b></p>
                            <p>texto com <i>italico</i></p>
                            <p>texto com <b>negrito</b></p>
                            <p>texto com <i><b>italico e negrito</b></i></p>
                        
                        <hr>
                        <li><b>Menções:</b></li>
                        <p>Assim como um titulo, para adicionar uma menção, coloque "> " (sinal maior que) antes de qualquer texto</p>
                        <p><b>importante:</b> para adicionar diversas linhas da mesma menção, apenas siga usando o sinal antes de cada linha. <br>
                        Menções podem ser colocadas uma dentro da outra, como nos titulos, adicione mais do marcador para aninha-los ">> "</p>
                        <br>
                        <p><b>Escrita:</b></p>
                        <code>
                            <mark>> </mark>"O trabalho não é ruim. Ruim é ter de trabalhar!"<br>
                            <mark>> </mark><br>
                            <mark>>> </mark>-Don Ramon <br>
                            <br>
                        </code>
                        <br>
                        <p><b>Resultado:</b></p>
                        <blockquote>
                            <p>"O trabalho não é ruim. Ruim é ter de trabalhar!"</p>
                            <p></p>
                            <blockquote><p>-Don Ramon <br></p></blockquote></blockquote>

                        <hr>
                        <li><b>Listas</b></li>
                        <p>para criar uma lista, insira um dos seguintes marcadores antes de cada linha de item (=.-.*)<br>
                        Você pode criar listas dentro de listas colocando 3 espaços em branco " " (uma vez da tecla TAB insere-os automaticamenta) antes do marcador</p>
                        
                        <br>
                        <p><b>Escrita:</b></p>
                        <code>
                            <mark>* </mark>primeiro item <br>
                            <mark>* </mark>segundo item <br>
                            <mark>‎ ‎ ‎ * </mark>primeiro item de sublista <br>
                            <mark>‎ ‎ ‎ * </mark>segundo item de sublista <br>
                            <mark>+ </mark>terceiro item (outro marcador) <br>
                            <mark>- </mark>quarto item (outro marcador) <br>
                        </code>
                        <br>
                        <p><b>Resultado:</b></p>
                        <ul style="list-style-type: decimal !important;">
                            <li>primeiro item</li>
                            <li>segundo item
                            <ol>
                                <li>primeiro item de sublista</li>
                                <li>segundo item de sublista</li>
                            </ol>
                            </li>
                            <li> terceiro item (outro marcador)</li>
                            <li>quarto item (outro marcador)</li>
                        </ul>

                        <hr>
                        <li><b>Links:</b></li>
                        <p>para inserir links dentro de textos, você pode utilizar o metodo markdown colocando o texto que quiser mascarar o link dentro de colchetes "[ ]" e logo em seguida o link em parêntesis "( )"</p>
                        <br>
                        <p><b>Escrita:</b></p>
                        <code>
                            acesse <mark>[</mark>google<mark>](</mark>google.com<mark>)</mark>.
                        </code>
                        <br>
                        <p><b>Resultado:</b></p>
                        <p>acesse <a href="https://google.com">google</a></p>

                        <hr>
                        <p><b>Por fim... imagens:</b></p>
                        <p>para adicionar imagens, é o mesmo que links, mas o com uma exclamação "!" antes de tudo, o texto inserido antes do link da imagem só sera exibido se tiver uma falha ao carregar a imagem</p>
                        <p><b>Importante:</b> certifique-se de que é um link <b>de imagem</b> e nao link para um site onde está a imagem</p>
                        <br>
                        <p><b>Escrita:</b></p>
                        <code>
                        <mark>!</mark>[Logo do Markdown](https://markdown.net.br/assets/img/basic-syntax/markdown-logo-small.png)
                        </code>
                        <br>
                        <p><b>Resultado:</b></p>
                        <img src="https://markdown.net.br/assets/img/basic-syntax/markdown-logo-small.png" alt="Logo do markdown">
                        <p><b>Resultado com erro:</b></p>
                        <img src="Tá fuxicando o html daqui por que? safado!!!" alt="Logo do markdown">
                    </ul>
                    <hr>
                    <h2>Parabens!</h2>
                    <p>voce acabou o tutorial <b>basico</b> de markdown, e aprendeu o suficiente para escrever seu primeiro artigo, para mais dicas uteis e coisas nao mencionadas nesse breve tutorial acesse o <a href="https://markdown.net.br/sintaxe-basica/">Tutorial completo oficial da MarkDown</a></p>
                </hgroup>
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