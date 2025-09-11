<!DOCTYPE html>
<html lang="pt-br" id="htmltag">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="ASSETS/NEABI_LOGO_WHITE.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.amber.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="CSS/index.css">
    <title>CNEABI</title>
    <?php
        // (r) return message for modal
        if (!isset($_GET['r'])){
            $_GET['r'] = '';
        };
        echo "<script>var r = '".$_GET['r']."';</script>";

        session_start();

        if (isset($_SESSION['user']['id'])){
            header("Location: PAGES/home.php?r=Boas%20vindas%20de%20volta!");
            exit();
        };
    ?>
</head>
<body>
    <!------------------------------------------- HEADER ------------------------------------------->
    <header>
        <div class="container">
            <div class="title">
                <div><img id="logo" width=50rem src="ASSETS/NEABI_LOGO_DARK.png" alt="NEABI_logo"></div>
                <hgroup>
                    <h3>CNEABI</h3>
                    <p>Central do Nucleo de Estudos Afro-Brasileiros e Indigenas</p>
                </hgroup>
            </div>

            <nav>
                <button class="outline contrast theme-togle" onclick="darkMode()"><i id="theme-icon" class="fa-regular fa-moon"></i></button>
                <button class="outline contrast" onclick="window.location.replace('verify.php?f=log')">Sou membro</button>
            </nav>
        </div>
    </header>

    <!------------------------------------------- MAIN ------------------------------------------->
    <main>
        <hgroup class="info-pannel">
            <h1>CNEABI</h1>
            <h3>Central do Nucleo de Estudos <br> Afro-Brasileiros e Indigenas</h3>
            <p>artigos, eventos, livros, estudos e muito mais...</p>
            <div class="container">
                <button class="primary" onclick="window.location = 'PAGES/home.php'">Vamos lá!</button>
            </div>
        </hgroup>
        <img id="logo-mp" width=300rem src="ASSETS/NEABI_LOGO_DARK.png" alt="NEABI_logo">
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
        const logo_mp = document.getElementById("logo-mp")
        const html = document.getElementById('htmltag');

        (function(){
            if (localStorage.getItem('theme') == null){
                localStorage.setItem('theme', 'light');
            }
            html.setAttribute('data-theme', localStorage.getItem('theme'));
            if (localStorage.getItem('theme') === 'dark'){
                icon.setAttribute('class','fa-regular fa-moon');
                logo.setAttribute('src','ASSETS/NEABI_LOGO_WHITE.png');
                logo_mp.setAttribute('src','ASSETS/NEABI_LOGO_WHITE.png');
            }
            else {
                icon.setAttribute('class','fa-regular fa-sun');
                logo.setAttribute('src','ASSETS/NEABI_LOGO_DARK.png');
                logo_mp.setAttribute('src','ASSETS/NEABI_LOGO_DARK.png');
            }
        })();

        function darkMode () {
            var targetTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';

            if (targetTheme === 'dark'){
                html.setAttribute('data-theme', targetTheme);
                localStorage.setItem('theme', targetTheme);
                icon.setAttribute('class','fa-regular fa-moon');
                logo.setAttribute('src','ASSETS/NEABI_LOGO_WHITE.png');
                logo_mp.setAttribute('src','ASSETS/NEABI_LOGO_WHITE.png');
            }
            else {
                html.setAttribute('data-theme', targetTheme);
                localStorage.setItem('theme', targetTheme);
                icon.setAttribute('class','fa-regular fa-sun');
                logo.setAttribute('src','ASSETS/NEABI_LOGO_DARK.png');
                logo_mp.setAttribute('src','ASSETS/NEABI_LOGO_DARK.png');
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