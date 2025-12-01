<?php

    // including database connection
    require_once $pathToRoot."PHP/db.php";

    // building query with filters
    $query = "SELECT * FROM comments WHERE 1=1";
    $params = [];
    if (!empty($_GET['id'])) {
        $query .= " AND id = ?";
        $params[] = $_GET['id'];
    }
    if (!empty($_GET['content'])) {
        $query .= " AND content LIKE ?";
        $params[] = "%".$_GET['content']."%";
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
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // closing connection
    $pdo = null;