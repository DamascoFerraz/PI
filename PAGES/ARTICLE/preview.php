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

            <div class="container-fluid">
                <?php
                    require '../../ASSETS/parsedown-master/Parsedown.php';

                    $Parsedown = new Parsedown();
                    $html = $Parsedown->text($_POST['content']);
                    echo "<h1>".$_POST['title']."</h1>";
                    echo "<h5>".$_POST['author']."</h5>";
                    echo "<hr>";
                    echo $html;
                ?>
            </div>
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