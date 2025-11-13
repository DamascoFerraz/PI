<?php

// require_once $pathToRoot."PHP/db.php";

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    $stmt = $pdo->query(
        "SELECT comments.id, comments.content, comments.creation, comments.rating, comments.article_id, users.username AS author 

        FROM comments

        LEFT JOIN users ON comments.author_id = users.id

        WHERE comments.article_id = $article_id

        ORDER BY  comments.rating DESC, comments.creation DESC
        
    ");
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    $comments = [];
}
$pdo = null;

function listComments($commentsArray, $logged = false, $pathToRoot = "") {
    if (count($commentsArray)== 0){
        echo "<p>não ha comentarios</p>";
    }
    else{
        
        foreach($commentsArray as $comment):?>
            <div class="container-fluid comment">
                <h5 style='display:inline;'><?= $comment['author'] ?></h5> (<span style="color: gold;">★ <?= $comment['rating'] ?></span>)  <small><?= date('d/m/Y', strtotime($comment['creation'])) ?></small>
                <p><?= $comment['content'] ?></p>
                <div class="star-rating">
            
                <?php if($logged): ?>
                    <form action="<?= $pathToRoot ?>PHP/rate_comment.php" method="POST" class="container-fluid">
                        <div class="input-button-group">
                            <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                            <input type="hidden" name="article_id" value="<?= $comment['article_id'] ?>">
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
            </div>
            <hr>
        <?php endforeach;
    }
}