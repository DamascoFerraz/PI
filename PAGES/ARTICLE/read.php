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
                    <?php for($i=0; $i < floor($GET['avg_rating']); $i++): ?>
                    <i class="fa-solid fa-star" style="color: #FFD700;"></i>
                    <?php endfor; ?>
                    <?php if ($GET['avg_rating'] - floor($GET['avg_rating']) >= 0): ?>
                        <i class="fa-solid fa-star-half-stroke" style="color: #FFD700;"></i>
                    <?php endif; ?>
                    <?php for($i = 5 - ceil($GET['avg_rating']); $i > 0; $i--): ?>
                        <i class="fa-regular fa-star" style="color: #FFD700;"></i>
                    <?php endfor; ?>
                    <?= round($GET['avg_rating'], 1) ?>
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

                                // add view count if user already viewed the article in this session
                                require_once $pathToRoot."PHP/db.php";

                                // update viewed articles history to user

                                if ($logged){
                                    $user_id = $_SESSION['user']['id'];
                                    $article_id = $GET['id'];

                                    // check if user has already viewed the article
                                    $stmt = $pdo->prepare("SELECT * FROM views WHERE user_id = ? AND article_id = ?");
                                    $stmt->execute([$user_id, $article_id]);
                                    $view = $stmt->fetch(PDO::FETCH_ASSOC);

                                    if (!$view) {
                                        // if not, insert new view
                                        $stmt = $pdo->prepare("INSERT INTO views (user_id, article_id, view_date) VALUES (?, ?, NOW())");
                                        $stmt->execute([$user_id, $article_id]);
                                        
                                    } else {
                                        // if yes, update view date
                                        $stmt = $pdo->prepare("UPDATE views SET view_date = NOW() WHERE user_id = ? AND article_id = ?");
                                        $stmt->execute([$user_id, $article_id]);
                                    }
                                }
                            ?>
                        </hgroup>
                    </div>
                </section>
                
                <br>
                <hr>
                <br>

                <?php if ($logged) :?>

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
                    <p>Faça <a href="<?= $pathToRoot ?>verify.php">login</a> para avaliar este artigo!</p>
                <?php endif; ?>
                
                <br>
                <hr>
                <!-- renderizando form para comentar -->
                <?php if ($logged) :?>
                    <h4>Deixe seu comentário!</h4>
                    <form action="<?= $pathToRoot ?>PHP/comment_article.php" method="POST" class="container-fluid">
                        <div class="input-button-group">
                            <input type="hidden" name="article_id" value="<?= $_GET['id'] ?>">
                            <input type="text" name="comment" id="comment" placeholder="Escreva seu comentário..." required>
                            <button type="submit" class="primary"><i class="fa-solid fa-comment"></i></button>
                        </div>
                    </form>
                <?php else: ?>
                    <p>Faça <a href="<?= $pathToRoot ?>verify.php">login</a> para comentar este artigo!</p>
                <?php endif; ?>

                <br>
                <hr>

                <!-- renderizando comentarios -->
                <h4>Comentários:</h4>
                <?php 
                    require_once $pathToRoot."PHP/pull_coments.php";
                    listComments($comments, $logged);
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