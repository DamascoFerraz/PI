<?php

require_once $pathToRoot."PHP/db.php";

// adiquirindo os 4 artigos mais bem avaliados sem duplicatas
$top_rated_articles = $pdo->query("
    SELECT DISTINCT articles.id, articles.title, articles.content, articles.creation, users.username AS author, 
    AVG(ratings_article.rating) AS avg_rating
    FROM articles
    JOIN ratings_article ON articles.id = ratings_article.article_id
    JOIN users ON articles.author_id = users.id
    GROUP BY articles.id
    ORDER BY avg_rating DESC
    LIMIT 3"
)->fetchAll(PDO::FETCH_ASSOC);

// // adiquirindo os 4 artigos mais lidos recentemente (em alta)
$heat_articles = $pdo->query("
    SELECT articles.id, articles.title, articles.content, articles.creation, users.username AS author, 
    COUNT(views.id) AS view_count
    FROM articles
    JOIN views ON articles.id = views.article_id
    JOIN users ON articles.author_id = users.id
    WHERE views.view_date >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    GROUP BY articles.id
    ORDER BY view_count DESC
    LIMIT 3
")->fetchAll(PDO::FETCH_ASSOC);



// adiquirindo os 4 artigos mais recentes
$recent_articles = $pdo->query("
    SELECT articles.id, articles.title, articles.content, articles.creation, users.username AS author
    FROM articles
    JOIN users ON articles.author_id = users.id
    ORDER BY articles.creation DESC
    LIMIT 3
")->fetchAll(PDO::FETCH_ASSOC);

// adiquirindo os 4 artigos semelhantes as tags fav do user
$favorite_tags = [];
if (isset($_SESSION['user'])) {
    $stmt = $pdo->prepare("
        SELECT tags.id, tags.name
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
        
        $stmt = $pdo->prepare("
            SELECT DISTINCT articles.id, articles.title, articles.content, articles.creation, users.username AS author
            FROM articles
            JOIN article_tags ON articles.id = article_tags.article_id
            JOIN users ON articles.author_id = users.id
            WHERE article_tags.tag_id = ?
            LIMIT 3"
        );
        
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
