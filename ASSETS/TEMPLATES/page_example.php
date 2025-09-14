<?php
    // setting path to root (used in archive and page links)
    $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
    $pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

    // setting page name (used in header)
    $pageName = "Exemplo de pagina";

    // loading header
    require_once $pathToRoot."ASSETS/TEMPLATES/header.php";

    // loading theme control script
    echo "<script src=".$pathToRoot."'JS/theme_control.js'></script>";

    // loading aside
    require_once $pathToRoot."ASSETS/TEMPLATES/aside.php";
?>

    <section class="content container-fluid">
        <!-- EDIT HERE TO IMPLEMENT THE PAGE -->
        <h1>Exemplo de pagina</h1>
        <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto facilis nobis provident error velit asperiores laborum, temporibus, repellat repudiandae molestiae nostrum ad quam, sit assumenda delectus. Quae, dolor iure. Atque?
        </p>
    </section>

<?php
    // loading modal (return messages)
    require_once $pathToRoot."ASSETS/TEMPLATES/modal.php";

    // loading modal control script
    echo "<script src=".$pathToRoot."'JS/modal_control.js'></script>" ;

    // loading footer
    require_once $pathToRoot."ASSETS/TEMPLATES/footer.php";
?>