<?php
require_once 'includes/security.php';
require_once 'includes/functions.php';

$articleId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$article = getArticleById($articleId);

if (!$article) {
    header('Location: index.php');
    exit();
}

// Debug removed - article data confirmed working
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> - Dollywood News</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo htmlspecialchars($article['excerpt']); ?>">
    <meta name="keywords" content="Dollywood, theme park, Tennessee, Pigeon Forge, Dolly Parton, attractions, news, <?php echo htmlspecialchars(str_replace(' ', ', ', $article['title'])); ?>">
    <meta name="author" content="<?php echo htmlspecialchars($article['author']); ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://dollywoodnews.com/article.php?id=<?php echo $article['id']; ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://dollywoodnews.com/article.php?id=<?php echo $article['id']; ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($article['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($article['excerpt']); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($article['image']); ?>">
    <meta property="article:published_time" content="<?php echo date('c', strtotime($article['date'])); ?>">
    <meta property="article:author" content="<?php echo htmlspecialchars($article['author']); ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://dollywoodnews.com/article.php?id=<?php echo $article['id']; ?>">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($article['title']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($article['excerpt']); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($article['image']); ?>">
    
    <link rel="icon" type="image/png" href="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png">
    <link rel="shortcut icon" type="image/png" href="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png">
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5K01EEMBBN"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-5K01EEMBBN');
    </script>
    
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
            background: #000000;
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.3);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
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
            margin-left: 0;
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
            margin: 0 auto;
            padding-top: 200px; /* Increased from 120px */
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
            font-size: 2.5rem !important;
            color: #d4af37 !important;
            margin-bottom: 1rem !important;
            line-height: 1.2 !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5) !important;
            font-weight: bold !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            position: relative !important;
            z-index: 10 !important;
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
    <!-- Structured Data for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "headline": "<?php echo htmlspecialchars($article['title']); ?>",
        "image": "<?php echo htmlspecialchars($article['image']); ?>",
        "datePublished": "<?php echo date('c', strtotime($article['date'])); ?>",
        "dateModified": "<?php echo date('c', strtotime($article['date'])); ?>",
        "author": {
            "@type": "Person",
            "name": "<?php echo htmlspecialchars($article['author']); ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Dollywood News",
            "logo": {
                "@type": "ImageObject",
                "url": "https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png"
            }
        },
        "description": "<?php echo htmlspecialchars($article['excerpt']); ?>",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "https://dollywoodnews.com/article.php?id=<?php echo $article['id']; ?>"
        }
    }
    </script>
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
                <div class="article-content">
                    <!-- Title and meta moved inside content box -->
                    <div style="text-align: center; margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 2px solid rgba(212, 175, 55, 0.3);">
                        <h1 style="color: #f4d03f; font-size: 2.5rem; margin-bottom: 1rem; line-height: 1.2; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-weight: bold;">
                            <?php echo htmlspecialchars($article['title']); ?>
                        </h1>
                        <div style="display: flex; justify-content: center; gap: 2rem; color: #cccccc; font-size: 1rem;">
                            <span>By <?php echo htmlspecialchars($article['author']); ?></span>
                            <span><?php echo htmlspecialchars($article['date']); ?></span>
                        </div>
                    </div>
                    
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
    
    <?php include 'includes/cookie-consent.php'; ?>
</body>
</html>