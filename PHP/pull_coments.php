<?php

// require_once $pathToRoot."PHP/db.php";

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    $stmt = $pdo->query("
        SELECT comments.id, comments.content, comments.creation, users.username AS author
        FROM comments
        JOIN users ON comments.author_id = users.id
        WHERE comments.article_id = $article_id
        ORDER BY comments.creation DESC
    ");
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    $comments = [];
}
$pdo = null;

function listComments($commentsArray, $logged = false) {
    if (count($commentsArray)== 0){
        echo "<p>não ha comentarios</p>";
    }
    else{
        $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
        $pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";
        
        foreach($commentsArray as $comment):?>
            <div class="container-fluid comment">
                <h5><?= $comment['author'] ?> disse:</h5>
                <p><?= $comment['content'] ?></p>
                <p><small>em <?= date('d/m/Y', strtotime($comment['creation'])) ?></small></p>
                <div class="star-rating">
            </div>
            <?php if(!$logged): ?>
                <p><small>faça <a href="<?= $pathToRoot ?>../verify.php">login</a> para avaliar este comentário!</small></p>
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
        <?php endforeach;
    }
}