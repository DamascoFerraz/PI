<?php

require_once $pathToRoot."PHP/db.php";

// adiquirindo os 4 artigos mais bem avaliados sem duplicatas
$top_rated_articles = $pdo->query(
    "SELECT DISTINCT articles.id, articles.title, articles.creation, users.username AS author, articles.descr, 
    AVG(ratings_article.rating) AS avg_rating

    FROM articles

    JOIN ratings_article ON articles.id = ratings_article.article_id
    JOIN users ON articles.author_id = users.id

    GROUP BY articles.id

    ORDER BY avg_rating DESC

    LIMIT 3

")->fetchAll(PDO::FETCH_ASSOC);

// // adiquirindo os 4 artigos mais lidos recentemente (em alta)
$heat_articles = $pdo->query(
    "SELECT articles.id, articles.title, articles.creation, users.username AS author, articles.descr,
    articles.views AS view_count,
    AVG(ratings_article.rating) AS avg_rating

    FROM articles

    LEFT JOIN ratings_article ON articles.id = ratings_article.article_id
    JOIN views ON articles.id = views.article_id
    JOIN users ON articles.author_id = users.id

    WHERE views.view_date >= DATE_SUB(NOW(), INTERVAL 7 DAY)

    GROUP BY articles.id

    ORDER BY view_count DESC

    LIMIT 3

")->fetchAll(PDO::FETCH_ASSOC);



// adiquirindo os 4 artigos mais recentes
$recent_articles = $pdo->query(
    "SELECT articles.id, articles.title, articles.creation, users.username AS author, articles.descr,
    AVG(ratings_article.rating) AS avg_rating

    FROM articles

    LEFT JOIN ratings_article ON articles.id = ratings_article.article_id
    JOIN users ON articles.author_id = users.id

    GROUP BY articles.id, articles.title, articles.creation, users.username

    ORDER BY articles.creation DESC

    LIMIT 3

")->fetchAll(PDO::FETCH_ASSOC);

// adiquirindo os 4 artigos semelhantes as tags fav do user
$favorite_tags = [];
if (isset($_SESSION['user'])) {
    $stmt = $pdo->prepare(
        "SELECT tags.id, tags.name

        FROM user_tag_ratings

        JOIN tags ON user_tag_ratings.tag_id = tags.id

        WHERE user_tag_ratings.user_id = ?

        ORDER BY user_tag_ratings.rating DESC

        LIMIT 3
    ");

    $stmt->execute([$_SESSION['user']['id']]);
    $favorite_tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($favorite_tags) > 0){
        $articles_by_tags = $top_rated_articles;
    }

        $articles_by_tags = [];
        
        $stmt = $pdo->prepare(
            "SELECT DISTINCT articles.id, articles.title, articles.creation, users.username AS author, articles.descr,
            AVG(ratings_article.rating) AS avg_rating

            FROM articles

            JOIN article_tags ON articles.id = article_tags.article_id
            JOIN users ON articles.author_id = users.id
            LEFT JOIN ratings_article ON articles.id = ratings_article.article_id

            WHERE article_tags.tag_id = ?

            GROUP BY articles.id, articles.title, articles.creation, users.username

            LIMIT 3
        ");
        
        foreach ($favorite_tags as $tag) {
            $stmt->execute([$tag['id']]);
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $articles_by_tags = array_merge($articles_by_tags, $articles);
        }

        // removendo duplicatas
        $articles_by_tags = array_map("unserialize", array_unique(array_map("serialize", $articles_by_tags)));

} else {
    $articles_by_tags = $top_rated_articles;
}

// fechando conexao
$pdo = null;


// review de variaveis
// $recent_articles (artigos recentes)
// $heat_articles (artigos em alta)
// $top_rated_articles (artigos mais bem avaliados)
// $articles_by_tags (artigos relacionados as tags favoritas do user)
?>

<?php function listArticles($articlesArray) {
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
