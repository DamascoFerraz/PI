<?php
    $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
    $pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";
    $pageName = "Exemplo de pagina";

    require_once $pathToRoot."ASSETS/TEMPLATES/header.php";
    
    require_once $pathToRoot."ASSETS/TEMPLATES/aside.php";
?>

    <section class="content container-fluid">
        <h1>Exemplo de pagina</h1>
        <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto facilis nobis provident error velit asperiores laborum, temporibus, repellat repudiandae molestiae nostrum ad quam, sit assumenda delectus. Quae, dolor iure. Atque?
        </p>
    </section>
    
    <?= "<script src=".$pathToRoot."'JS/theme_control.js'></script>" ?>
    <?= "<script src=".$pathToRoot."'JS/modal_control.js'></script>" ?>

<?php
    require_once $pathToRoot."ASSETS/TEMPLATES/footer.php";
?>