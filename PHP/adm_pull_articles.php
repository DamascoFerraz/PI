<?php
// pull articles for adm page 
    // including database connection
    require_once $pathToRoot."PHP/db.php";

    // building query with filters
    $query = "SELECT * FROM articles WHERE 1=1";
    $params = [];
    if (!empty($_GET['id'])) {
        $query .= " AND id = ?";
        $params[] = $_GET['id'];
    }
    if (!empty($_GET['title'])) {
        $query .= " AND title LIKE ?";
        $params[] = "%".$_GET['title']."%";
    }
    if (!empty($_GET['descr'])) {
        $query .= " AND descr LIKE ?";
        $params[] = "%".$_GET['descr']."%";
    }
    if (!empty($_GET['content'])) {
        $query .= " AND content LIKE ?";
        $params[] = "%".$_GET['content']."%";
    }
    if (!empty($_GET['author_id'])) {
        $query .= " AND author_id = ?";
        $params[] = $_GET['author_id'];
    }
    if (!empty($_GET['is_active'])) {
        $query .= " AND is_active = ?";
        $params[] = $_GET['is_active'];
    }
    if (!empty($_GET['order'])) {
        if ($_GET['order'] === 'crescent') {
            $query .= " ORDER BY creation ASC";
        } elseif ($_GET['order'] === 'decrescent') {
            $query .= " ORDER BY creation DESC";
        }
    } else {
        $query .= " ORDER BY id ASC"; // default order
    }
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // closing connection
    $pdo = null;