<?php
// pull article by author
    require_once $pathToRoot."PHP/db.php";
    $query = 
        "SELECT a.*, u.username AS author,
        AVG(ra.rating) AS avg_rating
        FROM articles a
        JOIN users u ON a.author_id = u.id
        LEFT JOIN ratings_article ra ON a.id = ra.article_id
        WHERE a.author_id = ?
        GROUP BY a.id, u.username
        ORDER BY a.creation DESC
        ";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['user']['id']]);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // closing connection
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
