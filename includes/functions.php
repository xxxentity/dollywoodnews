<?php
// Article management functions

function getAllArticles() {
    $articles = [];
    $articlesDir = __DIR__ . '/../articles/';
    
    if (!is_dir($articlesDir)) {
        return $articles;
    }
    
    $files = glob($articlesDir . '*.json');
    
    foreach ($files as $file) {
        $content = file_get_contents($file);
        $article = json_decode($content, true);
        if ($article) {
            $articles[] = $article;
        }
    }
    
    // Sort by date descending (newest first)
    usort($articles, function($a, $b) {
        $dateA = strtotime($a['date']);
        $dateB = strtotime($b['date']);
        return $dateB - $dateA;
    });
    
    return $articles;
}

function getArticleById($id) {
    $articleFile = __DIR__ . '/../articles/' . $id . '.json';
    
    if (!file_exists($articleFile)) {
        return null;
    }
    
    $content = file_get_contents($articleFile);
    return json_decode($content, true);
}

function saveArticle($article) {
    $articlesDir = __DIR__ . '/../articles/';
    
    if (!is_dir($articlesDir)) {
        mkdir($articlesDir, 0755, true);
    }
    
    // Generate new ID if not provided
    if (!isset($article['id']) || !$article['id']) {
        $article['id'] = getNextArticleId();
    }
    
    // Add current date if not provided
    if (!isset($article['date']) || !$article['date']) {
        $article['date'] = date('F j, Y');
    }
    
    $filename = $articlesDir . $article['id'] . '.json';
    $json = json_encode($article, JSON_PRETTY_PRINT);
    
    return file_put_contents($filename, $json) !== false;
}

function getNextArticleId() {
    $articles = getAllArticles();
    $maxId = 0;
    
    foreach ($articles as $article) {
        if ($article['id'] > $maxId) {
            $maxId = $article['id'];
        }
    }
    
    return $maxId + 1;
}

function deleteArticle($id) {
    $articleFile = __DIR__ . '/../articles/' . $id . '.json';
    
    if (file_exists($articleFile)) {
        return unlink($articleFile);
    }
    
    return false;
}

// Simple authentication - in production, use proper password hashing
function authenticateAdmin($username, $password) {
    // Simple hardcoded admin credentials - you can change these
    $adminUser = 'admin';
    $adminPass = 'dollywood2025'; // Change this password!
    
    return ($username === $adminUser && $password === $adminPass);
}

function isLoggedIn() {
    session_start();
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: admin.php?login=required');
        exit();
    }
}

// Utility functions
function formatDate($dateString) {
    return date('F j, Y', strtotime($dateString));
}

function truncateText($text, $length = 150) {
    if (strlen($text) <= $length) {
        return $text;
    }
    
    return substr($text, 0, $length) . '...';
}

function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}
?>