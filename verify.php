<!DOCTYPE html>
<html lang="pt-br" id="htmltag">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="ASSETS/NEABI_LOGO_WHITE.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.amber.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="CSS/mainpage.css">
    <title>CNEABI</title>
    <style>
        input:invalid ~ footer>button[type='submit']{
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
</head>
<body>
<?php
    session_start();
    // (f) form type (log or sign)
    if (!isset($_GET['f'])){
        $_GET['f'] = 'log';
    };
    echo "<script>var f = '".$_GET['f']."';</script>";
    // (r) return message for modal
    if (!isset($_GET['r'])){
        $_GET['r'] = '';
    };
    echo "<script>var r = '".$_GET['r']."';</script>";
?>
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
                
            </nav>
        </div>
    </header>

    <!------------------------------------------- MAIN ------------------------------------------->
    <main>
        <!-- CONTENT -->
        <section class="content">
            <div class="container-fluid centered-col">
                <article id="log-form-container">
                    <header style="text-align:center;">
                        <h3>Entrar</h3>
                    </header>
                    <form action="PHP/log_handler.php" method="post" class="container-fluid">
                        <label for="username">Nome:</label>
                        <input type="username" name="username" id="inpt-username" required>
                        
                        <label for="pwd">Senha:</label>
                        <input type="password" name="pwd" id="inpt-pwd" required pattern=".{8,}">
                        <footer class="centered-col">
                            <a href="?f=sign">Não tenho uma conta</a>
                            <br>
                            <button type="submit">Entrar</button>
                        </footer>
                    </form>
                </article>
                <article id="member-form-container">
                    <header style="text-align:center;">
                        <h3>Criar conta</h3>
                    </header>
                    <form action="PHP/sign_handler.php" method="post" class="container-fluid">
                        <label for="username">Nome:</label>
                        <input type="text" name="username" id="inpt-name" required>

                        <label for="pwd">Senha:  <span>minimo 8 letras</span></label>
                        <input type="password" name="pwd" id="inpt-pwd-mem" required required pattern=".{8,}">

                        <label for="creation-key">Chave de criação:</label>
                        <input type="txt" name="creation-key" id="inpt-creation-key" required>
                        <br>
                        <footer class="centered-col">
                            <a href="?f=log">Já tenho uma conta</a>
                            <br>
                            <button type="submit" >Registrar-se</button>
                        </footer>
                    </form>
                </article>

                <form action="PHP/sign_in.php" method="post" id="sign-form"></form>
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


    <script>
        // THEME CHANGE
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
            }
            else {
                icon.setAttribute('class','fa-regular fa-sun');
                logo.setAttribute('src','ASSETS/NEABI_LOGO_DARK.png');
            }
        })();

        function darkMode () {
            var targetTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';

            if (targetTheme === 'dark'){
                html.setAttribute('data-theme', targetTheme);
                localStorage.setItem('theme', targetTheme);
                icon.setAttribute('class','fa-regular fa-moon');
                logo.setAttribute('src','ASSETS/NEABI_LOGO_WHITE.png');
            }
            else {
                html.setAttribute('data-theme', targetTheme);
                localStorage.setItem('theme', targetTheme);
                icon.setAttribute('class','fa-regular fa-sun');
                logo.setAttribute('src','ASSETS/NEABI_LOGO_DARK.png');
            }
            }

        // Form change
        const form_log = document.getElementById('log-form-container');
        const form_sign = document.getElementById('sign-form-container');
        const form_member = document.getElementById('member-form-container');
        


        (function(){
            if (f === 'log'){
                form_log.setAttribute('style','display: block;')
                form_member.setAttribute('style','display: none;')
            }
            else {
                    form_log.setAttribute('style','display: none;')
                    form_member.setAttribute('style','display: block;')
                }
        })();

        // modal opening when return message is set
        modal = document.getElementById('modal');

        if (r != ''){
            modal.style.display='flex'
        }


    </script>
</body>
</html>