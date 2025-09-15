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

    // pulling article
    require_once $pathToRoot."PHP/pull_content.php";
?>
            <div class="container-fluid">
                <hgroup>
                    <h1><?= $GET['title'] ?></h1>
                    <h4><?= $GET['descr'] ?></h4>
                    <p>por <?= $GET['author'] ?> em <?= date('d/m/Y', strtotime($GET['creation'])) ?></p>
                </hgroup>
                <hr>
                <section class="content container-fluid">
                    <div class="container-fluid">
                        <hgroup>
                            <?php
                                require '../../ASSETS/parsedown-master/Parsedown.php';

                                $Parsedown = new Parsedown();
                                $html = $Parsedown->text($GET['content']);
                                echo $html;
                            ?>
                        </hgroup>
                    </div>
                </section>
                
                <br>
                <hr>
                <br>

                <?php if (isset($_SESSION['user'])) :?>

                    <h4>Deixe sua avaliação!</h4>
                    <form action="<?= $pathToRoot ?>PHP/rate_article.php" method="POST" class="container-fluid">
                        <input type="hidden" name="article_id" value="<?= $_GET['id'] ?>">
                        <div class="container-fluid rating-stars">
                            <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 estrelas"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 estrelas"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 estrelas"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 estrelas"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 estrela"><i class="fa-solid fa-star"></i></label>
                        </div>
                        <br>
                        <button type="submit" class="primary">Enviar avaliação</button>
                    </form>
                <?php else: ?>
                    <p>Faça <a href="<?= $pathToRoot ?>PAGES/login.php">login</a> para avaliar este artigo!</p>
                <?php endif; ?>

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