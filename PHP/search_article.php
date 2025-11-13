<?php

require_once $pathToRoot."PHP/db.php";

// acquiring articles based on user's search query

$search_query = $_GET['search'];

$search_articles = $pdo->prepare("
    SELECT articles.id, articles.title, articles.creation, users.username AS author, articles.descr,
    articles.rating AS avg_rating
    FROM articles
    LEFT JOIN ratings_article ON articles.id = ratings_article.article_id
    JOIN users ON articles.author_id = users.id
    WHERE articles.title LIKE ? OR articles.content LIKE ? OR articles.descr LIKE ?
    GROUP BY articles.id
    ORDER BY articles.creation DESC
    LIMIT 10
");

$like_query = "%".$search_query."%";
$search_articles->execute([$like_query, $like_query, $like_query]);
$search_articles = $search_articles->fetchAll(PDO::FETCH_ASSOC);
$pdo = null;


function listArticles($articlesArray) {
    if (count($articlesArray) == 0) {
        echo "<p>Nenhum artigo encontrado</p>";
        return;
    }
    $depth = array_search('PI', array_reverse(explode(DIRECTORY_SEPARATOR, __DIR__)));
    $pathToRoot = ($depth !== false) ? str_repeat("../", $depth) : "";?>

    <?php foreach($articlesArray as $article): ?>
        <article class="card">
            <header>
                <h3><?= $article['title'] ?></h3>
                <?php for($i=0; $i < floor($article['avg_rating']); $i++): ?>
                    <i class="fa-solid fa-star" style="color: #FFD700;"></i>
                <?php endfor; ?>
                <?php if ($article['avg_rating'] - floor($article['avg_rating']) >= 0.1): ?>
                    <i class="fa-solid fa-star-half-stroke" style="color: #FFD700;"></i>
                <?php endif; ?>
                <?php for($i = 5 - ceil($article['avg_rating']); $i > 0; $i--): ?>
                    <i class="fa-regular fa-star" style="color: #FFD700;"></i>
                <?php endfor; ?>
                <?= round($article['avg_rating'], 1) ?>
                <p>por <?= $article['author'] ?> em <?= date('d/m/Y', strtotime($article['creation'])) ?></p>
            </header>
            <main>
                <p>
                    <?= substr($article['descr'], 0, 100) ?>...
                </p>
            </main>
            <footer>
                <a href="<?= $pathToRoot?>PAGES/ARTICLE/read.php?id=<?= $article['id'] ?>">Ler mais</a>
            </footer>
        </article>
    <?php endforeach; ?>
<?php };?>
