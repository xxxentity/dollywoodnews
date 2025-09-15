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
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .sitemap-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        .sitemap-section {
            margin-bottom: 3rem;
        }
        .sitemap-section h2 {
            color: var(--gold);
            border-bottom: 2px solid var(--gold);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .sitemap-links {
            display: grid;
            gap: 1rem;
        }
        .sitemap-link {
            display: flex;
            align-items: baseline;
            gap: 1rem;
            padding: 0.5rem;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .sitemap-link:hover {
            background: rgba(255, 215, 0, 0.1);
        }
        .sitemap-link a {
            color: #fff;
            text-decoration: none;
            flex: 1;
        }
        .sitemap-link a:hover {
            color: var(--gold);
        }
        .sitemap-date {
            color: #888;
            font-size: 0.9rem;
        }
        .sitemap-month {
            margin-bottom: 2rem;
        }
        .sitemap-month h3 {
            color: var(--gold);
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }
        .static-pages {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="sitemap-container">
        <h1 style="color: var(--gold); text-align: center; margin-bottom: 3rem;">Site Map</h1>
        
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
                    <h3><?php echo $monthYear; ?> (<?php echo count($monthArticles); ?> articles)</h3>
                    <div class="sitemap-links">
                        <?php foreach ($monthArticles as $article): ?>
                            <div class="sitemap-link">
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
        <div class="sitemap-section" style="text-align: center; margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #333;">
            <p style="color: #888;">For search engines: <a href="/sitemap.xml" style="color: var(--gold);">XML Sitemap</a></p>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>