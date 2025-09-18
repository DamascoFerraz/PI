<?php
    // setting path to root (used in archive and page links)
    $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
    $pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

    // setting page name (used in header)
    $pageName = "Exemplo de pagina";

    // loading header
    require_once $pathToRoot."ASSETS/TEMPLATES/header.php";

    // loading theme control script
    echo "<script src='".$pathToRoot."JS/theme_control.js'></script>";

    // loading aside
    require_once $pathToRoot."ASSETS/TEMPLATES/aside.php";
?>
        <section class="content contact">
            <br>
            <hgroup>
                <h1>Faça parte dos professores do Postit</h1>
                <p>tenha artigos engajados e avaliações em peso:</p>
                <br>
                <div>
                    <ul class="contacts-list">
                        <p><i class="fa-solid fa-envelope"></i> Email: email@email.com</p>
                        <p><i class="fa-brands fa-square-whatsapp"></i> Numero: xxxxx-xxxxx</p>
                        <p><i class="fa-brands fa-github"></i> link Github: link</p>
                    </ul>
                </div>
            </hgroup>
        </section>
    </main>
<?php
    // loading modal (return messages)
    require_once $pathToRoot."ASSETS/TEMPLATES/modal.php";

    // loading modal control script
    echo "<script src='".$pathToRoot."JS/modal_control.js'></script>" ;

    // loading footer
    require_once $pathToRoot."ASSETS/TEMPLATES/footer.php";
?>