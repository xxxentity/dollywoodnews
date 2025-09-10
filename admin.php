<?php
require_once 'includes/functions.php';
session_start();

// Handle login
if (isset($_POST['login'])) {
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];
    
    if (authenticateAdmin($username, $password)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: admin.php');
        exit();
    } else {
        $error = 'Invalid credentials. Please try again.';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit();
}

// Handle article creation/editing
if (isset($_POST['save_article']) && isLoggedIn()) {
    $article = [
        'title' => sanitizeInput($_POST['title']),
        'author' => sanitizeInput($_POST['author']),
        'excerpt' => sanitizeInput($_POST['excerpt']),
        'content' => $_POST['content'], // Allow HTML in content
        'date' => sanitizeInput($_POST['date']) ?: date('F j, Y')
    ];
    
    // If editing existing article
    if (isset($_POST['article_id']) && $_POST['article_id']) {
        $article['id'] = (int)$_POST['article_id'];
    }
    
    if (saveArticle($article)) {
        $success = 'Article saved successfully!';
    } else {
        $error = 'Failed to save article. Please try again.';
    }
}

// Handle article deletion
if (isset($_GET['delete']) && isLoggedIn()) {
    $articleId = (int)$_GET['delete'];
    if (deleteArticle($articleId)) {
        $success = 'Article deleted successfully!';
    } else {
        $error = 'Failed to delete article.';
    }
}

// Get article for editing
$editingArticle = null;
if (isset($_GET['edit']) && isLoggedIn()) {
    $editingArticle = getArticleById((int)$_GET['edit']);
}

$isLoggedIn = isLoggedIn();
$articles = $isLoggedIn ? getAllArticles() : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dollywood News</title>
    <link rel="icon" type="image/png" href="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Georgia', serif;
            line-height: 1.6;
            color: #fff;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
            min-height: 100vh;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .admin-header {
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #d4af37;
        }
        
        .admin-header h1 {
            color: #d4af37;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .login-form, .article-form {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(212, 175, 55, 0.3);
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            color: #d4af37;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid rgba(212, 175, 55, 0.3);
            border-radius: 8px;
            background: rgba(0, 0, 0, 0.3);
            color: #fff;
            font-size: 1rem;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #d4af37;
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.3);
        }
        
        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .form-group textarea.content {
            min-height: 300px;
        }
        
        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #d4af37, #f4d03f);
            color: #000;
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, #f4d03f, #d4af37);
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: transparent;
            color: #d4af37;
            border: 2px solid #d4af37;
        }
        
        .btn-secondary:hover {
            background: #d4af37;
            color: #000;
        }
        
        .btn-danger {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
        }
        
        .btn-danger:hover {
            background: linear-gradient(45deg, #c0392b, #e74c3c);
        }
        
        .articles-list {
            margin-top: 2rem;
        }
        
        .article-item {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 1.5rem;
            border: 1px solid rgba(212, 175, 55, 0.3);
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .article-info h3 {
            color: #d4af37;
            margin-bottom: 0.5rem;
        }
        
        .article-info p {
            color: #cccccc;
            font-size: 0.9rem;
        }
        
        .article-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-weight: bold;
        }
        
        .alert-success {
            background: rgba(39, 174, 96, 0.2);
            color: #2ecc71;
            border: 1px solid #2ecc71;
        }
        
        .alert-error {
            background: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
            border: 1px solid #e74c3c;
        }
        
        .nav-link {
            color: #d4af37;
            text-decoration: none;
            margin-bottom: 1rem;
            display: inline-block;
        }
        
        .nav-link:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .article-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="admin-header">
            <h1>🔐 Admin Panel</h1>
            <p>Manage Dollywood News Articles</p>
            <a href="index.php" class="nav-link">← Back to Website</a>
        </div>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (!$isLoggedIn): ?>
            <div class="login-form">
                <h2 style="color: #d4af37; margin-bottom: 1.5rem; text-align: center;">Admin Login</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
                <p style="margin-top: 1rem; color: #cccccc; font-size: 0.9rem;">
                    Default: admin / dollywood2025
                </p>
            </div>
        <?php else: ?>
            <div style="text-align: right; margin-bottom: 2rem;">
                <span style="color: #d4af37;">Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</span>
                <a href="?logout=1" class="btn btn-danger" style="margin-left: 1rem;">Logout</a>
            </div>

            <div class="article-form">
                <h2 style="color: #d4af37; margin-bottom: 1.5rem;">
                    <?php echo $editingArticle ? 'Edit Article' : 'Create New Article'; ?>
                </h2>
                <form method="POST">
                    <?php if ($editingArticle): ?>
                        <input type="hidden" name="article_id" value="<?php echo $editingArticle['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label for="title">Article Title:</label>
                        <input type="text" id="title" name="title" required 
                               value="<?php echo $editingArticle ? htmlspecialchars($editingArticle['title']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="author">Author/Publication:</label>
                        <input type="text" id="author" name="author" required 
                               value="<?php echo $editingArticle ? htmlspecialchars($editingArticle['author']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="text" id="date" name="date" placeholder="e.g., June 15, 2025"
                               value="<?php echo $editingArticle ? htmlspecialchars($editingArticle['date']) : date('F j, Y'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="excerpt">Article Excerpt:</label>
                        <textarea id="excerpt" name="excerpt" required 
                                  placeholder="Brief summary of the article..."><?php echo $editingArticle ? htmlspecialchars($editingArticle['excerpt']) : ''; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="content">Full Article Content (HTML allowed):</label>
                        <textarea id="content" name="content" class="content" required 
                                  placeholder="Use &lt;h3&gt; for headers and &lt;p&gt; for paragraphs..."><?php echo $editingArticle ? htmlspecialchars($editingArticle['content']) : ''; ?></textarea>
                    </div>
                    
                    <button type="submit" name="save_article" class="btn btn-primary">
                        <?php echo $editingArticle ? 'Update Article' : 'Create Article'; ?>
                    </button>
                    
                    <?php if ($editingArticle): ?>
                        <a href="admin.php" class="btn btn-secondary">Cancel Edit</a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="articles-list">
                <h2 style="color: #d4af37; margin-bottom: 1.5rem;">Manage Articles</h2>
                <?php foreach ($articles as $article): ?>
                    <div class="article-item">
                        <div class="article-info">
                            <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                            <p>By <?php echo htmlspecialchars($article['author']); ?> | <?php echo htmlspecialchars($article['date']); ?></p>
                        </div>
                        <div class="article-actions">
                            <a href="article.php?id=<?php echo $article['id']; ?>" class="btn btn-secondary" target="_blank">View</a>
                            <a href="admin.php?edit=<?php echo $article['id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="admin.php?delete=<?php echo $article['id']; ?>" class="btn btn-danger" 
                               onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>