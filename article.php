<?php
require_once 'includes/functions.php';

$articleId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$article = getArticleById($articleId);

if (!$article) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> - Dollywood News</title>
    <link rel="icon" type="image/png" href="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png">
    <link rel="shortcut icon" type="image/png" href="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png">
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background: #000000 !important;
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.3);
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 2147483647 !important;
            border-bottom: 3px solid #d4af37;
        }
        
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .logo img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid #d4af37;
        }
        
        .logo h1 {
            color: #d4af37;
            font-size: 1.8rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .tagline {
            color: #cccccc;
            font-size: 0.9rem;
            margin-left: 4rem;
        }
        
        .nav-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .btn {
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #d4af37, #f4d03f);
            color: #000;
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, #f4d03f, #d4af37);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
        }
        
        .btn-secondary {
            background: transparent;
            color: #d4af37;
            border: 2px solid #d4af37;
        }
        
        .btn-secondary:hover {
            background: #d4af37;
            color: #000;
            transform: translateY(-2px);
        }
        
        .article-container {
            padding: 1rem 0;
            max-width: 800px;
            margin: 180px auto 0 auto !important;
            position: relative;
            z-index: 1;
        }
        
        .article-header {
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid rgba(212, 175, 55, 0.3);
        }
        
        .article-title {
            font-size: 2.5rem;
            color: #d4af37;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .article-meta {
            display: flex;
            justify-content: center;
            gap: 2rem;
            color: #cccccc;
            font-size: 1rem;
        }
        
        .article-content {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 3rem;
            border: 1px solid rgba(212, 175, 55, 0.3);
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
            margin-top: 0 !important;
        }
        
        .article-body {
            color: #ffffff;
            font-size: 1.1rem;
            line-height: 1.8;
        }
        
        .article-body h3 {
            color: #d4af37;
            font-size: 1.4rem;
            margin: 2rem 0 1rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        .article-body p {
            margin-bottom: 1.5rem;
        }
        
        .back-button {
            text-align: center;
            margin-top: 2rem;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }
            
            .article-title {
                font-size: 2rem;
            }
            
            .article-content {
                padding: 2rem 1.5rem;
            }
            
            .article-meta {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .tagline {
                margin-left: 0;
                text-align: center;
            }
        }
        
        .sparkle {
            position: fixed;
            pointer-events: none;
            width: 4px;
            height: 4px;
            background: #d4af37;
            border-radius: 50%;
            animation: sparkle 2s infinite;
            z-index: 1;
        }
        
        @keyframes sparkle {
            0%, 100% {
                opacity: 0;
                transform: scale(0);
            }
            50% {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png" alt="Dollywood News Logo">
                    <div>
                        <h1>Dollywood News</h1>
                        <div class="tagline">Your Premier Source for Theme Park Updates</div>
                    </div>
                </div>
                <div class="nav-buttons">
                    <a href="index.php" class="btn btn-secondary">← Back to Home</a>
                </div>
            </div>
        </div>
    </header>

    <main class="article-container">
        <div class="container">
            <article>
                <header class="article-header">
                    <h1 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h1>
                    <div class="article-meta">
                        <span>By <?php echo htmlspecialchars($article['author']); ?></span>
                        <span><?php echo htmlspecialchars($article['date']); ?></span>
                    </div>
                </header>
                
                <div class="article-content">
                    <div class="article-body">
                        <?php echo $article['content']; ?>
                    </div>
                </div>
                
                <div class="back-button">
                    <a href="index.php" class="btn btn-primary">← Back to All Articles</a>
                </div>
            </article>
        </div>
    </main>

    <script>
        // Create sparkle effect
        function createSparkle() {
            const sparkle = document.createElement('div');
            sparkle.className = 'sparkle';
            sparkle.style.left = Math.random() * window.innerWidth + 'px';
            sparkle.style.top = Math.random() * window.innerHeight + 'px';
            document.body.appendChild(sparkle);
            
            setTimeout(() => {
                sparkle.remove();
            }, 2000);
        }
        
        // Create sparkles periodically
        setInterval(createSparkle, 800);
    </script>
</body>
</html>