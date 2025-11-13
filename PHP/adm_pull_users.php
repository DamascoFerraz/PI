<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
    
    // creating search query

    $search = 
        "SELECT id, username, position, creation, is_active
        FROM users
        
        ";

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $search .= "WHERE id = ? ";
        $params = [$_GET['id']];
    } 

    if (isset($_GET['username']) && !empty($_GET['username'])) {
        if (isset($params)) {
            $search .= "AND username LIKE ? ";
            $params[] = "%".$_GET['username']."%";
        } else {
            $search .= "WHERE username LIKE ? ";
            $params = ["%".$_GET['username']."%"];
        }
    }

    if (isset($_GET['position']) && !empty($_GET['position'] && in_array($_GET['position'], ['admin', 'editor', 'user']))) {
        if (isset($params)) {
            $search .= "AND position = ? ";
            $params[] = $_GET['position'];
        } else {
            $search .= "WHERE position = ? ";
            $params = [$_GET['position']];
        }
    }

    if (isset($_GET['is_active']) && ($_GET['is_active'] === '0' || $_GET['is_active'] === '1')) {
        if (isset($params)) {
            $search .= "AND is_active = ? ";
            $params[] = $_GET['is_active'];
        } else {
            $search .= "WHERE is_active = ? ";
            $params = [$_GET['is_active']];
        }
    }

    if (isset($_GET['order'] )) {
        if ($_GET['order'] == 'crescent') {
            $search .= "ORDER BY creation ASC ";
        } else {
            $search .= "ORDER BY creation DESC ";
        }
    } else {
        $search .= "ORDER BY creation DESC ";
    }

    require_once $pathToRoot."PHP/db.php";

    if (!isset($params)) {
        $params = [];
    }

    $stmt = $pdo->prepare($search);
    $stmt->execute($params);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    // pulling users from database
    require_once $pathToRoot."PHP/db.php";
    $users = $pdo->query(
        "SELECT id, username, position, creation, is_active
        FROM users
        ORDER BY creation DESC
    ")->fetchAll(PDO::FETCH_ASSOC);
}


