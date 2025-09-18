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

            <br>
        <section class="content container-fluid">
            <!-- barra de pesquisa de artigo -->
            <form action="<?= $pathToRoot ?>PAGES/ARTICLE/search.php" method="GET" class="article-search container-fluid">
                <div class="input-button-group">
                    <input type="text" name="search" id="search" placeholder="Pesquisar artigo..." required>
                    <button style="" type="submit" class="primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
            <br>
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