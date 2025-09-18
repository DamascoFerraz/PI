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

    // pulling style for stars
    echo "<link rel='stylesheet' href='".$pathToRoot."CSS/star_rating.css'>";
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
                        <div class="input-button-group">
                            <input type="hidden" name="article_id" value="<?= $_GET['id'] ?>">
                            <div class="container-fluid star-rating">
                                    <?php for ($i=5; $i >= 1; $i--): ?>
                                        <input class="radio-input" type="radio" id="star<?=$i;?>" name="star-input" value="<?=$i;?>" />
                                        <label class="radio-label" class for="star<?=$i;?>" title="<?=$i;?> stars"><?=$i;?> stars</label>
                                    <?php endfor; ?>
                            </div>
                            <button type="submit" class="primary"><i class="fa-solid fa-star"></i></button>
                        </div>
                    </form>
                <?php else: ?>
                    <p>Faça <a href="<?= $pathToRoot ?>PAGES/login.php">login</a> para avaliar este artigo!</p>
                <?php endif; ?>
                
                <br>
                <hr>
                <!-- renderizando form para comentar -->
                <?php if (isset($_SESSION['user'])) :?>
                    <h4>Deixe seu comentário!</h4>
                    <form action="<?= $pathToRoot ?>PHP/comment_article.php" method="POST" class="container-fluid">
                        <div class="input-button-group">
                            <input type="hidden" name="article_id" value="<?= $_GET['id'] ?>">
                            <input type="text" name="comment" id="comment" placeholder="Escreva seu comentário..." required>
                            <button type="submit" class="primary"><i class="fa-solid fa-comment"></i></button>
                        </div>
                    </form>
                <?php else: ?>
                    <p>Faça <a href="<?= $pathToRoot ?>PAGES/login.php">login</a> para comentar este artigo!</p>
                <?php endif; ?>

                <br>
                <hr>

                <!-- renderizando comentarios -->
                <h4>Comentários:</h4>
                <?php 
                    require_once $pathToRoot."PHP/pull_coments.php";
                    if (count($comments) == 0):
                ?>
                    <p>não há comentarios ainda, seja o primeiro!</p>
                <?php else: ?>
                    <?php foreach($comments as $comment): ?>
                        <div class="container-fluid comment">
                            <h5><?= $comment['author'] ?> disse:</h5>
                            <p><?= $comment['content'] ?></p>
                            <p><small>em <?= date('d/m/Y', strtotime($comment['creation'])) ?></small></p>
                            <div class="star-rating">
                        </div>
                        <!-- comment rating -->
                        <?php if(!$_SESSION['user']): ?>
                            <p><small>faça <a href="<?= $pathToRoot ?>PAGES/login.php">login</a> para avaliar este comentário!</small></p>
                        <?php else: ?>
                            <form action="<?= $pathToRoot ?>PHP/rate_comment.php" method="POST" class="container-fluid">
                                <div class="input-button-group">
                                    <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                    <div class="container-fluid star-rating">
                                        <?php for ($i=5; $i >= 1; $i--): ?>
                                            <input class="radio-input" type="radio" id="star-comment-<?=$comment['id'];?>-<?=$i;?>" name="star-input" value="<?=$i;?>" />
                                            <label class="radio-label" class for="star-comment-<?=$comment['id'];?>-<?=$i;?>" title="<?=$i;?> stars"><?=$i;?> stars</label>
                                        <?php endfor; ?>
                                    </div>
                                    <button type="submit" class="primary"><i class="fa-solid fa-star"></i></button>
                                </div>
                            </form>
                        <?php endif; ?>
                        </div>
                        
                        <hr>
                    <?php endforeach; ?>
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