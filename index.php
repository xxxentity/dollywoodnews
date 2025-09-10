<?php
require_once 'includes/functions.php';
$articles = getAllArticles();

// Get featured articles (first 3 for hero section)
$featuredArticles = array_slice($articles, 0, 3);
$latestArticles = array_slice($articles, 3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dollywood News - Your Source for Dollywood Updates</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="icon" type="image/png" href="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png">
    <link rel="shortcut icon" type="image/png" href="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --gold: #d4af37;
            --gold-light: #f4d03f;
            --dark: #000000;
            --dark-gray: #1a1a1a;
            --text-light: #ffffff;
            --text-gray: #cccccc;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-light);
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-gray) 50%, var(--dark) 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Loading Animation */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--dark);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }
        
        .loader-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(212, 175, 55, 0.3);
            border-top: 3px solid var(--gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Header */
        header {
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(20px);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 2px solid var(--gold);
            box-shadow: 0 4px 30px rgba(212, 175, 55, 0.3);
            animation: slideDown 0.6s ease;
        }
        
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            transition: transform 0.3s ease;
        }
        
        .logo-section:hover {
            transform: scale(1.05);
        }
        
        .logo-img {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            border: 2px solid var(--gold);
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.5);
            animation: glow 2s ease-in-out infinite;
        }
        
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(212, 175, 55, 0.5); }
            50% { box-shadow: 0 0 30px rgba(212, 175, 55, 0.8); }
        }
        
        .logo-text h1 {
            color: var(--gold);
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .logo-text .tagline {
            color: var(--text-gray);
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            margin-top: -2px;
        }
        
        /* Navigation */
        nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-link {
            color: var(--text-light);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.3), transparent);
            transition: left 0.6s ease;
        }
        
        .nav-link:hover::before {
            left: 100%;
        }
        
        .nav-link:hover {
            color: var(--gold);
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            color: var(--dark);
        }
        
        /* Breaking News Ticker */
        .breaking-news {
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
            color: var(--dark);
            padding: 0;
            margin: 0;
            overflow: hidden;
            height: 20px;
            line-height: 20px;
            font-size: 0; /* Remove whitespace between inline elements */
        }
        
        .breaking-news-content {
            animation: scroll 30s linear infinite;
            white-space: nowrap;
            height: 20px;
            line-height: 20px;
            font-size: 14px;
            display: inline-block;
            vertical-align: top;
            padding-left: 10px;
        }
        
        @keyframes scroll {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        
        .breaking-news-label {
            background: var(--dark) !important;
            color: var(--gold) !important;
            padding: 0 10px !important;
            margin: 0 !important;
            font-weight: bold !important;
            width: 100px !important;
            height: 30px !important;
            text-align: center !important;
            line-height: 30px !important;
            font-size: 14px !important;
            box-sizing: border-box !important;
            display: inline-block !important;
            vertical-align: top !important;
        }
        
        /* Hero Section - BBC Style */
        .hero-section {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            animation: fadeInUp 0.8s ease;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .main-featured {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.3);
            cursor: pointer;
            transition: all 0.4s ease;
            animation: fadeInUp 0.8s ease;
        }
        
        .main-featured:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(212, 175, 55, 0.3);
            border-color: var(--gold);
        }
        
        .main-featured-image {
            width: 100%;
            height: 400px;
            background-size: cover;
            background-position: center;
        }
        
        .main-featured-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
        }
        
        .featured-label {
            display: inline-block;
            background: var(--gold);
            color: var(--dark);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 0.8rem;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .main-featured h2 {
            color: var(--text-light);
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.8rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }
        
        .main-featured .excerpt {
            color: var(--text-gray);
            font-size: 1.1rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }
        
        .article-meta {
            display: flex;
            gap: 1rem;
            color: var(--text-gray);
            font-size: 0.9rem;
        }
        
        .article-meta span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        
        /* Side Featured Articles */
        .side-featured {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .side-article {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 12px;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease backwards;
        }
        
        .side-article:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .side-article:hover {
            transform: translateX(5px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
            border-color: var(--gold);
            background: rgba(212, 175, 55, 0.05);
        }
        
        .side-article h3 {
            color: var(--gold);
            font-size: 1.2rem;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 0.8rem;
            transition: color 0.3s ease;
        }
        
        .side-article:hover h3 {
            color: var(--gold-light);
        }
        
        .side-article .excerpt {
            color: var(--text-gray);
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 0.8rem;
        }
        
        /* Latest News Section */
        .latest-section {
            max-width: 1400px;
            margin: 3rem auto;
            padding: 0 2rem;
        }
        
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid rgba(212, 175, 55, 0.3);
            animation: fadeInUp 0.8s ease;
        }
        
        .section-title {
            font-size: 2rem;
            color: var(--gold);
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--gold);
            animation: expandWidth 1s ease;
        }
        
        @keyframes expandWidth {
            from { width: 0; }
            to { width: 50px; }
        }
        
        /* News Grid */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }
        
        .news-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s ease;
            opacity: 0;
            animation: fadeInScale 0.6s ease forwards;
        }
        
        .news-card:nth-child(1) { animation-delay: 0.1s; }
        .news-card:nth-child(2) { animation-delay: 0.2s; }
        .news-card:nth-child(3) { animation-delay: 0.3s; }
        .news-card:nth-child(4) { animation-delay: 0.4s; }
        .news-card:nth-child(5) { animation-delay: 0.5s; }
        
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .news-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(212, 175, 55, 0.3);
            border-color: var(--gold);
        }
        
        .news-card-image {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }
        
        .news-card-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.3), transparent);
            transition: left 0.6s ease;
        }
        
        .news-card:hover .news-card-image::after {
            left: 100%;
        }
        
        .news-card-content {
            padding: 1.5rem;
        }
        
        .news-card h3 {
            color: var(--gold);
            font-size: 1.3rem;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 0.8rem;
            transition: color 0.3s ease;
        }
        
        .news-card:hover h3 {
            color: var(--gold-light);
        }
        
        .news-card .excerpt {
            color: var(--text-gray);
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }
        
        .news-card .meta {
            display: flex;
            justify-content: space-between;
            color: var(--text-gray);
            font-size: 0.85rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }
        
        /* Footer */
        footer {
            background: rgba(0, 0, 0, 0.95);
            border-top: 2px solid var(--gold);
            margin-top: 4rem;
            padding: 2rem 0;
            text-align: center;
        }
        
        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .footer-logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            border: 2px solid var(--gold);
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.5);
        }
        
        .footer-text {
            color: var(--text-gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .footer-copyright {
            color: var(--gold);
            font-size: 0.85rem;
        }
        
        /* Scroll to Top Button */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(212, 175, 55, 0.4);
            z-index: 100;
        }
        
        .scroll-top.visible {
            opacity: 1;
            visibility: visible;
        }
        
        .scroll-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.6);
        }
        
        .scroll-top::before {
            content: '↑';
            color: var(--dark);
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-section {
                grid-template-columns: 1fr;
            }
            
            .side-featured {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .logo-text h1 {
                font-size: 1.5rem;
            }
            
            nav {
                width: 100%;
                justify-content: center;
            }
            
            .hero-section {
                padding: 0 1rem;
            }
            
            .main-featured h2 {
                font-size: 1.5rem;
            }
            
            .side-featured {
                grid-template-columns: 1fr;
            }
            
            .news-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
        }
        
        /* Loading States */
        .skeleton {
            background: linear-gradient(90deg, rgba(212, 175, 55, 0.1) 0%, rgba(212, 175, 55, 0.2) 50%, rgba(212, 175, 55, 0.1) 100%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Selection Styling */
        ::selection {
            background: var(--gold);
            color: var(--dark);
        }
    </style>
</head>
<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-spinner"></div>
    </div>

    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="index.php" class="logo-section">
                <img src="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png" alt="Dollywood News" class="logo-img">
                <div class="logo-text">
                    <h1>Dollywood News</h1>
                    <div class="tagline">Your Source for Dollywood Updates</div>
                </div>
            </a>
            <nav>
                <a href="index.php" class="nav-link active">Home</a>
                <a href="about.php" class="nav-link">About</a>
            </nav>
        </div>
    </header>

    <!-- Breaking News Ticker -->
    <div class="breaking-news">
        <span class="breaking-news-label">BREAKING</span><span class="breaking-news-content">🎢 Dollywood announces record-breaking attendance for 2025 season • 🎭 New shows debut this summer • 🍂 Fall festival tickets now on sale • 🎄 Christmas at Dollywood planning begins</span>
    </div>

    <!-- Hero Section - BBC Style -->
    <?php if (!empty($featuredArticles)): ?>
    <section class="hero-section">
        <!-- Main Featured Article -->
        <?php if (isset($featuredArticles[0])): ?>
        <article class="main-featured" onclick="window.location.href='article.php?id=<?php echo $featuredArticles[0]['id']; ?>'">
            <div class="main-featured-image" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7)), url('<?php echo isset($featuredArticles[0]['image']) ? $featuredArticles[0]['image'] : 'https://images.unsplash.com/photo-1544306094-3e8dc1778d4e?w=800'; ?>') center/cover;"></div>
            <div class="main-featured-content">
                <span class="featured-label">Featured Story</span>
                <h2><?php echo htmlspecialchars($featuredArticles[0]['title']); ?></h2>
                <p class="excerpt"><?php echo htmlspecialchars($featuredArticles[0]['excerpt']); ?></p>
                <div class="article-meta">
                    <span>📝 <?php echo htmlspecialchars($featuredArticles[0]['author']); ?></span>
                    <span>📅 <?php echo htmlspecialchars($featuredArticles[0]['date']); ?></span>
                </div>
            </div>
        </article>
        <?php endif; ?>

        <!-- Side Featured Articles -->
        <div class="side-featured">
            <?php for ($i = 1; $i < min(3, count($featuredArticles)); $i++): ?>
            <article class="side-article" onclick="window.location.href='article.php?id=<?php echo $featuredArticles[$i]['id']; ?>'">
                <h3><?php echo htmlspecialchars($featuredArticles[$i]['title']); ?></h3>
                <p class="excerpt"><?php echo htmlspecialchars(substr($featuredArticles[$i]['excerpt'], 0, 100)) . '...'; ?></p>
                <div class="article-meta">
                    <span>📅 <?php echo htmlspecialchars($featuredArticles[$i]['date']); ?></span>
                </div>
            </article>
            <?php endfor; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Latest News Section -->
    <?php if (!empty($latestArticles)): ?>
    <section class="latest-section">
        <div class="section-header">
            <h2 class="section-title">Latest News</h2>
        </div>
        
        <div class="news-grid">
            <?php foreach ($latestArticles as $article): ?>
            <article class="news-card" onclick="window.location.href='article.php?id=<?php echo $article['id']; ?>'">
                <div class="news-card-image" style="background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4)), url('<?php echo isset($article['image']) ? $article['image'] : 'https://images.unsplash.com/photo-1544306094-3e8dc1778d4e?w=800'; ?>') center/cover;"></div>
                <div class="news-card-content">
                    <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                    <p class="excerpt"><?php echo htmlspecialchars(substr($article['excerpt'], 0, 150)) . '...'; ?></p>
                    <div class="meta">
                        <span><?php echo htmlspecialchars($article['author']); ?></span>
                        <span><?php echo htmlspecialchars($article['date']); ?></span>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <img src="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png" alt="Dollywood News" class="footer-logo">
            <p class="footer-text">Your trusted source for all things Dollywood</p>
            <p class="footer-copyright">© 2025 Dollywood News. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <div class="scroll-top" id="scrollTop"></div>

    <script>
        // Page Loader
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('pageLoader').style.opacity = '0';
                setTimeout(() => {
                    document.getElementById('pageLoader').style.display = 'none';
                }, 500);
            }, 500);
        });

        // Scroll to Top
        const scrollTop = document.getElementById('scrollTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTop.classList.add('visible');
            } else {
                scrollTop.classList.remove('visible');
            }
        });
        
        scrollTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Intersection Observer for Animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('.news-card, .side-article, .main-featured').forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });

        // Add parallax effect to hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.main-featured-image');
            if (parallax) {
                parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Add hover sound effect (visual feedback)
        document.querySelectorAll('.news-card, .side-article, .main-featured').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
            });
        });

        // Dynamic time update for breaking news
        function updateBreakingNews() {
            const breakingContent = document.querySelector('.breaking-news-content');
            if (breakingContent) {
                const now = new Date();
                const timeString = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
                // You can update this with real breaking news
            }
        }
        
        setInterval(updateBreakingNews, 60000); // Update every minute
    </script>
</body>
</html>