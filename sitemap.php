<?php
require_once 'includes/functions.php';
$articles = getAllArticles();

// Group articles by month
$articlesByMonth = [];
foreach ($articles as $article) {
    $monthYear = date('F Y', strtotime($article['date']));
    if (!isset($articlesByMonth[$monthYear])) {
        $articlesByMonth[$monthYear] = [];
    }
    $articlesByMonth[$monthYear][] = $article;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitemap - Dollywood News</title>
    <meta name="description" content="Complete sitemap of Dollywood News featuring all articles, main pages, and content organized by month for easy navigation.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://dollywoodnews.com/sitemap">

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
        }

        /* Header - Same as index */
        header {
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(20px);
            position: sticky;
            top: 0;
            z-index: 9999;
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
            background: rgba(212, 175, 55, 0.1);
            transform: translateY(-2px);
        }

        .nav-link.active {
            color: var(--gold);
            background: rgba(212, 175, 55, 0.15);
        }

        /* Main Content */
        .sitemap-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        .page-title {
            text-align: center;
            margin-bottom: 4rem;
            animation: fadeInUp 0.8s ease;
        }

        .page-title h1 {
            color: var(--gold);
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 1rem;
        }

        .page-title p {
            color: var(--text-gray);
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
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

        .sitemap-section {
            margin-bottom: 4rem;
            animation: fadeInUp 0.8s ease;
        }

        .sitemap-section h2 {
            color: var(--gold);
            font-size: 2rem;
            font-weight: 600;
            border-bottom: 3px solid var(--gold);
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            position: relative;
        }

        .sitemap-section h2::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.5);
        }

        .static-pages {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .sitemap-link {
            background: rgba(26, 26, 26, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sitemap-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .sitemap-link:hover::before {
            left: 100%;
        }

        .sitemap-link:hover {
            transform: translateY(-5px);
            border-color: var(--gold);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        }

        .sitemap-link a {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1rem;
            display: block;
            transition: color 0.3s ease;
        }

        .sitemap-link:hover a {
            color: var(--gold);
        }

        .sitemap-month {
            margin-bottom: 3rem;
            background: rgba(26, 26, 26, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 15px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .sitemap-month:hover {
            border-color: rgba(212, 175, 55, 0.4);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.2);
        }

        .sitemap-month h3 {
            color: var(--gold);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .article-count {
            background: var(--gold);
            color: var(--dark);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .sitemap-links {
            display: grid;
            gap: 1rem;
        }

        .article-link {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(212, 175, 55, 0.1);
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .article-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .article-link:hover::before {
            left: 100%;
        }

        .article-link:hover {
            transform: translateX(10px);
            border-color: var(--gold);
            background: rgba(212, 175, 55, 0.05);
        }

        .article-link a {
            color: var(--text-light);
            text-decoration: none;
            flex: 1;
            font-weight: 400;
            transition: color 0.3s ease;
        }

        .article-link:hover a {
            color: var(--gold);
        }

        .sitemap-date {
            color: var(--text-gray);
            font-size: 0.9rem;
            white-space: nowrap;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .article-link:hover .sitemap-date {
            opacity: 1;
            color: var(--gold-light);
        }

        .xml-sitemap {
            text-align: center;
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 1px solid rgba(212, 175, 55, 0.3);
        }

        .xml-sitemap p {
            color: var(--text-gray);
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .xml-sitemap a {
            color: var(--gold);
            text-decoration: none;
            font-weight: 600;
            padding: 0.8rem 2rem;
            border: 2px solid var(--gold);
            border-radius: 25px;
            display: inline-block;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .xml-sitemap a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--gold);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .xml-sitemap a:hover::before {
            left: 0;
        }

        .xml-sitemap a:hover {
            color: var(--dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .header-container {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .logo-text h1 {
                font-size: 1.5rem;
            }

            nav {
                gap: 1rem;
            }

            .nav-link {
                font-size: 0.9rem;
                padding: 0.4rem 0.8rem;
            }

            .sitemap-container {
                padding: 2rem 1rem;
            }

            .page-title h1 {
                font-size: 2rem;
            }

            .static-pages {
                grid-template-columns: 1fr;
            }

            .article-link {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .sitemap-date {
                align-self: flex-end;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="/" class="logo-section">
                <img src="https://i.postimg.cc/J4tYRYdf/Chat-GPT-Image-Jun-17-2025-09-52-07-AM.png" alt="Dollywood News Logo" class="logo-img">
                <div class="logo-text">
                    <h1>Dollywood News</h1>
                    <div class="tagline">Theme Park Updates & More</div>
                </div>
            </a>
            <nav>
                <a href="/" class="nav-link">Home</a>
                <a href="/about" class="nav-link">About</a>
                <a href="/contact" class="nav-link">Contact</a>
                <a href="/sitemap" class="nav-link active">Sitemap</a>
            </nav>
        </div>
    </header>

    <main class="sitemap-container">
        <div class="page-title">
            <h1>Site Map</h1>
            <p>Comprehensive navigation of all Dollywood News content, organized by category and publication date for easy browsing.</p>
        </div>

        <!-- Static Pages -->
        <div class="sitemap-section">
            <h2>Main Pages</h2>
            <div class="static-pages">
                <div class="sitemap-link">
                    <a href="/">Homepage</a>
                </div>
                <div class="sitemap-link">
                    <a href="/about">About Us</a>
                </div>
                <div class="sitemap-link">
                    <a href="/contact">Contact</a>
                </div>
                <div class="sitemap-link">
                    <a href="/privacy">Privacy Policy</a>
                </div>
                <div class="sitemap-link">
                    <a href="/terms">Terms of Service</a>
                </div>
            </div>
        </div>

        <!-- Articles by Month -->
        <div class="sitemap-section">
            <h2>Articles by Month</h2>
            <?php foreach ($articlesByMonth as $monthYear => $monthArticles): ?>
                <div class="sitemap-month">
                    <h3><?php echo $monthYear; ?> <span class="article-count"><?php echo count($monthArticles); ?> articles</span></h3>
                    <div class="sitemap-links">
                        <?php foreach ($monthArticles as $article): ?>
                            <div class="article-link">
                                <a href="article/<?php echo $article['id']; ?>/<?php echo generateSlug($article['title']); ?>">
                                    <?php echo htmlspecialchars($article['title']); ?>
                                </a>
                                <span class="sitemap-date"><?php echo $article['date']; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- XML Sitemap Link -->
        <div class="xml-sitemap">
            <p>For search engines and automated tools:</p>
            <a href="/sitemap.xml">XML Sitemap</a>
        </div>
    </main>
</body>
</html>