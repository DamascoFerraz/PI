<?php
    // setting path to root (used in archive and page links)
    $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
    $pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";

    // setting page name (used in header)
    $pageName = "Home";

    // loading header
    require_once $pathToRoot."ASSETS/TEMPLATES/header.php";

    // loading theme control script
    echo "<script src='".$pathToRoot."JS/theme_control.js'></script>";

    // loading aside
    require_once $pathToRoot."ASSETS/TEMPLATES/aside.php";

    // loading articles
    require_once $pathToRoot."PHP/db.php";
    require_once $pathToRoot."PHP/pull_articles.php";
?>

            <br>
            <!-- cards rows -->
            <div class="container-fluid">
                <!-- header for cards container -->

                <br>
                <!-- artigos recomendados -->
                <div class="container-fluid cards-container-header">
                    <hgroup>
                        <h4>Recomendado para você</h4>
                        <p>artigos baseados nas suas tags favoritas</p>
                        <?php  if (isset($_SESSION['user'])): ?>
                            <a href="<?= $pathToRoot?>PAGES/ARTICLE/write.php"><i class="fa-solid fa-pencil"></i> Escrever artigo</a>
                        <?php endif; ?>
                    </hgroup>
                    <a href="#">mais</a>
                </div>
                <!-- cards -->
                <div class="container-fluid cards-row">
                    <?php listArticles($articles_by_tags); ?>
                </div>

                <hr>

                <!-- artigos em alta -->
                <div class="container-fluid cards-container-header">
                    <hgroup>
                        <h4>Artigos em alta</h4>
                        <p>artigos mais lidos recentemente</p>
                        <?php  if (isset($_SESSION['user'])): ?>
                            <a href="<?= $pathToRoot?>PAGES/ARTICLE/write.php"><i class="fa-solid fa-pencil"></i> Escrever artigo</a>
                        <?php endif; ?>
                    </hgroup>
                    <a href="#">mais</a>
                </div>
                <!-- cards -->
                <div class="container-fluid cards-row">
                    <?php listArticles($heat_articles); ?>
                </div>

                <hr>

                <!-- artigos mais bem avaliados -->
                <div class="container-fluid cards-container-header">
                    <hgroup>
                        <h4>Artigos mais bem avaliados</h4>
                        <p>artigos com melhores avaliações</p>
                        <?php  if (isset($_SESSION['user'])): ?>
                            <a href="<?= $pathToRoot?>PAGES/ARTICLE/write.php"><i class="fa-solid fa-pencil"></i> Escrever artigo</a>
                        <?php endif; ?>
                    </hgroup>
                    <a href="#">mais</a>
                </div>
                <!-- cards -->
                <div class="container-fluid cards-row">
                    <?php listArticles($top_rated_articles); ?>
                    
                </div>

                <hr>

                <!-- artigos recentes -->
                <div class="container-fluid cards-container-header">
                    <hgroup>
                        <h4><i class="fa-solid fa-file"></i> Artigos recentes</h4>
                        <p>artigos mais recentemente postados</p>
                        <?php  if (isset($_SESSION['user'])): ?>
                            <a href="<?= $pathToRoot?>PAGES/ARTICLE/write.php"><i class="fa-solid fa-pencil"></i> Escrever artigo</a>
                        <?php endif; ?>
                    </hgroup>
                    <a href="articles.php">Mais</a>
                </div>
                <!-- cards -->
                <div class="container-fluid cards-row">
                    <?php listArticles($recent_articles); ?>
                    
                </div>
            </div>

            <hr>
            
            <!-- FACA PARTE -->
            <div class="container-fluid faca-parte">
                <i class="fa-solid fa-handshake"></i>
                <hgroup>
                    <h3>Faça parte da comunidade de professores do Postit!</h3>
                    <p>junte-se!</p>
                </hgroup>
                <a href="contact.php">Como participar</a>
            </div>
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