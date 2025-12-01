<?php
    // setting path to root (used in archive and page links)
    $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
    $pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

    // setting page name (used in header)
    $pageName = "Acesse";

    // loading header
    require_once $pathToRoot."ASSETS/TEMPLATES/header.php";

    // loading theme control script
    echo "<script src=".$pathToRoot."'JS/theme_control.js'></script>";

    // (f) form type (log or sign)
    if (!isset($_GET['f'])){
        $_GET['f'] = 'log';
    };
    // transfer (f) to js
    echo "<script>var f = '".$_GET['f']."';</script>";

    // checking if user is logged in
    if (isset($_SESSION['user']['id'])){
        header("Location: ".$pathToRoot."PAGES/home.php?r=Boas%20vindas%20de%20volta!");
        exit();
    };
?>
    <link rel="stylesheet" href="<?= $pathToRoot?>CSS/form_validation_formatation.css">
    <main>
        <section class="content">
            <br> 
            <div class="container-fluid centered-col">
                <article id="log-form-container">
                    <header style="text-align:center;">
                        <h3>Entrar</h3>
                    </header>
                    <form action="PHP/log_handler.php" method="post" class="container-fluid">
                        <label for="inpt-username">Nome:</label>
                        <input type="username" name="username" id="inpt-username" required>
                        
                        <label for="inpt-pwd">Senha:</label>
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
                        <label for="inpt-username">Nome:</label>
                        <input type="text" name="username" id="inpt-name" required>

                        <label for="inpt-pwd">Senha:  <span>minimo 8 letras</span></label>
                        

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


<?php
    // loading script for log/sign form control
    echo "<script src=".$pathToRoot."'JS/log_sign_form_control.js'></script>";

    // loading modal (return messages)
    require_once $pathToRoot."ASSETS/TEMPLATES/modal.php";

    // loading modal control script
    echo "<script src=".$pathToRoot."'JS/modal_control.js'></script>" ;

    // loading footer
    require_once $pathToRoot."ASSETS/TEMPLATES/footer.php";
?>